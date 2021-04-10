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
$penyesuaian_poin_list = new penyesuaian_poin_list();

// Run the page
$penyesuaian_poin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaian_poin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penyesuaian_poin_list->isExport()) { ?>
<script>
var fpenyesuaian_poinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenyesuaian_poinlist = currentForm = new ew.Form("fpenyesuaian_poinlist", "list");
	fpenyesuaian_poinlist.formKeyCountName = '<?php echo $penyesuaian_poin_list->FormKeyCountName ?>';
	loadjs.done("fpenyesuaian_poinlist");
});
var fpenyesuaian_poinlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenyesuaian_poinlistsrch = currentSearchForm = new ew.Form("fpenyesuaian_poinlistsrch");

	// Dynamic selection lists
	// Filters

	fpenyesuaian_poinlistsrch.filterList = <?php echo $penyesuaian_poin_list->getFilterList() ?>;
	loadjs.done("fpenyesuaian_poinlistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","penyesuaian_poinadd.php?showdetail=detailpenyesuaianpoin"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide();
});
</script>
<?php } ?>
<?php if (!$penyesuaian_poin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penyesuaian_poin_list->TotalRecords > 0 && $penyesuaian_poin_list->ExportOptions->visible()) { ?>
<?php $penyesuaian_poin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penyesuaian_poin_list->ImportOptions->visible()) { ?>
<?php $penyesuaian_poin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penyesuaian_poin_list->SearchOptions->visible()) { ?>
<?php $penyesuaian_poin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penyesuaian_poin_list->FilterOptions->visible()) { ?>
<?php $penyesuaian_poin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penyesuaian_poin_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$penyesuaian_poin_list->isExport() && !$penyesuaian_poin->CurrentAction) { ?>
<form name="fpenyesuaian_poinlistsrch" id="fpenyesuaian_poinlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpenyesuaian_poinlistsrch-search-panel" class="<?php echo $penyesuaian_poin_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penyesuaian_poin">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $penyesuaian_poin_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($penyesuaian_poin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($penyesuaian_poin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $penyesuaian_poin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($penyesuaian_poin_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($penyesuaian_poin_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($penyesuaian_poin_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($penyesuaian_poin_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $penyesuaian_poin_list->showPageHeader(); ?>
<?php
$penyesuaian_poin_list->showMessage();
?>
<?php if ($penyesuaian_poin_list->TotalRecords > 0 || $penyesuaian_poin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penyesuaian_poin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penyesuaian_poin">
<?php if (!$penyesuaian_poin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$penyesuaian_poin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penyesuaian_poin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penyesuaian_poin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpenyesuaian_poinlist" id="fpenyesuaian_poinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaian_poin">
<div id="gmp_penyesuaian_poin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penyesuaian_poin_list->TotalRecords > 0 || $penyesuaian_poin_list->isGridEdit()) { ?>
<table id="tbl_penyesuaian_poinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penyesuaian_poin->RowType = ROWTYPE_HEADER;

// Render list options
$penyesuaian_poin_list->renderListOptions();

// Render list options (header, left)
$penyesuaian_poin_list->ListOptions->render("header", "left");
?>
<?php if ($penyesuaian_poin_list->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
	<?php if ($penyesuaian_poin_list->SortUrl($penyesuaian_poin_list->kode_penyesuaianpoin) == "") { ?>
		<th data-name="kode_penyesuaianpoin" class="<?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->headerCellClass() ?>"><div id="elh_penyesuaian_poin_kode_penyesuaianpoin" class="penyesuaian_poin_kode_penyesuaianpoin"><div class="ew-table-header-caption"><?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penyesuaianpoin" class="<?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaian_poin_list->SortUrl($penyesuaian_poin_list->kode_penyesuaianpoin) ?>', 1);"><div id="elh_penyesuaian_poin_kode_penyesuaianpoin" class="penyesuaian_poin_kode_penyesuaianpoin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penyesuaian_poin_list->kode_penyesuaianpoin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaian_poin_list->kode_penyesuaianpoin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penyesuaian_poin_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($penyesuaian_poin_list->SortUrl($penyesuaian_poin_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $penyesuaian_poin_list->id_klinik->headerCellClass() ?>"><div id="elh_penyesuaian_poin_id_klinik" class="penyesuaian_poin_id_klinik"><div class="ew-table-header-caption"><?php echo $penyesuaian_poin_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $penyesuaian_poin_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaian_poin_list->SortUrl($penyesuaian_poin_list->id_klinik) ?>', 1);"><div id="elh_penyesuaian_poin_id_klinik" class="penyesuaian_poin_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaian_poin_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($penyesuaian_poin_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaian_poin_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penyesuaian_poin_list->tgl->Visible) { // tgl ?>
	<?php if ($penyesuaian_poin_list->SortUrl($penyesuaian_poin_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $penyesuaian_poin_list->tgl->headerCellClass() ?>"><div id="elh_penyesuaian_poin_tgl" class="penyesuaian_poin_tgl"><div class="ew-table-header-caption"><?php echo $penyesuaian_poin_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $penyesuaian_poin_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penyesuaian_poin_list->SortUrl($penyesuaian_poin_list->tgl) ?>', 1);"><div id="elh_penyesuaian_poin_tgl" class="penyesuaian_poin_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penyesuaian_poin_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($penyesuaian_poin_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penyesuaian_poin_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penyesuaian_poin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penyesuaian_poin_list->ExportAll && $penyesuaian_poin_list->isExport()) {
	$penyesuaian_poin_list->StopRecord = $penyesuaian_poin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penyesuaian_poin_list->TotalRecords > $penyesuaian_poin_list->StartRecord + $penyesuaian_poin_list->DisplayRecords - 1)
		$penyesuaian_poin_list->StopRecord = $penyesuaian_poin_list->StartRecord + $penyesuaian_poin_list->DisplayRecords - 1;
	else
		$penyesuaian_poin_list->StopRecord = $penyesuaian_poin_list->TotalRecords;
}
$penyesuaian_poin_list->RecordCount = $penyesuaian_poin_list->StartRecord - 1;
if ($penyesuaian_poin_list->Recordset && !$penyesuaian_poin_list->Recordset->EOF) {
	$penyesuaian_poin_list->Recordset->moveFirst();
	$selectLimit = $penyesuaian_poin_list->UseSelectLimit;
	if (!$selectLimit && $penyesuaian_poin_list->StartRecord > 1)
		$penyesuaian_poin_list->Recordset->move($penyesuaian_poin_list->StartRecord - 1);
} elseif (!$penyesuaian_poin->AllowAddDeleteRow && $penyesuaian_poin_list->StopRecord == 0) {
	$penyesuaian_poin_list->StopRecord = $penyesuaian_poin->GridAddRowCount;
}

// Initialize aggregate
$penyesuaian_poin->RowType = ROWTYPE_AGGREGATEINIT;
$penyesuaian_poin->resetAttributes();
$penyesuaian_poin_list->renderRow();
while ($penyesuaian_poin_list->RecordCount < $penyesuaian_poin_list->StopRecord) {
	$penyesuaian_poin_list->RecordCount++;
	if ($penyesuaian_poin_list->RecordCount >= $penyesuaian_poin_list->StartRecord) {
		$penyesuaian_poin_list->RowCount++;

		// Set up key count
		$penyesuaian_poin_list->KeyCount = $penyesuaian_poin_list->RowIndex;

		// Init row class and style
		$penyesuaian_poin->resetAttributes();
		$penyesuaian_poin->CssClass = "";
		if ($penyesuaian_poin_list->isGridAdd()) {
		} else {
			$penyesuaian_poin_list->loadRowValues($penyesuaian_poin_list->Recordset); // Load row values
		}
		$penyesuaian_poin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penyesuaian_poin->RowAttrs->merge(["data-rowindex" => $penyesuaian_poin_list->RowCount, "id" => "r" . $penyesuaian_poin_list->RowCount . "_penyesuaian_poin", "data-rowtype" => $penyesuaian_poin->RowType]);

		// Render row
		$penyesuaian_poin_list->renderRow();

		// Render list options
		$penyesuaian_poin_list->renderListOptions();
?>
	<tr <?php echo $penyesuaian_poin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penyesuaian_poin_list->ListOptions->render("body", "left", $penyesuaian_poin_list->RowCount);
?>
	<?php if ($penyesuaian_poin_list->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
		<td data-name="kode_penyesuaianpoin" <?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->cellAttributes() ?>>
<span id="el<?php echo $penyesuaian_poin_list->RowCount ?>_penyesuaian_poin_kode_penyesuaianpoin">
<span<?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->viewAttributes() ?>><?php echo $penyesuaian_poin_list->kode_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penyesuaian_poin_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $penyesuaian_poin_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penyesuaian_poin_list->RowCount ?>_penyesuaian_poin_id_klinik">
<span<?php echo $penyesuaian_poin_list->id_klinik->viewAttributes() ?>><?php echo $penyesuaian_poin_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penyesuaian_poin_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $penyesuaian_poin_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $penyesuaian_poin_list->RowCount ?>_penyesuaian_poin_tgl">
<span<?php echo $penyesuaian_poin_list->tgl->viewAttributes() ?>><?php echo $penyesuaian_poin_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penyesuaian_poin_list->ListOptions->render("body", "right", $penyesuaian_poin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penyesuaian_poin_list->isGridAdd())
		$penyesuaian_poin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penyesuaian_poin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penyesuaian_poin_list->Recordset)
	$penyesuaian_poin_list->Recordset->Close();
?>
<?php if (!$penyesuaian_poin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penyesuaian_poin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penyesuaian_poin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penyesuaian_poin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penyesuaian_poin_list->TotalRecords == 0 && !$penyesuaian_poin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penyesuaian_poin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penyesuaian_poin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penyesuaian_poin_list->isExport()) { ?>
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
$penyesuaian_poin_list->terminate();
?>