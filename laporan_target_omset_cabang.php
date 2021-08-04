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
$laporan_target_omset_cabang = new laporan_target_omset_cabang();

// Run the page
$laporan_target_omset_cabang->run();

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

		$result = ExecuteRow("SELECT * FROM m_target_omset_cabang JOIN m_klinik ON m_klinik.id_klinik = m_target_omset_cabang.id_cabang WHERE MONTH(m_target_omset_cabang.tgl_awal) = '$bulan' AND YEAR(m_target_omset_cabang.tgl_awal) = '$tahun' AND m_target_omset_cabang.id_cabang='$cabang'");
		$nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik='$cabang'");
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
						<td colspan="6" style="text-align: center;">
							<div class="col">
								<h4>Laporan Target Omset per Cabang</h4>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<div class="col">
								<h5>Cabang : <?php echo $nama_klinik; ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="6">
							<div class="col">
								<h5>Periode : <?php echo tgl_indo($periode); ?></h5>
							</div>
						</td>
					</tr>
					<tr style="background-color:#b7d8dc;">
						<td></td>
						<td></td>
						<td>Aktual</td>
						<td>Pencapaian</td>
						<td>Prosentase</td>
						<td>Rank</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="mso-number-format:'.$mso.'">
							<div class="col">
								<h5>Target</h5>
							</div>
						</td>
						<td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
								<?php
									if(is_null($result) || $result == false){
										echo "0";
									} else {
										echo rupiah($result['target']); 
									}
								?>
								</h5>
							</div>
						</td>
						<td rowspan="3" class="text-center" style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php 
										if(is_null($aktual) || $aktual == false) {
											echo "0";
										}else {
											echo rupiah($aktual);	
										}
									?>
								</h5>
							</div>
						</td>
						<td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php 
										if(is_null($result) || $result == false){
											echo "0";
										} else {
											$pencapaian = $aktual - $result['target'];

											if($pencapaian <= 0) {
												echo "<p style='color:red;'>".rupiah($pencapaian)."</p>";
											} else {
												echo "<p style='color:green;'>".rupiah($pencapaian)."</p>";
											}
										}
									?>
								</h5>
							</div>
						</td>
						<td style="text-align: right;">
							<div class="col">
								<h5>
									<?php
										if(is_null($result) || $result == false){
											echo "0%";
										} else {										
											if($aktual >= $result['target']){
												$prosentase = ($aktual - $result['target']) / $result['target'] * 100 + 100;
												if($prosentase <= 0){
													echo "<p style='color:red;'>".number_format($prosentase, 2)."%</p>";
												} else {
													echo "<p style='color:green;'>".number_format($prosentase, 2)."%</p>";
												}
												// echo round(($aktual - $result['target']) / $result['target'] * 100); 
											} else {
												$prosentase = ($aktual - $result['target']) / $result['target'] * 100;
												if($prosentase <= 0){
													echo "<p style='color:red;'>".number_format($prosentase, 2)."%</p>";
												} else {
													echo "<p style='color:green;'>".number_format($prosentase, 2)."%</p>";
												}
												// echo round(($aktual - $result['target']) / $result['target'] * 100); 
											}
										}
									?>
								</h5>
							</div>
						</td>
						<td rowspan="3" class="text-center">
							<?php
								if($aktual != false AND $result != false){
									if(($aktual >= $result['aset']) AND ($aktual <= $result['baseline'])){
										echo "Aset";
									} else if(($aktual >= $result['baseline']) AND ($aktual <= $result['target'])){
										echo "Baseline";
									} else if(($aktual >= $result['target'])){
										echo "Target";
									}
								}
							?>
						</td>																		
					</tr>
					<tr>
						<td>
							<div class="col">
								<h5>Baseline</h5>
							</div>
						</td>
						<td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php 
										if(is_null($result) || $result == false){
											echo "0";
										} else {
											echo rupiah($result['baseline']); 
										}
									?>
								</h5>
							</div>
						</td>
						<!-- <td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php 
										if(is_null($aktual) || $aktual == false) {
											echo "0";
										}else {
											echo rupiah($aktual);	
										}
									?>
								</h5>
							</div>
						</td> -->
						<td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php 
										if(is_null($result) || $result == false){
											echo "0";
										} else{
											$pencapaian_baseline = $aktual - $result['baseline'];
											if($pencapaian_baseline <= 0) {
												echo "<p style='color:red;'>".rupiah($pencapaian_baseline)."</p>";
											} else {
												echo "<p>".rupiah($pencapaian_baseline)."</p>";
											}
										}
									?>
								</h5>
							</div>
						</td>
						<td style="text-align: right;">
							<div class="col">
								<h5>
									<?php
										if(is_null($result) || $result == false){
											echo "0%";
										}else {
											if($aktual >= $result['baseline']){
												$prosentase_baseline = ($aktual - $result['baseline']) / $result['baseline'] * 100 + 100;
												if($prosentase_baseline <= 0){
													echo "<p style='color:red;'>".number_format($prosentase_baseline, 2)."%</p>";
												} else {
													echo "<p>".number_format($prosentase_baseline, 2)."%</p>";
												}
												// echo round(($aktual - $result['target']) / $result['target'] * 100); 
											} else {
												$prosentase_baseline = ($aktual - $result['baseline']) / $result['baseline'] * 100;
												if($prosentase_baseline <= 0){
													echo "<p style='color:red;'>".number_format($prosentase_baseline, 2)."%</p>";
												} else {
													echo "<p>".number_format($prosentase_baseline, 2)."%</p>";
												}
												// echo round(($aktual - $result['target']) / $result['target'] * 100); 
											}
										}
									?>
								</h5>
							</div>
						</td>																			
					</tr>
					<tr>
						<td>
							<div class="col">
								<h5>Aset</h5>
							</div>
						</td>
						<td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php
										if(is_null($result) || $result == false ){
											echo "0";
										} else {
											echo rupiah($result['aset']); 
										}
									?>
								</h5>
							</div>
						</td>
						<!-- <td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php 
										if(is_null($aktual) || $aktual == false) {
											echo "0";
										}else {
											echo rupiah($aktual);	
										}
									?>
								</h5>
							</div>
						</td> -->
						<td style="text-align: right; mso-number-format:\@">
							<div class="col">
								<h5>
									<?php
										if(is_null($result) || $result == false){
											echo "0";
										} else {
											$pencapaian_aset = $aktual - $result['aset'];
											if($pencapaian_aset <= 0) {
												echo "<p style='color:red;'>".rupiah($pencapaian_aset)."</p>";
											} else {
												echo "<p>".rupiah($pencapaian_aset)."</p>";
											}
										}
									?>
								</h5>
							</div>
						</td>
						<td style="text-align: right;">
							<div class="col">
								<h5>
									<?php
										if(is_null($result) || $result == false){
											echo "0%";
										} else {
											if($aktual >= $result['aset']){
												$prosentase_aset = ($aktual - $result['aset']) / $result['aset'] * 100 + 100;
												if($prosentase_aset <= 0){
													echo "<p style='color:red;'>".number_format($prosentase_aset, 2)."%</p>";
												} else {
													echo "<p>".number_format($prosentase_aset, 2)."%</p>";
												}
												// echo round(($aktual - $result['target']) / $result['target'] * 100); 
											} else {
												$prosentase_aset = ($aktual - $result['aset']) / $result['aset'] * 100;
												if($prosentase_aset <= 0){
													echo "<p style='color:red;'>".number_format($prosentase_aset, 2)."%</p>";
												} else {
													echo "<p>".number_format($prosentase_aset, 2)."%</p>";
												}
												// echo round(($aktual - $result['target']) / $result['target'] * 100); 
											}
										}
									?>
								</h5>
							</div>
						</td>																		
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
			filename = filename ? filename + '.xls' : 'Laporan Target Omset Cabang '+ d.toDateString() +'.xls';

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
$laporan_target_omset_cabang->terminate();
?>