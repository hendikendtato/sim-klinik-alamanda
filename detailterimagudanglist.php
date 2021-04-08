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
$detailterimagudang_list = new detailterimagudang_list();

// Run the page
$detailterimagudang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimagudang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailterimagudang_list->isExport()) { ?>
<script>
var fdetailterimagudanglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailterimagudanglist = currentForm = new ew.Form("fdetailterimagudanglist", "list");
	fdetailterimagudanglist.formKeyCountName = '<?php echo $detailterimagudang_list->FormKeyCountName ?>';
	loadjs.done("fdetailterimagudanglist");
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
<?php if (!$detailterimagudang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailterimagudang_list->TotalRecords > 0 && $detailterimagudang_list->ExportOptions->visible()) { ?>
<?php $detailterimagudang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailterimagudang_list->ImportOptions->visible()) { ?>
<?php $detailterimagudang_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailterimagudang_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailterimagudang_list->isExport("print")) { ?>
<?php
if ($detailterimagudang_list->DbMasterFilter != "" && $detailterimagudang->getCurrentMasterTable() == "terimagudang") {
	if ($detailterimagudang_list->MasterRecordExists) {
		include_once "terimagudangmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailterimagudang_list->renderOtherOptions();
?>
<?php $detailterimagudang_list->showPageHeader(); ?>
<?php
$detailterimagudang_list->showMessage();
?>
<?php if ($detailterimagudang_list->TotalRecords > 0 || $detailterimagudang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailterimagudang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailterimagudang">
<?php if (!$detailterimagudang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailterimagudang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailterimagudang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailterimagudang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailterimagudanglist" id="fdetailterimagudanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimagudang">
<?php if ($detailterimagudang->getCurrentMasterTable() == "terimagudang" && $detailterimagudang->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="terimagudang">
<input type="hidden" name="fk_id_terimagudang" value="<?php echo HtmlEncode($detailterimagudang_list->pid_terimagudang->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailterimagudang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailterimagudang_list->TotalRecords > 0 || $detailterimagudang_list->isGridEdit()) { ?>
<table id="tbl_detailterimagudanglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailterimagudang->RowType = ROWTYPE_HEADER;

// Render list options
$detailterimagudang_list->renderListOptions();

// Render list options (header, left)
$detailterimagudang_list->ListOptions->render("header", "left");
?>
<?php if ($detailterimagudang_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailterimagudang_list->SortUrl($detailterimagudang_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailterimagudang_list->id_barang->headerCellClass() ?>"><div id="elh_detailterimagudang_id_barang" class="detailterimagudang_id_barang"><div class="ew-table-header-caption"><?php echo $detailterimagudang_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailterimagudang_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailterimagudang_list->SortUrl($detailterimagudang_list->id_barang) ?>', 1);"><div id="elh_detailterimagudang_id_barang" class="detailterimagudang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimagudang_list->qty->Visible) { // qty ?>
	<?php if ($detailterimagudang_list->SortUrl($detailterimagudang_list->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detailterimagudang_list->qty->headerCellClass() ?>"><div id="elh_detailterimagudang_qty" class="detailterimagudang_qty"><div class="ew-table-header-caption"><?php echo $detailterimagudang_list->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detailterimagudang_list->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailterimagudang_list->SortUrl($detailterimagudang_list->qty) ?>', 1);"><div id="elh_detailterimagudang_qty" class="detailterimagudang_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_list->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_list->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_list->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimagudang_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailterimagudang_list->SortUrl($detailterimagudang_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailterimagudang_list->id_satuan->headerCellClass() ?>"><div id="elh_detailterimagudang_id_satuan" class="detailterimagudang_id_satuan"><div class="ew-table-header-caption"><?php echo $detailterimagudang_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailterimagudang_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailterimagudang_list->SortUrl($detailterimagudang_list->id_satuan) ?>', 1);"><div id="elh_detailterimagudang_id_satuan" class="detailterimagudang_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailterimagudang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailterimagudang_list->ExportAll && $detailterimagudang_list->isExport()) {
	$detailterimagudang_list->StopRecord = $detailterimagudang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailterimagudang_list->TotalRecords > $detailterimagudang_list->StartRecord + $detailterimagudang_list->DisplayRecords - 1)
		$detailterimagudang_list->StopRecord = $detailterimagudang_list->StartRecord + $detailterimagudang_list->DisplayRecords - 1;
	else
		$detailterimagudang_list->StopRecord = $detailterimagudang_list->TotalRecords;
}
$detailterimagudang_list->RecordCount = $detailterimagudang_list->StartRecord - 1;
if ($detailterimagudang_list->Recordset && !$detailterimagudang_list->Recordset->EOF) {
	$detailterimagudang_list->Recordset->moveFirst();
	$selectLimit = $detailterimagudang_list->UseSelectLimit;
	if (!$selectLimit && $detailterimagudang_list->StartRecord > 1)
		$detailterimagudang_list->Recordset->move($detailterimagudang_list->StartRecord - 1);
} elseif (!$detailterimagudang->AllowAddDeleteRow && $detailterimagudang_list->StopRecord == 0) {
	$detailterimagudang_list->StopRecord = $detailterimagudang->GridAddRowCount;
}

// Initialize aggregate
$detailterimagudang->RowType = ROWTYPE_AGGREGATEINIT;
$detailterimagudang->resetAttributes();
$detailterimagudang_list->renderRow();
while ($detailterimagudang_list->RecordCount < $detailterimagudang_list->StopRecord) {
	$detailterimagudang_list->RecordCount++;
	if ($detailterimagudang_list->RecordCount >= $detailterimagudang_list->StartRecord) {
		$detailterimagudang_list->RowCount++;

		// Set up key count
		$detailterimagudang_list->KeyCount = $detailterimagudang_list->RowIndex;

		// Init row class and style
		$detailterimagudang->resetAttributes();
		$detailterimagudang->CssClass = "";
		if ($detailterimagudang_list->isGridAdd()) {
		} else {
			$detailterimagudang_list->loadRowValues($detailterimagudang_list->Recordset); // Load row values
		}
		$detailterimagudang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailterimagudang->RowAttrs->merge(["data-rowindex" => $detailterimagudang_list->RowCount, "id" => "r" . $detailterimagudang_list->RowCount . "_detailterimagudang", "data-rowtype" => $detailterimagudang->RowType]);

		// Render row
		$detailterimagudang_list->renderRow();

		// Render list options
		$detailterimagudang_list->renderListOptions();
?>
	<tr <?php echo $detailterimagudang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimagudang_list->ListOptions->render("body", "left", $detailterimagudang_list->RowCount);
?>
	<?php if ($detailterimagudang_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailterimagudang_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailterimagudang_list->RowCount ?>_detailterimagudang_id_barang">
<span<?php echo $detailterimagudang_list->id_barang->viewAttributes() ?>><?php echo $detailterimagudang_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailterimagudang_list->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detailterimagudang_list->qty->cellAttributes() ?>>
<span id="el<?php echo $detailterimagudang_list->RowCount ?>_detailterimagudang_qty">
<span<?php echo $detailterimagudang_list->qty->viewAttributes() ?>><?php echo $detailterimagudang_list->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailterimagudang_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailterimagudang_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailterimagudang_list->RowCount ?>_detailterimagudang_id_satuan">
<span<?php echo $detailterimagudang_list->id_satuan->viewAttributes() ?>><?php echo $detailterimagudang_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailterimagudang_list->ListOptions->render("body", "right", $detailterimagudang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailterimagudang_list->isGridAdd())
		$detailterimagudang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailterimagudang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailterimagudang_list->Recordset)
	$detailterimagudang_list->Recordset->Close();
?>
<?php if (!$detailterimagudang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailterimagudang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailterimagudang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailterimagudang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailterimagudang_list->TotalRecords == 0 && !$detailterimagudang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailterimagudang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailterimagudang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailterimagudang_list->isExport()) { ?>
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
$detailterimagudang_list->terminate();
?>