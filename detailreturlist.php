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
$detailretur_list = new detailretur_list();

// Run the page
$detailretur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailretur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailretur_list->isExport()) { ?>
<script>
var fdetailreturlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailreturlist = currentForm = new ew.Form("fdetailreturlist", "list");
	fdetailreturlist.formKeyCountName = '<?php echo $detailretur_list->FormKeyCountName ?>';
	loadjs.done("fdetailreturlist");
});
var fdetailreturlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailreturlistsrch = currentSearchForm = new ew.Form("fdetailreturlistsrch");

	// Dynamic selection lists
	// Filters

	fdetailreturlistsrch.filterList = <?php echo $detailretur_list->getFilterList() ?>;
	loadjs.done("fdetailreturlistsrch");
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
<?php if (!$detailretur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailretur_list->TotalRecords > 0 && $detailretur_list->ExportOptions->visible()) { ?>
<?php $detailretur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailretur_list->ImportOptions->visible()) { ?>
<?php $detailretur_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailretur_list->SearchOptions->visible()) { ?>
<?php $detailretur_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailretur_list->FilterOptions->visible()) { ?>
<?php $detailretur_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailretur_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailretur_list->isExport("print")) { ?>
<?php
if ($detailretur_list->DbMasterFilter != "" && $detailretur->getCurrentMasterTable() == "returbarang") {
	if ($detailretur_list->MasterRecordExists) {
		include_once "returbarangmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailretur_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailretur_list->isExport() && !$detailretur->CurrentAction) { ?>
<form name="fdetailreturlistsrch" id="fdetailreturlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailreturlistsrch-search-panel" class="<?php echo $detailretur_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailretur">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $detailretur_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($detailretur_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($detailretur_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $detailretur_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($detailretur_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($detailretur_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($detailretur_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($detailretur_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailretur_list->showPageHeader(); ?>
<?php
$detailretur_list->showMessage();
?>
<?php if ($detailretur_list->TotalRecords > 0 || $detailretur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailretur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailretur">
<?php if (!$detailretur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailretur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailretur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailretur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailreturlist" id="fdetailreturlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailretur">
<?php if ($detailretur->getCurrentMasterTable() == "returbarang" && $detailretur->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="returbarang">
<input type="hidden" name="fk_id_retur" value="<?php echo HtmlEncode($detailretur_list->id_retur->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailretur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailretur_list->TotalRecords > 0 || $detailretur_list->isGridEdit()) { ?>
<table id="tbl_detailreturlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailretur->RowType = ROWTYPE_HEADER;

// Render list options
$detailretur_list->renderListOptions();

// Render list options (header, left)
$detailretur_list->ListOptions->render("header", "left");
?>
<?php if ($detailretur_list->id_detailretur->Visible) { // id_detailretur ?>
	<?php if ($detailretur_list->SortUrl($detailretur_list->id_detailretur) == "") { ?>
		<th data-name="id_detailretur" class="<?php echo $detailretur_list->id_detailretur->headerCellClass() ?>"><div id="elh_detailretur_id_detailretur" class="detailretur_id_detailretur"><div class="ew-table-header-caption"><?php echo $detailretur_list->id_detailretur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailretur" class="<?php echo $detailretur_list->id_detailretur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailretur_list->SortUrl($detailretur_list->id_detailretur) ?>', 1);"><div id="elh_detailretur_id_detailretur" class="detailretur_id_detailretur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_list->id_detailretur->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_list->id_detailretur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_list->id_detailretur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_list->id_retur->Visible) { // id_retur ?>
	<?php if ($detailretur_list->SortUrl($detailretur_list->id_retur) == "") { ?>
		<th data-name="id_retur" class="<?php echo $detailretur_list->id_retur->headerCellClass() ?>"><div id="elh_detailretur_id_retur" class="detailretur_id_retur"><div class="ew-table-header-caption"><?php echo $detailretur_list->id_retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_retur" class="<?php echo $detailretur_list->id_retur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailretur_list->SortUrl($detailretur_list->id_retur) ?>', 1);"><div id="elh_detailretur_id_retur" class="detailretur_id_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_list->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_list->id_retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_list->id_retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailretur_list->SortUrl($detailretur_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailretur_list->id_barang->headerCellClass() ?>"><div id="elh_detailretur_id_barang" class="detailretur_id_barang"><div class="ew-table-header-caption"><?php echo $detailretur_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailretur_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailretur_list->SortUrl($detailretur_list->id_barang) ?>', 1);"><div id="elh_detailretur_id_barang" class="detailretur_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailretur_list->SortUrl($detailretur_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailretur_list->jumlah->headerCellClass() ?>"><div id="elh_detailretur_jumlah" class="detailretur_jumlah"><div class="ew-table-header-caption"><?php echo $detailretur_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailretur_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailretur_list->SortUrl($detailretur_list->jumlah) ?>', 1);"><div id="elh_detailretur_jumlah" class="detailretur_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailretur_list->SortUrl($detailretur_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailretur_list->id_satuan->headerCellClass() ?>"><div id="elh_detailretur_id_satuan" class="detailretur_id_satuan"><div class="ew-table-header-caption"><?php echo $detailretur_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailretur_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailretur_list->SortUrl($detailretur_list->id_satuan) ?>', 1);"><div id="elh_detailretur_id_satuan" class="detailretur_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailretur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailretur_list->ExportAll && $detailretur_list->isExport()) {
	$detailretur_list->StopRecord = $detailretur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailretur_list->TotalRecords > $detailretur_list->StartRecord + $detailretur_list->DisplayRecords - 1)
		$detailretur_list->StopRecord = $detailretur_list->StartRecord + $detailretur_list->DisplayRecords - 1;
	else
		$detailretur_list->StopRecord = $detailretur_list->TotalRecords;
}
$detailretur_list->RecordCount = $detailretur_list->StartRecord - 1;
if ($detailretur_list->Recordset && !$detailretur_list->Recordset->EOF) {
	$detailretur_list->Recordset->moveFirst();
	$selectLimit = $detailretur_list->UseSelectLimit;
	if (!$selectLimit && $detailretur_list->StartRecord > 1)
		$detailretur_list->Recordset->move($detailretur_list->StartRecord - 1);
} elseif (!$detailretur->AllowAddDeleteRow && $detailretur_list->StopRecord == 0) {
	$detailretur_list->StopRecord = $detailretur->GridAddRowCount;
}

// Initialize aggregate
$detailretur->RowType = ROWTYPE_AGGREGATEINIT;
$detailretur->resetAttributes();
$detailretur_list->renderRow();
while ($detailretur_list->RecordCount < $detailretur_list->StopRecord) {
	$detailretur_list->RecordCount++;
	if ($detailretur_list->RecordCount >= $detailretur_list->StartRecord) {
		$detailretur_list->RowCount++;

		// Set up key count
		$detailretur_list->KeyCount = $detailretur_list->RowIndex;

		// Init row class and style
		$detailretur->resetAttributes();
		$detailretur->CssClass = "";
		if ($detailretur_list->isGridAdd()) {
		} else {
			$detailretur_list->loadRowValues($detailretur_list->Recordset); // Load row values
		}
		$detailretur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailretur->RowAttrs->merge(["data-rowindex" => $detailretur_list->RowCount, "id" => "r" . $detailretur_list->RowCount . "_detailretur", "data-rowtype" => $detailretur->RowType]);

		// Render row
		$detailretur_list->renderRow();

		// Render list options
		$detailretur_list->renderListOptions();
?>
	<tr <?php echo $detailretur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailretur_list->ListOptions->render("body", "left", $detailretur_list->RowCount);
?>
	<?php if ($detailretur_list->id_detailretur->Visible) { // id_detailretur ?>
		<td data-name="id_detailretur" <?php echo $detailretur_list->id_detailretur->cellAttributes() ?>>
<span id="el<?php echo $detailretur_list->RowCount ?>_detailretur_id_detailretur">
<span<?php echo $detailretur_list->id_detailretur->viewAttributes() ?>><?php echo $detailretur_list->id_detailretur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailretur_list->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur" <?php echo $detailretur_list->id_retur->cellAttributes() ?>>
<span id="el<?php echo $detailretur_list->RowCount ?>_detailretur_id_retur">
<span<?php echo $detailretur_list->id_retur->viewAttributes() ?>><?php echo $detailretur_list->id_retur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailretur_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailretur_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailretur_list->RowCount ?>_detailretur_id_barang">
<span<?php echo $detailretur_list->id_barang->viewAttributes() ?>><?php echo $detailretur_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailretur_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailretur_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailretur_list->RowCount ?>_detailretur_jumlah">
<span<?php echo $detailretur_list->jumlah->viewAttributes() ?>><?php echo $detailretur_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailretur_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailretur_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailretur_list->RowCount ?>_detailretur_id_satuan">
<span<?php echo $detailretur_list->id_satuan->viewAttributes() ?>><?php echo $detailretur_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailretur_list->ListOptions->render("body", "right", $detailretur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailretur_list->isGridAdd())
		$detailretur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailretur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailretur_list->Recordset)
	$detailretur_list->Recordset->Close();
?>
<?php if (!$detailretur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailretur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailretur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailretur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailretur_list->TotalRecords == 0 && !$detailretur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailretur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailretur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailretur_list->isExport()) { ?>
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
$detailretur_list->terminate();
?>