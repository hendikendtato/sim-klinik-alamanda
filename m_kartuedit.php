<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$m_kartu_edit = new m_kartu_edit();

// Run the page
$m_kartu_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kartu_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kartuedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_kartuedit = currentForm = new ew.Form("fm_kartuedit", "edit");

	// Validate form
	fm_kartuedit.validate = function() {
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
			<?php if ($m_kartu_edit->id_kartu->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kartu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kartu_edit->id_kartu->caption(), $m_kartu_edit->id_kartu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kartu");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_kartu_edit->id_kartu->errorMessage()) ?>");
			<?php if ($m_kartu_edit->id_bank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_bank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kartu_edit->id_bank->caption(), $m_kartu_edit->id_bank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kartu_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kartu_edit->jenis->caption(), $m_kartu_edit->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kartu_edit->nama_kartu->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_kartu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kartu_edit->nama_kartu->caption(), $m_kartu_edit->nama_kartu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kartu_edit->charge_type->Required) { ?>
				elm = this.getElements("x" + infix + "_charge_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kartu_edit->charge_type->caption(), $m_kartu_edit->charge_type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kartu_edit->charge_price->Required) { ?>
				elm = this.getElements("x" + infix + "_charge_price");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kartu_edit->charge_price->caption(), $m_kartu_edit->charge_price->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_charge_price");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_kartu_edit->charge_price->errorMessage()) ?>");

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
	fm_kartuedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_kartuedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_kartuedit.lists["x_id_bank"] = <?php echo $m_kartu_edit->id_bank->Lookup->toClientList($m_kartu_edit) ?>;
	fm_kartuedit.lists["x_id_bank"].options = <?php echo JsonEncode($m_kartu_edit->id_bank->lookupOptions()) ?>;
	fm_kartuedit.lists["x_jenis"] = <?php echo $m_kartu_edit->jenis->Lookup->toClientList($m_kartu_edit) ?>;
	fm_kartuedit.lists["x_jenis"].options = <?php echo JsonEncode($m_kartu_edit->jenis->options(FALSE, TRUE)) ?>;
	fm_kartuedit.lists["x_charge_type"] = <?php echo $m_kartu_edit->charge_type->Lookup->toClientList($m_kartu_edit) ?>;
	fm_kartuedit.lists["x_charge_type"].options = <?php echo JsonEncode($m_kartu_edit->charge_type->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_kartuedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kartu_edit->showPageHeader(); ?>
<?php
$m_kartu_edit->showMessage();
?>
<form name="fm_kartuedit" id="fm_kartuedit" class="<?php echo $m_kartu_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kartu">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_kartu_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_kartu_edit->id_kartu->Visible) { // id_kartu ?>
	<div id="r_id_kartu" class="form-group row">
		<label id="elh_m_kartu_id_kartu" for="x_id_kartu" class="<?php echo $m_kartu_edit->LeftColumnClass ?>"><?php echo $m_kartu_edit->id_kartu->caption() ?><?php echo $m_kartu_edit->id_kartu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kartu_edit->RightColumnClass ?>"><div <?php echo $m_kartu_edit->id_kartu->cellAttributes() ?>>
<span id="el_m_kartu_id_kartu">
<span<?php echo $m_kartu_edit->id_kartu->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_kartu_edit->id_kartu->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_kartu" data-field="x_id_kartu" name="x_id_kartu" id="x_id_kartu" value="<?php echo HtmlEncode($m_kartu_edit->id_kartu->CurrentValue) ?>">
<?php echo $m_kartu_edit->id_kartu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kartu_edit->id_bank->Visible) { // id_bank ?>
	<div id="r_id_bank" class="form-group row">
		<label id="elh_m_kartu_id_bank" for="x_id_bank" class="<?php echo $m_kartu_edit->LeftColumnClass ?>"><?php echo $m_kartu_edit->id_bank->caption() ?><?php echo $m_kartu_edit->id_bank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kartu_edit->RightColumnClass ?>"><div <?php echo $m_kartu_edit->id_bank->cellAttributes() ?>>
<span id="el_m_kartu_id_bank">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_kartu" data-field="x_id_bank" data-value-separator="<?php echo $m_kartu_edit->id_bank->displayValueSeparatorAttribute() ?>" id="x_id_bank" name="x_id_bank"<?php echo $m_kartu_edit->id_bank->editAttributes() ?>>
			<?php echo $m_kartu_edit->id_bank->selectOptionListHtml("x_id_bank") ?>
		</select>
</div>
<?php echo $m_kartu_edit->id_bank->Lookup->getParamTag($m_kartu_edit, "p_x_id_bank") ?>
</span>
<?php echo $m_kartu_edit->id_bank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kartu_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_m_kartu_jenis" for="x_jenis" class="<?php echo $m_kartu_edit->LeftColumnClass ?>"><?php echo $m_kartu_edit->jenis->caption() ?><?php echo $m_kartu_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kartu_edit->RightColumnClass ?>"><div <?php echo $m_kartu_edit->jenis->cellAttributes() ?>>
<span id="el_m_kartu_jenis">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_kartu" data-field="x_jenis" data-value-separator="<?php echo $m_kartu_edit->jenis->displayValueSeparatorAttribute() ?>" id="x_jenis" name="x_jenis"<?php echo $m_kartu_edit->jenis->editAttributes() ?>>
			<?php echo $m_kartu_edit->jenis->selectOptionListHtml("x_jenis") ?>
		</select>
</div>
</span>
<?php echo $m_kartu_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kartu_edit->nama_kartu->Visible) { // nama_kartu ?>
	<div id="r_nama_kartu" class="form-group row">
		<label id="elh_m_kartu_nama_kartu" for="x_nama_kartu" class="<?php echo $m_kartu_edit->LeftColumnClass ?>"><?php echo $m_kartu_edit->nama_kartu->caption() ?><?php echo $m_kartu_edit->nama_kartu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kartu_edit->RightColumnClass ?>"><div <?php echo $m_kartu_edit->nama_kartu->cellAttributes() ?>>
<span id="el_m_kartu_nama_kartu">
<input type="text" data-table="m_kartu" data-field="x_nama_kartu" name="x_nama_kartu" id="x_nama_kartu" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_kartu_edit->nama_kartu->getPlaceHolder()) ?>" value="<?php echo $m_kartu_edit->nama_kartu->EditValue ?>"<?php echo $m_kartu_edit->nama_kartu->editAttributes() ?>>
</span>
<?php echo $m_kartu_edit->nama_kartu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kartu_edit->charge_type->Visible) { // charge_type ?>
	<div id="r_charge_type" class="form-group row">
		<label id="elh_m_kartu_charge_type" class="<?php echo $m_kartu_edit->LeftColumnClass ?>"><?php echo $m_kartu_edit->charge_type->caption() ?><?php echo $m_kartu_edit->charge_type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kartu_edit->RightColumnClass ?>"><div <?php echo $m_kartu_edit->charge_type->cellAttributes() ?>>
<span id="el_m_kartu_charge_type">
<div id="tp_x_charge_type" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_kartu" data-field="x_charge_type" data-value-separator="<?php echo $m_kartu_edit->charge_type->displayValueSeparatorAttribute() ?>" name="x_charge_type" id="x_charge_type" value="{value}"<?php echo $m_kartu_edit->charge_type->editAttributes() ?>></div>
<div id="dsl_x_charge_type" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_kartu_edit->charge_type->radioButtonListHtml(FALSE, "x_charge_type") ?>
</div></div>
</span>
<?php echo $m_kartu_edit->charge_type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kartu_edit->charge_price->Visible) { // charge_price ?>
	<div id="r_charge_price" class="form-group row">
		<label id="elh_m_kartu_charge_price" for="x_charge_price" class="<?php echo $m_kartu_edit->LeftColumnClass ?>"><?php echo $m_kartu_edit->charge_price->caption() ?><?php echo $m_kartu_edit->charge_price->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kartu_edit->RightColumnClass ?>"><div <?php echo $m_kartu_edit->charge_price->cellAttributes() ?>>
<span id="el_m_kartu_charge_price">
<input type="text" data-table="m_kartu" data-field="x_charge_price" name="x_charge_price" id="x_charge_price" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($m_kartu_edit->charge_price->getPlaceHolder()) ?>" value="<?php echo $m_kartu_edit->charge_price->EditValue ?>"<?php echo $m_kartu_edit->charge_price->editAttributes() ?>>
</span>
<?php echo $m_kartu_edit->charge_price->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_kartu_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_kartu_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kartu_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_kartu_edit->showPageFooter();
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
$m_kartu_edit->terminate();
?>