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
$promo_search = new promo_search();

// Run the page
$promo_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promo_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpromosearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($promo_search->IsModal) { ?>
	fpromosearch = currentAdvancedSearchForm = new ew.Form("fpromosearch", "search");
	<?php } else { ?>
	fpromosearch = currentForm = new ew.Form("fpromosearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpromosearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_promo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($promo_search->id_promo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal_mulai");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($promo_search->tanggal_mulai->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal_berakhir");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($promo_search->tanggal_berakhir->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpromosearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpromosearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpromosearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $promo_search->showPageHeader(); ?>
<?php
$promo_search->showMessage();
?>
<form name="fpromosearch" id="fpromosearch" class="<?php echo $promo_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promo">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$promo_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($promo_search->id_promo->Visible) { // id_promo ?>
	<div id="r_id_promo" class="form-group row">
		<label for="x_id_promo" class="<?php echo $promo_search->LeftColumnClass ?>"><span id="elh_promo_id_promo"><?php echo $promo_search->id_promo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_promo" id="z_id_promo" value="=">
</span>
		</label>
		<div class="<?php echo $promo_search->RightColumnClass ?>"><div <?php echo $promo_search->id_promo->cellAttributes() ?>>
			<span id="el_promo_id_promo" class="ew-search-field">
<input type="text" data-table="promo" data-field="x_id_promo" name="x_id_promo" id="x_id_promo" maxlength="11" placeholder="<?php echo HtmlEncode($promo_search->id_promo->getPlaceHolder()) ?>" value="<?php echo $promo_search->id_promo->EditValue ?>"<?php echo $promo_search->id_promo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($promo_search->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label for="x_nama" class="<?php echo $promo_search->LeftColumnClass ?>"><span id="elh_promo_nama"><?php echo $promo_search->nama->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</span>
		</label>
		<div class="<?php echo $promo_search->RightColumnClass ?>"><div <?php echo $promo_search->nama->cellAttributes() ?>>
			<span id="el_promo_nama" class="ew-search-field">
<input type="text" data-table="promo" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($promo_search->nama->getPlaceHolder()) ?>" value="<?php echo $promo_search->nama->EditValue ?>"<?php echo $promo_search->nama->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($promo_search->tanggal_mulai->Visible) { // tanggal_mulai ?>
	<div id="r_tanggal_mulai" class="form-group row">
		<label for="x_tanggal_mulai" class="<?php echo $promo_search->LeftColumnClass ?>"><span id="elh_promo_tanggal_mulai"><?php echo $promo_search->tanggal_mulai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal_mulai" id="z_tanggal_mulai" value="=">
</span>
		</label>
		<div class="<?php echo $promo_search->RightColumnClass ?>"><div <?php echo $promo_search->tanggal_mulai->cellAttributes() ?>>
			<span id="el_promo_tanggal_mulai" class="ew-search-field">
<input type="text" data-table="promo" data-field="x_tanggal_mulai" name="x_tanggal_mulai" id="x_tanggal_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($promo_search->tanggal_mulai->getPlaceHolder()) ?>" value="<?php echo $promo_search->tanggal_mulai->EditValue ?>"<?php echo $promo_search->tanggal_mulai->editAttributes() ?>>
<?php if (!$promo_search->tanggal_mulai->ReadOnly && !$promo_search->tanggal_mulai->Disabled && !isset($promo_search->tanggal_mulai->EditAttrs["readonly"]) && !isset($promo_search->tanggal_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpromosearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpromosearch", "x_tanggal_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($promo_search->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
	<div id="r_tanggal_berakhir" class="form-group row">
		<label for="x_tanggal_berakhir" class="<?php echo $promo_search->LeftColumnClass ?>"><span id="elh_promo_tanggal_berakhir"><?php echo $promo_search->tanggal_berakhir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal_berakhir" id="z_tanggal_berakhir" value="=">
</span>
		</label>
		<div class="<?php echo $promo_search->RightColumnClass ?>"><div <?php echo $promo_search->tanggal_berakhir->cellAttributes() ?>>
			<span id="el_promo_tanggal_berakhir" class="ew-search-field">
<input type="text" data-table="promo" data-field="x_tanggal_berakhir" name="x_tanggal_berakhir" id="x_tanggal_berakhir" maxlength="19" placeholder="<?php echo HtmlEncode($promo_search->tanggal_berakhir->getPlaceHolder()) ?>" value="<?php echo $promo_search->tanggal_berakhir->EditValue ?>"<?php echo $promo_search->tanggal_berakhir->editAttributes() ?>>
<?php if (!$promo_search->tanggal_berakhir->ReadOnly && !$promo_search->tanggal_berakhir->Disabled && !isset($promo_search->tanggal_berakhir->EditAttrs["readonly"]) && !isset($promo_search->tanggal_berakhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpromosearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpromosearch", "x_tanggal_berakhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$promo_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $promo_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$promo_search->showPageFooter();
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
$promo_search->terminate();
?>