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
$permintaanpembelian_view = new permintaanpembelian_view();

// Run the page
$permintaanpembelian_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$permintaanpembelian_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$permintaanpembelian_view->isExport()) { ?>
<script>
var fpermintaanpembelianview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpermintaanpembelianview = currentForm = new ew.Form("fpermintaanpembelianview", "view");
	loadjs.done("fpermintaanpembelianview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$permintaanpembelian_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $permintaanpembelian_view->ExportOptions->render("body") ?>
<?php $permintaanpembelian_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $permintaanpembelian_view->showPageHeader(); ?>
<?php
$permintaanpembelian_view->showMessage();
?>
<form name="fpermintaanpembelianview" id="fpermintaanpembelianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="permintaanpembelian">
<input type="hidden" name="modal" value="<?php echo (int)$permintaanpembelian_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($permintaanpembelian_view->id_pp->Visible) { // id_pp ?>
	<tr id="r_id_pp">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_id_pp"><?php echo $permintaanpembelian_view->id_pp->caption() ?></span></td>
		<td data-name="id_pp" <?php echo $permintaanpembelian_view->id_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_id_pp">
<span<?php echo $permintaanpembelian_view->id_pp->viewAttributes() ?>><?php echo $permintaanpembelian_view->id_pp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->no_pp->Visible) { // no_pp ?>
	<tr id="r_no_pp">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_no_pp"><?php echo $permintaanpembelian_view->no_pp->caption() ?></span></td>
		<td data-name="no_pp" <?php echo $permintaanpembelian_view->no_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_no_pp">
<span<?php echo $permintaanpembelian_view->no_pp->viewAttributes() ?>><?php echo $permintaanpembelian_view->no_pp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->namapaket_pp->Visible) { // namapaket_pp ?>
	<tr id="r_namapaket_pp">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_namapaket_pp"><?php echo $permintaanpembelian_view->namapaket_pp->caption() ?></span></td>
		<td data-name="namapaket_pp" <?php echo $permintaanpembelian_view->namapaket_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_namapaket_pp">
<span<?php echo $permintaanpembelian_view->namapaket_pp->viewAttributes() ?>><?php echo $permintaanpembelian_view->namapaket_pp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->tgl_pp->Visible) { // tgl_pp ?>
	<tr id="r_tgl_pp">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_tgl_pp"><?php echo $permintaanpembelian_view->tgl_pp->caption() ?></span></td>
		<td data-name="tgl_pp" <?php echo $permintaanpembelian_view->tgl_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_pp">
<span<?php echo $permintaanpembelian_view->tgl_pp->viewAttributes() ?>><?php echo $permintaanpembelian_view->tgl_pp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
	<tr id="r_tgl_kebutuhan">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_tgl_kebutuhan"><?php echo $permintaanpembelian_view->tgl_kebutuhan->caption() ?></span></td>
		<td data-name="tgl_kebutuhan" <?php echo $permintaanpembelian_view->tgl_kebutuhan->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_kebutuhan">
<span<?php echo $permintaanpembelian_view->tgl_kebutuhan->viewAttributes() ?>><?php echo $permintaanpembelian_view->tgl_kebutuhan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
	<tr id="r_tgl_persetujuan">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_tgl_persetujuan"><?php echo $permintaanpembelian_view->tgl_persetujuan->caption() ?></span></td>
		<td data-name="tgl_persetujuan" <?php echo $permintaanpembelian_view->tgl_persetujuan->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_persetujuan">
<span<?php echo $permintaanpembelian_view->tgl_persetujuan->viewAttributes() ?>><?php echo $permintaanpembelian_view->tgl_persetujuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->staf_pengajuan->Visible) { // staf_pengajuan ?>
	<tr id="r_staf_pengajuan">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_staf_pengajuan"><?php echo $permintaanpembelian_view->staf_pengajuan->caption() ?></span></td>
		<td data-name="staf_pengajuan" <?php echo $permintaanpembelian_view->staf_pengajuan->cellAttributes() ?>>
<span id="el_permintaanpembelian_staf_pengajuan">
<span<?php echo $permintaanpembelian_view->staf_pengajuan->viewAttributes() ?>><?php echo $permintaanpembelian_view->staf_pengajuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->staf_validasi->Visible) { // staf_validasi ?>
	<tr id="r_staf_validasi">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_staf_validasi"><?php echo $permintaanpembelian_view->staf_validasi->caption() ?></span></td>
		<td data-name="staf_validasi" <?php echo $permintaanpembelian_view->staf_validasi->cellAttributes() ?>>
<span id="el_permintaanpembelian_staf_validasi">
<span<?php echo $permintaanpembelian_view->staf_validasi->viewAttributes() ?>><?php echo $permintaanpembelian_view->staf_validasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->id_suplier->Visible) { // id_suplier ?>
	<tr id="r_id_suplier">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_id_suplier"><?php echo $permintaanpembelian_view->id_suplier->caption() ?></span></td>
		<td data-name="id_suplier" <?php echo $permintaanpembelian_view->id_suplier->cellAttributes() ?>>
<span id="el_permintaanpembelian_id_suplier">
<span<?php echo $permintaanpembelian_view->id_suplier->viewAttributes() ?>><?php echo $permintaanpembelian_view->id_suplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->idklinik->Visible) { // idklinik ?>
	<tr id="r_idklinik">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_idklinik"><?php echo $permintaanpembelian_view->idklinik->caption() ?></span></td>
		<td data-name="idklinik" <?php echo $permintaanpembelian_view->idklinik->cellAttributes() ?>>
<span id="el_permintaanpembelian_idklinik">
<span<?php echo $permintaanpembelian_view->idklinik->viewAttributes() ?>><?php echo $permintaanpembelian_view->idklinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->validasi->Visible) { // validasi ?>
	<tr id="r_validasi">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_validasi"><?php echo $permintaanpembelian_view->validasi->caption() ?></span></td>
		<td data-name="validasi" <?php echo $permintaanpembelian_view->validasi->cellAttributes() ?>>
<span id="el_permintaanpembelian_validasi">
<span<?php echo $permintaanpembelian_view->validasi->viewAttributes() ?>><?php echo $permintaanpembelian_view->validasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_status"><?php echo $permintaanpembelian_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $permintaanpembelian_view->status->cellAttributes() ?>>
<span id="el_permintaanpembelian_status">
<span<?php echo $permintaanpembelian_view->status->viewAttributes() ?>><?php echo $permintaanpembelian_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->email_pusat->Visible) { // email_pusat ?>
	<tr id="r_email_pusat">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_email_pusat"><?php echo $permintaanpembelian_view->email_pusat->caption() ?></span></td>
		<td data-name="email_pusat" <?php echo $permintaanpembelian_view->email_pusat->cellAttributes() ?>>
<span id="el_permintaanpembelian_email_pusat">
<span<?php echo $permintaanpembelian_view->email_pusat->viewAttributes() ?>><?php echo $permintaanpembelian_view->email_pusat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($permintaanpembelian_view->email_cabang->Visible) { // email_cabang ?>
	<tr id="r_email_cabang">
		<td class="<?php echo $permintaanpembelian_view->TableLeftColumnClass ?>"><span id="elh_permintaanpembelian_email_cabang"><?php echo $permintaanpembelian_view->email_cabang->caption() ?></span></td>
		<td data-name="email_cabang" <?php echo $permintaanpembelian_view->email_cabang->cellAttributes() ?>>
<span id="el_permintaanpembelian_email_cabang">
<span<?php echo $permintaanpembelian_view->email_cabang->viewAttributes() ?>><?php echo $permintaanpembelian_view->email_cabang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailmintapembelian", explode(",", $permintaanpembelian->getCurrentDetailTable())) && $detailmintapembelian->DetailView) {
?>
<?php if ($permintaanpembelian->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailmintapembelian", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailmintapembeliangrid.php" ?>
<?php } ?>
</form>
<?php
$permintaanpembelian_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$permintaanpembelian_view->isExport()) { ?>
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
$permintaanpembelian_view->terminate();
?>