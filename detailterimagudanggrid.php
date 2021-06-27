<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailterimagudang_grid))
	$detailterimagudang_grid = new detailterimagudang_grid();

// Run the page
$detailterimagudang_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimagudang_grid->Page_Render();
?>
<?php if (!$detailterimagudang_grid->isExport()) { ?>
<script>
var fdetailterimagudanggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailterimagudanggrid = new ew.Form("fdetailterimagudanggrid", "grid");
	fdetailterimagudanggrid.formKeyCountName = '<?php echo $detailterimagudang_grid->FormKeyCountName ?>';

	// Validate form
	fdetailterimagudanggrid.validate = function() {
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
			<?php if ($detailterimagudang_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_grid->id_barang->caption(), $detailterimagudang_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailterimagudang_grid->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_grid->qty->caption(), $detailterimagudang_grid->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_grid->qty->errorMessage()) ?>");
			<?php if ($detailterimagudang_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_grid->id_satuan->caption(), $detailterimagudang_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_grid->id_satuan->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailterimagudanggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "qty", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailterimagudanggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimagudanggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimagudanggrid.lists["x_id_barang"] = <?php echo $detailterimagudang_grid->id_barang->Lookup->toClientList($detailterimagudang_grid) ?>;
	fdetailterimagudanggrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimagudang_grid->id_barang->lookupOptions()) ?>;
	fdetailterimagudanggrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailterimagudanggrid.lists["x_id_satuan"] = <?php echo $detailterimagudang_grid->id_satuan->Lookup->toClientList($detailterimagudang_grid) ?>;
	fdetailterimagudanggrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailterimagudang_grid->id_satuan->lookupOptions()) ?>;
	fdetailterimagudanggrid.autoSuggests["x_id_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailterimagudanggrid");
});
</script>
<?php } ?>
<?php
$detailterimagudang_grid->renderOtherOptions();
?>
<?php if ($detailterimagudang_grid->TotalRecords > 0 || $detailterimagudang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailterimagudang_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailterimagudang">
<?php if ($detailterimagudang_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailterimagudang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailterimagudanggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailterimagudang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailterimagudanggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailterimagudang->RowType = ROWTYPE_HEADER;

// Render list options
$detailterimagudang_grid->renderListOptions();

// Render list options (header, left)
$detailterimagudang_grid->ListOptions->render("header", "left");
?>
<?php if ($detailterimagudang_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailterimagudang_grid->SortUrl($detailterimagudang_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailterimagudang_grid->id_barang->headerCellClass() ?>"><div id="elh_detailterimagudang_id_barang" class="detailterimagudang_id_barang"><div class="ew-table-header-caption"><?php echo $detailterimagudang_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailterimagudang_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailterimagudang_id_barang" class="detailterimagudang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimagudang_grid->qty->Visible) { // qty ?>
	<?php if ($detailterimagudang_grid->SortUrl($detailterimagudang_grid->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detailterimagudang_grid->qty->headerCellClass() ?>"><div id="elh_detailterimagudang_qty" class="detailterimagudang_qty"><div class="ew-table-header-caption"><?php echo $detailterimagudang_grid->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detailterimagudang_grid->qty->headerCellClass() ?>"><div><div id="elh_detailterimagudang_qty" class="detailterimagudang_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_grid->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_grid->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_grid->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimagudang_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailterimagudang_grid->SortUrl($detailterimagudang_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailterimagudang_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailterimagudang_id_satuan" class="detailterimagudang_id_satuan"><div class="ew-table-header-caption"><?php echo $detailterimagudang_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailterimagudang_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailterimagudang_id_satuan" class="detailterimagudang_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailterimagudang_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailterimagudang_grid->StartRecord = 1;
$detailterimagudang_grid->StopRecord = $detailterimagudang_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailterimagudang->isConfirm() || $detailterimagudang_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailterimagudang_grid->FormKeyCountName) && ($detailterimagudang_grid->isGridAdd() || $detailterimagudang_grid->isGridEdit() || $detailterimagudang->isConfirm())) {
		$detailterimagudang_grid->KeyCount = $CurrentForm->getValue($detailterimagudang_grid->FormKeyCountName);
		$detailterimagudang_grid->StopRecord = $detailterimagudang_grid->StartRecord + $detailterimagudang_grid->KeyCount - 1;
	}
}
$detailterimagudang_grid->RecordCount = $detailterimagudang_grid->StartRecord - 1;
if ($detailterimagudang_grid->Recordset && !$detailterimagudang_grid->Recordset->EOF) {
	$detailterimagudang_grid->Recordset->moveFirst();
	$selectLimit = $detailterimagudang_grid->UseSelectLimit;
	if (!$selectLimit && $detailterimagudang_grid->StartRecord > 1)
		$detailterimagudang_grid->Recordset->move($detailterimagudang_grid->StartRecord - 1);
} elseif (!$detailterimagudang->AllowAddDeleteRow && $detailterimagudang_grid->StopRecord == 0) {
	$detailterimagudang_grid->StopRecord = $detailterimagudang->GridAddRowCount;
}

// Initialize aggregate
$detailterimagudang->RowType = ROWTYPE_AGGREGATEINIT;
$detailterimagudang->resetAttributes();
$detailterimagudang_grid->renderRow();
if ($detailterimagudang_grid->isGridAdd())
	$detailterimagudang_grid->RowIndex = 0;
if ($detailterimagudang_grid->isGridEdit())
	$detailterimagudang_grid->RowIndex = 0;
while ($detailterimagudang_grid->RecordCount < $detailterimagudang_grid->StopRecord) {
	$detailterimagudang_grid->RecordCount++;
	if ($detailterimagudang_grid->RecordCount >= $detailterimagudang_grid->StartRecord) {
		$detailterimagudang_grid->RowCount++;
		if ($detailterimagudang_grid->isGridAdd() || $detailterimagudang_grid->isGridEdit() || $detailterimagudang->isConfirm()) {
			$detailterimagudang_grid->RowIndex++;
			$CurrentForm->Index = $detailterimagudang_grid->RowIndex;
			if ($CurrentForm->hasValue($detailterimagudang_grid->FormActionName) && ($detailterimagudang->isConfirm() || $detailterimagudang_grid->EventCancelled))
				$detailterimagudang_grid->RowAction = strval($CurrentForm->getValue($detailterimagudang_grid->FormActionName));
			elseif ($detailterimagudang_grid->isGridAdd())
				$detailterimagudang_grid->RowAction = "insert";
			else
				$detailterimagudang_grid->RowAction = "";
		}

		// Set up key count
		$detailterimagudang_grid->KeyCount = $detailterimagudang_grid->RowIndex;

		// Init row class and style
		$detailterimagudang->resetAttributes();
		$detailterimagudang->CssClass = "";
		if ($detailterimagudang_grid->isGridAdd()) {
			if ($detailterimagudang->CurrentMode == "copy") {
				$detailterimagudang_grid->loadRowValues($detailterimagudang_grid->Recordset); // Load row values
				$detailterimagudang_grid->setRecordKey($detailterimagudang_grid->RowOldKey, $detailterimagudang_grid->Recordset); // Set old record key
			} else {
				$detailterimagudang_grid->loadRowValues(); // Load default values
				$detailterimagudang_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailterimagudang_grid->loadRowValues($detailterimagudang_grid->Recordset); // Load row values
		}
		$detailterimagudang->RowType = ROWTYPE_VIEW; // Render view
		if ($detailterimagudang_grid->isGridAdd()) // Grid add
			$detailterimagudang->RowType = ROWTYPE_ADD; // Render add
		if ($detailterimagudang_grid->isGridAdd() && $detailterimagudang->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailterimagudang_grid->restoreCurrentRowFormValues($detailterimagudang_grid->RowIndex); // Restore form values
		if ($detailterimagudang_grid->isGridEdit()) { // Grid edit
			if ($detailterimagudang->EventCancelled)
				$detailterimagudang_grid->restoreCurrentRowFormValues($detailterimagudang_grid->RowIndex); // Restore form values
			if ($detailterimagudang_grid->RowAction == "insert")
				$detailterimagudang->RowType = ROWTYPE_ADD; // Render add
			else
				$detailterimagudang->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailterimagudang_grid->isGridEdit() && ($detailterimagudang->RowType == ROWTYPE_EDIT || $detailterimagudang->RowType == ROWTYPE_ADD) && $detailterimagudang->EventCancelled) // Update failed
			$detailterimagudang_grid->restoreCurrentRowFormValues($detailterimagudang_grid->RowIndex); // Restore form values
		if ($detailterimagudang->RowType == ROWTYPE_EDIT) // Edit row
			$detailterimagudang_grid->EditRowCount++;
		if ($detailterimagudang->isConfirm()) // Confirm row
			$detailterimagudang_grid->restoreCurrentRowFormValues($detailterimagudang_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailterimagudang->RowAttrs->merge(["data-rowindex" => $detailterimagudang_grid->RowCount, "id" => "r" . $detailterimagudang_grid->RowCount . "_detailterimagudang", "data-rowtype" => $detailterimagudang->RowType]);

		// Render row
		$detailterimagudang_grid->renderRow();

		// Render list options
		$detailterimagudang_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailterimagudang_grid->RowAction != "delete" && $detailterimagudang_grid->RowAction != "insertdelete" && !($detailterimagudang_grid->RowAction == "insert" && $detailterimagudang->isConfirm() && $detailterimagudang_grid->emptyRow())) {
?>
	<tr <?php echo $detailterimagudang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimagudang_grid->ListOptions->render("body", "left", $detailterimagudang_grid->RowCount);
?>
	<?php if ($detailterimagudang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailterimagudang_grid->id_barang->cellAttributes() ?>>
<?php if ($detailterimagudang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_id_barang" class="form-group">
<?php
$onchange = $detailterimagudang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailterimagudang_grid->id_barang->EditValue) ?>" size="55" maxlength="50" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimagudang_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailterimagudang_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailterimagudang_grid->id_barang->ReadOnly || $detailterimagudang_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailterimagudang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudanggrid"], function() {
	fdetailterimagudanggrid.createAutoSuggest({"id":"x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailterimagudang_grid->id_barang->Lookup->getParamTag($detailterimagudang_grid, "p_x" . $detailterimagudang_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_id_barang" class="form-group">
<?php
$onchange = $detailterimagudang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailterimagudang_grid->id_barang->EditValue) ?>" size="55" maxlength="50" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimagudang_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailterimagudang_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailterimagudang_grid->id_barang->ReadOnly || $detailterimagudang_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailterimagudang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudanggrid"], function() {
	fdetailterimagudanggrid.createAutoSuggest({"id":"x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailterimagudang_grid->id_barang->Lookup->getParamTag($detailterimagudang_grid, "p_x" . $detailterimagudang_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_id_barang">
<span<?php echo $detailterimagudang_grid->id_barang->viewAttributes() ?>><?php echo $detailterimagudang_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailterimagudang->isConfirm()) { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="fdetailterimagudanggrid$x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="fdetailterimagudanggrid$x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="fdetailterimagudanggrid$o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="fdetailterimagudanggrid$o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_detailterimagudang" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_detailterimagudang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_detailterimagudang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_detailterimagudang->CurrentValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_id_detailterimagudang" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_detailterimagudang" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_detailterimagudang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_detailterimagudang->OldValue) ?>">
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_EDIT || $detailterimagudang->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_detailterimagudang" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_detailterimagudang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_detailterimagudang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_detailterimagudang->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailterimagudang_grid->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detailterimagudang_grid->qty->cellAttributes() ?>>
<?php if ($detailterimagudang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_qty" class="form-group">
<input type="text" data-table="detailterimagudang" data-field="x_qty" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailterimagudang_grid->qty->EditValue ?>"<?php echo $detailterimagudang_grid->qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->OldValue) ?>">
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_qty" class="form-group">
<input type="text" data-table="detailterimagudang" data-field="x_qty" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailterimagudang_grid->qty->EditValue ?>"<?php echo $detailterimagudang_grid->qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_qty">
<span<?php echo $detailterimagudang_grid->qty->viewAttributes() ?>><?php echo $detailterimagudang_grid->qty->getViewValue() ?></span>
</span>
<?php if (!$detailterimagudang->isConfirm()) { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="fdetailterimagudanggrid$x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="fdetailterimagudanggrid$x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="fdetailterimagudanggrid$o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="fdetailterimagudanggrid$o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailterimagudang_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailterimagudang_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailterimagudang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_id_satuan" class="form-group">
<?php
$onchange = $detailterimagudang_grid->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_grid->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo RemoveHtml($detailterimagudang_grid->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->getPlaceHolder()) ?>"<?php echo $detailterimagudang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" data-value-separator="<?php echo $detailterimagudang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudanggrid"], function() {
	fdetailterimagudanggrid.createAutoSuggest({"id":"x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimagudang_grid->id_satuan->Lookup->getParamTag($detailterimagudang_grid, "p_x" . $detailterimagudang_grid->RowIndex . "_id_satuan") ?>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_id_satuan" class="form-group">
<?php
$onchange = $detailterimagudang_grid->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_grid->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo RemoveHtml($detailterimagudang_grid->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->getPlaceHolder()) ?>"<?php echo $detailterimagudang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" data-value-separator="<?php echo $detailterimagudang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudanggrid"], function() {
	fdetailterimagudanggrid.createAutoSuggest({"id":"x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimagudang_grid->id_satuan->Lookup->getParamTag($detailterimagudang_grid, "p_x" . $detailterimagudang_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } ?>
<?php if ($detailterimagudang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailterimagudang_grid->RowCount ?>_detailterimagudang_id_satuan">
<span<?php echo $detailterimagudang_grid->id_satuan->viewAttributes() ?>><?php echo $detailterimagudang_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailterimagudang->isConfirm()) { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="fdetailterimagudanggrid$x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="fdetailterimagudanggrid$x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="fdetailterimagudanggrid$o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="fdetailterimagudanggrid$o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailterimagudang_grid->ListOptions->render("body", "right", $detailterimagudang_grid->RowCount);
?>
	</tr>
<?php if ($detailterimagudang->RowType == ROWTYPE_ADD || $detailterimagudang->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailterimagudanggrid", "load"], function() {
	fdetailterimagudanggrid.updateLists(<?php echo $detailterimagudang_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailterimagudang_grid->isGridAdd() || $detailterimagudang->CurrentMode == "copy")
		if (!$detailterimagudang_grid->Recordset->EOF)
			$detailterimagudang_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailterimagudang->CurrentMode == "add" || $detailterimagudang->CurrentMode == "copy" || $detailterimagudang->CurrentMode == "edit") {
		$detailterimagudang_grid->RowIndex = '$rowindex$';
		$detailterimagudang_grid->loadRowValues();

		// Set row properties
		$detailterimagudang->resetAttributes();
		$detailterimagudang->RowAttrs->merge(["data-rowindex" => $detailterimagudang_grid->RowIndex, "id" => "r0_detailterimagudang", "data-rowtype" => ROWTYPE_ADD]);
		$detailterimagudang->RowAttrs->appendClass("ew-template");
		$detailterimagudang->RowType = ROWTYPE_ADD;

		// Render row
		$detailterimagudang_grid->renderRow();

		// Render list options
		$detailterimagudang_grid->renderListOptions();
		$detailterimagudang_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailterimagudang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimagudang_grid->ListOptions->render("body", "left", $detailterimagudang_grid->RowIndex);
?>
	<?php if ($detailterimagudang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailterimagudang->isConfirm()) { ?>
<span id="el$rowindex$_detailterimagudang_id_barang" class="form-group detailterimagudang_id_barang">
<?php
$onchange = $detailterimagudang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailterimagudang_grid->id_barang->EditValue) ?>" size="55" maxlength="50" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimagudang_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailterimagudang_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailterimagudang_grid->id_barang->ReadOnly || $detailterimagudang_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailterimagudang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudanggrid"], function() {
	fdetailterimagudanggrid.createAutoSuggest({"id":"x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailterimagudang_grid->id_barang->Lookup->getParamTag($detailterimagudang_grid, "p_x" . $detailterimagudang_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailterimagudang_id_barang" class="form-group detailterimagudang_id_barang">
<span<?php echo $detailterimagudang_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimagudang_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailterimagudang_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailterimagudang_grid->qty->Visible) { // qty ?>
		<td data-name="qty">
<?php if (!$detailterimagudang->isConfirm()) { ?>
<span id="el$rowindex$_detailterimagudang_qty" class="form-group detailterimagudang_qty">
<input type="text" data-table="detailterimagudang" data-field="x_qty" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailterimagudang_grid->qty->EditValue ?>"<?php echo $detailterimagudang_grid->qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailterimagudang_qty" class="form-group detailterimagudang_qty">
<span<?php echo $detailterimagudang_grid->qty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimagudang_grid->qty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_qty" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailterimagudang_grid->qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailterimagudang_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailterimagudang->isConfirm()) { ?>
<span id="el$rowindex$_detailterimagudang_id_satuan" class="form-group detailterimagudang_id_satuan">
<?php
$onchange = $detailterimagudang_grid->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_grid->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="sv_x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo RemoveHtml($detailterimagudang_grid->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->getPlaceHolder()) ?>"<?php echo $detailterimagudang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" data-value-separator="<?php echo $detailterimagudang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudanggrid"], function() {
	fdetailterimagudanggrid.createAutoSuggest({"id":"x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimagudang_grid->id_satuan->Lookup->getParamTag($detailterimagudang_grid, "p_x" . $detailterimagudang_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailterimagudang_id_satuan" class="form-group detailterimagudang_id_satuan">
<span<?php echo $detailterimagudang_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimagudang_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" name="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailterimagudang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailterimagudang_grid->ListOptions->render("body", "right", $detailterimagudang_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailterimagudanggrid", "load"], function() {
	fdetailterimagudanggrid.updateLists(<?php echo $detailterimagudang_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailterimagudang->CurrentMode == "add" || $detailterimagudang->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailterimagudang_grid->FormKeyCountName ?>" id="<?php echo $detailterimagudang_grid->FormKeyCountName ?>" value="<?php echo $detailterimagudang_grid->KeyCount ?>">
<?php echo $detailterimagudang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailterimagudang->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailterimagudang_grid->FormKeyCountName ?>" id="<?php echo $detailterimagudang_grid->FormKeyCountName ?>" value="<?php echo $detailterimagudang_grid->KeyCount ?>">
<?php echo $detailterimagudang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailterimagudang->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailterimagudanggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailterimagudang_grid->Recordset)
	$detailterimagudang_grid->Recordset->Close();
?>
<?php if ($detailterimagudang_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailterimagudang_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailterimagudang_grid->TotalRecords == 0 && !$detailterimagudang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailterimagudang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailterimagudang_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailterimagudang_grid->terminate();
?>