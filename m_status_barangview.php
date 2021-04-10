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
$m_status_barang_view = new m_status_barang_view();

// Run the page
$m_status_barang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_status_barang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_status_barang_view->isExport()) { ?>
<script>
var fm_status_barangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_status_barangview = currentForm = new ew.Form("fm_status_barangview", "view");
	loadjs.done("fm_status_barangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_status_barang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_status_barang_view->ExportOptions->render("body") ?>
<?php $m_status_barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_status_barang_view->showPageHeader(); ?>
<?php
$m_status_barang_view->showMessage();
?>
<form name="fm_status_barangview" id="fm_status_barangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_status_barang">
<input type="hidden" name="modal" value="<?php echo (int)$m_status_barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_status_barang_view->id_status->Visible) { // id_status ?>
	<tr id="r_id_status">
		<td class="<?php echo $m_status_barang_view->TableLeftColumnClass ?>"><span id="elh_m_status_barang_id_status"><?php echo $m_status_barang_view->id_status->caption() ?></span></td>
		<td data-name="id_status" <?php echo $m_status_barang_view->id_status->cellAttributes() ?>>
<span id="el_m_status_barang_id_status">
<span<?php echo $m_status_barang_view->id_status->viewAttributes() ?>><?php echo $m_status_barang_view->id_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_status_barang_view->status_barang->Visible) { // status_barang ?>
	<tr id="r_status_barang">
		<td class="<?php echo $m_status_barang_view->TableLeftColumnClass ?>"><span id="elh_m_status_barang_status_barang"><?php echo $m_status_barang_view->status_barang->caption() ?></span></td>
		<td data-name="status_barang" <?php echo $m_status_barang_view->status_barang->cellAttributes() ?>>
<span id="el_m_status_barang_status_barang">
<span<?php echo $m_status_barang_view->status_barang->viewAttributes() ?>><?php echo $m_status_barang_view->status_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_status_barang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_status_barang_view->isExport()) { ?>
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
$m_status_barang_view->terminate();
?>