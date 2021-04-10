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
$transaksi_komisi_search = new transaksi_komisi_search();

// Run the page
$transaksi_komisi_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaksi_komisi_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftransaksi_komisisearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($transaksi_komisi_search->IsModal) { ?>
	ftransaksi_komisisearch = currentAdvancedSearchForm = new ew.Form("ftransaksi_komisisearch", "search");
	<?php } else { ?>
	ftransaksi_komisisearch = currentForm = new ew.Form("ftransaksi_komisisearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	ftransaksi_komisisearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_jabatan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->id_jabatan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->tgl->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_qty");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->qty->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_subtotal");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->subtotal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_komisi");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->komisi->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total_komisi");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($transaksi_komisi_search->total_komisi->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	ftransaksi_komisisearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftransaksi_komisisearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	ftransaksi_komisisearch.lists["x_id_pegawai"] = <?php echo $transaksi_komisi_search->id_pegawai->Lookup->toClientList($transaksi_komisi_search) ?>;
	ftransaksi_komisisearch.lists["x_id_pegawai"].options = <?php echo JsonEncode($transaksi_komisi_search->id_pegawai->lookupOptions()) ?>;
	ftransaksi_komisisearch.lists["x_id_jabatan"] = <?php echo $transaksi_komisi_search->id_jabatan->Lookup->toClientList($transaksi_komisi_search) ?>;
	ftransaksi_komisisearch.lists["x_id_jabatan"].options = <?php echo JsonEncode($transaksi_komisi_search->id_jabatan->lookupOptions()) ?>;
	ftransaksi_komisisearch.autoSuggests["x_id_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	ftransaksi_komisisearch.lists["x_id_barang"] = <?php echo $transaksi_komisi_search->id_barang->Lookup->toClientList($transaksi_komisi_search) ?>;
	ftransaksi_komisisearch.lists["x_id_barang"].options = <?php echo JsonEncode($transaksi_komisi_search->id_barang->lookupOptions()) ?>;
	ftransaksi_komisisearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("ftransaksi_komisisearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $transaksi_komisi_search->showPageHeader(); ?>
<?php
$transaksi_komisi_search->showMessage();
?>
<form name="ftransaksi_komisisearch" id="ftransaksi_komisisearch" class="<?php echo $transaksi_komisi_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaksi_komisi">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$transaksi_komisi_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($transaksi_komisi_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_id"><?php echo $transaksi_komisi_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->id->cellAttributes() ?>>
			<span id="el_transaksi_komisi_id" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->id->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->id->EditValue ?>"<?php echo $transaksi_komisi_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label for="x_id_pegawai" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_id_pegawai"><?php echo $transaksi_komisi_search->id_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pegawai" id="z_id_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->id_pegawai->cellAttributes() ?>>
			<span id="el_transaksi_komisi_id_pegawai" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="transaksi_komisi" data-field="x_id_pegawai" data-value-separator="<?php echo $transaksi_komisi_search->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $transaksi_komisi_search->id_pegawai->editAttributes() ?>>
			<?php echo $transaksi_komisi_search->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $transaksi_komisi_search->id_pegawai->Lookup->getParamTag($transaksi_komisi_search, "p_x_id_pegawai") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->id_jabatan->Visible) { // id_jabatan ?>
	<div id="r_id_jabatan" class="form-group row">
		<label class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_id_jabatan"><?php echo $transaksi_komisi_search->id_jabatan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_jabatan" id="z_id_jabatan" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->id_jabatan->cellAttributes() ?>>
			<span id="el_transaksi_komisi_id_jabatan" class="ew-search-field">
<?php
$onchange = $transaksi_komisi_search->id_jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$transaksi_komisi_search->id_jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_jabatan">
	<input type="text" class="form-control" name="sv_x_id_jabatan" id="sv_x_id_jabatan" value="<?php echo RemoveHtml($transaksi_komisi_search->id_jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->id_jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaksi_komisi_search->id_jabatan->getPlaceHolder()) ?>"<?php echo $transaksi_komisi_search->id_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="transaksi_komisi" data-field="x_id_jabatan" data-value-separator="<?php echo $transaksi_komisi_search->id_jabatan->displayValueSeparatorAttribute() ?>" name="x_id_jabatan" id="x_id_jabatan" value="<?php echo HtmlEncode($transaksi_komisi_search->id_jabatan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ftransaksi_komisisearch"], function() {
	ftransaksi_komisisearch.createAutoSuggest({"id":"x_id_jabatan","forceSelect":false});
});
</script>
<?php echo $transaksi_komisi_search->id_jabatan->Lookup->getParamTag($transaksi_komisi_search, "p_x_id_jabatan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label for="x_kode_penjualan" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_kode_penjualan"><?php echo $transaksi_komisi_search->kode_penjualan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kode_penjualan" id="z_kode_penjualan" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->kode_penjualan->cellAttributes() ?>>
			<span id="el_transaksi_komisi_kode_penjualan" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->kode_penjualan->EditValue ?>"<?php echo $transaksi_komisi_search->kode_penjualan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label for="x_tgl" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_tgl"><?php echo $transaksi_komisi_search->tgl->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl" id="z_tgl" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->tgl->cellAttributes() ?>>
			<span id="el_transaksi_komisi_tgl" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->tgl->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->tgl->EditValue ?>"<?php echo $transaksi_komisi_search->tgl->editAttributes() ?>>
<?php if (!$transaksi_komisi_search->tgl->ReadOnly && !$transaksi_komisi_search->tgl->Disabled && !isset($transaksi_komisi_search->tgl->EditAttrs["readonly"]) && !isset($transaksi_komisi_search->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftransaksi_komisisearch", "datetimepicker"], function() {
	ew.createDateTimePicker("ftransaksi_komisisearch", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_id_barang"><?php echo $transaksi_komisi_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->id_barang->cellAttributes() ?>>
			<span id="el_transaksi_komisi_id_barang" class="ew-search-field">
<?php
$onchange = $transaksi_komisi_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$transaksi_komisi_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($transaksi_komisi_search->id_barang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($transaksi_komisi_search->id_barang->getPlaceHolder()) ?>"<?php echo $transaksi_komisi_search->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="transaksi_komisi" data-field="x_id_barang" data-value-separator="<?php echo $transaksi_komisi_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($transaksi_komisi_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["ftransaksi_komisisearch"], function() {
	ftransaksi_komisisearch.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $transaksi_komisi_search->id_barang->Lookup->getParamTag($transaksi_komisi_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label for="x_qty" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_qty"><?php echo $transaksi_komisi_search->qty->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_qty" id="z_qty" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->qty->cellAttributes() ?>>
			<span id="el_transaksi_komisi_qty" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_qty" name="x_qty" id="x_qty" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->qty->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->qty->EditValue ?>"<?php echo $transaksi_komisi_search->qty->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->subtotal->Visible) { // subtotal ?>
	<div id="r_subtotal" class="form-group row">
		<label for="x_subtotal" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_subtotal"><?php echo $transaksi_komisi_search->subtotal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_subtotal" id="z_subtotal" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->subtotal->cellAttributes() ?>>
			<span id="el_transaksi_komisi_subtotal" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_subtotal" name="x_subtotal" id="x_subtotal" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->subtotal->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->subtotal->EditValue ?>"<?php echo $transaksi_komisi_search->subtotal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->jenis_komisi->Visible) { // jenis_komisi ?>
	<div id="r_jenis_komisi" class="form-group row">
		<label for="x_jenis_komisi" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_jenis_komisi"><?php echo $transaksi_komisi_search->jenis_komisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_komisi" id="z_jenis_komisi" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->jenis_komisi->cellAttributes() ?>>
			<span id="el_transaksi_komisi_jenis_komisi" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_jenis_komisi" name="x_jenis_komisi" id="x_jenis_komisi" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->jenis_komisi->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->jenis_komisi->EditValue ?>"<?php echo $transaksi_komisi_search->jenis_komisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->komisi->Visible) { // komisi ?>
	<div id="r_komisi" class="form-group row">
		<label for="x_komisi" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_komisi"><?php echo $transaksi_komisi_search->komisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_komisi" id="z_komisi" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->komisi->cellAttributes() ?>>
			<span id="el_transaksi_komisi_komisi" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_komisi" name="x_komisi" id="x_komisi" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->komisi->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->komisi->EditValue ?>"<?php echo $transaksi_komisi_search->komisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($transaksi_komisi_search->total_komisi->Visible) { // total_komisi ?>
	<div id="r_total_komisi" class="form-group row">
		<label for="x_total_komisi" class="<?php echo $transaksi_komisi_search->LeftColumnClass ?>"><span id="elh_transaksi_komisi_total_komisi"><?php echo $transaksi_komisi_search->total_komisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_komisi" id="z_total_komisi" value="=">
</span>
		</label>
		<div class="<?php echo $transaksi_komisi_search->RightColumnClass ?>"><div <?php echo $transaksi_komisi_search->total_komisi->cellAttributes() ?>>
			<span id="el_transaksi_komisi_total_komisi" class="ew-search-field">
<input type="text" data-table="transaksi_komisi" data-field="x_total_komisi" name="x_total_komisi" id="x_total_komisi" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($transaksi_komisi_search->total_komisi->getPlaceHolder()) ?>" value="<?php echo $transaksi_komisi_search->total_komisi->EditValue ?>"<?php echo $transaksi_komisi_search->total_komisi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$transaksi_komisi_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $transaksi_komisi_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$transaksi_komisi_search->showPageFooter();
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
$transaksi_komisi_search->terminate();
?>