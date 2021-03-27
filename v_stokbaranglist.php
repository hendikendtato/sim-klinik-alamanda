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
$v_stokbarang_list = new v_stokbarang_list();

// Run the page
$v_stokbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_stokbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_stokbarang_list->isExport()) { ?>
<script>
var fv_stokbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_stokbaranglist = currentForm = new ew.Form("fv_stokbaranglist", "list");
	fv_stokbaranglist.formKeyCountName = '<?php echo $v_stokbarang_list->FormKeyCountName ?>';
	loadjs.done("fv_stokbaranglist");
});
var fv_stokbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_stokbaranglistsrch = currentSearchForm = new ew.Form("fv_stokbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fv_stokbaranglistsrch.filterList = <?php echo $v_stokbarang_list->getFilterList() ?>;
	loadjs.done("fv_stokbaranglistsrch");
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
<?php if (!$v_stokbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_stokbarang_list->TotalRecords > 0 && $v_stokbarang_list->ExportOptions->visible()) { ?>
<?php $v_stokbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_stokbarang_list->ImportOptions->visible()) { ?>
<?php $v_stokbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_stokbarang_list->SearchOptions->visible()) { ?>
<?php $v_stokbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_stokbarang_list->FilterOptions->visible()) { ?>
<?php $v_stokbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_stokbarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_stokbarang_list->isExport() && !$v_stokbarang->CurrentAction) { ?>
<form name="fv_stokbaranglistsrch" id="fv_stokbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_stokbaranglistsrch-search-panel" class="<?php echo $v_stokbarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_stokbarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $v_stokbarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_stokbarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_stokbarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_stokbarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_stokbarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_stokbarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_stokbarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_stokbarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_stokbarang_list->showPageHeader(); ?>
<?php
$v_stokbarang_list->showMessage();
?>
<?php if ($v_stokbarang_list->TotalRecords > 0 || $v_stokbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_stokbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_stokbarang">
<?php if (!$v_stokbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_stokbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_stokbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_stokbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_stokbaranglist" id="fv_stokbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_stokbarang">
<div id="gmp_v_stokbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_stokbarang_list->TotalRecords > 0 || $v_stokbarang_list->isGridEdit()) { ?>
<table id="tbl_v_stokbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_stokbarang->RowType = ROWTYPE_HEADER;

// Render list options
$v_stokbarang_list->renderListOptions();

// Render list options (header, left)
$v_stokbarang_list->ListOptions->render("header", "left");
?>
<?php if ($v_stokbarang_list->id_barang->Visible) { // id_barang ?>
	<?php if ($v_stokbarang_list->SortUrl($v_stokbarang_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $v_stokbarang_list->id_barang->headerCellClass() ?>"><div id="elh_v_stokbarang_id_barang" class="v_stokbarang_id_barang"><div class="ew-table-header-caption"><?php echo $v_stokbarang_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $v_stokbarang_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_stokbarang_list->SortUrl($v_stokbarang_list->id_barang) ?>', 1);"><div id="elh_v_stokbarang_id_barang" class="v_stokbarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stokbarang_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_stokbarang_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_stokbarang_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stokbarang_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($v_stokbarang_list->SortUrl($v_stokbarang_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $v_stokbarang_list->nama_barang->headerCellClass() ?>"><div id="elh_v_stokbarang_nama_barang" class="v_stokbarang_nama_barang"><div class="ew-table-header-caption"><?php echo $v_stokbarang_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $v_stokbarang_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_stokbarang_list->SortUrl($v_stokbarang_list->nama_barang) ?>', 1);"><div id="elh_v_stokbarang_nama_barang" class="v_stokbarang_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stokbarang_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_stokbarang_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_stokbarang_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_stokbarang_list->jumlah->Visible) { // jumlah ?>
	<?php if ($v_stokbarang_list->SortUrl($v_stokbarang_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $v_stokbarang_list->jumlah->headerCellClass() ?>"><div id="elh_v_stokbarang_jumlah" class="v_stokbarang_jumlah"><div class="ew-table-header-caption"><?php echo $v_stokbarang_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $v_stokbarang_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_stokbarang_list->SortUrl($v_stokbarang_list->jumlah) ?>', 1);"><div id="elh_v_stokbarang_jumlah" class="v_stokbarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_stokbarang_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_stokbarang_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_stokbarang_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_stokbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_stokbarang_list->ExportAll && $v_stokbarang_list->isExport()) {
	$v_stokbarang_list->StopRecord = $v_stokbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_stokbarang_list->TotalRecords > $v_stokbarang_list->StartRecord + $v_stokbarang_list->DisplayRecords - 1)
		$v_stokbarang_list->StopRecord = $v_stokbarang_list->StartRecord + $v_stokbarang_list->DisplayRecords - 1;
	else
		$v_stokbarang_list->StopRecord = $v_stokbarang_list->TotalRecords;
}
$v_stokbarang_list->RecordCount = $v_stokbarang_list->StartRecord - 1;
if ($v_stokbarang_list->Recordset && !$v_stokbarang_list->Recordset->EOF) {
	$v_stokbarang_list->Recordset->moveFirst();
	$selectLimit = $v_stokbarang_list->UseSelectLimit;
	if (!$selectLimit && $v_stokbarang_list->StartRecord > 1)
		$v_stokbarang_list->Recordset->move($v_stokbarang_list->StartRecord - 1);
} elseif (!$v_stokbarang->AllowAddDeleteRow && $v_stokbarang_list->StopRecord == 0) {
	$v_stokbarang_list->StopRecord = $v_stokbarang->GridAddRowCount;
}

// Initialize aggregate
$v_stokbarang->RowType = ROWTYPE_AGGREGATEINIT;
$v_stokbarang->resetAttributes();
$v_stokbarang_list->renderRow();
while ($v_stokbarang_list->RecordCount < $v_stokbarang_list->StopRecord) {
	$v_stokbarang_list->RecordCount++;
	if ($v_stokbarang_list->RecordCount >= $v_stokbarang_list->StartRecord) {
		$v_stokbarang_list->RowCount++;

		// Set up key count
		$v_stokbarang_list->KeyCount = $v_stokbarang_list->RowIndex;

		// Init row class and style
		$v_stokbarang->resetAttributes();
		$v_stokbarang->CssClass = "";
		if ($v_stokbarang_list->isGridAdd()) {
		} else {
			$v_stokbarang_list->loadRowValues($v_stokbarang_list->Recordset); // Load row values
		}
		$v_stokbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_stokbarang->RowAttrs->merge(["data-rowindex" => $v_stokbarang_list->RowCount, "id" => "r" . $v_stokbarang_list->RowCount . "_v_stokbarang", "data-rowtype" => $v_stokbarang->RowType]);

		// Render row
		$v_stokbarang_list->renderRow();

		// Render list options
		$v_stokbarang_list->renderListOptions();
?>
	<tr <?php echo $v_stokbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_stokbarang_list->ListOptions->render("body", "left", $v_stokbarang_list->RowCount);
?>
	<?php if ($v_stokbarang_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $v_stokbarang_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $v_stokbarang_list->RowCount ?>_v_stokbarang_id_barang">
<span<?php echo $v_stokbarang_list->id_barang->viewAttributes() ?>><?php echo $v_stokbarang_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stokbarang_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $v_stokbarang_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $v_stokbarang_list->RowCount ?>_v_stokbarang_nama_barang">
<span<?php echo $v_stokbarang_list->nama_barang->viewAttributes() ?>><?php echo $v_stokbarang_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_stokbarang_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $v_stokbarang_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $v_stokbarang_list->RowCount ?>_v_stokbarang_jumlah">
<span<?php echo $v_stokbarang_list->jumlah->viewAttributes() ?>><?php echo $v_stokbarang_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_stokbarang_list->ListOptions->render("body", "right", $v_stokbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_stokbarang_list->isGridAdd())
		$v_stokbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_stokbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_stokbarang_list->Recordset)
	$v_stokbarang_list->Recordset->Close();
?>
<?php if (!$v_stokbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_stokbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_stokbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_stokbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_stokbarang_list->TotalRecords == 0 && !$v_stokbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_stokbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_stokbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_stokbarang_list->isExport()) { ?>
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
$v_stokbarang_list->terminate();
?>