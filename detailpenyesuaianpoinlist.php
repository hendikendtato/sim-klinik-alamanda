<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$detailpenyesuaianpoin_list = new detailpenyesuaianpoin_list();

// Run the page
$detailpenyesuaianpoin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianpoin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpenyesuaianpoin_list->isExport()) { ?>
<script>
var fdetailpenyesuaianpoinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailpenyesuaianpoinlist = currentForm = new ew.Form("fdetailpenyesuaianpoinlist", "list");
	fdetailpenyesuaianpoinlist.formKeyCountName = '<?php echo $detailpenyesuaianpoin_list->FormKeyCountName ?>';
	loadjs.done("fdetailpenyesuaianpoinlist");
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
<?php if (!$detailpenyesuaianpoin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailpenyesuaianpoin_list->TotalRecords > 0 && $detailpenyesuaianpoin_list->ExportOptions->visible()) { ?>
<?php $detailpenyesuaianpoin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->ImportOptions->visible()) { ?>
<?php $detailpenyesuaianpoin_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailpenyesuaianpoin_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailpenyesuaianpoin_list->isExport("print")) { ?>
<?php
if ($detailpenyesuaianpoin_list->DbMasterFilter != "" && $detailpenyesuaianpoin->getCurrentMasterTable() == "penyesuaian_poin") {
	if ($detailpenyesuaianpoin_list->MasterRecordExists) {
		include_once "penyesuaian_poinmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailpenyesuaianpoin_list->renderOtherOptions();
?>
<?php $detailpenyesuaianpoin_list->showPageHeader(); ?>
<?php
$detailpenyesuaianpoin_list->showMessage();
?>
<?php if ($detailpenyesuaianpoin_list->TotalRecords > 0 || $detailpenyesuaianpoin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpenyesuaianpoin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpenyesuaianpoin">
<?php if (!$detailpenyesuaianpoin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailpenyesuaianpoin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpenyesuaianpoin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianpoin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailpenyesuaianpoinlist" id="fdetailpenyesuaianpoinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianpoin">
<?php if ($detailpenyesuaianpoin->getCurrentMasterTable() == "penyesuaian_poin" && $detailpenyesuaianpoin->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="penyesuaian_poin">
<input type="hidden" name="fk_id_penyesuaian_poin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_list->pid_penyesuaianpoin->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailpenyesuaianpoin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailpenyesuaianpoin_list->TotalRecords > 0 || $detailpenyesuaianpoin_list->isGridEdit()) { ?>
<table id="tbl_detailpenyesuaianpoinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpenyesuaianpoin->RowType = ROWTYPE_HEADER;

// Render list options
$detailpenyesuaianpoin_list->renderListOptions();

// Render list options (header, left)
$detailpenyesuaianpoin_list->ListOptions->render("header", "left");
?>
<?php if ($detailpenyesuaianpoin_list->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->pid_penyesuaianpoin) == "") { ?>
		<th data-name="pid_penyesuaianpoin" class="<?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin" class="detailpenyesuaianpoin_pid_penyesuaianpoin"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_penyesuaianpoin" class="<?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->pid_penyesuaianpoin) ?>', 1);"><div id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin" class="detailpenyesuaianpoin_pid_penyesuaianpoin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->pid_penyesuaianpoin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->pid_penyesuaianpoin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->id_member->Visible) { // id_member ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->id_member) == "") { ?>
		<th data-name="id_member" class="<?php echo $detailpenyesuaianpoin_list->id_member->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_id_member" class="detailpenyesuaianpoin_id_member"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->id_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_member" class="<?php echo $detailpenyesuaianpoin_list->id_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->id_member) ?>', 1);"><div id="elh_detailpenyesuaianpoin_id_member" class="detailpenyesuaianpoin_id_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->id_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->id_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->id_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->poin_database->Visible) { // poin_database ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->poin_database) == "") { ?>
		<th data-name="poin_database" class="<?php echo $detailpenyesuaianpoin_list->poin_database->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_poin_database" class="detailpenyesuaianpoin_poin_database"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->poin_database->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_database" class="<?php echo $detailpenyesuaianpoin_list->poin_database->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->poin_database) ?>', 1);"><div id="elh_detailpenyesuaianpoin_poin_database" class="detailpenyesuaianpoin_poin_database">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->poin_database->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->poin_database->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->poin_database->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->poin_lapangan->Visible) { // poin_lapangan ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->poin_lapangan) == "") { ?>
		<th data-name="poin_lapangan" class="<?php echo $detailpenyesuaianpoin_list->poin_lapangan->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_poin_lapangan" class="detailpenyesuaianpoin_poin_lapangan"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->poin_lapangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_lapangan" class="<?php echo $detailpenyesuaianpoin_list->poin_lapangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->poin_lapangan) ?>', 1);"><div id="elh_detailpenyesuaianpoin_poin_lapangan" class="detailpenyesuaianpoin_poin_lapangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->poin_lapangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->poin_lapangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->poin_lapangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->selisih->Visible) { // selisih ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->selisih) == "") { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianpoin_list->selisih->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_selisih" class="detailpenyesuaianpoin_selisih"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->selisih->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianpoin_list->selisih->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->selisih) ?>', 1);"><div id="elh_detailpenyesuaianpoin_selisih" class="detailpenyesuaianpoin_selisih">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->selisih->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->selisih->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->selisih->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->tipe->Visible) { // tipe ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianpoin_list->tipe->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_tipe" class="detailpenyesuaianpoin_tipe"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianpoin_list->tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->tipe) ?>', 1);"><div id="elh_detailpenyesuaianpoin_tipe" class="detailpenyesuaianpoin_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->keterangan->Visible) { // keterangan ?>
	<?php if ($detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $detailpenyesuaianpoin_list->keterangan->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_keterangan" class="detailpenyesuaianpoin_keterangan"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $detailpenyesuaianpoin_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenyesuaianpoin_list->SortUrl($detailpenyesuaianpoin_list->keterangan) ?>', 1);"><div id="elh_detailpenyesuaianpoin_keterangan" class="detailpenyesuaianpoin_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_list->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenyesuaianpoin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailpenyesuaianpoin_list->ExportAll && $detailpenyesuaianpoin_list->isExport()) {
	$detailpenyesuaianpoin_list->StopRecord = $detailpenyesuaianpoin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailpenyesuaianpoin_list->TotalRecords > $detailpenyesuaianpoin_list->StartRecord + $detailpenyesuaianpoin_list->DisplayRecords - 1)
		$detailpenyesuaianpoin_list->StopRecord = $detailpenyesuaianpoin_list->StartRecord + $detailpenyesuaianpoin_list->DisplayRecords - 1;
	else
		$detailpenyesuaianpoin_list->StopRecord = $detailpenyesuaianpoin_list->TotalRecords;
}
$detailpenyesuaianpoin_list->RecordCount = $detailpenyesuaianpoin_list->StartRecord - 1;
if ($detailpenyesuaianpoin_list->Recordset && !$detailpenyesuaianpoin_list->Recordset->EOF) {
	$detailpenyesuaianpoin_list->Recordset->moveFirst();
	$selectLimit = $detailpenyesuaianpoin_list->UseSelectLimit;
	if (!$selectLimit && $detailpenyesuaianpoin_list->StartRecord > 1)
		$detailpenyesuaianpoin_list->Recordset->move($detailpenyesuaianpoin_list->StartRecord - 1);
} elseif (!$detailpenyesuaianpoin->AllowAddDeleteRow && $detailpenyesuaianpoin_list->StopRecord == 0) {
	$detailpenyesuaianpoin_list->StopRecord = $detailpenyesuaianpoin->GridAddRowCount;
}

// Initialize aggregate
$detailpenyesuaianpoin->RowType = ROWTYPE_AGGREGATEINIT;
$detailpenyesuaianpoin->resetAttributes();
$detailpenyesuaianpoin_list->renderRow();
while ($detailpenyesuaianpoin_list->RecordCount < $detailpenyesuaianpoin_list->StopRecord) {
	$detailpenyesuaianpoin_list->RecordCount++;
	if ($detailpenyesuaianpoin_list->RecordCount >= $detailpenyesuaianpoin_list->StartRecord) {
		$detailpenyesuaianpoin_list->RowCount++;

		// Set up key count
		$detailpenyesuaianpoin_list->KeyCount = $detailpenyesuaianpoin_list->RowIndex;

		// Init row class and style
		$detailpenyesuaianpoin->resetAttributes();
		$detailpenyesuaianpoin->CssClass = "";
		if ($detailpenyesuaianpoin_list->isGridAdd()) {
		} else {
			$detailpenyesuaianpoin_list->loadRowValues($detailpenyesuaianpoin_list->Recordset); // Load row values
		}
		$detailpenyesuaianpoin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailpenyesuaianpoin->RowAttrs->merge(["data-rowindex" => $detailpenyesuaianpoin_list->RowCount, "id" => "r" . $detailpenyesuaianpoin_list->RowCount . "_detailpenyesuaianpoin", "data-rowtype" => $detailpenyesuaianpoin->RowType]);

		// Render row
		$detailpenyesuaianpoin_list->renderRow();

		// Render list options
		$detailpenyesuaianpoin_list->renderListOptions();
?>
	<tr <?php echo $detailpenyesuaianpoin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianpoin_list->ListOptions->render("body", "left", $detailpenyesuaianpoin_list->RowCount);
?>
	<?php if ($detailpenyesuaianpoin_list->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
		<td data-name="pid_penyesuaianpoin" <?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->pid_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_list->id_member->Visible) { // id_member ?>
		<td data-name="id_member" <?php echo $detailpenyesuaianpoin_list->id_member->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_id_member">
<span<?php echo $detailpenyesuaianpoin_list->id_member->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->id_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_list->poin_database->Visible) { // poin_database ?>
		<td data-name="poin_database" <?php echo $detailpenyesuaianpoin_list->poin_database->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_poin_database">
<span<?php echo $detailpenyesuaianpoin_list->poin_database->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->poin_database->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_list->poin_lapangan->Visible) { // poin_lapangan ?>
		<td data-name="poin_lapangan" <?php echo $detailpenyesuaianpoin_list->poin_lapangan->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_poin_lapangan">
<span<?php echo $detailpenyesuaianpoin_list->poin_lapangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->poin_lapangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_list->selisih->Visible) { // selisih ?>
		<td data-name="selisih" <?php echo $detailpenyesuaianpoin_list->selisih->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_selisih">
<span<?php echo $detailpenyesuaianpoin_list->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->selisih->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_list->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $detailpenyesuaianpoin_list->tipe->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_tipe">
<span<?php echo $detailpenyesuaianpoin_list->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $detailpenyesuaianpoin_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $detailpenyesuaianpoin_list->RowCount ?>_detailpenyesuaianpoin_keterangan">
<span<?php echo $detailpenyesuaianpoin_list->keterangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianpoin_list->ListOptions->render("body", "right", $detailpenyesuaianpoin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailpenyesuaianpoin_list->isGridAdd())
		$detailpenyesuaianpoin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailpenyesuaianpoin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpenyesuaianpoin_list->Recordset)
	$detailpenyesuaianpoin_list->Recordset->Close();
?>
<?php if (!$detailpenyesuaianpoin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailpenyesuaianpoin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpenyesuaianpoin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianpoin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpenyesuaianpoin_list->TotalRecords == 0 && !$detailpenyesuaianpoin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianpoin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailpenyesuaianpoin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpenyesuaianpoin_list->isExport()) { ?>
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
$detailpenyesuaianpoin_list->terminate();
?>