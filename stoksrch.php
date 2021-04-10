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
$stok_search = new stok_search();

// Run the page
$stok_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$stok_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstoksearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($stok_search->IsModal) { ?>
	fstoksearch = currentAdvancedSearchForm = new ew.Form("fstoksearch", "search");
	<?php } else { ?>
	fstoksearch = currentForm = new ew.Form("fstoksearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fstoksearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($stok_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($stok_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fstoksearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstoksearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstoksearch.lists["x_id_barang"] = <?php echo $stok_search->id_barang->Lookup->toClientList($stok_search) ?>;
	fstoksearch.lists["x_id_barang"].options = <?php echo JsonEncode($stok_search->id_barang->lookupOptions()) ?>;
	fstoksearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fstoksearch.lists["x_id_klinik"] = <?php echo $stok_search->id_klinik->Lookup->toClientList($stok_search) ?>;
	fstoksearch.lists["x_id_klinik"].options = <?php echo JsonEncode($stok_search->id_klinik->lookupOptions()) ?>;
	loadjs.done("fstoksearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $stok_search->showPageHeader(); ?>
<?php
$stok_search->showMessage();
?>
<form name="fstoksearch" id="fstoksearch" class="<?php echo $stok_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="stok">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$stok_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($stok_search->id_stok->Visible) { // id_stok ?>
	<div id="r_id_stok" class="form-group row">
		<label for="x_id_stok" class="<?php echo $stok_search->LeftColumnClass ?>"><span id="elh_stok_id_stok"><?php echo $stok_search->id_stok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_stok" id="z_id_stok" value="=">
</span>
		</label>
		<div class="<?php echo $stok_search->RightColumnClass ?>"><div <?php echo $stok_search->id_stok->cellAttributes() ?>>
			<span id="el_stok_id_stok" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="stok" data-field="x_id_stok" data-value-separator="<?php echo $stok_search->id_stok->displayValueSeparatorAttribute() ?>" id="x_id_stok" name="x_id_stok"<?php echo $stok_search->id_stok->editAttributes() ?>>
			<?php echo $stok_search->id_stok->selectOptionListHtml("x_id_stok") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($stok_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $stok_search->LeftColumnClass ?>"><span id="elh_stok_id_barang"><?php echo $stok_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $stok_search->RightColumnClass ?>"><div <?php echo $stok_search->id_barang->cellAttributes() ?>>
			<span id="el_stok_id_barang" class="ew-search-field">
<?php
$onchange = $stok_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$stok_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($stok_search->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($stok_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($stok_search->id_barang->getPlaceHolder()) ?>"<?php echo $stok_search->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="stok" data-field="x_id_barang" data-value-separator="<?php echo $stok_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($stok_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fstoksearch"], function() {
	fstoksearch.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $stok_search->id_barang->Lookup->getParamTag($stok_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($stok_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $stok_search->LeftColumnClass ?>"><span id="elh_stok_jumlah"><?php echo $stok_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $stok_search->RightColumnClass ?>"><div <?php echo $stok_search->jumlah->cellAttributes() ?>>
			<span id="el_stok_jumlah" class="ew-search-field">
<input type="text" data-table="stok" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($stok_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $stok_search->jumlah->EditValue ?>"<?php echo $stok_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($stok_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $stok_search->LeftColumnClass ?>"><span id="elh_stok_id_klinik"><?php echo $stok_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $stok_search->RightColumnClass ?>"><div <?php echo $stok_search->id_klinik->cellAttributes() ?>>
			<span id="el_stok_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="stok" data-field="x_id_klinik" data-value-separator="<?php echo $stok_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $stok_search->id_klinik->editAttributes() ?>>
			<?php echo $stok_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $stok_search->id_klinik->Lookup->getParamTag($stok_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$stok_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $stok_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$stok_search->showPageFooter();
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
$stok_search->terminate();
?>