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
$m_hargajual_edit = new m_hargajual_edit();

// Run the page
$m_hargajual_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_hargajualedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_hargajualedit = currentForm = new ew.Form("fm_hargajualedit", "edit");

	// Validate form
	fm_hargajualedit.validate = function() {
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
			<?php if ($m_hargajual_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->id_barang->caption(), $m_hargajual_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_edit->totalhargajual->Required) { ?>
				elm = this.getElements("x" + infix + "_totalhargajual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->totalhargajual->caption(), $m_hargajual_edit->totalhargajual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_totalhargajual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->totalhargajual->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->disc_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->disc_pr->caption(), $m_hargajual_edit->disc_pr->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_pr");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->disc_pr->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->disc_rp->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_rp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->disc_rp->caption(), $m_hargajual_edit->disc_rp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_rp");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->disc_rp->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->id_klinik->caption(), $m_hargajual_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_edit->stok->Required) { ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->stok->caption(), $m_hargajual_edit->stok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->stok->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->satuan->caption(), $m_hargajual_edit->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_edit->minimum_stok->Required) { ?>
				elm = this.getElements("x" + infix + "_minimum_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->minimum_stok->caption(), $m_hargajual_edit->minimum_stok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_minimum_stok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->minimum_stok->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->tgl_masuk->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_masuk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->tgl_masuk->caption(), $m_hargajual_edit->tgl_masuk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_masuk");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->tgl_masuk->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->tgl_exp->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_exp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->tgl_exp->caption(), $m_hargajual_edit->tgl_exp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_exp");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_edit->tgl_exp->errorMessage()) ?>");
			<?php if ($m_hargajual_edit->kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->kategori->caption(), $m_hargajual_edit->kategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_edit->subkategori->Required) { ?>
				elm = this.getElements("x" + infix + "_subkategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->subkategori->caption(), $m_hargajual_edit->subkategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_edit->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->tipe->caption(), $m_hargajual_edit->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_edit->status->caption(), $m_hargajual_edit->status->RequiredErrorMessage)) ?>");
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
	fm_hargajualedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_hargajualedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_hargajualedit.lists["x_id_barang"] = <?php echo $m_hargajual_edit->id_barang->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_id_barang"].options = <?php echo JsonEncode($m_hargajual_edit->id_barang->lookupOptions()) ?>;
	fm_hargajualedit.lists["x_id_klinik"] = <?php echo $m_hargajual_edit->id_klinik->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_id_klinik"].options = <?php echo JsonEncode($m_hargajual_edit->id_klinik->lookupOptions()) ?>;
	fm_hargajualedit.lists["x_satuan"] = <?php echo $m_hargajual_edit->satuan->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_satuan"].options = <?php echo JsonEncode($m_hargajual_edit->satuan->lookupOptions()) ?>;
	fm_hargajualedit.lists["x_kategori"] = <?php echo $m_hargajual_edit->kategori->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_kategori"].options = <?php echo JsonEncode($m_hargajual_edit->kategori->lookupOptions()) ?>;
	fm_hargajualedit.lists["x_subkategori"] = <?php echo $m_hargajual_edit->subkategori->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_subkategori"].options = <?php echo JsonEncode($m_hargajual_edit->subkategori->lookupOptions()) ?>;
	fm_hargajualedit.lists["x_tipe[]"] = <?php echo $m_hargajual_edit->tipe->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_tipe[]"].options = <?php echo JsonEncode($m_hargajual_edit->tipe->options(FALSE, TRUE)) ?>;
	fm_hargajualedit.lists["x_status"] = <?php echo $m_hargajual_edit->status->Lookup->toClientList($m_hargajual_edit) ?>;
	fm_hargajualedit.lists["x_status"].options = <?php echo JsonEncode($m_hargajual_edit->status->lookupOptions()) ?>;
	loadjs.done("fm_hargajualedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#x_kategori option:not(:selected)").prop("disabled",!0),$("#x_subkategori option:not(:selected)").prop("disabled",!0),$("#x_id_barang").change(function(){var o=$("#x_kategori").val();console.log(o)});
});
</script>
<?php $m_hargajual_edit->showPageHeader(); ?>
<?php
$m_hargajual_edit->showMessage();
?>
<form name="fm_hargajualedit" id="fm_hargajualedit" class="<?php echo $m_hargajual_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_hargajual_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_hargajual_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_m_hargajual_id_barang" for="x_id_barang" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->id_barang->caption() ?><?php echo $m_hargajual_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->id_barang->cellAttributes() ?>>
<span id="el_m_hargajual_id_barang">
<?php $m_hargajual_edit->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($m_hargajual_edit->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_hargajual_edit->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_hargajual_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_hargajual_edit->id_barang->ReadOnly || $m_hargajual_edit->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_hargajual_edit->id_barang->Lookup->getParamTag($m_hargajual_edit, "p_x_id_barang") ?>
<input type="hidden" data-table="m_hargajual" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_hargajual_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $m_hargajual_edit->id_barang->CurrentValue ?>"<?php echo $m_hargajual_edit->id_barang->editAttributes() ?>>
</span>
<?php echo $m_hargajual_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->totalhargajual->Visible) { // totalhargajual ?>
	<div id="r_totalhargajual" class="form-group row">
		<label id="elh_m_hargajual_totalhargajual" for="x_totalhargajual" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->totalhargajual->caption() ?><?php echo $m_hargajual_edit->totalhargajual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->totalhargajual->cellAttributes() ?>>
<span id="el_m_hargajual_totalhargajual">
<input type="text" data-table="m_hargajual" data-field="x_totalhargajual" name="x_totalhargajual" id="x_totalhargajual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_hargajual_edit->totalhargajual->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->totalhargajual->EditValue ?>"<?php echo $m_hargajual_edit->totalhargajual->editAttributes() ?>>
</span>
<?php echo $m_hargajual_edit->totalhargajual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->disc_pr->Visible) { // disc_pr ?>
	<div id="r_disc_pr" class="form-group row">
		<label id="elh_m_hargajual_disc_pr" for="x_disc_pr" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->disc_pr->caption() ?><?php echo $m_hargajual_edit->disc_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->disc_pr->cellAttributes() ?>>
<span id="el_m_hargajual_disc_pr">
<input type="text" data-table="m_hargajual" data-field="x_disc_pr" name="x_disc_pr" id="x_disc_pr" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_hargajual_edit->disc_pr->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->disc_pr->EditValue ?>"<?php echo $m_hargajual_edit->disc_pr->editAttributes() ?>>
</span>
<?php echo $m_hargajual_edit->disc_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->disc_rp->Visible) { // disc_rp ?>
	<div id="r_disc_rp" class="form-group row">
		<label id="elh_m_hargajual_disc_rp" for="x_disc_rp" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->disc_rp->caption() ?><?php echo $m_hargajual_edit->disc_rp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->disc_rp->cellAttributes() ?>>
<span id="el_m_hargajual_disc_rp">
<input type="text" data-table="m_hargajual" data-field="x_disc_rp" name="x_disc_rp" id="x_disc_rp" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_hargajual_edit->disc_rp->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->disc_rp->EditValue ?>"<?php echo $m_hargajual_edit->disc_rp->editAttributes() ?>>
</span>
<?php echo $m_hargajual_edit->disc_rp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_hargajual_id_klinik" for="x_id_klinik" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->id_klinik->caption() ?><?php echo $m_hargajual_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->id_klinik->cellAttributes() ?>>
<span id="el_m_hargajual_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_id_klinik" data-value-separator="<?php echo $m_hargajual_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_hargajual_edit->id_klinik->editAttributes() ?>>
			<?php echo $m_hargajual_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_hargajual_edit->id_klinik->Lookup->getParamTag($m_hargajual_edit, "p_x_id_klinik") ?>
</span>
<?php echo $m_hargajual_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->stok->Visible) { // stok ?>
	<div id="r_stok" class="form-group row">
		<label id="elh_m_hargajual_stok" for="x_stok" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->stok->caption() ?><?php echo $m_hargajual_edit->stok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->stok->cellAttributes() ?>>
<span id="el_m_hargajual_stok">
<input type="text" data-table="m_hargajual" data-field="x_stok" name="x_stok" id="x_stok" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($m_hargajual_edit->stok->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->stok->EditValue ?>"<?php echo $m_hargajual_edit->stok->editAttributes() ?>>
</span>
<?php echo $m_hargajual_edit->stok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_m_hargajual_satuan" for="x_satuan" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->satuan->caption() ?><?php echo $m_hargajual_edit->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->satuan->cellAttributes() ?>>
<span id="el_m_hargajual_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_satuan" data-value-separator="<?php echo $m_hargajual_edit->satuan->displayValueSeparatorAttribute() ?>" id="x_satuan" name="x_satuan"<?php echo $m_hargajual_edit->satuan->editAttributes() ?>>
			<?php echo $m_hargajual_edit->satuan->selectOptionListHtml("x_satuan") ?>
		</select>
</div>
<?php echo $m_hargajual_edit->satuan->Lookup->getParamTag($m_hargajual_edit, "p_x_satuan") ?>
</span>
<?php echo $m_hargajual_edit->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->minimum_stok->Visible) { // minimum_stok ?>
	<div id="r_minimum_stok" class="form-group row">
		<label id="elh_m_hargajual_minimum_stok" for="x_minimum_stok" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->minimum_stok->caption() ?><?php echo $m_hargajual_edit->minimum_stok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->minimum_stok->cellAttributes() ?>>
<span id="el_m_hargajual_minimum_stok">
<input type="text" data-table="m_hargajual" data-field="x_minimum_stok" name="x_minimum_stok" id="x_minimum_stok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_hargajual_edit->minimum_stok->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->minimum_stok->EditValue ?>"<?php echo $m_hargajual_edit->minimum_stok->editAttributes() ?>>
</span>
<?php echo $m_hargajual_edit->minimum_stok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->tgl_masuk->Visible) { // tgl_masuk ?>
	<div id="r_tgl_masuk" class="form-group row">
		<label id="elh_m_hargajual_tgl_masuk" for="x_tgl_masuk" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->tgl_masuk->caption() ?><?php echo $m_hargajual_edit->tgl_masuk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->tgl_masuk->cellAttributes() ?>>
<span id="el_m_hargajual_tgl_masuk">
<input type="text" data-table="m_hargajual" data-field="x_tgl_masuk" name="x_tgl_masuk" id="x_tgl_masuk" maxlength="19" placeholder="<?php echo HtmlEncode($m_hargajual_edit->tgl_masuk->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->tgl_masuk->EditValue ?>"<?php echo $m_hargajual_edit->tgl_masuk->editAttributes() ?>>
<?php if (!$m_hargajual_edit->tgl_masuk->ReadOnly && !$m_hargajual_edit->tgl_masuk->Disabled && !isset($m_hargajual_edit->tgl_masuk->EditAttrs["readonly"]) && !isset($m_hargajual_edit->tgl_masuk->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_hargajualedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_hargajualedit", "x_tgl_masuk", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_hargajual_edit->tgl_masuk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->tgl_exp->Visible) { // tgl_exp ?>
	<div id="r_tgl_exp" class="form-group row">
		<label id="elh_m_hargajual_tgl_exp" for="x_tgl_exp" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->tgl_exp->caption() ?><?php echo $m_hargajual_edit->tgl_exp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->tgl_exp->cellAttributes() ?>>
<span id="el_m_hargajual_tgl_exp">
<input type="text" data-table="m_hargajual" data-field="x_tgl_exp" name="x_tgl_exp" id="x_tgl_exp" maxlength="19" placeholder="<?php echo HtmlEncode($m_hargajual_edit->tgl_exp->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_edit->tgl_exp->EditValue ?>"<?php echo $m_hargajual_edit->tgl_exp->editAttributes() ?>>
<?php if (!$m_hargajual_edit->tgl_exp->ReadOnly && !$m_hargajual_edit->tgl_exp->Disabled && !isset($m_hargajual_edit->tgl_exp->EditAttrs["readonly"]) && !isset($m_hargajual_edit->tgl_exp->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_hargajualedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_hargajualedit", "x_tgl_exp", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_hargajual_edit->tgl_exp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->kategori->Visible) { // kategori ?>
	<div id="r_kategori" class="form-group row">
		<label id="elh_m_hargajual_kategori" for="x_kategori" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->kategori->caption() ?><?php echo $m_hargajual_edit->kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->kategori->cellAttributes() ?>>
<span id="el_m_hargajual_kategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_kategori" data-value-separator="<?php echo $m_hargajual_edit->kategori->displayValueSeparatorAttribute() ?>" id="x_kategori" name="x_kategori"<?php echo $m_hargajual_edit->kategori->editAttributes() ?>>
			<?php echo $m_hargajual_edit->kategori->selectOptionListHtml("x_kategori") ?>
		</select>
</div>
<?php echo $m_hargajual_edit->kategori->Lookup->getParamTag($m_hargajual_edit, "p_x_kategori") ?>
</span>
<?php echo $m_hargajual_edit->kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->subkategori->Visible) { // subkategori ?>
	<div id="r_subkategori" class="form-group row">
		<label id="elh_m_hargajual_subkategori" for="x_subkategori" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->subkategori->caption() ?><?php echo $m_hargajual_edit->subkategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->subkategori->cellAttributes() ?>>
<span id="el_m_hargajual_subkategori">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_subkategori" data-value-separator="<?php echo $m_hargajual_edit->subkategori->displayValueSeparatorAttribute() ?>" id="x_subkategori" name="x_subkategori"<?php echo $m_hargajual_edit->subkategori->editAttributes() ?>>
			<?php echo $m_hargajual_edit->subkategori->selectOptionListHtml("x_subkategori") ?>
		</select>
</div>
<?php echo $m_hargajual_edit->subkategori->Lookup->getParamTag($m_hargajual_edit, "p_x_subkategori") ?>
</span>
<?php echo $m_hargajual_edit->subkategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_m_hargajual_tipe" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->tipe->caption() ?><?php echo $m_hargajual_edit->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->tipe->cellAttributes() ?>>
<span id="el_m_hargajual_tipe">
<div id="tp_x_tipe" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="m_hargajual" data-field="x_tipe" data-value-separator="<?php echo $m_hargajual_edit->tipe->displayValueSeparatorAttribute() ?>" name="x_tipe[]" id="x_tipe[]" value="{value}"<?php echo $m_hargajual_edit->tipe->editAttributes() ?>></div>
<div id="dsl_x_tipe" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $m_hargajual_edit->tipe->checkBoxListHtml(FALSE, "x_tipe[]") ?>
</div></div>
</span>
<?php echo $m_hargajual_edit->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_m_hargajual_status" for="x_status" class="<?php echo $m_hargajual_edit->LeftColumnClass ?>"><?php echo $m_hargajual_edit->status->caption() ?><?php echo $m_hargajual_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_edit->status->cellAttributes() ?>>
<span id="el_m_hargajual_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual" data-field="x_status" data-value-separator="<?php echo $m_hargajual_edit->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $m_hargajual_edit->status->editAttributes() ?>>
			<?php echo $m_hargajual_edit->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
<?php echo $m_hargajual_edit->status->Lookup->getParamTag($m_hargajual_edit, "p_x_status") ?>
</span>
<?php echo $m_hargajual_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="m_hargajual" data-field="x_id_hargajual" name="x_id_hargajual" id="x_id_hargajual" value="<?php echo HtmlEncode($m_hargajual_edit->id_hargajual->CurrentValue) ?>">
<?php if (!$m_hargajual_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_hargajual_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_hargajual_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_hargajual_edit->showPageFooter();
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
$m_hargajual_edit->terminate();
?>