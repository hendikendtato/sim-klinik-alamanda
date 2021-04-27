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
$m_kas_view = new m_kas_view();

// Run the page
$m_kas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kas_view->isExport()) { ?>
<script>
var fm_kasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_kasview = currentForm = new ew.Form("fm_kasview", "view");
	loadjs.done("fm_kasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_kas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_kas_view->ExportOptions->render("body") ?>
<?php $m_kas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_kas_view->showPageHeader(); ?>
<?php
$m_kas_view->showMessage();
?>
<form name="fm_kasview" id="fm_kasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kas">
<input type="hidden" name="modal" value="<?php echo (int)$m_kas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_kas_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_kas_view->TableLeftColumnClass ?>"><span id="elh_m_kas_id"><?php echo $m_kas_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_kas_view->id->cellAttributes() ?>>
<span id="el_m_kas_id">
<span<?php echo $m_kas_view->id->viewAttributes() ?>><?php echo $m_kas_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kas_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_kas_view->TableLeftColumnClass ?>"><span id="elh_m_kas_id_klinik"><?php echo $m_kas_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_kas_view->id_klinik->cellAttributes() ?>>
<span id="el_m_kas_id_klinik">
<span<?php echo $m_kas_view->id_klinik->viewAttributes() ?>><?php echo $m_kas_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kas_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $m_kas_view->TableLeftColumnClass ?>"><span id="elh_m_kas_nama"><?php echo $m_kas_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $m_kas_view->nama->cellAttributes() ?>>
<span id="el_m_kas_nama">
<span<?php echo $m_kas_view->nama->viewAttributes() ?>><?php echo $m_kas_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kas_view->saldo->Visible) { // saldo ?>
	<tr id="r_saldo">
		<td class="<?php echo $m_kas_view->TableLeftColumnClass ?>"><span id="elh_m_kas_saldo"><?php echo $m_kas_view->saldo->caption() ?></span></td>
		<td data-name="saldo" <?php echo $m_kas_view->saldo->cellAttributes() ?>>
<span id="el_m_kas_saldo">
<span<?php echo $m_kas_view->saldo->viewAttributes() ?>><?php echo $m_kas_view->saldo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_kas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kas_view->isExport()) { ?>
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
$m_kas_view->terminate();
?>