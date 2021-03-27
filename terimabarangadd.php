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
$terimabarang_add = new terimabarang_add();

// Run the page
$terimabarang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimabarang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fterimabarangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fterimabarangadd = currentForm = new ew.Form("fterimabarangadd", "add");

	// Validate form
	fterimabarangadd.validate = function() {
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
			<?php if ($terimabarang_add->id_kirimbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->id_kirimbarang->caption(), $terimabarang_add->id_kirimbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terimabarang_add->id_po->Required) { ?>
				elm = this.getElements("x" + infix + "_id_po");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->id_po->caption(), $terimabarang_add->id_po->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terimabarang_add->id_supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_id_supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->id_supplier->caption(), $terimabarang_add->id_supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terimabarang_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->id_klinik->caption(), $terimabarang_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terimabarang_add->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->id_pegawai->caption(), $terimabarang_add->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($terimabarang_add->tanggal_terima->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal_terima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->tanggal_terima->caption(), $terimabarang_add->tanggal_terima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal_terima");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($terimabarang_add->tanggal_terima->errorMessage()) ?>");
			<?php if ($terimabarang_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $terimabarang_add->keterangan->caption(), $terimabarang_add->keterangan->RequiredErrorMessage)) ?>");
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
	fterimabarangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fterimabarangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fterimabarangadd.lists["x_id_kirimbarang"] = <?php echo $terimabarang_add->id_kirimbarang->Lookup->toClientList($terimabarang_add) ?>;
	fterimabarangadd.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($terimabarang_add->id_kirimbarang->lookupOptions()) ?>;
	fterimabarangadd.lists["x_id_po"] = <?php echo $terimabarang_add->id_po->Lookup->toClientList($terimabarang_add) ?>;
	fterimabarangadd.lists["x_id_po"].options = <?php echo JsonEncode($terimabarang_add->id_po->lookupOptions()) ?>;
	fterimabarangadd.lists["x_id_supplier"] = <?php echo $terimabarang_add->id_supplier->Lookup->toClientList($terimabarang_add) ?>;
	fterimabarangadd.lists["x_id_supplier"].options = <?php echo JsonEncode($terimabarang_add->id_supplier->lookupOptions()) ?>;
	fterimabarangadd.lists["x_id_klinik"] = <?php echo $terimabarang_add->id_klinik->Lookup->toClientList($terimabarang_add) ?>;
	fterimabarangadd.lists["x_id_klinik"].options = <?php echo JsonEncode($terimabarang_add->id_klinik->lookupOptions()) ?>;
	fterimabarangadd.lists["x_id_pegawai"] = <?php echo $terimabarang_add->id_pegawai->Lookup->toClientList($terimabarang_add) ?>;
	fterimabarangadd.lists["x_id_pegawai"].options = <?php echo JsonEncode($terimabarang_add->id_pegawai->lookupOptions()) ?>;
	loadjs.done("fterimabarangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $terimabarang_add->showPageHeader(); ?>
<?php
$terimabarang_add->showMessage();
?>
<form name="fterimabarangadd" id="fterimabarangadd" class="<?php echo $terimabarang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimabarang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$terimabarang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($terimabarang_add->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<div id="r_id_kirimbarang" class="form-group row">
		<label id="elh_terimabarang_id_kirimbarang" for="x_id_kirimbarang" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->id_kirimbarang->caption() ?><?php echo $terimabarang_add->id_kirimbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->id_kirimbarang->cellAttributes() ?>>
<span id="el_terimabarang_id_kirimbarang">
<?php $terimabarang_add->id_kirimbarang->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimabarang" data-field="x_id_kirimbarang" data-value-separator="<?php echo $terimabarang_add->id_kirimbarang->displayValueSeparatorAttribute() ?>" id="x_id_kirimbarang" name="x_id_kirimbarang"<?php echo $terimabarang_add->id_kirimbarang->editAttributes() ?>>
			<?php echo $terimabarang_add->id_kirimbarang->selectOptionListHtml("x_id_kirimbarang") ?>
		</select>
</div>
<?php echo $terimabarang_add->id_kirimbarang->Lookup->getParamTag($terimabarang_add, "p_x_id_kirimbarang") ?>
</span>
<?php echo $terimabarang_add->id_kirimbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimabarang_add->id_po->Visible) { // id_po ?>
	<div id="r_id_po" class="form-group row">
		<label id="elh_terimabarang_id_po" for="x_id_po" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->id_po->caption() ?><?php echo $terimabarang_add->id_po->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->id_po->cellAttributes() ?>>
<span id="el_terimabarang_id_po">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimabarang" data-field="x_id_po" data-value-separator="<?php echo $terimabarang_add->id_po->displayValueSeparatorAttribute() ?>" id="x_id_po" name="x_id_po"<?php echo $terimabarang_add->id_po->editAttributes() ?>>
			<?php echo $terimabarang_add->id_po->selectOptionListHtml("x_id_po") ?>
		</select>
</div>
<?php echo $terimabarang_add->id_po->Lookup->getParamTag($terimabarang_add, "p_x_id_po") ?>
</span>
<?php echo $terimabarang_add->id_po->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimabarang_add->id_supplier->Visible) { // id_supplier ?>
	<div id="r_id_supplier" class="form-group row">
		<label id="elh_terimabarang_id_supplier" for="x_id_supplier" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->id_supplier->caption() ?><?php echo $terimabarang_add->id_supplier->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->id_supplier->cellAttributes() ?>>
<span id="el_terimabarang_id_supplier">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimabarang" data-field="x_id_supplier" data-value-separator="<?php echo $terimabarang_add->id_supplier->displayValueSeparatorAttribute() ?>" id="x_id_supplier" name="x_id_supplier"<?php echo $terimabarang_add->id_supplier->editAttributes() ?>>
			<?php echo $terimabarang_add->id_supplier->selectOptionListHtml("x_id_supplier") ?>
		</select>
</div>
<?php echo $terimabarang_add->id_supplier->Lookup->getParamTag($terimabarang_add, "p_x_id_supplier") ?>
</span>
<?php echo $terimabarang_add->id_supplier->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimabarang_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_terimabarang_id_klinik" for="x_id_klinik" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->id_klinik->caption() ?><?php echo $terimabarang_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->id_klinik->cellAttributes() ?>>
<span id="el_terimabarang_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimabarang" data-field="x_id_klinik" data-value-separator="<?php echo $terimabarang_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $terimabarang_add->id_klinik->editAttributes() ?>>
			<?php echo $terimabarang_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $terimabarang_add->id_klinik->Lookup->getParamTag($terimabarang_add, "p_x_id_klinik") ?>
</span>
<?php echo $terimabarang_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimabarang_add->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_terimabarang_id_pegawai" for="x_id_pegawai" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->id_pegawai->caption() ?><?php echo $terimabarang_add->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->id_pegawai->cellAttributes() ?>>
<span id="el_terimabarang_id_pegawai">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="terimabarang" data-field="x_id_pegawai" data-value-separator="<?php echo $terimabarang_add->id_pegawai->displayValueSeparatorAttribute() ?>" id="x_id_pegawai" name="x_id_pegawai"<?php echo $terimabarang_add->id_pegawai->editAttributes() ?>>
			<?php echo $terimabarang_add->id_pegawai->selectOptionListHtml("x_id_pegawai") ?>
		</select>
</div>
<?php echo $terimabarang_add->id_pegawai->Lookup->getParamTag($terimabarang_add, "p_x_id_pegawai") ?>
</span>
<?php echo $terimabarang_add->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimabarang_add->tanggal_terima->Visible) { // tanggal_terima ?>
	<div id="r_tanggal_terima" class="form-group row">
		<label id="elh_terimabarang_tanggal_terima" for="x_tanggal_terima" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->tanggal_terima->caption() ?><?php echo $terimabarang_add->tanggal_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->tanggal_terima->cellAttributes() ?>>
<span id="el_terimabarang_tanggal_terima">
<input type="text" data-table="terimabarang" data-field="x_tanggal_terima" name="x_tanggal_terima" id="x_tanggal_terima" maxlength="10" placeholder="<?php echo HtmlEncode($terimabarang_add->tanggal_terima->getPlaceHolder()) ?>" value="<?php echo $terimabarang_add->tanggal_terima->EditValue ?>"<?php echo $terimabarang_add->tanggal_terima->editAttributes() ?>>
<?php if (!$terimabarang_add->tanggal_terima->ReadOnly && !$terimabarang_add->tanggal_terima->Disabled && !isset($terimabarang_add->tanggal_terima->EditAttrs["readonly"]) && !isset($terimabarang_add->tanggal_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fterimabarangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fterimabarangadd", "x_tanggal_terima", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $terimabarang_add->tanggal_terima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($terimabarang_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_terimabarang_keterangan" for="x_keterangan" class="<?php echo $terimabarang_add->LeftColumnClass ?>"><?php echo $terimabarang_add->keterangan->caption() ?><?php echo $terimabarang_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $terimabarang_add->RightColumnClass ?>"><div <?php echo $terimabarang_add->keterangan->cellAttributes() ?>>
<span id="el_terimabarang_keterangan">
<textarea data-table="terimabarang" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($terimabarang_add->keterangan->getPlaceHolder()) ?>"<?php echo $terimabarang_add->keterangan->editAttributes() ?>><?php echo $terimabarang_add->keterangan->EditValue ?></textarea>
</span>
<?php echo $terimabarang_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailterimabarang", explode(",", $terimabarang->getCurrentDetailTable())) && $detailterimabarang->DetailAdd) {
?>
<?php if ($terimabarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailterimabarang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailterimabaranggrid.php" ?>
<?php } ?>
<?php if (!$terimabarang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $terimabarang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $terimabarang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$terimabarang_add->showPageFooter();
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
$terimabarang_add->terminate();
?>