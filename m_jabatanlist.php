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
$m_jabatan_list = new m_jabatan_list();

// Run the page
$m_jabatan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jabatan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_jabatan_list->isExport()) { ?>
<script>
var fm_jabatanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_jabatanlist = currentForm = new ew.Form("fm_jabatanlist", "list");
	fm_jabatanlist.formKeyCountName = '<?php echo $m_jabatan_list->FormKeyCountName ?>';
	loadjs.done("fm_jabatanlist");
});
var fm_jabatanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_jabatanlistsrch = currentSearchForm = new ew.Form("fm_jabatanlistsrch");

	// Dynamic selection lists
	// Filters

	fm_jabatanlistsrch.filterList = <?php echo $m_jabatan_list->getFilterList() ?>;
	loadjs.done("fm_jabatanlistsrch");
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
<?php if (!$m_jabatan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_jabatan_list->TotalRecords > 0 && $m_jabatan_list->ExportOptions->visible()) { ?>
<?php $m_jabatan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_jabatan_list->ImportOptions->visible()) { ?>
<?php $m_jabatan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_jabatan_list->SearchOptions->visible()) { ?>
<?php $m_jabatan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_jabatan_list->FilterOptions->visible()) { ?>
<?php $m_jabatan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_jabatan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_jabatan_list->isExport() && !$m_jabatan->CurrentAction) { ?>
<form name="fm_jabatanlistsrch" id="fm_jabatanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_jabatanlistsrch-search-panel" class="<?php echo $m_jabatan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_jabatan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_jabatan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_jabatan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_jabatan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_jabatan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_jabatan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_jabatan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_jabatan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_jabatan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_jabatan_list->showPageHeader(); ?>
<?php
$m_jabatan_list->showMessage();
?>
<?php if ($m_jabatan_list->TotalRecords > 0 || $m_jabatan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_jabatan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_jabatan">
<?php if (!$m_jabatan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_jabatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_jabatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_jabatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_jabatanlist" id="fm_jabatanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jabatan">
<div id="gmp_m_jabatan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_jabatan_list->TotalRecords > 0 || $m_jabatan_list->isGridEdit()) { ?>
<table id="tbl_m_jabatanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_jabatan->RowType = ROWTYPE_HEADER;

// Render list options
$m_jabatan_list->renderListOptions();

// Render list options (header, left)
$m_jabatan_list->ListOptions->render("header", "left");
?>
<?php if ($m_jabatan_list->id->Visible) { // id ?>
	<?php if ($m_jabatan_list->SortUrl($m_jabatan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_jabatan_list->id->headerCellClass() ?>"><div id="elh_m_jabatan_id" class="m_jabatan_id"><div class="ew-table-header-caption"><?php echo $m_jabatan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_jabatan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jabatan_list->SortUrl($m_jabatan_list->id) ?>', 1);"><div id="elh_m_jabatan_id" class="m_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jabatan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jabatan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jabatan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jabatan_list->nama_jabatan->Visible) { // nama_jabatan ?>
	<?php if ($m_jabatan_list->SortUrl($m_jabatan_list->nama_jabatan) == "") { ?>
		<th data-name="nama_jabatan" class="<?php echo $m_jabatan_list->nama_jabatan->headerCellClass() ?>"><div id="elh_m_jabatan_nama_jabatan" class="m_jabatan_nama_jabatan"><div class="ew-table-header-caption"><?php echo $m_jabatan_list->nama_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_jabatan" class="<?php echo $m_jabatan_list->nama_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jabatan_list->SortUrl($m_jabatan_list->nama_jabatan) ?>', 1);"><div id="elh_m_jabatan_nama_jabatan" class="m_jabatan_nama_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jabatan_list->nama_jabatan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_jabatan_list->nama_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jabatan_list->nama_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_jabatan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_jabatan_list->ExportAll && $m_jabatan_list->isExport()) {
	$m_jabatan_list->StopRecord = $m_jabatan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_jabatan_list->TotalRecords > $m_jabatan_list->StartRecord + $m_jabatan_list->DisplayRecords - 1)
		$m_jabatan_list->StopRecord = $m_jabatan_list->StartRecord + $m_jabatan_list->DisplayRecords - 1;
	else
		$m_jabatan_list->StopRecord = $m_jabatan_list->TotalRecords;
}
$m_jabatan_list->RecordCount = $m_jabatan_list->StartRecord - 1;
if ($m_jabatan_list->Recordset && !$m_jabatan_list->Recordset->EOF) {
	$m_jabatan_list->Recordset->moveFirst();
	$selectLimit = $m_jabatan_list->UseSelectLimit;
	if (!$selectLimit && $m_jabatan_list->StartRecord > 1)
		$m_jabatan_list->Recordset->move($m_jabatan_list->StartRecord - 1);
} elseif (!$m_jabatan->AllowAddDeleteRow && $m_jabatan_list->StopRecord == 0) {
	$m_jabatan_list->StopRecord = $m_jabatan->GridAddRowCount;
}

// Initialize aggregate
$m_jabatan->RowType = ROWTYPE_AGGREGATEINIT;
$m_jabatan->resetAttributes();
$m_jabatan_list->renderRow();
while ($m_jabatan_list->RecordCount < $m_jabatan_list->StopRecord) {
	$m_jabatan_list->RecordCount++;
	if ($m_jabatan_list->RecordCount >= $m_jabatan_list->StartRecord) {
		$m_jabatan_list->RowCount++;

		// Set up key count
		$m_jabatan_list->KeyCount = $m_jabatan_list->RowIndex;

		// Init row class and style
		$m_jabatan->resetAttributes();
		$m_jabatan->CssClass = "";
		if ($m_jabatan_list->isGridAdd()) {
		} else {
			$m_jabatan_list->loadRowValues($m_jabatan_list->Recordset); // Load row values
		}
		$m_jabatan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_jabatan->RowAttrs->merge(["data-rowindex" => $m_jabatan_list->RowCount, "id" => "r" . $m_jabatan_list->RowCount . "_m_jabatan", "data-rowtype" => $m_jabatan->RowType]);

		// Render row
		$m_jabatan_list->renderRow();

		// Render list options
		$m_jabatan_list->renderListOptions();
?>
	<tr <?php echo $m_jabatan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_jabatan_list->ListOptions->render("body", "left", $m_jabatan_list->RowCount);
?>
	<?php if ($m_jabatan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_jabatan_list->id->cellAttributes() ?>>
<span id="el<?php echo $m_jabatan_list->RowCount ?>_m_jabatan_id">
<span<?php echo $m_jabatan_list->id->viewAttributes() ?>><?php echo $m_jabatan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jabatan_list->nama_jabatan->Visible) { // nama_jabatan ?>
		<td data-name="nama_jabatan" <?php echo $m_jabatan_list->nama_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_jabatan_list->RowCount ?>_m_jabatan_nama_jabatan">
<span<?php echo $m_jabatan_list->nama_jabatan->viewAttributes() ?>><?php echo $m_jabatan_list->nama_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_jabatan_list->ListOptions->render("body", "right", $m_jabatan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_jabatan_list->isGridAdd())
		$m_jabatan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_jabatan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_jabatan_list->Recordset)
	$m_jabatan_list->Recordset->Close();
?>
<?php if (!$m_jabatan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_jabatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_jabatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_jabatan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_jabatan_list->TotalRecords == 0 && !$m_jabatan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_jabatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_jabatan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_jabatan_list->isExport()) { ?>
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
$m_jabatan_list->terminate();
?>