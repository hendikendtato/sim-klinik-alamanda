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
$penyesuaian_poin_delete = new penyesuaian_poin_delete();

// Run the page
$penyesuaian_poin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaian_poin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaian_poindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpenyesuaian_poindelete = currentForm = new ew.Form("fpenyesuaian_poindelete", "delete");
	loadjs.done("fpenyesuaian_poindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penyesuaian_poin_delete->showPageHeader(); ?>
<?php
$penyesuaian_poin_delete->showMessage();
?>
<form name="fpenyesuaian_poindelete" id="fpenyesuaian_poindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaian_poin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($penyesuaian_poin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($penyesuaian_poin_delete->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
		<th class="<?php echo $penyesuaian_poin_delete->kode_penyesuaianpoin->headerCellClass() ?>"><span id="elh_penyesuaian_poin_kode_penyesuaianpoin" class="penyesuaian_poin_kode_penyesuaianpoin"><?php echo $penyesuaian_poin_delete->kode_penyesuaianpoin->caption() ?></span></th>
<?php } ?>
<?php if ($penyesuaian_poin_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $penyesuaian_poin_delete->id_klinik->headerCellClass() ?>"><span id="elh_penyesuaian_poin_id_klinik" class="penyesuaian_poin_id_klinik"><?php echo $penyesuaian_poin_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($penyesuaian_poin_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $penyesuaian_poin_delete->tgl->headerCellClass() ?>"><span id="elh_penyesuaian_poin_tgl" class="penyesuaian_poin_tgl"><?php echo $penyesuaian_poin_delete->tgl->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$penyesuaian_poin_delete->RecordCount = 0;
$i = 0;
while (!$penyesuaian_poin_delete->Recordset->EOF) {
	$penyesuaian_poin_delete->RecordCount++;
	$penyesuaian_poin_delete->RowCount++;

	// Set row properties
	$penyesuaian_poin->resetAttributes();
	$penyesuaian_poin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$penyesuaian_poin_delete->loadRowValues($penyesuaian_poin_delete->Recordset);

	// Render row
	$penyesuaian_poin_delete->renderRow();
?>
	<tr <?php echo $penyesuaian_poin->rowAttributes() ?>>
<?php if ($penyesuaian_poin_delete->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
		<td <?php echo $penyesuaian_poin_delete->kode_penyesuaianpoin->cellAttributes() ?>>
<span id="el<?php echo $penyesuaian_poin_delete->RowCount ?>_penyesuaian_poin_kode_penyesuaianpoin" class="penyesuaian_poin_kode_penyesuaianpoin">
<span<?php echo $penyesuaian_poin_delete->kode_penyesuaianpoin->viewAttributes() ?>><?php echo $penyesuaian_poin_delete->kode_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penyesuaian_poin_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $penyesuaian_poin_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penyesuaian_poin_delete->RowCount ?>_penyesuaian_poin_id_klinik" class="penyesuaian_poin_id_klinik">
<span<?php echo $penyesuaian_poin_delete->id_klinik->viewAttributes() ?>><?php echo $penyesuaian_poin_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($penyesuaian_poin_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $penyesuaian_poin_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $penyesuaian_poin_delete->RowCount ?>_penyesuaian_poin_tgl" class="penyesuaian_poin_tgl">
<span<?php echo $penyesuaian_poin_delete->tgl->viewAttributes() ?>><?php echo $penyesuaian_poin_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$penyesuaian_poin_delete->Recordset->moveNext();
}
$penyesuaian_poin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penyesuaian_poin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$penyesuaian_poin_delete->showPageFooter();
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
$penyesuaian_poin_delete->terminate();
?>