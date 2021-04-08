<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$laporan_diskon_harian_global = new laporan_diskon_harian_global();

// Run the page
$laporan_diskon_harian_global->run();

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
		$query = "SELECT * FROM penjualan
	  	JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik 
	  	JOIN m_pelanggan ON penjualan.id_pelanggan = m_pelanggan.id_pelanggan 
	  	JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan		
		WHERE (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND ($multi_cabang) AND (penjualan.diskon_persen != NULL OR penjualan.diskon_rupiah != NULL)";
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
													<th>Customer</th>
													<th>Bruto</th>
													<th>Disc(Rp)</th>
													<th>Disc(%)</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>";
											$cabang = $_POST['cabang'];
											$multi_cabang = "";

											foreach($cabang AS $in_cabang) {
												$multi_cabang .= "penjualan.id_klinik = '" .$in_cabang. "' OR ";
												//var_dump($multi_klinik); die();
												//echo $in_klinik;
											}
											if($multi_cabang){
												$multi_cabang = substr($multi_cabang, 0, -4);		
												$details = ExecuteRows("SELECT *
												FROM penjualan
												JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik 
	  											JOIN m_pelanggan ON penjualan.id_pelanggan = m_pelanggan.id_pelanggan 
												WHERE penjualan.waktu = '".$rs."' AND $multi_cabang AND (penjualan.diskon_persen != '0' OR penjualan.diskon_rupiah != '0')");
											}
											if (is_null($details) OR $details == false) {
												echo '<tr><td  colspan="7" align="center">Data Tidak Ada</td></tr>';
											} else {
												$jumlahBruto = 0;
												$jumlahDiscRp = 0;
												$jumlahSubtotal = 0;
												foreach ($details as $row) {
													$bruto = ExecuteScalar("SELECT SUM(subtotal) FROM detailpenjualan WHERE id_penjualan = ".$row['id']." ORDER BY id");
													echo "<tr>
														<td><a href='penjualanview.php?showdetail=detailpenjualan&amp;id=". $row["id"] ."'>".$row["kode_penjualan"]."</td>
														<td>".$row["nama_pelanggan"]."</td>
														<td align='right'>".rupiah($bruto)."</td>
														<td align='right'>".rupiah($row["diskon_rupiah"])."</td>
														<td align='right'>".$row["diskon_persen"]."</td>
														<td align='right'>".rupiah($row["total"])."</td>
													</tr>";
													$jumlahBruto += $bruto;
													$jumlahDiscRp += $row["diskon_rupiah"];
													$jumlahSubtotal += $row["total"];
												}

												echo "<tr>
													<td colspan=2 align='right'><b>Total per Tanggal :</b></td>
													<td align='right'>";
														if(isset($jumlahBruto)) {
															echo rupiah($jumlahBruto);
													  	}
														  $jumlahBruto = isset($jumlahBruto) ? $jumlahBruto : '0';
														
													echo "</td>
													<td align='right'>";
														if(isset($jumlahDiscRp)) {
															echo rupiah($jumlahDiscRp);
													  	}
														$jumlahDiscRp = isset($jumlahDiscRp) ? $jumlahDiscRp : '0';
																												  
													echo "</td>
													<td colspan=2 align='right'>";
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
				filename = filename ? filename + '.xls' : 'Laporan Diskon Harian Global'+ d.toDateString() +'.xls';

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
$laporan_diskon_harian_global->terminate();
?>