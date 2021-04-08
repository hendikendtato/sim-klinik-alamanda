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
$penyesuaian_poin_add = new penyesuaian_poin_add();

// Run the page
$penyesuaian_poin_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penyesuaian_poin_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenyesuaian_poinadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpenyesuaian_poinadd = currentForm = new ew.Form("fpenyesuaian_poinadd", "add");

	// Validate form
	fpenyesuaian_poinadd.validate = function() {
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
			<?php if ($penyesuaian_poin_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaian_poin_add->id_klinik->caption(), $penyesuaian_poin_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penyesuaian_poin_add->tgl->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penyesuaian_poin_add->tgl->caption(), $penyesuaian_poin_add->tgl->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penyesuaian_poin_add->tgl->errorMessage()) ?>");

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
	fpenyesuaian_poinadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenyesuaian_poinadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenyesuaian_poinadd.lists["x_id_klinik"] = <?php echo $penyesuaian_poin_add->id_klinik->Lookup->toClientList($penyesuaian_poin_add) ?>;
	fpenyesuaian_poinadd.lists["x_id_klinik"].options = <?php echo JsonEncode($penyesuaian_poin_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fpenyesuaian_poinadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("h4.ew-detail-caption").hide(),$("[data-field=x_poin_lapangan]").keyup(function(){var a=$(this).attr("id");console.log(a);var n="#"+a.split("_")[0];console.log(n);var l=n+"_poin_database",i=n+"_selisih",o=n+"_tipe",p=0;if(poinLapangan=parseFloat($(n+"_poin_lapangan").val().split(",").join(".")),p=$(l).val()?$(l).val().split(".").join(""):0,$(i).val()?$(i).val().split(".").join(""):0,console.log(p),console.log(poinLapangan),p<poinLapangan){$(o).val("Masuk");var e=poinLapangan-p;$(i).val(e)}else{$(o).val("Keluar");var s=p-poinLapangan;$(i).val(s)}});
});
</script>
<?php $penyesuaian_poin_add->showPageHeader(); ?>
<?php
$penyesuaian_poin_add->showMessage();
?>
<form name="fpenyesuaian_poinadd" id="fpenyesuaian_poinadd" class="<?php echo $penyesuaian_poin_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penyesuaian_poin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$penyesuaian_poin_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($penyesuaian_poin_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_penyesuaian_poin_id_klinik" for="x_id_klinik" class="<?php echo $penyesuaian_poin_add->LeftColumnClass ?>"><?php echo $penyesuaian_poin_add->id_klinik->caption() ?><?php echo $penyesuaian_poin_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaian_poin_add->RightColumnClass ?>"><div <?php echo $penyesuaian_poin_add->id_klinik->cellAttributes() ?>>
<span id="el_penyesuaian_poin_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penyesuaian_poin" data-field="x_id_klinik" data-value-separator="<?php echo $penyesuaian_poin_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $penyesuaian_poin_add->id_klinik->editAttributes() ?>>
			<?php echo $penyesuaian_poin_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $penyesuaian_poin_add->id_klinik->Lookup->getParamTag($penyesuaian_poin_add, "p_x_id_klinik") ?>
</span>
<?php echo $penyesuaian_poin_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penyesuaian_poin_add->tgl->Visible) { // tgl ?>
	<div id="r_tgl" class="form-group row">
		<label id="elh_penyesuaian_poin_tgl" for="x_tgl" class="<?php echo $penyesuaian_poin_add->LeftColumnClass ?>"><?php echo $penyesuaian_poin_add->tgl->caption() ?><?php echo $penyesuaian_poin_add->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penyesuaian_poin_add->RightColumnClass ?>"><div <?php echo $penyesuaian_poin_add->tgl->cellAttributes() ?>>
<span id="el_penyesuaian_poin_tgl">
<input type="text" data-table="penyesuaian_poin" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?php echo HtmlEncode($penyesuaian_poin_add->tgl->getPlaceHolder()) ?>" value="<?php echo $penyesuaian_poin_add->tgl->EditValue ?>"<?php echo $penyesuaian_poin_add->tgl->editAttributes() ?>>
<?php if (!$penyesuaian_poin_add->tgl->ReadOnly && !$penyesuaian_poin_add->tgl->Disabled && !isset($penyesuaian_poin_add->tgl->EditAttrs["readonly"]) && !isset($penyesuaian_poin_add->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenyesuaian_poinadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenyesuaian_poinadd", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penyesuaian_poin_add->tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("detailpenyesuaianpoin", explode(",", $penyesuaian_poin->getCurrentDetailTable())) && $detailpenyesuaianpoin->DetailAdd) {
?>
<?php if ($penyesuaian_poin->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenyesuaianpoin", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpenyesuaianpoingrid.php" ?>
<?php } ?>
<?php if (!$penyesuaian_poin_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penyesuaian_poin_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penyesuaian_poin_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penyesuaian_poin_add->showPageFooter();
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
$penyesuaian_poin_add->terminate();
?>