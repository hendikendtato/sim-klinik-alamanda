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
$laporan_saldo_kas = new laporan_saldo_kas();

// Run the page
$laporan_saldo_kas->run();

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
	
	$query = "SELECT laporan_kas.*, m_klinik.nama_klinik, m_kas.nama, mutasi_kas.no_bukti
		FROM laporan_kas
		LEFT JOIN m_klinik ON laporan_kas.id_klinik = m_klinik.id_klinik
		LEFT JOIN m_kas ON laporan_kas.id_kas = m_kas.id
		LEFT JOIN mutasi_kas ON laporan_kas.id_mutasi_kas = mutasi_kas.id
		WHERE (laporan_kas.tanggal BETWEEN '$dateFrom'
		AND '$dateTo')
		AND laporan_kas.id_klinik = '$cabang' GROUP BY laporan_kas.tanggal";
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
			<table class="table table-hover table-striped table-bordered" id="printTable">
				<thead>
				<tr>
					<td colspan="9" style="text-align: center;">
						<div class="col">
							<h5>Laporan Saldo Kas</h5>
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
					<tr style="background-color:#b7d8dc; text-align:center;">
						<th>No</th>
						<th>Nama Kas</th>
						<th>Klinik</th>						
						<th>Tanggal</th>
						<th>Saldo Awal</th>
						<th>Pemasukan</th>
						<th>Pengeluaran</th>
						<th>Sisa Saldo</th>
						<th>Detail</th>
					</tr>
				</thead>
				<tbody>
					<?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
			echo '<tr><td  colspan="9" align="center">Kosong</td></tr>';							
		  }else{
			$totalcabang = 0;
			foreach ($result as $rs) {

			$tgl = $rs['tanggal'];
			$jumlah_details = ExecuteRows("SELECT * FROM laporan_kas	  										
			WHERE laporan_kas.tanggal = '$tgl' AND laporan_kas.id_klinik=".$rs["id_klinik"]."");

			$total_jumlah_masuk = 0;
			$total_jumlah_keluar = 0;
			$total_saldo_awal = ExecuteScalar("SELECT saldo_awal FROM laporan_kas WHERE tanggal = '$tgl' AND id_klinik = ".$rs["id_klinik"]." ORDER BY id ASC LIMIT 1");
			$total_sisa_saldo = ExecuteScalar("SELECT sisa_saldo FROM laporan_kas WHERE tanggal = '$tgl' AND id_klinik = ".$rs["id_klinik"]." ORDER BY id DESC LIMIT 1");
			foreach($jumlah_details AS $jd){
				$tipe_mutasi = ExecuteScalar('SELECT tipe FROM mutasi_kas WHERE id = '.$jd['id_mutasi_kas'].'');
				
				if($tipe_mutasi == 'Mutasi Kas Keluar'){
					$total_jumlah_keluar += $jd['jumlah'];
				} else {
					$total_jumlah_masuk += $jd['jumlah'];
				}
			}


			//var_dump($subtotal_mutasi);	
				echo "<tr id=".$rs["id"].">
			 			<td>" . $no . ".</td>
			 			<td>" . $rs["nama"] . "</td>
			 			<td>" . $rs["nama_klinik"] . "</td>			 			
			 			<td>" . tgl_indo($rs["tanggal"]) . "</td>
			 			<td align='right'>" . rupiah($total_saldo_awal) . "</td>			 			
			 			<td align='right'>" . rupiah($total_jumlah_masuk) . "</td> 			 			
			 			<td align='right'>" . rupiah($total_jumlah_keluar) . "</td> 			 			
			 			<td align='right'>" . rupiah($total_sisa_saldo) . "</td> 			 			
						<td align='center'>
							<button class='btn btn-link' onclick='showDetails(".$rs["id"].");'>
				  				Detail
							</button>
						</td>
					</tr>
					<tr id='".$rs["id"]."_detil' class='collapse'>
						<td class='ew-table-last-col' colspan='9'>
							<div>
								<table class='table'>
									<thead>
										<tr>
											<th>Kode Penjualan</th>
											<th>Kode Mutasi Kas</th>
											<th>Tanggal</th>
											<th>Nama Pelanggan</th>
											<th>Diskon(%)</th>
											<th>Diskon(Rp)</th>
											<th>Total</th>											
										</tr>
									</thead>
									<tbody>";
									$tanggal = $rs['tanggal'];
									$kode_penjualan = $rs['kode_penjualan'];
									$details = ExecuteRows("SELECT * FROM laporan_kas	  										
									WHERE laporan_kas.tanggal = '$tanggal' AND laporan_kas.id_klinik=".$rs["id_klinik"]."");
									// dd($details);
								
									foreach ($details as $row) {
										$kode_mutasi = ExecuteScalar("SELECT no_bukti FROM mutasi_kas WHERE id=".$row["id_mutasi_kas"]."");
										$nama_pelanggan = ExecuteScalar('SELECT m_pelanggan.nama_pelanggan FROM penjualan JOIN m_pelanggan ON penjualan.id_pelanggan = m_pelanggan.id_pelanggan WHERE penjualan.kode_penjualan="'.$row["kode_penjualan"].'"');
										$diskon_persen = ExecuteScalar('SELECT diskon_persen FROM penjualan WHERE kode_penjualan="'.$row["kode_penjualan"].'"');
										$diskon_rupiah = ExecuteScalar('SELECT diskon_rupiah FROM penjualan WHERE kode_penjualan="'.$row["kode_penjualan"].'"');				

										echo "<tr>
											<td><a href='penjualanview.php?showdetail=detailpenjualan&amp;id=". $row["id"] ."'>".$row["kode_penjualan"]."<a></td>
											<td>".$kode_mutasi."</td>
											<td>".tgl_indo($row["tanggal"])."</td>
											<td>".$nama_pelanggan."</td>
											<td>".$diskon_persen."</td>
											<td>".$diskon_rupiah."</td>
											<td>".rupiah($row["jumlah"])."</td>
										</tr>";
									}
						echo "</tbody>
								</table>
							</div>
						</td>
					</tr>";			 		
					$no++;		
					$totalcabang += $total_sisa_saldo;	  
			}
		  }						
		?>
				<tr>
				<td colspan="7" align="right"><b>Total Saldo Kas</b></td>
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
				filename = filename ? filename + '.xls' : 'Laporan Saldo Kas '+ d.toDateString() +'.xls';

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
$laporan_saldo_kas->terminate();
?>