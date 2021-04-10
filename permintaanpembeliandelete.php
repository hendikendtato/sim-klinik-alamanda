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
$permintaanpembelian_delete = new permintaanpembelian_delete();

// Run the page
$permintaanpembelian_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$permintaanpembelian_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpermintaanpembeliandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpermintaanpembeliandelete = currentForm = new ew.Form("fpermintaanpembeliandelete", "delete");
	loadjs.done("fpermintaanpembeliandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $permintaanpembelian_delete->showPageHeader(); ?>
<?php
$permintaanpembelian_delete->showMessage();
?>
<form name="fpermintaanpembeliandelete" id="fpermintaanpembeliandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="permintaanpembelian">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($permintaanpembelian_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($permintaanpembelian_delete->id_pp->Visible) { // id_pp ?>
		<th class="<?php echo $permintaanpembelian_delete->id_pp->headerCellClass() ?>"><span id="elh_permintaanpembelian_id_pp" class="permintaanpembelian_id_pp"><?php echo $permintaanpembelian_delete->id_pp->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->no_pp->Visible) { // no_pp ?>
		<th class="<?php echo $permintaanpembelian_delete->no_pp->headerCellClass() ?>"><span id="elh_permintaanpembelian_no_pp" class="permintaanpembelian_no_pp"><?php echo $permintaanpembelian_delete->no_pp->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->namapaket_pp->Visible) { // namapaket_pp ?>
		<th class="<?php echo $permintaanpembelian_delete->namapaket_pp->headerCellClass() ?>"><span id="elh_permintaanpembelian_namapaket_pp" class="permintaanpembelian_namapaket_pp"><?php echo $permintaanpembelian_delete->namapaket_pp->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->tgl_pp->Visible) { // tgl_pp ?>
		<th class="<?php echo $permintaanpembelian_delete->tgl_pp->headerCellClass() ?>"><span id="elh_permintaanpembelian_tgl_pp" class="permintaanpembelian_tgl_pp"><?php echo $permintaanpembelian_delete->tgl_pp->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
		<th class="<?php echo $permintaanpembelian_delete->tgl_kebutuhan->headerCellClass() ?>"><span id="elh_permintaanpembelian_tgl_kebutuhan" class="permintaanpembelian_tgl_kebutuhan"><?php echo $permintaanpembelian_delete->tgl_kebutuhan->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
		<th class="<?php echo $permintaanpembelian_delete->tgl_persetujuan->headerCellClass() ?>"><span id="elh_permintaanpembelian_tgl_persetujuan" class="permintaanpembelian_tgl_persetujuan"><?php echo $permintaanpembelian_delete->tgl_persetujuan->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->staf_pengajuan->Visible) { // staf_pengajuan ?>
		<th class="<?php echo $permintaanpembelian_delete->staf_pengajuan->headerCellClass() ?>"><span id="elh_permintaanpembelian_staf_pengajuan" class="permintaanpembelian_staf_pengajuan"><?php echo $permintaanpembelian_delete->staf_pengajuan->caption() ?></span></th>
<?php } ?>
<?php if ($permintaanpembelian_delete->staf_validasi->Visible) { // staf_validasi ?>
		<th class="<?php echo $permintaanpembelian_delete->staf_validasi->headerCellClass() ?>"><span id="elh_permintaanpembelian_staf_validasi" class="permintaanpembelian_staf_validasi"><?php echo $permintaanpembelian_delete->staf_validasi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$permintaanpembelian_delete->RecordCount = 0;
$i = 0;
while (!$permintaanpembelian_delete->Recordset->EOF) {
	$permintaanpembelian_delete->RecordCount++;
	$permintaanpembelian_delete->RowCount++;

	// Set row properties
	$permintaanpembelian->resetAttributes();
	$permintaanpembelian->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$permintaanpembelian_delete->loadRowValues($permintaanpembelian_delete->Recordset);

	// Render row
	$permintaanpembelian_delete->renderRow();
?>
	<tr <?php echo $permintaanpembelian->rowAttributes() ?>>
<?php if ($permintaanpembelian_delete->id_pp->Visible) { // id_pp ?>
		<td <?php echo $permintaanpembelian_delete->id_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_id_pp" class="permintaanpembelian_id_pp">
<span<?php echo $permintaanpembelian_delete->id_pp->viewAttributes() ?>><?php echo $permintaanpembelian_delete->id_pp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->no_pp->Visible) { // no_pp ?>
		<td <?php echo $permintaanpembelian_delete->no_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_no_pp" class="permintaanpembelian_no_pp">
<span<?php echo $permintaanpembelian_delete->no_pp->viewAttributes() ?>><?php echo $permintaanpembelian_delete->no_pp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->namapaket_pp->Visible) { // namapaket_pp ?>
		<td <?php echo $permintaanpembelian_delete->namapaket_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_namapaket_pp" class="permintaanpembelian_namapaket_pp">
<span<?php echo $permintaanpembelian_delete->namapaket_pp->viewAttributes() ?>><?php echo $permintaanpembelian_delete->namapaket_pp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->tgl_pp->Visible) { // tgl_pp ?>
		<td <?php echo $permintaanpembelian_delete->tgl_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_tgl_pp" class="permintaanpembelian_tgl_pp">
<span<?php echo $permintaanpembelian_delete->tgl_pp->viewAttributes() ?>><?php echo $permintaanpembelian_delete->tgl_pp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
		<td <?php echo $permintaanpembelian_delete->tgl_kebutuhan->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_tgl_kebutuhan" class="permintaanpembelian_tgl_kebutuhan">
<span<?php echo $permintaanpembelian_delete->tgl_kebutuhan->viewAttributes() ?>><?php echo $permintaanpembelian_delete->tgl_kebutuhan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
		<td <?php echo $permintaanpembelian_delete->tgl_persetujuan->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_tgl_persetujuan" class="permintaanpembelian_tgl_persetujuan">
<span<?php echo $permintaanpembelian_delete->tgl_persetujuan->viewAttributes() ?>><?php echo $permintaanpembelian_delete->tgl_persetujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->staf_pengajuan->Visible) { // staf_pengajuan ?>
		<td <?php echo $permintaanpembelian_delete->staf_pengajuan->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_staf_pengajuan" class="permintaanpembelian_staf_pengajuan">
<span<?php echo $permintaanpembelian_delete->staf_pengajuan->viewAttributes() ?>><?php echo $permintaanpembelian_delete->staf_pengajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($permintaanpembelian_delete->staf_validasi->Visible) { // staf_validasi ?>
		<td <?php echo $permintaanpembelian_delete->staf_validasi->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_delete->RowCount ?>_permintaanpembelian_staf_validasi" class="permintaanpembelian_staf_validasi">
<span<?php echo $permintaanpembelian_delete->staf_validasi->viewAttributes() ?>><?php echo $permintaanpembelian_delete->staf_validasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$permintaanpembelian_delete->Recordset->moveNext();
}
$permintaanpembelian_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $permintaanpembelian_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$permintaanpembelian_delete->showPageFooter();
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
$permintaanpembelian_delete->terminate();
?>