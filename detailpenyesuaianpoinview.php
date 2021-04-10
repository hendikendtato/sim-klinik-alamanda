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
$detailpenyesuaianpoin_view = new detailpenyesuaianpoin_view();

// Run the page
$detailpenyesuaianpoin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianpoin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailpenyesuaianpoin_view->isExport()) { ?>
<script>
var fdetailpenyesuaianpoinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdetailpenyesuaianpoinview = currentForm = new ew.Form("fdetailpenyesuaianpoinview", "view");
	loadjs.done("fdetailpenyesuaianpoinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailpenyesuaianpoin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $detailpenyesuaianpoin_view->ExportOptions->render("body") ?>
<?php $detailpenyesuaianpoin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $detailpenyesuaianpoin_view->showPageHeader(); ?>
<?php
$detailpenyesuaianpoin_view->showMessage();
?>
<form name="fdetailpenyesuaianpoinview" id="fdetailpenyesuaianpoinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailpenyesuaianpoin">
<input type="hidden" name="modal" value="<?php echo (int)$detailpenyesuaianpoin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($detailpenyesuaianpoin_view->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
	<tr id="r_pid_penyesuaianpoin">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_pid_penyesuaianpoin"><?php echo $detailpenyesuaianpoin_view->pid_penyesuaianpoin->caption() ?></span></td>
		<td data-name="pid_penyesuaianpoin" <?php echo $detailpenyesuaianpoin_view->pid_penyesuaianpoin->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_pid_penyesuaianpoin">
<span<?php echo $detailpenyesuaianpoin_view->pid_penyesuaianpoin->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->pid_penyesuaianpoin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianpoin_view->id_member->Visible) { // id_member ?>
	<tr id="r_id_member">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_id_member"><?php echo $detailpenyesuaianpoin_view->id_member->caption() ?></span></td>
		<td data-name="id_member" <?php echo $detailpenyesuaianpoin_view->id_member->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_id_member">
<span<?php echo $detailpenyesuaianpoin_view->id_member->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->id_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianpoin_view->poin_database->Visible) { // poin_database ?>
	<tr id="r_poin_database">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_poin_database"><?php echo $detailpenyesuaianpoin_view->poin_database->caption() ?></span></td>
		<td data-name="poin_database" <?php echo $detailpenyesuaianpoin_view->poin_database->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_poin_database">
<span<?php echo $detailpenyesuaianpoin_view->poin_database->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->poin_database->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianpoin_view->poin_lapangan->Visible) { // poin_lapangan ?>
	<tr id="r_poin_lapangan">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_poin_lapangan"><?php echo $detailpenyesuaianpoin_view->poin_lapangan->caption() ?></span></td>
		<td data-name="poin_lapangan" <?php echo $detailpenyesuaianpoin_view->poin_lapangan->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_poin_lapangan">
<span<?php echo $detailpenyesuaianpoin_view->poin_lapangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->poin_lapangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianpoin_view->selisih->Visible) { // selisih ?>
	<tr id="r_selisih">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_selisih"><?php echo $detailpenyesuaianpoin_view->selisih->caption() ?></span></td>
		<td data-name="selisih" <?php echo $detailpenyesuaianpoin_view->selisih->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_selisih">
<span<?php echo $detailpenyesuaianpoin_view->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->selisih->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianpoin_view->tipe->Visible) { // tipe ?>
	<tr id="r_tipe">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_tipe"><?php echo $detailpenyesuaianpoin_view->tipe->caption() ?></span></td>
		<td data-name="tipe" <?php echo $detailpenyesuaianpoin_view->tipe->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_tipe">
<span<?php echo $detailpenyesuaianpoin_view->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->tipe->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($detailpenyesuaianpoin_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $detailpenyesuaianpoin_view->TableLeftColumnClass ?>"><span id="elh_detailpenyesuaianpoin_keterangan"><?php echo $detailpenyesuaianpoin_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $detailpenyesuaianpoin_view->keterangan->cellAttributes() ?>>
<span id="el_detailpenyesuaianpoin_keterangan">
<span<?php echo $detailpenyesuaianpoin_view->keterangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$detailpenyesuaianpoin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailpenyesuaianpoin_view->isExport()) { ?>
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
$detailpenyesuaianpoin_view->terminate();
?>