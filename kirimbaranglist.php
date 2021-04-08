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
$kirimbarang_list = new kirimbarang_list();

// Run the page
$kirimbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kirimbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$kirimbarang_list->isExport()) { ?>
<script>
var fkirimbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkirimbaranglist = currentForm = new ew.Form("fkirimbaranglist", "list");
	fkirimbaranglist.formKeyCountName = '<?php echo $kirimbarang_list->FormKeyCountName ?>';
	loadjs.done("fkirimbaranglist");
});
var fkirimbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkirimbaranglistsrch = currentSearchForm = new ew.Form("fkirimbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fkirimbaranglistsrch.filterList = <?php echo $kirimbarang_list->getFilterList() ?>;
	loadjs.done("fkirimbaranglistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","kirimbarangadd.php?showdetail=detailkirimbarang"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-view").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailkirimbarang"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-edit").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailkirimbarang"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-copy").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailkirimbarang"+t[1]+"="+t[2])});
});
</script>
<?php } ?>
<?php if (!$kirimbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($kirimbarang_list->TotalRecords > 0 && $kirimbarang_list->ExportOptions->visible()) { ?>
<?php $kirimbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($kirimbarang_list->ImportOptions->visible()) { ?>
<?php $kirimbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($kirimbarang_list->SearchOptions->visible()) { ?>
<?php $kirimbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($kirimbarang_list->FilterOptions->visible()) { ?>
<?php $kirimbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$kirimbarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$kirimbarang_list->isExport() && !$kirimbarang->CurrentAction) { ?>
<form name="fkirimbaranglistsrch" id="fkirimbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkirimbaranglistsrch-search-panel" class="<?php echo $kirimbarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kirimbarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $kirimbarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($kirimbarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($kirimbarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $kirimbarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($kirimbarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($kirimbarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($kirimbarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($kirimbarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $kirimbarang_list->showPageHeader(); ?>
<?php
$kirimbarang_list->showMessage();
?>
<?php if ($kirimbarang_list->TotalRecords > 0 || $kirimbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kirimbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kirimbarang">
<?php if (!$kirimbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$kirimbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kirimbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kirimbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkirimbaranglist" id="fkirimbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kirimbarang">
<div id="gmp_kirimbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($kirimbarang_list->TotalRecords > 0 || $kirimbarang_list->isGridEdit()) { ?>
<table id="tbl_kirimbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kirimbarang->RowType = ROWTYPE_HEADER;

// Render list options
$kirimbarang_list->renderListOptions();

// Render list options (header, left)
$kirimbarang_list->ListOptions->render("header", "left");
?>
<?php if ($kirimbarang_list->no_kirimbarang->Visible) { // no_kirimbarang ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->no_kirimbarang) == "") { ?>
		<th data-name="no_kirimbarang" class="<?php echo $kirimbarang_list->no_kirimbarang->headerCellClass() ?>"><div id="elh_kirimbarang_no_kirimbarang" class="kirimbarang_no_kirimbarang"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->no_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_kirimbarang" class="<?php echo $kirimbarang_list->no_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->no_kirimbarang) ?>', 1);"><div id="elh_kirimbarang_no_kirimbarang" class="kirimbarang_no_kirimbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->no_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->no_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->no_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->id_po->Visible) { // id_po ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->id_po) == "") { ?>
		<th data-name="id_po" class="<?php echo $kirimbarang_list->id_po->headerCellClass() ?>"><div id="elh_kirimbarang_id_po" class="kirimbarang_id_po"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->id_po->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_po" class="<?php echo $kirimbarang_list->id_po->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->id_po) ?>', 1);"><div id="elh_kirimbarang_id_po" class="kirimbarang_id_po">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->id_po->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->id_po->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->id_po->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->id_supplier->Visible) { // id_supplier ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->id_supplier) == "") { ?>
		<th data-name="id_supplier" class="<?php echo $kirimbarang_list->id_supplier->headerCellClass() ?>"><div id="elh_kirimbarang_id_supplier" class="kirimbarang_id_supplier"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->id_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_supplier" class="<?php echo $kirimbarang_list->id_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->id_supplier) ?>', 1);"><div id="elh_kirimbarang_id_supplier" class="kirimbarang_id_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->id_supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->id_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->id_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $kirimbarang_list->id_klinik->headerCellClass() ?>"><div id="elh_kirimbarang_id_klinik" class="kirimbarang_id_klinik"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $kirimbarang_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->id_klinik) ?>', 1);"><div id="elh_kirimbarang_id_klinik" class="kirimbarang_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->id_pegawai->Visible) { // id_pegawai ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->id_pegawai) == "") { ?>
		<th data-name="id_pegawai" class="<?php echo $kirimbarang_list->id_pegawai->headerCellClass() ?>"><div id="elh_kirimbarang_id_pegawai" class="kirimbarang_id_pegawai"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->id_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pegawai" class="<?php echo $kirimbarang_list->id_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->id_pegawai) ?>', 1);"><div id="elh_kirimbarang_id_pegawai" class="kirimbarang_id_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->id_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->id_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->id_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->tanggal->Visible) { // tanggal ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $kirimbarang_list->tanggal->headerCellClass() ?>"><div id="elh_kirimbarang_tanggal" class="kirimbarang_tanggal"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $kirimbarang_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->tanggal) ?>', 1);"><div id="elh_kirimbarang_tanggal" class="kirimbarang_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->status_kirim->Visible) { // status_kirim ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->status_kirim) == "") { ?>
		<th data-name="status_kirim" class="<?php echo $kirimbarang_list->status_kirim->headerCellClass() ?>"><div id="elh_kirimbarang_status_kirim" class="kirimbarang_status_kirim"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->status_kirim->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_kirim" class="<?php echo $kirimbarang_list->status_kirim->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->status_kirim) ?>', 1);"><div id="elh_kirimbarang_status_kirim" class="kirimbarang_status_kirim">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->status_kirim->caption() ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->status_kirim->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->status_kirim->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kirimbarang_list->keterangan->Visible) { // keterangan ?>
	<?php if ($kirimbarang_list->SortUrl($kirimbarang_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $kirimbarang_list->keterangan->headerCellClass() ?>"><div id="elh_kirimbarang_keterangan" class="kirimbarang_keterangan"><div class="ew-table-header-caption"><?php echo $kirimbarang_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $kirimbarang_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $kirimbarang_list->SortUrl($kirimbarang_list->keterangan) ?>', 1);"><div id="elh_kirimbarang_keterangan" class="kirimbarang_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kirimbarang_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($kirimbarang_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kirimbarang_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kirimbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($kirimbarang_list->ExportAll && $kirimbarang_list->isExport()) {
	$kirimbarang_list->StopRecord = $kirimbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($kirimbarang_list->TotalRecords > $kirimbarang_list->StartRecord + $kirimbarang_list->DisplayRecords - 1)
		$kirimbarang_list->StopRecord = $kirimbarang_list->StartRecord + $kirimbarang_list->DisplayRecords - 1;
	else
		$kirimbarang_list->StopRecord = $kirimbarang_list->TotalRecords;
}
$kirimbarang_list->RecordCount = $kirimbarang_list->StartRecord - 1;
if ($kirimbarang_list->Recordset && !$kirimbarang_list->Recordset->EOF) {
	$kirimbarang_list->Recordset->moveFirst();
	$selectLimit = $kirimbarang_list->UseSelectLimit;
	if (!$selectLimit && $kirimbarang_list->StartRecord > 1)
		$kirimbarang_list->Recordset->move($kirimbarang_list->StartRecord - 1);
} elseif (!$kirimbarang->AllowAddDeleteRow && $kirimbarang_list->StopRecord == 0) {
	$kirimbarang_list->StopRecord = $kirimbarang->GridAddRowCount;
}

// Initialize aggregate
$kirimbarang->RowType = ROWTYPE_AGGREGATEINIT;
$kirimbarang->resetAttributes();
$kirimbarang_list->renderRow();
while ($kirimbarang_list->RecordCount < $kirimbarang_list->StopRecord) {
	$kirimbarang_list->RecordCount++;
	if ($kirimbarang_list->RecordCount >= $kirimbarang_list->StartRecord) {
		$kirimbarang_list->RowCount++;

		// Set up key count
		$kirimbarang_list->KeyCount = $kirimbarang_list->RowIndex;

		// Init row class and style
		$kirimbarang->resetAttributes();
		$kirimbarang->CssClass = "";
		if ($kirimbarang_list->isGridAdd()) {
		} else {
			$kirimbarang_list->loadRowValues($kirimbarang_list->Recordset); // Load row values
		}
		$kirimbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$kirimbarang->RowAttrs->merge(["data-rowindex" => $kirimbarang_list->RowCount, "id" => "r" . $kirimbarang_list->RowCount . "_kirimbarang", "data-rowtype" => $kirimbarang->RowType]);

		// Render row
		$kirimbarang_list->renderRow();

		// Render list options
		$kirimbarang_list->renderListOptions();
?>
	<tr <?php echo $kirimbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kirimbarang_list->ListOptions->render("body", "left", $kirimbarang_list->RowCount);
?>
	<?php if ($kirimbarang_list->no_kirimbarang->Visible) { // no_kirimbarang ?>
		<td data-name="no_kirimbarang" <?php echo $kirimbarang_list->no_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_no_kirimbarang">
<span<?php echo $kirimbarang_list->no_kirimbarang->viewAttributes() ?>><?php echo $kirimbarang_list->no_kirimbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->id_po->Visible) { // id_po ?>
		<td data-name="id_po" <?php echo $kirimbarang_list->id_po->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_id_po">
<span<?php echo $kirimbarang_list->id_po->viewAttributes() ?>><?php echo $kirimbarang_list->id_po->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->id_supplier->Visible) { // id_supplier ?>
		<td data-name="id_supplier" <?php echo $kirimbarang_list->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_id_supplier">
<span<?php echo $kirimbarang_list->id_supplier->viewAttributes() ?>><?php echo $kirimbarang_list->id_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $kirimbarang_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_id_klinik">
<span<?php echo $kirimbarang_list->id_klinik->viewAttributes() ?>><?php echo $kirimbarang_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->id_pegawai->Visible) { // id_pegawai ?>
		<td data-name="id_pegawai" <?php echo $kirimbarang_list->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_id_pegawai">
<span<?php echo $kirimbarang_list->id_pegawai->viewAttributes() ?>><?php echo $kirimbarang_list->id_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $kirimbarang_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_tanggal">
<span<?php echo $kirimbarang_list->tanggal->viewAttributes() ?>><?php echo $kirimbarang_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->status_kirim->Visible) { // status_kirim ?>
		<td data-name="status_kirim" <?php echo $kirimbarang_list->status_kirim->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_status_kirim">
<span<?php echo $kirimbarang_list->status_kirim->viewAttributes() ?>><?php echo $kirimbarang_list->status_kirim->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($kirimbarang_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $kirimbarang_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $kirimbarang_list->RowCount ?>_kirimbarang_keterangan">
<span<?php echo $kirimbarang_list->keterangan->viewAttributes() ?>><?php echo $kirimbarang_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kirimbarang_list->ListOptions->render("body", "right", $kirimbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$kirimbarang_list->isGridAdd())
		$kirimbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$kirimbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kirimbarang_list->Recordset)
	$kirimbarang_list->Recordset->Close();
?>
<?php if (!$kirimbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$kirimbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $kirimbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $kirimbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kirimbarang_list->TotalRecords == 0 && !$kirimbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kirimbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$kirimbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$kirimbarang_list->isExport()) { ?>
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
$kirimbarang_list->terminate();
?>