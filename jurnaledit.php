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
$jurnal_edit = new jurnal_edit();

// Run the page
$jurnal_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjurnaledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjurnaledit = currentForm = new ew.Form("fjurnaledit", "edit");

	// Validate form
	fjurnaledit.validate = function() {
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
			<?php if ($jurnal_edit->id_jurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->id_jurnal->caption(), $jurnal_edit->id_jurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jurnal_edit->tgl_jurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_jurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->tgl_jurnal->caption(), $jurnal_edit->tgl_jurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_jurnal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jurnal_edit->tgl_jurnal->errorMessage()) ?>");
			<?php if ($jurnal_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_edit->keterangan->caption(), $jurnal_edit->keterangan->RequiredErrorMessage)) ?>");
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
	fjurnaledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjurnaledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjurnaledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jurnal_edit->showPageHeader(); ?>
<?php
$jurnal_edit->showMessage();
?>
<form name="fjurnaledit" id="fjurnaledit" class="<?php echo $jurnal_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jurnal_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jurnal_edit->id_jurnal->Visible) { // id_jurnal ?>
	<div id="r_id_jurnal" class="form-group row">
		<label id="elh_jurnal_id_jurnal" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->id_jurnal->caption() ?><?php echo $jurnal_edit->id_jurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->id_jurnal->cellAttributes() ?>>
<span id="el_jurnal_id_jurnal">
<span<?php echo $jurnal_edit->id_jurnal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jurnal_edit->id_jurnal->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jurnal" data-field="x_id_jurnal" name="x_id_jurnal" id="x_id_jurnal" value="<?php echo HtmlEncode($jurnal_edit->id_jurnal->CurrentValue) ?>">
<?php echo $jurnal_edit->id_jurnal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->tgl_jurnal->Visible) { // tgl_jurnal ?>
	<div id="r_tgl_jurnal" class="form-group row">
		<label id="elh_jurnal_tgl_jurnal" for="x_tgl_jurnal" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->tgl_jurnal->caption() ?><?php echo $jurnal_edit->tgl_jurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->tgl_jurnal->cellAttributes() ?>>
<span id="el_jurnal_tgl_jurnal">
<input type="text" data-table="jurnal" data-field="x_tgl_jurnal" name="x_tgl_jurnal" id="x_tgl_jurnal" maxlength="10" placeholder="<?php echo HtmlEncode($jurnal_edit->tgl_jurnal->getPlaceHolder()) ?>" value="<?php echo $jurnal_edit->tgl_jurnal->EditValue ?>"<?php echo $jurnal_edit->tgl_jurnal->editAttributes() ?>>
<?php if (!$jurnal_edit->tgl_jurnal->ReadOnly && !$jurnal_edit->tgl_jurnal->Disabled && !isset($jurnal_edit->tgl_jurnal->EditAttrs["readonly"]) && !isset($jurnal_edit->tgl_jurnal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjurnaledit", "datetimepicker"], function() {
	ew.createDateTimePicker("fjurnaledit", "x_tgl_jurnal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jurnal_edit->tgl_jurnal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_jurnal_keterangan" for="x_keterangan" class="<?php echo $jurnal_edit->LeftColumnClass ?>"><?php echo $jurnal_edit->keterangan->caption() ?><?php echo $jurnal_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_edit->RightColumnClass ?>"><div <?php echo $jurnal_edit->keterangan->cellAttributes() ?>>
<span id="el_jurnal_keterangan">
<input type="text" data-table="jurnal" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jurnal_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $jurnal_edit->keterangan->EditValue ?>"<?php echo $jurnal_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $jurnal_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailjurnal", explode(",", $jurnal->getCurrentDetailTable())) && $detailjurnal->DetailEdit) {
?>
<?php if ($jurnal->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailjurnal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailjurnalgrid.php" ?>
<?php } ?>
<?php if (!$jurnal_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jurnal_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jurnal_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jurnal_edit->showPageFooter();
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
$jurnal_edit->terminate();
?>