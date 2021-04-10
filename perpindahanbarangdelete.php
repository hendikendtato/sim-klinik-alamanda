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
$perpindahanbarang_delete = new perpindahanbarang_delete();

// Run the page
$perpindahanbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perpindahanbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperpindahanbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fperpindahanbarangdelete = currentForm = new ew.Form("fperpindahanbarangdelete", "delete");
	loadjs.done("fperpindahanbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perpindahanbarang_delete->showPageHeader(); ?>
<?php
$perpindahanbarang_delete->showMessage();
?>
<form name="fperpindahanbarangdelete" id="fperpindahanbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perpindahanbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($perpindahanbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($perpindahanbarang_delete->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<th class="<?php echo $perpindahanbarang_delete->id_perpindahanbarang->headerCellClass() ?>"><span id="elh_perpindahanbarang_id_perpindahanbarang" class="perpindahanbarang_id_perpindahanbarang"><?php echo $perpindahanbarang_delete->id_perpindahanbarang->caption() ?></span></th>
<?php } ?>
<?php if ($perpindahanbarang_delete->tanggal->Visible) { // tanggal ?>
		<th class="<?php echo $perpindahanbarang_delete->tanggal->headerCellClass() ?>"><span id="elh_perpindahanbarang_tanggal" class="perpindahanbarang_tanggal"><?php echo $perpindahanbarang_delete->tanggal->caption() ?></span></th>
<?php } ?>
<?php if ($perpindahanbarang_delete->asal->Visible) { // asal ?>
		<th class="<?php echo $perpindahanbarang_delete->asal->headerCellClass() ?>"><span id="elh_perpindahanbarang_asal" class="perpindahanbarang_asal"><?php echo $perpindahanbarang_delete->asal->caption() ?></span></th>
<?php } ?>
<?php if ($perpindahanbarang_delete->tujuan->Visible) { // tujuan ?>
		<th class="<?php echo $perpindahanbarang_delete->tujuan->headerCellClass() ?>"><span id="elh_perpindahanbarang_tujuan" class="perpindahanbarang_tujuan"><?php echo $perpindahanbarang_delete->tujuan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$perpindahanbarang_delete->RecordCount = 0;
$i = 0;
while (!$perpindahanbarang_delete->Recordset->EOF) {
	$perpindahanbarang_delete->RecordCount++;
	$perpindahanbarang_delete->RowCount++;

	// Set row properties
	$perpindahanbarang->resetAttributes();
	$perpindahanbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$perpindahanbarang_delete->loadRowValues($perpindahanbarang_delete->Recordset);

	// Render row
	$perpindahanbarang_delete->renderRow();
?>
	<tr <?php echo $perpindahanbarang->rowAttributes() ?>>
<?php if ($perpindahanbarang_delete->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<td <?php echo $perpindahanbarang_delete->id_perpindahanbarang->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_delete->RowCount ?>_perpindahanbarang_id_perpindahanbarang" class="perpindahanbarang_id_perpindahanbarang">
<span<?php echo $perpindahanbarang_delete->id_perpindahanbarang->viewAttributes() ?>><?php echo $perpindahanbarang_delete->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($perpindahanbarang_delete->tanggal->Visible) { // tanggal ?>
		<td <?php echo $perpindahanbarang_delete->tanggal->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_delete->RowCount ?>_perpindahanbarang_tanggal" class="perpindahanbarang_tanggal">
<span<?php echo $perpindahanbarang_delete->tanggal->viewAttributes() ?>><?php echo $perpindahanbarang_delete->tanggal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($perpindahanbarang_delete->asal->Visible) { // asal ?>
		<td <?php echo $perpindahanbarang_delete->asal->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_delete->RowCount ?>_perpindahanbarang_asal" class="perpindahanbarang_asal">
<span<?php echo $perpindahanbarang_delete->asal->viewAttributes() ?>><?php echo $perpindahanbarang_delete->asal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($perpindahanbarang_delete->tujuan->Visible) { // tujuan ?>
		<td <?php echo $perpindahanbarang_delete->tujuan->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_delete->RowCount ?>_perpindahanbarang_tujuan" class="perpindahanbarang_tujuan">
<span<?php echo $perpindahanbarang_delete->tujuan->viewAttributes() ?>><?php echo $perpindahanbarang_delete->tujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$perpindahanbarang_delete->Recordset->moveNext();
}
$perpindahanbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perpindahanbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$perpindahanbarang_delete->showPageFooter();
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
$perpindahanbarang_delete->terminate();
?>