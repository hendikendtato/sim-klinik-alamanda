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
$detailpromo_list = new detailpromo_list();

// Run the page
$detailpromo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpromo_list->isExport()) { ?>
<script>
var fdetailpromolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailpromolist = currentForm = new ew.Form("fdetailpromolist", "list");
	fdetailpromolist.formKeyCountName = '<?php echo $detailpromo_list->FormKeyCountName ?>';
	loadjs.done("fdetailpromolist");
});
var fdetailpromolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailpromolistsrch = currentSearchForm = new ew.Form("fdetailpromolistsrch");

	// Dynamic selection lists
	// Filters

	fdetailpromolistsrch.filterList = <?php echo $detailpromo_list->getFilterList() ?>;
	loadjs.done("fdetailpromolistsrch");
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
<?php if (!$detailpromo_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailpromo_list->TotalRecords > 0 && $detailpromo_list->ExportOptions->visible()) { ?>
<?php $detailpromo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpromo_list->ImportOptions->visible()) { ?>
<?php $detailpromo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpromo_list->SearchOptions->visible()) { ?>
<?php $detailpromo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailpromo_list->FilterOptions->visible()) { ?>
<?php $detailpromo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailpromo_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailpromo_list->isExport("print")) { ?>
<?php
if ($detailpromo_list->DbMasterFilter != "" && $detailpromo->getCurrentMasterTable() == "promo") {
	if ($detailpromo_list->MasterRecordExists) {
		include_once "promomaster.php";
	}
}
?>
<?php } ?>
<?php
$detailpromo_list->renderOtherOptions();
?>
<?php $detailpromo_list->showPageHeader(); ?>
<?php
$detailpromo_list->showMessage();
?>
<?php if ($detailpromo_list->TotalRecords > 0 || $detailpromo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpromo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpromo">
<?php if (!$detailpromo_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailpromo_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpromo_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpromo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailpromolist" id="fdetailpromolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpromo">
<?php if ($detailpromo->getCurrentMasterTable() == "promo" && $detailpromo->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="promo">
<input type="hidden" name="fk_id_promo" value="<?php echo HtmlEncode($detailpromo_list->id_promo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailpromo" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailpromo_list->TotalRecords > 0 || $detailpromo_list->isGridEdit()) { ?>
<table id="tbl_detailpromolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpromo->RowType = ROWTYPE_HEADER;

// Render list options
$detailpromo_list->renderListOptions();

// Render list options (header, left)
$detailpromo_list->ListOptions->render("header", "left");
?>
<?php if ($detailpromo_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpromo_list->SortUrl($detailpromo_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailpromo_list->id_barang->headerCellClass() ?>"><div id="elh_detailpromo_id_barang" class="detailpromo_id_barang"><div class="ew-table-header-caption"><?php echo $detailpromo_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailpromo_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpromo_list->SortUrl($detailpromo_list->id_barang) ?>', 1);"><div id="elh_detailpromo_id_barang" class="detailpromo_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpromo_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailpromo_list->SortUrl($detailpromo_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailpromo_list->jumlah->headerCellClass() ?>"><div id="elh_detailpromo_jumlah" class="detailpromo_jumlah"><div class="ew-table-header-caption"><?php echo $detailpromo_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailpromo_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpromo_list->SortUrl($detailpromo_list->jumlah) ?>', 1);"><div id="elh_detailpromo_jumlah" class="detailpromo_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpromo_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailpromo_list->SortUrl($detailpromo_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailpromo_list->id_satuan->headerCellClass() ?>"><div id="elh_detailpromo_id_satuan" class="detailpromo_id_satuan"><div class="ew-table-header-caption"><?php echo $detailpromo_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailpromo_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpromo_list->SortUrl($detailpromo_list->id_satuan) ?>', 1);"><div id="elh_detailpromo_id_satuan" class="detailpromo_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpromo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailpromo_list->ExportAll && $detailpromo_list->isExport()) {
	$detailpromo_list->StopRecord = $detailpromo_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailpromo_list->TotalRecords > $detailpromo_list->StartRecord + $detailpromo_list->DisplayRecords - 1)
		$detailpromo_list->StopRecord = $detailpromo_list->StartRecord + $detailpromo_list->DisplayRecords - 1;
	else
		$detailpromo_list->StopRecord = $detailpromo_list->TotalRecords;
}
$detailpromo_list->RecordCount = $detailpromo_list->StartRecord - 1;
if ($detailpromo_list->Recordset && !$detailpromo_list->Recordset->EOF) {
	$detailpromo_list->Recordset->moveFirst();
	$selectLimit = $detailpromo_list->UseSelectLimit;
	if (!$selectLimit && $detailpromo_list->StartRecord > 1)
		$detailpromo_list->Recordset->move($detailpromo_list->StartRecord - 1);
} elseif (!$detailpromo->AllowAddDeleteRow && $detailpromo_list->StopRecord == 0) {
	$detailpromo_list->StopRecord = $detailpromo->GridAddRowCount;
}

// Initialize aggregate
$detailpromo->RowType = ROWTYPE_AGGREGATEINIT;
$detailpromo->resetAttributes();
$detailpromo_list->renderRow();
while ($detailpromo_list->RecordCount < $detailpromo_list->StopRecord) {
	$detailpromo_list->RecordCount++;
	if ($detailpromo_list->RecordCount >= $detailpromo_list->StartRecord) {
		$detailpromo_list->RowCount++;

		// Set up key count
		$detailpromo_list->KeyCount = $detailpromo_list->RowIndex;

		// Init row class and style
		$detailpromo->resetAttributes();
		$detailpromo->CssClass = "";
		if ($detailpromo_list->isGridAdd()) {
		} else {
			$detailpromo_list->loadRowValues($detailpromo_list->Recordset); // Load row values
		}
		$detailpromo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailpromo->RowAttrs->merge(["data-rowindex" => $detailpromo_list->RowCount, "id" => "r" . $detailpromo_list->RowCount . "_detailpromo", "data-rowtype" => $detailpromo->RowType]);

		// Render row
		$detailpromo_list->renderRow();

		// Render list options
		$detailpromo_list->renderListOptions();
?>
	<tr <?php echo $detailpromo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpromo_list->ListOptions->render("body", "left", $detailpromo_list->RowCount);
?>
	<?php if ($detailpromo_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailpromo_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpromo_list->RowCount ?>_detailpromo_id_barang">
<span<?php echo $detailpromo_list->id_barang->viewAttributes() ?>><?php echo $detailpromo_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpromo_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailpromo_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailpromo_list->RowCount ?>_detailpromo_jumlah">
<span<?php echo $detailpromo_list->jumlah->viewAttributes() ?>><?php echo $detailpromo_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpromo_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailpromo_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailpromo_list->RowCount ?>_detailpromo_id_satuan">
<span<?php echo $detailpromo_list->id_satuan->viewAttributes() ?>><?php echo $detailpromo_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpromo_list->ListOptions->render("body", "right", $detailpromo_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailpromo_list->isGridAdd())
		$detailpromo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailpromo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpromo_list->Recordset)
	$detailpromo_list->Recordset->Close();
?>
<?php if (!$detailpromo_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailpromo_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpromo_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpromo_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpromo_list->TotalRecords == 0 && !$detailpromo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpromo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailpromo_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpromo_list->isExport()) { ?>
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
$detailpromo_list->terminate();
?>