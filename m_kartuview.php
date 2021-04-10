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
$m_kartu_view = new m_kartu_view();

// Run the page
$m_kartu_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kartu_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kartu_view->isExport()) { ?>
<script>
var fm_kartuview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_kartuview = currentForm = new ew.Form("fm_kartuview", "view");
	loadjs.done("fm_kartuview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_kartu_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_kartu_view->ExportOptions->render("body") ?>
<?php $m_kartu_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_kartu_view->showPageHeader(); ?>
<?php
$m_kartu_view->showMessage();
?>
<form name="fm_kartuview" id="fm_kartuview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kartu">
<input type="hidden" name="modal" value="<?php echo (int)$m_kartu_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_kartu_view->id_kartu->Visible) { // id_kartu ?>
	<tr id="r_id_kartu">
		<td class="<?php echo $m_kartu_view->TableLeftColumnClass ?>"><span id="elh_m_kartu_id_kartu"><?php echo $m_kartu_view->id_kartu->caption() ?></span></td>
		<td data-name="id_kartu" <?php echo $m_kartu_view->id_kartu->cellAttributes() ?>>
<span id="el_m_kartu_id_kartu">
<span<?php echo $m_kartu_view->id_kartu->viewAttributes() ?>><?php echo $m_kartu_view->id_kartu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kartu_view->id_bank->Visible) { // id_bank ?>
	<tr id="r_id_bank">
		<td class="<?php echo $m_kartu_view->TableLeftColumnClass ?>"><span id="elh_m_kartu_id_bank"><?php echo $m_kartu_view->id_bank->caption() ?></span></td>
		<td data-name="id_bank" <?php echo $m_kartu_view->id_bank->cellAttributes() ?>>
<span id="el_m_kartu_id_bank">
<span<?php echo $m_kartu_view->id_bank->viewAttributes() ?>><?php echo $m_kartu_view->id_bank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kartu_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $m_kartu_view->TableLeftColumnClass ?>"><span id="elh_m_kartu_jenis"><?php echo $m_kartu_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $m_kartu_view->jenis->cellAttributes() ?>>
<span id="el_m_kartu_jenis">
<span<?php echo $m_kartu_view->jenis->viewAttributes() ?>><?php echo $m_kartu_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kartu_view->nama_kartu->Visible) { // nama_kartu ?>
	<tr id="r_nama_kartu">
		<td class="<?php echo $m_kartu_view->TableLeftColumnClass ?>"><span id="elh_m_kartu_nama_kartu"><?php echo $m_kartu_view->nama_kartu->caption() ?></span></td>
		<td data-name="nama_kartu" <?php echo $m_kartu_view->nama_kartu->cellAttributes() ?>>
<span id="el_m_kartu_nama_kartu">
<span<?php echo $m_kartu_view->nama_kartu->viewAttributes() ?>><?php echo $m_kartu_view->nama_kartu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kartu_view->charge_type->Visible) { // charge_type ?>
	<tr id="r_charge_type">
		<td class="<?php echo $m_kartu_view->TableLeftColumnClass ?>"><span id="elh_m_kartu_charge_type"><?php echo $m_kartu_view->charge_type->caption() ?></span></td>
		<td data-name="charge_type" <?php echo $m_kartu_view->charge_type->cellAttributes() ?>>
<span id="el_m_kartu_charge_type">
<span<?php echo $m_kartu_view->charge_type->viewAttributes() ?>><?php echo $m_kartu_view->charge_type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kartu_view->charge_price->Visible) { // charge_price ?>
	<tr id="r_charge_price">
		<td class="<?php echo $m_kartu_view->TableLeftColumnClass ?>"><span id="elh_m_kartu_charge_price"><?php echo $m_kartu_view->charge_price->caption() ?></span></td>
		<td data-name="charge_price" <?php echo $m_kartu_view->charge_price->cellAttributes() ?>>
<span id="el_m_kartu_charge_price">
<span<?php echo $m_kartu_view->charge_price->viewAttributes() ?>><?php echo $m_kartu_view->charge_price->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_kartu_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kartu_view->isExport()) { ?>
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
$m_kartu_view->terminate();
?>