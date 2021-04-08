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
$laporan_perhitungan_komisi_pegawai = new laporan_perhitungan_komisi_pegawai();

// Run the page
$laporan_perhitungan_komisi_pegawai->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
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
	$multi_cabang = "";
	$and = "";
 	$nama_cabang = "";
	
	foreach($cabang AS $in_cabang) {
	$multi_cabang .= "id_klinik = '" .$in_cabang. "' OR ";
	$nama_cabang .= "id_klinik = '" .$in_cabang. "' OR ";
	}

	if (isset($_POST['Inputpegawai'])) {
		$pegawai = $_POST['Inputpegawai'];
		$and .= "AND id_pegawai = '$pegawai' ";
	}

	if (isset($_POST['Inputjabatan'])) {
		$jabatan = $_POST['Inputjabatan'];
		$and .= "AND jabatan_pegawai = '$jabatan' ";
	}	

	
	if($multi_cabang){
		$multi_cabang = substr($multi_cabang, 0, -4);
		$query = "SELECT * FROM m_pegawai WHERE ($multi_cabang) $and";
		$result = ExecuteRows($query);
	}
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

					<!-- Input Nama Pegawai -->
					<li class="d-inline-block">
						<label class="d-block">Nama Pegawai</label>
						<select class="form-control product-select" name="Inputpegawai">
							<option selected disabled>Select</option>
							<?php
							$sql = "SELECT * FROM m_pagawai";
							$res = ExecuteRows($sql);

							foreach ($res as $rs) {
								echo "<option value=" . $rs["id_pegawai"] . ">" . $rs["nama_pagawai"] . "</option>";
							}
							?>
						</select>
					</li>

					<!-- Input Jabatan -->
					<li class="d-inline-block">
						<label class="d-block">Jabatan</label>
						<select class="form-control product-select" name="Inputjabatan">
							<option selected disabled>Select</option>
							<?php
							$sql = "SELECT * FROM m_jabatan";
							$res = ExecuteRows($sql);

							foreach ($res as $rs) {
								echo "<option value=" . $rs["id"] . ">" . $rs["nama_jabatan"] . "</option>";
							}
							?>
						</select>
					</li>

					<li class="d-inline-block">
						<label class="d-block">From Date</label>
						<input type="date" class="form-control input-md" name="dateFrom">
					</li>
					<li class="d-inline-block">
						<label class="d-block">To Date</label>
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
		<?php if(isset($_POST['srhDate'])) : 
			$dateFrom = $_POST['dateFrom'];
			$dateTo = $_POST['dateTo'];	
		?>
		
		<!-- Button Print -->
		<button class="btn btn-info btn-md p-2 mb-3" onclick="exportTableToExcel('printTable')">
			Export to Excel
			<i class="far fa-file-excel"></i>
		</button>
		<table class="table table-bordered table-hover table-striped" id="printTable">
			<thead>
				<tr>
					<td colspan="3" style="text-align: center;">
						<div class="col">
							<h5>Laporan Summary Komisi</h5>
							<h5>Cabang 
								<?php 
									if($nama_cabang != ''){	 
										$nama_cabang = substr($nama_cabang, 0, -4);
										$klinik = ExecuteRows("SELECT nama_klinik FROM m_klinik WHERE $nama_cabang");
													
										foreach ($klinik as $value) {
											echo $value['nama_klinik'],"\n";
										}
									} else {
										echo '-';
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
				<tr style="background-color:#b7d8dc;">
					<th>No.</th>
					<th>Pegawai</th>
					<!-- <th>Jabatan</th> -->
					<!-- <th>Kode Penjualan</th> -->
					<!-- <th>Total Komisi</th> -->
					<th></th>
				</tr>
			</thead>
			<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
				echo '<tr><td  colspan="5" align="center">Kosong</td></tr>';	
				// print("<pre>".print_r($result,true)."</pre>");						
		  }else{
				// $totalcabang = 0;
				$count = 0;
				foreach ($result as $rs) {
					// $totalcabang += $rs['subtotal'];
					$total_komisi = ExecuteScalar("SELECT SUM(total_komisi) FROM transaksi_komisi WHERE (tgl BETWEEN '$dateFrom' AND '$dateTo') AND id_pegawai=".$rs['id_pegawai']."");
					$count += 1;
					echo "<tr id=".$rs["id_pegawai"].">
							<td>".$count.".</td>
							<td>".$rs['nama_pegawai']."</td>
							<td align='center'>
								<button class='btn btn-link' onclick='showDetails(".$rs["id_pegawai"].");'>
									detail
								</button>
							</td>
							</tr>
							<tr id='".$rs["id_pegawai"]."_detil' class='collapse'>
							<td class='ew-table-last-col' colspan='4'>
								<div>";
								$total_komisi_recall = ExecuteScalar("SELECT SUM(total_komisi) FROM transaksi_komisi WHERE (tgl BETWEEN '$dateFrom' AND '$dateTo') AND jenis_komisi = 'Recall' AND id_pegawai = ".$rs["id_pegawai"]." ");
								$total_komisi_kinerja = ExecuteScalar("SELECT SUM(total_komisi) FROM transaksi_komisi WHERE (tgl BETWEEN '$dateFrom' AND '$dateTo') AND jenis_komisi = 'Kinerja' AND id_pegawai = ".$rs["id_pegawai"]." ");
									echo"<table class='table'>
										<tbody>
											<tr>
												<td>Total Komisi Recall</td>
												<td>:</td>
												<td>";
													if($total_komisi_recall == '' OR $total_komisi_recall == FALSE) {
														echo '0' ;
													} else {
														echo $total_komisi_recall;
													} echo
												"</td>		
											</tr>
											<tr>
												<td>Total Komisi Kinerja</td>
												<td>:</td>
												<td>";
													if($total_komisi_kinerja == '' OR $total_komisi_kinerja == FALSE) {
														echo '0' ;
													} else {
														echo $total_komisi_kinerja;
													} echo
												"</td>			
											</tr>
										</tbody>
									</table>
								</div>
							</td>
						</tr>";
				}
			}			
		?>
		  <!-- <tr>
				<td colspan="2" align="right"><b>Total per Cabang</b></td>
				<td align="right">
				<b>
					<?php 
					/*
						if(isset($totalcabang)) {
							echo rupiah($totalcabang);
						}
						$totalcabang = isset($totalcabang) ? $totalcabang : '0';
					*/
					?>
				</b>
				</td>
		  </tr> -->
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
				filename = filename ? filename + '.xls' : 'Laporan Perhitungan Komisi Pegawai '+ d.toDateString() +'.xls';

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
$laporan_perhitungan_komisi_pegawai->terminate();
?>