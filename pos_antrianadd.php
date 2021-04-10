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
$pos_antrian_add = new pos_antrian_add();

// Run the page
$pos_antrian_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pos_antrian_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpos_antrianadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpos_antrianadd = currentForm = new ew.Form("fpos_antrianadd", "add");

	// Validate form
	fpos_antrianadd.validate = function() {
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
			<?php if ($pos_antrian_add->nama_pos->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_pos");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pos_antrian_add->nama_pos->caption(), $pos_antrian_add->nama_pos->RequiredErrorMessage)) ?>");
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
	fpos_antrianadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpos_antrianadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpos_antrianadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pos_antrian_add->showPageHeader(); ?>
<?php
$pos_antrian_add->showMessage();
?>
<form name="fpos_antrianadd" id="fpos_antrianadd" class="<?php echo $pos_antrian_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pos_antrian">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$pos_antrian_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($pos_antrian_add->nama_pos->Visible) { // nama_pos ?>
	<div id="r_nama_pos" class="form-group row">
		<label id="elh_pos_antrian_nama_pos" for="x_nama_pos" class="<?php echo $pos_antrian_add->LeftColumnClass ?>"><?php echo $pos_antrian_add->nama_pos->caption() ?><?php echo $pos_antrian_add->nama_pos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pos_antrian_add->RightColumnClass ?>"><div <?php echo $pos_antrian_add->nama_pos->cellAttributes() ?>>
<span id="el_pos_antrian_nama_pos">
<input type="text" data-table="pos_antrian" data-field="x_nama_pos" name="x_nama_pos" id="x_nama_pos" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($pos_antrian_add->nama_pos->getPlaceHolder()) ?>" value="<?php echo $pos_antrian_add->nama_pos->EditValue ?>"<?php echo $pos_antrian_add->nama_pos->editAttributes() ?>>
</span>
<?php echo $pos_antrian_add->nama_pos->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pos_antrian_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pos_antrian_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pos_antrian_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pos_antrian_add->showPageFooter();
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
$pos_antrian_add->terminate();
?>