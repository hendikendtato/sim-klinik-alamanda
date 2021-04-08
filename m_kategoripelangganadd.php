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
$m_kategoripelanggan_add = new m_kategoripelanggan_add();

// Run the page
$m_kategoripelanggan_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kategoripelanggan_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kategoripelangganadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_kategoripelangganadd = currentForm = new ew.Form("fm_kategoripelangganadd", "add");

	// Validate form
	fm_kategoripelangganadd.validate = function() {
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
			<?php if ($m_kategoripelanggan_add->nama_kategori->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_kategori");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_kategoripelanggan_add->nama_kategori->caption(), $m_kategoripelanggan_add->nama_kategori->RequiredErrorMessage)) ?>");
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
	fm_kategoripelangganadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_kategoripelangganadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fm_kategoripelangganadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kategoripelanggan_add->showPageHeader(); ?>
<?php
$m_kategoripelanggan_add->showMessage();
?>
<form name="fm_kategoripelangganadd" id="fm_kategoripelangganadd" class="<?php echo $m_kategoripelanggan_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kategoripelanggan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_kategoripelanggan_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_kategoripelanggan_add->nama_kategori->Visible) { // nama_kategori ?>
	<div id="r_nama_kategori" class="form-group row">
		<label id="elh_m_kategoripelanggan_nama_kategori" for="x_nama_kategori" class="<?php echo $m_kategoripelanggan_add->LeftColumnClass ?>"><?php echo $m_kategoripelanggan_add->nama_kategori->caption() ?><?php echo $m_kategoripelanggan_add->nama_kategori->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_kategoripelanggan_add->RightColumnClass ?>"><div <?php echo $m_kategoripelanggan_add->nama_kategori->cellAttributes() ?>>
<span id="el_m_kategoripelanggan_nama_kategori">
<input type="text" data-table="m_kategoripelanggan" data-field="x_nama_kategori" name="x_nama_kategori" id="x_nama_kategori" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_kategoripelanggan_add->nama_kategori->getPlaceHolder()) ?>" value="<?php echo $m_kategoripelanggan_add->nama_kategori->EditValue ?>"<?php echo $m_kategoripelanggan_add->nama_kategori->editAttributes() ?>>
</span>
<?php echo $m_kategoripelanggan_add->nama_kategori->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_kategoripelanggan_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_kategoripelanggan_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kategoripelanggan_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_kategoripelanggan_add->showPageFooter();
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
$m_kategoripelanggan_add->terminate();
?>