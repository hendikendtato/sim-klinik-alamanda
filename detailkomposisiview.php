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
$detailkomposisi_view = new detailkomposisi_view();

// Run the page
$detailkomposisi_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailkomposisi_view->isExport()) { ?>
<script>
var fdetailkomposisiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailkomposisiview = currentForm = new ew.Form("fdetailkomposisiview", "view");
	loadjs.done("fdetailkomposisiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailkomposisi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailkomposisi_view->ExportOptions->render("body") ?>
<?php $detailkomposisi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailkomposisi_view->showPageHeader(); ?>
<?php
$detailkomposisi_view->showMessage();
?>
<form name="fdetailkomposisiview" id="fdetailkomposisiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkomposisi">
<input type="hidden" name="modal" value="<?php echo (int)$detailkomposisi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailkomposisi_view->id_detail_komposisi->Visible) { // id_detail_komposisi ?>
	<tr id="r_id_detail_komposisi">
		<td class="<?php echo $detailkomposisi_view->TableLeftColumnClass ?>"><span id="elh_detailkomposisi_id_detail_komposisi"><?php echo $detailkomposisi_view->id_detail_komposisi->caption() ?></span></td>
		<td data-name="id_detail_komposisi" <?php echo $detailkomposisi_view->id_detail_komposisi->cellAttributes() ?>>
<span id="el_detailkomposisi_id_detail_komposisi">
<span<?php echo $detailkomposisi_view->id_detail_komposisi->viewAttributes() ?>><?php echo $detailkomposisi_view->id_detail_komposisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailkomposisi_view->id_komposisi->Visible) { // id_komposisi ?>
	<tr id="r_id_komposisi">
		<td class="<?php echo $detailkomposisi_view->TableLeftColumnClass ?>"><span id="elh_detailkomposisi_id_komposisi"><?php echo $detailkomposisi_view->id_komposisi->caption() ?></span></td>
		<td data-name="id_komposisi" <?php echo $detailkomposisi_view->id_komposisi->cellAttributes() ?>>
<span id="el_detailkomposisi_id_komposisi">
<span<?php echo $detailkomposisi_view->id_komposisi->viewAttributes() ?>><?php echo $detailkomposisi_view->id_komposisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailkomposisi_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailkomposisi_view->TableLeftColumnClass ?>"><span id="elh_detailkomposisi_id_barang"><?php echo $detailkomposisi_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailkomposisi_view->id_barang->cellAttributes() ?>>
<span id="el_detailkomposisi_id_barang">
<span<?php echo $detailkomposisi_view->id_barang->viewAttributes() ?>><?php echo $detailkomposisi_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailkomposisi_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailkomposisi_view->TableLeftColumnClass ?>"><span id="elh_detailkomposisi_jumlah"><?php echo $detailkomposisi_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailkomposisi_view->jumlah->cellAttributes() ?>>
<span id="el_detailkomposisi_jumlah">
<span<?php echo $detailkomposisi_view->jumlah->viewAttributes() ?>><?php echo $detailkomposisi_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailkomposisi_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailkomposisi_view->TableLeftColumnClass ?>"><span id="elh_detailkomposisi_id_satuan"><?php echo $detailkomposisi_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailkomposisi_view->id_satuan->cellAttributes() ?>>
<span id="el_detailkomposisi_id_satuan">
<span<?php echo $detailkomposisi_view->id_satuan->viewAttributes() ?>><?php echo $detailkomposisi_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailkomposisi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailkomposisi_view->isExport()) { ?>
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
$detailkomposisi_view->terminate();
?>