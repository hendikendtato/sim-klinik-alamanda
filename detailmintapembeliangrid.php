<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailmintapembelian_grid))
	$detailmintapembelian_grid = new detailmintapembelian_grid();

// Run the page
$detailmintapembelian_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmintapembelian_grid->Page_Render();
?>
<?php if (!$detailmintapembelian_grid->isExport()) { ?>
<script>
var fdetailmintapembeliangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailmintapembeliangrid = new ew.Form("fdetailmintapembeliangrid", "grid");
	fdetailmintapembeliangrid.formKeyCountName = '<?php echo $detailmintapembelian_grid->FormKeyCountName ?>';

	// Validate form
	fdetailmintapembeliangrid.validate = function() {
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
			<?php if ($detailmintapembelian_grid->id_detailpp->Required) { ?>
				elm = this.getElements("x" + infix + "_id_detailpp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->id_detailpp->caption(), $detailmintapembelian_grid->id_detailpp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_grid->pid_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->pid_pp->caption(), $detailmintapembelian_grid->pid_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_pp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_grid->pid_pp->errorMessage()) ?>");
			<?php if ($detailmintapembelian_grid->idbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_idbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->idbarang->caption(), $detailmintapembelian_grid->idbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_grid->part->Required) { ?>
				elm = this.getElements("x" + infix + "_part");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->part->caption(), $detailmintapembelian_grid->part->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_grid->lot->Required) { ?>
				elm = this.getElements("x" + infix + "_lot");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->lot->caption(), $detailmintapembelian_grid->lot->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_grid->qty_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_qty_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->qty_pp->caption(), $detailmintapembelian_grid->qty_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty_pp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_grid->qty_pp->errorMessage()) ?>");
			<?php if ($detailmintapembelian_grid->qty_acc->Required) { ?>
				elm = this.getElements("x" + infix + "_qty_acc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->qty_acc->caption(), $detailmintapembelian_grid->qty_acc->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty_acc");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_grid->qty_acc->errorMessage()) ?>");
			<?php if ($detailmintapembelian_grid->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->id_satuan->caption(), $detailmintapembelian_grid->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_grid->harga->Required) { ?>
				elm = this.getElements("x" + infix + "_harga");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->harga->caption(), $detailmintapembelian_grid->harga->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_grid->harga->errorMessage()) ?>");
			<?php if ($detailmintapembelian_grid->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_grid->total->caption(), $detailmintapembelian_grid->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_grid->total->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailmintapembeliangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid_pp", false)) return false;
		if (ew.valueChanged(fobj, infix, "idbarang", false)) return false;
		if (ew.valueChanged(fobj, infix, "part", false)) return false;
		if (ew.valueChanged(fobj, infix, "lot", false)) return false;
		if (ew.valueChanged(fobj, infix, "qty_pp", false)) return false;
		if (ew.valueChanged(fobj, infix, "qty_acc", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_satuan", false)) return false;
		if (ew.valueChanged(fobj, infix, "harga", false)) return false;
		if (ew.valueChanged(fobj, infix, "total", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailmintapembeliangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailmintapembeliangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailmintapembeliangrid.lists["x_idbarang"] = <?php echo $detailmintapembelian_grid->idbarang->Lookup->toClientList($detailmintapembelian_grid) ?>;
	fdetailmintapembeliangrid.lists["x_idbarang"].options = <?php echo JsonEncode($detailmintapembelian_grid->idbarang->lookupOptions()) ?>;
	fdetailmintapembeliangrid.lists["x_id_satuan"] = <?php echo $detailmintapembelian_grid->id_satuan->Lookup->toClientList($detailmintapembelian_grid) ?>;
	fdetailmintapembeliangrid.lists["x_id_satuan"].options = <?php echo JsonEncode($detailmintapembelian_grid->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailmintapembeliangrid");
});
</script>
<?php } ?>
<?php
$detailmintapembelian_grid->renderOtherOptions();
?>
<?php if ($detailmintapembelian_grid->TotalRecords > 0 || $detailmintapembelian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailmintapembelian_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailmintapembelian">
<?php if ($detailmintapembelian_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailmintapembelian_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailmintapembeliangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailmintapembelian" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailmintapembeliangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailmintapembelian->RowType = ROWTYPE_HEADER;

// Render list options
$detailmintapembelian_grid->renderListOptions();

// Render list options (header, left)
$detailmintapembelian_grid->ListOptions->render("header", "left");
?>
<?php if ($detailmintapembelian_grid->id_detailpp->Visible) { // id_detailpp ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->id_detailpp) == "") { ?>
		<th data-name="id_detailpp" class="<?php echo $detailmintapembelian_grid->id_detailpp->headerCellClass() ?>"><div id="elh_detailmintapembelian_id_detailpp" class="detailmintapembelian_id_detailpp"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->id_detailpp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailpp" class="<?php echo $detailmintapembelian_grid->id_detailpp->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_id_detailpp" class="detailmintapembelian_id_detailpp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->id_detailpp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->id_detailpp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->id_detailpp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->pid_pp->Visible) { // pid_pp ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->pid_pp) == "") { ?>
		<th data-name="pid_pp" class="<?php echo $detailmintapembelian_grid->pid_pp->headerCellClass() ?>"><div id="elh_detailmintapembelian_pid_pp" class="detailmintapembelian_pid_pp"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->pid_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid_pp" class="<?php echo $detailmintapembelian_grid->pid_pp->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_pid_pp" class="detailmintapembelian_pid_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->pid_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->pid_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->pid_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->idbarang->Visible) { // idbarang ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->idbarang) == "") { ?>
		<th data-name="idbarang" class="<?php echo $detailmintapembelian_grid->idbarang->headerCellClass() ?>"><div id="elh_detailmintapembelian_idbarang" class="detailmintapembelian_idbarang"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->idbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idbarang" class="<?php echo $detailmintapembelian_grid->idbarang->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_idbarang" class="detailmintapembelian_idbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->idbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->idbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->idbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->part->Visible) { // part ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->part) == "") { ?>
		<th data-name="part" class="<?php echo $detailmintapembelian_grid->part->headerCellClass() ?>"><div id="elh_detailmintapembelian_part" class="detailmintapembelian_part"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->part->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="part" class="<?php echo $detailmintapembelian_grid->part->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_part" class="detailmintapembelian_part">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->part->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->part->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->part->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->lot->Visible) { // lot ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->lot) == "") { ?>
		<th data-name="lot" class="<?php echo $detailmintapembelian_grid->lot->headerCellClass() ?>"><div id="elh_detailmintapembelian_lot" class="detailmintapembelian_lot"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->lot->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lot" class="<?php echo $detailmintapembelian_grid->lot->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_lot" class="detailmintapembelian_lot">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->lot->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->lot->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->lot->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->qty_pp->Visible) { // qty_pp ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->qty_pp) == "") { ?>
		<th data-name="qty_pp" class="<?php echo $detailmintapembelian_grid->qty_pp->headerCellClass() ?>"><div id="elh_detailmintapembelian_qty_pp" class="detailmintapembelian_qty_pp"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->qty_pp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_pp" class="<?php echo $detailmintapembelian_grid->qty_pp->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_qty_pp" class="detailmintapembelian_qty_pp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->qty_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->qty_pp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->qty_pp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->qty_acc->Visible) { // qty_acc ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->qty_acc) == "") { ?>
		<th data-name="qty_acc" class="<?php echo $detailmintapembelian_grid->qty_acc->headerCellClass() ?>"><div id="elh_detailmintapembelian_qty_acc" class="detailmintapembelian_qty_acc"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->qty_acc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty_acc" class="<?php echo $detailmintapembelian_grid->qty_acc->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_qty_acc" class="detailmintapembelian_qty_acc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->qty_acc->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->qty_acc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->qty_acc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailmintapembelian_grid->id_satuan->headerCellClass() ?>"><div id="elh_detailmintapembelian_id_satuan" class="detailmintapembelian_id_satuan"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailmintapembelian_grid->id_satuan->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_id_satuan" class="detailmintapembelian_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->harga->Visible) { // harga ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->harga) == "") { ?>
		<th data-name="harga" class="<?php echo $detailmintapembelian_grid->harga->headerCellClass() ?>"><div id="elh_detailmintapembelian_harga" class="detailmintapembelian_harga"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->harga->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga" class="<?php echo $detailmintapembelian_grid->harga->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_harga" class="detailmintapembelian_harga">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->harga->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->harga->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->harga->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_grid->total->Visible) { // total ?>
	<?php if ($detailmintapembelian_grid->SortUrl($detailmintapembelian_grid->total) == "") { ?>
		<th data-name="total" class="<?php echo $detailmintapembelian_grid->total->headerCellClass() ?>"><div id="elh_detailmintapembelian_total" class="detailmintapembelian_total"><div class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $detailmintapembelian_grid->total->headerCellClass() ?>"><div><div id="elh_detailmintapembelian_total" class="detailmintapembelian_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_grid->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_grid->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_grid->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailmintapembelian_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailmintapembelian_grid->StartRecord = 1;
$detailmintapembelian_grid->StopRecord = $detailmintapembelian_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailmintapembelian->isConfirm() || $detailmintapembelian_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailmintapembelian_grid->FormKeyCountName) && ($detailmintapembelian_grid->isGridAdd() || $detailmintapembelian_grid->isGridEdit() || $detailmintapembelian->isConfirm())) {
		$detailmintapembelian_grid->KeyCount = $CurrentForm->getValue($detailmintapembelian_grid->FormKeyCountName);
		$detailmintapembelian_grid->StopRecord = $detailmintapembelian_grid->StartRecord + $detailmintapembelian_grid->KeyCount - 1;
	}
}
$detailmintapembelian_grid->RecordCount = $detailmintapembelian_grid->StartRecord - 1;
if ($detailmintapembelian_grid->Recordset && !$detailmintapembelian_grid->Recordset->EOF) {
	$detailmintapembelian_grid->Recordset->moveFirst();
	$selectLimit = $detailmintapembelian_grid->UseSelectLimit;
	if (!$selectLimit && $detailmintapembelian_grid->StartRecord > 1)
		$detailmintapembelian_grid->Recordset->move($detailmintapembelian_grid->StartRecord - 1);
} elseif (!$detailmintapembelian->AllowAddDeleteRow && $detailmintapembelian_grid->StopRecord == 0) {
	$detailmintapembelian_grid->StopRecord = $detailmintapembelian->GridAddRowCount;
}

// Initialize aggregate
$detailmintapembelian->RowType = ROWTYPE_AGGREGATEINIT;
$detailmintapembelian->resetAttributes();
$detailmintapembelian_grid->renderRow();
if ($detailmintapembelian_grid->isGridAdd())
	$detailmintapembelian_grid->RowIndex = 0;
if ($detailmintapembelian_grid->isGridEdit())
	$detailmintapembelian_grid->RowIndex = 0;
while ($detailmintapembelian_grid->RecordCount < $detailmintapembelian_grid->StopRecord) {
	$detailmintapembelian_grid->RecordCount++;
	if ($detailmintapembelian_grid->RecordCount >= $detailmintapembelian_grid->StartRecord) {
		$detailmintapembelian_grid->RowCount++;
		if ($detailmintapembelian_grid->isGridAdd() || $detailmintapembelian_grid->isGridEdit() || $detailmintapembelian->isConfirm()) {
			$detailmintapembelian_grid->RowIndex++;
			$CurrentForm->Index = $detailmintapembelian_grid->RowIndex;
			if ($CurrentForm->hasValue($detailmintapembelian_grid->FormActionName) && ($detailmintapembelian->isConfirm() || $detailmintapembelian_grid->EventCancelled))
				$detailmintapembelian_grid->RowAction = strval($CurrentForm->getValue($detailmintapembelian_grid->FormActionName));
			elseif ($detailmintapembelian_grid->isGridAdd())
				$detailmintapembelian_grid->RowAction = "insert";
			else
				$detailmintapembelian_grid->RowAction = "";
		}

		// Set up key count
		$detailmintapembelian_grid->KeyCount = $detailmintapembelian_grid->RowIndex;

		// Init row class and style
		$detailmintapembelian->resetAttributes();
		$detailmintapembelian->CssClass = "";
		if ($detailmintapembelian_grid->isGridAdd()) {
			if ($detailmintapembelian->CurrentMode == "copy") {
				$detailmintapembelian_grid->loadRowValues($detailmintapembelian_grid->Recordset); // Load row values
				$detailmintapembelian_grid->setRecordKey($detailmintapembelian_grid->RowOldKey, $detailmintapembelian_grid->Recordset); // Set old record key
			} else {
				$detailmintapembelian_grid->loadRowValues(); // Load default values
				$detailmintapembelian_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailmintapembelian_grid->loadRowValues($detailmintapembelian_grid->Recordset); // Load row values
		}
		$detailmintapembelian->RowType = ROWTYPE_VIEW; // Render view
		if ($detailmintapembelian_grid->isGridAdd()) // Grid add
			$detailmintapembelian->RowType = ROWTYPE_ADD; // Render add
		if ($detailmintapembelian_grid->isGridAdd() && $detailmintapembelian->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailmintapembelian_grid->restoreCurrentRowFormValues($detailmintapembelian_grid->RowIndex); // Restore form values
		if ($detailmintapembelian_grid->isGridEdit()) { // Grid edit
			if ($detailmintapembelian->EventCancelled)
				$detailmintapembelian_grid->restoreCurrentRowFormValues($detailmintapembelian_grid->RowIndex); // Restore form values
			if ($detailmintapembelian_grid->RowAction == "insert")
				$detailmintapembelian->RowType = ROWTYPE_ADD; // Render add
			else
				$detailmintapembelian->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailmintapembelian_grid->isGridEdit() && ($detailmintapembelian->RowType == ROWTYPE_EDIT || $detailmintapembelian->RowType == ROWTYPE_ADD) && $detailmintapembelian->EventCancelled) // Update failed
			$detailmintapembelian_grid->restoreCurrentRowFormValues($detailmintapembelian_grid->RowIndex); // Restore form values
		if ($detailmintapembelian->RowType == ROWTYPE_EDIT) // Edit row
			$detailmintapembelian_grid->EditRowCount++;
		if ($detailmintapembelian->isConfirm()) // Confirm row
			$detailmintapembelian_grid->restoreCurrentRowFormValues($detailmintapembelian_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailmintapembelian->RowAttrs->merge(["data-rowindex" => $detailmintapembelian_grid->RowCount, "id" => "r" . $detailmintapembelian_grid->RowCount . "_detailmintapembelian", "data-rowtype" => $detailmintapembelian->RowType]);

		// Render row
		$detailmintapembelian_grid->renderRow();

		// Render list options
		$detailmintapembelian_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailmintapembelian_grid->RowAction != "delete" && $detailmintapembelian_grid->RowAction != "insertdelete" && !($detailmintapembelian_grid->RowAction == "insert" && $detailmintapembelian->isConfirm() && $detailmintapembelian_grid->emptyRow())) {
?>
	<tr <?php echo $detailmintapembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmintapembelian_grid->ListOptions->render("body", "left", $detailmintapembelian_grid->RowCount);
?>
	<?php if ($detailmintapembelian_grid->id_detailpp->Visible) { // id_detailpp ?>
		<td data-name="id_detailpp" <?php echo $detailmintapembelian_grid->id_detailpp->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_id_detailpp" class="form-group"></span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_id_detailpp" class="form-group">
<span<?php echo $detailmintapembelian_grid->id_detailpp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->id_detailpp->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->CurrentValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_id_detailpp">
<span<?php echo $detailmintapembelian_grid->id_detailpp->viewAttributes() ?>><?php echo $detailmintapembelian_grid->id_detailpp->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->pid_pp->Visible) { // pid_pp ?>
		<td data-name="pid_pp" <?php echo $detailmintapembelian_grid->pid_pp->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailmintapembelian_grid->pid_pp->getSessionValue() != "") { ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_pid_pp" class="form-group">
<span<?php echo $detailmintapembelian_grid->pid_pp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->pid_pp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_pid_pp" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->pid_pp->EditValue ?>"<?php echo $detailmintapembelian_grid->pid_pp->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailmintapembelian_grid->pid_pp->getSessionValue() != "") { ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_pid_pp" class="form-group">
<span<?php echo $detailmintapembelian_grid->pid_pp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->pid_pp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_pid_pp" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->pid_pp->EditValue ?>"<?php echo $detailmintapembelian_grid->pid_pp->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_grid->pid_pp->viewAttributes() ?>><?php echo $detailmintapembelian_grid->pid_pp->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->idbarang->Visible) { // idbarang ?>
		<td data-name="idbarang" <?php echo $detailmintapembelian_grid->idbarang->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_idbarang" class="form-group">
<?php $detailmintapembelian_grid->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_idbarang" data-value-separator="<?php echo $detailmintapembelian_grid->idbarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" size="40"<?php echo $detailmintapembelian_grid->idbarang->editAttributes() ?>>
			<?php echo $detailmintapembelian_grid->idbarang->selectOptionListHtml("x{$detailmintapembelian_grid->RowIndex}_idbarang") ?>
		</select>
</div>
<?php echo $detailmintapembelian_grid->idbarang->Lookup->getParamTag($detailmintapembelian_grid, "p_x" . $detailmintapembelian_grid->RowIndex . "_idbarang") ?>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_idbarang" class="form-group">
<?php $detailmintapembelian_grid->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_idbarang" data-value-separator="<?php echo $detailmintapembelian_grid->idbarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" size="40"<?php echo $detailmintapembelian_grid->idbarang->editAttributes() ?>>
			<?php echo $detailmintapembelian_grid->idbarang->selectOptionListHtml("x{$detailmintapembelian_grid->RowIndex}_idbarang") ?>
		</select>
</div>
<?php echo $detailmintapembelian_grid->idbarang->Lookup->getParamTag($detailmintapembelian_grid, "p_x" . $detailmintapembelian_grid->RowIndex . "_idbarang") ?>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_idbarang">
<span<?php echo $detailmintapembelian_grid->idbarang->viewAttributes() ?>><?php echo $detailmintapembelian_grid->idbarang->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->part->Visible) { // part ?>
		<td data-name="part" <?php echo $detailmintapembelian_grid->part->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_part" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_part" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->part->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->part->EditValue ?>"<?php echo $detailmintapembelian_grid->part->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_part" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_part" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->part->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->part->EditValue ?>"<?php echo $detailmintapembelian_grid->part->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_part">
<span<?php echo $detailmintapembelian_grid->part->viewAttributes() ?>><?php echo $detailmintapembelian_grid->part->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->lot->Visible) { // lot ?>
		<td data-name="lot" <?php echo $detailmintapembelian_grid->lot->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_lot" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_lot" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->lot->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->lot->EditValue ?>"<?php echo $detailmintapembelian_grid->lot->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_lot" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_lot" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->lot->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->lot->EditValue ?>"<?php echo $detailmintapembelian_grid->lot->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_lot">
<span<?php echo $detailmintapembelian_grid->lot->viewAttributes() ?>><?php echo $detailmintapembelian_grid->lot->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->qty_pp->Visible) { // qty_pp ?>
		<td data-name="qty_pp" <?php echo $detailmintapembelian_grid->qty_pp->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_qty_pp" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->qty_pp->EditValue ?>"<?php echo $detailmintapembelian_grid->qty_pp->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_qty_pp" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->qty_pp->EditValue ?>"<?php echo $detailmintapembelian_grid->qty_pp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_qty_pp">
<span<?php echo $detailmintapembelian_grid->qty_pp->viewAttributes() ?>><?php echo $detailmintapembelian_grid->qty_pp->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->qty_acc->Visible) { // qty_acc ?>
		<td data-name="qty_acc" <?php echo $detailmintapembelian_grid->qty_acc->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_qty_acc" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_acc" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->qty_acc->EditValue ?>"<?php echo $detailmintapembelian_grid->qty_acc->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_qty_acc" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_acc" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->qty_acc->EditValue ?>"<?php echo $detailmintapembelian_grid->qty_acc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_qty_acc">
<span<?php echo $detailmintapembelian_grid->qty_acc->viewAttributes() ?>><?php echo $detailmintapembelian_grid->qty_acc->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailmintapembelian_grid->id_satuan->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_id_satuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_id_satuan" data-value-separator="<?php echo $detailmintapembelian_grid->id_satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan"<?php echo $detailmintapembelian_grid->id_satuan->editAttributes() ?>>
			<?php echo $detailmintapembelian_grid->id_satuan->selectOptionListHtml("x{$detailmintapembelian_grid->RowIndex}_id_satuan") ?>
		</select>
</div>
<?php echo $detailmintapembelian_grid->id_satuan->Lookup->getParamTag($detailmintapembelian_grid, "p_x" . $detailmintapembelian_grid->RowIndex . "_id_satuan") ?>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_id_satuan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_id_satuan" data-value-separator="<?php echo $detailmintapembelian_grid->id_satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan"<?php echo $detailmintapembelian_grid->id_satuan->editAttributes() ?>>
			<?php echo $detailmintapembelian_grid->id_satuan->selectOptionListHtml("x{$detailmintapembelian_grid->RowIndex}_id_satuan") ?>
		</select>
</div>
<?php echo $detailmintapembelian_grid->id_satuan->Lookup->getParamTag($detailmintapembelian_grid, "p_x" . $detailmintapembelian_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_id_satuan">
<span<?php echo $detailmintapembelian_grid->id_satuan->viewAttributes() ?>><?php echo $detailmintapembelian_grid->id_satuan->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->harga->Visible) { // harga ?>
		<td data-name="harga" <?php echo $detailmintapembelian_grid->harga->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_harga" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_harga" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->harga->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->harga->EditValue ?>"<?php echo $detailmintapembelian_grid->harga->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_harga" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_harga" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->harga->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->harga->EditValue ?>"<?php echo $detailmintapembelian_grid->harga->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_harga">
<span<?php echo $detailmintapembelian_grid->harga->viewAttributes() ?>><?php echo $detailmintapembelian_grid->harga->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->total->Visible) { // total ?>
		<td data-name="total" <?php echo $detailmintapembelian_grid->total->cellAttributes() ?>>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_total" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_total" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->total->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->total->EditValue ?>"<?php echo $detailmintapembelian_grid->total->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->OldValue) ?>">
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_total" class="form-group">
<input type="text" data-table="detailmintapembelian" data-field="x_total" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->total->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->total->EditValue ?>"<?php echo $detailmintapembelian_grid->total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailmintapembelian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailmintapembelian_grid->RowCount ?>_detailmintapembelian_total">
<span<?php echo $detailmintapembelian_grid->total->viewAttributes() ?>><?php echo $detailmintapembelian_grid->total->getViewValue() ?></span>
</span>
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="fdetailmintapembeliangrid$x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->FormValue) ?>">
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="fdetailmintapembeliangrid$o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailmintapembelian_grid->ListOptions->render("body", "right", $detailmintapembelian_grid->RowCount);
?>
	</tr>
<?php if ($detailmintapembelian->RowType == ROWTYPE_ADD || $detailmintapembelian->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailmintapembeliangrid", "load"], function() {
	fdetailmintapembeliangrid.updateLists(<?php echo $detailmintapembelian_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailmintapembelian_grid->isGridAdd() || $detailmintapembelian->CurrentMode == "copy")
		if (!$detailmintapembelian_grid->Recordset->EOF)
			$detailmintapembelian_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailmintapembelian->CurrentMode == "add" || $detailmintapembelian->CurrentMode == "copy" || $detailmintapembelian->CurrentMode == "edit") {
		$detailmintapembelian_grid->RowIndex = '$rowindex$';
		$detailmintapembelian_grid->loadRowValues();

		// Set row properties
		$detailmintapembelian->resetAttributes();
		$detailmintapembelian->RowAttrs->merge(["data-rowindex" => $detailmintapembelian_grid->RowIndex, "id" => "r0_detailmintapembelian", "data-rowtype" => ROWTYPE_ADD]);
		$detailmintapembelian->RowAttrs->appendClass("ew-template");
		$detailmintapembelian->RowType = ROWTYPE_ADD;

		// Render row
		$detailmintapembelian_grid->renderRow();

		// Render list options
		$detailmintapembelian_grid->renderListOptions();
		$detailmintapembelian_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailmintapembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmintapembelian_grid->ListOptions->render("body", "left", $detailmintapembelian_grid->RowIndex);
?>
	<?php if ($detailmintapembelian_grid->id_detailpp->Visible) { // id_detailpp ?>
		<td data-name="id_detailpp">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_id_detailpp" class="form-group detailmintapembelian_id_detailpp"></span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_id_detailpp" class="form-group detailmintapembelian_id_detailpp">
<span<?php echo $detailmintapembelian_grid->id_detailpp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->id_detailpp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_detailpp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_detailpp" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_detailpp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->pid_pp->Visible) { // pid_pp ?>
		<td data-name="pid_pp">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<?php if ($detailmintapembelian_grid->pid_pp->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailmintapembelian_pid_pp" class="form-group detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_grid->pid_pp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->pid_pp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_pid_pp" class="form-group detailmintapembelian_pid_pp">
<input type="text" data-table="detailmintapembelian" data-field="x_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->pid_pp->EditValue ?>"<?php echo $detailmintapembelian_grid->pid_pp->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_pid_pp" class="form-group detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_grid->pid_pp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->pid_pp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_pid_pp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->pid_pp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->idbarang->Visible) { // idbarang ?>
		<td data-name="idbarang">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_idbarang" class="form-group detailmintapembelian_idbarang">
<?php $detailmintapembelian_grid->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_idbarang" data-value-separator="<?php echo $detailmintapembelian_grid->idbarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" size="40"<?php echo $detailmintapembelian_grid->idbarang->editAttributes() ?>>
			<?php echo $detailmintapembelian_grid->idbarang->selectOptionListHtml("x{$detailmintapembelian_grid->RowIndex}_idbarang") ?>
		</select>
</div>
<?php echo $detailmintapembelian_grid->idbarang->Lookup->getParamTag($detailmintapembelian_grid, "p_x" . $detailmintapembelian_grid->RowIndex . "_idbarang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_idbarang" class="form-group detailmintapembelian_idbarang">
<span<?php echo $detailmintapembelian_grid->idbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->idbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_idbarang" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_idbarang" value="<?php echo HtmlEncode($detailmintapembelian_grid->idbarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->part->Visible) { // part ?>
		<td data-name="part">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_part" class="form-group detailmintapembelian_part">
<input type="text" data-table="detailmintapembelian" data-field="x_part" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->part->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->part->EditValue ?>"<?php echo $detailmintapembelian_grid->part->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_part" class="form-group detailmintapembelian_part">
<span<?php echo $detailmintapembelian_grid->part->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->part->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_part" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_part" value="<?php echo HtmlEncode($detailmintapembelian_grid->part->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->lot->Visible) { // lot ?>
		<td data-name="lot">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_lot" class="form-group detailmintapembelian_lot">
<input type="text" data-table="detailmintapembelian" data-field="x_lot" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->lot->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->lot->EditValue ?>"<?php echo $detailmintapembelian_grid->lot->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_lot" class="form-group detailmintapembelian_lot">
<span<?php echo $detailmintapembelian_grid->lot->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->lot->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_lot" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_lot" value="<?php echo HtmlEncode($detailmintapembelian_grid->lot->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->qty_pp->Visible) { // qty_pp ?>
		<td data-name="qty_pp">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_qty_pp" class="form-group detailmintapembelian_qty_pp">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->qty_pp->EditValue ?>"<?php echo $detailmintapembelian_grid->qty_pp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_qty_pp" class="form-group detailmintapembelian_qty_pp">
<span<?php echo $detailmintapembelian_grid->qty_pp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->qty_pp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_pp" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_pp" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_pp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->qty_acc->Visible) { // qty_acc ?>
		<td data-name="qty_acc">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_qty_acc" class="form-group detailmintapembelian_qty_acc">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_acc" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->qty_acc->EditValue ?>"<?php echo $detailmintapembelian_grid->qty_acc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_qty_acc" class="form-group detailmintapembelian_qty_acc">
<span<?php echo $detailmintapembelian_grid->qty_acc->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->qty_acc->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_qty_acc" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_qty_acc" value="<?php echo HtmlEncode($detailmintapembelian_grid->qty_acc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_id_satuan" class="form-group detailmintapembelian_id_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_id_satuan" data-value-separator="<?php echo $detailmintapembelian_grid->id_satuan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan"<?php echo $detailmintapembelian_grid->id_satuan->editAttributes() ?>>
			<?php echo $detailmintapembelian_grid->id_satuan->selectOptionListHtml("x{$detailmintapembelian_grid->RowIndex}_id_satuan") ?>
		</select>
</div>
<?php echo $detailmintapembelian_grid->id_satuan->Lookup->getParamTag($detailmintapembelian_grid, "p_x" . $detailmintapembelian_grid->RowIndex . "_id_satuan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_id_satuan" class="form-group detailmintapembelian_id_satuan">
<span<?php echo $detailmintapembelian_grid->id_satuan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->id_satuan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_id_satuan" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailmintapembelian_grid->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->harga->Visible) { // harga ?>
		<td data-name="harga">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_harga" class="form-group detailmintapembelian_harga">
<input type="text" data-table="detailmintapembelian" data-field="x_harga" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->harga->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->harga->EditValue ?>"<?php echo $detailmintapembelian_grid->harga->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_harga" class="form-group detailmintapembelian_harga">
<span<?php echo $detailmintapembelian_grid->harga->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->harga->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_harga" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_harga" value="<?php echo HtmlEncode($detailmintapembelian_grid->harga->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailmintapembelian_grid->total->Visible) { // total ?>
		<td data-name="total">
<?php if (!$detailmintapembelian->isConfirm()) { ?>
<span id="el$rowindex$_detailmintapembelian_total" class="form-group detailmintapembelian_total">
<input type="text" data-table="detailmintapembelian" data-field="x_total" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_grid->total->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_grid->total->EditValue ?>"<?php echo $detailmintapembelian_grid->total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailmintapembelian_total" class="form-group detailmintapembelian_total">
<span<?php echo $detailmintapembelian_grid->total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_grid->total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="x<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailmintapembelian" data-field="x_total" name="o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" id="o<?php echo $detailmintapembelian_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($detailmintapembelian_grid->total->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailmintapembelian_grid->ListOptions->render("body", "right", $detailmintapembelian_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailmintapembeliangrid", "load"], function() {
	fdetailmintapembeliangrid.updateLists(<?php echo $detailmintapembelian_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailmintapembelian->CurrentMode == "add" || $detailmintapembelian->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailmintapembelian_grid->FormKeyCountName ?>" id="<?php echo $detailmintapembelian_grid->FormKeyCountName ?>" value="<?php echo $detailmintapembelian_grid->KeyCount ?>">
<?php echo $detailmintapembelian_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailmintapembelian->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailmintapembelian_grid->FormKeyCountName ?>" id="<?php echo $detailmintapembelian_grid->FormKeyCountName ?>" value="<?php echo $detailmintapembelian_grid->KeyCount ?>">
<?php echo $detailmintapembelian_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailmintapembelian->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailmintapembeliangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailmintapembelian_grid->Recordset)
	$detailmintapembelian_grid->Recordset->Close();
?>
<?php if ($detailmintapembelian_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailmintapembelian_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailmintapembelian_grid->TotalRecords == 0 && !$detailmintapembelian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailmintapembelian_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailmintapembelian_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailmintapembelian_grid->terminate();
?>