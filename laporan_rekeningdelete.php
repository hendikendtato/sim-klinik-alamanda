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
$laporan_rekening_delete = new laporan_rekening_delete();

// Run the page
$laporan_rekening_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_rekening_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flaporan_rekeningdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flaporan_rekeningdelete = currentForm = new ew.Form("flaporan_rekeningdelete", "delete");
	loadjs.done("flaporan_rekeningdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $laporan_rekening_delete->showPageHeader(); ?>
<?php
$laporan_rekening_delete->showMessage();
?>
<form name="flaporan_rekeningdelete" id="flaporan_rekeningdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_rekening">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($laporan_rekening_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($laporan_rekening_delete->id->Visible) { // id ?>
		<th class="<?php echo $laporan_rekening_delete->id->headerCellClass() ?>"><span id="elh_laporan_rekening_id" class="laporan_rekening_id"><?php echo $laporan_rekening_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_rekening_delete->id_rekening->Visible) { // id_rekening ?>
		<th class="<?php echo $laporan_rekening_delete->id_rekening->headerCellClass() ?>"><span id="elh_laporan_rekening_id_rekening" class="laporan_rekening_id_rekening"><?php echo $laporan_rekening_delete->id_rekening->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_rekening_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $laporan_rekening_delete->id_klinik->headerCellClass() ?>"><span id="elh_laporan_rekening_id_klinik" class="laporan_rekening_id_klinik"><?php echo $laporan_rekening_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_rekening_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $laporan_rekening_delete->jumlah->headerCellClass() ?>"><span id="elh_laporan_rekening_jumlah" class="laporan_rekening_jumlah"><?php echo $laporan_rekening_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_rekening_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $laporan_rekening_delete->tanggal->headerCellClass() ?>"><span id="elh_laporan_rekening_tanggal" class="laporan_rekening_tanggal"><?php echo $laporan_rekening_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_rekening_delete->saldo_awal->Visible) { // saldo_awal ?>
		<th class="<?php echo $laporan_rekening_delete->saldo_awal->headerCellClass() ?>"><span id="elh_laporan_rekening_saldo_awal" class="laporan_rekening_saldo_awal"><?php echo $laporan_rekening_delete->saldo_awal->caption() ?></span></th>
<?php } ?>
<?php if ($laporan_rekening_delete->sisa_saldo->Visible) { // sisa_saldo ?>
		<th class="<?php echo $laporan_rekening_delete->sisa_saldo->headerCellClass() ?>"><span id="elh_laporan_rekening_sisa_saldo" class="laporan_rekening_sisa_saldo"><?php echo $laporan_rekening_delete->sisa_saldo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$laporan_rekening_delete->RecordCount = 0;
$i = 0;
while (!$laporan_rekening_delete->Recordset->EOF) {
	$laporan_rekening_delete->RecordCount++;
	$laporan_rekening_delete->RowCount++;

	// Set row properties
	$laporan_rekening->resetAttributes();
	$laporan_rekening->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$laporan_rekening_delete->loadRowValues($laporan_rekening_delete->Recordset);

	// Render row
	$laporan_rekening_delete->renderRow();
?>
	<tr <?php echo $laporan_rekening->rowAttributes() ?>>
<?php if ($laporan_rekening_delete->id->Visible) { // id ?>
		<td <?php echo $laporan_rekening_delete->id->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_id" class="laporan_rekening_id">
<span<?php echo $laporan_rekening_delete->id->viewAttributes() ?>><?php echo $laporan_rekening_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_rekening_delete->id_rekening->Visible) { // id_rekening ?>
		<td <?php echo $laporan_rekening_delete->id_rekening->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_id_rekening" class="laporan_rekening_id_rekening">
<span<?php echo $laporan_rekening_delete->id_rekening->viewAttributes() ?>><?php echo $laporan_rekening_delete->id_rekening->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_rekening_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $laporan_rekening_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_id_klinik" class="laporan_rekening_id_klinik">
<span<?php echo $laporan_rekening_delete->id_klinik->viewAttributes() ?>><?php echo $laporan_rekening_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_rekening_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $laporan_rekening_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_jumlah" class="laporan_rekening_jumlah">
<span<?php echo $laporan_rekening_delete->jumlah->viewAttributes() ?>><?php echo $laporan_rekening_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_rekening_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $laporan_rekening_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_tanggal" class="laporan_rekening_tanggal">
<span<?php echo $laporan_rekening_delete->tanggal->viewAttributes() ?>><?php echo $laporan_rekening_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_rekening_delete->saldo_awal->Visible) { // saldo_awal ?>
		<td <?php echo $laporan_rekening_delete->saldo_awal->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_saldo_awal" class="laporan_rekening_saldo_awal">
<span<?php echo $laporan_rekening_delete->saldo_awal->viewAttributes() ?>><?php echo $laporan_rekening_delete->saldo_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($laporan_rekening_delete->sisa_saldo->Visible) { // sisa_saldo ?>
		<td <?php echo $laporan_rekening_delete->sisa_saldo->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_delete->RowCount ?>_laporan_rekening_sisa_saldo" class="laporan_rekening_sisa_saldo">
<span<?php echo $laporan_rekening_delete->sisa_saldo->viewAttributes() ?>><?php echo $laporan_rekening_delete->sisa_saldo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$laporan_rekening_delete->Recordset->moveNext();
}
$laporan_rekening_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $laporan_rekening_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$laporan_rekening_delete->showPageFooter();
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
$laporan_rekening_delete->terminate();
?>