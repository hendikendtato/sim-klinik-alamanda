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
$m_pelanggan_add = new m_pelanggan_add();

// Run the page
$m_pelanggan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pelanggan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_pelangganadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_pelangganadd = currentForm = new ew.Form("fm_pelangganadd", "add");

	// Validate form
	fm_pelangganadd.validate = function() {
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
			<?php if ($m_pelanggan_add->noktp_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_noktp_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->noktp_pelanggan->caption(), $m_pelanggan_add->noktp_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->nama_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->nama_pelanggan->caption(), $m_pelanggan_add->nama_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->jenis_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->jenis_pelanggan->caption(), $m_pelanggan_add->jenis_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->tgllahir_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_tgllahir_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->tgllahir_pelanggan->caption(), $m_pelanggan_add->tgllahir_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgllahir_pelanggan");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_pelanggan_add->tgllahir_pelanggan->errorMessage()) ?>");
			<?php if ($m_pelanggan_add->pekerjaan_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_pekerjaan_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->pekerjaan_pelanggan->caption(), $m_pelanggan_add->pekerjaan_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->kota_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_kota_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->kota_pelanggan->caption(), $m_pelanggan_add->kota_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->alamat_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->alamat_pelanggan->caption(), $m_pelanggan_add->alamat_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->telpon_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_telpon_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->telpon_pelanggan->caption(), $m_pelanggan_add->telpon_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->hp_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_hp_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->hp_pelanggan->caption(), $m_pelanggan_add->hp_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->id_klinik->caption(), $m_pelanggan_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->tgl_daftar->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->tgl_daftar->caption(), $m_pelanggan_add->tgl_daftar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_daftar");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_pelanggan_add->tgl_daftar->errorMessage()) ?>");
			<?php if ($m_pelanggan_add->kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->kategori->caption(), $m_pelanggan_add->kategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_pelanggan_add->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_pelanggan_add->tipe->caption(), $m_pelanggan_add->tipe->RequiredErrorMessage)) ?>");
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
	fm_pelangganadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_pelangganadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_pelangganadd.lists["x_jenis_pelanggan"] = <?php echo $m_pelanggan_add->jenis_pelanggan->Lookup->toClientList($m_pelanggan_add) ?>;
	fm_pelangganadd.lists["x_jenis_pelanggan"].options = <?php echo JsonEncode($m_pelanggan_add->jenis_pelanggan->options(FALSE, TRUE)) ?>;
	fm_pelangganadd.lists["x_pekerjaan_pelanggan"] = <?php echo $m_pelanggan_add->pekerjaan_pelanggan->Lookup->toClientList($m_pelanggan_add) ?>;
	fm_pelangganadd.lists["x_pekerjaan_pelanggan"].options = <?php echo JsonEncode($m_pelanggan_add->pekerjaan_pelanggan->lookupOptions()) ?>;
	fm_pelangganadd.lists["x_kota_pelanggan"] = <?php echo $m_pelanggan_add->kota_pelanggan->Lookup->toClientList($m_pelanggan_add) ?>;
	fm_pelangganadd.lists["x_kota_pelanggan"].options = <?php echo JsonEncode($m_pelanggan_add->kota_pelanggan->lookupOptions()) ?>;
	fm_pelangganadd.lists["x_id_klinik"] = <?php echo $m_pelanggan_add->id_klinik->Lookup->toClientList($m_pelanggan_add) ?>;
	fm_pelangganadd.lists["x_id_klinik"].options = <?php echo JsonEncode($m_pelanggan_add->id_klinik->lookupOptions()) ?>;
	fm_pelangganadd.lists["x_kategori"] = <?php echo $m_pelanggan_add->kategori->Lookup->toClientList($m_pelanggan_add) ?>;
	fm_pelangganadd.lists["x_kategori"].options = <?php echo JsonEncode($m_pelanggan_add->kategori->lookupOptions()) ?>;
	fm_pelangganadd.lists["x_tipe"] = <?php echo $m_pelanggan_add->tipe->Lookup->toClientList($m_pelanggan_add) ?>;
	fm_pelangganadd.lists["x_tipe"].options = <?php echo JsonEncode($m_pelanggan_add->tipe->lookupOptions()) ?>;
	loadjs.done("fm_pelangganadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	var now=new Date,day=("0"+now.getDate()).slice(-2),month=("0"+(now.getMonth()+1)).slice(-2),today=day+"/"+month+"/"+now.getFullYear();$("input#x_tgl_daftar").val(today),$("input#x_tgl_daftar").prop("disabled",!0),$("select#x_kategori").prop("disabled",!0),$("select#x_tipe").prop("disabled",!0);
});
</script>
<?php $m_pelanggan_add->showPageHeader(); ?>
<?php
$m_pelanggan_add->showMessage();
?>
<form name="fm_pelangganadd" id="fm_pelangganadd" class="<?php echo $m_pelanggan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pelanggan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_pelanggan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_pelanggan_add->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
	<div id="r_noktp_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_noktp_pelanggan" for="x_noktp_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->noktp_pelanggan->caption() ?><?php echo $m_pelanggan_add->noktp_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->noktp_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_noktp_pelanggan">
<input type="text" data-table="m_pelanggan" data-field="x_noktp_pelanggan" name="x_noktp_pelanggan" id="x_noktp_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_add->noktp_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->noktp_pelanggan->EditValue ?>"<?php echo $m_pelanggan_add->noktp_pelanggan->editAttributes() ?>>
</span>
<?php echo $m_pelanggan_add->noktp_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<div id="r_nama_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_nama_pelanggan" for="x_nama_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->nama_pelanggan->caption() ?><?php echo $m_pelanggan_add->nama_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->nama_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_nama_pelanggan">
<input type="text" data-table="m_pelanggan" data-field="x_nama_pelanggan" name="x_nama_pelanggan" id="x_nama_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_add->nama_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->nama_pelanggan->EditValue ?>"<?php echo $m_pelanggan_add->nama_pelanggan->editAttributes() ?>>
</span>
<?php echo $m_pelanggan_add->nama_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
	<div id="r_jenis_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_jenis_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->jenis_pelanggan->caption() ?><?php echo $m_pelanggan_add->jenis_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->jenis_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_jenis_pelanggan">
<div id="tp_x_jenis_pelanggan" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pelanggan" data-field="x_jenis_pelanggan" data-value-separator="<?php echo $m_pelanggan_add->jenis_pelanggan->displayValueSeparatorAttribute() ?>" name="x_jenis_pelanggan" id="x_jenis_pelanggan" value="{value}"<?php echo $m_pelanggan_add->jenis_pelanggan->editAttributes() ?>></div>
<div id="dsl_x_jenis_pelanggan" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pelanggan_add->jenis_pelanggan->radioButtonListHtml(FALSE, "x_jenis_pelanggan") ?>
</div></div>
</span>
<?php echo $m_pelanggan_add->jenis_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->tgllahir_pelanggan->Visible) { // tgllahir_pelanggan ?>
	<div id="r_tgllahir_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_tgllahir_pelanggan" for="x_tgllahir_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->tgllahir_pelanggan->caption() ?><?php echo $m_pelanggan_add->tgllahir_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->tgllahir_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_tgllahir_pelanggan">
<input type="text" data-table="m_pelanggan" data-field="x_tgllahir_pelanggan" name="x_tgllahir_pelanggan" id="x_tgllahir_pelanggan" maxlength="10" placeholder="<?php echo HtmlEncode($m_pelanggan_add->tgllahir_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->tgllahir_pelanggan->EditValue ?>"<?php echo $m_pelanggan_add->tgllahir_pelanggan->editAttributes() ?>>
<?php if (!$m_pelanggan_add->tgllahir_pelanggan->ReadOnly && !$m_pelanggan_add->tgllahir_pelanggan->Disabled && !isset($m_pelanggan_add->tgllahir_pelanggan->EditAttrs["readonly"]) && !isset($m_pelanggan_add->tgllahir_pelanggan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_pelangganadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_pelangganadd", "x_tgllahir_pelanggan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_pelanggan_add->tgllahir_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->pekerjaan_pelanggan->Visible) { // pekerjaan_pelanggan ?>
	<div id="r_pekerjaan_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_pekerjaan_pelanggan" for="x_pekerjaan_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->pekerjaan_pelanggan->caption() ?><?php echo $m_pelanggan_add->pekerjaan_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->pekerjaan_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_pekerjaan_pelanggan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_pekerjaan_pelanggan" data-value-separator="<?php echo $m_pelanggan_add->pekerjaan_pelanggan->displayValueSeparatorAttribute() ?>" id="x_pekerjaan_pelanggan" name="x_pekerjaan_pelanggan"<?php echo $m_pelanggan_add->pekerjaan_pelanggan->editAttributes() ?>>
			<?php echo $m_pelanggan_add->pekerjaan_pelanggan->selectOptionListHtml("x_pekerjaan_pelanggan") ?>
		</select>
</div>
<?php echo $m_pelanggan_add->pekerjaan_pelanggan->Lookup->getParamTag($m_pelanggan_add, "p_x_pekerjaan_pelanggan") ?>
</span>
<?php echo $m_pelanggan_add->pekerjaan_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->kota_pelanggan->Visible) { // kota_pelanggan ?>
	<div id="r_kota_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_kota_pelanggan" for="x_kota_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->kota_pelanggan->caption() ?><?php echo $m_pelanggan_add->kota_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->kota_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_kota_pelanggan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_kota_pelanggan" data-value-separator="<?php echo $m_pelanggan_add->kota_pelanggan->displayValueSeparatorAttribute() ?>" id="x_kota_pelanggan" name="x_kota_pelanggan"<?php echo $m_pelanggan_add->kota_pelanggan->editAttributes() ?>>
			<?php echo $m_pelanggan_add->kota_pelanggan->selectOptionListHtml("x_kota_pelanggan") ?>
		</select>
</div>
<?php echo $m_pelanggan_add->kota_pelanggan->Lookup->getParamTag($m_pelanggan_add, "p_x_kota_pelanggan") ?>
</span>
<?php echo $m_pelanggan_add->kota_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
	<div id="r_alamat_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_alamat_pelanggan" for="x_alamat_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->alamat_pelanggan->caption() ?><?php echo $m_pelanggan_add->alamat_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->alamat_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_alamat_pelanggan">
<input type="text" data-table="m_pelanggan" data-field="x_alamat_pelanggan" name="x_alamat_pelanggan" id="x_alamat_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_add->alamat_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->alamat_pelanggan->EditValue ?>"<?php echo $m_pelanggan_add->alamat_pelanggan->editAttributes() ?>>
</span>
<?php echo $m_pelanggan_add->alamat_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
	<div id="r_telpon_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_telpon_pelanggan" for="x_telpon_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->telpon_pelanggan->caption() ?><?php echo $m_pelanggan_add->telpon_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->telpon_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_telpon_pelanggan">
<input type="text" data-table="m_pelanggan" data-field="x_telpon_pelanggan" name="x_telpon_pelanggan" id="x_telpon_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_add->telpon_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->telpon_pelanggan->EditValue ?>"<?php echo $m_pelanggan_add->telpon_pelanggan->editAttributes() ?>>
</span>
<?php echo $m_pelanggan_add->telpon_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->hp_pelanggan->Visible) { // hp_pelanggan ?>
	<div id="r_hp_pelanggan" class="form-group row">
		<label id="elh_m_pelanggan_hp_pelanggan" for="x_hp_pelanggan" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->hp_pelanggan->caption() ?><?php echo $m_pelanggan_add->hp_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->hp_pelanggan->cellAttributes() ?>>
<span id="el_m_pelanggan_hp_pelanggan">
<input type="text" data-table="m_pelanggan" data-field="x_hp_pelanggan" name="x_hp_pelanggan" id="x_hp_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_add->hp_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->hp_pelanggan->EditValue ?>"<?php echo $m_pelanggan_add->hp_pelanggan->editAttributes() ?>>
</span>
<?php echo $m_pelanggan_add->hp_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_pelanggan_id_klinik" for="x_id_klinik" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->id_klinik->caption() ?><?php echo $m_pelanggan_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->id_klinik->cellAttributes() ?>>
<span id="el_m_pelanggan_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_id_klinik" data-value-separator="<?php echo $m_pelanggan_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_pelanggan_add->id_klinik->editAttributes() ?>>
			<?php echo $m_pelanggan_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_pelanggan_add->id_klinik->Lookup->getParamTag($m_pelanggan_add, "p_x_id_klinik") ?>
</span>
<?php echo $m_pelanggan_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->tgl_daftar->Visible) { // tgl_daftar ?>
	<div id="r_tgl_daftar" class="form-group row">
		<label id="elh_m_pelanggan_tgl_daftar" for="x_tgl_daftar" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->tgl_daftar->caption() ?><?php echo $m_pelanggan_add->tgl_daftar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->tgl_daftar->cellAttributes() ?>>
<span id="el_m_pelanggan_tgl_daftar">
<input type="text" data-table="m_pelanggan" data-field="x_tgl_daftar" data-format="7" name="x_tgl_daftar" id="x_tgl_daftar" maxlength="19" placeholder="<?php echo HtmlEncode($m_pelanggan_add->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_add->tgl_daftar->EditValue ?>"<?php echo $m_pelanggan_add->tgl_daftar->editAttributes() ?>>
<?php if (!$m_pelanggan_add->tgl_daftar->ReadOnly && !$m_pelanggan_add->tgl_daftar->Disabled && !isset($m_pelanggan_add->tgl_daftar->EditAttrs["readonly"]) && !isset($m_pelanggan_add->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_pelangganadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_pelangganadd", "x_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $m_pelanggan_add->tgl_daftar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label id="elh_m_pelanggan_kategori" for="x_kategori" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->kategori->caption() ?><?php echo $m_pelanggan_add->kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->kategori->cellAttributes() ?>>
<span id="el_m_pelanggan_kategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_kategori" data-value-separator="<?php echo $m_pelanggan_add->kategori->displayValueSeparatorAttribute() ?>" id="x_kategori" name="x_kategori"<?php echo $m_pelanggan_add->kategori->editAttributes() ?>>
			<?php echo $m_pelanggan_add->kategori->selectOptionListHtml("x_kategori") ?>
		</select>
</div>
<?php echo $m_pelanggan_add->kategori->Lookup->getParamTag($m_pelanggan_add, "p_x_kategori") ?>
</span>
<?php echo $m_pelanggan_add->kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_add->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_m_pelanggan_tipe" for="x_tipe" class="<?php echo $m_pelanggan_add->LeftColumnClass ?>"><?php echo $m_pelanggan_add->tipe->caption() ?><?php echo $m_pelanggan_add->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_pelanggan_add->RightColumnClass ?>"><div <?php echo $m_pelanggan_add->tipe->cellAttributes() ?>>
<span id="el_m_pelanggan_tipe">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_tipe" data-value-separator="<?php echo $m_pelanggan_add->tipe->displayValueSeparatorAttribute() ?>" id="x_tipe" name="x_tipe"<?php echo $m_pelanggan_add->tipe->editAttributes() ?>>
			<?php echo $m_pelanggan_add->tipe->selectOptionListHtml("x_tipe") ?>
		</select>
</div>
<?php echo $m_pelanggan_add->tipe->Lookup->getParamTag($m_pelanggan_add, "p_x_tipe") ?>
</span>
<?php echo $m_pelanggan_add->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_pelanggan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_pelanggan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_pelanggan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_pelanggan_add->showPageFooter();
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
$m_pelanggan_add->terminate();
?>