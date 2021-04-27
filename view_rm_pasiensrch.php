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
$view_rm_pasien_search = new view_rm_pasien_search();

// Run the page
$view_rm_pasien_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view_rm_pasien_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fview_rm_pasiensearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($view_rm_pasien_search->IsModal) { ?>
	fview_rm_pasiensearch = currentAdvancedSearchForm = new ew.Form("fview_rm_pasiensearch", "search");
	<?php } else { ?>
	fview_rm_pasiensearch = currentForm = new ew.Form("fview_rm_pasiensearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fview_rm_pasiensearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_waktu");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($view_rm_pasien_search->waktu->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fview_rm_pasiensearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fview_rm_pasiensearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fview_rm_pasiensearch.lists["x_id_klinik"] = <?php echo $view_rm_pasien_search->id_klinik->Lookup->toClientList($view_rm_pasien_search) ?>;
	fview_rm_pasiensearch.lists["x_id_klinik"].options = <?php echo JsonEncode($view_rm_pasien_search->id_klinik->lookupOptions()) ?>;
	loadjs.done("fview_rm_pasiensearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $view_rm_pasien_search->showPageHeader(); ?>
<?php
$view_rm_pasien_search->showMessage();
?>
<form name="fview_rm_pasiensearch" id="fview_rm_pasiensearch" class="<?php echo $view_rm_pasien_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view_rm_pasien">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$view_rm_pasien_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($view_rm_pasien_search->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<div id="r_nama_pelanggan" class="form-group row">
		<label for="x_nama_pelanggan" class="<?php echo $view_rm_pasien_search->LeftColumnClass ?>"><span id="elh_view_rm_pasien_nama_pelanggan"><?php echo $view_rm_pasien_search->nama_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_pelanggan" id="z_nama_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $view_rm_pasien_search->RightColumnClass ?>"><div <?php echo $view_rm_pasien_search->nama_pelanggan->cellAttributes() ?>>
			<span id="el_view_rm_pasien_nama_pelanggan" class="ew-search-field">
<input type="text" data-table="view_rm_pasien" data-field="x_nama_pelanggan" name="x_nama_pelanggan" id="x_nama_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($view_rm_pasien_search->nama_pelanggan->getPlaceHolder()) ?>" value="<?php echo $view_rm_pasien_search->nama_pelanggan->EditValue ?>"<?php echo $view_rm_pasien_search->nama_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($view_rm_pasien_search->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
	<div id="r_noktp_pelanggan" class="form-group row">
		<label for="x_noktp_pelanggan" class="<?php echo $view_rm_pasien_search->LeftColumnClass ?>"><span id="elh_view_rm_pasien_noktp_pelanggan"><?php echo $view_rm_pasien_search->noktp_pelanggan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_noktp_pelanggan" id="z_noktp_pelanggan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $view_rm_pasien_search->RightColumnClass ?>"><div <?php echo $view_rm_pasien_search->noktp_pelanggan->cellAttributes() ?>>
			<span id="el_view_rm_pasien_noktp_pelanggan" class="ew-search-field">
<input type="text" data-table="view_rm_pasien" data-field="x_noktp_pelanggan" name="x_noktp_pelanggan" id="x_noktp_pelanggan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($view_rm_pasien_search->noktp_pelanggan->getPlaceHolder()) ?>" value="<?php echo $view_rm_pasien_search->noktp_pelanggan->EditValue ?>"<?php echo $view_rm_pasien_search->noktp_pelanggan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($view_rm_pasien_search->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label for="x_kode_penjualan" class="<?php echo $view_rm_pasien_search->LeftColumnClass ?>"><span id="elh_view_rm_pasien_kode_penjualan"><?php echo $view_rm_pasien_search->kode_penjualan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_penjualan" id="z_kode_penjualan" value="LIKE">
</span>
		</label>
		<div class="<?php echo $view_rm_pasien_search->RightColumnClass ?>"><div <?php echo $view_rm_pasien_search->kode_penjualan->cellAttributes() ?>>
			<span id="el_view_rm_pasien_kode_penjualan" class="ew-search-field">
<input type="text" data-table="view_rm_pasien" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="15" maxlength="20" placeholder="<?php echo HtmlEncode($view_rm_pasien_search->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $view_rm_pasien_search->kode_penjualan->EditValue ?>"<?php echo $view_rm_pasien_search->kode_penjualan->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($view_rm_pasien_search->waktu->Visible) { // waktu ?>
	<div id="r_waktu" class="form-group row">
		<label for="x_waktu" class="<?php echo $view_rm_pasien_search->LeftColumnClass ?>"><span id="elh_view_rm_pasien_waktu"><?php echo $view_rm_pasien_search->waktu->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_waktu" id="z_waktu" value="=">
</span>
		</label>
		<div class="<?php echo $view_rm_pasien_search->RightColumnClass ?>"><div <?php echo $view_rm_pasien_search->waktu->cellAttributes() ?>>
			<span id="el_view_rm_pasien_waktu" class="ew-search-field">
<input type="text" data-table="view_rm_pasien" data-field="x_waktu" name="x_waktu" id="x_waktu" maxlength="19" placeholder="<?php echo HtmlEncode($view_rm_pasien_search->waktu->getPlaceHolder()) ?>" value="<?php echo $view_rm_pasien_search->waktu->EditValue ?>"<?php echo $view_rm_pasien_search->waktu->editAttributes() ?>>
<?php if (!$view_rm_pasien_search->waktu->ReadOnly && !$view_rm_pasien_search->waktu->Disabled && !isset($view_rm_pasien_search->waktu->EditAttrs["readonly"]) && !isset($view_rm_pasien_search->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fview_rm_pasiensearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fview_rm_pasiensearch", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($view_rm_pasien_search->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label for="x_id_klinik" class="<?php echo $view_rm_pasien_search->LeftColumnClass ?>"><span id="elh_view_rm_pasien_id_klinik"><?php echo $view_rm_pasien_search->id_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_klinik" id="z_id_klinik" value="=">
</span>
		</label>
		<div class="<?php echo $view_rm_pasien_search->RightColumnClass ?>"><div <?php echo $view_rm_pasien_search->id_klinik->cellAttributes() ?>>
			<span id="el_view_rm_pasien_id_klinik" class="ew-search-field">
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($view_rm_pasien_search->id_klinik->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $view_rm_pasien_search->id_klinik->AdvancedSearch->ViewValue ?></button>
		<div id="dsl_x_id_klinik" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $view_rm_pasien_search->id_klinik->radioButtonListHtml(TRUE, "x_id_klinik") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_id_klinik" class="ew-template"><input type="radio" class="custom-control-input" data-table="view_rm_pasien" data-field="x_id_klinik" data-value-separator="<?php echo $view_rm_pasien_search->id_klinik->displayValueSeparatorAttribute() ?>" name="x_id_klinik" id="x_id_klinik" value="{value}"<?php echo $view_rm_pasien_search->id_klinik->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$view_rm_pasien_search->id_klinik->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $view_rm_pasien_search->id_klinik->Lookup->getParamTag($view_rm_pasien_search, "p_x_id_klinik") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($view_rm_pasien_search->nama_klinik->Visible) { // nama_klinik ?>
	<div id="r_nama_klinik" class="form-group row">
		<label for="x_nama_klinik" class="<?php echo $view_rm_pasien_search->LeftColumnClass ?>"><span id="elh_view_rm_pasien_nama_klinik"><?php echo $view_rm_pasien_search->nama_klinik->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_klinik" id="z_nama_klinik" value="LIKE">
</span>
		</label>
		<div class="<?php echo $view_rm_pasien_search->RightColumnClass ?>"><div <?php echo $view_rm_pasien_search->nama_klinik->cellAttributes() ?>>
			<span id="el_view_rm_pasien_nama_klinik" class="ew-search-field">
<input type="text" data-table="view_rm_pasien" data-field="x_nama_klinik" name="x_nama_klinik" id="x_nama_klinik" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($view_rm_pasien_search->nama_klinik->getPlaceHolder()) ?>" value="<?php echo $view_rm_pasien_search->nama_klinik->EditValue ?>"<?php echo $view_rm_pasien_search->nama_klinik->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$view_rm_pasien_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $view_rm_pasien_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$view_rm_pasien_search->showPageFooter();
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
$view_rm_pasien_search->terminate();
?>