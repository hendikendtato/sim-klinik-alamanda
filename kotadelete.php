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
$kota_delete = new kota_delete();

// Run the page
$kota_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kota_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkotadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkotadelete = currentForm = new ew.Form("fkotadelete", "delete");
	loadjs.done("fkotadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kota_delete->showPageHeader(); ?>
<?php
$kota_delete->showMessage();
?>
<form name="fkotadelete" id="fkotadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kota">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kota_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kota_delete->id->Visible) { // id ?>
		<th class="<?php echo $kota_delete->id->headerCellClass() ?>"><span id="elh_kota_id" class="kota_id"><?php echo $kota_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($kota_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $kota_delete->nama->headerCellClass() ?>"><span id="elh_kota_nama" class="kota_nama"><?php echo $kota_delete->nama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kota_delete->RecordCount = 0;
$i = 0;
while (!$kota_delete->Recordset->EOF) {
	$kota_delete->RecordCount++;
	$kota_delete->RowCount++;

	// Set row properties
	$kota->resetAttributes();
	$kota->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kota_delete->loadRowValues($kota_delete->Recordset);

	// Render row
	$kota_delete->renderRow();
?>
	<tr <?php echo $kota->rowAttributes() ?>>
<?php if ($kota_delete->id->Visible) { // id ?>
		<td <?php echo $kota_delete->id->cellAttributes() ?>>
<span id="el<?php echo $kota_delete->RowCount ?>_kota_id" class="kota_id">
<span<?php echo $kota_delete->id->viewAttributes() ?>><?php echo $kota_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kota_delete->nama->Visible) { // nama ?>
		<td <?php echo $kota_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $kota_delete->RowCount ?>_kota_nama" class="kota_nama">
<span<?php echo $kota_delete->nama->viewAttributes() ?>><?php echo $kota_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kota_delete->Recordset->moveNext();
}
$kota_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kota_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kota_delete->showPageFooter();
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
$kota_delete->terminate();
?>