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
$m_rekening_delete = new m_rekening_delete();

// Run the page
$m_rekening_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_rekening_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_rekeningdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_rekeningdelete = currentForm = new ew.Form("fm_rekeningdelete", "delete");
	loadjs.done("fm_rekeningdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_rekening_delete->showPageHeader(); ?>
<?php
$m_rekening_delete->showMessage();
?>
<form name="fm_rekeningdelete" id="fm_rekeningdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_rekening">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_rekening_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_rekening_delete->id_bank->Visible) { // id_bank ?>
		<th class="<?php echo $m_rekening_delete->id_bank->headerCellClass() ?>"><span id="elh_m_rekening_id_bank" class="m_rekening_id_bank"><?php echo $m_rekening_delete->id_bank->caption() ?></span></th>
<?php } ?>
<?php if ($m_rekening_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_rekening_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_rekening_id_klinik" class="m_rekening_id_klinik"><?php echo $m_rekening_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_rekening_delete->nama_rekening->Visible) { // nama_rekening ?>
		<th class="<?php echo $m_rekening_delete->nama_rekening->headerCellClass() ?>"><span id="elh_m_rekening_nama_rekening" class="m_rekening_nama_rekening"><?php echo $m_rekening_delete->nama_rekening->caption() ?></span></th>
<?php } ?>
<?php if ($m_rekening_delete->nomor_rekening->Visible) { // nomor_rekening ?>
		<th class="<?php echo $m_rekening_delete->nomor_rekening->headerCellClass() ?>"><span id="elh_m_rekening_nomor_rekening" class="m_rekening_nomor_rekening"><?php echo $m_rekening_delete->nomor_rekening->caption() ?></span></th>
<?php } ?>
<?php if ($m_rekening_delete->saldo->Visible) { // saldo ?>
		<th class="<?php echo $m_rekening_delete->saldo->headerCellClass() ?>"><span id="elh_m_rekening_saldo" class="m_rekening_saldo"><?php echo $m_rekening_delete->saldo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_rekening_delete->RecordCount = 0;
$i = 0;
while (!$m_rekening_delete->Recordset->EOF) {
	$m_rekening_delete->RecordCount++;
	$m_rekening_delete->RowCount++;

	// Set row properties
	$m_rekening->resetAttributes();
	$m_rekening->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_rekening_delete->loadRowValues($m_rekening_delete->Recordset);

	// Render row
	$m_rekening_delete->renderRow();
?>
	<tr <?php echo $m_rekening->rowAttributes() ?>>
<?php if ($m_rekening_delete->id_bank->Visible) { // id_bank ?>
		<td <?php echo $m_rekening_delete->id_bank->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_delete->RowCount ?>_m_rekening_id_bank" class="m_rekening_id_bank">
<span<?php echo $m_rekening_delete->id_bank->viewAttributes() ?>><?php echo $m_rekening_delete->id_bank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_rekening_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_rekening_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_delete->RowCount ?>_m_rekening_id_klinik" class="m_rekening_id_klinik">
<span<?php echo $m_rekening_delete->id_klinik->viewAttributes() ?>><?php echo $m_rekening_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_rekening_delete->nama_rekening->Visible) { // nama_rekening ?>
		<td <?php echo $m_rekening_delete->nama_rekening->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_delete->RowCount ?>_m_rekening_nama_rekening" class="m_rekening_nama_rekening">
<span<?php echo $m_rekening_delete->nama_rekening->viewAttributes() ?>><?php echo $m_rekening_delete->nama_rekening->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_rekening_delete->nomor_rekening->Visible) { // nomor_rekening ?>
		<td <?php echo $m_rekening_delete->nomor_rekening->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_delete->RowCount ?>_m_rekening_nomor_rekening" class="m_rekening_nomor_rekening">
<span<?php echo $m_rekening_delete->nomor_rekening->viewAttributes() ?>><?php echo $m_rekening_delete->nomor_rekening->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_rekening_delete->saldo->Visible) { // saldo ?>
		<td <?php echo $m_rekening_delete->saldo->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_delete->RowCount ?>_m_rekening_saldo" class="m_rekening_saldo">
<span<?php echo $m_rekening_delete->saldo->viewAttributes() ?>><?php echo $m_rekening_delete->saldo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_rekening_delete->Recordset->moveNext();
}
$m_rekening_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_rekening_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_rekening_delete->showPageFooter();
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
$m_rekening_delete->terminate();
?>