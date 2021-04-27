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
$detailrekmeddok_list = new detailrekmeddok_list();

// Run the page
$detailrekmeddok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailrekmeddok_list->isExport()) { ?>
<script>
var fdetailrekmeddoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailrekmeddoklist = currentForm = new ew.Form("fdetailrekmeddoklist", "list");
	fdetailrekmeddoklist.formKeyCountName = '<?php echo $detailrekmeddok_list->FormKeyCountName ?>';
	loadjs.done("fdetailrekmeddoklist");
});
var fdetailrekmeddoklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailrekmeddoklistsrch = currentSearchForm = new ew.Form("fdetailrekmeddoklistsrch");

	// Dynamic selection lists
	// Filters

	fdetailrekmeddoklistsrch.filterList = <?php echo $detailrekmeddok_list->getFilterList() ?>;
	loadjs.done("fdetailrekmeddoklistsrch");
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
<?php if (!$detailrekmeddok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailrekmeddok_list->TotalRecords > 0 && $detailrekmeddok_list->ExportOptions->visible()) { ?>
<?php $detailrekmeddok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmeddok_list->ImportOptions->visible()) { ?>
<?php $detailrekmeddok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmeddok_list->SearchOptions->visible()) { ?>
<?php $detailrekmeddok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmeddok_list->FilterOptions->visible()) { ?>
<?php $detailrekmeddok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailrekmeddok_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailrekmeddok_list->isExport("print")) { ?>
<?php
if ($detailrekmeddok_list->DbMasterFilter != "" && $detailrekmeddok->getCurrentMasterTable() == "rekmeddokter") {
	if ($detailrekmeddok_list->MasterRecordExists) {
		include_once "rekmeddoktermaster.php";
	}
}
?>
<?php } ?>
<?php
$detailrekmeddok_list->renderOtherOptions();
?>
<?php $detailrekmeddok_list->showPageHeader(); ?>
<?php
$detailrekmeddok_list->showMessage();
?>
<?php if ($detailrekmeddok_list->TotalRecords > 0 || $detailrekmeddok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailrekmeddok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailrekmeddok">
<?php if (!$detailrekmeddok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailrekmeddok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailrekmeddok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailrekmeddok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailrekmeddoklist" id="fdetailrekmeddoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmeddok">
<?php if ($detailrekmeddok->getCurrentMasterTable() == "rekmeddokter" && $detailrekmeddok->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmeddok_list->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailrekmeddok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailrekmeddok_list->TotalRecords > 0 || $detailrekmeddok_list->isGridEdit()) { ?>
<table id="tbl_detailrekmeddoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailrekmeddok->RowType = ROWTYPE_HEADER;

// Render list options
$detailrekmeddok_list->renderListOptions();

// Render list options (header, left)
$detailrekmeddok_list->ListOptions->render("header", "left");
?>
<?php if ($detailrekmeddok_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmeddok_list->SortUrl($detailrekmeddok_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmeddok_list->id_barang->headerCellClass() ?>"><div id="elh_detailrekmeddok_id_barang" class="detailrekmeddok_id_barang"><div class="ew-table-header-caption"><?php echo $detailrekmeddok_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmeddok_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmeddok_list->SortUrl($detailrekmeddok_list->id_barang) ?>', 1);"><div id="elh_detailrekmeddok_id_barang" class="detailrekmeddok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmeddok_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmeddok_list->SortUrl($detailrekmeddok_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmeddok_list->jumlah->headerCellClass() ?>"><div id="elh_detailrekmeddok_jumlah" class="detailrekmeddok_jumlah"><div class="ew-table-header-caption"><?php echo $detailrekmeddok_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmeddok_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmeddok_list->SortUrl($detailrekmeddok_list->jumlah) ?>', 1);"><div id="elh_detailrekmeddok_jumlah" class="detailrekmeddok_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmeddok_list->satuan->Visible) { // satuan ?>
	<?php if ($detailrekmeddok_list->SortUrl($detailrekmeddok_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $detailrekmeddok_list->satuan->headerCellClass() ?>"><div id="elh_detailrekmeddok_satuan" class="detailrekmeddok_satuan"><div class="ew-table-header-caption"><?php echo $detailrekmeddok_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $detailrekmeddok_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmeddok_list->SortUrl($detailrekmeddok_list->satuan) ?>', 1);"><div id="elh_detailrekmeddok_satuan" class="detailrekmeddok_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_list->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmeddok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailrekmeddok_list->ExportAll && $detailrekmeddok_list->isExport()) {
	$detailrekmeddok_list->StopRecord = $detailrekmeddok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailrekmeddok_list->TotalRecords > $detailrekmeddok_list->StartRecord + $detailrekmeddok_list->DisplayRecords - 1)
		$detailrekmeddok_list->StopRecord = $detailrekmeddok_list->StartRecord + $detailrekmeddok_list->DisplayRecords - 1;
	else
		$detailrekmeddok_list->StopRecord = $detailrekmeddok_list->TotalRecords;
}
$detailrekmeddok_list->RecordCount = $detailrekmeddok_list->StartRecord - 1;
if ($detailrekmeddok_list->Recordset && !$detailrekmeddok_list->Recordset->EOF) {
	$detailrekmeddok_list->Recordset->moveFirst();
	$selectLimit = $detailrekmeddok_list->UseSelectLimit;
	if (!$selectLimit && $detailrekmeddok_list->StartRecord > 1)
		$detailrekmeddok_list->Recordset->move($detailrekmeddok_list->StartRecord - 1);
} elseif (!$detailrekmeddok->AllowAddDeleteRow && $detailrekmeddok_list->StopRecord == 0) {
	$detailrekmeddok_list->StopRecord = $detailrekmeddok->GridAddRowCount;
}

// Initialize aggregate
$detailrekmeddok->RowType = ROWTYPE_AGGREGATEINIT;
$detailrekmeddok->resetAttributes();
$detailrekmeddok_list->renderRow();
while ($detailrekmeddok_list->RecordCount < $detailrekmeddok_list->StopRecord) {
	$detailrekmeddok_list->RecordCount++;
	if ($detailrekmeddok_list->RecordCount >= $detailrekmeddok_list->StartRecord) {
		$detailrekmeddok_list->RowCount++;

		// Set up key count
		$detailrekmeddok_list->KeyCount = $detailrekmeddok_list->RowIndex;

		// Init row class and style
		$detailrekmeddok->resetAttributes();
		$detailrekmeddok->CssClass = "";
		if ($detailrekmeddok_list->isGridAdd()) {
		} else {
			$detailrekmeddok_list->loadRowValues($detailrekmeddok_list->Recordset); // Load row values
		}
		$detailrekmeddok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailrekmeddok->RowAttrs->merge(["data-rowindex" => $detailrekmeddok_list->RowCount, "id" => "r" . $detailrekmeddok_list->RowCount . "_detailrekmeddok", "data-rowtype" => $detailrekmeddok->RowType]);

		// Render row
		$detailrekmeddok_list->renderRow();

		// Render list options
		$detailrekmeddok_list->renderListOptions();
?>
	<tr <?php echo $detailrekmeddok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmeddok_list->ListOptions->render("body", "left", $detailrekmeddok_list->RowCount);
?>
	<?php if ($detailrekmeddok_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailrekmeddok_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailrekmeddok_list->RowCount ?>_detailrekmeddok_id_barang">
<span<?php echo $detailrekmeddok_list->id_barang->viewAttributes() ?>><?php echo $detailrekmeddok_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailrekmeddok_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailrekmeddok_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailrekmeddok_list->RowCount ?>_detailrekmeddok_jumlah">
<span<?php echo $detailrekmeddok_list->jumlah->viewAttributes() ?>><?php echo $detailrekmeddok_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailrekmeddok_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $detailrekmeddok_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $detailrekmeddok_list->RowCount ?>_detailrekmeddok_satuan">
<span<?php echo $detailrekmeddok_list->satuan->viewAttributes() ?>><?php echo $detailrekmeddok_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmeddok_list->ListOptions->render("body", "right", $detailrekmeddok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailrekmeddok_list->isGridAdd())
		$detailrekmeddok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailrekmeddok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailrekmeddok_list->Recordset)
	$detailrekmeddok_list->Recordset->Close();
?>
<?php if (!$detailrekmeddok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailrekmeddok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailrekmeddok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailrekmeddok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailrekmeddok_list->TotalRecords == 0 && !$detailrekmeddok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailrekmeddok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailrekmeddok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailrekmeddok_list->isExport()) { ?>
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
$detailrekmeddok_list->terminate();
?>