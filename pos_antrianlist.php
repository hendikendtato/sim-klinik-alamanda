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
$pos_antrian_list = new pos_antrian_list();

// Run the page
$pos_antrian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pos_antrian_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pos_antrian_list->isExport()) { ?>
<script>
var fpos_antrianlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpos_antrianlist = currentForm = new ew.Form("fpos_antrianlist", "list");
	fpos_antrianlist.formKeyCountName = '<?php echo $pos_antrian_list->FormKeyCountName ?>';
	loadjs.done("fpos_antrianlist");
});
var fpos_antrianlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpos_antrianlistsrch = currentSearchForm = new ew.Form("fpos_antrianlistsrch");

	// Dynamic selection lists
	// Filters

	fpos_antrianlistsrch.filterList = <?php echo $pos_antrian_list->getFilterList() ?>;
	loadjs.done("fpos_antrianlistsrch");
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
<?php if (!$pos_antrian_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pos_antrian_list->TotalRecords > 0 && $pos_antrian_list->ExportOptions->visible()) { ?>
<?php $pos_antrian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pos_antrian_list->ImportOptions->visible()) { ?>
<?php $pos_antrian_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pos_antrian_list->SearchOptions->visible()) { ?>
<?php $pos_antrian_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pos_antrian_list->FilterOptions->visible()) { ?>
<?php $pos_antrian_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pos_antrian_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pos_antrian_list->isExport() && !$pos_antrian->CurrentAction) { ?>
<form name="fpos_antrianlistsrch" id="fpos_antrianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpos_antrianlistsrch-search-panel" class="<?php echo $pos_antrian_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pos_antrian">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pos_antrian_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pos_antrian_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pos_antrian_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pos_antrian_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pos_antrian_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pos_antrian_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pos_antrian_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pos_antrian_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pos_antrian_list->showPageHeader(); ?>
<?php
$pos_antrian_list->showMessage();
?>
<?php if ($pos_antrian_list->TotalRecords > 0 || $pos_antrian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pos_antrian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pos_antrian">
<?php if (!$pos_antrian_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pos_antrian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pos_antrian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pos_antrian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpos_antrianlist" id="fpos_antrianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pos_antrian">
<div id="gmp_pos_antrian" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pos_antrian_list->TotalRecords > 0 || $pos_antrian_list->isGridEdit()) { ?>
<table id="tbl_pos_antrianlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pos_antrian->RowType = ROWTYPE_HEADER;

// Render list options
$pos_antrian_list->renderListOptions();

// Render list options (header, left)
$pos_antrian_list->ListOptions->render("header", "left");
?>
<?php if ($pos_antrian_list->id_pos_antrian->Visible) { // id_pos_antrian ?>
	<?php if ($pos_antrian_list->SortUrl($pos_antrian_list->id_pos_antrian) == "") { ?>
		<th data-name="id_pos_antrian" class="<?php echo $pos_antrian_list->id_pos_antrian->headerCellClass() ?>"><div id="elh_pos_antrian_id_pos_antrian" class="pos_antrian_id_pos_antrian"><div class="ew-table-header-caption"><?php echo $pos_antrian_list->id_pos_antrian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pos_antrian" class="<?php echo $pos_antrian_list->id_pos_antrian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_antrian_list->SortUrl($pos_antrian_list->id_pos_antrian) ?>', 1);"><div id="elh_pos_antrian_id_pos_antrian" class="pos_antrian_id_pos_antrian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_antrian_list->id_pos_antrian->caption() ?></span><span class="ew-table-header-sort"><?php if ($pos_antrian_list->id_pos_antrian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_antrian_list->id_pos_antrian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pos_antrian_list->nama_pos->Visible) { // nama_pos ?>
	<?php if ($pos_antrian_list->SortUrl($pos_antrian_list->nama_pos) == "") { ?>
		<th data-name="nama_pos" class="<?php echo $pos_antrian_list->nama_pos->headerCellClass() ?>"><div id="elh_pos_antrian_nama_pos" class="pos_antrian_nama_pos"><div class="ew-table-header-caption"><?php echo $pos_antrian_list->nama_pos->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pos" class="<?php echo $pos_antrian_list->nama_pos->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_antrian_list->SortUrl($pos_antrian_list->nama_pos) ?>', 1);"><div id="elh_pos_antrian_nama_pos" class="pos_antrian_nama_pos">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_antrian_list->nama_pos->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pos_antrian_list->nama_pos->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_antrian_list->nama_pos->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pos_antrian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pos_antrian_list->ExportAll && $pos_antrian_list->isExport()) {
	$pos_antrian_list->StopRecord = $pos_antrian_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pos_antrian_list->TotalRecords > $pos_antrian_list->StartRecord + $pos_antrian_list->DisplayRecords - 1)
		$pos_antrian_list->StopRecord = $pos_antrian_list->StartRecord + $pos_antrian_list->DisplayRecords - 1;
	else
		$pos_antrian_list->StopRecord = $pos_antrian_list->TotalRecords;
}
$pos_antrian_list->RecordCount = $pos_antrian_list->StartRecord - 1;
if ($pos_antrian_list->Recordset && !$pos_antrian_list->Recordset->EOF) {
	$pos_antrian_list->Recordset->moveFirst();
	$selectLimit = $pos_antrian_list->UseSelectLimit;
	if (!$selectLimit && $pos_antrian_list->StartRecord > 1)
		$pos_antrian_list->Recordset->move($pos_antrian_list->StartRecord - 1);
} elseif (!$pos_antrian->AllowAddDeleteRow && $pos_antrian_list->StopRecord == 0) {
	$pos_antrian_list->StopRecord = $pos_antrian->GridAddRowCount;
}

// Initialize aggregate
$pos_antrian->RowType = ROWTYPE_AGGREGATEINIT;
$pos_antrian->resetAttributes();
$pos_antrian_list->renderRow();
while ($pos_antrian_list->RecordCount < $pos_antrian_list->StopRecord) {
	$pos_antrian_list->RecordCount++;
	if ($pos_antrian_list->RecordCount >= $pos_antrian_list->StartRecord) {
		$pos_antrian_list->RowCount++;

		// Set up key count
		$pos_antrian_list->KeyCount = $pos_antrian_list->RowIndex;

		// Init row class and style
		$pos_antrian->resetAttributes();
		$pos_antrian->CssClass = "";
		if ($pos_antrian_list->isGridAdd()) {
		} else {
			$pos_antrian_list->loadRowValues($pos_antrian_list->Recordset); // Load row values
		}
		$pos_antrian->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pos_antrian->RowAttrs->merge(["data-rowindex" => $pos_antrian_list->RowCount, "id" => "r" . $pos_antrian_list->RowCount . "_pos_antrian", "data-rowtype" => $pos_antrian->RowType]);

		// Render row
		$pos_antrian_list->renderRow();

		// Render list options
		$pos_antrian_list->renderListOptions();
?>
	<tr <?php echo $pos_antrian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pos_antrian_list->ListOptions->render("body", "left", $pos_antrian_list->RowCount);
?>
	<?php if ($pos_antrian_list->id_pos_antrian->Visible) { // id_pos_antrian ?>
		<td data-name="id_pos_antrian" <?php echo $pos_antrian_list->id_pos_antrian->cellAttributes() ?>>
<span id="el<?php echo $pos_antrian_list->RowCount ?>_pos_antrian_id_pos_antrian">
<span<?php echo $pos_antrian_list->id_pos_antrian->viewAttributes() ?>><?php echo $pos_antrian_list->id_pos_antrian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pos_antrian_list->nama_pos->Visible) { // nama_pos ?>
		<td data-name="nama_pos" <?php echo $pos_antrian_list->nama_pos->cellAttributes() ?>>
<span id="el<?php echo $pos_antrian_list->RowCount ?>_pos_antrian_nama_pos">
<span<?php echo $pos_antrian_list->nama_pos->viewAttributes() ?>><?php echo $pos_antrian_list->nama_pos->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pos_antrian_list->ListOptions->render("body", "right", $pos_antrian_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pos_antrian_list->isGridAdd())
		$pos_antrian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pos_antrian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pos_antrian_list->Recordset)
	$pos_antrian_list->Recordset->Close();
?>
<?php if (!$pos_antrian_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pos_antrian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pos_antrian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pos_antrian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pos_antrian_list->TotalRecords == 0 && !$pos_antrian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pos_antrian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pos_antrian_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pos_antrian_list->isExport()) { ?>
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
$pos_antrian_list->terminate();
?>