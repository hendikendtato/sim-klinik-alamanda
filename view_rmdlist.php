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
$view_rmd_list = new view_rmd_list();

// Run the page
$view_rmd_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_rmd_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view_rmd_list->isExport()) { ?>
<script>
var fview_rmdlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview_rmdlist = currentForm = new ew.Form("fview_rmdlist", "list");
	fview_rmdlist.formKeyCountName = '<?php echo $view_rmd_list->FormKeyCountName ?>';
	loadjs.done("fview_rmdlist");
});
var fview_rmdlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview_rmdlistsrch = currentSearchForm = new ew.Form("fview_rmdlistsrch");

	// Dynamic selection lists
	// Filters

	fview_rmdlistsrch.filterList = <?php echo $view_rmd_list->getFilterList() ?>;
	loadjs.done("fview_rmdlistsrch");
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
<?php if (!$view_rmd_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view_rmd_list->TotalRecords > 0 && $view_rmd_list->ExportOptions->visible()) { ?>
<?php $view_rmd_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view_rmd_list->ImportOptions->visible()) { ?>
<?php $view_rmd_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view_rmd_list->SearchOptions->visible()) { ?>
<?php $view_rmd_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view_rmd_list->FilterOptions->visible()) { ?>
<?php $view_rmd_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view_rmd_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view_rmd_list->isExport() && !$view_rmd->CurrentAction) { ?>
<form name="fview_rmdlistsrch" id="fview_rmdlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview_rmdlistsrch-search-panel" class="<?php echo $view_rmd_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_rmd">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view_rmd_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view_rmd_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view_rmd_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view_rmd_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view_rmd_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view_rmd_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view_rmd_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view_rmd_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view_rmd_list->showPageHeader(); ?>
<?php
$view_rmd_list->showMessage();
?>
<?php if ($view_rmd_list->TotalRecords > 0 || $view_rmd->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view_rmd_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view_rmd">
<?php if (!$view_rmd_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view_rmd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_rmd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_rmd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview_rmdlist" id="fview_rmdlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_rmd">
<div id="gmp_view_rmd" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view_rmd_list->TotalRecords > 0 || $view_rmd_list->isGridEdit()) { ?>
<table id="tbl_view_rmdlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view_rmd->RowType = ROWTYPE_HEADER;

// Render list options
$view_rmd_list->renderListOptions();

// Render list options (header, left)
$view_rmd_list->ListOptions->render("header", "left");
?>
<?php if ($view_rmd_list->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->id_rekmeddok) == "") { ?>
		<th data-name="id_rekmeddok" class="<?php echo $view_rmd_list->id_rekmeddok->headerCellClass() ?>"><div id="elh_view_rmd_id_rekmeddok" class="view_rmd_id_rekmeddok"><div class="ew-table-header-caption"><?php echo $view_rmd_list->id_rekmeddok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_rekmeddok" class="<?php echo $view_rmd_list->id_rekmeddok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->id_rekmeddok) ?>', 1);"><div id="elh_view_rmd_id_rekmeddok" class="view_rmd_id_rekmeddok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->id_rekmeddok->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->id_rekmeddok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->id_rekmeddok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->kode_rekmeddok) == "") { ?>
		<th data-name="kode_rekmeddok" class="<?php echo $view_rmd_list->kode_rekmeddok->headerCellClass() ?>"><div id="elh_view_rmd_kode_rekmeddok" class="view_rmd_kode_rekmeddok"><div class="ew-table-header-caption"><?php echo $view_rmd_list->kode_rekmeddok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_rekmeddok" class="<?php echo $view_rmd_list->kode_rekmeddok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->kode_rekmeddok) ?>', 1);"><div id="elh_view_rmd_kode_rekmeddok" class="view_rmd_kode_rekmeddok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->kode_rekmeddok->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->kode_rekmeddok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->kode_rekmeddok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->tanggal->Visible) { // tanggal ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $view_rmd_list->tanggal->headerCellClass() ?>"><div id="elh_view_rmd_tanggal" class="view_rmd_tanggal"><div class="ew-table-header-caption"><?php echo $view_rmd_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $view_rmd_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->tanggal) ?>', 1);"><div id="elh_view_rmd_tanggal" class="view_rmd_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $view_rmd_list->id_pelanggan->headerCellClass() ?>"><div id="elh_view_rmd_id_pelanggan" class="view_rmd_id_pelanggan"><div class="ew-table-header-caption"><?php echo $view_rmd_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $view_rmd_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->id_pelanggan) ?>', 1);"><div id="elh_view_rmd_id_pelanggan" class="view_rmd_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->id_dokter->Visible) { // id_dokter ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->id_dokter) == "") { ?>
		<th data-name="id_dokter" class="<?php echo $view_rmd_list->id_dokter->headerCellClass() ?>"><div id="elh_view_rmd_id_dokter" class="view_rmd_id_dokter"><div class="ew-table-header-caption"><?php echo $view_rmd_list->id_dokter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_dokter" class="<?php echo $view_rmd_list->id_dokter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->id_dokter) ?>', 1);"><div id="elh_view_rmd_id_dokter" class="view_rmd_id_dokter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->id_dokter->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->id_dokter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->id_dokter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->id_be->Visible) { // id_be ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->id_be) == "") { ?>
		<th data-name="id_be" class="<?php echo $view_rmd_list->id_be->headerCellClass() ?>"><div id="elh_view_rmd_id_be" class="view_rmd_id_be"><div class="ew-table-header-caption"><?php echo $view_rmd_list->id_be->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_be" class="<?php echo $view_rmd_list->id_be->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->id_be) ?>', 1);"><div id="elh_view_rmd_id_be" class="view_rmd_id_be">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->id_be->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->id_be->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->id_be->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->id_pemobat->Visible) { // id_pemobat ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->id_pemobat) == "") { ?>
		<th data-name="id_pemobat" class="<?php echo $view_rmd_list->id_pemobat->headerCellClass() ?>"><div id="elh_view_rmd_id_pemobat" class="view_rmd_id_pemobat"><div class="ew-table-header-caption"><?php echo $view_rmd_list->id_pemobat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pemobat" class="<?php echo $view_rmd_list->id_pemobat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->id_pemobat) ?>', 1);"><div id="elh_view_rmd_id_pemobat" class="view_rmd_id_pemobat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->id_pemobat->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->id_pemobat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->id_pemobat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->id_barang->Visible) { // id_barang ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $view_rmd_list->id_barang->headerCellClass() ?>"><div id="elh_view_rmd_id_barang" class="view_rmd_id_barang"><div class="ew-table-header-caption"><?php echo $view_rmd_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $view_rmd_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->id_barang) ?>', 1);"><div id="elh_view_rmd_id_barang" class="view_rmd_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->jumlah->Visible) { // jumlah ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $view_rmd_list->jumlah->headerCellClass() ?>"><div id="elh_view_rmd_jumlah" class="view_rmd_jumlah"><div class="ew-table-header-caption"><?php echo $view_rmd_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $view_rmd_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->jumlah) ?>', 1);"><div id="elh_view_rmd_jumlah" class="view_rmd_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->satuan->Visible) { // satuan ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $view_rmd_list->satuan->headerCellClass() ?>"><div id="elh_view_rmd_satuan" class="view_rmd_satuan"><div class="ew-table-header-caption"><?php echo $view_rmd_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $view_rmd_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->satuan) ?>', 1);"><div id="elh_view_rmd_satuan" class="view_rmd_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->kode_barang->Visible) { // kode_barang ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $view_rmd_list->kode_barang->headerCellClass() ?>"><div id="elh_view_rmd_kode_barang" class="view_rmd_kode_barang"><div class="ew-table-header-caption"><?php echo $view_rmd_list->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $view_rmd_list->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->kode_barang) ?>', 1);"><div id="elh_view_rmd_kode_barang" class="view_rmd_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_rmd_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($view_rmd_list->SortUrl($view_rmd_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $view_rmd_list->nama_barang->headerCellClass() ?>"><div id="elh_view_rmd_nama_barang" class="view_rmd_nama_barang"><div class="ew-table-header-caption"><?php echo $view_rmd_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $view_rmd_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_rmd_list->SortUrl($view_rmd_list->nama_barang) ?>', 1);"><div id="elh_view_rmd_nama_barang" class="view_rmd_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_rmd_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_rmd_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_rmd_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_rmd_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_rmd_list->ExportAll && $view_rmd_list->isExport()) {
	$view_rmd_list->StopRecord = $view_rmd_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view_rmd_list->TotalRecords > $view_rmd_list->StartRecord + $view_rmd_list->DisplayRecords - 1)
		$view_rmd_list->StopRecord = $view_rmd_list->StartRecord + $view_rmd_list->DisplayRecords - 1;
	else
		$view_rmd_list->StopRecord = $view_rmd_list->TotalRecords;
}
$view_rmd_list->RecordCount = $view_rmd_list->StartRecord - 1;
if ($view_rmd_list->Recordset && !$view_rmd_list->Recordset->EOF) {
	$view_rmd_list->Recordset->moveFirst();
	$selectLimit = $view_rmd_list->UseSelectLimit;
	if (!$selectLimit && $view_rmd_list->StartRecord > 1)
		$view_rmd_list->Recordset->move($view_rmd_list->StartRecord - 1);
} elseif (!$view_rmd->AllowAddDeleteRow && $view_rmd_list->StopRecord == 0) {
	$view_rmd_list->StopRecord = $view_rmd->GridAddRowCount;
}

// Initialize aggregate
$view_rmd->RowType = ROWTYPE_AGGREGATEINIT;
$view_rmd->resetAttributes();
$view_rmd_list->renderRow();
while ($view_rmd_list->RecordCount < $view_rmd_list->StopRecord) {
	$view_rmd_list->RecordCount++;
	if ($view_rmd_list->RecordCount >= $view_rmd_list->StartRecord) {
		$view_rmd_list->RowCount++;

		// Set up key count
		$view_rmd_list->KeyCount = $view_rmd_list->RowIndex;

		// Init row class and style
		$view_rmd->resetAttributes();
		$view_rmd->CssClass = "";
		if ($view_rmd_list->isGridAdd()) {
		} else {
			$view_rmd_list->loadRowValues($view_rmd_list->Recordset); // Load row values
		}
		$view_rmd->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_rmd->RowAttrs->merge(["data-rowindex" => $view_rmd_list->RowCount, "id" => "r" . $view_rmd_list->RowCount . "_view_rmd", "data-rowtype" => $view_rmd->RowType]);

		// Render row
		$view_rmd_list->renderRow();

		// Render list options
		$view_rmd_list->renderListOptions();
?>
	<tr <?php echo $view_rmd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view_rmd_list->ListOptions->render("body", "left", $view_rmd_list->RowCount);
?>
	<?php if ($view_rmd_list->id_rekmeddok->Visible) { // id_rekmeddok ?>
		<td data-name="id_rekmeddok" <?php echo $view_rmd_list->id_rekmeddok->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_id_rekmeddok">
<span<?php echo $view_rmd_list->id_rekmeddok->viewAttributes() ?>><?php echo $view_rmd_list->id_rekmeddok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
		<td data-name="kode_rekmeddok" <?php echo $view_rmd_list->kode_rekmeddok->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_kode_rekmeddok">
<span<?php echo $view_rmd_list->kode_rekmeddok->viewAttributes() ?>><?php echo $view_rmd_list->kode_rekmeddok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $view_rmd_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_tanggal">
<span<?php echo $view_rmd_list->tanggal->viewAttributes() ?>><?php echo $view_rmd_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $view_rmd_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_id_pelanggan">
<span<?php echo $view_rmd_list->id_pelanggan->viewAttributes() ?>><?php echo $view_rmd_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->id_dokter->Visible) { // id_dokter ?>
		<td data-name="id_dokter" <?php echo $view_rmd_list->id_dokter->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_id_dokter">
<span<?php echo $view_rmd_list->id_dokter->viewAttributes() ?>><?php echo $view_rmd_list->id_dokter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->id_be->Visible) { // id_be ?>
		<td data-name="id_be" <?php echo $view_rmd_list->id_be->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_id_be">
<span<?php echo $view_rmd_list->id_be->viewAttributes() ?>><?php echo $view_rmd_list->id_be->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->id_pemobat->Visible) { // id_pemobat ?>
		<td data-name="id_pemobat" <?php echo $view_rmd_list->id_pemobat->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_id_pemobat">
<span<?php echo $view_rmd_list->id_pemobat->viewAttributes() ?>><?php echo $view_rmd_list->id_pemobat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $view_rmd_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_id_barang">
<span<?php echo $view_rmd_list->id_barang->viewAttributes() ?>><?php echo $view_rmd_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $view_rmd_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_jumlah">
<span<?php echo $view_rmd_list->jumlah->viewAttributes() ?>><?php echo $view_rmd_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $view_rmd_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_satuan">
<span<?php echo $view_rmd_list->satuan->viewAttributes() ?>><?php echo $view_rmd_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $view_rmd_list->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_kode_barang">
<span<?php echo $view_rmd_list->kode_barang->viewAttributes() ?>><?php echo $view_rmd_list->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_rmd_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $view_rmd_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $view_rmd_list->RowCount ?>_view_rmd_nama_barang">
<span<?php echo $view_rmd_list->nama_barang->viewAttributes() ?>><?php echo $view_rmd_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_rmd_list->ListOptions->render("body", "right", $view_rmd_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view_rmd_list->isGridAdd())
		$view_rmd_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view_rmd->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view_rmd_list->Recordset)
	$view_rmd_list->Recordset->Close();
?>
<?php if (!$view_rmd_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view_rmd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_rmd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_rmd_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view_rmd_list->TotalRecords == 0 && !$view_rmd->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view_rmd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view_rmd_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view_rmd_list->isExport()) { ?>
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
$view_rmd_list->terminate();
?>