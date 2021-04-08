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
$detailpenyesuaianpoin_delete = new detailpenyesuaianpoin_delete();

// Run the page
$detailpenyesuaianpoin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianpoin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpenyesuaianpoindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdetailpenyesuaianpoindelete = currentForm = new ew.Form("fdetailpenyesuaianpoindelete", "delete");
	loadjs.done("fdetailpenyesuaianpoindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpenyesuaianpoin_delete->showPageHeader(); ?>
<?php
$detailpenyesuaianpoin_delete->showMessage();
?>
<form name="fdetailpenyesuaianpoindelete" id="fdetailpenyesuaianpoindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianpoin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($detailpenyesuaianpoin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($detailpenyesuaianpoin_delete->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->pid_penyesuaianpoin->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin" class="detailpenyesuaianpoin_pid_penyesuaianpoin"><?php echo $detailpenyesuaianpoin_delete->pid_penyesuaianpoin->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->id_member->Visible) { // id_member ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->id_member->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_id_member" class="detailpenyesuaianpoin_id_member"><?php echo $detailpenyesuaianpoin_delete->id_member->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->poin_database->Visible) { // poin_database ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->poin_database->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_poin_database" class="detailpenyesuaianpoin_poin_database"><?php echo $detailpenyesuaianpoin_delete->poin_database->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->poin_lapangan->Visible) { // poin_lapangan ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->poin_lapangan->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_poin_lapangan" class="detailpenyesuaianpoin_poin_lapangan"><?php echo $detailpenyesuaianpoin_delete->poin_lapangan->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->selisih->Visible) { // selisih ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->selisih->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_selisih" class="detailpenyesuaianpoin_selisih"><?php echo $detailpenyesuaianpoin_delete->selisih->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->tipe->Visible) { // tipe ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->tipe->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_tipe" class="detailpenyesuaianpoin_tipe"><?php echo $detailpenyesuaianpoin_delete->tipe->caption() ?></span></th>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $detailpenyesuaianpoin_delete->keterangan->headerCellClass() ?>"><span id="elh_detailpenyesuaianpoin_keterangan" class="detailpenyesuaianpoin_keterangan"><?php echo $detailpenyesuaianpoin_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$detailpenyesuaianpoin_delete->RecordCount = 0;
$i = 0;
while (!$detailpenyesuaianpoin_delete->Recordset->EOF) {
	$detailpenyesuaianpoin_delete->RecordCount++;
	$detailpenyesuaianpoin_delete->RowCount++;

	// Set row properties
	$detailpenyesuaianpoin->resetAttributes();
	$detailpenyesuaianpoin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$detailpenyesuaianpoin_delete->loadRowValues($detailpenyesuaianpoin_delete->Recordset);

	// Render row
	$detailpenyesuaianpoin_delete->renderRow();
?>
	<tr <?php echo $detailpenyesuaianpoin->rowAttributes() ?>>
<?php if ($detailpenyesuaianpoin_delete->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
		<td <?php echo $detailpenyesuaianpoin_delete->pid_penyesuaianpoin->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin" class="detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_delete->pid_penyesuaianpoin->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->pid_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->id_member->Visible) { // id_member ?>
		<td <?php echo $detailpenyesuaianpoin_delete->id_member->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_id_member" class="detailpenyesuaianpoin_id_member">
<span<?php echo $detailpenyesuaianpoin_delete->id_member->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->id_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->poin_database->Visible) { // poin_database ?>
		<td <?php echo $detailpenyesuaianpoin_delete->poin_database->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_poin_database" class="detailpenyesuaianpoin_poin_database">
<span<?php echo $detailpenyesuaianpoin_delete->poin_database->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->poin_database->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->poin_lapangan->Visible) { // poin_lapangan ?>
		<td <?php echo $detailpenyesuaianpoin_delete->poin_lapangan->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_poin_lapangan" class="detailpenyesuaianpoin_poin_lapangan">
<span<?php echo $detailpenyesuaianpoin_delete->poin_lapangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->poin_lapangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->selisih->Visible) { // selisih ?>
		<td <?php echo $detailpenyesuaianpoin_delete->selisih->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_selisih" class="detailpenyesuaianpoin_selisih">
<span<?php echo $detailpenyesuaianpoin_delete->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->selisih->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->tipe->Visible) { // tipe ?>
		<td <?php echo $detailpenyesuaianpoin_delete->tipe->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_tipe" class="detailpenyesuaianpoin_tipe">
<span<?php echo $detailpenyesuaianpoin_delete->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->tipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $detailpenyesuaianpoin_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_delete->RowCount ?>_detailpenyesuaianpoin_keterangan" class="detailpenyesuaianpoin_keterangan">
<span<?php echo $detailpenyesuaianpoin_delete->keterangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$detailpenyesuaianpoin_delete->Recordset->moveNext();
}
$detailpenyesuaianpoin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpenyesuaianpoin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$detailpenyesuaianpoin_delete->showPageFooter();
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
$detailpenyesuaianpoin_delete->terminate();
?>