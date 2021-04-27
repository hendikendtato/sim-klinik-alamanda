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
$m_jenis_member_delete = new m_jenis_member_delete();

// Run the page
$m_jenis_member_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jenis_member_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_jenis_memberdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_jenis_memberdelete = currentForm = new ew.Form("fm_jenis_memberdelete", "delete");
	loadjs.done("fm_jenis_memberdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_jenis_member_delete->showPageHeader(); ?>
<?php
$m_jenis_member_delete->showMessage();
?>
<form name="fm_jenis_memberdelete" id="fm_jenis_memberdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jenis_member">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_jenis_member_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_jenis_member_delete->nama_member->Visible) { // nama_member ?>
		<th class="<?php echo $m_jenis_member_delete->nama_member->headerCellClass() ?>"><span id="elh_m_jenis_member_nama_member" class="m_jenis_member_nama_member"><?php echo $m_jenis_member_delete->nama_member->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->member_selanjutnya->Visible) { // member_selanjutnya ?>
		<th class="<?php echo $m_jenis_member_delete->member_selanjutnya->headerCellClass() ?>"><span id="elh_m_jenis_member_member_selanjutnya" class="m_jenis_member_member_selanjutnya"><?php echo $m_jenis_member_delete->member_selanjutnya->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->nominal_bawah->Visible) { // nominal_bawah ?>
		<th class="<?php echo $m_jenis_member_delete->nominal_bawah->headerCellClass() ?>"><span id="elh_m_jenis_member_nominal_bawah" class="m_jenis_member_nominal_bawah"><?php echo $m_jenis_member_delete->nominal_bawah->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->nominal_atas->Visible) { // nominal_atas ?>
		<th class="<?php echo $m_jenis_member_delete->nominal_atas->headerCellClass() ?>"><span id="elh_m_jenis_member_nominal_atas" class="m_jenis_member_nominal_atas"><?php echo $m_jenis_member_delete->nominal_atas->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->qty_bawah->Visible) { // qty_bawah ?>
		<th class="<?php echo $m_jenis_member_delete->qty_bawah->headerCellClass() ?>"><span id="elh_m_jenis_member_qty_bawah" class="m_jenis_member_qty_bawah"><?php echo $m_jenis_member_delete->qty_bawah->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->qty_atas->Visible) { // qty_atas ?>
		<th class="<?php echo $m_jenis_member_delete->qty_atas->headerCellClass() ?>"><span id="elh_m_jenis_member_qty_atas" class="m_jenis_member_qty_atas"><?php echo $m_jenis_member_delete->qty_atas->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->disc_prosen->Visible) { // disc_prosen ?>
		<th class="<?php echo $m_jenis_member_delete->disc_prosen->headerCellClass() ?>"><span id="elh_m_jenis_member_disc_prosen" class="m_jenis_member_disc_prosen"><?php echo $m_jenis_member_delete->disc_prosen->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->disc_nominal->Visible) { // disc_nominal ?>
		<th class="<?php echo $m_jenis_member_delete->disc_nominal->headerCellClass() ?>"><span id="elh_m_jenis_member_disc_nominal" class="m_jenis_member_disc_nominal"><?php echo $m_jenis_member_delete->disc_nominal->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->jangka_waktu->Visible) { // jangka_waktu ?>
		<th class="<?php echo $m_jenis_member_delete->jangka_waktu->headerCellClass() ?>"><span id="elh_m_jenis_member_jangka_waktu" class="m_jenis_member_jangka_waktu"><?php echo $m_jenis_member_delete->jangka_waktu->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->min_kedatangan->Visible) { // min_kedatangan ?>
		<th class="<?php echo $m_jenis_member_delete->min_kedatangan->headerCellClass() ?>"><span id="elh_m_jenis_member_min_kedatangan" class="m_jenis_member_min_kedatangan"><?php echo $m_jenis_member_delete->min_kedatangan->caption() ?></span></th>
<?php } ?>
<?php if ($m_jenis_member_delete->poin_member->Visible) { // poin_member ?>
		<th class="<?php echo $m_jenis_member_delete->poin_member->headerCellClass() ?>"><span id="elh_m_jenis_member_poin_member" class="m_jenis_member_poin_member"><?php echo $m_jenis_member_delete->poin_member->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_jenis_member_delete->RecordCount = 0;
$i = 0;
while (!$m_jenis_member_delete->Recordset->EOF) {
	$m_jenis_member_delete->RecordCount++;
	$m_jenis_member_delete->RowCount++;

	// Set row properties
	$m_jenis_member->resetAttributes();
	$m_jenis_member->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_jenis_member_delete->loadRowValues($m_jenis_member_delete->Recordset);

	// Render row
	$m_jenis_member_delete->renderRow();
?>
	<tr <?php echo $m_jenis_member->rowAttributes() ?>>
<?php if ($m_jenis_member_delete->nama_member->Visible) { // nama_member ?>
		<td <?php echo $m_jenis_member_delete->nama_member->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_nama_member" class="m_jenis_member_nama_member">
<span<?php echo $m_jenis_member_delete->nama_member->viewAttributes() ?>><?php echo $m_jenis_member_delete->nama_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->member_selanjutnya->Visible) { // member_selanjutnya ?>
		<td <?php echo $m_jenis_member_delete->member_selanjutnya->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_member_selanjutnya" class="m_jenis_member_member_selanjutnya">
<span<?php echo $m_jenis_member_delete->member_selanjutnya->viewAttributes() ?>><?php echo $m_jenis_member_delete->member_selanjutnya->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->nominal_bawah->Visible) { // nominal_bawah ?>
		<td <?php echo $m_jenis_member_delete->nominal_bawah->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_nominal_bawah" class="m_jenis_member_nominal_bawah">
<span<?php echo $m_jenis_member_delete->nominal_bawah->viewAttributes() ?>><?php echo $m_jenis_member_delete->nominal_bawah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->nominal_atas->Visible) { // nominal_atas ?>
		<td <?php echo $m_jenis_member_delete->nominal_atas->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_nominal_atas" class="m_jenis_member_nominal_atas">
<span<?php echo $m_jenis_member_delete->nominal_atas->viewAttributes() ?>><?php echo $m_jenis_member_delete->nominal_atas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->qty_bawah->Visible) { // qty_bawah ?>
		<td <?php echo $m_jenis_member_delete->qty_bawah->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_qty_bawah" class="m_jenis_member_qty_bawah">
<span<?php echo $m_jenis_member_delete->qty_bawah->viewAttributes() ?>><?php echo $m_jenis_member_delete->qty_bawah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->qty_atas->Visible) { // qty_atas ?>
		<td <?php echo $m_jenis_member_delete->qty_atas->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_qty_atas" class="m_jenis_member_qty_atas">
<span<?php echo $m_jenis_member_delete->qty_atas->viewAttributes() ?>><?php echo $m_jenis_member_delete->qty_atas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->disc_prosen->Visible) { // disc_prosen ?>
		<td <?php echo $m_jenis_member_delete->disc_prosen->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_disc_prosen" class="m_jenis_member_disc_prosen">
<span<?php echo $m_jenis_member_delete->disc_prosen->viewAttributes() ?>><?php echo $m_jenis_member_delete->disc_prosen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->disc_nominal->Visible) { // disc_nominal ?>
		<td <?php echo $m_jenis_member_delete->disc_nominal->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_disc_nominal" class="m_jenis_member_disc_nominal">
<span<?php echo $m_jenis_member_delete->disc_nominal->viewAttributes() ?>><?php echo $m_jenis_member_delete->disc_nominal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->jangka_waktu->Visible) { // jangka_waktu ?>
		<td <?php echo $m_jenis_member_delete->jangka_waktu->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_jangka_waktu" class="m_jenis_member_jangka_waktu">
<span<?php echo $m_jenis_member_delete->jangka_waktu->viewAttributes() ?>><?php echo $m_jenis_member_delete->jangka_waktu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->min_kedatangan->Visible) { // min_kedatangan ?>
		<td <?php echo $m_jenis_member_delete->min_kedatangan->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_min_kedatangan" class="m_jenis_member_min_kedatangan">
<span<?php echo $m_jenis_member_delete->min_kedatangan->viewAttributes() ?>><?php echo $m_jenis_member_delete->min_kedatangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jenis_member_delete->poin_member->Visible) { // poin_member ?>
		<td <?php echo $m_jenis_member_delete->poin_member->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_delete->RowCount ?>_m_jenis_member_poin_member" class="m_jenis_member_poin_member">
<span<?php echo $m_jenis_member_delete->poin_member->viewAttributes() ?>><?php echo $m_jenis_member_delete->poin_member->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_jenis_member_delete->Recordset->moveNext();
}
$m_jenis_member_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_jenis_member_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_jenis_member_delete->showPageFooter();
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
$m_jenis_member_delete->terminate();
?>