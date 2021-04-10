<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$antrian_list = new antrian_list();

// Run the page
$antrian_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$antrian_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$antrian_list->isExport()) { ?>
<script>
var fantrianlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fantrianlist = currentForm = new ew.Form("fantrianlist", "list");
	fantrianlist.formKeyCountName = '<?php echo $antrian_list->FormKeyCountName ?>';

	// Validate form
	fantrianlist.validate = function() {
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
			<?php if ($antrian_list->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $antrian_list->tanggal->caption(), $antrian_list->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($antrian_list->tanggal->errorMessage()) ?>");
			<?php if ($antrian_list->nomor_antrian->Required) { ?>
				elm = this.getElements("x" + infix + "_nomor_antrian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $antrian_list->nomor_antrian->caption(), $antrian_list->nomor_antrian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($antrian_list->keperluan->Required) { ?>
				elm = this.getElements("x" + infix + "_keperluan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $antrian_list->keperluan->caption(), $antrian_list->keperluan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($antrian_list->nama_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $antrian_list->nama_klinik->caption(), $antrian_list->nama_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($antrian_list->selesai->Required) { ?>
				elm = this.getElements("x" + infix + "_selesai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $antrian_list->selesai->caption(), $antrian_list->selesai->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fantrianlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fantrianlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fantrianlist.lists["x_nama_klinik"] = <?php echo $antrian_list->nama_klinik->Lookup->toClientList($antrian_list) ?>;
	fantrianlist.lists["x_nama_klinik"].options = <?php echo JsonEncode($antrian_list->nama_klinik->lookupOptions()) ?>;
	fantrianlist.lists["x_selesai"] = <?php echo $antrian_list->selesai->Lookup->toClientList($antrian_list) ?>;
	fantrianlist.lists["x_selesai"].options = <?php echo JsonEncode($antrian_list->selesai->options(FALSE, TRUE)) ?>;
	loadjs.done("fantrianlist");
});
var fantrianlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fantrianlistsrch = currentSearchForm = new ew.Form("fantrianlistsrch");

	// Dynamic selection lists
	// Filters

	fantrianlistsrch.filterList = <?php echo $antrian_list->getFilterList() ?>;
	loadjs.done("fantrianlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$antrian_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($antrian_list->TotalRecords > 0 && $antrian_list->ExportOptions->visible()) { ?>
<?php $antrian_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($antrian_list->ImportOptions->visible()) { ?>
<?php $antrian_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($antrian_list->SearchOptions->visible()) { ?>
<?php $antrian_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($antrian_list->FilterOptions->visible()) { ?>
<?php $antrian_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$antrian_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$antrian_list->isExport() && !$antrian->CurrentAction) { ?>
<form name="fantrianlistsrch" id="fantrianlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fantrianlistsrch-search-panel" class="<?php echo $antrian_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="antrian">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $antrian_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($antrian_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($antrian_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $antrian_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($antrian_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($antrian_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($antrian_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($antrian_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $antrian_list->showPageHeader(); ?>
<?php
$antrian_list->showMessage();
?>
<?php if ($antrian_list->TotalRecords > 0 || $antrian->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($antrian_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> antrian">
<?php if (!$antrian_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$antrian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $antrian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $antrian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fantrianlist" id="fantrianlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="antrian">
<div id="gmp_antrian" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($antrian_list->TotalRecords > 0 || $antrian_list->isAdd() || $antrian_list->isCopy() || $antrian_list->isGridEdit()) { ?>
<table id="tbl_antrianlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$antrian->RowType = ROWTYPE_HEADER;

// Render list options
$antrian_list->renderListOptions();

// Render list options (header, left)
$antrian_list->ListOptions->render("header", "left");
?>
<?php if ($antrian_list->tanggal->Visible) { // tanggal ?>
	<?php if ($antrian_list->SortUrl($antrian_list->tanggal) == "") { ?>
		<th data-name="tanggal" class="<?php echo $antrian_list->tanggal->headerCellClass() ?>"><div id="elh_antrian_tanggal" class="antrian_tanggal"><div class="ew-table-header-caption"><?php echo $antrian_list->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tanggal" class="<?php echo $antrian_list->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $antrian_list->SortUrl($antrian_list->tanggal) ?>', 1);"><div id="elh_antrian_tanggal" class="antrian_tanggal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $antrian_list->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($antrian_list->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($antrian_list->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($antrian_list->nomor_antrian->Visible) { // nomor_antrian ?>
	<?php if ($antrian_list->SortUrl($antrian_list->nomor_antrian) == "") { ?>
		<th data-name="nomor_antrian" class="<?php echo $antrian_list->nomor_antrian->headerCellClass() ?>"><div id="elh_antrian_nomor_antrian" class="antrian_nomor_antrian"><div class="ew-table-header-caption"><?php echo $antrian_list->nomor_antrian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nomor_antrian" class="<?php echo $antrian_list->nomor_antrian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $antrian_list->SortUrl($antrian_list->nomor_antrian) ?>', 1);"><div id="elh_antrian_nomor_antrian" class="antrian_nomor_antrian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $antrian_list->nomor_antrian->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($antrian_list->nomor_antrian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($antrian_list->nomor_antrian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($antrian_list->keperluan->Visible) { // keperluan ?>
	<?php if ($antrian_list->SortUrl($antrian_list->keperluan) == "") { ?>
		<th data-name="keperluan" class="<?php echo $antrian_list->keperluan->headerCellClass() ?>"><div id="elh_antrian_keperluan" class="antrian_keperluan"><div class="ew-table-header-caption"><?php echo $antrian_list->keperluan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keperluan" class="<?php echo $antrian_list->keperluan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $antrian_list->SortUrl($antrian_list->keperluan) ?>', 1);"><div id="elh_antrian_keperluan" class="antrian_keperluan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $antrian_list->keperluan->caption() ?></span><span class="ew-table-header-sort"><?php if ($antrian_list->keperluan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($antrian_list->keperluan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($antrian_list->nama_klinik->Visible) { // nama_klinik ?>
	<?php if ($antrian_list->SortUrl($antrian_list->nama_klinik) == "") { ?>
		<th data-name="nama_klinik" class="<?php echo $antrian_list->nama_klinik->headerCellClass() ?>"><div id="elh_antrian_nama_klinik" class="antrian_nama_klinik"><div class="ew-table-header-caption"><?php echo $antrian_list->nama_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_klinik" class="<?php echo $antrian_list->nama_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $antrian_list->SortUrl($antrian_list->nama_klinik) ?>', 1);"><div id="elh_antrian_nama_klinik" class="antrian_nama_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $antrian_list->nama_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($antrian_list->nama_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($antrian_list->nama_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($antrian_list->selesai->Visible) { // selesai ?>
	<?php if ($antrian_list->SortUrl($antrian_list->selesai) == "") { ?>
		<th data-name="selesai" class="<?php echo $antrian_list->selesai->headerCellClass() ?>"><div id="elh_antrian_selesai" class="antrian_selesai"><div class="ew-table-header-caption"><?php echo $antrian_list->selesai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="selesai" class="<?php echo $antrian_list->selesai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $antrian_list->SortUrl($antrian_list->selesai) ?>', 1);"><div id="elh_antrian_selesai" class="antrian_selesai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $antrian_list->selesai->caption() ?></span><span class="ew-table-header-sort"><?php if ($antrian_list->selesai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($antrian_list->selesai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$antrian_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($antrian_list->isAdd() || $antrian_list->isCopy()) {
		$antrian_list->RowIndex = 0;
		$antrian_list->KeyCount = $antrian_list->RowIndex;
		if ($antrian_list->isAdd())
			$antrian_list->loadRowValues();
		if ($antrian->EventCancelled) // Insert failed
			$antrian_list->restoreFormValues(); // Restore form values

		// Set row properties
		$antrian->resetAttributes();
		$antrian->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_antrian", "data-rowtype" => ROWTYPE_ADD]);
		$antrian->RowType = ROWTYPE_ADD;

		// Render row
		$antrian_list->renderRow();

		// Render list options
		$antrian_list->renderListOptions();
		$antrian_list->StartRowCount = 0;
?>
	<tr <?php echo $antrian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$antrian_list->ListOptions->render("body", "left", $antrian_list->RowCount);
?>
	<?php if ($antrian_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal">
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_tanggal" class="form-group antrian_tanggal">
<input type="text" data-table="antrian" data-field="x_tanggal" name="x<?php echo $antrian_list->RowIndex ?>_tanggal" id="x<?php echo $antrian_list->RowIndex ?>_tanggal" maxlength="10" placeholder="<?php echo HtmlEncode($antrian_list->tanggal->getPlaceHolder()) ?>" value="<?php echo $antrian_list->tanggal->EditValue ?>"<?php echo $antrian_list->tanggal->editAttributes() ?>>
<?php if (!$antrian_list->tanggal->ReadOnly && !$antrian_list->tanggal->Disabled && !isset($antrian_list->tanggal->EditAttrs["readonly"]) && !isset($antrian_list->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fantrianlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fantrianlist", "x<?php echo $antrian_list->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="antrian" data-field="x_tanggal" name="o<?php echo $antrian_list->RowIndex ?>_tanggal" id="o<?php echo $antrian_list->RowIndex ?>_tanggal" value="<?php echo HtmlEncode($antrian_list->tanggal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($antrian_list->nomor_antrian->Visible) { // nomor_antrian ?>
		<td data-name="nomor_antrian">
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_nomor_antrian" class="form-group antrian_nomor_antrian">
<input type="text" data-table="antrian" data-field="x_nomor_antrian" name="x<?php echo $antrian_list->RowIndex ?>_nomor_antrian" id="x<?php echo $antrian_list->RowIndex ?>_nomor_antrian" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($antrian_list->nomor_antrian->getPlaceHolder()) ?>" value="<?php echo $antrian_list->nomor_antrian->EditValue ?>"<?php echo $antrian_list->nomor_antrian->editAttributes() ?>>
</span>
<input type="hidden" data-table="antrian" data-field="x_nomor_antrian" name="o<?php echo $antrian_list->RowIndex ?>_nomor_antrian" id="o<?php echo $antrian_list->RowIndex ?>_nomor_antrian" value="<?php echo HtmlEncode($antrian_list->nomor_antrian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($antrian_list->keperluan->Visible) { // keperluan ?>
		<td data-name="keperluan">
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_keperluan" class="form-group antrian_keperluan">
<input type="text" data-table="antrian" data-field="x_keperluan" name="x<?php echo $antrian_list->RowIndex ?>_keperluan" id="x<?php echo $antrian_list->RowIndex ?>_keperluan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($antrian_list->keperluan->getPlaceHolder()) ?>" value="<?php echo $antrian_list->keperluan->EditValue ?>"<?php echo $antrian_list->keperluan->editAttributes() ?>>
</span>
<input type="hidden" data-table="antrian" data-field="x_keperluan" name="o<?php echo $antrian_list->RowIndex ?>_keperluan" id="o<?php echo $antrian_list->RowIndex ?>_keperluan" value="<?php echo HtmlEncode($antrian_list->keperluan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($antrian_list->nama_klinik->Visible) { // nama_klinik ?>
		<td data-name="nama_klinik">
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_nama_klinik" class="form-group antrian_nama_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="antrian" data-field="x_nama_klinik" data-value-separator="<?php echo $antrian_list->nama_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $antrian_list->RowIndex ?>_nama_klinik" name="x<?php echo $antrian_list->RowIndex ?>_nama_klinik"<?php echo $antrian_list->nama_klinik->editAttributes() ?>>
			<?php echo $antrian_list->nama_klinik->selectOptionListHtml("x{$antrian_list->RowIndex}_nama_klinik") ?>
		</select>
</div>
<?php echo $antrian_list->nama_klinik->Lookup->getParamTag($antrian_list, "p_x" . $antrian_list->RowIndex . "_nama_klinik") ?>
</span>
<input type="hidden" data-table="antrian" data-field="x_nama_klinik" name="o<?php echo $antrian_list->RowIndex ?>_nama_klinik" id="o<?php echo $antrian_list->RowIndex ?>_nama_klinik" value="<?php echo HtmlEncode($antrian_list->nama_klinik->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($antrian_list->selesai->Visible) { // selesai ?>
		<td data-name="selesai">
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_selesai" class="form-group antrian_selesai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="antrian" data-field="x_selesai" data-value-separator="<?php echo $antrian_list->selesai->displayValueSeparatorAttribute() ?>" id="x<?php echo $antrian_list->RowIndex ?>_selesai" name="x<?php echo $antrian_list->RowIndex ?>_selesai"<?php echo $antrian_list->selesai->editAttributes() ?>>
			<?php echo $antrian_list->selesai->selectOptionListHtml("x{$antrian_list->RowIndex}_selesai") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="antrian" data-field="x_selesai" name="o<?php echo $antrian_list->RowIndex ?>_selesai" id="o<?php echo $antrian_list->RowIndex ?>_selesai" value="<?php echo HtmlEncode($antrian_list->selesai->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$antrian_list->ListOptions->render("body", "right", $antrian_list->RowCount);
?>
<script>
loadjs.ready(["fantrianlist", "load"], function() {
	fantrianlist.updateLists(<?php echo $antrian_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($antrian_list->ExportAll && $antrian_list->isExport()) {
	$antrian_list->StopRecord = $antrian_list->TotalRecords;
} else {

	// Set the last record to display
	if ($antrian_list->TotalRecords > $antrian_list->StartRecord + $antrian_list->DisplayRecords - 1)
		$antrian_list->StopRecord = $antrian_list->StartRecord + $antrian_list->DisplayRecords - 1;
	else
		$antrian_list->StopRecord = $antrian_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($antrian->isConfirm() || $antrian_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($antrian_list->FormKeyCountName) && ($antrian_list->isGridAdd() || $antrian_list->isGridEdit() || $antrian->isConfirm())) {
		$antrian_list->KeyCount = $CurrentForm->getValue($antrian_list->FormKeyCountName);
		$antrian_list->StopRecord = $antrian_list->StartRecord + $antrian_list->KeyCount - 1;
	}
}
$antrian_list->RecordCount = $antrian_list->StartRecord - 1;
if ($antrian_list->Recordset && !$antrian_list->Recordset->EOF) {
	$antrian_list->Recordset->moveFirst();
	$selectLimit = $antrian_list->UseSelectLimit;
	if (!$selectLimit && $antrian_list->StartRecord > 1)
		$antrian_list->Recordset->move($antrian_list->StartRecord - 1);
} elseif (!$antrian->AllowAddDeleteRow && $antrian_list->StopRecord == 0) {
	$antrian_list->StopRecord = $antrian->GridAddRowCount;
}

// Initialize aggregate
$antrian->RowType = ROWTYPE_AGGREGATEINIT;
$antrian->resetAttributes();
$antrian_list->renderRow();
$antrian_list->EditRowCount = 0;
if ($antrian_list->isEdit())
	$antrian_list->RowIndex = 1;
while ($antrian_list->RecordCount < $antrian_list->StopRecord) {
	$antrian_list->RecordCount++;
	if ($antrian_list->RecordCount >= $antrian_list->StartRecord) {
		$antrian_list->RowCount++;

		// Set up key count
		$antrian_list->KeyCount = $antrian_list->RowIndex;

		// Init row class and style
		$antrian->resetAttributes();
		$antrian->CssClass = "";
		if ($antrian_list->isGridAdd()) {
			$antrian_list->loadRowValues(); // Load default values
		} else {
			$antrian_list->loadRowValues($antrian_list->Recordset); // Load row values
		}
		$antrian->RowType = ROWTYPE_VIEW; // Render view
		if ($antrian_list->isEdit()) {
			if ($antrian_list->checkInlineEditKey() && $antrian_list->EditRowCount == 0) { // Inline edit
				$antrian->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($antrian_list->isEdit() && $antrian->RowType == ROWTYPE_EDIT && $antrian->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$antrian_list->restoreFormValues(); // Restore form values
		}
		if ($antrian->RowType == ROWTYPE_EDIT) // Edit row
			$antrian_list->EditRowCount++;

		// Set up row id / data-rowindex
		$antrian->RowAttrs->merge(["data-rowindex" => $antrian_list->RowCount, "id" => "r" . $antrian_list->RowCount . "_antrian", "data-rowtype" => $antrian->RowType]);

		// Render row
		$antrian_list->renderRow();

		// Render list options
		$antrian_list->renderListOptions();
?>
	<tr <?php echo $antrian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$antrian_list->ListOptions->render("body", "left", $antrian_list->RowCount);
?>
	<?php if ($antrian_list->tanggal->Visible) { // tanggal ?>
		<td data-name="tanggal" <?php echo $antrian_list->tanggal->cellAttributes() ?>>
<?php if ($antrian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_tanggal" class="form-group">
<input type="text" data-table="antrian" data-field="x_tanggal" name="x<?php echo $antrian_list->RowIndex ?>_tanggal" id="x<?php echo $antrian_list->RowIndex ?>_tanggal" maxlength="10" placeholder="<?php echo HtmlEncode($antrian_list->tanggal->getPlaceHolder()) ?>" value="<?php echo $antrian_list->tanggal->EditValue ?>"<?php echo $antrian_list->tanggal->editAttributes() ?>>
<?php if (!$antrian_list->tanggal->ReadOnly && !$antrian_list->tanggal->Disabled && !isset($antrian_list->tanggal->EditAttrs["readonly"]) && !isset($antrian_list->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fantrianlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fantrianlist", "x<?php echo $antrian_list->RowIndex ?>_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($antrian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_tanggal">
<span<?php echo $antrian_list->tanggal->viewAttributes() ?>><?php echo $antrian_list->tanggal->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($antrian->RowType == ROWTYPE_EDIT || $antrian->CurrentMode == "edit") { ?>
<input type="hidden" data-table="antrian" data-field="x_id" name="x<?php echo $antrian_list->RowIndex ?>_id" id="x<?php echo $antrian_list->RowIndex ?>_id" value="<?php echo HtmlEncode($antrian_list->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($antrian_list->nomor_antrian->Visible) { // nomor_antrian ?>
		<td data-name="nomor_antrian" <?php echo $antrian_list->nomor_antrian->cellAttributes() ?>>
<?php if ($antrian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_nomor_antrian" class="form-group">
<input type="text" data-table="antrian" data-field="x_nomor_antrian" name="x<?php echo $antrian_list->RowIndex ?>_nomor_antrian" id="x<?php echo $antrian_list->RowIndex ?>_nomor_antrian" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($antrian_list->nomor_antrian->getPlaceHolder()) ?>" value="<?php echo $antrian_list->nomor_antrian->EditValue ?>"<?php echo $antrian_list->nomor_antrian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($antrian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_nomor_antrian">
<span<?php echo $antrian_list->nomor_antrian->viewAttributes() ?>><?php echo $antrian_list->nomor_antrian->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($antrian_list->keperluan->Visible) { // keperluan ?>
		<td data-name="keperluan" <?php echo $antrian_list->keperluan->cellAttributes() ?>>
<?php if ($antrian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_keperluan" class="form-group">
<input type="text" data-table="antrian" data-field="x_keperluan" name="x<?php echo $antrian_list->RowIndex ?>_keperluan" id="x<?php echo $antrian_list->RowIndex ?>_keperluan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($antrian_list->keperluan->getPlaceHolder()) ?>" value="<?php echo $antrian_list->keperluan->EditValue ?>"<?php echo $antrian_list->keperluan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($antrian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_keperluan">
<span<?php echo $antrian_list->keperluan->viewAttributes() ?>><?php echo $antrian_list->keperluan->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($antrian_list->nama_klinik->Visible) { // nama_klinik ?>
		<td data-name="nama_klinik" <?php echo $antrian_list->nama_klinik->cellAttributes() ?>>
<?php if ($antrian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_nama_klinik" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="antrian" data-field="x_nama_klinik" data-value-separator="<?php echo $antrian_list->nama_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $antrian_list->RowIndex ?>_nama_klinik" name="x<?php echo $antrian_list->RowIndex ?>_nama_klinik"<?php echo $antrian_list->nama_klinik->editAttributes() ?>>
			<?php echo $antrian_list->nama_klinik->selectOptionListHtml("x{$antrian_list->RowIndex}_nama_klinik") ?>
		</select>
</div>
<?php echo $antrian_list->nama_klinik->Lookup->getParamTag($antrian_list, "p_x" . $antrian_list->RowIndex . "_nama_klinik") ?>
</span>
<?php } ?>
<?php if ($antrian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_nama_klinik">
<span<?php echo $antrian_list->nama_klinik->viewAttributes() ?>><?php echo $antrian_list->nama_klinik->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($antrian_list->selesai->Visible) { // selesai ?>
		<td data-name="selesai" <?php echo $antrian_list->selesai->cellAttributes() ?>>
<?php if ($antrian->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_selesai" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="antrian" data-field="x_selesai" data-value-separator="<?php echo $antrian_list->selesai->displayValueSeparatorAttribute() ?>" id="x<?php echo $antrian_list->RowIndex ?>_selesai" name="x<?php echo $antrian_list->RowIndex ?>_selesai"<?php echo $antrian_list->selesai->editAttributes() ?>>
			<?php echo $antrian_list->selesai->selectOptionListHtml("x{$antrian_list->RowIndex}_selesai") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($antrian->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $antrian_list->RowCount ?>_antrian_selesai">
<span<?php echo $antrian_list->selesai->viewAttributes() ?>><?php echo $antrian_list->selesai->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$antrian_list->ListOptions->render("body", "right", $antrian_list->RowCount);
?>
	</tr>
<?php if ($antrian->RowType == ROWTYPE_ADD || $antrian->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fantrianlist", "load"], function() {
	fantrianlist.updateLists(<?php echo $antrian_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$antrian_list->isGridAdd())
		$antrian_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($antrian_list->isAdd() || $antrian_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $antrian_list->FormKeyCountName ?>" id="<?php echo $antrian_list->FormKeyCountName ?>" value="<?php echo $antrian_list->KeyCount ?>">
<?php } ?>
<?php if ($antrian_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $antrian_list->FormKeyCountName ?>" id="<?php echo $antrian_list->FormKeyCountName ?>" value="<?php echo $antrian_list->KeyCount ?>">
<?php } ?>
<?php if (!$antrian->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($antrian_list->Recordset)
	$antrian_list->Recordset->Close();
?>
<?php if (!$antrian_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$antrian_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $antrian_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $antrian_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($antrian_list->TotalRecords == 0 && !$antrian->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $antrian_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$antrian_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$antrian_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$antrian_list->terminate();
?>