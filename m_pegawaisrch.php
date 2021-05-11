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
$m_pegawai_search = new m_pegawai_search();

// Run the page
$m_pegawai_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pegawai_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_pegawaisearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($m_pegawai_search->IsModal) { ?>
	fm_pegawaisearch = currentAdvancedSearchForm = new ew.Form("fm_pegawaisearch", "search");
	<?php } else { ?>
	fm_pegawaisearch = currentForm = new ew.Form("fm_pegawaisearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fm_pegawaisearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgllahir_pegawai");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_pegawai_search->tgllahir_pegawai->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tarif_pegawai");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_pegawai_search->tarif_pegawai->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_pegawaisearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_pegawaisearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_pegawaisearch.lists["x_jenis_pegawai"] = <?php echo $m_pegawai_search->jenis_pegawai->Lookup->toClientList($m_pegawai_search) ?>;
	fm_pegawaisearch.lists["x_jenis_pegawai"].options = <?php echo JsonEncode($m_pegawai_search->jenis_pegawai->options(FALSE, TRUE)) ?>;
	fm_pegawaisearch.lists["x_agama_pegawai"] = <?php echo $m_pegawai_search->agama_pegawai->Lookup->toClientList($m_pegawai_search) ?>;
	fm_pegawaisearch.lists["x_agama_pegawai"].options = <?php echo JsonEncode($m_pegawai_search->agama_pegawai->lookupOptions()) ?>;
	fm_pegawaisearch.lists["x_jabatan_pegawai"] = <?php echo $m_pegawai_search->jabatan_pegawai->Lookup->toClientList($m_pegawai_search) ?>;
	fm_pegawaisearch.lists["x_jabatan_pegawai"].options = <?php echo JsonEncode($m_pegawai_search->jabatan_pegawai->lookupOptions()) ?>;
	fm_pegawaisearch.lists["x_status_pegawai"] = <?php echo $m_pegawai_search->status_pegawai->Lookup->toClientList($m_pegawai_search) ?>;
	fm_pegawaisearch.lists["x_status_pegawai"].options = <?php echo JsonEncode($m_pegawai_search->status_pegawai->options(FALSE, TRUE)) ?>;
	fm_pegawaisearch.lists["x_id_klinik"] = <?php echo $m_pegawai_search->id_klinik->Lookup->toClientList($m_pegawai_search) ?>;
	fm_pegawaisearch.lists["x_id_klinik"].options = <?php echo JsonEncode($m_pegawai_search->id_klinik->lookupOptions()) ?>;
	fm_pegawaisearch.lists["x_status"] = <?php echo $m_pegawai_search->status->Lookup->toClientList($m_pegawai_search) ?>;
	fm_pegawaisearch.lists["x_status"].options = <?php echo JsonEncode($m_pegawai_search->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_pegawaisearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_pegawai_search->showPageHeader(); ?>
<?php
$m_pegawai_search->showMessage();
?>
<form name="fm_pegawaisearch" id="fm_pegawaisearch" class="<?php echo $m_pegawai_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pegawai">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$m_pegawai_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($m_pegawai_search->nama_pegawai->Visible) { // nama_pegawai ?>
	<div id="r_nama_pegawai" class="form-group row">
		<label for="x_nama_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_nama_pegawai"><?php echo $m_pegawai_search->nama_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_pegawai" id="z_nama_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->nama_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_nama_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_nama_pegawai" name="x_nama_pegawai" id="x_nama_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_search->nama_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->nama_pegawai->EditValue ?>"<?php echo $m_pegawai_search->nama_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->nama_lengkap->Visible) { // nama_lengkap ?>
	<div id="r_nama_lengkap" class="form-group row">
		<label for="x_nama_lengkap" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_nama_lengkap"><?php echo $m_pegawai_search->nama_lengkap->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_lengkap" id="z_nama_lengkap" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->nama_lengkap->cellAttributes() ?>>
			<span id="el_m_pegawai_nama_lengkap" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_nama_lengkap" name="x_nama_lengkap" id="x_nama_lengkap" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_search->nama_lengkap->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->nama_lengkap->EditValue ?>"<?php echo $m_pegawai_search->nama_lengkap->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->jenis_pegawai->Visible) { // jenis_pegawai ?>
	<div id="r_jenis_pegawai" class="form-group row">
		<label class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_jenis_pegawai"><?php echo $m_pegawai_search->jenis_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_pegawai" id="z_jenis_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->jenis_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_jenis_pegawai" class="ew-search-field">
<div id="tp_x_jenis_pegawai" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pegawai" data-field="x_jenis_pegawai" data-value-separator="<?php echo $m_pegawai_search->jenis_pegawai->displayValueSeparatorAttribute() ?>" name="x_jenis_pegawai" id="x_jenis_pegawai" value="{value}"<?php echo $m_pegawai_search->jenis_pegawai->editAttributes() ?>></div>
<div id="dsl_x_jenis_pegawai" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pegawai_search->jenis_pegawai->radioButtonListHtml(FALSE, "x_jenis_pegawai") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->nik_pegawai->Visible) { // nik_pegawai ?>
	<div id="r_nik_pegawai" class="form-group row">
		<label for="x_nik_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_nik_pegawai"><?php echo $m_pegawai_search->nik_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nik_pegawai" id="z_nik_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->nik_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_nik_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_nik_pegawai" name="x_nik_pegawai" id="x_nik_pegawai" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_pegawai_search->nik_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->nik_pegawai->EditValue ?>"<?php echo $m_pegawai_search->nik_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->agama_pegawai->Visible) { // agama_pegawai ?>
	<div id="r_agama_pegawai" class="form-group row">
		<label for="x_agama_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_agama_pegawai"><?php echo $m_pegawai_search->agama_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_agama_pegawai" id="z_agama_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->agama_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_agama_pegawai" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pegawai" data-field="x_agama_pegawai" data-value-separator="<?php echo $m_pegawai_search->agama_pegawai->displayValueSeparatorAttribute() ?>" id="x_agama_pegawai" name="x_agama_pegawai"<?php echo $m_pegawai_search->agama_pegawai->editAttributes() ?>>
			<?php echo $m_pegawai_search->agama_pegawai->selectOptionListHtml("x_agama_pegawai") ?>
		</select>
</div>
<?php echo $m_pegawai_search->agama_pegawai->Lookup->getParamTag($m_pegawai_search, "p_x_agama_pegawai") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->tgllahir_pegawai->Visible) { // tgllahir_pegawai ?>
	<div id="r_tgllahir_pegawai" class="form-group row">
		<label for="x_tgllahir_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_tgllahir_pegawai"><?php echo $m_pegawai_search->tgllahir_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgllahir_pegawai" id="z_tgllahir_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->tgllahir_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_tgllahir_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_tgllahir_pegawai" name="x_tgllahir_pegawai" id="x_tgllahir_pegawai" maxlength="10" placeholder="<?php echo HtmlEncode($m_pegawai_search->tgllahir_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->tgllahir_pegawai->EditValue ?>"<?php echo $m_pegawai_search->tgllahir_pegawai->editAttributes() ?>>
<?php if (!$m_pegawai_search->tgllahir_pegawai->ReadOnly && !$m_pegawai_search->tgllahir_pegawai->Disabled && !isset($m_pegawai_search->tgllahir_pegawai->EditAttrs["readonly"]) && !isset($m_pegawai_search->tgllahir_pegawai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_pegawaisearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_pegawaisearch", "x_tgllahir_pegawai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->alamat_pegawai->Visible) { // alamat_pegawai ?>
	<div id="r_alamat_pegawai" class="form-group row">
		<label for="x_alamat_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_alamat_pegawai"><?php echo $m_pegawai_search->alamat_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_alamat_pegawai" id="z_alamat_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->alamat_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_alamat_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_alamat_pegawai" name="x_alamat_pegawai" id="x_alamat_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_search->alamat_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->alamat_pegawai->EditValue ?>"<?php echo $m_pegawai_search->alamat_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->hp_pegawai->Visible) { // hp_pegawai ?>
	<div id="r_hp_pegawai" class="form-group row">
		<label for="x_hp_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_hp_pegawai"><?php echo $m_pegawai_search->hp_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_hp_pegawai" id="z_hp_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->hp_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_hp_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_hp_pegawai" name="x_hp_pegawai" id="x_hp_pegawai" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_pegawai_search->hp_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->hp_pegawai->EditValue ?>"<?php echo $m_pegawai_search->hp_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->pendidikan_pegawai->Visible) { // pendidikan_pegawai ?>
	<div id="r_pendidikan_pegawai" class="form-group row">
		<label for="x_pendidikan_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_pendidikan_pegawai"><?php echo $m_pegawai_search->pendidikan_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pendidikan_pegawai" id="z_pendidikan_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->pendidikan_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_pendidikan_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_pendidikan_pegawai" name="x_pendidikan_pegawai" id="x_pendidikan_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_search->pendidikan_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->pendidikan_pegawai->EditValue ?>"<?php echo $m_pegawai_search->pendidikan_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->jurusan_pegawai->Visible) { // jurusan_pegawai ?>
	<div id="r_jurusan_pegawai" class="form-group row">
		<label for="x_jurusan_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_jurusan_pegawai"><?php echo $m_pegawai_search->jurusan_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_jurusan_pegawai" id="z_jurusan_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->jurusan_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_jurusan_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_jurusan_pegawai" name="x_jurusan_pegawai" id="x_jurusan_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_search->jurusan_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->jurusan_pegawai->EditValue ?>"<?php echo $m_pegawai_search->jurusan_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->spesialis_pegawai->Visible) { // spesialis_pegawai ?>
	<div id="r_spesialis_pegawai" class="form-group row">
		<label for="x_spesialis_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_spesialis_pegawai"><?php echo $m_pegawai_search->spesialis_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_spesialis_pegawai" id="z_spesialis_pegawai" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->spesialis_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_spesialis_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_spesialis_pegawai" name="x_spesialis_pegawai" id="x_spesialis_pegawai" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_pegawai_search->spesialis_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->spesialis_pegawai->EditValue ?>"<?php echo $m_pegawai_search->spesialis_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->jabatan_pegawai->Visible) { // jabatan_pegawai ?>
	<div id="r_jabatan_pegawai" class="form-group row">
		<label for="x_jabatan_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_jabatan_pegawai"><?php echo $m_pegawai_search->jabatan_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jabatan_pegawai" id="z_jabatan_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->jabatan_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_jabatan_pegawai" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pegawai" data-field="x_jabatan_pegawai" data-value-separator="<?php echo $m_pegawai_search->jabatan_pegawai->displayValueSeparatorAttribute() ?>" id="x_jabatan_pegawai" name="x_jabatan_pegawai"<?php echo $m_pegawai_search->jabatan_pegawai->editAttributes() ?>>
			<?php echo $m_pegawai_search->jabatan_pegawai->selectOptionListHtml("x_jabatan_pegawai") ?>
		</select>
</div>
<?php echo $m_pegawai_search->jabatan_pegawai->Lookup->getParamTag($m_pegawai_search, "p_x_jabatan_pegawai") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->status_pegawai->Visible) { // status_pegawai ?>
	<div id="r_status_pegawai" class="form-group row">
		<label class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_status_pegawai"><?php echo $m_pegawai_search->status_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status_pegawai" id="z_status_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->status_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_status_pegawai" class="ew-search-field">
<div id="tp_x_status_pegawai" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pegawai" data-field="x_status_pegawai" data-value-separator="<?php echo $m_pegawai_search->status_pegawai->displayValueSeparatorAttribute() ?>" name="x_status_pegawai" id="x_status_pegawai" value="{value}"<?php echo $m_pegawai_search->status_pegawai->editAttributes() ?>></div>
<div id="dsl_x_status_pegawai" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pegawai_search->status_pegawai->radioButtonListHtml(FALSE, "x_status_pegawai") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->tarif_pegawai->Visible) { // tarif_pegawai ?>
	<div id="r_tarif_pegawai" class="form-group row">
		<label for="x_tarif_pegawai" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_tarif_pegawai"><?php echo $m_pegawai_search->tarif_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tarif_pegawai" id="z_tarif_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->tarif_pegawai->cellAttributes() ?>>
			<span id="el_m_pegawai_tarif_pegawai" class="ew-search-field">
<input type="text" data-table="m_pegawai" data-field="x_tarif_pegawai" name="x_tarif_pegawai" id="x_tarif_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_pegawai_search->tarif_pegawai->getPlaceHolder()) ?>" value="<?php echo $m_pegawai_search->tarif_pegawai->EditValue ?>"<?php echo $m_pegawai_search->tarif_pegawai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_id_klinik"><?php echo $m_pegawai_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->id_klinik->cellAttributes() ?>>
			<span id="el_m_pegawai_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_pegawai" data-field="x_id_klinik" data-value-separator="<?php echo $m_pegawai_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_pegawai_search->id_klinik->editAttributes() ?>>
			<?php echo $m_pegawai_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_pegawai_search->id_klinik->Lookup->getParamTag($m_pegawai_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_pegawai_search->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label class="<?php echo $m_pegawai_search->LeftColumnClass ?>"><span id="elh_m_pegawai_status"><?php echo $m_pegawai_search->status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status" id="z_status" value="=">
</span>
		</label>
		<div class="<?php echo $m_pegawai_search->RightColumnClass ?>"><div <?php echo $m_pegawai_search->status->cellAttributes() ?>>
			<span id="el_m_pegawai_status" class="ew-search-field">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_pegawai" data-field="x_status" data-value-separator="<?php echo $m_pegawai_search->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $m_pegawai_search->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_pegawai_search->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_pegawai_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_pegawai_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_pegawai_search->showPageFooter();
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
$m_pegawai_search->terminate();
?>