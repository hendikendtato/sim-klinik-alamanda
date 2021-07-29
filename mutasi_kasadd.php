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
$mutasi_kas_add = new mutasi_kas_add();

// Run the page
$mutasi_kas_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mutasi_kas_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmutasi_kasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmutasi_kasadd = currentForm = new ew.Form("fmutasi_kasadd", "add");

	// Validate form
	fmutasi_kasadd.validate = function() {
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
			<?php if ($mutasi_kas_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_add->tgl->caption(), $mutasi_kas_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mutasi_kas_add->tgl->errorMessage()) ?>");
			<?php if ($mutasi_kas_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_add->id_klinik->caption(), $mutasi_kas_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_add->id_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_add->id_kas->caption(), $mutasi_kas_add->id_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_add->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_add->tipe->caption(), $mutasi_kas_add->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_add->staff->Required) { ?>
				elm = this.getElements("x" + infix + "_staff");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_add->staff->caption(), $mutasi_kas_add->staff->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mutasi_kas_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mutasi_kas_add->keterangan->caption(), $mutasi_kas_add->keterangan->RequiredErrorMessage)) ?>");
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
	fmutasi_kasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmutasi_kasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmutasi_kasadd.lists["x_id_klinik"] = <?php echo $mutasi_kas_add->id_klinik->Lookup->toClientList($mutasi_kas_add) ?>;
	fmutasi_kasadd.lists["x_id_klinik"].options = <?php echo JsonEncode($mutasi_kas_add->id_klinik->lookupOptions()) ?>;
	fmutasi_kasadd.lists["x_id_kas"] = <?php echo $mutasi_kas_add->id_kas->Lookup->toClientList($mutasi_kas_add) ?>;
	fmutasi_kasadd.lists["x_id_kas"].options = <?php echo JsonEncode($mutasi_kas_add->id_kas->lookupOptions()) ?>;
	fmutasi_kasadd.lists["x_tipe"] = <?php echo $mutasi_kas_add->tipe->Lookup->toClientList($mutasi_kas_add) ?>;
	fmutasi_kasadd.lists["x_tipe"].options = <?php echo JsonEncode($mutasi_kas_add->tipe->options(FALSE, TRUE)) ?>;
	fmutasi_kasadd.lists["x_staff"] = <?php echo $mutasi_kas_add->staff->Lookup->toClientList($mutasi_kas_add) ?>;
	fmutasi_kasadd.lists["x_staff"].options = <?php echo JsonEncode($mutasi_kas_add->staff->lookupOptions()) ?>;
	loadjs.done("fmutasi_kasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("th[data-name=tipe_mutasi]").css({display:"none"}),$("td[data-name=tipe_mutasi]").css({display:"none"}),$('input:radio[name="x_tipe"]').change(function(){var a=$(this).val();$("[data-field=x_tipe_mutasi]").val(a)}),$("[data-field=x_nama_akun]").change(function(){var a=$(this).attr("id");console.log(a);var t="#"+a.split("_")[0];console.log(t);var n=t+"_nama_akun",o=t+"_jumlah",e=$("[data-field=x_id_kas]").val(),l=$(n).val().includes("Setor");console.log(l),1==l?axios.get(`api/?action=view&object=m_kas&id=${e}`).then(function(a){console.log(a.data);var t=a.data.m_kas.saldo;console.log(t),$(o).val(t)}).catch(function(a){console.log(a)}):$(o).val("0")});var now=new Date,day=("0"+now.getDate()).slice(-2),month=("0"+(now.getMonth()+1)).slice(-2),today=day+"/"+month+"/"+now.getFullYear();$("input#x_tgl").val(today),$("input#x_tgl").prop("disabled",!0);
});
</script>
<?php $mutasi_kas_add->showPageHeader(); ?>
<?php
$mutasi_kas_add->showMessage();
?>
<form name="fmutasi_kasadd" id="fmutasi_kasadd" class="<?php echo $mutasi_kas_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mutasi_kas">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$mutasi_kas_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($mutasi_kas_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_mutasi_kas_tgl" for="x_tgl" class="<?php echo $mutasi_kas_add->LeftColumnClass ?>"><?php echo $mutasi_kas_add->tgl->caption() ?><?php echo $mutasi_kas_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_add->RightColumnClass ?>"><div <?php echo $mutasi_kas_add->tgl->cellAttributes() ?>>
<span id="el_mutasi_kas_tgl">
<input type="text" data-table="mutasi_kas" data-field="x_tgl" data-format="7" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($mutasi_kas_add->tgl->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_add->tgl->EditValue ?>"<?php echo $mutasi_kas_add->tgl->editAttributes() ?>>
<?php if (!$mutasi_kas_add->tgl->ReadOnly && !$mutasi_kas_add->tgl->Disabled && !isset($mutasi_kas_add->tgl->EditAttrs["readonly"]) && !isset($mutasi_kas_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmutasi_kasadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fmutasi_kasadd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $mutasi_kas_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_mutasi_kas_id_klinik" for="x_id_klinik" class="<?php echo $mutasi_kas_add->LeftColumnClass ?>"><?php echo $mutasi_kas_add->id_klinik->caption() ?><?php echo $mutasi_kas_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_add->RightColumnClass ?>"><div <?php echo $mutasi_kas_add->id_klinik->cellAttributes() ?>>
<span id="el_mutasi_kas_id_klinik">
<?php $mutasi_kas_add->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_id_klinik" data-value-separator="<?php echo $mutasi_kas_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $mutasi_kas_add->id_klinik->editAttributes() ?>>
			<?php echo $mutasi_kas_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $mutasi_kas_add->id_klinik->Lookup->getParamTag($mutasi_kas_add, "p_x_id_klinik") ?>
</span>
<?php echo $mutasi_kas_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_add->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label id="elh_mutasi_kas_id_kas" for="x_id_kas" class="<?php echo $mutasi_kas_add->LeftColumnClass ?>"><?php echo $mutasi_kas_add->id_kas->caption() ?><?php echo $mutasi_kas_add->id_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_add->RightColumnClass ?>"><div <?php echo $mutasi_kas_add->id_kas->cellAttributes() ?>>
<span id="el_mutasi_kas_id_kas">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_id_kas" data-value-separator="<?php echo $mutasi_kas_add->id_kas->displayValueSeparatorAttribute() ?>" id="x_id_kas" name="x_id_kas"<?php echo $mutasi_kas_add->id_kas->editAttributes() ?>>
			<?php echo $mutasi_kas_add->id_kas->selectOptionListHtml("x_id_kas") ?>
		</select>
</div>
<?php echo $mutasi_kas_add->id_kas->Lookup->getParamTag($mutasi_kas_add, "p_x_id_kas") ?>
</span>
<?php echo $mutasi_kas_add->id_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_add->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_mutasi_kas_tipe" class="<?php echo $mutasi_kas_add->LeftColumnClass ?>"><?php echo $mutasi_kas_add->tipe->caption() ?><?php echo $mutasi_kas_add->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_add->RightColumnClass ?>"><div <?php echo $mutasi_kas_add->tipe->cellAttributes() ?>>
<span id="el_mutasi_kas_tipe">
<div id="tp_x_tipe" class="ew-template"><input type="radio" class="custom-control-input" data-table="mutasi_kas" data-field="x_tipe" data-value-separator="<?php echo $mutasi_kas_add->tipe->displayValueSeparatorAttribute() ?>" name="x_tipe" id="x_tipe" value="{value}"<?php echo $mutasi_kas_add->tipe->editAttributes() ?>></div>
<div id="dsl_x_tipe" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mutasi_kas_add->tipe->radioButtonListHtml(FALSE, "x_tipe") ?>
</div></div>
</span>
<?php echo $mutasi_kas_add->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_add->staff->Visible) { // staff ?>
	<div id="r_staff" class="form-group row">
		<label id="elh_mutasi_kas_staff" for="x_staff" class="<?php echo $mutasi_kas_add->LeftColumnClass ?>"><?php echo $mutasi_kas_add->staff->caption() ?><?php echo $mutasi_kas_add->staff->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_add->RightColumnClass ?>"><div <?php echo $mutasi_kas_add->staff->cellAttributes() ?>>
<span id="el_mutasi_kas_staff">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mutasi_kas" data-field="x_staff" data-value-separator="<?php echo $mutasi_kas_add->staff->displayValueSeparatorAttribute() ?>" id="x_staff" name="x_staff"<?php echo $mutasi_kas_add->staff->editAttributes() ?>>
			<?php echo $mutasi_kas_add->staff->selectOptionListHtml("x_staff") ?>
		</select>
</div>
<?php echo $mutasi_kas_add->staff->Lookup->getParamTag($mutasi_kas_add, "p_x_staff") ?>
</span>
<?php echo $mutasi_kas_add->staff->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mutasi_kas_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_mutasi_kas_keterangan" for="x_keterangan" class="<?php echo $mutasi_kas_add->LeftColumnClass ?>"><?php echo $mutasi_kas_add->keterangan->caption() ?><?php echo $mutasi_kas_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mutasi_kas_add->RightColumnClass ?>"><div <?php echo $mutasi_kas_add->keterangan->cellAttributes() ?>>
<span id="el_mutasi_kas_keterangan">
<input type="text" data-table="mutasi_kas" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($mutasi_kas_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $mutasi_kas_add->keterangan->EditValue ?>"<?php echo $mutasi_kas_add->keterangan->editAttributes() ?>>
</span>
<?php echo $mutasi_kas_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailmutasibank", explode(",", $mutasi_kas->getCurrentDetailTable())) && $detailmutasibank->DetailAdd) {
?>
<?php if ($mutasi_kas->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailmutasibank", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailmutasibankgrid.php" ?>
<?php } ?>
<?php if (!$mutasi_kas_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mutasi_kas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mutasi_kas_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mutasi_kas_add->showPageFooter();
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
$mutasi_kas_add->terminate();
?>