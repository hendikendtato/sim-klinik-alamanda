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
$m_jadwalpegawai_view = new m_jadwalpegawai_view();

// Run the page
$m_jadwalpegawai_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_jadwalpegawai_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_jadwalpegawai_view->isExport()) { ?>
<script>
var fm_jadwalpegawaiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_jadwalpegawaiview = currentForm = new ew.Form("fm_jadwalpegawaiview", "view");
	loadjs.done("fm_jadwalpegawaiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_jadwalpegawai_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_jadwalpegawai_view->ExportOptions->render("body") ?>
<?php $m_jadwalpegawai_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_jadwalpegawai_view->showPageHeader(); ?>
<?php
$m_jadwalpegawai_view->showMessage();
?>
<form name="fm_jadwalpegawaiview" id="fm_jadwalpegawaiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_jadwalpegawai">
<input type="hidden" name="modal" value="<?php echo (int)$m_jadwalpegawai_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_jadwalpegawai_view->id_jadwalpeg->Visible) { // id_jadwalpeg ?>
	<tr id="r_id_jadwalpeg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_id_jadwalpeg"><?php echo $m_jadwalpegawai_view->id_jadwalpeg->caption() ?></span></td>
		<td data-name="id_jadwalpeg" <?php echo $m_jadwalpegawai_view->id_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_id_jadwalpeg">
<span<?php echo $m_jadwalpegawai_view->id_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->id_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jadwalpegawai_view->tindakan_jadwalpeg->Visible) { // tindakan_jadwalpeg ?>
	<tr id="r_tindakan_jadwalpeg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_tindakan_jadwalpeg"><?php echo $m_jadwalpegawai_view->tindakan_jadwalpeg->caption() ?></span></td>
		<td data-name="tindakan_jadwalpeg" <?php echo $m_jadwalpegawai_view->tindakan_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_tindakan_jadwalpeg">
<span<?php echo $m_jadwalpegawai_view->tindakan_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->tindakan_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jadwalpegawai_view->idpeg->Visible) { // idpeg ?>
	<tr id="r_idpeg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_idpeg"><?php echo $m_jadwalpegawai_view->idpeg->caption() ?></span></td>
		<td data-name="idpeg" <?php echo $m_jadwalpegawai_view->idpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_idpeg">
<span<?php echo $m_jadwalpegawai_view->idpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->idpeg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jadwalpegawai_view->tanggal_jadwalpeg->Visible) { // tanggal_jadwalpeg ?>
	<tr id="r_tanggal_jadwalpeg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_tanggal_jadwalpeg"><?php echo $m_jadwalpegawai_view->tanggal_jadwalpeg->caption() ?></span></td>
		<td data-name="tanggal_jadwalpeg" <?php echo $m_jadwalpegawai_view->tanggal_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_tanggal_jadwalpeg">
<span<?php echo $m_jadwalpegawai_view->tanggal_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->tanggal_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jadwalpegawai_view->jam_jadwalpeg->Visible) { // jam_jadwalpeg ?>
	<tr id="r_jam_jadwalpeg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_jam_jadwalpeg"><?php echo $m_jadwalpegawai_view->jam_jadwalpeg->caption() ?></span></td>
		<td data-name="jam_jadwalpeg" <?php echo $m_jadwalpegawai_view->jam_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_jam_jadwalpeg">
<span<?php echo $m_jadwalpegawai_view->jam_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->jam_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jadwalpegawai_view->keterangan_peg->Visible) { // keterangan_peg ?>
	<tr id="r_keterangan_peg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_keterangan_peg"><?php echo $m_jadwalpegawai_view->keterangan_peg->caption() ?></span></td>
		<td data-name="keterangan_peg" <?php echo $m_jadwalpegawai_view->keterangan_peg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_keterangan_peg">
<span<?php echo $m_jadwalpegawai_view->keterangan_peg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->keterangan_peg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_jadwalpegawai_view->status_jadwalpeg->Visible) { // status_jadwalpeg ?>
	<tr id="r_status_jadwalpeg">
		<td class="<?php echo $m_jadwalpegawai_view->TableLeftColumnClass ?>"><span id="elh_m_jadwalpegawai_status_jadwalpeg"><?php echo $m_jadwalpegawai_view->status_jadwalpeg->caption() ?></span></td>
		<td data-name="status_jadwalpeg" <?php echo $m_jadwalpegawai_view->status_jadwalpeg->cellAttributes() ?>>
<span id="el_m_jadwalpegawai_status_jadwalpeg">
<span<?php echo $m_jadwalpegawai_view->status_jadwalpeg->viewAttributes() ?>><?php echo $m_jadwalpegawai_view->status_jadwalpeg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_jadwalpegawai_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_jadwalpegawai_view->isExport()) { ?>
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
$m_jadwalpegawai_view->terminate();
?>