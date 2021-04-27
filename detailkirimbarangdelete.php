<?php
namespace PHPMaker2020\sim_klinik_alamanda;

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
$detailkirimbarang_delete = new detailkirimbarang_delete();

// Run the page
$detailkirimbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkirimbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailkirimbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailkirimbarangdelete = currentForm = new ew.Form("fdetailkirimbarangdelete", "delete");
	loadjs.done("fdetailkirimbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailkirimbarang_delete->showPageHeader(); ?>
<?php
$detailkirimbarang_delete->showMessage();
?>
<form name="fdetailkirimbarangdelete" id="fdetailkirimbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkirimbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailkirimbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailkirimbarang_delete->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<th class="<?php echo $detailkirimbarang_delete->id_kirimbarang->headerCellClass() ?>"><span id="elh_detailkirimbarang_id_kirimbarang" class="detailkirimbarang_id_kirimbarang"><?php echo $detailkirimbarang_delete->id_kirimbarang->caption() ?></span></th>
<?php } ?>
<?php if ($detailkirimbarang_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailkirimbarang_delete->id_barang->headerCellClass() ?>"><span id="elh_detailkirimbarang_id_barang" class="detailkirimbarang_id_barang"><?php echo $detailkirimbarang_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailkirimbarang_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailkirimbarang_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailkirimbarang_id_satuan" class="detailkirimbarang_id_satuan"><?php echo $detailkirimbarang_delete->id_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($detailkirimbarang_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailkirimbarang_delete->jumlah->headerCellClass() ?>"><span id="elh_detailkirimbarang_jumlah" class="detailkirimbarang_jumlah"><?php echo $detailkirimbarang_delete->jumlah->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailkirimbarang_delete->RecordCount = 0;
$i = 0;
while (!$detailkirimbarang_delete->Recordset->EOF) {
	$detailkirimbarang_delete->RecordCount++;
	$detailkirimbarang_delete->RowCount++;

	// Set row properties
	$detailkirimbarang->resetAttributes();
	$detailkirimbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailkirimbarang_delete->loadRowValues($detailkirimbarang_delete->Recordset);

	// Render row
	$detailkirimbarang_delete->renderRow();
?>
	<tr <?php echo $detailkirimbarang->rowAttributes() ?>>
<?php if ($detailkirimbarang_delete->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td <?php echo $detailkirimbarang_delete->id_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_delete->RowCount ?>_detailkirimbarang_id_kirimbarang" class="detailkirimbarang_id_kirimbarang">
<span<?php echo $detailkirimbarang_delete->id_kirimbarang->viewAttributes() ?>><?php echo $detailkirimbarang_delete->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailkirimbarang_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailkirimbarang_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_delete->RowCount ?>_detailkirimbarang_id_barang" class="detailkirimbarang_id_barang">
<span<?php echo $detailkirimbarang_delete->id_barang->viewAttributes() ?>><?php echo $detailkirimbarang_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailkirimbarang_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailkirimbarang_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_delete->RowCount ?>_detailkirimbarang_id_satuan" class="detailkirimbarang_id_satuan">
<span<?php echo $detailkirimbarang_delete->id_satuan->viewAttributes() ?>><?php echo $detailkirimbarang_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailkirimbarang_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailkirimbarang_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_delete->RowCount ?>_detailkirimbarang_jumlah" class="detailkirimbarang_jumlah">
<span<?php echo $detailkirimbarang_delete->jumlah->viewAttributes() ?>><?php echo $detailkirimbarang_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailkirimbarang_delete->Recordset->moveNext();
}
$detailkirimbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailkirimbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailkirimbarang_delete->showPageFooter();
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
$detailkirimbarang_delete->terminate();
?>