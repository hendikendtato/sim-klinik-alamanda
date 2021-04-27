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
$m_rekening_edit = new m_rekening_edit();

// Run the page
$m_rekening_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_rekening_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_rekeningedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_rekeningedit = currentForm = new ew.Form("fm_rekeningedit", "edit");

	// Validate form
	fm_rekeningedit.validate = function() {
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
			<?php if ($m_rekening_edit->id_rekening->Required) { ?>
				elm = this.getElements("x" + infix + "_id_rekening");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_edit->id_rekening->caption(), $m_rekening_edit->id_rekening->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_edit->id_bank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_bank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_edit->id_bank->caption(), $m_rekening_edit->id_bank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_edit->id_klinik->caption(), $m_rekening_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_edit->nama_rekening->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_rekening");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_edit->nama_rekening->caption(), $m_rekening_edit->nama_rekening->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_edit->nomor_rekening->Required) { ?>
				elm = this.getElements("x" + infix + "_nomor_rekening");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_edit->nomor_rekening->caption(), $m_rekening_edit->nomor_rekening->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_edit->saldo->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_edit->saldo->caption(), $m_rekening_edit->saldo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_rekening_edit->saldo->errorMessage()) ?>");

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
	fm_rekeningedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_rekeningedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_rekeningedit.lists["x_id_bank"] = <?php echo $m_rekening_edit->id_bank->Lookup->toClientList($m_rekening_edit) ?>;
	fm_rekeningedit.lists["x_id_bank"].options = <?php echo JsonEncode($m_rekening_edit->id_bank->lookupOptions()) ?>;
	fm_rekeningedit.lists["x_id_klinik"] = <?php echo $m_rekening_edit->id_klinik->Lookup->toClientList($m_rekening_edit) ?>;
	fm_rekeningedit.lists["x_id_klinik"].options = <?php echo JsonEncode($m_rekening_edit->id_klinik->lookupOptions()) ?>;
	loadjs.done("fm_rekeningedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_rekening_edit->showPageHeader(); ?>
<?php
$m_rekening_edit->showMessage();
?>
<form name="fm_rekeningedit" id="fm_rekeningedit" class="<?php echo $m_rekening_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_rekening">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_rekening_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_rekening_edit->id_rekening->Visible) { // id_rekening ?>
	<div id="r_id_rekening" class="form-group row">
		<label id="elh_m_rekening_id_rekening" class="<?php echo $m_rekening_edit->LeftColumnClass ?>"><?php echo $m_rekening_edit->id_rekening->caption() ?><?php echo $m_rekening_edit->id_rekening->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_edit->RightColumnClass ?>"><div <?php echo $m_rekening_edit->id_rekening->cellAttributes() ?>>
<span id="el_m_rekening_id_rekening">
<span<?php echo $m_rekening_edit->id_rekening->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_rekening_edit->id_rekening->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_rekening" data-field="x_id_rekening" name="x_id_rekening" id="x_id_rekening" value="<?php echo HtmlEncode($m_rekening_edit->id_rekening->CurrentValue) ?>">
<?php echo $m_rekening_edit->id_rekening->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_edit->id_bank->Visible) { // id_bank ?>
	<div id="r_id_bank" class="form-group row">
		<label id="elh_m_rekening_id_bank" for="x_id_bank" class="<?php echo $m_rekening_edit->LeftColumnClass ?>"><?php echo $m_rekening_edit->id_bank->caption() ?><?php echo $m_rekening_edit->id_bank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_edit->RightColumnClass ?>"><div <?php echo $m_rekening_edit->id_bank->cellAttributes() ?>>
<span id="el_m_rekening_id_bank">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_rekening" data-field="x_id_bank" data-value-separator="<?php echo $m_rekening_edit->id_bank->displayValueSeparatorAttribute() ?>" id="x_id_bank" name="x_id_bank"<?php echo $m_rekening_edit->id_bank->editAttributes() ?>>
			<?php echo $m_rekening_edit->id_bank->selectOptionListHtml("x_id_bank") ?>
		</select>
</div>
<?php echo $m_rekening_edit->id_bank->Lookup->getParamTag($m_rekening_edit, "p_x_id_bank") ?>
</span>
<?php echo $m_rekening_edit->id_bank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_rekening_id_klinik" for="x_id_klinik" class="<?php echo $m_rekening_edit->LeftColumnClass ?>"><?php echo $m_rekening_edit->id_klinik->caption() ?><?php echo $m_rekening_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_edit->RightColumnClass ?>"><div <?php echo $m_rekening_edit->id_klinik->cellAttributes() ?>>
<span id="el_m_rekening_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_rekening" data-field="x_id_klinik" data-value-separator="<?php echo $m_rekening_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_rekening_edit->id_klinik->editAttributes() ?>>
			<?php echo $m_rekening_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_rekening_edit->id_klinik->Lookup->getParamTag($m_rekening_edit, "p_x_id_klinik") ?>
</span>
<?php echo $m_rekening_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_edit->nama_rekening->Visible) { // nama_rekening ?>
	<div id="r_nama_rekening" class="form-group row">
		<label id="elh_m_rekening_nama_rekening" for="x_nama_rekening" class="<?php echo $m_rekening_edit->LeftColumnClass ?>"><?php echo $m_rekening_edit->nama_rekening->caption() ?><?php echo $m_rekening_edit->nama_rekening->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_edit->RightColumnClass ?>"><div <?php echo $m_rekening_edit->nama_rekening->cellAttributes() ?>>
<span id="el_m_rekening_nama_rekening">
<input type="text" data-table="m_rekening" data-field="x_nama_rekening" name="x_nama_rekening" id="x_nama_rekening" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_rekening_edit->nama_rekening->getPlaceHolder()) ?>" value="<?php echo $m_rekening_edit->nama_rekening->EditValue ?>"<?php echo $m_rekening_edit->nama_rekening->editAttributes() ?>>
</span>
<?php echo $m_rekening_edit->nama_rekening->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_edit->nomor_rekening->Visible) { // nomor_rekening ?>
	<div id="r_nomor_rekening" class="form-group row">
		<label id="elh_m_rekening_nomor_rekening" for="x_nomor_rekening" class="<?php echo $m_rekening_edit->LeftColumnClass ?>"><?php echo $m_rekening_edit->nomor_rekening->caption() ?><?php echo $m_rekening_edit->nomor_rekening->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_edit->RightColumnClass ?>"><div <?php echo $m_rekening_edit->nomor_rekening->cellAttributes() ?>>
<span id="el_m_rekening_nomor_rekening">
<input type="text" data-table="m_rekening" data-field="x_nomor_rekening" name="x_nomor_rekening" id="x_nomor_rekening" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_rekening_edit->nomor_rekening->getPlaceHolder()) ?>" value="<?php echo $m_rekening_edit->nomor_rekening->EditValue ?>"<?php echo $m_rekening_edit->nomor_rekening->editAttributes() ?>>
</span>
<?php echo $m_rekening_edit->nomor_rekening->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_edit->saldo->Visible) { // saldo ?>
	<div id="r_saldo" class="form-group row">
		<label id="elh_m_rekening_saldo" for="x_saldo" class="<?php echo $m_rekening_edit->LeftColumnClass ?>"><?php echo $m_rekening_edit->saldo->caption() ?><?php echo $m_rekening_edit->saldo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_edit->RightColumnClass ?>"><div <?php echo $m_rekening_edit->saldo->cellAttributes() ?>>
<span id="el_m_rekening_saldo">
<input type="text" data-table="m_rekening" data-field="x_saldo" name="x_saldo" id="x_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_rekening_edit->saldo->getPlaceHolder()) ?>" value="<?php echo $m_rekening_edit->saldo->EditValue ?>"<?php echo $m_rekening_edit->saldo->editAttributes() ?>>
</span>
<?php echo $m_rekening_edit->saldo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_rekening_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_rekening_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_rekening_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_rekening_edit->showPageFooter();
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
$m_rekening_edit->terminate();
?>