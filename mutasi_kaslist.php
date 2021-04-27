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
$mutasi_kas_list = new mutasi_kas_list();

// Run the page
$mutasi_kas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mutasi_kas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mutasi_kas_list->isExport()) { ?>
<script>
var fmutasi_kaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmutasi_kaslist = currentForm = new ew.Form("fmutasi_kaslist", "list");
	fmutasi_kaslist.formKeyCountName = '<?php echo $mutasi_kas_list->FormKeyCountName ?>';
	loadjs.done("fmutasi_kaslist");
});
var fmutasi_kaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmutasi_kaslistsrch = currentSearchForm = new ew.Form("fmutasi_kaslistsrch");

	// Dynamic selection lists
	// Filters

	fmutasi_kaslistsrch.filterList = <?php echo $mutasi_kas_list->getFilterList() ?>;
	loadjs.done("fmutasi_kaslistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","mutasi_kasadd.php?showdetail=detailmutasibank"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-edit").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailmutasibank"+t[1]+"="+t[2])});
});
</script>
<?php } ?>
<?php if (!$mutasi_kas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mutasi_kas_list->TotalRecords > 0 && $mutasi_kas_list->ExportOptions->visible()) { ?>
<?php $mutasi_kas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mutasi_kas_list->ImportOptions->visible()) { ?>
<?php $mutasi_kas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mutasi_kas_list->SearchOptions->visible()) { ?>
<?php $mutasi_kas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mutasi_kas_list->FilterOptions->visible()) { ?>
<?php $mutasi_kas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mutasi_kas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mutasi_kas_list->isExport() && !$mutasi_kas->CurrentAction) { ?>
<form name="fmutasi_kaslistsrch" id="fmutasi_kaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmutasi_kaslistsrch-search-panel" class="<?php echo $mutasi_kas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mutasi_kas">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $mutasi_kas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($mutasi_kas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($mutasi_kas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mutasi_kas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mutasi_kas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mutasi_kas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mutasi_kas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mutasi_kas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $mutasi_kas_list->showPageHeader(); ?>
<?php
$mutasi_kas_list->showMessage();
?>
<?php if ($mutasi_kas_list->TotalRecords > 0 || $mutasi_kas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mutasi_kas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mutasi_kas">
<?php if (!$mutasi_kas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$mutasi_kas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mutasi_kas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mutasi_kas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmutasi_kaslist" id="fmutasi_kaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mutasi_kas">
<div id="gmp_mutasi_kas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($mutasi_kas_list->TotalRecords > 0 || $mutasi_kas_list->isGridEdit()) { ?>
<table id="tbl_mutasi_kaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mutasi_kas->RowType = ROWTYPE_HEADER;

// Render list options
$mutasi_kas_list->renderListOptions();

// Render list options (header, left)
$mutasi_kas_list->ListOptions->render("header", "left");
?>
<?php if ($mutasi_kas_list->no_bukti->Visible) { // no_bukti ?>
	<?php if ($mutasi_kas_list->SortUrl($mutasi_kas_list->no_bukti) == "") { ?>
		<th data-name="no_bukti" class="<?php echo $mutasi_kas_list->no_bukti->headerCellClass() ?>"><div id="elh_mutasi_kas_no_bukti" class="mutasi_kas_no_bukti"><div class="ew-table-header-caption"><?php echo $mutasi_kas_list->no_bukti->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="no_bukti" class="<?php echo $mutasi_kas_list->no_bukti->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mutasi_kas_list->SortUrl($mutasi_kas_list->no_bukti) ?>', 1);"><div id="elh_mutasi_kas_no_bukti" class="mutasi_kas_no_bukti">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mutasi_kas_list->no_bukti->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mutasi_kas_list->no_bukti->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mutasi_kas_list->no_bukti->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mutasi_kas_list->tgl->Visible) { // tgl ?>
	<?php if ($mutasi_kas_list->SortUrl($mutasi_kas_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $mutasi_kas_list->tgl->headerCellClass() ?>"><div id="elh_mutasi_kas_tgl" class="mutasi_kas_tgl"><div class="ew-table-header-caption"><?php echo $mutasi_kas_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $mutasi_kas_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mutasi_kas_list->SortUrl($mutasi_kas_list->tgl) ?>', 1);"><div id="elh_mutasi_kas_tgl" class="mutasi_kas_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mutasi_kas_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($mutasi_kas_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mutasi_kas_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mutasi_kas_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($mutasi_kas_list->SortUrl($mutasi_kas_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $mutasi_kas_list->id_klinik->headerCellClass() ?>"><div id="elh_mutasi_kas_id_klinik" class="mutasi_kas_id_klinik"><div class="ew-table-header-caption"><?php echo $mutasi_kas_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $mutasi_kas_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mutasi_kas_list->SortUrl($mutasi_kas_list->id_klinik) ?>', 1);"><div id="elh_mutasi_kas_id_klinik" class="mutasi_kas_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mutasi_kas_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($mutasi_kas_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mutasi_kas_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mutasi_kas_list->id_kas->Visible) { // id_kas ?>
	<?php if ($mutasi_kas_list->SortUrl($mutasi_kas_list->id_kas) == "") { ?>
		<th data-name="id_kas" class="<?php echo $mutasi_kas_list->id_kas->headerCellClass() ?>"><div id="elh_mutasi_kas_id_kas" class="mutasi_kas_id_kas"><div class="ew-table-header-caption"><?php echo $mutasi_kas_list->id_kas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kas" class="<?php echo $mutasi_kas_list->id_kas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mutasi_kas_list->SortUrl($mutasi_kas_list->id_kas) ?>', 1);"><div id="elh_mutasi_kas_id_kas" class="mutasi_kas_id_kas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mutasi_kas_list->id_kas->caption() ?></span><span class="ew-table-header-sort"><?php if ($mutasi_kas_list->id_kas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mutasi_kas_list->id_kas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mutasi_kas_list->tipe->Visible) { // tipe ?>
	<?php if ($mutasi_kas_list->SortUrl($mutasi_kas_list->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $mutasi_kas_list->tipe->headerCellClass() ?>"><div id="elh_mutasi_kas_tipe" class="mutasi_kas_tipe"><div class="ew-table-header-caption"><?php echo $mutasi_kas_list->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $mutasi_kas_list->tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mutasi_kas_list->SortUrl($mutasi_kas_list->tipe) ?>', 1);"><div id="elh_mutasi_kas_tipe" class="mutasi_kas_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mutasi_kas_list->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($mutasi_kas_list->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mutasi_kas_list->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mutasi_kas_list->keterangan->Visible) { // keterangan ?>
	<?php if ($mutasi_kas_list->SortUrl($mutasi_kas_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $mutasi_kas_list->keterangan->headerCellClass() ?>"><div id="elh_mutasi_kas_keterangan" class="mutasi_kas_keterangan"><div class="ew-table-header-caption"><?php echo $mutasi_kas_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $mutasi_kas_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mutasi_kas_list->SortUrl($mutasi_kas_list->keterangan) ?>', 1);"><div id="elh_mutasi_kas_keterangan" class="mutasi_kas_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mutasi_kas_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mutasi_kas_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mutasi_kas_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mutasi_kas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mutasi_kas_list->ExportAll && $mutasi_kas_list->isExport()) {
	$mutasi_kas_list->StopRecord = $mutasi_kas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($mutasi_kas_list->TotalRecords > $mutasi_kas_list->StartRecord + $mutasi_kas_list->DisplayRecords - 1)
		$mutasi_kas_list->StopRecord = $mutasi_kas_list->StartRecord + $mutasi_kas_list->DisplayRecords - 1;
	else
		$mutasi_kas_list->StopRecord = $mutasi_kas_list->TotalRecords;
}
$mutasi_kas_list->RecordCount = $mutasi_kas_list->StartRecord - 1;
if ($mutasi_kas_list->Recordset && !$mutasi_kas_list->Recordset->EOF) {
	$mutasi_kas_list->Recordset->moveFirst();
	$selectLimit = $mutasi_kas_list->UseSelectLimit;
	if (!$selectLimit && $mutasi_kas_list->StartRecord > 1)
		$mutasi_kas_list->Recordset->move($mutasi_kas_list->StartRecord - 1);
} elseif (!$mutasi_kas->AllowAddDeleteRow && $mutasi_kas_list->StopRecord == 0) {
	$mutasi_kas_list->StopRecord = $mutasi_kas->GridAddRowCount;
}

// Initialize aggregate
$mutasi_kas->RowType = ROWTYPE_AGGREGATEINIT;
$mutasi_kas->resetAttributes();
$mutasi_kas_list->renderRow();
while ($mutasi_kas_list->RecordCount < $mutasi_kas_list->StopRecord) {
	$mutasi_kas_list->RecordCount++;
	if ($mutasi_kas_list->RecordCount >= $mutasi_kas_list->StartRecord) {
		$mutasi_kas_list->RowCount++;

		// Set up key count
		$mutasi_kas_list->KeyCount = $mutasi_kas_list->RowIndex;

		// Init row class and style
		$mutasi_kas->resetAttributes();
		$mutasi_kas->CssClass = "";
		if ($mutasi_kas_list->isGridAdd()) {
		} else {
			$mutasi_kas_list->loadRowValues($mutasi_kas_list->Recordset); // Load row values
		}
		$mutasi_kas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mutasi_kas->RowAttrs->merge(["data-rowindex" => $mutasi_kas_list->RowCount, "id" => "r" . $mutasi_kas_list->RowCount . "_mutasi_kas", "data-rowtype" => $mutasi_kas->RowType]);

		// Render row
		$mutasi_kas_list->renderRow();

		// Render list options
		$mutasi_kas_list->renderListOptions();
?>
	<tr <?php echo $mutasi_kas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mutasi_kas_list->ListOptions->render("body", "left", $mutasi_kas_list->RowCount);
?>
	<?php if ($mutasi_kas_list->no_bukti->Visible) { // no_bukti ?>
		<td data-name="no_bukti" <?php echo $mutasi_kas_list->no_bukti->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_list->RowCount ?>_mutasi_kas_no_bukti">
<span<?php echo $mutasi_kas_list->no_bukti->viewAttributes() ?>><?php echo $mutasi_kas_list->no_bukti->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mutasi_kas_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $mutasi_kas_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_list->RowCount ?>_mutasi_kas_tgl">
<span<?php echo $mutasi_kas_list->tgl->viewAttributes() ?>><?php echo $mutasi_kas_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mutasi_kas_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $mutasi_kas_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_list->RowCount ?>_mutasi_kas_id_klinik">
<span<?php echo $mutasi_kas_list->id_klinik->viewAttributes() ?>><?php echo $mutasi_kas_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mutasi_kas_list->id_kas->Visible) { // id_kas ?>
		<td data-name="id_kas" <?php echo $mutasi_kas_list->id_kas->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_list->RowCount ?>_mutasi_kas_id_kas">
<span<?php echo $mutasi_kas_list->id_kas->viewAttributes() ?>><?php echo $mutasi_kas_list->id_kas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mutasi_kas_list->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $mutasi_kas_list->tipe->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_list->RowCount ?>_mutasi_kas_tipe">
<span<?php echo $mutasi_kas_list->tipe->viewAttributes() ?>><?php echo $mutasi_kas_list->tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mutasi_kas_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $mutasi_kas_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $mutasi_kas_list->RowCount ?>_mutasi_kas_keterangan">
<span<?php echo $mutasi_kas_list->keterangan->viewAttributes() ?>><?php echo $mutasi_kas_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mutasi_kas_list->ListOptions->render("body", "right", $mutasi_kas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$mutasi_kas_list->isGridAdd())
		$mutasi_kas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$mutasi_kas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mutasi_kas_list->Recordset)
	$mutasi_kas_list->Recordset->Close();
?>
<?php if (!$mutasi_kas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mutasi_kas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mutasi_kas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mutasi_kas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mutasi_kas_list->TotalRecords == 0 && !$mutasi_kas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mutasi_kas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mutasi_kas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mutasi_kas_list->isExport()) { ?>
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
$mutasi_kas_list->terminate();
?>