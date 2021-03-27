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
$nonjual_list = new nonjual_list();

// Run the page
$nonjual_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nonjual_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$nonjual_list->isExport()) { ?>
<script>
var fnonjuallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnonjuallist = currentForm = new ew.Form("fnonjuallist", "list");
	fnonjuallist.formKeyCountName = '<?php echo $nonjual_list->FormKeyCountName ?>';
	loadjs.done("fnonjuallist");
});
var fnonjuallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fnonjuallistsrch = currentSearchForm = new ew.Form("fnonjuallistsrch");

	// Dynamic selection lists
	// Filters

	fnonjuallistsrch.filterList = <?php echo $nonjual_list->getFilterList() ?>;
	loadjs.done("fnonjuallistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","nonjualadd.php?showdetail=detail_nonjual"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide();
});
</script>
<?php } ?>
<?php if (!$nonjual_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($nonjual_list->TotalRecords > 0 && $nonjual_list->ExportOptions->visible()) { ?>
<?php $nonjual_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($nonjual_list->ImportOptions->visible()) { ?>
<?php $nonjual_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($nonjual_list->SearchOptions->visible()) { ?>
<?php $nonjual_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($nonjual_list->FilterOptions->visible()) { ?>
<?php $nonjual_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$nonjual_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$nonjual_list->isExport() && !$nonjual->CurrentAction) { ?>
<form name="fnonjuallistsrch" id="fnonjuallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fnonjuallistsrch-search-panel" class="<?php echo $nonjual_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="nonjual">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $nonjual_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($nonjual_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($nonjual_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $nonjual_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($nonjual_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($nonjual_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($nonjual_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($nonjual_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $nonjual_list->showPageHeader(); ?>
<?php
$nonjual_list->showMessage();
?>
<?php if ($nonjual_list->TotalRecords > 0 || $nonjual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($nonjual_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> nonjual">
<?php if (!$nonjual_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$nonjual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nonjual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nonjual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnonjuallist" id="fnonjuallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nonjual">
<div id="gmp_nonjual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($nonjual_list->TotalRecords > 0 || $nonjual_list->isGridEdit()) { ?>
<table id="tbl_nonjuallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$nonjual->RowType = ROWTYPE_HEADER;

// Render list options
$nonjual_list->renderListOptions();

// Render list options (header, left)
$nonjual_list->ListOptions->render("header", "left");
?>
<?php if ($nonjual_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($nonjual_list->SortUrl($nonjual_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $nonjual_list->id_klinik->headerCellClass() ?>"><div id="elh_nonjual_id_klinik" class="nonjual_id_klinik"><div class="ew-table-header-caption"><?php echo $nonjual_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $nonjual_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nonjual_list->SortUrl($nonjual_list->id_klinik) ?>', 1);"><div id="elh_nonjual_id_klinik" class="nonjual_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nonjual_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($nonjual_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nonjual_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nonjual_list->tanggal->Visible) { // tanggal ?>
	<?php if ($nonjual_list->SortUrl($nonjual_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $nonjual_list->tanggal->headerCellClass() ?>"><div id="elh_nonjual_tanggal" class="nonjual_tanggal"><div class="ew-table-header-caption"><?php echo $nonjual_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $nonjual_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nonjual_list->SortUrl($nonjual_list->tanggal) ?>', 1);"><div id="elh_nonjual_tanggal" class="nonjual_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nonjual_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($nonjual_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nonjual_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nonjual_list->keterangan->Visible) { // keterangan ?>
	<?php if ($nonjual_list->SortUrl($nonjual_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $nonjual_list->keterangan->headerCellClass() ?>"><div id="elh_nonjual_keterangan" class="nonjual_keterangan"><div class="ew-table-header-caption"><?php echo $nonjual_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $nonjual_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nonjual_list->SortUrl($nonjual_list->keterangan) ?>', 1);"><div id="elh_nonjual_keterangan" class="nonjual_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nonjual_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nonjual_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nonjual_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$nonjual_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($nonjual_list->ExportAll && $nonjual_list->isExport()) {
	$nonjual_list->StopRecord = $nonjual_list->TotalRecords;
} else {

	// Set the last record to display
	if ($nonjual_list->TotalRecords > $nonjual_list->StartRecord + $nonjual_list->DisplayRecords - 1)
		$nonjual_list->StopRecord = $nonjual_list->StartRecord + $nonjual_list->DisplayRecords - 1;
	else
		$nonjual_list->StopRecord = $nonjual_list->TotalRecords;
}
$nonjual_list->RecordCount = $nonjual_list->StartRecord - 1;
if ($nonjual_list->Recordset && !$nonjual_list->Recordset->EOF) {
	$nonjual_list->Recordset->moveFirst();
	$selectLimit = $nonjual_list->UseSelectLimit;
	if (!$selectLimit && $nonjual_list->StartRecord > 1)
		$nonjual_list->Recordset->move($nonjual_list->StartRecord - 1);
} elseif (!$nonjual->AllowAddDeleteRow && $nonjual_list->StopRecord == 0) {
	$nonjual_list->StopRecord = $nonjual->GridAddRowCount;
}

// Initialize aggregate
$nonjual->RowType = ROWTYPE_AGGREGATEINIT;
$nonjual->resetAttributes();
$nonjual_list->renderRow();
while ($nonjual_list->RecordCount < $nonjual_list->StopRecord) {
	$nonjual_list->RecordCount++;
	if ($nonjual_list->RecordCount >= $nonjual_list->StartRecord) {
		$nonjual_list->RowCount++;

		// Set up key count
		$nonjual_list->KeyCount = $nonjual_list->RowIndex;

		// Init row class and style
		$nonjual->resetAttributes();
		$nonjual->CssClass = "";
		if ($nonjual_list->isGridAdd()) {
		} else {
			$nonjual_list->loadRowValues($nonjual_list->Recordset); // Load row values
		}
		$nonjual->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$nonjual->RowAttrs->merge(["data-rowindex" => $nonjual_list->RowCount, "id" => "r" . $nonjual_list->RowCount . "_nonjual", "data-rowtype" => $nonjual->RowType]);

		// Render row
		$nonjual_list->renderRow();

		// Render list options
		$nonjual_list->renderListOptions();
?>
	<tr <?php echo $nonjual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$nonjual_list->ListOptions->render("body", "left", $nonjual_list->RowCount);
?>
	<?php if ($nonjual_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $nonjual_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $nonjual_list->RowCount ?>_nonjual_id_klinik">
<span<?php echo $nonjual_list->id_klinik->viewAttributes() ?>><?php echo $nonjual_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nonjual_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $nonjual_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $nonjual_list->RowCount ?>_nonjual_tanggal">
<span<?php echo $nonjual_list->tanggal->viewAttributes() ?>><?php echo $nonjual_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nonjual_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $nonjual_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $nonjual_list->RowCount ?>_nonjual_keterangan">
<span<?php echo $nonjual_list->keterangan->viewAttributes() ?>><?php echo $nonjual_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nonjual_list->ListOptions->render("body", "right", $nonjual_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$nonjual_list->isGridAdd())
		$nonjual_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$nonjual->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($nonjual_list->Recordset)
	$nonjual_list->Recordset->Close();
?>
<?php if (!$nonjual_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$nonjual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nonjual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nonjual_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($nonjual_list->TotalRecords == 0 && !$nonjual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $nonjual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$nonjual_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$nonjual_list->isExport()) { ?>
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
$nonjual_list->terminate();
?>