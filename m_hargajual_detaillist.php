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
$m_hargajual_detail_list = new m_hargajual_detail_list();

// Run the page
$m_hargajual_detail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_detail_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_hargajual_detail_list->isExport()) { ?>
<script>
var fm_hargajual_detaillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_hargajual_detaillist = currentForm = new ew.Form("fm_hargajual_detaillist", "list");
	fm_hargajual_detaillist.formKeyCountName = '<?php echo $m_hargajual_detail_list->FormKeyCountName ?>';
	loadjs.done("fm_hargajual_detaillist");
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
<?php if (!$m_hargajual_detail_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_hargajual_detail_list->TotalRecords > 0 && $m_hargajual_detail_list->ExportOptions->visible()) { ?>
<?php $m_hargajual_detail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_hargajual_detail_list->ImportOptions->visible()) { ?>
<?php $m_hargajual_detail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_hargajual_detail_list->renderOtherOptions();
?>
<?php $m_hargajual_detail_list->showPageHeader(); ?>
<?php
$m_hargajual_detail_list->showMessage();
?>
<?php if ($m_hargajual_detail_list->TotalRecords > 0 || $m_hargajual_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_hargajual_detail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_hargajual_detail">
<?php if (!$m_hargajual_detail_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_hargajual_detail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_hargajual_detail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_hargajual_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_hargajual_detaillist" id="fm_hargajual_detaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual_detail">
<div id="gmp_m_hargajual_detail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_hargajual_detail_list->TotalRecords > 0 || $m_hargajual_detail_list->isGridEdit()) { ?>
<table id="tbl_m_hargajual_detaillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_hargajual_detail->RowType = ROWTYPE_HEADER;

// Render list options
$m_hargajual_detail_list->renderListOptions();

// Render list options (header, left)
$m_hargajual_detail_list->ListOptions->render("header", "left");
?>
<?php if ($m_hargajual_detail_list->id_hargajualdetail->Visible) { // id_hargajualdetail ?>
	<?php if ($m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->id_hargajualdetail) == "") { ?>
		<th data-name="id_hargajualdetail" class="<?php echo $m_hargajual_detail_list->id_hargajualdetail->headerCellClass() ?>"><div id="elh_m_hargajual_detail_id_hargajualdetail" class="m_hargajual_detail_id_hargajualdetail"><div class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->id_hargajualdetail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_hargajualdetail" class="<?php echo $m_hargajual_detail_list->id_hargajualdetail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->id_hargajualdetail) ?>', 1);"><div id="elh_m_hargajual_detail_id_hargajualdetail" class="m_hargajual_detail_id_hargajualdetail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->id_hargajualdetail->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_detail_list->id_hargajualdetail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_detail_list->id_hargajualdetail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_detail_list->id_hargajual->Visible) { // id_hargajual ?>
	<?php if ($m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->id_hargajual) == "") { ?>
		<th data-name="id_hargajual" class="<?php echo $m_hargajual_detail_list->id_hargajual->headerCellClass() ?>"><div id="elh_m_hargajual_detail_id_hargajual" class="m_hargajual_detail_id_hargajual"><div class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->id_hargajual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_hargajual" class="<?php echo $m_hargajual_detail_list->id_hargajual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->id_hargajual) ?>', 1);"><div id="elh_m_hargajual_detail_id_hargajual" class="m_hargajual_detail_id_hargajual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->id_hargajual->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_detail_list->id_hargajual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_detail_list->id_hargajual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_detail_list->id_barang->Visible) { // id_barang ?>
	<?php if ($m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $m_hargajual_detail_list->id_barang->headerCellClass() ?>"><div id="elh_m_hargajual_detail_id_barang" class="m_hargajual_detail_id_barang"><div class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $m_hargajual_detail_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->id_barang) ?>', 1);"><div id="elh_m_hargajual_detail_id_barang" class="m_hargajual_detail_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_detail_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_detail_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_detail_list->hargajual->Visible) { // hargajual ?>
	<?php if ($m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->hargajual) == "") { ?>
		<th data-name="hargajual" class="<?php echo $m_hargajual_detail_list->hargajual->headerCellClass() ?>"><div id="elh_m_hargajual_detail_hargajual" class="m_hargajual_detail_hargajual"><div class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->hargajual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hargajual" class="<?php echo $m_hargajual_detail_list->hargajual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_detail_list->SortUrl($m_hargajual_detail_list->hargajual) ?>', 1);"><div id="elh_m_hargajual_detail_hargajual" class="m_hargajual_detail_hargajual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_detail_list->hargajual->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_detail_list->hargajual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_detail_list->hargajual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_hargajual_detail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_hargajual_detail_list->ExportAll && $m_hargajual_detail_list->isExport()) {
	$m_hargajual_detail_list->StopRecord = $m_hargajual_detail_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_hargajual_detail_list->TotalRecords > $m_hargajual_detail_list->StartRecord + $m_hargajual_detail_list->DisplayRecords - 1)
		$m_hargajual_detail_list->StopRecord = $m_hargajual_detail_list->StartRecord + $m_hargajual_detail_list->DisplayRecords - 1;
	else
		$m_hargajual_detail_list->StopRecord = $m_hargajual_detail_list->TotalRecords;
}
$m_hargajual_detail_list->RecordCount = $m_hargajual_detail_list->StartRecord - 1;
if ($m_hargajual_detail_list->Recordset && !$m_hargajual_detail_list->Recordset->EOF) {
	$m_hargajual_detail_list->Recordset->moveFirst();
	$selectLimit = $m_hargajual_detail_list->UseSelectLimit;
	if (!$selectLimit && $m_hargajual_detail_list->StartRecord > 1)
		$m_hargajual_detail_list->Recordset->move($m_hargajual_detail_list->StartRecord - 1);
} elseif (!$m_hargajual_detail->AllowAddDeleteRow && $m_hargajual_detail_list->StopRecord == 0) {
	$m_hargajual_detail_list->StopRecord = $m_hargajual_detail->GridAddRowCount;
}

// Initialize aggregate
$m_hargajual_detail->RowType = ROWTYPE_AGGREGATEINIT;
$m_hargajual_detail->resetAttributes();
$m_hargajual_detail_list->renderRow();
while ($m_hargajual_detail_list->RecordCount < $m_hargajual_detail_list->StopRecord) {
	$m_hargajual_detail_list->RecordCount++;
	if ($m_hargajual_detail_list->RecordCount >= $m_hargajual_detail_list->StartRecord) {
		$m_hargajual_detail_list->RowCount++;

		// Set up key count
		$m_hargajual_detail_list->KeyCount = $m_hargajual_detail_list->RowIndex;

		// Init row class and style
		$m_hargajual_detail->resetAttributes();
		$m_hargajual_detail->CssClass = "";
		if ($m_hargajual_detail_list->isGridAdd()) {
		} else {
			$m_hargajual_detail_list->loadRowValues($m_hargajual_detail_list->Recordset); // Load row values
		}
		$m_hargajual_detail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_hargajual_detail->RowAttrs->merge(["data-rowindex" => $m_hargajual_detail_list->RowCount, "id" => "r" . $m_hargajual_detail_list->RowCount . "_m_hargajual_detail", "data-rowtype" => $m_hargajual_detail->RowType]);

		// Render row
		$m_hargajual_detail_list->renderRow();

		// Render list options
		$m_hargajual_detail_list->renderListOptions();
?>
	<tr <?php echo $m_hargajual_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_hargajual_detail_list->ListOptions->render("body", "left", $m_hargajual_detail_list->RowCount);
?>
	<?php if ($m_hargajual_detail_list->id_hargajualdetail->Visible) { // id_hargajualdetail ?>
		<td data-name="id_hargajualdetail" <?php echo $m_hargajual_detail_list->id_hargajualdetail->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_list->RowCount ?>_m_hargajual_detail_id_hargajualdetail">
<span<?php echo $m_hargajual_detail_list->id_hargajualdetail->viewAttributes() ?>><?php echo $m_hargajual_detail_list->id_hargajualdetail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_detail_list->id_hargajual->Visible) { // id_hargajual ?>
		<td data-name="id_hargajual" <?php echo $m_hargajual_detail_list->id_hargajual->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_list->RowCount ?>_m_hargajual_detail_id_hargajual">
<span<?php echo $m_hargajual_detail_list->id_hargajual->viewAttributes() ?>><?php echo $m_hargajual_detail_list->id_hargajual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_detail_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $m_hargajual_detail_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_list->RowCount ?>_m_hargajual_detail_id_barang">
<span<?php echo $m_hargajual_detail_list->id_barang->viewAttributes() ?>><?php echo $m_hargajual_detail_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_detail_list->hargajual->Visible) { // hargajual ?>
		<td data-name="hargajual" <?php echo $m_hargajual_detail_list->hargajual->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_detail_list->RowCount ?>_m_hargajual_detail_hargajual">
<span<?php echo $m_hargajual_detail_list->hargajual->viewAttributes() ?>><?php echo $m_hargajual_detail_list->hargajual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_hargajual_detail_list->ListOptions->render("body", "right", $m_hargajual_detail_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_hargajual_detail_list->isGridAdd())
		$m_hargajual_detail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_hargajual_detail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_hargajual_detail_list->Recordset)
	$m_hargajual_detail_list->Recordset->Close();
?>
<?php if (!$m_hargajual_detail_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_hargajual_detail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_hargajual_detail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_hargajual_detail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_hargajual_detail_list->TotalRecords == 0 && !$m_hargajual_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_hargajual_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_hargajual_detail_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_hargajual_detail_list->isExport()) { ?>
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
$m_hargajual_detail_list->terminate();
?>