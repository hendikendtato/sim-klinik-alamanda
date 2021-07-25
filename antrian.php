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
		<div class="col-2">
			<form method="post" action="<?php echo CurrentPageName() ?>" id="form-periode">
				<!-- token itu penting buat form method post -->
				<?php if ($Page->CheckToken) { ?>
					<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
				<?php } ?>
				<select class="custom-select" id="select-cabang" name="select-cabang">
					<option selected>Pilih Cabang</option>
					<?php
						$get_current_id_klinik = CurrentUserInfo("id_klinik");
						$cabang = ExecuteRows("SELECT * FROM m_klinik");
						$get_nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = '$get_current_id_klinik'");

						if($get_current_id_klinik != null OR $get_current_id_klinik != false){
							echo "<option value=" . $get_current_id_klinik . " selected>" . $get_nama_klinik . "</option>";
						} else {
							foreach ($cabang as $value) {
								echo "<option value='".$value['nama_klinik']."'>".$value['nama_klinik']."</option>";
							}
						}
					?>
				</select>
				<button class="btn btn-primary btn-md p-2" type="submit" name="cabang" id="cabang" hidden></button>
			</form>
		</div>
	</div>
	<br>
	<?php if(isset($_POST['cabang'])) {
		$cabang = $_POST['select-cabang'];
	?>
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
							$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Beli Produk' AND nama_klinik = '$cabang'";
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
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Konsultasi' AND nama_klinik = '$cabang'";
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
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Perawatan' AND nama_klinik = '$cabang'";
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
	<?php } else if(CurrentUserInfo("id_klinik") != null OR CurrentUserInfo("id_klinik") != false) { 
		$cabang = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik='".CurrentUserInfo('id_klinik')."'"); 
	?>
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
							$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Beli Produk' AND nama_klinik = '$cabang'";
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
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Konsultasi' AND nama_klinik = '$cabang'";
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
						$sql = "SELECT tanggal, nomor_antrian, selesai FROM antrian WHERE tanggal='$hari_ini' AND keperluan='Perawatan' AND nama_klinik = '$cabang'";
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

	<?php } ?>
</div>
<script>
	$("#select-cabang").change(function() {
		var selected = $(this).val();
		$("#cabang").click();
		$('#dropDownId :selected').text();
	});	
</script>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$_antrian->terminate();
?>