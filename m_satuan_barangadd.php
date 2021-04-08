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
$m_satuan_barang_add = new m_satuan_barang_add();

// Run the page
$m_satuan_barang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_satuan_barang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_satuan_barangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_satuan_barangadd = currentForm = new ew.Form("fm_satuan_barangadd", "add");

	// Validate form
	fm_satuan_barangadd.validate = function() {
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
			<?php if ($m_satuan_barang_add->kode_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_satuan_barang_add->kode_satuan->caption(), $m_satuan_barang_add->kode_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_satuan_barang_add->nama_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_satuan_barang_add->nama_satuan->caption(), $m_satuan_barang_add->nama_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_satuan_barang_add->level_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_level_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_satuan_barang_add->level_satuan->caption(), $m_satuan_barang_add->level_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_level_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_satuan_barang_add->level_satuan->errorMessage()) ?>");
			<?php if ($m_satuan_barang_add->konversi_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_konversi_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_satuan_barang_add->konversi_satuan->caption(), $m_satuan_barang_add->konversi_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_satuan_barang_add->pid_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_satuan_barang_add->pid_satuan->caption(), $m_satuan_barang_add->pid_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_satuan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_satuan_barang_add->pid_satuan->errorMessage()) ?>");

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
	fm_satuan_barangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_satuan_barangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_satuan_barangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_satuan_barang_add->showPageHeader(); ?>
<?php
$m_satuan_barang_add->showMessage();
?>
<form name="fm_satuan_barangadd" id="fm_satuan_barangadd" class="<?php echo $m_satuan_barang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_satuan_barang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_satuan_barang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_satuan_barang_add->kode_satuan->Visible) { // kode_satuan ?>
	<div id="r_kode_satuan" class="form-group row">
		<label id="elh_m_satuan_barang_kode_satuan" for="x_kode_satuan" class="<?php echo $m_satuan_barang_add->LeftColumnClass ?>"><?php echo $m_satuan_barang_add->kode_satuan->caption() ?><?php echo $m_satuan_barang_add->kode_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_satuan_barang_add->RightColumnClass ?>"><div <?php echo $m_satuan_barang_add->kode_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_kode_satuan">
<input type="text" data-table="m_satuan_barang" data-field="x_kode_satuan" name="x_kode_satuan" id="x_kode_satuan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_satuan_barang_add->kode_satuan->getPlaceHolder()) ?>" value="<?php echo $m_satuan_barang_add->kode_satuan->EditValue ?>"<?php echo $m_satuan_barang_add->kode_satuan->editAttributes() ?>>
</span>
<?php echo $m_satuan_barang_add->kode_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_satuan_barang_add->nama_satuan->Visible) { // nama_satuan ?>
	<div id="r_nama_satuan" class="form-group row">
		<label id="elh_m_satuan_barang_nama_satuan" for="x_nama_satuan" class="<?php echo $m_satuan_barang_add->LeftColumnClass ?>"><?php echo $m_satuan_barang_add->nama_satuan->caption() ?><?php echo $m_satuan_barang_add->nama_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_satuan_barang_add->RightColumnClass ?>"><div <?php echo $m_satuan_barang_add->nama_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_nama_satuan">
<input type="text" data-table="m_satuan_barang" data-field="x_nama_satuan" name="x_nama_satuan" id="x_nama_satuan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_satuan_barang_add->nama_satuan->getPlaceHolder()) ?>" value="<?php echo $m_satuan_barang_add->nama_satuan->EditValue ?>"<?php echo $m_satuan_barang_add->nama_satuan->editAttributes() ?>>
</span>
<?php echo $m_satuan_barang_add->nama_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_satuan_barang_add->level_satuan->Visible) { // level_satuan ?>
	<div id="r_level_satuan" class="form-group row">
		<label id="elh_m_satuan_barang_level_satuan" for="x_level_satuan" class="<?php echo $m_satuan_barang_add->LeftColumnClass ?>"><?php echo $m_satuan_barang_add->level_satuan->caption() ?><?php echo $m_satuan_barang_add->level_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_satuan_barang_add->RightColumnClass ?>"><div <?php echo $m_satuan_barang_add->level_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_level_satuan">
<input type="text" data-table="m_satuan_barang" data-field="x_level_satuan" name="x_level_satuan" id="x_level_satuan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_satuan_barang_add->level_satuan->getPlaceHolder()) ?>" value="<?php echo $m_satuan_barang_add->level_satuan->EditValue ?>"<?php echo $m_satuan_barang_add->level_satuan->editAttributes() ?>>
</span>
<?php echo $m_satuan_barang_add->level_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_satuan_barang_add->konversi_satuan->Visible) { // konversi_satuan ?>
	<div id="r_konversi_satuan" class="form-group row">
		<label id="elh_m_satuan_barang_konversi_satuan" for="x_konversi_satuan" class="<?php echo $m_satuan_barang_add->LeftColumnClass ?>"><?php echo $m_satuan_barang_add->konversi_satuan->caption() ?><?php echo $m_satuan_barang_add->konversi_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_satuan_barang_add->RightColumnClass ?>"><div <?php echo $m_satuan_barang_add->konversi_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_konversi_satuan">
<input type="text" data-table="m_satuan_barang" data-field="x_konversi_satuan" name="x_konversi_satuan" id="x_konversi_satuan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_satuan_barang_add->konversi_satuan->getPlaceHolder()) ?>" value="<?php echo $m_satuan_barang_add->konversi_satuan->EditValue ?>"<?php echo $m_satuan_barang_add->konversi_satuan->editAttributes() ?>>
</span>
<?php echo $m_satuan_barang_add->konversi_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_satuan_barang_add->pid_satuan->Visible) { // pid_satuan ?>
	<div id="r_pid_satuan" class="form-group row">
		<label id="elh_m_satuan_barang_pid_satuan" for="x_pid_satuan" class="<?php echo $m_satuan_barang_add->LeftColumnClass ?>"><?php echo $m_satuan_barang_add->pid_satuan->caption() ?><?php echo $m_satuan_barang_add->pid_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_satuan_barang_add->RightColumnClass ?>"><div <?php echo $m_satuan_barang_add->pid_satuan->cellAttributes() ?>>
<span id="el_m_satuan_barang_pid_satuan">
<input type="text" data-table="m_satuan_barang" data-field="x_pid_satuan" name="x_pid_satuan" id="x_pid_satuan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_satuan_barang_add->pid_satuan->getPlaceHolder()) ?>" value="<?php echo $m_satuan_barang_add->pid_satuan->EditValue ?>"<?php echo $m_satuan_barang_add->pid_satuan->editAttributes() ?>>
</span>
<?php echo $m_satuan_barang_add->pid_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_satuan_barang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_satuan_barang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_satuan_barang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_satuan_barang_add->showPageFooter();
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
$m_satuan_barang_add->terminate();
?>