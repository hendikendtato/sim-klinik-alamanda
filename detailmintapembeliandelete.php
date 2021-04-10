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
$detailmintapembelian_delete = new detailmintapembelian_delete();

// Run the page
$detailmintapembelian_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmintapembelian_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailmintapembeliandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailmintapembeliandelete = currentForm = new ew.Form("fdetailmintapembeliandelete", "delete");
	loadjs.done("fdetailmintapembeliandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailmintapembelian_delete->showPageHeader(); ?>
<?php
$detailmintapembelian_delete->showMessage();
?>
<form name="fdetailmintapembeliandelete" id="fdetailmintapembeliandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmintapembelian">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailmintapembelian_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailmintapembelian_delete->id_detailpp->Visible) { // id_detailpp ?>
		<th class="<?php echo $detailmintapembelian_delete->id_detailpp->headerCellClass() ?>"><span id="elh_detailmintapembelian_id_detailpp" class="detailmintapembelian_id_detailpp"><?php echo $detailmintapembelian_delete->id_detailpp->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->pid_pp->Visible) { // pid_pp ?>
		<th class="<?php echo $detailmintapembelian_delete->pid_pp->headerCellClass() ?>"><span id="elh_detailmintapembelian_pid_pp" class="detailmintapembelian_pid_pp"><?php echo $detailmintapembelian_delete->pid_pp->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->idbarang->Visible) { // idbarang ?>
		<th class="<?php echo $detailmintapembelian_delete->idbarang->headerCellClass() ?>"><span id="elh_detailmintapembelian_idbarang" class="detailmintapembelian_idbarang"><?php echo $detailmintapembelian_delete->idbarang->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->part->Visible) { // part ?>
		<th class="<?php echo $detailmintapembelian_delete->part->headerCellClass() ?>"><span id="elh_detailmintapembelian_part" class="detailmintapembelian_part"><?php echo $detailmintapembelian_delete->part->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->lot->Visible) { // lot ?>
		<th class="<?php echo $detailmintapembelian_delete->lot->headerCellClass() ?>"><span id="elh_detailmintapembelian_lot" class="detailmintapembelian_lot"><?php echo $detailmintapembelian_delete->lot->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->qty_pp->Visible) { // qty_pp ?>
		<th class="<?php echo $detailmintapembelian_delete->qty_pp->headerCellClass() ?>"><span id="elh_detailmintapembelian_qty_pp" class="detailmintapembelian_qty_pp"><?php echo $detailmintapembelian_delete->qty_pp->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->qty_acc->Visible) { // qty_acc ?>
		<th class="<?php echo $detailmintapembelian_delete->qty_acc->headerCellClass() ?>"><span id="elh_detailmintapembelian_qty_acc" class="detailmintapembelian_qty_acc"><?php echo $detailmintapembelian_delete->qty_acc->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailmintapembelian_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailmintapembelian_id_satuan" class="detailmintapembelian_id_satuan"><?php echo $detailmintapembelian_delete->id_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->harga->Visible) { // harga ?>
		<th class="<?php echo $detailmintapembelian_delete->harga->headerCellClass() ?>"><span id="elh_detailmintapembelian_harga" class="detailmintapembelian_harga"><?php echo $detailmintapembelian_delete->harga->caption() ?></span></th>
<?php } ?>
<?php if ($detailmintapembelian_delete->total->Visible) { // total ?>
		<th class="<?php echo $detailmintapembelian_delete->total->headerCellClass() ?>"><span id="elh_detailmintapembelian_total" class="detailmintapembelian_total"><?php echo $detailmintapembelian_delete->total->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailmintapembelian_delete->RecordCount = 0;
$i = 0;
while (!$detailmintapembelian_delete->Recordset->EOF) {
	$detailmintapembelian_delete->RecordCount++;
	$detailmintapembelian_delete->RowCount++;

	// Set row properties
	$detailmintapembelian->resetAttributes();
	$detailmintapembelian->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailmintapembelian_delete->loadRowValues($detailmintapembelian_delete->Recordset);

	// Render row
	$detailmintapembelian_delete->renderRow();
?>
	<tr <?php echo $detailmintapembelian->rowAttributes() ?>>
<?php if ($detailmintapembelian_delete->id_detailpp->Visible) { // id_detailpp ?>
		<td <?php echo $detailmintapembelian_delete->id_detailpp->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_id_detailpp" class="detailmintapembelian_id_detailpp">
<span<?php echo $detailmintapembelian_delete->id_detailpp->viewAttributes() ?>><?php echo $detailmintapembelian_delete->id_detailpp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->pid_pp->Visible) { // pid_pp ?>
		<td <?php echo $detailmintapembelian_delete->pid_pp->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_pid_pp" class="detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_delete->pid_pp->viewAttributes() ?>><?php echo $detailmintapembelian_delete->pid_pp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->idbarang->Visible) { // idbarang ?>
		<td <?php echo $detailmintapembelian_delete->idbarang->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_idbarang" class="detailmintapembelian_idbarang">
<span<?php echo $detailmintapembelian_delete->idbarang->viewAttributes() ?>><?php echo $detailmintapembelian_delete->idbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->part->Visible) { // part ?>
		<td <?php echo $detailmintapembelian_delete->part->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_part" class="detailmintapembelian_part">
<span<?php echo $detailmintapembelian_delete->part->viewAttributes() ?>><?php echo $detailmintapembelian_delete->part->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->lot->Visible) { // lot ?>
		<td <?php echo $detailmintapembelian_delete->lot->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_lot" class="detailmintapembelian_lot">
<span<?php echo $detailmintapembelian_delete->lot->viewAttributes() ?>><?php echo $detailmintapembelian_delete->lot->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->qty_pp->Visible) { // qty_pp ?>
		<td <?php echo $detailmintapembelian_delete->qty_pp->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_qty_pp" class="detailmintapembelian_qty_pp">
<span<?php echo $detailmintapembelian_delete->qty_pp->viewAttributes() ?>><?php echo $detailmintapembelian_delete->qty_pp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->qty_acc->Visible) { // qty_acc ?>
		<td <?php echo $detailmintapembelian_delete->qty_acc->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_qty_acc" class="detailmintapembelian_qty_acc">
<span<?php echo $detailmintapembelian_delete->qty_acc->viewAttributes() ?>><?php echo $detailmintapembelian_delete->qty_acc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailmintapembelian_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_id_satuan" class="detailmintapembelian_id_satuan">
<span<?php echo $detailmintapembelian_delete->id_satuan->viewAttributes() ?>><?php echo $detailmintapembelian_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->harga->Visible) { // harga ?>
		<td <?php echo $detailmintapembelian_delete->harga->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_harga" class="detailmintapembelian_harga">
<span<?php echo $detailmintapembelian_delete->harga->viewAttributes() ?>><?php echo $detailmintapembelian_delete->harga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_delete->total->Visible) { // total ?>
		<td <?php echo $detailmintapembelian_delete->total->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_delete->RowCount ?>_detailmintapembelian_total" class="detailmintapembelian_total">
<span<?php echo $detailmintapembelian_delete->total->viewAttributes() ?>><?php echo $detailmintapembelian_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailmintapembelian_delete->Recordset->moveNext();
}
$detailmintapembelian_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailmintapembelian_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailmintapembelian_delete->showPageFooter();
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
$detailmintapembelian_delete->terminate();
?>