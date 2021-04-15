<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detail_nonjual_grid))
	$detail_nonjual_grid = new detail_nonjual_grid();

// Run the page
$detail_nonjual_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detail_nonjual_grid->Page_Render();
?>
<?php if (!$detail_nonjual_grid->isExport()) { ?>
<script>
var fdetail_nonjualgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetail_nonjualgrid = new ew.Form("fdetail_nonjualgrid", "grid");
	fdetail_nonjualgrid.formKeyCountName = '<?php echo $detail_nonjual_grid->FormKeyCountName ?>';

	// Validate form
	fdetail_nonjualgrid.validate = function() {
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
			<?php if ($detail_nonjual_grid->id_nonjual->Required) { ?>
				elm = this.getElements("x" + infix + "_id_nonjual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_grid->id_nonjual->caption(), $detail_nonjual_grid->id_nonjual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_nonjual");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_grid->id_nonjual->errorMessage()) ?>");
			<?php if ($detail_nonjual_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_grid->id_barang->caption(), $detail_nonjual_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detail_nonjual_grid->stok->Required) { ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_grid->stok->caption(), $detail_nonjual_grid->stok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_grid->stok->errorMessage()) ?>");
			<?php if ($detail_nonjual_grid->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_grid->qty->caption(), $detail_nonjual_grid->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_grid->qty->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetail_nonjualgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_nonjual", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "stok", false)) return false;
		if (ew.valueChanged(fobj, infix, "qty", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetail_nonjualgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetail_nonjualgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetail_nonjualgrid.lists["x_id_barang"] = <?php echo $detail_nonjual_grid->id_barang->Lookup->toClientList($detail_nonjual_grid) ?>;
	fdetail_nonjualgrid.lists["x_id_barang"].options = <?php echo JsonEncode($detail_nonjual_grid->id_barang->lookupOptions()) ?>;
	loadjs.done("fdetail_nonjualgrid");
});
</script>
<?php } ?>
<?php
$detail_nonjual_grid->renderOtherOptions();
?>
<?php if ($detail_nonjual_grid->TotalRecords > 0 || $detail_nonjual->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detail_nonjual_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detail_nonjual">
<?php if ($detail_nonjual_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detail_nonjual_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetail_nonjualgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detail_nonjual" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detail_nonjualgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detail_nonjual->RowType = ROWTYPE_HEADER;

// Render list options
$detail_nonjual_grid->renderListOptions();

// Render list options (header, left)
$detail_nonjual_grid->ListOptions->render("header", "left");
?>
<?php if ($detail_nonjual_grid->id_nonjual->Visible) { // id_nonjual ?>
	<?php if ($detail_nonjual_grid->SortUrl($detail_nonjual_grid->id_nonjual) == "") { ?>
		<th data-name="id_nonjual" class="<?php echo $detail_nonjual_grid->id_nonjual->headerCellClass() ?>"><div id="elh_detail_nonjual_id_nonjual" class="detail_nonjual_id_nonjual"><div class="ew-table-header-caption"><?php echo $detail_nonjual_grid->id_nonjual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_nonjual" class="<?php echo $detail_nonjual_grid->id_nonjual->headerCellClass() ?>"><div><div id="elh_detail_nonjual_id_nonjual" class="detail_nonjual_id_nonjual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_grid->id_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_grid->id_nonjual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_grid->id_nonjual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detail_nonjual_grid->SortUrl($detail_nonjual_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detail_nonjual_grid->id_barang->headerCellClass() ?>"><div id="elh_detail_nonjual_id_barang" class="detail_nonjual_id_barang"><div class="ew-table-header-caption"><?php echo $detail_nonjual_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detail_nonjual_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detail_nonjual_id_barang" class="detail_nonjual_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_grid->stok->Visible) { // stok ?>
	<?php if ($detail_nonjual_grid->SortUrl($detail_nonjual_grid->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $detail_nonjual_grid->stok->headerCellClass() ?>"><div id="elh_detail_nonjual_stok" class="detail_nonjual_stok"><div class="ew-table-header-caption"><?php echo $detail_nonjual_grid->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $detail_nonjual_grid->stok->headerCellClass() ?>"><div><div id="elh_detail_nonjual_stok" class="detail_nonjual_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_grid->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_grid->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_grid->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_grid->qty->Visible) { // qty ?>
	<?php if ($detail_nonjual_grid->SortUrl($detail_nonjual_grid->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detail_nonjual_grid->qty->headerCellClass() ?>"><div id="elh_detail_nonjual_qty" class="detail_nonjual_qty"><div class="ew-table-header-caption"><?php echo $detail_nonjual_grid->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detail_nonjual_grid->qty->headerCellClass() ?>"><div><div id="elh_detail_nonjual_qty" class="detail_nonjual_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_grid->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_grid->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_grid->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detail_nonjual_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detail_nonjual_grid->StartRecord = 1;
$detail_nonjual_grid->StopRecord = $detail_nonjual_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detail_nonjual->isConfirm() || $detail_nonjual_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detail_nonjual_grid->FormKeyCountName) && ($detail_nonjual_grid->isGridAdd() || $detail_nonjual_grid->isGridEdit() || $detail_nonjual->isConfirm())) {
		$detail_nonjual_grid->KeyCount = $CurrentForm->getValue($detail_nonjual_grid->FormKeyCountName);
		$detail_nonjual_grid->StopRecord = $detail_nonjual_grid->StartRecord + $detail_nonjual_grid->KeyCount - 1;
	}
}
$detail_nonjual_grid->RecordCount = $detail_nonjual_grid->StartRecord - 1;
if ($detail_nonjual_grid->Recordset && !$detail_nonjual_grid->Recordset->EOF) {
	$detail_nonjual_grid->Recordset->moveFirst();
	$selectLimit = $detail_nonjual_grid->UseSelectLimit;
	if (!$selectLimit && $detail_nonjual_grid->StartRecord > 1)
		$detail_nonjual_grid->Recordset->move($detail_nonjual_grid->StartRecord - 1);
} elseif (!$detail_nonjual->AllowAddDeleteRow && $detail_nonjual_grid->StopRecord == 0) {
	$detail_nonjual_grid->StopRecord = $detail_nonjual->GridAddRowCount;
}

// Initialize aggregate
$detail_nonjual->RowType = ROWTYPE_AGGREGATEINIT;
$detail_nonjual->resetAttributes();
$detail_nonjual_grid->renderRow();
if ($detail_nonjual_grid->isGridAdd())
	$detail_nonjual_grid->RowIndex = 0;
if ($detail_nonjual_grid->isGridEdit())
	$detail_nonjual_grid->RowIndex = 0;
while ($detail_nonjual_grid->RecordCount < $detail_nonjual_grid->StopRecord) {
	$detail_nonjual_grid->RecordCount++;
	if ($detail_nonjual_grid->RecordCount >= $detail_nonjual_grid->StartRecord) {
		$detail_nonjual_grid->RowCount++;
		if ($detail_nonjual_grid->isGridAdd() || $detail_nonjual_grid->isGridEdit() || $detail_nonjual->isConfirm()) {
			$detail_nonjual_grid->RowIndex++;
			$CurrentForm->Index = $detail_nonjual_grid->RowIndex;
			if ($CurrentForm->hasValue($detail_nonjual_grid->FormActionName) && ($detail_nonjual->isConfirm() || $detail_nonjual_grid->EventCancelled))
				$detail_nonjual_grid->RowAction = strval($CurrentForm->getValue($detail_nonjual_grid->FormActionName));
			elseif ($detail_nonjual_grid->isGridAdd())
				$detail_nonjual_grid->RowAction = "insert";
			else
				$detail_nonjual_grid->RowAction = "";
		}

		// Set up key count
		$detail_nonjual_grid->KeyCount = $detail_nonjual_grid->RowIndex;

		// Init row class and style
		$detail_nonjual->resetAttributes();
		$detail_nonjual->CssClass = "";
		if ($detail_nonjual_grid->isGridAdd()) {
			if ($detail_nonjual->CurrentMode == "copy") {
				$detail_nonjual_grid->loadRowValues($detail_nonjual_grid->Recordset); // Load row values
				$detail_nonjual_grid->setRecordKey($detail_nonjual_grid->RowOldKey, $detail_nonjual_grid->Recordset); // Set old record key
			} else {
				$detail_nonjual_grid->loadRowValues(); // Load default values
				$detail_nonjual_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detail_nonjual_grid->loadRowValues($detail_nonjual_grid->Recordset); // Load row values
		}
		$detail_nonjual->RowType = ROWTYPE_VIEW; // Render view
		if ($detail_nonjual_grid->isGridAdd()) // Grid add
			$detail_nonjual->RowType = ROWTYPE_ADD; // Render add
		if ($detail_nonjual_grid->isGridAdd() && $detail_nonjual->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detail_nonjual_grid->restoreCurrentRowFormValues($detail_nonjual_grid->RowIndex); // Restore form values
		if ($detail_nonjual_grid->isGridEdit()) { // Grid edit
			if ($detail_nonjual->EventCancelled)
				$detail_nonjual_grid->restoreCurrentRowFormValues($detail_nonjual_grid->RowIndex); // Restore form values
			if ($detail_nonjual_grid->RowAction == "insert")
				$detail_nonjual->RowType = ROWTYPE_ADD; // Render add
			else
				$detail_nonjual->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detail_nonjual_grid->isGridEdit() && ($detail_nonjual->RowType == ROWTYPE_EDIT || $detail_nonjual->RowType == ROWTYPE_ADD) && $detail_nonjual->EventCancelled) // Update failed
			$detail_nonjual_grid->restoreCurrentRowFormValues($detail_nonjual_grid->RowIndex); // Restore form values
		if ($detail_nonjual->RowType == ROWTYPE_EDIT) // Edit row
			$detail_nonjual_grid->EditRowCount++;
		if ($detail_nonjual->isConfirm()) // Confirm row
			$detail_nonjual_grid->restoreCurrentRowFormValues($detail_nonjual_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detail_nonjual->RowAttrs->merge(["data-rowindex" => $detail_nonjual_grid->RowCount, "id" => "r" . $detail_nonjual_grid->RowCount . "_detail_nonjual", "data-rowtype" => $detail_nonjual->RowType]);

		// Render row
		$detail_nonjual_grid->renderRow();

		// Render list options
		$detail_nonjual_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detail_nonjual_grid->RowAction != "delete" && $detail_nonjual_grid->RowAction != "insertdelete" && !($detail_nonjual_grid->RowAction == "insert" && $detail_nonjual->isConfirm() && $detail_nonjual_grid->emptyRow())) {
?>
	<tr <?php echo $detail_nonjual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detail_nonjual_grid->ListOptions->render("body", "left", $detail_nonjual_grid->RowCount);
?>
	<?php if ($detail_nonjual_grid->id_nonjual->Visible) { // id_nonjual ?>
		<td data-name="id_nonjual" <?php echo $detail_nonjual_grid->id_nonjual->cellAttributes() ?>>
<?php if ($detail_nonjual->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detail_nonjual_grid->id_nonjual->getSessionValue() != "") { ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_nonjual" class="form-group">
<span<?php echo $detail_nonjual_grid->id_nonjual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->id_nonjual->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_nonjual" class="form-group">
<input type="text" data-table="detail_nonjual" data-field="x_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->id_nonjual->EditValue ?>"<?php echo $detail_nonjual_grid->id_nonjual->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->OldValue) ?>">
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detail_nonjual_grid->id_nonjual->getSessionValue() != "") { ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_nonjual" class="form-group">
<span<?php echo $detail_nonjual_grid->id_nonjual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->id_nonjual->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_nonjual" class="form-group">
<input type="text" data-table="detail_nonjual" data-field="x_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->id_nonjual->EditValue ?>"<?php echo $detail_nonjual_grid->id_nonjual->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_grid->id_nonjual->viewAttributes() ?>><?php echo $detail_nonjual_grid->id_nonjual->getViewValue() ?></span>
</span>
<?php if (!$detail_nonjual->isConfirm()) { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detail_nonjual_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_id" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detail_nonjual_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_EDIT || $detail_nonjual->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detail_nonjual_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($detail_nonjual_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detail_nonjual_grid->id_barang->cellAttributes() ?>>
<?php if ($detail_nonjual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_barang" class="form-group">
<?php $detail_nonjual_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detail_nonjual" data-field="x_id_barang" data-value-separator="<?php echo $detail_nonjual_grid->id_barang->displayValueSeparatorAttribute() ?>" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang"<?php echo $detail_nonjual_grid->id_barang->editAttributes() ?>>
			<?php echo $detail_nonjual_grid->id_barang->selectOptionListHtml("x{$detail_nonjual_grid->RowIndex}_id_barang") ?>
		</select>
</div>
<?php echo $detail_nonjual_grid->id_barang->Lookup->getParamTag($detail_nonjual_grid, "p_x" . $detail_nonjual_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_barang" class="form-group">
<?php $detail_nonjual_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detail_nonjual" data-field="x_id_barang" data-value-separator="<?php echo $detail_nonjual_grid->id_barang->displayValueSeparatorAttribute() ?>" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang"<?php echo $detail_nonjual_grid->id_barang->editAttributes() ?>>
			<?php echo $detail_nonjual_grid->id_barang->selectOptionListHtml("x{$detail_nonjual_grid->RowIndex}_id_barang") ?>
		</select>
</div>
<?php echo $detail_nonjual_grid->id_barang->Lookup->getParamTag($detail_nonjual_grid, "p_x" . $detail_nonjual_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_id_barang">
<span<?php echo $detail_nonjual_grid->id_barang->viewAttributes() ?>><?php echo $detail_nonjual_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detail_nonjual->isConfirm()) { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detail_nonjual_grid->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $detail_nonjual_grid->stok->cellAttributes() ?>>
<?php if ($detail_nonjual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_stok" class="form-group">
<input type="text" data-table="detail_nonjual" data-field="x_stok" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->stok->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->stok->EditValue ?>"<?php echo $detail_nonjual_grid->stok->editAttributes() ?>>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->OldValue) ?>">
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_stok" class="form-group">
<input type="text" data-table="detail_nonjual" data-field="x_stok" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->stok->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->stok->EditValue ?>"<?php echo $detail_nonjual_grid->stok->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_stok">
<span<?php echo $detail_nonjual_grid->stok->viewAttributes() ?>><?php echo $detail_nonjual_grid->stok->getViewValue() ?></span>
</span>
<?php if (!$detail_nonjual->isConfirm()) { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detail_nonjual_grid->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detail_nonjual_grid->qty->cellAttributes() ?>>
<?php if ($detail_nonjual->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_qty" class="form-group">
<input type="text" data-table="detail_nonjual" data-field="x_qty" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->qty->EditValue ?>"<?php echo $detail_nonjual_grid->qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->OldValue) ?>">
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_qty" class="form-group">
<input type="text" data-table="detail_nonjual" data-field="x_qty" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->qty->EditValue ?>"<?php echo $detail_nonjual_grid->qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detail_nonjual->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detail_nonjual_grid->RowCount ?>_detail_nonjual_qty">
<span<?php echo $detail_nonjual_grid->qty->viewAttributes() ?>><?php echo $detail_nonjual_grid->qty->getViewValue() ?></span>
</span>
<?php if (!$detail_nonjual->isConfirm()) { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="fdetail_nonjualgrid$x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="fdetail_nonjualgrid$o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detail_nonjual_grid->ListOptions->render("body", "right", $detail_nonjual_grid->RowCount);
?>
	</tr>
<?php if ($detail_nonjual->RowType == ROWTYPE_ADD || $detail_nonjual->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetail_nonjualgrid", "load"], function() {
	fdetail_nonjualgrid.updateLists(<?php echo $detail_nonjual_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detail_nonjual_grid->isGridAdd() || $detail_nonjual->CurrentMode == "copy")
		if (!$detail_nonjual_grid->Recordset->EOF)
			$detail_nonjual_grid->Recordset->moveNext();
}
?>
<?php
	if ($detail_nonjual->CurrentMode == "add" || $detail_nonjual->CurrentMode == "copy" || $detail_nonjual->CurrentMode == "edit") {
		$detail_nonjual_grid->RowIndex = '$rowindex$';
		$detail_nonjual_grid->loadRowValues();

		// Set row properties
		$detail_nonjual->resetAttributes();
		$detail_nonjual->RowAttrs->merge(["data-rowindex" => $detail_nonjual_grid->RowIndex, "id" => "r0_detail_nonjual", "data-rowtype" => ROWTYPE_ADD]);
		$detail_nonjual->RowAttrs->appendClass("ew-template");
		$detail_nonjual->RowType = ROWTYPE_ADD;

		// Render row
		$detail_nonjual_grid->renderRow();

		// Render list options
		$detail_nonjual_grid->renderListOptions();
		$detail_nonjual_grid->StartRowCount = 0;
?>
	<tr <?php echo $detail_nonjual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detail_nonjual_grid->ListOptions->render("body", "left", $detail_nonjual_grid->RowIndex);
?>
	<?php if ($detail_nonjual_grid->id_nonjual->Visible) { // id_nonjual ?>
		<td data-name="id_nonjual">
<?php if (!$detail_nonjual->isConfirm()) { ?>
<?php if ($detail_nonjual_grid->id_nonjual->getSessionValue() != "") { ?>
<span id="el$rowindex$_detail_nonjual_id_nonjual" class="form-group detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_grid->id_nonjual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->id_nonjual->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detail_nonjual_id_nonjual" class="form-group detail_nonjual_id_nonjual">
<input type="text" data-table="detail_nonjual" data-field="x_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->id_nonjual->EditValue ?>"<?php echo $detail_nonjual_grid->id_nonjual->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detail_nonjual_id_nonjual" class="form-group detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_grid->id_nonjual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->id_nonjual->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_nonjual" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_grid->id_nonjual->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detail_nonjual_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detail_nonjual->isConfirm()) { ?>
<span id="el$rowindex$_detail_nonjual_id_barang" class="form-group detail_nonjual_id_barang">
<?php $detail_nonjual_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detail_nonjual" data-field="x_id_barang" data-value-separator="<?php echo $detail_nonjual_grid->id_barang->displayValueSeparatorAttribute() ?>" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang"<?php echo $detail_nonjual_grid->id_barang->editAttributes() ?>>
			<?php echo $detail_nonjual_grid->id_barang->selectOptionListHtml("x{$detail_nonjual_grid->RowIndex}_id_barang") ?>
		</select>
</div>
<?php echo $detail_nonjual_grid->id_barang->Lookup->getParamTag($detail_nonjual_grid, "p_x" . $detail_nonjual_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detail_nonjual_id_barang" class="form-group detail_nonjual_id_barang">
<span<?php echo $detail_nonjual_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_id_barang" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detail_nonjual_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detail_nonjual_grid->stok->Visible) { // stok ?>
		<td data-name="stok">
<?php if (!$detail_nonjual->isConfirm()) { ?>
<span id="el$rowindex$_detail_nonjual_stok" class="form-group detail_nonjual_stok">
<input type="text" data-table="detail_nonjual" data-field="x_stok" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->stok->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->stok->EditValue ?>"<?php echo $detail_nonjual_grid->stok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detail_nonjual_stok" class="form-group detail_nonjual_stok">
<span<?php echo $detail_nonjual_grid->stok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->stok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_stok" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detail_nonjual_grid->stok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detail_nonjual_grid->qty->Visible) { // qty ?>
		<td data-name="qty">
<?php if (!$detail_nonjual->isConfirm()) { ?>
<span id="el$rowindex$_detail_nonjual_qty" class="form-group detail_nonjual_qty">
<input type="text" data-table="detail_nonjual" data-field="x_qty" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_grid->qty->EditValue ?>"<?php echo $detail_nonjual_grid->qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detail_nonjual_qty" class="form-group detail_nonjual_qty">
<span<?php echo $detail_nonjual_grid->qty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_grid->qty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="x<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detail_nonjual" data-field="x_qty" name="o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" id="o<?php echo $detail_nonjual_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detail_nonjual_grid->qty->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detail_nonjual_grid->ListOptions->render("body", "right", $detail_nonjual_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetail_nonjualgrid", "load"], function() {
	fdetail_nonjualgrid.updateLists(<?php echo $detail_nonjual_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detail_nonjual->CurrentMode == "add" || $detail_nonjual->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detail_nonjual_grid->FormKeyCountName ?>" id="<?php echo $detail_nonjual_grid->FormKeyCountName ?>" value="<?php echo $detail_nonjual_grid->KeyCount ?>">
<?php echo $detail_nonjual_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detail_nonjual->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detail_nonjual_grid->FormKeyCountName ?>" id="<?php echo $detail_nonjual_grid->FormKeyCountName ?>" value="<?php echo $detail_nonjual_grid->KeyCount ?>">
<?php echo $detail_nonjual_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detail_nonjual->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetail_nonjualgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detail_nonjual_grid->Recordset)
	$detail_nonjual_grid->Recordset->Close();
?>
<?php if ($detail_nonjual_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detail_nonjual_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detail_nonjual_grid->TotalRecords == 0 && !$detail_nonjual->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detail_nonjual_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detail_nonjual_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detail_nonjual_grid->terminate();
?>