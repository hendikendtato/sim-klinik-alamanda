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
$kota_view = new kota_view();

// Run the page
$kota_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kota_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kota_view->isExport()) { ?>
<script>
var fkotaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkotaview = currentForm = new ew.Form("fkotaview", "view");
	loadjs.done("fkotaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kota_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kota_view->ExportOptions->render("body") ?>
<?php $kota_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kota_view->showPageHeader(); ?>
<?php
$kota_view->showMessage();
?>
<form name="fkotaview" id="fkotaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kota">
<input type="hidden" name="modal" value="<?php echo (int)$kota_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kota_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $kota_view->TableLeftColumnClass ?>"><span id="elh_kota_id"><?php echo $kota_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $kota_view->id->cellAttributes() ?>>
<span id="el_kota_id">
<span<?php echo $kota_view->id->viewAttributes() ?>><?php echo $kota_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kota_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $kota_view->TableLeftColumnClass ?>"><span id="elh_kota_nama"><?php echo $kota_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $kota_view->nama->cellAttributes() ?>>
<span id="el_kota_nama">
<span<?php echo $kota_view->nama->viewAttributes() ?>><?php echo $kota_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kota_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kota_view->isExport()) { ?>
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
$kota_view->terminate();
?>