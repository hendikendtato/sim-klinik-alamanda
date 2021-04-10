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
$penyesuaian_poin_edit = new penyesuaian_poin_edit();

// Run the page
$penyesuaian_poin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaian_poin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaian_poinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpenyesuaian_poinedit = currentForm = new ew.Form("fpenyesuaian_poinedit", "edit");

	// Validate form
	fpenyesuaian_poinedit.validate = function() {
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
			<?php if ($penyesuaian_poin_edit->kode_penyesuaianpoin->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penyesuaianpoin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaian_poin_edit->kode_penyesuaianpoin->caption(), $penyesuaian_poin_edit->kode_penyesuaianpoin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaian_poin_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaian_poin_edit->id_klinik->caption(), $penyesuaian_poin_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaian_poin_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaian_poin_edit->tgl->caption(), $penyesuaian_poin_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penyesuaian_poin_edit->tgl->errorMessage()) ?>");

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
	fpenyesuaian_poinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenyesuaian_poinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenyesuaian_poinedit.lists["x_id_klinik"] = <?php echo $penyesuaian_poin_edit->id_klinik->Lookup->toClientList($penyesuaian_poin_edit) ?>;
	fpenyesuaian_poinedit.lists["x_id_klinik"].options = <?php echo JsonEncode($penyesuaian_poin_edit->id_klinik->lookupOptions()) ?>;
	loadjs.done("fpenyesuaian_poinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penyesuaian_poin_edit->showPageHeader(); ?>
<?php
$penyesuaian_poin_edit->showMessage();
?>
<form name="fpenyesuaian_poinedit" id="fpenyesuaian_poinedit" class="<?php echo $penyesuaian_poin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaian_poin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaian_poin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($penyesuaian_poin_edit->kode_penyesuaianpoin->Visible) { // kode_penyesuaianpoin ?>
	<div id="r_kode_penyesuaianpoin" class="form-group row">
		<label id="elh_penyesuaian_poin_kode_penyesuaianpoin" for="x_kode_penyesuaianpoin" class="<?php echo $penyesuaian_poin_edit->LeftColumnClass ?>"><?php echo $penyesuaian_poin_edit->kode_penyesuaianpoin->caption() ?><?php echo $penyesuaian_poin_edit->kode_penyesuaianpoin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaian_poin_edit->RightColumnClass ?>"><div <?php echo $penyesuaian_poin_edit->kode_penyesuaianpoin->cellAttributes() ?>>
<span id="el_penyesuaian_poin_kode_penyesuaianpoin">
<input type="text" data-table="penyesuaian_poin" data-field="x_kode_penyesuaianpoin" name="x_kode_penyesuaianpoin" id="x_kode_penyesuaianpoin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penyesuaian_poin_edit->kode_penyesuaianpoin->getPlaceHolder()) ?>" value="<?php echo $penyesuaian_poin_edit->kode_penyesuaianpoin->EditValue ?>"<?php echo $penyesuaian_poin_edit->kode_penyesuaianpoin->editAttributes() ?>>
</span>
<?php echo $penyesuaian_poin_edit->kode_penyesuaianpoin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaian_poin_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_penyesuaian_poin_id_klinik" for="x_id_klinik" class="<?php echo $penyesuaian_poin_edit->LeftColumnClass ?>"><?php echo $penyesuaian_poin_edit->id_klinik->caption() ?><?php echo $penyesuaian_poin_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaian_poin_edit->RightColumnClass ?>"><div <?php echo $penyesuaian_poin_edit->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaian_poin_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penyesuaian_poin" data-field="x_id_klinik" data-value-separator="<?php echo $penyesuaian_poin_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $penyesuaian_poin_edit->id_klinik->editAttributes() ?>>
			<?php echo $penyesuaian_poin_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $penyesuaian_poin_edit->id_klinik->Lookup->getParamTag($penyesuaian_poin_edit, "p_x_id_klinik") ?>
</span>
<?php echo $penyesuaian_poin_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaian_poin_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_penyesuaian_poin_tgl" for="x_tgl" class="<?php echo $penyesuaian_poin_edit->LeftColumnClass ?>"><?php echo $penyesuaian_poin_edit->tgl->caption() ?><?php echo $penyesuaian_poin_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaian_poin_edit->RightColumnClass ?>"><div <?php echo $penyesuaian_poin_edit->tgl->cellAttributes() ?>>
<span id="el_penyesuaian_poin_tgl">
<input type="text" data-table="penyesuaian_poin" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($penyesuaian_poin_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $penyesuaian_poin_edit->tgl->EditValue ?>"<?php echo $penyesuaian_poin_edit->tgl->editAttributes() ?>>
<?php if (!$penyesuaian_poin_edit->tgl->ReadOnly && !$penyesuaian_poin_edit->tgl->Disabled && !isset($penyesuaian_poin_edit->tgl->EditAttrs["readonly"]) && !isset($penyesuaian_poin_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenyesuaian_poinedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenyesuaian_poinedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penyesuaian_poin_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="penyesuaian_poin" data-field="x_id_penyesuaian_poin" name="x_id_penyesuaian_poin" id="x_id_penyesuaian_poin" value="<?php echo HtmlEncode($penyesuaian_poin_edit->id_penyesuaian_poin->CurrentValue) ?>">
<?php
	if (in_array("detailpenyesuaianpoin", explode(",", $penyesuaian_poin->getCurrentDetailTable())) && $detailpenyesuaianpoin->DetailEdit) {
?>
<?php if ($penyesuaian_poin->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenyesuaianpoin", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpenyesuaianpoingrid.php" ?>
<?php } ?>
<?php if (!$penyesuaian_poin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penyesuaian_poin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penyesuaian_poin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penyesuaian_poin_edit->showPageFooter();
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
$penyesuaian_poin_edit->terminate();
?>