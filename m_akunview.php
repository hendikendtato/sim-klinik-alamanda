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
$m_akun_view = new m_akun_view();

// Run the page
$m_akun_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_akun_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_akun_view->isExport()) { ?>
<script>
var fm_akunview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_akunview = currentForm = new ew.Form("fm_akunview", "view");
	loadjs.done("fm_akunview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_akun_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_akun_view->ExportOptions->render("body") ?>
<?php $m_akun_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_akun_view->showPageHeader(); ?>
<?php
$m_akun_view->showMessage();
?>
<form name="fm_akunview" id="fm_akunview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_akun">
<input type="hidden" name="modal" value="<?php echo (int)$m_akun_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_akun_view->id_akun->Visible) { // id_akun ?>
	<tr id="r_id_akun">
		<td class="<?php echo $m_akun_view->TableLeftColumnClass ?>"><span id="elh_m_akun_id_akun"><?php echo $m_akun_view->id_akun->caption() ?></span></td>
		<td data-name="id_akun" <?php echo $m_akun_view->id_akun->cellAttributes() ?>>
<span id="el_m_akun_id_akun">
<span<?php echo $m_akun_view->id_akun->viewAttributes() ?>><?php echo $m_akun_view->id_akun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_akun_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_akun_view->TableLeftColumnClass ?>"><span id="elh_m_akun_id_klinik"><?php echo $m_akun_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_akun_view->id_klinik->cellAttributes() ?>>
<span id="el_m_akun_id_klinik">
<span<?php echo $m_akun_view->id_klinik->viewAttributes() ?>><?php echo $m_akun_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_akun_view->kode_akun->Visible) { // kode_akun ?>
	<tr id="r_kode_akun">
		<td class="<?php echo $m_akun_view->TableLeftColumnClass ?>"><span id="elh_m_akun_kode_akun"><?php echo $m_akun_view->kode_akun->caption() ?></span></td>
		<td data-name="kode_akun" <?php echo $m_akun_view->kode_akun->cellAttributes() ?>>
<span id="el_m_akun_kode_akun">
<span<?php echo $m_akun_view->kode_akun->viewAttributes() ?>><?php echo $m_akun_view->kode_akun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_akun_view->nama_akun->Visible) { // nama_akun ?>
	<tr id="r_nama_akun">
		<td class="<?php echo $m_akun_view->TableLeftColumnClass ?>"><span id="elh_m_akun_nama_akun"><?php echo $m_akun_view->nama_akun->caption() ?></span></td>
		<td data-name="nama_akun" <?php echo $m_akun_view->nama_akun->cellAttributes() ?>>
<span id="el_m_akun_nama_akun">
<span<?php echo $m_akun_view->nama_akun->viewAttributes() ?>><?php echo $m_akun_view->nama_akun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_akun_view->tipe_akun->Visible) { // tipe_akun ?>
	<tr id="r_tipe_akun">
		<td class="<?php echo $m_akun_view->TableLeftColumnClass ?>"><span id="elh_m_akun_tipe_akun"><?php echo $m_akun_view->tipe_akun->caption() ?></span></td>
		<td data-name="tipe_akun" <?php echo $m_akun_view->tipe_akun->cellAttributes() ?>>
<span id="el_m_akun_tipe_akun">
<span<?php echo $m_akun_view->tipe_akun->viewAttributes() ?>><?php echo $m_akun_view->tipe_akun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_akun_view->saldo->Visible) { // saldo ?>
	<tr id="r_saldo">
		<td class="<?php echo $m_akun_view->TableLeftColumnClass ?>"><span id="elh_m_akun_saldo"><?php echo $m_akun_view->saldo->caption() ?></span></td>
		<td data-name="saldo" <?php echo $m_akun_view->saldo->cellAttributes() ?>>
<span id="el_m_akun_saldo">
<span<?php echo $m_akun_view->saldo->viewAttributes() ?>><?php echo $m_akun_view->saldo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_akun_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_akun_view->isExport()) { ?>
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
$m_akun_view->terminate();
?>