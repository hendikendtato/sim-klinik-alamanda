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
$subkategoribarang_edit = new subkategoribarang_edit();

// Run the page
$subkategoribarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$subkategoribarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsubkategoribarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fsubkategoribarangedit = currentForm = new ew.Form("fsubkategoribarangedit", "edit");

	// Validate form
	fsubkategoribarangedit.validate = function() {
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
			<?php if ($subkategoribarang_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subkategoribarang_edit->id->caption(), $subkategoribarang_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($subkategoribarang_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $subkategoribarang_edit->nama->caption(), $subkategoribarang_edit->nama->RequiredErrorMessage)) ?>");
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
	fsubkategoribarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsubkategoribarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsubkategoribarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $subkategoribarang_edit->showPageHeader(); ?>
<?php
$subkategoribarang_edit->showMessage();
?>
<form name="fsubkategoribarangedit" id="fsubkategoribarangedit" class="<?php echo $subkategoribarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="subkategoribarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$subkategoribarang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($subkategoribarang_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_subkategoribarang_id" class="<?php echo $subkategoribarang_edit->LeftColumnClass ?>"><?php echo $subkategoribarang_edit->id->caption() ?><?php echo $subkategoribarang_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subkategoribarang_edit->RightColumnClass ?>"><div <?php echo $subkategoribarang_edit->id->cellAttributes() ?>>
<span id="el_subkategoribarang_id">
<span<?php echo $subkategoribarang_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($subkategoribarang_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="subkategoribarang" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($subkategoribarang_edit->id->CurrentValue) ?>">
<?php echo $subkategoribarang_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($subkategoribarang_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_subkategoribarang_nama" for="x_nama" class="<?php echo $subkategoribarang_edit->LeftColumnClass ?>"><?php echo $subkategoribarang_edit->nama->caption() ?><?php echo $subkategoribarang_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $subkategoribarang_edit->RightColumnClass ?>"><div <?php echo $subkategoribarang_edit->nama->cellAttributes() ?>>
<span id="el_subkategoribarang_nama">
<input type="text" data-table="subkategoribarang" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($subkategoribarang_edit->nama->getPlaceHolder()) ?>" value="<?php echo $subkategoribarang_edit->nama->EditValue ?>"<?php echo $subkategoribarang_edit->nama->editAttributes() ?>>
</span>
<?php echo $subkategoribarang_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$subkategoribarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $subkategoribarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $subkategoribarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$subkategoribarang_edit->showPageFooter();
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
$subkategoribarang_edit->terminate();
?>