<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$promo_delete = new promo_delete();

// Run the page
$promo_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promo_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpromodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpromodelete = currentForm = new ew.Form("fpromodelete", "delete");
	loadjs.done("fpromodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $promo_delete->showPageHeader(); ?>
<?php
$promo_delete->showMessage();
?>
<form name="fpromodelete" id="fpromodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promo">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($promo_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($promo_delete->id_promo->Visible) { // id_promo ?>
		<th class="<?php echo $promo_delete->id_promo->headerCellClass() ?>"><span id="elh_promo_id_promo" class="promo_id_promo"><?php echo $promo_delete->id_promo->caption() ?></span></th>
<?php } ?>
<?php if ($promo_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $promo_delete->nama->headerCellClass() ?>"><span id="elh_promo_nama" class="promo_nama"><?php echo $promo_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($promo_delete->tanggal_mulai->Visible) { // tanggal_mulai ?>
		<th class="<?php echo $promo_delete->tanggal_mulai->headerCellClass() ?>"><span id="elh_promo_tanggal_mulai" class="promo_tanggal_mulai"><?php echo $promo_delete->tanggal_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($promo_delete->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
		<th class="<?php echo $promo_delete->tanggal_berakhir->headerCellClass() ?>"><span id="elh_promo_tanggal_berakhir" class="promo_tanggal_berakhir"><?php echo $promo_delete->tanggal_berakhir->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$promo_delete->RecordCount = 0;
$i = 0;
while (!$promo_delete->Recordset->EOF) {
	$promo_delete->RecordCount++;
	$promo_delete->RowCount++;

	// Set row properties
	$promo->resetAttributes();
	$promo->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$promo_delete->loadRowValues($promo_delete->Recordset);

	// Render row
	$promo_delete->renderRow();
?>
	<tr <?php echo $promo->rowAttributes() ?>>
<?php if ($promo_delete->id_promo->Visible) { // id_promo ?>
		<td <?php echo $promo_delete->id_promo->cellAttributes() ?>>
<span id="el<?php echo $promo_delete->RowCount ?>_promo_id_promo" class="promo_id_promo">
<span<?php echo $promo_delete->id_promo->viewAttributes() ?>><?php echo $promo_delete->id_promo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($promo_delete->nama->Visible) { // nama ?>
		<td <?php echo $promo_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $promo_delete->RowCount ?>_promo_nama" class="promo_nama">
<span<?php echo $promo_delete->nama->viewAttributes() ?>><?php echo $promo_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($promo_delete->tanggal_mulai->Visible) { // tanggal_mulai ?>
		<td <?php echo $promo_delete->tanggal_mulai->cellAttributes() ?>>
<span id="el<?php echo $promo_delete->RowCount ?>_promo_tanggal_mulai" class="promo_tanggal_mulai">
<span<?php echo $promo_delete->tanggal_mulai->viewAttributes() ?>><?php echo $promo_delete->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($promo_delete->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
		<td <?php echo $promo_delete->tanggal_berakhir->cellAttributes() ?>>
<span id="el<?php echo $promo_delete->RowCount ?>_promo_tanggal_berakhir" class="promo_tanggal_berakhir">
<span<?php echo $promo_delete->tanggal_berakhir->viewAttributes() ?>><?php echo $promo_delete->tanggal_berakhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$promo_delete->Recordset->moveNext();
}
$promo_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $promo_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$promo_delete->showPageFooter();
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
$promo_delete->terminate();
?>