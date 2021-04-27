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
$m_gudang_list = new m_gudang_list();

// Run the page
$m_gudang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_gudang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_gudang_list->isExport()) { ?>
<script>
var fm_gudanglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_gudanglist = currentForm = new ew.Form("fm_gudanglist", "list");
	fm_gudanglist.formKeyCountName = '<?php echo $m_gudang_list->FormKeyCountName ?>';
	loadjs.done("fm_gudanglist");
});
var fm_gudanglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_gudanglistsrch = currentSearchForm = new ew.Form("fm_gudanglistsrch");

	// Dynamic selection lists
	// Filters

	fm_gudanglistsrch.filterList = <?php echo $m_gudang_list->getFilterList() ?>;
	loadjs.done("fm_gudanglistsrch");
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
<?php if (!$m_gudang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_gudang_list->TotalRecords > 0 && $m_gudang_list->ExportOptions->visible()) { ?>
<?php $m_gudang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_gudang_list->ImportOptions->visible()) { ?>
<?php $m_gudang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_gudang_list->SearchOptions->visible()) { ?>
<?php $m_gudang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_gudang_list->FilterOptions->visible()) { ?>
<?php $m_gudang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_gudang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_gudang_list->isExport() && !$m_gudang->CurrentAction) { ?>
<form name="fm_gudanglistsrch" id="fm_gudanglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_gudanglistsrch-search-panel" class="<?php echo $m_gudang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_gudang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_gudang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_gudang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_gudang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_gudang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_gudang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_gudang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_gudang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_gudang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_gudang_list->showPageHeader(); ?>
<?php
$m_gudang_list->showMessage();
?>
<?php if ($m_gudang_list->TotalRecords > 0 || $m_gudang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_gudang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_gudang">
<?php if (!$m_gudang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_gudang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_gudang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_gudang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_gudanglist" id="fm_gudanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_gudang">
<div id="gmp_m_gudang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_gudang_list->TotalRecords > 0 || $m_gudang_list->isGridEdit()) { ?>
<table id="tbl_m_gudanglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_gudang->RowType = ROWTYPE_HEADER;

// Render list options
$m_gudang_list->renderListOptions();

// Render list options (header, left)
$m_gudang_list->ListOptions->render("header", "left");
?>
<?php if ($m_gudang_list->id_gudang->Visible) { // id_gudang ?>
	<?php if ($m_gudang_list->SortUrl($m_gudang_list->id_gudang) == "") { ?>
		<th data-name="id_gudang" class="<?php echo $m_gudang_list->id_gudang->headerCellClass() ?>"><div id="elh_m_gudang_id_gudang" class="m_gudang_id_gudang"><div class="ew-table-header-caption"><?php echo $m_gudang_list->id_gudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_gudang" class="<?php echo $m_gudang_list->id_gudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_gudang_list->SortUrl($m_gudang_list->id_gudang) ?>', 1);"><div id="elh_m_gudang_id_gudang" class="m_gudang_id_gudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_gudang_list->id_gudang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_gudang_list->id_gudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_gudang_list->id_gudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_gudang_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_gudang_list->SortUrl($m_gudang_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_gudang_list->id_klinik->headerCellClass() ?>"><div id="elh_m_gudang_id_klinik" class="m_gudang_id_klinik"><div class="ew-table-header-caption"><?php echo $m_gudang_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_gudang_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_gudang_list->SortUrl($m_gudang_list->id_klinik) ?>', 1);"><div id="elh_m_gudang_id_klinik" class="m_gudang_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_gudang_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_gudang_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_gudang_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_gudang_list->kode_gudang->Visible) { // kode_gudang ?>
	<?php if ($m_gudang_list->SortUrl($m_gudang_list->kode_gudang) == "") { ?>
		<th data-name="kode_gudang" class="<?php echo $m_gudang_list->kode_gudang->headerCellClass() ?>"><div id="elh_m_gudang_kode_gudang" class="m_gudang_kode_gudang"><div class="ew-table-header-caption"><?php echo $m_gudang_list->kode_gudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_gudang" class="<?php echo $m_gudang_list->kode_gudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_gudang_list->SortUrl($m_gudang_list->kode_gudang) ?>', 1);"><div id="elh_m_gudang_kode_gudang" class="m_gudang_kode_gudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_gudang_list->kode_gudang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_gudang_list->kode_gudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_gudang_list->kode_gudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_gudang_list->nama_gudang->Visible) { // nama_gudang ?>
	<?php if ($m_gudang_list->SortUrl($m_gudang_list->nama_gudang) == "") { ?>
		<th data-name="nama_gudang" class="<?php echo $m_gudang_list->nama_gudang->headerCellClass() ?>"><div id="elh_m_gudang_nama_gudang" class="m_gudang_nama_gudang"><div class="ew-table-header-caption"><?php echo $m_gudang_list->nama_gudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_gudang" class="<?php echo $m_gudang_list->nama_gudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_gudang_list->SortUrl($m_gudang_list->nama_gudang) ?>', 1);"><div id="elh_m_gudang_nama_gudang" class="m_gudang_nama_gudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_gudang_list->nama_gudang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_gudang_list->nama_gudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_gudang_list->nama_gudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_gudang_list->lokasi_gudang->Visible) { // lokasi_gudang ?>
	<?php if ($m_gudang_list->SortUrl($m_gudang_list->lokasi_gudang) == "") { ?>
		<th data-name="lokasi_gudang" class="<?php echo $m_gudang_list->lokasi_gudang->headerCellClass() ?>"><div id="elh_m_gudang_lokasi_gudang" class="m_gudang_lokasi_gudang"><div class="ew-table-header-caption"><?php echo $m_gudang_list->lokasi_gudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lokasi_gudang" class="<?php echo $m_gudang_list->lokasi_gudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_gudang_list->SortUrl($m_gudang_list->lokasi_gudang) ?>', 1);"><div id="elh_m_gudang_lokasi_gudang" class="m_gudang_lokasi_gudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_gudang_list->lokasi_gudang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_gudang_list->lokasi_gudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_gudang_list->lokasi_gudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_gudang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_gudang_list->ExportAll && $m_gudang_list->isExport()) {
	$m_gudang_list->StopRecord = $m_gudang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_gudang_list->TotalRecords > $m_gudang_list->StartRecord + $m_gudang_list->DisplayRecords - 1)
		$m_gudang_list->StopRecord = $m_gudang_list->StartRecord + $m_gudang_list->DisplayRecords - 1;
	else
		$m_gudang_list->StopRecord = $m_gudang_list->TotalRecords;
}
$m_gudang_list->RecordCount = $m_gudang_list->StartRecord - 1;
if ($m_gudang_list->Recordset && !$m_gudang_list->Recordset->EOF) {
	$m_gudang_list->Recordset->moveFirst();
	$selectLimit = $m_gudang_list->UseSelectLimit;
	if (!$selectLimit && $m_gudang_list->StartRecord > 1)
		$m_gudang_list->Recordset->move($m_gudang_list->StartRecord - 1);
} elseif (!$m_gudang->AllowAddDeleteRow && $m_gudang_list->StopRecord == 0) {
	$m_gudang_list->StopRecord = $m_gudang->GridAddRowCount;
}

// Initialize aggregate
$m_gudang->RowType = ROWTYPE_AGGREGATEINIT;
$m_gudang->resetAttributes();
$m_gudang_list->renderRow();
while ($m_gudang_list->RecordCount < $m_gudang_list->StopRecord) {
	$m_gudang_list->RecordCount++;
	if ($m_gudang_list->RecordCount >= $m_gudang_list->StartRecord) {
		$m_gudang_list->RowCount++;

		// Set up key count
		$m_gudang_list->KeyCount = $m_gudang_list->RowIndex;

		// Init row class and style
		$m_gudang->resetAttributes();
		$m_gudang->CssClass = "";
		if ($m_gudang_list->isGridAdd()) {
		} else {
			$m_gudang_list->loadRowValues($m_gudang_list->Recordset); // Load row values
		}
		$m_gudang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_gudang->RowAttrs->merge(["data-rowindex" => $m_gudang_list->RowCount, "id" => "r" . $m_gudang_list->RowCount . "_m_gudang", "data-rowtype" => $m_gudang->RowType]);

		// Render row
		$m_gudang_list->renderRow();

		// Render list options
		$m_gudang_list->renderListOptions();
?>
	<tr <?php echo $m_gudang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_gudang_list->ListOptions->render("body", "left", $m_gudang_list->RowCount);
?>
	<?php if ($m_gudang_list->id_gudang->Visible) { // id_gudang ?>
		<td data-name="id_gudang" <?php echo $m_gudang_list->id_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_list->RowCount ?>_m_gudang_id_gudang">
<span<?php echo $m_gudang_list->id_gudang->viewAttributes() ?>><?php echo $m_gudang_list->id_gudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_gudang_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_gudang_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_list->RowCount ?>_m_gudang_id_klinik">
<span<?php echo $m_gudang_list->id_klinik->viewAttributes() ?>><?php echo $m_gudang_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_gudang_list->kode_gudang->Visible) { // kode_gudang ?>
		<td data-name="kode_gudang" <?php echo $m_gudang_list->kode_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_list->RowCount ?>_m_gudang_kode_gudang">
<span<?php echo $m_gudang_list->kode_gudang->viewAttributes() ?>><?php echo $m_gudang_list->kode_gudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_gudang_list->nama_gudang->Visible) { // nama_gudang ?>
		<td data-name="nama_gudang" <?php echo $m_gudang_list->nama_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_list->RowCount ?>_m_gudang_nama_gudang">
<span<?php echo $m_gudang_list->nama_gudang->viewAttributes() ?>><?php echo $m_gudang_list->nama_gudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_gudang_list->lokasi_gudang->Visible) { // lokasi_gudang ?>
		<td data-name="lokasi_gudang" <?php echo $m_gudang_list->lokasi_gudang->cellAttributes() ?>>
<span id="el<?php echo $m_gudang_list->RowCount ?>_m_gudang_lokasi_gudang">
<span<?php echo $m_gudang_list->lokasi_gudang->viewAttributes() ?>><?php echo $m_gudang_list->lokasi_gudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_gudang_list->ListOptions->render("body", "right", $m_gudang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_gudang_list->isGridAdd())
		$m_gudang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_gudang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_gudang_list->Recordset)
	$m_gudang_list->Recordset->Close();
?>
<?php if (!$m_gudang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_gudang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_gudang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_gudang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_gudang_list->TotalRecords == 0 && !$m_gudang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_gudang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_gudang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_gudang_list->isExport()) { ?>
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
$m_gudang_list->terminate();
?>