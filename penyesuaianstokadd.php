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
$penyesuaianstok_add = new penyesuaianstok_add();

// Run the page
$penyesuaianstok_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaianstok_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaianstokadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpenyesuaianstokadd = currentForm = new ew.Form("fpenyesuaianstokadd", "add");

	// Validate form
	fpenyesuaianstokadd.validate = function() {
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
			<?php if ($penyesuaianstok_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_add->tanggal->caption(), $penyesuaianstok_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penyesuaianstok_add->tanggal->errorMessage()) ?>");
			<?php if ($penyesuaianstok_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_add->id_klinik->caption(), $penyesuaianstok_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaianstok_add->lampiran->Required) { ?>
				felm = this.getElements("x" + infix + "_lampiran");
				elm = this.getElements("fn_x" + infix + "_lampiran");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_add->lampiran->caption(), $penyesuaianstok_add->lampiran->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaianstok_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaianstok_add->keterangan->caption(), $penyesuaianstok_add->keterangan->RequiredErrorMessage)) ?>");
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
	fpenyesuaianstokadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenyesuaianstokadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenyesuaianstokadd.lists["x_id_klinik"] = <?php echo $penyesuaianstok_add->id_klinik->Lookup->toClientList($penyesuaianstok_add) ?>;
	fpenyesuaianstokadd.lists["x_id_klinik"].options = <?php echo JsonEncode($penyesuaianstok_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fpenyesuaianstokadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("[data-field=x_jumlah]").keyup(function(){var l=$(this).attr("id");console.log(l);var a="#"+l.split("_")[0];console.log(a);var e,o=a+"_stokdatabase",i=a+"_selisih",s=a+"_tipe",t=0;if(e=parseFloat($(a+"_jumlah").val().split(",").join(".")),t=$(o).val()?(t=$(o).val().split(".").join("")).replace(",","."):0,$(i).val()?$(i).val().split(".").join("").replace(".",","):0,console.log(t),console.log(e),t<e){$(s).val("Masuk");var v=e-t;v=(v=v.toFixed(2)).replace(".",","),$(i).val(v)}else{$(s).val("Keluar");var r=t-e;r=(r=r.toFixed(2)).replace(".",","),$(i).val(r)}});
});
</script>
<?php $penyesuaianstok_add->showPageHeader(); ?>
<?php
$penyesuaianstok_add->showMessage();
?>
<form name="fpenyesuaianstokadd" id="fpenyesuaianstokadd" class="<?php echo $penyesuaianstok_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaianstok">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaianstok_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($penyesuaianstok_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_penyesuaianstok_tanggal" for="x_tanggal" class="<?php echo $penyesuaianstok_add->LeftColumnClass ?>"><?php echo $penyesuaianstok_add->tanggal->caption() ?><?php echo $penyesuaianstok_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_add->RightColumnClass ?>"><div <?php echo $penyesuaianstok_add->tanggal->cellAttributes() ?>>
<span id="el_penyesuaianstok_tanggal">
<input type="text" data-table="penyesuaianstok" data-field="x_tanggal" data-format="7" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($penyesuaianstok_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $penyesuaianstok_add->tanggal->EditValue ?>"<?php echo $penyesuaianstok_add->tanggal->editAttributes() ?>>
<?php if (!$penyesuaianstok_add->tanggal->ReadOnly && !$penyesuaianstok_add->tanggal->Disabled && !isset($penyesuaianstok_add->tanggal->EditAttrs["readonly"]) && !isset($penyesuaianstok_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenyesuaianstokadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenyesuaianstokadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $penyesuaianstok_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_penyesuaianstok_id_klinik" for="x_id_klinik" class="<?php echo $penyesuaianstok_add->LeftColumnClass ?>"><?php echo $penyesuaianstok_add->id_klinik->caption() ?><?php echo $penyesuaianstok_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_add->RightColumnClass ?>"><div <?php echo $penyesuaianstok_add->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaianstok_id_klinik">
<?php $penyesuaianstok_add->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penyesuaianstok" data-field="x_id_klinik" data-value-separator="<?php echo $penyesuaianstok_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $penyesuaianstok_add->id_klinik->editAttributes() ?>>
			<?php echo $penyesuaianstok_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $penyesuaianstok_add->id_klinik->Lookup->getParamTag($penyesuaianstok_add, "p_x_id_klinik") ?>
</span>
<?php echo $penyesuaianstok_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_add->lampiran->Visible) { // lampiran ?>
	<div id="r_lampiran" class="form-group row">
		<label id="elh_penyesuaianstok_lampiran" class="<?php echo $penyesuaianstok_add->LeftColumnClass ?>"><?php echo $penyesuaianstok_add->lampiran->caption() ?><?php echo $penyesuaianstok_add->lampiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_add->RightColumnClass ?>"><div <?php echo $penyesuaianstok_add->lampiran->cellAttributes() ?>>
<span id="el_penyesuaianstok_lampiran">
<div id="fd_x_lampiran">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $penyesuaianstok_add->lampiran->title() ?>" data-table="penyesuaianstok" data-field="x_lampiran" name="x_lampiran" id="x_lampiran" lang="<?php echo CurrentLanguageID() ?>"<?php echo $penyesuaianstok_add->lampiran->editAttributes() ?><?php if ($penyesuaianstok_add->lampiran->ReadOnly || $penyesuaianstok_add->lampiran->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_lampiran"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_lampiran" id= "fn_x_lampiran" value="<?php echo $penyesuaianstok_add->lampiran->Upload->FileName ?>">
<input type="hidden" name="fa_x_lampiran" id= "fa_x_lampiran" value="0">
<input type="hidden" name="fs_x_lampiran" id= "fs_x_lampiran" value="255">
<input type="hidden" name="fx_x_lampiran" id= "fx_x_lampiran" value="<?php echo $penyesuaianstok_add->lampiran->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_lampiran" id= "fm_x_lampiran" value="<?php echo $penyesuaianstok_add->lampiran->UploadMaxFileSize ?>">
</div>
<table id="ft_x_lampiran" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $penyesuaianstok_add->lampiran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaianstok_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_penyesuaianstok_keterangan" for="x_keterangan" class="<?php echo $penyesuaianstok_add->LeftColumnClass ?>"><?php echo $penyesuaianstok_add->keterangan->caption() ?><?php echo $penyesuaianstok_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaianstok_add->RightColumnClass ?>"><div <?php echo $penyesuaianstok_add->keterangan->cellAttributes() ?>>
<span id="el_penyesuaianstok_keterangan">
<textarea data-table="penyesuaianstok" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($penyesuaianstok_add->keterangan->getPlaceHolder()) ?>"<?php echo $penyesuaianstok_add->keterangan->editAttributes() ?>><?php echo $penyesuaianstok_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $penyesuaianstok_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailpenyesuaianstok", explode(",", $penyesuaianstok->getCurrentDetailTable())) && $detailpenyesuaianstok->DetailAdd) {
?>
<?php if ($penyesuaianstok->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenyesuaianstok", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpenyesuaianstokgrid.php" ?>
<?php } ?>
<?php if (!$penyesuaianstok_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penyesuaianstok_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penyesuaianstok_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penyesuaianstok_add->showPageFooter();
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
$penyesuaianstok_add->terminate();
?>