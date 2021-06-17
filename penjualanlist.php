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
$penjualan_list = new penjualan_list();

// Run the page
$penjualan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penjualan_list->isExport()) { ?>
<script>
var fpenjualanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenjualanlist = currentForm = new ew.Form("fpenjualanlist", "list");
	fpenjualanlist.formKeyCountName = '<?php echo $penjualan_list->FormKeyCountName ?>';
	loadjs.done("fpenjualanlist");
});
var fpenjualanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenjualanlistsrch = currentSearchForm = new ew.Form("fpenjualanlistsrch");

	// Dynamic selection lists
	// Filters

	fpenjualanlistsrch.filterList = <?php echo $penjualan_list->getFilterList() ?>;
	loadjs.done("fpenjualanlistsrch");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","penjualanadd.php?showdetail=detailpenjualan"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-view").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailpenjualan"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-edit").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailpenjualan"+t[1]+"="+t[2])}),$("a.ew-row-link.ew-copy").each(function(){var t=$(this).attr("href").split("=");$(this).attr("href",t[0]+"=detailpenjualan"+t[1]+"="+t[2])});
});
</script>
<?php } ?>
<?php if (!$penjualan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penjualan_list->TotalRecords > 0 && $penjualan_list->ExportOptions->visible()) { ?>
<?php $penjualan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penjualan_list->ImportOptions->visible()) { ?>
<?php $penjualan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penjualan_list->SearchOptions->visible()) { ?>
<?php $penjualan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penjualan_list->FilterOptions->visible()) { ?>
<?php $penjualan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penjualan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$penjualan_list->isExport() && !$penjualan->CurrentAction) { ?>
<form name="fpenjualanlistsrch" id="fpenjualanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpenjualanlistsrch-search-panel" class="<?php echo $penjualan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penjualan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $penjualan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($penjualan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($penjualan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $penjualan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($penjualan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($penjualan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($penjualan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($penjualan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $penjualan_list->showPageHeader(); ?>
<?php
$penjualan_list->showMessage();
?>
<?php if ($penjualan_list->TotalRecords > 0 || $penjualan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penjualan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penjualan">
<?php if (!$penjualan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$penjualan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penjualan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penjualan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpenjualanlist" id="fpenjualanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan">
<div id="gmp_penjualan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penjualan_list->TotalRecords > 0 || $penjualan_list->isGridEdit()) { ?>
<table id="tbl_penjualanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penjualan->RowType = ROWTYPE_HEADER;

// Render list options
$penjualan_list->renderListOptions();

// Render list options (header, left)
$penjualan_list->ListOptions->render("header", "left");
?>
<?php if ($penjualan_list->kode_penjualan->Visible) { // kode_penjualan ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->kode_penjualan) == "") { ?>
		<th data-name="kode_penjualan" class="<?php echo $penjualan_list->kode_penjualan->headerCellClass() ?>"><div id="elh_penjualan_kode_penjualan" class="penjualan_kode_penjualan"><div class="ew-table-header-caption"><?php echo $penjualan_list->kode_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_penjualan" class="<?php echo $penjualan_list->kode_penjualan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->kode_penjualan) ?>', 1);"><div id="elh_penjualan_kode_penjualan" class="penjualan_kode_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->kode_penjualan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->kode_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->kode_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $penjualan_list->id_pelanggan->headerCellClass() ?>"><div id="elh_penjualan_id_pelanggan" class="penjualan_id_pelanggan"><div class="ew-table-header-caption"><?php echo $penjualan_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $penjualan_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->id_pelanggan) ?>', 1);"><div id="elh_penjualan_id_pelanggan" class="penjualan_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->id_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->waktu->Visible) { // waktu ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->waktu) == "") { ?>
		<th data-name="waktu" class="<?php echo $penjualan_list->waktu->headerCellClass() ?>"><div id="elh_penjualan_waktu" class="penjualan_waktu"><div class="ew-table-header-caption"><?php echo $penjualan_list->waktu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="waktu" class="<?php echo $penjualan_list->waktu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->waktu) ?>', 1);"><div id="elh_penjualan_waktu" class="penjualan_waktu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->waktu->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->waktu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->waktu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->total->Visible) { // total ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $penjualan_list->total->headerCellClass() ?>"><div id="elh_penjualan_total" class="penjualan_total"><div class="ew-table-header-caption"><?php echo $penjualan_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $penjualan_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->total) ?>', 1);"><div id="elh_penjualan_total" class="penjualan_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->bayar->Visible) { // bayar ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->bayar) == "") { ?>
		<th data-name="bayar" class="<?php echo $penjualan_list->bayar->headerCellClass() ?>"><div id="elh_penjualan_bayar" class="penjualan_bayar"><div class="ew-table-header-caption"><?php echo $penjualan_list->bayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bayar" class="<?php echo $penjualan_list->bayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->bayar) ?>', 1);"><div id="elh_penjualan_bayar" class="penjualan_bayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->bayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->bayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->bayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->total_non_tunai_charge) == "") { ?>
		<th data-name="total_non_tunai_charge" class="<?php echo $penjualan_list->total_non_tunai_charge->headerCellClass() ?>"><div id="elh_penjualan_total_non_tunai_charge" class="penjualan_total_non_tunai_charge"><div class="ew-table-header-caption"><?php echo $penjualan_list->total_non_tunai_charge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_non_tunai_charge" class="<?php echo $penjualan_list->total_non_tunai_charge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->total_non_tunai_charge) ?>', 1);"><div id="elh_penjualan_total_non_tunai_charge" class="penjualan_total_non_tunai_charge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->total_non_tunai_charge->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->total_non_tunai_charge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->total_non_tunai_charge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->metode_pembayaran) == "") { ?>
		<th data-name="metode_pembayaran" class="<?php echo $penjualan_list->metode_pembayaran->headerCellClass() ?>"><div id="elh_penjualan_metode_pembayaran" class="penjualan_metode_pembayaran"><div class="ew-table-header-caption"><?php echo $penjualan_list->metode_pembayaran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="metode_pembayaran" class="<?php echo $penjualan_list->metode_pembayaran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->metode_pembayaran) ?>', 1);"><div id="elh_penjualan_metode_pembayaran" class="penjualan_metode_pembayaran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->metode_pembayaran->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->metode_pembayaran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->metode_pembayaran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->jumlah_voucher->Visible) { // jumlah_voucher ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->jumlah_voucher) == "") { ?>
		<th data-name="jumlah_voucher" class="<?php echo $penjualan_list->jumlah_voucher->headerCellClass() ?>"><div id="elh_penjualan_jumlah_voucher" class="penjualan_jumlah_voucher"><div class="ew-table-header-caption"><?php echo $penjualan_list->jumlah_voucher->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah_voucher" class="<?php echo $penjualan_list->jumlah_voucher->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->jumlah_voucher) ?>', 1);"><div id="elh_penjualan_jumlah_voucher" class="penjualan_jumlah_voucher">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->jumlah_voucher->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->jumlah_voucher->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->jumlah_voucher->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->id_kartubank->Visible) { // id_kartubank ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->id_kartubank) == "") { ?>
		<th data-name="id_kartubank" class="<?php echo $penjualan_list->id_kartubank->headerCellClass() ?>"><div id="elh_penjualan_id_kartubank" class="penjualan_id_kartubank"><div class="ew-table-header-caption"><?php echo $penjualan_list->id_kartubank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kartubank" class="<?php echo $penjualan_list->id_kartubank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->id_kartubank) ?>', 1);"><div id="elh_penjualan_id_kartubank" class="penjualan_id_kartubank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->id_kartubank->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->id_kartubank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->id_kartubank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->id_kas->Visible) { // id_kas ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->id_kas) == "") { ?>
		<th data-name="id_kas" class="<?php echo $penjualan_list->id_kas->headerCellClass() ?>"><div id="elh_penjualan_id_kas" class="penjualan_id_kas"><div class="ew-table-header-caption"><?php echo $penjualan_list->id_kas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kas" class="<?php echo $penjualan_list->id_kas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->id_kas) ?>', 1);"><div id="elh_penjualan_id_kas" class="penjualan_id_kas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->id_kas->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->id_kas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->id_kas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->charge->Visible) { // charge ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->charge) == "") { ?>
		<th data-name="charge" class="<?php echo $penjualan_list->charge->headerCellClass() ?>"><div id="elh_penjualan_charge" class="penjualan_charge"><div class="ew-table-header-caption"><?php echo $penjualan_list->charge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="charge" class="<?php echo $penjualan_list->charge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->charge) ?>', 1);"><div id="elh_penjualan_charge" class="penjualan_charge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->charge->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->charge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->charge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->klaim_poin->Visible) { // klaim_poin ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->klaim_poin) == "") { ?>
		<th data-name="klaim_poin" class="<?php echo $penjualan_list->klaim_poin->headerCellClass() ?>"><div id="elh_penjualan_klaim_poin" class="penjualan_klaim_poin"><div class="ew-table-header-caption"><?php echo $penjualan_list->klaim_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="klaim_poin" class="<?php echo $penjualan_list->klaim_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->klaim_poin) ?>', 1);"><div id="elh_penjualan_klaim_poin" class="penjualan_klaim_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->klaim_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->klaim_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->klaim_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->total_penukaran_poin) == "") { ?>
		<th data-name="total_penukaran_poin" class="<?php echo $penjualan_list->total_penukaran_poin->headerCellClass() ?>"><div id="elh_penjualan_total_penukaran_poin" class="penjualan_total_penukaran_poin"><div class="ew-table-header-caption"><?php echo $penjualan_list->total_penukaran_poin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_penukaran_poin" class="<?php echo $penjualan_list->total_penukaran_poin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->total_penukaran_poin) ?>', 1);"><div id="elh_penjualan_total_penukaran_poin" class="penjualan_total_penukaran_poin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->total_penukaran_poin->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->total_penukaran_poin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->total_penukaran_poin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penjualan_list->status->Visible) { // status ?>
	<?php if ($penjualan_list->SortUrl($penjualan_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $penjualan_list->status->headerCellClass() ?>"><div id="elh_penjualan_status" class="penjualan_status"><div class="ew-table-header-caption"><?php echo $penjualan_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $penjualan_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penjualan_list->SortUrl($penjualan_list->status) ?>', 1);"><div id="elh_penjualan_status" class="penjualan_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penjualan_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($penjualan_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penjualan_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penjualan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penjualan_list->ExportAll && $penjualan_list->isExport()) {
	$penjualan_list->StopRecord = $penjualan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penjualan_list->TotalRecords > $penjualan_list->StartRecord + $penjualan_list->DisplayRecords - 1)
		$penjualan_list->StopRecord = $penjualan_list->StartRecord + $penjualan_list->DisplayRecords - 1;
	else
		$penjualan_list->StopRecord = $penjualan_list->TotalRecords;
}
$penjualan_list->RecordCount = $penjualan_list->StartRecord - 1;
if ($penjualan_list->Recordset && !$penjualan_list->Recordset->EOF) {
	$penjualan_list->Recordset->moveFirst();
	$selectLimit = $penjualan_list->UseSelectLimit;
	if (!$selectLimit && $penjualan_list->StartRecord > 1)
		$penjualan_list->Recordset->move($penjualan_list->StartRecord - 1);
} elseif (!$penjualan->AllowAddDeleteRow && $penjualan_list->StopRecord == 0) {
	$penjualan_list->StopRecord = $penjualan->GridAddRowCount;
}

// Initialize aggregate
$penjualan->RowType = ROWTYPE_AGGREGATEINIT;
$penjualan->resetAttributes();
$penjualan_list->renderRow();
while ($penjualan_list->RecordCount < $penjualan_list->StopRecord) {
	$penjualan_list->RecordCount++;
	if ($penjualan_list->RecordCount >= $penjualan_list->StartRecord) {
		$penjualan_list->RowCount++;

		// Set up key count
		$penjualan_list->KeyCount = $penjualan_list->RowIndex;

		// Init row class and style
		$penjualan->resetAttributes();
		$penjualan->CssClass = "";
		if ($penjualan_list->isGridAdd()) {
		} else {
			$penjualan_list->loadRowValues($penjualan_list->Recordset); // Load row values
		}
		$penjualan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penjualan->RowAttrs->merge(["data-rowindex" => $penjualan_list->RowCount, "id" => "r" . $penjualan_list->RowCount . "_penjualan", "data-rowtype" => $penjualan->RowType]);

		// Render row
		$penjualan_list->renderRow();

		// Render list options
		$penjualan_list->renderListOptions();
?>
	<tr <?php echo $penjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penjualan_list->ListOptions->render("body", "left", $penjualan_list->RowCount);
?>
	<?php if ($penjualan_list->kode_penjualan->Visible) { // kode_penjualan ?>
		<td data-name="kode_penjualan" <?php echo $penjualan_list->kode_penjualan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_kode_penjualan">
<span<?php echo $penjualan_list->kode_penjualan->viewAttributes() ?>><?php echo $penjualan_list->kode_penjualan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $penjualan_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_id_pelanggan">
<span<?php echo $penjualan_list->id_pelanggan->viewAttributes() ?>><?php echo $penjualan_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->waktu->Visible) { // waktu ?>
		<td data-name="waktu" <?php echo $penjualan_list->waktu->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_waktu">
<span<?php echo $penjualan_list->waktu->viewAttributes() ?>><?php echo $penjualan_list->waktu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $penjualan_list->total->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_total">
<span<?php echo $penjualan_list->total->viewAttributes() ?>><?php echo $penjualan_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->bayar->Visible) { // bayar ?>
		<td data-name="bayar" <?php echo $penjualan_list->bayar->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_bayar">
<span<?php echo $penjualan_list->bayar->viewAttributes() ?>><?php echo $penjualan_list->bayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
		<td data-name="total_non_tunai_charge" <?php echo $penjualan_list->total_non_tunai_charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_total_non_tunai_charge">
<span<?php echo $penjualan_list->total_non_tunai_charge->viewAttributes() ?>><?php echo $penjualan_list->total_non_tunai_charge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->metode_pembayaran->Visible) { // metode_pembayaran ?>
		<td data-name="metode_pembayaran" <?php echo $penjualan_list->metode_pembayaran->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_metode_pembayaran">
<span<?php echo $penjualan_list->metode_pembayaran->viewAttributes() ?>><?php echo $penjualan_list->metode_pembayaran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->jumlah_voucher->Visible) { // jumlah_voucher ?>
		<td data-name="jumlah_voucher" <?php echo $penjualan_list->jumlah_voucher->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_jumlah_voucher">
<span<?php echo $penjualan_list->jumlah_voucher->viewAttributes() ?>><?php echo $penjualan_list->jumlah_voucher->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->id_kartubank->Visible) { // id_kartubank ?>
		<td data-name="id_kartubank" <?php echo $penjualan_list->id_kartubank->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_id_kartubank">
<span<?php echo $penjualan_list->id_kartubank->viewAttributes() ?>><?php echo $penjualan_list->id_kartubank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->id_kas->Visible) { // id_kas ?>
		<td data-name="id_kas" <?php echo $penjualan_list->id_kas->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_id_kas">
<span<?php echo $penjualan_list->id_kas->viewAttributes() ?>><?php echo $penjualan_list->id_kas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->charge->Visible) { // charge ?>
		<td data-name="charge" <?php echo $penjualan_list->charge->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_charge">
<span<?php echo $penjualan_list->charge->viewAttributes() ?>><?php echo $penjualan_list->charge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->klaim_poin->Visible) { // klaim_poin ?>
		<td data-name="klaim_poin" <?php echo $penjualan_list->klaim_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_klaim_poin">
<span<?php echo $penjualan_list->klaim_poin->viewAttributes() ?>><?php echo $penjualan_list->klaim_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
		<td data-name="total_penukaran_poin" <?php echo $penjualan_list->total_penukaran_poin->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_total_penukaran_poin">
<span<?php echo $penjualan_list->total_penukaran_poin->viewAttributes() ?>><?php echo $penjualan_list->total_penukaran_poin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penjualan_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $penjualan_list->status->cellAttributes() ?>>
<span id="el<?php echo $penjualan_list->RowCount ?>_penjualan_status">
<span<?php echo $penjualan_list->status->viewAttributes() ?>><?php echo $penjualan_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penjualan_list->ListOptions->render("body", "right", $penjualan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penjualan_list->isGridAdd())
		$penjualan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penjualan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penjualan_list->Recordset)
	$penjualan_list->Recordset->Close();
?>
<?php if (!$penjualan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penjualan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penjualan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penjualan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penjualan_list->TotalRecords == 0 && !$penjualan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penjualan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penjualan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penjualan_list->isExport()) { ?>
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
$penjualan_list->terminate();
?>