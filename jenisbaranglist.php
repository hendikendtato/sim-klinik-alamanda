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
$jenisbarang_list = new jenisbarang_list();

// Run the page
$jenisbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenisbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenisbarang_list->isExport()) { ?>
<script>
var fjenisbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjenisbaranglist = currentForm = new ew.Form("fjenisbaranglist", "list");
	fjenisbaranglist.formKeyCountName = '<?php echo $jenisbarang_list->FormKeyCountName ?>';
	loadjs.done("fjenisbaranglist");
});
var fjenisbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjenisbaranglistsrch = currentSearchForm = new ew.Form("fjenisbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fjenisbaranglistsrch.filterList = <?php echo $jenisbarang_list->getFilterList() ?>;
	loadjs.done("fjenisbaranglistsrch");
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
<?php if (!$jenisbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jenisbarang_list->TotalRecords > 0 && $jenisbarang_list->ExportOptions->visible()) { ?>
<?php $jenisbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jenisbarang_list->ImportOptions->visible()) { ?>
<?php $jenisbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jenisbarang_list->SearchOptions->visible()) { ?>
<?php $jenisbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jenisbarang_list->FilterOptions->visible()) { ?>
<?php $jenisbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jenisbarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jenisbarang_list->isExport() && !$jenisbarang->CurrentAction) { ?>
<form name="fjenisbaranglistsrch" id="fjenisbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjenisbaranglistsrch-search-panel" class="<?php echo $jenisbarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jenisbarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jenisbarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jenisbarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jenisbarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jenisbarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jenisbarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jenisbarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jenisbarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jenisbarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jenisbarang_list->showPageHeader(); ?>
<?php
$jenisbarang_list->showMessage();
?>
<?php if ($jenisbarang_list->TotalRecords > 0 || $jenisbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jenisbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jenisbarang">
<?php if (!$jenisbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jenisbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenisbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenisbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjenisbaranglist" id="fjenisbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenisbarang">
<div id="gmp_jenisbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jenisbarang_list->TotalRecords > 0 || $jenisbarang_list->isGridEdit()) { ?>
<table id="tbl_jenisbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jenisbarang->RowType = ROWTYPE_HEADER;

// Render list options
$jenisbarang_list->renderListOptions();

// Render list options (header, left)
$jenisbarang_list->ListOptions->render("header", "left");
?>
<?php if ($jenisbarang_list->id->Visible) { // id ?>
	<?php if ($jenisbarang_list->SortUrl($jenisbarang_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $jenisbarang_list->id->headerCellClass() ?>"><div id="elh_jenisbarang_id" class="jenisbarang_id"><div class="ew-table-header-caption"><?php echo $jenisbarang_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $jenisbarang_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenisbarang_list->SortUrl($jenisbarang_list->id) ?>', 1);"><div id="elh_jenisbarang_id" class="jenisbarang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenisbarang_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($jenisbarang_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenisbarang_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jenisbarang_list->kode->Visible) { // kode ?>
	<?php if ($jenisbarang_list->SortUrl($jenisbarang_list->kode) == "") { ?>
		<th data-name="kode" class="<?php echo $jenisbarang_list->kode->headerCellClass() ?>"><div id="elh_jenisbarang_kode" class="jenisbarang_kode"><div class="ew-table-header-caption"><?php echo $jenisbarang_list->kode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode" class="<?php echo $jenisbarang_list->kode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenisbarang_list->SortUrl($jenisbarang_list->kode) ?>', 1);"><div id="elh_jenisbarang_kode" class="jenisbarang_kode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenisbarang_list->kode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenisbarang_list->kode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenisbarang_list->kode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jenisbarang_list->jenis->Visible) { // jenis ?>
	<?php if ($jenisbarang_list->SortUrl($jenisbarang_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $jenisbarang_list->jenis->headerCellClass() ?>"><div id="elh_jenisbarang_jenis" class="jenisbarang_jenis"><div class="ew-table-header-caption"><?php echo $jenisbarang_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $jenisbarang_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenisbarang_list->SortUrl($jenisbarang_list->jenis) ?>', 1);"><div id="elh_jenisbarang_jenis" class="jenisbarang_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenisbarang_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenisbarang_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenisbarang_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jenisbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jenisbarang_list->ExportAll && $jenisbarang_list->isExport()) {
	$jenisbarang_list->StopRecord = $jenisbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jenisbarang_list->TotalRecords > $jenisbarang_list->StartRecord + $jenisbarang_list->DisplayRecords - 1)
		$jenisbarang_list->StopRecord = $jenisbarang_list->StartRecord + $jenisbarang_list->DisplayRecords - 1;
	else
		$jenisbarang_list->StopRecord = $jenisbarang_list->TotalRecords;
}
$jenisbarang_list->RecordCount = $jenisbarang_list->StartRecord - 1;
if ($jenisbarang_list->Recordset && !$jenisbarang_list->Recordset->EOF) {
	$jenisbarang_list->Recordset->moveFirst();
	$selectLimit = $jenisbarang_list->UseSelectLimit;
	if (!$selectLimit && $jenisbarang_list->StartRecord > 1)
		$jenisbarang_list->Recordset->move($jenisbarang_list->StartRecord - 1);
} elseif (!$jenisbarang->AllowAddDeleteRow && $jenisbarang_list->StopRecord == 0) {
	$jenisbarang_list->StopRecord = $jenisbarang->GridAddRowCount;
}

// Initialize aggregate
$jenisbarang->RowType = ROWTYPE_AGGREGATEINIT;
$jenisbarang->resetAttributes();
$jenisbarang_list->renderRow();
while ($jenisbarang_list->RecordCount < $jenisbarang_list->StopRecord) {
	$jenisbarang_list->RecordCount++;
	if ($jenisbarang_list->RecordCount >= $jenisbarang_list->StartRecord) {
		$jenisbarang_list->RowCount++;

		// Set up key count
		$jenisbarang_list->KeyCount = $jenisbarang_list->RowIndex;

		// Init row class and style
		$jenisbarang->resetAttributes();
		$jenisbarang->CssClass = "";
		if ($jenisbarang_list->isGridAdd()) {
		} else {
			$jenisbarang_list->loadRowValues($jenisbarang_list->Recordset); // Load row values
		}
		$jenisbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jenisbarang->RowAttrs->merge(["data-rowindex" => $jenisbarang_list->RowCount, "id" => "r" . $jenisbarang_list->RowCount . "_jenisbarang", "data-rowtype" => $jenisbarang->RowType]);

		// Render row
		$jenisbarang_list->renderRow();

		// Render list options
		$jenisbarang_list->renderListOptions();
?>
	<tr <?php echo $jenisbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jenisbarang_list->ListOptions->render("body", "left", $jenisbarang_list->RowCount);
?>
	<?php if ($jenisbarang_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $jenisbarang_list->id->cellAttributes() ?>>
<span id="el<?php echo $jenisbarang_list->RowCount ?>_jenisbarang_id">
<span<?php echo $jenisbarang_list->id->viewAttributes() ?>><?php echo $jenisbarang_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jenisbarang_list->kode->Visible) { // kode ?>
		<td data-name="kode" <?php echo $jenisbarang_list->kode->cellAttributes() ?>>
<span id="el<?php echo $jenisbarang_list->RowCount ?>_jenisbarang_kode">
<span<?php echo $jenisbarang_list->kode->viewAttributes() ?>><?php echo $jenisbarang_list->kode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jenisbarang_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $jenisbarang_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $jenisbarang_list->RowCount ?>_jenisbarang_jenis">
<span<?php echo $jenisbarang_list->jenis->viewAttributes() ?>><?php echo $jenisbarang_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jenisbarang_list->ListOptions->render("body", "right", $jenisbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jenisbarang_list->isGridAdd())
		$jenisbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jenisbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jenisbarang_list->Recordset)
	$jenisbarang_list->Recordset->Close();
?>
<?php if (!$jenisbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jenisbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenisbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenisbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jenisbarang_list->TotalRecords == 0 && !$jenisbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jenisbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jenisbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenisbarang_list->isExport()) { ?>
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
$jenisbarang_list->terminate();
?>