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
$detailterimagudang_view = new detailterimagudang_view();

// Run the page
$detailterimagudang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimagudang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailterimagudang_view->isExport()) { ?>
<script>
var fdetailterimagudangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailterimagudangview = currentForm = new ew.Form("fdetailterimagudangview", "view");
	loadjs.done("fdetailterimagudangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailterimagudang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailterimagudang_view->ExportOptions->render("body") ?>
<?php $detailterimagudang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailterimagudang_view->showPageHeader(); ?>
<?php
$detailterimagudang_view->showMessage();
?>
<form name="fdetailterimagudangview" id="fdetailterimagudangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimagudang">
<input type="hidden" name="modal" value="<?php echo (int)$detailterimagudang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailterimagudang_view->id_detailterimagudang->Visible) { // id_detailterimagudang ?>
	<tr id="r_id_detailterimagudang">
		<td class="<?php echo $detailterimagudang_view->TableLeftColumnClass ?>"><span id="elh_detailterimagudang_id_detailterimagudang"><?php echo $detailterimagudang_view->id_detailterimagudang->caption() ?></span></td>
		<td data-name="id_detailterimagudang" <?php echo $detailterimagudang_view->id_detailterimagudang->cellAttributes() ?>>
<span id="el_detailterimagudang_id_detailterimagudang">
<span<?php echo $detailterimagudang_view->id_detailterimagudang->viewAttributes() ?>><?php echo $detailterimagudang_view->id_detailterimagudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailterimagudang_view->pid_terimagudang->Visible) { // pid_terimagudang ?>
	<tr id="r_pid_terimagudang">
		<td class="<?php echo $detailterimagudang_view->TableLeftColumnClass ?>"><span id="elh_detailterimagudang_pid_terimagudang"><?php echo $detailterimagudang_view->pid_terimagudang->caption() ?></span></td>
		<td data-name="pid_terimagudang" <?php echo $detailterimagudang_view->pid_terimagudang->cellAttributes() ?>>
<span id="el_detailterimagudang_pid_terimagudang">
<span<?php echo $detailterimagudang_view->pid_terimagudang->viewAttributes() ?>><?php echo $detailterimagudang_view->pid_terimagudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailterimagudang_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailterimagudang_view->TableLeftColumnClass ?>"><span id="elh_detailterimagudang_id_barang"><?php echo $detailterimagudang_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailterimagudang_view->id_barang->cellAttributes() ?>>
<span id="el_detailterimagudang_id_barang">
<span<?php echo $detailterimagudang_view->id_barang->viewAttributes() ?>><?php echo $detailterimagudang_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailterimagudang_view->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $detailterimagudang_view->TableLeftColumnClass ?>"><span id="elh_detailterimagudang_qty"><?php echo $detailterimagudang_view->qty->caption() ?></span></td>
		<td data-name="qty" <?php echo $detailterimagudang_view->qty->cellAttributes() ?>>
<span id="el_detailterimagudang_qty">
<span<?php echo $detailterimagudang_view->qty->viewAttributes() ?>><?php echo $detailterimagudang_view->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailterimagudang_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailterimagudang_view->TableLeftColumnClass ?>"><span id="elh_detailterimagudang_id_satuan"><?php echo $detailterimagudang_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailterimagudang_view->id_satuan->cellAttributes() ?>>
<span id="el_detailterimagudang_id_satuan">
<span<?php echo $detailterimagudang_view->id_satuan->viewAttributes() ?>><?php echo $detailterimagudang_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailterimagudang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailterimagudang_view->isExport()) { ?>
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
$detailterimagudang_view->terminate();
?>