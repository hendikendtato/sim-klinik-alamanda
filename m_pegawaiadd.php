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
$m_pegawai_add = new m_pegawai_add();

// Run the page
$m_pegawai_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pegawai_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_pegawaiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_pegawaiadd = currentForm = new ew.Form("fm_pegawaiadd", "add");

	// Validate form
	fm_pegawaiadd.validate = function() {
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
			<?php if ($m_pegawai_add->nama_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->nama_pegawai->caption(), $m_pegawai_add->nama_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->nama_lengkap->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_lengkap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->nama_lengkap->caption(), $m_pegawai_add->nama_lengkap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->jenis_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->jenis_pegawai->caption(), $m_pegawai_add->jenis_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->nik_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_nik_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->nik_pegawai->caption(), $m_pegawai_add->nik_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->agama_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_agama_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->agama_pegawai->caption(), $m_pegawai_add->agama_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->tgllahir_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_tgllahir_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->tgllahir_pegawai->caption(), $m_pegawai_add->tgllahir_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgllahir_pegawai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_pegawai_add->tgllahir_pegawai->errorMessage()) ?>");
			<?php if ($m_pegawai_add->alamat_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->alamat_pegawai->caption(), $m_pegawai_add->alamat_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->hp_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_hp_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->hp_pegawai->caption(), $m_pegawai_add->hp_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->pendidikan_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pendidikan_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->pendidikan_pegawai->caption(), $m_pegawai_add->pendidikan_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->jurusan_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_jurusan_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->jurusan_pegawai->caption(), $m_pegawai_add->jurusan_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->spesialis_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_spesialis_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->spesialis_pegawai->caption(), $m_pegawai_add->spesialis_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->jabatan_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->jabatan_pegawai->caption(), $m_pegawai_add->jabatan_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->status_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_status_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->status_pegawai->caption(), $m_pegawai_add->status_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->tarif_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_tarif_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->tarif_pegawai->caption(), $m_pegawai_add->tarif_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tarif_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_pegawai_add->tarif_pegawai->errorMessage()) ?>");
			<?php if ($m_pegawai_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->id_klinik->caption(), $m_pegawai_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pegawai_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pegawai_add->status->caption(), $m_pegawai_add->status->RequiredErrorMessage)) ?>");
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
	fm_pegawaiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_pegawaiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_pegawaiadd.lists["x_jenis_pegawai"] = <?php echo $m_pegawai_add->jenis_pegawai->Lookup->toClientList($m_pegawai_add) ?>;
	fm_pegawaiadd.lists["x_jenis_pegawai"].options = <?php echo JsonEncode($m_pegawai_add->jenis_pegawai->options(FALSE, TRUE)) ?>;
	fm_pegawaiadd.lists["x_agama_pegawai"] = <?php echo $m_pegawai_add->agama_pegawai->Lookup->toClientList($m_pegawai_add) ?>;
	fm_pegawaiadd.lists["x_agama_pegawai"].options = <?php echo JsonEncode($m_pegawai_add->agama_pegawai->lookupOptions()) ?>;
	fm_pegawaiadd.lists["x_jabatan_pegawai"] = <?php echo $m_pegawai_add->jabatan_pegawai->Lookup->toClientList($m_pegawai_add) ?>;
	fm_pegawaiadd.lists["x_jabatan_pegawai"].options = <?php echo JsonEncode($m_pegawai_add->jabatan_pegawai->lookupOptions()) ?>;
	fm_pegawaiadd.lists["x_status_pegawai"] = <?php echo $m_pegawai_add->status_pegawai->Lookup->toClientList($m_pegawai_add) ?>;
	fm_pegawaiadd.lists["x_status_pegawai"].options = <?php echo JsonEncode($m_pegawai_add->status_pegawai->options(FALSE, TRUE)) ?>;
	fm_pegawaiadd.lists["x_id_klinik"] = <?php echo $m_pegawai_add->id_klinik->Lookup->toClientList($m_pegawai_add) ?>;
	fm_pegawaiadd.lists["x_id_klinik"].options = <?php echo JsonEncode($m_pegawai_add->id_klinik->lookupOptions()) ?>;
	fm_pegawaiadd.lists["x_status"] = <?php echo $m_pegawai_add->status->Lookup->toClientList($m_pegawai_add) ?>;
	fm_pegawaiadd.lists["x_status"].options = <?php echo JsonEncode($m_pegawai_add->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_pegawaiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_pegawai_add->showPageHeader(); ?>
<?php
$m_pegawai_add->showMessage();
?>
<form name="fm_pegawaiadd" id="fm_pegawaiadd" class="<?php echo $m_pegawai_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pegawai">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_pegawai_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_pegawai_add->nama_pegawai->Visible) { // nama_pegawai ?>
	<div id="r_nama_pegawai" class="form-group row">
		<label id="elh_m_pegawai_nama_pegawai" for="x_nama_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->nama_pegawai->caption() ?><?php echo $m_pegawai_add->nama_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->nama_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_nama_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_nama_pegawai" name="x_nama_pegawai" id="x_nama_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_add->nama_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->nama_pegawai->EditValue ?>"<?php echo $m_pegawai_add->nama_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->nama_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->nama_lengkap->Visible) { // nama_lengkap ?>
	<div id="r_nama_lengkap" class="form-group row">
		<label id="elh_m_pegawai_nama_lengkap" for="x_nama_lengkap" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->nama_lengkap->caption() ?><?php echo $m_pegawai_add->nama_lengkap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->nama_lengkap->cellAttributes() ?>>
<span id="el_m_pegawai_nama_lengkap">
<input type="text" data-table="m_pegawai" data-field="x_nama_lengkap" name="x_nama_lengkap" id="x_nama_lengkap" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_add->nama_lengkap->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->nama_lengkap->EditValue ?>"<?php echo $m_pegawai_add->nama_lengkap->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->nama_lengkap->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->jenis_pegawai->Visible) { // jenis_pegawai ?>
	<div id="r_jenis_pegawai" class="form-group row">
		<label id="elh_m_pegawai_jenis_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->jenis_pegawai->caption() ?><?php echo $m_pegawai_add->jenis_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->jenis_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_jenis_pegawai">
<div id="tp_x_jenis_pegawai" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pegawai" data-field="x_jenis_pegawai" data-value-separator="<?php echo $m_pegawai_add->jenis_pegawai->displayValueSeparatorAttribute() ?>" name="x_jenis_pegawai" id="x_jenis_pegawai" value="{value}"<?php echo $m_pegawai_add->jenis_pegawai->editAttributes() ?>></div>
<div id="dsl_x_jenis_pegawai" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pegawai_add->jenis_pegawai->radioButtonListHtml(FALSE, "x_jenis_pegawai") ?>
</div></div>
</span>
<?php echo $m_pegawai_add->jenis_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->nik_pegawai->Visible) { // nik_pegawai ?>
	<div id="r_nik_pegawai" class="form-group row">
		<label id="elh_m_pegawai_nik_pegawai" for="x_nik_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->nik_pegawai->caption() ?><?php echo $m_pegawai_add->nik_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->nik_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_nik_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_nik_pegawai" name="x_nik_pegawai" id="x_nik_pegawai" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_pegawai_add->nik_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->nik_pegawai->EditValue ?>"<?php echo $m_pegawai_add->nik_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->nik_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->agama_pegawai->Visible) { // agama_pegawai ?>
	<div id="r_agama_pegawai" class="form-group row">
		<label id="elh_m_pegawai_agama_pegawai" for="x_agama_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->agama_pegawai->caption() ?><?php echo $m_pegawai_add->agama_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->agama_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_agama_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pegawai" data-field="x_agama_pegawai" data-value-separator="<?php echo $m_pegawai_add->agama_pegawai->displayValueSeparatorAttribute() ?>" id="x_agama_pegawai" name="x_agama_pegawai"<?php echo $m_pegawai_add->agama_pegawai->editAttributes() ?>>
			<?php echo $m_pegawai_add->agama_pegawai->selectOptionListHtml("x_agama_pegawai") ?>
		</select>
</div>
<?php echo $m_pegawai_add->agama_pegawai->Lookup->getParamTag($m_pegawai_add, "p_x_agama_pegawai") ?>
</span>
<?php echo $m_pegawai_add->agama_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->tgllahir_pegawai->Visible) { // tgllahir_pegawai ?>
	<div id="r_tgllahir_pegawai" class="form-group row">
		<label id="elh_m_pegawai_tgllahir_pegawai" for="x_tgllahir_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->tgllahir_pegawai->caption() ?><?php echo $m_pegawai_add->tgllahir_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->tgllahir_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_tgllahir_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_tgllahir_pegawai" name="x_tgllahir_pegawai" id="x_tgllahir_pegawai" maxlength="10" placeholder="<?php echo HtmlEncode($m_pegawai_add->tgllahir_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->tgllahir_pegawai->EditValue ?>"<?php echo $m_pegawai_add->tgllahir_pegawai->editAttributes() ?>>
<?php if (!$m_pegawai_add->tgllahir_pegawai->ReadOnly && !$m_pegawai_add->tgllahir_pegawai->Disabled && !isset($m_pegawai_add->tgllahir_pegawai->EditAttrs["readonly"]) && !isset($m_pegawai_add->tgllahir_pegawai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_pegawaiadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_pegawaiadd", "x_tgllahir_pegawai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_pegawai_add->tgllahir_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->alamat_pegawai->Visible) { // alamat_pegawai ?>
	<div id="r_alamat_pegawai" class="form-group row">
		<label id="elh_m_pegawai_alamat_pegawai" for="x_alamat_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->alamat_pegawai->caption() ?><?php echo $m_pegawai_add->alamat_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->alamat_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_alamat_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_alamat_pegawai" name="x_alamat_pegawai" id="x_alamat_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_add->alamat_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->alamat_pegawai->EditValue ?>"<?php echo $m_pegawai_add->alamat_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->alamat_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->hp_pegawai->Visible) { // hp_pegawai ?>
	<div id="r_hp_pegawai" class="form-group row">
		<label id="elh_m_pegawai_hp_pegawai" for="x_hp_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->hp_pegawai->caption() ?><?php echo $m_pegawai_add->hp_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->hp_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_hp_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_hp_pegawai" name="x_hp_pegawai" id="x_hp_pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_pegawai_add->hp_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->hp_pegawai->EditValue ?>"<?php echo $m_pegawai_add->hp_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->hp_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->pendidikan_pegawai->Visible) { // pendidikan_pegawai ?>
	<div id="r_pendidikan_pegawai" class="form-group row">
		<label id="elh_m_pegawai_pendidikan_pegawai" for="x_pendidikan_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->pendidikan_pegawai->caption() ?><?php echo $m_pegawai_add->pendidikan_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->pendidikan_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_pendidikan_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_pendidikan_pegawai" name="x_pendidikan_pegawai" id="x_pendidikan_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_add->pendidikan_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->pendidikan_pegawai->EditValue ?>"<?php echo $m_pegawai_add->pendidikan_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->pendidikan_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->jurusan_pegawai->Visible) { // jurusan_pegawai ?>
	<div id="r_jurusan_pegawai" class="form-group row">
		<label id="elh_m_pegawai_jurusan_pegawai" for="x_jurusan_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->jurusan_pegawai->caption() ?><?php echo $m_pegawai_add->jurusan_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->jurusan_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_jurusan_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_jurusan_pegawai" name="x_jurusan_pegawai" id="x_jurusan_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_add->jurusan_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->jurusan_pegawai->EditValue ?>"<?php echo $m_pegawai_add->jurusan_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->jurusan_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
	<div id="r_spesialis_pegawai" class="form-group row">
		<label id="elh_m_pegawai_spesialis_pegawai" for="x_spesialis_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->spesialis_pegawai->caption() ?><?php echo $m_pegawai_add->spesialis_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->spesialis_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_spesialis_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_spesialis_pegawai" name="x_spesialis_pegawai" id="x_spesialis_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_add->spesialis_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->spesialis_pegawai->EditValue ?>"<?php echo $m_pegawai_add->spesialis_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->spesialis_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
	<div id="r_jabatan_pegawai" class="form-group row">
		<label id="elh_m_pegawai_jabatan_pegawai" for="x_jabatan_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->jabatan_pegawai->caption() ?><?php echo $m_pegawai_add->jabatan_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->jabatan_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_jabatan_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pegawai" data-field="x_jabatan_pegawai" data-value-separator="<?php echo $m_pegawai_add->jabatan_pegawai->displayValueSeparatorAttribute() ?>" id="x_jabatan_pegawai" name="x_jabatan_pegawai"<?php echo $m_pegawai_add->jabatan_pegawai->editAttributes() ?>>
			<?php echo $m_pegawai_add->jabatan_pegawai->selectOptionListHtml("x_jabatan_pegawai") ?>
		</select>
</div>
<?php echo $m_pegawai_add->jabatan_pegawai->Lookup->getParamTag($m_pegawai_add, "p_x_jabatan_pegawai") ?>
</span>
<?php echo $m_pegawai_add->jabatan_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->status_pegawai->Visible) { // status_pegawai ?>
	<div id="r_status_pegawai" class="form-group row">
		<label id="elh_m_pegawai_status_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->status_pegawai->caption() ?><?php echo $m_pegawai_add->status_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->status_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_status_pegawai">
<div id="tp_x_status_pegawai" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pegawai" data-field="x_status_pegawai" data-value-separator="<?php echo $m_pegawai_add->status_pegawai->displayValueSeparatorAttribute() ?>" name="x_status_pegawai" id="x_status_pegawai" value="{value}"<?php echo $m_pegawai_add->status_pegawai->editAttributes() ?>></div>
<div id="dsl_x_status_pegawai" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pegawai_add->status_pegawai->radioButtonListHtml(FALSE, "x_status_pegawai") ?>
</div></div>
</span>
<?php echo $m_pegawai_add->status_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->tarif_pegawai->Visible) { // tarif_pegawai ?>
	<div id="r_tarif_pegawai" class="form-group row">
		<label id="elh_m_pegawai_tarif_pegawai" for="x_tarif_pegawai" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->tarif_pegawai->caption() ?><?php echo $m_pegawai_add->tarif_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->tarif_pegawai->cellAttributes() ?>>
<span id="el_m_pegawai_tarif_pegawai">
<input type="text" data-table="m_pegawai" data-field="x_tarif_pegawai" name="x_tarif_pegawai" id="x_tarif_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_pegawai_add->tarif_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_add->tarif_pegawai->EditValue ?>"<?php echo $m_pegawai_add->tarif_pegawai->editAttributes() ?>>
</span>
<?php echo $m_pegawai_add->tarif_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_pegawai_id_klinik" for="x_id_klinik" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->id_klinik->caption() ?><?php echo $m_pegawai_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->id_klinik->cellAttributes() ?>>
<span id="el_m_pegawai_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pegawai" data-field="x_id_klinik" data-value-separator="<?php echo $m_pegawai_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_pegawai_add->id_klinik->editAttributes() ?>>
			<?php echo $m_pegawai_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_pegawai_add->id_klinik->Lookup->getParamTag($m_pegawai_add, "p_x_id_klinik") ?>
</span>
<?php echo $m_pegawai_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_m_pegawai_status" class="<?php echo $m_pegawai_add->LeftColumnClass ?>"><?php echo $m_pegawai_add->status->caption() ?><?php echo $m_pegawai_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pegawai_add->RightColumnClass ?>"><div <?php echo $m_pegawai_add->status->cellAttributes() ?>>
<span id="el_m_pegawai_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pegawai" data-field="x_status" data-value-separator="<?php echo $m_pegawai_add->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $m_pegawai_add->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pegawai_add->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $m_pegawai_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_pegawai_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_pegawai_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_pegawai_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_pegawai_add->showPageFooter();
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
$m_pegawai_add->terminate();
?>