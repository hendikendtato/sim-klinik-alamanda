<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

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
$laporan_penggunaan_kartu = new laporan_penggunaan_kartu();

// Run the page
$laporan_penggunaan_kartu->run();

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
		$hilangkan = explode(' ', $tanggal);
		$pecahkan = explode('-', $hilangkan[0]);
		
		// variabel pecahkan 0 = tanggal
		// variabel pecahkan 1 = bulan
		// variabel pecahkan 2 = tahun
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
	
	if(isset($_POST['srhDate'])){
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];
		$cabang = $_POST['cabang'];
		$Inputkartu = $_POST['Inputkartu'];
		
		if($Inputkartu == 'All') {
			$query = "SELECT m_kartu.nama_kartu, penggunaan_kartu.id_kartu FROM penggunaan_kartu
			JOIN m_kartu ON m_kartu.id_kartu = penggunaan_kartu.id_kartu
			WHERE jenis != 'Voucher' AND (penggunaan_kartu.tgl BETWEEN '$dateFrom' AND '$dateTo') AND penggunaan_kartu.id_klinik = $cabang GROUP BY penggunaan_kartu.id_kartu";
			$result = ExecuteRows($query);
		} else {
			$query = "SELECT m_kartu.nama_kartu, penggunaan_kartu.id_kartu FROM penggunaan_kartu
			LEFT JOIN m_kartu ON penggunaan_kartu.id_kartu = m_kartu.id_kartu
			WHERE (penggunaan_kartu.tgl BETWEEN '$dateFrom' AND '$dateTo') AND penggunaan_kartu.id_kartu = '$Inputkartu' AND penggunaan_kartu.id_klinik = $cabang GROUP BY penggunaan_kartu.id_kartu";
			$result = ExecuteRows($query);
		}
	
		function rupiah($angka){
			 $hasil_rupiah = "Rp" . number_format($angka);
			 return $hasil_rupiah;
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
			<!-- Input Kartu -->
			<li class="d-inline-block">
				<label class="d-block">Plih Kartu</label>
				<select class="form-control product-select" name="Inputkartu">
					<option value="All">All</option>
					<?php
					$sql = "SELECT * FROM m_kartu";
					$res = ExecuteRows($sql);

					foreach ($res as $rs) {
						echo "<option value=" . $rs["id_kartu"] . ">" . $rs["nama_kartu"] . "</option>";
					}
					?>
				</select>
		  	</li>

			<!-- Input Klinik -->
			<li class="d-inline-block">
				<label class="d-block">Cabang</label>
					<select class="form-control product-select" name="cabang">
						<option value="">Please Select</option>
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

			<!-- Date Range -->
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
			<table class="table table-hover table-striped" id="printTable">
				<thead>
				<tr>
					<td colspan="6" style="text-align: center;">
						<div class="col">
							<h5>Laporan Penggunaan Kartu</h5>
							<h5>Cabang 
								<?php
									$resKlinik=ExecuteRows("SELECT * FROM m_klinik WHERE id_klinik=$cabang");
									if($resKlinik != false) {
										echo $resKlinik[0]['nama_klinik']; 
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
					<tr style="background-color:#b7d8dc;">
						<th colspan='6'>Kartu</th>					
					</tr>
				</thead>
				<tbody>
					<?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
			echo '<tr><td  colspan="6" align="center">Kosong</td></tr>';							
		  }else{
			$totalcabang_total = 0;
			$totalcabang_total_charge = 0;
			foreach ($result as $rs) {

				echo "<tr id=".$rs["id_kartu"].">
			 			<td colspan='5'>" . $rs["nama_kartu"] . "</td>			 			
						<td align='center'>
							<button class='btn btn-link' onclick='showDetails(".$rs["id_kartu"].");'>
				  				Detail
							</button>
						</td>
					</tr>
					<tr id='".$rs["id_kartu"]."_detil' class='collapse'>
						<td class='ew-table-last-col' colspan='5'>
							<div>
								<table class='table'>
									<thead>
										<tr>
											<th>Tanggal</th>
											<th>Kode Penjualan</th>
											<th align='right'>Pembayaran</th>
											<th>Biaya Jual</th>
											<th>Total</th>										
										</tr>
									</thead>
									<tbody>";
												$dateFrom = $_POST['dateFrom'];
												$dateTo = $_POST['dateTo'];
												$cabang = $_POST['cabang'];

												$details = ExecuteRows("SELECT * FROM penggunaan_kartu	  										
												WHERE id_kartu = ".$rs["id_kartu"]." AND id_klinik ='$cabang' AND (tgl BETWEEN '$dateFrom' AND '$dateTo') ");
												$total = 0;
												$total_charge = 0;
												foreach ($details as $row) {
													echo "<tr>
														<td>".tgl_indo($row["tgl"])."</td>
														<td>".$row["kode_penjualan"]."</td>
														<td align='right'>".rupiah($row["total"])."</td>
														<td align='right'>".$row["charge"]."</td>
														<td align='right'>".rupiah($row["total_charge"])."</td>
													</tr>";
													$total += $row["total"];
													$total_charge += $row["total_charge"];
												}
												echo "<tr>
													<td colspan='2' align='right'><b>Total per Kartu ".$rs["nama_kartu"]."</b></td>
													<td align='right'>".rupiah($total)."</td>
													<td colspan='2' align='right'>".rupiah($total_charge)."</td>
												</tr>";
									echo "</tbody>
								</table>
							</div>
						</td>
					</tr>";			 		
					$no++;		
					$totalcabang_total += $total;	  
					$totalcabang_total_charge += $total_charge;	  
			}
		  }						
		?>
				<tr>
					<td colspan='2' align="right">
						<b>Total Cabang Alamanda 								
								<?php
									$resKlinik=ExecuteRows("SELECT * FROM m_klinik WHERE id_klinik=$cabang");
									if($resKlinik != false) {
										echo $resKlinik[0]['nama_klinik']; 
									} else {
										echo "--";
									}
								?>
						</b>
					</td>
					<td align="right">
						<b>
							<?php if(isset($totalcabang_total)) {
									echo rupiah($totalcabang_total);							
								}
								$totalcabang_total = isset($totalcabang_total) ? $totalcabang_total : '0';
							?>
						</b>
					</td>
					<td colspan='2' align="right">
						<b>
							<?php if(isset($totalcabang_total_charge)) {
									echo rupiah($totalcabang_total_charge);							
								}
								$totalcabang_total_charge = isset($totalcabang_total_charge) ? $totalcabang_total_charge : '0';
							?>
						</b>
					</td>
					<td></td>
		  		</tr>

				<tr>
					<td colspan='2' align="right">
						<b>Grand Total</b>
					</td>
					<td align="right">
						<b>
							<?php if(isset($totalcabang_total)) {
									echo rupiah($totalcabang_total);							
								}
								$totalcabang_total = isset($totalcabang_total) ? $totalcabang_total : '0';
							?>
						</b>
					</td>
					<td colspan='2' align="right">
						<b>
							<?php if(isset($totalcabang_total_charge)) {
									echo rupiah($totalcabang_total_charge);							
								}
								$totalcabang_total_charge = isset($totalcabang_total_charge) ? $totalcabang_total_charge : '0';
							?>
						</b>
					</td>
					<td></td>
		  		</tr>
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
				filename = filename ? filename + '.xls' : 'Laporan Penggunaan Kartu '+ d.toDateString() +'.xls';

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
$laporan_penggunaan_kartu->terminate();
?>