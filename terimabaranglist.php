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
$terimabarang_list = new terimabarang_list();

// Run the page
$terimabarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimabarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terimabarang_list->isExport()) { ?>
<script>
var fterimabaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fterimabaranglist = currentForm = new ew.Form("fterimabaranglist", "list");
	fterimabaranglist.formKeyCountName = '<?php echo $terimabarang_list->FormKeyCountName ?>';
	loadjs.done("fterimabaranglist");
});
var fterimabaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fterimabaranglistsrch = currentSearchForm = new ew.Form("fterimabaranglistsrch");

	// Dynamic selection lists
	// Filters

	fterimabaranglistsrch.filterList = <?php echo $terimabarang_list->getFilterList() ?>;
	loadjs.done("fterimabaranglistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","terimabarangadd.php?showdetail=detailterimabarang"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-view").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailterimabarang"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-edit").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailterimabarang"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-copy").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailterimabarang"+t[1]+"="+t[2])});
});
</script>
<?php } ?>
<?php if (!$terimabarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($terimabarang_list->TotalRecords > 0 && $terimabarang_list->ExportOptions->visible()) { ?>
<?php $terimabarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($terimabarang_list->ImportOptions->visible()) { ?>
<?php $terimabarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($terimabarang_list->SearchOptions->visible()) { ?>
<?php $terimabarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($terimabarang_list->FilterOptions->visible()) { ?>
<?php $terimabarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$terimabarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$terimabarang_list->isExport() && !$terimabarang->CurrentAction) { ?>
<form name="fterimabaranglistsrch" id="fterimabaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fterimabaranglistsrch-search-panel" class="<?php echo $terimabarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="terimabarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $terimabarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($terimabarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($terimabarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $terimabarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($terimabarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($terimabarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($terimabarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($terimabarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $terimabarang_list->showPageHeader(); ?>
<?php
$terimabarang_list->showMessage();
?>
<?php if ($terimabarang_list->TotalRecords > 0 || $terimabarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($terimabarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> terimabarang">
<?php if (!$terimabarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$terimabarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $terimabarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terimabarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fterimabaranglist" id="fterimabaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimabarang">
<div id="gmp_terimabarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($terimabarang_list->TotalRecords > 0 || $terimabarang_list->isGridEdit()) { ?>
<table id="tbl_terimabaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$terimabarang->RowType = ROWTYPE_HEADER;

// Render list options
$terimabarang_list->renderListOptions();

// Render list options (header, left)
$terimabarang_list->ListOptions->render("header", "left");
?>
<?php if ($terimabarang_list->no_terima->Visible) { // no_terima ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->no_terima) == "") { ?>
		<th data-name="no_terima" class="<?php echo $terimabarang_list->no_terima->headerCellClass() ?>"><div id="elh_terimabarang_no_terima" class="terimabarang_no_terima"><div class="ew-table-header-caption"><?php echo $terimabarang_list->no_terima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_terima" class="<?php echo $terimabarang_list->no_terima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->no_terima) ?>', 1);"><div id="elh_terimabarang_no_terima" class="terimabarang_no_terima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->no_terima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->no_terima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->no_terima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->id_kirimbarang) == "") { ?>
		<th data-name="id_kirimbarang" class="<?php echo $terimabarang_list->id_kirimbarang->headerCellClass() ?>"><div id="elh_terimabarang_id_kirimbarang" class="terimabarang_id_kirimbarang"><div class="ew-table-header-caption"><?php echo $terimabarang_list->id_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kirimbarang" class="<?php echo $terimabarang_list->id_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->id_kirimbarang) ?>', 1);"><div id="elh_terimabarang_id_kirimbarang" class="terimabarang_id_kirimbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->id_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->id_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->id_po->Visible) { // id_po ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->id_po) == "") { ?>
		<th data-name="id_po" class="<?php echo $terimabarang_list->id_po->headerCellClass() ?>"><div id="elh_terimabarang_id_po" class="terimabarang_id_po"><div class="ew-table-header-caption"><?php echo $terimabarang_list->id_po->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_po" class="<?php echo $terimabarang_list->id_po->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->id_po) ?>', 1);"><div id="elh_terimabarang_id_po" class="terimabarang_id_po">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->id_po->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->id_po->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->id_po->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->id_supplier->Visible) { // id_supplier ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->id_supplier) == "") { ?>
		<th data-name="id_supplier" class="<?php echo $terimabarang_list->id_supplier->headerCellClass() ?>"><div id="elh_terimabarang_id_supplier" class="terimabarang_id_supplier"><div class="ew-table-header-caption"><?php echo $terimabarang_list->id_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_supplier" class="<?php echo $terimabarang_list->id_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->id_supplier) ?>', 1);"><div id="elh_terimabarang_id_supplier" class="terimabarang_id_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->id_supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->id_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->id_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $terimabarang_list->id_klinik->headerCellClass() ?>"><div id="elh_terimabarang_id_klinik" class="terimabarang_id_klinik"><div class="ew-table-header-caption"><?php echo $terimabarang_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $terimabarang_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->id_klinik) ?>', 1);"><div id="elh_terimabarang_id_klinik" class="terimabarang_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->id_pegawai->Visible) { // id_pegawai ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->id_pegawai) == "") { ?>
		<th data-name="id_pegawai" class="<?php echo $terimabarang_list->id_pegawai->headerCellClass() ?>"><div id="elh_terimabarang_id_pegawai" class="terimabarang_id_pegawai"><div class="ew-table-header-caption"><?php echo $terimabarang_list->id_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pegawai" class="<?php echo $terimabarang_list->id_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->id_pegawai) ?>', 1);"><div id="elh_terimabarang_id_pegawai" class="terimabarang_id_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->id_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->id_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->id_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->tanggal_terima->Visible) { // tanggal_terima ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->tanggal_terima) == "") { ?>
		<th data-name="tanggal_terima" class="<?php echo $terimabarang_list->tanggal_terima->headerCellClass() ?>"><div id="elh_terimabarang_tanggal_terima" class="terimabarang_tanggal_terima"><div class="ew-table-header-caption"><?php echo $terimabarang_list->tanggal_terima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_terima" class="<?php echo $terimabarang_list->tanggal_terima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->tanggal_terima) ?>', 1);"><div id="elh_terimabarang_tanggal_terima" class="terimabarang_tanggal_terima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->tanggal_terima->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->tanggal_terima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->tanggal_terima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimabarang_list->keterangan->Visible) { // keterangan ?>
	<?php if ($terimabarang_list->SortUrl($terimabarang_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $terimabarang_list->keterangan->headerCellClass() ?>"><div id="elh_terimabarang_keterangan" class="terimabarang_keterangan"><div class="ew-table-header-caption"><?php echo $terimabarang_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $terimabarang_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimabarang_list->SortUrl($terimabarang_list->keterangan) ?>', 1);"><div id="elh_terimabarang_keterangan" class="terimabarang_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimabarang_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($terimabarang_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimabarang_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$terimabarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($terimabarang_list->ExportAll && $terimabarang_list->isExport()) {
	$terimabarang_list->StopRecord = $terimabarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($terimabarang_list->TotalRecords > $terimabarang_list->StartRecord + $terimabarang_list->DisplayRecords - 1)
		$terimabarang_list->StopRecord = $terimabarang_list->StartRecord + $terimabarang_list->DisplayRecords - 1;
	else
		$terimabarang_list->StopRecord = $terimabarang_list->TotalRecords;
}
$terimabarang_list->RecordCount = $terimabarang_list->StartRecord - 1;
if ($terimabarang_list->Recordset && !$terimabarang_list->Recordset->EOF) {
	$terimabarang_list->Recordset->moveFirst();
	$selectLimit = $terimabarang_list->UseSelectLimit;
	if (!$selectLimit && $terimabarang_list->StartRecord > 1)
		$terimabarang_list->Recordset->move($terimabarang_list->StartRecord - 1);
} elseif (!$terimabarang->AllowAddDeleteRow && $terimabarang_list->StopRecord == 0) {
	$terimabarang_list->StopRecord = $terimabarang->GridAddRowCount;
}

// Initialize aggregate
$terimabarang->RowType = ROWTYPE_AGGREGATEINIT;
$terimabarang->resetAttributes();
$terimabarang_list->renderRow();
while ($terimabarang_list->RecordCount < $terimabarang_list->StopRecord) {
	$terimabarang_list->RecordCount++;
	if ($terimabarang_list->RecordCount >= $terimabarang_list->StartRecord) {
		$terimabarang_list->RowCount++;

		// Set up key count
		$terimabarang_list->KeyCount = $terimabarang_list->RowIndex;

		// Init row class and style
		$terimabarang->resetAttributes();
		$terimabarang->CssClass = "";
		if ($terimabarang_list->isGridAdd()) {
		} else {
			$terimabarang_list->loadRowValues($terimabarang_list->Recordset); // Load row values
		}
		$terimabarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$terimabarang->RowAttrs->merge(["data-rowindex" => $terimabarang_list->RowCount, "id" => "r" . $terimabarang_list->RowCount . "_terimabarang", "data-rowtype" => $terimabarang->RowType]);

		// Render row
		$terimabarang_list->renderRow();

		// Render list options
		$terimabarang_list->renderListOptions();
?>
	<tr <?php echo $terimabarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$terimabarang_list->ListOptions->render("body", "left", $terimabarang_list->RowCount);
?>
	<?php if ($terimabarang_list->no_terima->Visible) { // no_terima ?>
		<td data-name="no_terima" <?php echo $terimabarang_list->no_terima->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_no_terima">
<span<?php echo $terimabarang_list->no_terima->viewAttributes() ?>><?php echo $terimabarang_list->no_terima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang" <?php echo $terimabarang_list->id_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_id_kirimbarang">
<span<?php echo $terimabarang_list->id_kirimbarang->viewAttributes() ?>><?php echo $terimabarang_list->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->id_po->Visible) { // id_po ?>
		<td data-name="id_po" <?php echo $terimabarang_list->id_po->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_id_po">
<span<?php echo $terimabarang_list->id_po->viewAttributes() ?>><?php echo $terimabarang_list->id_po->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->id_supplier->Visible) { // id_supplier ?>
		<td data-name="id_supplier" <?php echo $terimabarang_list->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_id_supplier">
<span<?php echo $terimabarang_list->id_supplier->viewAttributes() ?>><?php echo $terimabarang_list->id_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $terimabarang_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_id_klinik">
<span<?php echo $terimabarang_list->id_klinik->viewAttributes() ?>><?php echo $terimabarang_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->id_pegawai->Visible) { // id_pegawai ?>
		<td data-name="id_pegawai" <?php echo $terimabarang_list->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_id_pegawai">
<span<?php echo $terimabarang_list->id_pegawai->viewAttributes() ?>><?php echo $terimabarang_list->id_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->tanggal_terima->Visible) { // tanggal_terima ?>
		<td data-name="tanggal_terima" <?php echo $terimabarang_list->tanggal_terima->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_tanggal_terima">
<span<?php echo $terimabarang_list->tanggal_terima->viewAttributes() ?>><?php echo $terimabarang_list->tanggal_terima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimabarang_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $terimabarang_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $terimabarang_list->RowCount ?>_terimabarang_keterangan">
<span<?php echo $terimabarang_list->keterangan->viewAttributes() ?>><?php echo $terimabarang_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$terimabarang_list->ListOptions->render("body", "right", $terimabarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$terimabarang_list->isGridAdd())
		$terimabarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$terimabarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($terimabarang_list->Recordset)
	$terimabarang_list->Recordset->Close();
?>
<?php if (!$terimabarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$terimabarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $terimabarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terimabarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($terimabarang_list->TotalRecords == 0 && !$terimabarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $terimabarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$terimabarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terimabarang_list->isExport()) { ?>
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
$terimabarang_list->terminate();
?>