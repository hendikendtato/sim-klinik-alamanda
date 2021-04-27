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
$m_agama_edit = new m_agama_edit();

// Run the page
$m_agama_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_agama_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_agamaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_agamaedit = currentForm = new ew.Form("fm_agamaedit", "edit");

	// Validate form
	fm_agamaedit.validate = function() {
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
			<?php if ($m_agama_edit->id_agama->Required) { ?>
				elm = this.getElements("x" + infix + "_id_agama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_agama_edit->id_agama->caption(), $m_agama_edit->id_agama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_agama_edit->nama_agama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_agama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_agama_edit->nama_agama->caption(), $m_agama_edit->nama_agama->RequiredErrorMessage)) ?>");
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
	fm_agamaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_agamaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_agamaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_agama_edit->showPageHeader(); ?>
<?php
$m_agama_edit->showMessage();
?>
<form name="fm_agamaedit" id="fm_agamaedit" class="<?php echo $m_agama_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_agama">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_agama_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_agama_edit->id_agama->Visible) { // id_agama ?>
	<div id="r_id_agama" class="form-group row">
		<label id="elh_m_agama_id_agama" class="<?php echo $m_agama_edit->LeftColumnClass ?>"><?php echo $m_agama_edit->id_agama->caption() ?><?php echo $m_agama_edit->id_agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_agama_edit->RightColumnClass ?>"><div <?php echo $m_agama_edit->id_agama->cellAttributes() ?>>
<span id="el_m_agama_id_agama">
<span<?php echo $m_agama_edit->id_agama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_agama_edit->id_agama->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_agama" data-field="x_id_agama" name="x_id_agama" id="x_id_agama" value="<?php echo HtmlEncode($m_agama_edit->id_agama->CurrentValue) ?>">
<?php echo $m_agama_edit->id_agama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_agama_edit->nama_agama->Visible) { // nama_agama ?>
	<div id="r_nama_agama" class="form-group row">
		<label id="elh_m_agama_nama_agama" for="x_nama_agama" class="<?php echo $m_agama_edit->LeftColumnClass ?>"><?php echo $m_agama_edit->nama_agama->caption() ?><?php echo $m_agama_edit->nama_agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_agama_edit->RightColumnClass ?>"><div <?php echo $m_agama_edit->nama_agama->cellAttributes() ?>>
<span id="el_m_agama_nama_agama">
<input type="text" data-table="m_agama" data-field="x_nama_agama" name="x_nama_agama" id="x_nama_agama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_agama_edit->nama_agama->getPlaceHolder()) ?>" value="<?php echo $m_agama_edit->nama_agama->EditValue ?>"<?php echo $m_agama_edit->nama_agama->editAttributes() ?>>
</span>
<?php echo $m_agama_edit->nama_agama->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_agama_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_agama_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_agama_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_agama_edit->showPageFooter();
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
$m_agama_edit->terminate();
?>