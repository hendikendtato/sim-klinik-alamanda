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
$terimabarang_delete = new terimabarang_delete();

// Run the page
$terimabarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimabarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterimabarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fterimabarangdelete = currentForm = new ew.Form("fterimabarangdelete", "delete");
	loadjs.done("fterimabarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terimabarang_delete->showPageHeader(); ?>
<?php
$terimabarang_delete->showMessage();
?>
<form name="fterimabarangdelete" id="fterimabarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimabarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($terimabarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($terimabarang_delete->no_terima->Visible) { // no_terima ?>
		<th class="<?php echo $terimabarang_delete->no_terima->headerCellClass() ?>"><span id="elh_terimabarang_no_terima" class="terimabarang_no_terima"><?php echo $terimabarang_delete->no_terima->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<th class="<?php echo $terimabarang_delete->id_kirimbarang->headerCellClass() ?>"><span id="elh_terimabarang_id_kirimbarang" class="terimabarang_id_kirimbarang"><?php echo $terimabarang_delete->id_kirimbarang->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->id_po->Visible) { // id_po ?>
		<th class="<?php echo $terimabarang_delete->id_po->headerCellClass() ?>"><span id="elh_terimabarang_id_po" class="terimabarang_id_po"><?php echo $terimabarang_delete->id_po->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->id_supplier->Visible) { // id_supplier ?>
		<th class="<?php echo $terimabarang_delete->id_supplier->headerCellClass() ?>"><span id="elh_terimabarang_id_supplier" class="terimabarang_id_supplier"><?php echo $terimabarang_delete->id_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $terimabarang_delete->id_klinik->headerCellClass() ?>"><span id="elh_terimabarang_id_klinik" class="terimabarang_id_klinik"><?php echo $terimabarang_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->id_pegawai->Visible) { // id_pegawai ?>
		<th class="<?php echo $terimabarang_delete->id_pegawai->headerCellClass() ?>"><span id="elh_terimabarang_id_pegawai" class="terimabarang_id_pegawai"><?php echo $terimabarang_delete->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->tanggal_terima->Visible) { // tanggal_terima ?>
		<th class="<?php echo $terimabarang_delete->tanggal_terima->headerCellClass() ?>"><span id="elh_terimabarang_tanggal_terima" class="terimabarang_tanggal_terima"><?php echo $terimabarang_delete->tanggal_terima->caption() ?></span></th>
<?php } ?>
<?php if ($terimabarang_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $terimabarang_delete->keterangan->headerCellClass() ?>"><span id="elh_terimabarang_keterangan" class="terimabarang_keterangan"><?php echo $terimabarang_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$terimabarang_delete->RecordCount = 0;
$i = 0;
while (!$terimabarang_delete->Recordset->EOF) {
	$terimabarang_delete->RecordCount++;
	$terimabarang_delete->RowCount++;

	// Set row properties
	$terimabarang->resetAttributes();
	$terimabarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$terimabarang_delete->loadRowValues($terimabarang_delete->Recordset);

	// Render row
	$terimabarang_delete->renderRow();
?>
	<tr <?php echo $terimabarang->rowAttributes() ?>>
<?php if ($terimabarang_delete->no_terima->Visible) { // no_terima ?>
		<td <?php echo $terimabarang_delete->no_terima->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_no_terima" class="terimabarang_no_terima">
<span<?php echo $terimabarang_delete->no_terima->viewAttributes() ?>><?php echo $terimabarang_delete->no_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td <?php echo $terimabarang_delete->id_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_id_kirimbarang" class="terimabarang_id_kirimbarang">
<span<?php echo $terimabarang_delete->id_kirimbarang->viewAttributes() ?>><?php echo $terimabarang_delete->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->id_po->Visible) { // id_po ?>
		<td <?php echo $terimabarang_delete->id_po->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_id_po" class="terimabarang_id_po">
<span<?php echo $terimabarang_delete->id_po->viewAttributes() ?>><?php echo $terimabarang_delete->id_po->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->id_supplier->Visible) { // id_supplier ?>
		<td <?php echo $terimabarang_delete->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_id_supplier" class="terimabarang_id_supplier">
<span<?php echo $terimabarang_delete->id_supplier->viewAttributes() ?>><?php echo $terimabarang_delete->id_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $terimabarang_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_id_klinik" class="terimabarang_id_klinik">
<span<?php echo $terimabarang_delete->id_klinik->viewAttributes() ?>><?php echo $terimabarang_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->id_pegawai->Visible) { // id_pegawai ?>
		<td <?php echo $terimabarang_delete->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_id_pegawai" class="terimabarang_id_pegawai">
<span<?php echo $terimabarang_delete->id_pegawai->viewAttributes() ?>><?php echo $terimabarang_delete->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->tanggal_terima->Visible) { // tanggal_terima ?>
		<td <?php echo $terimabarang_delete->tanggal_terima->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_tanggal_terima" class="terimabarang_tanggal_terima">
<span<?php echo $terimabarang_delete->tanggal_terima->viewAttributes() ?>><?php echo $terimabarang_delete->tanggal_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimabarang_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $terimabarang_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_delete->RowCount ?>_terimabarang_keterangan" class="terimabarang_keterangan">
<span<?php echo $terimabarang_delete->keterangan->viewAttributes() ?>><?php echo $terimabarang_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$terimabarang_delete->Recordset->moveNext();
}
$terimabarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terimabarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$terimabarang_delete->showPageFooter();
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
$terimabarang_delete->terminate();
?>