<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailmutasibank_grid))
	$detailmutasibank_grid = new detailmutasibank_grid();

// Run the page
$detailmutasibank_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmutasibank_grid->Page_Render();
?>
<?php if (!$detailmutasibank_grid->isExport()) { ?>
<script>
var fdetailmutasibankgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailmutasibankgrid = new ew.Form("fdetailmutasibankgrid", "grid");
	fdetailmutasibankgrid.formKeyCountName = '<?php echo $detailmutasibank_grid->FormKeyCountName ?>';

	// Validate form
	fdetailmutasibankgrid.validate = function() {
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
			<?php if ($detailmutasibank_grid->akun_id->Required) { ?>
				elm = this.getElements("x" + infix + "_akun_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_grid->akun_id->caption(), $detailmutasibank_grid->akun_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_akun_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmutasibank_grid->akun_id->errorMessage()) ?>");
			<?php if ($detailmutasibank_grid->nama_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_grid->nama_akun->caption(), $detailmutasibank_grid->nama_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmutasibank_grid->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_grid->jumlah->caption(), $detailmutasibank_grid->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmutasibank_grid->jumlah->errorMessage()) ?>");
			<?php if ($detailmutasibank_grid->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_grid->keterangan->caption(), $detailmutasibank_grid->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmutasibank_grid->tipe_mutasi->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe_mutasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_grid->tipe_mutasi->caption(), $detailmutasibank_grid->tipe_mutasi->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailmutasibankgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "akun_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama_akun", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlah", false)) return false;
		if (ew.valueChanged(fobj, infix, "keterangan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tipe_mutasi", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailmutasibankgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailmutasibankgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailmutasibankgrid.lists["x_akun_id"] = <?php echo $detailmutasibank_grid->akun_id->Lookup->toClientList($detailmutasibank_grid) ?>;
	fdetailmutasibankgrid.lists["x_akun_id"].options = <?php echo JsonEncode($detailmutasibank_grid->akun_id->lookupOptions()) ?>;
	fdetailmutasibankgrid.autoSuggests["x_akun_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailmutasibankgrid.lists["x_nama_akun"] = <?php echo $detailmutasibank_grid->nama_akun->Lookup->toClientList($detailmutasibank_grid) ?>;
	fdetailmutasibankgrid.lists["x_nama_akun"].options = <?php echo JsonEncode($detailmutasibank_grid->nama_akun->lookupOptions()) ?>;
	fdetailmutasibankgrid.autoSuggests["x_nama_akun"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailmutasibankgrid");
});
</script>
<?php } ?>
<?php
$detailmutasibank_grid->renderOtherOptions();
?>
<?php if ($detailmutasibank_grid->TotalRecords > 0 || $detailmutasibank->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailmutasibank_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailmutasibank">
<?php if ($detailmutasibank_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailmutasibank_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailmutasibankgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailmutasibank" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailmutasibankgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailmutasibank->RowType = ROWTYPE_HEADER;

// Render list options
$detailmutasibank_grid->renderListOptions();

// Render list options (header, left)
$detailmutasibank_grid->ListOptions->render("header", "left");
?>
<?php if ($detailmutasibank_grid->akun_id->Visible) { // akun_id ?>
	<?php if ($detailmutasibank_grid->SortUrl($detailmutasibank_grid->akun_id) == "") { ?>
		<th data-name="akun_id" class="<?php echo $detailmutasibank_grid->akun_id->headerCellClass() ?>"><div id="elh_detailmutasibank_akun_id" class="detailmutasibank_akun_id"><div class="ew-table-header-caption"><?php echo $detailmutasibank_grid->akun_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="akun_id" class="<?php echo $detailmutasibank_grid->akun_id->headerCellClass() ?>"><div><div id="elh_detailmutasibank_akun_id" class="detailmutasibank_akun_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_grid->akun_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_grid->akun_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_grid->akun_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_grid->nama_akun->Visible) { // nama_akun ?>
	<?php if ($detailmutasibank_grid->SortUrl($detailmutasibank_grid->nama_akun) == "") { ?>
		<th data-name="nama_akun" class="<?php echo $detailmutasibank_grid->nama_akun->headerCellClass() ?>"><div id="elh_detailmutasibank_nama_akun" class="detailmutasibank_nama_akun"><div class="ew-table-header-caption"><?php echo $detailmutasibank_grid->nama_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_akun" class="<?php echo $detailmutasibank_grid->nama_akun->headerCellClass() ?>"><div><div id="elh_detailmutasibank_nama_akun" class="detailmutasibank_nama_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_grid->nama_akun->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_grid->nama_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_grid->nama_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_grid->jumlah->Visible) { // jumlah ?>
	<?php if ($detailmutasibank_grid->SortUrl($detailmutasibank_grid->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailmutasibank_grid->jumlah->headerCellClass() ?>"><div id="elh_detailmutasibank_jumlah" class="detailmutasibank_jumlah"><div class="ew-table-header-caption"><?php echo $detailmutasibank_grid->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailmutasibank_grid->jumlah->headerCellClass() ?>"><div><div id="elh_detailmutasibank_jumlah" class="detailmutasibank_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_grid->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_grid->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_grid->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_grid->keterangan->Visible) { // keterangan ?>
	<?php if ($detailmutasibank_grid->SortUrl($detailmutasibank_grid->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $detailmutasibank_grid->keterangan->headerCellClass() ?>"><div id="elh_detailmutasibank_keterangan" class="detailmutasibank_keterangan"><div class="ew-table-header-caption"><?php echo $detailmutasibank_grid->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $detailmutasibank_grid->keterangan->headerCellClass() ?>"><div><div id="elh_detailmutasibank_keterangan" class="detailmutasibank_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_grid->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_grid->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_grid->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_grid->tipe_mutasi->Visible) { // tipe_mutasi ?>
	<?php if ($detailmutasibank_grid->SortUrl($detailmutasibank_grid->tipe_mutasi) == "") { ?>
		<th data-name="tipe_mutasi" class="<?php echo $detailmutasibank_grid->tipe_mutasi->headerCellClass() ?>"><div id="elh_detailmutasibank_tipe_mutasi" class="detailmutasibank_tipe_mutasi"><div class="ew-table-header-caption"><?php echo $detailmutasibank_grid->tipe_mutasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe_mutasi" class="<?php echo $detailmutasibank_grid->tipe_mutasi->headerCellClass() ?>"><div><div id="elh_detailmutasibank_tipe_mutasi" class="detailmutasibank_tipe_mutasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_grid->tipe_mutasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_grid->tipe_mutasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_grid->tipe_mutasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailmutasibank_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailmutasibank_grid->StartRecord = 1;
$detailmutasibank_grid->StopRecord = $detailmutasibank_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailmutasibank->isConfirm() || $detailmutasibank_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailmutasibank_grid->FormKeyCountName) && ($detailmutasibank_grid->isGridAdd() || $detailmutasibank_grid->isGridEdit() || $detailmutasibank->isConfirm())) {
		$detailmutasibank_grid->KeyCount = $CurrentForm->getValue($detailmutasibank_grid->FormKeyCountName);
		$detailmutasibank_grid->StopRecord = $detailmutasibank_grid->StartRecord + $detailmutasibank_grid->KeyCount - 1;
	}
}
$detailmutasibank_grid->RecordCount = $detailmutasibank_grid->StartRecord - 1;
if ($detailmutasibank_grid->Recordset && !$detailmutasibank_grid->Recordset->EOF) {
	$detailmutasibank_grid->Recordset->moveFirst();
	$selectLimit = $detailmutasibank_grid->UseSelectLimit;
	if (!$selectLimit && $detailmutasibank_grid->StartRecord > 1)
		$detailmutasibank_grid->Recordset->move($detailmutasibank_grid->StartRecord - 1);
} elseif (!$detailmutasibank->AllowAddDeleteRow && $detailmutasibank_grid->StopRecord == 0) {
	$detailmutasibank_grid->StopRecord = $detailmutasibank->GridAddRowCount;
}

// Initialize aggregate
$detailmutasibank->RowType = ROWTYPE_AGGREGATEINIT;
$detailmutasibank->resetAttributes();
$detailmutasibank_grid->renderRow();
if ($detailmutasibank_grid->isGridAdd())
	$detailmutasibank_grid->RowIndex = 0;
if ($detailmutasibank_grid->isGridEdit())
	$detailmutasibank_grid->RowIndex = 0;
while ($detailmutasibank_grid->RecordCount < $detailmutasibank_grid->StopRecord) {
	$detailmutasibank_grid->RecordCount++;
	if ($detailmutasibank_grid->RecordCount >= $detailmutasibank_grid->StartRecord) {
		$detailmutasibank_grid->RowCount++;
		if ($detailmutasibank_grid->isGridAdd() || $detailmutasibank_grid->isGridEdit() || $detailmutasibank->isConfirm()) {
			$detailmutasibank_grid->RowIndex++;
			$CurrentForm->Index = $detailmutasibank_grid->RowIndex;
			if ($CurrentForm->hasValue($detailmutasibank_grid->FormActionName) && ($detailmutasibank->isConfirm() || $detailmutasibank_grid->EventCancelled))
				$detailmutasibank_grid->RowAction = strval($CurrentForm->getValue($detailmutasibank_grid->FormActionName));
			elseif ($detailmutasibank_grid->isGridAdd())
				$detailmutasibank_grid->RowAction = "insert";
			else
				$detailmutasibank_grid->RowAction = "";
		}

		// Set up key count
		$detailmutasibank_grid->KeyCount = $detailmutasibank_grid->RowIndex;

		// Init row class and style
		$detailmutasibank->resetAttributes();
		$detailmutasibank->CssClass = "";
		if ($detailmutasibank_grid->isGridAdd()) {
			if ($detailmutasibank->CurrentMode == "copy") {
				$detailmutasibank_grid->loadRowValues($detailmutasibank_grid->Recordset); // Load row values
				$detailmutasibank_grid->setRecordKey($detailmutasibank_grid->RowOldKey, $detailmutasibank_grid->Recordset); // Set old record key
			} else {
				$detailmutasibank_grid->loadRowValues(); // Load default values
				$detailmutasibank_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailmutasibank_grid->loadRowValues($detailmutasibank_grid->Recordset); // Load row values
		}
		$detailmutasibank->RowType = ROWTYPE_VIEW; // Render view
		if ($detailmutasibank_grid->isGridAdd()) // Grid add
			$detailmutasibank->RowType = ROWTYPE_ADD; // Render add
		if ($detailmutasibank_grid->isGridAdd() && $detailmutasibank->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailmutasibank_grid->restoreCurrentRowFormValues($detailmutasibank_grid->RowIndex); // Restore form values
		if ($detailmutasibank_grid->isGridEdit()) { // Grid edit
			if ($detailmutasibank->EventCancelled)
				$detailmutasibank_grid->restoreCurrentRowFormValues($detailmutasibank_grid->RowIndex); // Restore form values
			if ($detailmutasibank_grid->RowAction == "insert")
				$detailmutasibank->RowType = ROWTYPE_ADD; // Render add
			else
				$detailmutasibank->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailmutasibank_grid->isGridEdit() && ($detailmutasibank->RowType == ROWTYPE_EDIT || $detailmutasibank->RowType == ROWTYPE_ADD) && $detailmutasibank->EventCancelled) // Update failed
			$detailmutasibank_grid->restoreCurrentRowFormValues($detailmutasibank_grid->RowIndex); // Restore form values
		if ($detailmutasibank->RowType == ROWTYPE_EDIT) // Edit row
			$detailmutasibank_grid->EditRowCount++;
		if ($detailmutasibank->isConfirm()) // Confirm row
			$detailmutasibank_grid->restoreCurrentRowFormValues($detailmutasibank_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailmutasibank->RowAttrs->merge(["data-rowindex" => $detailmutasibank_grid->RowCount, "id" => "r" . $detailmutasibank_grid->RowCount . "_detailmutasibank", "data-rowtype" => $detailmutasibank->RowType]);

		// Render row
		$detailmutasibank_grid->renderRow();

		// Render list options
		$detailmutasibank_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailmutasibank_grid->RowAction != "delete" && $detailmutasibank_grid->RowAction != "insertdelete" && !($detailmutasibank_grid->RowAction == "insert" && $detailmutasibank->isConfirm() && $detailmutasibank_grid->emptyRow())) {
?>
	<tr <?php echo $detailmutasibank->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmutasibank_grid->ListOptions->render("body", "left", $detailmutasibank_grid->RowCount);
?>
	<?php if ($detailmutasibank_grid->akun_id->Visible) { // akun_id ?>
		<td data-name="akun_id" <?php echo $detailmutasibank_grid->akun_id->cellAttributes() ?>>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_akun_id" class="form-group">
<?php
$onchange = $detailmutasibank_grid->akun_id->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_grid->akun_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo RemoveHtml($detailmutasibank_grid->akun_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->getPlaceHolder()) ?>"<?php echo $detailmutasibank_grid->akun_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_grid->akun_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_grid->akun_id->ReadOnly || $detailmutasibank_grid->akun_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_grid->akun_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankgrid"], function() {
	fdetailmutasibankgrid.createAutoSuggest({"id":"x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_grid->akun_id->Lookup->getParamTag($detailmutasibank_grid, "p_x" . $detailmutasibank_grid->RowIndex . "_akun_id") ?>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->OldValue) ?>">
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_akun_id" class="form-group">
<?php
$onchange = $detailmutasibank_grid->akun_id->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_grid->akun_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo RemoveHtml($detailmutasibank_grid->akun_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->getPlaceHolder()) ?>"<?php echo $detailmutasibank_grid->akun_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_grid->akun_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_grid->akun_id->ReadOnly || $detailmutasibank_grid->akun_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_grid->akun_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankgrid"], function() {
	fdetailmutasibankgrid.createAutoSuggest({"id":"x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_grid->akun_id->Lookup->getParamTag($detailmutasibank_grid, "p_x" . $detailmutasibank_grid->RowIndex . "_akun_id") ?>
</span>
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_akun_id">
<span<?php echo $detailmutasibank_grid->akun_id->viewAttributes() ?>><?php echo $detailmutasibank_grid->akun_id->getViewValue() ?></span>
</span>
<?php if (!$detailmutasibank->isConfirm()) { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_id" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailmutasibank_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_id" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_id" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailmutasibank_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_EDIT || $detailmutasibank->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_id" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailmutasibank_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailmutasibank_grid->nama_akun->Visible) { // nama_akun ?>
		<td data-name="nama_akun" <?php echo $detailmutasibank_grid->nama_akun->cellAttributes() ?>>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_nama_akun" class="form-group">
<?php
$onchange = $detailmutasibank_grid->nama_akun->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_grid->nama_akun->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo RemoveHtml($detailmutasibank_grid->nama_akun->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->getPlaceHolder()) ?>"<?php echo $detailmutasibank_grid->nama_akun->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_grid->nama_akun->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_grid->nama_akun->ReadOnly || $detailmutasibank_grid->nama_akun->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_grid->nama_akun->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankgrid"], function() {
	fdetailmutasibankgrid.createAutoSuggest({"id":"x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_grid->nama_akun->Lookup->getParamTag($detailmutasibank_grid, "p_x" . $detailmutasibank_grid->RowIndex . "_nama_akun") ?>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->OldValue) ?>">
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_nama_akun" class="form-group">
<?php
$onchange = $detailmutasibank_grid->nama_akun->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_grid->nama_akun->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo RemoveHtml($detailmutasibank_grid->nama_akun->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->getPlaceHolder()) ?>"<?php echo $detailmutasibank_grid->nama_akun->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_grid->nama_akun->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_grid->nama_akun->ReadOnly || $detailmutasibank_grid->nama_akun->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_grid->nama_akun->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankgrid"], function() {
	fdetailmutasibankgrid.createAutoSuggest({"id":"x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_grid->nama_akun->Lookup->getParamTag($detailmutasibank_grid, "p_x" . $detailmutasibank_grid->RowIndex . "_nama_akun") ?>
</span>
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_nama_akun">
<span<?php echo $detailmutasibank_grid->nama_akun->viewAttributes() ?>><?php echo $detailmutasibank_grid->nama_akun->getViewValue() ?></span>
</span>
<?php if (!$detailmutasibank->isConfirm()) { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailmutasibank_grid->jumlah->cellAttributes() ?>>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_jumlah" class="form-group">
<input type="text" data-table="detailmutasibank" data-field="x_jumlah" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->jumlah->EditValue ?>"<?php echo $detailmutasibank_grid->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_jumlah" class="form-group">
<input type="text" data-table="detailmutasibank" data-field="x_jumlah" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->jumlah->EditValue ?>"<?php echo $detailmutasibank_grid->jumlah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_jumlah">
<span<?php echo $detailmutasibank_grid->jumlah->viewAttributes() ?>><?php echo $detailmutasibank_grid->jumlah->getViewValue() ?></span>
</span>
<?php if (!$detailmutasibank->isConfirm()) { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $detailmutasibank_grid->keterangan->cellAttributes() ?>>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_keterangan" class="form-group">
<input type="text" data-table="detailmutasibank" data-field="x_keterangan" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->keterangan->EditValue ?>"<?php echo $detailmutasibank_grid->keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_keterangan" class="form-group">
<input type="text" data-table="detailmutasibank" data-field="x_keterangan" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->keterangan->EditValue ?>"<?php echo $detailmutasibank_grid->keterangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_keterangan">
<span<?php echo $detailmutasibank_grid->keterangan->viewAttributes() ?>><?php echo $detailmutasibank_grid->keterangan->getViewValue() ?></span>
</span>
<?php if (!$detailmutasibank->isConfirm()) { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->tipe_mutasi->Visible) { // tipe_mutasi ?>
		<td data-name="tipe_mutasi" <?php echo $detailmutasibank_grid->tipe_mutasi->cellAttributes() ?>>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_tipe_mutasi" class="form-group">
<input type="text" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->tipe_mutasi->EditValue ?>"<?php echo $detailmutasibank_grid->tipe_mutasi->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->OldValue) ?>">
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_tipe_mutasi" class="form-group">
<input type="text" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->tipe_mutasi->EditValue ?>"<?php echo $detailmutasibank_grid->tipe_mutasi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmutasibank->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmutasibank_grid->RowCount ?>_detailmutasibank_tipe_mutasi">
<span<?php echo $detailmutasibank_grid->tipe_mutasi->viewAttributes() ?>><?php echo $detailmutasibank_grid->tipe_mutasi->getViewValue() ?></span>
</span>
<?php if (!$detailmutasibank->isConfirm()) { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="fdetailmutasibankgrid$x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->FormValue) ?>">
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="fdetailmutasibankgrid$o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailmutasibank_grid->ListOptions->render("body", "right", $detailmutasibank_grid->RowCount);
?>
	</tr>
<?php if ($detailmutasibank->RowType == ROWTYPE_ADD || $detailmutasibank->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailmutasibankgrid", "load"], function() {
	fdetailmutasibankgrid.updateLists(<?php echo $detailmutasibank_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailmutasibank_grid->isGridAdd() || $detailmutasibank->CurrentMode == "copy")
		if (!$detailmutasibank_grid->Recordset->EOF)
			$detailmutasibank_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailmutasibank->CurrentMode == "add" || $detailmutasibank->CurrentMode == "copy" || $detailmutasibank->CurrentMode == "edit") {
		$detailmutasibank_grid->RowIndex = '$rowindex$';
		$detailmutasibank_grid->loadRowValues();

		// Set row properties
		$detailmutasibank->resetAttributes();
		$detailmutasibank->RowAttrs->merge(["data-rowindex" => $detailmutasibank_grid->RowIndex, "id" => "r0_detailmutasibank", "data-rowtype" => ROWTYPE_ADD]);
		$detailmutasibank->RowAttrs->appendClass("ew-template");
		$detailmutasibank->RowType = ROWTYPE_ADD;

		// Render row
		$detailmutasibank_grid->renderRow();

		// Render list options
		$detailmutasibank_grid->renderListOptions();
		$detailmutasibank_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailmutasibank->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmutasibank_grid->ListOptions->render("body", "left", $detailmutasibank_grid->RowIndex);
?>
	<?php if ($detailmutasibank_grid->akun_id->Visible) { // akun_id ?>
		<td data-name="akun_id">
<?php if (!$detailmutasibank->isConfirm()) { ?>
<span id="el$rowindex$_detailmutasibank_akun_id" class="form-group detailmutasibank_akun_id">
<?php
$onchange = $detailmutasibank_grid->akun_id->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_grid->akun_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo RemoveHtml($detailmutasibank_grid->akun_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->getPlaceHolder()) ?>"<?php echo $detailmutasibank_grid->akun_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_grid->akun_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_grid->akun_id->ReadOnly || $detailmutasibank_grid->akun_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_grid->akun_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankgrid"], function() {
	fdetailmutasibankgrid.createAutoSuggest({"id":"x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_grid->akun_id->Lookup->getParamTag($detailmutasibank_grid, "p_x" . $detailmutasibank_grid->RowIndex . "_akun_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmutasibank_akun_id" class="form-group detailmutasibank_akun_id">
<span<?php echo $detailmutasibank_grid->akun_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmutasibank_grid->akun_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_akun_id" value="<?php echo HtmlEncode($detailmutasibank_grid->akun_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->nama_akun->Visible) { // nama_akun ?>
		<td data-name="nama_akun">
<?php if (!$detailmutasibank->isConfirm()) { ?>
<span id="el$rowindex$_detailmutasibank_nama_akun" class="form-group detailmutasibank_nama_akun">
<?php
$onchange = $detailmutasibank_grid->nama_akun->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_grid->nama_akun->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="sv_x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo RemoveHtml($detailmutasibank_grid->nama_akun->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->getPlaceHolder()) ?>"<?php echo $detailmutasibank_grid->nama_akun->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_grid->nama_akun->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_grid->nama_akun->ReadOnly || $detailmutasibank_grid->nama_akun->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_grid->nama_akun->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankgrid"], function() {
	fdetailmutasibankgrid.createAutoSuggest({"id":"x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_grid->nama_akun->Lookup->getParamTag($detailmutasibank_grid, "p_x" . $detailmutasibank_grid->RowIndex . "_nama_akun") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmutasibank_nama_akun" class="form-group detailmutasibank_nama_akun">
<span<?php echo $detailmutasibank_grid->nama_akun->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmutasibank_grid->nama_akun->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_grid->nama_akun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<?php if (!$detailmutasibank->isConfirm()) { ?>
<span id="el$rowindex$_detailmutasibank_jumlah" class="form-group detailmutasibank_jumlah">
<input type="text" data-table="detailmutasibank" data-field="x_jumlah" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->jumlah->EditValue ?>"<?php echo $detailmutasibank_grid->jumlah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmutasibank_jumlah" class="form-group detailmutasibank_jumlah">
<span<?php echo $detailmutasibank_grid->jumlah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmutasibank_grid->jumlah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_jumlah" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailmutasibank_grid->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan">
<?php if (!$detailmutasibank->isConfirm()) { ?>
<span id="el$rowindex$_detailmutasibank_keterangan" class="form-group detailmutasibank_keterangan">
<input type="text" data-table="detailmutasibank" data-field="x_keterangan" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->keterangan->EditValue ?>"<?php echo $detailmutasibank_grid->keterangan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmutasibank_keterangan" class="form-group detailmutasibank_keterangan">
<span<?php echo $detailmutasibank_grid->keterangan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmutasibank_grid->keterangan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_keterangan" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailmutasibank_grid->keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmutasibank_grid->tipe_mutasi->Visible) { // tipe_mutasi ?>
		<td data-name="tipe_mutasi">
<?php if (!$detailmutasibank->isConfirm()) { ?>
<span id="el$rowindex$_detailmutasibank_tipe_mutasi" class="form-group detailmutasibank_tipe_mutasi">
<input type="text" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_grid->tipe_mutasi->EditValue ?>"<?php echo $detailmutasibank_grid->tipe_mutasi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmutasibank_tipe_mutasi" class="form-group detailmutasibank_tipe_mutasi">
<span<?php echo $detailmutasibank_grid->tipe_mutasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmutasibank_grid->tipe_mutasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="x<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" id="o<?php echo $detailmutasibank_grid->RowIndex ?>_tipe_mutasi" value="<?php echo HtmlEncode($detailmutasibank_grid->tipe_mutasi->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailmutasibank_grid->ListOptions->render("body", "right", $detailmutasibank_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailmutasibankgrid", "load"], function() {
	fdetailmutasibankgrid.updateLists(<?php echo $detailmutasibank_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailmutasibank->CurrentMode == "add" || $detailmutasibank->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailmutasibank_grid->FormKeyCountName ?>" id="<?php echo $detailmutasibank_grid->FormKeyCountName ?>" value="<?php echo $detailmutasibank_grid->KeyCount ?>">
<?php echo $detailmutasibank_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailmutasibank->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailmutasibank_grid->FormKeyCountName ?>" id="<?php echo $detailmutasibank_grid->FormKeyCountName ?>" value="<?php echo $detailmutasibank_grid->KeyCount ?>">
<?php echo $detailmutasibank_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailmutasibank->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailmutasibankgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailmutasibank_grid->Recordset)
	$detailmutasibank_grid->Recordset->Close();
?>
<?php if ($detailmutasibank_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailmutasibank_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailmutasibank_grid->TotalRecords == 0 && !$detailmutasibank->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailmutasibank_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailmutasibank_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailmutasibank_grid->terminate();
?>