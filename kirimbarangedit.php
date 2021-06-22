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
$kirimbarang_edit = new kirimbarang_edit();

// Run the page
$kirimbarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kirimbarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkirimbarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkirimbarangedit = currentForm = new ew.Form("fkirimbarangedit", "edit");

	// Validate form
	fkirimbarangedit.validate = function() {
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
			<?php if ($kirimbarang_edit->no_kirimbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_no_kirimbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->no_kirimbarang->caption(), $kirimbarang_edit->no_kirimbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kirimbarang_edit->id_po->Required) { ?>
				elm = this.getElements("x" + infix + "_id_po");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->id_po->caption(), $kirimbarang_edit->id_po->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kirimbarang_edit->id_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_id_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->id_supplier->caption(), $kirimbarang_edit->id_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kirimbarang_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->id_klinik->caption(), $kirimbarang_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kirimbarang_edit->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->id_pegawai->caption(), $kirimbarang_edit->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kirimbarang_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->tanggal->caption(), $kirimbarang_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kirimbarang_edit->tanggal->errorMessage()) ?>");
			<?php if ($kirimbarang_edit->status_kirim->Required) { ?>
				elm = this.getElements("x" + infix + "_status_kirim");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->status_kirim->caption(), $kirimbarang_edit->status_kirim->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kirimbarang_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kirimbarang_edit->keterangan->caption(), $kirimbarang_edit->keterangan->RequiredErrorMessage)) ?>");
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
	fkirimbarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkirimbarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkirimbarangedit.lists["x_id_po"] = <?php echo $kirimbarang_edit->id_po->Lookup->toClientList($kirimbarang_edit) ?>;
	fkirimbarangedit.lists["x_id_po"].options = <?php echo JsonEncode($kirimbarang_edit->id_po->lookupOptions()) ?>;
	fkirimbarangedit.lists["x_id_supplier"] = <?php echo $kirimbarang_edit->id_supplier->Lookup->toClientList($kirimbarang_edit) ?>;
	fkirimbarangedit.lists["x_id_supplier"].options = <?php echo JsonEncode($kirimbarang_edit->id_supplier->lookupOptions()) ?>;
	fkirimbarangedit.lists["x_id_klinik"] = <?php echo $kirimbarang_edit->id_klinik->Lookup->toClientList($kirimbarang_edit) ?>;
	fkirimbarangedit.lists["x_id_klinik"].options = <?php echo JsonEncode($kirimbarang_edit->id_klinik->lookupOptions()) ?>;
	fkirimbarangedit.lists["x_id_pegawai"] = <?php echo $kirimbarang_edit->id_pegawai->Lookup->toClientList($kirimbarang_edit) ?>;
	fkirimbarangedit.lists["x_id_pegawai"].options = <?php echo JsonEncode($kirimbarang_edit->id_pegawai->lookupOptions()) ?>;
	fkirimbarangedit.lists["x_status_kirim"] = <?php echo $kirimbarang_edit->status_kirim->Lookup->toClientList($kirimbarang_edit) ?>;
	fkirimbarangedit.lists["x_status_kirim"].options = <?php echo JsonEncode($kirimbarang_edit->status_kirim->options(FALSE, TRUE)) ?>;
	loadjs.done("fkirimbarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.
	//hidden status kirim

	$('div[id=r_status_kirim]').css({"display": "none"});
	var userlevel = <?php echo CurrentUserLevel(); ?>;
	if(userlevel != '-1'){
		$('select[name="x_id_supplier"]').prop('readonly', true);
		$('select[name="x_id_klinik"]').prop('readonly', true);
	}
});
</script>
<?php $kirimbarang_edit->showPageHeader(); ?>
<?php
$kirimbarang_edit->showMessage();
?>
<form name="fkirimbarangedit" id="fkirimbarangedit" class="<?php echo $kirimbarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kirimbarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kirimbarang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kirimbarang_edit->no_kirimbarang->Visible) { // no_kirimbarang ?>
	<div id="r_no_kirimbarang" class="form-group row">
		<label id="elh_kirimbarang_no_kirimbarang" for="x_no_kirimbarang" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->no_kirimbarang->caption() ?><?php echo $kirimbarang_edit->no_kirimbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->no_kirimbarang->cellAttributes() ?>>
<span id="el_kirimbarang_no_kirimbarang">
<input type="text" data-table="kirimbarang" data-field="x_no_kirimbarang" name="x_no_kirimbarang" id="x_no_kirimbarang" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($kirimbarang_edit->no_kirimbarang->getPlaceHolder()) ?>" value="<?php echo $kirimbarang_edit->no_kirimbarang->EditValue ?>"<?php echo $kirimbarang_edit->no_kirimbarang->editAttributes() ?>>
</span>
<?php echo $kirimbarang_edit->no_kirimbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->id_po->Visible) { // id_po ?>
	<div id="r_id_po" class="form-group row">
		<label id="elh_kirimbarang_id_po" for="x_id_po" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->id_po->caption() ?><?php echo $kirimbarang_edit->id_po->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->id_po->cellAttributes() ?>>
<span id="el_kirimbarang_id_po">
<?php $kirimbarang_edit->id_po->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_po" data-value-separator="<?php echo $kirimbarang_edit->id_po->displayValueSeparatorAttribute() ?>" id="x_id_po" name="x_id_po"<?php echo $kirimbarang_edit->id_po->editAttributes() ?>>
			<?php echo $kirimbarang_edit->id_po->selectOptionListHtml("x_id_po") ?>
		</select>
</div>
<?php echo $kirimbarang_edit->id_po->Lookup->getParamTag($kirimbarang_edit, "p_x_id_po") ?>
</span>
<?php echo $kirimbarang_edit->id_po->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->id_supplier->Visible) { // id_supplier ?>
	<div id="r_id_supplier" class="form-group row">
		<label id="elh_kirimbarang_id_supplier" for="x_id_supplier" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->id_supplier->caption() ?><?php echo $kirimbarang_edit->id_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->id_supplier->cellAttributes() ?>>
<span id="el_kirimbarang_id_supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_supplier" data-value-separator="<?php echo $kirimbarang_edit->id_supplier->displayValueSeparatorAttribute() ?>" id="x_id_supplier" name="x_id_supplier"<?php echo $kirimbarang_edit->id_supplier->editAttributes() ?>>
			<?php echo $kirimbarang_edit->id_supplier->selectOptionListHtml("x_id_supplier") ?>
		</select>
</div>
<?php echo $kirimbarang_edit->id_supplier->Lookup->getParamTag($kirimbarang_edit, "p_x_id_supplier") ?>
</span>
<?php echo $kirimbarang_edit->id_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_kirimbarang_id_klinik" for="x_id_klinik" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->id_klinik->caption() ?><?php echo $kirimbarang_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->id_klinik->cellAttributes() ?>>
<span id="el_kirimbarang_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_klinik" data-value-separator="<?php echo $kirimbarang_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $kirimbarang_edit->id_klinik->editAttributes() ?>>
			<?php echo $kirimbarang_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $kirimbarang_edit->id_klinik->Lookup->getParamTag($kirimbarang_edit, "p_x_id_klinik") ?>
</span>
<?php echo $kirimbarang_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_kirimbarang_id_pegawai" for="x_id_pegawai" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->id_pegawai->caption() ?><?php echo $kirimbarang_edit->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->id_pegawai->cellAttributes() ?>>
<span id="el_kirimbarang_id_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_pegawai" data-value-separator="<?php echo $kirimbarang_edit->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $kirimbarang_edit->id_pegawai->editAttributes() ?>>
			<?php echo $kirimbarang_edit->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $kirimbarang_edit->id_pegawai->Lookup->getParamTag($kirimbarang_edit, "p_x_id_pegawai") ?>
</span>
<?php echo $kirimbarang_edit->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_kirimbarang_tanggal" for="x_tanggal" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->tanggal->caption() ?><?php echo $kirimbarang_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->tanggal->cellAttributes() ?>>
<span id="el_kirimbarang_tanggal">
<input type="text" data-table="kirimbarang" data-field="x_tanggal" data-format="7" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kirimbarang_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $kirimbarang_edit->tanggal->EditValue ?>"<?php echo $kirimbarang_edit->tanggal->editAttributes() ?>>
<?php if (!$kirimbarang_edit->tanggal->ReadOnly && !$kirimbarang_edit->tanggal->Disabled && !isset($kirimbarang_edit->tanggal->EditAttrs["readonly"]) && !isset($kirimbarang_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkirimbarangedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fkirimbarangedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $kirimbarang_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->status_kirim->Visible) { // status_kirim ?>
	<div id="r_status_kirim" class="form-group row">
		<label id="elh_kirimbarang_status_kirim" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->status_kirim->caption() ?><?php echo $kirimbarang_edit->status_kirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->status_kirim->cellAttributes() ?>>
<span id="el_kirimbarang_status_kirim">
<div id="tp_x_status_kirim" class="ew-template"><input type="radio" class="custom-control-input" data-table="kirimbarang" data-field="x_status_kirim" data-value-separator="<?php echo $kirimbarang_edit->status_kirim->displayValueSeparatorAttribute() ?>" name="x_status_kirim" id="x_status_kirim" value="{value}"<?php echo $kirimbarang_edit->status_kirim->editAttributes() ?>></div>
<div id="dsl_x_status_kirim" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $kirimbarang_edit->status_kirim->radioButtonListHtml(FALSE, "x_status_kirim") ?>
</div></div>
</span>
<?php echo $kirimbarang_edit->status_kirim->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_kirimbarang_keterangan" for="x_keterangan" class="<?php echo $kirimbarang_edit->LeftColumnClass ?>"><?php echo $kirimbarang_edit->keterangan->caption() ?><?php echo $kirimbarang_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kirimbarang_edit->RightColumnClass ?>"><div <?php echo $kirimbarang_edit->keterangan->cellAttributes() ?>>
<span id="el_kirimbarang_keterangan">
<textarea data-table="kirimbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($kirimbarang_edit->keterangan->getPlaceHolder()) ?>"<?php echo $kirimbarang_edit->keterangan->editAttributes() ?>><?php echo $kirimbarang_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $kirimbarang_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="kirimbarang" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($kirimbarang_edit->id->CurrentValue) ?>">
<?php
	if (in_array("detailkirimbarang", explode(",", $kirimbarang->getCurrentDetailTable())) && $detailkirimbarang->DetailEdit) {
?>
<?php if ($kirimbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailkirimbarang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailkirimbaranggrid.php" ?>
<?php } ?>
<?php if (!$kirimbarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kirimbarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kirimbarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kirimbarang_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$("#btn-action").after("&nbsp;<button class='btn btn-info ew-btn' name='btn-action-draft' id='btn-action-draft' type='submit' style='height: 50px !important; width: 20% !important;'>Draft</button>"),$("#btn-action").click(function(){$('input[name="x_status_kirim"][value="dikirim"]').prop("checked",!0),$('input[name="x_status_kirim"][value="draft"]').prop("checked",null)}),$("#btn-action-draft").click(function(){$('input[name="x_status_kirim"][value="dikirim"]').prop("checked",null),$('input[name="x_status_kirim"][value="draft"]').prop("checked",!0)});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$kirimbarang_edit->terminate();
?>