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
$returbarang_delete = new returbarang_delete();

// Run the page
$returbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$returbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freturbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	freturbarangdelete = currentForm = new ew.Form("freturbarangdelete", "delete");
	loadjs.done("freturbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $returbarang_delete->showPageHeader(); ?>
<?php
$returbarang_delete->showMessage();
?>
<form name="freturbarangdelete" id="freturbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="returbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($returbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($returbarang_delete->id_retur->Visible) { // id_retur ?>
		<th class="<?php echo $returbarang_delete->id_retur->headerCellClass() ?>"><span id="elh_returbarang_id_retur" class="returbarang_id_retur"><?php echo $returbarang_delete->id_retur->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->kode->Visible) { // kode ?>
		<th class="<?php echo $returbarang_delete->kode->headerCellClass() ?>"><span id="elh_returbarang_kode" class="returbarang_kode"><?php echo $returbarang_delete->kode->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $returbarang_delete->id_klinik->headerCellClass() ?>"><span id="elh_returbarang_id_klinik" class="returbarang_id_klinik"><?php echo $returbarang_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->id_supplier->Visible) { // id_supplier ?>
		<th class="<?php echo $returbarang_delete->id_supplier->headerCellClass() ?>"><span id="elh_returbarang_id_supplier" class="returbarang_id_supplier"><?php echo $returbarang_delete->id_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->id_pegawai->Visible) { // id_pegawai ?>
		<th class="<?php echo $returbarang_delete->id_pegawai->headerCellClass() ?>"><span id="elh_returbarang_id_pegawai" class="returbarang_id_pegawai"><?php echo $returbarang_delete->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $returbarang_delete->tanggal->headerCellClass() ?>"><span id="elh_returbarang_tanggal" class="returbarang_tanggal"><?php echo $returbarang_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->status->Visible) { // status ?>
		<th class="<?php echo $returbarang_delete->status->headerCellClass() ?>"><span id="elh_returbarang_status" class="returbarang_status"><?php echo $returbarang_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($returbarang_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $returbarang_delete->keterangan->headerCellClass() ?>"><span id="elh_returbarang_keterangan" class="returbarang_keterangan"><?php echo $returbarang_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$returbarang_delete->RecordCount = 0;
$i = 0;
while (!$returbarang_delete->Recordset->EOF) {
	$returbarang_delete->RecordCount++;
	$returbarang_delete->RowCount++;

	// Set row properties
	$returbarang->resetAttributes();
	$returbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$returbarang_delete->loadRowValues($returbarang_delete->Recordset);

	// Render row
	$returbarang_delete->renderRow();
?>
	<tr <?php echo $returbarang->rowAttributes() ?>>
<?php if ($returbarang_delete->id_retur->Visible) { // id_retur ?>
		<td <?php echo $returbarang_delete->id_retur->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_id_retur" class="returbarang_id_retur">
<span<?php echo $returbarang_delete->id_retur->viewAttributes() ?>><?php echo $returbarang_delete->id_retur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->kode->Visible) { // kode ?>
		<td <?php echo $returbarang_delete->kode->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_kode" class="returbarang_kode">
<span<?php echo $returbarang_delete->kode->viewAttributes() ?>><?php echo $returbarang_delete->kode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $returbarang_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_id_klinik" class="returbarang_id_klinik">
<span<?php echo $returbarang_delete->id_klinik->viewAttributes() ?>><?php echo $returbarang_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->id_supplier->Visible) { // id_supplier ?>
		<td <?php echo $returbarang_delete->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_id_supplier" class="returbarang_id_supplier">
<span<?php echo $returbarang_delete->id_supplier->viewAttributes() ?>><?php echo $returbarang_delete->id_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->id_pegawai->Visible) { // id_pegawai ?>
		<td <?php echo $returbarang_delete->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_id_pegawai" class="returbarang_id_pegawai">
<span<?php echo $returbarang_delete->id_pegawai->viewAttributes() ?>><?php echo $returbarang_delete->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $returbarang_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_tanggal" class="returbarang_tanggal">
<span<?php echo $returbarang_delete->tanggal->viewAttributes() ?>><?php echo $returbarang_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->status->Visible) { // status ?>
		<td <?php echo $returbarang_delete->status->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_status" class="returbarang_status">
<span<?php echo $returbarang_delete->status->viewAttributes() ?>><?php echo $returbarang_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($returbarang_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $returbarang_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $returbarang_delete->RowCount ?>_returbarang_keterangan" class="returbarang_keterangan">
<span<?php echo $returbarang_delete->keterangan->viewAttributes() ?>><?php echo $returbarang_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$returbarang_delete->Recordset->moveNext();
}
$returbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $returbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$returbarang_delete->showPageFooter();
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
$returbarang_delete->terminate();
?>