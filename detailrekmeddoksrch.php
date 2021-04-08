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
$detailrekmeddok_search = new detailrekmeddok_search();

// Run the page
$detailrekmeddok_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmeddoksearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailrekmeddok_search->IsModal) { ?>
	fdetailrekmeddoksearch = currentAdvancedSearchForm = new ew.Form("fdetailrekmeddoksearch", "search");
	<?php } else { ?>
	fdetailrekmeddoksearch = currentForm = new ew.Form("fdetailrekmeddoksearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailrekmeddoksearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_pemobat");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_search->id_pemobat->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_rekmeddok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_search->id_rekmeddok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailrekmeddoksearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmeddoksearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmeddoksearch.lists["x_id_barang"] = <?php echo $detailrekmeddok_search->id_barang->Lookup->toClientList($detailrekmeddok_search) ?>;
	fdetailrekmeddoksearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmeddok_search->id_barang->lookupOptions()) ?>;
	fdetailrekmeddoksearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmeddoksearch.lists["x_satuan"] = <?php echo $detailrekmeddok_search->satuan->Lookup->toClientList($detailrekmeddok_search) ?>;
	fdetailrekmeddoksearch.lists["x_satuan"].options = <?php echo JsonEncode($detailrekmeddok_search->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmeddoksearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmeddok_search->showPageHeader(); ?>
<?php
$detailrekmeddok_search->showMessage();
?>
<form name="fdetailrekmeddoksearch" id="fdetailrekmeddoksearch" class="<?php echo $detailrekmeddok_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmeddok">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmeddok_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailrekmeddok_search->id_pemobat->Visible) { // id_pemobat ?>
	<div id="r_id_pemobat" class="form-group row">
		<label for="x_id_pemobat" class="<?php echo $detailrekmeddok_search->LeftColumnClass ?>"><span id="elh_detailrekmeddok_id_pemobat"><?php echo $detailrekmeddok_search->id_pemobat->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pemobat" id="z_id_pemobat" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmeddok_search->RightColumnClass ?>"><div <?php echo $detailrekmeddok_search->id_pemobat->cellAttributes() ?>>
			<span id="el_detailrekmeddok_id_pemobat" class="ew-search-field">
<input type="text" data-table="detailrekmeddok" data-field="x_id_pemobat" name="x_id_pemobat" id="x_id_pemobat" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmeddok_search->id_pemobat->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_search->id_pemobat->EditValue ?>"<?php echo $detailrekmeddok_search->id_pemobat->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_search->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label for="x_id_rekmeddok" class="<?php echo $detailrekmeddok_search->LeftColumnClass ?>"><span id="elh_detailrekmeddok_id_rekmeddok"><?php echo $detailrekmeddok_search->id_rekmeddok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_rekmeddok" id="z_id_rekmeddok" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmeddok_search->RightColumnClass ?>"><div <?php echo $detailrekmeddok_search->id_rekmeddok->cellAttributes() ?>>
			<span id="el_detailrekmeddok_id_rekmeddok" class="ew-search-field">
<input type="text" data-table="detailrekmeddok" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmeddok_search->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_search->id_rekmeddok->EditValue ?>"<?php echo $detailrekmeddok_search->id_rekmeddok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $detailrekmeddok_search->LeftColumnClass ?>"><span id="elh_detailrekmeddok_id_barang"><?php echo $detailrekmeddok_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmeddok_search->RightColumnClass ?>"><div <?php echo $detailrekmeddok_search->id_barang->cellAttributes() ?>>
			<span id="el_detailrekmeddok_id_barang" class="ew-search-field">
<?php
$onchange = $detailrekmeddok_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmeddok_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmeddok_search->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmeddok_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmeddok_search->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmeddok_search->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_search->id_barang->ReadOnly || $detailrekmeddok_search->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmeddoksearch"], function() {
	fdetailrekmeddoksearch.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmeddok_search->id_barang->Lookup->getParamTag($detailrekmeddok_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailrekmeddok_search->LeftColumnClass ?>"><span id="elh_detailrekmeddok_jumlah"><?php echo $detailrekmeddok_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmeddok_search->RightColumnClass ?>"><div <?php echo $detailrekmeddok_search->jumlah->cellAttributes() ?>>
			<span id="el_detailrekmeddok_jumlah" class="ew-search-field">
<input type="text" data-table="detailrekmeddok" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmeddok_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_search->jumlah->EditValue ?>"<?php echo $detailrekmeddok_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_search->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label for="x_satuan" class="<?php echo $detailrekmeddok_search->LeftColumnClass ?>"><span id="elh_detailrekmeddok_satuan"><?php echo $detailrekmeddok_search->satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_satuan" id="z_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmeddok_search->RightColumnClass ?>"><div <?php echo $detailrekmeddok_search->satuan->cellAttributes() ?>>
			<span id="el_detailrekmeddok_satuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_satuan"><?php echo EmptyValue(strval($detailrekmeddok_search->satuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmeddok_search->satuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_search->satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_search->satuan->ReadOnly || $detailrekmeddok_search->satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmeddok_search->satuan->Lookup->getParamTag($detailrekmeddok_search, "p_x_satuan") ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_search->satuan->displayValueSeparatorAttribute() ?>" name="x_satuan" id="x_satuan" value="<?php echo $detailrekmeddok_search->satuan->AdvancedSearch->SearchValue ?>"<?php echo $detailrekmeddok_search->satuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailrekmeddok_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmeddok_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmeddok_search->showPageFooter();
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
$detailrekmeddok_search->terminate();
?>