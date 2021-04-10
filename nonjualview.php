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
$nonjual_view = new nonjual_view();

// Run the page
$nonjual_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nonjual_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$nonjual_view->isExport()) { ?>
<script>
var fnonjualview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fnonjualview = currentForm = new ew.Form("fnonjualview", "view");
	loadjs.done("fnonjualview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$nonjual_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $nonjual_view->ExportOptions->render("body") ?>
<?php $nonjual_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $nonjual_view->showPageHeader(); ?>
<?php
$nonjual_view->showMessage();
?>
<form name="fnonjualview" id="fnonjualview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nonjual">
<input type="hidden" name="modal" value="<?php echo (int)$nonjual_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($nonjual_view->id_nonjual->Visible) { // id_nonjual ?>
	<tr id="r_id_nonjual">
		<td class="<?php echo $nonjual_view->TableLeftColumnClass ?>"><span id="elh_nonjual_id_nonjual"><?php echo $nonjual_view->id_nonjual->caption() ?></span></td>
		<td data-name="id_nonjual" <?php echo $nonjual_view->id_nonjual->cellAttributes() ?>>
<span id="el_nonjual_id_nonjual">
<span<?php echo $nonjual_view->id_nonjual->viewAttributes() ?>><?php echo $nonjual_view->id_nonjual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($nonjual_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $nonjual_view->TableLeftColumnClass ?>"><span id="elh_nonjual_id_klinik"><?php echo $nonjual_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $nonjual_view->id_klinik->cellAttributes() ?>>
<span id="el_nonjual_id_klinik">
<span<?php echo $nonjual_view->id_klinik->viewAttributes() ?>><?php echo $nonjual_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($nonjual_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $nonjual_view->TableLeftColumnClass ?>"><span id="elh_nonjual_tanggal"><?php echo $nonjual_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $nonjual_view->tanggal->cellAttributes() ?>>
<span id="el_nonjual_tanggal">
<span<?php echo $nonjual_view->tanggal->viewAttributes() ?>><?php echo $nonjual_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($nonjual_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $nonjual_view->TableLeftColumnClass ?>"><span id="elh_nonjual_keterangan"><?php echo $nonjual_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $nonjual_view->keterangan->cellAttributes() ?>>
<span id="el_nonjual_keterangan">
<span<?php echo $nonjual_view->keterangan->viewAttributes() ?>><?php echo $nonjual_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detail_nonjual", explode(",", $nonjual->getCurrentDetailTable())) && $detail_nonjual->DetailView) {
?>
<?php if ($nonjual->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detail_nonjual", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detail_nonjualgrid.php" ?>
<?php } ?>
</form>
<?php
$nonjual_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$nonjual_view->isExport()) { ?>
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
$nonjual_view->terminate();
?>