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
$m_kategoripelanggan_view = new m_kategoripelanggan_view();

// Run the page
$m_kategoripelanggan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kategoripelanggan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kategoripelanggan_view->isExport()) { ?>
<script>
var fm_kategoripelangganview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_kategoripelangganview = currentForm = new ew.Form("fm_kategoripelangganview", "view");
	loadjs.done("fm_kategoripelangganview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_kategoripelanggan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_kategoripelanggan_view->ExportOptions->render("body") ?>
<?php $m_kategoripelanggan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_kategoripelanggan_view->showPageHeader(); ?>
<?php
$m_kategoripelanggan_view->showMessage();
?>
<form name="fm_kategoripelangganview" id="fm_kategoripelangganview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kategoripelanggan">
<input type="hidden" name="modal" value="<?php echo (int)$m_kategoripelanggan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_kategoripelanggan_view->id_kategori->Visible) { // id_kategori ?>
	<tr id="r_id_kategori">
		<td class="<?php echo $m_kategoripelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_kategoripelanggan_id_kategori"><?php echo $m_kategoripelanggan_view->id_kategori->caption() ?></span></td>
		<td data-name="id_kategori" <?php echo $m_kategoripelanggan_view->id_kategori->cellAttributes() ?>>
<span id="el_m_kategoripelanggan_id_kategori">
<span<?php echo $m_kategoripelanggan_view->id_kategori->viewAttributes() ?>><?php echo $m_kategoripelanggan_view->id_kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_kategoripelanggan_view->nama_kategori->Visible) { // nama_kategori ?>
	<tr id="r_nama_kategori">
		<td class="<?php echo $m_kategoripelanggan_view->TableLeftColumnClass ?>"><span id="elh_m_kategoripelanggan_nama_kategori"><?php echo $m_kategoripelanggan_view->nama_kategori->caption() ?></span></td>
		<td data-name="nama_kategori" <?php echo $m_kategoripelanggan_view->nama_kategori->cellAttributes() ?>>
<span id="el_m_kategoripelanggan_nama_kategori">
<span<?php echo $m_kategoripelanggan_view->nama_kategori->viewAttributes() ?>><?php echo $m_kategoripelanggan_view->nama_kategori->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_kategoripelanggan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kategoripelanggan_view->isExport()) { ?>
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
$m_kategoripelanggan_view->terminate();
?>