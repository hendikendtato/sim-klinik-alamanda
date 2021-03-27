<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$detailpenyesuaianpoin_edit = new detailpenyesuaianpoin_edit();

// Run the page
$detailpenyesuaianpoin_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianpoin_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpenyesuaianpoinedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdetailpenyesuaianpoinedit = currentForm = new ew.Form("fdetailpenyesuaianpoinedit", "edit");

	// Validate form
	fdetailpenyesuaianpoinedit.validate = function() {
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
			<?php if ($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_penyesuaianpoin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->caption(), $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_penyesuaianpoin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_edit->id_member->Required) { ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->id_member->caption(), $detailpenyesuaianpoin_edit->id_member->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_edit->id_member->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_edit->poin_database->Required) { ?>
				elm = this.getElements("x" + infix + "_poin_database");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->poin_database->caption(), $detailpenyesuaianpoin_edit->poin_database->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_poin_database");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_edit->poin_database->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_edit->poin_lapangan->Required) { ?>
				elm = this.getElements("x" + infix + "_poin_lapangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->poin_lapangan->caption(), $detailpenyesuaianpoin_edit->poin_lapangan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_poin_lapangan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_edit->poin_lapangan->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_edit->selisih->Required) { ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->selisih->caption(), $detailpenyesuaianpoin_edit->selisih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_selisih");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_edit->selisih->errorMessage()) ?>");
			<?php if ($detailpenyesuaianpoin_edit->tipe->Required) { ?>
				elm = this.getElements("x" + infix + "_tipe");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->tipe->caption(), $detailpenyesuaianpoin_edit->tipe->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenyesuaianpoin_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenyesuaianpoin_edit->keterangan->caption(), $detailpenyesuaianpoin_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenyesuaianpoin_edit->keterangan->errorMessage()) ?>");

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
	fdetailpenyesuaianpoinedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpenyesuaianpoinedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdetailpenyesuaianpoinedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpenyesuaianpoin_edit->showPageHeader(); ?>
<?php
$detailpenyesuaianpoin_edit->showMessage();
?>
<form name="fdetailpenyesuaianpoinedit" id="fdetailpenyesuaianpoinedit" class="<?php echo $detailpenyesuaianpoin_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianpoin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$detailpenyesuaianpoin_edit->IsModal ?>">
<?php if ($detailpenyesuaianpoin->getCurrentMasterTable() == "penyesuaian_poin") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="penyesuaian_poin">
<input type="hidden" name="fk_id_penyesuaian_poin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
	<div id="r_pid_penyesuaianpoin" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin" for="x_pid_penyesuaianpoin" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->caption() ?><?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->cellAttributes() ?>>
<?php if ($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->getSessionValue() != "") { ?>
<span id="el_detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid_penyesuaianpoin" name="x_pid_penyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailpenyesuaianpoin_pid_penyesuaianpoin">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_pid_penyesuaianpoin" name="x_pid_penyesuaianpoin" id="x_pid_penyesuaianpoin" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->pid_penyesuaianpoin->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailpenyesuaianpoin_edit->pid_penyesuaianpoin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianpoin_edit->id_member->Visible) { // id_member ?>
	<div id="r_id_member" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_id_member" for="x_id_member" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->id_member->caption() ?><?php echo $detailpenyesuaianpoin_edit->id_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->id_member->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_id_member">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_id_member" name="x_id_member" id="x_id_member" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->id_member->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->id_member->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->id_member->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianpoin_edit->id_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianpoin_edit->poin_database->Visible) { // poin_database ?>
	<div id="r_poin_database" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_poin_database" for="x_poin_database" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->poin_database->caption() ?><?php echo $detailpenyesuaianpoin_edit->poin_database->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->poin_database->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_poin_database">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_database" name="x_poin_database" id="x_poin_database" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->poin_database->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->poin_database->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->poin_database->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianpoin_edit->poin_database->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianpoin_edit->poin_lapangan->Visible) { // poin_lapangan ?>
	<div id="r_poin_lapangan" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_poin_lapangan" for="x_poin_lapangan" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->poin_lapangan->caption() ?><?php echo $detailpenyesuaianpoin_edit->poin_lapangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->poin_lapangan->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_poin_lapangan">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_poin_lapangan" name="x_poin_lapangan" id="x_poin_lapangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->poin_lapangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->poin_lapangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->poin_lapangan->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianpoin_edit->poin_lapangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianpoin_edit->selisih->Visible) { // selisih ?>
	<div id="r_selisih" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_selisih" for="x_selisih" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->selisih->caption() ?><?php echo $detailpenyesuaianpoin_edit->selisih->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->selisih->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_selisih">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_selisih" name="x_selisih" id="x_selisih" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->selisih->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->selisih->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->selisih->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianpoin_edit->selisih->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianpoin_edit->tipe->Visible) { // tipe ?>
	<div id="r_tipe" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_tipe" for="x_tipe" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->tipe->caption() ?><?php echo $detailpenyesuaianpoin_edit->tipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->tipe->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_tipe">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_tipe" name="x_tipe" id="x_tipe" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->tipe->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->tipe->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->tipe->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianpoin_edit->tipe->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenyesuaianpoin_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_detailpenyesuaianpoin_keterangan" for="x_keterangan" class="<?php echo $detailpenyesuaianpoin_edit->LeftColumnClass ?>"><?php echo $detailpenyesuaianpoin_edit->keterangan->caption() ?><?php echo $detailpenyesuaianpoin_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenyesuaianpoin_edit->RightColumnClass ?>"><div <?php echo $detailpenyesuaianpoin_edit->keterangan->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_keterangan">
<input type="text" data-table="detailpenyesuaianpoin" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->keterangan->getPlaceHolder()) ?>" value="<?php echo $detailpenyesuaianpoin_edit->keterangan->EditValue ?>"<?php echo $detailpenyesuaianpoin_edit->keterangan->editAttributes() ?>>
</span>
<?php echo $detailpenyesuaianpoin_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="detailpenyesuaianpoin" data-field="x_id_detailpenyesuaianpoin" name="x_id_detailpenyesuaianpoin" id="x_id_detailpenyesuaianpoin" value="<?php echo HtmlEncode($detailpenyesuaianpoin_edit->id_detailpenyesuaianpoin->CurrentValue) ?>">
<?php if (!$detailpenyesuaianpoin_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpenyesuaianpoin_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpenyesuaianpoin_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpenyesuaianpoin_edit->showPageFooter();
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
$detailpenyesuaianpoin_edit->terminate();
?>