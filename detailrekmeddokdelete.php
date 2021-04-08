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
$detailrekmeddok_delete = new detailrekmeddok_delete();

// Run the page
$detailrekmeddok_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmeddokdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailrekmeddokdelete = currentForm = new ew.Form("fdetailrekmeddokdelete", "delete");
	loadjs.done("fdetailrekmeddokdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmeddok_delete->showPageHeader(); ?>
<?php
$detailrekmeddok_delete->showMessage();
?>
<form name="fdetailrekmeddokdelete" id="fdetailrekmeddokdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmeddok">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailrekmeddok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailrekmeddok_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailrekmeddok_delete->id_barang->headerCellClass() ?>"><span id="elh_detailrekmeddok_id_barang" class="detailrekmeddok_id_barang"><?php echo $detailrekmeddok_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailrekmeddok_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailrekmeddok_delete->jumlah->headerCellClass() ?>"><span id="elh_detailrekmeddok_jumlah" class="detailrekmeddok_jumlah"><?php echo $detailrekmeddok_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailrekmeddok_delete->satuan->Visible) { // satuan ?>
		<th class="<?php echo $detailrekmeddok_delete->satuan->headerCellClass() ?>"><span id="elh_detailrekmeddok_satuan" class="detailrekmeddok_satuan"><?php echo $detailrekmeddok_delete->satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailrekmeddok_delete->RecordCount = 0;
$i = 0;
while (!$detailrekmeddok_delete->Recordset->EOF) {
	$detailrekmeddok_delete->RecordCount++;
	$detailrekmeddok_delete->RowCount++;

	// Set row properties
	$detailrekmeddok->resetAttributes();
	$detailrekmeddok->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailrekmeddok_delete->loadRowValues($detailrekmeddok_delete->Recordset);

	// Render row
	$detailrekmeddok_delete->renderRow();
?>
	<tr <?php echo $detailrekmeddok->rowAttributes() ?>>
<?php if ($detailrekmeddok_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailrekmeddok_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailrekmeddok_delete->RowCount ?>_detailrekmeddok_id_barang" class="detailrekmeddok_id_barang">
<span<?php echo $detailrekmeddok_delete->id_barang->viewAttributes() ?>><?php echo $detailrekmeddok_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailrekmeddok_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailrekmeddok_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailrekmeddok_delete->RowCount ?>_detailrekmeddok_jumlah" class="detailrekmeddok_jumlah">
<span<?php echo $detailrekmeddok_delete->jumlah->viewAttributes() ?>><?php echo $detailrekmeddok_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailrekmeddok_delete->satuan->Visible) { // satuan ?>
		<td <?php echo $detailrekmeddok_delete->satuan->cellAttributes() ?>>
<span id="el<?php echo $detailrekmeddok_delete->RowCount ?>_detailrekmeddok_satuan" class="detailrekmeddok_satuan">
<span<?php echo $detailrekmeddok_delete->satuan->viewAttributes() ?>><?php echo $detailrekmeddok_delete->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailrekmeddok_delete->Recordset->moveNext();
}
$detailrekmeddok_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmeddok_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailrekmeddok_delete->showPageFooter();
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
$detailrekmeddok_delete->terminate();
?>