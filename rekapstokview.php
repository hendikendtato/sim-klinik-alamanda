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
$rekapstok_view = new rekapstok_view();

// Run the page
$rekapstok_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekapstok_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekapstok_view->isExport()) { ?>
<script>
var frekapstokview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frekapstokview = currentForm = new ew.Form("frekapstokview", "view");
	loadjs.done("frekapstokview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rekapstok_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rekapstok_view->ExportOptions->render("body") ?>
<?php $rekapstok_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rekapstok_view->showPageHeader(); ?>
<?php
$rekapstok_view->showMessage();
?>
<form name="frekapstokview" id="frekapstokview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekapstok">
<input type="hidden" name="modal" value="<?php echo (int)$rekapstok_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($rekapstok_view->id_rekapstok->Visible) { // id_rekapstok ?>
	<tr id="r_id_rekapstok">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_id_rekapstok"><?php echo $rekapstok_view->id_rekapstok->caption() ?></span></td>
		<td data-name="id_rekapstok" <?php echo $rekapstok_view->id_rekapstok->cellAttributes() ?>>
<span id="el_rekapstok_id_rekapstok">
<span<?php echo $rekapstok_view->id_rekapstok->viewAttributes() ?>><?php echo $rekapstok_view->id_rekapstok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_id_barang"><?php echo $rekapstok_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $rekapstok_view->id_barang->cellAttributes() ?>>
<span id="el_rekapstok_id_barang">
<span<?php echo $rekapstok_view->id_barang->viewAttributes() ?>><?php echo $rekapstok_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_tanggal"><?php echo $rekapstok_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $rekapstok_view->tanggal->cellAttributes() ?>>
<span id="el_rekapstok_tanggal">
<span<?php echo $rekapstok_view->tanggal->viewAttributes() ?>><?php echo $rekapstok_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
	<tr id="r_masuk_saldoawal">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_masuk_saldoawal"><?php echo $rekapstok_view->masuk_saldoawal->caption() ?></span></td>
		<td data-name="masuk_saldoawal" <?php echo $rekapstok_view->masuk_saldoawal->cellAttributes() ?>>
<span id="el_rekapstok_masuk_saldoawal">
<span<?php echo $rekapstok_view->masuk_saldoawal->viewAttributes() ?>><?php echo $rekapstok_view->masuk_saldoawal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->masuk_beli->Visible) { // masuk_beli ?>
	<tr id="r_masuk_beli">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_masuk_beli"><?php echo $rekapstok_view->masuk_beli->caption() ?></span></td>
		<td data-name="masuk_beli" <?php echo $rekapstok_view->masuk_beli->cellAttributes() ?>>
<span id="el_rekapstok_masuk_beli">
<span<?php echo $rekapstok_view->masuk_beli->viewAttributes() ?>><?php echo $rekapstok_view->masuk_beli->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<tr id="r_masuk_penyesuaian">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_masuk_penyesuaian"><?php echo $rekapstok_view->masuk_penyesuaian->caption() ?></span></td>
		<td data-name="masuk_penyesuaian" <?php echo $rekapstok_view->masuk_penyesuaian->cellAttributes() ?>>
<span id="el_rekapstok_masuk_penyesuaian">
<span<?php echo $rekapstok_view->masuk_penyesuaian->viewAttributes() ?>><?php echo $rekapstok_view->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->keluar_jual->Visible) { // keluar_jual ?>
	<tr id="r_keluar_jual">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_keluar_jual"><?php echo $rekapstok_view->keluar_jual->caption() ?></span></td>
		<td data-name="keluar_jual" <?php echo $rekapstok_view->keluar_jual->cellAttributes() ?>>
<span id="el_rekapstok_keluar_jual">
<span<?php echo $rekapstok_view->keluar_jual->viewAttributes() ?>><?php echo $rekapstok_view->keluar_jual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
	<tr id="r_keluar_perpindahan">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_keluar_perpindahan"><?php echo $rekapstok_view->keluar_perpindahan->caption() ?></span></td>
		<td data-name="keluar_perpindahan" <?php echo $rekapstok_view->keluar_perpindahan->cellAttributes() ?>>
<span id="el_rekapstok_keluar_perpindahan">
<span<?php echo $rekapstok_view->keluar_perpindahan->viewAttributes() ?>><?php echo $rekapstok_view->keluar_perpindahan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<tr id="r_keluar_penyesuaian">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_keluar_penyesuaian"><?php echo $rekapstok_view->keluar_penyesuaian->caption() ?></span></td>
		<td data-name="keluar_penyesuaian" <?php echo $rekapstok_view->keluar_penyesuaian->cellAttributes() ?>>
<span id="el_rekapstok_keluar_penyesuaian">
<span<?php echo $rekapstok_view->keluar_penyesuaian->viewAttributes() ?>><?php echo $rekapstok_view->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
	<tr id="r_keluar_pengembalian">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_keluar_pengembalian"><?php echo $rekapstok_view->keluar_pengembalian->caption() ?></span></td>
		<td data-name="keluar_pengembalian" <?php echo $rekapstok_view->keluar_pengembalian->cellAttributes() ?>>
<span id="el_rekapstok_keluar_pengembalian">
<span<?php echo $rekapstok_view->keluar_pengembalian->viewAttributes() ?>><?php echo $rekapstok_view->keluar_pengembalian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekapstok_view->stok->Visible) { // stok ?>
	<tr id="r_stok">
		<td class="<?php echo $rekapstok_view->TableLeftColumnClass ?>"><span id="elh_rekapstok_stok"><?php echo $rekapstok_view->stok->caption() ?></span></td>
		<td data-name="stok" <?php echo $rekapstok_view->stok->cellAttributes() ?>>
<span id="el_rekapstok_stok">
<span<?php echo $rekapstok_view->stok->viewAttributes() ?>><?php echo $rekapstok_view->stok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$rekapstok_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekapstok_view->isExport()) { ?>
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
$rekapstok_view->terminate();
?>