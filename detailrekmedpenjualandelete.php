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
$detailrekmedpenjualan_delete = new detailrekmedpenjualan_delete();

// Run the page
$detailrekmedpenjualan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedpenjualan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmedpenjualandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailrekmedpenjualandelete = currentForm = new ew.Form("fdetailrekmedpenjualandelete", "delete");
	loadjs.done("fdetailrekmedpenjualandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmedpenjualan_delete->showPageHeader(); ?>
<?php
$detailrekmedpenjualan_delete->showMessage();
?>
<form name="fdetailrekmedpenjualandelete" id="fdetailrekmedpenjualandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedpenjualan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailrekmedpenjualan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailrekmedpenjualan_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailrekmedpenjualan_delete->id_barang->headerCellClass() ?>"><span id="elh_detailrekmedpenjualan_id_barang" class="detailrekmedpenjualan_id_barang"><?php echo $detailrekmedpenjualan_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailrekmedpenjualan_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailrekmedpenjualan_delete->jumlah->headerCellClass() ?>"><span id="elh_detailrekmedpenjualan_jumlah" class="detailrekmedpenjualan_jumlah"><?php echo $detailrekmedpenjualan_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailrekmedpenjualan_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailrekmedpenjualan_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailrekmedpenjualan_id_satuan" class="detailrekmedpenjualan_id_satuan"><?php echo $detailrekmedpenjualan_delete->id_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailrekmedpenjualan_delete->RecordCount = 0;
$i = 0;
while (!$detailrekmedpenjualan_delete->Recordset->EOF) {
	$detailrekmedpenjualan_delete->RecordCount++;
	$detailrekmedpenjualan_delete->RowCount++;

	// Set row properties
	$detailrekmedpenjualan->resetAttributes();
	$detailrekmedpenjualan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailrekmedpenjualan_delete->loadRowValues($detailrekmedpenjualan_delete->Recordset);

	// Render row
	$detailrekmedpenjualan_delete->renderRow();
?>
	<tr <?php echo $detailrekmedpenjualan->rowAttributes() ?>>
<?php if ($detailrekmedpenjualan_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailrekmedpenjualan_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedpenjualan_delete->RowCount ?>_detailrekmedpenjualan_id_barang" class="detailrekmedpenjualan_id_barang">
<span<?php echo $detailrekmedpenjualan_delete->id_barang->viewAttributes() ?>><?php echo $detailrekmedpenjualan_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailrekmedpenjualan_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailrekmedpenjualan_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedpenjualan_delete->RowCount ?>_detailrekmedpenjualan_jumlah" class="detailrekmedpenjualan_jumlah">
<span<?php echo $detailrekmedpenjualan_delete->jumlah->viewAttributes() ?>><?php echo $detailrekmedpenjualan_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailrekmedpenjualan_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailrekmedpenjualan_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedpenjualan_delete->RowCount ?>_detailrekmedpenjualan_id_satuan" class="detailrekmedpenjualan_id_satuan">
<span<?php echo $detailrekmedpenjualan_delete->id_satuan->viewAttributes() ?>><?php echo $detailrekmedpenjualan_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailrekmedpenjualan_delete->Recordset->moveNext();
}
$detailrekmedpenjualan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmedpenjualan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailrekmedpenjualan_delete->showPageFooter();
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
$detailrekmedpenjualan_delete->terminate();
?>