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
$mutasi_kas_search = new mutasi_kas_search();

// Run the page
$mutasi_kas_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mutasi_kas_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmutasi_kassearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($mutasi_kas_search->IsModal) { ?>
	fmutasi_kassearch = currentAdvancedSearchForm = new ew.Form("fmutasi_kassearch", "search");
	<?php } else { ?>
	fmutasi_kassearch = currentForm = new ew.Form("fmutasi_kassearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fmutasi_kassearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgl");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($mutasi_kas_search->tgl->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmutasi_kassearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmutasi_kassearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmutasi_kassearch.lists["x_id_klinik"] = <?php echo $mutasi_kas_search->id_klinik->Lookup->toClientList($mutasi_kas_search) ?>;
	fmutasi_kassearch.lists["x_id_klinik"].options = <?php echo JsonEncode($mutasi_kas_search->id_klinik->lookupOptions()) ?>;
	fmutasi_kassearch.lists["x_id_kas"] = <?php echo $mutasi_kas_search->id_kas->Lookup->toClientList($mutasi_kas_search) ?>;
	fmutasi_kassearch.lists["x_id_kas"].options = <?php echo JsonEncode($mutasi_kas_search->id_kas->lookupOptions()) ?>;
	fmutasi_kassearch.lists["x_tipe"] = <?php echo $mutasi_kas_search->tipe->Lookup->toClientList($mutasi_kas_search) ?>;
	fmutasi_kassearch.lists["x_tipe"].options = <?php echo JsonEncode($mutasi_kas_search->tipe->options(FALSE, TRUE)) ?>;
	loadjs.done("fmutasi_kassearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mutasi_kas_search->showPageHeader(); ?>
<?php
$mutasi_kas_search->showMessage();
?>
<form name="fmutasi_kassearch" id="fmutasi_kassearch" class="<?php echo $mutasi_kas_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mutasi_kas">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$mutasi_kas_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($mutasi_kas_search->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label for="x_tgl" class="<?php echo $mutasi_kas_search->LeftColumnClass ?>"><span id="elh_mutasi_kas_tgl"><?php echo $mutasi_kas_search->tgl->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_tgl" id="z_tgl" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $mutasi_kas_search->RightColumnClass ?>"><div <?php echo $mutasi_kas_search->tgl->cellAttributes() ?>>
			<span id="el_mutasi_kas_tgl" class="ew-search-field">
<input type="text" data-table="mutasi_kas" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($mutasi_kas_search->tgl->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_search->tgl->EditValue ?>"<?php echo $mutasi_kas_search->tgl->editAttributes() ?>>
<?php if (!$mutasi_kas_search->tgl->ReadOnly && !$mutasi_kas_search->tgl->Disabled && !isset($mutasi_kas_search->tgl->EditAttrs["readonly"]) && !isset($mutasi_kas_search->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmutasi_kassearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fmutasi_kassearch", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_mutasi_kas_tgl" class="ew-search-field2">
<input type="text" data-table="mutasi_kas" data-field="x_tgl" name="y_tgl" id="y_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($mutasi_kas_search->tgl->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_search->tgl->EditValue2 ?>"<?php echo $mutasi_kas_search->tgl->editAttributes() ?>>
<?php if (!$mutasi_kas_search->tgl->ReadOnly && !$mutasi_kas_search->tgl->Disabled && !isset($mutasi_kas_search->tgl->EditAttrs["readonly"]) && !isset($mutasi_kas_search->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmutasi_kassearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fmutasi_kassearch", "y_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $mutasi_kas_search->LeftColumnClass ?>"><span id="elh_mutasi_kas_id_klinik"><?php echo $mutasi_kas_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $mutasi_kas_search->RightColumnClass ?>"><div <?php echo $mutasi_kas_search->id_klinik->cellAttributes() ?>>
			<span id="el_mutasi_kas_id_klinik" class="ew-search-field">
<?php $mutasi_kas_search->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_id_klinik" data-value-separator="<?php echo $mutasi_kas_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $mutasi_kas_search->id_klinik->editAttributes() ?>>
			<?php echo $mutasi_kas_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $mutasi_kas_search->id_klinik->Lookup->getParamTag($mutasi_kas_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_search->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label for="x_id_kas" class="<?php echo $mutasi_kas_search->LeftColumnClass ?>"><span id="elh_mutasi_kas_id_kas"><?php echo $mutasi_kas_search->id_kas->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kas" id="z_id_kas" value="=">
</span>
		</label>
		<div class="<?php echo $mutasi_kas_search->RightColumnClass ?>"><div <?php echo $mutasi_kas_search->id_kas->cellAttributes() ?>>
			<span id="el_mutasi_kas_id_kas" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_id_kas" data-value-separator="<?php echo $mutasi_kas_search->id_kas->displayValueSeparatorAttribute() ?>" id="x_id_kas" name="x_id_kas"<?php echo $mutasi_kas_search->id_kas->editAttributes() ?>>
			<?php echo $mutasi_kas_search->id_kas->selectOptionListHtml("x_id_kas") ?>
		</select>
</div>
<?php echo $mutasi_kas_search->id_kas->Lookup->getParamTag($mutasi_kas_search, "p_x_id_kas") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_search->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label class="<?php echo $mutasi_kas_search->LeftColumnClass ?>"><span id="elh_mutasi_kas_tipe"><?php echo $mutasi_kas_search->tipe->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tipe" id="z_tipe" value="=">
</span>
		</label>
		<div class="<?php echo $mutasi_kas_search->RightColumnClass ?>"><div <?php echo $mutasi_kas_search->tipe->cellAttributes() ?>>
			<span id="el_mutasi_kas_tipe" class="ew-search-field">
<div id="tp_x_tipe" class="ew-template"><input type="radio" class="custom-control-input" data-table="mutasi_kas" data-field="x_tipe" data-value-separator="<?php echo $mutasi_kas_search->tipe->displayValueSeparatorAttribute() ?>" name="x_tipe" id="x_tipe" value="{value}"<?php echo $mutasi_kas_search->tipe->editAttributes() ?>></div>
<div id="dsl_x_tipe" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mutasi_kas_search->tipe->radioButtonListHtml(FALSE, "x_tipe") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_search->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label for="x_keterangan" class="<?php echo $mutasi_kas_search->LeftColumnClass ?>"><span id="elh_mutasi_kas_keterangan"><?php echo $mutasi_kas_search->keterangan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keterangan" id="z_keterangan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $mutasi_kas_search->RightColumnClass ?>"><div <?php echo $mutasi_kas_search->keterangan->cellAttributes() ?>>
			<span id="el_mutasi_kas_keterangan" class="ew-search-field">
<input type="text" data-table="mutasi_kas" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($mutasi_kas_search->keterangan->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_search->keterangan->EditValue ?>"<?php echo $mutasi_kas_search->keterangan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mutasi_kas_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mutasi_kas_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mutasi_kas_search->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$mutasi_kas_search->terminate();
?>