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
$penggunaan_kartu_search = new penggunaan_kartu_search();

// Run the page
$penggunaan_kartu_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penggunaan_kartu_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenggunaan_kartusearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($penggunaan_kartu_search->IsModal) { ?>
	fpenggunaan_kartusearch = currentAdvancedSearchForm = new ew.Form("fpenggunaan_kartusearch", "search");
	<?php } else { ?>
	fpenggunaan_kartusearch = currentForm = new ew.Form("fpenggunaan_kartusearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpenggunaan_kartusearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgl");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penggunaan_kartu_search->tgl->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penggunaan_kartu_search->total->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total_charge");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penggunaan_kartu_search->total_charge->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpenggunaan_kartusearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenggunaan_kartusearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenggunaan_kartusearch.lists["x_id_klinik"] = <?php echo $penggunaan_kartu_search->id_klinik->Lookup->toClientList($penggunaan_kartu_search) ?>;
	fpenggunaan_kartusearch.lists["x_id_klinik"].options = <?php echo JsonEncode($penggunaan_kartu_search->id_klinik->lookupOptions()) ?>;
	loadjs.done("fpenggunaan_kartusearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penggunaan_kartu_search->showPageHeader(); ?>
<?php
$penggunaan_kartu_search->showMessage();
?>
<form name="fpenggunaan_kartusearch" id="fpenggunaan_kartusearch" class="<?php echo $penggunaan_kartu_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penggunaan_kartu">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$penggunaan_kartu_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($penggunaan_kartu_search->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label for="x_tgl" class="<?php echo $penggunaan_kartu_search->LeftColumnClass ?>"><span id="elh_penggunaan_kartu_tgl"><?php echo $penggunaan_kartu_search->tgl->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_tgl" id="z_tgl" value="BETWEEN">
</span>
		</label>
		<div class="<?php echo $penggunaan_kartu_search->RightColumnClass ?>"><div <?php echo $penggunaan_kartu_search->tgl->cellAttributes() ?>>
			<span id="el_penggunaan_kartu_tgl" class="ew-search-field">
<input type="text" data-table="penggunaan_kartu" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($penggunaan_kartu_search->tgl->getPlaceHolder()) ?>" value="<?php echo $penggunaan_kartu_search->tgl->EditValue ?>"<?php echo $penggunaan_kartu_search->tgl->editAttributes() ?>>
<?php if (!$penggunaan_kartu_search->tgl->ReadOnly && !$penggunaan_kartu_search->tgl->Disabled && !isset($penggunaan_kartu_search->tgl->EditAttrs["readonly"]) && !isset($penggunaan_kartu_search->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenggunaan_kartusearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenggunaan_kartusearch", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
			<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
			<span id="el2_penggunaan_kartu_tgl" class="ew-search-field2">
<input type="text" data-table="penggunaan_kartu" data-field="x_tgl" name="y_tgl" id="y_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($penggunaan_kartu_search->tgl->getPlaceHolder()) ?>" value="<?php echo $penggunaan_kartu_search->tgl->EditValue2 ?>"<?php echo $penggunaan_kartu_search->tgl->editAttributes() ?>>
<?php if (!$penggunaan_kartu_search->tgl->ReadOnly && !$penggunaan_kartu_search->tgl->Disabled && !isset($penggunaan_kartu_search->tgl->EditAttrs["readonly"]) && !isset($penggunaan_kartu_search->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenggunaan_kartusearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenggunaan_kartusearch", "y_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penggunaan_kartu_search->jenis_kartu->Visible) { // jenis_kartu ?>
	<div id="r_jenis_kartu" class="form-group row">
		<label for="x_jenis_kartu" class="<?php echo $penggunaan_kartu_search->LeftColumnClass ?>"><span id="elh_penggunaan_kartu_jenis_kartu"><?php echo $penggunaan_kartu_search->jenis_kartu->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_jenis_kartu" id="z_jenis_kartu" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penggunaan_kartu_search->RightColumnClass ?>"><div <?php echo $penggunaan_kartu_search->jenis_kartu->cellAttributes() ?>>
			<span id="el_penggunaan_kartu_jenis_kartu" class="ew-search-field">
<input type="text" data-table="penggunaan_kartu" data-field="x_jenis_kartu" name="x_jenis_kartu" id="x_jenis_kartu" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($penggunaan_kartu_search->jenis_kartu->getPlaceHolder()) ?>" value="<?php echo $penggunaan_kartu_search->jenis_kartu->EditValue ?>"<?php echo $penggunaan_kartu_search->jenis_kartu->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penggunaan_kartu_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $penggunaan_kartu_search->LeftColumnClass ?>"><span id="elh_penggunaan_kartu_id_klinik"><?php echo $penggunaan_kartu_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $penggunaan_kartu_search->RightColumnClass ?>"><div <?php echo $penggunaan_kartu_search->id_klinik->cellAttributes() ?>>
			<span id="el_penggunaan_kartu_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penggunaan_kartu" data-field="x_id_klinik" data-value-separator="<?php echo $penggunaan_kartu_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $penggunaan_kartu_search->id_klinik->editAttributes() ?>>
			<?php echo $penggunaan_kartu_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $penggunaan_kartu_search->id_klinik->Lookup->getParamTag($penggunaan_kartu_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penggunaan_kartu_search->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label for="x_total" class="<?php echo $penggunaan_kartu_search->LeftColumnClass ?>"><span id="elh_penggunaan_kartu_total"><?php echo $penggunaan_kartu_search->total->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total" id="z_total" value="=">
</span>
		</label>
		<div class="<?php echo $penggunaan_kartu_search->RightColumnClass ?>"><div <?php echo $penggunaan_kartu_search->total->cellAttributes() ?>>
			<span id="el_penggunaan_kartu_total" class="ew-search-field">
<input type="text" data-table="penggunaan_kartu" data-field="x_total" name="x_total" id="x_total" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penggunaan_kartu_search->total->getPlaceHolder()) ?>" value="<?php echo $penggunaan_kartu_search->total->EditValue ?>"<?php echo $penggunaan_kartu_search->total->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penggunaan_kartu_search->charge->Visible) { // charge ?>
	<div id="r_charge" class="form-group row">
		<label for="x_charge" class="<?php echo $penggunaan_kartu_search->LeftColumnClass ?>"><span id="elh_penggunaan_kartu_charge"><?php echo $penggunaan_kartu_search->charge->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_charge" id="z_charge" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penggunaan_kartu_search->RightColumnClass ?>"><div <?php echo $penggunaan_kartu_search->charge->cellAttributes() ?>>
			<span id="el_penggunaan_kartu_charge" class="ew-search-field">
<input type="text" data-table="penggunaan_kartu" data-field="x_charge" name="x_charge" id="x_charge" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($penggunaan_kartu_search->charge->getPlaceHolder()) ?>" value="<?php echo $penggunaan_kartu_search->charge->EditValue ?>"<?php echo $penggunaan_kartu_search->charge->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penggunaan_kartu_search->total_charge->Visible) { // total_charge ?>
	<div id="r_total_charge" class="form-group row">
		<label for="x_total_charge" class="<?php echo $penggunaan_kartu_search->LeftColumnClass ?>"><span id="elh_penggunaan_kartu_total_charge"><?php echo $penggunaan_kartu_search->total_charge->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_charge" id="z_total_charge" value="=">
</span>
		</label>
		<div class="<?php echo $penggunaan_kartu_search->RightColumnClass ?>"><div <?php echo $penggunaan_kartu_search->total_charge->cellAttributes() ?>>
			<span id="el_penggunaan_kartu_total_charge" class="ew-search-field">
<input type="text" data-table="penggunaan_kartu" data-field="x_total_charge" name="x_total_charge" id="x_total_charge" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penggunaan_kartu_search->total_charge->getPlaceHolder()) ?>" value="<?php echo $penggunaan_kartu_search->total_charge->EditValue ?>"<?php echo $penggunaan_kartu_search->total_charge->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$penggunaan_kartu_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penggunaan_kartu_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penggunaan_kartu_search->showPageFooter();
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
$penggunaan_kartu_search->terminate();
?>