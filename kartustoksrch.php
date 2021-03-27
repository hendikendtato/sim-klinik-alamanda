<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$kartustok_search = new kartustok_search();

// Run the page
$kartustok_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkartustoksearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($kartustok_search->IsModal) { ?>
	fkartustoksearch = currentAdvancedSearchForm = new ew.Form("fkartustoksearch", "search");
	<?php } else { ?>
	fkartustoksearch = currentForm = new ew.Form("fkartustoksearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fkartustoksearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartustok_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartustok_search->tanggal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_penjualan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartustok_search->id_penjualan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_nonjual");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kartustok_search->id_nonjual->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fkartustoksearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkartustoksearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkartustoksearch.lists["x_id_barang"] = <?php echo $kartustok_search->id_barang->Lookup->toClientList($kartustok_search) ?>;
	fkartustoksearch.lists["x_id_barang"].options = <?php echo JsonEncode($kartustok_search->id_barang->lookupOptions()) ?>;
	fkartustoksearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustoksearch.lists["x_id_klinik"] = <?php echo $kartustok_search->id_klinik->Lookup->toClientList($kartustok_search) ?>;
	fkartustoksearch.lists["x_id_klinik"].options = <?php echo JsonEncode($kartustok_search->id_klinik->lookupOptions()) ?>;
	fkartustoksearch.lists["x_id_penjualan"] = <?php echo $kartustok_search->id_penjualan->Lookup->toClientList($kartustok_search) ?>;
	fkartustoksearch.lists["x_id_penjualan"].options = <?php echo JsonEncode($kartustok_search->id_penjualan->lookupOptions()) ?>;
	fkartustoksearch.autoSuggests["x_id_penjualan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustoksearch.lists["x_id_kirimbarang"] = <?php echo $kartustok_search->id_kirimbarang->Lookup->toClientList($kartustok_search) ?>;
	fkartustoksearch.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($kartustok_search->id_kirimbarang->lookupOptions()) ?>;
	fkartustoksearch.lists["x_id_retur"] = <?php echo $kartustok_search->id_retur->Lookup->toClientList($kartustok_search) ?>;
	fkartustoksearch.lists["x_id_retur"].options = <?php echo JsonEncode($kartustok_search->id_retur->lookupOptions()) ?>;
	loadjs.done("fkartustoksearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kartustok_search->showPageHeader(); ?>
<?php
$kartustok_search->showMessage();
?>
<form name="fkartustoksearch" id="fkartustoksearch" class="<?php echo $kartustok_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartustok">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$kartustok_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($kartustok_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_id_barang"><?php echo $kartustok_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->id_barang->cellAttributes() ?>>
			<span id="el_kartustok_id_barang" class="ew-search-field">
<?php
$onchange = $kartustok_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($kartustok_search->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($kartustok_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_search->id_barang->getPlaceHolder()) ?>"<?php echo $kartustok_search->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kartustok_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($kartustok_search->id_barang->ReadOnly || $kartustok_search->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kartustok_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($kartustok_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustoksearch"], function() {
	fkartustoksearch.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $kartustok_search->id_barang->Lookup->getParamTag($kartustok_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartustok_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_id_klinik"><?php echo $kartustok_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->id_klinik->cellAttributes() ?>>
			<span id="el_kartustok_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_klinik" data-value-separator="<?php echo $kartustok_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $kartustok_search->id_klinik->editAttributes() ?>>
			<?php echo $kartustok_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $kartustok_search->id_klinik->Lookup->getParamTag($kartustok_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartustok_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_tanggal"><?php echo $kartustok_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->tanggal->cellAttributes() ?>>
			<span id="el_kartustok_tanggal" class="ew-search-field">
<input type="text" data-table="kartustok" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kartustok_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $kartustok_search->tanggal->EditValue ?>"<?php echo $kartustok_search->tanggal->editAttributes() ?>>
<?php if (!$kartustok_search->tanggal->ReadOnly && !$kartustok_search->tanggal->Disabled && !isset($kartustok_search->tanggal->EditAttrs["readonly"]) && !isset($kartustok_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartustoksearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartustoksearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartustok_search->id_penjualan->Visible) { // id_penjualan ?>
	<div id="r_id_penjualan" class="form-group row">
		<label class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_id_penjualan"><?php echo $kartustok_search->id_penjualan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_penjualan" id="z_id_penjualan" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->id_penjualan->cellAttributes() ?>>
			<span id="el_kartustok_id_penjualan" class="ew-search-field">
<?php
$onchange = $kartustok_search->id_penjualan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_search->id_penjualan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_penjualan">
	<input type="text" class="form-control" name="sv_x_id_penjualan" id="sv_x_id_penjualan" value="<?php echo RemoveHtml($kartustok_search->id_penjualan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_search->id_penjualan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_search->id_penjualan->getPlaceHolder()) ?>"<?php echo $kartustok_search->id_penjualan->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" data-value-separator="<?php echo $kartustok_search->id_penjualan->displayValueSeparatorAttribute() ?>" name="x_id_penjualan" id="x_id_penjualan" value="<?php echo HtmlEncode($kartustok_search->id_penjualan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustoksearch"], function() {
	fkartustoksearch.createAutoSuggest({"id":"x_id_penjualan","forceSelect":false});
});
</script>
<?php echo $kartustok_search->id_penjualan->Lookup->getParamTag($kartustok_search, "p_x_id_penjualan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartustok_search->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<div id="r_id_kirimbarang" class="form-group row">
		<label for="x_id_kirimbarang" class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_id_kirimbarang"><?php echo $kartustok_search->id_kirimbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kirimbarang" id="z_id_kirimbarang" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->id_kirimbarang->cellAttributes() ?>>
			<span id="el_kartustok_id_kirimbarang" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_kirimbarang" data-value-separator="<?php echo $kartustok_search->id_kirimbarang->displayValueSeparatorAttribute() ?>" id="x_id_kirimbarang" name="x_id_kirimbarang"<?php echo $kartustok_search->id_kirimbarang->editAttributes() ?>>
			<?php echo $kartustok_search->id_kirimbarang->selectOptionListHtml("x_id_kirimbarang") ?>
		</select>
</div>
<?php echo $kartustok_search->id_kirimbarang->Lookup->getParamTag($kartustok_search, "p_x_id_kirimbarang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartustok_search->id_nonjual->Visible) { // id_nonjual ?>
	<div id="r_id_nonjual" class="form-group row">
		<label for="x_id_nonjual" class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_id_nonjual"><?php echo $kartustok_search->id_nonjual->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_nonjual" id="z_id_nonjual" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->id_nonjual->cellAttributes() ?>>
			<span id="el_kartustok_id_nonjual" class="ew-search-field">
<input type="text" data-table="kartustok" data-field="x_id_nonjual" name="x_id_nonjual" id="x_id_nonjual" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_search->id_nonjual->getPlaceHolder()) ?>" value="<?php echo $kartustok_search->id_nonjual->EditValue ?>"<?php echo $kartustok_search->id_nonjual->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kartustok_search->id_retur->Visible) { // id_retur ?>
	<div id="r_id_retur" class="form-group row">
		<label for="x_id_retur" class="<?php echo $kartustok_search->LeftColumnClass ?>"><span id="elh_kartustok_id_retur"><?php echo $kartustok_search->id_retur->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_retur" id="z_id_retur" value="=">
</span>
		</label>
		<div class="<?php echo $kartustok_search->RightColumnClass ?>"><div <?php echo $kartustok_search->id_retur->cellAttributes() ?>>
			<span id="el_kartustok_id_retur" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_retur" data-value-separator="<?php echo $kartustok_search->id_retur->displayValueSeparatorAttribute() ?>" id="x_id_retur" name="x_id_retur"<?php echo $kartustok_search->id_retur->editAttributes() ?>>
			<?php echo $kartustok_search->id_retur->selectOptionListHtml("x_id_retur") ?>
		</select>
</div>
<?php echo $kartustok_search->id_retur->Lookup->getParamTag($kartustok_search, "p_x_id_retur") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kartustok_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kartustok_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kartustok_search->showPageFooter();
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
$kartustok_search->terminate();
?>