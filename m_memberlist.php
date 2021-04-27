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
$m_member_list = new m_member_list();

// Run the page
$m_member_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_member_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_member_list->isExport()) { ?>
<script>
var fm_memberlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_memberlist = currentForm = new ew.Form("fm_memberlist", "list");
	fm_memberlist.formKeyCountName = '<?php echo $m_member_list->FormKeyCountName ?>';
	loadjs.done("fm_memberlist");
});
var fm_memberlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_memberlistsrch = currentSearchForm = new ew.Form("fm_memberlistsrch");

	// Dynamic selection lists
	// Filters

	fm_memberlistsrch.filterList = <?php echo $m_member_list->getFilterList() ?>;
	loadjs.done("fm_memberlistsrch");
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
<?php if (!$m_member_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_member_list->TotalRecords > 0 && $m_member_list->ExportOptions->visible()) { ?>
<?php $m_member_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_member_list->ImportOptions->visible()) { ?>
<?php $m_member_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_member_list->SearchOptions->visible()) { ?>
<?php $m_member_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_member_list->FilterOptions->visible()) { ?>
<?php $m_member_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_member_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_member_list->isExport() && !$m_member->CurrentAction) { ?>
<form name="fm_memberlistsrch" id="fm_memberlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_memberlistsrch-search-panel" class="<?php echo $m_member_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_member">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_member_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_member_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_member_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_member_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_member_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_member_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_member_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_member_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_member_list->showPageHeader(); ?>
<?php
$m_member_list->showMessage();
?>
<?php if ($m_member_list->TotalRecords > 0 || $m_member->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_member_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_member">
<?php if (!$m_member_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_member_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_member_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_member_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_memberlist" id="fm_memberlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_member">
<div id="gmp_m_member" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_member_list->TotalRecords > 0 || $m_member_list->isGridEdit()) { ?>
<table id="tbl_m_memberlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_member->RowType = ROWTYPE_HEADER;

// Render list options
$m_member_list->renderListOptions();

// Render list options (header, left)
$m_member_list->ListOptions->render("header", "left");
?>
<?php if ($m_member_list->kode_member->Visible) { // kode_member ?>
	<?php if ($m_member_list->SortUrl($m_member_list->kode_member) == "") { ?>
		<th data-name="kode_member" class="<?php echo $m_member_list->kode_member->headerCellClass() ?>"><div id="elh_m_member_kode_member" class="m_member_kode_member"><div class="ew-table-header-caption"><?php echo $m_member_list->kode_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_member" class="<?php echo $m_member_list->kode_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->kode_member) ?>', 1);"><div id="elh_m_member_kode_member" class="m_member_kode_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->kode_member->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->kode_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->kode_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_member_list->SortUrl($m_member_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_member_list->id_klinik->headerCellClass() ?>"><div id="elh_m_member_id_klinik" class="m_member_id_klinik"><div class="ew-table-header-caption"><?php echo $m_member_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_member_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->id_klinik) ?>', 1);"><div id="elh_m_member_id_klinik" class="m_member_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($m_member_list->SortUrl($m_member_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $m_member_list->id_pelanggan->headerCellClass() ?>"><div id="elh_m_member_id_pelanggan" class="m_member_id_pelanggan"><div class="ew-table-header-caption"><?php echo $m_member_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $m_member_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->id_pelanggan) ?>', 1);"><div id="elh_m_member_id_pelanggan" class="m_member_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->jenis_member->Visible) { // jenis_member ?>
	<?php if ($m_member_list->SortUrl($m_member_list->jenis_member) == "") { ?>
		<th data-name="jenis_member" class="<?php echo $m_member_list->jenis_member->headerCellClass() ?>"><div id="elh_m_member_jenis_member" class="m_member_jenis_member"><div class="ew-table-header-caption"><?php echo $m_member_list->jenis_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_member" class="<?php echo $m_member_list->jenis_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->jenis_member) ?>', 1);"><div id="elh_m_member_jenis_member" class="m_member_jenis_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->jenis_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->jenis_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->jenis_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->tgl_mulai->Visible) { // tgl_mulai ?>
	<?php if ($m_member_list->SortUrl($m_member_list->tgl_mulai) == "") { ?>
		<th data-name="tgl_mulai" class="<?php echo $m_member_list->tgl_mulai->headerCellClass() ?>"><div id="elh_m_member_tgl_mulai" class="m_member_tgl_mulai"><div class="ew-table-header-caption"><?php echo $m_member_list->tgl_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_mulai" class="<?php echo $m_member_list->tgl_mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->tgl_mulai) ?>', 1);"><div id="elh_m_member_tgl_mulai" class="m_member_tgl_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->tgl_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->tgl_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->tgl_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($m_member_list->SortUrl($m_member_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_member_list->tgl_akhir->headerCellClass() ?>"><div id="elh_m_member_tgl_akhir" class="m_member_tgl_akhir"><div class="ew-table-header-caption"><?php echo $m_member_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_member_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->tgl_akhir) ?>', 1);"><div id="elh_m_member_tgl_akhir" class="m_member_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->poin_member->Visible) { // poin_member ?>
	<?php if ($m_member_list->SortUrl($m_member_list->poin_member) == "") { ?>
		<th data-name="poin_member" class="<?php echo $m_member_list->poin_member->headerCellClass() ?>"><div id="elh_m_member_poin_member" class="m_member_poin_member"><div class="ew-table-header-caption"><?php echo $m_member_list->poin_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_member" class="<?php echo $m_member_list->poin_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->poin_member) ?>', 1);"><div id="elh_m_member_poin_member" class="m_member_poin_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->poin_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->poin_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->poin_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
	<?php if ($m_member_list->SortUrl($m_member_list->tgl_awal_transaksi) == "") { ?>
		<th data-name="tgl_awal_transaksi" class="<?php echo $m_member_list->tgl_awal_transaksi->headerCellClass() ?>"><div id="elh_m_member_tgl_awal_transaksi" class="m_member_tgl_awal_transaksi"><div class="ew-table-header-caption"><?php echo $m_member_list->tgl_awal_transaksi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_awal_transaksi" class="<?php echo $m_member_list->tgl_awal_transaksi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->tgl_awal_transaksi) ?>', 1);"><div id="elh_m_member_tgl_awal_transaksi" class="m_member_tgl_awal_transaksi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->tgl_awal_transaksi->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->tgl_awal_transaksi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->tgl_awal_transaksi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_member_list->total_akumulasi->Visible) { // total_akumulasi ?>
	<?php if ($m_member_list->SortUrl($m_member_list->total_akumulasi) == "") { ?>
		<th data-name="total_akumulasi" class="<?php echo $m_member_list->total_akumulasi->headerCellClass() ?>"><div id="elh_m_member_total_akumulasi" class="m_member_total_akumulasi"><div class="ew-table-header-caption"><?php echo $m_member_list->total_akumulasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_akumulasi" class="<?php echo $m_member_list->total_akumulasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_member_list->SortUrl($m_member_list->total_akumulasi) ?>', 1);"><div id="elh_m_member_total_akumulasi" class="m_member_total_akumulasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_member_list->total_akumulasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_member_list->total_akumulasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_member_list->total_akumulasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_member_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_member_list->ExportAll && $m_member_list->isExport()) {
	$m_member_list->StopRecord = $m_member_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_member_list->TotalRecords > $m_member_list->StartRecord + $m_member_list->DisplayRecords - 1)
		$m_member_list->StopRecord = $m_member_list->StartRecord + $m_member_list->DisplayRecords - 1;
	else
		$m_member_list->StopRecord = $m_member_list->TotalRecords;
}
$m_member_list->RecordCount = $m_member_list->StartRecord - 1;
if ($m_member_list->Recordset && !$m_member_list->Recordset->EOF) {
	$m_member_list->Recordset->moveFirst();
	$selectLimit = $m_member_list->UseSelectLimit;
	if (!$selectLimit && $m_member_list->StartRecord > 1)
		$m_member_list->Recordset->move($m_member_list->StartRecord - 1);
} elseif (!$m_member->AllowAddDeleteRow && $m_member_list->StopRecord == 0) {
	$m_member_list->StopRecord = $m_member->GridAddRowCount;
}

// Initialize aggregate
$m_member->RowType = ROWTYPE_AGGREGATEINIT;
$m_member->resetAttributes();
$m_member_list->renderRow();
while ($m_member_list->RecordCount < $m_member_list->StopRecord) {
	$m_member_list->RecordCount++;
	if ($m_member_list->RecordCount >= $m_member_list->StartRecord) {
		$m_member_list->RowCount++;

		// Set up key count
		$m_member_list->KeyCount = $m_member_list->RowIndex;

		// Init row class and style
		$m_member->resetAttributes();
		$m_member->CssClass = "";
		if ($m_member_list->isGridAdd()) {
		} else {
			$m_member_list->loadRowValues($m_member_list->Recordset); // Load row values
		}
		$m_member->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_member->RowAttrs->merge(["data-rowindex" => $m_member_list->RowCount, "id" => "r" . $m_member_list->RowCount . "_m_member", "data-rowtype" => $m_member->RowType]);

		// Render row
		$m_member_list->renderRow();

		// Render list options
		$m_member_list->renderListOptions();
?>
	<tr <?php echo $m_member->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_member_list->ListOptions->render("body", "left", $m_member_list->RowCount);
?>
	<?php if ($m_member_list->kode_member->Visible) { // kode_member ?>
		<td data-name="kode_member" <?php echo $m_member_list->kode_member->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_kode_member">
<span<?php echo $m_member_list->kode_member->viewAttributes() ?>><?php echo $m_member_list->kode_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_member_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_id_klinik">
<span<?php echo $m_member_list->id_klinik->viewAttributes() ?>><?php echo $m_member_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $m_member_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_id_pelanggan">
<span<?php echo $m_member_list->id_pelanggan->viewAttributes() ?>><?php echo $m_member_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->jenis_member->Visible) { // jenis_member ?>
		<td data-name="jenis_member" <?php echo $m_member_list->jenis_member->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_jenis_member">
<span<?php echo $m_member_list->jenis_member->viewAttributes() ?>><?php echo $m_member_list->jenis_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->tgl_mulai->Visible) { // tgl_mulai ?>
		<td data-name="tgl_mulai" <?php echo $m_member_list->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_tgl_mulai">
<span<?php echo $m_member_list->tgl_mulai->viewAttributes() ?>><?php echo $m_member_list->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $m_member_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_tgl_akhir">
<span<?php echo $m_member_list->tgl_akhir->viewAttributes() ?>><?php echo $m_member_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->poin_member->Visible) { // poin_member ?>
		<td data-name="poin_member" <?php echo $m_member_list->poin_member->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_poin_member">
<span<?php echo $m_member_list->poin_member->viewAttributes() ?>><?php echo $m_member_list->poin_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
		<td data-name="tgl_awal_transaksi" <?php echo $m_member_list->tgl_awal_transaksi->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_tgl_awal_transaksi">
<span<?php echo $m_member_list->tgl_awal_transaksi->viewAttributes() ?>><?php echo $m_member_list->tgl_awal_transaksi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_member_list->total_akumulasi->Visible) { // total_akumulasi ?>
		<td data-name="total_akumulasi" <?php echo $m_member_list->total_akumulasi->cellAttributes() ?>>
<span id="el<?php echo $m_member_list->RowCount ?>_m_member_total_akumulasi">
<span<?php echo $m_member_list->total_akumulasi->viewAttributes() ?>><?php echo $m_member_list->total_akumulasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_member_list->ListOptions->render("body", "right", $m_member_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_member_list->isGridAdd())
		$m_member_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_member->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_member_list->Recordset)
	$m_member_list->Recordset->Close();
?>
<?php if (!$m_member_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_member_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_member_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_member_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_member_list->TotalRecords == 0 && !$m_member->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_member_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_member_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_member_list->isExport()) { ?>
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
$m_member_list->terminate();
?>