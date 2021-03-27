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
$detailpenyesuaianstok_view = new detailpenyesuaianstok_view();

// Run the page
$detailpenyesuaianstok_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianstok_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpenyesuaianstok_view->isExport()) { ?>
<script>
var fdetailpenyesuaianstokview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailpenyesuaianstokview = currentForm = new ew.Form("fdetailpenyesuaianstokview", "view");
	loadjs.done("fdetailpenyesuaianstokview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailpenyesuaianstok_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailpenyesuaianstok_view->ExportOptions->render("body") ?>
<?php $detailpenyesuaianstok_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailpenyesuaianstok_view->showPageHeader(); ?>
<?php
$detailpenyesuaianstok_view->showMessage();
?>
<form name="fdetailpenyesuaianstokview" id="fdetailpenyesuaianstokview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianstok">
<input type="hidden" name="modal" value="<?php echo (int)$detailpenyesuaianstok_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailpenyesuaianstok_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_id"><?php echo $detailpenyesuaianstok_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $detailpenyesuaianstok_view->id->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_id">
<span<?php echo $detailpenyesuaianstok_view->id->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_pid"><?php echo $detailpenyesuaianstok_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $detailpenyesuaianstok_view->pid->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_pid">
<span<?php echo $detailpenyesuaianstok_view->pid->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->kode_barang->Visible) { // kode_barang ?>
	<tr id="r_kode_barang">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_kode_barang"><?php echo $detailpenyesuaianstok_view->kode_barang->caption() ?></span></td>
		<td data-name="kode_barang" <?php echo $detailpenyesuaianstok_view->kode_barang->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_kode_barang">
<span<?php echo $detailpenyesuaianstok_view->kode_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->kode_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_id_barang"><?php echo $detailpenyesuaianstok_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailpenyesuaianstok_view->id_barang->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_id_barang">
<span<?php echo $detailpenyesuaianstok_view->id_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->stokdatabase->Visible) { // stokdatabase ?>
	<tr id="r_stokdatabase">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_stokdatabase"><?php echo $detailpenyesuaianstok_view->stokdatabase->caption() ?></span></td>
		<td data-name="stokdatabase" <?php echo $detailpenyesuaianstok_view->stokdatabase->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_stokdatabase">
<span<?php echo $detailpenyesuaianstok_view->stokdatabase->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->stokdatabase->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_jumlah"><?php echo $detailpenyesuaianstok_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailpenyesuaianstok_view->jumlah->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_jumlah">
<span<?php echo $detailpenyesuaianstok_view->jumlah->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->selisih->Visible) { // selisih ?>
	<tr id="r_selisih">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_selisih"><?php echo $detailpenyesuaianstok_view->selisih->caption() ?></span></td>
		<td data-name="selisih" <?php echo $detailpenyesuaianstok_view->selisih->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_selisih">
<span<?php echo $detailpenyesuaianstok_view->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->selisih->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianstok_view->tipe->Visible) { // tipe ?>
	<tr id="r_tipe">
		<td class="<?php echo $detailpenyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianstok_tipe"><?php echo $detailpenyesuaianstok_view->tipe->caption() ?></span></td>
		<td data-name="tipe" <?php echo $detailpenyesuaianstok_view->tipe->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_tipe">
<span<?php echo $detailpenyesuaianstok_view->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianstok_view->tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailpenyesuaianstok_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpenyesuaianstok_view->isExport()) { ?>
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
$detailpenyesuaianstok_view->terminate();
?>