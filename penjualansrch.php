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
$penjualan_search = new penjualan_search();

// Run the page
$penjualan_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenjualansearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($penjualan_search->IsModal) { ?>
	fpenjualansearch = currentAdvancedSearchForm = new ew.Form("fpenjualansearch", "search");
	<?php } else { ?>
	fpenjualansearch = currentForm = new ew.Form("fpenjualansearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpenjualansearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_member");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->id_member->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_waktu");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->waktu->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_diskon_rupiah");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->diskon_rupiah->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ppn");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->ppn->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->total->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_bayar");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->bayar->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_bayar_non_tunai");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->bayar_non_tunai->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total_non_tunai_charge");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->total_non_tunai_charge->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_rmd");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->id_rmd->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_charge");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->charge->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_klaim_poin");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->klaim_poin->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total_penukaran_poin");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->total_penukaran_poin->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ongkir");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($penjualan_search->ongkir->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpenjualansearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenjualansearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenjualansearch.lists["x_id_pelanggan"] = <?php echo $penjualan_search->id_pelanggan->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_pelanggan"].options = <?php echo JsonEncode($penjualan_search->id_pelanggan->lookupOptions()) ?>;
	fpenjualansearch.autoSuggests["x_id_pelanggan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenjualansearch.lists["x_id_member"] = <?php echo $penjualan_search->id_member->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_member"].options = <?php echo JsonEncode($penjualan_search->id_member->lookupOptions()) ?>;
	fpenjualansearch.autoSuggests["x_id_member"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenjualansearch.lists["x_id_klinik"] = <?php echo $penjualan_search->id_klinik->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_klinik"].options = <?php echo JsonEncode($penjualan_search->id_klinik->lookupOptions()) ?>;
	fpenjualansearch.lists["x_id_rmd"] = <?php echo $penjualan_search->id_rmd->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_rmd"].options = <?php echo JsonEncode($penjualan_search->id_rmd->lookupOptions()) ?>;
	fpenjualansearch.autoSuggests["x_id_rmd"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenjualansearch.lists["x_metode_pembayaran"] = <?php echo $penjualan_search->metode_pembayaran->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_metode_pembayaran"].options = <?php echo JsonEncode($penjualan_search->metode_pembayaran->options(FALSE, TRUE)) ?>;
	fpenjualansearch.lists["x_id_bank"] = <?php echo $penjualan_search->id_bank->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_bank"].options = <?php echo JsonEncode($penjualan_search->id_bank->lookupOptions()) ?>;
	fpenjualansearch.lists["x_id_kartu"] = <?php echo $penjualan_search->id_kartu->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_kartu"].options = <?php echo JsonEncode($penjualan_search->id_kartu->lookupOptions()) ?>;
	fpenjualansearch.lists["x_sales"] = <?php echo $penjualan_search->sales->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_sales"].options = <?php echo JsonEncode($penjualan_search->sales->lookupOptions()) ?>;
	fpenjualansearch.lists["x_dok_be_wajah"] = <?php echo $penjualan_search->dok_be_wajah->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_dok_be_wajah"].options = <?php echo JsonEncode($penjualan_search->dok_be_wajah->lookupOptions()) ?>;
	fpenjualansearch.lists["x_be_body"] = <?php echo $penjualan_search->be_body->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_be_body"].options = <?php echo JsonEncode($penjualan_search->be_body->lookupOptions()) ?>;
	fpenjualansearch.lists["x_medis"] = <?php echo $penjualan_search->medis->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_medis"].options = <?php echo JsonEncode($penjualan_search->medis->lookupOptions()) ?>;
	fpenjualansearch.lists["x_dokter"] = <?php echo $penjualan_search->dokter->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_dokter"].options = <?php echo JsonEncode($penjualan_search->dokter->lookupOptions()) ?>;
	fpenjualansearch.lists["x_id_kartubank"] = <?php echo $penjualan_search->id_kartubank->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_kartubank"].options = <?php echo JsonEncode($penjualan_search->id_kartubank->lookupOptions()) ?>;
	fpenjualansearch.lists["x_id_kas"] = <?php echo $penjualan_search->id_kas->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_id_kas"].options = <?php echo JsonEncode($penjualan_search->id_kas->lookupOptions()) ?>;
	fpenjualansearch.lists["x_status"] = <?php echo $penjualan_search->status->Lookup->toClientList($penjualan_search) ?>;
	fpenjualansearch.lists["x_status"].options = <?php echo JsonEncode($penjualan_search->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpenjualansearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penjualan_search->showPageHeader(); ?>
<?php
$penjualan_search->showMessage();
?>
<form name="fpenjualansearch" id="fpenjualansearch" class="<?php echo $penjualan_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$penjualan_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($penjualan_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id"><?php echo $penjualan_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id->cellAttributes() ?>>
			<span id="el_penjualan_id" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_search->id->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->id->EditValue ?>"<?php echo $penjualan_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label for="x_kode_penjualan" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_kode_penjualan"><?php echo $penjualan_search->kode_penjualan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_penjualan" id="z_kode_penjualan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->kode_penjualan->cellAttributes() ?>>
			<span id="el_penjualan_kode_penjualan" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="15" maxlength="20" placeholder="<?php echo HtmlEncode($penjualan_search->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->kode_penjualan->EditValue ?>"<?php echo $penjualan_search->kode_penjualan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_pelanggan"><?php echo $penjualan_search->id_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pelanggan" id="z_id_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_pelanggan->cellAttributes() ?>>
			<span id="el_penjualan_id_pelanggan" class="ew-search-field">
<?php
$onchange = $penjualan_search->id_pelanggan->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penjualan_search->id_pelanggan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_pelanggan">
	<input type="text" class="form-control" name="sv_x_id_pelanggan" id="sv_x_id_pelanggan" value="<?php echo RemoveHtml($penjualan_search->id_pelanggan->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($penjualan_search->id_pelanggan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penjualan_search->id_pelanggan->getPlaceHolder()) ?>"<?php echo $penjualan_search->id_pelanggan->editAttributes() ?>>
</span>
<input type="hidden" data-table="penjualan" data-field="x_id_pelanggan" data-value-separator="<?php echo $penjualan_search->id_pelanggan->displayValueSeparatorAttribute() ?>" name="x_id_pelanggan" id="x_id_pelanggan" value="<?php echo HtmlEncode($penjualan_search->id_pelanggan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenjualansearch"], function() {
	fpenjualansearch.createAutoSuggest({"id":"x_id_pelanggan","forceSelect":false});
});
</script>
<?php echo $penjualan_search->id_pelanggan->Lookup->getParamTag($penjualan_search, "p_x_id_pelanggan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_member->Visible) { // id_member ?>
	<div id="r_id_member" class="form-group row">
		<label class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_member"><?php echo $penjualan_search->id_member->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_member" id="z_id_member" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_member->cellAttributes() ?>>
			<span id="el_penjualan_id_member" class="ew-search-field">
<?php
$onchange = $penjualan_search->id_member->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penjualan_search->id_member->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_member">
	<input type="text" class="form-control" name="sv_x_id_member" id="sv_x_id_member" value="<?php echo RemoveHtml($penjualan_search->id_member->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_search->id_member->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penjualan_search->id_member->getPlaceHolder()) ?>"<?php echo $penjualan_search->id_member->editAttributes() ?>>
</span>
<input type="hidden" data-table="penjualan" data-field="x_id_member" data-value-separator="<?php echo $penjualan_search->id_member->displayValueSeparatorAttribute() ?>" name="x_id_member" id="x_id_member" value="<?php echo HtmlEncode($penjualan_search->id_member->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenjualansearch"], function() {
	fpenjualansearch.createAutoSuggest({"id":"x_id_member","forceSelect":false});
});
</script>
<?php echo $penjualan_search->id_member->Lookup->getParamTag($penjualan_search, "p_x_id_member") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->waktu->Visible) { // waktu ?>
	<div id="r_waktu" class="form-group row">
		<label for="x_waktu" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_waktu"><?php echo $penjualan_search->waktu->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_waktu" id="z_waktu" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->waktu->cellAttributes() ?>>
			<span id="el_penjualan_waktu" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_waktu" data-format="7" name="x_waktu" id="x_waktu" maxlength="19" placeholder="<?php echo HtmlEncode($penjualan_search->waktu->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->waktu->EditValue ?>"<?php echo $penjualan_search->waktu->editAttributes() ?>>
<?php if (!$penjualan_search->waktu->ReadOnly && !$penjualan_search->waktu->Disabled && !isset($penjualan_search->waktu->EditAttrs["readonly"]) && !isset($penjualan_search->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenjualansearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenjualansearch", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->diskon_persen->Visible) { // diskon_persen ?>
	<div id="r_diskon_persen" class="form-group row">
		<label for="x_diskon_persen" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_diskon_persen"><?php echo $penjualan_search->diskon_persen->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_diskon_persen" id="z_diskon_persen" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->diskon_persen->cellAttributes() ?>>
			<span id="el_penjualan_diskon_persen" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_diskon_persen" name="x_diskon_persen" id="x_diskon_persen" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($penjualan_search->diskon_persen->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->diskon_persen->EditValue ?>"<?php echo $penjualan_search->diskon_persen->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->diskon_rupiah->Visible) { // diskon_rupiah ?>
	<div id="r_diskon_rupiah" class="form-group row">
		<label for="x_diskon_rupiah" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_diskon_rupiah"><?php echo $penjualan_search->diskon_rupiah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_diskon_rupiah" id="z_diskon_rupiah" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->diskon_rupiah->cellAttributes() ?>>
			<span id="el_penjualan_diskon_rupiah" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_diskon_rupiah" name="x_diskon_rupiah" id="x_diskon_rupiah" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->diskon_rupiah->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->diskon_rupiah->EditValue ?>"<?php echo $penjualan_search->diskon_rupiah->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->ppn->Visible) { // ppn ?>
	<div id="r_ppn" class="form-group row">
		<label for="x_ppn" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_ppn"><?php echo $penjualan_search->ppn->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ppn" id="z_ppn" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->ppn->cellAttributes() ?>>
			<span id="el_penjualan_ppn" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_ppn" name="x_ppn" id="x_ppn" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->ppn->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->ppn->EditValue ?>"<?php echo $penjualan_search->ppn->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label for="x_total" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_total"><?php echo $penjualan_search->total->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total" id="z_total" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->total->cellAttributes() ?>>
			<span id="el_penjualan_total" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_total" name="x_total" id="x_total" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->total->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->total->EditValue ?>"<?php echo $penjualan_search->total->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->bayar->Visible) { // bayar ?>
	<div id="r_bayar" class="form-group row">
		<label for="x_bayar" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_bayar"><?php echo $penjualan_search->bayar->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bayar" id="z_bayar" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->bayar->cellAttributes() ?>>
			<span id="el_penjualan_bayar" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_bayar" name="x_bayar" id="x_bayar" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->bayar->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->bayar->EditValue ?>"<?php echo $penjualan_search->bayar->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
	<div id="r_bayar_non_tunai" class="form-group row">
		<label for="x_bayar_non_tunai" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_bayar_non_tunai"><?php echo $penjualan_search->bayar_non_tunai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bayar_non_tunai" id="z_bayar_non_tunai" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->bayar_non_tunai->cellAttributes() ?>>
			<span id="el_penjualan_bayar_non_tunai" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_bayar_non_tunai" name="x_bayar_non_tunai" id="x_bayar_non_tunai" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->bayar_non_tunai->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->bayar_non_tunai->EditValue ?>"<?php echo $penjualan_search->bayar_non_tunai->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<div id="r_total_non_tunai_charge" class="form-group row">
		<label for="x_total_non_tunai_charge" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_total_non_tunai_charge"><?php echo $penjualan_search->total_non_tunai_charge->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_non_tunai_charge" id="z_total_non_tunai_charge" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->total_non_tunai_charge->cellAttributes() ?>>
			<span id="el_penjualan_total_non_tunai_charge" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_total_non_tunai_charge" name="x_total_non_tunai_charge" id="x_total_non_tunai_charge" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->total_non_tunai_charge->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->total_non_tunai_charge->EditValue ?>"<?php echo $penjualan_search->total_non_tunai_charge->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label for="x_keterangan" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_keterangan"><?php echo $penjualan_search->keterangan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keterangan" id="z_keterangan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->keterangan->cellAttributes() ?>>
			<span id="el_penjualan_keterangan" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" maxlength="255" placeholder="<?php echo HtmlEncode($penjualan_search->keterangan->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->keterangan->EditValue ?>"<?php echo $penjualan_search->keterangan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_klinik"><?php echo $penjualan_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_klinik->cellAttributes() ?>>
			<span id="el_penjualan_id_klinik" class="ew-search-field">
<?php $penjualan_search->id_klinik->EditAttrs->prepend("onclick", "ew.updateOptions.call(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($penjualan_search->id_klinik->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $penjualan_search->id_klinik->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_id_klinik" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $penjualan_search->id_klinik->radioButtonListHtml(TRUE, "x_id_klinik") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_id_klinik" class="ew-template"><input type="radio" class="custom-control-input" data-table="penjualan" data-field="x_id_klinik" data-value-separator="<?php echo $penjualan_search->id_klinik->displayValueSeparatorAttribute() ?>" name="x_id_klinik" id="x_id_klinik" value="{value}"<?php echo $penjualan_search->id_klinik->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$penjualan_search->id_klinik->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $penjualan_search->id_klinik->Lookup->getParamTag($penjualan_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_rmd->Visible) { // id_rmd ?>
	<div id="r_id_rmd" class="form-group row">
		<label class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_rmd"><?php echo $penjualan_search->id_rmd->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_rmd" id="z_id_rmd" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_rmd->cellAttributes() ?>>
			<span id="el_penjualan_id_rmd" class="ew-search-field">
<?php
$onchange = $penjualan_search->id_rmd->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penjualan_search->id_rmd->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_rmd">
	<input type="text" class="form-control" name="sv_x_id_rmd" id="sv_x_id_rmd" value="<?php echo RemoveHtml($penjualan_search->id_rmd->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_search->id_rmd->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penjualan_search->id_rmd->getPlaceHolder()) ?>"<?php echo $penjualan_search->id_rmd->editAttributes() ?>>
</span>
<input type="hidden" data-table="penjualan" data-field="x_id_rmd" data-value-separator="<?php echo $penjualan_search->id_rmd->displayValueSeparatorAttribute() ?>" name="x_id_rmd" id="x_id_rmd" value="<?php echo HtmlEncode($penjualan_search->id_rmd->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpenjualansearch"], function() {
	fpenjualansearch.createAutoSuggest({"id":"x_id_rmd","forceSelect":true});
});
</script>
<?php echo $penjualan_search->id_rmd->Lookup->getParamTag($penjualan_search, "p_x_id_rmd") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<div id="r_metode_pembayaran" class="form-group row">
		<label for="x_metode_pembayaran" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_metode_pembayaran"><?php echo $penjualan_search->metode_pembayaran->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_metode_pembayaran" id="z_metode_pembayaran" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->metode_pembayaran->cellAttributes() ?>>
			<span id="el_penjualan_metode_pembayaran" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_metode_pembayaran" data-value-separator="<?php echo $penjualan_search->metode_pembayaran->displayValueSeparatorAttribute() ?>" id="x_metode_pembayaran" name="x_metode_pembayaran"<?php echo $penjualan_search->metode_pembayaran->editAttributes() ?>>
			<?php echo $penjualan_search->metode_pembayaran->selectOptionListHtml("x_metode_pembayaran") ?>
		</select>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_bank->Visible) { // id_bank ?>
	<div id="r_id_bank" class="form-group row">
		<label for="x_id_bank" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_bank"><?php echo $penjualan_search->id_bank->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_bank" id="z_id_bank" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_bank->cellAttributes() ?>>
			<span id="el_penjualan_id_bank" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_bank" data-value-separator="<?php echo $penjualan_search->id_bank->displayValueSeparatorAttribute() ?>" id="x_id_bank" name="x_id_bank"<?php echo $penjualan_search->id_bank->editAttributes() ?>>
			<?php echo $penjualan_search->id_bank->selectOptionListHtml("x_id_bank") ?>
		</select>
</div>
<?php echo $penjualan_search->id_bank->Lookup->getParamTag($penjualan_search, "p_x_id_bank") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_kartu->Visible) { // id_kartu ?>
	<div id="r_id_kartu" class="form-group row">
		<label for="x_id_kartu" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_kartu"><?php echo $penjualan_search->id_kartu->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kartu" id="z_id_kartu" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_kartu->cellAttributes() ?>>
			<span id="el_penjualan_id_kartu" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_kartu" data-value-separator="<?php echo $penjualan_search->id_kartu->displayValueSeparatorAttribute() ?>" id="x_id_kartu" name="x_id_kartu"<?php echo $penjualan_search->id_kartu->editAttributes() ?>>
			<?php echo $penjualan_search->id_kartu->selectOptionListHtml("x_id_kartu") ?>
		</select>
</div>
<?php echo $penjualan_search->id_kartu->Lookup->getParamTag($penjualan_search, "p_x_id_kartu") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->sales->Visible) { // sales ?>
	<div id="r_sales" class="form-group row">
		<label for="x_sales" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_sales"><?php echo $penjualan_search->sales->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_sales" id="z_sales" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->sales->cellAttributes() ?>>
			<span id="el_penjualan_sales" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_sales" data-value-separator="<?php echo $penjualan_search->sales->displayValueSeparatorAttribute() ?>" id="x_sales" name="x_sales"<?php echo $penjualan_search->sales->editAttributes() ?>>
			<?php echo $penjualan_search->sales->selectOptionListHtml("x_sales") ?>
		</select>
</div>
<?php echo $penjualan_search->sales->Lookup->getParamTag($penjualan_search, "p_x_sales") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->dok_be_wajah->Visible) { // dok_be_wajah ?>
	<div id="r_dok_be_wajah" class="form-group row">
		<label for="x_dok_be_wajah" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_dok_be_wajah"><?php echo $penjualan_search->dok_be_wajah->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_dok_be_wajah" id="z_dok_be_wajah" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->dok_be_wajah->cellAttributes() ?>>
			<span id="el_penjualan_dok_be_wajah" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_dok_be_wajah" data-value-separator="<?php echo $penjualan_search->dok_be_wajah->displayValueSeparatorAttribute() ?>" id="x_dok_be_wajah" name="x_dok_be_wajah"<?php echo $penjualan_search->dok_be_wajah->editAttributes() ?>>
			<?php echo $penjualan_search->dok_be_wajah->selectOptionListHtml("x_dok_be_wajah") ?>
		</select>
</div>
<?php echo $penjualan_search->dok_be_wajah->Lookup->getParamTag($penjualan_search, "p_x_dok_be_wajah") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->be_body->Visible) { // be_body ?>
	<div id="r_be_body" class="form-group row">
		<label for="x_be_body" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_be_body"><?php echo $penjualan_search->be_body->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_be_body" id="z_be_body" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->be_body->cellAttributes() ?>>
			<span id="el_penjualan_be_body" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_be_body" data-value-separator="<?php echo $penjualan_search->be_body->displayValueSeparatorAttribute() ?>" id="x_be_body" name="x_be_body"<?php echo $penjualan_search->be_body->editAttributes() ?>>
			<?php echo $penjualan_search->be_body->selectOptionListHtml("x_be_body") ?>
		</select>
</div>
<?php echo $penjualan_search->be_body->Lookup->getParamTag($penjualan_search, "p_x_be_body") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->medis->Visible) { // medis ?>
	<div id="r_medis" class="form-group row">
		<label for="x_medis" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_medis"><?php echo $penjualan_search->medis->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_medis" id="z_medis" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->medis->cellAttributes() ?>>
			<span id="el_penjualan_medis" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_medis" data-value-separator="<?php echo $penjualan_search->medis->displayValueSeparatorAttribute() ?>" id="x_medis" name="x_medis"<?php echo $penjualan_search->medis->editAttributes() ?>>
			<?php echo $penjualan_search->medis->selectOptionListHtml("x_medis") ?>
		</select>
</div>
<?php echo $penjualan_search->medis->Lookup->getParamTag($penjualan_search, "p_x_medis") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->dokter->Visible) { // dokter ?>
	<div id="r_dokter" class="form-group row">
		<label for="x_dokter" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_dokter"><?php echo $penjualan_search->dokter->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_dokter" id="z_dokter" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->dokter->cellAttributes() ?>>
			<span id="el_penjualan_dokter" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_dokter" data-value-separator="<?php echo $penjualan_search->dokter->displayValueSeparatorAttribute() ?>" id="x_dokter" name="x_dokter"<?php echo $penjualan_search->dokter->editAttributes() ?>>
			<?php echo $penjualan_search->dokter->selectOptionListHtml("x_dokter") ?>
		</select>
</div>
<?php echo $penjualan_search->dokter->Lookup->getParamTag($penjualan_search, "p_x_dokter") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_kartubank->Visible) { // id_kartubank ?>
	<div id="r_id_kartubank" class="form-group row">
		<label for="x_id_kartubank" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_kartubank"><?php echo $penjualan_search->id_kartubank->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kartubank" id="z_id_kartubank" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_kartubank->cellAttributes() ?>>
			<span id="el_penjualan_id_kartubank" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_kartubank" data-value-separator="<?php echo $penjualan_search->id_kartubank->displayValueSeparatorAttribute() ?>" id="x_id_kartubank" name="x_id_kartubank"<?php echo $penjualan_search->id_kartubank->editAttributes() ?>>
			<?php echo $penjualan_search->id_kartubank->selectOptionListHtml("x_id_kartubank") ?>
		</select>
</div>
<?php echo $penjualan_search->id_kartubank->Lookup->getParamTag($penjualan_search, "p_x_id_kartubank") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label for="x_id_kas" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_id_kas"><?php echo $penjualan_search->id_kas->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_kas" id="z_id_kas" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->id_kas->cellAttributes() ?>>
			<span id="el_penjualan_id_kas" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_kas" data-value-separator="<?php echo $penjualan_search->id_kas->displayValueSeparatorAttribute() ?>" id="x_id_kas" name="x_id_kas"<?php echo $penjualan_search->id_kas->editAttributes() ?>>
			<?php echo $penjualan_search->id_kas->selectOptionListHtml("x_id_kas") ?>
		</select>
</div>
<?php echo $penjualan_search->id_kas->Lookup->getParamTag($penjualan_search, "p_x_id_kas") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->charge->Visible) { // charge ?>
	<div id="r_charge" class="form-group row">
		<label for="x_charge" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_charge"><?php echo $penjualan_search->charge->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_charge" id="z_charge" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->charge->cellAttributes() ?>>
			<span id="el_penjualan_charge" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_charge" name="x_charge" id="x_charge" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->charge->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->charge->EditValue ?>"<?php echo $penjualan_search->charge->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->klaim_poin->Visible) { // klaim_poin ?>
	<div id="r_klaim_poin" class="form-group row">
		<label for="x_klaim_poin" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_klaim_poin"><?php echo $penjualan_search->klaim_poin->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_klaim_poin" id="z_klaim_poin" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->klaim_poin->cellAttributes() ?>>
			<span id="el_penjualan_klaim_poin" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_klaim_poin" name="x_klaim_poin" id="x_klaim_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->klaim_poin->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->klaim_poin->EditValue ?>"<?php echo $penjualan_search->klaim_poin->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<div id="r_total_penukaran_poin" class="form-group row">
		<label for="x_total_penukaran_poin" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_total_penukaran_poin"><?php echo $penjualan_search->total_penukaran_poin->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_penukaran_poin" id="z_total_penukaran_poin" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->total_penukaran_poin->cellAttributes() ?>>
			<span id="el_penjualan_total_penukaran_poin" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_total_penukaran_poin" name="x_total_penukaran_poin" id="x_total_penukaran_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->total_penukaran_poin->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->total_penukaran_poin->EditValue ?>"<?php echo $penjualan_search->total_penukaran_poin->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->ongkir->Visible) { // ongkir ?>
	<div id="r_ongkir" class="form-group row">
		<label for="x_ongkir" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_ongkir"><?php echo $penjualan_search->ongkir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ongkir" id="z_ongkir" value="=">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->ongkir->cellAttributes() ?>>
			<span id="el_penjualan_ongkir" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_ongkir" name="x_ongkir" id="x_ongkir" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_search->ongkir->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->ongkir->EditValue ?>"<?php echo $penjualan_search->ongkir->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->_action->Visible) { // action ?>
	<div id="r__action" class="form-group row">
		<label for="x__action" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan__action"><?php echo $penjualan_search->_action->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__action" id="z__action" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->_action->cellAttributes() ?>>
			<span id="el_penjualan__action" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penjualan_search->_action->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->_action->EditValue ?>"<?php echo $penjualan_search->_action->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_status"><?php echo $penjualan_search->status->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_status" id="z_status" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->status->cellAttributes() ?>>
			<span id="el_penjualan_status" class="ew-search-field">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="penjualan" data-field="x_status" data-value-separator="<?php echo $penjualan_search->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $penjualan_search->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $penjualan_search->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($penjualan_search->status_void->Visible) { // status_void ?>
	<div id="r_status_void" class="form-group row">
		<label for="x_status_void" class="<?php echo $penjualan_search->LeftColumnClass ?>"><span id="elh_penjualan_status_void"><?php echo $penjualan_search->status_void->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_status_void" id="z_status_void" value="LIKE">
</span>
		</label>
		<div class="<?php echo $penjualan_search->RightColumnClass ?>"><div <?php echo $penjualan_search->status_void->cellAttributes() ?>>
			<span id="el_penjualan_status_void" class="ew-search-field">
<input type="text" data-table="penjualan" data-field="x_status_void" name="x_status_void" id="x_status_void" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($penjualan_search->status_void->getPlaceHolder()) ?>" value="<?php echo $penjualan_search->status_void->EditValue ?>"<?php echo $penjualan_search->status_void->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$penjualan_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penjualan_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penjualan_search->showPageFooter();
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
$penjualan_search->terminate();
?>