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
$jurnal_view = new jurnal_view();

// Run the page
$jurnal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jurnal_view->isExport()) { ?>
<script>
var fjurnalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjurnalview = currentForm = new ew.Form("fjurnalview", "view");
	loadjs.done("fjurnalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jurnal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jurnal_view->ExportOptions->render("body") ?>
<?php $jurnal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jurnal_view->showPageHeader(); ?>
<?php
$jurnal_view->showMessage();
?>
<form name="fjurnalview" id="fjurnalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="modal" value="<?php echo (int)$jurnal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jurnal_view->id_jurnal->Visible) { // id_jurnal ?>
	<tr id="r_id_jurnal">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_id_jurnal"><?php echo $jurnal_view->id_jurnal->caption() ?></span></td>
		<td data-name="id_jurnal" <?php echo $jurnal_view->id_jurnal->cellAttributes() ?>>
<span id="el_jurnal_id_jurnal">
<span<?php echo $jurnal_view->id_jurnal->viewAttributes() ?>><?php echo $jurnal_view->id_jurnal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->tgl_jurnal->Visible) { // tgl_jurnal ?>
	<tr id="r_tgl_jurnal">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_tgl_jurnal"><?php echo $jurnal_view->tgl_jurnal->caption() ?></span></td>
		<td data-name="tgl_jurnal" <?php echo $jurnal_view->tgl_jurnal->cellAttributes() ?>>
<span id="el_jurnal_tgl_jurnal">
<span<?php echo $jurnal_view->tgl_jurnal->viewAttributes() ?>><?php echo $jurnal_view->tgl_jurnal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jurnal_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $jurnal_view->TableLeftColumnClass ?>"><span id="elh_jurnal_keterangan"><?php echo $jurnal_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $jurnal_view->keterangan->cellAttributes() ?>>
<span id="el_jurnal_keterangan">
<span<?php echo $jurnal_view->keterangan->viewAttributes() ?>><?php echo $jurnal_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailjurnal", explode(",", $jurnal->getCurrentDetailTable())) && $detailjurnal->DetailView) {
?>
<?php if ($jurnal->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailjurnal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailjurnalgrid.php" ?>
<?php } ?>
</form>
<?php
$jurnal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jurnal_view->isExport()) { ?>
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
$jurnal_view->terminate();
?>