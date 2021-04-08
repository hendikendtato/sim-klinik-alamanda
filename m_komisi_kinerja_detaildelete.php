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
$m_komisi_kinerja_detail_delete = new m_komisi_kinerja_detail_delete();

// Run the page
$m_komisi_kinerja_detail_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_kinerja_detail_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_komisi_kinerja_detaildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_komisi_kinerja_detaildelete = currentForm = new ew.Form("fm_komisi_kinerja_detaildelete", "delete");
	loadjs.done("fm_komisi_kinerja_detaildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_komisi_kinerja_detail_delete->showPageHeader(); ?>
<?php
$m_komisi_kinerja_detail_delete->showMessage();
?>
<form name="fm_komisi_kinerja_detaildelete" id="fm_komisi_kinerja_detaildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi_kinerja_detail">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_komisi_kinerja_detail_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_komisi_kinerja_detail_delete->id->Visible) { // id ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->id->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_id" class="m_komisi_kinerja_detail_id"><?php echo $m_komisi_kinerja_detail_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->id_barang->Visible) { // id_barang ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->id_barang->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_id_barang" class="m_komisi_kinerja_detail_id_barang"><?php echo $m_komisi_kinerja_detail_delete->id_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_default_persen->Visible) { // kinerja_default_persen ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->kinerja_default_persen->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_default_persen" class="m_komisi_kinerja_detail_kinerja_default_persen"><?php echo $m_komisi_kinerja_detail_delete->kinerja_default_persen->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_default_rupiah->Visible) { // kinerja_default_rupiah ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->kinerja_default_rupiah->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_default_rupiah" class="m_komisi_kinerja_detail_kinerja_default_rupiah"><?php echo $m_komisi_kinerja_detail_delete->kinerja_default_rupiah->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_target_persen->Visible) { // kinerja_target_persen ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->kinerja_target_persen->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_target_persen" class="m_komisi_kinerja_detail_kinerja_target_persen"><?php echo $m_komisi_kinerja_detail_delete->kinerja_target_persen->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_target_rupiah->Visible) { // kinerja_target_rupiah ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->kinerja_target_rupiah->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_target_rupiah" class="m_komisi_kinerja_detail_kinerja_target_rupiah"><?php echo $m_komisi_kinerja_detail_delete->kinerja_target_rupiah->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->tgl_mulai->Visible) { // tgl_mulai ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->tgl_mulai->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_tgl_mulai" class="m_komisi_kinerja_detail_tgl_mulai"><?php echo $m_komisi_kinerja_detail_delete->tgl_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->tgl_akhir->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_tgl_akhir" class="m_komisi_kinerja_detail_tgl_akhir"><?php echo $m_komisi_kinerja_detail_delete->tgl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->target->Visible) { // target ?>
		<th class="<?php echo $m_komisi_kinerja_detail_delete->target->headerCellClass() ?>"><span id="elh_m_komisi_kinerja_detail_target" class="m_komisi_kinerja_detail_target"><?php echo $m_komisi_kinerja_detail_delete->target->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_komisi_kinerja_detail_delete->RecordCount = 0;
$i = 0;
while (!$m_komisi_kinerja_detail_delete->Recordset->EOF) {
	$m_komisi_kinerja_detail_delete->RecordCount++;
	$m_komisi_kinerja_detail_delete->RowCount++;

	// Set row properties
	$m_komisi_kinerja_detail->resetAttributes();
	$m_komisi_kinerja_detail->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_komisi_kinerja_detail_delete->loadRowValues($m_komisi_kinerja_detail_delete->Recordset);

	// Render row
	$m_komisi_kinerja_detail_delete->renderRow();
?>
	<tr <?php echo $m_komisi_kinerja_detail->rowAttributes() ?>>
<?php if ($m_komisi_kinerja_detail_delete->id->Visible) { // id ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->id->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_id" class="m_komisi_kinerja_detail_id">
<span<?php echo $m_komisi_kinerja_detail_delete->id->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->id_barang->Visible) { // id_barang ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_id_barang" class="m_komisi_kinerja_detail_id_barang">
<span<?php echo $m_komisi_kinerja_detail_delete->id_barang->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->id_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_default_persen->Visible) { // kinerja_default_persen ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->kinerja_default_persen->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_kinerja_default_persen" class="m_komisi_kinerja_detail_kinerja_default_persen">
<span<?php echo $m_komisi_kinerja_detail_delete->kinerja_default_persen->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->kinerja_default_persen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_default_rupiah->Visible) { // kinerja_default_rupiah ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->kinerja_default_rupiah->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_kinerja_default_rupiah" class="m_komisi_kinerja_detail_kinerja_default_rupiah">
<span<?php echo $m_komisi_kinerja_detail_delete->kinerja_default_rupiah->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->kinerja_default_rupiah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_target_persen->Visible) { // kinerja_target_persen ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->kinerja_target_persen->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_kinerja_target_persen" class="m_komisi_kinerja_detail_kinerja_target_persen">
<span<?php echo $m_komisi_kinerja_detail_delete->kinerja_target_persen->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->kinerja_target_persen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->kinerja_target_rupiah->Visible) { // kinerja_target_rupiah ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->kinerja_target_rupiah->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_kinerja_target_rupiah" class="m_komisi_kinerja_detail_kinerja_target_rupiah">
<span<?php echo $m_komisi_kinerja_detail_delete->kinerja_target_rupiah->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->kinerja_target_rupiah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->tgl_mulai->Visible) { // tgl_mulai ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_tgl_mulai" class="m_komisi_kinerja_detail_tgl_mulai">
<span<?php echo $m_komisi_kinerja_detail_delete->tgl_mulai->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->tgl_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->tgl_akhir->Visible) { // tgl_akhir ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_tgl_akhir" class="m_komisi_kinerja_detail_tgl_akhir">
<span<?php echo $m_komisi_kinerja_detail_delete->tgl_akhir->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_delete->target->Visible) { // target ?>
		<td <?php echo $m_komisi_kinerja_detail_delete->target->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_delete->RowCount ?>_m_komisi_kinerja_detail_target" class="m_komisi_kinerja_detail_target">
<span<?php echo $m_komisi_kinerja_detail_delete->target->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_delete->target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_komisi_kinerja_detail_delete->Recordset->moveNext();
}
$m_komisi_kinerja_detail_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_komisi_kinerja_detail_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_komisi_kinerja_detail_delete->showPageFooter();
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
$m_komisi_kinerja_detail_delete->terminate();
?>