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
$kirimbarang_search = new kirimbarang_search();

// Run the page
$kirimbarang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kirimbarang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkirimbarangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($kirimbarang_search->IsModal) { ?>
	fkirimbarangsearch = currentAdvancedSearchForm = new ew.Form("fkirimbarangsearch", "search");
	<?php } else { ?>
	fkirimbarangsearch = currentForm = new ew.Form("fkirimbarangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fkirimbarangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kirimbarang_search->id->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tanggal");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($kirimbarang_search->tanggal->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fkirimbarangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkirimbarangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkirimbarangsearch.lists["x_id_po"] = <?php echo $kirimbarang_search->id_po->Lookup->toClientList($kirimbarang_search) ?>;
	fkirimbarangsearch.lists["x_id_po"].options = <?php echo JsonEncode($kirimbarang_search->id_po->lookupOptions()) ?>;
	fkirimbarangsearch.lists["x_id_supplier"] = <?php echo $kirimbarang_search->id_supplier->Lookup->toClientList($kirimbarang_search) ?>;
	fkirimbarangsearch.lists["x_id_supplier"].options = <?php echo JsonEncode($kirimbarang_search->id_supplier->lookupOptions()) ?>;
	fkirimbarangsearch.lists["x_id_klinik"] = <?php echo $kirimbarang_search->id_klinik->Lookup->toClientList($kirimbarang_search) ?>;
	fkirimbarangsearch.lists["x_id_klinik"].options = <?php echo JsonEncode($kirimbarang_search->id_klinik->lookupOptions()) ?>;
	fkirimbarangsearch.lists["x_id_pegawai"] = <?php echo $kirimbarang_search->id_pegawai->Lookup->toClientList($kirimbarang_search) ?>;
	fkirimbarangsearch.lists["x_id_pegawai"].options = <?php echo JsonEncode($kirimbarang_search->id_pegawai->lookupOptions()) ?>;
	fkirimbarangsearch.lists["x_status_kirim"] = <?php echo $kirimbarang_search->status_kirim->Lookup->toClientList($kirimbarang_search) ?>;
	fkirimbarangsearch.lists["x_status_kirim"].options = <?php echo JsonEncode($kirimbarang_search->status_kirim->options(FALSE, TRUE)) ?>;
	loadjs.done("fkirimbarangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kirimbarang_search->showPageHeader(); ?>
<?php
$kirimbarang_search->showMessage();
?>
<form name="fkirimbarangsearch" id="fkirimbarangsearch" class="<?php echo $kirimbarang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kirimbarang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$kirimbarang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($kirimbarang_search->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label for="x_id" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_id"><?php echo $kirimbarang_search->id->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id" id="z_id" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->id->cellAttributes() ?>>
			<span id="el_kirimbarang_id" class="ew-search-field">
<input type="text" data-table="kirimbarang" data-field="x_id" name="x_id" id="x_id" maxlength="11" placeholder="<?php echo HtmlEncode($kirimbarang_search->id->getPlaceHolder()) ?>" value="<?php echo $kirimbarang_search->id->EditValue ?>"<?php echo $kirimbarang_search->id->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->no_kirimbarang->Visible) { // no_kirimbarang ?>
	<div id="r_no_kirimbarang" class="form-group row">
		<label for="x_no_kirimbarang" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_no_kirimbarang"><?php echo $kirimbarang_search->no_kirimbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_no_kirimbarang" id="z_no_kirimbarang" value="LIKE">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->no_kirimbarang->cellAttributes() ?>>
			<span id="el_kirimbarang_no_kirimbarang" class="ew-search-field">
<input type="text" data-table="kirimbarang" data-field="x_no_kirimbarang" name="x_no_kirimbarang" id="x_no_kirimbarang" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($kirimbarang_search->no_kirimbarang->getPlaceHolder()) ?>" value="<?php echo $kirimbarang_search->no_kirimbarang->EditValue ?>"<?php echo $kirimbarang_search->no_kirimbarang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->id_po->Visible) { // id_po ?>
	<div id="r_id_po" class="form-group row">
		<label for="x_id_po" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_id_po"><?php echo $kirimbarang_search->id_po->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_po" id="z_id_po" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->id_po->cellAttributes() ?>>
			<span id="el_kirimbarang_id_po" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_po" data-value-separator="<?php echo $kirimbarang_search->id_po->displayValueSeparatorAttribute() ?>" id="x_id_po" name="x_id_po"<?php echo $kirimbarang_search->id_po->editAttributes() ?>>
			<?php echo $kirimbarang_search->id_po->selectOptionListHtml("x_id_po") ?>
		</select>
</div>
<?php echo $kirimbarang_search->id_po->Lookup->getParamTag($kirimbarang_search, "p_x_id_po") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->id_supplier->Visible) { // id_supplier ?>
	<div id="r_id_supplier" class="form-group row">
		<label for="x_id_supplier" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_id_supplier"><?php echo $kirimbarang_search->id_supplier->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_supplier" id="z_id_supplier" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->id_supplier->cellAttributes() ?>>
			<span id="el_kirimbarang_id_supplier" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_supplier" data-value-separator="<?php echo $kirimbarang_search->id_supplier->displayValueSeparatorAttribute() ?>" id="x_id_supplier" name="x_id_supplier"<?php echo $kirimbarang_search->id_supplier->editAttributes() ?>>
			<?php echo $kirimbarang_search->id_supplier->selectOptionListHtml("x_id_supplier") ?>
		</select>
</div>
<?php echo $kirimbarang_search->id_supplier->Lookup->getParamTag($kirimbarang_search, "p_x_id_supplier") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_id_klinik"><?php echo $kirimbarang_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->id_klinik->cellAttributes() ?>>
			<span id="el_kirimbarang_id_klinik" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_klinik" data-value-separator="<?php echo $kirimbarang_search->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $kirimbarang_search->id_klinik->editAttributes() ?>>
			<?php echo $kirimbarang_search->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $kirimbarang_search->id_klinik->Lookup->getParamTag($kirimbarang_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label for="x_id_pegawai" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_id_pegawai"><?php echo $kirimbarang_search->id_pegawai->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_pegawai" id="z_id_pegawai" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->id_pegawai->cellAttributes() ?>>
			<span id="el_kirimbarang_id_pegawai" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kirimbarang" data-field="x_id_pegawai" data-value-separator="<?php echo $kirimbarang_search->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $kirimbarang_search->id_pegawai->editAttributes() ?>>
			<?php echo $kirimbarang_search->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $kirimbarang_search->id_pegawai->Lookup->getParamTag($kirimbarang_search, "p_x_id_pegawai") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label for="x_tanggal" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_tanggal"><?php echo $kirimbarang_search->tanggal->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tanggal" id="z_tanggal" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->tanggal->cellAttributes() ?>>
			<span id="el_kirimbarang_tanggal" class="ew-search-field">
<input type="text" data-table="kirimbarang" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kirimbarang_search->tanggal->getPlaceHolder()) ?>" value="<?php echo $kirimbarang_search->tanggal->EditValue ?>"<?php echo $kirimbarang_search->tanggal->editAttributes() ?>>
<?php if (!$kirimbarang_search->tanggal->ReadOnly && !$kirimbarang_search->tanggal->Disabled && !isset($kirimbarang_search->tanggal->EditAttrs["readonly"]) && !isset($kirimbarang_search->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkirimbarangsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fkirimbarangsearch", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->status_kirim->Visible) { // status_kirim ?>
	<div id="r_status_kirim" class="form-group row">
		<label class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_status_kirim"><?php echo $kirimbarang_search->status_kirim->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_status_kirim" id="z_status_kirim" value="=">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->status_kirim->cellAttributes() ?>>
			<span id="el_kirimbarang_status_kirim" class="ew-search-field">
<div id="tp_x_status_kirim" class="ew-template"><input type="radio" class="custom-control-input" data-table="kirimbarang" data-field="x_status_kirim" data-value-separator="<?php echo $kirimbarang_search->status_kirim->displayValueSeparatorAttribute() ?>" name="x_status_kirim" id="x_status_kirim" value="{value}"<?php echo $kirimbarang_search->status_kirim->editAttributes() ?>></div>
<div id="dsl_x_status_kirim" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $kirimbarang_search->status_kirim->radioButtonListHtml(FALSE, "x_status_kirim") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($kirimbarang_search->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label for="x_keterangan" class="<?php echo $kirimbarang_search->LeftColumnClass ?>"><span id="elh_kirimbarang_keterangan"><?php echo $kirimbarang_search->keterangan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_keterangan" id="z_keterangan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $kirimbarang_search->RightColumnClass ?>"><div <?php echo $kirimbarang_search->keterangan->cellAttributes() ?>>
			<span id="el_kirimbarang_keterangan" class="ew-search-field">
<input type="text" data-table="kirimbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" maxlength="255" placeholder="<?php echo HtmlEncode($kirimbarang_search->keterangan->getPlaceHolder()) ?>" value="<?php echo $kirimbarang_search->keterangan->EditValue ?>"<?php echo $kirimbarang_search->keterangan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kirimbarang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kirimbarang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kirimbarang_search->showPageFooter();
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
$kirimbarang_search->terminate();
?>