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
$m_jenis_member_add = new m_jenis_member_add();

// Run the page
$m_jenis_member_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jenis_member_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_jenis_memberadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fm_jenis_memberadd = currentForm = new ew.Form("fm_jenis_memberadd", "add");

	// Validate form
	fm_jenis_memberadd.validate = function() {
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
			<?php if ($m_jenis_member_add->nama_member->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->nama_member->caption(), $m_jenis_member_add->nama_member->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jenis_member_add->member_selanjutnya->Required) { ?>
				elm = this.getElements("x" + infix + "_member_selanjutnya");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->member_selanjutnya->caption(), $m_jenis_member_add->member_selanjutnya->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($m_jenis_member_add->nominal_bawah->Required) { ?>
				elm = this.getElements("x" + infix + "_nominal_bawah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->nominal_bawah->caption(), $m_jenis_member_add->nominal_bawah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nominal_bawah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->nominal_bawah->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->nominal_atas->Required) { ?>
				elm = this.getElements("x" + infix + "_nominal_atas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->nominal_atas->caption(), $m_jenis_member_add->nominal_atas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nominal_atas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->nominal_atas->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->qty_bawah->Required) { ?>
				elm = this.getElements("x" + infix + "_qty_bawah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->qty_bawah->caption(), $m_jenis_member_add->qty_bawah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty_bawah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->qty_bawah->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->qty_atas->Required) { ?>
				elm = this.getElements("x" + infix + "_qty_atas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->qty_atas->caption(), $m_jenis_member_add->qty_atas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_qty_atas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->qty_atas->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->disc_prosen->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_prosen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->disc_prosen->caption(), $m_jenis_member_add->disc_prosen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_prosen");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->disc_prosen->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->disc_nominal->Required) { ?>
				elm = this.getElements("x" + infix + "_disc_nominal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->disc_nominal->caption(), $m_jenis_member_add->disc_nominal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_disc_nominal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->disc_nominal->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->jangka_waktu->Required) { ?>
				elm = this.getElements("x" + infix + "_jangka_waktu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->jangka_waktu->caption(), $m_jenis_member_add->jangka_waktu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jangka_waktu");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->jangka_waktu->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->min_kedatangan->Required) { ?>
				elm = this.getElements("x" + infix + "_min_kedatangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->min_kedatangan->caption(), $m_jenis_member_add->min_kedatangan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_min_kedatangan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->min_kedatangan->errorMessage()) ?>");
			<?php if ($m_jenis_member_add->poin_member->Required) { ?>
				elm = this.getElements("x" + infix + "_poin_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $m_jenis_member_add->poin_member->caption(), $m_jenis_member_add->poin_member->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_poin_member");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($m_jenis_member_add->poin_member->errorMessage()) ?>");

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
	fm_jenis_memberadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_jenis_memberadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_jenis_memberadd.lists["x_member_selanjutnya"] = <?php echo $m_jenis_member_add->member_selanjutnya->Lookup->toClientList($m_jenis_member_add) ?>;
	fm_jenis_memberadd.lists["x_member_selanjutnya"].options = <?php echo JsonEncode($m_jenis_member_add->member_selanjutnya->lookupOptions()) ?>;
	loadjs.done("fm_jenis_memberadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	var now=new Date((new Date).getTime()+0),day=("0"+now.getDate()).slice(-2),month=("0"+(now.getMonth()+1)).slice(-2),today=day+"/"+month+"/"+now.getFullYear();console.log(now.getFullYear()),$("input#x_tgl_mulai").val(today),$("[data-field=x_jenis_member]").change(function(){var e=$(this).val();axios.get(`api/?action=view&object=m_jenis_member&id_jenis_member=${e}`).then(function(e){console.log(e.data);var t=e.data.m_jenis_member.jangka_waktu,a=new Date((new Date).getTime()+24*t*60*60*1e3),n=("0"+a.getDate()).slice(-2)+"/"+("0"+(a.getMonth()+1)).slice(-2)+"/"+a.getFullYear();$("input#x_tgl_akhir").val(n),console.log(t)}).catch(function(e){console.log(e)})});
});
</script>
<?php $m_jenis_member_add->showPageHeader(); ?>
<?php
$m_jenis_member_add->showMessage();
?>
<form name="fm_jenis_memberadd" id="fm_jenis_memberadd" class="<?php echo $m_jenis_member_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jenis_member">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$m_jenis_member_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($m_jenis_member_add->nama_member->Visible) { // nama_member ?>
	<div id="r_nama_member" class="form-group row">
		<label id="elh_m_jenis_member_nama_member" for="x_nama_member" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->nama_member->caption() ?><?php echo $m_jenis_member_add->nama_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->nama_member->cellAttributes() ?>>
<span id="el_m_jenis_member_nama_member">
<input type="text" data-table="m_jenis_member" data-field="x_nama_member" name="x_nama_member" id="x_nama_member" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($m_jenis_member_add->nama_member->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->nama_member->EditValue ?>"<?php echo $m_jenis_member_add->nama_member->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->nama_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->member_selanjutnya->Visible) { // member_selanjutnya ?>
	<div id="r_member_selanjutnya" class="form-group row">
		<label id="elh_m_jenis_member_member_selanjutnya" for="x_member_selanjutnya" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->member_selanjutnya->caption() ?><?php echo $m_jenis_member_add->member_selanjutnya->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->member_selanjutnya->cellAttributes() ?>>
<span id="el_m_jenis_member_member_selanjutnya">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="m_jenis_member" data-field="x_member_selanjutnya" data-value-separator="<?php echo $m_jenis_member_add->member_selanjutnya->displayValueSeparatorAttribute() ?>" id="x_member_selanjutnya" name="x_member_selanjutnya"<?php echo $m_jenis_member_add->member_selanjutnya->editAttributes() ?>>
			<?php echo $m_jenis_member_add->member_selanjutnya->selectOptionListHtml("x_member_selanjutnya") ?>
		</select>
</div>
<?php echo $m_jenis_member_add->member_selanjutnya->Lookup->getParamTag($m_jenis_member_add, "p_x_member_selanjutnya") ?>
</span>
<?php echo $m_jenis_member_add->member_selanjutnya->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->nominal_bawah->Visible) { // nominal_bawah ?>
	<div id="r_nominal_bawah" class="form-group row">
		<label id="elh_m_jenis_member_nominal_bawah" for="x_nominal_bawah" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->nominal_bawah->caption() ?><?php echo $m_jenis_member_add->nominal_bawah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->nominal_bawah->cellAttributes() ?>>
<span id="el_m_jenis_member_nominal_bawah">
<input type="text" data-table="m_jenis_member" data-field="x_nominal_bawah" name="x_nominal_bawah" id="x_nominal_bawah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->nominal_bawah->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->nominal_bawah->EditValue ?>"<?php echo $m_jenis_member_add->nominal_bawah->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->nominal_bawah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->nominal_atas->Visible) { // nominal_atas ?>
	<div id="r_nominal_atas" class="form-group row">
		<label id="elh_m_jenis_member_nominal_atas" for="x_nominal_atas" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->nominal_atas->caption() ?><?php echo $m_jenis_member_add->nominal_atas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->nominal_atas->cellAttributes() ?>>
<span id="el_m_jenis_member_nominal_atas">
<input type="text" data-table="m_jenis_member" data-field="x_nominal_atas" name="x_nominal_atas" id="x_nominal_atas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->nominal_atas->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->nominal_atas->EditValue ?>"<?php echo $m_jenis_member_add->nominal_atas->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->nominal_atas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->qty_bawah->Visible) { // qty_bawah ?>
	<div id="r_qty_bawah" class="form-group row">
		<label id="elh_m_jenis_member_qty_bawah" for="x_qty_bawah" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->qty_bawah->caption() ?><?php echo $m_jenis_member_add->qty_bawah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->qty_bawah->cellAttributes() ?>>
<span id="el_m_jenis_member_qty_bawah">
<input type="text" data-table="m_jenis_member" data-field="x_qty_bawah" name="x_qty_bawah" id="x_qty_bawah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->qty_bawah->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->qty_bawah->EditValue ?>"<?php echo $m_jenis_member_add->qty_bawah->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->qty_bawah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->qty_atas->Visible) { // qty_atas ?>
	<div id="r_qty_atas" class="form-group row">
		<label id="elh_m_jenis_member_qty_atas" for="x_qty_atas" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->qty_atas->caption() ?><?php echo $m_jenis_member_add->qty_atas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->qty_atas->cellAttributes() ?>>
<span id="el_m_jenis_member_qty_atas">
<input type="text" data-table="m_jenis_member" data-field="x_qty_atas" name="x_qty_atas" id="x_qty_atas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->qty_atas->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->qty_atas->EditValue ?>"<?php echo $m_jenis_member_add->qty_atas->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->qty_atas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->disc_prosen->Visible) { // disc_prosen ?>
	<div id="r_disc_prosen" class="form-group row">
		<label id="elh_m_jenis_member_disc_prosen" for="x_disc_prosen" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->disc_prosen->caption() ?><?php echo $m_jenis_member_add->disc_prosen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->disc_prosen->cellAttributes() ?>>
<span id="el_m_jenis_member_disc_prosen">
<input type="text" data-table="m_jenis_member" data-field="x_disc_prosen" name="x_disc_prosen" id="x_disc_prosen" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($m_jenis_member_add->disc_prosen->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->disc_prosen->EditValue ?>"<?php echo $m_jenis_member_add->disc_prosen->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->disc_prosen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->disc_nominal->Visible) { // disc_nominal ?>
	<div id="r_disc_nominal" class="form-group row">
		<label id="elh_m_jenis_member_disc_nominal" for="x_disc_nominal" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->disc_nominal->caption() ?><?php echo $m_jenis_member_add->disc_nominal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->disc_nominal->cellAttributes() ?>>
<span id="el_m_jenis_member_disc_nominal">
<input type="text" data-table="m_jenis_member" data-field="x_disc_nominal" name="x_disc_nominal" id="x_disc_nominal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->disc_nominal->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->disc_nominal->EditValue ?>"<?php echo $m_jenis_member_add->disc_nominal->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->disc_nominal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->jangka_waktu->Visible) { // jangka_waktu ?>
	<div id="r_jangka_waktu" class="form-group row">
		<label id="elh_m_jenis_member_jangka_waktu" for="x_jangka_waktu" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->jangka_waktu->caption() ?><?php echo $m_jenis_member_add->jangka_waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->jangka_waktu->cellAttributes() ?>>
<span id="el_m_jenis_member_jangka_waktu">
<input type="text" data-table="m_jenis_member" data-field="x_jangka_waktu" name="x_jangka_waktu" id="x_jangka_waktu" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->jangka_waktu->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->jangka_waktu->EditValue ?>"<?php echo $m_jenis_member_add->jangka_waktu->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->jangka_waktu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->min_kedatangan->Visible) { // min_kedatangan ?>
	<div id="r_min_kedatangan" class="form-group row">
		<label id="elh_m_jenis_member_min_kedatangan" for="x_min_kedatangan" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->min_kedatangan->caption() ?><?php echo $m_jenis_member_add->min_kedatangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->min_kedatangan->cellAttributes() ?>>
<span id="el_m_jenis_member_min_kedatangan">
<input type="text" data-table="m_jenis_member" data-field="x_min_kedatangan" name="x_min_kedatangan" id="x_min_kedatangan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->min_kedatangan->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->min_kedatangan->EditValue ?>"<?php echo $m_jenis_member_add->min_kedatangan->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->min_kedatangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($m_jenis_member_add->poin_member->Visible) { // poin_member ?>
	<div id="r_poin_member" class="form-group row">
		<label id="elh_m_jenis_member_poin_member" for="x_poin_member" class="<?php echo $m_jenis_member_add->LeftColumnClass ?>"><?php echo $m_jenis_member_add->poin_member->caption() ?><?php echo $m_jenis_member_add->poin_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $m_jenis_member_add->RightColumnClass ?>"><div <?php echo $m_jenis_member_add->poin_member->cellAttributes() ?>>
<span id="el_m_jenis_member_poin_member">
<input type="text" data-table="m_jenis_member" data-field="x_poin_member" name="x_poin_member" id="x_poin_member" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($m_jenis_member_add->poin_member->getPlaceHolder()) ?>" value="<?php echo $m_jenis_member_add->poin_member->EditValue ?>"<?php echo $m_jenis_member_add->poin_member->editAttributes() ?>>
</span>
<?php echo $m_jenis_member_add->poin_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$m_jenis_member_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $m_jenis_member_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_jenis_member_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$m_jenis_member_add->showPageFooter();
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
$m_jenis_member_add->terminate();
?>