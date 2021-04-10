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
$laporan_kas_list = new laporan_kas_list();

// Run the page
$laporan_kas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_kas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$laporan_kas_list->isExport()) { ?>
<script>
var flaporan_kaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flaporan_kaslist = currentForm = new ew.Form("flaporan_kaslist", "list");
	flaporan_kaslist.formKeyCountName = '<?php echo $laporan_kas_list->FormKeyCountName ?>';
	loadjs.done("flaporan_kaslist");
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
<?php if (!$laporan_kas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($laporan_kas_list->TotalRecords > 0 && $laporan_kas_list->ExportOptions->visible()) { ?>
<?php $laporan_kas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($laporan_kas_list->ImportOptions->visible()) { ?>
<?php $laporan_kas_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$laporan_kas_list->renderOtherOptions();
?>
<?php $laporan_kas_list->showPageHeader(); ?>
<?php
$laporan_kas_list->showMessage();
?>
<?php if ($laporan_kas_list->TotalRecords > 0 || $laporan_kas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($laporan_kas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> laporan_kas">
<?php if (!$laporan_kas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$laporan_kas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $laporan_kas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $laporan_kas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flaporan_kaslist" id="flaporan_kaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_kas">
<div id="gmp_laporan_kas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($laporan_kas_list->TotalRecords > 0 || $laporan_kas_list->isGridEdit()) { ?>
<table id="tbl_laporan_kaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$laporan_kas->RowType = ROWTYPE_HEADER;

// Render list options
$laporan_kas_list->renderListOptions();

// Render list options (header, left)
$laporan_kas_list->ListOptions->render("header", "left");
?>
<?php if ($laporan_kas_list->id->Visible) { // id ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $laporan_kas_list->id->headerCellClass() ?>"><div id="elh_laporan_kas_id" class="laporan_kas_id"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $laporan_kas_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->id) ?>', 1);"><div id="elh_laporan_kas_id" class="laporan_kas_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $laporan_kas_list->id_klinik->headerCellClass() ?>"><div id="elh_laporan_kas_id_klinik" class="laporan_kas_id_klinik"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $laporan_kas_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->id_klinik) ?>', 1);"><div id="elh_laporan_kas_id_klinik" class="laporan_kas_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->id_kas->Visible) { // id_kas ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->id_kas) == "") { ?>
		<th data-name="id_kas" class="<?php echo $laporan_kas_list->id_kas->headerCellClass() ?>"><div id="elh_laporan_kas_id_kas" class="laporan_kas_id_kas"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->id_kas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kas" class="<?php echo $laporan_kas_list->id_kas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->id_kas) ?>', 1);"><div id="elh_laporan_kas_id_kas" class="laporan_kas_id_kas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->id_kas->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->id_kas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->id_kas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->jumlah->Visible) { // jumlah ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $laporan_kas_list->jumlah->headerCellClass() ?>"><div id="elh_laporan_kas_jumlah" class="laporan_kas_jumlah"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $laporan_kas_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->jumlah) ?>', 1);"><div id="elh_laporan_kas_jumlah" class="laporan_kas_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->tanggal->Visible) { // tanggal ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $laporan_kas_list->tanggal->headerCellClass() ?>"><div id="elh_laporan_kas_tanggal" class="laporan_kas_tanggal"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $laporan_kas_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->tanggal) ?>', 1);"><div id="elh_laporan_kas_tanggal" class="laporan_kas_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->id_mutasi_kas) == "") { ?>
		<th data-name="id_mutasi_kas" class="<?php echo $laporan_kas_list->id_mutasi_kas->headerCellClass() ?>"><div id="elh_laporan_kas_id_mutasi_kas" class="laporan_kas_id_mutasi_kas"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->id_mutasi_kas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_mutasi_kas" class="<?php echo $laporan_kas_list->id_mutasi_kas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->id_mutasi_kas) ?>', 1);"><div id="elh_laporan_kas_id_mutasi_kas" class="laporan_kas_id_mutasi_kas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->id_mutasi_kas->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->id_mutasi_kas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->id_mutasi_kas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->saldo_awal->Visible) { // saldo_awal ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->saldo_awal) == "") { ?>
		<th data-name="saldo_awal" class="<?php echo $laporan_kas_list->saldo_awal->headerCellClass() ?>"><div id="elh_laporan_kas_saldo_awal" class="laporan_kas_saldo_awal"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->saldo_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="saldo_awal" class="<?php echo $laporan_kas_list->saldo_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->saldo_awal) ?>', 1);"><div id="elh_laporan_kas_saldo_awal" class="laporan_kas_saldo_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->saldo_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->saldo_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->saldo_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_kas_list->sisa_saldo->Visible) { // sisa_saldo ?>
	<?php if ($laporan_kas_list->SortUrl($laporan_kas_list->sisa_saldo) == "") { ?>
		<th data-name="sisa_saldo" class="<?php echo $laporan_kas_list->sisa_saldo->headerCellClass() ?>"><div id="elh_laporan_kas_sisa_saldo" class="laporan_kas_sisa_saldo"><div class="ew-table-header-caption"><?php echo $laporan_kas_list->sisa_saldo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sisa_saldo" class="<?php echo $laporan_kas_list->sisa_saldo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_kas_list->SortUrl($laporan_kas_list->sisa_saldo) ?>', 1);"><div id="elh_laporan_kas_sisa_saldo" class="laporan_kas_sisa_saldo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_kas_list->sisa_saldo->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_kas_list->sisa_saldo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_kas_list->sisa_saldo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$laporan_kas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($laporan_kas_list->ExportAll && $laporan_kas_list->isExport()) {
	$laporan_kas_list->StopRecord = $laporan_kas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($laporan_kas_list->TotalRecords > $laporan_kas_list->StartRecord + $laporan_kas_list->DisplayRecords - 1)
		$laporan_kas_list->StopRecord = $laporan_kas_list->StartRecord + $laporan_kas_list->DisplayRecords - 1;
	else
		$laporan_kas_list->StopRecord = $laporan_kas_list->TotalRecords;
}
$laporan_kas_list->RecordCount = $laporan_kas_list->StartRecord - 1;
if ($laporan_kas_list->Recordset && !$laporan_kas_list->Recordset->EOF) {
	$laporan_kas_list->Recordset->moveFirst();
	$selectLimit = $laporan_kas_list->UseSelectLimit;
	if (!$selectLimit && $laporan_kas_list->StartRecord > 1)
		$laporan_kas_list->Recordset->move($laporan_kas_list->StartRecord - 1);
} elseif (!$laporan_kas->AllowAddDeleteRow && $laporan_kas_list->StopRecord == 0) {
	$laporan_kas_list->StopRecord = $laporan_kas->GridAddRowCount;
}

// Initialize aggregate
$laporan_kas->RowType = ROWTYPE_AGGREGATEINIT;
$laporan_kas->resetAttributes();
$laporan_kas_list->renderRow();
while ($laporan_kas_list->RecordCount < $laporan_kas_list->StopRecord) {
	$laporan_kas_list->RecordCount++;
	if ($laporan_kas_list->RecordCount >= $laporan_kas_list->StartRecord) {
		$laporan_kas_list->RowCount++;

		// Set up key count
		$laporan_kas_list->KeyCount = $laporan_kas_list->RowIndex;

		// Init row class and style
		$laporan_kas->resetAttributes();
		$laporan_kas->CssClass = "";
		if ($laporan_kas_list->isGridAdd()) {
		} else {
			$laporan_kas_list->loadRowValues($laporan_kas_list->Recordset); // Load row values
		}
		$laporan_kas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$laporan_kas->RowAttrs->merge(["data-rowindex" => $laporan_kas_list->RowCount, "id" => "r" . $laporan_kas_list->RowCount . "_laporan_kas", "data-rowtype" => $laporan_kas->RowType]);

		// Render row
		$laporan_kas_list->renderRow();

		// Render list options
		$laporan_kas_list->renderListOptions();
?>
	<tr <?php echo $laporan_kas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$laporan_kas_list->ListOptions->render("body", "left", $laporan_kas_list->RowCount);
?>
	<?php if ($laporan_kas_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $laporan_kas_list->id->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_id">
<span<?php echo $laporan_kas_list->id->viewAttributes() ?>><?php echo $laporan_kas_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $laporan_kas_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_id_klinik">
<span<?php echo $laporan_kas_list->id_klinik->viewAttributes() ?>><?php echo $laporan_kas_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->id_kas->Visible) { // id_kas ?>
		<td data-name="id_kas" <?php echo $laporan_kas_list->id_kas->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_id_kas">
<span<?php echo $laporan_kas_list->id_kas->viewAttributes() ?>><?php echo $laporan_kas_list->id_kas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $laporan_kas_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_jumlah">
<span<?php echo $laporan_kas_list->jumlah->viewAttributes() ?>><?php echo $laporan_kas_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $laporan_kas_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_tanggal">
<span<?php echo $laporan_kas_list->tanggal->viewAttributes() ?>><?php echo $laporan_kas_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
		<td data-name="id_mutasi_kas" <?php echo $laporan_kas_list->id_mutasi_kas->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_id_mutasi_kas">
<span<?php echo $laporan_kas_list->id_mutasi_kas->viewAttributes() ?>><?php echo $laporan_kas_list->id_mutasi_kas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->saldo_awal->Visible) { // saldo_awal ?>
		<td data-name="saldo_awal" <?php echo $laporan_kas_list->saldo_awal->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_saldo_awal">
<span<?php echo $laporan_kas_list->saldo_awal->viewAttributes() ?>><?php echo $laporan_kas_list->saldo_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_kas_list->sisa_saldo->Visible) { // sisa_saldo ?>
		<td data-name="sisa_saldo" <?php echo $laporan_kas_list->sisa_saldo->cellAttributes() ?>>
<span id="el<?php echo $laporan_kas_list->RowCount ?>_laporan_kas_sisa_saldo">
<span<?php echo $laporan_kas_list->sisa_saldo->viewAttributes() ?>><?php echo $laporan_kas_list->sisa_saldo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$laporan_kas_list->ListOptions->render("body", "right", $laporan_kas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$laporan_kas_list->isGridAdd())
		$laporan_kas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$laporan_kas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($laporan_kas_list->Recordset)
	$laporan_kas_list->Recordset->Close();
?>
<?php if (!$laporan_kas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$laporan_kas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $laporan_kas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $laporan_kas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($laporan_kas_list->TotalRecords == 0 && !$laporan_kas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $laporan_kas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$laporan_kas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$laporan_kas_list->isExport()) { ?>
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
$laporan_kas_list->terminate();
?>