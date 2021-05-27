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
$penjualan_copy_delete = new penjualan_copy_delete();

// Run the page
$penjualan_copy_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_copy_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenjualan_copydelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpenjualan_copydelete = currentForm = new ew.Form("fpenjualan_copydelete", "delete");
	loadjs.done("fpenjualan_copydelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penjualan_copy_delete->showPageHeader(); ?>
<?php
$penjualan_copy_delete->showMessage();
?>
<form name="fpenjualan_copydelete" id="fpenjualan_copydelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan_copy">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($penjualan_copy_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($penjualan_copy_delete->id->Visible) { // id ?>
		<th class="<?php echo $penjualan_copy_delete->id->headerCellClass() ?>"><span id="elh_penjualan_copy_id" class="penjualan_copy_id"><?php echo $penjualan_copy_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->waktu->Visible) { // waktu ?>
		<th class="<?php echo $penjualan_copy_delete->waktu->headerCellClass() ?>"><span id="elh_penjualan_copy_waktu" class="penjualan_copy_waktu"><?php echo $penjualan_copy_delete->waktu->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<th class="<?php echo $penjualan_copy_delete->id_pelanggan->headerCellClass() ?>"><span id="elh_penjualan_copy_id_pelanggan" class="penjualan_copy_id_pelanggan"><?php echo $penjualan_copy_delete->id_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_member->Visible) { // id_member ?>
		<th class="<?php echo $penjualan_copy_delete->id_member->headerCellClass() ?>"><span id="elh_penjualan_copy_id_member" class="penjualan_copy_id_member"><?php echo $penjualan_copy_delete->id_member->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->diskon_persen->Visible) { // diskon_persen ?>
		<th class="<?php echo $penjualan_copy_delete->diskon_persen->headerCellClass() ?>"><span id="elh_penjualan_copy_diskon_persen" class="penjualan_copy_diskon_persen"><?php echo $penjualan_copy_delete->diskon_persen->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->diskon_rupiah->Visible) { // diskon_rupiah ?>
		<th class="<?php echo $penjualan_copy_delete->diskon_rupiah->headerCellClass() ?>"><span id="elh_penjualan_copy_diskon_rupiah" class="penjualan_copy_diskon_rupiah"><?php echo $penjualan_copy_delete->diskon_rupiah->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->ppn->Visible) { // ppn ?>
		<th class="<?php echo $penjualan_copy_delete->ppn->headerCellClass() ?>"><span id="elh_penjualan_copy_ppn" class="penjualan_copy_ppn"><?php echo $penjualan_copy_delete->ppn->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->total->Visible) { // total ?>
		<th class="<?php echo $penjualan_copy_delete->total->headerCellClass() ?>"><span id="elh_penjualan_copy_total" class="penjualan_copy_total"><?php echo $penjualan_copy_delete->total->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->bayar->Visible) { // bayar ?>
		<th class="<?php echo $penjualan_copy_delete->bayar->headerCellClass() ?>"><span id="elh_penjualan_copy_bayar" class="penjualan_copy_bayar"><?php echo $penjualan_copy_delete->bayar->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
		<th class="<?php echo $penjualan_copy_delete->bayar_non_tunai->headerCellClass() ?>"><span id="elh_penjualan_copy_bayar_non_tunai" class="penjualan_copy_bayar_non_tunai"><?php echo $penjualan_copy_delete->bayar_non_tunai->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<th class="<?php echo $penjualan_copy_delete->total_non_tunai_charge->headerCellClass() ?>"><span id="elh_penjualan_copy_total_non_tunai_charge" class="penjualan_copy_total_non_tunai_charge"><?php echo $penjualan_copy_delete->total_non_tunai_charge->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->kode_penjualan->Visible) { // kode_penjualan ?>
		<th class="<?php echo $penjualan_copy_delete->kode_penjualan->headerCellClass() ?>"><span id="elh_penjualan_copy_kode_penjualan" class="penjualan_copy_kode_penjualan"><?php echo $penjualan_copy_delete->kode_penjualan->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $penjualan_copy_delete->keterangan->headerCellClass() ?>"><span id="elh_penjualan_copy_keterangan" class="penjualan_copy_keterangan"><?php echo $penjualan_copy_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->dokter->Visible) { // dokter ?>
		<th class="<?php echo $penjualan_copy_delete->dokter->headerCellClass() ?>"><span id="elh_penjualan_copy_dokter" class="penjualan_copy_dokter"><?php echo $penjualan_copy_delete->dokter->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->sales->Visible) { // sales ?>
		<th class="<?php echo $penjualan_copy_delete->sales->headerCellClass() ?>"><span id="elh_penjualan_copy_sales" class="penjualan_copy_sales"><?php echo $penjualan_copy_delete->sales->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->dok_be_wajah->Visible) { // dok_be_wajah ?>
		<th class="<?php echo $penjualan_copy_delete->dok_be_wajah->headerCellClass() ?>"><span id="elh_penjualan_copy_dok_be_wajah" class="penjualan_copy_dok_be_wajah"><?php echo $penjualan_copy_delete->dok_be_wajah->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->be_body->Visible) { // be_body ?>
		<th class="<?php echo $penjualan_copy_delete->be_body->headerCellClass() ?>"><span id="elh_penjualan_copy_be_body" class="penjualan_copy_be_body"><?php echo $penjualan_copy_delete->be_body->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->medis->Visible) { // medis ?>
		<th class="<?php echo $penjualan_copy_delete->medis->headerCellClass() ?>"><span id="elh_penjualan_copy_medis" class="penjualan_copy_medis"><?php echo $penjualan_copy_delete->medis->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $penjualan_copy_delete->id_klinik->headerCellClass() ?>"><span id="elh_penjualan_copy_id_klinik" class="penjualan_copy_id_klinik"><?php echo $penjualan_copy_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_rmd->Visible) { // id_rmd ?>
		<th class="<?php echo $penjualan_copy_delete->id_rmd->headerCellClass() ?>"><span id="elh_penjualan_copy_id_rmd" class="penjualan_copy_id_rmd"><?php echo $penjualan_copy_delete->id_rmd->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<th class="<?php echo $penjualan_copy_delete->metode_pembayaran->headerCellClass() ?>"><span id="elh_penjualan_copy_metode_pembayaran" class="penjualan_copy_metode_pembayaran"><?php echo $penjualan_copy_delete->metode_pembayaran->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_bank->Visible) { // id_bank ?>
		<th class="<?php echo $penjualan_copy_delete->id_bank->headerCellClass() ?>"><span id="elh_penjualan_copy_id_bank" class="penjualan_copy_id_bank"><?php echo $penjualan_copy_delete->id_bank->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_kartu->Visible) { // id_kartu ?>
		<th class="<?php echo $penjualan_copy_delete->id_kartu->headerCellClass() ?>"><span id="elh_penjualan_copy_id_kartu" class="penjualan_copy_id_kartu"><?php echo $penjualan_copy_delete->id_kartu->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<th class="<?php echo $penjualan_copy_delete->jumlah_voucher->headerCellClass() ?>"><span id="elh_penjualan_copy_jumlah_voucher" class="penjualan_copy_jumlah_voucher"><?php echo $penjualan_copy_delete->jumlah_voucher->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_kartubank->Visible) { // id_kartubank ?>
		<th class="<?php echo $penjualan_copy_delete->id_kartubank->headerCellClass() ?>"><span id="elh_penjualan_copy_id_kartubank" class="penjualan_copy_id_kartubank"><?php echo $penjualan_copy_delete->id_kartubank->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->id_kas->Visible) { // id_kas ?>
		<th class="<?php echo $penjualan_copy_delete->id_kas->headerCellClass() ?>"><span id="elh_penjualan_copy_id_kas" class="penjualan_copy_id_kas"><?php echo $penjualan_copy_delete->id_kas->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->charge->Visible) { // charge ?>
		<th class="<?php echo $penjualan_copy_delete->charge->headerCellClass() ?>"><span id="elh_penjualan_copy_charge" class="penjualan_copy_charge"><?php echo $penjualan_copy_delete->charge->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->ongkir->Visible) { // ongkir ?>
		<th class="<?php echo $penjualan_copy_delete->ongkir->headerCellClass() ?>"><span id="elh_penjualan_copy_ongkir" class="penjualan_copy_ongkir"><?php echo $penjualan_copy_delete->ongkir->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->klaim_poin->Visible) { // klaim_poin ?>
		<th class="<?php echo $penjualan_copy_delete->klaim_poin->headerCellClass() ?>"><span id="elh_penjualan_copy_klaim_poin" class="penjualan_copy_klaim_poin"><?php echo $penjualan_copy_delete->klaim_poin->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<th class="<?php echo $penjualan_copy_delete->total_penukaran_poin->headerCellClass() ?>"><span id="elh_penjualan_copy_total_penukaran_poin" class="penjualan_copy_total_penukaran_poin"><?php echo $penjualan_copy_delete->total_penukaran_poin->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->_action->Visible) { // action ?>
		<th class="<?php echo $penjualan_copy_delete->_action->headerCellClass() ?>"><span id="elh_penjualan_copy__action" class="penjualan_copy__action"><?php echo $penjualan_copy_delete->_action->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->status->Visible) { // status ?>
		<th class="<?php echo $penjualan_copy_delete->status->headerCellClass() ?>"><span id="elh_penjualan_copy_status" class="penjualan_copy_status"><?php echo $penjualan_copy_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_copy_delete->status_void->Visible) { // status_void ?>
		<th class="<?php echo $penjualan_copy_delete->status_void->headerCellClass() ?>"><span id="elh_penjualan_copy_status_void" class="penjualan_copy_status_void"><?php echo $penjualan_copy_delete->status_void->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$penjualan_copy_delete->RecordCount = 0;
$i = 0;
while (!$penjualan_copy_delete->Recordset->EOF) {
	$penjualan_copy_delete->RecordCount++;
	$penjualan_copy_delete->RowCount++;

	// Set row properties
	$penjualan_copy->resetAttributes();
	$penjualan_copy->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$penjualan_copy_delete->loadRowValues($penjualan_copy_delete->Recordset);

	// Render row
	$penjualan_copy_delete->renderRow();
?>
	<tr <?php echo $penjualan_copy->rowAttributes() ?>>
<?php if ($penjualan_copy_delete->id->Visible) { // id ?>
		<td <?php echo $penjualan_copy_delete->id->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id" class="penjualan_copy_id">
<span<?php echo $penjualan_copy_delete->id->viewAttributes() ?>><?php echo $penjualan_copy_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->waktu->Visible) { // waktu ?>
		<td <?php echo $penjualan_copy_delete->waktu->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_waktu" class="penjualan_copy_waktu">
<span<?php echo $penjualan_copy_delete->waktu->viewAttributes() ?>><?php echo $penjualan_copy_delete->waktu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<td <?php echo $penjualan_copy_delete->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_pelanggan" class="penjualan_copy_id_pelanggan">
<span<?php echo $penjualan_copy_delete->id_pelanggan->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_member->Visible) { // id_member ?>
		<td <?php echo $penjualan_copy_delete->id_member->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_member" class="penjualan_copy_id_member">
<span<?php echo $penjualan_copy_delete->id_member->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->diskon_persen->Visible) { // diskon_persen ?>
		<td <?php echo $penjualan_copy_delete->diskon_persen->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_diskon_persen" class="penjualan_copy_diskon_persen">
<span<?php echo $penjualan_copy_delete->diskon_persen->viewAttributes() ?>><?php echo $penjualan_copy_delete->diskon_persen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->diskon_rupiah->Visible) { // diskon_rupiah ?>
		<td <?php echo $penjualan_copy_delete->diskon_rupiah->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_diskon_rupiah" class="penjualan_copy_diskon_rupiah">
<span<?php echo $penjualan_copy_delete->diskon_rupiah->viewAttributes() ?>><?php echo $penjualan_copy_delete->diskon_rupiah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->ppn->Visible) { // ppn ?>
		<td <?php echo $penjualan_copy_delete->ppn->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_ppn" class="penjualan_copy_ppn">
<span<?php echo $penjualan_copy_delete->ppn->viewAttributes() ?>><?php echo $penjualan_copy_delete->ppn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->total->Visible) { // total ?>
		<td <?php echo $penjualan_copy_delete->total->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_total" class="penjualan_copy_total">
<span<?php echo $penjualan_copy_delete->total->viewAttributes() ?>><?php echo $penjualan_copy_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->bayar->Visible) { // bayar ?>
		<td <?php echo $penjualan_copy_delete->bayar->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_bayar" class="penjualan_copy_bayar">
<span<?php echo $penjualan_copy_delete->bayar->viewAttributes() ?>><?php echo $penjualan_copy_delete->bayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
		<td <?php echo $penjualan_copy_delete->bayar_non_tunai->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_bayar_non_tunai" class="penjualan_copy_bayar_non_tunai">
<span<?php echo $penjualan_copy_delete->bayar_non_tunai->viewAttributes() ?>><?php echo $penjualan_copy_delete->bayar_non_tunai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<td <?php echo $penjualan_copy_delete->total_non_tunai_charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_total_non_tunai_charge" class="penjualan_copy_total_non_tunai_charge">
<span<?php echo $penjualan_copy_delete->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan_copy_delete->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->kode_penjualan->Visible) { // kode_penjualan ?>
		<td <?php echo $penjualan_copy_delete->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_kode_penjualan" class="penjualan_copy_kode_penjualan">
<span<?php echo $penjualan_copy_delete->kode_penjualan->viewAttributes() ?>><?php echo $penjualan_copy_delete->kode_penjualan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $penjualan_copy_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_keterangan" class="penjualan_copy_keterangan">
<span<?php echo $penjualan_copy_delete->keterangan->viewAttributes() ?>><?php echo $penjualan_copy_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->dokter->Visible) { // dokter ?>
		<td <?php echo $penjualan_copy_delete->dokter->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_dokter" class="penjualan_copy_dokter">
<span<?php echo $penjualan_copy_delete->dokter->viewAttributes() ?>><?php echo $penjualan_copy_delete->dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->sales->Visible) { // sales ?>
		<td <?php echo $penjualan_copy_delete->sales->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_sales" class="penjualan_copy_sales">
<span<?php echo $penjualan_copy_delete->sales->viewAttributes() ?>><?php echo $penjualan_copy_delete->sales->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->dok_be_wajah->Visible) { // dok_be_wajah ?>
		<td <?php echo $penjualan_copy_delete->dok_be_wajah->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_dok_be_wajah" class="penjualan_copy_dok_be_wajah">
<span<?php echo $penjualan_copy_delete->dok_be_wajah->viewAttributes() ?>><?php echo $penjualan_copy_delete->dok_be_wajah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->be_body->Visible) { // be_body ?>
		<td <?php echo $penjualan_copy_delete->be_body->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_be_body" class="penjualan_copy_be_body">
<span<?php echo $penjualan_copy_delete->be_body->viewAttributes() ?>><?php echo $penjualan_copy_delete->be_body->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->medis->Visible) { // medis ?>
		<td <?php echo $penjualan_copy_delete->medis->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_medis" class="penjualan_copy_medis">
<span<?php echo $penjualan_copy_delete->medis->viewAttributes() ?>><?php echo $penjualan_copy_delete->medis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $penjualan_copy_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_klinik" class="penjualan_copy_id_klinik">
<span<?php echo $penjualan_copy_delete->id_klinik->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_rmd->Visible) { // id_rmd ?>
		<td <?php echo $penjualan_copy_delete->id_rmd->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_rmd" class="penjualan_copy_id_rmd">
<span<?php echo $penjualan_copy_delete->id_rmd->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_rmd->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<td <?php echo $penjualan_copy_delete->metode_pembayaran->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_metode_pembayaran" class="penjualan_copy_metode_pembayaran">
<span<?php echo $penjualan_copy_delete->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan_copy_delete->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_bank->Visible) { // id_bank ?>
		<td <?php echo $penjualan_copy_delete->id_bank->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_bank" class="penjualan_copy_id_bank">
<span<?php echo $penjualan_copy_delete->id_bank->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_bank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_kartu->Visible) { // id_kartu ?>
		<td <?php echo $penjualan_copy_delete->id_kartu->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_kartu" class="penjualan_copy_id_kartu">
<span<?php echo $penjualan_copy_delete->id_kartu->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_kartu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<td <?php echo $penjualan_copy_delete->jumlah_voucher->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_jumlah_voucher" class="penjualan_copy_jumlah_voucher">
<span<?php echo $penjualan_copy_delete->jumlah_voucher->viewAttributes() ?>><?php echo $penjualan_copy_delete->jumlah_voucher->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_kartubank->Visible) { // id_kartubank ?>
		<td <?php echo $penjualan_copy_delete->id_kartubank->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_kartubank" class="penjualan_copy_id_kartubank">
<span<?php echo $penjualan_copy_delete->id_kartubank->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_kartubank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->id_kas->Visible) { // id_kas ?>
		<td <?php echo $penjualan_copy_delete->id_kas->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_id_kas" class="penjualan_copy_id_kas">
<span<?php echo $penjualan_copy_delete->id_kas->viewAttributes() ?>><?php echo $penjualan_copy_delete->id_kas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->charge->Visible) { // charge ?>
		<td <?php echo $penjualan_copy_delete->charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_charge" class="penjualan_copy_charge">
<span<?php echo $penjualan_copy_delete->charge->viewAttributes() ?>><?php echo $penjualan_copy_delete->charge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->ongkir->Visible) { // ongkir ?>
		<td <?php echo $penjualan_copy_delete->ongkir->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_ongkir" class="penjualan_copy_ongkir">
<span<?php echo $penjualan_copy_delete->ongkir->viewAttributes() ?>><?php echo $penjualan_copy_delete->ongkir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->klaim_poin->Visible) { // klaim_poin ?>
		<td <?php echo $penjualan_copy_delete->klaim_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_klaim_poin" class="penjualan_copy_klaim_poin">
<span<?php echo $penjualan_copy_delete->klaim_poin->viewAttributes() ?>><?php echo $penjualan_copy_delete->klaim_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<td <?php echo $penjualan_copy_delete->total_penukaran_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_total_penukaran_poin" class="penjualan_copy_total_penukaran_poin">
<span<?php echo $penjualan_copy_delete->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan_copy_delete->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->_action->Visible) { // action ?>
		<td <?php echo $penjualan_copy_delete->_action->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy__action" class="penjualan_copy__action">
<span<?php echo $penjualan_copy_delete->_action->viewAttributes() ?>><?php echo $penjualan_copy_delete->_action->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->status->Visible) { // status ?>
		<td <?php echo $penjualan_copy_delete->status->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_status" class="penjualan_copy_status">
<span<?php echo $penjualan_copy_delete->status->viewAttributes() ?>><?php echo $penjualan_copy_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_copy_delete->status_void->Visible) { // status_void ?>
		<td <?php echo $penjualan_copy_delete->status_void->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_delete->RowCount ?>_penjualan_copy_status_void" class="penjualan_copy_status_void">
<span<?php echo $penjualan_copy_delete->status_void->viewAttributes() ?>><?php echo $penjualan_copy_delete->status_void->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$penjualan_copy_delete->Recordset->moveNext();
}
$penjualan_copy_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penjualan_copy_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$penjualan_copy_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$penjualan_copy_delete->terminate();
?>