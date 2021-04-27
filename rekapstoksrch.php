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
$rekapstok_search = new rekapstok_search();

// Run the page
$rekapstok_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekapstok_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frekapstoksearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($rekapstok_search->IsModal) { ?>
	frekapstoksearch = currentAdvancedSearchForm = new ew.Form("frekapstoksearch", "search");
	<?php } else { ?>
	frekapstoksearch = currentForm = new ew.Form("frekapstoksearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	frekapstoksearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_rekapstok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->id_rekapstok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_id_barang");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->id_barang->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->tanggal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_masuk_saldoawal");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->masuk_saldoawal->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_masuk_beli");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->masuk_beli->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_masuk_penyesuaian");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->masuk_penyesuaian->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_keluar_jual");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->keluar_jual->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_keluar_perpindahan");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->keluar_perpindahan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_keluar_penyesuaian");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->keluar_penyesuaian->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_keluar_pengembalian");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->keluar_pengembalian->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_stok");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekapstok_search->stok->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	frekapstoksearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frekapstoksearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frekapstoksearch.lists["x_id_barang"] = <?php echo $rekapstok_search->id_barang->Lookup->toClientList($rekapstok_search) ?>;
	frekapstoksearch.lists["x_id_barang"].options = <?php echo JsonEncode($rekapstok_search->id_barang->lookupOptions()) ?>;
	frekapstoksearch.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("frekapstoksearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rekapstok_search->showPageHeader(); ?>
<?php
$rekapstok_search->showMessage();
?>
<form name="frekapstoksearch" id="frekapstoksearch" class="<?php echo $rekapstok_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekapstok">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$rekapstok_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($rekapstok_search->id_rekapstok->Visible) { // id_rekapstok ?>
	<div id="r_id_rekapstok" class="form-group row">
		<label for="x_id_rekapstok" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_id_rekapstok"><?php echo $rekapstok_search->id_rekapstok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_rekapstok" id="z_id_rekapstok" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->id_rekapstok->cellAttributes() ?>>
			<span id="el_rekapstok_id_rekapstok" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_id_rekapstok" name="x_id_rekapstok" id="x_id_rekapstok" maxlength="11" placeholder="<?php echo HtmlEncode($rekapstok_search->id_rekapstok->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->id_rekapstok->EditValue ?>"<?php echo $rekapstok_search->id_rekapstok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_id_barang"><?php echo $rekapstok_search->id_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_barang" id="z_id_barang" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->id_barang->cellAttributes() ?>>
			<span id="el_rekapstok_id_barang" class="ew-search-field">
<?php
$onchange = $rekapstok_search->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekapstok_search->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($rekapstok_search->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($rekapstok_search->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekapstok_search->id_barang->getPlaceHolder()) ?>"<?php echo $rekapstok_search->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekapstok_search->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($rekapstok_search->id_barang->ReadOnly || $rekapstok_search->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="rekapstok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekapstok_search->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($rekapstok_search->id_barang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekapstoksearch"], function() {
	frekapstoksearch.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $rekapstok_search->id_barang->Lookup->getParamTag($rekapstok_search, "p_x_id_barang") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_tanggal"><?php echo $rekapstok_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->tanggal->cellAttributes() ?>>
			<span id="el_rekapstok_tanggal" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($rekapstok_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->tanggal->EditValue ?>"<?php echo $rekapstok_search->tanggal->editAttributes() ?>>
<?php if (!$rekapstok_search->tanggal->ReadOnly && !$rekapstok_search->tanggal->Disabled && !isset($rekapstok_search->tanggal->EditAttrs["readonly"]) && !isset($rekapstok_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frekapstoksearch", "datetimepicker"], function() {
	ew.createDateTimePicker("frekapstoksearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
	<div id="r_masuk_saldoawal" class="form-group row">
		<label for="x_masuk_saldoawal" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_masuk_saldoawal"><?php echo $rekapstok_search->masuk_saldoawal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_masuk_saldoawal" id="z_masuk_saldoawal" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->masuk_saldoawal->cellAttributes() ?>>
			<span id="el_rekapstok_masuk_saldoawal" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_masuk_saldoawal" name="x_masuk_saldoawal" id="x_masuk_saldoawal" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->masuk_saldoawal->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->masuk_saldoawal->EditValue ?>"<?php echo $rekapstok_search->masuk_saldoawal->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->masuk_beli->Visible) { // masuk_beli ?>
	<div id="r_masuk_beli" class="form-group row">
		<label for="x_masuk_beli" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_masuk_beli"><?php echo $rekapstok_search->masuk_beli->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_masuk_beli" id="z_masuk_beli" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->masuk_beli->cellAttributes() ?>>
			<span id="el_rekapstok_masuk_beli" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_masuk_beli" name="x_masuk_beli" id="x_masuk_beli" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->masuk_beli->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->masuk_beli->EditValue ?>"<?php echo $rekapstok_search->masuk_beli->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<div id="r_masuk_penyesuaian" class="form-group row">
		<label for="x_masuk_penyesuaian" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_masuk_penyesuaian"><?php echo $rekapstok_search->masuk_penyesuaian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_masuk_penyesuaian" id="z_masuk_penyesuaian" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->masuk_penyesuaian->cellAttributes() ?>>
			<span id="el_rekapstok_masuk_penyesuaian" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_masuk_penyesuaian" name="x_masuk_penyesuaian" id="x_masuk_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->masuk_penyesuaian->EditValue ?>"<?php echo $rekapstok_search->masuk_penyesuaian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->keluar_jual->Visible) { // keluar_jual ?>
	<div id="r_keluar_jual" class="form-group row">
		<label for="x_keluar_jual" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_keluar_jual"><?php echo $rekapstok_search->keluar_jual->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_keluar_jual" id="z_keluar_jual" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->keluar_jual->cellAttributes() ?>>
			<span id="el_rekapstok_keluar_jual" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_keluar_jual" name="x_keluar_jual" id="x_keluar_jual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->keluar_jual->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->keluar_jual->EditValue ?>"<?php echo $rekapstok_search->keluar_jual->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
	<div id="r_keluar_perpindahan" class="form-group row">
		<label for="x_keluar_perpindahan" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_keluar_perpindahan"><?php echo $rekapstok_search->keluar_perpindahan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_keluar_perpindahan" id="z_keluar_perpindahan" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->keluar_perpindahan->cellAttributes() ?>>
			<span id="el_rekapstok_keluar_perpindahan" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_keluar_perpindahan" name="x_keluar_perpindahan" id="x_keluar_perpindahan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->keluar_perpindahan->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->keluar_perpindahan->EditValue ?>"<?php echo $rekapstok_search->keluar_perpindahan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<div id="r_keluar_penyesuaian" class="form-group row">
		<label for="x_keluar_penyesuaian" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_keluar_penyesuaian"><?php echo $rekapstok_search->keluar_penyesuaian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_keluar_penyesuaian" id="z_keluar_penyesuaian" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->keluar_penyesuaian->cellAttributes() ?>>
			<span id="el_rekapstok_keluar_penyesuaian" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_keluar_penyesuaian" name="x_keluar_penyesuaian" id="x_keluar_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->keluar_penyesuaian->EditValue ?>"<?php echo $rekapstok_search->keluar_penyesuaian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
	<div id="r_keluar_pengembalian" class="form-group row">
		<label for="x_keluar_pengembalian" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_keluar_pengembalian"><?php echo $rekapstok_search->keluar_pengembalian->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_keluar_pengembalian" id="z_keluar_pengembalian" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->keluar_pengembalian->cellAttributes() ?>>
			<span id="el_rekapstok_keluar_pengembalian" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_keluar_pengembalian" name="x_keluar_pengembalian" id="x_keluar_pengembalian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->keluar_pengembalian->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->keluar_pengembalian->EditValue ?>"<?php echo $rekapstok_search->keluar_pengembalian->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_search->stok->Visible) { // stok ?>
	<div id="r_stok" class="form-group row">
		<label for="x_stok" class="<?php echo $rekapstok_search->LeftColumnClass ?>"><span id="elh_rekapstok_stok"><?php echo $rekapstok_search->stok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_stok" id="z_stok" value="=">
</span>
		</label>
		<div class="<?php echo $rekapstok_search->RightColumnClass ?>"><div <?php echo $rekapstok_search->stok->cellAttributes() ?>>
			<span id="el_rekapstok_stok" class="ew-search-field">
<input type="text" data-table="rekapstok" data-field="x_stok" name="x_stok" id="x_stok" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_search->stok->getPlaceHolder()) ?>" value="<?php echo $rekapstok_search->stok->EditValue ?>"<?php echo $rekapstok_search->stok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rekapstok_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rekapstok_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rekapstok_search->showPageFooter();
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
$rekapstok_search->terminate();
?>