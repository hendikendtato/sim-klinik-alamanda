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
$subkategoribarang_delete = new subkategoribarang_delete();

// Run the page
$subkategoribarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subkategoribarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsubkategoribarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsubkategoribarangdelete = currentForm = new ew.Form("fsubkategoribarangdelete", "delete");
	loadjs.done("fsubkategoribarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $subkategoribarang_delete->showPageHeader(); ?>
<?php
$subkategoribarang_delete->showMessage();
?>
<form name="fsubkategoribarangdelete" id="fsubkategoribarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subkategoribarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($subkategoribarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($subkategoribarang_delete->id->Visible) { // id ?>
		<th class="<?php echo $subkategoribarang_delete->id->headerCellClass() ?>"><span id="elh_subkategoribarang_id" class="subkategoribarang_id"><?php echo $subkategoribarang_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($subkategoribarang_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $subkategoribarang_delete->nama->headerCellClass() ?>"><span id="elh_subkategoribarang_nama" class="subkategoribarang_nama"><?php echo $subkategoribarang_delete->nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$subkategoribarang_delete->RecordCount = 0;
$i = 0;
while (!$subkategoribarang_delete->Recordset->EOF) {
	$subkategoribarang_delete->RecordCount++;
	$subkategoribarang_delete->RowCount++;

	// Set row properties
	$subkategoribarang->resetAttributes();
	$subkategoribarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$subkategoribarang_delete->loadRowValues($subkategoribarang_delete->Recordset);

	// Render row
	$subkategoribarang_delete->renderRow();
?>
	<tr <?php echo $subkategoribarang->rowAttributes() ?>>
<?php if ($subkategoribarang_delete->id->Visible) { // id ?>
		<td <?php echo $subkategoribarang_delete->id->cellAttributes() ?>>
<span id="el<?php echo $subkategoribarang_delete->RowCount ?>_subkategoribarang_id" class="subkategoribarang_id">
<span<?php echo $subkategoribarang_delete->id->viewAttributes() ?>><?php echo $subkategoribarang_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($subkategoribarang_delete->nama->Visible) { // nama ?>
		<td <?php echo $subkategoribarang_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $subkategoribarang_delete->RowCount ?>_subkategoribarang_nama" class="subkategoribarang_nama">
<span<?php echo $subkategoribarang_delete->nama->viewAttributes() ?>><?php echo $subkategoribarang_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$subkategoribarang_delete->Recordset->moveNext();
}
$subkategoribarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $subkategoribarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$subkategoribarang_delete->showPageFooter();
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
$subkategoribarang_delete->terminate();
?>