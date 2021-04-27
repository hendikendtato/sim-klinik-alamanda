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
$detailmutasibank_delete = new detailmutasibank_delete();

// Run the page
$detailmutasibank_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmutasibank_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailmutasibankdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailmutasibankdelete = currentForm = new ew.Form("fdetailmutasibankdelete", "delete");
	loadjs.done("fdetailmutasibankdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailmutasibank_delete->showPageHeader(); ?>
<?php
$detailmutasibank_delete->showMessage();
?>
<form name="fdetailmutasibankdelete" id="fdetailmutasibankdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmutasibank">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailmutasibank_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailmutasibank_delete->akun_id->Visible) { // akun_id ?>
		<th class="<?php echo $detailmutasibank_delete->akun_id->headerCellClass() ?>"><span id="elh_detailmutasibank_akun_id" class="detailmutasibank_akun_id"><?php echo $detailmutasibank_delete->akun_id->caption() ?></span></th>
<?php } ?>
<?php if ($detailmutasibank_delete->nama_akun->Visible) { // nama_akun ?>
		<th class="<?php echo $detailmutasibank_delete->nama_akun->headerCellClass() ?>"><span id="elh_detailmutasibank_nama_akun" class="detailmutasibank_nama_akun"><?php echo $detailmutasibank_delete->nama_akun->caption() ?></span></th>
<?php } ?>
<?php if ($detailmutasibank_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $detailmutasibank_delete->jumlah->headerCellClass() ?>"><span id="elh_detailmutasibank_jumlah" class="detailmutasibank_jumlah"><?php echo $detailmutasibank_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($detailmutasibank_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $detailmutasibank_delete->keterangan->headerCellClass() ?>"><span id="elh_detailmutasibank_keterangan" class="detailmutasibank_keterangan"><?php echo $detailmutasibank_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($detailmutasibank_delete->tipe_mutasi->Visible) { // tipe_mutasi ?>
		<th class="<?php echo $detailmutasibank_delete->tipe_mutasi->headerCellClass() ?>"><span id="elh_detailmutasibank_tipe_mutasi" class="detailmutasibank_tipe_mutasi"><?php echo $detailmutasibank_delete->tipe_mutasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailmutasibank_delete->RecordCount = 0;
$i = 0;
while (!$detailmutasibank_delete->Recordset->EOF) {
	$detailmutasibank_delete->RecordCount++;
	$detailmutasibank_delete->RowCount++;

	// Set row properties
	$detailmutasibank->resetAttributes();
	$detailmutasibank->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailmutasibank_delete->loadRowValues($detailmutasibank_delete->Recordset);

	// Render row
	$detailmutasibank_delete->renderRow();
?>
	<tr <?php echo $detailmutasibank->rowAttributes() ?>>
<?php if ($detailmutasibank_delete->akun_id->Visible) { // akun_id ?>
		<td <?php echo $detailmutasibank_delete->akun_id->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_delete->RowCount ?>_detailmutasibank_akun_id" class="detailmutasibank_akun_id">
<span<?php echo $detailmutasibank_delete->akun_id->viewAttributes() ?>><?php echo $detailmutasibank_delete->akun_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmutasibank_delete->nama_akun->Visible) { // nama_akun ?>
		<td <?php echo $detailmutasibank_delete->nama_akun->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_delete->RowCount ?>_detailmutasibank_nama_akun" class="detailmutasibank_nama_akun">
<span<?php echo $detailmutasibank_delete->nama_akun->viewAttributes() ?>><?php echo $detailmutasibank_delete->nama_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmutasibank_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $detailmutasibank_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_delete->RowCount ?>_detailmutasibank_jumlah" class="detailmutasibank_jumlah">
<span<?php echo $detailmutasibank_delete->jumlah->viewAttributes() ?>><?php echo $detailmutasibank_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmutasibank_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $detailmutasibank_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_delete->RowCount ?>_detailmutasibank_keterangan" class="detailmutasibank_keterangan">
<span<?php echo $detailmutasibank_delete->keterangan->viewAttributes() ?>><?php echo $detailmutasibank_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailmutasibank_delete->tipe_mutasi->Visible) { // tipe_mutasi ?>
		<td <?php echo $detailmutasibank_delete->tipe_mutasi->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_delete->RowCount ?>_detailmutasibank_tipe_mutasi" class="detailmutasibank_tipe_mutasi">
<span<?php echo $detailmutasibank_delete->tipe_mutasi->viewAttributes() ?>><?php echo $detailmutasibank_delete->tipe_mutasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailmutasibank_delete->Recordset->moveNext();
}
$detailmutasibank_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailmutasibank_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailmutasibank_delete->showPageFooter();
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
$detailmutasibank_delete->terminate();
?>