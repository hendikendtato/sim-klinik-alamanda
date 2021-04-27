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
$wp_reservasi_view = new wp_reservasi_view();

// Run the page
$wp_reservasi_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$wp_reservasi_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$wp_reservasi_view->isExport()) { ?>
<script>
var fwp_reservasiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fwp_reservasiview = currentForm = new ew.Form("fwp_reservasiview", "view");
	loadjs.done("fwp_reservasiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$wp_reservasi_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $wp_reservasi_view->ExportOptions->render("body") ?>
<?php $wp_reservasi_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $wp_reservasi_view->showPageHeader(); ?>
<?php
$wp_reservasi_view->showMessage();
?>
<form name="fwp_reservasiview" id="fwp_reservasiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="wp_reservasi">
<input type="hidden" name="modal" value="<?php echo (int)$wp_reservasi_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($wp_reservasi_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_id"><?php echo $wp_reservasi_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $wp_reservasi_view->id->cellAttributes() ?>>
<span id="el_wp_reservasi_id">
<span<?php echo $wp_reservasi_view->id->viewAttributes() ?>><?php echo $wp_reservasi_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_nama"><?php echo $wp_reservasi_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $wp_reservasi_view->nama->cellAttributes() ?>>
<span id="el_wp_reservasi_nama">
<span<?php echo $wp_reservasi_view->nama->viewAttributes() ?>><?php echo $wp_reservasi_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->no_telp->Visible) { // no_telp ?>
	<tr id="r_no_telp">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_no_telp"><?php echo $wp_reservasi_view->no_telp->caption() ?></span></td>
		<td data-name="no_telp" <?php echo $wp_reservasi_view->no_telp->cellAttributes() ?>>
<span id="el_wp_reservasi_no_telp">
<span<?php echo $wp_reservasi_view->no_telp->viewAttributes() ?>><?php echo $wp_reservasi_view->no_telp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_keterangan"><?php echo $wp_reservasi_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $wp_reservasi_view->keterangan->cellAttributes() ?>>
<span id="el_wp_reservasi_keterangan">
<span<?php echo $wp_reservasi_view->keterangan->viewAttributes() ?>><?php echo $wp_reservasi_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->jenis_perawatan->Visible) { // jenis_perawatan ?>
	<tr id="r_jenis_perawatan">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_jenis_perawatan"><?php echo $wp_reservasi_view->jenis_perawatan->caption() ?></span></td>
		<td data-name="jenis_perawatan" <?php echo $wp_reservasi_view->jenis_perawatan->cellAttributes() ?>>
<span id="el_wp_reservasi_jenis_perawatan">
<span<?php echo $wp_reservasi_view->jenis_perawatan->viewAttributes() ?>><?php echo $wp_reservasi_view->jenis_perawatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_id_klinik"><?php echo $wp_reservasi_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $wp_reservasi_view->id_klinik->cellAttributes() ?>>
<span id="el_wp_reservasi_id_klinik">
<span<?php echo $wp_reservasi_view->id_klinik->viewAttributes() ?>><?php echo $wp_reservasi_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->terapis->Visible) { // terapis ?>
	<tr id="r_terapis">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_terapis"><?php echo $wp_reservasi_view->terapis->caption() ?></span></td>
		<td data-name="terapis" <?php echo $wp_reservasi_view->terapis->cellAttributes() ?>>
<span id="el_wp_reservasi_terapis">
<span<?php echo $wp_reservasi_view->terapis->viewAttributes() ?>><?php echo $wp_reservasi_view->terapis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_tanggal"><?php echo $wp_reservasi_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $wp_reservasi_view->tanggal->cellAttributes() ?>>
<span id="el_wp_reservasi_tanggal">
<span<?php echo $wp_reservasi_view->tanggal->viewAttributes() ?>><?php echo $wp_reservasi_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->jam_mulai->Visible) { // jam_mulai ?>
	<tr id="r_jam_mulai">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_jam_mulai"><?php echo $wp_reservasi_view->jam_mulai->caption() ?></span></td>
		<td data-name="jam_mulai" <?php echo $wp_reservasi_view->jam_mulai->cellAttributes() ?>>
<span id="el_wp_reservasi_jam_mulai">
<span<?php echo $wp_reservasi_view->jam_mulai->viewAttributes() ?>><?php echo $wp_reservasi_view->jam_mulai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->jam_selesai->Visible) { // jam_selesai ?>
	<tr id="r_jam_selesai">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_jam_selesai"><?php echo $wp_reservasi_view->jam_selesai->caption() ?></span></td>
		<td data-name="jam_selesai" <?php echo $wp_reservasi_view->jam_selesai->cellAttributes() ?>>
<span id="el_wp_reservasi_jam_selesai">
<span<?php echo $wp_reservasi_view->jam_selesai->viewAttributes() ?>><?php echo $wp_reservasi_view->jam_selesai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($wp_reservasi_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $wp_reservasi_view->TableLeftColumnClass ?>"><span id="elh_wp_reservasi_status"><?php echo $wp_reservasi_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $wp_reservasi_view->status->cellAttributes() ?>>
<span id="el_wp_reservasi_status">
<span<?php echo $wp_reservasi_view->status->viewAttributes() ?>><?php echo $wp_reservasi_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$wp_reservasi_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$wp_reservasi_view->isExport()) { ?>
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
$wp_reservasi_view->terminate();
?>