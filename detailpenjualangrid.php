<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($detailpenjualan_grid))
	$detailpenjualan_grid = new detailpenjualan_grid();

// Run the page
$detailpenjualan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenjualan_grid->Page_Render();
?>
<?php if (!$detailpenjualan_grid->isExport()) { ?>
<script>
var fdetailpenjualangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fdetailpenjualangrid = new ew.Form("fdetailpenjualangrid", "grid");
	fdetailpenjualangrid.formKeyCountName = '<?php echo $detailpenjualan_grid->FormKeyCountName ?>';

	// Validate form
	fdetailpenjualangrid.validate = function() {
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
			<?php if ($detailpenjualan_grid->id_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->id_penjualan->caption(), $detailpenjualan_grid->id_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenjualan_grid->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->id_barang->caption(), $detailpenjualan_grid->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->id_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->kode_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->kode_barang->caption(), $detailpenjualan_grid->kode_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->kode_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->nama_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->nama_barang->caption(), $detailpenjualan_grid->nama_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nama_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->nama_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->harga_jual->Required) { ?>
				elm = this.getElements("x" + infix + "_harga_jual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->harga_jual->caption(), $detailpenjualan_grid->harga_jual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga_jual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->harga_jual->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->stok->Required) { ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->stok->caption(), $detailpenjualan_grid->stok->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenjualan_grid->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->qty->caption(), $detailpenjualan_grid->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->qty->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->disc_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->disc_pr->caption(), $detailpenjualan_grid->disc_pr->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_pr");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->disc_pr->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->disc_rp->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_rp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->disc_rp->caption(), $detailpenjualan_grid->disc_rp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_rp");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->disc_rp->errorMessage()) ?>");
			<?php if ($detailpenjualan_grid->komisi_recall->Required) { ?>
				elm = this.getElements("x" + infix + "_komisi_recall");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->komisi_recall->caption(), $detailpenjualan_grid->komisi_recall->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenjualan_grid->subtotal->Required) { ?>
				elm = this.getElements("x" + infix + "_subtotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_grid->subtotal->caption(), $detailpenjualan_grid->subtotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_subtotal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_grid->subtotal->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fdetailpenjualangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_penjualan", false)) return false;
		if (ew.valueChanged(fobj, infix, "id_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "kode_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama_barang", false)) return false;
		if (ew.valueChanged(fobj, infix, "harga_jual", false)) return false;
		if (ew.valueChanged(fobj, infix, "stok", false)) return false;
		if (ew.valueChanged(fobj, infix, "qty", false)) return false;
		if (ew.valueChanged(fobj, infix, "disc_pr", false)) return false;
		if (ew.valueChanged(fobj, infix, "disc_rp", false)) return false;
		if (ew.valueChanged(fobj, infix, "komisi_recall", false)) return false;
		if (ew.valueChanged(fobj, infix, "subtotal", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpenjualangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpenjualangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpenjualangrid.lists["x_id_penjualan"] = <?php echo $detailpenjualan_grid->id_penjualan->Lookup->toClientList($detailpenjualan_grid) ?>;
	fdetailpenjualangrid.lists["x_id_penjualan"].options = <?php echo JsonEncode($detailpenjualan_grid->id_penjualan->lookupOptions()) ?>;
	fdetailpenjualangrid.lists["x_id_barang"] = <?php echo $detailpenjualan_grid->id_barang->Lookup->toClientList($detailpenjualan_grid) ?>;
	fdetailpenjualangrid.lists["x_id_barang"].options = <?php echo JsonEncode($detailpenjualan_grid->id_barang->lookupOptions()) ?>;
	fdetailpenjualangrid.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenjualangrid.lists["x_kode_barang"] = <?php echo $detailpenjualan_grid->kode_barang->Lookup->toClientList($detailpenjualan_grid) ?>;
	fdetailpenjualangrid.lists["x_kode_barang"].options = <?php echo JsonEncode($detailpenjualan_grid->kode_barang->lookupOptions()) ?>;
	fdetailpenjualangrid.autoSuggests["x_kode_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenjualangrid.lists["x_nama_barang"] = <?php echo $detailpenjualan_grid->nama_barang->Lookup->toClientList($detailpenjualan_grid) ?>;
	fdetailpenjualangrid.lists["x_nama_barang"].options = <?php echo JsonEncode($detailpenjualan_grid->nama_barang->lookupOptions()) ?>;
	fdetailpenjualangrid.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenjualangrid.lists["x_komisi_recall"] = <?php echo $detailpenjualan_grid->komisi_recall->Lookup->toClientList($detailpenjualan_grid) ?>;
	fdetailpenjualangrid.lists["x_komisi_recall"].options = <?php echo JsonEncode($detailpenjualan_grid->komisi_recall->lookupOptions()) ?>;
	loadjs.done("fdetailpenjualangrid");
});
</script>
<?php } ?>
<?php
$detailpenjualan_grid->renderOtherOptions();
?>
<?php if ($detailpenjualan_grid->TotalRecords > 0 || $detailpenjualan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailpenjualan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailpenjualan">
<?php if ($detailpenjualan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $detailpenjualan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fdetailpenjualangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_detailpenjualan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_detailpenjualangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailpenjualan->RowType = ROWTYPE_HEADER;

// Render list options
$detailpenjualan_grid->renderListOptions();

// Render list options (header, left)
$detailpenjualan_grid->ListOptions->render("header", "left");
?>
<?php if ($detailpenjualan_grid->id_penjualan->Visible) { // id_penjualan ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->id_penjualan) == "") { ?>
		<th data-name="id_penjualan" class="<?php echo $detailpenjualan_grid->id_penjualan->headerCellClass() ?>"><div id="elh_detailpenjualan_id_penjualan" class="detailpenjualan_id_penjualan"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->id_penjualan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_penjualan" class="<?php echo $detailpenjualan_grid->id_penjualan->headerCellClass() ?>"><div><div id="elh_detailpenjualan_id_penjualan" class="detailpenjualan_id_penjualan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->id_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->id_penjualan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->id_penjualan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailpenjualan_grid->id_barang->headerCellClass() ?>"><div id="elh_detailpenjualan_id_barang" class="detailpenjualan_id_barang"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailpenjualan_grid->id_barang->headerCellClass() ?>"><div><div id="elh_detailpenjualan_id_barang" class="detailpenjualan_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->kode_barang->Visible) { // kode_barang ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->kode_barang) == "") { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenjualan_grid->kode_barang->headerCellClass() ?>"><div id="elh_detailpenjualan_kode_barang" class="detailpenjualan_kode_barang"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->kode_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_barang" class="<?php echo $detailpenjualan_grid->kode_barang->headerCellClass() ?>"><div><div id="elh_detailpenjualan_kode_barang" class="detailpenjualan_kode_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->kode_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->kode_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->kode_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->nama_barang->Visible) { // nama_barang ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->nama_barang) == "") { ?>
		<th data-name="nama_barang" class="<?php echo $detailpenjualan_grid->nama_barang->headerCellClass() ?>"><div id="elh_detailpenjualan_nama_barang" class="detailpenjualan_nama_barang"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->nama_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_barang" class="<?php echo $detailpenjualan_grid->nama_barang->headerCellClass() ?>"><div><div id="elh_detailpenjualan_nama_barang" class="detailpenjualan_nama_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->nama_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->nama_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->nama_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->harga_jual->Visible) { // harga_jual ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->harga_jual) == "") { ?>
		<th data-name="harga_jual" class="<?php echo $detailpenjualan_grid->harga_jual->headerCellClass() ?>"><div id="elh_detailpenjualan_harga_jual" class="detailpenjualan_harga_jual"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->harga_jual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga_jual" class="<?php echo $detailpenjualan_grid->harga_jual->headerCellClass() ?>"><div><div id="elh_detailpenjualan_harga_jual" class="detailpenjualan_harga_jual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->harga_jual->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->harga_jual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->harga_jual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->stok->Visible) { // stok ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->stok) == "") { ?>
		<th data-name="stok" class="<?php echo $detailpenjualan_grid->stok->headerCellClass() ?>"><div id="elh_detailpenjualan_stok" class="detailpenjualan_stok"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->stok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="stok" class="<?php echo $detailpenjualan_grid->stok->headerCellClass() ?>"><div><div id="elh_detailpenjualan_stok" class="detailpenjualan_stok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->stok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->stok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->qty->Visible) { // qty ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->qty) == "") { ?>
		<th data-name="qty" class="<?php echo $detailpenjualan_grid->qty->headerCellClass() ?>"><div id="elh_detailpenjualan_qty" class="detailpenjualan_qty"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->qty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="qty" class="<?php echo $detailpenjualan_grid->qty->headerCellClass() ?>"><div><div id="elh_detailpenjualan_qty" class="detailpenjualan_qty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->qty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->qty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->disc_pr->Visible) { // disc_pr ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->disc_pr) == "") { ?>
		<th data-name="disc_pr" class="<?php echo $detailpenjualan_grid->disc_pr->headerCellClass() ?>"><div id="elh_detailpenjualan_disc_pr" class="detailpenjualan_disc_pr"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->disc_pr->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_pr" class="<?php echo $detailpenjualan_grid->disc_pr->headerCellClass() ?>"><div><div id="elh_detailpenjualan_disc_pr" class="detailpenjualan_disc_pr">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->disc_pr->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->disc_pr->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->disc_pr->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->disc_rp->Visible) { // disc_rp ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->disc_rp) == "") { ?>
		<th data-name="disc_rp" class="<?php echo $detailpenjualan_grid->disc_rp->headerCellClass() ?>"><div id="elh_detailpenjualan_disc_rp" class="detailpenjualan_disc_rp"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->disc_rp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disc_rp" class="<?php echo $detailpenjualan_grid->disc_rp->headerCellClass() ?>"><div><div id="elh_detailpenjualan_disc_rp" class="detailpenjualan_disc_rp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->disc_rp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->disc_rp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->disc_rp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->komisi_recall->Visible) { // komisi_recall ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->komisi_recall) == "") { ?>
		<th data-name="komisi_recall" class="<?php echo $detailpenjualan_grid->komisi_recall->headerCellClass() ?>"><div id="elh_detailpenjualan_komisi_recall" class="detailpenjualan_komisi_recall"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->komisi_recall->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="komisi_recall" class="<?php echo $detailpenjualan_grid->komisi_recall->headerCellClass() ?>"><div><div id="elh_detailpenjualan_komisi_recall" class="detailpenjualan_komisi_recall">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->komisi_recall->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->komisi_recall->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->komisi_recall->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_grid->subtotal->Visible) { // subtotal ?>
	<?php if ($detailpenjualan_grid->SortUrl($detailpenjualan_grid->subtotal) == "") { ?>
		<th data-name="subtotal" class="<?php echo $detailpenjualan_grid->subtotal->headerCellClass() ?>"><div id="elh_detailpenjualan_subtotal" class="detailpenjualan_subtotal"><div class="ew-table-header-caption"><?php echo $detailpenjualan_grid->subtotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="subtotal" class="<?php echo $detailpenjualan_grid->subtotal->headerCellClass() ?>"><div><div id="elh_detailpenjualan_subtotal" class="detailpenjualan_subtotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_grid->subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_grid->subtotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_grid->subtotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenjualan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$detailpenjualan_grid->StartRecord = 1;
$detailpenjualan_grid->StopRecord = $detailpenjualan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($detailpenjualan->isConfirm() || $detailpenjualan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailpenjualan_grid->FormKeyCountName) && ($detailpenjualan_grid->isGridAdd() || $detailpenjualan_grid->isGridEdit() || $detailpenjualan->isConfirm())) {
		$detailpenjualan_grid->KeyCount = $CurrentForm->getValue($detailpenjualan_grid->FormKeyCountName);
		$detailpenjualan_grid->StopRecord = $detailpenjualan_grid->StartRecord + $detailpenjualan_grid->KeyCount - 1;
	}
}
$detailpenjualan_grid->RecordCount = $detailpenjualan_grid->StartRecord - 1;
if ($detailpenjualan_grid->Recordset && !$detailpenjualan_grid->Recordset->EOF) {
	$detailpenjualan_grid->Recordset->moveFirst();
	$selectLimit = $detailpenjualan_grid->UseSelectLimit;
	if (!$selectLimit && $detailpenjualan_grid->StartRecord > 1)
		$detailpenjualan_grid->Recordset->move($detailpenjualan_grid->StartRecord - 1);
} elseif (!$detailpenjualan->AllowAddDeleteRow && $detailpenjualan_grid->StopRecord == 0) {
	$detailpenjualan_grid->StopRecord = $detailpenjualan->GridAddRowCount;
}

// Initialize aggregate
$detailpenjualan->RowType = ROWTYPE_AGGREGATEINIT;
$detailpenjualan->resetAttributes();
$detailpenjualan_grid->renderRow();
if ($detailpenjualan_grid->isGridAdd())
	$detailpenjualan_grid->RowIndex = 0;
if ($detailpenjualan_grid->isGridEdit())
	$detailpenjualan_grid->RowIndex = 0;
while ($detailpenjualan_grid->RecordCount < $detailpenjualan_grid->StopRecord) {
	$detailpenjualan_grid->RecordCount++;
	if ($detailpenjualan_grid->RecordCount >= $detailpenjualan_grid->StartRecord) {
		$detailpenjualan_grid->RowCount++;
		if ($detailpenjualan_grid->isGridAdd() || $detailpenjualan_grid->isGridEdit() || $detailpenjualan->isConfirm()) {
			$detailpenjualan_grid->RowIndex++;
			$CurrentForm->Index = $detailpenjualan_grid->RowIndex;
			if ($CurrentForm->hasValue($detailpenjualan_grid->FormActionName) && ($detailpenjualan->isConfirm() || $detailpenjualan_grid->EventCancelled))
				$detailpenjualan_grid->RowAction = strval($CurrentForm->getValue($detailpenjualan_grid->FormActionName));
			elseif ($detailpenjualan_grid->isGridAdd())
				$detailpenjualan_grid->RowAction = "insert";
			else
				$detailpenjualan_grid->RowAction = "";
		}

		// Set up key count
		$detailpenjualan_grid->KeyCount = $detailpenjualan_grid->RowIndex;

		// Init row class and style
		$detailpenjualan->resetAttributes();
		$detailpenjualan->CssClass = "";
		if ($detailpenjualan_grid->isGridAdd()) {
			if ($detailpenjualan->CurrentMode == "copy") {
				$detailpenjualan_grid->loadRowValues($detailpenjualan_grid->Recordset); // Load row values
				$detailpenjualan_grid->setRecordKey($detailpenjualan_grid->RowOldKey, $detailpenjualan_grid->Recordset); // Set old record key
			} else {
				$detailpenjualan_grid->loadRowValues(); // Load default values
				$detailpenjualan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$detailpenjualan_grid->loadRowValues($detailpenjualan_grid->Recordset); // Load row values
		}
		$detailpenjualan->RowType = ROWTYPE_VIEW; // Render view
		if ($detailpenjualan_grid->isGridAdd()) // Grid add
			$detailpenjualan->RowType = ROWTYPE_ADD; // Render add
		if ($detailpenjualan_grid->isGridAdd() && $detailpenjualan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$detailpenjualan_grid->restoreCurrentRowFormValues($detailpenjualan_grid->RowIndex); // Restore form values
		if ($detailpenjualan_grid->isGridEdit()) { // Grid edit
			if ($detailpenjualan->EventCancelled)
				$detailpenjualan_grid->restoreCurrentRowFormValues($detailpenjualan_grid->RowIndex); // Restore form values
			if ($detailpenjualan_grid->RowAction == "insert")
				$detailpenjualan->RowType = ROWTYPE_ADD; // Render add
			else
				$detailpenjualan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($detailpenjualan_grid->isGridEdit() && ($detailpenjualan->RowType == ROWTYPE_EDIT || $detailpenjualan->RowType == ROWTYPE_ADD) && $detailpenjualan->EventCancelled) // Update failed
			$detailpenjualan_grid->restoreCurrentRowFormValues($detailpenjualan_grid->RowIndex); // Restore form values
		if ($detailpenjualan->RowType == ROWTYPE_EDIT) // Edit row
			$detailpenjualan_grid->EditRowCount++;
		if ($detailpenjualan->isConfirm()) // Confirm row
			$detailpenjualan_grid->restoreCurrentRowFormValues($detailpenjualan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$detailpenjualan->RowAttrs->merge(["data-rowindex" => $detailpenjualan_grid->RowCount, "id" => "r" . $detailpenjualan_grid->RowCount . "_detailpenjualan", "data-rowtype" => $detailpenjualan->RowType]);

		// Render row
		$detailpenjualan_grid->renderRow();

		// Render list options
		$detailpenjualan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($detailpenjualan_grid->RowAction != "delete" && $detailpenjualan_grid->RowAction != "insertdelete" && !($detailpenjualan_grid->RowAction == "insert" && $detailpenjualan->isConfirm() && $detailpenjualan_grid->emptyRow())) {
?>
	<tr <?php echo $detailpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenjualan_grid->ListOptions->render("body", "left", $detailpenjualan_grid->RowCount);
?>
	<?php if ($detailpenjualan_grid->id_penjualan->Visible) { // id_penjualan ?>
		<td data-name="id_penjualan" <?php echo $detailpenjualan_grid->id_penjualan->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($detailpenjualan_grid->id_penjualan->getSessionValue() != "") { ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_penjualan" class="form-group">
<span<?php echo $detailpenjualan_grid->id_penjualan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->id_penjualan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_penjualan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_id_penjualan" data-value-separator="<?php echo $detailpenjualan_grid->id_penjualan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan"<?php echo $detailpenjualan_grid->id_penjualan->editAttributes() ?>>
			<?php echo $detailpenjualan_grid->id_penjualan->selectOptionListHtml("x{$detailpenjualan_grid->RowIndex}_id_penjualan") ?>
		</select>
</div>
<?php echo $detailpenjualan_grid->id_penjualan->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_id_penjualan") ?>
</span>
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($detailpenjualan_grid->id_penjualan->getSessionValue() != "") { ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_penjualan" class="form-group">
<span<?php echo $detailpenjualan_grid->id_penjualan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->id_penjualan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_penjualan" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_id_penjualan" data-value-separator="<?php echo $detailpenjualan_grid->id_penjualan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan"<?php echo $detailpenjualan_grid->id_penjualan->editAttributes() ?>>
			<?php echo $detailpenjualan_grid->id_penjualan->selectOptionListHtml("x{$detailpenjualan_grid->RowIndex}_id_penjualan") ?>
		</select>
</div>
<?php echo $detailpenjualan_grid->id_penjualan->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_id_penjualan") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_grid->id_penjualan->viewAttributes() ?>><?php echo $detailpenjualan_grid->id_penjualan->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailpenjualan_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_id" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailpenjualan_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT || $detailpenjualan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($detailpenjualan_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($detailpenjualan_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailpenjualan_grid->id_barang->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_barang" class="form-group">
<?php
$onchange = $detailpenjualan_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->id_barang->EditValue) ?>" size="25" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" data-value-separator="<?php echo $detailpenjualan_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->id_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_barang" class="form-group">
<?php
$onchange = $detailpenjualan_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->id_barang->EditValue) ?>" size="25" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" data-value-separator="<?php echo $detailpenjualan_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->id_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_id_barang") ?>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_id_barang">
<span<?php echo $detailpenjualan_grid->id_barang->viewAttributes() ?>><?php echo $detailpenjualan_grid->id_barang->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang" <?php echo $detailpenjualan_grid->kode_barang->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_kode_barang" class="form-group">
<?php
$onchange = $detailpenjualan_grid->kode_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->kode_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->kode_barang->EditValue) ?>" size="10" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->kode_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" data-value-separator="<?php echo $detailpenjualan_grid->kode_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->kode_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_kode_barang") ?>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_kode_barang" class="form-group">
<?php
$onchange = $detailpenjualan_grid->kode_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->kode_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->kode_barang->EditValue) ?>" size="10" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->kode_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" data-value-separator="<?php echo $detailpenjualan_grid->kode_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->kode_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_kode_barang") ?>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_kode_barang">
<span<?php echo $detailpenjualan_grid->kode_barang->viewAttributes() ?>><?php echo $detailpenjualan_grid->kode_barang->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang" <?php echo $detailpenjualan_grid->nama_barang->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_nama_barang" class="form-group">
<?php
$onchange = $detailpenjualan_grid->nama_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->nama_barang->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" data-value-separator="<?php echo $detailpenjualan_grid->nama_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->nama_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_nama_barang") ?>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_nama_barang" class="form-group">
<?php
$onchange = $detailpenjualan_grid->nama_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->nama_barang->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" data-value-separator="<?php echo $detailpenjualan_grid->nama_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->nama_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_nama_barang") ?>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_nama_barang">
<span<?php echo $detailpenjualan_grid->nama_barang->viewAttributes() ?>><?php echo $detailpenjualan_grid->nama_barang->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->harga_jual->Visible) { // harga_jual ?>
		<td data-name="harga_jual" <?php echo $detailpenjualan_grid->harga_jual->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_harga_jual" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_harga_jual" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->harga_jual->EditValue ?>"<?php echo $detailpenjualan_grid->harga_jual->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_harga_jual" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_harga_jual" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->harga_jual->EditValue ?>"<?php echo $detailpenjualan_grid->harga_jual->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_harga_jual">
<span<?php echo $detailpenjualan_grid->harga_jual->viewAttributes() ?>><?php echo $detailpenjualan_grid->harga_jual->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->stok->Visible) { // stok ?>
		<td data-name="stok" <?php echo $detailpenjualan_grid->stok->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_stok" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_stok" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" size="5" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->stok->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->stok->EditValue ?>"<?php echo $detailpenjualan_grid->stok->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_stok" class="form-group">
<span<?php echo $detailpenjualan_grid->stok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->stok->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->CurrentValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_stok">
<span<?php echo $detailpenjualan_grid->stok->viewAttributes() ?>><?php echo $detailpenjualan_grid->stok->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->qty->Visible) { // qty ?>
		<td data-name="qty" <?php echo $detailpenjualan_grid->qty->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_qty" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_qty" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" size="5" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->qty->EditValue ?>"<?php echo $detailpenjualan_grid->qty->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_qty" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_qty" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" size="5" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->qty->EditValue ?>"<?php echo $detailpenjualan_grid->qty->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_qty">
<span<?php echo $detailpenjualan_grid->qty->viewAttributes() ?>><?php echo $detailpenjualan_grid->qty->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->disc_pr->Visible) { // disc_pr ?>
		<td data-name="disc_pr" <?php echo $detailpenjualan_grid->disc_pr->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_disc_pr" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_disc_pr" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->disc_pr->EditValue ?>"<?php echo $detailpenjualan_grid->disc_pr->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_disc_pr" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_disc_pr" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->disc_pr->EditValue ?>"<?php echo $detailpenjualan_grid->disc_pr->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_disc_pr">
<span<?php echo $detailpenjualan_grid->disc_pr->viewAttributes() ?>><?php echo $detailpenjualan_grid->disc_pr->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->disc_rp->Visible) { // disc_rp ?>
		<td data-name="disc_rp" <?php echo $detailpenjualan_grid->disc_rp->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_disc_rp" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_disc_rp" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->disc_rp->EditValue ?>"<?php echo $detailpenjualan_grid->disc_rp->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_disc_rp" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_disc_rp" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->disc_rp->EditValue ?>"<?php echo $detailpenjualan_grid->disc_rp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_disc_rp">
<span<?php echo $detailpenjualan_grid->disc_rp->viewAttributes() ?>><?php echo $detailpenjualan_grid->disc_rp->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->komisi_recall->Visible) { // komisi_recall ?>
		<td data-name="komisi_recall" <?php echo $detailpenjualan_grid->komisi_recall->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_komisi_recall" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_komisi_recall" data-value-separator="<?php echo $detailpenjualan_grid->komisi_recall->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall"<?php echo $detailpenjualan_grid->komisi_recall->editAttributes() ?>>
			<?php echo $detailpenjualan_grid->komisi_recall->selectOptionListHtml("x{$detailpenjualan_grid->RowIndex}_komisi_recall") ?>
		</select>
</div>
<?php echo $detailpenjualan_grid->komisi_recall->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_komisi_recall") ?>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_komisi_recall" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_komisi_recall" data-value-separator="<?php echo $detailpenjualan_grid->komisi_recall->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall"<?php echo $detailpenjualan_grid->komisi_recall->editAttributes() ?>>
			<?php echo $detailpenjualan_grid->komisi_recall->selectOptionListHtml("x{$detailpenjualan_grid->RowIndex}_komisi_recall") ?>
		</select>
</div>
<?php echo $detailpenjualan_grid->komisi_recall->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_komisi_recall") ?>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_komisi_recall">
<span<?php echo $detailpenjualan_grid->komisi_recall->viewAttributes() ?>><?php echo $detailpenjualan_grid->komisi_recall->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->subtotal->Visible) { // subtotal ?>
		<td data-name="subtotal" <?php echo $detailpenjualan_grid->subtotal->cellAttributes() ?>>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_subtotal" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_subtotal" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" size="9" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->subtotal->EditValue ?>"<?php echo $detailpenjualan_grid->subtotal->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->OldValue) ?>">
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_subtotal" class="form-group">
<input type="text" data-table="detailpenjualan" data-field="x_subtotal" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" size="9" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->subtotal->EditValue ?>"<?php echo $detailpenjualan_grid->subtotal->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($detailpenjualan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $detailpenjualan_grid->RowCount ?>_detailpenjualan_subtotal">
<span<?php echo $detailpenjualan_grid->subtotal->viewAttributes() ?>><?php echo $detailpenjualan_grid->subtotal->getViewValue() ?></span>
</span>
<?php if (!$detailpenjualan->isConfirm()) { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="fdetailpenjualangrid$x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->FormValue) ?>">
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="fdetailpenjualangrid$o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenjualan_grid->ListOptions->render("body", "right", $detailpenjualan_grid->RowCount);
?>
	</tr>
<?php if ($detailpenjualan->RowType == ROWTYPE_ADD || $detailpenjualan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdetailpenjualangrid", "load"], function() {
	fdetailpenjualangrid.updateLists(<?php echo $detailpenjualan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$detailpenjualan_grid->isGridAdd() || $detailpenjualan->CurrentMode == "copy")
		if (!$detailpenjualan_grid->Recordset->EOF)
			$detailpenjualan_grid->Recordset->moveNext();
}
?>
<?php
	if ($detailpenjualan->CurrentMode == "add" || $detailpenjualan->CurrentMode == "copy" || $detailpenjualan->CurrentMode == "edit") {
		$detailpenjualan_grid->RowIndex = '$rowindex$';
		$detailpenjualan_grid->loadRowValues();

		// Set row properties
		$detailpenjualan->resetAttributes();
		$detailpenjualan->RowAttrs->merge(["data-rowindex" => $detailpenjualan_grid->RowIndex, "id" => "r0_detailpenjualan", "data-rowtype" => ROWTYPE_ADD]);
		$detailpenjualan->RowAttrs->appendClass("ew-template");
		$detailpenjualan->RowType = ROWTYPE_ADD;

		// Render row
		$detailpenjualan_grid->renderRow();

		// Render list options
		$detailpenjualan_grid->renderListOptions();
		$detailpenjualan_grid->StartRowCount = 0;
?>
	<tr <?php echo $detailpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenjualan_grid->ListOptions->render("body", "left", $detailpenjualan_grid->RowIndex);
?>
	<?php if ($detailpenjualan_grid->id_penjualan->Visible) { // id_penjualan ?>
		<td data-name="id_penjualan">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<?php if ($detailpenjualan_grid->id_penjualan->getSessionValue() != "") { ?>
<span id="el$rowindex$_detailpenjualan_id_penjualan" class="form-group detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_grid->id_penjualan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->id_penjualan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_id_penjualan" class="form-group detailpenjualan_id_penjualan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_id_penjualan" data-value-separator="<?php echo $detailpenjualan_grid->id_penjualan->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan"<?php echo $detailpenjualan_grid->id_penjualan->editAttributes() ?>>
			<?php echo $detailpenjualan_grid->id_penjualan->selectOptionListHtml("x{$detailpenjualan_grid->RowIndex}_id_penjualan") ?>
		</select>
</div>
<?php echo $detailpenjualan_grid->id_penjualan->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_id_penjualan") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_id_penjualan" class="form-group detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_grid->id_penjualan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->id_penjualan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_penjualan" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_grid->id_penjualan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_id_barang" class="form-group detailpenjualan_id_barang">
<?php
$onchange = $detailpenjualan_grid->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->id_barang->EditValue) ?>" size="25" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" data-value-separator="<?php echo $detailpenjualan_grid->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->id_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_id_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_id_barang" class="form-group detailpenjualan_id_barang">
<span<?php echo $detailpenjualan_grid->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->kode_barang->Visible) { // kode_barang ?>
		<td data-name="kode_barang">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_kode_barang" class="form-group detailpenjualan_kode_barang">
<?php
$onchange = $detailpenjualan_grid->kode_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->kode_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->kode_barang->EditValue) ?>" size="10" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->kode_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" data-value-separator="<?php echo $detailpenjualan_grid->kode_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->kode_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_kode_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_kode_barang" class="form-group detailpenjualan_kode_barang">
<span<?php echo $detailpenjualan_grid->kode_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->kode_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->kode_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->nama_barang->Visible) { // nama_barang ?>
		<td data-name="nama_barang">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_nama_barang" class="form-group detailpenjualan_nama_barang">
<?php
$onchange = $detailpenjualan_grid->nama_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_grid->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang">
	<input type="text" class="form-control" name="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="sv_x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo RemoveHtml($detailpenjualan_grid->nama_barang->EditValue) ?>" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_grid->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" data-value-separator="<?php echo $detailpenjualan_grid->nama_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualangrid"], function() {
	fdetailpenjualangrid.createAutoSuggest({"id":"x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_grid->nama_barang->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_nama_barang") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_nama_barang" class="form-group detailpenjualan_nama_barang">
<span<?php echo $detailpenjualan_grid->nama_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->nama_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_grid->nama_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->harga_jual->Visible) { // harga_jual ?>
		<td data-name="harga_jual">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_harga_jual" class="form-group detailpenjualan_harga_jual">
<input type="text" data-table="detailpenjualan" data-field="x_harga_jual" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->harga_jual->EditValue ?>"<?php echo $detailpenjualan_grid->harga_jual->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_harga_jual" class="form-group detailpenjualan_harga_jual">
<span<?php echo $detailpenjualan_grid->harga_jual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->harga_jual->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_harga_jual" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_harga_jual" value="<?php echo HtmlEncode($detailpenjualan_grid->harga_jual->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->stok->Visible) { // stok ?>
		<td data-name="stok">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_stok" class="form-group detailpenjualan_stok">
<input type="text" data-table="detailpenjualan" data-field="x_stok" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" size="5" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->stok->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->stok->EditValue ?>"<?php echo $detailpenjualan_grid->stok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_stok" class="form-group detailpenjualan_stok">
<span<?php echo $detailpenjualan_grid->stok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->stok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_stok" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_stok" value="<?php echo HtmlEncode($detailpenjualan_grid->stok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->qty->Visible) { // qty ?>
		<td data-name="qty">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_qty" class="form-group detailpenjualan_qty">
<input type="text" data-table="detailpenjualan" data-field="x_qty" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" size="5" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->qty->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->qty->EditValue ?>"<?php echo $detailpenjualan_grid->qty->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_qty" class="form-group detailpenjualan_qty">
<span<?php echo $detailpenjualan_grid->qty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->qty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_qty" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_qty" value="<?php echo HtmlEncode($detailpenjualan_grid->qty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->disc_pr->Visible) { // disc_pr ?>
		<td data-name="disc_pr">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_disc_pr" class="form-group detailpenjualan_disc_pr">
<input type="text" data-table="detailpenjualan" data-field="x_disc_pr" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->disc_pr->EditValue ?>"<?php echo $detailpenjualan_grid->disc_pr->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_disc_pr" class="form-group detailpenjualan_disc_pr">
<span<?php echo $detailpenjualan_grid->disc_pr->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->disc_pr->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_pr" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_pr" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_pr->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->disc_rp->Visible) { // disc_rp ?>
		<td data-name="disc_rp">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_disc_rp" class="form-group detailpenjualan_disc_rp">
<input type="text" data-table="detailpenjualan" data-field="x_disc_rp" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->disc_rp->EditValue ?>"<?php echo $detailpenjualan_grid->disc_rp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_disc_rp" class="form-group detailpenjualan_disc_rp">
<span<?php echo $detailpenjualan_grid->disc_rp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->disc_rp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_disc_rp" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_disc_rp" value="<?php echo HtmlEncode($detailpenjualan_grid->disc_rp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->komisi_recall->Visible) { // komisi_recall ?>
		<td data-name="komisi_recall">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_komisi_recall" class="form-group detailpenjualan_komisi_recall">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_komisi_recall" data-value-separator="<?php echo $detailpenjualan_grid->komisi_recall->displayValueSeparatorAttribute() ?>" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall"<?php echo $detailpenjualan_grid->komisi_recall->editAttributes() ?>>
			<?php echo $detailpenjualan_grid->komisi_recall->selectOptionListHtml("x{$detailpenjualan_grid->RowIndex}_komisi_recall") ?>
		</select>
</div>
<?php echo $detailpenjualan_grid->komisi_recall->Lookup->getParamTag($detailpenjualan_grid, "p_x" . $detailpenjualan_grid->RowIndex . "_komisi_recall") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_komisi_recall" class="form-group detailpenjualan_komisi_recall">
<span<?php echo $detailpenjualan_grid->komisi_recall->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->komisi_recall->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_komisi_recall" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_komisi_recall" value="<?php echo HtmlEncode($detailpenjualan_grid->komisi_recall->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailpenjualan_grid->subtotal->Visible) { // subtotal ?>
		<td data-name="subtotal">
<?php if (!$detailpenjualan->isConfirm()) { ?>
<span id="el$rowindex$_detailpenjualan_subtotal" class="form-group detailpenjualan_subtotal">
<input type="text" data-table="detailpenjualan" data-field="x_subtotal" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" size="9" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_grid->subtotal->EditValue ?>"<?php echo $detailpenjualan_grid->subtotal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_detailpenjualan_subtotal" class="form-group detailpenjualan_subtotal">
<span<?php echo $detailpenjualan_grid->subtotal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_grid->subtotal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="x<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="detailpenjualan" data-field="x_subtotal" name="o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" id="o<?php echo $detailpenjualan_grid->RowIndex ?>_subtotal" value="<?php echo HtmlEncode($detailpenjualan_grid->subtotal->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailpenjualan_grid->ListOptions->render("body", "right", $detailpenjualan_grid->RowIndex);
?>
<script>
loadjs.ready(["fdetailpenjualangrid", "load"], function() {
	fdetailpenjualangrid.updateLists(<?php echo $detailpenjualan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailpenjualan->CurrentMode == "add" || $detailpenjualan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $detailpenjualan_grid->FormKeyCountName ?>" id="<?php echo $detailpenjualan_grid->FormKeyCountName ?>" value="<?php echo $detailpenjualan_grid->KeyCount ?>">
<?php echo $detailpenjualan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpenjualan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $detailpenjualan_grid->FormKeyCountName ?>" id="<?php echo $detailpenjualan_grid->FormKeyCountName ?>" value="<?php echo $detailpenjualan_grid->KeyCount ?>">
<?php echo $detailpenjualan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($detailpenjualan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdetailpenjualangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailpenjualan_grid->Recordset)
	$detailpenjualan_grid->Recordset->Close();
?>
<?php if ($detailpenjualan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $detailpenjualan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailpenjualan_grid->TotalRecords == 0 && !$detailpenjualan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailpenjualan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$detailpenjualan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$detailpenjualan_grid->terminate();
?>