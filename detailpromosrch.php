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
$detailpromo_search = new detailpromo_search();

// Run the page
$detailpromo_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpromosearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailpromo_search->IsModal) { ?>
	fdetailpromosearch = currentAdvancedSearchForm = new ew.Form("fdetailpromosearch", "search");
	<?php } else { ?>
	fdetailpromosearch = currentForm = new ew.Form("fdetailpromosearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailpromosearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_detailpromo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpromo_search->id_detailpromo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_promo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpromo_search->id_promo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpromo_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailpromosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpromosearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpromosearch.lists["x_id_barang"] = <?php echo $detailpromo_search->id_barang->Lookup->toClientList($detailpromo_search) ?>;
	fdetailpromosearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailpromo_search->id_barang->lookupOptions()) ?>;
	fdetailpromosearch.lists["x_id_satuan"] = <?php echo $detailpromo_search->id_satuan->Lookup->toClientList($detailpromo_search) ?>;
	fdetailpromosearch.lists["x_id_satuan"].options = <?php echo JsonEncode($detailpromo_search->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailpromosearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpromo_search->showPageHeader(); ?>
<?php
$detailpromo_search->showMessage();
?>
<form name="fdetailpromosearch" id="fdetailpromosearch" class="<?php echo $detailpromo_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpromo">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailpromo_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailpromo_search->id_detailpromo->Visible) { // id_detailpromo ?>
	<div id="r_id_detailpromo" class="form-group row">
		<label for="x_id_detailpromo" class="<?php echo $detailpromo_search->LeftColumnClass ?>"><span id="elh_detailpromo_id_detailpromo"><?php echo $detailpromo_search->id_detailpromo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_detailpromo" id="z_id_detailpromo" value="=">
</span>
		</label>
		<div class="<?php echo $detailpromo_search->RightColumnClass ?>"><div <?php echo $detailpromo_search->id_detailpromo->cellAttributes() ?>>
			<span id="el_detailpromo_id_detailpromo" class="ew-search-field">
<input type="text" data-table="detailpromo" data-field="x_id_detailpromo" name="x_id_detailpromo" id="x_id_detailpromo" maxlength="11" placeholder="<?php echo HtmlEncode($detailpromo_search->id_detailpromo->getPlaceHolder()) ?>" value="<?php echo $detailpromo_search->id_detailpromo->EditValue ?>"<?php echo $detailpromo_search->id_detailpromo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_search->id_promo->Visible) { // id_promo ?>
	<div id="r_id_promo" class="form-group row">
		<label for="x_id_promo" class="<?php echo $detailpromo_search->LeftColumnClass ?>"><span id="elh_detailpromo_id_promo"><?php echo $detailpromo_search->id_promo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_promo" id="z_id_promo" value="=">
</span>
		</label>
		<div class="<?php echo $detailpromo_search->RightColumnClass ?>"><div <?php echo $detailpromo_search->id_promo->cellAttributes() ?>>
			<span id="el_detailpromo_id_promo" class="ew-search-field">
<input type="text" data-table="detailpromo" data-field="x_id_promo" name="x_id_promo" id="x_id_promo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpromo_search->id_promo->getPlaceHolder()) ?>" value="<?php echo $detailpromo_search->id_promo->EditValue ?>"<?php echo $detailpromo_search->id_promo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label for="x_id_barang" class="<?php echo $detailpromo_search->LeftColumnClass ?>"><span id="elh_detailpromo_id_barang"><?php echo $detailpromo_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailpromo_search->RightColumnClass ?>"><div <?php echo $detailpromo_search->id_barang->cellAttributes() ?>>
			<span id="el_detailpromo_id_barang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailpromo_search->id_barang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_search->id_barang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_search->id_barang->ReadOnly || $detailpromo_search->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_search->id_barang->Lookup->getParamTag($detailpromo_search, "p_x_id_barang") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailpromo_search->id_barang->AdvancedSearch->SearchValue ?>"<?php echo $detailpromo_search->id_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailpromo_search->LeftColumnClass ?>"><span id="elh_detailpromo_jumlah"><?php echo $detailpromo_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailpromo_search->RightColumnClass ?>"><div <?php echo $detailpromo_search->jumlah->cellAttributes() ?>>
			<span id="el_detailpromo_jumlah" class="ew-search-field">
<input type="text" data-table="detailpromo" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpromo_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpromo_search->jumlah->EditValue ?>"<?php echo $detailpromo_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_search->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label for="x_id_satuan" class="<?php echo $detailpromo_search->LeftColumnClass ?>"><span id="elh_detailpromo_id_satuan"><?php echo $detailpromo_search->id_satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_satuan" id="z_id_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailpromo_search->RightColumnClass ?>"><div <?php echo $detailpromo_search->id_satuan->cellAttributes() ?>>
			<span id="el_detailpromo_id_satuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailpromo_search->id_satuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_search->id_satuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_search->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_search->id_satuan->ReadOnly || $detailpromo_search->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_search->id_satuan->Lookup->getParamTag($detailpromo_search, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_search->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailpromo_search->id_satuan->AdvancedSearch->SearchValue ?>"<?php echo $detailpromo_search->id_satuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailpromo_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpromo_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpromo_search->showPageFooter();
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
$detailpromo_search->terminate();
?>