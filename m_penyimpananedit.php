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
$m_penyimpanan_edit = new m_penyimpanan_edit();

// Run the page
$m_penyimpanan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_penyimpanan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_penyimpananedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_penyimpananedit = currentForm = new ew.Form("fm_penyimpananedit", "edit");

	// Validate form
	fm_penyimpananedit.validate = function() {
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
			<?php if ($m_penyimpanan_edit->id_penyimpanan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penyimpanan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_penyimpanan_edit->id_penyimpanan->caption(), $m_penyimpanan_edit->id_penyimpanan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_penyimpanan_edit->nama_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_penyimpanan_edit->nama_barang->caption(), $m_penyimpanan_edit->nama_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_penyimpanan_edit->tanggal_->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_penyimpanan_edit->tanggal_->caption(), $m_penyimpanan_edit->tanggal_->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_penyimpanan_edit->tanggal_->errorMessage()) ?>");
			<?php if ($m_penyimpanan_edit->penyimpanan->Required) { ?>
				elm = this.getElements("x" + infix + "_penyimpanan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_penyimpanan_edit->penyimpanan->caption(), $m_penyimpanan_edit->penyimpanan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_penyimpanan_edit->nomor_laci->Required) { ?>
				elm = this.getElements("x" + infix + "_nomor_laci");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_penyimpanan_edit->nomor_laci->caption(), $m_penyimpanan_edit->nomor_laci->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nomor_laci");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_penyimpanan_edit->nomor_laci->errorMessage()) ?>");
			<?php if ($m_penyimpanan_edit->Stock->Required) { ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_penyimpanan_edit->Stock->caption(), $m_penyimpanan_edit->Stock->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Stock");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_penyimpanan_edit->Stock->errorMessage()) ?>");

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
	fm_penyimpananedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_penyimpananedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_penyimpananedit.lists["x_penyimpanan"] = <?php echo $m_penyimpanan_edit->penyimpanan->Lookup->toClientList($m_penyimpanan_edit) ?>;
	fm_penyimpananedit.lists["x_penyimpanan"].options = <?php echo JsonEncode($m_penyimpanan_edit->penyimpanan->options(FALSE, TRUE)) ?>;
	loadjs.done("fm_penyimpananedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_penyimpanan_edit->showPageHeader(); ?>
<?php
$m_penyimpanan_edit->showMessage();
?>
<form name="fm_penyimpananedit" id="fm_penyimpananedit" class="<?php echo $m_penyimpanan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_penyimpanan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_penyimpanan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_penyimpanan_edit->id_penyimpanan->Visible) { // id_penyimpanan ?>
	<div id="r_id_penyimpanan" class="form-group row">
		<label id="elh_m_penyimpanan_id_penyimpanan" class="<?php echo $m_penyimpanan_edit->LeftColumnClass ?>"><?php echo $m_penyimpanan_edit->id_penyimpanan->caption() ?><?php echo $m_penyimpanan_edit->id_penyimpanan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_penyimpanan_edit->RightColumnClass ?>"><div <?php echo $m_penyimpanan_edit->id_penyimpanan->cellAttributes() ?>>
<span id="el_m_penyimpanan_id_penyimpanan">
<span<?php echo $m_penyimpanan_edit->id_penyimpanan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_penyimpanan_edit->id_penyimpanan->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_penyimpanan" data-field="x_id_penyimpanan" name="x_id_penyimpanan" id="x_id_penyimpanan" value="<?php echo HtmlEncode($m_penyimpanan_edit->id_penyimpanan->CurrentValue) ?>">
<?php echo $m_penyimpanan_edit->id_penyimpanan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_penyimpanan_edit->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_m_penyimpanan_nama_barang" for="x_nama_barang" class="<?php echo $m_penyimpanan_edit->LeftColumnClass ?>"><?php echo $m_penyimpanan_edit->nama_barang->caption() ?><?php echo $m_penyimpanan_edit->nama_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_penyimpanan_edit->RightColumnClass ?>"><div <?php echo $m_penyimpanan_edit->nama_barang->cellAttributes() ?>>
<span id="el_m_penyimpanan_nama_barang">
<input type="text" data-table="m_penyimpanan" data-field="x_nama_barang" name="x_nama_barang" id="x_nama_barang" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($m_penyimpanan_edit->nama_barang->getPlaceHolder()) ?>" value="<?php echo $m_penyimpanan_edit->nama_barang->EditValue ?>"<?php echo $m_penyimpanan_edit->nama_barang->editAttributes() ?>>
</span>
<?php echo $m_penyimpanan_edit->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_penyimpanan_edit->tanggal_->Visible) { // tanggal_ ?>
	<div id="r_tanggal_" class="form-group row">
		<label id="elh_m_penyimpanan_tanggal_" for="x_tanggal_" class="<?php echo $m_penyimpanan_edit->LeftColumnClass ?>"><?php echo $m_penyimpanan_edit->tanggal_->caption() ?><?php echo $m_penyimpanan_edit->tanggal_->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_penyimpanan_edit->RightColumnClass ?>"><div <?php echo $m_penyimpanan_edit->tanggal_->cellAttributes() ?>>
<span id="el_m_penyimpanan_tanggal_">
<input type="text" data-table="m_penyimpanan" data-field="x_tanggal_" name="x_tanggal_" id="x_tanggal_" maxlength="10" placeholder="<?php echo HtmlEncode($m_penyimpanan_edit->tanggal_->getPlaceHolder()) ?>" value="<?php echo $m_penyimpanan_edit->tanggal_->EditValue ?>"<?php echo $m_penyimpanan_edit->tanggal_->editAttributes() ?>>
<?php if (!$m_penyimpanan_edit->tanggal_->ReadOnly && !$m_penyimpanan_edit->tanggal_->Disabled && !isset($m_penyimpanan_edit->tanggal_->EditAttrs["readonly"]) && !isset($m_penyimpanan_edit->tanggal_->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_penyimpananedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_penyimpananedit", "x_tanggal_", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_penyimpanan_edit->tanggal_->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_penyimpanan_edit->penyimpanan->Visible) { // penyimpanan ?>
	<div id="r_penyimpanan" class="form-group row">
		<label id="elh_m_penyimpanan_penyimpanan" for="x_penyimpanan" class="<?php echo $m_penyimpanan_edit->LeftColumnClass ?>"><?php echo $m_penyimpanan_edit->penyimpanan->caption() ?><?php echo $m_penyimpanan_edit->penyimpanan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_penyimpanan_edit->RightColumnClass ?>"><div <?php echo $m_penyimpanan_edit->penyimpanan->cellAttributes() ?>>
<span id="el_m_penyimpanan_penyimpanan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_penyimpanan" data-field="x_penyimpanan" data-value-separator="<?php echo $m_penyimpanan_edit->penyimpanan->displayValueSeparatorAttribute() ?>" id="x_penyimpanan" name="x_penyimpanan"<?php echo $m_penyimpanan_edit->penyimpanan->editAttributes() ?>>
			<?php echo $m_penyimpanan_edit->penyimpanan->selectOptionListHtml("x_penyimpanan") ?>
		</select>
</div>
</span>
<?php echo $m_penyimpanan_edit->penyimpanan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_penyimpanan_edit->nomor_laci->Visible) { // nomor_laci ?>
	<div id="r_nomor_laci" class="form-group row">
		<label id="elh_m_penyimpanan_nomor_laci" for="x_nomor_laci" class="<?php echo $m_penyimpanan_edit->LeftColumnClass ?>"><?php echo $m_penyimpanan_edit->nomor_laci->caption() ?><?php echo $m_penyimpanan_edit->nomor_laci->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_penyimpanan_edit->RightColumnClass ?>"><div <?php echo $m_penyimpanan_edit->nomor_laci->cellAttributes() ?>>
<span id="el_m_penyimpanan_nomor_laci">
<input type="text" data-table="m_penyimpanan" data-field="x_nomor_laci" name="x_nomor_laci" id="x_nomor_laci" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_penyimpanan_edit->nomor_laci->getPlaceHolder()) ?>" value="<?php echo $m_penyimpanan_edit->nomor_laci->EditValue ?>"<?php echo $m_penyimpanan_edit->nomor_laci->editAttributes() ?>>
</span>
<?php echo $m_penyimpanan_edit->nomor_laci->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_penyimpanan_edit->Stock->Visible) { // Stock ?>
	<div id="r_Stock" class="form-group row">
		<label id="elh_m_penyimpanan_Stock" for="x_Stock" class="<?php echo $m_penyimpanan_edit->LeftColumnClass ?>"><?php echo $m_penyimpanan_edit->Stock->caption() ?><?php echo $m_penyimpanan_edit->Stock->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_penyimpanan_edit->RightColumnClass ?>"><div <?php echo $m_penyimpanan_edit->Stock->cellAttributes() ?>>
<span id="el_m_penyimpanan_Stock">
<input type="text" data-table="m_penyimpanan" data-field="x_Stock" name="x_Stock" id="x_Stock" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_penyimpanan_edit->Stock->getPlaceHolder()) ?>" value="<?php echo $m_penyimpanan_edit->Stock->EditValue ?>"<?php echo $m_penyimpanan_edit->Stock->editAttributes() ?>>
</span>
<?php echo $m_penyimpanan_edit->Stock->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_penyimpanan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_penyimpanan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_penyimpanan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_penyimpanan_edit->showPageFooter();
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
$m_penyimpanan_edit->terminate();
?>