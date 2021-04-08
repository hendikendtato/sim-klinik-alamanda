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
$transaksi_komisi_view = new transaksi_komisi_view();

// Run the page
$transaksi_komisi_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaksi_komisi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$transaksi_komisi_view->isExport()) { ?>
<script>
var ftransaksi_komisiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftransaksi_komisiview = currentForm = new ew.Form("ftransaksi_komisiview", "view");
	loadjs.done("ftransaksi_komisiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$transaksi_komisi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $transaksi_komisi_view->ExportOptions->render("body") ?>
<?php $transaksi_komisi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $transaksi_komisi_view->showPageHeader(); ?>
<?php
$transaksi_komisi_view->showMessage();
?>
<form name="ftransaksi_komisiview" id="ftransaksi_komisiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaksi_komisi">
<input type="hidden" name="modal" value="<?php echo (int)$transaksi_komisi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($transaksi_komisi_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_id_pegawai"><?php echo $transaksi_komisi_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $transaksi_komisi_view->id_pegawai->cellAttributes() ?>>
<span id="el_transaksi_komisi_id_pegawai">
<span<?php echo $transaksi_komisi_view->id_pegawai->viewAttributes() ?>><?php echo $transaksi_komisi_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->id_jabatan->Visible) { // id_jabatan ?>
	<tr id="r_id_jabatan">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_id_jabatan"><?php echo $transaksi_komisi_view->id_jabatan->caption() ?></span></td>
		<td data-name="id_jabatan" <?php echo $transaksi_komisi_view->id_jabatan->cellAttributes() ?>>
<span id="el_transaksi_komisi_id_jabatan">
<span<?php echo $transaksi_komisi_view->id_jabatan->viewAttributes() ?>><?php echo $transaksi_komisi_view->id_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->kode_penjualan->Visible) { // kode_penjualan ?>
	<tr id="r_kode_penjualan">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_kode_penjualan"><?php echo $transaksi_komisi_view->kode_penjualan->caption() ?></span></td>
		<td data-name="kode_penjualan" <?php echo $transaksi_komisi_view->kode_penjualan->cellAttributes() ?>>
<span id="el_transaksi_komisi_kode_penjualan">
<span<?php echo $transaksi_komisi_view->kode_penjualan->viewAttributes() ?>><?php echo $transaksi_komisi_view->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_tgl"><?php echo $transaksi_komisi_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $transaksi_komisi_view->tgl->cellAttributes() ?>>
<span id="el_transaksi_komisi_tgl">
<span<?php echo $transaksi_komisi_view->tgl->viewAttributes() ?>><?php echo $transaksi_komisi_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_id_barang"><?php echo $transaksi_komisi_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $transaksi_komisi_view->id_barang->cellAttributes() ?>>
<span id="el_transaksi_komisi_id_barang">
<span<?php echo $transaksi_komisi_view->id_barang->viewAttributes() ?>><?php echo $transaksi_komisi_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_qty"><?php echo $transaksi_komisi_view->qty->caption() ?></span></td>
		<td data-name="qty" <?php echo $transaksi_komisi_view->qty->cellAttributes() ?>>
<span id="el_transaksi_komisi_qty">
<span<?php echo $transaksi_komisi_view->qty->viewAttributes() ?>><?php echo $transaksi_komisi_view->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->subtotal->Visible) { // subtotal ?>
	<tr id="r_subtotal">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_subtotal"><?php echo $transaksi_komisi_view->subtotal->caption() ?></span></td>
		<td data-name="subtotal" <?php echo $transaksi_komisi_view->subtotal->cellAttributes() ?>>
<span id="el_transaksi_komisi_subtotal">
<span<?php echo $transaksi_komisi_view->subtotal->viewAttributes() ?>><?php echo $transaksi_komisi_view->subtotal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->jenis_komisi->Visible) { // jenis_komisi ?>
	<tr id="r_jenis_komisi">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_jenis_komisi"><?php echo $transaksi_komisi_view->jenis_komisi->caption() ?></span></td>
		<td data-name="jenis_komisi" <?php echo $transaksi_komisi_view->jenis_komisi->cellAttributes() ?>>
<span id="el_transaksi_komisi_jenis_komisi">
<span<?php echo $transaksi_komisi_view->jenis_komisi->viewAttributes() ?>><?php echo $transaksi_komisi_view->jenis_komisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->komisi->Visible) { // komisi ?>
	<tr id="r_komisi">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_komisi"><?php echo $transaksi_komisi_view->komisi->caption() ?></span></td>
		<td data-name="komisi" <?php echo $transaksi_komisi_view->komisi->cellAttributes() ?>>
<span id="el_transaksi_komisi_komisi">
<span<?php echo $transaksi_komisi_view->komisi->viewAttributes() ?>><?php echo $transaksi_komisi_view->komisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($transaksi_komisi_view->total_komisi->Visible) { // total_komisi ?>
	<tr id="r_total_komisi">
		<td class="<?php echo $transaksi_komisi_view->TableLeftColumnClass ?>"><span id="elh_transaksi_komisi_total_komisi"><?php echo $transaksi_komisi_view->total_komisi->caption() ?></span></td>
		<td data-name="total_komisi" <?php echo $transaksi_komisi_view->total_komisi->cellAttributes() ?>>
<span id="el_transaksi_komisi_total_komisi">
<span<?php echo $transaksi_komisi_view->total_komisi->viewAttributes() ?>><?php echo $transaksi_komisi_view->total_komisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$transaksi_komisi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$transaksi_komisi_view->isExport()) { ?>
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
$transaksi_komisi_view->terminate();
?>