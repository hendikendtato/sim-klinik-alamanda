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
$m_klinik_delete = new m_klinik_delete();

// Run the page
$m_klinik_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_klinik_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_klinikdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_klinikdelete = currentForm = new ew.Form("fm_klinikdelete", "delete");
	loadjs.done("fm_klinikdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_klinik_delete->showPageHeader(); ?>
<?php
$m_klinik_delete->showMessage();
?>
<form name="fm_klinikdelete" id="fm_klinikdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_klinik">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_klinik_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_klinik_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_klinik_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_klinik_id_klinik" class="m_klinik_id_klinik"><?php echo $m_klinik_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_klinik_delete->nama_klinik->Visible) { // nama_klinik ?>
		<th class="<?php echo $m_klinik_delete->nama_klinik->headerCellClass() ?>"><span id="elh_m_klinik_nama_klinik" class="m_klinik_nama_klinik"><?php echo $m_klinik_delete->nama_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_klinik_delete->foto_klinik->Visible) { // foto_klinik ?>
		<th class="<?php echo $m_klinik_delete->foto_klinik->headerCellClass() ?>"><span id="elh_m_klinik_foto_klinik" class="m_klinik_foto_klinik"><?php echo $m_klinik_delete->foto_klinik->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_klinik_delete->RecordCount = 0;
$i = 0;
while (!$m_klinik_delete->Recordset->EOF) {
	$m_klinik_delete->RecordCount++;
	$m_klinik_delete->RowCount++;

	// Set row properties
	$m_klinik->resetAttributes();
	$m_klinik->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_klinik_delete->loadRowValues($m_klinik_delete->Recordset);

	// Render row
	$m_klinik_delete->renderRow();
?>
	<tr <?php echo $m_klinik->rowAttributes() ?>>
<?php if ($m_klinik_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_klinik_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_klinik_delete->RowCount ?>_m_klinik_id_klinik" class="m_klinik_id_klinik">
<span<?php echo $m_klinik_delete->id_klinik->viewAttributes() ?>><?php echo $m_klinik_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_klinik_delete->nama_klinik->Visible) { // nama_klinik ?>
		<td <?php echo $m_klinik_delete->nama_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_klinik_delete->RowCount ?>_m_klinik_nama_klinik" class="m_klinik_nama_klinik">
<span<?php echo $m_klinik_delete->nama_klinik->viewAttributes() ?>><?php echo $m_klinik_delete->nama_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_klinik_delete->foto_klinik->Visible) { // foto_klinik ?>
		<td <?php echo $m_klinik_delete->foto_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_klinik_delete->RowCount ?>_m_klinik_foto_klinik" class="m_klinik_foto_klinik">
<span<?php echo $m_klinik_delete->foto_klinik->viewAttributes() ?>><?php echo $m_klinik_delete->foto_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_klinik_delete->Recordset->moveNext();
}
$m_klinik_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_klinik_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_klinik_delete->showPageFooter();
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
$m_klinik_delete->terminate();
?>