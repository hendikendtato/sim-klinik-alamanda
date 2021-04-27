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
$m_poin_add = new m_poin_add();

// Run the page
$m_poin_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_poin_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_poinadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_poinadd = currentForm = new ew.Form("fm_poinadd", "add");

	// Validate form
	fm_poinadd.validate = function() {
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
			<?php if ($m_poin_add->id_jenis_member->Required) { ?>
				elm = this.getElements("x" + infix + "_id_jenis_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_poin_add->id_jenis_member->caption(), $m_poin_add->id_jenis_member->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_poin_add->curs_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_curs_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_poin_add->curs_poin->caption(), $m_poin_add->curs_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_curs_poin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_poin_add->curs_poin->errorMessage()) ?>");
			<?php if ($m_poin_add->curs_to_rp->Required) { ?>
				elm = this.getElements("x" + infix + "_curs_to_rp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_poin_add->curs_to_rp->caption(), $m_poin_add->curs_to_rp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_curs_to_rp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_poin_add->curs_to_rp->errorMessage()) ?>");
			<?php if ($m_poin_add->max_klaim->Required) { ?>
				elm = this.getElements("x" + infix + "_max_klaim");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_poin_add->max_klaim->caption(), $m_poin_add->max_klaim->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_max_klaim");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_poin_add->max_klaim->errorMessage()) ?>");
			<?php if ($m_poin_add->min_transaksi->Required) { ?>
				elm = this.getElements("x" + infix + "_min_transaksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_poin_add->min_transaksi->caption(), $m_poin_add->min_transaksi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_min_transaksi");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_poin_add->min_transaksi->errorMessage()) ?>");
			<?php if ($m_poin_add->waktu_exp->Required) { ?>
				elm = this.getElements("x" + infix + "_waktu_exp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_poin_add->waktu_exp->caption(), $m_poin_add->waktu_exp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_waktu_exp");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_poin_add->waktu_exp->errorMessage()) ?>");

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
	fm_poinadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_poinadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_poinadd.lists["x_id_jenis_member"] = <?php echo $m_poin_add->id_jenis_member->Lookup->toClientList($m_poin_add) ?>;
	fm_poinadd.lists["x_id_jenis_member"].options = <?php echo JsonEncode($m_poin_add->id_jenis_member->lookupOptions()) ?>;
	loadjs.done("fm_poinadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_poin_add->showPageHeader(); ?>
<?php
$m_poin_add->showMessage();
?>
<form name="fm_poinadd" id="fm_poinadd" class="<?php echo $m_poin_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_poin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_poin_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_poin_add->id_jenis_member->Visible) { // id_jenis_member ?>
	<div id="r_id_jenis_member" class="form-group row">
		<label id="elh_m_poin_id_jenis_member" for="x_id_jenis_member" class="<?php echo $m_poin_add->LeftColumnClass ?>"><?php echo $m_poin_add->id_jenis_member->caption() ?><?php echo $m_poin_add->id_jenis_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_poin_add->RightColumnClass ?>"><div <?php echo $m_poin_add->id_jenis_member->cellAttributes() ?>>
<span id="el_m_poin_id_jenis_member">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_poin" data-field="x_id_jenis_member" data-value-separator="<?php echo $m_poin_add->id_jenis_member->displayValueSeparatorAttribute() ?>" id="x_id_jenis_member" name="x_id_jenis_member"<?php echo $m_poin_add->id_jenis_member->editAttributes() ?>>
			<?php echo $m_poin_add->id_jenis_member->selectOptionListHtml("x_id_jenis_member") ?>
		</select>
</div>
<?php echo $m_poin_add->id_jenis_member->Lookup->getParamTag($m_poin_add, "p_x_id_jenis_member") ?>
</span>
<?php echo $m_poin_add->id_jenis_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_poin_add->curs_poin->Visible) { // curs_poin ?>
	<div id="r_curs_poin" class="form-group row">
		<label id="elh_m_poin_curs_poin" for="x_curs_poin" class="<?php echo $m_poin_add->LeftColumnClass ?>"><?php echo $m_poin_add->curs_poin->caption() ?><?php echo $m_poin_add->curs_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_poin_add->RightColumnClass ?>"><div <?php echo $m_poin_add->curs_poin->cellAttributes() ?>>
<span id="el_m_poin_curs_poin">
<input type="text" data-table="m_poin" data-field="x_curs_poin" name="x_curs_poin" id="x_curs_poin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_poin_add->curs_poin->getPlaceHolder()) ?>" value="<?php echo $m_poin_add->curs_poin->EditValue ?>"<?php echo $m_poin_add->curs_poin->editAttributes() ?>>
</span>
<?php echo $m_poin_add->curs_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_poin_add->curs_to_rp->Visible) { // curs_to_rp ?>
	<div id="r_curs_to_rp" class="form-group row">
		<label id="elh_m_poin_curs_to_rp" for="x_curs_to_rp" class="<?php echo $m_poin_add->LeftColumnClass ?>"><?php echo $m_poin_add->curs_to_rp->caption() ?><?php echo $m_poin_add->curs_to_rp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_poin_add->RightColumnClass ?>"><div <?php echo $m_poin_add->curs_to_rp->cellAttributes() ?>>
<span id="el_m_poin_curs_to_rp">
<input type="text" data-table="m_poin" data-field="x_curs_to_rp" name="x_curs_to_rp" id="x_curs_to_rp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_poin_add->curs_to_rp->getPlaceHolder()) ?>" value="<?php echo $m_poin_add->curs_to_rp->EditValue ?>"<?php echo $m_poin_add->curs_to_rp->editAttributes() ?>>
</span>
<?php echo $m_poin_add->curs_to_rp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_poin_add->max_klaim->Visible) { // max_klaim ?>
	<div id="r_max_klaim" class="form-group row">
		<label id="elh_m_poin_max_klaim" for="x_max_klaim" class="<?php echo $m_poin_add->LeftColumnClass ?>"><?php echo $m_poin_add->max_klaim->caption() ?><?php echo $m_poin_add->max_klaim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_poin_add->RightColumnClass ?>"><div <?php echo $m_poin_add->max_klaim->cellAttributes() ?>>
<span id="el_m_poin_max_klaim">
<input type="text" data-table="m_poin" data-field="x_max_klaim" name="x_max_klaim" id="x_max_klaim" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_poin_add->max_klaim->getPlaceHolder()) ?>" value="<?php echo $m_poin_add->max_klaim->EditValue ?>"<?php echo $m_poin_add->max_klaim->editAttributes() ?>>
</span>
<?php echo $m_poin_add->max_klaim->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_poin_add->min_transaksi->Visible) { // min_transaksi ?>
	<div id="r_min_transaksi" class="form-group row">
		<label id="elh_m_poin_min_transaksi" for="x_min_transaksi" class="<?php echo $m_poin_add->LeftColumnClass ?>"><?php echo $m_poin_add->min_transaksi->caption() ?><?php echo $m_poin_add->min_transaksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_poin_add->RightColumnClass ?>"><div <?php echo $m_poin_add->min_transaksi->cellAttributes() ?>>
<span id="el_m_poin_min_transaksi">
<input type="text" data-table="m_poin" data-field="x_min_transaksi" name="x_min_transaksi" id="x_min_transaksi" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_poin_add->min_transaksi->getPlaceHolder()) ?>" value="<?php echo $m_poin_add->min_transaksi->EditValue ?>"<?php echo $m_poin_add->min_transaksi->editAttributes() ?>>
</span>
<?php echo $m_poin_add->min_transaksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_poin_add->waktu_exp->Visible) { // waktu_exp ?>
	<div id="r_waktu_exp" class="form-group row">
		<label id="elh_m_poin_waktu_exp" for="x_waktu_exp" class="<?php echo $m_poin_add->LeftColumnClass ?>"><?php echo $m_poin_add->waktu_exp->caption() ?><?php echo $m_poin_add->waktu_exp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_poin_add->RightColumnClass ?>"><div <?php echo $m_poin_add->waktu_exp->cellAttributes() ?>>
<span id="el_m_poin_waktu_exp">
<input type="text" data-table="m_poin" data-field="x_waktu_exp" name="x_waktu_exp" id="x_waktu_exp" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_poin_add->waktu_exp->getPlaceHolder()) ?>" value="<?php echo $m_poin_add->waktu_exp->EditValue ?>"<?php echo $m_poin_add->waktu_exp->editAttributes() ?>>
</span>
<?php echo $m_poin_add->waktu_exp->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_poin_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_poin_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_poin_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_poin_add->showPageFooter();
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
$m_poin_add->terminate();
?>