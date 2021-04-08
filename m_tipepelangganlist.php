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
$m_tipepelanggan_list = new m_tipepelanggan_list();

// Run the page
$m_tipepelanggan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tipepelanggan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_tipepelanggan_list->isExport()) { ?>
<script>
var fm_tipepelangganlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_tipepelangganlist = currentForm = new ew.Form("fm_tipepelangganlist", "list");
	fm_tipepelangganlist.formKeyCountName = '<?php echo $m_tipepelanggan_list->FormKeyCountName ?>';
	loadjs.done("fm_tipepelangganlist");
});
var fm_tipepelangganlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_tipepelangganlistsrch = currentSearchForm = new ew.Form("fm_tipepelangganlistsrch");

	// Dynamic selection lists
	// Filters

	fm_tipepelangganlistsrch.filterList = <?php echo $m_tipepelanggan_list->getFilterList() ?>;
	loadjs.done("fm_tipepelangganlistsrch");
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
<?php if (!$m_tipepelanggan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_tipepelanggan_list->TotalRecords > 0 && $m_tipepelanggan_list->ExportOptions->visible()) { ?>
<?php $m_tipepelanggan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_tipepelanggan_list->ImportOptions->visible()) { ?>
<?php $m_tipepelanggan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_tipepelanggan_list->SearchOptions->visible()) { ?>
<?php $m_tipepelanggan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_tipepelanggan_list->FilterOptions->visible()) { ?>
<?php $m_tipepelanggan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_tipepelanggan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_tipepelanggan_list->isExport() && !$m_tipepelanggan->CurrentAction) { ?>
<form name="fm_tipepelangganlistsrch" id="fm_tipepelangganlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_tipepelangganlistsrch-search-panel" class="<?php echo $m_tipepelanggan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_tipepelanggan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_tipepelanggan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_tipepelanggan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_tipepelanggan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_tipepelanggan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_tipepelanggan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_tipepelanggan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_tipepelanggan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_tipepelanggan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_tipepelanggan_list->showPageHeader(); ?>
<?php
$m_tipepelanggan_list->showMessage();
?>
<?php if ($m_tipepelanggan_list->TotalRecords > 0 || $m_tipepelanggan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_tipepelanggan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_tipepelanggan">
<?php if (!$m_tipepelanggan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_tipepelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_tipepelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_tipepelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_tipepelangganlist" id="fm_tipepelangganlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tipepelanggan">
<div id="gmp_m_tipepelanggan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_tipepelanggan_list->TotalRecords > 0 || $m_tipepelanggan_list->isGridEdit()) { ?>
<table id="tbl_m_tipepelangganlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_tipepelanggan->RowType = ROWTYPE_HEADER;

// Render list options
$m_tipepelanggan_list->renderListOptions();

// Render list options (header, left)
$m_tipepelanggan_list->ListOptions->render("header", "left");
?>
<?php if ($m_tipepelanggan_list->nama_tipe->Visible) { // nama_tipe ?>
	<?php if ($m_tipepelanggan_list->SortUrl($m_tipepelanggan_list->nama_tipe) == "") { ?>
		<th data-name="nama_tipe" class="<?php echo $m_tipepelanggan_list->nama_tipe->headerCellClass() ?>"><div id="elh_m_tipepelanggan_nama_tipe" class="m_tipepelanggan_nama_tipe"><div class="ew-table-header-caption"><?php echo $m_tipepelanggan_list->nama_tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_tipe" class="<?php echo $m_tipepelanggan_list->nama_tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tipepelanggan_list->SortUrl($m_tipepelanggan_list->nama_tipe) ?>', 1);"><div id="elh_m_tipepelanggan_nama_tipe" class="m_tipepelanggan_nama_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tipepelanggan_list->nama_tipe->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_tipepelanggan_list->nama_tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tipepelanggan_list->nama_tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tipepelanggan_list->min_kedatangan->Visible) { // min_kedatangan ?>
	<?php if ($m_tipepelanggan_list->SortUrl($m_tipepelanggan_list->min_kedatangan) == "") { ?>
		<th data-name="min_kedatangan" class="<?php echo $m_tipepelanggan_list->min_kedatangan->headerCellClass() ?>"><div id="elh_m_tipepelanggan_min_kedatangan" class="m_tipepelanggan_min_kedatangan"><div class="ew-table-header-caption"><?php echo $m_tipepelanggan_list->min_kedatangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="min_kedatangan" class="<?php echo $m_tipepelanggan_list->min_kedatangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tipepelanggan_list->SortUrl($m_tipepelanggan_list->min_kedatangan) ?>', 1);"><div id="elh_m_tipepelanggan_min_kedatangan" class="m_tipepelanggan_min_kedatangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tipepelanggan_list->min_kedatangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tipepelanggan_list->min_kedatangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tipepelanggan_list->min_kedatangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tipepelanggan_list->periode->Visible) { // periode ?>
	<?php if ($m_tipepelanggan_list->SortUrl($m_tipepelanggan_list->periode) == "") { ?>
		<th data-name="periode" class="<?php echo $m_tipepelanggan_list->periode->headerCellClass() ?>"><div id="elh_m_tipepelanggan_periode" class="m_tipepelanggan_periode"><div class="ew-table-header-caption"><?php echo $m_tipepelanggan_list->periode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode" class="<?php echo $m_tipepelanggan_list->periode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tipepelanggan_list->SortUrl($m_tipepelanggan_list->periode) ?>', 1);"><div id="elh_m_tipepelanggan_periode" class="m_tipepelanggan_periode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tipepelanggan_list->periode->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tipepelanggan_list->periode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tipepelanggan_list->periode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_tipepelanggan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_tipepelanggan_list->ExportAll && $m_tipepelanggan_list->isExport()) {
	$m_tipepelanggan_list->StopRecord = $m_tipepelanggan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_tipepelanggan_list->TotalRecords > $m_tipepelanggan_list->StartRecord + $m_tipepelanggan_list->DisplayRecords - 1)
		$m_tipepelanggan_list->StopRecord = $m_tipepelanggan_list->StartRecord + $m_tipepelanggan_list->DisplayRecords - 1;
	else
		$m_tipepelanggan_list->StopRecord = $m_tipepelanggan_list->TotalRecords;
}
$m_tipepelanggan_list->RecordCount = $m_tipepelanggan_list->StartRecord - 1;
if ($m_tipepelanggan_list->Recordset && !$m_tipepelanggan_list->Recordset->EOF) {
	$m_tipepelanggan_list->Recordset->moveFirst();
	$selectLimit = $m_tipepelanggan_list->UseSelectLimit;
	if (!$selectLimit && $m_tipepelanggan_list->StartRecord > 1)
		$m_tipepelanggan_list->Recordset->move($m_tipepelanggan_list->StartRecord - 1);
} elseif (!$m_tipepelanggan->AllowAddDeleteRow && $m_tipepelanggan_list->StopRecord == 0) {
	$m_tipepelanggan_list->StopRecord = $m_tipepelanggan->GridAddRowCount;
}

// Initialize aggregate
$m_tipepelanggan->RowType = ROWTYPE_AGGREGATEINIT;
$m_tipepelanggan->resetAttributes();
$m_tipepelanggan_list->renderRow();
while ($m_tipepelanggan_list->RecordCount < $m_tipepelanggan_list->StopRecord) {
	$m_tipepelanggan_list->RecordCount++;
	if ($m_tipepelanggan_list->RecordCount >= $m_tipepelanggan_list->StartRecord) {
		$m_tipepelanggan_list->RowCount++;

		// Set up key count
		$m_tipepelanggan_list->KeyCount = $m_tipepelanggan_list->RowIndex;

		// Init row class and style
		$m_tipepelanggan->resetAttributes();
		$m_tipepelanggan->CssClass = "";
		if ($m_tipepelanggan_list->isGridAdd()) {
		} else {
			$m_tipepelanggan_list->loadRowValues($m_tipepelanggan_list->Recordset); // Load row values
		}
		$m_tipepelanggan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_tipepelanggan->RowAttrs->merge(["data-rowindex" => $m_tipepelanggan_list->RowCount, "id" => "r" . $m_tipepelanggan_list->RowCount . "_m_tipepelanggan", "data-rowtype" => $m_tipepelanggan->RowType]);

		// Render row
		$m_tipepelanggan_list->renderRow();

		// Render list options
		$m_tipepelanggan_list->renderListOptions();
?>
	<tr <?php echo $m_tipepelanggan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_tipepelanggan_list->ListOptions->render("body", "left", $m_tipepelanggan_list->RowCount);
?>
	<?php if ($m_tipepelanggan_list->nama_tipe->Visible) { // nama_tipe ?>
		<td data-name="nama_tipe" <?php echo $m_tipepelanggan_list->nama_tipe->cellAttributes() ?>>
<span id="el<?php echo $m_tipepelanggan_list->RowCount ?>_m_tipepelanggan_nama_tipe">
<span<?php echo $m_tipepelanggan_list->nama_tipe->viewAttributes() ?>><?php echo $m_tipepelanggan_list->nama_tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tipepelanggan_list->min_kedatangan->Visible) { // min_kedatangan ?>
		<td data-name="min_kedatangan" <?php echo $m_tipepelanggan_list->min_kedatangan->cellAttributes() ?>>
<span id="el<?php echo $m_tipepelanggan_list->RowCount ?>_m_tipepelanggan_min_kedatangan">
<span<?php echo $m_tipepelanggan_list->min_kedatangan->viewAttributes() ?>><?php echo $m_tipepelanggan_list->min_kedatangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tipepelanggan_list->periode->Visible) { // periode ?>
		<td data-name="periode" <?php echo $m_tipepelanggan_list->periode->cellAttributes() ?>>
<span id="el<?php echo $m_tipepelanggan_list->RowCount ?>_m_tipepelanggan_periode">
<span<?php echo $m_tipepelanggan_list->periode->viewAttributes() ?>><?php echo $m_tipepelanggan_list->periode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_tipepelanggan_list->ListOptions->render("body", "right", $m_tipepelanggan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_tipepelanggan_list->isGridAdd())
		$m_tipepelanggan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_tipepelanggan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_tipepelanggan_list->Recordset)
	$m_tipepelanggan_list->Recordset->Close();
?>
<?php if (!$m_tipepelanggan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_tipepelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_tipepelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_tipepelanggan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_tipepelanggan_list->TotalRecords == 0 && !$m_tipepelanggan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_tipepelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_tipepelanggan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_tipepelanggan_list->isExport()) { ?>
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
$m_tipepelanggan_list->terminate();
?>