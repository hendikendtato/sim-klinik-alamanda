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
$rekapstok_add = new rekapstok_add();

// Run the page
$rekapstok_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekapstok_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frekapstokadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	frekapstokadd = currentForm = new ew.Form("frekapstokadd", "add");

	// Validate form
	frekapstokadd.validate = function() {
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
			<?php if ($rekapstok_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->id_barang->caption(), $rekapstok_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->id_barang->errorMessage()) ?>");
			<?php if ($rekapstok_add->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->tanggal->caption(), $rekapstok_add->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->tanggal->errorMessage()) ?>");
			<?php if ($rekapstok_add->masuk_saldoawal->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk_saldoawal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->masuk_saldoawal->caption(), $rekapstok_add->masuk_saldoawal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk_saldoawal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->masuk_saldoawal->errorMessage()) ?>");
			<?php if ($rekapstok_add->masuk_beli->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk_beli");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->masuk_beli->caption(), $rekapstok_add->masuk_beli->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk_beli");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->masuk_beli->errorMessage()) ?>");
			<?php if ($rekapstok_add->masuk_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->masuk_penyesuaian->caption(), $rekapstok_add->masuk_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->masuk_penyesuaian->errorMessage()) ?>");
			<?php if ($rekapstok_add->keluar_jual->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_jual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->keluar_jual->caption(), $rekapstok_add->keluar_jual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_jual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->keluar_jual->errorMessage()) ?>");
			<?php if ($rekapstok_add->keluar_perpindahan->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_perpindahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->keluar_perpindahan->caption(), $rekapstok_add->keluar_perpindahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_perpindahan");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->keluar_perpindahan->errorMessage()) ?>");
			<?php if ($rekapstok_add->keluar_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->keluar_penyesuaian->caption(), $rekapstok_add->keluar_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->keluar_penyesuaian->errorMessage()) ?>");
			<?php if ($rekapstok_add->keluar_pengembalian->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_pengembalian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->keluar_pengembalian->caption(), $rekapstok_add->keluar_pengembalian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_pengembalian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->keluar_pengembalian->errorMessage()) ?>");
			<?php if ($rekapstok_add->stok->Required) { ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $rekapstok_add->stok->caption(), $rekapstok_add->stok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($rekapstok_add->stok->errorMessage()) ?>");

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
	frekapstokadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frekapstokadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	frekapstokadd.lists["x_id_barang"] = <?php echo $rekapstok_add->id_barang->Lookup->toClientList($rekapstok_add) ?>;
	frekapstokadd.lists["x_id_barang"].options = <?php echo JsonEncode($rekapstok_add->id_barang->lookupOptions()) ?>;
	frekapstokadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("frekapstokadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $rekapstok_add->showPageHeader(); ?>
<?php
$rekapstok_add->showMessage();
?>
<form name="frekapstokadd" id="frekapstokadd" class="<?php echo $rekapstok_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekapstok">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$rekapstok_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($rekapstok_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_rekapstok_id_barang" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->id_barang->caption() ?><?php echo $rekapstok_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->id_barang->cellAttributes() ?>>
<span id="el_rekapstok_id_barang">
<?php
$onchange = $rekapstok_add->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$rekapstok_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($rekapstok_add->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($rekapstok_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($rekapstok_add->id_barang->getPlaceHolder()) ?>"<?php echo $rekapstok_add->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($rekapstok_add->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($rekapstok_add->id_barang->ReadOnly || $rekapstok_add->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="rekapstok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $rekapstok_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($rekapstok_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["frekapstokadd"], function() {
	frekapstokadd.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $rekapstok_add->id_barang->Lookup->getParamTag($rekapstok_add, "p_x_id_barang") ?>
</span>
<?php echo $rekapstok_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_rekapstok_tanggal" for="x_tanggal" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->tanggal->caption() ?><?php echo $rekapstok_add->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->tanggal->cellAttributes() ?>>
<span id="el_rekapstok_tanggal">
<input type="text" data-table="rekapstok" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($rekapstok_add->tanggal->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->tanggal->EditValue ?>"<?php echo $rekapstok_add->tanggal->editAttributes() ?>>
<?php if (!$rekapstok_add->tanggal->ReadOnly && !$rekapstok_add->tanggal->Disabled && !isset($rekapstok_add->tanggal->EditAttrs["readonly"]) && !isset($rekapstok_add->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["frekapstokadd", "datetimepicker"], function() {
	ew.createDateTimePicker("frekapstokadd", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $rekapstok_add->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->masuk_saldoawal->Visible) { // masuk_saldoawal ?>
	<div id="r_masuk_saldoawal" class="form-group row">
		<label id="elh_rekapstok_masuk_saldoawal" for="x_masuk_saldoawal" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->masuk_saldoawal->caption() ?><?php echo $rekapstok_add->masuk_saldoawal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->masuk_saldoawal->cellAttributes() ?>>
<span id="el_rekapstok_masuk_saldoawal">
<input type="text" data-table="rekapstok" data-field="x_masuk_saldoawal" name="x_masuk_saldoawal" id="x_masuk_saldoawal" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->masuk_saldoawal->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->masuk_saldoawal->EditValue ?>"<?php echo $rekapstok_add->masuk_saldoawal->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->masuk_saldoawal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->masuk_beli->Visible) { // masuk_beli ?>
	<div id="r_masuk_beli" class="form-group row">
		<label id="elh_rekapstok_masuk_beli" for="x_masuk_beli" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->masuk_beli->caption() ?><?php echo $rekapstok_add->masuk_beli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->masuk_beli->cellAttributes() ?>>
<span id="el_rekapstok_masuk_beli">
<input type="text" data-table="rekapstok" data-field="x_masuk_beli" name="x_masuk_beli" id="x_masuk_beli" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->masuk_beli->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->masuk_beli->EditValue ?>"<?php echo $rekapstok_add->masuk_beli->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->masuk_beli->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<div id="r_masuk_penyesuaian" class="form-group row">
		<label id="elh_rekapstok_masuk_penyesuaian" for="x_masuk_penyesuaian" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->masuk_penyesuaian->caption() ?><?php echo $rekapstok_add->masuk_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->masuk_penyesuaian->cellAttributes() ?>>
<span id="el_rekapstok_masuk_penyesuaian">
<input type="text" data-table="rekapstok" data-field="x_masuk_penyesuaian" name="x_masuk_penyesuaian" id="x_masuk_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->masuk_penyesuaian->EditValue ?>"<?php echo $rekapstok_add->masuk_penyesuaian->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->masuk_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->keluar_jual->Visible) { // keluar_jual ?>
	<div id="r_keluar_jual" class="form-group row">
		<label id="elh_rekapstok_keluar_jual" for="x_keluar_jual" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->keluar_jual->caption() ?><?php echo $rekapstok_add->keluar_jual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->keluar_jual->cellAttributes() ?>>
<span id="el_rekapstok_keluar_jual">
<input type="text" data-table="rekapstok" data-field="x_keluar_jual" name="x_keluar_jual" id="x_keluar_jual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->keluar_jual->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->keluar_jual->EditValue ?>"<?php echo $rekapstok_add->keluar_jual->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->keluar_jual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->keluar_perpindahan->Visible) { // keluar_perpindahan ?>
	<div id="r_keluar_perpindahan" class="form-group row">
		<label id="elh_rekapstok_keluar_perpindahan" for="x_keluar_perpindahan" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->keluar_perpindahan->caption() ?><?php echo $rekapstok_add->keluar_perpindahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->keluar_perpindahan->cellAttributes() ?>>
<span id="el_rekapstok_keluar_perpindahan">
<input type="text" data-table="rekapstok" data-field="x_keluar_perpindahan" name="x_keluar_perpindahan" id="x_keluar_perpindahan" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->keluar_perpindahan->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->keluar_perpindahan->EditValue ?>"<?php echo $rekapstok_add->keluar_perpindahan->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->keluar_perpindahan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<div id="r_keluar_penyesuaian" class="form-group row">
		<label id="elh_rekapstok_keluar_penyesuaian" for="x_keluar_penyesuaian" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->keluar_penyesuaian->caption() ?><?php echo $rekapstok_add->keluar_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->keluar_penyesuaian->cellAttributes() ?>>
<span id="el_rekapstok_keluar_penyesuaian">
<input type="text" data-table="rekapstok" data-field="x_keluar_penyesuaian" name="x_keluar_penyesuaian" id="x_keluar_penyesuaian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->keluar_penyesuaian->EditValue ?>"<?php echo $rekapstok_add->keluar_penyesuaian->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->keluar_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->keluar_pengembalian->Visible) { // keluar_pengembalian ?>
	<div id="r_keluar_pengembalian" class="form-group row">
		<label id="elh_rekapstok_keluar_pengembalian" for="x_keluar_pengembalian" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->keluar_pengembalian->caption() ?><?php echo $rekapstok_add->keluar_pengembalian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->keluar_pengembalian->cellAttributes() ?>>
<span id="el_rekapstok_keluar_pengembalian">
<input type="text" data-table="rekapstok" data-field="x_keluar_pengembalian" name="x_keluar_pengembalian" id="x_keluar_pengembalian" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->keluar_pengembalian->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->keluar_pengembalian->EditValue ?>"<?php echo $rekapstok_add->keluar_pengembalian->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->keluar_pengembalian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekapstok_add->stok->Visible) { // stok ?>
	<div id="r_stok" class="form-group row">
		<label id="elh_rekapstok_stok" for="x_stok" class="<?php echo $rekapstok_add->LeftColumnClass ?>"><?php echo $rekapstok_add->stok->caption() ?><?php echo $rekapstok_add->stok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $rekapstok_add->RightColumnClass ?>"><div <?php echo $rekapstok_add->stok->cellAttributes() ?>>
<span id="el_rekapstok_stok">
<input type="text" data-table="rekapstok" data-field="x_stok" name="x_stok" id="x_stok" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($rekapstok_add->stok->getPlaceHolder()) ?>" value="<?php echo $rekapstok_add->stok->EditValue ?>"<?php echo $rekapstok_add->stok->editAttributes() ?>>
</span>
<?php echo $rekapstok_add->stok->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$rekapstok_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $rekapstok_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $rekapstok_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$rekapstok_add->showPageFooter();
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
$rekapstok_add->terminate();
?>