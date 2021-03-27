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
$returbarang_list = new returbarang_list();

// Run the page
$returbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$returbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$returbarang_list->isExport()) { ?>
<script>
var freturbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freturbaranglist = currentForm = new ew.Form("freturbaranglist", "list");
	freturbaranglist.formKeyCountName = '<?php echo $returbarang_list->FormKeyCountName ?>';
	loadjs.done("freturbaranglist");
});
var freturbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freturbaranglistsrch = currentSearchForm = new ew.Form("freturbaranglistsrch");

	// Dynamic selection lists
	// Filters

	freturbaranglistsrch.filterList = <?php echo $returbarang_list->getFilterList() ?>;
	loadjs.done("freturbaranglistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","returbarangadd.php?showdetail=detailretur"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide();
});
</script>
<?php } ?>
<?php if (!$returbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($returbarang_list->TotalRecords > 0 && $returbarang_list->ExportOptions->visible()) { ?>
<?php $returbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($returbarang_list->ImportOptions->visible()) { ?>
<?php $returbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($returbarang_list->SearchOptions->visible()) { ?>
<?php $returbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($returbarang_list->FilterOptions->visible()) { ?>
<?php $returbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$returbarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$returbarang_list->isExport() && !$returbarang->CurrentAction) { ?>
<form name="freturbaranglistsrch" id="freturbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freturbaranglistsrch-search-panel" class="<?php echo $returbarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="returbarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $returbarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($returbarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($returbarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $returbarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($returbarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($returbarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($returbarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($returbarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $returbarang_list->showPageHeader(); ?>
<?php
$returbarang_list->showMessage();
?>
<?php if ($returbarang_list->TotalRecords > 0 || $returbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($returbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> returbarang">
<?php if (!$returbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$returbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $returbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $returbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freturbaranglist" id="freturbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="returbarang">
<div id="gmp_returbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($returbarang_list->TotalRecords > 0 || $returbarang_list->isGridEdit()) { ?>
<table id="tbl_returbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$returbarang->RowType = ROWTYPE_HEADER;

// Render list options
$returbarang_list->renderListOptions();

// Render list options (header, left)
$returbarang_list->ListOptions->render("header", "left");
?>
<?php if ($returbarang_list->id_retur->Visible) { // id_retur ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->id_retur) == "") { ?>
		<th data-name="id_retur" class="<?php echo $returbarang_list->id_retur->headerCellClass() ?>"><div id="elh_returbarang_id_retur" class="returbarang_id_retur"><div class="ew-table-header-caption"><?php echo $returbarang_list->id_retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_retur" class="<?php echo $returbarang_list->id_retur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->id_retur) ?>', 1);"><div id="elh_returbarang_id_retur" class="returbarang_id_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->id_retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->id_retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->kode->Visible) { // kode ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->kode) == "") { ?>
		<th data-name="kode" class="<?php echo $returbarang_list->kode->headerCellClass() ?>"><div id="elh_returbarang_kode" class="returbarang_kode"><div class="ew-table-header-caption"><?php echo $returbarang_list->kode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode" class="<?php echo $returbarang_list->kode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->kode) ?>', 1);"><div id="elh_returbarang_kode" class="returbarang_kode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->kode->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->kode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->kode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $returbarang_list->id_klinik->headerCellClass() ?>"><div id="elh_returbarang_id_klinik" class="returbarang_id_klinik"><div class="ew-table-header-caption"><?php echo $returbarang_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $returbarang_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->id_klinik) ?>', 1);"><div id="elh_returbarang_id_klinik" class="returbarang_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->id_supplier->Visible) { // id_supplier ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->id_supplier) == "") { ?>
		<th data-name="id_supplier" class="<?php echo $returbarang_list->id_supplier->headerCellClass() ?>"><div id="elh_returbarang_id_supplier" class="returbarang_id_supplier"><div class="ew-table-header-caption"><?php echo $returbarang_list->id_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_supplier" class="<?php echo $returbarang_list->id_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->id_supplier) ?>', 1);"><div id="elh_returbarang_id_supplier" class="returbarang_id_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->id_supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->id_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->id_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->id_pegawai->Visible) { // id_pegawai ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->id_pegawai) == "") { ?>
		<th data-name="id_pegawai" class="<?php echo $returbarang_list->id_pegawai->headerCellClass() ?>" style="white-space: nowrap;"><div id="elh_returbarang_id_pegawai" class="returbarang_id_pegawai"><div class="ew-table-header-caption"><?php echo $returbarang_list->id_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pegawai" class="<?php echo $returbarang_list->id_pegawai->headerCellClass() ?>" style="white-space: nowrap;"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->id_pegawai) ?>', 1);"><div id="elh_returbarang_id_pegawai" class="returbarang_id_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->id_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->id_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->id_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->tanggal->Visible) { // tanggal ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $returbarang_list->tanggal->headerCellClass() ?>"><div id="elh_returbarang_tanggal" class="returbarang_tanggal"><div class="ew-table-header-caption"><?php echo $returbarang_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $returbarang_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->tanggal) ?>', 1);"><div id="elh_returbarang_tanggal" class="returbarang_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->status->Visible) { // status ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $returbarang_list->status->headerCellClass() ?>"><div id="elh_returbarang_status" class="returbarang_status"><div class="ew-table-header-caption"><?php echo $returbarang_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $returbarang_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->status) ?>', 1);"><div id="elh_returbarang_status" class="returbarang_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($returbarang_list->keterangan->Visible) { // keterangan ?>
	<?php if ($returbarang_list->SortUrl($returbarang_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $returbarang_list->keterangan->headerCellClass() ?>"><div id="elh_returbarang_keterangan" class="returbarang_keterangan"><div class="ew-table-header-caption"><?php echo $returbarang_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $returbarang_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $returbarang_list->SortUrl($returbarang_list->keterangan) ?>', 1);"><div id="elh_returbarang_keterangan" class="returbarang_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $returbarang_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($returbarang_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($returbarang_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$returbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($returbarang_list->ExportAll && $returbarang_list->isExport()) {
	$returbarang_list->StopRecord = $returbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($returbarang_list->TotalRecords > $returbarang_list->StartRecord + $returbarang_list->DisplayRecords - 1)
		$returbarang_list->StopRecord = $returbarang_list->StartRecord + $returbarang_list->DisplayRecords - 1;
	else
		$returbarang_list->StopRecord = $returbarang_list->TotalRecords;
}
$returbarang_list->RecordCount = $returbarang_list->StartRecord - 1;
if ($returbarang_list->Recordset && !$returbarang_list->Recordset->EOF) {
	$returbarang_list->Recordset->moveFirst();
	$selectLimit = $returbarang_list->UseSelectLimit;
	if (!$selectLimit && $returbarang_list->StartRecord > 1)
		$returbarang_list->Recordset->move($returbarang_list->StartRecord - 1);
} elseif (!$returbarang->AllowAddDeleteRow && $returbarang_list->StopRecord == 0) {
	$returbarang_list->StopRecord = $returbarang->GridAddRowCount;
}

// Initialize aggregate
$returbarang->RowType = ROWTYPE_AGGREGATEINIT;
$returbarang->resetAttributes();
$returbarang_list->renderRow();
while ($returbarang_list->RecordCount < $returbarang_list->StopRecord) {
	$returbarang_list->RecordCount++;
	if ($returbarang_list->RecordCount >= $returbarang_list->StartRecord) {
		$returbarang_list->RowCount++;

		// Set up key count
		$returbarang_list->KeyCount = $returbarang_list->RowIndex;

		// Init row class and style
		$returbarang->resetAttributes();
		$returbarang->CssClass = "";
		if ($returbarang_list->isGridAdd()) {
		} else {
			$returbarang_list->loadRowValues($returbarang_list->Recordset); // Load row values
		}
		$returbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$returbarang->RowAttrs->merge(["data-rowindex" => $returbarang_list->RowCount, "id" => "r" . $returbarang_list->RowCount . "_returbarang", "data-rowtype" => $returbarang->RowType]);

		// Render row
		$returbarang_list->renderRow();

		// Render list options
		$returbarang_list->renderListOptions();
?>
	<tr <?php echo $returbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$returbarang_list->ListOptions->render("body", "left", $returbarang_list->RowCount);
?>
	<?php if ($returbarang_list->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur" <?php echo $returbarang_list->id_retur->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_id_retur">
<span<?php echo $returbarang_list->id_retur->viewAttributes() ?>><?php echo $returbarang_list->id_retur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->kode->Visible) { // kode ?>
		<td data-name="kode" <?php echo $returbarang_list->kode->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_kode">
<span<?php echo $returbarang_list->kode->viewAttributes() ?>><?php echo $returbarang_list->kode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $returbarang_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_id_klinik">
<span<?php echo $returbarang_list->id_klinik->viewAttributes() ?>><?php echo $returbarang_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->id_supplier->Visible) { // id_supplier ?>
		<td data-name="id_supplier" <?php echo $returbarang_list->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_id_supplier">
<span<?php echo $returbarang_list->id_supplier->viewAttributes() ?>><?php echo $returbarang_list->id_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->id_pegawai->Visible) { // id_pegawai ?>
		<td data-name="id_pegawai" <?php echo $returbarang_list->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_id_pegawai">
<span<?php echo $returbarang_list->id_pegawai->viewAttributes() ?>><?php echo $returbarang_list->id_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $returbarang_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_tanggal">
<span<?php echo $returbarang_list->tanggal->viewAttributes() ?>><?php echo $returbarang_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $returbarang_list->status->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_status">
<span<?php echo $returbarang_list->status->viewAttributes() ?>><?php echo $returbarang_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($returbarang_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $returbarang_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $returbarang_list->RowCount ?>_returbarang_keterangan">
<span<?php echo $returbarang_list->keterangan->viewAttributes() ?>><?php echo $returbarang_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$returbarang_list->ListOptions->render("body", "right", $returbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$returbarang_list->isGridAdd())
		$returbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$returbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($returbarang_list->Recordset)
	$returbarang_list->Recordset->Close();
?>
<?php if (!$returbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$returbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $returbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $returbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($returbarang_list->TotalRecords == 0 && !$returbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $returbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$returbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$returbarang_list->isExport()) { ?>
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
$returbarang_list->terminate();
?>