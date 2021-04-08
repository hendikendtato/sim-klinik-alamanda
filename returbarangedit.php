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
$returbarang_edit = new returbarang_edit();

// Run the page
$returbarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$returbarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freturbarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	freturbarangedit = currentForm = new ew.Form("freturbarangedit", "edit");

	// Validate form
	freturbarangedit.validate = function() {
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
			<?php if ($returbarang_edit->id_retur->Required) { ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->id_retur->caption(), $returbarang_edit->id_retur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_edit->kode->Required) { ?>
				elm = this.getElements("x" + infix + "_kode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->kode->caption(), $returbarang_edit->kode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->id_klinik->caption(), $returbarang_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_edit->id_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_id_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->id_supplier->caption(), $returbarang_edit->id_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_edit->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->id_pegawai->caption(), $returbarang_edit->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->tanggal->caption(), $returbarang_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($returbarang_edit->tanggal->errorMessage()) ?>");
			<?php if ($returbarang_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->status->caption(), $returbarang_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_edit->keterangan->caption(), $returbarang_edit->keterangan->RequiredErrorMessage)) ?>");
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
	freturbarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freturbarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freturbarangedit.lists["x_id_klinik"] = <?php echo $returbarang_edit->id_klinik->Lookup->toClientList($returbarang_edit) ?>;
	freturbarangedit.lists["x_id_klinik"].options = <?php echo JsonEncode($returbarang_edit->id_klinik->lookupOptions()) ?>;
	freturbarangedit.lists["x_id_supplier"] = <?php echo $returbarang_edit->id_supplier->Lookup->toClientList($returbarang_edit) ?>;
	freturbarangedit.lists["x_id_supplier"].options = <?php echo JsonEncode($returbarang_edit->id_supplier->lookupOptions()) ?>;
	freturbarangedit.lists["x_id_pegawai"] = <?php echo $returbarang_edit->id_pegawai->Lookup->toClientList($returbarang_edit) ?>;
	freturbarangedit.lists["x_id_pegawai"].options = <?php echo JsonEncode($returbarang_edit->id_pegawai->lookupOptions()) ?>;
	freturbarangedit.lists["x_status"] = <?php echo $returbarang_edit->status->Lookup->toClientList($returbarang_edit) ?>;
	freturbarangedit.lists["x_status"].options = <?php echo JsonEncode($returbarang_edit->status->options(FALSE, TRUE)) ?>;
	loadjs.done("freturbarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $returbarang_edit->showPageHeader(); ?>
<?php
$returbarang_edit->showMessage();
?>
<form name="freturbarangedit" id="freturbarangedit" class="<?php echo $returbarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="returbarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$returbarang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($returbarang_edit->id_retur->Visible) { // id_retur ?>
	<div id="r_id_retur" class="form-group row">
		<label id="elh_returbarang_id_retur" for="x_id_retur" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->id_retur->caption() ?><?php echo $returbarang_edit->id_retur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->id_retur->cellAttributes() ?>>
<span id="el_returbarang_id_retur">
<span<?php echo $returbarang_edit->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($returbarang_edit->id_retur->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="returbarang" data-field="x_id_retur" name="x_id_retur" id="x_id_retur" value="<?php echo HtmlEncode($returbarang_edit->id_retur->CurrentValue) ?>">
<?php echo $returbarang_edit->id_retur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->kode->Visible) { // kode ?>
	<div id="r_kode" class="form-group row">
		<label id="elh_returbarang_kode" for="x_kode" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->kode->caption() ?><?php echo $returbarang_edit->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->kode->cellAttributes() ?>>
<span id="el_returbarang_kode">
<input type="text" data-table="returbarang" data-field="x_kode" name="x_kode" id="x_kode" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($returbarang_edit->kode->getPlaceHolder()) ?>" value="<?php echo $returbarang_edit->kode->EditValue ?>"<?php echo $returbarang_edit->kode->editAttributes() ?>>
</span>
<?php echo $returbarang_edit->kode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_returbarang_id_klinik" for="x_id_klinik" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->id_klinik->caption() ?><?php echo $returbarang_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->id_klinik->cellAttributes() ?>>
<span id="el_returbarang_id_klinik">
<?php $returbarang_edit->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="returbarang" data-field="x_id_klinik" data-value-separator="<?php echo $returbarang_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $returbarang_edit->id_klinik->editAttributes() ?>>
			<?php echo $returbarang_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $returbarang_edit->id_klinik->Lookup->getParamTag($returbarang_edit, "p_x_id_klinik") ?>
</span>
<?php echo $returbarang_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->id_supplier->Visible) { // id_supplier ?>
	<div id="r_id_supplier" class="form-group row">
		<label id="elh_returbarang_id_supplier" for="x_id_supplier" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->id_supplier->caption() ?><?php echo $returbarang_edit->id_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->id_supplier->cellAttributes() ?>>
<span id="el_returbarang_id_supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="returbarang" data-field="x_id_supplier" data-value-separator="<?php echo $returbarang_edit->id_supplier->displayValueSeparatorAttribute() ?>" id="x_id_supplier" name="x_id_supplier"<?php echo $returbarang_edit->id_supplier->editAttributes() ?>>
			<?php echo $returbarang_edit->id_supplier->selectOptionListHtml("x_id_supplier") ?>
		</select>
</div>
<?php echo $returbarang_edit->id_supplier->Lookup->getParamTag($returbarang_edit, "p_x_id_supplier") ?>
</span>
<?php echo $returbarang_edit->id_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_returbarang_id_pegawai" for="x_id_pegawai" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->id_pegawai->caption() ?><?php echo $returbarang_edit->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->id_pegawai->cellAttributes() ?>>
<span id="el_returbarang_id_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="returbarang" data-field="x_id_pegawai" data-value-separator="<?php echo $returbarang_edit->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $returbarang_edit->id_pegawai->editAttributes() ?>>
			<?php echo $returbarang_edit->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $returbarang_edit->id_pegawai->Lookup->getParamTag($returbarang_edit, "p_x_id_pegawai") ?>
</span>
<?php echo $returbarang_edit->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_returbarang_tanggal" for="x_tanggal" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->tanggal->caption() ?><?php echo $returbarang_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->tanggal->cellAttributes() ?>>
<span id="el_returbarang_tanggal">
<input type="text" data-table="returbarang" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="10" placeholder="<?php echo HtmlEncode($returbarang_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $returbarang_edit->tanggal->EditValue ?>"<?php echo $returbarang_edit->tanggal->editAttributes() ?>>
<?php if (!$returbarang_edit->tanggal->ReadOnly && !$returbarang_edit->tanggal->Disabled && !isset($returbarang_edit->tanggal->EditAttrs["readonly"]) && !isset($returbarang_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freturbarangedit", "datetimepicker"], function() {
	ew.createDateTimePicker("freturbarangedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $returbarang_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_returbarang_status" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->status->caption() ?><?php echo $returbarang_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->status->cellAttributes() ?>>
<span id="el_returbarang_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="returbarang" data-field="x_status" data-value-separator="<?php echo $returbarang_edit->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $returbarang_edit->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $returbarang_edit->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $returbarang_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_returbarang_keterangan" for="x_keterangan" class="<?php echo $returbarang_edit->LeftColumnClass ?>"><?php echo $returbarang_edit->keterangan->caption() ?><?php echo $returbarang_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_edit->RightColumnClass ?>"><div <?php echo $returbarang_edit->keterangan->cellAttributes() ?>>
<span id="el_returbarang_keterangan">
<textarea data-table="returbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($returbarang_edit->keterangan->getPlaceHolder()) ?>"<?php echo $returbarang_edit->keterangan->editAttributes() ?>><?php echo $returbarang_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $returbarang_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailretur", explode(",", $returbarang->getCurrentDetailTable())) && $detailretur->DetailEdit) {
?>
<?php if ($returbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailretur", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailreturgrid.php" ?>
<?php } ?>
<?php if (!$returbarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $returbarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $returbarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$returbarang_edit->showPageFooter();
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
$returbarang_edit->terminate();
?>