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
$laporan_rekening_list = new laporan_rekening_list();

// Run the page
$laporan_rekening_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_rekening_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$laporan_rekening_list->isExport()) { ?>
<script>
var flaporan_rekeninglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flaporan_rekeninglist = currentForm = new ew.Form("flaporan_rekeninglist", "list");
	flaporan_rekeninglist.formKeyCountName = '<?php echo $laporan_rekening_list->FormKeyCountName ?>';
	loadjs.done("flaporan_rekeninglist");
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
<?php if (!$laporan_rekening_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($laporan_rekening_list->TotalRecords > 0 && $laporan_rekening_list->ExportOptions->visible()) { ?>
<?php $laporan_rekening_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($laporan_rekening_list->ImportOptions->visible()) { ?>
<?php $laporan_rekening_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$laporan_rekening_list->renderOtherOptions();
?>
<?php $laporan_rekening_list->showPageHeader(); ?>
<?php
$laporan_rekening_list->showMessage();
?>
<?php if ($laporan_rekening_list->TotalRecords > 0 || $laporan_rekening->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($laporan_rekening_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> laporan_rekening">
<?php if (!$laporan_rekening_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$laporan_rekening_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $laporan_rekening_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $laporan_rekening_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flaporan_rekeninglist" id="flaporan_rekeninglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_rekening">
<div id="gmp_laporan_rekening" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($laporan_rekening_list->TotalRecords > 0 || $laporan_rekening_list->isGridEdit()) { ?>
<table id="tbl_laporan_rekeninglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$laporan_rekening->RowType = ROWTYPE_HEADER;

// Render list options
$laporan_rekening_list->renderListOptions();

// Render list options (header, left)
$laporan_rekening_list->ListOptions->render("header", "left");
?>
<?php if ($laporan_rekening_list->id->Visible) { // id ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $laporan_rekening_list->id->headerCellClass() ?>"><div id="elh_laporan_rekening_id" class="laporan_rekening_id"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $laporan_rekening_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->id) ?>', 1);"><div id="elh_laporan_rekening_id" class="laporan_rekening_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_rekening_list->id_rekening->Visible) { // id_rekening ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->id_rekening) == "") { ?>
		<th data-name="id_rekening" class="<?php echo $laporan_rekening_list->id_rekening->headerCellClass() ?>"><div id="elh_laporan_rekening_id_rekening" class="laporan_rekening_id_rekening"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->id_rekening->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_rekening" class="<?php echo $laporan_rekening_list->id_rekening->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->id_rekening) ?>', 1);"><div id="elh_laporan_rekening_id_rekening" class="laporan_rekening_id_rekening">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->id_rekening->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->id_rekening->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->id_rekening->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_rekening_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $laporan_rekening_list->id_klinik->headerCellClass() ?>"><div id="elh_laporan_rekening_id_klinik" class="laporan_rekening_id_klinik"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $laporan_rekening_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->id_klinik) ?>', 1);"><div id="elh_laporan_rekening_id_klinik" class="laporan_rekening_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_rekening_list->jumlah->Visible) { // jumlah ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $laporan_rekening_list->jumlah->headerCellClass() ?>"><div id="elh_laporan_rekening_jumlah" class="laporan_rekening_jumlah"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $laporan_rekening_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->jumlah) ?>', 1);"><div id="elh_laporan_rekening_jumlah" class="laporan_rekening_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_rekening_list->tanggal->Visible) { // tanggal ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $laporan_rekening_list->tanggal->headerCellClass() ?>"><div id="elh_laporan_rekening_tanggal" class="laporan_rekening_tanggal"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $laporan_rekening_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->tanggal) ?>', 1);"><div id="elh_laporan_rekening_tanggal" class="laporan_rekening_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_rekening_list->saldo_awal->Visible) { // saldo_awal ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->saldo_awal) == "") { ?>
		<th data-name="saldo_awal" class="<?php echo $laporan_rekening_list->saldo_awal->headerCellClass() ?>"><div id="elh_laporan_rekening_saldo_awal" class="laporan_rekening_saldo_awal"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->saldo_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="saldo_awal" class="<?php echo $laporan_rekening_list->saldo_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->saldo_awal) ?>', 1);"><div id="elh_laporan_rekening_saldo_awal" class="laporan_rekening_saldo_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->saldo_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->saldo_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->saldo_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($laporan_rekening_list->sisa_saldo->Visible) { // sisa_saldo ?>
	<?php if ($laporan_rekening_list->SortUrl($laporan_rekening_list->sisa_saldo) == "") { ?>
		<th data-name="sisa_saldo" class="<?php echo $laporan_rekening_list->sisa_saldo->headerCellClass() ?>"><div id="elh_laporan_rekening_sisa_saldo" class="laporan_rekening_sisa_saldo"><div class="ew-table-header-caption"><?php echo $laporan_rekening_list->sisa_saldo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sisa_saldo" class="<?php echo $laporan_rekening_list->sisa_saldo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $laporan_rekening_list->SortUrl($laporan_rekening_list->sisa_saldo) ?>', 1);"><div id="elh_laporan_rekening_sisa_saldo" class="laporan_rekening_sisa_saldo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $laporan_rekening_list->sisa_saldo->caption() ?></span><span class="ew-table-header-sort"><?php if ($laporan_rekening_list->sisa_saldo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($laporan_rekening_list->sisa_saldo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$laporan_rekening_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($laporan_rekening_list->ExportAll && $laporan_rekening_list->isExport()) {
	$laporan_rekening_list->StopRecord = $laporan_rekening_list->TotalRecords;
} else {

	// Set the last record to display
	if ($laporan_rekening_list->TotalRecords > $laporan_rekening_list->StartRecord + $laporan_rekening_list->DisplayRecords - 1)
		$laporan_rekening_list->StopRecord = $laporan_rekening_list->StartRecord + $laporan_rekening_list->DisplayRecords - 1;
	else
		$laporan_rekening_list->StopRecord = $laporan_rekening_list->TotalRecords;
}
$laporan_rekening_list->RecordCount = $laporan_rekening_list->StartRecord - 1;
if ($laporan_rekening_list->Recordset && !$laporan_rekening_list->Recordset->EOF) {
	$laporan_rekening_list->Recordset->moveFirst();
	$selectLimit = $laporan_rekening_list->UseSelectLimit;
	if (!$selectLimit && $laporan_rekening_list->StartRecord > 1)
		$laporan_rekening_list->Recordset->move($laporan_rekening_list->StartRecord - 1);
} elseif (!$laporan_rekening->AllowAddDeleteRow && $laporan_rekening_list->StopRecord == 0) {
	$laporan_rekening_list->StopRecord = $laporan_rekening->GridAddRowCount;
}

// Initialize aggregate
$laporan_rekening->RowType = ROWTYPE_AGGREGATEINIT;
$laporan_rekening->resetAttributes();
$laporan_rekening_list->renderRow();
while ($laporan_rekening_list->RecordCount < $laporan_rekening_list->StopRecord) {
	$laporan_rekening_list->RecordCount++;
	if ($laporan_rekening_list->RecordCount >= $laporan_rekening_list->StartRecord) {
		$laporan_rekening_list->RowCount++;

		// Set up key count
		$laporan_rekening_list->KeyCount = $laporan_rekening_list->RowIndex;

		// Init row class and style
		$laporan_rekening->resetAttributes();
		$laporan_rekening->CssClass = "";
		if ($laporan_rekening_list->isGridAdd()) {
		} else {
			$laporan_rekening_list->loadRowValues($laporan_rekening_list->Recordset); // Load row values
		}
		$laporan_rekening->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$laporan_rekening->RowAttrs->merge(["data-rowindex" => $laporan_rekening_list->RowCount, "id" => "r" . $laporan_rekening_list->RowCount . "_laporan_rekening", "data-rowtype" => $laporan_rekening->RowType]);

		// Render row
		$laporan_rekening_list->renderRow();

		// Render list options
		$laporan_rekening_list->renderListOptions();
?>
	<tr <?php echo $laporan_rekening->rowAttributes() ?>>
<?php

// Render list options (body, left)
$laporan_rekening_list->ListOptions->render("body", "left", $laporan_rekening_list->RowCount);
?>
	<?php if ($laporan_rekening_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $laporan_rekening_list->id->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_id">
<span<?php echo $laporan_rekening_list->id->viewAttributes() ?>><?php echo $laporan_rekening_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_rekening_list->id_rekening->Visible) { // id_rekening ?>
		<td data-name="id_rekening" <?php echo $laporan_rekening_list->id_rekening->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_id_rekening">
<span<?php echo $laporan_rekening_list->id_rekening->viewAttributes() ?>><?php echo $laporan_rekening_list->id_rekening->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_rekening_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $laporan_rekening_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_id_klinik">
<span<?php echo $laporan_rekening_list->id_klinik->viewAttributes() ?>><?php echo $laporan_rekening_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_rekening_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $laporan_rekening_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_jumlah">
<span<?php echo $laporan_rekening_list->jumlah->viewAttributes() ?>><?php echo $laporan_rekening_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_rekening_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $laporan_rekening_list->tanggal->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_tanggal">
<span<?php echo $laporan_rekening_list->tanggal->viewAttributes() ?>><?php echo $laporan_rekening_list->tanggal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_rekening_list->saldo_awal->Visible) { // saldo_awal ?>
		<td data-name="saldo_awal" <?php echo $laporan_rekening_list->saldo_awal->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_saldo_awal">
<span<?php echo $laporan_rekening_list->saldo_awal->viewAttributes() ?>><?php echo $laporan_rekening_list->saldo_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($laporan_rekening_list->sisa_saldo->Visible) { // sisa_saldo ?>
		<td data-name="sisa_saldo" <?php echo $laporan_rekening_list->sisa_saldo->cellAttributes() ?>>
<span id="el<?php echo $laporan_rekening_list->RowCount ?>_laporan_rekening_sisa_saldo">
<span<?php echo $laporan_rekening_list->sisa_saldo->viewAttributes() ?>><?php echo $laporan_rekening_list->sisa_saldo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$laporan_rekening_list->ListOptions->render("body", "right", $laporan_rekening_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$laporan_rekening_list->isGridAdd())
		$laporan_rekening_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$laporan_rekening->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($laporan_rekening_list->Recordset)
	$laporan_rekening_list->Recordset->Close();
?>
<?php if (!$laporan_rekening_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$laporan_rekening_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $laporan_rekening_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $laporan_rekening_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($laporan_rekening_list->TotalRecords == 0 && !$laporan_rekening->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $laporan_rekening_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$laporan_rekening_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$laporan_rekening_list->isExport()) { ?>
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
$laporan_rekening_list->terminate();
?>