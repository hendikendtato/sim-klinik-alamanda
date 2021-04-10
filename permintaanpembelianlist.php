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
$permintaanpembelian_list = new permintaanpembelian_list();

// Run the page
$permintaanpembelian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$permintaanpembelian_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$permintaanpembelian_list->isExport()) { ?>
<script>
var fpermintaanpembelianlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpermintaanpembelianlist = currentForm = new ew.Form("fpermintaanpembelianlist", "list");
	fpermintaanpembelianlist.formKeyCountName = '<?php echo $permintaanpembelian_list->FormKeyCountName ?>';
	loadjs.done("fpermintaanpembelianlist");
});
var fpermintaanpembelianlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpermintaanpembelianlistsrch = currentSearchForm = new ew.Form("fpermintaanpembelianlistsrch");

	// Dynamic selection lists
	// Filters

	fpermintaanpembelianlistsrch.filterList = <?php echo $permintaanpembelian_list->getFilterList() ?>;
	loadjs.done("fpermintaanpembelianlistsrch");
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
<?php if (!$permintaanpembelian_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($permintaanpembelian_list->TotalRecords > 0 && $permintaanpembelian_list->ExportOptions->visible()) { ?>
<?php $permintaanpembelian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($permintaanpembelian_list->ImportOptions->visible()) { ?>
<?php $permintaanpembelian_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($permintaanpembelian_list->SearchOptions->visible()) { ?>
<?php $permintaanpembelian_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($permintaanpembelian_list->FilterOptions->visible()) { ?>
<?php $permintaanpembelian_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$permintaanpembelian_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$permintaanpembelian_list->isExport() && !$permintaanpembelian->CurrentAction) { ?>
<form name="fpermintaanpembelianlistsrch" id="fpermintaanpembelianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpermintaanpembelianlistsrch-search-panel" class="<?php echo $permintaanpembelian_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="permintaanpembelian">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $permintaanpembelian_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($permintaanpembelian_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($permintaanpembelian_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $permintaanpembelian_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($permintaanpembelian_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($permintaanpembelian_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($permintaanpembelian_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($permintaanpembelian_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $permintaanpembelian_list->showPageHeader(); ?>
<?php
$permintaanpembelian_list->showMessage();
?>
<?php if ($permintaanpembelian_list->TotalRecords > 0 || $permintaanpembelian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($permintaanpembelian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> permintaanpembelian">
<?php if (!$permintaanpembelian_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$permintaanpembelian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $permintaanpembelian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $permintaanpembelian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpermintaanpembelianlist" id="fpermintaanpembelianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="permintaanpembelian">
<div id="gmp_permintaanpembelian" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($permintaanpembelian_list->TotalRecords > 0 || $permintaanpembelian_list->isGridEdit()) { ?>
<table id="tbl_permintaanpembelianlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$permintaanpembelian->RowType = ROWTYPE_HEADER;

// Render list options
$permintaanpembelian_list->renderListOptions();

// Render list options (header, left)
$permintaanpembelian_list->ListOptions->render("header", "left");
?>
<?php if ($permintaanpembelian_list->id_pp->Visible) { // id_pp ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->id_pp) == "") { ?>
		<th data-name="id_pp" class="<?php echo $permintaanpembelian_list->id_pp->headerCellClass() ?>"><div id="elh_permintaanpembelian_id_pp" class="permintaanpembelian_id_pp"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->id_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pp" class="<?php echo $permintaanpembelian_list->id_pp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->id_pp) ?>', 1);"><div id="elh_permintaanpembelian_id_pp" class="permintaanpembelian_id_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->id_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->id_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->id_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->no_pp->Visible) { // no_pp ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->no_pp) == "") { ?>
		<th data-name="no_pp" class="<?php echo $permintaanpembelian_list->no_pp->headerCellClass() ?>"><div id="elh_permintaanpembelian_no_pp" class="permintaanpembelian_no_pp"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->no_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_pp" class="<?php echo $permintaanpembelian_list->no_pp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->no_pp) ?>', 1);"><div id="elh_permintaanpembelian_no_pp" class="permintaanpembelian_no_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->no_pp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->no_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->no_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->namapaket_pp->Visible) { // namapaket_pp ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->namapaket_pp) == "") { ?>
		<th data-name="namapaket_pp" class="<?php echo $permintaanpembelian_list->namapaket_pp->headerCellClass() ?>"><div id="elh_permintaanpembelian_namapaket_pp" class="permintaanpembelian_namapaket_pp"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->namapaket_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namapaket_pp" class="<?php echo $permintaanpembelian_list->namapaket_pp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->namapaket_pp) ?>', 1);"><div id="elh_permintaanpembelian_namapaket_pp" class="permintaanpembelian_namapaket_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->namapaket_pp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->namapaket_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->namapaket_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->tgl_pp->Visible) { // tgl_pp ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->tgl_pp) == "") { ?>
		<th data-name="tgl_pp" class="<?php echo $permintaanpembelian_list->tgl_pp->headerCellClass() ?>"><div id="elh_permintaanpembelian_tgl_pp" class="permintaanpembelian_tgl_pp"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->tgl_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_pp" class="<?php echo $permintaanpembelian_list->tgl_pp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->tgl_pp) ?>', 1);"><div id="elh_permintaanpembelian_tgl_pp" class="permintaanpembelian_tgl_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->tgl_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->tgl_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->tgl_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->tgl_kebutuhan) == "") { ?>
		<th data-name="tgl_kebutuhan" class="<?php echo $permintaanpembelian_list->tgl_kebutuhan->headerCellClass() ?>"><div id="elh_permintaanpembelian_tgl_kebutuhan" class="permintaanpembelian_tgl_kebutuhan"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->tgl_kebutuhan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_kebutuhan" class="<?php echo $permintaanpembelian_list->tgl_kebutuhan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->tgl_kebutuhan) ?>', 1);"><div id="elh_permintaanpembelian_tgl_kebutuhan" class="permintaanpembelian_tgl_kebutuhan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->tgl_kebutuhan->caption() ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->tgl_kebutuhan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->tgl_kebutuhan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->tgl_persetujuan) == "") { ?>
		<th data-name="tgl_persetujuan" class="<?php echo $permintaanpembelian_list->tgl_persetujuan->headerCellClass() ?>"><div id="elh_permintaanpembelian_tgl_persetujuan" class="permintaanpembelian_tgl_persetujuan"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->tgl_persetujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_persetujuan" class="<?php echo $permintaanpembelian_list->tgl_persetujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->tgl_persetujuan) ?>', 1);"><div id="elh_permintaanpembelian_tgl_persetujuan" class="permintaanpembelian_tgl_persetujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->tgl_persetujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->tgl_persetujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->tgl_persetujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->staf_pengajuan->Visible) { // staf_pengajuan ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->staf_pengajuan) == "") { ?>
		<th data-name="staf_pengajuan" class="<?php echo $permintaanpembelian_list->staf_pengajuan->headerCellClass() ?>"><div id="elh_permintaanpembelian_staf_pengajuan" class="permintaanpembelian_staf_pengajuan"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->staf_pengajuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="staf_pengajuan" class="<?php echo $permintaanpembelian_list->staf_pengajuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->staf_pengajuan) ?>', 1);"><div id="elh_permintaanpembelian_staf_pengajuan" class="permintaanpembelian_staf_pengajuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->staf_pengajuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->staf_pengajuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->staf_pengajuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($permintaanpembelian_list->staf_validasi->Visible) { // staf_validasi ?>
	<?php if ($permintaanpembelian_list->SortUrl($permintaanpembelian_list->staf_validasi) == "") { ?>
		<th data-name="staf_validasi" class="<?php echo $permintaanpembelian_list->staf_validasi->headerCellClass() ?>"><div id="elh_permintaanpembelian_staf_validasi" class="permintaanpembelian_staf_validasi"><div class="ew-table-header-caption"><?php echo $permintaanpembelian_list->staf_validasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="staf_validasi" class="<?php echo $permintaanpembelian_list->staf_validasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $permintaanpembelian_list->SortUrl($permintaanpembelian_list->staf_validasi) ?>', 1);"><div id="elh_permintaanpembelian_staf_validasi" class="permintaanpembelian_staf_validasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $permintaanpembelian_list->staf_validasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($permintaanpembelian_list->staf_validasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($permintaanpembelian_list->staf_validasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$permintaanpembelian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($permintaanpembelian_list->ExportAll && $permintaanpembelian_list->isExport()) {
	$permintaanpembelian_list->StopRecord = $permintaanpembelian_list->TotalRecords;
} else {

	// Set the last record to display
	if ($permintaanpembelian_list->TotalRecords > $permintaanpembelian_list->StartRecord + $permintaanpembelian_list->DisplayRecords - 1)
		$permintaanpembelian_list->StopRecord = $permintaanpembelian_list->StartRecord + $permintaanpembelian_list->DisplayRecords - 1;
	else
		$permintaanpembelian_list->StopRecord = $permintaanpembelian_list->TotalRecords;
}
$permintaanpembelian_list->RecordCount = $permintaanpembelian_list->StartRecord - 1;
if ($permintaanpembelian_list->Recordset && !$permintaanpembelian_list->Recordset->EOF) {
	$permintaanpembelian_list->Recordset->moveFirst();
	$selectLimit = $permintaanpembelian_list->UseSelectLimit;
	if (!$selectLimit && $permintaanpembelian_list->StartRecord > 1)
		$permintaanpembelian_list->Recordset->move($permintaanpembelian_list->StartRecord - 1);
} elseif (!$permintaanpembelian->AllowAddDeleteRow && $permintaanpembelian_list->StopRecord == 0) {
	$permintaanpembelian_list->StopRecord = $permintaanpembelian->GridAddRowCount;
}

// Initialize aggregate
$permintaanpembelian->RowType = ROWTYPE_AGGREGATEINIT;
$permintaanpembelian->resetAttributes();
$permintaanpembelian_list->renderRow();
while ($permintaanpembelian_list->RecordCount < $permintaanpembelian_list->StopRecord) {
	$permintaanpembelian_list->RecordCount++;
	if ($permintaanpembelian_list->RecordCount >= $permintaanpembelian_list->StartRecord) {
		$permintaanpembelian_list->RowCount++;

		// Set up key count
		$permintaanpembelian_list->KeyCount = $permintaanpembelian_list->RowIndex;

		// Init row class and style
		$permintaanpembelian->resetAttributes();
		$permintaanpembelian->CssClass = "";
		if ($permintaanpembelian_list->isGridAdd()) {
		} else {
			$permintaanpembelian_list->loadRowValues($permintaanpembelian_list->Recordset); // Load row values
		}
		$permintaanpembelian->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$permintaanpembelian->RowAttrs->merge(["data-rowindex" => $permintaanpembelian_list->RowCount, "id" => "r" . $permintaanpembelian_list->RowCount . "_permintaanpembelian", "data-rowtype" => $permintaanpembelian->RowType]);

		// Render row
		$permintaanpembelian_list->renderRow();

		// Render list options
		$permintaanpembelian_list->renderListOptions();
?>
	<tr <?php echo $permintaanpembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$permintaanpembelian_list->ListOptions->render("body", "left", $permintaanpembelian_list->RowCount);
?>
	<?php if ($permintaanpembelian_list->id_pp->Visible) { // id_pp ?>
		<td data-name="id_pp" <?php echo $permintaanpembelian_list->id_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_id_pp">
<span<?php echo $permintaanpembelian_list->id_pp->viewAttributes() ?>><?php echo $permintaanpembelian_list->id_pp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->no_pp->Visible) { // no_pp ?>
		<td data-name="no_pp" <?php echo $permintaanpembelian_list->no_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_no_pp">
<span<?php echo $permintaanpembelian_list->no_pp->viewAttributes() ?>><?php echo $permintaanpembelian_list->no_pp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->namapaket_pp->Visible) { // namapaket_pp ?>
		<td data-name="namapaket_pp" <?php echo $permintaanpembelian_list->namapaket_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_namapaket_pp">
<span<?php echo $permintaanpembelian_list->namapaket_pp->viewAttributes() ?>><?php echo $permintaanpembelian_list->namapaket_pp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->tgl_pp->Visible) { // tgl_pp ?>
		<td data-name="tgl_pp" <?php echo $permintaanpembelian_list->tgl_pp->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_tgl_pp">
<span<?php echo $permintaanpembelian_list->tgl_pp->viewAttributes() ?>><?php echo $permintaanpembelian_list->tgl_pp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
		<td data-name="tgl_kebutuhan" <?php echo $permintaanpembelian_list->tgl_kebutuhan->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_tgl_kebutuhan">
<span<?php echo $permintaanpembelian_list->tgl_kebutuhan->viewAttributes() ?>><?php echo $permintaanpembelian_list->tgl_kebutuhan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
		<td data-name="tgl_persetujuan" <?php echo $permintaanpembelian_list->tgl_persetujuan->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_tgl_persetujuan">
<span<?php echo $permintaanpembelian_list->tgl_persetujuan->viewAttributes() ?>><?php echo $permintaanpembelian_list->tgl_persetujuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->staf_pengajuan->Visible) { // staf_pengajuan ?>
		<td data-name="staf_pengajuan" <?php echo $permintaanpembelian_list->staf_pengajuan->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_staf_pengajuan">
<span<?php echo $permintaanpembelian_list->staf_pengajuan->viewAttributes() ?>><?php echo $permintaanpembelian_list->staf_pengajuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($permintaanpembelian_list->staf_validasi->Visible) { // staf_validasi ?>
		<td data-name="staf_validasi" <?php echo $permintaanpembelian_list->staf_validasi->cellAttributes() ?>>
<span id="el<?php echo $permintaanpembelian_list->RowCount ?>_permintaanpembelian_staf_validasi">
<span<?php echo $permintaanpembelian_list->staf_validasi->viewAttributes() ?>><?php echo $permintaanpembelian_list->staf_validasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$permintaanpembelian_list->ListOptions->render("body", "right", $permintaanpembelian_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$permintaanpembelian_list->isGridAdd())
		$permintaanpembelian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$permintaanpembelian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($permintaanpembelian_list->Recordset)
	$permintaanpembelian_list->Recordset->Close();
?>
<?php if (!$permintaanpembelian_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$permintaanpembelian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $permintaanpembelian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $permintaanpembelian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($permintaanpembelian_list->TotalRecords == 0 && !$permintaanpembelian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $permintaanpembelian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$permintaanpembelian_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$permintaanpembelian_list->isExport()) { ?>
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
$permintaanpembelian_list->terminate();
?>