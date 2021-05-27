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
$penjualan_copy_add = new penjualan_copy_add();

// Run the page
$penjualan_copy_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_copy_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenjualan_copyadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpenjualan_copyadd = currentForm = new ew.Form("fpenjualan_copyadd", "add");

	// Validate form
	fpenjualan_copyadd.validate = function() {
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
			<?php if ($penjualan_copy_add->waktu->Required) { ?>
				elm = this.getElements("x" + infix + "_waktu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->waktu->caption(), $penjualan_copy_add->waktu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_waktu");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->waktu->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_pelanggan->caption(), $penjualan_copy_add->id_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_pelanggan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_pelanggan->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_member->Required) { ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_member->caption(), $penjualan_copy_add->id_member->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_member->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->diskon_persen->Required) { ?>
				elm = this.getElements("x" + infix + "_diskon_persen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->diskon_persen->caption(), $penjualan_copy_add->diskon_persen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_copy_add->diskon_rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_diskon_rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->diskon_rupiah->caption(), $penjualan_copy_add->diskon_rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_diskon_rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->diskon_rupiah->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->ppn->Required) { ?>
				elm = this.getElements("x" + infix + "_ppn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->ppn->caption(), $penjualan_copy_add->ppn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ppn");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->ppn->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->total->caption(), $penjualan_copy_add->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->total->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->bayar->caption(), $penjualan_copy_add->bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bayar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->bayar->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->bayar_non_tunai->Required) { ?>
				elm = this.getElements("x" + infix + "_bayar_non_tunai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->bayar_non_tunai->caption(), $penjualan_copy_add->bayar_non_tunai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bayar_non_tunai");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->bayar_non_tunai->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->total_non_tunai_charge->Required) { ?>
				elm = this.getElements("x" + infix + "_total_non_tunai_charge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->total_non_tunai_charge->caption(), $penjualan_copy_add->total_non_tunai_charge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_non_tunai_charge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->total_non_tunai_charge->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->kode_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->kode_penjualan->caption(), $penjualan_copy_add->kode_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_copy_add->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->keterangan->caption(), $penjualan_copy_add->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_copy_add->dokter->Required) { ?>
				elm = this.getElements("x" + infix + "_dokter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->dokter->caption(), $penjualan_copy_add->dokter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_dokter");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->dokter->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->sales->Required) { ?>
				elm = this.getElements("x" + infix + "_sales");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->sales->caption(), $penjualan_copy_add->sales->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sales");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->sales->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->dok_be_wajah->Required) { ?>
				elm = this.getElements("x" + infix + "_dok_be_wajah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->dok_be_wajah->caption(), $penjualan_copy_add->dok_be_wajah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_dok_be_wajah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->dok_be_wajah->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->be_body->Required) { ?>
				elm = this.getElements("x" + infix + "_be_body");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->be_body->caption(), $penjualan_copy_add->be_body->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_be_body");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->be_body->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->medis->Required) { ?>
				elm = this.getElements("x" + infix + "_medis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->medis->caption(), $penjualan_copy_add->medis->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_medis");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->medis->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_klinik->caption(), $penjualan_copy_add->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_klinik->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_rmd->Required) { ?>
				elm = this.getElements("x" + infix + "_id_rmd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_rmd->caption(), $penjualan_copy_add->id_rmd->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_rmd");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_rmd->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->metode_pembayaran->Required) { ?>
				elm = this.getElements("x" + infix + "_metode_pembayaran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->metode_pembayaran->caption(), $penjualan_copy_add->metode_pembayaran->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_copy_add->id_bank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_bank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_bank->caption(), $penjualan_copy_add->id_bank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_bank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_bank->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_kartu->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kartu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_kartu->caption(), $penjualan_copy_add->id_kartu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kartu");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_kartu->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->jumlah_voucher->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah_voucher");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->jumlah_voucher->caption(), $penjualan_copy_add->jumlah_voucher->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah_voucher");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->jumlah_voucher->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_kartubank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kartubank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_kartubank->caption(), $penjualan_copy_add->id_kartubank->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kartubank");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_kartubank->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->id_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->id_kas->caption(), $penjualan_copy_add->id_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->id_kas->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->charge->Required) { ?>
				elm = this.getElements("x" + infix + "_charge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->charge->caption(), $penjualan_copy_add->charge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_charge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->charge->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->ongkir->Required) { ?>
				elm = this.getElements("x" + infix + "_ongkir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->ongkir->caption(), $penjualan_copy_add->ongkir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ongkir");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->ongkir->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->klaim_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_klaim_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->klaim_poin->caption(), $penjualan_copy_add->klaim_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_klaim_poin");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->klaim_poin->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->total_penukaran_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_total_penukaran_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->total_penukaran_poin->caption(), $penjualan_copy_add->total_penukaran_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_penukaran_poin");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_copy_add->total_penukaran_poin->errorMessage()) ?>");
			<?php if ($penjualan_copy_add->_action->Required) { ?>
				elm = this.getElements("x" + infix + "__action");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->_action->caption(), $penjualan_copy_add->_action->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_copy_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->status->caption(), $penjualan_copy_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_copy_add->status_void->Required) { ?>
				elm = this.getElements("x" + infix + "_status_void");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_copy_add->status_void->caption(), $penjualan_copy_add->status_void->RequiredErrorMessage)) ?>");
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
	fpenjualan_copyadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenjualan_copyadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenjualan_copyadd.lists["x_status"] = <?php echo $penjualan_copy_add->status->Lookup->toClientList($penjualan_copy_add) ?>;
	fpenjualan_copyadd.lists["x_status"].options = <?php echo JsonEncode($penjualan_copy_add->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpenjualan_copyadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $penjualan_copy_add->showPageHeader(); ?>
<?php
$penjualan_copy_add->showMessage();
?>
<form name="fpenjualan_copyadd" id="fpenjualan_copyadd" class="<?php echo $penjualan_copy_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan_copy">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$penjualan_copy_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($penjualan_copy_add->waktu->Visible) { // waktu ?>
	<div id="r_waktu" class="form-group row">
		<label id="elh_penjualan_copy_waktu" for="x_waktu" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->waktu->caption() ?><?php echo $penjualan_copy_add->waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->waktu->cellAttributes() ?>>
<span id="el_penjualan_copy_waktu">
<input type="text" data-table="penjualan_copy" data-field="x_waktu" name="x_waktu" id="x_waktu" maxlength="10" placeholder="<?php echo HtmlEncode($penjualan_copy_add->waktu->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->waktu->EditValue ?>"<?php echo $penjualan_copy_add->waktu->editAttributes() ?>>
<?php if (!$penjualan_copy_add->waktu->ReadOnly && !$penjualan_copy_add->waktu->Disabled && !isset($penjualan_copy_add->waktu->EditAttrs["readonly"]) && !isset($penjualan_copy_add->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenjualan_copyadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenjualan_copyadd", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $penjualan_copy_add->waktu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label id="elh_penjualan_copy_id_pelanggan" for="x_id_pelanggan" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_pelanggan->caption() ?><?php echo $penjualan_copy_add->id_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_pelanggan->cellAttributes() ?>>
<span id="el_penjualan_copy_id_pelanggan">
<input type="text" data-table="penjualan_copy" data-field="x_id_pelanggan" name="x_id_pelanggan" id="x_id_pelanggan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_pelanggan->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_pelanggan->EditValue ?>"<?php echo $penjualan_copy_add->id_pelanggan->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_member->Visible) { // id_member ?>
	<div id="r_id_member" class="form-group row">
		<label id="elh_penjualan_copy_id_member" for="x_id_member" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_member->caption() ?><?php echo $penjualan_copy_add->id_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_member->cellAttributes() ?>>
<span id="el_penjualan_copy_id_member">
<input type="text" data-table="penjualan_copy" data-field="x_id_member" name="x_id_member" id="x_id_member" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_member->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_member->EditValue ?>"<?php echo $penjualan_copy_add->id_member->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->diskon_persen->Visible) { // diskon_persen ?>
	<div id="r_diskon_persen" class="form-group row">
		<label id="elh_penjualan_copy_diskon_persen" for="x_diskon_persen" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->diskon_persen->caption() ?><?php echo $penjualan_copy_add->diskon_persen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->diskon_persen->cellAttributes() ?>>
<span id="el_penjualan_copy_diskon_persen">
<input type="text" data-table="penjualan_copy" data-field="x_diskon_persen" name="x_diskon_persen" id="x_diskon_persen" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($penjualan_copy_add->diskon_persen->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->diskon_persen->EditValue ?>"<?php echo $penjualan_copy_add->diskon_persen->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->diskon_persen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->diskon_rupiah->Visible) { // diskon_rupiah ?>
	<div id="r_diskon_rupiah" class="form-group row">
		<label id="elh_penjualan_copy_diskon_rupiah" for="x_diskon_rupiah" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->diskon_rupiah->caption() ?><?php echo $penjualan_copy_add->diskon_rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->diskon_rupiah->cellAttributes() ?>>
<span id="el_penjualan_copy_diskon_rupiah">
<input type="text" data-table="penjualan_copy" data-field="x_diskon_rupiah" name="x_diskon_rupiah" id="x_diskon_rupiah" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->diskon_rupiah->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->diskon_rupiah->EditValue ?>"<?php echo $penjualan_copy_add->diskon_rupiah->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->diskon_rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->ppn->Visible) { // ppn ?>
	<div id="r_ppn" class="form-group row">
		<label id="elh_penjualan_copy_ppn" for="x_ppn" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->ppn->caption() ?><?php echo $penjualan_copy_add->ppn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->ppn->cellAttributes() ?>>
<span id="el_penjualan_copy_ppn">
<input type="text" data-table="penjualan_copy" data-field="x_ppn" name="x_ppn" id="x_ppn" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->ppn->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->ppn->EditValue ?>"<?php echo $penjualan_copy_add->ppn->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->ppn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_penjualan_copy_total" for="x_total" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->total->caption() ?><?php echo $penjualan_copy_add->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->total->cellAttributes() ?>>
<span id="el_penjualan_copy_total">
<input type="text" data-table="penjualan_copy" data-field="x_total" name="x_total" id="x_total" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->total->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->total->EditValue ?>"<?php echo $penjualan_copy_add->total->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->bayar->Visible) { // bayar ?>
	<div id="r_bayar" class="form-group row">
		<label id="elh_penjualan_copy_bayar" for="x_bayar" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->bayar->caption() ?><?php echo $penjualan_copy_add->bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->bayar->cellAttributes() ?>>
<span id="el_penjualan_copy_bayar">
<input type="text" data-table="penjualan_copy" data-field="x_bayar" name="x_bayar" id="x_bayar" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->bayar->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->bayar->EditValue ?>"<?php echo $penjualan_copy_add->bayar->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
	<div id="r_bayar_non_tunai" class="form-group row">
		<label id="elh_penjualan_copy_bayar_non_tunai" for="x_bayar_non_tunai" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->bayar_non_tunai->caption() ?><?php echo $penjualan_copy_add->bayar_non_tunai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->bayar_non_tunai->cellAttributes() ?>>
<span id="el_penjualan_copy_bayar_non_tunai">
<input type="text" data-table="penjualan_copy" data-field="x_bayar_non_tunai" name="x_bayar_non_tunai" id="x_bayar_non_tunai" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->bayar_non_tunai->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->bayar_non_tunai->EditValue ?>"<?php echo $penjualan_copy_add->bayar_non_tunai->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->bayar_non_tunai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<div id="r_total_non_tunai_charge" class="form-group row">
		<label id="elh_penjualan_copy_total_non_tunai_charge" for="x_total_non_tunai_charge" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->total_non_tunai_charge->caption() ?><?php echo $penjualan_copy_add->total_non_tunai_charge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->total_non_tunai_charge->cellAttributes() ?>>
<span id="el_penjualan_copy_total_non_tunai_charge">
<input type="text" data-table="penjualan_copy" data-field="x_total_non_tunai_charge" name="x_total_non_tunai_charge" id="x_total_non_tunai_charge" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->total_non_tunai_charge->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->total_non_tunai_charge->EditValue ?>"<?php echo $penjualan_copy_add->total_non_tunai_charge->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->total_non_tunai_charge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label id="elh_penjualan_copy_kode_penjualan" for="x_kode_penjualan" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->kode_penjualan->caption() ?><?php echo $penjualan_copy_add->kode_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->kode_penjualan->cellAttributes() ?>>
<span id="el_penjualan_copy_kode_penjualan">
<input type="text" data-table="penjualan_copy" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($penjualan_copy_add->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->kode_penjualan->EditValue ?>"<?php echo $penjualan_copy_add->kode_penjualan->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->kode_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_penjualan_copy_keterangan" for="x_keterangan" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->keterangan->caption() ?><?php echo $penjualan_copy_add->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->keterangan->cellAttributes() ?>>
<span id="el_penjualan_copy_keterangan">
<input type="text" data-table="penjualan_copy" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penjualan_copy_add->keterangan->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->keterangan->EditValue ?>"<?php echo $penjualan_copy_add->keterangan->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->dokter->Visible) { // dokter ?>
	<div id="r_dokter" class="form-group row">
		<label id="elh_penjualan_copy_dokter" for="x_dokter" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->dokter->caption() ?><?php echo $penjualan_copy_add->dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->dokter->cellAttributes() ?>>
<span id="el_penjualan_copy_dokter">
<input type="text" data-table="penjualan_copy" data-field="x_dokter" name="x_dokter" id="x_dokter" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->dokter->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->dokter->EditValue ?>"<?php echo $penjualan_copy_add->dokter->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->dokter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->sales->Visible) { // sales ?>
	<div id="r_sales" class="form-group row">
		<label id="elh_penjualan_copy_sales" for="x_sales" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->sales->caption() ?><?php echo $penjualan_copy_add->sales->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->sales->cellAttributes() ?>>
<span id="el_penjualan_copy_sales">
<input type="text" data-table="penjualan_copy" data-field="x_sales" name="x_sales" id="x_sales" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->sales->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->sales->EditValue ?>"<?php echo $penjualan_copy_add->sales->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->sales->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->dok_be_wajah->Visible) { // dok_be_wajah ?>
	<div id="r_dok_be_wajah" class="form-group row">
		<label id="elh_penjualan_copy_dok_be_wajah" for="x_dok_be_wajah" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->dok_be_wajah->caption() ?><?php echo $penjualan_copy_add->dok_be_wajah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->dok_be_wajah->cellAttributes() ?>>
<span id="el_penjualan_copy_dok_be_wajah">
<input type="text" data-table="penjualan_copy" data-field="x_dok_be_wajah" name="x_dok_be_wajah" id="x_dok_be_wajah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->dok_be_wajah->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->dok_be_wajah->EditValue ?>"<?php echo $penjualan_copy_add->dok_be_wajah->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->dok_be_wajah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->be_body->Visible) { // be_body ?>
	<div id="r_be_body" class="form-group row">
		<label id="elh_penjualan_copy_be_body" for="x_be_body" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->be_body->caption() ?><?php echo $penjualan_copy_add->be_body->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->be_body->cellAttributes() ?>>
<span id="el_penjualan_copy_be_body">
<input type="text" data-table="penjualan_copy" data-field="x_be_body" name="x_be_body" id="x_be_body" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->be_body->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->be_body->EditValue ?>"<?php echo $penjualan_copy_add->be_body->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->be_body->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->medis->Visible) { // medis ?>
	<div id="r_medis" class="form-group row">
		<label id="elh_penjualan_copy_medis" for="x_medis" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->medis->caption() ?><?php echo $penjualan_copy_add->medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->medis->cellAttributes() ?>>
<span id="el_penjualan_copy_medis">
<input type="text" data-table="penjualan_copy" data-field="x_medis" name="x_medis" id="x_medis" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->medis->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->medis->EditValue ?>"<?php echo $penjualan_copy_add->medis->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->medis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_penjualan_copy_id_klinik" for="x_id_klinik" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_klinik->caption() ?><?php echo $penjualan_copy_add->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_klinik->cellAttributes() ?>>
<span id="el_penjualan_copy_id_klinik">
<input type="text" data-table="penjualan_copy" data-field="x_id_klinik" name="x_id_klinik" id="x_id_klinik" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_klinik->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_klinik->EditValue ?>"<?php echo $penjualan_copy_add->id_klinik->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_rmd->Visible) { // id_rmd ?>
	<div id="r_id_rmd" class="form-group row">
		<label id="elh_penjualan_copy_id_rmd" for="x_id_rmd" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_rmd->caption() ?><?php echo $penjualan_copy_add->id_rmd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_rmd->cellAttributes() ?>>
<span id="el_penjualan_copy_id_rmd">
<input type="text" data-table="penjualan_copy" data-field="x_id_rmd" name="x_id_rmd" id="x_id_rmd" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_rmd->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_rmd->EditValue ?>"<?php echo $penjualan_copy_add->id_rmd->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_rmd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<div id="r_metode_pembayaran" class="form-group row">
		<label id="elh_penjualan_copy_metode_pembayaran" for="x_metode_pembayaran" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->metode_pembayaran->caption() ?><?php echo $penjualan_copy_add->metode_pembayaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->metode_pembayaran->cellAttributes() ?>>
<span id="el_penjualan_copy_metode_pembayaran">
<input type="text" data-table="penjualan_copy" data-field="x_metode_pembayaran" name="x_metode_pembayaran" id="x_metode_pembayaran" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($penjualan_copy_add->metode_pembayaran->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->metode_pembayaran->EditValue ?>"<?php echo $penjualan_copy_add->metode_pembayaran->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->metode_pembayaran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_bank->Visible) { // id_bank ?>
	<div id="r_id_bank" class="form-group row">
		<label id="elh_penjualan_copy_id_bank" for="x_id_bank" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_bank->caption() ?><?php echo $penjualan_copy_add->id_bank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_bank->cellAttributes() ?>>
<span id="el_penjualan_copy_id_bank">
<input type="text" data-table="penjualan_copy" data-field="x_id_bank" name="x_id_bank" id="x_id_bank" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_bank->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_bank->EditValue ?>"<?php echo $penjualan_copy_add->id_bank->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_bank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_kartu->Visible) { // id_kartu ?>
	<div id="r_id_kartu" class="form-group row">
		<label id="elh_penjualan_copy_id_kartu" for="x_id_kartu" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_kartu->caption() ?><?php echo $penjualan_copy_add->id_kartu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_kartu->cellAttributes() ?>>
<span id="el_penjualan_copy_id_kartu">
<input type="text" data-table="penjualan_copy" data-field="x_id_kartu" name="x_id_kartu" id="x_id_kartu" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_kartu->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_kartu->EditValue ?>"<?php echo $penjualan_copy_add->id_kartu->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_kartu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->jumlah_voucher->Visible) { // jumlah_voucher ?>
	<div id="r_jumlah_voucher" class="form-group row">
		<label id="elh_penjualan_copy_jumlah_voucher" for="x_jumlah_voucher" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->jumlah_voucher->caption() ?><?php echo $penjualan_copy_add->jumlah_voucher->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->jumlah_voucher->cellAttributes() ?>>
<span id="el_penjualan_copy_jumlah_voucher">
<input type="text" data-table="penjualan_copy" data-field="x_jumlah_voucher" name="x_jumlah_voucher" id="x_jumlah_voucher" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->jumlah_voucher->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->jumlah_voucher->EditValue ?>"<?php echo $penjualan_copy_add->jumlah_voucher->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->jumlah_voucher->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_kartubank->Visible) { // id_kartubank ?>
	<div id="r_id_kartubank" class="form-group row">
		<label id="elh_penjualan_copy_id_kartubank" for="x_id_kartubank" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_kartubank->caption() ?><?php echo $penjualan_copy_add->id_kartubank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_kartubank->cellAttributes() ?>>
<span id="el_penjualan_copy_id_kartubank">
<input type="text" data-table="penjualan_copy" data-field="x_id_kartubank" name="x_id_kartubank" id="x_id_kartubank" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_kartubank->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_kartubank->EditValue ?>"<?php echo $penjualan_copy_add->id_kartubank->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_kartubank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label id="elh_penjualan_copy_id_kas" for="x_id_kas" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->id_kas->caption() ?><?php echo $penjualan_copy_add->id_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->id_kas->cellAttributes() ?>>
<span id="el_penjualan_copy_id_kas">
<input type="text" data-table="penjualan_copy" data-field="x_id_kas" name="x_id_kas" id="x_id_kas" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_copy_add->id_kas->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->id_kas->EditValue ?>"<?php echo $penjualan_copy_add->id_kas->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->id_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->charge->Visible) { // charge ?>
	<div id="r_charge" class="form-group row">
		<label id="elh_penjualan_copy_charge" for="x_charge" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->charge->caption() ?><?php echo $penjualan_copy_add->charge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->charge->cellAttributes() ?>>
<span id="el_penjualan_copy_charge">
<input type="text" data-table="penjualan_copy" data-field="x_charge" name="x_charge" id="x_charge" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->charge->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->charge->EditValue ?>"<?php echo $penjualan_copy_add->charge->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->charge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->ongkir->Visible) { // ongkir ?>
	<div id="r_ongkir" class="form-group row">
		<label id="elh_penjualan_copy_ongkir" for="x_ongkir" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->ongkir->caption() ?><?php echo $penjualan_copy_add->ongkir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->ongkir->cellAttributes() ?>>
<span id="el_penjualan_copy_ongkir">
<input type="text" data-table="penjualan_copy" data-field="x_ongkir" name="x_ongkir" id="x_ongkir" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->ongkir->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->ongkir->EditValue ?>"<?php echo $penjualan_copy_add->ongkir->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->ongkir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->klaim_poin->Visible) { // klaim_poin ?>
	<div id="r_klaim_poin" class="form-group row">
		<label id="elh_penjualan_copy_klaim_poin" for="x_klaim_poin" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->klaim_poin->caption() ?><?php echo $penjualan_copy_add->klaim_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->klaim_poin->cellAttributes() ?>>
<span id="el_penjualan_copy_klaim_poin">
<input type="text" data-table="penjualan_copy" data-field="x_klaim_poin" name="x_klaim_poin" id="x_klaim_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->klaim_poin->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->klaim_poin->EditValue ?>"<?php echo $penjualan_copy_add->klaim_poin->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->klaim_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<div id="r_total_penukaran_poin" class="form-group row">
		<label id="elh_penjualan_copy_total_penukaran_poin" for="x_total_penukaran_poin" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->total_penukaran_poin->caption() ?><?php echo $penjualan_copy_add->total_penukaran_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->total_penukaran_poin->cellAttributes() ?>>
<span id="el_penjualan_copy_total_penukaran_poin">
<input type="text" data-table="penjualan_copy" data-field="x_total_penukaran_poin" name="x_total_penukaran_poin" id="x_total_penukaran_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_copy_add->total_penukaran_poin->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->total_penukaran_poin->EditValue ?>"<?php echo $penjualan_copy_add->total_penukaran_poin->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->total_penukaran_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->_action->Visible) { // action ?>
	<div id="r__action" class="form-group row">
		<label id="elh_penjualan_copy__action" for="x__action" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->_action->caption() ?><?php echo $penjualan_copy_add->_action->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->_action->cellAttributes() ?>>
<span id="el_penjualan_copy__action">
<input type="text" data-table="penjualan_copy" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penjualan_copy_add->_action->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->_action->EditValue ?>"<?php echo $penjualan_copy_add->_action->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->_action->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_penjualan_copy_status" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->status->caption() ?><?php echo $penjualan_copy_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->status->cellAttributes() ?>>
<span id="el_penjualan_copy_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="penjualan_copy" data-field="x_status" data-value-separator="<?php echo $penjualan_copy_add->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $penjualan_copy_add->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $penjualan_copy_add->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $penjualan_copy_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_copy_add->status_void->Visible) { // status_void ?>
	<div id="r_status_void" class="form-group row">
		<label id="elh_penjualan_copy_status_void" for="x_status_void" class="<?php echo $penjualan_copy_add->LeftColumnClass ?>"><?php echo $penjualan_copy_add->status_void->caption() ?><?php echo $penjualan_copy_add->status_void->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $penjualan_copy_add->RightColumnClass ?>"><div <?php echo $penjualan_copy_add->status_void->cellAttributes() ?>>
<span id="el_penjualan_copy_status_void">
<input type="text" data-table="penjualan_copy" data-field="x_status_void" name="x_status_void" id="x_status_void" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($penjualan_copy_add->status_void->getPlaceHolder()) ?>" value="<?php echo $penjualan_copy_add->status_void->EditValue ?>"<?php echo $penjualan_copy_add->status_void->editAttributes() ?>>
</span>
<?php echo $penjualan_copy_add->status_void->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$penjualan_copy_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penjualan_copy_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penjualan_copy_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$penjualan_copy_add->showPageFooter();
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
$penjualan_copy_add->terminate();
?>