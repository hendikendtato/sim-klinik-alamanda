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
$detailrekmedterapis_list = new detailrekmedterapis_list();

// Run the page
$detailrekmedterapis_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailrekmedterapis_list->isExport()) { ?>
<script>
var fdetailrekmedterapislist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailrekmedterapislist = currentForm = new ew.Form("fdetailrekmedterapislist", "list");
	fdetailrekmedterapislist.formKeyCountName = '<?php echo $detailrekmedterapis_list->FormKeyCountName ?>';

	// Validate form
	fdetailrekmedterapislist.validate = function() {
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
			<?php if ($detailrekmedterapis_list->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_list->id_barang->caption(), $detailrekmedterapis_list->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_list->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_list->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_list->jumlah->caption(), $detailrekmedterapis_list->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_list->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_list->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_list->id_satuan->caption(), $detailrekmedterapis_list->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fdetailrekmedterapislist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedterapislist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedterapislist.lists["x_id_barang"] = <?php echo $detailrekmedterapis_list->id_barang->Lookup->toClientList($detailrekmedterapis_list) ?>;
	fdetailrekmedterapislist.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedterapis_list->id_barang->lookupOptions()) ?>;
	fdetailrekmedterapislist.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedterapislist.lists["x_id_satuan"] = <?php echo $detailrekmedterapis_list->id_satuan->Lookup->toClientList($detailrekmedterapis_list) ?>;
	fdetailrekmedterapislist.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedterapis_list->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedterapislist");
});
var fdetailrekmedterapislistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdetailrekmedterapislistsrch = currentSearchForm = new ew.Form("fdetailrekmedterapislistsrch");

	// Dynamic selection lists
	// Filters

	fdetailrekmedterapislistsrch.filterList = <?php echo $detailrekmedterapis_list->getFilterList() ?>;
	loadjs.done("fdetailrekmedterapislistsrch");
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
<?php if (!$detailrekmedterapis_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailrekmedterapis_list->TotalRecords > 0 && $detailrekmedterapis_list->ExportOptions->visible()) { ?>
<?php $detailrekmedterapis_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmedterapis_list->ImportOptions->visible()) { ?>
<?php $detailrekmedterapis_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmedterapis_list->SearchOptions->visible()) { ?>
<?php $detailrekmedterapis_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($detailrekmedterapis_list->FilterOptions->visible()) { ?>
<?php $detailrekmedterapis_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailrekmedterapis_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailrekmedterapis_list->isExport("print")) { ?>
<?php
if ($detailrekmedterapis_list->DbMasterFilter != "" && $detailrekmedterapis->getCurrentMasterTable() == "rekmeddokter") {
	if ($detailrekmedterapis_list->MasterRecordExists) {
		include_once "rekmeddoktermaster.php";
	}
}
?>
<?php } ?>
<?php
$detailrekmedterapis_list->renderOtherOptions();
?>
<?php $detailrekmedterapis_list->showPageHeader(); ?>
<?php
$detailrekmedterapis_list->showMessage();
?>
<?php if ($detailrekmedterapis_list->TotalRecords > 0 || $detailrekmedterapis->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailrekmedterapis_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailrekmedterapis">
<?php if (!$detailrekmedterapis_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailrekmedterapis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailrekmedterapis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailrekmedterapis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailrekmedterapislist" id="fdetailrekmedterapislist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedterapis">
<?php if ($detailrekmedterapis->getCurrentMasterTable() == "rekmeddokter" && $detailrekmedterapis->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmedterapis_list->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailrekmedterapis" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailrekmedterapis_list->TotalRecords > 0 || $detailrekmedterapis_list->isAdd() || $detailrekmedterapis_list->isCopy() || $detailrekmedterapis_list->isGridEdit()) { ?>
<table id="tbl_detailrekmedterapislist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailrekmedterapis->RowType = ROWTYPE_HEADER;

// Render list options
$detailrekmedterapis_list->renderListOptions();

// Render list options (header, left)
$detailrekmedterapis_list->ListOptions->render("header", "left");
?>
<?php if ($detailrekmedterapis_list->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmedterapis_list->SortUrl($detailrekmedterapis_list->id_barang) == "") { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedterapis_list->id_barang->headerCellClass() ?>"><div id="elh_detailrekmedterapis_id_barang" class="detailrekmedterapis_id_barang"><div class="ew-table-header-caption"><?php echo $detailrekmedterapis_list->id_barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_barang" class="<?php echo $detailrekmedterapis_list->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmedterapis_list->SortUrl($detailrekmedterapis_list->id_barang) ?>', 1);"><div id="elh_detailrekmedterapis_id_barang" class="detailrekmedterapis_id_barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_list->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_list->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_list->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedterapis_list->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmedterapis_list->SortUrl($detailrekmedterapis_list->jumlah) == "") { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedterapis_list->jumlah->headerCellClass() ?>"><div id="elh_detailrekmedterapis_jumlah" class="detailrekmedterapis_jumlah"><div class="ew-table-header-caption"><?php echo $detailrekmedterapis_list->jumlah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah" class="<?php echo $detailrekmedterapis_list->jumlah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmedterapis_list->SortUrl($detailrekmedterapis_list->jumlah) ?>', 1);"><div id="elh_detailrekmedterapis_jumlah" class="detailrekmedterapis_jumlah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_list->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_list->jumlah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_list->jumlah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedterapis_list->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailrekmedterapis_list->SortUrl($detailrekmedterapis_list->id_satuan) == "") { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedterapis_list->id_satuan->headerCellClass() ?>"><div id="elh_detailrekmedterapis_id_satuan" class="detailrekmedterapis_id_satuan"><div class="ew-table-header-caption"><?php echo $detailrekmedterapis_list->id_satuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_satuan" class="<?php echo $detailrekmedterapis_list->id_satuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailrekmedterapis_list->SortUrl($detailrekmedterapis_list->id_satuan) ?>', 1);"><div id="elh_detailrekmedterapis_id_satuan" class="detailrekmedterapis_id_satuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_list->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_list->id_satuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_list->id_satuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmedterapis_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($detailrekmedterapis_list->isAdd() || $detailrekmedterapis_list->isCopy()) {
		$detailrekmedterapis_list->RowIndex = 0;
		$detailrekmedterapis_list->KeyCount = $detailrekmedterapis_list->RowIndex;
		if ($detailrekmedterapis_list->isAdd())
			$detailrekmedterapis_list->loadRowValues();
		if ($detailrekmedterapis->EventCancelled) // Insert failed
			$detailrekmedterapis_list->restoreFormValues(); // Restore form values

		// Set row properties
		$detailrekmedterapis->resetAttributes();
		$detailrekmedterapis->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_detailrekmedterapis", "data-rowtype" => ROWTYPE_ADD]);
		$detailrekmedterapis->RowType = ROWTYPE_ADD;

		// Render row
		$detailrekmedterapis_list->renderRow();

		// Render list options
		$detailrekmedterapis_list->renderListOptions();
		$detailrekmedterapis_list->StartRowCount = 0;
?>
	<tr <?php echo $detailrekmedterapis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedterapis_list->ListOptions->render("body", "left", $detailrekmedterapis_list->RowCount);
?>
	<?php if ($detailrekmedterapis_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang">
<span id="el<?php echo $detailrekmedterapis_list->RowCount ?>_detailrekmedterapis_id_barang" class="form-group detailrekmedterapis_id_barang">
<?php
$onchange = $detailrekmedterapis_list->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_list->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang" id="sv_x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_list->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_list->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_list->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_list->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_list->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_list->id_barang->ReadOnly || $detailrekmedterapis_list->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_list->id_barang->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang" id="x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_list->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapislist"], function() {
	fdetailrekmedterapislist.createAutoSuggest({"id":"x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_list->id_barang->Lookup->getParamTag($detailrekmedterapis_list, "p_x" . $detailrekmedterapis_list->RowIndex . "_id_barang") ?>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" name="o<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang" id="o<?php echo $detailrekmedterapis_list->RowIndex ?>_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_list->id_barang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah">
<span id="el<?php echo $detailrekmedterapis_list->RowCount ?>_detailrekmedterapis_jumlah" class="form-group detailrekmedterapis_jumlah">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x<?php echo $detailrekmedterapis_list->RowIndex ?>_jumlah" id="x<?php echo $detailrekmedterapis_list->RowIndex ?>_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_list->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_list->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_list->jumlah->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_jumlah" name="o<?php echo $detailrekmedterapis_list->RowIndex ?>_jumlah" id="o<?php echo $detailrekmedterapis_list->RowIndex ?>_jumlah" value="<?php echo HtmlEncode($detailrekmedterapis_list->jumlah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan">
<span id="el<?php echo $detailrekmedterapis_list->RowCount ?>_detailrekmedterapis_id_satuan" class="form-group detailrekmedterapis_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_list->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_list->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_list->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_list->id_satuan->ReadOnly || $detailrekmedterapis_list->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_list->id_satuan->Lookup->getParamTag($detailrekmedterapis_list, "p_x" . $detailrekmedterapis_list->RowIndex . "_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_list->id_satuan->displayValueSeparatorAttribute() ?>" name="x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_satuan" id="x<?php echo $detailrekmedterapis_list->RowIndex ?>_id_satuan" value="<?php echo $detailrekmedterapis_list->id_satuan->CurrentValue ?>"<?php echo $detailrekmedterapis_list->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" name="o<?php echo $detailrekmedterapis_list->RowIndex ?>_id_satuan" id="o<?php echo $detailrekmedterapis_list->RowIndex ?>_id_satuan" value="<?php echo HtmlEncode($detailrekmedterapis_list->id_satuan->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedterapis_list->ListOptions->render("body", "right", $detailrekmedterapis_list->RowCount);
?>
<script>
loadjs.ready(["fdetailrekmedterapislist", "load"], function() {
	fdetailrekmedterapislist.updateLists(<?php echo $detailrekmedterapis_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($detailrekmedterapis_list->ExportAll && $detailrekmedterapis_list->isExport()) {
	$detailrekmedterapis_list->StopRecord = $detailrekmedterapis_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailrekmedterapis_list->TotalRecords > $detailrekmedterapis_list->StartRecord + $detailrekmedterapis_list->DisplayRecords - 1)
		$detailrekmedterapis_list->StopRecord = $detailrekmedterapis_list->StartRecord + $detailrekmedterapis_list->DisplayRecords - 1;
	else
		$detailrekmedterapis_list->StopRecord = $detailrekmedterapis_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($detailrekmedterapis->isConfirm() || $detailrekmedterapis_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($detailrekmedterapis_list->FormKeyCountName) && ($detailrekmedterapis_list->isGridAdd() || $detailrekmedterapis_list->isGridEdit() || $detailrekmedterapis->isConfirm())) {
		$detailrekmedterapis_list->KeyCount = $CurrentForm->getValue($detailrekmedterapis_list->FormKeyCountName);
		$detailrekmedterapis_list->StopRecord = $detailrekmedterapis_list->StartRecord + $detailrekmedterapis_list->KeyCount - 1;
	}
}
$detailrekmedterapis_list->RecordCount = $detailrekmedterapis_list->StartRecord - 1;
if ($detailrekmedterapis_list->Recordset && !$detailrekmedterapis_list->Recordset->EOF) {
	$detailrekmedterapis_list->Recordset->moveFirst();
	$selectLimit = $detailrekmedterapis_list->UseSelectLimit;
	if (!$selectLimit && $detailrekmedterapis_list->StartRecord > 1)
		$detailrekmedterapis_list->Recordset->move($detailrekmedterapis_list->StartRecord - 1);
} elseif (!$detailrekmedterapis->AllowAddDeleteRow && $detailrekmedterapis_list->StopRecord == 0) {
	$detailrekmedterapis_list->StopRecord = $detailrekmedterapis->GridAddRowCount;
}

// Initialize aggregate
$detailrekmedterapis->RowType = ROWTYPE_AGGREGATEINIT;
$detailrekmedterapis->resetAttributes();
$detailrekmedterapis_list->renderRow();
while ($detailrekmedterapis_list->RecordCount < $detailrekmedterapis_list->StopRecord) {
	$detailrekmedterapis_list->RecordCount++;
	if ($detailrekmedterapis_list->RecordCount >= $detailrekmedterapis_list->StartRecord) {
		$detailrekmedterapis_list->RowCount++;

		// Set up key count
		$detailrekmedterapis_list->KeyCount = $detailrekmedterapis_list->RowIndex;

		// Init row class and style
		$detailrekmedterapis->resetAttributes();
		$detailrekmedterapis->CssClass = "";
		if ($detailrekmedterapis_list->isGridAdd()) {
			$detailrekmedterapis_list->loadRowValues(); // Load default values
		} else {
			$detailrekmedterapis_list->loadRowValues($detailrekmedterapis_list->Recordset); // Load row values
		}
		$detailrekmedterapis->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailrekmedterapis->RowAttrs->merge(["data-rowindex" => $detailrekmedterapis_list->RowCount, "id" => "r" . $detailrekmedterapis_list->RowCount . "_detailrekmedterapis", "data-rowtype" => $detailrekmedterapis->RowType]);

		// Render row
		$detailrekmedterapis_list->renderRow();

		// Render list options
		$detailrekmedterapis_list->renderListOptions();
?>
	<tr <?php echo $detailrekmedterapis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedterapis_list->ListOptions->render("body", "left", $detailrekmedterapis_list->RowCount);
?>
	<?php if ($detailrekmedterapis_list->id_barang->Visible) { // id_barang ?>
		<td data-name="id_barang" <?php echo $detailrekmedterapis_list->id_barang->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedterapis_list->RowCount ?>_detailrekmedterapis_id_barang">
<span<?php echo $detailrekmedterapis_list->id_barang->viewAttributes() ?>><?php echo $detailrekmedterapis_list->id_barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_list->jumlah->Visible) { // jumlah ?>
		<td data-name="jumlah" <?php echo $detailrekmedterapis_list->jumlah->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedterapis_list->RowCount ?>_detailrekmedterapis_jumlah">
<span<?php echo $detailrekmedterapis_list->jumlah->viewAttributes() ?>><?php echo $detailrekmedterapis_list->jumlah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailrekmedterapis_list->id_satuan->Visible) { // id_satuan ?>
		<td data-name="id_satuan" <?php echo $detailrekmedterapis_list->id_satuan->cellAttributes() ?>>
<span id="el<?php echo $detailrekmedterapis_list->RowCount ?>_detailrekmedterapis_id_satuan">
<span<?php echo $detailrekmedterapis_list->id_satuan->viewAttributes() ?>><?php echo $detailrekmedterapis_list->id_satuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedterapis_list->ListOptions->render("body", "right", $detailrekmedterapis_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailrekmedterapis_list->isGridAdd())
		$detailrekmedterapis_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($detailrekmedterapis_list->isAdd() || $detailrekmedterapis_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $detailrekmedterapis_list->FormKeyCountName ?>" id="<?php echo $detailrekmedterapis_list->FormKeyCountName ?>" value="<?php echo $detailrekmedterapis_list->KeyCount ?>">
<?php } ?>
<?php if (!$detailrekmedterapis->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailrekmedterapis_list->Recordset)
	$detailrekmedterapis_list->Recordset->Close();
?>
<?php if (!$detailrekmedterapis_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailrekmedterapis_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailrekmedterapis_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailrekmedterapis_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailrekmedterapis_list->TotalRecords == 0 && !$detailrekmedterapis->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailrekmedterapis_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailrekmedterapis_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailrekmedterapis_list->isExport()) { ?>
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
$detailrekmedterapis_list->terminate();
?>