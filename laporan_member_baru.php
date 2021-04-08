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
$laporan_member_baru = new laporan_member_baru();

// Run the page
$laporan_member_baru->run();

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

		$query = "SELECT m_member.kode_member, m_pelanggan.nama_pelanggan,m_jenis_member.nama_member , m_member.tgl_mulai
		FROM m_member
		JOIN m_pelanggan ON m_pelanggan.id_pelanggan = m_member.idpelanggan
		JOIN m_jenis_member ON m_jenis_member.id = m_member.jenis_member
		WHERE (m_member.tgl_mulai BETWEEN '$dateFrom' AND '$dateTo') ORDER BY m_member.kode_member";
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
				<td colspan="4" style="text-align: center;">
					<div class="col">
						<h5>Laporan Member Baru</h5>
						<?php if($dateTo != ''): ?>
							<p id="tgl-laporan"><?php echo tgl_indo($dateFrom) . " hingga " . tgl_indo($dateTo); ?></p>
						<?php else: ?>
							<p id="tgl-laporan">-</p>
						<?php endif; ?>
					</div>
				</td>
			</tr>
		  <tr  style="background-color:#b7d8dc;">
				<th>Kode Member</th>
				<th>Nama Pelanggan</th>
				<th>Jenis Member</th>
				<th>Tanggal Join</th>
		  </tr>
		</thead>
		<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
				echo '<tr><td  colspan="4" align="center">Kosong</td></tr>';	
				// print("<pre>".print_r($result,true)."</pre>");						
		  }else{
				foreach ($result as $rs) {
					echo "<tr>
						<td>".$rs['kode_member']."</td>
						<td>".$rs['nama_pelanggan']."</td>
						<td>".$rs['nama_member']."</td>
						<td>".$rs['tgl_mulai']."</td>
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
				filename = filename ? filename + '.xls' : 'Laporan Member Baru '+ d.toDateString() +'.xls';

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
$laporan_member_baru->terminate();
?>