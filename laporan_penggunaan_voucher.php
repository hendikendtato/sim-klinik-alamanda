<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$laporan_penggunaan_voucher = new laporan_penggunaan_voucher();

// Run the page
$laporan_penggunaan_voucher->run();

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
	
	$query = "SELECT *
				FROM penggunaan_kartu
				LEFT JOIN m_klinik ON penggunaan_kartu.id_klinik = m_klinik.id_klinik
				LEFT JOIN m_kartu ON penggunaan_kartu.id_kartu = m_kartu.id_kartu
				WHERE (penggunaan_kartu.tgl BETWEEN '$dateFrom' AND '$dateTo') AND penggunaan_kartu.id_klinik = '$cabang' AND  penggunaan_kartu.jenis_kartu = 'Voucher'";
	$result = ExecuteRows($query);

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
							<h5>Laporan Penggunaan Voucher</h5>
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
						<th>Voucher</th>
						<th>Klinik</th>
						<th>Kode Penjualan</th>
						<th>Tanggal</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no=1;
				if (is_null($result) OR $result == false) {
					echo '<tr><td  colspan="12" align="center">Kosong</td></tr>';							
				}else{
					foreach ($result as $rs) {									
						echo "<tr>
								<td>" . $no . ".</td>
								<td>" . $rs["nama_kartu"] . "</td>
								<td>" . $rs["nama_klinik"] . "</td>
								<td>" . $rs["kode_penjualan"] . "</td>
								<td>" . $rs["tgl"] . "</td>
								<td>" . rupiah($rs["jumlah"]) . "</td>
							</tr>" ;
						$no++;
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
				filename = filename ? filename + '.xls' : 'Laporan Penggunaan Voucher '+ d.toDateString() +'.xls';

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
$laporan_penggunaan_voucher->terminate();
?>