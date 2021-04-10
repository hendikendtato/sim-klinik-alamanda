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
$stok_list = new stok_list();

// Run the page
$stok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$stok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$stok_list->isExport()) { ?>
<script>
var fstoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstoklist = currentForm = new ew.Form("fstoklist", "list");
	fstoklist.formKeyCountName = '<?php echo $stok_list->FormKeyCountName ?>';
	loadjs.done("fstoklist");
});
var fstoklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstoklistsrch = currentSearchForm = new ew.Form("fstoklistsrch");

	// Dynamic selection lists
	// Filters

	fstoklistsrch.filterList = <?php echo $stok_list->getFilterList() ?>;
	loadjs.done("fstoklistsrch");
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
<?php if (!$stok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($stok_list->TotalRecords > 0 && $stok_list->ExportOptions->visible()) { ?>
<?php $stok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($stok_list->ImportOptions->visible()) { ?>
<?php $stok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($stok_list->SearchOptions->visible()) { ?>
<?php $stok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($stok_list->FilterOptions->visible()) { ?>
<?php $stok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$stok_list->renderOtherOptions();
?>
<?php $stok_list->showPageHeader(); ?>
<?php
$stok_list->showMessage();
?>
<?php if ($stok_list->TotalRecords > 0 || $stok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($stok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> stok">
<?php if (!$stok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$stok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $stok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $stok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstoklist" id="fstoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="stok">
<div id="gmp_stok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($stok_list->TotalRecords > 0 || $stok_list->isGridEdit()) { ?>
<table id="tbl_stoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$stok->RowType = ROWTYPE_HEADER;

// Render list options
$stok_list->renderListOptions();

// Render list options (header, left)
$stok_list->ListOptions->render("header", "left");
?>
<?php if ($stok_list->id_barang->Visible) { // id_barang ?>
	<?php if ($stok_list->SortUrl($stok_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $stok_list->id_barang->headerCellClass() ?>"><div id="elh_stok_id_barang" class="stok_id_barang"><div class="ew-table-header-caption"><?php echo $stok_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $stok_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $stok_list->SortUrl($stok_list->id_barang) ?>', 1);"><div id="elh_stok_id_barang" class="stok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $stok_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($stok_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($stok_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($stok_list->jumlah->Visible) { // jumlah ?>
	<?php if ($stok_list->SortUrl($stok_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $stok_list->jumlah->headerCellClass() ?>"><div id="elh_stok_jumlah" class="stok_jumlah"><div class="ew-table-header-caption"><?php echo $stok_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $stok_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $stok_list->SortUrl($stok_list->jumlah) ?>', 1);"><div id="elh_stok_jumlah" class="stok_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $stok_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($stok_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($stok_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($stok_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($stok_list->SortUrl($stok_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $stok_list->id_klinik->headerCellClass() ?>"><div id="elh_stok_id_klinik" class="stok_id_klinik"><div class="ew-table-header-caption"><?php echo $stok_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $stok_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $stok_list->SortUrl($stok_list->id_klinik) ?>', 1);"><div id="elh_stok_id_klinik" class="stok_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $stok_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($stok_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($stok_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$stok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($stok_list->ExportAll && $stok_list->isExport()) {
	$stok_list->StopRecord = $stok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($stok_list->TotalRecords > $stok_list->StartRecord + $stok_list->DisplayRecords - 1)
		$stok_list->StopRecord = $stok_list->StartRecord + $stok_list->DisplayRecords - 1;
	else
		$stok_list->StopRecord = $stok_list->TotalRecords;
}
$stok_list->RecordCount = $stok_list->StartRecord - 1;
if ($stok_list->Recordset && !$stok_list->Recordset->EOF) {
	$stok_list->Recordset->moveFirst();
	$selectLimit = $stok_list->UseSelectLimit;
	if (!$selectLimit && $stok_list->StartRecord > 1)
		$stok_list->Recordset->move($stok_list->StartRecord - 1);
} elseif (!$stok->AllowAddDeleteRow && $stok_list->StopRecord == 0) {
	$stok_list->StopRecord = $stok->GridAddRowCount;
}

// Initialize aggregate
$stok->RowType = ROWTYPE_AGGREGATEINIT;
$stok->resetAttributes();
$stok_list->renderRow();
while ($stok_list->RecordCount < $stok_list->StopRecord) {
	$stok_list->RecordCount++;
	if ($stok_list->RecordCount >= $stok_list->StartRecord) {
		$stok_list->RowCount++;

		// Set up key count
		$stok_list->KeyCount = $stok_list->RowIndex;

		// Init row class and style
		$stok->resetAttributes();
		$stok->CssClass = "";
		if ($stok_list->isGridAdd()) {
		} else {
			$stok_list->loadRowValues($stok_list->Recordset); // Load row values
		}
		$stok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$stok->RowAttrs->merge(["data-rowindex" => $stok_list->RowCount, "id" => "r" . $stok_list->RowCount . "_stok", "data-rowtype" => $stok->RowType]);

		// Render row
		$stok_list->renderRow();

		// Render list options
		$stok_list->renderListOptions();
?>
	<tr <?php echo $stok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$stok_list->ListOptions->render("body", "left", $stok_list->RowCount);
?>
	<?php if ($stok_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $stok_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $stok_list->RowCount ?>_stok_id_barang">
<span<?php echo $stok_list->id_barang->viewAttributes() ?>><?php echo $stok_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($stok_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $stok_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $stok_list->RowCount ?>_stok_jumlah">
<span<?php echo $stok_list->jumlah->viewAttributes() ?>><?php echo $stok_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($stok_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $stok_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $stok_list->RowCount ?>_stok_id_klinik">
<span<?php echo $stok_list->id_klinik->viewAttributes() ?>><?php echo $stok_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$stok_list->ListOptions->render("body", "right", $stok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$stok_list->isGridAdd())
		$stok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$stok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($stok_list->Recordset)
	$stok_list->Recordset->Close();
?>
<?php if (!$stok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$stok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $stok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $stok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($stok_list->TotalRecords == 0 && !$stok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $stok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$stok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$stok_list->isExport()) { ?>
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
$stok_list->terminate();
?>