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
$laporan_diskon_harian = new laporan_diskon_harian();

// Run the page
$laporan_diskon_harian->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<?php
  if(isset($_POST['srhDate'])){
	$cabang = $_POST['cabang'];
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$multi_cabang = "";
	$nama_cabang = "";
	
	foreach($cabang AS $in_cabang) {
		$multi_cabang .= "penjualan.id_klinik = '" .$in_cabang. "' OR ";
		$nama_cabang .= "id_klinik= '" .$in_cabang. "' OR ";
		//var_dump($multi_klinik); die();
		//echo $in_klinik;
	}

	
	if($multi_cabang){
		$multi_cabang = substr($multi_cabang, 0, -4);
		$query = "SELECT * FROM detailpenjualan 
		JOIN penjualan ON penjualan.id=detailpenjualan.id_penjualan 
		WHERE (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND ($multi_cabang) AND detailpenjualan.disc_pr != NULL OR detailpenjualan.disc_rp != NULL";
		$result = ExecuteRows($query);
	}
  }

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

  	function rupiah($angka){
		$hasil_rupiah = "Rp" . number_format($angka);
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
						<select class="selectpicker" name="cabang[]" multiple style="width:210px; height: 40px;">
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
			<thead style="background-color:#b7d8dc;">
				<tr>
					<th colspan=2>Cabang : 
						<?php
							if($nama_cabang){	 
								$nama_cabang = substr($nama_cabang, 0, -4);
								$klinik = ExecuteRows("SELECT nama_klinik FROM m_klinik WHERE $nama_cabang");
								
								foreach ($klinik as $value) {
									echo $value['nama_klinik'],"\n";;
								}
							}
						?>
					</th>
				</tr>
				<tr>
					<th>Tanggal</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
					if(isset($_POST['srhDate'])){
						$start = $_POST['dateFrom']; //start date
						$end = $_POST['dateTo']; //end date

						$dates = array();
						$start = $current = strtotime($start);
						$end = strtotime($end);

						while ($current <= $end) {
							$dates[] = date('Y-m-d', $current);
							$current = strtotime('+1 days', $current);
						}

						foreach ($dates as $key=>$rs) {
						echo "<tr id=".$key.">
									<td>"; 
										if(is_null($rs)){
											echo "Tidak Ada Nilai";
										}else{
											echo tgl_indo($rs);
										}echo
									"</td>
									<td align='center'>
										<button class='btn btn-link' onclick='showDetails(".$key.");'>
											DETAIL
										</button>
									</td>
								</tr>
								
							<tr id='".$key."_detil' class='collapse'>
								<td class='ew-table-last-col' colspan=8>
									<div style='width:100%;'>
										<table class='table'>
											<thead>
												<tr>
													<th>Nomor Penjualan</th>
													<th>Barang</th>
													<th>Customer</th>
													<th>Harga Jual</th>
													<th>Disc(Rp)</th>
													<th>Disc(%)</th>
													<th>Harga Akhir</th>
												</tr>
											</thead>
											<tbody>";
											$cabang = $_POST['cabang'];
											$multi_cabang = "";
											$mso='"\@"';

											foreach($cabang AS $in_cabang) {
												$multi_cabang .= "penjualan.id_klinik = '" .$in_cabang. "' OR ";
												//var_dump($multi_klinik); die();
												//echo $in_klinik;
											}
											if($multi_cabang){
												$multi_cabang = substr($multi_cabang, 0, -4);		
												$details = ExecuteRows("SELECT penjualan.kode_penjualan, penjualan.id AS id_penjualan, m_barang.id AS id_barang, m_barang.nama_barang, m_pelanggan.nama_pelanggan, detailpenjualan.harga_jual, detailpenjualan.qty, detailpenjualan.disc_rp, detailpenjualan.disc_pr, detailpenjualan.subtotal
												FROM detailpenjualan
												JOIN penjualan ON penjualan.id=detailpenjualan.id_penjualan
												JOIN m_barang ON m_barang.id=detailpenjualan.id_barang
												LEFT JOIN m_pelanggan ON m_pelanggan.id_pelanggan=penjualan.id_pelanggan
												WHERE penjualan.waktu = '".$rs."' AND $multi_cabang AND (detailpenjualan.disc_pr != '' OR detailpenjualan.disc_rp != '')");
											}
											if (is_null($details) OR $details == false) {
												echo '<tr><td  colspan="7" align="center">Data Tidak Ada</td></tr>';
											} else {
												$jumlahHargaJual = 0;
												$jumlahDiscRp = 0;
												$jumlahSubtotal = 0;
												foreach ($details as $row) {
													$qtybeli = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_penjualan=".$row["id_penjualan"]." AND id_barang=".$row["id_barang"]." ORDER BY id");
													$harga = ExecuteScalar("SELECT harga_jual FROM detailpenjualan WHERE id_penjualan=".$row["id_penjualan"]." AND id_barang=".$row["id_barang"]." ORDER BY id");
													$hargajual = $harga * $qtybeli;
													echo "<tr>
														<td>".$row["kode_penjualan"]."</td>
														<td>".$row["nama_barang"]."</td>
														<td>".$row["nama_pelanggan"]."</td>
														<td align='right' style='mso-number-format:".$mso."'>".rupiah($hargajual)."</td>
														<td align='right' style='mso-number-format:".$mso."'>".rupiah($row["disc_rp"])."</td>
														<td align='right'>".$row["disc_pr"]."</td>
														<td align='right' style='mso-number-format:".$mso."'>".rupiah($row["subtotal"])."</td>
													</tr>";
													$jumlahHargaJual += $hargajual;
													$jumlahDiscRp += $row["disc_rp"];
													$jumlahSubtotal += $row["subtotal"];
												}

												echo "<tr>
													<td colspan=3 align='right'><b>Total per Tanggal :</b></td>
													<td align='right' style='mso-number-format:".$mso."'>";
														if(isset($jumlahHargaJual)) {
															echo rupiah($jumlahHargaJual);
													  	}
														$jumlahHargaJual = isset($jumlahHargaJual) ? $jumlahHargaJual : '0';
														
													echo "</td>
													<td align='right' style='mso-number-format:".$mso."'>";
														if(isset($jumlahDiscRp)) {
															echo rupiah($jumlahDiscRp);
													  	}
														$jumlahDiscRp = isset($jumlahDiscRp) ? $jumlahDiscRp : '0';
																												  
													echo "</td>
													<td colspan=2 align='right' style='mso-number-format:".$mso."'>";
														if(isset($jumlahSubtotal)) {
															echo rupiah($jumlahSubtotal);
													  	}
														$jumlahSubtotal = isset($jumlahSubtotal) ? $jumlahSubtotal : '0';
																													  
													echo "</td>
												</tr>";

											}
											echo "</tbody>
										</table>
									</div>
								</td>
							</tr>";
						}
					}					
				?>
			</tbody>
		</table>
		<?php endif; ?>
		<script src="plugins/print/jquery-3.5.1.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/id.js" type="text/javascript"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
		<script>
			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Diskon Harian '+ d.toDateString() +'.xls';

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
				console.log(classes);
				if (!classes[1]) {
					$(`#${id}_detil`).addClass('show')
				} else {
					$(`#${id}_detil`).removeClass('show')
				}
			}
		</script>
		<script>
			$(document).ready(function() {
				$('.selectpicker').select2({
				  	placeholder: "Select Klinik",
				  	allowClear: true,
				  	language: "id"
				});
			});

			//$('.selectpicker').selectpicker();
		</script>
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_diskon_harian->terminate();
?>