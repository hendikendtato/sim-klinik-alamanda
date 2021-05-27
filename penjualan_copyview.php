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
$penjualan_copy_view = new penjualan_copy_view();

// Run the page
$penjualan_copy_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_copy_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penjualan_copy_view->isExport()) { ?>
<script>
var fpenjualan_copyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpenjualan_copyview = currentForm = new ew.Form("fpenjualan_copyview", "view");
	loadjs.done("fpenjualan_copyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$penjualan_copy_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $penjualan_copy_view->ExportOptions->render("body") ?>
<?php $penjualan_copy_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $penjualan_copy_view->showPageHeader(); ?>
<?php
$penjualan_copy_view->showMessage();
?>
<form name="fpenjualan_copyview" id="fpenjualan_copyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan_copy">
<input type="hidden" name="modal" value="<?php echo (int)$penjualan_copy_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($penjualan_copy_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id"><?php echo $penjualan_copy_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $penjualan_copy_view->id->cellAttributes() ?>>
<span id="el_penjualan_copy_id">
<span<?php echo $penjualan_copy_view->id->viewAttributes() ?>><?php echo $penjualan_copy_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->waktu->Visible) { // waktu ?>
	<tr id="r_waktu">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_waktu"><?php echo $penjualan_copy_view->waktu->caption() ?></span></td>
		<td data-name="waktu" <?php echo $penjualan_copy_view->waktu->cellAttributes() ?>>
<span id="el_penjualan_copy_waktu">
<span<?php echo $penjualan_copy_view->waktu->viewAttributes() ?>><?php echo $penjualan_copy_view->waktu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_pelanggan->Visible) { // id_pelanggan ?>
	<tr id="r_id_pelanggan">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_pelanggan"><?php echo $penjualan_copy_view->id_pelanggan->caption() ?></span></td>
		<td data-name="id_pelanggan" <?php echo $penjualan_copy_view->id_pelanggan->cellAttributes() ?>>
<span id="el_penjualan_copy_id_pelanggan">
<span<?php echo $penjualan_copy_view->id_pelanggan->viewAttributes() ?>><?php echo $penjualan_copy_view->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_member->Visible) { // id_member ?>
	<tr id="r_id_member">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_member"><?php echo $penjualan_copy_view->id_member->caption() ?></span></td>
		<td data-name="id_member" <?php echo $penjualan_copy_view->id_member->cellAttributes() ?>>
<span id="el_penjualan_copy_id_member">
<span<?php echo $penjualan_copy_view->id_member->viewAttributes() ?>><?php echo $penjualan_copy_view->id_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->diskon_persen->Visible) { // diskon_persen ?>
	<tr id="r_diskon_persen">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_diskon_persen"><?php echo $penjualan_copy_view->diskon_persen->caption() ?></span></td>
		<td data-name="diskon_persen" <?php echo $penjualan_copy_view->diskon_persen->cellAttributes() ?>>
<span id="el_penjualan_copy_diskon_persen">
<span<?php echo $penjualan_copy_view->diskon_persen->viewAttributes() ?>><?php echo $penjualan_copy_view->diskon_persen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->diskon_rupiah->Visible) { // diskon_rupiah ?>
	<tr id="r_diskon_rupiah">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_diskon_rupiah"><?php echo $penjualan_copy_view->diskon_rupiah->caption() ?></span></td>
		<td data-name="diskon_rupiah" <?php echo $penjualan_copy_view->diskon_rupiah->cellAttributes() ?>>
<span id="el_penjualan_copy_diskon_rupiah">
<span<?php echo $penjualan_copy_view->diskon_rupiah->viewAttributes() ?>><?php echo $penjualan_copy_view->diskon_rupiah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->ppn->Visible) { // ppn ?>
	<tr id="r_ppn">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_ppn"><?php echo $penjualan_copy_view->ppn->caption() ?></span></td>
		<td data-name="ppn" <?php echo $penjualan_copy_view->ppn->cellAttributes() ?>>
<span id="el_penjualan_copy_ppn">
<span<?php echo $penjualan_copy_view->ppn->viewAttributes() ?>><?php echo $penjualan_copy_view->ppn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_total"><?php echo $penjualan_copy_view->total->caption() ?></span></td>
		<td data-name="total" <?php echo $penjualan_copy_view->total->cellAttributes() ?>>
<span id="el_penjualan_copy_total">
<span<?php echo $penjualan_copy_view->total->viewAttributes() ?>><?php echo $penjualan_copy_view->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->bayar->Visible) { // bayar ?>
	<tr id="r_bayar">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_bayar"><?php echo $penjualan_copy_view->bayar->caption() ?></span></td>
		<td data-name="bayar" <?php echo $penjualan_copy_view->bayar->cellAttributes() ?>>
<span id="el_penjualan_copy_bayar">
<span<?php echo $penjualan_copy_view->bayar->viewAttributes() ?>><?php echo $penjualan_copy_view->bayar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
	<tr id="r_bayar_non_tunai">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_bayar_non_tunai"><?php echo $penjualan_copy_view->bayar_non_tunai->caption() ?></span></td>
		<td data-name="bayar_non_tunai" <?php echo $penjualan_copy_view->bayar_non_tunai->cellAttributes() ?>>
<span id="el_penjualan_copy_bayar_non_tunai">
<span<?php echo $penjualan_copy_view->bayar_non_tunai->viewAttributes() ?>><?php echo $penjualan_copy_view->bayar_non_tunai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<tr id="r_total_non_tunai_charge">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_total_non_tunai_charge"><?php echo $penjualan_copy_view->total_non_tunai_charge->caption() ?></span></td>
		<td data-name="total_non_tunai_charge" <?php echo $penjualan_copy_view->total_non_tunai_charge->cellAttributes() ?>>
<span id="el_penjualan_copy_total_non_tunai_charge">
<span<?php echo $penjualan_copy_view->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan_copy_view->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->kode_penjualan->Visible) { // kode_penjualan ?>
	<tr id="r_kode_penjualan">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_kode_penjualan"><?php echo $penjualan_copy_view->kode_penjualan->caption() ?></span></td>
		<td data-name="kode_penjualan" <?php echo $penjualan_copy_view->kode_penjualan->cellAttributes() ?>>
<span id="el_penjualan_copy_kode_penjualan">
<span<?php echo $penjualan_copy_view->kode_penjualan->viewAttributes() ?>><?php echo $penjualan_copy_view->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_keterangan"><?php echo $penjualan_copy_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $penjualan_copy_view->keterangan->cellAttributes() ?>>
<span id="el_penjualan_copy_keterangan">
<span<?php echo $penjualan_copy_view->keterangan->viewAttributes() ?>><?php echo $penjualan_copy_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->dokter->Visible) { // dokter ?>
	<tr id="r_dokter">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_dokter"><?php echo $penjualan_copy_view->dokter->caption() ?></span></td>
		<td data-name="dokter" <?php echo $penjualan_copy_view->dokter->cellAttributes() ?>>
<span id="el_penjualan_copy_dokter">
<span<?php echo $penjualan_copy_view->dokter->viewAttributes() ?>><?php echo $penjualan_copy_view->dokter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->sales->Visible) { // sales ?>
	<tr id="r_sales">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_sales"><?php echo $penjualan_copy_view->sales->caption() ?></span></td>
		<td data-name="sales" <?php echo $penjualan_copy_view->sales->cellAttributes() ?>>
<span id="el_penjualan_copy_sales">
<span<?php echo $penjualan_copy_view->sales->viewAttributes() ?>><?php echo $penjualan_copy_view->sales->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->dok_be_wajah->Visible) { // dok_be_wajah ?>
	<tr id="r_dok_be_wajah">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_dok_be_wajah"><?php echo $penjualan_copy_view->dok_be_wajah->caption() ?></span></td>
		<td data-name="dok_be_wajah" <?php echo $penjualan_copy_view->dok_be_wajah->cellAttributes() ?>>
<span id="el_penjualan_copy_dok_be_wajah">
<span<?php echo $penjualan_copy_view->dok_be_wajah->viewAttributes() ?>><?php echo $penjualan_copy_view->dok_be_wajah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->be_body->Visible) { // be_body ?>
	<tr id="r_be_body">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_be_body"><?php echo $penjualan_copy_view->be_body->caption() ?></span></td>
		<td data-name="be_body" <?php echo $penjualan_copy_view->be_body->cellAttributes() ?>>
<span id="el_penjualan_copy_be_body">
<span<?php echo $penjualan_copy_view->be_body->viewAttributes() ?>><?php echo $penjualan_copy_view->be_body->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->medis->Visible) { // medis ?>
	<tr id="r_medis">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_medis"><?php echo $penjualan_copy_view->medis->caption() ?></span></td>
		<td data-name="medis" <?php echo $penjualan_copy_view->medis->cellAttributes() ?>>
<span id="el_penjualan_copy_medis">
<span<?php echo $penjualan_copy_view->medis->viewAttributes() ?>><?php echo $penjualan_copy_view->medis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_klinik"><?php echo $penjualan_copy_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $penjualan_copy_view->id_klinik->cellAttributes() ?>>
<span id="el_penjualan_copy_id_klinik">
<span<?php echo $penjualan_copy_view->id_klinik->viewAttributes() ?>><?php echo $penjualan_copy_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_rmd->Visible) { // id_rmd ?>
	<tr id="r_id_rmd">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_rmd"><?php echo $penjualan_copy_view->id_rmd->caption() ?></span></td>
		<td data-name="id_rmd" <?php echo $penjualan_copy_view->id_rmd->cellAttributes() ?>>
<span id="el_penjualan_copy_id_rmd">
<span<?php echo $penjualan_copy_view->id_rmd->viewAttributes() ?>><?php echo $penjualan_copy_view->id_rmd->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<tr id="r_metode_pembayaran">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_metode_pembayaran"><?php echo $penjualan_copy_view->metode_pembayaran->caption() ?></span></td>
		<td data-name="metode_pembayaran" <?php echo $penjualan_copy_view->metode_pembayaran->cellAttributes() ?>>
<span id="el_penjualan_copy_metode_pembayaran">
<span<?php echo $penjualan_copy_view->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan_copy_view->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_bank->Visible) { // id_bank ?>
	<tr id="r_id_bank">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_bank"><?php echo $penjualan_copy_view->id_bank->caption() ?></span></td>
		<td data-name="id_bank" <?php echo $penjualan_copy_view->id_bank->cellAttributes() ?>>
<span id="el_penjualan_copy_id_bank">
<span<?php echo $penjualan_copy_view->id_bank->viewAttributes() ?>><?php echo $penjualan_copy_view->id_bank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_kartu->Visible) { // id_kartu ?>
	<tr id="r_id_kartu">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_kartu"><?php echo $penjualan_copy_view->id_kartu->caption() ?></span></td>
		<td data-name="id_kartu" <?php echo $penjualan_copy_view->id_kartu->cellAttributes() ?>>
<span id="el_penjualan_copy_id_kartu">
<span<?php echo $penjualan_copy_view->id_kartu->viewAttributes() ?>><?php echo $penjualan_copy_view->id_kartu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->jumlah_voucher->Visible) { // jumlah_voucher ?>
	<tr id="r_jumlah_voucher">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_jumlah_voucher"><?php echo $penjualan_copy_view->jumlah_voucher->caption() ?></span></td>
		<td data-name="jumlah_voucher" <?php echo $penjualan_copy_view->jumlah_voucher->cellAttributes() ?>>
<span id="el_penjualan_copy_jumlah_voucher">
<span<?php echo $penjualan_copy_view->jumlah_voucher->viewAttributes() ?>><?php echo $penjualan_copy_view->jumlah_voucher->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_kartubank->Visible) { // id_kartubank ?>
	<tr id="r_id_kartubank">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_kartubank"><?php echo $penjualan_copy_view->id_kartubank->caption() ?></span></td>
		<td data-name="id_kartubank" <?php echo $penjualan_copy_view->id_kartubank->cellAttributes() ?>>
<span id="el_penjualan_copy_id_kartubank">
<span<?php echo $penjualan_copy_view->id_kartubank->viewAttributes() ?>><?php echo $penjualan_copy_view->id_kartubank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->id_kas->Visible) { // id_kas ?>
	<tr id="r_id_kas">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_id_kas"><?php echo $penjualan_copy_view->id_kas->caption() ?></span></td>
		<td data-name="id_kas" <?php echo $penjualan_copy_view->id_kas->cellAttributes() ?>>
<span id="el_penjualan_copy_id_kas">
<span<?php echo $penjualan_copy_view->id_kas->viewAttributes() ?>><?php echo $penjualan_copy_view->id_kas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->charge->Visible) { // charge ?>
	<tr id="r_charge">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_charge"><?php echo $penjualan_copy_view->charge->caption() ?></span></td>
		<td data-name="charge" <?php echo $penjualan_copy_view->charge->cellAttributes() ?>>
<span id="el_penjualan_copy_charge">
<span<?php echo $penjualan_copy_view->charge->viewAttributes() ?>><?php echo $penjualan_copy_view->charge->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->ongkir->Visible) { // ongkir ?>
	<tr id="r_ongkir">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_ongkir"><?php echo $penjualan_copy_view->ongkir->caption() ?></span></td>
		<td data-name="ongkir" <?php echo $penjualan_copy_view->ongkir->cellAttributes() ?>>
<span id="el_penjualan_copy_ongkir">
<span<?php echo $penjualan_copy_view->ongkir->viewAttributes() ?>><?php echo $penjualan_copy_view->ongkir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->klaim_poin->Visible) { // klaim_poin ?>
	<tr id="r_klaim_poin">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_klaim_poin"><?php echo $penjualan_copy_view->klaim_poin->caption() ?></span></td>
		<td data-name="klaim_poin" <?php echo $penjualan_copy_view->klaim_poin->cellAttributes() ?>>
<span id="el_penjualan_copy_klaim_poin">
<span<?php echo $penjualan_copy_view->klaim_poin->viewAttributes() ?>><?php echo $penjualan_copy_view->klaim_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<tr id="r_total_penukaran_poin">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_total_penukaran_poin"><?php echo $penjualan_copy_view->total_penukaran_poin->caption() ?></span></td>
		<td data-name="total_penukaran_poin" <?php echo $penjualan_copy_view->total_penukaran_poin->cellAttributes() ?>>
<span id="el_penjualan_copy_total_penukaran_poin">
<span<?php echo $penjualan_copy_view->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan_copy_view->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->_action->Visible) { // action ?>
	<tr id="r__action">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy__action"><?php echo $penjualan_copy_view->_action->caption() ?></span></td>
		<td data-name="_action" <?php echo $penjualan_copy_view->_action->cellAttributes() ?>>
<span id="el_penjualan_copy__action">
<span<?php echo $penjualan_copy_view->_action->viewAttributes() ?>><?php echo $penjualan_copy_view->_action->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_status"><?php echo $penjualan_copy_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $penjualan_copy_view->status->cellAttributes() ?>>
<span id="el_penjualan_copy_status">
<span<?php echo $penjualan_copy_view->status->viewAttributes() ?>><?php echo $penjualan_copy_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($penjualan_copy_view->status_void->Visible) { // status_void ?>
	<tr id="r_status_void">
		<td class="<?php echo $penjualan_copy_view->TableLeftColumnClass ?>"><span id="elh_penjualan_copy_status_void"><?php echo $penjualan_copy_view->status_void->caption() ?></span></td>
		<td data-name="status_void" <?php echo $penjualan_copy_view->status_void->cellAttributes() ?>>
<span id="el_penjualan_copy_status_void">
<span<?php echo $penjualan_copy_view->status_void->viewAttributes() ?>><?php echo $penjualan_copy_view->status_void->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$penjualan_copy_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penjualan_copy_view->isExport()) { ?>
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
$penjualan_copy_view->terminate();
?>