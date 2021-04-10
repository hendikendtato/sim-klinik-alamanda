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
$m_tipepelanggan_view = new m_tipepelanggan_view();

// Run the page
$m_tipepelanggan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tipepelanggan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_tipepelanggan_view->isExport()) { ?>
<script>
var fm_tipepelangganview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_tipepelangganview = currentForm = new ew.Form("fm_tipepelangganview", "view");
	loadjs.done("fm_tipepelangganview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_tipepelanggan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_tipepelanggan_view->ExportOptions->render("body") ?>
<?php $m_tipepelanggan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_tipepelanggan_view->showPageHeader(); ?>
<?php
$m_tipepelanggan_view->showMessage();
?>
<form name="fm_tipepelangganview" id="fm_tipepelangganview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tipepelanggan">
<input type="hidden" name="modal" value="<?php echo (int)$m_tipepelanggan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_tipepelanggan_view->id_tipe->Visible) { // id_tipe ?>
	<tr id="r_id_tipe">
		<td class="<?php echo $m_tipepelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_tipepelanggan_id_tipe"><?php echo $m_tipepelanggan_view->id_tipe->caption() ?></span></td>
		<td data-name="id_tipe" <?php echo $m_tipepelanggan_view->id_tipe->cellAttributes() ?>>
<span id="el_m_tipepelanggan_id_tipe">
<span<?php echo $m_tipepelanggan_view->id_tipe->viewAttributes() ?>><?php echo $m_tipepelanggan_view->id_tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_tipepelanggan_view->nama_tipe->Visible) { // nama_tipe ?>
	<tr id="r_nama_tipe">
		<td class="<?php echo $m_tipepelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_tipepelanggan_nama_tipe"><?php echo $m_tipepelanggan_view->nama_tipe->caption() ?></span></td>
		<td data-name="nama_tipe" <?php echo $m_tipepelanggan_view->nama_tipe->cellAttributes() ?>>
<span id="el_m_tipepelanggan_nama_tipe">
<span<?php echo $m_tipepelanggan_view->nama_tipe->viewAttributes() ?>><?php echo $m_tipepelanggan_view->nama_tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_tipepelanggan_view->min_kedatangan->Visible) { // min_kedatangan ?>
	<tr id="r_min_kedatangan">
		<td class="<?php echo $m_tipepelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_tipepelanggan_min_kedatangan"><?php echo $m_tipepelanggan_view->min_kedatangan->caption() ?></span></td>
		<td data-name="min_kedatangan" <?php echo $m_tipepelanggan_view->min_kedatangan->cellAttributes() ?>>
<span id="el_m_tipepelanggan_min_kedatangan">
<span<?php echo $m_tipepelanggan_view->min_kedatangan->viewAttributes() ?>><?php echo $m_tipepelanggan_view->min_kedatangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_tipepelanggan_view->periode->Visible) { // periode ?>
	<tr id="r_periode">
		<td class="<?php echo $m_tipepelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_tipepelanggan_periode"><?php echo $m_tipepelanggan_view->periode->caption() ?></span></td>
		<td data-name="periode" <?php echo $m_tipepelanggan_view->periode->cellAttributes() ?>>
<span id="el_m_tipepelanggan_periode">
<span<?php echo $m_tipepelanggan_view->periode->viewAttributes() ?>><?php echo $m_tipepelanggan_view->periode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_tipepelanggan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_tipepelanggan_view->isExport()) { ?>
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
$m_tipepelanggan_view->terminate();
?>