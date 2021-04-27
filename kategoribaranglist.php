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
$kategoribarang_list = new kategoribarang_list();

// Run the page
$kategoribarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kategoribarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kategoribarang_list->isExport()) { ?>
<script>
var fkategoribaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkategoribaranglist = currentForm = new ew.Form("fkategoribaranglist", "list");
	fkategoribaranglist.formKeyCountName = '<?php echo $kategoribarang_list->FormKeyCountName ?>';
	loadjs.done("fkategoribaranglist");
});
var fkategoribaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkategoribaranglistsrch = currentSearchForm = new ew.Form("fkategoribaranglistsrch");

	// Dynamic selection lists
	// Filters

	fkategoribaranglistsrch.filterList = <?php echo $kategoribarang_list->getFilterList() ?>;
	loadjs.done("fkategoribaranglistsrch");
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
<?php if (!$kategoribarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kategoribarang_list->TotalRecords > 0 && $kategoribarang_list->ExportOptions->visible()) { ?>
<?php $kategoribarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kategoribarang_list->ImportOptions->visible()) { ?>
<?php $kategoribarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kategoribarang_list->SearchOptions->visible()) { ?>
<?php $kategoribarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kategoribarang_list->FilterOptions->visible()) { ?>
<?php $kategoribarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kategoribarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kategoribarang_list->isExport() && !$kategoribarang->CurrentAction) { ?>
<form name="fkategoribaranglistsrch" id="fkategoribaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkategoribaranglistsrch-search-panel" class="<?php echo $kategoribarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kategoribarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kategoribarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kategoribarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kategoribarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kategoribarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kategoribarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kategoribarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kategoribarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kategoribarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kategoribarang_list->showPageHeader(); ?>
<?php
$kategoribarang_list->showMessage();
?>
<?php if ($kategoribarang_list->TotalRecords > 0 || $kategoribarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kategoribarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kategoribarang">
<?php if (!$kategoribarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kategoribarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kategoribarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kategoribarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkategoribaranglist" id="fkategoribaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kategoribarang">
<div id="gmp_kategoribarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kategoribarang_list->TotalRecords > 0 || $kategoribarang_list->isGridEdit()) { ?>
<table id="tbl_kategoribaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kategoribarang->RowType = ROWTYPE_HEADER;

// Render list options
$kategoribarang_list->renderListOptions();

// Render list options (header, left)
$kategoribarang_list->ListOptions->render("header", "left");
?>
<?php if ($kategoribarang_list->id->Visible) { // id ?>
	<?php if ($kategoribarang_list->SortUrl($kategoribarang_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $kategoribarang_list->id->headerCellClass() ?>"><div id="elh_kategoribarang_id" class="kategoribarang_id"><div class="ew-table-header-caption"><?php echo $kategoribarang_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $kategoribarang_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kategoribarang_list->SortUrl($kategoribarang_list->id) ?>', 1);"><div id="elh_kategoribarang_id" class="kategoribarang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kategoribarang_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($kategoribarang_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kategoribarang_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kategoribarang_list->nama->Visible) { // nama ?>
	<?php if ($kategoribarang_list->SortUrl($kategoribarang_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $kategoribarang_list->nama->headerCellClass() ?>"><div id="elh_kategoribarang_nama" class="kategoribarang_nama"><div class="ew-table-header-caption"><?php echo $kategoribarang_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $kategoribarang_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kategoribarang_list->SortUrl($kategoribarang_list->nama) ?>', 1);"><div id="elh_kategoribarang_nama" class="kategoribarang_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kategoribarang_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kategoribarang_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kategoribarang_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kategoribarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kategoribarang_list->ExportAll && $kategoribarang_list->isExport()) {
	$kategoribarang_list->StopRecord = $kategoribarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kategoribarang_list->TotalRecords > $kategoribarang_list->StartRecord + $kategoribarang_list->DisplayRecords - 1)
		$kategoribarang_list->StopRecord = $kategoribarang_list->StartRecord + $kategoribarang_list->DisplayRecords - 1;
	else
		$kategoribarang_list->StopRecord = $kategoribarang_list->TotalRecords;
}
$kategoribarang_list->RecordCount = $kategoribarang_list->StartRecord - 1;
if ($kategoribarang_list->Recordset && !$kategoribarang_list->Recordset->EOF) {
	$kategoribarang_list->Recordset->moveFirst();
	$selectLimit = $kategoribarang_list->UseSelectLimit;
	if (!$selectLimit && $kategoribarang_list->StartRecord > 1)
		$kategoribarang_list->Recordset->move($kategoribarang_list->StartRecord - 1);
} elseif (!$kategoribarang->AllowAddDeleteRow && $kategoribarang_list->StopRecord == 0) {
	$kategoribarang_list->StopRecord = $kategoribarang->GridAddRowCount;
}

// Initialize aggregate
$kategoribarang->RowType = ROWTYPE_AGGREGATEINIT;
$kategoribarang->resetAttributes();
$kategoribarang_list->renderRow();
while ($kategoribarang_list->RecordCount < $kategoribarang_list->StopRecord) {
	$kategoribarang_list->RecordCount++;
	if ($kategoribarang_list->RecordCount >= $kategoribarang_list->StartRecord) {
		$kategoribarang_list->RowCount++;

		// Set up key count
		$kategoribarang_list->KeyCount = $kategoribarang_list->RowIndex;

		// Init row class and style
		$kategoribarang->resetAttributes();
		$kategoribarang->CssClass = "";
		if ($kategoribarang_list->isGridAdd()) {
		} else {
			$kategoribarang_list->loadRowValues($kategoribarang_list->Recordset); // Load row values
		}
		$kategoribarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kategoribarang->RowAttrs->merge(["data-rowindex" => $kategoribarang_list->RowCount, "id" => "r" . $kategoribarang_list->RowCount . "_kategoribarang", "data-rowtype" => $kategoribarang->RowType]);

		// Render row
		$kategoribarang_list->renderRow();

		// Render list options
		$kategoribarang_list->renderListOptions();
?>
	<tr <?php echo $kategoribarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kategoribarang_list->ListOptions->render("body", "left", $kategoribarang_list->RowCount);
?>
	<?php if ($kategoribarang_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $kategoribarang_list->id->cellAttributes() ?>>
<span id="el<?php echo $kategoribarang_list->RowCount ?>_kategoribarang_id">
<span<?php echo $kategoribarang_list->id->viewAttributes() ?>><?php echo $kategoribarang_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kategoribarang_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $kategoribarang_list->nama->cellAttributes() ?>>
<span id="el<?php echo $kategoribarang_list->RowCount ?>_kategoribarang_nama">
<span<?php echo $kategoribarang_list->nama->viewAttributes() ?>><?php echo $kategoribarang_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kategoribarang_list->ListOptions->render("body", "right", $kategoribarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kategoribarang_list->isGridAdd())
		$kategoribarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kategoribarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kategoribarang_list->Recordset)
	$kategoribarang_list->Recordset->Close();
?>
<?php if (!$kategoribarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kategoribarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kategoribarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kategoribarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kategoribarang_list->TotalRecords == 0 && !$kategoribarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kategoribarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kategoribarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kategoribarang_list->isExport()) { ?>
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
$kategoribarang_list->terminate();
?>