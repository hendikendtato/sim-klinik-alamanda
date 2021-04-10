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
$m_satuan_barang_view = new m_satuan_barang_view();

// Run the page
$m_satuan_barang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_satuan_barang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_satuan_barang_view->isExport()) { ?>
<script>
var fm_satuan_barangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_satuan_barangview = currentForm = new ew.Form("fm_satuan_barangview", "view");
	loadjs.done("fm_satuan_barangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_satuan_barang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_satuan_barang_view->ExportOptions->render("body") ?>
<?php $m_satuan_barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_satuan_barang_view->showPageHeader(); ?>
<?php
$m_satuan_barang_view->showMessage();
?>
<form name="fm_satuan_barangview" id="fm_satuan_barangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_satuan_barang">
<input type="hidden" name="modal" value="<?php echo (int)$m_satuan_barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_satuan_barang_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $m_satuan_barang_view->TableLeftColumnClass ?>"><span id="elh_m_satuan_barang_id_satuan"><?php echo $m_satuan_barang_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $m_satuan_barang_view->id_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_id_satuan">
<span<?php echo $m_satuan_barang_view->id_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_satuan_barang_view->kode_satuan->Visible) { // kode_satuan ?>
	<tr id="r_kode_satuan">
		<td class="<?php echo $m_satuan_barang_view->TableLeftColumnClass ?>"><span id="elh_m_satuan_barang_kode_satuan"><?php echo $m_satuan_barang_view->kode_satuan->caption() ?></span></td>
		<td data-name="kode_satuan" <?php echo $m_satuan_barang_view->kode_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_kode_satuan">
<span<?php echo $m_satuan_barang_view->kode_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_view->kode_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_satuan_barang_view->nama_satuan->Visible) { // nama_satuan ?>
	<tr id="r_nama_satuan">
		<td class="<?php echo $m_satuan_barang_view->TableLeftColumnClass ?>"><span id="elh_m_satuan_barang_nama_satuan"><?php echo $m_satuan_barang_view->nama_satuan->caption() ?></span></td>
		<td data-name="nama_satuan" <?php echo $m_satuan_barang_view->nama_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_nama_satuan">
<span<?php echo $m_satuan_barang_view->nama_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_view->nama_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_satuan_barang_view->level_satuan->Visible) { // level_satuan ?>
	<tr id="r_level_satuan">
		<td class="<?php echo $m_satuan_barang_view->TableLeftColumnClass ?>"><span id="elh_m_satuan_barang_level_satuan"><?php echo $m_satuan_barang_view->level_satuan->caption() ?></span></td>
		<td data-name="level_satuan" <?php echo $m_satuan_barang_view->level_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_level_satuan">
<span<?php echo $m_satuan_barang_view->level_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_view->level_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_satuan_barang_view->konversi_satuan->Visible) { // konversi_satuan ?>
	<tr id="r_konversi_satuan">
		<td class="<?php echo $m_satuan_barang_view->TableLeftColumnClass ?>"><span id="elh_m_satuan_barang_konversi_satuan"><?php echo $m_satuan_barang_view->konversi_satuan->caption() ?></span></td>
		<td data-name="konversi_satuan" <?php echo $m_satuan_barang_view->konversi_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_konversi_satuan">
<span<?php echo $m_satuan_barang_view->konversi_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_view->konversi_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_satuan_barang_view->pid_satuan->Visible) { // pid_satuan ?>
	<tr id="r_pid_satuan">
		<td class="<?php echo $m_satuan_barang_view->TableLeftColumnClass ?>"><span id="elh_m_satuan_barang_pid_satuan"><?php echo $m_satuan_barang_view->pid_satuan->caption() ?></span></td>
		<td data-name="pid_satuan" <?php echo $m_satuan_barang_view->pid_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_pid_satuan">
<span<?php echo $m_satuan_barang_view->pid_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_view->pid_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_satuan_barang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_satuan_barang_view->isExport()) { ?>
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
$m_satuan_barang_view->terminate();
?>