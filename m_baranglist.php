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
$m_barang_list = new m_barang_list();

// Run the page
$m_barang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_barang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_barang_list->isExport()) { ?>
<script>
var fm_baranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_baranglist = currentForm = new ew.Form("fm_baranglist", "list");
	fm_baranglist.formKeyCountName = '<?php echo $m_barang_list->FormKeyCountName ?>';
	loadjs.done("fm_baranglist");
});
var fm_baranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_baranglistsrch = currentSearchForm = new ew.Form("fm_baranglistsrch");

	// Dynamic selection lists
	// Filters

	fm_baranglistsrch.filterList = <?php echo $m_barang_list->getFilterList() ?>;
	loadjs.done("fm_baranglistsrch");
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
<?php if (!$m_barang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_barang_list->TotalRecords > 0 && $m_barang_list->ExportOptions->visible()) { ?>
<?php $m_barang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_barang_list->ImportOptions->visible()) { ?>
<?php $m_barang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_barang_list->SearchOptions->visible()) { ?>
<?php $m_barang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_barang_list->FilterOptions->visible()) { ?>
<?php $m_barang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_barang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_barang_list->isExport() && !$m_barang->CurrentAction) { ?>
<form name="fm_baranglistsrch" id="fm_baranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_baranglistsrch-search-panel" class="<?php echo $m_barang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_barang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_barang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_barang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_barang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_barang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_barang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_barang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_barang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_barang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_barang_list->showPageHeader(); ?>
<?php
$m_barang_list->showMessage();
?>
<?php if ($m_barang_list->TotalRecords > 0 || $m_barang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_barang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_barang">
<?php if (!$m_barang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_baranglist" id="fm_baranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_barang">
<div id="gmp_m_barang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_barang_list->TotalRecords > 0 || $m_barang_list->isGridEdit()) { ?>
<table id="tbl_m_baranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_barang->RowType = ROWTYPE_HEADER;

// Render list options
$m_barang_list->renderListOptions();

// Render list options (header, left)
$m_barang_list->ListOptions->render("header", "left");
?>
<?php if ($m_barang_list->id->Visible) { // id ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_barang_list->id->headerCellClass() ?>"><div id="elh_m_barang_id" class="m_barang_id"><div class="ew-table-header-caption"><?php echo $m_barang_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_barang_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->id) ?>', 1);"><div id="elh_m_barang_id" class="m_barang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->kode_barang->Visible) { // kode_barang ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $m_barang_list->kode_barang->headerCellClass() ?>"><div id="elh_m_barang_kode_barang" class="m_barang_kode_barang"><div class="ew-table-header-caption"><?php echo $m_barang_list->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $m_barang_list->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->kode_barang) ?>', 1);"><div id="elh_m_barang_kode_barang" class="m_barang_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->kode_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $m_barang_list->nama_barang->headerCellClass() ?>"><div id="elh_m_barang_nama_barang" class="m_barang_nama_barang"><div class="ew-table-header-caption"><?php echo $m_barang_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $m_barang_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->nama_barang) ?>', 1);"><div id="elh_m_barang_nama_barang" class="m_barang_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->nama_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->satuan->Visible) { // satuan ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $m_barang_list->satuan->headerCellClass() ?>"><div id="elh_m_barang_satuan" class="m_barang_satuan"><div class="ew-table-header-caption"><?php echo $m_barang_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $m_barang_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->satuan) ?>', 1);"><div id="elh_m_barang_satuan" class="m_barang_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->jenis->Visible) { // jenis ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $m_barang_list->jenis->headerCellClass() ?>"><div id="elh_m_barang_jenis" class="m_barang_jenis"><div class="ew-table-header-caption"><?php echo $m_barang_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $m_barang_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->jenis) ?>', 1);"><div id="elh_m_barang_jenis" class="m_barang_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->jenis->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->kategori->Visible) { // kategori ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->kategori) == "") { ?>
		<th data-name="kategori" class="<?php echo $m_barang_list->kategori->headerCellClass() ?>"><div id="elh_m_barang_kategori" class="m_barang_kategori"><div class="ew-table-header-caption"><?php echo $m_barang_list->kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori" class="<?php echo $m_barang_list->kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->kategori) ?>', 1);"><div id="elh_m_barang_kategori" class="m_barang_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->kategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->kategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->kategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->subkategori->Visible) { // subkategori ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->subkategori) == "") { ?>
		<th data-name="subkategori" class="<?php echo $m_barang_list->subkategori->headerCellClass() ?>"><div id="elh_m_barang_subkategori" class="m_barang_subkategori"><div class="ew-table-header-caption"><?php echo $m_barang_list->subkategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subkategori" class="<?php echo $m_barang_list->subkategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->subkategori) ?>', 1);"><div id="elh_m_barang_subkategori" class="m_barang_subkategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->subkategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->subkategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->subkategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->komposisi->Visible) { // komposisi ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->komposisi) == "") { ?>
		<th data-name="komposisi" class="<?php echo $m_barang_list->komposisi->headerCellClass() ?>"><div id="elh_m_barang_komposisi" class="m_barang_komposisi"><div class="ew-table-header-caption"><?php echo $m_barang_list->komposisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komposisi" class="<?php echo $m_barang_list->komposisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->komposisi) ?>', 1);"><div id="elh_m_barang_komposisi" class="m_barang_komposisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->komposisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->komposisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->komposisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->tipe->Visible) { // tipe ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $m_barang_list->tipe->headerCellClass() ?>"><div id="elh_m_barang_tipe" class="m_barang_tipe"><div class="ew-table-header-caption"><?php echo $m_barang_list->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $m_barang_list->tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->tipe) ?>', 1);"><div id="elh_m_barang_tipe" class="m_barang_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->status->Visible) { // status ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $m_barang_list->status->headerCellClass() ?>"><div id="elh_m_barang_status" class="m_barang_status"><div class="ew-table-header-caption"><?php echo $m_barang_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $m_barang_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->status) ?>', 1);"><div id="elh_m_barang_status" class="m_barang_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->shortname_barang->Visible) { // shortname_barang ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->shortname_barang) == "") { ?>
		<th data-name="shortname_barang" class="<?php echo $m_barang_list->shortname_barang->headerCellClass() ?>"><div id="elh_m_barang_shortname_barang" class="m_barang_shortname_barang"><div class="ew-table-header-caption"><?php echo $m_barang_list->shortname_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="shortname_barang" class="<?php echo $m_barang_list->shortname_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->shortname_barang) ?>', 1);"><div id="elh_m_barang_shortname_barang" class="m_barang_shortname_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->shortname_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->shortname_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->shortname_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->id_tag->Visible) { // id_tag ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->id_tag) == "") { ?>
		<th data-name="id_tag" class="<?php echo $m_barang_list->id_tag->headerCellClass() ?>"><div id="elh_m_barang_id_tag" class="m_barang_id_tag"><div class="ew-table-header-caption"><?php echo $m_barang_list->id_tag->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tag" class="<?php echo $m_barang_list->id_tag->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->id_tag) ?>', 1);"><div id="elh_m_barang_id_tag" class="m_barang_id_tag">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->id_tag->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->id_tag->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->id_tag->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_barang_list->discontinue->Visible) { // discontinue ?>
	<?php if ($m_barang_list->SortUrl($m_barang_list->discontinue) == "") { ?>
		<th data-name="discontinue" class="<?php echo $m_barang_list->discontinue->headerCellClass() ?>"><div id="elh_m_barang_discontinue" class="m_barang_discontinue"><div class="ew-table-header-caption"><?php echo $m_barang_list->discontinue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="discontinue" class="<?php echo $m_barang_list->discontinue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_barang_list->SortUrl($m_barang_list->discontinue) ?>', 1);"><div id="elh_m_barang_discontinue" class="m_barang_discontinue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_barang_list->discontinue->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_barang_list->discontinue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_barang_list->discontinue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_barang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_barang_list->ExportAll && $m_barang_list->isExport()) {
	$m_barang_list->StopRecord = $m_barang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_barang_list->TotalRecords > $m_barang_list->StartRecord + $m_barang_list->DisplayRecords - 1)
		$m_barang_list->StopRecord = $m_barang_list->StartRecord + $m_barang_list->DisplayRecords - 1;
	else
		$m_barang_list->StopRecord = $m_barang_list->TotalRecords;
}
$m_barang_list->RecordCount = $m_barang_list->StartRecord - 1;
if ($m_barang_list->Recordset && !$m_barang_list->Recordset->EOF) {
	$m_barang_list->Recordset->moveFirst();
	$selectLimit = $m_barang_list->UseSelectLimit;
	if (!$selectLimit && $m_barang_list->StartRecord > 1)
		$m_barang_list->Recordset->move($m_barang_list->StartRecord - 1);
} elseif (!$m_barang->AllowAddDeleteRow && $m_barang_list->StopRecord == 0) {
	$m_barang_list->StopRecord = $m_barang->GridAddRowCount;
}

// Initialize aggregate
$m_barang->RowType = ROWTYPE_AGGREGATEINIT;
$m_barang->resetAttributes();
$m_barang_list->renderRow();
while ($m_barang_list->RecordCount < $m_barang_list->StopRecord) {
	$m_barang_list->RecordCount++;
	if ($m_barang_list->RecordCount >= $m_barang_list->StartRecord) {
		$m_barang_list->RowCount++;

		// Set up key count
		$m_barang_list->KeyCount = $m_barang_list->RowIndex;

		// Init row class and style
		$m_barang->resetAttributes();
		$m_barang->CssClass = "";
		if ($m_barang_list->isGridAdd()) {
		} else {
			$m_barang_list->loadRowValues($m_barang_list->Recordset); // Load row values
		}
		$m_barang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_barang->RowAttrs->merge(["data-rowindex" => $m_barang_list->RowCount, "id" => "r" . $m_barang_list->RowCount . "_m_barang", "data-rowtype" => $m_barang->RowType]);

		// Render row
		$m_barang_list->renderRow();

		// Render list options
		$m_barang_list->renderListOptions();
?>
	<tr <?php echo $m_barang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_barang_list->ListOptions->render("body", "left", $m_barang_list->RowCount);
?>
	<?php if ($m_barang_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_barang_list->id->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_id">
<span<?php echo $m_barang_list->id->viewAttributes() ?>><?php echo $m_barang_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $m_barang_list->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_kode_barang">
<span<?php echo $m_barang_list->kode_barang->viewAttributes() ?>><?php echo $m_barang_list->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $m_barang_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_nama_barang">
<span<?php echo $m_barang_list->nama_barang->viewAttributes() ?>><?php echo $m_barang_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $m_barang_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_satuan">
<span<?php echo $m_barang_list->satuan->viewAttributes() ?>><?php echo $m_barang_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $m_barang_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_jenis">
<span<?php echo $m_barang_list->jenis->viewAttributes() ?>><?php echo $m_barang_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->kategori->Visible) { // kategori ?>
		<td data-name="kategori" <?php echo $m_barang_list->kategori->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_kategori">
<span<?php echo $m_barang_list->kategori->viewAttributes() ?>><?php echo $m_barang_list->kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->subkategori->Visible) { // subkategori ?>
		<td data-name="subkategori" <?php echo $m_barang_list->subkategori->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_subkategori">
<span<?php echo $m_barang_list->subkategori->viewAttributes() ?>><?php echo $m_barang_list->subkategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->komposisi->Visible) { // komposisi ?>
		<td data-name="komposisi" <?php echo $m_barang_list->komposisi->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_komposisi">
<span<?php echo $m_barang_list->komposisi->viewAttributes() ?>><?php echo $m_barang_list->komposisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $m_barang_list->tipe->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_tipe">
<span<?php echo $m_barang_list->tipe->viewAttributes() ?>><?php echo $m_barang_list->tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $m_barang_list->status->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_status">
<span<?php echo $m_barang_list->status->viewAttributes() ?>><?php echo $m_barang_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->shortname_barang->Visible) { // shortname_barang ?>
		<td data-name="shortname_barang" <?php echo $m_barang_list->shortname_barang->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_shortname_barang">
<span<?php echo $m_barang_list->shortname_barang->viewAttributes() ?>><?php echo $m_barang_list->shortname_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->id_tag->Visible) { // id_tag ?>
		<td data-name="id_tag" <?php echo $m_barang_list->id_tag->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_id_tag">
<span<?php echo $m_barang_list->id_tag->viewAttributes() ?>><?php echo $m_barang_list->id_tag->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_barang_list->discontinue->Visible) { // discontinue ?>
		<td data-name="discontinue" <?php echo $m_barang_list->discontinue->cellAttributes() ?>>
<span id="el<?php echo $m_barang_list->RowCount ?>_m_barang_discontinue">
<span<?php echo $m_barang_list->discontinue->viewAttributes() ?>><?php echo $m_barang_list->discontinue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_barang_list->ListOptions->render("body", "right", $m_barang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_barang_list->isGridAdd())
		$m_barang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_barang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_barang_list->Recordset)
	$m_barang_list->Recordset->Close();
?>
<?php if (!$m_barang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_barang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_barang_list->TotalRecords == 0 && !$m_barang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_barang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_barang_list->isExport()) { ?>
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
$m_barang_list->terminate();
?>