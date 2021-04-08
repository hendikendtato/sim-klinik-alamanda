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
$detailmutasibank_view = new detailmutasibank_view();

// Run the page
$detailmutasibank_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmutasibank_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailmutasibank_view->isExport()) { ?>
<script>
var fdetailmutasibankview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailmutasibankview = currentForm = new ew.Form("fdetailmutasibankview", "view");
	loadjs.done("fdetailmutasibankview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailmutasibank_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailmutasibank_view->ExportOptions->render("body") ?>
<?php $detailmutasibank_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailmutasibank_view->showPageHeader(); ?>
<?php
$detailmutasibank_view->showMessage();
?>
<form name="fdetailmutasibankview" id="fdetailmutasibankview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmutasibank">
<input type="hidden" name="modal" value="<?php echo (int)$detailmutasibank_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailmutasibank_view->akun_id->Visible) { // akun_id ?>
	<tr id="r_akun_id">
		<td class="<?php echo $detailmutasibank_view->TableLeftColumnClass ?>"><span id="elh_detailmutasibank_akun_id"><?php echo $detailmutasibank_view->akun_id->caption() ?></span></td>
		<td data-name="akun_id" <?php echo $detailmutasibank_view->akun_id->cellAttributes() ?>>
<span id="el_detailmutasibank_akun_id">
<span<?php echo $detailmutasibank_view->akun_id->viewAttributes() ?>><?php echo $detailmutasibank_view->akun_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmutasibank_view->nama_akun->Visible) { // nama_akun ?>
	<tr id="r_nama_akun">
		<td class="<?php echo $detailmutasibank_view->TableLeftColumnClass ?>"><span id="elh_detailmutasibank_nama_akun"><?php echo $detailmutasibank_view->nama_akun->caption() ?></span></td>
		<td data-name="nama_akun" <?php echo $detailmutasibank_view->nama_akun->cellAttributes() ?>>
<span id="el_detailmutasibank_nama_akun">
<span<?php echo $detailmutasibank_view->nama_akun->viewAttributes() ?>><?php echo $detailmutasibank_view->nama_akun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmutasibank_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailmutasibank_view->TableLeftColumnClass ?>"><span id="elh_detailmutasibank_jumlah"><?php echo $detailmutasibank_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailmutasibank_view->jumlah->cellAttributes() ?>>
<span id="el_detailmutasibank_jumlah">
<span<?php echo $detailmutasibank_view->jumlah->viewAttributes() ?>><?php echo $detailmutasibank_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmutasibank_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $detailmutasibank_view->TableLeftColumnClass ?>"><span id="elh_detailmutasibank_keterangan"><?php echo $detailmutasibank_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $detailmutasibank_view->keterangan->cellAttributes() ?>>
<span id="el_detailmutasibank_keterangan">
<span<?php echo $detailmutasibank_view->keterangan->viewAttributes() ?>><?php echo $detailmutasibank_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailmutasibank_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailmutasibank_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$detailmutasibank_view->terminate();
?>