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
$komposisi_search = new komposisi_search();

// Run the page
$komposisi_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komposisi_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkomposisisearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($komposisi_search->IsModal) { ?>
	fkomposisisearch = currentAdvancedSearchForm = new ew.Form("fkomposisisearch", "search");
	<?php } else { ?>
	fkomposisisearch = currentForm = new ew.Form("fkomposisisearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fkomposisisearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_komposisi");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($komposisi_search->id_komposisi->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fkomposisisearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkomposisisearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkomposisisearch.lists["x_id_barang"] = <?php echo $komposisi_search->id_barang->Lookup->toClientList($komposisi_search) ?>;
	fkomposisisearch.lists["x_id_barang"].options = <?php echo JsonEncode($komposisi_search->id_barang->lookupOptions()) ?>;
	loadjs.done("fkomposisisearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $komposisi_search->showPageHeader(); ?>
<?php
$komposisi_search->showMessage();
?>
<form name="fkomposisisearch" id="fkomposisisearch" class="<?php echo $komposisi_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komposisi">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$komposisi_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($komposisi_search->id_komposisi->Visible) { // id_komposisi ?>
	<div id="r_id_komposisi" class="form-group row">
		<label for="x_id_komposisi" class="<?php echo $komposisi_search->LeftColumnClass ?>"><span id="elh_komposisi_id_komposisi"><?php echo $komposisi_search->id_komposisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_komposisi" id="z_id_komposisi" value="=">
</span>
		</label>
		<div class="<?php echo $komposisi_search->RightColumnClass ?>"><div <?php echo $komposisi_search->id_komposisi->cellAttributes() ?>>
			<span id="el_komposisi_id_komposisi" class="ew-search-field">
<input type="text" data-table="komposisi" data-field="x_id_komposisi" name="x_id_komposisi" id="x_id_komposisi" maxlength="11" placeholder="<?php echo HtmlEncode($komposisi_search->id_komposisi->getPlaceHolder()) ?>" value="<?php echo $komposisi_search->id_komposisi->EditValue ?>"<?php echo $komposisi_search->id_komposisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($komposisi_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label for="x_id_barang" class="<?php echo $komposisi_search->LeftColumnClass ?>"><span id="elh_komposisi_id_barang"><?php echo $komposisi_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $komposisi_search->RightColumnClass ?>"><div <?php echo $komposisi_search->id_barang->cellAttributes() ?>>
			<span id="el_komposisi_id_barang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($komposisi_search->id_barang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $komposisi_search->id_barang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($komposisi_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($komposisi_search->id_barang->ReadOnly || $komposisi_search->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $komposisi_search->id_barang->Lookup->getParamTag($komposisi_search, "p_x_id_barang") ?>
<input type="hidden" data-table="komposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $komposisi_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $komposisi_search->id_barang->AdvancedSearch->SearchValue ?>"<?php echo $komposisi_search->id_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$komposisi_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $komposisi_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$komposisi_search->showPageFooter();
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
$komposisi_search->terminate();
?>