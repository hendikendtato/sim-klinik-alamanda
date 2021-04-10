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
$m_fee_list = new m_fee_list();

// Run the page
$m_fee_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_fee_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_fee_list->isExport()) { ?>
<script>
var fm_feelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_feelist = currentForm = new ew.Form("fm_feelist", "list");
	fm_feelist.formKeyCountName = '<?php echo $m_fee_list->FormKeyCountName ?>';
	loadjs.done("fm_feelist");
});
var fm_feelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_feelistsrch = currentSearchForm = new ew.Form("fm_feelistsrch");

	// Dynamic selection lists
	// Filters

	fm_feelistsrch.filterList = <?php echo $m_fee_list->getFilterList() ?>;
	loadjs.done("fm_feelistsrch");
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
<?php if (!$m_fee_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_fee_list->TotalRecords > 0 && $m_fee_list->ExportOptions->visible()) { ?>
<?php $m_fee_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_fee_list->ImportOptions->visible()) { ?>
<?php $m_fee_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_fee_list->SearchOptions->visible()) { ?>
<?php $m_fee_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_fee_list->FilterOptions->visible()) { ?>
<?php $m_fee_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_fee_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_fee_list->isExport() && !$m_fee->CurrentAction) { ?>
<form name="fm_feelistsrch" id="fm_feelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_feelistsrch-search-panel" class="<?php echo $m_fee_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_fee">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_fee_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_fee_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_fee_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_fee_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_fee_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_fee_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_fee_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_fee_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_fee_list->showPageHeader(); ?>
<?php
$m_fee_list->showMessage();
?>
<?php if ($m_fee_list->TotalRecords > 0 || $m_fee->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_fee_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_fee">
<?php if (!$m_fee_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_fee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_fee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_fee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_feelist" id="fm_feelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_fee">
<div id="gmp_m_fee" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_fee_list->TotalRecords > 0 || $m_fee_list->isGridEdit()) { ?>
<table id="tbl_m_feelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_fee->RowType = ROWTYPE_HEADER;

// Render list options
$m_fee_list->renderListOptions();

// Render list options (header, left)
$m_fee_list->ListOptions->render("header", "left");
?>
<?php if ($m_fee_list->id_fee->Visible) { // id_fee ?>
	<?php if ($m_fee_list->SortUrl($m_fee_list->id_fee) == "") { ?>
		<th data-name="id_fee" class="<?php echo $m_fee_list->id_fee->headerCellClass() ?>"><div id="elh_m_fee_id_fee" class="m_fee_id_fee"><div class="ew-table-header-caption"><?php echo $m_fee_list->id_fee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_fee" class="<?php echo $m_fee_list->id_fee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_fee_list->SortUrl($m_fee_list->id_fee) ?>', 1);"><div id="elh_m_fee_id_fee" class="m_fee_id_fee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_fee_list->id_fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_fee_list->id_fee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_fee_list->id_fee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_fee_list->id_barang->Visible) { // id_barang ?>
	<?php if ($m_fee_list->SortUrl($m_fee_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $m_fee_list->id_barang->headerCellClass() ?>"><div id="elh_m_fee_id_barang" class="m_fee_id_barang"><div class="ew-table-header-caption"><?php echo $m_fee_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $m_fee_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_fee_list->SortUrl($m_fee_list->id_barang) ?>', 1);"><div id="elh_m_fee_id_barang" class="m_fee_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_fee_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_fee_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_fee_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_fee_list->id_pegawai->Visible) { // id_pegawai ?>
	<?php if ($m_fee_list->SortUrl($m_fee_list->id_pegawai) == "") { ?>
		<th data-name="id_pegawai" class="<?php echo $m_fee_list->id_pegawai->headerCellClass() ?>"><div id="elh_m_fee_id_pegawai" class="m_fee_id_pegawai"><div class="ew-table-header-caption"><?php echo $m_fee_list->id_pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pegawai" class="<?php echo $m_fee_list->id_pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_fee_list->SortUrl($m_fee_list->id_pegawai) ?>', 1);"><div id="elh_m_fee_id_pegawai" class="m_fee_id_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_fee_list->id_pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_fee_list->id_pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_fee_list->id_pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_fee_list->prosentase->Visible) { // prosentase ?>
	<?php if ($m_fee_list->SortUrl($m_fee_list->prosentase) == "") { ?>
		<th data-name="prosentase" class="<?php echo $m_fee_list->prosentase->headerCellClass() ?>"><div id="elh_m_fee_prosentase" class="m_fee_prosentase"><div class="ew-table-header-caption"><?php echo $m_fee_list->prosentase->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prosentase" class="<?php echo $m_fee_list->prosentase->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_fee_list->SortUrl($m_fee_list->prosentase) ?>', 1);"><div id="elh_m_fee_prosentase" class="m_fee_prosentase">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_fee_list->prosentase->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_fee_list->prosentase->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_fee_list->prosentase->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_fee_list->id_hargajual->Visible) { // id_hargajual ?>
	<?php if ($m_fee_list->SortUrl($m_fee_list->id_hargajual) == "") { ?>
		<th data-name="id_hargajual" class="<?php echo $m_fee_list->id_hargajual->headerCellClass() ?>"><div id="elh_m_fee_id_hargajual" class="m_fee_id_hargajual"><div class="ew-table-header-caption"><?php echo $m_fee_list->id_hargajual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_hargajual" class="<?php echo $m_fee_list->id_hargajual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_fee_list->SortUrl($m_fee_list->id_hargajual) ?>', 1);"><div id="elh_m_fee_id_hargajual" class="m_fee_id_hargajual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_fee_list->id_hargajual->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_fee_list->id_hargajual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_fee_list->id_hargajual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_fee_list->id_jenispegawai->Visible) { // id_jenispegawai ?>
	<?php if ($m_fee_list->SortUrl($m_fee_list->id_jenispegawai) == "") { ?>
		<th data-name="id_jenispegawai" class="<?php echo $m_fee_list->id_jenispegawai->headerCellClass() ?>"><div id="elh_m_fee_id_jenispegawai" class="m_fee_id_jenispegawai"><div class="ew-table-header-caption"><?php echo $m_fee_list->id_jenispegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jenispegawai" class="<?php echo $m_fee_list->id_jenispegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_fee_list->SortUrl($m_fee_list->id_jenispegawai) ?>', 1);"><div id="elh_m_fee_id_jenispegawai" class="m_fee_id_jenispegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_fee_list->id_jenispegawai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_fee_list->id_jenispegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_fee_list->id_jenispegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_fee_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_fee_list->ExportAll && $m_fee_list->isExport()) {
	$m_fee_list->StopRecord = $m_fee_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_fee_list->TotalRecords > $m_fee_list->StartRecord + $m_fee_list->DisplayRecords - 1)
		$m_fee_list->StopRecord = $m_fee_list->StartRecord + $m_fee_list->DisplayRecords - 1;
	else
		$m_fee_list->StopRecord = $m_fee_list->TotalRecords;
}
$m_fee_list->RecordCount = $m_fee_list->StartRecord - 1;
if ($m_fee_list->Recordset && !$m_fee_list->Recordset->EOF) {
	$m_fee_list->Recordset->moveFirst();
	$selectLimit = $m_fee_list->UseSelectLimit;
	if (!$selectLimit && $m_fee_list->StartRecord > 1)
		$m_fee_list->Recordset->move($m_fee_list->StartRecord - 1);
} elseif (!$m_fee->AllowAddDeleteRow && $m_fee_list->StopRecord == 0) {
	$m_fee_list->StopRecord = $m_fee->GridAddRowCount;
}

// Initialize aggregate
$m_fee->RowType = ROWTYPE_AGGREGATEINIT;
$m_fee->resetAttributes();
$m_fee_list->renderRow();
while ($m_fee_list->RecordCount < $m_fee_list->StopRecord) {
	$m_fee_list->RecordCount++;
	if ($m_fee_list->RecordCount >= $m_fee_list->StartRecord) {
		$m_fee_list->RowCount++;

		// Set up key count
		$m_fee_list->KeyCount = $m_fee_list->RowIndex;

		// Init row class and style
		$m_fee->resetAttributes();
		$m_fee->CssClass = "";
		if ($m_fee_list->isGridAdd()) {
		} else {
			$m_fee_list->loadRowValues($m_fee_list->Recordset); // Load row values
		}
		$m_fee->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_fee->RowAttrs->merge(["data-rowindex" => $m_fee_list->RowCount, "id" => "r" . $m_fee_list->RowCount . "_m_fee", "data-rowtype" => $m_fee->RowType]);

		// Render row
		$m_fee_list->renderRow();

		// Render list options
		$m_fee_list->renderListOptions();
?>
	<tr <?php echo $m_fee->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_fee_list->ListOptions->render("body", "left", $m_fee_list->RowCount);
?>
	<?php if ($m_fee_list->id_fee->Visible) { // id_fee ?>
		<td data-name="id_fee" <?php echo $m_fee_list->id_fee->cellAttributes() ?>>
<span id="el<?php echo $m_fee_list->RowCount ?>_m_fee_id_fee">
<span<?php echo $m_fee_list->id_fee->viewAttributes() ?>><?php echo $m_fee_list->id_fee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_fee_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $m_fee_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_fee_list->RowCount ?>_m_fee_id_barang">
<span<?php echo $m_fee_list->id_barang->viewAttributes() ?>><?php echo $m_fee_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_fee_list->id_pegawai->Visible) { // id_pegawai ?>
		<td data-name="id_pegawai" <?php echo $m_fee_list->id_pegawai->cellAttributes() ?>>
<span id="el<?php echo $m_fee_list->RowCount ?>_m_fee_id_pegawai">
<span<?php echo $m_fee_list->id_pegawai->viewAttributes() ?>><?php echo $m_fee_list->id_pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_fee_list->prosentase->Visible) { // prosentase ?>
		<td data-name="prosentase" <?php echo $m_fee_list->prosentase->cellAttributes() ?>>
<span id="el<?php echo $m_fee_list->RowCount ?>_m_fee_prosentase">
<span<?php echo $m_fee_list->prosentase->viewAttributes() ?>><?php echo $m_fee_list->prosentase->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_fee_list->id_hargajual->Visible) { // id_hargajual ?>
		<td data-name="id_hargajual" <?php echo $m_fee_list->id_hargajual->cellAttributes() ?>>
<span id="el<?php echo $m_fee_list->RowCount ?>_m_fee_id_hargajual">
<span<?php echo $m_fee_list->id_hargajual->viewAttributes() ?>><?php echo $m_fee_list->id_hargajual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_fee_list->id_jenispegawai->Visible) { // id_jenispegawai ?>
		<td data-name="id_jenispegawai" <?php echo $m_fee_list->id_jenispegawai->cellAttributes() ?>>
<span id="el<?php echo $m_fee_list->RowCount ?>_m_fee_id_jenispegawai">
<span<?php echo $m_fee_list->id_jenispegawai->viewAttributes() ?>><?php echo $m_fee_list->id_jenispegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_fee_list->ListOptions->render("body", "right", $m_fee_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_fee_list->isGridAdd())
		$m_fee_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_fee->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_fee_list->Recordset)
	$m_fee_list->Recordset->Close();
?>
<?php if (!$m_fee_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_fee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_fee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_fee_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_fee_list->TotalRecords == 0 && !$m_fee->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_fee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_fee_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_fee_list->isExport()) { ?>
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
$m_fee_list->terminate();
?>