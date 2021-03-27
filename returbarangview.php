<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$returbarang_view = new returbarang_view();

// Run the page
$returbarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$returbarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$returbarang_view->isExport()) { ?>
<script>
var freturbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	freturbarangview = currentForm = new ew.Form("freturbarangview", "view");
	loadjs.done("freturbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$returbarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $returbarang_view->ExportOptions->render("body") ?>
<?php $returbarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $returbarang_view->showPageHeader(); ?>
<?php
$returbarang_view->showMessage();
?>
<form name="freturbarangview" id="freturbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="returbarang">
<input type="hidden" name="modal" value="<?php echo (int)$returbarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($returbarang_view->id_retur->Visible) { // id_retur ?>
	<tr id="r_id_retur">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_id_retur"><?php echo $returbarang_view->id_retur->caption() ?></span></td>
		<td data-name="id_retur" <?php echo $returbarang_view->id_retur->cellAttributes() ?>>
<span id="el_returbarang_id_retur">
<span<?php echo $returbarang_view->id_retur->viewAttributes() ?>><?php echo $returbarang_view->id_retur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->kode->Visible) { // kode ?>
	<tr id="r_kode">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_kode"><?php echo $returbarang_view->kode->caption() ?></span></td>
		<td data-name="kode" <?php echo $returbarang_view->kode->cellAttributes() ?>>
<span id="el_returbarang_kode">
<span<?php echo $returbarang_view->kode->viewAttributes() ?>><?php echo $returbarang_view->kode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_id_klinik"><?php echo $returbarang_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $returbarang_view->id_klinik->cellAttributes() ?>>
<span id="el_returbarang_id_klinik">
<span<?php echo $returbarang_view->id_klinik->viewAttributes() ?>><?php echo $returbarang_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->id_supplier->Visible) { // id_supplier ?>
	<tr id="r_id_supplier">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_id_supplier"><?php echo $returbarang_view->id_supplier->caption() ?></span></td>
		<td data-name="id_supplier" <?php echo $returbarang_view->id_supplier->cellAttributes() ?>>
<span id="el_returbarang_id_supplier">
<span<?php echo $returbarang_view->id_supplier->viewAttributes() ?>><?php echo $returbarang_view->id_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_id_pegawai"><?php echo $returbarang_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $returbarang_view->id_pegawai->cellAttributes() ?>>
<span id="el_returbarang_id_pegawai">
<span<?php echo $returbarang_view->id_pegawai->viewAttributes() ?>><?php echo $returbarang_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_tanggal"><?php echo $returbarang_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $returbarang_view->tanggal->cellAttributes() ?>>
<span id="el_returbarang_tanggal">
<span<?php echo $returbarang_view->tanggal->viewAttributes() ?>><?php echo $returbarang_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_status"><?php echo $returbarang_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $returbarang_view->status->cellAttributes() ?>>
<span id="el_returbarang_status">
<span<?php echo $returbarang_view->status->viewAttributes() ?>><?php echo $returbarang_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($returbarang_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $returbarang_view->TableLeftColumnClass ?>"><span id="elh_returbarang_keterangan"><?php echo $returbarang_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $returbarang_view->keterangan->cellAttributes() ?>>
<span id="el_returbarang_keterangan">
<span<?php echo $returbarang_view->keterangan->viewAttributes() ?>><?php echo $returbarang_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailretur", explode(",", $returbarang->getCurrentDetailTable())) && $detailretur->DetailView) {
?>
<?php if ($returbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailretur", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $returbarang_view->detailretur_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailreturgrid.php" ?>
<?php } ?>
</form>
<?php
$returbarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$returbarang_view->isExport()) { ?>
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
$returbarang_view->terminate();
?>