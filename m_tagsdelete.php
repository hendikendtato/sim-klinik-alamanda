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
$m_tags_delete = new m_tags_delete();

// Run the page
$m_tags_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tags_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_tagsdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_tagsdelete = currentForm = new ew.Form("fm_tagsdelete", "delete");
	loadjs.done("fm_tagsdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_tags_delete->showPageHeader(); ?>
<?php
$m_tags_delete->showMessage();
?>
<form name="fm_tagsdelete" id="fm_tagsdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tags">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_tags_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_tags_delete->id->Visible) { // id ?>
		<th class="<?php echo $m_tags_delete->id->headerCellClass() ?>"><span id="elh_m_tags_id" class="m_tags_id"><?php echo $m_tags_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($m_tags_delete->nama_tag->Visible) { // nama_tag ?>
		<th class="<?php echo $m_tags_delete->nama_tag->headerCellClass() ?>"><span id="elh_m_tags_nama_tag" class="m_tags_nama_tag"><?php echo $m_tags_delete->nama_tag->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_tags_delete->RecordCount = 0;
$i = 0;
while (!$m_tags_delete->Recordset->EOF) {
	$m_tags_delete->RecordCount++;
	$m_tags_delete->RowCount++;

	// Set row properties
	$m_tags->resetAttributes();
	$m_tags->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_tags_delete->loadRowValues($m_tags_delete->Recordset);

	// Render row
	$m_tags_delete->renderRow();
?>
	<tr <?php echo $m_tags->rowAttributes() ?>>
<?php if ($m_tags_delete->id->Visible) { // id ?>
		<td <?php echo $m_tags_delete->id->cellAttributes() ?>>
<span id="el<?php echo $m_tags_delete->RowCount ?>_m_tags_id" class="m_tags_id">
<span<?php echo $m_tags_delete->id->viewAttributes() ?>><?php echo $m_tags_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_tags_delete->nama_tag->Visible) { // nama_tag ?>
		<td <?php echo $m_tags_delete->nama_tag->cellAttributes() ?>>
<span id="el<?php echo $m_tags_delete->RowCount ?>_m_tags_nama_tag" class="m_tags_nama_tag">
<span<?php echo $m_tags_delete->nama_tag->viewAttributes() ?>><?php echo $m_tags_delete->nama_tag->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_tags_delete->Recordset->moveNext();
}
$m_tags_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_tags_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_tags_delete->showPageFooter();
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
$m_tags_delete->terminate();
?>