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
$laporan_kas_view = new laporan_kas_view();

// Run the page
$laporan_kas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_kas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$laporan_kas_view->isExport()) { ?>
<script>
var flaporan_kasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flaporan_kasview = currentForm = new ew.Form("flaporan_kasview", "view");
	loadjs.done("flaporan_kasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$laporan_kas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $laporan_kas_view->ExportOptions->render("body") ?>
<?php $laporan_kas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $laporan_kas_view->showPageHeader(); ?>
<?php
$laporan_kas_view->showMessage();
?>
<form name="flaporan_kasview" id="flaporan_kasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_kas">
<input type="hidden" name="modal" value="<?php echo (int)$laporan_kas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($laporan_kas_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_id"><?php echo $laporan_kas_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $laporan_kas_view->id->cellAttributes() ?>>
<span id="el_laporan_kas_id">
<span<?php echo $laporan_kas_view->id->viewAttributes() ?>><?php echo $laporan_kas_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_id_klinik"><?php echo $laporan_kas_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $laporan_kas_view->id_klinik->cellAttributes() ?>>
<span id="el_laporan_kas_id_klinik">
<span<?php echo $laporan_kas_view->id_klinik->viewAttributes() ?>><?php echo $laporan_kas_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->id_kas->Visible) { // id_kas ?>
	<tr id="r_id_kas">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_id_kas"><?php echo $laporan_kas_view->id_kas->caption() ?></span></td>
		<td data-name="id_kas" <?php echo $laporan_kas_view->id_kas->cellAttributes() ?>>
<span id="el_laporan_kas_id_kas">
<span<?php echo $laporan_kas_view->id_kas->viewAttributes() ?>><?php echo $laporan_kas_view->id_kas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_jumlah"><?php echo $laporan_kas_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $laporan_kas_view->jumlah->cellAttributes() ?>>
<span id="el_laporan_kas_jumlah">
<span<?php echo $laporan_kas_view->jumlah->viewAttributes() ?>><?php echo $laporan_kas_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_tanggal"><?php echo $laporan_kas_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $laporan_kas_view->tanggal->cellAttributes() ?>>
<span id="el_laporan_kas_tanggal">
<span<?php echo $laporan_kas_view->tanggal->viewAttributes() ?>><?php echo $laporan_kas_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->kode_penjualan->Visible) { // kode_penjualan ?>
	<tr id="r_kode_penjualan">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_kode_penjualan"><?php echo $laporan_kas_view->kode_penjualan->caption() ?></span></td>
		<td data-name="kode_penjualan" <?php echo $laporan_kas_view->kode_penjualan->cellAttributes() ?>>
<span id="el_laporan_kas_kode_penjualan">
<span<?php echo $laporan_kas_view->kode_penjualan->viewAttributes() ?>><?php echo $laporan_kas_view->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
	<tr id="r_id_mutasi_kas">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_id_mutasi_kas"><?php echo $laporan_kas_view->id_mutasi_kas->caption() ?></span></td>
		<td data-name="id_mutasi_kas" <?php echo $laporan_kas_view->id_mutasi_kas->cellAttributes() ?>>
<span id="el_laporan_kas_id_mutasi_kas">
<span<?php echo $laporan_kas_view->id_mutasi_kas->viewAttributes() ?>><?php echo $laporan_kas_view->id_mutasi_kas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->saldo_awal->Visible) { // saldo_awal ?>
	<tr id="r_saldo_awal">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_saldo_awal"><?php echo $laporan_kas_view->saldo_awal->caption() ?></span></td>
		<td data-name="saldo_awal" <?php echo $laporan_kas_view->saldo_awal->cellAttributes() ?>>
<span id="el_laporan_kas_saldo_awal">
<span<?php echo $laporan_kas_view->saldo_awal->viewAttributes() ?>><?php echo $laporan_kas_view->saldo_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($laporan_kas_view->sisa_saldo->Visible) { // sisa_saldo ?>
	<tr id="r_sisa_saldo">
		<td class="<?php echo $laporan_kas_view->TableLeftColumnClass ?>"><span id="elh_laporan_kas_sisa_saldo"><?php echo $laporan_kas_view->sisa_saldo->caption() ?></span></td>
		<td data-name="sisa_saldo" <?php echo $laporan_kas_view->sisa_saldo->cellAttributes() ?>>
<span id="el_laporan_kas_sisa_saldo">
<span<?php echo $laporan_kas_view->sisa_saldo->viewAttributes() ?>><?php echo $laporan_kas_view->sisa_saldo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$laporan_kas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$laporan_kas_view->isExport()) { ?>
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
$laporan_kas_view->terminate();
?>