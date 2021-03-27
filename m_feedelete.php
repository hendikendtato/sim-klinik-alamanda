<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$m_fee_delete = new m_fee_delete();

// Run the page
$m_fee_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_fee_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_feedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_feedelete = currentForm = new ew.Form("fm_feedelete", "delete");
	loadjs.done("fm_feedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_fee_delete->showPageHeader(); ?>
<?php
$m_fee_delete->showMessage();
?>
<form name="fm_feedelete" id="fm_feedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_fee">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_fee_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_fee_delete->id_fee->Visible) { // id_fee ?>
		<th class="<?php echo $m_fee_delete->id_fee->headerCellClass() ?>"><span id="elh_m_fee_id_fee" class="m_fee_id_fee"><?php echo $m_fee_delete->id_fee->caption() ?></span></th>
<?php } ?>
<?php if ($m_fee_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $m_fee_delete->id_barang->headerCellClass() ?>"><span id="elh_m_fee_id_barang" class="m_fee_id_barang"><?php echo $m_fee_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_fee_delete->id_pegawai->Visible) { // id_pegawai ?>
		<th class="<?php echo $m_fee_delete->id_pegawai->headerCellClass() ?>"><span id="elh_m_fee_id_pegawai" class="m_fee_id_pegawai"><?php echo $m_fee_delete->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_fee_delete->prosentase->Visible) { // prosentase ?>
		<th class="<?php echo $m_fee_delete->prosentase->headerCellClass() ?>"><span id="elh_m_fee_prosentase" class="m_fee_prosentase"><?php echo $m_fee_delete->prosentase->caption() ?></span></th>
<?php } ?>
<?php if ($m_fee_delete->id_hargajual->Visible) { // id_hargajual ?>
		<th class="<?php echo $m_fee_delete->id_hargajual->headerCellClass() ?>"><span id="elh_m_fee_id_hargajual" class="m_fee_id_hargajual"><?php echo $m_fee_delete->id_hargajual->caption() ?></span></th>
<?php } ?>
<?php if ($m_fee_delete->id_jenispegawai->Visible) { // id_jenispegawai ?>
		<th class="<?php echo $m_fee_delete->id_jenispegawai->headerCellClass() ?>"><span id="elh_m_fee_id_jenispegawai" class="m_fee_id_jenispegawai"><?php echo $m_fee_delete->id_jenispegawai->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_fee_delete->RecordCount = 0;
$i = 0;
while (!$m_fee_delete->Recordset->EOF) {
	$m_fee_delete->RecordCount++;
	$m_fee_delete->RowCount++;

	// Set row properties
	$m_fee->resetAttributes();
	$m_fee->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_fee_delete->loadRowValues($m_fee_delete->Recordset);

	// Render row
	$m_fee_delete->renderRow();
?>
	<tr <?php echo $m_fee->rowAttributes() ?>>
<?php if ($m_fee_delete->id_fee->Visible) { // id_fee ?>
		<td <?php echo $m_fee_delete->id_fee->cellAttributes() ?>>
<span id="el<?php echo $m_fee_delete->RowCount ?>_m_fee_id_fee" class="m_fee_id_fee">
<span<?php echo $m_fee_delete->id_fee->viewAttributes() ?>><?php echo $m_fee_delete->id_fee->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_fee_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $m_fee_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_fee_delete->RowCount ?>_m_fee_id_barang" class="m_fee_id_barang">
<span<?php echo $m_fee_delete->id_barang->viewAttributes() ?>><?php echo $m_fee_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_fee_delete->id_pegawai->Visible) { // id_pegawai ?>
		<td <?php echo $m_fee_delete->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_fee_delete->RowCount ?>_m_fee_id_pegawai" class="m_fee_id_pegawai">
<span<?php echo $m_fee_delete->id_pegawai->viewAttributes() ?>><?php echo $m_fee_delete->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_fee_delete->prosentase->Visible) { // prosentase ?>
		<td <?php echo $m_fee_delete->prosentase->cellAttributes() ?>>
<span id="el<?php echo $m_fee_delete->RowCount ?>_m_fee_prosentase" class="m_fee_prosentase">
<span<?php echo $m_fee_delete->prosentase->viewAttributes() ?>><?php echo $m_fee_delete->prosentase->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_fee_delete->id_hargajual->Visible) { // id_hargajual ?>
		<td <?php echo $m_fee_delete->id_hargajual->cellAttributes() ?>>
<span id="el<?php echo $m_fee_delete->RowCount ?>_m_fee_id_hargajual" class="m_fee_id_hargajual">
<span<?php echo $m_fee_delete->id_hargajual->viewAttributes() ?>><?php echo $m_fee_delete->id_hargajual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_fee_delete->id_jenispegawai->Visible) { // id_jenispegawai ?>
		<td <?php echo $m_fee_delete->id_jenispegawai->cellAttributes() ?>>
<span id="el<?php echo $m_fee_delete->RowCount ?>_m_fee_id_jenispegawai" class="m_fee_id_jenispegawai">
<span<?php echo $m_fee_delete->id_jenispegawai->viewAttributes() ?>><?php echo $m_fee_delete->id_jenispegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_fee_delete->Recordset->moveNext();
}
$m_fee_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_fee_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_fee_delete->showPageFooter();
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
$m_fee_delete->terminate();
?>