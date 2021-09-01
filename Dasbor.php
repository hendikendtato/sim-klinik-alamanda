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
	<!-- Area Chart Target Omset per Cabang -->
	<div class="col-xl-6 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Target Omset per Cabang</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form method="post" action="<?php echo CurrentPageName() ?>" id="form-cabang">
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
				<div class="chart-area">
					<div id='myChart' style="max-width: 900px;height: 500px;margin: 0px auto"></div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Area Chart Target Omset Produk Terjual -->
	<div class="col-xl-6 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Target Omset Produk Terjual</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form method="post" action="<?php echo CurrentPageName() ?>" id="form-cabang">
					<!-- token itu penting buat form method post -->
						<?php if ($Page->CheckToken) { ?>
							<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
						<?php } ?>
						<select class="custom-select" id="select-cabang-produk" name="select-cabang-produk">
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
				<div class="chart-area">
					<div id="chartDivProduk" style="max-width: 900px;height: 500px;margin: 0px auto"></div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Area Chart Target Omset Perawatan Terjual -->
	<div class="col-xl-6 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Target Omset Perawatan Terjual</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form method="post" action="<?php echo CurrentPageName() ?>" id="form-cabang">
					<!-- token itu penting buat form method post -->
						<?php if ($Page->CheckToken) { ?>
							<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
						<?php } ?>
						<select class="custom-select" id="select-cabang-perawatan" name="select-cabang-perawatan">
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
				<div class="chart-area">
					<div id="chartDivPerawatan" style="max-width: 900px;height: 500px;margin: 0px auto"></div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Area Chart Target Pasien -->
	<div class="col-xl-6 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Target Pasien</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form method="post" action="<?php echo CurrentPageName() ?>" id="form-cabang-pasien">
					<!-- token itu penting buat form method post -->
						<?php if ($Page->CheckToken) { ?>
							<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
						<?php } ?>
						<select class="custom-select" id="select-cabang-pasien" name="select-cabang-pasien">
							<option selected>Pilih Cabang</option>
							<?php
								$cabang = ExecuteRows("SELECT * FROM m_klinik");
								foreach ($cabang as $value) {
									echo "<option value='".$value['id_klinik']."'>".$value['nama_klinik']."</option>";
								}
							?>
						</select>
						<button class="btn btn-primary btn-md p-2" type="submit" name="cabang-pasien" id="cabang-pasien" hidden></button>
				</form>						
				<div class="chart-area">
					<div id="chartDivPasien" style="max-width: 900px;height: 500px;margin: 0px auto"></div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Area Chart Target Pasien Baru -->
	<div class="col-xl-6 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Target Pasien Baru</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form method="post" action="<?php echo CurrentPageName() ?>" id="form-cabang-pasien-baru">
					<!-- token itu penting buat form method post -->
						<?php if ($Page->CheckToken) { ?>
							<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
						<?php } ?>
						<select class="custom-select" id="select-cabang-pasien-baru" name="select-cabang-pasien-baru">
							<option selected>Pilih Cabang</option>
							<?php
								$cabang = ExecuteRows("SELECT * FROM m_klinik");
								foreach ($cabang as $value) {
									echo "<option value='".$value['id_klinik']."'>".$value['nama_klinik']."</option>";
								}
							?>
						</select>
						<button class="btn btn-primary btn-md p-2" type="submit" name="cabang-pasien-baru" id="cabang-pasien-baru" hidden></button>
				</form>						
				<div class="chart-area">
					<div id="chartDivPasienBaru" style="max-width: 900px;height: 500px;margin: 0px auto"></div>
				</div>
			</div>
		</div>
	</div>	
	<!-- Area Chart Target Kunjungan -->
	<div class="col-xl-6 col-lg-5">
		<div class="card border-0 shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Statistic Target Kunjungan</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<form method="post" action="<?php echo CurrentPageName() ?>" id="form-cabang-kunjungan">
					<!-- token itu penting buat form method post -->
						<?php if ($Page->CheckToken) { ?>
							<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
						<?php } ?>
						<select class="custom-select" id="select-cabang-kunjungan" name="select-cabang-kunjungan">
							<option selected>Pilih Cabang</option>
							<?php
								$cabang = ExecuteRows("SELECT * FROM m_klinik");
								foreach ($cabang as $value) {
									echo "<option value='".$value['id_klinik']."'>".$value['nama_klinik']."</option>";
								}
							?>
						</select>
						<button class="btn btn-primary btn-md p-2" type="submit" name="cabang-kunjungan" id="cabang-pasien-baru" hidden></button>
				</form>						
				<div class="chart-area">
					<div id="chartDivKunjungan" style="max-width: 900px;height: 500px;margin: 0px auto"></div>
				</div>
			</div>
		</div>
	</div>	
</div>

<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>

<script language="JavaScript" type="text/javascript" src="/klinik/jquery/jquery.min.js"></script>
<script src="https://code.jscharting.com/latest/jscharting.js"></script>
<script type="text/javascript" src="https://code.jscharting.com/latest/modules/types.js"></script>
<script>

$('#select-cabang').change(function() {
	var selected = $(this).val();
	zingchart.exec('myChart', 'setseriesvalues', {
		  'values': [
			[0,0,0], 
			[0,0,0]
		  ]
	});

	$.get(`${base_url}api/?action=dataOmsetCabang&id_klinik=${selected}`)
			.then(function (response) {
				// handle success
				var aset_res = parseInt(response.data['aset']);
				var baseline_res = parseInt(response.data['baseline']);
				var target_res = parseInt(response.data['target']);
				var target = parseInt(target_res);
				var baseline = parseInt(baseline_res);
				var aset = parseInt(aset_res);
				var aktual = parseInt(response.data['14']);
				var batas =  Math.max(target, baseline, aset, aktual);

				zingchart.THEME='classic';
				var myConfig = {
					"background-color": "none",
					"type": "mixed",
					"title": {
						"text": "Target Omset Cabang",
						"background-color": "none"
					},
					"scale-x": {
						"values": [
							"Aset : "+ number_format(aset),
							"Baseline : "+ number_format(baseline),
							"Target : "+ number_format(target)
						],
						"line-color": "#858796",
						"line-width": "3px",
						"item": {
							'font-family': "Poppins",
	  						'font-size': 13,
							'font-weight': "bold",							
							"font-color": "#333"
						},
						"tick": {
							"line-color": "#858796",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"guide": {
							"visible": false
						}
					},
					"scale-y": {
						"values": "0:"+parseInt(batas+1000000)+":1000000",
						"line-color": "#858796",
						"line-width": "3px",
						"item": {
							'font-family': "Poppins",
	  						'font-size': 13,
							"font-color": "#333",
							"padding": "5px"
						},
						"tick": {
							"line-color": "#858796",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"label": {
							"text": "Target Omset Cabang",
							"font-color": "#333",
							"offset-x": 8
						},
						"guide": {
							"visible": true
						}
					},
					"plot": {
						"bars-overlap": "55%"
					},
					"plotarea": {
						"margin": "80px 60px 35px 60px"
					},
					"series": [
						{
							"values": [
								aset,
								baseline,
								target
							],
							"type": "bar",
							"text": "",
							"z-index": 1,
							"background-color": ["#595959 #777"],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},
							"tooltip": {
								"text": "Batas %k %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
						{
							"values": [
								aktual,
								aktual,
								aktual								
							],
							"type": "bar",
							"text": "Aktual",
							"z-index": 2,
							"background-color": "#36b9cc",
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},							
							"tooltip": {
								"text": "Aktual %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
					]
				};

				zingchart.render({ 
					id : 'myChart', 
					data : myConfig, 
					height: '100%', 
					width: '100%' 
				});
			})
			.catch(function (error) {
				// handle error
				console.log(error);		
	})
});

$("#select-cabang-pasien").change(function() {
	var selected = $(this).val();
	zingchart.exec('chartDivPasien', 'setseriesvalues', {
		  'values': [
			[0,0,0], 
			[0,0,0]
		  ]
	});

	$.get(`${base_url}api/?action=dataOmsetPasien&id_klinik=${selected}`)
			.then(function (response) {
				// handle success
				var total_pasien = parseInt(response.data['total_pelanggan']);
				var target_omset = parseInt(response.data['2']);

				zingchart.THEME='classic';
				var myConfig = {
					"background-color": "none",
					"type": "mixed",
					"title": {
						"text": "Sales Comparison 2011 vs 2012",
						"background-color": "none"
					},
					"scale-x": {
						"values": [
							"Target Pasien"
						],
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"guide": {
							"visible": false
						}
					},
					"scale-y": {
						"values": "0:100:20",
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333",
							"padding": "5px"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"label": {
							"text": "Number of New Clients Acquired",
							"font-color": "#333",
							"offset-x": 8
						},
						"guide": {
							"visible": false
						}
					},
					"plot": {
						"bars-overlap": "55%"
					},
					"plotarea": {
						"margin": "80px 60px 35px 60px"
					},
					"series": [
						{
							"values": [
								target_omset
							],
							"type": "bar",
							"text": "2011 Sales",
							"z-index": 1,
							"background-color": ["#595959 #777"],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},
							"tooltip": {
								"text": "Batas %k %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
						{
							"values": [
								total_pasien								
							],
							"type": "bar",
							"text": "2012 Sales",
							"z-index": 2,
							"background-color": [
								"#db0a0a #ed0909",
								"#8F73ED #9096E6",
								"#b69c63 #bea774"
							],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},							
							"tooltip": {
								"text": "Aktual %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
					]
				};

				zingchart.render({ 
					id : 'chartDivPasien', 
					data : myConfig, 
					height: 500, 
					width: 725 
				});
			})
			.catch(function (error) {
				// handle error
				console.log(error);		
	})
});

$("#select-cabang-pasien-baru").change(function() {
	var selected = $(this).val();
	zingchart.exec('chartDivPasienBaru', 'setseriesvalues', {
		  'values': [
			[0,0,0], 
			[0,0,0]
		  ]
	});

	$.get(`${base_url}api/?action=dataOmsetPasienBaru&id_klinik=${selected}`)
			.then(function (response) {
				// handle success
				var total_pelanggan_baru = parseInt(response.data['total_pelanggan_baru']);
				var target_omset_baru = parseInt(response.data['2']);

				zingchart.THEME='classic';
				var myConfig = {
					"background-color": "none",
					"type": "mixed",
					"title": {
						"text": "Sales Comparison 2011 vs 2012",
						"background-color": "none"
					},
					"scale-x": {
						"values": [
							"Target Pasien"
						],
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"guide": {
							"visible": false
						}
					},
					"scale-y": {
						"values": "0:100:20",
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333",
							"padding": "5px"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"label": {
							"text": "Number of New Clients Acquired",
							"font-color": "#333",
							"offset-x": 8
						},
						"guide": {
							"visible": false
						}
					},
					"plot": {
						"bars-overlap": "55%"
					},
					"plotarea": {
						"margin": "80px 60px 35px 60px"
					},
					"series": [
						{
							"values": [
								target_omset_baru
							],
							"type": "bar",
							"text": "2011 Sales",
							"z-index": 1,
							"background-color": ["#595959 #777"],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},
							"tooltip": {
								"text": "Batas %k %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
						{
							"values": [
								total_pelanggan_baru								
							],
							"type": "bar",
							"text": "2012 Sales",
							"z-index": 2,
							"background-color": [
								"#db0a0a #ed0909",
								"#8F73ED #9096E6",
								"#b69c63 #bea774"
							],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},							
							"tooltip": {
								"text": "Aktual %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
					]
				};

				zingchart.render({ 
					id : 'chartDivPasienBaru', 
					data : myConfig, 
					height: 500, 
					width: 725 
				});
			})
			.catch(function (error) {
				// handle error
				console.log(error);		
	})
});

// $("#select-cabang").change(function() {
// 	var selected = $(this).val();
// 	$("#cabang").click();
// 	$('#dropDownId :selected').text();
// });

$("#select-cabang-produk").change(function() {
	var selected = $(this).val();
	zingchart.exec('chartDivProduk', 'setseriesvalues', {
		  'values': [
			[0,0], 
			[0,0]
		  ]
	});

	$.get(`${base_url}api/?action=dataOmsetProduk&id_klinik=${selected}`)
			.then(function (response) {
				// handle success
				var status = [];
				var qty = [];
				var target = [];
				response.data.forEach(function(obj) {
					status.push(obj.status_barang);
					qty.push(parseInt(obj.qty));
					target.push(parseInt(obj.target));
				});

				zingchart.THEME='classic';
				var myConfig = {
					"background-color": "none",
					"type": "mixed",
					"title": {
						"text": "Target Omset Cabang",
						"background-color": "none"
					},
					"scale-x": {
						"values": status,
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"guide": {
							"visible": false
						}
					},
					"scale-y": {
						"values": "0:100:20",
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333",
							"padding": "5px"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"label": {
							"text": "Target Omset Cabang",
							"font-color": "#333",
							"offset-x": 8
						},
						"guide": {
							"visible": false
						}
					},
					"plot": {
						"bars-overlap": "55%"
					},
					"plotarea": {
						"margin": "80px 60px 35px 60px"
					},
					"series": [
						{
							"values": target,
							"type": "bar",
							"text": "",
							"z-index": 1,
							"background-color": ["#595959 #777"],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},
							"tooltip": {
								"text": "Batas %k %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
						{
							"values": qty,
							"type": "bar",
							"text": "Aktual",
							"z-index": 2,
							"background-color": [
								"#db0a0a #ed0909",
								"#8F73ED #9096E6",
								"#b69c63 #bea774"
							],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},							
							"tooltip": {
								"text": "Aktual %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
					]
				};

				zingchart.render({ 
					id : 'chartDivProduk', 
					data : myConfig, 
					height: 500, 
					width: 725 
				});				
				
			})
			.catch(function (error) {
				// handle error
				console.log(error);		
	})	
});

$("#select-cabang-perawatan").change(function() {
	var selected = $(this).val();
	zingchart.exec('chartDivProduk', 'setseriesvalues', {
		  'values': [
			[0,0], 
			[0,0]
		  ]
	});

	$.get(`${base_url}api/?action=dataOmsetPerawatan&id_klinik=${selected}`)
			.then(function (response) {
				// handle success
				var jenis = [];
				var qty = [];
				var target = [];
				response.data.forEach(function(obj) {
					jenis.push(obj.jenis);
					qty.push(parseInt(obj.qty));
					target.push(parseInt(obj.target));
				});

				zingchart.THEME='classic';
				var myConfig = {
					"background-color": "none",
					"type": "mixed",
					"title": {
						"text": "Target Omset Cabang",
						"background-color": "none"
					},
					"scale-x": {
						"values": jenis,
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"guide": {
							"visible": false
						}
					},
					"scale-y": {
						"values": "0:100:20",
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333",
							"padding": "5px"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"label": {
							"text": "Target Omset Cabang",
							"font-color": "#333",
							"offset-x": 8
						},
						"guide": {
							"visible": false
						}
					},
					"plot": {
						"bars-overlap": "55%"
					},
					"plotarea": {
						"margin": "80px 60px 35px 60px"
					},
					"series": [
						{
							"values": target,
							"type": "bar",
							"text": "",
							"z-index": 1,
							"background-color": ["#595959 #777"],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},
							"tooltip": {
								"text": "Batas %k %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
						{
							"values": qty,
							"type": "bar",
							"text": "Aktual",
							"z-index": 2,
							"background-color": [
								"#db0a0a #ed0909",
								"#8F73ED #9096E6",
								"#b69c63 #bea774"
							],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},							
							"tooltip": {
								"text": "Aktual %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
					]
				};

				zingchart.render({ 
					id : 'chartDivPerawatan', 
					data : myConfig, 
					height: 500, 
					width: 725 
				});				
				
			})
			.catch(function (error) {
				// handle error
				console.log(error);		
	})
});

$("#select-cabang-kunjungan").change(function() {
	var selected = $(this).val();
	zingchart.exec('chartDivKunjungan', 'setseriesvalues', {
		  'values': [
			[0,0], 
			[0,0]
		  ]
	});
	$.get(`${base_url}api/?action=dataOmsetKunjungan&id_klinik=${selected}`)
			.then(function (response) {
				// handle success
				var total_nota = parseInt(response.data['total_nota']);
				var target = parseInt(response.data['2']['target']);
				
				zingchart.THEME='classic';
				var myConfig = {
					"background-color": "none",
					"type": "mixed",
					"title": {
						"text": "Target Omset Cabang",
						"background-color": "none"
					},
					"scale-x": {
						"values": [
							'Target'
						],
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"guide": {
							"visible": false
						}
					},
					"scale-y": {
						"values": "0:100:20",
						"line-color": "#db0a0a",
						"line-width": "3px",
						"item": {
							"font-color": "#333",
							"padding": "5px"
						},
						"tick": {
							"line-color": "#db0a0a",
							"placement": "outer",
							"size": 8,
							"line-width": "3px"
						},
						"label": {
							"text": "Target Omset Cabang",
							"font-color": "#333",
							"offset-x": 8
						},
						"guide": {
							"visible": false
						}
					},
					"plot": {
						"bars-overlap": "55%"
					},
					"plotarea": {
						"margin": "80px 60px 35px 60px"
					},
					"series": [
						{
							"values": [
								target
							],
							"type": "bar",
							"text": "",
							"z-index": 1,
							"background-color": ["#595959 #777"],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},
							"tooltip": {
								"text": "Batas %k %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
						{
							"values": [
								total_nota
							],
							"type": "bar",
							"text": "Aktual",
							"z-index": 2,
							"background-color": [
								"#db0a0a #ed0909",
								"#8F73ED #9096E6",
								"#b69c63 #bea774"
							],
							"animation": {
								"effect": "ANIMATION_EXPAND_BOTTOM",
								"speed": 3
							},							
							"tooltip": {
								"text": "Aktual %v"
							},
							"hover-state": {
								"visible": 0
							}
						},
					]
				};

				zingchart.render({ 
					id : 'chartDivKunjungan', 
					data : myConfig, 
					height: 500, 
					width: 725 
				});				
				
			})
			.catch(function (error) {
				// handle error
				console.log(error);		
	})
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
		   $day = date('d');
		   $n = $day-1;
   
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
		   	   $day = date('d');
		   	   $n = $day-1;

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