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
$m_target_produk_list = new m_target_produk_list();

// Run the page
$m_target_produk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_produk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_target_produk_list->isExport()) { ?>
<script>
var fm_target_produklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_target_produklist = currentForm = new ew.Form("fm_target_produklist", "list");
	fm_target_produklist.formKeyCountName = '<?php echo $m_target_produk_list->FormKeyCountName ?>';
	loadjs.done("fm_target_produklist");
});
var fm_target_produklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_target_produklistsrch = currentSearchForm = new ew.Form("fm_target_produklistsrch");

	// Dynamic selection lists
	// Filters

	fm_target_produklistsrch.filterList = <?php echo $m_target_produk_list->getFilterList() ?>;
	loadjs.done("fm_target_produklistsrch");
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
<?php if (!$m_target_produk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_target_produk_list->TotalRecords > 0 && $m_target_produk_list->ExportOptions->visible()) { ?>
<?php $m_target_produk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_target_produk_list->ImportOptions->visible()) { ?>
<?php $m_target_produk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_target_produk_list->SearchOptions->visible()) { ?>
<?php $m_target_produk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_target_produk_list->FilterOptions->visible()) { ?>
<?php $m_target_produk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_target_produk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_target_produk_list->isExport() && !$m_target_produk->CurrentAction) { ?>
<form name="fm_target_produklistsrch" id="fm_target_produklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_target_produklistsrch-search-panel" class="<?php echo $m_target_produk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_target_produk">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_target_produk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_target_produk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_target_produk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_target_produk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_target_produk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_target_produk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_target_produk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_target_produk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_target_produk_list->showPageHeader(); ?>
<?php
$m_target_produk_list->showMessage();
?>
<?php if ($m_target_produk_list->TotalRecords > 0 || $m_target_produk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_target_produk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_target_produk">
<?php if (!$m_target_produk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_target_produk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_target_produk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_target_produk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_target_produklist" id="fm_target_produklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_produk">
<div id="gmp_m_target_produk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_target_produk_list->TotalRecords > 0 || $m_target_produk_list->isGridEdit()) { ?>
<table id="tbl_m_target_produklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_target_produk->RowType = ROWTYPE_HEADER;

// Render list options
$m_target_produk_list->renderListOptions();

// Render list options (header, left)
$m_target_produk_list->ListOptions->render("header", "left");
?>
<?php if ($m_target_produk_list->id_cabang->Visible) { // id_cabang ?>
	<?php if ($m_target_produk_list->SortUrl($m_target_produk_list->id_cabang) == "") { ?>
		<th data-name="id_cabang" class="<?php echo $m_target_produk_list->id_cabang->headerCellClass() ?>"><div id="elh_m_target_produk_id_cabang" class="m_target_produk_id_cabang"><div class="ew-table-header-caption"><?php echo $m_target_produk_list->id_cabang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cabang" class="<?php echo $m_target_produk_list->id_cabang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_produk_list->SortUrl($m_target_produk_list->id_cabang) ?>', 1);"><div id="elh_m_target_produk_id_cabang" class="m_target_produk_id_cabang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_produk_list->id_cabang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_produk_list->id_cabang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_produk_list->id_cabang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_produk_list->status->Visible) { // status ?>
	<?php if ($m_target_produk_list->SortUrl($m_target_produk_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $m_target_produk_list->status->headerCellClass() ?>"><div id="elh_m_target_produk_status" class="m_target_produk_status"><div class="ew-table-header-caption"><?php echo $m_target_produk_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $m_target_produk_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_produk_list->SortUrl($m_target_produk_list->status) ?>', 1);"><div id="elh_m_target_produk_status" class="m_target_produk_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_produk_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_produk_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_produk_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_produk_list->tgl_awal->Visible) { // tgl_awal ?>
	<?php if ($m_target_produk_list->SortUrl($m_target_produk_list->tgl_awal) == "") { ?>
		<th data-name="tgl_awal" class="<?php echo $m_target_produk_list->tgl_awal->headerCellClass() ?>"><div id="elh_m_target_produk_tgl_awal" class="m_target_produk_tgl_awal"><div class="ew-table-header-caption"><?php echo $m_target_produk_list->tgl_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_awal" class="<?php echo $m_target_produk_list->tgl_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_produk_list->SortUrl($m_target_produk_list->tgl_awal) ?>', 1);"><div id="elh_m_target_produk_tgl_awal" class="m_target_produk_tgl_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_produk_list->tgl_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_produk_list->tgl_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_produk_list->tgl_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_produk_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($m_target_produk_list->SortUrl($m_target_produk_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_target_produk_list->tgl_akhir->headerCellClass() ?>"><div id="elh_m_target_produk_tgl_akhir" class="m_target_produk_tgl_akhir"><div class="ew-table-header-caption"><?php echo $m_target_produk_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_target_produk_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_produk_list->SortUrl($m_target_produk_list->tgl_akhir) ?>', 1);"><div id="elh_m_target_produk_tgl_akhir" class="m_target_produk_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_produk_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_produk_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_produk_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_produk_list->target->Visible) { // target ?>
	<?php if ($m_target_produk_list->SortUrl($m_target_produk_list->target) == "") { ?>
		<th data-name="target" class="<?php echo $m_target_produk_list->target->headerCellClass() ?>"><div id="elh_m_target_produk_target" class="m_target_produk_target"><div class="ew-table-header-caption"><?php echo $m_target_produk_list->target->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target" class="<?php echo $m_target_produk_list->target->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_produk_list->SortUrl($m_target_produk_list->target) ?>', 1);"><div id="elh_m_target_produk_target" class="m_target_produk_target">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_produk_list->target->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_target_produk_list->target->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_produk_list->target->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_target_produk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_target_produk_list->ExportAll && $m_target_produk_list->isExport()) {
	$m_target_produk_list->StopRecord = $m_target_produk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_target_produk_list->TotalRecords > $m_target_produk_list->StartRecord + $m_target_produk_list->DisplayRecords - 1)
		$m_target_produk_list->StopRecord = $m_target_produk_list->StartRecord + $m_target_produk_list->DisplayRecords - 1;
	else
		$m_target_produk_list->StopRecord = $m_target_produk_list->TotalRecords;
}
$m_target_produk_list->RecordCount = $m_target_produk_list->StartRecord - 1;
if ($m_target_produk_list->Recordset && !$m_target_produk_list->Recordset->EOF) {
	$m_target_produk_list->Recordset->moveFirst();
	$selectLimit = $m_target_produk_list->UseSelectLimit;
	if (!$selectLimit && $m_target_produk_list->StartRecord > 1)
		$m_target_produk_list->Recordset->move($m_target_produk_list->StartRecord - 1);
} elseif (!$m_target_produk->AllowAddDeleteRow && $m_target_produk_list->StopRecord == 0) {
	$m_target_produk_list->StopRecord = $m_target_produk->GridAddRowCount;
}

// Initialize aggregate
$m_target_produk->RowType = ROWTYPE_AGGREGATEINIT;
$m_target_produk->resetAttributes();
$m_target_produk_list->renderRow();
while ($m_target_produk_list->RecordCount < $m_target_produk_list->StopRecord) {
	$m_target_produk_list->RecordCount++;
	if ($m_target_produk_list->RecordCount >= $m_target_produk_list->StartRecord) {
		$m_target_produk_list->RowCount++;

		// Set up key count
		$m_target_produk_list->KeyCount = $m_target_produk_list->RowIndex;

		// Init row class and style
		$m_target_produk->resetAttributes();
		$m_target_produk->CssClass = "";
		if ($m_target_produk_list->isGridAdd()) {
		} else {
			$m_target_produk_list->loadRowValues($m_target_produk_list->Recordset); // Load row values
		}
		$m_target_produk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_target_produk->RowAttrs->merge(["data-rowindex" => $m_target_produk_list->RowCount, "id" => "r" . $m_target_produk_list->RowCount . "_m_target_produk", "data-rowtype" => $m_target_produk->RowType]);

		// Render row
		$m_target_produk_list->renderRow();

		// Render list options
		$m_target_produk_list->renderListOptions();
?>
	<tr <?php echo $m_target_produk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_target_produk_list->ListOptions->render("body", "left", $m_target_produk_list->RowCount);
?>
	<?php if ($m_target_produk_list->id_cabang->Visible) { // id_cabang ?>
		<td data-name="id_cabang" <?php echo $m_target_produk_list->id_cabang->cellAttributes() ?>>
<span id="el<?php echo $m_target_produk_list->RowCount ?>_m_target_produk_id_cabang">
<span<?php echo $m_target_produk_list->id_cabang->viewAttributes() ?>><?php echo $m_target_produk_list->id_cabang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_produk_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $m_target_produk_list->status->cellAttributes() ?>>
<span id="el<?php echo $m_target_produk_list->RowCount ?>_m_target_produk_status">
<span<?php echo $m_target_produk_list->status->viewAttributes() ?>><?php echo $m_target_produk_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_produk_list->tgl_awal->Visible) { // tgl_awal ?>
		<td data-name="tgl_awal" <?php echo $m_target_produk_list->tgl_awal->cellAttributes() ?>>
<span id="el<?php echo $m_target_produk_list->RowCount ?>_m_target_produk_tgl_awal">
<span<?php echo $m_target_produk_list->tgl_awal->viewAttributes() ?>><?php echo $m_target_produk_list->tgl_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_produk_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $m_target_produk_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_target_produk_list->RowCount ?>_m_target_produk_tgl_akhir">
<span<?php echo $m_target_produk_list->tgl_akhir->viewAttributes() ?>><?php echo $m_target_produk_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_produk_list->target->Visible) { // target ?>
		<td data-name="target" <?php echo $m_target_produk_list->target->cellAttributes() ?>>
<span id="el<?php echo $m_target_produk_list->RowCount ?>_m_target_produk_target">
<span<?php echo $m_target_produk_list->target->viewAttributes() ?>><?php echo $m_target_produk_list->target->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_target_produk_list->ListOptions->render("body", "right", $m_target_produk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_target_produk_list->isGridAdd())
		$m_target_produk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_target_produk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_target_produk_list->Recordset)
	$m_target_produk_list->Recordset->Close();
?>
<?php if (!$m_target_produk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_target_produk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_target_produk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_target_produk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_target_produk_list->TotalRecords == 0 && !$m_target_produk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_target_produk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_target_produk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_target_produk_list->isExport()) { ?>
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
$m_target_produk_list->terminate();
?>