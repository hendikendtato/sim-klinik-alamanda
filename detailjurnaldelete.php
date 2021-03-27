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
$detailjurnal_delete = new detailjurnal_delete();

// Run the page
$detailjurnal_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailjurnal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailjurnaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailjurnaldelete = currentForm = new ew.Form("fdetailjurnaldelete", "delete");
	loadjs.done("fdetailjurnaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailjurnal_delete->showPageHeader(); ?>
<?php
$detailjurnal_delete->showMessage();
?>
<form name="fdetailjurnaldelete" id="fdetailjurnaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailjurnal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailjurnal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailjurnal_delete->id_detailjurnal->Visible) { // id_detailjurnal ?>
		<th class="<?php echo $detailjurnal_delete->id_detailjurnal->headerCellClass() ?>"><span id="elh_detailjurnal_id_detailjurnal" class="detailjurnal_id_detailjurnal"><?php echo $detailjurnal_delete->id_detailjurnal->caption() ?></span></th>
<?php } ?>
<?php if ($detailjurnal_delete->id_jurnal->Visible) { // id_jurnal ?>
		<th class="<?php echo $detailjurnal_delete->id_jurnal->headerCellClass() ?>"><span id="elh_detailjurnal_id_jurnal" class="detailjurnal_id_jurnal"><?php echo $detailjurnal_delete->id_jurnal->caption() ?></span></th>
<?php } ?>
<?php if ($detailjurnal_delete->id_akun->Visible) { // id_akun ?>
		<th class="<?php echo $detailjurnal_delete->id_akun->headerCellClass() ?>"><span id="elh_detailjurnal_id_akun" class="detailjurnal_id_akun"><?php echo $detailjurnal_delete->id_akun->caption() ?></span></th>
<?php } ?>
<?php if ($detailjurnal_delete->debet->Visible) { // debet ?>
		<th class="<?php echo $detailjurnal_delete->debet->headerCellClass() ?>"><span id="elh_detailjurnal_debet" class="detailjurnal_debet"><?php echo $detailjurnal_delete->debet->caption() ?></span></th>
<?php } ?>
<?php if ($detailjurnal_delete->kredit->Visible) { // kredit ?>
		<th class="<?php echo $detailjurnal_delete->kredit->headerCellClass() ?>"><span id="elh_detailjurnal_kredit" class="detailjurnal_kredit"><?php echo $detailjurnal_delete->kredit->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailjurnal_delete->RecordCount = 0;
$i = 0;
while (!$detailjurnal_delete->Recordset->EOF) {
	$detailjurnal_delete->RecordCount++;
	$detailjurnal_delete->RowCount++;

	// Set row properties
	$detailjurnal->resetAttributes();
	$detailjurnal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailjurnal_delete->loadRowValues($detailjurnal_delete->Recordset);

	// Render row
	$detailjurnal_delete->renderRow();
?>
	<tr <?php echo $detailjurnal->rowAttributes() ?>>
<?php if ($detailjurnal_delete->id_detailjurnal->Visible) { // id_detailjurnal ?>
		<td <?php echo $detailjurnal_delete->id_detailjurnal->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_delete->RowCount ?>_detailjurnal_id_detailjurnal" class="detailjurnal_id_detailjurnal">
<span<?php echo $detailjurnal_delete->id_detailjurnal->viewAttributes() ?>><?php echo $detailjurnal_delete->id_detailjurnal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailjurnal_delete->id_jurnal->Visible) { // id_jurnal ?>
		<td <?php echo $detailjurnal_delete->id_jurnal->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_delete->RowCount ?>_detailjurnal_id_jurnal" class="detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_delete->id_jurnal->viewAttributes() ?>><?php echo $detailjurnal_delete->id_jurnal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailjurnal_delete->id_akun->Visible) { // id_akun ?>
		<td <?php echo $detailjurnal_delete->id_akun->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_delete->RowCount ?>_detailjurnal_id_akun" class="detailjurnal_id_akun">
<span<?php echo $detailjurnal_delete->id_akun->viewAttributes() ?>><?php echo $detailjurnal_delete->id_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailjurnal_delete->debet->Visible) { // debet ?>
		<td <?php echo $detailjurnal_delete->debet->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_delete->RowCount ?>_detailjurnal_debet" class="detailjurnal_debet">
<span<?php echo $detailjurnal_delete->debet->viewAttributes() ?>><?php echo $detailjurnal_delete->debet->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailjurnal_delete->kredit->Visible) { // kredit ?>
		<td <?php echo $detailjurnal_delete->kredit->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_delete->RowCount ?>_detailjurnal_kredit" class="detailjurnal_kredit">
<span<?php echo $detailjurnal_delete->kredit->viewAttributes() ?>><?php echo $detailjurnal_delete->kredit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailjurnal_delete->Recordset->moveNext();
}
$detailjurnal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailjurnal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailjurnal_delete->showPageFooter();
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
$detailjurnal_delete->terminate();
?>