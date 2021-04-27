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
$m_bank_list = new m_bank_list();

// Run the page
$m_bank_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_bank_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_bank_list->isExport()) { ?>
<script>
var fm_banklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_banklist = currentForm = new ew.Form("fm_banklist", "list");
	fm_banklist.formKeyCountName = '<?php echo $m_bank_list->FormKeyCountName ?>';
	loadjs.done("fm_banklist");
});
var fm_banklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_banklistsrch = currentSearchForm = new ew.Form("fm_banklistsrch");

	// Dynamic selection lists
	// Filters

	fm_banklistsrch.filterList = <?php echo $m_bank_list->getFilterList() ?>;
	loadjs.done("fm_banklistsrch");
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
<?php if (!$m_bank_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_bank_list->TotalRecords > 0 && $m_bank_list->ExportOptions->visible()) { ?>
<?php $m_bank_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_bank_list->ImportOptions->visible()) { ?>
<?php $m_bank_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_bank_list->SearchOptions->visible()) { ?>
<?php $m_bank_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_bank_list->FilterOptions->visible()) { ?>
<?php $m_bank_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_bank_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_bank_list->isExport() && !$m_bank->CurrentAction) { ?>
<form name="fm_banklistsrch" id="fm_banklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_banklistsrch-search-panel" class="<?php echo $m_bank_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_bank">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_bank_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_bank_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_bank_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_bank_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_bank_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_bank_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_bank_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_bank_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_bank_list->showPageHeader(); ?>
<?php
$m_bank_list->showMessage();
?>
<?php if ($m_bank_list->TotalRecords > 0 || $m_bank->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_bank_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_bank">
<?php if (!$m_bank_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_bank_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_bank_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_bank_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_banklist" id="fm_banklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_bank">
<div id="gmp_m_bank" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_bank_list->TotalRecords > 0 || $m_bank_list->isGridEdit()) { ?>
<table id="tbl_m_banklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_bank->RowType = ROWTYPE_HEADER;

// Render list options
$m_bank_list->renderListOptions();

// Render list options (header, left)
$m_bank_list->ListOptions->render("header", "left");
?>
<?php if ($m_bank_list->id_bank->Visible) { // id_bank ?>
	<?php if ($m_bank_list->SortUrl($m_bank_list->id_bank) == "") { ?>
		<th data-name="id_bank" class="<?php echo $m_bank_list->id_bank->headerCellClass() ?>"><div id="elh_m_bank_id_bank" class="m_bank_id_bank"><div class="ew-table-header-caption"><?php echo $m_bank_list->id_bank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_bank" class="<?php echo $m_bank_list->id_bank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_bank_list->SortUrl($m_bank_list->id_bank) ?>', 1);"><div id="elh_m_bank_id_bank" class="m_bank_id_bank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_bank_list->id_bank->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_bank_list->id_bank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_bank_list->id_bank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_bank_list->nama_bank->Visible) { // nama_bank ?>
	<?php if ($m_bank_list->SortUrl($m_bank_list->nama_bank) == "") { ?>
		<th data-name="nama_bank" class="<?php echo $m_bank_list->nama_bank->headerCellClass() ?>"><div id="elh_m_bank_nama_bank" class="m_bank_nama_bank"><div class="ew-table-header-caption"><?php echo $m_bank_list->nama_bank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_bank" class="<?php echo $m_bank_list->nama_bank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_bank_list->SortUrl($m_bank_list->nama_bank) ?>', 1);"><div id="elh_m_bank_nama_bank" class="m_bank_nama_bank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_bank_list->nama_bank->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_bank_list->nama_bank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_bank_list->nama_bank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_bank_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_bank_list->ExportAll && $m_bank_list->isExport()) {
	$m_bank_list->StopRecord = $m_bank_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_bank_list->TotalRecords > $m_bank_list->StartRecord + $m_bank_list->DisplayRecords - 1)
		$m_bank_list->StopRecord = $m_bank_list->StartRecord + $m_bank_list->DisplayRecords - 1;
	else
		$m_bank_list->StopRecord = $m_bank_list->TotalRecords;
}
$m_bank_list->RecordCount = $m_bank_list->StartRecord - 1;
if ($m_bank_list->Recordset && !$m_bank_list->Recordset->EOF) {
	$m_bank_list->Recordset->moveFirst();
	$selectLimit = $m_bank_list->UseSelectLimit;
	if (!$selectLimit && $m_bank_list->StartRecord > 1)
		$m_bank_list->Recordset->move($m_bank_list->StartRecord - 1);
} elseif (!$m_bank->AllowAddDeleteRow && $m_bank_list->StopRecord == 0) {
	$m_bank_list->StopRecord = $m_bank->GridAddRowCount;
}

// Initialize aggregate
$m_bank->RowType = ROWTYPE_AGGREGATEINIT;
$m_bank->resetAttributes();
$m_bank_list->renderRow();
while ($m_bank_list->RecordCount < $m_bank_list->StopRecord) {
	$m_bank_list->RecordCount++;
	if ($m_bank_list->RecordCount >= $m_bank_list->StartRecord) {
		$m_bank_list->RowCount++;

		// Set up key count
		$m_bank_list->KeyCount = $m_bank_list->RowIndex;

		// Init row class and style
		$m_bank->resetAttributes();
		$m_bank->CssClass = "";
		if ($m_bank_list->isGridAdd()) {
		} else {
			$m_bank_list->loadRowValues($m_bank_list->Recordset); // Load row values
		}
		$m_bank->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_bank->RowAttrs->merge(["data-rowindex" => $m_bank_list->RowCount, "id" => "r" . $m_bank_list->RowCount . "_m_bank", "data-rowtype" => $m_bank->RowType]);

		// Render row
		$m_bank_list->renderRow();

		// Render list options
		$m_bank_list->renderListOptions();
?>
	<tr <?php echo $m_bank->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_bank_list->ListOptions->render("body", "left", $m_bank_list->RowCount);
?>
	<?php if ($m_bank_list->id_bank->Visible) { // id_bank ?>
		<td data-name="id_bank" <?php echo $m_bank_list->id_bank->cellAttributes() ?>>
<span id="el<?php echo $m_bank_list->RowCount ?>_m_bank_id_bank">
<span<?php echo $m_bank_list->id_bank->viewAttributes() ?>><?php echo $m_bank_list->id_bank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_bank_list->nama_bank->Visible) { // nama_bank ?>
		<td data-name="nama_bank" <?php echo $m_bank_list->nama_bank->cellAttributes() ?>>
<span id="el<?php echo $m_bank_list->RowCount ?>_m_bank_nama_bank">
<span<?php echo $m_bank_list->nama_bank->viewAttributes() ?>><?php echo $m_bank_list->nama_bank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_bank_list->ListOptions->render("body", "right", $m_bank_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_bank_list->isGridAdd())
		$m_bank_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_bank->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_bank_list->Recordset)
	$m_bank_list->Recordset->Close();
?>
<?php if (!$m_bank_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_bank_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_bank_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_bank_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_bank_list->TotalRecords == 0 && !$m_bank->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_bank_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_bank_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_bank_list->isExport()) { ?>
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
$m_bank_list->terminate();
?>