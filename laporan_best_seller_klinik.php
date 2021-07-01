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
$laporan_best_seller_klinik = new laporan_best_seller_klinik();

// Run the page
$laporan_best_seller_klinik->run();

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
			1 => 'Januari',
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
		$best = ($_POST['best'] == "All") ? "" : "LIMIT ".$_POST['best'];
		$Inputkategori = ($_POST['Inputkategori'] == "All") ? "" : "AND m_barang.kategori = ".$_POST['Inputkategori'];
		$Inputsubkategori = ($_POST['Inputsubkategori'] == "All") ? "" : "AND m_barang.subkategori = ".$_POST['Inputsubkategori'];
		$Input  = ($_POST['Inputbarang'] == "All" OR empty($_POST['Inputbarang'])) ? "" : "AND detailpenjualan.id_barang = ".$_POST['Inputbarang'];
		$dateFrom = !empty($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-01');
		$dateTo = !empty($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-t');

		$query = "SELECT detailpenjualan.id_barang, m_barang.kode_barang, m_barang.nama_barang, 
					SUM(detailpenjualan.qty) AS jumlah
				FROM detailpenjualan 
				JOIN penjualan ON detailpenjualan.id_penjualan = penjualan.id
				JOIN (
					SELECT id, kode_barang, nama_barang
					FROM m_barang
					WHERE  1=1 {$Inputkategori} {$Inputsubkategori}
				) m_barang ON detailpenjualan.id_barang = m_barang.id
				WHERE penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo' $Input
				GROUP BY detailpenjualan.id_barang
				ORDER BY jumlah DESC
				$best";

		$result = ExecuteRows($query);
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
					<!-- Input Barang -->
					<li class="d-inline-block">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Barang" id='barang'>
							<div class="input-group-append">
								<button class="btn btn-outline-info" type="button" id="button-addon2" data-toggle="modal" data-target="#modal"><i class="fas fa-search ew-icon"></i></button>
							</div>
							<input type="hidden" class="form-control" placeholder="Barang" id='id_barang' name="Inputbarang">
						</div>		
					</li>
					
					<!-- Input Range Best -->
					<li class="d-inline-block">
						<label class="d-block">Best</label>
						<select class="form-control product-select" name="best">
							<option value="">Please Select</option>					
							<option value="10">10</option>					
							<option value="10">10</option>					
							<option value="20">20</option>					
							<option value="50">50</option>					
							<option value="All">All</option>					
						</select>
					</li>						
					<li class="d-inline-block">
						<label class="d-block">Kategori</label>
						<select class="form-control product-select" name="Inputkategori">
							<option value="All">All</option>
							<?php
								$sql = "SELECT * FROM kategoribarang";
								$kat = ExecuteRows($sql);
								foreach ($kat as $rs) {
									echo "<option value='{$rs["id"]}'>" . $rs["nama"] . "</option>";
								}
								?>
						</select>
					</li>
					<li class="d-inline-block">
						<label class="d-block">Sub-Kategori</label>
						<select class="form-control product-select" name="Inputsubkategori">
							<option value="All">All</option>
							<?php
								$sql = "SELECT * FROM subkategoribarang";
								$sub = ExecuteRows($sql);
								foreach ($sub as $rs) {
									echo "<option value='{$rs["id"]}'>" . $rs["nama"] . "</option>";
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
						<button class="btn btn-primary btn-md p-2" type="submit" name="srhDate"> Search <i class="fa fa-search h-3"></i></button>
					</li>

				</ul>
			</div>
		</form>
	</div>
	<div class="row">
		<?php if(isset($_POST['srhDate'])) : ?>
			<!-- Button Print -->
			<button class="btn btn-info btn-md p-2 mb-3" onclick="exportTableToExcel('printTable')">
				Export to Excel
				<i class="far fa-file-excel"></i>
			</button>
			<table class="table table-bordered table-hover" id="printTable">
				<thead>
					<tr>
						<td colspan="9" style="text-align: center;">
							<div class="col">
								<h5>Laporan Best Seller Produk</h5>
								<?php
									$kategori = ($_POST['Inputkategori'] == "All") ? "" : "AND id = ".$_POST['Inputkategori'];
									$reskategori=ExecuteRows("SELECT * FROM kategoribarang WHERE 1=1 {$kategori}");

									$subkategori = ($_POST['Inputsubkategori'] == "All") ? "" : "AND id = ".$_POST['Inputsubkategori'];
									$ressubkategori=ExecuteRows("SELECT * FROM subkategoribarang WHERE 1=1 {$subkategori}");

									$barang = ($_POST['Inputbarang'] == "All" OR empty($_POST['Inputbarang'])) ? "" : "AND id = ".$_POST['Inputbarang'];
									$resBarang=ExecuteRows("SELECT kode_barang, nama_barang FROM m_barang WHERE 1=1 {$barang}");
									
									if(!empty($barang)) {
										echo "<h5>{$resBarang[0]['kode_barang']} - {$resBarang[0]['nama_barang']}</h5>"; 
									}

									if(!empty($kategori)) {
										echo "<h5>{$reskategori[0]['nama']}</h5>"; 
									}

									if(!empty($subkategori)) {
										echo "<h5>{$ressubkategori[0]['nama']}</h5>"; 
									}
								?>								
							</div>
						</td>
					</tr>
					<tr  style="background-color:#b7d8dc;">
						<th width="25%">Kode Produk</th>
						<th width="50%">Nama Produk</th>
						<th width="25%" align="center">Jumlah Penjualan</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if (is_null($result) OR $result == false) {
						echo '<tr><td  colspan="3" align="center">Kosong</td></tr>';	
					} else {
						$barang = "";
						foreach ($result as $rs) {
							echo "<tr id=".$rs["id_barang"].">
								 <td>" . $rs["kode_barang"] . "</td>
								 <td>" . $rs["nama_barang"] . "</td>
								 <td align='right'>
									<button class='btn btn-link' onclick='showDetails(".$rs["id_barang"].");'>
										  ".$rs['jumlah']."
									</button>
								</td>
							</tr>
							<tr id='".$rs['id_barang']."_detil' class='collapse'>
								<td colspan='3'>
									<table class='table table-bordered table-striped'>
										<thead>
											<tr>
												<th width='75%'>Nama Klinik</th>
												<th width='25%'>Jumlah Penjualan</th>
											</tr>
										</thead>
										<tbody>";
										$queryDetail = ExecuteRows("SELECT detailpenjualan.id_barang, m_klinik.nama_klinik, SUM(detailpenjualan.qty) AS jumlah
												FROM detailpenjualan
												JOIN m_barang ON detailpenjualan.id_barang = m_barang.id
												JOIN penjualan ON detailpenjualan.id_penjualan = penjualan.id
												JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik
												WHERE detailpenjualan.id_barang = ".$rs['id_barang']."
												AND penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo'
												GROUP BY detailpenjualan.id_barang, penjualan.id_klinik
												ORDER BY jumlah DESC");
										foreach ($queryDetail as $row) {
											echo "<tr>
												<td>".$row['nama_klinik']."</td>
												<td>".$row['jumlah']."</td>
											</tr>";
										}
							echo "</tbody>
									</table>
								</td>
							</tr>";
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


		<script>
			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Best Seller Produk '+ d.toDateString() +'.xls';

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
$laporan_best_seller_klinik->terminate();
?>