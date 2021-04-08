<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailrekmedpenjualan_grid))
	$detailrekmedpenjualan_grid = new detailrekmedpenjualan_grid();

// Run the page
$detailrekmedpenjualan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedpenjualan_grid->Page_Render();
?>
<?php if (!$detailrekmedpenjualan_grid->isExport()) { ?>
<script>
var fdetailrekmedpenjualangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailrekmedpenjualangrid = new ew.Form("fdetailrekmedpenjualangrid", "grid");
	fdetailrekmedpenjualangrid.formKeyCountName = '<?php echo $detailrekmedpenjualan_grid->FormKeyCountName ?>';

	// Validate form
	fdetailrekmedpenjualangrid.validate = function() {
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
			<?php if ($detailrekmedpenjualan_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedpenjualan_grid->id_barang->caption(), $detailrekmedpenjualan_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedpenjualan_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmedpenjualan_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedpenjualan_grid->jumlah->caption(), $detailrekmedpenjualan_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedpenjualan_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmedpenjualan_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedpenjualan_grid->id_satuan->caption(), $detailrekmedpenjualan_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailrekmedpenjualangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailrekmedpenjualangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedpenjualangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedpenjualangrid.lists["x_id_barang"] = <?php echo $detailrekmedpenjualan_grid->id_barang->Lookup->toClientList($detailrekmedpenjualan_grid) ?>;
	fdetailrekmedpenjualangrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedpenjualan_grid->id_barang->lookupOptions()) ?>;
	fdetailrekmedpenjualangrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedpenjualangrid.lists["x_id_satuan"] = <?php echo $detailrekmedpenjualan_grid->id_satuan->Lookup->toClientList($detailrekmedpenjualan_grid) ?>;
	fdetailrekmedpenjualangrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedpenjualan_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedpenjualangrid");
});
</script>
<?php } ?>
<?php
$detailrekmedpenjualan_grid->renderOtherOptions();
?>
<?php if ($detailrekmedpenjualan_grid->TotalRecords > 0 || $detailrekmedpenjualan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailrekmedpenjualan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailrekmedpenjualan">
<?php if ($detailrekmedpenjualan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailrekmedpenjualan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailrekmedpenjualangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailrekmedpenjualan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailrekmedpenjualangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailrekmedpenjualan->RowType = ROWTYPE_HEADER;

// Render list options
$detailrekmedpenjualan_grid->renderListOptions();

// Render list options (header, left)
$detailrekmedpenjualan_grid->ListOptions->render("header", "left");
?>
<?php if ($detailrekmedpenjualan_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmedpenjualan_grid->SortUrl($detailrekmedpenjualan_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedpenjualan_grid->id_barang->headerCellClass() ?>"><div id="elh_detailrekmedpenjualan_id_barang" class="detailrekmedpenjualan_id_barang"><div class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedpenjualan_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailrekmedpenjualan_id_barang" class="detailrekmedpenjualan_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmedpenjualan_grid->SortUrl($detailrekmedpenjualan_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedpenjualan_grid->jumlah->headerCellClass() ?>"><div id="elh_detailrekmedpenjualan_jumlah" class="detailrekmedpenjualan_jumlah"><div class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedpenjualan_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailrekmedpenjualan_jumlah" class="detailrekmedpenjualan_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailrekmedpenjualan_grid->SortUrl($detailrekmedpenjualan_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedpenjualan_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailrekmedpenjualan_id_satuan" class="detailrekmedpenjualan_id_satuan"><div class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedpenjualan_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailrekmedpenjualan_id_satuan" class="detailrekmedpenjualan_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmedpenjualan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailrekmedpenjualan_grid->StartRecord = 1;
$detailrekmedpenjualan_grid->StopRecord = $detailrekmedpenjualan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailrekmedpenjualan->isConfirm() || $detailrekmedpenjualan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailrekmedpenjualan_grid->FormKeyCountName) && ($detailrekmedpenjualan_grid->isGridAdd() || $detailrekmedpenjualan_grid->isGridEdit() || $detailrekmedpenjualan->isConfirm())) {
		$detailrekmedpenjualan_grid->KeyCount = $CurrentForm->getValue($detailrekmedpenjualan_grid->FormKeyCountName);
		$detailrekmedpenjualan_grid->StopRecord = $detailrekmedpenjualan_grid->StartRecord + $detailrekmedpenjualan_grid->KeyCount - 1;
	}
}
$detailrekmedpenjualan_grid->RecordCount = $detailrekmedpenjualan_grid->StartRecord - 1;
if ($detailrekmedpenjualan_grid->Recordset && !$detailrekmedpenjualan_grid->Recordset->EOF) {
	$detailrekmedpenjualan_grid->Recordset->moveFirst();
	$selectLimit = $detailrekmedpenjualan_grid->UseSelectLimit;
	if (!$selectLimit && $detailrekmedpenjualan_grid->StartRecord > 1)
		$detailrekmedpenjualan_grid->Recordset->move($detailrekmedpenjualan_grid->StartRecord - 1);
} elseif (!$detailrekmedpenjualan->AllowAddDeleteRow && $detailrekmedpenjualan_grid->StopRecord == 0) {
	$detailrekmedpenjualan_grid->StopRecord = $detailrekmedpenjualan->GridAddRowCount;
}

// Initialize aggregate
$detailrekmedpenjualan->RowType = ROWTYPE_AGGREGATEINIT;
$detailrekmedpenjualan->resetAttributes();
$detailrekmedpenjualan_grid->renderRow();
if ($detailrekmedpenjualan_grid->isGridAdd())
	$detailrekmedpenjualan_grid->RowIndex = 0;
if ($detailrekmedpenjualan_grid->isGridEdit())
	$detailrekmedpenjualan_grid->RowIndex = 0;
while ($detailrekmedpenjualan_grid->RecordCount < $detailrekmedpenjualan_grid->StopRecord) {
	$detailrekmedpenjualan_grid->RecordCount++;
	if ($detailrekmedpenjualan_grid->RecordCount >= $detailrekmedpenjualan_grid->StartRecord) {
		$detailrekmedpenjualan_grid->RowCount++;
		if ($detailrekmedpenjualan_grid->isGridAdd() || $detailrekmedpenjualan_grid->isGridEdit() || $detailrekmedpenjualan->isConfirm()) {
			$detailrekmedpenjualan_grid->RowIndex++;
			$CurrentForm->Index = $detailrekmedpenjualan_grid->RowIndex;
			if ($CurrentForm->hasValue($detailrekmedpenjualan_grid->FormActionName) && ($detailrekmedpenjualan->isConfirm() || $detailrekmedpenjualan_grid->EventCancelled))
				$detailrekmedpenjualan_grid->RowAction = strval($CurrentForm->getValue($detailrekmedpenjualan_grid->FormActionName));
			elseif ($detailrekmedpenjualan_grid->isGridAdd())
				$detailrekmedpenjualan_grid->RowAction = "insert";
			else
				$detailrekmedpenjualan_grid->RowAction = "";
		}

		// Set up key count
		$detailrekmedpenjualan_grid->KeyCount = $detailrekmedpenjualan_grid->RowIndex;

		// Init row class and style
		$detailrekmedpenjualan->resetAttributes();
		$detailrekmedpenjualan->CssClass = "";
		if ($detailrekmedpenjualan_grid->isGridAdd()) {
			if ($detailrekmedpenjualan->CurrentMode == "copy") {
				$detailrekmedpenjualan_grid->loadRowValues($detailrekmedpenjualan_grid->Recordset); // Load row values
				$detailrekmedpenjualan_grid->setRecordKey($detailrekmedpenjualan_grid->RowOldKey, $detailrekmedpenjualan_grid->Recordset); // Set old record key
			} else {
				$detailrekmedpenjualan_grid->loadRowValues(); // Load default values
				$detailrekmedpenjualan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailrekmedpenjualan_grid->loadRowValues($detailrekmedpenjualan_grid->Recordset); // Load row values
		}
		$detailrekmedpenjualan->RowType = ROWTYPE_VIEW; // Render view
		if ($detailrekmedpenjualan_grid->isGridAdd()) // Grid add
			$detailrekmedpenjualan->RowType = ROWTYPE_ADD; // Render add
		if ($detailrekmedpenjualan_grid->isGridAdd() && $detailrekmedpenjualan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailrekmedpenjualan_grid->restoreCurrentRowFormValues($detailrekmedpenjualan_grid->RowIndex); // Restore form values
		if ($detailrekmedpenjualan_grid->isGridEdit()) { // Grid edit
			if ($detailrekmedpenjualan->EventCancelled)
				$detailrekmedpenjualan_grid->restoreCurrentRowFormValues($detailrekmedpenjualan_grid->RowIndex); // Restore form values
			if ($detailrekmedpenjualan_grid->RowAction == "insert")
				$detailrekmedpenjualan->RowType = ROWTYPE_ADD; // Render add
			else
				$detailrekmedpenjualan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailrekmedpenjualan_grid->isGridEdit() && ($detailrekmedpenjualan->RowType == ROWTYPE_EDIT || $detailrekmedpenjualan->RowType == ROWTYPE_ADD) && $detailrekmedpenjualan->EventCancelled) // Update failed
			$detailrekmedpenjualan_grid->restoreCurrentRowFormValues($detailrekmedpenjualan_grid->RowIndex); // Restore form values
		if ($detailrekmedpenjualan->RowType == ROWTYPE_EDIT) // Edit row
			$detailrekmedpenjualan_grid->EditRowCount++;
		if ($detailrekmedpenjualan->isConfirm()) // Confirm row
			$detailrekmedpenjualan_grid->restoreCurrentRowFormValues($detailrekmedpenjualan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailrekmedpenjualan->RowAttrs->merge(["data-rowindex" => $detailrekmedpenjualan_grid->RowCount, "id" => "r" . $detailrekmedpenjualan_grid->RowCount . "_detailrekmedpenjualan", "data-rowtype" => $detailrekmedpenjualan->RowType]);

		// Render row
		$detailrekmedpenjualan_grid->renderRow();

		// Render list options
		$detailrekmedpenjualan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailrekmedpenjualan_grid->RowAction != "delete" && $detailrekmedpenjualan_grid->RowAction != "insertdelete" && !($detailrekmedpenjualan_grid->RowAction == "insert" && $detailrekmedpenjualan->isConfirm() && $detailrekmedpenjualan_grid->emptyRow())) {
?>
	<tr <?php echo $detailrekmedpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedpenjualan_grid->ListOptions->render("body", "left", $detailrekmedpenjualan_grid->RowCount);
?>
	<?php if ($detailrekmedpenjualan_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailrekmedpenjualan_grid->id_barang->cellAttributes() ?>>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_id_barang" class="form-group">
<?php
$onchange = $detailrekmedpenjualan_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedpenjualan_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedpenjualan_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedpenjualan_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_grid->id_barang->ReadOnly || $detailrekmedpenjualan_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedpenjualangrid"], function() {
	fdetailrekmedpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedpenjualan_grid->id_barang->Lookup->getParamTag($detailrekmedpenjualan_grid, "p_x" . $detailrekmedpenjualan_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_id_barang" class="form-group">
<?php
$onchange = $detailrekmedpenjualan_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedpenjualan_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedpenjualan_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedpenjualan_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_grid->id_barang->ReadOnly || $detailrekmedpenjualan_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedpenjualangrid"], function() {
	fdetailrekmedpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedpenjualan_grid->id_barang->Lookup->getParamTag($detailrekmedpenjualan_grid, "p_x" . $detailrekmedpenjualan_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_id_barang">
<span<?php echo $detailrekmedpenjualan_grid->id_barang->viewAttributes() ?>><?php echo $detailrekmedpenjualan_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailrekmedpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="fdetailrekmedpenjualangrid$x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="fdetailrekmedpenjualangrid$x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="fdetailrekmedpenjualangrid$o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="fdetailrekmedpenjualangrid$o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_detailrekmedpenjualan" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_detailrekmedpenjualan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_detailrekmedpenjualan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_detailrekmedpenjualan->CurrentValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_detailrekmedpenjualan" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_detailrekmedpenjualan" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_detailrekmedpenjualan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_detailrekmedpenjualan->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_EDIT || $detailrekmedpenjualan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_detailrekmedpenjualan" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_detailrekmedpenjualan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_detailrekmedpenjualan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_detailrekmedpenjualan->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailrekmedpenjualan_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailrekmedpenjualan_grid->jumlah->cellAttributes() ?>>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_jumlah" class="form-group">
<input type="text" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedpenjualan_grid->jumlah->EditValue ?>"<?php echo $detailrekmedpenjualan_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_jumlah" class="form-group">
<input type="text" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedpenjualan_grid->jumlah->EditValue ?>"<?php echo $detailrekmedpenjualan_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_jumlah">
<span<?php echo $detailrekmedpenjualan_grid->jumlah->viewAttributes() ?>><?php echo $detailrekmedpenjualan_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailrekmedpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="fdetailrekmedpenjualangrid$x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="fdetailrekmedpenjualangrid$x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="fdetailrekmedpenjualangrid$o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="fdetailrekmedpenjualangrid$o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailrekmedpenjualan_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailrekmedpenjualan_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedpenjualan_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedpenjualan_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_grid->id_satuan->ReadOnly || $detailrekmedpenjualan_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedpenjualan_grid->id_satuan->Lookup->getParamTag($detailrekmedpenjualan_grid, "p_x" . $detailrekmedpenjualan_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedpenjualan_grid->id_satuan->CurrentValue ?>"<?php echo $detailrekmedpenjualan_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedpenjualan_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedpenjualan_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_grid->id_satuan->ReadOnly || $detailrekmedpenjualan_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedpenjualan_grid->id_satuan->Lookup->getParamTag($detailrekmedpenjualan_grid, "p_x" . $detailrekmedpenjualan_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedpenjualan_grid->id_satuan->CurrentValue ?>"<?php echo $detailrekmedpenjualan_grid->id_satuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmedpenjualan_grid->RowCount ?>_detailrekmedpenjualan_id_satuan">
<span<?php echo $detailrekmedpenjualan_grid->id_satuan->viewAttributes() ?>><?php echo $detailrekmedpenjualan_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailrekmedpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="fdetailrekmedpenjualangrid$x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="fdetailrekmedpenjualangrid$x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="fdetailrekmedpenjualangrid$o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="fdetailrekmedpenjualangrid$o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedpenjualan_grid->ListOptions->render("body", "right", $detailrekmedpenjualan_grid->RowCount);
?>
	</tr>
<?php if ($detailrekmedpenjualan->RowType == ROWTYPE_ADD || $detailrekmedpenjualan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailrekmedpenjualangrid", "load"], function() {
	fdetailrekmedpenjualangrid.updateLists(<?php echo $detailrekmedpenjualan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailrekmedpenjualan_grid->isGridAdd() || $detailrekmedpenjualan->CurrentMode == "copy")
		if (!$detailrekmedpenjualan_grid->Recordset->EOF)
			$detailrekmedpenjualan_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailrekmedpenjualan->CurrentMode == "add" || $detailrekmedpenjualan->CurrentMode == "copy" || $detailrekmedpenjualan->CurrentMode == "edit") {
		$detailrekmedpenjualan_grid->RowIndex = '$rowindex$';
		$detailrekmedpenjualan_grid->loadRowValues();

		// Set row properties
		$detailrekmedpenjualan->resetAttributes();
		$detailrekmedpenjualan->RowAttrs->merge(["data-rowindex" => $detailrekmedpenjualan_grid->RowIndex, "id" => "r0_detailrekmedpenjualan", "data-rowtype" => ROWTYPE_ADD]);
		$detailrekmedpenjualan->RowAttrs->appendClass("ew-template");
		$detailrekmedpenjualan->RowType = ROWTYPE_ADD;

		// Render row
		$detailrekmedpenjualan_grid->renderRow();

		// Render list options
		$detailrekmedpenjualan_grid->renderListOptions();
		$detailrekmedpenjualan_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailrekmedpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedpenjualan_grid->ListOptions->render("body", "left", $detailrekmedpenjualan_grid->RowIndex);
?>
	<?php if ($detailrekmedpenjualan_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailrekmedpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmedpenjualan_id_barang" class="form-group detailrekmedpenjualan_id_barang">
<?php
$onchange = $detailrekmedpenjualan_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedpenjualan_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedpenjualan_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedpenjualan_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_grid->id_barang->ReadOnly || $detailrekmedpenjualan_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedpenjualangrid"], function() {
	fdetailrekmedpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedpenjualan_grid->id_barang->Lookup->getParamTag($detailrekmedpenjualan_grid, "p_x" . $detailrekmedpenjualan_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmedpenjualan_id_barang" class="form-group detailrekmedpenjualan_id_barang">
<span<?php echo $detailrekmedpenjualan_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedpenjualan_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmedpenjualan_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailrekmedpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmedpenjualan_jumlah" class="form-group detailrekmedpenjualan_jumlah">
<input type="text" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedpenjualan_grid->jumlah->EditValue ?>"<?php echo $detailrekmedpenjualan_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmedpenjualan_jumlah" class="form-group detailrekmedpenjualan_jumlah">
<span<?php echo $detailrekmedpenjualan_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedpenjualan_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmedpenjualan_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailrekmedpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmedpenjualan_id_satuan" class="form-group detailrekmedpenjualan_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedpenjualan_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedpenjualan_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_grid->id_satuan->ReadOnly || $detailrekmedpenjualan_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedpenjualan_grid->id_satuan->Lookup->getParamTag($detailrekmedpenjualan_grid, "p_x" . $detailrekmedpenjualan_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedpenjualan_grid->id_satuan->CurrentValue ?>"<?php echo $detailrekmedpenjualan_grid->id_satuan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmedpenjualan_id_satuan" class="form-group detailrekmedpenjualan_id_satuan">
<span<?php echo $detailrekmedpenjualan_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedpenjualan_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" name="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedpenjualan_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedpenjualan_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedpenjualan_grid->ListOptions->render("body", "right", $detailrekmedpenjualan_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailrekmedpenjualangrid", "load"], function() {
	fdetailrekmedpenjualangrid.updateLists(<?php echo $detailrekmedpenjualan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailrekmedpenjualan->CurrentMode == "add" || $detailrekmedpenjualan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailrekmedpenjualan_grid->FormKeyCountName ?>" id="<?php echo $detailrekmedpenjualan_grid->FormKeyCountName ?>" value="<?php echo $detailrekmedpenjualan_grid->KeyCount ?>">
<?php echo $detailrekmedpenjualan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailrekmedpenjualan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailrekmedpenjualan_grid->FormKeyCountName ?>" id="<?php echo $detailrekmedpenjualan_grid->FormKeyCountName ?>" value="<?php echo $detailrekmedpenjualan_grid->KeyCount ?>">
<?php echo $detailrekmedpenjualan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailrekmedpenjualan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailrekmedpenjualangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailrekmedpenjualan_grid->Recordset)
	$detailrekmedpenjualan_grid->Recordset->Close();
?>
<?php if ($detailrekmedpenjualan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailrekmedpenjualan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailrekmedpenjualan_grid->TotalRecords == 0 && !$detailrekmedpenjualan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailrekmedpenjualan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailrekmedpenjualan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailrekmedpenjualan_grid->terminate();
?>