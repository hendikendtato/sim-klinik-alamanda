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
$users_add = new users_add();

// Run the page
$users_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fusersadd = currentForm = new ew.Form("fusersadd", "add");

	// Validate form
	fusersadd.validate = function() {
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
			<?php if ($users_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->id_klinik->caption(), $users_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($users_add->id_klinik->errorMessage()) ?>");
			<?php if ($users_add->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->id_pegawai->caption(), $users_add->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->username->caption(), $users_add->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->userpwd->Required) { ?>
				elm = this.getElements("x" + infix + "_userpwd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->userpwd->caption(), $users_add->userpwd->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_add->level->Required) { ?>
				elm = this.getElements("x" + infix + "_level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_add->level->caption(), $users_add->level->RequiredErrorMessage)) ?>");
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
	fusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersadd.lists["x_id_klinik"] = <?php echo $users_add->id_klinik->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_id_klinik"].options = <?php echo JsonEncode($users_add->id_klinik->lookupOptions()) ?>;
	fusersadd.autoSuggests["x_id_klinik"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fusersadd.lists["x_id_pegawai"] = <?php echo $users_add->id_pegawai->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_id_pegawai"].options = <?php echo JsonEncode($users_add->id_pegawai->lookupOptions()) ?>;
	fusersadd.lists["x_level"] = <?php echo $users_add->level->Lookup->toClientList($users_add) ?>;
	fusersadd.lists["x_level"].options = <?php echo JsonEncode($users_add->level->lookupOptions()) ?>;
	loadjs.done("fusersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_add->showPageHeader(); ?>
<?php
$users_add->showMessage();
?>
<form name="fusersadd" id="fusersadd" class="<?php echo $users_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$users_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($users_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_users_id_klinik" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->id_klinik->caption() ?><?php echo $users_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->id_klinik->cellAttributes() ?>>
<span id="el_users_id_klinik">
<?php
$onchange = $users_add->id_klinik->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$users_add->id_klinik->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_klinik">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_klinik" id="sv_x_id_klinik" value="<?php echo RemoveHtml($users_add->id_klinik->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_add->id_klinik->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($users_add->id_klinik->getPlaceHolder()) ?>"<?php echo $users_add->id_klinik->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users_add->id_klinik->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_klinik',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($users_add->id_klinik->ReadOnly || $users_add->id_klinik->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="users" data-field="x_id_klinik" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users_add->id_klinik->displayValueSeparatorAttribute() ?>" name="x_id_klinik" id="x_id_klinik" value="<?php echo HtmlEncode($users_add->id_klinik->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fusersadd"], function() {
	fusersadd.createAutoSuggest({"id":"x_id_klinik","forceSelect":true});
});
</script>
<?php echo $users_add->id_klinik->Lookup->getParamTag($users_add, "p_x_id_klinik") ?>
</span>
<?php echo $users_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_users_id_pegawai" for="x_id_pegawai" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->id_pegawai->caption() ?><?php echo $users_add->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->id_pegawai->cellAttributes() ?>>
<span id="el_users_id_pegawai">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_pegawai"><?php echo EmptyValue(strval($users_add->id_pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $users_add->id_pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users_add->id_pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($users_add->id_pegawai->ReadOnly || $users_add->id_pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $users_add->id_pegawai->Lookup->getParamTag($users_add, "p_x_id_pegawai") ?>
<input type="hidden" data-table="users" data-field="x_id_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users_add->id_pegawai->displayValueSeparatorAttribute() ?>" name="x_id_pegawai" id="x_id_pegawai" value="<?php echo $users_add->id_pegawai->CurrentValue ?>"<?php echo $users_add->id_pegawai->editAttributes() ?>>
</span>
<?php echo $users_add->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_users_username" for="x_username" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->username->caption() ?><?php echo $users_add->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->username->cellAttributes() ?>>
<span id="el_users_username">
<input type="text" data-table="users" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($users_add->username->getPlaceHolder()) ?>" value="<?php echo $users_add->username->EditValue ?>"<?php echo $users_add->username->editAttributes() ?>>
</span>
<?php echo $users_add->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->userpwd->Visible) { // userpwd ?>
	<div id="r_userpwd" class="form-group row">
		<label id="elh_users_userpwd" for="x_userpwd" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->userpwd->caption() ?><?php echo $users_add->userpwd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->userpwd->cellAttributes() ?>>
<span id="el_users_userpwd">
<input type="text" data-table="users" data-field="x_userpwd" name="x_userpwd" id="x_userpwd" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($users_add->userpwd->getPlaceHolder()) ?>" value="<?php echo $users_add->userpwd->EditValue ?>"<?php echo $users_add->userpwd->editAttributes() ?>>
</span>
<?php echo $users_add->userpwd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_add->level->Visible) { // level ?>
	<div id="r_level" class="form-group row">
		<label id="elh_users_level" for="x_level" class="<?php echo $users_add->LeftColumnClass ?>"><?php echo $users_add->level->caption() ?><?php echo $users_add->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_add->RightColumnClass ?>"><div <?php echo $users_add->level->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_level">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_add->level->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_users_level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_level" data-value-separator="<?php echo $users_add->level->displayValueSeparatorAttribute() ?>" id="x_level" name="x_level"<?php echo $users_add->level->editAttributes() ?>>
			<?php echo $users_add->level->selectOptionListHtml("x_level") ?>
		</select>
</div>
<?php echo $users_add->level->Lookup->getParamTag($users_add, "p_x_level") ?>
</span>
<?php } ?>
<?php echo $users_add->level->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_add->showPageFooter();
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
$users_add->terminate();
?>