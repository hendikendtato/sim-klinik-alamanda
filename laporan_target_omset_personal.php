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
						<td colspan="4" style="text-align: center;">
							<div class="col">
								<h4>Laporan Target Omset Personal</h4>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="col">
								<h5>Cabang : <?php echo $nama_klinik; ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<div class="col">
								<h5>Periode : <?php echo tgl_indo($periode); ?></h5>
							</div>
						</td>
					</tr>
					<tr>
						<th>No</th>
						<th>Jabatan</th>
						<th>Nama</th>
						<th></th>
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
								$pegawai = ExecuteRow("SELECT m_jabatan.id AS id_jabatan, m_jabatan.nama_jabatan, m_pegawai.* FROM m_pegawai JOIN m_jabatan ON m_pegawai.jabatan_pegawai = m_jabatan.id WHERE m_pegawai.id_pegawai = '".$rs['komisi_recall']."' AND m_pegawai.status == 'Aktif' ORDER BY m_jabatan.id");																				
								$target = ExecuteRow("SELECT * FROM m_target_omset_personal WHERE id_jabatan = '".$pegawai['id_jabatan']."' AND id_cabang = '$cabang' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
								$aktual = ExecuteScalar("SELECT sum(detailpenjualan.subtotal) FROM detailpenjualan 
								JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND detailpenjualan.komisi_recall = '".$rs['komisi_recall']."'");
								echo "<tr id=".$rs['komisi_recall'].">
										<td align='center'>" . $no . ".</td>
										<td align='center'>" . $pegawai['nama_jabatan'] . "</td>
										<td align='center'>" . $pegawai['nama_pegawai'] . "</td>
										<td align='center'><button class='btn btn-link' onclick='showDetails(".$rs['komisi_recall'].");'>detail</button></td>
									</tr>
									<tr id='".$rs['komisi_recall']."_detil' class='collapse'>
										<td class='ew-table-last-col' colspan=8>
											<div>
												<table class='table'>
													<thead>
														<th></th>
														<th></th>
														<th>Aktual</th>
														<th>Pencapaian</th>
														<th>Prosentase</th>
														<th>Rank</th>
													</thead>
													<tbody>";
														$id_jabatan = ExecuteScalar("SELECT m_jabatan.id AS id_jabatan FROM m_pegawai JOIN m_jabatan ON m_pegawai.jabatan_pegawai = m_jabatan.id WHERE m_pegawai.id_pegawai = '".$rs['komisi_recall']."'");
														$detail_target = ExecuteRow("SELECT * FROM m_target_omset_personal WHERE id_jabatan = '".$id_jabatan."' AND id_cabang = '$cabang' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
														$aktual_detail = ExecuteScalar("SELECT sum(detailpenjualan.subtotal) FROM detailpenjualan 
														JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND detailpenjualan.komisi_recall = '".$rs['komisi_recall']."'");
														// print_r($detail_target);
														echo "<tr>
															<td>Target</td>		
															<td align='center' style='mso-number-format:".$mso."'>";if(is_null($detail_target) || $detail_target == false){
																echo "0";
															} else {
																echo rupiah($detail_target['target']);
															} echo"</td>		
															<td rowspan='3' align='center' style='mso-number-format:".$mso."'>";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0";
															} else {
																echo rupiah($aktual_detail);
															} echo"</td>		
															<td align='center' style='mso-number-format:".$mso."'>";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0";
															} else {
																if(is_null($detail_target) || $detail_target == false){
																	echo "0";
																} else {
																	$pencapaian_target = $aktual_detail - $detail_target['target'];
																	if($pencapaian_target <= '0'){
																		echo "<b style='color:red;'>".rupiah($pencapaian_target)."</b>";
																	} else {
																		echo "<b style='color:green'>".rupiah($pencapaian_target)."</b>";
																	}
																}
															} echo"</td>		
															<td>";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0%";
															} else {
																if($detail_target == false){
																	echo "0%";
																} else {
																	if(is_null($detail_target['target']) || $detail_target['target'] == false){
																		echo "0%";
																	} else {
																		if($aktual_detail >= $detail_target['target']){
																			$prosentase_target = (($aktual_detail - $detail_target['target']) / $detail_target['target']) * 100 + 100;
																			if($prosentase_target <= '0'){
																				echo "<b style='color:red;'>".number_format($prosentase_target, 2)."%</b>";
																			} else {
																				echo "<b style='color:green;'>".number_format($prosentase_target, 2)."%</b>";
																			}
																		} else {
																			$prosentase_target = (($aktual_detail - $detail_target['target']) / $detail_target['target']) * 100;
																			if($prosentase_target <= '0'){
																				echo "<b style='color:red;'>".number_format($prosentase_target, 2)."%</b>";
																			} else {
																				echo "<b style='color:green;'>".number_format($prosentase_target, 2)."%</b>";
																			}																		}
																	}
																}
															} echo"</td>
															<td rowspan='3' class='text-center'>"; if($aktual_detail != false AND $detail_target != false){
																if(($aktual_detail >= $detail_target['aset']) AND ($aktual_detail <= $detail_target['baseline'])){
																	echo "Aset";
																} else if(($aktual_detail >= $detail_target['baseline']) AND ($aktual_detail <= $detail_target['target'])){
																	echo "Baseline";
																} else if($aktual_detail >= $detail_target['target']){
																	echo "Target";
																} else if($aktual_detail < $detail_target['aset']){
																	echo "-";
																}
															}echo"</td>		
														</tr>
														<tr>
															<td>Baseline</td>		
															<td align='center' style='mso-number-format:".$mso."'>";if(is_null($detail_target) || $detail_target == false){
																echo "0";
															} else {
																echo rupiah($detail_target['baseline']);
															} echo"</td>				
															<td align='center' style='mso-number-format:".$mso."'>";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0";
															} else {
																if(is_null($detail_target) || $detail_target == false){
																	echo "0";
																} else {
																	echo rupiah($aktual_detail - $detail_target['baseline']);
																}
															} echo"</td>		
															<td>";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0%";
															} else {
																if($detail_target == false){
																	echo "0%";
																} else {
																	if(is_null($detail_target['baseline']) || $detail_target['baseline'] == false){
																		echo "0%";
																	} else {
																		if($aktual_detail >= $detail_target['baseline']){
																			echo number_format((($aktual_detail - $detail_target['baseline']) / $detail_target['baseline']) * 100 + 100, 2) . "%";
																		} else {
																			echo number_format((($aktual_detail - $detail_target['baseline']) / $detail_target['baseline']) * 100, 2) . "%";
																		}
																	}
																}
															} echo"</td>
														</tr>
														<tr>
															<td>Aset</td>		
															<td align='center' style='mso-number-format:".$mso."'>";if(is_null($detail_target) || $detail_target == false){
																echo "0";
															} else {
																echo rupiah($detail_target['aset']);
															} echo"</td>				
															<td align='center' style='mso-number-format:".$mso."'>
															";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0";
															} else {
																if(is_null($detail_target) || $detail_target == false){
																	echo "0";
																} else {
																	echo rupiah($aktual_detail - $detail_target['aset']);
																}
															} echo"</td>		
															<td>";if(is_null($aktual_detail) || $aktual_detail == false){
																echo "0%";
															} else {
																if($detail_target == false){
																	echo "0%";
																} else {
																	if(is_null($detail_target['aset']) || $detail_target['aset'] == false){
																		echo "0%";
																	} else {
																		if($aktual_detail >= $detail_target['aset']){
																			echo number_format((($aktual_detail - $detail_target['aset']) / $detail_target['aset']) * 100 + 100, 2) . "%";
																		} else {
																			echo number_format((($aktual_detail - $detail_target['aset']) / $detail_target['aset']) * 100, 2) . "%";
																		}
																	}
																}
															} echo"</td>		
														</tr>";
													echo "</tbody>
												</table>
											</div>
										</td>
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

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_target_omset_personal->terminate();
?>