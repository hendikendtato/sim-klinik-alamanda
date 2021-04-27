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
$m_pegawai_list = new m_pegawai_list();

// Run the page
$m_pegawai_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pegawai_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_pegawai_list->isExport()) { ?>
<script>
var fm_pegawailist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_pegawailist = currentForm = new ew.Form("fm_pegawailist", "list");
	fm_pegawailist.formKeyCountName = '<?php echo $m_pegawai_list->FormKeyCountName ?>';
	loadjs.done("fm_pegawailist");
});
var fm_pegawailistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_pegawailistsrch = currentSearchForm = new ew.Form("fm_pegawailistsrch");

	// Dynamic selection lists
	// Filters

	fm_pegawailistsrch.filterList = <?php echo $m_pegawai_list->getFilterList() ?>;
	loadjs.done("fm_pegawailistsrch");
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
<?php if (!$m_pegawai_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_pegawai_list->TotalRecords > 0 && $m_pegawai_list->ExportOptions->visible()) { ?>
<?php $m_pegawai_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_pegawai_list->ImportOptions->visible()) { ?>
<?php $m_pegawai_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_pegawai_list->SearchOptions->visible()) { ?>
<?php $m_pegawai_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_pegawai_list->FilterOptions->visible()) { ?>
<?php $m_pegawai_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_pegawai_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_pegawai_list->isExport() && !$m_pegawai->CurrentAction) { ?>
<form name="fm_pegawailistsrch" id="fm_pegawailistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_pegawailistsrch-search-panel" class="<?php echo $m_pegawai_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_pegawai">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_pegawai_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_pegawai_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_pegawai_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_pegawai_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_pegawai_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_pegawai_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_pegawai_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_pegawai_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_pegawai_list->showPageHeader(); ?>
<?php
$m_pegawai_list->showMessage();
?>
<?php if ($m_pegawai_list->TotalRecords > 0 || $m_pegawai->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_pegawai_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_pegawai">
<?php if (!$m_pegawai_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_pegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_pegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_pegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_pegawailist" id="fm_pegawailist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pegawai">
<div id="gmp_m_pegawai" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_pegawai_list->TotalRecords > 0 || $m_pegawai_list->isGridEdit()) { ?>
<table id="tbl_m_pegawailist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_pegawai->RowType = ROWTYPE_HEADER;

// Render list options
$m_pegawai_list->renderListOptions();

// Render list options (header, left)
$m_pegawai_list->ListOptions->render("header", "left");
?>
<?php if ($m_pegawai_list->id_pegawai->Visible) { // id_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->id_pegawai) == "") { ?>
		<th data-name="id_pegawai" class="<?php echo $m_pegawai_list->id_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_id_pegawai" class="m_pegawai_id_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->id_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pegawai" class="<?php echo $m_pegawai_list->id_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->id_pegawai) ?>', 1);"><div id="elh_m_pegawai_id_pegawai" class="m_pegawai_id_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->id_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->id_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->id_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->nama_pegawai->Visible) { // nama_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->nama_pegawai) == "") { ?>
		<th data-name="nama_pegawai" class="<?php echo $m_pegawai_list->nama_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_nama_pegawai" class="m_pegawai_nama_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->nama_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pegawai" class="<?php echo $m_pegawai_list->nama_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->nama_pegawai) ?>', 1);"><div id="elh_m_pegawai_nama_pegawai" class="m_pegawai_nama_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->nama_pegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->nama_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->nama_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->nama_lengkap->Visible) { // nama_lengkap ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->nama_lengkap) == "") { ?>
		<th data-name="nama_lengkap" class="<?php echo $m_pegawai_list->nama_lengkap->headerCellClass() ?>"><div id="elh_m_pegawai_nama_lengkap" class="m_pegawai_nama_lengkap"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->nama_lengkap->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_lengkap" class="<?php echo $m_pegawai_list->nama_lengkap->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->nama_lengkap) ?>', 1);"><div id="elh_m_pegawai_nama_lengkap" class="m_pegawai_nama_lengkap">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->nama_lengkap->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->nama_lengkap->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->nama_lengkap->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->nik_pegawai->Visible) { // nik_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->nik_pegawai) == "") { ?>
		<th data-name="nik_pegawai" class="<?php echo $m_pegawai_list->nik_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_nik_pegawai" class="m_pegawai_nik_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->nik_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nik_pegawai" class="<?php echo $m_pegawai_list->nik_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->nik_pegawai) ?>', 1);"><div id="elh_m_pegawai_nik_pegawai" class="m_pegawai_nik_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->nik_pegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->nik_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->nik_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->alamat_pegawai->Visible) { // alamat_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->alamat_pegawai) == "") { ?>
		<th data-name="alamat_pegawai" class="<?php echo $m_pegawai_list->alamat_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_alamat_pegawai" class="m_pegawai_alamat_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->alamat_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat_pegawai" class="<?php echo $m_pegawai_list->alamat_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->alamat_pegawai) ?>', 1);"><div id="elh_m_pegawai_alamat_pegawai" class="m_pegawai_alamat_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->alamat_pegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->alamat_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->alamat_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->hp_pegawai->Visible) { // hp_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->hp_pegawai) == "") { ?>
		<th data-name="hp_pegawai" class="<?php echo $m_pegawai_list->hp_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_hp_pegawai" class="m_pegawai_hp_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->hp_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp_pegawai" class="<?php echo $m_pegawai_list->hp_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->hp_pegawai) ?>', 1);"><div id="elh_m_pegawai_hp_pegawai" class="m_pegawai_hp_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->hp_pegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->hp_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->hp_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->spesialis_pegawai) == "") { ?>
		<th data-name="spesialis_pegawai" class="<?php echo $m_pegawai_list->spesialis_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_spesialis_pegawai" class="m_pegawai_spesialis_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->spesialis_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="spesialis_pegawai" class="<?php echo $m_pegawai_list->spesialis_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->spesialis_pegawai) ?>', 1);"><div id="elh_m_pegawai_spesialis_pegawai" class="m_pegawai_spesialis_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->spesialis_pegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->spesialis_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->spesialis_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->jabatan_pegawai) == "") { ?>
		<th data-name="jabatan_pegawai" class="<?php echo $m_pegawai_list->jabatan_pegawai->headerCellClass() ?>"><div id="elh_m_pegawai_jabatan_pegawai" class="m_pegawai_jabatan_pegawai"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->jabatan_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_pegawai" class="<?php echo $m_pegawai_list->jabatan_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->jabatan_pegawai) ?>', 1);"><div id="elh_m_pegawai_jabatan_pegawai" class="m_pegawai_jabatan_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->jabatan_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->jabatan_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->jabatan_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_pegawai_list->id_klinik->headerCellClass() ?>"><div id="elh_m_pegawai_id_klinik" class="m_pegawai_id_klinik"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_pegawai_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->id_klinik) ?>', 1);"><div id="elh_m_pegawai_id_klinik" class="m_pegawai_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pegawai_list->nilai_komisi->Visible) { // nilai_komisi ?>
	<?php if ($m_pegawai_list->SortUrl($m_pegawai_list->nilai_komisi) == "") { ?>
		<th data-name="nilai_komisi" class="<?php echo $m_pegawai_list->nilai_komisi->headerCellClass() ?>"><div id="elh_m_pegawai_nilai_komisi" class="m_pegawai_nilai_komisi"><div class="ew-table-header-caption"><?php echo $m_pegawai_list->nilai_komisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nilai_komisi" class="<?php echo $m_pegawai_list->nilai_komisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pegawai_list->SortUrl($m_pegawai_list->nilai_komisi) ?>', 1);"><div id="elh_m_pegawai_nilai_komisi" class="m_pegawai_nilai_komisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pegawai_list->nilai_komisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pegawai_list->nilai_komisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pegawai_list->nilai_komisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_pegawai_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_pegawai_list->ExportAll && $m_pegawai_list->isExport()) {
	$m_pegawai_list->StopRecord = $m_pegawai_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_pegawai_list->TotalRecords > $m_pegawai_list->StartRecord + $m_pegawai_list->DisplayRecords - 1)
		$m_pegawai_list->StopRecord = $m_pegawai_list->StartRecord + $m_pegawai_list->DisplayRecords - 1;
	else
		$m_pegawai_list->StopRecord = $m_pegawai_list->TotalRecords;
}
$m_pegawai_list->RecordCount = $m_pegawai_list->StartRecord - 1;
if ($m_pegawai_list->Recordset && !$m_pegawai_list->Recordset->EOF) {
	$m_pegawai_list->Recordset->moveFirst();
	$selectLimit = $m_pegawai_list->UseSelectLimit;
	if (!$selectLimit && $m_pegawai_list->StartRecord > 1)
		$m_pegawai_list->Recordset->move($m_pegawai_list->StartRecord - 1);
} elseif (!$m_pegawai->AllowAddDeleteRow && $m_pegawai_list->StopRecord == 0) {
	$m_pegawai_list->StopRecord = $m_pegawai->GridAddRowCount;
}

// Initialize aggregate
$m_pegawai->RowType = ROWTYPE_AGGREGATEINIT;
$m_pegawai->resetAttributes();
$m_pegawai_list->renderRow();
while ($m_pegawai_list->RecordCount < $m_pegawai_list->StopRecord) {
	$m_pegawai_list->RecordCount++;
	if ($m_pegawai_list->RecordCount >= $m_pegawai_list->StartRecord) {
		$m_pegawai_list->RowCount++;

		// Set up key count
		$m_pegawai_list->KeyCount = $m_pegawai_list->RowIndex;

		// Init row class and style
		$m_pegawai->resetAttributes();
		$m_pegawai->CssClass = "";
		if ($m_pegawai_list->isGridAdd()) {
		} else {
			$m_pegawai_list->loadRowValues($m_pegawai_list->Recordset); // Load row values
		}
		$m_pegawai->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_pegawai->RowAttrs->merge(["data-rowindex" => $m_pegawai_list->RowCount, "id" => "r" . $m_pegawai_list->RowCount . "_m_pegawai", "data-rowtype" => $m_pegawai->RowType]);

		// Render row
		$m_pegawai_list->renderRow();

		// Render list options
		$m_pegawai_list->renderListOptions();
?>
	<tr <?php echo $m_pegawai->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_pegawai_list->ListOptions->render("body", "left", $m_pegawai_list->RowCount);
?>
	<?php if ($m_pegawai_list->id_pegawai->Visible) { // id_pegawai ?>
		<td data-name="id_pegawai" <?php echo $m_pegawai_list->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_id_pegawai">
<span<?php echo $m_pegawai_list->id_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->id_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->nama_pegawai->Visible) { // nama_pegawai ?>
		<td data-name="nama_pegawai" <?php echo $m_pegawai_list->nama_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_nama_pegawai">
<span<?php echo $m_pegawai_list->nama_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->nama_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->nama_lengkap->Visible) { // nama_lengkap ?>
		<td data-name="nama_lengkap" <?php echo $m_pegawai_list->nama_lengkap->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_nama_lengkap">
<span<?php echo $m_pegawai_list->nama_lengkap->viewAttributes() ?>><?php echo $m_pegawai_list->nama_lengkap->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->nik_pegawai->Visible) { // nik_pegawai ?>
		<td data-name="nik_pegawai" <?php echo $m_pegawai_list->nik_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_nik_pegawai">
<span<?php echo $m_pegawai_list->nik_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->nik_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->alamat_pegawai->Visible) { // alamat_pegawai ?>
		<td data-name="alamat_pegawai" <?php echo $m_pegawai_list->alamat_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_alamat_pegawai">
<span<?php echo $m_pegawai_list->alamat_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->alamat_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->hp_pegawai->Visible) { // hp_pegawai ?>
		<td data-name="hp_pegawai" <?php echo $m_pegawai_list->hp_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_hp_pegawai">
<span<?php echo $m_pegawai_list->hp_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->hp_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
		<td data-name="spesialis_pegawai" <?php echo $m_pegawai_list->spesialis_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_spesialis_pegawai">
<span<?php echo $m_pegawai_list->spesialis_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->spesialis_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
		<td data-name="jabatan_pegawai" <?php echo $m_pegawai_list->jabatan_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_jabatan_pegawai">
<span<?php echo $m_pegawai_list->jabatan_pegawai->viewAttributes() ?>><?php echo $m_pegawai_list->jabatan_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_pegawai_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_id_klinik">
<span<?php echo $m_pegawai_list->id_klinik->viewAttributes() ?>><?php echo $m_pegawai_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pegawai_list->nilai_komisi->Visible) { // nilai_komisi ?>
		<td data-name="nilai_komisi" <?php echo $m_pegawai_list->nilai_komisi->cellAttributes() ?>>
<span id="el<?php echo $m_pegawai_list->RowCount ?>_m_pegawai_nilai_komisi">
<span<?php echo $m_pegawai_list->nilai_komisi->viewAttributes() ?>><?php echo $m_pegawai_list->nilai_komisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_pegawai_list->ListOptions->render("body", "right", $m_pegawai_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_pegawai_list->isGridAdd())
		$m_pegawai_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_pegawai->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_pegawai_list->Recordset)
	$m_pegawai_list->Recordset->Close();
?>
<?php if (!$m_pegawai_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_pegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_pegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_pegawai_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_pegawai_list->TotalRecords == 0 && !$m_pegawai->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_pegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_pegawai_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_pegawai_list->isExport()) { ?>
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
$m_pegawai_list->terminate();
?>