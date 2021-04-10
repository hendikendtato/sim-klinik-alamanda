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
$m_satuan_barang_list = new m_satuan_barang_list();

// Run the page
$m_satuan_barang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_satuan_barang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_satuan_barang_list->isExport()) { ?>
<script>
var fm_satuan_baranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_satuan_baranglist = currentForm = new ew.Form("fm_satuan_baranglist", "list");
	fm_satuan_baranglist.formKeyCountName = '<?php echo $m_satuan_barang_list->FormKeyCountName ?>';
	loadjs.done("fm_satuan_baranglist");
});
var fm_satuan_baranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_satuan_baranglistsrch = currentSearchForm = new ew.Form("fm_satuan_baranglistsrch");

	// Dynamic selection lists
	// Filters

	fm_satuan_baranglistsrch.filterList = <?php echo $m_satuan_barang_list->getFilterList() ?>;
	loadjs.done("fm_satuan_baranglistsrch");
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
<?php if (!$m_satuan_barang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_satuan_barang_list->TotalRecords > 0 && $m_satuan_barang_list->ExportOptions->visible()) { ?>
<?php $m_satuan_barang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_satuan_barang_list->ImportOptions->visible()) { ?>
<?php $m_satuan_barang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_satuan_barang_list->SearchOptions->visible()) { ?>
<?php $m_satuan_barang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_satuan_barang_list->FilterOptions->visible()) { ?>
<?php $m_satuan_barang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_satuan_barang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_satuan_barang_list->isExport() && !$m_satuan_barang->CurrentAction) { ?>
<form name="fm_satuan_baranglistsrch" id="fm_satuan_baranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_satuan_baranglistsrch-search-panel" class="<?php echo $m_satuan_barang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_satuan_barang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_satuan_barang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_satuan_barang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_satuan_barang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_satuan_barang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_satuan_barang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_satuan_barang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_satuan_barang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_satuan_barang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_satuan_barang_list->showPageHeader(); ?>
<?php
$m_satuan_barang_list->showMessage();
?>
<?php if ($m_satuan_barang_list->TotalRecords > 0 || $m_satuan_barang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_satuan_barang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_satuan_barang">
<?php if (!$m_satuan_barang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_satuan_barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_satuan_barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_satuan_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_satuan_baranglist" id="fm_satuan_baranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_satuan_barang">
<div id="gmp_m_satuan_barang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_satuan_barang_list->TotalRecords > 0 || $m_satuan_barang_list->isGridEdit()) { ?>
<table id="tbl_m_satuan_baranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_satuan_barang->RowType = ROWTYPE_HEADER;

// Render list options
$m_satuan_barang_list->renderListOptions();

// Render list options (header, left)
$m_satuan_barang_list->ListOptions->render("header", "left");
?>
<?php if ($m_satuan_barang_list->kode_satuan->Visible) { // kode_satuan ?>
	<?php if ($m_satuan_barang_list->SortUrl($m_satuan_barang_list->kode_satuan) == "") { ?>
		<th data-name="kode_satuan" class="<?php echo $m_satuan_barang_list->kode_satuan->headerCellClass() ?>"><div id="elh_m_satuan_barang_kode_satuan" class="m_satuan_barang_kode_satuan"><div class="ew-table-header-caption"><?php echo $m_satuan_barang_list->kode_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_satuan" class="<?php echo $m_satuan_barang_list->kode_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_satuan_barang_list->SortUrl($m_satuan_barang_list->kode_satuan) ?>', 1);"><div id="elh_m_satuan_barang_kode_satuan" class="m_satuan_barang_kode_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_satuan_barang_list->kode_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_satuan_barang_list->kode_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_satuan_barang_list->kode_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_satuan_barang_list->nama_satuan->Visible) { // nama_satuan ?>
	<?php if ($m_satuan_barang_list->SortUrl($m_satuan_barang_list->nama_satuan) == "") { ?>
		<th data-name="nama_satuan" class="<?php echo $m_satuan_barang_list->nama_satuan->headerCellClass() ?>"><div id="elh_m_satuan_barang_nama_satuan" class="m_satuan_barang_nama_satuan"><div class="ew-table-header-caption"><?php echo $m_satuan_barang_list->nama_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_satuan" class="<?php echo $m_satuan_barang_list->nama_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_satuan_barang_list->SortUrl($m_satuan_barang_list->nama_satuan) ?>', 1);"><div id="elh_m_satuan_barang_nama_satuan" class="m_satuan_barang_nama_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_satuan_barang_list->nama_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_satuan_barang_list->nama_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_satuan_barang_list->nama_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_satuan_barang_list->level_satuan->Visible) { // level_satuan ?>
	<?php if ($m_satuan_barang_list->SortUrl($m_satuan_barang_list->level_satuan) == "") { ?>
		<th data-name="level_satuan" class="<?php echo $m_satuan_barang_list->level_satuan->headerCellClass() ?>"><div id="elh_m_satuan_barang_level_satuan" class="m_satuan_barang_level_satuan"><div class="ew-table-header-caption"><?php echo $m_satuan_barang_list->level_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="level_satuan" class="<?php echo $m_satuan_barang_list->level_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_satuan_barang_list->SortUrl($m_satuan_barang_list->level_satuan) ?>', 1);"><div id="elh_m_satuan_barang_level_satuan" class="m_satuan_barang_level_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_satuan_barang_list->level_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_satuan_barang_list->level_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_satuan_barang_list->level_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_satuan_barang_list->konversi_satuan->Visible) { // konversi_satuan ?>
	<?php if ($m_satuan_barang_list->SortUrl($m_satuan_barang_list->konversi_satuan) == "") { ?>
		<th data-name="konversi_satuan" class="<?php echo $m_satuan_barang_list->konversi_satuan->headerCellClass() ?>"><div id="elh_m_satuan_barang_konversi_satuan" class="m_satuan_barang_konversi_satuan"><div class="ew-table-header-caption"><?php echo $m_satuan_barang_list->konversi_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="konversi_satuan" class="<?php echo $m_satuan_barang_list->konversi_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_satuan_barang_list->SortUrl($m_satuan_barang_list->konversi_satuan) ?>', 1);"><div id="elh_m_satuan_barang_konversi_satuan" class="m_satuan_barang_konversi_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_satuan_barang_list->konversi_satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_satuan_barang_list->konversi_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_satuan_barang_list->konversi_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_satuan_barang_list->pid_satuan->Visible) { // pid_satuan ?>
	<?php if ($m_satuan_barang_list->SortUrl($m_satuan_barang_list->pid_satuan) == "") { ?>
		<th data-name="pid_satuan" class="<?php echo $m_satuan_barang_list->pid_satuan->headerCellClass() ?>"><div id="elh_m_satuan_barang_pid_satuan" class="m_satuan_barang_pid_satuan"><div class="ew-table-header-caption"><?php echo $m_satuan_barang_list->pid_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_satuan" class="<?php echo $m_satuan_barang_list->pid_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_satuan_barang_list->SortUrl($m_satuan_barang_list->pid_satuan) ?>', 1);"><div id="elh_m_satuan_barang_pid_satuan" class="m_satuan_barang_pid_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_satuan_barang_list->pid_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_satuan_barang_list->pid_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_satuan_barang_list->pid_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_satuan_barang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_satuan_barang_list->ExportAll && $m_satuan_barang_list->isExport()) {
	$m_satuan_barang_list->StopRecord = $m_satuan_barang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_satuan_barang_list->TotalRecords > $m_satuan_barang_list->StartRecord + $m_satuan_barang_list->DisplayRecords - 1)
		$m_satuan_barang_list->StopRecord = $m_satuan_barang_list->StartRecord + $m_satuan_barang_list->DisplayRecords - 1;
	else
		$m_satuan_barang_list->StopRecord = $m_satuan_barang_list->TotalRecords;
}
$m_satuan_barang_list->RecordCount = $m_satuan_barang_list->StartRecord - 1;
if ($m_satuan_barang_list->Recordset && !$m_satuan_barang_list->Recordset->EOF) {
	$m_satuan_barang_list->Recordset->moveFirst();
	$selectLimit = $m_satuan_barang_list->UseSelectLimit;
	if (!$selectLimit && $m_satuan_barang_list->StartRecord > 1)
		$m_satuan_barang_list->Recordset->move($m_satuan_barang_list->StartRecord - 1);
} elseif (!$m_satuan_barang->AllowAddDeleteRow && $m_satuan_barang_list->StopRecord == 0) {
	$m_satuan_barang_list->StopRecord = $m_satuan_barang->GridAddRowCount;
}

// Initialize aggregate
$m_satuan_barang->RowType = ROWTYPE_AGGREGATEINIT;
$m_satuan_barang->resetAttributes();
$m_satuan_barang_list->renderRow();
while ($m_satuan_barang_list->RecordCount < $m_satuan_barang_list->StopRecord) {
	$m_satuan_barang_list->RecordCount++;
	if ($m_satuan_barang_list->RecordCount >= $m_satuan_barang_list->StartRecord) {
		$m_satuan_barang_list->RowCount++;

		// Set up key count
		$m_satuan_barang_list->KeyCount = $m_satuan_barang_list->RowIndex;

		// Init row class and style
		$m_satuan_barang->resetAttributes();
		$m_satuan_barang->CssClass = "";
		if ($m_satuan_barang_list->isGridAdd()) {
		} else {
			$m_satuan_barang_list->loadRowValues($m_satuan_barang_list->Recordset); // Load row values
		}
		$m_satuan_barang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_satuan_barang->RowAttrs->merge(["data-rowindex" => $m_satuan_barang_list->RowCount, "id" => "r" . $m_satuan_barang_list->RowCount . "_m_satuan_barang", "data-rowtype" => $m_satuan_barang->RowType]);

		// Render row
		$m_satuan_barang_list->renderRow();

		// Render list options
		$m_satuan_barang_list->renderListOptions();
?>
	<tr <?php echo $m_satuan_barang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_satuan_barang_list->ListOptions->render("body", "left", $m_satuan_barang_list->RowCount);
?>
	<?php if ($m_satuan_barang_list->kode_satuan->Visible) { // kode_satuan ?>
		<td data-name="kode_satuan" <?php echo $m_satuan_barang_list->kode_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_list->RowCount ?>_m_satuan_barang_kode_satuan">
<span<?php echo $m_satuan_barang_list->kode_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_list->kode_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_satuan_barang_list->nama_satuan->Visible) { // nama_satuan ?>
		<td data-name="nama_satuan" <?php echo $m_satuan_barang_list->nama_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_list->RowCount ?>_m_satuan_barang_nama_satuan">
<span<?php echo $m_satuan_barang_list->nama_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_list->nama_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_satuan_barang_list->level_satuan->Visible) { // level_satuan ?>
		<td data-name="level_satuan" <?php echo $m_satuan_barang_list->level_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_list->RowCount ?>_m_satuan_barang_level_satuan">
<span<?php echo $m_satuan_barang_list->level_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_list->level_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_satuan_barang_list->konversi_satuan->Visible) { // konversi_satuan ?>
		<td data-name="konversi_satuan" <?php echo $m_satuan_barang_list->konversi_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_list->RowCount ?>_m_satuan_barang_konversi_satuan">
<span<?php echo $m_satuan_barang_list->konversi_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_list->konversi_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_satuan_barang_list->pid_satuan->Visible) { // pid_satuan ?>
		<td data-name="pid_satuan" <?php echo $m_satuan_barang_list->pid_satuan->cellAttributes() ?>>
<span id="el<?php echo $m_satuan_barang_list->RowCount ?>_m_satuan_barang_pid_satuan">
<span<?php echo $m_satuan_barang_list->pid_satuan->viewAttributes() ?>><?php echo $m_satuan_barang_list->pid_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_satuan_barang_list->ListOptions->render("body", "right", $m_satuan_barang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_satuan_barang_list->isGridAdd())
		$m_satuan_barang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_satuan_barang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_satuan_barang_list->Recordset)
	$m_satuan_barang_list->Recordset->Close();
?>
<?php if (!$m_satuan_barang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_satuan_barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_satuan_barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_satuan_barang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_satuan_barang_list->TotalRecords == 0 && !$m_satuan_barang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_satuan_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_satuan_barang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_satuan_barang_list->isExport()) { ?>
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
$m_satuan_barang_list->terminate();
?>