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
$m_jabatan_delete = new m_jabatan_delete();

// Run the page
$m_jabatan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jabatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_jabatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_jabatandelete = currentForm = new ew.Form("fm_jabatandelete", "delete");
	loadjs.done("fm_jabatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_jabatan_delete->showPageHeader(); ?>
<?php
$m_jabatan_delete->showMessage();
?>
<form name="fm_jabatandelete" id="fm_jabatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jabatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_jabatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_jabatan_delete->id->Visible) { // id ?>
		<th class="<?php echo $m_jabatan_delete->id->headerCellClass() ?>"><span id="elh_m_jabatan_id" class="m_jabatan_id"><?php echo $m_jabatan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($m_jabatan_delete->nama_jabatan->Visible) { // nama_jabatan ?>
		<th class="<?php echo $m_jabatan_delete->nama_jabatan->headerCellClass() ?>"><span id="elh_m_jabatan_nama_jabatan" class="m_jabatan_nama_jabatan"><?php echo $m_jabatan_delete->nama_jabatan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_jabatan_delete->RecordCount = 0;
$i = 0;
while (!$m_jabatan_delete->Recordset->EOF) {
	$m_jabatan_delete->RecordCount++;
	$m_jabatan_delete->RowCount++;

	// Set row properties
	$m_jabatan->resetAttributes();
	$m_jabatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_jabatan_delete->loadRowValues($m_jabatan_delete->Recordset);

	// Render row
	$m_jabatan_delete->renderRow();
?>
	<tr <?php echo $m_jabatan->rowAttributes() ?>>
<?php if ($m_jabatan_delete->id->Visible) { // id ?>
		<td <?php echo $m_jabatan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $m_jabatan_delete->RowCount ?>_m_jabatan_id" class="m_jabatan_id">
<span<?php echo $m_jabatan_delete->id->viewAttributes() ?>><?php echo $m_jabatan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jabatan_delete->nama_jabatan->Visible) { // nama_jabatan ?>
		<td <?php echo $m_jabatan_delete->nama_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_jabatan_delete->RowCount ?>_m_jabatan_nama_jabatan" class="m_jabatan_nama_jabatan">
<span<?php echo $m_jabatan_delete->nama_jabatan->viewAttributes() ?>><?php echo $m_jabatan_delete->nama_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_jabatan_delete->Recordset->moveNext();
}
$m_jabatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_jabatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_jabatan_delete->showPageFooter();
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
$m_jabatan_delete->terminate();
?>