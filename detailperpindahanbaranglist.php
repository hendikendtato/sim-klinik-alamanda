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
$detailperpindahanbarang_list = new detailperpindahanbarang_list();

// Run the page
$detailperpindahanbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailperpindahanbarang_list->isExport()) { ?>
<script>
var fdetailperpindahanbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailperpindahanbaranglist = currentForm = new ew.Form("fdetailperpindahanbaranglist", "list");
	fdetailperpindahanbaranglist.formKeyCountName = '<?php echo $detailperpindahanbarang_list->FormKeyCountName ?>';
	loadjs.done("fdetailperpindahanbaranglist");
});
var fdetailperpindahanbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailperpindahanbaranglistsrch = currentSearchForm = new ew.Form("fdetailperpindahanbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fdetailperpindahanbaranglistsrch.filterList = <?php echo $detailperpindahanbarang_list->getFilterList() ?>;
	loadjs.done("fdetailperpindahanbaranglistsrch");
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
<?php if (!$detailperpindahanbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailperpindahanbarang_list->TotalRecords > 0 && $detailperpindahanbarang_list->ExportOptions->visible()) { ?>
<?php $detailperpindahanbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->ImportOptions->visible()) { ?>
<?php $detailperpindahanbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->SearchOptions->visible()) { ?>
<?php $detailperpindahanbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->FilterOptions->visible()) { ?>
<?php $detailperpindahanbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailperpindahanbarang_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailperpindahanbarang_list->isExport("print")) { ?>
<?php
if ($detailperpindahanbarang_list->DbMasterFilter != "" && $detailperpindahanbarang->getCurrentMasterTable() == "perpindahanbarang") {
	if ($detailperpindahanbarang_list->MasterRecordExists) {
		include_once "perpindahanbarangmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailperpindahanbarang_list->renderOtherOptions();
?>
<?php $detailperpindahanbarang_list->showPageHeader(); ?>
<?php
$detailperpindahanbarang_list->showMessage();
?>
<?php if ($detailperpindahanbarang_list->TotalRecords > 0 || $detailperpindahanbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailperpindahanbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailperpindahanbarang">
<?php if (!$detailperpindahanbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailperpindahanbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailperpindahanbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailperpindahanbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailperpindahanbaranglist" id="fdetailperpindahanbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailperpindahanbarang">
<?php if ($detailperpindahanbarang->getCurrentMasterTable() == "perpindahanbarang" && $detailperpindahanbarang->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="perpindahanbarang">
<input type="hidden" name="fk_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_list->id_perpindahanbarang->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailperpindahanbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailperpindahanbarang_list->TotalRecords > 0 || $detailperpindahanbarang_list->isGridEdit()) { ?>
<table id="tbl_detailperpindahanbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailperpindahanbarang->RowType = ROWTYPE_HEADER;

// Render list options
$detailperpindahanbarang_list->renderListOptions();

// Render list options (header, left)
$detailperpindahanbarang_list->ListOptions->render("header", "left");
?>
<?php if ($detailperpindahanbarang_list->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
	<?php if ($detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_detailperpindahanbarang) == "") { ?>
		<th data-name="id_detailperpindahanbarang" class="<?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_detailperpindahanbarang" class="detailperpindahanbarang_id_detailperpindahanbarang"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailperpindahanbarang" class="<?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_detailperpindahanbarang) ?>', 1);"><div id="elh_detailperpindahanbarang_id_detailperpindahanbarang" class="detailperpindahanbarang_id_detailperpindahanbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_list->id_detailperpindahanbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_list->id_detailperpindahanbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<?php if ($detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_perpindahanbarang) == "") { ?>
		<th data-name="id_perpindahanbarang" class="<?php echo $detailperpindahanbarang_list->id_perpindahanbarang->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_perpindahanbarang" class="detailperpindahanbarang_id_perpindahanbarang"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_perpindahanbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_perpindahanbarang" class="<?php echo $detailperpindahanbarang_list->id_perpindahanbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_perpindahanbarang) ?>', 1);"><div id="elh_detailperpindahanbarang_id_perpindahanbarang" class="detailperpindahanbarang_id_perpindahanbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_perpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_list->id_perpindahanbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_list->id_perpindahanbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailperpindahanbarang_list->id_barang->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_barang" class="detailperpindahanbarang_id_barang"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailperpindahanbarang_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_barang) ?>', 1);"><div id="elh_detailperpindahanbarang_id_barang" class="detailperpindahanbarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailperpindahanbarang_list->jumlah->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_jumlah" class="detailperpindahanbarang_jumlah"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailperpindahanbarang_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->jumlah) ?>', 1);"><div id="elh_detailperpindahanbarang_jumlah" class="detailperpindahanbarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailperpindahanbarang_list->id_satuan->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_satuan" class="detailperpindahanbarang_id_satuan"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailperpindahanbarang_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailperpindahanbarang_list->SortUrl($detailperpindahanbarang_list->id_satuan) ?>', 1);"><div id="elh_detailperpindahanbarang_id_satuan" class="detailperpindahanbarang_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailperpindahanbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailperpindahanbarang_list->ExportAll && $detailperpindahanbarang_list->isExport()) {
	$detailperpindahanbarang_list->StopRecord = $detailperpindahanbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailperpindahanbarang_list->TotalRecords > $detailperpindahanbarang_list->StartRecord + $detailperpindahanbarang_list->DisplayRecords - 1)
		$detailperpindahanbarang_list->StopRecord = $detailperpindahanbarang_list->StartRecord + $detailperpindahanbarang_list->DisplayRecords - 1;
	else
		$detailperpindahanbarang_list->StopRecord = $detailperpindahanbarang_list->TotalRecords;
}
$detailperpindahanbarang_list->RecordCount = $detailperpindahanbarang_list->StartRecord - 1;
if ($detailperpindahanbarang_list->Recordset && !$detailperpindahanbarang_list->Recordset->EOF) {
	$detailperpindahanbarang_list->Recordset->moveFirst();
	$selectLimit = $detailperpindahanbarang_list->UseSelectLimit;
	if (!$selectLimit && $detailperpindahanbarang_list->StartRecord > 1)
		$detailperpindahanbarang_list->Recordset->move($detailperpindahanbarang_list->StartRecord - 1);
} elseif (!$detailperpindahanbarang->AllowAddDeleteRow && $detailperpindahanbarang_list->StopRecord == 0) {
	$detailperpindahanbarang_list->StopRecord = $detailperpindahanbarang->GridAddRowCount;
}

// Initialize aggregate
$detailperpindahanbarang->RowType = ROWTYPE_AGGREGATEINIT;
$detailperpindahanbarang->resetAttributes();
$detailperpindahanbarang_list->renderRow();
while ($detailperpindahanbarang_list->RecordCount < $detailperpindahanbarang_list->StopRecord) {
	$detailperpindahanbarang_list->RecordCount++;
	if ($detailperpindahanbarang_list->RecordCount >= $detailperpindahanbarang_list->StartRecord) {
		$detailperpindahanbarang_list->RowCount++;

		// Set up key count
		$detailperpindahanbarang_list->KeyCount = $detailperpindahanbarang_list->RowIndex;

		// Init row class and style
		$detailperpindahanbarang->resetAttributes();
		$detailperpindahanbarang->CssClass = "";
		if ($detailperpindahanbarang_list->isGridAdd()) {
		} else {
			$detailperpindahanbarang_list->loadRowValues($detailperpindahanbarang_list->Recordset); // Load row values
		}
		$detailperpindahanbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailperpindahanbarang->RowAttrs->merge(["data-rowindex" => $detailperpindahanbarang_list->RowCount, "id" => "r" . $detailperpindahanbarang_list->RowCount . "_detailperpindahanbarang", "data-rowtype" => $detailperpindahanbarang->RowType]);

		// Render row
		$detailperpindahanbarang_list->renderRow();

		// Render list options
		$detailperpindahanbarang_list->renderListOptions();
?>
	<tr <?php echo $detailperpindahanbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailperpindahanbarang_list->ListOptions->render("body", "left", $detailperpindahanbarang_list->RowCount);
?>
	<?php if ($detailperpindahanbarang_list->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
		<td data-name="id_detailperpindahanbarang" <?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_list->RowCount ?>_detailperpindahanbarang_id_detailperpindahanbarang">
<span<?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_list->id_detailperpindahanbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_list->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<td data-name="id_perpindahanbarang" <?php echo $detailperpindahanbarang_list->id_perpindahanbarang->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_list->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_list->id_perpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_list->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailperpindahanbarang_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_list->RowCount ?>_detailperpindahanbarang_id_barang">
<span<?php echo $detailperpindahanbarang_list->id_barang->viewAttributes() ?>><?php echo $detailperpindahanbarang_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailperpindahanbarang_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_list->RowCount ?>_detailperpindahanbarang_jumlah">
<span<?php echo $detailperpindahanbarang_list->jumlah->viewAttributes() ?>><?php echo $detailperpindahanbarang_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailperpindahanbarang_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailperpindahanbarang_list->RowCount ?>_detailperpindahanbarang_id_satuan">
<span<?php echo $detailperpindahanbarang_list->id_satuan->viewAttributes() ?>><?php echo $detailperpindahanbarang_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailperpindahanbarang_list->ListOptions->render("body", "right", $detailperpindahanbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailperpindahanbarang_list->isGridAdd())
		$detailperpindahanbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailperpindahanbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailperpindahanbarang_list->Recordset)
	$detailperpindahanbarang_list->Recordset->Close();
?>
<?php if (!$detailperpindahanbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailperpindahanbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailperpindahanbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailperpindahanbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailperpindahanbarang_list->TotalRecords == 0 && !$detailperpindahanbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailperpindahanbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailperpindahanbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailperpindahanbarang_list->isExport()) { ?>
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
$detailperpindahanbarang_list->terminate();
?>