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
$kartupoin_view = new kartupoin_view();

// Run the page
$kartupoin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartupoin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kartupoin_view->isExport()) { ?>
<script>
var fkartupoinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkartupoinview = currentForm = new ew.Form("fkartupoinview", "view");
	loadjs.done("fkartupoinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kartupoin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kartupoin_view->ExportOptions->render("body") ?>
<?php $kartupoin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kartupoin_view->showPageHeader(); ?>
<?php
$kartupoin_view->showMessage();
?>
<form name="fkartupoinview" id="fkartupoinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartupoin">
<input type="hidden" name="modal" value="<?php echo (int)$kartupoin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kartupoin_view->id_pelanggan->Visible) { // id_pelanggan ?>
	<tr id="r_id_pelanggan">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_id_pelanggan"><?php echo $kartupoin_view->id_pelanggan->caption() ?></span></td>
		<td data-name="id_pelanggan" <?php echo $kartupoin_view->id_pelanggan->cellAttributes() ?>>
<span id="el_kartupoin_id_pelanggan">
<span<?php echo $kartupoin_view->id_pelanggan->viewAttributes() ?>><?php echo $kartupoin_view->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_id_klinik"><?php echo $kartupoin_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $kartupoin_view->id_klinik->cellAttributes() ?>>
<span id="el_kartupoin_id_klinik">
<span<?php echo $kartupoin_view->id_klinik->viewAttributes() ?>><?php echo $kartupoin_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->kode_penjualan->Visible) { // kode_penjualan ?>
	<tr id="r_kode_penjualan">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_kode_penjualan"><?php echo $kartupoin_view->kode_penjualan->caption() ?></span></td>
		<td data-name="kode_penjualan" <?php echo $kartupoin_view->kode_penjualan->cellAttributes() ?>>
<span id="el_kartupoin_kode_penjualan">
<span<?php echo $kartupoin_view->kode_penjualan->viewAttributes() ?>><?php echo $kartupoin_view->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
	<tr id="r_id_penyesuaian_poin">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_id_penyesuaian_poin"><?php echo $kartupoin_view->id_penyesuaian_poin->caption() ?></span></td>
		<td data-name="id_penyesuaian_poin" <?php echo $kartupoin_view->id_penyesuaian_poin->cellAttributes() ?>>
<span id="el_kartupoin_id_penyesuaian_poin">
<span<?php echo $kartupoin_view->id_penyesuaian_poin->viewAttributes() ?>><?php echo $kartupoin_view->id_penyesuaian_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_tgl"><?php echo $kartupoin_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $kartupoin_view->tgl->cellAttributes() ?>>
<span id="el_kartupoin_tgl">
<span<?php echo $kartupoin_view->tgl->viewAttributes() ?>><?php echo $kartupoin_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->masuk->Visible) { // masuk ?>
	<tr id="r_masuk">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_masuk"><?php echo $kartupoin_view->masuk->caption() ?></span></td>
		<td data-name="masuk" <?php echo $kartupoin_view->masuk->cellAttributes() ?>>
<span id="el_kartupoin_masuk">
<span<?php echo $kartupoin_view->masuk->viewAttributes() ?>><?php echo $kartupoin_view->masuk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<tr id="r_masuk_penyesuaian">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_masuk_penyesuaian"><?php echo $kartupoin_view->masuk_penyesuaian->caption() ?></span></td>
		<td data-name="masuk_penyesuaian" <?php echo $kartupoin_view->masuk_penyesuaian->cellAttributes() ?>>
<span id="el_kartupoin_masuk_penyesuaian">
<span<?php echo $kartupoin_view->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartupoin_view->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->keluar->Visible) { // keluar ?>
	<tr id="r_keluar">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_keluar"><?php echo $kartupoin_view->keluar->caption() ?></span></td>
		<td data-name="keluar" <?php echo $kartupoin_view->keluar->cellAttributes() ?>>
<span id="el_kartupoin_keluar">
<span<?php echo $kartupoin_view->keluar->viewAttributes() ?>><?php echo $kartupoin_view->keluar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<tr id="r_keluar_penyesuaian">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_keluar_penyesuaian"><?php echo $kartupoin_view->keluar_penyesuaian->caption() ?></span></td>
		<td data-name="keluar_penyesuaian" <?php echo $kartupoin_view->keluar_penyesuaian->cellAttributes() ?>>
<span id="el_kartupoin_keluar_penyesuaian">
<span<?php echo $kartupoin_view->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartupoin_view->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kartupoin_view->saldo_poin->Visible) { // saldo_poin ?>
	<tr id="r_saldo_poin">
		<td class="<?php echo $kartupoin_view->TableLeftColumnClass ?>"><span id="elh_kartupoin_saldo_poin"><?php echo $kartupoin_view->saldo_poin->caption() ?></span></td>
		<td data-name="saldo_poin" <?php echo $kartupoin_view->saldo_poin->cellAttributes() ?>>
<span id="el_kartupoin_saldo_poin">
<span<?php echo $kartupoin_view->saldo_poin->viewAttributes() ?>><?php echo $kartupoin_view->saldo_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kartupoin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kartupoin_view->isExport()) { ?>
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
$kartupoin_view->terminate();
?>