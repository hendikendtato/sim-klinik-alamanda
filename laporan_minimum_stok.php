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
$laporan_minimum_stok = new laporan_minimum_stok();

// Run the page
$laporan_minimum_stok->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
  if(isset($_POST['srhDate'])){
	$cabang = $_POST['cabang'];

	$multi_klinik = "";
	$nama_cabang = "";

	 foreach($cabang AS $in_klinik) {
			$multi_klinik .= "m_hargajual.id_klinik = '" .$in_klinik. "' OR ";
			$nama_cabang .= "id_klinik= '" .$in_klinik. "' OR ";			
			//var_dump($multi_klinik); die();
			//echo $in_klinik;
	}
	
	if($multi_klinik){
			$multi_klinik = substr($multi_klinik, 0, -4);
			//var_dump($multi_klinik); die();
	
	$query = "SELECT * FROM m_hargajual
	JOIN m_barang ON m_barang.id=m_hargajual.id_barang
	JOIN m_klinik ON m_klinik.id_klinik=m_hargajual.id_klinik
	WHERE ($multi_klinik) AND stok <= minimum_stok";
	$result = ExecuteRows($query);

	function rupiah($angka){
		 $hasil_rupiah = "Rp" . number_format($angka);
		 return $hasil_rupiah;
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
		
			<li class="d-inline-block">
				<label class="d-block">Cabang</label>
				<select class="custom-select" id="inputKlinik" name="cabang[]" multiple="multiple" style="width:210px; height: 40px;">
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
				<button class="btn btn-primary btn-sm p-2" type="submit" name="srhDate">
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
			<table class="table table-bordered table-hover table-striped" id="printTable">
				<thead>
					<tr>
						<td colspan="5" style="text-align: center;">
							<div class="col">
								<h5>Laporan Minimum Stok</h5>
								<h5>Cabang 
									<?php 
										if($nama_cabang){	 
											$nama_cabang = substr($nama_cabang, 0, -4);
											$klinik = ExecuteRows("SELECT nama_klinik FROM m_klinik WHERE $nama_cabang");
													
											foreach ($klinik as $value) {
												echo $value['nama_klinik'],"\n";;
											}
										}
									?>
								</h5>
							</div>
						</td>
					</tr>				
					<tr  style="background-color:#b7d8dc;">
						<th>No</th>
						<th>Barang</th>
						<th>Cabang</th>
						<th>Minimum Stok</th>
						<th>Stok</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$no=1;
				if (is_null($result) OR $result == false) {
					echo '<tr><td  colspan="4" align="center">Kosong</td></tr>';							
				}else{
					foreach ($result as $rs) {
					if($rs["stok"] != 0) {
						echo "<tr>
								<td>" . $no . ".</td>
								<td>" . $rs["nama_barang"] . "</td>
								<td>" . $rs["nama_klinik"] . "</td>
								<td>" . $rs["minimum_stok"] . "</td>
								<td>" . $rs["stok"] . "</td>
							</tr>" ;
						$no++;
					}
					}
				}						
				?>
				</tbody>
			</table>

	<?php endif; ?>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/i18n/id.js" type="text/javascript"></script>
	<script>
			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Minimum Stok '+ d.toDateString() +'.xls';

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
			$('#inputKlinik').select2({
				placeholder: "Select Klinik",
				allowClear: true,
				language: "id"
			});
		});
	</script>
  </div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$laporan_minimum_stok->terminate();
?>