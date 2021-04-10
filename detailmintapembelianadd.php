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
$detailmintapembelian_add = new detailmintapembelian_add();

// Run the page
$detailmintapembelian_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmintapembelian_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailmintapembelianadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailmintapembelianadd = currentForm = new ew.Form("fdetailmintapembelianadd", "add");

	// Validate form
	fdetailmintapembelianadd.validate = function() {
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
			<?php if ($detailmintapembelian_add->pid_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_pid_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->pid_pp->caption(), $detailmintapembelian_add->pid_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid_pp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_add->pid_pp->errorMessage()) ?>");
			<?php if ($detailmintapembelian_add->idbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_idbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->idbarang->caption(), $detailmintapembelian_add->idbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_add->part->Required) { ?>
				elm = this.getElements("x" + infix + "_part");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->part->caption(), $detailmintapembelian_add->part->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_add->lot->Required) { ?>
				elm = this.getElements("x" + infix + "_lot");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->lot->caption(), $detailmintapembelian_add->lot->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_add->qty_pp->Required) { ?>
				elm = this.getElements("x" + infix + "_qty_pp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->qty_pp->caption(), $detailmintapembelian_add->qty_pp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty_pp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_add->qty_pp->errorMessage()) ?>");
			<?php if ($detailmintapembelian_add->qty_acc->Required) { ?>
				elm = this.getElements("x" + infix + "_qty_acc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->qty_acc->caption(), $detailmintapembelian_add->qty_acc->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty_acc");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_add->qty_acc->errorMessage()) ?>");
			<?php if ($detailmintapembelian_add->id_satuan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_satuan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->id_satuan->caption(), $detailmintapembelian_add->id_satuan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailmintapembelian_add->harga->Required) { ?>
				elm = this.getElements("x" + infix + "_harga");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->harga->caption(), $detailmintapembelian_add->harga->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_add->harga->errorMessage()) ?>");
			<?php if ($detailmintapembelian_add->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailmintapembelian_add->total->caption(), $detailmintapembelian_add->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailmintapembelian_add->total->errorMessage()) ?>");

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
	fdetailmintapembelianadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailmintapembelianadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailmintapembelianadd.lists["x_idbarang"] = <?php echo $detailmintapembelian_add->idbarang->Lookup->toClientList($detailmintapembelian_add) ?>;
	fdetailmintapembelianadd.lists["x_idbarang"].options = <?php echo JsonEncode($detailmintapembelian_add->idbarang->lookupOptions()) ?>;
	fdetailmintapembelianadd.lists["x_id_satuan"] = <?php echo $detailmintapembelian_add->id_satuan->Lookup->toClientList($detailmintapembelian_add) ?>;
	fdetailmintapembelianadd.lists["x_id_satuan"].options = <?php echo JsonEncode($detailmintapembelian_add->id_satuan->lookupOptions()) ?>;
	loadjs.done("fdetailmintapembelianadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailmintapembelian_add->showPageHeader(); ?>
<?php
$detailmintapembelian_add->showMessage();
?>
<form name="fdetailmintapembelianadd" id="fdetailmintapembelianadd" class="<?php echo $detailmintapembelian_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmintapembelian">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailmintapembelian_add->IsModal ?>">
<?php if ($detailmintapembelian->getCurrentMasterTable() == "permintaanpembelian") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="permintaanpembelian">
<input type="hidden" name="fk_id_pp" value="<?php echo HtmlEncode($detailmintapembelian_add->pid_pp->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailmintapembelian_add->pid_pp->Visible) { // pid_pp ?>
	<div id="r_pid_pp" class="form-group row">
		<label id="elh_detailmintapembelian_pid_pp" for="x_pid_pp" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->pid_pp->caption() ?><?php echo $detailmintapembelian_add->pid_pp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->pid_pp->cellAttributes() ?>>
<?php if ($detailmintapembelian_add->pid_pp->getSessionValue() != "") { ?>
<span id="el_detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_add->pid_pp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailmintapembelian_add->pid_pp->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_pid_pp" name="x_pid_pp" value="<?php echo HtmlEncode($detailmintapembelian_add->pid_pp->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailmintapembelian_pid_pp">
<input type="text" data-table="detailmintapembelian" data-field="x_pid_pp" name="x_pid_pp" id="x_pid_pp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->pid_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->pid_pp->EditValue ?>"<?php echo $detailmintapembelian_add->pid_pp->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $detailmintapembelian_add->pid_pp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->idbarang->Visible) { // idbarang ?>
	<div id="r_idbarang" class="form-group row">
		<label id="elh_detailmintapembelian_idbarang" for="x_idbarang" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->idbarang->caption() ?><?php echo $detailmintapembelian_add->idbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->idbarang->cellAttributes() ?>>
<span id="el_detailmintapembelian_idbarang">
<?php $detailmintapembelian_add->idbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_idbarang" data-value-separator="<?php echo $detailmintapembelian_add->idbarang->displayValueSeparatorAttribute() ?>" id="x_idbarang" name="x_idbarang" size="40"<?php echo $detailmintapembelian_add->idbarang->editAttributes() ?>>
			<?php echo $detailmintapembelian_add->idbarang->selectOptionListHtml("x_idbarang") ?>
		</select>
</div>
<?php echo $detailmintapembelian_add->idbarang->Lookup->getParamTag($detailmintapembelian_add, "p_x_idbarang") ?>
</span>
<?php echo $detailmintapembelian_add->idbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->part->Visible) { // part ?>
	<div id="r_part" class="form-group row">
		<label id="elh_detailmintapembelian_part" for="x_part" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->part->caption() ?><?php echo $detailmintapembelian_add->part->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->part->cellAttributes() ?>>
<span id="el_detailmintapembelian_part">
<input type="text" data-table="detailmintapembelian" data-field="x_part" name="x_part" id="x_part" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->part->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->part->EditValue ?>"<?php echo $detailmintapembelian_add->part->editAttributes() ?>>
</span>
<?php echo $detailmintapembelian_add->part->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->lot->Visible) { // lot ?>
	<div id="r_lot" class="form-group row">
		<label id="elh_detailmintapembelian_lot" for="x_lot" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->lot->caption() ?><?php echo $detailmintapembelian_add->lot->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->lot->cellAttributes() ?>>
<span id="el_detailmintapembelian_lot">
<input type="text" data-table="detailmintapembelian" data-field="x_lot" name="x_lot" id="x_lot" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->lot->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->lot->EditValue ?>"<?php echo $detailmintapembelian_add->lot->editAttributes() ?>>
</span>
<?php echo $detailmintapembelian_add->lot->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->qty_pp->Visible) { // qty_pp ?>
	<div id="r_qty_pp" class="form-group row">
		<label id="elh_detailmintapembelian_qty_pp" for="x_qty_pp" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->qty_pp->caption() ?><?php echo $detailmintapembelian_add->qty_pp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->qty_pp->cellAttributes() ?>>
<span id="el_detailmintapembelian_qty_pp">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_pp" name="x_qty_pp" id="x_qty_pp" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->qty_pp->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->qty_pp->EditValue ?>"<?php echo $detailmintapembelian_add->qty_pp->editAttributes() ?>>
</span>
<?php echo $detailmintapembelian_add->qty_pp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->qty_acc->Visible) { // qty_acc ?>
	<div id="r_qty_acc" class="form-group row">
		<label id="elh_detailmintapembelian_qty_acc" for="x_qty_acc" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->qty_acc->caption() ?><?php echo $detailmintapembelian_add->qty_acc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->qty_acc->cellAttributes() ?>>
<span id="el_detailmintapembelian_qty_acc">
<input type="text" data-table="detailmintapembelian" data-field="x_qty_acc" name="x_qty_acc" id="x_qty_acc" size="3" maxlength="11" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->qty_acc->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->qty_acc->EditValue ?>"<?php echo $detailmintapembelian_add->qty_acc->editAttributes() ?>>
</span>
<?php echo $detailmintapembelian_add->qty_acc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->id_satuan->Visible) { // id_satuan ?>
	<div id="r_id_satuan" class="form-group row">
		<label id="elh_detailmintapembelian_id_satuan" for="x_id_satuan" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->id_satuan->caption() ?><?php echo $detailmintapembelian_add->id_satuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->id_satuan->cellAttributes() ?>>
<span id="el_detailmintapembelian_id_satuan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailmintapembelian" data-field="x_id_satuan" data-value-separator="<?php echo $detailmintapembelian_add->id_satuan->displayValueSeparatorAttribute() ?>" id="x_id_satuan" name="x_id_satuan"<?php echo $detailmintapembelian_add->id_satuan->editAttributes() ?>>
			<?php echo $detailmintapembelian_add->id_satuan->selectOptionListHtml("x_id_satuan") ?>
		</select>
</div>
<?php echo $detailmintapembelian_add->id_satuan->Lookup->getParamTag($detailmintapembelian_add, "p_x_id_satuan") ?>
</span>
<?php echo $detailmintapembelian_add->id_satuan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->harga->Visible) { // harga ?>
	<div id="r_harga" class="form-group row">
		<label id="elh_detailmintapembelian_harga" for="x_harga" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->harga->caption() ?><?php echo $detailmintapembelian_add->harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->harga->cellAttributes() ?>>
<span id="el_detailmintapembelian_harga">
<input type="text" data-table="detailmintapembelian" data-field="x_harga" name="x_harga" id="x_harga" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->harga->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->harga->EditValue ?>"<?php echo $detailmintapembelian_add->harga->editAttributes() ?>>
</span>
<?php echo $detailmintapembelian_add->harga->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailmintapembelian_add->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_detailmintapembelian_total" for="x_total" class="<?php echo $detailmintapembelian_add->LeftColumnClass ?>"><?php echo $detailmintapembelian_add->total->caption() ?><?php echo $detailmintapembelian_add->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailmintapembelian_add->RightColumnClass ?>"><div <?php echo $detailmintapembelian_add->total->cellAttributes() ?>>
<span id="el_detailmintapembelian_total">
<input type="text" data-table="detailmintapembelian" data-field="x_total" name="x_total" id="x_total" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($detailmintapembelian_add->total->getPlaceHolder()) ?>" value="<?php echo $detailmintapembelian_add->total->EditValue ?>"<?php echo $detailmintapembelian_add->total->editAttributes() ?>>
</span>
<?php echo $detailmintapembelian_add->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailmintapembelian_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailmintapembelian_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailmintapembelian_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailmintapembelian_add->showPageFooter();
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
$detailmintapembelian_add->terminate();
?>