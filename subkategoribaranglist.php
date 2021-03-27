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
$subkategoribarang_list = new subkategoribarang_list();

// Run the page
$subkategoribarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subkategoribarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$subkategoribarang_list->isExport()) { ?>
<script>
var fsubkategoribaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsubkategoribaranglist = currentForm = new ew.Form("fsubkategoribaranglist", "list");
	fsubkategoribaranglist.formKeyCountName = '<?php echo $subkategoribarang_list->FormKeyCountName ?>';
	loadjs.done("fsubkategoribaranglist");
});
var fsubkategoribaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsubkategoribaranglistsrch = currentSearchForm = new ew.Form("fsubkategoribaranglistsrch");

	// Dynamic selection lists
	// Filters

	fsubkategoribaranglistsrch.filterList = <?php echo $subkategoribarang_list->getFilterList() ?>;
	loadjs.done("fsubkategoribaranglistsrch");
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
<?php if (!$subkategoribarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($subkategoribarang_list->TotalRecords > 0 && $subkategoribarang_list->ExportOptions->visible()) { ?>
<?php $subkategoribarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($subkategoribarang_list->ImportOptions->visible()) { ?>
<?php $subkategoribarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($subkategoribarang_list->SearchOptions->visible()) { ?>
<?php $subkategoribarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($subkategoribarang_list->FilterOptions->visible()) { ?>
<?php $subkategoribarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$subkategoribarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$subkategoribarang_list->isExport() && !$subkategoribarang->CurrentAction) { ?>
<form name="fsubkategoribaranglistsrch" id="fsubkategoribaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsubkategoribaranglistsrch-search-panel" class="<?php echo $subkategoribarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="subkategoribarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $subkategoribarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($subkategoribarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($subkategoribarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $subkategoribarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($subkategoribarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($subkategoribarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($subkategoribarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($subkategoribarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $subkategoribarang_list->showPageHeader(); ?>
<?php
$subkategoribarang_list->showMessage();
?>
<?php if ($subkategoribarang_list->TotalRecords > 0 || $subkategoribarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($subkategoribarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> subkategoribarang">
<?php if (!$subkategoribarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$subkategoribarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $subkategoribarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $subkategoribarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsubkategoribaranglist" id="fsubkategoribaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subkategoribarang">
<div id="gmp_subkategoribarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($subkategoribarang_list->TotalRecords > 0 || $subkategoribarang_list->isGridEdit()) { ?>
<table id="tbl_subkategoribaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$subkategoribarang->RowType = ROWTYPE_HEADER;

// Render list options
$subkategoribarang_list->renderListOptions();

// Render list options (header, left)
$subkategoribarang_list->ListOptions->render("header", "left");
?>
<?php if ($subkategoribarang_list->id->Visible) { // id ?>
	<?php if ($subkategoribarang_list->SortUrl($subkategoribarang_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $subkategoribarang_list->id->headerCellClass() ?>"><div id="elh_subkategoribarang_id" class="subkategoribarang_id"><div class="ew-table-header-caption"><?php echo $subkategoribarang_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $subkategoribarang_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $subkategoribarang_list->SortUrl($subkategoribarang_list->id) ?>', 1);"><div id="elh_subkategoribarang_id" class="subkategoribarang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $subkategoribarang_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($subkategoribarang_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($subkategoribarang_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($subkategoribarang_list->nama->Visible) { // nama ?>
	<?php if ($subkategoribarang_list->SortUrl($subkategoribarang_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $subkategoribarang_list->nama->headerCellClass() ?>"><div id="elh_subkategoribarang_nama" class="subkategoribarang_nama"><div class="ew-table-header-caption"><?php echo $subkategoribarang_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $subkategoribarang_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $subkategoribarang_list->SortUrl($subkategoribarang_list->nama) ?>', 1);"><div id="elh_subkategoribarang_nama" class="subkategoribarang_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $subkategoribarang_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($subkategoribarang_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($subkategoribarang_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$subkategoribarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($subkategoribarang_list->ExportAll && $subkategoribarang_list->isExport()) {
	$subkategoribarang_list->StopRecord = $subkategoribarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($subkategoribarang_list->TotalRecords > $subkategoribarang_list->StartRecord + $subkategoribarang_list->DisplayRecords - 1)
		$subkategoribarang_list->StopRecord = $subkategoribarang_list->StartRecord + $subkategoribarang_list->DisplayRecords - 1;
	else
		$subkategoribarang_list->StopRecord = $subkategoribarang_list->TotalRecords;
}
$subkategoribarang_list->RecordCount = $subkategoribarang_list->StartRecord - 1;
if ($subkategoribarang_list->Recordset && !$subkategoribarang_list->Recordset->EOF) {
	$subkategoribarang_list->Recordset->moveFirst();
	$selectLimit = $subkategoribarang_list->UseSelectLimit;
	if (!$selectLimit && $subkategoribarang_list->StartRecord > 1)
		$subkategoribarang_list->Recordset->move($subkategoribarang_list->StartRecord - 1);
} elseif (!$subkategoribarang->AllowAddDeleteRow && $subkategoribarang_list->StopRecord == 0) {
	$subkategoribarang_list->StopRecord = $subkategoribarang->GridAddRowCount;
}

// Initialize aggregate
$subkategoribarang->RowType = ROWTYPE_AGGREGATEINIT;
$subkategoribarang->resetAttributes();
$subkategoribarang_list->renderRow();
while ($subkategoribarang_list->RecordCount < $subkategoribarang_list->StopRecord) {
	$subkategoribarang_list->RecordCount++;
	if ($subkategoribarang_list->RecordCount >= $subkategoribarang_list->StartRecord) {
		$subkategoribarang_list->RowCount++;

		// Set up key count
		$subkategoribarang_list->KeyCount = $subkategoribarang_list->RowIndex;

		// Init row class and style
		$subkategoribarang->resetAttributes();
		$subkategoribarang->CssClass = "";
		if ($subkategoribarang_list->isGridAdd()) {
		} else {
			$subkategoribarang_list->loadRowValues($subkategoribarang_list->Recordset); // Load row values
		}
		$subkategoribarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$subkategoribarang->RowAttrs->merge(["data-rowindex" => $subkategoribarang_list->RowCount, "id" => "r" . $subkategoribarang_list->RowCount . "_subkategoribarang", "data-rowtype" => $subkategoribarang->RowType]);

		// Render row
		$subkategoribarang_list->renderRow();

		// Render list options
		$subkategoribarang_list->renderListOptions();
?>
	<tr <?php echo $subkategoribarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$subkategoribarang_list->ListOptions->render("body", "left", $subkategoribarang_list->RowCount);
?>
	<?php if ($subkategoribarang_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $subkategoribarang_list->id->cellAttributes() ?>>
<span id="el<?php echo $subkategoribarang_list->RowCount ?>_subkategoribarang_id">
<span<?php echo $subkategoribarang_list->id->viewAttributes() ?>><?php echo $subkategoribarang_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($subkategoribarang_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $subkategoribarang_list->nama->cellAttributes() ?>>
<span id="el<?php echo $subkategoribarang_list->RowCount ?>_subkategoribarang_nama">
<span<?php echo $subkategoribarang_list->nama->viewAttributes() ?>><?php echo $subkategoribarang_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$subkategoribarang_list->ListOptions->render("body", "right", $subkategoribarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$subkategoribarang_list->isGridAdd())
		$subkategoribarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$subkategoribarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($subkategoribarang_list->Recordset)
	$subkategoribarang_list->Recordset->Close();
?>
<?php if (!$subkategoribarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$subkategoribarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $subkategoribarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $subkategoribarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($subkategoribarang_list->TotalRecords == 0 && !$subkategoribarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $subkategoribarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$subkategoribarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$subkategoribarang_list->isExport()) { ?>
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
$subkategoribarang_list->terminate();
?>