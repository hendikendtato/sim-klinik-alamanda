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
$m_komisi_kinerja_detail_list = new m_komisi_kinerja_detail_list();

// Run the page
$m_komisi_kinerja_detail_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_kinerja_detail_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_komisi_kinerja_detail_list->isExport()) { ?>
<script>
var fm_komisi_kinerja_detaillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_komisi_kinerja_detaillist = currentForm = new ew.Form("fm_komisi_kinerja_detaillist", "list");
	fm_komisi_kinerja_detaillist.formKeyCountName = '<?php echo $m_komisi_kinerja_detail_list->FormKeyCountName ?>';
	loadjs.done("fm_komisi_kinerja_detaillist");
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
<?php if (!$m_komisi_kinerja_detail_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_komisi_kinerja_detail_list->TotalRecords > 0 && $m_komisi_kinerja_detail_list->ExportOptions->visible()) { ?>
<?php $m_komisi_kinerja_detail_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->ImportOptions->visible()) { ?>
<?php $m_komisi_kinerja_detail_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$m_komisi_kinerja_detail_list->isExport() || Config("EXPORT_MASTER_RECORD") && $m_komisi_kinerja_detail_list->isExport("print")) { ?>
<?php
if ($m_komisi_kinerja_detail_list->DbMasterFilter != "" && $m_komisi_kinerja_detail->getCurrentMasterTable() == "m_komisi") {
	if ($m_komisi_kinerja_detail_list->MasterRecordExists) {
		include_once "m_komisimaster.php";
	}
}
?>
<?php } ?>
<?php
$m_komisi_kinerja_detail_list->renderOtherOptions();
?>
<?php $m_komisi_kinerja_detail_list->showPageHeader(); ?>
<?php
$m_komisi_kinerja_detail_list->showMessage();
?>
<?php if ($m_komisi_kinerja_detail_list->TotalRecords > 0 || $m_komisi_kinerja_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_komisi_kinerja_detail_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_komisi_kinerja_detail">
<?php if (!$m_komisi_kinerja_detail_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_komisi_kinerja_detail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_komisi_kinerja_detail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_komisi_kinerja_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_komisi_kinerja_detaillist" id="fm_komisi_kinerja_detaillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi_kinerja_detail">
<?php if ($m_komisi_kinerja_detail->getCurrentMasterTable() == "m_komisi" && $m_komisi_kinerja_detail->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_komisi">
<input type="hidden" name="fk_id_komisi" value="<?php echo HtmlEncode($m_komisi_kinerja_detail_list->id_komisi->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_m_komisi_kinerja_detail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_komisi_kinerja_detail_list->TotalRecords > 0 || $m_komisi_kinerja_detail_list->isGridEdit()) { ?>
<table id="tbl_m_komisi_kinerja_detaillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_komisi_kinerja_detail->RowType = ROWTYPE_HEADER;

// Render list options
$m_komisi_kinerja_detail_list->renderListOptions();

// Render list options (header, left)
$m_komisi_kinerja_detail_list->ListOptions->render("header", "left");
?>
<?php if ($m_komisi_kinerja_detail_list->id->Visible) { // id ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_komisi_kinerja_detail_list->id->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_id" class="m_komisi_kinerja_detail_id"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_komisi_kinerja_detail_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->id) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_id" class="m_komisi_kinerja_detail_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->id_barang->Visible) { // id_barang ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $m_komisi_kinerja_detail_list->id_barang->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_id_barang" class="m_komisi_kinerja_detail_id_barang"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $m_komisi_kinerja_detail_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->id_barang) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_id_barang" class="m_komisi_kinerja_detail_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->kinerja_default_persen->Visible) { // kinerja_default_persen ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_default_persen) == "") { ?>
		<th data-name="kinerja_default_persen" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_kinerja_default_persen" class="m_komisi_kinerja_detail_kinerja_default_persen"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kinerja_default_persen" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_default_persen) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_kinerja_default_persen" class="m_komisi_kinerja_detail_kinerja_default_persen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->kinerja_default_persen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->kinerja_default_persen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->kinerja_default_rupiah->Visible) { // kinerja_default_rupiah ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_default_rupiah) == "") { ?>
		<th data-name="kinerja_default_rupiah" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_kinerja_default_rupiah" class="m_komisi_kinerja_detail_kinerja_default_rupiah"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kinerja_default_rupiah" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_default_rupiah) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_kinerja_default_rupiah" class="m_komisi_kinerja_detail_kinerja_default_rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->kinerja_default_rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->kinerja_default_rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->kinerja_target_persen->Visible) { // kinerja_target_persen ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_target_persen) == "") { ?>
		<th data-name="kinerja_target_persen" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_kinerja_target_persen" class="m_komisi_kinerja_detail_kinerja_target_persen"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kinerja_target_persen" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_target_persen) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_kinerja_target_persen" class="m_komisi_kinerja_detail_kinerja_target_persen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->kinerja_target_persen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->kinerja_target_persen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->kinerja_target_rupiah->Visible) { // kinerja_target_rupiah ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_target_rupiah) == "") { ?>
		<th data-name="kinerja_target_rupiah" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_kinerja_target_rupiah" class="m_komisi_kinerja_detail_kinerja_target_rupiah"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kinerja_target_rupiah" class="<?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->kinerja_target_rupiah) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_kinerja_target_rupiah" class="m_komisi_kinerja_detail_kinerja_target_rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->kinerja_target_rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->kinerja_target_rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->tgl_mulai->Visible) { // tgl_mulai ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->tgl_mulai) == "") { ?>
		<th data-name="tgl_mulai" class="<?php echo $m_komisi_kinerja_detail_list->tgl_mulai->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_tgl_mulai" class="m_komisi_kinerja_detail_tgl_mulai"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->tgl_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_mulai" class="<?php echo $m_komisi_kinerja_detail_list->tgl_mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->tgl_mulai) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_tgl_mulai" class="m_komisi_kinerja_detail_tgl_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->tgl_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->tgl_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->tgl_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_komisi_kinerja_detail_list->tgl_akhir->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_tgl_akhir" class="m_komisi_kinerja_detail_tgl_akhir"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_komisi_kinerja_detail_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->tgl_akhir) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_tgl_akhir" class="m_komisi_kinerja_detail_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->target->Visible) { // target ?>
	<?php if ($m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->target) == "") { ?>
		<th data-name="target" class="<?php echo $m_komisi_kinerja_detail_list->target->headerCellClass() ?>"><div id="elh_m_komisi_kinerja_detail_target" class="m_komisi_kinerja_detail_target"><div class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->target->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target" class="<?php echo $m_komisi_kinerja_detail_list->target->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_kinerja_detail_list->SortUrl($m_komisi_kinerja_detail_list->target) ?>', 1);"><div id="elh_m_komisi_kinerja_detail_target" class="m_komisi_kinerja_detail_target">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_kinerja_detail_list->target->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_kinerja_detail_list->target->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_kinerja_detail_list->target->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_komisi_kinerja_detail_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_komisi_kinerja_detail_list->ExportAll && $m_komisi_kinerja_detail_list->isExport()) {
	$m_komisi_kinerja_detail_list->StopRecord = $m_komisi_kinerja_detail_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_komisi_kinerja_detail_list->TotalRecords > $m_komisi_kinerja_detail_list->StartRecord + $m_komisi_kinerja_detail_list->DisplayRecords - 1)
		$m_komisi_kinerja_detail_list->StopRecord = $m_komisi_kinerja_detail_list->StartRecord + $m_komisi_kinerja_detail_list->DisplayRecords - 1;
	else
		$m_komisi_kinerja_detail_list->StopRecord = $m_komisi_kinerja_detail_list->TotalRecords;
}
$m_komisi_kinerja_detail_list->RecordCount = $m_komisi_kinerja_detail_list->StartRecord - 1;
if ($m_komisi_kinerja_detail_list->Recordset && !$m_komisi_kinerja_detail_list->Recordset->EOF) {
	$m_komisi_kinerja_detail_list->Recordset->moveFirst();
	$selectLimit = $m_komisi_kinerja_detail_list->UseSelectLimit;
	if (!$selectLimit && $m_komisi_kinerja_detail_list->StartRecord > 1)
		$m_komisi_kinerja_detail_list->Recordset->move($m_komisi_kinerja_detail_list->StartRecord - 1);
} elseif (!$m_komisi_kinerja_detail->AllowAddDeleteRow && $m_komisi_kinerja_detail_list->StopRecord == 0) {
	$m_komisi_kinerja_detail_list->StopRecord = $m_komisi_kinerja_detail->GridAddRowCount;
}

// Initialize aggregate
$m_komisi_kinerja_detail->RowType = ROWTYPE_AGGREGATEINIT;
$m_komisi_kinerja_detail->resetAttributes();
$m_komisi_kinerja_detail_list->renderRow();
while ($m_komisi_kinerja_detail_list->RecordCount < $m_komisi_kinerja_detail_list->StopRecord) {
	$m_komisi_kinerja_detail_list->RecordCount++;
	if ($m_komisi_kinerja_detail_list->RecordCount >= $m_komisi_kinerja_detail_list->StartRecord) {
		$m_komisi_kinerja_detail_list->RowCount++;

		// Set up key count
		$m_komisi_kinerja_detail_list->KeyCount = $m_komisi_kinerja_detail_list->RowIndex;

		// Init row class and style
		$m_komisi_kinerja_detail->resetAttributes();
		$m_komisi_kinerja_detail->CssClass = "";
		if ($m_komisi_kinerja_detail_list->isGridAdd()) {
		} else {
			$m_komisi_kinerja_detail_list->loadRowValues($m_komisi_kinerja_detail_list->Recordset); // Load row values
		}
		$m_komisi_kinerja_detail->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_komisi_kinerja_detail->RowAttrs->merge(["data-rowindex" => $m_komisi_kinerja_detail_list->RowCount, "id" => "r" . $m_komisi_kinerja_detail_list->RowCount . "_m_komisi_kinerja_detail", "data-rowtype" => $m_komisi_kinerja_detail->RowType]);

		// Render row
		$m_komisi_kinerja_detail_list->renderRow();

		// Render list options
		$m_komisi_kinerja_detail_list->renderListOptions();
?>
	<tr <?php echo $m_komisi_kinerja_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_komisi_kinerja_detail_list->ListOptions->render("body", "left", $m_komisi_kinerja_detail_list->RowCount);
?>
	<?php if ($m_komisi_kinerja_detail_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_komisi_kinerja_detail_list->id->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_id">
<span<?php echo $m_komisi_kinerja_detail_list->id->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $m_komisi_kinerja_detail_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_id_barang">
<span<?php echo $m_komisi_kinerja_detail_list->id_barang->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->kinerja_default_persen->Visible) { // kinerja_default_persen ?>
		<td data-name="kinerja_default_persen" <?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_kinerja_default_persen">
<span<?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->kinerja_default_persen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->kinerja_default_rupiah->Visible) { // kinerja_default_rupiah ?>
		<td data-name="kinerja_default_rupiah" <?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_kinerja_default_rupiah">
<span<?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->kinerja_default_rupiah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->kinerja_target_persen->Visible) { // kinerja_target_persen ?>
		<td data-name="kinerja_target_persen" <?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_kinerja_target_persen">
<span<?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->kinerja_target_persen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->kinerja_target_rupiah->Visible) { // kinerja_target_rupiah ?>
		<td data-name="kinerja_target_rupiah" <?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_kinerja_target_rupiah">
<span<?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->kinerja_target_rupiah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->tgl_mulai->Visible) { // tgl_mulai ?>
		<td data-name="tgl_mulai" <?php echo $m_komisi_kinerja_detail_list->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_tgl_mulai">
<span<?php echo $m_komisi_kinerja_detail_list->tgl_mulai->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $m_komisi_kinerja_detail_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_tgl_akhir">
<span<?php echo $m_komisi_kinerja_detail_list->tgl_akhir->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_kinerja_detail_list->target->Visible) { // target ?>
		<td data-name="target" <?php echo $m_komisi_kinerja_detail_list->target->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_kinerja_detail_list->RowCount ?>_m_komisi_kinerja_detail_target">
<span<?php echo $m_komisi_kinerja_detail_list->target->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_list->target->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_komisi_kinerja_detail_list->ListOptions->render("body", "right", $m_komisi_kinerja_detail_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_komisi_kinerja_detail_list->isGridAdd())
		$m_komisi_kinerja_detail_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_komisi_kinerja_detail->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_komisi_kinerja_detail_list->Recordset)
	$m_komisi_kinerja_detail_list->Recordset->Close();
?>
<?php if (!$m_komisi_kinerja_detail_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_komisi_kinerja_detail_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_komisi_kinerja_detail_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_komisi_kinerja_detail_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_komisi_kinerja_detail_list->TotalRecords == 0 && !$m_komisi_kinerja_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_komisi_kinerja_detail_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_komisi_kinerja_detail_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_komisi_kinerja_detail_list->isExport()) { ?>
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
$m_komisi_kinerja_detail_list->terminate();
?>