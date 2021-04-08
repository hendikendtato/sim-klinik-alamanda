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
$komposisi_view = new komposisi_view();

// Run the page
$komposisi_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komposisi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$komposisi_view->isExport()) { ?>
<script>
var fkomposisiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkomposisiview = currentForm = new ew.Form("fkomposisiview", "view");
	loadjs.done("fkomposisiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$komposisi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $komposisi_view->ExportOptions->render("body") ?>
<?php $komposisi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $komposisi_view->showPageHeader(); ?>
<?php
$komposisi_view->showMessage();
?>
<form name="fkomposisiview" id="fkomposisiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komposisi">
<input type="hidden" name="modal" value="<?php echo (int)$komposisi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($komposisi_view->id_komposisi->Visible) { // id_komposisi ?>
	<tr id="r_id_komposisi">
		<td class="<?php echo $komposisi_view->TableLeftColumnClass ?>"><span id="elh_komposisi_id_komposisi"><?php echo $komposisi_view->id_komposisi->caption() ?></span></td>
		<td data-name="id_komposisi" <?php echo $komposisi_view->id_komposisi->cellAttributes() ?>>
<span id="el_komposisi_id_komposisi">
<span<?php echo $komposisi_view->id_komposisi->viewAttributes() ?>><?php echo $komposisi_view->id_komposisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($komposisi_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $komposisi_view->TableLeftColumnClass ?>"><span id="elh_komposisi_id_barang"><?php echo $komposisi_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $komposisi_view->id_barang->cellAttributes() ?>>
<span id="el_komposisi_id_barang">
<span<?php echo $komposisi_view->id_barang->viewAttributes() ?>><?php echo $komposisi_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailkomposisi", explode(",", $komposisi->getCurrentDetailTable())) && $detailkomposisi->DetailView) {
?>
<?php if ($komposisi->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailkomposisi", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailkomposisigrid.php" ?>
<?php } ?>
</form>
<?php
$komposisi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$komposisi_view->isExport()) { ?>
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
$komposisi_view->terminate();
?>