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
$m_satuan_barang_delete = new m_satuan_barang_delete();

// Run the page
$m_satuan_barang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_satuan_barang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_satuan_barangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_satuan_barangdelete = currentForm = new ew.Form("fm_satuan_barangdelete", "delete");
	loadjs.done("fm_satuan_barangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_satuan_barang_delete->showPageHeader(); ?>
<?php
$m_satuan_barang_delete->showMessage();
?>
<form name="fm_satuan_barangdelete" id="fm_satuan_barangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_satuan_barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_satuan_barang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_satuan_barang_delete->kode_satuan->Visible) { // kode_satuan ?>
		<th class="<?php echo $m_satuan_barang_delete->kode_satuan->headerCellClass() ?>"><span id="elh_m_satuan_barang_kode_satuan" class="m_satuan_barang_kode_satuan"><?php echo $m_satuan_barang_delete->kode_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($m_satuan_barang_delete->nama_satuan->Visible) { // nama_satuan ?>
		<th class="<?php echo $m_satuan_barang_delete->nama_satuan->headerCellClass() ?>"><span id="elh_m_satuan_barang_nama_satuan" class="m_satuan_barang_nama_satuan"><?php echo $m_satuan_barang_delete->nama_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($m_satuan_barang_delete->level_satuan->Visible) { // level_satuan ?>
		<th class="<?php echo $m_satuan_barang_delete->level_satuan->headerCellClass() ?>"><span id="elh_m_satuan_barang_level_satuan" class="m_satuan_barang_level_satuan"><?php echo $m_satuan_barang_delete->level_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($m_satuan_barang_delete->konversi_satuan->Visible) { // konversi_satuan ?>
		<th class="<?php echo $m_satuan_barang_delete->konversi_satuan->headerCellClass() ?>"><span id="elh_m_satuan_barang_konversi_satuan" class="m_satuan_barang_konversi_satuan"><?php echo $m_satuan_barang_delete->konversi_satuan->caption() ?></span></th>
<?php } ?>
<?php if ($m_satuan_barang_delete->pid_satuan->Visible) { // pid_satuan ?>
		<th class="<?php echo $m_satuan_barang_delete->pid_satuan->headerCellClass() ?>"><span id="elh_m_satuan_barang_pid_satuan" class="m_satuan_barang_pid_satuan"><?php echo $m_satuan_barang_delete->pid_satuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_satuan_barang_delete->RecordCount = 0;
$i = 0;
while (!$m_satuan_barang_delete->Recordset->EOF) {
	$m_satuan_barang_delete->RecordCount++;
	$m_satuan_barang_delete->RowCount++;

	// Set row properties
	$m_satuan_barang->resetAttributes();
	$m_satuan_barang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_satuan_barang_delete->loadRowValues($m_satuan_barang_delete->Recordset);

	// Render row
	$m_satuan_barang_delete->renderRow();
?>
	<tr <?php echo $m_satuan_barang->rowAttributes() ?>>
<?php if ($m_satuan_barang_delete->kode_satuan->Visible) { // kode_satuan ?>
		<td <?php echo $m_satuan_barang_delete->kode_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_delete->RowCount ?>_m_satuan_barang_kode_satuan" class="m_satuan_barang_kode_satuan">
<span<?php echo $m_satuan_barang_delete->kode_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_delete->kode_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_satuan_barang_delete->nama_satuan->Visible) { // nama_satuan ?>
		<td <?php echo $m_satuan_barang_delete->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_delete->RowCount ?>_m_satuan_barang_nama_satuan" class="m_satuan_barang_nama_satuan">
<span<?php echo $m_satuan_barang_delete->nama_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_delete->nama_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_satuan_barang_delete->level_satuan->Visible) { // level_satuan ?>
		<td <?php echo $m_satuan_barang_delete->level_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_delete->RowCount ?>_m_satuan_barang_level_satuan" class="m_satuan_barang_level_satuan">
<span<?php echo $m_satuan_barang_delete->level_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_delete->level_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_satuan_barang_delete->konversi_satuan->Visible) { // konversi_satuan ?>
		<td <?php echo $m_satuan_barang_delete->konversi_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_delete->RowCount ?>_m_satuan_barang_konversi_satuan" class="m_satuan_barang_konversi_satuan">
<span<?php echo $m_satuan_barang_delete->konversi_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_delete->konversi_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_satuan_barang_delete->pid_satuan->Visible) { // pid_satuan ?>
		<td <?php echo $m_satuan_barang_delete->pid_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_delete->RowCount ?>_m_satuan_barang_pid_satuan" class="m_satuan_barang_pid_satuan">
<span<?php echo $m_satuan_barang_delete->pid_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_delete->pid_satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_satuan_barang_delete->Recordset->moveNext();
}
$m_satuan_barang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_satuan_barang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_satuan_barang_delete->showPageFooter();
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
$m_satuan_barang_delete->terminate();
?>