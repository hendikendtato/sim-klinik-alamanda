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
$detailrekmeddok_add = new detailrekmeddok_add();

// Run the page
$detailrekmeddok_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmeddokadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailrekmeddokadd = currentForm = new ew.Form("fdetailrekmeddokadd", "add");

	// Validate form
	fdetailrekmeddokadd.validate = function() {
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
			<?php if ($detailrekmeddok_add->id_rekmeddok->Required) { ?>
				elm = this.getElements("x" + infix + "_id_rekmeddok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_add->id_rekmeddok->caption(), $detailrekmeddok_add->id_rekmeddok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_rekmeddok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_add->id_rekmeddok->errorMessage()) ?>");
			<?php if ($detailrekmeddok_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_add->id_barang->caption(), $detailrekmeddok_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_add->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmeddok_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_add->jumlah->caption(), $detailrekmeddok_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_add->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmeddok_add->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_add->satuan->caption(), $detailrekmeddok_add->satuan->RequiredErrorMessage)) ?>");
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
	fdetailrekmeddokadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmeddokadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmeddokadd.lists["x_id_barang"] = <?php echo $detailrekmeddok_add->id_barang->Lookup->toClientList($detailrekmeddok_add) ?>;
	fdetailrekmeddokadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmeddok_add->id_barang->lookupOptions()) ?>;
	fdetailrekmeddokadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmeddokadd.lists["x_satuan"] = <?php echo $detailrekmeddok_add->satuan->Lookup->toClientList($detailrekmeddok_add) ?>;
	fdetailrekmeddokadd.lists["x_satuan"].options = <?php echo JsonEncode($detailrekmeddok_add->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmeddokadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmeddok_add->showPageHeader(); ?>
<?php
$detailrekmeddok_add->showMessage();
?>
<form name="fdetailrekmeddokadd" id="fdetailrekmeddokadd" class="<?php echo $detailrekmeddok_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmeddok">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmeddok_add->IsModal ?>">
<?php if ($detailrekmeddok->getCurrentMasterTable() == "rekmeddokter") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmeddok_add->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailrekmeddok_add->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label id="elh_detailrekmeddok_id_rekmeddok" for="x_id_rekmeddok" class="<?php echo $detailrekmeddok_add->LeftColumnClass ?>"><?php echo $detailrekmeddok_add->id_rekmeddok->caption() ?><?php echo $detailrekmeddok_add->id_rekmeddok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_add->RightColumnClass ?>"><div <?php echo $detailrekmeddok_add->id_rekmeddok->cellAttributes() ?>>
<?php if ($detailrekmeddok_add->id_rekmeddok->getSessionValue() != "") { ?>
<span id="el_detailrekmeddok_id_rekmeddok">
<span<?php echo $detailrekmeddok_add->id_rekmeddok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmeddok_add->id_rekmeddok->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_rekmeddok" name="x_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmeddok_add->id_rekmeddok->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailrekmeddok_id_rekmeddok">
<input type="text" data-table="detailrekmeddok" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmeddok_add->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_add->id_rekmeddok->EditValue ?>"<?php echo $detailrekmeddok_add->id_rekmeddok->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailrekmeddok_add->id_rekmeddok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailrekmeddok_id_barang" class="<?php echo $detailrekmeddok_add->LeftColumnClass ?>"><?php echo $detailrekmeddok_add->id_barang->caption() ?><?php echo $detailrekmeddok_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_add->RightColumnClass ?>"><div <?php echo $detailrekmeddok_add->id_barang->cellAttributes() ?>>
<span id="el_detailrekmeddok_id_barang">
<?php
$onchange = $detailrekmeddok_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmeddok_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmeddok_add->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmeddok_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmeddok_add->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmeddok_add->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_add->id_barang->ReadOnly || $detailrekmeddok_add->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmeddokadd"], function() {
	fdetailrekmeddokadd.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmeddok_add->id_barang->Lookup->getParamTag($detailrekmeddok_add, "p_x_id_barang") ?>
</span>
<?php echo $detailrekmeddok_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailrekmeddok_jumlah" for="x_jumlah" class="<?php echo $detailrekmeddok_add->LeftColumnClass ?>"><?php echo $detailrekmeddok_add->jumlah->caption() ?><?php echo $detailrekmeddok_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_add->RightColumnClass ?>"><div <?php echo $detailrekmeddok_add->jumlah->cellAttributes() ?>>
<span id="el_detailrekmeddok_jumlah">
<input type="text" data-table="detailrekmeddok" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmeddok_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_add->jumlah->EditValue ?>"<?php echo $detailrekmeddok_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailrekmeddok_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_add->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_detailrekmeddok_satuan" for="x_satuan" class="<?php echo $detailrekmeddok_add->LeftColumnClass ?>"><?php echo $detailrekmeddok_add->satuan->caption() ?><?php echo $detailrekmeddok_add->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_add->RightColumnClass ?>"><div <?php echo $detailrekmeddok_add->satuan->cellAttributes() ?>>
<span id="el_detailrekmeddok_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_satuan"><?php echo EmptyValue(strval($detailrekmeddok_add->satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmeddok_add->satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_add->satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_add->satuan->ReadOnly || $detailrekmeddok_add->satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmeddok_add->satuan->Lookup->getParamTag($detailrekmeddok_add, "p_x_satuan") ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_add->satuan->displayValueSeparatorAttribute() ?>" name="x_satuan" id="x_satuan" value="<?php echo $detailrekmeddok_add->satuan->CurrentValue ?>"<?php echo $detailrekmeddok_add->satuan->editAttributes() ?>>
</span>
<?php echo $detailrekmeddok_add->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailrekmeddok_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmeddok_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmeddok_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmeddok_add->showPageFooter();
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
$detailrekmeddok_add->terminate();
?>