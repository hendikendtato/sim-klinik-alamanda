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
$m_barang_search = new m_barang_search();

// Run the page
$m_barang_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_barang_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_barangsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($m_barang_search->IsModal) { ?>
	fm_barangsearch = currentAdvancedSearchForm = new ew.Form("fm_barangsearch", "search");
	<?php } else { ?>
	fm_barangsearch = currentForm = new ew.Form("fm_barangsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fm_barangsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_barangsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_barangsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_barangsearch.lists["x_jenis"] = <?php echo $m_barang_search->jenis->Lookup->toClientList($m_barang_search) ?>;
	fm_barangsearch.lists["x_jenis"].options = <?php echo JsonEncode($m_barang_search->jenis->lookupOptions()) ?>;
	fm_barangsearch.lists["x_kategori"] = <?php echo $m_barang_search->kategori->Lookup->toClientList($m_barang_search) ?>;
	fm_barangsearch.lists["x_kategori"].options = <?php echo JsonEncode($m_barang_search->kategori->lookupOptions()) ?>;
	fm_barangsearch.lists["x_subkategori"] = <?php echo $m_barang_search->subkategori->Lookup->toClientList($m_barang_search) ?>;
	fm_barangsearch.lists["x_subkategori"].options = <?php echo JsonEncode($m_barang_search->subkategori->lookupOptions()) ?>;
	fm_barangsearch.lists["x_komposisi"] = <?php echo $m_barang_search->komposisi->Lookup->toClientList($m_barang_search) ?>;
	fm_barangsearch.lists["x_komposisi"].options = <?php echo JsonEncode($m_barang_search->komposisi->options(FALSE, TRUE)) ?>;
	fm_barangsearch.lists["x_tipe"] = <?php echo $m_barang_search->tipe->Lookup->toClientList($m_barang_search) ?>;
	fm_barangsearch.lists["x_tipe"].options = <?php echo JsonEncode($m_barang_search->tipe->options(FALSE, TRUE)) ?>;
	fm_barangsearch.lists["x_discontinue"] = <?php echo $m_barang_search->discontinue->Lookup->toClientList($m_barang_search) ?>;
	fm_barangsearch.lists["x_discontinue"].options = <?php echo JsonEncode($m_barang_search->discontinue->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_barangsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_barang_search->showPageHeader(); ?>
<?php
$m_barang_search->showMessage();
?>
<form name="fm_barangsearch" id="fm_barangsearch" class="<?php echo $m_barang_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_barang">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$m_barang_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($m_barang_search->kode_barang->Visible) { // kode_barang ?>
	<div id="r_kode_barang" class="form-group row">
		<label for="x_kode_barang" class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_kode_barang"><?php echo $m_barang_search->kode_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_kode_barang" id="z_kode_barang" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->kode_barang->cellAttributes() ?>>
			<span id="el_m_barang_kode_barang" class="ew-search-field">
<input type="text" data-table="m_barang" data-field="x_kode_barang" name="x_kode_barang" id="x_kode_barang" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_barang_search->kode_barang->getPlaceHolder()) ?>" value="<?php echo $m_barang_search->kode_barang->EditValue ?>"<?php echo $m_barang_search->kode_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label for="x_nama_barang" class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_nama_barang"><?php echo $m_barang_search->nama_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_barang" id="z_nama_barang" value="LIKE">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->nama_barang->cellAttributes() ?>>
			<span id="el_m_barang_nama_barang" class="ew-search-field">
<input type="text" data-table="m_barang" data-field="x_nama_barang" name="x_nama_barang" id="x_nama_barang" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($m_barang_search->nama_barang->getPlaceHolder()) ?>" value="<?php echo $m_barang_search->nama_barang->EditValue ?>"<?php echo $m_barang_search->nama_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label for="x_jenis" class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_jenis"><?php echo $m_barang_search->jenis->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_jenis" id="z_jenis" value="=">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->jenis->cellAttributes() ?>>
			<span id="el_m_barang_jenis" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_jenis" data-value-separator="<?php echo $m_barang_search->jenis->displayValueSeparatorAttribute() ?>" id="x_jenis" name="x_jenis"<?php echo $m_barang_search->jenis->editAttributes() ?>>
			<?php echo $m_barang_search->jenis->selectOptionListHtml("x_jenis") ?>
		</select>
</div>
<?php echo $m_barang_search->jenis->Lookup->getParamTag($m_barang_search, "p_x_jenis") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label for="x_kategori" class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_kategori"><?php echo $m_barang_search->kategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_kategori" id="z_kategori" value="=">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->kategori->cellAttributes() ?>>
			<span id="el_m_barang_kategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_kategori" data-value-separator="<?php echo $m_barang_search->kategori->displayValueSeparatorAttribute() ?>" id="x_kategori" name="x_kategori"<?php echo $m_barang_search->kategori->editAttributes() ?>>
			<?php echo $m_barang_search->kategori->selectOptionListHtml("x_kategori") ?>
		</select>
</div>
<?php echo $m_barang_search->kategori->Lookup->getParamTag($m_barang_search, "p_x_kategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->subkategori->Visible) { // subkategori ?>
	<div id="r_subkategori" class="form-group row">
		<label for="x_subkategori" class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_subkategori"><?php echo $m_barang_search->subkategori->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_subkategori" id="z_subkategori" value="=">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->subkategori->cellAttributes() ?>>
			<span id="el_m_barang_subkategori" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_subkategori" data-value-separator="<?php echo $m_barang_search->subkategori->displayValueSeparatorAttribute() ?>" id="x_subkategori" name="x_subkategori"<?php echo $m_barang_search->subkategori->editAttributes() ?>>
			<?php echo $m_barang_search->subkategori->selectOptionListHtml("x_subkategori") ?>
		</select>
</div>
<?php echo $m_barang_search->subkategori->Lookup->getParamTag($m_barang_search, "p_x_subkategori") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->komposisi->Visible) { // komposisi ?>
	<div id="r_komposisi" class="form-group row">
		<label class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_komposisi"><?php echo $m_barang_search->komposisi->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_komposisi" id="z_komposisi" value="=">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->komposisi->cellAttributes() ?>>
			<span id="el_m_barang_komposisi" class="ew-search-field">
<div id="tp_x_komposisi" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_barang" data-field="x_komposisi" data-value-separator="<?php echo $m_barang_search->komposisi->displayValueSeparatorAttribute() ?>" name="x_komposisi" id="x_komposisi" value="{value}"<?php echo $m_barang_search->komposisi->editAttributes() ?>></div>
<div id="dsl_x_komposisi" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_barang_search->komposisi->radioButtonListHtml(FALSE, "x_komposisi") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_tipe"><?php echo $m_barang_search->tipe->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tipe" id="z_tipe" value="=">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->tipe->cellAttributes() ?>>
			<span id="el_m_barang_tipe" class="ew-search-field">
<div id="tp_x_tipe" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_barang" data-field="x_tipe" data-value-separator="<?php echo $m_barang_search->tipe->displayValueSeparatorAttribute() ?>" name="x_tipe" id="x_tipe" value="{value}"<?php echo $m_barang_search->tipe->editAttributes() ?>></div>
<div id="dsl_x_tipe" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_barang_search->tipe->radioButtonListHtml(FALSE, "x_tipe") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($m_barang_search->discontinue->Visible) { // discontinue ?>
	<div id="r_discontinue" class="form-group row">
		<label class="<?php echo $m_barang_search->LeftColumnClass ?>"><span id="elh_m_barang_discontinue"><?php echo $m_barang_search->discontinue->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_discontinue" id="z_discontinue" value="=">
</span>
		</label>
		<div class="<?php echo $m_barang_search->RightColumnClass ?>"><div <?php echo $m_barang_search->discontinue->cellAttributes() ?>>
			<span id="el_m_barang_discontinue" class="ew-search-field">
<div id="tp_x_discontinue" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_barang" data-field="x_discontinue" data-value-separator="<?php echo $m_barang_search->discontinue->displayValueSeparatorAttribute() ?>" name="x_discontinue" id="x_discontinue" value="{value}"<?php echo $m_barang_search->discontinue->editAttributes() ?>></div>
<div id="dsl_x_discontinue" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_barang_search->discontinue->radioButtonListHtml(FALSE, "x_discontinue") ?>
</div></div>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_barang_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_barang_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_barang_search->showPageFooter();
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
$m_barang_search->terminate();
?>