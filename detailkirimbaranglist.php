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
$detailkirimbarang_list = new detailkirimbarang_list();

// Run the page
$detailkirimbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkirimbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailkirimbarang_list->isExport()) { ?>
<script>
var fdetailkirimbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailkirimbaranglist = currentForm = new ew.Form("fdetailkirimbaranglist", "list");
	fdetailkirimbaranglist.formKeyCountName = '<?php echo $detailkirimbarang_list->FormKeyCountName ?>';
	loadjs.done("fdetailkirimbaranglist");
});
var fdetailkirimbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailkirimbaranglistsrch = currentSearchForm = new ew.Form("fdetailkirimbaranglistsrch");

	// Validate function for search
	fdetailkirimbaranglistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_kirimbarang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_list->id_kirimbarang->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailkirimbaranglistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkirimbaranglistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkirimbaranglistsrch.lists["x_id_kirimbarang"] = <?php echo $detailkirimbarang_list->id_kirimbarang->Lookup->toClientList($detailkirimbarang_list) ?>;
	fdetailkirimbaranglistsrch.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($detailkirimbarang_list->id_kirimbarang->lookupOptions()) ?>;
	fdetailkirimbaranglistsrch.autoSuggests["x_id_kirimbarang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fdetailkirimbaranglistsrch.filterList = <?php echo $detailkirimbarang_list->getFilterList() ?>;
	loadjs.done("fdetailkirimbaranglistsrch");
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
<?php if (!$detailkirimbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailkirimbarang_list->TotalRecords > 0 && $detailkirimbarang_list->ExportOptions->visible()) { ?>
<?php $detailkirimbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailkirimbarang_list->ImportOptions->visible()) { ?>
<?php $detailkirimbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailkirimbarang_list->SearchOptions->visible()) { ?>
<?php $detailkirimbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailkirimbarang_list->FilterOptions->visible()) { ?>
<?php $detailkirimbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailkirimbarang_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailkirimbarang_list->isExport("print")) { ?>
<?php
if ($detailkirimbarang_list->DbMasterFilter != "" && $detailkirimbarang->getCurrentMasterTable() == "kirimbarang") {
	if ($detailkirimbarang_list->MasterRecordExists) {
		include_once "kirimbarangmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailkirimbarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailkirimbarang_list->isExport() && !$detailkirimbarang->CurrentAction) { ?>
<form name="fdetailkirimbaranglistsrch" id="fdetailkirimbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailkirimbaranglistsrch-search-panel" class="<?php echo $detailkirimbarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailkirimbarang">
	<div class="ew-extended-search">
<?php

// Render search row
$detailkirimbarang->RowType = ROWTYPE_SEARCH;
$detailkirimbarang->resetAttributes();
$detailkirimbarang_list->renderRow();
?>
<?php if ($detailkirimbarang_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php
		$detailkirimbarang_list->SearchColumnCount++;
		if (($detailkirimbarang_list->SearchColumnCount - 1) % $detailkirimbarang_list->SearchFieldsPerRow == 0) {
			$detailkirimbarang_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $detailkirimbarang_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_id_kirimbarang" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $detailkirimbarang_list->id_kirimbarang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kirimbarang" id="z_id_kirimbarang" value="=">
</span>
		<span id="el_detailkirimbarang_id_kirimbarang" class="ew-search-field">
<?php
$onchange = $detailkirimbarang_list->id_kirimbarang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_list->id_kirimbarang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_kirimbarang">
	<input type="text" class="form-control" name="sv_x_id_kirimbarang" id="sv_x_id_kirimbarang" value="<?php echo RemoveHtml($detailkirimbarang_list->id_kirimbarang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_list->id_kirimbarang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_list->id_kirimbarang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_list->id_kirimbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $detailkirimbarang_list->id_kirimbarang->displayValueSeparatorAttribute() ?>" name="x_id_kirimbarang" id="x_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_list->id_kirimbarang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranglistsrch"], function() {
	fdetailkirimbaranglistsrch.createAutoSuggest({"id":"x_id_kirimbarang","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_list->id_kirimbarang->Lookup->getParamTag($detailkirimbarang_list, "p_x_id_kirimbarang") ?>
</span>
	</div>
	<?php if ($detailkirimbarang_list->SearchColumnCount % $detailkirimbarang_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($detailkirimbarang_list->SearchColumnCount % $detailkirimbarang_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $detailkirimbarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailkirimbarang_list->showPageHeader(); ?>
<?php
$detailkirimbarang_list->showMessage();
?>
<?php if ($detailkirimbarang_list->TotalRecords > 0 || $detailkirimbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailkirimbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailkirimbarang">
<?php if (!$detailkirimbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailkirimbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailkirimbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailkirimbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailkirimbaranglist" id="fdetailkirimbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkirimbarang">
<?php if ($detailkirimbarang->getCurrentMasterTable() == "kirimbarang" && $detailkirimbarang->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="kirimbarang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailkirimbarang_list->id_kirimbarang->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailkirimbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailkirimbarang_list->TotalRecords > 0 || $detailkirimbarang_list->isGridEdit()) { ?>
<table id="tbl_detailkirimbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailkirimbarang->RowType = ROWTYPE_HEADER;

// Render list options
$detailkirimbarang_list->renderListOptions();

// Render list options (header, left)
$detailkirimbarang_list->ListOptions->render("header", "left");
?>
<?php if ($detailkirimbarang_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($detailkirimbarang_list->SortUrl($detailkirimbarang_list->id_kirimbarang) == "") { ?>
		<th data-name="id_kirimbarang" class="<?php echo $detailkirimbarang_list->id_kirimbarang->headerCellClass() ?>"><div id="elh_detailkirimbarang_id_kirimbarang" class="detailkirimbarang_id_kirimbarang"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_list->id_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kirimbarang" class="<?php echo $detailkirimbarang_list->id_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkirimbarang_list->SortUrl($detailkirimbarang_list->id_kirimbarang) ?>', 1);"><div id="elh_detailkirimbarang_id_kirimbarang" class="detailkirimbarang_id_kirimbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_list->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_list->id_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_list->id_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailkirimbarang_list->SortUrl($detailkirimbarang_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailkirimbarang_list->id_barang->headerCellClass() ?>"><div id="elh_detailkirimbarang_id_barang" class="detailkirimbarang_id_barang"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailkirimbarang_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkirimbarang_list->SortUrl($detailkirimbarang_list->id_barang) ?>', 1);"><div id="elh_detailkirimbarang_id_barang" class="detailkirimbarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailkirimbarang_list->SortUrl($detailkirimbarang_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailkirimbarang_list->id_satuan->headerCellClass() ?>"><div id="elh_detailkirimbarang_id_satuan" class="detailkirimbarang_id_satuan"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailkirimbarang_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkirimbarang_list->SortUrl($detailkirimbarang_list->id_satuan) ?>', 1);"><div id="elh_detailkirimbarang_id_satuan" class="detailkirimbarang_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailkirimbarang_list->SortUrl($detailkirimbarang_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailkirimbarang_list->jumlah->headerCellClass() ?>"><div id="elh_detailkirimbarang_jumlah" class="detailkirimbarang_jumlah"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailkirimbarang_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailkirimbarang_list->SortUrl($detailkirimbarang_list->jumlah) ?>', 1);"><div id="elh_detailkirimbarang_jumlah" class="detailkirimbarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailkirimbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailkirimbarang_list->ExportAll && $detailkirimbarang_list->isExport()) {
	$detailkirimbarang_list->StopRecord = $detailkirimbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailkirimbarang_list->TotalRecords > $detailkirimbarang_list->StartRecord + $detailkirimbarang_list->DisplayRecords - 1)
		$detailkirimbarang_list->StopRecord = $detailkirimbarang_list->StartRecord + $detailkirimbarang_list->DisplayRecords - 1;
	else
		$detailkirimbarang_list->StopRecord = $detailkirimbarang_list->TotalRecords;
}
$detailkirimbarang_list->RecordCount = $detailkirimbarang_list->StartRecord - 1;
if ($detailkirimbarang_list->Recordset && !$detailkirimbarang_list->Recordset->EOF) {
	$detailkirimbarang_list->Recordset->moveFirst();
	$selectLimit = $detailkirimbarang_list->UseSelectLimit;
	if (!$selectLimit && $detailkirimbarang_list->StartRecord > 1)
		$detailkirimbarang_list->Recordset->move($detailkirimbarang_list->StartRecord - 1);
} elseif (!$detailkirimbarang->AllowAddDeleteRow && $detailkirimbarang_list->StopRecord == 0) {
	$detailkirimbarang_list->StopRecord = $detailkirimbarang->GridAddRowCount;
}

// Initialize aggregate
$detailkirimbarang->RowType = ROWTYPE_AGGREGATEINIT;
$detailkirimbarang->resetAttributes();
$detailkirimbarang_list->renderRow();
while ($detailkirimbarang_list->RecordCount < $detailkirimbarang_list->StopRecord) {
	$detailkirimbarang_list->RecordCount++;
	if ($detailkirimbarang_list->RecordCount >= $detailkirimbarang_list->StartRecord) {
		$detailkirimbarang_list->RowCount++;

		// Set up key count
		$detailkirimbarang_list->KeyCount = $detailkirimbarang_list->RowIndex;

		// Init row class and style
		$detailkirimbarang->resetAttributes();
		$detailkirimbarang->CssClass = "";
		if ($detailkirimbarang_list->isGridAdd()) {
		} else {
			$detailkirimbarang_list->loadRowValues($detailkirimbarang_list->Recordset); // Load row values
		}
		$detailkirimbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailkirimbarang->RowAttrs->merge(["data-rowindex" => $detailkirimbarang_list->RowCount, "id" => "r" . $detailkirimbarang_list->RowCount . "_detailkirimbarang", "data-rowtype" => $detailkirimbarang->RowType]);

		// Render row
		$detailkirimbarang_list->renderRow();

		// Render list options
		$detailkirimbarang_list->renderListOptions();
?>
	<tr <?php echo $detailkirimbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkirimbarang_list->ListOptions->render("body", "left", $detailkirimbarang_list->RowCount);
?>
	<?php if ($detailkirimbarang_list->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang" <?php echo $detailkirimbarang_list->id_kirimbarang->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_list->RowCount ?>_detailkirimbarang_id_kirimbarang">
<span<?php echo $detailkirimbarang_list->id_kirimbarang->viewAttributes() ?>><?php echo $detailkirimbarang_list->id_kirimbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailkirimbarang_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_list->RowCount ?>_detailkirimbarang_id_barang">
<span<?php echo $detailkirimbarang_list->id_barang->viewAttributes() ?>><?php echo $detailkirimbarang_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailkirimbarang_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_list->RowCount ?>_detailkirimbarang_id_satuan">
<span<?php echo $detailkirimbarang_list->id_satuan->viewAttributes() ?>><?php echo $detailkirimbarang_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailkirimbarang_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailkirimbarang_list->RowCount ?>_detailkirimbarang_jumlah">
<span<?php echo $detailkirimbarang_list->jumlah->viewAttributes() ?>><?php echo $detailkirimbarang_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailkirimbarang_list->ListOptions->render("body", "right", $detailkirimbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailkirimbarang_list->isGridAdd())
		$detailkirimbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailkirimbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailkirimbarang_list->Recordset)
	$detailkirimbarang_list->Recordset->Close();
?>
<?php if (!$detailkirimbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailkirimbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailkirimbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailkirimbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailkirimbarang_list->TotalRecords == 0 && !$detailkirimbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailkirimbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailkirimbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailkirimbarang_list->isExport()) { ?>
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
$detailkirimbarang_list->terminate();
?>