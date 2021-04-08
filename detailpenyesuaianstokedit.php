<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$detailpenyesuaianstok_edit = new detailpenyesuaianstok_edit();

// Run the page
$detailpenyesuaianstok_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianstok_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpenyesuaianstokedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailpenyesuaianstokedit = currentForm = new ew.Form("fdetailpenyesuaianstokedit", "edit");

	// Validate form
	fdetailpenyesuaianstokedit.validate = function() {
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
			<?php if ($detailpenyesuaianstok_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->id->caption(), $detailpenyesuaianstok_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenyesuaianstok_edit->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->pid->caption(), $detailpenyesuaianstok_edit->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_edit->pid->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_edit->kode_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->kode_barang->caption(), $detailpenyesuaianstok_edit->kode_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_edit->kode_barang->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->id_barang->caption(), $detailpenyesuaianstok_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_edit->id_barang->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_edit->stokdatabase->Required) { ?>
				elm = this.getElements("x" + infix + "_stokdatabase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->stokdatabase->caption(), $detailpenyesuaianstok_edit->stokdatabase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stokdatabase");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_edit->stokdatabase->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_edit->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->jumlah->caption(), $detailpenyesuaianstok_edit->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_edit->jumlah->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_edit->selisih->Required) { ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->selisih->caption(), $detailpenyesuaianstok_edit->selisih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianstok_edit->selisih->errorMessage()) ?>");
			<?php if ($detailpenyesuaianstok_edit->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianstok_edit->tipe->caption(), $detailpenyesuaianstok_edit->tipe->RequiredErrorMessage)) ?>");
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
	fdetailpenyesuaianstokedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpenyesuaianstokedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpenyesuaianstokedit.lists["x_kode_barang"] = <?php echo $detailpenyesuaianstok_edit->kode_barang->Lookup->toClientList($detailpenyesuaianstok_edit) ?>;
	fdetailpenyesuaianstokedit.lists["x_kode_barang"].options = <?php echo JsonEncode($detailpenyesuaianstok_edit->kode_barang->lookupOptions()) ?>;
	fdetailpenyesuaianstokedit.autoSuggests["x_kode_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenyesuaianstokedit.lists["x_id_barang"] = <?php echo $detailpenyesuaianstok_edit->id_barang->Lookup->toClientList($detailpenyesuaianstok_edit) ?>;
	fdetailpenyesuaianstokedit.lists["x_id_barang"].options = <?php echo JsonEncode($detailpenyesuaianstok_edit->id_barang->lookupOptions()) ?>;
	fdetailpenyesuaianstokedit.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailpenyesuaianstokedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpenyesuaianstok_edit->showPageHeader(); ?>
<?php
$detailpenyesuaianstok_edit->showMessage();
?>
<form name="fdetailpenyesuaianstokedit" id="fdetailpenyesuaianstokedit" class="<?php echo $detailpenyesuaianstok_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianstok">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailpenyesuaianstok_edit->IsModal ?>">
<?php if ($detailpenyesuaianstok->getCurrentMasterTable() == "penyesuaianstok") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="penyesuaianstok">
<input type="hidden" name="fk_id_penyesuaianstok" value="<?php echo HtmlEncode($detailpenyesuaianstok_edit->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailpenyesuaianstok_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_detailpenyesuaianstok_id" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->id->caption() ?><?php echo $detailpenyesuaianstok_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->id->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_id">
<span<?php echo $detailpenyesuaianstok_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($detailpenyesuaianstok_edit->id->CurrentValue) ?>">
<?php echo $detailpenyesuaianstok_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_detailpenyesuaianstok_pid" for="x_pid" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->pid->caption() ?><?php echo $detailpenyesuaianstok_edit->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->pid->cellAttributes() ?>>
<?php if ($detailpenyesuaianstok_edit->pid->getSessionValue() != "") { ?>
<span id="el_detailpenyesuaianstok_pid">
<span<?php echo $detailpenyesuaianstok_edit->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianstok_edit->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($detailpenyesuaianstok_edit->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailpenyesuaianstok_pid">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->pid->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_edit->pid->EditValue ?>"<?php echo $detailpenyesuaianstok_edit->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailpenyesuaianstok_edit->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->kode_barang->Visible) { // kode_barang ?>
	<div id="r_kode_barang" class="form-group row">
		<label id="elh_detailpenyesuaianstok_kode_barang" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->kode_barang->caption() ?><?php echo $detailpenyesuaianstok_edit->kode_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->kode_barang->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_kode_barang">
<?php
$onchange = $detailpenyesuaianstok_edit->kode_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenyesuaianstok_edit->kode_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_kode_barang">
	<input type="text" class="form-control" name="sv_x_kode_barang" id="sv_x_kode_barang" value="<?php echo RemoveHtml($detailpenyesuaianstok_edit->kode_barang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->kode_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->kode_barang->getPlaceHolder()) ?>"<?php echo $detailpenyesuaianstok_edit->kode_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_kode_barang" data-value-separator="<?php echo $detailpenyesuaianstok_edit->kode_barang->displayValueSeparatorAttribute() ?>" name="x_kode_barang" id="x_kode_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_edit->kode_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenyesuaianstokedit"], function() {
	fdetailpenyesuaianstokedit.createAutoSuggest({"id":"x_kode_barang","forceSelect":true});
});
</script>
<?php echo $detailpenyesuaianstok_edit->kode_barang->Lookup->getParamTag($detailpenyesuaianstok_edit, "p_x_kode_barang") ?>
</span>
<?php echo $detailpenyesuaianstok_edit->kode_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailpenyesuaianstok_id_barang" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->id_barang->caption() ?><?php echo $detailpenyesuaianstok_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->id_barang->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_id_barang">
<?php
$onchange = $detailpenyesuaianstok_edit->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenyesuaianstok_edit->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailpenyesuaianstok_edit->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->id_barang->getPlaceHolder()) ?>"<?php echo $detailpenyesuaianstok_edit->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpenyesuaianstok_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailpenyesuaianstok_edit->id_barang->ReadOnly || $detailpenyesuaianstok_edit->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailpenyesuaianstok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpenyesuaianstok_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailpenyesuaianstok_edit->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenyesuaianstokedit"], function() {
	fdetailpenyesuaianstokedit.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailpenyesuaianstok_edit->id_barang->Lookup->getParamTag($detailpenyesuaianstok_edit, "p_x_id_barang") ?>
</span>
<?php echo $detailpenyesuaianstok_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->stokdatabase->Visible) { // stokdatabase ?>
	<div id="r_stokdatabase" class="form-group row">
		<label id="elh_detailpenyesuaianstok_stokdatabase" for="x_stokdatabase" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->stokdatabase->caption() ?><?php echo $detailpenyesuaianstok_edit->stokdatabase->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->stokdatabase->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_stokdatabase">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_stokdatabase" name="x_stokdatabase" id="x_stokdatabase" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->stokdatabase->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_edit->stokdatabase->EditValue ?>"<?php echo $detailpenyesuaianstok_edit->stokdatabase->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianstok_edit->stokdatabase->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailpenyesuaianstok_jumlah" for="x_jumlah" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->jumlah->caption() ?><?php echo $detailpenyesuaianstok_edit->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->jumlah->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_jumlah">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_edit->jumlah->EditValue ?>"<?php echo $detailpenyesuaianstok_edit->jumlah->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianstok_edit->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->selisih->Visible) { // selisih ?>
	<div id="r_selisih" class="form-group row">
		<label id="elh_detailpenyesuaianstok_selisih" for="x_selisih" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->selisih->caption() ?><?php echo $detailpenyesuaianstok_edit->selisih->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->selisih->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_selisih">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_selisih" name="x_selisih" id="x_selisih" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_edit->selisih->EditValue ?>"<?php echo $detailpenyesuaianstok_edit->selisih->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianstok_edit->selisih->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianstok_edit->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_detailpenyesuaianstok_tipe" for="x_tipe" class="<?php echo $detailpenyesuaianstok_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianstok_edit->tipe->caption() ?><?php echo $detailpenyesuaianstok_edit->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianstok_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianstok_edit->tipe->cellAttributes() ?>>
<span id="el_detailpenyesuaianstok_tipe">
<input type="text" data-table="detailpenyesuaianstok" data-field="x_tipe" name="x_tipe" id="x_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianstok_edit->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianstok_edit->tipe->EditValue ?>"<?php echo $detailpenyesuaianstok_edit->tipe->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianstok_edit->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailpenyesuaianstok_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpenyesuaianstok_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpenyesuaianstok_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpenyesuaianstok_edit->showPageFooter();
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
$detailpenyesuaianstok_edit->terminate();
?>