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
$penjualan_view = new penjualan_view();

// Run the page
$penjualan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penjualan_view->isExport()) { ?>
<script>
var fpenjualanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpenjualanview = currentForm = new ew.Form("fpenjualanview", "view");
	loadjs.done("fpenjualanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penjualan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $penjualan_view->ExportOptions->render("body") ?>
<?php $penjualan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $penjualan_view->showPageHeader(); ?>
<?php
$penjualan_view->showMessage();
?>
<form name="fpenjualanview" id="fpenjualanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan">
<input type="hidden" name="modal" value="<?php echo (int)$penjualan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($penjualan_view->kode_penjualan->Visible) { // kode_penjualan ?>
	<tr id="r_kode_penjualan">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_kode_penjualan"><?php echo $penjualan_view->kode_penjualan->caption() ?></span></td>
		<td data-name="kode_penjualan" <?php echo $penjualan_view->kode_penjualan->cellAttributes() ?>>
<span id="el_penjualan_kode_penjualan">
<span<?php echo $penjualan_view->kode_penjualan->viewAttributes() ?>><?php echo $penjualan_view->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_pelanggan->Visible) { // id_pelanggan ?>
	<tr id="r_id_pelanggan">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_pelanggan"><?php echo $penjualan_view->id_pelanggan->caption() ?></span></td>
		<td data-name="id_pelanggan" <?php echo $penjualan_view->id_pelanggan->cellAttributes() ?>>
<span id="el_penjualan_id_pelanggan">
<span<?php echo $penjualan_view->id_pelanggan->viewAttributes() ?>><?php echo $penjualan_view->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_member->Visible) { // id_member ?>
	<tr id="r_id_member">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_member"><?php echo $penjualan_view->id_member->caption() ?></span></td>
		<td data-name="id_member" <?php echo $penjualan_view->id_member->cellAttributes() ?>>
<span id="el_penjualan_id_member">
<span<?php echo $penjualan_view->id_member->viewAttributes() ?>><?php echo $penjualan_view->id_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->waktu->Visible) { // waktu ?>
	<tr id="r_waktu">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_waktu"><?php echo $penjualan_view->waktu->caption() ?></span></td>
		<td data-name="waktu" <?php echo $penjualan_view->waktu->cellAttributes() ?>>
<span id="el_penjualan_waktu">
<span<?php echo $penjualan_view->waktu->viewAttributes() ?>><?php echo $penjualan_view->waktu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->diskon_persen->Visible) { // diskon_persen ?>
	<tr id="r_diskon_persen">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_diskon_persen"><?php echo $penjualan_view->diskon_persen->caption() ?></span></td>
		<td data-name="diskon_persen" <?php echo $penjualan_view->diskon_persen->cellAttributes() ?>>
<span id="el_penjualan_diskon_persen">
<span<?php echo $penjualan_view->diskon_persen->viewAttributes() ?>><?php echo $penjualan_view->diskon_persen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->diskon_rupiah->Visible) { // diskon_rupiah ?>
	<tr id="r_diskon_rupiah">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_diskon_rupiah"><?php echo $penjualan_view->diskon_rupiah->caption() ?></span></td>
		<td data-name="diskon_rupiah" <?php echo $penjualan_view->diskon_rupiah->cellAttributes() ?>>
<span id="el_penjualan_diskon_rupiah">
<span<?php echo $penjualan_view->diskon_rupiah->viewAttributes() ?>><?php echo $penjualan_view->diskon_rupiah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->ppn->Visible) { // ppn ?>
	<tr id="r_ppn">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_ppn"><?php echo $penjualan_view->ppn->caption() ?></span></td>
		<td data-name="ppn" <?php echo $penjualan_view->ppn->cellAttributes() ?>>
<span id="el_penjualan_ppn">
<span<?php echo $penjualan_view->ppn->viewAttributes() ?>><?php echo $penjualan_view->ppn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_total"><?php echo $penjualan_view->total->caption() ?></span></td>
		<td data-name="total" <?php echo $penjualan_view->total->cellAttributes() ?>>
<span id="el_penjualan_total">
<span<?php echo $penjualan_view->total->viewAttributes() ?>><?php echo $penjualan_view->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->bayar->Visible) { // bayar ?>
	<tr id="r_bayar">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_bayar"><?php echo $penjualan_view->bayar->caption() ?></span></td>
		<td data-name="bayar" <?php echo $penjualan_view->bayar->cellAttributes() ?>>
<span id="el_penjualan_bayar">
<span<?php echo $penjualan_view->bayar->viewAttributes() ?>><?php echo $penjualan_view->bayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
	<tr id="r_bayar_non_tunai">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_bayar_non_tunai"><?php echo $penjualan_view->bayar_non_tunai->caption() ?></span></td>
		<td data-name="bayar_non_tunai" <?php echo $penjualan_view->bayar_non_tunai->cellAttributes() ?>>
<span id="el_penjualan_bayar_non_tunai">
<span<?php echo $penjualan_view->bayar_non_tunai->viewAttributes() ?>><?php echo $penjualan_view->bayar_non_tunai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<tr id="r_total_non_tunai_charge">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_total_non_tunai_charge"><?php echo $penjualan_view->total_non_tunai_charge->caption() ?></span></td>
		<td data-name="total_non_tunai_charge" <?php echo $penjualan_view->total_non_tunai_charge->cellAttributes() ?>>
<span id="el_penjualan_total_non_tunai_charge">
<span<?php echo $penjualan_view->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan_view->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_keterangan"><?php echo $penjualan_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $penjualan_view->keterangan->cellAttributes() ?>>
<span id="el_penjualan_keterangan">
<span<?php echo $penjualan_view->keterangan->viewAttributes() ?>><?php echo $penjualan_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_klinik"><?php echo $penjualan_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $penjualan_view->id_klinik->cellAttributes() ?>>
<span id="el_penjualan_id_klinik">
<span<?php echo $penjualan_view->id_klinik->viewAttributes() ?>><?php echo $penjualan_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_rmd->Visible) { // id_rmd ?>
	<tr id="r_id_rmd">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_rmd"><?php echo $penjualan_view->id_rmd->caption() ?></span></td>
		<td data-name="id_rmd" <?php echo $penjualan_view->id_rmd->cellAttributes() ?>>
<span id="el_penjualan_id_rmd">
<span<?php echo $penjualan_view->id_rmd->viewAttributes() ?>><?php echo $penjualan_view->id_rmd->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<tr id="r_metode_pembayaran">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_metode_pembayaran"><?php echo $penjualan_view->metode_pembayaran->caption() ?></span></td>
		<td data-name="metode_pembayaran" <?php echo $penjualan_view->metode_pembayaran->cellAttributes() ?>>
<span id="el_penjualan_metode_pembayaran">
<span<?php echo $penjualan_view->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan_view->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_bank->Visible) { // id_bank ?>
	<tr id="r_id_bank">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_bank"><?php echo $penjualan_view->id_bank->caption() ?></span></td>
		<td data-name="id_bank" <?php echo $penjualan_view->id_bank->cellAttributes() ?>>
<span id="el_penjualan_id_bank">
<span<?php echo $penjualan_view->id_bank->viewAttributes() ?>><?php echo $penjualan_view->id_bank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_kartu->Visible) { // id_kartu ?>
	<tr id="r_id_kartu">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_kartu"><?php echo $penjualan_view->id_kartu->caption() ?></span></td>
		<td data-name="id_kartu" <?php echo $penjualan_view->id_kartu->cellAttributes() ?>>
<span id="el_penjualan_id_kartu">
<span<?php echo $penjualan_view->id_kartu->viewAttributes() ?>><?php echo $penjualan_view->id_kartu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->sales->Visible) { // sales ?>
	<tr id="r_sales">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_sales"><?php echo $penjualan_view->sales->caption() ?></span></td>
		<td data-name="sales" <?php echo $penjualan_view->sales->cellAttributes() ?>>
<span id="el_penjualan_sales">
<span<?php echo $penjualan_view->sales->viewAttributes() ?>><?php echo $penjualan_view->sales->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->dok_be_wajah->Visible) { // dok_be_wajah ?>
	<tr id="r_dok_be_wajah">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_dok_be_wajah"><?php echo $penjualan_view->dok_be_wajah->caption() ?></span></td>
		<td data-name="dok_be_wajah" <?php echo $penjualan_view->dok_be_wajah->cellAttributes() ?>>
<span id="el_penjualan_dok_be_wajah">
<span<?php echo $penjualan_view->dok_be_wajah->viewAttributes() ?>><?php echo $penjualan_view->dok_be_wajah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->be_body->Visible) { // be_body ?>
	<tr id="r_be_body">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_be_body"><?php echo $penjualan_view->be_body->caption() ?></span></td>
		<td data-name="be_body" <?php echo $penjualan_view->be_body->cellAttributes() ?>>
<span id="el_penjualan_be_body">
<span<?php echo $penjualan_view->be_body->viewAttributes() ?>><?php echo $penjualan_view->be_body->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->medis->Visible) { // medis ?>
	<tr id="r_medis">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_medis"><?php echo $penjualan_view->medis->caption() ?></span></td>
		<td data-name="medis" <?php echo $penjualan_view->medis->cellAttributes() ?>>
<span id="el_penjualan_medis">
<span<?php echo $penjualan_view->medis->viewAttributes() ?>><?php echo $penjualan_view->medis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->dokter->Visible) { // dokter ?>
	<tr id="r_dokter">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_dokter"><?php echo $penjualan_view->dokter->caption() ?></span></td>
		<td data-name="dokter" <?php echo $penjualan_view->dokter->cellAttributes() ?>>
<span id="el_penjualan_dokter">
<span<?php echo $penjualan_view->dokter->viewAttributes() ?>><?php echo $penjualan_view->dokter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_kartubank->Visible) { // id_kartubank ?>
	<tr id="r_id_kartubank">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_kartubank"><?php echo $penjualan_view->id_kartubank->caption() ?></span></td>
		<td data-name="id_kartubank" <?php echo $penjualan_view->id_kartubank->cellAttributes() ?>>
<span id="el_penjualan_id_kartubank">
<span<?php echo $penjualan_view->id_kartubank->viewAttributes() ?>><?php echo $penjualan_view->id_kartubank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->id_kas->Visible) { // id_kas ?>
	<tr id="r_id_kas">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_id_kas"><?php echo $penjualan_view->id_kas->caption() ?></span></td>
		<td data-name="id_kas" <?php echo $penjualan_view->id_kas->cellAttributes() ?>>
<span id="el_penjualan_id_kas">
<span<?php echo $penjualan_view->id_kas->viewAttributes() ?>><?php echo $penjualan_view->id_kas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->charge->Visible) { // charge ?>
	<tr id="r_charge">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_charge"><?php echo $penjualan_view->charge->caption() ?></span></td>
		<td data-name="charge" <?php echo $penjualan_view->charge->cellAttributes() ?>>
<span id="el_penjualan_charge">
<span<?php echo $penjualan_view->charge->viewAttributes() ?>><?php echo $penjualan_view->charge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->klaim_poin->Visible) { // klaim_poin ?>
	<tr id="r_klaim_poin">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_klaim_poin"><?php echo $penjualan_view->klaim_poin->caption() ?></span></td>
		<td data-name="klaim_poin" <?php echo $penjualan_view->klaim_poin->cellAttributes() ?>>
<span id="el_penjualan_klaim_poin">
<span<?php echo $penjualan_view->klaim_poin->viewAttributes() ?>><?php echo $penjualan_view->klaim_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<tr id="r_total_penukaran_poin">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_total_penukaran_poin"><?php echo $penjualan_view->total_penukaran_poin->caption() ?></span></td>
		<td data-name="total_penukaran_poin" <?php echo $penjualan_view->total_penukaran_poin->cellAttributes() ?>>
<span id="el_penjualan_total_penukaran_poin">
<span<?php echo $penjualan_view->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan_view->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->ongkir->Visible) { // ongkir ?>
	<tr id="r_ongkir">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_ongkir"><?php echo $penjualan_view->ongkir->caption() ?></span></td>
		<td data-name="ongkir" <?php echo $penjualan_view->ongkir->cellAttributes() ?>>
<span id="el_penjualan_ongkir">
<span<?php echo $penjualan_view->ongkir->viewAttributes() ?>><?php echo $penjualan_view->ongkir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->_action->Visible) { // action ?>
	<tr id="r__action">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan__action"><?php echo $penjualan_view->_action->caption() ?></span></td>
		<td data-name="_action" <?php echo $penjualan_view->_action->cellAttributes() ?>>
<span id="el_penjualan__action">
<span<?php echo $penjualan_view->_action->viewAttributes() ?>><?php echo $penjualan_view->_action->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_status"><?php echo $penjualan_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $penjualan_view->status->cellAttributes() ?>>
<span id="el_penjualan_status">
<span<?php echo $penjualan_view->status->viewAttributes() ?>><?php echo $penjualan_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_view->status_void->Visible) { // status_void ?>
	<tr id="r_status_void">
		<td class="<?php echo $penjualan_view->TableLeftColumnClass ?>"><span id="elh_penjualan_status_void"><?php echo $penjualan_view->status_void->caption() ?></span></td>
		<td data-name="status_void" <?php echo $penjualan_view->status_void->cellAttributes() ?>>
<span id="el_penjualan_status_void">
<span<?php echo $penjualan_view->status_void->viewAttributes() ?>><?php echo $penjualan_view->status_void->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailpenjualan", explode(",", $penjualan->getCurrentDetailTable())) && $detailpenjualan->DetailView) {
?>
<?php if ($penjualan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenjualan", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $penjualan_view->detailpenjualan_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "detailpenjualangrid.php" ?>
<?php } ?>
</form>
<?php
$penjualan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penjualan_view->isExport()) { ?>
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
$penjualan_view->terminate();
?>