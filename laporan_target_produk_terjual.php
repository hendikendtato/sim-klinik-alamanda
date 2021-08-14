<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$laporan_target_produk_terjual = new laporan_target_produk_terjual();

// Run the page
$laporan_target_produk_terjual->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
	// Function Tanggal Format Indonesia
	function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
		return $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	function rupiah($angka){
		$hasil_rupiah = "Rp" . number_format($angka);
		return $hasil_rupiah;
	}	

	if(isset($_POST['srhDate'])){
		$cabang  = $_POST['cabang'];
		$inputStatus  = $_POST['status'];
		$periode  = $_POST['periode'];
		$explode = explode('-', $periode);
		$bulan = $explode[1];
		$tahun = $explode[0];
		$multi_status = "";
		$status = "";
		$id_status = "";
		
		foreach($inputStatus AS $in_status) {
			$multi_status .= "m_hargajual.status = '" .$in_status. "' OR ";
			$status .= "m_target_produk.status LIKE '%" .$in_status. "%' OR ";
			$id_status .= "id_status = '" .$in_status. "' OR ";
		}

		if($multi_status && $status){
			$multi_status = substr($multi_status, 0, -4);
			$status = substr($status, 0, -4);
			$id_status = substr($id_status, 0, -4);
			$result = ExecuteRows("SELECT * FROM m_hargajual 
						JOIN m_barang ON m_hargajual.id_barang = m_barang.id 
						JOIN m_status_barang ON m_hargajual.status = m_status_barang.id_status WHERE ($multi_status) AND m_barang.tipe != 'Perawatan' AND m_hargajual.id_klinik = '$cabang'");
			$target = ExecuteScalar("SELECT target FROM m_target_produk WHERE ($status) AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
			$nama_status = ExecuteRows("SELECT status_barang FROM m_status_barang WHERE ($id_status)");
		}
		// $result = ExecuteRow("SELECT * FROM m_target_omset_cabang JOIN m_klinik ON m_klinik.id_klinik = m_target_omset_cabang.id_cabang WHERE MONTH(m_target_omset_cabang.tgl_awal) = '$bulan' AND YEAR(m_target_omset_cabang.tgl_awal) = '$tahun' AND m_target_omset_cabang.id_cabang='$cabang'");
	}

?>
<div class="container-fluid">
	<div class="row">
		<form method="post" action="<?php echo CurrentPageName() ?>">
			<!-- token itu penting buat form method post -->
			<?php if ($Page->CheckToken) { ?>
				<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
			<?php } ?>
			<div class="col-md-12">
				<ul class="list-unstyled">
					<li class="d-inline-block">
						<label class="d-block">Cabang</label>
						<select class="form-control" name="cabang">
							<?php
								$sql = "SELECT * FROM m_klinik";
								$res = ExecuteRows($sql);
								$get_current_id_klinik = CurrentUserInfo("id_klinik");
								$get_nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = '$get_current_id_klinik'");

								if($get_current_id_klinik != '' && $get_current_id_klinik != FALSE){
									echo "<option value=" . $get_current_id_klinik . " selected>" . $get_nama_klinik . "</option>";
								} else {
									foreach ($res as $rs) {
										echo "<option value=" . $rs["id_klinik"] . ">" . $rs["nama_klinik"] . "</option>";
									}
								}
							?>
						</select>
					</li>
					<li class="d-inline-block">
						<label class="d-block">Periode</label>
						<input class="form-control" type="month" id="periode" name="periode">
					</li>
					<li class="d-inline-block">
						<button class="btn btn-primary btn-md p-2" type="submit" name="srhDate">
							Search 
							<i class="fa fa-search h-3"></i>
						</button>
					</li>
				</ul>
				<div class="row">
					<div class="col-md-9">
						<li class="d-inline-block">
								<?php
									$status = ExecuteRows("SELECT * FROM m_status_barang");
									foreach ($status as $value) {
										echo "<input type='checkbox' name='status[]' value='".$value['id_status']."'>
										<label for='".$value['status_barang']."'>".$value['status_barang']."</label>    ";
									}
								?>
						</li>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="row">
		<?php if(isset($_POST['srhDate'])): ?>
			<?php
					$mso='"\@"';
					$cabang  = $_POST['cabang'];
					$periode  = $_POST['periode'];
					$explode = explode('-', $periode);
					$bulan = $explode[1];
					$tahun = $explode[0];

					$aktual = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun' AND id_klinik = '$cabang'");
			?>
			<!-- Button Print -->
			<button class="btn btn-info btn-md p-2 mb-3" onclick="exportTableToExcel('printTable')">
				Export to Excel
				<i class="far fa-file-excel"></i>
			</button>
			<table class="table table-hover table-bordered" id="printTable">
				<thead>
					<tr>
						<td colspan="4" style="text-align: center;">
							<div class="col">
								<h4>Laporan Target Produk Terjual</h4>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="col">
								<h5>Cabang : <?php echo $nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik='".$cabang."'"); ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="col">
								<h5>Periode : <?php echo !empty($periode) ? tgl_indo($periode) : ""; ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="col">
								<h5>Target : <?php echo $target; ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="col">
								<h5>Status : <?php foreach ($nama_status as $ns) {
									echo $ns['status_barang'].",";
								}  ?></h5>
							</div>
						</td>
					</tr>
					<tr style="background-color:#b7d8dc;">
						<th>No.</th>
						<th>Nama Barang</th>
						<th>Aktual</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$aktual_total = 0;
						if(is_null($result) OR $result == FALSE) {
							echo '<tr><td colspan="3" align="center">Kosong</td></tr>';
						} else {
							$no = 1;
							foreach ($result as $rs) {
								$aktual = ExecuteScalar("SELECT sum(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang' AND detailpenjualan.id_barang = '".$rs['id_barang']."' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun'");
								echo "<tr>
									<td>".$no."</td>
									<td>".$rs['nama_barang']."</td>
									<td style='text-align:right;'>";
									if(is_null($aktual) OR $aktual == FALSE){
										echo "0";
									} else {
										echo $aktual;
									}
									echo"</td>
									<td>".$rs['status_barang']."</td>
								</tr>";
								$no++;
								$aktual_total += $aktual;
							}
						}
					?>
					<tr>
						<td colspan='2'>Aktual / Total</td>
						<td style='text-align:right;'><?= $aktual_total; ?></td>
					</tr>
					<tr>
						<td colspan='2'>Pencapaian</td>
						<td style='text-align:right;'><?= $aktual_total - $target; ?></td>
					</tr>
					<tr>
						<td colspan='2'>Prosentase</td>
						<td style='text-align:right;'><?= number_format((($aktual_total - $target) / $target) * 100, 2); ?> %</td>
					</tr>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
<script>
		function exportTableToExcel(tableID, filename = '') {
			var downloadLink;
			var dataType = 'data:application/vnd.ms-excel';
			var tableSelect = document.getElementById(tableID);
			var tableHTML = encodeURIComponent(tableSelect.outerHTML);
			var d = new Date();

			// Specify file name
			filename = filename ? filename + '.xls' : 'Laporan Target Produk Terjual '+ d.toDateString() +'.xls';

			// Create download link element
			downloadLink = document.createElement("a");

			document.body.appendChild(downloadLink);

			if (navigator.msSaveOrOpenBlob) {
				var blob = new Blob(['\ufeff', tableHTML], {
					type: dataType
				});
				navigator.msSaveOrOpenBlob(blob, filename);
			} else {
				// Create a link to the file
				downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

				// Setting the file name
				downloadLink.download = filename;

				//triggering the function
				downloadLink.click();
			}
		}
</script>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_target_produk_terjual->terminate();
?>