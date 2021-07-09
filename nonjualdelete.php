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
$nonjual_delete = new nonjual_delete();

// Run the page
$nonjual_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nonjual_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnonjualdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fnonjualdelete = currentForm = new ew.Form("fnonjualdelete", "delete");
	loadjs.done("fnonjualdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $nonjual_delete->showPageHeader(); ?>
<?php
$nonjual_delete->showMessage();
?>
<form name="fnonjualdelete" id="fnonjualdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nonjual">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($nonjual_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($nonjual_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $nonjual_delete->id_klinik->headerCellClass() ?>"><span id="elh_nonjual_id_klinik" class="nonjual_id_klinik"><?php echo $nonjual_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($nonjual_delete->id_staff->Visible) { // id_staff ?>
		<th class="<?php echo $nonjual_delete->id_staff->headerCellClass() ?>"><span id="elh_nonjual_id_staff" class="nonjual_id_staff"><?php echo $nonjual_delete->id_staff->caption() ?></span></th>
<?php } ?>
<?php if ($nonjual_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $nonjual_delete->tanggal->headerCellClass() ?>"><span id="elh_nonjual_tanggal" class="nonjual_tanggal"><?php echo $nonjual_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($nonjual_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $nonjual_delete->keterangan->headerCellClass() ?>"><span id="elh_nonjual_keterangan" class="nonjual_keterangan"><?php echo $nonjual_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$nonjual_delete->RecordCount = 0;
$i = 0;
while (!$nonjual_delete->Recordset->EOF) {
	$nonjual_delete->RecordCount++;
	$nonjual_delete->RowCount++;

	// Set row properties
	$nonjual->resetAttributes();
	$nonjual->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$nonjual_delete->loadRowValues($nonjual_delete->Recordset);

	// Render row
	$nonjual_delete->renderRow();
?>
	<tr <?php echo $nonjual->rowAttributes() ?>>
<?php if ($nonjual_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $nonjual_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $nonjual_delete->RowCount ?>_nonjual_id_klinik" class="nonjual_id_klinik">
<span<?php echo $nonjual_delete->id_klinik->viewAttributes() ?>><?php echo $nonjual_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($nonjual_delete->id_staff->Visible) { // id_staff ?>
		<td <?php echo $nonjual_delete->id_staff->cellAttributes() ?>>
<span id="el<?php echo $nonjual_delete->RowCount ?>_nonjual_id_staff" class="nonjual_id_staff">
<span<?php echo $nonjual_delete->id_staff->viewAttributes() ?>><?php echo $nonjual_delete->id_staff->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($nonjual_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $nonjual_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $nonjual_delete->RowCount ?>_nonjual_tanggal" class="nonjual_tanggal">
<span<?php echo $nonjual_delete->tanggal->viewAttributes() ?>><?php echo $nonjual_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($nonjual_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $nonjual_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $nonjual_delete->RowCount ?>_nonjual_keterangan" class="nonjual_keterangan">
<span<?php echo $nonjual_delete->keterangan->viewAttributes() ?>><?php echo $nonjual_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$nonjual_delete->Recordset->moveNext();
}
$nonjual_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $nonjual_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$nonjual_delete->showPageFooter();
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
$nonjual_delete->terminate();
?>