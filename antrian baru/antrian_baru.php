<?php
namespace PHPMaker2020\klinik_latest_08_04_21;
$RELATIVE_PATH = "../";

// Autoload
include_once $RELATIVE_PATH . "autoload.php";

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
$antrian_baru = new antrian_baru();

// Run the page
$antrian_baru->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once $RELATIVE_PATH . "header.php"; ?>
<style>
	.row.row-identity {
		margin-bottom: 10px;
	}

	input#tanggal, input#kode-penjualan, input#pelanggan, input#sales {
		width: 100%;
	}

	select.form-control.product-select {
		width: 100%;
	}

	button.btn.btn-primary.mb-2.product-select-button {
		width: 100%;
		height: 40px;
	}

	button.btn.btn-primary.save-transaction {
		width: 100%;
		height: 50px;
	}

	.price-summary .row {
		margin-bottom: 20px;
	}

	.product-list {
		padding-right: 20px;
	}

	input.form-control.diskon-persen, input.form-control.ppn-persen {
		width: 50%;
	}

	input.form-control.diskon-rp, input.form-control.ppn-rp {
		width: 65%;
	}

	.col-5.subtotal {
		text-align: right;
	}

	.col-5.total-number {
		text-align: right;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-4 cs">
			<h4>Beli Produk</h4>
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Nomor Antrian</th>
						<th scope="col">Selesai</th>
					</tr>
				</thead>
				
				<tbody id="antrian-beli-produk">
				  <!-- antrian beli produk -->
				</tbody>
			</table>
		</div>
		
		<div class="col-4 dokter">
			<h4>Konsultasi</h4>
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Nomor Antrian</th>
						<th scope="col">Selesai</th>
					</tr>
				</thead>
				<tbody id="antrian-konsultasi">
				  <!-- antrian konsultasi -->
				</tbody>
			</table>
		</div>

		<div class="col-4 dokter">
			<h4>Perawatan</h4>
			<table class="table table-bordered table-sm">
				<thead>
					<tr>
						<th scope="col">No.</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Nomor Antrian</th>
						<th scope="col">Selesai</th>
					</tr>
				</thead>
				<tbody id="antrian-perawatan">
					<!-- antrian perawatan -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<button id="sinkron">sinkron</button>

<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="http://localhost:5656/socket.io/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js" integrity="sha512-/n/dTQBO8lHzqqgAQvy0ukBQ0qLmGzxKhn8xKrz4cn7XJkZzy+fAtzjnOQd5w55h4k1kUC+8oIe6WmrGUYwODA==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
  // Connect to our node/websockets server
  var socket = io.connect('http://localhost:5656');

  // get antrian beli
  socket.on('initial antrian beli', function(data){ 
	var html = '';
	for (var i = 0; i < data.length; i++){
		// We store html as a var then add to DOM after for efficiency
		html += `<tr><td>${i+1}</td><td>${new Date(data[i].tanggal).toString('yyyy-MM-dd')}</td><td>${data[i].nomor_antrian}</td><td>${data[i].selesai}</td></tr>`;
	}
	$('#antrian-beli-produk').html(html);
  })

  // get antrian perawtan
  socket.on('initial antrian perawatan', function(data){
	var html = '';
	for (var i = 0; i < data.length; i++){
		// We store html as a var then add to DOM after for efficiency
		html += `<tr><td>${i+1}</td><td>${new Date(data[i].tanggal).toString('yyyy-MM-dd')}</td><td>${data[i].nomor_antrian}</td><td>${data[i].selesai}</td></tr>`;
	}
	$('#antrian-perawatan').html(html);
  })

  // get antrian konsultasi
  socket.on('initial antrian konsultasi', function(data){
	var html = '';
	for (var i = 0; i < data.length; i++){
		// We store html as a var then add to DOM after for efficiency
		html += `<tr><td>${i+1}</td><td>${new Date(data[i].tanggal).toString('yyyy-MM-dd')}</td><td>${data[i].nomor_antrian}</td><td>${data[i].selesai}</td></tr>`;
	}
	$('#antrian-konsultasi').html(html);
  })

  socket.on('new antrian beli', function ({row, index}) {
	$('#antrian-beli-produk').append(`
	  <tr>
		<td>${index}</td>
		<td>${new Date(row[0].tanggal).toString('yyyy-MM-dd')}</td>
		<td>${row[0].nomor_antrian}</td>
		<td>${row[0].selesai}</td>
	  </tr>
	`);
  })

  socket.on('new antrian perawatan', function ({row, index}) {
	$('#antrian-perawatan').append(`
	  <tr>
		<td>${index}</td>
		<td>${new Date(row[0].tanggal).toString('yyyy-MM-dd')}</td>
		<td>${row[0].nomor_antrian}</td>
		<td>${row[0].selesai}</td>
	  </tr>
	`);
  })

  socket.on('new antrian konsultasi', function ({row, index}) {
	$('#antrian-konsultasi').append(`
	  <tr>
		<td>${index}</td>
		<td>${new Date(row[0].tanggal).toString('yyyy-MM-dd')}</td>
		<td>${row[0].nomor_antrian}</td>
		<td>${row[0].selesai}</td>
	  </tr>
	`);
  })

  $('#sinkron').click(function(e) {
	e.preventDefault
	console.log('test')
	socket.emit('synchronize') 
  })
 
});
</script>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once $RELATIVE_PATH . "footer.php"; ?>
<?php
$antrian_baru->terminate();
?>