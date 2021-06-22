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
		$Input  = ($_POST['Inputbarang'] == "All") ? "" : "AND detailpenjualan.id_barang = ".$_POST['Inputbarang'];
		$dateFrom = !empty($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-01');
		$dateTo = !empty($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-t');

		$query = "SELECT detailpenjualan.id_barang, m_barang.kode_barang, m_barang.nama_barang, 
					SUM(detailpenjualan.qty) AS jumlah
				FROM detailpenjualan 
				JOIN penjualan ON detailpenjualan.id_penjualan = penjualan.id
				JOIN m_barang ON detailpenjualan.id_barang = m_barang.id
				WHERE penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo' $Input
				GROUP BY detailpenjualan.id_barang
				ORDER BY jumlah DESC
				LIMIT 10";

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
					<!-- Input barang -->
					<li class="d-inline-block">
						<label class="d-block">Input Barang</label>
						<select class="form-control product-select" name="Inputbarang">
							<option value="All">All</option>
							<?php
								$sql = "SELECT * FROM m_barang WHERE tipe != 'Perawatan'";
								$res = ExecuteRows($sql);
								foreach ($res as $rs) {
									echo "<option id='{$rs["id"]}' value='{$rs["id"]}'>{$rs["nama_barang"]}</option>";
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
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_best_seller_klinik->terminate();
?>