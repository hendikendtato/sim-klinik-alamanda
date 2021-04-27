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
$m_pelanggan_delete = new m_pelanggan_delete();

// Run the page
$m_pelanggan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pelanggan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_pelanggandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_pelanggandelete = currentForm = new ew.Form("fm_pelanggandelete", "delete");
	loadjs.done("fm_pelanggandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_pelanggan_delete->showPageHeader(); ?>
<?php
$m_pelanggan_delete->showMessage();
?>
<form name="fm_pelanggandelete" id="fm_pelanggandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pelanggan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_pelanggan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_pelanggan_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->id_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_id_pelanggan" class="m_pelanggan_id_pelanggan"><?php echo $m_pelanggan_delete->id_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->kode_pelanggan->Visible) { // kode_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->kode_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_kode_pelanggan" class="m_pelanggan_kode_pelanggan"><?php echo $m_pelanggan_delete->kode_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->noktp_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_noktp_pelanggan" class="m_pelanggan_noktp_pelanggan"><?php echo $m_pelanggan_delete->noktp_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->nama_pelanggan->Visible) { // nama_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->nama_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_nama_pelanggan" class="m_pelanggan_nama_pelanggan"><?php echo $m_pelanggan_delete->nama_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->jenis_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_jenis_pelanggan" class="m_pelanggan_jenis_pelanggan"><?php echo $m_pelanggan_delete->jenis_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->alamat_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_alamat_pelanggan" class="m_pelanggan_alamat_pelanggan"><?php echo $m_pelanggan_delete->alamat_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->telpon_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_telpon_pelanggan" class="m_pelanggan_telpon_pelanggan"><?php echo $m_pelanggan_delete->telpon_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->hp_pelanggan->Visible) { // hp_pelanggan ?>
		<th class="<?php echo $m_pelanggan_delete->hp_pelanggan->headerCellClass() ?>"><span id="elh_m_pelanggan_hp_pelanggan" class="m_pelanggan_hp_pelanggan"><?php echo $m_pelanggan_delete->hp_pelanggan->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->tgl_daftar->Visible) { // tgl_daftar ?>
		<th class="<?php echo $m_pelanggan_delete->tgl_daftar->headerCellClass() ?>"><span id="elh_m_pelanggan_tgl_daftar" class="m_pelanggan_tgl_daftar"><?php echo $m_pelanggan_delete->tgl_daftar->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->kategori->Visible) { // kategori ?>
		<th class="<?php echo $m_pelanggan_delete->kategori->headerCellClass() ?>"><span id="elh_m_pelanggan_kategori" class="m_pelanggan_kategori"><?php echo $m_pelanggan_delete->kategori->caption() ?></span></th>
<?php } ?>
<?php if ($m_pelanggan_delete->tipe->Visible) { // tipe ?>
		<th class="<?php echo $m_pelanggan_delete->tipe->headerCellClass() ?>"><span id="elh_m_pelanggan_tipe" class="m_pelanggan_tipe"><?php echo $m_pelanggan_delete->tipe->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_pelanggan_delete->RecordCount = 0;
$i = 0;
while (!$m_pelanggan_delete->Recordset->EOF) {
	$m_pelanggan_delete->RecordCount++;
	$m_pelanggan_delete->RowCount++;

	// Set row properties
	$m_pelanggan->resetAttributes();
	$m_pelanggan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_pelanggan_delete->loadRowValues($m_pelanggan_delete->Recordset);

	// Render row
	$m_pelanggan_delete->renderRow();
?>
	<tr <?php echo $m_pelanggan->rowAttributes() ?>>
<?php if ($m_pelanggan_delete->id_pelanggan->Visible) { // id_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_id_pelanggan" class="m_pelanggan_id_pelanggan">
<span<?php echo $m_pelanggan_delete->id_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->id_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->kode_pelanggan->Visible) { // kode_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->kode_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_kode_pelanggan" class="m_pelanggan_kode_pelanggan">
<span<?php echo $m_pelanggan_delete->kode_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->kode_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->noktp_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_noktp_pelanggan" class="m_pelanggan_noktp_pelanggan">
<span<?php echo $m_pelanggan_delete->noktp_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->noktp_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->nama_pelanggan->Visible) { // nama_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->nama_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_nama_pelanggan" class="m_pelanggan_nama_pelanggan">
<span<?php echo $m_pelanggan_delete->nama_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->nama_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->jenis_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_jenis_pelanggan" class="m_pelanggan_jenis_pelanggan">
<span<?php echo $m_pelanggan_delete->jenis_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->jenis_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->alamat_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_alamat_pelanggan" class="m_pelanggan_alamat_pelanggan">
<span<?php echo $m_pelanggan_delete->alamat_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->alamat_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->telpon_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_telpon_pelanggan" class="m_pelanggan_telpon_pelanggan">
<span<?php echo $m_pelanggan_delete->telpon_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->telpon_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->hp_pelanggan->Visible) { // hp_pelanggan ?>
		<td <?php echo $m_pelanggan_delete->hp_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_hp_pelanggan" class="m_pelanggan_hp_pelanggan">
<span<?php echo $m_pelanggan_delete->hp_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_delete->hp_pelanggan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->tgl_daftar->Visible) { // tgl_daftar ?>
		<td <?php echo $m_pelanggan_delete->tgl_daftar->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_tgl_daftar" class="m_pelanggan_tgl_daftar">
<span<?php echo $m_pelanggan_delete->tgl_daftar->viewAttributes() ?>><?php echo $m_pelanggan_delete->tgl_daftar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->kategori->Visible) { // kategori ?>
		<td <?php echo $m_pelanggan_delete->kategori->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_kategori" class="m_pelanggan_kategori">
<span<?php echo $m_pelanggan_delete->kategori->viewAttributes() ?>><?php echo $m_pelanggan_delete->kategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_pelanggan_delete->tipe->Visible) { // tipe ?>
		<td <?php echo $m_pelanggan_delete->tipe->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_delete->RowCount ?>_m_pelanggan_tipe" class="m_pelanggan_tipe">
<span<?php echo $m_pelanggan_delete->tipe->viewAttributes() ?>><?php echo $m_pelanggan_delete->tipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_pelanggan_delete->Recordset->moveNext();
}
$m_pelanggan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_pelanggan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_pelanggan_delete->showPageFooter();
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
$m_pelanggan_delete->terminate();
?>