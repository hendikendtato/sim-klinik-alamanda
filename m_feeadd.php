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
$m_fee_add = new m_fee_add();

// Run the page
$m_fee_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_fee_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_feeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_feeadd = currentForm = new ew.Form("fm_feeadd", "add");

	// Validate form
	fm_feeadd.validate = function() {
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
			<?php if ($m_fee_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_add->id_barang->caption(), $m_fee_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_add->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_add->id_pegawai->caption(), $m_fee_add->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_add->prosentase->Required) { ?>
				elm = this.getElements("x" + infix + "_prosentase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_add->prosentase->caption(), $m_fee_add->prosentase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prosentase");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_fee_add->prosentase->errorMessage()) ?>");
			<?php if ($m_fee_add->id_hargajual->Required) { ?>
				elm = this.getElements("x" + infix + "_id_hargajual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_add->id_hargajual->caption(), $m_fee_add->id_hargajual->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_fee_add->id_jenispegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jenispegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_fee_add->id_jenispegawai->caption(), $m_fee_add->id_jenispegawai->RequiredErrorMessage)) ?>");
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
	fm_feeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_feeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_feeadd.lists["x_id_barang"] = <?php echo $m_fee_add->id_barang->Lookup->toClientList($m_fee_add) ?>;
	fm_feeadd.lists["x_id_barang"].options = <?php echo JsonEncode($m_fee_add->id_barang->lookupOptions()) ?>;
	fm_feeadd.lists["x_id_pegawai"] = <?php echo $m_fee_add->id_pegawai->Lookup->toClientList($m_fee_add) ?>;
	fm_feeadd.lists["x_id_pegawai"].options = <?php echo JsonEncode($m_fee_add->id_pegawai->lookupOptions()) ?>;
	loadjs.done("fm_feeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_fee_add->showPageHeader(); ?>
<?php
$m_fee_add->showMessage();
?>
<form name="fm_feeadd" id="fm_feeadd" class="<?php echo $m_fee_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_fee">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_fee_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_fee_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_m_fee_id_barang" for="x_id_barang" class="<?php echo $m_fee_add->LeftColumnClass ?>"><?php echo $m_fee_add->id_barang->caption() ?><?php echo $m_fee_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_add->RightColumnClass ?>"><div <?php echo $m_fee_add->id_barang->cellAttributes() ?>>
<span id="el_m_fee_id_barang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_fee" data-field="x_id_barang" data-value-separator="<?php echo $m_fee_add->id_barang->displayValueSeparatorAttribute() ?>" id="x_id_barang" name="x_id_barang" size="40"<?php echo $m_fee_add->id_barang->editAttributes() ?>>
			<?php echo $m_fee_add->id_barang->selectOptionListHtml("x_id_barang") ?>
		</select>
</div>
<?php echo $m_fee_add->id_barang->Lookup->getParamTag($m_fee_add, "p_x_id_barang") ?>
</span>
<?php echo $m_fee_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_add->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_m_fee_id_pegawai" for="x_id_pegawai" class="<?php echo $m_fee_add->LeftColumnClass ?>"><?php echo $m_fee_add->id_pegawai->caption() ?><?php echo $m_fee_add->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_add->RightColumnClass ?>"><div <?php echo $m_fee_add->id_pegawai->cellAttributes() ?>>
<span id="el_m_fee_id_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_fee" data-field="x_id_pegawai" data-value-separator="<?php echo $m_fee_add->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $m_fee_add->id_pegawai->editAttributes() ?>>
			<?php echo $m_fee_add->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $m_fee_add->id_pegawai->Lookup->getParamTag($m_fee_add, "p_x_id_pegawai") ?>
</span>
<?php echo $m_fee_add->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_add->prosentase->Visible) { // prosentase ?>
	<div id="r_prosentase" class="form-group row">
		<label id="elh_m_fee_prosentase" for="x_prosentase" class="<?php echo $m_fee_add->LeftColumnClass ?>"><?php echo $m_fee_add->prosentase->caption() ?><?php echo $m_fee_add->prosentase->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_add->RightColumnClass ?>"><div <?php echo $m_fee_add->prosentase->cellAttributes() ?>>
<span id="el_m_fee_prosentase">
<input type="text" data-table="m_fee" data-field="x_prosentase" name="x_prosentase" id="x_prosentase" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_fee_add->prosentase->getPlaceHolder()) ?>" value="<?php echo $m_fee_add->prosentase->EditValue ?>"<?php echo $m_fee_add->prosentase->editAttributes() ?>>
</span>
<?php echo $m_fee_add->prosentase->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_add->id_hargajual->Visible) { // id_hargajual ?>
	<div id="r_id_hargajual" class="form-group row">
		<label id="elh_m_fee_id_hargajual" for="x_id_hargajual" class="<?php echo $m_fee_add->LeftColumnClass ?>"><?php echo $m_fee_add->id_hargajual->caption() ?><?php echo $m_fee_add->id_hargajual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_add->RightColumnClass ?>"><div <?php echo $m_fee_add->id_hargajual->cellAttributes() ?>>
<span id="el_m_fee_id_hargajual">
<input type="text" data-table="m_fee" data-field="x_id_hargajual" name="x_id_hargajual" id="x_id_hargajual" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($m_fee_add->id_hargajual->getPlaceHolder()) ?>" value="<?php echo $m_fee_add->id_hargajual->EditValue ?>"<?php echo $m_fee_add->id_hargajual->editAttributes() ?>>
</span>
<?php echo $m_fee_add->id_hargajual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_fee_add->id_jenispegawai->Visible) { // id_jenispegawai ?>
	<div id="r_id_jenispegawai" class="form-group row">
		<label id="elh_m_fee_id_jenispegawai" for="x_id_jenispegawai" class="<?php echo $m_fee_add->LeftColumnClass ?>"><?php echo $m_fee_add->id_jenispegawai->caption() ?><?php echo $m_fee_add->id_jenispegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_fee_add->RightColumnClass ?>"><div <?php echo $m_fee_add->id_jenispegawai->cellAttributes() ?>>
<span id="el_m_fee_id_jenispegawai">
<input type="text" data-table="m_fee" data-field="x_id_jenispegawai" name="x_id_jenispegawai" id="x_id_jenispegawai" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($m_fee_add->id_jenispegawai->getPlaceHolder()) ?>" value="<?php echo $m_fee_add->id_jenispegawai->EditValue ?>"<?php echo $m_fee_add->id_jenispegawai->editAttributes() ?>>
</span>
<?php echo $m_fee_add->id_jenispegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_fee_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_fee_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_fee_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_fee_add->showPageFooter();
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
$m_fee_add->terminate();
?>