<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailrekmeddok_grid))
	$detailrekmeddok_grid = new detailrekmeddok_grid();

// Run the page
$detailrekmeddok_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_grid->Page_Render();
?>
<?php if (!$detailrekmeddok_grid->isExport()) { ?>
<script>
var fdetailrekmeddokgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailrekmeddokgrid = new ew.Form("fdetailrekmeddokgrid", "grid");
	fdetailrekmeddokgrid.formKeyCountName = '<?php echo $detailrekmeddok_grid->FormKeyCountName ?>';

	// Validate form
	fdetailrekmeddokgrid.validate = function() {
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
			<?php if ($detailrekmeddok_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_grid->id_barang->caption(), $detailrekmeddok_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmeddok_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_grid->jumlah->caption(), $detailrekmeddok_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmeddok_grid->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_grid->satuan->caption(), $detailrekmeddok_grid->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailrekmeddokgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailrekmeddokgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmeddokgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmeddokgrid.lists["x_id_barang"] = <?php echo $detailrekmeddok_grid->id_barang->Lookup->toClientList($detailrekmeddok_grid) ?>;
	fdetailrekmeddokgrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmeddok_grid->id_barang->lookupOptions()) ?>;
	fdetailrekmeddokgrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmeddokgrid.lists["x_satuan"] = <?php echo $detailrekmeddok_grid->satuan->Lookup->toClientList($detailrekmeddok_grid) ?>;
	fdetailrekmeddokgrid.lists["x_satuan"].options = <?php echo JsonEncode($detailrekmeddok_grid->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmeddokgrid");
});
</script>
<?php } ?>
<?php
$detailrekmeddok_grid->renderOtherOptions();
?>
<?php if ($detailrekmeddok_grid->TotalRecords > 0 || $detailrekmeddok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailrekmeddok_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailrekmeddok">
<?php if ($detailrekmeddok_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailrekmeddok_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailrekmeddokgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailrekmeddok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailrekmeddokgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailrekmeddok->RowType = ROWTYPE_HEADER;

// Render list options
$detailrekmeddok_grid->renderListOptions();

// Render list options (header, left)
$detailrekmeddok_grid->ListOptions->render("header", "left");
?>
<?php if ($detailrekmeddok_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmeddok_grid->SortUrl($detailrekmeddok_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmeddok_grid->id_barang->headerCellClass() ?>"><div id="elh_detailrekmeddok_id_barang" class="detailrekmeddok_id_barang"><div class="ew-table-header-caption"><?php echo $detailrekmeddok_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmeddok_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailrekmeddok_id_barang" class="detailrekmeddok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmeddok_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmeddok_grid->SortUrl($detailrekmeddok_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmeddok_grid->jumlah->headerCellClass() ?>"><div id="elh_detailrekmeddok_jumlah" class="detailrekmeddok_jumlah"><div class="ew-table-header-caption"><?php echo $detailrekmeddok_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmeddok_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailrekmeddok_jumlah" class="detailrekmeddok_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmeddok_grid->satuan->Visible) { // satuan ?>
	<?php if ($detailrekmeddok_grid->SortUrl($detailrekmeddok_grid->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $detailrekmeddok_grid->satuan->headerCellClass() ?>"><div id="elh_detailrekmeddok_satuan" class="detailrekmeddok_satuan"><div class="ew-table-header-caption"><?php echo $detailrekmeddok_grid->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $detailrekmeddok_grid->satuan->headerCellClass() ?>"><div><div id="elh_detailrekmeddok_satuan" class="detailrekmeddok_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_grid->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_grid->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_grid->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmeddok_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailrekmeddok_grid->StartRecord = 1;
$detailrekmeddok_grid->StopRecord = $detailrekmeddok_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailrekmeddok->isConfirm() || $detailrekmeddok_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailrekmeddok_grid->FormKeyCountName) && ($detailrekmeddok_grid->isGridAdd() || $detailrekmeddok_grid->isGridEdit() || $detailrekmeddok->isConfirm())) {
		$detailrekmeddok_grid->KeyCount = $CurrentForm->getValue($detailrekmeddok_grid->FormKeyCountName);
		$detailrekmeddok_grid->StopRecord = $detailrekmeddok_grid->StartRecord + $detailrekmeddok_grid->KeyCount - 1;
	}
}
$detailrekmeddok_grid->RecordCount = $detailrekmeddok_grid->StartRecord - 1;
if ($detailrekmeddok_grid->Recordset && !$detailrekmeddok_grid->Recordset->EOF) {
	$detailrekmeddok_grid->Recordset->moveFirst();
	$selectLimit = $detailrekmeddok_grid->UseSelectLimit;
	if (!$selectLimit && $detailrekmeddok_grid->StartRecord > 1)
		$detailrekmeddok_grid->Recordset->move($detailrekmeddok_grid->StartRecord - 1);
} elseif (!$detailrekmeddok->AllowAddDeleteRow && $detailrekmeddok_grid->StopRecord == 0) {
	$detailrekmeddok_grid->StopRecord = $detailrekmeddok->GridAddRowCount;
}

// Initialize aggregate
$detailrekmeddok->RowType = ROWTYPE_AGGREGATEINIT;
$detailrekmeddok->resetAttributes();
$detailrekmeddok_grid->renderRow();
if ($detailrekmeddok_grid->isGridAdd())
	$detailrekmeddok_grid->RowIndex = 0;
if ($detailrekmeddok_grid->isGridEdit())
	$detailrekmeddok_grid->RowIndex = 0;
while ($detailrekmeddok_grid->RecordCount < $detailrekmeddok_grid->StopRecord) {
	$detailrekmeddok_grid->RecordCount++;
	if ($detailrekmeddok_grid->RecordCount >= $detailrekmeddok_grid->StartRecord) {
		$detailrekmeddok_grid->RowCount++;
		if ($detailrekmeddok_grid->isGridAdd() || $detailrekmeddok_grid->isGridEdit() || $detailrekmeddok->isConfirm()) {
			$detailrekmeddok_grid->RowIndex++;
			$CurrentForm->Index = $detailrekmeddok_grid->RowIndex;
			if ($CurrentForm->hasValue($detailrekmeddok_grid->FormActionName) && ($detailrekmeddok->isConfirm() || $detailrekmeddok_grid->EventCancelled))
				$detailrekmeddok_grid->RowAction = strval($CurrentForm->getValue($detailrekmeddok_grid->FormActionName));
			elseif ($detailrekmeddok_grid->isGridAdd())
				$detailrekmeddok_grid->RowAction = "insert";
			else
				$detailrekmeddok_grid->RowAction = "";
		}

		// Set up key count
		$detailrekmeddok_grid->KeyCount = $detailrekmeddok_grid->RowIndex;

		// Init row class and style
		$detailrekmeddok->resetAttributes();
		$detailrekmeddok->CssClass = "";
		if ($detailrekmeddok_grid->isGridAdd()) {
			if ($detailrekmeddok->CurrentMode == "copy") {
				$detailrekmeddok_grid->loadRowValues($detailrekmeddok_grid->Recordset); // Load row values
				$detailrekmeddok_grid->setRecordKey($detailrekmeddok_grid->RowOldKey, $detailrekmeddok_grid->Recordset); // Set old record key
			} else {
				$detailrekmeddok_grid->loadRowValues(); // Load default values
				$detailrekmeddok_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailrekmeddok_grid->loadRowValues($detailrekmeddok_grid->Recordset); // Load row values
		}
		$detailrekmeddok->RowType = ROWTYPE_VIEW; // Render view
		if ($detailrekmeddok_grid->isGridAdd()) // Grid add
			$detailrekmeddok->RowType = ROWTYPE_ADD; // Render add
		if ($detailrekmeddok_grid->isGridAdd() && $detailrekmeddok->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailrekmeddok_grid->restoreCurrentRowFormValues($detailrekmeddok_grid->RowIndex); // Restore form values
		if ($detailrekmeddok_grid->isGridEdit()) { // Grid edit
			if ($detailrekmeddok->EventCancelled)
				$detailrekmeddok_grid->restoreCurrentRowFormValues($detailrekmeddok_grid->RowIndex); // Restore form values
			if ($detailrekmeddok_grid->RowAction == "insert")
				$detailrekmeddok->RowType = ROWTYPE_ADD; // Render add
			else
				$detailrekmeddok->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailrekmeddok_grid->isGridEdit() && ($detailrekmeddok->RowType == ROWTYPE_EDIT || $detailrekmeddok->RowType == ROWTYPE_ADD) && $detailrekmeddok->EventCancelled) // Update failed
			$detailrekmeddok_grid->restoreCurrentRowFormValues($detailrekmeddok_grid->RowIndex); // Restore form values
		if ($detailrekmeddok->RowType == ROWTYPE_EDIT) // Edit row
			$detailrekmeddok_grid->EditRowCount++;
		if ($detailrekmeddok->isConfirm()) // Confirm row
			$detailrekmeddok_grid->restoreCurrentRowFormValues($detailrekmeddok_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailrekmeddok->RowAttrs->merge(["data-rowindex" => $detailrekmeddok_grid->RowCount, "id" => "r" . $detailrekmeddok_grid->RowCount . "_detailrekmeddok", "data-rowtype" => $detailrekmeddok->RowType]);

		// Render row
		$detailrekmeddok_grid->renderRow();

		// Render list options
		$detailrekmeddok_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailrekmeddok_grid->RowAction != "delete" && $detailrekmeddok_grid->RowAction != "insertdelete" && !($detailrekmeddok_grid->RowAction == "insert" && $detailrekmeddok->isConfirm() && $detailrekmeddok_grid->emptyRow())) {
?>
	<tr <?php echo $detailrekmeddok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmeddok_grid->ListOptions->render("body", "left", $detailrekmeddok_grid->RowCount);
?>
	<?php if ($detailrekmeddok_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailrekmeddok_grid->id_barang->cellAttributes() ?>>
<?php if ($detailrekmeddok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_id_barang" class="form-group">
<?php
$onchange = $detailrekmeddok_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmeddok_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmeddok_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmeddok_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_grid->id_barang->ReadOnly || $detailrekmeddok_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmeddokgrid"], function() {
	fdetailrekmeddokgrid.createAutoSuggest({"id":"x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmeddok_grid->id_barang->Lookup->getParamTag($detailrekmeddok_grid, "p_x" . $detailrekmeddok_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_id_barang" class="form-group">
<?php
$onchange = $detailrekmeddok_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmeddok_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmeddok_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmeddok_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_grid->id_barang->ReadOnly || $detailrekmeddok_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmeddokgrid"], function() {
	fdetailrekmeddokgrid.createAutoSuggest({"id":"x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmeddok_grid->id_barang->Lookup->getParamTag($detailrekmeddok_grid, "p_x" . $detailrekmeddok_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_id_barang">
<span<?php echo $detailrekmeddok_grid->id_barang->viewAttributes() ?>><?php echo $detailrekmeddok_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailrekmeddok->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="fdetailrekmeddokgrid$x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="fdetailrekmeddokgrid$x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="fdetailrekmeddokgrid$o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="fdetailrekmeddokgrid$o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_pemobat" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_pemobat" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_pemobat" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_pemobat->CurrentValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_pemobat" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_pemobat" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_pemobat" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_pemobat->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_EDIT || $detailrekmeddok->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_pemobat" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_pemobat" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_pemobat" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_pemobat->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailrekmeddok_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailrekmeddok_grid->jumlah->cellAttributes() ?>>
<?php if ($detailrekmeddok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_jumlah" class="form-group">
<input type="text" data-table="detailrekmeddok" data-field="x_jumlah" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_grid->jumlah->EditValue ?>"<?php echo $detailrekmeddok_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_jumlah" class="form-group">
<input type="text" data-table="detailrekmeddok" data-field="x_jumlah" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_grid->jumlah->EditValue ?>"<?php echo $detailrekmeddok_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_jumlah">
<span<?php echo $detailrekmeddok_grid->jumlah->viewAttributes() ?>><?php echo $detailrekmeddok_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailrekmeddok->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="fdetailrekmeddokgrid$x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="fdetailrekmeddokgrid$x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="fdetailrekmeddokgrid$o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="fdetailrekmeddokgrid$o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailrekmeddok_grid->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $detailrekmeddok_grid->satuan->cellAttributes() ?>>
<?php if ($detailrekmeddok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan"><?php echo EmptyValue(strval($detailrekmeddok_grid->satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmeddok_grid->satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_grid->satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_grid->satuan->ReadOnly || $detailrekmeddok_grid->satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmeddok_grid->satuan->Lookup->getParamTag($detailrekmeddok_grid, "p_x" . $detailrekmeddok_grid->RowIndex . "_satuan") ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_grid->satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo $detailrekmeddok_grid->satuan->CurrentValue ?>"<?php echo $detailrekmeddok_grid->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan"><?php echo EmptyValue(strval($detailrekmeddok_grid->satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmeddok_grid->satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_grid->satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_grid->satuan->ReadOnly || $detailrekmeddok_grid->satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmeddok_grid->satuan->Lookup->getParamTag($detailrekmeddok_grid, "p_x" . $detailrekmeddok_grid->RowIndex . "_satuan") ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_grid->satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo $detailrekmeddok_grid->satuan->CurrentValue ?>"<?php echo $detailrekmeddok_grid->satuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailrekmeddok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmeddok_grid->RowCount ?>_detailrekmeddok_satuan">
<span<?php echo $detailrekmeddok_grid->satuan->viewAttributes() ?>><?php echo $detailrekmeddok_grid->satuan->getViewValue() ?></span>
</span>
<?php if (!$detailrekmeddok->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->FormValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="fdetailrekmeddokgrid$x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="fdetailrekmeddokgrid$x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->FormValue) ?>">
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="fdetailrekmeddokgrid$o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="fdetailrekmeddokgrid$o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmeddok_grid->ListOptions->render("body", "right", $detailrekmeddok_grid->RowCount);
?>
	</tr>
<?php if ($detailrekmeddok->RowType == ROWTYPE_ADD || $detailrekmeddok->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailrekmeddokgrid", "load"], function() {
	fdetailrekmeddokgrid.updateLists(<?php echo $detailrekmeddok_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailrekmeddok_grid->isGridAdd() || $detailrekmeddok->CurrentMode == "copy")
		if (!$detailrekmeddok_grid->Recordset->EOF)
			$detailrekmeddok_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailrekmeddok->CurrentMode == "add" || $detailrekmeddok->CurrentMode == "copy" || $detailrekmeddok->CurrentMode == "edit") {
		$detailrekmeddok_grid->RowIndex = '$rowindex$';
		$detailrekmeddok_grid->loadRowValues();

		// Set row properties
		$detailrekmeddok->resetAttributes();
		$detailrekmeddok->RowAttrs->merge(["data-rowindex" => $detailrekmeddok_grid->RowIndex, "id" => "r0_detailrekmeddok", "data-rowtype" => ROWTYPE_ADD]);
		$detailrekmeddok->RowAttrs->appendClass("ew-template");
		$detailrekmeddok->RowType = ROWTYPE_ADD;

		// Render row
		$detailrekmeddok_grid->renderRow();

		// Render list options
		$detailrekmeddok_grid->renderListOptions();
		$detailrekmeddok_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailrekmeddok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmeddok_grid->ListOptions->render("body", "left", $detailrekmeddok_grid->RowIndex);
?>
	<?php if ($detailrekmeddok_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailrekmeddok->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmeddok_id_barang" class="form-group detailrekmeddok_id_barang">
<?php
$onchange = $detailrekmeddok_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmeddok_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmeddok_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmeddok_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_grid->id_barang->ReadOnly || $detailrekmeddok_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmeddokgrid"], function() {
	fdetailrekmeddokgrid.createAutoSuggest({"id":"x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmeddok_grid->id_barang->Lookup->getParamTag($detailrekmeddok_grid, "p_x" . $detailrekmeddok_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmeddok_id_barang" class="form-group detailrekmeddok_id_barang">
<span<?php echo $detailrekmeddok_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmeddok_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmeddok_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailrekmeddok->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmeddok_jumlah" class="form-group detailrekmeddok_jumlah">
<input type="text" data-table="detailrekmeddok" data-field="x_jumlah" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_grid->jumlah->EditValue ?>"<?php echo $detailrekmeddok_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmeddok_jumlah" class="form-group detailrekmeddok_jumlah">
<span<?php echo $detailrekmeddok_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmeddok_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_jumlah" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmeddok_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmeddok_grid->satuan->Visible) { // satuan ?>
		<td data-name="satuan">
<?php if (!$detailrekmeddok->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmeddok_satuan" class="form-group detailrekmeddok_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan"><?php echo EmptyValue(strval($detailrekmeddok_grid->satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmeddok_grid->satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_grid->satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_grid->satuan->ReadOnly || $detailrekmeddok_grid->satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmeddok_grid->satuan->Lookup->getParamTag($detailrekmeddok_grid, "p_x" . $detailrekmeddok_grid->RowIndex . "_satuan") ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_grid->satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo $detailrekmeddok_grid->satuan->CurrentValue ?>"<?php echo $detailrekmeddok_grid->satuan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmeddok_satuan" class="form-group detailrekmeddok_satuan">
<span<?php echo $detailrekmeddok_grid->satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmeddok_grid->satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="x<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" name="o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" id="o<?php echo $detailrekmeddok_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailrekmeddok_grid->satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmeddok_grid->ListOptions->render("body", "right", $detailrekmeddok_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailrekmeddokgrid", "load"], function() {
	fdetailrekmeddokgrid.updateLists(<?php echo $detailrekmeddok_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailrekmeddok->CurrentMode == "add" || $detailrekmeddok->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailrekmeddok_grid->FormKeyCountName ?>" id="<?php echo $detailrekmeddok_grid->FormKeyCountName ?>" value="<?php echo $detailrekmeddok_grid->KeyCount ?>">
<?php echo $detailrekmeddok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailrekmeddok->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailrekmeddok_grid->FormKeyCountName ?>" id="<?php echo $detailrekmeddok_grid->FormKeyCountName ?>" value="<?php echo $detailrekmeddok_grid->KeyCount ?>">
<?php echo $detailrekmeddok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailrekmeddok->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailrekmeddokgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailrekmeddok_grid->Recordset)
	$detailrekmeddok_grid->Recordset->Close();
?>
<?php if ($detailrekmeddok_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailrekmeddok_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailrekmeddok_grid->TotalRecords == 0 && !$detailrekmeddok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailrekmeddok_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailrekmeddok_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailrekmeddok_grid->terminate();
?>