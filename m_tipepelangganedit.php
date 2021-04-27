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
$m_tipepelanggan_edit = new m_tipepelanggan_edit();

// Run the page
$m_tipepelanggan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tipepelanggan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_tipepelangganedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_tipepelangganedit = currentForm = new ew.Form("fm_tipepelangganedit", "edit");

	// Validate form
	fm_tipepelangganedit.validate = function() {
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
			<?php if ($m_tipepelanggan_edit->id_tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_id_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tipepelanggan_edit->id_tipe->caption(), $m_tipepelanggan_edit->id_tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_tipepelanggan_edit->nama_tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tipepelanggan_edit->nama_tipe->caption(), $m_tipepelanggan_edit->nama_tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_tipepelanggan_edit->min_kedatangan->Required) { ?>
				elm = this.getElements("x" + infix + "_min_kedatangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tipepelanggan_edit->min_kedatangan->caption(), $m_tipepelanggan_edit->min_kedatangan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_min_kedatangan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_tipepelanggan_edit->min_kedatangan->errorMessage()) ?>");
			<?php if ($m_tipepelanggan_edit->periode->Required) { ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_tipepelanggan_edit->periode->caption(), $m_tipepelanggan_edit->periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_tipepelanggan_edit->periode->errorMessage()) ?>");

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
	fm_tipepelangganedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_tipepelangganedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_tipepelangganedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_tipepelanggan_edit->showPageHeader(); ?>
<?php
$m_tipepelanggan_edit->showMessage();
?>
<form name="fm_tipepelangganedit" id="fm_tipepelangganedit" class="<?php echo $m_tipepelanggan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tipepelanggan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_tipepelanggan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_tipepelanggan_edit->id_tipe->Visible) { // id_tipe ?>
	<div id="r_id_tipe" class="form-group row">
		<label id="elh_m_tipepelanggan_id_tipe" class="<?php echo $m_tipepelanggan_edit->LeftColumnClass ?>"><?php echo $m_tipepelanggan_edit->id_tipe->caption() ?><?php echo $m_tipepelanggan_edit->id_tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tipepelanggan_edit->RightColumnClass ?>"><div <?php echo $m_tipepelanggan_edit->id_tipe->cellAttributes() ?>>
<span id="el_m_tipepelanggan_id_tipe">
<span<?php echo $m_tipepelanggan_edit->id_tipe->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_tipepelanggan_edit->id_tipe->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_tipepelanggan" data-field="x_id_tipe" name="x_id_tipe" id="x_id_tipe" value="<?php echo HtmlEncode($m_tipepelanggan_edit->id_tipe->CurrentValue) ?>">
<?php echo $m_tipepelanggan_edit->id_tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_tipepelanggan_edit->nama_tipe->Visible) { // nama_tipe ?>
	<div id="r_nama_tipe" class="form-group row">
		<label id="elh_m_tipepelanggan_nama_tipe" for="x_nama_tipe" class="<?php echo $m_tipepelanggan_edit->LeftColumnClass ?>"><?php echo $m_tipepelanggan_edit->nama_tipe->caption() ?><?php echo $m_tipepelanggan_edit->nama_tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tipepelanggan_edit->RightColumnClass ?>"><div <?php echo $m_tipepelanggan_edit->nama_tipe->cellAttributes() ?>>
<span id="el_m_tipepelanggan_nama_tipe">
<input type="text" data-table="m_tipepelanggan" data-field="x_nama_tipe" name="x_nama_tipe" id="x_nama_tipe" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_tipepelanggan_edit->nama_tipe->getPlaceHolder()) ?>" value="<?php echo $m_tipepelanggan_edit->nama_tipe->EditValue ?>"<?php echo $m_tipepelanggan_edit->nama_tipe->editAttributes() ?>>
</span>
<?php echo $m_tipepelanggan_edit->nama_tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_tipepelanggan_edit->min_kedatangan->Visible) { // min_kedatangan ?>
	<div id="r_min_kedatangan" class="form-group row">
		<label id="elh_m_tipepelanggan_min_kedatangan" for="x_min_kedatangan" class="<?php echo $m_tipepelanggan_edit->LeftColumnClass ?>"><?php echo $m_tipepelanggan_edit->min_kedatangan->caption() ?><?php echo $m_tipepelanggan_edit->min_kedatangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tipepelanggan_edit->RightColumnClass ?>"><div <?php echo $m_tipepelanggan_edit->min_kedatangan->cellAttributes() ?>>
<span id="el_m_tipepelanggan_min_kedatangan">
<input type="text" data-table="m_tipepelanggan" data-field="x_min_kedatangan" name="x_min_kedatangan" id="x_min_kedatangan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_tipepelanggan_edit->min_kedatangan->getPlaceHolder()) ?>" value="<?php echo $m_tipepelanggan_edit->min_kedatangan->EditValue ?>"<?php echo $m_tipepelanggan_edit->min_kedatangan->editAttributes() ?>>
</span>
<?php echo $m_tipepelanggan_edit->min_kedatangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_tipepelanggan_edit->periode->Visible) { // periode ?>
	<div id="r_periode" class="form-group row">
		<label id="elh_m_tipepelanggan_periode" for="x_periode" class="<?php echo $m_tipepelanggan_edit->LeftColumnClass ?>"><?php echo $m_tipepelanggan_edit->periode->caption() ?><?php echo $m_tipepelanggan_edit->periode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_tipepelanggan_edit->RightColumnClass ?>"><div <?php echo $m_tipepelanggan_edit->periode->cellAttributes() ?>>
<span id="el_m_tipepelanggan_periode">
<input type="text" data-table="m_tipepelanggan" data-field="x_periode" name="x_periode" id="x_periode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_tipepelanggan_edit->periode->getPlaceHolder()) ?>" value="<?php echo $m_tipepelanggan_edit->periode->EditValue ?>"<?php echo $m_tipepelanggan_edit->periode->editAttributes() ?>>
</span>
<?php echo $m_tipepelanggan_edit->periode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_tipepelanggan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_tipepelanggan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_tipepelanggan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_tipepelanggan_edit->showPageFooter();
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
$m_tipepelanggan_edit->terminate();
?>