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
$perpindahanbarang_add = new perpindahanbarang_add();

// Run the page
$perpindahanbarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perpindahanbarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperpindahanbarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fperpindahanbarangadd = currentForm = new ew.Form("fperpindahanbarangadd", "add");

	// Validate form
	fperpindahanbarangadd.validate = function() {
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
			<?php if ($perpindahanbarang_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_add->tanggal->caption(), $perpindahanbarang_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($perpindahanbarang_add->tanggal->errorMessage()) ?>");
			<?php if ($perpindahanbarang_add->asal->Required) { ?>
				elm = this.getElements("x" + infix + "_asal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_add->asal->caption(), $perpindahanbarang_add->asal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($perpindahanbarang_add->tujuan->Required) { ?>
				elm = this.getElements("x" + infix + "_tujuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_add->tujuan->caption(), $perpindahanbarang_add->tujuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($perpindahanbarang_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $perpindahanbarang_add->keterangan->caption(), $perpindahanbarang_add->keterangan->RequiredErrorMessage)) ?>");
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
	fperpindahanbarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperpindahanbarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fperpindahanbarangadd.lists["x_asal"] = <?php echo $perpindahanbarang_add->asal->Lookup->toClientList($perpindahanbarang_add) ?>;
	fperpindahanbarangadd.lists["x_asal"].options = <?php echo JsonEncode($perpindahanbarang_add->asal->lookupOptions()) ?>;
	fperpindahanbarangadd.lists["x_tujuan"] = <?php echo $perpindahanbarang_add->tujuan->Lookup->toClientList($perpindahanbarang_add) ?>;
	fperpindahanbarangadd.lists["x_tujuan"].options = <?php echo JsonEncode($perpindahanbarang_add->tujuan->lookupOptions()) ?>;
	loadjs.done("fperpindahanbarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $perpindahanbarang_add->showPageHeader(); ?>
<?php
$perpindahanbarang_add->showMessage();
?>
<form name="fperpindahanbarangadd" id="fperpindahanbarangadd" class="<?php echo $perpindahanbarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perpindahanbarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$perpindahanbarang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($perpindahanbarang_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_perpindahanbarang_tanggal" for="x_tanggal" class="<?php echo $perpindahanbarang_add->LeftColumnClass ?>"><?php echo $perpindahanbarang_add->tanggal->caption() ?><?php echo $perpindahanbarang_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_add->RightColumnClass ?>"><div <?php echo $perpindahanbarang_add->tanggal->cellAttributes() ?>>
<span id="el_perpindahanbarang_tanggal">
<input type="text" data-table="perpindahanbarang" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($perpindahanbarang_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $perpindahanbarang_add->tanggal->EditValue ?>"<?php echo $perpindahanbarang_add->tanggal->editAttributes() ?>>
<?php if (!$perpindahanbarang_add->tanggal->ReadOnly && !$perpindahanbarang_add->tanggal->Disabled && !isset($perpindahanbarang_add->tanggal->EditAttrs["readonly"]) && !isset($perpindahanbarang_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fperpindahanbarangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fperpindahanbarangadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $perpindahanbarang_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_add->asal->Visible) { // asal ?>
	<div id="r_asal" class="form-group row">
		<label id="elh_perpindahanbarang_asal" for="x_asal" class="<?php echo $perpindahanbarang_add->LeftColumnClass ?>"><?php echo $perpindahanbarang_add->asal->caption() ?><?php echo $perpindahanbarang_add->asal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_add->RightColumnClass ?>"><div <?php echo $perpindahanbarang_add->asal->cellAttributes() ?>>
<span id="el_perpindahanbarang_asal">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_asal"><?php echo EmptyValue(strval($perpindahanbarang_add->asal->ViewValue)) ? $Language->phrase("PleaseSelect") : $perpindahanbarang_add->asal->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($perpindahanbarang_add->asal->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($perpindahanbarang_add->asal->ReadOnly || $perpindahanbarang_add->asal->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_asal',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $perpindahanbarang_add->asal->Lookup->getParamTag($perpindahanbarang_add, "p_x_asal") ?>
<input type="hidden" data-table="perpindahanbarang" data-field="x_asal" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $perpindahanbarang_add->asal->displayValueSeparatorAttribute() ?>" name="x_asal" id="x_asal" value="<?php echo $perpindahanbarang_add->asal->CurrentValue ?>"<?php echo $perpindahanbarang_add->asal->editAttributes() ?>>
</span>
<?php echo $perpindahanbarang_add->asal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_add->tujuan->Visible) { // tujuan ?>
	<div id="r_tujuan" class="form-group row">
		<label id="elh_perpindahanbarang_tujuan" for="x_tujuan" class="<?php echo $perpindahanbarang_add->LeftColumnClass ?>"><?php echo $perpindahanbarang_add->tujuan->caption() ?><?php echo $perpindahanbarang_add->tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_add->RightColumnClass ?>"><div <?php echo $perpindahanbarang_add->tujuan->cellAttributes() ?>>
<span id="el_perpindahanbarang_tujuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_tujuan"><?php echo EmptyValue(strval($perpindahanbarang_add->tujuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $perpindahanbarang_add->tujuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($perpindahanbarang_add->tujuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($perpindahanbarang_add->tujuan->ReadOnly || $perpindahanbarang_add->tujuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_tujuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $perpindahanbarang_add->tujuan->Lookup->getParamTag($perpindahanbarang_add, "p_x_tujuan") ?>
<input type="hidden" data-table="perpindahanbarang" data-field="x_tujuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $perpindahanbarang_add->tujuan->displayValueSeparatorAttribute() ?>" name="x_tujuan" id="x_tujuan" value="<?php echo $perpindahanbarang_add->tujuan->CurrentValue ?>"<?php echo $perpindahanbarang_add->tujuan->editAttributes() ?>>
</span>
<?php echo $perpindahanbarang_add->tujuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($perpindahanbarang_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_perpindahanbarang_keterangan" for="x_keterangan" class="<?php echo $perpindahanbarang_add->LeftColumnClass ?>"><?php echo $perpindahanbarang_add->keterangan->caption() ?><?php echo $perpindahanbarang_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $perpindahanbarang_add->RightColumnClass ?>"><div <?php echo $perpindahanbarang_add->keterangan->cellAttributes() ?>>
<span id="el_perpindahanbarang_keterangan">
<textarea data-table="perpindahanbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($perpindahanbarang_add->keterangan->getPlaceHolder()) ?>"<?php echo $perpindahanbarang_add->keterangan->editAttributes() ?>><?php echo $perpindahanbarang_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $perpindahanbarang_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailperpindahanbarang", explode(",", $perpindahanbarang->getCurrentDetailTable())) && $detailperpindahanbarang->DetailAdd) {
?>
<?php if ($perpindahanbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailperpindahanbarang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailperpindahanbaranggrid.php" ?>
<?php } ?>
<?php if (!$perpindahanbarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $perpindahanbarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $perpindahanbarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$perpindahanbarang_add->showPageFooter();
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
$perpindahanbarang_add->terminate();
?>