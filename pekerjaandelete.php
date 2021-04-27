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
$pekerjaan_delete = new pekerjaan_delete();

// Run the page
$pekerjaan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pekerjaan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpekerjaandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpekerjaandelete = currentForm = new ew.Form("fpekerjaandelete", "delete");
	loadjs.done("fpekerjaandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pekerjaan_delete->showPageHeader(); ?>
<?php
$pekerjaan_delete->showMessage();
?>
<form name="fpekerjaandelete" id="fpekerjaandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pekerjaan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pekerjaan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pekerjaan_delete->id->Visible) { // id ?>
		<th class="<?php echo $pekerjaan_delete->id->headerCellClass() ?>"><span id="elh_pekerjaan_id" class="pekerjaan_id"><?php echo $pekerjaan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($pekerjaan_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $pekerjaan_delete->nama->headerCellClass() ?>"><span id="elh_pekerjaan_nama" class="pekerjaan_nama"><?php echo $pekerjaan_delete->nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pekerjaan_delete->RecordCount = 0;
$i = 0;
while (!$pekerjaan_delete->Recordset->EOF) {
	$pekerjaan_delete->RecordCount++;
	$pekerjaan_delete->RowCount++;

	// Set row properties
	$pekerjaan->resetAttributes();
	$pekerjaan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pekerjaan_delete->loadRowValues($pekerjaan_delete->Recordset);

	// Render row
	$pekerjaan_delete->renderRow();
?>
	<tr <?php echo $pekerjaan->rowAttributes() ?>>
<?php if ($pekerjaan_delete->id->Visible) { // id ?>
		<td <?php echo $pekerjaan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $pekerjaan_delete->RowCount ?>_pekerjaan_id" class="pekerjaan_id">
<span<?php echo $pekerjaan_delete->id->viewAttributes() ?>><?php echo $pekerjaan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pekerjaan_delete->nama->Visible) { // nama ?>
		<td <?php echo $pekerjaan_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $pekerjaan_delete->RowCount ?>_pekerjaan_nama" class="pekerjaan_nama">
<span<?php echo $pekerjaan_delete->nama->viewAttributes() ?>><?php echo $pekerjaan_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pekerjaan_delete->Recordset->moveNext();
}
$pekerjaan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pekerjaan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pekerjaan_delete->showPageFooter();
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
$pekerjaan_delete->terminate();
?>