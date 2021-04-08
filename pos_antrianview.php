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
$pos_antrian_view = new pos_antrian_view();

// Run the page
$pos_antrian_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pos_antrian_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pos_antrian_view->isExport()) { ?>
<script>
var fpos_antrianview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpos_antrianview = currentForm = new ew.Form("fpos_antrianview", "view");
	loadjs.done("fpos_antrianview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pos_antrian_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pos_antrian_view->ExportOptions->render("body") ?>
<?php $pos_antrian_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pos_antrian_view->showPageHeader(); ?>
<?php
$pos_antrian_view->showMessage();
?>
<form name="fpos_antrianview" id="fpos_antrianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pos_antrian">
<input type="hidden" name="modal" value="<?php echo (int)$pos_antrian_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pos_antrian_view->id_pos_antrian->Visible) { // id_pos_antrian ?>
	<tr id="r_id_pos_antrian">
		<td class="<?php echo $pos_antrian_view->TableLeftColumnClass ?>"><span id="elh_pos_antrian_id_pos_antrian"><?php echo $pos_antrian_view->id_pos_antrian->caption() ?></span></td>
		<td data-name="id_pos_antrian" <?php echo $pos_antrian_view->id_pos_antrian->cellAttributes() ?>>
<span id="el_pos_antrian_id_pos_antrian">
<span<?php echo $pos_antrian_view->id_pos_antrian->viewAttributes() ?>><?php echo $pos_antrian_view->id_pos_antrian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pos_antrian_view->nama_pos->Visible) { // nama_pos ?>
	<tr id="r_nama_pos">
		<td class="<?php echo $pos_antrian_view->TableLeftColumnClass ?>"><span id="elh_pos_antrian_nama_pos"><?php echo $pos_antrian_view->nama_pos->caption() ?></span></td>
		<td data-name="nama_pos" <?php echo $pos_antrian_view->nama_pos->cellAttributes() ?>>
<span id="el_pos_antrian_nama_pos">
<span<?php echo $pos_antrian_view->nama_pos->viewAttributes() ?>><?php echo $pos_antrian_view->nama_pos->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pos_antrian_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pos_antrian_view->isExport()) { ?>
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
$pos_antrian_view->terminate();
?>