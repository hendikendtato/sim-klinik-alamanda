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
$detailrekmedterapis_delete = new detailrekmedterapis_delete();

// Run the page
$detailrekmedterapis_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmedterapisdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailrekmedterapisdelete = currentForm = new ew.Form("fdetailrekmedterapisdelete", "delete");
	loadjs.done("fdetailrekmedterapisdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmedterapis_delete->showPageHeader(); ?>
<?php
$detailrekmedterapis_delete->showMessage();
?>
<form name="fdetailrekmedterapisdelete" id="fdetailrekmedterapisdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedterapis">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailrekmedterapis_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailrekmedterapis_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailrekmedterapis_delete->id_barang->headerCellClass() ?>"><span id="elh_detailrekmedterapis_id_barang" class="detailrekmedterapis_id_barang"><?php echo $detailrekmedterapis_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailrekmedterapis_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailrekmedterapis_delete->jumlah->headerCellClass() ?>"><span id="elh_detailrekmedterapis_jumlah" class="detailrekmedterapis_jumlah"><?php echo $detailrekmedterapis_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailrekmedterapis_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailrekmedterapis_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailrekmedterapis_id_satuan" class="detailrekmedterapis_id_satuan"><?php echo $detailrekmedterapis_delete->id_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailrekmedterapis_delete->RecordCount = 0;
$i = 0;
while (!$detailrekmedterapis_delete->Recordset->EOF) {
	$detailrekmedterapis_delete->RecordCount++;
	$detailrekmedterapis_delete->RowCount++;

	// Set row properties
	$detailrekmedterapis->resetAttributes();
	$detailrekmedterapis->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailrekmedterapis_delete->loadRowValues($detailrekmedterapis_delete->Recordset);

	// Render row
	$detailrekmedterapis_delete->renderRow();
?>
	<tr <?php echo $detailrekmedterapis->rowAttributes() ?>>
<?php if ($detailrekmedterapis_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailrekmedterapis_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedterapis_delete->RowCount ?>_detailrekmedterapis_id_barang" class="detailrekmedterapis_id_barang">
<span<?php echo $detailrekmedterapis_delete->id_barang->viewAttributes() ?>><?php echo $detailrekmedterapis_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailrekmedterapis_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailrekmedterapis_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedterapis_delete->RowCount ?>_detailrekmedterapis_jumlah" class="detailrekmedterapis_jumlah">
<span<?php echo $detailrekmedterapis_delete->jumlah->viewAttributes() ?>><?php echo $detailrekmedterapis_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailrekmedterapis_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailrekmedterapis_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedterapis_delete->RowCount ?>_detailrekmedterapis_id_satuan" class="detailrekmedterapis_id_satuan">
<span<?php echo $detailrekmedterapis_delete->id_satuan->viewAttributes() ?>><?php echo $detailrekmedterapis_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailrekmedterapis_delete->Recordset->moveNext();
}
$detailrekmedterapis_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmedterapis_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailrekmedterapis_delete->showPageFooter();
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
$detailrekmedterapis_delete->terminate();
?>