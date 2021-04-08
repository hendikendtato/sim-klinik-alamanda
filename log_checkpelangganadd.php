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
$log_checkpelanggan_add = new log_checkpelanggan_add();

// Run the page
$log_checkpelanggan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$log_checkpelanggan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flog_checkpelangganadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flog_checkpelangganadd = currentForm = new ew.Form("flog_checkpelangganadd", "add");

	// Validate form
	flog_checkpelangganadd.validate = function() {
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
			<?php if ($log_checkpelanggan_add->tglwaktu_update->Required) { ?>
				elm = this.getElements("x" + infix + "_tglwaktu_update");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log_checkpelanggan_add->tglwaktu_update->caption(), $log_checkpelanggan_add->tglwaktu_update->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tglwaktu_update");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($log_checkpelanggan_add->tglwaktu_update->errorMessage()) ?>");
			<?php if ($log_checkpelanggan_add->tgl_update->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_update");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log_checkpelanggan_add->tgl_update->caption(), $log_checkpelanggan_add->tgl_update->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_update");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($log_checkpelanggan_add->tgl_update->errorMessage()) ?>");
			<?php if ($log_checkpelanggan_add->id_user->Required) { ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $log_checkpelanggan_add->id_user->caption(), $log_checkpelanggan_add->id_user->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_user");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($log_checkpelanggan_add->id_user->errorMessage()) ?>");

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
	flog_checkpelangganadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flog_checkpelangganadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flog_checkpelangganadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $log_checkpelanggan_add->showPageHeader(); ?>
<?php
$log_checkpelanggan_add->showMessage();
?>
<form name="flog_checkpelangganadd" id="flog_checkpelangganadd" class="<?php echo $log_checkpelanggan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="log_checkpelanggan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$log_checkpelanggan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($log_checkpelanggan_add->tglwaktu_update->Visible) { // tglwaktu_update ?>
	<div id="r_tglwaktu_update" class="form-group row">
		<label id="elh_log_checkpelanggan_tglwaktu_update" for="x_tglwaktu_update" class="<?php echo $log_checkpelanggan_add->LeftColumnClass ?>"><?php echo $log_checkpelanggan_add->tglwaktu_update->caption() ?><?php echo $log_checkpelanggan_add->tglwaktu_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_checkpelanggan_add->RightColumnClass ?>"><div <?php echo $log_checkpelanggan_add->tglwaktu_update->cellAttributes() ?>>
<span id="el_log_checkpelanggan_tglwaktu_update">
<input type="text" data-table="log_checkpelanggan" data-field="x_tglwaktu_update" name="x_tglwaktu_update" id="x_tglwaktu_update" maxlength="19" placeholder="<?php echo HtmlEncode($log_checkpelanggan_add->tglwaktu_update->getPlaceHolder()) ?>" value="<?php echo $log_checkpelanggan_add->tglwaktu_update->EditValue ?>"<?php echo $log_checkpelanggan_add->tglwaktu_update->editAttributes() ?>>
<?php if (!$log_checkpelanggan_add->tglwaktu_update->ReadOnly && !$log_checkpelanggan_add->tglwaktu_update->Disabled && !isset($log_checkpelanggan_add->tglwaktu_update->EditAttrs["readonly"]) && !isset($log_checkpelanggan_add->tglwaktu_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flog_checkpelangganadd", "datetimepicker"], function() {
	ew.createDateTimePicker("flog_checkpelangganadd", "x_tglwaktu_update", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $log_checkpelanggan_add->tglwaktu_update->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log_checkpelanggan_add->tgl_update->Visible) { // tgl_update ?>
	<div id="r_tgl_update" class="form-group row">
		<label id="elh_log_checkpelanggan_tgl_update" for="x_tgl_update" class="<?php echo $log_checkpelanggan_add->LeftColumnClass ?>"><?php echo $log_checkpelanggan_add->tgl_update->caption() ?><?php echo $log_checkpelanggan_add->tgl_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_checkpelanggan_add->RightColumnClass ?>"><div <?php echo $log_checkpelanggan_add->tgl_update->cellAttributes() ?>>
<span id="el_log_checkpelanggan_tgl_update">
<input type="text" data-table="log_checkpelanggan" data-field="x_tgl_update" name="x_tgl_update" id="x_tgl_update" maxlength="10" placeholder="<?php echo HtmlEncode($log_checkpelanggan_add->tgl_update->getPlaceHolder()) ?>" value="<?php echo $log_checkpelanggan_add->tgl_update->EditValue ?>"<?php echo $log_checkpelanggan_add->tgl_update->editAttributes() ?>>
<?php if (!$log_checkpelanggan_add->tgl_update->ReadOnly && !$log_checkpelanggan_add->tgl_update->Disabled && !isset($log_checkpelanggan_add->tgl_update->EditAttrs["readonly"]) && !isset($log_checkpelanggan_add->tgl_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flog_checkpelangganadd", "datetimepicker"], function() {
	ew.createDateTimePicker("flog_checkpelangganadd", "x_tgl_update", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $log_checkpelanggan_add->tgl_update->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($log_checkpelanggan_add->id_user->Visible) { // id_user ?>
	<div id="r_id_user" class="form-group row">
		<label id="elh_log_checkpelanggan_id_user" for="x_id_user" class="<?php echo $log_checkpelanggan_add->LeftColumnClass ?>"><?php echo $log_checkpelanggan_add->id_user->caption() ?><?php echo $log_checkpelanggan_add->id_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $log_checkpelanggan_add->RightColumnClass ?>"><div <?php echo $log_checkpelanggan_add->id_user->cellAttributes() ?>>
<span id="el_log_checkpelanggan_id_user">
<input type="text" data-table="log_checkpelanggan" data-field="x_id_user" name="x_id_user" id="x_id_user" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($log_checkpelanggan_add->id_user->getPlaceHolder()) ?>" value="<?php echo $log_checkpelanggan_add->id_user->EditValue ?>"<?php echo $log_checkpelanggan_add->id_user->editAttributes() ?>>
</span>
<?php echo $log_checkpelanggan_add->id_user->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$log_checkpelanggan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $log_checkpelanggan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $log_checkpelanggan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$log_checkpelanggan_add->showPageFooter();
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
$log_checkpelanggan_add->terminate();
?>