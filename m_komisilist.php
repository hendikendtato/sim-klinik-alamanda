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
$m_komisi_list = new m_komisi_list();

// Run the page
$m_komisi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_komisi_list->isExport()) { ?>
<script>
var fm_komisilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_komisilist = currentForm = new ew.Form("fm_komisilist", "list");
	fm_komisilist.formKeyCountName = '<?php echo $m_komisi_list->FormKeyCountName ?>';
	loadjs.done("fm_komisilist");
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
	$("a.btn.btn-default.ew-add-edit.ew-add").attr("href","m_komisiadd.php?showdetail=m_komisi_kinerja_detail,m_komisi_recall_detail"),$("span.ew-detail-option.ew-list-option-separator.text-nowrap").hide(),$("a.ew-row-link.ew-view").each(function(){var i=$(this).attr("href").split("=");$(this).attr("href",i[0]+"=m_komisi_kinerja_detail,m_komisi_recall_detail"+i[1]+"="+i[2])}),$("a.ew-row-link.ew-edit").each(function(){var i=$(this).attr("href").split("=");$(this).attr("href",i[0]+"=m_komisi_kinerja_detail,m_komisi_recall_detail"+i[1]+"="+i[2])}),$("a.ew-row-link.ew-copy").each(function(){var i=$(this).attr("href").split("=");$(this).attr("href",i[0]+"=m_komisi_kinerja_detail,m_komisi_recall_detail"+i[1]+"="+i[2])});
});
</script>
<?php } ?>
<?php if (!$m_komisi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_komisi_list->TotalRecords > 0 && $m_komisi_list->ExportOptions->visible()) { ?>
<?php $m_komisi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_komisi_list->ImportOptions->visible()) { ?>
<?php $m_komisi_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_komisi_list->renderOtherOptions();
?>
<?php $m_komisi_list->showPageHeader(); ?>
<?php
$m_komisi_list->showMessage();
?>
<?php if ($m_komisi_list->TotalRecords > 0 || $m_komisi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_komisi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_komisi">
<?php if (!$m_komisi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_komisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_komisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_komisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_komisilist" id="fm_komisilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_komisi">
<div id="gmp_m_komisi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_komisi_list->TotalRecords > 0 || $m_komisi_list->isGridEdit()) { ?>
<table id="tbl_m_komisilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_komisi->RowType = ROWTYPE_HEADER;

// Render list options
$m_komisi_list->renderListOptions();

// Render list options (header, left)
$m_komisi_list->ListOptions->render("header", "left");
?>
<?php if ($m_komisi_list->id_komisi->Visible) { // id_komisi ?>
	<?php if ($m_komisi_list->SortUrl($m_komisi_list->id_komisi) == "") { ?>
		<th data-name="id_komisi" class="<?php echo $m_komisi_list->id_komisi->headerCellClass() ?>"><div id="elh_m_komisi_id_komisi" class="m_komisi_id_komisi"><div class="ew-table-header-caption"><?php echo $m_komisi_list->id_komisi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_komisi" class="<?php echo $m_komisi_list->id_komisi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_list->SortUrl($m_komisi_list->id_komisi) ?>', 1);"><div id="elh_m_komisi_id_komisi" class="m_komisi_id_komisi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_list->id_komisi->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_list->id_komisi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_list->id_komisi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_list->id_jabatan->Visible) { // id_jabatan ?>
	<?php if ($m_komisi_list->SortUrl($m_komisi_list->id_jabatan) == "") { ?>
		<th data-name="id_jabatan" class="<?php echo $m_komisi_list->id_jabatan->headerCellClass() ?>"><div id="elh_m_komisi_id_jabatan" class="m_komisi_id_jabatan"><div class="ew-table-header-caption"><?php echo $m_komisi_list->id_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_jabatan" class="<?php echo $m_komisi_list->id_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_komisi_list->SortUrl($m_komisi_list->id_jabatan) ?>', 1);"><div id="elh_m_komisi_id_jabatan" class="m_komisi_id_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_list->id_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_list->id_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_list->id_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_komisi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_komisi_list->ExportAll && $m_komisi_list->isExport()) {
	$m_komisi_list->StopRecord = $m_komisi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_komisi_list->TotalRecords > $m_komisi_list->StartRecord + $m_komisi_list->DisplayRecords - 1)
		$m_komisi_list->StopRecord = $m_komisi_list->StartRecord + $m_komisi_list->DisplayRecords - 1;
	else
		$m_komisi_list->StopRecord = $m_komisi_list->TotalRecords;
}
$m_komisi_list->RecordCount = $m_komisi_list->StartRecord - 1;
if ($m_komisi_list->Recordset && !$m_komisi_list->Recordset->EOF) {
	$m_komisi_list->Recordset->moveFirst();
	$selectLimit = $m_komisi_list->UseSelectLimit;
	if (!$selectLimit && $m_komisi_list->StartRecord > 1)
		$m_komisi_list->Recordset->move($m_komisi_list->StartRecord - 1);
} elseif (!$m_komisi->AllowAddDeleteRow && $m_komisi_list->StopRecord == 0) {
	$m_komisi_list->StopRecord = $m_komisi->GridAddRowCount;
}

// Initialize aggregate
$m_komisi->RowType = ROWTYPE_AGGREGATEINIT;
$m_komisi->resetAttributes();
$m_komisi_list->renderRow();
while ($m_komisi_list->RecordCount < $m_komisi_list->StopRecord) {
	$m_komisi_list->RecordCount++;
	if ($m_komisi_list->RecordCount >= $m_komisi_list->StartRecord) {
		$m_komisi_list->RowCount++;

		// Set up key count
		$m_komisi_list->KeyCount = $m_komisi_list->RowIndex;

		// Init row class and style
		$m_komisi->resetAttributes();
		$m_komisi->CssClass = "";
		if ($m_komisi_list->isGridAdd()) {
		} else {
			$m_komisi_list->loadRowValues($m_komisi_list->Recordset); // Load row values
		}
		$m_komisi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_komisi->RowAttrs->merge(["data-rowindex" => $m_komisi_list->RowCount, "id" => "r" . $m_komisi_list->RowCount . "_m_komisi", "data-rowtype" => $m_komisi->RowType]);

		// Render row
		$m_komisi_list->renderRow();

		// Render list options
		$m_komisi_list->renderListOptions();
?>
	<tr <?php echo $m_komisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_komisi_list->ListOptions->render("body", "left", $m_komisi_list->RowCount);
?>
	<?php if ($m_komisi_list->id_komisi->Visible) { // id_komisi ?>
		<td data-name="id_komisi" <?php echo $m_komisi_list->id_komisi->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_list->RowCount ?>_m_komisi_id_komisi">
<span<?php echo $m_komisi_list->id_komisi->viewAttributes() ?>><?php echo $m_komisi_list->id_komisi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_komisi_list->id_jabatan->Visible) { // id_jabatan ?>
		<td data-name="id_jabatan" <?php echo $m_komisi_list->id_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_komisi_list->RowCount ?>_m_komisi_id_jabatan">
<span<?php echo $m_komisi_list->id_jabatan->viewAttributes() ?>><?php echo $m_komisi_list->id_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_komisi_list->ListOptions->render("body", "right", $m_komisi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_komisi_list->isGridAdd())
		$m_komisi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_komisi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_komisi_list->Recordset)
	$m_komisi_list->Recordset->Close();
?>
<?php if (!$m_komisi_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_komisi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_komisi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_komisi_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_komisi_list->TotalRecords == 0 && !$m_komisi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_komisi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_komisi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_komisi_list->isExport()) { ?>
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
$m_komisi_list->terminate();
?>