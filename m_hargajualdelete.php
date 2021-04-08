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
$m_hargajual_delete = new m_hargajual_delete();

// Run the page
$m_hargajual_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_hargajualdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_hargajualdelete = currentForm = new ew.Form("fm_hargajualdelete", "delete");
	loadjs.done("fm_hargajualdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_hargajual_delete->showPageHeader(); ?>
<?php
$m_hargajual_delete->showMessage();
?>
<form name="fm_hargajualdelete" id="fm_hargajualdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_hargajual_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_hargajual_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $m_hargajual_delete->id_barang->headerCellClass() ?>"><span id="elh_m_hargajual_id_barang" class="m_hargajual_id_barang"><?php echo $m_hargajual_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->totalhargajual->Visible) { // totalhargajual ?>
		<th class="<?php echo $m_hargajual_delete->totalhargajual->headerCellClass() ?>"><span id="elh_m_hargajual_totalhargajual" class="m_hargajual_totalhargajual"><?php echo $m_hargajual_delete->totalhargajual->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->disc_pr->Visible) { // disc_pr ?>
		<th class="<?php echo $m_hargajual_delete->disc_pr->headerCellClass() ?>"><span id="elh_m_hargajual_disc_pr" class="m_hargajual_disc_pr"><?php echo $m_hargajual_delete->disc_pr->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->disc_rp->Visible) { // disc_rp ?>
		<th class="<?php echo $m_hargajual_delete->disc_rp->headerCellClass() ?>"><span id="elh_m_hargajual_disc_rp" class="m_hargajual_disc_rp"><?php echo $m_hargajual_delete->disc_rp->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_hargajual_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_hargajual_id_klinik" class="m_hargajual_id_klinik"><?php echo $m_hargajual_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->stok->Visible) { // stok ?>
		<th class="<?php echo $m_hargajual_delete->stok->headerCellClass() ?>"><span id="elh_m_hargajual_stok" class="m_hargajual_stok"><?php echo $m_hargajual_delete->stok->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->satuan->Visible) { // satuan ?>
		<th class="<?php echo $m_hargajual_delete->satuan->headerCellClass() ?>"><span id="elh_m_hargajual_satuan" class="m_hargajual_satuan"><?php echo $m_hargajual_delete->satuan->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->minimum_stok->Visible) { // minimum_stok ?>
		<th class="<?php echo $m_hargajual_delete->minimum_stok->headerCellClass() ?>"><span id="elh_m_hargajual_minimum_stok" class="m_hargajual_minimum_stok"><?php echo $m_hargajual_delete->minimum_stok->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->tgl_masuk->Visible) { // tgl_masuk ?>
		<th class="<?php echo $m_hargajual_delete->tgl_masuk->headerCellClass() ?>"><span id="elh_m_hargajual_tgl_masuk" class="m_hargajual_tgl_masuk"><?php echo $m_hargajual_delete->tgl_masuk->caption() ?></span></th>
<?php } ?>
<?php if ($m_hargajual_delete->tgl_exp->Visible) { // tgl_exp ?>
		<th class="<?php echo $m_hargajual_delete->tgl_exp->headerCellClass() ?>"><span id="elh_m_hargajual_tgl_exp" class="m_hargajual_tgl_exp"><?php echo $m_hargajual_delete->tgl_exp->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_hargajual_delete->RecordCount = 0;
$i = 0;
while (!$m_hargajual_delete->Recordset->EOF) {
	$m_hargajual_delete->RecordCount++;
	$m_hargajual_delete->RowCount++;

	// Set row properties
	$m_hargajual->resetAttributes();
	$m_hargajual->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_hargajual_delete->loadRowValues($m_hargajual_delete->Recordset);

	// Render row
	$m_hargajual_delete->renderRow();
?>
	<tr <?php echo $m_hargajual->rowAttributes() ?>>
<?php if ($m_hargajual_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $m_hargajual_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_id_barang" class="m_hargajual_id_barang">
<span<?php echo $m_hargajual_delete->id_barang->viewAttributes() ?>><?php echo $m_hargajual_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->totalhargajual->Visible) { // totalhargajual ?>
		<td <?php echo $m_hargajual_delete->totalhargajual->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_totalhargajual" class="m_hargajual_totalhargajual">
<span<?php echo $m_hargajual_delete->totalhargajual->viewAttributes() ?>><?php echo $m_hargajual_delete->totalhargajual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->disc_pr->Visible) { // disc_pr ?>
		<td <?php echo $m_hargajual_delete->disc_pr->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_disc_pr" class="m_hargajual_disc_pr">
<span<?php echo $m_hargajual_delete->disc_pr->viewAttributes() ?>><?php echo $m_hargajual_delete->disc_pr->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->disc_rp->Visible) { // disc_rp ?>
		<td <?php echo $m_hargajual_delete->disc_rp->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_disc_rp" class="m_hargajual_disc_rp">
<span<?php echo $m_hargajual_delete->disc_rp->viewAttributes() ?>><?php echo $m_hargajual_delete->disc_rp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_hargajual_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_id_klinik" class="m_hargajual_id_klinik">
<span<?php echo $m_hargajual_delete->id_klinik->viewAttributes() ?>><?php echo $m_hargajual_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->stok->Visible) { // stok ?>
		<td <?php echo $m_hargajual_delete->stok->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_stok" class="m_hargajual_stok">
<span<?php echo $m_hargajual_delete->stok->viewAttributes() ?>><?php echo $m_hargajual_delete->stok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->satuan->Visible) { // satuan ?>
		<td <?php echo $m_hargajual_delete->satuan->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_satuan" class="m_hargajual_satuan">
<span<?php echo $m_hargajual_delete->satuan->viewAttributes() ?>><?php echo $m_hargajual_delete->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->minimum_stok->Visible) { // minimum_stok ?>
		<td <?php echo $m_hargajual_delete->minimum_stok->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_minimum_stok" class="m_hargajual_minimum_stok">
<span<?php echo $m_hargajual_delete->minimum_stok->viewAttributes() ?>><?php echo $m_hargajual_delete->minimum_stok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->tgl_masuk->Visible) { // tgl_masuk ?>
		<td <?php echo $m_hargajual_delete->tgl_masuk->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_tgl_masuk" class="m_hargajual_tgl_masuk">
<span<?php echo $m_hargajual_delete->tgl_masuk->viewAttributes() ?>><?php echo $m_hargajual_delete->tgl_masuk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_hargajual_delete->tgl_exp->Visible) { // tgl_exp ?>
		<td <?php echo $m_hargajual_delete->tgl_exp->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_delete->RowCount ?>_m_hargajual_tgl_exp" class="m_hargajual_tgl_exp">
<span<?php echo $m_hargajual_delete->tgl_exp->viewAttributes() ?>><?php echo $m_hargajual_delete->tgl_exp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_hargajual_delete->Recordset->moveNext();
}
$m_hargajual_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_hargajual_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_hargajual_delete->showPageFooter();
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
$m_hargajual_delete->terminate();
?>