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
$detailrekmedterapis_search = new detailrekmedterapis_search();

// Run the page
$detailrekmedterapis_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmedterapissearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailrekmedterapis_search->IsModal) { ?>
	fdetailrekmedterapissearch = currentAdvancedSearchForm = new ew.Form("fdetailrekmedterapissearch", "search");
	<?php } else { ?>
	fdetailrekmedterapissearch = currentForm = new ew.Form("fdetailrekmedterapissearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailrekmedterapissearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_detailrekmedterapis");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_search->id_detailrekmedterapis->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_rekmeddok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_search->id_rekmeddok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailrekmedterapissearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedterapissearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedterapissearch.lists["x_id_barang"] = <?php echo $detailrekmedterapis_search->id_barang->Lookup->toClientList($detailrekmedterapis_search) ?>;
	fdetailrekmedterapissearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedterapis_search->id_barang->lookupOptions()) ?>;
	fdetailrekmedterapissearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedterapissearch.lists["x_id_satuan"] = <?php echo $detailrekmedterapis_search->id_satuan->Lookup->toClientList($detailrekmedterapis_search) ?>;
	fdetailrekmedterapissearch.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedterapis_search->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedterapissearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmedterapis_search->showPageHeader(); ?>
<?php
$detailrekmedterapis_search->showMessage();
?>
<form name="fdetailrekmedterapissearch" id="fdetailrekmedterapissearch" class="<?php echo $detailrekmedterapis_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedterapis">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmedterapis_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailrekmedterapis_search->id_detailrekmedterapis->Visible) { // id_detailrekmedterapis ?>
	<div id="r_id_detailrekmedterapis" class="form-group row">
		<label for="x_id_detailrekmedterapis" class="<?php echo $detailrekmedterapis_search->LeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_detailrekmedterapis"><?php echo $detailrekmedterapis_search->id_detailrekmedterapis->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_detailrekmedterapis" id="z_id_detailrekmedterapis" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedterapis_search->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_search->id_detailrekmedterapis->cellAttributes() ?>>
			<span id="el_detailrekmedterapis_id_detailrekmedterapis" class="ew-search-field">
<input type="text" data-table="detailrekmedterapis" data-field="x_id_detailrekmedterapis" name="x_id_detailrekmedterapis" id="x_id_detailrekmedterapis" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmedterapis_search->id_detailrekmedterapis->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_search->id_detailrekmedterapis->EditValue ?>"<?php echo $detailrekmedterapis_search->id_detailrekmedterapis->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_search->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label for="x_id_rekmeddok" class="<?php echo $detailrekmedterapis_search->LeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_rekmeddok"><?php echo $detailrekmedterapis_search->id_rekmeddok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_rekmeddok" id="z_id_rekmeddok" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedterapis_search->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_search->id_rekmeddok->cellAttributes() ?>>
			<span id="el_detailrekmedterapis_id_rekmeddok" class="ew-search-field">
<input type="text" data-table="detailrekmedterapis" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmedterapis_search->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_search->id_rekmeddok->EditValue ?>"<?php echo $detailrekmedterapis_search->id_rekmeddok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $detailrekmedterapis_search->LeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_barang"><?php echo $detailrekmedterapis_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedterapis_search->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_search->id_barang->cellAttributes() ?>>
			<span id="el_detailrekmedterapis_id_barang" class="ew-search-field">
<?php
$onchange = $detailrekmedterapis_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_search->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_search->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_search->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_search->id_barang->ReadOnly || $detailrekmedterapis_search->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapissearch"], function() {
	fdetailrekmedterapissearch.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_search->id_barang->Lookup->getParamTag($detailrekmedterapis_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailrekmedterapis_search->LeftColumnClass ?>"><span id="elh_detailrekmedterapis_jumlah"><?php echo $detailrekmedterapis_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedterapis_search->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_search->jumlah->cellAttributes() ?>>
			<span id="el_detailrekmedterapis_jumlah" class="ew-search-field">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_search->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_search->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label for="x_id_satuan" class="<?php echo $detailrekmedterapis_search->LeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_satuan"><?php echo $detailrekmedterapis_search->id_satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_satuan" id="z_id_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedterapis_search->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_search->id_satuan->cellAttributes() ?>>
			<span id="el_detailrekmedterapis_id_satuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_search->id_satuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_search->id_satuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_search->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_search->id_satuan->ReadOnly || $detailrekmedterapis_search->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_search->id_satuan->Lookup->getParamTag($detailrekmedterapis_search, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_search->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailrekmedterapis_search->id_satuan->AdvancedSearch->SearchValue ?>"<?php echo $detailrekmedterapis_search->id_satuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailrekmedterapis_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmedterapis_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmedterapis_search->showPageFooter();
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
$detailrekmedterapis_search->terminate();
?>