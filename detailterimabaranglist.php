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
$detailterimabarang_list = new detailterimabarang_list();

// Run the page
$detailterimabarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailterimabarang_list->isExport()) { ?>
<script>
var fdetailterimabaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailterimabaranglist = currentForm = new ew.Form("fdetailterimabaranglist", "list");
	fdetailterimabaranglist.formKeyCountName = '<?php echo $detailterimabarang_list->FormKeyCountName ?>';
	loadjs.done("fdetailterimabaranglist");
});
var fdetailterimabaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailterimabaranglistsrch = currentSearchForm = new ew.Form("fdetailterimabaranglistsrch");

	// Validate function for search
	fdetailterimabaranglistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_list->id_barang->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailterimabaranglistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimabaranglistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimabaranglistsrch.lists["x_id_barang"] = <?php echo $detailterimabarang_list->id_barang->Lookup->toClientList($detailterimabarang_list) ?>;
	fdetailterimabaranglistsrch.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimabarang_list->id_barang->lookupOptions()) ?>;
	fdetailterimabaranglistsrch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fdetailterimabaranglistsrch.filterList = <?php echo $detailterimabarang_list->getFilterList() ?>;
	loadjs.done("fdetailterimabaranglistsrch");
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
	$(".btn.btn-default.ew-add-edit.ew-add").hide(),$(".ew-row-link.ew-edit").hide(),$(".detailkirimbarang_delete").hide();
});
</script>
<?php } ?>
<?php if (!$detailterimabarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailterimabarang_list->TotalRecords > 0 && $detailterimabarang_list->ExportOptions->visible()) { ?>
<?php $detailterimabarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailterimabarang_list->ImportOptions->visible()) { ?>
<?php $detailterimabarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailterimabarang_list->SearchOptions->visible()) { ?>
<?php $detailterimabarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailterimabarang_list->FilterOptions->visible()) { ?>
<?php $detailterimabarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailterimabarang_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailterimabarang_list->isExport("print")) { ?>
<?php
if ($detailterimabarang_list->DbMasterFilter != "" && $detailterimabarang->getCurrentMasterTable() == "terimabarang") {
	if ($detailterimabarang_list->MasterRecordExists) {
		include_once "terimabarangmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailterimabarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailterimabarang_list->isExport() && !$detailterimabarang->CurrentAction) { ?>
<form name="fdetailterimabaranglistsrch" id="fdetailterimabaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailterimabaranglistsrch-search-panel" class="<?php echo $detailterimabarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailterimabarang">
	<div class="ew-extended-search">
<?php

// Render search row
$detailterimabarang->RowType = ROWTYPE_SEARCH;
$detailterimabarang->resetAttributes();
$detailterimabarang_list->renderRow();
?>
<?php if ($detailterimabarang_list->id_barang->Visible) { // id_barang ?>
	<?php
		$detailterimabarang_list->SearchColumnCount++;
		if (($detailterimabarang_list->SearchColumnCount - 1) % $detailterimabarang_list->SearchFieldsPerRow == 0) {
			$detailterimabarang_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $detailterimabarang_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_id_barang" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $detailterimabarang_list->id_barang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		<span id="el_detailterimabarang_id_barang" class="ew-search-field">
<?php
$onchange = $detailterimabarang_list->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_list->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailterimabarang_list->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_list->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_list->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_list->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_list->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailterimabarang_list->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranglistsrch"], function() {
	fdetailterimabaranglistsrch.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_list->id_barang->Lookup->getParamTag($detailterimabarang_list, "p_x_id_barang") ?>
</span>
	</div>
	<?php if ($detailterimabarang_list->SearchColumnCount % $detailterimabarang_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($detailterimabarang_list->SearchColumnCount % $detailterimabarang_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $detailterimabarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($detailterimabarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($detailterimabarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $detailterimabarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($detailterimabarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($detailterimabarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($detailterimabarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($detailterimabarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailterimabarang_list->showPageHeader(); ?>
<?php
$detailterimabarang_list->showMessage();
?>
<?php if ($detailterimabarang_list->TotalRecords > 0 || $detailterimabarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailterimabarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailterimabarang">
<?php if (!$detailterimabarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailterimabarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailterimabarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailterimabarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailterimabaranglist" id="fdetailterimabaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimabarang">
<?php if ($detailterimabarang->getCurrentMasterTable() == "terimabarang" && $detailterimabarang->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="terimabarang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailterimabarang_list->id_terimabarang->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailterimabarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailterimabarang_list->TotalRecords > 0 || $detailterimabarang_list->isGridEdit()) { ?>
<table id="tbl_detailterimabaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailterimabarang->RowType = ROWTYPE_HEADER;

// Render list options
$detailterimabarang_list->renderListOptions();

// Render list options (header, left)
$detailterimabarang_list->ListOptions->render("header", "left");
?>
<?php if ($detailterimabarang_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailterimabarang_list->SortUrl($detailterimabarang_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailterimabarang_list->id_barang->headerCellClass() ?>"><div id="elh_detailterimabarang_id_barang" class="detailterimabarang_id_barang"><div class="ew-table-header-caption"><?php echo $detailterimabarang_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailterimabarang_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailterimabarang_list->SortUrl($detailterimabarang_list->id_barang) ?>', 1);"><div id="elh_detailterimabarang_id_barang" class="detailterimabarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimabarang_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailterimabarang_list->SortUrl($detailterimabarang_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailterimabarang_list->jumlah->headerCellClass() ?>"><div id="elh_detailterimabarang_jumlah" class="detailterimabarang_jumlah"><div class="ew-table-header-caption"><?php echo $detailterimabarang_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailterimabarang_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailterimabarang_list->SortUrl($detailterimabarang_list->jumlah) ?>', 1);"><div id="elh_detailterimabarang_jumlah" class="detailterimabarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimabarang_list->satuan->Visible) { // satuan ?>
	<?php if ($detailterimabarang_list->SortUrl($detailterimabarang_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $detailterimabarang_list->satuan->headerCellClass() ?>"><div id="elh_detailterimabarang_satuan" class="detailterimabarang_satuan"><div class="ew-table-header-caption"><?php echo $detailterimabarang_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $detailterimabarang_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailterimabarang_list->SortUrl($detailterimabarang_list->satuan) ?>', 1);"><div id="elh_detailterimabarang_satuan" class="detailterimabarang_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_list->satuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailterimabarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailterimabarang_list->ExportAll && $detailterimabarang_list->isExport()) {
	$detailterimabarang_list->StopRecord = $detailterimabarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailterimabarang_list->TotalRecords > $detailterimabarang_list->StartRecord + $detailterimabarang_list->DisplayRecords - 1)
		$detailterimabarang_list->StopRecord = $detailterimabarang_list->StartRecord + $detailterimabarang_list->DisplayRecords - 1;
	else
		$detailterimabarang_list->StopRecord = $detailterimabarang_list->TotalRecords;
}
$detailterimabarang_list->RecordCount = $detailterimabarang_list->StartRecord - 1;
if ($detailterimabarang_list->Recordset && !$detailterimabarang_list->Recordset->EOF) {
	$detailterimabarang_list->Recordset->moveFirst();
	$selectLimit = $detailterimabarang_list->UseSelectLimit;
	if (!$selectLimit && $detailterimabarang_list->StartRecord > 1)
		$detailterimabarang_list->Recordset->move($detailterimabarang_list->StartRecord - 1);
} elseif (!$detailterimabarang->AllowAddDeleteRow && $detailterimabarang_list->StopRecord == 0) {
	$detailterimabarang_list->StopRecord = $detailterimabarang->GridAddRowCount;
}

// Initialize aggregate
$detailterimabarang->RowType = ROWTYPE_AGGREGATEINIT;
$detailterimabarang->resetAttributes();
$detailterimabarang_list->renderRow();
while ($detailterimabarang_list->RecordCount < $detailterimabarang_list->StopRecord) {
	$detailterimabarang_list->RecordCount++;
	if ($detailterimabarang_list->RecordCount >= $detailterimabarang_list->StartRecord) {
		$detailterimabarang_list->RowCount++;

		// Set up key count
		$detailterimabarang_list->KeyCount = $detailterimabarang_list->RowIndex;

		// Init row class and style
		$detailterimabarang->resetAttributes();
		$detailterimabarang->CssClass = "";
		if ($detailterimabarang_list->isGridAdd()) {
		} else {
			$detailterimabarang_list->loadRowValues($detailterimabarang_list->Recordset); // Load row values
		}
		$detailterimabarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailterimabarang->RowAttrs->merge(["data-rowindex" => $detailterimabarang_list->RowCount, "id" => "r" . $detailterimabarang_list->RowCount . "_detailterimabarang", "data-rowtype" => $detailterimabarang->RowType]);

		// Render row
		$detailterimabarang_list->renderRow();

		// Render list options
		$detailterimabarang_list->renderListOptions();
?>
	<tr <?php echo $detailterimabarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimabarang_list->ListOptions->render("body", "left", $detailterimabarang_list->RowCount);
?>
	<?php if ($detailterimabarang_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailterimabarang_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailterimabarang_list->RowCount ?>_detailterimabarang_id_barang">
<span<?php echo $detailterimabarang_list->id_barang->viewAttributes() ?>><?php echo $detailterimabarang_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailterimabarang_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailterimabarang_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailterimabarang_list->RowCount ?>_detailterimabarang_jumlah">
<span<?php echo $detailterimabarang_list->jumlah->viewAttributes() ?>><?php echo $detailterimabarang_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailterimabarang_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $detailterimabarang_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $detailterimabarang_list->RowCount ?>_detailterimabarang_satuan">
<span<?php echo $detailterimabarang_list->satuan->viewAttributes() ?>><?php echo $detailterimabarang_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailterimabarang_list->ListOptions->render("body", "right", $detailterimabarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailterimabarang_list->isGridAdd())
		$detailterimabarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailterimabarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailterimabarang_list->Recordset)
	$detailterimabarang_list->Recordset->Close();
?>
<?php if (!$detailterimabarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailterimabarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailterimabarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailterimabarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailterimabarang_list->TotalRecords == 0 && !$detailterimabarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailterimabarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailterimabarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailterimabarang_list->isExport()) { ?>
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
$detailterimabarang_list->terminate();
?>