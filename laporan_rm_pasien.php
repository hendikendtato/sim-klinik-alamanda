<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$laporan_rm_pasien = new laporan_rm_pasien();

// Run the page
$laporan_rm_pasien->run();

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
		$and = "";

		if($_POST['pasien'] != "") { 
			$pasien = $_POST['pasien'];
			$and .= "AND m_pelanggan.nama_pelanggan LIKE '%$pasien%' ";
		}
		if($_POST['kode_pasien'] != "") { 
			$kode_pasien = $_POST['kode_pasien'];
			$and .= "AND m_pelanggan.kode_pelanggan = '$kode_pasien' ";
		} 
		if($_POST['noktp'] != "") { 
			$noktp = $_POST['noktp'];
			$and .= "AND m_pelanggan.noktp_pelanggan = '$noktp' ";
		}
		if($_POST['alamat'] != "") { 
			$alamat = $_POST['alamat'];
			$and .= "AND m_pelanggan.alamat_pelanggan LIKE '%$alamat%' ";
		}
		if($_POST['notelp'] != "") { 
			$notelp = $_POST['notelp'];
			$and .= "AND m_pelanggan.telpon_pelanggan = '$notelp' ";
		}
		if($_POST['nohp'] != "") { 
			$nohp = $_POST['nohp'];
			$and .= "AND m_pelanggan.hp_pelanggan = '$nohp' ";
		}
		if($_POST['tgllahir'] != "") { 
			$tgllahir = $_POST['tgllahir'];
			$and .= "AND m_pelanggan.tgllahir_pelanggan = '$tgllahir' ";
		}
		
		$dateFrom = $_POST['dateFrom'];
		$dateTo = $_POST['dateTo'];
		$query = "SELECT m_pelanggan.id_pelanggan, m_pelanggan.nama_pelanggan, m_pelanggan.kode_pelanggan, m_pelanggan.noktp_pelanggan, penjualan.id, penjualan.kode_penjualan, penjualan.waktu, detailpenjualan.id_barang, m_barang.kode_barang, m_barang.nama_barang , detailpenjualan.harga_jual, detailpenjualan.qty, detailpenjualan.subtotal, m_klinik.nama_klinik
		FROM (((m_pelanggan 
			JOIN penjualan ON m_pelanggan.id_pelanggan = penjualan.id_pelanggan) 
			JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan) 
			JOIN m_barang ON detailpenjualan.id_barang = m_barang.id)
			JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik
			WHERE (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') 
			$and 
			ORDER BY m_pelanggan.nama_pelanggan, penjualan.waktu";
			$result = ExecuteRows($query);
  }

  function rupiah($angka){
	$hasil_rupiah = number_format($angka);
	return $hasil_rupiah;
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
					<label class="d-block">Kode Pasien</label>
					<input class="form-control input-md" type="text" placeholder="Kode Pasien" name="kode_pasien">
				</li>
				<li class="d-inline-block">
					<label class="d-block">Pasien</label>
					<input class="form-control input-md" type="text" placeholder="Pasien" name="pasien">
				</li>
				<li class="d-inline-block">
					<label class="d-block">No. KTP</label>
					<input class="form-control input-md" type="text" placeholder="No. KTP" name="noktp">
				</li>
				<li class="d-inline-block">
					<label class="d-block">Alamat Pasien</label>
					<input class="form-control input-md" type="text" placeholder="Alamat Pasien" name="alamat">
				</li>
			</ul>
		</div>
	  <div class="col-md-12">
			<ul class="list-unstyled">
				<li class="d-inline-block">
					<label class="d-block">Nomor Telepon</label>
					<input class="form-control input-md" type="text" placeholder="Nomor Telepon" name="notelp">
				</li>
				<li class="d-inline-block">
					<label class="d-block">Nomor HP</label>
					<input class="form-control input-md" type="text" placeholder="Nomor HP" name="nohp">
				</li>
				<li class="d-inline-block">
					<label class="d-block">Tanggal Lahir</label>
					<input class="form-control input-md" type="date" name="tgllahir">
				</li>
			</ul>
	  </div>
	  	<div class="col-sm-12">
	  			<li class="d-inline-block">
					<label class="d-block">Date Range</label>
					<input type="date" class="form-control input-md" name="dateFrom">
				</li>
					to
				<li class="d-inline-block">
					<input type="date" class="form-control input-md" name="dateTo">
				</li>
				<li class="d-inline-block">
					<button class="btn btn-primary btn-md p-2" type="submit" name="srhDate">
						Search 
						<i class="fa fa-search h-3"></i>
					</button>
				</li>
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
		<thead style="background-color:#b7d8dc;">
		  <tr>
				<th>Kode Pasien</th>
				<th>Nama Pasien</th>
				<th>Kode Penjualan</th>
				<th>Tanggal</th>
				<th>Barang</th>
				<th>Qty</th>
				<th>Klinik</th>
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
						<td>";
						if(is_null($rs["kode_pelanggan"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["kode_pelanggan"];
						}echo
						"</td>
						<td>";
						if(is_null($rs["nama_pelanggan"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["nama_pelanggan"];
						}echo
						"</td>
						<td>"; 
						if(is_null($rs["kode_penjualan"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["kode_penjualan"];
						}echo
						"</td>
						<td>"; 
						if(is_null($rs["waktu"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["waktu"];
						}echo
						"</td>
						<td>"; 
						if(is_null($rs["nama_barang"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["nama_barang"];
						}echo
						"</td>
						<td>"; 
						if(is_null($rs["qty"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["qty"];
						}echo
						"</td>
						<td>"; 
						if(is_null($rs["nama_klinik"])){
							echo "Tidak Ada Nilai";
						}else{
							echo $rs["nama_klinik"];
						}echo
						"</td>
					</tr>" ;
				}
		  }						
		?>
		</tbody>
	  </table>
	<?php endif; ?>
	<script src="plugins/print/jquery-3.5.1.js"></script>
	<script>
			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Rekam Medis Pasien '+ d.toDateString() +'.xls';

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
$laporan_rm_pasien->terminate();
?>