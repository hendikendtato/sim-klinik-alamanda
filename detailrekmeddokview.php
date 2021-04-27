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
$detailrekmeddok_view = new detailrekmeddok_view();

// Run the page
$detailrekmeddok_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailrekmeddok_view->isExport()) { ?>
<script>
var fdetailrekmeddokview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailrekmeddokview = currentForm = new ew.Form("fdetailrekmeddokview", "view");
	loadjs.done("fdetailrekmeddokview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailrekmeddok_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailrekmeddok_view->ExportOptions->render("body") ?>
<?php $detailrekmeddok_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailrekmeddok_view->showPageHeader(); ?>
<?php
$detailrekmeddok_view->showMessage();
?>
<form name="fdetailrekmeddokview" id="fdetailrekmeddokview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmeddok">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmeddok_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailrekmeddok_view->id_pemobat->Visible) { // id_pemobat ?>
	<tr id="r_id_pemobat">
		<td class="<?php echo $detailrekmeddok_view->TableLeftColumnClass ?>"><span id="elh_detailrekmeddok_id_pemobat"><?php echo $detailrekmeddok_view->id_pemobat->caption() ?></span></td>
		<td data-name="id_pemobat" <?php echo $detailrekmeddok_view->id_pemobat->cellAttributes() ?>>
<span id="el_detailrekmeddok_id_pemobat">
<span<?php echo $detailrekmeddok_view->id_pemobat->viewAttributes() ?>><?php echo $detailrekmeddok_view->id_pemobat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmeddok_view->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<tr id="r_id_rekmeddok">
		<td class="<?php echo $detailrekmeddok_view->TableLeftColumnClass ?>"><span id="elh_detailrekmeddok_id_rekmeddok"><?php echo $detailrekmeddok_view->id_rekmeddok->caption() ?></span></td>
		<td data-name="id_rekmeddok" <?php echo $detailrekmeddok_view->id_rekmeddok->cellAttributes() ?>>
<span id="el_detailrekmeddok_id_rekmeddok">
<span<?php echo $detailrekmeddok_view->id_rekmeddok->viewAttributes() ?>><?php echo $detailrekmeddok_view->id_rekmeddok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmeddok_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailrekmeddok_view->TableLeftColumnClass ?>"><span id="elh_detailrekmeddok_id_barang"><?php echo $detailrekmeddok_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailrekmeddok_view->id_barang->cellAttributes() ?>>
<span id="el_detailrekmeddok_id_barang">
<span<?php echo $detailrekmeddok_view->id_barang->viewAttributes() ?>><?php echo $detailrekmeddok_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmeddok_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailrekmeddok_view->TableLeftColumnClass ?>"><span id="elh_detailrekmeddok_jumlah"><?php echo $detailrekmeddok_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailrekmeddok_view->jumlah->cellAttributes() ?>>
<span id="el_detailrekmeddok_jumlah">
<span<?php echo $detailrekmeddok_view->jumlah->viewAttributes() ?>><?php echo $detailrekmeddok_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmeddok_view->satuan->Visible) { // satuan ?>
	<tr id="r_satuan">
		<td class="<?php echo $detailrekmeddok_view->TableLeftColumnClass ?>"><span id="elh_detailrekmeddok_satuan"><?php echo $detailrekmeddok_view->satuan->caption() ?></span></td>
		<td data-name="satuan" <?php echo $detailrekmeddok_view->satuan->cellAttributes() ?>>
<span id="el_detailrekmeddok_satuan">
<span<?php echo $detailrekmeddok_view->satuan->viewAttributes() ?>><?php echo $detailrekmeddok_view->satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailrekmeddok_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailrekmeddok_view->isExport()) { ?>
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
$detailrekmeddok_view->terminate();
?>