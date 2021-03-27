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
$mutasi_kas_edit = new mutasi_kas_edit();

// Run the page
$mutasi_kas_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mutasi_kas_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmutasi_kasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmutasi_kasedit = currentForm = new ew.Form("fmutasi_kasedit", "edit");

	// Validate form
	fmutasi_kasedit.validate = function() {
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
			<?php if ($mutasi_kas_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_edit->id->caption(), $mutasi_kas_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_edit->tgl->caption(), $mutasi_kas_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mutasi_kas_edit->tgl->errorMessage()) ?>");
			<?php if ($mutasi_kas_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_edit->id_klinik->caption(), $mutasi_kas_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_edit->id_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_edit->id_kas->caption(), $mutasi_kas_edit->id_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_edit->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_edit->tipe->caption(), $mutasi_kas_edit->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_edit->keterangan->caption(), $mutasi_kas_edit->keterangan->RequiredErrorMessage)) ?>");
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
	fmutasi_kasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmutasi_kasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmutasi_kasedit.lists["x_id_klinik"] = <?php echo $mutasi_kas_edit->id_klinik->Lookup->toClientList($mutasi_kas_edit) ?>;
	fmutasi_kasedit.lists["x_id_klinik"].options = <?php echo JsonEncode($mutasi_kas_edit->id_klinik->lookupOptions()) ?>;
	fmutasi_kasedit.lists["x_id_kas"] = <?php echo $mutasi_kas_edit->id_kas->Lookup->toClientList($mutasi_kas_edit) ?>;
	fmutasi_kasedit.lists["x_id_kas"].options = <?php echo JsonEncode($mutasi_kas_edit->id_kas->lookupOptions()) ?>;
	fmutasi_kasedit.lists["x_tipe"] = <?php echo $mutasi_kas_edit->tipe->Lookup->toClientList($mutasi_kas_edit) ?>;
	fmutasi_kasedit.lists["x_tipe"].options = <?php echo JsonEncode($mutasi_kas_edit->tipe->options(FALSE, TRUE)) ?>;
	loadjs.done("fmutasi_kasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("th[data-name=tipe_mutasi]").css({display:"none"}),$("td[data-name=tipe_mutasi]").css({display:"none"}),$('input:radio[name="x_tipe"]').change(function(){var a=$(this).val();$("[data-field=x_tipe_mutasi]").val(a)}),$("[data-field=x_nama_akun]").change(function(){var a=$(this).attr("id");console.log(a);var t="#"+a.split("_")[0];console.log(t);var n=t+"_nama_akun",o=t+"_jumlah",i=$("[data-field=x_id_kas]").val(),l=$(n).val().includes("Setor");console.log(l),1==l?axios.get(`api/?action=view&object=m_kas&id=${i}`).then(function(a){console.log(a.data);var t=a.data.m_kas.saldo;console.log(t),$(o).val(t)}).catch(function(a){console.log(a)}):$(o).val("0")});
});
</script>
<?php $mutasi_kas_edit->showPageHeader(); ?>
<?php
$mutasi_kas_edit->showMessage();
?>
<form name="fmutasi_kasedit" id="fmutasi_kasedit" class="<?php echo $mutasi_kas_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mutasi_kas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$mutasi_kas_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($mutasi_kas_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_mutasi_kas_id" class="<?php echo $mutasi_kas_edit->LeftColumnClass ?>"><?php echo $mutasi_kas_edit->id->caption() ?><?php echo $mutasi_kas_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_edit->RightColumnClass ?>"><div <?php echo $mutasi_kas_edit->id->cellAttributes() ?>>
<span id="el_mutasi_kas_id">
<span<?php echo $mutasi_kas_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mutasi_kas_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="mutasi_kas" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($mutasi_kas_edit->id->CurrentValue) ?>">
<?php echo $mutasi_kas_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_mutasi_kas_tgl" for="x_tgl" class="<?php echo $mutasi_kas_edit->LeftColumnClass ?>"><?php echo $mutasi_kas_edit->tgl->caption() ?><?php echo $mutasi_kas_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_edit->RightColumnClass ?>"><div <?php echo $mutasi_kas_edit->tgl->cellAttributes() ?>>
<span id="el_mutasi_kas_tgl">
<input type="text" data-table="mutasi_kas" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($mutasi_kas_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_edit->tgl->EditValue ?>"<?php echo $mutasi_kas_edit->tgl->editAttributes() ?>>
<?php if (!$mutasi_kas_edit->tgl->ReadOnly && !$mutasi_kas_edit->tgl->Disabled && !isset($mutasi_kas_edit->tgl->EditAttrs["readonly"]) && !isset($mutasi_kas_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmutasi_kasedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fmutasi_kasedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $mutasi_kas_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_mutasi_kas_id_klinik" for="x_id_klinik" class="<?php echo $mutasi_kas_edit->LeftColumnClass ?>"><?php echo $mutasi_kas_edit->id_klinik->caption() ?><?php echo $mutasi_kas_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_edit->RightColumnClass ?>"><div <?php echo $mutasi_kas_edit->id_klinik->cellAttributes() ?>>
<span id="el_mutasi_kas_id_klinik">
<?php $mutasi_kas_edit->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_id_klinik" data-value-separator="<?php echo $mutasi_kas_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $mutasi_kas_edit->id_klinik->editAttributes() ?>>
			<?php echo $mutasi_kas_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $mutasi_kas_edit->id_klinik->Lookup->getParamTag($mutasi_kas_edit, "p_x_id_klinik") ?>
</span>
<?php echo $mutasi_kas_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_edit->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label id="elh_mutasi_kas_id_kas" for="x_id_kas" class="<?php echo $mutasi_kas_edit->LeftColumnClass ?>"><?php echo $mutasi_kas_edit->id_kas->caption() ?><?php echo $mutasi_kas_edit->id_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_edit->RightColumnClass ?>"><div <?php echo $mutasi_kas_edit->id_kas->cellAttributes() ?>>
<span id="el_mutasi_kas_id_kas">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_id_kas" data-value-separator="<?php echo $mutasi_kas_edit->id_kas->displayValueSeparatorAttribute() ?>" id="x_id_kas" name="x_id_kas"<?php echo $mutasi_kas_edit->id_kas->editAttributes() ?>>
			<?php echo $mutasi_kas_edit->id_kas->selectOptionListHtml("x_id_kas") ?>
		</select>
</div>
<?php echo $mutasi_kas_edit->id_kas->Lookup->getParamTag($mutasi_kas_edit, "p_x_id_kas") ?>
</span>
<?php echo $mutasi_kas_edit->id_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_edit->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_mutasi_kas_tipe" class="<?php echo $mutasi_kas_edit->LeftColumnClass ?>"><?php echo $mutasi_kas_edit->tipe->caption() ?><?php echo $mutasi_kas_edit->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_edit->RightColumnClass ?>"><div <?php echo $mutasi_kas_edit->tipe->cellAttributes() ?>>
<span id="el_mutasi_kas_tipe">
<div id="tp_x_tipe" class="ew-template"><input type="radio" class="custom-control-input" data-table="mutasi_kas" data-field="x_tipe" data-value-separator="<?php echo $mutasi_kas_edit->tipe->displayValueSeparatorAttribute() ?>" name="x_tipe" id="x_tipe" value="{value}"<?php echo $mutasi_kas_edit->tipe->editAttributes() ?>></div>
<div id="dsl_x_tipe" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mutasi_kas_edit->tipe->radioButtonListHtml(FALSE, "x_tipe") ?>
</div></div>
</span>
<?php echo $mutasi_kas_edit->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_mutasi_kas_keterangan" for="x_keterangan" class="<?php echo $mutasi_kas_edit->LeftColumnClass ?>"><?php echo $mutasi_kas_edit->keterangan->caption() ?><?php echo $mutasi_kas_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_edit->RightColumnClass ?>"><div <?php echo $mutasi_kas_edit->keterangan->cellAttributes() ?>>
<span id="el_mutasi_kas_keterangan">
<input type="text" data-table="mutasi_kas" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($mutasi_kas_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_edit->keterangan->EditValue ?>"<?php echo $mutasi_kas_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $mutasi_kas_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailmutasibank", explode(",", $mutasi_kas->getCurrentDetailTable())) && $detailmutasibank->DetailEdit) {
?>
<?php if ($mutasi_kas->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailmutasibank", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailmutasibankgrid.php" ?>
<?php } ?>
<?php if (!$mutasi_kas_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mutasi_kas_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mutasi_kas_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mutasi_kas_edit->showPageFooter();
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
$mutasi_kas_edit->terminate();
?>