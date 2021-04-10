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
$m_agama_delete = new m_agama_delete();

// Run the page
$m_agama_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_agama_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_agamadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_agamadelete = currentForm = new ew.Form("fm_agamadelete", "delete");
	loadjs.done("fm_agamadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_agama_delete->showPageHeader(); ?>
<?php
$m_agama_delete->showMessage();
?>
<form name="fm_agamadelete" id="fm_agamadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_agama">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_agama_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_agama_delete->id_agama->Visible) { // id_agama ?>
		<th class="<?php echo $m_agama_delete->id_agama->headerCellClass() ?>"><span id="elh_m_agama_id_agama" class="m_agama_id_agama"><?php echo $m_agama_delete->id_agama->caption() ?></span></th>
<?php } ?>
<?php if ($m_agama_delete->nama_agama->Visible) { // nama_agama ?>
		<th class="<?php echo $m_agama_delete->nama_agama->headerCellClass() ?>"><span id="elh_m_agama_nama_agama" class="m_agama_nama_agama"><?php echo $m_agama_delete->nama_agama->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_agama_delete->RecordCount = 0;
$i = 0;
while (!$m_agama_delete->Recordset->EOF) {
	$m_agama_delete->RecordCount++;
	$m_agama_delete->RowCount++;

	// Set row properties
	$m_agama->resetAttributes();
	$m_agama->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_agama_delete->loadRowValues($m_agama_delete->Recordset);

	// Render row
	$m_agama_delete->renderRow();
?>
	<tr <?php echo $m_agama->rowAttributes() ?>>
<?php if ($m_agama_delete->id_agama->Visible) { // id_agama ?>
		<td <?php echo $m_agama_delete->id_agama->cellAttributes() ?>>
<span id="el<?php echo $m_agama_delete->RowCount ?>_m_agama_id_agama" class="m_agama_id_agama">
<span<?php echo $m_agama_delete->id_agama->viewAttributes() ?>><?php echo $m_agama_delete->id_agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_agama_delete->nama_agama->Visible) { // nama_agama ?>
		<td <?php echo $m_agama_delete->nama_agama->cellAttributes() ?>>
<span id="el<?php echo $m_agama_delete->RowCount ?>_m_agama_nama_agama" class="m_agama_nama_agama">
<span<?php echo $m_agama_delete->nama_agama->viewAttributes() ?>><?php echo $m_agama_delete->nama_agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_agama_delete->Recordset->moveNext();
}
$m_agama_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_agama_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_agama_delete->showPageFooter();
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
$m_agama_delete->terminate();
?>