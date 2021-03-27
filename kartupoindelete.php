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
$kartupoin_delete = new kartupoin_delete();

// Run the page
$kartupoin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartupoin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkartupoindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fkartupoindelete = currentForm = new ew.Form("fkartupoindelete", "delete");
	loadjs.done("fkartupoindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kartupoin_delete->showPageHeader(); ?>
<?php
$kartupoin_delete->showMessage();
?>
<form name="fkartupoindelete" id="fkartupoindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartupoin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($kartupoin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($kartupoin_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<th class="<?php echo $kartupoin_delete->id_pelanggan->headerCellClass() ?>"><span id="elh_kartupoin_id_pelanggan" class="kartupoin_id_pelanggan"><?php echo $kartupoin_delete->id_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $kartupoin_delete->id_klinik->headerCellClass() ?>"><span id="elh_kartupoin_id_klinik" class="kartupoin_id_klinik"><?php echo $kartupoin_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->kode_penjualan->Visible) { // kode_penjualan ?>
		<th class="<?php echo $kartupoin_delete->kode_penjualan->headerCellClass() ?>"><span id="elh_kartupoin_kode_penjualan" class="kartupoin_kode_penjualan"><?php echo $kartupoin_delete->kode_penjualan->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
		<th class="<?php echo $kartupoin_delete->id_penyesuaian_poin->headerCellClass() ?>"><span id="elh_kartupoin_id_penyesuaian_poin" class="kartupoin_id_penyesuaian_poin"><?php echo $kartupoin_delete->id_penyesuaian_poin->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $kartupoin_delete->tgl->headerCellClass() ?>"><span id="elh_kartupoin_tgl" class="kartupoin_tgl"><?php echo $kartupoin_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->masuk->Visible) { // masuk ?>
		<th class="<?php echo $kartupoin_delete->masuk->headerCellClass() ?>"><span id="elh_kartupoin_masuk" class="kartupoin_masuk"><?php echo $kartupoin_delete->masuk->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<th class="<?php echo $kartupoin_delete->masuk_penyesuaian->headerCellClass() ?>"><span id="elh_kartupoin_masuk_penyesuaian" class="kartupoin_masuk_penyesuaian"><?php echo $kartupoin_delete->masuk_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->keluar->Visible) { // keluar ?>
		<th class="<?php echo $kartupoin_delete->keluar->headerCellClass() ?>"><span id="elh_kartupoin_keluar" class="kartupoin_keluar"><?php echo $kartupoin_delete->keluar->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<th class="<?php echo $kartupoin_delete->keluar_penyesuaian->headerCellClass() ?>"><span id="elh_kartupoin_keluar_penyesuaian" class="kartupoin_keluar_penyesuaian"><?php echo $kartupoin_delete->keluar_penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($kartupoin_delete->saldo_poin->Visible) { // saldo_poin ?>
		<th class="<?php echo $kartupoin_delete->saldo_poin->headerCellClass() ?>"><span id="elh_kartupoin_saldo_poin" class="kartupoin_saldo_poin"><?php echo $kartupoin_delete->saldo_poin->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kartupoin_delete->RecordCount = 0;
$i = 0;
while (!$kartupoin_delete->Recordset->EOF) {
	$kartupoin_delete->RecordCount++;
	$kartupoin_delete->RowCount++;

	// Set row properties
	$kartupoin->resetAttributes();
	$kartupoin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$kartupoin_delete->loadRowValues($kartupoin_delete->Recordset);

	// Render row
	$kartupoin_delete->renderRow();
?>
	<tr <?php echo $kartupoin->rowAttributes() ?>>
<?php if ($kartupoin_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<td <?php echo $kartupoin_delete->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_id_pelanggan" class="kartupoin_id_pelanggan">
<span<?php echo $kartupoin_delete->id_pelanggan->viewAttributes() ?>><?php echo $kartupoin_delete->id_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $kartupoin_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_id_klinik" class="kartupoin_id_klinik">
<span<?php echo $kartupoin_delete->id_klinik->viewAttributes() ?>><?php echo $kartupoin_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->kode_penjualan->Visible) { // kode_penjualan ?>
		<td <?php echo $kartupoin_delete->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_kode_penjualan" class="kartupoin_kode_penjualan">
<span<?php echo $kartupoin_delete->kode_penjualan->viewAttributes() ?>><?php echo $kartupoin_delete->kode_penjualan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
		<td <?php echo $kartupoin_delete->id_penyesuaian_poin->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_id_penyesuaian_poin" class="kartupoin_id_penyesuaian_poin">
<span<?php echo $kartupoin_delete->id_penyesuaian_poin->viewAttributes() ?>><?php echo $kartupoin_delete->id_penyesuaian_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $kartupoin_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_tgl" class="kartupoin_tgl">
<span<?php echo $kartupoin_delete->tgl->viewAttributes() ?>><?php echo $kartupoin_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->masuk->Visible) { // masuk ?>
		<td <?php echo $kartupoin_delete->masuk->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_masuk" class="kartupoin_masuk">
<span<?php echo $kartupoin_delete->masuk->viewAttributes() ?>><?php echo $kartupoin_delete->masuk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td <?php echo $kartupoin_delete->masuk_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_masuk_penyesuaian" class="kartupoin_masuk_penyesuaian">
<span<?php echo $kartupoin_delete->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartupoin_delete->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->keluar->Visible) { // keluar ?>
		<td <?php echo $kartupoin_delete->keluar->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_keluar" class="kartupoin_keluar">
<span<?php echo $kartupoin_delete->keluar->viewAttributes() ?>><?php echo $kartupoin_delete->keluar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td <?php echo $kartupoin_delete->keluar_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_keluar_penyesuaian" class="kartupoin_keluar_penyesuaian">
<span<?php echo $kartupoin_delete->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartupoin_delete->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartupoin_delete->saldo_poin->Visible) { // saldo_poin ?>
		<td <?php echo $kartupoin_delete->saldo_poin->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_delete->RowCount ?>_kartupoin_saldo_poin" class="kartupoin_saldo_poin">
<span<?php echo $kartupoin_delete->saldo_poin->viewAttributes() ?>><?php echo $kartupoin_delete->saldo_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kartupoin_delete->Recordset->moveNext();
}
$kartupoin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kartupoin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$kartupoin_delete->showPageFooter();
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
$kartupoin_delete->terminate();
?>