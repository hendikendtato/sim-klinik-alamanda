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
$detailpo_edit = new detailpo_edit();

// Run the page
$detailpo_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpoedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailpoedit = currentForm = new ew.Form("fdetailpoedit", "edit");

	// Validate form
	fdetailpoedit.validate = function() {
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
			<?php if ($detailpo_edit->idbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_idbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_edit->idbarang->caption(), $detailpo_edit->idbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpo_edit->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_edit->qty->caption(), $detailpo_edit->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpo_edit->qty->errorMessage()) ?>");
			<?php if ($detailpo_edit->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_edit->satuan->caption(), $detailpo_edit->satuan->RequiredErrorMessage)) ?>");
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
	fdetailpoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpoedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpoedit.lists["x_idbarang"] = <?php echo $detailpo_edit->idbarang->Lookup->toClientList($detailpo_edit) ?>;
	fdetailpoedit.lists["x_idbarang"].options = <?php echo JsonEncode($detailpo_edit->idbarang->lookupOptions()) ?>;
	fdetailpoedit.lists["x_satuan"] = <?php echo $detailpo_edit->satuan->Lookup->toClientList($detailpo_edit) ?>;
	fdetailpoedit.lists["x_satuan"].options = <?php echo JsonEncode($detailpo_edit->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailpoedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpo_edit->showPageHeader(); ?>
<?php
$detailpo_edit->showMessage();
?>
<form name="fdetailpoedit" id="fdetailpoedit" class="<?php echo $detailpo_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpo">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailpo_edit->IsModal ?>">
<?php if ($detailpo->getCurrentMasterTable() == "purchaseorder") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="purchaseorder">
<input type="hidden" name="fk_id_po" value="<?php echo HtmlEncode($detailpo_edit->pid_detailpo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailpo_edit->idbarang->Visible) { // idbarang ?>
	<div id="r_idbarang" class="form-group row">
		<label id="elh_detailpo_idbarang" for="x_idbarang" class="<?php echo $detailpo_edit->LeftColumnClass ?>"><?php echo $detailpo_edit->idbarang->caption() ?><?php echo $detailpo_edit->idbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpo_edit->RightColumnClass ?>"><div <?php echo $detailpo_edit->idbarang->cellAttributes() ?>>
<span id="el_detailpo_idbarang">
<?php $detailpo_edit->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_idbarang"><?php echo EmptyValue(strval($detailpo_edit->idbarang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_edit->idbarang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_edit->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_edit->idbarang->ReadOnly || $detailpo_edit->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_edit->idbarang->Lookup->getParamTag($detailpo_edit, "p_x_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_edit->idbarang->displayValueSeparatorAttribute() ?>" name="x_idbarang" id="x_idbarang" value="<?php echo $detailpo_edit->idbarang->CurrentValue ?>"<?php echo $detailpo_edit->idbarang->editAttributes() ?>>
</span>
<?php echo $detailpo_edit->idbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpo_edit->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_detailpo_qty" for="x_qty" class="<?php echo $detailpo_edit->LeftColumnClass ?>"><?php echo $detailpo_edit->qty->caption() ?><?php echo $detailpo_edit->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpo_edit->RightColumnClass ?>"><div <?php echo $detailpo_edit->qty->cellAttributes() ?>>
<span id="el_detailpo_qty">
<input type="text" data-table="detailpo" data-field="x_qty" name="x_qty" id="x_qty" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_edit->qty->getPlaceHolder()) ?>" value="<?php echo $detailpo_edit->qty->EditValue ?>"<?php echo $detailpo_edit->qty->editAttributes() ?>>
</span>
<?php echo $detailpo_edit->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpo_edit->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_detailpo_satuan" for="x_satuan" class="<?php echo $detailpo_edit->LeftColumnClass ?>"><?php echo $detailpo_edit->satuan->caption() ?><?php echo $detailpo_edit->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpo_edit->RightColumnClass ?>"><div <?php echo $detailpo_edit->satuan->cellAttributes() ?>>
<span id="el_detailpo_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpo" data-field="x_satuan" data-value-separator="<?php echo $detailpo_edit->satuan->displayValueSeparatorAttribute() ?>" id="x_satuan" name="x_satuan"<?php echo $detailpo_edit->satuan->editAttributes() ?>>
			<?php echo $detailpo_edit->satuan->selectOptionListHtml("x_satuan") ?>
		</select>
</div>
<?php echo $detailpo_edit->satuan->Lookup->getParamTag($detailpo_edit, "p_x_satuan") ?>
</span>
<?php echo $detailpo_edit->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="detailpo" data-field="x_id_detailpo" name="x_id_detailpo" id="x_id_detailpo" value="<?php echo HtmlEncode($detailpo_edit->id_detailpo->CurrentValue) ?>">
<?php if (!$detailpo_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpo_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpo_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpo_edit->showPageFooter();
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
$detailpo_edit->terminate();
?>