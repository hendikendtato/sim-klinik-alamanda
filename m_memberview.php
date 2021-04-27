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
$m_member_view = new m_member_view();

// Run the page
$m_member_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_member_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_member_view->isExport()) { ?>
<script>
var fm_memberview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_memberview = currentForm = new ew.Form("fm_memberview", "view");
	loadjs.done("fm_memberview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_member_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_member_view->ExportOptions->render("body") ?>
<?php $m_member_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_member_view->showPageHeader(); ?>
<?php
$m_member_view->showMessage();
?>
<form name="fm_memberview" id="fm_memberview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_member">
<input type="hidden" name="modal" value="<?php echo (int)$m_member_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_member_view->kode_member->Visible) { // kode_member ?>
	<tr id="r_kode_member">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_kode_member"><?php echo $m_member_view->kode_member->caption() ?></span></td>
		<td data-name="kode_member" <?php echo $m_member_view->kode_member->cellAttributes() ?>>
<span id="el_m_member_kode_member">
<span<?php echo $m_member_view->kode_member->viewAttributes() ?>><?php echo $m_member_view->kode_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_id_klinik"><?php echo $m_member_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $m_member_view->id_klinik->cellAttributes() ?>>
<span id="el_m_member_id_klinik">
<span<?php echo $m_member_view->id_klinik->viewAttributes() ?>><?php echo $m_member_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->id_pelanggan->Visible) { // id_pelanggan ?>
	<tr id="r_id_pelanggan">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_id_pelanggan"><?php echo $m_member_view->id_pelanggan->caption() ?></span></td>
		<td data-name="id_pelanggan" <?php echo $m_member_view->id_pelanggan->cellAttributes() ?>>
<span id="el_m_member_id_pelanggan">
<span<?php echo $m_member_view->id_pelanggan->viewAttributes() ?>><?php echo $m_member_view->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->jenis_member->Visible) { // jenis_member ?>
	<tr id="r_jenis_member">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_jenis_member"><?php echo $m_member_view->jenis_member->caption() ?></span></td>
		<td data-name="jenis_member" <?php echo $m_member_view->jenis_member->cellAttributes() ?>>
<span id="el_m_member_jenis_member">
<span<?php echo $m_member_view->jenis_member->viewAttributes() ?>><?php echo $m_member_view->jenis_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->tgl_mulai->Visible) { // tgl_mulai ?>
	<tr id="r_tgl_mulai">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_tgl_mulai"><?php echo $m_member_view->tgl_mulai->caption() ?></span></td>
		<td data-name="tgl_mulai" <?php echo $m_member_view->tgl_mulai->cellAttributes() ?>>
<span id="el_m_member_tgl_mulai">
<span<?php echo $m_member_view->tgl_mulai->viewAttributes() ?>><?php echo $m_member_view->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->tgl_akhir->Visible) { // tgl_akhir ?>
	<tr id="r_tgl_akhir">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_tgl_akhir"><?php echo $m_member_view->tgl_akhir->caption() ?></span></td>
		<td data-name="tgl_akhir" <?php echo $m_member_view->tgl_akhir->cellAttributes() ?>>
<span id="el_m_member_tgl_akhir">
<span<?php echo $m_member_view->tgl_akhir->viewAttributes() ?>><?php echo $m_member_view->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->poin_member->Visible) { // poin_member ?>
	<tr id="r_poin_member">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_poin_member"><?php echo $m_member_view->poin_member->caption() ?></span></td>
		<td data-name="poin_member" <?php echo $m_member_view->poin_member->cellAttributes() ?>>
<span id="el_m_member_poin_member">
<span<?php echo $m_member_view->poin_member->viewAttributes() ?>><?php echo $m_member_view->poin_member->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->tgl_awal_transaksi->Visible) { // tgl_awal_transaksi ?>
	<tr id="r_tgl_awal_transaksi">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_tgl_awal_transaksi"><?php echo $m_member_view->tgl_awal_transaksi->caption() ?></span></td>
		<td data-name="tgl_awal_transaksi" <?php echo $m_member_view->tgl_awal_transaksi->cellAttributes() ?>>
<span id="el_m_member_tgl_awal_transaksi">
<span<?php echo $m_member_view->tgl_awal_transaksi->viewAttributes() ?>><?php echo $m_member_view->tgl_awal_transaksi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_member_view->total_akumulasi->Visible) { // total_akumulasi ?>
	<tr id="r_total_akumulasi">
		<td class="<?php echo $m_member_view->TableLeftColumnClass ?>"><span id="elh_m_member_total_akumulasi"><?php echo $m_member_view->total_akumulasi->caption() ?></span></td>
		<td data-name="total_akumulasi" <?php echo $m_member_view->total_akumulasi->cellAttributes() ?>>
<span id="el_m_member_total_akumulasi">
<span<?php echo $m_member_view->total_akumulasi->viewAttributes() ?>><?php echo $m_member_view->total_akumulasi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_member_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_member_view->isExport()) { ?>
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
$m_member_view->terminate();
?>