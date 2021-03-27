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
$laporan_kas_add = new laporan_kas_add();

// Run the page
$laporan_kas_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_kas_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flaporan_kasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	flaporan_kasadd = currentForm = new ew.Form("flaporan_kasadd", "add");

	// Validate form
	flaporan_kasadd.validate = function() {
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
			<?php if ($laporan_kas_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->id_klinik->caption(), $laporan_kas_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->id_klinik->errorMessage()) ?>");
			<?php if ($laporan_kas_add->id_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->id_kas->caption(), $laporan_kas_add->id_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->id_kas->errorMessage()) ?>");
			<?php if ($laporan_kas_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->jumlah->caption(), $laporan_kas_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->jumlah->errorMessage()) ?>");
			<?php if ($laporan_kas_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->tanggal->caption(), $laporan_kas_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->tanggal->errorMessage()) ?>");
			<?php if ($laporan_kas_add->kode_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->kode_penjualan->caption(), $laporan_kas_add->kode_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($laporan_kas_add->id_mutasi_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_mutasi_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->id_mutasi_kas->caption(), $laporan_kas_add->id_mutasi_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_mutasi_kas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->id_mutasi_kas->errorMessage()) ?>");
			<?php if ($laporan_kas_add->saldo_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->saldo_awal->caption(), $laporan_kas_add->saldo_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo_awal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->saldo_awal->errorMessage()) ?>");
			<?php if ($laporan_kas_add->sisa_saldo->Required) { ?>
				elm = this.getElements("x" + infix + "_sisa_saldo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_add->sisa_saldo->caption(), $laporan_kas_add->sisa_saldo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sisa_saldo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_add->sisa_saldo->errorMessage()) ?>");

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
	flaporan_kasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flaporan_kasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flaporan_kasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $laporan_kas_add->showPageHeader(); ?>
<?php
$laporan_kas_add->showMessage();
?>
<form name="flaporan_kasadd" id="flaporan_kasadd" class="<?php echo $laporan_kas_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_kas">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$laporan_kas_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($laporan_kas_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_laporan_kas_id_klinik" for="x_id_klinik" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->id_klinik->caption() ?><?php echo $laporan_kas_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->id_klinik->cellAttributes() ?>>
<span id="el_laporan_kas_id_klinik">
<input type="text" data-table="laporan_kas" data-field="x_id_klinik" name="x_id_klinik" id="x_id_klinik" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($laporan_kas_add->id_klinik->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->id_klinik->EditValue ?>"<?php echo $laporan_kas_add->id_klinik->editAttributes() ?>>
</span>
<?php echo $laporan_kas_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label id="elh_laporan_kas_id_kas" for="x_id_kas" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->id_kas->caption() ?><?php echo $laporan_kas_add->id_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->id_kas->cellAttributes() ?>>
<span id="el_laporan_kas_id_kas">
<input type="text" data-table="laporan_kas" data-field="x_id_kas" name="x_id_kas" id="x_id_kas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($laporan_kas_add->id_kas->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->id_kas->EditValue ?>"<?php echo $laporan_kas_add->id_kas->editAttributes() ?>>
</span>
<?php echo $laporan_kas_add->id_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_laporan_kas_jumlah" for="x_jumlah" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->jumlah->caption() ?><?php echo $laporan_kas_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->jumlah->cellAttributes() ?>>
<span id="el_laporan_kas_jumlah">
<input type="text" data-table="laporan_kas" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($laporan_kas_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->jumlah->EditValue ?>"<?php echo $laporan_kas_add->jumlah->editAttributes() ?>>
</span>
<?php echo $laporan_kas_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_laporan_kas_tanggal" for="x_tanggal" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->tanggal->caption() ?><?php echo $laporan_kas_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->tanggal->cellAttributes() ?>>
<span id="el_laporan_kas_tanggal">
<input type="text" data-table="laporan_kas" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($laporan_kas_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->tanggal->EditValue ?>"<?php echo $laporan_kas_add->tanggal->editAttributes() ?>>
<?php if (!$laporan_kas_add->tanggal->ReadOnly && !$laporan_kas_add->tanggal->Disabled && !isset($laporan_kas_add->tanggal->EditAttrs["readonly"]) && !isset($laporan_kas_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flaporan_kasadd", "datetimepicker"], function() {
	ew.createDateTimePicker("flaporan_kasadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $laporan_kas_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label id="elh_laporan_kas_kode_penjualan" for="x_kode_penjualan" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->kode_penjualan->caption() ?><?php echo $laporan_kas_add->kode_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->kode_penjualan->cellAttributes() ?>>
<span id="el_laporan_kas_kode_penjualan">
<textarea data-table="laporan_kas" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($laporan_kas_add->kode_penjualan->getPlaceHolder()) ?>"<?php echo $laporan_kas_add->kode_penjualan->editAttributes() ?>><?php echo $laporan_kas_add->kode_penjualan->EditValue ?></textarea>
</span>
<?php echo $laporan_kas_add->kode_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
	<div id="r_id_mutasi_kas" class="form-group row">
		<label id="elh_laporan_kas_id_mutasi_kas" for="x_id_mutasi_kas" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->id_mutasi_kas->caption() ?><?php echo $laporan_kas_add->id_mutasi_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->id_mutasi_kas->cellAttributes() ?>>
<span id="el_laporan_kas_id_mutasi_kas">
<input type="text" data-table="laporan_kas" data-field="x_id_mutasi_kas" name="x_id_mutasi_kas" id="x_id_mutasi_kas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($laporan_kas_add->id_mutasi_kas->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->id_mutasi_kas->EditValue ?>"<?php echo $laporan_kas_add->id_mutasi_kas->editAttributes() ?>>
</span>
<?php echo $laporan_kas_add->id_mutasi_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->saldo_awal->Visible) { // saldo_awal ?>
	<div id="r_saldo_awal" class="form-group row">
		<label id="elh_laporan_kas_saldo_awal" for="x_saldo_awal" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->saldo_awal->caption() ?><?php echo $laporan_kas_add->saldo_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->saldo_awal->cellAttributes() ?>>
<span id="el_laporan_kas_saldo_awal">
<input type="text" data-table="laporan_kas" data-field="x_saldo_awal" name="x_saldo_awal" id="x_saldo_awal" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($laporan_kas_add->saldo_awal->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->saldo_awal->EditValue ?>"<?php echo $laporan_kas_add->saldo_awal->editAttributes() ?>>
</span>
<?php echo $laporan_kas_add->saldo_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_add->sisa_saldo->Visible) { // sisa_saldo ?>
	<div id="r_sisa_saldo" class="form-group row">
		<label id="elh_laporan_kas_sisa_saldo" for="x_sisa_saldo" class="<?php echo $laporan_kas_add->LeftColumnClass ?>"><?php echo $laporan_kas_add->sisa_saldo->caption() ?><?php echo $laporan_kas_add->sisa_saldo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_add->RightColumnClass ?>"><div <?php echo $laporan_kas_add->sisa_saldo->cellAttributes() ?>>
<span id="el_laporan_kas_sisa_saldo">
<input type="text" data-table="laporan_kas" data-field="x_sisa_saldo" name="x_sisa_saldo" id="x_sisa_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($laporan_kas_add->sisa_saldo->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_add->sisa_saldo->EditValue ?>"<?php echo $laporan_kas_add->sisa_saldo->editAttributes() ?>>
</span>
<?php echo $laporan_kas_add->sisa_saldo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$laporan_kas_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $laporan_kas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $laporan_kas_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$laporan_kas_add->showPageFooter();
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
$laporan_kas_add->terminate();
?>