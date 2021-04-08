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
$detailrekmedpenjualan_list = new detailrekmedpenjualan_list();

// Run the page
$detailrekmedpenjualan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedpenjualan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailrekmedpenjualan_list->isExport()) { ?>
<script>
var fdetailrekmedpenjualanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailrekmedpenjualanlist = currentForm = new ew.Form("fdetailrekmedpenjualanlist", "list");
	fdetailrekmedpenjualanlist.formKeyCountName = '<?php echo $detailrekmedpenjualan_list->FormKeyCountName ?>';
	loadjs.done("fdetailrekmedpenjualanlist");
});
var fdetailrekmedpenjualanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailrekmedpenjualanlistsrch = currentSearchForm = new ew.Form("fdetailrekmedpenjualanlistsrch");

	// Dynamic selection lists
	// Filters

	fdetailrekmedpenjualanlistsrch.filterList = <?php echo $detailrekmedpenjualan_list->getFilterList() ?>;
	loadjs.done("fdetailrekmedpenjualanlistsrch");
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
<?php if (!$detailrekmedpenjualan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailrekmedpenjualan_list->TotalRecords > 0 && $detailrekmedpenjualan_list->ExportOptions->visible()) { ?>
<?php $detailrekmedpenjualan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_list->ImportOptions->visible()) { ?>
<?php $detailrekmedpenjualan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_list->SearchOptions->visible()) { ?>
<?php $detailrekmedpenjualan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_list->FilterOptions->visible()) { ?>
<?php $detailrekmedpenjualan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailrekmedpenjualan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailrekmedpenjualan_list->isExport("print")) { ?>
<?php
if ($detailrekmedpenjualan_list->DbMasterFilter != "" && $detailrekmedpenjualan->getCurrentMasterTable() == "rekmeddokter") {
	if ($detailrekmedpenjualan_list->MasterRecordExists) {
		include_once "rekmeddoktermaster.php";
	}
}
?>
<?php } ?>
<?php
$detailrekmedpenjualan_list->renderOtherOptions();
?>
<?php $detailrekmedpenjualan_list->showPageHeader(); ?>
<?php
$detailrekmedpenjualan_list->showMessage();
?>
<?php if ($detailrekmedpenjualan_list->TotalRecords > 0 || $detailrekmedpenjualan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailrekmedpenjualan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailrekmedpenjualan">
<?php if (!$detailrekmedpenjualan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailrekmedpenjualan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailrekmedpenjualan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailrekmedpenjualan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailrekmedpenjualanlist" id="fdetailrekmedpenjualanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedpenjualan">
<?php if ($detailrekmedpenjualan->getCurrentMasterTable() == "rekmeddokter" && $detailrekmedpenjualan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmedpenjualan_list->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailrekmedpenjualan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailrekmedpenjualan_list->TotalRecords > 0 || $detailrekmedpenjualan_list->isGridEdit()) { ?>
<table id="tbl_detailrekmedpenjualanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailrekmedpenjualan->RowType = ROWTYPE_HEADER;

// Render list options
$detailrekmedpenjualan_list->renderListOptions();

// Render list options (header, left)
$detailrekmedpenjualan_list->ListOptions->render("header", "left");
?>
<?php if ($detailrekmedpenjualan_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmedpenjualan_list->SortUrl($detailrekmedpenjualan_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedpenjualan_list->id_barang->headerCellClass() ?>"><div id="elh_detailrekmedpenjualan_id_barang" class="detailrekmedpenjualan_id_barang"><div class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedpenjualan_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmedpenjualan_list->SortUrl($detailrekmedpenjualan_list->id_barang) ?>', 1);"><div id="elh_detailrekmedpenjualan_id_barang" class="detailrekmedpenjualan_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmedpenjualan_list->SortUrl($detailrekmedpenjualan_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedpenjualan_list->jumlah->headerCellClass() ?>"><div id="elh_detailrekmedpenjualan_jumlah" class="detailrekmedpenjualan_jumlah"><div class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedpenjualan_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmedpenjualan_list->SortUrl($detailrekmedpenjualan_list->jumlah) ?>', 1);"><div id="elh_detailrekmedpenjualan_jumlah" class="detailrekmedpenjualan_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailrekmedpenjualan_list->SortUrl($detailrekmedpenjualan_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedpenjualan_list->id_satuan->headerCellClass() ?>"><div id="elh_detailrekmedpenjualan_id_satuan" class="detailrekmedpenjualan_id_satuan"><div class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedpenjualan_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmedpenjualan_list->SortUrl($detailrekmedpenjualan_list->id_satuan) ?>', 1);"><div id="elh_detailrekmedpenjualan_id_satuan" class="detailrekmedpenjualan_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmedpenjualan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailrekmedpenjualan_list->ExportAll && $detailrekmedpenjualan_list->isExport()) {
	$detailrekmedpenjualan_list->StopRecord = $detailrekmedpenjualan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailrekmedpenjualan_list->TotalRecords > $detailrekmedpenjualan_list->StartRecord + $detailrekmedpenjualan_list->DisplayRecords - 1)
		$detailrekmedpenjualan_list->StopRecord = $detailrekmedpenjualan_list->StartRecord + $detailrekmedpenjualan_list->DisplayRecords - 1;
	else
		$detailrekmedpenjualan_list->StopRecord = $detailrekmedpenjualan_list->TotalRecords;
}
$detailrekmedpenjualan_list->RecordCount = $detailrekmedpenjualan_list->StartRecord - 1;
if ($detailrekmedpenjualan_list->Recordset && !$detailrekmedpenjualan_list->Recordset->EOF) {
	$detailrekmedpenjualan_list->Recordset->moveFirst();
	$selectLimit = $detailrekmedpenjualan_list->UseSelectLimit;
	if (!$selectLimit && $detailrekmedpenjualan_list->StartRecord > 1)
		$detailrekmedpenjualan_list->Recordset->move($detailrekmedpenjualan_list->StartRecord - 1);
} elseif (!$detailrekmedpenjualan->AllowAddDeleteRow && $detailrekmedpenjualan_list->StopRecord == 0) {
	$detailrekmedpenjualan_list->StopRecord = $detailrekmedpenjualan->GridAddRowCount;
}

// Initialize aggregate
$detailrekmedpenjualan->RowType = ROWTYPE_AGGREGATEINIT;
$detailrekmedpenjualan->resetAttributes();
$detailrekmedpenjualan_list->renderRow();
while ($detailrekmedpenjualan_list->RecordCount < $detailrekmedpenjualan_list->StopRecord) {
	$detailrekmedpenjualan_list->RecordCount++;
	if ($detailrekmedpenjualan_list->RecordCount >= $detailrekmedpenjualan_list->StartRecord) {
		$detailrekmedpenjualan_list->RowCount++;

		// Set up key count
		$detailrekmedpenjualan_list->KeyCount = $detailrekmedpenjualan_list->RowIndex;

		// Init row class and style
		$detailrekmedpenjualan->resetAttributes();
		$detailrekmedpenjualan->CssClass = "";
		if ($detailrekmedpenjualan_list->isGridAdd()) {
		} else {
			$detailrekmedpenjualan_list->loadRowValues($detailrekmedpenjualan_list->Recordset); // Load row values
		}
		$detailrekmedpenjualan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailrekmedpenjualan->RowAttrs->merge(["data-rowindex" => $detailrekmedpenjualan_list->RowCount, "id" => "r" . $detailrekmedpenjualan_list->RowCount . "_detailrekmedpenjualan", "data-rowtype" => $detailrekmedpenjualan->RowType]);

		// Render row
		$detailrekmedpenjualan_list->renderRow();

		// Render list options
		$detailrekmedpenjualan_list->renderListOptions();
?>
	<tr <?php echo $detailrekmedpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedpenjualan_list->ListOptions->render("body", "left", $detailrekmedpenjualan_list->RowCount);
?>
	<?php if ($detailrekmedpenjualan_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailrekmedpenjualan_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedpenjualan_list->RowCount ?>_detailrekmedpenjualan_id_barang">
<span<?php echo $detailrekmedpenjualan_list->id_barang->viewAttributes() ?>><?php echo $detailrekmedpenjualan_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailrekmedpenjualan_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailrekmedpenjualan_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedpenjualan_list->RowCount ?>_detailrekmedpenjualan_jumlah">
<span<?php echo $detailrekmedpenjualan_list->jumlah->viewAttributes() ?>><?php echo $detailrekmedpenjualan_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailrekmedpenjualan_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailrekmedpenjualan_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedpenjualan_list->RowCount ?>_detailrekmedpenjualan_id_satuan">
<span<?php echo $detailrekmedpenjualan_list->id_satuan->viewAttributes() ?>><?php echo $detailrekmedpenjualan_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedpenjualan_list->ListOptions->render("body", "right", $detailrekmedpenjualan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailrekmedpenjualan_list->isGridAdd())
		$detailrekmedpenjualan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailrekmedpenjualan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailrekmedpenjualan_list->Recordset)
	$detailrekmedpenjualan_list->Recordset->Close();
?>
<?php if (!$detailrekmedpenjualan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailrekmedpenjualan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailrekmedpenjualan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailrekmedpenjualan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailrekmedpenjualan_list->TotalRecords == 0 && !$detailrekmedpenjualan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailrekmedpenjualan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailrekmedpenjualan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailrekmedpenjualan_list->isExport()) { ?>
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
$detailrekmedpenjualan_list->terminate();
?>