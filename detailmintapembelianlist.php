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
$detailmintapembelian_list = new detailmintapembelian_list();

// Run the page
$detailmintapembelian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmintapembelian_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailmintapembelian_list->isExport()) { ?>
<script>
var fdetailmintapembelianlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailmintapembelianlist = currentForm = new ew.Form("fdetailmintapembelianlist", "list");
	fdetailmintapembelianlist.formKeyCountName = '<?php echo $detailmintapembelian_list->FormKeyCountName ?>';
	loadjs.done("fdetailmintapembelianlist");
});
var fdetailmintapembelianlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailmintapembelianlistsrch = currentSearchForm = new ew.Form("fdetailmintapembelianlistsrch");

	// Dynamic selection lists
	// Filters

	fdetailmintapembelianlistsrch.filterList = <?php echo $detailmintapembelian_list->getFilterList() ?>;
	loadjs.done("fdetailmintapembelianlistsrch");
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
<?php if (!$detailmintapembelian_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailmintapembelian_list->TotalRecords > 0 && $detailmintapembelian_list->ExportOptions->visible()) { ?>
<?php $detailmintapembelian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailmintapembelian_list->ImportOptions->visible()) { ?>
<?php $detailmintapembelian_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailmintapembelian_list->SearchOptions->visible()) { ?>
<?php $detailmintapembelian_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailmintapembelian_list->FilterOptions->visible()) { ?>
<?php $detailmintapembelian_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailmintapembelian_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailmintapembelian_list->isExport("print")) { ?>
<?php
if ($detailmintapembelian_list->DbMasterFilter != "" && $detailmintapembelian->getCurrentMasterTable() == "permintaanpembelian") {
	if ($detailmintapembelian_list->MasterRecordExists) {
		include_once "permintaanpembelianmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailmintapembelian_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailmintapembelian_list->isExport() && !$detailmintapembelian->CurrentAction) { ?>
<form name="fdetailmintapembelianlistsrch" id="fdetailmintapembelianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailmintapembelianlistsrch-search-panel" class="<?php echo $detailmintapembelian_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailmintapembelian">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $detailmintapembelian_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($detailmintapembelian_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($detailmintapembelian_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $detailmintapembelian_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($detailmintapembelian_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($detailmintapembelian_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($detailmintapembelian_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($detailmintapembelian_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailmintapembelian_list->showPageHeader(); ?>
<?php
$detailmintapembelian_list->showMessage();
?>
<?php if ($detailmintapembelian_list->TotalRecords > 0 || $detailmintapembelian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailmintapembelian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailmintapembelian">
<?php if (!$detailmintapembelian_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailmintapembelian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailmintapembelian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailmintapembelian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailmintapembelianlist" id="fdetailmintapembelianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmintapembelian">
<?php if ($detailmintapembelian->getCurrentMasterTable() == "permintaanpembelian" && $detailmintapembelian->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="permintaanpembelian">
<input type="hidden" name="fk_id_pp" value="<?php echo HtmlEncode($detailmintapembelian_list->pid_pp->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailmintapembelian" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailmintapembelian_list->TotalRecords > 0 || $detailmintapembelian_list->isGridEdit()) { ?>
<table id="tbl_detailmintapembelianlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailmintapembelian->RowType = ROWTYPE_HEADER;

// Render list options
$detailmintapembelian_list->renderListOptions();

// Render list options (header, left)
$detailmintapembelian_list->ListOptions->render("header", "left");
?>
<?php if ($detailmintapembelian_list->id_detailpp->Visible) { // id_detailpp ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->id_detailpp) == "") { ?>
		<th data-name="id_detailpp" class="<?php echo $detailmintapembelian_list->id_detailpp->headerCellClass() ?>"><div id="elh_detailmintapembelian_id_detailpp" class="detailmintapembelian_id_detailpp"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->id_detailpp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailpp" class="<?php echo $detailmintapembelian_list->id_detailpp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->id_detailpp) ?>', 1);"><div id="elh_detailmintapembelian_id_detailpp" class="detailmintapembelian_id_detailpp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->id_detailpp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->id_detailpp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->id_detailpp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->pid_pp->Visible) { // pid_pp ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->pid_pp) == "") { ?>
		<th data-name="pid_pp" class="<?php echo $detailmintapembelian_list->pid_pp->headerCellClass() ?>"><div id="elh_detailmintapembelian_pid_pp" class="detailmintapembelian_pid_pp"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->pid_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_pp" class="<?php echo $detailmintapembelian_list->pid_pp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->pid_pp) ?>', 1);"><div id="elh_detailmintapembelian_pid_pp" class="detailmintapembelian_pid_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->pid_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->pid_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->pid_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->idbarang->Visible) { // idbarang ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->idbarang) == "") { ?>
		<th data-name="idbarang" class="<?php echo $detailmintapembelian_list->idbarang->headerCellClass() ?>"><div id="elh_detailmintapembelian_idbarang" class="detailmintapembelian_idbarang"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->idbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idbarang" class="<?php echo $detailmintapembelian_list->idbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->idbarang) ?>', 1);"><div id="elh_detailmintapembelian_idbarang" class="detailmintapembelian_idbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->idbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->idbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->idbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->part->Visible) { // part ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->part) == "") { ?>
		<th data-name="part" class="<?php echo $detailmintapembelian_list->part->headerCellClass() ?>"><div id="elh_detailmintapembelian_part" class="detailmintapembelian_part"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->part->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="part" class="<?php echo $detailmintapembelian_list->part->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->part) ?>', 1);"><div id="elh_detailmintapembelian_part" class="detailmintapembelian_part">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->part->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->part->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->part->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->lot->Visible) { // lot ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->lot) == "") { ?>
		<th data-name="lot" class="<?php echo $detailmintapembelian_list->lot->headerCellClass() ?>"><div id="elh_detailmintapembelian_lot" class="detailmintapembelian_lot"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->lot->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lot" class="<?php echo $detailmintapembelian_list->lot->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->lot) ?>', 1);"><div id="elh_detailmintapembelian_lot" class="detailmintapembelian_lot">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->lot->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->lot->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->lot->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->qty_pp->Visible) { // qty_pp ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->qty_pp) == "") { ?>
		<th data-name="qty_pp" class="<?php echo $detailmintapembelian_list->qty_pp->headerCellClass() ?>"><div id="elh_detailmintapembelian_qty_pp" class="detailmintapembelian_qty_pp"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->qty_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_pp" class="<?php echo $detailmintapembelian_list->qty_pp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->qty_pp) ?>', 1);"><div id="elh_detailmintapembelian_qty_pp" class="detailmintapembelian_qty_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->qty_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->qty_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->qty_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->qty_acc->Visible) { // qty_acc ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->qty_acc) == "") { ?>
		<th data-name="qty_acc" class="<?php echo $detailmintapembelian_list->qty_acc->headerCellClass() ?>"><div id="elh_detailmintapembelian_qty_acc" class="detailmintapembelian_qty_acc"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->qty_acc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_acc" class="<?php echo $detailmintapembelian_list->qty_acc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->qty_acc) ?>', 1);"><div id="elh_detailmintapembelian_qty_acc" class="detailmintapembelian_qty_acc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->qty_acc->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->qty_acc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->qty_acc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailmintapembelian_list->id_satuan->headerCellClass() ?>"><div id="elh_detailmintapembelian_id_satuan" class="detailmintapembelian_id_satuan"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailmintapembelian_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->id_satuan) ?>', 1);"><div id="elh_detailmintapembelian_id_satuan" class="detailmintapembelian_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->harga->Visible) { // harga ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->harga) == "") { ?>
		<th data-name="harga" class="<?php echo $detailmintapembelian_list->harga->headerCellClass() ?>"><div id="elh_detailmintapembelian_harga" class="detailmintapembelian_harga"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->harga->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga" class="<?php echo $detailmintapembelian_list->harga->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->harga) ?>', 1);"><div id="elh_detailmintapembelian_harga" class="detailmintapembelian_harga">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->harga->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->harga->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->harga->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_list->total->Visible) { // total ?>
	<?php if ($detailmintapembelian_list->SortUrl($detailmintapembelian_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $detailmintapembelian_list->total->headerCellClass() ?>"><div id="elh_detailmintapembelian_total" class="detailmintapembelian_total"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $detailmintapembelian_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailmintapembelian_list->SortUrl($detailmintapembelian_list->total) ?>', 1);"><div id="elh_detailmintapembelian_total" class="detailmintapembelian_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailmintapembelian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailmintapembelian_list->ExportAll && $detailmintapembelian_list->isExport()) {
	$detailmintapembelian_list->StopRecord = $detailmintapembelian_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailmintapembelian_list->TotalRecords > $detailmintapembelian_list->StartRecord + $detailmintapembelian_list->DisplayRecords - 1)
		$detailmintapembelian_list->StopRecord = $detailmintapembelian_list->StartRecord + $detailmintapembelian_list->DisplayRecords - 1;
	else
		$detailmintapembelian_list->StopRecord = $detailmintapembelian_list->TotalRecords;
}
$detailmintapembelian_list->RecordCount = $detailmintapembelian_list->StartRecord - 1;
if ($detailmintapembelian_list->Recordset && !$detailmintapembelian_list->Recordset->EOF) {
	$detailmintapembelian_list->Recordset->moveFirst();
	$selectLimit = $detailmintapembelian_list->UseSelectLimit;
	if (!$selectLimit && $detailmintapembelian_list->StartRecord > 1)
		$detailmintapembelian_list->Recordset->move($detailmintapembelian_list->StartRecord - 1);
} elseif (!$detailmintapembelian->AllowAddDeleteRow && $detailmintapembelian_list->StopRecord == 0) {
	$detailmintapembelian_list->StopRecord = $detailmintapembelian->GridAddRowCount;
}

// Initialize aggregate
$detailmintapembelian->RowType = ROWTYPE_AGGREGATEINIT;
$detailmintapembelian->resetAttributes();
$detailmintapembelian_list->renderRow();
while ($detailmintapembelian_list->RecordCount < $detailmintapembelian_list->StopRecord) {
	$detailmintapembelian_list->RecordCount++;
	if ($detailmintapembelian_list->RecordCount >= $detailmintapembelian_list->StartRecord) {
		$detailmintapembelian_list->RowCount++;

		// Set up key count
		$detailmintapembelian_list->KeyCount = $detailmintapembelian_list->RowIndex;

		// Init row class and style
		$detailmintapembelian->resetAttributes();
		$detailmintapembelian->CssClass = "";
		if ($detailmintapembelian_list->isGridAdd()) {
		} else {
			$detailmintapembelian_list->loadRowValues($detailmintapembelian_list->Recordset); // Load row values
		}
		$detailmintapembelian->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailmintapembelian->RowAttrs->merge(["data-rowindex" => $detailmintapembelian_list->RowCount, "id" => "r" . $detailmintapembelian_list->RowCount . "_detailmintapembelian", "data-rowtype" => $detailmintapembelian->RowType]);

		// Render row
		$detailmintapembelian_list->renderRow();

		// Render list options
		$detailmintapembelian_list->renderListOptions();
?>
	<tr <?php echo $detailmintapembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmintapembelian_list->ListOptions->render("body", "left", $detailmintapembelian_list->RowCount);
?>
	<?php if ($detailmintapembelian_list->id_detailpp->Visible) { // id_detailpp ?>
		<td data-name="id_detailpp" <?php echo $detailmintapembelian_list->id_detailpp->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_id_detailpp">
<span<?php echo $detailmintapembelian_list->id_detailpp->viewAttributes() ?>><?php echo $detailmintapembelian_list->id_detailpp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->pid_pp->Visible) { // pid_pp ?>
		<td data-name="pid_pp" <?php echo $detailmintapembelian_list->pid_pp->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_list->pid_pp->viewAttributes() ?>><?php echo $detailmintapembelian_list->pid_pp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->idbarang->Visible) { // idbarang ?>
		<td data-name="idbarang" <?php echo $detailmintapembelian_list->idbarang->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_idbarang">
<span<?php echo $detailmintapembelian_list->idbarang->viewAttributes() ?>><?php echo $detailmintapembelian_list->idbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->part->Visible) { // part ?>
		<td data-name="part" <?php echo $detailmintapembelian_list->part->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_part">
<span<?php echo $detailmintapembelian_list->part->viewAttributes() ?>><?php echo $detailmintapembelian_list->part->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->lot->Visible) { // lot ?>
		<td data-name="lot" <?php echo $detailmintapembelian_list->lot->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_lot">
<span<?php echo $detailmintapembelian_list->lot->viewAttributes() ?>><?php echo $detailmintapembelian_list->lot->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->qty_pp->Visible) { // qty_pp ?>
		<td data-name="qty_pp" <?php echo $detailmintapembelian_list->qty_pp->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_qty_pp">
<span<?php echo $detailmintapembelian_list->qty_pp->viewAttributes() ?>><?php echo $detailmintapembelian_list->qty_pp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->qty_acc->Visible) { // qty_acc ?>
		<td data-name="qty_acc" <?php echo $detailmintapembelian_list->qty_acc->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_qty_acc">
<span<?php echo $detailmintapembelian_list->qty_acc->viewAttributes() ?>><?php echo $detailmintapembelian_list->qty_acc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailmintapembelian_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_id_satuan">
<span<?php echo $detailmintapembelian_list->id_satuan->viewAttributes() ?>><?php echo $detailmintapembelian_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->harga->Visible) { // harga ?>
		<td data-name="harga" <?php echo $detailmintapembelian_list->harga->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_harga">
<span<?php echo $detailmintapembelian_list->harga->viewAttributes() ?>><?php echo $detailmintapembelian_list->harga->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $detailmintapembelian_list->total->cellAttributes() ?>>
<span id="el<?php echo $detailmintapembelian_list->RowCount ?>_detailmintapembelian_total">
<span<?php echo $detailmintapembelian_list->total->viewAttributes() ?>><?php echo $detailmintapembelian_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailmintapembelian_list->ListOptions->render("body", "right", $detailmintapembelian_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailmintapembelian_list->isGridAdd())
		$detailmintapembelian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailmintapembelian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailmintapembelian_list->Recordset)
	$detailmintapembelian_list->Recordset->Close();
?>
<?php if (!$detailmintapembelian_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailmintapembelian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailmintapembelian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailmintapembelian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailmintapembelian_list->TotalRecords == 0 && !$detailmintapembelian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailmintapembelian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailmintapembelian_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailmintapembelian_list->isExport()) { ?>
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
$detailmintapembelian_list->terminate();
?>