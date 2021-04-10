<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailpromo_grid))
	$detailpromo_grid = new detailpromo_grid();

// Run the page
$detailpromo_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_grid->Page_Render();
?>
<?php if (!$detailpromo_grid->isExport()) { ?>
<script>
var fdetailpromogrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailpromogrid = new ew.Form("fdetailpromogrid", "grid");
	fdetailpromogrid.formKeyCountName = '<?php echo $detailpromo_grid->FormKeyCountName ?>';

	// Validate form
	fdetailpromogrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($detailpromo_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_grid->id_barang->caption(), $detailpromo_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpromo_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_grid->jumlah->caption(), $detailpromo_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpromo_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailpromo_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_grid->id_satuan->caption(), $detailpromo_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailpromogrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpromogrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpromogrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpromogrid.lists["x_id_barang"] = <?php echo $detailpromo_grid->id_barang->Lookup->toClientList($detailpromo_grid) ?>;
	fdetailpromogrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailpromo_grid->id_barang->lookupOptions()) ?>;
	fdetailpromogrid.lists["x_id_satuan"] = <?php echo $detailpromo_grid->id_satuan->Lookup->toClientList($detailpromo_grid) ?>;
	fdetailpromogrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailpromo_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailpromogrid");
});
</script>
<?php } ?>
<?php
$detailpromo_grid->renderOtherOptions();
?>
<?php if ($detailpromo_grid->TotalRecords > 0 || $detailpromo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpromo_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpromo">
<?php if ($detailpromo_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailpromo_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailpromogrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailpromo" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailpromogrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpromo->RowType = ROWTYPE_HEADER;

// Render list options
$detailpromo_grid->renderListOptions();

// Render list options (header, left)
$detailpromo_grid->ListOptions->render("header", "left");
?>
<?php if ($detailpromo_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpromo_grid->SortUrl($detailpromo_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailpromo_grid->id_barang->headerCellClass() ?>"><div id="elh_detailpromo_id_barang" class="detailpromo_id_barang"><div class="ew-table-header-caption"><?php echo $detailpromo_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailpromo_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailpromo_id_barang" class="detailpromo_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpromo_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailpromo_grid->SortUrl($detailpromo_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailpromo_grid->jumlah->headerCellClass() ?>"><div id="elh_detailpromo_jumlah" class="detailpromo_jumlah"><div class="ew-table-header-caption"><?php echo $detailpromo_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailpromo_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailpromo_jumlah" class="detailpromo_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpromo_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailpromo_grid->SortUrl($detailpromo_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailpromo_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailpromo_id_satuan" class="detailpromo_id_satuan"><div class="ew-table-header-caption"><?php echo $detailpromo_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailpromo_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailpromo_id_satuan" class="detailpromo_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpromo_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailpromo_grid->StartRecord = 1;
$detailpromo_grid->StopRecord = $detailpromo_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailpromo->isConfirm() || $detailpromo_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailpromo_grid->FormKeyCountName) && ($detailpromo_grid->isGridAdd() || $detailpromo_grid->isGridEdit() || $detailpromo->isConfirm())) {
		$detailpromo_grid->KeyCount = $CurrentForm->getValue($detailpromo_grid->FormKeyCountName);
		$detailpromo_grid->StopRecord = $detailpromo_grid->StartRecord + $detailpromo_grid->KeyCount - 1;
	}
}
$detailpromo_grid->RecordCount = $detailpromo_grid->StartRecord - 1;
if ($detailpromo_grid->Recordset && !$detailpromo_grid->Recordset->EOF) {
	$detailpromo_grid->Recordset->moveFirst();
	$selectLimit = $detailpromo_grid->UseSelectLimit;
	if (!$selectLimit && $detailpromo_grid->StartRecord > 1)
		$detailpromo_grid->Recordset->move($detailpromo_grid->StartRecord - 1);
} elseif (!$detailpromo->AllowAddDeleteRow && $detailpromo_grid->StopRecord == 0) {
	$detailpromo_grid->StopRecord = $detailpromo->GridAddRowCount;
}

// Initialize aggregate
$detailpromo->RowType = ROWTYPE_AGGREGATEINIT;
$detailpromo->resetAttributes();
$detailpromo_grid->renderRow();
if ($detailpromo_grid->isGridAdd())
	$detailpromo_grid->RowIndex = 0;
if ($detailpromo_grid->isGridEdit())
	$detailpromo_grid->RowIndex = 0;
while ($detailpromo_grid->RecordCount < $detailpromo_grid->StopRecord) {
	$detailpromo_grid->RecordCount++;
	if ($detailpromo_grid->RecordCount >= $detailpromo_grid->StartRecord) {
		$detailpromo_grid->RowCount++;
		if ($detailpromo_grid->isGridAdd() || $detailpromo_grid->isGridEdit() || $detailpromo->isConfirm()) {
			$detailpromo_grid->RowIndex++;
			$CurrentForm->Index = $detailpromo_grid->RowIndex;
			if ($CurrentForm->hasValue($detailpromo_grid->FormActionName) && ($detailpromo->isConfirm() || $detailpromo_grid->EventCancelled))
				$detailpromo_grid->RowAction = strval($CurrentForm->getValue($detailpromo_grid->FormActionName));
			elseif ($detailpromo_grid->isGridAdd())
				$detailpromo_grid->RowAction = "insert";
			else
				$detailpromo_grid->RowAction = "";
		}

		// Set up key count
		$detailpromo_grid->KeyCount = $detailpromo_grid->RowIndex;

		// Init row class and style
		$detailpromo->resetAttributes();
		$detailpromo->CssClass = "";
		if ($detailpromo_grid->isGridAdd()) {
			if ($detailpromo->CurrentMode == "copy") {
				$detailpromo_grid->loadRowValues($detailpromo_grid->Recordset); // Load row values
				$detailpromo_grid->setRecordKey($detailpromo_grid->RowOldKey, $detailpromo_grid->Recordset); // Set old record key
			} else {
				$detailpromo_grid->loadRowValues(); // Load default values
				$detailpromo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailpromo_grid->loadRowValues($detailpromo_grid->Recordset); // Load row values
		}
		$detailpromo->RowType = ROWTYPE_VIEW; // Render view
		if ($detailpromo_grid->isGridAdd()) // Grid add
			$detailpromo->RowType = ROWTYPE_ADD; // Render add
		if ($detailpromo_grid->isGridAdd() && $detailpromo->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailpromo_grid->restoreCurrentRowFormValues($detailpromo_grid->RowIndex); // Restore form values
		if ($detailpromo_grid->isGridEdit()) { // Grid edit
			if ($detailpromo->EventCancelled)
				$detailpromo_grid->restoreCurrentRowFormValues($detailpromo_grid->RowIndex); // Restore form values
			if ($detailpromo_grid->RowAction == "insert")
				$detailpromo->RowType = ROWTYPE_ADD; // Render add
			else
				$detailpromo->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailpromo_grid->isGridEdit() && ($detailpromo->RowType == ROWTYPE_EDIT || $detailpromo->RowType == ROWTYPE_ADD) && $detailpromo->EventCancelled) // Update failed
			$detailpromo_grid->restoreCurrentRowFormValues($detailpromo_grid->RowIndex); // Restore form values
		if ($detailpromo->RowType == ROWTYPE_EDIT) // Edit row
			$detailpromo_grid->EditRowCount++;
		if ($detailpromo->isConfirm()) // Confirm row
			$detailpromo_grid->restoreCurrentRowFormValues($detailpromo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailpromo->RowAttrs->merge(["data-rowindex" => $detailpromo_grid->RowCount, "id" => "r" . $detailpromo_grid->RowCount . "_detailpromo", "data-rowtype" => $detailpromo->RowType]);

		// Render row
		$detailpromo_grid->renderRow();

		// Render list options
		$detailpromo_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailpromo_grid->RowAction != "delete" && $detailpromo_grid->RowAction != "insertdelete" && !($detailpromo_grid->RowAction == "insert" && $detailpromo->isConfirm() && $detailpromo_grid->emptyRow())) {
?>
	<tr <?php echo $detailpromo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpromo_grid->ListOptions->render("body", "left", $detailpromo_grid->RowCount);
?>
	<?php if ($detailpromo_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailpromo_grid->id_barang->cellAttributes() ?>>
<?php if ($detailpromo->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_id_barang" class="form-group">
<?php $detailpromo_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpromo_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailpromo_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_grid->id_barang->ReadOnly || $detailpromo_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpromo_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_grid->id_barang->Lookup->getParamTag($detailpromo_grid, "p_x" . $detailpromo_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo $detailpromo_grid->id_barang->CurrentValue ?>"<?php echo $detailpromo_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_id_barang" class="form-group">
<?php $detailpromo_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpromo_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailpromo_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_grid->id_barang->ReadOnly || $detailpromo_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpromo_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_grid->id_barang->Lookup->getParamTag($detailpromo_grid, "p_x" . $detailpromo_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo $detailpromo_grid->id_barang->CurrentValue ?>"<?php echo $detailpromo_grid->id_barang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_id_barang">
<span<?php echo $detailpromo_grid->id_barang->viewAttributes() ?>><?php echo $detailpromo_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailpromo->isConfirm()) { ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="fdetailpromogrid$x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="fdetailpromogrid$x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="fdetailpromogrid$o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="fdetailpromogrid$o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_detailpromo" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_detailpromo" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_detailpromo" value="<?php echo HtmlEncode($detailpromo_grid->id_detailpromo->CurrentValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_id_detailpromo" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_detailpromo" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_detailpromo" value="<?php echo HtmlEncode($detailpromo_grid->id_detailpromo->OldValue) ?>">
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_EDIT || $detailpromo->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_detailpromo" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_detailpromo" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_detailpromo" value="<?php echo HtmlEncode($detailpromo_grid->id_detailpromo->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailpromo_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailpromo_grid->jumlah->cellAttributes() ?>>
<?php if ($detailpromo->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_jumlah" class="form-group">
<input type="text" data-table="detailpromo" data-field="x_jumlah" name="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpromo_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpromo_grid->jumlah->EditValue ?>"<?php echo $detailpromo_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_jumlah" class="form-group">
<input type="text" data-table="detailpromo" data-field="x_jumlah" name="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpromo_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpromo_grid->jumlah->EditValue ?>"<?php echo $detailpromo_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_jumlah">
<span<?php echo $detailpromo_grid->jumlah->viewAttributes() ?>><?php echo $detailpromo_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailpromo->isConfirm()) { ?>
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="fdetailpromogrid$x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="fdetailpromogrid$x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="fdetailpromogrid$o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="fdetailpromogrid$o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpromo_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailpromo_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailpromo->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailpromo_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_grid->id_satuan->ReadOnly || $detailpromo_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_grid->id_satuan->Lookup->getParamTag($detailpromo_grid, "p_x" . $detailpromo_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo $detailpromo_grid->id_satuan->CurrentValue ?>"<?php echo $detailpromo_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailpromo_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_grid->id_satuan->ReadOnly || $detailpromo_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_grid->id_satuan->Lookup->getParamTag($detailpromo_grid, "p_x" . $detailpromo_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo $detailpromo_grid->id_satuan->CurrentValue ?>"<?php echo $detailpromo_grid->id_satuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpromo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpromo_grid->RowCount ?>_detailpromo_id_satuan">
<span<?php echo $detailpromo_grid->id_satuan->viewAttributes() ?>><?php echo $detailpromo_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailpromo->isConfirm()) { ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="fdetailpromogrid$x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="fdetailpromogrid$x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="fdetailpromogrid$o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="fdetailpromogrid$o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpromo_grid->ListOptions->render("body", "right", $detailpromo_grid->RowCount);
?>
	</tr>
<?php if ($detailpromo->RowType == ROWTYPE_ADD || $detailpromo->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailpromogrid", "load"], function() {
	fdetailpromogrid.updateLists(<?php echo $detailpromo_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailpromo_grid->isGridAdd() || $detailpromo->CurrentMode == "copy")
		if (!$detailpromo_grid->Recordset->EOF)
			$detailpromo_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailpromo->CurrentMode == "add" || $detailpromo->CurrentMode == "copy" || $detailpromo->CurrentMode == "edit") {
		$detailpromo_grid->RowIndex = '$rowindex$';
		$detailpromo_grid->loadRowValues();

		// Set row properties
		$detailpromo->resetAttributes();
		$detailpromo->RowAttrs->merge(["data-rowindex" => $detailpromo_grid->RowIndex, "id" => "r0_detailpromo", "data-rowtype" => ROWTYPE_ADD]);
		$detailpromo->RowAttrs->appendClass("ew-template");
		$detailpromo->RowType = ROWTYPE_ADD;

		// Render row
		$detailpromo_grid->renderRow();

		// Render list options
		$detailpromo_grid->renderListOptions();
		$detailpromo_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailpromo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpromo_grid->ListOptions->render("body", "left", $detailpromo_grid->RowIndex);
?>
	<?php if ($detailpromo_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailpromo->isConfirm()) { ?>
<span id="el$rowindex$_detailpromo_id_barang" class="form-group detailpromo_id_barang">
<?php $detailpromo_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpromo_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailpromo_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_grid->id_barang->ReadOnly || $detailpromo_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpromo_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_grid->id_barang->Lookup->getParamTag($detailpromo_grid, "p_x" . $detailpromo_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo $detailpromo_grid->id_barang->CurrentValue ?>"<?php echo $detailpromo_grid->id_barang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpromo_id_barang" class="form-group detailpromo_id_barang">
<span<?php echo $detailpromo_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpromo_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpromo_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpromo_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailpromo->isConfirm()) { ?>
<span id="el$rowindex$_detailpromo_jumlah" class="form-group detailpromo_jumlah">
<input type="text" data-table="detailpromo" data-field="x_jumlah" name="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpromo_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpromo_grid->jumlah->EditValue ?>"<?php echo $detailpromo_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpromo_jumlah" class="form-group detailpromo_jumlah">
<span<?php echo $detailpromo_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpromo_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpromo" data-field="x_jumlah" name="o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" id="o<?php echo $detailpromo_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpromo_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpromo_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailpromo->isConfirm()) { ?>
<span id="el$rowindex$_detailpromo_id_satuan" class="form-group detailpromo_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailpromo_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_grid->id_satuan->ReadOnly || $detailpromo_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_grid->id_satuan->Lookup->getParamTag($detailpromo_grid, "p_x" . $detailpromo_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo $detailpromo_grid->id_satuan->CurrentValue ?>"<?php echo $detailpromo_grid->id_satuan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpromo_id_satuan" class="form-group detailpromo_id_satuan">
<span<?php echo $detailpromo_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpromo_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" name="o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailpromo_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailpromo_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpromo_grid->ListOptions->render("body", "right", $detailpromo_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailpromogrid", "load"], function() {
	fdetailpromogrid.updateLists(<?php echo $detailpromo_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailpromo->CurrentMode == "add" || $detailpromo->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailpromo_grid->FormKeyCountName ?>" id="<?php echo $detailpromo_grid->FormKeyCountName ?>" value="<?php echo $detailpromo_grid->KeyCount ?>">
<?php echo $detailpromo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpromo->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailpromo_grid->FormKeyCountName ?>" id="<?php echo $detailpromo_grid->FormKeyCountName ?>" value="<?php echo $detailpromo_grid->KeyCount ?>">
<?php echo $detailpromo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpromo->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailpromogrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpromo_grid->Recordset)
	$detailpromo_grid->Recordset->Close();
?>
<?php if ($detailpromo_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailpromo_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpromo_grid->TotalRecords == 0 && !$detailpromo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpromo_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailpromo_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailpromo_grid->terminate();
?>