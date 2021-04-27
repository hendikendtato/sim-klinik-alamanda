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
$detailkomposisi_search = new detailkomposisi_search();

// Run the page
$detailkomposisi_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailkomposisisearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailkomposisi_search->IsModal) { ?>
	fdetailkomposisisearch = currentAdvancedSearchForm = new ew.Form("fdetailkomposisisearch", "search");
	<?php } else { ?>
	fdetailkomposisisearch = currentForm = new ew.Form("fdetailkomposisisearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailkomposisisearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_detail_komposisi");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkomposisi_search->id_detail_komposisi->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_komposisi");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkomposisi_search->id_komposisi->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailkomposisi_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailkomposisisearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkomposisisearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkomposisisearch.lists["x_id_barang"] = <?php echo $detailkomposisi_search->id_barang->Lookup->toClientList($detailkomposisi_search) ?>;
	fdetailkomposisisearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailkomposisi_search->id_barang->lookupOptions()) ?>;
	fdetailkomposisisearch.lists["x_id_satuan"] = <?php echo $detailkomposisi_search->id_satuan->Lookup->toClientList($detailkomposisi_search) ?>;
	fdetailkomposisisearch.lists["x_id_satuan"].options = <?php echo JsonEncode($detailkomposisi_search->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailkomposisisearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailkomposisi_search->showPageHeader(); ?>
<?php
$detailkomposisi_search->showMessage();
?>
<form name="fdetailkomposisisearch" id="fdetailkomposisisearch" class="<?php echo $detailkomposisi_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkomposisi">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailkomposisi_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailkomposisi_search->id_detail_komposisi->Visible) { // id_detail_komposisi ?>
	<div id="r_id_detail_komposisi" class="form-group row">
		<label for="x_id_detail_komposisi" class="<?php echo $detailkomposisi_search->LeftColumnClass ?>"><span id="elh_detailkomposisi_id_detail_komposisi"><?php echo $detailkomposisi_search->id_detail_komposisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_detail_komposisi" id="z_id_detail_komposisi" value="=">
</span>
		</label>
		<div class="<?php echo $detailkomposisi_search->RightColumnClass ?>"><div <?php echo $detailkomposisi_search->id_detail_komposisi->cellAttributes() ?>>
			<span id="el_detailkomposisi_id_detail_komposisi" class="ew-search-field">
<input type="text" data-table="detailkomposisi" data-field="x_id_detail_komposisi" name="x_id_detail_komposisi" id="x_id_detail_komposisi" maxlength="11" placeholder="<?php echo HtmlEncode($detailkomposisi_search->id_detail_komposisi->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_search->id_detail_komposisi->EditValue ?>"<?php echo $detailkomposisi_search->id_detail_komposisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_search->id_komposisi->Visible) { // id_komposisi ?>
	<div id="r_id_komposisi" class="form-group row">
		<label for="x_id_komposisi" class="<?php echo $detailkomposisi_search->LeftColumnClass ?>"><span id="elh_detailkomposisi_id_komposisi"><?php echo $detailkomposisi_search->id_komposisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_komposisi" id="z_id_komposisi" value="=">
</span>
		</label>
		<div class="<?php echo $detailkomposisi_search->RightColumnClass ?>"><div <?php echo $detailkomposisi_search->id_komposisi->cellAttributes() ?>>
			<span id="el_detailkomposisi_id_komposisi" class="ew-search-field">
<input type="text" data-table="detailkomposisi" data-field="x_id_komposisi" name="x_id_komposisi" id="x_id_komposisi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkomposisi_search->id_komposisi->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_search->id_komposisi->EditValue ?>"<?php echo $detailkomposisi_search->id_komposisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label for="x_id_barang" class="<?php echo $detailkomposisi_search->LeftColumnClass ?>"><span id="elh_detailkomposisi_id_barang"><?php echo $detailkomposisi_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailkomposisi_search->RightColumnClass ?>"><div <?php echo $detailkomposisi_search->id_barang->cellAttributes() ?>>
			<span id="el_detailkomposisi_id_barang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailkomposisi_search->id_barang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_search->id_barang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_search->id_barang->ReadOnly || $detailkomposisi_search->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_search->id_barang->Lookup->getParamTag($detailkomposisi_search, "p_x_id_barang") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailkomposisi_search->id_barang->AdvancedSearch->SearchValue ?>"<?php echo $detailkomposisi_search->id_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailkomposisi_search->LeftColumnClass ?>"><span id="elh_detailkomposisi_jumlah"><?php echo $detailkomposisi_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailkomposisi_search->RightColumnClass ?>"><div <?php echo $detailkomposisi_search->jumlah->cellAttributes() ?>>
			<span id="el_detailkomposisi_jumlah" class="ew-search-field">
<input type="text" data-table="detailkomposisi" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailkomposisi_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_search->jumlah->EditValue ?>"<?php echo $detailkomposisi_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_search->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label for="x_id_satuan" class="<?php echo $detailkomposisi_search->LeftColumnClass ?>"><span id="elh_detailkomposisi_id_satuan"><?php echo $detailkomposisi_search->id_satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_satuan" id="z_id_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailkomposisi_search->RightColumnClass ?>"><div <?php echo $detailkomposisi_search->id_satuan->cellAttributes() ?>>
			<span id="el_detailkomposisi_id_satuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailkomposisi_search->id_satuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_search->id_satuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_search->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_search->id_satuan->ReadOnly || $detailkomposisi_search->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_search->id_satuan->Lookup->getParamTag($detailkomposisi_search, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_search->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailkomposisi_search->id_satuan->AdvancedSearch->SearchValue ?>"<?php echo $detailkomposisi_search->id_satuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailkomposisi_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailkomposisi_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailkomposisi_search->showPageFooter();
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
$detailkomposisi_search->terminate();
?>