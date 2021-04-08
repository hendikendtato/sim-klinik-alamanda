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
$detailpenyesuaianstok_list = new detailpenyesuaianstok_list();

// Run the page
$detailpenyesuaianstok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianstok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpenyesuaianstok_list->isExport()) { ?>
<script>
var fdetailpenyesuaianstoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailpenyesuaianstoklist = currentForm = new ew.Form("fdetailpenyesuaianstoklist", "list");
	fdetailpenyesuaianstoklist.formKeyCountName = '<?php echo $detailpenyesuaianstok_list->FormKeyCountName ?>';
	loadjs.done("fdetailpenyesuaianstoklist");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailpenyesuaianstok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailpenyesuaianstok_list->TotalRecords > 0 && $detailpenyesuaianstok_list->ExportOptions->visible()) { ?>
<?php $detailpenyesuaianstok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_list->ImportOptions->visible()) { ?>
<?php $detailpenyesuaianstok_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailpenyesuaianstok_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailpenyesuaianstok_list->isExport("print")) { ?>
<?php
if ($detailpenyesuaianstok_list->DbMasterFilter != "" && $detailpenyesuaianstok->getCurrentMasterTable() == "penyesuaianstok") {
	if ($detailpenyesuaianstok_list->MasterRecordExists) {
		include_once "penyesuaianstokmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailpenyesuaianstok_list->renderOtherOptions();
?>
<?php $detailpenyesuaianstok_list->showPageHeader(); ?>
<?php
$detailpenyesuaianstok_list->showMessage();
?>
<?php if ($detailpenyesuaianstok_list->TotalRecords > 0 || $detailpenyesuaianstok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpenyesuaianstok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpenyesuaianstok">
<?php if (!$detailpenyesuaianstok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailpenyesuaianstok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpenyesuaianstok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianstok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailpenyesuaianstoklist" id="fdetailpenyesuaianstoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianstok">
<?php if ($detailpenyesuaianstok->getCurrentMasterTable() == "penyesuaianstok" && $detailpenyesuaianstok->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="penyesuaianstok">
<input type="hidden" name="fk_id_penyesuaianstok" value="<?php echo HtmlEncode($detailpenyesuaianstok_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailpenyesuaianstok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailpenyesuaianstok_list->TotalRecords > 0 || $detailpenyesuaianstok_list->isGridEdit()) { ?>
<table id="tbl_detailpenyesuaianstoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpenyesuaianstok->RowType = ROWTYPE_HEADER;

// Render list options
$detailpenyesuaianstok_list->renderListOptions();

// Render list options (header, left)
$detailpenyesuaianstok_list->ListOptions->render("header", "left");
?>
<?php if ($detailpenyesuaianstok_list->kode_barang->Visible) { // kode_barang ?>
	<?php if ($detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenyesuaianstok_list->kode_barang->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_kode_barang" class="detailpenyesuaianstok_kode_barang"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenyesuaianstok_list->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->kode_barang) ?>', 1);"><div id="elh_detailpenyesuaianstok_kode_barang" class="detailpenyesuaianstok_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->kode_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_list->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_list->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailpenyesuaianstok_list->id_barang->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_id_barang" class="detailpenyesuaianstok_id_barang"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailpenyesuaianstok_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->id_barang) ?>', 1);"><div id="elh_detailpenyesuaianstok_id_barang" class="detailpenyesuaianstok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_list->stokdatabase->Visible) { // stokdatabase ?>
	<?php if ($detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->stokdatabase) == "") { ?>
		<th data-name="stokdatabase" class="<?php echo $detailpenyesuaianstok_list->stokdatabase->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_stokdatabase" class="detailpenyesuaianstok_stokdatabase"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->stokdatabase->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stokdatabase" class="<?php echo $detailpenyesuaianstok_list->stokdatabase->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->stokdatabase) ?>', 1);"><div id="elh_detailpenyesuaianstok_stokdatabase" class="detailpenyesuaianstok_stokdatabase">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->stokdatabase->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_list->stokdatabase->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_list->stokdatabase->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailpenyesuaianstok_list->jumlah->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_jumlah" class="detailpenyesuaianstok_jumlah"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailpenyesuaianstok_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->jumlah) ?>', 1);"><div id="elh_detailpenyesuaianstok_jumlah" class="detailpenyesuaianstok_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_list->selisih->Visible) { // selisih ?>
	<?php if ($detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->selisih) == "") { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianstok_list->selisih->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_selisih" class="detailpenyesuaianstok_selisih"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->selisih->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianstok_list->selisih->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->selisih) ?>', 1);"><div id="elh_detailpenyesuaianstok_selisih" class="detailpenyesuaianstok_selisih">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->selisih->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_list->selisih->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_list->selisih->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_list->tipe->Visible) { // tipe ?>
	<?php if ($detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianstok_list->tipe->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_tipe" class="detailpenyesuaianstok_tipe"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianstok_list->tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianstok_list->SortUrl($detailpenyesuaianstok_list->tipe) ?>', 1);"><div id="elh_detailpenyesuaianstok_tipe" class="detailpenyesuaianstok_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_list->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_list->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_list->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenyesuaianstok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailpenyesuaianstok_list->ExportAll && $detailpenyesuaianstok_list->isExport()) {
	$detailpenyesuaianstok_list->StopRecord = $detailpenyesuaianstok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailpenyesuaianstok_list->TotalRecords > $detailpenyesuaianstok_list->StartRecord + $detailpenyesuaianstok_list->DisplayRecords - 1)
		$detailpenyesuaianstok_list->StopRecord = $detailpenyesuaianstok_list->StartRecord + $detailpenyesuaianstok_list->DisplayRecords - 1;
	else
		$detailpenyesuaianstok_list->StopRecord = $detailpenyesuaianstok_list->TotalRecords;
}
$detailpenyesuaianstok_list->RecordCount = $detailpenyesuaianstok_list->StartRecord - 1;
if ($detailpenyesuaianstok_list->Recordset && !$detailpenyesuaianstok_list->Recordset->EOF) {
	$detailpenyesuaianstok_list->Recordset->moveFirst();
	$selectLimit = $detailpenyesuaianstok_list->UseSelectLimit;
	if (!$selectLimit && $detailpenyesuaianstok_list->StartRecord > 1)
		$detailpenyesuaianstok_list->Recordset->move($detailpenyesuaianstok_list->StartRecord - 1);
} elseif (!$detailpenyesuaianstok->AllowAddDeleteRow && $detailpenyesuaianstok_list->StopRecord == 0) {
	$detailpenyesuaianstok_list->StopRecord = $detailpenyesuaianstok->GridAddRowCount;
}

// Initialize aggregate
$detailpenyesuaianstok->RowType = ROWTYPE_AGGREGATEINIT;
$detailpenyesuaianstok->resetAttributes();
$detailpenyesuaianstok_list->renderRow();
while ($detailpenyesuaianstok_list->RecordCount < $detailpenyesuaianstok_list->StopRecord) {
	$detailpenyesuaianstok_list->RecordCount++;
	if ($detailpenyesuaianstok_list->RecordCount >= $detailpenyesuaianstok_list->StartRecord) {
		$detailpenyesuaianstok_list->RowCount++;

		// Set up key count
		$detailpenyesuaianstok_list->KeyCount = $detailpenyesuaianstok_list->RowIndex;

		// Init row class and style
		$detailpenyesuaianstok->resetAttributes();
		$detailpenyesuaianstok->CssClass = "";
		if ($detailpenyesuaianstok_list->isGridAdd()) {
		} else {
			$detailpenyesuaianstok_list->loadRowValues($detailpenyesuaianstok_list->Recordset); // Load row values
		}
		$detailpenyesuaianstok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailpenyesuaianstok->RowAttrs->merge(["data-rowindex" => $detailpenyesuaianstok_list->RowCount, "id" => "r" . $detailpenyesuaianstok_list->RowCount . "_detailpenyesuaianstok", "data-rowtype" => $detailpenyesuaianstok->RowType]);

		// Render row
		$detailpenyesuaianstok_list->renderRow();

		// Render list options
		$detailpenyesuaianstok_list->renderListOptions();
?>
	<tr <?php echo $detailpenyesuaianstok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianstok_list->ListOptions->render("body", "left", $detailpenyesuaianstok_list->RowCount);
?>
	<?php if ($detailpenyesuaianstok_list->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $detailpenyesuaianstok_list->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_list->RowCount ?>_detailpenyesuaianstok_kode_barang">
<span<?php echo $detailpenyesuaianstok_list->kode_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_list->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailpenyesuaianstok_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_list->RowCount ?>_detailpenyesuaianstok_id_barang">
<span<?php echo $detailpenyesuaianstok_list->id_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_list->stokdatabase->Visible) { // stokdatabase ?>
		<td data-name="stokdatabase" <?php echo $detailpenyesuaianstok_list->stokdatabase->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_list->RowCount ?>_detailpenyesuaianstok_stokdatabase">
<span<?php echo $detailpenyesuaianstok_list->stokdatabase->viewAttributes() ?>><?php echo $detailpenyesuaianstok_list->stokdatabase->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailpenyesuaianstok_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_list->RowCount ?>_detailpenyesuaianstok_jumlah">
<span<?php echo $detailpenyesuaianstok_list->jumlah->viewAttributes() ?>><?php echo $detailpenyesuaianstok_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_list->selisih->Visible) { // selisih ?>
		<td data-name="selisih" <?php echo $detailpenyesuaianstok_list->selisih->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_list->RowCount ?>_detailpenyesuaianstok_selisih">
<span<?php echo $detailpenyesuaianstok_list->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianstok_list->selisih->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_list->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $detailpenyesuaianstok_list->tipe->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianstok_list->RowCount ?>_detailpenyesuaianstok_tipe">
<span<?php echo $detailpenyesuaianstok_list->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianstok_list->tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianstok_list->ListOptions->render("body", "right", $detailpenyesuaianstok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailpenyesuaianstok_list->isGridAdd())
		$detailpenyesuaianstok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailpenyesuaianstok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpenyesuaianstok_list->Recordset)
	$detailpenyesuaianstok_list->Recordset->Close();
?>
<?php if (!$detailpenyesuaianstok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailpenyesuaianstok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpenyesuaianstok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianstok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpenyesuaianstok_list->TotalRecords == 0 && !$detailpenyesuaianstok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianstok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailpenyesuaianstok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpenyesuaianstok_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$detailpenyesuaianstok_list->terminate();
?>