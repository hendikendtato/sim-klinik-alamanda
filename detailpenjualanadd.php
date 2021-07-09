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
$detailpenjualan_add = new detailpenjualan_add();

// Run the page
$detailpenjualan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenjualan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailpenjualanadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdetailpenjualanadd = currentForm = new ew.Form("fdetailpenjualanadd", "add");

	// Validate form
	fdetailpenjualanadd.validate = function() {
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
			<?php if ($detailpenjualan_add->id_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->id_penjualan->caption(), $detailpenjualan_add->id_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenjualan_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->id_barang->caption(), $detailpenjualan_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->id_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->kode_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->kode_barang->caption(), $detailpenjualan_add->kode_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kode_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->kode_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->nama_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->nama_barang->caption(), $detailpenjualan_add->nama_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nama_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->nama_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->harga_jual->Required) { ?>
				elm = this.getElements("x" + infix + "_harga_jual");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->harga_jual->caption(), $detailpenjualan_add->harga_jual->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_harga_jual");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->harga_jual->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->stok->Required) { ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->stok->caption(), $detailpenjualan_add->stok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_stok");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->stok->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->qty->Required) { ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->qty->caption(), $detailpenjualan_add->qty->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->qty->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->disc_pr->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_pr");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->disc_pr->caption(), $detailpenjualan_add->disc_pr->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_pr");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->disc_pr->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->disc_rp->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_rp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->disc_rp->caption(), $detailpenjualan_add->disc_rp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_rp");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->disc_rp->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->voucher_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_voucher_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->voucher_barang->caption(), $detailpenjualan_add->voucher_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_voucher_barang");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->voucher_barang->errorMessage()) ?>");
			<?php if ($detailpenjualan_add->komisi_recall->Required) { ?>
				elm = this.getElements("x" + infix + "_komisi_recall");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->komisi_recall->caption(), $detailpenjualan_add->komisi_recall->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($detailpenjualan_add->subtotal->Required) { ?>
				elm = this.getElements("x" + infix + "_subtotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $detailpenjualan_add->subtotal->caption(), $detailpenjualan_add->subtotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_subtotal");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($detailpenjualan_add->subtotal->errorMessage()) ?>");

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
	fdetailpenjualanadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailpenjualanadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailpenjualanadd.lists["x_id_penjualan"] = <?php echo $detailpenjualan_add->id_penjualan->Lookup->toClientList($detailpenjualan_add) ?>;
	fdetailpenjualanadd.lists["x_id_penjualan"].options = <?php echo JsonEncode($detailpenjualan_add->id_penjualan->lookupOptions()) ?>;
	fdetailpenjualanadd.lists["x_id_barang"] = <?php echo $detailpenjualan_add->id_barang->Lookup->toClientList($detailpenjualan_add) ?>;
	fdetailpenjualanadd.lists["x_id_barang"].options = <?php echo JsonEncode($detailpenjualan_add->id_barang->lookupOptions()) ?>;
	fdetailpenjualanadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenjualanadd.lists["x_kode_barang"] = <?php echo $detailpenjualan_add->kode_barang->Lookup->toClientList($detailpenjualan_add) ?>;
	fdetailpenjualanadd.lists["x_kode_barang"].options = <?php echo JsonEncode($detailpenjualan_add->kode_barang->lookupOptions()) ?>;
	fdetailpenjualanadd.autoSuggests["x_kode_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenjualanadd.lists["x_nama_barang"] = <?php echo $detailpenjualan_add->nama_barang->Lookup->toClientList($detailpenjualan_add) ?>;
	fdetailpenjualanadd.lists["x_nama_barang"].options = <?php echo JsonEncode($detailpenjualan_add->nama_barang->lookupOptions()) ?>;
	fdetailpenjualanadd.autoSuggests["x_nama_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fdetailpenjualanadd.lists["x_komisi_recall"] = <?php echo $detailpenjualan_add->komisi_recall->Lookup->toClientList($detailpenjualan_add) ?>;
	fdetailpenjualanadd.lists["x_komisi_recall"].options = <?php echo JsonEncode($detailpenjualan_add->komisi_recall->lookupOptions()) ?>;
	loadjs.done("fdetailpenjualanadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpenjualan_add->showPageHeader(); ?>
<?php
$detailpenjualan_add->showMessage();
?>
<form name="fdetailpenjualanadd" id="fdetailpenjualanadd" class="<?php echo $detailpenjualan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenjualan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$detailpenjualan_add->IsModal ?>">
<?php if ($detailpenjualan->getCurrentMasterTable() == "penjualan") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="penjualan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($detailpenjualan_add->id_penjualan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($detailpenjualan_add->id_penjualan->Visible) { // id_penjualan ?>
	<div id="r_id_penjualan" class="form-group row">
		<label id="elh_detailpenjualan_id_penjualan" for="x_id_penjualan" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->id_penjualan->caption() ?><?php echo $detailpenjualan_add->id_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->id_penjualan->cellAttributes() ?>>
<?php if ($detailpenjualan_add->id_penjualan->getSessionValue() != "") { ?>
<span id="el_detailpenjualan_id_penjualan">
<span<?php echo $detailpenjualan_add->id_penjualan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($detailpenjualan_add->id_penjualan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_penjualan" name="x_id_penjualan" value="<?php echo HtmlEncode($detailpenjualan_add->id_penjualan->CurrentValue) ?>">
<?php } else { ?>
<span id="el_detailpenjualan_id_penjualan">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_id_penjualan" data-value-separator="<?php echo $detailpenjualan_add->id_penjualan->displayValueSeparatorAttribute() ?>" id="x_id_penjualan" name="x_id_penjualan"<?php echo $detailpenjualan_add->id_penjualan->editAttributes() ?>>
			<?php echo $detailpenjualan_add->id_penjualan->selectOptionListHtml("x_id_penjualan") ?>
		</select>
</div>
<?php echo $detailpenjualan_add->id_penjualan->Lookup->getParamTag($detailpenjualan_add, "p_x_id_penjualan") ?>
</span>
<?php } ?>
<?php echo $detailpenjualan_add->id_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_detailpenjualan_id_barang" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->id_barang->caption() ?><?php echo $detailpenjualan_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->id_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_id_barang">
<?php
$onchange = $detailpenjualan_add->id_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($detailpenjualan_add->id_barang->EditValue) ?>" size="25" maxlength="40" placeholder="<?php echo HtmlEncode($detailpenjualan_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_add->id_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_add->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_id_barang" data-value-separator="<?php echo $detailpenjualan_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($detailpenjualan_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualanadd"], function() {
	fdetailpenjualanadd.createAutoSuggest({"id":"x_id_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_add->id_barang->Lookup->getParamTag($detailpenjualan_add, "p_x_id_barang") ?>
</span>
<?php echo $detailpenjualan_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->kode_barang->Visible) { // kode_barang ?>
	<div id="r_kode_barang" class="form-group row">
		<label id="elh_detailpenjualan_kode_barang" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->kode_barang->caption() ?><?php echo $detailpenjualan_add->kode_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->kode_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_kode_barang">
<?php
$onchange = $detailpenjualan_add->kode_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_add->kode_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_kode_barang">
	<input type="text" class="form-control" name="sv_x_kode_barang" id="sv_x_kode_barang" value="<?php echo RemoveHtml($detailpenjualan_add->kode_barang->EditValue) ?>" size="10" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_add->kode_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_add->kode_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_add->kode_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_kode_barang" data-value-separator="<?php echo $detailpenjualan_add->kode_barang->displayValueSeparatorAttribute() ?>" name="x_kode_barang" id="x_kode_barang" value="<?php echo HtmlEncode($detailpenjualan_add->kode_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualanadd"], function() {
	fdetailpenjualanadd.createAutoSuggest({"id":"x_kode_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_add->kode_barang->Lookup->getParamTag($detailpenjualan_add, "p_x_kode_barang") ?>
</span>
<?php echo $detailpenjualan_add->kode_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label id="elh_detailpenjualan_nama_barang" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->nama_barang->caption() ?><?php echo $detailpenjualan_add->nama_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->nama_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_nama_barang">
<?php
$onchange = $detailpenjualan_add->nama_barang->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$detailpenjualan_add->nama_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_nama_barang">
	<input type="text" class="form-control" name="sv_x_nama_barang" id="sv_x_nama_barang" value="<?php echo RemoveHtml($detailpenjualan_add->nama_barang->EditValue) ?>" size="45" maxlength="255" placeholder="<?php echo HtmlEncode($detailpenjualan_add->nama_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($detailpenjualan_add->nama_barang->getPlaceHolder()) ?>"<?php echo $detailpenjualan_add->nama_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="detailpenjualan" data-field="x_nama_barang" data-value-separator="<?php echo $detailpenjualan_add->nama_barang->displayValueSeparatorAttribute() ?>" name="x_nama_barang" id="x_nama_barang" value="<?php echo HtmlEncode($detailpenjualan_add->nama_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdetailpenjualanadd"], function() {
	fdetailpenjualanadd.createAutoSuggest({"id":"x_nama_barang","forceSelect":true});
});
</script>
<?php echo $detailpenjualan_add->nama_barang->Lookup->getParamTag($detailpenjualan_add, "p_x_nama_barang") ?>
</span>
<?php echo $detailpenjualan_add->nama_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->harga_jual->Visible) { // harga_jual ?>
	<div id="r_harga_jual" class="form-group row">
		<label id="elh_detailpenjualan_harga_jual" for="x_harga_jual" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->harga_jual->caption() ?><?php echo $detailpenjualan_add->harga_jual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->harga_jual->cellAttributes() ?>>
<span id="el_detailpenjualan_harga_jual">
<input type="text" data-table="detailpenjualan" data-field="x_harga_jual" name="x_harga_jual" id="x_harga_jual" size="6" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_add->harga_jual->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->harga_jual->EditValue ?>"<?php echo $detailpenjualan_add->harga_jual->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->harga_jual->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->stok->Visible) { // stok ?>
	<div id="r_stok" class="form-group row">
		<label id="elh_detailpenjualan_stok" for="x_stok" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->stok->caption() ?><?php echo $detailpenjualan_add->stok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->stok->cellAttributes() ?>>
<span id="el_detailpenjualan_stok">
<input type="text" data-table="detailpenjualan" data-field="x_stok" name="x_stok" id="x_stok" size="5" maxlength="12" placeholder="<?php echo HtmlEncode($detailpenjualan_add->stok->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->stok->EditValue ?>"<?php echo $detailpenjualan_add->stok->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->stok->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label id="elh_detailpenjualan_qty" for="x_qty" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->qty->caption() ?><?php echo $detailpenjualan_add->qty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->qty->cellAttributes() ?>>
<span id="el_detailpenjualan_qty">
<input type="text" data-table="detailpenjualan" data-field="x_qty" name="x_qty" id="x_qty" size="4" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_add->qty->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->qty->EditValue ?>"<?php echo $detailpenjualan_add->qty->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->qty->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->disc_pr->Visible) { // disc_pr ?>
	<div id="r_disc_pr" class="form-group row">
		<label id="elh_detailpenjualan_disc_pr" for="x_disc_pr" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->disc_pr->caption() ?><?php echo $detailpenjualan_add->disc_pr->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->disc_pr->cellAttributes() ?>>
<span id="el_detailpenjualan_disc_pr">
<input type="text" data-table="detailpenjualan" data-field="x_disc_pr" name="x_disc_pr" id="x_disc_pr" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_add->disc_pr->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->disc_pr->EditValue ?>"<?php echo $detailpenjualan_add->disc_pr->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->disc_pr->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->disc_rp->Visible) { // disc_rp ?>
	<div id="r_disc_rp" class="form-group row">
		<label id="elh_detailpenjualan_disc_rp" for="x_disc_rp" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->disc_rp->caption() ?><?php echo $detailpenjualan_add->disc_rp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->disc_rp->cellAttributes() ?>>
<span id="el_detailpenjualan_disc_rp">
<input type="text" data-table="detailpenjualan" data-field="x_disc_rp" name="x_disc_rp" id="x_disc_rp" size="2" maxlength="20" placeholder="<?php echo HtmlEncode($detailpenjualan_add->disc_rp->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->disc_rp->EditValue ?>"<?php echo $detailpenjualan_add->disc_rp->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->disc_rp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->voucher_barang->Visible) { // voucher_barang ?>
	<div id="r_voucher_barang" class="form-group row">
		<label id="elh_detailpenjualan_voucher_barang" for="x_voucher_barang" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->voucher_barang->caption() ?><?php echo $detailpenjualan_add->voucher_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->voucher_barang->cellAttributes() ?>>
<span id="el_detailpenjualan_voucher_barang">
<input type="text" data-table="detailpenjualan" data-field="x_voucher_barang" name="x_voucher_barang" id="x_voucher_barang" size="7" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_add->voucher_barang->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->voucher_barang->EditValue ?>"<?php echo $detailpenjualan_add->voucher_barang->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->voucher_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->komisi_recall->Visible) { // komisi_recall ?>
	<div id="r_komisi_recall" class="form-group row">
		<label id="elh_detailpenjualan_komisi_recall" for="x_komisi_recall" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->komisi_recall->caption() ?><?php echo $detailpenjualan_add->komisi_recall->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->komisi_recall->cellAttributes() ?>>
<span id="el_detailpenjualan_komisi_recall">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpenjualan" data-field="x_komisi_recall" data-value-separator="<?php echo $detailpenjualan_add->komisi_recall->displayValueSeparatorAttribute() ?>" id="x_komisi_recall" name="x_komisi_recall"<?php echo $detailpenjualan_add->komisi_recall->editAttributes() ?>>
			<?php echo $detailpenjualan_add->komisi_recall->selectOptionListHtml("x_komisi_recall") ?>
		</select>
</div>
<?php echo $detailpenjualan_add->komisi_recall->Lookup->getParamTag($detailpenjualan_add, "p_x_komisi_recall") ?>
</span>
<?php echo $detailpenjualan_add->komisi_recall->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($detailpenjualan_add->subtotal->Visible) { // subtotal ?>
	<div id="r_subtotal" class="form-group row">
		<label id="elh_detailpenjualan_subtotal" for="x_subtotal" class="<?php echo $detailpenjualan_add->LeftColumnClass ?>"><?php echo $detailpenjualan_add->subtotal->caption() ?><?php echo $detailpenjualan_add->subtotal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $detailpenjualan_add->RightColumnClass ?>"><div <?php echo $detailpenjualan_add->subtotal->cellAttributes() ?>>
<span id="el_detailpenjualan_subtotal">
<input type="text" data-table="detailpenjualan" data-field="x_subtotal" name="x_subtotal" id="x_subtotal" size="9" maxlength="22" placeholder="<?php echo HtmlEncode($detailpenjualan_add->subtotal->getPlaceHolder()) ?>" value="<?php echo $detailpenjualan_add->subtotal->EditValue ?>"<?php echo $detailpenjualan_add->subtotal->editAttributes() ?>>
</span>
<?php echo $detailpenjualan_add->subtotal->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailpenjualan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpenjualan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $detailpenjualan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpenjualan_add->showPageFooter();
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
$detailpenjualan_add->terminate();
?>