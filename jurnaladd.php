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
$jurnal_add = new jurnal_add();

// Run the page
$jurnal_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jurnal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjurnaladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fjurnaladd = currentForm = new ew.Form("fjurnaladd", "add");

	// Validate form
	fjurnaladd.validate = function() {
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
			<?php if ($jurnal_add->tgl_jurnal->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_jurnal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->tgl_jurnal->caption(), $jurnal_add->tgl_jurnal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_jurnal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($jurnal_add->tgl_jurnal->errorMessage()) ?>");
			<?php if ($jurnal_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jurnal_add->keterangan->caption(), $jurnal_add->keterangan->RequiredErrorMessage)) ?>");
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
	fjurnaladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjurnaladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjurnaladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jurnal_add->showPageHeader(); ?>
<?php
$jurnal_add->showMessage();
?>
<form name="fjurnaladd" id="fjurnaladd" class="<?php echo $jurnal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jurnal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$jurnal_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($jurnal_add->tgl_jurnal->Visible) { // tgl_jurnal ?>
	<div id="r_tgl_jurnal" class="form-group row">
		<label id="elh_jurnal_tgl_jurnal" for="x_tgl_jurnal" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->tgl_jurnal->caption() ?><?php echo $jurnal_add->tgl_jurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->tgl_jurnal->cellAttributes() ?>>
<span id="el_jurnal_tgl_jurnal">
<input type="text" data-table="jurnal" data-field="x_tgl_jurnal" name="x_tgl_jurnal" id="x_tgl_jurnal" maxlength="10" placeholder="<?php echo HtmlEncode($jurnal_add->tgl_jurnal->getPlaceHolder()) ?>" value="<?php echo $jurnal_add->tgl_jurnal->EditValue ?>"<?php echo $jurnal_add->tgl_jurnal->editAttributes() ?>>
<?php if (!$jurnal_add->tgl_jurnal->ReadOnly && !$jurnal_add->tgl_jurnal->Disabled && !isset($jurnal_add->tgl_jurnal->EditAttrs["readonly"]) && !isset($jurnal_add->tgl_jurnal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjurnaladd", "datetimepicker"], function() {
	ew.createDateTimePicker("fjurnaladd", "x_tgl_jurnal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $jurnal_add->tgl_jurnal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jurnal_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_jurnal_keterangan" for="x_keterangan" class="<?php echo $jurnal_add->LeftColumnClass ?>"><?php echo $jurnal_add->keterangan->caption() ?><?php echo $jurnal_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jurnal_add->RightColumnClass ?>"><div <?php echo $jurnal_add->keterangan->cellAttributes() ?>>
<span id="el_jurnal_keterangan">
<input type="text" data-table="jurnal" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($jurnal_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $jurnal_add->keterangan->EditValue ?>"<?php echo $jurnal_add->keterangan->editAttributes() ?>>
</span>
<?php echo $jurnal_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailjurnal", explode(",", $jurnal->getCurrentDetailTable())) && $detailjurnal->DetailAdd) {
?>
<?php if ($jurnal->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailjurnal", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailjurnalgrid.php" ?>
<?php } ?>
<?php if (!$jurnal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jurnal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jurnal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jurnal_add->showPageFooter();
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
$jurnal_add->terminate();
?>