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
$purchaseorder_add = new purchaseorder_add();

// Run the page
$purchaseorder_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$purchaseorder_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpurchaseorderadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpurchaseorderadd = currentForm = new ew.Form("fpurchaseorderadd", "add");

	// Validate form
	fpurchaseorderadd.validate = function() {
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
			<?php if ($purchaseorder_add->tgl_po->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_po");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $purchaseorder_add->tgl_po->caption(), $purchaseorder_add->tgl_po->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_po");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($purchaseorder_add->tgl_po->errorMessage()) ?>");
			<?php if ($purchaseorder_add->idstaff_po->Required) { ?>
				elm = this.getElements("x" + infix + "_idstaff_po");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $purchaseorder_add->idstaff_po->caption(), $purchaseorder_add->idstaff_po->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($purchaseorder_add->idklinik->Required) { ?>
				elm = this.getElements("x" + infix + "_idklinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $purchaseorder_add->idklinik->caption(), $purchaseorder_add->idklinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($purchaseorder_add->id_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_id_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $purchaseorder_add->id_supplier->caption(), $purchaseorder_add->id_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($purchaseorder_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $purchaseorder_add->keterangan->caption(), $purchaseorder_add->keterangan->RequiredErrorMessage)) ?>");
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
	fpurchaseorderadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpurchaseorderadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpurchaseorderadd.lists["x_idstaff_po"] = <?php echo $purchaseorder_add->idstaff_po->Lookup->toClientList($purchaseorder_add) ?>;
	fpurchaseorderadd.lists["x_idstaff_po"].options = <?php echo JsonEncode($purchaseorder_add->idstaff_po->lookupOptions()) ?>;
	fpurchaseorderadd.lists["x_idklinik"] = <?php echo $purchaseorder_add->idklinik->Lookup->toClientList($purchaseorder_add) ?>;
	fpurchaseorderadd.lists["x_idklinik"].options = <?php echo JsonEncode($purchaseorder_add->idklinik->lookupOptions()) ?>;
	fpurchaseorderadd.lists["x_id_supplier"] = <?php echo $purchaseorder_add->id_supplier->Lookup->toClientList($purchaseorder_add) ?>;
	fpurchaseorderadd.lists["x_id_supplier"].options = <?php echo JsonEncode($purchaseorder_add->id_supplier->lookupOptions()) ?>;
	loadjs.done("fpurchaseorderadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $purchaseorder_add->showPageHeader(); ?>
<?php
$purchaseorder_add->showMessage();
?>
<form name="fpurchaseorderadd" id="fpurchaseorderadd" class="<?php echo $purchaseorder_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="purchaseorder">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$purchaseorder_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($purchaseorder_add->tgl_po->Visible) { // tgl_po ?>
	<div id="r_tgl_po" class="form-group row">
		<label id="elh_purchaseorder_tgl_po" for="x_tgl_po" class="<?php echo $purchaseorder_add->LeftColumnClass ?>"><?php echo $purchaseorder_add->tgl_po->caption() ?><?php echo $purchaseorder_add->tgl_po->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $purchaseorder_add->RightColumnClass ?>"><div <?php echo $purchaseorder_add->tgl_po->cellAttributes() ?>>
<span id="el_purchaseorder_tgl_po">
<input type="text" data-table="purchaseorder" data-field="x_tgl_po" name="x_tgl_po" id="x_tgl_po" maxlength="10" placeholder="<?php echo HtmlEncode($purchaseorder_add->tgl_po->getPlaceHolder()) ?>" value="<?php echo $purchaseorder_add->tgl_po->EditValue ?>"<?php echo $purchaseorder_add->tgl_po->editAttributes() ?>>
<?php if (!$purchaseorder_add->tgl_po->ReadOnly && !$purchaseorder_add->tgl_po->Disabled && !isset($purchaseorder_add->tgl_po->EditAttrs["readonly"]) && !isset($purchaseorder_add->tgl_po->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpurchaseorderadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpurchaseorderadd", "x_tgl_po", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $purchaseorder_add->tgl_po->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($purchaseorder_add->idstaff_po->Visible) { // idstaff_po ?>
	<div id="r_idstaff_po" class="form-group row">
		<label id="elh_purchaseorder_idstaff_po" for="x_idstaff_po" class="<?php echo $purchaseorder_add->LeftColumnClass ?>"><?php echo $purchaseorder_add->idstaff_po->caption() ?><?php echo $purchaseorder_add->idstaff_po->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $purchaseorder_add->RightColumnClass ?>"><div <?php echo $purchaseorder_add->idstaff_po->cellAttributes() ?>>
<span id="el_purchaseorder_idstaff_po">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="purchaseorder" data-field="x_idstaff_po" data-value-separator="<?php echo $purchaseorder_add->idstaff_po->displayValueSeparatorAttribute() ?>" id="x_idstaff_po" name="x_idstaff_po"<?php echo $purchaseorder_add->idstaff_po->editAttributes() ?>>
			<?php echo $purchaseorder_add->idstaff_po->selectOptionListHtml("x_idstaff_po") ?>
		</select>
</div>
<?php echo $purchaseorder_add->idstaff_po->Lookup->getParamTag($purchaseorder_add, "p_x_idstaff_po") ?>
</span>
<?php echo $purchaseorder_add->idstaff_po->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($purchaseorder_add->idklinik->Visible) { // idklinik ?>
	<div id="r_idklinik" class="form-group row">
		<label id="elh_purchaseorder_idklinik" for="x_idklinik" class="<?php echo $purchaseorder_add->LeftColumnClass ?>"><?php echo $purchaseorder_add->idklinik->caption() ?><?php echo $purchaseorder_add->idklinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $purchaseorder_add->RightColumnClass ?>"><div <?php echo $purchaseorder_add->idklinik->cellAttributes() ?>>
<span id="el_purchaseorder_idklinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="purchaseorder" data-field="x_idklinik" data-value-separator="<?php echo $purchaseorder_add->idklinik->displayValueSeparatorAttribute() ?>" id="x_idklinik" name="x_idklinik"<?php echo $purchaseorder_add->idklinik->editAttributes() ?>>
			<?php echo $purchaseorder_add->idklinik->selectOptionListHtml("x_idklinik") ?>
		</select>
</div>
<?php echo $purchaseorder_add->idklinik->Lookup->getParamTag($purchaseorder_add, "p_x_idklinik") ?>
</span>
<?php echo $purchaseorder_add->idklinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($purchaseorder_add->id_supplier->Visible) { // id_supplier ?>
	<div id="r_id_supplier" class="form-group row">
		<label id="elh_purchaseorder_id_supplier" for="x_id_supplier" class="<?php echo $purchaseorder_add->LeftColumnClass ?>"><?php echo $purchaseorder_add->id_supplier->caption() ?><?php echo $purchaseorder_add->id_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $purchaseorder_add->RightColumnClass ?>"><div <?php echo $purchaseorder_add->id_supplier->cellAttributes() ?>>
<span id="el_purchaseorder_id_supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="purchaseorder" data-field="x_id_supplier" data-value-separator="<?php echo $purchaseorder_add->id_supplier->displayValueSeparatorAttribute() ?>" id="x_id_supplier" name="x_id_supplier"<?php echo $purchaseorder_add->id_supplier->editAttributes() ?>>
			<?php echo $purchaseorder_add->id_supplier->selectOptionListHtml("x_id_supplier") ?>
		</select>
</div>
<?php echo $purchaseorder_add->id_supplier->Lookup->getParamTag($purchaseorder_add, "p_x_id_supplier") ?>
</span>
<?php echo $purchaseorder_add->id_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($purchaseorder_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_purchaseorder_keterangan" for="x_keterangan" class="<?php echo $purchaseorder_add->LeftColumnClass ?>"><?php echo $purchaseorder_add->keterangan->caption() ?><?php echo $purchaseorder_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $purchaseorder_add->RightColumnClass ?>"><div <?php echo $purchaseorder_add->keterangan->cellAttributes() ?>>
<span id="el_purchaseorder_keterangan">
<textarea data-table="purchaseorder" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($purchaseorder_add->keterangan->getPlaceHolder()) ?>"<?php echo $purchaseorder_add->keterangan->editAttributes() ?>><?php echo $purchaseorder_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $purchaseorder_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailpo", explode(",", $purchaseorder->getCurrentDetailTable())) && $detailpo->DetailAdd) {
?>
<?php if ($purchaseorder->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpo", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpogrid.php" ?>
<?php } ?>
<?php if (!$purchaseorder_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $purchaseorder_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $purchaseorder_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$purchaseorder_add->showPageFooter();
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
$purchaseorder_add->terminate();
?>