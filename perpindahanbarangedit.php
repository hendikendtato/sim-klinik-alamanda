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
$perpindahanbarang_edit = new perpindahanbarang_edit();

// Run the page
$perpindahanbarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perpindahanbarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperpindahanbarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fperpindahanbarangedit = currentForm = new ew.Form("fperpindahanbarangedit", "edit");

	// Validate form
	fperpindahanbarangedit.validate = function() {
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
			<?php if ($perpindahanbarang_edit->id_perpindahanbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_perpindahanbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_edit->id_perpindahanbarang->caption(), $perpindahanbarang_edit->id_perpindahanbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($perpindahanbarang_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_edit->tanggal->caption(), $perpindahanbarang_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($perpindahanbarang_edit->tanggal->errorMessage()) ?>");
			<?php if ($perpindahanbarang_edit->asal->Required) { ?>
				elm = this.getElements("x" + infix + "_asal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_edit->asal->caption(), $perpindahanbarang_edit->asal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($perpindahanbarang_edit->tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_edit->tujuan->caption(), $perpindahanbarang_edit->tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($perpindahanbarang_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_edit->keterangan->caption(), $perpindahanbarang_edit->keterangan->RequiredErrorMessage)) ?>");
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
	fperpindahanbarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperpindahanbarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fperpindahanbarangedit.lists["x_asal"] = <?php echo $perpindahanbarang_edit->asal->Lookup->toClientList($perpindahanbarang_edit) ?>;
	fperpindahanbarangedit.lists["x_asal"].options = <?php echo JsonEncode($perpindahanbarang_edit->asal->lookupOptions()) ?>;
	fperpindahanbarangedit.lists["x_tujuan"] = <?php echo $perpindahanbarang_edit->tujuan->Lookup->toClientList($perpindahanbarang_edit) ?>;
	fperpindahanbarangedit.lists["x_tujuan"].options = <?php echo JsonEncode($perpindahanbarang_edit->tujuan->lookupOptions()) ?>;
	loadjs.done("fperpindahanbarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perpindahanbarang_edit->showPageHeader(); ?>
<?php
$perpindahanbarang_edit->showMessage();
?>
<form name="fperpindahanbarangedit" id="fperpindahanbarangedit" class="<?php echo $perpindahanbarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perpindahanbarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$perpindahanbarang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($perpindahanbarang_edit->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<div id="r_id_perpindahanbarang" class="form-group row">
		<label id="elh_perpindahanbarang_id_perpindahanbarang" class="<?php echo $perpindahanbarang_edit->LeftColumnClass ?>"><?php echo $perpindahanbarang_edit->id_perpindahanbarang->caption() ?><?php echo $perpindahanbarang_edit->id_perpindahanbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_edit->RightColumnClass ?>"><div <?php echo $perpindahanbarang_edit->id_perpindahanbarang->cellAttributes() ?>>
<span id="el_perpindahanbarang_id_perpindahanbarang">
<span<?php echo $perpindahanbarang_edit->id_perpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($perpindahanbarang_edit->id_perpindahanbarang->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="perpindahanbarang" data-field="x_id_perpindahanbarang" name="x_id_perpindahanbarang" id="x_id_perpindahanbarang" value="<?php echo HtmlEncode($perpindahanbarang_edit->id_perpindahanbarang->CurrentValue) ?>">
<?php echo $perpindahanbarang_edit->id_perpindahanbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_perpindahanbarang_tanggal" for="x_tanggal" class="<?php echo $perpindahanbarang_edit->LeftColumnClass ?>"><?php echo $perpindahanbarang_edit->tanggal->caption() ?><?php echo $perpindahanbarang_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_edit->RightColumnClass ?>"><div <?php echo $perpindahanbarang_edit->tanggal->cellAttributes() ?>>
<span id="el_perpindahanbarang_tanggal">
<input type="text" data-table="perpindahanbarang" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($perpindahanbarang_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $perpindahanbarang_edit->tanggal->EditValue ?>"<?php echo $perpindahanbarang_edit->tanggal->editAttributes() ?>>
<?php if (!$perpindahanbarang_edit->tanggal->ReadOnly && !$perpindahanbarang_edit->tanggal->Disabled && !isset($perpindahanbarang_edit->tanggal->EditAttrs["readonly"]) && !isset($perpindahanbarang_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fperpindahanbarangedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fperpindahanbarangedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $perpindahanbarang_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_edit->asal->Visible) { // asal ?>
	<div id="r_asal" class="form-group row">
		<label id="elh_perpindahanbarang_asal" for="x_asal" class="<?php echo $perpindahanbarang_edit->LeftColumnClass ?>"><?php echo $perpindahanbarang_edit->asal->caption() ?><?php echo $perpindahanbarang_edit->asal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_edit->RightColumnClass ?>"><div <?php echo $perpindahanbarang_edit->asal->cellAttributes() ?>>
<span id="el_perpindahanbarang_asal">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_asal"><?php echo EmptyValue(strval($perpindahanbarang_edit->asal->ViewValue)) ? $Language->phrase("PleaseSelect") : $perpindahanbarang_edit->asal->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($perpindahanbarang_edit->asal->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($perpindahanbarang_edit->asal->ReadOnly || $perpindahanbarang_edit->asal->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_asal',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $perpindahanbarang_edit->asal->Lookup->getParamTag($perpindahanbarang_edit, "p_x_asal") ?>
<input type="hidden" data-table="perpindahanbarang" data-field="x_asal" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $perpindahanbarang_edit->asal->displayValueSeparatorAttribute() ?>" name="x_asal" id="x_asal" value="<?php echo $perpindahanbarang_edit->asal->CurrentValue ?>"<?php echo $perpindahanbarang_edit->asal->editAttributes() ?>>
</span>
<?php echo $perpindahanbarang_edit->asal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_edit->tujuan->Visible) { // tujuan ?>
	<div id="r_tujuan" class="form-group row">
		<label id="elh_perpindahanbarang_tujuan" for="x_tujuan" class="<?php echo $perpindahanbarang_edit->LeftColumnClass ?>"><?php echo $perpindahanbarang_edit->tujuan->caption() ?><?php echo $perpindahanbarang_edit->tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_edit->RightColumnClass ?>"><div <?php echo $perpindahanbarang_edit->tujuan->cellAttributes() ?>>
<span id="el_perpindahanbarang_tujuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_tujuan"><?php echo EmptyValue(strval($perpindahanbarang_edit->tujuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $perpindahanbarang_edit->tujuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($perpindahanbarang_edit->tujuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($perpindahanbarang_edit->tujuan->ReadOnly || $perpindahanbarang_edit->tujuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_tujuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $perpindahanbarang_edit->tujuan->Lookup->getParamTag($perpindahanbarang_edit, "p_x_tujuan") ?>
<input type="hidden" data-table="perpindahanbarang" data-field="x_tujuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $perpindahanbarang_edit->tujuan->displayValueSeparatorAttribute() ?>" name="x_tujuan" id="x_tujuan" value="<?php echo $perpindahanbarang_edit->tujuan->CurrentValue ?>"<?php echo $perpindahanbarang_edit->tujuan->editAttributes() ?>>
</span>
<?php echo $perpindahanbarang_edit->tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_perpindahanbarang_keterangan" for="x_keterangan" class="<?php echo $perpindahanbarang_edit->LeftColumnClass ?>"><?php echo $perpindahanbarang_edit->keterangan->caption() ?><?php echo $perpindahanbarang_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_edit->RightColumnClass ?>"><div <?php echo $perpindahanbarang_edit->keterangan->cellAttributes() ?>>
<span id="el_perpindahanbarang_keterangan">
<textarea data-table="perpindahanbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($perpindahanbarang_edit->keterangan->getPlaceHolder()) ?>"<?php echo $perpindahanbarang_edit->keterangan->editAttributes() ?>><?php echo $perpindahanbarang_edit->keterangan->EditValue ?></textarea>
</span>
<?php echo $perpindahanbarang_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailperpindahanbarang", explode(",", $perpindahanbarang->getCurrentDetailTable())) && $detailperpindahanbarang->DetailEdit) {
?>
<?php if ($perpindahanbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailperpindahanbarang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailperpindahanbaranggrid.php" ?>
<?php } ?>
<?php if (!$perpindahanbarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $perpindahanbarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perpindahanbarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$perpindahanbarang_edit->showPageFooter();
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
$perpindahanbarang_edit->terminate();
?>