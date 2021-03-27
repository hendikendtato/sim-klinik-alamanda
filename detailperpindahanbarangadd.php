<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$detailperpindahanbarang_add = new detailperpindahanbarang_add();

// Run the page
$detailperpindahanbarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailperpindahanbarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailperpindahanbarangadd = currentForm = new ew.Form("fdetailperpindahanbarangadd", "add");

	// Validate form
	fdetailperpindahanbarangadd.validate = function() {
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
			<?php if ($detailperpindahanbarang_add->id_perpindahanbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_perpindahanbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_add->id_perpindahanbarang->caption(), $detailperpindahanbarang_add->id_perpindahanbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_perpindahanbarang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_add->id_perpindahanbarang->errorMessage()) ?>");
			<?php if ($detailperpindahanbarang_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_add->id_barang->caption(), $detailperpindahanbarang_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailperpindahanbarang_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_add->jumlah->caption(), $detailperpindahanbarang_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailperpindahanbarang_add->jumlah->errorMessage()) ?>");
			<?php if ($detailperpindahanbarang_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailperpindahanbarang_add->id_satuan->caption(), $detailperpindahanbarang_add->id_satuan->RequiredErrorMessage)) ?>");
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
	fdetailperpindahanbarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailperpindahanbarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailperpindahanbarangadd.lists["x_id_barang"] = <?php echo $detailperpindahanbarang_add->id_barang->Lookup->toClientList($detailperpindahanbarang_add) ?>;
	fdetailperpindahanbarangadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailperpindahanbarang_add->id_barang->lookupOptions()) ?>;
	fdetailperpindahanbarangadd.lists["x_id_satuan"] = <?php echo $detailperpindahanbarang_add->id_satuan->Lookup->toClientList($detailperpindahanbarang_add) ?>;
	fdetailperpindahanbarangadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailperpindahanbarang_add->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailperpindahanbarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailperpindahanbarang_add->showPageHeader(); ?>
<?php
$detailperpindahanbarang_add->showMessage();
?>
<form name="fdetailperpindahanbarangadd" id="fdetailperpindahanbarangadd" class="<?php echo $detailperpindahanbarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailperpindahanbarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailperpindahanbarang_add->IsModal ?>">
<?php if ($detailperpindahanbarang->getCurrentMasterTable() == "perpindahanbarang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="perpindahanbarang">
<input type="hidden" name="fk_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_add->id_perpindahanbarang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailperpindahanbarang_add->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<div id="r_id_perpindahanbarang" class="form-group row">
		<label id="elh_detailperpindahanbarang_id_perpindahanbarang" for="x_id_perpindahanbarang" class="<?php echo $detailperpindahanbarang_add->LeftColumnClass ?>"><?php echo $detailperpindahanbarang_add->id_perpindahanbarang->caption() ?><?php echo $detailperpindahanbarang_add->id_perpindahanbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailperpindahanbarang_add->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_add->id_perpindahanbarang->cellAttributes() ?>>
<?php if ($detailperpindahanbarang_add->id_perpindahanbarang->getSessionValue() != "") { ?>
<span id="el_detailperpindahanbarang_id_perpindahanbarang">
<span<?php echo $detailperpindahanbarang_add->id_perpindahanbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailperpindahanbarang_add->id_perpindahanbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_perpindahanbarang" name="x_id_perpindahanbarang" value="<?php echo HtmlEncode($detailperpindahanbarang_add->id_perpindahanbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailperpindahanbarang_id_perpindahanbarang">
<input type="text" data-table="detailperpindahanbarang" data-field="x_id_perpindahanbarang" name="x_id_perpindahanbarang" id="x_id_perpindahanbarang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_add->id_perpindahanbarang->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_add->id_perpindahanbarang->EditValue ?>"<?php echo $detailperpindahanbarang_add->id_perpindahanbarang->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailperpindahanbarang_add->id_perpindahanbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailperpindahanbarang_id_barang" for="x_id_barang" class="<?php echo $detailperpindahanbarang_add->LeftColumnClass ?>"><?php echo $detailperpindahanbarang_add->id_barang->caption() ?><?php echo $detailperpindahanbarang_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailperpindahanbarang_add->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_add->id_barang->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_id_barang">
<?php $detailperpindahanbarang_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($detailperpindahanbarang_add->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_add->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_add->id_barang->ReadOnly || $detailperpindahanbarang_add->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_add->id_barang->Lookup->getParamTag($detailperpindahanbarang_add, "p_x_id_barang") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $detailperpindahanbarang_add->id_barang->CurrentValue ?>"<?php echo $detailperpindahanbarang_add->id_barang->editAttributes() ?>>
</span>
<?php echo $detailperpindahanbarang_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailperpindahanbarang_jumlah" for="x_jumlah" class="<?php echo $detailperpindahanbarang_add->LeftColumnClass ?>"><?php echo $detailperpindahanbarang_add->jumlah->caption() ?><?php echo $detailperpindahanbarang_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailperpindahanbarang_add->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_add->jumlah->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_jumlah">
<input type="text" data-table="detailperpindahanbarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailperpindahanbarang_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailperpindahanbarang_add->jumlah->EditValue ?>"<?php echo $detailperpindahanbarang_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailperpindahanbarang_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailperpindahanbarang_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailperpindahanbarang_id_satuan" for="x_id_satuan" class="<?php echo $detailperpindahanbarang_add->LeftColumnClass ?>"><?php echo $detailperpindahanbarang_add->id_satuan->caption() ?><?php echo $detailperpindahanbarang_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailperpindahanbarang_add->RightColumnClass ?>"><div <?php echo $detailperpindahanbarang_add->id_satuan->cellAttributes() ?>>
<span id="el_detailperpindahanbarang_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailperpindahanbarang_add->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailperpindahanbarang_add->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailperpindahanbarang_add->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailperpindahanbarang_add->id_satuan->ReadOnly || $detailperpindahanbarang_add->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailperpindahanbarang_add->id_satuan->Lookup->getParamTag($detailperpindahanbarang_add, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailperpindahanbarang" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailperpindahanbarang_add->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailperpindahanbarang_add->id_satuan->CurrentValue ?>"<?php echo $detailperpindahanbarang_add->id_satuan->editAttributes() ?>>
</span>
<?php echo $detailperpindahanbarang_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailperpindahanbarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailperpindahanbarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailperpindahanbarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailperpindahanbarang_add->showPageFooter();
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
$detailperpindahanbarang_add->terminate();
?>