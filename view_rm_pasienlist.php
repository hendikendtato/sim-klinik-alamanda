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
$view_rm_pasien_list = new view_rm_pasien_list();

// Run the page
$view_rm_pasien_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_rm_pasien_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view_rm_pasien_list->isExport()) { ?>
<script>
var fview_rm_pasienlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview_rm_pasienlist = currentForm = new ew.Form("fview_rm_pasienlist", "list");
	fview_rm_pasienlist.formKeyCountName = '<?php echo $view_rm_pasien_list->FormKeyCountName ?>';
	loadjs.done("fview_rm_pasienlist");
});
var fview_rm_pasienlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview_rm_pasienlistsrch = currentSearchForm = new ew.Form("fview_rm_pasienlistsrch");

	// Dynamic selection lists
	// Filters

	fview_rm_pasienlistsrch.filterList = <?php echo $view_rm_pasien_list->getFilterList() ?>;
	loadjs.done("fview_rm_pasienlistsrch");
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
<?php if (!$view_rm_pasien_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view_rm_pasien_list->TotalRecords > 0 && $view_rm_pasien_list->ExportOptions->visible()) { ?>
<?php $view_rm_pasien_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view_rm_pasien_list->ImportOptions->visible()) { ?>
<?php $view_rm_pasien_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view_rm_pasien_list->SearchOptions->visible()) { ?>
<?php $view_rm_pasien_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view_rm_pasien_list->FilterOptions->visible()) { ?>
<?php $view_rm_pasien_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view_rm_pasien_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view_rm_pasien_list->isExport() && !$view_rm_pasien->CurrentAction) { ?>
<form name="fview_rm_pasienlistsrch" id="fview_rm_pasienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview_rm_pasienlistsrch-search-panel" class="<?php echo $view_rm_pasien_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_rm_pasien">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view_rm_pasien_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view_rm_pasien_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view_rm_pasien_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view_rm_pasien_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view_rm_pasien_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view_rm_pasien_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view_rm_pasien_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view_rm_pasien_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view_rm_pasien_list->showPageHeader(); ?>
<?php
$view_rm_pasien_list->showMessage();
?>
<?php if ($view_rm_pasien_list->TotalRecords > 0 || $view_rm_pasien->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view_rm_pasien_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view_rm_pasien">
<?php if (!$view_rm_pasien_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view_rm_pasien_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_rm_pasien_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_rm_pasien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview_rm_pasienlist" id="fview_rm_pasienlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_rm_pasien">
<div id="gmp_view_rm_pasien" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view_rm_pasien_list->TotalRecords > 0 || $view_rm_pasien_list->isGridEdit()) { ?>
<table id="tbl_view_rm_pasienlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view_rm_pasien->RowType = ROWTYPE_HEADER;

// Render list options
$view_rm_pasien_list->renderListOptions();

// Render list options (header, left)
$view_rm_pasien_list->ListOptions->render("header", "left");
?>
<?php if ($view_rm_pasien_list->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->nama_pelanggan) == "") { ?>
		<th data-name="nama_pelanggan" class="<?php echo $view_rm_pasien_list->nama_pelanggan->headerCellClass() ?>"><div id="elh_view_rm_pasien_nama_pelanggan" class="view_rm_pasien_nama_pelanggan"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->nama_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pelanggan" class="<?php echo $view_rm_pasien_list->nama_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->nama_pelanggan) ?>', 1);"><div id="elh_view_rm_pasien_nama_pelanggan" class="view_rm_pasien_nama_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->nama_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->nama_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->nama_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->kode_penjualan->Visible) { // kode_penjualan ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->kode_penjualan) == "") { ?>
		<th data-name="kode_penjualan" class="<?php echo $view_rm_pasien_list->kode_penjualan->headerCellClass() ?>"><div id="elh_view_rm_pasien_kode_penjualan" class="view_rm_pasien_kode_penjualan"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->kode_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penjualan" class="<?php echo $view_rm_pasien_list->kode_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->kode_penjualan) ?>', 1);"><div id="elh_view_rm_pasien_kode_penjualan" class="view_rm_pasien_kode_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->kode_penjualan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->kode_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->kode_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->waktu->Visible) { // waktu ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->waktu) == "") { ?>
		<th data-name="waktu" class="<?php echo $view_rm_pasien_list->waktu->headerCellClass() ?>"><div id="elh_view_rm_pasien_waktu" class="view_rm_pasien_waktu"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->waktu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="waktu" class="<?php echo $view_rm_pasien_list->waktu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->waktu) ?>', 1);"><div id="elh_view_rm_pasien_waktu" class="view_rm_pasien_waktu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->waktu->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->waktu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->waktu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $view_rm_pasien_list->id_klinik->headerCellClass() ?>"><div id="elh_view_rm_pasien_id_klinik" class="view_rm_pasien_id_klinik"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $view_rm_pasien_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->id_klinik) ?>', 1);"><div id="elh_view_rm_pasien_id_klinik" class="view_rm_pasien_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->id_barang->Visible) { // id_barang ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $view_rm_pasien_list->id_barang->headerCellClass() ?>"><div id="elh_view_rm_pasien_id_barang" class="view_rm_pasien_id_barang"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $view_rm_pasien_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->id_barang) ?>', 1);"><div id="elh_view_rm_pasien_id_barang" class="view_rm_pasien_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->kode_barang->Visible) { // kode_barang ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $view_rm_pasien_list->kode_barang->headerCellClass() ?>"><div id="elh_view_rm_pasien_kode_barang" class="view_rm_pasien_kode_barang"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $view_rm_pasien_list->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->kode_barang) ?>', 1);"><div id="elh_view_rm_pasien_kode_barang" class="view_rm_pasien_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $view_rm_pasien_list->nama_barang->headerCellClass() ?>"><div id="elh_view_rm_pasien_nama_barang" class="view_rm_pasien_nama_barang"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $view_rm_pasien_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->nama_barang) ?>', 1);"><div id="elh_view_rm_pasien_nama_barang" class="view_rm_pasien_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->harga_jual->Visible) { // harga_jual ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->harga_jual) == "") { ?>
		<th data-name="harga_jual" class="<?php echo $view_rm_pasien_list->harga_jual->headerCellClass() ?>"><div id="elh_view_rm_pasien_harga_jual" class="view_rm_pasien_harga_jual"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->harga_jual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga_jual" class="<?php echo $view_rm_pasien_list->harga_jual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->harga_jual) ?>', 1);"><div id="elh_view_rm_pasien_harga_jual" class="view_rm_pasien_harga_jual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->harga_jual->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->harga_jual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->harga_jual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->qty->Visible) { // qty ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $view_rm_pasien_list->qty->headerCellClass() ?>"><div id="elh_view_rm_pasien_qty" class="view_rm_pasien_qty"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $view_rm_pasien_list->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->qty) ?>', 1);"><div id="elh_view_rm_pasien_qty" class="view_rm_pasien_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->subtotal->Visible) { // subtotal ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->subtotal) == "") { ?>
		<th data-name="subtotal" class="<?php echo $view_rm_pasien_list->subtotal->headerCellClass() ?>"><div id="elh_view_rm_pasien_subtotal" class="view_rm_pasien_subtotal"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->subtotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subtotal" class="<?php echo $view_rm_pasien_list->subtotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->subtotal) ?>', 1);"><div id="elh_view_rm_pasien_subtotal" class="view_rm_pasien_subtotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->subtotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->subtotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rm_pasien_list->nama_klinik->Visible) { // nama_klinik ?>
	<?php if ($view_rm_pasien_list->SortUrl($view_rm_pasien_list->nama_klinik) == "") { ?>
		<th data-name="nama_klinik" class="<?php echo $view_rm_pasien_list->nama_klinik->headerCellClass() ?>"><div id="elh_view_rm_pasien_nama_klinik" class="view_rm_pasien_nama_klinik"><div class="ew-table-header-caption"><?php echo $view_rm_pasien_list->nama_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_klinik" class="<?php echo $view_rm_pasien_list->nama_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rm_pasien_list->SortUrl($view_rm_pasien_list->nama_klinik) ?>', 1);"><div id="elh_view_rm_pasien_nama_klinik" class="view_rm_pasien_nama_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rm_pasien_list->nama_klinik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rm_pasien_list->nama_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rm_pasien_list->nama_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_rm_pasien_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_rm_pasien_list->ExportAll && $view_rm_pasien_list->isExport()) {
	$view_rm_pasien_list->StopRecord = $view_rm_pasien_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view_rm_pasien_list->TotalRecords > $view_rm_pasien_list->StartRecord + $view_rm_pasien_list->DisplayRecords - 1)
		$view_rm_pasien_list->StopRecord = $view_rm_pasien_list->StartRecord + $view_rm_pasien_list->DisplayRecords - 1;
	else
		$view_rm_pasien_list->StopRecord = $view_rm_pasien_list->TotalRecords;
}
$view_rm_pasien_list->RecordCount = $view_rm_pasien_list->StartRecord - 1;
if ($view_rm_pasien_list->Recordset && !$view_rm_pasien_list->Recordset->EOF) {
	$view_rm_pasien_list->Recordset->moveFirst();
	$selectLimit = $view_rm_pasien_list->UseSelectLimit;
	if (!$selectLimit && $view_rm_pasien_list->StartRecord > 1)
		$view_rm_pasien_list->Recordset->move($view_rm_pasien_list->StartRecord - 1);
} elseif (!$view_rm_pasien->AllowAddDeleteRow && $view_rm_pasien_list->StopRecord == 0) {
	$view_rm_pasien_list->StopRecord = $view_rm_pasien->GridAddRowCount;
}

// Initialize aggregate
$view_rm_pasien->RowType = ROWTYPE_AGGREGATEINIT;
$view_rm_pasien->resetAttributes();
$view_rm_pasien_list->renderRow();
while ($view_rm_pasien_list->RecordCount < $view_rm_pasien_list->StopRecord) {
	$view_rm_pasien_list->RecordCount++;
	if ($view_rm_pasien_list->RecordCount >= $view_rm_pasien_list->StartRecord) {
		$view_rm_pasien_list->RowCount++;

		// Set up key count
		$view_rm_pasien_list->KeyCount = $view_rm_pasien_list->RowIndex;

		// Init row class and style
		$view_rm_pasien->resetAttributes();
		$view_rm_pasien->CssClass = "";
		if ($view_rm_pasien_list->isGridAdd()) {
		} else {
			$view_rm_pasien_list->loadRowValues($view_rm_pasien_list->Recordset); // Load row values
		}
		$view_rm_pasien->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_rm_pasien->RowAttrs->merge(["data-rowindex" => $view_rm_pasien_list->RowCount, "id" => "r" . $view_rm_pasien_list->RowCount . "_view_rm_pasien", "data-rowtype" => $view_rm_pasien->RowType]);

		// Render row
		$view_rm_pasien_list->renderRow();

		// Render list options
		$view_rm_pasien_list->renderListOptions();
?>
	<tr <?php echo $view_rm_pasien->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view_rm_pasien_list->ListOptions->render("body", "left", $view_rm_pasien_list->RowCount);
?>
	<?php if ($view_rm_pasien_list->nama_pelanggan->Visible) { // nama_pelanggan ?>
		<td data-name="nama_pelanggan" <?php echo $view_rm_pasien_list->nama_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_nama_pelanggan">
<span<?php echo $view_rm_pasien_list->nama_pelanggan->viewAttributes() ?>><?php echo $view_rm_pasien_list->nama_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->kode_penjualan->Visible) { // kode_penjualan ?>
		<td data-name="kode_penjualan" <?php echo $view_rm_pasien_list->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_kode_penjualan">
<span<?php echo $view_rm_pasien_list->kode_penjualan->viewAttributes() ?>><?php echo $view_rm_pasien_list->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->waktu->Visible) { // waktu ?>
		<td data-name="waktu" <?php echo $view_rm_pasien_list->waktu->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_waktu">
<span<?php echo $view_rm_pasien_list->waktu->viewAttributes() ?>><?php echo $view_rm_pasien_list->waktu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $view_rm_pasien_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_id_klinik">
<span<?php echo $view_rm_pasien_list->id_klinik->viewAttributes() ?>><?php echo $view_rm_pasien_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $view_rm_pasien_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_id_barang">
<span<?php echo $view_rm_pasien_list->id_barang->viewAttributes() ?>><?php echo $view_rm_pasien_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $view_rm_pasien_list->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_kode_barang">
<span<?php echo $view_rm_pasien_list->kode_barang->viewAttributes() ?>><?php echo $view_rm_pasien_list->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $view_rm_pasien_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_nama_barang">
<span<?php echo $view_rm_pasien_list->nama_barang->viewAttributes() ?>><?php echo $view_rm_pasien_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->harga_jual->Visible) { // harga_jual ?>
		<td data-name="harga_jual" <?php echo $view_rm_pasien_list->harga_jual->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_harga_jual">
<span<?php echo $view_rm_pasien_list->harga_jual->viewAttributes() ?>><?php echo $view_rm_pasien_list->harga_jual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $view_rm_pasien_list->qty->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_qty">
<span<?php echo $view_rm_pasien_list->qty->viewAttributes() ?>><?php echo $view_rm_pasien_list->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->subtotal->Visible) { // subtotal ?>
		<td data-name="subtotal" <?php echo $view_rm_pasien_list->subtotal->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_subtotal">
<span<?php echo $view_rm_pasien_list->subtotal->viewAttributes() ?>><?php echo $view_rm_pasien_list->subtotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rm_pasien_list->nama_klinik->Visible) { // nama_klinik ?>
		<td data-name="nama_klinik" <?php echo $view_rm_pasien_list->nama_klinik->cellAttributes() ?>>
<span id="el<?php echo $view_rm_pasien_list->RowCount ?>_view_rm_pasien_nama_klinik">
<span<?php echo $view_rm_pasien_list->nama_klinik->viewAttributes() ?>><?php echo $view_rm_pasien_list->nama_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_rm_pasien_list->ListOptions->render("body", "right", $view_rm_pasien_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view_rm_pasien_list->isGridAdd())
		$view_rm_pasien_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view_rm_pasien->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view_rm_pasien_list->Recordset)
	$view_rm_pasien_list->Recordset->Close();
?>
<?php if (!$view_rm_pasien_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view_rm_pasien_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_rm_pasien_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_rm_pasien_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view_rm_pasien_list->TotalRecords == 0 && !$view_rm_pasien->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view_rm_pasien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view_rm_pasien_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view_rm_pasien_list->isExport()) { ?>
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
$view_rm_pasien_list->terminate();
?>