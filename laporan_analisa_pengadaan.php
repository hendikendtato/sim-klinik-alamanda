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
$laporan_analisa_pengadaan = new laporan_analisa_pengadaan();

// Run the page
$laporan_analisa_pengadaan->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
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
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

  if(isset($_POST['srhDate'])){
		$cabang = $_POST['cabang'];
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];

		$query = "SELECT * FROM detailpenjualan
		JOIN penjualan ON penjualan.id=detailpenjualan.id_penjualan
		JOIN m_barang ON m_barang.id= detailpenjualan.id_barang
		LEFT JOIN m_klinik ON m_klinik.id_klinik=penjualan.id_klinik
		LEFT JOIN m_hargajual ON m_hargajual.id_barang=m_barang.id
		WHERE (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND penjualan.id_klinik='$cabang' AND m_hargajual.minimum_stok != ''
		GROUP BY detailpenjualan.id_barang ORDER BY detailpenjualan.id_barang ASC";
		$result = ExecuteRows($query);

  }

  function rupiah($angka){
	$hasil_rupiah = number_format($angka);
	return $hasil_rupiah;
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
				<select class="form-control product-select" name="cabang">
					<option value="">Please Select</option>
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
				<label class="d-block">Date Range</label>
				<input type="date" class="form-control input-md" name="dateFrom">
		  </li>
		  to
		  <li class="d-inline-block">
				<input type="date" class="form-control input-md" name="dateTo">
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
		<!-- Button Print -->
		<button class="btn btn-info btn-md p-2 mb-3" onclick="exportTableToExcel('printTable')">
			Export to Excel
			<i class="far fa-file-excel"></i>
		</button>			
	  <table class="table table-bordered table-hover table-striped" id="printTable">
		<thead>
			<tr>
				<td colspan="6" style="text-align: center;">
					<div class="col">
						<h5>Laporan Analisa Pengadaan</h5>
						<h5>Cabang 
							<?php
								$resKlinik=ExecuteRows("SELECT * FROM m_klinik WHERE id_klinik=$cabang");
								if($resKlinik != false) {
									echo $resKlinik[0]['nama_klinik']; 
								} else {
									echo "--";
								}
							?>
						</h5>
						<?php if($dateTo != ''): ?>
							<p id="tgl-laporan"><?php echo tgl_indo($dateFrom) . " hingga " . tgl_indo($dateTo); ?></p>
						<?php else: ?>
							<p id="tgl-laporan">-</p>
						<?php endif; ?>
					</div>
				</td>
			</tr>
		  <tr style="background-color:#b7d8dc; text-align:center;">
				<th>No.</th>
				<th>Nama Barang</th>
				<th>Rata-Rata</th>
				<th>Minimum Stok</th>
				<th>Stok Sekarang</th>
				<th>Analisa Pengadaan</th>
		  </tr>
		</thead>
		<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
				echo '<tr><td  colspan="6" align="center">Kosong</td></tr>';	
				// print("<pre>".print_r($result,true)."</pre>");						
		  }else{
				// $totalcabang = 0;
				$count = 0;
				$id_barang_komposisi = ExecuteScalar("SELECT detailpenjualan.id_barang FROM detailpenjualan
				JOIN penjualan ON penjualan.id=detailpenjualan.id_penjualan
				JOIN komposisi ON komposisi.id_barang = detailpenjualan.id_barang
				LEFT JOIN detailkomposisi ON detailkomposisi.id_komposisi=komposisi.id_komposisi
				GROUP BY detailpenjualan.id_barang");
				foreach ($result as $rs) {
					// $totalcabang += $rs['subtotal'];
						if($rs['id_barang'] == $id_barang_komposisi) {
							$get_barang = ExecuteRows("SELECT m_barang.nama_barang FROM detailkomposisi JOIN m_barang ON m_barang.id=detailkomposisi.id_barang LEFT JOIN m_hargajual ON m_hargajual.id_barang=m_barang.id WHERE m_hargajual.minimum_stok != ''");
							$rata2 = ExecuteScalar("SELECT CEILING(AVG(detailpenjualan.qty)) FROM detailpenjualan
							JOIN penjualan ON detailpenjualan.id_penjualan=penjualan.id
							LEFT JOIN m_klinik ON penjualan.id_klinik=m_klinik.id_klinik 
							WHERE detailpenjualan.id_barang = ".$rs['id_barang']." AND (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND penjualan.id_klinik=$cabang ORDER BY detailpenjualan.id_barang");

						
							$minstok = ExecuteScalar("SELECT minimum_stok FROM m_hargajual WHERE id_barang=".$rs['id_barang']." AND id_klinik=".$rs['id_klinik']."");
							$stok_sekarang = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang=".$rs['id_barang']." AND id_klinik=".$rs['id_klinik']."");
							$selisih = $minstok - $rata2;
							$perhitungan = $selisih + $minstok - $stok_sekarang;
							if (is_array($get_barang) || is_object($get_barang)) {
								foreach ($get_barang as $value){
								$count += 1;
								echo "<tr>
									<td style='text-align:center;'>".$count.".</td>
									<td>";
										if($rs['id_barang'] == $id_barang_komposisi) {
											echo $value['nama_barang'];
										} else {
											echo $rs['nama_barang'];
										} echo
									"</td>
									<td style='text-align: center;'>".$rata2."</td>
									<td style='text-align: center;'>".$minstok."</td>
									<td style='text-align: center;'>".$stok_sekarang."</td>								
									<td style='text-align: center;'>";
										if(is_null($minstok)) {
											echo "--:--" ;
										}else{
											echo $perhitungan;
										}
									"</td>
								</tr>";
								}
							}
						} else {
				
							$rata2 = ExecuteScalar("SELECT CEILING(AVG(detailpenjualan.qty)) FROM detailpenjualan
							JOIN penjualan ON detailpenjualan.id_penjualan=penjualan.id
							LEFT JOIN m_klinik ON penjualan.id_klinik=m_klinik.id_klinik 
							WHERE detailpenjualan.id_barang = ".$rs['id_barang']." AND (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND penjualan.id_klinik=$cabang ORDER BY detailpenjualan.id_barang");

						
							$minstok = ExecuteScalar("SELECT minimum_stok FROM m_hargajual WHERE id_barang=".$rs['id_barang']." AND id_klinik=".$rs['id_klinik']."");
							$stok_sekarang = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang=".$rs['id_barang']." AND id_klinik=".$rs['id_klinik']."");
							$selisih = $minstok - $rata2;
							$perhitungan = $selisih + $minstok - $stok_sekarang;
							$count += 1;
							echo "<tr>
								<td style='text-align:center;'>".$count.".</td>
								<td>";
									if($rs['id_barang'] == $id_barang_komposisi) {
										echo $value['nama_barang'];
									} else {
										echo $rs['nama_barang'];
									} echo
								"</td>
								<td style='text-align: center;'>".$rata2."</td>
								<td style='text-align: center;'>".$minstok."</td>
								<td style='text-align: center;'>".$stok_sekarang."</td>								
								<td style='text-align: center;'>";
									if(is_null($minstok)) {
										echo "--:--" ;
									}else{
										echo $perhitungan;
									}
								"</td>
							</tr>";
						}

				}
			}			
		?>
		</tbody>
	  </table>
	<?php endif; ?>
	<script>

			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Analisa Pengadaan '+ d.toDateString() +'.xls';

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

		// hide and show detail
		function showDetails(id) {
			var classes = $(`#${id}_detil`).attr("class").split(/\s+/);
			if(!classes[1]) {
				$(`#${id}_detil`).addClass('show')
			} else {
				$(`#${id}_detil`).removeClass('show')
			}
		}

	</script>
  </div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_analisa_pengadaan->terminate();
?>