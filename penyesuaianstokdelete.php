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
$penyesuaianstok_delete = new penyesuaianstok_delete();

// Run the page
$penyesuaianstok_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaianstok_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaianstokdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpenyesuaianstokdelete = currentForm = new ew.Form("fpenyesuaianstokdelete", "delete");
	loadjs.done("fpenyesuaianstokdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penyesuaianstok_delete->showPageHeader(); ?>
<?php
$penyesuaianstok_delete->showMessage();
?>
<form name="fpenyesuaianstokdelete" id="fpenyesuaianstokdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaianstok">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($penyesuaianstok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($penyesuaianstok_delete->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
		<th class="<?php echo $penyesuaianstok_delete->kode_penyesuaian->headerCellClass() ?>"><span id="elh_penyesuaianstok_kode_penyesuaian" class="penyesuaianstok_kode_penyesuaian"><?php echo $penyesuaianstok_delete->kode_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($penyesuaianstok_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $penyesuaianstok_delete->tanggal->headerCellClass() ?>"><span id="elh_penyesuaianstok_tanggal" class="penyesuaianstok_tanggal"><?php echo $penyesuaianstok_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($penyesuaianstok_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $penyesuaianstok_delete->id_klinik->headerCellClass() ?>"><span id="elh_penyesuaianstok_id_klinik" class="penyesuaianstok_id_klinik"><?php echo $penyesuaianstok_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($penyesuaianstok_delete->lampiran->Visible) { // lampiran ?>
		<th class="<?php echo $penyesuaianstok_delete->lampiran->headerCellClass() ?>"><span id="elh_penyesuaianstok_lampiran" class="penyesuaianstok_lampiran"><?php echo $penyesuaianstok_delete->lampiran->caption() ?></span></th>
<?php } ?>
<?php if ($penyesuaianstok_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $penyesuaianstok_delete->keterangan->headerCellClass() ?>"><span id="elh_penyesuaianstok_keterangan" class="penyesuaianstok_keterangan"><?php echo $penyesuaianstok_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$penyesuaianstok_delete->RecordCount = 0;
$i = 0;
while (!$penyesuaianstok_delete->Recordset->EOF) {
	$penyesuaianstok_delete->RecordCount++;
	$penyesuaianstok_delete->RowCount++;

	// Set row properties
	$penyesuaianstok->resetAttributes();
	$penyesuaianstok->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$penyesuaianstok_delete->loadRowValues($penyesuaianstok_delete->Recordset);

	// Render row
	$penyesuaianstok_delete->renderRow();
?>
	<tr <?php echo $penyesuaianstok->rowAttributes() ?>>
<?php if ($penyesuaianstok_delete->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
		<td <?php echo $penyesuaianstok_delete->kode_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_delete->RowCount ?>_penyesuaianstok_kode_penyesuaian" class="penyesuaianstok_kode_penyesuaian">
<span<?php echo $penyesuaianstok_delete->kode_penyesuaian->viewAttributes() ?>><?php echo $penyesuaianstok_delete->kode_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penyesuaianstok_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $penyesuaianstok_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_delete->RowCount ?>_penyesuaianstok_tanggal" class="penyesuaianstok_tanggal">
<span<?php echo $penyesuaianstok_delete->tanggal->viewAttributes() ?>><?php echo $penyesuaianstok_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penyesuaianstok_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $penyesuaianstok_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_delete->RowCount ?>_penyesuaianstok_id_klinik" class="penyesuaianstok_id_klinik">
<span<?php echo $penyesuaianstok_delete->id_klinik->viewAttributes() ?>><?php echo $penyesuaianstok_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penyesuaianstok_delete->lampiran->Visible) { // lampiran ?>
		<td <?php echo $penyesuaianstok_delete->lampiran->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_delete->RowCount ?>_penyesuaianstok_lampiran" class="penyesuaianstok_lampiran">
<span<?php echo $penyesuaianstok_delete->lampiran->viewAttributes() ?>><?php echo GetFileViewTag($penyesuaianstok_delete->lampiran, $penyesuaianstok_delete->lampiran->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($penyesuaianstok_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $penyesuaianstok_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_delete->RowCount ?>_penyesuaianstok_keterangan" class="penyesuaianstok_keterangan">
<span<?php echo $penyesuaianstok_delete->keterangan->viewAttributes() ?>><?php echo $penyesuaianstok_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$penyesuaianstok_delete->Recordset->moveNext();
}
$penyesuaianstok_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penyesuaianstok_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$penyesuaianstok_delete->showPageFooter();
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
$penyesuaianstok_delete->terminate();
?>