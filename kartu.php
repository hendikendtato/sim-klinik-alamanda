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
$kartu = new kartu();

// Run the page
$kartu->run();

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
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];
		$Input  = $_POST['Inputbarang'];
		$Inputklinik = $_POST['Inputklinik'];
		$multi_klinik = "";
		$nama_cabang = "";
		$and="";

		foreach($Inputklinik AS $in_klinik) {
			$multi_klinik .= "m_klinik.id_klinik = '" .$in_klinik. "' OR ";
			$nama_cabang .= "id_klinik= '" .$in_klinik. "' OR ";
			//var_dump($multi_klinik); die();
			//echo $in_klinik;
		}

		if ($_POST['InputOrderBy'] != null) {
			$orderBy = $_POST['InputOrderBy'];
			$and .= ", m_barang.$orderBy";
		}

		if ($_POST['InputAscDesc'] != null) {
			$orderAscDesc = $_POST['InputAscDesc'];
			$and .= " $orderAscDesc";
		}

		if($multi_klinik){
			$multi_klinik = substr($multi_klinik, 0, -4);
			//var_dump($multi_klinik); die();

			if ($Input == "All") {
				$query = "(SELECT 'kartustok' AS TYPE, kartustok.id_barang, m_barang.nama_barang, kartustok.id_kartustok, m_klinik.nama_klinik, kartustok.tanggal, terimabarang.no_terima, terimagudang.kode_terimagudang, penjualan.kode_penjualan, kirimbarang.no_kirimbarang, returbarang.kode, penyesuaianstok.kode_penyesuaian, kartustok.stok_awal, kartustok.masuk, kartustok.masuk_penyesuaian, kartustok.keluar, kartustok.keluar_nonjual, kartustok.keluar_penyesuaian, kartustok.keluar_kirim, kartustok.retur, kartustok.stok_akhir  FROM kartustok
				JOIN m_barang ON m_barang.id = kartustok.id_barang
				JOIN m_klinik ON m_klinik.id_klinik = kartustok.id_klinik
				LEFT JOIN terimabarang ON kartustok.id_terimabarang = terimabarang.id
				LEFT JOIN penjualan ON kartustok.id_penjualan = penjualan.id
				LEFT JOIN kirimbarang ON kartustok.id_kirimbarang = kirimbarang.id
				LEFT JOIN returbarang ON kartustok.id_retur = returbarang.id_retur
				LEFT JOIN penyesuaianstok ON kartustok.id_penyesuaian = penyesuaianstok.id_penyesuaianstok
				LEFT JOIN terimagudang ON kartustok.id_terimagudang = terimagudang.id_terimagudang
				WHERE (kartustok.tanggal BETWEEN '$dateFrom' AND '$dateTo') AND ($multi_klinik) ORDER BY $and)
				UNION ALL
				(SELECT 'm_hargajual', id_barang, m_barang.nama_barang, NULL, m_klinik.nama_klinik, NULL, NULL, NULL, NULL, NULL, NULL, NULL,  m_hargajual.stok, NULL, NULL, NULL, NULL, NULL, NULL, NULL, m_hargajual.stok FROM m_hargajual
				LEFT JOIN m_barang ON m_hargajual.id_barang = m_barang.id
				LEFT JOIN m_klinik ON m_hargajual.id_klinik = m_klinik.id_klinik
				WHERE m_hargajual.id_barang NOT IN(SELECT id_barang FROM kartustok JOIN m_klinik ON m_klinik.id_klinik = kartustok.id_klinik WHERE (tanggal BETWEEN '$dateFrom' AND '$dateTo') AND ($multi_klinik)) AND ($multi_klinik) ORDER BY $and)";
				$result = ExecuteRows($query);
				//print_r($query);
			} else {
				$query = "SELECT kartustok.*, m_barang.*, m_klinik.nama_klinik, penjualan.kode_penjualan, returbarang.kode, terimabarang.no_terima, terimagudang.kode_terimagudang, kirimbarang.no_kirimbarang, penyesuaianstok.kode_penyesuaian 
						FROM kartustok 
						LEFT JOIN m_barang ON kartustok.id_barang = m_barang.id 
						LEFT JOIN m_klinik ON kartustok.id_klinik = m_klinik.id_klinik 
						LEFT JOIN penjualan ON kartustok.id_penjualan = penjualan.id 
						LEFT JOIN returbarang ON kartustok.id_retur = returbarang.id_retur
						LEFT JOIN terimabarang ON kartustok.id_terimabarang = terimabarang.id
						LEFT JOIN kirimbarang ON kartustok.id_kirimbarang = kirimbarang.id
						LEFT JOIN penyesuaianstok ON kartustok.id_penyesuaian = penyesuaianstok.id_penyesuaianstok
						LEFT JOIN terimagudang ON kartustok.id_terimagudang = terimagudang.id_terimagudang
						WHERE (kartustok.tanggal BETWEEN '$dateFrom' AND '$dateTo') AND m_barang.nama_barang = '$Input' AND ($multi_klinik) ORDER BY kartustok.tanggal ASC, kartustok.id_kartustok ASC $and";
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
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Barang" id='barang' name="Inputbarang">
								<div class="input-group-append">
									<button class="btn btn-outline-info" type="button" id="button-addon2" data-toggle="modal" data-target="#modal"><i class="fas fa-search ew-icon"></i></button>
								</div>
								<input type="hidden" class="form-control" placeholder="Barang" id='id_barang'>
							</div>		
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

						<!-- Date -->
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
								<td colspan="19" style="text-align: center;">
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
										<?php if($dateTo != ''): ?>
											<p id="tgl-laporan"><?php echo tgl_indo($dateFrom) . " hingga " . tgl_indo($dateTo); ?></p>
										<?php else: ?>
											<p id="tgl-laporan">-</p>
										<?php endif; ?>
									</div>
								</td>
							</tr>
							<tr style="background-color:#b7d8dc;">
								<th>No</th>
								<th>Nama barang</th>
								<th>Klinik</th>
								<th>Tanggal</th>
								<th>Kode Terima</th>
								<th>Kode Terima Gudang</th>
								<th>Kode Penjualan</th>
								<th>Kode Kirim</th>
								<th>Kode Retur</th>
								<th>Kode Penyesuaian</th>
								<th>Stok Awal</th>
								<th>Masuk</th>
								<th>Masuk Penyesuaian</th>
								<th>Keluar Penjualan</th>
								<th>Keluar Non Jual</th>
								<th>Keluar Penyesuaian</th>
								<th>Keluar Kirim</th>
								<th>Retur</th>
								<th>Stok Akhir</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								if (is_null($result) OR $result == false) {
									echo '<tr><td  colspan="19" align="center">Kosong</td></tr>';							
								}else{
									foreach ($result as $rs) {
											$stok_akhir = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = ".$rs['id_barang']." ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1 ");																				
										echo "<tr>
												<td align='center'>" . $no . ".</td>
												<td align='center'>" . $rs["nama_barang"] . "</td>
												<td align='center'>" . $rs["nama_klinik"] . "</td>
												<td align='center'>" . $rs["tanggal"] . "</td>
												<td align='center'>"; 	if(is_null($rs["no_terima"])){
																		echo "-----:-----";
																		}else{
																			echo $rs["no_terima"];
																		}echo "</td>
												<td align='center'>"; 	if(is_null($rs["kode_terimagudang"])){
																		echo "-----:-----";
																		}else{
																			echo $rs["kode_terimagudang"];
																		}echo "</td>
												<td align='center'>" ; 	if(is_null($rs["kode_penjualan"])){
																		echo "-----:-----";
																	}else{
																		echo $rs["kode_penjualan"];
																		}echo  "</td>
																		<td align='center'>" ; 	if(is_null($rs["no_kirimbarang"])){
																		echo "-----:-----";
																		}else{
																		echo $rs["no_kirimbarang"];
																		}echo  "</td>
																		<td align='center'>" ; 	if(is_null($rs["kode"])){
																		echo "-----:-----";
																		}else{
																			echo $rs["kode"];
																		}echo "</td>
												<td align='center'>" ; 	if(is_null($rs["kode_penyesuaian"])){
																		echo "-----:-----";
																	}else{
																		echo $rs["kode_penyesuaian"];
																		}echo "</td>
												<td align='center'>" . $rs["stok_awal"] . "</td>								
												<td align='center'>" ; 	if(is_null($rs["masuk"])){
																		echo "0.00";
																		}else{
																		echo $rs["masuk"];
																	}echo  "</td>
												<td align='center'>" ; 	if(is_null($rs["masuk_penyesuaian"])){
																		echo "0.00";
																		}else{
																			echo $rs["masuk_penyesuaian"];
																		}echo  "</td>
												<td align='center'>" ; 	if(is_null($rs["keluar"])){
																		echo "0.00";
																		}else{
																		echo $rs["keluar"];
																	}echo  "</td>																
												<td align='center'>" ; 	if(is_null($rs["keluar_nonjual"])){
																		echo "0.00";
																		}else{
																		echo $rs["keluar_nonjual"];
																	}echo  "</td>
												<td align='center'>" ; 	if(is_null($rs["keluar_penyesuaian"])){
																		echo "0.00";
																	}else{
																		echo $rs["keluar_penyesuaian"];
																		}echo  "</td>
																		<td align='center'>" ; 	if(is_null($rs["keluar_kirim"])){
																		echo "0.00";
																		}else{
																		echo $rs["keluar_kirim"];
																	}echo  "</td>
												<td align='center'>" ; 	if(is_null($rs["retur"])){
																		echo "0.00";
																		}else{
																			echo $rs["retur"];
																		}echo  "</td>
												<td align='center'>" . $rs["stok_akhir"] . "</td>
											</tr>" ;
											$no++;
									}
								}						
							?>
						</tbody>
					</table>


			<?php endif; ?>

			<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
			<script src="jquery/jquery.js"></script>

			<div id="modal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form role="form" id="form-tambah" method="post" action="input.php">
						<div class="modal-header text-center">
							<h3 class="modal-title">Pilih Produk</h3>
						</div>
							<div class="modal-body">
							
									<table width="100%" class="table table-hover"  id="example">
										<thead>
											<tr>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr id="barang" data-kode="All" name='All'>
												<td>All</td> 
											</tr>
											<?php
												$sql = "SELECT * FROM m_barang WHERE tipe != 'Perawatan' ORDER BY id ASC";
												$res = ExecuteRows($sql);
												foreach ($res as $rs) {
													echo "<tr id='barang' data-kode='".$rs['id']."' name='".$rs['nama_barang']."'>
																<td>".$rs['nama_barang']."</td>
														</tr>";
												}
											?>

										</tbody>
									</table>
							
							
							</div> 
						
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>
					</div>
				</div>
			</div>
					
			<script type="text/javascript" src="plugins/datatables/datatables.min.js"></script>


			<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
			<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
			<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
			<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/id.js" type="text/javascript"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script> -->

			<script>
				function exportTableToExcel(tableID, filename = '') {
					var downloadLink;
					var dataType = 'data:application/vnd.ms-excel';
					var tableSelect = document.getElementById(tableID);
					var tableHTML = encodeURIComponent(tableSelect.outerHTML);
					var d = new Date();

					// Specify file name
					filename = filename ? filename + '.xls' : 'Laporan Kartu Stok '+ d.toDateString() +'.xls';

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
			<script>
				$(document).ready(function(){
					$('#example').DataTable({
						"ordering": false
					});

					$(document).on('click', '#barang', function (e) {
						document.getElementById("barang").value = $(this).attr('name');
						document.getElementById("id_barang").value = $(this).attr('data-kode');
						$('#modal').modal('hide');
					});
				});
			</script>
			<script>
				$(document).ready(function(){
					$(document).on('click', '#barang', function (e) {
						document.getElementById("barang").value = $(this).attr('name');
						document.getElementById("id_barang").value = $(this).attr('data-kode');
						$('#modal').modal('hide');
					});
				});
			</script>
		</div>
	</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$kartu->terminate();
?>