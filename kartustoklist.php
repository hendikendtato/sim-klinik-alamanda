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
$kartustok_list = new kartustok_list();

// Run the page
$kartustok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kartustok_list->isExport()) { ?>
<script>
var fkartustoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkartustoklist = currentForm = new ew.Form("fkartustoklist", "list");
	fkartustoklist.formKeyCountName = '<?php echo $kartustok_list->FormKeyCountName ?>';
	loadjs.done("fkartustoklist");
});
var fkartustoklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkartustoklistsrch = currentSearchForm = new ew.Form("fkartustoklistsrch");

	// Dynamic selection lists
	// Filters

	fkartustoklistsrch.filterList = <?php echo $kartustok_list->getFilterList() ?>;
	loadjs.done("fkartustoklistsrch");
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
<?php if (!$kartustok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kartustok_list->TotalRecords > 0 && $kartustok_list->ExportOptions->visible()) { ?>
<?php $kartustok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kartustok_list->ImportOptions->visible()) { ?>
<?php $kartustok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kartustok_list->SearchOptions->visible()) { ?>
<?php $kartustok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kartustok_list->FilterOptions->visible()) { ?>
<?php $kartustok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$kartustok_list->isExport() || Config("EXPORT_MASTER_RECORD") && $kartustok_list->isExport("print")) { ?>
<?php
if ($kartustok_list->DbMasterFilter != "" && $kartustok->getCurrentMasterTable() == "V_kartustok") {
	if ($kartustok_list->MasterRecordExists) {
		include_once "V_kartustokmaster.php";
	}
}
?>
<?php } ?>
<?php
$kartustok_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kartustok_list->isExport() && !$kartustok->CurrentAction) { ?>
<form name="fkartustoklistsrch" id="fkartustoklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkartustoklistsrch-search-panel" class="<?php echo $kartustok_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kartustok">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kartustok_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kartustok_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kartustok_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kartustok_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kartustok_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kartustok_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kartustok_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kartustok_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kartustok_list->showPageHeader(); ?>
<?php
$kartustok_list->showMessage();
?>
<?php if ($kartustok_list->TotalRecords > 0 || $kartustok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kartustok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kartustok">
<?php if (!$kartustok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kartustok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kartustok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kartustok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkartustoklist" id="fkartustoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartustok">
<?php if ($kartustok->getCurrentMasterTable() == "V_kartustok" && $kartustok->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="V_kartustok">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($kartustok_list->id_barang->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_kartustok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kartustok_list->TotalRecords > 0 || $kartustok_list->isGridEdit()) { ?>
<table id="tbl_kartustoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kartustok->RowType = ROWTYPE_HEADER;

// Render list options
$kartustok_list->renderListOptions();

// Render list options (header, left)
$kartustok_list->ListOptions->render("header", "left");
?>
<?php if ($kartustok_list->id_barang->Visible) { // id_barang ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $kartustok_list->id_barang->headerCellClass() ?>"><div id="elh_kartustok_id_barang" class="kartustok_id_barang"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $kartustok_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_barang) ?>', 1);"><div id="elh_kartustok_id_barang" class="kartustok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $kartustok_list->id_klinik->headerCellClass() ?>"><div id="elh_kartustok_id_klinik" class="kartustok_id_klinik"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $kartustok_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_klinik) ?>', 1);"><div id="elh_kartustok_id_klinik" class="kartustok_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->tanggal->Visible) { // tanggal ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $kartustok_list->tanggal->headerCellClass() ?>"><div id="elh_kartustok_tanggal" class="kartustok_tanggal"><div class="ew-table-header-caption"><?php echo $kartustok_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $kartustok_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->tanggal) ?>', 1);"><div id="elh_kartustok_tanggal" class="kartustok_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_terimabarang->Visible) { // id_terimabarang ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_terimabarang) == "") { ?>
		<th data-name="id_terimabarang" class="<?php echo $kartustok_list->id_terimabarang->headerCellClass() ?>"><div id="elh_kartustok_id_terimabarang" class="kartustok_id_terimabarang"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_terimabarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_terimabarang" class="<?php echo $kartustok_list->id_terimabarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_terimabarang) ?>', 1);"><div id="elh_kartustok_id_terimabarang" class="kartustok_id_terimabarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_terimabarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_terimabarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_terimabarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_terimagudang->Visible) { // id_terimagudang ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_terimagudang) == "") { ?>
		<th data-name="id_terimagudang" class="<?php echo $kartustok_list->id_terimagudang->headerCellClass() ?>"><div id="elh_kartustok_id_terimagudang" class="kartustok_id_terimagudang"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_terimagudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_terimagudang" class="<?php echo $kartustok_list->id_terimagudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_terimagudang) ?>', 1);"><div id="elh_kartustok_id_terimagudang" class="kartustok_id_terimagudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_terimagudang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_terimagudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_terimagudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_penjualan->Visible) { // id_penjualan ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_penjualan) == "") { ?>
		<th data-name="id_penjualan" class="<?php echo $kartustok_list->id_penjualan->headerCellClass() ?>"><div id="elh_kartustok_id_penjualan" class="kartustok_id_penjualan"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penjualan" class="<?php echo $kartustok_list->id_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_penjualan) ?>', 1);"><div id="elh_kartustok_id_penjualan" class="kartustok_id_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_kirimbarang) == "") { ?>
		<th data-name="id_kirimbarang" class="<?php echo $kartustok_list->id_kirimbarang->headerCellClass() ?>"><div id="elh_kartustok_id_kirimbarang" class="kartustok_id_kirimbarang"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kirimbarang" class="<?php echo $kartustok_list->id_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_kirimbarang) ?>', 1);"><div id="elh_kartustok_id_kirimbarang" class="kartustok_id_kirimbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_retur->Visible) { // id_retur ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_retur) == "") { ?>
		<th data-name="id_retur" class="<?php echo $kartustok_list->id_retur->headerCellClass() ?>"><div id="elh_kartustok_id_retur" class="kartustok_id_retur"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_retur" class="<?php echo $kartustok_list->id_retur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_retur) ?>', 1);"><div id="elh_kartustok_id_retur" class="kartustok_id_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->id_penyesuaian->Visible) { // id_penyesuaian ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->id_penyesuaian) == "") { ?>
		<th data-name="id_penyesuaian" class="<?php echo $kartustok_list->id_penyesuaian->headerCellClass() ?>"><div id="elh_kartustok_id_penyesuaian" class="kartustok_id_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartustok_list->id_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penyesuaian" class="<?php echo $kartustok_list->id_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->id_penyesuaian) ?>', 1);"><div id="elh_kartustok_id_penyesuaian" class="kartustok_id_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->id_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->id_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->id_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->stok_awal->Visible) { // stok_awal ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->stok_awal) == "") { ?>
		<th data-name="stok_awal" class="<?php echo $kartustok_list->stok_awal->headerCellClass() ?>"><div id="elh_kartustok_stok_awal" class="kartustok_stok_awal"><div class="ew-table-header-caption"><?php echo $kartustok_list->stok_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok_awal" class="<?php echo $kartustok_list->stok_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->stok_awal) ?>', 1);"><div id="elh_kartustok_stok_awal" class="kartustok_stok_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->stok_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->stok_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->stok_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->masuk->Visible) { // masuk ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->masuk) == "") { ?>
		<th data-name="masuk" class="<?php echo $kartustok_list->masuk->headerCellClass() ?>"><div id="elh_kartustok_masuk" class="kartustok_masuk"><div class="ew-table-header-caption"><?php echo $kartustok_list->masuk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk" class="<?php echo $kartustok_list->masuk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->masuk) ?>', 1);"><div id="elh_kartustok_masuk" class="kartustok_masuk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->masuk->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->masuk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->masuk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->masuk_penyesuaian) == "") { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $kartustok_list->masuk_penyesuaian->headerCellClass() ?>"><div id="elh_kartustok_masuk_penyesuaian" class="kartustok_masuk_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartustok_list->masuk_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $kartustok_list->masuk_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->masuk_penyesuaian) ?>', 1);"><div id="elh_kartustok_masuk_penyesuaian" class="kartustok_masuk_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->masuk_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->masuk_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->masuk_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->keluar->Visible) { // keluar ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->keluar) == "") { ?>
		<th data-name="keluar" class="<?php echo $kartustok_list->keluar->headerCellClass() ?>"><div id="elh_kartustok_keluar" class="kartustok_keluar"><div class="ew-table-header-caption"><?php echo $kartustok_list->keluar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar" class="<?php echo $kartustok_list->keluar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->keluar) ?>', 1);"><div id="elh_kartustok_keluar" class="kartustok_keluar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->keluar->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->keluar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->keluar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->keluar_nonjual->Visible) { // keluar_nonjual ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->keluar_nonjual) == "") { ?>
		<th data-name="keluar_nonjual" class="<?php echo $kartustok_list->keluar_nonjual->headerCellClass() ?>"><div id="elh_kartustok_keluar_nonjual" class="kartustok_keluar_nonjual"><div class="ew-table-header-caption"><?php echo $kartustok_list->keluar_nonjual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_nonjual" class="<?php echo $kartustok_list->keluar_nonjual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->keluar_nonjual) ?>', 1);"><div id="elh_kartustok_keluar_nonjual" class="kartustok_keluar_nonjual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->keluar_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->keluar_nonjual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->keluar_nonjual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->keluar_penyesuaian) == "") { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $kartustok_list->keluar_penyesuaian->headerCellClass() ?>"><div id="elh_kartustok_keluar_penyesuaian" class="kartustok_keluar_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartustok_list->keluar_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $kartustok_list->keluar_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->keluar_penyesuaian) ?>', 1);"><div id="elh_kartustok_keluar_penyesuaian" class="kartustok_keluar_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->keluar_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->keluar_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->keluar_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->keluar_kirim->Visible) { // keluar_kirim ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->keluar_kirim) == "") { ?>
		<th data-name="keluar_kirim" class="<?php echo $kartustok_list->keluar_kirim->headerCellClass() ?>"><div id="elh_kartustok_keluar_kirim" class="kartustok_keluar_kirim"><div class="ew-table-header-caption"><?php echo $kartustok_list->keluar_kirim->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_kirim" class="<?php echo $kartustok_list->keluar_kirim->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->keluar_kirim) ?>', 1);"><div id="elh_kartustok_keluar_kirim" class="kartustok_keluar_kirim">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->keluar_kirim->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->keluar_kirim->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->keluar_kirim->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->retur->Visible) { // retur ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->retur) == "") { ?>
		<th data-name="retur" class="<?php echo $kartustok_list->retur->headerCellClass() ?>"><div id="elh_kartustok_retur" class="kartustok_retur"><div class="ew-table-header-caption"><?php echo $kartustok_list->retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="retur" class="<?php echo $kartustok_list->retur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->retur) ?>', 1);"><div id="elh_kartustok_retur" class="kartustok_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_list->stok_akhir->Visible) { // stok_akhir ?>
	<?php if ($kartustok_list->SortUrl($kartustok_list->stok_akhir) == "") { ?>
		<th data-name="stok_akhir" class="<?php echo $kartustok_list->stok_akhir->headerCellClass() ?>"><div id="elh_kartustok_stok_akhir" class="kartustok_stok_akhir"><div class="ew-table-header-caption"><?php echo $kartustok_list->stok_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok_akhir" class="<?php echo $kartustok_list->stok_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartustok_list->SortUrl($kartustok_list->stok_akhir) ?>', 1);"><div id="elh_kartustok_stok_akhir" class="kartustok_stok_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_list->stok_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_list->stok_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_list->stok_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kartustok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kartustok_list->ExportAll && $kartustok_list->isExport()) {
	$kartustok_list->StopRecord = $kartustok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kartustok_list->TotalRecords > $kartustok_list->StartRecord + $kartustok_list->DisplayRecords - 1)
		$kartustok_list->StopRecord = $kartustok_list->StartRecord + $kartustok_list->DisplayRecords - 1;
	else
		$kartustok_list->StopRecord = $kartustok_list->TotalRecords;
}
$kartustok_list->RecordCount = $kartustok_list->StartRecord - 1;
if ($kartustok_list->Recordset && !$kartustok_list->Recordset->EOF) {
	$kartustok_list->Recordset->moveFirst();
	$selectLimit = $kartustok_list->UseSelectLimit;
	if (!$selectLimit && $kartustok_list->StartRecord > 1)
		$kartustok_list->Recordset->move($kartustok_list->StartRecord - 1);
} elseif (!$kartustok->AllowAddDeleteRow && $kartustok_list->StopRecord == 0) {
	$kartustok_list->StopRecord = $kartustok->GridAddRowCount;
}

// Initialize aggregate
$kartustok->RowType = ROWTYPE_AGGREGATEINIT;
$kartustok->resetAttributes();
$kartustok_list->renderRow();
while ($kartustok_list->RecordCount < $kartustok_list->StopRecord) {
	$kartustok_list->RecordCount++;
	if ($kartustok_list->RecordCount >= $kartustok_list->StartRecord) {
		$kartustok_list->RowCount++;

		// Set up key count
		$kartustok_list->KeyCount = $kartustok_list->RowIndex;

		// Init row class and style
		$kartustok->resetAttributes();
		$kartustok->CssClass = "";
		if ($kartustok_list->isGridAdd()) {
		} else {
			$kartustok_list->loadRowValues($kartustok_list->Recordset); // Load row values
		}
		$kartustok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kartustok->RowAttrs->merge(["data-rowindex" => $kartustok_list->RowCount, "id" => "r" . $kartustok_list->RowCount . "_kartustok", "data-rowtype" => $kartustok->RowType]);

		// Render row
		$kartustok_list->renderRow();

		// Render list options
		$kartustok_list->renderListOptions();
?>
	<tr <?php echo $kartustok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kartustok_list->ListOptions->render("body", "left", $kartustok_list->RowCount);
?>
	<?php if ($kartustok_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $kartustok_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_barang">
<span<?php echo $kartustok_list->id_barang->viewAttributes() ?>><?php echo $kartustok_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $kartustok_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_klinik">
<span<?php echo $kartustok_list->id_klinik->viewAttributes() ?>><?php echo $kartustok_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $kartustok_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_tanggal">
<span<?php echo $kartustok_list->tanggal->viewAttributes() ?>><?php echo $kartustok_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_terimabarang->Visible) { // id_terimabarang ?>
		<td data-name="id_terimabarang" <?php echo $kartustok_list->id_terimabarang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_terimabarang">
<span<?php echo $kartustok_list->id_terimabarang->viewAttributes() ?>><?php echo $kartustok_list->id_terimabarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_terimagudang->Visible) { // id_terimagudang ?>
		<td data-name="id_terimagudang" <?php echo $kartustok_list->id_terimagudang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_terimagudang">
<span<?php echo $kartustok_list->id_terimagudang->viewAttributes() ?>><?php echo $kartustok_list->id_terimagudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_penjualan->Visible) { // id_penjualan ?>
		<td data-name="id_penjualan" <?php echo $kartustok_list->id_penjualan->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_penjualan">
<span<?php echo $kartustok_list->id_penjualan->viewAttributes() ?>><?php echo $kartustok_list->id_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang" <?php echo $kartustok_list->id_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_kirimbarang">
<span<?php echo $kartustok_list->id_kirimbarang->viewAttributes() ?>><?php echo $kartustok_list->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur" <?php echo $kartustok_list->id_retur->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_retur">
<span<?php echo $kartustok_list->id_retur->viewAttributes() ?>><?php echo $kartustok_list->id_retur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->id_penyesuaian->Visible) { // id_penyesuaian ?>
		<td data-name="id_penyesuaian" <?php echo $kartustok_list->id_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_id_penyesuaian">
<span<?php echo $kartustok_list->id_penyesuaian->viewAttributes() ?>><?php echo $kartustok_list->id_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->stok_awal->Visible) { // stok_awal ?>
		<td data-name="stok_awal" <?php echo $kartustok_list->stok_awal->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_stok_awal">
<span<?php echo $kartustok_list->stok_awal->viewAttributes() ?>><?php echo $kartustok_list->stok_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->masuk->Visible) { // masuk ?>
		<td data-name="masuk" <?php echo $kartustok_list->masuk->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_masuk">
<span<?php echo $kartustok_list->masuk->viewAttributes() ?>><?php echo $kartustok_list->masuk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td data-name="masuk_penyesuaian" <?php echo $kartustok_list->masuk_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_masuk_penyesuaian">
<span<?php echo $kartustok_list->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartustok_list->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->keluar->Visible) { // keluar ?>
		<td data-name="keluar" <?php echo $kartustok_list->keluar->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_keluar">
<span<?php echo $kartustok_list->keluar->viewAttributes() ?>><?php echo $kartustok_list->keluar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->keluar_nonjual->Visible) { // keluar_nonjual ?>
		<td data-name="keluar_nonjual" <?php echo $kartustok_list->keluar_nonjual->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_keluar_nonjual">
<span<?php echo $kartustok_list->keluar_nonjual->viewAttributes() ?>><?php echo $kartustok_list->keluar_nonjual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td data-name="keluar_penyesuaian" <?php echo $kartustok_list->keluar_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_keluar_penyesuaian">
<span<?php echo $kartustok_list->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartustok_list->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->keluar_kirim->Visible) { // keluar_kirim ?>
		<td data-name="keluar_kirim" <?php echo $kartustok_list->keluar_kirim->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_keluar_kirim">
<span<?php echo $kartustok_list->keluar_kirim->viewAttributes() ?>><?php echo $kartustok_list->keluar_kirim->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->retur->Visible) { // retur ?>
		<td data-name="retur" <?php echo $kartustok_list->retur->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_retur">
<span<?php echo $kartustok_list->retur->viewAttributes() ?>><?php echo $kartustok_list->retur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartustok_list->stok_akhir->Visible) { // stok_akhir ?>
		<td data-name="stok_akhir" <?php echo $kartustok_list->stok_akhir->cellAttributes() ?>>
<span id="el<?php echo $kartustok_list->RowCount ?>_kartustok_stok_akhir">
<span<?php echo $kartustok_list->stok_akhir->viewAttributes() ?>><?php echo $kartustok_list->stok_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kartustok_list->ListOptions->render("body", "right", $kartustok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kartustok_list->isGridAdd())
		$kartustok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kartustok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kartustok_list->Recordset)
	$kartustok_list->Recordset->Close();
?>
<?php if (!$kartustok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kartustok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kartustok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kartustok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kartustok_list->TotalRecords == 0 && !$kartustok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kartustok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kartustok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kartustok_list->isExport()) { ?>
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
$kartustok_list->terminate();
?>