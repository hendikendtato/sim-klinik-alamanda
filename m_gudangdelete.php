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
$m_gudang_delete = new m_gudang_delete();

// Run the page
$m_gudang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_gudang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_gudangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_gudangdelete = currentForm = new ew.Form("fm_gudangdelete", "delete");
	loadjs.done("fm_gudangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_gudang_delete->showPageHeader(); ?>
<?php
$m_gudang_delete->showMessage();
?>
<form name="fm_gudangdelete" id="fm_gudangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_gudang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_gudang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_gudang_delete->id_gudang->Visible) { // id_gudang ?>
		<th class="<?php echo $m_gudang_delete->id_gudang->headerCellClass() ?>"><span id="elh_m_gudang_id_gudang" class="m_gudang_id_gudang"><?php echo $m_gudang_delete->id_gudang->caption() ?></span></th>
<?php } ?>
<?php if ($m_gudang_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_gudang_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_gudang_id_klinik" class="m_gudang_id_klinik"><?php echo $m_gudang_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_gudang_delete->kode_gudang->Visible) { // kode_gudang ?>
		<th class="<?php echo $m_gudang_delete->kode_gudang->headerCellClass() ?>"><span id="elh_m_gudang_kode_gudang" class="m_gudang_kode_gudang"><?php echo $m_gudang_delete->kode_gudang->caption() ?></span></th>
<?php } ?>
<?php if ($m_gudang_delete->nama_gudang->Visible) { // nama_gudang ?>
		<th class="<?php echo $m_gudang_delete->nama_gudang->headerCellClass() ?>"><span id="elh_m_gudang_nama_gudang" class="m_gudang_nama_gudang"><?php echo $m_gudang_delete->nama_gudang->caption() ?></span></th>
<?php } ?>
<?php if ($m_gudang_delete->lokasi_gudang->Visible) { // lokasi_gudang ?>
		<th class="<?php echo $m_gudang_delete->lokasi_gudang->headerCellClass() ?>"><span id="elh_m_gudang_lokasi_gudang" class="m_gudang_lokasi_gudang"><?php echo $m_gudang_delete->lokasi_gudang->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_gudang_delete->RecordCount = 0;
$i = 0;
while (!$m_gudang_delete->Recordset->EOF) {
	$m_gudang_delete->RecordCount++;
	$m_gudang_delete->RowCount++;

	// Set row properties
	$m_gudang->resetAttributes();
	$m_gudang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_gudang_delete->loadRowValues($m_gudang_delete->Recordset);

	// Render row
	$m_gudang_delete->renderRow();
?>
	<tr <?php echo $m_gudang->rowAttributes() ?>>
<?php if ($m_gudang_delete->id_gudang->Visible) { // id_gudang ?>
		<td <?php echo $m_gudang_delete->id_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_delete->RowCount ?>_m_gudang_id_gudang" class="m_gudang_id_gudang">
<span<?php echo $m_gudang_delete->id_gudang->viewAttributes() ?>><?php echo $m_gudang_delete->id_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_gudang_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_gudang_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_delete->RowCount ?>_m_gudang_id_klinik" class="m_gudang_id_klinik">
<span<?php echo $m_gudang_delete->id_klinik->viewAttributes() ?>><?php echo $m_gudang_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_gudang_delete->kode_gudang->Visible) { // kode_gudang ?>
		<td <?php echo $m_gudang_delete->kode_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_delete->RowCount ?>_m_gudang_kode_gudang" class="m_gudang_kode_gudang">
<span<?php echo $m_gudang_delete->kode_gudang->viewAttributes() ?>><?php echo $m_gudang_delete->kode_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_gudang_delete->nama_gudang->Visible) { // nama_gudang ?>
		<td <?php echo $m_gudang_delete->nama_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_delete->RowCount ?>_m_gudang_nama_gudang" class="m_gudang_nama_gudang">
<span<?php echo $m_gudang_delete->nama_gudang->viewAttributes() ?>><?php echo $m_gudang_delete->nama_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_gudang_delete->lokasi_gudang->Visible) { // lokasi_gudang ?>
		<td <?php echo $m_gudang_delete->lokasi_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_delete->RowCount ?>_m_gudang_lokasi_gudang" class="m_gudang_lokasi_gudang">
<span<?php echo $m_gudang_delete->lokasi_gudang->viewAttributes() ?>><?php echo $m_gudang_delete->lokasi_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_gudang_delete->Recordset->moveNext();
}
$m_gudang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_gudang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_gudang_delete->showPageFooter();
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
$m_gudang_delete->terminate();
?>