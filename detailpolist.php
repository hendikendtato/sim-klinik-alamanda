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
$detailpo_list = new detailpo_list();

// Run the page
$detailpo_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpo_list->isExport()) { ?>
<script>
var fdetailpolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailpolist = currentForm = new ew.Form("fdetailpolist", "list");
	fdetailpolist.formKeyCountName = '<?php echo $detailpo_list->FormKeyCountName ?>';
	loadjs.done("fdetailpolist");
});
var fdetailpolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailpolistsrch = currentSearchForm = new ew.Form("fdetailpolistsrch");

	// Validate function for search
	fdetailpolistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_pid_detailpo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_list->pid_detailpo->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpolistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpolistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpolistsrch.lists["x_idbarang"] = <?php echo $detailpo_list->idbarang->Lookup->toClientList($detailpo_list) ?>;
	fdetailpolistsrch.lists["x_idbarang"].options = <?php echo JsonEncode($detailpo_list->idbarang->lookupOptions()) ?>;

	// Filters
	fdetailpolistsrch.filterList = <?php echo $detailpo_list->getFilterList() ?>;
	loadjs.done("fdetailpolistsrch");
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
<?php if (!$detailpo_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailpo_list->TotalRecords > 0 && $detailpo_list->ExportOptions->visible()) { ?>
<?php $detailpo_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpo_list->ImportOptions->visible()) { ?>
<?php $detailpo_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailpo_list->SearchOptions->visible()) { ?>
<?php $detailpo_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailpo_list->FilterOptions->visible()) { ?>
<?php $detailpo_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailpo_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailpo_list->isExport("print")) { ?>
<?php
if ($detailpo_list->DbMasterFilter != "" && $detailpo->getCurrentMasterTable() == "purchaseorder") {
	if ($detailpo_list->MasterRecordExists) {
		include_once "purchaseordermaster.php";
	}
}
?>
<?php } ?>
<?php
$detailpo_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$detailpo_list->isExport() && !$detailpo->CurrentAction) { ?>
<form name="fdetailpolistsrch" id="fdetailpolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdetailpolistsrch-search-panel" class="<?php echo $detailpo_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="detailpo">
	<div class="ew-extended-search">
<?php

// Render search row
$detailpo->RowType = ROWTYPE_SEARCH;
$detailpo->resetAttributes();
$detailpo_list->renderRow();
?>
<?php if ($detailpo_list->pid_detailpo->Visible) { // pid_detailpo ?>
	<?php
		$detailpo_list->SearchColumnCount++;
		if (($detailpo_list->SearchColumnCount - 1) % $detailpo_list->SearchFieldsPerRow == 0) {
			$detailpo_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $detailpo_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pid_detailpo" class="ew-cell form-group">
		<label for="x_pid_detailpo" class="ew-search-caption ew-label"><?php echo $detailpo_list->pid_detailpo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_pid_detailpo" id="z_pid_detailpo" value="=">
</span>
		<span id="el_detailpo_pid_detailpo" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_pid_detailpo" name="x_pid_detailpo" id="x_pid_detailpo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_list->pid_detailpo->getPlaceHolder()) ?>" value="<?php echo $detailpo_list->pid_detailpo->EditValue ?>"<?php echo $detailpo_list->pid_detailpo->editAttributes() ?>>
</span>
	</div>
	<?php if ($detailpo_list->SearchColumnCount % $detailpo_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_list->idbarang->Visible) { // idbarang ?>
	<?php
		$detailpo_list->SearchColumnCount++;
		if (($detailpo_list->SearchColumnCount - 1) % $detailpo_list->SearchFieldsPerRow == 0) {
			$detailpo_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $detailpo_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_idbarang" class="ew-cell form-group">
		<label for="x_idbarang" class="ew-search-caption ew-label"><?php echo $detailpo_list->idbarang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_idbarang" id="z_idbarang" value="=">
</span>
		<span id="el_detailpo_idbarang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_idbarang"><?php echo EmptyValue(strval($detailpo_list->idbarang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_list->idbarang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_list->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_list->idbarang->ReadOnly || $detailpo_list->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_list->idbarang->Lookup->getParamTag($detailpo_list, "p_x_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_list->idbarang->displayValueSeparatorAttribute() ?>" name="x_idbarang" id="x_idbarang" value="<?php echo $detailpo_list->idbarang->AdvancedSearch->SearchValue ?>"<?php echo $detailpo_list->idbarang->editAttributes() ?>>
</span>
	</div>
	<?php if ($detailpo_list->SearchColumnCount % $detailpo_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($detailpo_list->SearchColumnCount % $detailpo_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $detailpo_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $detailpo_list->showPageHeader(); ?>
<?php
$detailpo_list->showMessage();
?>
<?php if ($detailpo_list->TotalRecords > 0 || $detailpo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpo_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpo">
<?php if (!$detailpo_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailpo_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpo_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailpolist" id="fdetailpolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpo">
<?php if ($detailpo->getCurrentMasterTable() == "purchaseorder" && $detailpo->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="purchaseorder">
<input type="hidden" name="fk_id_po" value="<?php echo HtmlEncode($detailpo_list->pid_detailpo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailpo" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailpo_list->TotalRecords > 0 || $detailpo_list->isGridEdit()) { ?>
<table id="tbl_detailpolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpo->RowType = ROWTYPE_HEADER;

// Render list options
$detailpo_list->renderListOptions();

// Render list options (header, left)
$detailpo_list->ListOptions->render("header", "left");
?>
<?php if ($detailpo_list->pid_detailpo->Visible) { // pid_detailpo ?>
	<?php if ($detailpo_list->SortUrl($detailpo_list->pid_detailpo) == "") { ?>
		<th data-name="pid_detailpo" class="<?php echo $detailpo_list->pid_detailpo->headerCellClass() ?>"><div id="elh_detailpo_pid_detailpo" class="detailpo_pid_detailpo"><div class="ew-table-header-caption"><?php echo $detailpo_list->pid_detailpo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_detailpo" class="<?php echo $detailpo_list->pid_detailpo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpo_list->SortUrl($detailpo_list->pid_detailpo) ?>', 1);"><div id="elh_detailpo_pid_detailpo" class="detailpo_pid_detailpo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_list->pid_detailpo->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_list->pid_detailpo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_list->pid_detailpo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_list->idbarang->Visible) { // idbarang ?>
	<?php if ($detailpo_list->SortUrl($detailpo_list->idbarang) == "") { ?>
		<th data-name="idbarang" class="<?php echo $detailpo_list->idbarang->headerCellClass() ?>"><div id="elh_detailpo_idbarang" class="detailpo_idbarang"><div class="ew-table-header-caption"><?php echo $detailpo_list->idbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idbarang" class="<?php echo $detailpo_list->idbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpo_list->SortUrl($detailpo_list->idbarang) ?>', 1);"><div id="elh_detailpo_idbarang" class="detailpo_idbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_list->idbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_list->idbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_list->idbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_list->qty->Visible) { // qty ?>
	<?php if ($detailpo_list->SortUrl($detailpo_list->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detailpo_list->qty->headerCellClass() ?>"><div id="elh_detailpo_qty" class="detailpo_qty"><div class="ew-table-header-caption"><?php echo $detailpo_list->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detailpo_list->qty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpo_list->SortUrl($detailpo_list->qty) ?>', 1);"><div id="elh_detailpo_qty" class="detailpo_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_list->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_list->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_list->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_list->satuan->Visible) { // satuan ?>
	<?php if ($detailpo_list->SortUrl($detailpo_list->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $detailpo_list->satuan->headerCellClass() ?>"><div id="elh_detailpo_satuan" class="detailpo_satuan"><div class="ew-table-header-caption"><?php echo $detailpo_list->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $detailpo_list->satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailpo_list->SortUrl($detailpo_list->satuan) ?>', 1);"><div id="elh_detailpo_satuan" class="detailpo_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_list->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_list->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_list->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpo_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailpo_list->ExportAll && $detailpo_list->isExport()) {
	$detailpo_list->StopRecord = $detailpo_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailpo_list->TotalRecords > $detailpo_list->StartRecord + $detailpo_list->DisplayRecords - 1)
		$detailpo_list->StopRecord = $detailpo_list->StartRecord + $detailpo_list->DisplayRecords - 1;
	else
		$detailpo_list->StopRecord = $detailpo_list->TotalRecords;
}
$detailpo_list->RecordCount = $detailpo_list->StartRecord - 1;
if ($detailpo_list->Recordset && !$detailpo_list->Recordset->EOF) {
	$detailpo_list->Recordset->moveFirst();
	$selectLimit = $detailpo_list->UseSelectLimit;
	if (!$selectLimit && $detailpo_list->StartRecord > 1)
		$detailpo_list->Recordset->move($detailpo_list->StartRecord - 1);
} elseif (!$detailpo->AllowAddDeleteRow && $detailpo_list->StopRecord == 0) {
	$detailpo_list->StopRecord = $detailpo->GridAddRowCount;
}

// Initialize aggregate
$detailpo->RowType = ROWTYPE_AGGREGATEINIT;
$detailpo->resetAttributes();
$detailpo_list->renderRow();
while ($detailpo_list->RecordCount < $detailpo_list->StopRecord) {
	$detailpo_list->RecordCount++;
	if ($detailpo_list->RecordCount >= $detailpo_list->StartRecord) {
		$detailpo_list->RowCount++;

		// Set up key count
		$detailpo_list->KeyCount = $detailpo_list->RowIndex;

		// Init row class and style
		$detailpo->resetAttributes();
		$detailpo->CssClass = "";
		if ($detailpo_list->isGridAdd()) {
		} else {
			$detailpo_list->loadRowValues($detailpo_list->Recordset); // Load row values
		}
		$detailpo->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailpo->RowAttrs->merge(["data-rowindex" => $detailpo_list->RowCount, "id" => "r" . $detailpo_list->RowCount . "_detailpo", "data-rowtype" => $detailpo->RowType]);

		// Render row
		$detailpo_list->renderRow();

		// Render list options
		$detailpo_list->renderListOptions();
?>
	<tr <?php echo $detailpo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpo_list->ListOptions->render("body", "left", $detailpo_list->RowCount);
?>
	<?php if ($detailpo_list->pid_detailpo->Visible) { // pid_detailpo ?>
		<td data-name="pid_detailpo" <?php echo $detailpo_list->pid_detailpo->cellAttributes() ?>>
<span id="el<?php echo $detailpo_list->RowCount ?>_detailpo_pid_detailpo">
<span<?php echo $detailpo_list->pid_detailpo->viewAttributes() ?>><?php echo $detailpo_list->pid_detailpo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpo_list->idbarang->Visible) { // idbarang ?>
		<td data-name="idbarang" <?php echo $detailpo_list->idbarang->cellAttributes() ?>>
<span id="el<?php echo $detailpo_list->RowCount ?>_detailpo_idbarang">
<span<?php echo $detailpo_list->idbarang->viewAttributes() ?>><?php echo $detailpo_list->idbarang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpo_list->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detailpo_list->qty->cellAttributes() ?>>
<span id="el<?php echo $detailpo_list->RowCount ?>_detailpo_qty">
<span<?php echo $detailpo_list->qty->viewAttributes() ?>><?php echo $detailpo_list->qty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailpo_list->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $detailpo_list->satuan->cellAttributes() ?>>
<span id="el<?php echo $detailpo_list->RowCount ?>_detailpo_satuan">
<span<?php echo $detailpo_list->satuan->viewAttributes() ?>><?php echo $detailpo_list->satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpo_list->ListOptions->render("body", "right", $detailpo_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailpo_list->isGridAdd())
		$detailpo_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailpo->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpo_list->Recordset)
	$detailpo_list->Recordset->Close();
?>
<?php if (!$detailpo_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailpo_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailpo_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailpo_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpo_list->TotalRecords == 0 && !$detailpo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpo_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailpo_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpo_list->isExport()) { ?>
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
$detailpo_list->terminate();
?>