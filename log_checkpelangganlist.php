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
$log_checkpelanggan_list = new log_checkpelanggan_list();

// Run the page
$log_checkpelanggan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_checkpelanggan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$log_checkpelanggan_list->isExport()) { ?>
<script>
var flog_checkpelangganlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flog_checkpelangganlist = currentForm = new ew.Form("flog_checkpelangganlist", "list");
	flog_checkpelangganlist.formKeyCountName = '<?php echo $log_checkpelanggan_list->FormKeyCountName ?>';
	loadjs.done("flog_checkpelangganlist");
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
<?php if (!$log_checkpelanggan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($log_checkpelanggan_list->TotalRecords > 0 && $log_checkpelanggan_list->ExportOptions->visible()) { ?>
<?php $log_checkpelanggan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($log_checkpelanggan_list->ImportOptions->visible()) { ?>
<?php $log_checkpelanggan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$log_checkpelanggan_list->renderOtherOptions();
?>
<?php $log_checkpelanggan_list->showPageHeader(); ?>
<?php
$log_checkpelanggan_list->showMessage();
?>
<?php if ($log_checkpelanggan_list->TotalRecords > 0 || $log_checkpelanggan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($log_checkpelanggan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> log_checkpelanggan">
<?php if (!$log_checkpelanggan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$log_checkpelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $log_checkpelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $log_checkpelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flog_checkpelangganlist" id="flog_checkpelangganlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log_checkpelanggan">
<div id="gmp_log_checkpelanggan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($log_checkpelanggan_list->TotalRecords > 0 || $log_checkpelanggan_list->isGridEdit()) { ?>
<table id="tbl_log_checkpelangganlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$log_checkpelanggan->RowType = ROWTYPE_HEADER;

// Render list options
$log_checkpelanggan_list->renderListOptions();

// Render list options (header, left)
$log_checkpelanggan_list->ListOptions->render("header", "left");
?>
<?php if ($log_checkpelanggan_list->id->Visible) { // id ?>
	<?php if ($log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $log_checkpelanggan_list->id->headerCellClass() ?>"><div id="elh_log_checkpelanggan_id" class="log_checkpelanggan_id"><div class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $log_checkpelanggan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->id) ?>', 1);"><div id="elh_log_checkpelanggan_id" class="log_checkpelanggan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($log_checkpelanggan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($log_checkpelanggan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log_checkpelanggan_list->tglwaktu_update->Visible) { // tglwaktu_update ?>
	<?php if ($log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->tglwaktu_update) == "") { ?>
		<th data-name="tglwaktu_update" class="<?php echo $log_checkpelanggan_list->tglwaktu_update->headerCellClass() ?>"><div id="elh_log_checkpelanggan_tglwaktu_update" class="log_checkpelanggan_tglwaktu_update"><div class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->tglwaktu_update->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tglwaktu_update" class="<?php echo $log_checkpelanggan_list->tglwaktu_update->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->tglwaktu_update) ?>', 1);"><div id="elh_log_checkpelanggan_tglwaktu_update" class="log_checkpelanggan_tglwaktu_update">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->tglwaktu_update->caption() ?></span><span class="ew-table-header-sort"><?php if ($log_checkpelanggan_list->tglwaktu_update->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($log_checkpelanggan_list->tglwaktu_update->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log_checkpelanggan_list->tgl_update->Visible) { // tgl_update ?>
	<?php if ($log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->tgl_update) == "") { ?>
		<th data-name="tgl_update" class="<?php echo $log_checkpelanggan_list->tgl_update->headerCellClass() ?>"><div id="elh_log_checkpelanggan_tgl_update" class="log_checkpelanggan_tgl_update"><div class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->tgl_update->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_update" class="<?php echo $log_checkpelanggan_list->tgl_update->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->tgl_update) ?>', 1);"><div id="elh_log_checkpelanggan_tgl_update" class="log_checkpelanggan_tgl_update">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->tgl_update->caption() ?></span><span class="ew-table-header-sort"><?php if ($log_checkpelanggan_list->tgl_update->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($log_checkpelanggan_list->tgl_update->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($log_checkpelanggan_list->id_user->Visible) { // id_user ?>
	<?php if ($log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->id_user) == "") { ?>
		<th data-name="id_user" class="<?php echo $log_checkpelanggan_list->id_user->headerCellClass() ?>"><div id="elh_log_checkpelanggan_id_user" class="log_checkpelanggan_id_user"><div class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->id_user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_user" class="<?php echo $log_checkpelanggan_list->id_user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $log_checkpelanggan_list->SortUrl($log_checkpelanggan_list->id_user) ?>', 1);"><div id="elh_log_checkpelanggan_id_user" class="log_checkpelanggan_id_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $log_checkpelanggan_list->id_user->caption() ?></span><span class="ew-table-header-sort"><?php if ($log_checkpelanggan_list->id_user->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($log_checkpelanggan_list->id_user->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$log_checkpelanggan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($log_checkpelanggan_list->ExportAll && $log_checkpelanggan_list->isExport()) {
	$log_checkpelanggan_list->StopRecord = $log_checkpelanggan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($log_checkpelanggan_list->TotalRecords > $log_checkpelanggan_list->StartRecord + $log_checkpelanggan_list->DisplayRecords - 1)
		$log_checkpelanggan_list->StopRecord = $log_checkpelanggan_list->StartRecord + $log_checkpelanggan_list->DisplayRecords - 1;
	else
		$log_checkpelanggan_list->StopRecord = $log_checkpelanggan_list->TotalRecords;
}
$log_checkpelanggan_list->RecordCount = $log_checkpelanggan_list->StartRecord - 1;
if ($log_checkpelanggan_list->Recordset && !$log_checkpelanggan_list->Recordset->EOF) {
	$log_checkpelanggan_list->Recordset->moveFirst();
	$selectLimit = $log_checkpelanggan_list->UseSelectLimit;
	if (!$selectLimit && $log_checkpelanggan_list->StartRecord > 1)
		$log_checkpelanggan_list->Recordset->move($log_checkpelanggan_list->StartRecord - 1);
} elseif (!$log_checkpelanggan->AllowAddDeleteRow && $log_checkpelanggan_list->StopRecord == 0) {
	$log_checkpelanggan_list->StopRecord = $log_checkpelanggan->GridAddRowCount;
}

// Initialize aggregate
$log_checkpelanggan->RowType = ROWTYPE_AGGREGATEINIT;
$log_checkpelanggan->resetAttributes();
$log_checkpelanggan_list->renderRow();
while ($log_checkpelanggan_list->RecordCount < $log_checkpelanggan_list->StopRecord) {
	$log_checkpelanggan_list->RecordCount++;
	if ($log_checkpelanggan_list->RecordCount >= $log_checkpelanggan_list->StartRecord) {
		$log_checkpelanggan_list->RowCount++;

		// Set up key count
		$log_checkpelanggan_list->KeyCount = $log_checkpelanggan_list->RowIndex;

		// Init row class and style
		$log_checkpelanggan->resetAttributes();
		$log_checkpelanggan->CssClass = "";
		if ($log_checkpelanggan_list->isGridAdd()) {
		} else {
			$log_checkpelanggan_list->loadRowValues($log_checkpelanggan_list->Recordset); // Load row values
		}
		$log_checkpelanggan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$log_checkpelanggan->RowAttrs->merge(["data-rowindex" => $log_checkpelanggan_list->RowCount, "id" => "r" . $log_checkpelanggan_list->RowCount . "_log_checkpelanggan", "data-rowtype" => $log_checkpelanggan->RowType]);

		// Render row
		$log_checkpelanggan_list->renderRow();

		// Render list options
		$log_checkpelanggan_list->renderListOptions();
?>
	<tr <?php echo $log_checkpelanggan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$log_checkpelanggan_list->ListOptions->render("body", "left", $log_checkpelanggan_list->RowCount);
?>
	<?php if ($log_checkpelanggan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $log_checkpelanggan_list->id->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_list->RowCount ?>_log_checkpelanggan_id">
<span<?php echo $log_checkpelanggan_list->id->viewAttributes() ?>><?php echo $log_checkpelanggan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log_checkpelanggan_list->tglwaktu_update->Visible) { // tglwaktu_update ?>
		<td data-name="tglwaktu_update" <?php echo $log_checkpelanggan_list->tglwaktu_update->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_list->RowCount ?>_log_checkpelanggan_tglwaktu_update">
<span<?php echo $log_checkpelanggan_list->tglwaktu_update->viewAttributes() ?>><?php echo $log_checkpelanggan_list->tglwaktu_update->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log_checkpelanggan_list->tgl_update->Visible) { // tgl_update ?>
		<td data-name="tgl_update" <?php echo $log_checkpelanggan_list->tgl_update->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_list->RowCount ?>_log_checkpelanggan_tgl_update">
<span<?php echo $log_checkpelanggan_list->tgl_update->viewAttributes() ?>><?php echo $log_checkpelanggan_list->tgl_update->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($log_checkpelanggan_list->id_user->Visible) { // id_user ?>
		<td data-name="id_user" <?php echo $log_checkpelanggan_list->id_user->cellAttributes() ?>>
<span id="el<?php echo $log_checkpelanggan_list->RowCount ?>_log_checkpelanggan_id_user">
<span<?php echo $log_checkpelanggan_list->id_user->viewAttributes() ?>><?php echo $log_checkpelanggan_list->id_user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$log_checkpelanggan_list->ListOptions->render("body", "right", $log_checkpelanggan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$log_checkpelanggan_list->isGridAdd())
		$log_checkpelanggan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$log_checkpelanggan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($log_checkpelanggan_list->Recordset)
	$log_checkpelanggan_list->Recordset->Close();
?>
<?php if (!$log_checkpelanggan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$log_checkpelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $log_checkpelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $log_checkpelanggan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($log_checkpelanggan_list->TotalRecords == 0 && !$log_checkpelanggan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $log_checkpelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$log_checkpelanggan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$log_checkpelanggan_list->isExport()) { ?>
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
$log_checkpelanggan_list->terminate();
?>