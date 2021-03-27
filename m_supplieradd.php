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
$m_supplier_add = new m_supplier_add();

// Run the page
$m_supplier_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_supplier_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_supplieradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_supplieradd = currentForm = new ew.Form("fm_supplieradd", "add");

	// Validate form
	fm_supplieradd.validate = function() {
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
			<?php if ($m_supplier_add->kode_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->kode_supplier->caption(), $m_supplier_add->kode_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->nama_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->nama_supplier->caption(), $m_supplier_add->nama_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->pic_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_pic_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->pic_supplier->caption(), $m_supplier_add->pic_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->alamat_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->alamat_supplier->caption(), $m_supplier_add->alamat_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->kelurahan_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_kelurahan_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->kelurahan_supplier->caption(), $m_supplier_add->kelurahan_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->kecamatan_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_kecamatan_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->kecamatan_supplier->caption(), $m_supplier_add->kecamatan_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->kota_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_kota_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->kota_supplier->caption(), $m_supplier_add->kota_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->kodepos_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_kodepos_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->kodepos_supplier->caption(), $m_supplier_add->kodepos_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->telpon_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_telpon_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->telpon_supplier->caption(), $m_supplier_add->telpon_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->hp_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_hp_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->hp_supplier->caption(), $m_supplier_add->hp_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->email_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_email_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->email_supplier->caption(), $m_supplier_add->email_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->kategori_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->kategori_supplier->caption(), $m_supplier_add->kategori_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->npwp_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_npwp_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->npwp_supplier->caption(), $m_supplier_add->npwp_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_supplier_add->rekening_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_rekening_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_supplier_add->rekening_supplier->caption(), $m_supplier_add->rekening_supplier->RequiredErrorMessage)) ?>");
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
	fm_supplieradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_supplieradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_supplieradd.lists["x_kategori_supplier"] = <?php echo $m_supplier_add->kategori_supplier->Lookup->toClientList($m_supplier_add) ?>;
	fm_supplieradd.lists["x_kategori_supplier"].options = <?php echo JsonEncode($m_supplier_add->kategori_supplier->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_supplieradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_supplier_add->showPageHeader(); ?>
<?php
$m_supplier_add->showMessage();
?>
<form name="fm_supplieradd" id="fm_supplieradd" class="<?php echo $m_supplier_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_supplier">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_supplier_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_supplier_add->kode_supplier->Visible) { // kode_supplier ?>
	<div id="r_kode_supplier" class="form-group row">
		<label id="elh_m_supplier_kode_supplier" for="x_kode_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->kode_supplier->caption() ?><?php echo $m_supplier_add->kode_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->kode_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kode_supplier">
<input type="text" data-table="m_supplier" data-field="x_kode_supplier" name="x_kode_supplier" id="x_kode_supplier" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_supplier_add->kode_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->kode_supplier->EditValue ?>"<?php echo $m_supplier_add->kode_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->kode_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->nama_supplier->Visible) { // nama_supplier ?>
	<div id="r_nama_supplier" class="form-group row">
		<label id="elh_m_supplier_nama_supplier" for="x_nama_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->nama_supplier->caption() ?><?php echo $m_supplier_add->nama_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->nama_supplier->cellAttributes() ?>>
<span id="el_m_supplier_nama_supplier">
<input type="text" data-table="m_supplier" data-field="x_nama_supplier" name="x_nama_supplier" id="x_nama_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->nama_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->nama_supplier->EditValue ?>"<?php echo $m_supplier_add->nama_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->nama_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->pic_supplier->Visible) { // pic_supplier ?>
	<div id="r_pic_supplier" class="form-group row">
		<label id="elh_m_supplier_pic_supplier" for="x_pic_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->pic_supplier->caption() ?><?php echo $m_supplier_add->pic_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->pic_supplier->cellAttributes() ?>>
<span id="el_m_supplier_pic_supplier">
<input type="text" data-table="m_supplier" data-field="x_pic_supplier" name="x_pic_supplier" id="x_pic_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->pic_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->pic_supplier->EditValue ?>"<?php echo $m_supplier_add->pic_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->pic_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->alamat_supplier->Visible) { // alamat_supplier ?>
	<div id="r_alamat_supplier" class="form-group row">
		<label id="elh_m_supplier_alamat_supplier" for="x_alamat_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->alamat_supplier->caption() ?><?php echo $m_supplier_add->alamat_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->alamat_supplier->cellAttributes() ?>>
<span id="el_m_supplier_alamat_supplier">
<input type="text" data-table="m_supplier" data-field="x_alamat_supplier" name="x_alamat_supplier" id="x_alamat_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->alamat_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->alamat_supplier->EditValue ?>"<?php echo $m_supplier_add->alamat_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->alamat_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->kelurahan_supplier->Visible) { // kelurahan_supplier ?>
	<div id="r_kelurahan_supplier" class="form-group row">
		<label id="elh_m_supplier_kelurahan_supplier" for="x_kelurahan_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->kelurahan_supplier->caption() ?><?php echo $m_supplier_add->kelurahan_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->kelurahan_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kelurahan_supplier">
<input type="text" data-table="m_supplier" data-field="x_kelurahan_supplier" name="x_kelurahan_supplier" id="x_kelurahan_supplier" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_supplier_add->kelurahan_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->kelurahan_supplier->EditValue ?>"<?php echo $m_supplier_add->kelurahan_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->kelurahan_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->kecamatan_supplier->Visible) { // kecamatan_supplier ?>
	<div id="r_kecamatan_supplier" class="form-group row">
		<label id="elh_m_supplier_kecamatan_supplier" for="x_kecamatan_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->kecamatan_supplier->caption() ?><?php echo $m_supplier_add->kecamatan_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->kecamatan_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kecamatan_supplier">
<input type="text" data-table="m_supplier" data-field="x_kecamatan_supplier" name="x_kecamatan_supplier" id="x_kecamatan_supplier" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_supplier_add->kecamatan_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->kecamatan_supplier->EditValue ?>"<?php echo $m_supplier_add->kecamatan_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->kecamatan_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->kota_supplier->Visible) { // kota_supplier ?>
	<div id="r_kota_supplier" class="form-group row">
		<label id="elh_m_supplier_kota_supplier" for="x_kota_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->kota_supplier->caption() ?><?php echo $m_supplier_add->kota_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->kota_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kota_supplier">
<input type="text" data-table="m_supplier" data-field="x_kota_supplier" name="x_kota_supplier" id="x_kota_supplier" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_supplier_add->kota_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->kota_supplier->EditValue ?>"<?php echo $m_supplier_add->kota_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->kota_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->kodepos_supplier->Visible) { // kodepos_supplier ?>
	<div id="r_kodepos_supplier" class="form-group row">
		<label id="elh_m_supplier_kodepos_supplier" for="x_kodepos_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->kodepos_supplier->caption() ?><?php echo $m_supplier_add->kodepos_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->kodepos_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kodepos_supplier">
<input type="text" data-table="m_supplier" data-field="x_kodepos_supplier" name="x_kodepos_supplier" id="x_kodepos_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->kodepos_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->kodepos_supplier->EditValue ?>"<?php echo $m_supplier_add->kodepos_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->kodepos_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->telpon_supplier->Visible) { // telpon_supplier ?>
	<div id="r_telpon_supplier" class="form-group row">
		<label id="elh_m_supplier_telpon_supplier" for="x_telpon_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->telpon_supplier->caption() ?><?php echo $m_supplier_add->telpon_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->telpon_supplier->cellAttributes() ?>>
<span id="el_m_supplier_telpon_supplier">
<input type="text" data-table="m_supplier" data-field="x_telpon_supplier" name="x_telpon_supplier" id="x_telpon_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->telpon_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->telpon_supplier->EditValue ?>"<?php echo $m_supplier_add->telpon_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->telpon_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->hp_supplier->Visible) { // hp_supplier ?>
	<div id="r_hp_supplier" class="form-group row">
		<label id="elh_m_supplier_hp_supplier" for="x_hp_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->hp_supplier->caption() ?><?php echo $m_supplier_add->hp_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->hp_supplier->cellAttributes() ?>>
<span id="el_m_supplier_hp_supplier">
<input type="text" data-table="m_supplier" data-field="x_hp_supplier" name="x_hp_supplier" id="x_hp_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->hp_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->hp_supplier->EditValue ?>"<?php echo $m_supplier_add->hp_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->hp_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->email_supplier->Visible) { // email_supplier ?>
	<div id="r_email_supplier" class="form-group row">
		<label id="elh_m_supplier_email_supplier" for="x_email_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->email_supplier->caption() ?><?php echo $m_supplier_add->email_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->email_supplier->cellAttributes() ?>>
<span id="el_m_supplier_email_supplier">
<input type="text" data-table="m_supplier" data-field="x_email_supplier" name="x_email_supplier" id="x_email_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->email_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->email_supplier->EditValue ?>"<?php echo $m_supplier_add->email_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->email_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->kategori_supplier->Visible) { // kategori_supplier ?>
	<div id="r_kategori_supplier" class="form-group row">
		<label id="elh_m_supplier_kategori_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->kategori_supplier->caption() ?><?php echo $m_supplier_add->kategori_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->kategori_supplier->cellAttributes() ?>>
<span id="el_m_supplier_kategori_supplier">
<div id="tp_x_kategori_supplier" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_supplier" data-field="x_kategori_supplier" data-value-separator="<?php echo $m_supplier_add->kategori_supplier->displayValueSeparatorAttribute() ?>" name="x_kategori_supplier" id="x_kategori_supplier" value="{value}"<?php echo $m_supplier_add->kategori_supplier->editAttributes() ?>></div>
<div id="dsl_x_kategori_supplier" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_supplier_add->kategori_supplier->radioButtonListHtml(FALSE, "x_kategori_supplier") ?>
</div></div>
</span>
<?php echo $m_supplier_add->kategori_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->npwp_supplier->Visible) { // npwp_supplier ?>
	<div id="r_npwp_supplier" class="form-group row">
		<label id="elh_m_supplier_npwp_supplier" for="x_npwp_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->npwp_supplier->caption() ?><?php echo $m_supplier_add->npwp_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->npwp_supplier->cellAttributes() ?>>
<span id="el_m_supplier_npwp_supplier">
<input type="text" data-table="m_supplier" data-field="x_npwp_supplier" name="x_npwp_supplier" id="x_npwp_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->npwp_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->npwp_supplier->EditValue ?>"<?php echo $m_supplier_add->npwp_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->npwp_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_supplier_add->rekening_supplier->Visible) { // rekening_supplier ?>
	<div id="r_rekening_supplier" class="form-group row">
		<label id="elh_m_supplier_rekening_supplier" for="x_rekening_supplier" class="<?php echo $m_supplier_add->LeftColumnClass ?>"><?php echo $m_supplier_add->rekening_supplier->caption() ?><?php echo $m_supplier_add->rekening_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_supplier_add->RightColumnClass ?>"><div <?php echo $m_supplier_add->rekening_supplier->cellAttributes() ?>>
<span id="el_m_supplier_rekening_supplier">
<input type="text" data-table="m_supplier" data-field="x_rekening_supplier" name="x_rekening_supplier" id="x_rekening_supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_supplier_add->rekening_supplier->getPlaceHolder()) ?>" value="<?php echo $m_supplier_add->rekening_supplier->EditValue ?>"<?php echo $m_supplier_add->rekening_supplier->editAttributes() ?>>
</span>
<?php echo $m_supplier_add->rekening_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_supplier_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_supplier_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_supplier_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_supplier_add->showPageFooter();
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
$m_supplier_add->terminate();
?>