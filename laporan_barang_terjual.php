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
		$dateFrom = !empty($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-01');
		$dateTo = !empty($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-t');

		$tgl = strtotime($dateFrom);
		$period = [];

		while($tgl <= strtotime($dateTo))
		{
			$period[] = date('Y-m-d', $tgl);
			$tgl = strtotime("+1 day", $tgl);
		}

		$query = "SELECT penjualan.waktu, m_barang.kode_barang, m_barang.nama_barang, SUM(detailpenjualan.qty) AS jumlah
				FROM m_barang 
				JOIN detailpenjualan ON m_barang.id = detailpenjualan.id_barang
				JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan
				WHERE penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo'
				GROUP BY m_barang.id, penjualan.waktu
				ORDER BY penjualan.waktu ASC";

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
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_barang_terjual->terminate();
?>