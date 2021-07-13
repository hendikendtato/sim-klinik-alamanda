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
$laporan_omset = new laporan_omset();

// Run the page
$laporan_omset->run();

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

		$multi_cabang = "";
		$nama_cabang = "";
		$and_nominal = "";
		
		if(isset($_POST['nominal'])){
			$nominal = $_POST['nominal'];
			if($nominal == '0-200000'){
				$explode = explode("-", $nominal);
				$and_nominal = 'AND (penjualan.total >= '.$explode[0].' AND penjualan.total <= '.$explode[1].')';
			}
			else if($nominal == '201000-500000'){
				$explode = explode("-", $nominal);
				$and_nominal = 'AND (penjualan.total >= '.$explode[0].' AND penjualan.total <= '.$explode[1].')';
			}
			else if($nominal == '501000-1000000'){
				$explode = explode("-", $nominal);
				$and_nominal = 'AND (penjualan.total >= '.$explode[0].' AND penjualan.total <= '.$explode[1].')';
			}
			else if($nominal == '1000000-2000000'){
				$explode = explode("-", $nominal);
				$and_nominal = 'AND (penjualan.total >= '.$explode[0].' AND penjualan.total <= '.$explode[1].')';
			}
			else if($nominal == 'All'){
				$and_nominal = '';
			}
		}

		foreach($cabang AS $in_cabang) {
			$multi_cabang .= "m_klinik.id_klinik = '" .$in_cabang. "' OR ";
			$nama_cabang .= "id_klinik = '" .$in_cabang. "' OR ";
			//var_dump($multi_klinik); die();
			//echo $in_klinik;
		}		

		if($multi_cabang){
			$multi_cabang = substr($multi_cabang, 0, -4);		
		
			$query = "SELECT penjualan.id AS id_penjualan, penjualan.waktu, m_pelanggan.*, m_tipepelanggan.nama_tipe, m_jenis_member.nama_member FROM penjualan
			JOIN m_klinik ON m_klinik.id_klinik = penjualan.id_klinik
			JOIN m_pelanggan ON m_pelanggan.id_pelanggan = penjualan.id_pelanggan
			LEFT JOIN m_tipepelanggan ON m_pelanggan.tipe = m_tipepelanggan.id_tipe 
			LEFT JOIN m_member ON m_member.id_pelanggan = m_pelanggan.id_pelanggan 
			LEFT JOIN m_jenis_member ON m_member.jenis_member = m_jenis_member.id_jenis_member
			WHERE (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND ($multi_cabang)  $and_nominal GROUP BY penjualan.id_pelanggan";
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
					<li class="d-inline-block">
						<label class="d-block">Nominal</label>
						<select class="custom-select" name="nominal">
							<option selected>Please Select</option>
							<option value="All">All</option>
							<option value="0-200000">0 - 200,000</option>
							<option value="201000-500000">201,000 - 500,000</option>
							<option value="501000-1000000">501,000 - 1,000,000</option>
							<option value="1000000-2000000">1,000,000- 2,000,000</option>
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
							<h5>Laporan Omset per Customer</h5>
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
					<th>Pelanggan</th>
					<th>Nomor Hp</th>
					<th>Status Pelanggan</th>
					<th>Jenis Member</th>
					<th>Jumlah Total</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				if (is_null($result) OR $result == false) {
					echo '<tr><td  colspan="12" align="center">Kosong</td></tr>';							
				}else{
					$mso='"\@"';
					// $jumlah_total = 0;	
					foreach ($result as $rs) {
					

					$jumlah_total = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_pelanggan = '".$rs['id_pelanggan']."' AND id = '".$rs['id_penjualan']."'");
					
					echo "<tr id=".$rs["id_pelanggan"].">
						<td>"; 
							if(is_null($rs["nama_pelanggan"])){
							echo "Tidak Ada Nilai";
							}else{
							echo $rs["nama_pelanggan"];
							}echo
						"</td>
						<td>"; 
							if(is_null($rs["hp_pelanggan"])){
							echo "-";
							}else{
							echo $rs["hp_pelanggan"];
							}echo
						"</td>
						<td>"; 
							if(is_null($rs["nama_tipe"])){
							echo "-";
							}else{
							echo $rs["nama_tipe"];
							}echo
						"</td>
						<td>"; 
							if(is_null($rs["nama_member"])){
							echo "-";
							}else{
							echo $rs["nama_member"];
							}echo
						"</td>
						<td style='mso-number-format:".$mso."'>"; 
							if(is_null($jumlah_total)){
							echo "Tidak Ada Nilai";
							}else{
							echo rupiah($jumlah_total);
							}echo
						"</td>
							<td align='center'>
								<button class='btn btn-link' onclick='showDetails(".$rs["id_pelanggan"].");'>
									detail
								</button>
							</td>
						</tr>
						<tr id='".$rs["id_pelanggan"]."_detil' class='collapse'>
							<td colspan='5'>
								<div>
									<table class='table table-bordered'>
										<thead>
											<tr>
												<th>Kode Penjualan</th>
												<th>Tanggal</th>
												<th>Total</th>		
												<th></th>		
											</tr>
										</thead>
										<tbody>";
										$details = ExecuteRows("SELECT * FROM penjualan WHERE id_pelanggan = '".$rs['id_pelanggan']."' AND id = '".$rs['id_penjualan']."'");
										// print_r($details);
										if(is_null($details) OR $details == FALSE){
											echo '<tr><td  colspan="5" align="center">Kosong</td></tr>';							
										} else {
											foreach ($details as $row) {
												echo "<tr id=".$row["id"].">
													<td>".$row["kode_penjualan"]."</td>
													<td>".$row["waktu"]."</td>
													<td style='mso-number-format:".$mso."'>".rupiah($row["total"])."</td>
													<td align='center'>
														<button class='btn btn-link' onclick='subDetails(".$row["id"].");'>
															detail
														</button>
													</td>
												</tr>
												<tr id='".$row["id"]."_subdetil' class='collapse'>
													<td colspan='5'>
														<div>
															<table class='table table-bordered'>
																<thead>
																	<tr>
																		<th>Nama Barang</th>	
																	</tr>
																</thead>
																<tbody>";
																	$detail_barang = ExecuteRows("SELECT * FROM detailpenjualan JOIN m_barang ON m_barang.id = detailpenjualan.id_barang WHERE id_penjualan = '".$row['id']."'");
																		foreach ($detail_barang as $barang) {
																			echo "<tr>
																				<td>".$barang['nama_barang']."</td>
																			</tr>";
																		}
																	echo "</tbody>
															</table>
														</div>
													</td>
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
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
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
				filename = filename ? filename + '.xls' : 'Laporan Omset per Customer '+ d.toDateString() +'.xls';

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
				if (!classes[1]) {
					$(`#${id}_detil`).addClass('show')
				} else {
					$(`#${id}_detil`).removeClass('show')
				}
			}

			// hide and show subdetail
			function subDetails(id) {
				var classes = $(`#${id}_subdetil`).attr("class").split(/\s+/);
				if (!classes[1]) {
					$(`#${id}_subdetil`).addClass('show')
				} else {
					$(`#${id}_subdetil`).removeClass('show')
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
$laporan_omset->terminate();
?>