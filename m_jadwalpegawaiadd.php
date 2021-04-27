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
$m_jadwalpegawai_add = new m_jadwalpegawai_add();

// Run the page
$m_jadwalpegawai_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jadwalpegawai_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_jadwalpegawaiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_jadwalpegawaiadd = currentForm = new ew.Form("fm_jadwalpegawaiadd", "add");

	// Validate form
	fm_jadwalpegawaiadd.validate = function() {
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
			<?php if ($m_jadwalpegawai_add->tindakan_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_tindakan_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_add->tindakan_jadwalpeg->caption(), $m_jadwalpegawai_add->tindakan_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tindakan_jadwalpeg");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jadwalpegawai_add->tindakan_jadwalpeg->errorMessage()) ?>");
			<?php if ($m_jadwalpegawai_add->idpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_idpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_add->idpeg->caption(), $m_jadwalpegawai_add->idpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jadwalpegawai_add->tanggal_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_add->tanggal_jadwalpeg->caption(), $m_jadwalpegawai_add->tanggal_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_jadwalpeg");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jadwalpegawai_add->tanggal_jadwalpeg->errorMessage()) ?>");
			<?php if ($m_jadwalpegawai_add->jam_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_add->jam_jadwalpeg->caption(), $m_jadwalpegawai_add->jam_jadwalpeg->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_jadwalpeg");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jadwalpegawai_add->jam_jadwalpeg->errorMessage()) ?>");
			<?php if ($m_jadwalpegawai_add->keterangan_peg->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan_peg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_add->keterangan_peg->caption(), $m_jadwalpegawai_add->keterangan_peg->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jadwalpegawai_add->status_jadwalpeg->Required) { ?>
				elm = this.getElements("x" + infix + "_status_jadwalpeg");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jadwalpegawai_add->status_jadwalpeg->caption(), $m_jadwalpegawai_add->status_jadwalpeg->RequiredErrorMessage)) ?>");
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
	fm_jadwalpegawaiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_jadwalpegawaiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_jadwalpegawaiadd.lists["x_idpeg"] = <?php echo $m_jadwalpegawai_add->idpeg->Lookup->toClientList($m_jadwalpegawai_add) ?>;
	fm_jadwalpegawaiadd.lists["x_idpeg"].options = <?php echo JsonEncode($m_jadwalpegawai_add->idpeg->lookupOptions()) ?>;
	fm_jadwalpegawaiadd.lists["x_status_jadwalpeg"] = <?php echo $m_jadwalpegawai_add->status_jadwalpeg->Lookup->toClientList($m_jadwalpegawai_add) ?>;
	fm_jadwalpegawaiadd.lists["x_status_jadwalpeg"].options = <?php echo JsonEncode($m_jadwalpegawai_add->status_jadwalpeg->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_jadwalpegawaiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_jadwalpegawai_add->showPageHeader(); ?>
<?php
$m_jadwalpegawai_add->showMessage();
?>
<form name="fm_jadwalpegawaiadd" id="fm_jadwalpegawaiadd" class="<?php echo $m_jadwalpegawai_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jadwalpegawai">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_jadwalpegawai_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_jadwalpegawai_add->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
	<div id="r_tindakan_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_tindakan_jadwalpeg" for="x_tindakan_jadwalpeg" class="<?php echo $m_jadwalpegawai_add->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_add->tindakan_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_add->tindakan_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_add->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_add->tindakan_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_tindakan_jadwalpeg">
<input type="text" data-table="m_jadwalpegawai" data-field="x_tindakan_jadwalpeg" name="x_tindakan_jadwalpeg" id="x_tindakan_jadwalpeg" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_add->tindakan_jadwalpeg->getPlaceHolder()) ?>" value="<?php echo $m_jadwalpegawai_add->tindakan_jadwalpeg->EditValue ?>"<?php echo $m_jadwalpegawai_add->tindakan_jadwalpeg->editAttributes() ?>>
</span>
<?php echo $m_jadwalpegawai_add->tindakan_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_add->idpeg->Visible) { // idpeg ?>
	<div id="r_idpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_idpeg" for="x_idpeg" class="<?php echo $m_jadwalpegawai_add->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_add->idpeg->caption() ?><?php echo $m_jadwalpegawai_add->idpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_add->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_add->idpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_idpeg">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_jadwalpegawai" data-field="x_idpeg" data-value-separator="<?php echo $m_jadwalpegawai_add->idpeg->displayValueSeparatorAttribute() ?>" id="x_idpeg" name="x_idpeg"<?php echo $m_jadwalpegawai_add->idpeg->editAttributes() ?>>
			<?php echo $m_jadwalpegawai_add->idpeg->selectOptionListHtml("x_idpeg") ?>
		</select>
</div>
<?php echo $m_jadwalpegawai_add->idpeg->Lookup->getParamTag($m_jadwalpegawai_add, "p_x_idpeg") ?>
</span>
<?php echo $m_jadwalpegawai_add->idpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_add->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
	<div id="r_tanggal_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_tanggal_jadwalpeg" for="x_tanggal_jadwalpeg" class="<?php echo $m_jadwalpegawai_add->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_add->tanggal_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_add->tanggal_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_add->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_add->tanggal_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_tanggal_jadwalpeg">
<input type="text" data-table="m_jadwalpegawai" data-field="x_tanggal_jadwalpeg" name="x_tanggal_jadwalpeg" id="x_tanggal_jadwalpeg" maxlength="10" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_add->tanggal_jadwalpeg->getPlaceHolder()) ?>" value="<?php echo $m_jadwalpegawai_add->tanggal_jadwalpeg->EditValue ?>"<?php echo $m_jadwalpegawai_add->tanggal_jadwalpeg->editAttributes() ?>>
<?php if (!$m_jadwalpegawai_add->tanggal_jadwalpeg->ReadOnly && !$m_jadwalpegawai_add->tanggal_jadwalpeg->Disabled && !isset($m_jadwalpegawai_add->tanggal_jadwalpeg->EditAttrs["readonly"]) && !isset($m_jadwalpegawai_add->tanggal_jadwalpeg->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_jadwalpegawaiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_jadwalpegawaiadd", "x_tanggal_jadwalpeg", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_jadwalpegawai_add->tanggal_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_add->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
	<div id="r_jam_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_jam_jadwalpeg" for="x_jam_jadwalpeg" class="<?php echo $m_jadwalpegawai_add->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_add->jam_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_add->jam_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_add->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_add->jam_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_jam_jadwalpeg">
<input type="text" data-table="m_jadwalpegawai" data-field="x_jam_jadwalpeg" name="x_jam_jadwalpeg" id="x_jam_jadwalpeg" maxlength="8" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_add->jam_jadwalpeg->getPlaceHolder()) ?>" value="<?php echo $m_jadwalpegawai_add->jam_jadwalpeg->EditValue ?>"<?php echo $m_jadwalpegawai_add->jam_jadwalpeg->editAttributes() ?>>
</span>
<?php echo $m_jadwalpegawai_add->jam_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_add->keterangan_peg->Visible) { // keterangan_peg ?>
	<div id="r_keterangan_peg" class="form-group row">
		<label id="elh_m_jadwalpegawai_keterangan_peg" for="x_keterangan_peg" class="<?php echo $m_jadwalpegawai_add->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_add->keterangan_peg->caption() ?><?php echo $m_jadwalpegawai_add->keterangan_peg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_add->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_add->keterangan_peg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_keterangan_peg">
<textarea data-table="m_jadwalpegawai" data-field="x_keterangan_peg" name="x_keterangan_peg" id="x_keterangan_peg" cols="35" rows="4" placeholder="<?php echo HtmlEncode($m_jadwalpegawai_add->keterangan_peg->getPlaceHolder()) ?>"<?php echo $m_jadwalpegawai_add->keterangan_peg->editAttributes() ?>><?php echo $m_jadwalpegawai_add->keterangan_peg->EditValue ?></textarea>
</span>
<?php echo $m_jadwalpegawai_add->keterangan_peg->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jadwalpegawai_add->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
	<div id="r_status_jadwalpeg" class="form-group row">
		<label id="elh_m_jadwalpegawai_status_jadwalpeg" class="<?php echo $m_jadwalpegawai_add->LeftColumnClass ?>"><?php echo $m_jadwalpegawai_add->status_jadwalpeg->caption() ?><?php echo $m_jadwalpegawai_add->status_jadwalpeg->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jadwalpegawai_add->RightColumnClass ?>"><div <?php echo $m_jadwalpegawai_add->status_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_status_jadwalpeg">
<div id="tp_x_status_jadwalpeg" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_jadwalpegawai" data-field="x_status_jadwalpeg" data-value-separator="<?php echo $m_jadwalpegawai_add->status_jadwalpeg->displayValueSeparatorAttribute() ?>" name="x_status_jadwalpeg" id="x_status_jadwalpeg" value="{value}"<?php echo $m_jadwalpegawai_add->status_jadwalpeg->editAttributes() ?>></div>
<div id="dsl_x_status_jadwalpeg" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_jadwalpegawai_add->status_jadwalpeg->radioButtonListHtml(FALSE, "x_status_jadwalpeg") ?>
</div></div>
</span>
<?php echo $m_jadwalpegawai_add->status_jadwalpeg->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_jadwalpegawai_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_jadwalpegawai_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_jadwalpegawai_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_jadwalpegawai_add->showPageFooter();
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
$m_jadwalpegawai_add->terminate();
?>