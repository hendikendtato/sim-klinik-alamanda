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
$m_hargajual_view = new m_hargajual_view();

// Run the page
$m_hargajual_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_hargajual_view->isExport()) { ?>
<script>
var fm_hargajualview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_hargajualview = currentForm = new ew.Form("fm_hargajualview", "view");
	loadjs.done("fm_hargajualview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_hargajual_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_hargajual_view->ExportOptions->render("body") ?>
<?php $m_hargajual_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_hargajual_view->showPageHeader(); ?>
<?php
$m_hargajual_view->showMessage();
?>
<form name="fm_hargajualview" id="fm_hargajualview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual">
<input type="hidden" name="modal" value="<?php echo (int)$m_hargajual_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_hargajual_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_id_barang"><?php echo $m_hargajual_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $m_hargajual_view->id_barang->cellAttributes() ?>>
<span id="el_m_hargajual_id_barang">
<span<?php echo $m_hargajual_view->id_barang->viewAttributes() ?>><?php echo $m_hargajual_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->totalhargajual->Visible) { // totalhargajual ?>
	<tr id="r_totalhargajual">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_totalhargajual"><?php echo $m_hargajual_view->totalhargajual->caption() ?></span></td>
		<td data-name="totalhargajual" <?php echo $m_hargajual_view->totalhargajual->cellAttributes() ?>>
<span id="el_m_hargajual_totalhargajual">
<span<?php echo $m_hargajual_view->totalhargajual->viewAttributes() ?>><?php echo $m_hargajual_view->totalhargajual->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->disc_pr->Visible) { // disc_pr ?>
	<tr id="r_disc_pr">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_disc_pr"><?php echo $m_hargajual_view->disc_pr->caption() ?></span></td>
		<td data-name="disc_pr" <?php echo $m_hargajual_view->disc_pr->cellAttributes() ?>>
<span id="el_m_hargajual_disc_pr">
<span<?php echo $m_hargajual_view->disc_pr->viewAttributes() ?>><?php echo $m_hargajual_view->disc_pr->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->disc_rp->Visible) { // disc_rp ?>
	<tr id="r_disc_rp">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_disc_rp"><?php echo $m_hargajual_view->disc_rp->caption() ?></span></td>
		<td data-name="disc_rp" <?php echo $m_hargajual_view->disc_rp->cellAttributes() ?>>
<span id="el_m_hargajual_disc_rp">
<span<?php echo $m_hargajual_view->disc_rp->viewAttributes() ?>><?php echo $m_hargajual_view->disc_rp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_id_klinik"><?php echo $m_hargajual_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_hargajual_view->id_klinik->cellAttributes() ?>>
<span id="el_m_hargajual_id_klinik">
<span<?php echo $m_hargajual_view->id_klinik->viewAttributes() ?>><?php echo $m_hargajual_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->stok->Visible) { // stok ?>
	<tr id="r_stok">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_stok"><?php echo $m_hargajual_view->stok->caption() ?></span></td>
		<td data-name="stok" <?php echo $m_hargajual_view->stok->cellAttributes() ?>>
<span id="el_m_hargajual_stok">
<span<?php echo $m_hargajual_view->stok->viewAttributes() ?>><?php echo $m_hargajual_view->stok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->satuan->Visible) { // satuan ?>
	<tr id="r_satuan">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_satuan"><?php echo $m_hargajual_view->satuan->caption() ?></span></td>
		<td data-name="satuan" <?php echo $m_hargajual_view->satuan->cellAttributes() ?>>
<span id="el_m_hargajual_satuan">
<span<?php echo $m_hargajual_view->satuan->viewAttributes() ?>><?php echo $m_hargajual_view->satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->minimum_stok->Visible) { // minimum_stok ?>
	<tr id="r_minimum_stok">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_minimum_stok"><?php echo $m_hargajual_view->minimum_stok->caption() ?></span></td>
		<td data-name="minimum_stok" <?php echo $m_hargajual_view->minimum_stok->cellAttributes() ?>>
<span id="el_m_hargajual_minimum_stok">
<span<?php echo $m_hargajual_view->minimum_stok->viewAttributes() ?>><?php echo $m_hargajual_view->minimum_stok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->tgl_masuk->Visible) { // tgl_masuk ?>
	<tr id="r_tgl_masuk">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_tgl_masuk"><?php echo $m_hargajual_view->tgl_masuk->caption() ?></span></td>
		<td data-name="tgl_masuk" <?php echo $m_hargajual_view->tgl_masuk->cellAttributes() ?>>
<span id="el_m_hargajual_tgl_masuk">
<span<?php echo $m_hargajual_view->tgl_masuk->viewAttributes() ?>><?php echo $m_hargajual_view->tgl_masuk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->tgl_exp->Visible) { // tgl_exp ?>
	<tr id="r_tgl_exp">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_tgl_exp"><?php echo $m_hargajual_view->tgl_exp->caption() ?></span></td>
		<td data-name="tgl_exp" <?php echo $m_hargajual_view->tgl_exp->cellAttributes() ?>>
<span id="el_m_hargajual_tgl_exp">
<span<?php echo $m_hargajual_view->tgl_exp->viewAttributes() ?>><?php echo $m_hargajual_view->tgl_exp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->kategori->Visible) { // kategori ?>
	<tr id="r_kategori">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_kategori"><?php echo $m_hargajual_view->kategori->caption() ?></span></td>
		<td data-name="kategori" <?php echo $m_hargajual_view->kategori->cellAttributes() ?>>
<span id="el_m_hargajual_kategori">
<span<?php echo $m_hargajual_view->kategori->viewAttributes() ?>><?php echo $m_hargajual_view->kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_hargajual_view->subkategori->Visible) { // subkategori ?>
	<tr id="r_subkategori">
		<td class="<?php echo $m_hargajual_view->TableLeftColumnClass ?>"><span id="elh_m_hargajual_subkategori"><?php echo $m_hargajual_view->subkategori->caption() ?></span></td>
		<td data-name="subkategori" <?php echo $m_hargajual_view->subkategori->cellAttributes() ?>>
<span id="el_m_hargajual_subkategori">
<span<?php echo $m_hargajual_view->subkategori->viewAttributes() ?>><?php echo $m_hargajual_view->subkategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_hargajual_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_hargajual_view->isExport()) { ?>
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
$m_hargajual_view->terminate();
?>