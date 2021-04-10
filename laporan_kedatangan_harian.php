<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

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
$laporan_kedatangan_harian = new laporan_kedatangan_harian();

// Run the page
$laporan_kedatangan_harian->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
  if(isset($_POST['srhDate'])){
	$cabang = $_POST['cabang'];
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	
	$query = "SELECT tanggal FROM antrian
	  WHERE (tanggal BETWEEN '$dateFrom' AND '$dateTo') AND nama_klinik = '$cabang' AND selesai = 'belum' GROUP BY tanggal ORDER BY tanggal ASC";
	  $result = ExecuteRows($query);
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
						<select class="form-control product-select" name="cabang">
							<?php
								$sql = "SELECT * FROM m_klinik";
								$res = ExecuteRows($sql);
								$get_current_id_klinik = CurrentUserInfo("id_klinik");
								$get_nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = '$get_current_id_klinik'");

								if($get_current_id_klinik != '' && $get_current_id_klinik != FALSE){
									echo "<option value=" . $get_nama_klinik . " selected>" . $get_nama_klinik . "</option>";
								} else {
									foreach ($res as $rs) {
										echo "<option value=" . $rs["nama_klinik"] . ">" . $rs["nama_klinik"] . "</option>";
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
						$cabang = $_POST['cabang'];
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
											detail
										</button>
									</td>
								</tr>
								
							<tr id='".$key."_detil' class='collapse'>
								<td class='ew-table-last-col' colspan=8>
									<div>
										<table>
											<thead>
												<tr>
													<th>Nomor Antrian</th>
													<th>Keperluan</th>
												</tr>
											</thead>
											<tbody>";
											$details = ExecuteRows("SELECT * FROM antrian WHERE tanggal = '".$rs."' AND nama_klinik = '".$cabang."'");
											if (is_null($details) OR $details == false) {
												echo '<tr><td  colspan="2" align="center">Data Tidak Ada</td></tr>';
											} else {
												foreach ($details as $row) {
													echo "<tr>
														<td>".$row["nomor_antrian"]."</td>
														<td>".$row["keperluan"]."</td>
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
			</tbody>
		</table>
		<?php endif; ?>
		<script src="plugins/print/jquery-3.5.1.js"></script>
		<script>
			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Kedatangan Harian '+ d.toDateString() +'.xls';

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
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_kedatangan_harian->terminate();
?>