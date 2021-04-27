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
$kategoribarang_edit = new kategoribarang_edit();

// Run the page
$kategoribarang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kategoribarang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkategoribarangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkategoribarangedit = currentForm = new ew.Form("fkategoribarangedit", "edit");

	// Validate form
	fkategoribarangedit.validate = function() {
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
			<?php if ($kategoribarang_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kategoribarang_edit->id->caption(), $kategoribarang_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kategoribarang_edit->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kategoribarang_edit->nama->caption(), $kategoribarang_edit->nama->RequiredErrorMessage)) ?>");
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
	fkategoribarangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkategoribarangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fkategoribarangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kategoribarang_edit->showPageHeader(); ?>
<?php
$kategoribarang_edit->showMessage();
?>
<form name="fkategoribarangedit" id="fkategoribarangedit" class="<?php echo $kategoribarang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kategoribarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kategoribarang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($kategoribarang_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_kategoribarang_id" class="<?php echo $kategoribarang_edit->LeftColumnClass ?>"><?php echo $kategoribarang_edit->id->caption() ?><?php echo $kategoribarang_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kategoribarang_edit->RightColumnClass ?>"><div <?php echo $kategoribarang_edit->id->cellAttributes() ?>>
<span id="el_kategoribarang_id">
<span<?php echo $kategoribarang_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kategoribarang_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="kategoribarang" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($kategoribarang_edit->id->CurrentValue) ?>">
<?php echo $kategoribarang_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kategoribarang_edit->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_kategoribarang_nama" for="x_nama" class="<?php echo $kategoribarang_edit->LeftColumnClass ?>"><?php echo $kategoribarang_edit->nama->caption() ?><?php echo $kategoribarang_edit->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kategoribarang_edit->RightColumnClass ?>"><div <?php echo $kategoribarang_edit->nama->cellAttributes() ?>>
<span id="el_kategoribarang_nama">
<input type="text" data-table="kategoribarang" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($kategoribarang_edit->nama->getPlaceHolder()) ?>" value="<?php echo $kategoribarang_edit->nama->EditValue ?>"<?php echo $kategoribarang_edit->nama->editAttributes() ?>>
</span>
<?php echo $kategoribarang_edit->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$kategoribarang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kategoribarang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kategoribarang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kategoribarang_edit->showPageFooter();
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
$kategoribarang_edit->terminate();
?>