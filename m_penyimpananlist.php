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
$m_penyimpanan_list = new m_penyimpanan_list();

// Run the page
$m_penyimpanan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_penyimpanan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_penyimpanan_list->isExport()) { ?>
<script>
var fm_penyimpananlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_penyimpananlist = currentForm = new ew.Form("fm_penyimpananlist", "list");
	fm_penyimpananlist.formKeyCountName = '<?php echo $m_penyimpanan_list->FormKeyCountName ?>';
	loadjs.done("fm_penyimpananlist");
});
var fm_penyimpananlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_penyimpananlistsrch = currentSearchForm = new ew.Form("fm_penyimpananlistsrch");

	// Dynamic selection lists
	// Filters

	fm_penyimpananlistsrch.filterList = <?php echo $m_penyimpanan_list->getFilterList() ?>;
	loadjs.done("fm_penyimpananlistsrch");
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
<?php if (!$m_penyimpanan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_penyimpanan_list->TotalRecords > 0 && $m_penyimpanan_list->ExportOptions->visible()) { ?>
<?php $m_penyimpanan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_penyimpanan_list->ImportOptions->visible()) { ?>
<?php $m_penyimpanan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_penyimpanan_list->SearchOptions->visible()) { ?>
<?php $m_penyimpanan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_penyimpanan_list->FilterOptions->visible()) { ?>
<?php $m_penyimpanan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_penyimpanan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_penyimpanan_list->isExport() && !$m_penyimpanan->CurrentAction) { ?>
<form name="fm_penyimpananlistsrch" id="fm_penyimpananlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_penyimpananlistsrch-search-panel" class="<?php echo $m_penyimpanan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_penyimpanan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_penyimpanan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_penyimpanan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_penyimpanan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_penyimpanan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_penyimpanan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_penyimpanan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_penyimpanan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_penyimpanan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_penyimpanan_list->showPageHeader(); ?>
<?php
$m_penyimpanan_list->showMessage();
?>
<?php if ($m_penyimpanan_list->TotalRecords > 0 || $m_penyimpanan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_penyimpanan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_penyimpanan">
<?php if (!$m_penyimpanan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_penyimpanan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_penyimpanan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_penyimpanan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_penyimpananlist" id="fm_penyimpananlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_penyimpanan">
<div id="gmp_m_penyimpanan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_penyimpanan_list->TotalRecords > 0 || $m_penyimpanan_list->isGridEdit()) { ?>
<table id="tbl_m_penyimpananlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_penyimpanan->RowType = ROWTYPE_HEADER;

// Render list options
$m_penyimpanan_list->renderListOptions();

// Render list options (header, left)
$m_penyimpanan_list->ListOptions->render("header", "left");
?>
<?php if ($m_penyimpanan_list->id_penyimpanan->Visible) { // id_penyimpanan ?>
	<?php if ($m_penyimpanan_list->SortUrl($m_penyimpanan_list->id_penyimpanan) == "") { ?>
		<th data-name="id_penyimpanan" class="<?php echo $m_penyimpanan_list->id_penyimpanan->headerCellClass() ?>"><div id="elh_m_penyimpanan_id_penyimpanan" class="m_penyimpanan_id_penyimpanan"><div class="ew-table-header-caption"><?php echo $m_penyimpanan_list->id_penyimpanan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penyimpanan" class="<?php echo $m_penyimpanan_list->id_penyimpanan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_penyimpanan_list->SortUrl($m_penyimpanan_list->id_penyimpanan) ?>', 1);"><div id="elh_m_penyimpanan_id_penyimpanan" class="m_penyimpanan_id_penyimpanan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_penyimpanan_list->id_penyimpanan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_penyimpanan_list->id_penyimpanan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_penyimpanan_list->id_penyimpanan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_penyimpanan_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($m_penyimpanan_list->SortUrl($m_penyimpanan_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $m_penyimpanan_list->nama_barang->headerCellClass() ?>"><div id="elh_m_penyimpanan_nama_barang" class="m_penyimpanan_nama_barang"><div class="ew-table-header-caption"><?php echo $m_penyimpanan_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $m_penyimpanan_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_penyimpanan_list->SortUrl($m_penyimpanan_list->nama_barang) ?>', 1);"><div id="elh_m_penyimpanan_nama_barang" class="m_penyimpanan_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_penyimpanan_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_penyimpanan_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_penyimpanan_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_penyimpanan_list->tanggal_->Visible) { // tanggal_ ?>
	<?php if ($m_penyimpanan_list->SortUrl($m_penyimpanan_list->tanggal_) == "") { ?>
		<th data-name="tanggal_" class="<?php echo $m_penyimpanan_list->tanggal_->headerCellClass() ?>"><div id="elh_m_penyimpanan_tanggal_" class="m_penyimpanan_tanggal_"><div class="ew-table-header-caption"><?php echo $m_penyimpanan_list->tanggal_->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_" class="<?php echo $m_penyimpanan_list->tanggal_->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_penyimpanan_list->SortUrl($m_penyimpanan_list->tanggal_) ?>', 1);"><div id="elh_m_penyimpanan_tanggal_" class="m_penyimpanan_tanggal_">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_penyimpanan_list->tanggal_->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_penyimpanan_list->tanggal_->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_penyimpanan_list->tanggal_->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_penyimpanan_list->penyimpanan->Visible) { // penyimpanan ?>
	<?php if ($m_penyimpanan_list->SortUrl($m_penyimpanan_list->penyimpanan) == "") { ?>
		<th data-name="penyimpanan" class="<?php echo $m_penyimpanan_list->penyimpanan->headerCellClass() ?>"><div id="elh_m_penyimpanan_penyimpanan" class="m_penyimpanan_penyimpanan"><div class="ew-table-header-caption"><?php echo $m_penyimpanan_list->penyimpanan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penyimpanan" class="<?php echo $m_penyimpanan_list->penyimpanan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_penyimpanan_list->SortUrl($m_penyimpanan_list->penyimpanan) ?>', 1);"><div id="elh_m_penyimpanan_penyimpanan" class="m_penyimpanan_penyimpanan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_penyimpanan_list->penyimpanan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_penyimpanan_list->penyimpanan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_penyimpanan_list->penyimpanan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_penyimpanan_list->nomor_laci->Visible) { // nomor_laci ?>
	<?php if ($m_penyimpanan_list->SortUrl($m_penyimpanan_list->nomor_laci) == "") { ?>
		<th data-name="nomor_laci" class="<?php echo $m_penyimpanan_list->nomor_laci->headerCellClass() ?>"><div id="elh_m_penyimpanan_nomor_laci" class="m_penyimpanan_nomor_laci"><div class="ew-table-header-caption"><?php echo $m_penyimpanan_list->nomor_laci->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nomor_laci" class="<?php echo $m_penyimpanan_list->nomor_laci->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_penyimpanan_list->SortUrl($m_penyimpanan_list->nomor_laci) ?>', 1);"><div id="elh_m_penyimpanan_nomor_laci" class="m_penyimpanan_nomor_laci">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_penyimpanan_list->nomor_laci->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_penyimpanan_list->nomor_laci->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_penyimpanan_list->nomor_laci->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_penyimpanan_list->Stock->Visible) { // Stock ?>
	<?php if ($m_penyimpanan_list->SortUrl($m_penyimpanan_list->Stock) == "") { ?>
		<th data-name="Stock" class="<?php echo $m_penyimpanan_list->Stock->headerCellClass() ?>"><div id="elh_m_penyimpanan_Stock" class="m_penyimpanan_Stock"><div class="ew-table-header-caption"><?php echo $m_penyimpanan_list->Stock->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Stock" class="<?php echo $m_penyimpanan_list->Stock->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_penyimpanan_list->SortUrl($m_penyimpanan_list->Stock) ?>', 1);"><div id="elh_m_penyimpanan_Stock" class="m_penyimpanan_Stock">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_penyimpanan_list->Stock->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_penyimpanan_list->Stock->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_penyimpanan_list->Stock->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_penyimpanan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_penyimpanan_list->ExportAll && $m_penyimpanan_list->isExport()) {
	$m_penyimpanan_list->StopRecord = $m_penyimpanan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_penyimpanan_list->TotalRecords > $m_penyimpanan_list->StartRecord + $m_penyimpanan_list->DisplayRecords - 1)
		$m_penyimpanan_list->StopRecord = $m_penyimpanan_list->StartRecord + $m_penyimpanan_list->DisplayRecords - 1;
	else
		$m_penyimpanan_list->StopRecord = $m_penyimpanan_list->TotalRecords;
}
$m_penyimpanan_list->RecordCount = $m_penyimpanan_list->StartRecord - 1;
if ($m_penyimpanan_list->Recordset && !$m_penyimpanan_list->Recordset->EOF) {
	$m_penyimpanan_list->Recordset->moveFirst();
	$selectLimit = $m_penyimpanan_list->UseSelectLimit;
	if (!$selectLimit && $m_penyimpanan_list->StartRecord > 1)
		$m_penyimpanan_list->Recordset->move($m_penyimpanan_list->StartRecord - 1);
} elseif (!$m_penyimpanan->AllowAddDeleteRow && $m_penyimpanan_list->StopRecord == 0) {
	$m_penyimpanan_list->StopRecord = $m_penyimpanan->GridAddRowCount;
}

// Initialize aggregate
$m_penyimpanan->RowType = ROWTYPE_AGGREGATEINIT;
$m_penyimpanan->resetAttributes();
$m_penyimpanan_list->renderRow();
while ($m_penyimpanan_list->RecordCount < $m_penyimpanan_list->StopRecord) {
	$m_penyimpanan_list->RecordCount++;
	if ($m_penyimpanan_list->RecordCount >= $m_penyimpanan_list->StartRecord) {
		$m_penyimpanan_list->RowCount++;

		// Set up key count
		$m_penyimpanan_list->KeyCount = $m_penyimpanan_list->RowIndex;

		// Init row class and style
		$m_penyimpanan->resetAttributes();
		$m_penyimpanan->CssClass = "";
		if ($m_penyimpanan_list->isGridAdd()) {
		} else {
			$m_penyimpanan_list->loadRowValues($m_penyimpanan_list->Recordset); // Load row values
		}
		$m_penyimpanan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_penyimpanan->RowAttrs->merge(["data-rowindex" => $m_penyimpanan_list->RowCount, "id" => "r" . $m_penyimpanan_list->RowCount . "_m_penyimpanan", "data-rowtype" => $m_penyimpanan->RowType]);

		// Render row
		$m_penyimpanan_list->renderRow();

		// Render list options
		$m_penyimpanan_list->renderListOptions();
?>
	<tr <?php echo $m_penyimpanan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_penyimpanan_list->ListOptions->render("body", "left", $m_penyimpanan_list->RowCount);
?>
	<?php if ($m_penyimpanan_list->id_penyimpanan->Visible) { // id_penyimpanan ?>
		<td data-name="id_penyimpanan" <?php echo $m_penyimpanan_list->id_penyimpanan->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_list->RowCount ?>_m_penyimpanan_id_penyimpanan">
<span<?php echo $m_penyimpanan_list->id_penyimpanan->viewAttributes() ?>><?php echo $m_penyimpanan_list->id_penyimpanan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_penyimpanan_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $m_penyimpanan_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_list->RowCount ?>_m_penyimpanan_nama_barang">
<span<?php echo $m_penyimpanan_list->nama_barang->viewAttributes() ?>><?php echo $m_penyimpanan_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_penyimpanan_list->tanggal_->Visible) { // tanggal_ ?>
		<td data-name="tanggal_" <?php echo $m_penyimpanan_list->tanggal_->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_list->RowCount ?>_m_penyimpanan_tanggal_">
<span<?php echo $m_penyimpanan_list->tanggal_->viewAttributes() ?>><?php echo $m_penyimpanan_list->tanggal_->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_penyimpanan_list->penyimpanan->Visible) { // penyimpanan ?>
		<td data-name="penyimpanan" <?php echo $m_penyimpanan_list->penyimpanan->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_list->RowCount ?>_m_penyimpanan_penyimpanan">
<span<?php echo $m_penyimpanan_list->penyimpanan->viewAttributes() ?>><?php echo $m_penyimpanan_list->penyimpanan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_penyimpanan_list->nomor_laci->Visible) { // nomor_laci ?>
		<td data-name="nomor_laci" <?php echo $m_penyimpanan_list->nomor_laci->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_list->RowCount ?>_m_penyimpanan_nomor_laci">
<span<?php echo $m_penyimpanan_list->nomor_laci->viewAttributes() ?>><?php echo $m_penyimpanan_list->nomor_laci->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_penyimpanan_list->Stock->Visible) { // Stock ?>
		<td data-name="Stock" <?php echo $m_penyimpanan_list->Stock->cellAttributes() ?>>
<span id="el<?php echo $m_penyimpanan_list->RowCount ?>_m_penyimpanan_Stock">
<span<?php echo $m_penyimpanan_list->Stock->viewAttributes() ?>><?php echo $m_penyimpanan_list->Stock->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_penyimpanan_list->ListOptions->render("body", "right", $m_penyimpanan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_penyimpanan_list->isGridAdd())
		$m_penyimpanan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_penyimpanan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_penyimpanan_list->Recordset)
	$m_penyimpanan_list->Recordset->Close();
?>
<?php if (!$m_penyimpanan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_penyimpanan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_penyimpanan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_penyimpanan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_penyimpanan_list->TotalRecords == 0 && !$m_penyimpanan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_penyimpanan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_penyimpanan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_penyimpanan_list->isExport()) { ?>
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
$m_penyimpanan_list->terminate();
?>