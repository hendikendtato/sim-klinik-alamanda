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
$m_rekening_view = new m_rekening_view();

// Run the page
$m_rekening_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_rekening_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_rekening_view->isExport()) { ?>
<script>
var fm_rekeningview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_rekeningview = currentForm = new ew.Form("fm_rekeningview", "view");
	loadjs.done("fm_rekeningview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_rekening_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_rekening_view->ExportOptions->render("body") ?>
<?php $m_rekening_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_rekening_view->showPageHeader(); ?>
<?php
$m_rekening_view->showMessage();
?>
<form name="fm_rekeningview" id="fm_rekeningview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_rekening">
<input type="hidden" name="modal" value="<?php echo (int)$m_rekening_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_rekening_view->id_bank->Visible) { // id_bank ?>
	<tr id="r_id_bank">
		<td class="<?php echo $m_rekening_view->TableLeftColumnClass ?>"><span id="elh_m_rekening_id_bank"><?php echo $m_rekening_view->id_bank->caption() ?></span></td>
		<td data-name="id_bank" <?php echo $m_rekening_view->id_bank->cellAttributes() ?>>
<span id="el_m_rekening_id_bank">
<span<?php echo $m_rekening_view->id_bank->viewAttributes() ?>><?php echo $m_rekening_view->id_bank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_rekening_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_rekening_view->TableLeftColumnClass ?>"><span id="elh_m_rekening_id_klinik"><?php echo $m_rekening_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_rekening_view->id_klinik->cellAttributes() ?>>
<span id="el_m_rekening_id_klinik">
<span<?php echo $m_rekening_view->id_klinik->viewAttributes() ?>><?php echo $m_rekening_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_rekening_view->nama_rekening->Visible) { // nama_rekening ?>
	<tr id="r_nama_rekening">
		<td class="<?php echo $m_rekening_view->TableLeftColumnClass ?>"><span id="elh_m_rekening_nama_rekening"><?php echo $m_rekening_view->nama_rekening->caption() ?></span></td>
		<td data-name="nama_rekening" <?php echo $m_rekening_view->nama_rekening->cellAttributes() ?>>
<span id="el_m_rekening_nama_rekening">
<span<?php echo $m_rekening_view->nama_rekening->viewAttributes() ?>><?php echo $m_rekening_view->nama_rekening->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_rekening_view->nomor_rekening->Visible) { // nomor_rekening ?>
	<tr id="r_nomor_rekening">
		<td class="<?php echo $m_rekening_view->TableLeftColumnClass ?>"><span id="elh_m_rekening_nomor_rekening"><?php echo $m_rekening_view->nomor_rekening->caption() ?></span></td>
		<td data-name="nomor_rekening" <?php echo $m_rekening_view->nomor_rekening->cellAttributes() ?>>
<span id="el_m_rekening_nomor_rekening">
<span<?php echo $m_rekening_view->nomor_rekening->viewAttributes() ?>><?php echo $m_rekening_view->nomor_rekening->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_rekening_view->saldo->Visible) { // saldo ?>
	<tr id="r_saldo">
		<td class="<?php echo $m_rekening_view->TableLeftColumnClass ?>"><span id="elh_m_rekening_saldo"><?php echo $m_rekening_view->saldo->caption() ?></span></td>
		<td data-name="saldo" <?php echo $m_rekening_view->saldo->cellAttributes() ?>>
<span id="el_m_rekening_saldo">
<span<?php echo $m_rekening_view->saldo->viewAttributes() ?>><?php echo $m_rekening_view->saldo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_rekening_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_rekening_view->isExport()) { ?>
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
$m_rekening_view->terminate();
?>