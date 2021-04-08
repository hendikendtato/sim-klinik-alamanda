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
$m_tags_view = new m_tags_view();

// Run the page
$m_tags_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tags_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_tags_view->isExport()) { ?>
<script>
var fm_tagsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_tagsview = currentForm = new ew.Form("fm_tagsview", "view");
	loadjs.done("fm_tagsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_tags_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_tags_view->ExportOptions->render("body") ?>
<?php $m_tags_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_tags_view->showPageHeader(); ?>
<?php
$m_tags_view->showMessage();
?>
<form name="fm_tagsview" id="fm_tagsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tags">
<input type="hidden" name="modal" value="<?php echo (int)$m_tags_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_tags_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_tags_view->TableLeftColumnClass ?>"><span id="elh_m_tags_id"><?php echo $m_tags_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_tags_view->id->cellAttributes() ?>>
<span id="el_m_tags_id">
<span<?php echo $m_tags_view->id->viewAttributes() ?>><?php echo $m_tags_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_tags_view->nama_tag->Visible) { // nama_tag ?>
	<tr id="r_nama_tag">
		<td class="<?php echo $m_tags_view->TableLeftColumnClass ?>"><span id="elh_m_tags_nama_tag"><?php echo $m_tags_view->nama_tag->caption() ?></span></td>
		<td data-name="nama_tag" <?php echo $m_tags_view->nama_tag->cellAttributes() ?>>
<span id="el_m_tags_nama_tag">
<span<?php echo $m_tags_view->nama_tag->viewAttributes() ?>><?php echo $m_tags_view->nama_tag->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$m_tags_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_tags_view->isExport()) { ?>
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
$m_tags_view->terminate();
?>