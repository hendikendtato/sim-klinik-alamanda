<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailpenyesuaianstok_grid))
	$detailpenyesuaianstok_grid = new detailpenyesuaianstok_grid();

// Run the page
$detailpenyesuaianstok_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianstok_grid->Page_Render();
?>
<?php if (!$detailpenyesuaianstok_grid->isExport()) { ?>
<script>
var fdetailpenyesuaianstokgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailpenyesuaianstokgrid = new ew.Form("fdetailpenyesuaianstokgrid", "grid");
	fdetailpenyesuaianstokgrid.formKeyCountName = '<?php echo $detailpenyesuaianstok_grid->FormKeyCountName ?>';

	// Validate form
	fdetailpenyesuaianstokgrid.validate = function() {
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
			<?php if ($detailpenyesuaianstok_grid->kode_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_grid->kode_barang->caption(), $detailpenyesuaianstok_grid->kode_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_grid->kode_barang->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_grid->id_barang->caption(), $detailpenyesuaianstok_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_grid->stokdatabase->Required) { ?>
				elm = this.getElements("x" + infix + "_stokdatabase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_grid->stokdatabase->caption(), $detailpenyesuaianstok_grid->stokdatabase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stokdatabase");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_grid->stokdatabase->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_grid->jumlah->caption(), $detailpenyesuaianstok_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_grid->selisih->Required) { ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_grid->selisih->caption(), $detailpenyesuaianstok_grid->selisih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_grid->selisih->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_grid->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_grid->tipe->caption(), $detailpenyesuaianstok_grid->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailpenyesuaianstokgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "kode_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "stokdatabase", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "selisih", false)) return false;
		if (ew.valueChanged(fobj, infix, "tipe", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpenyesuaianstokgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpenyesuaianstokgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdetailpenyesuaianstokgrid");
});
</script>
<?php } ?>
<?php
$detailpenyesuaianstok_grid->renderOtherOptions();
?>
<?php if ($detailpenyesuaianstok_grid->TotalRecords > 0 || $detailpenyesuaianstok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpenyesuaianstok_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpenyesuaianstok">
<?php if ($detailpenyesuaianstok_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailpenyesuaianstok_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailpenyesuaianstokgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailpenyesuaianstok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailpenyesuaianstokgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpenyesuaianstok->RowType = ROWTYPE_HEADER;

// Render list options
$detailpenyesuaianstok_grid->renderListOptions();

// Render list options (header, left)
$detailpenyesuaianstok_grid->ListOptions->render("header", "left");
?>
<?php if ($detailpenyesuaianstok_grid->kode_barang->Visible) { // kode_barang ?>
	<?php if ($detailpenyesuaianstok_grid->SortUrl($detailpenyesuaianstok_grid->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenyesuaianstok_grid->kode_barang->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_kode_barang" class="detailpenyesuaianstok_kode_barang"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenyesuaianstok_grid->kode_barang->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianstok_kode_barang" class="detailpenyesuaianstok_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->kode_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_grid->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_grid->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpenyesuaianstok_grid->SortUrl($detailpenyesuaianstok_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailpenyesuaianstok_grid->id_barang->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_id_barang" class="detailpenyesuaianstok_id_barang"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailpenyesuaianstok_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianstok_id_barang" class="detailpenyesuaianstok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_grid->stokdatabase->Visible) { // stokdatabase ?>
	<?php if ($detailpenyesuaianstok_grid->SortUrl($detailpenyesuaianstok_grid->stokdatabase) == "") { ?>
		<th data-name="stokdatabase" class="<?php echo $detailpenyesuaianstok_grid->stokdatabase->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_stokdatabase" class="detailpenyesuaianstok_stokdatabase"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->stokdatabase->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stokdatabase" class="<?php echo $detailpenyesuaianstok_grid->stokdatabase->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianstok_stokdatabase" class="detailpenyesuaianstok_stokdatabase">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->stokdatabase->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_grid->stokdatabase->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_grid->stokdatabase->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailpenyesuaianstok_grid->SortUrl($detailpenyesuaianstok_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailpenyesuaianstok_grid->jumlah->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_jumlah" class="detailpenyesuaianstok_jumlah"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailpenyesuaianstok_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianstok_jumlah" class="detailpenyesuaianstok_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_grid->selisih->Visible) { // selisih ?>
	<?php if ($detailpenyesuaianstok_grid->SortUrl($detailpenyesuaianstok_grid->selisih) == "") { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianstok_grid->selisih->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_selisih" class="detailpenyesuaianstok_selisih"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->selisih->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianstok_grid->selisih->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianstok_selisih" class="detailpenyesuaianstok_selisih">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->selisih->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_grid->selisih->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_grid->selisih->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_grid->tipe->Visible) { // tipe ?>
	<?php if ($detailpenyesuaianstok_grid->SortUrl($detailpenyesuaianstok_grid->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianstok_grid->tipe->headerCellClass() ?>"><div id="elh_detailpenyesuaianstok_tipe" class="detailpenyesuaianstok_tipe"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianstok_grid->tipe->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianstok_tipe" class="detailpenyesuaianstok_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_grid->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_grid->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_grid->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenyesuaianstok_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailpenyesuaianstok_grid->StartRecord = 1;
$detailpenyesuaianstok_grid->StopRecord = $detailpenyesuaianstok_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailpenyesuaianstok->isConfirm() || $detailpenyesuaianstok_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailpenyesuaianstok_grid->FormKeyCountName) && ($detailpenyesuaianstok_grid->isGridAdd() || $detailpenyesuaianstok_grid->isGridEdit() || $detailpenyesuaianstok->isConfirm())) {
		$detailpenyesuaianstok_grid->KeyCount = $CurrentForm->getValue($detailpenyesuaianstok_grid->FormKeyCountName);
		$detailpenyesuaianstok_grid->StopRecord = $detailpenyesuaianstok_grid->StartRecord + $detailpenyesuaianstok_grid->KeyCount - 1;
	}
}
$detailpenyesuaianstok_grid->RecordCount = $detailpenyesuaianstok_grid->StartRecord - 1;
if ($detailpenyesuaianstok_grid->Recordset && !$detailpenyesuaianstok_grid->Recordset->EOF) {
	$detailpenyesuaianstok_grid->Recordset->moveFirst();
	$selectLimit = $detailpenyesuaianstok_grid->UseSelectLimit;
	if (!$selectLimit && $detailpenyesuaianstok_grid->StartRecord > 1)
		$detailpenyesuaianstok_grid->Recordset->move($detailpenyesuaianstok_grid->StartRecord - 1);
} elseif (!$detailpenyesuaianstok->AllowAddDeleteRow && $detailpenyesuaianstok_grid->StopRecord == 0) {
	$detailpenyesuaianstok_grid->StopRecord = $detailpenyesuaianstok->GridAddRowCount;
}

// Initialize aggregate
$detailpenyesuaianstok->RowType = ROWTYPE_AGGREGATEINIT;
$detailpenyesuaianstok->resetAttributes();
$detailpenyesuaianstok_grid->renderRow();
if ($detailpenyesuaianstok_grid->isGridAdd())
	$detailpenyesuaianstok_grid->RowIndex = 0;
if ($detailpenyesuaianstok_grid->isGridEdit())
	$detailpenyesuaianstok_grid->RowIndex = 0;
while ($detailpenyesuaianstok_grid->RecordCount < $detailpenyesuaianstok_grid->StopRecord) {
	$detailpenyesuaianstok_grid->RecordCount++;
	if ($detailpenyesuaianstok_grid->RecordCount >= $detailpenyesuaianstok_grid->StartRecord) {
		$detailpenyesuaianstok_grid->RowCount++;
		if ($detailpenyesuaianstok_grid->isGridAdd() || $detailpenyesuaianstok_grid->isGridEdit() || $detailpenyesuaianstok->isConfirm()) {
			$detailpenyesuaianstok_grid->RowIndex++;
			$CurrentForm->Index = $detailpenyesuaianstok_grid->RowIndex;
			if ($CurrentForm->hasValue($detailpenyesuaianstok_grid->FormActionName) && ($detailpenyesuaianstok->isConfirm() || $detailpenyesuaianstok_grid->EventCancelled))
				$detailpenyesuaianstok_grid->RowAction = strval($CurrentForm->getValue($detailpenyesuaianstok_grid->FormActionName));
			elseif ($detailpenyesuaianstok_grid->isGridAdd())
				$detailpenyesuaianstok_grid->RowAction = "insert";
			else
				$detailpenyesuaianstok_grid->RowAction = "";
		}

		// Set up key count
		$detailpenyesuaianstok_grid->KeyCount = $detailpenyesuaianstok_grid->RowIndex;

		// Init row class and style
		$detailpenyesuaianstok->resetAttributes();
		$detailpenyesuaianstok->CssClass = "";
		if ($detailpenyesuaianstok_grid->isGridAdd()) {
			if ($detailpenyesuaianstok->CurrentMode == "copy") {
				$detailpenyesuaianstok_grid->loadRowValues($detailpenyesuaianstok_grid->Recordset); // Load row values
				$detailpenyesuaianstok_grid->setRecordKey($detailpenyesuaianstok_grid->RowOldKey, $detailpenyesuaianstok_grid->Recordset); // Set old record key
			} else {
				$detailpenyesuaianstok_grid->loadRowValues(); // Load default values
				$detailpenyesuaianstok_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailpenyesuaianstok_grid->loadRowValues($detailpenyesuaianstok_grid->Recordset); // Load row values
		}
		$detailpenyesuaianstok->RowType = ROWTYPE_VIEW; // Render view
		if ($detailpenyesuaianstok_grid->isGridAdd()) // Grid add
			$detailpenyesuaianstok->RowType = ROWTYPE_ADD; // Render add
		if ($detailpenyesuaianstok_grid->isGridAdd() && $detailpenyesuaianstok->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailpenyesuaianstok_grid->restoreCurrentRowFormValues($detailpenyesuaianstok_grid->RowIndex); // Restore form values
		if ($detailpenyesuaianstok_grid->isGridEdit()) { // Grid edit
			if ($detailpenyesuaianstok->EventCancelled)
				$detailpenyesuaianstok_grid->restoreCurrentRowFormValues($detailpenyesuaianstok_grid->RowIndex); // Restore form values
			if ($detailpenyesuaianstok_grid->RowAction == "insert")
				$detailpenyesuaianstok->RowType = ROWTYPE_ADD; // Render add
			else
				$detailpenyesuaianstok->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailpenyesuaianstok_grid->isGridEdit() && ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT || $detailpenyesuaianstok->RowType == ROWTYPE_ADD) && $detailpenyesuaianstok->EventCancelled) // Update failed
			$detailpenyesuaianstok_grid->restoreCurrentRowFormValues($detailpenyesuaianstok_grid->RowIndex); // Restore form values
		if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) // Edit row
			$detailpenyesuaianstok_grid->EditRowCount++;
		if ($detailpenyesuaianstok->isConfirm()) // Confirm row
			$detailpenyesuaianstok_grid->restoreCurrentRowFormValues($detailpenyesuaianstok_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailpenyesuaianstok->RowAttrs->merge(["data-rowindex" => $detailpenyesuaianstok_grid->RowCount, "id" => "r" . $detailpenyesuaianstok_grid->RowCount . "_detailpenyesuaianstok", "data-rowtype" => $detailpenyesuaianstok->RowType]);

		// Render row
		$detailpenyesuaianstok_grid->renderRow();

		// Render list options
		$detailpenyesuaianstok_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailpenyesuaianstok_grid->RowAction != "delete" && $detailpenyesuaianstok_grid->RowAction != "insertdelete" && !($detailpenyesuaianstok_grid->RowAction == "insert" && $detailpenyesuaianstok->isConfirm() && $detailpenyesuaianstok_grid->emptyRow())) {
?>
	<tr <?php echo $detailpenyesuaianstok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianstok_grid->ListOptions->render("body", "left", $detailpenyesuaianstok_grid->RowCount);
?>
	<?php if ($detailpenyesuaianstok_grid->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $detailpenyesuaianstok_grid->kode_barang->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_kode_barang" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->kode_barang->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->kode_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_kode_barang" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->kode_barang->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->kode_barang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_kode_barang">
<span<?php echo $detailpenyesuaianstok_grid->kode_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_grid->kode_barang->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT || $detailpenyesuaianstok->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailpenyesuaianstok_grid->id_barang->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_id_barang" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" size="50" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->id_barang->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_id_barang" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" size="50" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->id_barang->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->id_barang->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_id_barang">
<span<?php echo $detailpenyesuaianstok_grid->id_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->stokdatabase->Visible) { // stokdatabase ?>
		<td data-name="stokdatabase" <?php echo $detailpenyesuaianstok_grid->stokdatabase->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_stokdatabase" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->stokdatabase->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->stokdatabase->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_stokdatabase" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->stokdatabase->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->stokdatabase->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_stokdatabase">
<span<?php echo $detailpenyesuaianstok_grid->stokdatabase->viewAttributes() ?>><?php echo $detailpenyesuaianstok_grid->stokdatabase->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailpenyesuaianstok_grid->jumlah->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_jumlah" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->jumlah->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_jumlah" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->jumlah->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_jumlah">
<span<?php echo $detailpenyesuaianstok_grid->jumlah->viewAttributes() ?>><?php echo $detailpenyesuaianstok_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->selisih->Visible) { // selisih ?>
		<td data-name="selisih" <?php echo $detailpenyesuaianstok_grid->selisih->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_selisih" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_selisih" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->selisih->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->selisih->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_selisih" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_selisih" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->selisih->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->selisih->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_selisih">
<span<?php echo $detailpenyesuaianstok_grid->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianstok_grid->selisih->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $detailpenyesuaianstok_grid->tipe->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_tipe" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_tipe" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->tipe->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->tipe->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_tipe" class="form-group">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_tipe" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->tipe->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->tipe->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianstok_grid->RowCount ?>_detailpenyesuaianstok_tipe">
<span<?php echo $detailpenyesuaianstok_grid->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianstok_grid->tipe->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="fdetailpenyesuaianstokgrid$x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="fdetailpenyesuaianstokgrid$o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianstok_grid->ListOptions->render("body", "right", $detailpenyesuaianstok_grid->RowCount);
?>
	</tr>
<?php if ($detailpenyesuaianstok->RowType == ROWTYPE_ADD || $detailpenyesuaianstok->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailpenyesuaianstokgrid", "load"], function() {
	fdetailpenyesuaianstokgrid.updateLists(<?php echo $detailpenyesuaianstok_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailpenyesuaianstok_grid->isGridAdd() || $detailpenyesuaianstok->CurrentMode == "copy")
		if (!$detailpenyesuaianstok_grid->Recordset->EOF)
			$detailpenyesuaianstok_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailpenyesuaianstok->CurrentMode == "add" || $detailpenyesuaianstok->CurrentMode == "copy" || $detailpenyesuaianstok->CurrentMode == "edit") {
		$detailpenyesuaianstok_grid->RowIndex = '$rowindex$';
		$detailpenyesuaianstok_grid->loadRowValues();

		// Set row properties
		$detailpenyesuaianstok->resetAttributes();
		$detailpenyesuaianstok->RowAttrs->merge(["data-rowindex" => $detailpenyesuaianstok_grid->RowIndex, "id" => "r0_detailpenyesuaianstok", "data-rowtype" => ROWTYPE_ADD]);
		$detailpenyesuaianstok->RowAttrs->appendClass("ew-template");
		$detailpenyesuaianstok->RowType = ROWTYPE_ADD;

		// Render row
		$detailpenyesuaianstok_grid->renderRow();

		// Render list options
		$detailpenyesuaianstok_grid->renderListOptions();
		$detailpenyesuaianstok_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailpenyesuaianstok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianstok_grid->ListOptions->render("body", "left", $detailpenyesuaianstok_grid->RowIndex);
?>
	<?php if ($detailpenyesuaianstok_grid->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang">
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianstok_kode_barang" class="form-group detailpenyesuaianstok_kode_barang">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->kode_barang->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->kode_barang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianstok_kode_barang" class="form-group detailpenyesuaianstok_kode_barang">
<span<?php echo $detailpenyesuaianstok_grid->kode_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_grid->kode_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->kode_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianstok_id_barang" class="form-group detailpenyesuaianstok_id_barang">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" size="50" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->id_barang->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->id_barang->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianstok_id_barang" class="form-group detailpenyesuaianstok_id_barang">
<span<?php echo $detailpenyesuaianstok_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->stokdatabase->Visible) { // stokdatabase ?>
		<td data-name="stokdatabase">
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianstok_stokdatabase" class="form-group detailpenyesuaianstok_stokdatabase">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->stokdatabase->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->stokdatabase->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianstok_stokdatabase" class="form-group detailpenyesuaianstok_stokdatabase">
<span<?php echo $detailpenyesuaianstok_grid->stokdatabase->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_grid->stokdatabase->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_stokdatabase" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->stokdatabase->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianstok_jumlah" class="form-group detailpenyesuaianstok_jumlah">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->jumlah->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianstok_jumlah" class="form-group detailpenyesuaianstok_jumlah">
<span<?php echo $detailpenyesuaianstok_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->selisih->Visible) { // selisih ?>
		<td data-name="selisih">
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianstok_selisih" class="form-group detailpenyesuaianstok_selisih">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_selisih" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->selisih->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->selisih->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianstok_selisih" class="form-group detailpenyesuaianstok_selisih">
<span<?php echo $detailpenyesuaianstok_grid->selisih->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_grid->selisih->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_selisih" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->selisih->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianstok_grid->tipe->Visible) { // tipe ?>
		<td data-name="tipe">
<?php if (!$detailpenyesuaianstok->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianstok_tipe" class="form-group detailpenyesuaianstok_tipe">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_tipe" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_grid->tipe->EditValue ?>"<?php echo $detailpenyesuaianstok_grid->tipe->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianstok_tipe" class="form-group detailpenyesuaianstok_tipe">
<span<?php echo $detailpenyesuaianstok_grid->tipe->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_grid->tipe->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_tipe" name="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" id="o<?php echo $detailpenyesuaianstok_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianstok_grid->tipe->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianstok_grid->ListOptions->render("body", "right", $detailpenyesuaianstok_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailpenyesuaianstokgrid", "load"], function() {
	fdetailpenyesuaianstokgrid.updateLists(<?php echo $detailpenyesuaianstok_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailpenyesuaianstok->CurrentMode == "add" || $detailpenyesuaianstok->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailpenyesuaianstok_grid->FormKeyCountName ?>" id="<?php echo $detailpenyesuaianstok_grid->FormKeyCountName ?>" value="<?php echo $detailpenyesuaianstok_grid->KeyCount ?>">
<?php echo $detailpenyesuaianstok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpenyesuaianstok->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailpenyesuaianstok_grid->FormKeyCountName ?>" id="<?php echo $detailpenyesuaianstok_grid->FormKeyCountName ?>" value="<?php echo $detailpenyesuaianstok_grid->KeyCount ?>">
<?php echo $detailpenyesuaianstok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpenyesuaianstok->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailpenyesuaianstokgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpenyesuaianstok_grid->Recordset)
	$detailpenyesuaianstok_grid->Recordset->Close();
?>
<?php if ($detailpenyesuaianstok_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailpenyesuaianstok_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpenyesuaianstok_grid->TotalRecords == 0 && !$detailpenyesuaianstok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianstok_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailpenyesuaianstok_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailpenyesuaianstok_grid->terminate();
?>