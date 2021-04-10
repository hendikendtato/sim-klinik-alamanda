<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailkirimbarang_grid))
	$detailkirimbarang_grid = new detailkirimbarang_grid();

// Run the page
$detailkirimbarang_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkirimbarang_grid->Page_Render();
?>
<?php if (!$detailkirimbarang_grid->isExport()) { ?>
<script>
var fdetailkirimbaranggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailkirimbaranggrid = new ew.Form("fdetailkirimbaranggrid", "grid");
	fdetailkirimbaranggrid.formKeyCountName = '<?php echo $detailkirimbarang_grid->FormKeyCountName ?>';

	// Validate form
	fdetailkirimbaranggrid.validate = function() {
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
			<?php if ($detailkirimbarang_grid->id_kirimbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_grid->id_kirimbarang->caption(), $detailkirimbarang_grid->id_kirimbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_grid->id_kirimbarang->errorMessage()) ?>");
			<?php if ($detailkirimbarang_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_grid->id_barang->caption(), $detailkirimbarang_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailkirimbarang_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_grid->id_satuan->caption(), $detailkirimbarang_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_grid->id_satuan->errorMessage()) ?>");
			<?php if ($detailkirimbarang_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_grid->jumlah->caption(), $detailkirimbarang_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_grid->jumlah->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailkirimbaranggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_kirimbarang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailkirimbaranggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkirimbaranggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkirimbaranggrid.lists["x_id_kirimbarang"] = <?php echo $detailkirimbarang_grid->id_kirimbarang->Lookup->toClientList($detailkirimbarang_grid) ?>;
	fdetailkirimbaranggrid.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($detailkirimbarang_grid->id_kirimbarang->lookupOptions()) ?>;
	fdetailkirimbaranggrid.autoSuggests["x_id_kirimbarang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailkirimbaranggrid.lists["x_id_barang"] = <?php echo $detailkirimbarang_grid->id_barang->Lookup->toClientList($detailkirimbarang_grid) ?>;
	fdetailkirimbaranggrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailkirimbarang_grid->id_barang->lookupOptions()) ?>;
	fdetailkirimbaranggrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailkirimbaranggrid.lists["x_id_satuan"] = <?php echo $detailkirimbarang_grid->id_satuan->Lookup->toClientList($detailkirimbarang_grid) ?>;
	fdetailkirimbaranggrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailkirimbarang_grid->id_satuan->lookupOptions()) ?>;
	fdetailkirimbaranggrid.autoSuggests["x_id_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailkirimbaranggrid");
});
</script>
<?php } ?>
<?php
$detailkirimbarang_grid->renderOtherOptions();
?>
<?php if ($detailkirimbarang_grid->TotalRecords > 0 || $detailkirimbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailkirimbarang_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailkirimbarang">
<?php if ($detailkirimbarang_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailkirimbarang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailkirimbaranggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailkirimbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailkirimbaranggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailkirimbarang->RowType = ROWTYPE_HEADER;

// Render list options
$detailkirimbarang_grid->renderListOptions();

// Render list options (header, left)
$detailkirimbarang_grid->ListOptions->render("header", "left");
?>
<?php if ($detailkirimbarang_grid->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($detailkirimbarang_grid->SortUrl($detailkirimbarang_grid->id_kirimbarang) == "") { ?>
		<th data-name="id_kirimbarang" class="<?php echo $detailkirimbarang_grid->id_kirimbarang->headerCellClass() ?>"><div id="elh_detailkirimbarang_id_kirimbarang" class="detailkirimbarang_id_kirimbarang"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->id_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kirimbarang" class="<?php echo $detailkirimbarang_grid->id_kirimbarang->headerCellClass() ?>"><div><div id="elh_detailkirimbarang_id_kirimbarang" class="detailkirimbarang_id_kirimbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_grid->id_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_grid->id_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailkirimbarang_grid->SortUrl($detailkirimbarang_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailkirimbarang_grid->id_barang->headerCellClass() ?>"><div id="elh_detailkirimbarang_id_barang" class="detailkirimbarang_id_barang"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailkirimbarang_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailkirimbarang_id_barang" class="detailkirimbarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailkirimbarang_grid->SortUrl($detailkirimbarang_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailkirimbarang_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailkirimbarang_id_satuan" class="detailkirimbarang_id_satuan"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailkirimbarang_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailkirimbarang_id_satuan" class="detailkirimbarang_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailkirimbarang_grid->SortUrl($detailkirimbarang_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailkirimbarang_grid->jumlah->headerCellClass() ?>"><div id="elh_detailkirimbarang_jumlah" class="detailkirimbarang_jumlah"><div class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailkirimbarang_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailkirimbarang_jumlah" class="detailkirimbarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailkirimbarang_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailkirimbarang_grid->StartRecord = 1;
$detailkirimbarang_grid->StopRecord = $detailkirimbarang_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailkirimbarang->isConfirm() || $detailkirimbarang_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailkirimbarang_grid->FormKeyCountName) && ($detailkirimbarang_grid->isGridAdd() || $detailkirimbarang_grid->isGridEdit() || $detailkirimbarang->isConfirm())) {
		$detailkirimbarang_grid->KeyCount = $CurrentForm->getValue($detailkirimbarang_grid->FormKeyCountName);
		$detailkirimbarang_grid->StopRecord = $detailkirimbarang_grid->StartRecord + $detailkirimbarang_grid->KeyCount - 1;
	}
}
$detailkirimbarang_grid->RecordCount = $detailkirimbarang_grid->StartRecord - 1;
if ($detailkirimbarang_grid->Recordset && !$detailkirimbarang_grid->Recordset->EOF) {
	$detailkirimbarang_grid->Recordset->moveFirst();
	$selectLimit = $detailkirimbarang_grid->UseSelectLimit;
	if (!$selectLimit && $detailkirimbarang_grid->StartRecord > 1)
		$detailkirimbarang_grid->Recordset->move($detailkirimbarang_grid->StartRecord - 1);
} elseif (!$detailkirimbarang->AllowAddDeleteRow && $detailkirimbarang_grid->StopRecord == 0) {
	$detailkirimbarang_grid->StopRecord = $detailkirimbarang->GridAddRowCount;
}

// Initialize aggregate
$detailkirimbarang->RowType = ROWTYPE_AGGREGATEINIT;
$detailkirimbarang->resetAttributes();
$detailkirimbarang_grid->renderRow();
if ($detailkirimbarang_grid->isGridAdd())
	$detailkirimbarang_grid->RowIndex = 0;
if ($detailkirimbarang_grid->isGridEdit())
	$detailkirimbarang_grid->RowIndex = 0;
while ($detailkirimbarang_grid->RecordCount < $detailkirimbarang_grid->StopRecord) {
	$detailkirimbarang_grid->RecordCount++;
	if ($detailkirimbarang_grid->RecordCount >= $detailkirimbarang_grid->StartRecord) {
		$detailkirimbarang_grid->RowCount++;
		if ($detailkirimbarang_grid->isGridAdd() || $detailkirimbarang_grid->isGridEdit() || $detailkirimbarang->isConfirm()) {
			$detailkirimbarang_grid->RowIndex++;
			$CurrentForm->Index = $detailkirimbarang_grid->RowIndex;
			if ($CurrentForm->hasValue($detailkirimbarang_grid->FormActionName) && ($detailkirimbarang->isConfirm() || $detailkirimbarang_grid->EventCancelled))
				$detailkirimbarang_grid->RowAction = strval($CurrentForm->getValue($detailkirimbarang_grid->FormActionName));
			elseif ($detailkirimbarang_grid->isGridAdd())
				$detailkirimbarang_grid->RowAction = "insert";
			else
				$detailkirimbarang_grid->RowAction = "";
		}

		// Set up key count
		$detailkirimbarang_grid->KeyCount = $detailkirimbarang_grid->RowIndex;

		// Init row class and style
		$detailkirimbarang->resetAttributes();
		$detailkirimbarang->CssClass = "";
		if ($detailkirimbarang_grid->isGridAdd()) {
			if ($detailkirimbarang->CurrentMode == "copy") {
				$detailkirimbarang_grid->loadRowValues($detailkirimbarang_grid->Recordset); // Load row values
				$detailkirimbarang_grid->setRecordKey($detailkirimbarang_grid->RowOldKey, $detailkirimbarang_grid->Recordset); // Set old record key
			} else {
				$detailkirimbarang_grid->loadRowValues(); // Load default values
				$detailkirimbarang_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailkirimbarang_grid->loadRowValues($detailkirimbarang_grid->Recordset); // Load row values
		}
		$detailkirimbarang->RowType = ROWTYPE_VIEW; // Render view
		if ($detailkirimbarang_grid->isGridAdd()) // Grid add
			$detailkirimbarang->RowType = ROWTYPE_ADD; // Render add
		if ($detailkirimbarang_grid->isGridAdd() && $detailkirimbarang->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailkirimbarang_grid->restoreCurrentRowFormValues($detailkirimbarang_grid->RowIndex); // Restore form values
		if ($detailkirimbarang_grid->isGridEdit()) { // Grid edit
			if ($detailkirimbarang->EventCancelled)
				$detailkirimbarang_grid->restoreCurrentRowFormValues($detailkirimbarang_grid->RowIndex); // Restore form values
			if ($detailkirimbarang_grid->RowAction == "insert")
				$detailkirimbarang->RowType = ROWTYPE_ADD; // Render add
			else
				$detailkirimbarang->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailkirimbarang_grid->isGridEdit() && ($detailkirimbarang->RowType == ROWTYPE_EDIT || $detailkirimbarang->RowType == ROWTYPE_ADD) && $detailkirimbarang->EventCancelled) // Update failed
			$detailkirimbarang_grid->restoreCurrentRowFormValues($detailkirimbarang_grid->RowIndex); // Restore form values
		if ($detailkirimbarang->RowType == ROWTYPE_EDIT) // Edit row
			$detailkirimbarang_grid->EditRowCount++;
		if ($detailkirimbarang->isConfirm()) // Confirm row
			$detailkirimbarang_grid->restoreCurrentRowFormValues($detailkirimbarang_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailkirimbarang->RowAttrs->merge(["data-rowindex" => $detailkirimbarang_grid->RowCount, "id" => "r" . $detailkirimbarang_grid->RowCount . "_detailkirimbarang", "data-rowtype" => $detailkirimbarang->RowType]);

		// Render row
		$detailkirimbarang_grid->renderRow();

		// Render list options
		$detailkirimbarang_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailkirimbarang_grid->RowAction != "delete" && $detailkirimbarang_grid->RowAction != "insertdelete" && !($detailkirimbarang_grid->RowAction == "insert" && $detailkirimbarang->isConfirm() && $detailkirimbarang_grid->emptyRow())) {
?>
	<tr <?php echo $detailkirimbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkirimbarang_grid->ListOptions->render("body", "left", $detailkirimbarang_grid->RowCount);
?>
	<?php if ($detailkirimbarang_grid->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang" <?php echo $detailkirimbarang_grid->id_kirimbarang->cellAttributes() ?>>
<?php if ($detailkirimbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailkirimbarang_grid->id_kirimbarang->getSessionValue() != "") { ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_kirimbarang" class="form-group">
<span<?php echo $detailkirimbarang_grid->id_kirimbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->id_kirimbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_kirimbarang" class="form-group">
<?php
$onchange = $detailkirimbarang_grid->id_kirimbarang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_kirimbarang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_kirimbarang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_kirimbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $detailkirimbarang_grid->id_kirimbarang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_grid->id_kirimbarang->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_kirimbarang") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->OldValue) ?>">
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailkirimbarang_grid->id_kirimbarang->getSessionValue() != "") { ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_kirimbarang" class="form-group">
<span<?php echo $detailkirimbarang_grid->id_kirimbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->id_kirimbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_kirimbarang" class="form-group">
<?php
$onchange = $detailkirimbarang_grid->id_kirimbarang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_kirimbarang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_kirimbarang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_kirimbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $detailkirimbarang_grid->id_kirimbarang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_grid->id_kirimbarang->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_kirimbarang") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_kirimbarang">
<span<?php echo $detailkirimbarang_grid->id_kirimbarang->viewAttributes() ?>><?php echo $detailkirimbarang_grid->id_kirimbarang->getViewValue() ?></span>
</span>
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailkirimbarang_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailkirimbarang_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_EDIT || $detailkirimbarang->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailkirimbarang_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailkirimbarang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailkirimbarang_grid->id_barang->cellAttributes() ?>>
<?php if ($detailkirimbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_barang" class="form-group">
<?php
$onchange = $detailkirimbarang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" data-value-separator="<?php echo $detailkirimbarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailkirimbarang_grid->id_barang->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_barang" class="form-group">
<?php
$onchange = $detailkirimbarang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" data-value-separator="<?php echo $detailkirimbarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailkirimbarang_grid->id_barang->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_barang">
<span<?php echo $detailkirimbarang_grid->id_barang->viewAttributes() ?>><?php echo $detailkirimbarang_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailkirimbarang_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailkirimbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_satuan" class="form-group">
<?php
$onchange = $detailkirimbarang_grid->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" data-value-separator="<?php echo $detailkirimbarang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_grid->id_satuan->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_satuan") ?>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_satuan" class="form-group">
<?php
$onchange = $detailkirimbarang_grid->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" data-value-separator="<?php echo $detailkirimbarang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_grid->id_satuan->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_id_satuan">
<span<?php echo $detailkirimbarang_grid->id_satuan->viewAttributes() ?>><?php echo $detailkirimbarang_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailkirimbarang_grid->jumlah->cellAttributes() ?>>
<?php if ($detailkirimbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_jumlah" class="form-group">
<input type="text" data-table="detailkirimbarang" data-field="x_jumlah" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_grid->jumlah->EditValue ?>"<?php echo $detailkirimbarang_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_jumlah" class="form-group">
<input type="text" data-table="detailkirimbarang" data-field="x_jumlah" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_grid->jumlah->EditValue ?>"<?php echo $detailkirimbarang_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailkirimbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailkirimbarang_grid->RowCount ?>_detailkirimbarang_jumlah">
<span<?php echo $detailkirimbarang_grid->jumlah->viewAttributes() ?>><?php echo $detailkirimbarang_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="fdetailkirimbaranggrid$x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="fdetailkirimbaranggrid$o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailkirimbarang_grid->ListOptions->render("body", "right", $detailkirimbarang_grid->RowCount);
?>
	</tr>
<?php if ($detailkirimbarang->RowType == ROWTYPE_ADD || $detailkirimbarang->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailkirimbaranggrid", "load"], function() {
	fdetailkirimbaranggrid.updateLists(<?php echo $detailkirimbarang_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailkirimbarang_grid->isGridAdd() || $detailkirimbarang->CurrentMode == "copy")
		if (!$detailkirimbarang_grid->Recordset->EOF)
			$detailkirimbarang_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailkirimbarang->CurrentMode == "add" || $detailkirimbarang->CurrentMode == "copy" || $detailkirimbarang->CurrentMode == "edit") {
		$detailkirimbarang_grid->RowIndex = '$rowindex$';
		$detailkirimbarang_grid->loadRowValues();

		// Set row properties
		$detailkirimbarang->resetAttributes();
		$detailkirimbarang->RowAttrs->merge(["data-rowindex" => $detailkirimbarang_grid->RowIndex, "id" => "r0_detailkirimbarang", "data-rowtype" => ROWTYPE_ADD]);
		$detailkirimbarang->RowAttrs->appendClass("ew-template");
		$detailkirimbarang->RowType = ROWTYPE_ADD;

		// Render row
		$detailkirimbarang_grid->renderRow();

		// Render list options
		$detailkirimbarang_grid->renderListOptions();
		$detailkirimbarang_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailkirimbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkirimbarang_grid->ListOptions->render("body", "left", $detailkirimbarang_grid->RowIndex);
?>
	<?php if ($detailkirimbarang_grid->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang">
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<?php if ($detailkirimbarang_grid->id_kirimbarang->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailkirimbarang_id_kirimbarang" class="form-group detailkirimbarang_id_kirimbarang">
<span<?php echo $detailkirimbarang_grid->id_kirimbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->id_kirimbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailkirimbarang_id_kirimbarang" class="form-group detailkirimbarang_id_kirimbarang">
<?php
$onchange = $detailkirimbarang_grid->id_kirimbarang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_kirimbarang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_kirimbarang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_kirimbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $detailkirimbarang_grid->id_kirimbarang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_grid->id_kirimbarang->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_kirimbarang") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailkirimbarang_id_kirimbarang" class="form-group detailkirimbarang_id_kirimbarang">
<span<?php echo $detailkirimbarang_grid->id_kirimbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->id_kirimbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_kirimbarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailkirimbarang_id_barang" class="form-group detailkirimbarang_id_barang">
<?php
$onchange = $detailkirimbarang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" data-value-separator="<?php echo $detailkirimbarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailkirimbarang_grid->id_barang->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailkirimbarang_id_barang" class="form-group detailkirimbarang_id_barang">
<span<?php echo $detailkirimbarang_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailkirimbarang_id_satuan" class="form-group detailkirimbarang_id_satuan">
<?php
$onchange = $detailkirimbarang_grid->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_grid->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan">
	<input type="text" class="form-control" name="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="sv_x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo RemoveHtml($detailkirimbarang_grid->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" data-value-separator="<?php echo $detailkirimbarang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbaranggrid"], function() {
	fdetailkirimbaranggrid.createAutoSuggest({"id":"x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_grid->id_satuan->Lookup->getParamTag($detailkirimbarang_grid, "p_x" . $detailkirimbarang_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailkirimbarang_id_satuan" class="form-group detailkirimbarang_id_satuan">
<span<?php echo $detailkirimbarang_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailkirimbarang_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailkirimbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailkirimbarang_jumlah" class="form-group detailkirimbarang_jumlah">
<input type="text" data-table="detailkirimbarang" data-field="x_jumlah" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_grid->jumlah->EditValue ?>"<?php echo $detailkirimbarang_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailkirimbarang_jumlah" class="form-group detailkirimbarang_jumlah">
<span<?php echo $detailkirimbarang_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailkirimbarang" data-field="x_jumlah" name="o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailkirimbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailkirimbarang_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailkirimbarang_grid->ListOptions->render("body", "right", $detailkirimbarang_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailkirimbaranggrid", "load"], function() {
	fdetailkirimbaranggrid.updateLists(<?php echo $detailkirimbarang_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailkirimbarang->CurrentMode == "add" || $detailkirimbarang->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailkirimbarang_grid->FormKeyCountName ?>" id="<?php echo $detailkirimbarang_grid->FormKeyCountName ?>" value="<?php echo $detailkirimbarang_grid->KeyCount ?>">
<?php echo $detailkirimbarang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailkirimbarang->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailkirimbarang_grid->FormKeyCountName ?>" id="<?php echo $detailkirimbarang_grid->FormKeyCountName ?>" value="<?php echo $detailkirimbarang_grid->KeyCount ?>">
<?php echo $detailkirimbarang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailkirimbarang->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailkirimbaranggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailkirimbarang_grid->Recordset)
	$detailkirimbarang_grid->Recordset->Close();
?>
<?php if ($detailkirimbarang_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailkirimbarang_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailkirimbarang_grid->TotalRecords == 0 && !$detailkirimbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailkirimbarang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailkirimbarang_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailkirimbarang_grid->terminate();
?>