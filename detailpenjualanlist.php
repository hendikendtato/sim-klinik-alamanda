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
$detailpenjualan_list = new detailpenjualan_list();

// Run the page
$detailpenjualan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenjualan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpenjualan_list->isExport()) { ?>
<script>
var fdetailpenjualanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailpenjualanlist = currentForm = new ew.Form("fdetailpenjualanlist", "list");
	fdetailpenjualanlist.formKeyCountName = '<?php echo $detailpenjualan_list->FormKeyCountName ?>';
	loadjs.done("fdetailpenjualanlist");
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
<?php if (!$detailpenjualan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailpenjualan_list->TotalRecords > 0 && $detailpenjualan_list->ExportOptions->visible()) { ?>
<?php $detailpenjualan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpenjualan_list->ImportOptions->visible()) { ?>
<?php $detailpenjualan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailpenjualan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailpenjualan_list->isExport("print")) { ?>
<?php
if ($detailpenjualan_list->DbMasterFilter != "" && $detailpenjualan->getCurrentMasterTable() == "penjualan") {
	if ($detailpenjualan_list->MasterRecordExists) {
		include_once "penjualanmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailpenjualan_list->renderOtherOptions();
?>
<?php $detailpenjualan_list->showPageHeader(); ?>
<?php
$detailpenjualan_list->showMessage();
?>
<?php if ($detailpenjualan_list->TotalRecords > 0 || $detailpenjualan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpenjualan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpenjualan">
<?php if (!$detailpenjualan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailpenjualan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpenjualan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpenjualan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailpenjualanlist" id="fdetailpenjualanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenjualan">
<?php if ($detailpenjualan->getCurrentMasterTable() == "penjualan" && $detailpenjualan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="penjualan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailpenjualan_list->id_penjualan->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailpenjualan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailpenjualan_list->TotalRecords > 0 || $detailpenjualan_list->isGridEdit()) { ?>
<table id="tbl_detailpenjualanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpenjualan->RowType = ROWTYPE_HEADER;

// Render list options
$detailpenjualan_list->renderListOptions();

// Render list options (header, left)
$detailpenjualan_list->ListOptions->render("header", "left");
?>
<?php if ($detailpenjualan_list->id_penjualan->Visible) { // id_penjualan ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->id_penjualan) == "") { ?>
		<th data-name="id_penjualan" class="<?php echo $detailpenjualan_list->id_penjualan->headerCellClass() ?>"><div id="elh_detailpenjualan_id_penjualan" class="detailpenjualan_id_penjualan"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->id_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penjualan" class="<?php echo $detailpenjualan_list->id_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->id_penjualan) ?>', 1);"><div id="elh_detailpenjualan_id_penjualan" class="detailpenjualan_id_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->id_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->id_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->id_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailpenjualan_list->id_barang->headerCellClass() ?>"><div id="elh_detailpenjualan_id_barang" class="detailpenjualan_id_barang"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailpenjualan_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->id_barang) ?>', 1);"><div id="elh_detailpenjualan_id_barang" class="detailpenjualan_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->kode_barang->Visible) { // kode_barang ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenjualan_list->kode_barang->headerCellClass() ?>"><div id="elh_detailpenjualan_kode_barang" class="detailpenjualan_kode_barang"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenjualan_list->kode_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->kode_barang) ?>', 1);"><div id="elh_detailpenjualan_kode_barang" class="detailpenjualan_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->kode_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->nama_barang->Visible) { // nama_barang ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $detailpenjualan_list->nama_barang->headerCellClass() ?>"><div id="elh_detailpenjualan_nama_barang" class="detailpenjualan_nama_barang"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $detailpenjualan_list->nama_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->nama_barang) ?>', 1);"><div id="elh_detailpenjualan_nama_barang" class="detailpenjualan_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->nama_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->harga_jual->Visible) { // harga_jual ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->harga_jual) == "") { ?>
		<th data-name="harga_jual" class="<?php echo $detailpenjualan_list->harga_jual->headerCellClass() ?>"><div id="elh_detailpenjualan_harga_jual" class="detailpenjualan_harga_jual"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->harga_jual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga_jual" class="<?php echo $detailpenjualan_list->harga_jual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->harga_jual) ?>', 1);"><div id="elh_detailpenjualan_harga_jual" class="detailpenjualan_harga_jual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->harga_jual->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->harga_jual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->harga_jual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->stok->Visible) { // stok ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $detailpenjualan_list->stok->headerCellClass() ?>"><div id="elh_detailpenjualan_stok" class="detailpenjualan_stok"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $detailpenjualan_list->stok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->stok) ?>', 1);"><div id="elh_detailpenjualan_stok" class="detailpenjualan_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->qty->Visible) { // qty ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detailpenjualan_list->qty->headerCellClass() ?>"><div id="elh_detailpenjualan_qty" class="detailpenjualan_qty"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detailpenjualan_list->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->qty) ?>', 1);"><div id="elh_detailpenjualan_qty" class="detailpenjualan_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->disc_pr->Visible) { // disc_pr ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->disc_pr) == "") { ?>
		<th data-name="disc_pr" class="<?php echo $detailpenjualan_list->disc_pr->headerCellClass() ?>"><div id="elh_detailpenjualan_disc_pr" class="detailpenjualan_disc_pr"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->disc_pr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_pr" class="<?php echo $detailpenjualan_list->disc_pr->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->disc_pr) ?>', 1);"><div id="elh_detailpenjualan_disc_pr" class="detailpenjualan_disc_pr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->disc_pr->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->disc_pr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->disc_pr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->disc_rp->Visible) { // disc_rp ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->disc_rp) == "") { ?>
		<th data-name="disc_rp" class="<?php echo $detailpenjualan_list->disc_rp->headerCellClass() ?>"><div id="elh_detailpenjualan_disc_rp" class="detailpenjualan_disc_rp"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->disc_rp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_rp" class="<?php echo $detailpenjualan_list->disc_rp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->disc_rp) ?>', 1);"><div id="elh_detailpenjualan_disc_rp" class="detailpenjualan_disc_rp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->disc_rp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->disc_rp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->disc_rp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->komisi_recall->Visible) { // komisi_recall ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->komisi_recall) == "") { ?>
		<th data-name="komisi_recall" class="<?php echo $detailpenjualan_list->komisi_recall->headerCellClass() ?>"><div id="elh_detailpenjualan_komisi_recall" class="detailpenjualan_komisi_recall"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->komisi_recall->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komisi_recall" class="<?php echo $detailpenjualan_list->komisi_recall->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->komisi_recall) ?>', 1);"><div id="elh_detailpenjualan_komisi_recall" class="detailpenjualan_komisi_recall">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->komisi_recall->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->komisi_recall->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->komisi_recall->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_list->subtotal->Visible) { // subtotal ?>
	<?php if ($detailpenjualan_list->SortUrl($detailpenjualan_list->subtotal) == "") { ?>
		<th data-name="subtotal" class="<?php echo $detailpenjualan_list->subtotal->headerCellClass() ?>"><div id="elh_detailpenjualan_subtotal" class="detailpenjualan_subtotal"><div class="ew-table-header-caption"><?php echo $detailpenjualan_list->subtotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subtotal" class="<?php echo $detailpenjualan_list->subtotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpenjualan_list->SortUrl($detailpenjualan_list->subtotal) ?>', 1);"><div id="elh_detailpenjualan_subtotal" class="detailpenjualan_subtotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_list->subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_list->subtotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_list->subtotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenjualan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailpenjualan_list->ExportAll && $detailpenjualan_list->isExport()) {
	$detailpenjualan_list->StopRecord = $detailpenjualan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailpenjualan_list->TotalRecords > $detailpenjualan_list->StartRecord + $detailpenjualan_list->DisplayRecords - 1)
		$detailpenjualan_list->StopRecord = $detailpenjualan_list->StartRecord + $detailpenjualan_list->DisplayRecords - 1;
	else
		$detailpenjualan_list->StopRecord = $detailpenjualan_list->TotalRecords;
}
$detailpenjualan_list->RecordCount = $detailpenjualan_list->StartRecord - 1;
if ($detailpenjualan_list->Recordset && !$detailpenjualan_list->Recordset->EOF) {
	$detailpenjualan_list->Recordset->moveFirst();
	$selectLimit = $detailpenjualan_list->UseSelectLimit;
	if (!$selectLimit && $detailpenjualan_list->StartRecord > 1)
		$detailpenjualan_list->Recordset->move($detailpenjualan_list->StartRecord - 1);
} elseif (!$detailpenjualan->AllowAddDeleteRow && $detailpenjualan_list->StopRecord == 0) {
	$detailpenjualan_list->StopRecord = $detailpenjualan->GridAddRowCount;
}

// Initialize aggregate
$detailpenjualan->RowType = ROWTYPE_AGGREGATEINIT;
$detailpenjualan->resetAttributes();
$detailpenjualan_list->renderRow();
while ($detailpenjualan_list->RecordCount < $detailpenjualan_list->StopRecord) {
	$detailpenjualan_list->RecordCount++;
	if ($detailpenjualan_list->RecordCount >= $detailpenjualan_list->StartRecord) {
		$detailpenjualan_list->RowCount++;

		// Set up key count
		$detailpenjualan_list->KeyCount = $detailpenjualan_list->RowIndex;

		// Init row class and style
		$detailpenjualan->resetAttributes();
		$detailpenjualan->CssClass = "";
		if ($detailpenjualan_list->isGridAdd()) {
		} else {
			$detailpenjualan_list->loadRowValues($detailpenjualan_list->Recordset); // Load row values
		}
		$detailpenjualan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailpenjualan->RowAttrs->merge(["data-rowindex" => $detailpenjualan_list->RowCount, "id" => "r" . $detailpenjualan_list->RowCount . "_detailpenjualan", "data-rowtype" => $detailpenjualan->RowType]);

		// Render row
		$detailpenjualan_list->renderRow();

		// Render list options
		$detailpenjualan_list->renderListOptions();
?>
	<tr <?php echo $detailpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenjualan_list->ListOptions->render("body", "left", $detailpenjualan_list->RowCount);
?>
	<?php if ($detailpenjualan_list->id_penjualan->Visible) { // id_penjualan ?>
		<td data-name="id_penjualan" <?php echo $detailpenjualan_list->id_penjualan->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_list->id_penjualan->viewAttributes() ?>><?php echo $detailpenjualan_list->id_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailpenjualan_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_id_barang">
<span<?php echo $detailpenjualan_list->id_barang->viewAttributes() ?>><?php echo $detailpenjualan_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $detailpenjualan_list->kode_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_kode_barang">
<span<?php echo $detailpenjualan_list->kode_barang->viewAttributes() ?>><?php echo $detailpenjualan_list->kode_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $detailpenjualan_list->nama_barang->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_nama_barang">
<span<?php echo $detailpenjualan_list->nama_barang->viewAttributes() ?>><?php echo $detailpenjualan_list->nama_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->harga_jual->Visible) { // harga_jual ?>
		<td data-name="harga_jual" <?php echo $detailpenjualan_list->harga_jual->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_harga_jual">
<span<?php echo $detailpenjualan_list->harga_jual->viewAttributes() ?>><?php echo $detailpenjualan_list->harga_jual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $detailpenjualan_list->stok->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_stok">
<span<?php echo $detailpenjualan_list->stok->viewAttributes() ?>><?php echo $detailpenjualan_list->stok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detailpenjualan_list->qty->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_qty">
<span<?php echo $detailpenjualan_list->qty->viewAttributes() ?>><?php echo $detailpenjualan_list->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->disc_pr->Visible) { // disc_pr ?>
		<td data-name="disc_pr" <?php echo $detailpenjualan_list->disc_pr->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_disc_pr">
<span<?php echo $detailpenjualan_list->disc_pr->viewAttributes() ?>><?php echo $detailpenjualan_list->disc_pr->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->disc_rp->Visible) { // disc_rp ?>
		<td data-name="disc_rp" <?php echo $detailpenjualan_list->disc_rp->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_disc_rp">
<span<?php echo $detailpenjualan_list->disc_rp->viewAttributes() ?>><?php echo $detailpenjualan_list->disc_rp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->komisi_recall->Visible) { // komisi_recall ?>
		<td data-name="komisi_recall" <?php echo $detailpenjualan_list->komisi_recall->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_komisi_recall">
<span<?php echo $detailpenjualan_list->komisi_recall->viewAttributes() ?>><?php echo $detailpenjualan_list->komisi_recall->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_list->subtotal->Visible) { // subtotal ?>
		<td data-name="subtotal" <?php echo $detailpenjualan_list->subtotal->cellAttributes() ?>>
<span id="el<?php echo $detailpenjualan_list->RowCount ?>_detailpenjualan_subtotal">
<span<?php echo $detailpenjualan_list->subtotal->viewAttributes() ?>><?php echo $detailpenjualan_list->subtotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenjualan_list->ListOptions->render("body", "right", $detailpenjualan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailpenjualan_list->isGridAdd())
		$detailpenjualan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailpenjualan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpenjualan_list->Recordset)
	$detailpenjualan_list->Recordset->Close();
?>
<?php if (!$detailpenjualan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailpenjualan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpenjualan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpenjualan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpenjualan_list->TotalRecords == 0 && !$detailpenjualan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpenjualan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailpenjualan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpenjualan_list->isExport()) { ?>
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
$detailpenjualan_list->terminate();
?>