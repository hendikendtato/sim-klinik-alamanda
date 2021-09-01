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
$laporan_summary_penjualan = new laporan_summary_penjualan();

// Run the page
$laporan_summary_penjualan->run();

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

	function rupiah($angka){
		$hasil_rupiah = "Rp" . number_format($angka);
		return $hasil_rupiah;
	}

	if(isset($_POST['srhDate'])){
		$cabang = !empty($_POST['cabang']) ? 'AND id_klinik IN ('.implode(',', $_POST['cabang']).')' : '' ; 
		$dateFrom = !empty($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-d');
		$dateTo = !empty($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-d');

		$tgl = strtotime($dateFrom);
		$period = [];

		while($tgl <= strtotime($dateTo))
		{
			$period[] = date('Y-m-d', $tgl);
			$tgl = strtotime("+1 day", $tgl);
		}

		$kliniks = ExecuteRows("SELECT id_klinik, nama_klinik FROM m_klinik WHERE 1=1 {$cabang}");
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
						<label class="d-block">Date Range</label>
						<input type="date" class="form-control input-md" name="dateFrom">
					</li>
					to
					<li class="d-inline-block">
						<input type="date" class="form-control input-md" name="dateTo">
					</li>
					<li class="d-inline-block">
						<button class="btn btn-primary btn-md p-2" type="submit" name="srhDate">Search <i class="fa fa-search h-3"></i></button>
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
			<table class="table table-bordered" id="printTable">
				<?php
					$mso='"\@"';
					$grand_total_qty_jual=0;
					$grand_total_jual=0;
					$grand_total_qty_retur=0;
					$grand_total_retur=0;
					$grand_total_qty_total=0;
					$grand_total_tota=0;
					foreach ($kliniks as $klinik) {
						foreach ($period as $tanggal) {
							$skey = str_replace('-', '', $tanggal);
							$id_klinik = $klinik['id_klinik'];
							$key = $id_klinik.$skey;

							echo "<tr style='background-color:#b7d8dc;' id='{$key}'>
									<th style='vertical-align: middle;'>Cabang: {$klinik['nama_klinik']}. Tanggal: ".tgl_indo($tanggal)."</th>
									<th>
										<button class='btn btn-link' onclick='showDetails({$key});'>DETAIL</button>
									</th>
								</tr>
								<tr id='{$key}_detil' class='collapse'>
									<td colspan='2'>
										<table style='width: 100%;' class='table table-striped table-hover'>
											<thead>
												<tr style='background-color:#b7d8dc;'>
													<th rowspan='2' width='12%' style='vertical-align: middle;'>Kode</th>
													<th rowspan='2' width='28%' style='vertical-align: middle;'>Nama Barang</th>	
													<th colspan='2' width='20%' style='text-align: center;'>Penjualan</th>
													<th colspan='2' width='20%' style='text-align: center;'>Retur</th>
													<th colspan='2' width='20%' style='text-align: center;'>Total</th>
												</tr>
												<tr style='background-color:#b7d8dc;'>
													<th width='5%'>Qty</th>
													<th width='15%'>Sub-total</th>
													<th width='5%'>Qty</th>
													<th width='15%'>Sub-total</th>
													<th width='5%'>Qty</th>
													<th width='15%'>Sub-total</th>
												</tr>
											</thead>
											<tbody>";
											$queryDetil = ExecuteRows("SELECT
													tanggal,
													id_klinik,
													id AS id_barang, 
													kode_barang, 
													nama_barang, 
													SUM(IFNULL(qty_jual,0)) AS qty_jual, 
													SUM(IFNULL(subtotal_jual,0)) AS subtotal_jual, 
													SUM(IFNULL(qty_retur,0)) AS qty_retur, 
													SUM(IFNULL(subtotal_retur,0)) AS subtotal_retur
												FROM
													(
														SELECT * FROM m_barang
														JOIN (
															SELECT 
																penjualan.waktu AS tanggal, 
																penjualan.id_klinik, 
																detailpenjualan.id_barang, 
																SUM(detailpenjualan.qty) AS qty_jual, 
																detailpenjualan.harga_jual AS subtotal_jual, 
																NULL as qty_retur, 
																NULL as subtotal_retur
															FROM 
																penjualan
																JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan
															WHERE penjualan.waktu = '{$tanggal}' AND penjualan.id_klinik = {$id_klinik}
															GROUP BY tanggal, penjualan.id_klinik, detailpenjualan.id_barang, detailpenjualan.harga_jual
														) penjualan ON penjualan.id_barang = m_barang.id
														UNION
														SELECT * FROM m_barang
														JOIN (
															SELECT
																returbarang.tanggal, 
																returbarang.id_klinik, 
																detailretur.id_barang, 
																NULL as qty_jual, 
																NULL as subtotal_jual, 
																detailretur.jumlah AS qty_retur, 
																m_hargajual.totalhargajual AS subtotal_retur
															FROM 
																returbarang
																JOIN detailretur ON returbarang.id_retur = detailretur.id_retur
																JOIN m_hargajual ON m_hargajual.id_barang = detailretur.id_barang AND m_hargajual.id_klinik = {$id_klinik}
															WHERE returbarang.tanggal = '{$tanggal}' AND returbarang.id_klinik = {$id_klinik}
														) retur ON retur.id_barang = m_barang.id
													) t
												GROUP BY tanggal, id_klinik, id, kode_barang, nama_barang
												ORDER BY id_klinik, tanggal");

											$qty_jual=0;
											$total_jual=0;
											$qty_retur=0;
											$total_retur=0;
											$qty_total=0;
											$total_total=0;
											$grand_total_qty_jual=0;
											$grand_total_jual=0;
											$grand_total_qty_retur=0;
											$grand_total_retur=0;
											$grand_total_qty_total=0;
											$grand_total_total=0;

										if ($queryDetil) {
											foreach($queryDetil as $row) {
												$qty_total = $row['qty_jual'] + $row['qty_retur'];
												$subtotal_total = ($row['qty_jual'] * $row['subtotal_jual']) + ($row['qty_retur'] * $row['subtotal_retur']);
												echo "<tr>
														<td>{$row['kode_barang']}</td>
														<td>{$row['nama_barang']}</td>
														<td align='right'>{$row['qty_jual']}</td>
														<td align='right' style='mso-number-format:{$mso}'>".rupiah($row['subtotal_jual'])."</td>
														<td align='right'>{$row['qty_retur']}</td>
														<td align='right' style='mso-number-format:{$mso}'>".rupiah($row['subtotal_retur'])."</td>
														<td align='right'>{$qty_total}</td>
														<td align='right' style='mso-number-format:{$mso}'>".rupiah($subtotal_total)."</td>
													</tr>";
												$qty_jual+=$row['qty_jual'];
												$total_jual+=$row['subtotal_jual'];
												$grand_total_qty_jual+=$qty_jual;
												$grand_total_jual+=$total_jual;

												$qty_retur+=$row['qty_retur'];
												$total_retur+=$row['subtotal_retur'];
												$grand_total_qty_retur+=$qty_retur;
												$grand_total_retur+=$total_retur;
												
												$qty_total+=$qty_total;
												$total_total+=$subtotal_total;
												$grand_total_qty_total+=$qty_total;
												$grand_total_total+=$total_total;
												
											}
										} else{
											echo "<tr>
												<td colspan='8' class='text-center'>Tidak ada data.</td>
											</tr>";
										}
										echo "</tbody>
											<tfoot>
											<tr>
												<th colspan='2'>Total</th>
												<th style='text-align: right;'>{$qty_jual}</th>
												<th style='text-align: right; mso-number-format:{$mso}'>".rupiah($total_jual)."</th>
												<th style='text-align: right;'>{$qty_retur}</th>
												<th style='text-align: right; mso-number-format:{$mso}'>".rupiah($total_retur)."</th>
												<th style='text-align: right;'>{$qty_total}</th>
												<th style='text-align: right; mso-number-format:{$mso}'>".rupiah($total_total)."</th>
											</tr>
											</tfoot>
										</table>
									</td>
								</tr>
								";
						}
					}
					echo "<tfoot>
							<tr>
								<td colspan='2'>
									<table style='width: 100%;'>
										<thead>
											<tr>
												<th rowspan='2' width='25%'></th>
												<th colspan='2' width='25%' style='text-align: center;'>Penjualan</th>
												<th colspan='2' width='25%' style='text-align: center;'>Retur</th>
												<th colspan='2' width='25%' style='text-align: center;'>Total</th>
											</tr>
											<tr>
												<th width='10%'>Qty</th>
												<th width='15%'>Total</th>
												<th width='10%'>Qty</th>
												<th width='15%'>Total</th>
												<th width='10%'>Qty</th>
												<th width='15%'>Total</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><b>Grand Total</b></td>
												<td style='text-align: right;'>{$grand_total_qty_jual}</td>
												<td style='text-align: right; mso-number-format:{$mso}'>".rupiah($grand_total_jual)."</td>
												<td style='text-align: right;'>{$grand_total_qty_retur}</td>
												<td style='text-align: right; mso-number-format:{$mso}'>".rupiah($grand_total_retur)."</td>
												<td style='text-align: right;'>{$grand_total_qty_total}</td>
												<td style='text-align: right; mso-number-format:{$mso}'>".rupiah($grand_total_total)."</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</tfoot>";
				?>
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
				filename = filename ? filename + '.xls' : 'Laporan Summary Penjualan Klinik '+ d.toDateString() +'.xls';

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
$laporan_summary_penjualan->terminate();
?>