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
$terimagudang_delete = new terimagudang_delete();

// Run the page
$terimagudang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimagudang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterimagudangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fterimagudangdelete = currentForm = new ew.Form("fterimagudangdelete", "delete");
	loadjs.done("fterimagudangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terimagudang_delete->showPageHeader(); ?>
<?php
$terimagudang_delete->showMessage();
?>
<form name="fterimagudangdelete" id="fterimagudangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimagudang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($terimagudang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($terimagudang_delete->kode_terimagudang->Visible) { // kode_terimagudang ?>
		<th class="<?php echo $terimagudang_delete->kode_terimagudang->headerCellClass() ?>"><span id="elh_terimagudang_kode_terimagudang" class="terimagudang_kode_terimagudang"><?php echo $terimagudang_delete->kode_terimagudang->caption() ?></span></th>
<?php } ?>
<?php if ($terimagudang_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $terimagudang_delete->id_klinik->headerCellClass() ?>"><span id="elh_terimagudang_id_klinik" class="terimagudang_id_klinik"><?php echo $terimagudang_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($terimagudang_delete->diterima->Visible) { // diterima ?>
		<th class="<?php echo $terimagudang_delete->diterima->headerCellClass() ?>"><span id="elh_terimagudang_diterima" class="terimagudang_diterima"><?php echo $terimagudang_delete->diterima->caption() ?></span></th>
<?php } ?>
<?php if ($terimagudang_delete->tanggal_terima->Visible) { // tanggal_terima ?>
		<th class="<?php echo $terimagudang_delete->tanggal_terima->headerCellClass() ?>"><span id="elh_terimagudang_tanggal_terima" class="terimagudang_tanggal_terima"><?php echo $terimagudang_delete->tanggal_terima->caption() ?></span></th>
<?php } ?>
<?php if ($terimagudang_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $terimagudang_delete->keterangan->headerCellClass() ?>"><span id="elh_terimagudang_keterangan" class="terimagudang_keterangan"><?php echo $terimagudang_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$terimagudang_delete->RecordCount = 0;
$i = 0;
while (!$terimagudang_delete->Recordset->EOF) {
	$terimagudang_delete->RecordCount++;
	$terimagudang_delete->RowCount++;

	// Set row properties
	$terimagudang->resetAttributes();
	$terimagudang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$terimagudang_delete->loadRowValues($terimagudang_delete->Recordset);

	// Render row
	$terimagudang_delete->renderRow();
?>
	<tr <?php echo $terimagudang->rowAttributes() ?>>
<?php if ($terimagudang_delete->kode_terimagudang->Visible) { // kode_terimagudang ?>
		<td <?php echo $terimagudang_delete->kode_terimagudang->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_delete->RowCount ?>_terimagudang_kode_terimagudang" class="terimagudang_kode_terimagudang">
<span<?php echo $terimagudang_delete->kode_terimagudang->viewAttributes() ?>><?php echo $terimagudang_delete->kode_terimagudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimagudang_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $terimagudang_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_delete->RowCount ?>_terimagudang_id_klinik" class="terimagudang_id_klinik">
<span<?php echo $terimagudang_delete->id_klinik->viewAttributes() ?>><?php echo $terimagudang_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimagudang_delete->diterima->Visible) { // diterima ?>
		<td <?php echo $terimagudang_delete->diterima->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_delete->RowCount ?>_terimagudang_diterima" class="terimagudang_diterima">
<span<?php echo $terimagudang_delete->diterima->viewAttributes() ?>><?php echo $terimagudang_delete->diterima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimagudang_delete->tanggal_terima->Visible) { // tanggal_terima ?>
		<td <?php echo $terimagudang_delete->tanggal_terima->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_delete->RowCount ?>_terimagudang_tanggal_terima" class="terimagudang_tanggal_terima">
<span<?php echo $terimagudang_delete->tanggal_terima->viewAttributes() ?>><?php echo $terimagudang_delete->tanggal_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($terimagudang_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $terimagudang_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_delete->RowCount ?>_terimagudang_keterangan" class="terimagudang_keterangan">
<span<?php echo $terimagudang_delete->keterangan->viewAttributes() ?>><?php echo $terimagudang_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$terimagudang_delete->Recordset->moveNext();
}
$terimagudang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terimagudang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$terimagudang_delete->showPageFooter();
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
$terimagudang_delete->terminate();
?>