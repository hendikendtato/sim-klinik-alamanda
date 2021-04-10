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
$detail_nonjual_list = new detail_nonjual_list();

// Run the page
$detail_nonjual_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detail_nonjual_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detail_nonjual_list->isExport()) { ?>
<script>
var fdetail_nonjuallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetail_nonjuallist = currentForm = new ew.Form("fdetail_nonjuallist", "list");
	fdetail_nonjuallist.formKeyCountName = '<?php echo $detail_nonjual_list->FormKeyCountName ?>';
	loadjs.done("fdetail_nonjuallist");
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
<?php if (!$detail_nonjual_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detail_nonjual_list->TotalRecords > 0 && $detail_nonjual_list->ExportOptions->visible()) { ?>
<?php $detail_nonjual_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detail_nonjual_list->ImportOptions->visible()) { ?>
<?php $detail_nonjual_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detail_nonjual_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detail_nonjual_list->isExport("print")) { ?>
<?php
if ($detail_nonjual_list->DbMasterFilter != "" && $detail_nonjual->getCurrentMasterTable() == "nonjual") {
	if ($detail_nonjual_list->MasterRecordExists) {
		include_once "nonjualmaster.php";
	}
}
?>
<?php } ?>
<?php
$detail_nonjual_list->renderOtherOptions();
?>
<?php $detail_nonjual_list->showPageHeader(); ?>
<?php
$detail_nonjual_list->showMessage();
?>
<?php if ($detail_nonjual_list->TotalRecords > 0 || $detail_nonjual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detail_nonjual_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detail_nonjual">
<?php if (!$detail_nonjual_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detail_nonjual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detail_nonjual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detail_nonjual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetail_nonjuallist" id="fdetail_nonjuallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detail_nonjual">
<?php if ($detail_nonjual->getCurrentMasterTable() == "nonjual" && $detail_nonjual->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="nonjual">
<input type="hidden" name="fk_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_list->id_nonjual->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detail_nonjual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detail_nonjual_list->TotalRecords > 0 || $detail_nonjual_list->isGridEdit()) { ?>
<table id="tbl_detail_nonjuallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detail_nonjual->RowType = ROWTYPE_HEADER;

// Render list options
$detail_nonjual_list->renderListOptions();

// Render list options (header, left)
$detail_nonjual_list->ListOptions->render("header", "left");
?>
<?php if ($detail_nonjual_list->id_nonjual->Visible) { // id_nonjual ?>
	<?php if ($detail_nonjual_list->SortUrl($detail_nonjual_list->id_nonjual) == "") { ?>
		<th data-name="id_nonjual" class="<?php echo $detail_nonjual_list->id_nonjual->headerCellClass() ?>"><div id="elh_detail_nonjual_id_nonjual" class="detail_nonjual_id_nonjual"><div class="ew-table-header-caption"><?php echo $detail_nonjual_list->id_nonjual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_nonjual" class="<?php echo $detail_nonjual_list->id_nonjual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detail_nonjual_list->SortUrl($detail_nonjual_list->id_nonjual) ?>', 1);"><div id="elh_detail_nonjual_id_nonjual" class="detail_nonjual_id_nonjual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_list->id_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_list->id_nonjual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_list->id_nonjual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detail_nonjual_list->SortUrl($detail_nonjual_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detail_nonjual_list->id_barang->headerCellClass() ?>"><div id="elh_detail_nonjual_id_barang" class="detail_nonjual_id_barang"><div class="ew-table-header-caption"><?php echo $detail_nonjual_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detail_nonjual_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detail_nonjual_list->SortUrl($detail_nonjual_list->id_barang) ?>', 1);"><div id="elh_detail_nonjual_id_barang" class="detail_nonjual_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_list->stok->Visible) { // stok ?>
	<?php if ($detail_nonjual_list->SortUrl($detail_nonjual_list->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $detail_nonjual_list->stok->headerCellClass() ?>"><div id="elh_detail_nonjual_stok" class="detail_nonjual_stok"><div class="ew-table-header-caption"><?php echo $detail_nonjual_list->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $detail_nonjual_list->stok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detail_nonjual_list->SortUrl($detail_nonjual_list->stok) ?>', 1);"><div id="elh_detail_nonjual_stok" class="detail_nonjual_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_list->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_list->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_list->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_list->qty->Visible) { // qty ?>
	<?php if ($detail_nonjual_list->SortUrl($detail_nonjual_list->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detail_nonjual_list->qty->headerCellClass() ?>"><div id="elh_detail_nonjual_qty" class="detail_nonjual_qty"><div class="ew-table-header-caption"><?php echo $detail_nonjual_list->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detail_nonjual_list->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detail_nonjual_list->SortUrl($detail_nonjual_list->qty) ?>', 1);"><div id="elh_detail_nonjual_qty" class="detail_nonjual_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_list->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_list->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_list->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detail_nonjual_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detail_nonjual_list->ExportAll && $detail_nonjual_list->isExport()) {
	$detail_nonjual_list->StopRecord = $detail_nonjual_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detail_nonjual_list->TotalRecords > $detail_nonjual_list->StartRecord + $detail_nonjual_list->DisplayRecords - 1)
		$detail_nonjual_list->StopRecord = $detail_nonjual_list->StartRecord + $detail_nonjual_list->DisplayRecords - 1;
	else
		$detail_nonjual_list->StopRecord = $detail_nonjual_list->TotalRecords;
}
$detail_nonjual_list->RecordCount = $detail_nonjual_list->StartRecord - 1;
if ($detail_nonjual_list->Recordset && !$detail_nonjual_list->Recordset->EOF) {
	$detail_nonjual_list->Recordset->moveFirst();
	$selectLimit = $detail_nonjual_list->UseSelectLimit;
	if (!$selectLimit && $detail_nonjual_list->StartRecord > 1)
		$detail_nonjual_list->Recordset->move($detail_nonjual_list->StartRecord - 1);
} elseif (!$detail_nonjual->AllowAddDeleteRow && $detail_nonjual_list->StopRecord == 0) {
	$detail_nonjual_list->StopRecord = $detail_nonjual->GridAddRowCount;
}

// Initialize aggregate
$detail_nonjual->RowType = ROWTYPE_AGGREGATEINIT;
$detail_nonjual->resetAttributes();
$detail_nonjual_list->renderRow();
while ($detail_nonjual_list->RecordCount < $detail_nonjual_list->StopRecord) {
	$detail_nonjual_list->RecordCount++;
	if ($detail_nonjual_list->RecordCount >= $detail_nonjual_list->StartRecord) {
		$detail_nonjual_list->RowCount++;

		// Set up key count
		$detail_nonjual_list->KeyCount = $detail_nonjual_list->RowIndex;

		// Init row class and style
		$detail_nonjual->resetAttributes();
		$detail_nonjual->CssClass = "";
		if ($detail_nonjual_list->isGridAdd()) {
		} else {
			$detail_nonjual_list->loadRowValues($detail_nonjual_list->Recordset); // Load row values
		}
		$detail_nonjual->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detail_nonjual->RowAttrs->merge(["data-rowindex" => $detail_nonjual_list->RowCount, "id" => "r" . $detail_nonjual_list->RowCount . "_detail_nonjual", "data-rowtype" => $detail_nonjual->RowType]);

		// Render row
		$detail_nonjual_list->renderRow();

		// Render list options
		$detail_nonjual_list->renderListOptions();
?>
	<tr <?php echo $detail_nonjual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detail_nonjual_list->ListOptions->render("body", "left", $detail_nonjual_list->RowCount);
?>
	<?php if ($detail_nonjual_list->id_nonjual->Visible) { // id_nonjual ?>
		<td data-name="id_nonjual" <?php echo $detail_nonjual_list->id_nonjual->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_list->RowCount ?>_detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_list->id_nonjual->viewAttributes() ?>><?php echo $detail_nonjual_list->id_nonjual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detail_nonjual_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detail_nonjual_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_list->RowCount ?>_detail_nonjual_id_barang">
<span<?php echo $detail_nonjual_list->id_barang->viewAttributes() ?>><?php echo $detail_nonjual_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detail_nonjual_list->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $detail_nonjual_list->stok->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_list->RowCount ?>_detail_nonjual_stok">
<span<?php echo $detail_nonjual_list->stok->viewAttributes() ?>><?php echo $detail_nonjual_list->stok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detail_nonjual_list->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detail_nonjual_list->qty->cellAttributes() ?>>
<span id="el<?php echo $detail_nonjual_list->RowCount ?>_detail_nonjual_qty">
<span<?php echo $detail_nonjual_list->qty->viewAttributes() ?>><?php echo $detail_nonjual_list->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detail_nonjual_list->ListOptions->render("body", "right", $detail_nonjual_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detail_nonjual_list->isGridAdd())
		$detail_nonjual_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detail_nonjual->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detail_nonjual_list->Recordset)
	$detail_nonjual_list->Recordset->Close();
?>
<?php if (!$detail_nonjual_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detail_nonjual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detail_nonjual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detail_nonjual_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detail_nonjual_list->TotalRecords == 0 && !$detail_nonjual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detail_nonjual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detail_nonjual_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detail_nonjual_list->isExport()) { ?>
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
$detail_nonjual_list->terminate();
?>