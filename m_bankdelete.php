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
$m_bank_delete = new m_bank_delete();

// Run the page
$m_bank_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_bank_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_bankdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_bankdelete = currentForm = new ew.Form("fm_bankdelete", "delete");
	loadjs.done("fm_bankdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_bank_delete->showPageHeader(); ?>
<?php
$m_bank_delete->showMessage();
?>
<form name="fm_bankdelete" id="fm_bankdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_bank">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_bank_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_bank_delete->id_bank->Visible) { // id_bank ?>
		<th class="<?php echo $m_bank_delete->id_bank->headerCellClass() ?>"><span id="elh_m_bank_id_bank" class="m_bank_id_bank"><?php echo $m_bank_delete->id_bank->caption() ?></span></th>
<?php } ?>
<?php if ($m_bank_delete->nama_bank->Visible) { // nama_bank ?>
		<th class="<?php echo $m_bank_delete->nama_bank->headerCellClass() ?>"><span id="elh_m_bank_nama_bank" class="m_bank_nama_bank"><?php echo $m_bank_delete->nama_bank->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_bank_delete->RecordCount = 0;
$i = 0;
while (!$m_bank_delete->Recordset->EOF) {
	$m_bank_delete->RecordCount++;
	$m_bank_delete->RowCount++;

	// Set row properties
	$m_bank->resetAttributes();
	$m_bank->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_bank_delete->loadRowValues($m_bank_delete->Recordset);

	// Render row
	$m_bank_delete->renderRow();
?>
	<tr <?php echo $m_bank->rowAttributes() ?>>
<?php if ($m_bank_delete->id_bank->Visible) { // id_bank ?>
		<td <?php echo $m_bank_delete->id_bank->cellAttributes() ?>>
<span id="el<?php echo $m_bank_delete->RowCount ?>_m_bank_id_bank" class="m_bank_id_bank">
<span<?php echo $m_bank_delete->id_bank->viewAttributes() ?>><?php echo $m_bank_delete->id_bank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_bank_delete->nama_bank->Visible) { // nama_bank ?>
		<td <?php echo $m_bank_delete->nama_bank->cellAttributes() ?>>
<span id="el<?php echo $m_bank_delete->RowCount ?>_m_bank_nama_bank" class="m_bank_nama_bank">
<span<?php echo $m_bank_delete->nama_bank->viewAttributes() ?>><?php echo $m_bank_delete->nama_bank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_bank_delete->Recordset->moveNext();
}
$m_bank_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_bank_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_bank_delete->showPageFooter();
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
$m_bank_delete->terminate();
?>