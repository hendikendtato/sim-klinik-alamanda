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
$permintaanpembelian_add = new permintaanpembelian_add();

// Run the page
$permintaanpembelian_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$permintaanpembelian_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpermintaanpembelianadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpermintaanpembelianadd = currentForm = new ew.Form("fpermintaanpembelianadd", "add");

	// Validate form
	fpermintaanpembelianadd.validate = function() {
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
			<?php if ($permintaanpembelian_add->no_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_no_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->no_pp->caption(), $permintaanpembelian_add->no_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->namapaket_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_namapaket_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->namapaket_pp->caption(), $permintaanpembelian_add->namapaket_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->tgl_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->tgl_pp->caption(), $permintaanpembelian_add->tgl_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_pp");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($permintaanpembelian_add->tgl_pp->errorMessage()) ?>");
			<?php if ($permintaanpembelian_add->tgl_kebutuhan->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_kebutuhan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->tgl_kebutuhan->caption(), $permintaanpembelian_add->tgl_kebutuhan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_kebutuhan");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($permintaanpembelian_add->tgl_kebutuhan->errorMessage()) ?>");
			<?php if ($permintaanpembelian_add->tgl_persetujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_persetujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->tgl_persetujuan->caption(), $permintaanpembelian_add->tgl_persetujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_persetujuan");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($permintaanpembelian_add->tgl_persetujuan->errorMessage()) ?>");
			<?php if ($permintaanpembelian_add->staf_pengajuan->Required) { ?>
				elm = this.getElements("x" + infix + "_staf_pengajuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->staf_pengajuan->caption(), $permintaanpembelian_add->staf_pengajuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->staf_validasi->Required) { ?>
				elm = this.getElements("x" + infix + "_staf_validasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->staf_validasi->caption(), $permintaanpembelian_add->staf_validasi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->id_suplier->Required) { ?>
				elm = this.getElements("x" + infix + "_id_suplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->id_suplier->caption(), $permintaanpembelian_add->id_suplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->idklinik->Required) { ?>
				elm = this.getElements("x" + infix + "_idklinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->idklinik->caption(), $permintaanpembelian_add->idklinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->validasi->Required) { ?>
				elm = this.getElements("x" + infix + "_validasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->validasi->caption(), $permintaanpembelian_add->validasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_validasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($permintaanpembelian_add->validasi->errorMessage()) ?>");
			<?php if ($permintaanpembelian_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->status->caption(), $permintaanpembelian_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->email_pusat->Required) { ?>
				elm = this.getElements("x" + infix + "_email_pusat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->email_pusat->caption(), $permintaanpembelian_add->email_pusat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($permintaanpembelian_add->email_cabang->Required) { ?>
				elm = this.getElements("x" + infix + "_email_cabang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $permintaanpembelian_add->email_cabang->caption(), $permintaanpembelian_add->email_cabang->RequiredErrorMessage)) ?>");
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
	fpermintaanpembelianadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpermintaanpembelianadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpermintaanpembelianadd.lists["x_staf_pengajuan"] = <?php echo $permintaanpembelian_add->staf_pengajuan->Lookup->toClientList($permintaanpembelian_add) ?>;
	fpermintaanpembelianadd.lists["x_staf_pengajuan"].options = <?php echo JsonEncode($permintaanpembelian_add->staf_pengajuan->lookupOptions()) ?>;
	fpermintaanpembelianadd.lists["x_staf_validasi"] = <?php echo $permintaanpembelian_add->staf_validasi->Lookup->toClientList($permintaanpembelian_add) ?>;
	fpermintaanpembelianadd.lists["x_staf_validasi"].options = <?php echo JsonEncode($permintaanpembelian_add->staf_validasi->lookupOptions()) ?>;
	fpermintaanpembelianadd.lists["x_id_suplier"] = <?php echo $permintaanpembelian_add->id_suplier->Lookup->toClientList($permintaanpembelian_add) ?>;
	fpermintaanpembelianadd.lists["x_id_suplier"].options = <?php echo JsonEncode($permintaanpembelian_add->id_suplier->lookupOptions()) ?>;
	fpermintaanpembelianadd.lists["x_idklinik"] = <?php echo $permintaanpembelian_add->idklinik->Lookup->toClientList($permintaanpembelian_add) ?>;
	fpermintaanpembelianadd.lists["x_idklinik"].options = <?php echo JsonEncode($permintaanpembelian_add->idklinik->lookupOptions()) ?>;
	fpermintaanpembelianadd.lists["x_status"] = <?php echo $permintaanpembelian_add->status->Lookup->toClientList($permintaanpembelian_add) ?>;
	fpermintaanpembelianadd.lists["x_status"].options = <?php echo JsonEncode($permintaanpembelian_add->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpermintaanpembelianadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $permintaanpembelian_add->showPageHeader(); ?>
<?php
$permintaanpembelian_add->showMessage();
?>
<form name="fpermintaanpembelianadd" id="fpermintaanpembelianadd" class="<?php echo $permintaanpembelian_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="permintaanpembelian">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$permintaanpembelian_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($permintaanpembelian_add->no_pp->Visible) { // no_pp ?>
	<div id="r_no_pp" class="form-group row">
		<label id="elh_permintaanpembelian_no_pp" for="x_no_pp" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->no_pp->caption() ?><?php echo $permintaanpembelian_add->no_pp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->no_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_no_pp">
<input type="text" data-table="permintaanpembelian" data-field="x_no_pp" name="x_no_pp" id="x_no_pp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->no_pp->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->no_pp->EditValue ?>"<?php echo $permintaanpembelian_add->no_pp->editAttributes() ?>>
</span>
<?php echo $permintaanpembelian_add->no_pp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->namapaket_pp->Visible) { // namapaket_pp ?>
	<div id="r_namapaket_pp" class="form-group row">
		<label id="elh_permintaanpembelian_namapaket_pp" for="x_namapaket_pp" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->namapaket_pp->caption() ?><?php echo $permintaanpembelian_add->namapaket_pp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->namapaket_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_namapaket_pp">
<input type="text" data-table="permintaanpembelian" data-field="x_namapaket_pp" name="x_namapaket_pp" id="x_namapaket_pp" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->namapaket_pp->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->namapaket_pp->EditValue ?>"<?php echo $permintaanpembelian_add->namapaket_pp->editAttributes() ?>>
</span>
<?php echo $permintaanpembelian_add->namapaket_pp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->tgl_pp->Visible) { // tgl_pp ?>
	<div id="r_tgl_pp" class="form-group row">
		<label id="elh_permintaanpembelian_tgl_pp" for="x_tgl_pp" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->tgl_pp->caption() ?><?php echo $permintaanpembelian_add->tgl_pp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->tgl_pp->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_pp">
<input type="text" data-table="permintaanpembelian" data-field="x_tgl_pp" name="x_tgl_pp" id="x_tgl_pp" maxlength="10" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->tgl_pp->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->tgl_pp->EditValue ?>"<?php echo $permintaanpembelian_add->tgl_pp->editAttributes() ?>>
<?php if (!$permintaanpembelian_add->tgl_pp->ReadOnly && !$permintaanpembelian_add->tgl_pp->Disabled && !isset($permintaanpembelian_add->tgl_pp->EditAttrs["readonly"]) && !isset($permintaanpembelian_add->tgl_pp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpermintaanpembelianadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpermintaanpembelianadd", "x_tgl_pp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $permintaanpembelian_add->tgl_pp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->tgl_kebutuhan->Visible) { // tgl_kebutuhan ?>
	<div id="r_tgl_kebutuhan" class="form-group row">
		<label id="elh_permintaanpembelian_tgl_kebutuhan" for="x_tgl_kebutuhan" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->tgl_kebutuhan->caption() ?><?php echo $permintaanpembelian_add->tgl_kebutuhan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->tgl_kebutuhan->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_kebutuhan">
<input type="text" data-table="permintaanpembelian" data-field="x_tgl_kebutuhan" name="x_tgl_kebutuhan" id="x_tgl_kebutuhan" maxlength="10" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->tgl_kebutuhan->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->tgl_kebutuhan->EditValue ?>"<?php echo $permintaanpembelian_add->tgl_kebutuhan->editAttributes() ?>>
<?php if (!$permintaanpembelian_add->tgl_kebutuhan->ReadOnly && !$permintaanpembelian_add->tgl_kebutuhan->Disabled && !isset($permintaanpembelian_add->tgl_kebutuhan->EditAttrs["readonly"]) && !isset($permintaanpembelian_add->tgl_kebutuhan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpermintaanpembelianadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpermintaanpembelianadd", "x_tgl_kebutuhan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $permintaanpembelian_add->tgl_kebutuhan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->tgl_persetujuan->Visible) { // tgl_persetujuan ?>
	<div id="r_tgl_persetujuan" class="form-group row">
		<label id="elh_permintaanpembelian_tgl_persetujuan" for="x_tgl_persetujuan" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->tgl_persetujuan->caption() ?><?php echo $permintaanpembelian_add->tgl_persetujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->tgl_persetujuan->cellAttributes() ?>>
<span id="el_permintaanpembelian_tgl_persetujuan">
<input type="text" data-table="permintaanpembelian" data-field="x_tgl_persetujuan" name="x_tgl_persetujuan" id="x_tgl_persetujuan" maxlength="10" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->tgl_persetujuan->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->tgl_persetujuan->EditValue ?>"<?php echo $permintaanpembelian_add->tgl_persetujuan->editAttributes() ?>>
<?php if (!$permintaanpembelian_add->tgl_persetujuan->ReadOnly && !$permintaanpembelian_add->tgl_persetujuan->Disabled && !isset($permintaanpembelian_add->tgl_persetujuan->EditAttrs["readonly"]) && !isset($permintaanpembelian_add->tgl_persetujuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpermintaanpembelianadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpermintaanpembelianadd", "x_tgl_persetujuan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $permintaanpembelian_add->tgl_persetujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->staf_pengajuan->Visible) { // staf_pengajuan ?>
	<div id="r_staf_pengajuan" class="form-group row">
		<label id="elh_permintaanpembelian_staf_pengajuan" for="x_staf_pengajuan" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->staf_pengajuan->caption() ?><?php echo $permintaanpembelian_add->staf_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->staf_pengajuan->cellAttributes() ?>>
<span id="el_permintaanpembelian_staf_pengajuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="permintaanpembelian" data-field="x_staf_pengajuan" data-value-separator="<?php echo $permintaanpembelian_add->staf_pengajuan->displayValueSeparatorAttribute() ?>" id="x_staf_pengajuan" name="x_staf_pengajuan"<?php echo $permintaanpembelian_add->staf_pengajuan->editAttributes() ?>>
			<?php echo $permintaanpembelian_add->staf_pengajuan->selectOptionListHtml("x_staf_pengajuan") ?>
		</select>
</div>
<?php echo $permintaanpembelian_add->staf_pengajuan->Lookup->getParamTag($permintaanpembelian_add, "p_x_staf_pengajuan") ?>
</span>
<?php echo $permintaanpembelian_add->staf_pengajuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->staf_validasi->Visible) { // staf_validasi ?>
	<div id="r_staf_validasi" class="form-group row">
		<label id="elh_permintaanpembelian_staf_validasi" for="x_staf_validasi" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->staf_validasi->caption() ?><?php echo $permintaanpembelian_add->staf_validasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->staf_validasi->cellAttributes() ?>>
<span id="el_permintaanpembelian_staf_validasi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="permintaanpembelian" data-field="x_staf_validasi" data-value-separator="<?php echo $permintaanpembelian_add->staf_validasi->displayValueSeparatorAttribute() ?>" id="x_staf_validasi" name="x_staf_validasi"<?php echo $permintaanpembelian_add->staf_validasi->editAttributes() ?>>
			<?php echo $permintaanpembelian_add->staf_validasi->selectOptionListHtml("x_staf_validasi") ?>
		</select>
</div>
<?php echo $permintaanpembelian_add->staf_validasi->Lookup->getParamTag($permintaanpembelian_add, "p_x_staf_validasi") ?>
</span>
<?php echo $permintaanpembelian_add->staf_validasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->id_suplier->Visible) { // id_suplier ?>
	<div id="r_id_suplier" class="form-group row">
		<label id="elh_permintaanpembelian_id_suplier" for="x_id_suplier" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->id_suplier->caption() ?><?php echo $permintaanpembelian_add->id_suplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->id_suplier->cellAttributes() ?>>
<span id="el_permintaanpembelian_id_suplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="permintaanpembelian" data-field="x_id_suplier" data-value-separator="<?php echo $permintaanpembelian_add->id_suplier->displayValueSeparatorAttribute() ?>" id="x_id_suplier" name="x_id_suplier"<?php echo $permintaanpembelian_add->id_suplier->editAttributes() ?>>
			<?php echo $permintaanpembelian_add->id_suplier->selectOptionListHtml("x_id_suplier") ?>
		</select>
</div>
<?php echo $permintaanpembelian_add->id_suplier->Lookup->getParamTag($permintaanpembelian_add, "p_x_id_suplier") ?>
</span>
<?php echo $permintaanpembelian_add->id_suplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->idklinik->Visible) { // idklinik ?>
	<div id="r_idklinik" class="form-group row">
		<label id="elh_permintaanpembelian_idklinik" for="x_idklinik" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->idklinik->caption() ?><?php echo $permintaanpembelian_add->idklinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->idklinik->cellAttributes() ?>>
<span id="el_permintaanpembelian_idklinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="permintaanpembelian" data-field="x_idklinik" data-value-separator="<?php echo $permintaanpembelian_add->idklinik->displayValueSeparatorAttribute() ?>" id="x_idklinik" name="x_idklinik"<?php echo $permintaanpembelian_add->idklinik->editAttributes() ?>>
			<?php echo $permintaanpembelian_add->idklinik->selectOptionListHtml("x_idklinik") ?>
		</select>
</div>
<?php echo $permintaanpembelian_add->idklinik->Lookup->getParamTag($permintaanpembelian_add, "p_x_idklinik") ?>
</span>
<?php echo $permintaanpembelian_add->idklinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->validasi->Visible) { // validasi ?>
	<div id="r_validasi" class="form-group row">
		<label id="elh_permintaanpembelian_validasi" for="x_validasi" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->validasi->caption() ?><?php echo $permintaanpembelian_add->validasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->validasi->cellAttributes() ?>>
<span id="el_permintaanpembelian_validasi">
<input type="text" data-table="permintaanpembelian" data-field="x_validasi" name="x_validasi" id="x_validasi" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->validasi->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->validasi->EditValue ?>"<?php echo $permintaanpembelian_add->validasi->editAttributes() ?>>
</span>
<?php echo $permintaanpembelian_add->validasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_permintaanpembelian_status" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->status->caption() ?><?php echo $permintaanpembelian_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->status->cellAttributes() ?>>
<span id="el_permintaanpembelian_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="permintaanpembelian" data-field="x_status" data-value-separator="<?php echo $permintaanpembelian_add->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $permintaanpembelian_add->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $permintaanpembelian_add->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $permintaanpembelian_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->email_pusat->Visible) { // email_pusat ?>
	<div id="r_email_pusat" class="form-group row">
		<label id="elh_permintaanpembelian_email_pusat" for="x_email_pusat" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->email_pusat->caption() ?><?php echo $permintaanpembelian_add->email_pusat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->email_pusat->cellAttributes() ?>>
<span id="el_permintaanpembelian_email_pusat">
<input type="text" data-table="permintaanpembelian" data-field="x_email_pusat" name="x_email_pusat" id="x_email_pusat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->email_pusat->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->email_pusat->EditValue ?>"<?php echo $permintaanpembelian_add->email_pusat->editAttributes() ?>>
</span>
<?php echo $permintaanpembelian_add->email_pusat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($permintaanpembelian_add->email_cabang->Visible) { // email_cabang ?>
	<div id="r_email_cabang" class="form-group row">
		<label id="elh_permintaanpembelian_email_cabang" for="x_email_cabang" class="<?php echo $permintaanpembelian_add->LeftColumnClass ?>"><?php echo $permintaanpembelian_add->email_cabang->caption() ?><?php echo $permintaanpembelian_add->email_cabang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $permintaanpembelian_add->RightColumnClass ?>"><div <?php echo $permintaanpembelian_add->email_cabang->cellAttributes() ?>>
<span id="el_permintaanpembelian_email_cabang">
<input type="text" data-table="permintaanpembelian" data-field="x_email_cabang" name="x_email_cabang" id="x_email_cabang" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($permintaanpembelian_add->email_cabang->getPlaceHolder()) ?>" value="<?php echo $permintaanpembelian_add->email_cabang->EditValue ?>"<?php echo $permintaanpembelian_add->email_cabang->editAttributes() ?>>
</span>
<?php echo $permintaanpembelian_add->email_cabang->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailmintapembelian", explode(",", $permintaanpembelian->getCurrentDetailTable())) && $detailmintapembelian->DetailAdd) {
?>
<?php if ($permintaanpembelian->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailmintapembelian", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailmintapembeliangrid.php" ?>
<?php } ?>
<?php if (!$permintaanpembelian_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $permintaanpembelian_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $permintaanpembelian_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$permintaanpembelian_add->showPageFooter();
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
$permintaanpembelian_add->terminate();
?>