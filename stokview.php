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
$stok_view = new stok_view();

// Run the page
$stok_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$stok_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$stok_view->isExport()) { ?>
<script>
var fstokview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstokview = currentForm = new ew.Form("fstokview", "view");
	loadjs.done("fstokview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$stok_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $stok_view->ExportOptions->render("body") ?>
<?php $stok_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $stok_view->showPageHeader(); ?>
<?php
$stok_view->showMessage();
?>
<form name="fstokview" id="fstokview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="stok">
<input type="hidden" name="modal" value="<?php echo (int)$stok_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($stok_view->id_stok->Visible) { // id_stok ?>
	<tr id="r_id_stok">
		<td class="<?php echo $stok_view->TableLeftColumnClass ?>"><span id="elh_stok_id_stok"><?php echo $stok_view->id_stok->caption() ?></span></td>
		<td data-name="id_stok" <?php echo $stok_view->id_stok->cellAttributes() ?>>
<span id="el_stok_id_stok">
<span<?php echo $stok_view->id_stok->viewAttributes() ?>><?php echo $stok_view->id_stok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($stok_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $stok_view->TableLeftColumnClass ?>"><span id="elh_stok_id_barang"><?php echo $stok_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $stok_view->id_barang->cellAttributes() ?>>
<span id="el_stok_id_barang">
<span<?php echo $stok_view->id_barang->viewAttributes() ?>><?php echo $stok_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($stok_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $stok_view->TableLeftColumnClass ?>"><span id="elh_stok_jumlah"><?php echo $stok_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $stok_view->jumlah->cellAttributes() ?>>
<span id="el_stok_jumlah">
<span<?php echo $stok_view->jumlah->viewAttributes() ?>><?php echo $stok_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($stok_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $stok_view->TableLeftColumnClass ?>"><span id="elh_stok_id_klinik"><?php echo $stok_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $stok_view->id_klinik->cellAttributes() ?>>
<span id="el_stok_id_klinik">
<span<?php echo $stok_view->id_klinik->viewAttributes() ?>><?php echo $stok_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$stok_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$stok_view->isExport()) { ?>
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
$stok_view->terminate();
?>