<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailpenyesuaianpoin_grid))
	$detailpenyesuaianpoin_grid = new detailpenyesuaianpoin_grid();

// Run the page
$detailpenyesuaianpoin_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianpoin_grid->Page_Render();
?>
<?php if (!$detailpenyesuaianpoin_grid->isExport()) { ?>
<script>
var fdetailpenyesuaianpoingrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailpenyesuaianpoingrid = new ew.Form("fdetailpenyesuaianpoingrid", "grid");
	fdetailpenyesuaianpoingrid.formKeyCountName = '<?php echo $detailpenyesuaianpoin_grid->FormKeyCountName ?>';

	// Validate form
	fdetailpenyesuaianpoingrid.validate = function() {
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
			<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_penyesuaianpoin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->caption(), $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_penyesuaianpoin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_grid->id_member->Required) { ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->id_member->caption(), $detailpenyesuaianpoin_grid->id_member->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_grid->id_member->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_grid->poin_database->Required) { ?>
				elm = this.getElements("x" + infix + "_poin_database");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->poin_database->caption(), $detailpenyesuaianpoin_grid->poin_database->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_poin_database");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_grid->poin_database->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_grid->poin_lapangan->Required) { ?>
				elm = this.getElements("x" + infix + "_poin_lapangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->poin_lapangan->caption(), $detailpenyesuaianpoin_grid->poin_lapangan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_poin_lapangan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_grid->poin_lapangan->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_grid->selisih->Required) { ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->selisih->caption(), $detailpenyesuaianpoin_grid->selisih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_grid->selisih->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_grid->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->tipe->caption(), $detailpenyesuaianpoin_grid->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenyesuaianpoin_grid->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_grid->keterangan->caption(), $detailpenyesuaianpoin_grid->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_grid->keterangan->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailpenyesuaianpoingrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid_penyesuaianpoin", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_member", false)) return false;
		if (ew.valueChanged(fobj, infix, "poin_database", false)) return false;
		if (ew.valueChanged(fobj, infix, "poin_lapangan", false)) return false;
		if (ew.valueChanged(fobj, infix, "selisih", false)) return false;
		if (ew.valueChanged(fobj, infix, "tipe", false)) return false;
		if (ew.valueChanged(fobj, infix, "keterangan", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpenyesuaianpoingrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpenyesuaianpoingrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdetailpenyesuaianpoingrid");
});
</script>
<?php } ?>
<?php
$detailpenyesuaianpoin_grid->renderOtherOptions();
?>
<?php if ($detailpenyesuaianpoin_grid->TotalRecords > 0 || $detailpenyesuaianpoin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpenyesuaianpoin_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpenyesuaianpoin">
<?php if ($detailpenyesuaianpoin_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailpenyesuaianpoin_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailpenyesuaianpoingrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailpenyesuaianpoin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailpenyesuaianpoingrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpenyesuaianpoin->RowType = ROWTYPE_HEADER;

// Render list options
$detailpenyesuaianpoin_grid->renderListOptions();

// Render list options (header, left)
$detailpenyesuaianpoin_grid->ListOptions->render("header", "left");
?>
<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->pid_penyesuaianpoin) == "") { ?>
		<th data-name="pid_penyesuaianpoin" class="<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin" class="detailpenyesuaianpoin_pid_penyesuaianpoin"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_penyesuaianpoin" class="<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin" class="detailpenyesuaianpoin_pid_penyesuaianpoin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->id_member->Visible) { // id_member ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->id_member) == "") { ?>
		<th data-name="id_member" class="<?php echo $detailpenyesuaianpoin_grid->id_member->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_id_member" class="detailpenyesuaianpoin_id_member"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->id_member->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_member" class="<?php echo $detailpenyesuaianpoin_grid->id_member->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_id_member" class="detailpenyesuaianpoin_id_member">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->id_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->id_member->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->id_member->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->poin_database->Visible) { // poin_database ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->poin_database) == "") { ?>
		<th data-name="poin_database" class="<?php echo $detailpenyesuaianpoin_grid->poin_database->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_poin_database" class="detailpenyesuaianpoin_poin_database"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->poin_database->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_database" class="<?php echo $detailpenyesuaianpoin_grid->poin_database->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_poin_database" class="detailpenyesuaianpoin_poin_database">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->poin_database->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->poin_database->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->poin_database->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->poin_lapangan->Visible) { // poin_lapangan ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->poin_lapangan) == "") { ?>
		<th data-name="poin_lapangan" class="<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_poin_lapangan" class="detailpenyesuaianpoin_poin_lapangan"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->poin_lapangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="poin_lapangan" class="<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_poin_lapangan" class="detailpenyesuaianpoin_poin_lapangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->poin_lapangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->poin_lapangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->poin_lapangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->selisih->Visible) { // selisih ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->selisih) == "") { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianpoin_grid->selisih->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_selisih" class="detailpenyesuaianpoin_selisih"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->selisih->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="selisih" class="<?php echo $detailpenyesuaianpoin_grid->selisih->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_selisih" class="detailpenyesuaianpoin_selisih">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->selisih->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->selisih->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->selisih->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->tipe->Visible) { // tipe ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianpoin_grid->tipe->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_tipe" class="detailpenyesuaianpoin_tipe"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $detailpenyesuaianpoin_grid->tipe->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_tipe" class="detailpenyesuaianpoin_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->keterangan->Visible) { // keterangan ?>
	<?php if ($detailpenyesuaianpoin_grid->SortUrl($detailpenyesuaianpoin_grid->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $detailpenyesuaianpoin_grid->keterangan->headerCellClass() ?>"><div id="elh_detailpenyesuaianpoin_keterangan" class="detailpenyesuaianpoin_keterangan"><div class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $detailpenyesuaianpoin_grid->keterangan->headerCellClass() ?>"><div><div id="elh_detailpenyesuaianpoin_keterangan" class="detailpenyesuaianpoin_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_grid->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_grid->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_grid->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenyesuaianpoin_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailpenyesuaianpoin_grid->StartRecord = 1;
$detailpenyesuaianpoin_grid->StopRecord = $detailpenyesuaianpoin_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailpenyesuaianpoin->isConfirm() || $detailpenyesuaianpoin_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailpenyesuaianpoin_grid->FormKeyCountName) && ($detailpenyesuaianpoin_grid->isGridAdd() || $detailpenyesuaianpoin_grid->isGridEdit() || $detailpenyesuaianpoin->isConfirm())) {
		$detailpenyesuaianpoin_grid->KeyCount = $CurrentForm->getValue($detailpenyesuaianpoin_grid->FormKeyCountName);
		$detailpenyesuaianpoin_grid->StopRecord = $detailpenyesuaianpoin_grid->StartRecord + $detailpenyesuaianpoin_grid->KeyCount - 1;
	}
}
$detailpenyesuaianpoin_grid->RecordCount = $detailpenyesuaianpoin_grid->StartRecord - 1;
if ($detailpenyesuaianpoin_grid->Recordset && !$detailpenyesuaianpoin_grid->Recordset->EOF) {
	$detailpenyesuaianpoin_grid->Recordset->moveFirst();
	$selectLimit = $detailpenyesuaianpoin_grid->UseSelectLimit;
	if (!$selectLimit && $detailpenyesuaianpoin_grid->StartRecord > 1)
		$detailpenyesuaianpoin_grid->Recordset->move($detailpenyesuaianpoin_grid->StartRecord - 1);
} elseif (!$detailpenyesuaianpoin->AllowAddDeleteRow && $detailpenyesuaianpoin_grid->StopRecord == 0) {
	$detailpenyesuaianpoin_grid->StopRecord = $detailpenyesuaianpoin->GridAddRowCount;
}

// Initialize aggregate
$detailpenyesuaianpoin->RowType = ROWTYPE_AGGREGATEINIT;
$detailpenyesuaianpoin->resetAttributes();
$detailpenyesuaianpoin_grid->renderRow();
if ($detailpenyesuaianpoin_grid->isGridAdd())
	$detailpenyesuaianpoin_grid->RowIndex = 0;
if ($detailpenyesuaianpoin_grid->isGridEdit())
	$detailpenyesuaianpoin_grid->RowIndex = 0;
while ($detailpenyesuaianpoin_grid->RecordCount < $detailpenyesuaianpoin_grid->StopRecord) {
	$detailpenyesuaianpoin_grid->RecordCount++;
	if ($detailpenyesuaianpoin_grid->RecordCount >= $detailpenyesuaianpoin_grid->StartRecord) {
		$detailpenyesuaianpoin_grid->RowCount++;
		if ($detailpenyesuaianpoin_grid->isGridAdd() || $detailpenyesuaianpoin_grid->isGridEdit() || $detailpenyesuaianpoin->isConfirm()) {
			$detailpenyesuaianpoin_grid->RowIndex++;
			$CurrentForm->Index = $detailpenyesuaianpoin_grid->RowIndex;
			if ($CurrentForm->hasValue($detailpenyesuaianpoin_grid->FormActionName) && ($detailpenyesuaianpoin->isConfirm() || $detailpenyesuaianpoin_grid->EventCancelled))
				$detailpenyesuaianpoin_grid->RowAction = strval($CurrentForm->getValue($detailpenyesuaianpoin_grid->FormActionName));
			elseif ($detailpenyesuaianpoin_grid->isGridAdd())
				$detailpenyesuaianpoin_grid->RowAction = "insert";
			else
				$detailpenyesuaianpoin_grid->RowAction = "";
		}

		// Set up key count
		$detailpenyesuaianpoin_grid->KeyCount = $detailpenyesuaianpoin_grid->RowIndex;

		// Init row class and style
		$detailpenyesuaianpoin->resetAttributes();
		$detailpenyesuaianpoin->CssClass = "";
		if ($detailpenyesuaianpoin_grid->isGridAdd()) {
			if ($detailpenyesuaianpoin->CurrentMode == "copy") {
				$detailpenyesuaianpoin_grid->loadRowValues($detailpenyesuaianpoin_grid->Recordset); // Load row values
				$detailpenyesuaianpoin_grid->setRecordKey($detailpenyesuaianpoin_grid->RowOldKey, $detailpenyesuaianpoin_grid->Recordset); // Set old record key
			} else {
				$detailpenyesuaianpoin_grid->loadRowValues(); // Load default values
				$detailpenyesuaianpoin_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailpenyesuaianpoin_grid->loadRowValues($detailpenyesuaianpoin_grid->Recordset); // Load row values
		}
		$detailpenyesuaianpoin->RowType = ROWTYPE_VIEW; // Render view
		if ($detailpenyesuaianpoin_grid->isGridAdd()) // Grid add
			$detailpenyesuaianpoin->RowType = ROWTYPE_ADD; // Render add
		if ($detailpenyesuaianpoin_grid->isGridAdd() && $detailpenyesuaianpoin->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailpenyesuaianpoin_grid->restoreCurrentRowFormValues($detailpenyesuaianpoin_grid->RowIndex); // Restore form values
		if ($detailpenyesuaianpoin_grid->isGridEdit()) { // Grid edit
			if ($detailpenyesuaianpoin->EventCancelled)
				$detailpenyesuaianpoin_grid->restoreCurrentRowFormValues($detailpenyesuaianpoin_grid->RowIndex); // Restore form values
			if ($detailpenyesuaianpoin_grid->RowAction == "insert")
				$detailpenyesuaianpoin->RowType = ROWTYPE_ADD; // Render add
			else
				$detailpenyesuaianpoin->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailpenyesuaianpoin_grid->isGridEdit() && ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT || $detailpenyesuaianpoin->RowType == ROWTYPE_ADD) && $detailpenyesuaianpoin->EventCancelled) // Update failed
			$detailpenyesuaianpoin_grid->restoreCurrentRowFormValues($detailpenyesuaianpoin_grid->RowIndex); // Restore form values
		if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) // Edit row
			$detailpenyesuaianpoin_grid->EditRowCount++;
		if ($detailpenyesuaianpoin->isConfirm()) // Confirm row
			$detailpenyesuaianpoin_grid->restoreCurrentRowFormValues($detailpenyesuaianpoin_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailpenyesuaianpoin->RowAttrs->merge(["data-rowindex" => $detailpenyesuaianpoin_grid->RowCount, "id" => "r" . $detailpenyesuaianpoin_grid->RowCount . "_detailpenyesuaianpoin", "data-rowtype" => $detailpenyesuaianpoin->RowType]);

		// Render row
		$detailpenyesuaianpoin_grid->renderRow();

		// Render list options
		$detailpenyesuaianpoin_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailpenyesuaianpoin_grid->RowAction != "delete" && $detailpenyesuaianpoin_grid->RowAction != "insertdelete" && !($detailpenyesuaianpoin_grid->RowAction == "insert" && $detailpenyesuaianpoin->isConfirm() && $detailpenyesuaianpoin_grid->emptyRow())) {
?>
	<tr <?php echo $detailpenyesuaianpoin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianpoin_grid->ListOptions->render("body", "left", $detailpenyesuaianpoin_grid->RowCount);
?>
	<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
		<td data-name="pid_penyesuaianpoin" <?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getSessionValue() != "") { ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group">
<span<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getSessionValue() != "") { ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group">
<span<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_detailpenyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_detailpenyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_detailpenyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_detailpenyesuaianpoin->CurrentValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_detailpenyesuaianpoin" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_detailpenyesuaianpoin" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_detailpenyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_detailpenyesuaianpoin->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT || $detailpenyesuaianpoin->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_detailpenyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_detailpenyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_detailpenyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_detailpenyesuaianpoin->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->id_member->Visible) { // id_member ?>
		<td data-name="id_member" <?php echo $detailpenyesuaianpoin_grid->id_member->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_id_member" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->id_member->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->id_member->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_id_member" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->id_member->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->id_member->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_id_member">
<span<?php echo $detailpenyesuaianpoin_grid->id_member->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->id_member->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->poin_database->Visible) { // poin_database ?>
		<td data-name="poin_database" <?php echo $detailpenyesuaianpoin_grid->poin_database->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_poin_database" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->poin_database->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->poin_database->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_poin_database" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->poin_database->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->poin_database->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_poin_database">
<span<?php echo $detailpenyesuaianpoin_grid->poin_database->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->poin_database->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->poin_lapangan->Visible) { // poin_lapangan ?>
		<td data-name="poin_lapangan" <?php echo $detailpenyesuaianpoin_grid->poin_lapangan->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_poin_lapangan" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_poin_lapangan" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_poin_lapangan">
<span<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->poin_lapangan->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->selisih->Visible) { // selisih ?>
		<td data-name="selisih" <?php echo $detailpenyesuaianpoin_grid->selisih->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_selisih" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->selisih->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->selisih->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_selisih" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->selisih->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->selisih->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_selisih">
<span<?php echo $detailpenyesuaianpoin_grid->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->selisih->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $detailpenyesuaianpoin_grid->tipe->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_tipe" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->tipe->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->tipe->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_tipe" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->tipe->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->tipe->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_tipe">
<span<?php echo $detailpenyesuaianpoin_grid->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->tipe->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $detailpenyesuaianpoin_grid->keterangan->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_keterangan" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->keterangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_keterangan" class="form-group">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->keterangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->keterangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenyesuaianpoin_grid->RowCount ?>_detailpenyesuaianpoin_keterangan">
<span<?php echo $detailpenyesuaianpoin_grid->keterangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_grid->keterangan->getViewValue() ?></span>
</span>
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="fdetailpenyesuaianpoingrid$x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="fdetailpenyesuaianpoingrid$o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianpoin_grid->ListOptions->render("body", "right", $detailpenyesuaianpoin_grid->RowCount);
?>
	</tr>
<?php if ($detailpenyesuaianpoin->RowType == ROWTYPE_ADD || $detailpenyesuaianpoin->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailpenyesuaianpoingrid", "load"], function() {
	fdetailpenyesuaianpoingrid.updateLists(<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailpenyesuaianpoin_grid->isGridAdd() || $detailpenyesuaianpoin->CurrentMode == "copy")
		if (!$detailpenyesuaianpoin_grid->Recordset->EOF)
			$detailpenyesuaianpoin_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailpenyesuaianpoin->CurrentMode == "add" || $detailpenyesuaianpoin->CurrentMode == "copy" || $detailpenyesuaianpoin->CurrentMode == "edit") {
		$detailpenyesuaianpoin_grid->RowIndex = '$rowindex$';
		$detailpenyesuaianpoin_grid->loadRowValues();

		// Set row properties
		$detailpenyesuaianpoin->resetAttributes();
		$detailpenyesuaianpoin->RowAttrs->merge(["data-rowindex" => $detailpenyesuaianpoin_grid->RowIndex, "id" => "r0_detailpenyesuaianpoin", "data-rowtype" => ROWTYPE_ADD]);
		$detailpenyesuaianpoin->RowAttrs->appendClass("ew-template");
		$detailpenyesuaianpoin->RowType = ROWTYPE_ADD;

		// Render row
		$detailpenyesuaianpoin_grid->renderRow();

		// Render list options
		$detailpenyesuaianpoin_grid->renderListOptions();
		$detailpenyesuaianpoin_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailpenyesuaianpoin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianpoin_grid->ListOptions->render("body", "left", $detailpenyesuaianpoin_grid->RowIndex);
?>
	<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
		<td data-name="pid_penyesuaianpoin">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<?php if ($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group detailpenyesuaianpoin_pid_penyesuaianpoin">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_pid_penyesuaianpoin" class="form-group detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_grid->pid_penyesuaianpoin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->pid_penyesuaianpoin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->id_member->Visible) { // id_member ?>
		<td data-name="id_member">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_id_member" class="form-group detailpenyesuaianpoin_id_member">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->id_member->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->id_member->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_id_member" class="form-group detailpenyesuaianpoin_id_member">
<span<?php echo $detailpenyesuaianpoin_grid->id_member->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->id_member->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_id_member" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->id_member->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->poin_database->Visible) { // poin_database ?>
		<td data-name="poin_database">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_poin_database" class="form-group detailpenyesuaianpoin_poin_database">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->poin_database->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->poin_database->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_poin_database" class="form-group detailpenyesuaianpoin_poin_database">
<span<?php echo $detailpenyesuaianpoin_grid->poin_database->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->poin_database->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_database" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_database->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->poin_lapangan->Visible) { // poin_lapangan ?>
		<td data-name="poin_lapangan">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_poin_lapangan" class="form-group detailpenyesuaianpoin_poin_lapangan">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_poin_lapangan" class="form-group detailpenyesuaianpoin_poin_lapangan">
<span<?php echo $detailpenyesuaianpoin_grid->poin_lapangan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->poin_lapangan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_poin_lapangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->poin_lapangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->selisih->Visible) { // selisih ?>
		<td data-name="selisih">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_selisih" class="form-group detailpenyesuaianpoin_selisih">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->selisih->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->selisih->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_selisih" class="form-group detailpenyesuaianpoin_selisih">
<span<?php echo $detailpenyesuaianpoin_grid->selisih->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->selisih->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_selisih" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->selisih->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->tipe->Visible) { // tipe ?>
		<td data-name="tipe">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_tipe" class="form-group detailpenyesuaianpoin_tipe">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->tipe->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->tipe->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_tipe" class="form-group detailpenyesuaianpoin_tipe">
<span<?php echo $detailpenyesuaianpoin_grid->tipe->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->tipe->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_tipe" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->tipe->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenyesuaianpoin_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan">
<?php if (!$detailpenyesuaianpoin->isConfirm()) { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_keterangan" class="form-group detailpenyesuaianpoin_keterangan">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_grid->keterangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_grid->keterangan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenyesuaianpoin_keterangan" class="form-group detailpenyesuaianpoin_keterangan">
<span<?php echo $detailpenyesuaianpoin_grid->keterangan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_grid->keterangan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="x<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" id="o<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($detailpenyesuaianpoin_grid->keterangan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianpoin_grid->ListOptions->render("body", "right", $detailpenyesuaianpoin_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailpenyesuaianpoingrid", "load"], function() {
	fdetailpenyesuaianpoingrid.updateLists(<?php echo $detailpenyesuaianpoin_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailpenyesuaianpoin->CurrentMode == "add" || $detailpenyesuaianpoin->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailpenyesuaianpoin_grid->FormKeyCountName ?>" id="<?php echo $detailpenyesuaianpoin_grid->FormKeyCountName ?>" value="<?php echo $detailpenyesuaianpoin_grid->KeyCount ?>">
<?php echo $detailpenyesuaianpoin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailpenyesuaianpoin_grid->FormKeyCountName ?>" id="<?php echo $detailpenyesuaianpoin_grid->FormKeyCountName ?>" value="<?php echo $detailpenyesuaianpoin_grid->KeyCount ?>">
<?php echo $detailpenyesuaianpoin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailpenyesuaianpoingrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpenyesuaianpoin_grid->Recordset)
	$detailpenyesuaianpoin_grid->Recordset->Close();
?>
<?php if ($detailpenyesuaianpoin_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailpenyesuaianpoin_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpenyesuaianpoin_grid->TotalRecords == 0 && !$detailpenyesuaianpoin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpenyesuaianpoin_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailpenyesuaianpoin_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailpenyesuaianpoin_grid->terminate();
?>