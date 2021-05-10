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
$laporan_penjualan_produk = new laporan_penjualan_produk();

// Run the page
$laporan_penjualan_produk->run();

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
		$Inputkategori = $_POST['Inputkategori'];
		$Inputsubkategori = $_POST['Inputsubkategori'];
		$multi_cabang = "";
		$and_kategori="";
		$and_subkategori="";

		if ($_POST['Inputkategori'] != null) {
			if($_POST['Inputkategori'] == 'All'){
				$and_kategori .= "";
			} else {
				$kategori = $_POST['Inputkategori'];
				$and_kategori .= "AND m_barang.kategori = '$kategori'";
			}
		}

		if ($_POST['Inputsubkategori'] != null) {
			if($_POST['Inputsubkategori'] == 'All'){
				$and_subkategori .= "";
			} else {
				$subkategori = $_POST['Inputsubkategori'];
				$and_subkategori .= "AND m_barang.subkategori = '$subkategori'";
			}
		}		
		
		foreach($cabang AS $in_cabang) {
			$multi_cabang .= "m_klinik.id_klinik = '" .$in_cabang. "' OR ";
			//var_dump($multi_klinik); die();
			//echo $in_klinik;
		}
		if($multi_cabang){
			$multi_cabang = substr($multi_cabang, 0, -4);
			$query = "SELECT detailpenjualan.id AS id, detailpenjualan.id_penjualan AS id_penjualan,
				penjualan.waktu AS waktu, penjualan.id_klinik AS id_klinik,
				detailpenjualan.id_barang AS id_barang, m_barang.nama_barang AS nama_barang,
				m_barang.satuan AS satuan, m_barang.jenis AS jenis, m_barang.kategori AS
				kategori, m_barang.subkategori AS subkategori, m_barang.komposisi AS
				komposisi, m_barang.tipe AS tipe, m_barang.status AS status,
				detailpenjualan.id_kemasan AS id_kemasan, detailpenjualan.harga_jual
				AS harga_jual, detailpenjualan.stok AS stok, detailpenjualan.expired
				AS expired, Sum(detailpenjualan.qty) AS qty, Sum(detailpenjualan.subtotal) AS
				subtotal, detailpenjualan.hna AS hna, detailpenjualan.disc_rp AS disc_rp,
				detailpenjualan.disc_pr AS disc_pr, m_klinik.nama_klinik AS nama_klinik
				FROM ((detailpenjualan JOIN
					penjualan ON penjualan.id = detailpenjualan.id_penjualan) JOIN
					m_barang ON detailpenjualan.id_barang = m_barang.id) JOIN
					m_klinik ON m_klinik.id_klinik = penjualan.id_klinik
				WHERE ($multi_cabang) AND (penjualan.waktu BETWEEN '$dateFrom' AND '$dateTo') AND m_barang.tipe <> 'Perawatan' $and_kategori $and_subkategori
				GROUP BY detailpenjualan.id_barang
				ORDER BY m_barang.nama_barang";
				$result = ExecuteRows($query);
	  }
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
		  	<!-- Cabang -->
			<label class="d-block">Cabang</label>
			<select class="selectpicker" name="cabang[]" multiple>
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
		<!-- Input Kategori -->
		<li class="d-inline-block">
			<label class="d-block">Input Kategori</label>
			<select class="form-control product-select" name="Inputkategori">
				<option value="All">All</option>
				<?php
					$sql = "SELECT * FROM kategoribarang";
					$res = ExecuteRows($sql);
					foreach ($res as $rs) {
						echo "<option value=" . $rs["id"] . ">" . $rs["nama"] . "</option>";
					}
				?>
			</select>
		</li>

			<!-- Input Subkategori -->
			<li class="d-inline-block">
				<label class="d-block">Input Subkategori</label>
				<select class="form-control product-select" name="Inputsubkategori">
					<option value="All">All</option>
					<?php
						$sql = "SELECT * FROM subkategoribarang";
						$res = ExecuteRows($sql);
						foreach ($res as $rs) {
							echo "<option value=" . $rs["id"] . ">" . $rs["nama"] . "</option>";
						}
					?>
				</select>
			</li>		  
		  <!-- Date Range -->
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
				<td colspan="3" style="text-align: center;">
					<div class="col">
						<h5>Laporan Penjualan Produk</h5>
						<h5>Cabang 
							<?php 
								if($result != false) {
									echo $result[0]['nama_klinik']; 
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
		  <tr  style="background-color:#b7d8dc;">
				<th>Nama Barang</th>
				<th>Jumlah Terjual</th>
				<th>Subtotal</th>
		  </tr>
		</thead>
		<tbody>
		  <?php
		  $no=1;
		  if (is_null($result) OR $result == false) {
				echo '<tr><td  colspan="3" align="center">Kosong</td></tr>';	
				// print("<pre>".print_r($result,true)."</pre>");						
		  }else{
				$totalcabang = 0;
				$mso='"\@"';
				foreach ($result as $rs) {
					$totalcabang += $rs['subtotal'];
					echo "<tr>
						<td>".$rs['nama_barang']."</td>
						<td style='text-align: right;'>".$rs['qty']."</td>
						<td style='text-align: right; mso-number-format:".$mso."'>".rupiah($rs['subtotal'])."</td>
					</tr>";
				}
			}			
		?>
		  <tr>
		  		<td colspan="2" align="right"><b>Total per Cabang</b></td>
				<td align="right" style="mso-number-format:'\@'">
				<b>
					<?php if(isset($totalcabang)) {
							echo rupiah($totalcabang);
						  }
						  $totalcabang = isset($totalcabang) ? $totalcabang : '0';
					?>
				</b>
				</td>
		  </tr>
		</tbody>
		<tfoot>
			
		</tfoot>
	  </table>
	<?php endif; ?>
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
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
				filename = filename ? filename + '.xls' : 'Laporan Penjualan Produk '+ d.toDateString() +'.xls';

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

		$(document).ready(function() {
			$('.selectpicker').select2({
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
$laporan_penjualan_produk->terminate();
?>