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
$V_kartustok_search = new V_kartustok_search();

// Run the page
$V_kartustok_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$V_kartustok_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fV_kartustoksearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($V_kartustok_search->IsModal) { ?>
	fV_kartustoksearch = currentAdvancedSearchForm = new ew.Form("fV_kartustoksearch", "search");
	<?php } else { ?>
	fV_kartustoksearch = currentForm = new ew.Form("fV_kartustoksearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fV_kartustoksearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fV_kartustoksearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fV_kartustoksearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fV_kartustoksearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $V_kartustok_search->showPageHeader(); ?>
<?php
$V_kartustok_search->showMessage();
?>
<form name="fV_kartustoksearch" id="fV_kartustoksearch" class="<?php echo $V_kartustok_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="V_kartustok">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$V_kartustok_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($V_kartustok_search->nama_barang->Visible) { // nama_barang ?>
	<div id="r_nama_barang" class="form-group row">
		<label for="x_nama_barang" class="<?php echo $V_kartustok_search->LeftColumnClass ?>"><span id="elh_V_kartustok_nama_barang"><?php echo $V_kartustok_search->nama_barang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama_barang" id="z_nama_barang" value="LIKE">
</span>
		</label>
		<div class="<?php echo $V_kartustok_search->RightColumnClass ?>"><div <?php echo $V_kartustok_search->nama_barang->cellAttributes() ?>>
			<span id="el_V_kartustok_nama_barang" class="ew-search-field">
<input type="text" data-table="V_kartustok" data-field="x_nama_barang" name="x_nama_barang" id="x_nama_barang" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($V_kartustok_search->nama_barang->getPlaceHolder()) ?>" value="<?php echo $V_kartustok_search->nama_barang->EditValue ?>"<?php echo $V_kartustok_search->nama_barang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$V_kartustok_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $V_kartustok_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$V_kartustok_search->showPageFooter();
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
$V_kartustok_search->terminate();
?>