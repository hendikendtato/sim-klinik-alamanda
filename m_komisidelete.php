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
$m_komisi_delete = new m_komisi_delete();

// Run the page
$m_komisi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_komisidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_komisidelete = currentForm = new ew.Form("fm_komisidelete", "delete");
	loadjs.done("fm_komisidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_komisi_delete->showPageHeader(); ?>
<?php
$m_komisi_delete->showMessage();
?>
<form name="fm_komisidelete" id="fm_komisidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_komisi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_komisi_delete->id_komisi->Visible) { // id_komisi ?>
		<th class="<?php echo $m_komisi_delete->id_komisi->headerCellClass() ?>"><span id="elh_m_komisi_id_komisi" class="m_komisi_id_komisi"><?php echo $m_komisi_delete->id_komisi->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_delete->id_jabatan->Visible) { // id_jabatan ?>
		<th class="<?php echo $m_komisi_delete->id_jabatan->headerCellClass() ?>"><span id="elh_m_komisi_id_jabatan" class="m_komisi_id_jabatan"><?php echo $m_komisi_delete->id_jabatan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_komisi_delete->RecordCount = 0;
$i = 0;
while (!$m_komisi_delete->Recordset->EOF) {
	$m_komisi_delete->RecordCount++;
	$m_komisi_delete->RowCount++;

	// Set row properties
	$m_komisi->resetAttributes();
	$m_komisi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_komisi_delete->loadRowValues($m_komisi_delete->Recordset);

	// Render row
	$m_komisi_delete->renderRow();
?>
	<tr <?php echo $m_komisi->rowAttributes() ?>>
<?php if ($m_komisi_delete->id_komisi->Visible) { // id_komisi ?>
		<td <?php echo $m_komisi_delete->id_komisi->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_delete->RowCount ?>_m_komisi_id_komisi" class="m_komisi_id_komisi">
<span<?php echo $m_komisi_delete->id_komisi->viewAttributes() ?>><?php echo $m_komisi_delete->id_komisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_delete->id_jabatan->Visible) { // id_jabatan ?>
		<td <?php echo $m_komisi_delete->id_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_delete->RowCount ?>_m_komisi_id_jabatan" class="m_komisi_id_jabatan">
<span<?php echo $m_komisi_delete->id_jabatan->viewAttributes() ?>><?php echo $m_komisi_delete->id_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_komisi_delete->Recordset->moveNext();
}
$m_komisi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_komisi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_komisi_delete->showPageFooter();
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
$m_komisi_delete->terminate();
?>