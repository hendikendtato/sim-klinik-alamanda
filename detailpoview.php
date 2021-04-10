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
$detailpo_view = new detailpo_view();

// Run the page
$detailpo_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpo_view->isExport()) { ?>
<script>
var fdetailpoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailpoview = currentForm = new ew.Form("fdetailpoview", "view");
	loadjs.done("fdetailpoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailpo_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailpo_view->ExportOptions->render("body") ?>
<?php $detailpo_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailpo_view->showPageHeader(); ?>
<?php
$detailpo_view->showMessage();
?>
<form name="fdetailpoview" id="fdetailpoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpo">
<input type="hidden" name="modal" value="<?php echo (int)$detailpo_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailpo_view->pid_detailpo->Visible) { // pid_detailpo ?>
	<tr id="r_pid_detailpo">
		<td class="<?php echo $detailpo_view->TableLeftColumnClass ?>"><span id="elh_detailpo_pid_detailpo"><?php echo $detailpo_view->pid_detailpo->caption() ?></span></td>
		<td data-name="pid_detailpo" <?php echo $detailpo_view->pid_detailpo->cellAttributes() ?>>
<span id="el_detailpo_pid_detailpo">
<span<?php echo $detailpo_view->pid_detailpo->viewAttributes() ?>><?php echo $detailpo_view->pid_detailpo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpo_view->idbarang->Visible) { // idbarang ?>
	<tr id="r_idbarang">
		<td class="<?php echo $detailpo_view->TableLeftColumnClass ?>"><span id="elh_detailpo_idbarang"><?php echo $detailpo_view->idbarang->caption() ?></span></td>
		<td data-name="idbarang" <?php echo $detailpo_view->idbarang->cellAttributes() ?>>
<span id="el_detailpo_idbarang">
<span<?php echo $detailpo_view->idbarang->viewAttributes() ?>><?php echo $detailpo_view->idbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpo_view->qty->Visible) { // qty ?>
	<tr id="r_qty">
		<td class="<?php echo $detailpo_view->TableLeftColumnClass ?>"><span id="elh_detailpo_qty"><?php echo $detailpo_view->qty->caption() ?></span></td>
		<td data-name="qty" <?php echo $detailpo_view->qty->cellAttributes() ?>>
<span id="el_detailpo_qty">
<span<?php echo $detailpo_view->qty->viewAttributes() ?>><?php echo $detailpo_view->qty->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpo_view->satuan->Visible) { // satuan ?>
	<tr id="r_satuan">
		<td class="<?php echo $detailpo_view->TableLeftColumnClass ?>"><span id="elh_detailpo_satuan"><?php echo $detailpo_view->satuan->caption() ?></span></td>
		<td data-name="satuan" <?php echo $detailpo_view->satuan->cellAttributes() ?>>
<span id="el_detailpo_satuan">
<span<?php echo $detailpo_view->satuan->viewAttributes() ?>><?php echo $detailpo_view->satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailpo_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpo_view->isExport()) { ?>
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
$detailpo_view->terminate();
?>