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
$detailjurnal_list = new detailjurnal_list();

// Run the page
$detailjurnal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailjurnal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$detailjurnal_list->isExport()) { ?>
<script>
var fdetailjurnallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdetailjurnallist = currentForm = new ew.Form("fdetailjurnallist", "list");
	fdetailjurnallist.formKeyCountName = '<?php echo $detailjurnal_list->FormKeyCountName ?>';
	loadjs.done("fdetailjurnallist");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$detailjurnal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($detailjurnal_list->TotalRecords > 0 && $detailjurnal_list->ExportOptions->visible()) { ?>
<?php $detailjurnal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($detailjurnal_list->ImportOptions->visible()) { ?>
<?php $detailjurnal_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$detailjurnal_list->isExport() || Config("EXPORT_MASTER_RECORD") && $detailjurnal_list->isExport("print")) { ?>
<?php
if ($detailjurnal_list->DbMasterFilter != "" && $detailjurnal->getCurrentMasterTable() == "jurnal") {
	if ($detailjurnal_list->MasterRecordExists) {
		include_once "jurnalmaster.php";
	}
}
?>
<?php } ?>
<?php
$detailjurnal_list->renderOtherOptions();
?>
<?php $detailjurnal_list->showPageHeader(); ?>
<?php
$detailjurnal_list->showMessage();
?>
<?php if ($detailjurnal_list->TotalRecords > 0 || $detailjurnal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($detailjurnal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> detailjurnal">
<?php if (!$detailjurnal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$detailjurnal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailjurnal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailjurnal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdetailjurnallist" id="fdetailjurnallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="detailjurnal">
<?php if ($detailjurnal->getCurrentMasterTable() == "jurnal" && $detailjurnal->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="jurnal">
<input type="hidden" name="fk_id_jurnal" value="<?php echo HtmlEncode($detailjurnal_list->id_jurnal->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_detailjurnal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($detailjurnal_list->TotalRecords > 0 || $detailjurnal_list->isGridEdit()) { ?>
<table id="tbl_detailjurnallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$detailjurnal->RowType = ROWTYPE_HEADER;

// Render list options
$detailjurnal_list->renderListOptions();

// Render list options (header, left)
$detailjurnal_list->ListOptions->render("header", "left");
?>
<?php if ($detailjurnal_list->id_detailjurnal->Visible) { // id_detailjurnal ?>
	<?php if ($detailjurnal_list->SortUrl($detailjurnal_list->id_detailjurnal) == "") { ?>
		<th data-name="id_detailjurnal" class="<?php echo $detailjurnal_list->id_detailjurnal->headerCellClass() ?>"><div id="elh_detailjurnal_id_detailjurnal" class="detailjurnal_id_detailjurnal"><div class="ew-table-header-caption"><?php echo $detailjurnal_list->id_detailjurnal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_detailjurnal" class="<?php echo $detailjurnal_list->id_detailjurnal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailjurnal_list->SortUrl($detailjurnal_list->id_detailjurnal) ?>', 1);"><div id="elh_detailjurnal_id_detailjurnal" class="detailjurnal_id_detailjurnal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_list->id_detailjurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_list->id_detailjurnal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_list->id_detailjurnal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_list->id_jurnal->Visible) { // id_jurnal ?>
	<?php if ($detailjurnal_list->SortUrl($detailjurnal_list->id_jurnal) == "") { ?>
		<th data-name="id_jurnal" class="<?php echo $detailjurnal_list->id_jurnal->headerCellClass() ?>"><div id="elh_detailjurnal_id_jurnal" class="detailjurnal_id_jurnal"><div class="ew-table-header-caption"><?php echo $detailjurnal_list->id_jurnal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jurnal" class="<?php echo $detailjurnal_list->id_jurnal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailjurnal_list->SortUrl($detailjurnal_list->id_jurnal) ?>', 1);"><div id="elh_detailjurnal_id_jurnal" class="detailjurnal_id_jurnal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_list->id_jurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_list->id_jurnal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_list->id_jurnal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_list->id_akun->Visible) { // id_akun ?>
	<?php if ($detailjurnal_list->SortUrl($detailjurnal_list->id_akun) == "") { ?>
		<th data-name="id_akun" class="<?php echo $detailjurnal_list->id_akun->headerCellClass() ?>"><div id="elh_detailjurnal_id_akun" class="detailjurnal_id_akun"><div class="ew-table-header-caption"><?php echo $detailjurnal_list->id_akun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_akun" class="<?php echo $detailjurnal_list->id_akun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailjurnal_list->SortUrl($detailjurnal_list->id_akun) ?>', 1);"><div id="elh_detailjurnal_id_akun" class="detailjurnal_id_akun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_list->id_akun->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_list->id_akun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_list->id_akun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_list->debet->Visible) { // debet ?>
	<?php if ($detailjurnal_list->SortUrl($detailjurnal_list->debet) == "") { ?>
		<th data-name="debet" class="<?php echo $detailjurnal_list->debet->headerCellClass() ?>"><div id="elh_detailjurnal_debet" class="detailjurnal_debet"><div class="ew-table-header-caption"><?php echo $detailjurnal_list->debet->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="debet" class="<?php echo $detailjurnal_list->debet->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailjurnal_list->SortUrl($detailjurnal_list->debet) ?>', 1);"><div id="elh_detailjurnal_debet" class="detailjurnal_debet">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_list->debet->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_list->debet->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_list->debet->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_list->kredit->Visible) { // kredit ?>
	<?php if ($detailjurnal_list->SortUrl($detailjurnal_list->kredit) == "") { ?>
		<th data-name="kredit" class="<?php echo $detailjurnal_list->kredit->headerCellClass() ?>"><div id="elh_detailjurnal_kredit" class="detailjurnal_kredit"><div class="ew-table-header-caption"><?php echo $detailjurnal_list->kredit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kredit" class="<?php echo $detailjurnal_list->kredit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $detailjurnal_list->SortUrl($detailjurnal_list->kredit) ?>', 1);"><div id="elh_detailjurnal_kredit" class="detailjurnal_kredit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_list->kredit->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_list->kredit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_list->kredit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailjurnal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($detailjurnal_list->ExportAll && $detailjurnal_list->isExport()) {
	$detailjurnal_list->StopRecord = $detailjurnal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($detailjurnal_list->TotalRecords > $detailjurnal_list->StartRecord + $detailjurnal_list->DisplayRecords - 1)
		$detailjurnal_list->StopRecord = $detailjurnal_list->StartRecord + $detailjurnal_list->DisplayRecords - 1;
	else
		$detailjurnal_list->StopRecord = $detailjurnal_list->TotalRecords;
}
$detailjurnal_list->RecordCount = $detailjurnal_list->StartRecord - 1;
if ($detailjurnal_list->Recordset && !$detailjurnal_list->Recordset->EOF) {
	$detailjurnal_list->Recordset->moveFirst();
	$selectLimit = $detailjurnal_list->UseSelectLimit;
	if (!$selectLimit && $detailjurnal_list->StartRecord > 1)
		$detailjurnal_list->Recordset->move($detailjurnal_list->StartRecord - 1);
} elseif (!$detailjurnal->AllowAddDeleteRow && $detailjurnal_list->StopRecord == 0) {
	$detailjurnal_list->StopRecord = $detailjurnal->GridAddRowCount;
}

// Initialize aggregate
$detailjurnal->RowType = ROWTYPE_AGGREGATEINIT;
$detailjurnal->resetAttributes();
$detailjurnal_list->renderRow();
while ($detailjurnal_list->RecordCount < $detailjurnal_list->StopRecord) {
	$detailjurnal_list->RecordCount++;
	if ($detailjurnal_list->RecordCount >= $detailjurnal_list->StartRecord) {
		$detailjurnal_list->RowCount++;

		// Set up key count
		$detailjurnal_list->KeyCount = $detailjurnal_list->RowIndex;

		// Init row class and style
		$detailjurnal->resetAttributes();
		$detailjurnal->CssClass = "";
		if ($detailjurnal_list->isGridAdd()) {
		} else {
			$detailjurnal_list->loadRowValues($detailjurnal_list->Recordset); // Load row values
		}
		$detailjurnal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$detailjurnal->RowAttrs->merge(["data-rowindex" => $detailjurnal_list->RowCount, "id" => "r" . $detailjurnal_list->RowCount . "_detailjurnal", "data-rowtype" => $detailjurnal->RowType]);

		// Render row
		$detailjurnal_list->renderRow();

		// Render list options
		$detailjurnal_list->renderListOptions();
?>
	<tr <?php echo $detailjurnal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailjurnal_list->ListOptions->render("body", "left", $detailjurnal_list->RowCount);
?>
	<?php if ($detailjurnal_list->id_detailjurnal->Visible) { // id_detailjurnal ?>
		<td data-name="id_detailjurnal" <?php echo $detailjurnal_list->id_detailjurnal->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_list->RowCount ?>_detailjurnal_id_detailjurnal">
<span<?php echo $detailjurnal_list->id_detailjurnal->viewAttributes() ?>><?php echo $detailjurnal_list->id_detailjurnal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailjurnal_list->id_jurnal->Visible) { // id_jurnal ?>
		<td data-name="id_jurnal" <?php echo $detailjurnal_list->id_jurnal->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_list->RowCount ?>_detailjurnal_id_jurnal">
<span<?php echo $detailjurnal_list->id_jurnal->viewAttributes() ?>><?php echo $detailjurnal_list->id_jurnal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailjurnal_list->id_akun->Visible) { // id_akun ?>
		<td data-name="id_akun" <?php echo $detailjurnal_list->id_akun->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_list->RowCount ?>_detailjurnal_id_akun">
<span<?php echo $detailjurnal_list->id_akun->viewAttributes() ?>><?php echo $detailjurnal_list->id_akun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailjurnal_list->debet->Visible) { // debet ?>
		<td data-name="debet" <?php echo $detailjurnal_list->debet->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_list->RowCount ?>_detailjurnal_debet">
<span<?php echo $detailjurnal_list->debet->viewAttributes() ?>><?php echo $detailjurnal_list->debet->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($detailjurnal_list->kredit->Visible) { // kredit ?>
		<td data-name="kredit" <?php echo $detailjurnal_list->kredit->cellAttributes() ?>>
<span id="el<?php echo $detailjurnal_list->RowCount ?>_detailjurnal_kredit">
<span<?php echo $detailjurnal_list->kredit->viewAttributes() ?>><?php echo $detailjurnal_list->kredit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$detailjurnal_list->ListOptions->render("body", "right", $detailjurnal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$detailjurnal_list->isGridAdd())
		$detailjurnal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$detailjurnal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($detailjurnal_list->Recordset)
	$detailjurnal_list->Recordset->Close();
?>
<?php if (!$detailjurnal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$detailjurnal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $detailjurnal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $detailjurnal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($detailjurnal_list->TotalRecords == 0 && !$detailjurnal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $detailjurnal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$detailjurnal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$detailjurnal_list->isExport()) { ?>
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
$detailjurnal_list->terminate();
?>