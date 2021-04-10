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
$m_komisi_kinerja_detail_view = new m_komisi_kinerja_detail_view();

// Run the page
$m_komisi_kinerja_detail_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_kinerja_detail_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_komisi_kinerja_detail_view->isExport()) { ?>
<script>
var fm_komisi_kinerja_detailview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_komisi_kinerja_detailview = currentForm = new ew.Form("fm_komisi_kinerja_detailview", "view");
	loadjs.done("fm_komisi_kinerja_detailview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_komisi_kinerja_detail_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_komisi_kinerja_detail_view->ExportOptions->render("body") ?>
<?php $m_komisi_kinerja_detail_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_komisi_kinerja_detail_view->showPageHeader(); ?>
<?php
$m_komisi_kinerja_detail_view->showMessage();
?>
<form name="fm_komisi_kinerja_detailview" id="fm_komisi_kinerja_detailview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi_kinerja_detail">
<input type="hidden" name="modal" value="<?php echo (int)$m_komisi_kinerja_detail_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_komisi_kinerja_detail_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_id"><?php echo $m_komisi_kinerja_detail_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_komisi_kinerja_detail_view->id->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_id">
<span<?php echo $m_komisi_kinerja_detail_view->id->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->id_barang->Visible) { // id_barang ?>
	<tr id="r_id_barang">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_id_barang"><?php echo $m_komisi_kinerja_detail_view->id_barang->caption() ?></span></td>
		<td data-name="id_barang" <?php echo $m_komisi_kinerja_detail_view->id_barang->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_id_barang">
<span<?php echo $m_komisi_kinerja_detail_view->id_barang->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->id_barang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->kinerja_default_persen->Visible) { // kinerja_default_persen ?>
	<tr id="r_kinerja_default_persen">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_default_persen"><?php echo $m_komisi_kinerja_detail_view->kinerja_default_persen->caption() ?></span></td>
		<td data-name="kinerja_default_persen" <?php echo $m_komisi_kinerja_detail_view->kinerja_default_persen->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_kinerja_default_persen">
<span<?php echo $m_komisi_kinerja_detail_view->kinerja_default_persen->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->kinerja_default_persen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->kinerja_default_rupiah->Visible) { // kinerja_default_rupiah ?>
	<tr id="r_kinerja_default_rupiah">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_default_rupiah"><?php echo $m_komisi_kinerja_detail_view->kinerja_default_rupiah->caption() ?></span></td>
		<td data-name="kinerja_default_rupiah" <?php echo $m_komisi_kinerja_detail_view->kinerja_default_rupiah->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_kinerja_default_rupiah">
<span<?php echo $m_komisi_kinerja_detail_view->kinerja_default_rupiah->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->kinerja_default_rupiah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->kinerja_target_persen->Visible) { // kinerja_target_persen ?>
	<tr id="r_kinerja_target_persen">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_target_persen"><?php echo $m_komisi_kinerja_detail_view->kinerja_target_persen->caption() ?></span></td>
		<td data-name="kinerja_target_persen" <?php echo $m_komisi_kinerja_detail_view->kinerja_target_persen->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_kinerja_target_persen">
<span<?php echo $m_komisi_kinerja_detail_view->kinerja_target_persen->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->kinerja_target_persen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->kinerja_target_rupiah->Visible) { // kinerja_target_rupiah ?>
	<tr id="r_kinerja_target_rupiah">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_kinerja_target_rupiah"><?php echo $m_komisi_kinerja_detail_view->kinerja_target_rupiah->caption() ?></span></td>
		<td data-name="kinerja_target_rupiah" <?php echo $m_komisi_kinerja_detail_view->kinerja_target_rupiah->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_kinerja_target_rupiah">
<span<?php echo $m_komisi_kinerja_detail_view->kinerja_target_rupiah->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->kinerja_target_rupiah->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->tgl_mulai->Visible) { // tgl_mulai ?>
	<tr id="r_tgl_mulai">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_tgl_mulai"><?php echo $m_komisi_kinerja_detail_view->tgl_mulai->caption() ?></span></td>
		<td data-name="tgl_mulai" <?php echo $m_komisi_kinerja_detail_view->tgl_mulai->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_tgl_mulai">
<span<?php echo $m_komisi_kinerja_detail_view->tgl_mulai->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->tgl_akhir->Visible) { // tgl_akhir ?>
	<tr id="r_tgl_akhir">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_tgl_akhir"><?php echo $m_komisi_kinerja_detail_view->tgl_akhir->caption() ?></span></td>
		<td data-name="tgl_akhir" <?php echo $m_komisi_kinerja_detail_view->tgl_akhir->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_tgl_akhir">
<span<?php echo $m_komisi_kinerja_detail_view->tgl_akhir->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_komisi_kinerja_detail_view->target->Visible) { // target ?>
	<tr id="r_target">
		<td class="<?php echo $m_komisi_kinerja_detail_view->TableLeftColumnClass ?>"><span id="elh_m_komisi_kinerja_detail_target"><?php echo $m_komisi_kinerja_detail_view->target->caption() ?></span></td>
		<td data-name="target" <?php echo $m_komisi_kinerja_detail_view->target->cellAttributes() ?>>
<span id="el_m_komisi_kinerja_detail_target">
<span<?php echo $m_komisi_kinerja_detail_view->target->viewAttributes() ?>><?php echo $m_komisi_kinerja_detail_view->target->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_komisi_kinerja_detail_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_komisi_kinerja_detail_view->isExport()) { ?>
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
$m_komisi_kinerja_detail_view->terminate();
?>