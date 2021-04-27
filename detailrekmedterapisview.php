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
$detailrekmedterapis_view = new detailrekmedterapis_view();

// Run the page
$detailrekmedterapis_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailrekmedterapis_view->isExport()) { ?>
<script>
var fdetailrekmedterapisview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailrekmedterapisview = currentForm = new ew.Form("fdetailrekmedterapisview", "view");
	loadjs.done("fdetailrekmedterapisview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailrekmedterapis_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailrekmedterapis_view->ExportOptions->render("body") ?>
<?php $detailrekmedterapis_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailrekmedterapis_view->showPageHeader(); ?>
<?php
$detailrekmedterapis_view->showMessage();
?>
<form name="fdetailrekmedterapisview" id="fdetailrekmedterapisview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailrekmedterapis">
<input type="hidden" name="modal" value="<?php echo (int)$detailrekmedterapis_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailrekmedterapis_view->id_detailrekmedterapis->Visible) { // id_detailrekmedterapis ?>
	<tr id="r_id_detailrekmedterapis">
		<td class="<?php echo $detailrekmedterapis_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_detailrekmedterapis"><?php echo $detailrekmedterapis_view->id_detailrekmedterapis->caption() ?></span></td>
		<td data-name="id_detailrekmedterapis" <?php echo $detailrekmedterapis_view->id_detailrekmedterapis->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_detailrekmedterapis">
<span<?php echo $detailrekmedterapis_view->id_detailrekmedterapis->viewAttributes() ?>><?php echo $detailrekmedterapis_view->id_detailrekmedterapis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedterapis_view->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<tr id="r_id_rekmeddok">
		<td class="<?php echo $detailrekmedterapis_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_rekmeddok"><?php echo $detailrekmedterapis_view->id_rekmeddok->caption() ?></span></td>
		<td data-name="id_rekmeddok" <?php echo $detailrekmedterapis_view->id_rekmeddok->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_rekmeddok">
<span<?php echo $detailrekmedterapis_view->id_rekmeddok->viewAttributes() ?>><?php echo $detailrekmedterapis_view->id_rekmeddok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedterapis_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $detailrekmedterapis_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_barang"><?php echo $detailrekmedterapis_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $detailrekmedterapis_view->id_barang->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_barang">
<span<?php echo $detailrekmedterapis_view->id_barang->viewAttributes() ?>><?php echo $detailrekmedterapis_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedterapis_view->jumlah->Visible) { // jumlah ?>
	<tr id="r_jumlah">
		<td class="<?php echo $detailrekmedterapis_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedterapis_jumlah"><?php echo $detailrekmedterapis_view->jumlah->caption() ?></span></td>
		<td data-name="jumlah" <?php echo $detailrekmedterapis_view->jumlah->cellAttributes() ?>>
<span id="el_detailrekmedterapis_jumlah">
<span<?php echo $detailrekmedterapis_view->jumlah->viewAttributes() ?>><?php echo $detailrekmedterapis_view->jumlah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailrekmedterapis_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailrekmedterapis_view->TableLeftColumnClass ?>"><span id="elh_detailrekmedterapis_id_satuan"><?php echo $detailrekmedterapis_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailrekmedterapis_view->id_satuan->cellAttributes() ?>>
<span id="el_detailrekmedterapis_id_satuan">
<span<?php echo $detailrekmedterapis_view->id_satuan->viewAttributes() ?>><?php echo $detailrekmedterapis_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailrekmedterapis_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailrekmedterapis_view->isExport()) { ?>
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
$detailrekmedterapis_view->terminate();
?>