<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

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
<!-- Page level plugins -->
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
						$pasien = ExecuteScalar("SELECT COUNT(DISTINCT(id_pelanggan)) FROM penjualan WHERE id_klinik = '21' AND waktu = '$tanggal' ");
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
				<h6 class="m-0 font-weight-bold text-primary">Projects</h6>
			</div>
			<div class="card-body">
				<h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
				  <div class="progress mb-4">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
				  </div>
				  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
				  <div class="progress mb-4">
					<div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
				  </div>
				  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
				  <div class="progress mb-4">
					<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
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
									<option value="mingguan">1 Minggu</option>
									<option value="bulanan">1 Bulan</option>
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
								} else if($periode == 'mingguan'){
									$tanggal_minggu_lalu = ExecuteScalar("SELECT DATE(NOW()) - INTERVAL 7 DAY");
									$tanggal = date('Y-m-d');
									$total_cabang = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik = ".$tc['id_klinik']." AND (waktu BETWEEN '$tanggal_minggu_lalu' AND '$tanggal')");
								} else if($periode == 'bulanan') {
									$tanggal_bulan_lalu = ExecuteScalar("SELECT DATE(NOW()) - INTERVAL 30 DAY");
									$tanggal = date('Y-m-d');
									$total_cabang = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik = ".$tc['id_klinik']." AND (waktu BETWEEN '$tanggal_bulan_lalu' AND '$tanggal')");									
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
					$data =  ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_klinik = '21' AND waktu = '".$value."' ");
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