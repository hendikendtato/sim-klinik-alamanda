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
$view_member_list = new view_member_list();

// Run the page
$view_member_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_member_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view_member_list->isExport()) { ?>
<script>
var fview_memberlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview_memberlist = currentForm = new ew.Form("fview_memberlist", "list");
	fview_memberlist.formKeyCountName = '<?php echo $view_member_list->FormKeyCountName ?>';
	loadjs.done("fview_memberlist");
});
var fview_memberlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview_memberlistsrch = currentSearchForm = new ew.Form("fview_memberlistsrch");

	// Dynamic selection lists
	// Filters

	fview_memberlistsrch.filterList = <?php echo $view_member_list->getFilterList() ?>;
	loadjs.done("fview_memberlistsrch");
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
<?php if (!$view_member_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view_member_list->TotalRecords > 0 && $view_member_list->ExportOptions->visible()) { ?>
<?php $view_member_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view_member_list->ImportOptions->visible()) { ?>
<?php $view_member_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view_member_list->SearchOptions->visible()) { ?>
<?php $view_member_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view_member_list->FilterOptions->visible()) { ?>
<?php $view_member_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view_member_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view_member_list->isExport() && !$view_member->CurrentAction) { ?>
<form name="fview_memberlistsrch" id="fview_memberlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview_memberlistsrch-search-panel" class="<?php echo $view_member_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view_member">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $view_member_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($view_member_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($view_member_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $view_member_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($view_member_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($view_member_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($view_member_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($view_member_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view_member_list->showPageHeader(); ?>
<?php
$view_member_list->showMessage();
?>
<?php if ($view_member_list->TotalRecords > 0 || $view_member->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view_member_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view_member">
<?php if (!$view_member_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view_member_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_member_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_member_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview_memberlist" id="fview_memberlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_member">
<div id="gmp_view_member" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view_member_list->TotalRecords > 0 || $view_member_list->isGridEdit()) { ?>
<table id="tbl_view_memberlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view_member->RowType = ROWTYPE_HEADER;

// Render list options
$view_member_list->renderListOptions();

// Render list options (header, left)
$view_member_list->ListOptions->render("header", "left");
?>
<?php if ($view_member_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($view_member_list->SortUrl($view_member_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $view_member_list->id_pelanggan->headerCellClass() ?>"><div id="elh_view_member_id_pelanggan" class="view_member_id_pelanggan"><div class="ew-table-header-caption"><?php echo $view_member_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $view_member_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->id_pelanggan) ?>', 1);"><div id="elh_view_member_id_pelanggan" class="view_member_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<?php if ($view_member_list->SortUrl($view_member_list->nama_pelanggan) == "") { ?>
		<th data-name="nama_pelanggan" class="<?php echo $view_member_list->nama_pelanggan->headerCellClass() ?>"><div id="elh_view_member_nama_pelanggan" class="view_member_nama_pelanggan"><div class="ew-table-header-caption"><?php echo $view_member_list->nama_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pelanggan" class="<?php echo $view_member_list->nama_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->nama_pelanggan) ?>', 1);"><div id="elh_view_member_nama_pelanggan" class="view_member_nama_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->nama_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->nama_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->nama_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->kode_member->Visible) { // kode_member ?>
	<?php if ($view_member_list->SortUrl($view_member_list->kode_member) == "") { ?>
		<th data-name="kode_member" class="<?php echo $view_member_list->kode_member->headerCellClass() ?>"><div id="elh_view_member_kode_member" class="view_member_kode_member"><div class="ew-table-header-caption"><?php echo $view_member_list->kode_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_member" class="<?php echo $view_member_list->kode_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->kode_member) ?>', 1);"><div id="elh_view_member_kode_member" class="view_member_kode_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->kode_member->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->kode_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->kode_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($view_member_list->SortUrl($view_member_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $view_member_list->id_klinik->headerCellClass() ?>"><div id="elh_view_member_id_klinik" class="view_member_id_klinik"><div class="ew-table-header-caption"><?php echo $view_member_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $view_member_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->id_klinik) ?>', 1);"><div id="elh_view_member_id_klinik" class="view_member_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->jenis_member->Visible) { // jenis_member ?>
	<?php if ($view_member_list->SortUrl($view_member_list->jenis_member) == "") { ?>
		<th data-name="jenis_member" class="<?php echo $view_member_list->jenis_member->headerCellClass() ?>"><div id="elh_view_member_jenis_member" class="view_member_jenis_member"><div class="ew-table-header-caption"><?php echo $view_member_list->jenis_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_member" class="<?php echo $view_member_list->jenis_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->jenis_member) ?>', 1);"><div id="elh_view_member_jenis_member" class="view_member_jenis_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->jenis_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->jenis_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->jenis_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->tgl_mulai->Visible) { // tgl_mulai ?>
	<?php if ($view_member_list->SortUrl($view_member_list->tgl_mulai) == "") { ?>
		<th data-name="tgl_mulai" class="<?php echo $view_member_list->tgl_mulai->headerCellClass() ?>"><div id="elh_view_member_tgl_mulai" class="view_member_tgl_mulai"><div class="ew-table-header-caption"><?php echo $view_member_list->tgl_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_mulai" class="<?php echo $view_member_list->tgl_mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->tgl_mulai) ?>', 1);"><div id="elh_view_member_tgl_mulai" class="view_member_tgl_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->tgl_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->tgl_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->tgl_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($view_member_list->SortUrl($view_member_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $view_member_list->tgl_akhir->headerCellClass() ?>"><div id="elh_view_member_tgl_akhir" class="view_member_tgl_akhir"><div class="ew-table-header-caption"><?php echo $view_member_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $view_member_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->tgl_akhir) ?>', 1);"><div id="elh_view_member_tgl_akhir" class="view_member_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->disc_prosen->Visible) { // disc_prosen ?>
	<?php if ($view_member_list->SortUrl($view_member_list->disc_prosen) == "") { ?>
		<th data-name="disc_prosen" class="<?php echo $view_member_list->disc_prosen->headerCellClass() ?>"><div id="elh_view_member_disc_prosen" class="view_member_disc_prosen"><div class="ew-table-header-caption"><?php echo $view_member_list->disc_prosen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_prosen" class="<?php echo $view_member_list->disc_prosen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->disc_prosen) ?>', 1);"><div id="elh_view_member_disc_prosen" class="view_member_disc_prosen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->disc_prosen->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->disc_prosen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->disc_prosen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->disc_nominal->Visible) { // disc_nominal ?>
	<?php if ($view_member_list->SortUrl($view_member_list->disc_nominal) == "") { ?>
		<th data-name="disc_nominal" class="<?php echo $view_member_list->disc_nominal->headerCellClass() ?>"><div id="elh_view_member_disc_nominal" class="view_member_disc_nominal"><div class="ew-table-header-caption"><?php echo $view_member_list->disc_nominal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_nominal" class="<?php echo $view_member_list->disc_nominal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->disc_nominal) ?>', 1);"><div id="elh_view_member_disc_nominal" class="view_member_disc_nominal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->disc_nominal->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->disc_nominal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->disc_nominal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->poin_member->Visible) { // poin_member ?>
	<?php if ($view_member_list->SortUrl($view_member_list->poin_member) == "") { ?>
		<th data-name="poin_member" class="<?php echo $view_member_list->poin_member->headerCellClass() ?>"><div id="elh_view_member_poin_member" class="view_member_poin_member"><div class="ew-table-header-caption"><?php echo $view_member_list->poin_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_member" class="<?php echo $view_member_list->poin_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->poin_member) ?>', 1);"><div id="elh_view_member_poin_member" class="view_member_poin_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->poin_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->poin_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->poin_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
	<?php if ($view_member_list->SortUrl($view_member_list->tgl_awal_transaksi) == "") { ?>
		<th data-name="tgl_awal_transaksi" class="<?php echo $view_member_list->tgl_awal_transaksi->headerCellClass() ?>"><div id="elh_view_member_tgl_awal_transaksi" class="view_member_tgl_awal_transaksi"><div class="ew-table-header-caption"><?php echo $view_member_list->tgl_awal_transaksi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_awal_transaksi" class="<?php echo $view_member_list->tgl_awal_transaksi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->tgl_awal_transaksi) ?>', 1);"><div id="elh_view_member_tgl_awal_transaksi" class="view_member_tgl_awal_transaksi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->tgl_awal_transaksi->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->tgl_awal_transaksi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->tgl_awal_transaksi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->total_akumulasi->Visible) { // total_akumulasi ?>
	<?php if ($view_member_list->SortUrl($view_member_list->total_akumulasi) == "") { ?>
		<th data-name="total_akumulasi" class="<?php echo $view_member_list->total_akumulasi->headerCellClass() ?>"><div id="elh_view_member_total_akumulasi" class="view_member_total_akumulasi"><div class="ew-table-header-caption"><?php echo $view_member_list->total_akumulasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_akumulasi" class="<?php echo $view_member_list->total_akumulasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->total_akumulasi) ?>', 1);"><div id="elh_view_member_total_akumulasi" class="view_member_total_akumulasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->total_akumulasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->total_akumulasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->total_akumulasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view_member_list->id->Visible) { // id ?>
	<?php if ($view_member_list->SortUrl($view_member_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $view_member_list->id->headerCellClass() ?>"><div id="elh_view_member_id" class="view_member_id"><div class="ew-table-header-caption"><?php echo $view_member_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $view_member_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view_member_list->SortUrl($view_member_list->id) ?>', 1);"><div id="elh_view_member_id" class="view_member_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view_member_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($view_member_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view_member_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view_member_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view_member_list->ExportAll && $view_member_list->isExport()) {
	$view_member_list->StopRecord = $view_member_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view_member_list->TotalRecords > $view_member_list->StartRecord + $view_member_list->DisplayRecords - 1)
		$view_member_list->StopRecord = $view_member_list->StartRecord + $view_member_list->DisplayRecords - 1;
	else
		$view_member_list->StopRecord = $view_member_list->TotalRecords;
}
$view_member_list->RecordCount = $view_member_list->StartRecord - 1;
if ($view_member_list->Recordset && !$view_member_list->Recordset->EOF) {
	$view_member_list->Recordset->moveFirst();
	$selectLimit = $view_member_list->UseSelectLimit;
	if (!$selectLimit && $view_member_list->StartRecord > 1)
		$view_member_list->Recordset->move($view_member_list->StartRecord - 1);
} elseif (!$view_member->AllowAddDeleteRow && $view_member_list->StopRecord == 0) {
	$view_member_list->StopRecord = $view_member->GridAddRowCount;
}

// Initialize aggregate
$view_member->RowType = ROWTYPE_AGGREGATEINIT;
$view_member->resetAttributes();
$view_member_list->renderRow();
while ($view_member_list->RecordCount < $view_member_list->StopRecord) {
	$view_member_list->RecordCount++;
	if ($view_member_list->RecordCount >= $view_member_list->StartRecord) {
		$view_member_list->RowCount++;

		// Set up key count
		$view_member_list->KeyCount = $view_member_list->RowIndex;

		// Init row class and style
		$view_member->resetAttributes();
		$view_member->CssClass = "";
		if ($view_member_list->isGridAdd()) {
		} else {
			$view_member_list->loadRowValues($view_member_list->Recordset); // Load row values
		}
		$view_member->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view_member->RowAttrs->merge(["data-rowindex" => $view_member_list->RowCount, "id" => "r" . $view_member_list->RowCount . "_view_member", "data-rowtype" => $view_member->RowType]);

		// Render row
		$view_member_list->renderRow();

		// Render list options
		$view_member_list->renderListOptions();
?>
	<tr <?php echo $view_member->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view_member_list->ListOptions->render("body", "left", $view_member_list->RowCount);
?>
	<?php if ($view_member_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $view_member_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_id_pelanggan">
<span<?php echo $view_member_list->id_pelanggan->viewAttributes() ?>><?php echo $view_member_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->nama_pelanggan->Visible) { // nama_pelanggan ?>
		<td data-name="nama_pelanggan" <?php echo $view_member_list->nama_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_nama_pelanggan">
<span<?php echo $view_member_list->nama_pelanggan->viewAttributes() ?>><?php echo $view_member_list->nama_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->kode_member->Visible) { // kode_member ?>
		<td data-name="kode_member" <?php echo $view_member_list->kode_member->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_kode_member">
<span<?php echo $view_member_list->kode_member->viewAttributes() ?>><?php echo $view_member_list->kode_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $view_member_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_id_klinik">
<span<?php echo $view_member_list->id_klinik->viewAttributes() ?>><?php echo $view_member_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->jenis_member->Visible) { // jenis_member ?>
		<td data-name="jenis_member" <?php echo $view_member_list->jenis_member->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_jenis_member">
<span<?php echo $view_member_list->jenis_member->viewAttributes() ?>><?php echo $view_member_list->jenis_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->tgl_mulai->Visible) { // tgl_mulai ?>
		<td data-name="tgl_mulai" <?php echo $view_member_list->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_tgl_mulai">
<span<?php echo $view_member_list->tgl_mulai->viewAttributes() ?>><?php echo $view_member_list->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $view_member_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_tgl_akhir">
<span<?php echo $view_member_list->tgl_akhir->viewAttributes() ?>><?php echo $view_member_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->disc_prosen->Visible) { // disc_prosen ?>
		<td data-name="disc_prosen" <?php echo $view_member_list->disc_prosen->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_disc_prosen">
<span<?php echo $view_member_list->disc_prosen->viewAttributes() ?>><?php echo $view_member_list->disc_prosen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->disc_nominal->Visible) { // disc_nominal ?>
		<td data-name="disc_nominal" <?php echo $view_member_list->disc_nominal->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_disc_nominal">
<span<?php echo $view_member_list->disc_nominal->viewAttributes() ?>><?php echo $view_member_list->disc_nominal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->poin_member->Visible) { // poin_member ?>
		<td data-name="poin_member" <?php echo $view_member_list->poin_member->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_poin_member">
<span<?php echo $view_member_list->poin_member->viewAttributes() ?>><?php echo $view_member_list->poin_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
		<td data-name="tgl_awal_transaksi" <?php echo $view_member_list->tgl_awal_transaksi->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_tgl_awal_transaksi">
<span<?php echo $view_member_list->tgl_awal_transaksi->viewAttributes() ?>><?php echo $view_member_list->tgl_awal_transaksi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->total_akumulasi->Visible) { // total_akumulasi ?>
		<td data-name="total_akumulasi" <?php echo $view_member_list->total_akumulasi->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_total_akumulasi">
<span<?php echo $view_member_list->total_akumulasi->viewAttributes() ?>><?php echo $view_member_list->total_akumulasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view_member_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $view_member_list->id->cellAttributes() ?>>
<span id="el<?php echo $view_member_list->RowCount ?>_view_member_id">
<span<?php echo $view_member_list->id->viewAttributes() ?>><?php echo $view_member_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view_member_list->ListOptions->render("body", "right", $view_member_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view_member_list->isGridAdd())
		$view_member_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view_member->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view_member_list->Recordset)
	$view_member_list->Recordset->Close();
?>
<?php if (!$view_member_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$view_member_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view_member_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view_member_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view_member_list->TotalRecords == 0 && !$view_member->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view_member_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view_member_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view_member_list->isExport()) { ?>
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
$view_member_list->terminate();
?>