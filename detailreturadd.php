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
$detailretur_add = new detailretur_add();

// Run the page
$detailretur_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailretur_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailreturadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailreturadd = currentForm = new ew.Form("fdetailreturadd", "add");

	// Validate form
	fdetailreturadd.validate = function() {
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
			<?php if ($detailretur_add->id_retur->Required) { ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_add->id_retur->caption(), $detailretur_add->id_retur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailretur_add->id_retur->errorMessage()) ?>");
			<?php if ($detailretur_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_add->id_barang->caption(), $detailretur_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailretur_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_add->jumlah->caption(), $detailretur_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailretur_add->jumlah->errorMessage()) ?>");
			<?php if ($detailretur_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailretur_add->id_satuan->caption(), $detailretur_add->id_satuan->RequiredErrorMessage)) ?>");
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
	fdetailreturadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailreturadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailreturadd.lists["x_id_barang"] = <?php echo $detailretur_add->id_barang->Lookup->toClientList($detailretur_add) ?>;
	fdetailreturadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailretur_add->id_barang->lookupOptions()) ?>;
	fdetailreturadd.lists["x_id_satuan"] = <?php echo $detailretur_add->id_satuan->Lookup->toClientList($detailretur_add) ?>;
	fdetailreturadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailretur_add->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailreturadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailretur_add->showPageHeader(); ?>
<?php
$detailretur_add->showMessage();
?>
<form name="fdetailreturadd" id="fdetailreturadd" class="<?php echo $detailretur_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailretur">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailretur_add->IsModal ?>">
<?php if ($detailretur->getCurrentMasterTable() == "returbarang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="returbarang">
<input type="hidden" name="fk_id_retur" value="<?php echo HtmlEncode($detailretur_add->id_retur->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailretur_add->id_retur->Visible) { // id_retur ?>
	<div id="r_id_retur" class="form-group row">
		<label id="elh_detailretur_id_retur" for="x_id_retur" class="<?php echo $detailretur_add->LeftColumnClass ?>"><?php echo $detailretur_add->id_retur->caption() ?><?php echo $detailretur_add->id_retur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailretur_add->RightColumnClass ?>"><div <?php echo $detailretur_add->id_retur->cellAttributes() ?>>
<?php if ($detailretur_add->id_retur->getSessionValue() != "") { ?>
<span id="el_detailretur_id_retur">
<span<?php echo $detailretur_add->id_retur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailretur_add->id_retur->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_retur" name="x_id_retur" value="<?php echo HtmlEncode($detailretur_add->id_retur->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailretur_id_retur">
<input type="text" data-table="detailretur" data-field="x_id_retur" name="x_id_retur" id="x_id_retur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_add->id_retur->getPlaceHolder()) ?>" value="<?php echo $detailretur_add->id_retur->EditValue ?>"<?php echo $detailretur_add->id_retur->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailretur_add->id_retur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailretur_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailretur_id_barang" for="x_id_barang" class="<?php echo $detailretur_add->LeftColumnClass ?>"><?php echo $detailretur_add->id_barang->caption() ?><?php echo $detailretur_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailretur_add->RightColumnClass ?>"><div <?php echo $detailretur_add->id_barang->cellAttributes() ?>>
<span id="el_detailretur_id_barang">
<?php $detailretur_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailretur_add->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailretur_add->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailretur_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailretur_add->id_barang->ReadOnly || $detailretur_add->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailretur_add->id_barang->Lookup->getParamTag($detailretur_add, "p_x_id_barang") ?>
<input type="hidden" data-table="detailretur" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailretur_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailretur_add->id_barang->CurrentValue ?>"<?php echo $detailretur_add->id_barang->editAttributes() ?>>
</span>
<?php echo $detailretur_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailretur_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailretur_jumlah" for="x_jumlah" class="<?php echo $detailretur_add->LeftColumnClass ?>"><?php echo $detailretur_add->jumlah->caption() ?><?php echo $detailretur_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailretur_add->RightColumnClass ?>"><div <?php echo $detailretur_add->jumlah->cellAttributes() ?>>
<span id="el_detailretur_jumlah">
<input type="text" data-table="detailretur" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailretur_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailretur_add->jumlah->EditValue ?>"<?php echo $detailretur_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailretur_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailretur_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailretur_id_satuan" for="x_id_satuan" class="<?php echo $detailretur_add->LeftColumnClass ?>"><?php echo $detailretur_add->id_satuan->caption() ?><?php echo $detailretur_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailretur_add->RightColumnClass ?>"><div <?php echo $detailretur_add->id_satuan->cellAttributes() ?>>
<span id="el_detailretur_id_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailretur" data-field="x_id_satuan" data-value-separator="<?php echo $detailretur_add->id_satuan->displayValueSeparatorAttribute() ?>" id="x_id_satuan" name="x_id_satuan"<?php echo $detailretur_add->id_satuan->editAttributes() ?>>
			<?php echo $detailretur_add->id_satuan->selectOptionListHtml("x_id_satuan") ?>
		</select>
</div>
<?php echo $detailretur_add->id_satuan->Lookup->getParamTag($detailretur_add, "p_x_id_satuan") ?>
</span>
<?php echo $detailretur_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailretur_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailretur_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailretur_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailretur_add->showPageFooter();
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
$detailretur_add->terminate();
?>