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
$m_target_omset_personal_delete = new m_target_omset_personal_delete();

// Run the page
$m_target_omset_personal_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_omset_personal_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_target_omset_personaldelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_target_omset_personaldelete = currentForm = new ew.Form("fm_target_omset_personaldelete", "delete");
	loadjs.done("fm_target_omset_personaldelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_target_omset_personal_delete->showPageHeader(); ?>
<?php
$m_target_omset_personal_delete->showMessage();
?>
<form name="fm_target_omset_personaldelete" id="fm_target_omset_personaldelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_omset_personal">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_target_omset_personal_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_target_omset_personal_delete->id_cabang->Visible) { // id_cabang ?>
		<th class="<?php echo $m_target_omset_personal_delete->id_cabang->headerCellClass() ?>"><span id="elh_m_target_omset_personal_id_cabang" class="m_target_omset_personal_id_cabang"><?php echo $m_target_omset_personal_delete->id_cabang->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_omset_personal_delete->id_jabatan->Visible) { // id_jabatan ?>
		<th class="<?php echo $m_target_omset_personal_delete->id_jabatan->headerCellClass() ?>"><span id="elh_m_target_omset_personal_id_jabatan" class="m_target_omset_personal_id_jabatan"><?php echo $m_target_omset_personal_delete->id_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_omset_personal_delete->tgl_awal->Visible) { // tgl_awal ?>
		<th class="<?php echo $m_target_omset_personal_delete->tgl_awal->headerCellClass() ?>"><span id="elh_m_target_omset_personal_tgl_awal" class="m_target_omset_personal_tgl_awal"><?php echo $m_target_omset_personal_delete->tgl_awal->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_omset_personal_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<th class="<?php echo $m_target_omset_personal_delete->tgl_akhir->headerCellClass() ?>"><span id="elh_m_target_omset_personal_tgl_akhir" class="m_target_omset_personal_tgl_akhir"><?php echo $m_target_omset_personal_delete->tgl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_omset_personal_delete->target->Visible) { // target ?>
		<th class="<?php echo $m_target_omset_personal_delete->target->headerCellClass() ?>"><span id="elh_m_target_omset_personal_target" class="m_target_omset_personal_target"><?php echo $m_target_omset_personal_delete->target->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_target_omset_personal_delete->RecordCount = 0;
$i = 0;
while (!$m_target_omset_personal_delete->Recordset->EOF) {
	$m_target_omset_personal_delete->RecordCount++;
	$m_target_omset_personal_delete->RowCount++;

	// Set row properties
	$m_target_omset_personal->resetAttributes();
	$m_target_omset_personal->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_target_omset_personal_delete->loadRowValues($m_target_omset_personal_delete->Recordset);

	// Render row
	$m_target_omset_personal_delete->renderRow();
?>
	<tr <?php echo $m_target_omset_personal->rowAttributes() ?>>
<?php if ($m_target_omset_personal_delete->id_cabang->Visible) { // id_cabang ?>
		<td <?php echo $m_target_omset_personal_delete->id_cabang->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_personal_delete->RowCount ?>_m_target_omset_personal_id_cabang" class="m_target_omset_personal_id_cabang">
<span<?php echo $m_target_omset_personal_delete->id_cabang->viewAttributes() ?>><?php echo $m_target_omset_personal_delete->id_cabang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_omset_personal_delete->id_jabatan->Visible) { // id_jabatan ?>
		<td <?php echo $m_target_omset_personal_delete->id_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_personal_delete->RowCount ?>_m_target_omset_personal_id_jabatan" class="m_target_omset_personal_id_jabatan">
<span<?php echo $m_target_omset_personal_delete->id_jabatan->viewAttributes() ?>><?php echo $m_target_omset_personal_delete->id_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_omset_personal_delete->tgl_awal->Visible) { // tgl_awal ?>
		<td <?php echo $m_target_omset_personal_delete->tgl_awal->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_personal_delete->RowCount ?>_m_target_omset_personal_tgl_awal" class="m_target_omset_personal_tgl_awal">
<span<?php echo $m_target_omset_personal_delete->tgl_awal->viewAttributes() ?>><?php echo $m_target_omset_personal_delete->tgl_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_omset_personal_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<td <?php echo $m_target_omset_personal_delete->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_personal_delete->RowCount ?>_m_target_omset_personal_tgl_akhir" class="m_target_omset_personal_tgl_akhir">
<span<?php echo $m_target_omset_personal_delete->tgl_akhir->viewAttributes() ?>><?php echo $m_target_omset_personal_delete->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_omset_personal_delete->target->Visible) { // target ?>
		<td <?php echo $m_target_omset_personal_delete->target->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_personal_delete->RowCount ?>_m_target_omset_personal_target" class="m_target_omset_personal_target">
<span<?php echo $m_target_omset_personal_delete->target->viewAttributes() ?>><?php echo $m_target_omset_personal_delete->target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_target_omset_personal_delete->Recordset->moveNext();
}
$m_target_omset_personal_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_target_omset_personal_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_target_omset_personal_delete->showPageFooter();
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
$m_target_omset_personal_delete->terminate();
?>