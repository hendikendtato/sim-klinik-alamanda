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
$perpindahanbarang_view = new perpindahanbarang_view();

// Run the page
$perpindahanbarang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$perpindahanbarang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$perpindahanbarang_view->isExport()) { ?>
<script>
var fperpindahanbarangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fperpindahanbarangview = currentForm = new ew.Form("fperpindahanbarangview", "view");
	loadjs.done("fperpindahanbarangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$perpindahanbarang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $perpindahanbarang_view->ExportOptions->render("body") ?>
<?php $perpindahanbarang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $perpindahanbarang_view->showPageHeader(); ?>
<?php
$perpindahanbarang_view->showMessage();
?>
<form name="fperpindahanbarangview" id="fperpindahanbarangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="perpindahanbarang">
<input type="hidden" name="modal" value="<?php echo (int)$perpindahanbarang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($perpindahanbarang_view->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<tr id="r_id_perpindahanbarang">
		<td class="<?php echo $perpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_perpindahanbarang_id_perpindahanbarang"><?php echo $perpindahanbarang_view->id_perpindahanbarang->caption() ?></span></td>
		<td data-name="id_perpindahanbarang" <?php echo $perpindahanbarang_view->id_perpindahanbarang->cellAttributes() ?>>
<span id="el_perpindahanbarang_id_perpindahanbarang">
<span<?php echo $perpindahanbarang_view->id_perpindahanbarang->viewAttributes() ?>><?php echo $perpindahanbarang_view->id_perpindahanbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perpindahanbarang_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $perpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_perpindahanbarang_tanggal"><?php echo $perpindahanbarang_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $perpindahanbarang_view->tanggal->cellAttributes() ?>>
<span id="el_perpindahanbarang_tanggal">
<span<?php echo $perpindahanbarang_view->tanggal->viewAttributes() ?>><?php echo $perpindahanbarang_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perpindahanbarang_view->asal->Visible) { // asal ?>
	<tr id="r_asal">
		<td class="<?php echo $perpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_perpindahanbarang_asal"><?php echo $perpindahanbarang_view->asal->caption() ?></span></td>
		<td data-name="asal" <?php echo $perpindahanbarang_view->asal->cellAttributes() ?>>
<span id="el_perpindahanbarang_asal">
<span<?php echo $perpindahanbarang_view->asal->viewAttributes() ?>><?php echo $perpindahanbarang_view->asal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perpindahanbarang_view->tujuan->Visible) { // tujuan ?>
	<tr id="r_tujuan">
		<td class="<?php echo $perpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_perpindahanbarang_tujuan"><?php echo $perpindahanbarang_view->tujuan->caption() ?></span></td>
		<td data-name="tujuan" <?php echo $perpindahanbarang_view->tujuan->cellAttributes() ?>>
<span id="el_perpindahanbarang_tujuan">
<span<?php echo $perpindahanbarang_view->tujuan->viewAttributes() ?>><?php echo $perpindahanbarang_view->tujuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($perpindahanbarang_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $perpindahanbarang_view->TableLeftColumnClass ?>"><span id="elh_perpindahanbarang_keterangan"><?php echo $perpindahanbarang_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $perpindahanbarang_view->keterangan->cellAttributes() ?>>
<span id="el_perpindahanbarang_keterangan">
<span<?php echo $perpindahanbarang_view->keterangan->viewAttributes() ?>><?php echo $perpindahanbarang_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("detailperpindahanbarang", explode(",", $perpindahanbarang->getCurrentDetailTable())) && $detailperpindahanbarang->DetailView) {
?>
<?php if ($perpindahanbarang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("detailperpindahanbarang", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "detailperpindahanbaranggrid.php" ?>
<?php } ?>
</form>
<?php
$perpindahanbarang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$perpindahanbarang_view->isExport()) { ?>
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
$perpindahanbarang_view->terminate();
?>