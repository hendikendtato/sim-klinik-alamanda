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
$m_supplier_view = new m_supplier_view();

// Run the page
$m_supplier_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_supplier_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_supplier_view->isExport()) { ?>
<script>
var fm_supplierview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_supplierview = currentForm = new ew.Form("fm_supplierview", "view");
	loadjs.done("fm_supplierview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_supplier_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_supplier_view->ExportOptions->render("body") ?>
<?php $m_supplier_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_supplier_view->showPageHeader(); ?>
<?php
$m_supplier_view->showMessage();
?>
<form name="fm_supplierview" id="fm_supplierview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_supplier">
<input type="hidden" name="modal" value="<?php echo (int)$m_supplier_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_supplier_view->id_supplier->Visible) { // id_supplier ?>
	<tr id="r_id_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_id_supplier"><?php echo $m_supplier_view->id_supplier->caption() ?></span></td>
		<td data-name="id_supplier" <?php echo $m_supplier_view->id_supplier->cellAttributes() ?>>
<span id="el_m_supplier_id_supplier">
<span<?php echo $m_supplier_view->id_supplier->viewAttributes() ?>><?php echo $m_supplier_view->id_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->kode_supplier->Visible) { // kode_supplier ?>
	<tr id="r_kode_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_kode_supplier"><?php echo $m_supplier_view->kode_supplier->caption() ?></span></td>
		<td data-name="kode_supplier" <?php echo $m_supplier_view->kode_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kode_supplier">
<span<?php echo $m_supplier_view->kode_supplier->viewAttributes() ?>><?php echo $m_supplier_view->kode_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->nama_supplier->Visible) { // nama_supplier ?>
	<tr id="r_nama_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_nama_supplier"><?php echo $m_supplier_view->nama_supplier->caption() ?></span></td>
		<td data-name="nama_supplier" <?php echo $m_supplier_view->nama_supplier->cellAttributes() ?>>
<span id="el_m_supplier_nama_supplier">
<span<?php echo $m_supplier_view->nama_supplier->viewAttributes() ?>><?php echo $m_supplier_view->nama_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->pic_supplier->Visible) { // pic_supplier ?>
	<tr id="r_pic_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_pic_supplier"><?php echo $m_supplier_view->pic_supplier->caption() ?></span></td>
		<td data-name="pic_supplier" <?php echo $m_supplier_view->pic_supplier->cellAttributes() ?>>
<span id="el_m_supplier_pic_supplier">
<span<?php echo $m_supplier_view->pic_supplier->viewAttributes() ?>><?php echo $m_supplier_view->pic_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->alamat_supplier->Visible) { // alamat_supplier ?>
	<tr id="r_alamat_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_alamat_supplier"><?php echo $m_supplier_view->alamat_supplier->caption() ?></span></td>
		<td data-name="alamat_supplier" <?php echo $m_supplier_view->alamat_supplier->cellAttributes() ?>>
<span id="el_m_supplier_alamat_supplier">
<span<?php echo $m_supplier_view->alamat_supplier->viewAttributes() ?>><?php echo $m_supplier_view->alamat_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->kelurahan_supplier->Visible) { // kelurahan_supplier ?>
	<tr id="r_kelurahan_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_kelurahan_supplier"><?php echo $m_supplier_view->kelurahan_supplier->caption() ?></span></td>
		<td data-name="kelurahan_supplier" <?php echo $m_supplier_view->kelurahan_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kelurahan_supplier">
<span<?php echo $m_supplier_view->kelurahan_supplier->viewAttributes() ?>><?php echo $m_supplier_view->kelurahan_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->kecamatan_supplier->Visible) { // kecamatan_supplier ?>
	<tr id="r_kecamatan_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_kecamatan_supplier"><?php echo $m_supplier_view->kecamatan_supplier->caption() ?></span></td>
		<td data-name="kecamatan_supplier" <?php echo $m_supplier_view->kecamatan_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kecamatan_supplier">
<span<?php echo $m_supplier_view->kecamatan_supplier->viewAttributes() ?>><?php echo $m_supplier_view->kecamatan_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->kota_supplier->Visible) { // kota_supplier ?>
	<tr id="r_kota_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_kota_supplier"><?php echo $m_supplier_view->kota_supplier->caption() ?></span></td>
		<td data-name="kota_supplier" <?php echo $m_supplier_view->kota_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kota_supplier">
<span<?php echo $m_supplier_view->kota_supplier->viewAttributes() ?>><?php echo $m_supplier_view->kota_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->kodepos_supplier->Visible) { // kodepos_supplier ?>
	<tr id="r_kodepos_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_kodepos_supplier"><?php echo $m_supplier_view->kodepos_supplier->caption() ?></span></td>
		<td data-name="kodepos_supplier" <?php echo $m_supplier_view->kodepos_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kodepos_supplier">
<span<?php echo $m_supplier_view->kodepos_supplier->viewAttributes() ?>><?php echo $m_supplier_view->kodepos_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->telpon_supplier->Visible) { // telpon_supplier ?>
	<tr id="r_telpon_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_telpon_supplier"><?php echo $m_supplier_view->telpon_supplier->caption() ?></span></td>
		<td data-name="telpon_supplier" <?php echo $m_supplier_view->telpon_supplier->cellAttributes() ?>>
<span id="el_m_supplier_telpon_supplier">
<span<?php echo $m_supplier_view->telpon_supplier->viewAttributes() ?>><?php echo $m_supplier_view->telpon_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->hp_supplier->Visible) { // hp_supplier ?>
	<tr id="r_hp_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_hp_supplier"><?php echo $m_supplier_view->hp_supplier->caption() ?></span></td>
		<td data-name="hp_supplier" <?php echo $m_supplier_view->hp_supplier->cellAttributes() ?>>
<span id="el_m_supplier_hp_supplier">
<span<?php echo $m_supplier_view->hp_supplier->viewAttributes() ?>><?php echo $m_supplier_view->hp_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->email_supplier->Visible) { // email_supplier ?>
	<tr id="r_email_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_email_supplier"><?php echo $m_supplier_view->email_supplier->caption() ?></span></td>
		<td data-name="email_supplier" <?php echo $m_supplier_view->email_supplier->cellAttributes() ?>>
<span id="el_m_supplier_email_supplier">
<span<?php echo $m_supplier_view->email_supplier->viewAttributes() ?>><?php echo $m_supplier_view->email_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->kategori_supplier->Visible) { // kategori_supplier ?>
	<tr id="r_kategori_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_kategori_supplier"><?php echo $m_supplier_view->kategori_supplier->caption() ?></span></td>
		<td data-name="kategori_supplier" <?php echo $m_supplier_view->kategori_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kategori_supplier">
<span<?php echo $m_supplier_view->kategori_supplier->viewAttributes() ?>><?php echo $m_supplier_view->kategori_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->npwp_supplier->Visible) { // npwp_supplier ?>
	<tr id="r_npwp_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_npwp_supplier"><?php echo $m_supplier_view->npwp_supplier->caption() ?></span></td>
		<td data-name="npwp_supplier" <?php echo $m_supplier_view->npwp_supplier->cellAttributes() ?>>
<span id="el_m_supplier_npwp_supplier">
<span<?php echo $m_supplier_view->npwp_supplier->viewAttributes() ?>><?php echo $m_supplier_view->npwp_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_supplier_view->rekening_supplier->Visible) { // rekening_supplier ?>
	<tr id="r_rekening_supplier">
		<td class="<?php echo $m_supplier_view->TableLeftColumnClass ?>"><span id="elh_m_supplier_rekening_supplier"><?php echo $m_supplier_view->rekening_supplier->caption() ?></span></td>
		<td data-name="rekening_supplier" <?php echo $m_supplier_view->rekening_supplier->cellAttributes() ?>>
<span id="el_m_supplier_rekening_supplier">
<span<?php echo $m_supplier_view->rekening_supplier->viewAttributes() ?>><?php echo $m_supplier_view->rekening_supplier->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_supplier_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_supplier_view->isExport()) { ?>
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
$m_supplier_view->terminate();
?>