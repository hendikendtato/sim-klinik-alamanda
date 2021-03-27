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
$detailterimabarang_view = new detailterimabarang_view();

// Run the page
$detailterimabarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailterimabarang_view->isExport()) { ?>
<script>
var fdetailterimabarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailterimabarangview = currentForm = new ew.Form("fdetailterimabarangview", "view");
	loadjs.done("fdetailterimabarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailterimabarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailterimabarang_view->ExportOptions->render("body") ?>
<?php $detailterimabarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailterimabarang_view->showPageHeader(); ?>
<?php
$detailterimabarang_view->showMessage();
?>
<form name="fdetailterimabarangview" id="fdetailterimabarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimabarang">
<input type="hidden" name="modal" value="<?php echo (int)$detailterimabarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailterimabarang_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailterimabarang_view->TableLeftColumnClass ?>"><span id="elh_detailterimabarang_id_barang"><?php echo $detailterimabarang_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailterimabarang_view->id_barang->cellAttributes() ?>>
<span id="el_detailterimabarang_id_barang">
<span<?php echo $detailterimabarang_view->id_barang->viewAttributes() ?>><?php echo $detailterimabarang_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailterimabarang_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailterimabarang_view->TableLeftColumnClass ?>"><span id="elh_detailterimabarang_jumlah"><?php echo $detailterimabarang_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailterimabarang_view->jumlah->cellAttributes() ?>>
<span id="el_detailterimabarang_jumlah">
<span<?php echo $detailterimabarang_view->jumlah->viewAttributes() ?>><?php echo $detailterimabarang_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailterimabarang_view->satuan->Visible) { // satuan ?>
	<tr id="r_satuan">
		<td class="<?php echo $detailterimabarang_view->TableLeftColumnClass ?>"><span id="elh_detailterimabarang_satuan"><?php echo $detailterimabarang_view->satuan->caption() ?></span></td>
		<td data-name="satuan" <?php echo $detailterimabarang_view->satuan->cellAttributes() ?>>
<span id="el_detailterimabarang_satuan">
<span<?php echo $detailterimabarang_view->satuan->viewAttributes() ?>><?php echo $detailterimabarang_view->satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailterimabarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailterimabarang_view->isExport()) { ?>
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
$detailterimabarang_view->terminate();
?>