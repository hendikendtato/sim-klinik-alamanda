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
$penyesuaianstok_search = new penyesuaianstok_search();

// Run the page
$penyesuaianstok_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaianstok_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaianstoksearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($penyesuaianstok_search->IsModal) { ?>
	fpenyesuaianstoksearch = currentAdvancedSearchForm = new ew.Form("fpenyesuaianstoksearch", "search");
	<?php } else { ?>
	fpenyesuaianstoksearch = currentForm = new ew.Form("fpenyesuaianstoksearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpenyesuaianstoksearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_penyesuaianstok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penyesuaianstok_search->id_penyesuaianstok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penyesuaianstok_search->tanggal->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpenyesuaianstoksearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenyesuaianstoksearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenyesuaianstoksearch.lists["x_id_klinik"] = <?php echo $penyesuaianstok_search->id_klinik->Lookup->toClientList($penyesuaianstok_search) ?>;
	fpenyesuaianstoksearch.lists["x_id_klinik"].options = <?php echo JsonEncode($penyesuaianstok_search->id_klinik->lookupOptions()) ?>;
	loadjs.done("fpenyesuaianstoksearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penyesuaianstok_search->showPageHeader(); ?>
<?php
$penyesuaianstok_search->showMessage();
?>
<form name="fpenyesuaianstoksearch" id="fpenyesuaianstoksearch" class="<?php echo $penyesuaianstok_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaianstok">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaianstok_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($penyesuaianstok_search->id_penyesuaianstok->Visible) { // id_penyesuaianstok ?>
	<div id="r_id_penyesuaianstok" class="form-group row">
		<label for="x_id_penyesuaianstok" class="<?php echo $penyesuaianstok_search->LeftColumnClass ?>"><span id="elh_penyesuaianstok_id_penyesuaianstok"><?php echo $penyesuaianstok_search->id_penyesuaianstok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_penyesuaianstok" id="z_id_penyesuaianstok" value="=">
</span>
		</label>
		<div class="<?php echo $penyesuaianstok_search->RightColumnClass ?>"><div <?php echo $penyesuaianstok_search->id_penyesuaianstok->cellAttributes() ?>>
			<span id="el_penyesuaianstok_id_penyesuaianstok" class="ew-search-field">
<input type="text" data-table="penyesuaianstok" data-field="x_id_penyesuaianstok" name="x_id_penyesuaianstok" id="x_id_penyesuaianstok" maxlength="11" placeholder="<?php echo HtmlEncode($penyesuaianstok_search->id_penyesuaianstok->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_search->id_penyesuaianstok->EditValue ?>"<?php echo $penyesuaianstok_search->id_penyesuaianstok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_search->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
	<div id="r_kode_penyesuaian" class="form-group row">
		<label for="x_kode_penyesuaian" class="<?php echo $penyesuaianstok_search->LeftColumnClass ?>"><span id="elh_penyesuaianstok_kode_penyesuaian"><?php echo $penyesuaianstok_search->kode_penyesuaian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_penyesuaian" id="z_kode_penyesuaian" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penyesuaianstok_search->RightColumnClass ?>"><div <?php echo $penyesuaianstok_search->kode_penyesuaian->cellAttributes() ?>>
			<span id="el_penyesuaianstok_kode_penyesuaian" class="ew-search-field">
<input type="text" data-table="penyesuaianstok" data-field="x_kode_penyesuaian" name="x_kode_penyesuaian" id="x_kode_penyesuaian" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penyesuaianstok_search->kode_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_search->kode_penyesuaian->EditValue ?>"<?php echo $penyesuaianstok_search->kode_penyesuaian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $penyesuaianstok_search->LeftColumnClass ?>"><span id="elh_penyesuaianstok_tanggal"><?php echo $penyesuaianstok_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $penyesuaianstok_search->RightColumnClass ?>"><div <?php echo $penyesuaianstok_search->tanggal->cellAttributes() ?>>
			<span id="el_penyesuaianstok_tanggal" class="ew-search-field">
<input type="text" data-table="penyesuaianstok" data-field="x_tanggal" data-format="7" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($penyesuaianstok_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_search->tanggal->EditValue ?>"<?php echo $penyesuaianstok_search->tanggal->editAttributes() ?>>
<?php if (!$penyesuaianstok_search->tanggal->ReadOnly && !$penyesuaianstok_search->tanggal->Disabled && !isset($penyesuaianstok_search->tanggal->EditAttrs["readonly"]) && !isset($penyesuaianstok_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenyesuaianstoksearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenyesuaianstoksearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $penyesuaianstok_search->LeftColumnClass ?>"><span id="elh_penyesuaianstok_id_klinik"><?php echo $penyesuaianstok_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $penyesuaianstok_search->RightColumnClass ?>"><div <?php echo $penyesuaianstok_search->id_klinik->cellAttributes() ?>>
			<span id="el_penyesuaianstok_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penyesuaianstok" data-field="x_id_klinik" data-value-separator="<?php echo $penyesuaianstok_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $penyesuaianstok_search->id_klinik->editAttributes() ?>>
			<?php echo $penyesuaianstok_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $penyesuaianstok_search->id_klinik->Lookup->getParamTag($penyesuaianstok_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_search->lampiran->Visible) { // lampiran ?>
	<div id="r_lampiran" class="form-group row">
		<label class="<?php echo $penyesuaianstok_search->LeftColumnClass ?>"><span id="elh_penyesuaianstok_lampiran"><?php echo $penyesuaianstok_search->lampiran->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_lampiran" id="z_lampiran" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penyesuaianstok_search->RightColumnClass ?>"><div <?php echo $penyesuaianstok_search->lampiran->cellAttributes() ?>>
			<span id="el_penyesuaianstok_lampiran" class="ew-search-field">
<input type="text" data-table="penyesuaianstok" data-field="x_lampiran" name="x_lampiran" id="x_lampiran" size="255" maxlength="255" placeholder="<?php echo HtmlEncode($penyesuaianstok_search->lampiran->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_search->lampiran->EditValue ?>"<?php echo $penyesuaianstok_search->lampiran->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_search->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label for="x_keterangan" class="<?php echo $penyesuaianstok_search->LeftColumnClass ?>"><span id="elh_penyesuaianstok_keterangan"><?php echo $penyesuaianstok_search->keterangan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keterangan" id="z_keterangan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penyesuaianstok_search->RightColumnClass ?>"><div <?php echo $penyesuaianstok_search->keterangan->cellAttributes() ?>>
			<span id="el_penyesuaianstok_keterangan" class="ew-search-field">
<input type="text" data-table="penyesuaianstok" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" maxlength="255" placeholder="<?php echo HtmlEncode($penyesuaianstok_search->keterangan->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_search->keterangan->EditValue ?>"<?php echo $penyesuaianstok_search->keterangan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$penyesuaianstok_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penyesuaianstok_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penyesuaianstok_search->showPageFooter();
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
$penyesuaianstok_search->terminate();
?>