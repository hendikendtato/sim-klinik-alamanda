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
$v_lap_retur_list = new v_lap_retur_list();

// Run the page
$v_lap_retur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_lap_retur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_lap_retur_list->isExport()) { ?>
<script>
var fv_lap_returlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_lap_returlist = currentForm = new ew.Form("fv_lap_returlist", "list");
	fv_lap_returlist.formKeyCountName = '<?php echo $v_lap_retur_list->FormKeyCountName ?>';
	loadjs.done("fv_lap_returlist");
});
var fv_lap_returlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_lap_returlistsrch = currentSearchForm = new ew.Form("fv_lap_returlistsrch");

	// Dynamic selection lists
	// Filters

	fv_lap_returlistsrch.filterList = <?php echo $v_lap_retur_list->getFilterList() ?>;
	loadjs.done("fv_lap_returlistsrch");
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
<?php if (!$v_lap_retur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_lap_retur_list->TotalRecords > 0 && $v_lap_retur_list->ExportOptions->visible()) { ?>
<?php $v_lap_retur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_retur_list->ImportOptions->visible()) { ?>
<?php $v_lap_retur_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_retur_list->SearchOptions->visible()) { ?>
<?php $v_lap_retur_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_lap_retur_list->FilterOptions->visible()) { ?>
<?php $v_lap_retur_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_lap_retur_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_lap_retur_list->isExport() && !$v_lap_retur->CurrentAction) { ?>
<form name="fv_lap_returlistsrch" id="fv_lap_returlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_lap_returlistsrch-search-panel" class="<?php echo $v_lap_retur_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_lap_retur">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $v_lap_retur_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_lap_retur_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_lap_retur_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_lap_retur_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_lap_retur_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_lap_retur_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_lap_retur_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_lap_retur_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_lap_retur_list->showPageHeader(); ?>
<?php
$v_lap_retur_list->showMessage();
?>
<?php if ($v_lap_retur_list->TotalRecords > 0 || $v_lap_retur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_lap_retur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_lap_retur">
<?php if (!$v_lap_retur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_lap_retur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_lap_retur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_lap_retur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_lap_returlist" id="fv_lap_returlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_lap_retur">
<div id="gmp_v_lap_retur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_lap_retur_list->TotalRecords > 0 || $v_lap_retur_list->isGridEdit()) { ?>
<table id="tbl_v_lap_returlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_lap_retur->RowType = ROWTYPE_HEADER;

// Render list options
$v_lap_retur_list->renderListOptions();

// Render list options (header, left)
$v_lap_retur_list->ListOptions->render("header", "left");
?>
<?php if ($v_lap_retur_list->nama_supplier->Visible) { // nama_supplier ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->nama_supplier) == "") { ?>
		<th data-name="nama_supplier" class="<?php echo $v_lap_retur_list->nama_supplier->headerCellClass() ?>"><div id="elh_v_lap_retur_nama_supplier" class="v_lap_retur_nama_supplier"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_supplier" class="<?php echo $v_lap_retur_list->nama_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->nama_supplier) ?>', 1);"><div id="elh_v_lap_retur_nama_supplier" class="v_lap_retur_nama_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->nama_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->nama_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_retur_list->nama_klinik->Visible) { // nama_klinik ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->nama_klinik) == "") { ?>
		<th data-name="nama_klinik" class="<?php echo $v_lap_retur_list->nama_klinik->headerCellClass() ?>"><div id="elh_v_lap_retur_nama_klinik" class="v_lap_retur_nama_klinik"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_klinik" class="<?php echo $v_lap_retur_list->nama_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->nama_klinik) ?>', 1);"><div id="elh_v_lap_retur_nama_klinik" class="v_lap_retur_nama_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_klinik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->nama_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->nama_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_retur_list->nama_pegawai->Visible) { // nama_pegawai ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->nama_pegawai) == "") { ?>
		<th data-name="nama_pegawai" class="<?php echo $v_lap_retur_list->nama_pegawai->headerCellClass() ?>"><div id="elh_v_lap_retur_nama_pegawai" class="v_lap_retur_nama_pegawai"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pegawai" class="<?php echo $v_lap_retur_list->nama_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->nama_pegawai) ?>', 1);"><div id="elh_v_lap_retur_nama_pegawai" class="v_lap_retur_nama_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_pegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->nama_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->nama_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_retur_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $v_lap_retur_list->nama_barang->headerCellClass() ?>"><div id="elh_v_lap_retur_nama_barang" class="v_lap_retur_nama_barang"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $v_lap_retur_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->nama_barang) ?>', 1);"><div id="elh_v_lap_retur_nama_barang" class="v_lap_retur_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_retur_list->jumlah->Visible) { // jumlah ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $v_lap_retur_list->jumlah->headerCellClass() ?>"><div id="elh_v_lap_retur_jumlah" class="v_lap_retur_jumlah"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $v_lap_retur_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->jumlah) ?>', 1);"><div id="elh_v_lap_retur_jumlah" class="v_lap_retur_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_retur_list->satuan->Visible) { // satuan ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $v_lap_retur_list->satuan->headerCellClass() ?>"><div id="elh_v_lap_retur_satuan" class="v_lap_retur_satuan"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $v_lap_retur_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->satuan) ?>', 1);"><div id="elh_v_lap_retur_satuan" class="v_lap_retur_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_lap_retur_list->nama_gudang->Visible) { // nama_gudang ?>
	<?php if ($v_lap_retur_list->SortUrl($v_lap_retur_list->nama_gudang) == "") { ?>
		<th data-name="nama_gudang" class="<?php echo $v_lap_retur_list->nama_gudang->headerCellClass() ?>"><div id="elh_v_lap_retur_nama_gudang" class="v_lap_retur_nama_gudang"><div class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_gudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_gudang" class="<?php echo $v_lap_retur_list->nama_gudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_lap_retur_list->SortUrl($v_lap_retur_list->nama_gudang) ?>', 1);"><div id="elh_v_lap_retur_nama_gudang" class="v_lap_retur_nama_gudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_lap_retur_list->nama_gudang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($v_lap_retur_list->nama_gudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_lap_retur_list->nama_gudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_lap_retur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_lap_retur_list->ExportAll && $v_lap_retur_list->isExport()) {
	$v_lap_retur_list->StopRecord = $v_lap_retur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_lap_retur_list->TotalRecords > $v_lap_retur_list->StartRecord + $v_lap_retur_list->DisplayRecords - 1)
		$v_lap_retur_list->StopRecord = $v_lap_retur_list->StartRecord + $v_lap_retur_list->DisplayRecords - 1;
	else
		$v_lap_retur_list->StopRecord = $v_lap_retur_list->TotalRecords;
}
$v_lap_retur_list->RecordCount = $v_lap_retur_list->StartRecord - 1;
if ($v_lap_retur_list->Recordset && !$v_lap_retur_list->Recordset->EOF) {
	$v_lap_retur_list->Recordset->moveFirst();
	$selectLimit = $v_lap_retur_list->UseSelectLimit;
	if (!$selectLimit && $v_lap_retur_list->StartRecord > 1)
		$v_lap_retur_list->Recordset->move($v_lap_retur_list->StartRecord - 1);
} elseif (!$v_lap_retur->AllowAddDeleteRow && $v_lap_retur_list->StopRecord == 0) {
	$v_lap_retur_list->StopRecord = $v_lap_retur->GridAddRowCount;
}

// Initialize aggregate
$v_lap_retur->RowType = ROWTYPE_AGGREGATEINIT;
$v_lap_retur->resetAttributes();
$v_lap_retur_list->renderRow();
while ($v_lap_retur_list->RecordCount < $v_lap_retur_list->StopRecord) {
	$v_lap_retur_list->RecordCount++;
	if ($v_lap_retur_list->RecordCount >= $v_lap_retur_list->StartRecord) {
		$v_lap_retur_list->RowCount++;

		// Set up key count
		$v_lap_retur_list->KeyCount = $v_lap_retur_list->RowIndex;

		// Init row class and style
		$v_lap_retur->resetAttributes();
		$v_lap_retur->CssClass = "";
		if ($v_lap_retur_list->isGridAdd()) {
		} else {
			$v_lap_retur_list->loadRowValues($v_lap_retur_list->Recordset); // Load row values
		}
		$v_lap_retur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_lap_retur->RowAttrs->merge(["data-rowindex" => $v_lap_retur_list->RowCount, "id" => "r" . $v_lap_retur_list->RowCount . "_v_lap_retur", "data-rowtype" => $v_lap_retur->RowType]);

		// Render row
		$v_lap_retur_list->renderRow();

		// Render list options
		$v_lap_retur_list->renderListOptions();
?>
	<tr <?php echo $v_lap_retur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_lap_retur_list->ListOptions->render("body", "left", $v_lap_retur_list->RowCount);
?>
	<?php if ($v_lap_retur_list->nama_supplier->Visible) { // nama_supplier ?>
		<td data-name="nama_supplier" <?php echo $v_lap_retur_list->nama_supplier->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_nama_supplier">
<span<?php echo $v_lap_retur_list->nama_supplier->viewAttributes() ?>><?php echo $v_lap_retur_list->nama_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_retur_list->nama_klinik->Visible) { // nama_klinik ?>
		<td data-name="nama_klinik" <?php echo $v_lap_retur_list->nama_klinik->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_nama_klinik">
<span<?php echo $v_lap_retur_list->nama_klinik->viewAttributes() ?>><?php echo $v_lap_retur_list->nama_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_retur_list->nama_pegawai->Visible) { // nama_pegawai ?>
		<td data-name="nama_pegawai" <?php echo $v_lap_retur_list->nama_pegawai->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_nama_pegawai">
<span<?php echo $v_lap_retur_list->nama_pegawai->viewAttributes() ?>><?php echo $v_lap_retur_list->nama_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_retur_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $v_lap_retur_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_nama_barang">
<span<?php echo $v_lap_retur_list->nama_barang->viewAttributes() ?>><?php echo $v_lap_retur_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_retur_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $v_lap_retur_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_jumlah">
<span<?php echo $v_lap_retur_list->jumlah->viewAttributes() ?>><?php echo $v_lap_retur_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_retur_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $v_lap_retur_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_satuan">
<span<?php echo $v_lap_retur_list->satuan->viewAttributes() ?>><?php echo $v_lap_retur_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_lap_retur_list->nama_gudang->Visible) { // nama_gudang ?>
		<td data-name="nama_gudang" <?php echo $v_lap_retur_list->nama_gudang->cellAttributes() ?>>
<span id="el<?php echo $v_lap_retur_list->RowCount ?>_v_lap_retur_nama_gudang">
<span<?php echo $v_lap_retur_list->nama_gudang->viewAttributes() ?>><?php echo $v_lap_retur_list->nama_gudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_lap_retur_list->ListOptions->render("body", "right", $v_lap_retur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_lap_retur_list->isGridAdd())
		$v_lap_retur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_lap_retur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_lap_retur_list->Recordset)
	$v_lap_retur_list->Recordset->Close();
?>
<?php if (!$v_lap_retur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_lap_retur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_lap_retur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_lap_retur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_lap_retur_list->TotalRecords == 0 && !$v_lap_retur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_lap_retur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_lap_retur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_lap_retur_list->isExport()) { ?>
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
$v_lap_retur_list->terminate();
?>