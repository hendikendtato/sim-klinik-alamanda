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
$m_penyimpanan_delete = new m_penyimpanan_delete();

// Run the page
$m_penyimpanan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_penyimpanan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_penyimpanandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_penyimpanandelete = currentForm = new ew.Form("fm_penyimpanandelete", "delete");
	loadjs.done("fm_penyimpanandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_penyimpanan_delete->showPageHeader(); ?>
<?php
$m_penyimpanan_delete->showMessage();
?>
<form name="fm_penyimpanandelete" id="fm_penyimpanandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_penyimpanan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_penyimpanan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_penyimpanan_delete->id_penyimpanan->Visible) { // id_penyimpanan ?>
		<th class="<?php echo $m_penyimpanan_delete->id_penyimpanan->headerCellClass() ?>"><span id="elh_m_penyimpanan_id_penyimpanan" class="m_penyimpanan_id_penyimpanan"><?php echo $m_penyimpanan_delete->id_penyimpanan->caption() ?></span></th>
<?php } ?>
<?php if ($m_penyimpanan_delete->nama_barang->Visible) { // nama_barang ?>
		<th class="<?php echo $m_penyimpanan_delete->nama_barang->headerCellClass() ?>"><span id="elh_m_penyimpanan_nama_barang" class="m_penyimpanan_nama_barang"><?php echo $m_penyimpanan_delete->nama_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_penyimpanan_delete->tanggal_->Visible) { // tanggal_ ?>
		<th class="<?php echo $m_penyimpanan_delete->tanggal_->headerCellClass() ?>"><span id="elh_m_penyimpanan_tanggal_" class="m_penyimpanan_tanggal_"><?php echo $m_penyimpanan_delete->tanggal_->caption() ?></span></th>
<?php } ?>
<?php if ($m_penyimpanan_delete->penyimpanan->Visible) { // penyimpanan ?>
		<th class="<?php echo $m_penyimpanan_delete->penyimpanan->headerCellClass() ?>"><span id="elh_m_penyimpanan_penyimpanan" class="m_penyimpanan_penyimpanan"><?php echo $m_penyimpanan_delete->penyimpanan->caption() ?></span></th>
<?php } ?>
<?php if ($m_penyimpanan_delete->nomor_laci->Visible) { // nomor_laci ?>
		<th class="<?php echo $m_penyimpanan_delete->nomor_laci->headerCellClass() ?>"><span id="elh_m_penyimpanan_nomor_laci" class="m_penyimpanan_nomor_laci"><?php echo $m_penyimpanan_delete->nomor_laci->caption() ?></span></th>
<?php } ?>
<?php if ($m_penyimpanan_delete->Stock->Visible) { // Stock ?>
		<th class="<?php echo $m_penyimpanan_delete->Stock->headerCellClass() ?>"><span id="elh_m_penyimpanan_Stock" class="m_penyimpanan_Stock"><?php echo $m_penyimpanan_delete->Stock->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_penyimpanan_delete->RecordCount = 0;
$i = 0;
while (!$m_penyimpanan_delete->Recordset->EOF) {
	$m_penyimpanan_delete->RecordCount++;
	$m_penyimpanan_delete->RowCount++;

	// Set row properties
	$m_penyimpanan->resetAttributes();
	$m_penyimpanan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_penyimpanan_delete->loadRowValues($m_penyimpanan_delete->Recordset);

	// Render row
	$m_penyimpanan_delete->renderRow();
?>
	<tr <?php echo $m_penyimpanan->rowAttributes() ?>>
<?php if ($m_penyimpanan_delete->id_penyimpanan->Visible) { // id_penyimpanan ?>
		<td <?php echo $m_penyimpanan_delete->id_penyimpanan->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_delete->RowCount ?>_m_penyimpanan_id_penyimpanan" class="m_penyimpanan_id_penyimpanan">
<span<?php echo $m_penyimpanan_delete->id_penyimpanan->viewAttributes() ?>><?php echo $m_penyimpanan_delete->id_penyimpanan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_penyimpanan_delete->nama_barang->Visible) { // nama_barang ?>
		<td <?php echo $m_penyimpanan_delete->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_delete->RowCount ?>_m_penyimpanan_nama_barang" class="m_penyimpanan_nama_barang">
<span<?php echo $m_penyimpanan_delete->nama_barang->viewAttributes() ?>><?php echo $m_penyimpanan_delete->nama_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_penyimpanan_delete->tanggal_->Visible) { // tanggal_ ?>
		<td <?php echo $m_penyimpanan_delete->tanggal_->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_delete->RowCount ?>_m_penyimpanan_tanggal_" class="m_penyimpanan_tanggal_">
<span<?php echo $m_penyimpanan_delete->tanggal_->viewAttributes() ?>><?php echo $m_penyimpanan_delete->tanggal_->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_penyimpanan_delete->penyimpanan->Visible) { // penyimpanan ?>
		<td <?php echo $m_penyimpanan_delete->penyimpanan->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_delete->RowCount ?>_m_penyimpanan_penyimpanan" class="m_penyimpanan_penyimpanan">
<span<?php echo $m_penyimpanan_delete->penyimpanan->viewAttributes() ?>><?php echo $m_penyimpanan_delete->penyimpanan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_penyimpanan_delete->nomor_laci->Visible) { // nomor_laci ?>
		<td <?php echo $m_penyimpanan_delete->nomor_laci->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_delete->RowCount ?>_m_penyimpanan_nomor_laci" class="m_penyimpanan_nomor_laci">
<span<?php echo $m_penyimpanan_delete->nomor_laci->viewAttributes() ?>><?php echo $m_penyimpanan_delete->nomor_laci->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_penyimpanan_delete->Stock->Visible) { // Stock ?>
		<td <?php echo $m_penyimpanan_delete->Stock->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_delete->RowCount ?>_m_penyimpanan_Stock" class="m_penyimpanan_Stock">
<span<?php echo $m_penyimpanan_delete->Stock->viewAttributes() ?>><?php echo $m_penyimpanan_delete->Stock->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_penyimpanan_delete->Recordset->moveNext();
}
$m_penyimpanan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_penyimpanan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_penyimpanan_delete->showPageFooter();
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
$m_penyimpanan_delete->terminate();
?>