<?php
namespace PHPMaker2020\sim_klinik_alamanda;

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
$nonjual_add = new nonjual_add();

// Run the page
$nonjual_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nonjual_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnonjualadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fnonjualadd = currentForm = new ew.Form("fnonjualadd", "add");

	// Validate form
	fnonjualadd.validate = function() {
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
			<?php if ($nonjual_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nonjual_add->id_klinik->caption(), $nonjual_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nonjual_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nonjual_add->tanggal->caption(), $nonjual_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nonjual_add->tanggal->errorMessage()) ?>");
			<?php if ($nonjual_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nonjual_add->keterangan->caption(), $nonjual_add->keterangan->RequiredErrorMessage)) ?>");
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
	fnonjualadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fnonjualadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fnonjualadd.lists["x_id_klinik"] = <?php echo $nonjual_add->id_klinik->Lookup->toClientList($nonjual_add) ?>;
	fnonjualadd.lists["x_id_klinik"].options = <?php echo JsonEncode($nonjual_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fnonjualadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("h4.ew-detail-caption").hide();
});
</script>
<?php $nonjual_add->showPageHeader(); ?>
<?php
$nonjual_add->showMessage();
?>
<form name="fnonjualadd" id="fnonjualadd" class="<?php echo $nonjual_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nonjual">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$nonjual_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($nonjual_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_nonjual_id_klinik" for="x_id_klinik" class="<?php echo $nonjual_add->LeftColumnClass ?>"><?php echo $nonjual_add->id_klinik->caption() ?><?php echo $nonjual_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nonjual_add->RightColumnClass ?>"><div <?php echo $nonjual_add->id_klinik->cellAttributes() ?>>
<span id="el_nonjual_id_klinik">
<?php $nonjual_add->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="nonjual" data-field="x_id_klinik" data-value-separator="<?php echo $nonjual_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $nonjual_add->id_klinik->editAttributes() ?>>
			<?php echo $nonjual_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $nonjual_add->id_klinik->Lookup->getParamTag($nonjual_add, "p_x_id_klinik") ?>
</span>
<?php echo $nonjual_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($nonjual_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_nonjual_tanggal" for="x_tanggal" class="<?php echo $nonjual_add->LeftColumnClass ?>"><?php echo $nonjual_add->tanggal->caption() ?><?php echo $nonjual_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nonjual_add->RightColumnClass ?>"><div <?php echo $nonjual_add->tanggal->cellAttributes() ?>>
<span id="el_nonjual_tanggal">
<input type="text" data-table="nonjual" data-field="x_tanggal" data-format="7" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($nonjual_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $nonjual_add->tanggal->EditValue ?>"<?php echo $nonjual_add->tanggal->editAttributes() ?>>
<?php if (!$nonjual_add->tanggal->ReadOnly && !$nonjual_add->tanggal->Disabled && !isset($nonjual_add->tanggal->EditAttrs["readonly"]) && !isset($nonjual_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnonjualadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fnonjualadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $nonjual_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($nonjual_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_nonjual_keterangan" for="x_keterangan" class="<?php echo $nonjual_add->LeftColumnClass ?>"><?php echo $nonjual_add->keterangan->caption() ?><?php echo $nonjual_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nonjual_add->RightColumnClass ?>"><div <?php echo $nonjual_add->keterangan->cellAttributes() ?>>
<span id="el_nonjual_keterangan">
<textarea data-table="nonjual" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($nonjual_add->keterangan->getPlaceHolder()) ?>"<?php echo $nonjual_add->keterangan->editAttributes() ?>><?php echo $nonjual_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $nonjual_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detail_nonjual", explode(",", $nonjual->getCurrentDetailTable())) && $detail_nonjual->DetailAdd) {
?>
<?php if ($nonjual->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detail_nonjual", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detail_nonjualgrid.php" ?>
<?php } ?>
<?php if (!$nonjual_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $nonjual_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $nonjual_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$nonjual_add->showPageFooter();
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
$nonjual_add->terminate();
?>