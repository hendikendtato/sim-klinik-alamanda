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
$detailterimabarang_edit = new detailterimabarang_edit();

// Run the page
$detailterimabarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailterimabarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailterimabarangedit = currentForm = new ew.Form("fdetailterimabarangedit", "edit");

	// Validate form
	fdetailterimabarangedit.validate = function() {
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
			<?php if ($detailterimabarang_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_edit->id_barang->caption(), $detailterimabarang_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_edit->id_barang->errorMessage()) ?>");
			<?php if ($detailterimabarang_edit->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_edit->jumlah->caption(), $detailterimabarang_edit->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_edit->jumlah->errorMessage()) ?>");
			<?php if ($detailterimabarang_edit->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_edit->satuan->caption(), $detailterimabarang_edit->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_edit->satuan->errorMessage()) ?>");

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
	fdetailterimabarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimabarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimabarangedit.lists["x_id_barang"] = <?php echo $detailterimabarang_edit->id_barang->Lookup->toClientList($detailterimabarang_edit) ?>;
	fdetailterimabarangedit.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimabarang_edit->id_barang->lookupOptions()) ?>;
	fdetailterimabarangedit.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailterimabarangedit.lists["x_satuan"] = <?php echo $detailterimabarang_edit->satuan->Lookup->toClientList($detailterimabarang_edit) ?>;
	fdetailterimabarangedit.lists["x_satuan"].options = <?php echo JsonEncode($detailterimabarang_edit->satuan->lookupOptions()) ?>;
	fdetailterimabarangedit.autoSuggests["x_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailterimabarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailterimabarang_edit->showPageHeader(); ?>
<?php
$detailterimabarang_edit->showMessage();
?>
<form name="fdetailterimabarangedit" id="fdetailterimabarangedit" class="<?php echo $detailterimabarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimabarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailterimabarang_edit->IsModal ?>">
<?php if ($detailterimabarang->getCurrentMasterTable() == "terimabarang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="terimabarang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailterimabarang_edit->id_terimabarang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailterimabarang_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailterimabarang_id_barang" class="<?php echo $detailterimabarang_edit->LeftColumnClass ?>"><?php echo $detailterimabarang_edit->id_barang->caption() ?><?php echo $detailterimabarang_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimabarang_edit->RightColumnClass ?>"><div <?php echo $detailterimabarang_edit->id_barang->cellAttributes() ?>>
<span id="el_detailterimabarang_id_barang">
<?php
$onchange = $detailterimabarang_edit->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_edit->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailterimabarang_edit->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_edit->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_edit->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_edit->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailterimabarang_edit->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabarangedit"], function() {
	fdetailterimabarangedit.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_edit->id_barang->Lookup->getParamTag($detailterimabarang_edit, "p_x_id_barang") ?>
</span>
<?php echo $detailterimabarang_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_edit->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailterimabarang_jumlah" for="x_jumlah" class="<?php echo $detailterimabarang_edit->LeftColumnClass ?>"><?php echo $detailterimabarang_edit->jumlah->caption() ?><?php echo $detailterimabarang_edit->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimabarang_edit->RightColumnClass ?>"><div <?php echo $detailterimabarang_edit->jumlah->cellAttributes() ?>>
<span id="el_detailterimabarang_jumlah">
<input type="text" data-table="detailterimabarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_edit->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_edit->jumlah->EditValue ?>"<?php echo $detailterimabarang_edit->jumlah->editAttributes() ?>>
</span>
<?php echo $detailterimabarang_edit->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_edit->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_detailterimabarang_satuan" class="<?php echo $detailterimabarang_edit->LeftColumnClass ?>"><?php echo $detailterimabarang_edit->satuan->caption() ?><?php echo $detailterimabarang_edit->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimabarang_edit->RightColumnClass ?>"><div <?php echo $detailterimabarang_edit->satuan->cellAttributes() ?>>
<span id="el_detailterimabarang_satuan">
<?php
$onchange = $detailterimabarang_edit->satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_edit->satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_satuan">
	<input type="text" class="form-control" name="sv_x_satuan" id="sv_x_satuan" value="<?php echo RemoveHtml($detailterimabarang_edit->satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_edit->satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_edit->satuan->getPlaceHolder()) ?>"<?php echo $detailterimabarang_edit->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" data-value-separator="<?php echo $detailterimabarang_edit->satuan->displayValueSeparatorAttribute() ?>" name="x_satuan" id="x_satuan" value="<?php echo HtmlEncode($detailterimabarang_edit->satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabarangedit"], function() {
	fdetailterimabarangedit.createAutoSuggest({"id":"x_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_edit->satuan->Lookup->getParamTag($detailterimabarang_edit, "p_x_satuan") ?>
</span>
<?php echo $detailterimabarang_edit->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="detailterimabarang" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($detailterimabarang_edit->id->CurrentValue) ?>">
<?php if (!$detailterimabarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailterimabarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailterimabarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailterimabarang_edit->showPageFooter();
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
$detailterimabarang_edit->terminate();
?>