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
$m_member_edit = new m_member_edit();

// Run the page
$m_member_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_member_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_memberedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fm_memberedit = currentForm = new ew.Form("fm_memberedit", "edit");

	// Validate form
	fm_memberedit.validate = function() {
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
			<?php if ($m_member_edit->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->id->caption(), $m_member_edit->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_member_edit->kode_member->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->kode_member->caption(), $m_member_edit->kode_member->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_member_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->id_klinik->caption(), $m_member_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_member_edit->id_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->id_pelanggan->caption(), $m_member_edit->id_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_member_edit->jenis_member->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->jenis_member->caption(), $m_member_edit->jenis_member->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_member_edit->tgl_mulai->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->tgl_mulai->caption(), $m_member_edit->tgl_mulai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_mulai");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_member_edit->tgl_mulai->errorMessage()) ?>");
			<?php if ($m_member_edit->tgl_akhir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_akhir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->tgl_akhir->caption(), $m_member_edit->tgl_akhir->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_member_edit->poin_member->Required) { ?>
				elm = this.getElements("x" + infix + "_poin_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->poin_member->caption(), $m_member_edit->poin_member->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_poin_member");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_member_edit->poin_member->errorMessage()) ?>");
			<?php if ($m_member_edit->tgl_awal_transaksi->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_awal_transaksi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->tgl_awal_transaksi->caption(), $m_member_edit->tgl_awal_transaksi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_awal_transaksi");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_member_edit->tgl_awal_transaksi->errorMessage()) ?>");
			<?php if ($m_member_edit->total_akumulasi->Required) { ?>
				elm = this.getElements("x" + infix + "_total_akumulasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_member_edit->total_akumulasi->caption(), $m_member_edit->total_akumulasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_akumulasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_member_edit->total_akumulasi->errorMessage()) ?>");

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
	fm_memberedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_memberedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_memberedit.lists["x_id_klinik"] = <?php echo $m_member_edit->id_klinik->Lookup->toClientList($m_member_edit) ?>;
	fm_memberedit.lists["x_id_klinik"].options = <?php echo JsonEncode($m_member_edit->id_klinik->lookupOptions()) ?>;
	fm_memberedit.lists["x_id_pelanggan"] = <?php echo $m_member_edit->id_pelanggan->Lookup->toClientList($m_member_edit) ?>;
	fm_memberedit.lists["x_id_pelanggan"].options = <?php echo JsonEncode($m_member_edit->id_pelanggan->lookupOptions()) ?>;
	fm_memberedit.lists["x_jenis_member"] = <?php echo $m_member_edit->jenis_member->Lookup->toClientList($m_member_edit) ?>;
	fm_memberedit.lists["x_jenis_member"].options = <?php echo JsonEncode($m_member_edit->jenis_member->lookupOptions()) ?>;
	loadjs.done("fm_memberedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	var now=new Date,day=("0"+now.getDate()).slice(-2),month=("0"+(now.getMonth()+1)).slice(-2),today=day+"/"+month+"/"+now.getFullYear();$("input#x_tgl_mulai").val(today);
});
</script>
<?php $m_member_edit->showPageHeader(); ?>
<?php
$m_member_edit->showMessage();
?>
<form name="fm_memberedit" id="fm_memberedit" class="<?php echo $m_member_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_member">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$m_member_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($m_member_edit->id->Visible) { // id ?>
	<div id="r_id" class="form-group row">
		<label id="elh_m_member_id" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->id->caption() ?><?php echo $m_member_edit->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->id->cellAttributes() ?>>
<span id="el_m_member_id">
<span<?php echo $m_member_edit->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($m_member_edit->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="m_member" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($m_member_edit->id->CurrentValue) ?>">
<?php echo $m_member_edit->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->kode_member->Visible) { // kode_member ?>
	<div id="r_kode_member" class="form-group row">
		<label id="elh_m_member_kode_member" for="x_kode_member" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->kode_member->caption() ?><?php echo $m_member_edit->kode_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->kode_member->cellAttributes() ?>>
<span id="el_m_member_kode_member">
<input type="text" data-table="m_member" data-field="x_kode_member" name="x_kode_member" id="x_kode_member" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_member_edit->kode_member->getPlaceHolder()) ?>" value="<?php echo $m_member_edit->kode_member->EditValue ?>"<?php echo $m_member_edit->kode_member->editAttributes() ?>>
</span>
<?php echo $m_member_edit->kode_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_m_member_id_klinik" for="x_id_klinik" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->id_klinik->caption() ?><?php echo $m_member_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->id_klinik->cellAttributes() ?>>
<span id="el_m_member_id_klinik">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_member" data-field="x_id_klinik" data-value-separator="<?php echo $m_member_edit->id_klinik->displayValueSeparatorAttribute() ?>" id="x_id_klinik" name="x_id_klinik"<?php echo $m_member_edit->id_klinik->editAttributes() ?>>
			<?php echo $m_member_edit->id_klinik->selectOptionListHtml("x_id_klinik") ?>
		</select>
</div>
<?php echo $m_member_edit->id_klinik->Lookup->getParamTag($m_member_edit, "p_x_id_klinik") ?>
</span>
<?php echo $m_member_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label id="elh_m_member_id_pelanggan" for="x_id_pelanggan" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->id_pelanggan->caption() ?><?php echo $m_member_edit->id_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->id_pelanggan->cellAttributes() ?>>
<span id="el_m_member_id_pelanggan">
<?php $m_member_edit->id_pelanggan->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_id_pelanggan"><?php echo EmptyValue(strval($m_member_edit->id_pelanggan->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_member_edit->id_pelanggan->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_member_edit->id_pelanggan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_member_edit->id_pelanggan->ReadOnly || $m_member_edit->id_pelanggan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_id_pelanggan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_member_edit->id_pelanggan->Lookup->getParamTag($m_member_edit, "p_x_id_pelanggan") ?>
<input type="hidden" data-table="m_member" data-field="x_id_pelanggan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_member_edit->id_pelanggan->displayValueSeparatorAttribute() ?>" name="x_id_pelanggan" id="x_id_pelanggan" value="<?php echo $m_member_edit->id_pelanggan->CurrentValue ?>"<?php echo $m_member_edit->id_pelanggan->editAttributes() ?>>
</span>
<?php echo $m_member_edit->id_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->jenis_member->Visible) { // jenis_member ?>
	<div id="r_jenis_member" class="form-group row">
		<label id="elh_m_member_jenis_member" for="x_jenis_member" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->jenis_member->caption() ?><?php echo $m_member_edit->jenis_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->jenis_member->cellAttributes() ?>>
<span id="el_m_member_jenis_member">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_member" data-field="x_jenis_member" data-value-separator="<?php echo $m_member_edit->jenis_member->displayValueSeparatorAttribute() ?>" id="x_jenis_member" name="x_jenis_member"<?php echo $m_member_edit->jenis_member->editAttributes() ?>>
			<?php echo $m_member_edit->jenis_member->selectOptionListHtml("x_jenis_member") ?>
		</select>
</div>
<?php echo $m_member_edit->jenis_member->Lookup->getParamTag($m_member_edit, "p_x_jenis_member") ?>
</span>
<?php echo $m_member_edit->jenis_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->tgl_mulai->Visible) { // tgl_mulai ?>
	<div id="r_tgl_mulai" class="form-group row">
		<label id="elh_m_member_tgl_mulai" for="x_tgl_mulai" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->tgl_mulai->caption() ?><?php echo $m_member_edit->tgl_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->tgl_mulai->cellAttributes() ?>>
<span id="el_m_member_tgl_mulai">
<input type="text" data-table="m_member" data-field="x_tgl_mulai" data-format="7" name="x_tgl_mulai" id="x_tgl_mulai" maxlength="19" placeholder="<?php echo HtmlEncode($m_member_edit->tgl_mulai->getPlaceHolder()) ?>" value="<?php echo $m_member_edit->tgl_mulai->EditValue ?>"<?php echo $m_member_edit->tgl_mulai->editAttributes() ?>>
<?php if (!$m_member_edit->tgl_mulai->ReadOnly && !$m_member_edit->tgl_mulai->Disabled && !isset($m_member_edit->tgl_mulai->EditAttrs["readonly"]) && !isset($m_member_edit->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_memberedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_memberedit", "x_tgl_mulai", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $m_member_edit->tgl_mulai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->tgl_akhir->Visible) { // tgl_akhir ?>
	<div id="r_tgl_akhir" class="form-group row">
		<label id="elh_m_member_tgl_akhir" for="x_tgl_akhir" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->tgl_akhir->caption() ?><?php echo $m_member_edit->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->tgl_akhir->cellAttributes() ?>>
<span id="el_m_member_tgl_akhir">
<input type="text" data-table="m_member" data-field="x_tgl_akhir" data-format="7" name="x_tgl_akhir" id="x_tgl_akhir" maxlength="19" placeholder="<?php echo HtmlEncode($m_member_edit->tgl_akhir->getPlaceHolder()) ?>" value="<?php echo $m_member_edit->tgl_akhir->EditValue ?>"<?php echo $m_member_edit->tgl_akhir->editAttributes() ?>>
<?php if (!$m_member_edit->tgl_akhir->ReadOnly && !$m_member_edit->tgl_akhir->Disabled && !isset($m_member_edit->tgl_akhir->EditAttrs["readonly"]) && !isset($m_member_edit->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_memberedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_memberedit", "x_tgl_akhir", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $m_member_edit->tgl_akhir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->poin_member->Visible) { // poin_member ?>
	<div id="r_poin_member" class="form-group row">
		<label id="elh_m_member_poin_member" for="x_poin_member" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->poin_member->caption() ?><?php echo $m_member_edit->poin_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->poin_member->cellAttributes() ?>>
<span id="el_m_member_poin_member">
<input type="text" data-table="m_member" data-field="x_poin_member" name="x_poin_member" id="x_poin_member" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($m_member_edit->poin_member->getPlaceHolder()) ?>" value="<?php echo $m_member_edit->poin_member->EditValue ?>"<?php echo $m_member_edit->poin_member->editAttributes() ?>>
</span>
<?php echo $m_member_edit->poin_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
	<div id="r_tgl_awal_transaksi" class="form-group row">
		<label id="elh_m_member_tgl_awal_transaksi" for="x_tgl_awal_transaksi" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->tgl_awal_transaksi->caption() ?><?php echo $m_member_edit->tgl_awal_transaksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->tgl_awal_transaksi->cellAttributes() ?>>
<span id="el_m_member_tgl_awal_transaksi">
<input type="text" data-table="m_member" data-field="x_tgl_awal_transaksi" name="x_tgl_awal_transaksi" id="x_tgl_awal_transaksi" maxlength="10" placeholder="<?php echo HtmlEncode($m_member_edit->tgl_awal_transaksi->getPlaceHolder()) ?>" value="<?php echo $m_member_edit->tgl_awal_transaksi->EditValue ?>"<?php echo $m_member_edit->tgl_awal_transaksi->editAttributes() ?>>
<?php if (!$m_member_edit->tgl_awal_transaksi->ReadOnly && !$m_member_edit->tgl_awal_transaksi->Disabled && !isset($m_member_edit->tgl_awal_transaksi->EditAttrs["readonly"]) && !isset($m_member_edit->tgl_awal_transaksi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fm_memberedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fm_memberedit", "x_tgl_awal_transaksi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $m_member_edit->tgl_awal_transaksi->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_member_edit->total_akumulasi->Visible) { // total_akumulasi ?>
	<div id="r_total_akumulasi" class="form-group row">
		<label id="elh_m_member_total_akumulasi" for="x_total_akumulasi" class="<?php echo $m_member_edit->LeftColumnClass ?>"><?php echo $m_member_edit->total_akumulasi->caption() ?><?php echo $m_member_edit->total_akumulasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_member_edit->RightColumnClass ?>"><div <?php echo $m_member_edit->total_akumulasi->cellAttributes() ?>>
<span id="el_m_member_total_akumulasi">
<input type="text" data-table="m_member" data-field="x_total_akumulasi" name="x_total_akumulasi" id="x_total_akumulasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_member_edit->total_akumulasi->getPlaceHolder()) ?>" value="<?php echo $m_member_edit->total_akumulasi->EditValue ?>"<?php echo $m_member_edit->total_akumulasi->editAttributes() ?>>
</span>
<?php echo $m_member_edit->total_akumulasi->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_member_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_member_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_member_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_member_edit->showPageFooter();
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
$m_member_edit->terminate();
?>