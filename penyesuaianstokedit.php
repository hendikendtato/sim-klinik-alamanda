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
$penyesuaianstok_edit = new penyesuaianstok_edit();

// Run the page
$penyesuaianstok_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaianstok_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaianstokedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpenyesuaianstokedit = currentForm = new ew.Form("fpenyesuaianstokedit", "edit");

	// Validate form
	fpenyesuaianstokedit.validate = function() {
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
			<?php if ($penyesuaianstok_edit->id_penyesuaianstok->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penyesuaianstok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_edit->id_penyesuaianstok->caption(), $penyesuaianstok_edit->id_penyesuaianstok->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaianstok_edit->kode_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_edit->kode_penyesuaian->caption(), $penyesuaianstok_edit->kode_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaianstok_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_edit->tanggal->caption(), $penyesuaianstok_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penyesuaianstok_edit->tanggal->errorMessage()) ?>");
			<?php if ($penyesuaianstok_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_edit->id_klinik->caption(), $penyesuaianstok_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaianstok_edit->lampiran->Required) { ?>
				felm = this.getElements("x" + infix + "_lampiran");
				elm = this.getElements("fn_x" + infix + "_lampiran");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_edit->lampiran->caption(), $penyesuaianstok_edit->lampiran->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaianstok_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_edit->keterangan->caption(), $penyesuaianstok_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fpenyesuaianstokedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenyesuaianstokedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenyesuaianstokedit.lists["x_id_klinik"] = <?php echo $penyesuaianstok_edit->id_klinik->Lookup->toClientList($penyesuaianstok_edit) ?>;
	fpenyesuaianstokedit.lists["x_id_klinik"].options = <?php echo JsonEncode($penyesuaianstok_edit->id_klinik->lookupOptions()) ?>;
	loadjs.done("fpenyesuaianstokedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penyesuaianstok_edit->showPageHeader(); ?>
<?php
$penyesuaianstok_edit->showMessage();
?>
<form name="fpenyesuaianstokedit" id="fpenyesuaianstokedit" class="<?php echo $penyesuaianstok_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaianstok">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaianstok_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($penyesuaianstok_edit->id_penyesuaianstok->Visible) { // id_penyesuaianstok ?>
	<div id="r_id_penyesuaianstok" class="form-group row">
		<label id="elh_penyesuaianstok_id_penyesuaianstok" class="<?php echo $penyesuaianstok_edit->LeftColumnClass ?>"><?php echo $penyesuaianstok_edit->id_penyesuaianstok->caption() ?><?php echo $penyesuaianstok_edit->id_penyesuaianstok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $penyesuaianstok_edit->id_penyesuaianstok->cellAttributes() ?>>
<span id="el_penyesuaianstok_id_penyesuaianstok">
<span<?php echo $penyesuaianstok_edit->id_penyesuaianstok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($penyesuaianstok_edit->id_penyesuaianstok->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="penyesuaianstok" data-field="x_id_penyesuaianstok" name="x_id_penyesuaianstok" id="x_id_penyesuaianstok" value="<?php echo HtmlEncode($penyesuaianstok_edit->id_penyesuaianstok->CurrentValue) ?>">
<?php echo $penyesuaianstok_edit->id_penyesuaianstok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_edit->kode_penyesuaian->Visible) { // kode_penyesuaian ?>
	<div id="r_kode_penyesuaian" class="form-group row">
		<label id="elh_penyesuaianstok_kode_penyesuaian" for="x_kode_penyesuaian" class="<?php echo $penyesuaianstok_edit->LeftColumnClass ?>"><?php echo $penyesuaianstok_edit->kode_penyesuaian->caption() ?><?php echo $penyesuaianstok_edit->kode_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $penyesuaianstok_edit->kode_penyesuaian->cellAttributes() ?>>
<span id="el_penyesuaianstok_kode_penyesuaian">
<input type="text" data-table="penyesuaianstok" data-field="x_kode_penyesuaian" name="x_kode_penyesuaian" id="x_kode_penyesuaian" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penyesuaianstok_edit->kode_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_edit->kode_penyesuaian->EditValue ?>"<?php echo $penyesuaianstok_edit->kode_penyesuaian->editAttributes() ?>>
</span>
<?php echo $penyesuaianstok_edit->kode_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_penyesuaianstok_tanggal" for="x_tanggal" class="<?php echo $penyesuaianstok_edit->LeftColumnClass ?>"><?php echo $penyesuaianstok_edit->tanggal->caption() ?><?php echo $penyesuaianstok_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $penyesuaianstok_edit->tanggal->cellAttributes() ?>>
<span id="el_penyesuaianstok_tanggal">
<input type="text" data-table="penyesuaianstok" data-field="x_tanggal" data-format="7" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($penyesuaianstok_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_edit->tanggal->EditValue ?>"<?php echo $penyesuaianstok_edit->tanggal->editAttributes() ?>>
<?php if (!$penyesuaianstok_edit->tanggal->ReadOnly && !$penyesuaianstok_edit->tanggal->Disabled && !isset($penyesuaianstok_edit->tanggal->EditAttrs["readonly"]) && !isset($penyesuaianstok_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenyesuaianstokedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenyesuaianstokedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $penyesuaianstok_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_penyesuaianstok_id_klinik" for="x_id_klinik" class="<?php echo $penyesuaianstok_edit->LeftColumnClass ?>"><?php echo $penyesuaianstok_edit->id_klinik->caption() ?><?php echo $penyesuaianstok_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $penyesuaianstok_edit->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaianstok_id_klinik">
<?php $penyesuaianstok_edit->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penyesuaianstok" data-field="x_id_klinik" data-value-separator="<?php echo $penyesuaianstok_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $penyesuaianstok_edit->id_klinik->editAttributes() ?>>
			<?php echo $penyesuaianstok_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $penyesuaianstok_edit->id_klinik->Lookup->getParamTag($penyesuaianstok_edit, "p_x_id_klinik") ?>
</span>
<?php echo $penyesuaianstok_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_edit->lampiran->Visible) { // lampiran ?>
	<div id="r_lampiran" class="form-group row">
		<label id="elh_penyesuaianstok_lampiran" class="<?php echo $penyesuaianstok_edit->LeftColumnClass ?>"><?php echo $penyesuaianstok_edit->lampiran->caption() ?><?php echo $penyesuaianstok_edit->lampiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $penyesuaianstok_edit->lampiran->cellAttributes() ?>>
<span id="el_penyesuaianstok_lampiran">
<div id="fd_x_lampiran">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $penyesuaianstok_edit->lampiran->title() ?>" data-table="penyesuaianstok" data-field="x_lampiran" name="x_lampiran" id="x_lampiran" lang="<?php echo CurrentLanguageID() ?>"<?php echo $penyesuaianstok_edit->lampiran->editAttributes() ?><?php if ($penyesuaianstok_edit->lampiran->ReadOnly || $penyesuaianstok_edit->lampiran->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_lampiran"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_lampiran" id= "fn_x_lampiran" value="<?php echo $penyesuaianstok_edit->lampiran->Upload->FileName ?>">
<input type="hidden" name="fa_x_lampiran" id= "fa_x_lampiran" value="<?php echo (Post("fa_x_lampiran") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_lampiran" id= "fs_x_lampiran" value="255">
<input type="hidden" name="fx_x_lampiran" id= "fx_x_lampiran" value="<?php echo $penyesuaianstok_edit->lampiran->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_lampiran" id= "fm_x_lampiran" value="<?php echo $penyesuaianstok_edit->lampiran->UploadMaxFileSize ?>">
</div>
<table id="ft_x_lampiran" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $penyesuaianstok_edit->lampiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_penyesuaianstok_keterangan" for="x_keterangan" class="<?php echo $penyesuaianstok_edit->LeftColumnClass ?>"><?php echo $penyesuaianstok_edit->keterangan->caption() ?><?php echo $penyesuaianstok_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $penyesuaianstok_edit->keterangan->cellAttributes() ?>>
<span id="el_penyesuaianstok_keterangan">
<textarea data-table="penyesuaianstok" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($penyesuaianstok_edit->keterangan->getPlaceHolder()) ?>"<?php echo $penyesuaianstok_edit->keterangan->editAttributes() ?>><?php echo $penyesuaianstok_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $penyesuaianstok_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailpenyesuaianstok", explode(",", $penyesuaianstok->getCurrentDetailTable())) && $detailpenyesuaianstok->DetailEdit) {
?>
<?php if ($penyesuaianstok->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenyesuaianstok", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpenyesuaianstokgrid.php" ?>
<?php } ?>
<?php if (!$penyesuaianstok_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penyesuaianstok_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penyesuaianstok_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penyesuaianstok_edit->showPageFooter();
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
$penyesuaianstok_edit->terminate();
?>