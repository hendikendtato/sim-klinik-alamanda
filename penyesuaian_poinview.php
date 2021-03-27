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
$penyesuaian_poin_view = new penyesuaian_poin_view();

// Run the page
$penyesuaian_poin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaian_poin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penyesuaian_poin_view->isExport()) { ?>
<script>
var fpenyesuaian_poinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpenyesuaian_poinview = currentForm = new ew.Form("fpenyesuaian_poinview", "view");
	loadjs.done("fpenyesuaian_poinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penyesuaian_poin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $penyesuaian_poin_view->ExportOptions->render("body") ?>
<?php $penyesuaian_poin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $penyesuaian_poin_view->showPageHeader(); ?>
<?php
$penyesuaian_poin_view->showMessage();
?>
<form name="fpenyesuaian_poinview" id="fpenyesuaian_poinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaian_poin">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaian_poin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($penyesuaian_poin_view->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
	<tr id="r_kode_penyesuaianpoin">
		<td class="<?php echo $penyesuaian_poin_view->TableLeftColumnClass ?>"><span id="elh_penyesuaian_poin_kode_penyesuaianpoin"><?php echo $penyesuaian_poin_view->kode_penyesuaianpoin->caption() ?></span></td>
		<td data-name="kode_penyesuaianpoin" <?php echo $penyesuaian_poin_view->kode_penyesuaianpoin->cellAttributes() ?>>
<span id="el_penyesuaian_poin_kode_penyesuaianpoin">
<span<?php echo $penyesuaian_poin_view->kode_penyesuaianpoin->viewAttributes() ?>><?php echo $penyesuaian_poin_view->kode_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaian_poin_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $penyesuaian_poin_view->TableLeftColumnClass ?>"><span id="elh_penyesuaian_poin_id_klinik"><?php echo $penyesuaian_poin_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $penyesuaian_poin_view->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaian_poin_id_klinik">
<span<?php echo $penyesuaian_poin_view->id_klinik->viewAttributes() ?>><?php echo $penyesuaian_poin_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaian_poin_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $penyesuaian_poin_view->TableLeftColumnClass ?>"><span id="elh_penyesuaian_poin_tgl"><?php echo $penyesuaian_poin_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $penyesuaian_poin_view->tgl->cellAttributes() ?>>
<span id="el_penyesuaian_poin_tgl">
<span<?php echo $penyesuaian_poin_view->tgl->viewAttributes() ?>><?php echo $penyesuaian_poin_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailpenyesuaianpoin", explode(",", $penyesuaian_poin->getCurrentDetailTable())) && $detailpenyesuaianpoin->DetailView) {
?>
<?php if ($penyesuaian_poin->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenyesuaianpoin", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpenyesuaianpoingrid.php" ?>
<?php } ?>
</form>
<?php
$penyesuaian_poin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penyesuaian_poin_view->isExport()) { ?>
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
$penyesuaian_poin_view->terminate();
?>