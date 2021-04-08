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
$m_hargajual_list = new m_hargajual_list();

// Run the page
$m_hargajual_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_hargajual_list->isExport()) { ?>
<script>
var fm_hargajuallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_hargajuallist = currentForm = new ew.Form("fm_hargajuallist", "list");
	fm_hargajuallist.formKeyCountName = '<?php echo $m_hargajual_list->FormKeyCountName ?>';
	loadjs.done("fm_hargajuallist");
});
var fm_hargajuallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_hargajuallistsrch = currentSearchForm = new ew.Form("fm_hargajuallistsrch");

	// Validate function for search
	fm_hargajuallistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_hargajuallistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_hargajuallistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_hargajuallistsrch.lists["x_id_barang"] = <?php echo $m_hargajual_list->id_barang->Lookup->toClientList($m_hargajual_list) ?>;
	fm_hargajuallistsrch.lists["x_id_barang"].options = <?php echo JsonEncode($m_hargajual_list->id_barang->lookupOptions()) ?>;

	// Filters
	fm_hargajuallistsrch.filterList = <?php echo $m_hargajual_list->getFilterList() ?>;
	loadjs.done("fm_hargajuallistsrch");
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
<?php if (!$m_hargajual_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_hargajual_list->TotalRecords > 0 && $m_hargajual_list->ExportOptions->visible()) { ?>
<?php $m_hargajual_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_hargajual_list->ImportOptions->visible()) { ?>
<?php $m_hargajual_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_hargajual_list->SearchOptions->visible()) { ?>
<?php $m_hargajual_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_hargajual_list->FilterOptions->visible()) { ?>
<?php $m_hargajual_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_hargajual_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_hargajual_list->isExport() && !$m_hargajual->CurrentAction) { ?>
<form name="fm_hargajuallistsrch" id="fm_hargajuallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_hargajuallistsrch-search-panel" class="<?php echo $m_hargajual_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_hargajual">
	<div class="ew-extended-search">
<?php

// Render search row
$m_hargajual->RowType = ROWTYPE_SEARCH;
$m_hargajual->resetAttributes();
$m_hargajual_list->renderRow();
?>
<?php if ($m_hargajual_list->id_barang->Visible) { // id_barang ?>
	<?php
		$m_hargajual_list->SearchColumnCount++;
		if (($m_hargajual_list->SearchColumnCount - 1) % $m_hargajual_list->SearchFieldsPerRow == 0) {
			$m_hargajual_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $m_hargajual_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_id_barang" class="ew-cell form-group">
		<label for="x_id_barang" class="ew-search-caption ew-label"><?php echo $m_hargajual_list->id_barang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		<span id="el_m_hargajual_id_barang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($m_hargajual_list->id_barang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_hargajual_list->id_barang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_hargajual_list->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_hargajual_list->id_barang->ReadOnly || $m_hargajual_list->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_hargajual_list->id_barang->Lookup->getParamTag($m_hargajual_list, "p_x_id_barang") ?>
<input type="hidden" data-table="m_hargajual" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_hargajual_list->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $m_hargajual_list->id_barang->AdvancedSearch->SearchValue ?>"<?php echo $m_hargajual_list->id_barang->editAttributes() ?>>
</span>
	</div>
	<?php if ($m_hargajual_list->SearchColumnCount % $m_hargajual_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($m_hargajual_list->SearchColumnCount % $m_hargajual_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $m_hargajual_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_hargajual_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_hargajual_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_hargajual_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_hargajual_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_hargajual_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_hargajual_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_hargajual_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_hargajual_list->showPageHeader(); ?>
<?php
$m_hargajual_list->showMessage();
?>
<?php if ($m_hargajual_list->TotalRecords > 0 || $m_hargajual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_hargajual_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_hargajual">
<?php if (!$m_hargajual_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_hargajual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_hargajual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_hargajual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_hargajuallist" id="fm_hargajuallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual">
<div id="gmp_m_hargajual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_hargajual_list->TotalRecords > 0 || $m_hargajual_list->isGridEdit()) { ?>
<table id="tbl_m_hargajuallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_hargajual->RowType = ROWTYPE_HEADER;

// Render list options
$m_hargajual_list->renderListOptions();

// Render list options (header, left)
$m_hargajual_list->ListOptions->render("header", "left");
?>
<?php if ($m_hargajual_list->id_barang->Visible) { // id_barang ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $m_hargajual_list->id_barang->headerCellClass() ?>"><div id="elh_m_hargajual_id_barang" class="m_hargajual_id_barang"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $m_hargajual_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->id_barang) ?>', 1);"><div id="elh_m_hargajual_id_barang" class="m_hargajual_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->totalhargajual->Visible) { // totalhargajual ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->totalhargajual) == "") { ?>
		<th data-name="totalhargajual" class="<?php echo $m_hargajual_list->totalhargajual->headerCellClass() ?>"><div id="elh_m_hargajual_totalhargajual" class="m_hargajual_totalhargajual"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->totalhargajual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="totalhargajual" class="<?php echo $m_hargajual_list->totalhargajual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->totalhargajual) ?>', 1);"><div id="elh_m_hargajual_totalhargajual" class="m_hargajual_totalhargajual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->totalhargajual->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->totalhargajual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->totalhargajual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->disc_pr->Visible) { // disc_pr ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->disc_pr) == "") { ?>
		<th data-name="disc_pr" class="<?php echo $m_hargajual_list->disc_pr->headerCellClass() ?>"><div id="elh_m_hargajual_disc_pr" class="m_hargajual_disc_pr"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->disc_pr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_pr" class="<?php echo $m_hargajual_list->disc_pr->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->disc_pr) ?>', 1);"><div id="elh_m_hargajual_disc_pr" class="m_hargajual_disc_pr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->disc_pr->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->disc_pr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->disc_pr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->disc_rp->Visible) { // disc_rp ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->disc_rp) == "") { ?>
		<th data-name="disc_rp" class="<?php echo $m_hargajual_list->disc_rp->headerCellClass() ?>"><div id="elh_m_hargajual_disc_rp" class="m_hargajual_disc_rp"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->disc_rp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_rp" class="<?php echo $m_hargajual_list->disc_rp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->disc_rp) ?>', 1);"><div id="elh_m_hargajual_disc_rp" class="m_hargajual_disc_rp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->disc_rp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->disc_rp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->disc_rp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_hargajual_list->id_klinik->headerCellClass() ?>"><div id="elh_m_hargajual_id_klinik" class="m_hargajual_id_klinik"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_hargajual_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->id_klinik) ?>', 1);"><div id="elh_m_hargajual_id_klinik" class="m_hargajual_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->stok->Visible) { // stok ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $m_hargajual_list->stok->headerCellClass() ?>"><div id="elh_m_hargajual_stok" class="m_hargajual_stok"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $m_hargajual_list->stok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->stok) ?>', 1);"><div id="elh_m_hargajual_stok" class="m_hargajual_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->stok->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->satuan->Visible) { // satuan ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $m_hargajual_list->satuan->headerCellClass() ?>"><div id="elh_m_hargajual_satuan" class="m_hargajual_satuan"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $m_hargajual_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->satuan) ?>', 1);"><div id="elh_m_hargajual_satuan" class="m_hargajual_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->minimum_stok->Visible) { // minimum_stok ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->minimum_stok) == "") { ?>
		<th data-name="minimum_stok" class="<?php echo $m_hargajual_list->minimum_stok->headerCellClass() ?>"><div id="elh_m_hargajual_minimum_stok" class="m_hargajual_minimum_stok"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->minimum_stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="minimum_stok" class="<?php echo $m_hargajual_list->minimum_stok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->minimum_stok) ?>', 1);"><div id="elh_m_hargajual_minimum_stok" class="m_hargajual_minimum_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->minimum_stok->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->minimum_stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->minimum_stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->tgl_masuk->Visible) { // tgl_masuk ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->tgl_masuk) == "") { ?>
		<th data-name="tgl_masuk" class="<?php echo $m_hargajual_list->tgl_masuk->headerCellClass() ?>"><div id="elh_m_hargajual_tgl_masuk" class="m_hargajual_tgl_masuk"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->tgl_masuk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_masuk" class="<?php echo $m_hargajual_list->tgl_masuk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->tgl_masuk) ?>', 1);"><div id="elh_m_hargajual_tgl_masuk" class="m_hargajual_tgl_masuk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->tgl_masuk->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->tgl_masuk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->tgl_masuk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_hargajual_list->tgl_exp->Visible) { // tgl_exp ?>
	<?php if ($m_hargajual_list->SortUrl($m_hargajual_list->tgl_exp) == "") { ?>
		<th data-name="tgl_exp" class="<?php echo $m_hargajual_list->tgl_exp->headerCellClass() ?>"><div id="elh_m_hargajual_tgl_exp" class="m_hargajual_tgl_exp"><div class="ew-table-header-caption"><?php echo $m_hargajual_list->tgl_exp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_exp" class="<?php echo $m_hargajual_list->tgl_exp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_hargajual_list->SortUrl($m_hargajual_list->tgl_exp) ?>', 1);"><div id="elh_m_hargajual_tgl_exp" class="m_hargajual_tgl_exp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_hargajual_list->tgl_exp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_hargajual_list->tgl_exp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_hargajual_list->tgl_exp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_hargajual_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_hargajual_list->ExportAll && $m_hargajual_list->isExport()) {
	$m_hargajual_list->StopRecord = $m_hargajual_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_hargajual_list->TotalRecords > $m_hargajual_list->StartRecord + $m_hargajual_list->DisplayRecords - 1)
		$m_hargajual_list->StopRecord = $m_hargajual_list->StartRecord + $m_hargajual_list->DisplayRecords - 1;
	else
		$m_hargajual_list->StopRecord = $m_hargajual_list->TotalRecords;
}
$m_hargajual_list->RecordCount = $m_hargajual_list->StartRecord - 1;
if ($m_hargajual_list->Recordset && !$m_hargajual_list->Recordset->EOF) {
	$m_hargajual_list->Recordset->moveFirst();
	$selectLimit = $m_hargajual_list->UseSelectLimit;
	if (!$selectLimit && $m_hargajual_list->StartRecord > 1)
		$m_hargajual_list->Recordset->move($m_hargajual_list->StartRecord - 1);
} elseif (!$m_hargajual->AllowAddDeleteRow && $m_hargajual_list->StopRecord == 0) {
	$m_hargajual_list->StopRecord = $m_hargajual->GridAddRowCount;
}

// Initialize aggregate
$m_hargajual->RowType = ROWTYPE_AGGREGATEINIT;
$m_hargajual->resetAttributes();
$m_hargajual_list->renderRow();
while ($m_hargajual_list->RecordCount < $m_hargajual_list->StopRecord) {
	$m_hargajual_list->RecordCount++;
	if ($m_hargajual_list->RecordCount >= $m_hargajual_list->StartRecord) {
		$m_hargajual_list->RowCount++;

		// Set up key count
		$m_hargajual_list->KeyCount = $m_hargajual_list->RowIndex;

		// Init row class and style
		$m_hargajual->resetAttributes();
		$m_hargajual->CssClass = "";
		if ($m_hargajual_list->isGridAdd()) {
		} else {
			$m_hargajual_list->loadRowValues($m_hargajual_list->Recordset); // Load row values
		}
		$m_hargajual->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_hargajual->RowAttrs->merge(["data-rowindex" => $m_hargajual_list->RowCount, "id" => "r" . $m_hargajual_list->RowCount . "_m_hargajual", "data-rowtype" => $m_hargajual->RowType]);

		// Render row
		$m_hargajual_list->renderRow();

		// Render list options
		$m_hargajual_list->renderListOptions();
?>
	<tr <?php echo $m_hargajual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_hargajual_list->ListOptions->render("body", "left", $m_hargajual_list->RowCount);
?>
	<?php if ($m_hargajual_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $m_hargajual_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_id_barang">
<span<?php echo $m_hargajual_list->id_barang->viewAttributes() ?>><?php echo $m_hargajual_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->totalhargajual->Visible) { // totalhargajual ?>
		<td data-name="totalhargajual" <?php echo $m_hargajual_list->totalhargajual->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_totalhargajual">
<span<?php echo $m_hargajual_list->totalhargajual->viewAttributes() ?>><?php echo $m_hargajual_list->totalhargajual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->disc_pr->Visible) { // disc_pr ?>
		<td data-name="disc_pr" <?php echo $m_hargajual_list->disc_pr->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_disc_pr">
<span<?php echo $m_hargajual_list->disc_pr->viewAttributes() ?>><?php echo $m_hargajual_list->disc_pr->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->disc_rp->Visible) { // disc_rp ?>
		<td data-name="disc_rp" <?php echo $m_hargajual_list->disc_rp->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_disc_rp">
<span<?php echo $m_hargajual_list->disc_rp->viewAttributes() ?>><?php echo $m_hargajual_list->disc_rp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_hargajual_list->id_klinik->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_id_klinik">
<span<?php echo $m_hargajual_list->id_klinik->viewAttributes() ?>><?php echo $m_hargajual_list->id_klinik->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $m_hargajual_list->stok->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_stok">
<span<?php echo $m_hargajual_list->stok->viewAttributes() ?>><?php echo $m_hargajual_list->stok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $m_hargajual_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_satuan">
<span<?php echo $m_hargajual_list->satuan->viewAttributes() ?>><?php echo $m_hargajual_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->minimum_stok->Visible) { // minimum_stok ?>
		<td data-name="minimum_stok" <?php echo $m_hargajual_list->minimum_stok->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_minimum_stok">
<span<?php echo $m_hargajual_list->minimum_stok->viewAttributes() ?>><?php echo $m_hargajual_list->minimum_stok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->tgl_masuk->Visible) { // tgl_masuk ?>
		<td data-name="tgl_masuk" <?php echo $m_hargajual_list->tgl_masuk->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_tgl_masuk">
<span<?php echo $m_hargajual_list->tgl_masuk->viewAttributes() ?>><?php echo $m_hargajual_list->tgl_masuk->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_hargajual_list->tgl_exp->Visible) { // tgl_exp ?>
		<td data-name="tgl_exp" <?php echo $m_hargajual_list->tgl_exp->cellAttributes() ?>>
<span id="el<?php echo $m_hargajual_list->RowCount ?>_m_hargajual_tgl_exp">
<span<?php echo $m_hargajual_list->tgl_exp->viewAttributes() ?>><?php echo $m_hargajual_list->tgl_exp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_hargajual_list->ListOptions->render("body", "right", $m_hargajual_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_hargajual_list->isGridAdd())
		$m_hargajual_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_hargajual->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_hargajual_list->Recordset)
	$m_hargajual_list->Recordset->Close();
?>
<?php if (!$m_hargajual_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_hargajual_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_hargajual_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_hargajual_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_hargajual_list->TotalRecords == 0 && !$m_hargajual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_hargajual_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_hargajual_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_hargajual_list->isExport()) { ?>
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
$m_hargajual_list->terminate();
?>