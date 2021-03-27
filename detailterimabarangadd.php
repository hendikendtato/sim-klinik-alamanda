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
$detailterimabarang_add = new detailterimabarang_add();

// Run the page
$detailterimabarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailterimabarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailterimabarangadd = currentForm = new ew.Form("fdetailterimabarangadd", "add");

	// Validate form
	fdetailterimabarangadd.validate = function() {
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
			<?php if ($detailterimabarang_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_add->id_barang->caption(), $detailterimabarang_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_add->id_barang->errorMessage()) ?>");
			<?php if ($detailterimabarang_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_add->jumlah->caption(), $detailterimabarang_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_add->jumlah->errorMessage()) ?>");
			<?php if ($detailterimabarang_add->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimabarang_add->satuan->caption(), $detailterimabarang_add->satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimabarang_add->satuan->errorMessage()) ?>");

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
	fdetailterimabarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimabarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimabarangadd.lists["x_id_barang"] = <?php echo $detailterimabarang_add->id_barang->Lookup->toClientList($detailterimabarang_add) ?>;
	fdetailterimabarangadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimabarang_add->id_barang->lookupOptions()) ?>;
	fdetailterimabarangadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailterimabarangadd.lists["x_satuan"] = <?php echo $detailterimabarang_add->satuan->Lookup->toClientList($detailterimabarang_add) ?>;
	fdetailterimabarangadd.lists["x_satuan"].options = <?php echo JsonEncode($detailterimabarang_add->satuan->lookupOptions()) ?>;
	fdetailterimabarangadd.autoSuggests["x_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailterimabarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailterimabarang_add->showPageHeader(); ?>
<?php
$detailterimabarang_add->showMessage();
?>
<form name="fdetailterimabarangadd" id="fdetailterimabarangadd" class="<?php echo $detailterimabarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimabarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailterimabarang_add->IsModal ?>">
<?php if ($detailterimabarang->getCurrentMasterTable() == "terimabarang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="terimabarang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailterimabarang_add->id_terimabarang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailterimabarang_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailterimabarang_id_barang" class="<?php echo $detailterimabarang_add->LeftColumnClass ?>"><?php echo $detailterimabarang_add->id_barang->caption() ?><?php echo $detailterimabarang_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimabarang_add->RightColumnClass ?>"><div <?php echo $detailterimabarang_add->id_barang->cellAttributes() ?>>
<span id="el_detailterimabarang_id_barang">
<?php
$onchange = $detailterimabarang_add->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailterimabarang_add->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($detailterimabarang_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_add->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimabarang_add->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_id_barang" data-value-separator="<?php echo $detailterimabarang_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailterimabarang_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabarangadd"], function() {
	fdetailterimabarangadd.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_add->id_barang->Lookup->getParamTag($detailterimabarang_add, "p_x_id_barang") ?>
</span>
<?php echo $detailterimabarang_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailterimabarang_jumlah" for="x_jumlah" class="<?php echo $detailterimabarang_add->LeftColumnClass ?>"><?php echo $detailterimabarang_add->jumlah->caption() ?><?php echo $detailterimabarang_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimabarang_add->RightColumnClass ?>"><div <?php echo $detailterimabarang_add->jumlah->cellAttributes() ?>>
<span id="el_detailterimabarang_jumlah">
<input type="text" data-table="detailterimabarang" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailterimabarang_add->jumlah->EditValue ?>"<?php echo $detailterimabarang_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailterimabarang_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimabarang_add->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_detailterimabarang_satuan" class="<?php echo $detailterimabarang_add->LeftColumnClass ?>"><?php echo $detailterimabarang_add->satuan->caption() ?><?php echo $detailterimabarang_add->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimabarang_add->RightColumnClass ?>"><div <?php echo $detailterimabarang_add->satuan->cellAttributes() ?>>
<span id="el_detailterimabarang_satuan">
<?php
$onchange = $detailterimabarang_add->satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimabarang_add->satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_satuan">
	<input type="text" class="form-control" name="sv_x_satuan" id="sv_x_satuan" value="<?php echo RemoveHtml($detailterimabarang_add->satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimabarang_add->satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimabarang_add->satuan->getPlaceHolder()) ?>"<?php echo $detailterimabarang_add->satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimabarang" data-field="x_satuan" data-value-separator="<?php echo $detailterimabarang_add->satuan->displayValueSeparatorAttribute() ?>" name="x_satuan" id="x_satuan" value="<?php echo HtmlEncode($detailterimabarang_add->satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimabarangadd"], function() {
	fdetailterimabarangadd.createAutoSuggest({"id":"x_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimabarang_add->satuan->Lookup->getParamTag($detailterimabarang_add, "p_x_satuan") ?>
</span>
<?php echo $detailterimabarang_add->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($detailterimabarang_add->id_terimabarang->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_id_terimabarang" id="x_id_terimabarang" value="<?php echo HtmlEncode(strval($detailterimabarang_add->id_terimabarang->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$detailterimabarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailterimabarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailterimabarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailterimabarang_add->showPageFooter();
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
$detailterimabarang_add->terminate();
?>