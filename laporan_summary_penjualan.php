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
		$cabang = !empty($_POST['cabang']) ? 'AND penjualan.id_klinik IN ('.implode(',', $_POST['cabang']).')' : '' ; 
		$dateFrom = !empty($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-01');
		$dateTo = !empty($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-t');

		$query = "SELECT penjualan.tanggal, penjualan.id_klinik, m_klinik.nama_klinik, m_barang.kode_barang, m_barang.nama_barang
				FROM m_barang
				JOIN (
					SELECT penjualan.waktu as tanggal, penjualan.id_klinik, detailpenjualan.id_barang
					FROM penjualan
					JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan
					WHERE penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo'
				) penjualan ON penjualan.id_barang = m_barang.id
				JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik
				LEFT JOIN (
					SELECT returbarang.tanggal, detailretur.id_barang
					FROM returbarang
					JOIN detailretur ON returbarang.id_retur = detailretur.id_retur
				) retur ON retur.id_barang = m_barang.id
				WHERE 1=1 $cabang
				GROUP BY penjualan.tanggal, penjualan.id_klinik, m_barang.id
				ORDER BY penjualan.id_klinik, tanggal";

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
					$no=1;
					if (is_null($result) OR $result == false) {
						echo '<tr><td colspan="4" align="center">Kosong</td></tr>';	
					} else {
						$tanggal = '';
						$klinik = '';
						$mso='"\@"';
						$grand_total_qty_jual=0;
						$grand_total_jual=0;
						$grand_total_qty_retur=0;
						$grand_total_retur=0;
						$grand_total_qty_total=0;
						$grand_total_tota=0;
						foreach ($result as $rs) {							
							if ($tanggal != $rs['tanggal'] or $klinik != $rs['id_klinik']) {
								$tanggal = $rs['tanggal'];
								$klinik = $rs['id_klinik'];

								$skey = str_replace('-', '', $tanggal);
								$key = $klinik.$skey;

								echo "<tr style='background-color:#b7d8dc;' id='{$key}'>
											<th style='vertical-align: middle;'>Cabang: {$rs['nama_klinik']}. Tanggal: ".tgl_indo($tanggal)."</th>
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
														$queryDetil = ExecuteRows("SELECT penjualan.tanggal, m_klinik.nama_klinik, m_barang.kode_barang, m_barang.nama_barang, CASE WHEN SUM(penjualan.qty) IS NULL THEN 0 ELSE SUM(penjualan.qty) END AS qty_jual, CASE WHEN SUM(penjualan.subtotal) IS NULL THEN 0 ELSE SUM(penjualan.subtotal) END AS subtotal_jual, CASE WHEN SUM(retur.qty) IS NULL THEN 0 ELSE SUM(retur.qty) END AS qty_retur, CASE WHEN SUM(retur.subtotal) IS NULL THEN 0 ELSE SUM(retur.subtotal) END AS subtotal_retur
															FROM m_barang
															JOIN (
															SELECT penjualan.waktu AS tanggal, penjualan.id_klinik, detailpenjualan.id_barang, SUM(detailpenjualan.qty) AS qty, SUM(detailpenjualan.harga_jual) AS subtotal
															FROM penjualan
															JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan
															WHERE penjualan.waktu = '$tanggal'
															GROUP BY tanggal, penjualan.id_klinik, detailpenjualan.id_barang) penjualan ON penjualan.id_barang = m_barang.id
															JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik
															LEFT JOIN (
															SELECT returbarang.tanggal, detailretur.id_barang, SUM(detailretur.jumlah) AS qty, SUM(m_hargajual.totalhargajual) AS subtotal
															FROM returbarang
															JOIN detailretur ON returbarang.id_retur = detailretur.id_retur
															JOIN m_hargajual ON m_hargajual.id_barang = detailretur.id_barang
															GROUP BY returbarang.tanggal, returbarang.id_klinik, detailretur.id_barang) retur ON retur.id_barang = m_barang.id
															WHERE penjualan.id_klinik = ".$rs['id_klinik']."
															GROUP BY penjualan.tanggal, penjualan.id_klinik, m_barang.id
															ORDER BY penjualan.id_klinik, tanggal");

														$qty_jual=0;
														$total_jual=0;
														$qty_retur=0;
														$total_retur=0;
														$qty_total=0;
														$total_total=0;

														foreach($queryDetil as $row) {
															$qty_total = $row['qty_jual'] + $row['qty_retur'];
															$subtotal_total = $row['subtotal_jual'] + $row['subtotal_retur'];
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

															$qty_retur+=$row['qty_retur'];
															$total_retur+=$row['subtotal_retur'];
															
															$qty_total+=$qty_total;
															$total_total+=$subtotal_total;
														}
														echo "<tfoot>
															<tr>
																<th colspan='2'>Total</th>
																<th style='text-align: right;'>{$qty_jual}</th>
																<th style='text-align: right; mso-number-format:{$mso}'>".rupiah($total_jual)."</th>
																<th style='text-align: right;'>{$qty_retur}</th>
																<th style='text-align: right; mso-number-format:{$mso}'>".rupiah($total_retur)."</th>
																<th style='text-align: right;'>{$qty_total}</th>
																<th style='text-align: right; mso-number-format:{$mso}'>".rupiah($total_total)."</th>
															</tr>
															</tfoot>";
												echo "</tbody>
												</table>
											</td>
										</tr>";
										$grand_total_qty_jual+=$qty_jual;
										$grand_total_jual+=$total_jual;

										$grand_total_qty_retur+=$qty_retur;
										$grand_total_retur+=$total_retur;
										
										$grand_total_qty_total+=$qty_total;
										$grand_total_tota+=$total_total;
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
													<td style='text-align: right; mso-number-format:{$mso}'>".rupiah($grand_total_tota)."</td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tfoot>";
					}
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