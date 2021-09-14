<?php
namespace PHPMaker2020\sim_klinik_alamanda;

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
$terimagudang_search = new terimagudang_search();

// Run the page
$terimagudang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimagudang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterimagudangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($terimagudang_search->IsModal) { ?>
	fterimagudangsearch = currentAdvancedSearchForm = new ew.Form("fterimagudangsearch", "search");
	<?php } else { ?>
	fterimagudangsearch = currentForm = new ew.Form("fterimagudangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fterimagudangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_terimagudang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($terimagudang_search->id_terimagudang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_diterima");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($terimagudang_search->diterima->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal_terima");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($terimagudang_search->tanggal_terima->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fterimagudangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fterimagudangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fterimagudangsearch.lists["x_id_klinik"] = <?php echo $terimagudang_search->id_klinik->Lookup->toClientList($terimagudang_search) ?>;
	fterimagudangsearch.lists["x_id_klinik"].options = <?php echo JsonEncode($terimagudang_search->id_klinik->lookupOptions()) ?>;
	fterimagudangsearch.lists["x_diterima"] = <?php echo $terimagudang_search->diterima->Lookup->toClientList($terimagudang_search) ?>;
	fterimagudangsearch.lists["x_diterima"].options = <?php echo JsonEncode($terimagudang_search->diterima->lookupOptions()) ?>;
	fterimagudangsearch.autoSuggests["x_diterima"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fterimagudangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terimagudang_search->showPageHeader(); ?>
<?php
$terimagudang_search->showMessage();
?>
<form name="fterimagudangsearch" id="fterimagudangsearch" class="<?php echo $terimagudang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimagudang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$terimagudang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($terimagudang_search->id_terimagudang->Visible) { // id_terimagudang ?>
	<div id="r_id_terimagudang" class="form-group row">
		<label for="x_id_terimagudang" class="<?php echo $terimagudang_search->LeftColumnClass ?>"><span id="elh_terimagudang_id_terimagudang"><?php echo $terimagudang_search->id_terimagudang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_terimagudang" id="z_id_terimagudang" value="=">
</span>
		</label>
		<div class="<?php echo $terimagudang_search->RightColumnClass ?>"><div <?php echo $terimagudang_search->id_terimagudang->cellAttributes() ?>>
			<span id="el_terimagudang_id_terimagudang" class="ew-search-field">
<input type="text" data-table="terimagudang" data-field="x_id_terimagudang" name="x_id_terimagudang" id="x_id_terimagudang" maxlength="11" placeholder="<?php echo HtmlEncode($terimagudang_search->id_terimagudang->getPlaceHolder()) ?>" value="<?php echo $terimagudang_search->id_terimagudang->EditValue ?>"<?php echo $terimagudang_search->id_terimagudang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_search->kode_terimagudang->Visible) { // kode_terimagudang ?>
	<div id="r_kode_terimagudang" class="form-group row">
		<label for="x_kode_terimagudang" class="<?php echo $terimagudang_search->LeftColumnClass ?>"><span id="elh_terimagudang_kode_terimagudang"><?php echo $terimagudang_search->kode_terimagudang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_terimagudang" id="z_kode_terimagudang" value="LIKE">
</span>
		</label>
		<div class="<?php echo $terimagudang_search->RightColumnClass ?>"><div <?php echo $terimagudang_search->kode_terimagudang->cellAttributes() ?>>
			<span id="el_terimagudang_kode_terimagudang" class="ew-search-field">
<input type="text" data-table="terimagudang" data-field="x_kode_terimagudang" name="x_kode_terimagudang" id="x_kode_terimagudang" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($terimagudang_search->kode_terimagudang->getPlaceHolder()) ?>" value="<?php echo $terimagudang_search->kode_terimagudang->EditValue ?>"<?php echo $terimagudang_search->kode_terimagudang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $terimagudang_search->LeftColumnClass ?>"><span id="elh_terimagudang_id_klinik"><?php echo $terimagudang_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $terimagudang_search->RightColumnClass ?>"><div <?php echo $terimagudang_search->id_klinik->cellAttributes() ?>>
			<span id="el_terimagudang_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimagudang" data-field="x_id_klinik" data-value-separator="<?php echo $terimagudang_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $terimagudang_search->id_klinik->editAttributes() ?>>
			<?php echo $terimagudang_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $terimagudang_search->id_klinik->Lookup->getParamTag($terimagudang_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_search->diterima->Visible) { // diterima ?>
	<div id="r_diterima" class="form-group row">
		<label class="<?php echo $terimagudang_search->LeftColumnClass ?>"><span id="elh_terimagudang_diterima"><?php echo $terimagudang_search->diterima->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_diterima" id="z_diterima" value="=">
</span>
		</label>
		<div class="<?php echo $terimagudang_search->RightColumnClass ?>"><div <?php echo $terimagudang_search->diterima->cellAttributes() ?>>
			<span id="el_terimagudang_diterima" class="ew-search-field">
<?php
$onchange = $terimagudang_search->diterima->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$terimagudang_search->diterima->EditAttrs["onchange"] = "";
?>
<span id="as_x_diterima">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_diterima" id="sv_x_diterima" value="<?php echo RemoveHtml($terimagudang_search->diterima->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($terimagudang_search->diterima->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($terimagudang_search->diterima->getPlaceHolder()) ?>"<?php echo $terimagudang_search->diterima->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($terimagudang_search->diterima->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_diterima',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($terimagudang_search->diterima->ReadOnly || $terimagudang_search->diterima->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="terimagudang" data-field="x_diterima" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $terimagudang_search->diterima->displayValueSeparatorAttribute() ?>" name="x_diterima" id="x_diterima" value="<?php echo HtmlEncode($terimagudang_search->diterima->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fterimagudangsearch"], function() {
	fterimagudangsearch.createAutoSuggest({"id":"x_diterima","forceSelect":true});
});
</script>
<?php echo $terimagudang_search->diterima->Lookup->getParamTag($terimagudang_search, "p_x_diterima") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_search->tanggal_terima->Visible) { // tanggal_terima ?>
	<div id="r_tanggal_terima" class="form-group row">
		<label for="x_tanggal_terima" class="<?php echo $terimagudang_search->LeftColumnClass ?>"><span id="elh_terimagudang_tanggal_terima"><?php echo $terimagudang_search->tanggal_terima->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal_terima" id="z_tanggal_terima" value="=">
</span>
		</label>
		<div class="<?php echo $terimagudang_search->RightColumnClass ?>"><div <?php echo $terimagudang_search->tanggal_terima->cellAttributes() ?>>
			<span id="el_terimagudang_tanggal_terima" class="ew-search-field">
<input type="text" data-table="terimagudang" data-field="x_tanggal_terima" data-format="7" name="x_tanggal_terima" id="x_tanggal_terima" maxlength="10" placeholder="<?php echo HtmlEncode($terimagudang_search->tanggal_terima->getPlaceHolder()) ?>" value="<?php echo $terimagudang_search->tanggal_terima->EditValue ?>"<?php echo $terimagudang_search->tanggal_terima->editAttributes() ?>>
<?php if (!$terimagudang_search->tanggal_terima->ReadOnly && !$terimagudang_search->tanggal_terima->Disabled && !isset($terimagudang_search->tanggal_terima->EditAttrs["readonly"]) && !isset($terimagudang_search->tanggal_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fterimagudangsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fterimagudangsearch", "x_tanggal_terima", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_search->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label for="x_keterangan" class="<?php echo $terimagudang_search->LeftColumnClass ?>"><span id="elh_terimagudang_keterangan"><?php echo $terimagudang_search->keterangan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keterangan" id="z_keterangan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $terimagudang_search->RightColumnClass ?>"><div <?php echo $terimagudang_search->keterangan->cellAttributes() ?>>
			<span id="el_terimagudang_keterangan" class="ew-search-field">
<input type="text" data-table="terimagudang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" maxlength="255" placeholder="<?php echo HtmlEncode($terimagudang_search->keterangan->getPlaceHolder()) ?>" value="<?php echo $terimagudang_search->keterangan->EditValue ?>"<?php echo $terimagudang_search->keterangan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$terimagudang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terimagudang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$terimagudang_search->showPageFooter();
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
$terimagudang_search->terminate();
?>