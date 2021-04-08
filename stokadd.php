<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$stok_add = new stok_add();

// Run the page
$stok_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$stok_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstokadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstokadd = currentForm = new ew.Form("fstokadd", "add");

	// Validate form
	fstokadd.validate = function() {
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
			<?php if ($stok_add->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $stok_add->id_barang->caption(), $stok_add->id_barang->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($stok_add->id_barang->errorMessage()) ?>");
			<?php if ($stok_add->jumlah->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $stok_add->jumlah->caption(), $stok_add->jumlah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($stok_add->jumlah->errorMessage()) ?>");
			<?php if ($stok_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $stok_add->id_klinik->caption(), $stok_add->id_klinik->RequiredErrorMessage)) ?>");
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
	fstokadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstokadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstokadd.lists["x_id_barang"] = <?php echo $stok_add->id_barang->Lookup->toClientList($stok_add) ?>;
	fstokadd.lists["x_id_barang"].options = <?php echo JsonEncode($stok_add->id_barang->lookupOptions()) ?>;
	fstokadd.autoSuggests["x_id_barang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fstokadd.lists["x_id_klinik"] = <?php echo $stok_add->id_klinik->Lookup->toClientList($stok_add) ?>;
	fstokadd.lists["x_id_klinik"].options = <?php echo JsonEncode($stok_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fstokadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $stok_add->showPageHeader(); ?>
<?php
$stok_add->showMessage();
?>
<form name="fstokadd" id="fstokadd" class="<?php echo $stok_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="stok">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$stok_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($stok_add->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_stok_id_barang" class="<?php echo $stok_add->LeftColumnClass ?>"><?php echo $stok_add->id_barang->caption() ?><?php echo $stok_add->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $stok_add->RightColumnClass ?>"><div <?php echo $stok_add->id_barang->cellAttributes() ?>>
<span id="el_stok_id_barang">
<?php
$onchange = $stok_add->id_barang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$stok_add->id_barang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_barang">
	<input type="text" class="form-control" name="sv_x_id_barang" id="sv_x_id_barang" value="<?php echo RemoveHtml($stok_add->id_barang->EditValue) ?>" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($stok_add->id_barang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($stok_add->id_barang->getPlaceHolder()) ?>"<?php echo $stok_add->id_barang->editAttributes() ?>>
</span>
<input type="hidden" data-table="stok" data-field="x_id_barang" data-value-separator="<?php echo $stok_add->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo HtmlEncode($stok_add->id_barang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fstokadd"], function() {
	fstokadd.createAutoSuggest({"id":"x_id_barang","forceSelect":false});
});
</script>
<?php echo $stok_add->id_barang->Lookup->getParamTag($stok_add, "p_x_id_barang") ?>
</span>
<?php echo $stok_add->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($stok_add->jumlah->Visible) { // jumlah ?>
	<div id="r_jumlah" class="form-group row">
		<label id="elh_stok_jumlah" for="x_jumlah" class="<?php echo $stok_add->LeftColumnClass ?>"><?php echo $stok_add->jumlah->caption() ?><?php echo $stok_add->jumlah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $stok_add->RightColumnClass ?>"><div <?php echo $stok_add->jumlah->cellAttributes() ?>>
<span id="el_stok_jumlah">
<input type="text" data-table="stok" data-field="x_jumlah" name="x_jumlah" id="x_jumlah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($stok_add->jumlah->getPlaceHolder()) ?>" value="<?php echo $stok_add->jumlah->EditValue ?>"<?php echo $stok_add->jumlah->editAttributes() ?>>
</span>
<?php echo $stok_add->jumlah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($stok_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_stok_id_klinik" for="x_id_klinik" class="<?php echo $stok_add->LeftColumnClass ?>"><?php echo $stok_add->id_klinik->caption() ?><?php echo $stok_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $stok_add->RightColumnClass ?>"><div <?php echo $stok_add->id_klinik->cellAttributes() ?>>
<span id="el_stok_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="stok" data-field="x_id_klinik" data-value-separator="<?php echo $stok_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $stok_add->id_klinik->editAttributes() ?>>
			<?php echo $stok_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $stok_add->id_klinik->Lookup->getParamTag($stok_add, "p_x_id_klinik") ?>
</span>
<?php echo $stok_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$stok_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $stok_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $stok_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$stok_add->showPageFooter();
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
$stok_add->terminate();
?>