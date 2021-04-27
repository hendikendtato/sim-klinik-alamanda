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
$terimagudang_list = new terimagudang_list();

// Run the page
$terimagudang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimagudang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terimagudang_list->isExport()) { ?>
<script>
var fterimagudanglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fterimagudanglist = currentForm = new ew.Form("fterimagudanglist", "list");
	fterimagudanglist.formKeyCountName = '<?php echo $terimagudang_list->FormKeyCountName ?>';
	loadjs.done("fterimagudanglist");
});
var fterimagudanglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fterimagudanglistsrch = currentSearchForm = new ew.Form("fterimagudanglistsrch");

	// Dynamic selection lists
	// Filters

	fterimagudanglistsrch.filterList = <?php echo $terimagudang_list->getFilterList() ?>;
	loadjs.done("fterimagudanglistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","terimagudangadd.php?showdetail=detailterimagudang"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-view").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailterimagudang"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-edit").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailterimagudang"+t[1]+"="+t[2])});
});
</script>
<?php } ?>
<?php if (!$terimagudang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($terimagudang_list->TotalRecords > 0 && $terimagudang_list->ExportOptions->visible()) { ?>
<?php $terimagudang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($terimagudang_list->ImportOptions->visible()) { ?>
<?php $terimagudang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($terimagudang_list->SearchOptions->visible()) { ?>
<?php $terimagudang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($terimagudang_list->FilterOptions->visible()) { ?>
<?php $terimagudang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$terimagudang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$terimagudang_list->isExport() && !$terimagudang->CurrentAction) { ?>
<form name="fterimagudanglistsrch" id="fterimagudanglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fterimagudanglistsrch-search-panel" class="<?php echo $terimagudang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="terimagudang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $terimagudang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($terimagudang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($terimagudang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $terimagudang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($terimagudang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($terimagudang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($terimagudang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($terimagudang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $terimagudang_list->showPageHeader(); ?>
<?php
$terimagudang_list->showMessage();
?>
<?php if ($terimagudang_list->TotalRecords > 0 || $terimagudang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($terimagudang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> terimagudang">
<?php if (!$terimagudang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$terimagudang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $terimagudang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terimagudang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fterimagudanglist" id="fterimagudanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimagudang">
<div id="gmp_terimagudang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($terimagudang_list->TotalRecords > 0 || $terimagudang_list->isGridEdit()) { ?>
<table id="tbl_terimagudanglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$terimagudang->RowType = ROWTYPE_HEADER;

// Render list options
$terimagudang_list->renderListOptions();

// Render list options (header, left)
$terimagudang_list->ListOptions->render("header", "left");
?>
<?php if ($terimagudang_list->kode_terimagudang->Visible) { // kode_terimagudang ?>
	<?php if ($terimagudang_list->SortUrl($terimagudang_list->kode_terimagudang) == "") { ?>
		<th data-name="kode_terimagudang" class="<?php echo $terimagudang_list->kode_terimagudang->headerCellClass() ?>"><div id="elh_terimagudang_kode_terimagudang" class="terimagudang_kode_terimagudang"><div class="ew-table-header-caption"><?php echo $terimagudang_list->kode_terimagudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_terimagudang" class="<?php echo $terimagudang_list->kode_terimagudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimagudang_list->SortUrl($terimagudang_list->kode_terimagudang) ?>', 1);"><div id="elh_terimagudang_kode_terimagudang" class="terimagudang_kode_terimagudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimagudang_list->kode_terimagudang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($terimagudang_list->kode_terimagudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimagudang_list->kode_terimagudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimagudang_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($terimagudang_list->SortUrl($terimagudang_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $terimagudang_list->id_klinik->headerCellClass() ?>"><div id="elh_terimagudang_id_klinik" class="terimagudang_id_klinik"><div class="ew-table-header-caption"><?php echo $terimagudang_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $terimagudang_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimagudang_list->SortUrl($terimagudang_list->id_klinik) ?>', 1);"><div id="elh_terimagudang_id_klinik" class="terimagudang_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimagudang_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimagudang_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimagudang_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimagudang_list->diterima->Visible) { // diterima ?>
	<?php if ($terimagudang_list->SortUrl($terimagudang_list->diterima) == "") { ?>
		<th data-name="diterima" class="<?php echo $terimagudang_list->diterima->headerCellClass() ?>"><div id="elh_terimagudang_diterima" class="terimagudang_diterima"><div class="ew-table-header-caption"><?php echo $terimagudang_list->diterima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="diterima" class="<?php echo $terimagudang_list->diterima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimagudang_list->SortUrl($terimagudang_list->diterima) ?>', 1);"><div id="elh_terimagudang_diterima" class="terimagudang_diterima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimagudang_list->diterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimagudang_list->diterima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimagudang_list->diterima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimagudang_list->tanggal_terima->Visible) { // tanggal_terima ?>
	<?php if ($terimagudang_list->SortUrl($terimagudang_list->tanggal_terima) == "") { ?>
		<th data-name="tanggal_terima" class="<?php echo $terimagudang_list->tanggal_terima->headerCellClass() ?>"><div id="elh_terimagudang_tanggal_terima" class="terimagudang_tanggal_terima"><div class="ew-table-header-caption"><?php echo $terimagudang_list->tanggal_terima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_terima" class="<?php echo $terimagudang_list->tanggal_terima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimagudang_list->SortUrl($terimagudang_list->tanggal_terima) ?>', 1);"><div id="elh_terimagudang_tanggal_terima" class="terimagudang_tanggal_terima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimagudang_list->tanggal_terima->caption() ?></span><span class="ew-table-header-sort"><?php if ($terimagudang_list->tanggal_terima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimagudang_list->tanggal_terima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terimagudang_list->keterangan->Visible) { // keterangan ?>
	<?php if ($terimagudang_list->SortUrl($terimagudang_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $terimagudang_list->keterangan->headerCellClass() ?>"><div id="elh_terimagudang_keterangan" class="terimagudang_keterangan"><div class="ew-table-header-caption"><?php echo $terimagudang_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $terimagudang_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terimagudang_list->SortUrl($terimagudang_list->keterangan) ?>', 1);"><div id="elh_terimagudang_keterangan" class="terimagudang_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terimagudang_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($terimagudang_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terimagudang_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$terimagudang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($terimagudang_list->ExportAll && $terimagudang_list->isExport()) {
	$terimagudang_list->StopRecord = $terimagudang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($terimagudang_list->TotalRecords > $terimagudang_list->StartRecord + $terimagudang_list->DisplayRecords - 1)
		$terimagudang_list->StopRecord = $terimagudang_list->StartRecord + $terimagudang_list->DisplayRecords - 1;
	else
		$terimagudang_list->StopRecord = $terimagudang_list->TotalRecords;
}
$terimagudang_list->RecordCount = $terimagudang_list->StartRecord - 1;
if ($terimagudang_list->Recordset && !$terimagudang_list->Recordset->EOF) {
	$terimagudang_list->Recordset->moveFirst();
	$selectLimit = $terimagudang_list->UseSelectLimit;
	if (!$selectLimit && $terimagudang_list->StartRecord > 1)
		$terimagudang_list->Recordset->move($terimagudang_list->StartRecord - 1);
} elseif (!$terimagudang->AllowAddDeleteRow && $terimagudang_list->StopRecord == 0) {
	$terimagudang_list->StopRecord = $terimagudang->GridAddRowCount;
}

// Initialize aggregate
$terimagudang->RowType = ROWTYPE_AGGREGATEINIT;
$terimagudang->resetAttributes();
$terimagudang_list->renderRow();
while ($terimagudang_list->RecordCount < $terimagudang_list->StopRecord) {
	$terimagudang_list->RecordCount++;
	if ($terimagudang_list->RecordCount >= $terimagudang_list->StartRecord) {
		$terimagudang_list->RowCount++;

		// Set up key count
		$terimagudang_list->KeyCount = $terimagudang_list->RowIndex;

		// Init row class and style
		$terimagudang->resetAttributes();
		$terimagudang->CssClass = "";
		if ($terimagudang_list->isGridAdd()) {
		} else {
			$terimagudang_list->loadRowValues($terimagudang_list->Recordset); // Load row values
		}
		$terimagudang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$terimagudang->RowAttrs->merge(["data-rowindex" => $terimagudang_list->RowCount, "id" => "r" . $terimagudang_list->RowCount . "_terimagudang", "data-rowtype" => $terimagudang->RowType]);

		// Render row
		$terimagudang_list->renderRow();

		// Render list options
		$terimagudang_list->renderListOptions();
?>
	<tr <?php echo $terimagudang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$terimagudang_list->ListOptions->render("body", "left", $terimagudang_list->RowCount);
?>
	<?php if ($terimagudang_list->kode_terimagudang->Visible) { // kode_terimagudang ?>
		<td data-name="kode_terimagudang" <?php echo $terimagudang_list->kode_terimagudang->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_list->RowCount ?>_terimagudang_kode_terimagudang">
<span<?php echo $terimagudang_list->kode_terimagudang->viewAttributes() ?>><?php echo $terimagudang_list->kode_terimagudang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimagudang_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $terimagudang_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_list->RowCount ?>_terimagudang_id_klinik">
<span<?php echo $terimagudang_list->id_klinik->viewAttributes() ?>><?php echo $terimagudang_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimagudang_list->diterima->Visible) { // diterima ?>
		<td data-name="diterima" <?php echo $terimagudang_list->diterima->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_list->RowCount ?>_terimagudang_diterima">
<span<?php echo $terimagudang_list->diterima->viewAttributes() ?>><?php echo $terimagudang_list->diterima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimagudang_list->tanggal_terima->Visible) { // tanggal_terima ?>
		<td data-name="tanggal_terima" <?php echo $terimagudang_list->tanggal_terima->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_list->RowCount ?>_terimagudang_tanggal_terima">
<span<?php echo $terimagudang_list->tanggal_terima->viewAttributes() ?>><?php echo $terimagudang_list->tanggal_terima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terimagudang_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $terimagudang_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $terimagudang_list->RowCount ?>_terimagudang_keterangan">
<span<?php echo $terimagudang_list->keterangan->viewAttributes() ?>><?php echo $terimagudang_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$terimagudang_list->ListOptions->render("body", "right", $terimagudang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$terimagudang_list->isGridAdd())
		$terimagudang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$terimagudang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($terimagudang_list->Recordset)
	$terimagudang_list->Recordset->Close();
?>
<?php if (!$terimagudang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$terimagudang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $terimagudang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terimagudang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($terimagudang_list->TotalRecords == 0 && !$terimagudang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $terimagudang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$terimagudang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terimagudang_list->isExport()) { ?>
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
$terimagudang_list->terminate();
?>