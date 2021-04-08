<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$m_akun_list = new m_akun_list();

// Run the page
$m_akun_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_akun_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_akun_list->isExport()) { ?>
<script>
var fm_akunlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_akunlist = currentForm = new ew.Form("fm_akunlist", "list");
	fm_akunlist.formKeyCountName = '<?php echo $m_akun_list->FormKeyCountName ?>';

	// Validate form
	fm_akunlist.validate = function() {
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
			<?php if ($m_akun_list->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_akun_list->id_klinik->caption(), $m_akun_list->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_akun_list->kode_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_akun_list->kode_akun->caption(), $m_akun_list->kode_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_akun_list->nama_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_akun_list->nama_akun->caption(), $m_akun_list->nama_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_akun_list->tipe_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_akun_list->tipe_akun->caption(), $m_akun_list->tipe_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_akun_list->saldo->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_akun_list->saldo->caption(), $m_akun_list->saldo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_akun_list->saldo->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fm_akunlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "id_klinik", false)) return false;
		if (ew.valueChanged(fobj, infix, "kode_akun", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama_akun", false)) return false;
		if (ew.valueChanged(fobj, infix, "tipe_akun", false)) return false;
		if (ew.valueChanged(fobj, infix, "saldo", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fm_akunlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_akunlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_akunlist.lists["x_id_klinik"] = <?php echo $m_akun_list->id_klinik->Lookup->toClientList($m_akun_list) ?>;
	fm_akunlist.lists["x_id_klinik"].options = <?php echo JsonEncode($m_akun_list->id_klinik->lookupOptions()) ?>;
	loadjs.done("fm_akunlist");
});
var fm_akunlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_akunlistsrch = currentSearchForm = new ew.Form("fm_akunlistsrch");

	// Dynamic selection lists
	// Filters

	fm_akunlistsrch.filterList = <?php echo $m_akun_list->getFilterList() ?>;
	loadjs.done("fm_akunlistsrch");
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
<?php if (!$m_akun_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_akun_list->TotalRecords > 0 && $m_akun_list->ExportOptions->visible()) { ?>
<?php $m_akun_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_akun_list->ImportOptions->visible()) { ?>
<?php $m_akun_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_akun_list->SearchOptions->visible()) { ?>
<?php $m_akun_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_akun_list->FilterOptions->visible()) { ?>
<?php $m_akun_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_akun_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_akun_list->isExport() && !$m_akun->CurrentAction) { ?>
<form name="fm_akunlistsrch" id="fm_akunlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_akunlistsrch-search-panel" class="<?php echo $m_akun_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_akun">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_akun_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_akun_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_akun_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_akun_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_akun_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_akun_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_akun_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_akun_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_akun_list->showPageHeader(); ?>
<?php
$m_akun_list->showMessage();
?>
<?php if ($m_akun_list->TotalRecords > 0 || $m_akun->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_akun_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_akun">
<?php if (!$m_akun_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_akun_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_akun_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_akun_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_akunlist" id="fm_akunlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_akun">
<div id="gmp_m_akun" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_akun_list->TotalRecords > 0 || $m_akun_list->isGridEdit()) { ?>
<table id="tbl_m_akunlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_akun->RowType = ROWTYPE_HEADER;

// Render list options
$m_akun_list->renderListOptions();

// Render list options (header, left)
$m_akun_list->ListOptions->render("header", "left");
?>
<?php if ($m_akun_list->id_klinik->Visible) { // id_klinik ?>
	<?php if ($m_akun_list->SortUrl($m_akun_list->id_klinik) == "") { ?>
		<th data-name="id_klinik" class="<?php echo $m_akun_list->id_klinik->headerCellClass() ?>"><div id="elh_m_akun_id_klinik" class="m_akun_id_klinik"><div class="ew-table-header-caption"><?php echo $m_akun_list->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_klinik" class="<?php echo $m_akun_list->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_akun_list->SortUrl($m_akun_list->id_klinik) ?>', 1);"><div id="elh_m_akun_id_klinik" class="m_akun_id_klinik">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_akun_list->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_akun_list->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_akun_list->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_akun_list->kode_akun->Visible) { // kode_akun ?>
	<?php if ($m_akun_list->SortUrl($m_akun_list->kode_akun) == "") { ?>
		<th data-name="kode_akun" class="<?php echo $m_akun_list->kode_akun->headerCellClass() ?>"><div id="elh_m_akun_kode_akun" class="m_akun_kode_akun"><div class="ew-table-header-caption"><?php echo $m_akun_list->kode_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_akun" class="<?php echo $m_akun_list->kode_akun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_akun_list->SortUrl($m_akun_list->kode_akun) ?>', 1);"><div id="elh_m_akun_kode_akun" class="m_akun_kode_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_akun_list->kode_akun->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_akun_list->kode_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_akun_list->kode_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_akun_list->nama_akun->Visible) { // nama_akun ?>
	<?php if ($m_akun_list->SortUrl($m_akun_list->nama_akun) == "") { ?>
		<th data-name="nama_akun" class="<?php echo $m_akun_list->nama_akun->headerCellClass() ?>"><div id="elh_m_akun_nama_akun" class="m_akun_nama_akun"><div class="ew-table-header-caption"><?php echo $m_akun_list->nama_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_akun" class="<?php echo $m_akun_list->nama_akun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_akun_list->SortUrl($m_akun_list->nama_akun) ?>', 1);"><div id="elh_m_akun_nama_akun" class="m_akun_nama_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_akun_list->nama_akun->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_akun_list->nama_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_akun_list->nama_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_akun_list->tipe_akun->Visible) { // tipe_akun ?>
	<?php if ($m_akun_list->SortUrl($m_akun_list->tipe_akun) == "") { ?>
		<th data-name="tipe_akun" class="<?php echo $m_akun_list->tipe_akun->headerCellClass() ?>"><div id="elh_m_akun_tipe_akun" class="m_akun_tipe_akun"><div class="ew-table-header-caption"><?php echo $m_akun_list->tipe_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe_akun" class="<?php echo $m_akun_list->tipe_akun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_akun_list->SortUrl($m_akun_list->tipe_akun) ?>', 1);"><div id="elh_m_akun_tipe_akun" class="m_akun_tipe_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_akun_list->tipe_akun->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_akun_list->tipe_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_akun_list->tipe_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_akun_list->saldo->Visible) { // saldo ?>
	<?php if ($m_akun_list->SortUrl($m_akun_list->saldo) == "") { ?>
		<th data-name="saldo" class="<?php echo $m_akun_list->saldo->headerCellClass() ?>"><div id="elh_m_akun_saldo" class="m_akun_saldo"><div class="ew-table-header-caption"><?php echo $m_akun_list->saldo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="saldo" class="<?php echo $m_akun_list->saldo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_akun_list->SortUrl($m_akun_list->saldo) ?>', 1);"><div id="elh_m_akun_saldo" class="m_akun_saldo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_akun_list->saldo->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_akun_list->saldo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_akun_list->saldo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_akun_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_akun_list->ExportAll && $m_akun_list->isExport()) {
	$m_akun_list->StopRecord = $m_akun_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_akun_list->TotalRecords > $m_akun_list->StartRecord + $m_akun_list->DisplayRecords - 1)
		$m_akun_list->StopRecord = $m_akun_list->StartRecord + $m_akun_list->DisplayRecords - 1;
	else
		$m_akun_list->StopRecord = $m_akun_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($m_akun->isConfirm() || $m_akun_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($m_akun_list->FormKeyCountName) && ($m_akun_list->isGridAdd() || $m_akun_list->isGridEdit() || $m_akun->isConfirm())) {
		$m_akun_list->KeyCount = $CurrentForm->getValue($m_akun_list->FormKeyCountName);
		$m_akun_list->StopRecord = $m_akun_list->StartRecord + $m_akun_list->KeyCount - 1;
	}
}
$m_akun_list->RecordCount = $m_akun_list->StartRecord - 1;
if ($m_akun_list->Recordset && !$m_akun_list->Recordset->EOF) {
	$m_akun_list->Recordset->moveFirst();
	$selectLimit = $m_akun_list->UseSelectLimit;
	if (!$selectLimit && $m_akun_list->StartRecord > 1)
		$m_akun_list->Recordset->move($m_akun_list->StartRecord - 1);
} elseif (!$m_akun->AllowAddDeleteRow && $m_akun_list->StopRecord == 0) {
	$m_akun_list->StopRecord = $m_akun->GridAddRowCount;
}

// Initialize aggregate
$m_akun->RowType = ROWTYPE_AGGREGATEINIT;
$m_akun->resetAttributes();
$m_akun_list->renderRow();
if ($m_akun_list->isGridAdd())
	$m_akun_list->RowIndex = 0;
while ($m_akun_list->RecordCount < $m_akun_list->StopRecord) {
	$m_akun_list->RecordCount++;
	if ($m_akun_list->RecordCount >= $m_akun_list->StartRecord) {
		$m_akun_list->RowCount++;
		if ($m_akun_list->isGridAdd() || $m_akun_list->isGridEdit() || $m_akun->isConfirm()) {
			$m_akun_list->RowIndex++;
			$CurrentForm->Index = $m_akun_list->RowIndex;
			if ($CurrentForm->hasValue($m_akun_list->FormActionName) && ($m_akun->isConfirm() || $m_akun_list->EventCancelled))
				$m_akun_list->RowAction = strval($CurrentForm->getValue($m_akun_list->FormActionName));
			elseif ($m_akun_list->isGridAdd())
				$m_akun_list->RowAction = "insert";
			else
				$m_akun_list->RowAction = "";
		}

		// Set up key count
		$m_akun_list->KeyCount = $m_akun_list->RowIndex;

		// Init row class and style
		$m_akun->resetAttributes();
		$m_akun->CssClass = "";
		if ($m_akun_list->isGridAdd()) {
			$m_akun_list->loadRowValues(); // Load default values
		} else {
			$m_akun_list->loadRowValues($m_akun_list->Recordset); // Load row values
		}
		$m_akun->RowType = ROWTYPE_VIEW; // Render view
		if ($m_akun_list->isGridAdd()) // Grid add
			$m_akun->RowType = ROWTYPE_ADD; // Render add
		if ($m_akun_list->isGridAdd() && $m_akun->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$m_akun_list->restoreCurrentRowFormValues($m_akun_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$m_akun->RowAttrs->merge(["data-rowindex" => $m_akun_list->RowCount, "id" => "r" . $m_akun_list->RowCount . "_m_akun", "data-rowtype" => $m_akun->RowType]);

		// Render row
		$m_akun_list->renderRow();

		// Render list options
		$m_akun_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($m_akun_list->RowAction != "delete" && $m_akun_list->RowAction != "insertdelete" && !($m_akun_list->RowAction == "insert" && $m_akun->isConfirm() && $m_akun_list->emptyRow())) {
?>
	<tr <?php echo $m_akun->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_akun_list->ListOptions->render("body", "left", $m_akun_list->RowCount);
?>
	<?php if ($m_akun_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik" <?php echo $m_akun_list->id_klinik->cellAttributes() ?>>
<?php if ($m_akun->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_id_klinik" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_akun" data-field="x_id_klinik" data-value-separator="<?php echo $m_akun_list->id_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $m_akun_list->RowIndex ?>_id_klinik" name="x<?php echo $m_akun_list->RowIndex ?>_id_klinik"<?php echo $m_akun_list->id_klinik->editAttributes() ?>>
			<?php echo $m_akun_list->id_klinik->selectOptionListHtml("x{$m_akun_list->RowIndex}_id_klinik") ?>
		</select>
</div>
<?php echo $m_akun_list->id_klinik->Lookup->getParamTag($m_akun_list, "p_x" . $m_akun_list->RowIndex . "_id_klinik") ?>
</span>
<input type="hidden" data-table="m_akun" data-field="x_id_klinik" name="o<?php echo $m_akun_list->RowIndex ?>_id_klinik" id="o<?php echo $m_akun_list->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($m_akun_list->id_klinik->OldValue) ?>">
<?php } ?>
<?php if ($m_akun->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_id_klinik">
<span<?php echo $m_akun_list->id_klinik->viewAttributes() ?>><?php echo $m_akun_list->id_klinik->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_akun_list->kode_akun->Visible) { // kode_akun ?>
		<td data-name="kode_akun" <?php echo $m_akun_list->kode_akun->cellAttributes() ?>>
<?php if ($m_akun->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_kode_akun" class="form-group">
<input type="text" data-table="m_akun" data-field="x_kode_akun" name="x<?php echo $m_akun_list->RowIndex ?>_kode_akun" id="x<?php echo $m_akun_list->RowIndex ?>_kode_akun" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_akun_list->kode_akun->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->kode_akun->EditValue ?>"<?php echo $m_akun_list->kode_akun->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_kode_akun" name="o<?php echo $m_akun_list->RowIndex ?>_kode_akun" id="o<?php echo $m_akun_list->RowIndex ?>_kode_akun" value="<?php echo HtmlEncode($m_akun_list->kode_akun->OldValue) ?>">
<?php } ?>
<?php if ($m_akun->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_kode_akun">
<span<?php echo $m_akun_list->kode_akun->viewAttributes() ?>><?php echo $m_akun_list->kode_akun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_akun_list->nama_akun->Visible) { // nama_akun ?>
		<td data-name="nama_akun" <?php echo $m_akun_list->nama_akun->cellAttributes() ?>>
<?php if ($m_akun->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_nama_akun" class="form-group">
<input type="text" data-table="m_akun" data-field="x_nama_akun" name="x<?php echo $m_akun_list->RowIndex ?>_nama_akun" id="x<?php echo $m_akun_list->RowIndex ?>_nama_akun" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($m_akun_list->nama_akun->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->nama_akun->EditValue ?>"<?php echo $m_akun_list->nama_akun->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_nama_akun" name="o<?php echo $m_akun_list->RowIndex ?>_nama_akun" id="o<?php echo $m_akun_list->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($m_akun_list->nama_akun->OldValue) ?>">
<?php } ?>
<?php if ($m_akun->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_nama_akun">
<span<?php echo $m_akun_list->nama_akun->viewAttributes() ?>><?php echo $m_akun_list->nama_akun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_akun_list->tipe_akun->Visible) { // tipe_akun ?>
		<td data-name="tipe_akun" <?php echo $m_akun_list->tipe_akun->cellAttributes() ?>>
<?php if ($m_akun->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_tipe_akun" class="form-group">
<input type="text" data-table="m_akun" data-field="x_tipe_akun" name="x<?php echo $m_akun_list->RowIndex ?>_tipe_akun" id="x<?php echo $m_akun_list->RowIndex ?>_tipe_akun" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_akun_list->tipe_akun->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->tipe_akun->EditValue ?>"<?php echo $m_akun_list->tipe_akun->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_tipe_akun" name="o<?php echo $m_akun_list->RowIndex ?>_tipe_akun" id="o<?php echo $m_akun_list->RowIndex ?>_tipe_akun" value="<?php echo HtmlEncode($m_akun_list->tipe_akun->OldValue) ?>">
<?php } ?>
<?php if ($m_akun->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_tipe_akun">
<span<?php echo $m_akun_list->tipe_akun->viewAttributes() ?>><?php echo $m_akun_list->tipe_akun->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($m_akun_list->saldo->Visible) { // saldo ?>
		<td data-name="saldo" <?php echo $m_akun_list->saldo->cellAttributes() ?>>
<?php if ($m_akun->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_saldo" class="form-group">
<input type="text" data-table="m_akun" data-field="x_saldo" name="x<?php echo $m_akun_list->RowIndex ?>_saldo" id="x<?php echo $m_akun_list->RowIndex ?>_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_akun_list->saldo->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->saldo->EditValue ?>"<?php echo $m_akun_list->saldo->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_saldo" name="o<?php echo $m_akun_list->RowIndex ?>_saldo" id="o<?php echo $m_akun_list->RowIndex ?>_saldo" value="<?php echo HtmlEncode($m_akun_list->saldo->OldValue) ?>">
<?php } ?>
<?php if ($m_akun->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $m_akun_list->RowCount ?>_m_akun_saldo">
<span<?php echo $m_akun_list->saldo->viewAttributes() ?>><?php echo $m_akun_list->saldo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_akun_list->ListOptions->render("body", "right", $m_akun_list->RowCount);
?>
	</tr>
<?php if ($m_akun->RowType == ROWTYPE_ADD || $m_akun->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fm_akunlist", "load"], function() {
	fm_akunlist.updateLists(<?php echo $m_akun_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$m_akun_list->isGridAdd())
		if (!$m_akun_list->Recordset->EOF)
			$m_akun_list->Recordset->moveNext();
}
?>
<?php
	if ($m_akun_list->isGridAdd() || $m_akun_list->isGridEdit()) {
		$m_akun_list->RowIndex = '$rowindex$';
		$m_akun_list->loadRowValues();

		// Set row properties
		$m_akun->resetAttributes();
		$m_akun->RowAttrs->merge(["data-rowindex" => $m_akun_list->RowIndex, "id" => "r0_m_akun", "data-rowtype" => ROWTYPE_ADD]);
		$m_akun->RowAttrs->appendClass("ew-template");
		$m_akun->RowType = ROWTYPE_ADD;

		// Render row
		$m_akun_list->renderRow();

		// Render list options
		$m_akun_list->renderListOptions();
		$m_akun_list->StartRowCount = 0;
?>
	<tr <?php echo $m_akun->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_akun_list->ListOptions->render("body", "left", $m_akun_list->RowIndex);
?>
	<?php if ($m_akun_list->id_klinik->Visible) { // id_klinik ?>
		<td data-name="id_klinik">
<span id="el$rowindex$_m_akun_id_klinik" class="form-group m_akun_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_akun" data-field="x_id_klinik" data-value-separator="<?php echo $m_akun_list->id_klinik->displayValueSeparatorAttribute() ?>" id="x<?php echo $m_akun_list->RowIndex ?>_id_klinik" name="x<?php echo $m_akun_list->RowIndex ?>_id_klinik"<?php echo $m_akun_list->id_klinik->editAttributes() ?>>
			<?php echo $m_akun_list->id_klinik->selectOptionListHtml("x{$m_akun_list->RowIndex}_id_klinik") ?>
		</select>
</div>
<?php echo $m_akun_list->id_klinik->Lookup->getParamTag($m_akun_list, "p_x" . $m_akun_list->RowIndex . "_id_klinik") ?>
</span>
<input type="hidden" data-table="m_akun" data-field="x_id_klinik" name="o<?php echo $m_akun_list->RowIndex ?>_id_klinik" id="o<?php echo $m_akun_list->RowIndex ?>_id_klinik" value="<?php echo HtmlEncode($m_akun_list->id_klinik->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_akun_list->kode_akun->Visible) { // kode_akun ?>
		<td data-name="kode_akun">
<span id="el$rowindex$_m_akun_kode_akun" class="form-group m_akun_kode_akun">
<input type="text" data-table="m_akun" data-field="x_kode_akun" name="x<?php echo $m_akun_list->RowIndex ?>_kode_akun" id="x<?php echo $m_akun_list->RowIndex ?>_kode_akun" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_akun_list->kode_akun->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->kode_akun->EditValue ?>"<?php echo $m_akun_list->kode_akun->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_kode_akun" name="o<?php echo $m_akun_list->RowIndex ?>_kode_akun" id="o<?php echo $m_akun_list->RowIndex ?>_kode_akun" value="<?php echo HtmlEncode($m_akun_list->kode_akun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_akun_list->nama_akun->Visible) { // nama_akun ?>
		<td data-name="nama_akun">
<span id="el$rowindex$_m_akun_nama_akun" class="form-group m_akun_nama_akun">
<input type="text" data-table="m_akun" data-field="x_nama_akun" name="x<?php echo $m_akun_list->RowIndex ?>_nama_akun" id="x<?php echo $m_akun_list->RowIndex ?>_nama_akun" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($m_akun_list->nama_akun->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->nama_akun->EditValue ?>"<?php echo $m_akun_list->nama_akun->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_nama_akun" name="o<?php echo $m_akun_list->RowIndex ?>_nama_akun" id="o<?php echo $m_akun_list->RowIndex ?>_nama_akun" value="<?php echo HtmlEncode($m_akun_list->nama_akun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_akun_list->tipe_akun->Visible) { // tipe_akun ?>
		<td data-name="tipe_akun">
<span id="el$rowindex$_m_akun_tipe_akun" class="form-group m_akun_tipe_akun">
<input type="text" data-table="m_akun" data-field="x_tipe_akun" name="x<?php echo $m_akun_list->RowIndex ?>_tipe_akun" id="x<?php echo $m_akun_list->RowIndex ?>_tipe_akun" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_akun_list->tipe_akun->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->tipe_akun->EditValue ?>"<?php echo $m_akun_list->tipe_akun->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_tipe_akun" name="o<?php echo $m_akun_list->RowIndex ?>_tipe_akun" id="o<?php echo $m_akun_list->RowIndex ?>_tipe_akun" value="<?php echo HtmlEncode($m_akun_list->tipe_akun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($m_akun_list->saldo->Visible) { // saldo ?>
		<td data-name="saldo">
<span id="el$rowindex$_m_akun_saldo" class="form-group m_akun_saldo">
<input type="text" data-table="m_akun" data-field="x_saldo" name="x<?php echo $m_akun_list->RowIndex ?>_saldo" id="x<?php echo $m_akun_list->RowIndex ?>_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_akun_list->saldo->getPlaceHolder()) ?>" value="<?php echo $m_akun_list->saldo->EditValue ?>"<?php echo $m_akun_list->saldo->editAttributes() ?>>
</span>
<input type="hidden" data-table="m_akun" data-field="x_saldo" name="o<?php echo $m_akun_list->RowIndex ?>_saldo" id="o<?php echo $m_akun_list->RowIndex ?>_saldo" value="<?php echo HtmlEncode($m_akun_list->saldo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_akun_list->ListOptions->render("body", "right", $m_akun_list->RowIndex);
?>
<script>
loadjs.ready(["fm_akunlist", "load"], function() {
	fm_akunlist.updateLists(<?php echo $m_akun_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($m_akun_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $m_akun_list->FormKeyCountName ?>" id="<?php echo $m_akun_list->FormKeyCountName ?>" value="<?php echo $m_akun_list->KeyCount ?>">
<?php echo $m_akun_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$m_akun->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_akun_list->Recordset)
	$m_akun_list->Recordset->Close();
?>
<?php if (!$m_akun_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_akun_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_akun_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_akun_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_akun_list->TotalRecords == 0 && !$m_akun->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_akun_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_akun_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_akun_list->isExport()) { ?>
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
$m_akun_list->terminate();
?>