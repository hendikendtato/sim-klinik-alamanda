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
$laporan_barang_terjual = new laporan_barang_terjual();

// Run the page
$laporan_barang_terjual->run();

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
		$cabang = (empty($_POST['cabang'])) ? "" : "AND penjualan.id_klinik = ".$_POST['cabang'];
		$Inputbarang = ($_POST['Inputbarang'] == "All" OR empty($_POST['Inputbarang'])) ? "" : "AND m_barang.id = ".$_POST['Inputbarang'];
		$Inputkategori = ($_POST['Inputkategori'] == "All" OR empty($_POST['Inputkategori'])) ? "" : "AND m_barang.kategori = ".$_POST['Inputkategori'];
		$Inputsubkategori = ($_POST['Inputsubkategori'] == "All" OR empty($_POST['Inputsubkategori'])) ? "" : "AND m_barang.subkategori = ".$_POST['Inputsubkategori'];		
		$dateFrom = !empty($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-01');
		$dateTo = !empty($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-t');

		$tgl = strtotime($dateFrom);
		$period = [];

		while($tgl <= strtotime($dateTo))
		{
			$period[] = date('Y-m-d', $tgl);
			$tgl = strtotime("+1 day", $tgl);
		}

		$query = "SELECT penjualan.waktu, m_barang.kode_barang, m_barang.nama_barang, SUM(detailpenjualan.qty) AS jumlah, m_klinik.nama_klinik
				FROM m_barang 
				JOIN detailpenjualan ON m_barang.id = detailpenjualan.id_barang
				JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan
				JOIN m_klinik ON m_klinik.id_klinik = penjualan.id_klinik
				WHERE penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo' $Inputbarang $Inputkategori $Inputsubkategori $cabang
				GROUP BY m_barang.id, penjualan.waktu
				ORDER BY penjualan.waktu ASC";

		// print_r($query);
		$result = ExecuteRows($query);

		$data = [];

		foreach($result as $row) {
			$data[$row['kode_barang']]['nama_barang'] = $row['nama_barang'];
			$data[$row['kode_barang']]['penjualan'][$row['waktu']] = $row['jumlah'];
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
				<ul class="list-unstyled">

					<li class="d-inline-block">
						<label class="d-block">Cabang</label>
						<select class="form-control product-select" name="cabang" style="width:210px; height: 40px;">
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
						<td colspan="<?php echo count($period) + 3 ?>" style="text-align: center;">
							<div class="col">
								<h5>Laporan Barang Terjual</h5>
								<h5>Cabang 
									<?php 
										if($result != false) {
											echo $result[0]['nama_klinik']; 
										} else {
											echo "--";
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
					<tr  style="background-color:#b7d8dc;">
						<th width="25%">Kode Produk</th>
						<th width="50%">Nama Produk</th>
						<?php foreach($period as $date): ?>
							<th width='20'><?php echo date("j", strtotime($date)) ?></th>
						<?php endforeach; ?>
						<th width="25%" align="center">Jumlah</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					$grandtotal=0;
					if (is_null($result) OR $result == false) {
						echo '<tr><td  colspan="3" align="center">Kosong</td></tr>';	
					} else {
						foreach($data as $key => $value){
							echo "<tr><td>{$key}</td><td>{$value['nama_barang']}</td>";
							$jml_penjualan = 0;
							foreach($period as $date){
								if (isset($value['penjualan'][$date])) {
									$penjualan = $value['penjualan'][$date];
									$color = 'style="background-color: yellow;"';
								} else {
									$penjualan = 0;
									$color = null;
								}
								$jml_penjualan += $penjualan;
								echo "<td {$color}>{$penjualan}</td>";
							}
							echo "<td>{$jml_penjualan}</td></tr>";
							$grandtotal += $jml_penjualan;
						}
					}
				?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="<?php echo count($period) + 2 ?>">Grand Total</th>
						<th><?php echo $grandtotal ?></th>
					</tr>
				</tfoot>
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
				filename = filename ? filename + '.xls' : 'Laporan Barang Terjual '+ d.toDateString() +'.xls';

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
$laporan_barang_terjual->terminate();
?>