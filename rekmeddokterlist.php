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
$rekmeddokter_list = new rekmeddokter_list();

// Run the page
$rekmeddokter_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekmeddokter_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekmeddokter_list->isExport()) { ?>
<script>
var frekmeddokterlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frekmeddokterlist = currentForm = new ew.Form("frekmeddokterlist", "list");
	frekmeddokterlist.formKeyCountName = '<?php echo $rekmeddokter_list->FormKeyCountName ?>';
	loadjs.done("frekmeddokterlist");
});
var frekmeddokterlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frekmeddokterlistsrch = currentSearchForm = new ew.Form("frekmeddokterlistsrch");

	// Dynamic selection lists
	// Filters

	frekmeddokterlistsrch.filterList = <?php echo $rekmeddokter_list->getFilterList() ?>;
	loadjs.done("frekmeddokterlistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","rekmeddokteradd.php?showdetail=detailrekmeddok,detailrekmedterapis,detailrekmedpenjualan"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$(".rekmeddokter_details").hide(),$("a.ew-row-link.ew-view").each(function(){var e=$(this).attr("href").split("=");$(this).attr("href",e[0]+"=detailrekmeddok,detailrekmedterapis,detailrekmedpenjualan"+e[1]+"="+e[2])}),$("a.ew-row-link.ew-edit").each(function(){var e=$(this).attr("href").split("=");$(this).attr("href",e[0]+"=detailrekmeddok,detailrekmedterapis,detailrekmedpenjualan"+e[1]+"="+e[2])}),$("a.ew-row-link.ew-copy").each(function(){var e=$(this).attr("href").split("=");$(this).attr("href",e[0]+"=detailrekmeddok,detailrekmedterapis,detailrekmedpenjualan"+e[1]+"="+e[2])});
});
</script>
<?php } ?>
<?php if (!$rekmeddokter_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rekmeddokter_list->TotalRecords > 0 && $rekmeddokter_list->ExportOptions->visible()) { ?>
<?php $rekmeddokter_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rekmeddokter_list->ImportOptions->visible()) { ?>
<?php $rekmeddokter_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rekmeddokter_list->SearchOptions->visible()) { ?>
<?php $rekmeddokter_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rekmeddokter_list->FilterOptions->visible()) { ?>
<?php $rekmeddokter_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$rekmeddokter_list->renderOtherOptions();
?>
<?php $rekmeddokter_list->showPageHeader(); ?>
<?php
$rekmeddokter_list->showMessage();
?>
<?php if ($rekmeddokter_list->TotalRecords > 0 || $rekmeddokter->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rekmeddokter_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rekmeddokter">
<?php if (!$rekmeddokter_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rekmeddokter_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekmeddokter_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rekmeddokter_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frekmeddokterlist" id="frekmeddokterlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekmeddokter">
<div id="gmp_rekmeddokter" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rekmeddokter_list->TotalRecords > 0 || $rekmeddokter_list->isGridEdit()) { ?>
<table id="tbl_rekmeddokterlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rekmeddokter->RowType = ROWTYPE_HEADER;

// Render list options
$rekmeddokter_list->renderListOptions();

// Render list options (header, left)
$rekmeddokter_list->ListOptions->render("header", "left");
?>
<?php if ($rekmeddokter_list->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
	<?php if ($rekmeddokter_list->SortUrl($rekmeddokter_list->kode_rekmeddok) == "") { ?>
		<th data-name="kode_rekmeddok" class="<?php echo $rekmeddokter_list->kode_rekmeddok->headerCellClass() ?>"><div id="elh_rekmeddokter_kode_rekmeddok" class="rekmeddokter_kode_rekmeddok"><div class="ew-table-header-caption"><?php echo $rekmeddokter_list->kode_rekmeddok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_rekmeddok" class="<?php echo $rekmeddokter_list->kode_rekmeddok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekmeddokter_list->SortUrl($rekmeddokter_list->kode_rekmeddok) ?>', 1);"><div id="elh_rekmeddokter_kode_rekmeddok" class="rekmeddokter_kode_rekmeddok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekmeddokter_list->kode_rekmeddok->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekmeddokter_list->kode_rekmeddok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekmeddokter_list->kode_rekmeddok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekmeddokter_list->tanggal->Visible) { // tanggal ?>
	<?php if ($rekmeddokter_list->SortUrl($rekmeddokter_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $rekmeddokter_list->tanggal->headerCellClass() ?>"><div id="elh_rekmeddokter_tanggal" class="rekmeddokter_tanggal"><div class="ew-table-header-caption"><?php echo $rekmeddokter_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $rekmeddokter_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekmeddokter_list->SortUrl($rekmeddokter_list->tanggal) ?>', 1);"><div id="elh_rekmeddokter_tanggal" class="rekmeddokter_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekmeddokter_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekmeddokter_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekmeddokter_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekmeddokter_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($rekmeddokter_list->SortUrl($rekmeddokter_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $rekmeddokter_list->id_pelanggan->headerCellClass() ?>"><div id="elh_rekmeddokter_id_pelanggan" class="rekmeddokter_id_pelanggan"><div class="ew-table-header-caption"><?php echo $rekmeddokter_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $rekmeddokter_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekmeddokter_list->SortUrl($rekmeddokter_list->id_pelanggan) ?>', 1);"><div id="elh_rekmeddokter_id_pelanggan" class="rekmeddokter_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekmeddokter_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekmeddokter_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekmeddokter_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekmeddokter_list->id_dokter->Visible) { // id_dokter ?>
	<?php if ($rekmeddokter_list->SortUrl($rekmeddokter_list->id_dokter) == "") { ?>
		<th data-name="id_dokter" class="<?php echo $rekmeddokter_list->id_dokter->headerCellClass() ?>"><div id="elh_rekmeddokter_id_dokter" class="rekmeddokter_id_dokter"><div class="ew-table-header-caption"><?php echo $rekmeddokter_list->id_dokter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_dokter" class="<?php echo $rekmeddokter_list->id_dokter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekmeddokter_list->SortUrl($rekmeddokter_list->id_dokter) ?>', 1);"><div id="elh_rekmeddokter_id_dokter" class="rekmeddokter_id_dokter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekmeddokter_list->id_dokter->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekmeddokter_list->id_dokter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekmeddokter_list->id_dokter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekmeddokter_list->id_be->Visible) { // id_be ?>
	<?php if ($rekmeddokter_list->SortUrl($rekmeddokter_list->id_be) == "") { ?>
		<th data-name="id_be" class="<?php echo $rekmeddokter_list->id_be->headerCellClass() ?>"><div id="elh_rekmeddokter_id_be" class="rekmeddokter_id_be"><div class="ew-table-header-caption"><?php echo $rekmeddokter_list->id_be->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_be" class="<?php echo $rekmeddokter_list->id_be->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekmeddokter_list->SortUrl($rekmeddokter_list->id_be) ?>', 1);"><div id="elh_rekmeddokter_id_be" class="rekmeddokter_id_be">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekmeddokter_list->id_be->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekmeddokter_list->id_be->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekmeddokter_list->id_be->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rekmeddokter_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rekmeddokter_list->ExportAll && $rekmeddokter_list->isExport()) {
	$rekmeddokter_list->StopRecord = $rekmeddokter_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rekmeddokter_list->TotalRecords > $rekmeddokter_list->StartRecord + $rekmeddokter_list->DisplayRecords - 1)
		$rekmeddokter_list->StopRecord = $rekmeddokter_list->StartRecord + $rekmeddokter_list->DisplayRecords - 1;
	else
		$rekmeddokter_list->StopRecord = $rekmeddokter_list->TotalRecords;
}
$rekmeddokter_list->RecordCount = $rekmeddokter_list->StartRecord - 1;
if ($rekmeddokter_list->Recordset && !$rekmeddokter_list->Recordset->EOF) {
	$rekmeddokter_list->Recordset->moveFirst();
	$selectLimit = $rekmeddokter_list->UseSelectLimit;
	if (!$selectLimit && $rekmeddokter_list->StartRecord > 1)
		$rekmeddokter_list->Recordset->move($rekmeddokter_list->StartRecord - 1);
} elseif (!$rekmeddokter->AllowAddDeleteRow && $rekmeddokter_list->StopRecord == 0) {
	$rekmeddokter_list->StopRecord = $rekmeddokter->GridAddRowCount;
}

// Initialize aggregate
$rekmeddokter->RowType = ROWTYPE_AGGREGATEINIT;
$rekmeddokter->resetAttributes();
$rekmeddokter_list->renderRow();
while ($rekmeddokter_list->RecordCount < $rekmeddokter_list->StopRecord) {
	$rekmeddokter_list->RecordCount++;
	if ($rekmeddokter_list->RecordCount >= $rekmeddokter_list->StartRecord) {
		$rekmeddokter_list->RowCount++;

		// Set up key count
		$rekmeddokter_list->KeyCount = $rekmeddokter_list->RowIndex;

		// Init row class and style
		$rekmeddokter->resetAttributes();
		$rekmeddokter->CssClass = "";
		if ($rekmeddokter_list->isGridAdd()) {
		} else {
			$rekmeddokter_list->loadRowValues($rekmeddokter_list->Recordset); // Load row values
		}
		$rekmeddokter->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rekmeddokter->RowAttrs->merge(["data-rowindex" => $rekmeddokter_list->RowCount, "id" => "r" . $rekmeddokter_list->RowCount . "_rekmeddokter", "data-rowtype" => $rekmeddokter->RowType]);

		// Render row
		$rekmeddokter_list->renderRow();

		// Render list options
		$rekmeddokter_list->renderListOptions();
?>
	<tr <?php echo $rekmeddokter->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rekmeddokter_list->ListOptions->render("body", "left", $rekmeddokter_list->RowCount);
?>
	<?php if ($rekmeddokter_list->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
		<td data-name="kode_rekmeddok" <?php echo $rekmeddokter_list->kode_rekmeddok->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_list->RowCount ?>_rekmeddokter_kode_rekmeddok">
<span<?php echo $rekmeddokter_list->kode_rekmeddok->viewAttributes() ?>><?php echo $rekmeddokter_list->kode_rekmeddok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekmeddokter_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $rekmeddokter_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_list->RowCount ?>_rekmeddokter_tanggal">
<span<?php echo $rekmeddokter_list->tanggal->viewAttributes() ?>><?php echo $rekmeddokter_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekmeddokter_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $rekmeddokter_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_list->RowCount ?>_rekmeddokter_id_pelanggan">
<span<?php echo $rekmeddokter_list->id_pelanggan->viewAttributes() ?>><?php echo $rekmeddokter_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekmeddokter_list->id_dokter->Visible) { // id_dokter ?>
		<td data-name="id_dokter" <?php echo $rekmeddokter_list->id_dokter->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_list->RowCount ?>_rekmeddokter_id_dokter">
<span<?php echo $rekmeddokter_list->id_dokter->viewAttributes() ?>><?php echo $rekmeddokter_list->id_dokter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekmeddokter_list->id_be->Visible) { // id_be ?>
		<td data-name="id_be" <?php echo $rekmeddokter_list->id_be->cellAttributes() ?>>
<span id="el<?php echo $rekmeddokter_list->RowCount ?>_rekmeddokter_id_be">
<span<?php echo $rekmeddokter_list->id_be->viewAttributes() ?>><?php echo $rekmeddokter_list->id_be->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekmeddokter_list->ListOptions->render("body", "right", $rekmeddokter_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$rekmeddokter_list->isGridAdd())
		$rekmeddokter_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$rekmeddokter->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rekmeddokter_list->Recordset)
	$rekmeddokter_list->Recordset->Close();
?>
<?php if (!$rekmeddokter_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rekmeddokter_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekmeddokter_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rekmeddokter_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rekmeddokter_list->TotalRecords == 0 && !$rekmeddokter->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rekmeddokter_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rekmeddokter_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekmeddokter_list->isExport()) { ?>
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
$rekmeddokter_list->terminate();
?>