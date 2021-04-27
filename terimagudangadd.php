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
$terimagudang_add = new terimagudang_add();

// Run the page
$terimagudang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimagudang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterimagudangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fterimagudangadd = currentForm = new ew.Form("fterimagudangadd", "add");

	// Validate form
	fterimagudangadd.validate = function() {
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
			<?php if ($terimagudang_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimagudang_add->id_klinik->caption(), $terimagudang_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terimagudang_add->diterima->Required) { ?>
				elm = this.getElements("x" + infix + "_diterima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimagudang_add->diterima->caption(), $terimagudang_add->diterima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_diterima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($terimagudang_add->diterima->errorMessage()) ?>");
			<?php if ($terimagudang_add->tanggal_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimagudang_add->tanggal_terima->caption(), $terimagudang_add->tanggal_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_terima");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($terimagudang_add->tanggal_terima->errorMessage()) ?>");
			<?php if ($terimagudang_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimagudang_add->keterangan->caption(), $terimagudang_add->keterangan->RequiredErrorMessage)) ?>");
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
	fterimagudangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fterimagudangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fterimagudangadd.lists["x_id_klinik"] = <?php echo $terimagudang_add->id_klinik->Lookup->toClientList($terimagudang_add) ?>;
	fterimagudangadd.lists["x_id_klinik"].options = <?php echo JsonEncode($terimagudang_add->id_klinik->lookupOptions()) ?>;
	fterimagudangadd.lists["x_diterima"] = <?php echo $terimagudang_add->diterima->Lookup->toClientList($terimagudang_add) ?>;
	fterimagudangadd.lists["x_diterima"].options = <?php echo JsonEncode($terimagudang_add->diterima->lookupOptions()) ?>;
	fterimagudangadd.autoSuggests["x_diterima"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fterimagudangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terimagudang_add->showPageHeader(); ?>
<?php
$terimagudang_add->showMessage();
?>
<form name="fterimagudangadd" id="fterimagudangadd" class="<?php echo $terimagudang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimagudang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$terimagudang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($terimagudang_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_terimagudang_id_klinik" for="x_id_klinik" class="<?php echo $terimagudang_add->LeftColumnClass ?>"><?php echo $terimagudang_add->id_klinik->caption() ?><?php echo $terimagudang_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimagudang_add->RightColumnClass ?>"><div <?php echo $terimagudang_add->id_klinik->cellAttributes() ?>>
<span id="el_terimagudang_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimagudang" data-field="x_id_klinik" data-value-separator="<?php echo $terimagudang_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $terimagudang_add->id_klinik->editAttributes() ?>>
			<?php echo $terimagudang_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $terimagudang_add->id_klinik->Lookup->getParamTag($terimagudang_add, "p_x_id_klinik") ?>
</span>
<?php echo $terimagudang_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_add->diterima->Visible) { // diterima ?>
	<div id="r_diterima" class="form-group row">
		<label id="elh_terimagudang_diterima" class="<?php echo $terimagudang_add->LeftColumnClass ?>"><?php echo $terimagudang_add->diterima->caption() ?><?php echo $terimagudang_add->diterima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimagudang_add->RightColumnClass ?>"><div <?php echo $terimagudang_add->diterima->cellAttributes() ?>>
<span id="el_terimagudang_diterima">
<?php
$onchange = $terimagudang_add->diterima->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$terimagudang_add->diterima->EditAttrs["onchange"] = "";
?>
<span id="as_x_diterima">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_diterima" id="sv_x_diterima" value="<?php echo RemoveHtml($terimagudang_add->diterima->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($terimagudang_add->diterima->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($terimagudang_add->diterima->getPlaceHolder()) ?>"<?php echo $terimagudang_add->diterima->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($terimagudang_add->diterima->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_diterima',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($terimagudang_add->diterima->ReadOnly || $terimagudang_add->diterima->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="terimagudang" data-field="x_diterima" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $terimagudang_add->diterima->displayValueSeparatorAttribute() ?>" name="x_diterima" id="x_diterima" value="<?php echo HtmlEncode($terimagudang_add->diterima->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fterimagudangadd"], function() {
	fterimagudangadd.createAutoSuggest({"id":"x_diterima","forceSelect":true});
});
</script>
<?php echo $terimagudang_add->diterima->Lookup->getParamTag($terimagudang_add, "p_x_diterima") ?>
</span>
<?php echo $terimagudang_add->diterima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_add->tanggal_terima->Visible) { // tanggal_terima ?>
	<div id="r_tanggal_terima" class="form-group row">
		<label id="elh_terimagudang_tanggal_terima" for="x_tanggal_terima" class="<?php echo $terimagudang_add->LeftColumnClass ?>"><?php echo $terimagudang_add->tanggal_terima->caption() ?><?php echo $terimagudang_add->tanggal_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimagudang_add->RightColumnClass ?>"><div <?php echo $terimagudang_add->tanggal_terima->cellAttributes() ?>>
<span id="el_terimagudang_tanggal_terima">
<input type="text" data-table="terimagudang" data-field="x_tanggal_terima" name="x_tanggal_terima" id="x_tanggal_terima" maxlength="10" placeholder="<?php echo HtmlEncode($terimagudang_add->tanggal_terima->getPlaceHolder()) ?>" value="<?php echo $terimagudang_add->tanggal_terima->EditValue ?>"<?php echo $terimagudang_add->tanggal_terima->editAttributes() ?>>
<?php if (!$terimagudang_add->tanggal_terima->ReadOnly && !$terimagudang_add->tanggal_terima->Disabled && !isset($terimagudang_add->tanggal_terima->EditAttrs["readonly"]) && !isset($terimagudang_add->tanggal_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fterimagudangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fterimagudangadd", "x_tanggal_terima", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $terimagudang_add->tanggal_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimagudang_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_terimagudang_keterangan" for="x_keterangan" class="<?php echo $terimagudang_add->LeftColumnClass ?>"><?php echo $terimagudang_add->keterangan->caption() ?><?php echo $terimagudang_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimagudang_add->RightColumnClass ?>"><div <?php echo $terimagudang_add->keterangan->cellAttributes() ?>>
<span id="el_terimagudang_keterangan">
<textarea data-table="terimagudang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terimagudang_add->keterangan->getPlaceHolder()) ?>"<?php echo $terimagudang_add->keterangan->editAttributes() ?>><?php echo $terimagudang_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $terimagudang_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailterimagudang", explode(",", $terimagudang->getCurrentDetailTable())) && $detailterimagudang->DetailAdd) {
?>
<?php if ($terimagudang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailterimagudang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailterimagudanggrid.php" ?>
<?php } ?>
<?php if (!$terimagudang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terimagudang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terimagudang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$terimagudang_add->showPageFooter();
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
$terimagudang_add->terminate();
?>