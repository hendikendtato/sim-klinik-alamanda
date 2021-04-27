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
$detailperpindahanbarang_search = new detailperpindahanbarang_search();

// Run the page
$detailperpindahanbarang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailperpindahanbarangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailperpindahanbarang_search->IsModal) { ?>
	fdetailperpindahanbarangsearch = currentAdvancedSearchForm = new ew.Form("fdetailperpindahanbarangsearch", "search");
	<?php } else { ?>
	fdetailperpindahanbarangsearch = currentForm = new ew.Form("fdetailperpindahanbarangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailperpindahanbarangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_detailperpindahanbarang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_search->id_detailperpindahanbarang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_perpindahanbarang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_search->id_perpindahanbarang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_jumlah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_search->jumlah->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailperpindahanbarangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailperpindahanbarangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailperpindahanbarangsearch.lists["x_id_barang"] = <?php echo $detailperpindahanbarang_search->id_barang->Lookup->toClientList($detailperpindahanbarang_search) ?>;
	fdetailperpindahanbarangsearch.lists["x_id_barang"].options = <?php echo JsonEncode($detailperpindahanbarang_search->id_barang->lookupOptions()) ?>;
	fdetailperpindahanbarangsearch.lists["x_id_satuan"] = <?php echo $detailperpindahanbarang_search->id_satuan->Lookup->toClientList($detailperpindahanbarang_search) ?>;
	fdetailperpindahanbarangsearch.lists["x_id_satuan"].options = <?php echo JsonEncode($detailperpindahanbarang_search->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailperpindahanbarangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailperpindahanbarang_search->showPageHeader(); ?>
<?php
$detailperpindahanbarang_search->showMessage();
?>
<form name="fdetailperpindahanbarangsearch" id="fdetailperpindahanbarangsearch" class="<?php echo $detailperpindahanbarang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailperpindahanbarang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailperpindahanbarang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailperpindahanbarang_search->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
	<div id="r_id_detailperpindahanbarang" class="form-group row">
		<label for="x_id_detailperpindahanbarang" class="<?php echo $detailperpindahanbarang_search->LeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_detailperpindahanbarang"><?php echo $detailperpindahanbarang_search->id_detailperpindahanbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_detailperpindahanbarang" id="z_id_detailperpindahanbarang" value="=">
</span>
		</label>
		<div class="<?php echo $detailperpindahanbarang_search->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_search->id_detailperpindahanbarang->cellAttributes() ?>>
			<span id="el_detailperpindahanbarang_id_detailperpindahanbarang" class="ew-search-field">
<input type="text" data-table="detailperpindahanbarang" data-field="x_id_detailperpindahanbarang" name="x_id_detailperpindahanbarang" id="x_id_detailperpindahanbarang" maxlength="11" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_search->id_detailperpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_search->id_detailperpindahanbarang->EditValue ?>"<?php echo $detailperpindahanbarang_search->id_detailperpindahanbarang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_search->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<div id="r_id_perpindahanbarang" class="form-group row">
		<label for="x_id_perpindahanbarang" class="<?php echo $detailperpindahanbarang_search->LeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_perpindahanbarang"><?php echo $detailperpindahanbarang_search->id_perpindahanbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_perpindahanbarang" id="z_id_perpindahanbarang" value="=">
</span>
		</label>
		<div class="<?php echo $detailperpindahanbarang_search->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_search->id_perpindahanbarang->cellAttributes() ?>>
			<span id="el_detailperpindahanbarang_id_perpindahanbarang" class="ew-search-field">
<input type="text" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x_id_perpindahanbarang" id="x_id_perpindahanbarang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_search->id_perpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_search->id_perpindahanbarang->EditValue ?>"<?php echo $detailperpindahanbarang_search->id_perpindahanbarang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label for="x_id_barang" class="<?php echo $detailperpindahanbarang_search->LeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_barang"><?php echo $detailperpindahanbarang_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $detailperpindahanbarang_search->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_search->id_barang->cellAttributes() ?>>
			<span id="el_detailperpindahanbarang_id_barang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailperpindahanbarang_search->id_barang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_search->id_barang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_search->id_barang->ReadOnly || $detailperpindahanbarang_search->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_search->id_barang->Lookup->getParamTag($detailperpindahanbarang_search, "p_x_id_barang") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailperpindahanbarang_search->id_barang->AdvancedSearch->SearchValue ?>"<?php echo $detailperpindahanbarang_search->id_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_search->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label for="x_jumlah" class="<?php echo $detailperpindahanbarang_search->LeftColumnClass ?>"><span id="elh_detailperpindahanbarang_jumlah"><?php echo $detailperpindahanbarang_search->jumlah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jumlah" id="z_jumlah" value="=">
</span>
		</label>
		<div class="<?php echo $detailperpindahanbarang_search->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_search->jumlah->cellAttributes() ?>>
			<span id="el_detailperpindahanbarang_jumlah" class="ew-search-field">
<input type="text" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_search->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_search->jumlah->EditValue ?>"<?php echo $detailperpindahanbarang_search->jumlah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_search->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label for="x_id_satuan" class="<?php echo $detailperpindahanbarang_search->LeftColumnClass ?>"><span id="elh_detailperpindahanbarang_id_satuan"><?php echo $detailperpindahanbarang_search->id_satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_satuan" id="z_id_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailperpindahanbarang_search->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_search->id_satuan->cellAttributes() ?>>
			<span id="el_detailperpindahanbarang_id_satuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailperpindahanbarang_search->id_satuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_search->id_satuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_search->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_search->id_satuan->ReadOnly || $detailperpindahanbarang_search->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_search->id_satuan->Lookup->getParamTag($detailperpindahanbarang_search, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_search->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailperpindahanbarang_search->id_satuan->AdvancedSearch->SearchValue ?>"<?php echo $detailperpindahanbarang_search->id_satuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailperpindahanbarang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailperpindahanbarang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailperpindahanbarang_search->showPageFooter();
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
$detailperpindahanbarang_search->terminate();
?>