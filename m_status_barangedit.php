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
$m_status_barang_edit = new m_status_barang_edit();

// Run the page
$m_status_barang_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_status_barang_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_status_barangedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_status_barangedit = currentForm = new ew.Form("fm_status_barangedit", "edit");

	// Validate form
	fm_status_barangedit.validate = function() {
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
			<?php if ($m_status_barang_edit->id_status->Required) { ?>
				elm = this.getElements("x" + infix + "_id_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_status_barang_edit->id_status->caption(), $m_status_barang_edit->id_status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_status_barang_edit->status_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_status_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_status_barang_edit->status_barang->caption(), $m_status_barang_edit->status_barang->RequiredErrorMessage)) ?>");
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
	fm_status_barangedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_status_barangedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_status_barangedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_status_barang_edit->showPageHeader(); ?>
<?php
$m_status_barang_edit->showMessage();
?>
<form name="fm_status_barangedit" id="fm_status_barangedit" class="<?php echo $m_status_barang_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_status_barang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_status_barang_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_status_barang_edit->id_status->Visible) { // id_status ?>
	<div id="r_id_status" class="form-group row">
		<label id="elh_m_status_barang_id_status" class="<?php echo $m_status_barang_edit->LeftColumnClass ?>"><?php echo $m_status_barang_edit->id_status->caption() ?><?php echo $m_status_barang_edit->id_status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_status_barang_edit->RightColumnClass ?>"><div <?php echo $m_status_barang_edit->id_status->cellAttributes() ?>>
<span id="el_m_status_barang_id_status">
<span<?php echo $m_status_barang_edit->id_status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_status_barang_edit->id_status->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_status_barang" data-field="x_id_status" name="x_id_status" id="x_id_status" value="<?php echo HtmlEncode($m_status_barang_edit->id_status->CurrentValue) ?>">
<?php echo $m_status_barang_edit->id_status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_status_barang_edit->status_barang->Visible) { // status_barang ?>
	<div id="r_status_barang" class="form-group row">
		<label id="elh_m_status_barang_status_barang" for="x_status_barang" class="<?php echo $m_status_barang_edit->LeftColumnClass ?>"><?php echo $m_status_barang_edit->status_barang->caption() ?><?php echo $m_status_barang_edit->status_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_status_barang_edit->RightColumnClass ?>"><div <?php echo $m_status_barang_edit->status_barang->cellAttributes() ?>>
<span id="el_m_status_barang_status_barang">
<input type="text" data-table="m_status_barang" data-field="x_status_barang" name="x_status_barang" id="x_status_barang" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_status_barang_edit->status_barang->getPlaceHolder()) ?>" value="<?php echo $m_status_barang_edit->status_barang->EditValue ?>"<?php echo $m_status_barang_edit->status_barang->editAttributes() ?>>
</span>
<?php echo $m_status_barang_edit->status_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_status_barang_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_status_barang_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_status_barang_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_status_barang_edit->showPageFooter();
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
$m_status_barang_edit->terminate();
?>