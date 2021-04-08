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
$detailkomposisi_add = new detailkomposisi_add();

// Run the page
$detailkomposisi_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailkomposisiadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailkomposisiadd = currentForm = new ew.Form("fdetailkomposisiadd", "add");

	// Validate form
	fdetailkomposisiadd.validate = function() {
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
			<?php if ($detailkomposisi_add->id_komposisi->Required) { ?>
				elm = this.getElements("x" + infix + "_id_komposisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_add->id_komposisi->caption(), $detailkomposisi_add->id_komposisi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_komposisi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkomposisi_add->id_komposisi->errorMessage()) ?>");
			<?php if ($detailkomposisi_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_add->id_barang->caption(), $detailkomposisi_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailkomposisi_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_add->jumlah->caption(), $detailkomposisi_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkomposisi_add->jumlah->errorMessage()) ?>");
			<?php if ($detailkomposisi_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkomposisi_add->id_satuan->caption(), $detailkomposisi_add->id_satuan->RequiredErrorMessage)) ?>");
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
	fdetailkomposisiadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkomposisiadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkomposisiadd.lists["x_id_barang"] = <?php echo $detailkomposisi_add->id_barang->Lookup->toClientList($detailkomposisi_add) ?>;
	fdetailkomposisiadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailkomposisi_add->id_barang->lookupOptions()) ?>;
	fdetailkomposisiadd.lists["x_id_satuan"] = <?php echo $detailkomposisi_add->id_satuan->Lookup->toClientList($detailkomposisi_add) ?>;
	fdetailkomposisiadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailkomposisi_add->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailkomposisiadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailkomposisi_add->showPageHeader(); ?>
<?php
$detailkomposisi_add->showMessage();
?>
<form name="fdetailkomposisiadd" id="fdetailkomposisiadd" class="<?php echo $detailkomposisi_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkomposisi">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailkomposisi_add->IsModal ?>">
<?php if ($detailkomposisi->getCurrentMasterTable() == "komposisi") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="komposisi">
<input type="hidden" name="fk_id_komposisi" value="<?php echo HtmlEncode($detailkomposisi_add->id_komposisi->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailkomposisi_add->id_komposisi->Visible) { // id_komposisi ?>
	<div id="r_id_komposisi" class="form-group row">
		<label id="elh_detailkomposisi_id_komposisi" for="x_id_komposisi" class="<?php echo $detailkomposisi_add->LeftColumnClass ?>"><?php echo $detailkomposisi_add->id_komposisi->caption() ?><?php echo $detailkomposisi_add->id_komposisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkomposisi_add->RightColumnClass ?>"><div <?php echo $detailkomposisi_add->id_komposisi->cellAttributes() ?>>
<?php if ($detailkomposisi_add->id_komposisi->getSessionValue() != "") { ?>
<span id="el_detailkomposisi_id_komposisi">
<span<?php echo $detailkomposisi_add->id_komposisi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkomposisi_add->id_komposisi->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_komposisi" name="x_id_komposisi" value="<?php echo HtmlEncode($detailkomposisi_add->id_komposisi->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailkomposisi_id_komposisi">
<input type="text" data-table="detailkomposisi" data-field="x_id_komposisi" name="x_id_komposisi" id="x_id_komposisi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkomposisi_add->id_komposisi->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_add->id_komposisi->EditValue ?>"<?php echo $detailkomposisi_add->id_komposisi->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailkomposisi_add->id_komposisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailkomposisi_id_barang" for="x_id_barang" class="<?php echo $detailkomposisi_add->LeftColumnClass ?>"><?php echo $detailkomposisi_add->id_barang->caption() ?><?php echo $detailkomposisi_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkomposisi_add->RightColumnClass ?>"><div <?php echo $detailkomposisi_add->id_barang->cellAttributes() ?>>
<span id="el_detailkomposisi_id_barang">
<?php $detailkomposisi_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailkomposisi_add->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_add->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_add->id_barang->ReadOnly || $detailkomposisi_add->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_add->id_barang->Lookup->getParamTag($detailkomposisi_add, "p_x_id_barang") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailkomposisi_add->id_barang->CurrentValue ?>"<?php echo $detailkomposisi_add->id_barang->editAttributes() ?>>
</span>
<?php echo $detailkomposisi_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailkomposisi_jumlah" for="x_jumlah" class="<?php echo $detailkomposisi_add->LeftColumnClass ?>"><?php echo $detailkomposisi_add->jumlah->caption() ?><?php echo $detailkomposisi_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkomposisi_add->RightColumnClass ?>"><div <?php echo $detailkomposisi_add->jumlah->cellAttributes() ?>>
<span id="el_detailkomposisi_jumlah">
<input type="text" data-table="detailkomposisi" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailkomposisi_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkomposisi_add->jumlah->EditValue ?>"<?php echo $detailkomposisi_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailkomposisi_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailkomposisi_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailkomposisi_id_satuan" for="x_id_satuan" class="<?php echo $detailkomposisi_add->LeftColumnClass ?>"><?php echo $detailkomposisi_add->id_satuan->caption() ?><?php echo $detailkomposisi_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkomposisi_add->RightColumnClass ?>"><div <?php echo $detailkomposisi_add->id_satuan->cellAttributes() ?>>
<span id="el_detailkomposisi_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailkomposisi_add->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailkomposisi_add->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailkomposisi_add->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailkomposisi_add->id_satuan->ReadOnly || $detailkomposisi_add->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailkomposisi_add->id_satuan->Lookup->getParamTag($detailkomposisi_add, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailkomposisi" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailkomposisi_add->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailkomposisi_add->id_satuan->CurrentValue ?>"<?php echo $detailkomposisi_add->id_satuan->editAttributes() ?>>
</span>
<?php echo $detailkomposisi_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailkomposisi_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailkomposisi_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailkomposisi_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailkomposisi_add->showPageFooter();
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
$detailkomposisi_add->terminate();
?>