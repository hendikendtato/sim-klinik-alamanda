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
$m_poin_delete = new m_poin_delete();

// Run the page
$m_poin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_poin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_poindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_poindelete = currentForm = new ew.Form("fm_poindelete", "delete");
	loadjs.done("fm_poindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_poin_delete->showPageHeader(); ?>
<?php
$m_poin_delete->showMessage();
?>
<form name="fm_poindelete" id="fm_poindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_poin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_poin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_poin_delete->id_jenis_member->Visible) { // id_jenis_member ?>
		<th class="<?php echo $m_poin_delete->id_jenis_member->headerCellClass() ?>"><span id="elh_m_poin_id_jenis_member" class="m_poin_id_jenis_member"><?php echo $m_poin_delete->id_jenis_member->caption() ?></span></th>
<?php } ?>
<?php if ($m_poin_delete->curs_poin->Visible) { // curs_poin ?>
		<th class="<?php echo $m_poin_delete->curs_poin->headerCellClass() ?>"><span id="elh_m_poin_curs_poin" class="m_poin_curs_poin"><?php echo $m_poin_delete->curs_poin->caption() ?></span></th>
<?php } ?>
<?php if ($m_poin_delete->curs_to_rp->Visible) { // curs_to_rp ?>
		<th class="<?php echo $m_poin_delete->curs_to_rp->headerCellClass() ?>"><span id="elh_m_poin_curs_to_rp" class="m_poin_curs_to_rp"><?php echo $m_poin_delete->curs_to_rp->caption() ?></span></th>
<?php } ?>
<?php if ($m_poin_delete->max_klaim->Visible) { // max_klaim ?>
		<th class="<?php echo $m_poin_delete->max_klaim->headerCellClass() ?>"><span id="elh_m_poin_max_klaim" class="m_poin_max_klaim"><?php echo $m_poin_delete->max_klaim->caption() ?></span></th>
<?php } ?>
<?php if ($m_poin_delete->min_transaksi->Visible) { // min_transaksi ?>
		<th class="<?php echo $m_poin_delete->min_transaksi->headerCellClass() ?>"><span id="elh_m_poin_min_transaksi" class="m_poin_min_transaksi"><?php echo $m_poin_delete->min_transaksi->caption() ?></span></th>
<?php } ?>
<?php if ($m_poin_delete->waktu_exp->Visible) { // waktu_exp ?>
		<th class="<?php echo $m_poin_delete->waktu_exp->headerCellClass() ?>"><span id="elh_m_poin_waktu_exp" class="m_poin_waktu_exp"><?php echo $m_poin_delete->waktu_exp->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_poin_delete->RecordCount = 0;
$i = 0;
while (!$m_poin_delete->Recordset->EOF) {
	$m_poin_delete->RecordCount++;
	$m_poin_delete->RowCount++;

	// Set row properties
	$m_poin->resetAttributes();
	$m_poin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_poin_delete->loadRowValues($m_poin_delete->Recordset);

	// Render row
	$m_poin_delete->renderRow();
?>
	<tr <?php echo $m_poin->rowAttributes() ?>>
<?php if ($m_poin_delete->id_jenis_member->Visible) { // id_jenis_member ?>
		<td <?php echo $m_poin_delete->id_jenis_member->cellAttributes() ?>>
<span id="el<?php echo $m_poin_delete->RowCount ?>_m_poin_id_jenis_member" class="m_poin_id_jenis_member">
<span<?php echo $m_poin_delete->id_jenis_member->viewAttributes() ?>><?php echo $m_poin_delete->id_jenis_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_poin_delete->curs_poin->Visible) { // curs_poin ?>
		<td <?php echo $m_poin_delete->curs_poin->cellAttributes() ?>>
<span id="el<?php echo $m_poin_delete->RowCount ?>_m_poin_curs_poin" class="m_poin_curs_poin">
<span<?php echo $m_poin_delete->curs_poin->viewAttributes() ?>><?php echo $m_poin_delete->curs_poin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_poin_delete->curs_to_rp->Visible) { // curs_to_rp ?>
		<td <?php echo $m_poin_delete->curs_to_rp->cellAttributes() ?>>
<span id="el<?php echo $m_poin_delete->RowCount ?>_m_poin_curs_to_rp" class="m_poin_curs_to_rp">
<span<?php echo $m_poin_delete->curs_to_rp->viewAttributes() ?>><?php echo $m_poin_delete->curs_to_rp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_poin_delete->max_klaim->Visible) { // max_klaim ?>
		<td <?php echo $m_poin_delete->max_klaim->cellAttributes() ?>>
<span id="el<?php echo $m_poin_delete->RowCount ?>_m_poin_max_klaim" class="m_poin_max_klaim">
<span<?php echo $m_poin_delete->max_klaim->viewAttributes() ?>><?php echo $m_poin_delete->max_klaim->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_poin_delete->min_transaksi->Visible) { // min_transaksi ?>
		<td <?php echo $m_poin_delete->min_transaksi->cellAttributes() ?>>
<span id="el<?php echo $m_poin_delete->RowCount ?>_m_poin_min_transaksi" class="m_poin_min_transaksi">
<span<?php echo $m_poin_delete->min_transaksi->viewAttributes() ?>><?php echo $m_poin_delete->min_transaksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_poin_delete->waktu_exp->Visible) { // waktu_exp ?>
		<td <?php echo $m_poin_delete->waktu_exp->cellAttributes() ?>>
<span id="el<?php echo $m_poin_delete->RowCount ?>_m_poin_waktu_exp" class="m_poin_waktu_exp">
<span<?php echo $m_poin_delete->waktu_exp->viewAttributes() ?>><?php echo $m_poin_delete->waktu_exp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_poin_delete->Recordset->moveNext();
}
$m_poin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_poin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_poin_delete->showPageFooter();
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
$m_poin_delete->terminate();
?>