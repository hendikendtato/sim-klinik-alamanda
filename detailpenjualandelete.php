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
$detailpenjualan_delete = new detailpenjualan_delete();

// Run the page
$detailpenjualan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenjualan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpenjualandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailpenjualandelete = currentForm = new ew.Form("fdetailpenjualandelete", "delete");
	loadjs.done("fdetailpenjualandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpenjualan_delete->showPageHeader(); ?>
<?php
$detailpenjualan_delete->showMessage();
?>
<form name="fdetailpenjualandelete" id="fdetailpenjualandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenjualan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailpenjualan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailpenjualan_delete->id_penjualan->Visible) { // id_penjualan ?>
		<th class="<?php echo $detailpenjualan_delete->id_penjualan->headerCellClass() ?>"><span id="elh_detailpenjualan_id_penjualan" class="detailpenjualan_id_penjualan"><?php echo $detailpenjualan_delete->id_penjualan->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $detailpenjualan_delete->id_barang->headerCellClass() ?>"><span id="elh_detailpenjualan_id_barang" class="detailpenjualan_id_barang"><?php echo $detailpenjualan_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->kode_barang->Visible) { // kode_barang ?>
		<th class="<?php echo $detailpenjualan_delete->kode_barang->headerCellClass() ?>"><span id="elh_detailpenjualan_kode_barang" class="detailpenjualan_kode_barang"><?php echo $detailpenjualan_delete->kode_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->nama_barang->Visible) { // nama_barang ?>
		<th class="<?php echo $detailpenjualan_delete->nama_barang->headerCellClass() ?>"><span id="elh_detailpenjualan_nama_barang" class="detailpenjualan_nama_barang"><?php echo $detailpenjualan_delete->nama_barang->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->harga_jual->Visible) { // harga_jual ?>
		<th class="<?php echo $detailpenjualan_delete->harga_jual->headerCellClass() ?>"><span id="elh_detailpenjualan_harga_jual" class="detailpenjualan_harga_jual"><?php echo $detailpenjualan_delete->harga_jual->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->stok->Visible) { // stok ?>
		<th class="<?php echo $detailpenjualan_delete->stok->headerCellClass() ?>"><span id="elh_detailpenjualan_stok" class="detailpenjualan_stok"><?php echo $detailpenjualan_delete->stok->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->qty->Visible) { // qty ?>
		<th class="<?php echo $detailpenjualan_delete->qty->headerCellClass() ?>"><span id="elh_detailpenjualan_qty" class="detailpenjualan_qty"><?php echo $detailpenjualan_delete->qty->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->disc_pr->Visible) { // disc_pr ?>
		<th class="<?php echo $detailpenjualan_delete->disc_pr->headerCellClass() ?>"><span id="elh_detailpenjualan_disc_pr" class="detailpenjualan_disc_pr"><?php echo $detailpenjualan_delete->disc_pr->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->disc_rp->Visible) { // disc_rp ?>
		<th class="<?php echo $detailpenjualan_delete->disc_rp->headerCellClass() ?>"><span id="elh_detailpenjualan_disc_rp" class="detailpenjualan_disc_rp"><?php echo $detailpenjualan_delete->disc_rp->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->komisi_recall->Visible) { // komisi_recall ?>
		<th class="<?php echo $detailpenjualan_delete->komisi_recall->headerCellClass() ?>"><span id="elh_detailpenjualan_komisi_recall" class="detailpenjualan_komisi_recall"><?php echo $detailpenjualan_delete->komisi_recall->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenjualan_delete->subtotal->Visible) { // subtotal ?>
		<th class="<?php echo $detailpenjualan_delete->subtotal->headerCellClass() ?>"><span id="elh_detailpenjualan_subtotal" class="detailpenjualan_subtotal"><?php echo $detailpenjualan_delete->subtotal->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailpenjualan_delete->RecordCount = 0;
$i = 0;
while (!$detailpenjualan_delete->Recordset->EOF) {
	$detailpenjualan_delete->RecordCount++;
	$detailpenjualan_delete->RowCount++;

	// Set row properties
	$detailpenjualan->resetAttributes();
	$detailpenjualan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailpenjualan_delete->loadRowValues($detailpenjualan_delete->Recordset);

	// Render row
	$detailpenjualan_delete->renderRow();
?>
	<tr <?php echo $detailpenjualan->rowAttributes() ?>>
<?php if ($detailpenjualan_delete->id_penjualan->Visible) { // id_penjualan ?>
		<td <?php echo $detailpenjualan_delete->id_penjualan->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_id_penjualan" class="detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_delete->id_penjualan->viewAttributes() ?>><?php echo $detailpenjualan_delete->id_penjualan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $detailpenjualan_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_id_barang" class="detailpenjualan_id_barang">
<span<?php echo $detailpenjualan_delete->id_barang->viewAttributes() ?>><?php echo $detailpenjualan_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->kode_barang->Visible) { // kode_barang ?>
		<td <?php echo $detailpenjualan_delete->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_kode_barang" class="detailpenjualan_kode_barang">
<span<?php echo $detailpenjualan_delete->kode_barang->viewAttributes() ?>><?php echo $detailpenjualan_delete->kode_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->nama_barang->Visible) { // nama_barang ?>
		<td <?php echo $detailpenjualan_delete->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_nama_barang" class="detailpenjualan_nama_barang">
<span<?php echo $detailpenjualan_delete->nama_barang->viewAttributes() ?>><?php echo $detailpenjualan_delete->nama_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->harga_jual->Visible) { // harga_jual ?>
		<td <?php echo $detailpenjualan_delete->harga_jual->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_harga_jual" class="detailpenjualan_harga_jual">
<span<?php echo $detailpenjualan_delete->harga_jual->viewAttributes() ?>><?php echo $detailpenjualan_delete->harga_jual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->stok->Visible) { // stok ?>
		<td <?php echo $detailpenjualan_delete->stok->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_stok" class="detailpenjualan_stok">
<span<?php echo $detailpenjualan_delete->stok->viewAttributes() ?>><?php echo $detailpenjualan_delete->stok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->qty->Visible) { // qty ?>
		<td <?php echo $detailpenjualan_delete->qty->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_qty" class="detailpenjualan_qty">
<span<?php echo $detailpenjualan_delete->qty->viewAttributes() ?>><?php echo $detailpenjualan_delete->qty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->disc_pr->Visible) { // disc_pr ?>
		<td <?php echo $detailpenjualan_delete->disc_pr->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_disc_pr" class="detailpenjualan_disc_pr">
<span<?php echo $detailpenjualan_delete->disc_pr->viewAttributes() ?>><?php echo $detailpenjualan_delete->disc_pr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->disc_rp->Visible) { // disc_rp ?>
		<td <?php echo $detailpenjualan_delete->disc_rp->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_disc_rp" class="detailpenjualan_disc_rp">
<span<?php echo $detailpenjualan_delete->disc_rp->viewAttributes() ?>><?php echo $detailpenjualan_delete->disc_rp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->komisi_recall->Visible) { // komisi_recall ?>
		<td <?php echo $detailpenjualan_delete->komisi_recall->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_komisi_recall" class="detailpenjualan_komisi_recall">
<span<?php echo $detailpenjualan_delete->komisi_recall->viewAttributes() ?>><?php echo $detailpenjualan_delete->komisi_recall->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenjualan_delete->subtotal->Visible) { // subtotal ?>
		<td <?php echo $detailpenjualan_delete->subtotal->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_delete->RowCount ?>_detailpenjualan_subtotal" class="detailpenjualan_subtotal">
<span<?php echo $detailpenjualan_delete->subtotal->viewAttributes() ?>><?php echo $detailpenjualan_delete->subtotal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailpenjualan_delete->Recordset->moveNext();
}
$detailpenjualan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpenjualan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailpenjualan_delete->showPageFooter();
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
$detailpenjualan_delete->terminate();
?>