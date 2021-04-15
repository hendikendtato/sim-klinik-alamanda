<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($m_komisi_recall_detail_grid))
	$m_komisi_recall_detail_grid = new m_komisi_recall_detail_grid();

// Run the page
$m_komisi_recall_detail_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_recall_detail_grid->Page_Render();
?>
<?php if (!$m_komisi_recall_detail_grid->isExport()) { ?>
<script>
var fm_komisi_recall_detailgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fm_komisi_recall_detailgrid = new ew.Form("fm_komisi_recall_detailgrid", "grid");
	fm_komisi_recall_detailgrid.formKeyCountName = '<?php echo $m_komisi_recall_detail_grid->FormKeyCountName ?>';

	// Validate form
	fm_komisi_recall_detailgrid.validate = function() {
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
			<?php if ($m_komisi_recall_detail_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->id->caption(), $m_komisi_recall_detail_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_komisi_recall_detail_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->id_barang->caption(), $m_komisi_recall_detail_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->id_barang->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->recall_default_persen->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_default_persen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->recall_default_persen->caption(), $m_komisi_recall_detail_grid->recall_default_persen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_default_persen");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->recall_default_persen->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->recall_default_rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_default_rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->recall_default_rupiah->caption(), $m_komisi_recall_detail_grid->recall_default_rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_default_rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->recall_default_rupiah->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->recall_target_persen->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_target_persen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->recall_target_persen->caption(), $m_komisi_recall_detail_grid->recall_target_persen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_target_persen");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->recall_target_persen->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->recall_target_rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_target_rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->recall_target_rupiah->caption(), $m_komisi_recall_detail_grid->recall_target_rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_target_rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->recall_target_rupiah->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->tgl_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->tgl_mulai->caption(), $m_komisi_recall_detail_grid->tgl_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->tgl_mulai->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->tgl_akhir->caption(), $m_komisi_recall_detail_grid->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->tgl_akhir->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_grid->target->Required) { ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_grid->target->caption(), $m_komisi_recall_detail_grid->target->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_grid->target->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fm_komisi_recall_detailgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "recall_default_persen", false)) return false;
		if (ew.valueChanged(fobj, infix, "recall_default_rupiah", false)) return false;
		if (ew.valueChanged(fobj, infix, "recall_target_persen", false)) return false;
		if (ew.valueChanged(fobj, infix, "recall_target_rupiah", false)) return false;
		if (ew.valueChanged(fobj, infix, "tgl_mulai", false)) return false;
		if (ew.valueChanged(fobj, infix, "tgl_akhir", false)) return false;
		if (ew.valueChanged(fobj, infix, "target", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fm_komisi_recall_detailgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_komisi_recall_detailgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_komisi_recall_detailgrid.lists["x_id_barang"] = <?php echo $m_komisi_recall_detail_grid->id_barang->Lookup->toClientList($m_komisi_recall_detail_grid) ?>;
	fm_komisi_recall_detailgrid.lists["x_id_barang"].options = <?php echo JsonEncode($m_komisi_recall_detail_grid->id_barang->lookupOptions()) ?>;
	fm_komisi_recall_detailgrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fm_komisi_recall_detailgrid");
});
</script>
<?php } ?>
<?php
$m_komisi_recall_detail_grid->renderOtherOptions();
?>
<?php if ($m_komisi_recall_detail_grid->TotalRecords > 0 || $m_komisi_recall_detail->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_komisi_recall_detail_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_komisi_recall_detail">
<?php if ($m_komisi_recall_detail_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $m_komisi_recall_detail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fm_komisi_recall_detailgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_m_komisi_recall_detail" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_m_komisi_recall_detailgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_komisi_recall_detail->RowType = ROWTYPE_HEADER;

// Render list options
$m_komisi_recall_detail_grid->renderListOptions();

// Render list options (header, left)
$m_komisi_recall_detail_grid->ListOptions->render("header", "left");
?>
<?php if ($m_komisi_recall_detail_grid->id->Visible) { // id ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_komisi_recall_detail_grid->id->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_id" class="m_komisi_recall_detail_id"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_komisi_recall_detail_grid->id->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_id" class="m_komisi_recall_detail_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $m_komisi_recall_detail_grid->id_barang->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_id_barang" class="m_komisi_recall_detail_id_barang"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $m_komisi_recall_detail_grid->id_barang->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_id_barang" class="m_komisi_recall_detail_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->recall_default_persen->Visible) { // recall_default_persen ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->recall_default_persen) == "") { ?>
		<th data-name="recall_default_persen" class="<?php echo $m_komisi_recall_detail_grid->recall_default_persen->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_recall_default_persen" class="m_komisi_recall_detail_recall_default_persen"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_default_persen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recall_default_persen" class="<?php echo $m_komisi_recall_detail_grid->recall_default_persen->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_recall_default_persen" class="m_komisi_recall_detail_recall_default_persen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_default_persen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->recall_default_persen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->recall_default_persen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->recall_default_rupiah->Visible) { // recall_default_rupiah ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->recall_default_rupiah) == "") { ?>
		<th data-name="recall_default_rupiah" class="<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_recall_default_rupiah" class="m_komisi_recall_detail_recall_default_rupiah"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recall_default_rupiah" class="<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_recall_default_rupiah" class="m_komisi_recall_detail_recall_default_rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->recall_default_rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->recall_default_rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->recall_target_persen->Visible) { // recall_target_persen ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->recall_target_persen) == "") { ?>
		<th data-name="recall_target_persen" class="<?php echo $m_komisi_recall_detail_grid->recall_target_persen->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_recall_target_persen" class="m_komisi_recall_detail_recall_target_persen"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_target_persen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recall_target_persen" class="<?php echo $m_komisi_recall_detail_grid->recall_target_persen->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_recall_target_persen" class="m_komisi_recall_detail_recall_target_persen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_target_persen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->recall_target_persen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->recall_target_persen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->recall_target_rupiah->Visible) { // recall_target_rupiah ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->recall_target_rupiah) == "") { ?>
		<th data-name="recall_target_rupiah" class="<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_recall_target_rupiah" class="m_komisi_recall_detail_recall_target_rupiah"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="recall_target_rupiah" class="<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_recall_target_rupiah" class="m_komisi_recall_detail_recall_target_rupiah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->recall_target_rupiah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->recall_target_rupiah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->tgl_mulai->Visible) { // tgl_mulai ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->tgl_mulai) == "") { ?>
		<th data-name="tgl_mulai" class="<?php echo $m_komisi_recall_detail_grid->tgl_mulai->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_tgl_mulai" class="m_komisi_recall_detail_tgl_mulai"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->tgl_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_mulai" class="<?php echo $m_komisi_recall_detail_grid->tgl_mulai->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_tgl_mulai" class="m_komisi_recall_detail_tgl_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->tgl_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->tgl_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->tgl_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_komisi_recall_detail_grid->tgl_akhir->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_tgl_akhir" class="m_komisi_recall_detail_tgl_akhir"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $m_komisi_recall_detail_grid->tgl_akhir->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_tgl_akhir" class="m_komisi_recall_detail_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->target->Visible) { // target ?>
	<?php if ($m_komisi_recall_detail_grid->SortUrl($m_komisi_recall_detail_grid->target) == "") { ?>
		<th data-name="target" class="<?php echo $m_komisi_recall_detail_grid->target->headerCellClass() ?>"><div id="elh_m_komisi_recall_detail_target" class="m_komisi_recall_detail_target"><div class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->target->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target" class="<?php echo $m_komisi_recall_detail_grid->target->headerCellClass() ?>"><div><div id="elh_m_komisi_recall_detail_target" class="m_komisi_recall_detail_target">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_grid->target->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_grid->target->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_grid->target->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_komisi_recall_detail_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$m_komisi_recall_detail_grid->StartRecord = 1;
$m_komisi_recall_detail_grid->StopRecord = $m_komisi_recall_detail_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($m_komisi_recall_detail->isConfirm() || $m_komisi_recall_detail_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($m_komisi_recall_detail_grid->FormKeyCountName) && ($m_komisi_recall_detail_grid->isGridAdd() || $m_komisi_recall_detail_grid->isGridEdit() || $m_komisi_recall_detail->isConfirm())) {
		$m_komisi_recall_detail_grid->KeyCount = $CurrentForm->getValue($m_komisi_recall_detail_grid->FormKeyCountName);
		$m_komisi_recall_detail_grid->StopRecord = $m_komisi_recall_detail_grid->StartRecord + $m_komisi_recall_detail_grid->KeyCount - 1;
	}
}
$m_komisi_recall_detail_grid->RecordCount = $m_komisi_recall_detail_grid->StartRecord - 1;
if ($m_komisi_recall_detail_grid->Recordset && !$m_komisi_recall_detail_grid->Recordset->EOF) {
	$m_komisi_recall_detail_grid->Recordset->moveFirst();
	$selectLimit = $m_komisi_recall_detail_grid->UseSelectLimit;
	if (!$selectLimit && $m_komisi_recall_detail_grid->StartRecord > 1)
		$m_komisi_recall_detail_grid->Recordset->move($m_komisi_recall_detail_grid->StartRecord - 1);
} elseif (!$m_komisi_recall_detail->AllowAddDeleteRow && $m_komisi_recall_detail_grid->StopRecord == 0) {
	$m_komisi_recall_detail_grid->StopRecord = $m_komisi_recall_detail->GridAddRowCount;
}

// Initialize aggregate
$m_komisi_recall_detail->RowType = ROWTYPE_AGGREGATEINIT;
$m_komisi_recall_detail->resetAttributes();
$m_komisi_recall_detail_grid->renderRow();
if ($m_komisi_recall_detail_grid->isGridAdd())
	$m_komisi_recall_detail_grid->RowIndex = 0;
if ($m_komisi_recall_detail_grid->isGridEdit())
	$m_komisi_recall_detail_grid->RowIndex = 0;
while ($m_komisi_recall_detail_grid->RecordCount < $m_komisi_recall_detail_grid->StopRecord) {
	$m_komisi_recall_detail_grid->RecordCount++;
	if ($m_komisi_recall_detail_grid->RecordCount >= $m_komisi_recall_detail_grid->StartRecord) {
		$m_komisi_recall_detail_grid->RowCount++;
		if ($m_komisi_recall_detail_grid->isGridAdd() || $m_komisi_recall_detail_grid->isGridEdit() || $m_komisi_recall_detail->isConfirm()) {
			$m_komisi_recall_detail_grid->RowIndex++;
			$CurrentForm->Index = $m_komisi_recall_detail_grid->RowIndex;
			if ($CurrentForm->hasValue($m_komisi_recall_detail_grid->FormActionName) && ($m_komisi_recall_detail->isConfirm() || $m_komisi_recall_detail_grid->EventCancelled))
				$m_komisi_recall_detail_grid->RowAction = strval($CurrentForm->getValue($m_komisi_recall_detail_grid->FormActionName));
			elseif ($m_komisi_recall_detail_grid->isGridAdd())
				$m_komisi_recall_detail_grid->RowAction = "insert";
			else
				$m_komisi_recall_detail_grid->RowAction = "";
		}

		// Set up key count
		$m_komisi_recall_detail_grid->KeyCount = $m_komisi_recall_detail_grid->RowIndex;

		// Init row class and style
		$m_komisi_recall_detail->resetAttributes();
		$m_komisi_recall_detail->CssClass = "";
		if ($m_komisi_recall_detail_grid->isGridAdd()) {
			if ($m_komisi_recall_detail->CurrentMode == "copy") {
				$m_komisi_recall_detail_grid->loadRowValues($m_komisi_recall_detail_grid->Recordset); // Load row values
				$m_komisi_recall_detail_grid->setRecordKey($m_komisi_recall_detail_grid->RowOldKey, $m_komisi_recall_detail_grid->Recordset); // Set old record key
			} else {
				$m_komisi_recall_detail_grid->loadRowValues(); // Load default values
				$m_komisi_recall_detail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$m_komisi_recall_detail_grid->loadRowValues($m_komisi_recall_detail_grid->Recordset); // Load row values
		}
		$m_komisi_recall_detail->RowType = ROWTYPE_VIEW; // Render view
		if ($m_komisi_recall_detail_grid->isGridAdd()) // Grid add
			$m_komisi_recall_detail->RowType = ROWTYPE_ADD; // Render add
		if ($m_komisi_recall_detail_grid->isGridAdd() && $m_komisi_recall_detail->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$m_komisi_recall_detail_grid->restoreCurrentRowFormValues($m_komisi_recall_detail_grid->RowIndex); // Restore form values
		if ($m_komisi_recall_detail_grid->isGridEdit()) { // Grid edit
			if ($m_komisi_recall_detail->EventCancelled)
				$m_komisi_recall_detail_grid->restoreCurrentRowFormValues($m_komisi_recall_detail_grid->RowIndex); // Restore form values
			if ($m_komisi_recall_detail_grid->RowAction == "insert")
				$m_komisi_recall_detail->RowType = ROWTYPE_ADD; // Render add
			else
				$m_komisi_recall_detail->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($m_komisi_recall_detail_grid->isGridEdit() && ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT || $m_komisi_recall_detail->RowType == ROWTYPE_ADD) && $m_komisi_recall_detail->EventCancelled) // Update failed
			$m_komisi_recall_detail_grid->restoreCurrentRowFormValues($m_komisi_recall_detail_grid->RowIndex); // Restore form values
		if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) // Edit row
			$m_komisi_recall_detail_grid->EditRowCount++;
		if ($m_komisi_recall_detail->isConfirm()) // Confirm row
			$m_komisi_recall_detail_grid->restoreCurrentRowFormValues($m_komisi_recall_detail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$m_komisi_recall_detail->RowAttrs->merge(["data-rowindex" => $m_komisi_recall_detail_grid->RowCount, "id" => "r" . $m_komisi_recall_detail_grid->RowCount . "_m_komisi_recall_detail", "data-rowtype" => $m_komisi_recall_detail->RowType]);

		// Render row
		$m_komisi_recall_detail_grid->renderRow();

		// Render list options
		$m_komisi_recall_detail_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($m_komisi_recall_detail_grid->RowAction != "delete" && $m_komisi_recall_detail_grid->RowAction != "insertdelete" && !($m_komisi_recall_detail_grid->RowAction == "insert" && $m_komisi_recall_detail->isConfirm() && $m_komisi_recall_detail_grid->emptyRow())) {
?>
	<tr <?php echo $m_komisi_recall_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_komisi_recall_detail_grid->ListOptions->render("body", "left", $m_komisi_recall_detail_grid->RowCount);
?>
	<?php if ($m_komisi_recall_detail_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_komisi_recall_detail_grid->id->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_id" class="form-group"></span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_id" class="form-group">
<span<?php echo $m_komisi_recall_detail_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_id">
<span<?php echo $m_komisi_recall_detail_grid->id->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->id->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $m_komisi_recall_detail_grid->id_barang->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_id_barang" class="form-group">
<?php
$onchange = $m_komisi_recall_detail_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_komisi_recall_detail_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($m_komisi_recall_detail_grid->id_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->getPlaceHolder()) ?>"<?php echo $m_komisi_recall_detail_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_komisi_recall_detail_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($m_komisi_recall_detail_grid->id_barang->ReadOnly || $m_komisi_recall_detail_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_komisi_recall_detail_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid"], function() {
	fm_komisi_recall_detailgrid.createAutoSuggest({"id":"x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $m_komisi_recall_detail_grid->id_barang->Lookup->getParamTag($m_komisi_recall_detail_grid, "p_x" . $m_komisi_recall_detail_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_id_barang" class="form-group">
<?php
$onchange = $m_komisi_recall_detail_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_komisi_recall_detail_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($m_komisi_recall_detail_grid->id_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->getPlaceHolder()) ?>"<?php echo $m_komisi_recall_detail_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_komisi_recall_detail_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($m_komisi_recall_detail_grid->id_barang->ReadOnly || $m_komisi_recall_detail_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_komisi_recall_detail_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid"], function() {
	fm_komisi_recall_detailgrid.createAutoSuggest({"id":"x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $m_komisi_recall_detail_grid->id_barang->Lookup->getParamTag($m_komisi_recall_detail_grid, "p_x" . $m_komisi_recall_detail_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_id_barang">
<span<?php echo $m_komisi_recall_detail_grid->id_barang->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_default_persen->Visible) { // recall_default_persen ?>
		<td data-name="recall_default_persen" <?php echo $m_komisi_recall_detail_grid->recall_default_persen->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_default_persen" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_default_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_default_persen->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_default_persen" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_default_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_default_persen->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_default_persen">
<span<?php echo $m_komisi_recall_detail_grid->recall_default_persen->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->recall_default_persen->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_default_rupiah->Visible) { // recall_default_rupiah ?>
		<td data-name="recall_default_rupiah" <?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_default_rupiah" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_default_rupiah" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_default_rupiah">
<span<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_target_persen->Visible) { // recall_target_persen ?>
		<td data-name="recall_target_persen" <?php echo $m_komisi_recall_detail_grid->recall_target_persen->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_target_persen" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_target_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_target_persen->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_target_persen" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_target_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_target_persen->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_target_persen">
<span<?php echo $m_komisi_recall_detail_grid->recall_target_persen->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->recall_target_persen->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_target_rupiah->Visible) { // recall_target_rupiah ?>
		<td data-name="recall_target_rupiah" <?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_target_rupiah" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_target_rupiah" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_recall_target_rupiah">
<span<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->tgl_mulai->Visible) { // tgl_mulai ?>
		<td data-name="tgl_mulai" <?php echo $m_komisi_recall_detail_grid->tgl_mulai->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_tgl_mulai" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->tgl_mulai->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->tgl_mulai->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_grid->tgl_mulai->ReadOnly && !$m_komisi_recall_detail_grid->tgl_mulai->Disabled && !isset($m_komisi_recall_detail_grid->tgl_mulai->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_grid->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailgrid", "x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_tgl_mulai" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->tgl_mulai->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->tgl_mulai->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_grid->tgl_mulai->ReadOnly && !$m_komisi_recall_detail_grid->tgl_mulai->Disabled && !isset($m_komisi_recall_detail_grid->tgl_mulai->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_grid->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailgrid", "x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_tgl_mulai">
<span<?php echo $m_komisi_recall_detail_grid->tgl_mulai->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->tgl_mulai->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $m_komisi_recall_detail_grid->tgl_akhir->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_tgl_akhir" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->tgl_akhir->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->tgl_akhir->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_grid->tgl_akhir->ReadOnly && !$m_komisi_recall_detail_grid->tgl_akhir->Disabled && !isset($m_komisi_recall_detail_grid->tgl_akhir->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_grid->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailgrid", "x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_tgl_akhir" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->tgl_akhir->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->tgl_akhir->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_grid->tgl_akhir->ReadOnly && !$m_komisi_recall_detail_grid->tgl_akhir->Disabled && !isset($m_komisi_recall_detail_grid->tgl_akhir->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_grid->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailgrid", "x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_tgl_akhir">
<span<?php echo $m_komisi_recall_detail_grid->tgl_akhir->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->tgl_akhir->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->target->Visible) { // target ?>
		<td data-name="target" <?php echo $m_komisi_recall_detail_grid->target->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_target" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_target" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->target->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->target->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->OldValue) ?>">
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_target" class="form-group">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_target" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->target->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->target->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_komisi_recall_detail_grid->RowCount ?>_m_komisi_recall_detail_target">
<span<?php echo $m_komisi_recall_detail_grid->target->viewAttributes() ?>><?php echo $m_komisi_recall_detail_grid->target->getViewValue() ?></span>
</span>
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="fm_komisi_recall_detailgrid$x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->FormValue) ?>">
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="fm_komisi_recall_detailgrid$o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_komisi_recall_detail_grid->ListOptions->render("body", "right", $m_komisi_recall_detail_grid->RowCount);
?>
	</tr>
<?php if ($m_komisi_recall_detail->RowType == ROWTYPE_ADD || $m_komisi_recall_detail->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "load"], function() {
	fm_komisi_recall_detailgrid.updateLists(<?php echo $m_komisi_recall_detail_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$m_komisi_recall_detail_grid->isGridAdd() || $m_komisi_recall_detail->CurrentMode == "copy")
		if (!$m_komisi_recall_detail_grid->Recordset->EOF)
			$m_komisi_recall_detail_grid->Recordset->moveNext();
}
?>
<?php
	if ($m_komisi_recall_detail->CurrentMode == "add" || $m_komisi_recall_detail->CurrentMode == "copy" || $m_komisi_recall_detail->CurrentMode == "edit") {
		$m_komisi_recall_detail_grid->RowIndex = '$rowindex$';
		$m_komisi_recall_detail_grid->loadRowValues();

		// Set row properties
		$m_komisi_recall_detail->resetAttributes();
		$m_komisi_recall_detail->RowAttrs->merge(["data-rowindex" => $m_komisi_recall_detail_grid->RowIndex, "id" => "r0_m_komisi_recall_detail", "data-rowtype" => ROWTYPE_ADD]);
		$m_komisi_recall_detail->RowAttrs->appendClass("ew-template");
		$m_komisi_recall_detail->RowType = ROWTYPE_ADD;

		// Render row
		$m_komisi_recall_detail_grid->renderRow();

		// Render list options
		$m_komisi_recall_detail_grid->renderListOptions();
		$m_komisi_recall_detail_grid->StartRowCount = 0;
?>
	<tr <?php echo $m_komisi_recall_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_komisi_recall_detail_grid->ListOptions->render("body", "left", $m_komisi_recall_detail_grid->RowIndex);
?>
	<?php if ($m_komisi_recall_detail_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_id" class="form-group m_komisi_recall_detail_id"></span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_id" class="form-group m_komisi_recall_detail_id">
<span<?php echo $m_komisi_recall_detail_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_id_barang" class="form-group m_komisi_recall_detail_id_barang">
<?php
$onchange = $m_komisi_recall_detail_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_komisi_recall_detail_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($m_komisi_recall_detail_grid->id_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->getPlaceHolder()) ?>"<?php echo $m_komisi_recall_detail_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_komisi_recall_detail_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($m_komisi_recall_detail_grid->id_barang->ReadOnly || $m_komisi_recall_detail_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_komisi_recall_detail_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid"], function() {
	fm_komisi_recall_detailgrid.createAutoSuggest({"id":"x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $m_komisi_recall_detail_grid->id_barang->Lookup->getParamTag($m_komisi_recall_detail_grid, "p_x" . $m_komisi_recall_detail_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_id_barang" class="form-group m_komisi_recall_detail_id_barang">
<span<?php echo $m_komisi_recall_detail_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_default_persen->Visible) { // recall_default_persen ?>
		<td data-name="recall_default_persen">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_default_persen" class="form-group m_komisi_recall_detail_recall_default_persen">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_default_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_default_persen->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_default_persen" class="form-group m_komisi_recall_detail_recall_default_persen">
<span<?php echo $m_komisi_recall_detail_grid->recall_default_persen->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->recall_default_persen->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_persen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_default_rupiah->Visible) { // recall_default_rupiah ?>
		<td data-name="recall_default_rupiah">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_default_rupiah" class="form-group m_komisi_recall_detail_recall_default_rupiah">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_default_rupiah" class="form-group m_komisi_recall_detail_recall_default_rupiah">
<span<?php echo $m_komisi_recall_detail_grid->recall_default_rupiah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->recall_default_rupiah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_default_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_default_rupiah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_target_persen->Visible) { // recall_target_persen ?>
		<td data-name="recall_target_persen">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_target_persen" class="form-group m_komisi_recall_detail_recall_target_persen">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_target_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_target_persen->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_target_persen" class="form-group m_komisi_recall_detail_recall_target_persen">
<span<?php echo $m_komisi_recall_detail_grid->recall_target_persen->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->recall_target_persen->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_persen" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_persen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->recall_target_rupiah->Visible) { // recall_target_rupiah ?>
		<td data-name="recall_target_rupiah">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_target_rupiah" class="form-group m_komisi_recall_detail_recall_target_rupiah">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_recall_target_rupiah" class="form-group m_komisi_recall_detail_recall_target_rupiah">
<span<?php echo $m_komisi_recall_detail_grid->recall_target_rupiah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->recall_target_rupiah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_recall_target_rupiah" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->recall_target_rupiah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->tgl_mulai->Visible) { // tgl_mulai ?>
		<td data-name="tgl_mulai">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_tgl_mulai" class="form-group m_komisi_recall_detail_tgl_mulai">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->tgl_mulai->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->tgl_mulai->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_grid->tgl_mulai->ReadOnly && !$m_komisi_recall_detail_grid->tgl_mulai->Disabled && !isset($m_komisi_recall_detail_grid->tgl_mulai->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_grid->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailgrid", "x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_tgl_mulai" class="form-group m_komisi_recall_detail_tgl_mulai">
<span<?php echo $m_komisi_recall_detail_grid->tgl_mulai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->tgl_mulai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_mulai" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_mulai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_tgl_akhir" class="form-group m_komisi_recall_detail_tgl_akhir">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->tgl_akhir->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->tgl_akhir->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_grid->tgl_akhir->ReadOnly && !$m_komisi_recall_detail_grid->tgl_akhir->Disabled && !isset($m_komisi_recall_detail_grid->tgl_akhir->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_grid->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailgrid", "x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_tgl_akhir" class="form-group m_komisi_recall_detail_tgl_akhir">
<span<?php echo $m_komisi_recall_detail_grid->tgl_akhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->tgl_akhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_tgl_akhir" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->tgl_akhir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_komisi_recall_detail_grid->target->Visible) { // target ?>
		<td data-name="target">
<?php if (!$m_komisi_recall_detail->isConfirm()) { ?>
<span id="el$rowindex$_m_komisi_recall_detail_target" class="form-group m_komisi_recall_detail_target">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_target" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_grid->target->EditValue ?>"<?php echo $m_komisi_recall_detail_grid->target->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_m_komisi_recall_detail_target" class="form-group m_komisi_recall_detail_target">
<span<?php echo $m_komisi_recall_detail_grid->target->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_grid->target->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="x<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_target" name="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" id="o<?php echo $m_komisi_recall_detail_grid->RowIndex ?>_target" value="<?php echo HtmlEncode($m_komisi_recall_detail_grid->target->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_komisi_recall_detail_grid->ListOptions->render("body", "right", $m_komisi_recall_detail_grid->RowIndex);
?>
<script>
loadjs.ready(["fm_komisi_recall_detailgrid", "load"], function() {
	fm_komisi_recall_detailgrid.updateLists(<?php echo $m_komisi_recall_detail_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($m_komisi_recall_detail->CurrentMode == "add" || $m_komisi_recall_detail->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $m_komisi_recall_detail_grid->FormKeyCountName ?>" id="<?php echo $m_komisi_recall_detail_grid->FormKeyCountName ?>" value="<?php echo $m_komisi_recall_detail_grid->KeyCount ?>">
<?php echo $m_komisi_recall_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($m_komisi_recall_detail->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $m_komisi_recall_detail_grid->FormKeyCountName ?>" id="<?php echo $m_komisi_recall_detail_grid->FormKeyCountName ?>" value="<?php echo $m_komisi_recall_detail_grid->KeyCount ?>">
<?php echo $m_komisi_recall_detail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($m_komisi_recall_detail->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fm_komisi_recall_detailgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_komisi_recall_detail_grid->Recordset)
	$m_komisi_recall_detail_grid->Recordset->Close();
?>
<?php if ($m_komisi_recall_detail_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $m_komisi_recall_detail_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_komisi_recall_detail_grid->TotalRecords == 0 && !$m_komisi_recall_detail->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_komisi_recall_detail_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$m_komisi_recall_detail_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$m_komisi_recall_detail_grid->terminate();
?>