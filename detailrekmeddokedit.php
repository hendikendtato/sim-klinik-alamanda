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
$detailrekmeddok_edit = new detailrekmeddok_edit();

// Run the page
$detailrekmeddok_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailrekmeddokedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailrekmeddokedit = currentForm = new ew.Form("fdetailrekmeddokedit", "edit");

	// Validate form
	fdetailrekmeddokedit.validate = function() {
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
			<?php if ($detailrekmeddok_edit->id_pemobat->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pemobat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_edit->id_pemobat->caption(), $detailrekmeddok_edit->id_pemobat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailrekmeddok_edit->id_rekmeddok->Required) { ?>
				elm = this.getElements("x" + infix + "_id_rekmeddok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_edit->id_rekmeddok->caption(), $detailrekmeddok_edit->id_rekmeddok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_rekmeddok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_edit->id_rekmeddok->errorMessage()) ?>");
			<?php if ($detailrekmeddok_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_edit->id_barang->caption(), $detailrekmeddok_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_edit->id_barang->errorMessage()) ?>");
			<?php if ($detailrekmeddok_edit->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_edit->jumlah->caption(), $detailrekmeddok_edit->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailrekmeddok_edit->jumlah->errorMessage()) ?>");
			<?php if ($detailrekmeddok_edit->satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailrekmeddok_edit->satuan->caption(), $detailrekmeddok_edit->satuan->RequiredErrorMessage)) ?>");
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
	fdetailrekmeddokedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailrekmeddokedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailrekmeddokedit.lists["x_id_barang"] = <?php echo $detailrekmeddok_edit->id_barang->Lookup->toClientList($detailrekmeddok_edit) ?>;
	fdetailrekmeddokedit.lists["x_id_barang"].options = <?php echo JsonEncode($detailrekmeddok_edit->id_barang->lookupOptions()) ?>;
	fdetailrekmeddokedit.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailrekmeddokedit.lists["x_satuan"] = <?php echo $detailrekmeddok_edit->satuan->Lookup->toClientList($detailrekmeddok_edit) ?>;
	fdetailrekmeddokedit.lists["x_satuan"].options = <?php echo JsonEncode($detailrekmeddok_edit->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailrekmeddokedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailrekmeddok_edit->showPageHeader(); ?>
<?php
$detailrekmeddok_edit->showMessage();
?>
<form name="fdetailrekmeddokedit" id="fdetailrekmeddokedit" class="<?php echo $detailrekmeddok_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmeddok">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmeddok_edit->IsModal ?>">
<?php if ($detailrekmeddok->getCurrentMasterTable() == "rekmeddokter") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="rekmeddokter">
<input type="hidden" name="fk_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmeddok_edit->id_rekmeddok->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailrekmeddok_edit->id_pemobat->Visible) { // id_pemobat ?>
	<div id="r_id_pemobat" class="form-group row">
		<label id="elh_detailrekmeddok_id_pemobat" class="<?php echo $detailrekmeddok_edit->LeftColumnClass ?>"><?php echo $detailrekmeddok_edit->id_pemobat->caption() ?><?php echo $detailrekmeddok_edit->id_pemobat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_edit->RightColumnClass ?>"><div <?php echo $detailrekmeddok_edit->id_pemobat->cellAttributes() ?>>
<span id="el_detailrekmeddok_id_pemobat">
<span<?php echo $detailrekmeddok_edit->id_pemobat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmeddok_edit->id_pemobat->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_pemobat" name="x_id_pemobat" id="x_id_pemobat" value="<?php echo HtmlEncode($detailrekmeddok_edit->id_pemobat->CurrentValue) ?>">
<?php echo $detailrekmeddok_edit->id_pemobat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_edit->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<div id="r_id_rekmeddok" class="form-group row">
		<label id="elh_detailrekmeddok_id_rekmeddok" for="x_id_rekmeddok" class="<?php echo $detailrekmeddok_edit->LeftColumnClass ?>"><?php echo $detailrekmeddok_edit->id_rekmeddok->caption() ?><?php echo $detailrekmeddok_edit->id_rekmeddok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_edit->RightColumnClass ?>"><div <?php echo $detailrekmeddok_edit->id_rekmeddok->cellAttributes() ?>>
<?php if ($detailrekmeddok_edit->id_rekmeddok->getSessionValue() != "") { ?>
<span id="el_detailrekmeddok_id_rekmeddok">
<span<?php echo $detailrekmeddok_edit->id_rekmeddok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailrekmeddok_edit->id_rekmeddok->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_rekmeddok" name="x_id_rekmeddok" value="<?php echo HtmlEncode($detailrekmeddok_edit->id_rekmeddok->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailrekmeddok_id_rekmeddok">
<input type="text" data-table="detailrekmeddok" data-field="x_id_rekmeddok" name="x_id_rekmeddok" id="x_id_rekmeddok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailrekmeddok_edit->id_rekmeddok->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_edit->id_rekmeddok->EditValue ?>"<?php echo $detailrekmeddok_edit->id_rekmeddok->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailrekmeddok_edit->id_rekmeddok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailrekmeddok_id_barang" class="<?php echo $detailrekmeddok_edit->LeftColumnClass ?>"><?php echo $detailrekmeddok_edit->id_barang->caption() ?><?php echo $detailrekmeddok_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_edit->RightColumnClass ?>"><div <?php echo $detailrekmeddok_edit->id_barang->cellAttributes() ?>>
<span id="el_detailrekmeddok_id_barang">
<?php
$onchange = $detailrekmeddok_edit->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailrekmeddok_edit->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailrekmeddok_edit->id_barang->EditValue) ?>" size="35" maxlength="50" placeholder="<?php echo HtmlEncode($detailrekmeddok_edit->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailrekmeddok_edit->id_barang->getPlaceHolder()) ?>"<?php echo $detailrekmeddok_edit->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_edit->id_barang->ReadOnly || $detailrekmeddok_edit->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailrekmeddok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailrekmeddok_edit->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailrekmeddokedit"], function() {
	fdetailrekmeddokedit.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailrekmeddok_edit->id_barang->Lookup->getParamTag($detailrekmeddok_edit, "p_x_id_barang") ?>
</span>
<?php echo $detailrekmeddok_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_edit->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailrekmeddok_jumlah" for="x_jumlah" class="<?php echo $detailrekmeddok_edit->LeftColumnClass ?>"><?php echo $detailrekmeddok_edit->jumlah->caption() ?><?php echo $detailrekmeddok_edit->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_edit->RightColumnClass ?>"><div <?php echo $detailrekmeddok_edit->jumlah->cellAttributes() ?>>
<span id="el_detailrekmeddok_jumlah">
<input type="text" data-table="detailrekmeddok" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailrekmeddok_edit->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailrekmeddok_edit->jumlah->EditValue ?>"<?php echo $detailrekmeddok_edit->jumlah->editAttributes() ?>>
</span>
<?php echo $detailrekmeddok_edit->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailrekmeddok_edit->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label id="elh_detailrekmeddok_satuan" for="x_satuan" class="<?php echo $detailrekmeddok_edit->LeftColumnClass ?>"><?php echo $detailrekmeddok_edit->satuan->caption() ?><?php echo $detailrekmeddok_edit->satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailrekmeddok_edit->RightColumnClass ?>"><div <?php echo $detailrekmeddok_edit->satuan->cellAttributes() ?>>
<span id="el_detailrekmeddok_satuan">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_satuan"><?php echo EmptyValue(strval($detailrekmeddok_edit->satuan->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailrekmeddok_edit->satuan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailrekmeddok_edit->satuan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailrekmeddok_edit->satuan->ReadOnly || $detailrekmeddok_edit->satuan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_satuan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailrekmeddok_edit->satuan->Lookup->getParamTag($detailrekmeddok_edit, "p_x_satuan") ?>
<input type="hidden" data-table="detailrekmeddok" data-field="x_satuan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailrekmeddok_edit->satuan->displayValueSeparatorAttribute() ?>" name="x_satuan" id="x_satuan" value="<?php echo $detailrekmeddok_edit->satuan->CurrentValue ?>"<?php echo $detailrekmeddok_edit->satuan->editAttributes() ?>>
</span>
<?php echo $detailrekmeddok_edit->satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailrekmeddok_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailrekmeddok_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailrekmeddok_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailrekmeddok_edit->showPageFooter();
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
$detailrekmeddok_edit->terminate();
?>