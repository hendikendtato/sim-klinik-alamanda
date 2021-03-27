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
$purchaseorder_view = new purchaseorder_view();

// Run the page
$purchaseorder_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$purchaseorder_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$purchaseorder_view->isExport()) { ?>
<script>
var fpurchaseorderview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpurchaseorderview = currentForm = new ew.Form("fpurchaseorderview", "view");
	loadjs.done("fpurchaseorderview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$purchaseorder_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $purchaseorder_view->ExportOptions->render("body") ?>
<?php $purchaseorder_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $purchaseorder_view->showPageHeader(); ?>
<?php
$purchaseorder_view->showMessage();
?>
<form name="fpurchaseorderview" id="fpurchaseorderview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="purchaseorder">
<input type="hidden" name="modal" value="<?php echo (int)$purchaseorder_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($purchaseorder_view->no_po->Visible) { // no_po ?>
	<tr id="r_no_po">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_no_po"><?php echo $purchaseorder_view->no_po->caption() ?></span></td>
		<td data-name="no_po" <?php echo $purchaseorder_view->no_po->cellAttributes() ?>>
<span id="el_purchaseorder_no_po">
<span<?php echo $purchaseorder_view->no_po->viewAttributes() ?>><?php echo $purchaseorder_view->no_po->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($purchaseorder_view->tgl_po->Visible) { // tgl_po ?>
	<tr id="r_tgl_po">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_tgl_po"><?php echo $purchaseorder_view->tgl_po->caption() ?></span></td>
		<td data-name="tgl_po" <?php echo $purchaseorder_view->tgl_po->cellAttributes() ?>>
<span id="el_purchaseorder_tgl_po">
<span<?php echo $purchaseorder_view->tgl_po->viewAttributes() ?>><?php echo $purchaseorder_view->tgl_po->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($purchaseorder_view->idstaff_po->Visible) { // idstaff_po ?>
	<tr id="r_idstaff_po">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_idstaff_po"><?php echo $purchaseorder_view->idstaff_po->caption() ?></span></td>
		<td data-name="idstaff_po" <?php echo $purchaseorder_view->idstaff_po->cellAttributes() ?>>
<span id="el_purchaseorder_idstaff_po">
<span<?php echo $purchaseorder_view->idstaff_po->viewAttributes() ?>><?php echo $purchaseorder_view->idstaff_po->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($purchaseorder_view->idklinik->Visible) { // idklinik ?>
	<tr id="r_idklinik">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_idklinik"><?php echo $purchaseorder_view->idklinik->caption() ?></span></td>
		<td data-name="idklinik" <?php echo $purchaseorder_view->idklinik->cellAttributes() ?>>
<span id="el_purchaseorder_idklinik">
<span<?php echo $purchaseorder_view->idklinik->viewAttributes() ?>><?php echo $purchaseorder_view->idklinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($purchaseorder_view->id_supplier->Visible) { // id_supplier ?>
	<tr id="r_id_supplier">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_id_supplier"><?php echo $purchaseorder_view->id_supplier->caption() ?></span></td>
		<td data-name="id_supplier" <?php echo $purchaseorder_view->id_supplier->cellAttributes() ?>>
<span id="el_purchaseorder_id_supplier">
<span<?php echo $purchaseorder_view->id_supplier->viewAttributes() ?>><?php echo $purchaseorder_view->id_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($purchaseorder_view->status_po->Visible) { // status_po ?>
	<tr id="r_status_po">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_status_po"><?php echo $purchaseorder_view->status_po->caption() ?></span></td>
		<td data-name="status_po" <?php echo $purchaseorder_view->status_po->cellAttributes() ?>>
<span id="el_purchaseorder_status_po">
<span<?php echo $purchaseorder_view->status_po->viewAttributes() ?>><?php echo $purchaseorder_view->status_po->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($purchaseorder_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $purchaseorder_view->TableLeftColumnClass ?>"><span id="elh_purchaseorder_keterangan"><?php echo $purchaseorder_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $purchaseorder_view->keterangan->cellAttributes() ?>>
<span id="el_purchaseorder_keterangan">
<span<?php echo $purchaseorder_view->keterangan->viewAttributes() ?>><?php echo $purchaseorder_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailpo", explode(",", $purchaseorder->getCurrentDetailTable())) && $detailpo->DetailView) {
?>
<?php if ($purchaseorder->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpo", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $purchaseorder_view->detailpo_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailpogrid.php" ?>
<?php } ?>
</form>
<?php
$purchaseorder_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$purchaseorder_view->isExport()) { ?>
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
$purchaseorder_view->terminate();
?>