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
$detailpenjualan_view = new detailpenjualan_view();

// Run the page
$detailpenjualan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenjualan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpenjualan_view->isExport()) { ?>
<script>
var fdetailpenjualanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailpenjualanview = currentForm = new ew.Form("fdetailpenjualanview", "view");
	loadjs.done("fdetailpenjualanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailpenjualan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailpenjualan_view->ExportOptions->render("body") ?>
<?php $detailpenjualan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailpenjualan_view->showPageHeader(); ?>
<?php
$detailpenjualan_view->showMessage();
?>
<form name="fdetailpenjualanview" id="fdetailpenjualanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenjualan">
<input type="hidden" name="modal" value="<?php echo (int)$detailpenjualan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailpenjualan_view->id_penjualan->Visible) { // id_penjualan ?>
	<tr id="r_id_penjualan">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_id_penjualan"><?php echo $detailpenjualan_view->id_penjualan->caption() ?></span></td>
		<td data-name="id_penjualan" <?php echo $detailpenjualan_view->id_penjualan->cellAttributes() ?>>
<span id="el_detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_view->id_penjualan->viewAttributes() ?>><?php echo $detailpenjualan_view->id_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_id_barang"><?php echo $detailpenjualan_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailpenjualan_view->id_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_id_barang">
<span<?php echo $detailpenjualan_view->id_barang->viewAttributes() ?>><?php echo $detailpenjualan_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->kode_barang->Visible) { // kode_barang ?>
	<tr id="r_kode_barang">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_kode_barang"><?php echo $detailpenjualan_view->kode_barang->caption() ?></span></td>
		<td data-name="kode_barang" <?php echo $detailpenjualan_view->kode_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_kode_barang">
<span<?php echo $detailpenjualan_view->kode_barang->viewAttributes() ?>><?php echo $detailpenjualan_view->kode_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->nama_barang->Visible) { // nama_barang ?>
	<tr id="r_nama_barang">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_nama_barang"><?php echo $detailpenjualan_view->nama_barang->caption() ?></span></td>
		<td data-name="nama_barang" <?php echo $detailpenjualan_view->nama_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_nama_barang">
<span<?php echo $detailpenjualan_view->nama_barang->viewAttributes() ?>><?php echo $detailpenjualan_view->nama_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->harga_jual->Visible) { // harga_jual ?>
	<tr id="r_harga_jual">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_harga_jual"><?php echo $detailpenjualan_view->harga_jual->caption() ?></span></td>
		<td data-name="harga_jual" <?php echo $detailpenjualan_view->harga_jual->cellAttributes() ?>>
<span id="el_detailpenjualan_harga_jual">
<span<?php echo $detailpenjualan_view->harga_jual->viewAttributes() ?>><?php echo $detailpenjualan_view->harga_jual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->stok->Visible) { // stok ?>
	<tr id="r_stok">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_stok"><?php echo $detailpenjualan_view->stok->caption() ?></span></td>
		<td data-name="stok" <?php echo $detailpenjualan_view->stok->cellAttributes() ?>>
<span id="el_detailpenjualan_stok">
<span<?php echo $detailpenjualan_view->stok->viewAttributes() ?>><?php echo $detailpenjualan_view->stok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_qty"><?php echo $detailpenjualan_view->qty->caption() ?></span></td>
		<td data-name="qty" <?php echo $detailpenjualan_view->qty->cellAttributes() ?>>
<span id="el_detailpenjualan_qty">
<span<?php echo $detailpenjualan_view->qty->viewAttributes() ?>><?php echo $detailpenjualan_view->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->disc_pr->Visible) { // disc_pr ?>
	<tr id="r_disc_pr">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_disc_pr"><?php echo $detailpenjualan_view->disc_pr->caption() ?></span></td>
		<td data-name="disc_pr" <?php echo $detailpenjualan_view->disc_pr->cellAttributes() ?>>
<span id="el_detailpenjualan_disc_pr">
<span<?php echo $detailpenjualan_view->disc_pr->viewAttributes() ?>><?php echo $detailpenjualan_view->disc_pr->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->disc_rp->Visible) { // disc_rp ?>
	<tr id="r_disc_rp">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_disc_rp"><?php echo $detailpenjualan_view->disc_rp->caption() ?></span></td>
		<td data-name="disc_rp" <?php echo $detailpenjualan_view->disc_rp->cellAttributes() ?>>
<span id="el_detailpenjualan_disc_rp">
<span<?php echo $detailpenjualan_view->disc_rp->viewAttributes() ?>><?php echo $detailpenjualan_view->disc_rp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->voucher_barang->Visible) { // voucher_barang ?>
	<tr id="r_voucher_barang">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_voucher_barang"><?php echo $detailpenjualan_view->voucher_barang->caption() ?></span></td>
		<td data-name="voucher_barang" <?php echo $detailpenjualan_view->voucher_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_voucher_barang">
<span<?php echo $detailpenjualan_view->voucher_barang->viewAttributes() ?>><?php echo $detailpenjualan_view->voucher_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->komisi_recall->Visible) { // komisi_recall ?>
	<tr id="r_komisi_recall">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_komisi_recall"><?php echo $detailpenjualan_view->komisi_recall->caption() ?></span></td>
		<td data-name="komisi_recall" <?php echo $detailpenjualan_view->komisi_recall->cellAttributes() ?>>
<span id="el_detailpenjualan_komisi_recall">
<span<?php echo $detailpenjualan_view->komisi_recall->viewAttributes() ?>><?php echo $detailpenjualan_view->komisi_recall->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenjualan_view->subtotal->Visible) { // subtotal ?>
	<tr id="r_subtotal">
		<td class="<?php echo $detailpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailpenjualan_subtotal"><?php echo $detailpenjualan_view->subtotal->caption() ?></span></td>
		<td data-name="subtotal" <?php echo $detailpenjualan_view->subtotal->cellAttributes() ?>>
<span id="el_detailpenjualan_subtotal">
<span<?php echo $detailpenjualan_view->subtotal->viewAttributes() ?>><?php echo $detailpenjualan_view->subtotal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailpenjualan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpenjualan_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$detailpenjualan_view->terminate();
?>