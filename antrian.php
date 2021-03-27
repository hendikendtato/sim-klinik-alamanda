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
$_antrian = new _antrian();

// Run the page
$_antrian->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
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

<script src="js/jquery-3.5.1.slim.min.js"></script>

<?php
	$hari_ini = CurrentDate();
?>

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
				
				<tbody>
					<?php
						
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Beli Produk'";
						$res = ExecuteRows($sql);
						$no=1;
						if (is_array($res) || is_object($res)) {
							foreach ($res as $rs) {
									
								echo "<tr>
										<td>" . $no . "</td>
										<td>" . $rs["tanggal"] . "</td>
										<td>" . $rs["nomor_antrian"] . "</td>
										<td>" . $rs["selesai"] . "</td>
										</tr>" ;
							      $no++; }
						}
					?>
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
				<tbody>
				<?php
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Konsultasi'";
						$res = ExecuteRows($sql);
						$no=1;
						if (is_array($res) || is_object($res)) {
							foreach ($res as $rs) {
									
								echo "<tr>
										<td>" . $no . "</td>
										<td>" . $rs["tanggal"] . "</td>
										<td>" . $rs["nomor_antrian"] . "</td>
										<td>" . $rs["selesai"] . "</td>
										</tr>" ;
							      $no++; }
						}
					?>
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
				<tbody>
								<?php
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Perawatan'";
						$res = ExecuteRows($sql);
						$no=1;
						if (is_array($res) || is_object($res)) {
							foreach ($res as $rs) {
									
								echo "<tr>
										<td>" . $no . "</td>
										<td>" . $rs["tanggal"] . "</td>
										<td>" . $rs["nomor_antrian"] . "</td>
										<td>" . $rs["selesai"] . "</td>
										</tr>" ;
							      $no++; }
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$_antrian->terminate();
?>