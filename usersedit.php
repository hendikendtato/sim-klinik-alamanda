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
$users_edit = new users_edit();

// Run the page
$users_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusersedit = currentForm = new ew.Form("fusersedit", "edit");

	// Validate form
	fusersedit.validate = function() {
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
			<?php if ($users_edit->_userid->Required) { ?>
				elm = this.getElements("x" + infix + "__userid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->_userid->caption(), $users_edit->_userid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->id_klinik->caption(), $users_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($users_edit->id_klinik->errorMessage()) ?>");
			<?php if ($users_edit->id_pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->id_pegawai->caption(), $users_edit->id_pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->username->caption(), $users_edit->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->userpwd->Required) { ?>
				elm = this.getElements("x" + infix + "_userpwd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->userpwd->caption(), $users_edit->userpwd->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($users_edit->level->Required) { ?>
				elm = this.getElements("x" + infix + "_level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $users_edit->level->caption(), $users_edit->level->RequiredErrorMessage)) ?>");
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
	fusersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusersedit.lists["x_id_klinik"] = <?php echo $users_edit->id_klinik->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_id_klinik"].options = <?php echo JsonEncode($users_edit->id_klinik->lookupOptions()) ?>;
	fusersedit.autoSuggests["x_id_klinik"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fusersedit.lists["x_id_pegawai"] = <?php echo $users_edit->id_pegawai->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_id_pegawai"].options = <?php echo JsonEncode($users_edit->id_pegawai->lookupOptions()) ?>;
	fusersedit.lists["x_level"] = <?php echo $users_edit->level->Lookup->toClientList($users_edit) ?>;
	fusersedit.lists["x_level"].options = <?php echo JsonEncode($users_edit->level->lookupOptions()) ?>;
	loadjs.done("fusersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $users_edit->showPageHeader(); ?>
<?php
$users_edit->showMessage();
?>
<form name="fusersedit" id="fusersedit" class="<?php echo $users_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$users_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($users_edit->_userid->Visible) { // userid ?>
	<div id="r__userid" class="form-group row">
		<label id="elh_users__userid" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->_userid->caption() ?><?php echo $users_edit->_userid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->_userid->cellAttributes() ?>>
<span id="el_users__userid">
<span<?php echo $users_edit->_userid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_edit->_userid->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="users" data-field="x__userid" name="x__userid" id="x__userid" value="<?php echo HtmlEncode($users_edit->_userid->CurrentValue) ?>">
<?php echo $users_edit->_userid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_users_id_klinik" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->id_klinik->caption() ?><?php echo $users_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->id_klinik->cellAttributes() ?>>
<span id="el_users_id_klinik">
<?php
$onchange = $users_edit->id_klinik->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$users_edit->id_klinik->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_klinik">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_klinik" id="sv_x_id_klinik" value="<?php echo RemoveHtml($users_edit->id_klinik->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($users_edit->id_klinik->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($users_edit->id_klinik->getPlaceHolder()) ?>"<?php echo $users_edit->id_klinik->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users_edit->id_klinik->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_klinik',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($users_edit->id_klinik->ReadOnly || $users_edit->id_klinik->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="users" data-field="x_id_klinik" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users_edit->id_klinik->displayValueSeparatorAttribute() ?>" name="x_id_klinik" id="x_id_klinik" value="<?php echo HtmlEncode($users_edit->id_klinik->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fusersedit"], function() {
	fusersedit.createAutoSuggest({"id":"x_id_klinik","forceSelect":true});
});
</script>
<?php echo $users_edit->id_klinik->Lookup->getParamTag($users_edit, "p_x_id_klinik") ?>
</span>
<?php echo $users_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->id_pegawai->Visible) { // id_pegawai ?>
	<div id="r_id_pegawai" class="form-group row">
		<label id="elh_users_id_pegawai" for="x_id_pegawai" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->id_pegawai->caption() ?><?php echo $users_edit->id_pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->id_pegawai->cellAttributes() ?>>
<span id="el_users_id_pegawai">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_pegawai"><?php echo EmptyValue(strval($users_edit->id_pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $users_edit->id_pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($users_edit->id_pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($users_edit->id_pegawai->ReadOnly || $users_edit->id_pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $users_edit->id_pegawai->Lookup->getParamTag($users_edit, "p_x_id_pegawai") ?>
<input type="hidden" data-table="users" data-field="x_id_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $users_edit->id_pegawai->displayValueSeparatorAttribute() ?>" name="x_id_pegawai" id="x_id_pegawai" value="<?php echo $users_edit->id_pegawai->CurrentValue ?>"<?php echo $users_edit->id_pegawai->editAttributes() ?>>
</span>
<?php echo $users_edit->id_pegawai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->username->Visible) { // username ?>
	<div id="r_username" class="form-group row">
		<label id="elh_users_username" for="x_username" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->username->caption() ?><?php echo $users_edit->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->username->cellAttributes() ?>>
<span id="el_users_username">
<input type="text" data-table="users" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($users_edit->username->getPlaceHolder()) ?>" value="<?php echo $users_edit->username->EditValue ?>"<?php echo $users_edit->username->editAttributes() ?>>
</span>
<?php echo $users_edit->username->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->userpwd->Visible) { // userpwd ?>
	<div id="r_userpwd" class="form-group row">
		<label id="elh_users_userpwd" for="x_userpwd" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->userpwd->caption() ?><?php echo $users_edit->userpwd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->userpwd->cellAttributes() ?>>
<span id="el_users_userpwd">
<input type="text" data-table="users" data-field="x_userpwd" name="x_userpwd" id="x_userpwd" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($users_edit->userpwd->getPlaceHolder()) ?>" value="<?php echo $users_edit->userpwd->EditValue ?>"<?php echo $users_edit->userpwd->editAttributes() ?>>
</span>
<?php echo $users_edit->userpwd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($users_edit->level->Visible) { // level ?>
	<div id="r_level" class="form-group row">
		<label id="elh_users_level" for="x_level" class="<?php echo $users_edit->LeftColumnClass ?>"><?php echo $users_edit->level->caption() ?><?php echo $users_edit->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $users_edit->RightColumnClass ?>"><div <?php echo $users_edit->level->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_users_level">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($users_edit->level->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_users_level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="users" data-field="x_level" data-value-separator="<?php echo $users_edit->level->displayValueSeparatorAttribute() ?>" id="x_level" name="x_level"<?php echo $users_edit->level->editAttributes() ?>>
			<?php echo $users_edit->level->selectOptionListHtml("x_level") ?>
		</select>
</div>
<?php echo $users_edit->level->Lookup->getParamTag($users_edit, "p_x_level") ?>
</span>
<?php } ?>
<?php echo $users_edit->level->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$users_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $users_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $users_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$users_edit->showPageFooter();
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
$users_edit->terminate();
?>