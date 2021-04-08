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
$detailrekmedterapis_edit = new detailrekmedterapis_edit();

// Run the page
$detailrekmedterapis_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmedterapisedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailrekmedterapisedit = currentForm = new ew.Form("fdetailrekmedterapisedit", "edit");

	// Validate form
	fdetailrekmedterapisedit.validate = function() {
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
			<?php if ($detailrekmedterapis_edit->id_detailrekmedterapis->Required) { ?>
				elm = this.getElements("x" + infix + "_id_detailrekmedterapis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_edit->id_detailrekmedterapis->caption(), $detailrekmedterapis_edit->id_detailrekmedterapis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailrekmedterapis_edit->id_rekmeddok->Required) { ?>
				elm = this.getElements("x" + infix + "_id_rekmeddok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_edit->id_rekmeddok->caption(), $detailrekmedterapis_edit->id_rekmeddok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_rekmeddok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_edit->id_rekmeddok->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_edit->id_barang->caption(), $detailrekmedterapis_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_edit->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_edit->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_edit->jumlah->caption(), $detailrekmedterapis_edit->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_edit->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_edit->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_edit->id_satuan->caption(), $detailrekmedterapis_edit->id_satuan->RequiredErrorMessage)) ?>");
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
	fdetailrekmedterapisedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedterapisedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedterapisedit.lists["x_id_barang"] = <?php echo $detailrekmedterapis_edit->id_barang->Lookup->toClientList($detailrekmedterapis_edit) ?>;
	fdetailrekmedterapisedit.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedterapis_edit->id_barang->lookupOptions()) ?>;
	fdetailrekmedterapisedit.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedterapisedit.lists["x_id_satuan"] = <?php echo $detailrekmedterapis_edit->id_satuan->Lookup->toClientList($detailrekmedterapis_edit) ?>;
	fdetailrekmedterapisedit.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedterapis_edit->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedterapisedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmedterapis_edit->showPageHeader(); ?>
<?php
$detailrekmedterapis_edit->showMessage();
?>
<form name="fdetailrekmedterapisedit" id="fdetailrekmedterapisedit" class="<?php echo $detailrekmedterapis_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedterapis">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmedterapis_edit->IsModal ?>">
<?php if ($detailrekmedterapis->getCurrentMasterTable() == "rekmeddokter") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmedterapis_edit->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailrekmedterapis_edit->id_detailrekmedterapis->Visible) { // id_detailrekmedterapis ?>
	<div id="r_id_detailrekmedterapis" class="form-group row">
		<label id="elh_detailrekmedterapis_id_detailrekmedterapis" class="<?php echo $detailrekmedterapis_edit->LeftColumnClass ?>"><?php echo $detailrekmedterapis_edit->id_detailrekmedterapis->caption() ?><?php echo $detailrekmedterapis_edit->id_detailrekmedterapis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_edit->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_edit->id_detailrekmedterapis->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_detailrekmedterapis">
<span<?php echo $detailrekmedterapis_edit->id_detailrekmedterapis->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedterapis_edit->id_detailrekmedterapis->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_detailrekmedterapis" name="x_id_detailrekmedterapis" id="x_id_detailrekmedterapis" value="<?php echo HtmlEncode($detailrekmedterapis_edit->id_detailrekmedterapis->CurrentValue) ?>">
<?php echo $detailrekmedterapis_edit->id_detailrekmedterapis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_edit->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label id="elh_detailrekmedterapis_id_rekmeddok" for="x_id_rekmeddok" class="<?php echo $detailrekmedterapis_edit->LeftColumnClass ?>"><?php echo $detailrekmedterapis_edit->id_rekmeddok->caption() ?><?php echo $detailrekmedterapis_edit->id_rekmeddok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_edit->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_edit->id_rekmeddok->cellAttributes() ?>>
<?php if ($detailrekmedterapis_edit->id_rekmeddok->getSessionValue() != "") { ?>
<span id="el_detailrekmedterapis_id_rekmeddok">
<span<?php echo $detailrekmedterapis_edit->id_rekmeddok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmedterapis_edit->id_rekmeddok->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_rekmeddok" name="x_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmedterapis_edit->id_rekmeddok->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailrekmedterapis_id_rekmeddok">
<input type="text" data-table="detailrekmedterapis" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmedterapis_edit->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_edit->id_rekmeddok->EditValue ?>"<?php echo $detailrekmedterapis_edit->id_rekmeddok->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailrekmedterapis_edit->id_rekmeddok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailrekmedterapis_id_barang" class="<?php echo $detailrekmedterapis_edit->LeftColumnClass ?>"><?php echo $detailrekmedterapis_edit->id_barang->caption() ?><?php echo $detailrekmedterapis_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_edit->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_edit->id_barang->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_barang">
<?php
$onchange = $detailrekmedterapis_edit->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_edit->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_edit->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_edit->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_edit->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_edit->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_edit->id_barang->ReadOnly || $detailrekmedterapis_edit->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_edit->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapisedit"], function() {
	fdetailrekmedterapisedit.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_edit->id_barang->Lookup->getParamTag($detailrekmedterapis_edit, "p_x_id_barang") ?>
</span>
<?php echo $detailrekmedterapis_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_edit->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailrekmedterapis_jumlah" for="x_jumlah" class="<?php echo $detailrekmedterapis_edit->LeftColumnClass ?>"><?php echo $detailrekmedterapis_edit->jumlah->caption() ?><?php echo $detailrekmedterapis_edit->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_edit->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_edit->jumlah->cellAttributes() ?>>
<span id="el_detailrekmedterapis_jumlah">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_edit->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_edit->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_edit->jumlah->editAttributes() ?>>
</span>
<?php echo $detailrekmedterapis_edit->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_edit->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailrekmedterapis_id_satuan" for="x_id_satuan" class="<?php echo $detailrekmedterapis_edit->LeftColumnClass ?>"><?php echo $detailrekmedterapis_edit->id_satuan->caption() ?><?php echo $detailrekmedterapis_edit->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_edit->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_edit->id_satuan->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_edit->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_edit->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_edit->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_edit->id_satuan->ReadOnly || $detailrekmedterapis_edit->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_edit->id_satuan->Lookup->getParamTag($detailrekmedterapis_edit, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_edit->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailrekmedterapis_edit->id_satuan->CurrentValue ?>"<?php echo $detailrekmedterapis_edit->id_satuan->editAttributes() ?>>
</span>
<?php echo $detailrekmedterapis_edit->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailrekmedterapis_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmedterapis_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmedterapis_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmedterapis_edit->showPageFooter();
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
$detailrekmedterapis_edit->terminate();
?>