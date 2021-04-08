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
$detailkirimbarang_search = new detailkirimbarang_search();

// Run the page
$detailkirimbarang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkirimbarang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailkirimbarangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailkirimbarang_search->IsModal) { ?>
	fdetailkirimbarangsearch = currentAdvancedSearchForm = new ew.Form("fdetailkirimbarangsearch", "search");
	<?php } else { ?>
	fdetailkirimbarangsearch = currentForm = new ew.Form("fdetailkirimbarangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailkirimbarangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_kirimbarang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_search->id_kirimbarang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_harga");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_search->harga->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_satuan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_search->id_satuan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailkirimbarangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkirimbarangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkirimbarangsearch.lists["x_id_kirimbarang"] = <?php echo $detailkirimbarang_search->id_kirimbarang->Lookup->toClientList($detailkirimbarang_search) ?>;
	fdetailkirimbarangsearch.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($detailkirimbarang_search->id_kirimbarang->lookupOptions()) ?>;
	fdetailkirimbarangsearch.autoSuggests["x_id_kirimbarang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailkirimbarangsearch.lists["x_id_barang"] = <?php echo $detailkirimbarang_search->id_barang->Lookup->toClientList($detailkirimbarang_search) ?>;
	fdetailkirimbarangsearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailkirimbarang_search->id_barang->lookupOptions()) ?>;
	fdetailkirimbarangsearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailkirimbarangsearch.lists["x_id_satuan"] = <?php echo $detailkirimbarang_search->id_satuan->Lookup->toClientList($detailkirimbarang_search) ?>;
	fdetailkirimbarangsearch.lists["x_id_satuan"].options = <?php echo JsonEncode($detailkirimbarang_search->id_satuan->lookupOptions()) ?>;
	fdetailkirimbarangsearch.autoSuggests["x_id_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailkirimbarangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailkirimbarang_search->showPageHeader(); ?>
<?php
$detailkirimbarang_search->showMessage();
?>
<form name="fdetailkirimbarangsearch" id="fdetailkirimbarangsearch" class="<?php echo $detailkirimbarang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkirimbarang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailkirimbarang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailkirimbarang_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $detailkirimbarang_search->LeftColumnClass ?>"><span id="elh_detailkirimbarang_id"><?php echo $detailkirimbarang_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $detailkirimbarang_search->RightColumnClass ?>"><div <?php echo $detailkirimbarang_search->id->cellAttributes() ?>>
			<span id="el_detailkirimbarang_id" class="ew-search-field">
<input type="text" data-table="detailkirimbarang" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_search->id->EditValue ?>"<?php echo $detailkirimbarang_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_search->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<div id="r_id_kirimbarang" class="form-group row">
		<label class="<?php echo $detailkirimbarang_search->LeftColumnClass ?>"><span id="elh_detailkirimbarang_id_kirimbarang"><?php echo $detailkirimbarang_search->id_kirimbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kirimbarang" id="z_id_kirimbarang" value="=">
</span>
		</label>
		<div class="<?php echo $detailkirimbarang_search->RightColumnClass ?>"><div <?php echo $detailkirimbarang_search->id_kirimbarang->cellAttributes() ?>>
			<span id="el_detailkirimbarang_id_kirimbarang" class="ew-search-field">
<?php
$onchange = $detailkirimbarang_search->id_kirimbarang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_search->id_kirimbarang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_kirimbarang">
	<input type="text" class="form-control" name="sv_x_id_kirimbarang" id="sv_x_id_kirimbarang" value="<?php echo RemoveHtml($detailkirimbarang_search->id_kirimbarang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id_kirimbarang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id_kirimbarang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_search->id_kirimbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $detailkirimbarang_search->id_kirimbarang->displayValueSeparatorAttribute() ?>" name="x_id_kirimbarang" id="x_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_search->id_kirimbarang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbarangsearch"], function() {
	fdetailkirimbarangsearch.createAutoSuggest({"id":"x_id_kirimbarang","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_search->id_kirimbarang->Lookup->getParamTag($detailkirimbarang_search, "p_x_id_kirimbarang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $detailkirimbarang_search->LeftColumnClass ?>"><span id="elh_detailkirimbarang_id_barang"><?php echo $detailkirimbarang_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailkirimbarang_search->RightColumnClass ?>"><div <?php echo $detailkirimbarang_search->id_barang->cellAttributes() ?>>
			<span id="el_detailkirimbarang_id_barang" class="ew-search-field">
<?php
$onchange = $detailkirimbarang_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailkirimbarang_search->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id_barang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_search->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" data-value-separator="<?php echo $detailkirimbarang_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbarangsearch"], function() {
	fdetailkirimbarangsearch.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailkirimbarang_search->id_barang->Lookup->getParamTag($detailkirimbarang_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_search->harga->Visible) { // harga ?>
	<div id="r_harga" class="form-group row">
		<label for="x_harga" class="<?php echo $detailkirimbarang_search->LeftColumnClass ?>"><span id="elh_detailkirimbarang_harga"><?php echo $detailkirimbarang_search->harga->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_harga" id="z_harga" value="=">
</span>
		</label>
		<div class="<?php echo $detailkirimbarang_search->RightColumnClass ?>"><div <?php echo $detailkirimbarang_search->harga->cellAttributes() ?>>
			<span id="el_detailkirimbarang_harga" class="ew-search-field">
<input type="text" data-table="detailkirimbarang" data-field="x_harga" name="x_harga" id="x_harga" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailkirimbarang_search->harga->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_search->harga->EditValue ?>"<?php echo $detailkirimbarang_search->harga->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_search->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label class="<?php echo $detailkirimbarang_search->LeftColumnClass ?>"><span id="elh_detailkirimbarang_id_satuan"><?php echo $detailkirimbarang_search->id_satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_satuan" id="z_id_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailkirimbarang_search->RightColumnClass ?>"><div <?php echo $detailkirimbarang_search->id_satuan->cellAttributes() ?>>
			<span id="el_detailkirimbarang_id_satuan" class="ew-search-field">
<?php
$onchange = $detailkirimbarang_search->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_search->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_satuan">
	<input type="text" class="form-control" name="sv_x_id_satuan" id="sv_x_id_satuan" value="<?php echo RemoveHtml($detailkirimbarang_search->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_search->id_satuan->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_search->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" data-value-separator="<?php echo $detailkirimbarang_search->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_search->id_satuan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbarangsearch"], function() {
	fdetailkirimbarangsearch.createAutoSuggest({"id":"x_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_search->id_satuan->Lookup->getParamTag($detailkirimbarang_search, "p_x_id_satuan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailkirimbarang_search->LeftColumnClass ?>"><span id="elh_detailkirimbarang_jumlah"><?php echo $detailkirimbarang_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailkirimbarang_search->RightColumnClass ?>"><div <?php echo $detailkirimbarang_search->jumlah->cellAttributes() ?>>
			<span id="el_detailkirimbarang_jumlah" class="ew-search-field">
<input type="text" data-table="detailkirimbarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailkirimbarang_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_search->jumlah->EditValue ?>"<?php echo $detailkirimbarang_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailkirimbarang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailkirimbarang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailkirimbarang_search->showPageFooter();
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
$detailkirimbarang_search->terminate();
?>