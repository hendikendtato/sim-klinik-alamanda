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
$m_akun_delete = new m_akun_delete();

// Run the page
$m_akun_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_akun_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_akundelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_akundelete = currentForm = new ew.Form("fm_akundelete", "delete");
	loadjs.done("fm_akundelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_akun_delete->showPageHeader(); ?>
<?php
$m_akun_delete->showMessage();
?>
<form name="fm_akundelete" id="fm_akundelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_akun">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_akun_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_akun_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_akun_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_akun_id_klinik" class="m_akun_id_klinik"><?php echo $m_akun_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_akun_delete->kode_akun->Visible) { // kode_akun ?>
		<th class="<?php echo $m_akun_delete->kode_akun->headerCellClass() ?>"><span id="elh_m_akun_kode_akun" class="m_akun_kode_akun"><?php echo $m_akun_delete->kode_akun->caption() ?></span></th>
<?php } ?>
<?php if ($m_akun_delete->nama_akun->Visible) { // nama_akun ?>
		<th class="<?php echo $m_akun_delete->nama_akun->headerCellClass() ?>"><span id="elh_m_akun_nama_akun" class="m_akun_nama_akun"><?php echo $m_akun_delete->nama_akun->caption() ?></span></th>
<?php } ?>
<?php if ($m_akun_delete->tipe_akun->Visible) { // tipe_akun ?>
		<th class="<?php echo $m_akun_delete->tipe_akun->headerCellClass() ?>"><span id="elh_m_akun_tipe_akun" class="m_akun_tipe_akun"><?php echo $m_akun_delete->tipe_akun->caption() ?></span></th>
<?php } ?>
<?php if ($m_akun_delete->saldo->Visible) { // saldo ?>
		<th class="<?php echo $m_akun_delete->saldo->headerCellClass() ?>"><span id="elh_m_akun_saldo" class="m_akun_saldo"><?php echo $m_akun_delete->saldo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_akun_delete->RecordCount = 0;
$i = 0;
while (!$m_akun_delete->Recordset->EOF) {
	$m_akun_delete->RecordCount++;
	$m_akun_delete->RowCount++;

	// Set row properties
	$m_akun->resetAttributes();
	$m_akun->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_akun_delete->loadRowValues($m_akun_delete->Recordset);

	// Render row
	$m_akun_delete->renderRow();
?>
	<tr <?php echo $m_akun->rowAttributes() ?>>
<?php if ($m_akun_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_akun_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_akun_delete->RowCount ?>_m_akun_id_klinik" class="m_akun_id_klinik">
<span<?php echo $m_akun_delete->id_klinik->viewAttributes() ?>><?php echo $m_akun_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_akun_delete->kode_akun->Visible) { // kode_akun ?>
		<td <?php echo $m_akun_delete->kode_akun->cellAttributes() ?>>
<span id="el<?php echo $m_akun_delete->RowCount ?>_m_akun_kode_akun" class="m_akun_kode_akun">
<span<?php echo $m_akun_delete->kode_akun->viewAttributes() ?>><?php echo $m_akun_delete->kode_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_akun_delete->nama_akun->Visible) { // nama_akun ?>
		<td <?php echo $m_akun_delete->nama_akun->cellAttributes() ?>>
<span id="el<?php echo $m_akun_delete->RowCount ?>_m_akun_nama_akun" class="m_akun_nama_akun">
<span<?php echo $m_akun_delete->nama_akun->viewAttributes() ?>><?php echo $m_akun_delete->nama_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_akun_delete->tipe_akun->Visible) { // tipe_akun ?>
		<td <?php echo $m_akun_delete->tipe_akun->cellAttributes() ?>>
<span id="el<?php echo $m_akun_delete->RowCount ?>_m_akun_tipe_akun" class="m_akun_tipe_akun">
<span<?php echo $m_akun_delete->tipe_akun->viewAttributes() ?>><?php echo $m_akun_delete->tipe_akun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_akun_delete->saldo->Visible) { // saldo ?>
		<td <?php echo $m_akun_delete->saldo->cellAttributes() ?>>
<span id="el<?php echo $m_akun_delete->RowCount ?>_m_akun_saldo" class="m_akun_saldo">
<span<?php echo $m_akun_delete->saldo->viewAttributes() ?>><?php echo $m_akun_delete->saldo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_akun_delete->Recordset->moveNext();
}
$m_akun_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_akun_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_akun_delete->showPageFooter();
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
$m_akun_delete->terminate();
?>