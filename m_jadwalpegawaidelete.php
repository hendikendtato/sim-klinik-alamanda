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
$m_jadwalpegawai_delete = new m_jadwalpegawai_delete();

// Run the page
$m_jadwalpegawai_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jadwalpegawai_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_jadwalpegawaidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_jadwalpegawaidelete = currentForm = new ew.Form("fm_jadwalpegawaidelete", "delete");
	loadjs.done("fm_jadwalpegawaidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_jadwalpegawai_delete->showPageHeader(); ?>
<?php
$m_jadwalpegawai_delete->showMessage();
?>
<form name="fm_jadwalpegawaidelete" id="fm_jadwalpegawaidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jadwalpegawai">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_jadwalpegawai_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_jadwalpegawai_delete->id_jadwalpeg->Visible) { // id_jadwalpeg ?>
		<th class="<?php echo $m_jadwalpegawai_delete->id_jadwalpeg->headerCellClass() ?>"><span id="elh_m_jadwalpegawai_id_jadwalpeg" class="m_jadwalpegawai_id_jadwalpeg"><?php echo $m_jadwalpegawai_delete->id_jadwalpeg->caption() ?></span></th>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
		<th class="<?php echo $m_jadwalpegawai_delete->tindakan_jadwalpeg->headerCellClass() ?>"><span id="elh_m_jadwalpegawai_tindakan_jadwalpeg" class="m_jadwalpegawai_tindakan_jadwalpeg"><?php echo $m_jadwalpegawai_delete->tindakan_jadwalpeg->caption() ?></span></th>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->idpeg->Visible) { // idpeg ?>
		<th class="<?php echo $m_jadwalpegawai_delete->idpeg->headerCellClass() ?>"><span id="elh_m_jadwalpegawai_idpeg" class="m_jadwalpegawai_idpeg"><?php echo $m_jadwalpegawai_delete->idpeg->caption() ?></span></th>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
		<th class="<?php echo $m_jadwalpegawai_delete->tanggal_jadwalpeg->headerCellClass() ?>"><span id="elh_m_jadwalpegawai_tanggal_jadwalpeg" class="m_jadwalpegawai_tanggal_jadwalpeg"><?php echo $m_jadwalpegawai_delete->tanggal_jadwalpeg->caption() ?></span></th>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
		<th class="<?php echo $m_jadwalpegawai_delete->jam_jadwalpeg->headerCellClass() ?>"><span id="elh_m_jadwalpegawai_jam_jadwalpeg" class="m_jadwalpegawai_jam_jadwalpeg"><?php echo $m_jadwalpegawai_delete->jam_jadwalpeg->caption() ?></span></th>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
		<th class="<?php echo $m_jadwalpegawai_delete->status_jadwalpeg->headerCellClass() ?>"><span id="elh_m_jadwalpegawai_status_jadwalpeg" class="m_jadwalpegawai_status_jadwalpeg"><?php echo $m_jadwalpegawai_delete->status_jadwalpeg->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_jadwalpegawai_delete->RecordCount = 0;
$i = 0;
while (!$m_jadwalpegawai_delete->Recordset->EOF) {
	$m_jadwalpegawai_delete->RecordCount++;
	$m_jadwalpegawai_delete->RowCount++;

	// Set row properties
	$m_jadwalpegawai->resetAttributes();
	$m_jadwalpegawai->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_jadwalpegawai_delete->loadRowValues($m_jadwalpegawai_delete->Recordset);

	// Render row
	$m_jadwalpegawai_delete->renderRow();
?>
	<tr <?php echo $m_jadwalpegawai->rowAttributes() ?>>
<?php if ($m_jadwalpegawai_delete->id_jadwalpeg->Visible) { // id_jadwalpeg ?>
		<td <?php echo $m_jadwalpegawai_delete->id_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_delete->RowCount ?>_m_jadwalpegawai_id_jadwalpeg" class="m_jadwalpegawai_id_jadwalpeg">
<span<?php echo $m_jadwalpegawai_delete->id_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_delete->id_jadwalpeg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
		<td <?php echo $m_jadwalpegawai_delete->tindakan_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_delete->RowCount ?>_m_jadwalpegawai_tindakan_jadwalpeg" class="m_jadwalpegawai_tindakan_jadwalpeg">
<span<?php echo $m_jadwalpegawai_delete->tindakan_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_delete->tindakan_jadwalpeg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->idpeg->Visible) { // idpeg ?>
		<td <?php echo $m_jadwalpegawai_delete->idpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_delete->RowCount ?>_m_jadwalpegawai_idpeg" class="m_jadwalpegawai_idpeg">
<span<?php echo $m_jadwalpegawai_delete->idpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_delete->idpeg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
		<td <?php echo $m_jadwalpegawai_delete->tanggal_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_delete->RowCount ?>_m_jadwalpegawai_tanggal_jadwalpeg" class="m_jadwalpegawai_tanggal_jadwalpeg">
<span<?php echo $m_jadwalpegawai_delete->tanggal_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_delete->tanggal_jadwalpeg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
		<td <?php echo $m_jadwalpegawai_delete->jam_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_delete->RowCount ?>_m_jadwalpegawai_jam_jadwalpeg" class="m_jadwalpegawai_jam_jadwalpeg">
<span<?php echo $m_jadwalpegawai_delete->jam_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_delete->jam_jadwalpeg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_jadwalpegawai_delete->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
		<td <?php echo $m_jadwalpegawai_delete->status_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_delete->RowCount ?>_m_jadwalpegawai_status_jadwalpeg" class="m_jadwalpegawai_status_jadwalpeg">
<span<?php echo $m_jadwalpegawai_delete->status_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_delete->status_jadwalpeg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_jadwalpegawai_delete->Recordset->moveNext();
}
$m_jadwalpegawai_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_jadwalpegawai_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_jadwalpegawai_delete->showPageFooter();
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
$m_jadwalpegawai_delete->terminate();
?>