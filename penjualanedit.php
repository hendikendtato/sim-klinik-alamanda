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
$penjualan_edit = new penjualan_edit();

// Run the page
$penjualan_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penjualan_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpenjualanedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpenjualanedit = currentForm = new ew.Form("fpenjualanedit", "edit");

	// Validate form
	fpenjualanedit.validate = function() {
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
			<?php if ($penjualan_edit->kode_penjualan->Required) { ?>
				elm = this.getElements("x" + infix + "_kode_penjualan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->kode_penjualan->caption(), $penjualan_edit->kode_penjualan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_pelanggan->Required) { ?>
				elm = this.getElements("x" + infix + "_id_pelanggan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_pelanggan->caption(), $penjualan_edit->id_pelanggan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_member->Required) { ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_member->caption(), $penjualan_edit->id_member->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_member");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->id_member->errorMessage()) ?>");
			<?php if ($penjualan_edit->waktu->Required) { ?>
				elm = this.getElements("x" + infix + "_waktu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->waktu->caption(), $penjualan_edit->waktu->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_waktu");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->waktu->errorMessage()) ?>");
			<?php if ($penjualan_edit->diskon_persen->Required) { ?>
				elm = this.getElements("x" + infix + "_diskon_persen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->diskon_persen->caption(), $penjualan_edit->diskon_persen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->diskon_rupiah->Required) { ?>
				elm = this.getElements("x" + infix + "_diskon_rupiah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->diskon_rupiah->caption(), $penjualan_edit->diskon_rupiah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_diskon_rupiah");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->diskon_rupiah->errorMessage()) ?>");
			<?php if ($penjualan_edit->ppn->Required) { ?>
				elm = this.getElements("x" + infix + "_ppn");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->ppn->caption(), $penjualan_edit->ppn->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ppn");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->ppn->errorMessage()) ?>");
			<?php if ($penjualan_edit->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->total->caption(), $penjualan_edit->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->total->errorMessage()) ?>");
			<?php if ($penjualan_edit->bayar->Required) { ?>
				elm = this.getElements("x" + infix + "_bayar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->bayar->caption(), $penjualan_edit->bayar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bayar");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->bayar->errorMessage()) ?>");
			<?php if ($penjualan_edit->bayar_non_tunai->Required) { ?>
				elm = this.getElements("x" + infix + "_bayar_non_tunai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->bayar_non_tunai->caption(), $penjualan_edit->bayar_non_tunai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bayar_non_tunai");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->bayar_non_tunai->errorMessage()) ?>");
			<?php if ($penjualan_edit->total_non_tunai_charge->Required) { ?>
				elm = this.getElements("x" + infix + "_total_non_tunai_charge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->total_non_tunai_charge->caption(), $penjualan_edit->total_non_tunai_charge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_non_tunai_charge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->total_non_tunai_charge->errorMessage()) ?>");
			<?php if ($penjualan_edit->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->keterangan->caption(), $penjualan_edit->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_klinik->Required) { ?>
				elm = this.getElements("x" + infix + "_id_klinik");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_klinik->caption(), $penjualan_edit->id_klinik->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_rmd->Required) { ?>
				elm = this.getElements("x" + infix + "_id_rmd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_rmd->caption(), $penjualan_edit->id_rmd->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_id_rmd");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->id_rmd->errorMessage()) ?>");
			<?php if ($penjualan_edit->metode_pembayaran->Required) { ?>
				elm = this.getElements("x" + infix + "_metode_pembayaran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->metode_pembayaran->caption(), $penjualan_edit->metode_pembayaran->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_bank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_bank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_bank->caption(), $penjualan_edit->id_bank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_kartu->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kartu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_kartu->caption(), $penjualan_edit->id_kartu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->jumlah_voucher->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlah_voucher");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->jumlah_voucher->caption(), $penjualan_edit->jumlah_voucher->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlah_voucher");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->jumlah_voucher->errorMessage()) ?>");
			<?php if ($penjualan_edit->sales->Required) { ?>
				elm = this.getElements("x" + infix + "_sales");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->sales->caption(), $penjualan_edit->sales->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->dok_be_wajah->Required) { ?>
				elm = this.getElements("x" + infix + "_dok_be_wajah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->dok_be_wajah->caption(), $penjualan_edit->dok_be_wajah->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->be_body->Required) { ?>
				elm = this.getElements("x" + infix + "_be_body");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->be_body->caption(), $penjualan_edit->be_body->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->medis->Required) { ?>
				elm = this.getElements("x" + infix + "_medis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->medis->caption(), $penjualan_edit->medis->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->dokter->Required) { ?>
				elm = this.getElements("x" + infix + "_dokter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->dokter->caption(), $penjualan_edit->dokter->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_kartubank->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kartubank");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_kartubank->caption(), $penjualan_edit->id_kartubank->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->id_kas->Required) { ?>
				elm = this.getElements("x" + infix + "_id_kas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->id_kas->caption(), $penjualan_edit->id_kas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->charge->Required) { ?>
				elm = this.getElements("x" + infix + "_charge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->charge->caption(), $penjualan_edit->charge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_charge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->charge->errorMessage()) ?>");
			<?php if ($penjualan_edit->klaim_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_klaim_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->klaim_poin->caption(), $penjualan_edit->klaim_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_klaim_poin");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->klaim_poin->errorMessage()) ?>");
			<?php if ($penjualan_edit->total_penukaran_poin->Required) { ?>
				elm = this.getElements("x" + infix + "_total_penukaran_poin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->total_penukaran_poin->caption(), $penjualan_edit->total_penukaran_poin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_penukaran_poin");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->total_penukaran_poin->errorMessage()) ?>");
			<?php if ($penjualan_edit->ongkir->Required) { ?>
				elm = this.getElements("x" + infix + "_ongkir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->ongkir->caption(), $penjualan_edit->ongkir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ongkir");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($penjualan_edit->ongkir->errorMessage()) ?>");
			<?php if ($penjualan_edit->_action->Required) { ?>
				elm = this.getElements("x" + infix + "__action");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->_action->caption(), $penjualan_edit->_action->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($penjualan_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $penjualan_edit->status->caption(), $penjualan_edit->status->RequiredErrorMessage)) ?>");
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
	fpenjualanedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpenjualanedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpenjualanedit.lists["x_id_pelanggan"] = <?php echo $penjualan_edit->id_pelanggan->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_pelanggan"].options = <?php echo JsonEncode($penjualan_edit->id_pelanggan->lookupOptions()) ?>;
	fpenjualanedit.autoSuggests["x_id_pelanggan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenjualanedit.lists["x_id_member"] = <?php echo $penjualan_edit->id_member->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_member"].options = <?php echo JsonEncode($penjualan_edit->id_member->lookupOptions()) ?>;
	fpenjualanedit.autoSuggests["x_id_member"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenjualanedit.lists["x_id_klinik"] = <?php echo $penjualan_edit->id_klinik->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_klinik"].options = <?php echo JsonEncode($penjualan_edit->id_klinik->lookupOptions()) ?>;
	fpenjualanedit.lists["x_id_rmd"] = <?php echo $penjualan_edit->id_rmd->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_rmd"].options = <?php echo JsonEncode($penjualan_edit->id_rmd->lookupOptions()) ?>;
	fpenjualanedit.autoSuggests["x_id_rmd"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpenjualanedit.lists["x_metode_pembayaran"] = <?php echo $penjualan_edit->metode_pembayaran->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_metode_pembayaran"].options = <?php echo JsonEncode($penjualan_edit->metode_pembayaran->options(FALSE, TRUE)) ?>;
	fpenjualanedit.lists["x_id_bank"] = <?php echo $penjualan_edit->id_bank->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_bank"].options = <?php echo JsonEncode($penjualan_edit->id_bank->lookupOptions()) ?>;
	fpenjualanedit.lists["x_id_kartu"] = <?php echo $penjualan_edit->id_kartu->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_kartu"].options = <?php echo JsonEncode($penjualan_edit->id_kartu->lookupOptions()) ?>;
	fpenjualanedit.lists["x_sales"] = <?php echo $penjualan_edit->sales->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_sales"].options = <?php echo JsonEncode($penjualan_edit->sales->lookupOptions()) ?>;
	fpenjualanedit.lists["x_dok_be_wajah"] = <?php echo $penjualan_edit->dok_be_wajah->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_dok_be_wajah"].options = <?php echo JsonEncode($penjualan_edit->dok_be_wajah->lookupOptions()) ?>;
	fpenjualanedit.lists["x_be_body"] = <?php echo $penjualan_edit->be_body->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_be_body"].options = <?php echo JsonEncode($penjualan_edit->be_body->lookupOptions()) ?>;
	fpenjualanedit.lists["x_medis"] = <?php echo $penjualan_edit->medis->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_medis"].options = <?php echo JsonEncode($penjualan_edit->medis->lookupOptions()) ?>;
	fpenjualanedit.lists["x_dokter"] = <?php echo $penjualan_edit->dokter->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_dokter"].options = <?php echo JsonEncode($penjualan_edit->dokter->lookupOptions()) ?>;
	fpenjualanedit.lists["x_id_kartubank"] = <?php echo $penjualan_edit->id_kartubank->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_kartubank"].options = <?php echo JsonEncode($penjualan_edit->id_kartubank->lookupOptions()) ?>;
	fpenjualanedit.lists["x_id_kas"] = <?php echo $penjualan_edit->id_kas->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_id_kas"].options = <?php echo JsonEncode($penjualan_edit->id_kas->lookupOptions()) ?>;
	fpenjualanedit.lists["x_status"] = <?php echo $penjualan_edit->status->Lookup->toClientList($penjualan_edit) ?>;
	fpenjualanedit.lists["x_status"].options = <?php echo JsonEncode($penjualan_edit->status->options(FALSE, TRUE)) ?>;
	loadjs.done("fpenjualanedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	function btnLoading(a){$("#"+a).prop("disabled",!0),$("#"+a).empty(),$("#"+a).html('<i class="fa fa-spinner fa-spin"></i>')}function btnLoadingGone(a){$("#"+a).prop("disabled",!1),$("#"+a).html("Draft")}function btnLoadingGoneCetak(a){$("#"+a).prop("disabled",!1),$("#"+a).html("Cetak Nota")}function drawDetailRMD(a){$("#detail-rmd").empty(),""!=a&&($("#detail-rmd").append('\n\t\t\t<style>\n\t\t\t.loader {\n  \t\t\t\tborder: 5px solid #f3f3f3;\n  \t\t\t\t-webkit-animation: spin 1s linear infinite;\n\t\t\t\tanimation: spin 1s linear infinite;\n\t\t\t\tborder-top: 5px solid #555;\n\t\t\t\tborder-radius: 50%;\n\t\t\t\twidth: 50px;\n\t\t\t\theight: 50px;\n  \t\t\t}\n\n\t\t\t/* Safari */\n\t\t\t@-webkit-keyframes spin {\n  \t\t\t\t0% { -webkit-transform: rotate(0deg); }\n  \t\t\t\t100% { -webkit-transform: rotate(360deg); }\n  \t\t\t}\n\n\t\t\t@keyframes spin {\n  \t\t\t\t0% { transform: rotate(0deg); }\n  \t\t\t\t100% { transform: rotate(360deg); }\n  \t\t\t}\n\t\t\t</style>\n\t\t\t<div id="loader" class="loader"></div>\n\t\t'),axios.get(`api/?action=list&object=view_rmd&id_rekmeddok=${a}&recperpage=ALL`).then(function({data:t}){console.log(t),$("#detail-rmd").empty(),$("#detail-rmd").append('\n\t\t\t\t<div class="row"  style="margin-top: 2em; margin-bottom: 1em;">\n\t\t\t\t\t<label for="table-rmd" style="margin-right: auto;">Detail Rekam Medis</label>\n\t\t\t\t\t<div id="tutup-detail-rmd" class="btn btn-outline-dark btn-sm" onclick="$(\'#detail-rmd\').empty();">close x</div>\n\t\t\t\t</div>\n\t\t\t\t<table id="table-rmd" class="table table-hover table-striped" style="margin-bottom: 2em;">\n\t\t\t\t\t<thead style="background-color: #B7D8DC;">\n\t\t\t\t\t\t<tr style="text-transform: uppercase; font-weight: 500; font-size: 12px;">\n\t\t\t\t\t\t\t<th style="padding: 10px;">Barang</th>\n\t\t\t\t\t\t\t<th style="padding: 10px;">Jumlah</th>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t</thead>\n\t\t\t\t\t<tbody id="detail-barang-rmd"></tbody>\n\t\t\t\t</table>\n\t\t\t'),t.view_rmd.forEach(function(t){if(t.id_rekmeddok==a){var n=t.nama_barang,i=t.jumlah;$("#detail-barang-rmd").append(`\n\t\t\t\t\t\t<tr>\n\t\t\t\t\t\t\t<td align="left" style="border: none; padding: 10px;">${n}</td>\n\t\t\t\t\t\t\t<td align="left" style="border: none; padding: 10px;">${i}</td>\n\t\t\t\t\t\t</tr>\n\t\t\t\t\t`)}})}).catch(function(a){console.log(a)}))}$(".card.ew-card.ew-grid.ew-grid-add-edit.detailpenjualan").appendTo("#daftar-barang"),$("h4.ew-detail-caption").hide(),$("h4.ew-detail-caption").hide(),$("h4.ew-detail-caption").hide(),$("th[data-name=id_barang]").css({display:"none"}),$("td[data-name=id_barang]").css({display:"none"}),$("#btn-action").html("Draft"),$("div[id=status_penjualan]").css({display:"none"}),$(".ew-grid-delete").click(function(){$(".btn-primary.ew-btn").click(function(){var a=$("[data-field=x_harga_jual]").attr("id");if("x$rowindex$_harga_jual"==a)var t="#"+a.split("_")[1];else t="#"+a.split("_")[0];var n,i,e,l,d,o=t+"_harga_jual",r=t+"_qty",_=t+"_disc_pr",s=t+"_disc_rp",v=t+"_voucher_barang",c=t+"_subtotal",p=parseInt(0),b=0;o=$(o).val()?$(o).val().split(".").join(""):0,_=$(_).val()?$(_).val().split(",").join("."):0,n=o*$(r).val(),$(c).val(n-n*_/100-$(s).val()-$(v).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(p+=parseInt($(this).val()))}),b=$("[data-field=x_diskon_persen]").val(),e=$("[data-field=x_diskon_rupiah]").val(),l=$("[data-field=x_ppn]").val(),d=$("[data-field=x_ongkir]").val(),b=b?b.split(",").join("."):0,i=p-e-p*b/100+p*l/100+parseInt(d);var f=$("#x_id_kartu").val(),u=$("#x_jumlah_voucher").val();if(""!=f)axios.get(`api/?action=view&object=m_kartu&id_kartu=${f}`).then(function(a){console.log(a.data);var t=a.data.m_kartu.charge_price,n=$("[data-field=x_total_penukaran_poin]").val();if(""!=n){var e=parseInt(i)-parseInt(t)*u-parseInt(n);$("[data-field=x_total]").val(e)}else{e=parseInt(i)-parseInt(t)*u;$("[data-field=x_total]").val(e)}}).catch(function(a){console.log(a)});else{var k=$("[data-field=x_total_penukaran_poin]").val();if(""!=k){var x=parseInt(i)-parseInt(k);$("[data-field=x_total]").val(x)}else $("[data-field=x_total]").val(i)}})}),$("#x_metode_pembayaran option").each(function(){var a=$("#x_metode_pembayaran :selected").text();"Tunai"==a?($("div[id=r_id_bank]").css({display:"none"}),$("div[id=r_id_kartubank]").css({display:"none"}),$("div[id=r_charge]").css({display:"none"}),$("div[id=r_id_kas]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"none"}),$("div[id=r_bayar]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"none"})):"Tunai-Debit"==a||"Tunai-Kredit"==a?($("div[id=r_bayar]").css({display:"inline-block"}),$("div[id=r_id_kas]").css({display:"inline-block"}),$("div[id=r_id_bank]").css({display:"inline-block"}),$("div[id=r_id_kartubank]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"inline-block"}),$("div[id=r_charge]").css({display:"inline-block"})):"Transfer"==a?($("div[id=r_bayar]").css({display:"none"}),$("div[id=r_id_kas]").css({display:"none"}),$("div[id=r_id_kartubank]").css({display:"none"}),$("div[id=r_id_bank]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"inline-block"})):($("div[id=r_bayar]").css({display:"none"}),$("div[id=r_id_kas]").css({display:"none"}),$("div[id=r_id_bank]").css({display:"inline-block"}),$("div[id=r_id_kartubank]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"inline-block"}),$("div[id=r_charge]").css({display:"inline-block"}))}),$("[data-field=x_metode_pembayaran]").change(function(){$("[data-field=x_bayar]").val("0"),$("[data-field=x_charge]").val("0"),$("[data-field=x_id_kartubank]").val(""),$("[data-field=x_id_kas]").val(""),$("[data-field=x_bayar_non_tunai]").val(""),$("[data-field=x_ongkir]").val("0"),"Tunai"==$(this).val()?($("div[id=r_id_bank]").css({display:"none"}),$("div[id=r_id_kartubank]").css({display:"none"}),$("div[id=r_charge]").css({display:"none"}),$("div[id=r_id_kas]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"none"}),$("div[id=r_bayar]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"none"})):"Tunai-Debit"==$(this).val()||"Tunai-Kredit"==$(this).val()?($("div[id=r_bayar]").css({display:"inline-block"}),$("div[id=r_id_kas]").css({display:"inline-block"}),$("div[id=r_id_bank]").css({display:"inline-block"}),$("div[id=r_id_kartubank]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"inline-block"}),$("div[id=r_charge]").css({display:"inline-block"})):"Transfer"==$(this).val()?($("div[id=r_bayar]").css({display:"none"}),$("div[id=r_id_kas]").css({display:"none"}),$("div[id=r_id_kartubank]").css({display:"none"}),$("div[id=r_id_bank]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"inline-block"})):($("div[id=r_bayar]").css({display:"none"}),$("div[id=r_id_kas]").css({display:"none"}),$("div[id=r_id_bank]").css({display:"inline-block"}),$("div[id=r_id_kartubank]").css({display:"inline-block"}),$("div[id=r_bayar_non_tunai]").css({display:"inline-block"}),$("div[id=r_total_non_tunai_charge]").css({display:"inline-block"}),$("div[id=r_charge]").css({display:"inline-block"}));var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("#x_id_kartu").val(),f=$("#x_jumlah_voucher").val();if(""!=b)axios.get(`api/?action=view&object=m_kartu&id_kartu=${b}`).then(function(a){var n=a.data.m_kartu.charge_price,i=$("[data-field=x_total_penukaran_poin]").val();if(""!=i){var e=parseInt(t)-parseInt(n)*f-parseInt(i);$("[data-field=x_total]").val(e)}else{e=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(e)}}).catch(function(a){console.log(a)});else{var u=$("[data-field=x_total_penukaran_poin]").val();if(""!=u){var k=parseInt(t)-parseInt(u);$("[data-field=x_total]").val(k)}else $("[data-field=x_total]").val(t)}}),$("#x_id_pelanggan").change(function(){$("#x_diskon_persen").val("0"),$("#x_diskon_rupiah").val("0"),$("#sv_x_id_member").val(""),$("#x_id_member").val("");var a=$(this).val(),t=axios.get(`api/?action=list&object=m_pelanggan&id_pelanggan=${a}`),n=axios.get("api/?action=list&object=m_member&recperpage=ALL"),i=axios.get("api/?action=list&object=m_jenis_member&recperpage=ALL");axios.all([t,n,i]).then(axios.spread(function(...a){console.log(a[0].data),console.log(a[1].data),console.log(a[2].data),a[0].data.m_pelanggan.forEach(function(t,n){var i=a[1].data.m_member.find(function({id_pelanggan:a}){return a==t.id_pelanggan}),e=a[2].data.m_jenis_member.find(function({id_jenis_member:a}){return a==i.jenis_member}),l=e.disc_prosen;console.log(l),console.log(i.disc_nominal),console.log(e.nama_member),console.log(e.id_jenis_member),null!=l?$("#x_diskon_persen").val(l):$("#x_diskon_persen").val("0"),null!=e.disc_nominal?$("#x_diskon_rupiah").val(e.disc_nominal):$("#x_diskon_rupiah").val("0"),$("#sv_x_id_member").val(e.nama_member),$("#x_id_member").val(i.jenis_member),$("#sv_x_id_member").prop("disabled",!0)})}))}),$("#x_klaim_poin").keyup(function(){var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("#x_id_kartu").val(),f=$("#x_jumlah_voucher").val();if(""!=b){b=$("#x_id_kartu").val();axios.get(`api/?action=view&object=m_kartu&id_kartu=${b}`).then(function(a){var n=a.data.m_kartu.charge_price,i=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(i)}).catch(function(a){console.log(a)})}else $("[data-field=x_total]").val(t);var u=$(this).val(),k=$("#x_id_pelanggan").val(),x=axios.get(`api/?action=list&object=m_pelanggan&id_pelanggan=${k}`),g=axios.get("api/?action=list&object=m_member&recperpage=ALL"),h=axios.get("api/?action=list&object=m_jenis_member&recperpage=ALL"),m=axios.get("api/?action=list&object=m_poin&recperpage=ALL");axios.all([x,g,h,m]).then(axios.spread(function(...a){a[0].data.m_pelanggan.forEach(function(n,i){var e=a[1].data.m_member.find(function({id_pelanggan:a}){return a==n.id_pelanggan}),l=a[2].data.m_jenis_member.find(function({id_jenis_member:a}){return a==e.jenis_member}),d=a[3].data.m_poin.find(function({id_jenis_member:a}){return a==l.id_jenis_member});d.max_klaim;var o=u*d.curs_to_rp;$("#x_total_penukaran_poin").val(o);var r=$("#x_id_kartu").val(),_=$("#x_total_penukaran_poin").val();if(""!=r){r=$("#x_id_kartu").val();axios.get(`api/?action=view&object=m_kartu&id_kartu=${r}`).then(function(a){var n=a.data.m_kartu.charge_price,i=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(i-_)}).catch(function(a){console.log(a)})}else{_=$("#x_total_penukaran_poin").val();$("[data-field=x_total]").val(t-_)}})}))}),$("[data-field=x_harga_jual], [data-field=x_kode_barang]").change(function(){var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("#x_id_kartu").val(),f=$("#x_jumlah_voucher").val();if(""!=b)axios.get(`api/?action=view&object=m_kartu&id_kartu=${b}`).then(function(a){var n=a.data.m_kartu.charge_price,i=$("[data-field=x_total_penukaran_poin]").val();if(""!=i){var e=parseInt(t)-parseInt(n)*f-parseInt(i);$("[data-field=x_total]").val(e)}else{e=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(e)}}).catch(function(a){console.log(a)});else{var u=$("[data-field=x_total_penukaran_poin]").val();if(""!=u){var k=parseInt(t)-parseInt(u);$("[data-field=x_total]").val(k)}else $("[data-field=x_total]").val(t)}$("[data-field=x_total]").val(t);var x=$("[data-field=x_metode_pembayaran]").val();"Tunai"==x?$("[data-field=x_bayar]").val(""):"Tunai-Kredit"==x||"Tunai-Debit"==x?($("[data-field=x_bayar]").val(""),$("[data-field=x_bayar_non_tunai]").val(""),$("[data-field=x_total_non_tunai_charge]").val("0")):"Transfer"!=x&&"Debit"!=x&&"Kredit"!=x||($("[data-field=x_bayar_non_tunai]").val(""),$("[data-field=x_total_non_tunai_charge]").val("0"))}),$("[data-field=x_harga_jual], [data-field=x_qty], [data-field=x_diskon_persen], [data-field=x_diskon_rupiah], [data-field=x_ppn], [data-field=x_disc_pr], [data-field=x_disc_rp], [data-field=x_ongkir], [data-field=x_voucher_barang]").keyup(function(){var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("#x_id_kartu").val(),f=$("#x_jumlah_voucher").val();if(""!=b)axios.get(`api/?action=view&object=m_kartu&id_kartu=${b}`).then(function(a){var n=a.data.m_kartu.charge_price,i=$("[data-field=x_total_penukaran_poin]").val();if(""!=i){var e=parseInt(t)-parseInt(n)*f-parseInt(i);$("[data-field=x_total]").val(e)}else{e=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(e)}}).catch(function(a){console.log(a)});else{var u=$("[data-field=x_total_penukaran_poin]").val();if(""!=u){var k=parseInt(t)-parseInt(u);$("[data-field=x_total]").val(k)}else $("[data-field=x_total]").val(t)}var x=$("[data-field=x_metode_pembayaran]").val();"Tunai"==x?$("[data-field=x_bayar]").val(""):"Tunai-Kredit"==x||"Tunai-Debit"==x?($("[data-field=x_bayar]").val(""),$("[data-field=x_bayar_non_tunai]").val(""),$("[data-field=x_total_non_tunai_charge]").val("0")):"Transfer"!=x&&"Debit"!=x&&"Kredit"!=x&&"E-Wallet"!=x||($("[data-field=x_bayar_non_tunai]").val(""),$("[data-field=x_total_non_tunai_charge]").val("0"))}),$("#x_bayar").keyup(function(){$("[data-field=x_total_non_tunai_charge]").val("0");var a=parseInt($("[data-field=x_total]").val().split(".").join("")),t=parseInt($("[data-field=x_bayar]").val()),n=parseInt($("[data-field=x_total_non_tunai_charge]").val()),i=parseInt(t+n)-a;console.log("Non Tunai: "+n),$("#kembalian").val(i),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}),$("#x_id_rmd").keydown(function(){drawDetailRMD($("#x_id_rmd").val())}),$("#x_id_pelanggan").change(function(){$("#x_id_rmd").val(""),$("#sv_x_id_rmd").val("");var a=$(this).val();axios.get(`api/?action=list&object=rekmeddokter&id_pelanggan=${a}`).then(function(a){console.log(a.data);var t=a.data.rekmeddokter;t.sort();var n=t[0].id_rekmeddok,i=t[0].kode_rekmeddok;$("#sv_x_id_rmd").val(i),$("#x_id_rmd").val(n),drawDetailRMD(n)}).catch(function(a){console.log(a)})}),$("#x_id_kartubank").change(function(){var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("#x_id_kartu").val(),f=$("#x_jumlah_voucher").val();if(""!=b)axios.get(`api/?action=view&object=m_kartu&id_kartu=${b}`).then(function(a){var n=a.data.m_kartu.charge_price,i=$("[data-field=x_total_penukaran_poin]").val();if(""!=i){var e=parseInt(t)-parseInt(n)*f-parseInt(i);$("[data-field=x_total]").val(e)}else{e=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(e)}}).catch(function(a){console.log(a)});else{var u=$("[data-field=x_total_penukaran_poin]").val();if(""!=u){var k=parseInt(t)-parseInt(u);$("[data-field=x_total]").val(k)}else $("[data-field=x_total]").val(t)}$("[data-field=x_charge]").val("");$("[data-field=x_total]").val().split(".").join("");var x=$("#x_id_kartubank").val(),g=$("[data-field=x_bayar_non_tunai]").val();console.log(g),axios.get(`api/?action=view&object=m_kartu&id_kartu=${x}`).then(function(a){var t=a.data.m_kartu,n=t.charge_price;if("Persentase"==t.charge_type){var i=n.replace(".",","),e=parseInt(g)+parseInt(n/100*g);null!=i?($("[data-field=x_charge]").val(i),""!=g&&($("[data-field=x_total_non_tunai_charge]").val(e),$("[data-field=x_total]").val(e))):$("[data-field=x_charge]").val("0")}else{e=parseInt(g)+parseInt(n);null!=n?($("[data-field=x_charge]").val(n),""!=g&&($("[data-field=x_total_non_tunai_charge]").val(e),$("[data-field=x_total]").val(e))):$("[data-field=x_charge]").val("0")}}).catch(function(a){console.log(a)})}),$("#x_bayar_non_tunai").keyup(function(){var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("#x_id_kartu").val(),f=$("#x_jumlah_voucher").val();if(""!=b)axios.get(`api/?action=view&object=m_kartu&id_kartu=${b}`).then(function(a){var n=a.data.m_kartu.charge_price,i=$("[data-field=x_total_penukaran_poin]").val();if(""!=i){var e=parseInt(t)-parseInt(n)*f-parseInt(i);$("[data-field=x_total]").val(e)}else{e=parseInt(t)-parseInt(n)*f;$("[data-field=x_total]").val(e)}}).catch(function(a){console.log(a)});else{var u=$("[data-field=x_total_penukaran_poin]").val();if(""!=u){var k=parseInt(t)-parseInt(u);$("[data-field=x_total]").val(k)}else $("[data-field=x_total]").val(t)}var x=$("[data-field=x_total]").val().split(".").join(""),g=$("#x_id_kartubank").val(),h=$(this).val();console.log(x),axios.get(`api/?action=view&object=m_kartu&id_kartu=${g}`).then(function(a){var n=a.data.m_kartu,i=n.charge_price,e=n.charge_type;if(console.log(i),"Persentase"==e){var l=$("#x_id_kartu").val(),d=$("#x_jumlah_voucher").val();if(""!=l)axios.get(`api/?action=view&object=m_kartu&id_kartu=${l}`).then(function(a){var n=a.data.m_kartu.charge_price,e=$("[data-field=x_total_penukaran_poin]").val();if(""!=e){var l=parseInt(t)-parseInt(n)*d-parseInt(e),o=(i.replace(".",","),parseInt(l)+parseInt(i/100*h)),r=parseInt(h)+parseInt(i/100*h);console.log(o),console.log(r),$("[data-field=x_total]").val(o),$("[data-field=x_total_non_tunai_charge]").val(r);var _=parseInt($("[data-field=x_bayar]").val()),s=parseInt(_+r)-o;$("#kembalian").val(s),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}else{l=parseInt(t)-parseInt(n)*d,i.replace(".",","),o=parseInt(l)+parseInt(i/100*h),r=parseInt(h)+parseInt(i/100*h);console.log(o),console.log(r),$("[data-field=x_total]").val(o),$("[data-field=x_total_non_tunai_charge]").val(r);_=parseInt($("[data-field=x_bayar]").val()),s=parseInt(_+r)-o;$("#kembalian").val(s),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}}).catch(function(a){console.log(a)});else if(""!=(c=$("[data-field=x_total_penukaran_poin]").val())){var o=parseInt(t)-parseInt(c),r=(i.replace(".",","),parseInt(o)+parseInt(i/100*h)),_=parseInt(h)+parseInt(i/100*h);console.log(r),console.log(_),$("[data-field=x_total]").val(r),$("[data-field=x_total_non_tunai_charge]").val(_);var s=parseInt($("[data-field=x_bayar]").val()),v=parseInt(s+_)-r;$("#kembalian").val(v),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}else{i.replace(".",","),r=parseInt(t)+parseInt(i/100*h),_=parseInt(h)+parseInt(i/100*h);console.log(r),console.log(_),$("[data-field=x_total]").val(r),$("[data-field=x_total_non_tunai_charge]").val(_);s=parseInt($("[data-field=x_bayar]").val()),v=parseInt(s+_)-r;$("#kembalian").val(v),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}}else{var c;l=$("#x_id_kartu").val(),d=$("#x_jumlah_voucher").val();if(""!=l)axios.get(`api/?action=view&object=m_kartu&id_kartu=${l}`).then(function(a){var n=a.data.m_kartu.charge_price,e=$("[data-field=x_total_penukaran_poin]").val();if(""!=e){var l=parseInt(t)-parseInt(n)*d-parseInt(e),o=parseInt(l)+parseInt(i),r=parseInt(h)+parseInt(i);console.log(o),console.log(r),$("[data-field=x_total]").val(o),$("[data-field=x_total_non_tunai_charge]").val(r);var _=parseInt($("[data-field=x_bayar]").val()),s=parseInt(_+r)-o;$("#kembalian").val(s),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}else{l=parseInt(t)-parseInt(n)*d,o=parseInt(l)+parseInt(i),r=parseInt(h)+parseInt(i);console.log(o),console.log(r),$("[data-field=x_total]").val(o),$("[data-field=x_total_non_tunai_charge]").val(r);_=parseInt($("[data-field=x_bayar]").val()),s=parseInt(_+r)-o;$("#kembalian").val(s),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}}).catch(function(a){console.log(a)});else if(""!=(c=$("[data-field=x_total_penukaran_poin]").val())){o=parseInt(t)-parseInt(c),r=parseInt(o)+parseInt(i),_=parseInt(h)+parseInt(i);console.log(r),console.log(_),$("[data-field=x_total]").val(r),$("[data-field=x_total_non_tunai_charge]").val(_);s=parseInt($("[data-field=x_bayar]").val()),v=parseInt(s+_)-r;$("#kembalian").val(v),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}else{r=parseInt(t)+parseInt(i),_=parseInt(h)+parseInt(i);console.log(r),console.log(_),$("[data-field=x_total]").val(r),$("[data-field=x_total_non_tunai_charge]").val(_);s=parseInt($("[data-field=x_bayar]").val()),v=parseInt(s+_)-r;$("#kembalian").val(v),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak"))}}}).catch(function(a){$("[data-field=x_total_non_tunai_charge]").val(h);var t=parseInt($("[data-field=x_bayar]").val()),n=parseInt($("[data-field=x_bayar_non_tunai]").val()),i=parseInt(t+n)-x;$("#kembalian").val(i),$("#kembalian").val()<0?(btnLoading("btn-action"),btnLoading("btn-action-cetak")):$("#kembalian").val()>=0&&(btnLoadingGone("btn-action"),btnLoadingGoneCetak("btn-action-cetak")),console.log(a)})}),$("#x_id_kartu").change(function(){$("#x_jumlah_voucher").val("1");var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),charge=$("[data-field=x_charge]").val(),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,charge?charge=charge.split(",").join("."):charge=0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("[data-field=x_total_penukaran_poin]").val();if(""!=b){var f=parseInt(t)-b;$("[data-field=x_total]").val(f)}else $("[data-field=x_total]").val(t);var u=$("[data-field=x_total]").val(),k=$("#x_id_kartu").val(),x=$("#x_jumlah_voucher").val();axios.get(`api/?action=view&object=m_kartu&id_kartu=${k}`).then(function(a){var t=a.data.m_kartu.charge_price,n=$("[data-field=x_total_penukaran_poin]").val();if(""!=n){var i=parseInt(u)-parseInt(t)*x-n;$("[data-field=x_total]").val(i)}else{i=parseInt(u)-parseInt(t)*x;$("[data-field=x_total]").val(i)}}).catch(function(a){console.log(a)})}),$("#x_jumlah_voucher").keyup(function(){var a,t,n,i,e,l="#"+$(this).attr("id").split("_")[0],d=l+"_harga_jual",o=l+"_qty",r=l+"_disc_pr",_=l+"_disc_rp",s=l+"_voucher_barang",v=l+"_subtotal",c=parseInt(0),p=0;d=$(d).val()?$(d).val().split(".").join(""):0,r=$(r).val()?$(r).val().split(",").join("."):0,a=d*$(o).val(),$(v).val(a-a*r/100-$(_).val()-$(s).val()),$("[data-field=x_subtotal]").each(function(){$(this).val()&&(c+=parseInt($(this).val()))}),charge=$("[data-field=x_charge]").val(),p=$("[data-field=x_diskon_persen]").val(),n=$("[data-field=x_diskon_rupiah]").val(),i=$("[data-field=x_ppn]").val(),e=$("[data-field=x_ongkir]").val(),p=p?p.split(",").join("."):0,charge?charge=charge.split(",").join("."):charge=0,t=c-n-c*p/100+c*i/100+parseInt(e);var b=$("[data-field=x_total_penukaran_poin]").val();if(""!=b){var f=parseInt(t)-b;$("[data-field=x_total]").val(f)}else $("[data-field=x_total]").val(t);var u=$("[data-field=x_total]").val(),k=$("#x_id_kartu").val(),x=$(this).val();axios.get(`api/?action=view&object=m_kartu&id_kartu=${k}`).then(function(a){var t=a.data.m_kartu.charge_price,n=$("[data-field=x_total_penukaran_poin]").val();if(""!=n){var i=parseInt(u)-parseInt(t)*x-n;$("[data-field=x_total]").val(i)}else{i=parseInt(u)-parseInt(t)*x;$("[data-field=x_total]").val(i)}}).catch(function(a){console.log(a)})});
});
</script>
<?php $penjualan_edit->showPageHeader(); ?>
<?php
$penjualan_edit->showMessage();
?>
<form name="fpenjualanedit" id="fpenjualanedit" class="<?php echo $penjualan_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penjualan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$penjualan_edit->IsModal ?>">
<div class="ew-edit-div d-none"><!-- page* -->
<?php if ($penjualan_edit->kode_penjualan->Visible) { // kode_penjualan ?>
	<div id="r_kode_penjualan" class="form-group row">
		<label id="elh_penjualan_kode_penjualan" for="x_kode_penjualan" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_kode_penjualan" type="text/html"><?php echo $penjualan_edit->kode_penjualan->caption() ?><?php echo $penjualan_edit->kode_penjualan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->kode_penjualan->cellAttributes() ?>>
<script id="tpx_penjualan_kode_penjualan" type="text/html"><span id="el_penjualan_kode_penjualan">
<input type="text" data-table="penjualan" data-field="x_kode_penjualan" name="x_kode_penjualan" id="x_kode_penjualan" size="15" maxlength="20" placeholder="<?php echo HtmlEncode($penjualan_edit->kode_penjualan->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->kode_penjualan->EditValue ?>"<?php echo $penjualan_edit->kode_penjualan->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->kode_penjualan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_pelanggan->Visible) { // id_pelanggan ?>
	<div id="r_id_pelanggan" class="form-group row">
		<label id="elh_penjualan_id_pelanggan" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_pelanggan" type="text/html"><?php echo $penjualan_edit->id_pelanggan->caption() ?><?php echo $penjualan_edit->id_pelanggan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_pelanggan->cellAttributes() ?>>
<script id="tpx_penjualan_id_pelanggan" type="text/html"><span id="el_penjualan_id_pelanggan">
<?php
$onchange = $penjualan_edit->id_pelanggan->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penjualan_edit->id_pelanggan->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_pelanggan">
	<input type="text" class="form-control" name="sv_x_id_pelanggan" id="sv_x_id_pelanggan" value="<?php echo RemoveHtml($penjualan_edit->id_pelanggan->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($penjualan_edit->id_pelanggan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penjualan_edit->id_pelanggan->getPlaceHolder()) ?>"<?php echo $penjualan_edit->id_pelanggan->editAttributes() ?>>
</span>
<input type="hidden" data-table="penjualan" data-field="x_id_pelanggan" data-value-separator="<?php echo $penjualan_edit->id_pelanggan->displayValueSeparatorAttribute() ?>" name="x_id_pelanggan" id="x_id_pelanggan" value="<?php echo HtmlEncode($penjualan_edit->id_pelanggan->CurrentValue) ?>"<?php echo $onchange ?>>
<?php echo $penjualan_edit->id_pelanggan->Lookup->getParamTag($penjualan_edit, "p_x_id_pelanggan") ?>
</span></script>
<script type="text/html" class="penjualanedit_js">
loadjs.ready(["fpenjualanedit"], function() {
	fpenjualanedit.createAutoSuggest({"id":"x_id_pelanggan","forceSelect":true});
});
</script>
<?php echo $penjualan_edit->id_pelanggan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_member->Visible) { // id_member ?>
	<div id="r_id_member" class="form-group row">
		<label id="elh_penjualan_id_member" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_member" type="text/html"><?php echo $penjualan_edit->id_member->caption() ?><?php echo $penjualan_edit->id_member->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_member->cellAttributes() ?>>
<script id="tpx_penjualan_id_member" type="text/html"><span id="el_penjualan_id_member">
<?php
$onchange = $penjualan_edit->id_member->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penjualan_edit->id_member->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_member">
	<input type="text" class="form-control" name="sv_x_id_member" id="sv_x_id_member" value="<?php echo RemoveHtml($penjualan_edit->id_member->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_edit->id_member->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penjualan_edit->id_member->getPlaceHolder()) ?>"<?php echo $penjualan_edit->id_member->editAttributes() ?>>
</span>
<input type="hidden" data-table="penjualan" data-field="x_id_member" data-value-separator="<?php echo $penjualan_edit->id_member->displayValueSeparatorAttribute() ?>" name="x_id_member" id="x_id_member" value="<?php echo HtmlEncode($penjualan_edit->id_member->CurrentValue) ?>"<?php echo $onchange ?>>
<?php echo $penjualan_edit->id_member->Lookup->getParamTag($penjualan_edit, "p_x_id_member") ?>
</span></script>
<script type="text/html" class="penjualanedit_js">
loadjs.ready(["fpenjualanedit"], function() {
	fpenjualanedit.createAutoSuggest({"id":"x_id_member","forceSelect":false});
});
</script>
<?php echo $penjualan_edit->id_member->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->waktu->Visible) { // waktu ?>
	<div id="r_waktu" class="form-group row">
		<label id="elh_penjualan_waktu" for="x_waktu" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_waktu" type="text/html"><?php echo $penjualan_edit->waktu->caption() ?><?php echo $penjualan_edit->waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->waktu->cellAttributes() ?>>
<script id="tpx_penjualan_waktu" type="text/html"><span id="el_penjualan_waktu">
<input type="text" data-table="penjualan" data-field="x_waktu" data-format="7" name="x_waktu" id="x_waktu" maxlength="19" placeholder="<?php echo HtmlEncode($penjualan_edit->waktu->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->waktu->EditValue ?>"<?php echo $penjualan_edit->waktu->editAttributes() ?>>
<?php if (!$penjualan_edit->waktu->ReadOnly && !$penjualan_edit->waktu->Disabled && !isset($penjualan_edit->waktu->EditAttrs["readonly"]) && !isset($penjualan_edit->waktu->EditAttrs["disabled"])) { ?>
<?php } ?>
</span></script>
<script type="text/html" class="penjualanedit_js">
loadjs.ready(["fpenjualanedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fpenjualanedit", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php echo $penjualan_edit->waktu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->diskon_persen->Visible) { // diskon_persen ?>
	<div id="r_diskon_persen" class="form-group row">
		<label id="elh_penjualan_diskon_persen" for="x_diskon_persen" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_diskon_persen" type="text/html"><?php echo $penjualan_edit->diskon_persen->caption() ?><?php echo $penjualan_edit->diskon_persen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->diskon_persen->cellAttributes() ?>>
<script id="tpx_penjualan_diskon_persen" type="text/html"><span id="el_penjualan_diskon_persen">
<input type="text" data-table="penjualan" data-field="x_diskon_persen" name="x_diskon_persen" id="x_diskon_persen" size="10" maxlength="50" placeholder="<?php echo HtmlEncode($penjualan_edit->diskon_persen->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->diskon_persen->EditValue ?>"<?php echo $penjualan_edit->diskon_persen->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->diskon_persen->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->diskon_rupiah->Visible) { // diskon_rupiah ?>
	<div id="r_diskon_rupiah" class="form-group row">
		<label id="elh_penjualan_diskon_rupiah" for="x_diskon_rupiah" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_diskon_rupiah" type="text/html"><?php echo $penjualan_edit->diskon_rupiah->caption() ?><?php echo $penjualan_edit->diskon_rupiah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->diskon_rupiah->cellAttributes() ?>>
<script id="tpx_penjualan_diskon_rupiah" type="text/html"><span id="el_penjualan_diskon_rupiah">
<input type="text" data-table="penjualan" data-field="x_diskon_rupiah" name="x_diskon_rupiah" id="x_diskon_rupiah" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->diskon_rupiah->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->diskon_rupiah->EditValue ?>"<?php echo $penjualan_edit->diskon_rupiah->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->diskon_rupiah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->ppn->Visible) { // ppn ?>
	<div id="r_ppn" class="form-group row">
		<label id="elh_penjualan_ppn" for="x_ppn" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_ppn" type="text/html"><?php echo $penjualan_edit->ppn->caption() ?><?php echo $penjualan_edit->ppn->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->ppn->cellAttributes() ?>>
<script id="tpx_penjualan_ppn" type="text/html"><span id="el_penjualan_ppn">
<input type="text" data-table="penjualan" data-field="x_ppn" name="x_ppn" id="x_ppn" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->ppn->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->ppn->EditValue ?>"<?php echo $penjualan_edit->ppn->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->ppn->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_penjualan_total" for="x_total" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_total" type="text/html"><?php echo $penjualan_edit->total->caption() ?><?php echo $penjualan_edit->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->total->cellAttributes() ?>>
<script id="tpx_penjualan_total" type="text/html"><span id="el_penjualan_total">
<input type="text" data-table="penjualan" data-field="x_total" name="x_total" id="x_total" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->total->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->total->EditValue ?>"<?php echo $penjualan_edit->total->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->bayar->Visible) { // bayar ?>
	<div id="r_bayar" class="form-group row">
		<label id="elh_penjualan_bayar" for="x_bayar" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_bayar" type="text/html"><?php echo $penjualan_edit->bayar->caption() ?><?php echo $penjualan_edit->bayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->bayar->cellAttributes() ?>>
<script id="tpx_penjualan_bayar" type="text/html"><span id="el_penjualan_bayar">
<input type="text" data-table="penjualan" data-field="x_bayar" name="x_bayar" id="x_bayar" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->bayar->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->bayar->EditValue ?>"<?php echo $penjualan_edit->bayar->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->bayar->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->bayar_non_tunai->Visible) { // bayar_non_tunai ?>
	<div id="r_bayar_non_tunai" class="form-group row">
		<label id="elh_penjualan_bayar_non_tunai" for="x_bayar_non_tunai" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_bayar_non_tunai" type="text/html"><?php echo $penjualan_edit->bayar_non_tunai->caption() ?><?php echo $penjualan_edit->bayar_non_tunai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->bayar_non_tunai->cellAttributes() ?>>
<script id="tpx_penjualan_bayar_non_tunai" type="text/html"><span id="el_penjualan_bayar_non_tunai">
<input type="text" data-table="penjualan" data-field="x_bayar_non_tunai" name="x_bayar_non_tunai" id="x_bayar_non_tunai" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->bayar_non_tunai->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->bayar_non_tunai->EditValue ?>"<?php echo $penjualan_edit->bayar_non_tunai->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->bayar_non_tunai->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->total_non_tunai_charge->Visible) { // total_non_tunai_charge ?>
	<div id="r_total_non_tunai_charge" class="form-group row">
		<label id="elh_penjualan_total_non_tunai_charge" for="x_total_non_tunai_charge" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_total_non_tunai_charge" type="text/html"><?php echo $penjualan_edit->total_non_tunai_charge->caption() ?><?php echo $penjualan_edit->total_non_tunai_charge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->total_non_tunai_charge->cellAttributes() ?>>
<script id="tpx_penjualan_total_non_tunai_charge" type="text/html"><span id="el_penjualan_total_non_tunai_charge">
<input type="text" data-table="penjualan" data-field="x_total_non_tunai_charge" name="x_total_non_tunai_charge" id="x_total_non_tunai_charge" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->total_non_tunai_charge->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->total_non_tunai_charge->EditValue ?>"<?php echo $penjualan_edit->total_non_tunai_charge->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->total_non_tunai_charge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->keterangan->Visible) { // keterangan ?>
	<div id="r_keterangan" class="form-group row">
		<label id="elh_penjualan_keterangan" for="x_keterangan" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_keterangan" type="text/html"><?php echo $penjualan_edit->keterangan->caption() ?><?php echo $penjualan_edit->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->keterangan->cellAttributes() ?>>
<script id="tpx_penjualan_keterangan" type="text/html"><span id="el_penjualan_keterangan">
<textarea data-table="penjualan" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?php echo HtmlEncode($penjualan_edit->keterangan->getPlaceHolder()) ?>"<?php echo $penjualan_edit->keterangan->editAttributes() ?>><?php echo $penjualan_edit->keterangan->EditValue ?></textarea>
</span></script>
<?php echo $penjualan_edit->keterangan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_klinik->Visible) { // id_klinik ?>
	<div id="r_id_klinik" class="form-group row">
		<label id="elh_penjualan_id_klinik" for="x_id_klinik" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_klinik" type="text/html"><?php echo $penjualan_edit->id_klinik->caption() ?><?php echo $penjualan_edit->id_klinik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_klinik->cellAttributes() ?>>
<script id="tpx_penjualan_id_klinik" type="text/html"><span id="el_penjualan_id_klinik">
<?php $penjualan_edit->id_klinik->EditAttrs->prepend("onclick", "ew.updateOptions.call(this);"); ?>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($penjualan_edit->id_klinik->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $penjualan_edit->id_klinik->ViewValue ?></button>
		<div id="dsl_x_id_klinik" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $penjualan_edit->id_klinik->radioButtonListHtml(TRUE, "x_id_klinik") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_id_klinik" class="ew-template"><input type="radio" class="custom-control-input" data-table="penjualan" data-field="x_id_klinik" data-value-separator="<?php echo $penjualan_edit->id_klinik->displayValueSeparatorAttribute() ?>" name="x_id_klinik" id="x_id_klinik" value="{value}"<?php echo $penjualan_edit->id_klinik->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$penjualan_edit->id_klinik->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $penjualan_edit->id_klinik->Lookup->getParamTag($penjualan_edit, "p_x_id_klinik") ?>
</span></script>
<?php echo $penjualan_edit->id_klinik->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_rmd->Visible) { // id_rmd ?>
	<div id="r_id_rmd" class="form-group row">
		<label id="elh_penjualan_id_rmd" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_rmd" type="text/html"><?php echo $penjualan_edit->id_rmd->caption() ?><?php echo $penjualan_edit->id_rmd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_rmd->cellAttributes() ?>>
<script id="tpx_penjualan_id_rmd" type="text/html"><span id="el_penjualan_id_rmd">
<?php
$onchange = $penjualan_edit->id_rmd->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$penjualan_edit->id_rmd->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_rmd">
	<input type="text" class="form-control" name="sv_x_id_rmd" id="sv_x_id_rmd" value="<?php echo RemoveHtml($penjualan_edit->id_rmd->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_edit->id_rmd->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($penjualan_edit->id_rmd->getPlaceHolder()) ?>"<?php echo $penjualan_edit->id_rmd->editAttributes() ?>>
</span>
<input type="hidden" data-table="penjualan" data-field="x_id_rmd" data-value-separator="<?php echo $penjualan_edit->id_rmd->displayValueSeparatorAttribute() ?>" name="x_id_rmd" id="x_id_rmd" value="<?php echo HtmlEncode($penjualan_edit->id_rmd->CurrentValue) ?>"<?php echo $onchange ?>>
<?php echo $penjualan_edit->id_rmd->Lookup->getParamTag($penjualan_edit, "p_x_id_rmd") ?>
</span></script>
<script type="text/html" class="penjualanedit_js">
loadjs.ready(["fpenjualanedit"], function() {
	fpenjualanedit.createAutoSuggest({"id":"x_id_rmd","forceSelect":true});
});
</script>
<?php echo $penjualan_edit->id_rmd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->metode_pembayaran->Visible) { // metode_pembayaran ?>
	<div id="r_metode_pembayaran" class="form-group row">
		<label id="elh_penjualan_metode_pembayaran" for="x_metode_pembayaran" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_metode_pembayaran" type="text/html"><?php echo $penjualan_edit->metode_pembayaran->caption() ?><?php echo $penjualan_edit->metode_pembayaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->metode_pembayaran->cellAttributes() ?>>
<script id="tpx_penjualan_metode_pembayaran" type="text/html"><span id="el_penjualan_metode_pembayaran">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_metode_pembayaran" data-value-separator="<?php echo $penjualan_edit->metode_pembayaran->displayValueSeparatorAttribute() ?>" id="x_metode_pembayaran" name="x_metode_pembayaran"<?php echo $penjualan_edit->metode_pembayaran->editAttributes() ?>>
			<?php echo $penjualan_edit->metode_pembayaran->selectOptionListHtml("x_metode_pembayaran") ?>
		</select>
</div>
</span></script>
<?php echo $penjualan_edit->metode_pembayaran->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_bank->Visible) { // id_bank ?>
	<div id="r_id_bank" class="form-group row">
		<label id="elh_penjualan_id_bank" for="x_id_bank" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_bank" type="text/html"><?php echo $penjualan_edit->id_bank->caption() ?><?php echo $penjualan_edit->id_bank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_bank->cellAttributes() ?>>
<script id="tpx_penjualan_id_bank" type="text/html"><span id="el_penjualan_id_bank">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_bank" data-value-separator="<?php echo $penjualan_edit->id_bank->displayValueSeparatorAttribute() ?>" id="x_id_bank" name="x_id_bank"<?php echo $penjualan_edit->id_bank->editAttributes() ?>>
			<?php echo $penjualan_edit->id_bank->selectOptionListHtml("x_id_bank") ?>
		</select>
</div>
<?php echo $penjualan_edit->id_bank->Lookup->getParamTag($penjualan_edit, "p_x_id_bank") ?>
</span></script>
<?php echo $penjualan_edit->id_bank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_kartu->Visible) { // id_kartu ?>
	<div id="r_id_kartu" class="form-group row">
		<label id="elh_penjualan_id_kartu" for="x_id_kartu" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_kartu" type="text/html"><?php echo $penjualan_edit->id_kartu->caption() ?><?php echo $penjualan_edit->id_kartu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_kartu->cellAttributes() ?>>
<script id="tpx_penjualan_id_kartu" type="text/html"><span id="el_penjualan_id_kartu">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_kartu" data-value-separator="<?php echo $penjualan_edit->id_kartu->displayValueSeparatorAttribute() ?>" id="x_id_kartu" name="x_id_kartu"<?php echo $penjualan_edit->id_kartu->editAttributes() ?>>
			<?php echo $penjualan_edit->id_kartu->selectOptionListHtml("x_id_kartu") ?>
		</select>
</div>
<?php echo $penjualan_edit->id_kartu->Lookup->getParamTag($penjualan_edit, "p_x_id_kartu") ?>
</span></script>
<?php echo $penjualan_edit->id_kartu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->jumlah_voucher->Visible) { // jumlah_voucher ?>
	<div id="r_jumlah_voucher" class="form-group row">
		<label id="elh_penjualan_jumlah_voucher" for="x_jumlah_voucher" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_jumlah_voucher" type="text/html"><?php echo $penjualan_edit->jumlah_voucher->caption() ?><?php echo $penjualan_edit->jumlah_voucher->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->jumlah_voucher->cellAttributes() ?>>
<script id="tpx_penjualan_jumlah_voucher" type="text/html"><span id="el_penjualan_jumlah_voucher">
<input type="text" data-table="penjualan" data-field="x_jumlah_voucher" name="x_jumlah_voucher" id="x_jumlah_voucher" size="4" maxlength="11" placeholder="<?php echo HtmlEncode($penjualan_edit->jumlah_voucher->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->jumlah_voucher->EditValue ?>"<?php echo $penjualan_edit->jumlah_voucher->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->jumlah_voucher->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->sales->Visible) { // sales ?>
	<div id="r_sales" class="form-group row">
		<label id="elh_penjualan_sales" for="x_sales" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_sales" type="text/html"><?php echo $penjualan_edit->sales->caption() ?><?php echo $penjualan_edit->sales->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->sales->cellAttributes() ?>>
<script id="tpx_penjualan_sales" type="text/html"><span id="el_penjualan_sales">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_sales" data-value-separator="<?php echo $penjualan_edit->sales->displayValueSeparatorAttribute() ?>" id="x_sales" name="x_sales"<?php echo $penjualan_edit->sales->editAttributes() ?>>
			<?php echo $penjualan_edit->sales->selectOptionListHtml("x_sales") ?>
		</select>
</div>
<?php echo $penjualan_edit->sales->Lookup->getParamTag($penjualan_edit, "p_x_sales") ?>
</span></script>
<?php echo $penjualan_edit->sales->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->dok_be_wajah->Visible) { // dok_be_wajah ?>
	<div id="r_dok_be_wajah" class="form-group row">
		<label id="elh_penjualan_dok_be_wajah" for="x_dok_be_wajah" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_dok_be_wajah" type="text/html"><?php echo $penjualan_edit->dok_be_wajah->caption() ?><?php echo $penjualan_edit->dok_be_wajah->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->dok_be_wajah->cellAttributes() ?>>
<script id="tpx_penjualan_dok_be_wajah" type="text/html"><span id="el_penjualan_dok_be_wajah">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_dok_be_wajah" data-value-separator="<?php echo $penjualan_edit->dok_be_wajah->displayValueSeparatorAttribute() ?>" id="x_dok_be_wajah" name="x_dok_be_wajah"<?php echo $penjualan_edit->dok_be_wajah->editAttributes() ?>>
			<?php echo $penjualan_edit->dok_be_wajah->selectOptionListHtml("x_dok_be_wajah") ?>
		</select>
</div>
<?php echo $penjualan_edit->dok_be_wajah->Lookup->getParamTag($penjualan_edit, "p_x_dok_be_wajah") ?>
</span></script>
<?php echo $penjualan_edit->dok_be_wajah->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->be_body->Visible) { // be_body ?>
	<div id="r_be_body" class="form-group row">
		<label id="elh_penjualan_be_body" for="x_be_body" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_be_body" type="text/html"><?php echo $penjualan_edit->be_body->caption() ?><?php echo $penjualan_edit->be_body->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->be_body->cellAttributes() ?>>
<script id="tpx_penjualan_be_body" type="text/html"><span id="el_penjualan_be_body">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_be_body" data-value-separator="<?php echo $penjualan_edit->be_body->displayValueSeparatorAttribute() ?>" id="x_be_body" name="x_be_body"<?php echo $penjualan_edit->be_body->editAttributes() ?>>
			<?php echo $penjualan_edit->be_body->selectOptionListHtml("x_be_body") ?>
		</select>
</div>
<?php echo $penjualan_edit->be_body->Lookup->getParamTag($penjualan_edit, "p_x_be_body") ?>
</span></script>
<?php echo $penjualan_edit->be_body->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->medis->Visible) { // medis ?>
	<div id="r_medis" class="form-group row">
		<label id="elh_penjualan_medis" for="x_medis" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_medis" type="text/html"><?php echo $penjualan_edit->medis->caption() ?><?php echo $penjualan_edit->medis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->medis->cellAttributes() ?>>
<script id="tpx_penjualan_medis" type="text/html"><span id="el_penjualan_medis">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_medis" data-value-separator="<?php echo $penjualan_edit->medis->displayValueSeparatorAttribute() ?>" id="x_medis" name="x_medis"<?php echo $penjualan_edit->medis->editAttributes() ?>>
			<?php echo $penjualan_edit->medis->selectOptionListHtml("x_medis") ?>
		</select>
</div>
<?php echo $penjualan_edit->medis->Lookup->getParamTag($penjualan_edit, "p_x_medis") ?>
</span></script>
<?php echo $penjualan_edit->medis->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->dokter->Visible) { // dokter ?>
	<div id="r_dokter" class="form-group row">
		<label id="elh_penjualan_dokter" for="x_dokter" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_dokter" type="text/html"><?php echo $penjualan_edit->dokter->caption() ?><?php echo $penjualan_edit->dokter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->dokter->cellAttributes() ?>>
<script id="tpx_penjualan_dokter" type="text/html"><span id="el_penjualan_dokter">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_dokter" data-value-separator="<?php echo $penjualan_edit->dokter->displayValueSeparatorAttribute() ?>" id="x_dokter" name="x_dokter"<?php echo $penjualan_edit->dokter->editAttributes() ?>>
			<?php echo $penjualan_edit->dokter->selectOptionListHtml("x_dokter") ?>
		</select>
</div>
<?php echo $penjualan_edit->dokter->Lookup->getParamTag($penjualan_edit, "p_x_dokter") ?>
</span></script>
<?php echo $penjualan_edit->dokter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_kartubank->Visible) { // id_kartubank ?>
	<div id="r_id_kartubank" class="form-group row">
		<label id="elh_penjualan_id_kartubank" for="x_id_kartubank" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_kartubank" type="text/html"><?php echo $penjualan_edit->id_kartubank->caption() ?><?php echo $penjualan_edit->id_kartubank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_kartubank->cellAttributes() ?>>
<script id="tpx_penjualan_id_kartubank" type="text/html"><span id="el_penjualan_id_kartubank">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_kartubank" data-value-separator="<?php echo $penjualan_edit->id_kartubank->displayValueSeparatorAttribute() ?>" id="x_id_kartubank" name="x_id_kartubank"<?php echo $penjualan_edit->id_kartubank->editAttributes() ?>>
			<?php echo $penjualan_edit->id_kartubank->selectOptionListHtml("x_id_kartubank") ?>
		</select>
</div>
<?php echo $penjualan_edit->id_kartubank->Lookup->getParamTag($penjualan_edit, "p_x_id_kartubank") ?>
</span></script>
<?php echo $penjualan_edit->id_kartubank->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->id_kas->Visible) { // id_kas ?>
	<div id="r_id_kas" class="form-group row">
		<label id="elh_penjualan_id_kas" for="x_id_kas" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_id_kas" type="text/html"><?php echo $penjualan_edit->id_kas->caption() ?><?php echo $penjualan_edit->id_kas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->id_kas->cellAttributes() ?>>
<script id="tpx_penjualan_id_kas" type="text/html"><span id="el_penjualan_id_kas">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="penjualan" data-field="x_id_kas" data-value-separator="<?php echo $penjualan_edit->id_kas->displayValueSeparatorAttribute() ?>" id="x_id_kas" name="x_id_kas"<?php echo $penjualan_edit->id_kas->editAttributes() ?>>
			<?php echo $penjualan_edit->id_kas->selectOptionListHtml("x_id_kas") ?>
		</select>
</div>
<?php echo $penjualan_edit->id_kas->Lookup->getParamTag($penjualan_edit, "p_x_id_kas") ?>
</span></script>
<?php echo $penjualan_edit->id_kas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->charge->Visible) { // charge ?>
	<div id="r_charge" class="form-group row">
		<label id="elh_penjualan_charge" for="x_charge" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_charge" type="text/html"><?php echo $penjualan_edit->charge->caption() ?><?php echo $penjualan_edit->charge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->charge->cellAttributes() ?>>
<script id="tpx_penjualan_charge" type="text/html"><span id="el_penjualan_charge">
<input type="text" data-table="penjualan" data-field="x_charge" name="x_charge" id="x_charge" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->charge->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->charge->EditValue ?>"<?php echo $penjualan_edit->charge->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->charge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->klaim_poin->Visible) { // klaim_poin ?>
	<div id="r_klaim_poin" class="form-group row">
		<label id="elh_penjualan_klaim_poin" for="x_klaim_poin" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_klaim_poin" type="text/html"><?php echo $penjualan_edit->klaim_poin->caption() ?><?php echo $penjualan_edit->klaim_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->klaim_poin->cellAttributes() ?>>
<script id="tpx_penjualan_klaim_poin" type="text/html"><span id="el_penjualan_klaim_poin">
<input type="text" data-table="penjualan" data-field="x_klaim_poin" name="x_klaim_poin" id="x_klaim_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->klaim_poin->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->klaim_poin->EditValue ?>"<?php echo $penjualan_edit->klaim_poin->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->klaim_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->total_penukaran_poin->Visible) { // total_penukaran_poin ?>
	<div id="r_total_penukaran_poin" class="form-group row">
		<label id="elh_penjualan_total_penukaran_poin" for="x_total_penukaran_poin" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_total_penukaran_poin" type="text/html"><?php echo $penjualan_edit->total_penukaran_poin->caption() ?><?php echo $penjualan_edit->total_penukaran_poin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->total_penukaran_poin->cellAttributes() ?>>
<script id="tpx_penjualan_total_penukaran_poin" type="text/html"><span id="el_penjualan_total_penukaran_poin">
<input type="text" data-table="penjualan" data-field="x_total_penukaran_poin" name="x_total_penukaran_poin" id="x_total_penukaran_poin" size="30" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->total_penukaran_poin->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->total_penukaran_poin->EditValue ?>"<?php echo $penjualan_edit->total_penukaran_poin->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->total_penukaran_poin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->ongkir->Visible) { // ongkir ?>
	<div id="r_ongkir" class="form-group row">
		<label id="elh_penjualan_ongkir" for="x_ongkir" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_ongkir" type="text/html"><?php echo $penjualan_edit->ongkir->caption() ?><?php echo $penjualan_edit->ongkir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->ongkir->cellAttributes() ?>>
<script id="tpx_penjualan_ongkir" type="text/html"><span id="el_penjualan_ongkir">
<input type="text" data-table="penjualan" data-field="x_ongkir" name="x_ongkir" id="x_ongkir" size="10" maxlength="22" placeholder="<?php echo HtmlEncode($penjualan_edit->ongkir->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->ongkir->EditValue ?>"<?php echo $penjualan_edit->ongkir->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->ongkir->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->_action->Visible) { // action ?>
	<div id="r__action" class="form-group row">
		<label id="elh_penjualan__action" for="x__action" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan__action" type="text/html"><?php echo $penjualan_edit->_action->caption() ?><?php echo $penjualan_edit->_action->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->_action->cellAttributes() ?>>
<script id="tpx_penjualan__action" type="text/html"><span id="el_penjualan__action">
<input type="text" data-table="penjualan" data-field="x__action" name="x__action" id="x__action" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($penjualan_edit->_action->getPlaceHolder()) ?>" value="<?php echo $penjualan_edit->_action->EditValue ?>"<?php echo $penjualan_edit->_action->editAttributes() ?>>
</span></script>
<?php echo $penjualan_edit->_action->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($penjualan_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_penjualan_status" class="<?php echo $penjualan_edit->LeftColumnClass ?>"><script id="tpc_penjualan_status" type="text/html"><?php echo $penjualan_edit->status->caption() ?><?php echo $penjualan_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></script></label>
		<div class="<?php echo $penjualan_edit->RightColumnClass ?>"><div <?php echo $penjualan_edit->status->cellAttributes() ?>>
<script id="tpx_penjualan_status" type="text/html"><span id="el_penjualan_status">
<div id="tp_x_status" class="ew-template"><input type="radio" class="custom-control-input" data-table="penjualan" data-field="x_status" data-value-separator="<?php echo $penjualan_edit->status->displayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $penjualan_edit->status->editAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $penjualan_edit->status->radioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span></script>
<?php echo $penjualan_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="penjualan" data-field="x_id" name="x_id" id="x_id" value="<?php echo HtmlEncode($penjualan_edit->id->CurrentValue) ?>">
<div id="tpd_penjualanedit" class="ew-custom-template"></div>
<script id="tpm_penjualanedit" type="text/html">
<div id="ct_penjualan_edit">    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<div class="container-fluid">
		<div class="card shadow-sm mt-3">
			<div class="card-body">
			  <div class="row">
				<div class="col-auto">
					<div id="r_id_pelanggan" class="form-group">
						<label id="elh_penjualan_id_pelanggan" for="x_id_pelanggan" class="control-label ewLabel">
						<?php echo $penjualan_edit->id_pelanggan->caption() ?></label>
						<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_pelanggan")/}}</div>
					</div>
				</div>
				<div class="col-auto">
					<div id="r_id_member" class="form-group">
						<label id="elh_penjualan_id_member" for="x_id_member" class="control-label ewLabel">
						<?php echo $penjualan_edit->id_member->caption() ?></label>
						<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_member")/}}</div>
					</div>
				</div>
				<div class="col-auto">
					<div id="r_waktu" class="form-group">
						<label id="elh_penjualan_waktu" for="x_waktu" class="control-label ewLabel">
						<?php echo $penjualan_edit->waktu->caption() ?></label>
						<div>{{include tmpl=~getTemplate("#tpx_penjualan_waktu")/}}</div>
					</div>
				</div>
				<div class="col-auto">
					<div id="r_id_klinik" class="form-group">
						<label id="elh_id_klinik" for="x_id_klinik" class="control-label ewLabel">
						<?php echo $penjualan_edit->id_klinik->caption() ?></label>
						<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_klinik")/}}</div>
					</div>
				</div>
				<div class="col-auto">
					<div id="r_id_rmd" class="form-group">
						<label id="elh_id_rmd" for="x_id_rmd" class="control-label ewLabel">
						<?php echo $penjualan_edit->id_rmd->caption() ?></label>
						<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_rmd")/}}</div>
					</div>
				</div>                  
			  </div>
			  <div class="row">
				<div id="detail-rmd" class="col-sm-6"></div>
			</div> <!-- end rekam medis penjualan -->
			</div>
		</div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-sm modal-dialog-centered">
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-body">
		  <b align="center">Please wait...</b>
		</div>
	  </div>
	</div>
  </div>
		<div class="card shadow-sm mt-3">
			<div class="card-body">
				<div id="daftar-barang" class="col-sm-12"></div> <!-- end detailpenjualan -->
				<div class="col-sm-10">
					<div id="r_keterangan" class="form-group">
						<label id="elh_penjualan_keterangan" for="x_keterangan" class="control-label ewLabel">
							<?php echo $penjualan_edit->keterangan->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_keterangan")/}}</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-md-8">
				<div class="row">
					<div class="card shadow-sm">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4">
									<div id="r_metode_pembayaran" class="form-group">
										<label id="elh_penjualan_metode_pembayaran" for="x_metode_pembayaran" class="control-label ewLabel"><?php echo $penjualan_edit->metode_pembayaran->caption() ?></label>
										<div>{{include tmpl=~getTemplate("#tpx_penjualan_metode_pembayaran")/}}</div>
									</div>
								</div>
								<div class="col-md-4">
									<div id="r_id_bank" class="form-group">
										<label id="elh_penjualan_id_bank" for="x_id_bank" class="control-label ewLabel">
										<?php echo $penjualan_edit->id_bank->caption() ?></label>
										<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_bank")/}}</div>
									</div>
								</div>
								<div class="col-md-4">
									<div id="r_id_kartubank" class="form-group">
										<label id="elh_penjualan_id_kartubank" for="x_id_kartubank" class="control-label ewLabel">
										<?php echo $penjualan_edit->id_kartubank->caption() ?></label>
										<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_kartubank")/}}</div>
									</div>
								</div>
								<div class="col-md-4">
									<div id="r_id_kas" class="form-group">
										<label id="elh_penjualan_id_kas" for="x_id_kas" class="control-label ewLabel">
										<?php echo $penjualan_edit->id_kas->caption() ?></label>
										<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_kas")/}}</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-3">
					<div class="card shadow-sm">
						<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div id="r_sales" class="form-group">
											<label id="elh_penjualan_sales" for="x_sales" class="control-label ewLabel"><?php echo $penjualan_edit->sales->caption() ?></label>
											<div>{{include tmpl=~getTemplate("#tpx_penjualan_sales")/}}</div>
										</div>
									</div>
									<div class="col-md-6">
										<div id="r_dok_be_wajah" class="form-group">
											<label id="elh_penjualan_dok_be_wajah" for="x_dok_be_wajah" class="control-label ewLabel">
											<?php echo $penjualan_edit->dokter->caption() ?></label>
											<div>{{include tmpl=~getTemplate("#tpx_penjualan_dokter")/}}</div>
										</div>
									</div> 
									<div class="col-md-6">
										<div id="r_dok_be_wajah" class="form-group">
											<label id="elh_penjualan_dok_be_wajah" for="x_dok_be_wajah" class="control-label ewLabel">
											<?php echo $penjualan_edit->dok_be_wajah->caption() ?></label>
											<div>{{include tmpl=~getTemplate("#tpx_penjualan_dok_be_wajah")/}}</div>
										</div>
									</div>			
									<div class="col-md-6">
										<div id="r_be_body" class="form-group">
											<label id="elh_penjualan_be_body" for="x_be_body" class="control-label ewLabel">
											<?php echo $penjualan_edit->be_body->caption() ?></label>
											<div>{{include tmpl=~getTemplate("#tpx_penjualan_be_body")/}}</div>
										</div>
									</div>
									<div class="col-md-6">
										<div id="r_medis" class="form-group">
											<label id="elh_penjualan_medis" for="x_medis" class="control-label ewLabel">
												<?php echo $penjualan_edit->medis->caption() ?></label>
												<div>{{include tmpl=~getTemplate("#tpx_penjualan_medis")/}}</div>
										</div>
									</div> 
								</div>        
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card shadow-sm">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
								<div id="r_id_kartu" class="form-group">
									<label id="elh_penjualan_id_kartu" for="x_id_kartu" class="control-label ewLabel">
									<?php echo $penjualan_edit->id_kartu->caption() ?></label>
									<div>{{include tmpl=~getTemplate("#tpx_penjualan_id_kartu")/}}</div>
								</div>
							</div>
							<div class="col-md-2 mt-3 text-center">
								<div id="r_jumlah_voucher" class="form-group">
									<label id="elh_penjualan_jumlah_voucher" for="x_jumlah_voucher" class="control-label ewLabel">
									</label>
									<div>X</div>
								</div>
							</div>
							<div class="col-md-4 mt-1">
								<div id="r_jumlah_voucher" class="form-group">
									<label id="elh_penjualan_jumlah_voucher" for="x_jumlah_voucher" class="control-label ewLabel">
									</label>
									<div>{{include tmpl=~getTemplate("#tpx_penjualan_jumlah_voucher")/}}</div>
								</div>
							</div>
						</div>
						<div id="r_klaim_poin" class="form-group">
							<label id="elh_penjualan_klaim_poin" for="x_klaim_poin" class="control-label ewLabel">
							<?php echo $penjualan_edit->klaim_poin->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_klaim_poin")/}}</div>
						</div>
						<div id="r_total_penukaran_poin" class="form-group">
							<label id="elh_penjualan_total_penukaran_poin" for="x_total_penukaran_poin" class="control-label ewLabel">
							<?php echo $penjualan_edit->total_penukaran_poin->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_total_penukaran_poin")/}}</div>
						</div>
						<div id="r_diskon_persen" class="form-group">
							<label id="elh_penjualan_diskon_persen" for="x_diskon_persen" class="control-label ewLabel">
							<?php echo $penjualan_edit->diskon_persen->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_diskon_persen")/}}</div>
						</div>
						<div id="r_diskon_rupiah" class="form-group">
							<label id="elh_penjualan_diskon_rupiah" for="x_diskon_rupiah" class="control-label ewLabel">
							<?php echo $penjualan_edit->diskon_rupiah->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_diskon_rupiah")/}}</div>
						</div>
						<div id="r_ppn" class="form-group">
							<label id="elh_penjualan_ppn" for="x_ppn" class="control-label ewLabel">
							<?php echo $penjualan_edit->ppn->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_ppn")/}}</div>
						</div>
						<div id="r_ongkir" class="form-group">
							<label id="elh_penjualan_ongkir" for="x_ongkir" class="control-label ewLabel">
							<?php echo $penjualan_edit->ongkir->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_ongkir")/}}</div>
						</div>
						<div id="r_charge" class="form-group">
							<label id="elh_penjualan_charge" for="x_charge" class="control-label ewLabel">
							<?php echo $penjualan_edit->charge->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_charge")/}}</div>
						</div>
						<div id="r_bayar" class="form-group">
							<label id="elh_penjualan_bayar" for="x_bayar" class="control-label ewLabel">
							<?php echo $penjualan_edit->bayar->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_bayar")/}}</div>
						</div>
						<div id="r_bayar_non_tunai" class="form-group">
							<label id="elh_penjualan_bayar_non_tunai" for="x_bayar_non_tunai" class="control-label ewLabel">
							<?php echo $penjualan_edit->bayar_non_tunai->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_bayar_non_tunai")/}}</div>
						</div>
						<div id="r_total_non_tunai_charge" class="form-group">
							<label id="elh_penjualan_total_non_tunai_charge" for="x_total_non_tunai_charge" class="control-label ewLabel">
							<?php echo $penjualan_edit->total_non_tunai_charge->caption() ?></label>
							<div>{{include tmpl=~getTemplate("#tpx_penjualan_total_non_tunai_charge")/}}</div>
						</div>
						<div id="r_total" class="form-group">
							<label id="elh_penjualan_total" for="x_total" class="control-label ewLabel">
							<?php echo $penjualan_edit->total->caption() ?></label>
						<div>{{include tmpl=~getTemplate("#tpx_penjualan_total")/}}</div>
						</div>
						<div id="r_kembalian" class="form-group">
							<label id="elh_kembalian" for="kembalian" class="control-label ewLabel">Kembalian</label>
							<div><input type="text" class="form-control" id="kembalian" placeholder="Kembalian" size="10" Readonly style="border:none; font-size: 3em; background-color:white;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- STATUS PENJUALAN -->
		<div class="card shadow-sm" id="status_penjualan">
			<div class="card-body">
				<div id="r_status" class="form-group">
					<label id="elh_penjualan_status" for="x_status" class="control-label ewLabel">
					<?php echo $penjualan_edit->status->caption() ?></label>
					<div>{{include tmpl=~getTemplate("#tpx_penjualan_status")/}}</div>
				</div>		
			</div>
		</div>
	</div>
</div>
</script>

<?php
	if (in_array("detailpenjualan", explode(",", $penjualan->getCurrentDetailTable())) && $detailpenjualan->DetailEdit) {
?>
<?php if ($penjualan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailpenjualan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailpenjualangrid.php" ?>
<?php } ?>
<?php if (!$penjualan_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $penjualan_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $penjualan_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script>
loadjs.ready(["jsrender", "makerjs"], function() {
	var $ = jQuery;
	ew.templateData = { rows: <?php echo JsonEncode($penjualan->Rows) ?> };
	ew.applyTemplate("tpd_penjualanedit", "tpm_penjualanedit", "penjualanedit", "<?php echo $penjualan->CustomExport ?>", ew.templateData.rows[0]);
	$("script.penjualanedit_js").each(function() {
		ew.addScript(this.text);
	});
});
</script>
<?php
$penjualan_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");
	//add button cetak nota

	$("#btn-action").after('&nbsp;<button class="btn btn-info ew-btn" name="btn-action-cetak" id="btn-action-cetak" type="submit" style="height: 50px !important; width: 20% !important;">Cetak Nota</button>');

	//if click button draft
	$('#btn-action').click(function() {
		$('input[name="x_status"][value="Draft"]').prop('checked', true);
		$('input[name="x_status"][value="Printed"]').prop('checked', null);
	});

	//if click button printed
	$('#btn-action-cetak').click(function() {
		$('input[name="x_status"][value="Printed"]').prop('checked', true);
		$('input[name="x_status"][value="Draft"]').prop('checked', null);
	});
	$(window).on('load', function(){
		$("#myModal").modal();
		console.log("Mulai1");
	});

	/*$(document).ajaxStart(function() {
		$("#myModal").modal({backdrop: 'static', keyboard: false});
		console.log("Mulai");
	});*/
	$(document).ajaxStop(function() {
		$('#myModal').modal('hide');
		console.log("Selesai");
	});
	$(document).ready(function(){
			$("#myModal").modal();
		}); 
	});	$('form').submit(function(){
});
</script>
<?php include_once "footer.php"; ?>
<?php
$penjualan_edit->terminate();
?>