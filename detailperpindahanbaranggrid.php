<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailperpindahanbarang_grid))
	$detailperpindahanbarang_grid = new detailperpindahanbarang_grid();

// Run the page
$detailperpindahanbarang_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_grid->Page_Render();
?>
<?php if (!$detailperpindahanbarang_grid->isExport()) { ?>
<script>
var fdetailperpindahanbaranggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailperpindahanbaranggrid = new ew.Form("fdetailperpindahanbaranggrid", "grid");
	fdetailperpindahanbaranggrid.formKeyCountName = '<?php echo $detailperpindahanbarang_grid->FormKeyCountName ?>';

	// Validate form
	fdetailperpindahanbaranggrid.validate = function() {
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
			<?php if ($detailperpindahanbarang_grid->id_detailperpindahanbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_detailperpindahanbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_grid->id_detailperpindahanbarang->caption(), $detailperpindahanbarang_grid->id_detailperpindahanbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_perpindahanbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_grid->id_perpindahanbarang->caption(), $detailperpindahanbarang_grid->id_perpindahanbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_perpindahanbarang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_grid->id_perpindahanbarang->errorMessage()) ?>");
			<?php if ($detailperpindahanbarang_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_grid->id_barang->caption(), $detailperpindahanbarang_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailperpindahanbarang_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_grid->jumlah->caption(), $detailperpindahanbarang_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailperpindahanbarang_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_grid->id_satuan->caption(), $detailperpindahanbarang_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailperpindahanbaranggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_perpindahanbarang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailperpindahanbaranggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailperpindahanbaranggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailperpindahanbaranggrid.lists["x_id_barang"] = <?php echo $detailperpindahanbarang_grid->id_barang->Lookup->toClientList($detailperpindahanbarang_grid) ?>;
	fdetailperpindahanbaranggrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailperpindahanbarang_grid->id_barang->lookupOptions()) ?>;
	fdetailperpindahanbaranggrid.lists["x_id_satuan"] = <?php echo $detailperpindahanbarang_grid->id_satuan->Lookup->toClientList($detailperpindahanbarang_grid) ?>;
	fdetailperpindahanbaranggrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailperpindahanbarang_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailperpindahanbaranggrid");
});
</script>
<?php } ?>
<?php
$detailperpindahanbarang_grid->renderOtherOptions();
?>
<?php if ($detailperpindahanbarang_grid->TotalRecords > 0 || $detailperpindahanbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailperpindahanbarang_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailperpindahanbarang">
<?php if ($detailperpindahanbarang_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailperpindahanbarang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailperpindahanbaranggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailperpindahanbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailperpindahanbaranggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailperpindahanbarang->RowType = ROWTYPE_HEADER;

// Render list options
$detailperpindahanbarang_grid->renderListOptions();

// Render list options (header, left)
$detailperpindahanbarang_grid->ListOptions->render("header", "left");
?>
<?php if ($detailperpindahanbarang_grid->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
	<?php if ($detailperpindahanbarang_grid->SortUrl($detailperpindahanbarang_grid->id_detailperpindahanbarang) == "") { ?>
		<th data-name="id_detailperpindahanbarang" class="<?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_detailperpindahanbarang" class="detailperpindahanbarang_id_detailperpindahanbarang"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailperpindahanbarang" class="<?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->headerCellClass() ?>"><div><div id="elh_detailperpindahanbarang_id_detailperpindahanbarang" class="detailperpindahanbarang_id_detailperpindahanbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_grid->id_detailperpindahanbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_grid->id_detailperpindahanbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<?php if ($detailperpindahanbarang_grid->SortUrl($detailperpindahanbarang_grid->id_perpindahanbarang) == "") { ?>
		<th data-name="id_perpindahanbarang" class="<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_perpindahanbarang" class="detailperpindahanbarang_id_perpindahanbarang"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_perpindahanbarang" class="<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->headerCellClass() ?>"><div><div id="elh_detailperpindahanbarang_id_perpindahanbarang" class="detailperpindahanbarang_id_perpindahanbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_grid->id_perpindahanbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailperpindahanbarang_grid->SortUrl($detailperpindahanbarang_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailperpindahanbarang_grid->id_barang->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_barang" class="detailperpindahanbarang_id_barang"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailperpindahanbarang_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailperpindahanbarang_id_barang" class="detailperpindahanbarang_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailperpindahanbarang_grid->SortUrl($detailperpindahanbarang_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailperpindahanbarang_grid->jumlah->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_jumlah" class="detailperpindahanbarang_jumlah"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailperpindahanbarang_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailperpindahanbarang_jumlah" class="detailperpindahanbarang_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailperpindahanbarang_grid->SortUrl($detailperpindahanbarang_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailperpindahanbarang_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailperpindahanbarang_id_satuan" class="detailperpindahanbarang_id_satuan"><div class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailperpindahanbarang_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailperpindahanbarang_id_satuan" class="detailperpindahanbarang_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailperpindahanbarang_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailperpindahanbarang_grid->StartRecord = 1;
$detailperpindahanbarang_grid->StopRecord = $detailperpindahanbarang_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailperpindahanbarang->isConfirm() || $detailperpindahanbarang_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailperpindahanbarang_grid->FormKeyCountName) && ($detailperpindahanbarang_grid->isGridAdd() || $detailperpindahanbarang_grid->isGridEdit() || $detailperpindahanbarang->isConfirm())) {
		$detailperpindahanbarang_grid->KeyCount = $CurrentForm->getValue($detailperpindahanbarang_grid->FormKeyCountName);
		$detailperpindahanbarang_grid->StopRecord = $detailperpindahanbarang_grid->StartRecord + $detailperpindahanbarang_grid->KeyCount - 1;
	}
}
$detailperpindahanbarang_grid->RecordCount = $detailperpindahanbarang_grid->StartRecord - 1;
if ($detailperpindahanbarang_grid->Recordset && !$detailperpindahanbarang_grid->Recordset->EOF) {
	$detailperpindahanbarang_grid->Recordset->moveFirst();
	$selectLimit = $detailperpindahanbarang_grid->UseSelectLimit;
	if (!$selectLimit && $detailperpindahanbarang_grid->StartRecord > 1)
		$detailperpindahanbarang_grid->Recordset->move($detailperpindahanbarang_grid->StartRecord - 1);
} elseif (!$detailperpindahanbarang->AllowAddDeleteRow && $detailperpindahanbarang_grid->StopRecord == 0) {
	$detailperpindahanbarang_grid->StopRecord = $detailperpindahanbarang->GridAddRowCount;
}

// Initialize aggregate
$detailperpindahanbarang->RowType = ROWTYPE_AGGREGATEINIT;
$detailperpindahanbarang->resetAttributes();
$detailperpindahanbarang_grid->renderRow();
if ($detailperpindahanbarang_grid->isGridAdd())
	$detailperpindahanbarang_grid->RowIndex = 0;
if ($detailperpindahanbarang_grid->isGridEdit())
	$detailperpindahanbarang_grid->RowIndex = 0;
while ($detailperpindahanbarang_grid->RecordCount < $detailperpindahanbarang_grid->StopRecord) {
	$detailperpindahanbarang_grid->RecordCount++;
	if ($detailperpindahanbarang_grid->RecordCount >= $detailperpindahanbarang_grid->StartRecord) {
		$detailperpindahanbarang_grid->RowCount++;
		if ($detailperpindahanbarang_grid->isGridAdd() || $detailperpindahanbarang_grid->isGridEdit() || $detailperpindahanbarang->isConfirm()) {
			$detailperpindahanbarang_grid->RowIndex++;
			$CurrentForm->Index = $detailperpindahanbarang_grid->RowIndex;
			if ($CurrentForm->hasValue($detailperpindahanbarang_grid->FormActionName) && ($detailperpindahanbarang->isConfirm() || $detailperpindahanbarang_grid->EventCancelled))
				$detailperpindahanbarang_grid->RowAction = strval($CurrentForm->getValue($detailperpindahanbarang_grid->FormActionName));
			elseif ($detailperpindahanbarang_grid->isGridAdd())
				$detailperpindahanbarang_grid->RowAction = "insert";
			else
				$detailperpindahanbarang_grid->RowAction = "";
		}

		// Set up key count
		$detailperpindahanbarang_grid->KeyCount = $detailperpindahanbarang_grid->RowIndex;

		// Init row class and style
		$detailperpindahanbarang->resetAttributes();
		$detailperpindahanbarang->CssClass = "";
		if ($detailperpindahanbarang_grid->isGridAdd()) {
			if ($detailperpindahanbarang->CurrentMode == "copy") {
				$detailperpindahanbarang_grid->loadRowValues($detailperpindahanbarang_grid->Recordset); // Load row values
				$detailperpindahanbarang_grid->setRecordKey($detailperpindahanbarang_grid->RowOldKey, $detailperpindahanbarang_grid->Recordset); // Set old record key
			} else {
				$detailperpindahanbarang_grid->loadRowValues(); // Load default values
				$detailperpindahanbarang_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailperpindahanbarang_grid->loadRowValues($detailperpindahanbarang_grid->Recordset); // Load row values
		}
		$detailperpindahanbarang->RowType = ROWTYPE_VIEW; // Render view
		if ($detailperpindahanbarang_grid->isGridAdd()) // Grid add
			$detailperpindahanbarang->RowType = ROWTYPE_ADD; // Render add
		if ($detailperpindahanbarang_grid->isGridAdd() && $detailperpindahanbarang->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailperpindahanbarang_grid->restoreCurrentRowFormValues($detailperpindahanbarang_grid->RowIndex); // Restore form values
		if ($detailperpindahanbarang_grid->isGridEdit()) { // Grid edit
			if ($detailperpindahanbarang->EventCancelled)
				$detailperpindahanbarang_grid->restoreCurrentRowFormValues($detailperpindahanbarang_grid->RowIndex); // Restore form values
			if ($detailperpindahanbarang_grid->RowAction == "insert")
				$detailperpindahanbarang->RowType = ROWTYPE_ADD; // Render add
			else
				$detailperpindahanbarang->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailperpindahanbarang_grid->isGridEdit() && ($detailperpindahanbarang->RowType == ROWTYPE_EDIT || $detailperpindahanbarang->RowType == ROWTYPE_ADD) && $detailperpindahanbarang->EventCancelled) // Update failed
			$detailperpindahanbarang_grid->restoreCurrentRowFormValues($detailperpindahanbarang_grid->RowIndex); // Restore form values
		if ($detailperpindahanbarang->RowType == ROWTYPE_EDIT) // Edit row
			$detailperpindahanbarang_grid->EditRowCount++;
		if ($detailperpindahanbarang->isConfirm()) // Confirm row
			$detailperpindahanbarang_grid->restoreCurrentRowFormValues($detailperpindahanbarang_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailperpindahanbarang->RowAttrs->merge(["data-rowindex" => $detailperpindahanbarang_grid->RowCount, "id" => "r" . $detailperpindahanbarang_grid->RowCount . "_detailperpindahanbarang", "data-rowtype" => $detailperpindahanbarang->RowType]);

		// Render row
		$detailperpindahanbarang_grid->renderRow();

		// Render list options
		$detailperpindahanbarang_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailperpindahanbarang_grid->RowAction != "delete" && $detailperpindahanbarang_grid->RowAction != "insertdelete" && !($detailperpindahanbarang_grid->RowAction == "insert" && $detailperpindahanbarang->isConfirm() && $detailperpindahanbarang_grid->emptyRow())) {
?>
	<tr <?php echo $detailperpindahanbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailperpindahanbarang_grid->ListOptions->render("body", "left", $detailperpindahanbarang_grid->RowCount);
?>
	<?php if ($detailperpindahanbarang_grid->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
		<td data-name="id_detailperpindahanbarang" <?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->cellAttributes() ?>>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_detailperpindahanbarang" class="form-group"></span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->OldValue) ?>">
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_detailperpindahanbarang" class="form-group">
<span<?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_detailperpindahanbarang->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->CurrentValue) ?>">
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_detailperpindahanbarang">
<span<?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->getViewValue() ?></span>
</span>
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<td data-name="id_perpindahanbarang" <?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->cellAttributes() ?>>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->getSessionValue() != "") { ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang" class="form-group">
<span<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_perpindahanbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang" class="form-group">
<input type="text" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->EditValue ?>"<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->OldValue) ?>">
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->getSessionValue() != "") { ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang" class="form-group">
<span<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_perpindahanbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang" class="form-group">
<input type="text" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->EditValue ?>"<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->getViewValue() ?></span>
</span>
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailperpindahanbarang_grid->id_barang->cellAttributes() ?>>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_barang" class="form-group">
<?php $detailperpindahanbarang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailperpindahanbarang_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_grid->id_barang->ReadOnly || $detailperpindahanbarang_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_grid->id_barang->Lookup->getParamTag($detailperpindahanbarang_grid, "p_x" . $detailperpindahanbarang_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo $detailperpindahanbarang_grid->id_barang->CurrentValue ?>"<?php echo $detailperpindahanbarang_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_barang" class="form-group">
<?php $detailperpindahanbarang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailperpindahanbarang_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_grid->id_barang->ReadOnly || $detailperpindahanbarang_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_grid->id_barang->Lookup->getParamTag($detailperpindahanbarang_grid, "p_x" . $detailperpindahanbarang_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo $detailperpindahanbarang_grid->id_barang->CurrentValue ?>"<?php echo $detailperpindahanbarang_grid->id_barang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_barang">
<span<?php echo $detailperpindahanbarang_grid->id_barang->viewAttributes() ?>><?php echo $detailperpindahanbarang_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailperpindahanbarang_grid->jumlah->cellAttributes() ?>>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_jumlah" class="form-group">
<input type="text" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_grid->jumlah->EditValue ?>"<?php echo $detailperpindahanbarang_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_jumlah" class="form-group">
<input type="text" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_grid->jumlah->EditValue ?>"<?php echo $detailperpindahanbarang_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_jumlah">
<span<?php echo $detailperpindahanbarang_grid->jumlah->viewAttributes() ?>><?php echo $detailperpindahanbarang_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailperpindahanbarang_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailperpindahanbarang_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_grid->id_satuan->ReadOnly || $detailperpindahanbarang_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_grid->id_satuan->Lookup->getParamTag($detailperpindahanbarang_grid, "p_x" . $detailperpindahanbarang_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo $detailperpindahanbarang_grid->id_satuan->CurrentValue ?>"<?php echo $detailperpindahanbarang_grid->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_satuan" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailperpindahanbarang_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_grid->id_satuan->ReadOnly || $detailperpindahanbarang_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_grid->id_satuan->Lookup->getParamTag($detailperpindahanbarang_grid, "p_x" . $detailperpindahanbarang_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo $detailperpindahanbarang_grid->id_satuan->CurrentValue ?>"<?php echo $detailperpindahanbarang_grid->id_satuan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailperpindahanbarang_grid->RowCount ?>_detailperpindahanbarang_id_satuan">
<span<?php echo $detailperpindahanbarang_grid->id_satuan->viewAttributes() ?>><?php echo $detailperpindahanbarang_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="fdetailperpindahanbaranggrid$x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="fdetailperpindahanbaranggrid$o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailperpindahanbarang_grid->ListOptions->render("body", "right", $detailperpindahanbarang_grid->RowCount);
?>
	</tr>
<?php if ($detailperpindahanbarang->RowType == ROWTYPE_ADD || $detailperpindahanbarang->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailperpindahanbaranggrid", "load"], function() {
	fdetailperpindahanbaranggrid.updateLists(<?php echo $detailperpindahanbarang_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailperpindahanbarang_grid->isGridAdd() || $detailperpindahanbarang->CurrentMode == "copy")
		if (!$detailperpindahanbarang_grid->Recordset->EOF)
			$detailperpindahanbarang_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailperpindahanbarang->CurrentMode == "add" || $detailperpindahanbarang->CurrentMode == "copy" || $detailperpindahanbarang->CurrentMode == "edit") {
		$detailperpindahanbarang_grid->RowIndex = '$rowindex$';
		$detailperpindahanbarang_grid->loadRowValues();

		// Set row properties
		$detailperpindahanbarang->resetAttributes();
		$detailperpindahanbarang->RowAttrs->merge(["data-rowindex" => $detailperpindahanbarang_grid->RowIndex, "id" => "r0_detailperpindahanbarang", "data-rowtype" => ROWTYPE_ADD]);
		$detailperpindahanbarang->RowAttrs->appendClass("ew-template");
		$detailperpindahanbarang->RowType = ROWTYPE_ADD;

		// Render row
		$detailperpindahanbarang_grid->renderRow();

		// Render list options
		$detailperpindahanbarang_grid->renderListOptions();
		$detailperpindahanbarang_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailperpindahanbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailperpindahanbarang_grid->ListOptions->render("body", "left", $detailperpindahanbarang_grid->RowIndex);
?>
	<?php if ($detailperpindahanbarang_grid->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
		<td data-name="id_detailperpindahanbarang">
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_detailperpindahanbarang" class="form-group detailperpindahanbarang_id_detailperpindahanbarang"></span>
<?php } else { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_detailperpindahanbarang" class="form-group detailperpindahanbarang_id_detailperpindahanbarang">
<span<?php echo $detailperpindahanbarang_grid->id_detailperpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_detailperpindahanbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_detailperpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_detailperpindahanbarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<td data-name="id_perpindahanbarang">
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<?php if ($detailperpindahanbarang_grid->id_perpindahanbarang->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_perpindahanbarang" class="form-group detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_perpindahanbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_perpindahanbarang" class="form-group detailperpindahanbarang_id_perpindahanbarang">
<input type="text" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->EditValue ?>"<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_perpindahanbarang" class="form-group detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_grid->id_perpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_perpindahanbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_perpindahanbarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_barang" class="form-group detailperpindahanbarang_id_barang">
<?php $detailperpindahanbarang_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang"><?php echo EmptyValue(strval($detailperpindahanbarang_grid->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_grid->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_grid->id_barang->ReadOnly || $detailperpindahanbarang_grid->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_grid->id_barang->Lookup->getParamTag($detailperpindahanbarang_grid, "p_x" . $detailperpindahanbarang_grid->RowIndex . "_id_barang") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo $detailperpindahanbarang_grid->id_barang->CurrentValue ?>"<?php echo $detailperpindahanbarang_grid->id_barang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_barang" class="form-group detailperpindahanbarang_id_barang">
<span<?php echo $detailperpindahanbarang_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailperpindahanbarang_jumlah" class="form-group detailperpindahanbarang_jumlah">
<input type="text" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_grid->jumlah->EditValue ?>"<?php echo $detailperpindahanbarang_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailperpindahanbarang_jumlah" class="form-group detailperpindahanbarang_jumlah">
<span<?php echo $detailperpindahanbarang_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_jumlah" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailperpindahanbarang_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailperpindahanbarang->isConfirm()) { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_satuan" class="form-group detailperpindahanbarang_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailperpindahanbarang_grid->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_grid->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_grid->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_grid->id_satuan->ReadOnly || $detailperpindahanbarang_grid->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_grid->id_satuan->Lookup->getParamTag($detailperpindahanbarang_grid, "p_x" . $detailperpindahanbarang_grid->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_grid->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo $detailperpindahanbarang_grid->id_satuan->CurrentValue ?>"<?php echo $detailperpindahanbarang_grid->id_satuan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailperpindahanbarang_id_satuan" class="form-group detailperpindahanbarang_id_satuan">
<span<?php echo $detailperpindahanbarang_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" name="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailperpindahanbarang_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailperpindahanbarang_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailperpindahanbarang_grid->ListOptions->render("body", "right", $detailperpindahanbarang_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailperpindahanbaranggrid", "load"], function() {
	fdetailperpindahanbaranggrid.updateLists(<?php echo $detailperpindahanbarang_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailperpindahanbarang->CurrentMode == "add" || $detailperpindahanbarang->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailperpindahanbarang_grid->FormKeyCountName ?>" id="<?php echo $detailperpindahanbarang_grid->FormKeyCountName ?>" value="<?php echo $detailperpindahanbarang_grid->KeyCount ?>">
<?php echo $detailperpindahanbarang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailperpindahanbarang->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailperpindahanbarang_grid->FormKeyCountName ?>" id="<?php echo $detailperpindahanbarang_grid->FormKeyCountName ?>" value="<?php echo $detailperpindahanbarang_grid->KeyCount ?>">
<?php echo $detailperpindahanbarang_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailperpindahanbarang->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailperpindahanbaranggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailperpindahanbarang_grid->Recordset)
	$detailperpindahanbarang_grid->Recordset->Close();
?>
<?php if ($detailperpindahanbarang_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailperpindahanbarang_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailperpindahanbarang_grid->TotalRecords == 0 && !$detailperpindahanbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailperpindahanbarang_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailperpindahanbarang_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailperpindahanbarang_grid->terminate();
?>