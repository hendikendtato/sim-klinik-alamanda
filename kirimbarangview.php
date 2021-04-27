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
$kirimbarang_view = new kirimbarang_view();

// Run the page
$kirimbarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kirimbarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kirimbarang_view->isExport()) { ?>
<script>
var fkirimbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fkirimbarangview = currentForm = new ew.Form("fkirimbarangview", "view");
	loadjs.done("fkirimbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$kirimbarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kirimbarang_view->ExportOptions->render("body") ?>
<?php $kirimbarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kirimbarang_view->showPageHeader(); ?>
<?php
$kirimbarang_view->showMessage();
?>
<form name="fkirimbarangview" id="fkirimbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kirimbarang">
<input type="hidden" name="modal" value="<?php echo (int)$kirimbarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kirimbarang_view->no_kirimbarang->Visible) { // no_kirimbarang ?>
	<tr id="r_no_kirimbarang">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_no_kirimbarang"><?php echo $kirimbarang_view->no_kirimbarang->caption() ?></span></td>
		<td data-name="no_kirimbarang" <?php echo $kirimbarang_view->no_kirimbarang->cellAttributes() ?>>
<span id="el_kirimbarang_no_kirimbarang">
<span<?php echo $kirimbarang_view->no_kirimbarang->viewAttributes() ?>><?php echo $kirimbarang_view->no_kirimbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->id_po->Visible) { // id_po ?>
	<tr id="r_id_po">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_id_po"><?php echo $kirimbarang_view->id_po->caption() ?></span></td>
		<td data-name="id_po" <?php echo $kirimbarang_view->id_po->cellAttributes() ?>>
<span id="el_kirimbarang_id_po">
<span<?php echo $kirimbarang_view->id_po->viewAttributes() ?>><?php echo $kirimbarang_view->id_po->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->id_supplier->Visible) { // id_supplier ?>
	<tr id="r_id_supplier">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_id_supplier"><?php echo $kirimbarang_view->id_supplier->caption() ?></span></td>
		<td data-name="id_supplier" <?php echo $kirimbarang_view->id_supplier->cellAttributes() ?>>
<span id="el_kirimbarang_id_supplier">
<span<?php echo $kirimbarang_view->id_supplier->viewAttributes() ?>><?php echo $kirimbarang_view->id_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_id_klinik"><?php echo $kirimbarang_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $kirimbarang_view->id_klinik->cellAttributes() ?>>
<span id="el_kirimbarang_id_klinik">
<span<?php echo $kirimbarang_view->id_klinik->viewAttributes() ?>><?php echo $kirimbarang_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_id_pegawai"><?php echo $kirimbarang_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $kirimbarang_view->id_pegawai->cellAttributes() ?>>
<span id="el_kirimbarang_id_pegawai">
<span<?php echo $kirimbarang_view->id_pegawai->viewAttributes() ?>><?php echo $kirimbarang_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_tanggal"><?php echo $kirimbarang_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $kirimbarang_view->tanggal->cellAttributes() ?>>
<span id="el_kirimbarang_tanggal">
<span<?php echo $kirimbarang_view->tanggal->viewAttributes() ?>><?php echo $kirimbarang_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->status_kirim->Visible) { // status_kirim ?>
	<tr id="r_status_kirim">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_status_kirim"><?php echo $kirimbarang_view->status_kirim->caption() ?></span></td>
		<td data-name="status_kirim" <?php echo $kirimbarang_view->status_kirim->cellAttributes() ?>>
<span id="el_kirimbarang_status_kirim">
<span<?php echo $kirimbarang_view->status_kirim->viewAttributes() ?>><?php echo $kirimbarang_view->status_kirim->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kirimbarang_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $kirimbarang_view->TableLeftColumnClass ?>"><span id="elh_kirimbarang_keterangan"><?php echo $kirimbarang_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $kirimbarang_view->keterangan->cellAttributes() ?>>
<span id="el_kirimbarang_keterangan">
<span<?php echo $kirimbarang_view->keterangan->viewAttributes() ?>><?php echo $kirimbarang_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailkirimbarang", explode(",", $kirimbarang->getCurrentDetailTable())) && $detailkirimbarang->DetailView) {
?>
<?php if ($kirimbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailkirimbarang", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $kirimbarang_view->detailkirimbarang_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailkirimbaranggrid.php" ?>
<?php } ?>
</form>
<?php
$kirimbarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kirimbarang_view->isExport()) { ?>
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
$kirimbarang_view->terminate();
?>