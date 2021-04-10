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
$m_klinik_list = new m_klinik_list();

// Run the page
$m_klinik_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_klinik_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_klinik_list->isExport()) { ?>
<script>
var fm_kliniklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_kliniklist = currentForm = new ew.Form("fm_kliniklist", "list");
	fm_kliniklist.formKeyCountName = '<?php echo $m_klinik_list->FormKeyCountName ?>';
	loadjs.done("fm_kliniklist");
});
var fm_kliniklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_kliniklistsrch = currentSearchForm = new ew.Form("fm_kliniklistsrch");

	// Dynamic selection lists
	// Filters

	fm_kliniklistsrch.filterList = <?php echo $m_klinik_list->getFilterList() ?>;
	loadjs.done("fm_kliniklistsrch");
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
<?php if (!$m_klinik_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_klinik_list->TotalRecords > 0 && $m_klinik_list->ExportOptions->visible()) { ?>
<?php $m_klinik_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_klinik_list->ImportOptions->visible()) { ?>
<?php $m_klinik_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_klinik_list->SearchOptions->visible()) { ?>
<?php $m_klinik_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_klinik_list->FilterOptions->visible()) { ?>
<?php $m_klinik_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_klinik_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_klinik_list->isExport() && !$m_klinik->CurrentAction) { ?>
<form name="fm_kliniklistsrch" id="fm_kliniklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_kliniklistsrch-search-panel" class="<?php echo $m_klinik_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_klinik">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_klinik_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_klinik_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_klinik_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_klinik_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_klinik_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_klinik_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_klinik_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_klinik_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_klinik_list->showPageHeader(); ?>
<?php
$m_klinik_list->showMessage();
?>
<?php if ($m_klinik_list->TotalRecords > 0 || $m_klinik->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_klinik_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_klinik">
<?php if (!$m_klinik_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_klinik_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_klinik_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_klinik_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_kliniklist" id="fm_kliniklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_klinik">
<div id="gmp_m_klinik" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_klinik_list->TotalRecords > 0 || $m_klinik_list->isGridEdit()) { ?>
<table id="tbl_m_kliniklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_klinik->RowType = ROWTYPE_HEADER;

// Render list options
$m_klinik_list->renderListOptions();

// Render list options (header, left)
$m_klinik_list->ListOptions->render("header", "left");
?>
<?php if ($m_klinik_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_klinik_list->SortUrl($m_klinik_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_klinik_list->id_klinik->headerCellClass() ?>"><div id="elh_m_klinik_id_klinik" class="m_klinik_id_klinik"><div class="ew-table-header-caption"><?php echo $m_klinik_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_klinik_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_klinik_list->SortUrl($m_klinik_list->id_klinik) ?>', 1);"><div id="elh_m_klinik_id_klinik" class="m_klinik_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_klinik_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_klinik_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_klinik_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_klinik_list->nama_klinik->Visible) { // nama_klinik ?>
	<?php if ($m_klinik_list->SortUrl($m_klinik_list->nama_klinik) == "") { ?>
		<th data-name="nama_klinik" class="<?php echo $m_klinik_list->nama_klinik->headerCellClass() ?>"><div id="elh_m_klinik_nama_klinik" class="m_klinik_nama_klinik"><div class="ew-table-header-caption"><?php echo $m_klinik_list->nama_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_klinik" class="<?php echo $m_klinik_list->nama_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_klinik_list->SortUrl($m_klinik_list->nama_klinik) ?>', 1);"><div id="elh_m_klinik_nama_klinik" class="m_klinik_nama_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_klinik_list->nama_klinik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_klinik_list->nama_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_klinik_list->nama_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_klinik_list->foto_klinik->Visible) { // foto_klinik ?>
	<?php if ($m_klinik_list->SortUrl($m_klinik_list->foto_klinik) == "") { ?>
		<th data-name="foto_klinik" class="<?php echo $m_klinik_list->foto_klinik->headerCellClass() ?>"><div id="elh_m_klinik_foto_klinik" class="m_klinik_foto_klinik"><div class="ew-table-header-caption"><?php echo $m_klinik_list->foto_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto_klinik" class="<?php echo $m_klinik_list->foto_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_klinik_list->SortUrl($m_klinik_list->foto_klinik) ?>', 1);"><div id="elh_m_klinik_foto_klinik" class="m_klinik_foto_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_klinik_list->foto_klinik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_klinik_list->foto_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_klinik_list->foto_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_klinik_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_klinik_list->ExportAll && $m_klinik_list->isExport()) {
	$m_klinik_list->StopRecord = $m_klinik_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_klinik_list->TotalRecords > $m_klinik_list->StartRecord + $m_klinik_list->DisplayRecords - 1)
		$m_klinik_list->StopRecord = $m_klinik_list->StartRecord + $m_klinik_list->DisplayRecords - 1;
	else
		$m_klinik_list->StopRecord = $m_klinik_list->TotalRecords;
}
$m_klinik_list->RecordCount = $m_klinik_list->StartRecord - 1;
if ($m_klinik_list->Recordset && !$m_klinik_list->Recordset->EOF) {
	$m_klinik_list->Recordset->moveFirst();
	$selectLimit = $m_klinik_list->UseSelectLimit;
	if (!$selectLimit && $m_klinik_list->StartRecord > 1)
		$m_klinik_list->Recordset->move($m_klinik_list->StartRecord - 1);
} elseif (!$m_klinik->AllowAddDeleteRow && $m_klinik_list->StopRecord == 0) {
	$m_klinik_list->StopRecord = $m_klinik->GridAddRowCount;
}

// Initialize aggregate
$m_klinik->RowType = ROWTYPE_AGGREGATEINIT;
$m_klinik->resetAttributes();
$m_klinik_list->renderRow();
while ($m_klinik_list->RecordCount < $m_klinik_list->StopRecord) {
	$m_klinik_list->RecordCount++;
	if ($m_klinik_list->RecordCount >= $m_klinik_list->StartRecord) {
		$m_klinik_list->RowCount++;

		// Set up key count
		$m_klinik_list->KeyCount = $m_klinik_list->RowIndex;

		// Init row class and style
		$m_klinik->resetAttributes();
		$m_klinik->CssClass = "";
		if ($m_klinik_list->isGridAdd()) {
		} else {
			$m_klinik_list->loadRowValues($m_klinik_list->Recordset); // Load row values
		}
		$m_klinik->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_klinik->RowAttrs->merge(["data-rowindex" => $m_klinik_list->RowCount, "id" => "r" . $m_klinik_list->RowCount . "_m_klinik", "data-rowtype" => $m_klinik->RowType]);

		// Render row
		$m_klinik_list->renderRow();

		// Render list options
		$m_klinik_list->renderListOptions();
?>
	<tr <?php echo $m_klinik->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_klinik_list->ListOptions->render("body", "left", $m_klinik_list->RowCount);
?>
	<?php if ($m_klinik_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_klinik_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_klinik_list->RowCount ?>_m_klinik_id_klinik">
<span<?php echo $m_klinik_list->id_klinik->viewAttributes() ?>><?php echo $m_klinik_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_klinik_list->nama_klinik->Visible) { // nama_klinik ?>
		<td data-name="nama_klinik" <?php echo $m_klinik_list->nama_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_klinik_list->RowCount ?>_m_klinik_nama_klinik">
<span<?php echo $m_klinik_list->nama_klinik->viewAttributes() ?>><?php echo $m_klinik_list->nama_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_klinik_list->foto_klinik->Visible) { // foto_klinik ?>
		<td data-name="foto_klinik" <?php echo $m_klinik_list->foto_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_klinik_list->RowCount ?>_m_klinik_foto_klinik">
<span<?php echo $m_klinik_list->foto_klinik->viewAttributes() ?>><?php echo $m_klinik_list->foto_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_klinik_list->ListOptions->render("body", "right", $m_klinik_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_klinik_list->isGridAdd())
		$m_klinik_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_klinik->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_klinik_list->Recordset)
	$m_klinik_list->Recordset->Close();
?>
<?php if (!$m_klinik_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_klinik_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_klinik_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_klinik_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_klinik_list->TotalRecords == 0 && !$m_klinik->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_klinik_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_klinik_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_klinik_list->isExport()) { ?>
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
$m_klinik_list->terminate();
?>