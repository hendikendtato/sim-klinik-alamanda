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
$m_poin_view = new m_poin_view();

// Run the page
$m_poin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_poin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_poin_view->isExport()) { ?>
<script>
var fm_poinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_poinview = currentForm = new ew.Form("fm_poinview", "view");
	loadjs.done("fm_poinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_poin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_poin_view->ExportOptions->render("body") ?>
<?php $m_poin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_poin_view->showPageHeader(); ?>
<?php
$m_poin_view->showMessage();
?>
<form name="fm_poinview" id="fm_poinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_poin">
<input type="hidden" name="modal" value="<?php echo (int)$m_poin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_poin_view->id_jenis_member->Visible) { // id_jenis_member ?>
	<tr id="r_id_jenis_member">
		<td class="<?php echo $m_poin_view->TableLeftColumnClass ?>"><span id="elh_m_poin_id_jenis_member"><?php echo $m_poin_view->id_jenis_member->caption() ?></span></td>
		<td data-name="id_jenis_member" <?php echo $m_poin_view->id_jenis_member->cellAttributes() ?>>
<span id="el_m_poin_id_jenis_member">
<span<?php echo $m_poin_view->id_jenis_member->viewAttributes() ?>><?php echo $m_poin_view->id_jenis_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_poin_view->curs_poin->Visible) { // curs_poin ?>
	<tr id="r_curs_poin">
		<td class="<?php echo $m_poin_view->TableLeftColumnClass ?>"><span id="elh_m_poin_curs_poin"><?php echo $m_poin_view->curs_poin->caption() ?></span></td>
		<td data-name="curs_poin" <?php echo $m_poin_view->curs_poin->cellAttributes() ?>>
<span id="el_m_poin_curs_poin">
<span<?php echo $m_poin_view->curs_poin->viewAttributes() ?>><?php echo $m_poin_view->curs_poin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_poin_view->curs_to_rp->Visible) { // curs_to_rp ?>
	<tr id="r_curs_to_rp">
		<td class="<?php echo $m_poin_view->TableLeftColumnClass ?>"><span id="elh_m_poin_curs_to_rp"><?php echo $m_poin_view->curs_to_rp->caption() ?></span></td>
		<td data-name="curs_to_rp" <?php echo $m_poin_view->curs_to_rp->cellAttributes() ?>>
<span id="el_m_poin_curs_to_rp">
<span<?php echo $m_poin_view->curs_to_rp->viewAttributes() ?>><?php echo $m_poin_view->curs_to_rp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_poin_view->max_klaim->Visible) { // max_klaim ?>
	<tr id="r_max_klaim">
		<td class="<?php echo $m_poin_view->TableLeftColumnClass ?>"><span id="elh_m_poin_max_klaim"><?php echo $m_poin_view->max_klaim->caption() ?></span></td>
		<td data-name="max_klaim" <?php echo $m_poin_view->max_klaim->cellAttributes() ?>>
<span id="el_m_poin_max_klaim">
<span<?php echo $m_poin_view->max_klaim->viewAttributes() ?>><?php echo $m_poin_view->max_klaim->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_poin_view->min_transaksi->Visible) { // min_transaksi ?>
	<tr id="r_min_transaksi">
		<td class="<?php echo $m_poin_view->TableLeftColumnClass ?>"><span id="elh_m_poin_min_transaksi"><?php echo $m_poin_view->min_transaksi->caption() ?></span></td>
		<td data-name="min_transaksi" <?php echo $m_poin_view->min_transaksi->cellAttributes() ?>>
<span id="el_m_poin_min_transaksi">
<span<?php echo $m_poin_view->min_transaksi->viewAttributes() ?>><?php echo $m_poin_view->min_transaksi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_poin_view->waktu_exp->Visible) { // waktu_exp ?>
	<tr id="r_waktu_exp">
		<td class="<?php echo $m_poin_view->TableLeftColumnClass ?>"><span id="elh_m_poin_waktu_exp"><?php echo $m_poin_view->waktu_exp->caption() ?></span></td>
		<td data-name="waktu_exp" <?php echo $m_poin_view->waktu_exp->cellAttributes() ?>>
<span id="el_m_poin_waktu_exp">
<span<?php echo $m_poin_view->waktu_exp->viewAttributes() ?>><?php echo $m_poin_view->waktu_exp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_poin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_poin_view->isExport()) { ?>
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
$m_poin_view->terminate();
?>