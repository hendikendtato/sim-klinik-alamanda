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
$m_hargajual_detail_edit = new m_hargajual_detail_edit();

// Run the page
$m_hargajual_detail_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_hargajual_detail_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_hargajual_detailedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_hargajual_detailedit = currentForm = new ew.Form("fm_hargajual_detailedit", "edit");

	// Validate form
	fm_hargajual_detailedit.validate = function() {
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
			<?php if ($m_hargajual_detail_edit->id_hargajualdetail->Required) { ?>
				elm = this.getElements("x" + infix + "_id_hargajualdetail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_detail_edit->id_hargajualdetail->caption(), $m_hargajual_detail_edit->id_hargajualdetail->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_detail_edit->id_hargajual->Required) { ?>
				elm = this.getElements("x" + infix + "_id_hargajual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_detail_edit->id_hargajual->caption(), $m_hargajual_detail_edit->id_hargajual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_hargajual");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_detail_edit->id_hargajual->errorMessage()) ?>");
			<?php if ($m_hargajual_detail_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_detail_edit->id_barang->caption(), $m_hargajual_detail_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_hargajual_detail_edit->hargajual->Required) { ?>
				elm = this.getElements("x" + infix + "_hargajual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_hargajual_detail_edit->hargajual->caption(), $m_hargajual_detail_edit->hargajual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hargajual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_hargajual_detail_edit->hargajual->errorMessage()) ?>");

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
	fm_hargajual_detailedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_hargajual_detailedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_hargajual_detailedit.lists["x_id_barang"] = <?php echo $m_hargajual_detail_edit->id_barang->Lookup->toClientList($m_hargajual_detail_edit) ?>;
	fm_hargajual_detailedit.lists["x_id_barang"].options = <?php echo JsonEncode($m_hargajual_detail_edit->id_barang->lookupOptions()) ?>;
	loadjs.done("fm_hargajual_detailedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_hargajual_detail_edit->showPageHeader(); ?>
<?php
$m_hargajual_detail_edit->showMessage();
?>
<form name="fm_hargajual_detailedit" id="fm_hargajual_detailedit" class="<?php echo $m_hargajual_detail_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_hargajual_detail">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_hargajual_detail_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_hargajual_detail_edit->id_hargajualdetail->Visible) { // id_hargajualdetail ?>
	<div id="r_id_hargajualdetail" class="form-group row">
		<label id="elh_m_hargajual_detail_id_hargajualdetail" class="<?php echo $m_hargajual_detail_edit->LeftColumnClass ?>"><?php echo $m_hargajual_detail_edit->id_hargajualdetail->caption() ?><?php echo $m_hargajual_detail_edit->id_hargajualdetail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_detail_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_detail_edit->id_hargajualdetail->cellAttributes() ?>>
<span id="el_m_hargajual_detail_id_hargajualdetail">
<span<?php echo $m_hargajual_detail_edit->id_hargajualdetail->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_hargajual_detail_edit->id_hargajualdetail->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_hargajual_detail" data-field="x_id_hargajualdetail" name="x_id_hargajualdetail" id="x_id_hargajualdetail" value="<?php echo HtmlEncode($m_hargajual_detail_edit->id_hargajualdetail->CurrentValue) ?>">
<?php echo $m_hargajual_detail_edit->id_hargajualdetail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_detail_edit->id_hargajual->Visible) { // id_hargajual ?>
	<div id="r_id_hargajual" class="form-group row">
		<label id="elh_m_hargajual_detail_id_hargajual" for="x_id_hargajual" class="<?php echo $m_hargajual_detail_edit->LeftColumnClass ?>"><?php echo $m_hargajual_detail_edit->id_hargajual->caption() ?><?php echo $m_hargajual_detail_edit->id_hargajual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_detail_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_detail_edit->id_hargajual->cellAttributes() ?>>
<span id="el_m_hargajual_detail_id_hargajual">
<input type="text" data-table="m_hargajual_detail" data-field="x_id_hargajual" name="x_id_hargajual" id="x_id_hargajual" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_hargajual_detail_edit->id_hargajual->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_detail_edit->id_hargajual->EditValue ?>"<?php echo $m_hargajual_detail_edit->id_hargajual->editAttributes() ?>>
</span>
<?php echo $m_hargajual_detail_edit->id_hargajual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_detail_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_m_hargajual_detail_id_barang" for="x_id_barang" class="<?php echo $m_hargajual_detail_edit->LeftColumnClass ?>"><?php echo $m_hargajual_detail_edit->id_barang->caption() ?><?php echo $m_hargajual_detail_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_detail_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_detail_edit->id_barang->cellAttributes() ?>>
<span id="el_m_hargajual_detail_id_barang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_hargajual_detail" data-field="x_id_barang" data-value-separator="<?php echo $m_hargajual_detail_edit->id_barang->displayValueSeparatorAttribute() ?>" id="x_id_barang" name="x_id_barang" size="40"<?php echo $m_hargajual_detail_edit->id_barang->editAttributes() ?>>
			<?php echo $m_hargajual_detail_edit->id_barang->selectOptionListHtml("x_id_barang") ?>
		</select>
</div>
<?php echo $m_hargajual_detail_edit->id_barang->Lookup->getParamTag($m_hargajual_detail_edit, "p_x_id_barang") ?>
</span>
<?php echo $m_hargajual_detail_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_hargajual_detail_edit->hargajual->Visible) { // hargajual ?>
	<div id="r_hargajual" class="form-group row">
		<label id="elh_m_hargajual_detail_hargajual" for="x_hargajual" class="<?php echo $m_hargajual_detail_edit->LeftColumnClass ?>"><?php echo $m_hargajual_detail_edit->hargajual->caption() ?><?php echo $m_hargajual_detail_edit->hargajual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_hargajual_detail_edit->RightColumnClass ?>"><div <?php echo $m_hargajual_detail_edit->hargajual->cellAttributes() ?>>
<span id="el_m_hargajual_detail_hargajual">
<input type="text" data-table="m_hargajual_detail" data-field="x_hargajual" name="x_hargajual" id="x_hargajual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_hargajual_detail_edit->hargajual->getPlaceHolder()) ?>" value="<?php echo $m_hargajual_detail_edit->hargajual->EditValue ?>"<?php echo $m_hargajual_detail_edit->hargajual->editAttributes() ?>>
</span>
<?php echo $m_hargajual_detail_edit->hargajual->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_hargajual_detail_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_hargajual_detail_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_hargajual_detail_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_hargajual_detail_edit->showPageFooter();
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
$m_hargajual_detail_edit->terminate();
?>