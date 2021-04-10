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
$m_pelanggan_view = new m_pelanggan_view();

// Run the page
$m_pelanggan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pelanggan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_pelanggan_view->isExport()) { ?>
<script>
var fm_pelangganview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_pelangganview = currentForm = new ew.Form("fm_pelangganview", "view");
	loadjs.done("fm_pelangganview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_pelanggan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_pelanggan_view->ExportOptions->render("body") ?>
<?php $m_pelanggan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_pelanggan_view->showPageHeader(); ?>
<?php
$m_pelanggan_view->showMessage();
?>
<form name="fm_pelangganview" id="fm_pelangganview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pelanggan">
<input type="hidden" name="modal" value="<?php echo (int)$m_pelanggan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_pelanggan_view->id_pelanggan->Visible) { // id_pelanggan ?>
	<tr id="r_id_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_id_pelanggan"><?php echo $m_pelanggan_view->id_pelanggan->caption() ?></span></td>
		<td data-name="id_pelanggan" <?php echo $m_pelanggan_view->id_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_id_pelanggan">
<span<?php echo $m_pelanggan_view->id_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->kode_pelanggan->Visible) { // kode_pelanggan ?>
	<tr id="r_kode_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_kode_pelanggan"><?php echo $m_pelanggan_view->kode_pelanggan->caption() ?></span></td>
		<td data-name="kode_pelanggan" <?php echo $m_pelanggan_view->kode_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_kode_pelanggan">
<span<?php echo $m_pelanggan_view->kode_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->kode_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
	<tr id="r_noktp_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_noktp_pelanggan"><?php echo $m_pelanggan_view->noktp_pelanggan->caption() ?></span></td>
		<td data-name="noktp_pelanggan" <?php echo $m_pelanggan_view->noktp_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_noktp_pelanggan">
<span<?php echo $m_pelanggan_view->noktp_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->noktp_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<tr id="r_nama_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_nama_pelanggan"><?php echo $m_pelanggan_view->nama_pelanggan->caption() ?></span></td>
		<td data-name="nama_pelanggan" <?php echo $m_pelanggan_view->nama_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_nama_pelanggan">
<span<?php echo $m_pelanggan_view->nama_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->nama_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
	<tr id="r_jenis_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_jenis_pelanggan"><?php echo $m_pelanggan_view->jenis_pelanggan->caption() ?></span></td>
		<td data-name="jenis_pelanggan" <?php echo $m_pelanggan_view->jenis_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_jenis_pelanggan">
<span<?php echo $m_pelanggan_view->jenis_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->jenis_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->tgllahir_pelanggan->Visible) { // tgllahir_pelanggan ?>
	<tr id="r_tgllahir_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_tgllahir_pelanggan"><?php echo $m_pelanggan_view->tgllahir_pelanggan->caption() ?></span></td>
		<td data-name="tgllahir_pelanggan" <?php echo $m_pelanggan_view->tgllahir_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_tgllahir_pelanggan">
<span<?php echo $m_pelanggan_view->tgllahir_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->tgllahir_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->pekerjaan_pelanggan->Visible) { // pekerjaan_pelanggan ?>
	<tr id="r_pekerjaan_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_pekerjaan_pelanggan"><?php echo $m_pelanggan_view->pekerjaan_pelanggan->caption() ?></span></td>
		<td data-name="pekerjaan_pelanggan" <?php echo $m_pelanggan_view->pekerjaan_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_pekerjaan_pelanggan">
<span<?php echo $m_pelanggan_view->pekerjaan_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->pekerjaan_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->kota_pelanggan->Visible) { // kota_pelanggan ?>
	<tr id="r_kota_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_kota_pelanggan"><?php echo $m_pelanggan_view->kota_pelanggan->caption() ?></span></td>
		<td data-name="kota_pelanggan" <?php echo $m_pelanggan_view->kota_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_kota_pelanggan">
<span<?php echo $m_pelanggan_view->kota_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->kota_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
	<tr id="r_alamat_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_alamat_pelanggan"><?php echo $m_pelanggan_view->alamat_pelanggan->caption() ?></span></td>
		<td data-name="alamat_pelanggan" <?php echo $m_pelanggan_view->alamat_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_alamat_pelanggan">
<span<?php echo $m_pelanggan_view->alamat_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->alamat_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
	<tr id="r_telpon_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_telpon_pelanggan"><?php echo $m_pelanggan_view->telpon_pelanggan->caption() ?></span></td>
		<td data-name="telpon_pelanggan" <?php echo $m_pelanggan_view->telpon_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_telpon_pelanggan">
<span<?php echo $m_pelanggan_view->telpon_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->telpon_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->hp_pelanggan->Visible) { // hp_pelanggan ?>
	<tr id="r_hp_pelanggan">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_hp_pelanggan"><?php echo $m_pelanggan_view->hp_pelanggan->caption() ?></span></td>
		<td data-name="hp_pelanggan" <?php echo $m_pelanggan_view->hp_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_hp_pelanggan">
<span<?php echo $m_pelanggan_view->hp_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_view->hp_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_id_klinik"><?php echo $m_pelanggan_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_pelanggan_view->id_klinik->cellAttributes() ?>>
<span id="el_m_pelanggan_id_klinik">
<span<?php echo $m_pelanggan_view->id_klinik->viewAttributes() ?>><?php echo $m_pelanggan_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->tgl_daftar->Visible) { // tgl_daftar ?>
	<tr id="r_tgl_daftar">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_tgl_daftar"><?php echo $m_pelanggan_view->tgl_daftar->caption() ?></span></td>
		<td data-name="tgl_daftar" <?php echo $m_pelanggan_view->tgl_daftar->cellAttributes() ?>>
<span id="el_m_pelanggan_tgl_daftar">
<span<?php echo $m_pelanggan_view->tgl_daftar->viewAttributes() ?>><?php echo $m_pelanggan_view->tgl_daftar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->kategori->Visible) { // kategori ?>
	<tr id="r_kategori">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_kategori"><?php echo $m_pelanggan_view->kategori->caption() ?></span></td>
		<td data-name="kategori" <?php echo $m_pelanggan_view->kategori->cellAttributes() ?>>
<span id="el_m_pelanggan_kategori">
<span<?php echo $m_pelanggan_view->kategori->viewAttributes() ?>><?php echo $m_pelanggan_view->kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pelanggan_view->tipe->Visible) { // tipe ?>
	<tr id="r_tipe">
		<td class="<?php echo $m_pelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_pelanggan_tipe"><?php echo $m_pelanggan_view->tipe->caption() ?></span></td>
		<td data-name="tipe" <?php echo $m_pelanggan_view->tipe->cellAttributes() ?>>
<span id="el_m_pelanggan_tipe">
<span<?php echo $m_pelanggan_view->tipe->viewAttributes() ?>><?php echo $m_pelanggan_view->tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_pelanggan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_pelanggan_view->isExport()) { ?>
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
$m_pelanggan_view->terminate();
?>