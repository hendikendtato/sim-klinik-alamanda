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
$detailrekmedpenjualan_view = new detailrekmedpenjualan_view();

// Run the page
$detailrekmedpenjualan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedpenjualan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailrekmedpenjualan_view->isExport()) { ?>
<script>
var fdetailrekmedpenjualanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailrekmedpenjualanview = currentForm = new ew.Form("fdetailrekmedpenjualanview", "view");
	loadjs.done("fdetailrekmedpenjualanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailrekmedpenjualan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailrekmedpenjualan_view->ExportOptions->render("body") ?>
<?php $detailrekmedpenjualan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailrekmedpenjualan_view->showPageHeader(); ?>
<?php
$detailrekmedpenjualan_view->showMessage();
?>
<form name="fdetailrekmedpenjualanview" id="fdetailrekmedpenjualanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedpenjualan">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmedpenjualan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailrekmedpenjualan_view->id_detailrekmedpenjualan->Visible) { // id_detailrekmedpenjualan ?>
	<tr id="r_id_detailrekmedpenjualan">
		<td class="<?php echo $detailrekmedpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_detailrekmedpenjualan"><?php echo $detailrekmedpenjualan_view->id_detailrekmedpenjualan->caption() ?></span></td>
		<td data-name="id_detailrekmedpenjualan" <?php echo $detailrekmedpenjualan_view->id_detailrekmedpenjualan->cellAttributes() ?>>
<span id="el_detailrekmedpenjualan_id_detailrekmedpenjualan">
<span<?php echo $detailrekmedpenjualan_view->id_detailrekmedpenjualan->viewAttributes() ?>><?php echo $detailrekmedpenjualan_view->id_detailrekmedpenjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedpenjualan_view->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<tr id="r_id_rekmeddok">
		<td class="<?php echo $detailrekmedpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_rekmeddok"><?php echo $detailrekmedpenjualan_view->id_rekmeddok->caption() ?></span></td>
		<td data-name="id_rekmeddok" <?php echo $detailrekmedpenjualan_view->id_rekmeddok->cellAttributes() ?>>
<span id="el_detailrekmedpenjualan_id_rekmeddok">
<span<?php echo $detailrekmedpenjualan_view->id_rekmeddok->viewAttributes() ?>><?php echo $detailrekmedpenjualan_view->id_rekmeddok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedpenjualan_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailrekmedpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_barang"><?php echo $detailrekmedpenjualan_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailrekmedpenjualan_view->id_barang->cellAttributes() ?>>
<span id="el_detailrekmedpenjualan_id_barang">
<span<?php echo $detailrekmedpenjualan_view->id_barang->viewAttributes() ?>><?php echo $detailrekmedpenjualan_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedpenjualan_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailrekmedpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_jumlah"><?php echo $detailrekmedpenjualan_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailrekmedpenjualan_view->jumlah->cellAttributes() ?>>
<span id="el_detailrekmedpenjualan_jumlah">
<span<?php echo $detailrekmedpenjualan_view->jumlah->viewAttributes() ?>><?php echo $detailrekmedpenjualan_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedpenjualan_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailrekmedpenjualan_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_satuan"><?php echo $detailrekmedpenjualan_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailrekmedpenjualan_view->id_satuan->cellAttributes() ?>>
<span id="el_detailrekmedpenjualan_id_satuan">
<span<?php echo $detailrekmedpenjualan_view->id_satuan->viewAttributes() ?>><?php echo $detailrekmedpenjualan_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailrekmedpenjualan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailrekmedpenjualan_view->isExport()) { ?>
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
$detailrekmedpenjualan_view->terminate();
?>