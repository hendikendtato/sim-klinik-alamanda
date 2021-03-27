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
$detailperpindahanbarang_view = new detailperpindahanbarang_view();

// Run the page
$detailperpindahanbarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailperpindahanbarang_view->isExport()) { ?>
<script>
var fdetailperpindahanbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailperpindahanbarangview = currentForm = new ew.Form("fdetailperpindahanbarangview", "view");
	loadjs.done("fdetailperpindahanbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailperpindahanbarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailperpindahanbarang_view->ExportOptions->render("body") ?>
<?php $detailperpindahanbarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailperpindahanbarang_view->showPageHeader(); ?>
<?php
$detailperpindahanbarang_view->showMessage();
?>
<form name="fdetailperpindahanbarangview" id="fdetailperpindahanbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailperpindahanbarang">
<input type="hidden" name="modal" value="<?php echo (int)$detailperpindahanbarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailperpindahanbarang_view->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
	<tr id="r_id_detailperpindahanbarang">
		<td class="<?php echo $detailperpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_detailperpindahanbarang"><?php echo $detailperpindahanbarang_view->id_detailperpindahanbarang->caption() ?></span></td>
		<td data-name="id_detailperpindahanbarang" <?php echo $detailperpindahanbarang_view->id_detailperpindahanbarang->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_id_detailperpindahanbarang">
<span<?php echo $detailperpindahanbarang_view->id_detailperpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_view->id_detailperpindahanbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailperpindahanbarang_view->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<tr id="r_id_perpindahanbarang">
		<td class="<?php echo $detailperpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_perpindahanbarang"><?php echo $detailperpindahanbarang_view->id_perpindahanbarang->caption() ?></span></td>
		<td data-name="id_perpindahanbarang" <?php echo $detailperpindahanbarang_view->id_perpindahanbarang->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_view->id_perpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_view->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailperpindahanbarang_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailperpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_barang"><?php echo $detailperpindahanbarang_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailperpindahanbarang_view->id_barang->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_id_barang">
<span<?php echo $detailperpindahanbarang_view->id_barang->viewAttributes() ?>><?php echo $detailperpindahanbarang_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailperpindahanbarang_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailperpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_detailperpindahanbarang_jumlah"><?php echo $detailperpindahanbarang_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailperpindahanbarang_view->jumlah->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_jumlah">
<span<?php echo $detailperpindahanbarang_view->jumlah->viewAttributes() ?>><?php echo $detailperpindahanbarang_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailperpindahanbarang_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailperpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_satuan"><?php echo $detailperpindahanbarang_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailperpindahanbarang_view->id_satuan->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_id_satuan">
<span<?php echo $detailperpindahanbarang_view->id_satuan->viewAttributes() ?>><?php echo $detailperpindahanbarang_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailperpindahanbarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailperpindahanbarang_view->isExport()) { ?>
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
$detailperpindahanbarang_view->terminate();
?>