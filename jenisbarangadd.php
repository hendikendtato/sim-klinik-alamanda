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
$jenisbarang_add = new jenisbarang_add();

// Run the page
$jenisbarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenisbarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fjenisbarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fjenisbarangadd = currentForm = new ew.Form("fjenisbarangadd", "add");

	// Validate form
	fjenisbarangadd.validate = function() {
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
			<?php if ($jenisbarang_add->kode->Required) { ?>
				elm = this.getElements("x" + infix + "_kode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenisbarang_add->kode->caption(), $jenisbarang_add->kode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($jenisbarang_add->jenis->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $jenisbarang_add->jenis->caption(), $jenisbarang_add->jenis->RequiredErrorMessage)) ?>");
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
	fjenisbarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjenisbarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjenisbarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $jenisbarang_add->showPageHeader(); ?>
<?php
$jenisbarang_add->showMessage();
?>
<form name="fjenisbarangadd" id="fjenisbarangadd" class="<?php echo $jenisbarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenisbarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$jenisbarang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($jenisbarang_add->kode->Visible) { // kode ?>
	<div id="r_kode" class="form-group row">
		<label id="elh_jenisbarang_kode" for="x_kode" class="<?php echo $jenisbarang_add->LeftColumnClass ?>"><?php echo $jenisbarang_add->kode->caption() ?><?php echo $jenisbarang_add->kode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenisbarang_add->RightColumnClass ?>"><div <?php echo $jenisbarang_add->kode->cellAttributes() ?>>
<span id="el_jenisbarang_kode">
<input type="text" data-table="jenisbarang" data-field="x_kode" name="x_kode" id="x_kode" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($jenisbarang_add->kode->getPlaceHolder()) ?>" value="<?php echo $jenisbarang_add->kode->EditValue ?>"<?php echo $jenisbarang_add->kode->editAttributes() ?>>
</span>
<?php echo $jenisbarang_add->kode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($jenisbarang_add->jenis->Visible) { // jenis ?>
	<div id="r_jenis" class="form-group row">
		<label id="elh_jenisbarang_jenis" for="x_jenis" class="<?php echo $jenisbarang_add->LeftColumnClass ?>"><?php echo $jenisbarang_add->jenis->caption() ?><?php echo $jenisbarang_add->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $jenisbarang_add->RightColumnClass ?>"><div <?php echo $jenisbarang_add->jenis->cellAttributes() ?>>
<span id="el_jenisbarang_jenis">
<input type="text" data-table="jenisbarang" data-field="x_jenis" name="x_jenis" id="x_jenis" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($jenisbarang_add->jenis->getPlaceHolder()) ?>" value="<?php echo $jenisbarang_add->jenis->EditValue ?>"<?php echo $jenisbarang_add->jenis->editAttributes() ?>>
</span>
<?php echo $jenisbarang_add->jenis->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$jenisbarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $jenisbarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $jenisbarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$jenisbarang_add->showPageFooter();
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
$jenisbarang_add->terminate();
?>