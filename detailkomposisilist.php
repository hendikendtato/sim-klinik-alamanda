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
$detailkomposisi_list = new detailkomposisi_list();

// Run the page
$detailkomposisi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailkomposisi_list->isExport()) { ?>
<script>
var fdetailkomposisilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailkomposisilist = currentForm = new ew.Form("fdetailkomposisilist", "list");
	fdetailkomposisilist.formKeyCountName = '<?php echo $detailkomposisi_list->FormKeyCountName ?>';
	loadjs.done("fdetailkomposisilist");
});
var fdetailkomposisilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailkomposisilistsrch = currentSearchForm = new ew.Form("fdetailkomposisilistsrch");

	// Dynamic selection lists
	// Filters

	fdetailkomposisilistsrch.filterList = <?php echo $detailkomposisi_list->getFilterList() ?>;
	loadjs.done("fdetailkomposisilistsrch");
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
	$(".btn.btn-default.ew-add-edit.ew-add").hide(),$(".ew-row-link.ew-edit").hide(),$(".detailkirimbarang_delete").hide();
});
</script>
<?php } ?>
<?php if (!$detailkomposisi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailkomposisi_list->TotalRecords > 0 && $detailkomposisi_list->ExportOptions->visible()) { ?>
<?php $detailkomposisi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailkomposisi_list->ImportOptions->visible()) { ?>
<?php $detailkomposisi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailkomposisi_list->SearchOptions->visible()) { ?>
<?php $detailkomposisi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailkomposisi_list->FilterOptions->visible()) { ?>
<?php $detailkomposisi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailkomposisi_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailkomposisi_list->isExport("print")) { ?>
<?php
if ($detailkomposisi_list->DbMasterFilter != "" && $detailkomposisi->getCurrentMasterTable() == "komposisi") {
	if ($detailkomposisi_list->MasterRecordExists) {
		include_once "komposisimaster.php";
	}
}
?>
<?php } ?>
<?php
$detailkomposisi_list->renderOtherOptions();
?>
<?php $detailkomposisi_list->showPageHeader(); ?>
<?php
$detailkomposisi_list->showMessage();
?>
<?php if ($detailkomposisi_list->TotalRecords > 0 || $detailkomposisi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailkomposisi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailkomposisi">
<?php if (!$detailkomposisi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailkomposisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailkomposisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailkomposisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailkomposisilist" id="fdetailkomposisilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkomposisi">
<?php if ($detailkomposisi->getCurrentMasterTable() == "komposisi" && $detailkomposisi->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="komposisi">
<input type="hidden" name="fk_id_komposisi" value="<?php echo HtmlEncode($detailkomposisi_list->id_komposisi->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailkomposisi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailkomposisi_list->TotalRecords > 0 || $detailkomposisi_list->isGridEdit()) { ?>
<table id="tbl_detailkomposisilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailkomposisi->RowType = ROWTYPE_HEADER;

// Render list options
$detailkomposisi_list->renderListOptions();

// Render list options (header, left)
$detailkomposisi_list->ListOptions->render("header", "left");
?>
<?php if ($detailkomposisi_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailkomposisi_list->SortUrl($detailkomposisi_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailkomposisi_list->id_barang->headerCellClass() ?>"><div id="elh_detailkomposisi_id_barang" class="detailkomposisi_id_barang"><div class="ew-table-header-caption"><?php echo $detailkomposisi_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailkomposisi_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkomposisi_list->SortUrl($detailkomposisi_list->id_barang) ?>', 1);"><div id="elh_detailkomposisi_id_barang" class="detailkomposisi_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkomposisi_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailkomposisi_list->SortUrl($detailkomposisi_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailkomposisi_list->jumlah->headerCellClass() ?>"><div id="elh_detailkomposisi_jumlah" class="detailkomposisi_jumlah"><div class="ew-table-header-caption"><?php echo $detailkomposisi_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailkomposisi_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkomposisi_list->SortUrl($detailkomposisi_list->jumlah) ?>', 1);"><div id="elh_detailkomposisi_jumlah" class="detailkomposisi_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkomposisi_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailkomposisi_list->SortUrl($detailkomposisi_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailkomposisi_list->id_satuan->headerCellClass() ?>"><div id="elh_detailkomposisi_id_satuan" class="detailkomposisi_id_satuan"><div class="ew-table-header-caption"><?php echo $detailkomposisi_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailkomposisi_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkomposisi_list->SortUrl($detailkomposisi_list->id_satuan) ?>', 1);"><div id="elh_detailkomposisi_id_satuan" class="detailkomposisi_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailkomposisi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailkomposisi_list->ExportAll && $detailkomposisi_list->isExport()) {
	$detailkomposisi_list->StopRecord = $detailkomposisi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailkomposisi_list->TotalRecords > $detailkomposisi_list->StartRecord + $detailkomposisi_list->DisplayRecords - 1)
		$detailkomposisi_list->StopRecord = $detailkomposisi_list->StartRecord + $detailkomposisi_list->DisplayRecords - 1;
	else
		$detailkomposisi_list->StopRecord = $detailkomposisi_list->TotalRecords;
}
$detailkomposisi_list->RecordCount = $detailkomposisi_list->StartRecord - 1;
if ($detailkomposisi_list->Recordset && !$detailkomposisi_list->Recordset->EOF) {
	$detailkomposisi_list->Recordset->moveFirst();
	$selectLimit = $detailkomposisi_list->UseSelectLimit;
	if (!$selectLimit && $detailkomposisi_list->StartRecord > 1)
		$detailkomposisi_list->Recordset->move($detailkomposisi_list->StartRecord - 1);
} elseif (!$detailkomposisi->AllowAddDeleteRow && $detailkomposisi_list->StopRecord == 0) {
	$detailkomposisi_list->StopRecord = $detailkomposisi->GridAddRowCount;
}

// Initialize aggregate
$detailkomposisi->RowType = ROWTYPE_AGGREGATEINIT;
$detailkomposisi->resetAttributes();
$detailkomposisi_list->renderRow();
while ($detailkomposisi_list->RecordCount < $detailkomposisi_list->StopRecord) {
	$detailkomposisi_list->RecordCount++;
	if ($detailkomposisi_list->RecordCount >= $detailkomposisi_list->StartRecord) {
		$detailkomposisi_list->RowCount++;

		// Set up key count
		$detailkomposisi_list->KeyCount = $detailkomposisi_list->RowIndex;

		// Init row class and style
		$detailkomposisi->resetAttributes();
		$detailkomposisi->CssClass = "";
		if ($detailkomposisi_list->isGridAdd()) {
		} else {
			$detailkomposisi_list->loadRowValues($detailkomposisi_list->Recordset); // Load row values
		}
		$detailkomposisi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailkomposisi->RowAttrs->merge(["data-rowindex" => $detailkomposisi_list->RowCount, "id" => "r" . $detailkomposisi_list->RowCount . "_detailkomposisi", "data-rowtype" => $detailkomposisi->RowType]);

		// Render row
		$detailkomposisi_list->renderRow();

		// Render list options
		$detailkomposisi_list->renderListOptions();
?>
	<tr <?php echo $detailkomposisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkomposisi_list->ListOptions->render("body", "left", $detailkomposisi_list->RowCount);
?>
	<?php if ($detailkomposisi_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailkomposisi_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailkomposisi_list->RowCount ?>_detailkomposisi_id_barang">
<span<?php echo $detailkomposisi_list->id_barang->viewAttributes() ?>><?php echo $detailkomposisi_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailkomposisi_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailkomposisi_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailkomposisi_list->RowCount ?>_detailkomposisi_jumlah">
<span<?php echo $detailkomposisi_list->jumlah->viewAttributes() ?>><?php echo $detailkomposisi_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailkomposisi_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailkomposisi_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailkomposisi_list->RowCount ?>_detailkomposisi_id_satuan">
<span<?php echo $detailkomposisi_list->id_satuan->viewAttributes() ?>><?php echo $detailkomposisi_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailkomposisi_list->ListOptions->render("body", "right", $detailkomposisi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailkomposisi_list->isGridAdd())
		$detailkomposisi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailkomposisi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailkomposisi_list->Recordset)
	$detailkomposisi_list->Recordset->Close();
?>
<?php if (!$detailkomposisi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailkomposisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailkomposisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailkomposisi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailkomposisi_list->TotalRecords == 0 && !$detailkomposisi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailkomposisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailkomposisi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailkomposisi_list->isExport()) { ?>
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
$detailkomposisi_list->terminate();
?>