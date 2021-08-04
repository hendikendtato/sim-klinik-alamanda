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
$m_target_perawatan_view = new m_target_perawatan_view();

// Run the page
$m_target_perawatan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_perawatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_target_perawatan_view->isExport()) { ?>
<script>
var fm_target_perawatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_target_perawatanview = currentForm = new ew.Form("fm_target_perawatanview", "view");
	loadjs.done("fm_target_perawatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_target_perawatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_target_perawatan_view->ExportOptions->render("body") ?>
<?php $m_target_perawatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_target_perawatan_view->showPageHeader(); ?>
<?php
$m_target_perawatan_view->showMessage();
?>
<form name="fm_target_perawatanview" id="fm_target_perawatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_perawatan">
<input type="hidden" name="modal" value="<?php echo (int)$m_target_perawatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_target_perawatan_view->id_target_perawatan->Visible) { // id_target_perawatan ?>
	<tr id="r_id_target_perawatan">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_id_target_perawatan"><?php echo $m_target_perawatan_view->id_target_perawatan->caption() ?></span></td>
		<td data-name="id_target_perawatan" <?php echo $m_target_perawatan_view->id_target_perawatan->cellAttributes() ?>>
<span id="el_m_target_perawatan_id_target_perawatan">
<span<?php echo $m_target_perawatan_view->id_target_perawatan->viewAttributes() ?>><?php echo $m_target_perawatan_view->id_target_perawatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->id_cabang->Visible) { // id_cabang ?>
	<tr id="r_id_cabang">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_id_cabang"><?php echo $m_target_perawatan_view->id_cabang->caption() ?></span></td>
		<td data-name="id_cabang" <?php echo $m_target_perawatan_view->id_cabang->cellAttributes() ?>>
<span id="el_m_target_perawatan_id_cabang">
<span<?php echo $m_target_perawatan_view->id_cabang->viewAttributes() ?>><?php echo $m_target_perawatan_view->id_cabang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_jenis"><?php echo $m_target_perawatan_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $m_target_perawatan_view->jenis->cellAttributes() ?>>
<span id="el_m_target_perawatan_jenis">
<span<?php echo $m_target_perawatan_view->jenis->viewAttributes() ?>><?php echo $m_target_perawatan_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->tgl_awal->Visible) { // tgl_awal ?>
	<tr id="r_tgl_awal">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_tgl_awal"><?php echo $m_target_perawatan_view->tgl_awal->caption() ?></span></td>
		<td data-name="tgl_awal" <?php echo $m_target_perawatan_view->tgl_awal->cellAttributes() ?>>
<span id="el_m_target_perawatan_tgl_awal">
<span<?php echo $m_target_perawatan_view->tgl_awal->viewAttributes() ?>><?php echo $m_target_perawatan_view->tgl_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->tgl_akhir->Visible) { // tgl_akhir ?>
	<tr id="r_tgl_akhir">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_tgl_akhir"><?php echo $m_target_perawatan_view->tgl_akhir->caption() ?></span></td>
		<td data-name="tgl_akhir" <?php echo $m_target_perawatan_view->tgl_akhir->cellAttributes() ?>>
<span id="el_m_target_perawatan_tgl_akhir">
<span<?php echo $m_target_perawatan_view->tgl_akhir->viewAttributes() ?>><?php echo $m_target_perawatan_view->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->target->Visible) { // target ?>
	<tr id="r_target">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_target"><?php echo $m_target_perawatan_view->target->caption() ?></span></td>
		<td data-name="target" <?php echo $m_target_perawatan_view->target->cellAttributes() ?>>
<span id="el_m_target_perawatan_target">
<span<?php echo $m_target_perawatan_view->target->viewAttributes() ?>><?php echo $m_target_perawatan_view->target->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->created->Visible) { // created ?>
	<tr id="r_created">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_created"><?php echo $m_target_perawatan_view->created->caption() ?></span></td>
		<td data-name="created" <?php echo $m_target_perawatan_view->created->cellAttributes() ?>>
<span id="el_m_target_perawatan_created">
<span<?php echo $m_target_perawatan_view->created->viewAttributes() ?>><?php echo $m_target_perawatan_view->created->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_perawatan_view->updated->Visible) { // updated ?>
	<tr id="r_updated">
		<td class="<?php echo $m_target_perawatan_view->TableLeftColumnClass ?>"><span id="elh_m_target_perawatan_updated"><?php echo $m_target_perawatan_view->updated->caption() ?></span></td>
		<td data-name="updated" <?php echo $m_target_perawatan_view->updated->cellAttributes() ?>>
<span id="el_m_target_perawatan_updated">
<span<?php echo $m_target_perawatan_view->updated->viewAttributes() ?>><?php echo $m_target_perawatan_view->updated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_target_perawatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_target_perawatan_view->isExport()) { ?>
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
$m_target_perawatan_view->terminate();
?>