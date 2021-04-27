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
$m_fee_view = new m_fee_view();

// Run the page
$m_fee_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_fee_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_fee_view->isExport()) { ?>
<script>
var fm_feeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_feeview = currentForm = new ew.Form("fm_feeview", "view");
	loadjs.done("fm_feeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_fee_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_fee_view->ExportOptions->render("body") ?>
<?php $m_fee_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_fee_view->showPageHeader(); ?>
<?php
$m_fee_view->showMessage();
?>
<form name="fm_feeview" id="fm_feeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_fee">
<input type="hidden" name="modal" value="<?php echo (int)$m_fee_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_fee_view->id_fee->Visible) { // id_fee ?>
	<tr id="r_id_fee">
		<td class="<?php echo $m_fee_view->TableLeftColumnClass ?>"><span id="elh_m_fee_id_fee"><?php echo $m_fee_view->id_fee->caption() ?></span></td>
		<td data-name="id_fee" <?php echo $m_fee_view->id_fee->cellAttributes() ?>>
<span id="el_m_fee_id_fee">
<span<?php echo $m_fee_view->id_fee->viewAttributes() ?>><?php echo $m_fee_view->id_fee->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_fee_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $m_fee_view->TableLeftColumnClass ?>"><span id="elh_m_fee_id_barang"><?php echo $m_fee_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $m_fee_view->id_barang->cellAttributes() ?>>
<span id="el_m_fee_id_barang">
<span<?php echo $m_fee_view->id_barang->viewAttributes() ?>><?php echo $m_fee_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_fee_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $m_fee_view->TableLeftColumnClass ?>"><span id="elh_m_fee_id_pegawai"><?php echo $m_fee_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $m_fee_view->id_pegawai->cellAttributes() ?>>
<span id="el_m_fee_id_pegawai">
<span<?php echo $m_fee_view->id_pegawai->viewAttributes() ?>><?php echo $m_fee_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_fee_view->prosentase->Visible) { // prosentase ?>
	<tr id="r_prosentase">
		<td class="<?php echo $m_fee_view->TableLeftColumnClass ?>"><span id="elh_m_fee_prosentase"><?php echo $m_fee_view->prosentase->caption() ?></span></td>
		<td data-name="prosentase" <?php echo $m_fee_view->prosentase->cellAttributes() ?>>
<span id="el_m_fee_prosentase">
<span<?php echo $m_fee_view->prosentase->viewAttributes() ?>><?php echo $m_fee_view->prosentase->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_fee_view->id_hargajual->Visible) { // id_hargajual ?>
	<tr id="r_id_hargajual">
		<td class="<?php echo $m_fee_view->TableLeftColumnClass ?>"><span id="elh_m_fee_id_hargajual"><?php echo $m_fee_view->id_hargajual->caption() ?></span></td>
		<td data-name="id_hargajual" <?php echo $m_fee_view->id_hargajual->cellAttributes() ?>>
<span id="el_m_fee_id_hargajual">
<span<?php echo $m_fee_view->id_hargajual->viewAttributes() ?>><?php echo $m_fee_view->id_hargajual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_fee_view->id_jenispegawai->Visible) { // id_jenispegawai ?>
	<tr id="r_id_jenispegawai">
		<td class="<?php echo $m_fee_view->TableLeftColumnClass ?>"><span id="elh_m_fee_id_jenispegawai"><?php echo $m_fee_view->id_jenispegawai->caption() ?></span></td>
		<td data-name="id_jenispegawai" <?php echo $m_fee_view->id_jenispegawai->cellAttributes() ?>>
<span id="el_m_fee_id_jenispegawai">
<span<?php echo $m_fee_view->id_jenispegawai->viewAttributes() ?>><?php echo $m_fee_view->id_jenispegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_fee_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_fee_view->isExport()) { ?>
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
$m_fee_view->terminate();
?>