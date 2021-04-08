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
$promo_list = new promo_list();

// Run the page
$promo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promo_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$promo_list->isExport()) { ?>
<script>
var fpromolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpromolist = currentForm = new ew.Form("fpromolist", "list");
	fpromolist.formKeyCountName = '<?php echo $promo_list->FormKeyCountName ?>';
	loadjs.done("fpromolist");
});
var fpromolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpromolistsrch = currentSearchForm = new ew.Form("fpromolistsrch");

	// Dynamic selection lists
	// Filters

	fpromolistsrch.filterList = <?php echo $promo_list->getFilterList() ?>;
	loadjs.done("fpromolistsrch");
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
<?php if (!$promo_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($promo_list->TotalRecords > 0 && $promo_list->ExportOptions->visible()) { ?>
<?php $promo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($promo_list->ImportOptions->visible()) { ?>
<?php $promo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($promo_list->SearchOptions->visible()) { ?>
<?php $promo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($promo_list->FilterOptions->visible()) { ?>
<?php $promo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$promo_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$promo_list->isExport() && !$promo->CurrentAction) { ?>
<form name="fpromolistsrch" id="fpromolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpromolistsrch-search-panel" class="<?php echo $promo_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="promo">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $promo_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($promo_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($promo_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $promo_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($promo_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($promo_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($promo_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($promo_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $promo_list->showPageHeader(); ?>
<?php
$promo_list->showMessage();
?>
<?php if ($promo_list->TotalRecords > 0 || $promo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($promo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> promo">
<?php if (!$promo_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$promo_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $promo_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $promo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpromolist" id="fpromolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promo">
<div id="gmp_promo" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($promo_list->TotalRecords > 0 || $promo_list->isGridEdit()) { ?>
<table id="tbl_promolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$promo->RowType = ROWTYPE_HEADER;

// Render list options
$promo_list->renderListOptions();

// Render list options (header, left)
$promo_list->ListOptions->render("header", "left");
?>
<?php if ($promo_list->id_promo->Visible) { // id_promo ?>
	<?php if ($promo_list->SortUrl($promo_list->id_promo) == "") { ?>
		<th data-name="id_promo" class="<?php echo $promo_list->id_promo->headerCellClass() ?>"><div id="elh_promo_id_promo" class="promo_id_promo"><div class="ew-table-header-caption"><?php echo $promo_list->id_promo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_promo" class="<?php echo $promo_list->id_promo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $promo_list->SortUrl($promo_list->id_promo) ?>', 1);"><div id="elh_promo_id_promo" class="promo_id_promo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $promo_list->id_promo->caption() ?></span><span class="ew-table-header-sort"><?php if ($promo_list->id_promo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($promo_list->id_promo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($promo_list->nama->Visible) { // nama ?>
	<?php if ($promo_list->SortUrl($promo_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $promo_list->nama->headerCellClass() ?>"><div id="elh_promo_nama" class="promo_nama"><div class="ew-table-header-caption"><?php echo $promo_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $promo_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $promo_list->SortUrl($promo_list->nama) ?>', 1);"><div id="elh_promo_nama" class="promo_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $promo_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($promo_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($promo_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($promo_list->tanggal_mulai->Visible) { // tanggal_mulai ?>
	<?php if ($promo_list->SortUrl($promo_list->tanggal_mulai) == "") { ?>
		<th data-name="tanggal_mulai" class="<?php echo $promo_list->tanggal_mulai->headerCellClass() ?>"><div id="elh_promo_tanggal_mulai" class="promo_tanggal_mulai"><div class="ew-table-header-caption"><?php echo $promo_list->tanggal_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_mulai" class="<?php echo $promo_list->tanggal_mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $promo_list->SortUrl($promo_list->tanggal_mulai) ?>', 1);"><div id="elh_promo_tanggal_mulai" class="promo_tanggal_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $promo_list->tanggal_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($promo_list->tanggal_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($promo_list->tanggal_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($promo_list->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
	<?php if ($promo_list->SortUrl($promo_list->tanggal_berakhir) == "") { ?>
		<th data-name="tanggal_berakhir" class="<?php echo $promo_list->tanggal_berakhir->headerCellClass() ?>"><div id="elh_promo_tanggal_berakhir" class="promo_tanggal_berakhir"><div class="ew-table-header-caption"><?php echo $promo_list->tanggal_berakhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_berakhir" class="<?php echo $promo_list->tanggal_berakhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $promo_list->SortUrl($promo_list->tanggal_berakhir) ?>', 1);"><div id="elh_promo_tanggal_berakhir" class="promo_tanggal_berakhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $promo_list->tanggal_berakhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($promo_list->tanggal_berakhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($promo_list->tanggal_berakhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$promo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($promo_list->ExportAll && $promo_list->isExport()) {
	$promo_list->StopRecord = $promo_list->TotalRecords;
} else {

	// Set the last record to display
	if ($promo_list->TotalRecords > $promo_list->StartRecord + $promo_list->DisplayRecords - 1)
		$promo_list->StopRecord = $promo_list->StartRecord + $promo_list->DisplayRecords - 1;
	else
		$promo_list->StopRecord = $promo_list->TotalRecords;
}
$promo_list->RecordCount = $promo_list->StartRecord - 1;
if ($promo_list->Recordset && !$promo_list->Recordset->EOF) {
	$promo_list->Recordset->moveFirst();
	$selectLimit = $promo_list->UseSelectLimit;
	if (!$selectLimit && $promo_list->StartRecord > 1)
		$promo_list->Recordset->move($promo_list->StartRecord - 1);
} elseif (!$promo->AllowAddDeleteRow && $promo_list->StopRecord == 0) {
	$promo_list->StopRecord = $promo->GridAddRowCount;
}

// Initialize aggregate
$promo->RowType = ROWTYPE_AGGREGATEINIT;
$promo->resetAttributes();
$promo_list->renderRow();
while ($promo_list->RecordCount < $promo_list->StopRecord) {
	$promo_list->RecordCount++;
	if ($promo_list->RecordCount >= $promo_list->StartRecord) {
		$promo_list->RowCount++;

		// Set up key count
		$promo_list->KeyCount = $promo_list->RowIndex;

		// Init row class and style
		$promo->resetAttributes();
		$promo->CssClass = "";
		if ($promo_list->isGridAdd()) {
		} else {
			$promo_list->loadRowValues($promo_list->Recordset); // Load row values
		}
		$promo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$promo->RowAttrs->merge(["data-rowindex" => $promo_list->RowCount, "id" => "r" . $promo_list->RowCount . "_promo", "data-rowtype" => $promo->RowType]);

		// Render row
		$promo_list->renderRow();

		// Render list options
		$promo_list->renderListOptions();
?>
	<tr <?php echo $promo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$promo_list->ListOptions->render("body", "left", $promo_list->RowCount);
?>
	<?php if ($promo_list->id_promo->Visible) { // id_promo ?>
		<td data-name="id_promo" <?php echo $promo_list->id_promo->cellAttributes() ?>>
<span id="el<?php echo $promo_list->RowCount ?>_promo_id_promo">
<span<?php echo $promo_list->id_promo->viewAttributes() ?>><?php echo $promo_list->id_promo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($promo_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $promo_list->nama->cellAttributes() ?>>
<span id="el<?php echo $promo_list->RowCount ?>_promo_nama">
<span<?php echo $promo_list->nama->viewAttributes() ?>><?php echo $promo_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($promo_list->tanggal_mulai->Visible) { // tanggal_mulai ?>
		<td data-name="tanggal_mulai" <?php echo $promo_list->tanggal_mulai->cellAttributes() ?>>
<span id="el<?php echo $promo_list->RowCount ?>_promo_tanggal_mulai">
<span<?php echo $promo_list->tanggal_mulai->viewAttributes() ?>><?php echo $promo_list->tanggal_mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($promo_list->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
		<td data-name="tanggal_berakhir" <?php echo $promo_list->tanggal_berakhir->cellAttributes() ?>>
<span id="el<?php echo $promo_list->RowCount ?>_promo_tanggal_berakhir">
<span<?php echo $promo_list->tanggal_berakhir->viewAttributes() ?>><?php echo $promo_list->tanggal_berakhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$promo_list->ListOptions->render("body", "right", $promo_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$promo_list->isGridAdd())
		$promo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$promo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($promo_list->Recordset)
	$promo_list->Recordset->Close();
?>
<?php if (!$promo_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$promo_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $promo_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $promo_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($promo_list->TotalRecords == 0 && !$promo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $promo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$promo_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$promo_list->isExport()) { ?>
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
$promo_list->terminate();
?>