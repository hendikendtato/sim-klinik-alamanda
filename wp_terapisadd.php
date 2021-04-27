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
$wp_terapis_add = new wp_terapis_add();

// Run the page
$wp_terapis_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$wp_terapis_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fwp_terapisadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fwp_terapisadd = currentForm = new ew.Form("fwp_terapisadd", "add");

	// Validate form
	fwp_terapisadd.validate = function() {
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
			<?php if ($wp_terapis_add->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_terapis_add->id->caption(), $wp_terapis_add->id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($wp_terapis_add->id->errorMessage()) ?>");
			<?php if ($wp_terapis_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_terapis_add->nama->caption(), $wp_terapis_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_terapis_add->deskripsi->Required) { ?>
				elm = this.getElements("x" + infix + "_deskripsi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_terapis_add->deskripsi->caption(), $wp_terapis_add->deskripsi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_terapis_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_terapis_add->_email->caption(), $wp_terapis_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($wp_terapis_add->no_telp->Required) { ?>
				elm = this.getElements("x" + infix + "_no_telp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $wp_terapis_add->no_telp->caption(), $wp_terapis_add->no_telp->RequiredErrorMessage)) ?>");
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
	fwp_terapisadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fwp_terapisadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fwp_terapisadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $wp_terapis_add->showPageHeader(); ?>
<?php
$wp_terapis_add->showMessage();
?>
<form name="fwp_terapisadd" id="fwp_terapisadd" class="<?php echo $wp_terapis_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="wp_terapis">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$wp_terapis_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($wp_terapis_add->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_wp_terapis_id" for="x_id" class="<?php echo $wp_terapis_add->LeftColumnClass ?>"><?php echo $wp_terapis_add->id->caption() ?><?php echo $wp_terapis_add->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_terapis_add->RightColumnClass ?>"><div <?php echo $wp_terapis_add->id->cellAttributes() ?>>
<span id="el_wp_terapis_id">
<input type="text" data-table="wp_terapis" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($wp_terapis_add->id->getPlaceHolder()) ?>" value="<?php echo $wp_terapis_add->id->EditValue ?>"<?php echo $wp_terapis_add->id->editAttributes() ?>>
</span>
<?php echo $wp_terapis_add->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_terapis_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_wp_terapis_nama" for="x_nama" class="<?php echo $wp_terapis_add->LeftColumnClass ?>"><?php echo $wp_terapis_add->nama->caption() ?><?php echo $wp_terapis_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_terapis_add->RightColumnClass ?>"><div <?php echo $wp_terapis_add->nama->cellAttributes() ?>>
<span id="el_wp_terapis_nama">
<input type="text" data-table="wp_terapis" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($wp_terapis_add->nama->getPlaceHolder()) ?>" value="<?php echo $wp_terapis_add->nama->EditValue ?>"<?php echo $wp_terapis_add->nama->editAttributes() ?>>
</span>
<?php echo $wp_terapis_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_terapis_add->deskripsi->Visible) { // deskripsi ?>
	<div id="r_deskripsi" class="form-group row">
		<label id="elh_wp_terapis_deskripsi" for="x_deskripsi" class="<?php echo $wp_terapis_add->LeftColumnClass ?>"><?php echo $wp_terapis_add->deskripsi->caption() ?><?php echo $wp_terapis_add->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_terapis_add->RightColumnClass ?>"><div <?php echo $wp_terapis_add->deskripsi->cellAttributes() ?>>
<span id="el_wp_terapis_deskripsi">
<textarea data-table="wp_terapis" data-field="x_deskripsi" name="x_deskripsi" id="x_deskripsi" cols="35" rows="4" placeholder="<?php echo HtmlEncode($wp_terapis_add->deskripsi->getPlaceHolder()) ?>"<?php echo $wp_terapis_add->deskripsi->editAttributes() ?>><?php echo $wp_terapis_add->deskripsi->EditValue ?></textarea>
</span>
<?php echo $wp_terapis_add->deskripsi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_terapis_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_wp_terapis__email" for="x__email" class="<?php echo $wp_terapis_add->LeftColumnClass ?>"><?php echo $wp_terapis_add->_email->caption() ?><?php echo $wp_terapis_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_terapis_add->RightColumnClass ?>"><div <?php echo $wp_terapis_add->_email->cellAttributes() ?>>
<span id="el_wp_terapis__email">
<input type="text" data-table="wp_terapis" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($wp_terapis_add->_email->getPlaceHolder()) ?>" value="<?php echo $wp_terapis_add->_email->EditValue ?>"<?php echo $wp_terapis_add->_email->editAttributes() ?>>
</span>
<?php echo $wp_terapis_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($wp_terapis_add->no_telp->Visible) { // no_telp ?>
	<div id="r_no_telp" class="form-group row">
		<label id="elh_wp_terapis_no_telp" for="x_no_telp" class="<?php echo $wp_terapis_add->LeftColumnClass ?>"><?php echo $wp_terapis_add->no_telp->caption() ?><?php echo $wp_terapis_add->no_telp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $wp_terapis_add->RightColumnClass ?>"><div <?php echo $wp_terapis_add->no_telp->cellAttributes() ?>>
<span id="el_wp_terapis_no_telp">
<input type="text" data-table="wp_terapis" data-field="x_no_telp" name="x_no_telp" id="x_no_telp" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($wp_terapis_add->no_telp->getPlaceHolder()) ?>" value="<?php echo $wp_terapis_add->no_telp->EditValue ?>"<?php echo $wp_terapis_add->no_telp->editAttributes() ?>>
</span>
<?php echo $wp_terapis_add->no_telp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$wp_terapis_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $wp_terapis_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $wp_terapis_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$wp_terapis_add->showPageFooter();
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
$wp_terapis_add->terminate();
?>