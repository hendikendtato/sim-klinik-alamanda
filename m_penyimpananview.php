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
$m_penyimpanan_view = new m_penyimpanan_view();

// Run the page
$m_penyimpanan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_penyimpanan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_penyimpanan_view->isExport()) { ?>
<script>
var fm_penyimpananview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_penyimpananview = currentForm = new ew.Form("fm_penyimpananview", "view");
	loadjs.done("fm_penyimpananview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_penyimpanan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_penyimpanan_view->ExportOptions->render("body") ?>
<?php $m_penyimpanan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_penyimpanan_view->showPageHeader(); ?>
<?php
$m_penyimpanan_view->showMessage();
?>
<form name="fm_penyimpananview" id="fm_penyimpananview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_penyimpanan">
<input type="hidden" name="modal" value="<?php echo (int)$m_penyimpanan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_penyimpanan_view->id_penyimpanan->Visible) { // id_penyimpanan ?>
	<tr id="r_id_penyimpanan">
		<td class="<?php echo $m_penyimpanan_view->TableLeftColumnClass ?>"><span id="elh_m_penyimpanan_id_penyimpanan"><?php echo $m_penyimpanan_view->id_penyimpanan->caption() ?></span></td>
		<td data-name="id_penyimpanan" <?php echo $m_penyimpanan_view->id_penyimpanan->cellAttributes() ?>>
<span id="el_m_penyimpanan_id_penyimpanan">
<span<?php echo $m_penyimpanan_view->id_penyimpanan->viewAttributes() ?>><?php echo $m_penyimpanan_view->id_penyimpanan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_penyimpanan_view->nama_barang->Visible) { // nama_barang ?>
	<tr id="r_nama_barang">
		<td class="<?php echo $m_penyimpanan_view->TableLeftColumnClass ?>"><span id="elh_m_penyimpanan_nama_barang"><?php echo $m_penyimpanan_view->nama_barang->caption() ?></span></td>
		<td data-name="nama_barang" <?php echo $m_penyimpanan_view->nama_barang->cellAttributes() ?>>
<span id="el_m_penyimpanan_nama_barang">
<span<?php echo $m_penyimpanan_view->nama_barang->viewAttributes() ?>><?php echo $m_penyimpanan_view->nama_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_penyimpanan_view->tanggal_->Visible) { // tanggal_ ?>
	<tr id="r_tanggal_">
		<td class="<?php echo $m_penyimpanan_view->TableLeftColumnClass ?>"><span id="elh_m_penyimpanan_tanggal_"><?php echo $m_penyimpanan_view->tanggal_->caption() ?></span></td>
		<td data-name="tanggal_" <?php echo $m_penyimpanan_view->tanggal_->cellAttributes() ?>>
<span id="el_m_penyimpanan_tanggal_">
<span<?php echo $m_penyimpanan_view->tanggal_->viewAttributes() ?>><?php echo $m_penyimpanan_view->tanggal_->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_penyimpanan_view->penyimpanan->Visible) { // penyimpanan ?>
	<tr id="r_penyimpanan">
		<td class="<?php echo $m_penyimpanan_view->TableLeftColumnClass ?>"><span id="elh_m_penyimpanan_penyimpanan"><?php echo $m_penyimpanan_view->penyimpanan->caption() ?></span></td>
		<td data-name="penyimpanan" <?php echo $m_penyimpanan_view->penyimpanan->cellAttributes() ?>>
<span id="el_m_penyimpanan_penyimpanan">
<span<?php echo $m_penyimpanan_view->penyimpanan->viewAttributes() ?>><?php echo $m_penyimpanan_view->penyimpanan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_penyimpanan_view->nomor_laci->Visible) { // nomor_laci ?>
	<tr id="r_nomor_laci">
		<td class="<?php echo $m_penyimpanan_view->TableLeftColumnClass ?>"><span id="elh_m_penyimpanan_nomor_laci"><?php echo $m_penyimpanan_view->nomor_laci->caption() ?></span></td>
		<td data-name="nomor_laci" <?php echo $m_penyimpanan_view->nomor_laci->cellAttributes() ?>>
<span id="el_m_penyimpanan_nomor_laci">
<span<?php echo $m_penyimpanan_view->nomor_laci->viewAttributes() ?>><?php echo $m_penyimpanan_view->nomor_laci->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_penyimpanan_view->Stock->Visible) { // Stock ?>
	<tr id="r_Stock">
		<td class="<?php echo $m_penyimpanan_view->TableLeftColumnClass ?>"><span id="elh_m_penyimpanan_Stock"><?php echo $m_penyimpanan_view->Stock->caption() ?></span></td>
		<td data-name="Stock" <?php echo $m_penyimpanan_view->Stock->cellAttributes() ?>>
<span id="el_m_penyimpanan_Stock">
<span<?php echo $m_penyimpanan_view->Stock->viewAttributes() ?>><?php echo $m_penyimpanan_view->Stock->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_penyimpanan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_penyimpanan_view->isExport()) { ?>
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
$m_penyimpanan_view->terminate();
?>