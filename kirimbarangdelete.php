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
$kirimbarang_delete = new kirimbarang_delete();

// Run the page
$kirimbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kirimbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkirimbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkirimbarangdelete = currentForm = new ew.Form("fkirimbarangdelete", "delete");
	loadjs.done("fkirimbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kirimbarang_delete->showPageHeader(); ?>
<?php
$kirimbarang_delete->showMessage();
?>
<form name="fkirimbarangdelete" id="fkirimbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kirimbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kirimbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kirimbarang_delete->no_kirimbarang->Visible) { // no_kirimbarang ?>
		<th class="<?php echo $kirimbarang_delete->no_kirimbarang->headerCellClass() ?>"><span id="elh_kirimbarang_no_kirimbarang" class="kirimbarang_no_kirimbarang"><?php echo $kirimbarang_delete->no_kirimbarang->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->id_po->Visible) { // id_po ?>
		<th class="<?php echo $kirimbarang_delete->id_po->headerCellClass() ?>"><span id="elh_kirimbarang_id_po" class="kirimbarang_id_po"><?php echo $kirimbarang_delete->id_po->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->id_supplier->Visible) { // id_supplier ?>
		<th class="<?php echo $kirimbarang_delete->id_supplier->headerCellClass() ?>"><span id="elh_kirimbarang_id_supplier" class="kirimbarang_id_supplier"><?php echo $kirimbarang_delete->id_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $kirimbarang_delete->id_klinik->headerCellClass() ?>"><span id="elh_kirimbarang_id_klinik" class="kirimbarang_id_klinik"><?php echo $kirimbarang_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->id_pegawai->Visible) { // id_pegawai ?>
		<th class="<?php echo $kirimbarang_delete->id_pegawai->headerCellClass() ?>"><span id="elh_kirimbarang_id_pegawai" class="kirimbarang_id_pegawai"><?php echo $kirimbarang_delete->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $kirimbarang_delete->tanggal->headerCellClass() ?>"><span id="elh_kirimbarang_tanggal" class="kirimbarang_tanggal"><?php echo $kirimbarang_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->status_kirim->Visible) { // status_kirim ?>
		<th class="<?php echo $kirimbarang_delete->status_kirim->headerCellClass() ?>"><span id="elh_kirimbarang_status_kirim" class="kirimbarang_status_kirim"><?php echo $kirimbarang_delete->status_kirim->caption() ?></span></th>
<?php } ?>
<?php if ($kirimbarang_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $kirimbarang_delete->keterangan->headerCellClass() ?>"><span id="elh_kirimbarang_keterangan" class="kirimbarang_keterangan"><?php echo $kirimbarang_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kirimbarang_delete->RecordCount = 0;
$i = 0;
while (!$kirimbarang_delete->Recordset->EOF) {
	$kirimbarang_delete->RecordCount++;
	$kirimbarang_delete->RowCount++;

	// Set row properties
	$kirimbarang->resetAttributes();
	$kirimbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kirimbarang_delete->loadRowValues($kirimbarang_delete->Recordset);

	// Render row
	$kirimbarang_delete->renderRow();
?>
	<tr <?php echo $kirimbarang->rowAttributes() ?>>
<?php if ($kirimbarang_delete->no_kirimbarang->Visible) { // no_kirimbarang ?>
		<td <?php echo $kirimbarang_delete->no_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_no_kirimbarang" class="kirimbarang_no_kirimbarang">
<span<?php echo $kirimbarang_delete->no_kirimbarang->viewAttributes() ?>><?php echo $kirimbarang_delete->no_kirimbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->id_po->Visible) { // id_po ?>
		<td <?php echo $kirimbarang_delete->id_po->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_id_po" class="kirimbarang_id_po">
<span<?php echo $kirimbarang_delete->id_po->viewAttributes() ?>><?php echo $kirimbarang_delete->id_po->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->id_supplier->Visible) { // id_supplier ?>
		<td <?php echo $kirimbarang_delete->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_id_supplier" class="kirimbarang_id_supplier">
<span<?php echo $kirimbarang_delete->id_supplier->viewAttributes() ?>><?php echo $kirimbarang_delete->id_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $kirimbarang_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_id_klinik" class="kirimbarang_id_klinik">
<span<?php echo $kirimbarang_delete->id_klinik->viewAttributes() ?>><?php echo $kirimbarang_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->id_pegawai->Visible) { // id_pegawai ?>
		<td <?php echo $kirimbarang_delete->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_id_pegawai" class="kirimbarang_id_pegawai">
<span<?php echo $kirimbarang_delete->id_pegawai->viewAttributes() ?>><?php echo $kirimbarang_delete->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $kirimbarang_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_tanggal" class="kirimbarang_tanggal">
<span<?php echo $kirimbarang_delete->tanggal->viewAttributes() ?>><?php echo $kirimbarang_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->status_kirim->Visible) { // status_kirim ?>
		<td <?php echo $kirimbarang_delete->status_kirim->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_status_kirim" class="kirimbarang_status_kirim">
<span<?php echo $kirimbarang_delete->status_kirim->viewAttributes() ?>><?php echo $kirimbarang_delete->status_kirim->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kirimbarang_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $kirimbarang_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_delete->RowCount ?>_kirimbarang_keterangan" class="kirimbarang_keterangan">
<span<?php echo $kirimbarang_delete->keterangan->viewAttributes() ?>><?php echo $kirimbarang_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kirimbarang_delete->Recordset->moveNext();
}
$kirimbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kirimbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kirimbarang_delete->showPageFooter();
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
$kirimbarang_delete->terminate();
?>