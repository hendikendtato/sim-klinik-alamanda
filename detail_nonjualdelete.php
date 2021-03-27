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
$detail_nonjual_delete = new detail_nonjual_delete();

// Run the page
$detail_nonjual_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detail_nonjual_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetail_nonjualdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetail_nonjualdelete = currentForm = new ew.Form("fdetail_nonjualdelete", "delete");
	loadjs.done("fdetail_nonjualdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detail_nonjual_delete->showPageHeader(); ?>
<?php
$detail_nonjual_delete->showMessage();
?>
<form name="fdetail_nonjualdelete" id="fdetail_nonjualdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detail_nonjual">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detail_nonjual_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detail_nonjual_delete->id_nonjual->Visible) { // id_nonjual ?>
		<th class="<?php echo $detail_nonjual_delete->id_nonjual->headerCellClass() ?>"><span id="elh_detail_nonjual_id_nonjual" class="detail_nonjual_id_nonjual"><?php echo $detail_nonjual_delete->id_nonjual->caption() ?></span></th>
<?php } ?>
<?php if ($detail_nonjual_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detail_nonjual_delete->id_barang->headerCellClass() ?>"><span id="elh_detail_nonjual_id_barang" class="detail_nonjual_id_barang"><?php echo $detail_nonjual_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detail_nonjual_delete->stok->Visible) { // stok ?>
		<th class="<?php echo $detail_nonjual_delete->stok->headerCellClass() ?>"><span id="elh_detail_nonjual_stok" class="detail_nonjual_stok"><?php echo $detail_nonjual_delete->stok->caption() ?></span></th>
<?php } ?>
<?php if ($detail_nonjual_delete->qty->Visible) { // qty ?>
		<th class="<?php echo $detail_nonjual_delete->qty->headerCellClass() ?>"><span id="elh_detail_nonjual_qty" class="detail_nonjual_qty"><?php echo $detail_nonjual_delete->qty->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detail_nonjual_delete->RecordCount = 0;
$i = 0;
while (!$detail_nonjual_delete->Recordset->EOF) {
	$detail_nonjual_delete->RecordCount++;
	$detail_nonjual_delete->RowCount++;

	// Set row properties
	$detail_nonjual->resetAttributes();
	$detail_nonjual->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detail_nonjual_delete->loadRowValues($detail_nonjual_delete->Recordset);

	// Render row
	$detail_nonjual_delete->renderRow();
?>
	<tr <?php echo $detail_nonjual->rowAttributes() ?>>
<?php if ($detail_nonjual_delete->id_nonjual->Visible) { // id_nonjual ?>
		<td <?php echo $detail_nonjual_delete->id_nonjual->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_delete->RowCount ?>_detail_nonjual_id_nonjual" class="detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_delete->id_nonjual->viewAttributes() ?>><?php echo $detail_nonjual_delete->id_nonjual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detail_nonjual_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detail_nonjual_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_delete->RowCount ?>_detail_nonjual_id_barang" class="detail_nonjual_id_barang">
<span<?php echo $detail_nonjual_delete->id_barang->viewAttributes() ?>><?php echo $detail_nonjual_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detail_nonjual_delete->stok->Visible) { // stok ?>
		<td <?php echo $detail_nonjual_delete->stok->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_delete->RowCount ?>_detail_nonjual_stok" class="detail_nonjual_stok">
<span<?php echo $detail_nonjual_delete->stok->viewAttributes() ?>><?php echo $detail_nonjual_delete->stok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detail_nonjual_delete->qty->Visible) { // qty ?>
		<td <?php echo $detail_nonjual_delete->qty->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_delete->RowCount ?>_detail_nonjual_qty" class="detail_nonjual_qty">
<span<?php echo $detail_nonjual_delete->qty->viewAttributes() ?>><?php echo $detail_nonjual_delete->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detail_nonjual_delete->Recordset->moveNext();
}
$detail_nonjual_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detail_nonjual_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detail_nonjual_delete->showPageFooter();
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
$detail_nonjual_delete->terminate();
?>