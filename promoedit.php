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
$promo_edit = new promo_edit();

// Run the page
$promo_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$promo_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpromoedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpromoedit = currentForm = new ew.Form("fpromoedit", "edit");

	// Validate form
	fpromoedit.validate = function() {
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
			<?php if ($promo_edit->id_promo->Required) { ?>
				elm = this.getElements("x" + infix + "_id_promo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_edit->id_promo->caption(), $promo_edit->id_promo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($promo_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_edit->nama->caption(), $promo_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($promo_edit->tanggal_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_edit->tanggal_mulai->caption(), $promo_edit->tanggal_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_mulai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($promo_edit->tanggal_mulai->errorMessage()) ?>");
			<?php if ($promo_edit->tanggal_berakhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_berakhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $promo_edit->tanggal_berakhir->caption(), $promo_edit->tanggal_berakhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_berakhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($promo_edit->tanggal_berakhir->errorMessage()) ?>");

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
	fpromoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpromoedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpromoedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $promo_edit->showPageHeader(); ?>
<?php
$promo_edit->showMessage();
?>
<form name="fpromoedit" id="fpromoedit" class="<?php echo $promo_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="promo">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$promo_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($promo_edit->id_promo->Visible) { // id_promo ?>
	<div id="r_id_promo" class="form-group row">
		<label id="elh_promo_id_promo" class="<?php echo $promo_edit->LeftColumnClass ?>"><?php echo $promo_edit->id_promo->caption() ?><?php echo $promo_edit->id_promo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_edit->RightColumnClass ?>"><div <?php echo $promo_edit->id_promo->cellAttributes() ?>>
<span id="el_promo_id_promo">
<span<?php echo $promo_edit->id_promo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($promo_edit->id_promo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="promo" data-field="x_id_promo" name="x_id_promo" id="x_id_promo" value="<?php echo HtmlEncode($promo_edit->id_promo->CurrentValue) ?>">
<?php echo $promo_edit->id_promo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promo_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_promo_nama" for="x_nama" class="<?php echo $promo_edit->LeftColumnClass ?>"><?php echo $promo_edit->nama->caption() ?><?php echo $promo_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_edit->RightColumnClass ?>"><div <?php echo $promo_edit->nama->cellAttributes() ?>>
<span id="el_promo_nama">
<input type="text" data-table="promo" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($promo_edit->nama->getPlaceHolder()) ?>" value="<?php echo $promo_edit->nama->EditValue ?>"<?php echo $promo_edit->nama->editAttributes() ?>>
</span>
<?php echo $promo_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promo_edit->tanggal_mulai->Visible) { // tanggal_mulai ?>
	<div id="r_tanggal_mulai" class="form-group row">
		<label id="elh_promo_tanggal_mulai" for="x_tanggal_mulai" class="<?php echo $promo_edit->LeftColumnClass ?>"><?php echo $promo_edit->tanggal_mulai->caption() ?><?php echo $promo_edit->tanggal_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_edit->RightColumnClass ?>"><div <?php echo $promo_edit->tanggal_mulai->cellAttributes() ?>>
<span id="el_promo_tanggal_mulai">
<input type="text" data-table="promo" data-field="x_tanggal_mulai" name="x_tanggal_mulai" id="x_tanggal_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($promo_edit->tanggal_mulai->getPlaceHolder()) ?>" value="<?php echo $promo_edit->tanggal_mulai->EditValue ?>"<?php echo $promo_edit->tanggal_mulai->editAttributes() ?>>
<?php if (!$promo_edit->tanggal_mulai->ReadOnly && !$promo_edit->tanggal_mulai->Disabled && !isset($promo_edit->tanggal_mulai->EditAttrs["readonly"]) && !isset($promo_edit->tanggal_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpromoedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpromoedit", "x_tanggal_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $promo_edit->tanggal_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($promo_edit->tanggal_berakhir->Visible) { // tanggal_berakhir ?>
	<div id="r_tanggal_berakhir" class="form-group row">
		<label id="elh_promo_tanggal_berakhir" for="x_tanggal_berakhir" class="<?php echo $promo_edit->LeftColumnClass ?>"><?php echo $promo_edit->tanggal_berakhir->caption() ?><?php echo $promo_edit->tanggal_berakhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $promo_edit->RightColumnClass ?>"><div <?php echo $promo_edit->tanggal_berakhir->cellAttributes() ?>>
<span id="el_promo_tanggal_berakhir">
<input type="text" data-table="promo" data-field="x_tanggal_berakhir" name="x_tanggal_berakhir" id="x_tanggal_berakhir" maxlength="19" placeholder="<?php echo HtmlEncode($promo_edit->tanggal_berakhir->getPlaceHolder()) ?>" value="<?php echo $promo_edit->tanggal_berakhir->EditValue ?>"<?php echo $promo_edit->tanggal_berakhir->editAttributes() ?>>
<?php if (!$promo_edit->tanggal_berakhir->ReadOnly && !$promo_edit->tanggal_berakhir->Disabled && !isset($promo_edit->tanggal_berakhir->EditAttrs["readonly"]) && !isset($promo_edit->tanggal_berakhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpromoedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpromoedit", "x_tanggal_berakhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $promo_edit->tanggal_berakhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailpromo", explode(",", $promo->getCurrentDetailTable())) && $detailpromo->DetailEdit) {
?>
<?php if ($promo->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpromo", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpromogrid.php" ?>
<?php } ?>
<?php if (!$promo_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $promo_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $promo_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$promo_edit->showPageFooter();
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
$promo_edit->terminate();
?>