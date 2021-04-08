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
$m_klinik_view = new m_klinik_view();

// Run the page
$m_klinik_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_klinik_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_klinik_view->isExport()) { ?>
<script>
var fm_klinikview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_klinikview = currentForm = new ew.Form("fm_klinikview", "view");
	loadjs.done("fm_klinikview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_klinik_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_klinik_view->ExportOptions->render("body") ?>
<?php $m_klinik_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_klinik_view->showPageHeader(); ?>
<?php
$m_klinik_view->showMessage();
?>
<form name="fm_klinikview" id="fm_klinikview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_klinik">
<input type="hidden" name="modal" value="<?php echo (int)$m_klinik_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_klinik_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_klinik_view->TableLeftColumnClass ?>"><span id="elh_m_klinik_id_klinik"><?php echo $m_klinik_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_klinik_view->id_klinik->cellAttributes() ?>>
<span id="el_m_klinik_id_klinik">
<span<?php echo $m_klinik_view->id_klinik->viewAttributes() ?>><?php echo $m_klinik_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_klinik_view->nama_klinik->Visible) { // nama_klinik ?>
	<tr id="r_nama_klinik">
		<td class="<?php echo $m_klinik_view->TableLeftColumnClass ?>"><span id="elh_m_klinik_nama_klinik"><?php echo $m_klinik_view->nama_klinik->caption() ?></span></td>
		<td data-name="nama_klinik" <?php echo $m_klinik_view->nama_klinik->cellAttributes() ?>>
<span id="el_m_klinik_nama_klinik">
<span<?php echo $m_klinik_view->nama_klinik->viewAttributes() ?>><?php echo $m_klinik_view->nama_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_klinik_view->telpon_klinik->Visible) { // telpon_klinik ?>
	<tr id="r_telpon_klinik">
		<td class="<?php echo $m_klinik_view->TableLeftColumnClass ?>"><span id="elh_m_klinik_telpon_klinik"><?php echo $m_klinik_view->telpon_klinik->caption() ?></span></td>
		<td data-name="telpon_klinik" <?php echo $m_klinik_view->telpon_klinik->cellAttributes() ?>>
<span id="el_m_klinik_telpon_klinik">
<span<?php echo $m_klinik_view->telpon_klinik->viewAttributes() ?>><?php echo $m_klinik_view->telpon_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_klinik_view->alamat_klinik->Visible) { // alamat_klinik ?>
	<tr id="r_alamat_klinik">
		<td class="<?php echo $m_klinik_view->TableLeftColumnClass ?>"><span id="elh_m_klinik_alamat_klinik"><?php echo $m_klinik_view->alamat_klinik->caption() ?></span></td>
		<td data-name="alamat_klinik" <?php echo $m_klinik_view->alamat_klinik->cellAttributes() ?>>
<span id="el_m_klinik_alamat_klinik">
<span<?php echo $m_klinik_view->alamat_klinik->viewAttributes() ?>><?php echo $m_klinik_view->alamat_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_klinik_view->foto_klinik->Visible) { // foto_klinik ?>
	<tr id="r_foto_klinik">
		<td class="<?php echo $m_klinik_view->TableLeftColumnClass ?>"><span id="elh_m_klinik_foto_klinik"><?php echo $m_klinik_view->foto_klinik->caption() ?></span></td>
		<td data-name="foto_klinik" <?php echo $m_klinik_view->foto_klinik->cellAttributes() ?>>
<span id="el_m_klinik_foto_klinik">
<span<?php echo $m_klinik_view->foto_klinik->viewAttributes() ?>><?php echo $m_klinik_view->foto_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_klinik_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_klinik_view->isExport()) { ?>
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
$m_klinik_view->terminate();
?>