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
$m_rekening_add = new m_rekening_add();

// Run the page
$m_rekening_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_rekening_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_rekeningadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_rekeningadd = currentForm = new ew.Form("fm_rekeningadd", "add");

	// Validate form
	fm_rekeningadd.validate = function() {
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
			<?php if ($m_rekening_add->id_bank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_bank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_add->id_bank->caption(), $m_rekening_add->id_bank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_add->id_klinik->caption(), $m_rekening_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_add->nama_rekening->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_rekening");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_add->nama_rekening->caption(), $m_rekening_add->nama_rekening->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_add->nomor_rekening->Required) { ?>
				elm = this.getElements("x" + infix + "_nomor_rekening");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_add->nomor_rekening->caption(), $m_rekening_add->nomor_rekening->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_rekening_add->saldo->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_rekening_add->saldo->caption(), $m_rekening_add->saldo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_rekening_add->saldo->errorMessage()) ?>");

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
	fm_rekeningadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_rekeningadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_rekeningadd.lists["x_id_bank"] = <?php echo $m_rekening_add->id_bank->Lookup->toClientList($m_rekening_add) ?>;
	fm_rekeningadd.lists["x_id_bank"].options = <?php echo JsonEncode($m_rekening_add->id_bank->lookupOptions()) ?>;
	fm_rekeningadd.lists["x_id_klinik"] = <?php echo $m_rekening_add->id_klinik->Lookup->toClientList($m_rekening_add) ?>;
	fm_rekeningadd.lists["x_id_klinik"].options = <?php echo JsonEncode($m_rekening_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fm_rekeningadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_rekening_add->showPageHeader(); ?>
<?php
$m_rekening_add->showMessage();
?>
<form name="fm_rekeningadd" id="fm_rekeningadd" class="<?php echo $m_rekening_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_rekening">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_rekening_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_rekening_add->id_bank->Visible) { // id_bank ?>
	<div id="r_id_bank" class="form-group row">
		<label id="elh_m_rekening_id_bank" for="x_id_bank" class="<?php echo $m_rekening_add->LeftColumnClass ?>"><?php echo $m_rekening_add->id_bank->caption() ?><?php echo $m_rekening_add->id_bank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_add->RightColumnClass ?>"><div <?php echo $m_rekening_add->id_bank->cellAttributes() ?>>
<span id="el_m_rekening_id_bank">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_rekening" data-field="x_id_bank" data-value-separator="<?php echo $m_rekening_add->id_bank->displayValueSeparatorAttribute() ?>" id="x_id_bank" name="x_id_bank"<?php echo $m_rekening_add->id_bank->editAttributes() ?>>
			<?php echo $m_rekening_add->id_bank->selectOptionListHtml("x_id_bank") ?>
		</select>
</div>
<?php echo $m_rekening_add->id_bank->Lookup->getParamTag($m_rekening_add, "p_x_id_bank") ?>
</span>
<?php echo $m_rekening_add->id_bank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_rekening_id_klinik" for="x_id_klinik" class="<?php echo $m_rekening_add->LeftColumnClass ?>"><?php echo $m_rekening_add->id_klinik->caption() ?><?php echo $m_rekening_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_add->RightColumnClass ?>"><div <?php echo $m_rekening_add->id_klinik->cellAttributes() ?>>
<span id="el_m_rekening_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_rekening" data-field="x_id_klinik" data-value-separator="<?php echo $m_rekening_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_rekening_add->id_klinik->editAttributes() ?>>
			<?php echo $m_rekening_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_rekening_add->id_klinik->Lookup->getParamTag($m_rekening_add, "p_x_id_klinik") ?>
</span>
<?php echo $m_rekening_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_add->nama_rekening->Visible) { // nama_rekening ?>
	<div id="r_nama_rekening" class="form-group row">
		<label id="elh_m_rekening_nama_rekening" for="x_nama_rekening" class="<?php echo $m_rekening_add->LeftColumnClass ?>"><?php echo $m_rekening_add->nama_rekening->caption() ?><?php echo $m_rekening_add->nama_rekening->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_add->RightColumnClass ?>"><div <?php echo $m_rekening_add->nama_rekening->cellAttributes() ?>>
<span id="el_m_rekening_nama_rekening">
<input type="text" data-table="m_rekening" data-field="x_nama_rekening" name="x_nama_rekening" id="x_nama_rekening" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_rekening_add->nama_rekening->getPlaceHolder()) ?>" value="<?php echo $m_rekening_add->nama_rekening->EditValue ?>"<?php echo $m_rekening_add->nama_rekening->editAttributes() ?>>
</span>
<?php echo $m_rekening_add->nama_rekening->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_add->nomor_rekening->Visible) { // nomor_rekening ?>
	<div id="r_nomor_rekening" class="form-group row">
		<label id="elh_m_rekening_nomor_rekening" for="x_nomor_rekening" class="<?php echo $m_rekening_add->LeftColumnClass ?>"><?php echo $m_rekening_add->nomor_rekening->caption() ?><?php echo $m_rekening_add->nomor_rekening->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_add->RightColumnClass ?>"><div <?php echo $m_rekening_add->nomor_rekening->cellAttributes() ?>>
<span id="el_m_rekening_nomor_rekening">
<input type="text" data-table="m_rekening" data-field="x_nomor_rekening" name="x_nomor_rekening" id="x_nomor_rekening" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_rekening_add->nomor_rekening->getPlaceHolder()) ?>" value="<?php echo $m_rekening_add->nomor_rekening->EditValue ?>"<?php echo $m_rekening_add->nomor_rekening->editAttributes() ?>>
</span>
<?php echo $m_rekening_add->nomor_rekening->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_rekening_add->saldo->Visible) { // saldo ?>
	<div id="r_saldo" class="form-group row">
		<label id="elh_m_rekening_saldo" for="x_saldo" class="<?php echo $m_rekening_add->LeftColumnClass ?>"><?php echo $m_rekening_add->saldo->caption() ?><?php echo $m_rekening_add->saldo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_rekening_add->RightColumnClass ?>"><div <?php echo $m_rekening_add->saldo->cellAttributes() ?>>
<span id="el_m_rekening_saldo">
<input type="text" data-table="m_rekening" data-field="x_saldo" name="x_saldo" id="x_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_rekening_add->saldo->getPlaceHolder()) ?>" value="<?php echo $m_rekening_add->saldo->EditValue ?>"<?php echo $m_rekening_add->saldo->editAttributes() ?>>
</span>
<?php echo $m_rekening_add->saldo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_rekening_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_rekening_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_rekening_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_rekening_add->showPageFooter();
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
$m_rekening_add->terminate();
?>