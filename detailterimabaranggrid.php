<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailterimabarang_grid))
	$detailterimabarang_grid = new detailterimabarang_grid();

// Run the page
$detailterimabarang_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_grid->Page_Render();
?>
<?php if (!$detailterimabarang_grid->isExport()) { ?>
<script>
var fdetailterimabaranggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailterimabaranggrid = new ew.Form("fdetailterimabaranggrid", "grid");
	fdetailterimabaranggrid.formKeyCountName = '<?php echo $detailterimabarang_grid->FormKeyCountName ?>';

	// Validate form
	fdetailterimabaranggrid.validate = function() {
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
			<?php if ($detailterimabarang_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_grid->id_barang->caption(), $detailterimabarang_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailterimabarang_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_grid->jumlah->caption(), $detailterimabarang_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailterimabarang_grid->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_grid->satuan->caption(), $detailterimabarang_grid->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_grid->satuan->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailterimabaranggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailterimabaranggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimabaranggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimabaranggrid.lists["x_id_barang"] = <?php echo $detailterimabarang_grid->id_barang->Lookup->toClientList($detailterimabarang_grid) ?>;
	fdetailterimabaranggrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimabarang_grid->id_barang->lookupOptions()) ?>;
	fdetailterimabaranggrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailterimabaranggrid.lists["x_satuan"] = <?php echo $detailterimabarang_grid->satuan->Lookup->toClientList($detailterimabarang_grid) ?>;
	fdetailterimabaranggrid.lists["x_satuan"].options = <?php echo JsonEncode($detailterimabarang_grid->satuan->lookupOptions()) ?>;
	fdetailterimabaranggrid.autoSuggests["x_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailterimabaranggrid");
});
</script>
<?php } ?>
<?php
$detailterimabarang_grid->renderOtherOptions();
?>
<?php if ($detailterimabarang_grid->TotalRecords > 0 || $detailterimabarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailterimabarang_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailterimabarang">
<?php if ($detailterimabarang_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailterimabarang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailterimabaranggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailterimabarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailterimabaranggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailterimabarang->RowType = ROWTYPE_HEADER;

// Render list options
$detailterimabarang_grid->renderListOptions();

// Render list options (header, left)
$detailterimabarang_grid->ListOptions->render("header", "left");
?>
<?php if ($detailterimabarang_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailterimabarang_grid->SortUrl($detailterimabarang_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailterimabarang_grid->id_barang->headerCellClass() ?>"><div id="elh_detailterimabarang_id_barang" class="detailterimabarang_id_barang"><div class="ew-table-header-caption"><?php echo $detailterimabarang_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailterimabarang_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailterimabarang_id_barang" class="detailterimabarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimabarang_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailterimabarang_grid->SortUrl($detailterimabarang_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailterimabarang_grid->jumlah->headerCellClass() ?>"><div id="elh_detailterimabarang_jumlah" class="detailterimabarang_jumlah"><div class="ew-table-header-caption"><?php echo $detailterimabarang_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailterimabarang_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailterimabarang_jumlah" class="detailterimabarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimabarang_grid->satuan->Visible) { // satuan ?>
	<?php if ($detailterimabarang_grid->SortUrl($detailterimabarang_grid->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $detailterimabarang_grid->satuan->headerCellClass() ?>"><div id="elh_detailterimabarang_satuan" class="detailterimabarang_satuan"><div class="ew-table-header-caption"><?php echo $detailterimabarang_grid->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $detailterimabarang_grid->satuan->headerCellClass() ?>"><div><div id="elh_detailterimabarang_satuan" class="detailterimabarang_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_grid->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_grid->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_grid->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailterimabarang_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailterimabarang_grid->StartRecord = 1;
$detailterimabarang_grid->StopRecord = $detailterimabarang_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailterimabarang->isConfirm() || $detailterimabarang_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailterimabarang_grid->FormKeyCountName) && ($detailterimabarang_grid->isGridAdd() || $detailterimabarang_grid->isGridEdit() || $detailterimabarang->isConfirm())) {
		$detailterimabarang_grid->KeyCount = $CurrentForm->getValue($detailterimabarang_grid->FormKeyCountName);
		$detailterimabarang_grid->StopRecord = $detailterimabarang_grid->StartRecord + $detailterimabarang_grid->KeyCount - 1;
	}
}
$detailterimabarang_grid->RecordCount = $detailterimabarang_grid->StartRecord - 1;
if ($detailterimabarang_grid->Recordset && !$detailterimabarang_grid->Recordset->EOF) {
	$detailterimabarang_grid->Recordset->moveFirst();
	$selectLimit = $detailterimabarang_grid->UseSelectLimit;
	if (!$selectLimit && $detailterimabarang_grid->StartRecord > 1)
		$detailterimabarang_grid->Recordset->move($detailterimabarang_grid->StartRecord - 1);
} elseif (!$detailterimabarang->AllowAddDeleteRow && $detailterimabarang_grid->StopRecord == 0) {
	$detailterimabarang_grid->StopRecord = $detailterimabarang->GridAddRowCount;
}

// Initialize aggregate
$detailterimabarang->RowType = ROWTYPE_AGGREGATEINIT;
$detailterimabarang->resetAttributes();
$detailterimabarang_grid->renderRow();
if ($detailterimabarang_grid->isGridAdd())
	$detailterimabarang_grid->RowIndex = 0;
if ($detailterimabarang_grid->isGridEdit())
	$detailterimabarang_grid->RowIndex = 0;
while ($detailterimabarang_grid->RecordCount < $detailterimabarang_grid->StopRecord) {
	$detailterimabarang_grid->RecordCount++;
	if ($detailterimabarang_grid->RecordCount >= $detailterimabarang_grid->StartRecord) {
		$detailterimabarang_grid->RowCount++;
		if ($detailterimabarang_grid->isGridAdd() || $detailterimabarang_grid->isGridEdit() || $detailterimabarang->isConfirm()) {
			$detailterimabarang_grid->RowIndex++;
			$CurrentForm->Index = $detailterimabarang_grid->RowIndex;
			if ($CurrentForm->hasValue($detailterimabarang_grid->FormActionName) && ($detailterimabarang->isConfirm() || $detailterimabarang_grid->EventCancelled))
				$detailterimabarang_grid->RowAction = strval($CurrentForm->getValue($detailterimabarang_grid->FormActionName));
			elseif ($detailterimabarang_grid->isGridAdd())
				$detailterimabarang_grid->RowAction = "insert";
			else
				$detailterimabarang_grid->RowAction = "";
		}

		// Set up key count
		$detailterimabarang_grid->KeyCount = $detailterimabarang_grid->RowIndex;

		// Init row class and style
		$detailterimabarang->resetAttributes();
		$detailterimabarang->CssClass = "";
		if ($detailterimabarang_grid->isGridAdd()) {
			if ($detailterimabarang->CurrentMode == "copy") {
				$detailterimabarang_grid->loadRowValues($detailterimabarang_grid->Recordset); // Load row values
				$detailterimabarang_grid->setRecordKey($detailterimabarang_grid->RowOldKey, $detailterimabarang_grid->Recordset); // Set old record key
			} else {
				$detailterimabarang_grid->loadRowValues(); // Load default values
				$detailterimabarang_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailterimabarang_grid->loadRowValues($detailterimabarang_grid->Recordset); // Load row values
		}
		$detailterimabarang->RowType = ROWTYPE_VIEW; // Render view
		if ($detailterimabarang_grid->isGridAdd()) // Grid add
			$detailterimabarang->RowType = ROWTYPE_ADD; // Render add
		if ($detailterimabarang_grid->isGridAdd() && $detailterimabarang->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailterimabarang_grid->restoreCurrentRowFormValues($detailterimabarang_grid->RowIndex); // Restore form values
		if ($detailterimabarang_grid->isGridEdit()) { // Grid edit
			if ($detailterimabarang->EventCancelled)
				$detailterimabarang_grid->restoreCurrentRowFormValues($detailterimabarang_grid->RowIndex); // Restore form values
			if ($detailterimabarang_grid->RowAction == "insert")
				$detailterimabarang->RowType = ROWTYPE_ADD; // Render add
			else
				$detailterimabarang->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailterimabarang_grid->isGridEdit() && ($detailterimabarang->RowType == ROWTYPE_EDIT || $detailterimabarang->RowType == ROWTYPE_ADD) && $detailterimabarang->EventCancelled) // Update failed
			$detailterimabarang_grid->restoreCurrentRowFormValues($detailterimabarang_grid->RowIndex); // Restore form values
		if ($detailterimabarang->RowType == ROWTYPE_EDIT) // Edit row
			$detailterimabarang_grid->EditRowCount++;
		if ($detailterimabarang->isConfirm()) // Confirm row
			$detailterimabarang_grid->restoreCurrentRowFormValues($detailterimabarang_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailterimabarang->RowAttrs->merge(["data-rowindex" => $detailterimabarang_grid->RowCount, "id" => "r" . $detailterimabarang_grid->RowCount . "_detailterimabarang", "data-rowtype" => $detailterimabarang->RowType]);

		// Render row
		$detailterimabarang_grid->renderRow();

		// Render list options
		$detailterimabarang_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailterimabarang_grid->RowAction != "delete" && $detailterimabarang_grid->RowAction != "insertdelete" && !($detailterimabarang_grid->RowAction == "insert" && $detailterimabarang->isConfirm() && $detailterimabarang_grid->emptyRow())) {
?>
	<tr <?php echo $detailterimabarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimabarang_grid->ListOptions->render("body", "left", $detailterimabarang_grid->RowCount);
?>
	<?php if ($detailterimabarang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailterimabarang_grid->id_barang->cellAttributes() ?>>
<?php if ($detailterimabarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_id_barang" class="form-group">
<?php
$onchange = $detailterimabarang_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailterimabarang_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranggrid"], function() {
	fdetailterimabaranggrid.createAutoSuggest({"id":"x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_grid->id_barang->Lookup->getParamTag($detailterimabarang_grid, "p_x" . $detailterimabarang_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_id_barang" class="form-group">
<?php
$onchange = $detailterimabarang_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailterimabarang_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranggrid"], function() {
	fdetailterimabaranggrid.createAutoSuggest({"id":"x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_grid->id_barang->Lookup->getParamTag($detailterimabarang_grid, "p_x" . $detailterimabarang_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_id_barang">
<span<?php echo $detailterimabarang_grid->id_barang->viewAttributes() ?>><?php echo $detailterimabarang_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailterimabarang->isConfirm()) { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="fdetailterimabaranggrid$x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="fdetailterimabaranggrid$x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="fdetailterimabaranggrid$o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="fdetailterimabaranggrid$o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_id" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailterimabarang_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_id" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_id" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailterimabarang_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_EDIT || $detailterimabarang->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_id" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailterimabarang_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailterimabarang_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailterimabarang_grid->jumlah->cellAttributes() ?>>
<?php if ($detailterimabarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_jumlah" class="form-group">
<input type="text" data-table="detailterimabarang" data-field="x_jumlah" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_grid->jumlah->EditValue ?>"<?php echo $detailterimabarang_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_jumlah" class="form-group">
<input type="text" data-table="detailterimabarang" data-field="x_jumlah" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_grid->jumlah->EditValue ?>"<?php echo $detailterimabarang_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_jumlah">
<span<?php echo $detailterimabarang_grid->jumlah->viewAttributes() ?>><?php echo $detailterimabarang_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailterimabarang->isConfirm()) { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="fdetailterimabaranggrid$x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="fdetailterimabaranggrid$x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="fdetailterimabaranggrid$o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="fdetailterimabaranggrid$o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailterimabarang_grid->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $detailterimabarang_grid->satuan->cellAttributes() ?>>
<?php if ($detailterimabarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_satuan" class="form-group">
<?php
$onchange = $detailterimabarang_grid->satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_grid->satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo RemoveHtml($detailterimabarang_grid->satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_grid->satuan->getPlaceHolder()) ?>"<?php echo $detailterimabarang_grid->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" data-value-separator="<?php echo $detailterimabarang_grid->satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranggrid"], function() {
	fdetailterimabaranggrid.createAutoSuggest({"id":"x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_grid->satuan->Lookup->getParamTag($detailterimabarang_grid, "p_x" . $detailterimabarang_grid->RowIndex . "_satuan") ?>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_satuan" class="form-group">
<?php
$onchange = $detailterimabarang_grid->satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_grid->satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo RemoveHtml($detailterimabarang_grid->satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_grid->satuan->getPlaceHolder()) ?>"<?php echo $detailterimabarang_grid->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" data-value-separator="<?php echo $detailterimabarang_grid->satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranggrid"], function() {
	fdetailterimabaranggrid.createAutoSuggest({"id":"x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_grid->satuan->Lookup->getParamTag($detailterimabarang_grid, "p_x" . $detailterimabarang_grid->RowIndex . "_satuan") ?>
</span>
<?php } ?>
<?php if ($detailterimabarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailterimabarang_grid->RowCount ?>_detailterimabarang_satuan">
<span<?php echo $detailterimabarang_grid->satuan->viewAttributes() ?>><?php echo $detailterimabarang_grid->satuan->getViewValue() ?></span>
</span>
<?php if (!$detailterimabarang->isConfirm()) { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->FormValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="fdetailterimabaranggrid$x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="fdetailterimabaranggrid$x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->FormValue) ?>">
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="fdetailterimabaranggrid$o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="fdetailterimabaranggrid$o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailterimabarang_grid->ListOptions->render("body", "right", $detailterimabarang_grid->RowCount);
?>
	</tr>
<?php if ($detailterimabarang->RowType == ROWTYPE_ADD || $detailterimabarang->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailterimabaranggrid", "load"], function() {
	fdetailterimabaranggrid.updateLists(<?php echo $detailterimabarang_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailterimabarang_grid->isGridAdd() || $detailterimabarang->CurrentMode == "copy")
		if (!$detailterimabarang_grid->Recordset->EOF)
			$detailterimabarang_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailterimabarang->CurrentMode == "add" || $detailterimabarang->CurrentMode == "copy" || $detailterimabarang->CurrentMode == "edit") {
		$detailterimabarang_grid->RowIndex = '$rowindex$';
		$detailterimabarang_grid->loadRowValues();

		// Set row properties
		$detailterimabarang->resetAttributes();
		$detailterimabarang->RowAttrs->merge(["data-rowindex" => $detailterimabarang_grid->RowIndex, "id" => "r0_detailterimabarang", "data-rowtype" => ROWTYPE_ADD]);
		$detailterimabarang->RowAttrs->appendClass("ew-template");
		$detailterimabarang->RowType = ROWTYPE_ADD;

		// Render row
		$detailterimabarang_grid->renderRow();

		// Render list options
		$detailterimabarang_grid->renderListOptions();
		$detailterimabarang_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailterimabarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimabarang_grid->ListOptions->render("body", "left", $detailterimabarang_grid->RowIndex);
?>
	<?php if ($detailterimabarang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailterimabarang->isConfirm()) { ?>
<span id="el$rowindex$_detailterimabarang_id_barang" class="form-group detailterimabarang_id_barang">
<?php
$onchange = $detailterimabarang_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailterimabarang_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranggrid"], function() {
	fdetailterimabaranggrid.createAutoSuggest({"id":"x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_grid->id_barang->Lookup->getParamTag($detailterimabarang_grid, "p_x" . $detailterimabarang_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailterimabarang_id_barang" class="form-group detailterimabarang_id_barang">
<span<?php echo $detailterimabarang_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimabarang_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimabarang_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailterimabarang_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailterimabarang->isConfirm()) { ?>
<span id="el$rowindex$_detailterimabarang_jumlah" class="form-group detailterimabarang_jumlah">
<input type="text" data-table="detailterimabarang" data-field="x_jumlah" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_grid->jumlah->EditValue ?>"<?php echo $detailterimabarang_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailterimabarang_jumlah" class="form-group detailterimabarang_jumlah">
<span<?php echo $detailterimabarang_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimabarang_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_jumlah" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailterimabarang_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailterimabarang_grid->satuan->Visible) { // satuan ?>
		<td data-name="satuan">
<?php if (!$detailterimabarang->isConfirm()) { ?>
<span id="el$rowindex$_detailterimabarang_satuan" class="form-group detailterimabarang_satuan">
<?php
$onchange = $detailterimabarang_grid->satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_grid->satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="sv_x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo RemoveHtml($detailterimabarang_grid->satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_grid->satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_grid->satuan->getPlaceHolder()) ?>"<?php echo $detailterimabarang_grid->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" data-value-separator="<?php echo $detailterimabarang_grid->satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabaranggrid"], function() {
	fdetailterimabaranggrid.createAutoSuggest({"id":"x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_grid->satuan->Lookup->getParamTag($detailterimabarang_grid, "p_x" . $detailterimabarang_grid->RowIndex . "_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailterimabarang_satuan" class="form-group detailterimabarang_satuan">
<span<?php echo $detailterimabarang_grid->satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimabarang_grid->satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="x<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" name="o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" id="o<?php echo $detailterimabarang_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailterimabarang_grid->satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailterimabarang_grid->ListOptions->render("body", "right", $detailterimabarang_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailterimabaranggrid", "load"], function() {
	fdetailterimabaranggrid.updateLists(<?php echo $detailterimabarang_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailterimabarang->CurrentMode == "add" || $detailterimabarang->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailterimabarang_grid->FormKeyCountName ?>" id="<?php echo $detailterimabarang_grid->FormKeyCountName ?>" value="<?php echo $detailterimabarang_grid->KeyCount ?>">
<?php echo $detailterimabarang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailterimabarang->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailterimabarang_grid->FormKeyCountName ?>" id="<?php echo $detailterimabarang_grid->FormKeyCountName ?>" value="<?php echo $detailterimabarang_grid->KeyCount ?>">
<?php echo $detailterimabarang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailterimabarang->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailterimabaranggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailterimabarang_grid->Recordset)
	$detailterimabarang_grid->Recordset->Close();
?>
<?php if ($detailterimabarang_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailterimabarang_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailterimabarang_grid->TotalRecords == 0 && !$detailterimabarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailterimabarang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailterimabarang_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailterimabarang_grid->terminate();
?>