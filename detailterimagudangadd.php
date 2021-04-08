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
$detailterimagudang_add = new detailterimagudang_add();

// Run the page
$detailterimagudang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimagudang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailterimagudangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailterimagudangadd = currentForm = new ew.Form("fdetailterimagudangadd", "add");

	// Validate form
	fdetailterimagudangadd.validate = function() {
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
			<?php if ($detailterimagudang_add->pid_terimagudang->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_terimagudang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_add->pid_terimagudang->caption(), $detailterimagudang_add->pid_terimagudang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_terimagudang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_add->pid_terimagudang->errorMessage()) ?>");
			<?php if ($detailterimagudang_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_add->id_barang->caption(), $detailterimagudang_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_add->id_barang->errorMessage()) ?>");
			<?php if ($detailterimagudang_add->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_add->qty->caption(), $detailterimagudang_add->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_add->qty->errorMessage()) ?>");
			<?php if ($detailterimagudang_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailterimagudang_add->id_satuan->caption(), $detailterimagudang_add->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailterimagudang_add->id_satuan->errorMessage()) ?>");

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
	fdetailterimagudangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailterimagudangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailterimagudangadd.lists["x_id_barang"] = <?php echo $detailterimagudang_add->id_barang->Lookup->toClientList($detailterimagudang_add) ?>;
	fdetailterimagudangadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailterimagudang_add->id_barang->lookupOptions()) ?>;
	fdetailterimagudangadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailterimagudangadd.lists["x_id_satuan"] = <?php echo $detailterimagudang_add->id_satuan->Lookup->toClientList($detailterimagudang_add) ?>;
	fdetailterimagudangadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailterimagudang_add->id_satuan->lookupOptions()) ?>;
	fdetailterimagudangadd.autoSuggests["x_id_satuan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailterimagudangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailterimagudang_add->showPageHeader(); ?>
<?php
$detailterimagudang_add->showMessage();
?>
<form name="fdetailterimagudangadd" id="fdetailterimagudangadd" class="<?php echo $detailterimagudang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailterimagudang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailterimagudang_add->IsModal ?>">
<?php if ($detailterimagudang->getCurrentMasterTable() == "terimagudang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="terimagudang">
<input type="hidden" name="fk_id_terimagudang" value="<?php echo HtmlEncode($detailterimagudang_add->pid_terimagudang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailterimagudang_add->pid_terimagudang->Visible) { // pid_terimagudang ?>
	<div id="r_pid_terimagudang" class="form-group row">
		<label id="elh_detailterimagudang_pid_terimagudang" for="x_pid_terimagudang" class="<?php echo $detailterimagudang_add->LeftColumnClass ?>"><?php echo $detailterimagudang_add->pid_terimagudang->caption() ?><?php echo $detailterimagudang_add->pid_terimagudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimagudang_add->RightColumnClass ?>"><div <?php echo $detailterimagudang_add->pid_terimagudang->cellAttributes() ?>>
<?php if ($detailterimagudang_add->pid_terimagudang->getSessionValue() != "") { ?>
<span id="el_detailterimagudang_pid_terimagudang">
<span<?php echo $detailterimagudang_add->pid_terimagudang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailterimagudang_add->pid_terimagudang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid_terimagudang" name="x_pid_terimagudang" value="<?php echo HtmlEncode($detailterimagudang_add->pid_terimagudang->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailterimagudang_pid_terimagudang">
<input type="text" data-table="detailterimagudang" data-field="x_pid_terimagudang" name="x_pid_terimagudang" id="x_pid_terimagudang" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimagudang_add->pid_terimagudang->getPlaceHolder()) ?>" value="<?php echo $detailterimagudang_add->pid_terimagudang->EditValue ?>"<?php echo $detailterimagudang_add->pid_terimagudang->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailterimagudang_add->pid_terimagudang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimagudang_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailterimagudang_id_barang" class="<?php echo $detailterimagudang_add->LeftColumnClass ?>"><?php echo $detailterimagudang_add->id_barang->caption() ?><?php echo $detailterimagudang_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimagudang_add->RightColumnClass ?>"><div <?php echo $detailterimagudang_add->id_barang->cellAttributes() ?>>
<span id="el_detailterimagudang_id_barang">
<?php
$onchange = $detailterimagudang_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailterimagudang_add->id_barang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimagudang_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_add->id_barang->getPlaceHolder()) ?>"<?php echo $detailterimagudang_add->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailterimagudang_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailterimagudang_add->id_barang->ReadOnly || $detailterimagudang_add->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailterimagudang_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailterimagudang_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudangadd"], function() {
	fdetailterimagudangadd.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailterimagudang_add->id_barang->Lookup->getParamTag($detailterimagudang_add, "p_x_id_barang") ?>
</span>
<?php echo $detailterimagudang_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimagudang_add->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_detailterimagudang_qty" for="x_qty" class="<?php echo $detailterimagudang_add->LeftColumnClass ?>"><?php echo $detailterimagudang_add->qty->caption() ?><?php echo $detailterimagudang_add->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimagudang_add->RightColumnClass ?>"><div <?php echo $detailterimagudang_add->qty->cellAttributes() ?>>
<span id="el_detailterimagudang_qty">
<input type="text" data-table="detailterimagudang" data-field="x_qty" name="x_qty" id="x_qty" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailterimagudang_add->qty->getPlaceHolder()) ?>" value="<?php echo $detailterimagudang_add->qty->EditValue ?>"<?php echo $detailterimagudang_add->qty->editAttributes() ?>>
</span>
<?php echo $detailterimagudang_add->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailterimagudang_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailterimagudang_id_satuan" class="<?php echo $detailterimagudang_add->LeftColumnClass ?>"><?php echo $detailterimagudang_add->id_satuan->caption() ?><?php echo $detailterimagudang_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailterimagudang_add->RightColumnClass ?>"><div <?php echo $detailterimagudang_add->id_satuan->cellAttributes() ?>>
<span id="el_detailterimagudang_id_satuan">
<?php
$onchange = $detailterimagudang_add->id_satuan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailterimagudang_add->id_satuan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_satuan">
	<input type="text" class="form-control" name="sv_x_id_satuan" id="sv_x_id_satuan" value="<?php echo RemoveHtml($detailterimagudang_add->id_satuan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailterimagudang_add->id_satuan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailterimagudang_add->id_satuan->getPlaceHolder()) ?>"<?php echo $detailterimagudang_add->id_satuan->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailterimagudang" data-field="x_id_satuan" data-value-separator="<?php echo $detailterimagudang_add->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo HtmlEncode($detailterimagudang_add->id_satuan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailterimagudangadd"], function() {
	fdetailterimagudangadd.createAutoSuggest({"id":"x_id_satuan","forceSelect":false});
});
</script>
<?php echo $detailterimagudang_add->id_satuan->Lookup->getParamTag($detailterimagudang_add, "p_x_id_satuan") ?>
</span>
<?php echo $detailterimagudang_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailterimagudang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailterimagudang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailterimagudang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailterimagudang_add->showPageFooter();
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
$detailterimagudang_add->terminate();
?>