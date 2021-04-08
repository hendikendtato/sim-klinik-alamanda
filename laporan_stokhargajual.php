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
$laporan_stokhargajual = new laporan_stokhargajual();

// Run the page
$laporan_stokhargajual->run();

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
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}

	if(isset($_POST['srhDate'])){
		$Input  = $_POST['Inputbarang'];
		$Inputklinik = $_POST['Inputklinik'];
		$Inputkategori = $_POST['Inputkategori'];
		$Inputsubkategori = $_POST['Inputsubkategori'];
		$multi_klinik = "";
		$nama_cabang = "";
		$and="";
		$and_kategori="";
		$and_subkategori="";

		foreach($Inputklinik AS $in_klinik) {
			$multi_klinik .= "m_hargajual.id_klinik = '" .$in_klinik. "' OR ";
			$nama_cabang .= "id_klinik= '" .$in_klinik. "' OR ";
		}

		if ($_POST['Inputkategori'] != null) {
			if($_POST['Inputkategori'] == 'All'){
				$and_kategori .= "";
			} else {
				$kategori = $_POST['Inputkategori'];
				$and_kategori .= "AND m_barang.kategori = '$kategori'";
			}
		}

		if ($_POST['Inputsubkategori'] != null) {
			if($_POST['Inputsubkategori'] == 'All'){
				$and_subkategori .= "";
			} else {
				$subkategori = $_POST['Inputsubkategori'];
				$and_subkategori .= "AND m_barang.subkategori = '$subkategori'";
			}
		}

		if ($_POST['InputOrderBy'] != null) {
			$orderBy = $_POST['InputOrderBy'];
			$and .= "ORDER BY m_barang.$orderBy";
		}

		if ($_POST['InputAscDesc'] != null) {
			$orderAscDesc = $_POST['InputAscDesc'];
			$and .= " $orderAscDesc";
		}

		if($multi_klinik){
			$multi_klinik = substr($multi_klinik, 0, -4);
			//var_dump($multi_klinik); die();

			if ($Input == "All") {
				$query = "SELECT * FROM m_hargajual 
				JOIN m_barang ON m_hargajual.id_barang = m_barang.id
				JOIN m_klinik ON m_hargajual.id_klinik = m_klinik.id_klinik
				JOIN m_satuan_barang ON m_hargajual.satuan = m_satuan_barang.id_satuan 
				WHERE ($multi_klinik) $and_kategori $and_subkategori $and";
				$result = ExecuteRows($query);
				//print_r($query);
			} else {
				$query = "SELECT * FROM m_hargajual 
				JOIN m_barang ON m_hargajual.id_barang = m_barang.id
				JOIN m_klinik ON m_hargajual.id_klinik = m_klinik.id_klinik
				JOIN m_satuan_barang ON m_hargajual.satuan = m_satuan_barang.id_satuan 
				WHERE ($multi_klinik) $and_kategori $and_subkategori $and AND m_hargajual.id_barang = '$Input'";
				$result = ExecuteRows($query);
				//print_r($query);
			}
		}

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
					<h3>Cari Data Berdasarkan</h3>
					<ul class="list-unstyled">
						<!-- Input barang -->
						<li class="d-inline-block">
							<label class="d-block">Input Barang</label>
							<select class="form-control product-select" name="Inputbarang">
									<option value="All">All</option>
								<?php
									$sql = "SELECT * FROM m_barang WHERE tipe != 'Perawatan'";
									$res = ExecuteRows($sql);
									foreach ($res as $rs) {
										echo "<option value=" . $rs["id"] . ">" . $rs["nama_barang"] . "</option>";
									}
								?>
							</select>
						</li>

						<!-- Input Klinik -->
						<li class="d-inline-block">
							<label class="d-block">Input Klinik</label>
							<select class="selectpicker" id="inputKlinik" name="Inputklinik[]" multiple="multiple" style="width:210px; height: 40px;">
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

						<!-- Input Kategori -->
						<li class="d-inline-block">
							<label class="d-block">Input Kategori</label>
							<select class="form-control product-select" name="Inputkategori">
									<option value="All">All</option>
								<?php
									$sql = "SELECT * FROM kategoribarang";
									$res = ExecuteRows($sql);
									foreach ($res as $rs) {
										echo "<option value=" . $rs["id"] . ">" . $rs["nama"] . "</option>";
									}
								?>
							</select>
						</li>

						<!-- Input Subkategori -->
						<li class="d-inline-block">
							<label class="d-block">Input Subkategori</label>
							<select class="form-control product-select" name="Inputsubkategori">
									<option value="All">All</option>
								<?php
									$sql = "SELECT * FROM subkategoribarang";
									$res = ExecuteRows($sql);
									foreach ($res as $rs) {
										echo "<option value=" . $rs["id"] . ">" . $rs["nama"] . "</option>";
									}
								?>
							</select>
						</li>

						<!-- Order By -->
						<li class="d-inline-block">
							<label class="d-block">Order By</label>
							<select class="form-control product-select" name="InputOrderBy">
								<option value="">Select</option>
								<option value="kode_barang">Kode Barang</option>
								<option value="nama_barang">Nama Barang</option>
							</select>
						</li>

						<!-- Order Asc Desc -->
						<li class="d-inline-block">
							<select class="form-control product-select" name="InputAscDesc">
								<option value="">Select</option>
								<option value="ASC">Ascending</option>
								<option value="DESC">Descending</option>
							</select>
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
				
				<?php $inputbarang = $_POST['Inputbarang']; ?>
					<table class="table table-bordered table-hover table-striped" id="printTable">
						<thead>
							<tr>
								<td colspan="11" style="text-align: center;">
									<div class="col">
										<h5>Laporan Kartu Stok</h5>
										<h5>Cabang 
											<?php 
												if($nama_cabang){	 
													$nama_cabang = substr($nama_cabang, 0, -4);
													$klinik = ExecuteRows("SELECT nama_klinik FROM m_klinik WHERE $nama_cabang");
													
													foreach ($klinik as $value) {
														echo $value['nama_klinik'],"\n";;
													}
													// if($klinik != false) {
													// 	echo "<b>".$klinik['nama_klinik']."</b>"; 
													// } else {
													// 	echo "--";
													// }
												}
											?>
										</h5>
									</div>
								</td>
							</tr>
							<tr style="background-color:#b7d8dc;">
								<th>No</th>
								<th>Nama barang</th>
								<th>Harga</th>
								<th>Diskon (%)</th>
								<th>Diskon (Rp)</th>
								<th>Klinik</th>
								<th>Stok</th>
								<th>Satuan</th>
								<th>Minimum Stok</th>
								<th>Tanggal Masuk</th>
								<th>Tanggal Expired</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								if (is_null($result) OR $result == false) {
									echo '<tr><td  colspan="11" align="center">Kosong</td></tr>';							
								}else{
									foreach ($result as $rs) {
											//$stok_akhir = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = ".$rs['id_barang']." ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1 ");																				
										echo "<tr>
												<td align='center'>" . $no . ".</td>
												<td align='center'>" . $rs["nama_barang"] . "</td>
												<td align='center'>" . $rs["totalhargajual"] . "</td>
												<td align='center'>" ; 	if(is_null($rs["disc_pr"])){
																			echo "0.00";
																		}else{
																			echo $rs["disc_pr"];
																		}echo  "</td>
												<td align='center'>" ; 	if(is_null($rs["disc_rp"])){
																			echo "0.00";
																		}else{
																			echo $rs["disc_rp"];
																		}echo  "</td>
												<td align='center'>" . $rs["nama_klinik"] . "</td>
												<td align='center'>" . $rs["stok"] . "</td>
												<td align='center'>" . $rs["nama_satuan"] . "</td>
												<td align='center'>" . $rs["minimum_stok"] . "</td>
												<td align='center'>" ; 	if(is_null($rs["tgl_masuk"])){
																			echo "-----:-----";
																		}else{
																			echo tgl_indo($rs["tgl_masuk"]);
																		}echo "</td>
												<td align='center'>" ; 	if(is_null($rs["tgl_exp"])){
																			echo "-----:-----";
																		}else{
																			echo tgl_indo($rs["tgl_exp"]);
																		}echo "</td>
											</tr>" ;
										$no++;
									}
								}						
							?>
						</tbody>
					</table>

			<?php endif; ?>

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
					filename = filename ? filename + '.xls' : 'Laporan Stok Hargajual '+ d.toDateString() +'.xls';

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
$laporan_stokhargajual->terminate();
?>