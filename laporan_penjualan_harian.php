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
$laporan_penjualan_harian = new laporan_penjualan_harian();

// Run the page
$laporan_penjualan_harian->run();

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
	$cabang = $_POST['cabang'];
	$dateFrom = $_POST['dateFrom'];
	$dateTo = $_POST['dateTo'];

	$query = "SELECT * FROM penjualan
	  JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik 
	  JOIN m_pelanggan ON penjualan.id_pelanggan = m_pelanggan.id_pelanggan 
	  JOIN detailpenjualan ON penjualan.id = detailpenjualan.id_penjualan
	  WHERE (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND m_klinik.id_klinik = '$cabang' AND penjualan.status = 'Printed' GROUP BY detailpenjualan.id_penjualan ORDER BY penjualan.waktu ASC, penjualan.id ASC";
	  $result = ExecuteRows($query);
}

		function rupiah($angka){
			 $hasil_rupiah = "Rp" . number_format($angka);
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
			<label class="d-block">Cabang</label>
			<select class="form-control" id="inputKlinik" name="cabang">
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
			<td colspan="10" style="text-align: center;">
				<div class="col">
					<h5>Laporan Harian Penjualan</h5>
					<h5>Cabang 
						<?php
							$resKlinik=ExecuteRows("SELECT * FROM m_klinik WHERE id_klinik='$cabang'");
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
		  <th>Tanggal</th>
		  <th>Kode</th>
		  <th>Customer</th>
		  <th>Bruto</th>
		  <th>Diskon (%)</th>
		  <th>Diskon (Rp)</th>
		  <th>PPN (%)</th>
		  <th>Total Voucher</th>
		  <th>Total</th>
		  <th></th>
		 </tr>
		</thead>
		<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
			echo '<tr><td  colspan="10" align="center">Kosong</td></tr>';							
		  }else{
			$totalcabang = 0;
			$totalbruto = 0;
			$totalvoucher = 0;
			$total_voucher = 0;
			$mso='"\@"';
			foreach ($result as $rs) {
				
				$subtotal = ExecuteScalar("SELECT SUM(subtotal) FROM detailpenjualan WHERE id_penjualan = ".$rs['id_penjualan']." ORDER BY id");
				$voucher = ExecuteRow("SELECT m_kartu.charge_price AS charge_voucher, penjualan.jumlah_voucher FROM penjualan JOIN m_kartu ON penjualan.id_kartu = m_kartu.id_kartu WHERE penjualan.id = '".$rs['id_penjualan']."'");
				if($voucher != false){
					$total_voucher = $voucher['charge_voucher'] * $voucher['jumlah_voucher'];
					$totalvoucher += $total_voucher;
				}
				
			echo "<tr id=".$rs["id_penjualan"].">
			<td>"; 
					if(is_null($rs["waktu"])){
						echo "Tidak Ada Nilai";
					}else{
						echo $rs["waktu"];
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
					if(is_null($rs["nama_pelanggan"])){
					  echo "Tidak Ada Nilai";
					}else{
						echo $rs["nama_pelanggan"];
					}echo
					"</td>
					<td align='right' style='mso-number-format:".$mso."'>" . rupiah($subtotal) . "</td>
				  <td align='center'>"; 
				  if($rs["diskon_persen"] == '0'){
					  echo "-";
					}else{
						echo $rs["diskon_persen"];
					}echo
					"</td>
					<td align='center' style='mso-number-format:".$mso."'>"; 
					if($rs["diskon_rupiah"] == '0'){
						echo "-";
					}else{
						echo rupiah($rs["diskon_rupiah"]);
					}echo
					"</td>
					<td align='center'>"; 
					if($rs["ppn"] == '0'){
						echo "-";
					}else{
						echo $rs["ppn"];
					}echo
					"</td>
					<td align='center'>"; 
					if(is_null($voucher) || $voucher == false){
						echo "-";
					}else{
					  echo rupiah($total_voucher);
					}echo
				  "</td>
				  <td align='right' style='mso-number-format:".$mso."'>"; 
					echo rupiah($rs["total"]);
					echo "</td>
					<td align='center'>
						<button class='btn btn-link' onclick='showDetails(".$rs["id_penjualan"].");'>
							detail
						</button>
					</td>
				</tr>
				<tr id='".$rs["id_penjualan"]."_detil' class='collapse'>
					<td class='ew-table-last-col' colspan=10>
						<div>
							<table>
								<thead>
									<tr>
										<th>Barang</th>
										<th>Harga Jual</th>
										<th>Qty</th>
										<th>Diskon(%)</th>
										<th>Diskon(Rp)</th>
										<th>Subtotal</th>
									</tr>
								</thead>
								<tbody>";
								$details = ExecuteRows("SELECT * FROM detailpenjualan
									JOIN m_barang ON detailpenjualan.id_barang = m_barang.id
									WHERE detailpenjualan.id_penjualan = ".$rs["id_penjualan"]."");
								foreach ($details as $row) {
									echo "<tr>
										<td>".$row["nama_barang"]."</td>
										<td style='mso-number-format:".$mso."'>".rupiah($row["harga_jual"])."</td>
										<td>".$row["qty"]."</td>
										<td>".$row["disc_pr"]."</td>
										<td style='mso-number-format:".$mso."'>".rupiah($row["disc_rp"])."</td>
										<td style='mso-number-format:".$mso."'>".rupiah($row["subtotal"])."</td>
									</tr>";
								}
					echo "</tbody>
							</table>
						</div>
					</td>
				</tr>";
			  $totalbruto += $subtotal;
			  $totalcabang += $rs["total"];
			}
			
		}						

		?>
		
		  <tr>
				<td colspan="3" align="right"><b>Total Bruto</b></td>
				<td align="right" style="mso-number-format:'\@'">
				<b>
					<?php if(isset($totalbruto)) {
							echo rupiah($totalbruto);
						  }
						  $totalbruto = isset($totalbruto) ? $totalbruto : '0';
					?>
				</b>
				</td>
				
				<td colspan="3" align="right"><b>Total per Cabang</b></td>
				<td align="right" style="mso-number-format:'\@'">
				<b>
					<?php if(isset($totalvoucher)) {
							echo rupiah($totalvoucher);
						  }
						  $totalvoucher = isset($totalvoucher) ? $totalvoucher : '0';
					?>
				</b>
				</td>				
				<td align="right" style="mso-number-format:'\@'">
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
	<script src="plugins/print/jquery-3.5.1.js"></script>
	<script>

function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Penjualan Harian '+ d.toDateString() +'.xls';

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
$laporan_penjualan_harian->terminate();
?>