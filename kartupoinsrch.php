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
$kartupoin_search = new kartupoin_search();

// Run the page
$kartupoin_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartupoin_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkartupoinsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($kartupoin_search->IsModal) { ?>
	fkartupoinsearch = currentAdvancedSearchForm = new ew.Form("fkartupoinsearch", "search");
	<?php } else { ?>
	fkartupoinsearch = currentForm = new ew.Form("fkartupoinsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fkartupoinsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_penyesuaian_poin");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartupoin_search->id_penyesuaian_poin->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartupoin_search->tgl->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_masuk_penyesuaian");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartupoin_search->masuk_penyesuaian->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_keluar_penyesuaian");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartupoin_search->keluar_penyesuaian->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fkartupoinsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkartupoinsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkartupoinsearch.lists["x_id_pelanggan"] = <?php echo $kartupoin_search->id_pelanggan->Lookup->toClientList($kartupoin_search) ?>;
	fkartupoinsearch.lists["x_id_pelanggan"].options = <?php echo JsonEncode($kartupoin_search->id_pelanggan->lookupOptions()) ?>;
	fkartupoinsearch.lists["x_id_klinik"] = <?php echo $kartupoin_search->id_klinik->Lookup->toClientList($kartupoin_search) ?>;
	fkartupoinsearch.lists["x_id_klinik"].options = <?php echo JsonEncode($kartupoin_search->id_klinik->lookupOptions()) ?>;
	fkartupoinsearch.lists["x_id_penyesuaian_poin"] = <?php echo $kartupoin_search->id_penyesuaian_poin->Lookup->toClientList($kartupoin_search) ?>;
	fkartupoinsearch.lists["x_id_penyesuaian_poin"].options = <?php echo JsonEncode($kartupoin_search->id_penyesuaian_poin->lookupOptions()) ?>;
	fkartupoinsearch.autoSuggests["x_id_penyesuaian_poin"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fkartupoinsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kartupoin_search->showPageHeader(); ?>
<?php
$kartupoin_search->showMessage();
?>
<form name="fkartupoinsearch" id="fkartupoinsearch" class="<?php echo $kartupoin_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartupoin">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$kartupoin_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($kartupoin_search->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label for="x_id_pelanggan" class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_id_pelanggan"><?php echo $kartupoin_search->id_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pelanggan" id="z_id_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->id_pelanggan->cellAttributes() ?>>
			<span id="el_kartupoin_id_pelanggan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartupoin" data-field="x_id_pelanggan" data-value-separator="<?php echo $kartupoin_search->id_pelanggan->displayValueSeparatorAttribute() ?>" id="x_id_pelanggan" name="x_id_pelanggan"<?php echo $kartupoin_search->id_pelanggan->editAttributes() ?>>
			<?php echo $kartupoin_search->id_pelanggan->selectOptionListHtml("x_id_pelanggan") ?>
		</select>
</div>
<?php echo $kartupoin_search->id_pelanggan->Lookup->getParamTag($kartupoin_search, "p_x_id_pelanggan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_id_klinik"><?php echo $kartupoin_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->id_klinik->cellAttributes() ?>>
			<span id="el_kartupoin_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartupoin" data-field="x_id_klinik" data-value-separator="<?php echo $kartupoin_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $kartupoin_search->id_klinik->editAttributes() ?>>
			<?php echo $kartupoin_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $kartupoin_search->id_klinik->Lookup->getParamTag($kartupoin_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_search->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label for="x_kode_penjualan" class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_kode_penjualan"><?php echo $kartupoin_search->kode_penjualan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_penjualan" id="z_kode_penjualan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->kode_penjualan->cellAttributes() ?>>
			<span id="el_kartupoin_kode_penjualan" class="ew-search-field">
<input type="text" data-table="kartupoin" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($kartupoin_search->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $kartupoin_search->kode_penjualan->EditValue ?>"<?php echo $kartupoin_search->kode_penjualan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_search->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
	<div id="r_id_penyesuaian_poin" class="form-group row">
		<label class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_id_penyesuaian_poin"><?php echo $kartupoin_search->id_penyesuaian_poin->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_penyesuaian_poin" id="z_id_penyesuaian_poin" value="=">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->id_penyesuaian_poin->cellAttributes() ?>>
			<span id="el_kartupoin_id_penyesuaian_poin" class="ew-search-field">
<?php
$onchange = $kartupoin_search->id_penyesuaian_poin->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartupoin_search->id_penyesuaian_poin->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_penyesuaian_poin">
	<input type="text" class="form-control" name="sv_x_id_penyesuaian_poin" id="sv_x_id_penyesuaian_poin" value="<?php echo RemoveHtml($kartupoin_search->id_penyesuaian_poin->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartupoin_search->id_penyesuaian_poin->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartupoin_search->id_penyesuaian_poin->getPlaceHolder()) ?>"<?php echo $kartupoin_search->id_penyesuaian_poin->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartupoin" data-field="x_id_penyesuaian_poin" data-value-separator="<?php echo $kartupoin_search->id_penyesuaian_poin->displayValueSeparatorAttribute() ?>" name="x_id_penyesuaian_poin" id="x_id_penyesuaian_poin" value="<?php echo HtmlEncode($kartupoin_search->id_penyesuaian_poin->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartupoinsearch"], function() {
	fkartupoinsearch.createAutoSuggest({"id":"x_id_penyesuaian_poin","forceSelect":false});
});
</script>
<?php echo $kartupoin_search->id_penyesuaian_poin->Lookup->getParamTag($kartupoin_search, "p_x_id_penyesuaian_poin") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_search->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label for="x_tgl" class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_tgl"><?php echo $kartupoin_search->tgl->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl" id="z_tgl" value="=">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->tgl->cellAttributes() ?>>
			<span id="el_kartupoin_tgl" class="ew-search-field">
<input type="text" data-table="kartupoin" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="19" placeholder="<?php echo HtmlEncode($kartupoin_search->tgl->getPlaceHolder()) ?>" value="<?php echo $kartupoin_search->tgl->EditValue ?>"<?php echo $kartupoin_search->tgl->editAttributes() ?>>
<?php if (!$kartupoin_search->tgl->ReadOnly && !$kartupoin_search->tgl->Disabled && !isset($kartupoin_search->tgl->EditAttrs["readonly"]) && !isset($kartupoin_search->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartupoinsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartupoinsearch", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_search->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<div id="r_masuk_penyesuaian" class="form-group row">
		<label for="x_masuk_penyesuaian" class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_masuk_penyesuaian"><?php echo $kartupoin_search->masuk_penyesuaian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_masuk_penyesuaian" id="z_masuk_penyesuaian" value="=">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->masuk_penyesuaian->cellAttributes() ?>>
			<span id="el_kartupoin_masuk_penyesuaian" class="ew-search-field">
<input type="text" data-table="kartupoin" data-field="x_masuk_penyesuaian" name="x_masuk_penyesuaian" id="x_masuk_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_search->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartupoin_search->masuk_penyesuaian->EditValue ?>"<?php echo $kartupoin_search->masuk_penyesuaian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_search->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<div id="r_keluar_penyesuaian" class="form-group row">
		<label for="x_keluar_penyesuaian" class="<?php echo $kartupoin_search->LeftColumnClass ?>"><span id="elh_kartupoin_keluar_penyesuaian"><?php echo $kartupoin_search->keluar_penyesuaian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_keluar_penyesuaian" id="z_keluar_penyesuaian" value="=">
</span>
		</label>
		<div class="<?php echo $kartupoin_search->RightColumnClass ?>"><div <?php echo $kartupoin_search->keluar_penyesuaian->cellAttributes() ?>>
			<span id="el_kartupoin_keluar_penyesuaian" class="ew-search-field">
<input type="text" data-table="kartupoin" data-field="x_keluar_penyesuaian" name="x_keluar_penyesuaian" id="x_keluar_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_search->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartupoin_search->keluar_penyesuaian->EditValue ?>"<?php echo $kartupoin_search->keluar_penyesuaian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kartupoin_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kartupoin_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kartupoin_search->showPageFooter();
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
$kartupoin_search->terminate();
?>