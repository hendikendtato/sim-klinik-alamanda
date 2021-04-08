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
$komposisi_list = new komposisi_list();

// Run the page
$komposisi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komposisi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$komposisi_list->isExport()) { ?>
<script>
var fkomposisilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkomposisilist = currentForm = new ew.Form("fkomposisilist", "list");
	fkomposisilist.formKeyCountName = '<?php echo $komposisi_list->FormKeyCountName ?>';
	loadjs.done("fkomposisilist");
});
var fkomposisilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkomposisilistsrch = currentSearchForm = new ew.Form("fkomposisilistsrch");

	// Dynamic selection lists
	// Filters

	fkomposisilistsrch.filterList = <?php echo $komposisi_list->getFilterList() ?>;
	loadjs.done("fkomposisilistsrch");
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
<?php if (!$komposisi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($komposisi_list->TotalRecords > 0 && $komposisi_list->ExportOptions->visible()) { ?>
<?php $komposisi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($komposisi_list->ImportOptions->visible()) { ?>
<?php $komposisi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($komposisi_list->SearchOptions->visible()) { ?>
<?php $komposisi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($komposisi_list->FilterOptions->visible()) { ?>
<?php $komposisi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$komposisi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$komposisi_list->isExport() && !$komposisi->CurrentAction) { ?>
<form name="fkomposisilistsrch" id="fkomposisilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkomposisilistsrch-search-panel" class="<?php echo $komposisi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="komposisi">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $komposisi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($komposisi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($komposisi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $komposisi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($komposisi_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($komposisi_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($komposisi_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($komposisi_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $komposisi_list->showPageHeader(); ?>
<?php
$komposisi_list->showMessage();
?>
<?php if ($komposisi_list->TotalRecords > 0 || $komposisi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($komposisi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> komposisi">
<?php if (!$komposisi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$komposisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $komposisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $komposisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkomposisilist" id="fkomposisilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komposisi">
<div id="gmp_komposisi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($komposisi_list->TotalRecords > 0 || $komposisi_list->isGridEdit()) { ?>
<table id="tbl_komposisilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$komposisi->RowType = ROWTYPE_HEADER;

// Render list options
$komposisi_list->renderListOptions();

// Render list options (header, left)
$komposisi_list->ListOptions->render("header", "left");
?>
<?php if ($komposisi_list->id_komposisi->Visible) { // id_komposisi ?>
	<?php if ($komposisi_list->SortUrl($komposisi_list->id_komposisi) == "") { ?>
		<th data-name="id_komposisi" class="<?php echo $komposisi_list->id_komposisi->headerCellClass() ?>"><div id="elh_komposisi_id_komposisi" class="komposisi_id_komposisi"><div class="ew-table-header-caption"><?php echo $komposisi_list->id_komposisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_komposisi" class="<?php echo $komposisi_list->id_komposisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komposisi_list->SortUrl($komposisi_list->id_komposisi) ?>', 1);"><div id="elh_komposisi_id_komposisi" class="komposisi_id_komposisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komposisi_list->id_komposisi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($komposisi_list->id_komposisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komposisi_list->id_komposisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komposisi_list->id_barang->Visible) { // id_barang ?>
	<?php if ($komposisi_list->SortUrl($komposisi_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $komposisi_list->id_barang->headerCellClass() ?>"><div id="elh_komposisi_id_barang" class="komposisi_id_barang"><div class="ew-table-header-caption"><?php echo $komposisi_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $komposisi_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komposisi_list->SortUrl($komposisi_list->id_barang) ?>', 1);"><div id="elh_komposisi_id_barang" class="komposisi_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komposisi_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($komposisi_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komposisi_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$komposisi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($komposisi_list->ExportAll && $komposisi_list->isExport()) {
	$komposisi_list->StopRecord = $komposisi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($komposisi_list->TotalRecords > $komposisi_list->StartRecord + $komposisi_list->DisplayRecords - 1)
		$komposisi_list->StopRecord = $komposisi_list->StartRecord + $komposisi_list->DisplayRecords - 1;
	else
		$komposisi_list->StopRecord = $komposisi_list->TotalRecords;
}
$komposisi_list->RecordCount = $komposisi_list->StartRecord - 1;
if ($komposisi_list->Recordset && !$komposisi_list->Recordset->EOF) {
	$komposisi_list->Recordset->moveFirst();
	$selectLimit = $komposisi_list->UseSelectLimit;
	if (!$selectLimit && $komposisi_list->StartRecord > 1)
		$komposisi_list->Recordset->move($komposisi_list->StartRecord - 1);
} elseif (!$komposisi->AllowAddDeleteRow && $komposisi_list->StopRecord == 0) {
	$komposisi_list->StopRecord = $komposisi->GridAddRowCount;
}

// Initialize aggregate
$komposisi->RowType = ROWTYPE_AGGREGATEINIT;
$komposisi->resetAttributes();
$komposisi_list->renderRow();
while ($komposisi_list->RecordCount < $komposisi_list->StopRecord) {
	$komposisi_list->RecordCount++;
	if ($komposisi_list->RecordCount >= $komposisi_list->StartRecord) {
		$komposisi_list->RowCount++;

		// Set up key count
		$komposisi_list->KeyCount = $komposisi_list->RowIndex;

		// Init row class and style
		$komposisi->resetAttributes();
		$komposisi->CssClass = "";
		if ($komposisi_list->isGridAdd()) {
		} else {
			$komposisi_list->loadRowValues($komposisi_list->Recordset); // Load row values
		}
		$komposisi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$komposisi->RowAttrs->merge(["data-rowindex" => $komposisi_list->RowCount, "id" => "r" . $komposisi_list->RowCount . "_komposisi", "data-rowtype" => $komposisi->RowType]);

		// Render row
		$komposisi_list->renderRow();

		// Render list options
		$komposisi_list->renderListOptions();
?>
	<tr <?php echo $komposisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$komposisi_list->ListOptions->render("body", "left", $komposisi_list->RowCount);
?>
	<?php if ($komposisi_list->id_komposisi->Visible) { // id_komposisi ?>
		<td data-name="id_komposisi" <?php echo $komposisi_list->id_komposisi->cellAttributes() ?>>
<span id="el<?php echo $komposisi_list->RowCount ?>_komposisi_id_komposisi">
<span<?php echo $komposisi_list->id_komposisi->viewAttributes() ?>><?php echo $komposisi_list->id_komposisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($komposisi_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $komposisi_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $komposisi_list->RowCount ?>_komposisi_id_barang">
<span<?php echo $komposisi_list->id_barang->viewAttributes() ?>><?php echo $komposisi_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$komposisi_list->ListOptions->render("body", "right", $komposisi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$komposisi_list->isGridAdd())
		$komposisi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$komposisi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($komposisi_list->Recordset)
	$komposisi_list->Recordset->Close();
?>
<?php if (!$komposisi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$komposisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $komposisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $komposisi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($komposisi_list->TotalRecords == 0 && !$komposisi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $komposisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$komposisi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$komposisi_list->isExport()) { ?>
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
$komposisi_list->terminate();
?>