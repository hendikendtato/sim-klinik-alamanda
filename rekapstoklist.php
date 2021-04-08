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
$rekapstok_list = new rekapstok_list();

// Run the page
$rekapstok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekapstok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekapstok_list->isExport()) { ?>
<script>
var frekapstoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frekapstoklist = currentForm = new ew.Form("frekapstoklist", "list");
	frekapstoklist.formKeyCountName = '<?php echo $rekapstok_list->FormKeyCountName ?>';
	loadjs.done("frekapstoklist");
});
var frekapstoklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frekapstoklistsrch = currentSearchForm = new ew.Form("frekapstoklistsrch");

	// Dynamic selection lists
	// Filters

	frekapstoklistsrch.filterList = <?php echo $rekapstok_list->getFilterList() ?>;
	loadjs.done("frekapstoklistsrch");
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
<?php if (!$rekapstok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($rekapstok_list->TotalRecords > 0 && $rekapstok_list->ExportOptions->visible()) { ?>
<?php $rekapstok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($rekapstok_list->ImportOptions->visible()) { ?>
<?php $rekapstok_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($rekapstok_list->SearchOptions->visible()) { ?>
<?php $rekapstok_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($rekapstok_list->FilterOptions->visible()) { ?>
<?php $rekapstok_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$rekapstok_list->renderOtherOptions();
?>
<?php $rekapstok_list->showPageHeader(); ?>
<?php
$rekapstok_list->showMessage();
?>
<?php if ($rekapstok_list->TotalRecords > 0 || $rekapstok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($rekapstok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> rekapstok">
<?php if (!$rekapstok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$rekapstok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekapstok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rekapstok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frekapstoklist" id="frekapstoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekapstok">
<div id="gmp_rekapstok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($rekapstok_list->TotalRecords > 0 || $rekapstok_list->isGridEdit()) { ?>
<table id="tbl_rekapstoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$rekapstok->RowType = ROWTYPE_HEADER;

// Render list options
$rekapstok_list->renderListOptions();

// Render list options (header, left)
$rekapstok_list->ListOptions->render("header", "left");
?>
<?php if ($rekapstok_list->id_rekapstok->Visible) { // id_rekapstok ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->id_rekapstok) == "") { ?>
		<th data-name="id_rekapstok" class="<?php echo $rekapstok_list->id_rekapstok->headerCellClass() ?>"><div id="elh_rekapstok_id_rekapstok" class="rekapstok_id_rekapstok"><div class="ew-table-header-caption"><?php echo $rekapstok_list->id_rekapstok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_rekapstok" class="<?php echo $rekapstok_list->id_rekapstok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->id_rekapstok) ?>', 1);"><div id="elh_rekapstok_id_rekapstok" class="rekapstok_id_rekapstok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->id_rekapstok->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->id_rekapstok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->id_rekapstok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->id_barang->Visible) { // id_barang ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $rekapstok_list->id_barang->headerCellClass() ?>"><div id="elh_rekapstok_id_barang" class="rekapstok_id_barang"><div class="ew-table-header-caption"><?php echo $rekapstok_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $rekapstok_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->id_barang) ?>', 1);"><div id="elh_rekapstok_id_barang" class="rekapstok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->tanggal->Visible) { // tanggal ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $rekapstok_list->tanggal->headerCellClass() ?>"><div id="elh_rekapstok_tanggal" class="rekapstok_tanggal"><div class="ew-table-header-caption"><?php echo $rekapstok_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $rekapstok_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->tanggal) ?>', 1);"><div id="elh_rekapstok_tanggal" class="rekapstok_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->masuk_saldoawal) == "") { ?>
		<th data-name="masuk_saldoawal" class="<?php echo $rekapstok_list->masuk_saldoawal->headerCellClass() ?>"><div id="elh_rekapstok_masuk_saldoawal" class="rekapstok_masuk_saldoawal"><div class="ew-table-header-caption"><?php echo $rekapstok_list->masuk_saldoawal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk_saldoawal" class="<?php echo $rekapstok_list->masuk_saldoawal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->masuk_saldoawal) ?>', 1);"><div id="elh_rekapstok_masuk_saldoawal" class="rekapstok_masuk_saldoawal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->masuk_saldoawal->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->masuk_saldoawal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->masuk_saldoawal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->masuk_beli->Visible) { // masuk_beli ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->masuk_beli) == "") { ?>
		<th data-name="masuk_beli" class="<?php echo $rekapstok_list->masuk_beli->headerCellClass() ?>"><div id="elh_rekapstok_masuk_beli" class="rekapstok_masuk_beli"><div class="ew-table-header-caption"><?php echo $rekapstok_list->masuk_beli->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk_beli" class="<?php echo $rekapstok_list->masuk_beli->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->masuk_beli) ?>', 1);"><div id="elh_rekapstok_masuk_beli" class="rekapstok_masuk_beli">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->masuk_beli->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->masuk_beli->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->masuk_beli->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->masuk_penyesuaian) == "") { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $rekapstok_list->masuk_penyesuaian->headerCellClass() ?>"><div id="elh_rekapstok_masuk_penyesuaian" class="rekapstok_masuk_penyesuaian"><div class="ew-table-header-caption"><?php echo $rekapstok_list->masuk_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $rekapstok_list->masuk_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->masuk_penyesuaian) ?>', 1);"><div id="elh_rekapstok_masuk_penyesuaian" class="rekapstok_masuk_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->masuk_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->masuk_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->masuk_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->keluar_jual->Visible) { // keluar_jual ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->keluar_jual) == "") { ?>
		<th data-name="keluar_jual" class="<?php echo $rekapstok_list->keluar_jual->headerCellClass() ?>"><div id="elh_rekapstok_keluar_jual" class="rekapstok_keluar_jual"><div class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_jual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_jual" class="<?php echo $rekapstok_list->keluar_jual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->keluar_jual) ?>', 1);"><div id="elh_rekapstok_keluar_jual" class="rekapstok_keluar_jual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_jual->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->keluar_jual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->keluar_jual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->keluar_perpindahan) == "") { ?>
		<th data-name="keluar_perpindahan" class="<?php echo $rekapstok_list->keluar_perpindahan->headerCellClass() ?>"><div id="elh_rekapstok_keluar_perpindahan" class="rekapstok_keluar_perpindahan"><div class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_perpindahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_perpindahan" class="<?php echo $rekapstok_list->keluar_perpindahan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->keluar_perpindahan) ?>', 1);"><div id="elh_rekapstok_keluar_perpindahan" class="rekapstok_keluar_perpindahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_perpindahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->keluar_perpindahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->keluar_perpindahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->keluar_penyesuaian) == "") { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $rekapstok_list->keluar_penyesuaian->headerCellClass() ?>"><div id="elh_rekapstok_keluar_penyesuaian" class="rekapstok_keluar_penyesuaian"><div class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $rekapstok_list->keluar_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->keluar_penyesuaian) ?>', 1);"><div id="elh_rekapstok_keluar_penyesuaian" class="rekapstok_keluar_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->keluar_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->keluar_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->keluar_pengembalian) == "") { ?>
		<th data-name="keluar_pengembalian" class="<?php echo $rekapstok_list->keluar_pengembalian->headerCellClass() ?>"><div id="elh_rekapstok_keluar_pengembalian" class="rekapstok_keluar_pengembalian"><div class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_pengembalian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_pengembalian" class="<?php echo $rekapstok_list->keluar_pengembalian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->keluar_pengembalian) ?>', 1);"><div id="elh_rekapstok_keluar_pengembalian" class="rekapstok_keluar_pengembalian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->keluar_pengembalian->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->keluar_pengembalian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->keluar_pengembalian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($rekapstok_list->stok->Visible) { // stok ?>
	<?php if ($rekapstok_list->SortUrl($rekapstok_list->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $rekapstok_list->stok->headerCellClass() ?>"><div id="elh_rekapstok_stok" class="rekapstok_stok"><div class="ew-table-header-caption"><?php echo $rekapstok_list->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $rekapstok_list->stok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $rekapstok_list->SortUrl($rekapstok_list->stok) ?>', 1);"><div id="elh_rekapstok_stok" class="rekapstok_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $rekapstok_list->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($rekapstok_list->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($rekapstok_list->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$rekapstok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($rekapstok_list->ExportAll && $rekapstok_list->isExport()) {
	$rekapstok_list->StopRecord = $rekapstok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($rekapstok_list->TotalRecords > $rekapstok_list->StartRecord + $rekapstok_list->DisplayRecords - 1)
		$rekapstok_list->StopRecord = $rekapstok_list->StartRecord + $rekapstok_list->DisplayRecords - 1;
	else
		$rekapstok_list->StopRecord = $rekapstok_list->TotalRecords;
}
$rekapstok_list->RecordCount = $rekapstok_list->StartRecord - 1;
if ($rekapstok_list->Recordset && !$rekapstok_list->Recordset->EOF) {
	$rekapstok_list->Recordset->moveFirst();
	$selectLimit = $rekapstok_list->UseSelectLimit;
	if (!$selectLimit && $rekapstok_list->StartRecord > 1)
		$rekapstok_list->Recordset->move($rekapstok_list->StartRecord - 1);
} elseif (!$rekapstok->AllowAddDeleteRow && $rekapstok_list->StopRecord == 0) {
	$rekapstok_list->StopRecord = $rekapstok->GridAddRowCount;
}

// Initialize aggregate
$rekapstok->RowType = ROWTYPE_AGGREGATEINIT;
$rekapstok->resetAttributes();
$rekapstok_list->renderRow();
while ($rekapstok_list->RecordCount < $rekapstok_list->StopRecord) {
	$rekapstok_list->RecordCount++;
	if ($rekapstok_list->RecordCount >= $rekapstok_list->StartRecord) {
		$rekapstok_list->RowCount++;

		// Set up key count
		$rekapstok_list->KeyCount = $rekapstok_list->RowIndex;

		// Init row class and style
		$rekapstok->resetAttributes();
		$rekapstok->CssClass = "";
		if ($rekapstok_list->isGridAdd()) {
		} else {
			$rekapstok_list->loadRowValues($rekapstok_list->Recordset); // Load row values
		}
		$rekapstok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$rekapstok->RowAttrs->merge(["data-rowindex" => $rekapstok_list->RowCount, "id" => "r" . $rekapstok_list->RowCount . "_rekapstok", "data-rowtype" => $rekapstok->RowType]);

		// Render row
		$rekapstok_list->renderRow();

		// Render list options
		$rekapstok_list->renderListOptions();
?>
	<tr <?php echo $rekapstok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$rekapstok_list->ListOptions->render("body", "left", $rekapstok_list->RowCount);
?>
	<?php if ($rekapstok_list->id_rekapstok->Visible) { // id_rekapstok ?>
		<td data-name="id_rekapstok" <?php echo $rekapstok_list->id_rekapstok->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_id_rekapstok">
<span<?php echo $rekapstok_list->id_rekapstok->viewAttributes() ?>><?php echo $rekapstok_list->id_rekapstok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $rekapstok_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_id_barang">
<span<?php echo $rekapstok_list->id_barang->viewAttributes() ?>><?php echo $rekapstok_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $rekapstok_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_tanggal">
<span<?php echo $rekapstok_list->tanggal->viewAttributes() ?>><?php echo $rekapstok_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
		<td data-name="masuk_saldoawal" <?php echo $rekapstok_list->masuk_saldoawal->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_masuk_saldoawal">
<span<?php echo $rekapstok_list->masuk_saldoawal->viewAttributes() ?>><?php echo $rekapstok_list->masuk_saldoawal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->masuk_beli->Visible) { // masuk_beli ?>
		<td data-name="masuk_beli" <?php echo $rekapstok_list->masuk_beli->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_masuk_beli">
<span<?php echo $rekapstok_list->masuk_beli->viewAttributes() ?>><?php echo $rekapstok_list->masuk_beli->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td data-name="masuk_penyesuaian" <?php echo $rekapstok_list->masuk_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_masuk_penyesuaian">
<span<?php echo $rekapstok_list->masuk_penyesuaian->viewAttributes() ?>><?php echo $rekapstok_list->masuk_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->keluar_jual->Visible) { // keluar_jual ?>
		<td data-name="keluar_jual" <?php echo $rekapstok_list->keluar_jual->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_keluar_jual">
<span<?php echo $rekapstok_list->keluar_jual->viewAttributes() ?>><?php echo $rekapstok_list->keluar_jual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
		<td data-name="keluar_perpindahan" <?php echo $rekapstok_list->keluar_perpindahan->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_keluar_perpindahan">
<span<?php echo $rekapstok_list->keluar_perpindahan->viewAttributes() ?>><?php echo $rekapstok_list->keluar_perpindahan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td data-name="keluar_penyesuaian" <?php echo $rekapstok_list->keluar_penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_keluar_penyesuaian">
<span<?php echo $rekapstok_list->keluar_penyesuaian->viewAttributes() ?>><?php echo $rekapstok_list->keluar_penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
		<td data-name="keluar_pengembalian" <?php echo $rekapstok_list->keluar_pengembalian->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_keluar_pengembalian">
<span<?php echo $rekapstok_list->keluar_pengembalian->viewAttributes() ?>><?php echo $rekapstok_list->keluar_pengembalian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($rekapstok_list->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $rekapstok_list->stok->cellAttributes() ?>>
<span id="el<?php echo $rekapstok_list->RowCount ?>_rekapstok_stok">
<span<?php echo $rekapstok_list->stok->viewAttributes() ?>><?php echo $rekapstok_list->stok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$rekapstok_list->ListOptions->render("body", "right", $rekapstok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$rekapstok_list->isGridAdd())
		$rekapstok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$rekapstok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($rekapstok_list->Recordset)
	$rekapstok_list->Recordset->Close();
?>
<?php if (!$rekapstok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$rekapstok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $rekapstok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $rekapstok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($rekapstok_list->TotalRecords == 0 && !$rekapstok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $rekapstok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$rekapstok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekapstok_list->isExport()) { ?>
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
$rekapstok_list->terminate();
?>