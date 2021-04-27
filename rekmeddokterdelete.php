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
$rekmeddokter_delete = new rekmeddokter_delete();

// Run the page
$rekmeddokter_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekmeddokter_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frekmeddokterdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	frekmeddokterdelete = currentForm = new ew.Form("frekmeddokterdelete", "delete");
	loadjs.done("frekmeddokterdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rekmeddokter_delete->showPageHeader(); ?>
<?php
$rekmeddokter_delete->showMessage();
?>
<form name="frekmeddokterdelete" id="frekmeddokterdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekmeddokter">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($rekmeddokter_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($rekmeddokter_delete->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
		<th class="<?php echo $rekmeddokter_delete->kode_rekmeddok->headerCellClass() ?>"><span id="elh_rekmeddokter_kode_rekmeddok" class="rekmeddokter_kode_rekmeddok"><?php echo $rekmeddokter_delete->kode_rekmeddok->caption() ?></span></th>
<?php } ?>
<?php if ($rekmeddokter_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $rekmeddokter_delete->tanggal->headerCellClass() ?>"><span id="elh_rekmeddokter_tanggal" class="rekmeddokter_tanggal"><?php echo $rekmeddokter_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($rekmeddokter_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<th class="<?php echo $rekmeddokter_delete->id_pelanggan->headerCellClass() ?>"><span id="elh_rekmeddokter_id_pelanggan" class="rekmeddokter_id_pelanggan"><?php echo $rekmeddokter_delete->id_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($rekmeddokter_delete->id_dokter->Visible) { // id_dokter ?>
		<th class="<?php echo $rekmeddokter_delete->id_dokter->headerCellClass() ?>"><span id="elh_rekmeddokter_id_dokter" class="rekmeddokter_id_dokter"><?php echo $rekmeddokter_delete->id_dokter->caption() ?></span></th>
<?php } ?>
<?php if ($rekmeddokter_delete->id_be->Visible) { // id_be ?>
		<th class="<?php echo $rekmeddokter_delete->id_be->headerCellClass() ?>"><span id="elh_rekmeddokter_id_be" class="rekmeddokter_id_be"><?php echo $rekmeddokter_delete->id_be->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rekmeddokter_delete->RecordCount = 0;
$i = 0;
while (!$rekmeddokter_delete->Recordset->EOF) {
	$rekmeddokter_delete->RecordCount++;
	$rekmeddokter_delete->RowCount++;

	// Set row properties
	$rekmeddokter->resetAttributes();
	$rekmeddokter->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$rekmeddokter_delete->loadRowValues($rekmeddokter_delete->Recordset);

	// Render row
	$rekmeddokter_delete->renderRow();
?>
	<tr <?php echo $rekmeddokter->rowAttributes() ?>>
<?php if ($rekmeddokter_delete->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
		<td <?php echo $rekmeddokter_delete->kode_rekmeddok->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_delete->RowCount ?>_rekmeddokter_kode_rekmeddok" class="rekmeddokter_kode_rekmeddok">
<span<?php echo $rekmeddokter_delete->kode_rekmeddok->viewAttributes() ?>><?php echo $rekmeddokter_delete->kode_rekmeddok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekmeddokter_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $rekmeddokter_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_delete->RowCount ?>_rekmeddokter_tanggal" class="rekmeddokter_tanggal">
<span<?php echo $rekmeddokter_delete->tanggal->viewAttributes() ?>><?php echo $rekmeddokter_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekmeddokter_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<td <?php echo $rekmeddokter_delete->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_delete->RowCount ?>_rekmeddokter_id_pelanggan" class="rekmeddokter_id_pelanggan">
<span<?php echo $rekmeddokter_delete->id_pelanggan->viewAttributes() ?>><?php echo $rekmeddokter_delete->id_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekmeddokter_delete->id_dokter->Visible) { // id_dokter ?>
		<td <?php echo $rekmeddokter_delete->id_dokter->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_delete->RowCount ?>_rekmeddokter_id_dokter" class="rekmeddokter_id_dokter">
<span<?php echo $rekmeddokter_delete->id_dokter->viewAttributes() ?>><?php echo $rekmeddokter_delete->id_dokter->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekmeddokter_delete->id_be->Visible) { // id_be ?>
		<td <?php echo $rekmeddokter_delete->id_be->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_delete->RowCount ?>_rekmeddokter_id_be" class="rekmeddokter_id_be">
<span<?php echo $rekmeddokter_delete->id_be->viewAttributes() ?>><?php echo $rekmeddokter_delete->id_be->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rekmeddokter_delete->Recordset->moveNext();
}
$rekmeddokter_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rekmeddokter_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$rekmeddokter_delete->showPageFooter();
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
$rekmeddokter_delete->terminate();
?>