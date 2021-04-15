<?php
namespace PHPMaker2020\sim_klinik_alamanda;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($kartustok_grid))
	$kartustok_grid = new kartustok_grid();

// Run the page
$kartustok_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_grid->Page_Render();
?>
<?php if (!$kartustok_grid->isExport()) { ?>
<script>
var fkartustokgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fkartustokgrid = new ew.Form("fkartustokgrid", "grid");
	fkartustokgrid.formKeyCountName = '<?php echo $kartustok_grid->FormKeyCountName ?>';

	// Validate form
	fkartustokgrid.validate = function() {
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
			<?php if ($kartustok_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_barang->caption(), $kartustok_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->id_barang->errorMessage()) ?>");
			<?php if ($kartustok_grid->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_klinik->caption(), $kartustok_grid->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_grid->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->tanggal->caption(), $kartustok_grid->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->tanggal->errorMessage()) ?>");
			<?php if ($kartustok_grid->id_terimabarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_terimabarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_terimabarang->caption(), $kartustok_grid->id_terimabarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_grid->id_terimagudang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_terimagudang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_terimagudang->caption(), $kartustok_grid->id_terimagudang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_terimagudang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->id_terimagudang->errorMessage()) ?>");
			<?php if ($kartustok_grid->id_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_penjualan->caption(), $kartustok_grid->id_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_penjualan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->id_penjualan->errorMessage()) ?>");
			<?php if ($kartustok_grid->id_kirimbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_kirimbarang->caption(), $kartustok_grid->id_kirimbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_grid->id_retur->Required) { ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_retur->caption(), $kartustok_grid->id_retur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_grid->id_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->id_penyesuaian->caption(), $kartustok_grid->id_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->id_penyesuaian->errorMessage()) ?>");
			<?php if ($kartustok_grid->stok_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_stok_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->stok_awal->caption(), $kartustok_grid->stok_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok_awal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->stok_awal->errorMessage()) ?>");
			<?php if ($kartustok_grid->masuk->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->masuk->caption(), $kartustok_grid->masuk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->masuk->errorMessage()) ?>");
			<?php if ($kartustok_grid->masuk_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->masuk_penyesuaian->caption(), $kartustok_grid->masuk_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->masuk_penyesuaian->errorMessage()) ?>");
			<?php if ($kartustok_grid->keluar->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->keluar->caption(), $kartustok_grid->keluar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->keluar->errorMessage()) ?>");
			<?php if ($kartustok_grid->keluar_nonjual->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_nonjual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->keluar_nonjual->caption(), $kartustok_grid->keluar_nonjual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_nonjual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->keluar_nonjual->errorMessage()) ?>");
			<?php if ($kartustok_grid->keluar_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->keluar_penyesuaian->caption(), $kartustok_grid->keluar_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->keluar_penyesuaian->errorMessage()) ?>");
			<?php if ($kartustok_grid->keluar_kirim->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_kirim");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->keluar_kirim->caption(), $kartustok_grid->keluar_kirim->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_kirim");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->keluar_kirim->errorMessage()) ?>");
			<?php if ($kartustok_grid->retur->Required) { ?>
				elm = this.getElements("x" + infix + "_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->retur->caption(), $kartustok_grid->retur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_retur");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->retur->errorMessage()) ?>");
			<?php if ($kartustok_grid->stok_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_stok_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_grid->stok_akhir->caption(), $kartustok_grid->stok_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok_akhir");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_grid->stok_akhir->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fkartustokgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_klinik", false)) return false;
		if (ew.valueChanged(fobj, infix, "tanggal", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_terimabarang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_terimagudang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_penjualan", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_kirimbarang", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_retur", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_penyesuaian", false)) return false;
		if (ew.valueChanged(fobj, infix, "stok_awal", false)) return false;
		if (ew.valueChanged(fobj, infix, "masuk", false)) return false;
		if (ew.valueChanged(fobj, infix, "masuk_penyesuaian", false)) return false;
		if (ew.valueChanged(fobj, infix, "keluar", false)) return false;
		if (ew.valueChanged(fobj, infix, "keluar_nonjual", false)) return false;
		if (ew.valueChanged(fobj, infix, "keluar_penyesuaian", false)) return false;
		if (ew.valueChanged(fobj, infix, "keluar_kirim", false)) return false;
		if (ew.valueChanged(fobj, infix, "retur", false)) return false;
		if (ew.valueChanged(fobj, infix, "stok_akhir", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fkartustokgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkartustokgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkartustokgrid.lists["x_id_barang"] = <?php echo $kartustok_grid->id_barang->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_barang"].options = <?php echo JsonEncode($kartustok_grid->id_barang->lookupOptions()) ?>;
	fkartustokgrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustokgrid.lists["x_id_klinik"] = <?php echo $kartustok_grid->id_klinik->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_klinik"].options = <?php echo JsonEncode($kartustok_grid->id_klinik->lookupOptions()) ?>;
	fkartustokgrid.lists["x_id_terimabarang"] = <?php echo $kartustok_grid->id_terimabarang->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_terimabarang"].options = <?php echo JsonEncode($kartustok_grid->id_terimabarang->lookupOptions()) ?>;
	fkartustokgrid.lists["x_id_terimagudang"] = <?php echo $kartustok_grid->id_terimagudang->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_terimagudang"].options = <?php echo JsonEncode($kartustok_grid->id_terimagudang->lookupOptions()) ?>;
	fkartustokgrid.autoSuggests["x_id_terimagudang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustokgrid.lists["x_id_penjualan"] = <?php echo $kartustok_grid->id_penjualan->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_penjualan"].options = <?php echo JsonEncode($kartustok_grid->id_penjualan->lookupOptions()) ?>;
	fkartustokgrid.autoSuggests["x_id_penjualan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustokgrid.lists["x_id_kirimbarang"] = <?php echo $kartustok_grid->id_kirimbarang->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($kartustok_grid->id_kirimbarang->lookupOptions()) ?>;
	fkartustokgrid.lists["x_id_retur"] = <?php echo $kartustok_grid->id_retur->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_retur"].options = <?php echo JsonEncode($kartustok_grid->id_retur->lookupOptions()) ?>;
	fkartustokgrid.lists["x_id_penyesuaian"] = <?php echo $kartustok_grid->id_penyesuaian->Lookup->toClientList($kartustok_grid) ?>;
	fkartustokgrid.lists["x_id_penyesuaian"].options = <?php echo JsonEncode($kartustok_grid->id_penyesuaian->lookupOptions()) ?>;
	fkartustokgrid.autoSuggests["x_id_penyesuaian"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fkartustokgrid");
});
</script>
<?php } ?>
<?php
$kartustok_grid->renderOtherOptions();
?>
<?php if ($kartustok_grid->TotalRecords > 0 || $kartustok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($kartustok_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> kartustok">
<?php if ($kartustok_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $kartustok_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fkartustokgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_kartustok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_kartustokgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$kartustok->RowType = ROWTYPE_HEADER;

// Render list options
$kartustok_grid->renderListOptions();

// Render list options (header, left)
$kartustok_grid->ListOptions->render("header", "left");
?>
<?php if ($kartustok_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $kartustok_grid->id_barang->headerCellClass() ?>"><div id="elh_kartustok_id_barang" class="kartustok_id_barang"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $kartustok_grid->id_barang->headerCellClass() ?>"><div><div id="elh_kartustok_id_barang" class="kartustok_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_klinik->Visible) { // id_klinik ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $kartustok_grid->id_klinik->headerCellClass() ?>"><div id="elh_kartustok_id_klinik" class="kartustok_id_klinik"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $kartustok_grid->id_klinik->headerCellClass() ?>"><div><div id="elh_kartustok_id_klinik" class="kartustok_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->tanggal->Visible) { // tanggal ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $kartustok_grid->tanggal->headerCellClass() ?>"><div id="elh_kartustok_tanggal" class="kartustok_tanggal"><div class="ew-table-header-caption"><?php echo $kartustok_grid->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $kartustok_grid->tanggal->headerCellClass() ?>"><div><div id="elh_kartustok_tanggal" class="kartustok_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_terimabarang->Visible) { // id_terimabarang ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_terimabarang) == "") { ?>
		<th data-name="id_terimabarang" class="<?php echo $kartustok_grid->id_terimabarang->headerCellClass() ?>"><div id="elh_kartustok_id_terimabarang" class="kartustok_id_terimabarang"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_terimabarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_terimabarang" class="<?php echo $kartustok_grid->id_terimabarang->headerCellClass() ?>"><div><div id="elh_kartustok_id_terimabarang" class="kartustok_id_terimabarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_terimabarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_terimabarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_terimabarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_terimagudang->Visible) { // id_terimagudang ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_terimagudang) == "") { ?>
		<th data-name="id_terimagudang" class="<?php echo $kartustok_grid->id_terimagudang->headerCellClass() ?>"><div id="elh_kartustok_id_terimagudang" class="kartustok_id_terimagudang"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_terimagudang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_terimagudang" class="<?php echo $kartustok_grid->id_terimagudang->headerCellClass() ?>"><div><div id="elh_kartustok_id_terimagudang" class="kartustok_id_terimagudang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_terimagudang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_terimagudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_terimagudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_penjualan->Visible) { // id_penjualan ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_penjualan) == "") { ?>
		<th data-name="id_penjualan" class="<?php echo $kartustok_grid->id_penjualan->headerCellClass() ?>"><div id="elh_kartustok_id_penjualan" class="kartustok_id_penjualan"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penjualan" class="<?php echo $kartustok_grid->id_penjualan->headerCellClass() ?>"><div><div id="elh_kartustok_id_penjualan" class="kartustok_id_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_kirimbarang) == "") { ?>
		<th data-name="id_kirimbarang" class="<?php echo $kartustok_grid->id_kirimbarang->headerCellClass() ?>"><div id="elh_kartustok_id_kirimbarang" class="kartustok_id_kirimbarang"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_kirimbarang" class="<?php echo $kartustok_grid->id_kirimbarang->headerCellClass() ?>"><div><div id="elh_kartustok_id_kirimbarang" class="kartustok_id_kirimbarang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_retur->Visible) { // id_retur ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_retur) == "") { ?>
		<th data-name="id_retur" class="<?php echo $kartustok_grid->id_retur->headerCellClass() ?>"><div id="elh_kartustok_id_retur" class="kartustok_id_retur"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_retur" class="<?php echo $kartustok_grid->id_retur->headerCellClass() ?>"><div><div id="elh_kartustok_id_retur" class="kartustok_id_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->id_penyesuaian->Visible) { // id_penyesuaian ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->id_penyesuaian) == "") { ?>
		<th data-name="id_penyesuaian" class="<?php echo $kartustok_grid->id_penyesuaian->headerCellClass() ?>"><div id="elh_kartustok_id_penyesuaian" class="kartustok_id_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartustok_grid->id_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penyesuaian" class="<?php echo $kartustok_grid->id_penyesuaian->headerCellClass() ?>"><div><div id="elh_kartustok_id_penyesuaian" class="kartustok_id_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->id_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->id_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->id_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->stok_awal->Visible) { // stok_awal ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->stok_awal) == "") { ?>
		<th data-name="stok_awal" class="<?php echo $kartustok_grid->stok_awal->headerCellClass() ?>"><div id="elh_kartustok_stok_awal" class="kartustok_stok_awal"><div class="ew-table-header-caption"><?php echo $kartustok_grid->stok_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok_awal" class="<?php echo $kartustok_grid->stok_awal->headerCellClass() ?>"><div><div id="elh_kartustok_stok_awal" class="kartustok_stok_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->stok_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->stok_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->stok_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->masuk->Visible) { // masuk ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->masuk) == "") { ?>
		<th data-name="masuk" class="<?php echo $kartustok_grid->masuk->headerCellClass() ?>"><div id="elh_kartustok_masuk" class="kartustok_masuk"><div class="ew-table-header-caption"><?php echo $kartustok_grid->masuk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk" class="<?php echo $kartustok_grid->masuk->headerCellClass() ?>"><div><div id="elh_kartustok_masuk" class="kartustok_masuk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->masuk->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->masuk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->masuk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->masuk_penyesuaian) == "") { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $kartustok_grid->masuk_penyesuaian->headerCellClass() ?>"><div id="elh_kartustok_masuk_penyesuaian" class="kartustok_masuk_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartustok_grid->masuk_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk_penyesuaian" class="<?php echo $kartustok_grid->masuk_penyesuaian->headerCellClass() ?>"><div><div id="elh_kartustok_masuk_penyesuaian" class="kartustok_masuk_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->masuk_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->masuk_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->masuk_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->keluar->Visible) { // keluar ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->keluar) == "") { ?>
		<th data-name="keluar" class="<?php echo $kartustok_grid->keluar->headerCellClass() ?>"><div id="elh_kartustok_keluar" class="kartustok_keluar"><div class="ew-table-header-caption"><?php echo $kartustok_grid->keluar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar" class="<?php echo $kartustok_grid->keluar->headerCellClass() ?>"><div><div id="elh_kartustok_keluar" class="kartustok_keluar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->keluar->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->keluar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->keluar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->keluar_nonjual->Visible) { // keluar_nonjual ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->keluar_nonjual) == "") { ?>
		<th data-name="keluar_nonjual" class="<?php echo $kartustok_grid->keluar_nonjual->headerCellClass() ?>"><div id="elh_kartustok_keluar_nonjual" class="kartustok_keluar_nonjual"><div class="ew-table-header-caption"><?php echo $kartustok_grid->keluar_nonjual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_nonjual" class="<?php echo $kartustok_grid->keluar_nonjual->headerCellClass() ?>"><div><div id="elh_kartustok_keluar_nonjual" class="kartustok_keluar_nonjual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->keluar_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->keluar_nonjual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->keluar_nonjual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->keluar_penyesuaian) == "") { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $kartustok_grid->keluar_penyesuaian->headerCellClass() ?>"><div id="elh_kartustok_keluar_penyesuaian" class="kartustok_keluar_penyesuaian"><div class="ew-table-header-caption"><?php echo $kartustok_grid->keluar_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_penyesuaian" class="<?php echo $kartustok_grid->keluar_penyesuaian->headerCellClass() ?>"><div><div id="elh_kartustok_keluar_penyesuaian" class="kartustok_keluar_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->keluar_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->keluar_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->keluar_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->keluar_kirim->Visible) { // keluar_kirim ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->keluar_kirim) == "") { ?>
		<th data-name="keluar_kirim" class="<?php echo $kartustok_grid->keluar_kirim->headerCellClass() ?>"><div id="elh_kartustok_keluar_kirim" class="kartustok_keluar_kirim"><div class="ew-table-header-caption"><?php echo $kartustok_grid->keluar_kirim->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keluar_kirim" class="<?php echo $kartustok_grid->keluar_kirim->headerCellClass() ?>"><div><div id="elh_kartustok_keluar_kirim" class="kartustok_keluar_kirim">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->keluar_kirim->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->keluar_kirim->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->keluar_kirim->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->retur->Visible) { // retur ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->retur) == "") { ?>
		<th data-name="retur" class="<?php echo $kartustok_grid->retur->headerCellClass() ?>"><div id="elh_kartustok_retur" class="kartustok_retur"><div class="ew-table-header-caption"><?php echo $kartustok_grid->retur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="retur" class="<?php echo $kartustok_grid->retur->headerCellClass() ?>"><div><div id="elh_kartustok_retur" class="kartustok_retur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_grid->stok_akhir->Visible) { // stok_akhir ?>
	<?php if ($kartustok_grid->SortUrl($kartustok_grid->stok_akhir) == "") { ?>
		<th data-name="stok_akhir" class="<?php echo $kartustok_grid->stok_akhir->headerCellClass() ?>"><div id="elh_kartustok_stok_akhir" class="kartustok_stok_akhir"><div class="ew-table-header-caption"><?php echo $kartustok_grid->stok_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok_akhir" class="<?php echo $kartustok_grid->stok_akhir->headerCellClass() ?>"><div><div id="elh_kartustok_stok_akhir" class="kartustok_stok_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_grid->stok_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_grid->stok_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_grid->stok_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kartustok_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$kartustok_grid->StartRecord = 1;
$kartustok_grid->StopRecord = $kartustok_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($kartustok->isConfirm() || $kartustok_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($kartustok_grid->FormKeyCountName) && ($kartustok_grid->isGridAdd() || $kartustok_grid->isGridEdit() || $kartustok->isConfirm())) {
		$kartustok_grid->KeyCount = $CurrentForm->getValue($kartustok_grid->FormKeyCountName);
		$kartustok_grid->StopRecord = $kartustok_grid->StartRecord + $kartustok_grid->KeyCount - 1;
	}
}
$kartustok_grid->RecordCount = $kartustok_grid->StartRecord - 1;
if ($kartustok_grid->Recordset && !$kartustok_grid->Recordset->EOF) {
	$kartustok_grid->Recordset->moveFirst();
	$selectLimit = $kartustok_grid->UseSelectLimit;
	if (!$selectLimit && $kartustok_grid->StartRecord > 1)
		$kartustok_grid->Recordset->move($kartustok_grid->StartRecord - 1);
} elseif (!$kartustok->AllowAddDeleteRow && $kartustok_grid->StopRecord == 0) {
	$kartustok_grid->StopRecord = $kartustok->GridAddRowCount;
}

// Initialize aggregate
$kartustok->RowType = ROWTYPE_AGGREGATEINIT;
$kartustok->resetAttributes();
$kartustok_grid->renderRow();
if ($kartustok_grid->isGridAdd())
	$kartustok_grid->RowIndex = 0;
if ($kartustok_grid->isGridEdit())
	$kartustok_grid->RowIndex = 0;
while ($kartustok_grid->RecordCount < $kartustok_grid->StopRecord) {
	$kartustok_grid->RecordCount++;
	if ($kartustok_grid->RecordCount >= $kartustok_grid->StartRecord) {
		$kartustok_grid->RowCount++;
		if ($kartustok_grid->isGridAdd() || $kartustok_grid->isGridEdit() || $kartustok->isConfirm()) {
			$kartustok_grid->RowIndex++;
			$CurrentForm->Index = $kartustok_grid->RowIndex;
			if ($CurrentForm->hasValue($kartustok_grid->FormActionName) && ($kartustok->isConfirm() || $kartustok_grid->EventCancelled))
				$kartustok_grid->RowAction = strval($CurrentForm->getValue($kartustok_grid->FormActionName));
			elseif ($kartustok_grid->isGridAdd())
				$kartustok_grid->RowAction = "insert";
			else
				$kartustok_grid->RowAction = "";
		}

		// Set up key count
		$kartustok_grid->KeyCount = $kartustok_grid->RowIndex;

		// Init row class and style
		$kartustok->resetAttributes();
		$kartustok->CssClass = "";
		if ($kartustok_grid->isGridAdd()) {
			if ($kartustok->CurrentMode == "copy") {
				$kartustok_grid->loadRowValues($kartustok_grid->Recordset); // Load row values
				$kartustok_grid->setRecordKey($kartustok_grid->RowOldKey, $kartustok_grid->Recordset); // Set old record key
			} else {
				$kartustok_grid->loadRowValues(); // Load default values
				$kartustok_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$kartustok_grid->loadRowValues($kartustok_grid->Recordset); // Load row values
		}
		$kartustok->RowType = ROWTYPE_VIEW; // Render view
		if ($kartustok_grid->isGridAdd()) // Grid add
			$kartustok->RowType = ROWTYPE_ADD; // Render add
		if ($kartustok_grid->isGridAdd() && $kartustok->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$kartustok_grid->restoreCurrentRowFormValues($kartustok_grid->RowIndex); // Restore form values
		if ($kartustok_grid->isGridEdit()) { // Grid edit
			if ($kartustok->EventCancelled)
				$kartustok_grid->restoreCurrentRowFormValues($kartustok_grid->RowIndex); // Restore form values
			if ($kartustok_grid->RowAction == "insert")
				$kartustok->RowType = ROWTYPE_ADD; // Render add
			else
				$kartustok->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($kartustok_grid->isGridEdit() && ($kartustok->RowType == ROWTYPE_EDIT || $kartustok->RowType == ROWTYPE_ADD) && $kartustok->EventCancelled) // Update failed
			$kartustok_grid->restoreCurrentRowFormValues($kartustok_grid->RowIndex); // Restore form values
		if ($kartustok->RowType == ROWTYPE_EDIT) // Edit row
			$kartustok_grid->EditRowCount++;
		if ($kartustok->isConfirm()) // Confirm row
			$kartustok_grid->restoreCurrentRowFormValues($kartustok_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$kartustok->RowAttrs->merge(["data-rowindex" => $kartustok_grid->RowCount, "id" => "r" . $kartustok_grid->RowCount . "_kartustok", "data-rowtype" => $kartustok->RowType]);

		// Render row
		$kartustok_grid->renderRow();

		// Render list options
		$kartustok_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($kartustok_grid->RowAction != "delete" && $kartustok_grid->RowAction != "insertdelete" && !($kartustok_grid->RowAction == "insert" && $kartustok->isConfirm() && $kartustok_grid->emptyRow())) {
?>
	<tr <?php echo $kartustok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kartustok_grid->ListOptions->render("body", "left", $kartustok_grid->RowCount);
?>
	<?php if ($kartustok_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $kartustok_grid->id_barang->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($kartustok_grid->id_barang->getSessionValue() != "") { ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_barang" class="form-group">
<span<?php echo $kartustok_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_barang" class="form-group">
<?php
$onchange = $kartustok_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($kartustok_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($kartustok_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_barang->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kartustok_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $kartustok_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($kartustok_grid->id_barang->ReadOnly || $kartustok_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kartustok_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $kartustok_grid->id_barang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($kartustok_grid->id_barang->getSessionValue() != "") { ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_barang" class="form-group">
<span<?php echo $kartustok_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_barang" class="form-group">
<?php
$onchange = $kartustok_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($kartustok_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($kartustok_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_barang->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kartustok_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $kartustok_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($kartustok_grid->id_barang->ReadOnly || $kartustok_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kartustok_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $kartustok_grid->id_barang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_barang">
<span<?php echo $kartustok_grid->id_barang->viewAttributes() ?>><?php echo $kartustok_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="kartustok" data-field="x_id_kartustok" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kartustok" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kartustok" value="<?php echo HtmlEncode($kartustok_grid->id_kartustok->CurrentValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_kartustok" name="o<?php echo $kartustok_grid->RowIndex ?>_id_kartustok" id="o<?php echo $kartustok_grid->RowIndex ?>_id_kartustok" value="<?php echo HtmlEncode($kartustok_grid->id_kartustok->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT || $kartustok->CurrentMode == "edit") { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_kartustok" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kartustok" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kartustok" value="<?php echo HtmlEncode($kartustok_grid->id_kartustok->CurrentValue) ?>">
<?php } ?>
	<?php if ($kartustok_grid->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $kartustok_grid->id_klinik->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_klinik" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_klinik" data-value-separator="<?php echo $kartustok_grid->id_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" name="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik"<?php echo $kartustok_grid->id_klinik->editAttributes() ?>>
			<?php echo $kartustok_grid->id_klinik->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_klinik") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_klinik->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_klinik") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_klinik" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_klinik" data-value-separator="<?php echo $kartustok_grid->id_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" name="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik"<?php echo $kartustok_grid->id_klinik->editAttributes() ?>>
			<?php echo $kartustok_grid->id_klinik->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_klinik") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_klinik->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_klinik") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_klinik">
<span<?php echo $kartustok_grid->id_klinik->viewAttributes() ?>><?php echo $kartustok_grid->id_klinik->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $kartustok_grid->tanggal->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_tanggal" class="form-group">
<input type="text" data-table="kartustok" data-field="x_tanggal" name="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kartustok_grid->tanggal->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->tanggal->EditValue ?>"<?php echo $kartustok_grid->tanggal->editAttributes() ?>>
<?php if (!$kartustok_grid->tanggal->ReadOnly && !$kartustok_grid->tanggal->Disabled && !isset($kartustok_grid->tanggal->EditAttrs["readonly"]) && !isset($kartustok_grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartustokgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartustokgrid", "x<?php echo $kartustok_grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="o<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="o<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_tanggal" class="form-group">
<input type="text" data-table="kartustok" data-field="x_tanggal" name="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kartustok_grid->tanggal->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->tanggal->EditValue ?>"<?php echo $kartustok_grid->tanggal->editAttributes() ?>>
<?php if (!$kartustok_grid->tanggal->ReadOnly && !$kartustok_grid->tanggal->Disabled && !isset($kartustok_grid->tanggal->EditAttrs["readonly"]) && !isset($kartustok_grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartustokgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartustokgrid", "x<?php echo $kartustok_grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_tanggal">
<span<?php echo $kartustok_grid->tanggal->viewAttributes() ?>><?php echo $kartustok_grid->tanggal->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="o<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="o<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_terimabarang->Visible) { // id_terimabarang ?>
		<td data-name="id_terimabarang" <?php echo $kartustok_grid->id_terimabarang->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_terimabarang" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_terimabarang" data-value-separator="<?php echo $kartustok_grid->id_terimabarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang"<?php echo $kartustok_grid->id_terimabarang->editAttributes() ?>>
			<?php echo $kartustok_grid->id_terimabarang->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_terimabarang") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_terimabarang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_terimabarang") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_terimabarang" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_terimabarang" data-value-separator="<?php echo $kartustok_grid->id_terimabarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang"<?php echo $kartustok_grid->id_terimabarang->editAttributes() ?>>
			<?php echo $kartustok_grid->id_terimabarang->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_terimabarang") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_terimabarang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_terimabarang") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_terimabarang">
<span<?php echo $kartustok_grid->id_terimabarang->viewAttributes() ?>><?php echo $kartustok_grid->id_terimabarang->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_terimagudang->Visible) { // id_terimagudang ?>
		<td data-name="id_terimagudang" <?php echo $kartustok_grid->id_terimagudang->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_terimagudang" class="form-group">
<?php
$onchange = $kartustok_grid->id_terimagudang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_terimagudang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo RemoveHtml($kartustok_grid->id_terimagudang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_terimagudang->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" data-value-separator="<?php echo $kartustok_grid->id_terimagudang->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_terimagudang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_terimagudang") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_terimagudang" class="form-group">
<?php
$onchange = $kartustok_grid->id_terimagudang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_terimagudang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo RemoveHtml($kartustok_grid->id_terimagudang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_terimagudang->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" data-value-separator="<?php echo $kartustok_grid->id_terimagudang->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_terimagudang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_terimagudang") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_terimagudang">
<span<?php echo $kartustok_grid->id_terimagudang->viewAttributes() ?>><?php echo $kartustok_grid->id_terimagudang->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_penjualan->Visible) { // id_penjualan ?>
		<td data-name="id_penjualan" <?php echo $kartustok_grid->id_penjualan->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_penjualan" class="form-group">
<?php
$onchange = $kartustok_grid->id_penjualan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_penjualan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo RemoveHtml($kartustok_grid->id_penjualan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_penjualan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_penjualan->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_penjualan->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" data-value-separator="<?php echo $kartustok_grid->id_penjualan->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_penjualan->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_penjualan") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_penjualan" class="form-group">
<?php
$onchange = $kartustok_grid->id_penjualan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_penjualan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo RemoveHtml($kartustok_grid->id_penjualan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_penjualan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_penjualan->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_penjualan->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" data-value-separator="<?php echo $kartustok_grid->id_penjualan->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_penjualan->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_penjualan") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_penjualan">
<span<?php echo $kartustok_grid->id_penjualan->viewAttributes() ?>><?php echo $kartustok_grid->id_penjualan->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang" <?php echo $kartustok_grid->id_kirimbarang->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_kirimbarang" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_kirimbarang" data-value-separator="<?php echo $kartustok_grid->id_kirimbarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang"<?php echo $kartustok_grid->id_kirimbarang->editAttributes() ?>>
			<?php echo $kartustok_grid->id_kirimbarang->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_kirimbarang") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_kirimbarang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_kirimbarang") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_kirimbarang" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_kirimbarang" data-value-separator="<?php echo $kartustok_grid->id_kirimbarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang"<?php echo $kartustok_grid->id_kirimbarang->editAttributes() ?>>
			<?php echo $kartustok_grid->id_kirimbarang->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_kirimbarang") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_kirimbarang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_kirimbarang") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_kirimbarang">
<span<?php echo $kartustok_grid->id_kirimbarang->viewAttributes() ?>><?php echo $kartustok_grid->id_kirimbarang->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur" <?php echo $kartustok_grid->id_retur->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_retur" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_retur" data-value-separator="<?php echo $kartustok_grid->id_retur->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_id_retur"<?php echo $kartustok_grid->id_retur->editAttributes() ?>>
			<?php echo $kartustok_grid->id_retur->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_retur") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_retur->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_retur") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="o<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="o<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_retur" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_retur" data-value-separator="<?php echo $kartustok_grid->id_retur->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_id_retur"<?php echo $kartustok_grid->id_retur->editAttributes() ?>>
			<?php echo $kartustok_grid->id_retur->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_retur") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_retur->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_retur") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_retur">
<span<?php echo $kartustok_grid->id_retur->viewAttributes() ?>><?php echo $kartustok_grid->id_retur->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="o<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="o<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_penyesuaian->Visible) { // id_penyesuaian ?>
		<td data-name="id_penyesuaian" <?php echo $kartustok_grid->id_penyesuaian->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_penyesuaian" class="form-group">
<?php
$onchange = $kartustok_grid->id_penyesuaian->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_penyesuaian->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo RemoveHtml($kartustok_grid->id_penyesuaian->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" data-value-separator="<?php echo $kartustok_grid->id_penyesuaian->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_penyesuaian->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_penyesuaian") ?>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_penyesuaian" class="form-group">
<?php
$onchange = $kartustok_grid->id_penyesuaian->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_penyesuaian->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo RemoveHtml($kartustok_grid->id_penyesuaian->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" data-value-separator="<?php echo $kartustok_grid->id_penyesuaian->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_penyesuaian->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_penyesuaian") ?>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_id_penyesuaian">
<span<?php echo $kartustok_grid->id_penyesuaian->viewAttributes() ?>><?php echo $kartustok_grid->id_penyesuaian->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->stok_awal->Visible) { // stok_awal ?>
		<td data-name="stok_awal" <?php echo $kartustok_grid->stok_awal->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_stok_awal" class="form-group">
<input type="text" data-table="kartustok" data-field="x_stok_awal" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->stok_awal->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->stok_awal->EditValue ?>"<?php echo $kartustok_grid->stok_awal->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_stok_awal" class="form-group">
<input type="text" data-table="kartustok" data-field="x_stok_awal" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->stok_awal->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->stok_awal->EditValue ?>"<?php echo $kartustok_grid->stok_awal->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_stok_awal">
<span<?php echo $kartustok_grid->stok_awal->viewAttributes() ?>><?php echo $kartustok_grid->stok_awal->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->masuk->Visible) { // masuk ?>
		<td data-name="masuk" <?php echo $kartustok_grid->masuk->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_masuk" class="form-group">
<input type="text" data-table="kartustok" data-field="x_masuk" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->masuk->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->masuk->EditValue ?>"<?php echo $kartustok_grid->masuk->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="o<?php echo $kartustok_grid->RowIndex ?>_masuk" id="o<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_masuk" class="form-group">
<input type="text" data-table="kartustok" data-field="x_masuk" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->masuk->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->masuk->EditValue ?>"<?php echo $kartustok_grid->masuk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_masuk">
<span<?php echo $kartustok_grid->masuk->viewAttributes() ?>><?php echo $kartustok_grid->masuk->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="o<?php echo $kartustok_grid->RowIndex ?>_masuk" id="o<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_masuk" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_masuk" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td data-name="masuk_penyesuaian" <?php echo $kartustok_grid->masuk_penyesuaian->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_masuk_penyesuaian" class="form-group">
<input type="text" data-table="kartustok" data-field="x_masuk_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->masuk_penyesuaian->EditValue ?>"<?php echo $kartustok_grid->masuk_penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_masuk_penyesuaian" class="form-group">
<input type="text" data-table="kartustok" data-field="x_masuk_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->masuk_penyesuaian->EditValue ?>"<?php echo $kartustok_grid->masuk_penyesuaian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_masuk_penyesuaian">
<span<?php echo $kartustok_grid->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartustok_grid->masuk_penyesuaian->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar->Visible) { // keluar ?>
		<td data-name="keluar" <?php echo $kartustok_grid->keluar->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar->EditValue ?>"<?php echo $kartustok_grid->keluar->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar->EditValue ?>"<?php echo $kartustok_grid->keluar->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar">
<span<?php echo $kartustok_grid->keluar->viewAttributes() ?>><?php echo $kartustok_grid->keluar->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar_nonjual->Visible) { // keluar_nonjual ?>
		<td data-name="keluar_nonjual" <?php echo $kartustok_grid->keluar_nonjual->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_nonjual" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar_nonjual" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_nonjual->EditValue ?>"<?php echo $kartustok_grid->keluar_nonjual->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_nonjual" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar_nonjual" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_nonjual->EditValue ?>"<?php echo $kartustok_grid->keluar_nonjual->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_nonjual">
<span<?php echo $kartustok_grid->keluar_nonjual->viewAttributes() ?>><?php echo $kartustok_grid->keluar_nonjual->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td data-name="keluar_penyesuaian" <?php echo $kartustok_grid->keluar_penyesuaian->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_penyesuaian" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_penyesuaian->EditValue ?>"<?php echo $kartustok_grid->keluar_penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_penyesuaian" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_penyesuaian->EditValue ?>"<?php echo $kartustok_grid->keluar_penyesuaian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_penyesuaian">
<span<?php echo $kartustok_grid->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartustok_grid->keluar_penyesuaian->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar_kirim->Visible) { // keluar_kirim ?>
		<td data-name="keluar_kirim" <?php echo $kartustok_grid->keluar_kirim->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_kirim" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar_kirim" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_kirim->EditValue ?>"<?php echo $kartustok_grid->keluar_kirim->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_kirim" class="form-group">
<input type="text" data-table="kartustok" data-field="x_keluar_kirim" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_kirim->EditValue ?>"<?php echo $kartustok_grid->keluar_kirim->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_keluar_kirim">
<span<?php echo $kartustok_grid->keluar_kirim->viewAttributes() ?>><?php echo $kartustok_grid->keluar_kirim->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->retur->Visible) { // retur ?>
		<td data-name="retur" <?php echo $kartustok_grid->retur->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_retur" class="form-group">
<input type="text" data-table="kartustok" data-field="x_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_retur" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->retur->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->retur->EditValue ?>"<?php echo $kartustok_grid->retur->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_retur" name="o<?php echo $kartustok_grid->RowIndex ?>_retur" id="o<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_retur" class="form-group">
<input type="text" data-table="kartustok" data-field="x_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_retur" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->retur->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->retur->EditValue ?>"<?php echo $kartustok_grid->retur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_retur">
<span<?php echo $kartustok_grid->retur->viewAttributes() ?>><?php echo $kartustok_grid->retur->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_retur" name="o<?php echo $kartustok_grid->RowIndex ?>_retur" id="o<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_retur" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_retur" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_retur" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_retur" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($kartustok_grid->stok_akhir->Visible) { // stok_akhir ?>
		<td data-name="stok_akhir" <?php echo $kartustok_grid->stok_akhir->cellAttributes() ?>>
<?php if ($kartustok->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_stok_akhir" class="form-group">
<input type="text" data-table="kartustok" data-field="x_stok_akhir" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->stok_akhir->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->stok_akhir->EditValue ?>"<?php echo $kartustok_grid->stok_akhir->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->OldValue) ?>">
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_stok_akhir" class="form-group">
<input type="text" data-table="kartustok" data-field="x_stok_akhir" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->stok_akhir->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->stok_akhir->EditValue ?>"<?php echo $kartustok_grid->stok_akhir->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($kartustok->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $kartustok_grid->RowCount ?>_kartustok_stok_akhir">
<span<?php echo $kartustok_grid->stok_akhir->viewAttributes() ?>><?php echo $kartustok_grid->stok_akhir->getViewValue() ?></span>
</span>
<?php if (!$kartustok->isConfirm()) { ?>
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="fkartustokgrid$x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->FormValue) ?>">
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="fkartustokgrid$o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kartustok_grid->ListOptions->render("body", "right", $kartustok_grid->RowCount);
?>
	</tr>
<?php if ($kartustok->RowType == ROWTYPE_ADD || $kartustok->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fkartustokgrid", "load"], function() {
	fkartustokgrid.updateLists(<?php echo $kartustok_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$kartustok_grid->isGridAdd() || $kartustok->CurrentMode == "copy")
		if (!$kartustok_grid->Recordset->EOF)
			$kartustok_grid->Recordset->moveNext();
}
?>
<?php
	if ($kartustok->CurrentMode == "add" || $kartustok->CurrentMode == "copy" || $kartustok->CurrentMode == "edit") {
		$kartustok_grid->RowIndex = '$rowindex$';
		$kartustok_grid->loadRowValues();

		// Set row properties
		$kartustok->resetAttributes();
		$kartustok->RowAttrs->merge(["data-rowindex" => $kartustok_grid->RowIndex, "id" => "r0_kartustok", "data-rowtype" => ROWTYPE_ADD]);
		$kartustok->RowAttrs->appendClass("ew-template");
		$kartustok->RowType = ROWTYPE_ADD;

		// Render row
		$kartustok_grid->renderRow();

		// Render list options
		$kartustok_grid->renderListOptions();
		$kartustok_grid->StartRowCount = 0;
?>
	<tr <?php echo $kartustok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kartustok_grid->ListOptions->render("body", "left", $kartustok_grid->RowIndex);
?>
	<?php if ($kartustok_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$kartustok->isConfirm()) { ?>
<?php if ($kartustok_grid->id_barang->getSessionValue() != "") { ?>
<span id="el$rowindex$_kartustok_id_barang" class="form-group kartustok_id_barang">
<span<?php echo $kartustok_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_barang" class="form-group kartustok_id_barang">
<?php
$onchange = $kartustok_grid->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($kartustok_grid->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($kartustok_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_barang->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kartustok_grid->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $kartustok_grid->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($kartustok_grid->id_barang->ReadOnly || $kartustok_grid->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kartustok_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $kartustok_grid->id_barang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_barang" class="form-group kartustok_id_barang">
<span<?php echo $kartustok_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_barang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($kartustok_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_klinik" class="form-group kartustok_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_klinik" data-value-separator="<?php echo $kartustok_grid->id_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" name="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik"<?php echo $kartustok_grid->id_klinik->editAttributes() ?>>
			<?php echo $kartustok_grid->id_klinik->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_klinik") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_klinik->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_klinik") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_klinik" class="form-group kartustok_id_klinik">
<span<?php echo $kartustok_grid->id_klinik->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_klinik->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="x<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_klinik" name="o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" id="o<?php echo $kartustok_grid->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($kartustok_grid->id_klinik->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_tanggal" class="form-group kartustok_tanggal">
<input type="text" data-table="kartustok" data-field="x_tanggal" name="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kartustok_grid->tanggal->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->tanggal->EditValue ?>"<?php echo $kartustok_grid->tanggal->editAttributes() ?>>
<?php if (!$kartustok_grid->tanggal->ReadOnly && !$kartustok_grid->tanggal->Disabled && !isset($kartustok_grid->tanggal->EditAttrs["readonly"]) && !isset($kartustok_grid->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartustokgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartustokgrid", "x<?php echo $kartustok_grid->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_tanggal" class="form-group kartustok_tanggal">
<span<?php echo $kartustok_grid->tanggal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->tanggal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="x<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_tanggal" name="o<?php echo $kartustok_grid->RowIndex ?>_tanggal" id="o<?php echo $kartustok_grid->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($kartustok_grid->tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_terimabarang->Visible) { // id_terimabarang ?>
		<td data-name="id_terimabarang">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_terimabarang" class="form-group kartustok_id_terimabarang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_terimabarang" data-value-separator="<?php echo $kartustok_grid->id_terimabarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang"<?php echo $kartustok_grid->id_terimabarang->editAttributes() ?>>
			<?php echo $kartustok_grid->id_terimabarang->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_terimabarang") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_terimabarang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_terimabarang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_terimabarang" class="form-group kartustok_id_terimabarang">
<span<?php echo $kartustok_grid->id_terimabarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_terimabarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_terimabarang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_terimabarang" value="<?php echo HtmlEncode($kartustok_grid->id_terimabarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_terimagudang->Visible) { // id_terimagudang ?>
		<td data-name="id_terimagudang">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_terimagudang" class="form-group kartustok_id_terimagudang">
<?php
$onchange = $kartustok_grid->id_terimagudang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_terimagudang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo RemoveHtml($kartustok_grid->id_terimagudang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_terimagudang->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" data-value-separator="<?php echo $kartustok_grid->id_terimagudang->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_terimagudang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_terimagudang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_terimagudang" class="form-group kartustok_id_terimagudang">
<span<?php echo $kartustok_grid->id_terimagudang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_terimagudang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_terimagudang" value="<?php echo HtmlEncode($kartustok_grid->id_terimagudang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_penjualan->Visible) { // id_penjualan ?>
		<td data-name="id_penjualan">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_penjualan" class="form-group kartustok_id_penjualan">
<?php
$onchange = $kartustok_grid->id_penjualan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_penjualan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo RemoveHtml($kartustok_grid->id_penjualan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_penjualan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_penjualan->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_penjualan->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" data-value-separator="<?php echo $kartustok_grid->id_penjualan->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_penjualan->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_penjualan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_penjualan" class="form-group kartustok_id_penjualan">
<span<?php echo $kartustok_grid->id_penjualan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_penjualan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" name="o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" id="o<?php echo $kartustok_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($kartustok_grid->id_penjualan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<td data-name="id_kirimbarang">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_kirimbarang" class="form-group kartustok_id_kirimbarang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_kirimbarang" data-value-separator="<?php echo $kartustok_grid->id_kirimbarang->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang"<?php echo $kartustok_grid->id_kirimbarang->editAttributes() ?>>
			<?php echo $kartustok_grid->id_kirimbarang->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_kirimbarang") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_kirimbarang->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_kirimbarang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_kirimbarang" class="form-group kartustok_id_kirimbarang">
<span<?php echo $kartustok_grid->id_kirimbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_kirimbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="x<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_kirimbarang" name="o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" id="o<?php echo $kartustok_grid->RowIndex ?>_id_kirimbarang" value="<?php echo HtmlEncode($kartustok_grid->id_kirimbarang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_retur->Visible) { // id_retur ?>
		<td data-name="id_retur">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_retur" class="form-group kartustok_id_retur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_retur" data-value-separator="<?php echo $kartustok_grid->id_retur->displayValueSeparatorAttribute() ?>" id="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_id_retur"<?php echo $kartustok_grid->id_retur->editAttributes() ?>>
			<?php echo $kartustok_grid->id_retur->selectOptionListHtml("x{$kartustok_grid->RowIndex}_id_retur") ?>
		</select>
</div>
<?php echo $kartustok_grid->id_retur->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_retur") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_retur" class="form-group kartustok_id_retur">
<span<?php echo $kartustok_grid->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_retur" name="o<?php echo $kartustok_grid->RowIndex ?>_id_retur" id="o<?php echo $kartustok_grid->RowIndex ?>_id_retur" value="<?php echo HtmlEncode($kartustok_grid->id_retur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->id_penyesuaian->Visible) { // id_penyesuaian ?>
		<td data-name="id_penyesuaian">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_id_penyesuaian" class="form-group kartustok_id_penyesuaian">
<?php
$onchange = $kartustok_grid->id_penyesuaian->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_grid->id_penyesuaian->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian">
	<input type="text" class="form-control" name="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="sv_x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo RemoveHtml($kartustok_grid->id_penyesuaian->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->getPlaceHolder()) ?>"<?php echo $kartustok_grid->id_penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" data-value-separator="<?php echo $kartustok_grid->id_penyesuaian->displayValueSeparatorAttribute() ?>" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokgrid"], function() {
	fkartustokgrid.createAutoSuggest({"id":"x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian","forceSelect":false});
});
</script>
<?php echo $kartustok_grid->id_penyesuaian->Lookup->getParamTag($kartustok_grid, "p_x" . $kartustok_grid->RowIndex . "_id_penyesuaian") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_id_penyesuaian" class="form-group kartustok_id_penyesuaian">
<span<?php echo $kartustok_grid->id_penyesuaian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->id_penyesuaian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->id_penyesuaian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->stok_awal->Visible) { // stok_awal ?>
		<td data-name="stok_awal">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_stok_awal" class="form-group kartustok_stok_awal">
<input type="text" data-table="kartustok" data-field="x_stok_awal" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->stok_awal->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->stok_awal->EditValue ?>"<?php echo $kartustok_grid->stok_awal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_stok_awal" class="form-group kartustok_stok_awal">
<span<?php echo $kartustok_grid->stok_awal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->stok_awal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_stok_awal" name="o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" id="o<?php echo $kartustok_grid->RowIndex ?>_stok_awal" value="<?php echo HtmlEncode($kartustok_grid->stok_awal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->masuk->Visible) { // masuk ?>
		<td data-name="masuk">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_masuk" class="form-group kartustok_masuk">
<input type="text" data-table="kartustok" data-field="x_masuk" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->masuk->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->masuk->EditValue ?>"<?php echo $kartustok_grid->masuk->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_masuk" class="form-group kartustok_masuk">
<span<?php echo $kartustok_grid->masuk->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->masuk->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_masuk" name="o<?php echo $kartustok_grid->RowIndex ?>_masuk" id="o<?php echo $kartustok_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($kartustok_grid->masuk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<td data-name="masuk_penyesuaian">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_masuk_penyesuaian" class="form-group kartustok_masuk_penyesuaian">
<input type="text" data-table="kartustok" data-field="x_masuk_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->masuk_penyesuaian->EditValue ?>"<?php echo $kartustok_grid->masuk_penyesuaian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_masuk_penyesuaian" class="form-group kartustok_masuk_penyesuaian">
<span<?php echo $kartustok_grid->masuk_penyesuaian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->masuk_penyesuaian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_masuk_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_masuk_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->masuk_penyesuaian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar->Visible) { // keluar ?>
		<td data-name="keluar">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_keluar" class="form-group kartustok_keluar">
<input type="text" data-table="kartustok" data-field="x_keluar" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar->EditValue ?>"<?php echo $kartustok_grid->keluar->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_keluar" class="form-group kartustok_keluar">
<span<?php echo $kartustok_grid->keluar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->keluar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar" value="<?php echo HtmlEncode($kartustok_grid->keluar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar_nonjual->Visible) { // keluar_nonjual ?>
		<td data-name="keluar_nonjual">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_keluar_nonjual" class="form-group kartustok_keluar_nonjual">
<input type="text" data-table="kartustok" data-field="x_keluar_nonjual" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_nonjual->EditValue ?>"<?php echo $kartustok_grid->keluar_nonjual->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_keluar_nonjual" class="form-group kartustok_keluar_nonjual">
<span<?php echo $kartustok_grid->keluar_nonjual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->keluar_nonjual->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_nonjual" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_nonjual" value="<?php echo HtmlEncode($kartustok_grid->keluar_nonjual->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<td data-name="keluar_penyesuaian">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_keluar_penyesuaian" class="form-group kartustok_keluar_penyesuaian">
<input type="text" data-table="kartustok" data-field="x_keluar_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_penyesuaian->EditValue ?>"<?php echo $kartustok_grid->keluar_penyesuaian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_keluar_penyesuaian" class="form-group kartustok_keluar_penyesuaian">
<span<?php echo $kartustok_grid->keluar_penyesuaian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->keluar_penyesuaian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_penyesuaian" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_penyesuaian" value="<?php echo HtmlEncode($kartustok_grid->keluar_penyesuaian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->keluar_kirim->Visible) { // keluar_kirim ?>
		<td data-name="keluar_kirim">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_keluar_kirim" class="form-group kartustok_keluar_kirim">
<input type="text" data-table="kartustok" data-field="x_keluar_kirim" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->keluar_kirim->EditValue ?>"<?php echo $kartustok_grid->keluar_kirim->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_keluar_kirim" class="form-group kartustok_keluar_kirim">
<span<?php echo $kartustok_grid->keluar_kirim->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->keluar_kirim->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="x<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_keluar_kirim" name="o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" id="o<?php echo $kartustok_grid->RowIndex ?>_keluar_kirim" value="<?php echo HtmlEncode($kartustok_grid->keluar_kirim->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->retur->Visible) { // retur ?>
		<td data-name="retur">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_retur" class="form-group kartustok_retur">
<input type="text" data-table="kartustok" data-field="x_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_retur" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->retur->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->retur->EditValue ?>"<?php echo $kartustok_grid->retur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_retur" class="form-group kartustok_retur">
<span<?php echo $kartustok_grid->retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_retur" name="x<?php echo $kartustok_grid->RowIndex ?>_retur" id="x<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_retur" name="o<?php echo $kartustok_grid->RowIndex ?>_retur" id="o<?php echo $kartustok_grid->RowIndex ?>_retur" value="<?php echo HtmlEncode($kartustok_grid->retur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($kartustok_grid->stok_akhir->Visible) { // stok_akhir ?>
		<td data-name="stok_akhir">
<?php if (!$kartustok->isConfirm()) { ?>
<span id="el$rowindex$_kartustok_stok_akhir" class="form-group kartustok_stok_akhir">
<input type="text" data-table="kartustok" data-field="x_stok_akhir" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_grid->stok_akhir->getPlaceHolder()) ?>" value="<?php echo $kartustok_grid->stok_akhir->EditValue ?>"<?php echo $kartustok_grid->stok_akhir->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_kartustok_stok_akhir" class="form-group kartustok_stok_akhir">
<span<?php echo $kartustok_grid->stok_akhir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_grid->stok_akhir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="x<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="kartustok" data-field="x_stok_akhir" name="o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" id="o<?php echo $kartustok_grid->RowIndex ?>_stok_akhir" value="<?php echo HtmlEncode($kartustok_grid->stok_akhir->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$kartustok_grid->ListOptions->render("body", "right", $kartustok_grid->RowIndex);
?>
<script>
loadjs.ready(["fkartustokgrid", "load"], function() {
	fkartustokgrid.updateLists(<?php echo $kartustok_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($kartustok->CurrentMode == "add" || $kartustok->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $kartustok_grid->FormKeyCountName ?>" id="<?php echo $kartustok_grid->FormKeyCountName ?>" value="<?php echo $kartustok_grid->KeyCount ?>">
<?php echo $kartustok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($kartustok->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $kartustok_grid->FormKeyCountName ?>" id="<?php echo $kartustok_grid->FormKeyCountName ?>" value="<?php echo $kartustok_grid->KeyCount ?>">
<?php echo $kartustok_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($kartustok->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fkartustokgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($kartustok_grid->Recordset)
	$kartustok_grid->Recordset->Close();
?>
<?php if ($kartustok_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $kartustok_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($kartustok_grid->TotalRecords == 0 && !$kartustok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $kartustok_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$kartustok_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$kartustok_grid->terminate();
?>