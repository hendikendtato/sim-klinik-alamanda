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
$laporan_target_omset_personal = new laporan_target_omset_personal();

// Run the page
$laporan_target_omset_personal->run();

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
		$periode  = $_POST['periode'];
		$explode = explode('-', $periode);
		$bulan = $explode[1];
		$tahun = $explode[0];

		$result = ExecuteRows("SELECT * FROM detailpenjualan 
							JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan 
							JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik WHERE penjualan.id_klinik = '$cabang' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND detailpenjualan.komisi_recall IS NOT NULL GROUP BY detailpenjualan.komisi_recall");
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
						<td colspan="7" style="text-align: center;">
							<div class="col">
								<h4>Laporan Target Omset Personal</h4>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="7">
							<div class="col">
								<h5>Cabang : <?php echo $result[0]['nama_klinik']; ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="7">
							<div class="col">
								<h5>Periode : <?php echo tgl_indo($periode); ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>Jabatan</th>
						<th>Nama</th>
						<th>Target</th>
						<th>Aktual</th>
						<th>Pencapaian</th>
						<th>Prosentase</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						$mso='"\@"';
						if (is_null($result) OR $result == false) {
							echo '<tr><td  colspan="7" align="center">Kosong</td></tr>';							
						}else{
							foreach ($result as $rs) {
								$pegawai = ExecuteRow("SELECT m_jabatan.id AS id_jabatan, m_jabatan.nama_jabatan, m_pegawai.* FROM m_pegawai JOIN m_jabatan ON m_pegawai.jabatan_pegawai = m_jabatan.id WHERE m_pegawai.id_pegawai = '".$rs['komisi_recall']."'");																				
								$target = ExecuteRow("SELECT * FROM m_target_omset_personal WHERE id_jabatan = '".$pegawai['id_jabatan']."' AND id_cabang = '$cabang' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
								$aktual = ExecuteScalar("SELECT sum(detailpenjualan.subtotal) FROM detailpenjualan 
								JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND detailpenjualan.komisi_recall = '".$rs['komisi_recall']."'");
								echo "<tr>
										<td align='center'>" . $no . ".</td>
										<td align='center'>" . $pegawai['nama_jabatan'] . "</td>
										<td align='center'>" . $pegawai['nama_pegawai'] . "</td>
										<td align='center' style='mso-number-format:".$mso."'>" . rupiah($target['target']) . "</td>
										<td align='center' style='mso-number-format:".$mso."'>" . rupiah($aktual) . "</td>
										<td align='center' style='mso-number-format:".$mso."'>" . rupiah($aktual - $target['target']). "</td>
										<td align='center'>" . ROUND((($aktual - $target['target']) / $target['target']) * 100) . "%</td>
									</tr>" ;
								$no++;
							}
						}						
						
					?>
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
			filename = filename ? filename + '.xls' : 'Laporan Target Omset Personal '+ d.toDateString() +'.xls';

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
$laporan_target_omset_personal->terminate();
?>