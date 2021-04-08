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
$antrian_view = new antrian_view();

// Run the page
$antrian_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$antrian_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$antrian_view->isExport()) { ?>
<script>
var fantrianview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fantrianview = currentForm = new ew.Form("fantrianview", "view");
	loadjs.done("fantrianview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$antrian_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $antrian_view->ExportOptions->render("body") ?>
<?php $antrian_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $antrian_view->showPageHeader(); ?>
<?php
$antrian_view->showMessage();
?>
<form name="fantrianview" id="fantrianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="antrian">
<input type="hidden" name="modal" value="<?php echo (int)$antrian_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($antrian_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $antrian_view->TableLeftColumnClass ?>"><span id="elh_antrian_id"><?php echo $antrian_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $antrian_view->id->cellAttributes() ?>>
<span id="el_antrian_id">
<span<?php echo $antrian_view->id->viewAttributes() ?>><?php echo $antrian_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($antrian_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $antrian_view->TableLeftColumnClass ?>"><span id="elh_antrian_tanggal"><?php echo $antrian_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $antrian_view->tanggal->cellAttributes() ?>>
<span id="el_antrian_tanggal">
<span<?php echo $antrian_view->tanggal->viewAttributes() ?>><?php echo $antrian_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($antrian_view->nomor_antrian->Visible) { // nomor_antrian ?>
	<tr id="r_nomor_antrian">
		<td class="<?php echo $antrian_view->TableLeftColumnClass ?>"><span id="elh_antrian_nomor_antrian"><?php echo $antrian_view->nomor_antrian->caption() ?></span></td>
		<td data-name="nomor_antrian" <?php echo $antrian_view->nomor_antrian->cellAttributes() ?>>
<span id="el_antrian_nomor_antrian">
<span<?php echo $antrian_view->nomor_antrian->viewAttributes() ?>><?php echo $antrian_view->nomor_antrian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($antrian_view->keperluan->Visible) { // keperluan ?>
	<tr id="r_keperluan">
		<td class="<?php echo $antrian_view->TableLeftColumnClass ?>"><span id="elh_antrian_keperluan"><?php echo $antrian_view->keperluan->caption() ?></span></td>
		<td data-name="keperluan" <?php echo $antrian_view->keperluan->cellAttributes() ?>>
<span id="el_antrian_keperluan">
<span<?php echo $antrian_view->keperluan->viewAttributes() ?>><?php echo $antrian_view->keperluan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($antrian_view->nama_klinik->Visible) { // nama_klinik ?>
	<tr id="r_nama_klinik">
		<td class="<?php echo $antrian_view->TableLeftColumnClass ?>"><span id="elh_antrian_nama_klinik"><?php echo $antrian_view->nama_klinik->caption() ?></span></td>
		<td data-name="nama_klinik" <?php echo $antrian_view->nama_klinik->cellAttributes() ?>>
<span id="el_antrian_nama_klinik">
<span<?php echo $antrian_view->nama_klinik->viewAttributes() ?>><?php echo $antrian_view->nama_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($antrian_view->selesai->Visible) { // selesai ?>
	<tr id="r_selesai">
		<td class="<?php echo $antrian_view->TableLeftColumnClass ?>"><span id="elh_antrian_selesai"><?php echo $antrian_view->selesai->caption() ?></span></td>
		<td data-name="selesai" <?php echo $antrian_view->selesai->cellAttributes() ?>>
<span id="el_antrian_selesai">
<span<?php echo $antrian_view->selesai->viewAttributes() ?>><?php echo $antrian_view->selesai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$antrian_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$antrian_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$antrian_view->terminate();
?>