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
$kategoribarang_view = new kategoribarang_view();

// Run the page
$kategoribarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kategoribarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kategoribarang_view->isExport()) { ?>
<script>
var fkategoribarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkategoribarangview = currentForm = new ew.Form("fkategoribarangview", "view");
	loadjs.done("fkategoribarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kategoribarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kategoribarang_view->ExportOptions->render("body") ?>
<?php $kategoribarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kategoribarang_view->showPageHeader(); ?>
<?php
$kategoribarang_view->showMessage();
?>
<form name="fkategoribarangview" id="fkategoribarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kategoribarang">
<input type="hidden" name="modal" value="<?php echo (int)$kategoribarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kategoribarang_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $kategoribarang_view->TableLeftColumnClass ?>"><span id="elh_kategoribarang_id"><?php echo $kategoribarang_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $kategoribarang_view->id->cellAttributes() ?>>
<span id="el_kategoribarang_id">
<span<?php echo $kategoribarang_view->id->viewAttributes() ?>><?php echo $kategoribarang_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kategoribarang_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $kategoribarang_view->TableLeftColumnClass ?>"><span id="elh_kategoribarang_nama"><?php echo $kategoribarang_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $kategoribarang_view->nama->cellAttributes() ?>>
<span id="el_kategoribarang_nama">
<span<?php echo $kategoribarang_view->nama->viewAttributes() ?>><?php echo $kategoribarang_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$kategoribarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kategoribarang_view->isExport()) { ?>
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
$kategoribarang_view->terminate();
?>