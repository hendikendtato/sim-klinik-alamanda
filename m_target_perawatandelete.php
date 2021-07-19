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
$m_target_perawatan_delete = new m_target_perawatan_delete();

// Run the page
$m_target_perawatan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_perawatan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_target_perawatandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_target_perawatandelete = currentForm = new ew.Form("fm_target_perawatandelete", "delete");
	loadjs.done("fm_target_perawatandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_target_perawatan_delete->showPageHeader(); ?>
<?php
$m_target_perawatan_delete->showMessage();
?>
<form name="fm_target_perawatandelete" id="fm_target_perawatandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_perawatan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_target_perawatan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_target_perawatan_delete->id_cabang->Visible) { // id_cabang ?>
		<th class="<?php echo $m_target_perawatan_delete->id_cabang->headerCellClass() ?>"><span id="elh_m_target_perawatan_id_cabang" class="m_target_perawatan_id_cabang"><?php echo $m_target_perawatan_delete->id_cabang->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_perawatan_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $m_target_perawatan_delete->jenis->headerCellClass() ?>"><span id="elh_m_target_perawatan_jenis" class="m_target_perawatan_jenis"><?php echo $m_target_perawatan_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_perawatan_delete->tgl_awal->Visible) { // tgl_awal ?>
		<th class="<?php echo $m_target_perawatan_delete->tgl_awal->headerCellClass() ?>"><span id="elh_m_target_perawatan_tgl_awal" class="m_target_perawatan_tgl_awal"><?php echo $m_target_perawatan_delete->tgl_awal->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_perawatan_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<th class="<?php echo $m_target_perawatan_delete->tgl_akhir->headerCellClass() ?>"><span id="elh_m_target_perawatan_tgl_akhir" class="m_target_perawatan_tgl_akhir"><?php echo $m_target_perawatan_delete->tgl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($m_target_perawatan_delete->target->Visible) { // target ?>
		<th class="<?php echo $m_target_perawatan_delete->target->headerCellClass() ?>"><span id="elh_m_target_perawatan_target" class="m_target_perawatan_target"><?php echo $m_target_perawatan_delete->target->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_target_perawatan_delete->RecordCount = 0;
$i = 0;
while (!$m_target_perawatan_delete->Recordset->EOF) {
	$m_target_perawatan_delete->RecordCount++;
	$m_target_perawatan_delete->RowCount++;

	// Set row properties
	$m_target_perawatan->resetAttributes();
	$m_target_perawatan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_target_perawatan_delete->loadRowValues($m_target_perawatan_delete->Recordset);

	// Render row
	$m_target_perawatan_delete->renderRow();
?>
	<tr <?php echo $m_target_perawatan->rowAttributes() ?>>
<?php if ($m_target_perawatan_delete->id_cabang->Visible) { // id_cabang ?>
		<td <?php echo $m_target_perawatan_delete->id_cabang->cellAttributes() ?>>
<span id="el<?php echo $m_target_perawatan_delete->RowCount ?>_m_target_perawatan_id_cabang" class="m_target_perawatan_id_cabang">
<span<?php echo $m_target_perawatan_delete->id_cabang->viewAttributes() ?>><?php echo $m_target_perawatan_delete->id_cabang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_perawatan_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $m_target_perawatan_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $m_target_perawatan_delete->RowCount ?>_m_target_perawatan_jenis" class="m_target_perawatan_jenis">
<span<?php echo $m_target_perawatan_delete->jenis->viewAttributes() ?>><?php echo $m_target_perawatan_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_perawatan_delete->tgl_awal->Visible) { // tgl_awal ?>
		<td <?php echo $m_target_perawatan_delete->tgl_awal->cellAttributes() ?>>
<span id="el<?php echo $m_target_perawatan_delete->RowCount ?>_m_target_perawatan_tgl_awal" class="m_target_perawatan_tgl_awal">
<span<?php echo $m_target_perawatan_delete->tgl_awal->viewAttributes() ?>><?php echo $m_target_perawatan_delete->tgl_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_perawatan_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<td <?php echo $m_target_perawatan_delete->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_target_perawatan_delete->RowCount ?>_m_target_perawatan_tgl_akhir" class="m_target_perawatan_tgl_akhir">
<span<?php echo $m_target_perawatan_delete->tgl_akhir->viewAttributes() ?>><?php echo $m_target_perawatan_delete->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_target_perawatan_delete->target->Visible) { // target ?>
		<td <?php echo $m_target_perawatan_delete->target->cellAttributes() ?>>
<span id="el<?php echo $m_target_perawatan_delete->RowCount ?>_m_target_perawatan_target" class="m_target_perawatan_target">
<span<?php echo $m_target_perawatan_delete->target->viewAttributes() ?>><?php echo $m_target_perawatan_delete->target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_target_perawatan_delete->Recordset->moveNext();
}
$m_target_perawatan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_target_perawatan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_target_perawatan_delete->showPageFooter();
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
$m_target_perawatan_delete->terminate();
?>