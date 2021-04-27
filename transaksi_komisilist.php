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
$transaksi_komisi_list = new transaksi_komisi_list();

// Run the page
$transaksi_komisi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaksi_komisi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$transaksi_komisi_list->isExport()) { ?>
<script>
var ftransaksi_komisilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftransaksi_komisilist = currentForm = new ew.Form("ftransaksi_komisilist", "list");
	ftransaksi_komisilist.formKeyCountName = '<?php echo $transaksi_komisi_list->FormKeyCountName ?>';
	loadjs.done("ftransaksi_komisilist");
});
var ftransaksi_komisilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftransaksi_komisilistsrch = currentSearchForm = new ew.Form("ftransaksi_komisilistsrch");

	// Dynamic selection lists
	// Filters

	ftransaksi_komisilistsrch.filterList = <?php echo $transaksi_komisi_list->getFilterList() ?>;
	loadjs.done("ftransaksi_komisilistsrch");
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
<?php if (!$transaksi_komisi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($transaksi_komisi_list->TotalRecords > 0 && $transaksi_komisi_list->ExportOptions->visible()) { ?>
<?php $transaksi_komisi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($transaksi_komisi_list->ImportOptions->visible()) { ?>
<?php $transaksi_komisi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($transaksi_komisi_list->SearchOptions->visible()) { ?>
<?php $transaksi_komisi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($transaksi_komisi_list->FilterOptions->visible()) { ?>
<?php $transaksi_komisi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$transaksi_komisi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$transaksi_komisi_list->isExport() && !$transaksi_komisi->CurrentAction) { ?>
<form name="ftransaksi_komisilistsrch" id="ftransaksi_komisilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftransaksi_komisilistsrch-search-panel" class="<?php echo $transaksi_komisi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="transaksi_komisi">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $transaksi_komisi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($transaksi_komisi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($transaksi_komisi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $transaksi_komisi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($transaksi_komisi_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($transaksi_komisi_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($transaksi_komisi_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($transaksi_komisi_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $transaksi_komisi_list->showPageHeader(); ?>
<?php
$transaksi_komisi_list->showMessage();
?>
<?php if ($transaksi_komisi_list->TotalRecords > 0 || $transaksi_komisi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($transaksi_komisi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> transaksi_komisi">
<?php if (!$transaksi_komisi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$transaksi_komisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $transaksi_komisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transaksi_komisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftransaksi_komisilist" id="ftransaksi_komisilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaksi_komisi">
<div id="gmp_transaksi_komisi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($transaksi_komisi_list->TotalRecords > 0 || $transaksi_komisi_list->isGridEdit()) { ?>
<table id="tbl_transaksi_komisilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$transaksi_komisi->RowType = ROWTYPE_HEADER;

// Render list options
$transaksi_komisi_list->renderListOptions();

// Render list options (header, left)
$transaksi_komisi_list->ListOptions->render("header", "left");
?>
<?php if ($transaksi_komisi_list->id_pegawai->Visible) { // id_pegawai ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->id_pegawai) == "") { ?>
		<th data-name="id_pegawai" class="<?php echo $transaksi_komisi_list->id_pegawai->headerCellClass() ?>"><div id="elh_transaksi_komisi_id_pegawai" class="transaksi_komisi_id_pegawai"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->id_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pegawai" class="<?php echo $transaksi_komisi_list->id_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->id_pegawai) ?>', 1);"><div id="elh_transaksi_komisi_id_pegawai" class="transaksi_komisi_id_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->id_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->id_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->id_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->id_jabatan->Visible) { // id_jabatan ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->id_jabatan) == "") { ?>
		<th data-name="id_jabatan" class="<?php echo $transaksi_komisi_list->id_jabatan->headerCellClass() ?>"><div id="elh_transaksi_komisi_id_jabatan" class="transaksi_komisi_id_jabatan"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->id_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jabatan" class="<?php echo $transaksi_komisi_list->id_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->id_jabatan) ?>', 1);"><div id="elh_transaksi_komisi_id_jabatan" class="transaksi_komisi_id_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->id_jabatan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->id_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->id_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->kode_penjualan->Visible) { // kode_penjualan ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->kode_penjualan) == "") { ?>
		<th data-name="kode_penjualan" class="<?php echo $transaksi_komisi_list->kode_penjualan->headerCellClass() ?>"><div id="elh_transaksi_komisi_kode_penjualan" class="transaksi_komisi_kode_penjualan"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->kode_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penjualan" class="<?php echo $transaksi_komisi_list->kode_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->kode_penjualan) ?>', 1);"><div id="elh_transaksi_komisi_kode_penjualan" class="transaksi_komisi_kode_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->kode_penjualan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->kode_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->kode_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->tgl->Visible) { // tgl ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $transaksi_komisi_list->tgl->headerCellClass() ?>"><div id="elh_transaksi_komisi_tgl" class="transaksi_komisi_tgl"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $transaksi_komisi_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->tgl) ?>', 1);"><div id="elh_transaksi_komisi_tgl" class="transaksi_komisi_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->id_barang->Visible) { // id_barang ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $transaksi_komisi_list->id_barang->headerCellClass() ?>"><div id="elh_transaksi_komisi_id_barang" class="transaksi_komisi_id_barang"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $transaksi_komisi_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->id_barang) ?>', 1);"><div id="elh_transaksi_komisi_id_barang" class="transaksi_komisi_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->qty->Visible) { // qty ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $transaksi_komisi_list->qty->headerCellClass() ?>"><div id="elh_transaksi_komisi_qty" class="transaksi_komisi_qty"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $transaksi_komisi_list->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->qty) ?>', 1);"><div id="elh_transaksi_komisi_qty" class="transaksi_komisi_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->subtotal->Visible) { // subtotal ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->subtotal) == "") { ?>
		<th data-name="subtotal" class="<?php echo $transaksi_komisi_list->subtotal->headerCellClass() ?>"><div id="elh_transaksi_komisi_subtotal" class="transaksi_komisi_subtotal"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->subtotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subtotal" class="<?php echo $transaksi_komisi_list->subtotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->subtotal) ?>', 1);"><div id="elh_transaksi_komisi_subtotal" class="transaksi_komisi_subtotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->subtotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->subtotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->jenis_komisi->Visible) { // jenis_komisi ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->jenis_komisi) == "") { ?>
		<th data-name="jenis_komisi" class="<?php echo $transaksi_komisi_list->jenis_komisi->headerCellClass() ?>"><div id="elh_transaksi_komisi_jenis_komisi" class="transaksi_komisi_jenis_komisi"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->jenis_komisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_komisi" class="<?php echo $transaksi_komisi_list->jenis_komisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->jenis_komisi) ?>', 1);"><div id="elh_transaksi_komisi_jenis_komisi" class="transaksi_komisi_jenis_komisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->jenis_komisi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->jenis_komisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->jenis_komisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->komisi->Visible) { // komisi ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->komisi) == "") { ?>
		<th data-name="komisi" class="<?php echo $transaksi_komisi_list->komisi->headerCellClass() ?>"><div id="elh_transaksi_komisi_komisi" class="transaksi_komisi_komisi"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->komisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komisi" class="<?php echo $transaksi_komisi_list->komisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->komisi) ?>', 1);"><div id="elh_transaksi_komisi_komisi" class="transaksi_komisi_komisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->komisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->komisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->komisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaksi_komisi_list->total_komisi->Visible) { // total_komisi ?>
	<?php if ($transaksi_komisi_list->SortUrl($transaksi_komisi_list->total_komisi) == "") { ?>
		<th data-name="total_komisi" class="<?php echo $transaksi_komisi_list->total_komisi->headerCellClass() ?>"><div id="elh_transaksi_komisi_total_komisi" class="transaksi_komisi_total_komisi"><div class="ew-table-header-caption"><?php echo $transaksi_komisi_list->total_komisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_komisi" class="<?php echo $transaksi_komisi_list->total_komisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaksi_komisi_list->SortUrl($transaksi_komisi_list->total_komisi) ?>', 1);"><div id="elh_transaksi_komisi_total_komisi" class="transaksi_komisi_total_komisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaksi_komisi_list->total_komisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaksi_komisi_list->total_komisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaksi_komisi_list->total_komisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$transaksi_komisi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($transaksi_komisi_list->ExportAll && $transaksi_komisi_list->isExport()) {
	$transaksi_komisi_list->StopRecord = $transaksi_komisi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($transaksi_komisi_list->TotalRecords > $transaksi_komisi_list->StartRecord + $transaksi_komisi_list->DisplayRecords - 1)
		$transaksi_komisi_list->StopRecord = $transaksi_komisi_list->StartRecord + $transaksi_komisi_list->DisplayRecords - 1;
	else
		$transaksi_komisi_list->StopRecord = $transaksi_komisi_list->TotalRecords;
}
$transaksi_komisi_list->RecordCount = $transaksi_komisi_list->StartRecord - 1;
if ($transaksi_komisi_list->Recordset && !$transaksi_komisi_list->Recordset->EOF) {
	$transaksi_komisi_list->Recordset->moveFirst();
	$selectLimit = $transaksi_komisi_list->UseSelectLimit;
	if (!$selectLimit && $transaksi_komisi_list->StartRecord > 1)
		$transaksi_komisi_list->Recordset->move($transaksi_komisi_list->StartRecord - 1);
} elseif (!$transaksi_komisi->AllowAddDeleteRow && $transaksi_komisi_list->StopRecord == 0) {
	$transaksi_komisi_list->StopRecord = $transaksi_komisi->GridAddRowCount;
}

// Initialize aggregate
$transaksi_komisi->RowType = ROWTYPE_AGGREGATEINIT;
$transaksi_komisi->resetAttributes();
$transaksi_komisi_list->renderRow();
while ($transaksi_komisi_list->RecordCount < $transaksi_komisi_list->StopRecord) {
	$transaksi_komisi_list->RecordCount++;
	if ($transaksi_komisi_list->RecordCount >= $transaksi_komisi_list->StartRecord) {
		$transaksi_komisi_list->RowCount++;

		// Set up key count
		$transaksi_komisi_list->KeyCount = $transaksi_komisi_list->RowIndex;

		// Init row class and style
		$transaksi_komisi->resetAttributes();
		$transaksi_komisi->CssClass = "";
		if ($transaksi_komisi_list->isGridAdd()) {
		} else {
			$transaksi_komisi_list->loadRowValues($transaksi_komisi_list->Recordset); // Load row values
		}
		$transaksi_komisi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$transaksi_komisi->RowAttrs->merge(["data-rowindex" => $transaksi_komisi_list->RowCount, "id" => "r" . $transaksi_komisi_list->RowCount . "_transaksi_komisi", "data-rowtype" => $transaksi_komisi->RowType]);

		// Render row
		$transaksi_komisi_list->renderRow();

		// Render list options
		$transaksi_komisi_list->renderListOptions();
?>
	<tr <?php echo $transaksi_komisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transaksi_komisi_list->ListOptions->render("body", "left", $transaksi_komisi_list->RowCount);
?>
	<?php if ($transaksi_komisi_list->id_pegawai->Visible) { // id_pegawai ?>
		<td data-name="id_pegawai" <?php echo $transaksi_komisi_list->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_id_pegawai">
<span<?php echo $transaksi_komisi_list->id_pegawai->viewAttributes() ?>><?php echo $transaksi_komisi_list->id_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->id_jabatan->Visible) { // id_jabatan ?>
		<td data-name="id_jabatan" <?php echo $transaksi_komisi_list->id_jabatan->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_id_jabatan">
<span<?php echo $transaksi_komisi_list->id_jabatan->viewAttributes() ?>><?php echo $transaksi_komisi_list->id_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->kode_penjualan->Visible) { // kode_penjualan ?>
		<td data-name="kode_penjualan" <?php echo $transaksi_komisi_list->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_kode_penjualan">
<span<?php echo $transaksi_komisi_list->kode_penjualan->viewAttributes() ?>><?php echo $transaksi_komisi_list->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $transaksi_komisi_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_tgl">
<span<?php echo $transaksi_komisi_list->tgl->viewAttributes() ?>><?php echo $transaksi_komisi_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $transaksi_komisi_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_id_barang">
<span<?php echo $transaksi_komisi_list->id_barang->viewAttributes() ?>><?php echo $transaksi_komisi_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $transaksi_komisi_list->qty->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_qty">
<span<?php echo $transaksi_komisi_list->qty->viewAttributes() ?>><?php echo $transaksi_komisi_list->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->subtotal->Visible) { // subtotal ?>
		<td data-name="subtotal" <?php echo $transaksi_komisi_list->subtotal->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_subtotal">
<span<?php echo $transaksi_komisi_list->subtotal->viewAttributes() ?>><?php echo $transaksi_komisi_list->subtotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->jenis_komisi->Visible) { // jenis_komisi ?>
		<td data-name="jenis_komisi" <?php echo $transaksi_komisi_list->jenis_komisi->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_jenis_komisi">
<span<?php echo $transaksi_komisi_list->jenis_komisi->viewAttributes() ?>><?php echo $transaksi_komisi_list->jenis_komisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->komisi->Visible) { // komisi ?>
		<td data-name="komisi" <?php echo $transaksi_komisi_list->komisi->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_komisi">
<span<?php echo $transaksi_komisi_list->komisi->viewAttributes() ?>><?php echo $transaksi_komisi_list->komisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaksi_komisi_list->total_komisi->Visible) { // total_komisi ?>
		<td data-name="total_komisi" <?php echo $transaksi_komisi_list->total_komisi->cellAttributes() ?>>
<span id="el<?php echo $transaksi_komisi_list->RowCount ?>_transaksi_komisi_total_komisi">
<span<?php echo $transaksi_komisi_list->total_komisi->viewAttributes() ?>><?php echo $transaksi_komisi_list->total_komisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transaksi_komisi_list->ListOptions->render("body", "right", $transaksi_komisi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$transaksi_komisi_list->isGridAdd())
		$transaksi_komisi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$transaksi_komisi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($transaksi_komisi_list->Recordset)
	$transaksi_komisi_list->Recordset->Close();
?>
<?php if (!$transaksi_komisi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$transaksi_komisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $transaksi_komisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transaksi_komisi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($transaksi_komisi_list->TotalRecords == 0 && !$transaksi_komisi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $transaksi_komisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$transaksi_komisi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$transaksi_komisi_list->isExport()) { ?>
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
$transaksi_komisi_list->terminate();
?>