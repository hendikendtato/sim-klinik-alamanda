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
$_komposisi = new _komposisi();

// Run the page
$_komposisi->run();

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
	
	$query = "SELECT * FROM komposisi
		JOIN m_barang ON m_barang.id = komposisi.id_barang";
		$result = ExecuteRows($query);

  	function rupiah($angka){
		$hasil_rupiah = number_format($angka);
		return $hasil_rupiah;
	}
?>

<div class="container-fluid">
	<div class="row">
		<button class="btn btn-info btn-md p-2 mb-3" onclick="exportTableToExcel('printTable')">
			Export to Excel
			<i class="far fa-file-excel"></i>
		</button>
		<table class="table table-bordered table-hover table-striped" id="printTable">
			<thead>
				<tr>
					<td colspan="3" style="text-align: center;">
						<div class="col">
							<h5>Komposisi</h5>
						</div>
					</td>
				</tr>
				<tr style="background-color:#b7d8dc;">
					<th>No.</th>
					<th>Nama Barang</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
				echo '<tr><td  colspan="3" align="center">Kosong</td></tr>';	
				// print("<pre>".print_r($result,true)."</pre>");						
		  }else{
				// $totalcabang = 0;
				$count = 0;
				foreach ($result as $rs) {
					// $totalcabang += $rs['subtotal'];
					$count += 1;
					echo "<tr id=".$rs["id_komposisi"].">
							<td>".$count.".</td>
							<td>".$rs['nama_barang']."</td>
							<td align='center'>
								<button class='btn btn-link' onclick='showDetails(".$rs["id_komposisi"].");'>
									detail
								</button>
							</td>
						</tr>
						<tr id='".$rs["id_komposisi"]."_detil' class='collapse'>
						<td class='ew-table-last-col' colspan='8'>
							<div>
								<table class='table'>
									<thead>
										<tr>
											<th>Nama Barang</th>
											<th>Satuan</th>		
											<th>Jumlah</th>
										</tr>
									</thead>
									<tbody>";
									$details = ExecuteRows("SELECT * FROM detailkomposisi
									JOIN m_barang ON m_barang.id = detailkomposisi.id_barang
									JOIN m_satuan_barang ON m_satuan_barang.id_satuan = detailkomposisi.id_satuan
									WHERE id_komposisi = '".$rs["id_komposisi"]."'");
									if(is_null($details) OR $details == FALSE) {
										echo '<tr><td  colspan="3" align="center">Kosong</td></tr>';
									} else {
										foreach ($details as $row) {
											echo "<tr>
												<td>".$row["nama_barang"]."</td>
												<td>".$row["nama_satuan"]."</td>
												<td>".$row["jumlah"]."</td>
												</tr>";
										}
									}
									echo "</tbody>
								</table>
							</div>
						</td>
					</tr>";
				}
			}			
		?>
		</tbody>
	  </table>

		<script src="plugins/print/jquery-3.5.1.js"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
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
				filename = filename ? filename + '.xls' : 'Laporan Komposisi '+ d.toDateString() +'.xls';

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
				console.log(classes);
				if (!classes[1]) {
					$(`#${id}_detil`).addClass('show')
				} else {
					$(`#${id}_detil`).removeClass('show')
				}
			}
		</script>
		<script>
			$(document).ready(function() {
				$("#tipe_mutasi").change(function(){
					console.log($(this).val());
				});
			});

			//$('.selectpicker').selectpicker();
		</script>
	</div>
</div>	

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$_komposisi->terminate();
?>