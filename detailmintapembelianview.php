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
$detailmintapembelian_view = new detailmintapembelian_view();

// Run the page
$detailmintapembelian_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmintapembelian_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailmintapembelian_view->isExport()) { ?>
<script>
var fdetailmintapembelianview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailmintapembelianview = currentForm = new ew.Form("fdetailmintapembelianview", "view");
	loadjs.done("fdetailmintapembelianview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailmintapembelian_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailmintapembelian_view->ExportOptions->render("body") ?>
<?php $detailmintapembelian_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailmintapembelian_view->showPageHeader(); ?>
<?php
$detailmintapembelian_view->showMessage();
?>
<form name="fdetailmintapembelianview" id="fdetailmintapembelianview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailmintapembelian">
<input type="hidden" name="modal" value="<?php echo (int)$detailmintapembelian_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailmintapembelian_view->id_detailpp->Visible) { // id_detailpp ?>
	<tr id="r_id_detailpp">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_id_detailpp"><?php echo $detailmintapembelian_view->id_detailpp->caption() ?></span></td>
		<td data-name="id_detailpp" <?php echo $detailmintapembelian_view->id_detailpp->cellAttributes() ?>>
<span id="el_detailmintapembelian_id_detailpp">
<span<?php echo $detailmintapembelian_view->id_detailpp->viewAttributes() ?>><?php echo $detailmintapembelian_view->id_detailpp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->pid_pp->Visible) { // pid_pp ?>
	<tr id="r_pid_pp">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_pid_pp"><?php echo $detailmintapembelian_view->pid_pp->caption() ?></span></td>
		<td data-name="pid_pp" <?php echo $detailmintapembelian_view->pid_pp->cellAttributes() ?>>
<span id="el_detailmintapembelian_pid_pp">
<span<?php echo $detailmintapembelian_view->pid_pp->viewAttributes() ?>><?php echo $detailmintapembelian_view->pid_pp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->idbarang->Visible) { // idbarang ?>
	<tr id="r_idbarang">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_idbarang"><?php echo $detailmintapembelian_view->idbarang->caption() ?></span></td>
		<td data-name="idbarang" <?php echo $detailmintapembelian_view->idbarang->cellAttributes() ?>>
<span id="el_detailmintapembelian_idbarang">
<span<?php echo $detailmintapembelian_view->idbarang->viewAttributes() ?>><?php echo $detailmintapembelian_view->idbarang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->part->Visible) { // part ?>
	<tr id="r_part">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_part"><?php echo $detailmintapembelian_view->part->caption() ?></span></td>
		<td data-name="part" <?php echo $detailmintapembelian_view->part->cellAttributes() ?>>
<span id="el_detailmintapembelian_part">
<span<?php echo $detailmintapembelian_view->part->viewAttributes() ?>><?php echo $detailmintapembelian_view->part->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->lot->Visible) { // lot ?>
	<tr id="r_lot">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_lot"><?php echo $detailmintapembelian_view->lot->caption() ?></span></td>
		<td data-name="lot" <?php echo $detailmintapembelian_view->lot->cellAttributes() ?>>
<span id="el_detailmintapembelian_lot">
<span<?php echo $detailmintapembelian_view->lot->viewAttributes() ?>><?php echo $detailmintapembelian_view->lot->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->qty_pp->Visible) { // qty_pp ?>
	<tr id="r_qty_pp">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_qty_pp"><?php echo $detailmintapembelian_view->qty_pp->caption() ?></span></td>
		<td data-name="qty_pp" <?php echo $detailmintapembelian_view->qty_pp->cellAttributes() ?>>
<span id="el_detailmintapembelian_qty_pp">
<span<?php echo $detailmintapembelian_view->qty_pp->viewAttributes() ?>><?php echo $detailmintapembelian_view->qty_pp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->qty_acc->Visible) { // qty_acc ?>
	<tr id="r_qty_acc">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_qty_acc"><?php echo $detailmintapembelian_view->qty_acc->caption() ?></span></td>
		<td data-name="qty_acc" <?php echo $detailmintapembelian_view->qty_acc->cellAttributes() ?>>
<span id="el_detailmintapembelian_qty_acc">
<span<?php echo $detailmintapembelian_view->qty_acc->viewAttributes() ?>><?php echo $detailmintapembelian_view->qty_acc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->id_satuan->Visible) { // id_satuan ?>
	<tr id="r_id_satuan">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_id_satuan"><?php echo $detailmintapembelian_view->id_satuan->caption() ?></span></td>
		<td data-name="id_satuan" <?php echo $detailmintapembelian_view->id_satuan->cellAttributes() ?>>
<span id="el_detailmintapembelian_id_satuan">
<span<?php echo $detailmintapembelian_view->id_satuan->viewAttributes() ?>><?php echo $detailmintapembelian_view->id_satuan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->harga->Visible) { // harga ?>
	<tr id="r_harga">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_harga"><?php echo $detailmintapembelian_view->harga->caption() ?></span></td>
		<td data-name="harga" <?php echo $detailmintapembelian_view->harga->cellAttributes() ?>>
<span id="el_detailmintapembelian_harga">
<span<?php echo $detailmintapembelian_view->harga->viewAttributes() ?>><?php echo $detailmintapembelian_view->harga->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailmintapembelian_view->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $detailmintapembelian_view->TableLeftColumnClass ?>"><span id="elh_detailmintapembelian_total"><?php echo $detailmintapembelian_view->total->caption() ?></span></td>
		<td data-name="total" <?php echo $detailmintapembelian_view->total->cellAttributes() ?>>
<span id="el_detailmintapembelian_total">
<span<?php echo $detailmintapembelian_view->total->viewAttributes() ?>><?php echo $detailmintapembelian_view->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailmintapembelian_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailmintapembelian_view->isExport()) { ?>
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
$detailmintapembelian_view->terminate();
?>