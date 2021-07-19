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
$m_target_omset_personal_edit = new m_target_omset_personal_edit();

// Run the page
$m_target_omset_personal_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_omset_personal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_target_omset_personaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_target_omset_personaledit = currentForm = new ew.Form("fm_target_omset_personaledit", "edit");

	// Validate form
	fm_target_omset_personaledit.validate = function() {
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
			<?php if ($m_target_omset_personal_edit->id_target_omset_personal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_target_omset_personal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_omset_personal_edit->id_target_omset_personal->caption(), $m_target_omset_personal_edit->id_target_omset_personal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_target_omset_personal_edit->id_cabang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_cabang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_omset_personal_edit->id_cabang->caption(), $m_target_omset_personal_edit->id_cabang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_target_omset_personal_edit->id_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_omset_personal_edit->id_jabatan->caption(), $m_target_omset_personal_edit->id_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_target_omset_personal_edit->tgl_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_omset_personal_edit->tgl_awal->caption(), $m_target_omset_personal_edit->tgl_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_target_omset_personal_edit->tgl_awal->errorMessage()) ?>");
			<?php if ($m_target_omset_personal_edit->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_omset_personal_edit->tgl_akhir->caption(), $m_target_omset_personal_edit->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_target_omset_personal_edit->tgl_akhir->errorMessage()) ?>");
			<?php if ($m_target_omset_personal_edit->target->Required) { ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_omset_personal_edit->target->caption(), $m_target_omset_personal_edit->target->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_target_omset_personal_edit->target->errorMessage()) ?>");

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
	fm_target_omset_personaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_target_omset_personaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_target_omset_personaledit.lists["x_id_cabang"] = <?php echo $m_target_omset_personal_edit->id_cabang->Lookup->toClientList($m_target_omset_personal_edit) ?>;
	fm_target_omset_personaledit.lists["x_id_cabang"].options = <?php echo JsonEncode($m_target_omset_personal_edit->id_cabang->lookupOptions()) ?>;
	fm_target_omset_personaledit.lists["x_id_jabatan"] = <?php echo $m_target_omset_personal_edit->id_jabatan->Lookup->toClientList($m_target_omset_personal_edit) ?>;
	fm_target_omset_personaledit.lists["x_id_jabatan"].options = <?php echo JsonEncode($m_target_omset_personal_edit->id_jabatan->lookupOptions()) ?>;
	loadjs.done("fm_target_omset_personaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_target_omset_personal_edit->showPageHeader(); ?>
<?php
$m_target_omset_personal_edit->showMessage();
?>
<form name="fm_target_omset_personaledit" id="fm_target_omset_personaledit" class="<?php echo $m_target_omset_personal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_omset_personal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_target_omset_personal_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_target_omset_personal_edit->id_target_omset_personal->Visible) { // id_target_omset_personal ?>
	<div id="r_id_target_omset_personal" class="form-group row">
		<label id="elh_m_target_omset_personal_id_target_omset_personal" class="<?php echo $m_target_omset_personal_edit->LeftColumnClass ?>"><?php echo $m_target_omset_personal_edit->id_target_omset_personal->caption() ?><?php echo $m_target_omset_personal_edit->id_target_omset_personal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_omset_personal_edit->RightColumnClass ?>"><div <?php echo $m_target_omset_personal_edit->id_target_omset_personal->cellAttributes() ?>>
<span id="el_m_target_omset_personal_id_target_omset_personal">
<span<?php echo $m_target_omset_personal_edit->id_target_omset_personal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_target_omset_personal_edit->id_target_omset_personal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_target_omset_personal" data-field="x_id_target_omset_personal" name="x_id_target_omset_personal" id="x_id_target_omset_personal" value="<?php echo HtmlEncode($m_target_omset_personal_edit->id_target_omset_personal->CurrentValue) ?>">
<?php echo $m_target_omset_personal_edit->id_target_omset_personal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_omset_personal_edit->id_cabang->Visible) { // id_cabang ?>
	<div id="r_id_cabang" class="form-group row">
		<label id="elh_m_target_omset_personal_id_cabang" for="x_id_cabang" class="<?php echo $m_target_omset_personal_edit->LeftColumnClass ?>"><?php echo $m_target_omset_personal_edit->id_cabang->caption() ?><?php echo $m_target_omset_personal_edit->id_cabang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_omset_personal_edit->RightColumnClass ?>"><div <?php echo $m_target_omset_personal_edit->id_cabang->cellAttributes() ?>>
<span id="el_m_target_omset_personal_id_cabang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_target_omset_personal" data-field="x_id_cabang" data-value-separator="<?php echo $m_target_omset_personal_edit->id_cabang->displayValueSeparatorAttribute() ?>" id="x_id_cabang" name="x_id_cabang"<?php echo $m_target_omset_personal_edit->id_cabang->editAttributes() ?>>
			<?php echo $m_target_omset_personal_edit->id_cabang->selectOptionListHtml("x_id_cabang") ?>
		</select>
</div>
<?php echo $m_target_omset_personal_edit->id_cabang->Lookup->getParamTag($m_target_omset_personal_edit, "p_x_id_cabang") ?>
</span>
<?php echo $m_target_omset_personal_edit->id_cabang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_omset_personal_edit->id_jabatan->Visible) { // id_jabatan ?>
	<div id="r_id_jabatan" class="form-group row">
		<label id="elh_m_target_omset_personal_id_jabatan" for="x_id_jabatan" class="<?php echo $m_target_omset_personal_edit->LeftColumnClass ?>"><?php echo $m_target_omset_personal_edit->id_jabatan->caption() ?><?php echo $m_target_omset_personal_edit->id_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_omset_personal_edit->RightColumnClass ?>"><div <?php echo $m_target_omset_personal_edit->id_jabatan->cellAttributes() ?>>
<span id="el_m_target_omset_personal_id_jabatan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_target_omset_personal" data-field="x_id_jabatan" data-value-separator="<?php echo $m_target_omset_personal_edit->id_jabatan->displayValueSeparatorAttribute() ?>" id="x_id_jabatan" name="x_id_jabatan"<?php echo $m_target_omset_personal_edit->id_jabatan->editAttributes() ?>>
			<?php echo $m_target_omset_personal_edit->id_jabatan->selectOptionListHtml("x_id_jabatan") ?>
		</select>
</div>
<?php echo $m_target_omset_personal_edit->id_jabatan->Lookup->getParamTag($m_target_omset_personal_edit, "p_x_id_jabatan") ?>
</span>
<?php echo $m_target_omset_personal_edit->id_jabatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_omset_personal_edit->tgl_awal->Visible) { // tgl_awal ?>
	<div id="r_tgl_awal" class="form-group row">
		<label id="elh_m_target_omset_personal_tgl_awal" for="x_tgl_awal" class="<?php echo $m_target_omset_personal_edit->LeftColumnClass ?>"><?php echo $m_target_omset_personal_edit->tgl_awal->caption() ?><?php echo $m_target_omset_personal_edit->tgl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_omset_personal_edit->RightColumnClass ?>"><div <?php echo $m_target_omset_personal_edit->tgl_awal->cellAttributes() ?>>
<span id="el_m_target_omset_personal_tgl_awal">
<input type="text" data-table="m_target_omset_personal" data-field="x_tgl_awal" name="x_tgl_awal" id="x_tgl_awal" maxlength="10" placeholder="<?php echo HtmlEncode($m_target_omset_personal_edit->tgl_awal->getPlaceHolder()) ?>" value="<?php echo $m_target_omset_personal_edit->tgl_awal->EditValue ?>"<?php echo $m_target_omset_personal_edit->tgl_awal->editAttributes() ?>>
<?php if (!$m_target_omset_personal_edit->tgl_awal->ReadOnly && !$m_target_omset_personal_edit->tgl_awal->Disabled && !isset($m_target_omset_personal_edit->tgl_awal->EditAttrs["readonly"]) && !isset($m_target_omset_personal_edit->tgl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_target_omset_personaledit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_target_omset_personaledit", "x_tgl_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_target_omset_personal_edit->tgl_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_omset_personal_edit->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_m_target_omset_personal_tgl_akhir" for="x_tgl_akhir" class="<?php echo $m_target_omset_personal_edit->LeftColumnClass ?>"><?php echo $m_target_omset_personal_edit->tgl_akhir->caption() ?><?php echo $m_target_omset_personal_edit->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_omset_personal_edit->RightColumnClass ?>"><div <?php echo $m_target_omset_personal_edit->tgl_akhir->cellAttributes() ?>>
<span id="el_m_target_omset_personal_tgl_akhir">
<input type="text" data-table="m_target_omset_personal" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($m_target_omset_personal_edit->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_target_omset_personal_edit->tgl_akhir->EditValue ?>"<?php echo $m_target_omset_personal_edit->tgl_akhir->editAttributes() ?>>
<?php if (!$m_target_omset_personal_edit->tgl_akhir->ReadOnly && !$m_target_omset_personal_edit->tgl_akhir->Disabled && !isset($m_target_omset_personal_edit->tgl_akhir->EditAttrs["readonly"]) && !isset($m_target_omset_personal_edit->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_target_omset_personaledit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_target_omset_personaledit", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_target_omset_personal_edit->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_omset_personal_edit->target->Visible) { // target ?>
	<div id="r_target" class="form-group row">
		<label id="elh_m_target_omset_personal_target" for="x_target" class="<?php echo $m_target_omset_personal_edit->LeftColumnClass ?>"><?php echo $m_target_omset_personal_edit->target->caption() ?><?php echo $m_target_omset_personal_edit->target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_omset_personal_edit->RightColumnClass ?>"><div <?php echo $m_target_omset_personal_edit->target->cellAttributes() ?>>
<span id="el_m_target_omset_personal_target">
<input type="text" data-table="m_target_omset_personal" data-field="x_target" name="x_target" id="x_target" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_target_omset_personal_edit->target->getPlaceHolder()) ?>" value="<?php echo $m_target_omset_personal_edit->target->EditValue ?>"<?php echo $m_target_omset_personal_edit->target->editAttributes() ?>>
</span>
<?php echo $m_target_omset_personal_edit->target->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_target_omset_personal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_target_omset_personal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_target_omset_personal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_target_omset_personal_edit->showPageFooter();
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
$m_target_omset_personal_edit->terminate();
?>