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
$penyesuaianstok_view = new penyesuaianstok_view();

// Run the page
$penyesuaianstok_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaianstok_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penyesuaianstok_view->isExport()) { ?>
<script>
var fpenyesuaianstokview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpenyesuaianstokview = currentForm = new ew.Form("fpenyesuaianstokview", "view");
	loadjs.done("fpenyesuaianstokview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penyesuaianstok_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $penyesuaianstok_view->ExportOptions->render("body") ?>
<?php $penyesuaianstok_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $penyesuaianstok_view->showPageHeader(); ?>
<?php
$penyesuaianstok_view->showMessage();
?>
<form name="fpenyesuaianstokview" id="fpenyesuaianstokview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaianstok">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaianstok_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($penyesuaianstok_view->id_penyesuaianstok->Visible) { // id_penyesuaianstok ?>
	<tr id="r_id_penyesuaianstok">
		<td class="<?php echo $penyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_penyesuaianstok_id_penyesuaianstok"><?php echo $penyesuaianstok_view->id_penyesuaianstok->caption() ?></span></td>
		<td data-name="id_penyesuaianstok" <?php echo $penyesuaianstok_view->id_penyesuaianstok->cellAttributes() ?>>
<span id="el_penyesuaianstok_id_penyesuaianstok">
<span<?php echo $penyesuaianstok_view->id_penyesuaianstok->viewAttributes() ?>><?php echo $penyesuaianstok_view->id_penyesuaianstok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaianstok_view->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
	<tr id="r_kode_penyesuaian">
		<td class="<?php echo $penyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_penyesuaianstok_kode_penyesuaian"><?php echo $penyesuaianstok_view->kode_penyesuaian->caption() ?></span></td>
		<td data-name="kode_penyesuaian" <?php echo $penyesuaianstok_view->kode_penyesuaian->cellAttributes() ?>>
<span id="el_penyesuaianstok_kode_penyesuaian">
<span<?php echo $penyesuaianstok_view->kode_penyesuaian->viewAttributes() ?>><?php echo $penyesuaianstok_view->kode_penyesuaian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaianstok_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $penyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_penyesuaianstok_tanggal"><?php echo $penyesuaianstok_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $penyesuaianstok_view->tanggal->cellAttributes() ?>>
<span id="el_penyesuaianstok_tanggal">
<span<?php echo $penyesuaianstok_view->tanggal->viewAttributes() ?>><?php echo $penyesuaianstok_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaianstok_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $penyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_penyesuaianstok_id_klinik"><?php echo $penyesuaianstok_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $penyesuaianstok_view->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaianstok_id_klinik">
<span<?php echo $penyesuaianstok_view->id_klinik->viewAttributes() ?>><?php echo $penyesuaianstok_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaianstok_view->lampiran->Visible) { // lampiran ?>
	<tr id="r_lampiran">
		<td class="<?php echo $penyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_penyesuaianstok_lampiran"><?php echo $penyesuaianstok_view->lampiran->caption() ?></span></td>
		<td data-name="lampiran" <?php echo $penyesuaianstok_view->lampiran->cellAttributes() ?>>
<span id="el_penyesuaianstok_lampiran">
<span<?php echo $penyesuaianstok_view->lampiran->viewAttributes() ?>><?php echo GetFileViewTag($penyesuaianstok_view->lampiran, $penyesuaianstok_view->lampiran->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penyesuaianstok_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $penyesuaianstok_view->TableLeftColumnClass ?>"><span id="elh_penyesuaianstok_keterangan"><?php echo $penyesuaianstok_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $penyesuaianstok_view->keterangan->cellAttributes() ?>>
<span id="el_penyesuaianstok_keterangan">
<span<?php echo $penyesuaianstok_view->keterangan->viewAttributes() ?>><?php echo $penyesuaianstok_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailpenyesuaianstok", explode(",", $penyesuaianstok->getCurrentDetailTable())) && $detailpenyesuaianstok->DetailView) {
?>
<?php if ($penyesuaianstok->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenyesuaianstok", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $penyesuaianstok_view->detailpenyesuaianstok_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailpenyesuaianstokgrid.php" ?>
<?php } ?>
</form>
<?php
$penyesuaianstok_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penyesuaianstok_view->isExport()) { ?>
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
$penyesuaianstok_view->terminate();
?>