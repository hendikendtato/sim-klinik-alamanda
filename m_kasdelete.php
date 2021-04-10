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
$m_kas_delete = new m_kas_delete();

// Run the page
$m_kas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_kasdelete = currentForm = new ew.Form("fm_kasdelete", "delete");
	loadjs.done("fm_kasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kas_delete->showPageHeader(); ?>
<?php
$m_kas_delete->showMessage();
?>
<form name="fm_kasdelete" id="fm_kasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_kas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_kas_delete->id->Visible) { // id ?>
		<th class="<?php echo $m_kas_delete->id->headerCellClass() ?>"><span id="elh_m_kas_id" class="m_kas_id"><?php echo $m_kas_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($m_kas_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_kas_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_kas_id_klinik" class="m_kas_id_klinik"><?php echo $m_kas_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_kas_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $m_kas_delete->nama->headerCellClass() ?>"><span id="elh_m_kas_nama" class="m_kas_nama"><?php echo $m_kas_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($m_kas_delete->saldo->Visible) { // saldo ?>
		<th class="<?php echo $m_kas_delete->saldo->headerCellClass() ?>"><span id="elh_m_kas_saldo" class="m_kas_saldo"><?php echo $m_kas_delete->saldo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_kas_delete->RecordCount = 0;
$i = 0;
while (!$m_kas_delete->Recordset->EOF) {
	$m_kas_delete->RecordCount++;
	$m_kas_delete->RowCount++;

	// Set row properties
	$m_kas->resetAttributes();
	$m_kas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_kas_delete->loadRowValues($m_kas_delete->Recordset);

	// Render row
	$m_kas_delete->renderRow();
?>
	<tr <?php echo $m_kas->rowAttributes() ?>>
<?php if ($m_kas_delete->id->Visible) { // id ?>
		<td <?php echo $m_kas_delete->id->cellAttributes() ?>>
<span id="el<?php echo $m_kas_delete->RowCount ?>_m_kas_id" class="m_kas_id">
<span<?php echo $m_kas_delete->id->viewAttributes() ?>><?php echo $m_kas_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kas_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_kas_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_kas_delete->RowCount ?>_m_kas_id_klinik" class="m_kas_id_klinik">
<span<?php echo $m_kas_delete->id_klinik->viewAttributes() ?>><?php echo $m_kas_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kas_delete->nama->Visible) { // nama ?>
		<td <?php echo $m_kas_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $m_kas_delete->RowCount ?>_m_kas_nama" class="m_kas_nama">
<span<?php echo $m_kas_delete->nama->viewAttributes() ?>><?php echo $m_kas_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_kas_delete->saldo->Visible) { // saldo ?>
		<td <?php echo $m_kas_delete->saldo->cellAttributes() ?>>
<span id="el<?php echo $m_kas_delete->RowCount ?>_m_kas_saldo" class="m_kas_saldo">
<span<?php echo $m_kas_delete->saldo->viewAttributes() ?>><?php echo $m_kas_delete->saldo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_kas_delete->Recordset->moveNext();
}
$m_kas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_kas_delete->showPageFooter();
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
$m_kas_delete->terminate();
?>