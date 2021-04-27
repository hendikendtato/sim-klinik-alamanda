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
$wp_terapis_list = new wp_terapis_list();

// Run the page
$wp_terapis_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$wp_terapis_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$wp_terapis_list->isExport()) { ?>
<script>
var fwp_terapislist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fwp_terapislist = currentForm = new ew.Form("fwp_terapislist", "list");
	fwp_terapislist.formKeyCountName = '<?php echo $wp_terapis_list->FormKeyCountName ?>';
	loadjs.done("fwp_terapislist");
});
var fwp_terapislistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fwp_terapislistsrch = currentSearchForm = new ew.Form("fwp_terapislistsrch");

	// Dynamic selection lists
	// Filters

	fwp_terapislistsrch.filterList = <?php echo $wp_terapis_list->getFilterList() ?>;
	loadjs.done("fwp_terapislistsrch");
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
<?php if (!$wp_terapis_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($wp_terapis_list->TotalRecords > 0 && $wp_terapis_list->ExportOptions->visible()) { ?>
<?php $wp_terapis_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($wp_terapis_list->ImportOptions->visible()) { ?>
<?php $wp_terapis_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($wp_terapis_list->SearchOptions->visible()) { ?>
<?php $wp_terapis_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($wp_terapis_list->FilterOptions->visible()) { ?>
<?php $wp_terapis_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$wp_terapis_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$wp_terapis_list->isExport() && !$wp_terapis->CurrentAction) { ?>
<form name="fwp_terapislistsrch" id="fwp_terapislistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fwp_terapislistsrch-search-panel" class="<?php echo $wp_terapis_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="wp_terapis">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $wp_terapis_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($wp_terapis_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($wp_terapis_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $wp_terapis_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($wp_terapis_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($wp_terapis_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($wp_terapis_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($wp_terapis_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $wp_terapis_list->showPageHeader(); ?>
<?php
$wp_terapis_list->showMessage();
?>
<?php if ($wp_terapis_list->TotalRecords > 0 || $wp_terapis->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($wp_terapis_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> wp_terapis">
<?php if (!$wp_terapis_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$wp_terapis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $wp_terapis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $wp_terapis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fwp_terapislist" id="fwp_terapislist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="wp_terapis">
<div id="gmp_wp_terapis" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($wp_terapis_list->TotalRecords > 0 || $wp_terapis_list->isGridEdit()) { ?>
<table id="tbl_wp_terapislist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$wp_terapis->RowType = ROWTYPE_HEADER;

// Render list options
$wp_terapis_list->renderListOptions();

// Render list options (header, left)
$wp_terapis_list->ListOptions->render("header", "left");
?>
<?php if ($wp_terapis_list->id->Visible) { // id ?>
	<?php if ($wp_terapis_list->SortUrl($wp_terapis_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $wp_terapis_list->id->headerCellClass() ?>"><div id="elh_wp_terapis_id" class="wp_terapis_id"><div class="ew-table-header-caption"><?php echo $wp_terapis_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $wp_terapis_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_terapis_list->SortUrl($wp_terapis_list->id) ?>', 1);"><div id="elh_wp_terapis_id" class="wp_terapis_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_terapis_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($wp_terapis_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_terapis_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_terapis_list->nama->Visible) { // nama ?>
	<?php if ($wp_terapis_list->SortUrl($wp_terapis_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $wp_terapis_list->nama->headerCellClass() ?>"><div id="elh_wp_terapis_nama" class="wp_terapis_nama"><div class="ew-table-header-caption"><?php echo $wp_terapis_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $wp_terapis_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_terapis_list->SortUrl($wp_terapis_list->nama) ?>', 1);"><div id="elh_wp_terapis_nama" class="wp_terapis_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_terapis_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_terapis_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_terapis_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_terapis_list->_email->Visible) { // email ?>
	<?php if ($wp_terapis_list->SortUrl($wp_terapis_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $wp_terapis_list->_email->headerCellClass() ?>"><div id="elh_wp_terapis__email" class="wp_terapis__email"><div class="ew-table-header-caption"><?php echo $wp_terapis_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $wp_terapis_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_terapis_list->SortUrl($wp_terapis_list->_email) ?>', 1);"><div id="elh_wp_terapis__email" class="wp_terapis__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_terapis_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_terapis_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_terapis_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($wp_terapis_list->no_telp->Visible) { // no_telp ?>
	<?php if ($wp_terapis_list->SortUrl($wp_terapis_list->no_telp) == "") { ?>
		<th data-name="no_telp" class="<?php echo $wp_terapis_list->no_telp->headerCellClass() ?>"><div id="elh_wp_terapis_no_telp" class="wp_terapis_no_telp"><div class="ew-table-header-caption"><?php echo $wp_terapis_list->no_telp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_telp" class="<?php echo $wp_terapis_list->no_telp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $wp_terapis_list->SortUrl($wp_terapis_list->no_telp) ?>', 1);"><div id="elh_wp_terapis_no_telp" class="wp_terapis_no_telp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $wp_terapis_list->no_telp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($wp_terapis_list->no_telp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($wp_terapis_list->no_telp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$wp_terapis_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($wp_terapis_list->ExportAll && $wp_terapis_list->isExport()) {
	$wp_terapis_list->StopRecord = $wp_terapis_list->TotalRecords;
} else {

	// Set the last record to display
	if ($wp_terapis_list->TotalRecords > $wp_terapis_list->StartRecord + $wp_terapis_list->DisplayRecords - 1)
		$wp_terapis_list->StopRecord = $wp_terapis_list->StartRecord + $wp_terapis_list->DisplayRecords - 1;
	else
		$wp_terapis_list->StopRecord = $wp_terapis_list->TotalRecords;
}
$wp_terapis_list->RecordCount = $wp_terapis_list->StartRecord - 1;
if ($wp_terapis_list->Recordset && !$wp_terapis_list->Recordset->EOF) {
	$wp_terapis_list->Recordset->moveFirst();
	$selectLimit = $wp_terapis_list->UseSelectLimit;
	if (!$selectLimit && $wp_terapis_list->StartRecord > 1)
		$wp_terapis_list->Recordset->move($wp_terapis_list->StartRecord - 1);
} elseif (!$wp_terapis->AllowAddDeleteRow && $wp_terapis_list->StopRecord == 0) {
	$wp_terapis_list->StopRecord = $wp_terapis->GridAddRowCount;
}

// Initialize aggregate
$wp_terapis->RowType = ROWTYPE_AGGREGATEINIT;
$wp_terapis->resetAttributes();
$wp_terapis_list->renderRow();
while ($wp_terapis_list->RecordCount < $wp_terapis_list->StopRecord) {
	$wp_terapis_list->RecordCount++;
	if ($wp_terapis_list->RecordCount >= $wp_terapis_list->StartRecord) {
		$wp_terapis_list->RowCount++;

		// Set up key count
		$wp_terapis_list->KeyCount = $wp_terapis_list->RowIndex;

		// Init row class and style
		$wp_terapis->resetAttributes();
		$wp_terapis->CssClass = "";
		if ($wp_terapis_list->isGridAdd()) {
		} else {
			$wp_terapis_list->loadRowValues($wp_terapis_list->Recordset); // Load row values
		}
		$wp_terapis->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$wp_terapis->RowAttrs->merge(["data-rowindex" => $wp_terapis_list->RowCount, "id" => "r" . $wp_terapis_list->RowCount . "_wp_terapis", "data-rowtype" => $wp_terapis->RowType]);

		// Render row
		$wp_terapis_list->renderRow();

		// Render list options
		$wp_terapis_list->renderListOptions();
?>
	<tr <?php echo $wp_terapis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$wp_terapis_list->ListOptions->render("body", "left", $wp_terapis_list->RowCount);
?>
	<?php if ($wp_terapis_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $wp_terapis_list->id->cellAttributes() ?>>
<span id="el<?php echo $wp_terapis_list->RowCount ?>_wp_terapis_id">
<span<?php echo $wp_terapis_list->id->viewAttributes() ?>><?php echo $wp_terapis_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_terapis_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $wp_terapis_list->nama->cellAttributes() ?>>
<span id="el<?php echo $wp_terapis_list->RowCount ?>_wp_terapis_nama">
<span<?php echo $wp_terapis_list->nama->viewAttributes() ?>><?php echo $wp_terapis_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_terapis_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $wp_terapis_list->_email->cellAttributes() ?>>
<span id="el<?php echo $wp_terapis_list->RowCount ?>_wp_terapis__email">
<span<?php echo $wp_terapis_list->_email->viewAttributes() ?>><?php echo $wp_terapis_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($wp_terapis_list->no_telp->Visible) { // no_telp ?>
		<td data-name="no_telp" <?php echo $wp_terapis_list->no_telp->cellAttributes() ?>>
<span id="el<?php echo $wp_terapis_list->RowCount ?>_wp_terapis_no_telp">
<span<?php echo $wp_terapis_list->no_telp->viewAttributes() ?>><?php echo $wp_terapis_list->no_telp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$wp_terapis_list->ListOptions->render("body", "right", $wp_terapis_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$wp_terapis_list->isGridAdd())
		$wp_terapis_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$wp_terapis->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($wp_terapis_list->Recordset)
	$wp_terapis_list->Recordset->Close();
?>
<?php if (!$wp_terapis_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$wp_terapis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $wp_terapis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $wp_terapis_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($wp_terapis_list->TotalRecords == 0 && !$wp_terapis->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $wp_terapis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$wp_terapis_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$wp_terapis_list->isExport()) { ?>
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
$wp_terapis_list->terminate();
?>