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
$detailrekmedterapis_add = new detailrekmedterapis_add();

// Run the page
$detailrekmedterapis_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmedterapisadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailrekmedterapisadd = currentForm = new ew.Form("fdetailrekmedterapisadd", "add");

	// Validate form
	fdetailrekmedterapisadd.validate = function() {
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
			<?php if ($detailrekmedterapis_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_add->id_barang->caption(), $detailrekmedterapis_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_add->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_add->jumlah->caption(), $detailrekmedterapis_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmedterapis_add->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmedterapis_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmedterapis_add->id_satuan->caption(), $detailrekmedterapis_add->id_satuan->RequiredErrorMessage)) ?>");
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
	fdetailrekmedterapisadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmedterapisadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmedterapisadd.lists["x_id_barang"] = <?php echo $detailrekmedterapis_add->id_barang->Lookup->toClientList($detailrekmedterapis_add) ?>;
	fdetailrekmedterapisadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmedterapis_add->id_barang->lookupOptions()) ?>;
	fdetailrekmedterapisadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmedterapisadd.lists["x_id_satuan"] = <?php echo $detailrekmedterapis_add->id_satuan->Lookup->toClientList($detailrekmedterapis_add) ?>;
	fdetailrekmedterapisadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailrekmedterapis_add->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmedterapisadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmedterapis_add->showPageHeader(); ?>
<?php
$detailrekmedterapis_add->showMessage();
?>
<form name="fdetailrekmedterapisadd" id="fdetailrekmedterapisadd" class="<?php echo $detailrekmedterapis_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedterapis">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmedterapis_add->IsModal ?>">
<?php if ($detailrekmedterapis->getCurrentMasterTable() == "rekmeddokter") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmedterapis_add->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailrekmedterapis_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailrekmedterapis_id_barang" class="<?php echo $detailrekmedterapis_add->LeftColumnClass ?>"><?php echo $detailrekmedterapis_add->id_barang->caption() ?><?php echo $detailrekmedterapis_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_add->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_add->id_barang->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_barang">
<?php
$onchange = $detailrekmedterapis_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmedterapis_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmedterapis_add->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmedterapis_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmedterapis_add->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmedterapis_add->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_add->id_barang->ReadOnly || $detailrekmedterapis_add->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmedterapis_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmedterapisadd"], function() {
	fdetailrekmedterapisadd.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmedterapis_add->id_barang->Lookup->getParamTag($detailrekmedterapis_add, "p_x_id_barang") ?>
</span>
<?php echo $detailrekmedterapis_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailrekmedterapis_jumlah" for="x_jumlah" class="<?php echo $detailrekmedterapis_add->LeftColumnClass ?>"><?php echo $detailrekmedterapis_add->jumlah->caption() ?><?php echo $detailrekmedterapis_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_add->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_add->jumlah->cellAttributes() ?>>
<span id="el_detailrekmedterapis_jumlah">
<input type="text" data-table="detailrekmedterapis" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmedterapis_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmedterapis_add->jumlah->EditValue ?>"<?php echo $detailrekmedterapis_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailrekmedterapis_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmedterapis_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailrekmedterapis_id_satuan" for="x_id_satuan" class="<?php echo $detailrekmedterapis_add->LeftColumnClass ?>"><?php echo $detailrekmedterapis_add->id_satuan->caption() ?><?php echo $detailrekmedterapis_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmedterapis_add->RightColumnClass ?>"><div <?php echo $detailrekmedterapis_add->id_satuan->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_satuan"><?php echo EmptyValue(strval($detailrekmedterapis_add->id_satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmedterapis_add->id_satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmedterapis_add->id_satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmedterapis_add->id_satuan->ReadOnly || $detailrekmedterapis_add->id_satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmedterapis_add->id_satuan->Lookup->getParamTag($detailrekmedterapis_add, "p_x_id_satuan") ?>
<input type="hidden" data-table="detailrekmedterapis" data-field="x_id_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmedterapis_add->id_satuan->displayValueSeparatorAttribute() ?>" name="x_id_satuan" id="x_id_satuan" value="<?php echo $detailrekmedterapis_add->id_satuan->CurrentValue ?>"<?php echo $detailrekmedterapis_add->id_satuan->editAttributes() ?>>
</span>
<?php echo $detailrekmedterapis_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<?php if (strval($detailrekmedterapis_add->id_rekmeddok->getSessionValue()) != "") { ?>
	<input type="hidden" name="x_id_rekmeddok" id="x_id_rekmeddok" value="<?php echo HtmlEncode(strval($detailrekmedterapis_add->id_rekmeddok->getSessionValue())) ?>">
	<?php } ?>
<?php if (!$detailrekmedterapis_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmedterapis_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmedterapis_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmedterapis_add->showPageFooter();
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
$detailrekmedterapis_add->terminate();
?>