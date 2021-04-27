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
$kartustok_delete = new kartustok_delete();

// Run the page
$kartustok_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkartustokdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkartustokdelete = currentForm = new ew.Form("fkartustokdelete", "delete");
	loadjs.done("fkartustokdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kartustok_delete->showPageHeader(); ?>
<?php
$kartustok_delete->showMessage();
?>
<form name="fkartustokdelete" id="fkartustokdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartustok">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kartustok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kartustok_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $kartustok_delete->id_barang->headerCellClass() ?>"><span id="elh_kartustok_id_barang" class="kartustok_id_barang"><?php echo $kartustok_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $kartustok_delete->id_klinik->headerCellClass() ?>"><span id="elh_kartustok_id_klinik" class="kartustok_id_klinik"><?php echo $kartustok_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $kartustok_delete->tanggal->headerCellClass() ?>"><span id="elh_kartustok_tanggal" class="kartustok_tanggal"><?php echo $kartustok_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_terimabarang->Visible) { // id_terimabarang ?>
		<th class="<?php echo $kartustok_delete->id_terimabarang->headerCellClass() ?>"><span id="elh_kartustok_id_terimabarang" class="kartustok_id_terimabarang"><?php echo $kartustok_delete->id_terimabarang->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_terimagudang->Visible) { // id_terimagudang ?>
		<th class="<?php echo $kartustok_delete->id_terimagudang->headerCellClass() ?>"><span id="elh_kartustok_id_terimagudang" class="kartustok_id_terimagudang"><?php echo $kartustok_delete->id_terimagudang->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_penjualan->Visible) { // id_penjualan ?>
		<th class="<?php echo $kartustok_delete->id_penjualan->headerCellClass() ?>"><span id="elh_kartustok_id_penjualan" class="kartustok_id_penjualan"><?php echo $kartustok_delete->id_penjualan->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<th class="<?php echo $kartustok_delete->id_kirimbarang->headerCellClass() ?>"><span id="elh_kartustok_id_kirimbarang" class="kartustok_id_kirimbarang"><?php echo $kartustok_delete->id_kirimbarang->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_retur->Visible) { // id_retur ?>
		<th class="<?php echo $kartustok_delete->id_retur->headerCellClass() ?>"><span id="elh_kartustok_id_retur" class="kartustok_id_retur"><?php echo $kartustok_delete->id_retur->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->id_penyesuaian->Visible) { // id_penyesuaian ?>
		<th class="<?php echo $kartustok_delete->id_penyesuaian->headerCellClass() ?>"><span id="elh_kartustok_id_penyesuaian" class="kartustok_id_penyesuaian"><?php echo $kartustok_delete->id_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->stok_awal->Visible) { // stok_awal ?>
		<th class="<?php echo $kartustok_delete->stok_awal->headerCellClass() ?>"><span id="elh_kartustok_stok_awal" class="kartustok_stok_awal"><?php echo $kartustok_delete->stok_awal->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->masuk->Visible) { // masuk ?>
		<th class="<?php echo $kartustok_delete->masuk->headerCellClass() ?>"><span id="elh_kartustok_masuk" class="kartustok_masuk"><?php echo $kartustok_delete->masuk->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<th class="<?php echo $kartustok_delete->masuk_penyesuaian->headerCellClass() ?>"><span id="elh_kartustok_masuk_penyesuaian" class="kartustok_masuk_penyesuaian"><?php echo $kartustok_delete->masuk_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->keluar->Visible) { // keluar ?>
		<th class="<?php echo $kartustok_delete->keluar->headerCellClass() ?>"><span id="elh_kartustok_keluar" class="kartustok_keluar"><?php echo $kartustok_delete->keluar->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->keluar_nonjual->Visible) { // keluar_nonjual ?>
		<th class="<?php echo $kartustok_delete->keluar_nonjual->headerCellClass() ?>"><span id="elh_kartustok_keluar_nonjual" class="kartustok_keluar_nonjual"><?php echo $kartustok_delete->keluar_nonjual->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<th class="<?php echo $kartustok_delete->keluar_penyesuaian->headerCellClass() ?>"><span id="elh_kartustok_keluar_penyesuaian" class="kartustok_keluar_penyesuaian"><?php echo $kartustok_delete->keluar_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->keluar_kirim->Visible) { // keluar_kirim ?>
		<th class="<?php echo $kartustok_delete->keluar_kirim->headerCellClass() ?>"><span id="elh_kartustok_keluar_kirim" class="kartustok_keluar_kirim"><?php echo $kartustok_delete->keluar_kirim->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->retur->Visible) { // retur ?>
		<th class="<?php echo $kartustok_delete->retur->headerCellClass() ?>"><span id="elh_kartustok_retur" class="kartustok_retur"><?php echo $kartustok_delete->retur->caption() ?></span></th>
<?php } ?>
<?php if ($kartustok_delete->stok_akhir->Visible) { // stok_akhir ?>
		<th class="<?php echo $kartustok_delete->stok_akhir->headerCellClass() ?>"><span id="elh_kartustok_stok_akhir" class="kartustok_stok_akhir"><?php echo $kartustok_delete->stok_akhir->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kartustok_delete->RecordCount = 0;
$i = 0;
while (!$kartustok_delete->Recordset->EOF) {
	$kartustok_delete->RecordCount++;
	$kartustok_delete->RowCount++;

	// Set row properties
	$kartustok->resetAttributes();
	$kartustok->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kartustok_delete->loadRowValues($kartustok_delete->Recordset);

	// Render row
	$kartustok_delete->renderRow();
?>
	<tr <?php echo $kartustok->rowAttributes() ?>>
<?php if ($kartustok_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $kartustok_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_barang" class="kartustok_id_barang">
<span<?php echo $kartustok_delete->id_barang->viewAttributes() ?>><?php echo $kartustok_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $kartustok_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_klinik" class="kartustok_id_klinik">
<span<?php echo $kartustok_delete->id_klinik->viewAttributes() ?>><?php echo $kartustok_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $kartustok_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_tanggal" class="kartustok_tanggal">
<span<?php echo $kartustok_delete->tanggal->viewAttributes() ?>><?php echo $kartustok_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_terimabarang->Visible) { // id_terimabarang ?>
		<td <?php echo $kartustok_delete->id_terimabarang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_terimabarang" class="kartustok_id_terimabarang">
<span<?php echo $kartustok_delete->id_terimabarang->viewAttributes() ?>><?php echo $kartustok_delete->id_terimabarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_terimagudang->Visible) { // id_terimagudang ?>
		<td <?php echo $kartustok_delete->id_terimagudang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_terimagudang" class="kartustok_id_terimagudang">
<span<?php echo $kartustok_delete->id_terimagudang->viewAttributes() ?>><?php echo $kartustok_delete->id_terimagudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_penjualan->Visible) { // id_penjualan ?>
		<td <?php echo $kartustok_delete->id_penjualan->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_penjualan" class="kartustok_id_penjualan">
<span<?php echo $kartustok_delete->id_penjualan->viewAttributes() ?>><?php echo $kartustok_delete->id_penjualan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td <?php echo $kartustok_delete->id_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_kirimbarang" class="kartustok_id_kirimbarang">
<span<?php echo $kartustok_delete->id_kirimbarang->viewAttributes() ?>><?php echo $kartustok_delete->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_retur->Visible) { // id_retur ?>
		<td <?php echo $kartustok_delete->id_retur->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_retur" class="kartustok_id_retur">
<span<?php echo $kartustok_delete->id_retur->viewAttributes() ?>><?php echo $kartustok_delete->id_retur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->id_penyesuaian->Visible) { // id_penyesuaian ?>
		<td <?php echo $kartustok_delete->id_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_id_penyesuaian" class="kartustok_id_penyesuaian">
<span<?php echo $kartustok_delete->id_penyesuaian->viewAttributes() ?>><?php echo $kartustok_delete->id_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->stok_awal->Visible) { // stok_awal ?>
		<td <?php echo $kartustok_delete->stok_awal->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_stok_awal" class="kartustok_stok_awal">
<span<?php echo $kartustok_delete->stok_awal->viewAttributes() ?>><?php echo $kartustok_delete->stok_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->masuk->Visible) { // masuk ?>
		<td <?php echo $kartustok_delete->masuk->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_masuk" class="kartustok_masuk">
<span<?php echo $kartustok_delete->masuk->viewAttributes() ?>><?php echo $kartustok_delete->masuk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td <?php echo $kartustok_delete->masuk_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_masuk_penyesuaian" class="kartustok_masuk_penyesuaian">
<span<?php echo $kartustok_delete->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartustok_delete->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->keluar->Visible) { // keluar ?>
		<td <?php echo $kartustok_delete->keluar->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_keluar" class="kartustok_keluar">
<span<?php echo $kartustok_delete->keluar->viewAttributes() ?>><?php echo $kartustok_delete->keluar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->keluar_nonjual->Visible) { // keluar_nonjual ?>
		<td <?php echo $kartustok_delete->keluar_nonjual->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_keluar_nonjual" class="kartustok_keluar_nonjual">
<span<?php echo $kartustok_delete->keluar_nonjual->viewAttributes() ?>><?php echo $kartustok_delete->keluar_nonjual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td <?php echo $kartustok_delete->keluar_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_keluar_penyesuaian" class="kartustok_keluar_penyesuaian">
<span<?php echo $kartustok_delete->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartustok_delete->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->keluar_kirim->Visible) { // keluar_kirim ?>
		<td <?php echo $kartustok_delete->keluar_kirim->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_keluar_kirim" class="kartustok_keluar_kirim">
<span<?php echo $kartustok_delete->keluar_kirim->viewAttributes() ?>><?php echo $kartustok_delete->keluar_kirim->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->retur->Visible) { // retur ?>
		<td <?php echo $kartustok_delete->retur->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_retur" class="kartustok_retur">
<span<?php echo $kartustok_delete->retur->viewAttributes() ?>><?php echo $kartustok_delete->retur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartustok_delete->stok_akhir->Visible) { // stok_akhir ?>
		<td <?php echo $kartustok_delete->stok_akhir->cellAttributes() ?>>
<span id="el<?php echo $kartustok_delete->RowCount ?>_kartustok_stok_akhir" class="kartustok_stok_akhir">
<span<?php echo $kartustok_delete->stok_akhir->viewAttributes() ?>><?php echo $kartustok_delete->stok_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kartustok_delete->Recordset->moveNext();
}
$kartustok_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kartustok_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kartustok_delete->showPageFooter();
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
$kartustok_delete->terminate();
?>