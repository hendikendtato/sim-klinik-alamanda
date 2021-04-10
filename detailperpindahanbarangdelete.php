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
$detailperpindahanbarang_delete = new detailperpindahanbarang_delete();

// Run the page
$detailperpindahanbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailperpindahanbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailperpindahanbarangdelete = currentForm = new ew.Form("fdetailperpindahanbarangdelete", "delete");
	loadjs.done("fdetailperpindahanbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailperpindahanbarang_delete->showPageHeader(); ?>
<?php
$detailperpindahanbarang_delete->showMessage();
?>
<form name="fdetailperpindahanbarangdelete" id="fdetailperpindahanbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailperpindahanbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailperpindahanbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailperpindahanbarang_delete->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
		<th class="<?php echo $detailperpindahanbarang_delete->id_detailperpindahanbarang->headerCellClass() ?>"><span id="elh_detailperpindahanbarang_id_detailperpindahanbarang" class="detailperpindahanbarang_id_detailperpindahanbarang"><?php echo $detailperpindahanbarang_delete->id_detailperpindahanbarang->caption() ?></span></th>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<th class="<?php echo $detailperpindahanbarang_delete->id_perpindahanbarang->headerCellClass() ?>"><span id="elh_detailperpindahanbarang_id_perpindahanbarang" class="detailperpindahanbarang_id_perpindahanbarang"><?php echo $detailperpindahanbarang_delete->id_perpindahanbarang->caption() ?></span></th>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailperpindahanbarang_delete->id_barang->headerCellClass() ?>"><span id="elh_detailperpindahanbarang_id_barang" class="detailperpindahanbarang_id_barang"><?php echo $detailperpindahanbarang_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailperpindahanbarang_delete->jumlah->headerCellClass() ?>"><span id="elh_detailperpindahanbarang_jumlah" class="detailperpindahanbarang_jumlah"><?php echo $detailperpindahanbarang_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailperpindahanbarang_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailperpindahanbarang_id_satuan" class="detailperpindahanbarang_id_satuan"><?php echo $detailperpindahanbarang_delete->id_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailperpindahanbarang_delete->RecordCount = 0;
$i = 0;
while (!$detailperpindahanbarang_delete->Recordset->EOF) {
	$detailperpindahanbarang_delete->RecordCount++;
	$detailperpindahanbarang_delete->RowCount++;

	// Set row properties
	$detailperpindahanbarang->resetAttributes();
	$detailperpindahanbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailperpindahanbarang_delete->loadRowValues($detailperpindahanbarang_delete->Recordset);

	// Render row
	$detailperpindahanbarang_delete->renderRow();
?>
	<tr <?php echo $detailperpindahanbarang->rowAttributes() ?>>
<?php if ($detailperpindahanbarang_delete->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
		<td <?php echo $detailperpindahanbarang_delete->id_detailperpindahanbarang->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_delete->RowCount ?>_detailperpindahanbarang_id_detailperpindahanbarang" class="detailperpindahanbarang_id_detailperpindahanbarang">
<span<?php echo $detailperpindahanbarang_delete->id_detailperpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_delete->id_detailperpindahanbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<td <?php echo $detailperpindahanbarang_delete->id_perpindahanbarang->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_delete->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang" class="detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_delete->id_perpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_delete->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailperpindahanbarang_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_delete->RowCount ?>_detailperpindahanbarang_id_barang" class="detailperpindahanbarang_id_barang">
<span<?php echo $detailperpindahanbarang_delete->id_barang->viewAttributes() ?>><?php echo $detailperpindahanbarang_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailperpindahanbarang_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_delete->RowCount ?>_detailperpindahanbarang_jumlah" class="detailperpindahanbarang_jumlah">
<span<?php echo $detailperpindahanbarang_delete->jumlah->viewAttributes() ?>><?php echo $detailperpindahanbarang_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailperpindahanbarang_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_delete->RowCount ?>_detailperpindahanbarang_id_satuan" class="detailperpindahanbarang_id_satuan">
<span<?php echo $detailperpindahanbarang_delete->id_satuan->viewAttributes() ?>><?php echo $detailperpindahanbarang_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailperpindahanbarang_delete->Recordset->moveNext();
}
$detailperpindahanbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailperpindahanbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailperpindahanbarang_delete->showPageFooter();
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
$detailperpindahanbarang_delete->terminate();
?>