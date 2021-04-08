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
$m_jadwalpegawai_edit = new m_jadwalpegawai_edit();

// Run the page
$m_jadwalpegawai_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jadwalpegawai_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_jadwalpegawaiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_jadwalpegawaiedit = currentForm = new ew.Form("fm_jadwalpegawaiedit", "edit");

	// Validate form
	fm_jadwalpegawaiedit.validate = function() {
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
			<?php if ($m_jadwalpegawai_edit->id_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->id_jadwalpeg->caption(), $m_jadwalpegawai_edit->id_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jadwalpegawai_edit->tindakan_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_tindakan_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->tindakan_jadwalpeg->caption(), $m_jadwalpegawai_edit->tindakan_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tindakan_jadwalpeg");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jadwalpegawai_edit->tindakan_jadwalpeg->errorMessage()) ?>");
			<?php if ($m_jadwalpegawai_edit->idpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_idpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->idpeg->caption(), $m_jadwalpegawai_edit->idpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jadwalpegawai_edit->tanggal_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->tanggal_jadwalpeg->caption(), $m_jadwalpegawai_edit->tanggal_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_jadwalpeg");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jadwalpegawai_edit->tanggal_jadwalpeg->errorMessage()) ?>");
			<?php if ($m_jadwalpegawai_edit->jam_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->jam_jadwalpeg->caption(), $m_jadwalpegawai_edit->jam_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_jadwalpeg");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jadwalpegawai_edit->jam_jadwalpeg->errorMessage()) ?>");
			<?php if ($m_jadwalpegawai_edit->keterangan_peg->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan_peg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->keterangan_peg->caption(), $m_jadwalpegawai_edit->keterangan_peg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jadwalpegawai_edit->status_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_status_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_edit->status_jadwalpeg->caption(), $m_jadwalpegawai_edit->status_jadwalpeg->RequiredErrorMessage)) ?>");
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
	fm_jadwalpegawaiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_jadwalpegawaiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_jadwalpegawaiedit.lists["x_idpeg"] = <?php echo $m_jadwalpegawai_edit->idpeg->Lookup->toClientList($m_jadwalpegawai_edit) ?>;
	fm_jadwalpegawaiedit.lists["x_idpeg"].options = <?php echo JsonEncode($m_jadwalpegawai_edit->idpeg->lookupOptions()) ?>;
	fm_jadwalpegawaiedit.lists["x_status_jadwalpeg"] = <?php echo $m_jadwalpegawai_edit->status_jadwalpeg->Lookup->toClientList($m_jadwalpegawai_edit) ?>;
	fm_jadwalpegawaiedit.lists["x_status_jadwalpeg"].options = <?php echo JsonEncode($m_jadwalpegawai_edit->status_jadwalpeg->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_jadwalpegawaiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_jadwalpegawai_edit->showPageHeader(); ?>
<?php
$m_jadwalpegawai_edit->showMessage();
?>
<form name="fm_jadwalpegawaiedit" id="fm_jadwalpegawaiedit" class="<?php echo $m_jadwalpegawai_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jadwalpegawai">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_jadwalpegawai_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_jadwalpegawai_edit->id_jadwalpeg->Visible) { // id_jadwalpeg ?>
	<div id="r_id_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_id_jadwalpeg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->id_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_edit->id_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->id_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_id_jadwalpeg">
<span<?php echo $m_jadwalpegawai_edit->id_jadwalpeg->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_jadwalpegawai_edit->id_jadwalpeg->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_jadwalpegawai" data-field="x_id_jadwalpeg" name="x_id_jadwalpeg" id="x_id_jadwalpeg" value="<?php echo HtmlEncode($m_jadwalpegawai_edit->id_jadwalpeg->CurrentValue) ?>">
<?php echo $m_jadwalpegawai_edit->id_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_edit->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
	<div id="r_tindakan_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_tindakan_jadwalpeg" for="x_tindakan_jadwalpeg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->tindakan_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_edit->tindakan_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->tindakan_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_tindakan_jadwalpeg">
<input type="text" data-table="m_jadwalpegawai" data-field="x_tindakan_jadwalpeg" name="x_tindakan_jadwalpeg" id="x_tindakan_jadwalpeg" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_edit->tindakan_jadwalpeg->getPlaceHolder()) ?>" value="<?php echo $m_jadwalpegawai_edit->tindakan_jadwalpeg->EditValue ?>"<?php echo $m_jadwalpegawai_edit->tindakan_jadwalpeg->editAttributes() ?>>
</span>
<?php echo $m_jadwalpegawai_edit->tindakan_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_edit->idpeg->Visible) { // idpeg ?>
	<div id="r_idpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_idpeg" for="x_idpeg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->idpeg->caption() ?><?php echo $m_jadwalpegawai_edit->idpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->idpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_idpeg">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_jadwalpegawai" data-field="x_idpeg" data-value-separator="<?php echo $m_jadwalpegawai_edit->idpeg->displayValueSeparatorAttribute() ?>" id="x_idpeg" name="x_idpeg"<?php echo $m_jadwalpegawai_edit->idpeg->editAttributes() ?>>
			<?php echo $m_jadwalpegawai_edit->idpeg->selectOptionListHtml("x_idpeg") ?>
		</select>
</div>
<?php echo $m_jadwalpegawai_edit->idpeg->Lookup->getParamTag($m_jadwalpegawai_edit, "p_x_idpeg") ?>
</span>
<?php echo $m_jadwalpegawai_edit->idpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_edit->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
	<div id="r_tanggal_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_tanggal_jadwalpeg" for="x_tanggal_jadwalpeg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->tanggal_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_edit->tanggal_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->tanggal_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_tanggal_jadwalpeg">
<input type="text" data-table="m_jadwalpegawai" data-field="x_tanggal_jadwalpeg" name="x_tanggal_jadwalpeg" id="x_tanggal_jadwalpeg" maxlength="10" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_edit->tanggal_jadwalpeg->getPlaceHolder()) ?>" value="<?php echo $m_jadwalpegawai_edit->tanggal_jadwalpeg->EditValue ?>"<?php echo $m_jadwalpegawai_edit->tanggal_jadwalpeg->editAttributes() ?>>
<?php if (!$m_jadwalpegawai_edit->tanggal_jadwalpeg->ReadOnly && !$m_jadwalpegawai_edit->tanggal_jadwalpeg->Disabled && !isset($m_jadwalpegawai_edit->tanggal_jadwalpeg->EditAttrs["readonly"]) && !isset($m_jadwalpegawai_edit->tanggal_jadwalpeg->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_jadwalpegawaiedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_jadwalpegawaiedit", "x_tanggal_jadwalpeg", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_jadwalpegawai_edit->tanggal_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_edit->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
	<div id="r_jam_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_jam_jadwalpeg" for="x_jam_jadwalpeg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->jam_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_edit->jam_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->jam_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_jam_jadwalpeg">
<input type="text" data-table="m_jadwalpegawai" data-field="x_jam_jadwalpeg" name="x_jam_jadwalpeg" id="x_jam_jadwalpeg" maxlength="8" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_edit->jam_jadwalpeg->getPlaceHolder()) ?>" value="<?php echo $m_jadwalpegawai_edit->jam_jadwalpeg->EditValue ?>"<?php echo $m_jadwalpegawai_edit->jam_jadwalpeg->editAttributes() ?>>
</span>
<?php echo $m_jadwalpegawai_edit->jam_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_edit->keterangan_peg->Visible) { // keterangan_peg ?>
	<div id="r_keterangan_peg" class="form-group row">
		<label id="elh_m_jadwalpegawai_keterangan_peg" for="x_keterangan_peg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->keterangan_peg->caption() ?><?php echo $m_jadwalpegawai_edit->keterangan_peg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->keterangan_peg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_keterangan_peg">
<textarea data-table="m_jadwalpegawai" data-field="x_keterangan_peg" name="x_keterangan_peg" id="x_keterangan_peg" cols="35" rows="4" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_edit->keterangan_peg->getPlaceHolder()) ?>"<?php echo $m_jadwalpegawai_edit->keterangan_peg->editAttributes() ?>><?php echo $m_jadwalpegawai_edit->keterangan_peg->EditValue ?></textarea>
</span>
<?php echo $m_jadwalpegawai_edit->keterangan_peg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_edit->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
	<div id="r_status_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_status_jadwalpeg" class="<?php echo $m_jadwalpegawai_edit->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_edit->status_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_edit->status_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_edit->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_edit->status_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_status_jadwalpeg">
<div id="tp_x_status_jadwalpeg" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_jadwalpegawai" data-field="x_status_jadwalpeg" data-value-separator="<?php echo $m_jadwalpegawai_edit->status_jadwalpeg->displayValueSeparatorAttribute() ?>" name="x_status_jadwalpeg" id="x_status_jadwalpeg" value="{value}"<?php echo $m_jadwalpegawai_edit->status_jadwalpeg->editAttributes() ?>></div>
<div id="dsl_x_status_jadwalpeg" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_jadwalpegawai_edit->status_jadwalpeg->radioButtonListHtml(FALSE, "x_status_jadwalpeg") ?>
</div></div>
</span>
<?php echo $m_jadwalpegawai_edit->status_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_jadwalpegawai_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_jadwalpegawai_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_jadwalpegawai_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_jadwalpegawai_edit->showPageFooter();
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
$m_jadwalpegawai_edit->terminate();
?>