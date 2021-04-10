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
$m_tipepelanggan_delete = new m_tipepelanggan_delete();

// Run the page
$m_tipepelanggan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tipepelanggan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_tipepelanggandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_tipepelanggandelete = currentForm = new ew.Form("fm_tipepelanggandelete", "delete");
	loadjs.done("fm_tipepelanggandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_tipepelanggan_delete->showPageHeader(); ?>
<?php
$m_tipepelanggan_delete->showMessage();
?>
<form name="fm_tipepelanggandelete" id="fm_tipepelanggandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tipepelanggan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_tipepelanggan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_tipepelanggan_delete->nama_tipe->Visible) { // nama_tipe ?>
		<th class="<?php echo $m_tipepelanggan_delete->nama_tipe->headerCellClass() ?>"><span id="elh_m_tipepelanggan_nama_tipe" class="m_tipepelanggan_nama_tipe"><?php echo $m_tipepelanggan_delete->nama_tipe->caption() ?></span></th>
<?php } ?>
<?php if ($m_tipepelanggan_delete->min_kedatangan->Visible) { // min_kedatangan ?>
		<th class="<?php echo $m_tipepelanggan_delete->min_kedatangan->headerCellClass() ?>"><span id="elh_m_tipepelanggan_min_kedatangan" class="m_tipepelanggan_min_kedatangan"><?php echo $m_tipepelanggan_delete->min_kedatangan->caption() ?></span></th>
<?php } ?>
<?php if ($m_tipepelanggan_delete->periode->Visible) { // periode ?>
		<th class="<?php echo $m_tipepelanggan_delete->periode->headerCellClass() ?>"><span id="elh_m_tipepelanggan_periode" class="m_tipepelanggan_periode"><?php echo $m_tipepelanggan_delete->periode->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_tipepelanggan_delete->RecordCount = 0;
$i = 0;
while (!$m_tipepelanggan_delete->Recordset->EOF) {
	$m_tipepelanggan_delete->RecordCount++;
	$m_tipepelanggan_delete->RowCount++;

	// Set row properties
	$m_tipepelanggan->resetAttributes();
	$m_tipepelanggan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_tipepelanggan_delete->loadRowValues($m_tipepelanggan_delete->Recordset);

	// Render row
	$m_tipepelanggan_delete->renderRow();
?>
	<tr <?php echo $m_tipepelanggan->rowAttributes() ?>>
<?php if ($m_tipepelanggan_delete->nama_tipe->Visible) { // nama_tipe ?>
		<td <?php echo $m_tipepelanggan_delete->nama_tipe->cellAttributes() ?>>
<span id="el<?php echo $m_tipepelanggan_delete->RowCount ?>_m_tipepelanggan_nama_tipe" class="m_tipepelanggan_nama_tipe">
<span<?php echo $m_tipepelanggan_delete->nama_tipe->viewAttributes() ?>><?php echo $m_tipepelanggan_delete->nama_tipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_tipepelanggan_delete->min_kedatangan->Visible) { // min_kedatangan ?>
		<td <?php echo $m_tipepelanggan_delete->min_kedatangan->cellAttributes() ?>>
<span id="el<?php echo $m_tipepelanggan_delete->RowCount ?>_m_tipepelanggan_min_kedatangan" class="m_tipepelanggan_min_kedatangan">
<span<?php echo $m_tipepelanggan_delete->min_kedatangan->viewAttributes() ?>><?php echo $m_tipepelanggan_delete->min_kedatangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_tipepelanggan_delete->periode->Visible) { // periode ?>
		<td <?php echo $m_tipepelanggan_delete->periode->cellAttributes() ?>>
<span id="el<?php echo $m_tipepelanggan_delete->RowCount ?>_m_tipepelanggan_periode" class="m_tipepelanggan_periode">
<span<?php echo $m_tipepelanggan_delete->periode->viewAttributes() ?>><?php echo $m_tipepelanggan_delete->periode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_tipepelanggan_delete->Recordset->moveNext();
}
$m_tipepelanggan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_tipepelanggan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_tipepelanggan_delete->showPageFooter();
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
$m_tipepelanggan_delete->terminate();
?>