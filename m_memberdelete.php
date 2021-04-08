<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$m_member_delete = new m_member_delete();

// Run the page
$m_member_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_member_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_memberdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_memberdelete = currentForm = new ew.Form("fm_memberdelete", "delete");
	loadjs.done("fm_memberdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_member_delete->showPageHeader(); ?>
<?php
$m_member_delete->showMessage();
?>
<form name="fm_memberdelete" id="fm_memberdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_member">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_member_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_member_delete->kode_member->Visible) { // kode_member ?>
		<th class="<?php echo $m_member_delete->kode_member->headerCellClass() ?>"><span id="elh_m_member_kode_member" class="m_member_kode_member"><?php echo $m_member_delete->kode_member->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_member_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_member_id_klinik" class="m_member_id_klinik"><?php echo $m_member_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<th class="<?php echo $m_member_delete->id_pelanggan->headerCellClass() ?>"><span id="elh_m_member_id_pelanggan" class="m_member_id_pelanggan"><?php echo $m_member_delete->id_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->jenis_member->Visible) { // jenis_member ?>
		<th class="<?php echo $m_member_delete->jenis_member->headerCellClass() ?>"><span id="elh_m_member_jenis_member" class="m_member_jenis_member"><?php echo $m_member_delete->jenis_member->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->tgl_mulai->Visible) { // tgl_mulai ?>
		<th class="<?php echo $m_member_delete->tgl_mulai->headerCellClass() ?>"><span id="elh_m_member_tgl_mulai" class="m_member_tgl_mulai"><?php echo $m_member_delete->tgl_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<th class="<?php echo $m_member_delete->tgl_akhir->headerCellClass() ?>"><span id="elh_m_member_tgl_akhir" class="m_member_tgl_akhir"><?php echo $m_member_delete->tgl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->poin_member->Visible) { // poin_member ?>
		<th class="<?php echo $m_member_delete->poin_member->headerCellClass() ?>"><span id="elh_m_member_poin_member" class="m_member_poin_member"><?php echo $m_member_delete->poin_member->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
		<th class="<?php echo $m_member_delete->tgl_awal_transaksi->headerCellClass() ?>"><span id="elh_m_member_tgl_awal_transaksi" class="m_member_tgl_awal_transaksi"><?php echo $m_member_delete->tgl_awal_transaksi->caption() ?></span></th>
<?php } ?>
<?php if ($m_member_delete->total_akumulasi->Visible) { // total_akumulasi ?>
		<th class="<?php echo $m_member_delete->total_akumulasi->headerCellClass() ?>"><span id="elh_m_member_total_akumulasi" class="m_member_total_akumulasi"><?php echo $m_member_delete->total_akumulasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_member_delete->RecordCount = 0;
$i = 0;
while (!$m_member_delete->Recordset->EOF) {
	$m_member_delete->RecordCount++;
	$m_member_delete->RowCount++;

	// Set row properties
	$m_member->resetAttributes();
	$m_member->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_member_delete->loadRowValues($m_member_delete->Recordset);

	// Render row
	$m_member_delete->renderRow();
?>
	<tr <?php echo $m_member->rowAttributes() ?>>
<?php if ($m_member_delete->kode_member->Visible) { // kode_member ?>
		<td <?php echo $m_member_delete->kode_member->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_kode_member" class="m_member_kode_member">
<span<?php echo $m_member_delete->kode_member->viewAttributes() ?>><?php echo $m_member_delete->kode_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_member_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_id_klinik" class="m_member_id_klinik">
<span<?php echo $m_member_delete->id_klinik->viewAttributes() ?>><?php echo $m_member_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<td <?php echo $m_member_delete->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_id_pelanggan" class="m_member_id_pelanggan">
<span<?php echo $m_member_delete->id_pelanggan->viewAttributes() ?>><?php echo $m_member_delete->id_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->jenis_member->Visible) { // jenis_member ?>
		<td <?php echo $m_member_delete->jenis_member->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_jenis_member" class="m_member_jenis_member">
<span<?php echo $m_member_delete->jenis_member->viewAttributes() ?>><?php echo $m_member_delete->jenis_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->tgl_mulai->Visible) { // tgl_mulai ?>
		<td <?php echo $m_member_delete->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_tgl_mulai" class="m_member_tgl_mulai">
<span<?php echo $m_member_delete->tgl_mulai->viewAttributes() ?>><?php echo $m_member_delete->tgl_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<td <?php echo $m_member_delete->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_tgl_akhir" class="m_member_tgl_akhir">
<span<?php echo $m_member_delete->tgl_akhir->viewAttributes() ?>><?php echo $m_member_delete->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->poin_member->Visible) { // poin_member ?>
		<td <?php echo $m_member_delete->poin_member->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_poin_member" class="m_member_poin_member">
<span<?php echo $m_member_delete->poin_member->viewAttributes() ?>><?php echo $m_member_delete->poin_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
		<td <?php echo $m_member_delete->tgl_awal_transaksi->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_tgl_awal_transaksi" class="m_member_tgl_awal_transaksi">
<span<?php echo $m_member_delete->tgl_awal_transaksi->viewAttributes() ?>><?php echo $m_member_delete->tgl_awal_transaksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_member_delete->total_akumulasi->Visible) { // total_akumulasi ?>
		<td <?php echo $m_member_delete->total_akumulasi->cellAttributes() ?>>
<span id="el<?php echo $m_member_delete->RowCount ?>_m_member_total_akumulasi" class="m_member_total_akumulasi">
<span<?php echo $m_member_delete->total_akumulasi->viewAttributes() ?>><?php echo $m_member_delete->total_akumulasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_member_delete->Recordset->moveNext();
}
$m_member_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_member_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_member_delete->showPageFooter();
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
$m_member_delete->terminate();
?>