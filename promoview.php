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
$promo_view = new promo_view();

// Run the page
$promo_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promo_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$promo_view->isExport()) { ?>
<script>
var fpromoview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpromoview = currentForm = new ew.Form("fpromoview", "view");
	loadjs.done("fpromoview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$promo_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $promo_view->ExportOptions->render("body") ?>
<?php $promo_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $promo_view->showPageHeader(); ?>
<?php
$promo_view->showMessage();
?>
<form name="fpromoview" id="fpromoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promo">
<input type="hidden" name="modal" value="<?php echo (int)$promo_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($promo_view->id_promo->Visible) { // id_promo ?>
	<tr id="r_id_promo">
		<td class="<?php echo $promo_view->TableLeftColumnClass ?>"><span id="elh_promo_id_promo"><?php echo $promo_view->id_promo->caption() ?></span></td>
		<td data-name="id_promo" <?php echo $promo_view->id_promo->cellAttributes() ?>>
<span id="el_promo_id_promo">
<span<?php echo $promo_view->id_promo->viewAttributes() ?>><?php echo $promo_view->id_promo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($promo_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $promo_view->TableLeftColumnClass ?>"><span id="elh_promo_nama"><?php echo $promo_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $promo_view->nama->cellAttributes() ?>>
<span id="el_promo_nama">
<span<?php echo $promo_view->nama->viewAttributes() ?>><?php echo $promo_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($promo_view->tanggal_mulai->Visible) { // tanggal_mulai ?>
	<tr id="r_tanggal_mulai">
		<td class="<?php echo $promo_view->TableLeftColumnClass ?>"><span id="elh_promo_tanggal_mulai"><?php echo $promo_view->tanggal_mulai->caption() ?></span></td>
		<td data-name="tanggal_mulai" <?php echo $promo_view->tanggal_mulai->cellAttributes() ?>>
<span id="el_promo_tanggal_mulai">
<span<?php echo $promo_view->tanggal_mulai->viewAttributes() ?>><?php echo $promo_view->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($promo_view->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
	<tr id="r_tanggal_berakhir">
		<td class="<?php echo $promo_view->TableLeftColumnClass ?>"><span id="elh_promo_tanggal_berakhir"><?php echo $promo_view->tanggal_berakhir->caption() ?></span></td>
		<td data-name="tanggal_berakhir" <?php echo $promo_view->tanggal_berakhir->cellAttributes() ?>>
<span id="el_promo_tanggal_berakhir">
<span<?php echo $promo_view->tanggal_berakhir->viewAttributes() ?>><?php echo $promo_view->tanggal_berakhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailpromo", explode(",", $promo->getCurrentDetailTable())) && $detailpromo->DetailView) {
?>
<?php if ($promo->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpromo", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpromogrid.php" ?>
<?php } ?>
</form>
<?php
$promo_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$promo_view->isExport()) { ?>
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
$promo_view->terminate();
?>