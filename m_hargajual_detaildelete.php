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
$m_hargajual_detail_delete = new m_hargajual_detail_delete();

// Run the page
$m_hargajual_detail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_detail_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_hargajual_detaildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_hargajual_detaildelete = currentForm = new ew.Form("fm_hargajual_detaildelete", "delete");
	loadjs.done("fm_hargajual_detaildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_hargajual_detail_delete->showPageHeader(); ?>
<?php
$m_hargajual_detail_delete->showMessage();
?>
<form name="fm_hargajual_detaildelete" id="fm_hargajual_detaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual_detail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_hargajual_detail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_hargajual_detail_delete->id_hargajualdetail->Visible) { // id_hargajualdetail ?>
		<th class="<?php echo $m_hargajual_detail_delete->id_hargajualdetail->headerCellClass() ?>"><span id="elh_m_hargajual_detail_id_hargajualdetail" class="m_hargajual_detail_id_hargajualdetail"><?php echo $m_hargajual_detail_delete->id_hargajualdetail->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_detail_delete->id_hargajual->Visible) { // id_hargajual ?>
		<th class="<?php echo $m_hargajual_detail_delete->id_hargajual->headerCellClass() ?>"><span id="elh_m_hargajual_detail_id_hargajual" class="m_hargajual_detail_id_hargajual"><?php echo $m_hargajual_detail_delete->id_hargajual->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_detail_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $m_hargajual_detail_delete->id_barang->headerCellClass() ?>"><span id="elh_m_hargajual_detail_id_barang" class="m_hargajual_detail_id_barang"><?php echo $m_hargajual_detail_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_detail_delete->hargajual->Visible) { // hargajual ?>
		<th class="<?php echo $m_hargajual_detail_delete->hargajual->headerCellClass() ?>"><span id="elh_m_hargajual_detail_hargajual" class="m_hargajual_detail_hargajual"><?php echo $m_hargajual_detail_delete->hargajual->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_hargajual_detail_delete->RecordCount = 0;
$i = 0;
while (!$m_hargajual_detail_delete->Recordset->EOF) {
	$m_hargajual_detail_delete->RecordCount++;
	$m_hargajual_detail_delete->RowCount++;

	// Set row properties
	$m_hargajual_detail->resetAttributes();
	$m_hargajual_detail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_hargajual_detail_delete->loadRowValues($m_hargajual_detail_delete->Recordset);

	// Render row
	$m_hargajual_detail_delete->renderRow();
?>
	<tr <?php echo $m_hargajual_detail->rowAttributes() ?>>
<?php if ($m_hargajual_detail_delete->id_hargajualdetail->Visible) { // id_hargajualdetail ?>
		<td <?php echo $m_hargajual_detail_delete->id_hargajualdetail->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_delete->RowCount ?>_m_hargajual_detail_id_hargajualdetail" class="m_hargajual_detail_id_hargajualdetail">
<span<?php echo $m_hargajual_detail_delete->id_hargajualdetail->viewAttributes() ?>><?php echo $m_hargajual_detail_delete->id_hargajualdetail->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_detail_delete->id_hargajual->Visible) { // id_hargajual ?>
		<td <?php echo $m_hargajual_detail_delete->id_hargajual->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_delete->RowCount ?>_m_hargajual_detail_id_hargajual" class="m_hargajual_detail_id_hargajual">
<span<?php echo $m_hargajual_detail_delete->id_hargajual->viewAttributes() ?>><?php echo $m_hargajual_detail_delete->id_hargajual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_detail_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $m_hargajual_detail_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_delete->RowCount ?>_m_hargajual_detail_id_barang" class="m_hargajual_detail_id_barang">
<span<?php echo $m_hargajual_detail_delete->id_barang->viewAttributes() ?>><?php echo $m_hargajual_detail_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_detail_delete->hargajual->Visible) { // hargajual ?>
		<td <?php echo $m_hargajual_detail_delete->hargajual->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_delete->RowCount ?>_m_hargajual_detail_hargajual" class="m_hargajual_detail_hargajual">
<span<?php echo $m_hargajual_detail_delete->hargajual->viewAttributes() ?>><?php echo $m_hargajual_detail_delete->hargajual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_hargajual_detail_delete->Recordset->moveNext();
}
$m_hargajual_detail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_hargajual_detail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_hargajual_detail_delete->showPageFooter();
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
$m_hargajual_detail_delete->terminate();
?>