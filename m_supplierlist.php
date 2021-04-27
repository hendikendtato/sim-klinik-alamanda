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
$m_supplier_list = new m_supplier_list();

// Run the page
$m_supplier_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_supplier_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_supplier_list->isExport()) { ?>
<script>
var fm_supplierlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_supplierlist = currentForm = new ew.Form("fm_supplierlist", "list");
	fm_supplierlist.formKeyCountName = '<?php echo $m_supplier_list->FormKeyCountName ?>';
	loadjs.done("fm_supplierlist");
});
var fm_supplierlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_supplierlistsrch = currentSearchForm = new ew.Form("fm_supplierlistsrch");

	// Dynamic selection lists
	// Filters

	fm_supplierlistsrch.filterList = <?php echo $m_supplier_list->getFilterList() ?>;
	loadjs.done("fm_supplierlistsrch");
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
<?php if (!$m_supplier_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_supplier_list->TotalRecords > 0 && $m_supplier_list->ExportOptions->visible()) { ?>
<?php $m_supplier_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_supplier_list->ImportOptions->visible()) { ?>
<?php $m_supplier_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_supplier_list->SearchOptions->visible()) { ?>
<?php $m_supplier_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_supplier_list->FilterOptions->visible()) { ?>
<?php $m_supplier_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_supplier_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_supplier_list->isExport() && !$m_supplier->CurrentAction) { ?>
<form name="fm_supplierlistsrch" id="fm_supplierlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_supplierlistsrch-search-panel" class="<?php echo $m_supplier_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_supplier">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_supplier_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_supplier_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_supplier_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_supplier_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_supplier_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_supplier_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_supplier_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_supplier_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_supplier_list->showPageHeader(); ?>
<?php
$m_supplier_list->showMessage();
?>
<?php if ($m_supplier_list->TotalRecords > 0 || $m_supplier->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_supplier_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_supplier">
<?php if (!$m_supplier_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_supplier_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_supplier_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_supplier_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_supplierlist" id="fm_supplierlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_supplier">
<div id="gmp_m_supplier" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_supplier_list->TotalRecords > 0 || $m_supplier_list->isGridEdit()) { ?>
<table id="tbl_m_supplierlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_supplier->RowType = ROWTYPE_HEADER;

// Render list options
$m_supplier_list->renderListOptions();

// Render list options (header, left)
$m_supplier_list->ListOptions->render("header", "left");
?>
<?php if ($m_supplier_list->kode_supplier->Visible) { // kode_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->kode_supplier) == "") { ?>
		<th data-name="kode_supplier" class="<?php echo $m_supplier_list->kode_supplier->headerCellClass() ?>"><div id="elh_m_supplier_kode_supplier" class="m_supplier_kode_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->kode_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_supplier" class="<?php echo $m_supplier_list->kode_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->kode_supplier) ?>', 1);"><div id="elh_m_supplier_kode_supplier" class="m_supplier_kode_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->kode_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->kode_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->kode_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_supplier_list->nama_supplier->Visible) { // nama_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->nama_supplier) == "") { ?>
		<th data-name="nama_supplier" class="<?php echo $m_supplier_list->nama_supplier->headerCellClass() ?>"><div id="elh_m_supplier_nama_supplier" class="m_supplier_nama_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->nama_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_supplier" class="<?php echo $m_supplier_list->nama_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->nama_supplier) ?>', 1);"><div id="elh_m_supplier_nama_supplier" class="m_supplier_nama_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->nama_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->nama_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->nama_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_supplier_list->pic_supplier->Visible) { // pic_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->pic_supplier) == "") { ?>
		<th data-name="pic_supplier" class="<?php echo $m_supplier_list->pic_supplier->headerCellClass() ?>"><div id="elh_m_supplier_pic_supplier" class="m_supplier_pic_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->pic_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pic_supplier" class="<?php echo $m_supplier_list->pic_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->pic_supplier) ?>', 1);"><div id="elh_m_supplier_pic_supplier" class="m_supplier_pic_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->pic_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->pic_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->pic_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_supplier_list->alamat_supplier->Visible) { // alamat_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->alamat_supplier) == "") { ?>
		<th data-name="alamat_supplier" class="<?php echo $m_supplier_list->alamat_supplier->headerCellClass() ?>"><div id="elh_m_supplier_alamat_supplier" class="m_supplier_alamat_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->alamat_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat_supplier" class="<?php echo $m_supplier_list->alamat_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->alamat_supplier) ?>', 1);"><div id="elh_m_supplier_alamat_supplier" class="m_supplier_alamat_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->alamat_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->alamat_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->alamat_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_supplier_list->telpon_supplier->Visible) { // telpon_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->telpon_supplier) == "") { ?>
		<th data-name="telpon_supplier" class="<?php echo $m_supplier_list->telpon_supplier->headerCellClass() ?>"><div id="elh_m_supplier_telpon_supplier" class="m_supplier_telpon_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->telpon_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telpon_supplier" class="<?php echo $m_supplier_list->telpon_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->telpon_supplier) ?>', 1);"><div id="elh_m_supplier_telpon_supplier" class="m_supplier_telpon_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->telpon_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->telpon_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->telpon_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_supplier_list->hp_supplier->Visible) { // hp_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->hp_supplier) == "") { ?>
		<th data-name="hp_supplier" class="<?php echo $m_supplier_list->hp_supplier->headerCellClass() ?>"><div id="elh_m_supplier_hp_supplier" class="m_supplier_hp_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->hp_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp_supplier" class="<?php echo $m_supplier_list->hp_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->hp_supplier) ?>', 1);"><div id="elh_m_supplier_hp_supplier" class="m_supplier_hp_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->hp_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->hp_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->hp_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_supplier_list->email_supplier->Visible) { // email_supplier ?>
	<?php if ($m_supplier_list->SortUrl($m_supplier_list->email_supplier) == "") { ?>
		<th data-name="email_supplier" class="<?php echo $m_supplier_list->email_supplier->headerCellClass() ?>"><div id="elh_m_supplier_email_supplier" class="m_supplier_email_supplier"><div class="ew-table-header-caption"><?php echo $m_supplier_list->email_supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_supplier" class="<?php echo $m_supplier_list->email_supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_supplier_list->SortUrl($m_supplier_list->email_supplier) ?>', 1);"><div id="elh_m_supplier_email_supplier" class="m_supplier_email_supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_supplier_list->email_supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_supplier_list->email_supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_supplier_list->email_supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_supplier_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_supplier_list->ExportAll && $m_supplier_list->isExport()) {
	$m_supplier_list->StopRecord = $m_supplier_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_supplier_list->TotalRecords > $m_supplier_list->StartRecord + $m_supplier_list->DisplayRecords - 1)
		$m_supplier_list->StopRecord = $m_supplier_list->StartRecord + $m_supplier_list->DisplayRecords - 1;
	else
		$m_supplier_list->StopRecord = $m_supplier_list->TotalRecords;
}
$m_supplier_list->RecordCount = $m_supplier_list->StartRecord - 1;
if ($m_supplier_list->Recordset && !$m_supplier_list->Recordset->EOF) {
	$m_supplier_list->Recordset->moveFirst();
	$selectLimit = $m_supplier_list->UseSelectLimit;
	if (!$selectLimit && $m_supplier_list->StartRecord > 1)
		$m_supplier_list->Recordset->move($m_supplier_list->StartRecord - 1);
} elseif (!$m_supplier->AllowAddDeleteRow && $m_supplier_list->StopRecord == 0) {
	$m_supplier_list->StopRecord = $m_supplier->GridAddRowCount;
}

// Initialize aggregate
$m_supplier->RowType = ROWTYPE_AGGREGATEINIT;
$m_supplier->resetAttributes();
$m_supplier_list->renderRow();
while ($m_supplier_list->RecordCount < $m_supplier_list->StopRecord) {
	$m_supplier_list->RecordCount++;
	if ($m_supplier_list->RecordCount >= $m_supplier_list->StartRecord) {
		$m_supplier_list->RowCount++;

		// Set up key count
		$m_supplier_list->KeyCount = $m_supplier_list->RowIndex;

		// Init row class and style
		$m_supplier->resetAttributes();
		$m_supplier->CssClass = "";
		if ($m_supplier_list->isGridAdd()) {
		} else {
			$m_supplier_list->loadRowValues($m_supplier_list->Recordset); // Load row values
		}
		$m_supplier->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_supplier->RowAttrs->merge(["data-rowindex" => $m_supplier_list->RowCount, "id" => "r" . $m_supplier_list->RowCount . "_m_supplier", "data-rowtype" => $m_supplier->RowType]);

		// Render row
		$m_supplier_list->renderRow();

		// Render list options
		$m_supplier_list->renderListOptions();
?>
	<tr <?php echo $m_supplier->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_supplier_list->ListOptions->render("body", "left", $m_supplier_list->RowCount);
?>
	<?php if ($m_supplier_list->kode_supplier->Visible) { // kode_supplier ?>
		<td data-name="kode_supplier" <?php echo $m_supplier_list->kode_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_kode_supplier">
<span<?php echo $m_supplier_list->kode_supplier->viewAttributes() ?>><?php echo $m_supplier_list->kode_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_supplier_list->nama_supplier->Visible) { // nama_supplier ?>
		<td data-name="nama_supplier" <?php echo $m_supplier_list->nama_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_nama_supplier">
<span<?php echo $m_supplier_list->nama_supplier->viewAttributes() ?>><?php echo $m_supplier_list->nama_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_supplier_list->pic_supplier->Visible) { // pic_supplier ?>
		<td data-name="pic_supplier" <?php echo $m_supplier_list->pic_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_pic_supplier">
<span<?php echo $m_supplier_list->pic_supplier->viewAttributes() ?>><?php echo $m_supplier_list->pic_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_supplier_list->alamat_supplier->Visible) { // alamat_supplier ?>
		<td data-name="alamat_supplier" <?php echo $m_supplier_list->alamat_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_alamat_supplier">
<span<?php echo $m_supplier_list->alamat_supplier->viewAttributes() ?>><?php echo $m_supplier_list->alamat_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_supplier_list->telpon_supplier->Visible) { // telpon_supplier ?>
		<td data-name="telpon_supplier" <?php echo $m_supplier_list->telpon_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_telpon_supplier">
<span<?php echo $m_supplier_list->telpon_supplier->viewAttributes() ?>><?php echo $m_supplier_list->telpon_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_supplier_list->hp_supplier->Visible) { // hp_supplier ?>
		<td data-name="hp_supplier" <?php echo $m_supplier_list->hp_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_hp_supplier">
<span<?php echo $m_supplier_list->hp_supplier->viewAttributes() ?>><?php echo $m_supplier_list->hp_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_supplier_list->email_supplier->Visible) { // email_supplier ?>
		<td data-name="email_supplier" <?php echo $m_supplier_list->email_supplier->cellAttributes() ?>>
<span id="el<?php echo $m_supplier_list->RowCount ?>_m_supplier_email_supplier">
<span<?php echo $m_supplier_list->email_supplier->viewAttributes() ?>><?php echo $m_supplier_list->email_supplier->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_supplier_list->ListOptions->render("body", "right", $m_supplier_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_supplier_list->isGridAdd())
		$m_supplier_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_supplier->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_supplier_list->Recordset)
	$m_supplier_list->Recordset->Close();
?>
<?php if (!$m_supplier_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_supplier_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_supplier_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_supplier_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_supplier_list->TotalRecords == 0 && !$m_supplier->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_supplier_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_supplier_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_supplier_list->isExport()) { ?>
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
$m_supplier_list->terminate();
?>