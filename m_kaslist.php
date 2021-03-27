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
$m_kas_list = new m_kas_list();

// Run the page
$m_kas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kas_list->isExport()) { ?>
<script>
var fm_kaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_kaslist = currentForm = new ew.Form("fm_kaslist", "list");
	fm_kaslist.formKeyCountName = '<?php echo $m_kas_list->FormKeyCountName ?>';
	loadjs.done("fm_kaslist");
});
var fm_kaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_kaslistsrch = currentSearchForm = new ew.Form("fm_kaslistsrch");

	// Dynamic selection lists
	// Filters

	fm_kaslistsrch.filterList = <?php echo $m_kas_list->getFilterList() ?>;
	loadjs.done("fm_kaslistsrch");
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
<?php if (!$m_kas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_kas_list->TotalRecords > 0 && $m_kas_list->ExportOptions->visible()) { ?>
<?php $m_kas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kas_list->ImportOptions->visible()) { ?>
<?php $m_kas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kas_list->SearchOptions->visible()) { ?>
<?php $m_kas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_kas_list->FilterOptions->visible()) { ?>
<?php $m_kas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_kas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_kas_list->isExport() && !$m_kas->CurrentAction) { ?>
<form name="fm_kaslistsrch" id="fm_kaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_kaslistsrch-search-panel" class="<?php echo $m_kas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_kas">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_kas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_kas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_kas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_kas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_kas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_kas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_kas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_kas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_kas_list->showPageHeader(); ?>
<?php
$m_kas_list->showMessage();
?>
<?php if ($m_kas_list->TotalRecords > 0 || $m_kas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_kas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_kas">
<?php if (!$m_kas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_kas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_kaslist" id="fm_kaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kas">
<div id="gmp_m_kas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_kas_list->TotalRecords > 0 || $m_kas_list->isGridEdit()) { ?>
<table id="tbl_m_kaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_kas->RowType = ROWTYPE_HEADER;

// Render list options
$m_kas_list->renderListOptions();

// Render list options (header, left)
$m_kas_list->ListOptions->render("header", "left");
?>
<?php if ($m_kas_list->id->Visible) { // id ?>
	<?php if ($m_kas_list->SortUrl($m_kas_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_kas_list->id->headerCellClass() ?>"><div id="elh_m_kas_id" class="m_kas_id"><div class="ew-table-header-caption"><?php echo $m_kas_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_kas_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kas_list->SortUrl($m_kas_list->id) ?>', 1);"><div id="elh_m_kas_id" class="m_kas_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kas_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kas_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kas_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kas_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_kas_list->SortUrl($m_kas_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_kas_list->id_klinik->headerCellClass() ?>"><div id="elh_m_kas_id_klinik" class="m_kas_id_klinik"><div class="ew-table-header-caption"><?php echo $m_kas_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_kas_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kas_list->SortUrl($m_kas_list->id_klinik) ?>', 1);"><div id="elh_m_kas_id_klinik" class="m_kas_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kas_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kas_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kas_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kas_list->nama->Visible) { // nama ?>
	<?php if ($m_kas_list->SortUrl($m_kas_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $m_kas_list->nama->headerCellClass() ?>"><div id="elh_m_kas_nama" class="m_kas_nama"><div class="ew-table-header-caption"><?php echo $m_kas_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $m_kas_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kas_list->SortUrl($m_kas_list->nama) ?>', 1);"><div id="elh_m_kas_nama" class="m_kas_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kas_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_kas_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kas_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kas_list->saldo->Visible) { // saldo ?>
	<?php if ($m_kas_list->SortUrl($m_kas_list->saldo) == "") { ?>
		<th data-name="saldo" class="<?php echo $m_kas_list->saldo->headerCellClass() ?>"><div id="elh_m_kas_saldo" class="m_kas_saldo"><div class="ew-table-header-caption"><?php echo $m_kas_list->saldo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="saldo" class="<?php echo $m_kas_list->saldo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kas_list->SortUrl($m_kas_list->saldo) ?>', 1);"><div id="elh_m_kas_saldo" class="m_kas_saldo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kas_list->saldo->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kas_list->saldo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kas_list->saldo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_kas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_kas_list->ExportAll && $m_kas_list->isExport()) {
	$m_kas_list->StopRecord = $m_kas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_kas_list->TotalRecords > $m_kas_list->StartRecord + $m_kas_list->DisplayRecords - 1)
		$m_kas_list->StopRecord = $m_kas_list->StartRecord + $m_kas_list->DisplayRecords - 1;
	else
		$m_kas_list->StopRecord = $m_kas_list->TotalRecords;
}
$m_kas_list->RecordCount = $m_kas_list->StartRecord - 1;
if ($m_kas_list->Recordset && !$m_kas_list->Recordset->EOF) {
	$m_kas_list->Recordset->moveFirst();
	$selectLimit = $m_kas_list->UseSelectLimit;
	if (!$selectLimit && $m_kas_list->StartRecord > 1)
		$m_kas_list->Recordset->move($m_kas_list->StartRecord - 1);
} elseif (!$m_kas->AllowAddDeleteRow && $m_kas_list->StopRecord == 0) {
	$m_kas_list->StopRecord = $m_kas->GridAddRowCount;
}

// Initialize aggregate
$m_kas->RowType = ROWTYPE_AGGREGATEINIT;
$m_kas->resetAttributes();
$m_kas_list->renderRow();
while ($m_kas_list->RecordCount < $m_kas_list->StopRecord) {
	$m_kas_list->RecordCount++;
	if ($m_kas_list->RecordCount >= $m_kas_list->StartRecord) {
		$m_kas_list->RowCount++;

		// Set up key count
		$m_kas_list->KeyCount = $m_kas_list->RowIndex;

		// Init row class and style
		$m_kas->resetAttributes();
		$m_kas->CssClass = "";
		if ($m_kas_list->isGridAdd()) {
		} else {
			$m_kas_list->loadRowValues($m_kas_list->Recordset); // Load row values
		}
		$m_kas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_kas->RowAttrs->merge(["data-rowindex" => $m_kas_list->RowCount, "id" => "r" . $m_kas_list->RowCount . "_m_kas", "data-rowtype" => $m_kas->RowType]);

		// Render row
		$m_kas_list->renderRow();

		// Render list options
		$m_kas_list->renderListOptions();
?>
	<tr <?php echo $m_kas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_kas_list->ListOptions->render("body", "left", $m_kas_list->RowCount);
?>
	<?php if ($m_kas_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_kas_list->id->cellAttributes() ?>>
<span id="el<?php echo $m_kas_list->RowCount ?>_m_kas_id">
<span<?php echo $m_kas_list->id->viewAttributes() ?>><?php echo $m_kas_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kas_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_kas_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_kas_list->RowCount ?>_m_kas_id_klinik">
<span<?php echo $m_kas_list->id_klinik->viewAttributes() ?>><?php echo $m_kas_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kas_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $m_kas_list->nama->cellAttributes() ?>>
<span id="el<?php echo $m_kas_list->RowCount ?>_m_kas_nama">
<span<?php echo $m_kas_list->nama->viewAttributes() ?>><?php echo $m_kas_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kas_list->saldo->Visible) { // saldo ?>
		<td data-name="saldo" <?php echo $m_kas_list->saldo->cellAttributes() ?>>
<span id="el<?php echo $m_kas_list->RowCount ?>_m_kas_saldo">
<span<?php echo $m_kas_list->saldo->viewAttributes() ?>><?php echo $m_kas_list->saldo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_kas_list->ListOptions->render("body", "right", $m_kas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_kas_list->isGridAdd())
		$m_kas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_kas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_kas_list->Recordset)
	$m_kas_list->Recordset->Close();
?>
<?php if (!$m_kas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_kas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_kas_list->TotalRecords == 0 && !$m_kas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_kas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_kas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kas_list->isExport()) { ?>
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
$m_kas_list->terminate();
?>