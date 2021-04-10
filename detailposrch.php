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
$detailpo_search = new detailpo_search();

// Run the page
$detailpo_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdetailposearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($detailpo_search->IsModal) { ?>
	fdetailposearch = currentAdvancedSearchForm = new ew.Form("fdetailposearch", "search");
	<?php } else { ?>
	fdetailposearch = currentForm = new ew.Form("fdetailposearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fdetailposearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_id_detailpo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->id_detailpo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_pid_detailpo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->pid_detailpo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_qty");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->qty->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_harga");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->harga->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_diskon");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->diskon->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_pajak");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->pajak->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_total");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($detailpo_search->total->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fdetailposearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdetailposearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdetailposearch.lists["x_idbarang"] = <?php echo $detailpo_search->idbarang->Lookup->toClientList($detailpo_search) ?>;
	fdetailposearch.lists["x_idbarang"].options = <?php echo JsonEncode($detailpo_search->idbarang->lookupOptions()) ?>;
	fdetailposearch.lists["x_satuan"] = <?php echo $detailpo_search->satuan->Lookup->toClientList($detailpo_search) ?>;
	fdetailposearch.lists["x_satuan"].options = <?php echo JsonEncode($detailpo_search->satuan->lookupOptions()) ?>;
	loadjs.done("fdetailposearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $detailpo_search->showPageHeader(); ?>
<?php
$detailpo_search->showMessage();
?>
<form name="fdetailposearch" id="fdetailposearch" class="<?php echo $detailpo_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpo">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$detailpo_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($detailpo_search->id_detailpo->Visible) { // id_detailpo ?>
	<div id="r_id_detailpo" class="form-group row">
		<label for="x_id_detailpo" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_id_detailpo"><?php echo $detailpo_search->id_detailpo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_detailpo" id="z_id_detailpo" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->id_detailpo->cellAttributes() ?>>
			<span id="el_detailpo_id_detailpo" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_id_detailpo" name="x_id_detailpo" id="x_id_detailpo" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_search->id_detailpo->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->id_detailpo->EditValue ?>"<?php echo $detailpo_search->id_detailpo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->pid_detailpo->Visible) { // pid_detailpo ?>
	<div id="r_pid_detailpo" class="form-group row">
		<label for="x_pid_detailpo" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_pid_detailpo"><?php echo $detailpo_search->pid_detailpo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_pid_detailpo" id="z_pid_detailpo" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->pid_detailpo->cellAttributes() ?>>
			<span id="el_detailpo_pid_detailpo" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_pid_detailpo" name="x_pid_detailpo" id="x_pid_detailpo" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_search->pid_detailpo->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->pid_detailpo->EditValue ?>"<?php echo $detailpo_search->pid_detailpo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->idbarang->Visible) { // idbarang ?>
	<div id="r_idbarang" class="form-group row">
		<label for="x_idbarang" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_idbarang"><?php echo $detailpo_search->idbarang->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_idbarang" id="z_idbarang" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->idbarang->cellAttributes() ?>>
			<span id="el_detailpo_idbarang" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_idbarang"><?php echo EmptyValue(strval($detailpo_search->idbarang->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $detailpo_search->idbarang->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($detailpo_search->idbarang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($detailpo_search->idbarang->ReadOnly || $detailpo_search->idbarang->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_idbarang',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $detailpo_search->idbarang->Lookup->getParamTag($detailpo_search, "p_x_idbarang") ?>
<input type="hidden" data-table="detailpo" data-field="x_idbarang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $detailpo_search->idbarang->displayValueSeparatorAttribute() ?>" name="x_idbarang" id="x_idbarang" value="<?php echo $detailpo_search->idbarang->AdvancedSearch->SearchValue ?>"<?php echo $detailpo_search->idbarang->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->part->Visible) { // part ?>
	<div id="r_part" class="form-group row">
		<label for="x_part" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_part"><?php echo $detailpo_search->part->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_part" id="z_part" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->part->cellAttributes() ?>>
			<span id="el_detailpo_part" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_part" name="x_part" id="x_part" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailpo_search->part->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->part->EditValue ?>"<?php echo $detailpo_search->part->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->lot->Visible) { // lot ?>
	<div id="r_lot" class="form-group row">
		<label for="x_lot" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_lot"><?php echo $detailpo_search->lot->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_lot" id="z_lot" value="LIKE">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->lot->cellAttributes() ?>>
			<span id="el_detailpo_lot" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_lot" name="x_lot" id="x_lot" size="10" maxlength="100" placeholder="<?php echo HtmlEncode($detailpo_search->lot->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->lot->EditValue ?>"<?php echo $detailpo_search->lot->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->qty->Visible) { // qty ?>
	<div id="r_qty" class="form-group row">
		<label for="x_qty" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_qty"><?php echo $detailpo_search->qty->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_qty" id="z_qty" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->qty->cellAttributes() ?>>
			<span id="el_detailpo_qty" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_qty" name="x_qty" id="x_qty" size="5" maxlength="11" placeholder="<?php echo HtmlEncode($detailpo_search->qty->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->qty->EditValue ?>"<?php echo $detailpo_search->qty->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->harga->Visible) { // harga ?>
	<div id="r_harga" class="form-group row">
		<label for="x_harga" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_harga"><?php echo $detailpo_search->harga->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_harga" id="z_harga" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->harga->cellAttributes() ?>>
			<span id="el_detailpo_harga" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_harga" name="x_harga" id="x_harga" size="5" maxlength="22" placeholder="<?php echo HtmlEncode($detailpo_search->harga->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->harga->EditValue ?>"<?php echo $detailpo_search->harga->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->satuan->Visible) { // satuan ?>
	<div id="r_satuan" class="form-group row">
		<label for="x_satuan" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_satuan"><?php echo $detailpo_search->satuan->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_satuan" id="z_satuan" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->satuan->cellAttributes() ?>>
			<span id="el_detailpo_satuan" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="detailpo" data-field="x_satuan" data-value-separator="<?php echo $detailpo_search->satuan->displayValueSeparatorAttribute() ?>" id="x_satuan" name="x_satuan"<?php echo $detailpo_search->satuan->editAttributes() ?>>
			<?php echo $detailpo_search->satuan->selectOptionListHtml("x_satuan") ?>
		</select>
</div>
<?php echo $detailpo_search->satuan->Lookup->getParamTag($detailpo_search, "p_x_satuan") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->diskon->Visible) { // diskon ?>
	<div id="r_diskon" class="form-group row">
		<label for="x_diskon" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_diskon"><?php echo $detailpo_search->diskon->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_diskon" id="z_diskon" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->diskon->cellAttributes() ?>>
			<span id="el_detailpo_diskon" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_diskon" name="x_diskon" id="x_diskon" size="3" maxlength="10" placeholder="<?php echo HtmlEncode($detailpo_search->diskon->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->diskon->EditValue ?>"<?php echo $detailpo_search->diskon->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->pajak->Visible) { // pajak ?>
	<div id="r_pajak" class="form-group row">
		<label for="x_pajak" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_pajak"><?php echo $detailpo_search->pajak->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_pajak" id="z_pajak" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->pajak->cellAttributes() ?>>
			<span id="el_detailpo_pajak" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_pajak" name="x_pajak" id="x_pajak" size="5" maxlength="22" placeholder="<?php echo HtmlEncode($detailpo_search->pajak->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->pajak->EditValue ?>"<?php echo $detailpo_search->pajak->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($detailpo_search->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label for="x_total" class="<?php echo $detailpo_search->LeftColumnClass ?>"><span id="elh_detailpo_total"><?php echo $detailpo_search->total->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_total" id="z_total" value="=">
</span>
		</label>
		<div class="<?php echo $detailpo_search->RightColumnClass ?>"><div <?php echo $detailpo_search->total->cellAttributes() ?>>
			<span id="el_detailpo_total" class="ew-search-field">
<input type="text" data-table="detailpo" data-field="x_total" name="x_total" id="x_total" size="5" maxlength="22" placeholder="<?php echo HtmlEncode($detailpo_search->total->getPlaceHolder()) ?>" value="<?php echo $detailpo_search->total->EditValue ?>"<?php echo $detailpo_search->total->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$detailpo_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $detailpo_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$detailpo_search->showPageFooter();
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
$detailpo_search->terminate();
?>