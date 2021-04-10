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
$jenisbarang_view = new jenisbarang_view();

// Run the page
$jenisbarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenisbarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenisbarang_view->isExport()) { ?>
<script>
var fjenisbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenisbarangview = currentForm = new ew.Form("fjenisbarangview", "view");
	loadjs.done("fjenisbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenisbarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenisbarang_view->ExportOptions->render("body") ?>
<?php $jenisbarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenisbarang_view->showPageHeader(); ?>
<?php
$jenisbarang_view->showMessage();
?>
<form name="fjenisbarangview" id="fjenisbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenisbarang">
<input type="hidden" name="modal" value="<?php echo (int)$jenisbarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenisbarang_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jenisbarang_view->TableLeftColumnClass ?>"><span id="elh_jenisbarang_id"><?php echo $jenisbarang_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jenisbarang_view->id->cellAttributes() ?>>
<span id="el_jenisbarang_id">
<span<?php echo $jenisbarang_view->id->viewAttributes() ?>><?php echo $jenisbarang_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenisbarang_view->kode->Visible) { // kode ?>
	<tr id="r_kode">
		<td class="<?php echo $jenisbarang_view->TableLeftColumnClass ?>"><span id="elh_jenisbarang_kode"><?php echo $jenisbarang_view->kode->caption() ?></span></td>
		<td data-name="kode" <?php echo $jenisbarang_view->kode->cellAttributes() ?>>
<span id="el_jenisbarang_kode">
<span<?php echo $jenisbarang_view->kode->viewAttributes() ?>><?php echo $jenisbarang_view->kode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenisbarang_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $jenisbarang_view->TableLeftColumnClass ?>"><span id="elh_jenisbarang_jenis"><?php echo $jenisbarang_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $jenisbarang_view->jenis->cellAttributes() ?>>
<span id="el_jenisbarang_jenis">
<span<?php echo $jenisbarang_view->jenis->viewAttributes() ?>><?php echo $jenisbarang_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenisbarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenisbarang_view->isExport()) { ?>
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
$jenisbarang_view->terminate();
?>