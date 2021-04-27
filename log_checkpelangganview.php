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
$log_checkpelanggan_view = new log_checkpelanggan_view();

// Run the page
$log_checkpelanggan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_checkpelanggan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$log_checkpelanggan_view->isExport()) { ?>
<script>
var flog_checkpelangganview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flog_checkpelangganview = currentForm = new ew.Form("flog_checkpelangganview", "view");
	loadjs.done("flog_checkpelangganview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$log_checkpelanggan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $log_checkpelanggan_view->ExportOptions->render("body") ?>
<?php $log_checkpelanggan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $log_checkpelanggan_view->showPageHeader(); ?>
<?php
$log_checkpelanggan_view->showMessage();
?>
<form name="flog_checkpelangganview" id="flog_checkpelangganview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log_checkpelanggan">
<input type="hidden" name="modal" value="<?php echo (int)$log_checkpelanggan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($log_checkpelanggan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $log_checkpelanggan_view->TableLeftColumnClass ?>"><span id="elh_log_checkpelanggan_id"><?php echo $log_checkpelanggan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $log_checkpelanggan_view->id->cellAttributes() ?>>
<span id="el_log_checkpelanggan_id">
<span<?php echo $log_checkpelanggan_view->id->viewAttributes() ?>><?php echo $log_checkpelanggan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log_checkpelanggan_view->tglwaktu_update->Visible) { // tglwaktu_update ?>
	<tr id="r_tglwaktu_update">
		<td class="<?php echo $log_checkpelanggan_view->TableLeftColumnClass ?>"><span id="elh_log_checkpelanggan_tglwaktu_update"><?php echo $log_checkpelanggan_view->tglwaktu_update->caption() ?></span></td>
		<td data-name="tglwaktu_update" <?php echo $log_checkpelanggan_view->tglwaktu_update->cellAttributes() ?>>
<span id="el_log_checkpelanggan_tglwaktu_update">
<span<?php echo $log_checkpelanggan_view->tglwaktu_update->viewAttributes() ?>><?php echo $log_checkpelanggan_view->tglwaktu_update->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log_checkpelanggan_view->tgl_update->Visible) { // tgl_update ?>
	<tr id="r_tgl_update">
		<td class="<?php echo $log_checkpelanggan_view->TableLeftColumnClass ?>"><span id="elh_log_checkpelanggan_tgl_update"><?php echo $log_checkpelanggan_view->tgl_update->caption() ?></span></td>
		<td data-name="tgl_update" <?php echo $log_checkpelanggan_view->tgl_update->cellAttributes() ?>>
<span id="el_log_checkpelanggan_tgl_update">
<span<?php echo $log_checkpelanggan_view->tgl_update->viewAttributes() ?>><?php echo $log_checkpelanggan_view->tgl_update->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($log_checkpelanggan_view->id_user->Visible) { // id_user ?>
	<tr id="r_id_user">
		<td class="<?php echo $log_checkpelanggan_view->TableLeftColumnClass ?>"><span id="elh_log_checkpelanggan_id_user"><?php echo $log_checkpelanggan_view->id_user->caption() ?></span></td>
		<td data-name="id_user" <?php echo $log_checkpelanggan_view->id_user->cellAttributes() ?>>
<span id="el_log_checkpelanggan_id_user">
<span<?php echo $log_checkpelanggan_view->id_user->viewAttributes() ?>><?php echo $log_checkpelanggan_view->id_user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$log_checkpelanggan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$log_checkpelanggan_view->isExport()) { ?>
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
$log_checkpelanggan_view->terminate();
?>