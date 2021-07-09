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
$m_barang_add = new m_barang_add();

// Run the page
$m_barang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_barang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_barangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_barangadd = currentForm = new ew.Form("fm_barangadd", "add");

	// Validate form
	fm_barangadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($m_barang_add->kode_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->kode_barang->caption(), $m_barang_add->kode_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->nama_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->nama_barang->caption(), $m_barang_add->nama_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->satuan->caption(), $m_barang_add->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->jenis->caption(), $m_barang_add->jenis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->kategori->caption(), $m_barang_add->kategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->subkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_subkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->subkategori->caption(), $m_barang_add->subkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->komposisi->Required) { ?>
				elm = this.getElements("x" + infix + "_komposisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->komposisi->caption(), $m_barang_add->komposisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->tipe->caption(), $m_barang_add->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->shortname_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_shortname_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->shortname_barang->caption(), $m_barang_add->shortname_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->id_tag->Required) { ?>
				elm = this.getElements("x" + infix + "_id_tag");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->id_tag->caption(), $m_barang_add->id_tag->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_barang_add->discontinue->Required) { ?>
				elm = this.getElements("x" + infix + "_discontinue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_barang_add->discontinue->caption(), $m_barang_add->discontinue->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fm_barangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_barangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_barangadd.lists["x_satuan"] = <?php echo $m_barang_add->satuan->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_satuan"].options = <?php echo JsonEncode($m_barang_add->satuan->lookupOptions()) ?>;
	fm_barangadd.lists["x_jenis"] = <?php echo $m_barang_add->jenis->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_jenis"].options = <?php echo JsonEncode($m_barang_add->jenis->lookupOptions()) ?>;
	fm_barangadd.lists["x_kategori"] = <?php echo $m_barang_add->kategori->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_kategori"].options = <?php echo JsonEncode($m_barang_add->kategori->lookupOptions()) ?>;
	fm_barangadd.lists["x_subkategori"] = <?php echo $m_barang_add->subkategori->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_subkategori"].options = <?php echo JsonEncode($m_barang_add->subkategori->lookupOptions()) ?>;
	fm_barangadd.lists["x_komposisi"] = <?php echo $m_barang_add->komposisi->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_komposisi"].options = <?php echo JsonEncode($m_barang_add->komposisi->options(FALSE, TRUE)) ?>;
	fm_barangadd.lists["x_tipe"] = <?php echo $m_barang_add->tipe->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_tipe"].options = <?php echo JsonEncode($m_barang_add->tipe->options(FALSE, TRUE)) ?>;
	fm_barangadd.lists["x_id_tag"] = <?php echo $m_barang_add->id_tag->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_id_tag"].options = <?php echo JsonEncode($m_barang_add->id_tag->lookupOptions()) ?>;
	fm_barangadd.lists["x_discontinue"] = <?php echo $m_barang_add->discontinue->Lookup->toClientList($m_barang_add) ?>;
	fm_barangadd.lists["x_discontinue"].options = <?php echo JsonEncode($m_barang_add->discontinue->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_barangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_barang_add->showPageHeader(); ?>
<?php
$m_barang_add->showMessage();
?>
<form name="fm_barangadd" id="fm_barangadd" class="<?php echo $m_barang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_barang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_barang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_barang_add->kode_barang->Visible) { // kode_barang ?>
	<div id="r_kode_barang" class="form-group row">
		<label id="elh_m_barang_kode_barang" for="x_kode_barang" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->kode_barang->caption() ?><?php echo $m_barang_add->kode_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->kode_barang->cellAttributes() ?>>
<span id="el_m_barang_kode_barang">
<input type="text" data-table="m_barang" data-field="x_kode_barang" name="x_kode_barang" id="x_kode_barang" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_barang_add->kode_barang->getPlaceHolder()) ?>" value="<?php echo $m_barang_add->kode_barang->EditValue ?>"<?php echo $m_barang_add->kode_barang->editAttributes() ?>>
</span>
<?php echo $m_barang_add->kode_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_m_barang_nama_barang" for="x_nama_barang" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->nama_barang->caption() ?><?php echo $m_barang_add->nama_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->nama_barang->cellAttributes() ?>>
<span id="el_m_barang_nama_barang">
<input type="text" data-table="m_barang" data-field="x_nama_barang" name="x_nama_barang" id="x_nama_barang" size="40" maxlength="255" placeholder="<?php echo HtmlEncode($m_barang_add->nama_barang->getPlaceHolder()) ?>" value="<?php echo $m_barang_add->nama_barang->EditValue ?>"<?php echo $m_barang_add->nama_barang->editAttributes() ?>>
</span>
<?php echo $m_barang_add->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_m_barang_satuan" for="x_satuan" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->satuan->caption() ?><?php echo $m_barang_add->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->satuan->cellAttributes() ?>>
<span id="el_m_barang_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_satuan" data-value-separator="<?php echo $m_barang_add->satuan->displayValueSeparatorAttribute() ?>" id="x_satuan" name="x_satuan"<?php echo $m_barang_add->satuan->editAttributes() ?>>
			<?php echo $m_barang_add->satuan->selectOptionListHtml("x_satuan") ?>
		</select>
</div>
<?php echo $m_barang_add->satuan->Lookup->getParamTag($m_barang_add, "p_x_satuan") ?>
</span>
<?php echo $m_barang_add->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_m_barang_jenis" for="x_jenis" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->jenis->caption() ?><?php echo $m_barang_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->jenis->cellAttributes() ?>>
<span id="el_m_barang_jenis">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_jenis" data-value-separator="<?php echo $m_barang_add->jenis->displayValueSeparatorAttribute() ?>" id="x_jenis" name="x_jenis"<?php echo $m_barang_add->jenis->editAttributes() ?>>
			<?php echo $m_barang_add->jenis->selectOptionListHtml("x_jenis") ?>
		</select>
</div>
<?php echo $m_barang_add->jenis->Lookup->getParamTag($m_barang_add, "p_x_jenis") ?>
</span>
<?php echo $m_barang_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label id="elh_m_barang_kategori" for="x_kategori" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->kategori->caption() ?><?php echo $m_barang_add->kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->kategori->cellAttributes() ?>>
<span id="el_m_barang_kategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_kategori" data-value-separator="<?php echo $m_barang_add->kategori->displayValueSeparatorAttribute() ?>" id="x_kategori" name="x_kategori"<?php echo $m_barang_add->kategori->editAttributes() ?>>
			<?php echo $m_barang_add->kategori->selectOptionListHtml("x_kategori") ?>
		</select>
</div>
<?php echo $m_barang_add->kategori->Lookup->getParamTag($m_barang_add, "p_x_kategori") ?>
</span>
<?php echo $m_barang_add->kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->subkategori->Visible) { // subkategori ?>
	<div id="r_subkategori" class="form-group row">
		<label id="elh_m_barang_subkategori" for="x_subkategori" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->subkategori->caption() ?><?php echo $m_barang_add->subkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->subkategori->cellAttributes() ?>>
<span id="el_m_barang_subkategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_subkategori" data-value-separator="<?php echo $m_barang_add->subkategori->displayValueSeparatorAttribute() ?>" id="x_subkategori" name="x_subkategori"<?php echo $m_barang_add->subkategori->editAttributes() ?>>
			<?php echo $m_barang_add->subkategori->selectOptionListHtml("x_subkategori") ?>
		</select>
</div>
<?php echo $m_barang_add->subkategori->Lookup->getParamTag($m_barang_add, "p_x_subkategori") ?>
</span>
<?php echo $m_barang_add->subkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->komposisi->Visible) { // komposisi ?>
	<div id="r_komposisi" class="form-group row">
		<label id="elh_m_barang_komposisi" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->komposisi->caption() ?><?php echo $m_barang_add->komposisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->komposisi->cellAttributes() ?>>
<span id="el_m_barang_komposisi">
<div id="tp_x_komposisi" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_barang" data-field="x_komposisi" data-value-separator="<?php echo $m_barang_add->komposisi->displayValueSeparatorAttribute() ?>" name="x_komposisi" id="x_komposisi" value="{value}"<?php echo $m_barang_add->komposisi->editAttributes() ?>></div>
<div id="dsl_x_komposisi" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_barang_add->komposisi->radioButtonListHtml(FALSE, "x_komposisi") ?>
</div></div>
</span>
<?php echo $m_barang_add->komposisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_m_barang_tipe" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->tipe->caption() ?><?php echo $m_barang_add->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->tipe->cellAttributes() ?>>
<span id="el_m_barang_tipe">
<div id="tp_x_tipe" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_barang" data-field="x_tipe" data-value-separator="<?php echo $m_barang_add->tipe->displayValueSeparatorAttribute() ?>" name="x_tipe" id="x_tipe" value="{value}"<?php echo $m_barang_add->tipe->editAttributes() ?>></div>
<div id="dsl_x_tipe" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_barang_add->tipe->radioButtonListHtml(FALSE, "x_tipe") ?>
</div></div>
</span>
<?php echo $m_barang_add->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->shortname_barang->Visible) { // shortname_barang ?>
	<div id="r_shortname_barang" class="form-group row">
		<label id="elh_m_barang_shortname_barang" for="x_shortname_barang" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->shortname_barang->caption() ?><?php echo $m_barang_add->shortname_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->shortname_barang->cellAttributes() ?>>
<span id="el_m_barang_shortname_barang">
<input type="text" data-table="m_barang" data-field="x_shortname_barang" name="x_shortname_barang" id="x_shortname_barang" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($m_barang_add->shortname_barang->getPlaceHolder()) ?>" value="<?php echo $m_barang_add->shortname_barang->EditValue ?>"<?php echo $m_barang_add->shortname_barang->editAttributes() ?>>
</span>
<?php echo $m_barang_add->shortname_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->id_tag->Visible) { // id_tag ?>
	<div id="r_id_tag" class="form-group row">
		<label id="elh_m_barang_id_tag" for="x_id_tag" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->id_tag->caption() ?><?php echo $m_barang_add->id_tag->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->id_tag->cellAttributes() ?>>
<span id="el_m_barang_id_tag">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_barang" data-field="x_id_tag" data-value-separator="<?php echo $m_barang_add->id_tag->displayValueSeparatorAttribute() ?>" id="x_id_tag" name="x_id_tag"<?php echo $m_barang_add->id_tag->editAttributes() ?>>
			<?php echo $m_barang_add->id_tag->selectOptionListHtml("x_id_tag") ?>
		</select>
</div>
<?php echo $m_barang_add->id_tag->Lookup->getParamTag($m_barang_add, "p_x_id_tag") ?>
</span>
<?php echo $m_barang_add->id_tag->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_barang_add->discontinue->Visible) { // discontinue ?>
	<div id="r_discontinue" class="form-group row">
		<label id="elh_m_barang_discontinue" class="<?php echo $m_barang_add->LeftColumnClass ?>"><?php echo $m_barang_add->discontinue->caption() ?><?php echo $m_barang_add->discontinue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_barang_add->RightColumnClass ?>"><div <?php echo $m_barang_add->discontinue->cellAttributes() ?>>
<span id="el_m_barang_discontinue">
<div id="tp_x_discontinue" class="ew-template"><input type="radio" class="custom-control-input" data-table="m_barang" data-field="x_discontinue" data-value-separator="<?php echo $m_barang_add->discontinue->displayValueSeparatorAttribute() ?>" name="x_discontinue" id="x_discontinue" value="{value}"<?php echo $m_barang_add->discontinue->editAttributes() ?>></div>
<div id="dsl_x_discontinue" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_barang_add->discontinue->radioButtonListHtml(FALSE, "x_discontinue") ?>
</div></div>
</span>
<?php echo $m_barang_add->discontinue->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_barang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_barang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_barang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_barang_add->showPageFooter();
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
$m_barang_add->terminate();
?>