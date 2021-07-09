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
$detail_nonjual_edit = new detail_nonjual_edit();

// Run the page
$detail_nonjual_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detail_nonjual_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetail_nonjualedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetail_nonjualedit = currentForm = new ew.Form("fdetail_nonjualedit", "edit");

	// Validate form
	fdetail_nonjualedit.validate = function() {
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
			<?php if ($detail_nonjual_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_edit->id->caption(), $detail_nonjual_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detail_nonjual_edit->id_nonjual->Required) { ?>
				elm = this.getElements("x" + infix + "_id_nonjual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_edit->id_nonjual->caption(), $detail_nonjual_edit->id_nonjual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_nonjual");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_edit->id_nonjual->errorMessage()) ?>");
			<?php if ($detail_nonjual_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_edit->id_barang->caption(), $detail_nonjual_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_edit->id_barang->errorMessage()) ?>");
			<?php if ($detail_nonjual_edit->stok->Required) { ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_edit->stok->caption(), $detail_nonjual_edit->stok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_edit->stok->errorMessage()) ?>");
			<?php if ($detail_nonjual_edit->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detail_nonjual_edit->qty->caption(), $detail_nonjual_edit->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detail_nonjual_edit->qty->errorMessage()) ?>");

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
	fdetail_nonjualedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetail_nonjualedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdetail_nonjualedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detail_nonjual_edit->showPageHeader(); ?>
<?php
$detail_nonjual_edit->showMessage();
?>
<form name="fdetail_nonjualedit" id="fdetail_nonjualedit" class="<?php echo $detail_nonjual_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detail_nonjual">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detail_nonjual_edit->IsModal ?>">
<?php if ($detail_nonjual->getCurrentMasterTable() == "nonjual") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="nonjual">
<input type="hidden" name="fk_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_edit->id_nonjual->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detail_nonjual_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_detail_nonjual_id" class="<?php echo $detail_nonjual_edit->LeftColumnClass ?>"><?php echo $detail_nonjual_edit->id->caption() ?><?php echo $detail_nonjual_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detail_nonjual_edit->RightColumnClass ?>"><div <?php echo $detail_nonjual_edit->id->cellAttributes() ?>>
<span id="el_detail_nonjual_id">
<span<?php echo $detail_nonjual_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detail_nonjual" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($detail_nonjual_edit->id->CurrentValue) ?>">
<?php echo $detail_nonjual_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detail_nonjual_edit->id_nonjual->Visible) { // id_nonjual ?>
	<div id="r_id_nonjual" class="form-group row">
		<label id="elh_detail_nonjual_id_nonjual" for="x_id_nonjual" class="<?php echo $detail_nonjual_edit->LeftColumnClass ?>"><?php echo $detail_nonjual_edit->id_nonjual->caption() ?><?php echo $detail_nonjual_edit->id_nonjual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detail_nonjual_edit->RightColumnClass ?>"><div <?php echo $detail_nonjual_edit->id_nonjual->cellAttributes() ?>>
<?php if ($detail_nonjual_edit->id_nonjual->getSessionValue() != "") { ?>
<span id="el_detail_nonjual_id_nonjual">
<span<?php echo $detail_nonjual_edit->id_nonjual->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detail_nonjual_edit->id_nonjual->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_nonjual" name="x_id_nonjual" value="<?php echo HtmlEncode($detail_nonjual_edit->id_nonjual->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detail_nonjual_id_nonjual">
<input type="text" data-table="detail_nonjual" data-field="x_id_nonjual" name="x_id_nonjual" id="x_id_nonjual" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_edit->id_nonjual->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_edit->id_nonjual->EditValue ?>"<?php echo $detail_nonjual_edit->id_nonjual->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detail_nonjual_edit->id_nonjual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detail_nonjual_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detail_nonjual_id_barang" for="x_id_barang" class="<?php echo $detail_nonjual_edit->LeftColumnClass ?>"><?php echo $detail_nonjual_edit->id_barang->caption() ?><?php echo $detail_nonjual_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detail_nonjual_edit->RightColumnClass ?>"><div <?php echo $detail_nonjual_edit->id_barang->cellAttributes() ?>>
<span id="el_detail_nonjual_id_barang">
<input type="text" data-table="detail_nonjual" data-field="x_id_barang" name="x_id_barang" id="x_id_barang" size="55" maxlength="255" placeholder="<?php echo HtmlEncode($detail_nonjual_edit->id_barang->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_edit->id_barang->EditValue ?>"<?php echo $detail_nonjual_edit->id_barang->editAttributes() ?>>
</span>
<?php echo $detail_nonjual_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detail_nonjual_edit->stok->Visible) { // stok ?>
	<div id="r_stok" class="form-group row">
		<label id="elh_detail_nonjual_stok" for="x_stok" class="<?php echo $detail_nonjual_edit->LeftColumnClass ?>"><?php echo $detail_nonjual_edit->stok->caption() ?><?php echo $detail_nonjual_edit->stok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detail_nonjual_edit->RightColumnClass ?>"><div <?php echo $detail_nonjual_edit->stok->cellAttributes() ?>>
<span id="el_detail_nonjual_stok">
<input type="text" data-table="detail_nonjual" data-field="x_stok" name="x_stok" id="x_stok" size="6" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_edit->stok->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_edit->stok->EditValue ?>"<?php echo $detail_nonjual_edit->stok->editAttributes() ?>>
</span>
<?php echo $detail_nonjual_edit->stok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detail_nonjual_edit->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_detail_nonjual_qty" for="x_qty" class="<?php echo $detail_nonjual_edit->LeftColumnClass ?>"><?php echo $detail_nonjual_edit->qty->caption() ?><?php echo $detail_nonjual_edit->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detail_nonjual_edit->RightColumnClass ?>"><div <?php echo $detail_nonjual_edit->qty->cellAttributes() ?>>
<span id="el_detail_nonjual_qty">
<input type="text" data-table="detail_nonjual" data-field="x_qty" name="x_qty" id="x_qty" size="6" maxlength="11" placeholder="<?php echo HtmlEncode($detail_nonjual_edit->qty->getPlaceHolder()) ?>" value="<?php echo $detail_nonjual_edit->qty->EditValue ?>"<?php echo $detail_nonjual_edit->qty->editAttributes() ?>>
</span>
<?php echo $detail_nonjual_edit->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detail_nonjual_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detail_nonjual_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detail_nonjual_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detail_nonjual_edit->showPageFooter();
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
$detail_nonjual_edit->terminate();
?>