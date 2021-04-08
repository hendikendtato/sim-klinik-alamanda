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
$kartupoin_edit = new kartupoin_edit();

// Run the page
$kartupoin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartupoin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkartupoinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkartupoinedit = currentForm = new ew.Form("fkartupoinedit", "edit");

	// Validate form
	fkartupoinedit.validate = function() {
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
			<?php if ($kartupoin_edit->id_kartupoin->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kartupoin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->id_kartupoin->caption(), $kartupoin_edit->id_kartupoin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartupoin_edit->id_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->id_pelanggan->caption(), $kartupoin_edit->id_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartupoin_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->id_klinik->caption(), $kartupoin_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartupoin_edit->kode_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->kode_penjualan->caption(), $kartupoin_edit->kode_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartupoin_edit->id_penyesuaian_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penyesuaian_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->id_penyesuaian_poin->caption(), $kartupoin_edit->id_penyesuaian_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_penyesuaian_poin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->id_penyesuaian_poin->errorMessage()) ?>");
			<?php if ($kartupoin_edit->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->tgl->caption(), $kartupoin_edit->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->tgl->errorMessage()) ?>");
			<?php if ($kartupoin_edit->masuk->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->masuk->caption(), $kartupoin_edit->masuk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->masuk->errorMessage()) ?>");
			<?php if ($kartupoin_edit->masuk_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->masuk_penyesuaian->caption(), $kartupoin_edit->masuk_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->masuk_penyesuaian->errorMessage()) ?>");
			<?php if ($kartupoin_edit->keluar->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->keluar->caption(), $kartupoin_edit->keluar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->keluar->errorMessage()) ?>");
			<?php if ($kartupoin_edit->keluar_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->keluar_penyesuaian->caption(), $kartupoin_edit->keluar_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->keluar_penyesuaian->errorMessage()) ?>");
			<?php if ($kartupoin_edit->saldo_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartupoin_edit->saldo_poin->caption(), $kartupoin_edit->saldo_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo_poin");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartupoin_edit->saldo_poin->errorMessage()) ?>");

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
	fkartupoinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkartupoinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkartupoinedit.lists["x_id_pelanggan"] = <?php echo $kartupoin_edit->id_pelanggan->Lookup->toClientList($kartupoin_edit) ?>;
	fkartupoinedit.lists["x_id_pelanggan"].options = <?php echo JsonEncode($kartupoin_edit->id_pelanggan->lookupOptions()) ?>;
	fkartupoinedit.lists["x_id_klinik"] = <?php echo $kartupoin_edit->id_klinik->Lookup->toClientList($kartupoin_edit) ?>;
	fkartupoinedit.lists["x_id_klinik"].options = <?php echo JsonEncode($kartupoin_edit->id_klinik->lookupOptions()) ?>;
	fkartupoinedit.lists["x_id_penyesuaian_poin"] = <?php echo $kartupoin_edit->id_penyesuaian_poin->Lookup->toClientList($kartupoin_edit) ?>;
	fkartupoinedit.lists["x_id_penyesuaian_poin"].options = <?php echo JsonEncode($kartupoin_edit->id_penyesuaian_poin->lookupOptions()) ?>;
	fkartupoinedit.autoSuggests["x_id_penyesuaian_poin"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fkartupoinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kartupoin_edit->showPageHeader(); ?>
<?php
$kartupoin_edit->showMessage();
?>
<form name="fkartupoinedit" id="fkartupoinedit" class="<?php echo $kartupoin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartupoin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kartupoin_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kartupoin_edit->id_kartupoin->Visible) { // id_kartupoin ?>
	<div id="r_id_kartupoin" class="form-group row">
		<label id="elh_kartupoin_id_kartupoin" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->id_kartupoin->caption() ?><?php echo $kartupoin_edit->id_kartupoin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->id_kartupoin->cellAttributes() ?>>
<span id="el_kartupoin_id_kartupoin">
<span<?php echo $kartupoin_edit->id_kartupoin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartupoin_edit->id_kartupoin->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="kartupoin" data-field="x_id_kartupoin" name="x_id_kartupoin" id="x_id_kartupoin" value="<?php echo HtmlEncode($kartupoin_edit->id_kartupoin->CurrentValue) ?>">
<?php echo $kartupoin_edit->id_kartupoin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label id="elh_kartupoin_id_pelanggan" for="x_id_pelanggan" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->id_pelanggan->caption() ?><?php echo $kartupoin_edit->id_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->id_pelanggan->cellAttributes() ?>>
<span id="el_kartupoin_id_pelanggan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartupoin" data-field="x_id_pelanggan" data-value-separator="<?php echo $kartupoin_edit->id_pelanggan->displayValueSeparatorAttribute() ?>" id="x_id_pelanggan" name="x_id_pelanggan"<?php echo $kartupoin_edit->id_pelanggan->editAttributes() ?>>
			<?php echo $kartupoin_edit->id_pelanggan->selectOptionListHtml("x_id_pelanggan") ?>
		</select>
</div>
<?php echo $kartupoin_edit->id_pelanggan->Lookup->getParamTag($kartupoin_edit, "p_x_id_pelanggan") ?>
</span>
<?php echo $kartupoin_edit->id_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_kartupoin_id_klinik" for="x_id_klinik" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->id_klinik->caption() ?><?php echo $kartupoin_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->id_klinik->cellAttributes() ?>>
<span id="el_kartupoin_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartupoin" data-field="x_id_klinik" data-value-separator="<?php echo $kartupoin_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $kartupoin_edit->id_klinik->editAttributes() ?>>
			<?php echo $kartupoin_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $kartupoin_edit->id_klinik->Lookup->getParamTag($kartupoin_edit, "p_x_id_klinik") ?>
</span>
<?php echo $kartupoin_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label id="elh_kartupoin_kode_penjualan" for="x_kode_penjualan" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->kode_penjualan->caption() ?><?php echo $kartupoin_edit->kode_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->kode_penjualan->cellAttributes() ?>>
<span id="el_kartupoin_kode_penjualan">
<input type="text" data-table="kartupoin" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($kartupoin_edit->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->kode_penjualan->EditValue ?>"<?php echo $kartupoin_edit->kode_penjualan->editAttributes() ?>>
</span>
<?php echo $kartupoin_edit->kode_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->id_penyesuaian_poin->Visible) { // id_penyesuaian_poin ?>
	<div id="r_id_penyesuaian_poin" class="form-group row">
		<label id="elh_kartupoin_id_penyesuaian_poin" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->id_penyesuaian_poin->caption() ?><?php echo $kartupoin_edit->id_penyesuaian_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->id_penyesuaian_poin->cellAttributes() ?>>
<span id="el_kartupoin_id_penyesuaian_poin">
<?php
$onchange = $kartupoin_edit->id_penyesuaian_poin->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartupoin_edit->id_penyesuaian_poin->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_penyesuaian_poin">
	<input type="text" class="form-control" name="sv_x_id_penyesuaian_poin" id="sv_x_id_penyesuaian_poin" value="<?php echo RemoveHtml($kartupoin_edit->id_penyesuaian_poin->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartupoin_edit->id_penyesuaian_poin->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartupoin_edit->id_penyesuaian_poin->getPlaceHolder()) ?>"<?php echo $kartupoin_edit->id_penyesuaian_poin->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartupoin" data-field="x_id_penyesuaian_poin" data-value-separator="<?php echo $kartupoin_edit->id_penyesuaian_poin->displayValueSeparatorAttribute() ?>" name="x_id_penyesuaian_poin" id="x_id_penyesuaian_poin" value="<?php echo HtmlEncode($kartupoin_edit->id_penyesuaian_poin->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartupoinedit"], function() {
	fkartupoinedit.createAutoSuggest({"id":"x_id_penyesuaian_poin","forceSelect":false});
});
</script>
<?php echo $kartupoin_edit->id_penyesuaian_poin->Lookup->getParamTag($kartupoin_edit, "p_x_id_penyesuaian_poin") ?>
</span>
<?php echo $kartupoin_edit->id_penyesuaian_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_kartupoin_tgl" for="x_tgl" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->tgl->caption() ?><?php echo $kartupoin_edit->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->tgl->cellAttributes() ?>>
<span id="el_kartupoin_tgl">
<input type="text" data-table="kartupoin" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="19" placeholder="<?php echo HtmlEncode($kartupoin_edit->tgl->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->tgl->EditValue ?>"<?php echo $kartupoin_edit->tgl->editAttributes() ?>>
<?php if (!$kartupoin_edit->tgl->ReadOnly && !$kartupoin_edit->tgl->Disabled && !isset($kartupoin_edit->tgl->EditAttrs["readonly"]) && !isset($kartupoin_edit->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartupoinedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartupoinedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $kartupoin_edit->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->masuk->Visible) { // masuk ?>
	<div id="r_masuk" class="form-group row">
		<label id="elh_kartupoin_masuk" for="x_masuk" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->masuk->caption() ?><?php echo $kartupoin_edit->masuk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->masuk->cellAttributes() ?>>
<span id="el_kartupoin_masuk">
<input type="text" data-table="kartupoin" data-field="x_masuk" name="x_masuk" id="x_masuk" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_edit->masuk->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->masuk->EditValue ?>"<?php echo $kartupoin_edit->masuk->editAttributes() ?>>
</span>
<?php echo $kartupoin_edit->masuk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<div id="r_masuk_penyesuaian" class="form-group row">
		<label id="elh_kartupoin_masuk_penyesuaian" for="x_masuk_penyesuaian" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->masuk_penyesuaian->caption() ?><?php echo $kartupoin_edit->masuk_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->masuk_penyesuaian->cellAttributes() ?>>
<span id="el_kartupoin_masuk_penyesuaian">
<input type="text" data-table="kartupoin" data-field="x_masuk_penyesuaian" name="x_masuk_penyesuaian" id="x_masuk_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_edit->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->masuk_penyesuaian->EditValue ?>"<?php echo $kartupoin_edit->masuk_penyesuaian->editAttributes() ?>>
</span>
<?php echo $kartupoin_edit->masuk_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->keluar->Visible) { // keluar ?>
	<div id="r_keluar" class="form-group row">
		<label id="elh_kartupoin_keluar" for="x_keluar" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->keluar->caption() ?><?php echo $kartupoin_edit->keluar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->keluar->cellAttributes() ?>>
<span id="el_kartupoin_keluar">
<input type="text" data-table="kartupoin" data-field="x_keluar" name="x_keluar" id="x_keluar" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_edit->keluar->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->keluar->EditValue ?>"<?php echo $kartupoin_edit->keluar->editAttributes() ?>>
</span>
<?php echo $kartupoin_edit->keluar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<div id="r_keluar_penyesuaian" class="form-group row">
		<label id="elh_kartupoin_keluar_penyesuaian" for="x_keluar_penyesuaian" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->keluar_penyesuaian->caption() ?><?php echo $kartupoin_edit->keluar_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->keluar_penyesuaian->cellAttributes() ?>>
<span id="el_kartupoin_keluar_penyesuaian">
<input type="text" data-table="kartupoin" data-field="x_keluar_penyesuaian" name="x_keluar_penyesuaian" id="x_keluar_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_edit->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->keluar_penyesuaian->EditValue ?>"<?php echo $kartupoin_edit->keluar_penyesuaian->editAttributes() ?>>
</span>
<?php echo $kartupoin_edit->keluar_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartupoin_edit->saldo_poin->Visible) { // saldo_poin ?>
	<div id="r_saldo_poin" class="form-group row">
		<label id="elh_kartupoin_saldo_poin" for="x_saldo_poin" class="<?php echo $kartupoin_edit->LeftColumnClass ?>"><?php echo $kartupoin_edit->saldo_poin->caption() ?><?php echo $kartupoin_edit->saldo_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartupoin_edit->RightColumnClass ?>"><div <?php echo $kartupoin_edit->saldo_poin->cellAttributes() ?>>
<span id="el_kartupoin_saldo_poin">
<input type="text" data-table="kartupoin" data-field="x_saldo_poin" name="x_saldo_poin" id="x_saldo_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartupoin_edit->saldo_poin->getPlaceHolder()) ?>" value="<?php echo $kartupoin_edit->saldo_poin->EditValue ?>"<?php echo $kartupoin_edit->saldo_poin->editAttributes() ?>>
</span>
<?php echo $kartupoin_edit->saldo_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kartupoin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kartupoin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kartupoin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kartupoin_edit->showPageFooter();
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
$kartupoin_edit->terminate();
?>