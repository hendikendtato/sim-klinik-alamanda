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
$detailmutasibank_add = new detailmutasibank_add();

// Run the page
$detailmutasibank_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmutasibank_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailmutasibankadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailmutasibankadd = currentForm = new ew.Form("fdetailmutasibankadd", "add");

	// Validate form
	fdetailmutasibankadd.validate = function() {
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
			<?php if ($detailmutasibank_add->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_add->pid->caption(), $detailmutasibank_add->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmutasibank_add->pid->errorMessage()) ?>");
			<?php if ($detailmutasibank_add->akun_id->Required) { ?>
				elm = this.getElements("x" + infix + "_akun_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_add->akun_id->caption(), $detailmutasibank_add->akun_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_akun_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmutasibank_add->akun_id->errorMessage()) ?>");
			<?php if ($detailmutasibank_add->nama_akun->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_akun");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_add->nama_akun->caption(), $detailmutasibank_add->nama_akun->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmutasibank_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_add->jumlah->caption(), $detailmutasibank_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmutasibank_add->jumlah->errorMessage()) ?>");
			<?php if ($detailmutasibank_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_add->keterangan->caption(), $detailmutasibank_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmutasibank_add->tipe_mutasi->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe_mutasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmutasibank_add->tipe_mutasi->caption(), $detailmutasibank_add->tipe_mutasi->RequiredErrorMessage)) ?>");
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
	fdetailmutasibankadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailmutasibankadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailmutasibankadd.lists["x_akun_id"] = <?php echo $detailmutasibank_add->akun_id->Lookup->toClientList($detailmutasibank_add) ?>;
	fdetailmutasibankadd.lists["x_akun_id"].options = <?php echo JsonEncode($detailmutasibank_add->akun_id->lookupOptions()) ?>;
	fdetailmutasibankadd.autoSuggests["x_akun_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailmutasibankadd.lists["x_nama_akun"] = <?php echo $detailmutasibank_add->nama_akun->Lookup->toClientList($detailmutasibank_add) ?>;
	fdetailmutasibankadd.lists["x_nama_akun"].options = <?php echo JsonEncode($detailmutasibank_add->nama_akun->lookupOptions()) ?>;
	fdetailmutasibankadd.autoSuggests["x_nama_akun"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdetailmutasibankadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailmutasibank_add->showPageHeader(); ?>
<?php
$detailmutasibank_add->showMessage();
?>
<form name="fdetailmutasibankadd" id="fdetailmutasibankadd" class="<?php echo $detailmutasibank_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmutasibank">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailmutasibank_add->IsModal ?>">
<?php if ($detailmutasibank->getCurrentMasterTable() == "mutasi_kas") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="mutasi_kas">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailmutasibank_add->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailmutasibank_add->pid->Visible) { // pid ?>
	<div id="r_pid" class="form-group row">
		<label id="elh_detailmutasibank_pid" for="x_pid" class="<?php echo $detailmutasibank_add->LeftColumnClass ?>"><?php echo $detailmutasibank_add->pid->caption() ?><?php echo $detailmutasibank_add->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmutasibank_add->RightColumnClass ?>"><div <?php echo $detailmutasibank_add->pid->cellAttributes() ?>>
<?php if ($detailmutasibank_add->pid->getSessionValue() != "") { ?>
<span id="el_detailmutasibank_pid">
<span<?php echo $detailmutasibank_add->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmutasibank_add->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid" name="x_pid" value="<?php echo HtmlEncode($detailmutasibank_add->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailmutasibank_pid">
<input type="text" data-table="detailmutasibank" data-field="x_pid" name="x_pid" id="x_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmutasibank_add->pid->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_add->pid->EditValue ?>"<?php echo $detailmutasibank_add->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailmutasibank_add->pid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmutasibank_add->akun_id->Visible) { // akun_id ?>
	<div id="r_akun_id" class="form-group row">
		<label id="elh_detailmutasibank_akun_id" class="<?php echo $detailmutasibank_add->LeftColumnClass ?>"><?php echo $detailmutasibank_add->akun_id->caption() ?><?php echo $detailmutasibank_add->akun_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmutasibank_add->RightColumnClass ?>"><div <?php echo $detailmutasibank_add->akun_id->cellAttributes() ?>>
<span id="el_detailmutasibank_akun_id">
<?php
$onchange = $detailmutasibank_add->akun_id->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_add->akun_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_akun_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_akun_id" id="sv_x_akun_id" value="<?php echo RemoveHtml($detailmutasibank_add->akun_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmutasibank_add->akun_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_add->akun_id->getPlaceHolder()) ?>"<?php echo $detailmutasibank_add->akun_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_add->akun_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_akun_id',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_add->akun_id->ReadOnly || $detailmutasibank_add->akun_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_akun_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_add->akun_id->displayValueSeparatorAttribute() ?>" name="x_akun_id" id="x_akun_id" value="<?php echo HtmlEncode($detailmutasibank_add->akun_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankadd"], function() {
	fdetailmutasibankadd.createAutoSuggest({"id":"x_akun_id","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_add->akun_id->Lookup->getParamTag($detailmutasibank_add, "p_x_akun_id") ?>
</span>
<?php echo $detailmutasibank_add->akun_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmutasibank_add->nama_akun->Visible) { // nama_akun ?>
	<div id="r_nama_akun" class="form-group row">
		<label id="elh_detailmutasibank_nama_akun" class="<?php echo $detailmutasibank_add->LeftColumnClass ?>"><?php echo $detailmutasibank_add->nama_akun->caption() ?><?php echo $detailmutasibank_add->nama_akun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmutasibank_add->RightColumnClass ?>"><div <?php echo $detailmutasibank_add->nama_akun->cellAttributes() ?>>
<span id="el_detailmutasibank_nama_akun">
<?php
$onchange = $detailmutasibank_add->nama_akun->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailmutasibank_add->nama_akun->EditAttrs["onchange"] = "";
?>
<span id="as_x_nama_akun">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_nama_akun" id="sv_x_nama_akun" value="<?php echo RemoveHtml($detailmutasibank_add->nama_akun->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_add->nama_akun->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailmutasibank_add->nama_akun->getPlaceHolder()) ?>"<?php echo $detailmutasibank_add->nama_akun->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailmutasibank_add->nama_akun->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_nama_akun',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($detailmutasibank_add->nama_akun->ReadOnly || $detailmutasibank_add->nama_akun->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="detailmutasibank" data-field="x_nama_akun" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailmutasibank_add->nama_akun->displayValueSeparatorAttribute() ?>" name="x_nama_akun" id="x_nama_akun" value="<?php echo HtmlEncode($detailmutasibank_add->nama_akun->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailmutasibankadd"], function() {
	fdetailmutasibankadd.createAutoSuggest({"id":"x_nama_akun","forceSelect":true});
});
</script>
<?php echo $detailmutasibank_add->nama_akun->Lookup->getParamTag($detailmutasibank_add, "p_x_nama_akun") ?>
</span>
<?php echo $detailmutasibank_add->nama_akun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmutasibank_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_detailmutasibank_jumlah" for="x_jumlah" class="<?php echo $detailmutasibank_add->LeftColumnClass ?>"><?php echo $detailmutasibank_add->jumlah->caption() ?><?php echo $detailmutasibank_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmutasibank_add->RightColumnClass ?>"><div <?php echo $detailmutasibank_add->jumlah->cellAttributes() ?>>
<span id="el_detailmutasibank_jumlah">
<input type="text" data-table="detailmutasibank" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailmutasibank_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_add->jumlah->EditValue ?>"<?php echo $detailmutasibank_add->jumlah->editAttributes() ?>>
</span>
<?php echo $detailmutasibank_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmutasibank_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_detailmutasibank_keterangan" for="x_keterangan" class="<?php echo $detailmutasibank_add->LeftColumnClass ?>"><?php echo $detailmutasibank_add->keterangan->caption() ?><?php echo $detailmutasibank_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmutasibank_add->RightColumnClass ?>"><div <?php echo $detailmutasibank_add->keterangan->cellAttributes() ?>>
<span id="el_detailmutasibank_keterangan">
<input type="text" data-table="detailmutasibank" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_add->keterangan->EditValue ?>"<?php echo $detailmutasibank_add->keterangan->editAttributes() ?>>
</span>
<?php echo $detailmutasibank_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmutasibank_add->tipe_mutasi->Visible) { // tipe_mutasi ?>
	<div id="r_tipe_mutasi" class="form-group row">
		<label id="elh_detailmutasibank_tipe_mutasi" for="x_tipe_mutasi" class="<?php echo $detailmutasibank_add->LeftColumnClass ?>"><?php echo $detailmutasibank_add->tipe_mutasi->caption() ?><?php echo $detailmutasibank_add->tipe_mutasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmutasibank_add->RightColumnClass ?>"><div <?php echo $detailmutasibank_add->tipe_mutasi->cellAttributes() ?>>
<span id="el_detailmutasibank_tipe_mutasi">
<input type="text" data-table="detailmutasibank" data-field="x_tipe_mutasi" name="x_tipe_mutasi" id="x_tipe_mutasi" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($detailmutasibank_add->tipe_mutasi->getPlaceHolder()) ?>" value="<?php echo $detailmutasibank_add->tipe_mutasi->EditValue ?>"<?php echo $detailmutasibank_add->tipe_mutasi->editAttributes() ?>>
</span>
<?php echo $detailmutasibank_add->tipe_mutasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailmutasibank_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailmutasibank_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailmutasibank_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailmutasibank_add->showPageFooter();
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
$detailmutasibank_add->terminate();
?>