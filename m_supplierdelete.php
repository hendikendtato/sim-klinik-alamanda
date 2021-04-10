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
$m_supplier_delete = new m_supplier_delete();

// Run the page
$m_supplier_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_supplier_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_supplierdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_supplierdelete = currentForm = new ew.Form("fm_supplierdelete", "delete");
	loadjs.done("fm_supplierdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_supplier_delete->showPageHeader(); ?>
<?php
$m_supplier_delete->showMessage();
?>
<form name="fm_supplierdelete" id="fm_supplierdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_supplier">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_supplier_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_supplier_delete->kode_supplier->Visible) { // kode_supplier ?>
		<th class="<?php echo $m_supplier_delete->kode_supplier->headerCellClass() ?>"><span id="elh_m_supplier_kode_supplier" class="m_supplier_kode_supplier"><?php echo $m_supplier_delete->kode_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($m_supplier_delete->nama_supplier->Visible) { // nama_supplier ?>
		<th class="<?php echo $m_supplier_delete->nama_supplier->headerCellClass() ?>"><span id="elh_m_supplier_nama_supplier" class="m_supplier_nama_supplier"><?php echo $m_supplier_delete->nama_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($m_supplier_delete->pic_supplier->Visible) { // pic_supplier ?>
		<th class="<?php echo $m_supplier_delete->pic_supplier->headerCellClass() ?>"><span id="elh_m_supplier_pic_supplier" class="m_supplier_pic_supplier"><?php echo $m_supplier_delete->pic_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($m_supplier_delete->alamat_supplier->Visible) { // alamat_supplier ?>
		<th class="<?php echo $m_supplier_delete->alamat_supplier->headerCellClass() ?>"><span id="elh_m_supplier_alamat_supplier" class="m_supplier_alamat_supplier"><?php echo $m_supplier_delete->alamat_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($m_supplier_delete->telpon_supplier->Visible) { // telpon_supplier ?>
		<th class="<?php echo $m_supplier_delete->telpon_supplier->headerCellClass() ?>"><span id="elh_m_supplier_telpon_supplier" class="m_supplier_telpon_supplier"><?php echo $m_supplier_delete->telpon_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($m_supplier_delete->hp_supplier->Visible) { // hp_supplier ?>
		<th class="<?php echo $m_supplier_delete->hp_supplier->headerCellClass() ?>"><span id="elh_m_supplier_hp_supplier" class="m_supplier_hp_supplier"><?php echo $m_supplier_delete->hp_supplier->caption() ?></span></th>
<?php } ?>
<?php if ($m_supplier_delete->email_supplier->Visible) { // email_supplier ?>
		<th class="<?php echo $m_supplier_delete->email_supplier->headerCellClass() ?>"><span id="elh_m_supplier_email_supplier" class="m_supplier_email_supplier"><?php echo $m_supplier_delete->email_supplier->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_supplier_delete->RecordCount = 0;
$i = 0;
while (!$m_supplier_delete->Recordset->EOF) {
	$m_supplier_delete->RecordCount++;
	$m_supplier_delete->RowCount++;

	// Set row properties
	$m_supplier->resetAttributes();
	$m_supplier->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_supplier_delete->loadRowValues($m_supplier_delete->Recordset);

	// Render row
	$m_supplier_delete->renderRow();
?>
	<tr <?php echo $m_supplier->rowAttributes() ?>>
<?php if ($m_supplier_delete->kode_supplier->Visible) { // kode_supplier ?>
		<td <?php echo $m_supplier_delete->kode_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_kode_supplier" class="m_supplier_kode_supplier">
<span<?php echo $m_supplier_delete->kode_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->kode_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_supplier_delete->nama_supplier->Visible) { // nama_supplier ?>
		<td <?php echo $m_supplier_delete->nama_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_nama_supplier" class="m_supplier_nama_supplier">
<span<?php echo $m_supplier_delete->nama_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->nama_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_supplier_delete->pic_supplier->Visible) { // pic_supplier ?>
		<td <?php echo $m_supplier_delete->pic_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_pic_supplier" class="m_supplier_pic_supplier">
<span<?php echo $m_supplier_delete->pic_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->pic_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_supplier_delete->alamat_supplier->Visible) { // alamat_supplier ?>
		<td <?php echo $m_supplier_delete->alamat_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_alamat_supplier" class="m_supplier_alamat_supplier">
<span<?php echo $m_supplier_delete->alamat_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->alamat_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_supplier_delete->telpon_supplier->Visible) { // telpon_supplier ?>
		<td <?php echo $m_supplier_delete->telpon_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_telpon_supplier" class="m_supplier_telpon_supplier">
<span<?php echo $m_supplier_delete->telpon_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->telpon_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_supplier_delete->hp_supplier->Visible) { // hp_supplier ?>
		<td <?php echo $m_supplier_delete->hp_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_hp_supplier" class="m_supplier_hp_supplier">
<span<?php echo $m_supplier_delete->hp_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->hp_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_supplier_delete->email_supplier->Visible) { // email_supplier ?>
		<td <?php echo $m_supplier_delete->email_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_delete->RowCount ?>_m_supplier_email_supplier" class="m_supplier_email_supplier">
<span<?php echo $m_supplier_delete->email_supplier->viewAttributes() ?>><?php echo $m_supplier_delete->email_supplier->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_supplier_delete->Recordset->moveNext();
}
$m_supplier_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_supplier_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_supplier_delete->showPageFooter();
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
$m_supplier_delete->terminate();
?>