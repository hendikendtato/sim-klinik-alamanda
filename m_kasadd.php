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
$m_kas_add = new m_kas_add();

// Run the page
$m_kas_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kas_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_kasadd = currentForm = new ew.Form("fm_kasadd", "add");

	// Validate form
	fm_kasadd.validate = function() {
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
			<?php if ($m_kas_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kas_add->id_klinik->caption(), $m_kas_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kas_add->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kas_add->nama->caption(), $m_kas_add->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kas_add->saldo->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kas_add->saldo->caption(), $m_kas_add->saldo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_kas_add->saldo->errorMessage()) ?>");

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
	fm_kasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_kasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_kasadd.lists["x_id_klinik"] = <?php echo $m_kas_add->id_klinik->Lookup->toClientList($m_kas_add) ?>;
	fm_kasadd.lists["x_id_klinik"].options = <?php echo JsonEncode($m_kas_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fm_kasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kas_add->showPageHeader(); ?>
<?php
$m_kas_add->showMessage();
?>
<form name="fm_kasadd" id="fm_kasadd" class="<?php echo $m_kas_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kas">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_kas_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_kas_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_kas_id_klinik" for="x_id_klinik" class="<?php echo $m_kas_add->LeftColumnClass ?>"><?php echo $m_kas_add->id_klinik->caption() ?><?php echo $m_kas_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kas_add->RightColumnClass ?>"><div <?php echo $m_kas_add->id_klinik->cellAttributes() ?>>
<span id="el_m_kas_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_kas" data-field="x_id_klinik" data-value-separator="<?php echo $m_kas_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_kas_add->id_klinik->editAttributes() ?>>
			<?php echo $m_kas_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_kas_add->id_klinik->Lookup->getParamTag($m_kas_add, "p_x_id_klinik") ?>
</span>
<?php echo $m_kas_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kas_add->nama->Visible) { // nama ?>
	<div id="r_nama" class="form-group row">
		<label id="elh_m_kas_nama" for="x_nama" class="<?php echo $m_kas_add->LeftColumnClass ?>"><?php echo $m_kas_add->nama->caption() ?><?php echo $m_kas_add->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kas_add->RightColumnClass ?>"><div <?php echo $m_kas_add->nama->cellAttributes() ?>>
<span id="el_m_kas_nama">
<input type="text" data-table="m_kas" data-field="x_nama" name="x_nama" id="x_nama" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($m_kas_add->nama->getPlaceHolder()) ?>" value="<?php echo $m_kas_add->nama->EditValue ?>"<?php echo $m_kas_add->nama->editAttributes() ?>>
</span>
<?php echo $m_kas_add->nama->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kas_add->saldo->Visible) { // saldo ?>
	<div id="r_saldo" class="form-group row">
		<label id="elh_m_kas_saldo" for="x_saldo" class="<?php echo $m_kas_add->LeftColumnClass ?>"><?php echo $m_kas_add->saldo->caption() ?><?php echo $m_kas_add->saldo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kas_add->RightColumnClass ?>"><div <?php echo $m_kas_add->saldo->cellAttributes() ?>>
<span id="el_m_kas_saldo">
<input type="text" data-table="m_kas" data-field="x_saldo" name="x_saldo" id="x_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_kas_add->saldo->getPlaceHolder()) ?>" value="<?php echo $m_kas_add->saldo->EditValue ?>"<?php echo $m_kas_add->saldo->editAttributes() ?>>
</span>
<?php echo $m_kas_add->saldo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_kas_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_kas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kas_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_kas_add->showPageFooter();
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
$m_kas_add->terminate();
?>