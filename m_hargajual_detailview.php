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
$m_hargajual_detail_view = new m_hargajual_detail_view();

// Run the page
$m_hargajual_detail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_detail_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_hargajual_detail_view->isExport()) { ?>
<script>
var fm_hargajual_detailview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_hargajual_detailview = currentForm = new ew.Form("fm_hargajual_detailview", "view");
	loadjs.done("fm_hargajual_detailview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_hargajual_detail_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_hargajual_detail_view->ExportOptions->render("body") ?>
<?php $m_hargajual_detail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_hargajual_detail_view->showPageHeader(); ?>
<?php
$m_hargajual_detail_view->showMessage();
?>
<form name="fm_hargajual_detailview" id="fm_hargajual_detailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual_detail">
<input type="hidden" name="modal" value="<?php echo (int)$m_hargajual_detail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_hargajual_detail_view->id_hargajualdetail->Visible) { // id_hargajualdetail ?>
	<tr id="r_id_hargajualdetail">
		<td class="<?php echo $m_hargajual_detail_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_detail_id_hargajualdetail"><?php echo $m_hargajual_detail_view->id_hargajualdetail->caption() ?></span></td>
		<td data-name="id_hargajualdetail" <?php echo $m_hargajual_detail_view->id_hargajualdetail->cellAttributes() ?>>
<span id="el_m_hargajual_detail_id_hargajualdetail">
<span<?php echo $m_hargajual_detail_view->id_hargajualdetail->viewAttributes() ?>><?php echo $m_hargajual_detail_view->id_hargajualdetail->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_detail_view->id_hargajual->Visible) { // id_hargajual ?>
	<tr id="r_id_hargajual">
		<td class="<?php echo $m_hargajual_detail_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_detail_id_hargajual"><?php echo $m_hargajual_detail_view->id_hargajual->caption() ?></span></td>
		<td data-name="id_hargajual" <?php echo $m_hargajual_detail_view->id_hargajual->cellAttributes() ?>>
<span id="el_m_hargajual_detail_id_hargajual">
<span<?php echo $m_hargajual_detail_view->id_hargajual->viewAttributes() ?>><?php echo $m_hargajual_detail_view->id_hargajual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_detail_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $m_hargajual_detail_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_detail_id_barang"><?php echo $m_hargajual_detail_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $m_hargajual_detail_view->id_barang->cellAttributes() ?>>
<span id="el_m_hargajual_detail_id_barang">
<span<?php echo $m_hargajual_detail_view->id_barang->viewAttributes() ?>><?php echo $m_hargajual_detail_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_detail_view->hargajual->Visible) { // hargajual ?>
	<tr id="r_hargajual">
		<td class="<?php echo $m_hargajual_detail_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_detail_hargajual"><?php echo $m_hargajual_detail_view->hargajual->caption() ?></span></td>
		<td data-name="hargajual" <?php echo $m_hargajual_detail_view->hargajual->cellAttributes() ?>>
<span id="el_m_hargajual_detail_hargajual">
<span<?php echo $m_hargajual_detail_view->hargajual->viewAttributes() ?>><?php echo $m_hargajual_detail_view->hargajual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_hargajual_detail_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_hargajual_detail_view->isExport()) { ?>
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
$m_hargajual_detail_view->terminate();
?>