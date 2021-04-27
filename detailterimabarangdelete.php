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
$detailterimabarang_delete = new detailterimabarang_delete();

// Run the page
$detailterimabarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailterimabarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailterimabarangdelete = currentForm = new ew.Form("fdetailterimabarangdelete", "delete");
	loadjs.done("fdetailterimabarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailterimabarang_delete->showPageHeader(); ?>
<?php
$detailterimabarang_delete->showMessage();
?>
<form name="fdetailterimabarangdelete" id="fdetailterimabarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimabarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailterimabarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailterimabarang_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailterimabarang_delete->id_barang->headerCellClass() ?>"><span id="elh_detailterimabarang_id_barang" class="detailterimabarang_id_barang"><?php echo $detailterimabarang_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailterimabarang_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailterimabarang_delete->jumlah->headerCellClass() ?>"><span id="elh_detailterimabarang_jumlah" class="detailterimabarang_jumlah"><?php echo $detailterimabarang_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailterimabarang_delete->satuan->Visible) { // satuan ?>
		<th class="<?php echo $detailterimabarang_delete->satuan->headerCellClass() ?>"><span id="elh_detailterimabarang_satuan" class="detailterimabarang_satuan"><?php echo $detailterimabarang_delete->satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailterimabarang_delete->RecordCount = 0;
$i = 0;
while (!$detailterimabarang_delete->Recordset->EOF) {
	$detailterimabarang_delete->RecordCount++;
	$detailterimabarang_delete->RowCount++;

	// Set row properties
	$detailterimabarang->resetAttributes();
	$detailterimabarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailterimabarang_delete->loadRowValues($detailterimabarang_delete->Recordset);

	// Render row
	$detailterimabarang_delete->renderRow();
?>
	<tr <?php echo $detailterimabarang->rowAttributes() ?>>
<?php if ($detailterimabarang_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailterimabarang_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailterimabarang_delete->RowCount ?>_detailterimabarang_id_barang" class="detailterimabarang_id_barang">
<span<?php echo $detailterimabarang_delete->id_barang->viewAttributes() ?>><?php echo $detailterimabarang_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailterimabarang_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailterimabarang_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailterimabarang_delete->RowCount ?>_detailterimabarang_jumlah" class="detailterimabarang_jumlah">
<span<?php echo $detailterimabarang_delete->jumlah->viewAttributes() ?>><?php echo $detailterimabarang_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailterimabarang_delete->satuan->Visible) { // satuan ?>
		<td <?php echo $detailterimabarang_delete->satuan->cellAttributes() ?>>
<span id="el<?php echo $detailterimabarang_delete->RowCount ?>_detailterimabarang_satuan" class="detailterimabarang_satuan">
<span<?php echo $detailterimabarang_delete->satuan->viewAttributes() ?>><?php echo $detailterimabarang_delete->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailterimabarang_delete->Recordset->moveNext();
}
$detailterimabarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailterimabarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailterimabarang_delete->showPageFooter();
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
$detailterimabarang_delete->terminate();
?>