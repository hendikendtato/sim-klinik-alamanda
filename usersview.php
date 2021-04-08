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
$users_view = new users_view();

// Run the page
$users_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$users_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$users_view->isExport()) { ?>
<script>
var fusersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusersview = currentForm = new ew.Form("fusersview", "view");
	loadjs.done("fusersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$users_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $users_view->ExportOptions->render("body") ?>
<?php $users_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $users_view->showPageHeader(); ?>
<?php
$users_view->showMessage();
?>
<form name="fusersview" id="fusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="users">
<input type="hidden" name="modal" value="<?php echo (int)$users_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($users_view->_userid->Visible) { // userid ?>
	<tr id="r__userid">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users__userid"><?php echo $users_view->_userid->caption() ?></span></td>
		<td data-name="_userid" <?php echo $users_view->_userid->cellAttributes() ?>>
<span id="el_users__userid">
<span<?php echo $users_view->_userid->viewAttributes() ?>><?php echo $users_view->_userid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->id_klinik->Visible) { // id_klinik ?>
	<tr id="r_id_klinik">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_id_klinik"><?php echo $users_view->id_klinik->caption() ?></span></td>
		<td data-name="id_klinik" <?php echo $users_view->id_klinik->cellAttributes() ?>>
<span id="el_users_id_klinik">
<span<?php echo $users_view->id_klinik->viewAttributes() ?>><?php echo $users_view->id_klinik->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->id_pegawai->Visible) { // id_pegawai ?>
	<tr id="r_id_pegawai">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_id_pegawai"><?php echo $users_view->id_pegawai->caption() ?></span></td>
		<td data-name="id_pegawai" <?php echo $users_view->id_pegawai->cellAttributes() ?>>
<span id="el_users_id_pegawai">
<span<?php echo $users_view->id_pegawai->viewAttributes() ?>><?php echo $users_view->id_pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_username"><?php echo $users_view->username->caption() ?></span></td>
		<td data-name="username" <?php echo $users_view->username->cellAttributes() ?>>
<span id="el_users_username">
<span<?php echo $users_view->username->viewAttributes() ?>><?php echo $users_view->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->userpwd->Visible) { // userpwd ?>
	<tr id="r_userpwd">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_userpwd"><?php echo $users_view->userpwd->caption() ?></span></td>
		<td data-name="userpwd" <?php echo $users_view->userpwd->cellAttributes() ?>>
<span id="el_users_userpwd">
<span<?php echo $users_view->userpwd->viewAttributes() ?>><?php echo $users_view->userpwd->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($users_view->level->Visible) { // level ?>
	<tr id="r_level">
		<td class="<?php echo $users_view->TableLeftColumnClass ?>"><span id="elh_users_level"><?php echo $users_view->level->caption() ?></span></td>
		<td data-name="level" <?php echo $users_view->level->cellAttributes() ?>>
<span id="el_users_level">
<span<?php echo $users_view->level->viewAttributes() ?>><?php echo $users_view->level->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$users_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$users_view->isExport()) { ?>
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
$users_view->terminate();
?>