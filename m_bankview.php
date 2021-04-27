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
$m_bank_view = new m_bank_view();

// Run the page
$m_bank_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_bank_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_bank_view->isExport()) { ?>
<script>
var fm_bankview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_bankview = currentForm = new ew.Form("fm_bankview", "view");
	loadjs.done("fm_bankview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_bank_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_bank_view->ExportOptions->render("body") ?>
<?php $m_bank_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_bank_view->showPageHeader(); ?>
<?php
$m_bank_view->showMessage();
?>
<form name="fm_bankview" id="fm_bankview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_bank">
<input type="hidden" name="modal" value="<?php echo (int)$m_bank_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_bank_view->id_bank->Visible) { // id_bank ?>
	<tr id="r_id_bank">
		<td class="<?php echo $m_bank_view->TableLeftColumnClass ?>"><span id="elh_m_bank_id_bank"><?php echo $m_bank_view->id_bank->caption() ?></span></td>
		<td data-name="id_bank" <?php echo $m_bank_view->id_bank->cellAttributes() ?>>
<span id="el_m_bank_id_bank">
<span<?php echo $m_bank_view->id_bank->viewAttributes() ?>><?php echo $m_bank_view->id_bank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_bank_view->nama_bank->Visible) { // nama_bank ?>
	<tr id="r_nama_bank">
		<td class="<?php echo $m_bank_view->TableLeftColumnClass ?>"><span id="elh_m_bank_nama_bank"><?php echo $m_bank_view->nama_bank->caption() ?></span></td>
		<td data-name="nama_bank" <?php echo $m_bank_view->nama_bank->cellAttributes() ?>>
<span id="el_m_bank_nama_bank">
<span<?php echo $m_bank_view->nama_bank->viewAttributes() ?>><?php echo $m_bank_view->nama_bank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_bank_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_bank_view->isExport()) { ?>
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
$m_bank_view->terminate();
?>