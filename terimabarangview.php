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
$terimabarang_view = new terimabarang_view();

// Run the page
$terimabarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimabarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terimabarang_view->isExport()) { ?>
<script>
var fterimabarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fterimabarangview = currentForm = new ew.Form("fterimabarangview", "view");
	loadjs.done("fterimabarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$terimabarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $terimabarang_view->ExportOptions->render("body") ?>
<?php $terimabarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $terimabarang_view->showPageHeader(); ?>
<?php
$terimabarang_view->showMessage();
?>
<form name="fterimabarangview" id="fterimabarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimabarang">
<input type="hidden" name="modal" value="<?php echo (int)$terimabarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($terimabarang_view->no_terima->Visible) { // no_terima ?>
	<tr id="r_no_terima">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_no_terima"><?php echo $terimabarang_view->no_terima->caption() ?></span></td>
		<td data-name="no_terima" <?php echo $terimabarang_view->no_terima->cellAttributes() ?>>
<span id="el_terimabarang_no_terima">
<span<?php echo $terimabarang_view->no_terima->viewAttributes() ?>><?php echo $terimabarang_view->no_terima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<tr id="r_id_kirimbarang">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_id_kirimbarang"><?php echo $terimabarang_view->id_kirimbarang->caption() ?></span></td>
		<td data-name="id_kirimbarang" <?php echo $terimabarang_view->id_kirimbarang->cellAttributes() ?>>
<span id="el_terimabarang_id_kirimbarang">
<span<?php echo $terimabarang_view->id_kirimbarang->viewAttributes() ?>><?php echo $terimabarang_view->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->id_po->Visible) { // id_po ?>
	<tr id="r_id_po">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_id_po"><?php echo $terimabarang_view->id_po->caption() ?></span></td>
		<td data-name="id_po" <?php echo $terimabarang_view->id_po->cellAttributes() ?>>
<span id="el_terimabarang_id_po">
<span<?php echo $terimabarang_view->id_po->viewAttributes() ?>><?php echo $terimabarang_view->id_po->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->id_supplier->Visible) { // id_supplier ?>
	<tr id="r_id_supplier">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_id_supplier"><?php echo $terimabarang_view->id_supplier->caption() ?></span></td>
		<td data-name="id_supplier" <?php echo $terimabarang_view->id_supplier->cellAttributes() ?>>
<span id="el_terimabarang_id_supplier">
<span<?php echo $terimabarang_view->id_supplier->viewAttributes() ?>><?php echo $terimabarang_view->id_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_id_klinik"><?php echo $terimabarang_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $terimabarang_view->id_klinik->cellAttributes() ?>>
<span id="el_terimabarang_id_klinik">
<span<?php echo $terimabarang_view->id_klinik->viewAttributes() ?>><?php echo $terimabarang_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_id_pegawai"><?php echo $terimabarang_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $terimabarang_view->id_pegawai->cellAttributes() ?>>
<span id="el_terimabarang_id_pegawai">
<span<?php echo $terimabarang_view->id_pegawai->viewAttributes() ?>><?php echo $terimabarang_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->tanggal_terima->Visible) { // tanggal_terima ?>
	<tr id="r_tanggal_terima">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_tanggal_terima"><?php echo $terimabarang_view->tanggal_terima->caption() ?></span></td>
		<td data-name="tanggal_terima" <?php echo $terimabarang_view->tanggal_terima->cellAttributes() ?>>
<span id="el_terimabarang_tanggal_terima">
<span<?php echo $terimabarang_view->tanggal_terima->viewAttributes() ?>><?php echo $terimabarang_view->tanggal_terima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimabarang_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $terimabarang_view->TableLeftColumnClass ?>"><span id="elh_terimabarang_keterangan"><?php echo $terimabarang_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $terimabarang_view->keterangan->cellAttributes() ?>>
<span id="el_terimabarang_keterangan">
<span<?php echo $terimabarang_view->keterangan->viewAttributes() ?>><?php echo $terimabarang_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailterimabarang", explode(",", $terimabarang->getCurrentDetailTable())) && $detailterimabarang->DetailView) {
?>
<?php if ($terimabarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailterimabarang", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $terimabarang_view->detailterimabarang_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailterimabaranggrid.php" ?>
<?php } ?>
</form>
<?php
$terimabarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terimabarang_view->isExport()) { ?>
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
$terimabarang_view->terminate();
?>