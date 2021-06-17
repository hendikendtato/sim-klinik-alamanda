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
$penjualan_delete = new penjualan_delete();

// Run the page
$penjualan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenjualandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpenjualandelete = currentForm = new ew.Form("fpenjualandelete", "delete");
	loadjs.done("fpenjualandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$(".card.ew-card.ew-grid").appendTo("#daftar-penjualan"),$("#btn-action").after('&nbsp;<button class="btn btn-info ew-btn" name="btn-action-cetak" id="btn-action-cetak" type="submit" style="height: 50px !important; width: 20% !important;">Void</button>');
});
</script>
<?php $penjualan_delete->showPageHeader(); ?>
<?php
$penjualan_delete->showMessage();
?>
<form name="fpenjualandelete" id="fpenjualandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($penjualan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($penjualan_delete->kode_penjualan->Visible) { // kode_penjualan ?>
		<th class="<?php echo $penjualan_delete->kode_penjualan->headerCellClass() ?>"><span id="elh_penjualan_kode_penjualan" class="penjualan_kode_penjualan"><?php echo $penjualan_delete->kode_penjualan->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<th class="<?php echo $penjualan_delete->id_pelanggan->headerCellClass() ?>"><span id="elh_penjualan_id_pelanggan" class="penjualan_id_pelanggan"><?php echo $penjualan_delete->id_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->waktu->Visible) { // waktu ?>
		<th class="<?php echo $penjualan_delete->waktu->headerCellClass() ?>"><span id="elh_penjualan_waktu" class="penjualan_waktu"><?php echo $penjualan_delete->waktu->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->total->Visible) { // total ?>
		<th class="<?php echo $penjualan_delete->total->headerCellClass() ?>"><span id="elh_penjualan_total" class="penjualan_total"><?php echo $penjualan_delete->total->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->bayar->Visible) { // bayar ?>
		<th class="<?php echo $penjualan_delete->bayar->headerCellClass() ?>"><span id="elh_penjualan_bayar" class="penjualan_bayar"><?php echo $penjualan_delete->bayar->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<th class="<?php echo $penjualan_delete->total_non_tunai_charge->headerCellClass() ?>"><span id="elh_penjualan_total_non_tunai_charge" class="penjualan_total_non_tunai_charge"><?php echo $penjualan_delete->total_non_tunai_charge->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<th class="<?php echo $penjualan_delete->metode_pembayaran->headerCellClass() ?>"><span id="elh_penjualan_metode_pembayaran" class="penjualan_metode_pembayaran"><?php echo $penjualan_delete->metode_pembayaran->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<th class="<?php echo $penjualan_delete->jumlah_voucher->headerCellClass() ?>"><span id="elh_penjualan_jumlah_voucher" class="penjualan_jumlah_voucher"><?php echo $penjualan_delete->jumlah_voucher->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->id_kartubank->Visible) { // id_kartubank ?>
		<th class="<?php echo $penjualan_delete->id_kartubank->headerCellClass() ?>"><span id="elh_penjualan_id_kartubank" class="penjualan_id_kartubank"><?php echo $penjualan_delete->id_kartubank->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->id_kas->Visible) { // id_kas ?>
		<th class="<?php echo $penjualan_delete->id_kas->headerCellClass() ?>"><span id="elh_penjualan_id_kas" class="penjualan_id_kas"><?php echo $penjualan_delete->id_kas->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->charge->Visible) { // charge ?>
		<th class="<?php echo $penjualan_delete->charge->headerCellClass() ?>"><span id="elh_penjualan_charge" class="penjualan_charge"><?php echo $penjualan_delete->charge->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->klaim_poin->Visible) { // klaim_poin ?>
		<th class="<?php echo $penjualan_delete->klaim_poin->headerCellClass() ?>"><span id="elh_penjualan_klaim_poin" class="penjualan_klaim_poin"><?php echo $penjualan_delete->klaim_poin->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<th class="<?php echo $penjualan_delete->total_penukaran_poin->headerCellClass() ?>"><span id="elh_penjualan_total_penukaran_poin" class="penjualan_total_penukaran_poin"><?php echo $penjualan_delete->total_penukaran_poin->caption() ?></span></th>
<?php } ?>
<?php if ($penjualan_delete->status->Visible) { // status ?>
		<th class="<?php echo $penjualan_delete->status->headerCellClass() ?>"><span id="elh_penjualan_status" class="penjualan_status"><?php echo $penjualan_delete->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$penjualan_delete->RecordCount = 0;
$i = 0;
while (!$penjualan_delete->Recordset->EOF) {
	$penjualan_delete->RecordCount++;
	$penjualan_delete->RowCount++;

	// Set row properties
	$penjualan->resetAttributes();
	$penjualan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$penjualan_delete->loadRowValues($penjualan_delete->Recordset);

	// Render row
	$penjualan_delete->renderRow();
?>
	<tr <?php echo $penjualan->rowAttributes() ?>>
<?php if ($penjualan_delete->kode_penjualan->Visible) { // kode_penjualan ?>
		<td <?php echo $penjualan_delete->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_kode_penjualan" class="penjualan_kode_penjualan">
<span<?php echo $penjualan_delete->kode_penjualan->viewAttributes() ?>><?php echo $penjualan_delete->kode_penjualan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<td <?php echo $penjualan_delete->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_id_pelanggan" class="penjualan_id_pelanggan">
<span<?php echo $penjualan_delete->id_pelanggan->viewAttributes() ?>><?php echo $penjualan_delete->id_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->waktu->Visible) { // waktu ?>
		<td <?php echo $penjualan_delete->waktu->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_waktu" class="penjualan_waktu">
<span<?php echo $penjualan_delete->waktu->viewAttributes() ?>><?php echo $penjualan_delete->waktu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->total->Visible) { // total ?>
		<td <?php echo $penjualan_delete->total->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_total" class="penjualan_total">
<span<?php echo $penjualan_delete->total->viewAttributes() ?>><?php echo $penjualan_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->bayar->Visible) { // bayar ?>
		<td <?php echo $penjualan_delete->bayar->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_bayar" class="penjualan_bayar">
<span<?php echo $penjualan_delete->bayar->viewAttributes() ?>><?php echo $penjualan_delete->bayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<td <?php echo $penjualan_delete->total_non_tunai_charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_total_non_tunai_charge" class="penjualan_total_non_tunai_charge">
<span<?php echo $penjualan_delete->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan_delete->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<td <?php echo $penjualan_delete->metode_pembayaran->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_metode_pembayaran" class="penjualan_metode_pembayaran">
<span<?php echo $penjualan_delete->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan_delete->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<td <?php echo $penjualan_delete->jumlah_voucher->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_jumlah_voucher" class="penjualan_jumlah_voucher">
<span<?php echo $penjualan_delete->jumlah_voucher->viewAttributes() ?>><?php echo $penjualan_delete->jumlah_voucher->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->id_kartubank->Visible) { // id_kartubank ?>
		<td <?php echo $penjualan_delete->id_kartubank->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_id_kartubank" class="penjualan_id_kartubank">
<span<?php echo $penjualan_delete->id_kartubank->viewAttributes() ?>><?php echo $penjualan_delete->id_kartubank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->id_kas->Visible) { // id_kas ?>
		<td <?php echo $penjualan_delete->id_kas->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_id_kas" class="penjualan_id_kas">
<span<?php echo $penjualan_delete->id_kas->viewAttributes() ?>><?php echo $penjualan_delete->id_kas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->charge->Visible) { // charge ?>
		<td <?php echo $penjualan_delete->charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_charge" class="penjualan_charge">
<span<?php echo $penjualan_delete->charge->viewAttributes() ?>><?php echo $penjualan_delete->charge->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->klaim_poin->Visible) { // klaim_poin ?>
		<td <?php echo $penjualan_delete->klaim_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_klaim_poin" class="penjualan_klaim_poin">
<span<?php echo $penjualan_delete->klaim_poin->viewAttributes() ?>><?php echo $penjualan_delete->klaim_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<td <?php echo $penjualan_delete->total_penukaran_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_total_penukaran_poin" class="penjualan_total_penukaran_poin">
<span<?php echo $penjualan_delete->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan_delete->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penjualan_delete->status->Visible) { // status ?>
		<td <?php echo $penjualan_delete->status->cellAttributes() ?>>
<span id="el<?php echo $penjualan_delete->RowCount ?>_penjualan_status" class="penjualan_status">
<span<?php echo $penjualan_delete->status->viewAttributes() ?>><?php echo $penjualan_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$penjualan_delete->Recordset->moveNext();
}
$penjualan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penjualan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$penjualan_delete->showPageFooter();
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
$penjualan_delete->terminate();
?>