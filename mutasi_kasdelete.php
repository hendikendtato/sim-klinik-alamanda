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
$mutasi_kas_delete = new mutasi_kas_delete();

// Run the page
$mutasi_kas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mutasi_kas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmutasi_kasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmutasi_kasdelete = currentForm = new ew.Form("fmutasi_kasdelete", "delete");
	loadjs.done("fmutasi_kasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mutasi_kas_delete->showPageHeader(); ?>
<?php
$mutasi_kas_delete->showMessage();
?>
<form name="fmutasi_kasdelete" id="fmutasi_kasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mutasi_kas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($mutasi_kas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($mutasi_kas_delete->no_bukti->Visible) { // no_bukti ?>
		<th class="<?php echo $mutasi_kas_delete->no_bukti->headerCellClass() ?>"><span id="elh_mutasi_kas_no_bukti" class="mutasi_kas_no_bukti"><?php echo $mutasi_kas_delete->no_bukti->caption() ?></span></th>
<?php } ?>
<?php if ($mutasi_kas_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $mutasi_kas_delete->tgl->headerCellClass() ?>"><span id="elh_mutasi_kas_tgl" class="mutasi_kas_tgl"><?php echo $mutasi_kas_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($mutasi_kas_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $mutasi_kas_delete->id_klinik->headerCellClass() ?>"><span id="elh_mutasi_kas_id_klinik" class="mutasi_kas_id_klinik"><?php echo $mutasi_kas_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($mutasi_kas_delete->id_kas->Visible) { // id_kas ?>
		<th class="<?php echo $mutasi_kas_delete->id_kas->headerCellClass() ?>"><span id="elh_mutasi_kas_id_kas" class="mutasi_kas_id_kas"><?php echo $mutasi_kas_delete->id_kas->caption() ?></span></th>
<?php } ?>
<?php if ($mutasi_kas_delete->tipe->Visible) { // tipe ?>
		<th class="<?php echo $mutasi_kas_delete->tipe->headerCellClass() ?>"><span id="elh_mutasi_kas_tipe" class="mutasi_kas_tipe"><?php echo $mutasi_kas_delete->tipe->caption() ?></span></th>
<?php } ?>
<?php if ($mutasi_kas_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $mutasi_kas_delete->keterangan->headerCellClass() ?>"><span id="elh_mutasi_kas_keterangan" class="mutasi_kas_keterangan"><?php echo $mutasi_kas_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$mutasi_kas_delete->RecordCount = 0;
$i = 0;
while (!$mutasi_kas_delete->Recordset->EOF) {
	$mutasi_kas_delete->RecordCount++;
	$mutasi_kas_delete->RowCount++;

	// Set row properties
	$mutasi_kas->resetAttributes();
	$mutasi_kas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$mutasi_kas_delete->loadRowValues($mutasi_kas_delete->Recordset);

	// Render row
	$mutasi_kas_delete->renderRow();
?>
	<tr <?php echo $mutasi_kas->rowAttributes() ?>>
<?php if ($mutasi_kas_delete->no_bukti->Visible) { // no_bukti ?>
		<td <?php echo $mutasi_kas_delete->no_bukti->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_delete->RowCount ?>_mutasi_kas_no_bukti" class="mutasi_kas_no_bukti">
<span<?php echo $mutasi_kas_delete->no_bukti->viewAttributes() ?>><?php echo $mutasi_kas_delete->no_bukti->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mutasi_kas_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $mutasi_kas_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_delete->RowCount ?>_mutasi_kas_tgl" class="mutasi_kas_tgl">
<span<?php echo $mutasi_kas_delete->tgl->viewAttributes() ?>><?php echo $mutasi_kas_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mutasi_kas_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $mutasi_kas_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_delete->RowCount ?>_mutasi_kas_id_klinik" class="mutasi_kas_id_klinik">
<span<?php echo $mutasi_kas_delete->id_klinik->viewAttributes() ?>><?php echo $mutasi_kas_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mutasi_kas_delete->id_kas->Visible) { // id_kas ?>
		<td <?php echo $mutasi_kas_delete->id_kas->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_delete->RowCount ?>_mutasi_kas_id_kas" class="mutasi_kas_id_kas">
<span<?php echo $mutasi_kas_delete->id_kas->viewAttributes() ?>><?php echo $mutasi_kas_delete->id_kas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mutasi_kas_delete->tipe->Visible) { // tipe ?>
		<td <?php echo $mutasi_kas_delete->tipe->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_delete->RowCount ?>_mutasi_kas_tipe" class="mutasi_kas_tipe">
<span<?php echo $mutasi_kas_delete->tipe->viewAttributes() ?>><?php echo $mutasi_kas_delete->tipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mutasi_kas_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $mutasi_kas_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_delete->RowCount ?>_mutasi_kas_keterangan" class="mutasi_kas_keterangan">
<span<?php echo $mutasi_kas_delete->keterangan->viewAttributes() ?>><?php echo $mutasi_kas_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$mutasi_kas_delete->Recordset->moveNext();
}
$mutasi_kas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mutasi_kas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$mutasi_kas_delete->showPageFooter();
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
$mutasi_kas_delete->terminate();
?>