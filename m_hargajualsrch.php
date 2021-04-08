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
$m_hargajual_search = new m_hargajual_search();

// Run the page
$m_hargajual_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_hargajualsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($m_hargajual_search->IsModal) { ?>
	fm_hargajualsearch = currentAdvancedSearchForm = new ew.Form("fm_hargajualsearch", "search");
	<?php } else { ?>
	fm_hargajualsearch = currentForm = new ew.Form("fm_hargajualsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fm_hargajualsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_disc_pr");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_hargajual_search->disc_pr->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_disc_rp");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_hargajual_search->disc_rp->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_minimum_stok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_hargajual_search->minimum_stok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl_masuk");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_hargajual_search->tgl_masuk->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl_exp");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_hargajual_search->tgl_exp->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_hargajualsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_hargajualsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_hargajualsearch.lists["x_id_barang"] = <?php echo $m_hargajual_search->id_barang->Lookup->toClientList($m_hargajual_search) ?>;
	fm_hargajualsearch.lists["x_id_barang"].options = <?php echo JsonEncode($m_hargajual_search->id_barang->lookupOptions()) ?>;
	fm_hargajualsearch.lists["x_id_klinik"] = <?php echo $m_hargajual_search->id_klinik->Lookup->toClientList($m_hargajual_search) ?>;
	fm_hargajualsearch.lists["x_id_klinik"].options = <?php echo JsonEncode($m_hargajual_search->id_klinik->lookupOptions()) ?>;
	fm_hargajualsearch.lists["x_satuan"] = <?php echo $m_hargajual_search->satuan->Lookup->toClientList($m_hargajual_search) ?>;
	fm_hargajualsearch.lists["x_satuan"].options = <?php echo JsonEncode($m_hargajual_search->satuan->lookupOptions()) ?>;
	fm_hargajualsearch.lists["x_kategori"] = <?php echo $m_hargajual_search->kategori->Lookup->toClientList($m_hargajual_search) ?>;
	fm_hargajualsearch.lists["x_kategori"].options = <?php echo JsonEncode($m_hargajual_search->kategori->lookupOptions()) ?>;
	fm_hargajualsearch.lists["x_subkategori"] = <?php echo $m_hargajual_search->subkategori->Lookup->toClientList($m_hargajual_search) ?>;
	fm_hargajualsearch.lists["x_subkategori"].options = <?php echo JsonEncode($m_hargajual_search->subkategori->lookupOptions()) ?>;
	loadjs.done("fm_hargajualsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_hargajual_search->showPageHeader(); ?>
<?php
$m_hargajual_search->showMessage();
?>
<form name="fm_hargajualsearch" id="fm_hargajualsearch" class="<?php echo $m_hargajual_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$m_hargajual_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($m_hargajual_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label for="x_id_barang" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_id_barang"><?php echo $m_hargajual_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->id_barang->cellAttributes() ?>>
			<span id="el_m_hargajual_id_barang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($m_hargajual_search->id_barang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_hargajual_search->id_barang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_hargajual_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_hargajual_search->id_barang->ReadOnly || $m_hargajual_search->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_hargajual_search->id_barang->Lookup->getParamTag($m_hargajual_search, "p_x_id_barang") ?>
<input type="hidden" data-table="m_hargajual" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_hargajual_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $m_hargajual_search->id_barang->AdvancedSearch->SearchValue ?>"<?php echo $m_hargajual_search->id_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->disc_pr->Visible) { // disc_pr ?>
	<div id="r_disc_pr" class="form-group row">
		<label for="x_disc_pr" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_disc_pr"><?php echo $m_hargajual_search->disc_pr->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_disc_pr" id="z_disc_pr" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->disc_pr->cellAttributes() ?>>
			<span id="el_m_hargajual_disc_pr" class="ew-search-field">
<input type="text" data-table="m_hargajual" data-field="x_disc_pr" name="x_disc_pr" id="x_disc_pr" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_hargajual_search->disc_pr->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_search->disc_pr->EditValue ?>"<?php echo $m_hargajual_search->disc_pr->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->disc_rp->Visible) { // disc_rp ?>
	<div id="r_disc_rp" class="form-group row">
		<label for="x_disc_rp" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_disc_rp"><?php echo $m_hargajual_search->disc_rp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_disc_rp" id="z_disc_rp" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->disc_rp->cellAttributes() ?>>
			<span id="el_m_hargajual_disc_rp" class="ew-search-field">
<input type="text" data-table="m_hargajual" data-field="x_disc_rp" name="x_disc_rp" id="x_disc_rp" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_hargajual_search->disc_rp->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_search->disc_rp->EditValue ?>"<?php echo $m_hargajual_search->disc_rp->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_id_klinik"><?php echo $m_hargajual_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->id_klinik->cellAttributes() ?>>
			<span id="el_m_hargajual_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_id_klinik" data-value-separator="<?php echo $m_hargajual_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_hargajual_search->id_klinik->editAttributes() ?>>
			<?php echo $m_hargajual_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_hargajual_search->id_klinik->Lookup->getParamTag($m_hargajual_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label for="x_satuan" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_satuan"><?php echo $m_hargajual_search->satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_satuan" id="z_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->satuan->cellAttributes() ?>>
			<span id="el_m_hargajual_satuan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_satuan" data-value-separator="<?php echo $m_hargajual_search->satuan->displayValueSeparatorAttribute() ?>" id="x_satuan" name="x_satuan"<?php echo $m_hargajual_search->satuan->editAttributes() ?>>
			<?php echo $m_hargajual_search->satuan->selectOptionListHtml("x_satuan") ?>
		</select>
</div>
<?php echo $m_hargajual_search->satuan->Lookup->getParamTag($m_hargajual_search, "p_x_satuan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->minimum_stok->Visible) { // minimum_stok ?>
	<div id="r_minimum_stok" class="form-group row">
		<label for="x_minimum_stok" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_minimum_stok"><?php echo $m_hargajual_search->minimum_stok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_minimum_stok" id="z_minimum_stok" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->minimum_stok->cellAttributes() ?>>
			<span id="el_m_hargajual_minimum_stok" class="ew-search-field">
<input type="text" data-table="m_hargajual" data-field="x_minimum_stok" name="x_minimum_stok" id="x_minimum_stok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_hargajual_search->minimum_stok->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_search->minimum_stok->EditValue ?>"<?php echo $m_hargajual_search->minimum_stok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->tgl_masuk->Visible) { // tgl_masuk ?>
	<div id="r_tgl_masuk" class="form-group row">
		<label for="x_tgl_masuk" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_tgl_masuk"><?php echo $m_hargajual_search->tgl_masuk->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_masuk" id="z_tgl_masuk" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->tgl_masuk->cellAttributes() ?>>
			<span id="el_m_hargajual_tgl_masuk" class="ew-search-field">
<input type="text" data-table="m_hargajual" data-field="x_tgl_masuk" name="x_tgl_masuk" id="x_tgl_masuk" maxlength="19" placeholder="<?php echo HtmlEncode($m_hargajual_search->tgl_masuk->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_search->tgl_masuk->EditValue ?>"<?php echo $m_hargajual_search->tgl_masuk->editAttributes() ?>>
<?php if (!$m_hargajual_search->tgl_masuk->ReadOnly && !$m_hargajual_search->tgl_masuk->Disabled && !isset($m_hargajual_search->tgl_masuk->EditAttrs["readonly"]) && !isset($m_hargajual_search->tgl_masuk->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_hargajualsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_hargajualsearch", "x_tgl_masuk", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->tgl_exp->Visible) { // tgl_exp ?>
	<div id="r_tgl_exp" class="form-group row">
		<label for="x_tgl_exp" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_tgl_exp"><?php echo $m_hargajual_search->tgl_exp->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_exp" id="z_tgl_exp" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->tgl_exp->cellAttributes() ?>>
			<span id="el_m_hargajual_tgl_exp" class="ew-search-field">
<input type="text" data-table="m_hargajual" data-field="x_tgl_exp" name="x_tgl_exp" id="x_tgl_exp" maxlength="19" placeholder="<?php echo HtmlEncode($m_hargajual_search->tgl_exp->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_search->tgl_exp->EditValue ?>"<?php echo $m_hargajual_search->tgl_exp->editAttributes() ?>>
<?php if (!$m_hargajual_search->tgl_exp->ReadOnly && !$m_hargajual_search->tgl_exp->Disabled && !isset($m_hargajual_search->tgl_exp->EditAttrs["readonly"]) && !isset($m_hargajual_search->tgl_exp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_hargajualsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_hargajualsearch", "x_tgl_exp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label for="x_kategori" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_kategori"><?php echo $m_hargajual_search->kategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kategori" id="z_kategori" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->kategori->cellAttributes() ?>>
			<span id="el_m_hargajual_kategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_kategori" data-value-separator="<?php echo $m_hargajual_search->kategori->displayValueSeparatorAttribute() ?>" id="x_kategori" name="x_kategori"<?php echo $m_hargajual_search->kategori->editAttributes() ?>>
			<?php echo $m_hargajual_search->kategori->selectOptionListHtml("x_kategori") ?>
		</select>
</div>
<?php echo $m_hargajual_search->kategori->Lookup->getParamTag($m_hargajual_search, "p_x_kategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_search->subkategori->Visible) { // subkategori ?>
	<div id="r_subkategori" class="form-group row">
		<label for="x_subkategori" class="<?php echo $m_hargajual_search->LeftColumnClass ?>"><span id="elh_m_hargajual_subkategori"><?php echo $m_hargajual_search->subkategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_subkategori" id="z_subkategori" value="=">
</span>
		</label>
		<div class="<?php echo $m_hargajual_search->RightColumnClass ?>"><div <?php echo $m_hargajual_search->subkategori->cellAttributes() ?>>
			<span id="el_m_hargajual_subkategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_subkategori" data-value-separator="<?php echo $m_hargajual_search->subkategori->displayValueSeparatorAttribute() ?>" id="x_subkategori" name="x_subkategori"<?php echo $m_hargajual_search->subkategori->editAttributes() ?>>
			<?php echo $m_hargajual_search->subkategori->selectOptionListHtml("x_subkategori") ?>
		</select>
</div>
<?php echo $m_hargajual_search->subkategori->Lookup->getParamTag($m_hargajual_search, "p_x_subkategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_hargajual_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_hargajual_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_hargajual_search->showPageFooter();
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
$m_hargajual_search->terminate();
?>