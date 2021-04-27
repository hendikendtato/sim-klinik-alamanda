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
$m_kategoripelanggan_delete = new m_kategoripelanggan_delete();

// Run the page
$m_kategoripelanggan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kategoripelanggan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fm_kategoripelanggandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fm_kategoripelanggandelete = currentForm = new ew.Form("fm_kategoripelanggandelete", "delete");
	loadjs.done("fm_kategoripelanggandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $m_kategoripelanggan_delete->showPageHeader(); ?>
<?php
$m_kategoripelanggan_delete->showMessage();
?>
<form name="fm_kategoripelanggandelete" id="fm_kategoripelanggandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kategoripelanggan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($m_kategoripelanggan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($m_kategoripelanggan_delete->nama_kategori->Visible) { // nama_kategori ?>
		<th class="<?php echo $m_kategoripelanggan_delete->nama_kategori->headerCellClass() ?>"><span id="elh_m_kategoripelanggan_nama_kategori" class="m_kategoripelanggan_nama_kategori"><?php echo $m_kategoripelanggan_delete->nama_kategori->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$m_kategoripelanggan_delete->RecordCount = 0;
$i = 0;
while (!$m_kategoripelanggan_delete->Recordset->EOF) {
	$m_kategoripelanggan_delete->RecordCount++;
	$m_kategoripelanggan_delete->RowCount++;

	// Set row properties
	$m_kategoripelanggan->resetAttributes();
	$m_kategoripelanggan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$m_kategoripelanggan_delete->loadRowValues($m_kategoripelanggan_delete->Recordset);

	// Render row
	$m_kategoripelanggan_delete->renderRow();
?>
	<tr <?php echo $m_kategoripelanggan->rowAttributes() ?>>
<?php if ($m_kategoripelanggan_delete->nama_kategori->Visible) { // nama_kategori ?>
		<td <?php echo $m_kategoripelanggan_delete->nama_kategori->cellAttributes() ?>>
<span id="el<?php echo $m_kategoripelanggan_delete->RowCount ?>_m_kategoripelanggan_nama_kategori" class="m_kategoripelanggan_nama_kategori">
<span<?php echo $m_kategoripelanggan_delete->nama_kategori->viewAttributes() ?>><?php echo $m_kategoripelanggan_delete->nama_kategori->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$m_kategoripelanggan_delete->Recordset->moveNext();
}
$m_kategoripelanggan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $m_kategoripelanggan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$m_kategoripelanggan_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$m_kategoripelanggan_delete->terminate();
?>