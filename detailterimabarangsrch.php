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
$detailterimabarang_search = new detailterimabarang_search();

// Run the page
$detailterimabarang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailterimabarangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailterimabarang_search->IsModal) { ?>
	fdetailterimabarangsearch = currentAdvancedSearchForm = new ew.Form("fdetailterimabarangsearch", "search");
	<?php } else { ?>
	fdetailterimabarangsearch = currentForm = new ew.Form("fdetailterimabarangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailterimabarangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_terimabarang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->id_terimabarang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_harga");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->harga->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->jumlah->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_satuan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->satuan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_diskon");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->diskon->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_hargatotal");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailterimabarang_search->hargatotal->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailterimabarangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimabarangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimabarangsearch.lists["x_id_barang"] = <?php echo $detailterimabarang_search->id_barang->Lookup->toClientList($detailterimabarang_search) ?>;
	fdetailterimabarangsearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimabarang_search->id_barang->lookupOptions()) ?>;
	fdetailterimabarangsearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailterimabarangsearch.lists["x_satuan"] = <?php echo $detailterimabarang_search->satuan->Lookup->toClientList($detailterimabarang_search) ?>;
	fdetailterimabarangsearch.lists["x_satuan"].options = <?php echo JsonEncode($detailterimabarang_search->satuan->lookupOptions()) ?>;
	fdetailterimabarangsearch.autoSuggests["x_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailterimabarangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailterimabarang_search->showPageHeader(); ?>
<?php
$detailterimabarang_search->showMessage();
?>
<form name="fdetailterimabarangsearch" id="fdetailterimabarangsearch" class="<?php echo $detailterimabarang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimabarang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailterimabarang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailterimabarang_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_id"><?php echo $detailterimabarang_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->id->cellAttributes() ?>>
			<span id="el_detailterimabarang_id" class="ew-search-field">
<input type="text" data-table="detailterimabarang" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_search->id->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_search->id->EditValue ?>"<?php echo $detailterimabarang_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->id_terimabarang->Visible) { // id_terimabarang ?>
	<div id="r_id_terimabarang" class="form-group row">
		<label for="x_id_terimabarang" class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_id_terimabarang"><?php echo $detailterimabarang_search->id_terimabarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_terimabarang" id="z_id_terimabarang" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->id_terimabarang->cellAttributes() ?>>
			<span id="el_detailterimabarang_id_terimabarang" class="ew-search-field">
<input type="text" data-table="detailterimabarang" data-field="x_id_terimabarang" name="x_id_terimabarang" id="x_id_terimabarang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_search->id_terimabarang->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_search->id_terimabarang->EditValue ?>"<?php echo $detailterimabarang_search->id_terimabarang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_id_barang"><?php echo $detailterimabarang_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->id_barang->cellAttributes() ?>>
			<span id="el_detailterimabarang_id_barang" class="ew-search-field">
<?php
$onchange = $detailterimabarang_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailterimabarang_search->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_search->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_search->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailterimabarang_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabarangsearch"], function() {
	fdetailterimabarangsearch.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_search->id_barang->Lookup->getParamTag($detailterimabarang_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->harga->Visible) { // harga ?>
	<div id="r_harga" class="form-group row">
		<label for="x_harga" class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_harga"><?php echo $detailterimabarang_search->harga->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_harga" id="z_harga" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->harga->cellAttributes() ?>>
			<span id="el_detailterimabarang_harga" class="ew-search-field">
<input type="text" data-table="detailterimabarang" data-field="x_harga" name="x_harga" id="x_harga" size="5" maxlength="20" placeholder="<?php echo HtmlEncode($detailterimabarang_search->harga->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_search->harga->EditValue ?>"<?php echo $detailterimabarang_search->harga->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_jumlah"><?php echo $detailterimabarang_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->jumlah->cellAttributes() ?>>
			<span id="el_detailterimabarang_jumlah" class="ew-search-field">
<input type="text" data-table="detailterimabarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_search->jumlah->EditValue ?>"<?php echo $detailterimabarang_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_satuan"><?php echo $detailterimabarang_search->satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_satuan" id="z_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->satuan->cellAttributes() ?>>
			<span id="el_detailterimabarang_satuan" class="ew-search-field">
<?php
$onchange = $detailterimabarang_search->satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_search->satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_satuan">
	<input type="text" class="form-control" name="sv_x_satuan" id="sv_x_satuan" value="<?php echo RemoveHtml($detailterimabarang_search->satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_search->satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_search->satuan->getPlaceHolder()) ?>"<?php echo $detailterimabarang_search->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" data-value-separator="<?php echo $detailterimabarang_search->satuan->displayValueSeparatorAttribute() ?>" name="x_satuan" id="x_satuan" value="<?php echo HtmlEncode($detailterimabarang_search->satuan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabarangsearch"], function() {
	fdetailterimabarangsearch.createAutoSuggest({"id":"x_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_search->satuan->Lookup->getParamTag($detailterimabarang_search, "p_x_satuan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->diskon->Visible) { // diskon ?>
	<div id="r_diskon" class="form-group row">
		<label for="x_diskon" class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_diskon"><?php echo $detailterimabarang_search->diskon->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_diskon" id="z_diskon" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->diskon->cellAttributes() ?>>
			<span id="el_detailterimabarang_diskon" class="ew-search-field">
<input type="text" data-table="detailterimabarang" data-field="x_diskon" name="x_diskon" id="x_diskon" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_search->diskon->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_search->diskon->EditValue ?>"<?php echo $detailterimabarang_search->diskon->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_search->hargatotal->Visible) { // hargatotal ?>
	<div id="r_hargatotal" class="form-group row">
		<label for="x_hargatotal" class="<?php echo $detailterimabarang_search->LeftColumnClass ?>"><span id="elh_detailterimabarang_hargatotal"><?php echo $detailterimabarang_search->hargatotal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_hargatotal" id="z_hargatotal" value="=">
</span>
		</label>
		<div class="<?php echo $detailterimabarang_search->RightColumnClass ?>"><div <?php echo $detailterimabarang_search->hargatotal->cellAttributes() ?>>
			<span id="el_detailterimabarang_hargatotal" class="ew-search-field">
<input type="text" data-table="detailterimabarang" data-field="x_hargatotal" name="x_hargatotal" id="x_hargatotal" size="5" maxlength="20" placeholder="<?php echo HtmlEncode($detailterimabarang_search->hargatotal->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_search->hargatotal->EditValue ?>"<?php echo $detailterimabarang_search->hargatotal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailterimabarang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailterimabarang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailterimabarang_search->showPageFooter();
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
$detailterimabarang_search->terminate();
?>