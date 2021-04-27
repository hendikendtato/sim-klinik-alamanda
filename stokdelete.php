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
$stok_delete = new stok_delete();

// Run the page
$stok_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$stok_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstokdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstokdelete = currentForm = new ew.Form("fstokdelete", "delete");
	loadjs.done("fstokdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $stok_delete->showPageHeader(); ?>
<?php
$stok_delete->showMessage();
?>
<form name="fstokdelete" id="fstokdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="stok">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($stok_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($stok_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $stok_delete->id_barang->headerCellClass() ?>"><span id="elh_stok_id_barang" class="stok_id_barang"><?php echo $stok_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($stok_delete->jumlah->Visible) { // jumlah ?>
		<th class="<?php echo $stok_delete->jumlah->headerCellClass() ?>"><span id="elh_stok_jumlah" class="stok_jumlah"><?php echo $stok_delete->jumlah->caption() ?></span></th>
<?php } ?>
<?php if ($stok_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $stok_delete->id_klinik->headerCellClass() ?>"><span id="elh_stok_id_klinik" class="stok_id_klinik"><?php echo $stok_delete->id_klinik->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$stok_delete->RecordCount = 0;
$i = 0;
while (!$stok_delete->Recordset->EOF) {
	$stok_delete->RecordCount++;
	$stok_delete->RowCount++;

	// Set row properties
	$stok->resetAttributes();
	$stok->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$stok_delete->loadRowValues($stok_delete->Recordset);

	// Render row
	$stok_delete->renderRow();
?>
	<tr <?php echo $stok->rowAttributes() ?>>
<?php if ($stok_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $stok_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $stok_delete->RowCount ?>_stok_id_barang" class="stok_id_barang">
<span<?php echo $stok_delete->id_barang->viewAttributes() ?>><?php echo $stok_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($stok_delete->jumlah->Visible) { // jumlah ?>
		<td <?php echo $stok_delete->jumlah->cellAttributes() ?>>
<span id="el<?php echo $stok_delete->RowCount ?>_stok_jumlah" class="stok_jumlah">
<span<?php echo $stok_delete->jumlah->viewAttributes() ?>><?php echo $stok_delete->jumlah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($stok_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $stok_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $stok_delete->RowCount ?>_stok_id_klinik" class="stok_id_klinik">
<span<?php echo $stok_delete->id_klinik->viewAttributes() ?>><?php echo $stok_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$stok_delete->Recordset->moveNext();
}
$stok_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $stok_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$stok_delete->showPageFooter();
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
$stok_delete->terminate();
?>