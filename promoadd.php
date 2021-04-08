<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$promo_add = new promo_add();

// Run the page
$promo_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promo_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpromoadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpromoadd = currentForm = new ew.Form("fpromoadd", "add");

	// Validate form
	fpromoadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($promo_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_add->nama->caption(), $promo_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($promo_add->tanggal_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_add->tanggal_mulai->caption(), $promo_add->tanggal_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_mulai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($promo_add->tanggal_mulai->errorMessage()) ?>");
			<?php if ($promo_add->tanggal_berakhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_berakhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_add->tanggal_berakhir->caption(), $promo_add->tanggal_berakhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_berakhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($promo_add->tanggal_berakhir->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fpromoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpromoadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpromoadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $promo_add->showPageHeader(); ?>
<?php
$promo_add->showMessage();
?>
<form name="fpromoadd" id="fpromoadd" class="<?php echo $promo_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promo">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$promo_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($promo_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_promo_nama" for="x_nama" class="<?php echo $promo_add->LeftColumnClass ?>"><?php echo $promo_add->nama->caption() ?><?php echo $promo_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_add->RightColumnClass ?>"><div <?php echo $promo_add->nama->cellAttributes() ?>>
<span id="el_promo_nama">
<input type="text" data-table="promo" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($promo_add->nama->getPlaceHolder()) ?>" value="<?php echo $promo_add->nama->EditValue ?>"<?php echo $promo_add->nama->editAttributes() ?>>
</span>
<?php echo $promo_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promo_add->tanggal_mulai->Visible) { // tanggal_mulai ?>
	<div id="r_tanggal_mulai" class="form-group row">
		<label id="elh_promo_tanggal_mulai" for="x_tanggal_mulai" class="<?php echo $promo_add->LeftColumnClass ?>"><?php echo $promo_add->tanggal_mulai->caption() ?><?php echo $promo_add->tanggal_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_add->RightColumnClass ?>"><div <?php echo $promo_add->tanggal_mulai->cellAttributes() ?>>
<span id="el_promo_tanggal_mulai">
<input type="text" data-table="promo" data-field="x_tanggal_mulai" name="x_tanggal_mulai" id="x_tanggal_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($promo_add->tanggal_mulai->getPlaceHolder()) ?>" value="<?php echo $promo_add->tanggal_mulai->EditValue ?>"<?php echo $promo_add->tanggal_mulai->editAttributes() ?>>
<?php if (!$promo_add->tanggal_mulai->ReadOnly && !$promo_add->tanggal_mulai->Disabled && !isset($promo_add->tanggal_mulai->EditAttrs["readonly"]) && !isset($promo_add->tanggal_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpromoadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpromoadd", "x_tanggal_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $promo_add->tanggal_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promo_add->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
	<div id="r_tanggal_berakhir" class="form-group row">
		<label id="elh_promo_tanggal_berakhir" for="x_tanggal_berakhir" class="<?php echo $promo_add->LeftColumnClass ?>"><?php echo $promo_add->tanggal_berakhir->caption() ?><?php echo $promo_add->tanggal_berakhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_add->RightColumnClass ?>"><div <?php echo $promo_add->tanggal_berakhir->cellAttributes() ?>>
<span id="el_promo_tanggal_berakhir">
<input type="text" data-table="promo" data-field="x_tanggal_berakhir" name="x_tanggal_berakhir" id="x_tanggal_berakhir" maxlength="19" placeholder="<?php echo HtmlEncode($promo_add->tanggal_berakhir->getPlaceHolder()) ?>" value="<?php echo $promo_add->tanggal_berakhir->EditValue ?>"<?php echo $promo_add->tanggal_berakhir->editAttributes() ?>>
<?php if (!$promo_add->tanggal_berakhir->ReadOnly && !$promo_add->tanggal_berakhir->Disabled && !isset($promo_add->tanggal_berakhir->EditAttrs["readonly"]) && !isset($promo_add->tanggal_berakhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpromoadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpromoadd", "x_tanggal_berakhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $promo_add->tanggal_berakhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailpromo", explode(",", $promo->getCurrentDetailTable())) && $detailpromo->DetailAdd) {
?>
<?php if ($promo->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpromo", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpromogrid.php" ?>
<?php } ?>
<?php if (!$promo_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $promo_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $promo_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$promo_add->showPageFooter();
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
$promo_add->terminate();
?>