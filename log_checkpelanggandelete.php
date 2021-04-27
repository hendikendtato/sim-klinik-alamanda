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
$log_checkpelanggan_delete = new log_checkpelanggan_delete();

// Run the page
$log_checkpelanggan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_checkpelanggan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flog_checkpelanggandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flog_checkpelanggandelete = currentForm = new ew.Form("flog_checkpelanggandelete", "delete");
	loadjs.done("flog_checkpelanggandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $log_checkpelanggan_delete->showPageHeader(); ?>
<?php
$log_checkpelanggan_delete->showMessage();
?>
<form name="flog_checkpelanggandelete" id="flog_checkpelanggandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log_checkpelanggan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($log_checkpelanggan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($log_checkpelanggan_delete->id->Visible) { // id ?>
		<th class="<?php echo $log_checkpelanggan_delete->id->headerCellClass() ?>"><span id="elh_log_checkpelanggan_id" class="log_checkpelanggan_id"><?php echo $log_checkpelanggan_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($log_checkpelanggan_delete->tglwaktu_update->Visible) { // tglwaktu_update ?>
		<th class="<?php echo $log_checkpelanggan_delete->tglwaktu_update->headerCellClass() ?>"><span id="elh_log_checkpelanggan_tglwaktu_update" class="log_checkpelanggan_tglwaktu_update"><?php echo $log_checkpelanggan_delete->tglwaktu_update->caption() ?></span></th>
<?php } ?>
<?php if ($log_checkpelanggan_delete->tgl_update->Visible) { // tgl_update ?>
		<th class="<?php echo $log_checkpelanggan_delete->tgl_update->headerCellClass() ?>"><span id="elh_log_checkpelanggan_tgl_update" class="log_checkpelanggan_tgl_update"><?php echo $log_checkpelanggan_delete->tgl_update->caption() ?></span></th>
<?php } ?>
<?php if ($log_checkpelanggan_delete->id_user->Visible) { // id_user ?>
		<th class="<?php echo $log_checkpelanggan_delete->id_user->headerCellClass() ?>"><span id="elh_log_checkpelanggan_id_user" class="log_checkpelanggan_id_user"><?php echo $log_checkpelanggan_delete->id_user->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$log_checkpelanggan_delete->RecordCount = 0;
$i = 0;
while (!$log_checkpelanggan_delete->Recordset->EOF) {
	$log_checkpelanggan_delete->RecordCount++;
	$log_checkpelanggan_delete->RowCount++;

	// Set row properties
	$log_checkpelanggan->resetAttributes();
	$log_checkpelanggan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$log_checkpelanggan_delete->loadRowValues($log_checkpelanggan_delete->Recordset);

	// Render row
	$log_checkpelanggan_delete->renderRow();
?>
	<tr <?php echo $log_checkpelanggan->rowAttributes() ?>>
<?php if ($log_checkpelanggan_delete->id->Visible) { // id ?>
		<td <?php echo $log_checkpelanggan_delete->id->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_delete->RowCount ?>_log_checkpelanggan_id" class="log_checkpelanggan_id">
<span<?php echo $log_checkpelanggan_delete->id->viewAttributes() ?>><?php echo $log_checkpelanggan_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log_checkpelanggan_delete->tglwaktu_update->Visible) { // tglwaktu_update ?>
		<td <?php echo $log_checkpelanggan_delete->tglwaktu_update->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_delete->RowCount ?>_log_checkpelanggan_tglwaktu_update" class="log_checkpelanggan_tglwaktu_update">
<span<?php echo $log_checkpelanggan_delete->tglwaktu_update->viewAttributes() ?>><?php echo $log_checkpelanggan_delete->tglwaktu_update->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log_checkpelanggan_delete->tgl_update->Visible) { // tgl_update ?>
		<td <?php echo $log_checkpelanggan_delete->tgl_update->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_delete->RowCount ?>_log_checkpelanggan_tgl_update" class="log_checkpelanggan_tgl_update">
<span<?php echo $log_checkpelanggan_delete->tgl_update->viewAttributes() ?>><?php echo $log_checkpelanggan_delete->tgl_update->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($log_checkpelanggan_delete->id_user->Visible) { // id_user ?>
		<td <?php echo $log_checkpelanggan_delete->id_user->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_delete->RowCount ?>_log_checkpelanggan_id_user" class="log_checkpelanggan_id_user">
<span<?php echo $log_checkpelanggan_delete->id_user->viewAttributes() ?>><?php echo $log_checkpelanggan_delete->id_user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$log_checkpelanggan_delete->Recordset->moveNext();
}
$log_checkpelanggan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $log_checkpelanggan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$log_checkpelanggan_delete->showPageFooter();
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
$log_checkpelanggan_delete->terminate();
?>