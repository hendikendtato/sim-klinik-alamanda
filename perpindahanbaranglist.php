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
$perpindahanbarang_list = new perpindahanbarang_list();

// Run the page
$perpindahanbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perpindahanbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$perpindahanbarang_list->isExport()) { ?>
<script>
var fperpindahanbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fperpindahanbaranglist = currentForm = new ew.Form("fperpindahanbaranglist", "list");
	fperpindahanbaranglist.formKeyCountName = '<?php echo $perpindahanbarang_list->FormKeyCountName ?>';
	loadjs.done("fperpindahanbaranglist");
});
var fperpindahanbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fperpindahanbaranglistsrch = currentSearchForm = new ew.Form("fperpindahanbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fperpindahanbaranglistsrch.filterList = <?php echo $perpindahanbarang_list->getFilterList() ?>;
	loadjs.done("fperpindahanbaranglistsrch");
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
<?php if (!$perpindahanbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($perpindahanbarang_list->TotalRecords > 0 && $perpindahanbarang_list->ExportOptions->visible()) { ?>
<?php $perpindahanbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($perpindahanbarang_list->ImportOptions->visible()) { ?>
<?php $perpindahanbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($perpindahanbarang_list->SearchOptions->visible()) { ?>
<?php $perpindahanbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($perpindahanbarang_list->FilterOptions->visible()) { ?>
<?php $perpindahanbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$perpindahanbarang_list->renderOtherOptions();
?>
<?php $perpindahanbarang_list->showPageHeader(); ?>
<?php
$perpindahanbarang_list->showMessage();
?>
<?php if ($perpindahanbarang_list->TotalRecords > 0 || $perpindahanbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($perpindahanbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> perpindahanbarang">
<?php if (!$perpindahanbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$perpindahanbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $perpindahanbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $perpindahanbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fperpindahanbaranglist" id="fperpindahanbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perpindahanbarang">
<div id="gmp_perpindahanbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($perpindahanbarang_list->TotalRecords > 0 || $perpindahanbarang_list->isGridEdit()) { ?>
<table id="tbl_perpindahanbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$perpindahanbarang->RowType = ROWTYPE_HEADER;

// Render list options
$perpindahanbarang_list->renderListOptions();

// Render list options (header, left)
$perpindahanbarang_list->ListOptions->render("header", "left");
?>
<?php if ($perpindahanbarang_list->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<?php if ($perpindahanbarang_list->SortUrl($perpindahanbarang_list->id_perpindahanbarang) == "") { ?>
		<th data-name="id_perpindahanbarang" class="<?php echo $perpindahanbarang_list->id_perpindahanbarang->headerCellClass() ?>"><div id="elh_perpindahanbarang_id_perpindahanbarang" class="perpindahanbarang_id_perpindahanbarang"><div class="ew-table-header-caption"><?php echo $perpindahanbarang_list->id_perpindahanbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_perpindahanbarang" class="<?php echo $perpindahanbarang_list->id_perpindahanbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perpindahanbarang_list->SortUrl($perpindahanbarang_list->id_perpindahanbarang) ?>', 1);"><div id="elh_perpindahanbarang_id_perpindahanbarang" class="perpindahanbarang_id_perpindahanbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perpindahanbarang_list->id_perpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($perpindahanbarang_list->id_perpindahanbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perpindahanbarang_list->id_perpindahanbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($perpindahanbarang_list->tanggal->Visible) { // tanggal ?>
	<?php if ($perpindahanbarang_list->SortUrl($perpindahanbarang_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $perpindahanbarang_list->tanggal->headerCellClass() ?>"><div id="elh_perpindahanbarang_tanggal" class="perpindahanbarang_tanggal"><div class="ew-table-header-caption"><?php echo $perpindahanbarang_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $perpindahanbarang_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perpindahanbarang_list->SortUrl($perpindahanbarang_list->tanggal) ?>', 1);"><div id="elh_perpindahanbarang_tanggal" class="perpindahanbarang_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perpindahanbarang_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($perpindahanbarang_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perpindahanbarang_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($perpindahanbarang_list->asal->Visible) { // asal ?>
	<?php if ($perpindahanbarang_list->SortUrl($perpindahanbarang_list->asal) == "") { ?>
		<th data-name="asal" class="<?php echo $perpindahanbarang_list->asal->headerCellClass() ?>"><div id="elh_perpindahanbarang_asal" class="perpindahanbarang_asal"><div class="ew-table-header-caption"><?php echo $perpindahanbarang_list->asal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="asal" class="<?php echo $perpindahanbarang_list->asal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perpindahanbarang_list->SortUrl($perpindahanbarang_list->asal) ?>', 1);"><div id="elh_perpindahanbarang_asal" class="perpindahanbarang_asal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perpindahanbarang_list->asal->caption() ?></span><span class="ew-table-header-sort"><?php if ($perpindahanbarang_list->asal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perpindahanbarang_list->asal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($perpindahanbarang_list->tujuan->Visible) { // tujuan ?>
	<?php if ($perpindahanbarang_list->SortUrl($perpindahanbarang_list->tujuan) == "") { ?>
		<th data-name="tujuan" class="<?php echo $perpindahanbarang_list->tujuan->headerCellClass() ?>"><div id="elh_perpindahanbarang_tujuan" class="perpindahanbarang_tujuan"><div class="ew-table-header-caption"><?php echo $perpindahanbarang_list->tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tujuan" class="<?php echo $perpindahanbarang_list->tujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $perpindahanbarang_list->SortUrl($perpindahanbarang_list->tujuan) ?>', 1);"><div id="elh_perpindahanbarang_tujuan" class="perpindahanbarang_tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $perpindahanbarang_list->tujuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($perpindahanbarang_list->tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($perpindahanbarang_list->tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$perpindahanbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($perpindahanbarang_list->ExportAll && $perpindahanbarang_list->isExport()) {
	$perpindahanbarang_list->StopRecord = $perpindahanbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($perpindahanbarang_list->TotalRecords > $perpindahanbarang_list->StartRecord + $perpindahanbarang_list->DisplayRecords - 1)
		$perpindahanbarang_list->StopRecord = $perpindahanbarang_list->StartRecord + $perpindahanbarang_list->DisplayRecords - 1;
	else
		$perpindahanbarang_list->StopRecord = $perpindahanbarang_list->TotalRecords;
}
$perpindahanbarang_list->RecordCount = $perpindahanbarang_list->StartRecord - 1;
if ($perpindahanbarang_list->Recordset && !$perpindahanbarang_list->Recordset->EOF) {
	$perpindahanbarang_list->Recordset->moveFirst();
	$selectLimit = $perpindahanbarang_list->UseSelectLimit;
	if (!$selectLimit && $perpindahanbarang_list->StartRecord > 1)
		$perpindahanbarang_list->Recordset->move($perpindahanbarang_list->StartRecord - 1);
} elseif (!$perpindahanbarang->AllowAddDeleteRow && $perpindahanbarang_list->StopRecord == 0) {
	$perpindahanbarang_list->StopRecord = $perpindahanbarang->GridAddRowCount;
}

// Initialize aggregate
$perpindahanbarang->RowType = ROWTYPE_AGGREGATEINIT;
$perpindahanbarang->resetAttributes();
$perpindahanbarang_list->renderRow();
while ($perpindahanbarang_list->RecordCount < $perpindahanbarang_list->StopRecord) {
	$perpindahanbarang_list->RecordCount++;
	if ($perpindahanbarang_list->RecordCount >= $perpindahanbarang_list->StartRecord) {
		$perpindahanbarang_list->RowCount++;

		// Set up key count
		$perpindahanbarang_list->KeyCount = $perpindahanbarang_list->RowIndex;

		// Init row class and style
		$perpindahanbarang->resetAttributes();
		$perpindahanbarang->CssClass = "";
		if ($perpindahanbarang_list->isGridAdd()) {
		} else {
			$perpindahanbarang_list->loadRowValues($perpindahanbarang_list->Recordset); // Load row values
		}
		$perpindahanbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$perpindahanbarang->RowAttrs->merge(["data-rowindex" => $perpindahanbarang_list->RowCount, "id" => "r" . $perpindahanbarang_list->RowCount . "_perpindahanbarang", "data-rowtype" => $perpindahanbarang->RowType]);

		// Render row
		$perpindahanbarang_list->renderRow();

		// Render list options
		$perpindahanbarang_list->renderListOptions();
?>
	<tr <?php echo $perpindahanbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$perpindahanbarang_list->ListOptions->render("body", "left", $perpindahanbarang_list->RowCount);
?>
	<?php if ($perpindahanbarang_list->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<td data-name="id_perpindahanbarang" <?php echo $perpindahanbarang_list->id_perpindahanbarang->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_list->RowCount ?>_perpindahanbarang_id_perpindahanbarang">
<span<?php echo $perpindahanbarang_list->id_perpindahanbarang->viewAttributes() ?>><?php echo $perpindahanbarang_list->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($perpindahanbarang_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $perpindahanbarang_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_list->RowCount ?>_perpindahanbarang_tanggal">
<span<?php echo $perpindahanbarang_list->tanggal->viewAttributes() ?>><?php echo $perpindahanbarang_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($perpindahanbarang_list->asal->Visible) { // asal ?>
		<td data-name="asal" <?php echo $perpindahanbarang_list->asal->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_list->RowCount ?>_perpindahanbarang_asal">
<span<?php echo $perpindahanbarang_list->asal->viewAttributes() ?>><?php echo $perpindahanbarang_list->asal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($perpindahanbarang_list->tujuan->Visible) { // tujuan ?>
		<td data-name="tujuan" <?php echo $perpindahanbarang_list->tujuan->cellAttributes() ?>>
<span id="el<?php echo $perpindahanbarang_list->RowCount ?>_perpindahanbarang_tujuan">
<span<?php echo $perpindahanbarang_list->tujuan->viewAttributes() ?>><?php echo $perpindahanbarang_list->tujuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$perpindahanbarang_list->ListOptions->render("body", "right", $perpindahanbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$perpindahanbarang_list->isGridAdd())
		$perpindahanbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$perpindahanbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($perpindahanbarang_list->Recordset)
	$perpindahanbarang_list->Recordset->Close();
?>
<?php if (!$perpindahanbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$perpindahanbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $perpindahanbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $perpindahanbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($perpindahanbarang_list->TotalRecords == 0 && !$perpindahanbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $perpindahanbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$perpindahanbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$perpindahanbarang_list->isExport()) { ?>
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
$perpindahanbarang_list->terminate();
?>