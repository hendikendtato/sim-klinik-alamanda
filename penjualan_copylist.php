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
$penjualan_copy_list = new penjualan_copy_list();

// Run the page
$penjualan_copy_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_copy_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penjualan_copy_list->isExport()) { ?>
<script>
var fpenjualan_copylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenjualan_copylist = currentForm = new ew.Form("fpenjualan_copylist", "list");
	fpenjualan_copylist.formKeyCountName = '<?php echo $penjualan_copy_list->FormKeyCountName ?>';
	loadjs.done("fpenjualan_copylist");
});
var fpenjualan_copylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenjualan_copylistsrch = currentSearchForm = new ew.Form("fpenjualan_copylistsrch");

	// Dynamic selection lists
	// Filters

	fpenjualan_copylistsrch.filterList = <?php echo $penjualan_copy_list->getFilterList() ?>;
	loadjs.done("fpenjualan_copylistsrch");
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
<?php if (!$penjualan_copy_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penjualan_copy_list->TotalRecords > 0 && $penjualan_copy_list->ExportOptions->visible()) { ?>
<?php $penjualan_copy_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penjualan_copy_list->ImportOptions->visible()) { ?>
<?php $penjualan_copy_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penjualan_copy_list->SearchOptions->visible()) { ?>
<?php $penjualan_copy_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penjualan_copy_list->FilterOptions->visible()) { ?>
<?php $penjualan_copy_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penjualan_copy_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$penjualan_copy_list->isExport() && !$penjualan_copy->CurrentAction) { ?>
<form name="fpenjualan_copylistsrch" id="fpenjualan_copylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpenjualan_copylistsrch-search-panel" class="<?php echo $penjualan_copy_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penjualan_copy">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $penjualan_copy_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($penjualan_copy_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($penjualan_copy_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $penjualan_copy_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($penjualan_copy_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($penjualan_copy_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($penjualan_copy_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($penjualan_copy_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $penjualan_copy_list->showPageHeader(); ?>
<?php
$penjualan_copy_list->showMessage();
?>
<?php if ($penjualan_copy_list->TotalRecords > 0 || $penjualan_copy->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penjualan_copy_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penjualan_copy">
<?php if (!$penjualan_copy_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$penjualan_copy_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penjualan_copy_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penjualan_copy_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpenjualan_copylist" id="fpenjualan_copylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan_copy">
<div id="gmp_penjualan_copy" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penjualan_copy_list->TotalRecords > 0 || $penjualan_copy_list->isGridEdit()) { ?>
<table id="tbl_penjualan_copylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penjualan_copy->RowType = ROWTYPE_HEADER;

// Render list options
$penjualan_copy_list->renderListOptions();

// Render list options (header, left)
$penjualan_copy_list->ListOptions->render("header", "left");
?>
<?php if ($penjualan_copy_list->id->Visible) { // id ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $penjualan_copy_list->id->headerCellClass() ?>"><div id="elh_penjualan_copy_id" class="penjualan_copy_id"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $penjualan_copy_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id) ?>', 1);"><div id="elh_penjualan_copy_id" class="penjualan_copy_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->waktu->Visible) { // waktu ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->waktu) == "") { ?>
		<th data-name="waktu" class="<?php echo $penjualan_copy_list->waktu->headerCellClass() ?>"><div id="elh_penjualan_copy_waktu" class="penjualan_copy_waktu"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->waktu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="waktu" class="<?php echo $penjualan_copy_list->waktu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->waktu) ?>', 1);"><div id="elh_penjualan_copy_waktu" class="penjualan_copy_waktu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->waktu->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->waktu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->waktu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $penjualan_copy_list->id_pelanggan->headerCellClass() ?>"><div id="elh_penjualan_copy_id_pelanggan" class="penjualan_copy_id_pelanggan"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $penjualan_copy_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_pelanggan) ?>', 1);"><div id="elh_penjualan_copy_id_pelanggan" class="penjualan_copy_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_member->Visible) { // id_member ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_member) == "") { ?>
		<th data-name="id_member" class="<?php echo $penjualan_copy_list->id_member->headerCellClass() ?>"><div id="elh_penjualan_copy_id_member" class="penjualan_copy_id_member"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_member" class="<?php echo $penjualan_copy_list->id_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_member) ?>', 1);"><div id="elh_penjualan_copy_id_member" class="penjualan_copy_id_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->diskon_persen->Visible) { // diskon_persen ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->diskon_persen) == "") { ?>
		<th data-name="diskon_persen" class="<?php echo $penjualan_copy_list->diskon_persen->headerCellClass() ?>"><div id="elh_penjualan_copy_diskon_persen" class="penjualan_copy_diskon_persen"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->diskon_persen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="diskon_persen" class="<?php echo $penjualan_copy_list->diskon_persen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->diskon_persen) ?>', 1);"><div id="elh_penjualan_copy_diskon_persen" class="penjualan_copy_diskon_persen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->diskon_persen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->diskon_persen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->diskon_persen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->diskon_rupiah->Visible) { // diskon_rupiah ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->diskon_rupiah) == "") { ?>
		<th data-name="diskon_rupiah" class="<?php echo $penjualan_copy_list->diskon_rupiah->headerCellClass() ?>"><div id="elh_penjualan_copy_diskon_rupiah" class="penjualan_copy_diskon_rupiah"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->diskon_rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="diskon_rupiah" class="<?php echo $penjualan_copy_list->diskon_rupiah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->diskon_rupiah) ?>', 1);"><div id="elh_penjualan_copy_diskon_rupiah" class="penjualan_copy_diskon_rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->diskon_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->diskon_rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->diskon_rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->ppn->Visible) { // ppn ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->ppn) == "") { ?>
		<th data-name="ppn" class="<?php echo $penjualan_copy_list->ppn->headerCellClass() ?>"><div id="elh_penjualan_copy_ppn" class="penjualan_copy_ppn"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->ppn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ppn" class="<?php echo $penjualan_copy_list->ppn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->ppn) ?>', 1);"><div id="elh_penjualan_copy_ppn" class="penjualan_copy_ppn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->ppn->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->ppn->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->ppn->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->total->Visible) { // total ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $penjualan_copy_list->total->headerCellClass() ?>"><div id="elh_penjualan_copy_total" class="penjualan_copy_total"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $penjualan_copy_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->total) ?>', 1);"><div id="elh_penjualan_copy_total" class="penjualan_copy_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->bayar->Visible) { // bayar ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->bayar) == "") { ?>
		<th data-name="bayar" class="<?php echo $penjualan_copy_list->bayar->headerCellClass() ?>"><div id="elh_penjualan_copy_bayar" class="penjualan_copy_bayar"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bayar" class="<?php echo $penjualan_copy_list->bayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->bayar) ?>', 1);"><div id="elh_penjualan_copy_bayar" class="penjualan_copy_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->bayar_non_tunai) == "") { ?>
		<th data-name="bayar_non_tunai" class="<?php echo $penjualan_copy_list->bayar_non_tunai->headerCellClass() ?>"><div id="elh_penjualan_copy_bayar_non_tunai" class="penjualan_copy_bayar_non_tunai"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->bayar_non_tunai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bayar_non_tunai" class="<?php echo $penjualan_copy_list->bayar_non_tunai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->bayar_non_tunai) ?>', 1);"><div id="elh_penjualan_copy_bayar_non_tunai" class="penjualan_copy_bayar_non_tunai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->bayar_non_tunai->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->bayar_non_tunai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->bayar_non_tunai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->total_non_tunai_charge) == "") { ?>
		<th data-name="total_non_tunai_charge" class="<?php echo $penjualan_copy_list->total_non_tunai_charge->headerCellClass() ?>"><div id="elh_penjualan_copy_total_non_tunai_charge" class="penjualan_copy_total_non_tunai_charge"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->total_non_tunai_charge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_non_tunai_charge" class="<?php echo $penjualan_copy_list->total_non_tunai_charge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->total_non_tunai_charge) ?>', 1);"><div id="elh_penjualan_copy_total_non_tunai_charge" class="penjualan_copy_total_non_tunai_charge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->total_non_tunai_charge->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->total_non_tunai_charge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->total_non_tunai_charge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->kode_penjualan->Visible) { // kode_penjualan ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->kode_penjualan) == "") { ?>
		<th data-name="kode_penjualan" class="<?php echo $penjualan_copy_list->kode_penjualan->headerCellClass() ?>"><div id="elh_penjualan_copy_kode_penjualan" class="penjualan_copy_kode_penjualan"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->kode_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penjualan" class="<?php echo $penjualan_copy_list->kode_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->kode_penjualan) ?>', 1);"><div id="elh_penjualan_copy_kode_penjualan" class="penjualan_copy_kode_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->kode_penjualan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->kode_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->kode_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->keterangan->Visible) { // keterangan ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $penjualan_copy_list->keterangan->headerCellClass() ?>"><div id="elh_penjualan_copy_keterangan" class="penjualan_copy_keterangan"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $penjualan_copy_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->keterangan) ?>', 1);"><div id="elh_penjualan_copy_keterangan" class="penjualan_copy_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->dokter->Visible) { // dokter ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->dokter) == "") { ?>
		<th data-name="dokter" class="<?php echo $penjualan_copy_list->dokter->headerCellClass() ?>"><div id="elh_penjualan_copy_dokter" class="penjualan_copy_dokter"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->dokter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dokter" class="<?php echo $penjualan_copy_list->dokter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->dokter) ?>', 1);"><div id="elh_penjualan_copy_dokter" class="penjualan_copy_dokter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->dokter->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->dokter->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->dokter->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->sales->Visible) { // sales ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->sales) == "") { ?>
		<th data-name="sales" class="<?php echo $penjualan_copy_list->sales->headerCellClass() ?>"><div id="elh_penjualan_copy_sales" class="penjualan_copy_sales"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->sales->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sales" class="<?php echo $penjualan_copy_list->sales->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->sales) ?>', 1);"><div id="elh_penjualan_copy_sales" class="penjualan_copy_sales">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->sales->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->sales->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->sales->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->dok_be_wajah->Visible) { // dok_be_wajah ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->dok_be_wajah) == "") { ?>
		<th data-name="dok_be_wajah" class="<?php echo $penjualan_copy_list->dok_be_wajah->headerCellClass() ?>"><div id="elh_penjualan_copy_dok_be_wajah" class="penjualan_copy_dok_be_wajah"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->dok_be_wajah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dok_be_wajah" class="<?php echo $penjualan_copy_list->dok_be_wajah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->dok_be_wajah) ?>', 1);"><div id="elh_penjualan_copy_dok_be_wajah" class="penjualan_copy_dok_be_wajah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->dok_be_wajah->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->dok_be_wajah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->dok_be_wajah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->be_body->Visible) { // be_body ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->be_body) == "") { ?>
		<th data-name="be_body" class="<?php echo $penjualan_copy_list->be_body->headerCellClass() ?>"><div id="elh_penjualan_copy_be_body" class="penjualan_copy_be_body"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->be_body->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="be_body" class="<?php echo $penjualan_copy_list->be_body->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->be_body) ?>', 1);"><div id="elh_penjualan_copy_be_body" class="penjualan_copy_be_body">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->be_body->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->be_body->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->be_body->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->medis->Visible) { // medis ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->medis) == "") { ?>
		<th data-name="medis" class="<?php echo $penjualan_copy_list->medis->headerCellClass() ?>"><div id="elh_penjualan_copy_medis" class="penjualan_copy_medis"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->medis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="medis" class="<?php echo $penjualan_copy_list->medis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->medis) ?>', 1);"><div id="elh_penjualan_copy_medis" class="penjualan_copy_medis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->medis->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->medis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->medis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $penjualan_copy_list->id_klinik->headerCellClass() ?>"><div id="elh_penjualan_copy_id_klinik" class="penjualan_copy_id_klinik"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $penjualan_copy_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_klinik) ?>', 1);"><div id="elh_penjualan_copy_id_klinik" class="penjualan_copy_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_rmd->Visible) { // id_rmd ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_rmd) == "") { ?>
		<th data-name="id_rmd" class="<?php echo $penjualan_copy_list->id_rmd->headerCellClass() ?>"><div id="elh_penjualan_copy_id_rmd" class="penjualan_copy_id_rmd"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_rmd->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_rmd" class="<?php echo $penjualan_copy_list->id_rmd->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_rmd) ?>', 1);"><div id="elh_penjualan_copy_id_rmd" class="penjualan_copy_id_rmd">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_rmd->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_rmd->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_rmd->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->metode_pembayaran) == "") { ?>
		<th data-name="metode_pembayaran" class="<?php echo $penjualan_copy_list->metode_pembayaran->headerCellClass() ?>"><div id="elh_penjualan_copy_metode_pembayaran" class="penjualan_copy_metode_pembayaran"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->metode_pembayaran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="metode_pembayaran" class="<?php echo $penjualan_copy_list->metode_pembayaran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->metode_pembayaran) ?>', 1);"><div id="elh_penjualan_copy_metode_pembayaran" class="penjualan_copy_metode_pembayaran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->metode_pembayaran->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->metode_pembayaran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->metode_pembayaran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_bank->Visible) { // id_bank ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_bank) == "") { ?>
		<th data-name="id_bank" class="<?php echo $penjualan_copy_list->id_bank->headerCellClass() ?>"><div id="elh_penjualan_copy_id_bank" class="penjualan_copy_id_bank"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_bank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_bank" class="<?php echo $penjualan_copy_list->id_bank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_bank) ?>', 1);"><div id="elh_penjualan_copy_id_bank" class="penjualan_copy_id_bank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_bank->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_bank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_bank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_kartu->Visible) { // id_kartu ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_kartu) == "") { ?>
		<th data-name="id_kartu" class="<?php echo $penjualan_copy_list->id_kartu->headerCellClass() ?>"><div id="elh_penjualan_copy_id_kartu" class="penjualan_copy_id_kartu"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_kartu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kartu" class="<?php echo $penjualan_copy_list->id_kartu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_kartu) ?>', 1);"><div id="elh_penjualan_copy_id_kartu" class="penjualan_copy_id_kartu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_kartu->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_kartu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_kartu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->jumlah_voucher->Visible) { // jumlah_voucher ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->jumlah_voucher) == "") { ?>
		<th data-name="jumlah_voucher" class="<?php echo $penjualan_copy_list->jumlah_voucher->headerCellClass() ?>"><div id="elh_penjualan_copy_jumlah_voucher" class="penjualan_copy_jumlah_voucher"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->jumlah_voucher->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah_voucher" class="<?php echo $penjualan_copy_list->jumlah_voucher->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->jumlah_voucher) ?>', 1);"><div id="elh_penjualan_copy_jumlah_voucher" class="penjualan_copy_jumlah_voucher">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->jumlah_voucher->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->jumlah_voucher->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->jumlah_voucher->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_kartubank->Visible) { // id_kartubank ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_kartubank) == "") { ?>
		<th data-name="id_kartubank" class="<?php echo $penjualan_copy_list->id_kartubank->headerCellClass() ?>"><div id="elh_penjualan_copy_id_kartubank" class="penjualan_copy_id_kartubank"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_kartubank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kartubank" class="<?php echo $penjualan_copy_list->id_kartubank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_kartubank) ?>', 1);"><div id="elh_penjualan_copy_id_kartubank" class="penjualan_copy_id_kartubank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_kartubank->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_kartubank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_kartubank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->id_kas->Visible) { // id_kas ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->id_kas) == "") { ?>
		<th data-name="id_kas" class="<?php echo $penjualan_copy_list->id_kas->headerCellClass() ?>"><div id="elh_penjualan_copy_id_kas" class="penjualan_copy_id_kas"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_kas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kas" class="<?php echo $penjualan_copy_list->id_kas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->id_kas) ?>', 1);"><div id="elh_penjualan_copy_id_kas" class="penjualan_copy_id_kas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->id_kas->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->id_kas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->id_kas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->charge->Visible) { // charge ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->charge) == "") { ?>
		<th data-name="charge" class="<?php echo $penjualan_copy_list->charge->headerCellClass() ?>"><div id="elh_penjualan_copy_charge" class="penjualan_copy_charge"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->charge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="charge" class="<?php echo $penjualan_copy_list->charge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->charge) ?>', 1);"><div id="elh_penjualan_copy_charge" class="penjualan_copy_charge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->charge->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->charge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->charge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->ongkir->Visible) { // ongkir ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->ongkir) == "") { ?>
		<th data-name="ongkir" class="<?php echo $penjualan_copy_list->ongkir->headerCellClass() ?>"><div id="elh_penjualan_copy_ongkir" class="penjualan_copy_ongkir"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->ongkir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ongkir" class="<?php echo $penjualan_copy_list->ongkir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->ongkir) ?>', 1);"><div id="elh_penjualan_copy_ongkir" class="penjualan_copy_ongkir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->ongkir->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->ongkir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->ongkir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->klaim_poin->Visible) { // klaim_poin ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->klaim_poin) == "") { ?>
		<th data-name="klaim_poin" class="<?php echo $penjualan_copy_list->klaim_poin->headerCellClass() ?>"><div id="elh_penjualan_copy_klaim_poin" class="penjualan_copy_klaim_poin"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->klaim_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="klaim_poin" class="<?php echo $penjualan_copy_list->klaim_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->klaim_poin) ?>', 1);"><div id="elh_penjualan_copy_klaim_poin" class="penjualan_copy_klaim_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->klaim_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->klaim_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->klaim_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->total_penukaran_poin) == "") { ?>
		<th data-name="total_penukaran_poin" class="<?php echo $penjualan_copy_list->total_penukaran_poin->headerCellClass() ?>"><div id="elh_penjualan_copy_total_penukaran_poin" class="penjualan_copy_total_penukaran_poin"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->total_penukaran_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_penukaran_poin" class="<?php echo $penjualan_copy_list->total_penukaran_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->total_penukaran_poin) ?>', 1);"><div id="elh_penjualan_copy_total_penukaran_poin" class="penjualan_copy_total_penukaran_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->total_penukaran_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->total_penukaran_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->total_penukaran_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->_action->Visible) { // action ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->_action) == "") { ?>
		<th data-name="_action" class="<?php echo $penjualan_copy_list->_action->headerCellClass() ?>"><div id="elh_penjualan_copy__action" class="penjualan_copy__action"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->_action->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_action" class="<?php echo $penjualan_copy_list->_action->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->_action) ?>', 1);"><div id="elh_penjualan_copy__action" class="penjualan_copy__action">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->_action->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->_action->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->_action->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->status->Visible) { // status ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $penjualan_copy_list->status->headerCellClass() ?>"><div id="elh_penjualan_copy_status" class="penjualan_copy_status"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $penjualan_copy_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->status) ?>', 1);"><div id="elh_penjualan_copy_status" class="penjualan_copy_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_copy_list->status_void->Visible) { // status_void ?>
	<?php if ($penjualan_copy_list->SortUrl($penjualan_copy_list->status_void) == "") { ?>
		<th data-name="status_void" class="<?php echo $penjualan_copy_list->status_void->headerCellClass() ?>"><div id="elh_penjualan_copy_status_void" class="penjualan_copy_status_void"><div class="ew-table-header-caption"><?php echo $penjualan_copy_list->status_void->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_void" class="<?php echo $penjualan_copy_list->status_void->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_copy_list->SortUrl($penjualan_copy_list->status_void) ?>', 1);"><div id="elh_penjualan_copy_status_void" class="penjualan_copy_status_void">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_copy_list->status_void->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_copy_list->status_void->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_copy_list->status_void->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penjualan_copy_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penjualan_copy_list->ExportAll && $penjualan_copy_list->isExport()) {
	$penjualan_copy_list->StopRecord = $penjualan_copy_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penjualan_copy_list->TotalRecords > $penjualan_copy_list->StartRecord + $penjualan_copy_list->DisplayRecords - 1)
		$penjualan_copy_list->StopRecord = $penjualan_copy_list->StartRecord + $penjualan_copy_list->DisplayRecords - 1;
	else
		$penjualan_copy_list->StopRecord = $penjualan_copy_list->TotalRecords;
}
$penjualan_copy_list->RecordCount = $penjualan_copy_list->StartRecord - 1;
if ($penjualan_copy_list->Recordset && !$penjualan_copy_list->Recordset->EOF) {
	$penjualan_copy_list->Recordset->moveFirst();
	$selectLimit = $penjualan_copy_list->UseSelectLimit;
	if (!$selectLimit && $penjualan_copy_list->StartRecord > 1)
		$penjualan_copy_list->Recordset->move($penjualan_copy_list->StartRecord - 1);
} elseif (!$penjualan_copy->AllowAddDeleteRow && $penjualan_copy_list->StopRecord == 0) {
	$penjualan_copy_list->StopRecord = $penjualan_copy->GridAddRowCount;
}

// Initialize aggregate
$penjualan_copy->RowType = ROWTYPE_AGGREGATEINIT;
$penjualan_copy->resetAttributes();
$penjualan_copy_list->renderRow();
while ($penjualan_copy_list->RecordCount < $penjualan_copy_list->StopRecord) {
	$penjualan_copy_list->RecordCount++;
	if ($penjualan_copy_list->RecordCount >= $penjualan_copy_list->StartRecord) {
		$penjualan_copy_list->RowCount++;

		// Set up key count
		$penjualan_copy_list->KeyCount = $penjualan_copy_list->RowIndex;

		// Init row class and style
		$penjualan_copy->resetAttributes();
		$penjualan_copy->CssClass = "";
		if ($penjualan_copy_list->isGridAdd()) {
		} else {
			$penjualan_copy_list->loadRowValues($penjualan_copy_list->Recordset); // Load row values
		}
		$penjualan_copy->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penjualan_copy->RowAttrs->merge(["data-rowindex" => $penjualan_copy_list->RowCount, "id" => "r" . $penjualan_copy_list->RowCount . "_penjualan_copy", "data-rowtype" => $penjualan_copy->RowType]);

		// Render row
		$penjualan_copy_list->renderRow();

		// Render list options
		$penjualan_copy_list->renderListOptions();
?>
	<tr <?php echo $penjualan_copy->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penjualan_copy_list->ListOptions->render("body", "left", $penjualan_copy_list->RowCount);
?>
	<?php if ($penjualan_copy_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $penjualan_copy_list->id->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id">
<span<?php echo $penjualan_copy_list->id->viewAttributes() ?>><?php echo $penjualan_copy_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->waktu->Visible) { // waktu ?>
		<td data-name="waktu" <?php echo $penjualan_copy_list->waktu->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_waktu">
<span<?php echo $penjualan_copy_list->waktu->viewAttributes() ?>><?php echo $penjualan_copy_list->waktu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $penjualan_copy_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_pelanggan">
<span<?php echo $penjualan_copy_list->id_pelanggan->viewAttributes() ?>><?php echo $penjualan_copy_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_member->Visible) { // id_member ?>
		<td data-name="id_member" <?php echo $penjualan_copy_list->id_member->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_member">
<span<?php echo $penjualan_copy_list->id_member->viewAttributes() ?>><?php echo $penjualan_copy_list->id_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->diskon_persen->Visible) { // diskon_persen ?>
		<td data-name="diskon_persen" <?php echo $penjualan_copy_list->diskon_persen->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_diskon_persen">
<span<?php echo $penjualan_copy_list->diskon_persen->viewAttributes() ?>><?php echo $penjualan_copy_list->diskon_persen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->diskon_rupiah->Visible) { // diskon_rupiah ?>
		<td data-name="diskon_rupiah" <?php echo $penjualan_copy_list->diskon_rupiah->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_diskon_rupiah">
<span<?php echo $penjualan_copy_list->diskon_rupiah->viewAttributes() ?>><?php echo $penjualan_copy_list->diskon_rupiah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->ppn->Visible) { // ppn ?>
		<td data-name="ppn" <?php echo $penjualan_copy_list->ppn->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_ppn">
<span<?php echo $penjualan_copy_list->ppn->viewAttributes() ?>><?php echo $penjualan_copy_list->ppn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $penjualan_copy_list->total->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_total">
<span<?php echo $penjualan_copy_list->total->viewAttributes() ?>><?php echo $penjualan_copy_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->bayar->Visible) { // bayar ?>
		<td data-name="bayar" <?php echo $penjualan_copy_list->bayar->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_bayar">
<span<?php echo $penjualan_copy_list->bayar->viewAttributes() ?>><?php echo $penjualan_copy_list->bayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
		<td data-name="bayar_non_tunai" <?php echo $penjualan_copy_list->bayar_non_tunai->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_bayar_non_tunai">
<span<?php echo $penjualan_copy_list->bayar_non_tunai->viewAttributes() ?>><?php echo $penjualan_copy_list->bayar_non_tunai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<td data-name="total_non_tunai_charge" <?php echo $penjualan_copy_list->total_non_tunai_charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_total_non_tunai_charge">
<span<?php echo $penjualan_copy_list->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan_copy_list->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->kode_penjualan->Visible) { // kode_penjualan ?>
		<td data-name="kode_penjualan" <?php echo $penjualan_copy_list->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_kode_penjualan">
<span<?php echo $penjualan_copy_list->kode_penjualan->viewAttributes() ?>><?php echo $penjualan_copy_list->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $penjualan_copy_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_keterangan">
<span<?php echo $penjualan_copy_list->keterangan->viewAttributes() ?>><?php echo $penjualan_copy_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->dokter->Visible) { // dokter ?>
		<td data-name="dokter" <?php echo $penjualan_copy_list->dokter->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_dokter">
<span<?php echo $penjualan_copy_list->dokter->viewAttributes() ?>><?php echo $penjualan_copy_list->dokter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->sales->Visible) { // sales ?>
		<td data-name="sales" <?php echo $penjualan_copy_list->sales->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_sales">
<span<?php echo $penjualan_copy_list->sales->viewAttributes() ?>><?php echo $penjualan_copy_list->sales->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->dok_be_wajah->Visible) { // dok_be_wajah ?>
		<td data-name="dok_be_wajah" <?php echo $penjualan_copy_list->dok_be_wajah->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_dok_be_wajah">
<span<?php echo $penjualan_copy_list->dok_be_wajah->viewAttributes() ?>><?php echo $penjualan_copy_list->dok_be_wajah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->be_body->Visible) { // be_body ?>
		<td data-name="be_body" <?php echo $penjualan_copy_list->be_body->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_be_body">
<span<?php echo $penjualan_copy_list->be_body->viewAttributes() ?>><?php echo $penjualan_copy_list->be_body->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->medis->Visible) { // medis ?>
		<td data-name="medis" <?php echo $penjualan_copy_list->medis->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_medis">
<span<?php echo $penjualan_copy_list->medis->viewAttributes() ?>><?php echo $penjualan_copy_list->medis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $penjualan_copy_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_klinik">
<span<?php echo $penjualan_copy_list->id_klinik->viewAttributes() ?>><?php echo $penjualan_copy_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_rmd->Visible) { // id_rmd ?>
		<td data-name="id_rmd" <?php echo $penjualan_copy_list->id_rmd->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_rmd">
<span<?php echo $penjualan_copy_list->id_rmd->viewAttributes() ?>><?php echo $penjualan_copy_list->id_rmd->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<td data-name="metode_pembayaran" <?php echo $penjualan_copy_list->metode_pembayaran->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_metode_pembayaran">
<span<?php echo $penjualan_copy_list->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan_copy_list->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_bank->Visible) { // id_bank ?>
		<td data-name="id_bank" <?php echo $penjualan_copy_list->id_bank->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_bank">
<span<?php echo $penjualan_copy_list->id_bank->viewAttributes() ?>><?php echo $penjualan_copy_list->id_bank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_kartu->Visible) { // id_kartu ?>
		<td data-name="id_kartu" <?php echo $penjualan_copy_list->id_kartu->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_kartu">
<span<?php echo $penjualan_copy_list->id_kartu->viewAttributes() ?>><?php echo $penjualan_copy_list->id_kartu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<td data-name="jumlah_voucher" <?php echo $penjualan_copy_list->jumlah_voucher->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_jumlah_voucher">
<span<?php echo $penjualan_copy_list->jumlah_voucher->viewAttributes() ?>><?php echo $penjualan_copy_list->jumlah_voucher->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_kartubank->Visible) { // id_kartubank ?>
		<td data-name="id_kartubank" <?php echo $penjualan_copy_list->id_kartubank->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_kartubank">
<span<?php echo $penjualan_copy_list->id_kartubank->viewAttributes() ?>><?php echo $penjualan_copy_list->id_kartubank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->id_kas->Visible) { // id_kas ?>
		<td data-name="id_kas" <?php echo $penjualan_copy_list->id_kas->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_id_kas">
<span<?php echo $penjualan_copy_list->id_kas->viewAttributes() ?>><?php echo $penjualan_copy_list->id_kas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->charge->Visible) { // charge ?>
		<td data-name="charge" <?php echo $penjualan_copy_list->charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_charge">
<span<?php echo $penjualan_copy_list->charge->viewAttributes() ?>><?php echo $penjualan_copy_list->charge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->ongkir->Visible) { // ongkir ?>
		<td data-name="ongkir" <?php echo $penjualan_copy_list->ongkir->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_ongkir">
<span<?php echo $penjualan_copy_list->ongkir->viewAttributes() ?>><?php echo $penjualan_copy_list->ongkir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->klaim_poin->Visible) { // klaim_poin ?>
		<td data-name="klaim_poin" <?php echo $penjualan_copy_list->klaim_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_klaim_poin">
<span<?php echo $penjualan_copy_list->klaim_poin->viewAttributes() ?>><?php echo $penjualan_copy_list->klaim_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<td data-name="total_penukaran_poin" <?php echo $penjualan_copy_list->total_penukaran_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_total_penukaran_poin">
<span<?php echo $penjualan_copy_list->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan_copy_list->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->_action->Visible) { // action ?>
		<td data-name="_action" <?php echo $penjualan_copy_list->_action->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy__action">
<span<?php echo $penjualan_copy_list->_action->viewAttributes() ?>><?php echo $penjualan_copy_list->_action->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $penjualan_copy_list->status->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_status">
<span<?php echo $penjualan_copy_list->status->viewAttributes() ?>><?php echo $penjualan_copy_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_copy_list->status_void->Visible) { // status_void ?>
		<td data-name="status_void" <?php echo $penjualan_copy_list->status_void->cellAttributes() ?>>
<span id="el<?php echo $penjualan_copy_list->RowCount ?>_penjualan_copy_status_void">
<span<?php echo $penjualan_copy_list->status_void->viewAttributes() ?>><?php echo $penjualan_copy_list->status_void->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penjualan_copy_list->ListOptions->render("body", "right", $penjualan_copy_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penjualan_copy_list->isGridAdd())
		$penjualan_copy_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penjualan_copy->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penjualan_copy_list->Recordset)
	$penjualan_copy_list->Recordset->Close();
?>
<?php if (!$penjualan_copy_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penjualan_copy_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penjualan_copy_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penjualan_copy_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penjualan_copy_list->TotalRecords == 0 && !$penjualan_copy->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penjualan_copy_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penjualan_copy_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penjualan_copy_list->isExport()) { ?>
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
$penjualan_copy_list->terminate();
?>