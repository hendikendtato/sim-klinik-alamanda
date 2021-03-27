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
$rekmeddokter_add = new rekmeddokter_add();

// Run the page
$rekmeddokter_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekmeddokter_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frekmeddokteradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	frekmeddokteradd = currentForm = new ew.Form("frekmeddokteradd", "add");

	// Validate form
	frekmeddokteradd.validate = function() {
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
			<?php if ($rekmeddokter_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->tanggal->caption(), $rekmeddokter_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekmeddokter_add->tanggal->errorMessage()) ?>");
			<?php if ($rekmeddokter_add->id_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->id_pelanggan->caption(), $rekmeddokter_add->id_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->id_dokter->Required) { ?>
				elm = this.getElements("x" + infix + "_id_dokter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->id_dokter->caption(), $rekmeddokter_add->id_dokter->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->id_be->Required) { ?>
				elm = this.getElements("x" + infix + "_id_be");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->id_be->caption(), $rekmeddokter_add->id_be->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->keluhan->Required) { ?>
				elm = this.getElements("x" + infix + "_keluhan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->keluhan->caption(), $rekmeddokter_add->keluhan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->gejala_klinis->Required) { ?>
				elm = this.getElements("x" + infix + "_gejala_klinis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->gejala_klinis->caption(), $rekmeddokter_add->gejala_klinis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->terapi->Required) { ?>
				elm = this.getElements("x" + infix + "_terapi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->terapi->caption(), $rekmeddokter_add->terapi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->tindakan->Required) { ?>
				elm = this.getElements("x" + infix + "_tindakan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->tindakan->caption(), $rekmeddokter_add->tindakan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($rekmeddokter_add->foto_perawatan->Required) { ?>
				felm = this.getElements("x" + infix + "_foto_perawatan");
				elm = this.getElements("fn_x" + infix + "_foto_perawatan");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $rekmeddokter_add->foto_perawatan->caption(), $rekmeddokter_add->foto_perawatan->RequiredErrorMessage)) ?>");
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
	frekmeddokteradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frekmeddokteradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frekmeddokteradd.lists["x_id_pelanggan"] = <?php echo $rekmeddokter_add->id_pelanggan->Lookup->toClientList($rekmeddokter_add) ?>;
	frekmeddokteradd.lists["x_id_pelanggan"].options = <?php echo JsonEncode($rekmeddokter_add->id_pelanggan->lookupOptions()) ?>;
	frekmeddokteradd.lists["x_id_dokter"] = <?php echo $rekmeddokter_add->id_dokter->Lookup->toClientList($rekmeddokter_add) ?>;
	frekmeddokteradd.lists["x_id_dokter"].options = <?php echo JsonEncode($rekmeddokter_add->id_dokter->lookupOptions()) ?>;
	frekmeddokteradd.lists["x_id_be"] = <?php echo $rekmeddokter_add->id_be->Lookup->toClientList($rekmeddokter_add) ?>;
	frekmeddokteradd.lists["x_id_be"].options = <?php echo JsonEncode($rekmeddokter_add->id_be->lookupOptions()) ?>;
	loadjs.done("frekmeddokteradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rekmeddokter_add->showPageHeader(); ?>
<?php
$rekmeddokter_add->showMessage();
?>
<form name="frekmeddokteradd" id="frekmeddokteradd" class="<?php echo $rekmeddokter_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekmeddokter">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$rekmeddokter_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($rekmeddokter_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_rekmeddokter_tanggal" for="x_tanggal" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->tanggal->caption() ?><?php echo $rekmeddokter_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->tanggal->cellAttributes() ?>>
<span id="el_rekmeddokter_tanggal">
<input type="text" data-table="rekmeddokter" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($rekmeddokter_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $rekmeddokter_add->tanggal->EditValue ?>"<?php echo $rekmeddokter_add->tanggal->editAttributes() ?>>
<?php if (!$rekmeddokter_add->tanggal->ReadOnly && !$rekmeddokter_add->tanggal->Disabled && !isset($rekmeddokter_add->tanggal->EditAttrs["readonly"]) && !isset($rekmeddokter_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frekmeddokteradd", "datetimepicker"], function() {
	ew.createDateTimePicker("frekmeddokteradd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $rekmeddokter_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label id="elh_rekmeddokter_id_pelanggan" for="x_id_pelanggan" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->id_pelanggan->caption() ?><?php echo $rekmeddokter_add->id_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->id_pelanggan->cellAttributes() ?>>
<span id="el_rekmeddokter_id_pelanggan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_pelanggan"><?php echo EmptyValue(strval($rekmeddokter_add->id_pelanggan->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekmeddokter_add->id_pelanggan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekmeddokter_add->id_pelanggan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekmeddokter_add->id_pelanggan->ReadOnly || $rekmeddokter_add->id_pelanggan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_pelanggan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekmeddokter_add->id_pelanggan->Lookup->getParamTag($rekmeddokter_add, "p_x_id_pelanggan") ?>
<input type="hidden" data-table="rekmeddokter" data-field="x_id_pelanggan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekmeddokter_add->id_pelanggan->displayValueSeparatorAttribute() ?>" name="x_id_pelanggan" id="x_id_pelanggan" value="<?php echo $rekmeddokter_add->id_pelanggan->CurrentValue ?>"<?php echo $rekmeddokter_add->id_pelanggan->editAttributes() ?>>
</span>
<?php echo $rekmeddokter_add->id_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->id_dokter->Visible) { // id_dokter ?>
	<div id="r_id_dokter" class="form-group row">
		<label id="elh_rekmeddokter_id_dokter" for="x_id_dokter" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->id_dokter->caption() ?><?php echo $rekmeddokter_add->id_dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->id_dokter->cellAttributes() ?>>
<span id="el_rekmeddokter_id_dokter">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_dokter"><?php echo EmptyValue(strval($rekmeddokter_add->id_dokter->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekmeddokter_add->id_dokter->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekmeddokter_add->id_dokter->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekmeddokter_add->id_dokter->ReadOnly || $rekmeddokter_add->id_dokter->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_dokter',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekmeddokter_add->id_dokter->Lookup->getParamTag($rekmeddokter_add, "p_x_id_dokter") ?>
<input type="hidden" data-table="rekmeddokter" data-field="x_id_dokter" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekmeddokter_add->id_dokter->displayValueSeparatorAttribute() ?>" name="x_id_dokter" id="x_id_dokter" value="<?php echo $rekmeddokter_add->id_dokter->CurrentValue ?>"<?php echo $rekmeddokter_add->id_dokter->editAttributes() ?>>
</span>
<?php echo $rekmeddokter_add->id_dokter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->id_be->Visible) { // id_be ?>
	<div id="r_id_be" class="form-group row">
		<label id="elh_rekmeddokter_id_be" for="x_id_be" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->id_be->caption() ?><?php echo $rekmeddokter_add->id_be->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->id_be->cellAttributes() ?>>
<span id="el_rekmeddokter_id_be">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_be"><?php echo EmptyValue(strval($rekmeddokter_add->id_be->ViewValue)) ? $Language->phrase("PleaseSelect") : $rekmeddokter_add->id_be->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekmeddokter_add->id_be->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($rekmeddokter_add->id_be->ReadOnly || $rekmeddokter_add->id_be->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_be',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $rekmeddokter_add->id_be->Lookup->getParamTag($rekmeddokter_add, "p_x_id_be") ?>
<input type="hidden" data-table="rekmeddokter" data-field="x_id_be" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekmeddokter_add->id_be->displayValueSeparatorAttribute() ?>" name="x_id_be" id="x_id_be" value="<?php echo $rekmeddokter_add->id_be->CurrentValue ?>"<?php echo $rekmeddokter_add->id_be->editAttributes() ?>>
</span>
<?php echo $rekmeddokter_add->id_be->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->keluhan->Visible) { // keluhan ?>
	<div id="r_keluhan" class="form-group row">
		<label id="elh_rekmeddokter_keluhan" for="x_keluhan" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->keluhan->caption() ?><?php echo $rekmeddokter_add->keluhan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->keluhan->cellAttributes() ?>>
<span id="el_rekmeddokter_keluhan">
<textarea data-table="rekmeddokter" data-field="x_keluhan" name="x_keluhan" id="x_keluhan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($rekmeddokter_add->keluhan->getPlaceHolder()) ?>"<?php echo $rekmeddokter_add->keluhan->editAttributes() ?>><?php echo $rekmeddokter_add->keluhan->EditValue ?></textarea>
</span>
<?php echo $rekmeddokter_add->keluhan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->gejala_klinis->Visible) { // gejala_klinis ?>
	<div id="r_gejala_klinis" class="form-group row">
		<label id="elh_rekmeddokter_gejala_klinis" for="x_gejala_klinis" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->gejala_klinis->caption() ?><?php echo $rekmeddokter_add->gejala_klinis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->gejala_klinis->cellAttributes() ?>>
<span id="el_rekmeddokter_gejala_klinis">
<textarea data-table="rekmeddokter" data-field="x_gejala_klinis" name="x_gejala_klinis" id="x_gejala_klinis" cols="35" rows="4" placeholder="<?php echo HtmlEncode($rekmeddokter_add->gejala_klinis->getPlaceHolder()) ?>"<?php echo $rekmeddokter_add->gejala_klinis->editAttributes() ?>><?php echo $rekmeddokter_add->gejala_klinis->EditValue ?></textarea>
</span>
<?php echo $rekmeddokter_add->gejala_klinis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->terapi->Visible) { // terapi ?>
	<div id="r_terapi" class="form-group row">
		<label id="elh_rekmeddokter_terapi" for="x_terapi" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->terapi->caption() ?><?php echo $rekmeddokter_add->terapi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->terapi->cellAttributes() ?>>
<span id="el_rekmeddokter_terapi">
<textarea data-table="rekmeddokter" data-field="x_terapi" name="x_terapi" id="x_terapi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($rekmeddokter_add->terapi->getPlaceHolder()) ?>"<?php echo $rekmeddokter_add->terapi->editAttributes() ?>><?php echo $rekmeddokter_add->terapi->EditValue ?></textarea>
</span>
<?php echo $rekmeddokter_add->terapi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->tindakan->Visible) { // tindakan ?>
	<div id="r_tindakan" class="form-group row">
		<label id="elh_rekmeddokter_tindakan" for="x_tindakan" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->tindakan->caption() ?><?php echo $rekmeddokter_add->tindakan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->tindakan->cellAttributes() ?>>
<span id="el_rekmeddokter_tindakan">
<textarea data-table="rekmeddokter" data-field="x_tindakan" name="x_tindakan" id="x_tindakan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($rekmeddokter_add->tindakan->getPlaceHolder()) ?>"<?php echo $rekmeddokter_add->tindakan->editAttributes() ?>><?php echo $rekmeddokter_add->tindakan->EditValue ?></textarea>
</span>
<?php echo $rekmeddokter_add->tindakan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekmeddokter_add->foto_perawatan->Visible) { // foto_perawatan ?>
	<div id="r_foto_perawatan" class="form-group row">
		<label id="elh_rekmeddokter_foto_perawatan" class="<?php echo $rekmeddokter_add->LeftColumnClass ?>"><?php echo $rekmeddokter_add->foto_perawatan->caption() ?><?php echo $rekmeddokter_add->foto_perawatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekmeddokter_add->RightColumnClass ?>"><div <?php echo $rekmeddokter_add->foto_perawatan->cellAttributes() ?>>
<span id="el_rekmeddokter_foto_perawatan">
<div id="fd_x_foto_perawatan">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $rekmeddokter_add->foto_perawatan->title() ?>" data-table="rekmeddokter" data-field="x_foto_perawatan" name="x_foto_perawatan" id="x_foto_perawatan" lang="<?php echo CurrentLanguageID() ?>" multiple="multiple"<?php echo $rekmeddokter_add->foto_perawatan->editAttributes() ?><?php if ($rekmeddokter_add->foto_perawatan->ReadOnly || $rekmeddokter_add->foto_perawatan->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto_perawatan"><?php echo $Language->phrase("ChooseFiles") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto_perawatan" id= "fn_x_foto_perawatan" value="<?php echo $rekmeddokter_add->foto_perawatan->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto_perawatan" id= "fa_x_foto_perawatan" value="0">
<input type="hidden" name="fs_x_foto_perawatan" id= "fs_x_foto_perawatan" value="16777215">
<input type="hidden" name="fx_x_foto_perawatan" id= "fx_x_foto_perawatan" value="<?php echo $rekmeddokter_add->foto_perawatan->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto_perawatan" id= "fm_x_foto_perawatan" value="<?php echo $rekmeddokter_add->foto_perawatan->UploadMaxFileSize ?>">
<input type="hidden" name="fc_x_foto_perawatan" id= "fc_x_foto_perawatan" value="<?php echo $rekmeddokter_add->foto_perawatan->UploadMaxFileCount ?>">
</div>
<table id="ft_x_foto_perawatan" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $rekmeddokter_add->foto_perawatan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($rekmeddokter->getCurrentDetailTable() != "") { ?>
<?php
	$rekmeddokter_add->DetailPages->ValidKeys = explode(",", $rekmeddokter->getCurrentDetailTable());
	$firstActiveDetailTable = $rekmeddokter_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="rekmeddokter_add_details"><!-- tabs -->
	<ul class="<?php echo $rekmeddokter_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("detailrekmeddok", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmeddok->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmeddok") {
			$firstActiveDetailTable = "detailrekmeddok";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $rekmeddokter_add->DetailPages->pageStyle("detailrekmeddok") ?>" href="#tab_detailrekmeddok" data-toggle="tab"><?php echo $Language->tablePhrase("detailrekmeddok", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("detailrekmedterapis", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedterapis->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedterapis") {
			$firstActiveDetailTable = "detailrekmedterapis";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $rekmeddokter_add->DetailPages->pageStyle("detailrekmedterapis") ?>" href="#tab_detailrekmedterapis" data-toggle="tab"><?php echo $Language->tablePhrase("detailrekmedterapis", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("detailrekmedpenjualan", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedpenjualan->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedpenjualan") {
			$firstActiveDetailTable = "detailrekmedpenjualan";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $rekmeddokter_add->DetailPages->pageStyle("detailrekmedpenjualan") ?>" href="#tab_detailrekmedpenjualan" data-toggle="tab"><?php echo $Language->tablePhrase("detailrekmedpenjualan", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("detailrekmeddok", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmeddok->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmeddok")
			$firstActiveDetailTable = "detailrekmeddok";
?>
		<div class="tab-pane <?php echo $rekmeddokter_add->DetailPages->pageStyle("detailrekmeddok") ?>" id="tab_detailrekmeddok"><!-- page* -->
<?php include_once "detailrekmeddokgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("detailrekmedterapis", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedterapis->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedterapis")
			$firstActiveDetailTable = "detailrekmedterapis";
?>
		<div class="tab-pane <?php echo $rekmeddokter_add->DetailPages->pageStyle("detailrekmedterapis") ?>" id="tab_detailrekmedterapis"><!-- page* -->
<?php include_once "detailrekmedterapisgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("detailrekmedpenjualan", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedpenjualan->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedpenjualan")
			$firstActiveDetailTable = "detailrekmedpenjualan";
?>
		<div class="tab-pane <?php echo $rekmeddokter_add->DetailPages->pageStyle("detailrekmedpenjualan") ?>" id="tab_detailrekmedpenjualan"><!-- page* -->
<?php include_once "detailrekmedpenjualangrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$rekmeddokter_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rekmeddokter_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rekmeddokter_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rekmeddokter_add->showPageFooter();
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
$rekmeddokter_add->terminate();
?>