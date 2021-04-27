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
$subkategoribarang_view = new subkategoribarang_view();

// Run the page
$subkategoribarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subkategoribarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$subkategoribarang_view->isExport()) { ?>
<script>
var fsubkategoribarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsubkategoribarangview = currentForm = new ew.Form("fsubkategoribarangview", "view");
	loadjs.done("fsubkategoribarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$subkategoribarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $subkategoribarang_view->ExportOptions->render("body") ?>
<?php $subkategoribarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $subkategoribarang_view->showPageHeader(); ?>
<?php
$subkategoribarang_view->showMessage();
?>
<form name="fsubkategoribarangview" id="fsubkategoribarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subkategoribarang">
<input type="hidden" name="modal" value="<?php echo (int)$subkategoribarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($subkategoribarang_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $subkategoribarang_view->TableLeftColumnClass ?>"><span id="elh_subkategoribarang_id"><?php echo $subkategoribarang_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $subkategoribarang_view->id->cellAttributes() ?>>
<span id="el_subkategoribarang_id">
<span<?php echo $subkategoribarang_view->id->viewAttributes() ?>><?php echo $subkategoribarang_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($subkategoribarang_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $subkategoribarang_view->TableLeftColumnClass ?>"><span id="elh_subkategoribarang_nama"><?php echo $subkategoribarang_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $subkategoribarang_view->nama->cellAttributes() ?>>
<span id="el_subkategoribarang_nama">
<span<?php echo $subkategoribarang_view->nama->viewAttributes() ?>><?php echo $subkategoribarang_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$subkategoribarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$subkategoribarang_view->isExport()) { ?>
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
$subkategoribarang_view->terminate();
?>