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
$rekmeddokter_view = new rekmeddokter_view();

// Run the page
$rekmeddokter_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekmeddokter_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$rekmeddokter_view->isExport()) { ?>
<script>
var frekmeddokterview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	frekmeddokterview = currentForm = new ew.Form("frekmeddokterview", "view");
	loadjs.done("frekmeddokterview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$rekmeddokter_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $rekmeddokter_view->ExportOptions->render("body") ?>
<?php $rekmeddokter_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rekmeddokter_view->showPageHeader(); ?>
<?php
$rekmeddokter_view->showMessage();
?>
<form name="frekmeddokterview" id="frekmeddokterview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekmeddokter">
<input type="hidden" name="modal" value="<?php echo (int)$rekmeddokter_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($rekmeddokter_view->id_rekmeddok->Visible) { // id_rekmeddok ?>
	<tr id="r_id_rekmeddok">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_id_rekmeddok"><?php echo $rekmeddokter_view->id_rekmeddok->caption() ?></span></td>
		<td data-name="id_rekmeddok" <?php echo $rekmeddokter_view->id_rekmeddok->cellAttributes() ?>>
<span id="el_rekmeddokter_id_rekmeddok">
<span<?php echo $rekmeddokter_view->id_rekmeddok->viewAttributes() ?>><?php echo $rekmeddokter_view->id_rekmeddok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->kode_rekmeddok->Visible) { // kode_rekmeddok ?>
	<tr id="r_kode_rekmeddok">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_kode_rekmeddok"><?php echo $rekmeddokter_view->kode_rekmeddok->caption() ?></span></td>
		<td data-name="kode_rekmeddok" <?php echo $rekmeddokter_view->kode_rekmeddok->cellAttributes() ?>>
<span id="el_rekmeddokter_kode_rekmeddok">
<span<?php echo $rekmeddokter_view->kode_rekmeddok->viewAttributes() ?>><?php echo $rekmeddokter_view->kode_rekmeddok->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->tanggal->Visible) { // tanggal ?>
	<tr id="r_tanggal">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_tanggal"><?php echo $rekmeddokter_view->tanggal->caption() ?></span></td>
		<td data-name="tanggal" <?php echo $rekmeddokter_view->tanggal->cellAttributes() ?>>
<span id="el_rekmeddokter_tanggal">
<span<?php echo $rekmeddokter_view->tanggal->viewAttributes() ?>><?php echo $rekmeddokter_view->tanggal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->id_pelanggan->Visible) { // id_pelanggan ?>
	<tr id="r_id_pelanggan">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_id_pelanggan"><?php echo $rekmeddokter_view->id_pelanggan->caption() ?></span></td>
		<td data-name="id_pelanggan" <?php echo $rekmeddokter_view->id_pelanggan->cellAttributes() ?>>
<span id="el_rekmeddokter_id_pelanggan">
<span<?php echo $rekmeddokter_view->id_pelanggan->viewAttributes() ?>><?php echo $rekmeddokter_view->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->id_dokter->Visible) { // id_dokter ?>
	<tr id="r_id_dokter">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_id_dokter"><?php echo $rekmeddokter_view->id_dokter->caption() ?></span></td>
		<td data-name="id_dokter" <?php echo $rekmeddokter_view->id_dokter->cellAttributes() ?>>
<span id="el_rekmeddokter_id_dokter">
<span<?php echo $rekmeddokter_view->id_dokter->viewAttributes() ?>><?php echo $rekmeddokter_view->id_dokter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->id_be->Visible) { // id_be ?>
	<tr id="r_id_be">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_id_be"><?php echo $rekmeddokter_view->id_be->caption() ?></span></td>
		<td data-name="id_be" <?php echo $rekmeddokter_view->id_be->cellAttributes() ?>>
<span id="el_rekmeddokter_id_be">
<span<?php echo $rekmeddokter_view->id_be->viewAttributes() ?>><?php echo $rekmeddokter_view->id_be->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->keluhan->Visible) { // keluhan ?>
	<tr id="r_keluhan">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_keluhan"><?php echo $rekmeddokter_view->keluhan->caption() ?></span></td>
		<td data-name="keluhan" <?php echo $rekmeddokter_view->keluhan->cellAttributes() ?>>
<span id="el_rekmeddokter_keluhan">
<span<?php echo $rekmeddokter_view->keluhan->viewAttributes() ?>><?php echo $rekmeddokter_view->keluhan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->gejala_klinis->Visible) { // gejala_klinis ?>
	<tr id="r_gejala_klinis">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_gejala_klinis"><?php echo $rekmeddokter_view->gejala_klinis->caption() ?></span></td>
		<td data-name="gejala_klinis" <?php echo $rekmeddokter_view->gejala_klinis->cellAttributes() ?>>
<span id="el_rekmeddokter_gejala_klinis">
<span<?php echo $rekmeddokter_view->gejala_klinis->viewAttributes() ?>><?php echo $rekmeddokter_view->gejala_klinis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->terapi->Visible) { // terapi ?>
	<tr id="r_terapi">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_terapi"><?php echo $rekmeddokter_view->terapi->caption() ?></span></td>
		<td data-name="terapi" <?php echo $rekmeddokter_view->terapi->cellAttributes() ?>>
<span id="el_rekmeddokter_terapi">
<span<?php echo $rekmeddokter_view->terapi->viewAttributes() ?>><?php echo $rekmeddokter_view->terapi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->tindakan->Visible) { // tindakan ?>
	<tr id="r_tindakan">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_tindakan"><?php echo $rekmeddokter_view->tindakan->caption() ?></span></td>
		<td data-name="tindakan" <?php echo $rekmeddokter_view->tindakan->cellAttributes() ?>>
<span id="el_rekmeddokter_tindakan">
<span<?php echo $rekmeddokter_view->tindakan->viewAttributes() ?>><?php echo $rekmeddokter_view->tindakan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekmeddokter_view->foto_perawatan->Visible) { // foto_perawatan ?>
	<tr id="r_foto_perawatan">
		<td class="<?php echo $rekmeddokter_view->TableLeftColumnClass ?>"><span id="elh_rekmeddokter_foto_perawatan"><?php echo $rekmeddokter_view->foto_perawatan->caption() ?></span></td>
		<td data-name="foto_perawatan" <?php echo $rekmeddokter_view->foto_perawatan->cellAttributes() ?>>
<span id="el_rekmeddokter_foto_perawatan">
<span<?php echo $rekmeddokter_view->foto_perawatan->viewAttributes() ?>><?php echo GetFileViewTag($rekmeddokter_view->foto_perawatan, $rekmeddokter_view->foto_perawatan->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if ($rekmeddokter->getCurrentDetailTable() != "") { ?>
<?php
	$rekmeddokter_view->DetailPages->ValidKeys = explode(",", $rekmeddokter->getCurrentDetailTable());
	$firstActiveDetailTable = $rekmeddokter_view->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="rekmeddokter_view_details"><!-- tabs -->
	<ul class="<?php echo $rekmeddokter_view->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("detailrekmeddok", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmeddok->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmeddok") {
			$firstActiveDetailTable = "detailrekmeddok";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $rekmeddokter_view->DetailPages->pageStyle("detailrekmeddok") ?>" href="#tab_detailrekmeddok" data-toggle="tab"><?php echo $Language->tablePhrase("detailrekmeddok", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("detailrekmedterapis", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedterapis->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedterapis") {
			$firstActiveDetailTable = "detailrekmedterapis";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $rekmeddokter_view->DetailPages->pageStyle("detailrekmedterapis") ?>" href="#tab_detailrekmedterapis" data-toggle="tab"><?php echo $Language->tablePhrase("detailrekmedterapis", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("detailrekmedpenjualan", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedpenjualan->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedpenjualan") {
			$firstActiveDetailTable = "detailrekmedpenjualan";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $rekmeddokter_view->DetailPages->pageStyle("detailrekmedpenjualan") ?>" href="#tab_detailrekmedpenjualan" data-toggle="tab"><?php echo $Language->tablePhrase("detailrekmedpenjualan", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("detailrekmeddok", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmeddok->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmeddok")
			$firstActiveDetailTable = "detailrekmeddok";
?>
		<div class="tab-pane <?php echo $rekmeddokter_view->DetailPages->pageStyle("detailrekmeddok") ?>" id="tab_detailrekmeddok"><!-- page* -->
<?php include_once "detailrekmeddokgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("detailrekmedterapis", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedterapis->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedterapis")
			$firstActiveDetailTable = "detailrekmedterapis";
?>
		<div class="tab-pane <?php echo $rekmeddokter_view->DetailPages->pageStyle("detailrekmedterapis") ?>" id="tab_detailrekmedterapis"><!-- page* -->
<?php include_once "detailrekmedterapisgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("detailrekmedpenjualan", explode(",", $rekmeddokter->getCurrentDetailTable())) && $detailrekmedpenjualan->DetailView) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "detailrekmedpenjualan")
			$firstActiveDetailTable = "detailrekmedpenjualan";
?>
		<div class="tab-pane <?php echo $rekmeddokter_view->DetailPages->pageStyle("detailrekmedpenjualan") ?>" id="tab_detailrekmedpenjualan"><!-- page* -->
<?php include_once "detailrekmedpenjualangrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$rekmeddokter_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$rekmeddokter_view->isExport()) { ?>
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
$rekmeddokter_view->terminate();
?>