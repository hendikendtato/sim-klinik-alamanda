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
$purchaseorder_delete = new purchaseorder_delete();

// Run the page
$purchaseorder_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$purchaseorder_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpurchaseorderdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpurchaseorderdelete = currentForm = new ew.Form("fpurchaseorderdelete", "delete");
	loadjs.done("fpurchaseorderdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $purchaseorder_delete->showPageHeader(); ?>
<?php
$purchaseorder_delete->showMessage();
?>
<form name="fpurchaseorderdelete" id="fpurchaseorderdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="purchaseorder">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($purchaseorder_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($purchaseorder_delete->no_po->Visible) { // no_po ?>
		<th class="<?php echo $purchaseorder_delete->no_po->headerCellClass() ?>"><span id="elh_purchaseorder_no_po" class="purchaseorder_no_po"><?php echo $purchaseorder_delete->no_po->caption() ?></span></th>
<?php } ?>
<?php if ($purchaseorder_delete->tgl_po->Visible) { // tgl_po ?>
		<th class="<?php echo $purchaseorder_delete->tgl_po->headerCellClass() ?>"><span id="elh_purchaseorder_tgl_po" class="purchaseorder_tgl_po"><?php echo $purchaseorder_delete->tgl_po->caption() ?></span></th>
<?php } ?>
<?php if ($purchaseorder_delete->idklinik->Visible) { // idklinik ?>
		<th class="<?php echo $purchaseorder_delete->idklinik->headerCellClass() ?>"><span id="elh_purchaseorder_idklinik" class="purchaseorder_idklinik"><?php echo $purchaseorder_delete->idklinik->caption() ?></span></th>
<?php } ?>
<?php if ($purchaseorder_delete->id_supplier->Visible) { // id_supplier ?>
		<th class="<?php echo $purchaseorder_delete->id_supplier->headerCellClass() ?>"><span id="elh_purchaseorder_id_supplier" class="purchaseorder_id_supplier"><?php echo $purchaseorder_delete->id_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($purchaseorder_delete->status_po->Visible) { // status_po ?>
		<th class="<?php echo $purchaseorder_delete->status_po->headerCellClass() ?>"><span id="elh_purchaseorder_status_po" class="purchaseorder_status_po"><?php echo $purchaseorder_delete->status_po->caption() ?></span></th>
<?php } ?>
<?php if ($purchaseorder_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $purchaseorder_delete->keterangan->headerCellClass() ?>"><span id="elh_purchaseorder_keterangan" class="purchaseorder_keterangan"><?php echo $purchaseorder_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$purchaseorder_delete->RecordCount = 0;
$i = 0;
while (!$purchaseorder_delete->Recordset->EOF) {
	$purchaseorder_delete->RecordCount++;
	$purchaseorder_delete->RowCount++;

	// Set row properties
	$purchaseorder->resetAttributes();
	$purchaseorder->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$purchaseorder_delete->loadRowValues($purchaseorder_delete->Recordset);

	// Render row
	$purchaseorder_delete->renderRow();
?>
	<tr <?php echo $purchaseorder->rowAttributes() ?>>
<?php if ($purchaseorder_delete->no_po->Visible) { // no_po ?>
		<td <?php echo $purchaseorder_delete->no_po->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_delete->RowCount ?>_purchaseorder_no_po" class="purchaseorder_no_po">
<span<?php echo $purchaseorder_delete->no_po->viewAttributes() ?>><?php echo $purchaseorder_delete->no_po->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($purchaseorder_delete->tgl_po->Visible) { // tgl_po ?>
		<td <?php echo $purchaseorder_delete->tgl_po->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_delete->RowCount ?>_purchaseorder_tgl_po" class="purchaseorder_tgl_po">
<span<?php echo $purchaseorder_delete->tgl_po->viewAttributes() ?>><?php echo $purchaseorder_delete->tgl_po->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($purchaseorder_delete->idklinik->Visible) { // idklinik ?>
		<td <?php echo $purchaseorder_delete->idklinik->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_delete->RowCount ?>_purchaseorder_idklinik" class="purchaseorder_idklinik">
<span<?php echo $purchaseorder_delete->idklinik->viewAttributes() ?>><?php echo $purchaseorder_delete->idklinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($purchaseorder_delete->id_supplier->Visible) { // id_supplier ?>
		<td <?php echo $purchaseorder_delete->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_delete->RowCount ?>_purchaseorder_id_supplier" class="purchaseorder_id_supplier">
<span<?php echo $purchaseorder_delete->id_supplier->viewAttributes() ?>><?php echo $purchaseorder_delete->id_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($purchaseorder_delete->status_po->Visible) { // status_po ?>
		<td <?php echo $purchaseorder_delete->status_po->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_delete->RowCount ?>_purchaseorder_status_po" class="purchaseorder_status_po">
<span<?php echo $purchaseorder_delete->status_po->viewAttributes() ?>><?php echo $purchaseorder_delete->status_po->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($purchaseorder_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $purchaseorder_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_delete->RowCount ?>_purchaseorder_keterangan" class="purchaseorder_keterangan">
<span<?php echo $purchaseorder_delete->keterangan->viewAttributes() ?>><?php echo $purchaseorder_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$purchaseorder_delete->Recordset->moveNext();
}
$purchaseorder_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $purchaseorder_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$purchaseorder_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$purchaseorder_delete->terminate();
?>