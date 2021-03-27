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
$pekerjaan_view = new pekerjaan_view();

// Run the page
$pekerjaan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pekerjaan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pekerjaan_view->isExport()) { ?>
<script>
var fpekerjaanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpekerjaanview = currentForm = new ew.Form("fpekerjaanview", "view");
	loadjs.done("fpekerjaanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pekerjaan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pekerjaan_view->ExportOptions->render("body") ?>
<?php $pekerjaan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pekerjaan_view->showPageHeader(); ?>
<?php
$pekerjaan_view->showMessage();
?>
<form name="fpekerjaanview" id="fpekerjaanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pekerjaan">
<input type="hidden" name="modal" value="<?php echo (int)$pekerjaan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pekerjaan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $pekerjaan_view->TableLeftColumnClass ?>"><span id="elh_pekerjaan_id"><?php echo $pekerjaan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $pekerjaan_view->id->cellAttributes() ?>>
<span id="el_pekerjaan_id">
<span<?php echo $pekerjaan_view->id->viewAttributes() ?>><?php echo $pekerjaan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pekerjaan_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $pekerjaan_view->TableLeftColumnClass ?>"><span id="elh_pekerjaan_nama"><?php echo $pekerjaan_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $pekerjaan_view->nama->cellAttributes() ?>>
<span id="el_pekerjaan_nama">
<span<?php echo $pekerjaan_view->nama->viewAttributes() ?>><?php echo $pekerjaan_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pekerjaan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pekerjaan_view->isExport()) { ?>
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
$pekerjaan_view->terminate();
?>