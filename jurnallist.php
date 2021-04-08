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
$jurnal_list = new jurnal_list();

// Run the page
$jurnal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jurnal_list->isExport()) { ?>
<script>
var fjurnallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjurnallist = currentForm = new ew.Form("fjurnallist", "list");
	fjurnallist.formKeyCountName = '<?php echo $jurnal_list->FormKeyCountName ?>';
	loadjs.done("fjurnallist");
});
var fjurnallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjurnallistsrch = currentSearchForm = new ew.Form("fjurnallistsrch");

	// Dynamic selection lists
	// Filters

	fjurnallistsrch.filterList = <?php echo $jurnal_list->getFilterList() ?>;
	loadjs.done("fjurnallistsrch");
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
<?php if (!$jurnal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jurnal_list->TotalRecords > 0 && $jurnal_list->ExportOptions->visible()) { ?>
<?php $jurnal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jurnal_list->ImportOptions->visible()) { ?>
<?php $jurnal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jurnal_list->SearchOptions->visible()) { ?>
<?php $jurnal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jurnal_list->FilterOptions->visible()) { ?>
<?php $jurnal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jurnal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jurnal_list->isExport() && !$jurnal->CurrentAction) { ?>
<form name="fjurnallistsrch" id="fjurnallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjurnallistsrch-search-panel" class="<?php echo $jurnal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jurnal">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jurnal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jurnal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jurnal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jurnal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jurnal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jurnal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jurnal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jurnal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jurnal_list->showPageHeader(); ?>
<?php
$jurnal_list->showMessage();
?>
<?php if ($jurnal_list->TotalRecords > 0 || $jurnal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jurnal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jurnal">
<?php if (!$jurnal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jurnal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jurnal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jurnal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjurnallist" id="fjurnallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<div id="gmp_jurnal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jurnal_list->TotalRecords > 0 || $jurnal_list->isGridEdit()) { ?>
<table id="tbl_jurnallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jurnal->RowType = ROWTYPE_HEADER;

// Render list options
$jurnal_list->renderListOptions();

// Render list options (header, left)
$jurnal_list->ListOptions->render("header", "left");
?>
<?php if ($jurnal_list->id_jurnal->Visible) { // id_jurnal ?>
	<?php if ($jurnal_list->SortUrl($jurnal_list->id_jurnal) == "") { ?>
		<th data-name="id_jurnal" class="<?php echo $jurnal_list->id_jurnal->headerCellClass() ?>"><div id="elh_jurnal_id_jurnal" class="jurnal_id_jurnal"><div class="ew-table-header-caption"><?php echo $jurnal_list->id_jurnal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jurnal" class="<?php echo $jurnal_list->id_jurnal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jurnal_list->SortUrl($jurnal_list->id_jurnal) ?>', 1);"><div id="elh_jurnal_id_jurnal" class="jurnal_id_jurnal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jurnal_list->id_jurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($jurnal_list->id_jurnal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jurnal_list->id_jurnal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jurnal_list->tgl_jurnal->Visible) { // tgl_jurnal ?>
	<?php if ($jurnal_list->SortUrl($jurnal_list->tgl_jurnal) == "") { ?>
		<th data-name="tgl_jurnal" class="<?php echo $jurnal_list->tgl_jurnal->headerCellClass() ?>"><div id="elh_jurnal_tgl_jurnal" class="jurnal_tgl_jurnal"><div class="ew-table-header-caption"><?php echo $jurnal_list->tgl_jurnal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_jurnal" class="<?php echo $jurnal_list->tgl_jurnal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jurnal_list->SortUrl($jurnal_list->tgl_jurnal) ?>', 1);"><div id="elh_jurnal_tgl_jurnal" class="jurnal_tgl_jurnal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jurnal_list->tgl_jurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($jurnal_list->tgl_jurnal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jurnal_list->tgl_jurnal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jurnal_list->keterangan->Visible) { // keterangan ?>
	<?php if ($jurnal_list->SortUrl($jurnal_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $jurnal_list->keterangan->headerCellClass() ?>"><div id="elh_jurnal_keterangan" class="jurnal_keterangan"><div class="ew-table-header-caption"><?php echo $jurnal_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $jurnal_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jurnal_list->SortUrl($jurnal_list->keterangan) ?>', 1);"><div id="elh_jurnal_keterangan" class="jurnal_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jurnal_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jurnal_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jurnal_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jurnal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jurnal_list->ExportAll && $jurnal_list->isExport()) {
	$jurnal_list->StopRecord = $jurnal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jurnal_list->TotalRecords > $jurnal_list->StartRecord + $jurnal_list->DisplayRecords - 1)
		$jurnal_list->StopRecord = $jurnal_list->StartRecord + $jurnal_list->DisplayRecords - 1;
	else
		$jurnal_list->StopRecord = $jurnal_list->TotalRecords;
}
$jurnal_list->RecordCount = $jurnal_list->StartRecord - 1;
if ($jurnal_list->Recordset && !$jurnal_list->Recordset->EOF) {
	$jurnal_list->Recordset->moveFirst();
	$selectLimit = $jurnal_list->UseSelectLimit;
	if (!$selectLimit && $jurnal_list->StartRecord > 1)
		$jurnal_list->Recordset->move($jurnal_list->StartRecord - 1);
} elseif (!$jurnal->AllowAddDeleteRow && $jurnal_list->StopRecord == 0) {
	$jurnal_list->StopRecord = $jurnal->GridAddRowCount;
}

// Initialize aggregate
$jurnal->RowType = ROWTYPE_AGGREGATEINIT;
$jurnal->resetAttributes();
$jurnal_list->renderRow();
while ($jurnal_list->RecordCount < $jurnal_list->StopRecord) {
	$jurnal_list->RecordCount++;
	if ($jurnal_list->RecordCount >= $jurnal_list->StartRecord) {
		$jurnal_list->RowCount++;

		// Set up key count
		$jurnal_list->KeyCount = $jurnal_list->RowIndex;

		// Init row class and style
		$jurnal->resetAttributes();
		$jurnal->CssClass = "";
		if ($jurnal_list->isGridAdd()) {
		} else {
			$jurnal_list->loadRowValues($jurnal_list->Recordset); // Load row values
		}
		$jurnal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jurnal->RowAttrs->merge(["data-rowindex" => $jurnal_list->RowCount, "id" => "r" . $jurnal_list->RowCount . "_jurnal", "data-rowtype" => $jurnal->RowType]);

		// Render row
		$jurnal_list->renderRow();

		// Render list options
		$jurnal_list->renderListOptions();
?>
	<tr <?php echo $jurnal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jurnal_list->ListOptions->render("body", "left", $jurnal_list->RowCount);
?>
	<?php if ($jurnal_list->id_jurnal->Visible) { // id_jurnal ?>
		<td data-name="id_jurnal" <?php echo $jurnal_list->id_jurnal->cellAttributes() ?>>
<span id="el<?php echo $jurnal_list->RowCount ?>_jurnal_id_jurnal">
<span<?php echo $jurnal_list->id_jurnal->viewAttributes() ?>><?php echo $jurnal_list->id_jurnal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jurnal_list->tgl_jurnal->Visible) { // tgl_jurnal ?>
		<td data-name="tgl_jurnal" <?php echo $jurnal_list->tgl_jurnal->cellAttributes() ?>>
<span id="el<?php echo $jurnal_list->RowCount ?>_jurnal_tgl_jurnal">
<span<?php echo $jurnal_list->tgl_jurnal->viewAttributes() ?>><?php echo $jurnal_list->tgl_jurnal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jurnal_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $jurnal_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $jurnal_list->RowCount ?>_jurnal_keterangan">
<span<?php echo $jurnal_list->keterangan->viewAttributes() ?>><?php echo $jurnal_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jurnal_list->ListOptions->render("body", "right", $jurnal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jurnal_list->isGridAdd())
		$jurnal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jurnal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jurnal_list->Recordset)
	$jurnal_list->Recordset->Close();
?>
<?php if (!$jurnal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jurnal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jurnal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jurnal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jurnal_list->TotalRecords == 0 && !$jurnal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jurnal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jurnal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jurnal_list->isExport()) { ?>
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
$jurnal_list->terminate();
?>