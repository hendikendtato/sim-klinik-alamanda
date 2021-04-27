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
$m_agama_list = new m_agama_list();

// Run the page
$m_agama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_agama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_agama_list->isExport()) { ?>
<script>
var fm_agamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_agamalist = currentForm = new ew.Form("fm_agamalist", "list");
	fm_agamalist.formKeyCountName = '<?php echo $m_agama_list->FormKeyCountName ?>';
	loadjs.done("fm_agamalist");
});
var fm_agamalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_agamalistsrch = currentSearchForm = new ew.Form("fm_agamalistsrch");

	// Dynamic selection lists
	// Filters

	fm_agamalistsrch.filterList = <?php echo $m_agama_list->getFilterList() ?>;
	loadjs.done("fm_agamalistsrch");
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
<?php if (!$m_agama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_agama_list->TotalRecords > 0 && $m_agama_list->ExportOptions->visible()) { ?>
<?php $m_agama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_agama_list->ImportOptions->visible()) { ?>
<?php $m_agama_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_agama_list->SearchOptions->visible()) { ?>
<?php $m_agama_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_agama_list->FilterOptions->visible()) { ?>
<?php $m_agama_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_agama_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_agama_list->isExport() && !$m_agama->CurrentAction) { ?>
<form name="fm_agamalistsrch" id="fm_agamalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_agamalistsrch-search-panel" class="<?php echo $m_agama_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_agama">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_agama_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_agama_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_agama_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_agama_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_agama_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_agama_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_agama_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_agama_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_agama_list->showPageHeader(); ?>
<?php
$m_agama_list->showMessage();
?>
<?php if ($m_agama_list->TotalRecords > 0 || $m_agama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_agama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_agama">
<?php if (!$m_agama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_agama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_agama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_agama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_agamalist" id="fm_agamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_agama">
<div id="gmp_m_agama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_agama_list->TotalRecords > 0 || $m_agama_list->isGridEdit()) { ?>
<table id="tbl_m_agamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_agama->RowType = ROWTYPE_HEADER;

// Render list options
$m_agama_list->renderListOptions();

// Render list options (header, left)
$m_agama_list->ListOptions->render("header", "left");
?>
<?php if ($m_agama_list->id_agama->Visible) { // id_agama ?>
	<?php if ($m_agama_list->SortUrl($m_agama_list->id_agama) == "") { ?>
		<th data-name="id_agama" class="<?php echo $m_agama_list->id_agama->headerCellClass() ?>"><div id="elh_m_agama_id_agama" class="m_agama_id_agama"><div class="ew-table-header-caption"><?php echo $m_agama_list->id_agama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_agama" class="<?php echo $m_agama_list->id_agama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_agama_list->SortUrl($m_agama_list->id_agama) ?>', 1);"><div id="elh_m_agama_id_agama" class="m_agama_id_agama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_agama_list->id_agama->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_agama_list->id_agama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_agama_list->id_agama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_agama_list->nama_agama->Visible) { // nama_agama ?>
	<?php if ($m_agama_list->SortUrl($m_agama_list->nama_agama) == "") { ?>
		<th data-name="nama_agama" class="<?php echo $m_agama_list->nama_agama->headerCellClass() ?>"><div id="elh_m_agama_nama_agama" class="m_agama_nama_agama"><div class="ew-table-header-caption"><?php echo $m_agama_list->nama_agama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_agama" class="<?php echo $m_agama_list->nama_agama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_agama_list->SortUrl($m_agama_list->nama_agama) ?>', 1);"><div id="elh_m_agama_nama_agama" class="m_agama_nama_agama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_agama_list->nama_agama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_agama_list->nama_agama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_agama_list->nama_agama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_agama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_agama_list->ExportAll && $m_agama_list->isExport()) {
	$m_agama_list->StopRecord = $m_agama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_agama_list->TotalRecords > $m_agama_list->StartRecord + $m_agama_list->DisplayRecords - 1)
		$m_agama_list->StopRecord = $m_agama_list->StartRecord + $m_agama_list->DisplayRecords - 1;
	else
		$m_agama_list->StopRecord = $m_agama_list->TotalRecords;
}
$m_agama_list->RecordCount = $m_agama_list->StartRecord - 1;
if ($m_agama_list->Recordset && !$m_agama_list->Recordset->EOF) {
	$m_agama_list->Recordset->moveFirst();
	$selectLimit = $m_agama_list->UseSelectLimit;
	if (!$selectLimit && $m_agama_list->StartRecord > 1)
		$m_agama_list->Recordset->move($m_agama_list->StartRecord - 1);
} elseif (!$m_agama->AllowAddDeleteRow && $m_agama_list->StopRecord == 0) {
	$m_agama_list->StopRecord = $m_agama->GridAddRowCount;
}

// Initialize aggregate
$m_agama->RowType = ROWTYPE_AGGREGATEINIT;
$m_agama->resetAttributes();
$m_agama_list->renderRow();
while ($m_agama_list->RecordCount < $m_agama_list->StopRecord) {
	$m_agama_list->RecordCount++;
	if ($m_agama_list->RecordCount >= $m_agama_list->StartRecord) {
		$m_agama_list->RowCount++;

		// Set up key count
		$m_agama_list->KeyCount = $m_agama_list->RowIndex;

		// Init row class and style
		$m_agama->resetAttributes();
		$m_agama->CssClass = "";
		if ($m_agama_list->isGridAdd()) {
		} else {
			$m_agama_list->loadRowValues($m_agama_list->Recordset); // Load row values
		}
		$m_agama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_agama->RowAttrs->merge(["data-rowindex" => $m_agama_list->RowCount, "id" => "r" . $m_agama_list->RowCount . "_m_agama", "data-rowtype" => $m_agama->RowType]);

		// Render row
		$m_agama_list->renderRow();

		// Render list options
		$m_agama_list->renderListOptions();
?>
	<tr <?php echo $m_agama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_agama_list->ListOptions->render("body", "left", $m_agama_list->RowCount);
?>
	<?php if ($m_agama_list->id_agama->Visible) { // id_agama ?>
		<td data-name="id_agama" <?php echo $m_agama_list->id_agama->cellAttributes() ?>>
<span id="el<?php echo $m_agama_list->RowCount ?>_m_agama_id_agama">
<span<?php echo $m_agama_list->id_agama->viewAttributes() ?>><?php echo $m_agama_list->id_agama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_agama_list->nama_agama->Visible) { // nama_agama ?>
		<td data-name="nama_agama" <?php echo $m_agama_list->nama_agama->cellAttributes() ?>>
<span id="el<?php echo $m_agama_list->RowCount ?>_m_agama_nama_agama">
<span<?php echo $m_agama_list->nama_agama->viewAttributes() ?>><?php echo $m_agama_list->nama_agama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_agama_list->ListOptions->render("body", "right", $m_agama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_agama_list->isGridAdd())
		$m_agama_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_agama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_agama_list->Recordset)
	$m_agama_list->Recordset->Close();
?>
<?php if (!$m_agama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_agama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_agama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_agama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_agama_list->TotalRecords == 0 && !$m_agama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_agama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_agama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_agama_list->isExport()) { ?>
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
$m_agama_list->terminate();
?>