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
$detailpo_delete = new detailpo_delete();

// Run the page
$detailpo_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailpodelete = currentForm = new ew.Form("fdetailpodelete", "delete");
	loadjs.done("fdetailpodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpo_delete->showPageHeader(); ?>
<?php
$detailpo_delete->showMessage();
?>
<form name="fdetailpodelete" id="fdetailpodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpo">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailpo_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailpo_delete->pid_detailpo->Visible) { // pid_detailpo ?>
		<th class="<?php echo $detailpo_delete->pid_detailpo->headerCellClass() ?>"><span id="elh_detailpo_pid_detailpo" class="detailpo_pid_detailpo"><?php echo $detailpo_delete->pid_detailpo->caption() ?></span></th>
<?php } ?>
<?php if ($detailpo_delete->idbarang->Visible) { // idbarang ?>
		<th class="<?php echo $detailpo_delete->idbarang->headerCellClass() ?>"><span id="elh_detailpo_idbarang" class="detailpo_idbarang"><?php echo $detailpo_delete->idbarang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpo_delete->qty->Visible) { // qty ?>
		<th class="<?php echo $detailpo_delete->qty->headerCellClass() ?>"><span id="elh_detailpo_qty" class="detailpo_qty"><?php echo $detailpo_delete->qty->caption() ?></span></th>
<?php } ?>
<?php if ($detailpo_delete->satuan->Visible) { // satuan ?>
		<th class="<?php echo $detailpo_delete->satuan->headerCellClass() ?>"><span id="elh_detailpo_satuan" class="detailpo_satuan"><?php echo $detailpo_delete->satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailpo_delete->RecordCount = 0;
$i = 0;
while (!$detailpo_delete->Recordset->EOF) {
	$detailpo_delete->RecordCount++;
	$detailpo_delete->RowCount++;

	// Set row properties
	$detailpo->resetAttributes();
	$detailpo->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailpo_delete->loadRowValues($detailpo_delete->Recordset);

	// Render row
	$detailpo_delete->renderRow();
?>
	<tr <?php echo $detailpo->rowAttributes() ?>>
<?php if ($detailpo_delete->pid_detailpo->Visible) { // pid_detailpo ?>
		<td <?php echo $detailpo_delete->pid_detailpo->cellAttributes() ?>>
<span id="el<?php echo $detailpo_delete->RowCount ?>_detailpo_pid_detailpo" class="detailpo_pid_detailpo">
<span<?php echo $detailpo_delete->pid_detailpo->viewAttributes() ?>><?php echo $detailpo_delete->pid_detailpo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpo_delete->idbarang->Visible) { // idbarang ?>
		<td <?php echo $detailpo_delete->idbarang->cellAttributes() ?>>
<span id="el<?php echo $detailpo_delete->RowCount ?>_detailpo_idbarang" class="detailpo_idbarang">
<span<?php echo $detailpo_delete->idbarang->viewAttributes() ?>><?php echo $detailpo_delete->idbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpo_delete->qty->Visible) { // qty ?>
		<td <?php echo $detailpo_delete->qty->cellAttributes() ?>>
<span id="el<?php echo $detailpo_delete->RowCount ?>_detailpo_qty" class="detailpo_qty">
<span<?php echo $detailpo_delete->qty->viewAttributes() ?>><?php echo $detailpo_delete->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpo_delete->satuan->Visible) { // satuan ?>
		<td <?php echo $detailpo_delete->satuan->cellAttributes() ?>>
<span id="el<?php echo $detailpo_delete->RowCount ?>_detailpo_satuan" class="detailpo_satuan">
<span<?php echo $detailpo_delete->satuan->viewAttributes() ?>><?php echo $detailpo_delete->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailpo_delete->Recordset->moveNext();
}
$detailpo_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpo_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailpo_delete->showPageFooter();
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
$detailpo_delete->terminate();
?>