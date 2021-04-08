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
$komposisi_edit = new komposisi_edit();

// Run the page
$komposisi_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komposisi_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fkomposisiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fkomposisiedit = currentForm = new ew.Form("fkomposisiedit", "edit");

	// Validate form
	fkomposisiedit.validate = function() {
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
			<?php if ($komposisi_edit->id_komposisi->Required) { ?>
				elm = this.getElements("x" + infix + "_id_komposisi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komposisi_edit->id_komposisi->caption(), $komposisi_edit->id_komposisi->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($komposisi_edit->id_barang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_barang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $komposisi_edit->id_barang->caption(), $komposisi_edit->id_barang->RequiredErrorMessage)) ?>");
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
	fkomposisiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fkomposisiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fkomposisiedit.lists["x_id_barang"] = <?php echo $komposisi_edit->id_barang->Lookup->toClientList($komposisi_edit) ?>;
	fkomposisiedit.lists["x_id_barang"].options = <?php echo JsonEncode($komposisi_edit->id_barang->lookupOptions()) ?>;
	loadjs.done("fkomposisiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $komposisi_edit->showPageHeader(); ?>
<?php
$komposisi_edit->showMessage();
?>
<form name="fkomposisiedit" id="fkomposisiedit" class="<?php echo $komposisi_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komposisi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$komposisi_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($komposisi_edit->id_komposisi->Visible) { // id_komposisi ?>
	<div id="r_id_komposisi" class="form-group row">
		<label id="elh_komposisi_id_komposisi" class="<?php echo $komposisi_edit->LeftColumnClass ?>"><?php echo $komposisi_edit->id_komposisi->caption() ?><?php echo $komposisi_edit->id_komposisi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komposisi_edit->RightColumnClass ?>"><div <?php echo $komposisi_edit->id_komposisi->cellAttributes() ?>>
<span id="el_komposisi_id_komposisi">
<span<?php echo $komposisi_edit->id_komposisi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($komposisi_edit->id_komposisi->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="komposisi" data-field="x_id_komposisi" name="x_id_komposisi" id="x_id_komposisi" value="<?php echo HtmlEncode($komposisi_edit->id_komposisi->CurrentValue) ?>">
<?php echo $komposisi_edit->id_komposisi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($komposisi_edit->id_barang->Visible) { // id_barang ?>
	<div id="r_id_barang" class="form-group row">
		<label id="elh_komposisi_id_barang" for="x_id_barang" class="<?php echo $komposisi_edit->LeftColumnClass ?>"><?php echo $komposisi_edit->id_barang->caption() ?><?php echo $komposisi_edit->id_barang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $komposisi_edit->RightColumnClass ?>"><div <?php echo $komposisi_edit->id_barang->cellAttributes() ?>>
<span id="el_komposisi_id_barang">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_barang"><?php echo EmptyValue(strval($komposisi_edit->id_barang->ViewValue)) ? $Language->phrase("PleaseSelect") : $komposisi_edit->id_barang->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($komposisi_edit->id_barang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($komposisi_edit->id_barang->ReadOnly || $komposisi_edit->id_barang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_barang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $komposisi_edit->id_barang->Lookup->getParamTag($komposisi_edit, "p_x_id_barang") ?>
<input type="hidden" data-table="komposisi" data-field="x_id_barang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $komposisi_edit->id_barang->displayValueSeparatorAttribute() ?>" name="x_id_barang" id="x_id_barang" value="<?php echo $komposisi_edit->id_barang->CurrentValue ?>"<?php echo $komposisi_edit->id_barang->editAttributes() ?>>
</span>
<?php echo $komposisi_edit->id_barang->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailkomposisi", explode(",", $komposisi->getCurrentDetailTable())) && $detailkomposisi->DetailEdit) {
?>
<?php if ($komposisi->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailkomposisi", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailkomposisigrid.php" ?>
<?php } ?>
<?php if (!$komposisi_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $komposisi_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $komposisi_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$komposisi_edit->showPageFooter();
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
$komposisi_edit->terminate();
?>