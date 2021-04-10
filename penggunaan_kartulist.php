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
$penggunaan_kartu_list = new penggunaan_kartu_list();

// Run the page
$penggunaan_kartu_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penggunaan_kartu_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penggunaan_kartu_list->isExport()) { ?>
<script>
var fpenggunaan_kartulist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenggunaan_kartulist = currentForm = new ew.Form("fpenggunaan_kartulist", "list");
	fpenggunaan_kartulist.formKeyCountName = '<?php echo $penggunaan_kartu_list->FormKeyCountName ?>';
	loadjs.done("fpenggunaan_kartulist");
});
var fpenggunaan_kartulistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenggunaan_kartulistsrch = currentSearchForm = new ew.Form("fpenggunaan_kartulistsrch");

	// Dynamic selection lists
	// Filters

	fpenggunaan_kartulistsrch.filterList = <?php echo $penggunaan_kartu_list->getFilterList() ?>;
	loadjs.done("fpenggunaan_kartulistsrch");
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
<?php if (!$penggunaan_kartu_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penggunaan_kartu_list->TotalRecords > 0 && $penggunaan_kartu_list->ExportOptions->visible()) { ?>
<?php $penggunaan_kartu_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->ImportOptions->visible()) { ?>
<?php $penggunaan_kartu_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->SearchOptions->visible()) { ?>
<?php $penggunaan_kartu_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->FilterOptions->visible()) { ?>
<?php $penggunaan_kartu_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penggunaan_kartu_list->renderOtherOptions();
?>
<?php $penggunaan_kartu_list->showPageHeader(); ?>
<?php
$penggunaan_kartu_list->showMessage();
?>
<?php if ($penggunaan_kartu_list->TotalRecords > 0 || $penggunaan_kartu->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penggunaan_kartu_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penggunaan_kartu">
<?php if (!$penggunaan_kartu_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$penggunaan_kartu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penggunaan_kartu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penggunaan_kartu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpenggunaan_kartulist" id="fpenggunaan_kartulist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penggunaan_kartu">
<div id="gmp_penggunaan_kartu" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penggunaan_kartu_list->TotalRecords > 0 || $penggunaan_kartu_list->isGridEdit()) { ?>
<table id="tbl_penggunaan_kartulist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penggunaan_kartu->RowType = ROWTYPE_HEADER;

// Render list options
$penggunaan_kartu_list->renderListOptions();

// Render list options (header, left)
$penggunaan_kartu_list->ListOptions->render("header", "left");
?>
<?php if ($penggunaan_kartu_list->kode_penjualan->Visible) { // kode_penjualan ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->kode_penjualan) == "") { ?>
		<th data-name="kode_penjualan" class="<?php echo $penggunaan_kartu_list->kode_penjualan->headerCellClass() ?>"><div id="elh_penggunaan_kartu_kode_penjualan" class="penggunaan_kartu_kode_penjualan"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->kode_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penjualan" class="<?php echo $penggunaan_kartu_list->kode_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->kode_penjualan) ?>', 1);"><div id="elh_penggunaan_kartu_kode_penjualan" class="penggunaan_kartu_kode_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->kode_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->kode_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->kode_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->tgl->Visible) { // tgl ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $penggunaan_kartu_list->tgl->headerCellClass() ?>"><div id="elh_penggunaan_kartu_tgl" class="penggunaan_kartu_tgl"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $penggunaan_kartu_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->tgl) ?>', 1);"><div id="elh_penggunaan_kartu_tgl" class="penggunaan_kartu_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->id_kartu->Visible) { // id_kartu ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->id_kartu) == "") { ?>
		<th data-name="id_kartu" class="<?php echo $penggunaan_kartu_list->id_kartu->headerCellClass() ?>"><div id="elh_penggunaan_kartu_id_kartu" class="penggunaan_kartu_id_kartu"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->id_kartu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kartu" class="<?php echo $penggunaan_kartu_list->id_kartu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->id_kartu) ?>', 1);"><div id="elh_penggunaan_kartu_id_kartu" class="penggunaan_kartu_id_kartu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->id_kartu->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->id_kartu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->id_kartu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $penggunaan_kartu_list->id_klinik->headerCellClass() ?>"><div id="elh_penggunaan_kartu_id_klinik" class="penggunaan_kartu_id_klinik"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $penggunaan_kartu_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->id_klinik) ?>', 1);"><div id="elh_penggunaan_kartu_id_klinik" class="penggunaan_kartu_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->total->Visible) { // total ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $penggunaan_kartu_list->total->headerCellClass() ?>"><div id="elh_penggunaan_kartu_total" class="penggunaan_kartu_total"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $penggunaan_kartu_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->total) ?>', 1);"><div id="elh_penggunaan_kartu_total" class="penggunaan_kartu_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->charge->Visible) { // charge ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->charge) == "") { ?>
		<th data-name="charge" class="<?php echo $penggunaan_kartu_list->charge->headerCellClass() ?>"><div id="elh_penggunaan_kartu_charge" class="penggunaan_kartu_charge"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->charge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="charge" class="<?php echo $penggunaan_kartu_list->charge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->charge) ?>', 1);"><div id="elh_penggunaan_kartu_charge" class="penggunaan_kartu_charge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->charge->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->charge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->charge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penggunaan_kartu_list->total_charge->Visible) { // total_charge ?>
	<?php if ($penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->total_charge) == "") { ?>
		<th data-name="total_charge" class="<?php echo $penggunaan_kartu_list->total_charge->headerCellClass() ?>"><div id="elh_penggunaan_kartu_total_charge" class="penggunaan_kartu_total_charge"><div class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->total_charge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_charge" class="<?php echo $penggunaan_kartu_list->total_charge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penggunaan_kartu_list->SortUrl($penggunaan_kartu_list->total_charge) ?>', 1);"><div id="elh_penggunaan_kartu_total_charge" class="penggunaan_kartu_total_charge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penggunaan_kartu_list->total_charge->caption() ?></span><span class="ew-table-header-sort"><?php if ($penggunaan_kartu_list->total_charge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penggunaan_kartu_list->total_charge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penggunaan_kartu_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penggunaan_kartu_list->ExportAll && $penggunaan_kartu_list->isExport()) {
	$penggunaan_kartu_list->StopRecord = $penggunaan_kartu_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penggunaan_kartu_list->TotalRecords > $penggunaan_kartu_list->StartRecord + $penggunaan_kartu_list->DisplayRecords - 1)
		$penggunaan_kartu_list->StopRecord = $penggunaan_kartu_list->StartRecord + $penggunaan_kartu_list->DisplayRecords - 1;
	else
		$penggunaan_kartu_list->StopRecord = $penggunaan_kartu_list->TotalRecords;
}
$penggunaan_kartu_list->RecordCount = $penggunaan_kartu_list->StartRecord - 1;
if ($penggunaan_kartu_list->Recordset && !$penggunaan_kartu_list->Recordset->EOF) {
	$penggunaan_kartu_list->Recordset->moveFirst();
	$selectLimit = $penggunaan_kartu_list->UseSelectLimit;
	if (!$selectLimit && $penggunaan_kartu_list->StartRecord > 1)
		$penggunaan_kartu_list->Recordset->move($penggunaan_kartu_list->StartRecord - 1);
} elseif (!$penggunaan_kartu->AllowAddDeleteRow && $penggunaan_kartu_list->StopRecord == 0) {
	$penggunaan_kartu_list->StopRecord = $penggunaan_kartu->GridAddRowCount;
}

// Initialize aggregate
$penggunaan_kartu->RowType = ROWTYPE_AGGREGATEINIT;
$penggunaan_kartu->resetAttributes();
$penggunaan_kartu_list->renderRow();
while ($penggunaan_kartu_list->RecordCount < $penggunaan_kartu_list->StopRecord) {
	$penggunaan_kartu_list->RecordCount++;
	if ($penggunaan_kartu_list->RecordCount >= $penggunaan_kartu_list->StartRecord) {
		$penggunaan_kartu_list->RowCount++;

		// Set up key count
		$penggunaan_kartu_list->KeyCount = $penggunaan_kartu_list->RowIndex;

		// Init row class and style
		$penggunaan_kartu->resetAttributes();
		$penggunaan_kartu->CssClass = "";
		if ($penggunaan_kartu_list->isGridAdd()) {
		} else {
			$penggunaan_kartu_list->loadRowValues($penggunaan_kartu_list->Recordset); // Load row values
		}
		$penggunaan_kartu->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penggunaan_kartu->RowAttrs->merge(["data-rowindex" => $penggunaan_kartu_list->RowCount, "id" => "r" . $penggunaan_kartu_list->RowCount . "_penggunaan_kartu", "data-rowtype" => $penggunaan_kartu->RowType]);

		// Render row
		$penggunaan_kartu_list->renderRow();

		// Render list options
		$penggunaan_kartu_list->renderListOptions();
?>
	<tr <?php echo $penggunaan_kartu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penggunaan_kartu_list->ListOptions->render("body", "left", $penggunaan_kartu_list->RowCount);
?>
	<?php if ($penggunaan_kartu_list->kode_penjualan->Visible) { // kode_penjualan ?>
		<td data-name="kode_penjualan" <?php echo $penggunaan_kartu_list->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_kode_penjualan">
<span<?php echo $penggunaan_kartu_list->kode_penjualan->viewAttributes() ?>><?php echo $penggunaan_kartu_list->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penggunaan_kartu_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $penggunaan_kartu_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_tgl">
<span<?php echo $penggunaan_kartu_list->tgl->viewAttributes() ?>><?php echo $penggunaan_kartu_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penggunaan_kartu_list->id_kartu->Visible) { // id_kartu ?>
		<td data-name="id_kartu" <?php echo $penggunaan_kartu_list->id_kartu->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_id_kartu">
<span<?php echo $penggunaan_kartu_list->id_kartu->viewAttributes() ?>><?php echo $penggunaan_kartu_list->id_kartu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penggunaan_kartu_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $penggunaan_kartu_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_id_klinik">
<span<?php echo $penggunaan_kartu_list->id_klinik->viewAttributes() ?>><?php echo $penggunaan_kartu_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penggunaan_kartu_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $penggunaan_kartu_list->total->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_total">
<span<?php echo $penggunaan_kartu_list->total->viewAttributes() ?>><?php echo $penggunaan_kartu_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penggunaan_kartu_list->charge->Visible) { // charge ?>
		<td data-name="charge" <?php echo $penggunaan_kartu_list->charge->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_charge">
<span<?php echo $penggunaan_kartu_list->charge->viewAttributes() ?>><?php echo $penggunaan_kartu_list->charge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penggunaan_kartu_list->total_charge->Visible) { // total_charge ?>
		<td data-name="total_charge" <?php echo $penggunaan_kartu_list->total_charge->cellAttributes() ?>>
<span id="el<?php echo $penggunaan_kartu_list->RowCount ?>_penggunaan_kartu_total_charge">
<span<?php echo $penggunaan_kartu_list->total_charge->viewAttributes() ?>><?php echo $penggunaan_kartu_list->total_charge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penggunaan_kartu_list->ListOptions->render("body", "right", $penggunaan_kartu_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penggunaan_kartu_list->isGridAdd())
		$penggunaan_kartu_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penggunaan_kartu->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penggunaan_kartu_list->Recordset)
	$penggunaan_kartu_list->Recordset->Close();
?>
<?php if (!$penggunaan_kartu_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penggunaan_kartu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penggunaan_kartu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penggunaan_kartu_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penggunaan_kartu_list->TotalRecords == 0 && !$penggunaan_kartu->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penggunaan_kartu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penggunaan_kartu_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penggunaan_kartu_list->isExport()) { ?>
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
$penggunaan_kartu_list->terminate();
?>