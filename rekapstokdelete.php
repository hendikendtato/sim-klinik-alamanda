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
$rekapstok_delete = new rekapstok_delete();

// Run the page
$rekapstok_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekapstok_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frekapstokdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frekapstokdelete = currentForm = new ew.Form("frekapstokdelete", "delete");
	loadjs.done("frekapstokdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rekapstok_delete->showPageHeader(); ?>
<?php
$rekapstok_delete->showMessage();
?>
<form name="frekapstokdelete" id="frekapstokdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekapstok">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($rekapstok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($rekapstok_delete->id_rekapstok->Visible) { // id_rekapstok ?>
		<th class="<?php echo $rekapstok_delete->id_rekapstok->headerCellClass() ?>"><span id="elh_rekapstok_id_rekapstok" class="rekapstok_id_rekapstok"><?php echo $rekapstok_delete->id_rekapstok->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $rekapstok_delete->id_barang->headerCellClass() ?>"><span id="elh_rekapstok_id_barang" class="rekapstok_id_barang"><?php echo $rekapstok_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $rekapstok_delete->tanggal->headerCellClass() ?>"><span id="elh_rekapstok_tanggal" class="rekapstok_tanggal"><?php echo $rekapstok_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
		<th class="<?php echo $rekapstok_delete->masuk_saldoawal->headerCellClass() ?>"><span id="elh_rekapstok_masuk_saldoawal" class="rekapstok_masuk_saldoawal"><?php echo $rekapstok_delete->masuk_saldoawal->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->masuk_beli->Visible) { // masuk_beli ?>
		<th class="<?php echo $rekapstok_delete->masuk_beli->headerCellClass() ?>"><span id="elh_rekapstok_masuk_beli" class="rekapstok_masuk_beli"><?php echo $rekapstok_delete->masuk_beli->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<th class="<?php echo $rekapstok_delete->masuk_penyesuaian->headerCellClass() ?>"><span id="elh_rekapstok_masuk_penyesuaian" class="rekapstok_masuk_penyesuaian"><?php echo $rekapstok_delete->masuk_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->keluar_jual->Visible) { // keluar_jual ?>
		<th class="<?php echo $rekapstok_delete->keluar_jual->headerCellClass() ?>"><span id="elh_rekapstok_keluar_jual" class="rekapstok_keluar_jual"><?php echo $rekapstok_delete->keluar_jual->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
		<th class="<?php echo $rekapstok_delete->keluar_perpindahan->headerCellClass() ?>"><span id="elh_rekapstok_keluar_perpindahan" class="rekapstok_keluar_perpindahan"><?php echo $rekapstok_delete->keluar_perpindahan->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<th class="<?php echo $rekapstok_delete->keluar_penyesuaian->headerCellClass() ?>"><span id="elh_rekapstok_keluar_penyesuaian" class="rekapstok_keluar_penyesuaian"><?php echo $rekapstok_delete->keluar_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
		<th class="<?php echo $rekapstok_delete->keluar_pengembalian->headerCellClass() ?>"><span id="elh_rekapstok_keluar_pengembalian" class="rekapstok_keluar_pengembalian"><?php echo $rekapstok_delete->keluar_pengembalian->caption() ?></span></th>
<?php } ?>
<?php if ($rekapstok_delete->stok->Visible) { // stok ?>
		<th class="<?php echo $rekapstok_delete->stok->headerCellClass() ?>"><span id="elh_rekapstok_stok" class="rekapstok_stok"><?php echo $rekapstok_delete->stok->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rekapstok_delete->RecordCount = 0;
$i = 0;
while (!$rekapstok_delete->Recordset->EOF) {
	$rekapstok_delete->RecordCount++;
	$rekapstok_delete->RowCount++;

	// Set row properties
	$rekapstok->resetAttributes();
	$rekapstok->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$rekapstok_delete->loadRowValues($rekapstok_delete->Recordset);

	// Render row
	$rekapstok_delete->renderRow();
?>
	<tr <?php echo $rekapstok->rowAttributes() ?>>
<?php if ($rekapstok_delete->id_rekapstok->Visible) { // id_rekapstok ?>
		<td <?php echo $rekapstok_delete->id_rekapstok->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_id_rekapstok" class="rekapstok_id_rekapstok">
<span<?php echo $rekapstok_delete->id_rekapstok->viewAttributes() ?>><?php echo $rekapstok_delete->id_rekapstok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $rekapstok_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_id_barang" class="rekapstok_id_barang">
<span<?php echo $rekapstok_delete->id_barang->viewAttributes() ?>><?php echo $rekapstok_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $rekapstok_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_tanggal" class="rekapstok_tanggal">
<span<?php echo $rekapstok_delete->tanggal->viewAttributes() ?>><?php echo $rekapstok_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
		<td <?php echo $rekapstok_delete->masuk_saldoawal->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_masuk_saldoawal" class="rekapstok_masuk_saldoawal">
<span<?php echo $rekapstok_delete->masuk_saldoawal->viewAttributes() ?>><?php echo $rekapstok_delete->masuk_saldoawal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->masuk_beli->Visible) { // masuk_beli ?>
		<td <?php echo $rekapstok_delete->masuk_beli->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_masuk_beli" class="rekapstok_masuk_beli">
<span<?php echo $rekapstok_delete->masuk_beli->viewAttributes() ?>><?php echo $rekapstok_delete->masuk_beli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td <?php echo $rekapstok_delete->masuk_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_masuk_penyesuaian" class="rekapstok_masuk_penyesuaian">
<span<?php echo $rekapstok_delete->masuk_penyesuaian->viewAttributes() ?>><?php echo $rekapstok_delete->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->keluar_jual->Visible) { // keluar_jual ?>
		<td <?php echo $rekapstok_delete->keluar_jual->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_keluar_jual" class="rekapstok_keluar_jual">
<span<?php echo $rekapstok_delete->keluar_jual->viewAttributes() ?>><?php echo $rekapstok_delete->keluar_jual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
		<td <?php echo $rekapstok_delete->keluar_perpindahan->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_keluar_perpindahan" class="rekapstok_keluar_perpindahan">
<span<?php echo $rekapstok_delete->keluar_perpindahan->viewAttributes() ?>><?php echo $rekapstok_delete->keluar_perpindahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td <?php echo $rekapstok_delete->keluar_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_keluar_penyesuaian" class="rekapstok_keluar_penyesuaian">
<span<?php echo $rekapstok_delete->keluar_penyesuaian->viewAttributes() ?>><?php echo $rekapstok_delete->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
		<td <?php echo $rekapstok_delete->keluar_pengembalian->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_keluar_pengembalian" class="rekapstok_keluar_pengembalian">
<span<?php echo $rekapstok_delete->keluar_pengembalian->viewAttributes() ?>><?php echo $rekapstok_delete->keluar_pengembalian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekapstok_delete->stok->Visible) { // stok ?>
		<td <?php echo $rekapstok_delete->stok->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_delete->RowCount ?>_rekapstok_stok" class="rekapstok_stok">
<span<?php echo $rekapstok_delete->stok->viewAttributes() ?>><?php echo $rekapstok_delete->stok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rekapstok_delete->Recordset->moveNext();
}
$rekapstok_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rekapstok_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$rekapstok_delete->showPageFooter();
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
$rekapstok_delete->terminate();
?>