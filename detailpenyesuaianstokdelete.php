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
$detailpenyesuaianstok_delete = new detailpenyesuaianstok_delete();

// Run the page
$detailpenyesuaianstok_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianstok_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpenyesuaianstokdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailpenyesuaianstokdelete = currentForm = new ew.Form("fdetailpenyesuaianstokdelete", "delete");
	loadjs.done("fdetailpenyesuaianstokdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpenyesuaianstok_delete->showPageHeader(); ?>
<?php
$detailpenyesuaianstok_delete->showMessage();
?>
<form name="fdetailpenyesuaianstokdelete" id="fdetailpenyesuaianstokdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianstok">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailpenyesuaianstok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailpenyesuaianstok_delete->kode_barang->Visible) { // kode_barang ?>
		<th class="<?php echo $detailpenyesuaianstok_delete->kode_barang->headerCellClass() ?>"><span id="elh_detailpenyesuaianstok_kode_barang" class="detailpenyesuaianstok_kode_barang"><?php echo $detailpenyesuaianstok_delete->kode_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailpenyesuaianstok_delete->id_barang->headerCellClass() ?>"><span id="elh_detailpenyesuaianstok_id_barang" class="detailpenyesuaianstok_id_barang"><?php echo $detailpenyesuaianstok_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->stokdatabase->Visible) { // stokdatabase ?>
		<th class="<?php echo $detailpenyesuaianstok_delete->stokdatabase->headerCellClass() ?>"><span id="elh_detailpenyesuaianstok_stokdatabase" class="detailpenyesuaianstok_stokdatabase"><?php echo $detailpenyesuaianstok_delete->stokdatabase->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailpenyesuaianstok_delete->jumlah->headerCellClass() ?>"><span id="elh_detailpenyesuaianstok_jumlah" class="detailpenyesuaianstok_jumlah"><?php echo $detailpenyesuaianstok_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->selisih->Visible) { // selisih ?>
		<th class="<?php echo $detailpenyesuaianstok_delete->selisih->headerCellClass() ?>"><span id="elh_detailpenyesuaianstok_selisih" class="detailpenyesuaianstok_selisih"><?php echo $detailpenyesuaianstok_delete->selisih->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->tipe->Visible) { // tipe ?>
		<th class="<?php echo $detailpenyesuaianstok_delete->tipe->headerCellClass() ?>"><span id="elh_detailpenyesuaianstok_tipe" class="detailpenyesuaianstok_tipe"><?php echo $detailpenyesuaianstok_delete->tipe->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailpenyesuaianstok_delete->RecordCount = 0;
$i = 0;
while (!$detailpenyesuaianstok_delete->Recordset->EOF) {
	$detailpenyesuaianstok_delete->RecordCount++;
	$detailpenyesuaianstok_delete->RowCount++;

	// Set row properties
	$detailpenyesuaianstok->resetAttributes();
	$detailpenyesuaianstok->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailpenyesuaianstok_delete->loadRowValues($detailpenyesuaianstok_delete->Recordset);

	// Render row
	$detailpenyesuaianstok_delete->renderRow();
?>
	<tr <?php echo $detailpenyesuaianstok->rowAttributes() ?>>
<?php if ($detailpenyesuaianstok_delete->kode_barang->Visible) { // kode_barang ?>
		<td <?php echo $detailpenyesuaianstok_delete->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_delete->RowCount ?>_detailpenyesuaianstok_kode_barang" class="detailpenyesuaianstok_kode_barang">
<span<?php echo $detailpenyesuaianstok_delete->kode_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_delete->kode_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailpenyesuaianstok_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_delete->RowCount ?>_detailpenyesuaianstok_id_barang" class="detailpenyesuaianstok_id_barang">
<span<?php echo $detailpenyesuaianstok_delete->id_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->stokdatabase->Visible) { // stokdatabase ?>
		<td <?php echo $detailpenyesuaianstok_delete->stokdatabase->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_delete->RowCount ?>_detailpenyesuaianstok_stokdatabase" class="detailpenyesuaianstok_stokdatabase">
<span<?php echo $detailpenyesuaianstok_delete->stokdatabase->viewAttributes() ?>><?php echo $detailpenyesuaianstok_delete->stokdatabase->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailpenyesuaianstok_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_delete->RowCount ?>_detailpenyesuaianstok_jumlah" class="detailpenyesuaianstok_jumlah">
<span<?php echo $detailpenyesuaianstok_delete->jumlah->viewAttributes() ?>><?php echo $detailpenyesuaianstok_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->selisih->Visible) { // selisih ?>
		<td <?php echo $detailpenyesuaianstok_delete->selisih->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_delete->RowCount ?>_detailpenyesuaianstok_selisih" class="detailpenyesuaianstok_selisih">
<span<?php echo $detailpenyesuaianstok_delete->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianstok_delete->selisih->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_delete->tipe->Visible) { // tipe ?>
		<td <?php echo $detailpenyesuaianstok_delete->tipe->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_delete->RowCount ?>_detailpenyesuaianstok_tipe" class="detailpenyesuaianstok_tipe">
<span<?php echo $detailpenyesuaianstok_delete->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianstok_delete->tipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailpenyesuaianstok_delete->Recordset->moveNext();
}
$detailpenyesuaianstok_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpenyesuaianstok_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailpenyesuaianstok_delete->showPageFooter();
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
$detailpenyesuaianstok_delete->terminate();
?>