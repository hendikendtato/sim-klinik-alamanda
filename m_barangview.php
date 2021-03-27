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
$m_barang_view = new m_barang_view();

// Run the page
$m_barang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_barang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_barang_view->isExport()) { ?>
<script>
var fm_barangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_barangview = currentForm = new ew.Form("fm_barangview", "view");
	loadjs.done("fm_barangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_barang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_barang_view->ExportOptions->render("body") ?>
<?php $m_barang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_barang_view->showPageHeader(); ?>
<?php
$m_barang_view->showMessage();
?>
<form name="fm_barangview" id="fm_barangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_barang">
<input type="hidden" name="modal" value="<?php echo (int)$m_barang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_barang_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_id"><?php echo $m_barang_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_barang_view->id->cellAttributes() ?>>
<span id="el_m_barang_id">
<span<?php echo $m_barang_view->id->viewAttributes() ?>><?php echo $m_barang_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->kode_barang->Visible) { // kode_barang ?>
	<tr id="r_kode_barang">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_kode_barang"><?php echo $m_barang_view->kode_barang->caption() ?></span></td>
		<td data-name="kode_barang" <?php echo $m_barang_view->kode_barang->cellAttributes() ?>>
<span id="el_m_barang_kode_barang">
<span<?php echo $m_barang_view->kode_barang->viewAttributes() ?>><?php echo $m_barang_view->kode_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->nama_barang->Visible) { // nama_barang ?>
	<tr id="r_nama_barang">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_nama_barang"><?php echo $m_barang_view->nama_barang->caption() ?></span></td>
		<td data-name="nama_barang" <?php echo $m_barang_view->nama_barang->cellAttributes() ?>>
<span id="el_m_barang_nama_barang">
<span<?php echo $m_barang_view->nama_barang->viewAttributes() ?>><?php echo $m_barang_view->nama_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->satuan->Visible) { // satuan ?>
	<tr id="r_satuan">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_satuan"><?php echo $m_barang_view->satuan->caption() ?></span></td>
		<td data-name="satuan" <?php echo $m_barang_view->satuan->cellAttributes() ?>>
<span id="el_m_barang_satuan">
<span<?php echo $m_barang_view->satuan->viewAttributes() ?>><?php echo $m_barang_view->satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_jenis"><?php echo $m_barang_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $m_barang_view->jenis->cellAttributes() ?>>
<span id="el_m_barang_jenis">
<span<?php echo $m_barang_view->jenis->viewAttributes() ?>><?php echo $m_barang_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->kategori->Visible) { // kategori ?>
	<tr id="r_kategori">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_kategori"><?php echo $m_barang_view->kategori->caption() ?></span></td>
		<td data-name="kategori" <?php echo $m_barang_view->kategori->cellAttributes() ?>>
<span id="el_m_barang_kategori">
<span<?php echo $m_barang_view->kategori->viewAttributes() ?>><?php echo $m_barang_view->kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->subkategori->Visible) { // subkategori ?>
	<tr id="r_subkategori">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_subkategori"><?php echo $m_barang_view->subkategori->caption() ?></span></td>
		<td data-name="subkategori" <?php echo $m_barang_view->subkategori->cellAttributes() ?>>
<span id="el_m_barang_subkategori">
<span<?php echo $m_barang_view->subkategori->viewAttributes() ?>><?php echo $m_barang_view->subkategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->komposisi->Visible) { // komposisi ?>
	<tr id="r_komposisi">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_komposisi"><?php echo $m_barang_view->komposisi->caption() ?></span></td>
		<td data-name="komposisi" <?php echo $m_barang_view->komposisi->cellAttributes() ?>>
<span id="el_m_barang_komposisi">
<span<?php echo $m_barang_view->komposisi->viewAttributes() ?>><?php echo $m_barang_view->komposisi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->tipe->Visible) { // tipe ?>
	<tr id="r_tipe">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_tipe"><?php echo $m_barang_view->tipe->caption() ?></span></td>
		<td data-name="tipe" <?php echo $m_barang_view->tipe->cellAttributes() ?>>
<span id="el_m_barang_tipe">
<span<?php echo $m_barang_view->tipe->viewAttributes() ?>><?php echo $m_barang_view->tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_status"><?php echo $m_barang_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $m_barang_view->status->cellAttributes() ?>>
<span id="el_m_barang_status">
<span<?php echo $m_barang_view->status->viewAttributes() ?>><?php echo $m_barang_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->shortname_barang->Visible) { // shortname_barang ?>
	<tr id="r_shortname_barang">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_shortname_barang"><?php echo $m_barang_view->shortname_barang->caption() ?></span></td>
		<td data-name="shortname_barang" <?php echo $m_barang_view->shortname_barang->cellAttributes() ?>>
<span id="el_m_barang_shortname_barang">
<span<?php echo $m_barang_view->shortname_barang->viewAttributes() ?>><?php echo $m_barang_view->shortname_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->id_tag->Visible) { // id_tag ?>
	<tr id="r_id_tag">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_id_tag"><?php echo $m_barang_view->id_tag->caption() ?></span></td>
		<td data-name="id_tag" <?php echo $m_barang_view->id_tag->cellAttributes() ?>>
<span id="el_m_barang_id_tag">
<span<?php echo $m_barang_view->id_tag->viewAttributes() ?>><?php echo $m_barang_view->id_tag->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_barang_view->discontinue->Visible) { // discontinue ?>
	<tr id="r_discontinue">
		<td class="<?php echo $m_barang_view->TableLeftColumnClass ?>"><span id="elh_m_barang_discontinue"><?php echo $m_barang_view->discontinue->caption() ?></span></td>
		<td data-name="discontinue" <?php echo $m_barang_view->discontinue->cellAttributes() ?>>
<span id="el_m_barang_discontinue">
<span<?php echo $m_barang_view->discontinue->viewAttributes() ?>><?php echo $m_barang_view->discontinue->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_barang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_barang_view->isExport()) { ?>
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
$m_barang_view->terminate();
?>