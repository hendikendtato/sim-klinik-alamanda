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
$V_kartustok_list = new V_kartustok_list();

// Run the page
$V_kartustok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$V_kartustok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$V_kartustok_list->isExport()) { ?>
<script>
var fV_kartustoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fV_kartustoklist = currentForm = new ew.Form("fV_kartustoklist", "list");
	fV_kartustoklist.formKeyCountName = '<?php echo $V_kartustok_list->FormKeyCountName ?>';
	loadjs.done("fV_kartustoklist");
});
var fV_kartustoklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fV_kartustoklistsrch = currentSearchForm = new ew.Form("fV_kartustoklistsrch");

	// Dynamic selection lists
	// Filters

	fV_kartustoklistsrch.filterList = <?php echo $V_kartustok_list->getFilterList() ?>;
	loadjs.done("fV_kartustoklistsrch");
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
<?php if (!$V_kartustok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($V_kartustok_list->TotalRecords > 0 && $V_kartustok_list->ExportOptions->visible()) { ?>
<?php $V_kartustok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($V_kartustok_list->ImportOptions->visible()) { ?>
<?php $V_kartustok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($V_kartustok_list->SearchOptions->visible()) { ?>
<?php $V_kartustok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($V_kartustok_list->FilterOptions->visible()) { ?>
<?php $V_kartustok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$V_kartustok_list->renderOtherOptions();
?>
<?php $V_kartustok_list->showPageHeader(); ?>
<?php
$V_kartustok_list->showMessage();
?>
<?php if ($V_kartustok_list->TotalRecords > 0 || $V_kartustok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($V_kartustok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> V_kartustok">
<?php if (!$V_kartustok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$V_kartustok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $V_kartustok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $V_kartustok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fV_kartustoklist" id="fV_kartustoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="V_kartustok">
<div id="gmp_V_kartustok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($V_kartustok_list->TotalRecords > 0 || $V_kartustok_list->isGridEdit()) { ?>
<table id="tbl_V_kartustoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$V_kartustok->RowType = ROWTYPE_HEADER;

// Render list options
$V_kartustok_list->renderListOptions();

// Render list options (header, left)
$V_kartustok_list->ListOptions->render("header", "left");
?>
<?php if ($V_kartustok_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($V_kartustok_list->SortUrl($V_kartustok_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $V_kartustok_list->nama_barang->headerCellClass() ?>"><div id="elh_V_kartustok_nama_barang" class="V_kartustok_nama_barang"><div class="ew-table-header-caption"><?php echo $V_kartustok_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $V_kartustok_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $V_kartustok_list->SortUrl($V_kartustok_list->nama_barang) ?>', 1);"><div id="elh_V_kartustok_nama_barang" class="V_kartustok_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $V_kartustok_list->nama_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($V_kartustok_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($V_kartustok_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$V_kartustok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($V_kartustok_list->ExportAll && $V_kartustok_list->isExport()) {
	$V_kartustok_list->StopRecord = $V_kartustok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($V_kartustok_list->TotalRecords > $V_kartustok_list->StartRecord + $V_kartustok_list->DisplayRecords - 1)
		$V_kartustok_list->StopRecord = $V_kartustok_list->StartRecord + $V_kartustok_list->DisplayRecords - 1;
	else
		$V_kartustok_list->StopRecord = $V_kartustok_list->TotalRecords;
}
$V_kartustok_list->RecordCount = $V_kartustok_list->StartRecord - 1;
if ($V_kartustok_list->Recordset && !$V_kartustok_list->Recordset->EOF) {
	$V_kartustok_list->Recordset->moveFirst();
	$selectLimit = $V_kartustok_list->UseSelectLimit;
	if (!$selectLimit && $V_kartustok_list->StartRecord > 1)
		$V_kartustok_list->Recordset->move($V_kartustok_list->StartRecord - 1);
} elseif (!$V_kartustok->AllowAddDeleteRow && $V_kartustok_list->StopRecord == 0) {
	$V_kartustok_list->StopRecord = $V_kartustok->GridAddRowCount;
}

// Initialize aggregate
$V_kartustok->RowType = ROWTYPE_AGGREGATEINIT;
$V_kartustok->resetAttributes();
$V_kartustok_list->renderRow();
while ($V_kartustok_list->RecordCount < $V_kartustok_list->StopRecord) {
	$V_kartustok_list->RecordCount++;
	if ($V_kartustok_list->RecordCount >= $V_kartustok_list->StartRecord) {
		$V_kartustok_list->RowCount++;

		// Set up key count
		$V_kartustok_list->KeyCount = $V_kartustok_list->RowIndex;

		// Init row class and style
		$V_kartustok->resetAttributes();
		$V_kartustok->CssClass = "";
		if ($V_kartustok_list->isGridAdd()) {
		} else {
			$V_kartustok_list->loadRowValues($V_kartustok_list->Recordset); // Load row values
		}
		$V_kartustok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$V_kartustok->RowAttrs->merge(["data-rowindex" => $V_kartustok_list->RowCount, "id" => "r" . $V_kartustok_list->RowCount . "_V_kartustok", "data-rowtype" => $V_kartustok->RowType]);

		// Render row
		$V_kartustok_list->renderRow();

		// Render list options
		$V_kartustok_list->renderListOptions();
?>
	<tr <?php echo $V_kartustok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$V_kartustok_list->ListOptions->render("body", "left", $V_kartustok_list->RowCount);
?>
	<?php if ($V_kartustok_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $V_kartustok_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $V_kartustok_list->RowCount ?>_V_kartustok_nama_barang">
<span<?php echo $V_kartustok_list->nama_barang->viewAttributes() ?>><?php echo $V_kartustok_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$V_kartustok_list->ListOptions->render("body", "right", $V_kartustok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$V_kartustok_list->isGridAdd())
		$V_kartustok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$V_kartustok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($V_kartustok_list->Recordset)
	$V_kartustok_list->Recordset->Close();
?>
<?php if (!$V_kartustok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$V_kartustok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $V_kartustok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $V_kartustok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($V_kartustok_list->TotalRecords == 0 && !$V_kartustok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $V_kartustok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$V_kartustok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$V_kartustok_list->isExport()) { ?>
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
$V_kartustok_list->terminate();
?>