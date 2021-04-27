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
$m_gudang_add = new m_gudang_add();

// Run the page
$m_gudang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_gudang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_gudangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_gudangadd = currentForm = new ew.Form("fm_gudangadd", "add");

	// Validate form
	fm_gudangadd.validate = function() {
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
			<?php if ($m_gudang_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_gudang_add->id_klinik->caption(), $m_gudang_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_gudang_add->kode_gudang->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_gudang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_gudang_add->kode_gudang->caption(), $m_gudang_add->kode_gudang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_gudang_add->nama_gudang->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_gudang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_gudang_add->nama_gudang->caption(), $m_gudang_add->nama_gudang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_gudang_add->lokasi_gudang->Required) { ?>
				elm = this.getElements("x" + infix + "_lokasi_gudang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_gudang_add->lokasi_gudang->caption(), $m_gudang_add->lokasi_gudang->RequiredErrorMessage)) ?>");
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
	fm_gudangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_gudangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_gudangadd.lists["x_id_klinik"] = <?php echo $m_gudang_add->id_klinik->Lookup->toClientList($m_gudang_add) ?>;
	fm_gudangadd.lists["x_id_klinik"].options = <?php echo JsonEncode($m_gudang_add->id_klinik->lookupOptions()) ?>;
	loadjs.done("fm_gudangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_gudang_add->showPageHeader(); ?>
<?php
$m_gudang_add->showMessage();
?>
<form name="fm_gudangadd" id="fm_gudangadd" class="<?php echo $m_gudang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_gudang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_gudang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_gudang_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_gudang_id_klinik" for="x_id_klinik" class="<?php echo $m_gudang_add->LeftColumnClass ?>"><?php echo $m_gudang_add->id_klinik->caption() ?><?php echo $m_gudang_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_gudang_add->RightColumnClass ?>"><div <?php echo $m_gudang_add->id_klinik->cellAttributes() ?>>
<span id="el_m_gudang_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_gudang" data-field="x_id_klinik" data-value-separator="<?php echo $m_gudang_add->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_gudang_add->id_klinik->editAttributes() ?>>
			<?php echo $m_gudang_add->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_gudang_add->id_klinik->Lookup->getParamTag($m_gudang_add, "p_x_id_klinik") ?>
</span>
<?php echo $m_gudang_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_gudang_add->kode_gudang->Visible) { // kode_gudang ?>
	<div id="r_kode_gudang" class="form-group row">
		<label id="elh_m_gudang_kode_gudang" for="x_kode_gudang" class="<?php echo $m_gudang_add->LeftColumnClass ?>"><?php echo $m_gudang_add->kode_gudang->caption() ?><?php echo $m_gudang_add->kode_gudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_gudang_add->RightColumnClass ?>"><div <?php echo $m_gudang_add->kode_gudang->cellAttributes() ?>>
<span id="el_m_gudang_kode_gudang">
<input type="text" data-table="m_gudang" data-field="x_kode_gudang" name="x_kode_gudang" id="x_kode_gudang" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_gudang_add->kode_gudang->getPlaceHolder()) ?>" value="<?php echo $m_gudang_add->kode_gudang->EditValue ?>"<?php echo $m_gudang_add->kode_gudang->editAttributes() ?>>
</span>
<?php echo $m_gudang_add->kode_gudang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_gudang_add->nama_gudang->Visible) { // nama_gudang ?>
	<div id="r_nama_gudang" class="form-group row">
		<label id="elh_m_gudang_nama_gudang" for="x_nama_gudang" class="<?php echo $m_gudang_add->LeftColumnClass ?>"><?php echo $m_gudang_add->nama_gudang->caption() ?><?php echo $m_gudang_add->nama_gudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_gudang_add->RightColumnClass ?>"><div <?php echo $m_gudang_add->nama_gudang->cellAttributes() ?>>
<span id="el_m_gudang_nama_gudang">
<input type="text" data-table="m_gudang" data-field="x_nama_gudang" name="x_nama_gudang" id="x_nama_gudang" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($m_gudang_add->nama_gudang->getPlaceHolder()) ?>" value="<?php echo $m_gudang_add->nama_gudang->EditValue ?>"<?php echo $m_gudang_add->nama_gudang->editAttributes() ?>>
</span>
<?php echo $m_gudang_add->nama_gudang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_gudang_add->lokasi_gudang->Visible) { // lokasi_gudang ?>
	<div id="r_lokasi_gudang" class="form-group row">
		<label id="elh_m_gudang_lokasi_gudang" for="x_lokasi_gudang" class="<?php echo $m_gudang_add->LeftColumnClass ?>"><?php echo $m_gudang_add->lokasi_gudang->caption() ?><?php echo $m_gudang_add->lokasi_gudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_gudang_add->RightColumnClass ?>"><div <?php echo $m_gudang_add->lokasi_gudang->cellAttributes() ?>>
<span id="el_m_gudang_lokasi_gudang">
<input type="text" data-table="m_gudang" data-field="x_lokasi_gudang" name="x_lokasi_gudang" id="x_lokasi_gudang" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_gudang_add->lokasi_gudang->getPlaceHolder()) ?>" value="<?php echo $m_gudang_add->lokasi_gudang->EditValue ?>"<?php echo $m_gudang_add->lokasi_gudang->editAttributes() ?>>
</span>
<?php echo $m_gudang_add->lokasi_gudang->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_gudang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_gudang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_gudang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_gudang_add->showPageFooter();
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
$m_gudang_add->terminate();
?>