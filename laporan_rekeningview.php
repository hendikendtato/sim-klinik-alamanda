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
$laporan_rekening_view = new laporan_rekening_view();

// Run the page
$laporan_rekening_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_rekening_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$laporan_rekening_view->isExport()) { ?>
<script>
var flaporan_rekeningview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flaporan_rekeningview = currentForm = new ew.Form("flaporan_rekeningview", "view");
	loadjs.done("flaporan_rekeningview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$laporan_rekening_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $laporan_rekening_view->ExportOptions->render("body") ?>
<?php $laporan_rekening_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $laporan_rekening_view->showPageHeader(); ?>
<?php
$laporan_rekening_view->showMessage();
?>
<form name="flaporan_rekeningview" id="flaporan_rekeningview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_rekening">
<input type="hidden" name="modal" value="<?php echo (int)$laporan_rekening_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($laporan_rekening_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_id"><?php echo $laporan_rekening_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $laporan_rekening_view->id->cellAttributes() ?>>
<span id="el_laporan_rekening_id">
<span<?php echo $laporan_rekening_view->id->viewAttributes() ?>><?php echo $laporan_rekening_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->id_rekening->Visible) { // id_rekening ?>
	<tr id="r_id_rekening">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_id_rekening"><?php echo $laporan_rekening_view->id_rekening->caption() ?></span></td>
		<td data-name="id_rekening" <?php echo $laporan_rekening_view->id_rekening->cellAttributes() ?>>
<span id="el_laporan_rekening_id_rekening">
<span<?php echo $laporan_rekening_view->id_rekening->viewAttributes() ?>><?php echo $laporan_rekening_view->id_rekening->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_id_klinik"><?php echo $laporan_rekening_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $laporan_rekening_view->id_klinik->cellAttributes() ?>>
<span id="el_laporan_rekening_id_klinik">
<span<?php echo $laporan_rekening_view->id_klinik->viewAttributes() ?>><?php echo $laporan_rekening_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_jumlah"><?php echo $laporan_rekening_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $laporan_rekening_view->jumlah->cellAttributes() ?>>
<span id="el_laporan_rekening_jumlah">
<span<?php echo $laporan_rekening_view->jumlah->viewAttributes() ?>><?php echo $laporan_rekening_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_tanggal"><?php echo $laporan_rekening_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $laporan_rekening_view->tanggal->cellAttributes() ?>>
<span id="el_laporan_rekening_tanggal">
<span<?php echo $laporan_rekening_view->tanggal->viewAttributes() ?>><?php echo $laporan_rekening_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->kode_penjualan->Visible) { // kode_penjualan ?>
	<tr id="r_kode_penjualan">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_kode_penjualan"><?php echo $laporan_rekening_view->kode_penjualan->caption() ?></span></td>
		<td data-name="kode_penjualan" <?php echo $laporan_rekening_view->kode_penjualan->cellAttributes() ?>>
<span id="el_laporan_rekening_kode_penjualan">
<span<?php echo $laporan_rekening_view->kode_penjualan->viewAttributes() ?>><?php echo $laporan_rekening_view->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->saldo_awal->Visible) { // saldo_awal ?>
	<tr id="r_saldo_awal">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_saldo_awal"><?php echo $laporan_rekening_view->saldo_awal->caption() ?></span></td>
		<td data-name="saldo_awal" <?php echo $laporan_rekening_view->saldo_awal->cellAttributes() ?>>
<span id="el_laporan_rekening_saldo_awal">
<span<?php echo $laporan_rekening_view->saldo_awal->viewAttributes() ?>><?php echo $laporan_rekening_view->saldo_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_rekening_view->sisa_saldo->Visible) { // sisa_saldo ?>
	<tr id="r_sisa_saldo">
		<td class="<?php echo $laporan_rekening_view->TableLeftColumnClass ?>"><span id="elh_laporan_rekening_sisa_saldo"><?php echo $laporan_rekening_view->sisa_saldo->caption() ?></span></td>
		<td data-name="sisa_saldo" <?php echo $laporan_rekening_view->sisa_saldo->cellAttributes() ?>>
<span id="el_laporan_rekening_sisa_saldo">
<span<?php echo $laporan_rekening_view->sisa_saldo->viewAttributes() ?>><?php echo $laporan_rekening_view->sisa_saldo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$laporan_rekening_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$laporan_rekening_view->isExport()) { ?>
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
$laporan_rekening_view->terminate();
?>