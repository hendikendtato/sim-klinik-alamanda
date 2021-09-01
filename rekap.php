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
$rekap = new rekap();

// Run the page
$rekap->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
	// Function Tanggal Format Indonesia
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
	$Input  = $_POST['Inputbarang'];
	$Inputklinik = $_POST['Inputklinik'];

	$and = "";
	$and_barang = "";
	$order = "";
	$ascdesc = "";

	$multi_klinik = "";
	$nama_cabang = "";

	 foreach($Inputklinik AS $in_klinik) {
			$multi_klinik .= "m_hargajual.id_klinik = '" .$in_klinik. "' OR ";
			$nama_cabang .= "id_klinik= '" .$in_klinik. "' OR ";
			//var_dump($multi_klinik); die();
			//echo $in_klinik;
	}
	
	if ($_POST['Inputbarang'] != null) {
		$barang = $_POST['Inputbarang'];
		if($barang == 'All') {
			$and_barang = '';
		} else {
			$and_barang .= "AND m_hargajual.id_barang = '$barang'";
		}
	}
	
	if (isset($_POST['Inputjenis'])) {
		$jenis = $_POST['Inputjenis'];
		$and .= "AND m_barang.jenis = '$jenis' ";
	}
	if (isset($_POST['Inputkategori'])) {
		$kategori = $_POST['Inputkategori'];
		$and .= "AND m_barang.kategori = '$kategori' ";
	}
	if (isset($_POST['Inputsubkategori'])) {
		$subkategori = $_POST['Inputsubkategori'];
		$and .= "AND m_barang.subkategori = '$subkategori' ";
	}

	if ($_POST['InputOrderBy'] != null) {
		$orderBy = $_POST['InputOrderBy'];
		$order .= "ORDER BY m_barang.$orderBy";
	}

	if ($_POST['InputAscDesc'] != null) {
		$orderAscDesc = $_POST['InputAscDesc'];
		$ascdesc .= " $orderAscDesc";
	}

	// Jika input "All"
	if($multi_klinik){
		$multi_klinik = substr($multi_klinik, 0, -4);

		$query = ExecuteRows("SELECT * FROM m_hargajual 
		JOIN m_klinik ON m_klinik.id_klinik = m_hargajual.id_klinik 
		JOIN m_barang ON m_barang.id = m_hargajual.id_barang 
		WHERE ($multi_klinik) AND m_barang.komposisi = 'No' $and $and_barang $order $ascdesc");
	
	// Stok Akhir per barang
	// $akhir ="SELECT stok_akhir FROM kartustok 
	//   JOIN m_barang ON kartustok.id_barang = m_barang.id 
	//   JOIN m_klinik ON kartustok.id_klinik = m_klinik.id_klinik 
	//   WHERE (kartustok.tanggal BETWEEN '$dateFrom' AND '$dateTo') AND m_barang.nama_barang = '$Input' AND ($multi_klinik) ORDER BY id_kartustok DESC LIMIT 1";
	// 	$stok = ExecuteRow($akhir);	
  }
}
?>

<div class="container-fluid">
  <div class="row">
	<form method="post" action="<?php echo CurrentPageName() ?>" id="form-search">
	  <!-- token itu penting buat form method post -->
	  <?php if ($Page->CheckToken) { ?>
		<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
	  <?php } ?>
	  <div class="col-md-12">
		<h3>Cari Data Berdasarkan</h3>
		<ul class="list-unstyled">
		
			<!-- Input Barang -->
			<li class="d-inline-block">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Barang" id='barang'>
					<div class="input-group-append">
						<button class="btn btn-outline-info" type="button" id="button-addon2" data-toggle="modal" data-target="#modal"><i class="fas fa-search ew-icon"></i></button>
					</div>
					<input type="hidden" class="form-control" placeholder="Barang" id='id_barang' name="Inputbarang">
				</div>		
			</li>

			<!-- Input Jenis barang -->
			<li class="d-inline-block">
				<label class="d-block">Jenis</label>
				<select class="form-control product-select" name="Inputjenis">
					<option selected disabled>Select</option>
					<?php
					$sql = "SELECT * FROM jenisbarang";
					$res = ExecuteRows($sql);

					foreach ($res as $rs) {
						echo "<option value=" . $rs["id"] . ">" . $rs["jenis"] . "</option>";
					}
					?>
				</select>
			</li>

			<!-- Input Kategori -->
			<li class="d-inline-block">
				<label class="d-block">Kategori</label>
				<select class="form-control product-select" name="Inputkategori">
					<option selected disabled>Select</option>
					<?php
					$sql = "SELECT * FROM kategoribarang";
					$res = ExecuteRows($sql);

					foreach ($res as $rs) {
						echo "<option value=" . $rs["id"] . ">" . $rs["nama"] . "</option>";
					}
					?>
				</select>
			</li>

			<!-- Input SubKategori -->
			<li class="d-inline-block">
				<label class="d-block">SubKategori</label>
				<select class="form-control product-select" name="Inputsubkategori">
					<option selected disabled>Select</option>
					<?php
					$sql = "SELECT * FROM subkategoribarang";
					$res = ExecuteRows($sql);

					foreach ($res as $rs) {
						echo "<option value=" . $rs["id"] . ">" . $rs["nama"] . "</option>";
					}
					?>
				</select>
			</li>

			<!-- Input Klinik -->
			<li class="d-inline-block">
				<label class="d-block">Input Klinik</label>
				<select class="selectpicker" id="inputKlinik" name="Inputklinik[]" multiple="multiple" style="width:210px; height: 40px;">
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

			<!-- Order By -->
			<li class="d-inline-block">
				<label class="d-block">Order By</label>
					<select class="form-control product-select" name="InputOrderBy">
						<option value="">Select</option>
						<option value="kode_barang">Kode Barang</option>
						<option value="nama_barang">Nama Barang</option>
					</select>
			</li>

			<!-- Order Asc Desc -->
			<li class="d-inline-block">
				<select class="form-control product-select" name="InputAscDesc">
					<option value="">Select</option>
					<option value="ASC">Ascending</option>
					<option value="DESC">Descending</option>
				</select>
			</li>
			
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
		<!-- <button class="btn btn-info btn-md p-2 mb-3" onclick="exportTableToExcel('printTable')">
			Export to Excel
			<i class="far fa-file-excel"></i>
		</button> -->
			<table class="table table-hover table-striped table-bordered" id="printTable">
				<thead>
					<tr>
						<td colspan="12" style="text-align: center;">
							<div class="col">
								<h5>Laporan Rekap Stok</h5>
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
								<?php if($dateTo != ''): ?>
									<p id="tgl-laporan"><?php echo tgl_indo($dateFrom) . " hingga " . tgl_indo($dateTo); ?></p>
								<?php else: ?>
									<p id="tgl-laporan">-</p>
								<?php endif; ?>
							</div>
						</td>
					</tr>
					<tr style="background-color:#b7d8dc;" align="center">
						<th>No</th>
						<th>Nama barang</th>
						<th>Klinik</th>
						<th>Stok Awal</th>
						<th>Masuk</th>
						<th>Masuk Penyesuaian</th>
						<th>Keluar Penjualan</th>
						<th>Keluar Nonjual</th>
						<th>Keluar Penyesuaian</th>
						<th>Keluar Kirim</th>
						<th>Retur</th>
						<th>Stok Akhir</th>
					</tr>
				</thead>
				<tbody>
				<?php

				$no=1;
				if (is_null($query) OR $query == false) {
					echo '<tr><td  colspan="12" align="center">Kosong</td></tr>';							
				} else{
					foreach ($query as $rs) {
						//echo each <tr>
							// $stok_awal = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE (kartustok.tanggal BETWEEN '$dateFrom' AND '$dateTo') AND m_klinik.nama_klinik = '$Inputklinik' AND id_kartustok IN (SELECT MAX(id_kartustok) FROM kartustok GROUP BY id_barang) GROUP BY id_barang");
							$stok_awal = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo') ORDER BY tanggal ASC, id_kartustok ASC LIMIT 1");
							$jml_masuk = ExecuteScalar("SELECT SUM(masuk) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$jml_masuk_penyesuaian = ExecuteScalar("SELECT SUM(masuk_penyesuaian) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$jml_keluar = ExecuteScalar("SELECT SUM(keluar) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$jml_keluar_nonjual = ExecuteScalar("SELECT SUM(keluar_nonjual) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$jml_keluar_penyesuaian = ExecuteScalar("SELECT SUM(keluar_penyesuaian) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$jml_keluar_kirim = ExecuteScalar("SELECT SUM(keluar_kirim) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$jml_retur = ExecuteScalar("SELECT SUM(retur) FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo')");
							$stok_akhir = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND (tanggal BETWEEN '$dateFrom' AND '$dateTo') ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1 ");										
						echo "<tr>
								<td align='center'>" . $no . ".</td>
								<td align='center'>" . $rs["nama_barang"] . "</td>
								<td align='center'>" . $rs["nama_klinik"] . "</td>								
								<td align='center'>" ; 
											if(is_null($stok_awal) OR $stok_awal == ''){
												$stok_awal_sebelumnya = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND tanggal < '$dateFrom' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												if(is_null($stok_awal_sebelumnya) OR $stok_awal_sebelumnya == ''){
													echo "0.00";
												}else{
													echo $stok_awal_sebelumnya;
												}
											}else{
												echo $stok_awal;
											}echo  "</td>		
								<td align='center'>" ; 
											if(is_null($jml_masuk)){
												echo "0.00";
											}else{
												echo $jml_masuk;
											}echo  "</td>
								<td align='center'>" ; 
											if(is_null($jml_masuk_penyesuaian)){
												echo "0.00";
											}else{
												echo $jml_masuk_penyesuaian;
											}echo  "</td>
								<td align='center'>" ; 
											if(is_null($jml_keluar)){
												echo "0.00";
											}else{
												echo $jml_keluar;
											}echo  "</td>		
								<td align='center'>" ;
											if(is_null($jml_keluar_nonjual)){
												echo "0.00";
											}else{
												echo $jml_keluar_nonjual;
											}echo  "</td>		
								<td align='center'>" ;
											if(is_null($jml_keluar_penyesuaian)){
												echo "0.00";
											}else{
												echo $jml_keluar_penyesuaian;
											}echo  "</td>
								<td align='center'>" ;
											if(is_null($jml_keluar_kirim)){
												echo "0.00";
											}else{
												echo $jml_keluar_kirim;
											}echo  "</td>
								<td align='center'>" ; 
											if(is_null($jml_retur)){
												echo "0.00";
											}else{
												echo $jml_retur;
											}echo  "</td>		
								<td align='center'>" ; 
											if(is_null($stok_akhir) OR $stok_akhir == ''){
												$stok_akhir_sebelumnya = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = ".$rs['id_barang']." AND id_klinik = ".$rs['id_klinik']." AND tanggal < '$dateTo' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												if(is_null($stok_akhir_sebelumnya) OR $stok_akhir_sebelumnya == ''){
													echo "0.00";
												}else{
													echo $stok_akhir_sebelumnya;
												}
											}else{
												echo $stok_akhir;
											}echo  "</td>		
							</tr>" ;
						$no++;
					}
				}						
				?>
				</tbody>
			</table>
	<?php endif; ?>

			<link rel="stylesheet" type="text/css" href="plugins/datatables/datatables.min.css"/>
			<script src="jquery/jquery.js"></script>

			<div id="modal" class="modal fade" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form role="form" id="form-tambah" method="post" action="input.php">
						<div class="modal-header text-center">
							<h3 class="modal-title">Pilih Produk</h3>
						</div>
							<div class="modal-body">
							
									<table width="100%" class="table table-hover"  id="example">
										<thead>
											<tr>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr id="barang" data-kode="All" name='All'>
												<td>All</td> 
											</tr>
											<?php
												$sql = "SELECT * FROM m_barang WHERE tipe != 'Perawatan' ORDER BY id ASC";
												$res = ExecuteRows($sql);
												foreach ($res as $rs) {
													echo "<tr id='barang' data-kode='".$rs['id']."' name='".$rs['nama_barang']."'>
																<td>".$rs['nama_barang']."</td>
														</tr>";
												}
											?>

										</tbody>
									</table>
							
							</div> 
						
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
							</div>
					</div>
				</div>
			</div>
			  <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
			  	<div class="modal-dialog modal-sm modal-dialog-centered">
	
			  	<!-- Modal content-->
			  	<div class="modal-content">
			  		<div class="modal-body">
			  			<b align="center">Please wait...</b>
			  		</div>
			  	</div>
	  
			  	</div>
			  </div>
					
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

	<script src="plugins/datatables/datatables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
			
	<script>
			function exportTableToExcel(tableID, filename = '') {
				var downloadLink;
				var dataType = 'data:application/vnd.ms-excel';
				var tableSelect = document.getElementById(tableID);
				var tableHTML = encodeURIComponent(tableSelect.outerHTML);
				var d = new Date();

				// Specify file name
				filename = filename ? filename + '.xls' : 'Laporan Rekap Stok '+ d.toDateString() +'.xls';

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
			$('.selectpicker').select2({
				placeholder: "Select Klinik",
				allowClear: true,
				language: "id"
			});

			var d = new Date();
			$('#printTable').DataTable({
				dom: 'Bfrtip',
					buttons: [
						{
							extend: 'excelHtml5',
							text: 'Export to Excel <i class="far fa-file-excel"></i>',
							className: 'btn btn-info btn-md p-2',
							title: 'Laporan Rekap Stok '+ d.toDateString()
						}
					]
			});
		});
	</script>

			<script>
				$(document).ready(function(){
					$('#example').DataTable({
						"ordering": false
					});

					$(document).on('click', '#barang', function (e) {
						document.getElementById("barang").value = $(this).attr('name');
						document.getElementById("id_barang").value = $(this).attr('data-kode');
						$('#modal').modal('hide');
					});
				});
			</script>
			<script>
				$(document).ready(function(){
					$(document).on('click', '#barang', function (e) {
						document.getElementById("barang").value = $(this).attr('name');
						document.getElementById("id_barang").value = $(this).attr('data-kode');
						$('#modal').modal('hide');
					});
				});
			</script>
			<script>
				$('#form-search').on('submit', function(ev) {
					$("#myModal").modal();
					$("#myModal").modal({backdrop: 'static', keyboard: false});
				});
			</script>
  </div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$rekap->terminate();
?>