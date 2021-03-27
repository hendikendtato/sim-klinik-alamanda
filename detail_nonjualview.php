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
$detail_nonjual_view = new detail_nonjual_view();

// Run the page
$detail_nonjual_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detail_nonjual_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detail_nonjual_view->isExport()) { ?>
<script>
var fdetail_nonjualview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetail_nonjualview = currentForm = new ew.Form("fdetail_nonjualview", "view");
	loadjs.done("fdetail_nonjualview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detail_nonjual_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detail_nonjual_view->ExportOptions->render("body") ?>
<?php $detail_nonjual_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detail_nonjual_view->showPageHeader(); ?>
<?php
$detail_nonjual_view->showMessage();
?>
<form name="fdetail_nonjualview" id="fdetail_nonjualview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detail_nonjual">
<input type="hidden" name="modal" value="<?php echo (int)$detail_nonjual_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detail_nonjual_view->id_nonjual->Visible) { // id_nonjual ?>
	<tr id="r_id_nonjual">
		<td class="<?php echo $detail_nonjual_view->TableLeftColumnClass ?>"><span id="elh_detail_nonjual_id_nonjual"><?php echo $detail_nonjual_view->id_nonjual->caption() ?></span></td>
		<td data-name="id_nonjual" <?php echo $detail_nonjual_view->id_nonjual->cellAttributes() ?>>
<span id="el_detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_view->id_nonjual->viewAttributes() ?>><?php echo $detail_nonjual_view->id_nonjual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detail_nonjual_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detail_nonjual_view->TableLeftColumnClass ?>"><span id="elh_detail_nonjual_id_barang"><?php echo $detail_nonjual_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detail_nonjual_view->id_barang->cellAttributes() ?>>
<span id="el_detail_nonjual_id_barang">
<span<?php echo $detail_nonjual_view->id_barang->viewAttributes() ?>><?php echo $detail_nonjual_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detail_nonjual_view->stok->Visible) { // stok ?>
	<tr id="r_stok">
		<td class="<?php echo $detail_nonjual_view->TableLeftColumnClass ?>"><span id="elh_detail_nonjual_stok"><?php echo $detail_nonjual_view->stok->caption() ?></span></td>
		<td data-name="stok" <?php echo $detail_nonjual_view->stok->cellAttributes() ?>>
<span id="el_detail_nonjual_stok">
<span<?php echo $detail_nonjual_view->stok->viewAttributes() ?>><?php echo $detail_nonjual_view->stok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detail_nonjual_view->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $detail_nonjual_view->TableLeftColumnClass ?>"><span id="elh_detail_nonjual_qty"><?php echo $detail_nonjual_view->qty->caption() ?></span></td>
		<td data-name="qty" <?php echo $detail_nonjual_view->qty->cellAttributes() ?>>
<span id="el_detail_nonjual_qty">
<span<?php echo $detail_nonjual_view->qty->viewAttributes() ?>><?php echo $detail_nonjual_view->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detail_nonjual_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detail_nonjual_view->isExport()) { ?>
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
$detail_nonjual_view->terminate();
?>