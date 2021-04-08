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
$pos_antrian_delete = new pos_antrian_delete();

// Run the page
$pos_antrian_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pos_antrian_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpos_antriandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpos_antriandelete = currentForm = new ew.Form("fpos_antriandelete", "delete");
	loadjs.done("fpos_antriandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pos_antrian_delete->showPageHeader(); ?>
<?php
$pos_antrian_delete->showMessage();
?>
<form name="fpos_antriandelete" id="fpos_antriandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pos_antrian">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pos_antrian_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pos_antrian_delete->id_pos_antrian->Visible) { // id_pos_antrian ?>
		<th class="<?php echo $pos_antrian_delete->id_pos_antrian->headerCellClass() ?>"><span id="elh_pos_antrian_id_pos_antrian" class="pos_antrian_id_pos_antrian"><?php echo $pos_antrian_delete->id_pos_antrian->caption() ?></span></th>
<?php } ?>
<?php if ($pos_antrian_delete->nama_pos->Visible) { // nama_pos ?>
		<th class="<?php echo $pos_antrian_delete->nama_pos->headerCellClass() ?>"><span id="elh_pos_antrian_nama_pos" class="pos_antrian_nama_pos"><?php echo $pos_antrian_delete->nama_pos->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pos_antrian_delete->RecordCount = 0;
$i = 0;
while (!$pos_antrian_delete->Recordset->EOF) {
	$pos_antrian_delete->RecordCount++;
	$pos_antrian_delete->RowCount++;

	// Set row properties
	$pos_antrian->resetAttributes();
	$pos_antrian->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pos_antrian_delete->loadRowValues($pos_antrian_delete->Recordset);

	// Render row
	$pos_antrian_delete->renderRow();
?>
	<tr <?php echo $pos_antrian->rowAttributes() ?>>
<?php if ($pos_antrian_delete->id_pos_antrian->Visible) { // id_pos_antrian ?>
		<td <?php echo $pos_antrian_delete->id_pos_antrian->cellAttributes() ?>>
<span id="el<?php echo $pos_antrian_delete->RowCount ?>_pos_antrian_id_pos_antrian" class="pos_antrian_id_pos_antrian">
<span<?php echo $pos_antrian_delete->id_pos_antrian->viewAttributes() ?>><?php echo $pos_antrian_delete->id_pos_antrian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pos_antrian_delete->nama_pos->Visible) { // nama_pos ?>
		<td <?php echo $pos_antrian_delete->nama_pos->cellAttributes() ?>>
<span id="el<?php echo $pos_antrian_delete->RowCount ?>_pos_antrian_nama_pos" class="pos_antrian_nama_pos">
<span<?php echo $pos_antrian_delete->nama_pos->viewAttributes() ?>><?php echo $pos_antrian_delete->nama_pos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pos_antrian_delete->Recordset->moveNext();
}
$pos_antrian_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pos_antrian_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pos_antrian_delete->showPageFooter();
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
$pos_antrian_delete->terminate();
?>