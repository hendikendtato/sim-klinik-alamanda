<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$struk_antrian = new struk_antrian();

// Run the page
$struk_antrian->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
	$nomor = "SELECT * FROM antrian ORDER BY id DESC";
	$result = ExecuteRow($nomor);
?>

 <link rel="stylesheet" type="text/css" href="plugins/print/print.min.css">
 <script src="plugins/print/print.min.js"></script>

<div class="container mt-3">
	<div class="row">
		<div class="col-md-4">
			<div class="card text-center">
				<div class="card-header">
					Nomor Antrian
				</div>
				<div class="card-body text-center">
					<p>Alamanda Clinic <?php echo $result['nama_klinik']; ?></p>
					<p>Antrian <b><?php echo $result['keperluan']; ?></b></p>
					<h2>Nomor Antrian Anda</h2>
					<h3><b><?php echo $result['nomor_antrian']; ?></b></h3>
					<p><?php echo date('d/m/Y H:i:s'); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	window.print();
</script>


<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$struk_antrian->terminate();
?>