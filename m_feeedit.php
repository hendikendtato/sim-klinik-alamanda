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
$m_fee_edit = new m_fee_edit();

// Run the page
$m_fee_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_fee_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_feeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_feeedit = currentForm = new ew.Form("fm_feeedit", "edit");

	// Validate form
	fm_feeedit.validate = function() {
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
			<?php if ($m_fee_edit->id_fee->Required) { ?>
				elm = this.getElements("x" + infix + "_id_fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_edit->id_fee->caption(), $m_fee_edit->id_fee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_edit->id_barang->caption(), $m_fee_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_edit->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_edit->id_pegawai->caption(), $m_fee_edit->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_edit->prosentase->Required) { ?>
				elm = this.getElements("x" + infix + "_prosentase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_edit->prosentase->caption(), $m_fee_edit->prosentase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prosentase");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_fee_edit->prosentase->errorMessage()) ?>");
			<?php if ($m_fee_edit->id_hargajual->Required) { ?>
				elm = this.getElements("x" + infix + "_id_hargajual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_edit->id_hargajual->caption(), $m_fee_edit->id_hargajual->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_edit->id_jenispegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jenispegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_edit->id_jenispegawai->caption(), $m_fee_edit->id_jenispegawai->RequiredErrorMessage)) ?>");
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
	fm_feeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_feeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_feeedit.lists["x_id_barang"] = <?php echo $m_fee_edit->id_barang->Lookup->toClientList($m_fee_edit) ?>;
	fm_feeedit.lists["x_id_barang"].options = <?php echo JsonEncode($m_fee_edit->id_barang->lookupOptions()) ?>;
	fm_feeedit.lists["x_id_pegawai"] = <?php echo $m_fee_edit->id_pegawai->Lookup->toClientList($m_fee_edit) ?>;
	fm_feeedit.lists["x_id_pegawai"].options = <?php echo JsonEncode($m_fee_edit->id_pegawai->lookupOptions()) ?>;
	loadjs.done("fm_feeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_fee_edit->showPageHeader(); ?>
<?php
$m_fee_edit->showMessage();
?>
<form name="fm_feeedit" id="fm_feeedit" class="<?php echo $m_fee_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_fee">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_fee_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_fee_edit->id_fee->Visible) { // id_fee ?>
	<div id="r_id_fee" class="form-group row">
		<label id="elh_m_fee_id_fee" class="<?php echo $m_fee_edit->LeftColumnClass ?>"><?php echo $m_fee_edit->id_fee->caption() ?><?php echo $m_fee_edit->id_fee->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_edit->RightColumnClass ?>"><div <?php echo $m_fee_edit->id_fee->cellAttributes() ?>>
<span id="el_m_fee_id_fee">
<span<?php echo $m_fee_edit->id_fee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_fee_edit->id_fee->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_fee" data-field="x_id_fee" name="x_id_fee" id="x_id_fee" value="<?php echo HtmlEncode($m_fee_edit->id_fee->CurrentValue) ?>">
<?php echo $m_fee_edit->id_fee->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_m_fee_id_barang" for="x_id_barang" class="<?php echo $m_fee_edit->LeftColumnClass ?>"><?php echo $m_fee_edit->id_barang->caption() ?><?php echo $m_fee_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_edit->RightColumnClass ?>"><div <?php echo $m_fee_edit->id_barang->cellAttributes() ?>>
<span id="el_m_fee_id_barang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_fee" data-field="x_id_barang" data-value-separator="<?php echo $m_fee_edit->id_barang->displayValueSeparatorAttribute() ?>" id="x_id_barang" name="x_id_barang" size="40"<?php echo $m_fee_edit->id_barang->editAttributes() ?>>
			<?php echo $m_fee_edit->id_barang->selectOptionListHtml("x_id_barang") ?>
		</select>
</div>
<?php echo $m_fee_edit->id_barang->Lookup->getParamTag($m_fee_edit, "p_x_id_barang") ?>
</span>
<?php echo $m_fee_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_edit->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_m_fee_id_pegawai" for="x_id_pegawai" class="<?php echo $m_fee_edit->LeftColumnClass ?>"><?php echo $m_fee_edit->id_pegawai->caption() ?><?php echo $m_fee_edit->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_edit->RightColumnClass ?>"><div <?php echo $m_fee_edit->id_pegawai->cellAttributes() ?>>
<span id="el_m_fee_id_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_fee" data-field="x_id_pegawai" data-value-separator="<?php echo $m_fee_edit->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $m_fee_edit->id_pegawai->editAttributes() ?>>
			<?php echo $m_fee_edit->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $m_fee_edit->id_pegawai->Lookup->getParamTag($m_fee_edit, "p_x_id_pegawai") ?>
</span>
<?php echo $m_fee_edit->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_edit->prosentase->Visible) { // prosentase ?>
	<div id="r_prosentase" class="form-group row">
		<label id="elh_m_fee_prosentase" for="x_prosentase" class="<?php echo $m_fee_edit->LeftColumnClass ?>"><?php echo $m_fee_edit->prosentase->caption() ?><?php echo $m_fee_edit->prosentase->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_edit->RightColumnClass ?>"><div <?php echo $m_fee_edit->prosentase->cellAttributes() ?>>
<span id="el_m_fee_prosentase">
<input type="text" data-table="m_fee" data-field="x_prosentase" name="x_prosentase" id="x_prosentase" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_fee_edit->prosentase->getPlaceHolder()) ?>" value="<?php echo $m_fee_edit->prosentase->EditValue ?>"<?php echo $m_fee_edit->prosentase->editAttributes() ?>>
</span>
<?php echo $m_fee_edit->prosentase->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_edit->id_hargajual->Visible) { // id_hargajual ?>
	<div id="r_id_hargajual" class="form-group row">
		<label id="elh_m_fee_id_hargajual" for="x_id_hargajual" class="<?php echo $m_fee_edit->LeftColumnClass ?>"><?php echo $m_fee_edit->id_hargajual->caption() ?><?php echo $m_fee_edit->id_hargajual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_edit->RightColumnClass ?>"><div <?php echo $m_fee_edit->id_hargajual->cellAttributes() ?>>
<span id="el_m_fee_id_hargajual">
<input type="text" data-table="m_fee" data-field="x_id_hargajual" name="x_id_hargajual" id="x_id_hargajual" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($m_fee_edit->id_hargajual->getPlaceHolder()) ?>" value="<?php echo $m_fee_edit->id_hargajual->EditValue ?>"<?php echo $m_fee_edit->id_hargajual->editAttributes() ?>>
</span>
<?php echo $m_fee_edit->id_hargajual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_edit->id_jenispegawai->Visible) { // id_jenispegawai ?>
	<div id="r_id_jenispegawai" class="form-group row">
		<label id="elh_m_fee_id_jenispegawai" for="x_id_jenispegawai" class="<?php echo $m_fee_edit->LeftColumnClass ?>"><?php echo $m_fee_edit->id_jenispegawai->caption() ?><?php echo $m_fee_edit->id_jenispegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_edit->RightColumnClass ?>"><div <?php echo $m_fee_edit->id_jenispegawai->cellAttributes() ?>>
<span id="el_m_fee_id_jenispegawai">
<input type="text" data-table="m_fee" data-field="x_id_jenispegawai" name="x_id_jenispegawai" id="x_id_jenispegawai" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($m_fee_edit->id_jenispegawai->getPlaceHolder()) ?>" value="<?php echo $m_fee_edit->id_jenispegawai->EditValue ?>"<?php echo $m_fee_edit->id_jenispegawai->editAttributes() ?>>
</span>
<?php echo $m_fee_edit->id_jenispegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_fee_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_fee_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_fee_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_fee_edit->showPageFooter();
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
$m_fee_edit->terminate();
?>