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
$detailpromo_add = new detailpromo_add();

// Run the page
$detailpromo_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpromoadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailpromoadd = currentForm = new ew.Form("fdetailpromoadd", "add");

	// Validate form
	fdetailpromoadd.validate = function() {
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
			<?php if ($detailpromo_add->id_promo->Required) { ?>
				elm = this.getElements("x" + infix + "_id_promo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_add->id_promo->caption(), $detailpromo_add->id_promo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_promo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpromo_add->id_promo->errorMessage()) ?>");
			<?php if ($detailpromo_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_add->id_barang->caption(), $detailpromo_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpromo_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_add->jumlah->caption(), $detailpromo_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpromo_add->jumlah->errorMessage()) ?>");
			<?php if ($detailpromo_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpromo_add->id_satuan->caption(), $detailpromo_add->id_satuan->RequiredErrorMessage)) ?>");
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
	fdetailpromoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpromoadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpromoadd.lists["x_id_barang"] = <?php echo $detailpromo_add->id_barang->Lookup->toClientList($detailpromo_add) ?>;
	fdetailpromoadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailpromo_add->id_barang->lookupOptions()) ?>;
	fdetailpromoadd.lists["x_id_satuan"] = <?php echo $detailpromo_add->id_satuan->Lookup->toClientList($detailpromo_add) ?>;
	fdetailpromoadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailpromo_add->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailpromoadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpromo_add->showPageHeader(); ?>
<?php
$detailpromo_add->showMessage();
?>
<form name="fdetailpromoadd" id="fdetailpromoadd" class="<?php echo $detailpromo_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpromo">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailpromo_add->IsModal ?>">
<?php if ($detailpromo->getCurrentMasterTable() == "promo") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="promo">
<input type="hidden" name="fk_id_promo" value="<?php echo HtmlEncode($detailpromo_add->id_promo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailpromo_add->id_promo->Visible) { // id_promo ?>
	<div id="r_id_promo" class="form-group row">
		<label id="elh_detailpromo_id_promo" for="x_id_promo" class="<?php echo $detailpromo_add->LeftColumnClass ?>"><?php echo $detailpromo_add->id_promo->caption() ?><?php echo $detailpromo_add->id_promo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpromo_add->RightColumnClass ?>"><div <?php echo $detailpromo_add->id_promo->cellAttributes() ?>>
<?php if ($detailpromo_add->id_promo->getSessionValue() != "") { ?>
<span id="el_detailpromo_id_promo">
<span<?php echo $detailpromo_add->id_promo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpromo_add->id_promo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_promo" name="x_id_promo" value="<?php echo HtmlEncode($detailpromo_add->id_promo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailpromo_id_promo">
<input type="text" data-table="detailpromo" data-field="x_id_promo" name="x_id_promo" id="x_id_promo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpromo_add->id_promo->getPlaceHolder()) ?>" value="<?php echo $detailpromo_add->id_promo->EditValue ?>"<?php echo $detailpromo_add->id_promo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailpromo_add->id_promo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailpromo_id_barang" for="x_id_barang" class="<?php echo $detailpromo_add->LeftColumnClass ?>"><?php echo $detailpromo_add->id_barang->caption() ?><?php echo $detailpromo_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpromo_add->RightColumnClass ?>"><div <?php echo $detailpromo_add->id_barang->cellAttributes() ?>>
<span id="el_detailpromo_id_barang">
<?php $detailpromo_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailpromo_add->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_add->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_add->id_barang->ReadOnly || $detailpromo_add->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_add->id_barang->Lookup->getParamTag($detailpromo_add, "p_x_id_barang") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailpromo_add->id_barang->CurrentValue ?>"<?php echo $detailpromo_add->id_barang->editAttributes() ?>>
</span>
<?php echo $detailpromo_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailpromo_jumlah" for="x_jumlah" class="<?php echo $detailpromo_add->LeftColumnClass ?>"><?php echo $detailpromo_add->jumlah->caption() ?><?php echo $detailpromo_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpromo_add->RightColumnClass ?>"><div <?php echo $detailpromo_add->jumlah->cellAttributes() ?>>
<span id="el_detailpromo_jumlah">
<input type="text" data-table="detailpromo" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpromo_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailpromo_add->jumlah->EditValue ?>"<?php echo $detailpromo_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailpromo_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpromo_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailpromo_id_satuan" for="x_id_satuan" class="<?php echo $detailpromo_add->LeftColumnClass ?>"><?php echo $detailpromo_add->id_satuan->caption() ?><?php echo $detailpromo_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpromo_add->RightColumnClass ?>"><div <?php echo $detailpromo_add->id_satuan->cellAttributes() ?>>
<span id="el_detailpromo_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailpromo_add->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpromo_add->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpromo_add->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpromo_add->id_satuan->ReadOnly || $detailpromo_add->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpromo_add->id_satuan->Lookup->getParamTag($detailpromo_add, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailpromo" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpromo_add->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailpromo_add->id_satuan->CurrentValue ?>"<?php echo $detailpromo_add->id_satuan->editAttributes() ?>>
</span>
<?php echo $detailpromo_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailpromo_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpromo_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpromo_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpromo_add->showPageFooter();
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
$detailpromo_add->terminate();
?>