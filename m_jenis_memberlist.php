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
$m_jenis_member_list = new m_jenis_member_list();

// Run the page
$m_jenis_member_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jenis_member_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_jenis_member_list->isExport()) { ?>
<script>
var fm_jenis_memberlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_jenis_memberlist = currentForm = new ew.Form("fm_jenis_memberlist", "list");
	fm_jenis_memberlist.formKeyCountName = '<?php echo $m_jenis_member_list->FormKeyCountName ?>';
	loadjs.done("fm_jenis_memberlist");
});
var fm_jenis_memberlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_jenis_memberlistsrch = currentSearchForm = new ew.Form("fm_jenis_memberlistsrch");

	// Dynamic selection lists
	// Filters

	fm_jenis_memberlistsrch.filterList = <?php echo $m_jenis_member_list->getFilterList() ?>;
	loadjs.done("fm_jenis_memberlistsrch");
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
<?php if (!$m_jenis_member_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_jenis_member_list->TotalRecords > 0 && $m_jenis_member_list->ExportOptions->visible()) { ?>
<?php $m_jenis_member_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_jenis_member_list->ImportOptions->visible()) { ?>
<?php $m_jenis_member_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_jenis_member_list->SearchOptions->visible()) { ?>
<?php $m_jenis_member_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_jenis_member_list->FilterOptions->visible()) { ?>
<?php $m_jenis_member_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_jenis_member_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_jenis_member_list->isExport() && !$m_jenis_member->CurrentAction) { ?>
<form name="fm_jenis_memberlistsrch" id="fm_jenis_memberlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_jenis_memberlistsrch-search-panel" class="<?php echo $m_jenis_member_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_jenis_member">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_jenis_member_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_jenis_member_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_jenis_member_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_jenis_member_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_jenis_member_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_jenis_member_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_jenis_member_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_jenis_member_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_jenis_member_list->showPageHeader(); ?>
<?php
$m_jenis_member_list->showMessage();
?>
<?php if ($m_jenis_member_list->TotalRecords > 0 || $m_jenis_member->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_jenis_member_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_jenis_member">
<?php if (!$m_jenis_member_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_jenis_member_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_jenis_member_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_jenis_member_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_jenis_memberlist" id="fm_jenis_memberlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jenis_member">
<div id="gmp_m_jenis_member" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_jenis_member_list->TotalRecords > 0 || $m_jenis_member_list->isGridEdit()) { ?>
<table id="tbl_m_jenis_memberlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_jenis_member->RowType = ROWTYPE_HEADER;

// Render list options
$m_jenis_member_list->renderListOptions();

// Render list options (header, left)
$m_jenis_member_list->ListOptions->render("header", "left");
?>
<?php if ($m_jenis_member_list->nama_member->Visible) { // nama_member ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->nama_member) == "") { ?>
		<th data-name="nama_member" class="<?php echo $m_jenis_member_list->nama_member->headerCellClass() ?>"><div id="elh_m_jenis_member_nama_member" class="m_jenis_member_nama_member"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->nama_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_member" class="<?php echo $m_jenis_member_list->nama_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->nama_member) ?>', 1);"><div id="elh_m_jenis_member_nama_member" class="m_jenis_member_nama_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->nama_member->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->nama_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->nama_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->member_selanjutnya->Visible) { // member_selanjutnya ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->member_selanjutnya) == "") { ?>
		<th data-name="member_selanjutnya" class="<?php echo $m_jenis_member_list->member_selanjutnya->headerCellClass() ?>"><div id="elh_m_jenis_member_member_selanjutnya" class="m_jenis_member_member_selanjutnya"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->member_selanjutnya->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="member_selanjutnya" class="<?php echo $m_jenis_member_list->member_selanjutnya->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->member_selanjutnya) ?>', 1);"><div id="elh_m_jenis_member_member_selanjutnya" class="m_jenis_member_member_selanjutnya">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->member_selanjutnya->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->member_selanjutnya->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->member_selanjutnya->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->nominal_bawah->Visible) { // nominal_bawah ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->nominal_bawah) == "") { ?>
		<th data-name="nominal_bawah" class="<?php echo $m_jenis_member_list->nominal_bawah->headerCellClass() ?>"><div id="elh_m_jenis_member_nominal_bawah" class="m_jenis_member_nominal_bawah"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->nominal_bawah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nominal_bawah" class="<?php echo $m_jenis_member_list->nominal_bawah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->nominal_bawah) ?>', 1);"><div id="elh_m_jenis_member_nominal_bawah" class="m_jenis_member_nominal_bawah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->nominal_bawah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->nominal_bawah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->nominal_bawah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->nominal_atas->Visible) { // nominal_atas ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->nominal_atas) == "") { ?>
		<th data-name="nominal_atas" class="<?php echo $m_jenis_member_list->nominal_atas->headerCellClass() ?>"><div id="elh_m_jenis_member_nominal_atas" class="m_jenis_member_nominal_atas"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->nominal_atas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nominal_atas" class="<?php echo $m_jenis_member_list->nominal_atas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->nominal_atas) ?>', 1);"><div id="elh_m_jenis_member_nominal_atas" class="m_jenis_member_nominal_atas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->nominal_atas->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->nominal_atas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->nominal_atas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->qty_bawah->Visible) { // qty_bawah ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->qty_bawah) == "") { ?>
		<th data-name="qty_bawah" class="<?php echo $m_jenis_member_list->qty_bawah->headerCellClass() ?>"><div id="elh_m_jenis_member_qty_bawah" class="m_jenis_member_qty_bawah"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->qty_bawah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_bawah" class="<?php echo $m_jenis_member_list->qty_bawah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->qty_bawah) ?>', 1);"><div id="elh_m_jenis_member_qty_bawah" class="m_jenis_member_qty_bawah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->qty_bawah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->qty_bawah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->qty_bawah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->qty_atas->Visible) { // qty_atas ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->qty_atas) == "") { ?>
		<th data-name="qty_atas" class="<?php echo $m_jenis_member_list->qty_atas->headerCellClass() ?>"><div id="elh_m_jenis_member_qty_atas" class="m_jenis_member_qty_atas"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->qty_atas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_atas" class="<?php echo $m_jenis_member_list->qty_atas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->qty_atas) ?>', 1);"><div id="elh_m_jenis_member_qty_atas" class="m_jenis_member_qty_atas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->qty_atas->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->qty_atas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->qty_atas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->disc_prosen->Visible) { // disc_prosen ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->disc_prosen) == "") { ?>
		<th data-name="disc_prosen" class="<?php echo $m_jenis_member_list->disc_prosen->headerCellClass() ?>"><div id="elh_m_jenis_member_disc_prosen" class="m_jenis_member_disc_prosen"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->disc_prosen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_prosen" class="<?php echo $m_jenis_member_list->disc_prosen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->disc_prosen) ?>', 1);"><div id="elh_m_jenis_member_disc_prosen" class="m_jenis_member_disc_prosen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->disc_prosen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->disc_prosen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->disc_prosen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->disc_nominal->Visible) { // disc_nominal ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->disc_nominal) == "") { ?>
		<th data-name="disc_nominal" class="<?php echo $m_jenis_member_list->disc_nominal->headerCellClass() ?>"><div id="elh_m_jenis_member_disc_nominal" class="m_jenis_member_disc_nominal"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->disc_nominal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_nominal" class="<?php echo $m_jenis_member_list->disc_nominal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->disc_nominal) ?>', 1);"><div id="elh_m_jenis_member_disc_nominal" class="m_jenis_member_disc_nominal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->disc_nominal->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->disc_nominal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->disc_nominal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->jangka_waktu->Visible) { // jangka_waktu ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->jangka_waktu) == "") { ?>
		<th data-name="jangka_waktu" class="<?php echo $m_jenis_member_list->jangka_waktu->headerCellClass() ?>"><div id="elh_m_jenis_member_jangka_waktu" class="m_jenis_member_jangka_waktu"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->jangka_waktu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jangka_waktu" class="<?php echo $m_jenis_member_list->jangka_waktu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->jangka_waktu) ?>', 1);"><div id="elh_m_jenis_member_jangka_waktu" class="m_jenis_member_jangka_waktu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->jangka_waktu->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->jangka_waktu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->jangka_waktu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->min_kedatangan->Visible) { // min_kedatangan ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->min_kedatangan) == "") { ?>
		<th data-name="min_kedatangan" class="<?php echo $m_jenis_member_list->min_kedatangan->headerCellClass() ?>"><div id="elh_m_jenis_member_min_kedatangan" class="m_jenis_member_min_kedatangan"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->min_kedatangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="min_kedatangan" class="<?php echo $m_jenis_member_list->min_kedatangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->min_kedatangan) ?>', 1);"><div id="elh_m_jenis_member_min_kedatangan" class="m_jenis_member_min_kedatangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->min_kedatangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->min_kedatangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->min_kedatangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_jenis_member_list->poin_member->Visible) { // poin_member ?>
	<?php if ($m_jenis_member_list->SortUrl($m_jenis_member_list->poin_member) == "") { ?>
		<th data-name="poin_member" class="<?php echo $m_jenis_member_list->poin_member->headerCellClass() ?>"><div id="elh_m_jenis_member_poin_member" class="m_jenis_member_poin_member"><div class="ew-table-header-caption"><?php echo $m_jenis_member_list->poin_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_member" class="<?php echo $m_jenis_member_list->poin_member->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_jenis_member_list->SortUrl($m_jenis_member_list->poin_member) ?>', 1);"><div id="elh_m_jenis_member_poin_member" class="m_jenis_member_poin_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_jenis_member_list->poin_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_jenis_member_list->poin_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_jenis_member_list->poin_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_jenis_member_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_jenis_member_list->ExportAll && $m_jenis_member_list->isExport()) {
	$m_jenis_member_list->StopRecord = $m_jenis_member_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_jenis_member_list->TotalRecords > $m_jenis_member_list->StartRecord + $m_jenis_member_list->DisplayRecords - 1)
		$m_jenis_member_list->StopRecord = $m_jenis_member_list->StartRecord + $m_jenis_member_list->DisplayRecords - 1;
	else
		$m_jenis_member_list->StopRecord = $m_jenis_member_list->TotalRecords;
}
$m_jenis_member_list->RecordCount = $m_jenis_member_list->StartRecord - 1;
if ($m_jenis_member_list->Recordset && !$m_jenis_member_list->Recordset->EOF) {
	$m_jenis_member_list->Recordset->moveFirst();
	$selectLimit = $m_jenis_member_list->UseSelectLimit;
	if (!$selectLimit && $m_jenis_member_list->StartRecord > 1)
		$m_jenis_member_list->Recordset->move($m_jenis_member_list->StartRecord - 1);
} elseif (!$m_jenis_member->AllowAddDeleteRow && $m_jenis_member_list->StopRecord == 0) {
	$m_jenis_member_list->StopRecord = $m_jenis_member->GridAddRowCount;
}

// Initialize aggregate
$m_jenis_member->RowType = ROWTYPE_AGGREGATEINIT;
$m_jenis_member->resetAttributes();
$m_jenis_member_list->renderRow();
while ($m_jenis_member_list->RecordCount < $m_jenis_member_list->StopRecord) {
	$m_jenis_member_list->RecordCount++;
	if ($m_jenis_member_list->RecordCount >= $m_jenis_member_list->StartRecord) {
		$m_jenis_member_list->RowCount++;

		// Set up key count
		$m_jenis_member_list->KeyCount = $m_jenis_member_list->RowIndex;

		// Init row class and style
		$m_jenis_member->resetAttributes();
		$m_jenis_member->CssClass = "";
		if ($m_jenis_member_list->isGridAdd()) {
		} else {
			$m_jenis_member_list->loadRowValues($m_jenis_member_list->Recordset); // Load row values
		}
		$m_jenis_member->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_jenis_member->RowAttrs->merge(["data-rowindex" => $m_jenis_member_list->RowCount, "id" => "r" . $m_jenis_member_list->RowCount . "_m_jenis_member", "data-rowtype" => $m_jenis_member->RowType]);

		// Render row
		$m_jenis_member_list->renderRow();

		// Render list options
		$m_jenis_member_list->renderListOptions();
?>
	<tr <?php echo $m_jenis_member->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_jenis_member_list->ListOptions->render("body", "left", $m_jenis_member_list->RowCount);
?>
	<?php if ($m_jenis_member_list->nama_member->Visible) { // nama_member ?>
		<td data-name="nama_member" <?php echo $m_jenis_member_list->nama_member->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_nama_member">
<span<?php echo $m_jenis_member_list->nama_member->viewAttributes() ?>><?php echo $m_jenis_member_list->nama_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->member_selanjutnya->Visible) { // member_selanjutnya ?>
		<td data-name="member_selanjutnya" <?php echo $m_jenis_member_list->member_selanjutnya->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_member_selanjutnya">
<span<?php echo $m_jenis_member_list->member_selanjutnya->viewAttributes() ?>><?php echo $m_jenis_member_list->member_selanjutnya->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->nominal_bawah->Visible) { // nominal_bawah ?>
		<td data-name="nominal_bawah" <?php echo $m_jenis_member_list->nominal_bawah->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_nominal_bawah">
<span<?php echo $m_jenis_member_list->nominal_bawah->viewAttributes() ?>><?php echo $m_jenis_member_list->nominal_bawah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->nominal_atas->Visible) { // nominal_atas ?>
		<td data-name="nominal_atas" <?php echo $m_jenis_member_list->nominal_atas->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_nominal_atas">
<span<?php echo $m_jenis_member_list->nominal_atas->viewAttributes() ?>><?php echo $m_jenis_member_list->nominal_atas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->qty_bawah->Visible) { // qty_bawah ?>
		<td data-name="qty_bawah" <?php echo $m_jenis_member_list->qty_bawah->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_qty_bawah">
<span<?php echo $m_jenis_member_list->qty_bawah->viewAttributes() ?>><?php echo $m_jenis_member_list->qty_bawah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->qty_atas->Visible) { // qty_atas ?>
		<td data-name="qty_atas" <?php echo $m_jenis_member_list->qty_atas->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_qty_atas">
<span<?php echo $m_jenis_member_list->qty_atas->viewAttributes() ?>><?php echo $m_jenis_member_list->qty_atas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->disc_prosen->Visible) { // disc_prosen ?>
		<td data-name="disc_prosen" <?php echo $m_jenis_member_list->disc_prosen->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_disc_prosen">
<span<?php echo $m_jenis_member_list->disc_prosen->viewAttributes() ?>><?php echo $m_jenis_member_list->disc_prosen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->disc_nominal->Visible) { // disc_nominal ?>
		<td data-name="disc_nominal" <?php echo $m_jenis_member_list->disc_nominal->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_disc_nominal">
<span<?php echo $m_jenis_member_list->disc_nominal->viewAttributes() ?>><?php echo $m_jenis_member_list->disc_nominal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->jangka_waktu->Visible) { // jangka_waktu ?>
		<td data-name="jangka_waktu" <?php echo $m_jenis_member_list->jangka_waktu->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_jangka_waktu">
<span<?php echo $m_jenis_member_list->jangka_waktu->viewAttributes() ?>><?php echo $m_jenis_member_list->jangka_waktu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->min_kedatangan->Visible) { // min_kedatangan ?>
		<td data-name="min_kedatangan" <?php echo $m_jenis_member_list->min_kedatangan->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_min_kedatangan">
<span<?php echo $m_jenis_member_list->min_kedatangan->viewAttributes() ?>><?php echo $m_jenis_member_list->min_kedatangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_jenis_member_list->poin_member->Visible) { // poin_member ?>
		<td data-name="poin_member" <?php echo $m_jenis_member_list->poin_member->cellAttributes() ?>>
<span id="el<?php echo $m_jenis_member_list->RowCount ?>_m_jenis_member_poin_member">
<span<?php echo $m_jenis_member_list->poin_member->viewAttributes() ?>><?php echo $m_jenis_member_list->poin_member->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_jenis_member_list->ListOptions->render("body", "right", $m_jenis_member_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_jenis_member_list->isGridAdd())
		$m_jenis_member_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_jenis_member->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_jenis_member_list->Recordset)
	$m_jenis_member_list->Recordset->Close();
?>
<?php if (!$m_jenis_member_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_jenis_member_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_jenis_member_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_jenis_member_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_jenis_member_list->TotalRecords == 0 && !$m_jenis_member->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_jenis_member_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_jenis_member_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_jenis_member_list->isExport()) { ?>
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
$m_jenis_member_list->terminate();
?>