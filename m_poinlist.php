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
$m_poin_list = new m_poin_list();

// Run the page
$m_poin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_poin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_poin_list->isExport()) { ?>
<script>
var fm_poinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_poinlist = currentForm = new ew.Form("fm_poinlist", "list");
	fm_poinlist.formKeyCountName = '<?php echo $m_poin_list->FormKeyCountName ?>';
	loadjs.done("fm_poinlist");
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
<?php if (!$m_poin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_poin_list->TotalRecords > 0 && $m_poin_list->ExportOptions->visible()) { ?>
<?php $m_poin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_poin_list->ImportOptions->visible()) { ?>
<?php $m_poin_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_poin_list->renderOtherOptions();
?>
<?php $m_poin_list->showPageHeader(); ?>
<?php
$m_poin_list->showMessage();
?>
<?php if ($m_poin_list->TotalRecords > 0 || $m_poin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_poin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_poin">
<?php if (!$m_poin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_poin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_poin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_poin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_poinlist" id="fm_poinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_poin">
<div id="gmp_m_poin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_poin_list->TotalRecords > 0 || $m_poin_list->isGridEdit()) { ?>
<table id="tbl_m_poinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_poin->RowType = ROWTYPE_HEADER;

// Render list options
$m_poin_list->renderListOptions();

// Render list options (header, left)
$m_poin_list->ListOptions->render("header", "left");
?>
<?php if ($m_poin_list->id_jenis_member->Visible) { // id_jenis_member ?>
	<?php if ($m_poin_list->SortUrl($m_poin_list->id_jenis_member) == "") { ?>
		<th data-name="id_jenis_member" class="<?php echo $m_poin_list->id_jenis_member->headerCellClass() ?>"><div id="elh_m_poin_id_jenis_member" class="m_poin_id_jenis_member"><div class="ew-table-header-caption"><?php echo $m_poin_list->id_jenis_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jenis_member" class="<?php echo $m_poin_list->id_jenis_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_poin_list->SortUrl($m_poin_list->id_jenis_member) ?>', 1);"><div id="elh_m_poin_id_jenis_member" class="m_poin_id_jenis_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_poin_list->id_jenis_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_poin_list->id_jenis_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_poin_list->id_jenis_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_poin_list->curs_poin->Visible) { // curs_poin ?>
	<?php if ($m_poin_list->SortUrl($m_poin_list->curs_poin) == "") { ?>
		<th data-name="curs_poin" class="<?php echo $m_poin_list->curs_poin->headerCellClass() ?>"><div id="elh_m_poin_curs_poin" class="m_poin_curs_poin"><div class="ew-table-header-caption"><?php echo $m_poin_list->curs_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="curs_poin" class="<?php echo $m_poin_list->curs_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_poin_list->SortUrl($m_poin_list->curs_poin) ?>', 1);"><div id="elh_m_poin_curs_poin" class="m_poin_curs_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_poin_list->curs_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_poin_list->curs_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_poin_list->curs_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_poin_list->curs_to_rp->Visible) { // curs_to_rp ?>
	<?php if ($m_poin_list->SortUrl($m_poin_list->curs_to_rp) == "") { ?>
		<th data-name="curs_to_rp" class="<?php echo $m_poin_list->curs_to_rp->headerCellClass() ?>"><div id="elh_m_poin_curs_to_rp" class="m_poin_curs_to_rp"><div class="ew-table-header-caption"><?php echo $m_poin_list->curs_to_rp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="curs_to_rp" class="<?php echo $m_poin_list->curs_to_rp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_poin_list->SortUrl($m_poin_list->curs_to_rp) ?>', 1);"><div id="elh_m_poin_curs_to_rp" class="m_poin_curs_to_rp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_poin_list->curs_to_rp->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_poin_list->curs_to_rp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_poin_list->curs_to_rp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_poin_list->max_klaim->Visible) { // max_klaim ?>
	<?php if ($m_poin_list->SortUrl($m_poin_list->max_klaim) == "") { ?>
		<th data-name="max_klaim" class="<?php echo $m_poin_list->max_klaim->headerCellClass() ?>"><div id="elh_m_poin_max_klaim" class="m_poin_max_klaim"><div class="ew-table-header-caption"><?php echo $m_poin_list->max_klaim->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="max_klaim" class="<?php echo $m_poin_list->max_klaim->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_poin_list->SortUrl($m_poin_list->max_klaim) ?>', 1);"><div id="elh_m_poin_max_klaim" class="m_poin_max_klaim">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_poin_list->max_klaim->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_poin_list->max_klaim->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_poin_list->max_klaim->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_poin_list->min_transaksi->Visible) { // min_transaksi ?>
	<?php if ($m_poin_list->SortUrl($m_poin_list->min_transaksi) == "") { ?>
		<th data-name="min_transaksi" class="<?php echo $m_poin_list->min_transaksi->headerCellClass() ?>"><div id="elh_m_poin_min_transaksi" class="m_poin_min_transaksi"><div class="ew-table-header-caption"><?php echo $m_poin_list->min_transaksi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="min_transaksi" class="<?php echo $m_poin_list->min_transaksi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_poin_list->SortUrl($m_poin_list->min_transaksi) ?>', 1);"><div id="elh_m_poin_min_transaksi" class="m_poin_min_transaksi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_poin_list->min_transaksi->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_poin_list->min_transaksi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_poin_list->min_transaksi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_poin_list->waktu_exp->Visible) { // waktu_exp ?>
	<?php if ($m_poin_list->SortUrl($m_poin_list->waktu_exp) == "") { ?>
		<th data-name="waktu_exp" class="<?php echo $m_poin_list->waktu_exp->headerCellClass() ?>"><div id="elh_m_poin_waktu_exp" class="m_poin_waktu_exp"><div class="ew-table-header-caption"><?php echo $m_poin_list->waktu_exp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="waktu_exp" class="<?php echo $m_poin_list->waktu_exp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_poin_list->SortUrl($m_poin_list->waktu_exp) ?>', 1);"><div id="elh_m_poin_waktu_exp" class="m_poin_waktu_exp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_poin_list->waktu_exp->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_poin_list->waktu_exp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_poin_list->waktu_exp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_poin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_poin_list->ExportAll && $m_poin_list->isExport()) {
	$m_poin_list->StopRecord = $m_poin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_poin_list->TotalRecords > $m_poin_list->StartRecord + $m_poin_list->DisplayRecords - 1)
		$m_poin_list->StopRecord = $m_poin_list->StartRecord + $m_poin_list->DisplayRecords - 1;
	else
		$m_poin_list->StopRecord = $m_poin_list->TotalRecords;
}
$m_poin_list->RecordCount = $m_poin_list->StartRecord - 1;
if ($m_poin_list->Recordset && !$m_poin_list->Recordset->EOF) {
	$m_poin_list->Recordset->moveFirst();
	$selectLimit = $m_poin_list->UseSelectLimit;
	if (!$selectLimit && $m_poin_list->StartRecord > 1)
		$m_poin_list->Recordset->move($m_poin_list->StartRecord - 1);
} elseif (!$m_poin->AllowAddDeleteRow && $m_poin_list->StopRecord == 0) {
	$m_poin_list->StopRecord = $m_poin->GridAddRowCount;
}

// Initialize aggregate
$m_poin->RowType = ROWTYPE_AGGREGATEINIT;
$m_poin->resetAttributes();
$m_poin_list->renderRow();
while ($m_poin_list->RecordCount < $m_poin_list->StopRecord) {
	$m_poin_list->RecordCount++;
	if ($m_poin_list->RecordCount >= $m_poin_list->StartRecord) {
		$m_poin_list->RowCount++;

		// Set up key count
		$m_poin_list->KeyCount = $m_poin_list->RowIndex;

		// Init row class and style
		$m_poin->resetAttributes();
		$m_poin->CssClass = "";
		if ($m_poin_list->isGridAdd()) {
		} else {
			$m_poin_list->loadRowValues($m_poin_list->Recordset); // Load row values
		}
		$m_poin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_poin->RowAttrs->merge(["data-rowindex" => $m_poin_list->RowCount, "id" => "r" . $m_poin_list->RowCount . "_m_poin", "data-rowtype" => $m_poin->RowType]);

		// Render row
		$m_poin_list->renderRow();

		// Render list options
		$m_poin_list->renderListOptions();
?>
	<tr <?php echo $m_poin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_poin_list->ListOptions->render("body", "left", $m_poin_list->RowCount);
?>
	<?php if ($m_poin_list->id_jenis_member->Visible) { // id_jenis_member ?>
		<td data-name="id_jenis_member" <?php echo $m_poin_list->id_jenis_member->cellAttributes() ?>>
<span id="el<?php echo $m_poin_list->RowCount ?>_m_poin_id_jenis_member">
<span<?php echo $m_poin_list->id_jenis_member->viewAttributes() ?>><?php echo $m_poin_list->id_jenis_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_poin_list->curs_poin->Visible) { // curs_poin ?>
		<td data-name="curs_poin" <?php echo $m_poin_list->curs_poin->cellAttributes() ?>>
<span id="el<?php echo $m_poin_list->RowCount ?>_m_poin_curs_poin">
<span<?php echo $m_poin_list->curs_poin->viewAttributes() ?>><?php echo $m_poin_list->curs_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_poin_list->curs_to_rp->Visible) { // curs_to_rp ?>
		<td data-name="curs_to_rp" <?php echo $m_poin_list->curs_to_rp->cellAttributes() ?>>
<span id="el<?php echo $m_poin_list->RowCount ?>_m_poin_curs_to_rp">
<span<?php echo $m_poin_list->curs_to_rp->viewAttributes() ?>><?php echo $m_poin_list->curs_to_rp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_poin_list->max_klaim->Visible) { // max_klaim ?>
		<td data-name="max_klaim" <?php echo $m_poin_list->max_klaim->cellAttributes() ?>>
<span id="el<?php echo $m_poin_list->RowCount ?>_m_poin_max_klaim">
<span<?php echo $m_poin_list->max_klaim->viewAttributes() ?>><?php echo $m_poin_list->max_klaim->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_poin_list->min_transaksi->Visible) { // min_transaksi ?>
		<td data-name="min_transaksi" <?php echo $m_poin_list->min_transaksi->cellAttributes() ?>>
<span id="el<?php echo $m_poin_list->RowCount ?>_m_poin_min_transaksi">
<span<?php echo $m_poin_list->min_transaksi->viewAttributes() ?>><?php echo $m_poin_list->min_transaksi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_poin_list->waktu_exp->Visible) { // waktu_exp ?>
		<td data-name="waktu_exp" <?php echo $m_poin_list->waktu_exp->cellAttributes() ?>>
<span id="el<?php echo $m_poin_list->RowCount ?>_m_poin_waktu_exp">
<span<?php echo $m_poin_list->waktu_exp->viewAttributes() ?>><?php echo $m_poin_list->waktu_exp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_poin_list->ListOptions->render("body", "right", $m_poin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_poin_list->isGridAdd())
		$m_poin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_poin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_poin_list->Recordset)
	$m_poin_list->Recordset->Close();
?>
<?php if (!$m_poin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_poin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_poin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_poin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_poin_list->TotalRecords == 0 && !$m_poin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_poin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_poin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_poin_list->isExport()) { ?>
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
$m_poin_list->terminate();
?>