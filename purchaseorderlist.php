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
$purchaseorder_list = new purchaseorder_list();

// Run the page
$purchaseorder_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$purchaseorder_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$purchaseorder_list->isExport()) { ?>
<script>
var fpurchaseorderlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpurchaseorderlist = currentForm = new ew.Form("fpurchaseorderlist", "list");
	fpurchaseorderlist.formKeyCountName = '<?php echo $purchaseorder_list->FormKeyCountName ?>';
	loadjs.done("fpurchaseorderlist");
});
var fpurchaseorderlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpurchaseorderlistsrch = currentSearchForm = new ew.Form("fpurchaseorderlistsrch");

	// Dynamic selection lists
	// Filters

	fpurchaseorderlistsrch.filterList = <?php echo $purchaseorder_list->getFilterList() ?>;
	loadjs.done("fpurchaseorderlistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","purchaseorderadd.php?showdetail=detailpo"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-view").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailpo"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-edit").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailpo"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-copy").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailpo"+t[1]+"="+t[2])});
});
</script>
<?php } ?>
<?php if (!$purchaseorder_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($purchaseorder_list->TotalRecords > 0 && $purchaseorder_list->ExportOptions->visible()) { ?>
<?php $purchaseorder_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($purchaseorder_list->ImportOptions->visible()) { ?>
<?php $purchaseorder_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($purchaseorder_list->SearchOptions->visible()) { ?>
<?php $purchaseorder_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($purchaseorder_list->FilterOptions->visible()) { ?>
<?php $purchaseorder_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$purchaseorder_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$purchaseorder_list->isExport() && !$purchaseorder->CurrentAction) { ?>
<form name="fpurchaseorderlistsrch" id="fpurchaseorderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpurchaseorderlistsrch-search-panel" class="<?php echo $purchaseorder_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="purchaseorder">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $purchaseorder_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($purchaseorder_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($purchaseorder_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $purchaseorder_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($purchaseorder_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($purchaseorder_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($purchaseorder_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($purchaseorder_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $purchaseorder_list->showPageHeader(); ?>
<?php
$purchaseorder_list->showMessage();
?>
<?php if ($purchaseorder_list->TotalRecords > 0 || $purchaseorder->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($purchaseorder_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> purchaseorder">
<?php if (!$purchaseorder_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$purchaseorder_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $purchaseorder_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $purchaseorder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpurchaseorderlist" id="fpurchaseorderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="purchaseorder">
<div id="gmp_purchaseorder" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($purchaseorder_list->TotalRecords > 0 || $purchaseorder_list->isGridEdit()) { ?>
<table id="tbl_purchaseorderlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$purchaseorder->RowType = ROWTYPE_HEADER;

// Render list options
$purchaseorder_list->renderListOptions();

// Render list options (header, left)
$purchaseorder_list->ListOptions->render("header", "left");
?>
<?php if ($purchaseorder_list->no_po->Visible) { // no_po ?>
	<?php if ($purchaseorder_list->SortUrl($purchaseorder_list->no_po) == "") { ?>
		<th data-name="no_po" class="<?php echo $purchaseorder_list->no_po->headerCellClass() ?>"><div id="elh_purchaseorder_no_po" class="purchaseorder_no_po"><div class="ew-table-header-caption"><?php echo $purchaseorder_list->no_po->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_po" class="<?php echo $purchaseorder_list->no_po->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchaseorder_list->SortUrl($purchaseorder_list->no_po) ?>', 1);"><div id="elh_purchaseorder_no_po" class="purchaseorder_no_po">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchaseorder_list->no_po->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchaseorder_list->no_po->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchaseorder_list->no_po->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchaseorder_list->tgl_po->Visible) { // tgl_po ?>
	<?php if ($purchaseorder_list->SortUrl($purchaseorder_list->tgl_po) == "") { ?>
		<th data-name="tgl_po" class="<?php echo $purchaseorder_list->tgl_po->headerCellClass() ?>"><div id="elh_purchaseorder_tgl_po" class="purchaseorder_tgl_po"><div class="ew-table-header-caption"><?php echo $purchaseorder_list->tgl_po->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_po" class="<?php echo $purchaseorder_list->tgl_po->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchaseorder_list->SortUrl($purchaseorder_list->tgl_po) ?>', 1);"><div id="elh_purchaseorder_tgl_po" class="purchaseorder_tgl_po">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchaseorder_list->tgl_po->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchaseorder_list->tgl_po->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchaseorder_list->tgl_po->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchaseorder_list->idklinik->Visible) { // idklinik ?>
	<?php if ($purchaseorder_list->SortUrl($purchaseorder_list->idklinik) == "") { ?>
		<th data-name="idklinik" class="<?php echo $purchaseorder_list->idklinik->headerCellClass() ?>"><div id="elh_purchaseorder_idklinik" class="purchaseorder_idklinik"><div class="ew-table-header-caption"><?php echo $purchaseorder_list->idklinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idklinik" class="<?php echo $purchaseorder_list->idklinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchaseorder_list->SortUrl($purchaseorder_list->idklinik) ?>', 1);"><div id="elh_purchaseorder_idklinik" class="purchaseorder_idklinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchaseorder_list->idklinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchaseorder_list->idklinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchaseorder_list->idklinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchaseorder_list->id_supplier->Visible) { // id_supplier ?>
	<?php if ($purchaseorder_list->SortUrl($purchaseorder_list->id_supplier) == "") { ?>
		<th data-name="id_supplier" class="<?php echo $purchaseorder_list->id_supplier->headerCellClass() ?>"><div id="elh_purchaseorder_id_supplier" class="purchaseorder_id_supplier"><div class="ew-table-header-caption"><?php echo $purchaseorder_list->id_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_supplier" class="<?php echo $purchaseorder_list->id_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchaseorder_list->SortUrl($purchaseorder_list->id_supplier) ?>', 1);"><div id="elh_purchaseorder_id_supplier" class="purchaseorder_id_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchaseorder_list->id_supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchaseorder_list->id_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchaseorder_list->id_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchaseorder_list->status_po->Visible) { // status_po ?>
	<?php if ($purchaseorder_list->SortUrl($purchaseorder_list->status_po) == "") { ?>
		<th data-name="status_po" class="<?php echo $purchaseorder_list->status_po->headerCellClass() ?>"><div id="elh_purchaseorder_status_po" class="purchaseorder_status_po"><div class="ew-table-header-caption"><?php echo $purchaseorder_list->status_po->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_po" class="<?php echo $purchaseorder_list->status_po->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchaseorder_list->SortUrl($purchaseorder_list->status_po) ?>', 1);"><div id="elh_purchaseorder_status_po" class="purchaseorder_status_po">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchaseorder_list->status_po->caption() ?></span><span class="ew-table-header-sort"><?php if ($purchaseorder_list->status_po->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchaseorder_list->status_po->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($purchaseorder_list->keterangan->Visible) { // keterangan ?>
	<?php if ($purchaseorder_list->SortUrl($purchaseorder_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $purchaseorder_list->keterangan->headerCellClass() ?>"><div id="elh_purchaseorder_keterangan" class="purchaseorder_keterangan"><div class="ew-table-header-caption"><?php echo $purchaseorder_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $purchaseorder_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $purchaseorder_list->SortUrl($purchaseorder_list->keterangan) ?>', 1);"><div id="elh_purchaseorder_keterangan" class="purchaseorder_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $purchaseorder_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($purchaseorder_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($purchaseorder_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$purchaseorder_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($purchaseorder_list->ExportAll && $purchaseorder_list->isExport()) {
	$purchaseorder_list->StopRecord = $purchaseorder_list->TotalRecords;
} else {

	// Set the last record to display
	if ($purchaseorder_list->TotalRecords > $purchaseorder_list->StartRecord + $purchaseorder_list->DisplayRecords - 1)
		$purchaseorder_list->StopRecord = $purchaseorder_list->StartRecord + $purchaseorder_list->DisplayRecords - 1;
	else
		$purchaseorder_list->StopRecord = $purchaseorder_list->TotalRecords;
}
$purchaseorder_list->RecordCount = $purchaseorder_list->StartRecord - 1;
if ($purchaseorder_list->Recordset && !$purchaseorder_list->Recordset->EOF) {
	$purchaseorder_list->Recordset->moveFirst();
	$selectLimit = $purchaseorder_list->UseSelectLimit;
	if (!$selectLimit && $purchaseorder_list->StartRecord > 1)
		$purchaseorder_list->Recordset->move($purchaseorder_list->StartRecord - 1);
} elseif (!$purchaseorder->AllowAddDeleteRow && $purchaseorder_list->StopRecord == 0) {
	$purchaseorder_list->StopRecord = $purchaseorder->GridAddRowCount;
}

// Initialize aggregate
$purchaseorder->RowType = ROWTYPE_AGGREGATEINIT;
$purchaseorder->resetAttributes();
$purchaseorder_list->renderRow();
while ($purchaseorder_list->RecordCount < $purchaseorder_list->StopRecord) {
	$purchaseorder_list->RecordCount++;
	if ($purchaseorder_list->RecordCount >= $purchaseorder_list->StartRecord) {
		$purchaseorder_list->RowCount++;

		// Set up key count
		$purchaseorder_list->KeyCount = $purchaseorder_list->RowIndex;

		// Init row class and style
		$purchaseorder->resetAttributes();
		$purchaseorder->CssClass = "";
		if ($purchaseorder_list->isGridAdd()) {
		} else {
			$purchaseorder_list->loadRowValues($purchaseorder_list->Recordset); // Load row values
		}
		$purchaseorder->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$purchaseorder->RowAttrs->merge(["data-rowindex" => $purchaseorder_list->RowCount, "id" => "r" . $purchaseorder_list->RowCount . "_purchaseorder", "data-rowtype" => $purchaseorder->RowType]);

		// Render row
		$purchaseorder_list->renderRow();

		// Render list options
		$purchaseorder_list->renderListOptions();
?>
	<tr <?php echo $purchaseorder->rowAttributes() ?>>
<?php

// Render list options (body, left)
$purchaseorder_list->ListOptions->render("body", "left", $purchaseorder_list->RowCount);
?>
	<?php if ($purchaseorder_list->no_po->Visible) { // no_po ?>
		<td data-name="no_po" <?php echo $purchaseorder_list->no_po->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_list->RowCount ?>_purchaseorder_no_po">
<span<?php echo $purchaseorder_list->no_po->viewAttributes() ?>><?php echo $purchaseorder_list->no_po->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchaseorder_list->tgl_po->Visible) { // tgl_po ?>
		<td data-name="tgl_po" <?php echo $purchaseorder_list->tgl_po->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_list->RowCount ?>_purchaseorder_tgl_po">
<span<?php echo $purchaseorder_list->tgl_po->viewAttributes() ?>><?php echo $purchaseorder_list->tgl_po->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchaseorder_list->idklinik->Visible) { // idklinik ?>
		<td data-name="idklinik" <?php echo $purchaseorder_list->idklinik->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_list->RowCount ?>_purchaseorder_idklinik">
<span<?php echo $purchaseorder_list->idklinik->viewAttributes() ?>><?php echo $purchaseorder_list->idklinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchaseorder_list->id_supplier->Visible) { // id_supplier ?>
		<td data-name="id_supplier" <?php echo $purchaseorder_list->id_supplier->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_list->RowCount ?>_purchaseorder_id_supplier">
<span<?php echo $purchaseorder_list->id_supplier->viewAttributes() ?>><?php echo $purchaseorder_list->id_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchaseorder_list->status_po->Visible) { // status_po ?>
		<td data-name="status_po" <?php echo $purchaseorder_list->status_po->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_list->RowCount ?>_purchaseorder_status_po">
<span<?php echo $purchaseorder_list->status_po->viewAttributes() ?>><?php echo $purchaseorder_list->status_po->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($purchaseorder_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $purchaseorder_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $purchaseorder_list->RowCount ?>_purchaseorder_keterangan">
<span<?php echo $purchaseorder_list->keterangan->viewAttributes() ?>><?php echo $purchaseorder_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$purchaseorder_list->ListOptions->render("body", "right", $purchaseorder_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$purchaseorder_list->isGridAdd())
		$purchaseorder_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$purchaseorder->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($purchaseorder_list->Recordset)
	$purchaseorder_list->Recordset->Close();
?>
<?php if (!$purchaseorder_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$purchaseorder_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $purchaseorder_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $purchaseorder_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($purchaseorder_list->TotalRecords == 0 && !$purchaseorder->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $purchaseorder_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$purchaseorder_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$purchaseorder_list->isExport()) { ?>
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
$purchaseorder_list->terminate();
?>