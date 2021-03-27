<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailjurnal_grid))
	$detailjurnal_grid = new detailjurnal_grid();

// Run the page
$detailjurnal_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailjurnal_grid->Page_Render();
?>
<?php if (!$detailjurnal_grid->isExport()) { ?>
<script>
var fdetailjurnalgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailjurnalgrid = new ew.Form("fdetailjurnalgrid", "grid");
	fdetailjurnalgrid.formKeyCountName = '<?php echo $detailjurnal_grid->FormKeyCountName ?>';

	// Validate form
	fdetailjurnalgrid.validate = function() {
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
			<?php if ($detailjurnal_grid->id_detailjurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_detailjurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_grid->id_detailjurnal->caption(), $detailjurnal_grid->id_detailjurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailjurnal_grid->id_jurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_grid->id_jurnal->caption(), $detailjurnal_grid->id_jurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_jurnal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailjurnal_grid->id_jurnal->errorMessage()) ?>");
			<?php if ($detailjurnal_grid->id_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_id_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_grid->id_akun->caption(), $detailjurnal_grid->id_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailjurnal_grid->debet->Required) { ?>
				elm = this.getElements("x" + infix + "_debet");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_grid->debet->caption(), $detailjurnal_grid->debet->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_debet");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailjurnal_grid->debet->errorMessage()) ?>");
			<?php if ($detailjurnal_grid->kredit->Required) { ?>
				elm = this.getElements("x" + infix + "_kredit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_grid->kredit->caption(), $detailjurnal_grid->kredit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kredit");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailjurnal_grid->kredit->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailjurnalgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_jurnal", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_akun", false)) return false;
		if (ew.valueChanged(fobj, infix, "debet", false)) return false;
		if (ew.valueChanged(fobj, infix, "kredit", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailjurnalgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailjurnalgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailjurnalgrid.lists["x_id_akun"] = <?php echo $detailjurnal_grid->id_akun->Lookup->toClientList($detailjurnal_grid) ?>;
	fdetailjurnalgrid.lists["x_id_akun"].options = <?php echo JsonEncode($detailjurnal_grid->id_akun->lookupOptions()) ?>;
	loadjs.done("fdetailjurnalgrid");
});
</script>
<?php } ?>
<?php
$detailjurnal_grid->renderOtherOptions();
?>
<?php if ($detailjurnal_grid->TotalRecords > 0 || $detailjurnal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailjurnal_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailjurnal">
<?php if ($detailjurnal_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailjurnal_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailjurnalgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailjurnal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailjurnalgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailjurnal->RowType = ROWTYPE_HEADER;

// Render list options
$detailjurnal_grid->renderListOptions();

// Render list options (header, left)
$detailjurnal_grid->ListOptions->render("header", "left");
?>
<?php if ($detailjurnal_grid->id_detailjurnal->Visible) { // id_detailjurnal ?>
	<?php if ($detailjurnal_grid->SortUrl($detailjurnal_grid->id_detailjurnal) == "") { ?>
		<th data-name="id_detailjurnal" class="<?php echo $detailjurnal_grid->id_detailjurnal->headerCellClass() ?>"><div id="elh_detailjurnal_id_detailjurnal" class="detailjurnal_id_detailjurnal"><div class="ew-table-header-caption"><?php echo $detailjurnal_grid->id_detailjurnal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailjurnal" class="<?php echo $detailjurnal_grid->id_detailjurnal->headerCellClass() ?>"><div><div id="elh_detailjurnal_id_detailjurnal" class="detailjurnal_id_detailjurnal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_grid->id_detailjurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_grid->id_detailjurnal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_grid->id_detailjurnal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_grid->id_jurnal->Visible) { // id_jurnal ?>
	<?php if ($detailjurnal_grid->SortUrl($detailjurnal_grid->id_jurnal) == "") { ?>
		<th data-name="id_jurnal" class="<?php echo $detailjurnal_grid->id_jurnal->headerCellClass() ?>"><div id="elh_detailjurnal_id_jurnal" class="detailjurnal_id_jurnal"><div class="ew-table-header-caption"><?php echo $detailjurnal_grid->id_jurnal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jurnal" class="<?php echo $detailjurnal_grid->id_jurnal->headerCellClass() ?>"><div><div id="elh_detailjurnal_id_jurnal" class="detailjurnal_id_jurnal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_grid->id_jurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_grid->id_jurnal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_grid->id_jurnal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_grid->id_akun->Visible) { // id_akun ?>
	<?php if ($detailjurnal_grid->SortUrl($detailjurnal_grid->id_akun) == "") { ?>
		<th data-name="id_akun" class="<?php echo $detailjurnal_grid->id_akun->headerCellClass() ?>"><div id="elh_detailjurnal_id_akun" class="detailjurnal_id_akun"><div class="ew-table-header-caption"><?php echo $detailjurnal_grid->id_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_akun" class="<?php echo $detailjurnal_grid->id_akun->headerCellClass() ?>"><div><div id="elh_detailjurnal_id_akun" class="detailjurnal_id_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_grid->id_akun->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_grid->id_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_grid->id_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_grid->debet->Visible) { // debet ?>
	<?php if ($detailjurnal_grid->SortUrl($detailjurnal_grid->debet) == "") { ?>
		<th data-name="debet" class="<?php echo $detailjurnal_grid->debet->headerCellClass() ?>"><div id="elh_detailjurnal_debet" class="detailjurnal_debet"><div class="ew-table-header-caption"><?php echo $detailjurnal_grid->debet->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="debet" class="<?php echo $detailjurnal_grid->debet->headerCellClass() ?>"><div><div id="elh_detailjurnal_debet" class="detailjurnal_debet">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_grid->debet->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_grid->debet->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_grid->debet->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_grid->kredit->Visible) { // kredit ?>
	<?php if ($detailjurnal_grid->SortUrl($detailjurnal_grid->kredit) == "") { ?>
		<th data-name="kredit" class="<?php echo $detailjurnal_grid->kredit->headerCellClass() ?>"><div id="elh_detailjurnal_kredit" class="detailjurnal_kredit"><div class="ew-table-header-caption"><?php echo $detailjurnal_grid->kredit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kredit" class="<?php echo $detailjurnal_grid->kredit->headerCellClass() ?>"><div><div id="elh_detailjurnal_kredit" class="detailjurnal_kredit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_grid->kredit->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_grid->kredit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_grid->kredit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailjurnal_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailjurnal_grid->StartRecord = 1;
$detailjurnal_grid->StopRecord = $detailjurnal_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailjurnal->isConfirm() || $detailjurnal_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailjurnal_grid->FormKeyCountName) && ($detailjurnal_grid->isGridAdd() || $detailjurnal_grid->isGridEdit() || $detailjurnal->isConfirm())) {
		$detailjurnal_grid->KeyCount = $CurrentForm->getValue($detailjurnal_grid->FormKeyCountName);
		$detailjurnal_grid->StopRecord = $detailjurnal_grid->StartRecord + $detailjurnal_grid->KeyCount - 1;
	}
}
$detailjurnal_grid->RecordCount = $detailjurnal_grid->StartRecord - 1;
if ($detailjurnal_grid->Recordset && !$detailjurnal_grid->Recordset->EOF) {
	$detailjurnal_grid->Recordset->moveFirst();
	$selectLimit = $detailjurnal_grid->UseSelectLimit;
	if (!$selectLimit && $detailjurnal_grid->StartRecord > 1)
		$detailjurnal_grid->Recordset->move($detailjurnal_grid->StartRecord - 1);
} elseif (!$detailjurnal->AllowAddDeleteRow && $detailjurnal_grid->StopRecord == 0) {
	$detailjurnal_grid->StopRecord = $detailjurnal->GridAddRowCount;
}

// Initialize aggregate
$detailjurnal->RowType = ROWTYPE_AGGREGATEINIT;
$detailjurnal->resetAttributes();
$detailjurnal_grid->renderRow();
if ($detailjurnal_grid->isGridAdd())
	$detailjurnal_grid->RowIndex = 0;
if ($detailjurnal_grid->isGridEdit())
	$detailjurnal_grid->RowIndex = 0;
while ($detailjurnal_grid->RecordCount < $detailjurnal_grid->StopRecord) {
	$detailjurnal_grid->RecordCount++;
	if ($detailjurnal_grid->RecordCount >= $detailjurnal_grid->StartRecord) {
		$detailjurnal_grid->RowCount++;
		if ($detailjurnal_grid->isGridAdd() || $detailjurnal_grid->isGridEdit() || $detailjurnal->isConfirm()) {
			$detailjurnal_grid->RowIndex++;
			$CurrentForm->Index = $detailjurnal_grid->RowIndex;
			if ($CurrentForm->hasValue($detailjurnal_grid->FormActionName) && ($detailjurnal->isConfirm() || $detailjurnal_grid->EventCancelled))
				$detailjurnal_grid->RowAction = strval($CurrentForm->getValue($detailjurnal_grid->FormActionName));
			elseif ($detailjurnal_grid->isGridAdd())
				$detailjurnal_grid->RowAction = "insert";
			else
				$detailjurnal_grid->RowAction = "";
		}

		// Set up key count
		$detailjurnal_grid->KeyCount = $detailjurnal_grid->RowIndex;

		// Init row class and style
		$detailjurnal->resetAttributes();
		$detailjurnal->CssClass = "";
		if ($detailjurnal_grid->isGridAdd()) {
			if ($detailjurnal->CurrentMode == "copy") {
				$detailjurnal_grid->loadRowValues($detailjurnal_grid->Recordset); // Load row values
				$detailjurnal_grid->setRecordKey($detailjurnal_grid->RowOldKey, $detailjurnal_grid->Recordset); // Set old record key
			} else {
				$detailjurnal_grid->loadRowValues(); // Load default values
				$detailjurnal_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailjurnal_grid->loadRowValues($detailjurnal_grid->Recordset); // Load row values
		}
		$detailjurnal->RowType = ROWTYPE_VIEW; // Render view
		if ($detailjurnal_grid->isGridAdd()) // Grid add
			$detailjurnal->RowType = ROWTYPE_ADD; // Render add
		if ($detailjurnal_grid->isGridAdd() && $detailjurnal->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailjurnal_grid->restoreCurrentRowFormValues($detailjurnal_grid->RowIndex); // Restore form values
		if ($detailjurnal_grid->isGridEdit()) { // Grid edit
			if ($detailjurnal->EventCancelled)
				$detailjurnal_grid->restoreCurrentRowFormValues($detailjurnal_grid->RowIndex); // Restore form values
			if ($detailjurnal_grid->RowAction == "insert")
				$detailjurnal->RowType = ROWTYPE_ADD; // Render add
			else
				$detailjurnal->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailjurnal_grid->isGridEdit() && ($detailjurnal->RowType == ROWTYPE_EDIT || $detailjurnal->RowType == ROWTYPE_ADD) && $detailjurnal->EventCancelled) // Update failed
			$detailjurnal_grid->restoreCurrentRowFormValues($detailjurnal_grid->RowIndex); // Restore form values
		if ($detailjurnal->RowType == ROWTYPE_EDIT) // Edit row
			$detailjurnal_grid->EditRowCount++;
		if ($detailjurnal->isConfirm()) // Confirm row
			$detailjurnal_grid->restoreCurrentRowFormValues($detailjurnal_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailjurnal->RowAttrs->merge(["data-rowindex" => $detailjurnal_grid->RowCount, "id" => "r" . $detailjurnal_grid->RowCount . "_detailjurnal", "data-rowtype" => $detailjurnal->RowType]);

		// Render row
		$detailjurnal_grid->renderRow();

		// Render list options
		$detailjurnal_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailjurnal_grid->RowAction != "delete" && $detailjurnal_grid->RowAction != "insertdelete" && !($detailjurnal_grid->RowAction == "insert" && $detailjurnal->isConfirm() && $detailjurnal_grid->emptyRow())) {
?>
	<tr <?php echo $detailjurnal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailjurnal_grid->ListOptions->render("body", "left", $detailjurnal_grid->RowCount);
?>
	<?php if ($detailjurnal_grid->id_detailjurnal->Visible) { // id_detailjurnal ?>
		<td data-name="id_detailjurnal" <?php echo $detailjurnal_grid->id_detailjurnal->cellAttributes() ?>>
<?php if ($detailjurnal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_detailjurnal" class="form-group"></span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->OldValue) ?>">
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_detailjurnal" class="form-group">
<span<?php echo $detailjurnal_grid->id_detailjurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_detailjurnal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->CurrentValue) ?>">
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_detailjurnal">
<span<?php echo $detailjurnal_grid->id_detailjurnal->viewAttributes() ?>><?php echo $detailjurnal_grid->id_detailjurnal->getViewValue() ?></span>
</span>
<?php if (!$detailjurnal->isConfirm()) { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->id_jurnal->Visible) { // id_jurnal ?>
		<td data-name="id_jurnal" <?php echo $detailjurnal_grid->id_jurnal->cellAttributes() ?>>
<?php if ($detailjurnal->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailjurnal_grid->id_jurnal->getSessionValue() != "") { ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_jurnal" class="form-group">
<span<?php echo $detailjurnal_grid->id_jurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_jurnal->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_jurnal" class="form-group">
<input type="text" data-table="detailjurnal" data-field="x_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->id_jurnal->EditValue ?>"<?php echo $detailjurnal_grid->id_jurnal->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->OldValue) ?>">
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailjurnal_grid->id_jurnal->getSessionValue() != "") { ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_jurnal" class="form-group">
<span<?php echo $detailjurnal_grid->id_jurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_jurnal->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_jurnal" class="form-group">
<input type="text" data-table="detailjurnal" data-field="x_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->id_jurnal->EditValue ?>"<?php echo $detailjurnal_grid->id_jurnal->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_grid->id_jurnal->viewAttributes() ?>><?php echo $detailjurnal_grid->id_jurnal->getViewValue() ?></span>
</span>
<?php if (!$detailjurnal->isConfirm()) { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->id_akun->Visible) { // id_akun ?>
		<td data-name="id_akun" <?php echo $detailjurnal_grid->id_akun->cellAttributes() ?>>
<?php if ($detailjurnal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_akun" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailjurnal" data-field="x_id_akun" data-value-separator="<?php echo $detailjurnal_grid->id_akun->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun"<?php echo $detailjurnal_grid->id_akun->editAttributes() ?>>
			<?php echo $detailjurnal_grid->id_akun->selectOptionListHtml("x{$detailjurnal_grid->RowIndex}_id_akun") ?>
		</select>
</div>
<?php echo $detailjurnal_grid->id_akun->Lookup->getParamTag($detailjurnal_grid, "p_x" . $detailjurnal_grid->RowIndex . "_id_akun") ?>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->OldValue) ?>">
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_akun" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailjurnal" data-field="x_id_akun" data-value-separator="<?php echo $detailjurnal_grid->id_akun->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun"<?php echo $detailjurnal_grid->id_akun->editAttributes() ?>>
			<?php echo $detailjurnal_grid->id_akun->selectOptionListHtml("x{$detailjurnal_grid->RowIndex}_id_akun") ?>
		</select>
</div>
<?php echo $detailjurnal_grid->id_akun->Lookup->getParamTag($detailjurnal_grid, "p_x" . $detailjurnal_grid->RowIndex . "_id_akun") ?>
</span>
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_id_akun">
<span<?php echo $detailjurnal_grid->id_akun->viewAttributes() ?>><?php echo $detailjurnal_grid->id_akun->getViewValue() ?></span>
</span>
<?php if (!$detailjurnal->isConfirm()) { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->debet->Visible) { // debet ?>
		<td data-name="debet" <?php echo $detailjurnal_grid->debet->cellAttributes() ?>>
<?php if ($detailjurnal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_debet" class="form-group">
<input type="text" data-table="detailjurnal" data-field="x_debet" name="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_grid->debet->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->debet->EditValue ?>"<?php echo $detailjurnal_grid->debet->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="o<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="o<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->OldValue) ?>">
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_debet" class="form-group">
<input type="text" data-table="detailjurnal" data-field="x_debet" name="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_grid->debet->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->debet->EditValue ?>"<?php echo $detailjurnal_grid->debet->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_debet">
<span<?php echo $detailjurnal_grid->debet->viewAttributes() ?>><?php echo $detailjurnal_grid->debet->getViewValue() ?></span>
</span>
<?php if (!$detailjurnal->isConfirm()) { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="o<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="o<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->kredit->Visible) { // kredit ?>
		<td data-name="kredit" <?php echo $detailjurnal_grid->kredit->cellAttributes() ?>>
<?php if ($detailjurnal->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_kredit" class="form-group">
<input type="text" data-table="detailjurnal" data-field="x_kredit" name="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_grid->kredit->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->kredit->EditValue ?>"<?php echo $detailjurnal_grid->kredit->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->OldValue) ?>">
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_kredit" class="form-group">
<input type="text" data-table="detailjurnal" data-field="x_kredit" name="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_grid->kredit->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->kredit->EditValue ?>"<?php echo $detailjurnal_grid->kredit->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailjurnal->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailjurnal_grid->RowCount ?>_detailjurnal_kredit">
<span<?php echo $detailjurnal_grid->kredit->viewAttributes() ?>><?php echo $detailjurnal_grid->kredit->getViewValue() ?></span>
</span>
<?php if (!$detailjurnal->isConfirm()) { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="fdetailjurnalgrid$x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->FormValue) ?>">
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="fdetailjurnalgrid$o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailjurnal_grid->ListOptions->render("body", "right", $detailjurnal_grid->RowCount);
?>
	</tr>
<?php if ($detailjurnal->RowType == ROWTYPE_ADD || $detailjurnal->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailjurnalgrid", "load"], function() {
	fdetailjurnalgrid.updateLists(<?php echo $detailjurnal_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailjurnal_grid->isGridAdd() || $detailjurnal->CurrentMode == "copy")
		if (!$detailjurnal_grid->Recordset->EOF)
			$detailjurnal_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailjurnal->CurrentMode == "add" || $detailjurnal->CurrentMode == "copy" || $detailjurnal->CurrentMode == "edit") {
		$detailjurnal_grid->RowIndex = '$rowindex$';
		$detailjurnal_grid->loadRowValues();

		// Set row properties
		$detailjurnal->resetAttributes();
		$detailjurnal->RowAttrs->merge(["data-rowindex" => $detailjurnal_grid->RowIndex, "id" => "r0_detailjurnal", "data-rowtype" => ROWTYPE_ADD]);
		$detailjurnal->RowAttrs->appendClass("ew-template");
		$detailjurnal->RowType = ROWTYPE_ADD;

		// Render row
		$detailjurnal_grid->renderRow();

		// Render list options
		$detailjurnal_grid->renderListOptions();
		$detailjurnal_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailjurnal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailjurnal_grid->ListOptions->render("body", "left", $detailjurnal_grid->RowIndex);
?>
	<?php if ($detailjurnal_grid->id_detailjurnal->Visible) { // id_detailjurnal ?>
		<td data-name="id_detailjurnal">
<?php if (!$detailjurnal->isConfirm()) { ?>
<span id="el$rowindex$_detailjurnal_id_detailjurnal" class="form-group detailjurnal_id_detailjurnal"></span>
<?php } else { ?>
<span id="el$rowindex$_detailjurnal_id_detailjurnal" class="form-group detailjurnal_id_detailjurnal">
<span<?php echo $detailjurnal_grid->id_detailjurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_detailjurnal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_detailjurnal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->id_jurnal->Visible) { // id_jurnal ?>
		<td data-name="id_jurnal">
<?php if (!$detailjurnal->isConfirm()) { ?>
<?php if ($detailjurnal_grid->id_jurnal->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailjurnal_id_jurnal" class="form-group detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_grid->id_jurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_jurnal->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailjurnal_id_jurnal" class="form-group detailjurnal_id_jurnal">
<input type="text" data-table="detailjurnal" data-field="x_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->id_jurnal->EditValue ?>"<?php echo $detailjurnal_grid->id_jurnal->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailjurnal_id_jurnal" class="form-group detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_grid->id_jurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_jurnal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_jurnal" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_grid->id_jurnal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->id_akun->Visible) { // id_akun ?>
		<td data-name="id_akun">
<?php if (!$detailjurnal->isConfirm()) { ?>
<span id="el$rowindex$_detailjurnal_id_akun" class="form-group detailjurnal_id_akun">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailjurnal" data-field="x_id_akun" data-value-separator="<?php echo $detailjurnal_grid->id_akun->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun"<?php echo $detailjurnal_grid->id_akun->editAttributes() ?>>
			<?php echo $detailjurnal_grid->id_akun->selectOptionListHtml("x{$detailjurnal_grid->RowIndex}_id_akun") ?>
		</select>
</div>
<?php echo $detailjurnal_grid->id_akun->Lookup->getParamTag($detailjurnal_grid, "p_x" . $detailjurnal_grid->RowIndex . "_id_akun") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailjurnal_id_akun" class="form-group detailjurnal_id_akun">
<span<?php echo $detailjurnal_grid->id_akun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->id_akun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="x<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailjurnal" data-field="x_id_akun" name="o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" id="o<?php echo $detailjurnal_grid->RowIndex ?>_id_akun" value="<?php echo HtmlEncode($detailjurnal_grid->id_akun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->debet->Visible) { // debet ?>
		<td data-name="debet">
<?php if (!$detailjurnal->isConfirm()) { ?>
<span id="el$rowindex$_detailjurnal_debet" class="form-group detailjurnal_debet">
<input type="text" data-table="detailjurnal" data-field="x_debet" name="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_grid->debet->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->debet->EditValue ?>"<?php echo $detailjurnal_grid->debet->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailjurnal_debet" class="form-group detailjurnal_debet">
<span<?php echo $detailjurnal_grid->debet->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->debet->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="x<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailjurnal" data-field="x_debet" name="o<?php echo $detailjurnal_grid->RowIndex ?>_debet" id="o<?php echo $detailjurnal_grid->RowIndex ?>_debet" value="<?php echo HtmlEncode($detailjurnal_grid->debet->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailjurnal_grid->kredit->Visible) { // kredit ?>
		<td data-name="kredit">
<?php if (!$detailjurnal->isConfirm()) { ?>
<span id="el$rowindex$_detailjurnal_kredit" class="form-group detailjurnal_kredit">
<input type="text" data-table="detailjurnal" data-field="x_kredit" name="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_grid->kredit->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_grid->kredit->EditValue ?>"<?php echo $detailjurnal_grid->kredit->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailjurnal_kredit" class="form-group detailjurnal_kredit">
<span<?php echo $detailjurnal_grid->kredit->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_grid->kredit->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="x<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailjurnal" data-field="x_kredit" name="o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" id="o<?php echo $detailjurnal_grid->RowIndex ?>_kredit" value="<?php echo HtmlEncode($detailjurnal_grid->kredit->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailjurnal_grid->ListOptions->render("body", "right", $detailjurnal_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailjurnalgrid", "load"], function() {
	fdetailjurnalgrid.updateLists(<?php echo $detailjurnal_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailjurnal->CurrentMode == "add" || $detailjurnal->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailjurnal_grid->FormKeyCountName ?>" id="<?php echo $detailjurnal_grid->FormKeyCountName ?>" value="<?php echo $detailjurnal_grid->KeyCount ?>">
<?php echo $detailjurnal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailjurnal->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailjurnal_grid->FormKeyCountName ?>" id="<?php echo $detailjurnal_grid->FormKeyCountName ?>" value="<?php echo $detailjurnal_grid->KeyCount ?>">
<?php echo $detailjurnal_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailjurnal->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailjurnalgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailjurnal_grid->Recordset)
	$detailjurnal_grid->Recordset->Close();
?>
<?php if ($detailjurnal_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailjurnal_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailjurnal_grid->TotalRecords == 0 && !$detailjurnal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailjurnal_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailjurnal_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailjurnal_grid->terminate();
?>