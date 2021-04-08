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
$komposisi_delete = new komposisi_delete();

// Run the page
$komposisi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komposisi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkomposisidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkomposisidelete = currentForm = new ew.Form("fkomposisidelete", "delete");
	loadjs.done("fkomposisidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $komposisi_delete->showPageHeader(); ?>
<?php
$komposisi_delete->showMessage();
?>
<form name="fkomposisidelete" id="fkomposisidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komposisi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($komposisi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($komposisi_delete->id_komposisi->Visible) { // id_komposisi ?>
		<th class="<?php echo $komposisi_delete->id_komposisi->headerCellClass() ?>"><span id="elh_komposisi_id_komposisi" class="komposisi_id_komposisi"><?php echo $komposisi_delete->id_komposisi->caption() ?></span></th>
<?php } ?>
<?php if ($komposisi_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $komposisi_delete->id_barang->headerCellClass() ?>"><span id="elh_komposisi_id_barang" class="komposisi_id_barang"><?php echo $komposisi_delete->id_barang->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$komposisi_delete->RecordCount = 0;
$i = 0;
while (!$komposisi_delete->Recordset->EOF) {
	$komposisi_delete->RecordCount++;
	$komposisi_delete->RowCount++;

	// Set row properties
	$komposisi->resetAttributes();
	$komposisi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$komposisi_delete->loadRowValues($komposisi_delete->Recordset);

	// Render row
	$komposisi_delete->renderRow();
?>
	<tr <?php echo $komposisi->rowAttributes() ?>>
<?php if ($komposisi_delete->id_komposisi->Visible) { // id_komposisi ?>
		<td <?php echo $komposisi_delete->id_komposisi->cellAttributes() ?>>
<span id="el<?php echo $komposisi_delete->RowCount ?>_komposisi_id_komposisi" class="komposisi_id_komposisi">
<span<?php echo $komposisi_delete->id_komposisi->viewAttributes() ?>><?php echo $komposisi_delete->id_komposisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($komposisi_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $komposisi_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $komposisi_delete->RowCount ?>_komposisi_id_barang" class="komposisi_id_barang">
<span<?php echo $komposisi_delete->id_barang->viewAttributes() ?>><?php echo $komposisi_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$komposisi_delete->Recordset->moveNext();
}
$komposisi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $komposisi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$komposisi_delete->showPageFooter();
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
$komposisi_delete->terminate();
?>