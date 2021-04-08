<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$m_klinik_edit = new m_klinik_edit();

// Run the page
$m_klinik_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_klinik_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_klinikedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_klinikedit = currentForm = new ew.Form("fm_klinikedit", "edit");

	// Validate form
	fm_klinikedit.validate = function() {
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
			<?php if ($m_klinik_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_klinik_edit->id_klinik->caption(), $m_klinik_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_klinik_edit->nama_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_klinik_edit->nama_klinik->caption(), $m_klinik_edit->nama_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_klinik_edit->telpon_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_telpon_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_klinik_edit->telpon_klinik->caption(), $m_klinik_edit->telpon_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_klinik_edit->alamat_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_alamat_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_klinik_edit->alamat_klinik->caption(), $m_klinik_edit->alamat_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_klinik_edit->foto_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_foto_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_klinik_edit->foto_klinik->caption(), $m_klinik_edit->foto_klinik->RequiredErrorMessage)) ?>");
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
	fm_klinikedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_klinikedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_klinikedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_klinik_edit->showPageHeader(); ?>
<?php
$m_klinik_edit->showMessage();
?>
<form name="fm_klinikedit" id="fm_klinikedit" class="<?php echo $m_klinik_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_klinik">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_klinik_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_klinik_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_klinik_id_klinik" class="<?php echo $m_klinik_edit->LeftColumnClass ?>"><?php echo $m_klinik_edit->id_klinik->caption() ?><?php echo $m_klinik_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_klinik_edit->RightColumnClass ?>"><div <?php echo $m_klinik_edit->id_klinik->cellAttributes() ?>>
<span id="el_m_klinik_id_klinik">
<span<?php echo $m_klinik_edit->id_klinik->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_klinik_edit->id_klinik->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_klinik" data-field="x_id_klinik" name="x_id_klinik" id="x_id_klinik" value="<?php echo HtmlEncode($m_klinik_edit->id_klinik->CurrentValue) ?>">
<?php echo $m_klinik_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_klinik_edit->nama_klinik->Visible) { // nama_klinik ?>
	<div id="r_nama_klinik" class="form-group row">
		<label id="elh_m_klinik_nama_klinik" for="x_nama_klinik" class="<?php echo $m_klinik_edit->LeftColumnClass ?>"><?php echo $m_klinik_edit->nama_klinik->caption() ?><?php echo $m_klinik_edit->nama_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_klinik_edit->RightColumnClass ?>"><div <?php echo $m_klinik_edit->nama_klinik->cellAttributes() ?>>
<span id="el_m_klinik_nama_klinik">
<input type="text" data-table="m_klinik" data-field="x_nama_klinik" name="x_nama_klinik" id="x_nama_klinik" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_klinik_edit->nama_klinik->getPlaceHolder()) ?>" value="<?php echo $m_klinik_edit->nama_klinik->EditValue ?>"<?php echo $m_klinik_edit->nama_klinik->editAttributes() ?>>
</span>
<?php echo $m_klinik_edit->nama_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_klinik_edit->telpon_klinik->Visible) { // telpon_klinik ?>
	<div id="r_telpon_klinik" class="form-group row">
		<label id="elh_m_klinik_telpon_klinik" for="x_telpon_klinik" class="<?php echo $m_klinik_edit->LeftColumnClass ?>"><?php echo $m_klinik_edit->telpon_klinik->caption() ?><?php echo $m_klinik_edit->telpon_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_klinik_edit->RightColumnClass ?>"><div <?php echo $m_klinik_edit->telpon_klinik->cellAttributes() ?>>
<span id="el_m_klinik_telpon_klinik">
<textarea data-table="m_klinik" data-field="x_telpon_klinik" name="x_telpon_klinik" id="x_telpon_klinik" cols="35" rows="4" placeholder="<?php echo HtmlEncode($m_klinik_edit->telpon_klinik->getPlaceHolder()) ?>"<?php echo $m_klinik_edit->telpon_klinik->editAttributes() ?>><?php echo $m_klinik_edit->telpon_klinik->EditValue ?></textarea>
</span>
<?php echo $m_klinik_edit->telpon_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_klinik_edit->alamat_klinik->Visible) { // alamat_klinik ?>
	<div id="r_alamat_klinik" class="form-group row">
		<label id="elh_m_klinik_alamat_klinik" for="x_alamat_klinik" class="<?php echo $m_klinik_edit->LeftColumnClass ?>"><?php echo $m_klinik_edit->alamat_klinik->caption() ?><?php echo $m_klinik_edit->alamat_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_klinik_edit->RightColumnClass ?>"><div <?php echo $m_klinik_edit->alamat_klinik->cellAttributes() ?>>
<span id="el_m_klinik_alamat_klinik">
<textarea data-table="m_klinik" data-field="x_alamat_klinik" name="x_alamat_klinik" id="x_alamat_klinik" cols="35" rows="4" placeholder="<?php echo HtmlEncode($m_klinik_edit->alamat_klinik->getPlaceHolder()) ?>"<?php echo $m_klinik_edit->alamat_klinik->editAttributes() ?>><?php echo $m_klinik_edit->alamat_klinik->EditValue ?></textarea>
</span>
<?php echo $m_klinik_edit->alamat_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_klinik_edit->foto_klinik->Visible) { // foto_klinik ?>
	<div id="r_foto_klinik" class="form-group row">
		<label id="elh_m_klinik_foto_klinik" for="x_foto_klinik" class="<?php echo $m_klinik_edit->LeftColumnClass ?>"><?php echo $m_klinik_edit->foto_klinik->caption() ?><?php echo $m_klinik_edit->foto_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_klinik_edit->RightColumnClass ?>"><div <?php echo $m_klinik_edit->foto_klinik->cellAttributes() ?>>
<span id="el_m_klinik_foto_klinik">
<input type="text" data-table="m_klinik" data-field="x_foto_klinik" name="x_foto_klinik" id="x_foto_klinik" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_klinik_edit->foto_klinik->getPlaceHolder()) ?>" value="<?php echo $m_klinik_edit->foto_klinik->EditValue ?>"<?php echo $m_klinik_edit->foto_klinik->editAttributes() ?>>
</span>
<?php echo $m_klinik_edit->foto_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_klinik_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_klinik_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_klinik_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_klinik_edit->showPageFooter();
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
$m_klinik_edit->terminate();
?>