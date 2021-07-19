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
$Dasbor = new Dasbor();

// Run the page
$Dasbor->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<script src="js/Chart.min.js"></script>
<style>
	.card{
		border:none;
		border-width: 5px;
		border-left-style: solid;
		border-radius: 4px;
	}
</style>

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

	function rupiah($angka){
		$hasil_rupiah = "Rp " . number_format($angka);
		return $hasil_rupiah;
   }
	
?>

<div class="row">
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-4 border-primary shadow h-90 py-2">
			<div class="card-body align-items-center d-flex justify-content-left">	
				<div class="col-xl-9">
					<div class="text-md font-weight-bold text-primary text-uppercase mb-1">TOTAL PASIEN</div>
					<?php
						$tanggal = date("Y-m-d");
						$pasien = ExecuteScalar("SELECT COUNT(DISTINCT(id_pelanggan)) FROM penjualan WHERE waktu = '$tanggal' ");
						echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$pasien."</div>";
					?>
				</div>
				<div class="col-xl-3 text-center">
					<i class="fas fa-users fa-3x" style="color:#dee2e6;"></i>
				</div>	
			</div>
		</div>
	</div>	
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-4 border-success shadow h-90 py-2">
			<div class="card-body align-items-center d-flex justify-content-left">	
				<div class="col-xl-9">
					<div class="text-md font-weight-bold text-success text-uppercase mb-1">Total Transaksi</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php
							$tanggal = date("Y-m-d");
							$jumlah_transaksi = ExecuteScalar("SELECT COUNT(id) FROM penjualan WHERE waktu = '$tanggal'");
							echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".$jumlah_transaksi."</div>";
						?>
					</div>
				</div>
				<div class="col-xl-3 text-center">
					<i class="fas fa-cart-arrow-down fa-3x" style="color:#dee2e6;"></i>
				</div>	
			</div>
		</div>
	</div>	
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-4 border-info shadow h-90 py-2">
			<div class="card-body align-items-center d-flex justify-content-left">	
				<div class="col-xl-9">
					<div class="text-md font-weight-bold text-info text-uppercase mb-1">Total Penjualan</div>
						<?php
							$tanggal = date("Y-m-d");
							$total_penjualan = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE waktu = '$tanggal'");
							echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".rupiah($total_penjualan)."</div>";
						?>
					</div>
				<div class="col-xl-3 text-center">
					<i class="fas fa-dollar-sign fa-3x" style="color:#dee2e6;"></i>
				</div>	
			</div>
		</div>
	</div>	
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-4 border-warning shadow h-90 py-2">
			<div class="card-body align-items-center d-flex justify-content-left">	
				<div class="col-xl-9">
					<div class="text-md font-weight-bold text-warning text-uppercase mb-1">total pengeluaran</div>
					<div class="h5 mb-0 font-weight-bold text-gray-800">
						<?php
							$tanggal = date("Y-m-d");
							$total_pengeluaran = ExecuteScalar("SELECT SUM(jumlah) FROM detailmutasibank LEFT JOIN mutasi_kas ON mutasi_kas.id = detailmutasibank.pid WHERE mutasi_kas.tgl = '$tanggal' AND tipe = 'Mutasi Kas Keluar'");
							echo "<div class='h5 mb-0 font-weight-bold text-gray-800'>".rupiah($total_pengeluaran)."</div>";
						?>
					</div>
				</div>
				<div class="col-xl-3 text-center">
					<i class="fas fa-funnel-dollar fa-3x" style="color:#dee2e6;"></i>
				</div>	
			</div>
		</div>
	</div>	
</div>
<br>
<div class="row mb-4">
	<!-- Area Chart -->
	<div class="col-xl-8 col-lg-7">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Pendapatan Harian</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-area">
					<canvas id="myAreaChart"></canvas>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Transaksi Penjualan</h6>
			</div>
			<div class="card-body">
   				<?php
				$tanggal = date("Y-m-d");
				$penjualan_perawatan = ExecuteScalar("SELECT COUNT(detailpenjualan.id) FROM detailpenjualan LEFT JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan
				WHERE detailpenjualan.id_barang IN (SELECT id_barang FROM komposisi) AND penjualan.waktu = '$tanggal'");
				
				$penjualan_produk = ExecuteScalar("SELECT COUNT(detailpenjualan.id) FROM detailpenjualan LEFT JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan
				WHERE detailpenjualan.id_barang NOT IN (SELECT id_barang FROM komposisi) AND penjualan.waktu = '$tanggal'");
				$total_penjualan = ExecuteScalar("SELECT COUNT(detailpenjualan.id) FROM detailpenjualan LEFT JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.waktu = '$tanggal'");
				
				$persentase_perawatan = (($penjualan_perawatan == FALSE) OR ($total_penjualan == FALSE)) ? "0" : number_format($penjualan_perawatan/$total_penjualan, 2, '.','') * 100;
				$persentase_produk = (($penjualan_produk == FALSE) OR ($total_penjualan == FALSE)) ? "0" : number_format($penjualan_produk/$total_penjualan, 2, '.','') * 100;
				echo "<h4 class='small font-weight-bold'>Perawatan <span class='float-right'>$persentase_perawatan%</span></h4>
				<div class='progress mb-4'>
					<div class='progress-bar bg-danger' role='progressbar' style='width: $persentase_perawatan%' aria-valuenow='$persentase_perawatan' aria-valuemin='0' aria-valuemax='100'></div>
				</div>
				<h4 class='small font-weight-bold'>Produk <span class='float-right'>$persentase_produk%</span></h4>
				<div class='progress mb-4'>
					<div class='progress-bar bg-warning' role='progressbar' style='width: $persentase_produk%' aria-valuenow='$persentase_produk' aria-valuemin='0' aria-valuemax='100'></div>
				</div>"
				?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<!-- TARGET CABANG -->
	<div class="col-xl-6 col-lg-6">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Omset Cabang</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
			<table class="table table-hover table-bordered">
					<thead class="bg-info">
						<tr>
							<th>No.</th>
							<th>Cabang</th>
							<th>Target</th>
							<th>Baseline</th>
							<th>Aset</th>
							<th>Aktual</th>
							<th>Pencapaian</th>
							<th>Prosentase</th>
						</tr>
					</thead>
					<tbody>
   						<?php
						$no = 1;
   							$cabang = ExecuteRows('SELECT * FROM m_klinik');
							foreach ($cabang as $cb) {
								$bulan = date('m');
								$tahun = date('Y');
								$result = ExecuteRow("SELECT * FROM m_target_omset_cabang JOIN m_klinik ON m_klinik.id_klinik = m_target_omset_cabang.id_cabang WHERE MONTH(m_target_omset_cabang.tgl_awal) = '$bulan' AND YEAR(m_target_omset_cabang.tgl_awal) = '$tahun' AND m_target_omset_cabang.id_cabang='".$cb['id_klinik']."'");
								$target = (is_null($result) OR $result == false) ? "0" : $result['target'];
								$baseline = (is_null($result) OR $result == false) ? "0" : $result['baseline'];
								$aset = (is_null($result) OR $result == false) ? "0" : $result['aset'];

								$aktual = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun' AND id_klinik = '".$cb['id_klinik']."'");
								$pencapaian = ($aktual-$target);
								$prosentase = ($pencapaian == '0') ? "0" : ($pencapaian / $target * 100);
								echo "<tr>
									<td>".$no."</td>
									<td>".$cb['nama_klinik']."</td>
									<td>".rupiah($target)."</td>
									<td>".rupiah($baseline). "</td>
									<td>".rupiah($aset)."</td>
									<td>";if(is_null($aktual) OR $aktual == false ){
										echo "0";
									}else{
										echo rupiah($aktual);
									} echo "</td>
									<td>".rupiah($pencapaian)."</td>
									<td>".$prosentase."%</td>			
								</tr>";
								$no++;
							}
						?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>

	<!-- TARGET PERSONAL -->
	<div class="col-xl-6 col-lg-6">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Omset Personal</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="row justify-content-end">
					<div class="col-md-auto">
						<form method="post" action="<?php echo CurrentPageName() ?>" id="form-periode">
							<!-- token itu penting buat form method post -->
							<?php if ($Page->CheckToken) { ?>
								<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
							<?php } ?>
								<select class="custom-select" id="select-cabang" name="select-cabang">
									<option selected>Pilih Cabang</option>
									<?php
										$cabang = ExecuteRows("SELECT * FROM m_klinik");
										foreach ($cabang as $value) {
											echo "<option value='".$value['id_klinik']."'>".$value['nama_klinik']."</option>";
										}
									?>
								</select>
							<button class="btn btn-primary btn-md p-2" type="submit" name="cabang" id="cabang" hidden></button>
						</form>
					</div>
				</div>
				<br>				
			<table class="table table-hover table-bordered">
					<thead class="bg-info">
						<tr>
							<th>No.</th>
							<th>Jabatan</th>
							<th>Nama</th>
							<th>Target</th>
							<th>Aktual</th>
							<th>Pencapaian</th>
							<th>Prosentase</th>
						</tr>
					</thead>
					<tbody>
   						<?php
						  	if(isset($_POST['cabang'])) {
								  $cabang = $_POST['select-cabang'];

								  $no = 1;
								  $mso='"\@"';
								  $bulan = date('m');
								  $tahun = date('Y');
								  $result = ExecuteRows("SELECT * FROM detailpenjualan 
									  JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan 
									  JOIN m_klinik ON penjualan.id_klinik = m_klinik.id_klinik WHERE penjualan.id_klinik = '$cabang' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND detailpenjualan.komisi_recall IS NOT NULL GROUP BY detailpenjualan.komisi_recall");

								  foreach ($result as $rs) {
									$pegawai = ExecuteRow("SELECT m_jabatan.id AS id_jabatan, m_jabatan.nama_jabatan, m_pegawai.* FROM m_pegawai JOIN m_jabatan ON m_pegawai.jabatan_pegawai = m_jabatan.id WHERE m_pegawai.id_pegawai = '".$rs['komisi_recall']."'");																				
									$target = ExecuteRow("SELECT * FROM m_target_omset_personal WHERE id_jabatan = '".$pegawai['id_jabatan']."' AND id_cabang = '$cabang' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
									$aktual = ExecuteScalar("SELECT sum(detailpenjualan.subtotal) FROM detailpenjualan 
									JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun' AND detailpenjualan.komisi_recall = '".$rs['komisi_recall']."'");
									echo "<tr>
											<td align='center'>" . $no . ".</td>
											<td align='center'>" . $pegawai['nama_jabatan'] . "</td>
											<td align='center'>" . $pegawai['nama_pegawai'] . "</td>
											<td align='center' style='mso-number-format:".$mso."'>" . rupiah($target['target']) . "</td>
											<td align='center' style='mso-number-format:".$mso."'>" . rupiah($aktual) . "</td>
											<td align='center' style='mso-number-format:".$mso."'>" . rupiah($aktual - $target['target']). "</td>
											<td align='center'>" . ROUND((($aktual - $target['target']) / $target['target']) * 100) . "%</td>
										</tr>" ;
									$no++;
								  }
							} 
						?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>

	<!-- TARGET PRODUK TERJUAL -->
	<div class="col-xl-4 col-lg-4">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Produk Terjual</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="row justify-content-end">
					<div class="col-md-auto">
						<form method="post" action="<?php echo CurrentPageName() ?>" id="form-periode">
							<!-- token itu penting buat form method post -->
							<?php if ($Page->CheckToken) { ?>
								<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
							<?php } ?>
									<?php
										$status = ExecuteRows("SELECT * FROM m_status_barang");
										foreach ($status as $value) {
											echo "<input type='checkbox' name='status[]' value='".$value['id_status']."'>
											<label for='".$value['status_barang']."'>".$value['status_barang']."</label>    ";
										}
									?>
								<select class="custom-select" id="select-cabang-produk" name="select-cabang-produk">
									<option selected>Pilih Cabang</option>
									<?php
										$cabang = ExecuteRows("SELECT * FROM m_klinik");
										foreach ($cabang as $value) {
											echo "<option value='".$value['id_klinik']."'>".$value['nama_klinik']."</option>";
										}
									?>
								</select>
							<button class="btn btn-primary btn-md p-2" type="submit" name="cabang-produk" id="cabang-produk" hidden></button>
						</form>
					</div>
				</div>
				<br>				
			<table class="table table-hover table-bordered">
					<thead class="bg-info">
						<tr>
							<th>No.</th>
							<th>Nama Barang</th>
							<th>Aktual</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
   						<?php
						  	if(isset($_POST['cabang-produk'])) {
								  $cabang_produk = $_POST['select-cabang-produk'];
								  $inputStatus = $_POST['status'];

								  $no = 1;
								  $mso='"\@"';
								  $bulan = date('m');
								  $tahun = date('Y');
								  $multi_status = "";
								  $status = "";
								  $id_status = "";

								  foreach($inputStatus AS $in_status) {
									$multi_status .= "m_hargajual.status = '" .$in_status. "' OR ";
									$status .= "m_target_produk.status LIKE '%" .$in_status. "%' OR ";
									$id_status .= "id_status = '" .$in_status. "' OR ";
									}
							
									if($multi_status && $status){
										$multi_status = substr($multi_status, 0, -4);
										$status = substr($status, 0, -4);
										$id_status = substr($id_status, 0, -4);
										$result_produk = ExecuteRows("SELECT * FROM m_hargajual 
													JOIN m_barang ON m_hargajual.id_barang = m_barang.id 
													JOIN m_status_barang ON m_hargajual.status = m_status_barang.id_status WHERE ($multi_status) AND m_barang.tipe != 'Perawatan' AND m_hargajual.id_klinik = '$cabang_produk'");
										$target_produk = ExecuteScalar("SELECT target FROM m_target_produk WHERE ($status) AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
										$nama_status = ExecuteRows("SELECT status_barang FROM m_status_barang WHERE ($id_status)");
									}
								  
								  $aktual_total_produk = 0;
								  foreach ($result_produk as $rs) {
									$aktual_produk = ExecuteScalar("SELECT sum(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang_produk' AND detailpenjualan.id_barang = '".$rs['id_barang']."' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun'");
									echo "<tr>
											<td>".$no."</td>
											<td>".$rs['nama_barang']."</td>
											<td style='text-align:right;'>".$aktual_produk."</td>
											<td>".$rs['status_barang']."</td>
										</tr>";
										$no++;
										$aktual_total_produk += $aktual_produk;
								  }
						?>
						<tr>
							<td colspan='2'>Aktual / Total</td>
							<td style='text-align:right;'><?= $aktual_total_produk; ?></td>
						</tr>
						<tr>
							<td colspan='2'>Pencapaian</td>
							<td style='text-align:right;'><?= $aktual_total_produk - $target_produk; ?></td>
						</tr>
						<tr>
							<td colspan='2'>Prosentase</td>
							<td style='text-align:right;'><?= (($aktual_total_produk - $target_produk) / $target_produk) * 100; ?> %</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>


	<!-- TARGET PERAWATAN TERJUAL -->
	<div class="col-xl-4 col-lg-4">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Perawatan Terjual</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="row justify-content-end">
					<div class="col-md-auto">
						<form method="post" action="<?php echo CurrentPageName() ?>" id="form-periode">
							<!-- token itu penting buat form method post -->
							<?php if ($Page->CheckToken) { ?>
								<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
							<?php } ?>
								<?php
									$status = ExecuteRows("SELECT * FROM jenisbarang");
									foreach ($status as $value) {
										echo "<input type='checkbox' name='jenis[]' value='".$value['id']."'>
										<label for='".$value['jenis']."'>".$value['jenis']."</label>    ";
									}
								?>			
								<select class="custom-select" id="select-cabang-perawatan" name="select-cabang-perawatan">
									<option selected>Pilih Cabang</option>
									<?php
										$cabang = ExecuteRows("SELECT * FROM m_klinik");
										foreach ($cabang as $value) {
											echo "<option value='".$value['id_klinik']."'>".$value['nama_klinik']."</option>";
										}
									?>
								</select>
							<button class="btn btn-primary btn-md p-2" type="submit" name="cabang-perawatan" id="cabang-perawatan" hidden></button>
						</form>
					</div>
				</div>
				<br>				
			<table class="table table-hover table-bordered">
					<thead class="bg-info">
						<tr>
							<th>No.</th>
							<th>Nama Barang</th>
							<th>Aktual</th>
							<th>Jenis</th>
						</tr>
					</thead>
					<tbody>
   						<?php
						  	if(isset($_POST['cabang-perawatan'])) {
								  $cabang_perawatan = $_POST['select-cabang-perawatan'];
								  $Inputjenis  = $_POST['jenis'];

								  $no = 1;
								  $mso='"\@"';
								  $bulan = date('m');
								  $tahun = date('Y');
								  $multi_jenis = "";
								  $jenis = "";
								  $id_jenis = "";
								  
								  foreach($Inputjenis AS $in_jenis) {
									  $multi_jenis .= "m_barang.jenis = '" .$in_jenis. "' OR ";
									  $jenis .= "m_target_perawatan.jenis LIKE '%" .$in_jenis. "%' OR ";
									  $id_jenis .= "id = '" .$in_jenis. "' OR ";
								  }
						  
								  if($multi_jenis && $jenis){
									  $multi_jenis = substr($multi_jenis, 0, -4);
									  $jenis = substr($jenis, 0, -4);
									  $id_jenis = substr($id_jenis, 0, -4);
									  $result_perawatan = ExecuteRows("SELECT * FROM m_hargajual 
												  JOIN m_barang ON m_hargajual.id_barang = m_barang.id 
												  JOIN jenisbarang ON m_barang.jenis = jenisbarang.id WHERE ($multi_jenis) AND m_barang.tipe = 'Perawatan' AND m_hargajual.id_klinik = '$cabang_perawatan'");
									  $target_perawatan = ExecuteScalar("SELECT target FROM m_target_perawatan WHERE ($jenis) AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
									  $nama_jenis = ExecuteRows("SELECT jenis FROM jenisbarang WHERE ($id_jenis)");
								  }

								  $aktual_total_perawatan = 0;
								  if(is_null($result_perawatan) OR $result_perawatan == FALSE) {
									  echo '<tr><td colspan="3" align="center">Kosong</td></tr>';
								  } else {
									  $no = 1;
									  foreach ($result_perawatan as $rs) {
										  $aktual_perawatan = ExecuteScalar("SELECT sum(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE penjualan.id_klinik = '$cabang_perawatan' AND detailpenjualan.id_barang = '".$rs['id_barang']."' AND MONTH(penjualan.waktu) = '$bulan' AND YEAR(penjualan.waktu) = '$tahun'");
										  echo "<tr>
											  <td>".$no."</td>
											  <td>".$rs['nama_barang']."</td>
											  <td style='text-align:right;'>".$aktual_perawatan."</td>
											  <td>".$rs['jenis']."</td>
										  </tr>";
										  $no++;
										  $aktual_total_perawatan += $aktual_perawatan;
									  }
								  } 
						?>
						<tr>
							<td colspan='2'>Aktual / Total</td>
							<td style='text-align:right;'><?= $aktual_total_perawatan; ?></td>
						</tr>
						<tr>
							<td colspan='2'>Pencapaian</td>
							<td style='text-align:right;'><?= $aktual_total_perawatan - $target_perawatan; ?></td>
						</tr>
						<tr>
							<td colspan='2'>Prosentase</td>
							<td style='text-align:right;'><?= ROUND((($aktual_total_perawatan - $target_perawatan) / $target_perawatan) * 100); ?> %</td>
						</tr>						
						<?php } ?>
					</tbody>
				</table>				
			</div>
		</div>
	</div>

	<!-- TARGET KUNJUNGAN -->
	<div class="col-xl-4 col-lg-4">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Kunjungan</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div style="overflow-x:auto;">

					<table class="table table-hover table-bordered">
							<thead class="bg-info">
								<tr>
									<th>No.</th>
									<th>Cabang</th>
									<th>Target</th>
									<th>Aktual</th>
									<th>Pencapaian</th>
									<th>Prosentase</th>
								</tr>
							</thead>
							<tbody>
								   <?php
								$no = 1;
									   $cabang = ExecuteRows('SELECT * FROM m_klinik');
									foreach ($cabang as $cb) {
										$bulan = date('m');
										$tahun = date('Y');
										$result = ExecuteRow("SELECT COUNT(kode_penjualan) AS total_nota, id_klinik FROM penjualan WHERE id_klinik = '".$cb['id_klinik']."' AND MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun'");
										// print_r($result);
										$aktual = is_null($result) ? "0" : $result['total_nota'];
										$target = ExecuteScalar("SELECT target FROM m_target_kunjungan WHERE id_cabang = '".$cb['id_klinik']."' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");
										$pencapaian = ($aktual-$target);
										$prosentase = ($pencapaian == '0') ? "0" : ($pencapaian / $target * 100);
										echo "<tr>
											<td>".$no."</td>
											<td>".$cb['nama_klinik']."</td>
											<td>";if(is_null($target) OR $target == false ){
												echo "0";
											}else{
												echo $target;
											} echo "</td>
											<td>".$aktual. "</td>
											<td>".$pencapaian."</td>	
											<td>".$prosentase."%</td>	
										</tr>";
										$no++;
									}
								?>
							</tbody>
						</table>				
				</div>
			</div>
		</div>
	</div>	

	<!-- TARGET PASIEN -->
	<div class="col-xl-4 col-lg-4">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Pasien</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div style="overflow-x:auto;">

					<table class="table table-hover table-bordered">
							<thead class="bg-info">
								<tr>
									<th>No.</th>
									<th>Cabang</th>
									<th>Target</th>
									<th>Aktual</th>
									<th>Pencapaian</th>
									<th>Prosentase</th>
								</tr>
							</thead>
							<tbody>
								   <?php
								$no = 1;
									   $cabang = ExecuteRows('SELECT * FROM m_klinik');
									foreach ($cabang as $cb) {
										$bulan = date('m');
										$tahun = date('Y');
										$result_pasien = ExecuteRow("SELECT COUNT(DISTINCT(id_pelanggan)) AS total_pelanggan, id_klinik FROM penjualan WHERE id_klinik = '".$cb['id_klinik']."' AND MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun'");
										$aktual_pasien = is_null($result_pasien) ? "0" : $result_pasien['total_pelanggan'];
										$target_pasien = ExecuteScalar("SELECT target FROM m_target_pasien WHERE id_cabang = '".$cb['id_klinik']."' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");		
										$pencapaian_pasien = ($aktual_pasien-$target_pasien);
										$prosentase_pasien = ($pencapaian_pasien == '0') ? "0" : ($pencapaian_pasien / $target_pasien * 100);
										echo "<tr>
											<td>".$no."</td>
											<td>".$cb['nama_klinik']."</td>
											<td>";if(is_null($target_pasien) OR $target_pasien == false ){
												echo "0";
											}else{
												echo $target_pasien;
											} echo "</td>
											<td>".$aktual_pasien. "</td>
											<td>".$pencapaian_pasien."</td>	
											<td>".$prosentase_pasien."%</td>	
										</tr>";
										$no++;
									}
								?>
							</tbody>
						</table>				
				</div>
			</div>
		</div>
	</div>	


	<!-- TARGET PASIEN BARU -->
	<div class="col-xl-4 col-lg-4">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Target Pasien Baru</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div style="overflow-x:auto;">

					<table class="table table-hover table-bordered">
							<thead class="bg-info">
								<tr>
									<th>No.</th>
									<th>Cabang</th>
									<th>Target</th>
									<th>Aktual</th>
									<th>Pencapaian</th>
									<th>Prosentase</th>
								</tr>
							</thead>
							<tbody>
								   <?php
								$no = 1;
									   $cabang = ExecuteRows('SELECT * FROM m_klinik');
									foreach ($cabang as $cb) {
										$bulan = date('m');
										$tahun = date('Y');
										$result_pasien_baru = ExecuteRow("SELECT COUNT(DISTINCT(id_pelanggan)) AS total_pelanggan, id_klinik FROM m_pelanggan WHERE id_klinik = '".$cb['id_klinik']."' AND MONTH(tgl_daftar) = '$bulan' AND YEAR(tgl_daftar) = '$tahun'");
										$aktual_pasien_baru = is_null($result_pasien_baru) ? "0" : $result_pasien_baru['total_pelanggan'];
										$target_pasien_baru = ExecuteScalar("SELECT target FROM m_target_pasien_baru WHERE id_cabang = '".$cb['id_klinik']."' AND MONTH(tgl_awal) = '$bulan' AND YEAR(tgl_awal) = '$tahun'");		
										$pencapaian_pasien_baru = ($aktual_pasien_baru-$target_pasien_baru);
										$prosentase_pasien_baru = ($pencapaian_pasien_baru == '0' OR $target_pasien_baru == '0') ? "0" : ($pencapaian_pasien_baru / $target_pasien_baru * 100);
										echo "<tr>
											<td>".$no."</td>
											<td>".$cb['nama_klinik']."</td>
											<td>";if(is_null($target_pasien_baru) OR $target_pasien_baru == false ){
												echo "0";
											}else{
												echo $target_pasien_baru;
											} echo "</td>
											<td>".$aktual_pasien_baru. "</td>
											<td>".$pencapaian_pasien_baru."</td>	
											<td>".$prosentase_pasien_baru."%</td>	
										</tr>";
										$no++;
									}
								?>
							</tbody>
						</table>				
				</div>
			</div>
		</div>
	</div>	
	
</div>

<div class="row">
	<div class="col-xl-12 col-lg-7">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
   				<div class="row justify-content-end">
					<div class="col-md-auto">
						<form method="post" action="<?php echo CurrentPageName() ?>" id="form-periode">
							<!-- token itu penting buat form method post -->
							<?php if ($Page->CheckToken) { ?>
								<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
							<?php } ?>
								<select class="custom-select" id="select-periode" name="select-periode">
									<option selected>Pilih Periode</option>
									<option value="harian">Hari Ini</option>
									<option value="bulanan">Bulan Ini</option>
								</select>
							<button class="btn btn-primary btn-md p-2" type="submit" name="periode" id="periode" hidden></button>
						</form>
					</div>
				</div>
				<br>
				<table class="table table-hover table-bordered">
					<thead class="bg-info">
						<tr>
   							<th>No.</th>
   							<th>Cabang</th>
   							<th>Total Penjualan</th>
						</tr>
					</thead>
					<tbody>
   						<?php
						$no = 1;
						if(isset($_POST['periode'])){
							$periode = $_POST['select-periode'];
							
							
							$cabang = ExecuteRows("SELECT * FROM m_klinik");
							foreach ($cabang as $tc) {
								if($periode == 'harian'){
									$total_cabang = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik = ".$tc['id_klinik']." AND waktu = DATE(NOW())");
								} else if($periode == 'bulanan') {
									$bulan = date('m');
									$tahun = date('Y');
									$total_cabang = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik = ".$tc['id_klinik']." AND MONTH(waktu) = '$bulan' AND YEAR(waktu) = '$tahun'");									
								}
								//$total_cabang = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik=".$tc['id_klinik']."");
								echo 
									"<tr>
										<td>".$no."</td>
										<td>".$tc['nama_klinik']."</td>
										<td>".rupiah($total_cabang)."</td>
									</tr>";
								$no++;
							} 	

						} else {

							$cabang = ExecuteRows("SELECT * FROM m_klinik");
							foreach ($cabang as $tc) {
								// $date = DATE(NOW());
								$total_cabang = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik=".$tc['id_klinik']." AND waktu = DATE(NOW())");
								echo 
									"<tr>
										<td>".$no."</td>
										<td>".$tc['nama_klinik']."</td>
										<td>".rupiah($total_cabang)."</td>
									</tr>";
								$no++;
							}

						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script language="JavaScript" type="text/javascript" src="/jquery/jquery.min.js"></script>
<script>

$("#select-periode").change(function() {
	var selected = $(this).val();
	$("#periode").click();
	$('#dropDownId :selected').text();
});

$("#select-cabang").change(function() {
	var selected = $(this).val();
	$("#cabang").click();
	$('#dropDownId :selected').text();
});

$("#select-cabang-produk").change(function() {
	var selected = $(this).val();
	$("#cabang-produk").click();
	$('#dropDownId :selected').text();
});

$("#select-cabang-perawatan").change(function() {
	var selected = $(this).val();
	$("#cabang-perawatan").click();
	$('#dropDownId :selected').text();
});


// Set new default font family and font color to mimic Bootstrap's default styling
//Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
//Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function(n, prec) {
	  var k = Math.pow(10, prec);
	  return '' + Math.round(n * k) / k;
	};
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
	s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
	s[1] = s[1] || '';
	s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
	labels: [
		<?php
		   $n = 6;
   
		   $prevN = mktime(0, 0, 0, date("m"), date("d") - $n, date("Y"));
		   
		   $tanggal = date("d-m-Y", $prevN);
		   
		   $dates = array();
		   $start = $current = strtotime($tanggal);
		   $end = strtotime(date('Y-m-d'));
		
			   while ($current <= $end) {
				$dates[] = date('Y-m-d', $current);
				$current = strtotime('+1 days', $current);
			}
		
			foreach ($dates as $value) {
				echo "'".tgl_indo($value)."',";
			}
			
		?>
	],
	datasets: [{
	  label: "Earnings",
	  lineTension: 0.3,
	  backgroundColor: "rgba(78, 115, 223, 0.05)",
	  borderColor: "rgba(78, 115, 223, 1)",
	  pointRadius: 3,
	  pointBackgroundColor: "rgba(78, 115, 223, 1)",
	  pointBorderColor: "rgba(78, 115, 223, 1)",
	  pointHoverRadius: 3,
	  pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
	  pointHoverBorderColor: "rgba(78, 115, 223, 1)",
	  pointHitRadius: 10,
	  pointBorderWidth: 2,
	  data: [
		  <?php
			   $n = 6;

			   $prevN = mktime(0, 0, 0, date("m"), date("d") - $n, date("Y"));
			   
			   $tanggal = date("d-m-Y", $prevN);
			   
			   $dates = array();
			   $start = $current = strtotime($tanggal);
			   $end = strtotime(date('Y-m-d'));
			
				while ($current <= $end) {
					$dates[] = date('Y-m-d', $current);
					$current = strtotime('+1 days', $current);
				}
			
				foreach ($dates as $value) {
					$data =  ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE waktu = '".$value."' ");
					if(is_null($data) OR $data == FALSE){
						echo ' 0,';
					} else {
						echo $data.",";
					}
				}
		  ?>
	  ],
	}],
  },
  options: {
	maintainAspectRatio: false,
	layout: {
	  padding: {
		left: 10,
		right: 25,
		top: 25,
		bottom: 0
	  }
	},
	scales: {
	  xAxes: [{
		time: {
		  unit: 'time'
		},
		gridLines: {
		  display: false,
		  drawBorder: false
		},
		ticks: {
		  maxTicksLimit: 7
		}
	  }],
	  yAxes: [{
		ticks: {
		  maxTicksLimit: 5,
		  padding: 10,
		  // Include a dollar sign in the ticks
		  callback: function(value, index, values) {
			return number_format(value);
		  }
		},
		gridLines: {
		  color: "rgb(234, 236, 244)",
		  zeroLineColor: "rgb(234, 236, 244)",
		  drawBorder: false,
		  borderDash: [2],
		  zeroLineBorderDash: [2]
		}
	  }],
	},
	legend: {
	  display: false
	},
	tooltips: {
	  backgroundColor: "rgb(255,255,255)",
	  bodyFontColor: "#858796",
	  titleMarginBottom: 10,
	  titleFontColor: '#6e707e',
	  titleFontSize: 14,
	  borderColor: '#dddfeb',
	  borderWidth: 1,
	  xPadding: 15,
	  yPadding: 15,
	  displayColors: false,
	  intersect: false,
	  mode: 'index',
	  caretPadding: 10,
	  callbacks: {
		label: function(tooltipItem, chart) {
		  var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
		  return datasetLabel + ': Rp' + number_format(tooltipItem.yLabel);
		}
	  }
	}
  }
});
</script>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$Dasbor->terminate();
?>