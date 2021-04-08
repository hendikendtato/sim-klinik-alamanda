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
$detailkomposisi_delete = new detailkomposisi_delete();

// Run the page
$detailkomposisi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailkomposisidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailkomposisidelete = currentForm = new ew.Form("fdetailkomposisidelete", "delete");
	loadjs.done("fdetailkomposisidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailkomposisi_delete->showPageHeader(); ?>
<?php
$detailkomposisi_delete->showMessage();
?>
<form name="fdetailkomposisidelete" id="fdetailkomposisidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkomposisi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailkomposisi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailkomposisi_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailkomposisi_delete->id_barang->headerCellClass() ?>"><span id="elh_detailkomposisi_id_barang" class="detailkomposisi_id_barang"><?php echo $detailkomposisi_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailkomposisi_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailkomposisi_delete->jumlah->headerCellClass() ?>"><span id="elh_detailkomposisi_jumlah" class="detailkomposisi_jumlah"><?php echo $detailkomposisi_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailkomposisi_delete->id_satuan->Visible) { // id_satuan ?>
		<th class="<?php echo $detailkomposisi_delete->id_satuan->headerCellClass() ?>"><span id="elh_detailkomposisi_id_satuan" class="detailkomposisi_id_satuan"><?php echo $detailkomposisi_delete->id_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailkomposisi_delete->RecordCount = 0;
$i = 0;
while (!$detailkomposisi_delete->Recordset->EOF) {
	$detailkomposisi_delete->RecordCount++;
	$detailkomposisi_delete->RowCount++;

	// Set row properties
	$detailkomposisi->resetAttributes();
	$detailkomposisi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailkomposisi_delete->loadRowValues($detailkomposisi_delete->Recordset);

	// Render row
	$detailkomposisi_delete->renderRow();
?>
	<tr <?php echo $detailkomposisi->rowAttributes() ?>>
<?php if ($detailkomposisi_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailkomposisi_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailkomposisi_delete->RowCount ?>_detailkomposisi_id_barang" class="detailkomposisi_id_barang">
<span<?php echo $detailkomposisi_delete->id_barang->viewAttributes() ?>><?php echo $detailkomposisi_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailkomposisi_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailkomposisi_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailkomposisi_delete->RowCount ?>_detailkomposisi_jumlah" class="detailkomposisi_jumlah">
<span<?php echo $detailkomposisi_delete->jumlah->viewAttributes() ?>><?php echo $detailkomposisi_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailkomposisi_delete->id_satuan->Visible) { // id_satuan ?>
		<td <?php echo $detailkomposisi_delete->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailkomposisi_delete->RowCount ?>_detailkomposisi_id_satuan" class="detailkomposisi_id_satuan">
<span<?php echo $detailkomposisi_delete->id_satuan->viewAttributes() ?>><?php echo $detailkomposisi_delete->id_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailkomposisi_delete->Recordset->moveNext();
}
$detailkomposisi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailkomposisi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailkomposisi_delete->showPageFooter();
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
$detailkomposisi_delete->terminate();
?>