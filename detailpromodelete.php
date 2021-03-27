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
$detailpromo_delete = new detailpromo_delete();

// Run the page
$detailpromo_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpromodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailpromodelete = currentForm = new ew.Form("fdetailpromodelete", "delete");
	loadjs.done("fdetailpromodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpromo_delete->showPageHeader(); ?>
<?php
$detailpromo_delete->showMessage();
?>
<form name="fdetailpromodelete" id="fdetailpromodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpromo">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailpromo_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailpromo_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailpromo_delete->id_barang->headerCellClass() ?>"><span id="elh_detailpromo_id_barang" class="detailpromo_id_barang"><?php echo $detailpromo_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpromo_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailpromo_delete->jumlah->headerCellClass() ?>"><span id="elh_detailpromo_jumlah" class="detailpromo_jumlah"><?php echo $detailpromo_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailpromo_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailpromo_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailpromo_id_satuan" class="detailpromo_id_satuan"><?php echo $detailpromo_delete->id_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailpromo_delete->RecordCount = 0;
$i = 0;
while (!$detailpromo_delete->Recordset->EOF) {
	$detailpromo_delete->RecordCount++;
	$detailpromo_delete->RowCount++;

	// Set row properties
	$detailpromo->resetAttributes();
	$detailpromo->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailpromo_delete->loadRowValues($detailpromo_delete->Recordset);

	// Render row
	$detailpromo_delete->renderRow();
?>
	<tr <?php echo $detailpromo->rowAttributes() ?>>
<?php if ($detailpromo_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailpromo_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpromo_delete->RowCount ?>_detailpromo_id_barang" class="detailpromo_id_barang">
<span<?php echo $detailpromo_delete->id_barang->viewAttributes() ?>><?php echo $detailpromo_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpromo_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailpromo_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailpromo_delete->RowCount ?>_detailpromo_jumlah" class="detailpromo_jumlah">
<span<?php echo $detailpromo_delete->jumlah->viewAttributes() ?>><?php echo $detailpromo_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpromo_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailpromo_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailpromo_delete->RowCount ?>_detailpromo_id_satuan" class="detailpromo_id_satuan">
<span<?php echo $detailpromo_delete->id_satuan->viewAttributes() ?>><?php echo $detailpromo_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailpromo_delete->Recordset->moveNext();
}
$detailpromo_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpromo_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailpromo_delete->showPageFooter();
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
$detailpromo_delete->terminate();
?>