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
$detailpo_add = new detailpo_add();

// Run the page
$detailpo_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpoadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailpoadd = currentForm = new ew.Form("fdetailpoadd", "add");

	// Validate form
	fdetailpoadd.validate = function() {
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
			<?php if ($detailpo_add->idbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_idbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_add->idbarang->caption(), $detailpo_add->idbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpo_add->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_add->qty->caption(), $detailpo_add->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpo_add->qty->errorMessage()) ?>");
			<?php if ($detailpo_add->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpo_add->satuan->caption(), $detailpo_add->satuan->RequiredErrorMessage)) ?>");
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
	fdetailpoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpoadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpoadd.lists["x_idbarang"] = <?php echo $detailpo_add->idbarang->Lookup->toClientList($detailpo_add) ?>;
	fdetailpoadd.lists["x_idbarang"].options = <?php echo JsonEncode($detailpo_add->idbarang->lookupOptions()) ?>;
	fdetailpoadd.lists["x_satuan"] = <?php echo $detailpo_add->satuan->Lookup->toClientList($detailpo_add) ?>;
	fdetailpoadd.lists["x_satuan"].options = <?php echo JsonEncode($detailpo_add->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailpoadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpo_add->showPageHeader(); ?>
<?php
$detailpo_add->showMessage();
?>
<form name="fdetailpoadd" id="fdetailpoadd" class="<?php echo $detailpo_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpo">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailpo_add->IsModal ?>">
<?php if ($detailpo->getCurrentMasterTable() == "purchaseorder") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="purchaseorder">
<input type="hidden" name="fk_id_po" value="<?php echo HtmlEncode($detailpo_add->pid_detailpo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailpo_add->idbarang->Visible) { // idbarang ?>
	<div id="r_idbarang" class="form-group row">
		<label id="elh_detailpo_idbarang" for="x_idbarang" class="<?php echo $detailpo_add->LeftColumnClass ?>"><?php echo $detailpo_add->idbarang->caption() ?><?php echo $detailpo_add->idbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpo_add->RightColumnClass ?>"><div <?php echo $detailpo_add->idbarang->cellAttributes() ?>>
<span id="el_detailpo_idbarang">
<?php $detailpo_add->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_idbarang"><?php echo EmptyValue(strval($detailpo_add->idbarang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_add->idbarang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_add->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_add->idbarang->ReadOnly || $detailpo_add->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_add->idbarang->Lookup->getParamTag($detailpo_add, "p_x_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_add->idbarang->displayValueSeparatorAttribute() ?>" name="x_idbarang" id="x_idbarang" value="<?php echo $detailpo_add->idbarang->CurrentValue ?>"<?php echo $detailpo_add->idbarang->editAttributes() ?>>
</span>
<?php echo $detailpo_add->idbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpo_add->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_detailpo_qty" for="x_qty" class="<?php echo $detailpo_add->LeftColumnClass ?>"><?php echo $detailpo_add->qty->caption() ?><?php echo $detailpo_add->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpo_add->RightColumnClass ?>"><div <?php echo $detailpo_add->qty->cellAttributes() ?>>
<span id="el_detailpo_qty">
<input type="text" data-table="detailpo" data-field="x_qty" name="x_qty" id="x_qty" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_add->qty->getPlaceHolder()) ?>" value="<?php echo $detailpo_add->qty->EditValue ?>"<?php echo $detailpo_add->qty->editAttributes() ?>>
</span>
<?php echo $detailpo_add->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpo_add->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_detailpo_satuan" for="x_satuan" class="<?php echo $detailpo_add->LeftColumnClass ?>"><?php echo $detailpo_add->satuan->caption() ?><?php echo $detailpo_add->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpo_add->RightColumnClass ?>"><div <?php echo $detailpo_add->satuan->cellAttributes() ?>>
<span id="el_detailpo_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpo" data-field="x_satuan" data-value-separator="<?php echo $detailpo_add->satuan->displayValueSeparatorAttribute() ?>" id="x_satuan" name="x_satuan"<?php echo $detailpo_add->satuan->editAttributes() ?>>
			<?php echo $detailpo_add->satuan->selectOptionListHtml("x_satuan") ?>
		</select>
</div>
<?php echo $detailpo_add->satuan->Lookup->getParamTag($detailpo_add, "p_x_satuan") ?>
</span>
<?php echo $detailpo_add->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($detailpo_add->pid_detailpo->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_pid_detailpo" id="x_pid_detailpo" value="<?php echo HtmlEncode(strval($detailpo_add->pid_detailpo->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$detailpo_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpo_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpo_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpo_add->showPageFooter();
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
$detailpo_add->terminate();
?>