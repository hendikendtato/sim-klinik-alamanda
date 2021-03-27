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
$detailjurnal_view = new detailjurnal_view();

// Run the page
$detailjurnal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailjurnal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailjurnal_view->isExport()) { ?>
<script>
var fdetailjurnalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailjurnalview = currentForm = new ew.Form("fdetailjurnalview", "view");
	loadjs.done("fdetailjurnalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailjurnal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailjurnal_view->ExportOptions->render("body") ?>
<?php $detailjurnal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailjurnal_view->showPageHeader(); ?>
<?php
$detailjurnal_view->showMessage();
?>
<form name="fdetailjurnalview" id="fdetailjurnalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailjurnal">
<input type="hidden" name="modal" value="<?php echo (int)$detailjurnal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailjurnal_view->id_detailjurnal->Visible) { // id_detailjurnal ?>
	<tr id="r_id_detailjurnal">
		<td class="<?php echo $detailjurnal_view->TableLeftColumnClass ?>"><span id="elh_detailjurnal_id_detailjurnal"><?php echo $detailjurnal_view->id_detailjurnal->caption() ?></span></td>
		<td data-name="id_detailjurnal" <?php echo $detailjurnal_view->id_detailjurnal->cellAttributes() ?>>
<span id="el_detailjurnal_id_detailjurnal">
<span<?php echo $detailjurnal_view->id_detailjurnal->viewAttributes() ?>><?php echo $detailjurnal_view->id_detailjurnal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailjurnal_view->id_jurnal->Visible) { // id_jurnal ?>
	<tr id="r_id_jurnal">
		<td class="<?php echo $detailjurnal_view->TableLeftColumnClass ?>"><span id="elh_detailjurnal_id_jurnal"><?php echo $detailjurnal_view->id_jurnal->caption() ?></span></td>
		<td data-name="id_jurnal" <?php echo $detailjurnal_view->id_jurnal->cellAttributes() ?>>
<span id="el_detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_view->id_jurnal->viewAttributes() ?>><?php echo $detailjurnal_view->id_jurnal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailjurnal_view->id_akun->Visible) { // id_akun ?>
	<tr id="r_id_akun">
		<td class="<?php echo $detailjurnal_view->TableLeftColumnClass ?>"><span id="elh_detailjurnal_id_akun"><?php echo $detailjurnal_view->id_akun->caption() ?></span></td>
		<td data-name="id_akun" <?php echo $detailjurnal_view->id_akun->cellAttributes() ?>>
<span id="el_detailjurnal_id_akun">
<span<?php echo $detailjurnal_view->id_akun->viewAttributes() ?>><?php echo $detailjurnal_view->id_akun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailjurnal_view->debet->Visible) { // debet ?>
	<tr id="r_debet">
		<td class="<?php echo $detailjurnal_view->TableLeftColumnClass ?>"><span id="elh_detailjurnal_debet"><?php echo $detailjurnal_view->debet->caption() ?></span></td>
		<td data-name="debet" <?php echo $detailjurnal_view->debet->cellAttributes() ?>>
<span id="el_detailjurnal_debet">
<span<?php echo $detailjurnal_view->debet->viewAttributes() ?>><?php echo $detailjurnal_view->debet->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailjurnal_view->kredit->Visible) { // kredit ?>
	<tr id="r_kredit">
		<td class="<?php echo $detailjurnal_view->TableLeftColumnClass ?>"><span id="elh_detailjurnal_kredit"><?php echo $detailjurnal_view->kredit->caption() ?></span></td>
		<td data-name="kredit" <?php echo $detailjurnal_view->kredit->cellAttributes() ?>>
<span id="el_detailjurnal_kredit">
<span<?php echo $detailjurnal_view->kredit->viewAttributes() ?>><?php echo $detailjurnal_view->kredit->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailjurnal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailjurnal_view->isExport()) { ?>
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
$detailjurnal_view->terminate();
?>