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
$detailmutasibank_list = new detailmutasibank_list();

// Run the page
$detailmutasibank_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmutasibank_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailmutasibank_list->isExport()) { ?>
<script>
var fdetailmutasibanklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailmutasibanklist = currentForm = new ew.Form("fdetailmutasibanklist", "list");
	fdetailmutasibanklist.formKeyCountName = '<?php echo $detailmutasibank_list->FormKeyCountName ?>';
	loadjs.done("fdetailmutasibanklist");
});
var fdetailmutasibanklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailmutasibanklistsrch = currentSearchForm = new ew.Form("fdetailmutasibanklistsrch");

	// Dynamic selection lists
	// Filters

	fdetailmutasibanklistsrch.filterList = <?php echo $detailmutasibank_list->getFilterList() ?>;
	loadjs.done("fdetailmutasibanklistsrch");
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
<?php if (!$detailmutasibank_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailmutasibank_list->TotalRecords > 0 && $detailmutasibank_list->ExportOptions->visible()) { ?>
<?php $detailmutasibank_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailmutasibank_list->ImportOptions->visible()) { ?>
<?php $detailmutasibank_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailmutasibank_list->SearchOptions->visible()) { ?>
<?php $detailmutasibank_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailmutasibank_list->FilterOptions->visible()) { ?>
<?php $detailmutasibank_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailmutasibank_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailmutasibank_list->isExport("print")) { ?>
<?php
if ($detailmutasibank_list->DbMasterFilter != "" && $detailmutasibank->getCurrentMasterTable() == "mutasi_kas") {
	if ($detailmutasibank_list->MasterRecordExists) {
		include_once "mutasi_kasmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailmutasibank_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailmutasibank_list->isExport() && !$detailmutasibank->CurrentAction) { ?>
<form name="fdetailmutasibanklistsrch" id="fdetailmutasibanklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailmutasibanklistsrch-search-panel" class="<?php echo $detailmutasibank_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailmutasibank">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $detailmutasibank_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($detailmutasibank_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($detailmutasibank_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $detailmutasibank_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($detailmutasibank_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($detailmutasibank_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($detailmutasibank_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($detailmutasibank_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailmutasibank_list->showPageHeader(); ?>
<?php
$detailmutasibank_list->showMessage();
?>
<?php if ($detailmutasibank_list->TotalRecords > 0 || $detailmutasibank->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailmutasibank_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailmutasibank">
<?php if (!$detailmutasibank_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailmutasibank_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailmutasibank_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailmutasibank_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailmutasibanklist" id="fdetailmutasibanklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmutasibank">
<?php if ($detailmutasibank->getCurrentMasterTable() == "mutasi_kas" && $detailmutasibank->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="mutasi_kas">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailmutasibank_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailmutasibank" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailmutasibank_list->TotalRecords > 0 || $detailmutasibank_list->isGridEdit()) { ?>
<table id="tbl_detailmutasibanklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailmutasibank->RowType = ROWTYPE_HEADER;

// Render list options
$detailmutasibank_list->renderListOptions();

// Render list options (header, left)
$detailmutasibank_list->ListOptions->render("header", "left");
?>
<?php if ($detailmutasibank_list->akun_id->Visible) { // akun_id ?>
	<?php if ($detailmutasibank_list->SortUrl($detailmutasibank_list->akun_id) == "") { ?>
		<th data-name="akun_id" class="<?php echo $detailmutasibank_list->akun_id->headerCellClass() ?>"><div id="elh_detailmutasibank_akun_id" class="detailmutasibank_akun_id"><div class="ew-table-header-caption"><?php echo $detailmutasibank_list->akun_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="akun_id" class="<?php echo $detailmutasibank_list->akun_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmutasibank_list->SortUrl($detailmutasibank_list->akun_id) ?>', 1);"><div id="elh_detailmutasibank_akun_id" class="detailmutasibank_akun_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_list->akun_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_list->akun_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_list->akun_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_list->nama_akun->Visible) { // nama_akun ?>
	<?php if ($detailmutasibank_list->SortUrl($detailmutasibank_list->nama_akun) == "") { ?>
		<th data-name="nama_akun" class="<?php echo $detailmutasibank_list->nama_akun->headerCellClass() ?>"><div id="elh_detailmutasibank_nama_akun" class="detailmutasibank_nama_akun"><div class="ew-table-header-caption"><?php echo $detailmutasibank_list->nama_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_akun" class="<?php echo $detailmutasibank_list->nama_akun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmutasibank_list->SortUrl($detailmutasibank_list->nama_akun) ?>', 1);"><div id="elh_detailmutasibank_nama_akun" class="detailmutasibank_nama_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_list->nama_akun->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_list->nama_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_list->nama_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailmutasibank_list->SortUrl($detailmutasibank_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailmutasibank_list->jumlah->headerCellClass() ?>"><div id="elh_detailmutasibank_jumlah" class="detailmutasibank_jumlah"><div class="ew-table-header-caption"><?php echo $detailmutasibank_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailmutasibank_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmutasibank_list->SortUrl($detailmutasibank_list->jumlah) ?>', 1);"><div id="elh_detailmutasibank_jumlah" class="detailmutasibank_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_list->keterangan->Visible) { // keterangan ?>
	<?php if ($detailmutasibank_list->SortUrl($detailmutasibank_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $detailmutasibank_list->keterangan->headerCellClass() ?>"><div id="elh_detailmutasibank_keterangan" class="detailmutasibank_keterangan"><div class="ew-table-header-caption"><?php echo $detailmutasibank_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $detailmutasibank_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmutasibank_list->SortUrl($detailmutasibank_list->keterangan) ?>', 1);"><div id="elh_detailmutasibank_keterangan" class="detailmutasibank_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_list->tipe_mutasi->Visible) { // tipe_mutasi ?>
	<?php if ($detailmutasibank_list->SortUrl($detailmutasibank_list->tipe_mutasi) == "") { ?>
		<th data-name="tipe_mutasi" class="<?php echo $detailmutasibank_list->tipe_mutasi->headerCellClass() ?>"><div id="elh_detailmutasibank_tipe_mutasi" class="detailmutasibank_tipe_mutasi"><div class="ew-table-header-caption"><?php echo $detailmutasibank_list->tipe_mutasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe_mutasi" class="<?php echo $detailmutasibank_list->tipe_mutasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmutasibank_list->SortUrl($detailmutasibank_list->tipe_mutasi) ?>', 1);"><div id="elh_detailmutasibank_tipe_mutasi" class="detailmutasibank_tipe_mutasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_list->tipe_mutasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_list->tipe_mutasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_list->tipe_mutasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailmutasibank_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailmutasibank_list->ExportAll && $detailmutasibank_list->isExport()) {
	$detailmutasibank_list->StopRecord = $detailmutasibank_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailmutasibank_list->TotalRecords > $detailmutasibank_list->StartRecord + $detailmutasibank_list->DisplayRecords - 1)
		$detailmutasibank_list->StopRecord = $detailmutasibank_list->StartRecord + $detailmutasibank_list->DisplayRecords - 1;
	else
		$detailmutasibank_list->StopRecord = $detailmutasibank_list->TotalRecords;
}
$detailmutasibank_list->RecordCount = $detailmutasibank_list->StartRecord - 1;
if ($detailmutasibank_list->Recordset && !$detailmutasibank_list->Recordset->EOF) {
	$detailmutasibank_list->Recordset->moveFirst();
	$selectLimit = $detailmutasibank_list->UseSelectLimit;
	if (!$selectLimit && $detailmutasibank_list->StartRecord > 1)
		$detailmutasibank_list->Recordset->move($detailmutasibank_list->StartRecord - 1);
} elseif (!$detailmutasibank->AllowAddDeleteRow && $detailmutasibank_list->StopRecord == 0) {
	$detailmutasibank_list->StopRecord = $detailmutasibank->GridAddRowCount;
}

// Initialize aggregate
$detailmutasibank->RowType = ROWTYPE_AGGREGATEINIT;
$detailmutasibank->resetAttributes();
$detailmutasibank_list->renderRow();
while ($detailmutasibank_list->RecordCount < $detailmutasibank_list->StopRecord) {
	$detailmutasibank_list->RecordCount++;
	if ($detailmutasibank_list->RecordCount >= $detailmutasibank_list->StartRecord) {
		$detailmutasibank_list->RowCount++;

		// Set up key count
		$detailmutasibank_list->KeyCount = $detailmutasibank_list->RowIndex;

		// Init row class and style
		$detailmutasibank->resetAttributes();
		$detailmutasibank->CssClass = "";
		if ($detailmutasibank_list->isGridAdd()) {
		} else {
			$detailmutasibank_list->loadRowValues($detailmutasibank_list->Recordset); // Load row values
		}
		$detailmutasibank->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailmutasibank->RowAttrs->merge(["data-rowindex" => $detailmutasibank_list->RowCount, "id" => "r" . $detailmutasibank_list->RowCount . "_detailmutasibank", "data-rowtype" => $detailmutasibank->RowType]);

		// Render row
		$detailmutasibank_list->renderRow();

		// Render list options
		$detailmutasibank_list->renderListOptions();
?>
	<tr <?php echo $detailmutasibank->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmutasibank_list->ListOptions->render("body", "left", $detailmutasibank_list->RowCount);
?>
	<?php if ($detailmutasibank_list->akun_id->Visible) { // akun_id ?>
		<td data-name="akun_id" <?php echo $detailmutasibank_list->akun_id->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_list->RowCount ?>_detailmutasibank_akun_id">
<span<?php echo $detailmutasibank_list->akun_id->viewAttributes() ?>><?php echo $detailmutasibank_list->akun_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_list->nama_akun->Visible) { // nama_akun ?>
		<td data-name="nama_akun" <?php echo $detailmutasibank_list->nama_akun->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_list->RowCount ?>_detailmutasibank_nama_akun">
<span<?php echo $detailmutasibank_list->nama_akun->viewAttributes() ?>><?php echo $detailmutasibank_list->nama_akun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailmutasibank_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_list->RowCount ?>_detailmutasibank_jumlah">
<span<?php echo $detailmutasibank_list->jumlah->viewAttributes() ?>><?php echo $detailmutasibank_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $detailmutasibank_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_list->RowCount ?>_detailmutasibank_keterangan">
<span<?php echo $detailmutasibank_list->keterangan->viewAttributes() ?>><?php echo $detailmutasibank_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_list->tipe_mutasi->Visible) { // tipe_mutasi ?>
		<td data-name="tipe_mutasi" <?php echo $detailmutasibank_list->tipe_mutasi->cellAttributes() ?>>
<span id="el<?php echo $detailmutasibank_list->RowCount ?>_detailmutasibank_tipe_mutasi">
<span<?php echo $detailmutasibank_list->tipe_mutasi->viewAttributes() ?>><?php echo $detailmutasibank_list->tipe_mutasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailmutasibank_list->ListOptions->render("body", "right", $detailmutasibank_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailmutasibank_list->isGridAdd())
		$detailmutasibank_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailmutasibank->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailmutasibank_list->Recordset)
	$detailmutasibank_list->Recordset->Close();
?>
<?php if (!$detailmutasibank_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailmutasibank_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailmutasibank_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailmutasibank_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailmutasibank_list->TotalRecords == 0 && !$detailmutasibank->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailmutasibank_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailmutasibank_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailmutasibank_list->isExport()) { ?>
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
$detailmutasibank_list->terminate();
?>