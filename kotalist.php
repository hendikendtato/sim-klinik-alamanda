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
$kota_list = new kota_list();

// Run the page
$kota_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kota_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kota_list->isExport()) { ?>
<script>
var fkotalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkotalist = currentForm = new ew.Form("fkotalist", "list");
	fkotalist.formKeyCountName = '<?php echo $kota_list->FormKeyCountName ?>';
	loadjs.done("fkotalist");
});
var fkotalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkotalistsrch = currentSearchForm = new ew.Form("fkotalistsrch");

	// Dynamic selection lists
	// Filters

	fkotalistsrch.filterList = <?php echo $kota_list->getFilterList() ?>;
	loadjs.done("fkotalistsrch");
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
<?php if (!$kota_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kota_list->TotalRecords > 0 && $kota_list->ExportOptions->visible()) { ?>
<?php $kota_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kota_list->ImportOptions->visible()) { ?>
<?php $kota_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kota_list->SearchOptions->visible()) { ?>
<?php $kota_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kota_list->FilterOptions->visible()) { ?>
<?php $kota_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kota_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kota_list->isExport() && !$kota->CurrentAction) { ?>
<form name="fkotalistsrch" id="fkotalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkotalistsrch-search-panel" class="<?php echo $kota_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kota">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kota_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kota_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kota_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kota_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kota_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kota_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kota_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kota_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kota_list->showPageHeader(); ?>
<?php
$kota_list->showMessage();
?>
<?php if ($kota_list->TotalRecords > 0 || $kota->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kota_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kota">
<?php if (!$kota_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kota_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kota_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kota_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkotalist" id="fkotalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kota">
<div id="gmp_kota" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kota_list->TotalRecords > 0 || $kota_list->isGridEdit()) { ?>
<table id="tbl_kotalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kota->RowType = ROWTYPE_HEADER;

// Render list options
$kota_list->renderListOptions();

// Render list options (header, left)
$kota_list->ListOptions->render("header", "left");
?>
<?php if ($kota_list->id->Visible) { // id ?>
	<?php if ($kota_list->SortUrl($kota_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $kota_list->id->headerCellClass() ?>"><div id="elh_kota_id" class="kota_id"><div class="ew-table-header-caption"><?php echo $kota_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $kota_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kota_list->SortUrl($kota_list->id) ?>', 1);"><div id="elh_kota_id" class="kota_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kota_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($kota_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kota_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kota_list->nama->Visible) { // nama ?>
	<?php if ($kota_list->SortUrl($kota_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $kota_list->nama->headerCellClass() ?>"><div id="elh_kota_nama" class="kota_nama"><div class="ew-table-header-caption"><?php echo $kota_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $kota_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kota_list->SortUrl($kota_list->nama) ?>', 1);"><div id="elh_kota_nama" class="kota_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kota_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kota_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kota_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kota_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kota_list->ExportAll && $kota_list->isExport()) {
	$kota_list->StopRecord = $kota_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kota_list->TotalRecords > $kota_list->StartRecord + $kota_list->DisplayRecords - 1)
		$kota_list->StopRecord = $kota_list->StartRecord + $kota_list->DisplayRecords - 1;
	else
		$kota_list->StopRecord = $kota_list->TotalRecords;
}
$kota_list->RecordCount = $kota_list->StartRecord - 1;
if ($kota_list->Recordset && !$kota_list->Recordset->EOF) {
	$kota_list->Recordset->moveFirst();
	$selectLimit = $kota_list->UseSelectLimit;
	if (!$selectLimit && $kota_list->StartRecord > 1)
		$kota_list->Recordset->move($kota_list->StartRecord - 1);
} elseif (!$kota->AllowAddDeleteRow && $kota_list->StopRecord == 0) {
	$kota_list->StopRecord = $kota->GridAddRowCount;
}

// Initialize aggregate
$kota->RowType = ROWTYPE_AGGREGATEINIT;
$kota->resetAttributes();
$kota_list->renderRow();
while ($kota_list->RecordCount < $kota_list->StopRecord) {
	$kota_list->RecordCount++;
	if ($kota_list->RecordCount >= $kota_list->StartRecord) {
		$kota_list->RowCount++;

		// Set up key count
		$kota_list->KeyCount = $kota_list->RowIndex;

		// Init row class and style
		$kota->resetAttributes();
		$kota->CssClass = "";
		if ($kota_list->isGridAdd()) {
		} else {
			$kota_list->loadRowValues($kota_list->Recordset); // Load row values
		}
		$kota->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kota->RowAttrs->merge(["data-rowindex" => $kota_list->RowCount, "id" => "r" . $kota_list->RowCount . "_kota", "data-rowtype" => $kota->RowType]);

		// Render row
		$kota_list->renderRow();

		// Render list options
		$kota_list->renderListOptions();
?>
	<tr <?php echo $kota->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kota_list->ListOptions->render("body", "left", $kota_list->RowCount);
?>
	<?php if ($kota_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $kota_list->id->cellAttributes() ?>>
<span id="el<?php echo $kota_list->RowCount ?>_kota_id">
<span<?php echo $kota_list->id->viewAttributes() ?>><?php echo $kota_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kota_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $kota_list->nama->cellAttributes() ?>>
<span id="el<?php echo $kota_list->RowCount ?>_kota_nama">
<span<?php echo $kota_list->nama->viewAttributes() ?>><?php echo $kota_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kota_list->ListOptions->render("body", "right", $kota_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kota_list->isGridAdd())
		$kota_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kota->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kota_list->Recordset)
	$kota_list->Recordset->Close();
?>
<?php if (!$kota_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kota_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kota_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kota_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kota_list->TotalRecords == 0 && !$kota->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kota_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kota_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kota_list->isExport()) { ?>
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
$kota_list->terminate();
?>