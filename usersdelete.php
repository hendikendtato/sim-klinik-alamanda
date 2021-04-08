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
$users_delete = new users_delete();

// Run the page
$users_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusersdelete = currentForm = new ew.Form("fusersdelete", "delete");
	loadjs.done("fusersdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_delete->showPageHeader(); ?>
<?php
$users_delete->showMessage();
?>
<form name="fusersdelete" id="fusersdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($users_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($users_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $users_delete->id_klinik->headerCellClass() ?>"><span id="elh_users_id_klinik" class="users_id_klinik"><?php echo $users_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->id_pegawai->Visible) { // id_pegawai ?>
		<th class="<?php echo $users_delete->id_pegawai->headerCellClass() ?>"><span id="elh_users_id_pegawai" class="users_id_pegawai"><?php echo $users_delete->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->username->Visible) { // username ?>
		<th class="<?php echo $users_delete->username->headerCellClass() ?>"><span id="elh_users_username" class="users_username"><?php echo $users_delete->username->caption() ?></span></th>
<?php } ?>
<?php if ($users_delete->level->Visible) { // level ?>
		<th class="<?php echo $users_delete->level->headerCellClass() ?>"><span id="elh_users_level" class="users_level"><?php echo $users_delete->level->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$users_delete->RecordCount = 0;
$i = 0;
while (!$users_delete->Recordset->EOF) {
	$users_delete->RecordCount++;
	$users_delete->RowCount++;

	// Set row properties
	$users->resetAttributes();
	$users->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$users_delete->loadRowValues($users_delete->Recordset);

	// Render row
	$users_delete->renderRow();
?>
	<tr <?php echo $users->rowAttributes() ?>>
<?php if ($users_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $users_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_id_klinik" class="users_id_klinik">
<span<?php echo $users_delete->id_klinik->viewAttributes() ?>><?php echo $users_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->id_pegawai->Visible) { // id_pegawai ?>
		<td <?php echo $users_delete->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_id_pegawai" class="users_id_pegawai">
<span<?php echo $users_delete->id_pegawai->viewAttributes() ?>><?php echo $users_delete->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->username->Visible) { // username ?>
		<td <?php echo $users_delete->username->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_username" class="users_username">
<span<?php echo $users_delete->username->viewAttributes() ?>><?php echo $users_delete->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($users_delete->level->Visible) { // level ?>
		<td <?php echo $users_delete->level->cellAttributes() ?>>
<span id="el<?php echo $users_delete->RowCount ?>_users_level" class="users_level">
<span<?php echo $users_delete->level->viewAttributes() ?>><?php echo $users_delete->level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$users_delete->Recordset->moveNext();
}
$users_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$users_delete->showPageFooter();
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
$users_delete->terminate();
?>