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
$m_jadwalpegawai_list = new m_jadwalpegawai_list();

// Run the page
$m_jadwalpegawai_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jadwalpegawai_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_jadwalpegawai_list->isExport()) { ?>
<script>
var fm_jadwalpegawailist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_jadwalpegawailist = currentForm = new ew.Form("fm_jadwalpegawailist", "list");
	fm_jadwalpegawailist.formKeyCountName = '<?php echo $m_jadwalpegawai_list->FormKeyCountName ?>';
	loadjs.done("fm_jadwalpegawailist");
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
<?php if (!$m_jadwalpegawai_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_jadwalpegawai_list->TotalRecords > 0 && $m_jadwalpegawai_list->ExportOptions->visible()) { ?>
<?php $m_jadwalpegawai_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_jadwalpegawai_list->ImportOptions->visible()) { ?>
<?php $m_jadwalpegawai_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_jadwalpegawai_list->renderOtherOptions();
?>
<?php $m_jadwalpegawai_list->showPageHeader(); ?>
<?php
$m_jadwalpegawai_list->showMessage();
?>
<?php if ($m_jadwalpegawai_list->TotalRecords > 0 || $m_jadwalpegawai->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_jadwalpegawai_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_jadwalpegawai">
<?php if (!$m_jadwalpegawai_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_jadwalpegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_jadwalpegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_jadwalpegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_jadwalpegawailist" id="fm_jadwalpegawailist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jadwalpegawai">
<div id="gmp_m_jadwalpegawai" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_jadwalpegawai_list->TotalRecords > 0 || $m_jadwalpegawai_list->isGridEdit()) { ?>
<table id="tbl_m_jadwalpegawailist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_jadwalpegawai->RowType = ROWTYPE_HEADER;

// Render list options
$m_jadwalpegawai_list->renderListOptions();

// Render list options (header, left)
$m_jadwalpegawai_list->ListOptions->render("header", "left");
?>
<?php if ($m_jadwalpegawai_list->id_jadwalpeg->Visible) { // id_jadwalpeg ?>
	<?php if ($m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->id_jadwalpeg) == "") { ?>
		<th data-name="id_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->id_jadwalpeg->headerCellClass() ?>"><div id="elh_m_jadwalpegawai_id_jadwalpeg" class="m_jadwalpegawai_id_jadwalpeg"><div class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->id_jadwalpeg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->id_jadwalpeg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->id_jadwalpeg) ?>', 1);"><div id="elh_m_jadwalpegawai_id_jadwalpeg" class="m_jadwalpegawai_id_jadwalpeg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->id_jadwalpeg->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jadwalpegawai_list->id_jadwalpeg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jadwalpegawai_list->id_jadwalpeg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jadwalpegawai_list->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
	<?php if ($m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->tindakan_jadwalpeg) == "") { ?>
		<th data-name="tindakan_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->headerCellClass() ?>"><div id="elh_m_jadwalpegawai_tindakan_jadwalpeg" class="m_jadwalpegawai_tindakan_jadwalpeg"><div class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tindakan_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->tindakan_jadwalpeg) ?>', 1);"><div id="elh_m_jadwalpegawai_tindakan_jadwalpeg" class="m_jadwalpegawai_tindakan_jadwalpeg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jadwalpegawai_list->tindakan_jadwalpeg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jadwalpegawai_list->tindakan_jadwalpeg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jadwalpegawai_list->idpeg->Visible) { // idpeg ?>
	<?php if ($m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->idpeg) == "") { ?>
		<th data-name="idpeg" class="<?php echo $m_jadwalpegawai_list->idpeg->headerCellClass() ?>"><div id="elh_m_jadwalpegawai_idpeg" class="m_jadwalpegawai_idpeg"><div class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->idpeg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idpeg" class="<?php echo $m_jadwalpegawai_list->idpeg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->idpeg) ?>', 1);"><div id="elh_m_jadwalpegawai_idpeg" class="m_jadwalpegawai_idpeg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->idpeg->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jadwalpegawai_list->idpeg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jadwalpegawai_list->idpeg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jadwalpegawai_list->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
	<?php if ($m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->tanggal_jadwalpeg) == "") { ?>
		<th data-name="tanggal_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->headerCellClass() ?>"><div id="elh_m_jadwalpegawai_tanggal_jadwalpeg" class="m_jadwalpegawai_tanggal_jadwalpeg"><div class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->tanggal_jadwalpeg) ?>', 1);"><div id="elh_m_jadwalpegawai_tanggal_jadwalpeg" class="m_jadwalpegawai_tanggal_jadwalpeg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jadwalpegawai_list->tanggal_jadwalpeg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jadwalpegawai_list->tanggal_jadwalpeg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jadwalpegawai_list->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
	<?php if ($m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->jam_jadwalpeg) == "") { ?>
		<th data-name="jam_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->jam_jadwalpeg->headerCellClass() ?>"><div id="elh_m_jadwalpegawai_jam_jadwalpeg" class="m_jadwalpegawai_jam_jadwalpeg"><div class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->jam_jadwalpeg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->jam_jadwalpeg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->jam_jadwalpeg) ?>', 1);"><div id="elh_m_jadwalpegawai_jam_jadwalpeg" class="m_jadwalpegawai_jam_jadwalpeg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->jam_jadwalpeg->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jadwalpegawai_list->jam_jadwalpeg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jadwalpegawai_list->jam_jadwalpeg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jadwalpegawai_list->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
	<?php if ($m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->status_jadwalpeg) == "") { ?>
		<th data-name="status_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->status_jadwalpeg->headerCellClass() ?>"><div id="elh_m_jadwalpegawai_status_jadwalpeg" class="m_jadwalpegawai_status_jadwalpeg"><div class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->status_jadwalpeg->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_jadwalpeg" class="<?php echo $m_jadwalpegawai_list->status_jadwalpeg->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jadwalpegawai_list->SortUrl($m_jadwalpegawai_list->status_jadwalpeg) ?>', 1);"><div id="elh_m_jadwalpegawai_status_jadwalpeg" class="m_jadwalpegawai_status_jadwalpeg">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jadwalpegawai_list->status_jadwalpeg->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jadwalpegawai_list->status_jadwalpeg->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jadwalpegawai_list->status_jadwalpeg->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_jadwalpegawai_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_jadwalpegawai_list->ExportAll && $m_jadwalpegawai_list->isExport()) {
	$m_jadwalpegawai_list->StopRecord = $m_jadwalpegawai_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_jadwalpegawai_list->TotalRecords > $m_jadwalpegawai_list->StartRecord + $m_jadwalpegawai_list->DisplayRecords - 1)
		$m_jadwalpegawai_list->StopRecord = $m_jadwalpegawai_list->StartRecord + $m_jadwalpegawai_list->DisplayRecords - 1;
	else
		$m_jadwalpegawai_list->StopRecord = $m_jadwalpegawai_list->TotalRecords;
}
$m_jadwalpegawai_list->RecordCount = $m_jadwalpegawai_list->StartRecord - 1;
if ($m_jadwalpegawai_list->Recordset && !$m_jadwalpegawai_list->Recordset->EOF) {
	$m_jadwalpegawai_list->Recordset->moveFirst();
	$selectLimit = $m_jadwalpegawai_list->UseSelectLimit;
	if (!$selectLimit && $m_jadwalpegawai_list->StartRecord > 1)
		$m_jadwalpegawai_list->Recordset->move($m_jadwalpegawai_list->StartRecord - 1);
} elseif (!$m_jadwalpegawai->AllowAddDeleteRow && $m_jadwalpegawai_list->StopRecord == 0) {
	$m_jadwalpegawai_list->StopRecord = $m_jadwalpegawai->GridAddRowCount;
}

// Initialize aggregate
$m_jadwalpegawai->RowType = ROWTYPE_AGGREGATEINIT;
$m_jadwalpegawai->resetAttributes();
$m_jadwalpegawai_list->renderRow();
while ($m_jadwalpegawai_list->RecordCount < $m_jadwalpegawai_list->StopRecord) {
	$m_jadwalpegawai_list->RecordCount++;
	if ($m_jadwalpegawai_list->RecordCount >= $m_jadwalpegawai_list->StartRecord) {
		$m_jadwalpegawai_list->RowCount++;

		// Set up key count
		$m_jadwalpegawai_list->KeyCount = $m_jadwalpegawai_list->RowIndex;

		// Init row class and style
		$m_jadwalpegawai->resetAttributes();
		$m_jadwalpegawai->CssClass = "";
		if ($m_jadwalpegawai_list->isGridAdd()) {
		} else {
			$m_jadwalpegawai_list->loadRowValues($m_jadwalpegawai_list->Recordset); // Load row values
		}
		$m_jadwalpegawai->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_jadwalpegawai->RowAttrs->merge(["data-rowindex" => $m_jadwalpegawai_list->RowCount, "id" => "r" . $m_jadwalpegawai_list->RowCount . "_m_jadwalpegawai", "data-rowtype" => $m_jadwalpegawai->RowType]);

		// Render row
		$m_jadwalpegawai_list->renderRow();

		// Render list options
		$m_jadwalpegawai_list->renderListOptions();
?>
	<tr <?php echo $m_jadwalpegawai->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_jadwalpegawai_list->ListOptions->render("body", "left", $m_jadwalpegawai_list->RowCount);
?>
	<?php if ($m_jadwalpegawai_list->id_jadwalpeg->Visible) { // id_jadwalpeg ?>
		<td data-name="id_jadwalpeg" <?php echo $m_jadwalpegawai_list->id_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_list->RowCount ?>_m_jadwalpegawai_id_jadwalpeg">
<span<?php echo $m_jadwalpegawai_list->id_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_list->id_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jadwalpegawai_list->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
		<td data-name="tindakan_jadwalpeg" <?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_list->RowCount ?>_m_jadwalpegawai_tindakan_jadwalpeg">
<span<?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_list->tindakan_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jadwalpegawai_list->idpeg->Visible) { // idpeg ?>
		<td data-name="idpeg" <?php echo $m_jadwalpegawai_list->idpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_list->RowCount ?>_m_jadwalpegawai_idpeg">
<span<?php echo $m_jadwalpegawai_list->idpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_list->idpeg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jadwalpegawai_list->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
		<td data-name="tanggal_jadwalpeg" <?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_list->RowCount ?>_m_jadwalpegawai_tanggal_jadwalpeg">
<span<?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_list->tanggal_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jadwalpegawai_list->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
		<td data-name="jam_jadwalpeg" <?php echo $m_jadwalpegawai_list->jam_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_list->RowCount ?>_m_jadwalpegawai_jam_jadwalpeg">
<span<?php echo $m_jadwalpegawai_list->jam_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_list->jam_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jadwalpegawai_list->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
		<td data-name="status_jadwalpeg" <?php echo $m_jadwalpegawai_list->status_jadwalpeg->cellAttributes() ?>>
<span id="el<?php echo $m_jadwalpegawai_list->RowCount ?>_m_jadwalpegawai_status_jadwalpeg">
<span<?php echo $m_jadwalpegawai_list->status_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_list->status_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_jadwalpegawai_list->ListOptions->render("body", "right", $m_jadwalpegawai_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_jadwalpegawai_list->isGridAdd())
		$m_jadwalpegawai_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_jadwalpegawai->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_jadwalpegawai_list->Recordset)
	$m_jadwalpegawai_list->Recordset->Close();
?>
<?php if (!$m_jadwalpegawai_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_jadwalpegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_jadwalpegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_jadwalpegawai_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_jadwalpegawai_list->TotalRecords == 0 && !$m_jadwalpegawai->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_jadwalpegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_jadwalpegawai_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_jadwalpegawai_list->isExport()) { ?>
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
$m_jadwalpegawai_list->terminate();
?>