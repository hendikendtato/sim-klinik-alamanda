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
$laporan_mutasi_bank = new laporan_mutasi_bank();

// Run the page
$laporan_mutasi_bank->run();

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
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$multi_cabang = "";
	$nama_cabang = "";
	$and = "";
	
	foreach($cabang AS $in_cabang) {
		$multi_cabang .= "mutasi_kas.id_klinik = '" .$in_cabang. "' OR ";
		$nama_cabang .= "id_klinik = '" .$in_cabang. "' OR ";
		//var_dump($multi_klinik); die();
		//echo $in_klinik;
	}

	if (isset($_POST['Inputtipe'])) {
		$tipe = $_POST['Inputtipe'];
		$and .= "AND mutasi_kas.tipe = '$tipe' ";
	}

	
	if($multi_cabang){
		$multi_cabang = substr($multi_cabang, 0, -4);
		$query = "SELECT mutasi_kas.no_bukti, mutasi_kas.tgl, m_kas.nama, m_klinik.nama_klinik, mutasi_kas.tipe, jumlah, mutasi_kas.keterangan, mutasi_kas.id FROM mutasi_kas 
		JOIN detailmutasibank ON detailmutasibank.pid = mutasi_kas.id 
		JOIN m_kas ON m_kas.id = mutasi_kas.id_kas JOIN m_klinik ON m_klinik.id_klinik = mutasi_kas.id_klinik WHERE (mutasi_kas.tgl BETWEEN '$dateFrom' AND '$dateTo') AND ($multi_cabang) $and GROUP BY mutasi_kas.no_bukti";
		$result = ExecuteRows($query);
	}
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
					<!-- Input Tipe -->
					<li class="d-inline-block">
						<label class="d-block">Tipe Kas</label>
						<select class="form-control product-select" name="Inputtipe" id="tipe_mutasi">
							<option selected disabled>Select</option>
							<option value='Mutasi Kas Masuk'>Mutasi Kas Masuk</option>
							<option value='Mutasi Kas Keluar'>Mutasi Kas Keluar</option>
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
					<td colspan="9" style="text-align: center;">
						<div class="col">
							<h5>Laporan Mutasi Kas</h5>
							<h5>Cabang 
								<?php 
									if($nama_cabang){	 
										$nama_cabang = substr($nama_cabang, 0, -4);
										$klinik = ExecuteRows("SELECT nama_klinik FROM m_klinik WHERE $nama_cabang");
													
										foreach ($klinik as $value) {
											echo $value['nama_klinik'],"\n";;
										}

										
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
					<th>No. Bukti</th>
					<th>Tanggal</th>
					<th>Kas</th>
					<th>Klinik</th>
					<th>Tipe Mutasi</th>
					<th>Jumlah</th>
					<th>Keterangan</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
				echo '<tr><td  colspan="9" align="center">Kosong</td></tr>';	
				// print("<pre>".print_r($result,true)."</pre>");						
		  }else{
				// $totalcabang = 0;
				$count = 0;
				$mso='"\@"';
				foreach ($result as $rs) {
					// $totalcabang += $rs['subtotal'];
					$sum_jumlah = ExecuteScalar("SELECT SUM(jumlah) FROM detailmutasibank WHERE pid = ".$rs['id']."");
					$count += 1;
					echo "<tr id=".$rs["id"].">
							<td>".$count.".</td>
							<td>".$rs['no_bukti']."</td>
							<td>".$rs['tgl']."</td>
							<td>".$rs['nama']."</td>
							<td>".$rs['nama_klinik']."</td>
							<td>".$rs['tipe']."</td>
							<td style='text-align: right; mso-number-format:".$mso."'>".rupiah($sum_jumlah)."</td>
							<td>".$rs['keterangan']."</td>
							<td align='center'>
								<button class='btn btn-link' onclick='showDetails(".$rs["id"].");'>
									detail
								</button>
							</td>
						</tr>
						<tr id='".$rs["id"]."_detil' class='collapse'>
						<td class='ew-table-last-col' colspan='9'>
							<div>
								<table class='table'>
									<thead>
										<tr>
											<th>Akun</th>
											<th>Jumlah</th>
											<th>Keterangan</th>		
										</tr>
									</thead>
									<tbody>";
									$details = ExecuteRows("SELECT m_akun.nama_akun AS akun, detailmutasibank.nama_akun AS nama_akun, detailmutasibank.jumlah AS jumlah, detailmutasibank.keterangan AS keterangan FROM detailmutasibank LEFT JOIN m_akun ON m_akun.id_akun = detailmutasibank.akun_id WHERE pid = '".$rs["id"]."'");

									if (is_null($details) OR $details == false) {
										echo '<tr><td  colspan="3" align="center">Kosong</td></tr>';
									} else {
										foreach ($details as $row) {
											echo "<tr>
												<td>"; 
													if(is_null($row["akun"])){
														echo $row["nama_akun"];
													}else{
														echo $row["akun"];
													}echo
												"</td>
												<td style='mso-number-format:".$mso."'>".rupiah($row["jumlah"])."</td>
												<td>".$row["keterangan"]."</td>
											</tr>";
										}
									}
									echo "</tbody>
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
				filename = filename ? filename + '.xls' : 'Laporan Mutasi Kas '+ d.toDateString() +'.xls';

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
				$("#tipe_mutasi").change(function(){
					console.log($(this).val());
				});
			});

			//$('.selectpicker').selectpicker();
		</script>
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_mutasi_bank->terminate();
?>