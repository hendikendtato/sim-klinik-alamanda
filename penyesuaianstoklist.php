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
$penyesuaianstok_list = new penyesuaianstok_list();

// Run the page
$penyesuaianstok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaianstok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penyesuaianstok_list->isExport()) { ?>
<script>
var fpenyesuaianstoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenyesuaianstoklist = currentForm = new ew.Form("fpenyesuaianstoklist", "list");
	fpenyesuaianstoklist.formKeyCountName = '<?php echo $penyesuaianstok_list->FormKeyCountName ?>';
	loadjs.done("fpenyesuaianstoklist");
});
var fpenyesuaianstoklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenyesuaianstoklistsrch = currentSearchForm = new ew.Form("fpenyesuaianstoklistsrch");

	// Dynamic selection lists
	// Filters

	fpenyesuaianstoklistsrch.filterList = <?php echo $penyesuaianstok_list->getFilterList() ?>;
	loadjs.done("fpenyesuaianstoklistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","penyesuaianstokadd.php?showdetail=detailpenyesuaianstok"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide();
});
</script>
<?php } ?>
<?php if (!$penyesuaianstok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penyesuaianstok_list->TotalRecords > 0 && $penyesuaianstok_list->ExportOptions->visible()) { ?>
<?php $penyesuaianstok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penyesuaianstok_list->ImportOptions->visible()) { ?>
<?php $penyesuaianstok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penyesuaianstok_list->SearchOptions->visible()) { ?>
<?php $penyesuaianstok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penyesuaianstok_list->FilterOptions->visible()) { ?>
<?php $penyesuaianstok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penyesuaianstok_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$penyesuaianstok_list->isExport() && !$penyesuaianstok->CurrentAction) { ?>
<form name="fpenyesuaianstoklistsrch" id="fpenyesuaianstoklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpenyesuaianstoklistsrch-search-panel" class="<?php echo $penyesuaianstok_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penyesuaianstok">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $penyesuaianstok_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($penyesuaianstok_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($penyesuaianstok_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $penyesuaianstok_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($penyesuaianstok_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($penyesuaianstok_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($penyesuaianstok_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($penyesuaianstok_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $penyesuaianstok_list->showPageHeader(); ?>
<?php
$penyesuaianstok_list->showMessage();
?>
<?php if ($penyesuaianstok_list->TotalRecords > 0 || $penyesuaianstok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penyesuaianstok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penyesuaianstok">
<?php if (!$penyesuaianstok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$penyesuaianstok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penyesuaianstok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penyesuaianstok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpenyesuaianstoklist" id="fpenyesuaianstoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaianstok">
<div id="gmp_penyesuaianstok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penyesuaianstok_list->TotalRecords > 0 || $penyesuaianstok_list->isGridEdit()) { ?>
<table id="tbl_penyesuaianstoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penyesuaianstok->RowType = ROWTYPE_HEADER;

// Render list options
$penyesuaianstok_list->renderListOptions();

// Render list options (header, left)
$penyesuaianstok_list->ListOptions->render("header", "left");
?>
<?php if ($penyesuaianstok_list->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
	<?php if ($penyesuaianstok_list->SortUrl($penyesuaianstok_list->kode_penyesuaian) == "") { ?>
		<th data-name="kode_penyesuaian" class="<?php echo $penyesuaianstok_list->kode_penyesuaian->headerCellClass() ?>"><div id="elh_penyesuaianstok_kode_penyesuaian" class="penyesuaianstok_kode_penyesuaian"><div class="ew-table-header-caption"><?php echo $penyesuaianstok_list->kode_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penyesuaian" class="<?php echo $penyesuaianstok_list->kode_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaianstok_list->SortUrl($penyesuaianstok_list->kode_penyesuaian) ?>', 1);"><div id="elh_penyesuaianstok_kode_penyesuaian" class="penyesuaianstok_kode_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaianstok_list->kode_penyesuaian->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penyesuaianstok_list->kode_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaianstok_list->kode_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penyesuaianstok_list->tanggal->Visible) { // tanggal ?>
	<?php if ($penyesuaianstok_list->SortUrl($penyesuaianstok_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $penyesuaianstok_list->tanggal->headerCellClass() ?>"><div id="elh_penyesuaianstok_tanggal" class="penyesuaianstok_tanggal"><div class="ew-table-header-caption"><?php echo $penyesuaianstok_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $penyesuaianstok_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaianstok_list->SortUrl($penyesuaianstok_list->tanggal) ?>', 1);"><div id="elh_penyesuaianstok_tanggal" class="penyesuaianstok_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaianstok_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($penyesuaianstok_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaianstok_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penyesuaianstok_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($penyesuaianstok_list->SortUrl($penyesuaianstok_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $penyesuaianstok_list->id_klinik->headerCellClass() ?>"><div id="elh_penyesuaianstok_id_klinik" class="penyesuaianstok_id_klinik"><div class="ew-table-header-caption"><?php echo $penyesuaianstok_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $penyesuaianstok_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaianstok_list->SortUrl($penyesuaianstok_list->id_klinik) ?>', 1);"><div id="elh_penyesuaianstok_id_klinik" class="penyesuaianstok_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaianstok_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($penyesuaianstok_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaianstok_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penyesuaianstok_list->lampiran->Visible) { // lampiran ?>
	<?php if ($penyesuaianstok_list->SortUrl($penyesuaianstok_list->lampiran) == "") { ?>
		<th data-name="lampiran" class="<?php echo $penyesuaianstok_list->lampiran->headerCellClass() ?>"><div id="elh_penyesuaianstok_lampiran" class="penyesuaianstok_lampiran"><div class="ew-table-header-caption"><?php echo $penyesuaianstok_list->lampiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lampiran" class="<?php echo $penyesuaianstok_list->lampiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaianstok_list->SortUrl($penyesuaianstok_list->lampiran) ?>', 1);"><div id="elh_penyesuaianstok_lampiran" class="penyesuaianstok_lampiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaianstok_list->lampiran->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penyesuaianstok_list->lampiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaianstok_list->lampiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penyesuaianstok_list->keterangan->Visible) { // keterangan ?>
	<?php if ($penyesuaianstok_list->SortUrl($penyesuaianstok_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $penyesuaianstok_list->keterangan->headerCellClass() ?>"><div id="elh_penyesuaianstok_keterangan" class="penyesuaianstok_keterangan"><div class="ew-table-header-caption"><?php echo $penyesuaianstok_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $penyesuaianstok_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaianstok_list->SortUrl($penyesuaianstok_list->keterangan) ?>', 1);"><div id="elh_penyesuaianstok_keterangan" class="penyesuaianstok_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaianstok_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penyesuaianstok_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaianstok_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penyesuaianstok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penyesuaianstok_list->ExportAll && $penyesuaianstok_list->isExport()) {
	$penyesuaianstok_list->StopRecord = $penyesuaianstok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penyesuaianstok_list->TotalRecords > $penyesuaianstok_list->StartRecord + $penyesuaianstok_list->DisplayRecords - 1)
		$penyesuaianstok_list->StopRecord = $penyesuaianstok_list->StartRecord + $penyesuaianstok_list->DisplayRecords - 1;
	else
		$penyesuaianstok_list->StopRecord = $penyesuaianstok_list->TotalRecords;
}
$penyesuaianstok_list->RecordCount = $penyesuaianstok_list->StartRecord - 1;
if ($penyesuaianstok_list->Recordset && !$penyesuaianstok_list->Recordset->EOF) {
	$penyesuaianstok_list->Recordset->moveFirst();
	$selectLimit = $penyesuaianstok_list->UseSelectLimit;
	if (!$selectLimit && $penyesuaianstok_list->StartRecord > 1)
		$penyesuaianstok_list->Recordset->move($penyesuaianstok_list->StartRecord - 1);
} elseif (!$penyesuaianstok->AllowAddDeleteRow && $penyesuaianstok_list->StopRecord == 0) {
	$penyesuaianstok_list->StopRecord = $penyesuaianstok->GridAddRowCount;
}

// Initialize aggregate
$penyesuaianstok->RowType = ROWTYPE_AGGREGATEINIT;
$penyesuaianstok->resetAttributes();
$penyesuaianstok_list->renderRow();
while ($penyesuaianstok_list->RecordCount < $penyesuaianstok_list->StopRecord) {
	$penyesuaianstok_list->RecordCount++;
	if ($penyesuaianstok_list->RecordCount >= $penyesuaianstok_list->StartRecord) {
		$penyesuaianstok_list->RowCount++;

		// Set up key count
		$penyesuaianstok_list->KeyCount = $penyesuaianstok_list->RowIndex;

		// Init row class and style
		$penyesuaianstok->resetAttributes();
		$penyesuaianstok->CssClass = "";
		if ($penyesuaianstok_list->isGridAdd()) {
		} else {
			$penyesuaianstok_list->loadRowValues($penyesuaianstok_list->Recordset); // Load row values
		}
		$penyesuaianstok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penyesuaianstok->RowAttrs->merge(["data-rowindex" => $penyesuaianstok_list->RowCount, "id" => "r" . $penyesuaianstok_list->RowCount . "_penyesuaianstok", "data-rowtype" => $penyesuaianstok->RowType]);

		// Render row
		$penyesuaianstok_list->renderRow();

		// Render list options
		$penyesuaianstok_list->renderListOptions();
?>
	<tr <?php echo $penyesuaianstok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penyesuaianstok_list->ListOptions->render("body", "left", $penyesuaianstok_list->RowCount);
?>
	<?php if ($penyesuaianstok_list->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
		<td data-name="kode_penyesuaian" <?php echo $penyesuaianstok_list->kode_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_list->RowCount ?>_penyesuaianstok_kode_penyesuaian">
<span<?php echo $penyesuaianstok_list->kode_penyesuaian->viewAttributes() ?>><?php echo $penyesuaianstok_list->kode_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penyesuaianstok_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $penyesuaianstok_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_list->RowCount ?>_penyesuaianstok_tanggal">
<span<?php echo $penyesuaianstok_list->tanggal->viewAttributes() ?>><?php echo $penyesuaianstok_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penyesuaianstok_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $penyesuaianstok_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_list->RowCount ?>_penyesuaianstok_id_klinik">
<span<?php echo $penyesuaianstok_list->id_klinik->viewAttributes() ?>><?php echo $penyesuaianstok_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penyesuaianstok_list->lampiran->Visible) { // lampiran ?>
		<td data-name="lampiran" <?php echo $penyesuaianstok_list->lampiran->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_list->RowCount ?>_penyesuaianstok_lampiran">
<span<?php echo $penyesuaianstok_list->lampiran->viewAttributes() ?>><?php echo GetFileViewTag($penyesuaianstok_list->lampiran, $penyesuaianstok_list->lampiran->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penyesuaianstok_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $penyesuaianstok_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $penyesuaianstok_list->RowCount ?>_penyesuaianstok_keterangan">
<span<?php echo $penyesuaianstok_list->keterangan->viewAttributes() ?>><?php echo $penyesuaianstok_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penyesuaianstok_list->ListOptions->render("body", "right", $penyesuaianstok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penyesuaianstok_list->isGridAdd())
		$penyesuaianstok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penyesuaianstok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penyesuaianstok_list->Recordset)
	$penyesuaianstok_list->Recordset->Close();
?>
<?php if (!$penyesuaianstok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penyesuaianstok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penyesuaianstok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penyesuaianstok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penyesuaianstok_list->TotalRecords == 0 && !$penyesuaianstok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penyesuaianstok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penyesuaianstok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penyesuaianstok_list->isExport()) { ?>
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
$penyesuaianstok_list->terminate();
?>