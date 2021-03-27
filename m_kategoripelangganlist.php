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
$m_kategoripelanggan_list = new m_kategoripelanggan_list();

// Run the page
$m_kategoripelanggan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kategoripelanggan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kategoripelanggan_list->isExport()) { ?>
<script>
var fm_kategoripelangganlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_kategoripelangganlist = currentForm = new ew.Form("fm_kategoripelangganlist", "list");
	fm_kategoripelangganlist.formKeyCountName = '<?php echo $m_kategoripelanggan_list->FormKeyCountName ?>';
	loadjs.done("fm_kategoripelangganlist");
});
var fm_kategoripelangganlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_kategoripelangganlistsrch = currentSearchForm = new ew.Form("fm_kategoripelangganlistsrch");

	// Dynamic selection lists
	// Filters

	fm_kategoripelangganlistsrch.filterList = <?php echo $m_kategoripelanggan_list->getFilterList() ?>;
	loadjs.done("fm_kategoripelangganlistsrch");
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
<?php if (!$m_kategoripelanggan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_kategoripelanggan_list->TotalRecords > 0 && $m_kategoripelanggan_list->ExportOptions->visible()) { ?>
<?php $m_kategoripelanggan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kategoripelanggan_list->ImportOptions->visible()) { ?>
<?php $m_kategoripelanggan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kategoripelanggan_list->SearchOptions->visible()) { ?>
<?php $m_kategoripelanggan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_kategoripelanggan_list->FilterOptions->visible()) { ?>
<?php $m_kategoripelanggan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_kategoripelanggan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_kategoripelanggan_list->isExport() && !$m_kategoripelanggan->CurrentAction) { ?>
<form name="fm_kategoripelangganlistsrch" id="fm_kategoripelangganlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_kategoripelangganlistsrch-search-panel" class="<?php echo $m_kategoripelanggan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_kategoripelanggan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_kategoripelanggan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_kategoripelanggan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_kategoripelanggan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_kategoripelanggan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_kategoripelanggan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_kategoripelanggan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_kategoripelanggan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_kategoripelanggan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_kategoripelanggan_list->showPageHeader(); ?>
<?php
$m_kategoripelanggan_list->showMessage();
?>
<?php if ($m_kategoripelanggan_list->TotalRecords > 0 || $m_kategoripelanggan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_kategoripelanggan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_kategoripelanggan">
<?php if (!$m_kategoripelanggan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_kategoripelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kategoripelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kategoripelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_kategoripelangganlist" id="fm_kategoripelangganlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kategoripelanggan">
<div id="gmp_m_kategoripelanggan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_kategoripelanggan_list->TotalRecords > 0 || $m_kategoripelanggan_list->isGridEdit()) { ?>
<table id="tbl_m_kategoripelangganlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_kategoripelanggan->RowType = ROWTYPE_HEADER;

// Render list options
$m_kategoripelanggan_list->renderListOptions();

// Render list options (header, left)
$m_kategoripelanggan_list->ListOptions->render("header", "left");
?>
<?php if ($m_kategoripelanggan_list->nama_kategori->Visible) { // nama_kategori ?>
	<?php if ($m_kategoripelanggan_list->SortUrl($m_kategoripelanggan_list->nama_kategori) == "") { ?>
		<th data-name="nama_kategori" class="<?php echo $m_kategoripelanggan_list->nama_kategori->headerCellClass() ?>"><div id="elh_m_kategoripelanggan_nama_kategori" class="m_kategoripelanggan_nama_kategori"><div class="ew-table-header-caption"><?php echo $m_kategoripelanggan_list->nama_kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_kategori" class="<?php echo $m_kategoripelanggan_list->nama_kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kategoripelanggan_list->SortUrl($m_kategoripelanggan_list->nama_kategori) ?>', 1);"><div id="elh_m_kategoripelanggan_nama_kategori" class="m_kategoripelanggan_nama_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kategoripelanggan_list->nama_kategori->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_kategoripelanggan_list->nama_kategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kategoripelanggan_list->nama_kategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_kategoripelanggan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_kategoripelanggan_list->ExportAll && $m_kategoripelanggan_list->isExport()) {
	$m_kategoripelanggan_list->StopRecord = $m_kategoripelanggan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_kategoripelanggan_list->TotalRecords > $m_kategoripelanggan_list->StartRecord + $m_kategoripelanggan_list->DisplayRecords - 1)
		$m_kategoripelanggan_list->StopRecord = $m_kategoripelanggan_list->StartRecord + $m_kategoripelanggan_list->DisplayRecords - 1;
	else
		$m_kategoripelanggan_list->StopRecord = $m_kategoripelanggan_list->TotalRecords;
}
$m_kategoripelanggan_list->RecordCount = $m_kategoripelanggan_list->StartRecord - 1;
if ($m_kategoripelanggan_list->Recordset && !$m_kategoripelanggan_list->Recordset->EOF) {
	$m_kategoripelanggan_list->Recordset->moveFirst();
	$selectLimit = $m_kategoripelanggan_list->UseSelectLimit;
	if (!$selectLimit && $m_kategoripelanggan_list->StartRecord > 1)
		$m_kategoripelanggan_list->Recordset->move($m_kategoripelanggan_list->StartRecord - 1);
} elseif (!$m_kategoripelanggan->AllowAddDeleteRow && $m_kategoripelanggan_list->StopRecord == 0) {
	$m_kategoripelanggan_list->StopRecord = $m_kategoripelanggan->GridAddRowCount;
}

// Initialize aggregate
$m_kategoripelanggan->RowType = ROWTYPE_AGGREGATEINIT;
$m_kategoripelanggan->resetAttributes();
$m_kategoripelanggan_list->renderRow();
while ($m_kategoripelanggan_list->RecordCount < $m_kategoripelanggan_list->StopRecord) {
	$m_kategoripelanggan_list->RecordCount++;
	if ($m_kategoripelanggan_list->RecordCount >= $m_kategoripelanggan_list->StartRecord) {
		$m_kategoripelanggan_list->RowCount++;

		// Set up key count
		$m_kategoripelanggan_list->KeyCount = $m_kategoripelanggan_list->RowIndex;

		// Init row class and style
		$m_kategoripelanggan->resetAttributes();
		$m_kategoripelanggan->CssClass = "";
		if ($m_kategoripelanggan_list->isGridAdd()) {
		} else {
			$m_kategoripelanggan_list->loadRowValues($m_kategoripelanggan_list->Recordset); // Load row values
		}
		$m_kategoripelanggan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_kategoripelanggan->RowAttrs->merge(["data-rowindex" => $m_kategoripelanggan_list->RowCount, "id" => "r" . $m_kategoripelanggan_list->RowCount . "_m_kategoripelanggan", "data-rowtype" => $m_kategoripelanggan->RowType]);

		// Render row
		$m_kategoripelanggan_list->renderRow();

		// Render list options
		$m_kategoripelanggan_list->renderListOptions();
?>
	<tr <?php echo $m_kategoripelanggan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_kategoripelanggan_list->ListOptions->render("body", "left", $m_kategoripelanggan_list->RowCount);
?>
	<?php if ($m_kategoripelanggan_list->nama_kategori->Visible) { // nama_kategori ?>
		<td data-name="nama_kategori" <?php echo $m_kategoripelanggan_list->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $m_kategoripelanggan_list->RowCount ?>_m_kategoripelanggan_nama_kategori">
<span<?php echo $m_kategoripelanggan_list->nama_kategori->viewAttributes() ?>><?php echo $m_kategoripelanggan_list->nama_kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_kategoripelanggan_list->ListOptions->render("body", "right", $m_kategoripelanggan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_kategoripelanggan_list->isGridAdd())
		$m_kategoripelanggan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_kategoripelanggan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_kategoripelanggan_list->Recordset)
	$m_kategoripelanggan_list->Recordset->Close();
?>
<?php if (!$m_kategoripelanggan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_kategoripelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kategoripelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kategoripelanggan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_kategoripelanggan_list->TotalRecords == 0 && !$m_kategoripelanggan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_kategoripelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_kategoripelanggan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kategoripelanggan_list->isExport()) { ?>
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
$m_kategoripelanggan_list->terminate();
?>