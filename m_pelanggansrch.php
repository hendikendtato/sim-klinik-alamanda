<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

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
$m_pelanggan_search = new m_pelanggan_search();

// Run the page
$m_pelanggan_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pelanggan_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_pelanggansearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($m_pelanggan_search->IsModal) { ?>
	fm_pelanggansearch = currentAdvancedSearchForm = new ew.Form("fm_pelanggansearch", "search");
	<?php } else { ?>
	fm_pelanggansearch = currentForm = new ew.Form("fm_pelanggansearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fm_pelanggansearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_pelanggan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_pelanggan_search->id_pelanggan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgllahir_pelanggan");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_pelanggan_search->tgllahir_pelanggan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl_daftar");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_pelanggan_search->tgl_daftar->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_pelanggansearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_pelanggansearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_pelanggansearch.lists["x_jenis_pelanggan"] = <?php echo $m_pelanggan_search->jenis_pelanggan->Lookup->toClientList($m_pelanggan_search) ?>;
	fm_pelanggansearch.lists["x_jenis_pelanggan"].options = <?php echo JsonEncode($m_pelanggan_search->jenis_pelanggan->options(FALSE, TRUE)) ?>;
	fm_pelanggansearch.lists["x_pekerjaan_pelanggan"] = <?php echo $m_pelanggan_search->pekerjaan_pelanggan->Lookup->toClientList($m_pelanggan_search) ?>;
	fm_pelanggansearch.lists["x_pekerjaan_pelanggan"].options = <?php echo JsonEncode($m_pelanggan_search->pekerjaan_pelanggan->lookupOptions()) ?>;
	fm_pelanggansearch.lists["x_kota_pelanggan"] = <?php echo $m_pelanggan_search->kota_pelanggan->Lookup->toClientList($m_pelanggan_search) ?>;
	fm_pelanggansearch.lists["x_kota_pelanggan"].options = <?php echo JsonEncode($m_pelanggan_search->kota_pelanggan->lookupOptions()) ?>;
	fm_pelanggansearch.lists["x_id_klinik"] = <?php echo $m_pelanggan_search->id_klinik->Lookup->toClientList($m_pelanggan_search) ?>;
	fm_pelanggansearch.lists["x_id_klinik"].options = <?php echo JsonEncode($m_pelanggan_search->id_klinik->lookupOptions()) ?>;
	fm_pelanggansearch.lists["x_kategori"] = <?php echo $m_pelanggan_search->kategori->Lookup->toClientList($m_pelanggan_search) ?>;
	fm_pelanggansearch.lists["x_kategori"].options = <?php echo JsonEncode($m_pelanggan_search->kategori->lookupOptions()) ?>;
	fm_pelanggansearch.lists["x_tipe"] = <?php echo $m_pelanggan_search->tipe->Lookup->toClientList($m_pelanggan_search) ?>;
	fm_pelanggansearch.lists["x_tipe"].options = <?php echo JsonEncode($m_pelanggan_search->tipe->lookupOptions()) ?>;
	loadjs.done("fm_pelanggansearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_pelanggan_search->showPageHeader(); ?>
<?php
$m_pelanggan_search->showMessage();
?>
<form name="fm_pelanggansearch" id="fm_pelanggansearch" class="<?php echo $m_pelanggan_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pelanggan">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$m_pelanggan_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($m_pelanggan_search->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label for="x_id_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_id_pelanggan"><?php echo $m_pelanggan_search->id_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pelanggan" id="z_id_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->id_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_id_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_id_pelanggan" name="x_id_pelanggan" id="x_id_pelanggan" maxlength="11" placeholder="<?php echo HtmlEncode($m_pelanggan_search->id_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->id_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->id_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->kode_pelanggan->Visible) { // kode_pelanggan ?>
	<div id="r_kode_pelanggan" class="form-group row">
		<label for="x_kode_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_kode_pelanggan"><?php echo $m_pelanggan_search->kode_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_pelanggan" id="z_kode_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->kode_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_kode_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_kode_pelanggan" name="x_kode_pelanggan" id="x_kode_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_search->kode_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->kode_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->kode_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
	<div id="r_noktp_pelanggan" class="form-group row">
		<label for="x_noktp_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_noktp_pelanggan"><?php echo $m_pelanggan_search->noktp_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_noktp_pelanggan" id="z_noktp_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->noktp_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_noktp_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_noktp_pelanggan" name="x_noktp_pelanggan" id="x_noktp_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_search->noktp_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->noktp_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->noktp_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<div id="r_nama_pelanggan" class="form-group row">
		<label for="x_nama_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_nama_pelanggan"><?php echo $m_pelanggan_search->nama_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_pelanggan" id="z_nama_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->nama_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_nama_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_nama_pelanggan" name="x_nama_pelanggan" id="x_nama_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_search->nama_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->nama_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->nama_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
	<div id="r_jenis_pelanggan" class="form-group row">
		<label class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_jenis_pelanggan"><?php echo $m_pelanggan_search->jenis_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_pelanggan" id="z_jenis_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->jenis_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_jenis_pelanggan" class="ew-search-field">
<div id="tp_x_jenis_pelanggan" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pelanggan" data-field="x_jenis_pelanggan" data-value-separator="<?php echo $m_pelanggan_search->jenis_pelanggan->displayValueSeparatorAttribute() ?>" name="x_jenis_pelanggan" id="x_jenis_pelanggan" value="{value}"<?php echo $m_pelanggan_search->jenis_pelanggan->editAttributes() ?>></div>
<div id="dsl_x_jenis_pelanggan" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pelanggan_search->jenis_pelanggan->radioButtonListHtml(FALSE, "x_jenis_pelanggan") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->tgllahir_pelanggan->Visible) { // tgllahir_pelanggan ?>
	<div id="r_tgllahir_pelanggan" class="form-group row">
		<label for="x_tgllahir_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_tgllahir_pelanggan"><?php echo $m_pelanggan_search->tgllahir_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgllahir_pelanggan" id="z_tgllahir_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->tgllahir_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_tgllahir_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_tgllahir_pelanggan" name="x_tgllahir_pelanggan" id="x_tgllahir_pelanggan" maxlength="10" placeholder="<?php echo HtmlEncode($m_pelanggan_search->tgllahir_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->tgllahir_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->tgllahir_pelanggan->editAttributes() ?>>
<?php if (!$m_pelanggan_search->tgllahir_pelanggan->ReadOnly && !$m_pelanggan_search->tgllahir_pelanggan->Disabled && !isset($m_pelanggan_search->tgllahir_pelanggan->EditAttrs["readonly"]) && !isset($m_pelanggan_search->tgllahir_pelanggan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_pelanggansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_pelanggansearch", "x_tgllahir_pelanggan", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->pekerjaan_pelanggan->Visible) { // pekerjaan_pelanggan ?>
	<div id="r_pekerjaan_pelanggan" class="form-group row">
		<label for="x_pekerjaan_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_pekerjaan_pelanggan"><?php echo $m_pelanggan_search->pekerjaan_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pekerjaan_pelanggan" id="z_pekerjaan_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->pekerjaan_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_pekerjaan_pelanggan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_pekerjaan_pelanggan" data-value-separator="<?php echo $m_pelanggan_search->pekerjaan_pelanggan->displayValueSeparatorAttribute() ?>" id="x_pekerjaan_pelanggan" name="x_pekerjaan_pelanggan"<?php echo $m_pelanggan_search->pekerjaan_pelanggan->editAttributes() ?>>
			<?php echo $m_pelanggan_search->pekerjaan_pelanggan->selectOptionListHtml("x_pekerjaan_pelanggan") ?>
		</select>
</div>
<?php echo $m_pelanggan_search->pekerjaan_pelanggan->Lookup->getParamTag($m_pelanggan_search, "p_x_pekerjaan_pelanggan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->kota_pelanggan->Visible) { // kota_pelanggan ?>
	<div id="r_kota_pelanggan" class="form-group row">
		<label for="x_kota_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_kota_pelanggan"><?php echo $m_pelanggan_search->kota_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kota_pelanggan" id="z_kota_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->kota_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_kota_pelanggan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_kota_pelanggan" data-value-separator="<?php echo $m_pelanggan_search->kota_pelanggan->displayValueSeparatorAttribute() ?>" id="x_kota_pelanggan" name="x_kota_pelanggan"<?php echo $m_pelanggan_search->kota_pelanggan->editAttributes() ?>>
			<?php echo $m_pelanggan_search->kota_pelanggan->selectOptionListHtml("x_kota_pelanggan") ?>
		</select>
</div>
<?php echo $m_pelanggan_search->kota_pelanggan->Lookup->getParamTag($m_pelanggan_search, "p_x_kota_pelanggan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
	<div id="r_alamat_pelanggan" class="form-group row">
		<label for="x_alamat_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_alamat_pelanggan"><?php echo $m_pelanggan_search->alamat_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamat_pelanggan" id="z_alamat_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->alamat_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_alamat_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_alamat_pelanggan" name="x_alamat_pelanggan" id="x_alamat_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_search->alamat_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->alamat_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->alamat_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
	<div id="r_telpon_pelanggan" class="form-group row">
		<label for="x_telpon_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_telpon_pelanggan"><?php echo $m_pelanggan_search->telpon_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_telpon_pelanggan" id="z_telpon_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->telpon_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_telpon_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_telpon_pelanggan" name="x_telpon_pelanggan" id="x_telpon_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_search->telpon_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->telpon_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->telpon_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->hp_pelanggan->Visible) { // hp_pelanggan ?>
	<div id="r_hp_pelanggan" class="form-group row">
		<label for="x_hp_pelanggan" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_hp_pelanggan"><?php echo $m_pelanggan_search->hp_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_hp_pelanggan" id="z_hp_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->hp_pelanggan->cellAttributes() ?>>
			<span id="el_m_pelanggan_hp_pelanggan" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_hp_pelanggan" name="x_hp_pelanggan" id="x_hp_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pelanggan_search->hp_pelanggan->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->hp_pelanggan->EditValue ?>"<?php echo $m_pelanggan_search->hp_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_id_klinik"><?php echo $m_pelanggan_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->id_klinik->cellAttributes() ?>>
			<span id="el_m_pelanggan_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_id_klinik" data-value-separator="<?php echo $m_pelanggan_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_pelanggan_search->id_klinik->editAttributes() ?>>
			<?php echo $m_pelanggan_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_pelanggan_search->id_klinik->Lookup->getParamTag($m_pelanggan_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->tgl_daftar->Visible) { // tgl_daftar ?>
	<div id="r_tgl_daftar" class="form-group row">
		<label for="x_tgl_daftar" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_tgl_daftar"><?php echo $m_pelanggan_search->tgl_daftar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_daftar" id="z_tgl_daftar" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->tgl_daftar->cellAttributes() ?>>
			<span id="el_m_pelanggan_tgl_daftar" class="ew-search-field">
<input type="text" data-table="m_pelanggan" data-field="x_tgl_daftar" data-format="7" name="x_tgl_daftar" id="x_tgl_daftar" maxlength="19" placeholder="<?php echo HtmlEncode($m_pelanggan_search->tgl_daftar->getPlaceHolder()) ?>" value="<?php echo $m_pelanggan_search->tgl_daftar->EditValue ?>"<?php echo $m_pelanggan_search->tgl_daftar->editAttributes() ?>>
<?php if (!$m_pelanggan_search->tgl_daftar->ReadOnly && !$m_pelanggan_search->tgl_daftar->Disabled && !isset($m_pelanggan_search->tgl_daftar->EditAttrs["readonly"]) && !isset($m_pelanggan_search->tgl_daftar->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_pelanggansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_pelanggansearch", "x_tgl_daftar", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label for="x_kategori" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_kategori"><?php echo $m_pelanggan_search->kategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kategori" id="z_kategori" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->kategori->cellAttributes() ?>>
			<span id="el_m_pelanggan_kategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_kategori" data-value-separator="<?php echo $m_pelanggan_search->kategori->displayValueSeparatorAttribute() ?>" id="x_kategori" name="x_kategori"<?php echo $m_pelanggan_search->kategori->editAttributes() ?>>
			<?php echo $m_pelanggan_search->kategori->selectOptionListHtml("x_kategori") ?>
		</select>
</div>
<?php echo $m_pelanggan_search->kategori->Lookup->getParamTag($m_pelanggan_search, "p_x_kategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pelanggan_search->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label for="x_tipe" class="<?php echo $m_pelanggan_search->LeftColumnClass ?>"><span id="elh_m_pelanggan_tipe"><?php echo $m_pelanggan_search->tipe->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tipe" id="z_tipe" value="=">
</span>
		</label>
		<div class="<?php echo $m_pelanggan_search->RightColumnClass ?>"><div <?php echo $m_pelanggan_search->tipe->cellAttributes() ?>>
			<span id="el_m_pelanggan_tipe" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pelanggan" data-field="x_tipe" data-value-separator="<?php echo $m_pelanggan_search->tipe->displayValueSeparatorAttribute() ?>" id="x_tipe" name="x_tipe"<?php echo $m_pelanggan_search->tipe->editAttributes() ?>>
			<?php echo $m_pelanggan_search->tipe->selectOptionListHtml("x_tipe") ?>
		</select>
</div>
<?php echo $m_pelanggan_search->tipe->Lookup->getParamTag($m_pelanggan_search, "p_x_tipe") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_pelanggan_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_pelanggan_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_pelanggan_search->showPageFooter();
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
$m_pelanggan_search->terminate();
?>