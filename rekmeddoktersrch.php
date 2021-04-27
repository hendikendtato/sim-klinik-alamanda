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
$rekmeddokter_search = new rekmeddokter_search();

// Run the page
$rekmeddokter_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekmeddokter_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frekmeddoktersearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($rekmeddokter_search->IsModal) { ?>
	frekmeddoktersearch = currentAdvancedSearchForm = new ew.Form("frekmeddoktersearch", "search");
	<?php } else { ?>
	frekmeddoktersearch = currentForm = new ew.Form("frekmeddoktersearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	frekmeddoktersearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_rekmeddok");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekmeddokter_search->id_rekmeddok->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($rekmeddokter_search->tanggal->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	frekmeddoktersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frekmeddoktersearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frekmeddoktersearch.lists["x_id_pelanggan"] = <?php echo $rekmeddokter_search->id_pelanggan->Lookup->toClientList($rekmeddokter_search) ?>;
	frekmeddoktersearch.lists["x_id_pelanggan"].options = <?php echo JsonEncode($rekmeddokter_search->id_pelanggan->lookupOptions()) ?>;
	frekmeddoktersearch.lists["x_id_dokter"] = <?php echo $rekmeddokter_search->id_dokter->Lookup->toClientList($rekmeddokter_search) ?>;
	frekmeddoktersearch.lists["x_id_dokter"].options = <?php echo JsonEncode($rekmeddokter_search->id_dokter->lookupOptions()) ?>;
	frekmeddoktersearch.lists["x_id_be"] = <?php echo $rekmeddokter_search->id_be->Lookup->toClientList($rekmeddokter_search) ?>;
	frekmeddoktersearch.lists["x_id_be"].options = <?php echo JsonEncode($rekmeddokter_search->id_be->lookupOptions()) ?>;
	loadjs.done("frekmeddoktersearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rekmeddokter_search->showPageHeader(); ?>
<?php
$rekmeddokter_search->showMessage();
?>
<form name="frekmeddoktersearch" id="frekmeddoktersearch" class="<?php echo $rekmeddokter_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekmeddokter">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$rekmeddokter_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($rekmeddokter_search->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label for="x_id_rekmeddok" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_id_rekmeddok"><?php echo $rekmeddokter_search->id_rekmeddok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_rekmeddok" id="z_id_rekmeddok" value="=">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->id_rekmeddok->cellAttributes() ?>>
			<span id="el_rekmeddokter_id_rekmeddok" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" maxlength="11" placeholder="<?php echo HtmlEncode($rekmeddokter_search->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->id_rekmeddok->EditValue ?>"<?php echo $rekmeddokter_search->id_rekmeddok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
	<div id="r_kode_rekmeddok" class="form-group row">
		<label for="x_kode_rekmeddok" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_kode_rekmeddok"><?php echo $rekmeddokter_search->kode_rekmeddok->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_rekmeddok" id="z_kode_rekmeddok" value="LIKE">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->kode_rekmeddok->cellAttributes() ?>>
			<span id="el_rekmeddokter_kode_rekmeddok" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_kode_rekmeddok" name="x_kode_rekmeddok" id="x_kode_rekmeddok" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($rekmeddokter_search->kode_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->kode_rekmeddok->EditValue ?>"<?php echo $rekmeddokter_search->kode_rekmeddok->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_tanggal"><?php echo $rekmeddokter_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->tanggal->cellAttributes() ?>>
			<span id="el_rekmeddokter_tanggal" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($rekmeddokter_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->tanggal->EditValue ?>"<?php echo $rekmeddokter_search->tanggal->editAttributes() ?>>
<?php if (!$rekmeddokter_search->tanggal->ReadOnly && !$rekmeddokter_search->tanggal->Disabled && !isset($rekmeddokter_search->tanggal->EditAttrs["readonly"]) && !isset($rekmeddokter_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frekmeddoktersearch", "datetimepicker"], function() {
	ew.createDateTimePicker("frekmeddoktersearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label for="x_id_pelanggan" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_id_pelanggan"><?php echo $rekmeddokter_search->id_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pelanggan" id="z_id_pelanggan" value="=">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->id_pelanggan->cellAttributes() ?>>
			<span id="el_rekmeddokter_id_pelanggan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_pelanggan"><?php echo EmptyValue(strval($rekmeddokter_search->id_pelanggan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekmeddokter_search->id_pelanggan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekmeddokter_search->id_pelanggan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekmeddokter_search->id_pelanggan->ReadOnly || $rekmeddokter_search->id_pelanggan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_pelanggan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekmeddokter_search->id_pelanggan->Lookup->getParamTag($rekmeddokter_search, "p_x_id_pelanggan") ?>
<input type="hidden" data-table="rekmeddokter" data-field="x_id_pelanggan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekmeddokter_search->id_pelanggan->displayValueSeparatorAttribute() ?>" name="x_id_pelanggan" id="x_id_pelanggan" value="<?php echo $rekmeddokter_search->id_pelanggan->AdvancedSearch->SearchValue ?>"<?php echo $rekmeddokter_search->id_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->id_dokter->Visible) { // id_dokter ?>
	<div id="r_id_dokter" class="form-group row">
		<label for="x_id_dokter" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_id_dokter"><?php echo $rekmeddokter_search->id_dokter->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_dokter" id="z_id_dokter" value="=">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->id_dokter->cellAttributes() ?>>
			<span id="el_rekmeddokter_id_dokter" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_dokter"><?php echo EmptyValue(strval($rekmeddokter_search->id_dokter->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekmeddokter_search->id_dokter->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekmeddokter_search->id_dokter->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekmeddokter_search->id_dokter->ReadOnly || $rekmeddokter_search->id_dokter->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_dokter',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekmeddokter_search->id_dokter->Lookup->getParamTag($rekmeddokter_search, "p_x_id_dokter") ?>
<input type="hidden" data-table="rekmeddokter" data-field="x_id_dokter" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekmeddokter_search->id_dokter->displayValueSeparatorAttribute() ?>" name="x_id_dokter" id="x_id_dokter" value="<?php echo $rekmeddokter_search->id_dokter->AdvancedSearch->SearchValue ?>"<?php echo $rekmeddokter_search->id_dokter->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->id_be->Visible) { // id_be ?>
	<div id="r_id_be" class="form-group row">
		<label for="x_id_be" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_id_be"><?php echo $rekmeddokter_search->id_be->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_be" id="z_id_be" value="=">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->id_be->cellAttributes() ?>>
			<span id="el_rekmeddokter_id_be" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_be"><?php echo EmptyValue(strval($rekmeddokter_search->id_be->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekmeddokter_search->id_be->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekmeddokter_search->id_be->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekmeddokter_search->id_be->ReadOnly || $rekmeddokter_search->id_be->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_be',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekmeddokter_search->id_be->Lookup->getParamTag($rekmeddokter_search, "p_x_id_be") ?>
<input type="hidden" data-table="rekmeddokter" data-field="x_id_be" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekmeddokter_search->id_be->displayValueSeparatorAttribute() ?>" name="x_id_be" id="x_id_be" value="<?php echo $rekmeddokter_search->id_be->AdvancedSearch->SearchValue ?>"<?php echo $rekmeddokter_search->id_be->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->keluhan->Visible) { // keluhan ?>
	<div id="r_keluhan" class="form-group row">
		<label for="x_keluhan" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_keluhan"><?php echo $rekmeddokter_search->keluhan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keluhan" id="z_keluhan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->keluhan->cellAttributes() ?>>
			<span id="el_rekmeddokter_keluhan" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_keluhan" name="x_keluhan" id="x_keluhan" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($rekmeddokter_search->keluhan->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->keluhan->EditValue ?>"<?php echo $rekmeddokter_search->keluhan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->gejala_klinis->Visible) { // gejala_klinis ?>
	<div id="r_gejala_klinis" class="form-group row">
		<label for="x_gejala_klinis" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_gejala_klinis"><?php echo $rekmeddokter_search->gejala_klinis->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_gejala_klinis" id="z_gejala_klinis" value="LIKE">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->gejala_klinis->cellAttributes() ?>>
			<span id="el_rekmeddokter_gejala_klinis" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_gejala_klinis" name="x_gejala_klinis" id="x_gejala_klinis" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($rekmeddokter_search->gejala_klinis->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->gejala_klinis->EditValue ?>"<?php echo $rekmeddokter_search->gejala_klinis->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->terapi->Visible) { // terapi ?>
	<div id="r_terapi" class="form-group row">
		<label for="x_terapi" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_terapi"><?php echo $rekmeddokter_search->terapi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_terapi" id="z_terapi" value="LIKE">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->terapi->cellAttributes() ?>>
			<span id="el_rekmeddokter_terapi" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_terapi" name="x_terapi" id="x_terapi" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($rekmeddokter_search->terapi->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->terapi->EditValue ?>"<?php echo $rekmeddokter_search->terapi->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->tindakan->Visible) { // tindakan ?>
	<div id="r_tindakan" class="form-group row">
		<label for="x_tindakan" class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_tindakan"><?php echo $rekmeddokter_search->tindakan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_tindakan" id="z_tindakan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->tindakan->cellAttributes() ?>>
			<span id="el_rekmeddokter_tindakan" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_tindakan" name="x_tindakan" id="x_tindakan" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($rekmeddokter_search->tindakan->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->tindakan->EditValue ?>"<?php echo $rekmeddokter_search->tindakan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_search->foto_perawatan->Visible) { // foto_perawatan ?>
	<div id="r_foto_perawatan" class="form-group row">
		<label class="<?php echo $rekmeddokter_search->LeftColumnClass ?>"><span id="elh_rekmeddokter_foto_perawatan"><?php echo $rekmeddokter_search->foto_perawatan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_foto_perawatan" id="z_foto_perawatan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $rekmeddokter_search->RightColumnClass ?>"><div <?php echo $rekmeddokter_search->foto_perawatan->cellAttributes() ?>>
			<span id="el_rekmeddokter_foto_perawatan" class="ew-search-field">
<input type="text" data-table="rekmeddokter" data-field="x_foto_perawatan" name="x_foto_perawatan" id="x_foto_perawatan" maxlength="16777215" placeholder="<?php echo HtmlEncode($rekmeddokter_search->foto_perawatan->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_search->foto_perawatan->EditValue ?>"<?php echo $rekmeddokter_search->foto_perawatan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rekmeddokter_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rekmeddokter_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rekmeddokter_search->showPageFooter();
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
$rekmeddokter_search->terminate();
?>