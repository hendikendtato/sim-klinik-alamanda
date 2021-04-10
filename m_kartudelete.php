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
$m_kartu_delete = new m_kartu_delete();

// Run the page
$m_kartu_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kartu_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kartudelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_kartudelete = currentForm = new ew.Form("fm_kartudelete", "delete");
	loadjs.done("fm_kartudelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kartu_delete->showPageHeader(); ?>
<?php
$m_kartu_delete->showMessage();
?>
<form name="fm_kartudelete" id="fm_kartudelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kartu">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_kartu_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_kartu_delete->id_bank->Visible) { // id_bank ?>
		<th class="<?php echo $m_kartu_delete->id_bank->headerCellClass() ?>"><span id="elh_m_kartu_id_bank" class="m_kartu_id_bank"><?php echo $m_kartu_delete->id_bank->caption() ?></span></th>
<?php } ?>
<?php if ($m_kartu_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $m_kartu_delete->jenis->headerCellClass() ?>"><span id="elh_m_kartu_jenis" class="m_kartu_jenis"><?php echo $m_kartu_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($m_kartu_delete->nama_kartu->Visible) { // nama_kartu ?>
		<th class="<?php echo $m_kartu_delete->nama_kartu->headerCellClass() ?>"><span id="elh_m_kartu_nama_kartu" class="m_kartu_nama_kartu"><?php echo $m_kartu_delete->nama_kartu->caption() ?></span></th>
<?php } ?>
<?php if ($m_kartu_delete->charge_type->Visible) { // charge_type ?>
		<th class="<?php echo $m_kartu_delete->charge_type->headerCellClass() ?>"><span id="elh_m_kartu_charge_type" class="m_kartu_charge_type"><?php echo $m_kartu_delete->charge_type->caption() ?></span></th>
<?php } ?>
<?php if ($m_kartu_delete->charge_price->Visible) { // charge_price ?>
		<th class="<?php echo $m_kartu_delete->charge_price->headerCellClass() ?>"><span id="elh_m_kartu_charge_price" class="m_kartu_charge_price"><?php echo $m_kartu_delete->charge_price->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_kartu_delete->RecordCount = 0;
$i = 0;
while (!$m_kartu_delete->Recordset->EOF) {
	$m_kartu_delete->RecordCount++;
	$m_kartu_delete->RowCount++;

	// Set row properties
	$m_kartu->resetAttributes();
	$m_kartu->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_kartu_delete->loadRowValues($m_kartu_delete->Recordset);

	// Render row
	$m_kartu_delete->renderRow();
?>
	<tr <?php echo $m_kartu->rowAttributes() ?>>
<?php if ($m_kartu_delete->id_bank->Visible) { // id_bank ?>
		<td <?php echo $m_kartu_delete->id_bank->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_delete->RowCount ?>_m_kartu_id_bank" class="m_kartu_id_bank">
<span<?php echo $m_kartu_delete->id_bank->viewAttributes() ?>><?php echo $m_kartu_delete->id_bank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kartu_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $m_kartu_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_delete->RowCount ?>_m_kartu_jenis" class="m_kartu_jenis">
<span<?php echo $m_kartu_delete->jenis->viewAttributes() ?>><?php echo $m_kartu_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kartu_delete->nama_kartu->Visible) { // nama_kartu ?>
		<td <?php echo $m_kartu_delete->nama_kartu->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_delete->RowCount ?>_m_kartu_nama_kartu" class="m_kartu_nama_kartu">
<span<?php echo $m_kartu_delete->nama_kartu->viewAttributes() ?>><?php echo $m_kartu_delete->nama_kartu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kartu_delete->charge_type->Visible) { // charge_type ?>
		<td <?php echo $m_kartu_delete->charge_type->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_delete->RowCount ?>_m_kartu_charge_type" class="m_kartu_charge_type">
<span<?php echo $m_kartu_delete->charge_type->viewAttributes() ?>><?php echo $m_kartu_delete->charge_type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kartu_delete->charge_price->Visible) { // charge_price ?>
		<td <?php echo $m_kartu_delete->charge_price->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_delete->RowCount ?>_m_kartu_charge_price" class="m_kartu_charge_price">
<span<?php echo $m_kartu_delete->charge_price->viewAttributes() ?>><?php echo $m_kartu_delete->charge_price->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_kartu_delete->Recordset->moveNext();
}
$m_kartu_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kartu_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_kartu_delete->showPageFooter();
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
$m_kartu_delete->terminate();
?>