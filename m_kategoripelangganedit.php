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
$m_kategoripelanggan_edit = new m_kategoripelanggan_edit();

// Run the page
$m_kategoripelanggan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kategoripelanggan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kategoripelangganedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_kategoripelangganedit = currentForm = new ew.Form("fm_kategoripelangganedit", "edit");

	// Validate form
	fm_kategoripelangganedit.validate = function() {
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
			<?php if ($m_kategoripelanggan_edit->id_kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kategoripelanggan_edit->id_kategori->caption(), $m_kategoripelanggan_edit->id_kategori->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_kategoripelanggan_edit->nama_kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kategoripelanggan_edit->nama_kategori->caption(), $m_kategoripelanggan_edit->nama_kategori->RequiredErrorMessage)) ?>");
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
	fm_kategoripelangganedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_kategoripelangganedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_kategoripelangganedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kategoripelanggan_edit->showPageHeader(); ?>
<?php
$m_kategoripelanggan_edit->showMessage();
?>
<form name="fm_kategoripelangganedit" id="fm_kategoripelangganedit" class="<?php echo $m_kategoripelanggan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kategoripelanggan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_kategoripelanggan_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_kategoripelanggan_edit->id_kategori->Visible) { // id_kategori ?>
	<div id="r_id_kategori" class="form-group row">
		<label id="elh_m_kategoripelanggan_id_kategori" class="<?php echo $m_kategoripelanggan_edit->LeftColumnClass ?>"><?php echo $m_kategoripelanggan_edit->id_kategori->caption() ?><?php echo $m_kategoripelanggan_edit->id_kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kategoripelanggan_edit->RightColumnClass ?>"><div <?php echo $m_kategoripelanggan_edit->id_kategori->cellAttributes() ?>>
<span id="el_m_kategoripelanggan_id_kategori">
<span<?php echo $m_kategoripelanggan_edit->id_kategori->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_kategoripelanggan_edit->id_kategori->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_kategoripelanggan" data-field="x_id_kategori" name="x_id_kategori" id="x_id_kategori" value="<?php echo HtmlEncode($m_kategoripelanggan_edit->id_kategori->CurrentValue) ?>">
<?php echo $m_kategoripelanggan_edit->id_kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_kategoripelanggan_edit->nama_kategori->Visible) { // nama_kategori ?>
	<div id="r_nama_kategori" class="form-group row">
		<label id="elh_m_kategoripelanggan_nama_kategori" for="x_nama_kategori" class="<?php echo $m_kategoripelanggan_edit->LeftColumnClass ?>"><?php echo $m_kategoripelanggan_edit->nama_kategori->caption() ?><?php echo $m_kategoripelanggan_edit->nama_kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kategoripelanggan_edit->RightColumnClass ?>"><div <?php echo $m_kategoripelanggan_edit->nama_kategori->cellAttributes() ?>>
<span id="el_m_kategoripelanggan_nama_kategori">
<input type="text" data-table="m_kategoripelanggan" data-field="x_nama_kategori" name="x_nama_kategori" id="x_nama_kategori" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_kategoripelanggan_edit->nama_kategori->getPlaceHolder()) ?>" value="<?php echo $m_kategoripelanggan_edit->nama_kategori->EditValue ?>"<?php echo $m_kategoripelanggan_edit->nama_kategori->editAttributes() ?>>
</span>
<?php echo $m_kategoripelanggan_edit->nama_kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_kategoripelanggan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_kategoripelanggan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kategoripelanggan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_kategoripelanggan_edit->showPageFooter();
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
$m_kategoripelanggan_edit->terminate();
?>