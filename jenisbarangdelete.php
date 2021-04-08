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
$jenisbarang_delete = new jenisbarang_delete();

// Run the page
$jenisbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenisbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenisbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fjenisbarangdelete = currentForm = new ew.Form("fjenisbarangdelete", "delete");
	loadjs.done("fjenisbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenisbarang_delete->showPageHeader(); ?>
<?php
$jenisbarang_delete->showMessage();
?>
<form name="fjenisbarangdelete" id="fjenisbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenisbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($jenisbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($jenisbarang_delete->id->Visible) { // id ?>
		<th class="<?php echo $jenisbarang_delete->id->headerCellClass() ?>"><span id="elh_jenisbarang_id" class="jenisbarang_id"><?php echo $jenisbarang_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($jenisbarang_delete->kode->Visible) { // kode ?>
		<th class="<?php echo $jenisbarang_delete->kode->headerCellClass() ?>"><span id="elh_jenisbarang_kode" class="jenisbarang_kode"><?php echo $jenisbarang_delete->kode->caption() ?></span></th>
<?php } ?>
<?php if ($jenisbarang_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $jenisbarang_delete->jenis->headerCellClass() ?>"><span id="elh_jenisbarang_jenis" class="jenisbarang_jenis"><?php echo $jenisbarang_delete->jenis->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$jenisbarang_delete->RecordCount = 0;
$i = 0;
while (!$jenisbarang_delete->Recordset->EOF) {
	$jenisbarang_delete->RecordCount++;
	$jenisbarang_delete->RowCount++;

	// Set row properties
	$jenisbarang->resetAttributes();
	$jenisbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$jenisbarang_delete->loadRowValues($jenisbarang_delete->Recordset);

	// Render row
	$jenisbarang_delete->renderRow();
?>
	<tr <?php echo $jenisbarang->rowAttributes() ?>>
<?php if ($jenisbarang_delete->id->Visible) { // id ?>
		<td <?php echo $jenisbarang_delete->id->cellAttributes() ?>>
<span id="el<?php echo $jenisbarang_delete->RowCount ?>_jenisbarang_id" class="jenisbarang_id">
<span<?php echo $jenisbarang_delete->id->viewAttributes() ?>><?php echo $jenisbarang_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenisbarang_delete->kode->Visible) { // kode ?>
		<td <?php echo $jenisbarang_delete->kode->cellAttributes() ?>>
<span id="el<?php echo $jenisbarang_delete->RowCount ?>_jenisbarang_kode" class="jenisbarang_kode">
<span<?php echo $jenisbarang_delete->kode->viewAttributes() ?>><?php echo $jenisbarang_delete->kode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($jenisbarang_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $jenisbarang_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $jenisbarang_delete->RowCount ?>_jenisbarang_jenis" class="jenisbarang_jenis">
<span<?php echo $jenisbarang_delete->jenis->viewAttributes() ?>><?php echo $jenisbarang_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$jenisbarang_delete->Recordset->moveNext();
}
$jenisbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenisbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$jenisbarang_delete->showPageFooter();
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
$jenisbarang_delete->terminate();
?>