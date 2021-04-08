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
$mutasi_kas_view = new mutasi_kas_view();

// Run the page
$mutasi_kas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mutasi_kas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mutasi_kas_view->isExport()) { ?>
<script>
var fmutasi_kasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmutasi_kasview = currentForm = new ew.Form("fmutasi_kasview", "view");
	loadjs.done("fmutasi_kasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mutasi_kas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $mutasi_kas_view->ExportOptions->render("body") ?>
<?php $mutasi_kas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $mutasi_kas_view->showPageHeader(); ?>
<?php
$mutasi_kas_view->showMessage();
?>
<form name="fmutasi_kasview" id="fmutasi_kasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mutasi_kas">
<input type="hidden" name="modal" value="<?php echo (int)$mutasi_kas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($mutasi_kas_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $mutasi_kas_view->TableLeftColumnClass ?>"><span id="elh_mutasi_kas_tgl"><?php echo $mutasi_kas_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $mutasi_kas_view->tgl->cellAttributes() ?>>
<span id="el_mutasi_kas_tgl">
<span<?php echo $mutasi_kas_view->tgl->viewAttributes() ?>><?php echo $mutasi_kas_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mutasi_kas_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $mutasi_kas_view->TableLeftColumnClass ?>"><span id="elh_mutasi_kas_id_klinik"><?php echo $mutasi_kas_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $mutasi_kas_view->id_klinik->cellAttributes() ?>>
<span id="el_mutasi_kas_id_klinik">
<span<?php echo $mutasi_kas_view->id_klinik->viewAttributes() ?>><?php echo $mutasi_kas_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mutasi_kas_view->id_kas->Visible) { // id_kas ?>
	<tr id="r_id_kas">
		<td class="<?php echo $mutasi_kas_view->TableLeftColumnClass ?>"><span id="elh_mutasi_kas_id_kas"><?php echo $mutasi_kas_view->id_kas->caption() ?></span></td>
		<td data-name="id_kas" <?php echo $mutasi_kas_view->id_kas->cellAttributes() ?>>
<span id="el_mutasi_kas_id_kas">
<span<?php echo $mutasi_kas_view->id_kas->viewAttributes() ?>><?php echo $mutasi_kas_view->id_kas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mutasi_kas_view->tipe->Visible) { // tipe ?>
	<tr id="r_tipe">
		<td class="<?php echo $mutasi_kas_view->TableLeftColumnClass ?>"><span id="elh_mutasi_kas_tipe"><?php echo $mutasi_kas_view->tipe->caption() ?></span></td>
		<td data-name="tipe" <?php echo $mutasi_kas_view->tipe->cellAttributes() ?>>
<span id="el_mutasi_kas_tipe">
<span<?php echo $mutasi_kas_view->tipe->viewAttributes() ?>><?php echo $mutasi_kas_view->tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mutasi_kas_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $mutasi_kas_view->TableLeftColumnClass ?>"><span id="elh_mutasi_kas_keterangan"><?php echo $mutasi_kas_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $mutasi_kas_view->keterangan->cellAttributes() ?>>
<span id="el_mutasi_kas_keterangan">
<span<?php echo $mutasi_kas_view->keterangan->viewAttributes() ?>><?php echo $mutasi_kas_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailmutasibank", explode(",", $mutasi_kas->getCurrentDetailTable())) && $detailmutasibank->DetailView) {
?>
<?php if ($mutasi_kas->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailmutasibank", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $mutasi_kas_view->detailmutasibank_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailmutasibankgrid.php" ?>
<?php } ?>
</form>
<?php
$mutasi_kas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mutasi_kas_view->isExport()) { ?>
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
$mutasi_kas_view->terminate();
?>