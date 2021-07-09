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
$view_hargajual_list = new view_hargajual_list();

// Run the page
$view_hargajual_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_hargajual_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view_hargajual_list->isExport()) { ?>
<script>
var fview_hargajuallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview_hargajuallist = currentForm = new ew.Form("fview_hargajuallist", "list");
	fview_hargajuallist.formKeyCountName = '<?php echo $view_hargajual_list->FormKeyCountName ?>';
	loadjs.done("fview_hargajuallist");
});
var fview_hargajuallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview_hargajuallistsrch = currentSearchForm = new ew.Form("fview_hargajuallistsrch");

	// Dynamic selection lists
	// Filters

	fview_hargajuallistsrch.filterList = <?php echo $view_hargajual_list->getFilterList() ?>;
	loadjs.done("fview_hargajuallistsrch");
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
<?php if (!$view_hargajual_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view_hargajual_list->TotalRecords > 0 && $view_hargajual_list->ExportOptions->visible()) { ?>
<?php $view_hargajual_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view_hargajual_list->ImportOptions->visible()) { ?>
<?php $view_hargajual_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view_hargajual_list->SearchOptions->visible()) { ?>
<?php $view_hargajual_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view_hargajual_list->FilterOptions->visible()) { ?>
<?php $view_hargajual_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view_hargajual_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view_hargajual_list->isExport() && !$view_hargajual->CurrentAction) { ?>
<form name="fview_hargajuallistsrch" id="fview_hargajuallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview_hargajuallistsrch-search-panel" class="<?php echo $view_hargajual_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_hargajual">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view_hargajual_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view_hargajual_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view_hargajual_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view_hargajual_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view_hargajual_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view_hargajual_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view_hargajual_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view_hargajual_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view_hargajual_list->showPageHeader(); ?>
<?php
$view_hargajual_list->showMessage();
?>
<?php if ($view_hargajual_list->TotalRecords > 0 || $view_hargajual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view_hargajual_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view_hargajual">
<?php if (!$view_hargajual_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view_hargajual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_hargajual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_hargajual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview_hargajuallist" id="fview_hargajuallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_hargajual">
<div id="gmp_view_hargajual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view_hargajual_list->TotalRecords > 0 || $view_hargajual_list->isGridEdit()) { ?>
<table id="tbl_view_hargajuallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view_hargajual->RowType = ROWTYPE_HEADER;

// Render list options
$view_hargajual_list->renderListOptions();

// Render list options (header, left)
$view_hargajual_list->ListOptions->render("header", "left");
?>
<?php if ($view_hargajual_list->id->Visible) { // id ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $view_hargajual_list->id->headerCellClass() ?>"><div id="elh_view_hargajual_id" class="view_hargajual_id"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $view_hargajual_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->id) ?>', 1);"><div id="elh_view_hargajual_id" class="view_hargajual_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->kode_barang->Visible) { // kode_barang ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $view_hargajual_list->kode_barang->headerCellClass() ?>"><div id="elh_view_hargajual_kode_barang" class="view_hargajual_kode_barang"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $view_hargajual_list->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->kode_barang) ?>', 1);"><div id="elh_view_hargajual_kode_barang" class="view_hargajual_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $view_hargajual_list->nama_barang->headerCellClass() ?>"><div id="elh_view_hargajual_nama_barang" class="view_hargajual_nama_barang"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $view_hargajual_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->nama_barang) ?>', 1);"><div id="elh_view_hargajual_nama_barang" class="view_hargajual_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->satuan->Visible) { // satuan ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $view_hargajual_list->satuan->headerCellClass() ?>"><div id="elh_view_hargajual_satuan" class="view_hargajual_satuan"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $view_hargajual_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->satuan) ?>', 1);"><div id="elh_view_hargajual_satuan" class="view_hargajual_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->jenis->Visible) { // jenis ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $view_hargajual_list->jenis->headerCellClass() ?>"><div id="elh_view_hargajual_jenis" class="view_hargajual_jenis"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $view_hargajual_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->jenis) ?>', 1);"><div id="elh_view_hargajual_jenis" class="view_hargajual_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->jenis->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->kategori->Visible) { // kategori ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->kategori) == "") { ?>
		<th data-name="kategori" class="<?php echo $view_hargajual_list->kategori->headerCellClass() ?>"><div id="elh_view_hargajual_kategori" class="view_hargajual_kategori"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori" class="<?php echo $view_hargajual_list->kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->kategori) ?>', 1);"><div id="elh_view_hargajual_kategori" class="view_hargajual_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->kategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->kategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->kategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->subkategori->Visible) { // subkategori ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->subkategori) == "") { ?>
		<th data-name="subkategori" class="<?php echo $view_hargajual_list->subkategori->headerCellClass() ?>"><div id="elh_view_hargajual_subkategori" class="view_hargajual_subkategori"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->subkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subkategori" class="<?php echo $view_hargajual_list->subkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->subkategori) ?>', 1);"><div id="elh_view_hargajual_subkategori" class="view_hargajual_subkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->subkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->subkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->subkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->id_hargajual->Visible) { // id_hargajual ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->id_hargajual) == "") { ?>
		<th data-name="id_hargajual" class="<?php echo $view_hargajual_list->id_hargajual->headerCellClass() ?>"><div id="elh_view_hargajual_id_hargajual" class="view_hargajual_id_hargajual"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->id_hargajual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_hargajual" class="<?php echo $view_hargajual_list->id_hargajual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->id_hargajual) ?>', 1);"><div id="elh_view_hargajual_id_hargajual" class="view_hargajual_id_hargajual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->id_hargajual->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->id_hargajual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->id_hargajual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->id_barang->Visible) { // id_barang ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $view_hargajual_list->id_barang->headerCellClass() ?>"><div id="elh_view_hargajual_id_barang" class="view_hargajual_id_barang"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $view_hargajual_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->id_barang) ?>', 1);"><div id="elh_view_hargajual_id_barang" class="view_hargajual_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->totalhargajual->Visible) { // totalhargajual ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->totalhargajual) == "") { ?>
		<th data-name="totalhargajual" class="<?php echo $view_hargajual_list->totalhargajual->headerCellClass() ?>"><div id="elh_view_hargajual_totalhargajual" class="view_hargajual_totalhargajual"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->totalhargajual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="totalhargajual" class="<?php echo $view_hargajual_list->totalhargajual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->totalhargajual) ?>', 1);"><div id="elh_view_hargajual_totalhargajual" class="view_hargajual_totalhargajual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->totalhargajual->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->totalhargajual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->totalhargajual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $view_hargajual_list->id_klinik->headerCellClass() ?>"><div id="elh_view_hargajual_id_klinik" class="view_hargajual_id_klinik"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $view_hargajual_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->id_klinik) ?>', 1);"><div id="elh_view_hargajual_id_klinik" class="view_hargajual_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->nama_klinik->Visible) { // nama_klinik ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->nama_klinik) == "") { ?>
		<th data-name="nama_klinik" class="<?php echo $view_hargajual_list->nama_klinik->headerCellClass() ?>"><div id="elh_view_hargajual_nama_klinik" class="view_hargajual_nama_klinik"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->nama_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_klinik" class="<?php echo $view_hargajual_list->nama_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->nama_klinik) ?>', 1);"><div id="elh_view_hargajual_nama_klinik" class="view_hargajual_nama_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->nama_klinik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->nama_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->nama_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->foto_klinik->Visible) { // foto_klinik ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->foto_klinik) == "") { ?>
		<th data-name="foto_klinik" class="<?php echo $view_hargajual_list->foto_klinik->headerCellClass() ?>"><div id="elh_view_hargajual_foto_klinik" class="view_hargajual_foto_klinik"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->foto_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto_klinik" class="<?php echo $view_hargajual_list->foto_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->foto_klinik) ?>', 1);"><div id="elh_view_hargajual_foto_klinik" class="view_hargajual_foto_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->foto_klinik->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->foto_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->foto_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->stok->Visible) { // stok ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $view_hargajual_list->stok->headerCellClass() ?>"><div id="elh_view_hargajual_stok" class="view_hargajual_stok"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $view_hargajual_list->stok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->stok) ?>', 1);"><div id="elh_view_hargajual_stok" class="view_hargajual_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->komposisi->Visible) { // komposisi ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->komposisi) == "") { ?>
		<th data-name="komposisi" class="<?php echo $view_hargajual_list->komposisi->headerCellClass() ?>"><div id="elh_view_hargajual_komposisi" class="view_hargajual_komposisi"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->komposisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komposisi" class="<?php echo $view_hargajual_list->komposisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->komposisi) ?>', 1);"><div id="elh_view_hargajual_komposisi" class="view_hargajual_komposisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->komposisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->komposisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->komposisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->tipe->Visible) { // tipe ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $view_hargajual_list->tipe->headerCellClass() ?>"><div id="elh_view_hargajual_tipe" class="view_hargajual_tipe"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $view_hargajual_list->tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->tipe) ?>', 1);"><div id="elh_view_hargajual_tipe" class="view_hargajual_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->tgl_exp->Visible) { // tgl_exp ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->tgl_exp) == "") { ?>
		<th data-name="tgl_exp" class="<?php echo $view_hargajual_list->tgl_exp->headerCellClass() ?>"><div id="elh_view_hargajual_tgl_exp" class="view_hargajual_tgl_exp"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->tgl_exp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_exp" class="<?php echo $view_hargajual_list->tgl_exp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->tgl_exp) ?>', 1);"><div id="elh_view_hargajual_tgl_exp" class="view_hargajual_tgl_exp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->tgl_exp->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->tgl_exp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->tgl_exp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->disc_rp->Visible) { // disc_rp ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->disc_rp) == "") { ?>
		<th data-name="disc_rp" class="<?php echo $view_hargajual_list->disc_rp->headerCellClass() ?>"><div id="elh_view_hargajual_disc_rp" class="view_hargajual_disc_rp"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->disc_rp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_rp" class="<?php echo $view_hargajual_list->disc_rp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->disc_rp) ?>', 1);"><div id="elh_view_hargajual_disc_rp" class="view_hargajual_disc_rp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->disc_rp->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->disc_rp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->disc_rp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->disc_pr->Visible) { // disc_pr ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->disc_pr) == "") { ?>
		<th data-name="disc_pr" class="<?php echo $view_hargajual_list->disc_pr->headerCellClass() ?>"><div id="elh_view_hargajual_disc_pr" class="view_hargajual_disc_pr"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->disc_pr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_pr" class="<?php echo $view_hargajual_list->disc_pr->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->disc_pr) ?>', 1);"><div id="elh_view_hargajual_disc_pr" class="view_hargajual_disc_pr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->disc_pr->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->disc_pr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->disc_pr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_hargajual_list->discontinue->Visible) { // discontinue ?>
	<?php if ($view_hargajual_list->SortUrl($view_hargajual_list->discontinue) == "") { ?>
		<th data-name="discontinue" class="<?php echo $view_hargajual_list->discontinue->headerCellClass() ?>"><div id="elh_view_hargajual_discontinue" class="view_hargajual_discontinue"><div class="ew-table-header-caption"><?php echo $view_hargajual_list->discontinue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="discontinue" class="<?php echo $view_hargajual_list->discontinue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_hargajual_list->SortUrl($view_hargajual_list->discontinue) ?>', 1);"><div id="elh_view_hargajual_discontinue" class="view_hargajual_discontinue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_hargajual_list->discontinue->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_hargajual_list->discontinue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_hargajual_list->discontinue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_hargajual_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_hargajual_list->ExportAll && $view_hargajual_list->isExport()) {
	$view_hargajual_list->StopRecord = $view_hargajual_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view_hargajual_list->TotalRecords > $view_hargajual_list->StartRecord + $view_hargajual_list->DisplayRecords - 1)
		$view_hargajual_list->StopRecord = $view_hargajual_list->StartRecord + $view_hargajual_list->DisplayRecords - 1;
	else
		$view_hargajual_list->StopRecord = $view_hargajual_list->TotalRecords;
}
$view_hargajual_list->RecordCount = $view_hargajual_list->StartRecord - 1;
if ($view_hargajual_list->Recordset && !$view_hargajual_list->Recordset->EOF) {
	$view_hargajual_list->Recordset->moveFirst();
	$selectLimit = $view_hargajual_list->UseSelectLimit;
	if (!$selectLimit && $view_hargajual_list->StartRecord > 1)
		$view_hargajual_list->Recordset->move($view_hargajual_list->StartRecord - 1);
} elseif (!$view_hargajual->AllowAddDeleteRow && $view_hargajual_list->StopRecord == 0) {
	$view_hargajual_list->StopRecord = $view_hargajual->GridAddRowCount;
}

// Initialize aggregate
$view_hargajual->RowType = ROWTYPE_AGGREGATEINIT;
$view_hargajual->resetAttributes();
$view_hargajual_list->renderRow();
while ($view_hargajual_list->RecordCount < $view_hargajual_list->StopRecord) {
	$view_hargajual_list->RecordCount++;
	if ($view_hargajual_list->RecordCount >= $view_hargajual_list->StartRecord) {
		$view_hargajual_list->RowCount++;

		// Set up key count
		$view_hargajual_list->KeyCount = $view_hargajual_list->RowIndex;

		// Init row class and style
		$view_hargajual->resetAttributes();
		$view_hargajual->CssClass = "";
		if ($view_hargajual_list->isGridAdd()) {
		} else {
			$view_hargajual_list->loadRowValues($view_hargajual_list->Recordset); // Load row values
		}
		$view_hargajual->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_hargajual->RowAttrs->merge(["data-rowindex" => $view_hargajual_list->RowCount, "id" => "r" . $view_hargajual_list->RowCount . "_view_hargajual", "data-rowtype" => $view_hargajual->RowType]);

		// Render row
		$view_hargajual_list->renderRow();

		// Render list options
		$view_hargajual_list->renderListOptions();
?>
	<tr <?php echo $view_hargajual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view_hargajual_list->ListOptions->render("body", "left", $view_hargajual_list->RowCount);
?>
	<?php if ($view_hargajual_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $view_hargajual_list->id->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_id">
<span<?php echo $view_hargajual_list->id->viewAttributes() ?>><?php echo $view_hargajual_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $view_hargajual_list->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_kode_barang">
<span<?php echo $view_hargajual_list->kode_barang->viewAttributes() ?>><?php echo $view_hargajual_list->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $view_hargajual_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_nama_barang">
<span<?php echo $view_hargajual_list->nama_barang->viewAttributes() ?>><?php echo $view_hargajual_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $view_hargajual_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_satuan">
<span<?php echo $view_hargajual_list->satuan->viewAttributes() ?>><?php echo $view_hargajual_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $view_hargajual_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_jenis">
<span<?php echo $view_hargajual_list->jenis->viewAttributes() ?>><?php echo $view_hargajual_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->kategori->Visible) { // kategori ?>
		<td data-name="kategori" <?php echo $view_hargajual_list->kategori->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_kategori">
<span<?php echo $view_hargajual_list->kategori->viewAttributes() ?>><?php echo $view_hargajual_list->kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->subkategori->Visible) { // subkategori ?>
		<td data-name="subkategori" <?php echo $view_hargajual_list->subkategori->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_subkategori">
<span<?php echo $view_hargajual_list->subkategori->viewAttributes() ?>><?php echo $view_hargajual_list->subkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->id_hargajual->Visible) { // id_hargajual ?>
		<td data-name="id_hargajual" <?php echo $view_hargajual_list->id_hargajual->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_id_hargajual">
<span<?php echo $view_hargajual_list->id_hargajual->viewAttributes() ?>><?php echo $view_hargajual_list->id_hargajual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $view_hargajual_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_id_barang">
<span<?php echo $view_hargajual_list->id_barang->viewAttributes() ?>><?php echo $view_hargajual_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->totalhargajual->Visible) { // totalhargajual ?>
		<td data-name="totalhargajual" <?php echo $view_hargajual_list->totalhargajual->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_totalhargajual">
<span<?php echo $view_hargajual_list->totalhargajual->viewAttributes() ?>><?php echo $view_hargajual_list->totalhargajual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $view_hargajual_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_id_klinik">
<span<?php echo $view_hargajual_list->id_klinik->viewAttributes() ?>><?php echo $view_hargajual_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->nama_klinik->Visible) { // nama_klinik ?>
		<td data-name="nama_klinik" <?php echo $view_hargajual_list->nama_klinik->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_nama_klinik">
<span<?php echo $view_hargajual_list->nama_klinik->viewAttributes() ?>><?php echo $view_hargajual_list->nama_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->foto_klinik->Visible) { // foto_klinik ?>
		<td data-name="foto_klinik" <?php echo $view_hargajual_list->foto_klinik->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_foto_klinik">
<span<?php echo $view_hargajual_list->foto_klinik->viewAttributes() ?>><?php echo $view_hargajual_list->foto_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $view_hargajual_list->stok->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_stok">
<span<?php echo $view_hargajual_list->stok->viewAttributes() ?>><?php echo $view_hargajual_list->stok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->komposisi->Visible) { // komposisi ?>
		<td data-name="komposisi" <?php echo $view_hargajual_list->komposisi->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_komposisi">
<span<?php echo $view_hargajual_list->komposisi->viewAttributes() ?>><?php echo $view_hargajual_list->komposisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $view_hargajual_list->tipe->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_tipe">
<span<?php echo $view_hargajual_list->tipe->viewAttributes() ?>><?php echo $view_hargajual_list->tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->tgl_exp->Visible) { // tgl_exp ?>
		<td data-name="tgl_exp" <?php echo $view_hargajual_list->tgl_exp->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_tgl_exp">
<span<?php echo $view_hargajual_list->tgl_exp->viewAttributes() ?>><?php echo $view_hargajual_list->tgl_exp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->disc_rp->Visible) { // disc_rp ?>
		<td data-name="disc_rp" <?php echo $view_hargajual_list->disc_rp->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_disc_rp">
<span<?php echo $view_hargajual_list->disc_rp->viewAttributes() ?>><?php echo $view_hargajual_list->disc_rp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->disc_pr->Visible) { // disc_pr ?>
		<td data-name="disc_pr" <?php echo $view_hargajual_list->disc_pr->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_disc_pr">
<span<?php echo $view_hargajual_list->disc_pr->viewAttributes() ?>><?php echo $view_hargajual_list->disc_pr->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_hargajual_list->discontinue->Visible) { // discontinue ?>
		<td data-name="discontinue" <?php echo $view_hargajual_list->discontinue->cellAttributes() ?>>
<span id="el<?php echo $view_hargajual_list->RowCount ?>_view_hargajual_discontinue">
<span<?php echo $view_hargajual_list->discontinue->viewAttributes() ?>><?php echo $view_hargajual_list->discontinue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_hargajual_list->ListOptions->render("body", "right", $view_hargajual_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view_hargajual_list->isGridAdd())
		$view_hargajual_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view_hargajual->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view_hargajual_list->Recordset)
	$view_hargajual_list->Recordset->Close();
?>
<?php if (!$view_hargajual_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view_hargajual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_hargajual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_hargajual_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view_hargajual_list->TotalRecords == 0 && !$view_hargajual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view_hargajual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view_hargajual_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view_hargajual_list->isExport()) { ?>
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
$view_hargajual_list->terminate();
?>