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
$m_pegawai_delete = new m_pegawai_delete();

// Run the page
$m_pegawai_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pegawai_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_pegawaidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_pegawaidelete = currentForm = new ew.Form("fm_pegawaidelete", "delete");
	loadjs.done("fm_pegawaidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_pegawai_delete->showPageHeader(); ?>
<?php
$m_pegawai_delete->showMessage();
?>
<form name="fm_pegawaidelete" id="fm_pegawaidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pegawai">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_pegawai_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_pegawai_delete->id_pegawai->Visible) { // id_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->id_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_id_pegawai" class="m_pegawai_id_pegawai"><?php echo $m_pegawai_delete->id_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->nama_pegawai->Visible) { // nama_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->nama_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_nama_pegawai" class="m_pegawai_nama_pegawai"><?php echo $m_pegawai_delete->nama_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->nama_lengkap->Visible) { // nama_lengkap ?>
		<th class="<?php echo $m_pegawai_delete->nama_lengkap->headerCellClass() ?>"><span id="elh_m_pegawai_nama_lengkap" class="m_pegawai_nama_lengkap"><?php echo $m_pegawai_delete->nama_lengkap->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->nik_pegawai->Visible) { // nik_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->nik_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_nik_pegawai" class="m_pegawai_nik_pegawai"><?php echo $m_pegawai_delete->nik_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->alamat_pegawai->Visible) { // alamat_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->alamat_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_alamat_pegawai" class="m_pegawai_alamat_pegawai"><?php echo $m_pegawai_delete->alamat_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->hp_pegawai->Visible) { // hp_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->hp_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_hp_pegawai" class="m_pegawai_hp_pegawai"><?php echo $m_pegawai_delete->hp_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->spesialis_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_spesialis_pegawai" class="m_pegawai_spesialis_pegawai"><?php echo $m_pegawai_delete->spesialis_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
		<th class="<?php echo $m_pegawai_delete->jabatan_pegawai->headerCellClass() ?>"><span id="elh_m_pegawai_jabatan_pegawai" class="m_pegawai_jabatan_pegawai"><?php echo $m_pegawai_delete->jabatan_pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->id_klinik->Visible) { // id_klinik ?>
		<th class="<?php echo $m_pegawai_delete->id_klinik->headerCellClass() ?>"><span id="elh_m_pegawai_id_klinik" class="m_pegawai_id_klinik"><?php echo $m_pegawai_delete->id_klinik->caption() ?></span></th>
<?php } ?>
<?php if ($m_pegawai_delete->nilai_komisi->Visible) { // nilai_komisi ?>
		<th class="<?php echo $m_pegawai_delete->nilai_komisi->headerCellClass() ?>"><span id="elh_m_pegawai_nilai_komisi" class="m_pegawai_nilai_komisi"><?php echo $m_pegawai_delete->nilai_komisi->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_pegawai_delete->RecordCount = 0;
$i = 0;
while (!$m_pegawai_delete->Recordset->EOF) {
	$m_pegawai_delete->RecordCount++;
	$m_pegawai_delete->RowCount++;

	// Set row properties
	$m_pegawai->resetAttributes();
	$m_pegawai->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_pegawai_delete->loadRowValues($m_pegawai_delete->Recordset);

	// Render row
	$m_pegawai_delete->renderRow();
?>
	<tr <?php echo $m_pegawai->rowAttributes() ?>>
<?php if ($m_pegawai_delete->id_pegawai->Visible) { // id_pegawai ?>
		<td <?php echo $m_pegawai_delete->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_id_pegawai" class="m_pegawai_id_pegawai">
<span<?php echo $m_pegawai_delete->id_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->id_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->nama_pegawai->Visible) { // nama_pegawai ?>
		<td <?php echo $m_pegawai_delete->nama_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_nama_pegawai" class="m_pegawai_nama_pegawai">
<span<?php echo $m_pegawai_delete->nama_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->nama_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->nama_lengkap->Visible) { // nama_lengkap ?>
		<td <?php echo $m_pegawai_delete->nama_lengkap->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_nama_lengkap" class="m_pegawai_nama_lengkap">
<span<?php echo $m_pegawai_delete->nama_lengkap->viewAttributes() ?>><?php echo $m_pegawai_delete->nama_lengkap->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->nik_pegawai->Visible) { // nik_pegawai ?>
		<td <?php echo $m_pegawai_delete->nik_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_nik_pegawai" class="m_pegawai_nik_pegawai">
<span<?php echo $m_pegawai_delete->nik_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->nik_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->alamat_pegawai->Visible) { // alamat_pegawai ?>
		<td <?php echo $m_pegawai_delete->alamat_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_alamat_pegawai" class="m_pegawai_alamat_pegawai">
<span<?php echo $m_pegawai_delete->alamat_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->alamat_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->hp_pegawai->Visible) { // hp_pegawai ?>
		<td <?php echo $m_pegawai_delete->hp_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_hp_pegawai" class="m_pegawai_hp_pegawai">
<span<?php echo $m_pegawai_delete->hp_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->hp_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
		<td <?php echo $m_pegawai_delete->spesialis_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_spesialis_pegawai" class="m_pegawai_spesialis_pegawai">
<span<?php echo $m_pegawai_delete->spesialis_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->spesialis_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
		<td <?php echo $m_pegawai_delete->jabatan_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_jabatan_pegawai" class="m_pegawai_jabatan_pegawai">
<span<?php echo $m_pegawai_delete->jabatan_pegawai->viewAttributes() ?>><?php echo $m_pegawai_delete->jabatan_pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->id_klinik->Visible) { // id_klinik ?>
		<td <?php echo $m_pegawai_delete->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_id_klinik" class="m_pegawai_id_klinik">
<span<?php echo $m_pegawai_delete->id_klinik->viewAttributes() ?>><?php echo $m_pegawai_delete->id_klinik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pegawai_delete->nilai_komisi->Visible) { // nilai_komisi ?>
		<td <?php echo $m_pegawai_delete->nilai_komisi->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_delete->RowCount ?>_m_pegawai_nilai_komisi" class="m_pegawai_nilai_komisi">
<span<?php echo $m_pegawai_delete->nilai_komisi->viewAttributes() ?>><?php echo $m_pegawai_delete->nilai_komisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_pegawai_delete->Recordset->moveNext();
}
$m_pegawai_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_pegawai_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_pegawai_delete->showPageFooter();
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
$m_pegawai_delete->terminate();
?>