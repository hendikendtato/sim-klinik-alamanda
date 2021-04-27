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
$perpindahanbarang_search = new perpindahanbarang_search();

// Run the page
$perpindahanbarang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perpindahanbarang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperpindahanbarangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($perpindahanbarang_search->IsModal) { ?>
	fperpindahanbarangsearch = currentAdvancedSearchForm = new ew.Form("fperpindahanbarangsearch", "search");
	<?php } else { ?>
	fperpindahanbarangsearch = currentForm = new ew.Form("fperpindahanbarangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fperpindahanbarangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_perpindahanbarang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($perpindahanbarang_search->id_perpindahanbarang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($perpindahanbarang_search->tanggal->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fperpindahanbarangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperpindahanbarangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fperpindahanbarangsearch.lists["x_asal"] = <?php echo $perpindahanbarang_search->asal->Lookup->toClientList($perpindahanbarang_search) ?>;
	fperpindahanbarangsearch.lists["x_asal"].options = <?php echo JsonEncode($perpindahanbarang_search->asal->lookupOptions()) ?>;
	fperpindahanbarangsearch.lists["x_tujuan"] = <?php echo $perpindahanbarang_search->tujuan->Lookup->toClientList($perpindahanbarang_search) ?>;
	fperpindahanbarangsearch.lists["x_tujuan"].options = <?php echo JsonEncode($perpindahanbarang_search->tujuan->lookupOptions()) ?>;
	loadjs.done("fperpindahanbarangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perpindahanbarang_search->showPageHeader(); ?>
<?php
$perpindahanbarang_search->showMessage();
?>
<form name="fperpindahanbarangsearch" id="fperpindahanbarangsearch" class="<?php echo $perpindahanbarang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perpindahanbarang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$perpindahanbarang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($perpindahanbarang_search->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<div id="r_id_perpindahanbarang" class="form-group row">
		<label for="x_id_perpindahanbarang" class="<?php echo $perpindahanbarang_search->LeftColumnClass ?>"><span id="elh_perpindahanbarang_id_perpindahanbarang"><?php echo $perpindahanbarang_search->id_perpindahanbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_perpindahanbarang" id="z_id_perpindahanbarang" value="=">
</span>
		</label>
		<div class="<?php echo $perpindahanbarang_search->RightColumnClass ?>"><div <?php echo $perpindahanbarang_search->id_perpindahanbarang->cellAttributes() ?>>
			<span id="el_perpindahanbarang_id_perpindahanbarang" class="ew-search-field">
<input type="text" data-table="perpindahanbarang" data-field="x_id_perpindahanbarang" name="x_id_perpindahanbarang" id="x_id_perpindahanbarang" maxlength="11" placeholder="<?php echo HtmlEncode($perpindahanbarang_search->id_perpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $perpindahanbarang_search->id_perpindahanbarang->EditValue ?>"<?php echo $perpindahanbarang_search->id_perpindahanbarang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $perpindahanbarang_search->LeftColumnClass ?>"><span id="elh_perpindahanbarang_tanggal"><?php echo $perpindahanbarang_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $perpindahanbarang_search->RightColumnClass ?>"><div <?php echo $perpindahanbarang_search->tanggal->cellAttributes() ?>>
			<span id="el_perpindahanbarang_tanggal" class="ew-search-field">
<input type="text" data-table="perpindahanbarang" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($perpindahanbarang_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $perpindahanbarang_search->tanggal->EditValue ?>"<?php echo $perpindahanbarang_search->tanggal->editAttributes() ?>>
<?php if (!$perpindahanbarang_search->tanggal->ReadOnly && !$perpindahanbarang_search->tanggal->Disabled && !isset($perpindahanbarang_search->tanggal->EditAttrs["readonly"]) && !isset($perpindahanbarang_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fperpindahanbarangsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fperpindahanbarangsearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_search->asal->Visible) { // asal ?>
	<div id="r_asal" class="form-group row">
		<label for="x_asal" class="<?php echo $perpindahanbarang_search->LeftColumnClass ?>"><span id="elh_perpindahanbarang_asal"><?php echo $perpindahanbarang_search->asal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_asal" id="z_asal" value="=">
</span>
		</label>
		<div class="<?php echo $perpindahanbarang_search->RightColumnClass ?>"><div <?php echo $perpindahanbarang_search->asal->cellAttributes() ?>>
			<span id="el_perpindahanbarang_asal" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_asal"><?php echo EmptyValue(strval($perpindahanbarang_search->asal->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $perpindahanbarang_search->asal->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($perpindahanbarang_search->asal->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($perpindahanbarang_search->asal->ReadOnly || $perpindahanbarang_search->asal->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_asal',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $perpindahanbarang_search->asal->Lookup->getParamTag($perpindahanbarang_search, "p_x_asal") ?>
<input type="hidden" data-table="perpindahanbarang" data-field="x_asal" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $perpindahanbarang_search->asal->displayValueSeparatorAttribute() ?>" name="x_asal" id="x_asal" value="<?php echo $perpindahanbarang_search->asal->AdvancedSearch->SearchValue ?>"<?php echo $perpindahanbarang_search->asal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_search->tujuan->Visible) { // tujuan ?>
	<div id="r_tujuan" class="form-group row">
		<label for="x_tujuan" class="<?php echo $perpindahanbarang_search->LeftColumnClass ?>"><span id="elh_perpindahanbarang_tujuan"><?php echo $perpindahanbarang_search->tujuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tujuan" id="z_tujuan" value="=">
</span>
		</label>
		<div class="<?php echo $perpindahanbarang_search->RightColumnClass ?>"><div <?php echo $perpindahanbarang_search->tujuan->cellAttributes() ?>>
			<span id="el_perpindahanbarang_tujuan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_tujuan"><?php echo EmptyValue(strval($perpindahanbarang_search->tujuan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $perpindahanbarang_search->tujuan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($perpindahanbarang_search->tujuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($perpindahanbarang_search->tujuan->ReadOnly || $perpindahanbarang_search->tujuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_tujuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $perpindahanbarang_search->tujuan->Lookup->getParamTag($perpindahanbarang_search, "p_x_tujuan") ?>
<input type="hidden" data-table="perpindahanbarang" data-field="x_tujuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $perpindahanbarang_search->tujuan->displayValueSeparatorAttribute() ?>" name="x_tujuan" id="x_tujuan" value="<?php echo $perpindahanbarang_search->tujuan->AdvancedSearch->SearchValue ?>"<?php echo $perpindahanbarang_search->tujuan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_search->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label for="x_keterangan" class="<?php echo $perpindahanbarang_search->LeftColumnClass ?>"><span id="elh_perpindahanbarang_keterangan"><?php echo $perpindahanbarang_search->keterangan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keterangan" id="z_keterangan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $perpindahanbarang_search->RightColumnClass ?>"><div <?php echo $perpindahanbarang_search->keterangan->cellAttributes() ?>>
			<span id="el_perpindahanbarang_keterangan" class="ew-search-field">
<input type="text" data-table="perpindahanbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($perpindahanbarang_search->keterangan->getPlaceHolder()) ?>" value="<?php echo $perpindahanbarang_search->keterangan->EditValue ?>"<?php echo $perpindahanbarang_search->keterangan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$perpindahanbarang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $perpindahanbarang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$perpindahanbarang_search->showPageFooter();
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
$perpindahanbarang_search->terminate();
?>