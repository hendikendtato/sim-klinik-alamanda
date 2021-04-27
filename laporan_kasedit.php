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
$laporan_kas_edit = new laporan_kas_edit();

// Run the page
$laporan_kas_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$laporan_kas_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flaporan_kasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	flaporan_kasedit = currentForm = new ew.Form("flaporan_kasedit", "edit");

	// Validate form
	flaporan_kasedit.validate = function() {
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
			<?php if ($laporan_kas_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->id->caption(), $laporan_kas_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($laporan_kas_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->id_klinik->caption(), $laporan_kas_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->id_klinik->errorMessage()) ?>");
			<?php if ($laporan_kas_edit->id_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->id_kas->caption(), $laporan_kas_edit->id_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->id_kas->errorMessage()) ?>");
			<?php if ($laporan_kas_edit->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->jumlah->caption(), $laporan_kas_edit->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->jumlah->errorMessage()) ?>");
			<?php if ($laporan_kas_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->tanggal->caption(), $laporan_kas_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->tanggal->errorMessage()) ?>");
			<?php if ($laporan_kas_edit->kode_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->kode_penjualan->caption(), $laporan_kas_edit->kode_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($laporan_kas_edit->id_mutasi_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_mutasi_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->id_mutasi_kas->caption(), $laporan_kas_edit->id_mutasi_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_mutasi_kas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->id_mutasi_kas->errorMessage()) ?>");
			<?php if ($laporan_kas_edit->saldo_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_saldo_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->saldo_awal->caption(), $laporan_kas_edit->saldo_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_saldo_awal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->saldo_awal->errorMessage()) ?>");
			<?php if ($laporan_kas_edit->sisa_saldo->Required) { ?>
				elm = this.getElements("x" + infix + "_sisa_saldo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $laporan_kas_edit->sisa_saldo->caption(), $laporan_kas_edit->sisa_saldo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sisa_saldo");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($laporan_kas_edit->sisa_saldo->errorMessage()) ?>");

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
	flaporan_kasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flaporan_kasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flaporan_kasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $laporan_kas_edit->showPageHeader(); ?>
<?php
$laporan_kas_edit->showMessage();
?>
<form name="flaporan_kasedit" id="flaporan_kasedit" class="<?php echo $laporan_kas_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="laporan_kas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$laporan_kas_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($laporan_kas_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_laporan_kas_id" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->id->caption() ?><?php echo $laporan_kas_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->id->cellAttributes() ?>>
<span id="el_laporan_kas_id">
<span<?php echo $laporan_kas_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($laporan_kas_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="laporan_kas" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($laporan_kas_edit->id->CurrentValue) ?>">
<?php echo $laporan_kas_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_laporan_kas_id_klinik" for="x_id_klinik" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->id_klinik->caption() ?><?php echo $laporan_kas_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->id_klinik->cellAttributes() ?>>
<span id="el_laporan_kas_id_klinik">
<input type="text" data-table="laporan_kas" data-field="x_id_klinik" name="x_id_klinik" id="x_id_klinik" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($laporan_kas_edit->id_klinik->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->id_klinik->EditValue ?>"<?php echo $laporan_kas_edit->id_klinik->editAttributes() ?>>
</span>
<?php echo $laporan_kas_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label id="elh_laporan_kas_id_kas" for="x_id_kas" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->id_kas->caption() ?><?php echo $laporan_kas_edit->id_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->id_kas->cellAttributes() ?>>
<span id="el_laporan_kas_id_kas">
<input type="text" data-table="laporan_kas" data-field="x_id_kas" name="x_id_kas" id="x_id_kas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($laporan_kas_edit->id_kas->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->id_kas->EditValue ?>"<?php echo $laporan_kas_edit->id_kas->editAttributes() ?>>
</span>
<?php echo $laporan_kas_edit->id_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_laporan_kas_jumlah" for="x_jumlah" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->jumlah->caption() ?><?php echo $laporan_kas_edit->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->jumlah->cellAttributes() ?>>
<span id="el_laporan_kas_jumlah">
<input type="text" data-table="laporan_kas" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($laporan_kas_edit->jumlah->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->jumlah->EditValue ?>"<?php echo $laporan_kas_edit->jumlah->editAttributes() ?>>
</span>
<?php echo $laporan_kas_edit->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_laporan_kas_tanggal" for="x_tanggal" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->tanggal->caption() ?><?php echo $laporan_kas_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->tanggal->cellAttributes() ?>>
<span id="el_laporan_kas_tanggal">
<input type="text" data-table="laporan_kas" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($laporan_kas_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->tanggal->EditValue ?>"<?php echo $laporan_kas_edit->tanggal->editAttributes() ?>>
<?php if (!$laporan_kas_edit->tanggal->ReadOnly && !$laporan_kas_edit->tanggal->Disabled && !isset($laporan_kas_edit->tanggal->EditAttrs["readonly"]) && !isset($laporan_kas_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flaporan_kasedit", "datetimepicker"], function() {
	ew.createDateTimePicker("flaporan_kasedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $laporan_kas_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label id="elh_laporan_kas_kode_penjualan" for="x_kode_penjualan" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->kode_penjualan->caption() ?><?php echo $laporan_kas_edit->kode_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->kode_penjualan->cellAttributes() ?>>
<span id="el_laporan_kas_kode_penjualan">
<textarea data-table="laporan_kas" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($laporan_kas_edit->kode_penjualan->getPlaceHolder()) ?>"<?php echo $laporan_kas_edit->kode_penjualan->editAttributes() ?>><?php echo $laporan_kas_edit->kode_penjualan->EditValue ?></textarea>
</span>
<?php echo $laporan_kas_edit->kode_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->id_mutasi_kas->Visible) { // id_mutasi_kas ?>
	<div id="r_id_mutasi_kas" class="form-group row">
		<label id="elh_laporan_kas_id_mutasi_kas" for="x_id_mutasi_kas" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->id_mutasi_kas->caption() ?><?php echo $laporan_kas_edit->id_mutasi_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->id_mutasi_kas->cellAttributes() ?>>
<span id="el_laporan_kas_id_mutasi_kas">
<input type="text" data-table="laporan_kas" data-field="x_id_mutasi_kas" name="x_id_mutasi_kas" id="x_id_mutasi_kas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($laporan_kas_edit->id_mutasi_kas->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->id_mutasi_kas->EditValue ?>"<?php echo $laporan_kas_edit->id_mutasi_kas->editAttributes() ?>>
</span>
<?php echo $laporan_kas_edit->id_mutasi_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->saldo_awal->Visible) { // saldo_awal ?>
	<div id="r_saldo_awal" class="form-group row">
		<label id="elh_laporan_kas_saldo_awal" for="x_saldo_awal" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->saldo_awal->caption() ?><?php echo $laporan_kas_edit->saldo_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->saldo_awal->cellAttributes() ?>>
<span id="el_laporan_kas_saldo_awal">
<input type="text" data-table="laporan_kas" data-field="x_saldo_awal" name="x_saldo_awal" id="x_saldo_awal" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($laporan_kas_edit->saldo_awal->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->saldo_awal->EditValue ?>"<?php echo $laporan_kas_edit->saldo_awal->editAttributes() ?>>
</span>
<?php echo $laporan_kas_edit->saldo_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($laporan_kas_edit->sisa_saldo->Visible) { // sisa_saldo ?>
	<div id="r_sisa_saldo" class="form-group row">
		<label id="elh_laporan_kas_sisa_saldo" for="x_sisa_saldo" class="<?php echo $laporan_kas_edit->LeftColumnClass ?>"><?php echo $laporan_kas_edit->sisa_saldo->caption() ?><?php echo $laporan_kas_edit->sisa_saldo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $laporan_kas_edit->RightColumnClass ?>"><div <?php echo $laporan_kas_edit->sisa_saldo->cellAttributes() ?>>
<span id="el_laporan_kas_sisa_saldo">
<input type="text" data-table="laporan_kas" data-field="x_sisa_saldo" name="x_sisa_saldo" id="x_sisa_saldo" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($laporan_kas_edit->sisa_saldo->getPlaceHolder()) ?>" value="<?php echo $laporan_kas_edit->sisa_saldo->EditValue ?>"<?php echo $laporan_kas_edit->sisa_saldo->editAttributes() ?>>
</span>
<?php echo $laporan_kas_edit->sisa_saldo->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$laporan_kas_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $laporan_kas_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $laporan_kas_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$laporan_kas_edit->showPageFooter();
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
$laporan_kas_edit->terminate();
?>