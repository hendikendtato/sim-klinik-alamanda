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
$terimagudang_view = new terimagudang_view();

// Run the page
$terimagudang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terimagudang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terimagudang_view->isExport()) { ?>
<script>
var fterimagudangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fterimagudangview = currentForm = new ew.Form("fterimagudangview", "view");
	loadjs.done("fterimagudangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$terimagudang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $terimagudang_view->ExportOptions->render("body") ?>
<?php $terimagudang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $terimagudang_view->showPageHeader(); ?>
<?php
$terimagudang_view->showMessage();
?>
<form name="fterimagudangview" id="fterimagudangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terimagudang">
<input type="hidden" name="modal" value="<?php echo (int)$terimagudang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($terimagudang_view->id_terimagudang->Visible) { // id_terimagudang ?>
	<tr id="r_id_terimagudang">
		<td class="<?php echo $terimagudang_view->TableLeftColumnClass ?>"><span id="elh_terimagudang_id_terimagudang"><?php echo $terimagudang_view->id_terimagudang->caption() ?></span></td>
		<td data-name="id_terimagudang" <?php echo $terimagudang_view->id_terimagudang->cellAttributes() ?>>
<span id="el_terimagudang_id_terimagudang">
<span<?php echo $terimagudang_view->id_terimagudang->viewAttributes() ?>><?php echo $terimagudang_view->id_terimagudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimagudang_view->kode_terimagudang->Visible) { // kode_terimagudang ?>
	<tr id="r_kode_terimagudang">
		<td class="<?php echo $terimagudang_view->TableLeftColumnClass ?>"><span id="elh_terimagudang_kode_terimagudang"><?php echo $terimagudang_view->kode_terimagudang->caption() ?></span></td>
		<td data-name="kode_terimagudang" <?php echo $terimagudang_view->kode_terimagudang->cellAttributes() ?>>
<span id="el_terimagudang_kode_terimagudang">
<span<?php echo $terimagudang_view->kode_terimagudang->viewAttributes() ?>><?php echo $terimagudang_view->kode_terimagudang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimagudang_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $terimagudang_view->TableLeftColumnClass ?>"><span id="elh_terimagudang_id_klinik"><?php echo $terimagudang_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $terimagudang_view->id_klinik->cellAttributes() ?>>
<span id="el_terimagudang_id_klinik">
<span<?php echo $terimagudang_view->id_klinik->viewAttributes() ?>><?php echo $terimagudang_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimagudang_view->diterima->Visible) { // diterima ?>
	<tr id="r_diterima">
		<td class="<?php echo $terimagudang_view->TableLeftColumnClass ?>"><span id="elh_terimagudang_diterima"><?php echo $terimagudang_view->diterima->caption() ?></span></td>
		<td data-name="diterima" <?php echo $terimagudang_view->diterima->cellAttributes() ?>>
<span id="el_terimagudang_diterima">
<span<?php echo $terimagudang_view->diterima->viewAttributes() ?>><?php echo $terimagudang_view->diterima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimagudang_view->tanggal_terima->Visible) { // tanggal_terima ?>
	<tr id="r_tanggal_terima">
		<td class="<?php echo $terimagudang_view->TableLeftColumnClass ?>"><span id="elh_terimagudang_tanggal_terima"><?php echo $terimagudang_view->tanggal_terima->caption() ?></span></td>
		<td data-name="tanggal_terima" <?php echo $terimagudang_view->tanggal_terima->cellAttributes() ?>>
<span id="el_terimagudang_tanggal_terima">
<span<?php echo $terimagudang_view->tanggal_terima->viewAttributes() ?>><?php echo $terimagudang_view->tanggal_terima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($terimagudang_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $terimagudang_view->TableLeftColumnClass ?>"><span id="elh_terimagudang_keterangan"><?php echo $terimagudang_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $terimagudang_view->keterangan->cellAttributes() ?>>
<span id="el_terimagudang_keterangan">
<span<?php echo $terimagudang_view->keterangan->viewAttributes() ?>><?php echo $terimagudang_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailterimagudang", explode(",", $terimagudang->getCurrentDetailTable())) && $detailterimagudang->DetailView) {
?>
<?php if ($terimagudang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailterimagudang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailterimagudanggrid.php" ?>
<?php } ?>
</form>
<?php
$terimagudang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terimagudang_view->isExport()) { ?>
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
$terimagudang_view->terminate();
?>