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
$detailretur_view = new detailretur_view();

// Run the page
$detailretur_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailretur_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailretur_view->isExport()) { ?>
<script>
var fdetailreturview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailreturview = currentForm = new ew.Form("fdetailreturview", "view");
	loadjs.done("fdetailreturview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailretur_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailretur_view->ExportOptions->render("body") ?>
<?php $detailretur_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailretur_view->showPageHeader(); ?>
<?php
$detailretur_view->showMessage();
?>
<form name="fdetailreturview" id="fdetailreturview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailretur">
<input type="hidden" name="modal" value="<?php echo (int)$detailretur_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailretur_view->id_detailretur->Visible) { // id_detailretur ?>
	<tr id="r_id_detailretur">
		<td class="<?php echo $detailretur_view->TableLeftColumnClass ?>"><span id="elh_detailretur_id_detailretur"><?php echo $detailretur_view->id_detailretur->caption() ?></span></td>
		<td data-name="id_detailretur" <?php echo $detailretur_view->id_detailretur->cellAttributes() ?>>
<span id="el_detailretur_id_detailretur">
<span<?php echo $detailretur_view->id_detailretur->viewAttributes() ?>><?php echo $detailretur_view->id_detailretur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailretur_view->id_retur->Visible) { // id_retur ?>
	<tr id="r_id_retur">
		<td class="<?php echo $detailretur_view->TableLeftColumnClass ?>"><span id="elh_detailretur_id_retur"><?php echo $detailretur_view->id_retur->caption() ?></span></td>
		<td data-name="id_retur" <?php echo $detailretur_view->id_retur->cellAttributes() ?>>
<span id="el_detailretur_id_retur">
<span<?php echo $detailretur_view->id_retur->viewAttributes() ?>><?php echo $detailretur_view->id_retur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailretur_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailretur_view->TableLeftColumnClass ?>"><span id="elh_detailretur_id_barang"><?php echo $detailretur_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailretur_view->id_barang->cellAttributes() ?>>
<span id="el_detailretur_id_barang">
<span<?php echo $detailretur_view->id_barang->viewAttributes() ?>><?php echo $detailretur_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailretur_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailretur_view->TableLeftColumnClass ?>"><span id="elh_detailretur_jumlah"><?php echo $detailretur_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailretur_view->jumlah->cellAttributes() ?>>
<span id="el_detailretur_jumlah">
<span<?php echo $detailretur_view->jumlah->viewAttributes() ?>><?php echo $detailretur_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailretur_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailretur_view->TableLeftColumnClass ?>"><span id="elh_detailretur_id_satuan"><?php echo $detailretur_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailretur_view->id_satuan->cellAttributes() ?>>
<span id="el_detailretur_id_satuan">
<span<?php echo $detailretur_view->id_satuan->viewAttributes() ?>><?php echo $detailretur_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailretur_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailretur_view->isExport()) { ?>
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
$detailretur_view->terminate();
?>