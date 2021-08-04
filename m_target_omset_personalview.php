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
$m_target_omset_personal_view = new m_target_omset_personal_view();

// Run the page
$m_target_omset_personal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_target_omset_personal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_target_omset_personal_view->isExport()) { ?>
<script>
var fm_target_omset_personalview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_target_omset_personalview = currentForm = new ew.Form("fm_target_omset_personalview", "view");
	loadjs.done("fm_target_omset_personalview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_target_omset_personal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_target_omset_personal_view->ExportOptions->render("body") ?>
<?php $m_target_omset_personal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_target_omset_personal_view->showPageHeader(); ?>
<?php
$m_target_omset_personal_view->showMessage();
?>
<form name="fm_target_omset_personalview" id="fm_target_omset_personalview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_target_omset_personal">
<input type="hidden" name="modal" value="<?php echo (int)$m_target_omset_personal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_target_omset_personal_view->id_target_omset_personal->Visible) { // id_target_omset_personal ?>
	<tr id="r_id_target_omset_personal">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_id_target_omset_personal"><?php echo $m_target_omset_personal_view->id_target_omset_personal->caption() ?></span></td>
		<td data-name="id_target_omset_personal" <?php echo $m_target_omset_personal_view->id_target_omset_personal->cellAttributes() ?>>
<span id="el_m_target_omset_personal_id_target_omset_personal">
<span<?php echo $m_target_omset_personal_view->id_target_omset_personal->viewAttributes() ?>><?php echo $m_target_omset_personal_view->id_target_omset_personal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->id_cabang->Visible) { // id_cabang ?>
	<tr id="r_id_cabang">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_id_cabang"><?php echo $m_target_omset_personal_view->id_cabang->caption() ?></span></td>
		<td data-name="id_cabang" <?php echo $m_target_omset_personal_view->id_cabang->cellAttributes() ?>>
<span id="el_m_target_omset_personal_id_cabang">
<span<?php echo $m_target_omset_personal_view->id_cabang->viewAttributes() ?>><?php echo $m_target_omset_personal_view->id_cabang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->id_jabatan->Visible) { // id_jabatan ?>
	<tr id="r_id_jabatan">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_id_jabatan"><?php echo $m_target_omset_personal_view->id_jabatan->caption() ?></span></td>
		<td data-name="id_jabatan" <?php echo $m_target_omset_personal_view->id_jabatan->cellAttributes() ?>>
<span id="el_m_target_omset_personal_id_jabatan">
<span<?php echo $m_target_omset_personal_view->id_jabatan->viewAttributes() ?>><?php echo $m_target_omset_personal_view->id_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->tgl_awal->Visible) { // tgl_awal ?>
	<tr id="r_tgl_awal">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_tgl_awal"><?php echo $m_target_omset_personal_view->tgl_awal->caption() ?></span></td>
		<td data-name="tgl_awal" <?php echo $m_target_omset_personal_view->tgl_awal->cellAttributes() ?>>
<span id="el_m_target_omset_personal_tgl_awal">
<span<?php echo $m_target_omset_personal_view->tgl_awal->viewAttributes() ?>><?php echo $m_target_omset_personal_view->tgl_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->tgl_akhir->Visible) { // tgl_akhir ?>
	<tr id="r_tgl_akhir">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_tgl_akhir"><?php echo $m_target_omset_personal_view->tgl_akhir->caption() ?></span></td>
		<td data-name="tgl_akhir" <?php echo $m_target_omset_personal_view->tgl_akhir->cellAttributes() ?>>
<span id="el_m_target_omset_personal_tgl_akhir">
<span<?php echo $m_target_omset_personal_view->tgl_akhir->viewAttributes() ?>><?php echo $m_target_omset_personal_view->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->target->Visible) { // target ?>
	<tr id="r_target">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_target"><?php echo $m_target_omset_personal_view->target->caption() ?></span></td>
		<td data-name="target" <?php echo $m_target_omset_personal_view->target->cellAttributes() ?>>
<span id="el_m_target_omset_personal_target">
<span<?php echo $m_target_omset_personal_view->target->viewAttributes() ?>><?php echo $m_target_omset_personal_view->target->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->baseline->Visible) { // baseline ?>
	<tr id="r_baseline">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_baseline"><?php echo $m_target_omset_personal_view->baseline->caption() ?></span></td>
		<td data-name="baseline" <?php echo $m_target_omset_personal_view->baseline->cellAttributes() ?>>
<span id="el_m_target_omset_personal_baseline">
<span<?php echo $m_target_omset_personal_view->baseline->viewAttributes() ?>><?php echo $m_target_omset_personal_view->baseline->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->aset->Visible) { // aset ?>
	<tr id="r_aset">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_aset"><?php echo $m_target_omset_personal_view->aset->caption() ?></span></td>
		<td data-name="aset" <?php echo $m_target_omset_personal_view->aset->cellAttributes() ?>>
<span id="el_m_target_omset_personal_aset">
<span<?php echo $m_target_omset_personal_view->aset->viewAttributes() ?>><?php echo $m_target_omset_personal_view->aset->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->created->Visible) { // created ?>
	<tr id="r_created">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_created"><?php echo $m_target_omset_personal_view->created->caption() ?></span></td>
		<td data-name="created" <?php echo $m_target_omset_personal_view->created->cellAttributes() ?>>
<span id="el_m_target_omset_personal_created">
<span<?php echo $m_target_omset_personal_view->created->viewAttributes() ?>><?php echo $m_target_omset_personal_view->created->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_target_omset_personal_view->updated->Visible) { // updated ?>
	<tr id="r_updated">
		<td class="<?php echo $m_target_omset_personal_view->TableLeftColumnClass ?>"><span id="elh_m_target_omset_personal_updated"><?php echo $m_target_omset_personal_view->updated->caption() ?></span></td>
		<td data-name="updated" <?php echo $m_target_omset_personal_view->updated->cellAttributes() ?>>
<span id="el_m_target_omset_personal_updated">
<span<?php echo $m_target_omset_personal_view->updated->viewAttributes() ?>><?php echo $m_target_omset_personal_view->updated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_target_omset_personal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_target_omset_personal_view->isExport()) { ?>
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
$m_target_omset_personal_view->terminate();
?>