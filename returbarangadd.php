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
$returbarang_add = new returbarang_add();

// Run the page
$returbarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$returbarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freturbarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	freturbarangadd = currentForm = new ew.Form("freturbarangadd", "add");

	// Validate form
	freturbarangadd.validate = function() {
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
			<?php if ($returbarang_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_add->id_klinik->caption(), $returbarang_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_add->id_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_id_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_add->id_supplier->caption(), $returbarang_add->id_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_add->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_add->id_pegawai->caption(), $returbarang_add->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($returbarang_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_add->tanggal->caption(), $returbarang_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($returbarang_add->tanggal->errorMessage()) ?>");
			<?php if ($returbarang_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $returbarang_add->keterangan->caption(), $returbarang_add->keterangan->RequiredErrorMessage)) ?>");
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
	freturbarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	freturbarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	freturbarangadd.lists["x_id_klinik"] = <?php echo $returbarang_add->id_klinik->Lookup->toClientList($returbarang_add) ?>;
	freturbarangadd.lists["x_id_klinik"].options = <?php echo JsonEncode($returbarang_add->id_klinik->lookupOptions()) ?>;
	freturbarangadd.lists["x_id_supplier"] = <?php echo $returbarang_add->id_supplier->Lookup->toClientList($returbarang_add) ?>;
	freturbarangadd.lists["x_id_supplier"].options = <?php echo JsonEncode($returbarang_add->id_supplier->lookupOptions()) ?>;
	freturbarangadd.lists["x_id_pegawai"] = <?php echo $returbarang_add->id_pegawai->Lookup->toClientList($returbarang_add) ?>;
	freturbarangadd.lists["x_id_pegawai"].options = <?php echo JsonEncode($returbarang_add->id_pegawai->lookupOptions()) ?>;
	loadjs.done("freturbarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $returbarang_add->showPageHeader(); ?>
<?php
$returbarang_add->showMessage();
?>
<form name="freturbarangadd" id="freturbarangadd" class="<?php echo $returbarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="returbarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$returbarang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($returbarang_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_returbarang_id_klinik" for="x_id_klinik" class="<?php echo $returbarang_add->LeftColumnClass ?>"><?php echo $returbarang_add->id_klinik->caption() ?><?php echo $returbarang_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_add->RightColumnClass ?>"><div <?php echo $returbarang_add->id_klinik->cellAttributes() ?>>
<span id="el_returbarang_id_klinik">
<?php $returbarang_add->id_klinik->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="returbarang" data-field="x_id_klinik" data-value-separator="<?php echo $returbarang_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $returbarang_add->id_klinik->editAttributes() ?>>
			<?php echo $returbarang_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $returbarang_add->id_klinik->Lookup->getParamTag($returbarang_add, "p_x_id_klinik") ?>
</span>
<?php echo $returbarang_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_add->id_supplier->Visible) { // id_supplier ?>
	<div id="r_id_supplier" class="form-group row">
		<label id="elh_returbarang_id_supplier" for="x_id_supplier" class="<?php echo $returbarang_add->LeftColumnClass ?>"><?php echo $returbarang_add->id_supplier->caption() ?><?php echo $returbarang_add->id_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_add->RightColumnClass ?>"><div <?php echo $returbarang_add->id_supplier->cellAttributes() ?>>
<span id="el_returbarang_id_supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="returbarang" data-field="x_id_supplier" data-value-separator="<?php echo $returbarang_add->id_supplier->displayValueSeparatorAttribute() ?>" id="x_id_supplier" name="x_id_supplier"<?php echo $returbarang_add->id_supplier->editAttributes() ?>>
			<?php echo $returbarang_add->id_supplier->selectOptionListHtml("x_id_supplier") ?>
		</select>
</div>
<?php echo $returbarang_add->id_supplier->Lookup->getParamTag($returbarang_add, "p_x_id_supplier") ?>
</span>
<?php echo $returbarang_add->id_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_add->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_returbarang_id_pegawai" for="x_id_pegawai" class="<?php echo $returbarang_add->LeftColumnClass ?>"><?php echo $returbarang_add->id_pegawai->caption() ?><?php echo $returbarang_add->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_add->RightColumnClass ?>"><div <?php echo $returbarang_add->id_pegawai->cellAttributes() ?>>
<span id="el_returbarang_id_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="returbarang" data-field="x_id_pegawai" data-value-separator="<?php echo $returbarang_add->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $returbarang_add->id_pegawai->editAttributes() ?>>
			<?php echo $returbarang_add->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $returbarang_add->id_pegawai->Lookup->getParamTag($returbarang_add, "p_x_id_pegawai") ?>
</span>
<?php echo $returbarang_add->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_returbarang_tanggal" for="x_tanggal" class="<?php echo $returbarang_add->LeftColumnClass ?>"><?php echo $returbarang_add->tanggal->caption() ?><?php echo $returbarang_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_add->RightColumnClass ?>"><div <?php echo $returbarang_add->tanggal->cellAttributes() ?>>
<span id="el_returbarang_tanggal">
<input type="text" data-table="returbarang" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="10" placeholder="<?php echo HtmlEncode($returbarang_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $returbarang_add->tanggal->EditValue ?>"<?php echo $returbarang_add->tanggal->editAttributes() ?>>
<?php if (!$returbarang_add->tanggal->ReadOnly && !$returbarang_add->tanggal->Disabled && !isset($returbarang_add->tanggal->EditAttrs["readonly"]) && !isset($returbarang_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freturbarangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("freturbarangadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $returbarang_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($returbarang_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_returbarang_keterangan" for="x_keterangan" class="<?php echo $returbarang_add->LeftColumnClass ?>"><?php echo $returbarang_add->keterangan->caption() ?><?php echo $returbarang_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $returbarang_add->RightColumnClass ?>"><div <?php echo $returbarang_add->keterangan->cellAttributes() ?>>
<span id="el_returbarang_keterangan">
<textarea data-table="returbarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($returbarang_add->keterangan->getPlaceHolder()) ?>"<?php echo $returbarang_add->keterangan->editAttributes() ?>><?php echo $returbarang_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $returbarang_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailretur", explode(",", $returbarang->getCurrentDetailTable())) && $detailretur->DetailAdd) {
?>
<?php if ($returbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailretur", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailreturgrid.php" ?>
<?php } ?>
<?php if (!$returbarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $returbarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $returbarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$returbarang_add->showPageFooter();
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
$returbarang_add->terminate();
?>