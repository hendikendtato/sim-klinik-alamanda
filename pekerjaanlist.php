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
$pekerjaan_list = new pekerjaan_list();

// Run the page
$pekerjaan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pekerjaan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pekerjaan_list->isExport()) { ?>
<script>
var fpekerjaanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpekerjaanlist = currentForm = new ew.Form("fpekerjaanlist", "list");
	fpekerjaanlist.formKeyCountName = '<?php echo $pekerjaan_list->FormKeyCountName ?>';
	loadjs.done("fpekerjaanlist");
});
var fpekerjaanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpekerjaanlistsrch = currentSearchForm = new ew.Form("fpekerjaanlistsrch");

	// Dynamic selection lists
	// Filters

	fpekerjaanlistsrch.filterList = <?php echo $pekerjaan_list->getFilterList() ?>;
	loadjs.done("fpekerjaanlistsrch");
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
<?php if (!$pekerjaan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pekerjaan_list->TotalRecords > 0 && $pekerjaan_list->ExportOptions->visible()) { ?>
<?php $pekerjaan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pekerjaan_list->ImportOptions->visible()) { ?>
<?php $pekerjaan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pekerjaan_list->SearchOptions->visible()) { ?>
<?php $pekerjaan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pekerjaan_list->FilterOptions->visible()) { ?>
<?php $pekerjaan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pekerjaan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pekerjaan_list->isExport() && !$pekerjaan->CurrentAction) { ?>
<form name="fpekerjaanlistsrch" id="fpekerjaanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpekerjaanlistsrch-search-panel" class="<?php echo $pekerjaan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pekerjaan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pekerjaan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pekerjaan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pekerjaan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pekerjaan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pekerjaan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pekerjaan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pekerjaan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pekerjaan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pekerjaan_list->showPageHeader(); ?>
<?php
$pekerjaan_list->showMessage();
?>
<?php if ($pekerjaan_list->TotalRecords > 0 || $pekerjaan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pekerjaan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pekerjaan">
<?php if (!$pekerjaan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pekerjaan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pekerjaan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pekerjaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpekerjaanlist" id="fpekerjaanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pekerjaan">
<div id="gmp_pekerjaan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pekerjaan_list->TotalRecords > 0 || $pekerjaan_list->isGridEdit()) { ?>
<table id="tbl_pekerjaanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pekerjaan->RowType = ROWTYPE_HEADER;

// Render list options
$pekerjaan_list->renderListOptions();

// Render list options (header, left)
$pekerjaan_list->ListOptions->render("header", "left");
?>
<?php if ($pekerjaan_list->id->Visible) { // id ?>
	<?php if ($pekerjaan_list->SortUrl($pekerjaan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $pekerjaan_list->id->headerCellClass() ?>"><div id="elh_pekerjaan_id" class="pekerjaan_id"><div class="ew-table-header-caption"><?php echo $pekerjaan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $pekerjaan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pekerjaan_list->SortUrl($pekerjaan_list->id) ?>', 1);"><div id="elh_pekerjaan_id" class="pekerjaan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pekerjaan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pekerjaan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pekerjaan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pekerjaan_list->nama->Visible) { // nama ?>
	<?php if ($pekerjaan_list->SortUrl($pekerjaan_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $pekerjaan_list->nama->headerCellClass() ?>"><div id="elh_pekerjaan_nama" class="pekerjaan_nama"><div class="ew-table-header-caption"><?php echo $pekerjaan_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $pekerjaan_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pekerjaan_list->SortUrl($pekerjaan_list->nama) ?>', 1);"><div id="elh_pekerjaan_nama" class="pekerjaan_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pekerjaan_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pekerjaan_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pekerjaan_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pekerjaan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pekerjaan_list->ExportAll && $pekerjaan_list->isExport()) {
	$pekerjaan_list->StopRecord = $pekerjaan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pekerjaan_list->TotalRecords > $pekerjaan_list->StartRecord + $pekerjaan_list->DisplayRecords - 1)
		$pekerjaan_list->StopRecord = $pekerjaan_list->StartRecord + $pekerjaan_list->DisplayRecords - 1;
	else
		$pekerjaan_list->StopRecord = $pekerjaan_list->TotalRecords;
}
$pekerjaan_list->RecordCount = $pekerjaan_list->StartRecord - 1;
if ($pekerjaan_list->Recordset && !$pekerjaan_list->Recordset->EOF) {
	$pekerjaan_list->Recordset->moveFirst();
	$selectLimit = $pekerjaan_list->UseSelectLimit;
	if (!$selectLimit && $pekerjaan_list->StartRecord > 1)
		$pekerjaan_list->Recordset->move($pekerjaan_list->StartRecord - 1);
} elseif (!$pekerjaan->AllowAddDeleteRow && $pekerjaan_list->StopRecord == 0) {
	$pekerjaan_list->StopRecord = $pekerjaan->GridAddRowCount;
}

// Initialize aggregate
$pekerjaan->RowType = ROWTYPE_AGGREGATEINIT;
$pekerjaan->resetAttributes();
$pekerjaan_list->renderRow();
while ($pekerjaan_list->RecordCount < $pekerjaan_list->StopRecord) {
	$pekerjaan_list->RecordCount++;
	if ($pekerjaan_list->RecordCount >= $pekerjaan_list->StartRecord) {
		$pekerjaan_list->RowCount++;

		// Set up key count
		$pekerjaan_list->KeyCount = $pekerjaan_list->RowIndex;

		// Init row class and style
		$pekerjaan->resetAttributes();
		$pekerjaan->CssClass = "";
		if ($pekerjaan_list->isGridAdd()) {
		} else {
			$pekerjaan_list->loadRowValues($pekerjaan_list->Recordset); // Load row values
		}
		$pekerjaan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pekerjaan->RowAttrs->merge(["data-rowindex" => $pekerjaan_list->RowCount, "id" => "r" . $pekerjaan_list->RowCount . "_pekerjaan", "data-rowtype" => $pekerjaan->RowType]);

		// Render row
		$pekerjaan_list->renderRow();

		// Render list options
		$pekerjaan_list->renderListOptions();
?>
	<tr <?php echo $pekerjaan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pekerjaan_list->ListOptions->render("body", "left", $pekerjaan_list->RowCount);
?>
	<?php if ($pekerjaan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $pekerjaan_list->id->cellAttributes() ?>>
<span id="el<?php echo $pekerjaan_list->RowCount ?>_pekerjaan_id">
<span<?php echo $pekerjaan_list->id->viewAttributes() ?>><?php echo $pekerjaan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pekerjaan_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $pekerjaan_list->nama->cellAttributes() ?>>
<span id="el<?php echo $pekerjaan_list->RowCount ?>_pekerjaan_nama">
<span<?php echo $pekerjaan_list->nama->viewAttributes() ?>><?php echo $pekerjaan_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pekerjaan_list->ListOptions->render("body", "right", $pekerjaan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pekerjaan_list->isGridAdd())
		$pekerjaan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pekerjaan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pekerjaan_list->Recordset)
	$pekerjaan_list->Recordset->Close();
?>
<?php if (!$pekerjaan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pekerjaan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pekerjaan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pekerjaan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pekerjaan_list->TotalRecords == 0 && !$pekerjaan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pekerjaan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pekerjaan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pekerjaan_list->isExport()) { ?>
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
$pekerjaan_list->terminate();
?>