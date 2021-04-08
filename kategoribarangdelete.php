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
$kategoribarang_delete = new kategoribarang_delete();

// Run the page
$kategoribarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kategoribarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkategoribarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkategoribarangdelete = currentForm = new ew.Form("fkategoribarangdelete", "delete");
	loadjs.done("fkategoribarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kategoribarang_delete->showPageHeader(); ?>
<?php
$kategoribarang_delete->showMessage();
?>
<form name="fkategoribarangdelete" id="fkategoribarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kategoribarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kategoribarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kategoribarang_delete->id->Visible) { // id ?>
		<th class="<?php echo $kategoribarang_delete->id->headerCellClass() ?>"><span id="elh_kategoribarang_id" class="kategoribarang_id"><?php echo $kategoribarang_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($kategoribarang_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $kategoribarang_delete->nama->headerCellClass() ?>"><span id="elh_kategoribarang_nama" class="kategoribarang_nama"><?php echo $kategoribarang_delete->nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kategoribarang_delete->RecordCount = 0;
$i = 0;
while (!$kategoribarang_delete->Recordset->EOF) {
	$kategoribarang_delete->RecordCount++;
	$kategoribarang_delete->RowCount++;

	// Set row properties
	$kategoribarang->resetAttributes();
	$kategoribarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kategoribarang_delete->loadRowValues($kategoribarang_delete->Recordset);

	// Render row
	$kategoribarang_delete->renderRow();
?>
	<tr <?php echo $kategoribarang->rowAttributes() ?>>
<?php if ($kategoribarang_delete->id->Visible) { // id ?>
		<td <?php echo $kategoribarang_delete->id->cellAttributes() ?>>
<span id="el<?php echo $kategoribarang_delete->RowCount ?>_kategoribarang_id" class="kategoribarang_id">
<span<?php echo $kategoribarang_delete->id->viewAttributes() ?>><?php echo $kategoribarang_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kategoribarang_delete->nama->Visible) { // nama ?>
		<td <?php echo $kategoribarang_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $kategoribarang_delete->RowCount ?>_kategoribarang_nama" class="kategoribarang_nama">
<span<?php echo $kategoribarang_delete->nama->viewAttributes() ?>><?php echo $kategoribarang_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kategoribarang_delete->Recordset->moveNext();
}
$kategoribarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kategoribarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kategoribarang_delete->showPageFooter();
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
$kategoribarang_delete->terminate();
?>