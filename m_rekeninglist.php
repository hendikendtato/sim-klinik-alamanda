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
$m_rekening_list = new m_rekening_list();

// Run the page
$m_rekening_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_rekening_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_rekening_list->isExport()) { ?>
<script>
var fm_rekeninglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_rekeninglist = currentForm = new ew.Form("fm_rekeninglist", "list");
	fm_rekeninglist.formKeyCountName = '<?php echo $m_rekening_list->FormKeyCountName ?>';
	loadjs.done("fm_rekeninglist");
});
var fm_rekeninglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_rekeninglistsrch = currentSearchForm = new ew.Form("fm_rekeninglistsrch");

	// Dynamic selection lists
	// Filters

	fm_rekeninglistsrch.filterList = <?php echo $m_rekening_list->getFilterList() ?>;
	loadjs.done("fm_rekeninglistsrch");
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
<?php if (!$m_rekening_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_rekening_list->TotalRecords > 0 && $m_rekening_list->ExportOptions->visible()) { ?>
<?php $m_rekening_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_rekening_list->ImportOptions->visible()) { ?>
<?php $m_rekening_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_rekening_list->SearchOptions->visible()) { ?>
<?php $m_rekening_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_rekening_list->FilterOptions->visible()) { ?>
<?php $m_rekening_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_rekening_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_rekening_list->isExport() && !$m_rekening->CurrentAction) { ?>
<form name="fm_rekeninglistsrch" id="fm_rekeninglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_rekeninglistsrch-search-panel" class="<?php echo $m_rekening_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_rekening">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_rekening_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_rekening_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_rekening_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_rekening_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_rekening_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_rekening_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_rekening_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_rekening_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_rekening_list->showPageHeader(); ?>
<?php
$m_rekening_list->showMessage();
?>
<?php if ($m_rekening_list->TotalRecords > 0 || $m_rekening->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_rekening_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_rekening">
<?php if (!$m_rekening_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_rekening_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_rekening_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_rekening_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_rekeninglist" id="fm_rekeninglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_rekening">
<div id="gmp_m_rekening" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_rekening_list->TotalRecords > 0 || $m_rekening_list->isGridEdit()) { ?>
<table id="tbl_m_rekeninglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_rekening->RowType = ROWTYPE_HEADER;

// Render list options
$m_rekening_list->renderListOptions();

// Render list options (header, left)
$m_rekening_list->ListOptions->render("header", "left");
?>
<?php if ($m_rekening_list->id_bank->Visible) { // id_bank ?>
	<?php if ($m_rekening_list->SortUrl($m_rekening_list->id_bank) == "") { ?>
		<th data-name="id_bank" class="<?php echo $m_rekening_list->id_bank->headerCellClass() ?>"><div id="elh_m_rekening_id_bank" class="m_rekening_id_bank"><div class="ew-table-header-caption"><?php echo $m_rekening_list->id_bank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_bank" class="<?php echo $m_rekening_list->id_bank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_rekening_list->SortUrl($m_rekening_list->id_bank) ?>', 1);"><div id="elh_m_rekening_id_bank" class="m_rekening_id_bank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_rekening_list->id_bank->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_rekening_list->id_bank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_rekening_list->id_bank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_rekening_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_rekening_list->SortUrl($m_rekening_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_rekening_list->id_klinik->headerCellClass() ?>"><div id="elh_m_rekening_id_klinik" class="m_rekening_id_klinik"><div class="ew-table-header-caption"><?php echo $m_rekening_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_rekening_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_rekening_list->SortUrl($m_rekening_list->id_klinik) ?>', 1);"><div id="elh_m_rekening_id_klinik" class="m_rekening_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_rekening_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_rekening_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_rekening_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_rekening_list->nama_rekening->Visible) { // nama_rekening ?>
	<?php if ($m_rekening_list->SortUrl($m_rekening_list->nama_rekening) == "") { ?>
		<th data-name="nama_rekening" class="<?php echo $m_rekening_list->nama_rekening->headerCellClass() ?>"><div id="elh_m_rekening_nama_rekening" class="m_rekening_nama_rekening"><div class="ew-table-header-caption"><?php echo $m_rekening_list->nama_rekening->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_rekening" class="<?php echo $m_rekening_list->nama_rekening->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_rekening_list->SortUrl($m_rekening_list->nama_rekening) ?>', 1);"><div id="elh_m_rekening_nama_rekening" class="m_rekening_nama_rekening">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_rekening_list->nama_rekening->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_rekening_list->nama_rekening->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_rekening_list->nama_rekening->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_rekening_list->nomor_rekening->Visible) { // nomor_rekening ?>
	<?php if ($m_rekening_list->SortUrl($m_rekening_list->nomor_rekening) == "") { ?>
		<th data-name="nomor_rekening" class="<?php echo $m_rekening_list->nomor_rekening->headerCellClass() ?>"><div id="elh_m_rekening_nomor_rekening" class="m_rekening_nomor_rekening"><div class="ew-table-header-caption"><?php echo $m_rekening_list->nomor_rekening->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nomor_rekening" class="<?php echo $m_rekening_list->nomor_rekening->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_rekening_list->SortUrl($m_rekening_list->nomor_rekening) ?>', 1);"><div id="elh_m_rekening_nomor_rekening" class="m_rekening_nomor_rekening">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_rekening_list->nomor_rekening->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_rekening_list->nomor_rekening->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_rekening_list->nomor_rekening->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_rekening_list->saldo->Visible) { // saldo ?>
	<?php if ($m_rekening_list->SortUrl($m_rekening_list->saldo) == "") { ?>
		<th data-name="saldo" class="<?php echo $m_rekening_list->saldo->headerCellClass() ?>"><div id="elh_m_rekening_saldo" class="m_rekening_saldo"><div class="ew-table-header-caption"><?php echo $m_rekening_list->saldo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="saldo" class="<?php echo $m_rekening_list->saldo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_rekening_list->SortUrl($m_rekening_list->saldo) ?>', 1);"><div id="elh_m_rekening_saldo" class="m_rekening_saldo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_rekening_list->saldo->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_rekening_list->saldo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_rekening_list->saldo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_rekening_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_rekening_list->ExportAll && $m_rekening_list->isExport()) {
	$m_rekening_list->StopRecord = $m_rekening_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_rekening_list->TotalRecords > $m_rekening_list->StartRecord + $m_rekening_list->DisplayRecords - 1)
		$m_rekening_list->StopRecord = $m_rekening_list->StartRecord + $m_rekening_list->DisplayRecords - 1;
	else
		$m_rekening_list->StopRecord = $m_rekening_list->TotalRecords;
}
$m_rekening_list->RecordCount = $m_rekening_list->StartRecord - 1;
if ($m_rekening_list->Recordset && !$m_rekening_list->Recordset->EOF) {
	$m_rekening_list->Recordset->moveFirst();
	$selectLimit = $m_rekening_list->UseSelectLimit;
	if (!$selectLimit && $m_rekening_list->StartRecord > 1)
		$m_rekening_list->Recordset->move($m_rekening_list->StartRecord - 1);
} elseif (!$m_rekening->AllowAddDeleteRow && $m_rekening_list->StopRecord == 0) {
	$m_rekening_list->StopRecord = $m_rekening->GridAddRowCount;
}

// Initialize aggregate
$m_rekening->RowType = ROWTYPE_AGGREGATEINIT;
$m_rekening->resetAttributes();
$m_rekening_list->renderRow();
while ($m_rekening_list->RecordCount < $m_rekening_list->StopRecord) {
	$m_rekening_list->RecordCount++;
	if ($m_rekening_list->RecordCount >= $m_rekening_list->StartRecord) {
		$m_rekening_list->RowCount++;

		// Set up key count
		$m_rekening_list->KeyCount = $m_rekening_list->RowIndex;

		// Init row class and style
		$m_rekening->resetAttributes();
		$m_rekening->CssClass = "";
		if ($m_rekening_list->isGridAdd()) {
		} else {
			$m_rekening_list->loadRowValues($m_rekening_list->Recordset); // Load row values
		}
		$m_rekening->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_rekening->RowAttrs->merge(["data-rowindex" => $m_rekening_list->RowCount, "id" => "r" . $m_rekening_list->RowCount . "_m_rekening", "data-rowtype" => $m_rekening->RowType]);

		// Render row
		$m_rekening_list->renderRow();

		// Render list options
		$m_rekening_list->renderListOptions();
?>
	<tr <?php echo $m_rekening->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_rekening_list->ListOptions->render("body", "left", $m_rekening_list->RowCount);
?>
	<?php if ($m_rekening_list->id_bank->Visible) { // id_bank ?>
		<td data-name="id_bank" <?php echo $m_rekening_list->id_bank->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_list->RowCount ?>_m_rekening_id_bank">
<span<?php echo $m_rekening_list->id_bank->viewAttributes() ?>><?php echo $m_rekening_list->id_bank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_rekening_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_rekening_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_list->RowCount ?>_m_rekening_id_klinik">
<span<?php echo $m_rekening_list->id_klinik->viewAttributes() ?>><?php echo $m_rekening_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_rekening_list->nama_rekening->Visible) { // nama_rekening ?>
		<td data-name="nama_rekening" <?php echo $m_rekening_list->nama_rekening->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_list->RowCount ?>_m_rekening_nama_rekening">
<span<?php echo $m_rekening_list->nama_rekening->viewAttributes() ?>><?php echo $m_rekening_list->nama_rekening->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_rekening_list->nomor_rekening->Visible) { // nomor_rekening ?>
		<td data-name="nomor_rekening" <?php echo $m_rekening_list->nomor_rekening->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_list->RowCount ?>_m_rekening_nomor_rekening">
<span<?php echo $m_rekening_list->nomor_rekening->viewAttributes() ?>><?php echo $m_rekening_list->nomor_rekening->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_rekening_list->saldo->Visible) { // saldo ?>
		<td data-name="saldo" <?php echo $m_rekening_list->saldo->cellAttributes() ?>>
<span id="el<?php echo $m_rekening_list->RowCount ?>_m_rekening_saldo">
<span<?php echo $m_rekening_list->saldo->viewAttributes() ?>><?php echo $m_rekening_list->saldo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_rekening_list->ListOptions->render("body", "right", $m_rekening_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_rekening_list->isGridAdd())
		$m_rekening_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_rekening->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_rekening_list->Recordset)
	$m_rekening_list->Recordset->Close();
?>
<?php if (!$m_rekening_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_rekening_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_rekening_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_rekening_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_rekening_list->TotalRecords == 0 && !$m_rekening->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_rekening_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_rekening_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_rekening_list->isExport()) { ?>
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
$m_rekening_list->terminate();
?>