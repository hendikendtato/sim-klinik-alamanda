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
$detailrekmedpenjualan_search = new detailrekmedpenjualan_search();

// Run the page
$detailrekmedpenjualan_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedpenjualan_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmedpenjualansearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailrekmedpenjualan_search->IsModal) { ?>
	fdetailrekmedpenjualansearch = currentAdvancedSearchForm = new ew.Form("fdetailrekmedpenjualansearch", "search");
	<?php } else { ?>
	fdetailrekmedpenjualansearch = currentForm = new ew.Form("fdetailrekmedpenjualansearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailrekmedpenjualansearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_detailrekmedpenjualan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedpenjualan_search->id_detailrekmedpenjualan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_rekmeddok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedpenjualan_search->id_rekmeddok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedpenjualan_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailrekmedpenjualan_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailrekmedpenjualansearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedpenjualansearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedpenjualansearch.lists["x_id_barang"] = <?php echo $detailrekmedpenjualan_search->id_barang->Lookup->toClientList($detailrekmedpenjualan_search) ?>;
	fdetailrekmedpenjualansearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedpenjualan_search->id_barang->lookupOptions()) ?>;
	fdetailrekmedpenjualansearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedpenjualansearch.lists["x_id_satuan"] = <?php echo $detailrekmedpenjualan_search->id_satuan->Lookup->toClientList($detailrekmedpenjualan_search) ?>;
	fdetailrekmedpenjualansearch.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedpenjualan_search->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedpenjualansearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmedpenjualan_search->showPageHeader(); ?>
<?php
$detailrekmedpenjualan_search->showMessage();
?>
<form name="fdetailrekmedpenjualansearch" id="fdetailrekmedpenjualansearch" class="<?php echo $detailrekmedpenjualan_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedpenjualan">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmedpenjualan_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailrekmedpenjualan_search->id_detailrekmedpenjualan->Visible) { // id_detailrekmedpenjualan ?>
	<div id="r_id_detailrekmedpenjualan" class="form-group row">
		<label for="x_id_detailrekmedpenjualan" class="<?php echo $detailrekmedpenjualan_search->LeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_detailrekmedpenjualan"><?php echo $detailrekmedpenjualan_search->id_detailrekmedpenjualan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_detailrekmedpenjualan" id="z_id_detailrekmedpenjualan" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedpenjualan_search->RightColumnClass ?>"><div <?php echo $detailrekmedpenjualan_search->id_detailrekmedpenjualan->cellAttributes() ?>>
			<span id="el_detailrekmedpenjualan_id_detailrekmedpenjualan" class="ew-search-field">
<input type="text" data-table="detailrekmedpenjualan" data-field="x_id_detailrekmedpenjualan" name="x_id_detailrekmedpenjualan" id="x_id_detailrekmedpenjualan" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_search->id_detailrekmedpenjualan->getPlaceHolder()) ?>" value="<?php echo $detailrekmedpenjualan_search->id_detailrekmedpenjualan->EditValue ?>"<?php echo $detailrekmedpenjualan_search->id_detailrekmedpenjualan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedpenjualan_search->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label for="x_id_rekmeddok" class="<?php echo $detailrekmedpenjualan_search->LeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_rekmeddok"><?php echo $detailrekmedpenjualan_search->id_rekmeddok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_rekmeddok" id="z_id_rekmeddok" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedpenjualan_search->RightColumnClass ?>"><div <?php echo $detailrekmedpenjualan_search->id_rekmeddok->cellAttributes() ?>>
			<span id="el_detailrekmedpenjualan_id_rekmeddok" class="ew-search-field">
<input type="text" data-table="detailrekmedpenjualan" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_search->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $detailrekmedpenjualan_search->id_rekmeddok->EditValue ?>"<?php echo $detailrekmedpenjualan_search->id_rekmeddok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedpenjualan_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $detailrekmedpenjualan_search->LeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_barang"><?php echo $detailrekmedpenjualan_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedpenjualan_search->RightColumnClass ?>"><div <?php echo $detailrekmedpenjualan_search->id_barang->cellAttributes() ?>>
			<span id="el_detailrekmedpenjualan_id_barang" class="ew-search-field">
<?php
$onchange = $detailrekmedpenjualan_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedpenjualan_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmedpenjualan_search->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_search->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedpenjualan_search->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_search->id_barang->ReadOnly || $detailrekmedpenjualan_search->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmedpenjualan_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedpenjualansearch"], function() {
	fdetailrekmedpenjualansearch.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedpenjualan_search->id_barang->Lookup->getParamTag($detailrekmedpenjualan_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedpenjualan_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailrekmedpenjualan_search->LeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_jumlah"><?php echo $detailrekmedpenjualan_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedpenjualan_search->RightColumnClass ?>"><div <?php echo $detailrekmedpenjualan_search->jumlah->cellAttributes() ?>>
			<span id="el_detailrekmedpenjualan_jumlah" class="ew-search-field">
<input type="text" data-table="detailrekmedpenjualan" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedpenjualan_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedpenjualan_search->jumlah->EditValue ?>"<?php echo $detailrekmedpenjualan_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedpenjualan_search->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label for="x_id_satuan" class="<?php echo $detailrekmedpenjualan_search->LeftColumnClass ?>"><span id="elh_detailrekmedpenjualan_id_satuan"><?php echo $detailrekmedpenjualan_search->id_satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_satuan" id="z_id_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailrekmedpenjualan_search->RightColumnClass ?>"><div <?php echo $detailrekmedpenjualan_search->id_satuan->cellAttributes() ?>>
			<span id="el_detailrekmedpenjualan_id_satuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailrekmedpenjualan_search->id_satuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedpenjualan_search->id_satuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedpenjualan_search->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedpenjualan_search->id_satuan->ReadOnly || $detailrekmedpenjualan_search->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedpenjualan_search->id_satuan->Lookup->getParamTag($detailrekmedpenjualan_search, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailrekmedpenjualan" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedpenjualan_search->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailrekmedpenjualan_search->id_satuan->AdvancedSearch->SearchValue ?>"<?php echo $detailrekmedpenjualan_search->id_satuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailrekmedpenjualan_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmedpenjualan_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmedpenjualan_search->showPageFooter();
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
$detailrekmedpenjualan_search->terminate();
?>