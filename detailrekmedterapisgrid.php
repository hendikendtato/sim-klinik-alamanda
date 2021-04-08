<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailrekmedterapis_grid))
	$detailrekmedterapis_grid = new detailrekmedterapis_grid();

// Run the page
$detailrekmedterapis_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_grid->Page_Render();
?>
<?php if (!$detailrekmedterapis_grid->isExport()) { ?>
<script>
var fdetailrekmedterapisgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailrekmedterapisgrid = new ew.Form("fdetailrekmedterapisgrid", "grid");
	fdetailrekmedterapisgrid.formKeyCountName = '<?php echo $detailrekmedterapis_grid->FormKeyCountName ?>';

	// Validate form
	fdetailrekmedterapisgrid.validate = function() {
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
			<?php if ($detailrekmedterapis_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_grid->id_barang->caption(), $detailrekmedterapis_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_grid->jumlah->caption(), $detailrekmedterapis_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_grid->id_satuan->caption(), $detailrekmedterapis_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailrekmedterapisgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailrekmedterapisgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedterapisgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedterapisgrid.lists["x_id_barang"] = <?php echo $detailrekmedterapis_grid->id_barang->Lookup->toClientList($detailrekmedterapis_grid) ?>;
	fdetailrekmedterapisgrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedterapis_grid->id_barang->lookupOptions()) ?>;
	fdetailrekmedterapisgrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedterapisgrid.lists["x_id_satuan"] = <?php echo $detailrekmedterapis_grid->id_satuan->Lookup->toClientList($detailrekmedterapis_grid) ?>;
	fdetailrekmedterapisgrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedterapis_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedterapisgrid");
});
</script>
<?php } ?>
<?php
$detailrekmedterapis_grid->renderOtherOptions();
?>
<?php if ($detailrekmedterapis_grid->TotalRecords > 0 || $detailrekmedterapis->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailrekmedterapis_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailrekmedterapis">
<?php if ($detailrekmedterapis_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailrekmedterapis_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailrekmedterapisgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailrekmedterapis" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailrekmedterapisgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailrekmedterapis->RowType = ROWTYPE_HEADER;

// Render list options
$detailrekmedterapis_grid->renderListOptions();

// Render list options (header, left)
$detailrekmedterapis_grid->ListOptions->render("header", "left");
?>
<?php if ($detailrekmedterapis_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmedterapis_grid->SortUrl($detailrekmedterapis_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedterapis_grid->id_barang->headerCellClass() ?>"><div id="elh_detailrekmedterapis_id_barang" class="detailrekmedterapis_id_barang"><div class="ew-table-header-caption"><?php echo $detailrekmedterapis_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedterapis_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailrekmedterapis_id_barang" class="detailrekmedterapis_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedterapis_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmedterapis_grid->SortUrl($detailrekmedterapis_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedterapis_grid->jumlah->headerCellClass() ?>"><div id="elh_detailrekmedterapis_jumlah" class="detailrekmedterapis_jumlah"><div class="ew-table-header-caption"><?php echo $detailrekmedterapis_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedterapis_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailrekmedterapis_jumlah" class="detailrekmedterapis_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedterapis_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailrekmedterapis_grid->SortUrl($detailrekmedterapis_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedterapis_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailrekmedterapis_id_satuan" class="detailrekmedterapis_id_satuan"><div class="ew-table-header-caption"><?php echo $detailrekmedterapis_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedterapis_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailrekmedterapis_id_satuan" class="detailrekmedterapis_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmedterapis_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailrekmedterapis_grid->StartRecord = 1;
$detailrekmedterapis_grid->StopRecord = $detailrekmedterapis_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailrekmedterapis->isConfirm() || $detailrekmedterapis_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailrekmedterapis_grid->FormKeyCountName) && ($detailrekmedterapis_grid->isGridAdd() || $detailrekmedterapis_grid->isGridEdit() || $detailrekmedterapis->isConfirm())) {
		$detailrekmedterapis_grid->KeyCount = $CurrentForm->getValue($detailrekmedterapis_grid->FormKeyCountName);
		$detailrekmedterapis_grid->StopRecord = $detailrekmedterapis_grid->StartRecord + $detailrekmedterapis_grid->KeyCount - 1;
	}
}
$detailrekmedterapis_grid->RecordCount = $detailrekmedterapis_grid->StartRecord - 1;
if ($detailrekmedterapis_grid->Recordset && !$detailrekmedterapis_grid->Recordset->EOF) {
	$detailrekmedterapis_grid->Recordset->moveFirst();
	$selectLimit = $detailrekmedterapis_grid->UseSelectLimit;
	if (!$selectLimit && $detailrekmedterapis_grid->StartRecord > 1)
		$detailrekmedterapis_grid->Recordset->move($detailrekmedterapis_grid->StartRecord - 1);
} elseif (!$detailrekmedterapis->AllowAddDeleteRow && $detailrekmedterapis_grid->StopRecord == 0) {
	$detailrekmedterapis_grid->StopRecord = $detailrekmedterapis->GridAddRowCount;
}

// Initialize aggregate
$detailrekmedterapis->RowType = ROWTYPE_AGGREGATEINIT;
$detailrekmedterapis->resetAttributes();
$detailrekmedterapis_grid->renderRow();
if ($detailrekmedterapis_grid->isGridAdd())
	$detailrekmedterapis_grid->RowIndex = 0;
if ($detailrekmedterapis_grid->isGridEdit())
	$detailrekmedterapis_grid->RowIndex = 0;
while ($detailrekmedterapis_grid->RecordCount < $detailrekmedterapis_grid->StopRecord) {
	$detailrekmedterapis_grid->RecordCount++;
	if ($detailrekmedterapis_grid->RecordCount >= $detailrekmedterapis_grid->StartRecord) {
		$detailrekmedterapis_grid->RowCount++;
		if ($detailrekmedterapis_grid->isGridAdd() || $detailrekmedterapis_grid->isGridEdit() || $detailrekmedterapis->isConfirm()) {
			$detailrekmedterapis_grid->RowIndex++;
			$CurrentForm->Index = $detailrekmedterapis_grid->RowIndex;
			if ($CurrentForm->hasValue($detailrekmedterapis_grid->FormActionName) && ($detailrekmedterapis->isConfirm() || $detailrekmedterapis_grid->EventCancelled))
				$detailrekmedterapis_grid->RowAction = strval($CurrentForm->getValue($detailrekmedterapis_grid->FormActionName));
			elseif ($detailrekmedterapis_grid->isGridAdd())
				$detailrekmedterapis_grid->RowAction = "insert";
			else
				$detailrekmedterapis_grid->RowAction = "";
		}

		// Set up key count
		$detailrekmedterapis_grid->KeyCount = $detailrekmedterapis_grid->RowIndex;

		// Init row class and style
		$detailrekmedterapis->resetAttributes();
		$detailrekmedterapis->CssClass = "";
		if ($detailrekmedterapis_grid->isGridAdd()) {
			if ($detailrekmedterapis->CurrentMode == "copy") {
				$detailrekmedterapis_grid->loadRowValues($detailrekmedterapis_grid->Recordset); // Load row values
				$detailrekmedterapis_grid->setRecordKey($detailrekmedterapis_grid->RowOldKey, $detailrekmedterapis_grid->Recordset); // Set old record key
			} else {
				$detailrekmedterapis_grid->loadRowValues(); // Load default values
				$detailrekmedterapis_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailrekmedterapis_grid->loadRowValues($detailrekmedterapis_grid->Recordset); // Load row values
		}
		$detailrekmedterapis->RowType = ROWTYPE_VIEW; // Render view
		if ($detailrekmedterapis_grid->isGridAdd()) // Grid add
			$detailrekmedterapis->RowType = ROWTYPE_ADD; // Render add
		if ($detailrekmedterapis_grid->isGridAdd() && $detailrekmedterapis->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailrekmedterapis_grid->restoreCurrentRowFormValues($detailrekmedterapis_grid->RowIndex); // Restore form values
		if ($detailrekmedterapis_grid->isGridEdit()) { // Grid edit
			if ($detailrekmedterapis->EventCancelled)
				$detailrekmedterapis_grid->restoreCurrentRowFormValues($detailrekmedterapis_grid->RowIndex); // Restore form values
			if ($detailrekmedterapis_grid->RowAction == "insert")
				$detailrekmedterapis->RowType = ROWTYPE_ADD; // Render add
			else
				$detailrekmedterapis->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailrekmedterapis_grid->isGridEdit() && ($detailrekmedterapis->RowType == ROWTYPE_EDIT || $detailrekmedterapis->RowType == ROWTYPE_ADD) && $detailrekmedterapis->EventCancelled) // Update failed
			$detailrekmedterapis_grid->restoreCurrentRowFormValues($detailrekmedterapis_grid->RowIndex); // Restore form values
		if ($detailrekmedterapis->RowType == ROWTYPE_EDIT) // Edit row
			$detailrekmedterapis_grid->EditRowCount++;
		if ($detailrekmedterapis->isConfirm()) // Confirm row
			$detailrekmedterapis_grid->restoreCurrentRowFormValues($detailrekmedterapis_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailrekmedterapis->RowAttrs->merge(["data-rowindex" => $detailrekmedterapis_grid->RowCount, "id" => "r" . $detailrekmedterapis_grid->RowCount . "_detailrekmedterapis", "data-rowtype" => $detailrekmedterapis->RowType]);

		// Render row
		$detailrekmedterapis_grid->renderRow();

		// Render list options
		$detailrekmedterapis_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailrekmedterapis_grid->RowAction != "delete" && $detailrekmedterapis_grid->RowAction != "insertdelete" && !($detailrekmedterapis_grid->RowAction == "insert" && $detailrekmedterapis->isConfirm() && $detailrekmedterapis_grid->emptyRow())) {
?>
	<tr <?php echo $detailrekmedterapis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedterapis_grid->ListOptions->render("body", "left", $detailrekmedterapis_grid->RowCount);
?>
	<?php if ($detailrekmedterapis_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailrekmedterapis_grid->id_barang->cellAttributes() ?>>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_id_barang" class="form-group">
<?php
$onchange = $detailrekmedterapis_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_grid->id_barang->ReadOnly || $detailrekmedterapis_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapisgrid"], function() {
	fdetailrekmedterapisgrid.createAutoSuggest({"id":"x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_grid->id_barang->Lookup->getParamTag($detailrekmedterapis_grid, "p_x" . $detailrekmedterapis_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_id_barang" class="form-group">
<?php
$onchange = $detailrekmedterapis_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_grid->id_barang->ReadOnly || $detailrekmedterapis_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapisgrid"], function() {
	fdetailrekmedterapisgrid.createAutoSuggest({"id":"x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_grid->id_barang->Lookup->getParamTag($detailrekmedterapis_grid, "p_x" . $detailrekmedterapis_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_id_barang">
<span<?php echo $detailrekmedterapis_grid->id_barang->viewAttributes() ?>><?php echo $detailrekmedterapis_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailrekmedterapis->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="fdetailrekmedterapisgrid$x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="fdetailrekmedterapisgrid$x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="fdetailrekmedterapisgrid$o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="fdetailrekmedterapisgrid$o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_detailrekmedterapis" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_detailrekmedterapis" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_detailrekmedterapis" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_detailrekmedterapis->CurrentValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_detailrekmedterapis" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_detailrekmedterapis" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_detailrekmedterapis" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_detailrekmedterapis->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_EDIT || $detailrekmedterapis->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_detailrekmedterapis" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_detailrekmedterapis" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_detailrekmedterapis" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_detailrekmedterapis->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailrekmedterapis_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailrekmedterapis_grid->jumlah->cellAttributes() ?>>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_jumlah" class="form-group">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_grid->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_jumlah" class="form-group">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_grid->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_jumlah">
<span<?php echo $detailrekmedterapis_grid->jumlah->viewAttributes() ?>><?php echo $detailrekmedterapis_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailrekmedterapis->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="fdetailrekmedterapisgrid$x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="fdetailrekmedterapisgrid$x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="fdetailrekmedterapisgrid$o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="fdetailrekmedterapisgrid$o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailrekmedterapis_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_grid->id_satuan->ReadOnly || $detailrekmedterapis_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_grid->id_satuan->Lookup->getParamTag($detailrekmedterapis_grid, "p_x" . $detailrekmedterapis_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedterapis_grid->id_satuan->CurrentValue ?>"<?php echo $detailrekmedterapis_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_grid->id_satuan->ReadOnly || $detailrekmedterapis_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_grid->id_satuan->Lookup->getParamTag($detailrekmedterapis_grid, "p_x" . $detailrekmedterapis_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedterapis_grid->id_satuan->CurrentValue ?>"<?php echo $detailrekmedterapis_grid->id_satuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailrekmedterapis_grid->RowCount ?>_detailrekmedterapis_id_satuan">
<span<?php echo $detailrekmedterapis_grid->id_satuan->viewAttributes() ?>><?php echo $detailrekmedterapis_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailrekmedterapis->isConfirm()) { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="fdetailrekmedterapisgrid$x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="fdetailrekmedterapisgrid$x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="fdetailrekmedterapisgrid$o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="fdetailrekmedterapisgrid$o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedterapis_grid->ListOptions->render("body", "right", $detailrekmedterapis_grid->RowCount);
?>
	</tr>
<?php if ($detailrekmedterapis->RowType == ROWTYPE_ADD || $detailrekmedterapis->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailrekmedterapisgrid", "load"], function() {
	fdetailrekmedterapisgrid.updateLists(<?php echo $detailrekmedterapis_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailrekmedterapis_grid->isGridAdd() || $detailrekmedterapis->CurrentMode == "copy")
		if (!$detailrekmedterapis_grid->Recordset->EOF)
			$detailrekmedterapis_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailrekmedterapis->CurrentMode == "add" || $detailrekmedterapis->CurrentMode == "copy" || $detailrekmedterapis->CurrentMode == "edit") {
		$detailrekmedterapis_grid->RowIndex = '$rowindex$';
		$detailrekmedterapis_grid->loadRowValues();

		// Set row properties
		$detailrekmedterapis->resetAttributes();
		$detailrekmedterapis->RowAttrs->merge(["data-rowindex" => $detailrekmedterapis_grid->RowIndex, "id" => "r0_detailrekmedterapis", "data-rowtype" => ROWTYPE_ADD]);
		$detailrekmedterapis->RowAttrs->appendClass("ew-template");
		$detailrekmedterapis->RowType = ROWTYPE_ADD;

		// Render row
		$detailrekmedterapis_grid->renderRow();

		// Render list options
		$detailrekmedterapis_grid->renderListOptions();
		$detailrekmedterapis_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailrekmedterapis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedterapis_grid->ListOptions->render("body", "left", $detailrekmedterapis_grid->RowIndex);
?>
	<?php if ($detailrekmedterapis_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailrekmedterapis->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmedterapis_id_barang" class="form-group detailrekmedterapis_id_barang">
<?php
$onchange = $detailrekmedterapis_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_grid->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_grid->id_barang->ReadOnly || $detailrekmedterapis_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapisgrid"], function() {
	fdetailrekmedterapisgrid.createAutoSuggest({"id":"x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_grid->id_barang->Lookup->getParamTag($detailrekmedterapis_grid, "p_x" . $detailrekmedterapis_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmedterapis_id_barang" class="form-group detailrekmedterapis_id_barang">
<span<?php echo $detailrekmedterapis_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedterapis_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailrekmedterapis->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmedterapis_jumlah" class="form-group detailrekmedterapis_jumlah">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_grid->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmedterapis_jumlah" class="form-group detailrekmedterapis_jumlah">
<span<?php echo $detailrekmedterapis_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedterapis_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailrekmedterapis->isConfirm()) { ?>
<span id="el$rowindex$_detailrekmedterapis_id_satuan" class="form-group detailrekmedterapis_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_grid->id_satuan->ReadOnly || $detailrekmedterapis_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_grid->id_satuan->Lookup->getParamTag($detailrekmedterapis_grid, "p_x" . $detailrekmedterapis_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedterapis_grid->id_satuan->CurrentValue ?>"<?php echo $detailrekmedterapis_grid->id_satuan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailrekmedterapis_id_satuan" class="form-group detailrekmedterapis_id_satuan">
<span<?php echo $detailrekmedterapis_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedterapis_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedterapis_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedterapis_grid->ListOptions->render("body", "right", $detailrekmedterapis_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailrekmedterapisgrid", "load"], function() {
	fdetailrekmedterapisgrid.updateLists(<?php echo $detailrekmedterapis_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailrekmedterapis->CurrentMode == "add" || $detailrekmedterapis->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailrekmedterapis_grid->FormKeyCountName ?>" id="<?php echo $detailrekmedterapis_grid->FormKeyCountName ?>" value="<?php echo $detailrekmedterapis_grid->KeyCount ?>">
<?php echo $detailrekmedterapis_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailrekmedterapis->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailrekmedterapis_grid->FormKeyCountName ?>" id="<?php echo $detailrekmedterapis_grid->FormKeyCountName ?>" value="<?php echo $detailrekmedterapis_grid->KeyCount ?>">
<?php echo $detailrekmedterapis_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailrekmedterapis->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailrekmedterapisgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailrekmedterapis_grid->Recordset)
	$detailrekmedterapis_grid->Recordset->Close();
?>
<?php if ($detailrekmedterapis_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailrekmedterapis_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailrekmedterapis_grid->TotalRecords == 0 && !$detailrekmedterapis->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailrekmedterapis_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailrekmedterapis_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailrekmedterapis_grid->terminate();
?>