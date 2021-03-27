<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailkomposisi_grid))
	$detailkomposisi_grid = new detailkomposisi_grid();

// Run the page
$detailkomposisi_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_grid->Page_Render();
?>
<?php if (!$detailkomposisi_grid->isExport()) { ?>
<script>
var fdetailkomposisigrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailkomposisigrid = new ew.Form("fdetailkomposisigrid", "grid");
	fdetailkomposisigrid.formKeyCountName = '<?php echo $detailkomposisi_grid->FormKeyCountName ?>';

	// Validate form
	fdetailkomposisigrid.validate = function() {
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
			<?php if ($detailkomposisi_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_grid->id_barang->caption(), $detailkomposisi_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailkomposisi_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_grid->jumlah->caption(), $detailkomposisi_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkomposisi_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailkomposisi_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_grid->id_satuan->caption(), $detailkomposisi_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailkomposisigrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailkomposisigrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkomposisigrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkomposisigrid.lists["x_id_barang"] = <?php echo $detailkomposisi_grid->id_barang->Lookup->toClientList($detailkomposisi_grid) ?>;
	fdetailkomposisigrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailkomposisi_grid->id_barang->lookupOptions()) ?>;
	fdetailkomposisigrid.lists["x_id_satuan"] = <?php echo $detailkomposisi_grid->id_satuan->Lookup->toClientList($detailkomposisi_grid) ?>;
	fdetailkomposisigrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailkomposisi_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailkomposisigrid");
});
</script>
<?php } ?>
<?php
$detailkomposisi_grid->renderOtherOptions();
?>
<?php if ($detailkomposisi_grid->TotalRecords > 0 || $detailkomposisi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailkomposisi_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailkomposisi">
<?php if ($detailkomposisi_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailkomposisi_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailkomposisigrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailkomposisi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailkomposisigrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailkomposisi->RowType = ROWTYPE_HEADER;

// Render list options
$detailkomposisi_grid->renderListOptions();

// Render list options (header, left)
$detailkomposisi_grid->ListOptions->render("header", "left");
?>
<?php if ($detailkomposisi_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailkomposisi_grid->SortUrl($detailkomposisi_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailkomposisi_grid->id_barang->headerCellClass() ?>"><div id="elh_detailkomposisi_id_barang" class="detailkomposisi_id_barang"><div class="ew-table-header-caption"><?php echo $detailkomposisi_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailkomposisi_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailkomposisi_id_barang" class="detailkomposisi_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkomposisi_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailkomposisi_grid->SortUrl($detailkomposisi_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailkomposisi_grid->jumlah->headerCellClass() ?>"><div id="elh_detailkomposisi_jumlah" class="detailkomposisi_jumlah"><div class="ew-table-header-caption"><?php echo $detailkomposisi_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailkomposisi_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailkomposisi_jumlah" class="detailkomposisi_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkomposisi_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailkomposisi_grid->SortUrl($detailkomposisi_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailkomposisi_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailkomposisi_id_satuan" class="detailkomposisi_id_satuan"><div class="ew-table-header-caption"><?php echo $detailkomposisi_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailkomposisi_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailkomposisi_id_satuan" class="detailkomposisi_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailkomposisi_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailkomposisi_grid->StartRecord = 1;
$detailkomposisi_grid->StopRecord = $detailkomposisi_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailkomposisi->isConfirm() || $detailkomposisi_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailkomposisi_grid->FormKeyCountName) && ($detailkomposisi_grid->isGridAdd() || $detailkomposisi_grid->isGridEdit() || $detailkomposisi->isConfirm())) {
		$detailkomposisi_grid->KeyCount = $CurrentForm->getValue($detailkomposisi_grid->FormKeyCountName);
		$detailkomposisi_grid->StopRecord = $detailkomposisi_grid->StartRecord + $detailkomposisi_grid->KeyCount - 1;
	}
}
$detailkomposisi_grid->RecordCount = $detailkomposisi_grid->StartRecord - 1;
if ($detailkomposisi_grid->Recordset && !$detailkomposisi_grid->Recordset->EOF) {
	$detailkomposisi_grid->Recordset->moveFirst();
	$selectLimit = $detailkomposisi_grid->UseSelectLimit;
	if (!$selectLimit && $detailkomposisi_grid->StartRecord > 1)
		$detailkomposisi_grid->Recordset->move($detailkomposisi_grid->StartRecord - 1);
} elseif (!$detailkomposisi->AllowAddDeleteRow && $detailkomposisi_grid->StopRecord == 0) {
	$detailkomposisi_grid->StopRecord = $detailkomposisi->GridAddRowCount;
}

// Initialize aggregate
$detailkomposisi->RowType = ROWTYPE_AGGREGATEINIT;
$detailkomposisi->resetAttributes();
$detailkomposisi_grid->renderRow();
if ($detailkomposisi_grid->isGridAdd())
	$detailkomposisi_grid->RowIndex = 0;
if ($detailkomposisi_grid->isGridEdit())
	$detailkomposisi_grid->RowIndex = 0;
while ($detailkomposisi_grid->RecordCount < $detailkomposisi_grid->StopRecord) {
	$detailkomposisi_grid->RecordCount++;
	if ($detailkomposisi_grid->RecordCount >= $detailkomposisi_grid->StartRecord) {
		$detailkomposisi_grid->RowCount++;
		if ($detailkomposisi_grid->isGridAdd() || $detailkomposisi_grid->isGridEdit() || $detailkomposisi->isConfirm()) {
			$detailkomposisi_grid->RowIndex++;
			$CurrentForm->Index = $detailkomposisi_grid->RowIndex;
			if ($CurrentForm->hasValue($detailkomposisi_grid->FormActionName) && ($detailkomposisi->isConfirm() || $detailkomposisi_grid->EventCancelled))
				$detailkomposisi_grid->RowAction = strval($CurrentForm->getValue($detailkomposisi_grid->FormActionName));
			elseif ($detailkomposisi_grid->isGridAdd())
				$detailkomposisi_grid->RowAction = "insert";
			else
				$detailkomposisi_grid->RowAction = "";
		}

		// Set up key count
		$detailkomposisi_grid->KeyCount = $detailkomposisi_grid->RowIndex;

		// Init row class and style
		$detailkomposisi->resetAttributes();
		$detailkomposisi->CssClass = "";
		if ($detailkomposisi_grid->isGridAdd()) {
			if ($detailkomposisi->CurrentMode == "copy") {
				$detailkomposisi_grid->loadRowValues($detailkomposisi_grid->Recordset); // Load row values
				$detailkomposisi_grid->setRecordKey($detailkomposisi_grid->RowOldKey, $detailkomposisi_grid->Recordset); // Set old record key
			} else {
				$detailkomposisi_grid->loadRowValues(); // Load default values
				$detailkomposisi_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailkomposisi_grid->loadRowValues($detailkomposisi_grid->Recordset); // Load row values
		}
		$detailkomposisi->RowType = ROWTYPE_VIEW; // Render view
		if ($detailkomposisi_grid->isGridAdd()) // Grid add
			$detailkomposisi->RowType = ROWTYPE_ADD; // Render add
		if ($detailkomposisi_grid->isGridAdd() && $detailkomposisi->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailkomposisi_grid->restoreCurrentRowFormValues($detailkomposisi_grid->RowIndex); // Restore form values
		if ($detailkomposisi_grid->isGridEdit()) { // Grid edit
			if ($detailkomposisi->EventCancelled)
				$detailkomposisi_grid->restoreCurrentRowFormValues($detailkomposisi_grid->RowIndex); // Restore form values
			if ($detailkomposisi_grid->RowAction == "insert")
				$detailkomposisi->RowType = ROWTYPE_ADD; // Render add
			else
				$detailkomposisi->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailkomposisi_grid->isGridEdit() && ($detailkomposisi->RowType == ROWTYPE_EDIT || $detailkomposisi->RowType == ROWTYPE_ADD) && $detailkomposisi->EventCancelled) // Update failed
			$detailkomposisi_grid->restoreCurrentRowFormValues($detailkomposisi_grid->RowIndex); // Restore form values
		if ($detailkomposisi->RowType == ROWTYPE_EDIT) // Edit row
			$detailkomposisi_grid->EditRowCount++;
		if ($detailkomposisi->isConfirm()) // Confirm row
			$detailkomposisi_grid->restoreCurrentRowFormValues($detailkomposisi_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailkomposisi->RowAttrs->merge(["data-rowindex" => $detailkomposisi_grid->RowCount, "id" => "r" . $detailkomposisi_grid->RowCount . "_detailkomposisi", "data-rowtype" => $detailkomposisi->RowType]);

		// Render row
		$detailkomposisi_grid->renderRow();

		// Render list options
		$detailkomposisi_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailkomposisi_grid->RowAction != "delete" && $detailkomposisi_grid->RowAction != "insertdelete" && !($detailkomposisi_grid->RowAction == "insert" && $detailkomposisi->isConfirm() && $detailkomposisi_grid->emptyRow())) {
?>
	<tr <?php echo $detailkomposisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkomposisi_grid->ListOptions->render("body", "left", $detailkomposisi_grid->RowCount);
?>
	<?php if ($detailkomposisi_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailkomposisi_grid->id_barang->cellAttributes() ?>>
<?php if ($detailkomposisi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_id_barang" class="form-group">
<?php $detailkomposisi_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailkomposisi_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_grid->id_barang->ReadOnly || $detailkomposisi_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_grid->id_barang->Lookup->getParamTag($detailkomposisi_grid, "p_x" . $detailkomposisi_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo $detailkomposisi_grid->id_barang->CurrentValue ?>"<?php echo $detailkomposisi_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_id_barang" class="form-group">
<?php $detailkomposisi_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailkomposisi_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_grid->id_barang->ReadOnly || $detailkomposisi_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_grid->id_barang->Lookup->getParamTag($detailkomposisi_grid, "p_x" . $detailkomposisi_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo $detailkomposisi_grid->id_barang->CurrentValue ?>"<?php echo $detailkomposisi_grid->id_barang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_id_barang">
<span<?php echo $detailkomposisi_grid->id_barang->viewAttributes() ?>><?php echo $detailkomposisi_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailkomposisi->isConfirm()) { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="fdetailkomposisigrid$x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="fdetailkomposisigrid$x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="fdetailkomposisigrid$o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="fdetailkomposisigrid$o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_detail_komposisi" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_detail_komposisi" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_detail_komposisi" value="<?php echo HtmlEncode($detailkomposisi_grid->id_detail_komposisi->CurrentValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_id_detail_komposisi" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_detail_komposisi" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_detail_komposisi" value="<?php echo HtmlEncode($detailkomposisi_grid->id_detail_komposisi->OldValue) ?>">
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_EDIT || $detailkomposisi->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_detail_komposisi" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_detail_komposisi" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_detail_komposisi" value="<?php echo HtmlEncode($detailkomposisi_grid->id_detail_komposisi->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailkomposisi_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailkomposisi_grid->jumlah->cellAttributes() ?>>
<?php if ($detailkomposisi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_jumlah" class="form-group">
<input type="text" data-table="detailkomposisi" data-field="x_jumlah" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_grid->jumlah->EditValue ?>"<?php echo $detailkomposisi_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_jumlah" class="form-group">
<input type="text" data-table="detailkomposisi" data-field="x_jumlah" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_grid->jumlah->EditValue ?>"<?php echo $detailkomposisi_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_jumlah">
<span<?php echo $detailkomposisi_grid->jumlah->viewAttributes() ?>><?php echo $detailkomposisi_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailkomposisi->isConfirm()) { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="fdetailkomposisigrid$x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="fdetailkomposisigrid$x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="fdetailkomposisigrid$o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="fdetailkomposisigrid$o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailkomposisi_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailkomposisi_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailkomposisi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailkomposisi_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_grid->id_satuan->ReadOnly || $detailkomposisi_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_grid->id_satuan->Lookup->getParamTag($detailkomposisi_grid, "p_x" . $detailkomposisi_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo $detailkomposisi_grid->id_satuan->CurrentValue ?>"<?php echo $detailkomposisi_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailkomposisi_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_grid->id_satuan->ReadOnly || $detailkomposisi_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_grid->id_satuan->Lookup->getParamTag($detailkomposisi_grid, "p_x" . $detailkomposisi_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo $detailkomposisi_grid->id_satuan->CurrentValue ?>"<?php echo $detailkomposisi_grid->id_satuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailkomposisi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkomposisi_grid->RowCount ?>_detailkomposisi_id_satuan">
<span<?php echo $detailkomposisi_grid->id_satuan->viewAttributes() ?>><?php echo $detailkomposisi_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailkomposisi->isConfirm()) { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="fdetailkomposisigrid$x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="fdetailkomposisigrid$x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="fdetailkomposisigrid$o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="fdetailkomposisigrid$o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailkomposisi_grid->ListOptions->render("body", "right", $detailkomposisi_grid->RowCount);
?>
	</tr>
<?php if ($detailkomposisi->RowType == ROWTYPE_ADD || $detailkomposisi->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailkomposisigrid", "load"], function() {
	fdetailkomposisigrid.updateLists(<?php echo $detailkomposisi_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailkomposisi_grid->isGridAdd() || $detailkomposisi->CurrentMode == "copy")
		if (!$detailkomposisi_grid->Recordset->EOF)
			$detailkomposisi_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailkomposisi->CurrentMode == "add" || $detailkomposisi->CurrentMode == "copy" || $detailkomposisi->CurrentMode == "edit") {
		$detailkomposisi_grid->RowIndex = '$rowindex$';
		$detailkomposisi_grid->loadRowValues();

		// Set row properties
		$detailkomposisi->resetAttributes();
		$detailkomposisi->RowAttrs->merge(["data-rowindex" => $detailkomposisi_grid->RowIndex, "id" => "r0_detailkomposisi", "data-rowtype" => ROWTYPE_ADD]);
		$detailkomposisi->RowAttrs->appendClass("ew-template");
		$detailkomposisi->RowType = ROWTYPE_ADD;

		// Render row
		$detailkomposisi_grid->renderRow();

		// Render list options
		$detailkomposisi_grid->renderListOptions();
		$detailkomposisi_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailkomposisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkomposisi_grid->ListOptions->render("body", "left", $detailkomposisi_grid->RowIndex);
?>
	<?php if ($detailkomposisi_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailkomposisi->isConfirm()) { ?>
<span id="el$rowindex$_detailkomposisi_id_barang" class="form-group detailkomposisi_id_barang">
<?php $detailkomposisi_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailkomposisi_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_grid->id_barang->ReadOnly || $detailkomposisi_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_grid->id_barang->Lookup->getParamTag($detailkomposisi_grid, "p_x" . $detailkomposisi_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo $detailkomposisi_grid->id_barang->CurrentValue ?>"<?php echo $detailkomposisi_grid->id_barang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailkomposisi_id_barang" class="form-group detailkomposisi_id_barang">
<span<?php echo $detailkomposisi_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkomposisi_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkomposisi_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailkomposisi_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailkomposisi->isConfirm()) { ?>
<span id="el$rowindex$_detailkomposisi_jumlah" class="form-group detailkomposisi_jumlah">
<input type="text" data-table="detailkomposisi" data-field="x_jumlah" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_grid->jumlah->EditValue ?>"<?php echo $detailkomposisi_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailkomposisi_jumlah" class="form-group detailkomposisi_jumlah">
<span<?php echo $detailkomposisi_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkomposisi_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_jumlah" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkomposisi_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailkomposisi_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailkomposisi->isConfirm()) { ?>
<span id="el$rowindex$_detailkomposisi_id_satuan" class="form-group detailkomposisi_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailkomposisi_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_grid->id_satuan->ReadOnly || $detailkomposisi_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_grid->id_satuan->Lookup->getParamTag($detailkomposisi_grid, "p_x" . $detailkomposisi_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo $detailkomposisi_grid->id_satuan->CurrentValue ?>"<?php echo $detailkomposisi_grid->id_satuan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailkomposisi_id_satuan" class="form-group detailkomposisi_id_satuan">
<span<?php echo $detailkomposisi_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkomposisi_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" name="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailkomposisi_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkomposisi_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailkomposisi_grid->ListOptions->render("body", "right", $detailkomposisi_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailkomposisigrid", "load"], function() {
	fdetailkomposisigrid.updateLists(<?php echo $detailkomposisi_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailkomposisi->CurrentMode == "add" || $detailkomposisi->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailkomposisi_grid->FormKeyCountName ?>" id="<?php echo $detailkomposisi_grid->FormKeyCountName ?>" value="<?php echo $detailkomposisi_grid->KeyCount ?>">
<?php echo $detailkomposisi_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailkomposisi->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailkomposisi_grid->FormKeyCountName ?>" id="<?php echo $detailkomposisi_grid->FormKeyCountName ?>" value="<?php echo $detailkomposisi_grid->KeyCount ?>">
<?php echo $detailkomposisi_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailkomposisi->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailkomposisigrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailkomposisi_grid->Recordset)
	$detailkomposisi_grid->Recordset->Close();
?>
<?php if ($detailkomposisi_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailkomposisi_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailkomposisi_grid->TotalRecords == 0 && !$detailkomposisi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailkomposisi_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailkomposisi_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailkomposisi_grid->terminate();
?>