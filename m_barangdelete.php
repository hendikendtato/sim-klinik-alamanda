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
$m_barang_delete = new m_barang_delete();

// Run the page
$m_barang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_barang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_barangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_barangdelete = currentForm = new ew.Form("fm_barangdelete", "delete");
	loadjs.done("fm_barangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_barang_delete->showPageHeader(); ?>
<?php
$m_barang_delete->showMessage();
?>
<form name="fm_barangdelete" id="fm_barangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_barang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_barang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_barang_delete->id->Visible) { // id ?>
		<th class="<?php echo $m_barang_delete->id->headerCellClass() ?>"><span id="elh_m_barang_id" class="m_barang_id"><?php echo $m_barang_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->kode_barang->Visible) { // kode_barang ?>
		<th class="<?php echo $m_barang_delete->kode_barang->headerCellClass() ?>"><span id="elh_m_barang_kode_barang" class="m_barang_kode_barang"><?php echo $m_barang_delete->kode_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->nama_barang->Visible) { // nama_barang ?>
		<th class="<?php echo $m_barang_delete->nama_barang->headerCellClass() ?>"><span id="elh_m_barang_nama_barang" class="m_barang_nama_barang"><?php echo $m_barang_delete->nama_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->satuan->Visible) { // satuan ?>
		<th class="<?php echo $m_barang_delete->satuan->headerCellClass() ?>"><span id="elh_m_barang_satuan" class="m_barang_satuan"><?php echo $m_barang_delete->satuan->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $m_barang_delete->jenis->headerCellClass() ?>"><span id="elh_m_barang_jenis" class="m_barang_jenis"><?php echo $m_barang_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->kategori->Visible) { // kategori ?>
		<th class="<?php echo $m_barang_delete->kategori->headerCellClass() ?>"><span id="elh_m_barang_kategori" class="m_barang_kategori"><?php echo $m_barang_delete->kategori->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->subkategori->Visible) { // subkategori ?>
		<th class="<?php echo $m_barang_delete->subkategori->headerCellClass() ?>"><span id="elh_m_barang_subkategori" class="m_barang_subkategori"><?php echo $m_barang_delete->subkategori->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->komposisi->Visible) { // komposisi ?>
		<th class="<?php echo $m_barang_delete->komposisi->headerCellClass() ?>"><span id="elh_m_barang_komposisi" class="m_barang_komposisi"><?php echo $m_barang_delete->komposisi->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->tipe->Visible) { // tipe ?>
		<th class="<?php echo $m_barang_delete->tipe->headerCellClass() ?>"><span id="elh_m_barang_tipe" class="m_barang_tipe"><?php echo $m_barang_delete->tipe->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->shortname_barang->Visible) { // shortname_barang ?>
		<th class="<?php echo $m_barang_delete->shortname_barang->headerCellClass() ?>"><span id="elh_m_barang_shortname_barang" class="m_barang_shortname_barang"><?php echo $m_barang_delete->shortname_barang->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->id_tag->Visible) { // id_tag ?>
		<th class="<?php echo $m_barang_delete->id_tag->headerCellClass() ?>"><span id="elh_m_barang_id_tag" class="m_barang_id_tag"><?php echo $m_barang_delete->id_tag->caption() ?></span></th>
<?php } ?>
<?php if ($m_barang_delete->discontinue->Visible) { // discontinue ?>
		<th class="<?php echo $m_barang_delete->discontinue->headerCellClass() ?>"><span id="elh_m_barang_discontinue" class="m_barang_discontinue"><?php echo $m_barang_delete->discontinue->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_barang_delete->RecordCount = 0;
$i = 0;
while (!$m_barang_delete->Recordset->EOF) {
	$m_barang_delete->RecordCount++;
	$m_barang_delete->RowCount++;

	// Set row properties
	$m_barang->resetAttributes();
	$m_barang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_barang_delete->loadRowValues($m_barang_delete->Recordset);

	// Render row
	$m_barang_delete->renderRow();
?>
	<tr <?php echo $m_barang->rowAttributes() ?>>
<?php if ($m_barang_delete->id->Visible) { // id ?>
		<td <?php echo $m_barang_delete->id->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_id" class="m_barang_id">
<span<?php echo $m_barang_delete->id->viewAttributes() ?>><?php echo $m_barang_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->kode_barang->Visible) { // kode_barang ?>
		<td <?php echo $m_barang_delete->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_kode_barang" class="m_barang_kode_barang">
<span<?php echo $m_barang_delete->kode_barang->viewAttributes() ?>><?php echo $m_barang_delete->kode_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->nama_barang->Visible) { // nama_barang ?>
		<td <?php echo $m_barang_delete->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_nama_barang" class="m_barang_nama_barang">
<span<?php echo $m_barang_delete->nama_barang->viewAttributes() ?>><?php echo $m_barang_delete->nama_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->satuan->Visible) { // satuan ?>
		<td <?php echo $m_barang_delete->satuan->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_satuan" class="m_barang_satuan">
<span<?php echo $m_barang_delete->satuan->viewAttributes() ?>><?php echo $m_barang_delete->satuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $m_barang_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_jenis" class="m_barang_jenis">
<span<?php echo $m_barang_delete->jenis->viewAttributes() ?>><?php echo $m_barang_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->kategori->Visible) { // kategori ?>
		<td <?php echo $m_barang_delete->kategori->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_kategori" class="m_barang_kategori">
<span<?php echo $m_barang_delete->kategori->viewAttributes() ?>><?php echo $m_barang_delete->kategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->subkategori->Visible) { // subkategori ?>
		<td <?php echo $m_barang_delete->subkategori->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_subkategori" class="m_barang_subkategori">
<span<?php echo $m_barang_delete->subkategori->viewAttributes() ?>><?php echo $m_barang_delete->subkategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->komposisi->Visible) { // komposisi ?>
		<td <?php echo $m_barang_delete->komposisi->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_komposisi" class="m_barang_komposisi">
<span<?php echo $m_barang_delete->komposisi->viewAttributes() ?>><?php echo $m_barang_delete->komposisi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->tipe->Visible) { // tipe ?>
		<td <?php echo $m_barang_delete->tipe->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_tipe" class="m_barang_tipe">
<span<?php echo $m_barang_delete->tipe->viewAttributes() ?>><?php echo $m_barang_delete->tipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->shortname_barang->Visible) { // shortname_barang ?>
		<td <?php echo $m_barang_delete->shortname_barang->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_shortname_barang" class="m_barang_shortname_barang">
<span<?php echo $m_barang_delete->shortname_barang->viewAttributes() ?>><?php echo $m_barang_delete->shortname_barang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->id_tag->Visible) { // id_tag ?>
		<td <?php echo $m_barang_delete->id_tag->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_id_tag" class="m_barang_id_tag">
<span<?php echo $m_barang_delete->id_tag->viewAttributes() ?>><?php echo $m_barang_delete->id_tag->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($m_barang_delete->discontinue->Visible) { // discontinue ?>
		<td <?php echo $m_barang_delete->discontinue->cellAttributes() ?>>
<span id="el<?php echo $m_barang_delete->RowCount ?>_m_barang_discontinue" class="m_barang_discontinue">
<span<?php echo $m_barang_delete->discontinue->viewAttributes() ?>><?php echo $m_barang_delete->discontinue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_barang_delete->Recordset->moveNext();
}
$m_barang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_barang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_barang_delete->showPageFooter();
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
$m_barang_delete->terminate();
?>