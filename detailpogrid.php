<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailpo_grid))
	$detailpo_grid = new detailpo_grid();

// Run the page
$detailpo_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_grid->Page_Render();
?>
<?php if (!$detailpo_grid->isExport()) { ?>
<script>
var fdetailpogrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailpogrid = new ew.Form("fdetailpogrid", "grid");
	fdetailpogrid.formKeyCountName = '<?php echo $detailpo_grid->FormKeyCountName ?>';

	// Validate form
	fdetailpogrid.validate = function() {
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
			<?php if ($detailpo_grid->pid_detailpo->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_detailpo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_grid->pid_detailpo->caption(), $detailpo_grid->pid_detailpo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_detailpo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpo_grid->pid_detailpo->errorMessage()) ?>");
			<?php if ($detailpo_grid->idbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_idbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_grid->idbarang->caption(), $detailpo_grid->idbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpo_grid->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_grid->qty->caption(), $detailpo_grid->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpo_grid->qty->errorMessage()) ?>");
			<?php if ($detailpo_grid->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_grid->satuan->caption(), $detailpo_grid->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailpogrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid_detailpo", false)) return false;
		if (ew.valueChanged(fobj, infix, "idbarang", false)) return false;
		if (ew.valueChanged(fobj, infix, "qty", false)) return false;
		if (ew.valueChanged(fobj, infix, "satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpogrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpogrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpogrid.lists["x_idbarang"] = <?php echo $detailpo_grid->idbarang->Lookup->toClientList($detailpo_grid) ?>;
	fdetailpogrid.lists["x_idbarang"].options = <?php echo JsonEncode($detailpo_grid->idbarang->lookupOptions()) ?>;
	fdetailpogrid.lists["x_satuan"] = <?php echo $detailpo_grid->satuan->Lookup->toClientList($detailpo_grid) ?>;
	fdetailpogrid.lists["x_satuan"].options = <?php echo JsonEncode($detailpo_grid->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailpogrid");
});
</script>
<?php } ?>
<?php
$detailpo_grid->renderOtherOptions();
?>
<?php if ($detailpo_grid->TotalRecords > 0 || $detailpo->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpo_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpo">
<?php if ($detailpo_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailpo_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailpogrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailpo" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailpogrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpo->RowType = ROWTYPE_HEADER;

// Render list options
$detailpo_grid->renderListOptions();

// Render list options (header, left)
$detailpo_grid->ListOptions->render("header", "left");
?>
<?php if ($detailpo_grid->pid_detailpo->Visible) { // pid_detailpo ?>
	<?php if ($detailpo_grid->SortUrl($detailpo_grid->pid_detailpo) == "") { ?>
		<th data-name="pid_detailpo" class="<?php echo $detailpo_grid->pid_detailpo->headerCellClass() ?>"><div id="elh_detailpo_pid_detailpo" class="detailpo_pid_detailpo"><div class="ew-table-header-caption"><?php echo $detailpo_grid->pid_detailpo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_detailpo" class="<?php echo $detailpo_grid->pid_detailpo->headerCellClass() ?>"><div><div id="elh_detailpo_pid_detailpo" class="detailpo_pid_detailpo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_grid->pid_detailpo->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_grid->pid_detailpo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_grid->pid_detailpo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_grid->idbarang->Visible) { // idbarang ?>
	<?php if ($detailpo_grid->SortUrl($detailpo_grid->idbarang) == "") { ?>
		<th data-name="idbarang" class="<?php echo $detailpo_grid->idbarang->headerCellClass() ?>"><div id="elh_detailpo_idbarang" class="detailpo_idbarang"><div class="ew-table-header-caption"><?php echo $detailpo_grid->idbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idbarang" class="<?php echo $detailpo_grid->idbarang->headerCellClass() ?>"><div><div id="elh_detailpo_idbarang" class="detailpo_idbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_grid->idbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_grid->idbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_grid->idbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_grid->qty->Visible) { // qty ?>
	<?php if ($detailpo_grid->SortUrl($detailpo_grid->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detailpo_grid->qty->headerCellClass() ?>"><div id="elh_detailpo_qty" class="detailpo_qty"><div class="ew-table-header-caption"><?php echo $detailpo_grid->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detailpo_grid->qty->headerCellClass() ?>"><div><div id="elh_detailpo_qty" class="detailpo_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_grid->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_grid->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_grid->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_grid->satuan->Visible) { // satuan ?>
	<?php if ($detailpo_grid->SortUrl($detailpo_grid->satuan) == "") { ?>
		<th data-name="satuan" class="<?php echo $detailpo_grid->satuan->headerCellClass() ?>"><div id="elh_detailpo_satuan" class="detailpo_satuan"><div class="ew-table-header-caption"><?php echo $detailpo_grid->satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="satuan" class="<?php echo $detailpo_grid->satuan->headerCellClass() ?>"><div><div id="elh_detailpo_satuan" class="detailpo_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_grid->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_grid->satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_grid->satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpo_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailpo_grid->StartRecord = 1;
$detailpo_grid->StopRecord = $detailpo_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailpo->isConfirm() || $detailpo_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailpo_grid->FormKeyCountName) && ($detailpo_grid->isGridAdd() || $detailpo_grid->isGridEdit() || $detailpo->isConfirm())) {
		$detailpo_grid->KeyCount = $CurrentForm->getValue($detailpo_grid->FormKeyCountName);
		$detailpo_grid->StopRecord = $detailpo_grid->StartRecord + $detailpo_grid->KeyCount - 1;
	}
}
$detailpo_grid->RecordCount = $detailpo_grid->StartRecord - 1;
if ($detailpo_grid->Recordset && !$detailpo_grid->Recordset->EOF) {
	$detailpo_grid->Recordset->moveFirst();
	$selectLimit = $detailpo_grid->UseSelectLimit;
	if (!$selectLimit && $detailpo_grid->StartRecord > 1)
		$detailpo_grid->Recordset->move($detailpo_grid->StartRecord - 1);
} elseif (!$detailpo->AllowAddDeleteRow && $detailpo_grid->StopRecord == 0) {
	$detailpo_grid->StopRecord = $detailpo->GridAddRowCount;
}

// Initialize aggregate
$detailpo->RowType = ROWTYPE_AGGREGATEINIT;
$detailpo->resetAttributes();
$detailpo_grid->renderRow();
if ($detailpo_grid->isGridAdd())
	$detailpo_grid->RowIndex = 0;
if ($detailpo_grid->isGridEdit())
	$detailpo_grid->RowIndex = 0;
while ($detailpo_grid->RecordCount < $detailpo_grid->StopRecord) {
	$detailpo_grid->RecordCount++;
	if ($detailpo_grid->RecordCount >= $detailpo_grid->StartRecord) {
		$detailpo_grid->RowCount++;
		if ($detailpo_grid->isGridAdd() || $detailpo_grid->isGridEdit() || $detailpo->isConfirm()) {
			$detailpo_grid->RowIndex++;
			$CurrentForm->Index = $detailpo_grid->RowIndex;
			if ($CurrentForm->hasValue($detailpo_grid->FormActionName) && ($detailpo->isConfirm() || $detailpo_grid->EventCancelled))
				$detailpo_grid->RowAction = strval($CurrentForm->getValue($detailpo_grid->FormActionName));
			elseif ($detailpo_grid->isGridAdd())
				$detailpo_grid->RowAction = "insert";
			else
				$detailpo_grid->RowAction = "";
		}

		// Set up key count
		$detailpo_grid->KeyCount = $detailpo_grid->RowIndex;

		// Init row class and style
		$detailpo->resetAttributes();
		$detailpo->CssClass = "";
		if ($detailpo_grid->isGridAdd()) {
			if ($detailpo->CurrentMode == "copy") {
				$detailpo_grid->loadRowValues($detailpo_grid->Recordset); // Load row values
				$detailpo_grid->setRecordKey($detailpo_grid->RowOldKey, $detailpo_grid->Recordset); // Set old record key
			} else {
				$detailpo_grid->loadRowValues(); // Load default values
				$detailpo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailpo_grid->loadRowValues($detailpo_grid->Recordset); // Load row values
		}
		$detailpo->RowType = ROWTYPE_VIEW; // Render view
		if ($detailpo_grid->isGridAdd()) // Grid add
			$detailpo->RowType = ROWTYPE_ADD; // Render add
		if ($detailpo_grid->isGridAdd() && $detailpo->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailpo_grid->restoreCurrentRowFormValues($detailpo_grid->RowIndex); // Restore form values
		if ($detailpo_grid->isGridEdit()) { // Grid edit
			if ($detailpo->EventCancelled)
				$detailpo_grid->restoreCurrentRowFormValues($detailpo_grid->RowIndex); // Restore form values
			if ($detailpo_grid->RowAction == "insert")
				$detailpo->RowType = ROWTYPE_ADD; // Render add
			else
				$detailpo->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailpo_grid->isGridEdit() && ($detailpo->RowType == ROWTYPE_EDIT || $detailpo->RowType == ROWTYPE_ADD) && $detailpo->EventCancelled) // Update failed
			$detailpo_grid->restoreCurrentRowFormValues($detailpo_grid->RowIndex); // Restore form values
		if ($detailpo->RowType == ROWTYPE_EDIT) // Edit row
			$detailpo_grid->EditRowCount++;
		if ($detailpo->isConfirm()) // Confirm row
			$detailpo_grid->restoreCurrentRowFormValues($detailpo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailpo->RowAttrs->merge(["data-rowindex" => $detailpo_grid->RowCount, "id" => "r" . $detailpo_grid->RowCount . "_detailpo", "data-rowtype" => $detailpo->RowType]);

		// Render row
		$detailpo_grid->renderRow();

		// Render list options
		$detailpo_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailpo_grid->RowAction != "delete" && $detailpo_grid->RowAction != "insertdelete" && !($detailpo_grid->RowAction == "insert" && $detailpo->isConfirm() && $detailpo_grid->emptyRow())) {
?>
	<tr <?php echo $detailpo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpo_grid->ListOptions->render("body", "left", $detailpo_grid->RowCount);
?>
	<?php if ($detailpo_grid->pid_detailpo->Visible) { // pid_detailpo ?>
		<td data-name="pid_detailpo" <?php echo $detailpo_grid->pid_detailpo->cellAttributes() ?>>
<?php if ($detailpo->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailpo_grid->pid_detailpo->getSessionValue() != "") { ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_pid_detailpo" class="form-group">
<span<?php echo $detailpo_grid->pid_detailpo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->pid_detailpo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_pid_detailpo" class="form-group">
<input type="text" data-table="detailpo" data-field="x_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->getPlaceHolder()) ?>" value="<?php echo $detailpo_grid->pid_detailpo->EditValue ?>"<?php echo $detailpo_grid->pid_detailpo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->OldValue) ?>">
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailpo_grid->pid_detailpo->getSessionValue() != "") { ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_pid_detailpo" class="form-group">
<span<?php echo $detailpo_grid->pid_detailpo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->pid_detailpo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_pid_detailpo" class="form-group">
<input type="text" data-table="detailpo" data-field="x_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->getPlaceHolder()) ?>" value="<?php echo $detailpo_grid->pid_detailpo->EditValue ?>"<?php echo $detailpo_grid->pid_detailpo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_pid_detailpo">
<span<?php echo $detailpo_grid->pid_detailpo->viewAttributes() ?>><?php echo $detailpo_grid->pid_detailpo->getViewValue() ?></span>
</span>
<?php if (!$detailpo->isConfirm()) { ?>
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailpo" data-field="x_id_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_id_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_id_detailpo" value="<?php echo HtmlEncode($detailpo_grid->id_detailpo->CurrentValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_id_detailpo" name="o<?php echo $detailpo_grid->RowIndex ?>_id_detailpo" id="o<?php echo $detailpo_grid->RowIndex ?>_id_detailpo" value="<?php echo HtmlEncode($detailpo_grid->id_detailpo->OldValue) ?>">
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_EDIT || $detailpo->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailpo" data-field="x_id_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_id_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_id_detailpo" value="<?php echo HtmlEncode($detailpo_grid->id_detailpo->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailpo_grid->idbarang->Visible) { // idbarang ?>
		<td data-name="idbarang" <?php echo $detailpo_grid->idbarang->cellAttributes() ?>>
<?php if ($detailpo->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_idbarang" class="form-group">
<?php $detailpo_grid->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpo_grid->RowIndex ?>_idbarang"><?php echo EmptyValue(strval($detailpo_grid->idbarang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_grid->idbarang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_grid->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_grid->idbarang->ReadOnly || $detailpo_grid->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpo_grid->RowIndex ?>_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_grid->idbarang->Lookup->getParamTag($detailpo_grid, "p_x" . $detailpo_grid->RowIndex . "_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_grid->idbarang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo $detailpo_grid->idbarang->CurrentValue ?>"<?php echo $detailpo_grid->idbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="o<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="o<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->OldValue) ?>">
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_idbarang" class="form-group">
<?php $detailpo_grid->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpo_grid->RowIndex ?>_idbarang"><?php echo EmptyValue(strval($detailpo_grid->idbarang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_grid->idbarang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_grid->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_grid->idbarang->ReadOnly || $detailpo_grid->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpo_grid->RowIndex ?>_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_grid->idbarang->Lookup->getParamTag($detailpo_grid, "p_x" . $detailpo_grid->RowIndex . "_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_grid->idbarang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo $detailpo_grid->idbarang->CurrentValue ?>"<?php echo $detailpo_grid->idbarang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_idbarang">
<span<?php echo $detailpo_grid->idbarang->viewAttributes() ?>><?php echo $detailpo_grid->idbarang->getViewValue() ?></span>
</span>
<?php if (!$detailpo->isConfirm()) { ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="o<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="o<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpo_grid->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detailpo_grid->qty->cellAttributes() ?>>
<?php if ($detailpo->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_qty" class="form-group">
<input type="text" data-table="detailpo" data-field="x_qty" name="x<?php echo $detailpo_grid->RowIndex ?>_qty" id="x<?php echo $detailpo_grid->RowIndex ?>_qty" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailpo_grid->qty->EditValue ?>"<?php echo $detailpo_grid->qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpo" data-field="x_qty" name="o<?php echo $detailpo_grid->RowIndex ?>_qty" id="o<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->OldValue) ?>">
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_qty" class="form-group">
<input type="text" data-table="detailpo" data-field="x_qty" name="x<?php echo $detailpo_grid->RowIndex ?>_qty" id="x<?php echo $detailpo_grid->RowIndex ?>_qty" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailpo_grid->qty->EditValue ?>"<?php echo $detailpo_grid->qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_qty">
<span<?php echo $detailpo_grid->qty->viewAttributes() ?>><?php echo $detailpo_grid->qty->getViewValue() ?></span>
</span>
<?php if (!$detailpo->isConfirm()) { ?>
<input type="hidden" data-table="detailpo" data-field="x_qty" name="x<?php echo $detailpo_grid->RowIndex ?>_qty" id="x<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_qty" name="o<?php echo $detailpo_grid->RowIndex ?>_qty" id="o<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpo" data-field="x_qty" name="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_qty" id="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_qty" name="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_qty" id="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpo_grid->satuan->Visible) { // satuan ?>
		<td data-name="satuan" <?php echo $detailpo_grid->satuan->cellAttributes() ?>>
<?php if ($detailpo->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_satuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpo" data-field="x_satuan" data-value-separator="<?php echo $detailpo_grid->satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpo_grid->RowIndex ?>_satuan" name="x<?php echo $detailpo_grid->RowIndex ?>_satuan"<?php echo $detailpo_grid->satuan->editAttributes() ?>>
			<?php echo $detailpo_grid->satuan->selectOptionListHtml("x{$detailpo_grid->RowIndex}_satuan") ?>
		</select>
</div>
<?php echo $detailpo_grid->satuan->Lookup->getParamTag($detailpo_grid, "p_x" . $detailpo_grid->RowIndex . "_satuan") ?>
</span>
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="o<?php echo $detailpo_grid->RowIndex ?>_satuan" id="o<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_satuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpo" data-field="x_satuan" data-value-separator="<?php echo $detailpo_grid->satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpo_grid->RowIndex ?>_satuan" name="x<?php echo $detailpo_grid->RowIndex ?>_satuan"<?php echo $detailpo_grid->satuan->editAttributes() ?>>
			<?php echo $detailpo_grid->satuan->selectOptionListHtml("x{$detailpo_grid->RowIndex}_satuan") ?>
		</select>
</div>
<?php echo $detailpo_grid->satuan->Lookup->getParamTag($detailpo_grid, "p_x" . $detailpo_grid->RowIndex . "_satuan") ?>
</span>
<?php } ?>
<?php if ($detailpo->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpo_grid->RowCount ?>_detailpo_satuan">
<span<?php echo $detailpo_grid->satuan->viewAttributes() ?>><?php echo $detailpo_grid->satuan->getViewValue() ?></span>
</span>
<?php if (!$detailpo->isConfirm()) { ?>
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="x<?php echo $detailpo_grid->RowIndex ?>_satuan" id="x<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="o<?php echo $detailpo_grid->RowIndex ?>_satuan" id="o<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_satuan" id="fdetailpogrid$x<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->FormValue) ?>">
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_satuan" id="fdetailpogrid$o<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpo_grid->ListOptions->render("body", "right", $detailpo_grid->RowCount);
?>
	</tr>
<?php if ($detailpo->RowType == ROWTYPE_ADD || $detailpo->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailpogrid", "load"], function() {
	fdetailpogrid.updateLists(<?php echo $detailpo_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailpo_grid->isGridAdd() || $detailpo->CurrentMode == "copy")
		if (!$detailpo_grid->Recordset->EOF)
			$detailpo_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailpo->CurrentMode == "add" || $detailpo->CurrentMode == "copy" || $detailpo->CurrentMode == "edit") {
		$detailpo_grid->RowIndex = '$rowindex$';
		$detailpo_grid->loadRowValues();

		// Set row properties
		$detailpo->resetAttributes();
		$detailpo->RowAttrs->merge(["data-rowindex" => $detailpo_grid->RowIndex, "id" => "r0_detailpo", "data-rowtype" => ROWTYPE_ADD]);
		$detailpo->RowAttrs->appendClass("ew-template");
		$detailpo->RowType = ROWTYPE_ADD;

		// Render row
		$detailpo_grid->renderRow();

		// Render list options
		$detailpo_grid->renderListOptions();
		$detailpo_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailpo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpo_grid->ListOptions->render("body", "left", $detailpo_grid->RowIndex);
?>
	<?php if ($detailpo_grid->pid_detailpo->Visible) { // pid_detailpo ?>
		<td data-name="pid_detailpo">
<?php if (!$detailpo->isConfirm()) { ?>
<?php if ($detailpo_grid->pid_detailpo->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailpo_pid_detailpo" class="form-group detailpo_pid_detailpo">
<span<?php echo $detailpo_grid->pid_detailpo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->pid_detailpo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailpo_pid_detailpo" class="form-group detailpo_pid_detailpo">
<input type="text" data-table="detailpo" data-field="x_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->getPlaceHolder()) ?>" value="<?php echo $detailpo_grid->pid_detailpo->EditValue ?>"<?php echo $detailpo_grid->pid_detailpo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailpo_pid_detailpo" class="form-group detailpo_pid_detailpo">
<span<?php echo $detailpo_grid->pid_detailpo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->pid_detailpo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="x<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpo" data-field="x_pid_detailpo" name="o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" id="o<?php echo $detailpo_grid->RowIndex ?>_pid_detailpo" value="<?php echo HtmlEncode($detailpo_grid->pid_detailpo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpo_grid->idbarang->Visible) { // idbarang ?>
		<td data-name="idbarang">
<?php if (!$detailpo->isConfirm()) { ?>
<span id="el$rowindex$_detailpo_idbarang" class="form-group detailpo_idbarang">
<?php $detailpo_grid->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailpo_grid->RowIndex ?>_idbarang"><?php echo EmptyValue(strval($detailpo_grid->idbarang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_grid->idbarang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_grid->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_grid->idbarang->ReadOnly || $detailpo_grid->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailpo_grid->RowIndex ?>_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_grid->idbarang->Lookup->getParamTag($detailpo_grid, "p_x" . $detailpo_grid->RowIndex . "_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_grid->idbarang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo $detailpo_grid->idbarang->CurrentValue ?>"<?php echo $detailpo_grid->idbarang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpo_idbarang" class="form-group detailpo_idbarang">
<span<?php echo $detailpo_grid->idbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->idbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="x<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" name="o<?php echo $detailpo_grid->RowIndex ?>_idbarang" id="o<?php echo $detailpo_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailpo_grid->idbarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpo_grid->qty->Visible) { // qty ?>
		<td data-name="qty">
<?php if (!$detailpo->isConfirm()) { ?>
<span id="el$rowindex$_detailpo_qty" class="form-group detailpo_qty">
<input type="text" data-table="detailpo" data-field="x_qty" name="x<?php echo $detailpo_grid->RowIndex ?>_qty" id="x<?php echo $detailpo_grid->RowIndex ?>_qty" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailpo_grid->qty->EditValue ?>"<?php echo $detailpo_grid->qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpo_qty" class="form-group detailpo_qty">
<span<?php echo $detailpo_grid->qty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->qty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpo" data-field="x_qty" name="x<?php echo $detailpo_grid->RowIndex ?>_qty" id="x<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpo" data-field="x_qty" name="o<?php echo $detailpo_grid->RowIndex ?>_qty" id="o<?php echo $detailpo_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpo_grid->qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpo_grid->satuan->Visible) { // satuan ?>
		<td data-name="satuan">
<?php if (!$detailpo->isConfirm()) { ?>
<span id="el$rowindex$_detailpo_satuan" class="form-group detailpo_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpo" data-field="x_satuan" data-value-separator="<?php echo $detailpo_grid->satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpo_grid->RowIndex ?>_satuan" name="x<?php echo $detailpo_grid->RowIndex ?>_satuan"<?php echo $detailpo_grid->satuan->editAttributes() ?>>
			<?php echo $detailpo_grid->satuan->selectOptionListHtml("x{$detailpo_grid->RowIndex}_satuan") ?>
		</select>
</div>
<?php echo $detailpo_grid->satuan->Lookup->getParamTag($detailpo_grid, "p_x" . $detailpo_grid->RowIndex . "_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpo_satuan" class="form-group detailpo_satuan">
<span<?php echo $detailpo_grid->satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpo_grid->satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="x<?php echo $detailpo_grid->RowIndex ?>_satuan" id="x<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpo" data-field="x_satuan" name="o<?php echo $detailpo_grid->RowIndex ?>_satuan" id="o<?php echo $detailpo_grid->RowIndex ?>_satuan" value="<?php echo HtmlEncode($detailpo_grid->satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpo_grid->ListOptions->render("body", "right", $detailpo_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailpogrid", "load"], function() {
	fdetailpogrid.updateLists(<?php echo $detailpo_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailpo->CurrentMode == "add" || $detailpo->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailpo_grid->FormKeyCountName ?>" id="<?php echo $detailpo_grid->FormKeyCountName ?>" value="<?php echo $detailpo_grid->KeyCount ?>">
<?php echo $detailpo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpo->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailpo_grid->FormKeyCountName ?>" id="<?php echo $detailpo_grid->FormKeyCountName ?>" value="<?php echo $detailpo_grid->KeyCount ?>">
<?php echo $detailpo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpo->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailpogrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpo_grid->Recordset)
	$detailpo_grid->Recordset->Close();
?>
<?php if ($detailpo_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailpo_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpo_grid->TotalRecords == 0 && !$detailpo->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpo_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailpo_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailpo_grid->terminate();
?>