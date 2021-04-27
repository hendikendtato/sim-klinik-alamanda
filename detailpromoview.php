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
$detailpromo_view = new detailpromo_view();

// Run the page
$detailpromo_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpromo_view->isExport()) { ?>
<script>
var fdetailpromoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailpromoview = currentForm = new ew.Form("fdetailpromoview", "view");
	loadjs.done("fdetailpromoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailpromo_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailpromo_view->ExportOptions->render("body") ?>
<?php $detailpromo_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailpromo_view->showPageHeader(); ?>
<?php
$detailpromo_view->showMessage();
?>
<form name="fdetailpromoview" id="fdetailpromoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpromo">
<input type="hidden" name="modal" value="<?php echo (int)$detailpromo_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailpromo_view->id_detailpromo->Visible) { // id_detailpromo ?>
	<tr id="r_id_detailpromo">
		<td class="<?php echo $detailpromo_view->TableLeftColumnClass ?>"><span id="elh_detailpromo_id_detailpromo"><?php echo $detailpromo_view->id_detailpromo->caption() ?></span></td>
		<td data-name="id_detailpromo" <?php echo $detailpromo_view->id_detailpromo->cellAttributes() ?>>
<span id="el_detailpromo_id_detailpromo">
<span<?php echo $detailpromo_view->id_detailpromo->viewAttributes() ?>><?php echo $detailpromo_view->id_detailpromo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpromo_view->id_promo->Visible) { // id_promo ?>
	<tr id="r_id_promo">
		<td class="<?php echo $detailpromo_view->TableLeftColumnClass ?>"><span id="elh_detailpromo_id_promo"><?php echo $detailpromo_view->id_promo->caption() ?></span></td>
		<td data-name="id_promo" <?php echo $detailpromo_view->id_promo->cellAttributes() ?>>
<span id="el_detailpromo_id_promo">
<span<?php echo $detailpromo_view->id_promo->viewAttributes() ?>><?php echo $detailpromo_view->id_promo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpromo_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailpromo_view->TableLeftColumnClass ?>"><span id="elh_detailpromo_id_barang"><?php echo $detailpromo_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailpromo_view->id_barang->cellAttributes() ?>>
<span id="el_detailpromo_id_barang">
<span<?php echo $detailpromo_view->id_barang->viewAttributes() ?>><?php echo $detailpromo_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpromo_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailpromo_view->TableLeftColumnClass ?>"><span id="elh_detailpromo_jumlah"><?php echo $detailpromo_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailpromo_view->jumlah->cellAttributes() ?>>
<span id="el_detailpromo_jumlah">
<span<?php echo $detailpromo_view->jumlah->viewAttributes() ?>><?php echo $detailpromo_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpromo_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailpromo_view->TableLeftColumnClass ?>"><span id="elh_detailpromo_id_satuan"><?php echo $detailpromo_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailpromo_view->id_satuan->cellAttributes() ?>>
<span id="el_detailpromo_id_satuan">
<span<?php echo $detailpromo_view->id_satuan->viewAttributes() ?>><?php echo $detailpromo_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailpromo_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpromo_view->isExport()) { ?>
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
$detailpromo_view->terminate();
?>