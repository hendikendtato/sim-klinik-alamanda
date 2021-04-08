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
$kartupoin_list = new kartupoin_list();

// Run the page
$kartupoin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartupoin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kartupoin_list->isExport()) { ?>
<script>
var fkartupoinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkartupoinlist = currentForm = new ew.Form("fkartupoinlist", "list");
	fkartupoinlist.formKeyCountName = '<?php echo $kartupoin_list->FormKeyCountName ?>';
	loadjs.done("fkartupoinlist");
});
var fkartupoinlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkartupoinlistsrch = currentSearchForm = new ew.Form("fkartupoinlistsrch");

	// Dynamic selection lists
	// Filters

	fkartupoinlistsrch.filterList = <?php echo $kartupoin_list->getFilterList() ?>;
	loadjs.done("fkartupoinlistsrch");
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
<?php if (!$kartupoin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kartupoin_list->TotalRecords > 0 && $kartupoin_list->ExportOptions->visible()) { ?>
<?php $kartupoin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kartupoin_list->ImportOptions->visible()) { ?>
<?php $kartupoin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kartupoin_list->SearchOptions->visible()) { ?>
<?php $kartupoin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kartupoin_list->FilterOptions->visible()) { ?>
<?php $kartupoin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kartupoin_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kartupoin_list->isExport() && !$kartupoin->CurrentAction) { ?>
<form name="fkartupoinlistsrch" id="fkartupoinlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkartupoinlistsrch-search-panel" class="<?php echo $kartupoin_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kartupoin">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kartupoin_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kartupoin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kartupoin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kartupoin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kartupoin_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kartupoin_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kartupoin_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kartupoin_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kartupoin_list->showPageHeader(); ?>
<?php
$kartupoin_list->showMessage();
?>
<?php if ($kartupoin_list->TotalRecords > 0 || $kartupoin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kartupoin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kartupoin">
<?php if (!$kartupoin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kartupoin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kartupoin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kartupoin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkartupoinlist" id="fkartupoinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartupoin">
<div id="gmp_kartupoin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kartupoin_list->TotalRecords > 0 || $kartupoin_list->isGridEdit()) { ?>
<table id="tbl_kartupoinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kartupoin->RowType = ROWTYPE_HEADER;

// Render list options
$kartupoin_list->renderListOptions();

// Render list options (header, left)
$kartupoin_list->ListOptions->render("header", "left");
?>
<?php if ($kartupoin_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $kartupoin_list->id_pelanggan->headerCellClass() ?>"><div id="elh_kartupoin_id_pelanggan" class="kartupoin_id_pelanggan"><div class="ew-table-header-caption"><?php echo $kartupoin_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $kartupoin_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->id_pelanggan) ?>', 1);"><div id="elh_kartupoin_id_pelanggan" class="kartupoin_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $kartupoin_list->id_klinik->headerCellClass() ?>"><div id="elh_kartupoin_id_klinik" class="kartupoin_id_klinik"><div class="ew-table-header-caption"><?php echo $kartupoin_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $kartupoin_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->id_klinik) ?>', 1);"><div id="elh_kartupoin_id_klinik" class="kartupoin_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->kode_penjualan->Visible) { // kode_penjualan ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->kode_penjualan) == "") { ?>
		<th data-name="kode_penjualan" class="<?php echo $kartupoin_list->kode_penjualan->headerCellClass() ?>"><div id="elh_kartupoin_kode_penjualan" class="kartupoin_kode_penjualan"><div class="ew-table-header-caption"><?php echo $kartupoin_list->kode_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penjualan" class="<?php echo $kartupoin_list->kode_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->kode_penjualan) ?>', 1);"><div id="elh_kartupoin_kode_penjualan" class="kartupoin_kode_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->kode_penjualan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->kode_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->kode_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->id_penyesuaian_poin) == "") { ?>
		<th data-name="id_penyesuaian_poin" class="<?php echo $kartupoin_list->id_penyesuaian_poin->headerCellClass() ?>"><div id="elh_kartupoin_id_penyesuaian_poin" class="kartupoin_id_penyesuaian_poin"><div class="ew-table-header-caption"><?php echo $kartupoin_list->id_penyesuaian_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penyesuaian_poin" class="<?php echo $kartupoin_list->id_penyesuaian_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->id_penyesuaian_poin) ?>', 1);"><div id="elh_kartupoin_id_penyesuaian_poin" class="kartupoin_id_penyesuaian_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->id_penyesuaian_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->id_penyesuaian_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->id_penyesuaian_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->tgl->Visible) { // tgl ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $kartupoin_list->tgl->headerCellClass() ?>"><div id="elh_kartupoin_tgl" class="kartupoin_tgl"><div class="ew-table-header-caption"><?php echo $kartupoin_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $kartupoin_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->tgl) ?>', 1);"><div id="elh_kartupoin_tgl" class="kartupoin_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->masuk->Visible) { // masuk ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->masuk) == "") { ?>
		<th data-name="masuk" class="<?php echo $kartupoin_list->masuk->headerCellClass() ?>"><div id="elh_kartupoin_masuk" class="kartupoin_masuk"><div class="ew-table-header-caption"><?php echo $kartupoin_list->masuk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk" class="<?php echo $kartupoin_list->masuk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->masuk) ?>', 1);"><div id="elh_kartupoin_masuk" class="kartupoin_masuk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->masuk->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->masuk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->masuk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->masuk_penyesuaian) == "") { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $kartupoin_list->masuk_penyesuaian->headerCellClass() ?>"><div id="elh_kartupoin_masuk_penyesuaian" class="kartupoin_masuk_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartupoin_list->masuk_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $kartupoin_list->masuk_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->masuk_penyesuaian) ?>', 1);"><div id="elh_kartupoin_masuk_penyesuaian" class="kartupoin_masuk_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->masuk_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->masuk_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->masuk_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->keluar->Visible) { // keluar ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->keluar) == "") { ?>
		<th data-name="keluar" class="<?php echo $kartupoin_list->keluar->headerCellClass() ?>"><div id="elh_kartupoin_keluar" class="kartupoin_keluar"><div class="ew-table-header-caption"><?php echo $kartupoin_list->keluar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar" class="<?php echo $kartupoin_list->keluar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->keluar) ?>', 1);"><div id="elh_kartupoin_keluar" class="kartupoin_keluar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->keluar->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->keluar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->keluar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->keluar_penyesuaian) == "") { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $kartupoin_list->keluar_penyesuaian->headerCellClass() ?>"><div id="elh_kartupoin_keluar_penyesuaian" class="kartupoin_keluar_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartupoin_list->keluar_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $kartupoin_list->keluar_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->keluar_penyesuaian) ?>', 1);"><div id="elh_kartupoin_keluar_penyesuaian" class="kartupoin_keluar_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->keluar_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->keluar_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->keluar_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartupoin_list->saldo_poin->Visible) { // saldo_poin ?>
	<?php if ($kartupoin_list->SortUrl($kartupoin_list->saldo_poin) == "") { ?>
		<th data-name="saldo_poin" class="<?php echo $kartupoin_list->saldo_poin->headerCellClass() ?>"><div id="elh_kartupoin_saldo_poin" class="kartupoin_saldo_poin"><div class="ew-table-header-caption"><?php echo $kartupoin_list->saldo_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="saldo_poin" class="<?php echo $kartupoin_list->saldo_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kartupoin_list->SortUrl($kartupoin_list->saldo_poin) ?>', 1);"><div id="elh_kartupoin_saldo_poin" class="kartupoin_saldo_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartupoin_list->saldo_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartupoin_list->saldo_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartupoin_list->saldo_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kartupoin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kartupoin_list->ExportAll && $kartupoin_list->isExport()) {
	$kartupoin_list->StopRecord = $kartupoin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kartupoin_list->TotalRecords > $kartupoin_list->StartRecord + $kartupoin_list->DisplayRecords - 1)
		$kartupoin_list->StopRecord = $kartupoin_list->StartRecord + $kartupoin_list->DisplayRecords - 1;
	else
		$kartupoin_list->StopRecord = $kartupoin_list->TotalRecords;
}
$kartupoin_list->RecordCount = $kartupoin_list->StartRecord - 1;
if ($kartupoin_list->Recordset && !$kartupoin_list->Recordset->EOF) {
	$kartupoin_list->Recordset->moveFirst();
	$selectLimit = $kartupoin_list->UseSelectLimit;
	if (!$selectLimit && $kartupoin_list->StartRecord > 1)
		$kartupoin_list->Recordset->move($kartupoin_list->StartRecord - 1);
} elseif (!$kartupoin->AllowAddDeleteRow && $kartupoin_list->StopRecord == 0) {
	$kartupoin_list->StopRecord = $kartupoin->GridAddRowCount;
}

// Initialize aggregate
$kartupoin->RowType = ROWTYPE_AGGREGATEINIT;
$kartupoin->resetAttributes();
$kartupoin_list->renderRow();
while ($kartupoin_list->RecordCount < $kartupoin_list->StopRecord) {
	$kartupoin_list->RecordCount++;
	if ($kartupoin_list->RecordCount >= $kartupoin_list->StartRecord) {
		$kartupoin_list->RowCount++;

		// Set up key count
		$kartupoin_list->KeyCount = $kartupoin_list->RowIndex;

		// Init row class and style
		$kartupoin->resetAttributes();
		$kartupoin->CssClass = "";
		if ($kartupoin_list->isGridAdd()) {
		} else {
			$kartupoin_list->loadRowValues($kartupoin_list->Recordset); // Load row values
		}
		$kartupoin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kartupoin->RowAttrs->merge(["data-rowindex" => $kartupoin_list->RowCount, "id" => "r" . $kartupoin_list->RowCount . "_kartupoin", "data-rowtype" => $kartupoin->RowType]);

		// Render row
		$kartupoin_list->renderRow();

		// Render list options
		$kartupoin_list->renderListOptions();
?>
	<tr <?php echo $kartupoin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kartupoin_list->ListOptions->render("body", "left", $kartupoin_list->RowCount);
?>
	<?php if ($kartupoin_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $kartupoin_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_id_pelanggan">
<span<?php echo $kartupoin_list->id_pelanggan->viewAttributes() ?>><?php echo $kartupoin_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $kartupoin_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_id_klinik">
<span<?php echo $kartupoin_list->id_klinik->viewAttributes() ?>><?php echo $kartupoin_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->kode_penjualan->Visible) { // kode_penjualan ?>
		<td data-name="kode_penjualan" <?php echo $kartupoin_list->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_kode_penjualan">
<span<?php echo $kartupoin_list->kode_penjualan->viewAttributes() ?>><?php echo $kartupoin_list->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
		<td data-name="id_penyesuaian_poin" <?php echo $kartupoin_list->id_penyesuaian_poin->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_id_penyesuaian_poin">
<span<?php echo $kartupoin_list->id_penyesuaian_poin->viewAttributes() ?>><?php echo $kartupoin_list->id_penyesuaian_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $kartupoin_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_tgl">
<span<?php echo $kartupoin_list->tgl->viewAttributes() ?>><?php echo $kartupoin_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->masuk->Visible) { // masuk ?>
		<td data-name="masuk" <?php echo $kartupoin_list->masuk->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_masuk">
<span<?php echo $kartupoin_list->masuk->viewAttributes() ?>><?php echo $kartupoin_list->masuk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td data-name="masuk_penyesuaian" <?php echo $kartupoin_list->masuk_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_masuk_penyesuaian">
<span<?php echo $kartupoin_list->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartupoin_list->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->keluar->Visible) { // keluar ?>
		<td data-name="keluar" <?php echo $kartupoin_list->keluar->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_keluar">
<span<?php echo $kartupoin_list->keluar->viewAttributes() ?>><?php echo $kartupoin_list->keluar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td data-name="keluar_penyesuaian" <?php echo $kartupoin_list->keluar_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_keluar_penyesuaian">
<span<?php echo $kartupoin_list->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartupoin_list->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kartupoin_list->saldo_poin->Visible) { // saldo_poin ?>
		<td data-name="saldo_poin" <?php echo $kartupoin_list->saldo_poin->cellAttributes() ?>>
<span id="el<?php echo $kartupoin_list->RowCount ?>_kartupoin_saldo_poin">
<span<?php echo $kartupoin_list->saldo_poin->viewAttributes() ?>><?php echo $kartupoin_list->saldo_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kartupoin_list->ListOptions->render("body", "right", $kartupoin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kartupoin_list->isGridAdd())
		$kartupoin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kartupoin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kartupoin_list->Recordset)
	$kartupoin_list->Recordset->Close();
?>
<?php if (!$kartupoin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kartupoin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kartupoin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kartupoin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kartupoin_list->TotalRecords == 0 && !$kartupoin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kartupoin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kartupoin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kartupoin_list->isExport()) { ?>
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
$kartupoin_list->terminate();
?>