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
$m_jabatan_view = new m_jabatan_view();

// Run the page
$m_jabatan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jabatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_jabatan_view->isExport()) { ?>
<script>
var fm_jabatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_jabatanview = currentForm = new ew.Form("fm_jabatanview", "view");
	loadjs.done("fm_jabatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_jabatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_jabatan_view->ExportOptions->render("body") ?>
<?php $m_jabatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_jabatan_view->showPageHeader(); ?>
<?php
$m_jabatan_view->showMessage();
?>
<form name="fm_jabatanview" id="fm_jabatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jabatan">
<input type="hidden" name="modal" value="<?php echo (int)$m_jabatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_jabatan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_jabatan_view->TableLeftColumnClass ?>"><span id="elh_m_jabatan_id"><?php echo $m_jabatan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_jabatan_view->id->cellAttributes() ?>>
<span id="el_m_jabatan_id">
<span<?php echo $m_jabatan_view->id->viewAttributes() ?>><?php echo $m_jabatan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jabatan_view->nama_jabatan->Visible) { // nama_jabatan ?>
	<tr id="r_nama_jabatan">
		<td class="<?php echo $m_jabatan_view->TableLeftColumnClass ?>"><span id="elh_m_jabatan_nama_jabatan"><?php echo $m_jabatan_view->nama_jabatan->caption() ?></span></td>
		<td data-name="nama_jabatan" <?php echo $m_jabatan_view->nama_jabatan->cellAttributes() ?>>
<span id="el_m_jabatan_nama_jabatan">
<span<?php echo $m_jabatan_view->nama_jabatan->viewAttributes() ?>><?php echo $m_jabatan_view->nama_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_jabatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_jabatan_view->isExport()) { ?>
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
$m_jabatan_view->terminate();
?>