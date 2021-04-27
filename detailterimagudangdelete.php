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
$detailterimagudang_delete = new detailterimagudang_delete();

// Run the page
$detailterimagudang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimagudang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailterimagudangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailterimagudangdelete = currentForm = new ew.Form("fdetailterimagudangdelete", "delete");
	loadjs.done("fdetailterimagudangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailterimagudang_delete->showPageHeader(); ?>
<?php
$detailterimagudang_delete->showMessage();
?>
<form name="fdetailterimagudangdelete" id="fdetailterimagudangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimagudang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailterimagudang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailterimagudang_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailterimagudang_delete->id_barang->headerCellClass() ?>"><span id="elh_detailterimagudang_id_barang" class="detailterimagudang_id_barang"><?php echo $detailterimagudang_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailterimagudang_delete->qty->Visible) { // qty ?>
		<th class="<?php echo $detailterimagudang_delete->qty->headerCellClass() ?>"><span id="elh_detailterimagudang_qty" class="detailterimagudang_qty"><?php echo $detailterimagudang_delete->qty->caption() ?></span></th>
<?php } ?>
<?php if ($detailterimagudang_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailterimagudang_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailterimagudang_id_satuan" class="detailterimagudang_id_satuan"><?php echo $detailterimagudang_delete->id_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailterimagudang_delete->RecordCount = 0;
$i = 0;
while (!$detailterimagudang_delete->Recordset->EOF) {
	$detailterimagudang_delete->RecordCount++;
	$detailterimagudang_delete->RowCount++;

	// Set row properties
	$detailterimagudang->resetAttributes();
	$detailterimagudang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailterimagudang_delete->loadRowValues($detailterimagudang_delete->Recordset);

	// Render row
	$detailterimagudang_delete->renderRow();
?>
	<tr <?php echo $detailterimagudang->rowAttributes() ?>>
<?php if ($detailterimagudang_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailterimagudang_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailterimagudang_delete->RowCount ?>_detailterimagudang_id_barang" class="detailterimagudang_id_barang">
<span<?php echo $detailterimagudang_delete->id_barang->viewAttributes() ?>><?php echo $detailterimagudang_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailterimagudang_delete->qty->Visible) { // qty ?>
		<td <?php echo $detailterimagudang_delete->qty->cellAttributes() ?>>
<span id="el<?php echo $detailterimagudang_delete->RowCount ?>_detailterimagudang_qty" class="detailterimagudang_qty">
<span<?php echo $detailterimagudang_delete->qty->viewAttributes() ?>><?php echo $detailterimagudang_delete->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailterimagudang_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailterimagudang_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailterimagudang_delete->RowCount ?>_detailterimagudang_id_satuan" class="detailterimagudang_id_satuan">
<span<?php echo $detailterimagudang_delete->id_satuan->viewAttributes() ?>><?php echo $detailterimagudang_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailterimagudang_delete->Recordset->moveNext();
}
$detailterimagudang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailterimagudang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailterimagudang_delete->showPageFooter();
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
$detailterimagudang_delete->terminate();
?>