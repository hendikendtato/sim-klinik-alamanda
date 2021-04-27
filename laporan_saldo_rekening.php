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
$laporan_saldo_rekening = new laporan_saldo_rekening();

// Run the page
$laporan_saldo_rekening->run();

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
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];
	$cabang = $_POST['cabang'];
	$rekening = $_POST['Inputrekening'];
	$and = "";

	if ($_POST['Inputrekening'] != null) {
		$rekening = $_POST['Inputrekening'];
		$and .= "AND laporan_rekening.id_rekening = '$rekening'";
	}
	
	$query = "SELECT laporan_rekening.*, m_klinik.nama_klinik, m_rekening.nama_rekening, m_bank.nama_bank
				FROM laporan_rekening
				LEFT JOIN m_klinik ON laporan_rekening.id_klinik = m_klinik.id_klinik
				LEFT JOIN m_rekening ON laporan_rekening.id_rekening = m_rekening.id_rekening
				LEFT JOIN m_bank ON m_rekening.id_bank = m_bank.id_bank
				WHERE (laporan_rekening.tanggal BETWEEN '$dateFrom' AND '$dateTo') AND laporan_rekening.id_klinik = '$cabang' $and";
	$result = ExecuteRows($query);

	//print_r($query);

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

						<!-- Input Rekening -->
						<li class="d-inline-block">
							<label class="d-block">Rekening</label>
							<select class="form-control product-select" name="Inputrekening">
								<?php
									$sql = "SELECT * FROM m_rekening";
									$res = ExecuteRows($sql);
									foreach ($res as $rs) {
										echo "<option value=" . $rs["id_rekening"] . ">" . $rs["nama_rekening"] . "</option>";
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
					<td colspan="7" style="text-align: center;">
						<div class="col">
							<h5>Laporan Saldo Rekening</h5>
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
						<th>No</th>
						<th>Nama Bank</th>
						<th>Nama Rekening</th>
						<th>Klinik</th>												
						<th>Tanggal</th>
						<th>Grandtotal</th>						
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no=1;
				if (is_null($result) OR $result == false) {
					echo '<tr><td  colspan="7" align="center">Kosong</td></tr>';							
				}else{
					$totalcabang = 0;
			foreach ($result as $rs) {
			
			$subtotal = ExecuteScalar("SELECT SUM(detailpenjualan.subtotal) FROM detailpenjualan JOIN penjualan ON penjualan.id_penjualan = detailpenjualan.id_penjualan WHERE penjualan.kode_penjualan = ".$rs['kode_penjualan']." ORDER BY id");
				echo "<tr id=".$rs["id"].">
			 			<td>" . $no . ".</td>
			 			<td>" . $rs["nama_bank"] . "</td>
			 			<td>" . $rs["nama_rekening"] . "</td>
			 			<td>" . $rs["nama_klinik"] . "</td>			 			
			 			<td>" . $rs["tanggal"] . "</td>
			 			<td>" . rupiah($rs["jumlah"]) . "</td>			 			
						<td align='center'>
							<button class='btn btn-link' onclick='showDetails(".$rs["id"].");'>
				  				Detail
							</button>
						</td>
					</tr>
					<tr id='".$rs["id"]."_detil' class='collapse'>
						<td class='ew-table-last-col' colspan='8'>
							<div>
								<table class='table'>
									<thead>
										<tr>
											<th>Kode Penjualan</th>
											<th>Tanggal, Waktu</th>
											<th>Nama Pelanggan</th>
											<th>Diskon(%)</th>
											<th>Diskon(Rp)</th>
											<th>Diskon(Rp)</th>
											<th>Jumlah</th>											
											<th>Total</th>											
										</tr>
									</thead>
									<tbody>";
									$kode_penjualan = $rs['kode_penjualan'];
									$details = ExecuteRows("SELECT * FROM penjualan	  										
	  										JOIN m_pelanggan ON penjualan.id_pelanggan = m_pelanggan.id_pelanggan
	  										WHERE penjualan.kode_penjualan = '$kode_penjualan'");
									// dd($details);

									foreach ($details as $row) {
										echo "<tr>
											<td><a href='penjualanview.php?showdetail=detailpenjualan&amp;id=". $row["id"] ."'>".$row["kode_penjualan"]."<a></td>
											<td>".$row["waktu"]."</td>
											<td>".$row["nama_pelanggan"]."</td>
											<td>".$row["diskon_persen"]."</td>
											<td>".$row["diskon_rupiah"]."</td>
											<td>".rupiah($row["bayar_non_tunai"])."</td>
											<td>".$row["charge"]."</td>
											<td>".rupiah($rs["jumlah"])."</td>
										</tr>";
									}
						echo "</tbody>
								</table>
							</div>
						</td>
					</tr>";			 		
					$no++;		
					$totalcabang += $rs["jumlah"];	  
			}
				}						
				?>
				<tr>
				<td colspan="5" align="right"><b>Total Saldo Rekening</b></td>
				<td align="right">
				<b>
					<?php if(isset($totalcabang)) {
							echo rupiah($totalcabang);							
						  }
						  $totalcabang = isset($totalcabang) ? $totalcabang : '0';
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
				filename = filename ? filename + '.xls' : 'Laporan Saldo Rekening '+ d.toDateString() +'.xls';

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
$laporan_saldo_rekening->terminate();
?>