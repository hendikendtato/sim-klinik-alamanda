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
$wp_reservasi_list = new wp_reservasi_list();

// Run the page
$wp_reservasi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$wp_reservasi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$wp_reservasi_list->isExport()) { ?>
<script>
var fwp_reservasilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fwp_reservasilist = currentForm = new ew.Form("fwp_reservasilist", "list");
	fwp_reservasilist.formKeyCountName = '<?php echo $wp_reservasi_list->FormKeyCountName ?>';
	loadjs.done("fwp_reservasilist");
});
var fwp_reservasilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fwp_reservasilistsrch = currentSearchForm = new ew.Form("fwp_reservasilistsrch");

	// Dynamic selection lists
	// Filters

	fwp_reservasilistsrch.filterList = <?php echo $wp_reservasi_list->getFilterList() ?>;
	loadjs.done("fwp_reservasilistsrch");
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
<?php if (!$wp_reservasi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($wp_reservasi_list->TotalRecords > 0 && $wp_reservasi_list->ExportOptions->visible()) { ?>
<?php $wp_reservasi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($wp_reservasi_list->ImportOptions->visible()) { ?>
<?php $wp_reservasi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($wp_reservasi_list->SearchOptions->visible()) { ?>
<?php $wp_reservasi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($wp_reservasi_list->FilterOptions->visible()) { ?>
<?php $wp_reservasi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$wp_reservasi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$wp_reservasi_list->isExport() && !$wp_reservasi->CurrentAction) { ?>
<form name="fwp_reservasilistsrch" id="fwp_reservasilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fwp_reservasilistsrch-search-panel" class="<?php echo $wp_reservasi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="wp_reservasi">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $wp_reservasi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($wp_reservasi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($wp_reservasi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $wp_reservasi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($wp_reservasi_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($wp_reservasi_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($wp_reservasi_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($wp_reservasi_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $wp_reservasi_list->showPageHeader(); ?>
<?php
$wp_reservasi_list->showMessage();
?>
<?php if ($wp_reservasi_list->TotalRecords > 0 || $wp_reservasi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($wp_reservasi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> wp_reservasi">
<?php if (!$wp_reservasi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$wp_reservasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $wp_reservasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $wp_reservasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fwp_reservasilist" id="fwp_reservasilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="wp_reservasi">
<div id="gmp_wp_reservasi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($wp_reservasi_list->TotalRecords > 0 || $wp_reservasi_list->isGridEdit()) { ?>
<table id="tbl_wp_reservasilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$wp_reservasi->RowType = ROWTYPE_HEADER;

// Render list options
$wp_reservasi_list->renderListOptions();

// Render list options (header, left)
$wp_reservasi_list->ListOptions->render("header", "left");
?>
<?php if ($wp_reservasi_list->id->Visible) { // id ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $wp_reservasi_list->id->headerCellClass() ?>"><div id="elh_wp_reservasi_id" class="wp_reservasi_id"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $wp_reservasi_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->id) ?>', 1);"><div id="elh_wp_reservasi_id" class="wp_reservasi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->nama->Visible) { // nama ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $wp_reservasi_list->nama->headerCellClass() ?>"><div id="elh_wp_reservasi_nama" class="wp_reservasi_nama"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $wp_reservasi_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->nama) ?>', 1);"><div id="elh_wp_reservasi_nama" class="wp_reservasi_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->no_telp->Visible) { // no_telp ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->no_telp) == "") { ?>
		<th data-name="no_telp" class="<?php echo $wp_reservasi_list->no_telp->headerCellClass() ?>"><div id="elh_wp_reservasi_no_telp" class="wp_reservasi_no_telp"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->no_telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_telp" class="<?php echo $wp_reservasi_list->no_telp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->no_telp) ?>', 1);"><div id="elh_wp_reservasi_no_telp" class="wp_reservasi_no_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->no_telp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->no_telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->no_telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->jenis_perawatan->Visible) { // jenis_perawatan ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->jenis_perawatan) == "") { ?>
		<th data-name="jenis_perawatan" class="<?php echo $wp_reservasi_list->jenis_perawatan->headerCellClass() ?>"><div id="elh_wp_reservasi_jenis_perawatan" class="wp_reservasi_jenis_perawatan"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->jenis_perawatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_perawatan" class="<?php echo $wp_reservasi_list->jenis_perawatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->jenis_perawatan) ?>', 1);"><div id="elh_wp_reservasi_jenis_perawatan" class="wp_reservasi_jenis_perawatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->jenis_perawatan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->jenis_perawatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->jenis_perawatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $wp_reservasi_list->id_klinik->headerCellClass() ?>"><div id="elh_wp_reservasi_id_klinik" class="wp_reservasi_id_klinik"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $wp_reservasi_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->id_klinik) ?>', 1);"><div id="elh_wp_reservasi_id_klinik" class="wp_reservasi_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->terapis->Visible) { // terapis ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->terapis) == "") { ?>
		<th data-name="terapis" class="<?php echo $wp_reservasi_list->terapis->headerCellClass() ?>"><div id="elh_wp_reservasi_terapis" class="wp_reservasi_terapis"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->terapis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="terapis" class="<?php echo $wp_reservasi_list->terapis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->terapis) ?>', 1);"><div id="elh_wp_reservasi_terapis" class="wp_reservasi_terapis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->terapis->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->terapis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->terapis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->tanggal->Visible) { // tanggal ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $wp_reservasi_list->tanggal->headerCellClass() ?>"><div id="elh_wp_reservasi_tanggal" class="wp_reservasi_tanggal"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $wp_reservasi_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->tanggal) ?>', 1);"><div id="elh_wp_reservasi_tanggal" class="wp_reservasi_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->jam_mulai->Visible) { // jam_mulai ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->jam_mulai) == "") { ?>
		<th data-name="jam_mulai" class="<?php echo $wp_reservasi_list->jam_mulai->headerCellClass() ?>"><div id="elh_wp_reservasi_jam_mulai" class="wp_reservasi_jam_mulai"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->jam_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_mulai" class="<?php echo $wp_reservasi_list->jam_mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->jam_mulai) ?>', 1);"><div id="elh_wp_reservasi_jam_mulai" class="wp_reservasi_jam_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->jam_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->jam_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->jam_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->jam_selesai->Visible) { // jam_selesai ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->jam_selesai) == "") { ?>
		<th data-name="jam_selesai" class="<?php echo $wp_reservasi_list->jam_selesai->headerCellClass() ?>"><div id="elh_wp_reservasi_jam_selesai" class="wp_reservasi_jam_selesai"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->jam_selesai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_selesai" class="<?php echo $wp_reservasi_list->jam_selesai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->jam_selesai) ?>', 1);"><div id="elh_wp_reservasi_jam_selesai" class="wp_reservasi_jam_selesai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->jam_selesai->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->jam_selesai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->jam_selesai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_reservasi_list->status->Visible) { // status ?>
	<?php if ($wp_reservasi_list->SortUrl($wp_reservasi_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $wp_reservasi_list->status->headerCellClass() ?>"><div id="elh_wp_reservasi_status" class="wp_reservasi_status"><div class="ew-table-header-caption"><?php echo $wp_reservasi_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $wp_reservasi_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_reservasi_list->SortUrl($wp_reservasi_list->status) ?>', 1);"><div id="elh_wp_reservasi_status" class="wp_reservasi_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_reservasi_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_reservasi_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_reservasi_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$wp_reservasi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($wp_reservasi_list->ExportAll && $wp_reservasi_list->isExport()) {
	$wp_reservasi_list->StopRecord = $wp_reservasi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($wp_reservasi_list->TotalRecords > $wp_reservasi_list->StartRecord + $wp_reservasi_list->DisplayRecords - 1)
		$wp_reservasi_list->StopRecord = $wp_reservasi_list->StartRecord + $wp_reservasi_list->DisplayRecords - 1;
	else
		$wp_reservasi_list->StopRecord = $wp_reservasi_list->TotalRecords;
}
$wp_reservasi_list->RecordCount = $wp_reservasi_list->StartRecord - 1;
if ($wp_reservasi_list->Recordset && !$wp_reservasi_list->Recordset->EOF) {
	$wp_reservasi_list->Recordset->moveFirst();
	$selectLimit = $wp_reservasi_list->UseSelectLimit;
	if (!$selectLimit && $wp_reservasi_list->StartRecord > 1)
		$wp_reservasi_list->Recordset->move($wp_reservasi_list->StartRecord - 1);
} elseif (!$wp_reservasi->AllowAddDeleteRow && $wp_reservasi_list->StopRecord == 0) {
	$wp_reservasi_list->StopRecord = $wp_reservasi->GridAddRowCount;
}

// Initialize aggregate
$wp_reservasi->RowType = ROWTYPE_AGGREGATEINIT;
$wp_reservasi->resetAttributes();
$wp_reservasi_list->renderRow();
while ($wp_reservasi_list->RecordCount < $wp_reservasi_list->StopRecord) {
	$wp_reservasi_list->RecordCount++;
	if ($wp_reservasi_list->RecordCount >= $wp_reservasi_list->StartRecord) {
		$wp_reservasi_list->RowCount++;

		// Set up key count
		$wp_reservasi_list->KeyCount = $wp_reservasi_list->RowIndex;

		// Init row class and style
		$wp_reservasi->resetAttributes();
		$wp_reservasi->CssClass = "";
		if ($wp_reservasi_list->isGridAdd()) {
		} else {
			$wp_reservasi_list->loadRowValues($wp_reservasi_list->Recordset); // Load row values
		}
		$wp_reservasi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$wp_reservasi->RowAttrs->merge(["data-rowindex" => $wp_reservasi_list->RowCount, "id" => "r" . $wp_reservasi_list->RowCount . "_wp_reservasi", "data-rowtype" => $wp_reservasi->RowType]);

		// Render row
		$wp_reservasi_list->renderRow();

		// Render list options
		$wp_reservasi_list->renderListOptions();
?>
	<tr <?php echo $wp_reservasi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$wp_reservasi_list->ListOptions->render("body", "left", $wp_reservasi_list->RowCount);
?>
	<?php if ($wp_reservasi_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $wp_reservasi_list->id->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_id">
<span<?php echo $wp_reservasi_list->id->viewAttributes() ?>><?php echo $wp_reservasi_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $wp_reservasi_list->nama->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_nama">
<span<?php echo $wp_reservasi_list->nama->viewAttributes() ?>><?php echo $wp_reservasi_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->no_telp->Visible) { // no_telp ?>
		<td data-name="no_telp" <?php echo $wp_reservasi_list->no_telp->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_no_telp">
<span<?php echo $wp_reservasi_list->no_telp->viewAttributes() ?>><?php echo $wp_reservasi_list->no_telp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->jenis_perawatan->Visible) { // jenis_perawatan ?>
		<td data-name="jenis_perawatan" <?php echo $wp_reservasi_list->jenis_perawatan->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_jenis_perawatan">
<span<?php echo $wp_reservasi_list->jenis_perawatan->viewAttributes() ?>><?php echo $wp_reservasi_list->jenis_perawatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $wp_reservasi_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_id_klinik">
<span<?php echo $wp_reservasi_list->id_klinik->viewAttributes() ?>><?php echo $wp_reservasi_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->terapis->Visible) { // terapis ?>
		<td data-name="terapis" <?php echo $wp_reservasi_list->terapis->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_terapis">
<span<?php echo $wp_reservasi_list->terapis->viewAttributes() ?>><?php echo $wp_reservasi_list->terapis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $wp_reservasi_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_tanggal">
<span<?php echo $wp_reservasi_list->tanggal->viewAttributes() ?>><?php echo $wp_reservasi_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->jam_mulai->Visible) { // jam_mulai ?>
		<td data-name="jam_mulai" <?php echo $wp_reservasi_list->jam_mulai->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_jam_mulai">
<span<?php echo $wp_reservasi_list->jam_mulai->viewAttributes() ?>><?php echo $wp_reservasi_list->jam_mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->jam_selesai->Visible) { // jam_selesai ?>
		<td data-name="jam_selesai" <?php echo $wp_reservasi_list->jam_selesai->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_jam_selesai">
<span<?php echo $wp_reservasi_list->jam_selesai->viewAttributes() ?>><?php echo $wp_reservasi_list->jam_selesai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_reservasi_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $wp_reservasi_list->status->cellAttributes() ?>>
<span id="el<?php echo $wp_reservasi_list->RowCount ?>_wp_reservasi_status">
<span<?php echo $wp_reservasi_list->status->viewAttributes() ?>><?php echo $wp_reservasi_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$wp_reservasi_list->ListOptions->render("body", "right", $wp_reservasi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$wp_reservasi_list->isGridAdd())
		$wp_reservasi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$wp_reservasi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($wp_reservasi_list->Recordset)
	$wp_reservasi_list->Recordset->Close();
?>
<?php if (!$wp_reservasi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$wp_reservasi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $wp_reservasi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $wp_reservasi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($wp_reservasi_list->TotalRecords == 0 && !$wp_reservasi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $wp_reservasi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$wp_reservasi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$wp_reservasi_list->isExport()) { ?>
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
$wp_reservasi_list->terminate();
?>