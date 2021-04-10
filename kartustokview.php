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
$kartustok_view = new kartustok_view();

// Run the page
$kartustok_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kartustok_view->isExport()) { ?>
<script>
var fkartustokview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkartustokview = currentForm = new ew.Form("fkartustokview", "view");
	loadjs.done("fkartustokview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kartustok_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kartustok_view->ExportOptions->render("body") ?>
<?php $kartustok_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kartustok_view->showPageHeader(); ?>
<?php
$kartustok_view->showMessage();
?>
<form name="fkartustokview" id="fkartustokview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartustok">
<input type="hidden" name="modal" value="<?php echo (int)$kartustok_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kartustok_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_klinik"><?php echo $kartustok_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $kartustok_view->id_klinik->cellAttributes() ?>>
<span id="el_kartustok_id_klinik">
<span<?php echo $kartustok_view->id_klinik->viewAttributes() ?>><?php echo $kartustok_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_tanggal"><?php echo $kartustok_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $kartustok_view->tanggal->cellAttributes() ?>>
<span id="el_kartustok_tanggal">
<span<?php echo $kartustok_view->tanggal->viewAttributes() ?>><?php echo $kartustok_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->id_terimabarang->Visible) { // id_terimabarang ?>
	<tr id="r_id_terimabarang">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_terimabarang"><?php echo $kartustok_view->id_terimabarang->caption() ?></span></td>
		<td data-name="id_terimabarang" <?php echo $kartustok_view->id_terimabarang->cellAttributes() ?>>
<span id="el_kartustok_id_terimabarang">
<span<?php echo $kartustok_view->id_terimabarang->viewAttributes() ?>><?php echo $kartustok_view->id_terimabarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->id_terimagudang->Visible) { // id_terimagudang ?>
	<tr id="r_id_terimagudang">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_terimagudang"><?php echo $kartustok_view->id_terimagudang->caption() ?></span></td>
		<td data-name="id_terimagudang" <?php echo $kartustok_view->id_terimagudang->cellAttributes() ?>>
<span id="el_kartustok_id_terimagudang">
<span<?php echo $kartustok_view->id_terimagudang->viewAttributes() ?>><?php echo $kartustok_view->id_terimagudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->id_penjualan->Visible) { // id_penjualan ?>
	<tr id="r_id_penjualan">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_penjualan"><?php echo $kartustok_view->id_penjualan->caption() ?></span></td>
		<td data-name="id_penjualan" <?php echo $kartustok_view->id_penjualan->cellAttributes() ?>>
<span id="el_kartustok_id_penjualan">
<span<?php echo $kartustok_view->id_penjualan->viewAttributes() ?>><?php echo $kartustok_view->id_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<tr id="r_id_kirimbarang">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_kirimbarang"><?php echo $kartustok_view->id_kirimbarang->caption() ?></span></td>
		<td data-name="id_kirimbarang" <?php echo $kartustok_view->id_kirimbarang->cellAttributes() ?>>
<span id="el_kartustok_id_kirimbarang">
<span<?php echo $kartustok_view->id_kirimbarang->viewAttributes() ?>><?php echo $kartustok_view->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->id_retur->Visible) { // id_retur ?>
	<tr id="r_id_retur">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_retur"><?php echo $kartustok_view->id_retur->caption() ?></span></td>
		<td data-name="id_retur" <?php echo $kartustok_view->id_retur->cellAttributes() ?>>
<span id="el_kartustok_id_retur">
<span<?php echo $kartustok_view->id_retur->viewAttributes() ?>><?php echo $kartustok_view->id_retur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->id_penyesuaian->Visible) { // id_penyesuaian ?>
	<tr id="r_id_penyesuaian">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_id_penyesuaian"><?php echo $kartustok_view->id_penyesuaian->caption() ?></span></td>
		<td data-name="id_penyesuaian" <?php echo $kartustok_view->id_penyesuaian->cellAttributes() ?>>
<span id="el_kartustok_id_penyesuaian">
<span<?php echo $kartustok_view->id_penyesuaian->viewAttributes() ?>><?php echo $kartustok_view->id_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->stok_awal->Visible) { // stok_awal ?>
	<tr id="r_stok_awal">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_stok_awal"><?php echo $kartustok_view->stok_awal->caption() ?></span></td>
		<td data-name="stok_awal" <?php echo $kartustok_view->stok_awal->cellAttributes() ?>>
<span id="el_kartustok_stok_awal">
<span<?php echo $kartustok_view->stok_awal->viewAttributes() ?>><?php echo $kartustok_view->stok_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->masuk->Visible) { // masuk ?>
	<tr id="r_masuk">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_masuk"><?php echo $kartustok_view->masuk->caption() ?></span></td>
		<td data-name="masuk" <?php echo $kartustok_view->masuk->cellAttributes() ?>>
<span id="el_kartustok_masuk">
<span<?php echo $kartustok_view->masuk->viewAttributes() ?>><?php echo $kartustok_view->masuk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<tr id="r_masuk_penyesuaian">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_masuk_penyesuaian"><?php echo $kartustok_view->masuk_penyesuaian->caption() ?></span></td>
		<td data-name="masuk_penyesuaian" <?php echo $kartustok_view->masuk_penyesuaian->cellAttributes() ?>>
<span id="el_kartustok_masuk_penyesuaian">
<span<?php echo $kartustok_view->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartustok_view->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->keluar->Visible) { // keluar ?>
	<tr id="r_keluar">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_keluar"><?php echo $kartustok_view->keluar->caption() ?></span></td>
		<td data-name="keluar" <?php echo $kartustok_view->keluar->cellAttributes() ?>>
<span id="el_kartustok_keluar">
<span<?php echo $kartustok_view->keluar->viewAttributes() ?>><?php echo $kartustok_view->keluar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->keluar_nonjual->Visible) { // keluar_nonjual ?>
	<tr id="r_keluar_nonjual">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_keluar_nonjual"><?php echo $kartustok_view->keluar_nonjual->caption() ?></span></td>
		<td data-name="keluar_nonjual" <?php echo $kartustok_view->keluar_nonjual->cellAttributes() ?>>
<span id="el_kartustok_keluar_nonjual">
<span<?php echo $kartustok_view->keluar_nonjual->viewAttributes() ?>><?php echo $kartustok_view->keluar_nonjual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<tr id="r_keluar_penyesuaian">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_keluar_penyesuaian"><?php echo $kartustok_view->keluar_penyesuaian->caption() ?></span></td>
		<td data-name="keluar_penyesuaian" <?php echo $kartustok_view->keluar_penyesuaian->cellAttributes() ?>>
<span id="el_kartustok_keluar_penyesuaian">
<span<?php echo $kartustok_view->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartustok_view->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->keluar_kirim->Visible) { // keluar_kirim ?>
	<tr id="r_keluar_kirim">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_keluar_kirim"><?php echo $kartustok_view->keluar_kirim->caption() ?></span></td>
		<td data-name="keluar_kirim" <?php echo $kartustok_view->keluar_kirim->cellAttributes() ?>>
<span id="el_kartustok_keluar_kirim">
<span<?php echo $kartustok_view->keluar_kirim->viewAttributes() ?>><?php echo $kartustok_view->keluar_kirim->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->retur->Visible) { // retur ?>
	<tr id="r_retur">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_retur"><?php echo $kartustok_view->retur->caption() ?></span></td>
		<td data-name="retur" <?php echo $kartustok_view->retur->cellAttributes() ?>>
<span id="el_kartustok_retur">
<span<?php echo $kartustok_view->retur->viewAttributes() ?>><?php echo $kartustok_view->retur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartustok_view->stok_akhir->Visible) { // stok_akhir ?>
	<tr id="r_stok_akhir">
		<td class="<?php echo $kartustok_view->TableLeftColumnClass ?>"><span id="elh_kartustok_stok_akhir"><?php echo $kartustok_view->stok_akhir->caption() ?></span></td>
		<td data-name="stok_akhir" <?php echo $kartustok_view->stok_akhir->cellAttributes() ?>>
<span id="el_kartustok_stok_akhir">
<span<?php echo $kartustok_view->stok_akhir->viewAttributes() ?>><?php echo $kartustok_view->stok_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kartustok_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kartustok_view->isExport()) { ?>
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
$kartustok_view->terminate();
?>