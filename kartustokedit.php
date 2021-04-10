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
$kartustok_edit = new kartustok_edit();

// Run the page
$kartustok_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkartustokedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkartustokedit = currentForm = new ew.Form("fkartustokedit", "edit");

	// Validate form
	fkartustokedit.validate = function() {
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
			<?php if ($kartustok_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_barang->caption(), $kartustok_edit->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->id_barang->errorMessage()) ?>");
			<?php if ($kartustok_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_klinik->caption(), $kartustok_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_edit->tanggal->Required) { ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->tanggal->caption(), $kartustok_edit->tanggal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tanggal");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->tanggal->errorMessage()) ?>");
			<?php if ($kartustok_edit->id_terimabarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_terimabarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_terimabarang->caption(), $kartustok_edit->id_terimabarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_edit->id_terimagudang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_terimagudang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_terimagudang->caption(), $kartustok_edit->id_terimagudang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_terimagudang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->id_terimagudang->errorMessage()) ?>");
			<?php if ($kartustok_edit->id_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_penjualan->caption(), $kartustok_edit->id_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_penjualan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->id_penjualan->errorMessage()) ?>");
			<?php if ($kartustok_edit->id_kirimbarang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kirimbarang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_kirimbarang->caption(), $kartustok_edit->id_kirimbarang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_edit->id_retur->Required) { ?>
				elm = this.getElements("x" + infix + "_id_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_retur->caption(), $kartustok_edit->id_retur->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($kartustok_edit->id_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->id_penyesuaian->caption(), $kartustok_edit->id_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->id_penyesuaian->errorMessage()) ?>");
			<?php if ($kartustok_edit->stok_awal->Required) { ?>
				elm = this.getElements("x" + infix + "_stok_awal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->stok_awal->caption(), $kartustok_edit->stok_awal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok_awal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->stok_awal->errorMessage()) ?>");
			<?php if ($kartustok_edit->masuk->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->masuk->caption(), $kartustok_edit->masuk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->masuk->errorMessage()) ?>");
			<?php if ($kartustok_edit->masuk_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->masuk_penyesuaian->caption(), $kartustok_edit->masuk_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->masuk_penyesuaian->errorMessage()) ?>");
			<?php if ($kartustok_edit->keluar->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->keluar->caption(), $kartustok_edit->keluar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->keluar->errorMessage()) ?>");
			<?php if ($kartustok_edit->keluar_nonjual->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_nonjual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->keluar_nonjual->caption(), $kartustok_edit->keluar_nonjual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_nonjual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->keluar_nonjual->errorMessage()) ?>");
			<?php if ($kartustok_edit->keluar_penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->keluar_penyesuaian->caption(), $kartustok_edit->keluar_penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_penyesuaian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->keluar_penyesuaian->errorMessage()) ?>");
			<?php if ($kartustok_edit->keluar_kirim->Required) { ?>
				elm = this.getElements("x" + infix + "_keluar_kirim");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->keluar_kirim->caption(), $kartustok_edit->keluar_kirim->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_keluar_kirim");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->keluar_kirim->errorMessage()) ?>");
			<?php if ($kartustok_edit->retur->Required) { ?>
				elm = this.getElements("x" + infix + "_retur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->retur->caption(), $kartustok_edit->retur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_retur");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->retur->errorMessage()) ?>");
			<?php if ($kartustok_edit->stok_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_stok_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $kartustok_edit->stok_akhir->caption(), $kartustok_edit->stok_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok_akhir");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($kartustok_edit->stok_akhir->errorMessage()) ?>");

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
	fkartustokedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkartustokedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkartustokedit.lists["x_id_barang"] = <?php echo $kartustok_edit->id_barang->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_barang"].options = <?php echo JsonEncode($kartustok_edit->id_barang->lookupOptions()) ?>;
	fkartustokedit.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustokedit.lists["x_id_klinik"] = <?php echo $kartustok_edit->id_klinik->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_klinik"].options = <?php echo JsonEncode($kartustok_edit->id_klinik->lookupOptions()) ?>;
	fkartustokedit.lists["x_id_terimabarang"] = <?php echo $kartustok_edit->id_terimabarang->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_terimabarang"].options = <?php echo JsonEncode($kartustok_edit->id_terimabarang->lookupOptions()) ?>;
	fkartustokedit.lists["x_id_terimagudang"] = <?php echo $kartustok_edit->id_terimagudang->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_terimagudang"].options = <?php echo JsonEncode($kartustok_edit->id_terimagudang->lookupOptions()) ?>;
	fkartustokedit.autoSuggests["x_id_terimagudang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustokedit.lists["x_id_penjualan"] = <?php echo $kartustok_edit->id_penjualan->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_penjualan"].options = <?php echo JsonEncode($kartustok_edit->id_penjualan->lookupOptions()) ?>;
	fkartustokedit.autoSuggests["x_id_penjualan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fkartustokedit.lists["x_id_kirimbarang"] = <?php echo $kartustok_edit->id_kirimbarang->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_kirimbarang"].options = <?php echo JsonEncode($kartustok_edit->id_kirimbarang->lookupOptions()) ?>;
	fkartustokedit.lists["x_id_retur"] = <?php echo $kartustok_edit->id_retur->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_retur"].options = <?php echo JsonEncode($kartustok_edit->id_retur->lookupOptions()) ?>;
	fkartustokedit.lists["x_id_penyesuaian"] = <?php echo $kartustok_edit->id_penyesuaian->Lookup->toClientList($kartustok_edit) ?>;
	fkartustokedit.lists["x_id_penyesuaian"].options = <?php echo JsonEncode($kartustok_edit->id_penyesuaian->lookupOptions()) ?>;
	fkartustokedit.autoSuggests["x_id_penyesuaian"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fkartustokedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $kartustok_edit->showPageHeader(); ?>
<?php
$kartustok_edit->showMessage();
?>
<form name="fkartustokedit" id="fkartustokedit" class="<?php echo $kartustok_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartustok">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$kartustok_edit->IsModal ?>">
<?php if ($kartustok->getCurrentMasterTable() == "V_kartustok") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="V_kartustok">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($kartustok_edit->id_barang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($kartustok_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_kartustok_id_barang" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_barang->caption() ?><?php echo $kartustok_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_barang->cellAttributes() ?>>
<?php if ($kartustok_edit->id_barang->getSessionValue() != "") { ?>
<span id="el_kartustok_id_barang">
<span<?php echo $kartustok_edit->id_barang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($kartustok_edit->id_barang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_barang" name="x_id_barang" value="<?php echo HtmlEncode($kartustok_edit->id_barang->CurrentValue) ?>">
<?php } else { ?>
<span id="el_kartustok_id_barang">
<?php
$onchange = $kartustok_edit->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_edit->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($kartustok_edit->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($kartustok_edit->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_edit->id_barang->getPlaceHolder()) ?>"<?php echo $kartustok_edit->id_barang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($kartustok_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($kartustok_edit->id_barang->ReadOnly || $kartustok_edit->id_barang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $kartustok_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($kartustok_edit->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokedit"], function() {
	fkartustokedit.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $kartustok_edit->id_barang->Lookup->getParamTag($kartustok_edit, "p_x_id_barang") ?>
</span>
<?php } ?>
<?php echo $kartustok_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_kartustok_id_klinik" for="x_id_klinik" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_klinik->caption() ?><?php echo $kartustok_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_klinik->cellAttributes() ?>>
<span id="el_kartustok_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_klinik" data-value-separator="<?php echo $kartustok_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $kartustok_edit->id_klinik->editAttributes() ?>>
			<?php echo $kartustok_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $kartustok_edit->id_klinik->Lookup->getParamTag($kartustok_edit, "p_x_id_klinik") ?>
</span>
<?php echo $kartustok_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->tanggal->Visible) { // tanggal ?>
	<div id="r_tanggal" class="form-group row">
		<label id="elh_kartustok_tanggal" for="x_tanggal" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->tanggal->caption() ?><?php echo $kartustok_edit->tanggal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->tanggal->cellAttributes() ?>>
<span id="el_kartustok_tanggal">
<input type="text" data-table="kartustok" data-field="x_tanggal" name="x_tanggal" id="x_tanggal" maxlength="19" placeholder="<?php echo HtmlEncode($kartustok_edit->tanggal->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->tanggal->EditValue ?>"<?php echo $kartustok_edit->tanggal->editAttributes() ?>>
<?php if (!$kartustok_edit->tanggal->ReadOnly && !$kartustok_edit->tanggal->Disabled && !isset($kartustok_edit->tanggal->EditAttrs["readonly"]) && !isset($kartustok_edit->tanggal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkartustokedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fkartustokedit", "x_tanggal", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $kartustok_edit->tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_terimabarang->Visible) { // id_terimabarang ?>
	<div id="r_id_terimabarang" class="form-group row">
		<label id="elh_kartustok_id_terimabarang" for="x_id_terimabarang" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_terimabarang->caption() ?><?php echo $kartustok_edit->id_terimabarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_terimabarang->cellAttributes() ?>>
<span id="el_kartustok_id_terimabarang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_terimabarang" data-value-separator="<?php echo $kartustok_edit->id_terimabarang->displayValueSeparatorAttribute() ?>" id="x_id_terimabarang" name="x_id_terimabarang"<?php echo $kartustok_edit->id_terimabarang->editAttributes() ?>>
			<?php echo $kartustok_edit->id_terimabarang->selectOptionListHtml("x_id_terimabarang") ?>
		</select>
</div>
<?php echo $kartustok_edit->id_terimabarang->Lookup->getParamTag($kartustok_edit, "p_x_id_terimabarang") ?>
</span>
<?php echo $kartustok_edit->id_terimabarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_terimagudang->Visible) { // id_terimagudang ?>
	<div id="r_id_terimagudang" class="form-group row">
		<label id="elh_kartustok_id_terimagudang" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_terimagudang->caption() ?><?php echo $kartustok_edit->id_terimagudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_terimagudang->cellAttributes() ?>>
<span id="el_kartustok_id_terimagudang">
<?php
$onchange = $kartustok_edit->id_terimagudang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_edit->id_terimagudang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_terimagudang">
	<input type="text" class="form-control" name="sv_x_id_terimagudang" id="sv_x_id_terimagudang" value="<?php echo RemoveHtml($kartustok_edit->id_terimagudang->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_edit->id_terimagudang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_edit->id_terimagudang->getPlaceHolder()) ?>"<?php echo $kartustok_edit->id_terimagudang->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_terimagudang" data-value-separator="<?php echo $kartustok_edit->id_terimagudang->displayValueSeparatorAttribute() ?>" name="x_id_terimagudang" id="x_id_terimagudang" value="<?php echo HtmlEncode($kartustok_edit->id_terimagudang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokedit"], function() {
	fkartustokedit.createAutoSuggest({"id":"x_id_terimagudang","forceSelect":false});
});
</script>
<?php echo $kartustok_edit->id_terimagudang->Lookup->getParamTag($kartustok_edit, "p_x_id_terimagudang") ?>
</span>
<?php echo $kartustok_edit->id_terimagudang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_penjualan->Visible) { // id_penjualan ?>
	<div id="r_id_penjualan" class="form-group row">
		<label id="elh_kartustok_id_penjualan" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_penjualan->caption() ?><?php echo $kartustok_edit->id_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_penjualan->cellAttributes() ?>>
<span id="el_kartustok_id_penjualan">
<?php
$onchange = $kartustok_edit->id_penjualan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_edit->id_penjualan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_penjualan">
	<input type="text" class="form-control" name="sv_x_id_penjualan" id="sv_x_id_penjualan" value="<?php echo RemoveHtml($kartustok_edit->id_penjualan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_edit->id_penjualan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_edit->id_penjualan->getPlaceHolder()) ?>"<?php echo $kartustok_edit->id_penjualan->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penjualan" data-value-separator="<?php echo $kartustok_edit->id_penjualan->displayValueSeparatorAttribute() ?>" name="x_id_penjualan" id="x_id_penjualan" value="<?php echo HtmlEncode($kartustok_edit->id_penjualan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokedit"], function() {
	fkartustokedit.createAutoSuggest({"id":"x_id_penjualan","forceSelect":false});
});
</script>
<?php echo $kartustok_edit->id_penjualan->Lookup->getParamTag($kartustok_edit, "p_x_id_penjualan") ?>
</span>
<?php echo $kartustok_edit->id_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<div id="r_id_kirimbarang" class="form-group row">
		<label id="elh_kartustok_id_kirimbarang" for="x_id_kirimbarang" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_kirimbarang->caption() ?><?php echo $kartustok_edit->id_kirimbarang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_kirimbarang->cellAttributes() ?>>
<span id="el_kartustok_id_kirimbarang">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_kirimbarang" data-value-separator="<?php echo $kartustok_edit->id_kirimbarang->displayValueSeparatorAttribute() ?>" id="x_id_kirimbarang" name="x_id_kirimbarang"<?php echo $kartustok_edit->id_kirimbarang->editAttributes() ?>>
			<?php echo $kartustok_edit->id_kirimbarang->selectOptionListHtml("x_id_kirimbarang") ?>
		</select>
</div>
<?php echo $kartustok_edit->id_kirimbarang->Lookup->getParamTag($kartustok_edit, "p_x_id_kirimbarang") ?>
</span>
<?php echo $kartustok_edit->id_kirimbarang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_retur->Visible) { // id_retur ?>
	<div id="r_id_retur" class="form-group row">
		<label id="elh_kartustok_id_retur" for="x_id_retur" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_retur->caption() ?><?php echo $kartustok_edit->id_retur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_retur->cellAttributes() ?>>
<span id="el_kartustok_id_retur">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="kartustok" data-field="x_id_retur" data-value-separator="<?php echo $kartustok_edit->id_retur->displayValueSeparatorAttribute() ?>" id="x_id_retur" name="x_id_retur"<?php echo $kartustok_edit->id_retur->editAttributes() ?>>
			<?php echo $kartustok_edit->id_retur->selectOptionListHtml("x_id_retur") ?>
		</select>
</div>
<?php echo $kartustok_edit->id_retur->Lookup->getParamTag($kartustok_edit, "p_x_id_retur") ?>
</span>
<?php echo $kartustok_edit->id_retur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->id_penyesuaian->Visible) { // id_penyesuaian ?>
	<div id="r_id_penyesuaian" class="form-group row">
		<label id="elh_kartustok_id_penyesuaian" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->id_penyesuaian->caption() ?><?php echo $kartustok_edit->id_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->id_penyesuaian->cellAttributes() ?>>
<span id="el_kartustok_id_penyesuaian">
<?php
$onchange = $kartustok_edit->id_penyesuaian->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$kartustok_edit->id_penyesuaian->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_penyesuaian">
	<input type="text" class="form-control" name="sv_x_id_penyesuaian" id="sv_x_id_penyesuaian" value="<?php echo RemoveHtml($kartustok_edit->id_penyesuaian->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($kartustok_edit->id_penyesuaian->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($kartustok_edit->id_penyesuaian->getPlaceHolder()) ?>"<?php echo $kartustok_edit->id_penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="kartustok" data-field="x_id_penyesuaian" data-value-separator="<?php echo $kartustok_edit->id_penyesuaian->displayValueSeparatorAttribute() ?>" name="x_id_penyesuaian" id="x_id_penyesuaian" value="<?php echo HtmlEncode($kartustok_edit->id_penyesuaian->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fkartustokedit"], function() {
	fkartustokedit.createAutoSuggest({"id":"x_id_penyesuaian","forceSelect":false});
});
</script>
<?php echo $kartustok_edit->id_penyesuaian->Lookup->getParamTag($kartustok_edit, "p_x_id_penyesuaian") ?>
</span>
<?php echo $kartustok_edit->id_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->stok_awal->Visible) { // stok_awal ?>
	<div id="r_stok_awal" class="form-group row">
		<label id="elh_kartustok_stok_awal" for="x_stok_awal" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->stok_awal->caption() ?><?php echo $kartustok_edit->stok_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->stok_awal->cellAttributes() ?>>
<span id="el_kartustok_stok_awal">
<input type="text" data-table="kartustok" data-field="x_stok_awal" name="x_stok_awal" id="x_stok_awal" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_edit->stok_awal->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->stok_awal->EditValue ?>"<?php echo $kartustok_edit->stok_awal->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->stok_awal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->masuk->Visible) { // masuk ?>
	<div id="r_masuk" class="form-group row">
		<label id="elh_kartustok_masuk" for="x_masuk" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->masuk->caption() ?><?php echo $kartustok_edit->masuk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->masuk->cellAttributes() ?>>
<span id="el_kartustok_masuk">
<input type="text" data-table="kartustok" data-field="x_masuk" name="x_masuk" id="x_masuk" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_edit->masuk->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->masuk->EditValue ?>"<?php echo $kartustok_edit->masuk->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->masuk->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<div id="r_masuk_penyesuaian" class="form-group row">
		<label id="elh_kartustok_masuk_penyesuaian" for="x_masuk_penyesuaian" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->masuk_penyesuaian->caption() ?><?php echo $kartustok_edit->masuk_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->masuk_penyesuaian->cellAttributes() ?>>
<span id="el_kartustok_masuk_penyesuaian">
<input type="text" data-table="kartustok" data-field="x_masuk_penyesuaian" name="x_masuk_penyesuaian" id="x_masuk_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_edit->masuk_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->masuk_penyesuaian->EditValue ?>"<?php echo $kartustok_edit->masuk_penyesuaian->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->masuk_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->keluar->Visible) { // keluar ?>
	<div id="r_keluar" class="form-group row">
		<label id="elh_kartustok_keluar" for="x_keluar" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->keluar->caption() ?><?php echo $kartustok_edit->keluar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->keluar->cellAttributes() ?>>
<span id="el_kartustok_keluar">
<input type="text" data-table="kartustok" data-field="x_keluar" name="x_keluar" id="x_keluar" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_edit->keluar->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->keluar->EditValue ?>"<?php echo $kartustok_edit->keluar->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->keluar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->keluar_nonjual->Visible) { // keluar_nonjual ?>
	<div id="r_keluar_nonjual" class="form-group row">
		<label id="elh_kartustok_keluar_nonjual" for="x_keluar_nonjual" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->keluar_nonjual->caption() ?><?php echo $kartustok_edit->keluar_nonjual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->keluar_nonjual->cellAttributes() ?>>
<span id="el_kartustok_keluar_nonjual">
<input type="text" data-table="kartustok" data-field="x_keluar_nonjual" name="x_keluar_nonjual" id="x_keluar_nonjual" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_edit->keluar_nonjual->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->keluar_nonjual->EditValue ?>"<?php echo $kartustok_edit->keluar_nonjual->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->keluar_nonjual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<div id="r_keluar_penyesuaian" class="form-group row">
		<label id="elh_kartustok_keluar_penyesuaian" for="x_keluar_penyesuaian" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->keluar_penyesuaian->caption() ?><?php echo $kartustok_edit->keluar_penyesuaian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->keluar_penyesuaian->cellAttributes() ?>>
<span id="el_kartustok_keluar_penyesuaian">
<input type="text" data-table="kartustok" data-field="x_keluar_penyesuaian" name="x_keluar_penyesuaian" id="x_keluar_penyesuaian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($kartustok_edit->keluar_penyesuaian->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->keluar_penyesuaian->EditValue ?>"<?php echo $kartustok_edit->keluar_penyesuaian->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->keluar_penyesuaian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->keluar_kirim->Visible) { // keluar_kirim ?>
	<div id="r_keluar_kirim" class="form-group row">
		<label id="elh_kartustok_keluar_kirim" for="x_keluar_kirim" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->keluar_kirim->caption() ?><?php echo $kartustok_edit->keluar_kirim->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->keluar_kirim->cellAttributes() ?>>
<span id="el_kartustok_keluar_kirim">
<input type="text" data-table="kartustok" data-field="x_keluar_kirim" name="x_keluar_kirim" id="x_keluar_kirim" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_edit->keluar_kirim->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->keluar_kirim->EditValue ?>"<?php echo $kartustok_edit->keluar_kirim->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->keluar_kirim->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->retur->Visible) { // retur ?>
	<div id="r_retur" class="form-group row">
		<label id="elh_kartustok_retur" for="x_retur" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->retur->caption() ?><?php echo $kartustok_edit->retur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->retur->cellAttributes() ?>>
<span id="el_kartustok_retur">
<input type="text" data-table="kartustok" data-field="x_retur" name="x_retur" id="x_retur" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_edit->retur->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->retur->EditValue ?>"<?php echo $kartustok_edit->retur->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->retur->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartustok_edit->stok_akhir->Visible) { // stok_akhir ?>
	<div id="r_stok_akhir" class="form-group row">
		<label id="elh_kartustok_stok_akhir" for="x_stok_akhir" class="<?php echo $kartustok_edit->LeftColumnClass ?>"><?php echo $kartustok_edit->stok_akhir->caption() ?><?php echo $kartustok_edit->stok_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $kartustok_edit->RightColumnClass ?>"><div <?php echo $kartustok_edit->stok_akhir->cellAttributes() ?>>
<span id="el_kartustok_stok_akhir">
<input type="text" data-table="kartustok" data-field="x_stok_akhir" name="x_stok_akhir" id="x_stok_akhir" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($kartustok_edit->stok_akhir->getPlaceHolder()) ?>" value="<?php echo $kartustok_edit->stok_akhir->EditValue ?>"<?php echo $kartustok_edit->stok_akhir->editAttributes() ?>>
</span>
<?php echo $kartustok_edit->stok_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="kartustok" data-field="x_id_kartustok" name="x_id_kartustok" id="x_id_kartustok" value="<?php echo HtmlEncode($kartustok_edit->id_kartustok->CurrentValue) ?>">
<?php if (!$kartustok_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $kartustok_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $kartustok_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$kartustok_edit->showPageFooter();
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
$kartustok_edit->terminate();
?>