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
$detailkirimbarang_add = new detailkirimbarang_add();

// Run the page
$detailkirimbarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkirimbarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailkirimbarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailkirimbarangadd = currentForm = new ew.Form("fdetailkirimbarangadd", "add");

	// Validate form
	fdetailkirimbarangadd.validate = function() {
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
			<?php if ($detailkirimbarang_add->id_kirimbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_add->id_kirimbarang->caption(), $detailkirimbarang_add->id_kirimbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_add->id_kirimbarang->errorMessage()) ?>");
			<?php if ($detailkirimbarang_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_add->id_barang->caption(), $detailkirimbarang_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_add->id_barang->errorMessage()) ?>");
			<?php if ($detailkirimbarang_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_add->id_satuan->caption(), $detailkirimbarang_add->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_add->id_satuan->errorMessage()) ?>");
			<?php if ($detailkirimbarang_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailkirimbarang_add->jumlah->caption(), $detailkirimbarang_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailkirimbarang_add->jumlah->errorMessage()) ?>");

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
	fdetailkirimbarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailkirimbarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailkirimbarangadd.lists["x_id_kirimbarang"] = <?php echo $detailkirimbarang_add->id_kirimbarang->Lookup->toClientList($detailkirimbarang_add) ?>;
	fdetailkirimbarangadd.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($detailkirimbarang_add->id_kirimbarang->lookupOptions()) ?>;
	fdetailkirimbarangadd.autoSuggests["x_id_kirimbarang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailkirimbarangadd.lists["x_id_barang"] = <?php echo $detailkirimbarang_add->id_barang->Lookup->toClientList($detailkirimbarang_add) ?>;
	fdetailkirimbarangadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailkirimbarang_add->id_barang->lookupOptions()) ?>;
	fdetailkirimbarangadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailkirimbarangadd.lists["x_id_satuan"] = <?php echo $detailkirimbarang_add->id_satuan->Lookup->toClientList($detailkirimbarang_add) ?>;
	fdetailkirimbarangadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailkirimbarang_add->id_satuan->lookupOptions()) ?>;
	fdetailkirimbarangadd.autoSuggests["x_id_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailkirimbarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailkirimbarang_add->showPageHeader(); ?>
<?php
$detailkirimbarang_add->showMessage();
?>
<form name="fdetailkirimbarangadd" id="fdetailkirimbarangadd" class="<?php echo $detailkirimbarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailkirimbarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailkirimbarang_add->IsModal ?>">
<?php if ($detailkirimbarang->getCurrentMasterTable() == "kirimbarang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="kirimbarang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailkirimbarang_add->id_kirimbarang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailkirimbarang_add->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<div id="r_id_kirimbarang" class="form-group row">
		<label id="elh_detailkirimbarang_id_kirimbarang" class="<?php echo $detailkirimbarang_add->LeftColumnClass ?>"><?php echo $detailkirimbarang_add->id_kirimbarang->caption() ?><?php echo $detailkirimbarang_add->id_kirimbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkirimbarang_add->RightColumnClass ?>"><div <?php echo $detailkirimbarang_add->id_kirimbarang->cellAttributes() ?>>
<?php if ($detailkirimbarang_add->id_kirimbarang->getSessionValue() != "") { ?>
<span id="el_detailkirimbarang_id_kirimbarang">
<span<?php echo $detailkirimbarang_add->id_kirimbarang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailkirimbarang_add->id_kirimbarang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_kirimbarang" name="x_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_add->id_kirimbarang->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailkirimbarang_id_kirimbarang">
<?php
$onchange = $detailkirimbarang_add->id_kirimbarang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_add->id_kirimbarang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_kirimbarang">
	<input type="text" class="form-control" name="sv_x_id_kirimbarang" id="sv_x_id_kirimbarang" value="<?php echo RemoveHtml($detailkirimbarang_add->id_kirimbarang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_add->id_kirimbarang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_add->id_kirimbarang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_add->id_kirimbarang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $detailkirimbarang_add->id_kirimbarang->displayValueSeparatorAttribute() ?>" name="x_id_kirimbarang" id="x_id_kirimbarang" value="<?php echo HtmlEncode($detailkirimbarang_add->id_kirimbarang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbarangadd"], function() {
	fdetailkirimbarangadd.createAutoSuggest({"id":"x_id_kirimbarang","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_add->id_kirimbarang->Lookup->getParamTag($detailkirimbarang_add, "p_x_id_kirimbarang") ?>
</span>
<?php } ?>
<?php echo $detailkirimbarang_add->id_kirimbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailkirimbarang_id_barang" class="<?php echo $detailkirimbarang_add->LeftColumnClass ?>"><?php echo $detailkirimbarang_add->id_barang->caption() ?><?php echo $detailkirimbarang_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkirimbarang_add->RightColumnClass ?>"><div <?php echo $detailkirimbarang_add->id_barang->cellAttributes() ?>>
<span id="el_detailkirimbarang_id_barang">
<?php
$onchange = $detailkirimbarang_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailkirimbarang_add->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailkirimbarang_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_add->id_barang->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_add->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_barang" data-value-separator="<?php echo $detailkirimbarang_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailkirimbarang_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbarangadd"], function() {
	fdetailkirimbarangadd.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailkirimbarang_add->id_barang->Lookup->getParamTag($detailkirimbarang_add, "p_x_id_barang") ?>
</span>
<?php echo $detailkirimbarang_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailkirimbarang_id_satuan" class="<?php echo $detailkirimbarang_add->LeftColumnClass ?>"><?php echo $detailkirimbarang_add->id_satuan->caption() ?><?php echo $detailkirimbarang_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkirimbarang_add->RightColumnClass ?>"><div <?php echo $detailkirimbarang_add->id_satuan->cellAttributes() ?>>
<span id="el_detailkirimbarang_id_satuan">
<?php
$onchange = $detailkirimbarang_add->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailkirimbarang_add->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_satuan">
	<input type="text" class="form-control" name="sv_x_id_satuan" id="sv_x_id_satuan" value="<?php echo RemoveHtml($detailkirimbarang_add->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailkirimbarang_add->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailkirimbarang_add->id_satuan->getPlaceHolder()) ?>"<?php echo $detailkirimbarang_add->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailkirimbarang" data-field="x_id_satuan" data-value-separator="<?php echo $detailkirimbarang_add->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo HtmlEncode($detailkirimbarang_add->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailkirimbarangadd"], function() {
	fdetailkirimbarangadd.createAutoSuggest({"id":"x_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailkirimbarang_add->id_satuan->Lookup->getParamTag($detailkirimbarang_add, "p_x_id_satuan") ?>
</span>
<?php echo $detailkirimbarang_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailkirimbarang_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailkirimbarang_jumlah" for="x_jumlah" class="<?php echo $detailkirimbarang_add->LeftColumnClass ?>"><?php echo $detailkirimbarang_add->jumlah->caption() ?><?php echo $detailkirimbarang_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailkirimbarang_add->RightColumnClass ?>"><div <?php echo $detailkirimbarang_add->jumlah->cellAttributes() ?>>
<span id="el_detailkirimbarang_jumlah">
<input type="text" data-table="detailkirimbarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($detailkirimbarang_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailkirimbarang_add->jumlah->EditValue ?>"<?php echo $detailkirimbarang_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailkirimbarang_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailkirimbarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailkirimbarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailkirimbarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailkirimbarang_add->showPageFooter();
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
$detailkirimbarang_add->terminate();
?>