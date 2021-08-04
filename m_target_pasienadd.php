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
$m_target_pasien_add = new m_target_pasien_add();

// Run the page
$m_target_pasien_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_pasien_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_target_pasienadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_target_pasienadd = currentForm = new ew.Form("fm_target_pasienadd", "add");

	// Validate form
	fm_target_pasienadd.validate = function() {
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
			<?php if ($m_target_pasien_add->id_cabang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_cabang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_pasien_add->id_cabang->caption(), $m_target_pasien_add->id_cabang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_target_pasien_add->tgl_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_pasien_add->tgl_awal->caption(), $m_target_pasien_add->tgl_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_target_pasien_add->tgl_awal->errorMessage()) ?>");
			<?php if ($m_target_pasien_add->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_pasien_add->tgl_akhir->caption(), $m_target_pasien_add->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_target_pasien_add->tgl_akhir->errorMessage()) ?>");
			<?php if ($m_target_pasien_add->target->Required) { ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_target_pasien_add->target->caption(), $m_target_pasien_add->target->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_target_pasien_add->target->errorMessage()) ?>");

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
	fm_target_pasienadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_target_pasienadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_target_pasienadd.lists["x_id_cabang"] = <?php echo $m_target_pasien_add->id_cabang->Lookup->toClientList($m_target_pasien_add) ?>;
	fm_target_pasienadd.lists["x_id_cabang"].options = <?php echo JsonEncode($m_target_pasien_add->id_cabang->lookupOptions()) ?>;
	loadjs.done("fm_target_pasienadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_target_pasien_add->showPageHeader(); ?>
<?php
$m_target_pasien_add->showMessage();
?>
<form name="fm_target_pasienadd" id="fm_target_pasienadd" class="<?php echo $m_target_pasien_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_pasien">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_target_pasien_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_target_pasien_add->id_cabang->Visible) { // id_cabang ?>
	<div id="r_id_cabang" class="form-group row">
		<label id="elh_m_target_pasien_id_cabang" for="x_id_cabang" class="<?php echo $m_target_pasien_add->LeftColumnClass ?>"><?php echo $m_target_pasien_add->id_cabang->caption() ?><?php echo $m_target_pasien_add->id_cabang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_pasien_add->RightColumnClass ?>"><div <?php echo $m_target_pasien_add->id_cabang->cellAttributes() ?>>
<span id="el_m_target_pasien_id_cabang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_target_pasien" data-field="x_id_cabang" data-value-separator="<?php echo $m_target_pasien_add->id_cabang->displayValueSeparatorAttribute() ?>" id="x_id_cabang" name="x_id_cabang"<?php echo $m_target_pasien_add->id_cabang->editAttributes() ?>>
			<?php echo $m_target_pasien_add->id_cabang->selectOptionListHtml("x_id_cabang") ?>
		</select>
</div>
<?php echo $m_target_pasien_add->id_cabang->Lookup->getParamTag($m_target_pasien_add, "p_x_id_cabang") ?>
</span>
<?php echo $m_target_pasien_add->id_cabang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_pasien_add->tgl_awal->Visible) { // tgl_awal ?>
	<div id="r_tgl_awal" class="form-group row">
		<label id="elh_m_target_pasien_tgl_awal" for="x_tgl_awal" class="<?php echo $m_target_pasien_add->LeftColumnClass ?>"><?php echo $m_target_pasien_add->tgl_awal->caption() ?><?php echo $m_target_pasien_add->tgl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_pasien_add->RightColumnClass ?>"><div <?php echo $m_target_pasien_add->tgl_awal->cellAttributes() ?>>
<span id="el_m_target_pasien_tgl_awal">
<input type="text" data-table="m_target_pasien" data-field="x_tgl_awal" name="x_tgl_awal" id="x_tgl_awal" maxlength="10" placeholder="<?php echo HtmlEncode($m_target_pasien_add->tgl_awal->getPlaceHolder()) ?>" value="<?php echo $m_target_pasien_add->tgl_awal->EditValue ?>"<?php echo $m_target_pasien_add->tgl_awal->editAttributes() ?>>
<?php if (!$m_target_pasien_add->tgl_awal->ReadOnly && !$m_target_pasien_add->tgl_awal->Disabled && !isset($m_target_pasien_add->tgl_awal->EditAttrs["readonly"]) && !isset($m_target_pasien_add->tgl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_target_pasienadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_target_pasienadd", "x_tgl_awal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_target_pasien_add->tgl_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_pasien_add->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_m_target_pasien_tgl_akhir" for="x_tgl_akhir" class="<?php echo $m_target_pasien_add->LeftColumnClass ?>"><?php echo $m_target_pasien_add->tgl_akhir->caption() ?><?php echo $m_target_pasien_add->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_pasien_add->RightColumnClass ?>"><div <?php echo $m_target_pasien_add->tgl_akhir->cellAttributes() ?>>
<span id="el_m_target_pasien_tgl_akhir">
<input type="text" data-table="m_target_pasien" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="10" placeholder="<?php echo HtmlEncode($m_target_pasien_add->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_target_pasien_add->tgl_akhir->EditValue ?>"<?php echo $m_target_pasien_add->tgl_akhir->editAttributes() ?>>
<?php if (!$m_target_pasien_add->tgl_akhir->ReadOnly && !$m_target_pasien_add->tgl_akhir->Disabled && !isset($m_target_pasien_add->tgl_akhir->EditAttrs["readonly"]) && !isset($m_target_pasien_add->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_target_pasienadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_target_pasienadd", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_target_pasien_add->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_target_pasien_add->target->Visible) { // target ?>
	<div id="r_target" class="form-group row">
		<label id="elh_m_target_pasien_target" for="x_target" class="<?php echo $m_target_pasien_add->LeftColumnClass ?>"><?php echo $m_target_pasien_add->target->caption() ?><?php echo $m_target_pasien_add->target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_target_pasien_add->RightColumnClass ?>"><div <?php echo $m_target_pasien_add->target->cellAttributes() ?>>
<span id="el_m_target_pasien_target">
<input type="text" data-table="m_target_pasien" data-field="x_target" name="x_target" id="x_target" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_target_pasien_add->target->getPlaceHolder()) ?>" value="<?php echo $m_target_pasien_add->target->EditValue ?>"<?php echo $m_target_pasien_add->target->editAttributes() ?>>
</span>
<?php echo $m_target_pasien_add->target->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_target_pasien_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_target_pasien_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_target_pasien_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_target_pasien_add->showPageFooter();
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
$m_target_pasien_add->terminate();
?>