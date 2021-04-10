<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailretur_grid))
	$detailretur_grid = new detailretur_grid();

// Run the page
$detailretur_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailretur_grid->Page_Render();
?>
<?php if (!$detailretur_grid->isExport()) { ?>
<script>
var fdetailreturgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailreturgrid = new ew.Form("fdetailreturgrid", "grid");
	fdetailreturgrid.formKeyCountName = '<?php echo $detailretur_grid->FormKeyCountName ?>';

	// Validate form
	fdetailreturgrid.validate = function() {
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
			<?php if ($detailretur_grid->id_detailretur->Required) { ?>
				elm = this.getElements("x" + infix + "_id_detailretur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_grid->id_detailretur->caption(), $detailretur_grid->id_detailretur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailretur_grid->id_retur->Required) { ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_grid->id_retur->caption(), $detailretur_grid->id_retur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailretur_grid->id_retur->errorMessage()) ?>");
			<?php if ($detailretur_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_grid->id_barang->caption(), $detailretur_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailretur_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_grid->jumlah->caption(), $detailretur_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailretur_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailretur_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_grid->id_satuan->caption(), $detailretur_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailreturgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_retur", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailreturgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailreturgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailreturgrid.lists["x_id_barang"] = <?php echo $detailretur_grid->id_barang->Lookup->toClientList($detailretur_grid) ?>;
	fdetailreturgrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailretur_grid->id_barang->lookupOptions()) ?>;
	fdetailreturgrid.lists["x_id_satuan"] = <?php echo $detailretur_grid->id_satuan->Lookup->toClientList($detailretur_grid) ?>;
	fdetailreturgrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailretur_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailreturgrid");
});
</script>
<?php } ?>
<?php
$detailretur_grid->renderOtherOptions();
?>
<?php if ($detailretur_grid->TotalRecords > 0 || $detailretur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailretur_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailretur">
<?php if ($detailretur_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailretur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailreturgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailretur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailreturgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailretur->RowType = ROWTYPE_HEADER;

// Render list options
$detailretur_grid->renderListOptions();

// Render list options (header, left)
$detailretur_grid->ListOptions->render("header", "left");
?>
<?php if ($detailretur_grid->id_detailretur->Visible) { // id_detailretur ?>
	<?php if ($detailretur_grid->SortUrl($detailretur_grid->id_detailretur) == "") { ?>
		<th data-name="id_detailretur" class="<?php echo $detailretur_grid->id_detailretur->headerCellClass() ?>"><div id="elh_detailretur_id_detailretur" class="detailretur_id_detailretur"><div class="ew-table-header-caption"><?php echo $detailretur_grid->id_detailretur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailretur" class="<?php echo $detailretur_grid->id_detailretur->headerCellClass() ?>"><div><div id="elh_detailretur_id_detailretur" class="detailretur_id_detailretur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_grid->id_detailretur->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_grid->id_detailretur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_grid->id_detailretur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_grid->id_retur->Visible) { // id_retur ?>
	<?php if ($detailretur_grid->SortUrl($detailretur_grid->id_retur) == "") { ?>
		<th data-name="id_retur" class="<?php echo $detailretur_grid->id_retur->headerCellClass() ?>"><div id="elh_detailretur_id_retur" class="detailretur_id_retur"><div class="ew-table-header-caption"><?php echo $detailretur_grid->id_retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_retur" class="<?php echo $detailretur_grid->id_retur->headerCellClass() ?>"><div><div id="elh_detailretur_id_retur" class="detailretur_id_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_grid->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_grid->id_retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_grid->id_retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailretur_grid->SortUrl($detailretur_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailretur_grid->id_barang->headerCellClass() ?>"><div id="elh_detailretur_id_barang" class="detailretur_id_barang"><div class="ew-table-header-caption"><?php echo $detailretur_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailretur_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailretur_id_barang" class="detailretur_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailretur_grid->SortUrl($detailretur_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailretur_grid->jumlah->headerCellClass() ?>"><div id="elh_detailretur_jumlah" class="detailretur_jumlah"><div class="ew-table-header-caption"><?php echo $detailretur_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailretur_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailretur_jumlah" class="detailretur_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailretur_grid->SortUrl($detailretur_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailretur_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailretur_id_satuan" class="detailretur_id_satuan"><div class="ew-table-header-caption"><?php echo $detailretur_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailretur_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailretur_id_satuan" class="detailretur_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailretur_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailretur_grid->StartRecord = 1;
$detailretur_grid->StopRecord = $detailretur_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailretur->isConfirm() || $detailretur_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailretur_grid->FormKeyCountName) && ($detailretur_grid->isGridAdd() || $detailretur_grid->isGridEdit() || $detailretur->isConfirm())) {
		$detailretur_grid->KeyCount = $CurrentForm->getValue($detailretur_grid->FormKeyCountName);
		$detailretur_grid->StopRecord = $detailretur_grid->StartRecord + $detailretur_grid->KeyCount - 1;
	}
}
$detailretur_grid->RecordCount = $detailretur_grid->StartRecord - 1;
if ($detailretur_grid->Recordset && !$detailretur_grid->Recordset->EOF) {
	$detailretur_grid->Recordset->moveFirst();
	$selectLimit = $detailretur_grid->UseSelectLimit;
	if (!$selectLimit && $detailretur_grid->StartRecord > 1)
		$detailretur_grid->Recordset->move($detailretur_grid->StartRecord - 1);
} elseif (!$detailretur->AllowAddDeleteRow && $detailretur_grid->StopRecord == 0) {
	$detailretur_grid->StopRecord = $detailretur->GridAddRowCount;
}

// Initialize aggregate
$detailretur->RowType = ROWTYPE_AGGREGATEINIT;
$detailretur->resetAttributes();
$detailretur_grid->renderRow();
if ($detailretur_grid->isGridAdd())
	$detailretur_grid->RowIndex = 0;
if ($detailretur_grid->isGridEdit())
	$detailretur_grid->RowIndex = 0;
while ($detailretur_grid->RecordCount < $detailretur_grid->StopRecord) {
	$detailretur_grid->RecordCount++;
	if ($detailretur_grid->RecordCount >= $detailretur_grid->StartRecord) {
		$detailretur_grid->RowCount++;
		if ($detailretur_grid->isGridAdd() || $detailretur_grid->isGridEdit() || $detailretur->isConfirm()) {
			$detailretur_grid->RowIndex++;
			$CurrentForm->Index = $detailretur_grid->RowIndex;
			if ($CurrentForm->hasValue($detailretur_grid->FormActionName) && ($detailretur->isConfirm() || $detailretur_grid->EventCancelled))
				$detailretur_grid->RowAction = strval($CurrentForm->getValue($detailretur_grid->FormActionName));
			elseif ($detailretur_grid->isGridAdd())
				$detailretur_grid->RowAction = "insert";
			else
				$detailretur_grid->RowAction = "";
		}

		// Set up key count
		$detailretur_grid->KeyCount = $detailretur_grid->RowIndex;

		// Init row class and style
		$detailretur->resetAttributes();
		$detailretur->CssClass = "";
		if ($detailretur_grid->isGridAdd()) {
			if ($detailretur->CurrentMode == "copy") {
				$detailretur_grid->loadRowValues($detailretur_grid->Recordset); // Load row values
				$detailretur_grid->setRecordKey($detailretur_grid->RowOldKey, $detailretur_grid->Recordset); // Set old record key
			} else {
				$detailretur_grid->loadRowValues(); // Load default values
				$detailretur_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailretur_grid->loadRowValues($detailretur_grid->Recordset); // Load row values
		}
		$detailretur->RowType = ROWTYPE_VIEW; // Render view
		if ($detailretur_grid->isGridAdd()) // Grid add
			$detailretur->RowType = ROWTYPE_ADD; // Render add
		if ($detailretur_grid->isGridAdd() && $detailretur->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailretur_grid->restoreCurrentRowFormValues($detailretur_grid->RowIndex); // Restore form values
		if ($detailretur_grid->isGridEdit()) { // Grid edit
			if ($detailretur->EventCancelled)
				$detailretur_grid->restoreCurrentRowFormValues($detailretur_grid->RowIndex); // Restore form values
			if ($detailretur_grid->RowAction == "insert")
				$detailretur->RowType = ROWTYPE_ADD; // Render add
			else
				$detailretur->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailretur_grid->isGridEdit() && ($detailretur->RowType == ROWTYPE_EDIT || $detailretur->RowType == ROWTYPE_ADD) && $detailretur->EventCancelled) // Update failed
			$detailretur_grid->restoreCurrentRowFormValues($detailretur_grid->RowIndex); // Restore form values
		if ($detailretur->RowType == ROWTYPE_EDIT) // Edit row
			$detailretur_grid->EditRowCount++;
		if ($detailretur->isConfirm()) // Confirm row
			$detailretur_grid->restoreCurrentRowFormValues($detailretur_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailretur->RowAttrs->merge(["data-rowindex" => $detailretur_grid->RowCount, "id" => "r" . $detailretur_grid->RowCount . "_detailretur", "data-rowtype" => $detailretur->RowType]);

		// Render row
		$detailretur_grid->renderRow();

		// Render list options
		$detailretur_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailretur_grid->RowAction != "delete" && $detailretur_grid->RowAction != "insertdelete" && !($detailretur_grid->RowAction == "insert" && $detailretur->isConfirm() && $detailretur_grid->emptyRow())) {
?>
	<tr <?php echo $detailretur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailretur_grid->ListOptions->render("body", "left", $detailretur_grid->RowCount);
?>
	<?php if ($detailretur_grid->id_detailretur->Visible) { // id_detailretur ?>
		<td data-name="id_detailretur" <?php echo $detailretur_grid->id_detailretur->cellAttributes() ?>>
<?php if ($detailretur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_detailretur" class="form-group"></span>
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->OldValue) ?>">
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_detailretur" class="form-group">
<span<?php echo $detailretur_grid->id_detailretur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_detailretur->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->CurrentValue) ?>">
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_detailretur">
<span<?php echo $detailretur_grid->id_detailretur->viewAttributes() ?>><?php echo $detailretur_grid->id_detailretur->getViewValue() ?></span>
</span>
<?php if (!$detailretur->isConfirm()) { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailretur_grid->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur" <?php echo $detailretur_grid->id_retur->cellAttributes() ?>>
<?php if ($detailretur->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailretur_grid->id_retur->getSessionValue() != "") { ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_retur" class="form-group">
<span<?php echo $detailretur_grid->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_retur" class="form-group">
<input type="text" data-table="detailretur" data-field="x_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_grid->id_retur->getPlaceHolder()) ?>" value="<?php echo $detailretur_grid->id_retur->EditValue ?>"<?php echo $detailretur_grid->id_retur->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="o<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="o<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->OldValue) ?>">
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailretur_grid->id_retur->getSessionValue() != "") { ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_retur" class="form-group">
<span<?php echo $detailretur_grid->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_retur" class="form-group">
<input type="text" data-table="detailretur" data-field="x_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_grid->id_retur->getPlaceHolder()) ?>" value="<?php echo $detailretur_grid->id_retur->EditValue ?>"<?php echo $detailretur_grid->id_retur->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_retur">
<span<?php echo $detailretur_grid->id_retur->viewAttributes() ?>><?php echo $detailretur_grid->id_retur->getViewValue() ?></span>
</span>
<?php if (!$detailretur->isConfirm()) { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="o<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="o<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailretur_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailretur_grid->id_barang->cellAttributes() ?>>
<?php if ($detailretur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_barang" class="form-group">
<?php $detailretur_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailretur_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailretur_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailretur_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailretur_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailretur_grid->id_barang->ReadOnly || $detailretur_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailretur_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailretur_grid->id_barang->Lookup->getParamTag($detailretur_grid, "p_x" . $detailretur_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailretur_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo $detailretur_grid->id_barang->CurrentValue ?>"<?php echo $detailretur_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="o<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="o<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_barang" class="form-group">
<?php $detailretur_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailretur_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailretur_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailretur_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailretur_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailretur_grid->id_barang->ReadOnly || $detailretur_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailretur_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailretur_grid->id_barang->Lookup->getParamTag($detailretur_grid, "p_x" . $detailretur_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailretur_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo $detailretur_grid->id_barang->CurrentValue ?>"<?php echo $detailretur_grid->id_barang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_barang">
<span<?php echo $detailretur_grid->id_barang->viewAttributes() ?>><?php echo $detailretur_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailretur->isConfirm()) { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="o<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="o<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailretur_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailretur_grid->jumlah->cellAttributes() ?>>
<?php if ($detailretur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_jumlah" class="form-group">
<input type="text" data-table="detailretur" data-field="x_jumlah" name="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailretur_grid->jumlah->EditValue ?>"<?php echo $detailretur_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="o<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="o<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_jumlah" class="form-group">
<input type="text" data-table="detailretur" data-field="x_jumlah" name="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailretur_grid->jumlah->EditValue ?>"<?php echo $detailretur_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_jumlah">
<span<?php echo $detailretur_grid->jumlah->viewAttributes() ?>><?php echo $detailretur_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailretur->isConfirm()) { ?>
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="o<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="o<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailretur_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailretur_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailretur->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_satuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailretur" data-field="x_id_satuan" data-value-separator="<?php echo $detailretur_grid->id_satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" name="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan"<?php echo $detailretur_grid->id_satuan->editAttributes() ?>>
			<?php echo $detailretur_grid->id_satuan->selectOptionListHtml("x{$detailretur_grid->RowIndex}_id_satuan") ?>
		</select>
</div>
<?php echo $detailretur_grid->id_satuan->Lookup->getParamTag($detailretur_grid, "p_x" . $detailretur_grid->RowIndex . "_id_satuan") ?>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_satuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailretur" data-field="x_id_satuan" data-value-separator="<?php echo $detailretur_grid->id_satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" name="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan"<?php echo $detailretur_grid->id_satuan->editAttributes() ?>>
			<?php echo $detailretur_grid->id_satuan->selectOptionListHtml("x{$detailretur_grid->RowIndex}_id_satuan") ?>
		</select>
</div>
<?php echo $detailretur_grid->id_satuan->Lookup->getParamTag($detailretur_grid, "p_x" . $detailretur_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } ?>
<?php if ($detailretur->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailretur_grid->RowCount ?>_detailretur_id_satuan">
<span<?php echo $detailretur_grid->id_satuan->viewAttributes() ?>><?php echo $detailretur_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailretur->isConfirm()) { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="fdetailreturgrid$x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="fdetailreturgrid$o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailretur_grid->ListOptions->render("body", "right", $detailretur_grid->RowCount);
?>
	</tr>
<?php if ($detailretur->RowType == ROWTYPE_ADD || $detailretur->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailreturgrid", "load"], function() {
	fdetailreturgrid.updateLists(<?php echo $detailretur_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailretur_grid->isGridAdd() || $detailretur->CurrentMode == "copy")
		if (!$detailretur_grid->Recordset->EOF)
			$detailretur_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailretur->CurrentMode == "add" || $detailretur->CurrentMode == "copy" || $detailretur->CurrentMode == "edit") {
		$detailretur_grid->RowIndex = '$rowindex$';
		$detailretur_grid->loadRowValues();

		// Set row properties
		$detailretur->resetAttributes();
		$detailretur->RowAttrs->merge(["data-rowindex" => $detailretur_grid->RowIndex, "id" => "r0_detailretur", "data-rowtype" => ROWTYPE_ADD]);
		$detailretur->RowAttrs->appendClass("ew-template");
		$detailretur->RowType = ROWTYPE_ADD;

		// Render row
		$detailretur_grid->renderRow();

		// Render list options
		$detailretur_grid->renderListOptions();
		$detailretur_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailretur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailretur_grid->ListOptions->render("body", "left", $detailretur_grid->RowIndex);
?>
	<?php if ($detailretur_grid->id_detailretur->Visible) { // id_detailretur ?>
		<td data-name="id_detailretur">
<?php if (!$detailretur->isConfirm()) { ?>
<span id="el$rowindex$_detailretur_id_detailretur" class="form-group detailretur_id_detailretur"></span>
<?php } else { ?>
<span id="el$rowindex$_detailretur_id_detailretur" class="form-group detailretur_id_detailretur">
<span<?php echo $detailretur_grid->id_detailretur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_detailretur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailretur" data-field="x_id_detailretur" name="o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" id="o<?php echo $detailretur_grid->RowIndex ?>_id_detailretur" value="<?php echo HtmlEncode($detailretur_grid->id_detailretur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailretur_grid->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur">
<?php if (!$detailretur->isConfirm()) { ?>
<?php if ($detailretur_grid->id_retur->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailretur_id_retur" class="form-group detailretur_id_retur">
<span<?php echo $detailretur_grid->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailretur_id_retur" class="form-group detailretur_id_retur">
<input type="text" data-table="detailretur" data-field="x_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_grid->id_retur->getPlaceHolder()) ?>" value="<?php echo $detailretur_grid->id_retur->EditValue ?>"<?php echo $detailretur_grid->id_retur->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailretur_id_retur" class="form-group detailretur_id_retur">
<span<?php echo $detailretur_grid->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="x<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailretur" data-field="x_id_retur" name="o<?php echo $detailretur_grid->RowIndex ?>_id_retur" id="o<?php echo $detailretur_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($detailretur_grid->id_retur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailretur_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailretur->isConfirm()) { ?>
<span id="el$rowindex$_detailretur_id_barang" class="form-group detailretur_id_barang">
<?php $detailretur_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailretur_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailretur_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailretur_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailretur_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailretur_grid->id_barang->ReadOnly || $detailretur_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailretur_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailretur_grid->id_barang->Lookup->getParamTag($detailretur_grid, "p_x" . $detailretur_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailretur_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo $detailretur_grid->id_barang->CurrentValue ?>"<?php echo $detailretur_grid->id_barang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailretur_id_barang" class="form-group detailretur_id_barang">
<span<?php echo $detailretur_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="x<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" name="o<?php echo $detailretur_grid->RowIndex ?>_id_barang" id="o<?php echo $detailretur_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailretur_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailretur_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailretur->isConfirm()) { ?>
<span id="el$rowindex$_detailretur_jumlah" class="form-group detailretur_jumlah">
<input type="text" data-table="detailretur" data-field="x_jumlah" name="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailretur_grid->jumlah->EditValue ?>"<?php echo $detailretur_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailretur_jumlah" class="form-group detailretur_jumlah">
<span<?php echo $detailretur_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="x<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailretur" data-field="x_jumlah" name="o<?php echo $detailretur_grid->RowIndex ?>_jumlah" id="o<?php echo $detailretur_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailretur_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailretur_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailretur->isConfirm()) { ?>
<span id="el$rowindex$_detailretur_id_satuan" class="form-group detailretur_id_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailretur" data-field="x_id_satuan" data-value-separator="<?php echo $detailretur_grid->id_satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" name="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan"<?php echo $detailretur_grid->id_satuan->editAttributes() ?>>
			<?php echo $detailretur_grid->id_satuan->selectOptionListHtml("x{$detailretur_grid->RowIndex}_id_satuan") ?>
		</select>
</div>
<?php echo $detailretur_grid->id_satuan->Lookup->getParamTag($detailretur_grid, "p_x" . $detailretur_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailretur_id_satuan" class="form-group detailretur_id_satuan">
<span<?php echo $detailretur_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailretur" data-field="x_id_satuan" name="o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailretur_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailretur_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailretur_grid->ListOptions->render("body", "right", $detailretur_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailreturgrid", "load"], function() {
	fdetailreturgrid.updateLists(<?php echo $detailretur_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailretur->CurrentMode == "add" || $detailretur->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailretur_grid->FormKeyCountName ?>" id="<?php echo $detailretur_grid->FormKeyCountName ?>" value="<?php echo $detailretur_grid->KeyCount ?>">
<?php echo $detailretur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailretur->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailretur_grid->FormKeyCountName ?>" id="<?php echo $detailretur_grid->FormKeyCountName ?>" value="<?php echo $detailretur_grid->KeyCount ?>">
<?php echo $detailretur_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailretur->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailreturgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailretur_grid->Recordset)
	$detailretur_grid->Recordset->Close();
?>
<?php if ($detailretur_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailretur_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailretur_grid->TotalRecords == 0 && !$detailretur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailretur_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailretur_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailretur_grid->terminate();
?>