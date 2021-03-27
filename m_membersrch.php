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
$m_member_search = new m_member_search();

// Run the page
$m_member_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_member_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_membersearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($m_member_search->IsModal) { ?>
	fm_membersearch = currentAdvancedSearchForm = new ew.Form("fm_membersearch", "search");
	<?php } else { ?>
	fm_membersearch = currentForm = new ew.Form("fm_membersearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fm_membersearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tgl_mulai");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_member_search->tgl_mulai->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_poin_member");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_member_search->poin_member->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tgl_awal_transaksi");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_member_search->tgl_awal_transaksi->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total_akumulasi");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_member_search->total_akumulasi->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_membersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_membersearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_membersearch.lists["x_id_klinik"] = <?php echo $m_member_search->id_klinik->Lookup->toClientList($m_member_search) ?>;
	fm_membersearch.lists["x_id_klinik"].options = <?php echo JsonEncode($m_member_search->id_klinik->lookupOptions()) ?>;
	fm_membersearch.lists["x_id_pelanggan"] = <?php echo $m_member_search->id_pelanggan->Lookup->toClientList($m_member_search) ?>;
	fm_membersearch.lists["x_id_pelanggan"].options = <?php echo JsonEncode($m_member_search->id_pelanggan->lookupOptions()) ?>;
	fm_membersearch.lists["x_jenis_member"] = <?php echo $m_member_search->jenis_member->Lookup->toClientList($m_member_search) ?>;
	fm_membersearch.lists["x_jenis_member"].options = <?php echo JsonEncode($m_member_search->jenis_member->lookupOptions()) ?>;
	loadjs.done("fm_membersearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_member_search->showPageHeader(); ?>
<?php
$m_member_search->showMessage();
?>
<form name="fm_membersearch" id="fm_membersearch" class="<?php echo $m_member_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_member">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$m_member_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($m_member_search->kode_member->Visible) { // kode_member ?>
	<div id="r_kode_member" class="form-group row">
		<label for="x_kode_member" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_kode_member"><?php echo $m_member_search->kode_member->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_member" id="z_kode_member" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->kode_member->cellAttributes() ?>>
			<span id="el_m_member_kode_member" class="ew-search-field">
<input type="text" data-table="m_member" data-field="x_kode_member" name="x_kode_member" id="x_kode_member" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_member_search->kode_member->getPlaceHolder()) ?>" value="<?php echo $m_member_search->kode_member->EditValue ?>"<?php echo $m_member_search->kode_member->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_id_klinik"><?php echo $m_member_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->id_klinik->cellAttributes() ?>>
			<span id="el_m_member_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_member" data-field="x_id_klinik" data-value-separator="<?php echo $m_member_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_member_search->id_klinik->editAttributes() ?>>
			<?php echo $m_member_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_member_search->id_klinik->Lookup->getParamTag($m_member_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label for="x_id_pelanggan" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_id_pelanggan"><?php echo $m_member_search->id_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pelanggan" id="z_id_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->id_pelanggan->cellAttributes() ?>>
			<span id="el_m_member_id_pelanggan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_pelanggan"><?php echo EmptyValue(strval($m_member_search->id_pelanggan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_member_search->id_pelanggan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_member_search->id_pelanggan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_member_search->id_pelanggan->ReadOnly || $m_member_search->id_pelanggan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_pelanggan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_member_search->id_pelanggan->Lookup->getParamTag($m_member_search, "p_x_id_pelanggan") ?>
<input type="hidden" data-table="m_member" data-field="x_id_pelanggan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_member_search->id_pelanggan->displayValueSeparatorAttribute() ?>" name="x_id_pelanggan" id="x_id_pelanggan" value="<?php echo $m_member_search->id_pelanggan->AdvancedSearch->SearchValue ?>"<?php echo $m_member_search->id_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->jenis_member->Visible) { // jenis_member ?>
	<div id="r_jenis_member" class="form-group row">
		<label for="x_jenis_member" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_jenis_member"><?php echo $m_member_search->jenis_member->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis_member" id="z_jenis_member" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->jenis_member->cellAttributes() ?>>
			<span id="el_m_member_jenis_member" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_member" data-field="x_jenis_member" data-value-separator="<?php echo $m_member_search->jenis_member->displayValueSeparatorAttribute() ?>" id="x_jenis_member" name="x_jenis_member"<?php echo $m_member_search->jenis_member->editAttributes() ?>>
			<?php echo $m_member_search->jenis_member->selectOptionListHtml("x_jenis_member") ?>
		</select>
</div>
<?php echo $m_member_search->jenis_member->Lookup->getParamTag($m_member_search, "p_x_jenis_member") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->tgl_mulai->Visible) { // tgl_mulai ?>
	<div id="r_tgl_mulai" class="form-group row">
		<label for="x_tgl_mulai" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_tgl_mulai"><?php echo $m_member_search->tgl_mulai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_mulai" id="z_tgl_mulai" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->tgl_mulai->cellAttributes() ?>>
			<span id="el_m_member_tgl_mulai" class="ew-search-field">
<input type="text" data-table="m_member" data-field="x_tgl_mulai" data-format="7" name="x_tgl_mulai" id="x_tgl_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($m_member_search->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $m_member_search->tgl_mulai->EditValue ?>"<?php echo $m_member_search->tgl_mulai->editAttributes() ?>>
<?php if (!$m_member_search->tgl_mulai->ReadOnly && !$m_member_search->tgl_mulai->Disabled && !isset($m_member_search->tgl_mulai->EditAttrs["readonly"]) && !isset($m_member_search->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_membersearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_membersearch", "x_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label for="x_tgl_akhir" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_tgl_akhir"><?php echo $m_member_search->tgl_akhir->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_akhir" id="z_tgl_akhir" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->tgl_akhir->cellAttributes() ?>>
			<span id="el_m_member_tgl_akhir" class="ew-search-field">
<input type="text" data-table="m_member" data-field="x_tgl_akhir" data-format="7" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="19" placeholder="<?php echo HtmlEncode($m_member_search->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_member_search->tgl_akhir->EditValue ?>"<?php echo $m_member_search->tgl_akhir->editAttributes() ?>>
<?php if (!$m_member_search->tgl_akhir->ReadOnly && !$m_member_search->tgl_akhir->Disabled && !isset($m_member_search->tgl_akhir->EditAttrs["readonly"]) && !isset($m_member_search->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_membersearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_membersearch", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->poin_member->Visible) { // poin_member ?>
	<div id="r_poin_member" class="form-group row">
		<label for="x_poin_member" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_poin_member"><?php echo $m_member_search->poin_member->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_poin_member" id="z_poin_member" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->poin_member->cellAttributes() ?>>
			<span id="el_m_member_poin_member" class="ew-search-field">
<input type="text" data-table="m_member" data-field="x_poin_member" name="x_poin_member" id="x_poin_member" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_member_search->poin_member->getPlaceHolder()) ?>" value="<?php echo $m_member_search->poin_member->EditValue ?>"<?php echo $m_member_search->poin_member->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
	<div id="r_tgl_awal_transaksi" class="form-group row">
		<label for="x_tgl_awal_transaksi" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_tgl_awal_transaksi"><?php echo $m_member_search->tgl_awal_transaksi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tgl_awal_transaksi" id="z_tgl_awal_transaksi" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->tgl_awal_transaksi->cellAttributes() ?>>
			<span id="el_m_member_tgl_awal_transaksi" class="ew-search-field">
<input type="text" data-table="m_member" data-field="x_tgl_awal_transaksi" name="x_tgl_awal_transaksi" id="x_tgl_awal_transaksi" maxlength="10" placeholder="<?php echo HtmlEncode($m_member_search->tgl_awal_transaksi->getPlaceHolder()) ?>" value="<?php echo $m_member_search->tgl_awal_transaksi->EditValue ?>"<?php echo $m_member_search->tgl_awal_transaksi->editAttributes() ?>>
<?php if (!$m_member_search->tgl_awal_transaksi->ReadOnly && !$m_member_search->tgl_awal_transaksi->Disabled && !isset($m_member_search->tgl_awal_transaksi->EditAttrs["readonly"]) && !isset($m_member_search->tgl_awal_transaksi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_membersearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_membersearch", "x_tgl_awal_transaksi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_member_search->total_akumulasi->Visible) { // total_akumulasi ?>
	<div id="r_total_akumulasi" class="form-group row">
		<label for="x_total_akumulasi" class="<?php echo $m_member_search->LeftColumnClass ?>"><span id="elh_m_member_total_akumulasi"><?php echo $m_member_search->total_akumulasi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total_akumulasi" id="z_total_akumulasi" value="=">
</span>
		</label>
		<div class="<?php echo $m_member_search->RightColumnClass ?>"><div <?php echo $m_member_search->total_akumulasi->cellAttributes() ?>>
			<span id="el_m_member_total_akumulasi" class="ew-search-field">
<input type="text" data-table="m_member" data-field="x_total_akumulasi" name="x_total_akumulasi" id="x_total_akumulasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_member_search->total_akumulasi->getPlaceHolder()) ?>" value="<?php echo $m_member_search->total_akumulasi->EditValue ?>"<?php echo $m_member_search->total_akumulasi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_member_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_member_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_member_search->showPageFooter();
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
$m_member_search->terminate();
?>