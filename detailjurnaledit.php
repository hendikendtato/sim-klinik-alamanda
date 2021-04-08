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
$detailjurnal_edit = new detailjurnal_edit();

// Run the page
$detailjurnal_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailjurnal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailjurnaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailjurnaledit = currentForm = new ew.Form("fdetailjurnaledit", "edit");

	// Validate form
	fdetailjurnaledit.validate = function() {
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
			<?php if ($detailjurnal_edit->id_detailjurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_detailjurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_edit->id_detailjurnal->caption(), $detailjurnal_edit->id_detailjurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailjurnal_edit->id_jurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_edit->id_jurnal->caption(), $detailjurnal_edit->id_jurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_jurnal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailjurnal_edit->id_jurnal->errorMessage()) ?>");
			<?php if ($detailjurnal_edit->id_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_id_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_edit->id_akun->caption(), $detailjurnal_edit->id_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailjurnal_edit->debet->Required) { ?>
				elm = this.getElements("x" + infix + "_debet");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_edit->debet->caption(), $detailjurnal_edit->debet->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_debet");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailjurnal_edit->debet->errorMessage()) ?>");
			<?php if ($detailjurnal_edit->kredit->Required) { ?>
				elm = this.getElements("x" + infix + "_kredit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailjurnal_edit->kredit->caption(), $detailjurnal_edit->kredit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kredit");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailjurnal_edit->kredit->errorMessage()) ?>");

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
	fdetailjurnaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailjurnaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailjurnaledit.lists["x_id_akun"] = <?php echo $detailjurnal_edit->id_akun->Lookup->toClientList($detailjurnal_edit) ?>;
	fdetailjurnaledit.lists["x_id_akun"].options = <?php echo JsonEncode($detailjurnal_edit->id_akun->lookupOptions()) ?>;
	loadjs.done("fdetailjurnaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailjurnal_edit->showPageHeader(); ?>
<?php
$detailjurnal_edit->showMessage();
?>
<form name="fdetailjurnaledit" id="fdetailjurnaledit" class="<?php echo $detailjurnal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailjurnal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailjurnal_edit->IsModal ?>">
<?php if ($detailjurnal->getCurrentMasterTable() == "jurnal") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="jurnal">
<input type="hidden" name="fk_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_edit->id_jurnal->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailjurnal_edit->id_detailjurnal->Visible) { // id_detailjurnal ?>
	<div id="r_id_detailjurnal" class="form-group row">
		<label id="elh_detailjurnal_id_detailjurnal" class="<?php echo $detailjurnal_edit->LeftColumnClass ?>"><?php echo $detailjurnal_edit->id_detailjurnal->caption() ?><?php echo $detailjurnal_edit->id_detailjurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailjurnal_edit->RightColumnClass ?>"><div <?php echo $detailjurnal_edit->id_detailjurnal->cellAttributes() ?>>
<span id="el_detailjurnal_id_detailjurnal">
<span<?php echo $detailjurnal_edit->id_detailjurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_edit->id_detailjurnal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailjurnal" data-field="x_id_detailjurnal" name="x_id_detailjurnal" id="x_id_detailjurnal" value="<?php echo HtmlEncode($detailjurnal_edit->id_detailjurnal->CurrentValue) ?>">
<?php echo $detailjurnal_edit->id_detailjurnal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailjurnal_edit->id_jurnal->Visible) { // id_jurnal ?>
	<div id="r_id_jurnal" class="form-group row">
		<label id="elh_detailjurnal_id_jurnal" for="x_id_jurnal" class="<?php echo $detailjurnal_edit->LeftColumnClass ?>"><?php echo $detailjurnal_edit->id_jurnal->caption() ?><?php echo $detailjurnal_edit->id_jurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailjurnal_edit->RightColumnClass ?>"><div <?php echo $detailjurnal_edit->id_jurnal->cellAttributes() ?>>
<?php if ($detailjurnal_edit->id_jurnal->getSessionValue() != "") { ?>
<span id="el_detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_edit->id_jurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailjurnal_edit->id_jurnal->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_jurnal" name="x_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_edit->id_jurnal->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailjurnal_id_jurnal">
<input type="text" data-table="detailjurnal" data-field="x_id_jurnal" name="x_id_jurnal" id="x_id_jurnal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailjurnal_edit->id_jurnal->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_edit->id_jurnal->EditValue ?>"<?php echo $detailjurnal_edit->id_jurnal->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailjurnal_edit->id_jurnal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailjurnal_edit->id_akun->Visible) { // id_akun ?>
	<div id="r_id_akun" class="form-group row">
		<label id="elh_detailjurnal_id_akun" for="x_id_akun" class="<?php echo $detailjurnal_edit->LeftColumnClass ?>"><?php echo $detailjurnal_edit->id_akun->caption() ?><?php echo $detailjurnal_edit->id_akun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailjurnal_edit->RightColumnClass ?>"><div <?php echo $detailjurnal_edit->id_akun->cellAttributes() ?>>
<span id="el_detailjurnal_id_akun">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailjurnal" data-field="x_id_akun" data-value-separator="<?php echo $detailjurnal_edit->id_akun->displayValueSeparatorAttribute() ?>" id="x_id_akun" name="x_id_akun"<?php echo $detailjurnal_edit->id_akun->editAttributes() ?>>
			<?php echo $detailjurnal_edit->id_akun->selectOptionListHtml("x_id_akun") ?>
		</select>
</div>
<?php echo $detailjurnal_edit->id_akun->Lookup->getParamTag($detailjurnal_edit, "p_x_id_akun") ?>
</span>
<?php echo $detailjurnal_edit->id_akun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailjurnal_edit->debet->Visible) { // debet ?>
	<div id="r_debet" class="form-group row">
		<label id="elh_detailjurnal_debet" for="x_debet" class="<?php echo $detailjurnal_edit->LeftColumnClass ?>"><?php echo $detailjurnal_edit->debet->caption() ?><?php echo $detailjurnal_edit->debet->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailjurnal_edit->RightColumnClass ?>"><div <?php echo $detailjurnal_edit->debet->cellAttributes() ?>>
<span id="el_detailjurnal_debet">
<input type="text" data-table="detailjurnal" data-field="x_debet" name="x_debet" id="x_debet" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_edit->debet->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_edit->debet->EditValue ?>"<?php echo $detailjurnal_edit->debet->editAttributes() ?>>
</span>
<?php echo $detailjurnal_edit->debet->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailjurnal_edit->kredit->Visible) { // kredit ?>
	<div id="r_kredit" class="form-group row">
		<label id="elh_detailjurnal_kredit" for="x_kredit" class="<?php echo $detailjurnal_edit->LeftColumnClass ?>"><?php echo $detailjurnal_edit->kredit->caption() ?><?php echo $detailjurnal_edit->kredit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailjurnal_edit->RightColumnClass ?>"><div <?php echo $detailjurnal_edit->kredit->cellAttributes() ?>>
<span id="el_detailjurnal_kredit">
<input type="text" data-table="detailjurnal" data-field="x_kredit" name="x_kredit" id="x_kredit" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailjurnal_edit->kredit->getPlaceHolder()) ?>" value="<?php echo $detailjurnal_edit->kredit->EditValue ?>"<?php echo $detailjurnal_edit->kredit->editAttributes() ?>>
</span>
<?php echo $detailjurnal_edit->kredit->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailjurnal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailjurnal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailjurnal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailjurnal_edit->showPageFooter();
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
$detailjurnal_edit->terminate();
?>