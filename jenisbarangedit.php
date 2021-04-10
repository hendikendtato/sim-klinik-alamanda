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
$jenisbarang_edit = new jenisbarang_edit();

// Run the page
$jenisbarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenisbarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenisbarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fjenisbarangedit = currentForm = new ew.Form("fjenisbarangedit", "edit");

	// Validate form
	fjenisbarangedit.validate = function() {
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
			<?php if ($jenisbarang_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenisbarang_edit->id->caption(), $jenisbarang_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenisbarang_edit->kode->Required) { ?>
				elm = this.getElements("x" + infix + "_kode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenisbarang_edit->kode->caption(), $jenisbarang_edit->kode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenisbarang_edit->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenisbarang_edit->jenis->caption(), $jenisbarang_edit->jenis->RequiredErrorMessage)) ?>");
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
	fjenisbarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjenisbarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjenisbarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenisbarang_edit->showPageHeader(); ?>
<?php
$jenisbarang_edit->showMessage();
?>
<form name="fjenisbarangedit" id="fjenisbarangedit" class="<?php echo $jenisbarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenisbarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$jenisbarang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($jenisbarang_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_jenisbarang_id" class="<?php echo $jenisbarang_edit->LeftColumnClass ?>"><?php echo $jenisbarang_edit->id->caption() ?><?php echo $jenisbarang_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenisbarang_edit->RightColumnClass ?>"><div <?php echo $jenisbarang_edit->id->cellAttributes() ?>>
<span id="el_jenisbarang_id">
<span<?php echo $jenisbarang_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($jenisbarang_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="jenisbarang" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($jenisbarang_edit->id->CurrentValue) ?>">
<?php echo $jenisbarang_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenisbarang_edit->kode->Visible) { // kode ?>
	<div id="r_kode" class="form-group row">
		<label id="elh_jenisbarang_kode" for="x_kode" class="<?php echo $jenisbarang_edit->LeftColumnClass ?>"><?php echo $jenisbarang_edit->kode->caption() ?><?php echo $jenisbarang_edit->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenisbarang_edit->RightColumnClass ?>"><div <?php echo $jenisbarang_edit->kode->cellAttributes() ?>>
<span id="el_jenisbarang_kode">
<input type="text" data-table="jenisbarang" data-field="x_kode" name="x_kode" id="x_kode" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($jenisbarang_edit->kode->getPlaceHolder()) ?>" value="<?php echo $jenisbarang_edit->kode->EditValue ?>"<?php echo $jenisbarang_edit->kode->editAttributes() ?>>
</span>
<?php echo $jenisbarang_edit->kode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenisbarang_edit->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_jenisbarang_jenis" for="x_jenis" class="<?php echo $jenisbarang_edit->LeftColumnClass ?>"><?php echo $jenisbarang_edit->jenis->caption() ?><?php echo $jenisbarang_edit->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenisbarang_edit->RightColumnClass ?>"><div <?php echo $jenisbarang_edit->jenis->cellAttributes() ?>>
<span id="el_jenisbarang_jenis">
<input type="text" data-table="jenisbarang" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($jenisbarang_edit->jenis->getPlaceHolder()) ?>" value="<?php echo $jenisbarang_edit->jenis->EditValue ?>"<?php echo $jenisbarang_edit->jenis->editAttributes() ?>>
</span>
<?php echo $jenisbarang_edit->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jenisbarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jenisbarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenisbarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jenisbarang_edit->showPageFooter();
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
$jenisbarang_edit->terminate();
?>