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
$laporan_kas_delete = new laporan_kas_delete();

// Run the page
$laporan_kas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_kas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flaporan_kasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flaporan_kasdelete = currentForm = new ew.Form("flaporan_kasdelete", "delete");
	loadjs.done("flaporan_kasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $laporan_kas_delete->showPageHeader(); ?>
<?php
$laporan_kas_delete->showMessage();
?>
<form name="flaporan_kasdelete" id="flaporan_kasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_kas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($laporan_kas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($laporan_kas_delete->id->Visible) { // id ?>
		<th class="<?php echo $laporan_kas_delete->id->headerCellClass() ?>"><span id="elh_laporan_kas_id" class="laporan_kas_id"><?php echo $laporan_kas_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $laporan_kas_delete->id_klinik->headerCellClass() ?>"><span id="elh_laporan_kas_id_klinik" class="laporan_kas_id_klinik"><?php echo $laporan_kas_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->id_kas->Visible) { // id_kas ?>
		<th class="<?php echo $laporan_kas_delete->id_kas->headerCellClass() ?>"><span id="elh_laporan_kas_id_kas" class="laporan_kas_id_kas"><?php echo $laporan_kas_delete->id_kas->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $laporan_kas_delete->jumlah->headerCellClass() ?>"><span id="elh_laporan_kas_jumlah" class="laporan_kas_jumlah"><?php echo $laporan_kas_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $laporan_kas_delete->tanggal->headerCellClass() ?>"><span id="elh_laporan_kas_tanggal" class="laporan_kas_tanggal"><?php echo $laporan_kas_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
		<th class="<?php echo $laporan_kas_delete->id_mutasi_kas->headerCellClass() ?>"><span id="elh_laporan_kas_id_mutasi_kas" class="laporan_kas_id_mutasi_kas"><?php echo $laporan_kas_delete->id_mutasi_kas->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->saldo_awal->Visible) { // saldo_awal ?>
		<th class="<?php echo $laporan_kas_delete->saldo_awal->headerCellClass() ?>"><span id="elh_laporan_kas_saldo_awal" class="laporan_kas_saldo_awal"><?php echo $laporan_kas_delete->saldo_awal->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_kas_delete->sisa_saldo->Visible) { // sisa_saldo ?>
		<th class="<?php echo $laporan_kas_delete->sisa_saldo->headerCellClass() ?>"><span id="elh_laporan_kas_sisa_saldo" class="laporan_kas_sisa_saldo"><?php echo $laporan_kas_delete->sisa_saldo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$laporan_kas_delete->RecordCount = 0;
$i = 0;
while (!$laporan_kas_delete->Recordset->EOF) {
	$laporan_kas_delete->RecordCount++;
	$laporan_kas_delete->RowCount++;

	// Set row properties
	$laporan_kas->resetAttributes();
	$laporan_kas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$laporan_kas_delete->loadRowValues($laporan_kas_delete->Recordset);

	// Render row
	$laporan_kas_delete->renderRow();
?>
	<tr <?php echo $laporan_kas->rowAttributes() ?>>
<?php if ($laporan_kas_delete->id->Visible) { // id ?>
		<td <?php echo $laporan_kas_delete->id->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_id" class="laporan_kas_id">
<span<?php echo $laporan_kas_delete->id->viewAttributes() ?>><?php echo $laporan_kas_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $laporan_kas_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_id_klinik" class="laporan_kas_id_klinik">
<span<?php echo $laporan_kas_delete->id_klinik->viewAttributes() ?>><?php echo $laporan_kas_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->id_kas->Visible) { // id_kas ?>
		<td <?php echo $laporan_kas_delete->id_kas->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_id_kas" class="laporan_kas_id_kas">
<span<?php echo $laporan_kas_delete->id_kas->viewAttributes() ?>><?php echo $laporan_kas_delete->id_kas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $laporan_kas_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_jumlah" class="laporan_kas_jumlah">
<span<?php echo $laporan_kas_delete->jumlah->viewAttributes() ?>><?php echo $laporan_kas_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $laporan_kas_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_tanggal" class="laporan_kas_tanggal">
<span<?php echo $laporan_kas_delete->tanggal->viewAttributes() ?>><?php echo $laporan_kas_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
		<td <?php echo $laporan_kas_delete->id_mutasi_kas->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_id_mutasi_kas" class="laporan_kas_id_mutasi_kas">
<span<?php echo $laporan_kas_delete->id_mutasi_kas->viewAttributes() ?>><?php echo $laporan_kas_delete->id_mutasi_kas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->saldo_awal->Visible) { // saldo_awal ?>
		<td <?php echo $laporan_kas_delete->saldo_awal->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_saldo_awal" class="laporan_kas_saldo_awal">
<span<?php echo $laporan_kas_delete->saldo_awal->viewAttributes() ?>><?php echo $laporan_kas_delete->saldo_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_kas_delete->sisa_saldo->Visible) { // sisa_saldo ?>
		<td <?php echo $laporan_kas_delete->sisa_saldo->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_delete->RowCount ?>_laporan_kas_sisa_saldo" class="laporan_kas_sisa_saldo">
<span<?php echo $laporan_kas_delete->sisa_saldo->viewAttributes() ?>><?php echo $laporan_kas_delete->sisa_saldo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$laporan_kas_delete->Recordset->moveNext();
}
$laporan_kas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $laporan_kas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$laporan_kas_delete->showPageFooter();
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
$laporan_kas_delete->terminate();
?>