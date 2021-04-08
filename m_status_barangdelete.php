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
$m_status_barang_delete = new m_status_barang_delete();

// Run the page
$m_status_barang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_status_barang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_status_barangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_status_barangdelete = currentForm = new ew.Form("fm_status_barangdelete", "delete");
	loadjs.done("fm_status_barangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_status_barang_delete->showPageHeader(); ?>
<?php
$m_status_barang_delete->showMessage();
?>
<form name="fm_status_barangdelete" id="fm_status_barangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_status_barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_status_barang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_status_barang_delete->id_status->Visible) { // id_status ?>
		<th class="<?php echo $m_status_barang_delete->id_status->headerCellClass() ?>"><span id="elh_m_status_barang_id_status" class="m_status_barang_id_status"><?php echo $m_status_barang_delete->id_status->caption() ?></span></th>
<?php } ?>
<?php if ($m_status_barang_delete->status_barang->Visible) { // status_barang ?>
		<th class="<?php echo $m_status_barang_delete->status_barang->headerCellClass() ?>"><span id="elh_m_status_barang_status_barang" class="m_status_barang_status_barang"><?php echo $m_status_barang_delete->status_barang->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_status_barang_delete->RecordCount = 0;
$i = 0;
while (!$m_status_barang_delete->Recordset->EOF) {
	$m_status_barang_delete->RecordCount++;
	$m_status_barang_delete->RowCount++;

	// Set row properties
	$m_status_barang->resetAttributes();
	$m_status_barang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_status_barang_delete->loadRowValues($m_status_barang_delete->Recordset);

	// Render row
	$m_status_barang_delete->renderRow();
?>
	<tr <?php echo $m_status_barang->rowAttributes() ?>>
<?php if ($m_status_barang_delete->id_status->Visible) { // id_status ?>
		<td <?php echo $m_status_barang_delete->id_status->cellAttributes() ?>>
<span id="el<?php echo $m_status_barang_delete->RowCount ?>_m_status_barang_id_status" class="m_status_barang_id_status">
<span<?php echo $m_status_barang_delete->id_status->viewAttributes() ?>><?php echo $m_status_barang_delete->id_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_status_barang_delete->status_barang->Visible) { // status_barang ?>
		<td <?php echo $m_status_barang_delete->status_barang->cellAttributes() ?>>
<span id="el<?php echo $m_status_barang_delete->RowCount ?>_m_status_barang_status_barang" class="m_status_barang_status_barang">
<span<?php echo $m_status_barang_delete->status_barang->viewAttributes() ?>><?php echo $m_status_barang_delete->status_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_status_barang_delete->Recordset->moveNext();
}
$m_status_barang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_status_barang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_status_barang_delete->showPageFooter();
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
$m_status_barang_delete->terminate();
?>