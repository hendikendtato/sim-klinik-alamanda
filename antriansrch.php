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
$antrian_search = new antrian_search();

// Run the page
$antrian_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$antrian_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fantriansearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($antrian_search->IsModal) { ?>
	fantriansearch = currentAdvancedSearchForm = new ew.Form("fantriansearch", "search");
	<?php } else { ?>
	fantriansearch = currentForm = new ew.Form("fantriansearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fantriansearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($antrian_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($antrian_search->tanggal->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fantriansearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fantriansearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fantriansearch.lists["x_nama_klinik"] = <?php echo $antrian_search->nama_klinik->Lookup->toClientList($antrian_search) ?>;
	fantriansearch.lists["x_nama_klinik"].options = <?php echo JsonEncode($antrian_search->nama_klinik->lookupOptions()) ?>;
	fantriansearch.lists["x_selesai"] = <?php echo $antrian_search->selesai->Lookup->toClientList($antrian_search) ?>;
	fantriansearch.lists["x_selesai"].options = <?php echo JsonEncode($antrian_search->selesai->options(FALSE, TRUE)) ?>;
	loadjs.done("fantriansearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $antrian_search->showPageHeader(); ?>
<?php
$antrian_search->showMessage();
?>
<form name="fantriansearch" id="fantriansearch" class="<?php echo $antrian_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="antrian">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$antrian_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($antrian_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $antrian_search->LeftColumnClass ?>"><span id="elh_antrian_id"><?php echo $antrian_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $antrian_search->RightColumnClass ?>"><div <?php echo $antrian_search->id->cellAttributes() ?>>
			<span id="el_antrian_id" class="ew-search-field">
<input type="text" data-table="antrian" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($antrian_search->id->getPlaceHolder()) ?>" value="<?php echo $antrian_search->id->EditValue ?>"<?php echo $antrian_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($antrian_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $antrian_search->LeftColumnClass ?>"><span id="elh_antrian_tanggal"><?php echo $antrian_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $antrian_search->RightColumnClass ?>"><div <?php echo $antrian_search->tanggal->cellAttributes() ?>>
			<span id="el_antrian_tanggal" class="ew-search-field">
<input type="text" data-table="antrian" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="10" placeholder="<?php echo HtmlEncode($antrian_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $antrian_search->tanggal->EditValue ?>"<?php echo $antrian_search->tanggal->editAttributes() ?>>
<?php if (!$antrian_search->tanggal->ReadOnly && !$antrian_search->tanggal->Disabled && !isset($antrian_search->tanggal->EditAttrs["readonly"]) && !isset($antrian_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fantriansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fantriansearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($antrian_search->nomor_antrian->Visible) { // nomor_antrian ?>
	<div id="r_nomor_antrian" class="form-group row">
		<label for="x_nomor_antrian" class="<?php echo $antrian_search->LeftColumnClass ?>"><span id="elh_antrian_nomor_antrian"><?php echo $antrian_search->nomor_antrian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nomor_antrian" id="z_nomor_antrian" value="LIKE">
</span>
		</label>
		<div class="<?php echo $antrian_search->RightColumnClass ?>"><div <?php echo $antrian_search->nomor_antrian->cellAttributes() ?>>
			<span id="el_antrian_nomor_antrian" class="ew-search-field">
<input type="text" data-table="antrian" data-field="x_nomor_antrian" name="x_nomor_antrian" id="x_nomor_antrian" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($antrian_search->nomor_antrian->getPlaceHolder()) ?>" value="<?php echo $antrian_search->nomor_antrian->EditValue ?>"<?php echo $antrian_search->nomor_antrian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($antrian_search->keperluan->Visible) { // keperluan ?>
	<div id="r_keperluan" class="form-group row">
		<label for="x_keperluan" class="<?php echo $antrian_search->LeftColumnClass ?>"><span id="elh_antrian_keperluan"><?php echo $antrian_search->keperluan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keperluan" id="z_keperluan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $antrian_search->RightColumnClass ?>"><div <?php echo $antrian_search->keperluan->cellAttributes() ?>>
			<span id="el_antrian_keperluan" class="ew-search-field">
<input type="text" data-table="antrian" data-field="x_keperluan" name="x_keperluan" id="x_keperluan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($antrian_search->keperluan->getPlaceHolder()) ?>" value="<?php echo $antrian_search->keperluan->EditValue ?>"<?php echo $antrian_search->keperluan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($antrian_search->nama_klinik->Visible) { // nama_klinik ?>
	<div id="r_nama_klinik" class="form-group row">
		<label for="x_nama_klinik" class="<?php echo $antrian_search->LeftColumnClass ?>"><span id="elh_antrian_nama_klinik"><?php echo $antrian_search->nama_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_klinik" id="z_nama_klinik" value="LIKE">
</span>
		</label>
		<div class="<?php echo $antrian_search->RightColumnClass ?>"><div <?php echo $antrian_search->nama_klinik->cellAttributes() ?>>
			<span id="el_antrian_nama_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="antrian" data-field="x_nama_klinik" data-value-separator="<?php echo $antrian_search->nama_klinik->displayValueSeparatorAttribute() ?>" id="x_nama_klinik" name="x_nama_klinik"<?php echo $antrian_search->nama_klinik->editAttributes() ?>>
			<?php echo $antrian_search->nama_klinik->selectOptionListHtml("x_nama_klinik") ?>
		</select>
</div>
<?php echo $antrian_search->nama_klinik->Lookup->getParamTag($antrian_search, "p_x_nama_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($antrian_search->selesai->Visible) { // selesai ?>
	<div id="r_selesai" class="form-group row">
		<label for="x_selesai" class="<?php echo $antrian_search->LeftColumnClass ?>"><span id="elh_antrian_selesai"><?php echo $antrian_search->selesai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_selesai" id="z_selesai" value="=">
</span>
		</label>
		<div class="<?php echo $antrian_search->RightColumnClass ?>"><div <?php echo $antrian_search->selesai->cellAttributes() ?>>
			<span id="el_antrian_selesai" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="antrian" data-field="x_selesai" data-value-separator="<?php echo $antrian_search->selesai->displayValueSeparatorAttribute() ?>" id="x_selesai" name="x_selesai"<?php echo $antrian_search->selesai->editAttributes() ?>>
			<?php echo $antrian_search->selesai->selectOptionListHtml("x_selesai") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$antrian_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $antrian_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$antrian_search->showPageFooter();
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
$antrian_search->terminate();
?>