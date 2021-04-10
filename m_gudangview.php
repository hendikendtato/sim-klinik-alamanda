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
$m_gudang_view = new m_gudang_view();

// Run the page
$m_gudang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_gudang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_gudang_view->isExport()) { ?>
<script>
var fm_gudangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_gudangview = currentForm = new ew.Form("fm_gudangview", "view");
	loadjs.done("fm_gudangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_gudang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_gudang_view->ExportOptions->render("body") ?>
<?php $m_gudang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_gudang_view->showPageHeader(); ?>
<?php
$m_gudang_view->showMessage();
?>
<form name="fm_gudangview" id="fm_gudangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_gudang">
<input type="hidden" name="modal" value="<?php echo (int)$m_gudang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_gudang_view->id_gudang->Visible) { // id_gudang ?>
	<tr id="r_id_gudang">
		<td class="<?php echo $m_gudang_view->TableLeftColumnClass ?>"><span id="elh_m_gudang_id_gudang"><?php echo $m_gudang_view->id_gudang->caption() ?></span></td>
		<td data-name="id_gudang" <?php echo $m_gudang_view->id_gudang->cellAttributes() ?>>
<span id="el_m_gudang_id_gudang">
<span<?php echo $m_gudang_view->id_gudang->viewAttributes() ?>><?php echo $m_gudang_view->id_gudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_gudang_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_gudang_view->TableLeftColumnClass ?>"><span id="elh_m_gudang_id_klinik"><?php echo $m_gudang_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_gudang_view->id_klinik->cellAttributes() ?>>
<span id="el_m_gudang_id_klinik">
<span<?php echo $m_gudang_view->id_klinik->viewAttributes() ?>><?php echo $m_gudang_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_gudang_view->kode_gudang->Visible) { // kode_gudang ?>
	<tr id="r_kode_gudang">
		<td class="<?php echo $m_gudang_view->TableLeftColumnClass ?>"><span id="elh_m_gudang_kode_gudang"><?php echo $m_gudang_view->kode_gudang->caption() ?></span></td>
		<td data-name="kode_gudang" <?php echo $m_gudang_view->kode_gudang->cellAttributes() ?>>
<span id="el_m_gudang_kode_gudang">
<span<?php echo $m_gudang_view->kode_gudang->viewAttributes() ?>><?php echo $m_gudang_view->kode_gudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_gudang_view->nama_gudang->Visible) { // nama_gudang ?>
	<tr id="r_nama_gudang">
		<td class="<?php echo $m_gudang_view->TableLeftColumnClass ?>"><span id="elh_m_gudang_nama_gudang"><?php echo $m_gudang_view->nama_gudang->caption() ?></span></td>
		<td data-name="nama_gudang" <?php echo $m_gudang_view->nama_gudang->cellAttributes() ?>>
<span id="el_m_gudang_nama_gudang">
<span<?php echo $m_gudang_view->nama_gudang->viewAttributes() ?>><?php echo $m_gudang_view->nama_gudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_gudang_view->lokasi_gudang->Visible) { // lokasi_gudang ?>
	<tr id="r_lokasi_gudang">
		<td class="<?php echo $m_gudang_view->TableLeftColumnClass ?>"><span id="elh_m_gudang_lokasi_gudang"><?php echo $m_gudang_view->lokasi_gudang->caption() ?></span></td>
		<td data-name="lokasi_gudang" <?php echo $m_gudang_view->lokasi_gudang->cellAttributes() ?>>
<span id="el_m_gudang_lokasi_gudang">
<span<?php echo $m_gudang_view->lokasi_gudang->viewAttributes() ?>><?php echo $m_gudang_view->lokasi_gudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_gudang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_gudang_view->isExport()) { ?>
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
$m_gudang_view->terminate();
?>