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
$m_pegawai_view = new m_pegawai_view();

// Run the page
$m_pegawai_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pegawai_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_pegawai_view->isExport()) { ?>
<script>
var fm_pegawaiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_pegawaiview = currentForm = new ew.Form("fm_pegawaiview", "view");
	loadjs.done("fm_pegawaiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_pegawai_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_pegawai_view->ExportOptions->render("body") ?>
<?php $m_pegawai_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_pegawai_view->showPageHeader(); ?>
<?php
$m_pegawai_view->showMessage();
?>
<form name="fm_pegawaiview" id="fm_pegawaiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pegawai">
<input type="hidden" name="modal" value="<?php echo (int)$m_pegawai_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_pegawai_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_id_pegawai"><?php echo $m_pegawai_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $m_pegawai_view->id_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_id_pegawai">
<span<?php echo $m_pegawai_view->id_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->nama_pegawai->Visible) { // nama_pegawai ?>
	<tr id="r_nama_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_nama_pegawai"><?php echo $m_pegawai_view->nama_pegawai->caption() ?></span></td>
		<td data-name="nama_pegawai" <?php echo $m_pegawai_view->nama_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_nama_pegawai">
<span<?php echo $m_pegawai_view->nama_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->nama_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->nama_lengkap->Visible) { // nama_lengkap ?>
	<tr id="r_nama_lengkap">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_nama_lengkap"><?php echo $m_pegawai_view->nama_lengkap->caption() ?></span></td>
		<td data-name="nama_lengkap" <?php echo $m_pegawai_view->nama_lengkap->cellAttributes() ?>>
<span id="el_m_pegawai_nama_lengkap">
<span<?php echo $m_pegawai_view->nama_lengkap->viewAttributes() ?>><?php echo $m_pegawai_view->nama_lengkap->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->jenis_pegawai->Visible) { // jenis_pegawai ?>
	<tr id="r_jenis_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_jenis_pegawai"><?php echo $m_pegawai_view->jenis_pegawai->caption() ?></span></td>
		<td data-name="jenis_pegawai" <?php echo $m_pegawai_view->jenis_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_jenis_pegawai">
<span<?php echo $m_pegawai_view->jenis_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->jenis_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->nik_pegawai->Visible) { // nik_pegawai ?>
	<tr id="r_nik_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_nik_pegawai"><?php echo $m_pegawai_view->nik_pegawai->caption() ?></span></td>
		<td data-name="nik_pegawai" <?php echo $m_pegawai_view->nik_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_nik_pegawai">
<span<?php echo $m_pegawai_view->nik_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->nik_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->agama_pegawai->Visible) { // agama_pegawai ?>
	<tr id="r_agama_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_agama_pegawai"><?php echo $m_pegawai_view->agama_pegawai->caption() ?></span></td>
		<td data-name="agama_pegawai" <?php echo $m_pegawai_view->agama_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_agama_pegawai">
<span<?php echo $m_pegawai_view->agama_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->agama_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->tgllahir_pegawai->Visible) { // tgllahir_pegawai ?>
	<tr id="r_tgllahir_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_tgllahir_pegawai"><?php echo $m_pegawai_view->tgllahir_pegawai->caption() ?></span></td>
		<td data-name="tgllahir_pegawai" <?php echo $m_pegawai_view->tgllahir_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_tgllahir_pegawai">
<span<?php echo $m_pegawai_view->tgllahir_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->tgllahir_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->alamat_pegawai->Visible) { // alamat_pegawai ?>
	<tr id="r_alamat_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_alamat_pegawai"><?php echo $m_pegawai_view->alamat_pegawai->caption() ?></span></td>
		<td data-name="alamat_pegawai" <?php echo $m_pegawai_view->alamat_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_alamat_pegawai">
<span<?php echo $m_pegawai_view->alamat_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->alamat_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->hp_pegawai->Visible) { // hp_pegawai ?>
	<tr id="r_hp_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_hp_pegawai"><?php echo $m_pegawai_view->hp_pegawai->caption() ?></span></td>
		<td data-name="hp_pegawai" <?php echo $m_pegawai_view->hp_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_hp_pegawai">
<span<?php echo $m_pegawai_view->hp_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->hp_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->pendidikan_pegawai->Visible) { // pendidikan_pegawai ?>
	<tr id="r_pendidikan_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_pendidikan_pegawai"><?php echo $m_pegawai_view->pendidikan_pegawai->caption() ?></span></td>
		<td data-name="pendidikan_pegawai" <?php echo $m_pegawai_view->pendidikan_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_pendidikan_pegawai">
<span<?php echo $m_pegawai_view->pendidikan_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->pendidikan_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->jurusan_pegawai->Visible) { // jurusan_pegawai ?>
	<tr id="r_jurusan_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_jurusan_pegawai"><?php echo $m_pegawai_view->jurusan_pegawai->caption() ?></span></td>
		<td data-name="jurusan_pegawai" <?php echo $m_pegawai_view->jurusan_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_jurusan_pegawai">
<span<?php echo $m_pegawai_view->jurusan_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->jurusan_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
	<tr id="r_spesialis_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_spesialis_pegawai"><?php echo $m_pegawai_view->spesialis_pegawai->caption() ?></span></td>
		<td data-name="spesialis_pegawai" <?php echo $m_pegawai_view->spesialis_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_spesialis_pegawai">
<span<?php echo $m_pegawai_view->spesialis_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->spesialis_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
	<tr id="r_jabatan_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_jabatan_pegawai"><?php echo $m_pegawai_view->jabatan_pegawai->caption() ?></span></td>
		<td data-name="jabatan_pegawai" <?php echo $m_pegawai_view->jabatan_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_jabatan_pegawai">
<span<?php echo $m_pegawai_view->jabatan_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->jabatan_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->status_pegawai->Visible) { // status_pegawai ?>
	<tr id="r_status_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_status_pegawai"><?php echo $m_pegawai_view->status_pegawai->caption() ?></span></td>
		<td data-name="status_pegawai" <?php echo $m_pegawai_view->status_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_status_pegawai">
<span<?php echo $m_pegawai_view->status_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->status_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->tarif_pegawai->Visible) { // tarif_pegawai ?>
	<tr id="r_tarif_pegawai">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_tarif_pegawai"><?php echo $m_pegawai_view->tarif_pegawai->caption() ?></span></td>
		<td data-name="tarif_pegawai" <?php echo $m_pegawai_view->tarif_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_tarif_pegawai">
<span<?php echo $m_pegawai_view->tarif_pegawai->viewAttributes() ?>><?php echo $m_pegawai_view->tarif_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_id_klinik"><?php echo $m_pegawai_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_pegawai_view->id_klinik->cellAttributes() ?>>
<span id="el_m_pegawai_id_klinik">
<span<?php echo $m_pegawai_view->id_klinik->viewAttributes() ?>><?php echo $m_pegawai_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_pegawai_view->nilai_komisi->Visible) { // nilai_komisi ?>
	<tr id="r_nilai_komisi">
		<td class="<?php echo $m_pegawai_view->TableLeftColumnClass ?>"><span id="elh_m_pegawai_nilai_komisi"><?php echo $m_pegawai_view->nilai_komisi->caption() ?></span></td>
		<td data-name="nilai_komisi" <?php echo $m_pegawai_view->nilai_komisi->cellAttributes() ?>>
<span id="el_m_pegawai_nilai_komisi">
<span<?php echo $m_pegawai_view->nilai_komisi->viewAttributes() ?>><?php echo $m_pegawai_view->nilai_komisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_pegawai_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_pegawai_view->isExport()) { ?>
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
$m_pegawai_view->terminate();
?>