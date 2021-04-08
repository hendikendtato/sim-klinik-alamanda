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
$m_komisi_recall_detail_edit = new m_komisi_recall_detail_edit();

// Run the page
$m_komisi_recall_detail_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_recall_detail_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_komisi_recall_detailedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_komisi_recall_detailedit = currentForm = new ew.Form("fm_komisi_recall_detailedit", "edit");

	// Validate form
	fm_komisi_recall_detailedit.validate = function() {
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
			<?php if ($m_komisi_recall_detail_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->id->caption(), $m_komisi_recall_detail_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_komisi_recall_detail_edit->id_komisi->Required) { ?>
				elm = this.getElements("x" + infix + "_id_komisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->id_komisi->caption(), $m_komisi_recall_detail_edit->id_komisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_komisi_recall_detail_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->id_barang->caption(), $m_komisi_recall_detail_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->id_barang->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->recall_default_persen->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_default_persen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->recall_default_persen->caption(), $m_komisi_recall_detail_edit->recall_default_persen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_default_persen");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->recall_default_persen->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->recall_default_rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_default_rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->recall_default_rupiah->caption(), $m_komisi_recall_detail_edit->recall_default_rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_default_rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->recall_default_rupiah->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->recall_target_persen->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_target_persen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->recall_target_persen->caption(), $m_komisi_recall_detail_edit->recall_target_persen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_target_persen");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->recall_target_persen->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->recall_target_rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_recall_target_rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->recall_target_rupiah->caption(), $m_komisi_recall_detail_edit->recall_target_rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_recall_target_rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->recall_target_rupiah->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->tgl_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->tgl_mulai->caption(), $m_komisi_recall_detail_edit->tgl_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->tgl_mulai->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->tgl_akhir->caption(), $m_komisi_recall_detail_edit->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->tgl_akhir->errorMessage()) ?>");
			<?php if ($m_komisi_recall_detail_edit->target->Required) { ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_komisi_recall_detail_edit->target->caption(), $m_komisi_recall_detail_edit->target->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_komisi_recall_detail_edit->target->errorMessage()) ?>");

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
	fm_komisi_recall_detailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_komisi_recall_detailedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_komisi_recall_detailedit.lists["x_id_komisi"] = <?php echo $m_komisi_recall_detail_edit->id_komisi->Lookup->toClientList($m_komisi_recall_detail_edit) ?>;
	fm_komisi_recall_detailedit.lists["x_id_komisi"].options = <?php echo JsonEncode($m_komisi_recall_detail_edit->id_komisi->lookupOptions()) ?>;
	fm_komisi_recall_detailedit.lists["x_id_barang"] = <?php echo $m_komisi_recall_detail_edit->id_barang->Lookup->toClientList($m_komisi_recall_detail_edit) ?>;
	fm_komisi_recall_detailedit.lists["x_id_barang"].options = <?php echo JsonEncode($m_komisi_recall_detail_edit->id_barang->lookupOptions()) ?>;
	fm_komisi_recall_detailedit.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fm_komisi_recall_detailedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_komisi_recall_detail_edit->showPageHeader(); ?>
<?php
$m_komisi_recall_detail_edit->showMessage();
?>
<form name="fm_komisi_recall_detailedit" id="fm_komisi_recall_detailedit" class="<?php echo $m_komisi_recall_detail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi_recall_detail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_komisi_recall_detail_edit->IsModal ?>">
<?php if ($m_komisi_recall_detail->getCurrentMasterTable() == "m_komisi") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_komisi">
<input type="hidden" name="fk_id_komisi" value="<?php echo HtmlEncode($m_komisi_recall_detail_edit->id_komisi->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_komisi_recall_detail_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_m_komisi_recall_detail_id" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->id->caption() ?><?php echo $m_komisi_recall_detail_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->id->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_id">
<span<?php echo $m_komisi_recall_detail_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($m_komisi_recall_detail_edit->id->CurrentValue) ?>">
<?php echo $m_komisi_recall_detail_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->id_komisi->Visible) { // id_komisi ?>
	<div id="r_id_komisi" class="form-group row">
		<label id="elh_m_komisi_recall_detail_id_komisi" for="x_id_komisi" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->id_komisi->caption() ?><?php echo $m_komisi_recall_detail_edit->id_komisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->id_komisi->cellAttributes() ?>>
<?php if ($m_komisi_recall_detail_edit->id_komisi->getSessionValue() != "") { ?>
<span id="el_m_komisi_recall_detail_id_komisi">
<span<?php echo $m_komisi_recall_detail_edit->id_komisi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_komisi_recall_detail_edit->id_komisi->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_komisi" name="x_id_komisi" value="<?php echo HtmlEncode($m_komisi_recall_detail_edit->id_komisi->CurrentValue) ?>">
<?php } else { ?>
<span id="el_m_komisi_recall_detail_id_komisi">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_komisi_recall_detail" data-field="x_id_komisi" data-value-separator="<?php echo $m_komisi_recall_detail_edit->id_komisi->displayValueSeparatorAttribute() ?>" id="x_id_komisi" name="x_id_komisi"<?php echo $m_komisi_recall_detail_edit->id_komisi->editAttributes() ?>>
			<?php echo $m_komisi_recall_detail_edit->id_komisi->selectOptionListHtml("x_id_komisi") ?>
		</select>
</div>
<?php echo $m_komisi_recall_detail_edit->id_komisi->Lookup->getParamTag($m_komisi_recall_detail_edit, "p_x_id_komisi") ?>
</span>
<?php } ?>
<?php echo $m_komisi_recall_detail_edit->id_komisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_m_komisi_recall_detail_id_barang" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->id_barang->caption() ?><?php echo $m_komisi_recall_detail_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->id_barang->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_id_barang">
<?php
$onchange = $m_komisi_recall_detail_edit->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_komisi_recall_detail_edit->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($m_komisi_recall_detail_edit->id_barang->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->id_barang->getPlaceHolder()) ?>"<?php echo $m_komisi_recall_detail_edit->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_komisi_recall_detail_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($m_komisi_recall_detail_edit->id_barang->ReadOnly || $m_komisi_recall_detail_edit->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_komisi_recall_detail" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_komisi_recall_detail_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($m_komisi_recall_detail_edit->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_komisi_recall_detailedit"], function() {
	fm_komisi_recall_detailedit.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $m_komisi_recall_detail_edit->id_barang->Lookup->getParamTag($m_komisi_recall_detail_edit, "p_x_id_barang") ?>
</span>
<?php echo $m_komisi_recall_detail_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->recall_default_persen->Visible) { // recall_default_persen ?>
	<div id="r_recall_default_persen" class="form-group row">
		<label id="elh_m_komisi_recall_detail_recall_default_persen" for="x_recall_default_persen" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->recall_default_persen->caption() ?><?php echo $m_komisi_recall_detail_edit->recall_default_persen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->recall_default_persen->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_recall_default_persen">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_persen" name="x_recall_default_persen" id="x_recall_default_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->recall_default_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->recall_default_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->recall_default_persen->editAttributes() ?>>
</span>
<?php echo $m_komisi_recall_detail_edit->recall_default_persen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->recall_default_rupiah->Visible) { // recall_default_rupiah ?>
	<div id="r_recall_default_rupiah" class="form-group row">
		<label id="elh_m_komisi_recall_detail_recall_default_rupiah" for="x_recall_default_rupiah" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->recall_default_rupiah->caption() ?><?php echo $m_komisi_recall_detail_edit->recall_default_rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->recall_default_rupiah->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_recall_default_rupiah">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_default_rupiah" name="x_recall_default_rupiah" id="x_recall_default_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->recall_default_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->recall_default_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->recall_default_rupiah->editAttributes() ?>>
</span>
<?php echo $m_komisi_recall_detail_edit->recall_default_rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->recall_target_persen->Visible) { // recall_target_persen ?>
	<div id="r_recall_target_persen" class="form-group row">
		<label id="elh_m_komisi_recall_detail_recall_target_persen" for="x_recall_target_persen" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->recall_target_persen->caption() ?><?php echo $m_komisi_recall_detail_edit->recall_target_persen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->recall_target_persen->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_recall_target_persen">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_persen" name="x_recall_target_persen" id="x_recall_target_persen" size="15" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->recall_target_persen->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->recall_target_persen->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->recall_target_persen->editAttributes() ?>>
</span>
<?php echo $m_komisi_recall_detail_edit->recall_target_persen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->recall_target_rupiah->Visible) { // recall_target_rupiah ?>
	<div id="r_recall_target_rupiah" class="form-group row">
		<label id="elh_m_komisi_recall_detail_recall_target_rupiah" for="x_recall_target_rupiah" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->recall_target_rupiah->caption() ?><?php echo $m_komisi_recall_detail_edit->recall_target_rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->recall_target_rupiah->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_recall_target_rupiah">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_recall_target_rupiah" name="x_recall_target_rupiah" id="x_recall_target_rupiah" size="20" maxlength="22" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->recall_target_rupiah->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->recall_target_rupiah->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->recall_target_rupiah->editAttributes() ?>>
</span>
<?php echo $m_komisi_recall_detail_edit->recall_target_rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->tgl_mulai->Visible) { // tgl_mulai ?>
	<div id="r_tgl_mulai" class="form-group row">
		<label id="elh_m_komisi_recall_detail_tgl_mulai" for="x_tgl_mulai" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->tgl_mulai->caption() ?><?php echo $m_komisi_recall_detail_edit->tgl_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->tgl_mulai->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_tgl_mulai">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_mulai" name="x_tgl_mulai" id="x_tgl_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->tgl_mulai->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->tgl_mulai->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_edit->tgl_mulai->ReadOnly && !$m_komisi_recall_detail_edit->tgl_mulai->Disabled && !isset($m_komisi_recall_detail_edit->tgl_mulai->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_edit->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailedit", "x_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_komisi_recall_detail_edit->tgl_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_m_komisi_recall_detail_tgl_akhir" for="x_tgl_akhir" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->tgl_akhir->caption() ?><?php echo $m_komisi_recall_detail_edit->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->tgl_akhir->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_tgl_akhir">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_tgl_akhir" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="19" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->tgl_akhir->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->tgl_akhir->editAttributes() ?>>
<?php if (!$m_komisi_recall_detail_edit->tgl_akhir->ReadOnly && !$m_komisi_recall_detail_edit->tgl_akhir->Disabled && !isset($m_komisi_recall_detail_edit->tgl_akhir->EditAttrs["readonly"]) && !isset($m_komisi_recall_detail_edit->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_komisi_recall_detailedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_komisi_recall_detailedit", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_komisi_recall_detail_edit->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_komisi_recall_detail_edit->target->Visible) { // target ?>
	<div id="r_target" class="form-group row">
		<label id="elh_m_komisi_recall_detail_target" for="x_target" class="<?php echo $m_komisi_recall_detail_edit->LeftColumnClass ?>"><?php echo $m_komisi_recall_detail_edit->target->caption() ?><?php echo $m_komisi_recall_detail_edit->target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_komisi_recall_detail_edit->RightColumnClass ?>"><div <?php echo $m_komisi_recall_detail_edit->target->cellAttributes() ?>>
<span id="el_m_komisi_recall_detail_target">
<input type="text" data-table="m_komisi_recall_detail" data-field="x_target" name="x_target" id="x_target" size="10" maxlength="10" placeholder="<?php echo HtmlEncode($m_komisi_recall_detail_edit->target->getPlaceHolder()) ?>" value="<?php echo $m_komisi_recall_detail_edit->target->EditValue ?>"<?php echo $m_komisi_recall_detail_edit->target->editAttributes() ?>>
</span>
<?php echo $m_komisi_recall_detail_edit->target->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_komisi_recall_detail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_komisi_recall_detail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_komisi_recall_detail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_komisi_recall_detail_edit->showPageFooter();
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
$m_komisi_recall_detail_edit->terminate();
?>