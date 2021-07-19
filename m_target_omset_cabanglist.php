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
$m_target_omset_cabang_list = new m_target_omset_cabang_list();

// Run the page
$m_target_omset_cabang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_omset_cabang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_target_omset_cabang_list->isExport()) { ?>
<script>
var fm_target_omset_cabanglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_target_omset_cabanglist = currentForm = new ew.Form("fm_target_omset_cabanglist", "list");
	fm_target_omset_cabanglist.formKeyCountName = '<?php echo $m_target_omset_cabang_list->FormKeyCountName ?>';
	loadjs.done("fm_target_omset_cabanglist");
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
<?php if (!$m_target_omset_cabang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_target_omset_cabang_list->TotalRecords > 0 && $m_target_omset_cabang_list->ExportOptions->visible()) { ?>
<?php $m_target_omset_cabang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_target_omset_cabang_list->ImportOptions->visible()) { ?>
<?php $m_target_omset_cabang_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_target_omset_cabang_list->renderOtherOptions();
?>
<?php $m_target_omset_cabang_list->showPageHeader(); ?>
<?php
$m_target_omset_cabang_list->showMessage();
?>
<?php if ($m_target_omset_cabang_list->TotalRecords > 0 || $m_target_omset_cabang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_target_omset_cabang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_target_omset_cabang">
<?php if (!$m_target_omset_cabang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_target_omset_cabang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_target_omset_cabang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_target_omset_cabang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_target_omset_cabanglist" id="fm_target_omset_cabanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_omset_cabang">
<div id="gmp_m_target_omset_cabang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_target_omset_cabang_list->TotalRecords > 0 || $m_target_omset_cabang_list->isGridEdit()) { ?>
<table id="tbl_m_target_omset_cabanglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_target_omset_cabang->RowType = ROWTYPE_HEADER;

// Render list options
$m_target_omset_cabang_list->renderListOptions();

// Render list options (header, left)
$m_target_omset_cabang_list->ListOptions->render("header", "left");
?>
<?php if ($m_target_omset_cabang_list->id_cabang->Visible) { // id_cabang ?>
	<?php if ($m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->id_cabang) == "") { ?>
		<th data-name="id_cabang" class="<?php echo $m_target_omset_cabang_list->id_cabang->headerCellClass() ?>"><div id="elh_m_target_omset_cabang_id_cabang" class="m_target_omset_cabang_id_cabang"><div class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->id_cabang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cabang" class="<?php echo $m_target_omset_cabang_list->id_cabang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->id_cabang) ?>', 1);"><div id="elh_m_target_omset_cabang_id_cabang" class="m_target_omset_cabang_id_cabang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->id_cabang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_omset_cabang_list->id_cabang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_omset_cabang_list->id_cabang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_omset_cabang_list->tgl_awal->Visible) { // tgl_awal ?>
	<?php if ($m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->tgl_awal) == "") { ?>
		<th data-name="tgl_awal" class="<?php echo $m_target_omset_cabang_list->tgl_awal->headerCellClass() ?>"><div id="elh_m_target_omset_cabang_tgl_awal" class="m_target_omset_cabang_tgl_awal"><div class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->tgl_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_awal" class="<?php echo $m_target_omset_cabang_list->tgl_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->tgl_awal) ?>', 1);"><div id="elh_m_target_omset_cabang_tgl_awal" class="m_target_omset_cabang_tgl_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->tgl_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_omset_cabang_list->tgl_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_omset_cabang_list->tgl_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_omset_cabang_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_target_omset_cabang_list->tgl_akhir->headerCellClass() ?>"><div id="elh_m_target_omset_cabang_tgl_akhir" class="m_target_omset_cabang_tgl_akhir"><div class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_target_omset_cabang_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->tgl_akhir) ?>', 1);"><div id="elh_m_target_omset_cabang_tgl_akhir" class="m_target_omset_cabang_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_omset_cabang_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_omset_cabang_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_omset_cabang_list->target->Visible) { // target ?>
	<?php if ($m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->target) == "") { ?>
		<th data-name="target" class="<?php echo $m_target_omset_cabang_list->target->headerCellClass() ?>"><div id="elh_m_target_omset_cabang_target" class="m_target_omset_cabang_target"><div class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->target->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target" class="<?php echo $m_target_omset_cabang_list->target->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->target) ?>', 1);"><div id="elh_m_target_omset_cabang_target" class="m_target_omset_cabang_target">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->target->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_omset_cabang_list->target->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_omset_cabang_list->target->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_omset_cabang_list->baseline->Visible) { // baseline ?>
	<?php if ($m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->baseline) == "") { ?>
		<th data-name="baseline" class="<?php echo $m_target_omset_cabang_list->baseline->headerCellClass() ?>"><div id="elh_m_target_omset_cabang_baseline" class="m_target_omset_cabang_baseline"><div class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->baseline->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baseline" class="<?php echo $m_target_omset_cabang_list->baseline->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->baseline) ?>', 1);"><div id="elh_m_target_omset_cabang_baseline" class="m_target_omset_cabang_baseline">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->baseline->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_omset_cabang_list->baseline->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_omset_cabang_list->baseline->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_target_omset_cabang_list->aset->Visible) { // aset ?>
	<?php if ($m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->aset) == "") { ?>
		<th data-name="aset" class="<?php echo $m_target_omset_cabang_list->aset->headerCellClass() ?>"><div id="elh_m_target_omset_cabang_aset" class="m_target_omset_cabang_aset"><div class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->aset->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aset" class="<?php echo $m_target_omset_cabang_list->aset->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_target_omset_cabang_list->SortUrl($m_target_omset_cabang_list->aset) ?>', 1);"><div id="elh_m_target_omset_cabang_aset" class="m_target_omset_cabang_aset">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_target_omset_cabang_list->aset->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_target_omset_cabang_list->aset->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_target_omset_cabang_list->aset->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_target_omset_cabang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_target_omset_cabang_list->ExportAll && $m_target_omset_cabang_list->isExport()) {
	$m_target_omset_cabang_list->StopRecord = $m_target_omset_cabang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_target_omset_cabang_list->TotalRecords > $m_target_omset_cabang_list->StartRecord + $m_target_omset_cabang_list->DisplayRecords - 1)
		$m_target_omset_cabang_list->StopRecord = $m_target_omset_cabang_list->StartRecord + $m_target_omset_cabang_list->DisplayRecords - 1;
	else
		$m_target_omset_cabang_list->StopRecord = $m_target_omset_cabang_list->TotalRecords;
}
$m_target_omset_cabang_list->RecordCount = $m_target_omset_cabang_list->StartRecord - 1;
if ($m_target_omset_cabang_list->Recordset && !$m_target_omset_cabang_list->Recordset->EOF) {
	$m_target_omset_cabang_list->Recordset->moveFirst();
	$selectLimit = $m_target_omset_cabang_list->UseSelectLimit;
	if (!$selectLimit && $m_target_omset_cabang_list->StartRecord > 1)
		$m_target_omset_cabang_list->Recordset->move($m_target_omset_cabang_list->StartRecord - 1);
} elseif (!$m_target_omset_cabang->AllowAddDeleteRow && $m_target_omset_cabang_list->StopRecord == 0) {
	$m_target_omset_cabang_list->StopRecord = $m_target_omset_cabang->GridAddRowCount;
}

// Initialize aggregate
$m_target_omset_cabang->RowType = ROWTYPE_AGGREGATEINIT;
$m_target_omset_cabang->resetAttributes();
$m_target_omset_cabang_list->renderRow();
while ($m_target_omset_cabang_list->RecordCount < $m_target_omset_cabang_list->StopRecord) {
	$m_target_omset_cabang_list->RecordCount++;
	if ($m_target_omset_cabang_list->RecordCount >= $m_target_omset_cabang_list->StartRecord) {
		$m_target_omset_cabang_list->RowCount++;

		// Set up key count
		$m_target_omset_cabang_list->KeyCount = $m_target_omset_cabang_list->RowIndex;

		// Init row class and style
		$m_target_omset_cabang->resetAttributes();
		$m_target_omset_cabang->CssClass = "";
		if ($m_target_omset_cabang_list->isGridAdd()) {
		} else {
			$m_target_omset_cabang_list->loadRowValues($m_target_omset_cabang_list->Recordset); // Load row values
		}
		$m_target_omset_cabang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_target_omset_cabang->RowAttrs->merge(["data-rowindex" => $m_target_omset_cabang_list->RowCount, "id" => "r" . $m_target_omset_cabang_list->RowCount . "_m_target_omset_cabang", "data-rowtype" => $m_target_omset_cabang->RowType]);

		// Render row
		$m_target_omset_cabang_list->renderRow();

		// Render list options
		$m_target_omset_cabang_list->renderListOptions();
?>
	<tr <?php echo $m_target_omset_cabang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_target_omset_cabang_list->ListOptions->render("body", "left", $m_target_omset_cabang_list->RowCount);
?>
	<?php if ($m_target_omset_cabang_list->id_cabang->Visible) { // id_cabang ?>
		<td data-name="id_cabang" <?php echo $m_target_omset_cabang_list->id_cabang->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_cabang_list->RowCount ?>_m_target_omset_cabang_id_cabang">
<span<?php echo $m_target_omset_cabang_list->id_cabang->viewAttributes() ?>><?php echo $m_target_omset_cabang_list->id_cabang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_omset_cabang_list->tgl_awal->Visible) { // tgl_awal ?>
		<td data-name="tgl_awal" <?php echo $m_target_omset_cabang_list->tgl_awal->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_cabang_list->RowCount ?>_m_target_omset_cabang_tgl_awal">
<span<?php echo $m_target_omset_cabang_list->tgl_awal->viewAttributes() ?>><?php echo $m_target_omset_cabang_list->tgl_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_omset_cabang_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $m_target_omset_cabang_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_cabang_list->RowCount ?>_m_target_omset_cabang_tgl_akhir">
<span<?php echo $m_target_omset_cabang_list->tgl_akhir->viewAttributes() ?>><?php echo $m_target_omset_cabang_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_omset_cabang_list->target->Visible) { // target ?>
		<td data-name="target" <?php echo $m_target_omset_cabang_list->target->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_cabang_list->RowCount ?>_m_target_omset_cabang_target">
<span<?php echo $m_target_omset_cabang_list->target->viewAttributes() ?>><?php echo $m_target_omset_cabang_list->target->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_omset_cabang_list->baseline->Visible) { // baseline ?>
		<td data-name="baseline" <?php echo $m_target_omset_cabang_list->baseline->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_cabang_list->RowCount ?>_m_target_omset_cabang_baseline">
<span<?php echo $m_target_omset_cabang_list->baseline->viewAttributes() ?>><?php echo $m_target_omset_cabang_list->baseline->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_target_omset_cabang_list->aset->Visible) { // aset ?>
		<td data-name="aset" <?php echo $m_target_omset_cabang_list->aset->cellAttributes() ?>>
<span id="el<?php echo $m_target_omset_cabang_list->RowCount ?>_m_target_omset_cabang_aset">
<span<?php echo $m_target_omset_cabang_list->aset->viewAttributes() ?>><?php echo $m_target_omset_cabang_list->aset->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_target_omset_cabang_list->ListOptions->render("body", "right", $m_target_omset_cabang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_target_omset_cabang_list->isGridAdd())
		$m_target_omset_cabang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_target_omset_cabang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_target_omset_cabang_list->Recordset)
	$m_target_omset_cabang_list->Recordset->Close();
?>
<?php if (!$m_target_omset_cabang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_target_omset_cabang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_target_omset_cabang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_target_omset_cabang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_target_omset_cabang_list->TotalRecords == 0 && !$m_target_omset_cabang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_target_omset_cabang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_target_omset_cabang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_target_omset_cabang_list->isExport()) { ?>
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
$m_target_omset_cabang_list->terminate();
?>