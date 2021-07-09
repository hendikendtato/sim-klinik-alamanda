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
$wp_reservasi_edit = new wp_reservasi_edit();

// Run the page
$wp_reservasi_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$wp_reservasi_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fwp_reservasiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fwp_reservasiedit = currentForm = new ew.Form("fwp_reservasiedit", "edit");

	// Validate form
	fwp_reservasiedit.validate = function() {
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
			<?php if ($wp_reservasi_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->id->caption(), $wp_reservasi_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->nama->caption(), $wp_reservasi_edit->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->no_telp->Required) { ?>
				elm = this.getElements("x" + infix + "_no_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->no_telp->caption(), $wp_reservasi_edit->no_telp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->keterangan->caption(), $wp_reservasi_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->jenis_perawatan->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_perawatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->jenis_perawatan->caption(), $wp_reservasi_edit->jenis_perawatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->id_klinik->caption(), $wp_reservasi_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->terapis->Required) { ?>
				elm = this.getElements("x" + infix + "_terapis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->terapis->caption(), $wp_reservasi_edit->terapis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_reservasi_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->tanggal->caption(), $wp_reservasi_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($wp_reservasi_edit->tanggal->errorMessage()) ?>");
			<?php if ($wp_reservasi_edit->jam_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->jam_mulai->caption(), $wp_reservasi_edit->jam_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_mulai");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($wp_reservasi_edit->jam_mulai->errorMessage()) ?>");
			<?php if ($wp_reservasi_edit->jam_selesai->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_selesai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->jam_selesai->caption(), $wp_reservasi_edit->jam_selesai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_selesai");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($wp_reservasi_edit->jam_selesai->errorMessage()) ?>");
			<?php if ($wp_reservasi_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_reservasi_edit->status->caption(), $wp_reservasi_edit->status->RequiredErrorMessage)) ?>");
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
	fwp_reservasiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fwp_reservasiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fwp_reservasiedit.lists["x_id_klinik"] = <?php echo $wp_reservasi_edit->id_klinik->Lookup->toClientList($wp_reservasi_edit) ?>;
	fwp_reservasiedit.lists["x_id_klinik"].options = <?php echo JsonEncode($wp_reservasi_edit->id_klinik->lookupOptions()) ?>;
	fwp_reservasiedit.lists["x_terapis"] = <?php echo $wp_reservasi_edit->terapis->Lookup->toClientList($wp_reservasi_edit) ?>;
	fwp_reservasiedit.lists["x_terapis"].options = <?php echo JsonEncode($wp_reservasi_edit->terapis->lookupOptions()) ?>;
	loadjs.done("fwp_reservasiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $wp_reservasi_edit->showPageHeader(); ?>
<?php
$wp_reservasi_edit->showMessage();
?>
<form name="fwp_reservasiedit" id="fwp_reservasiedit" class="<?php echo $wp_reservasi_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="wp_reservasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$wp_reservasi_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($wp_reservasi_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_wp_reservasi_id" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->id->caption() ?><?php echo $wp_reservasi_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->id->cellAttributes() ?>>
<span id="el_wp_reservasi_id">
<span<?php echo $wp_reservasi_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($wp_reservasi_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="wp_reservasi" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($wp_reservasi_edit->id->CurrentValue) ?>">
<?php echo $wp_reservasi_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_wp_reservasi_nama" for="x_nama" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->nama->caption() ?><?php echo $wp_reservasi_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->nama->cellAttributes() ?>>
<span id="el_wp_reservasi_nama">
<input type="text" data-table="wp_reservasi" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->nama->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->nama->EditValue ?>"<?php echo $wp_reservasi_edit->nama->editAttributes() ?>>
</span>
<?php echo $wp_reservasi_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->no_telp->Visible) { // no_telp ?>
	<div id="r_no_telp" class="form-group row">
		<label id="elh_wp_reservasi_no_telp" for="x_no_telp" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->no_telp->caption() ?><?php echo $wp_reservasi_edit->no_telp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->no_telp->cellAttributes() ?>>
<span id="el_wp_reservasi_no_telp">
<input type="text" data-table="wp_reservasi" data-field="x_no_telp" name="x_no_telp" id="x_no_telp" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->no_telp->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->no_telp->EditValue ?>"<?php echo $wp_reservasi_edit->no_telp->editAttributes() ?>>
</span>
<?php echo $wp_reservasi_edit->no_telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_wp_reservasi_keterangan" for="x_keterangan" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->keterangan->caption() ?><?php echo $wp_reservasi_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->keterangan->cellAttributes() ?>>
<span id="el_wp_reservasi_keterangan">
<textarea data-table="wp_reservasi" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->keterangan->getPlaceHolder()) ?>"<?php echo $wp_reservasi_edit->keterangan->editAttributes() ?>><?php echo $wp_reservasi_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $wp_reservasi_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->jenis_perawatan->Visible) { // jenis_perawatan ?>
	<div id="r_jenis_perawatan" class="form-group row">
		<label id="elh_wp_reservasi_jenis_perawatan" for="x_jenis_perawatan" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->jenis_perawatan->caption() ?><?php echo $wp_reservasi_edit->jenis_perawatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->jenis_perawatan->cellAttributes() ?>>
<span id="el_wp_reservasi_jenis_perawatan">
<input type="text" data-table="wp_reservasi" data-field="x_jenis_perawatan" name="x_jenis_perawatan" id="x_jenis_perawatan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->jenis_perawatan->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->jenis_perawatan->EditValue ?>"<?php echo $wp_reservasi_edit->jenis_perawatan->editAttributes() ?>>
</span>
<?php echo $wp_reservasi_edit->jenis_perawatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_wp_reservasi_id_klinik" for="x_id_klinik" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->id_klinik->caption() ?><?php echo $wp_reservasi_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->id_klinik->cellAttributes() ?>>
<span id="el_wp_reservasi_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="wp_reservasi" data-field="x_id_klinik" data-value-separator="<?php echo $wp_reservasi_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $wp_reservasi_edit->id_klinik->editAttributes() ?>>
			<?php echo $wp_reservasi_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $wp_reservasi_edit->id_klinik->Lookup->getParamTag($wp_reservasi_edit, "p_x_id_klinik") ?>
</span>
<?php echo $wp_reservasi_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->terapis->Visible) { // terapis ?>
	<div id="r_terapis" class="form-group row">
		<label id="elh_wp_reservasi_terapis" for="x_terapis" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->terapis->caption() ?><?php echo $wp_reservasi_edit->terapis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->terapis->cellAttributes() ?>>
<span id="el_wp_reservasi_terapis">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="wp_reservasi" data-field="x_terapis" data-value-separator="<?php echo $wp_reservasi_edit->terapis->displayValueSeparatorAttribute() ?>" id="x_terapis" name="x_terapis"<?php echo $wp_reservasi_edit->terapis->editAttributes() ?>>
			<?php echo $wp_reservasi_edit->terapis->selectOptionListHtml("x_terapis") ?>
		</select>
</div>
<?php echo $wp_reservasi_edit->terapis->Lookup->getParamTag($wp_reservasi_edit, "p_x_terapis") ?>
</span>
<?php echo $wp_reservasi_edit->terapis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_wp_reservasi_tanggal" for="x_tanggal" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->tanggal->caption() ?><?php echo $wp_reservasi_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->tanggal->cellAttributes() ?>>
<span id="el_wp_reservasi_tanggal">
<input type="text" data-table="wp_reservasi" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="10" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->tanggal->EditValue ?>"<?php echo $wp_reservasi_edit->tanggal->editAttributes() ?>>
<?php if (!$wp_reservasi_edit->tanggal->ReadOnly && !$wp_reservasi_edit->tanggal->Disabled && !isset($wp_reservasi_edit->tanggal->EditAttrs["readonly"]) && !isset($wp_reservasi_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fwp_reservasiedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fwp_reservasiedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $wp_reservasi_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->jam_mulai->Visible) { // jam_mulai ?>
	<div id="r_jam_mulai" class="form-group row">
		<label id="elh_wp_reservasi_jam_mulai" for="x_jam_mulai" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->jam_mulai->caption() ?><?php echo $wp_reservasi_edit->jam_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->jam_mulai->cellAttributes() ?>>
<span id="el_wp_reservasi_jam_mulai">
<input type="text" data-table="wp_reservasi" data-field="x_jam_mulai" name="x_jam_mulai" id="x_jam_mulai" maxlength="8" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->jam_mulai->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->jam_mulai->EditValue ?>"<?php echo $wp_reservasi_edit->jam_mulai->editAttributes() ?>>
</span>
<?php echo $wp_reservasi_edit->jam_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->jam_selesai->Visible) { // jam_selesai ?>
	<div id="r_jam_selesai" class="form-group row">
		<label id="elh_wp_reservasi_jam_selesai" for="x_jam_selesai" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->jam_selesai->caption() ?><?php echo $wp_reservasi_edit->jam_selesai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->jam_selesai->cellAttributes() ?>>
<span id="el_wp_reservasi_jam_selesai">
<input type="text" data-table="wp_reservasi" data-field="x_jam_selesai" name="x_jam_selesai" id="x_jam_selesai" maxlength="8" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->jam_selesai->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->jam_selesai->EditValue ?>"<?php echo $wp_reservasi_edit->jam_selesai->editAttributes() ?>>
</span>
<?php echo $wp_reservasi_edit->jam_selesai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_reservasi_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_wp_reservasi_status" for="x_status" class="<?php echo $wp_reservasi_edit->LeftColumnClass ?>"><?php echo $wp_reservasi_edit->status->caption() ?><?php echo $wp_reservasi_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_reservasi_edit->RightColumnClass ?>"><div <?php echo $wp_reservasi_edit->status->cellAttributes() ?>>
<span id="el_wp_reservasi_status">
<input type="text" data-table="wp_reservasi" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($wp_reservasi_edit->status->getPlaceHolder()) ?>" value="<?php echo $wp_reservasi_edit->status->EditValue ?>"<?php echo $wp_reservasi_edit->status->editAttributes() ?>>
</span>
<?php echo $wp_reservasi_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$wp_reservasi_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $wp_reservasi_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $wp_reservasi_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$wp_reservasi_edit->showPageFooter();
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
$wp_reservasi_edit->terminate();
?>