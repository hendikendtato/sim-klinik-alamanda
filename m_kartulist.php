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
$m_kartu_list = new m_kartu_list();

// Run the page
$m_kartu_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kartu_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kartu_list->isExport()) { ?>
<script>
var fm_kartulist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_kartulist = currentForm = new ew.Form("fm_kartulist", "list");
	fm_kartulist.formKeyCountName = '<?php echo $m_kartu_list->FormKeyCountName ?>';
	loadjs.done("fm_kartulist");
});
var fm_kartulistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_kartulistsrch = currentSearchForm = new ew.Form("fm_kartulistsrch");

	// Dynamic selection lists
	// Filters

	fm_kartulistsrch.filterList = <?php echo $m_kartu_list->getFilterList() ?>;
	loadjs.done("fm_kartulistsrch");
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
<?php if (!$m_kartu_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_kartu_list->TotalRecords > 0 && $m_kartu_list->ExportOptions->visible()) { ?>
<?php $m_kartu_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kartu_list->ImportOptions->visible()) { ?>
<?php $m_kartu_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kartu_list->SearchOptions->visible()) { ?>
<?php $m_kartu_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_kartu_list->FilterOptions->visible()) { ?>
<?php $m_kartu_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_kartu_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_kartu_list->isExport() && !$m_kartu->CurrentAction) { ?>
<form name="fm_kartulistsrch" id="fm_kartulistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_kartulistsrch-search-panel" class="<?php echo $m_kartu_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_kartu">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_kartu_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_kartu_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_kartu_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_kartu_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_kartu_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_kartu_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_kartu_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_kartu_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_kartu_list->showPageHeader(); ?>
<?php
$m_kartu_list->showMessage();
?>
<?php if ($m_kartu_list->TotalRecords > 0 || $m_kartu->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_kartu_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_kartu">
<?php if (!$m_kartu_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_kartu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kartu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kartu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_kartulist" id="fm_kartulist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kartu">
<div id="gmp_m_kartu" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_kartu_list->TotalRecords > 0 || $m_kartu_list->isGridEdit()) { ?>
<table id="tbl_m_kartulist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_kartu->RowType = ROWTYPE_HEADER;

// Render list options
$m_kartu_list->renderListOptions();

// Render list options (header, left)
$m_kartu_list->ListOptions->render("header", "left");
?>
<?php if ($m_kartu_list->id_bank->Visible) { // id_bank ?>
	<?php if ($m_kartu_list->SortUrl($m_kartu_list->id_bank) == "") { ?>
		<th data-name="id_bank" class="<?php echo $m_kartu_list->id_bank->headerCellClass() ?>"><div id="elh_m_kartu_id_bank" class="m_kartu_id_bank"><div class="ew-table-header-caption"><?php echo $m_kartu_list->id_bank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_bank" class="<?php echo $m_kartu_list->id_bank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kartu_list->SortUrl($m_kartu_list->id_bank) ?>', 1);"><div id="elh_m_kartu_id_bank" class="m_kartu_id_bank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kartu_list->id_bank->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kartu_list->id_bank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kartu_list->id_bank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kartu_list->jenis->Visible) { // jenis ?>
	<?php if ($m_kartu_list->SortUrl($m_kartu_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $m_kartu_list->jenis->headerCellClass() ?>"><div id="elh_m_kartu_jenis" class="m_kartu_jenis"><div class="ew-table-header-caption"><?php echo $m_kartu_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $m_kartu_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kartu_list->SortUrl($m_kartu_list->jenis) ?>', 1);"><div id="elh_m_kartu_jenis" class="m_kartu_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kartu_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_kartu_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kartu_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kartu_list->nama_kartu->Visible) { // nama_kartu ?>
	<?php if ($m_kartu_list->SortUrl($m_kartu_list->nama_kartu) == "") { ?>
		<th data-name="nama_kartu" class="<?php echo $m_kartu_list->nama_kartu->headerCellClass() ?>"><div id="elh_m_kartu_nama_kartu" class="m_kartu_nama_kartu"><div class="ew-table-header-caption"><?php echo $m_kartu_list->nama_kartu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_kartu" class="<?php echo $m_kartu_list->nama_kartu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kartu_list->SortUrl($m_kartu_list->nama_kartu) ?>', 1);"><div id="elh_m_kartu_nama_kartu" class="m_kartu_nama_kartu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kartu_list->nama_kartu->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_kartu_list->nama_kartu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kartu_list->nama_kartu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kartu_list->charge_type->Visible) { // charge_type ?>
	<?php if ($m_kartu_list->SortUrl($m_kartu_list->charge_type) == "") { ?>
		<th data-name="charge_type" class="<?php echo $m_kartu_list->charge_type->headerCellClass() ?>"><div id="elh_m_kartu_charge_type" class="m_kartu_charge_type"><div class="ew-table-header-caption"><?php echo $m_kartu_list->charge_type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="charge_type" class="<?php echo $m_kartu_list->charge_type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kartu_list->SortUrl($m_kartu_list->charge_type) ?>', 1);"><div id="elh_m_kartu_charge_type" class="m_kartu_charge_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kartu_list->charge_type->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kartu_list->charge_type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kartu_list->charge_type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kartu_list->charge_price->Visible) { // charge_price ?>
	<?php if ($m_kartu_list->SortUrl($m_kartu_list->charge_price) == "") { ?>
		<th data-name="charge_price" class="<?php echo $m_kartu_list->charge_price->headerCellClass() ?>"><div id="elh_m_kartu_charge_price" class="m_kartu_charge_price"><div class="ew-table-header-caption"><?php echo $m_kartu_list->charge_price->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="charge_price" class="<?php echo $m_kartu_list->charge_price->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kartu_list->SortUrl($m_kartu_list->charge_price) ?>', 1);"><div id="elh_m_kartu_charge_price" class="m_kartu_charge_price">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kartu_list->charge_price->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kartu_list->charge_price->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kartu_list->charge_price->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_kartu_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_kartu_list->ExportAll && $m_kartu_list->isExport()) {
	$m_kartu_list->StopRecord = $m_kartu_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_kartu_list->TotalRecords > $m_kartu_list->StartRecord + $m_kartu_list->DisplayRecords - 1)
		$m_kartu_list->StopRecord = $m_kartu_list->StartRecord + $m_kartu_list->DisplayRecords - 1;
	else
		$m_kartu_list->StopRecord = $m_kartu_list->TotalRecords;
}
$m_kartu_list->RecordCount = $m_kartu_list->StartRecord - 1;
if ($m_kartu_list->Recordset && !$m_kartu_list->Recordset->EOF) {
	$m_kartu_list->Recordset->moveFirst();
	$selectLimit = $m_kartu_list->UseSelectLimit;
	if (!$selectLimit && $m_kartu_list->StartRecord > 1)
		$m_kartu_list->Recordset->move($m_kartu_list->StartRecord - 1);
} elseif (!$m_kartu->AllowAddDeleteRow && $m_kartu_list->StopRecord == 0) {
	$m_kartu_list->StopRecord = $m_kartu->GridAddRowCount;
}

// Initialize aggregate
$m_kartu->RowType = ROWTYPE_AGGREGATEINIT;
$m_kartu->resetAttributes();
$m_kartu_list->renderRow();
while ($m_kartu_list->RecordCount < $m_kartu_list->StopRecord) {
	$m_kartu_list->RecordCount++;
	if ($m_kartu_list->RecordCount >= $m_kartu_list->StartRecord) {
		$m_kartu_list->RowCount++;

		// Set up key count
		$m_kartu_list->KeyCount = $m_kartu_list->RowIndex;

		// Init row class and style
		$m_kartu->resetAttributes();
		$m_kartu->CssClass = "";
		if ($m_kartu_list->isGridAdd()) {
		} else {
			$m_kartu_list->loadRowValues($m_kartu_list->Recordset); // Load row values
		}
		$m_kartu->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_kartu->RowAttrs->merge(["data-rowindex" => $m_kartu_list->RowCount, "id" => "r" . $m_kartu_list->RowCount . "_m_kartu", "data-rowtype" => $m_kartu->RowType]);

		// Render row
		$m_kartu_list->renderRow();

		// Render list options
		$m_kartu_list->renderListOptions();
?>
	<tr <?php echo $m_kartu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_kartu_list->ListOptions->render("body", "left", $m_kartu_list->RowCount);
?>
	<?php if ($m_kartu_list->id_bank->Visible) { // id_bank ?>
		<td data-name="id_bank" <?php echo $m_kartu_list->id_bank->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_list->RowCount ?>_m_kartu_id_bank">
<span<?php echo $m_kartu_list->id_bank->viewAttributes() ?>><?php echo $m_kartu_list->id_bank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kartu_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $m_kartu_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_list->RowCount ?>_m_kartu_jenis">
<span<?php echo $m_kartu_list->jenis->viewAttributes() ?>><?php echo $m_kartu_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kartu_list->nama_kartu->Visible) { // nama_kartu ?>
		<td data-name="nama_kartu" <?php echo $m_kartu_list->nama_kartu->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_list->RowCount ?>_m_kartu_nama_kartu">
<span<?php echo $m_kartu_list->nama_kartu->viewAttributes() ?>><?php echo $m_kartu_list->nama_kartu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kartu_list->charge_type->Visible) { // charge_type ?>
		<td data-name="charge_type" <?php echo $m_kartu_list->charge_type->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_list->RowCount ?>_m_kartu_charge_type">
<span<?php echo $m_kartu_list->charge_type->viewAttributes() ?>><?php echo $m_kartu_list->charge_type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kartu_list->charge_price->Visible) { // charge_price ?>
		<td data-name="charge_price" <?php echo $m_kartu_list->charge_price->cellAttributes() ?>>
<span id="el<?php echo $m_kartu_list->RowCount ?>_m_kartu_charge_price">
<span<?php echo $m_kartu_list->charge_price->viewAttributes() ?>><?php echo $m_kartu_list->charge_price->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_kartu_list->ListOptions->render("body", "right", $m_kartu_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_kartu_list->isGridAdd())
		$m_kartu_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_kartu->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_kartu_list->Recordset)
	$m_kartu_list->Recordset->Close();
?>
<?php if (!$m_kartu_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_kartu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kartu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kartu_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_kartu_list->TotalRecords == 0 && !$m_kartu->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_kartu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_kartu_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kartu_list->isExport()) { ?>
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
$m_kartu_list->terminate();
?>