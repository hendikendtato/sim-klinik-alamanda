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
WriteHeader(FALSE, "utf-8");

// Create page object
$detailjurnal_preview = new detailjurnal_preview();

// Run the page
$detailjurnal_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailjurnal_preview->Page_Render();
?>
<?php $detailjurnal_preview->showPageHeader(); ?>
<?php if ($detailjurnal_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailjurnal"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailjurnal_preview->renderListOptions();

// Render list options (header, left)
$detailjurnal_preview->ListOptions->render("header", "left");
?>
<?php if ($detailjurnal_preview->id_detailjurnal->Visible) { // id_detailjurnal ?>
	<?php if ($detailjurnal->SortUrl($detailjurnal_preview->id_detailjurnal) == "") { ?>
		<th class="<?php echo $detailjurnal_preview->id_detailjurnal->headerCellClass() ?>"><?php echo $detailjurnal_preview->id_detailjurnal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailjurnal_preview->id_detailjurnal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailjurnal_preview->id_detailjurnal->Name) ?>" data-sort-order="<?php echo $detailjurnal_preview->SortField == $detailjurnal_preview->id_detailjurnal->Name && $detailjurnal_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_preview->id_detailjurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_preview->SortField == $detailjurnal_preview->id_detailjurnal->Name) { ?><?php if ($detailjurnal_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_preview->id_jurnal->Visible) { // id_jurnal ?>
	<?php if ($detailjurnal->SortUrl($detailjurnal_preview->id_jurnal) == "") { ?>
		<th class="<?php echo $detailjurnal_preview->id_jurnal->headerCellClass() ?>"><?php echo $detailjurnal_preview->id_jurnal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailjurnal_preview->id_jurnal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailjurnal_preview->id_jurnal->Name) ?>" data-sort-order="<?php echo $detailjurnal_preview->SortField == $detailjurnal_preview->id_jurnal->Name && $detailjurnal_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_preview->id_jurnal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_preview->SortField == $detailjurnal_preview->id_jurnal->Name) { ?><?php if ($detailjurnal_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_preview->id_akun->Visible) { // id_akun ?>
	<?php if ($detailjurnal->SortUrl($detailjurnal_preview->id_akun) == "") { ?>
		<th class="<?php echo $detailjurnal_preview->id_akun->headerCellClass() ?>"><?php echo $detailjurnal_preview->id_akun->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailjurnal_preview->id_akun->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailjurnal_preview->id_akun->Name) ?>" data-sort-order="<?php echo $detailjurnal_preview->SortField == $detailjurnal_preview->id_akun->Name && $detailjurnal_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_preview->id_akun->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_preview->SortField == $detailjurnal_preview->id_akun->Name) { ?><?php if ($detailjurnal_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_preview->debet->Visible) { // debet ?>
	<?php if ($detailjurnal->SortUrl($detailjurnal_preview->debet) == "") { ?>
		<th class="<?php echo $detailjurnal_preview->debet->headerCellClass() ?>"><?php echo $detailjurnal_preview->debet->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailjurnal_preview->debet->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailjurnal_preview->debet->Name) ?>" data-sort-order="<?php echo $detailjurnal_preview->SortField == $detailjurnal_preview->debet->Name && $detailjurnal_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_preview->debet->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_preview->SortField == $detailjurnal_preview->debet->Name) { ?><?php if ($detailjurnal_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailjurnal_preview->kredit->Visible) { // kredit ?>
	<?php if ($detailjurnal->SortUrl($detailjurnal_preview->kredit) == "") { ?>
		<th class="<?php echo $detailjurnal_preview->kredit->headerCellClass() ?>"><?php echo $detailjurnal_preview->kredit->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailjurnal_preview->kredit->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailjurnal_preview->kredit->Name) ?>" data-sort-order="<?php echo $detailjurnal_preview->SortField == $detailjurnal_preview->kredit->Name && $detailjurnal_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailjurnal_preview->kredit->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailjurnal_preview->SortField == $detailjurnal_preview->kredit->Name) { ?><?php if ($detailjurnal_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailjurnal_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailjurnal_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailjurnal_preview->RecCount = 0;
$detailjurnal_preview->RowCount = 0;
while ($detailjurnal_preview->Recordset && !$detailjurnal_preview->Recordset->EOF) {

	// Init row class and style
	$detailjurnal_preview->RecCount++;
	$detailjurnal_preview->RowCount++;
	$detailjurnal_preview->CssStyle = "";
	$detailjurnal_preview->loadListRowValues($detailjurnal_preview->Recordset);

	// Render row
	$detailjurnal->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailjurnal_preview->resetAttributes();
	$detailjurnal_preview->renderListRow();

	// Render list options
	$detailjurnal_preview->renderListOptions();
?>
	<tr <?php echo $detailjurnal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailjurnal_preview->ListOptions->render("body", "left", $detailjurnal_preview->RowCount);
?>
<?php if ($detailjurnal_preview->id_detailjurnal->Visible) { // id_detailjurnal ?>
		<!-- id_detailjurnal -->
		<td<?php echo $detailjurnal_preview->id_detailjurnal->cellAttributes() ?>>
<span<?php echo $detailjurnal_preview->id_detailjurnal->viewAttributes() ?>><?php echo $detailjurnal_preview->id_detailjurnal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailjurnal_preview->id_jurnal->Visible) { // id_jurnal ?>
		<!-- id_jurnal -->
		<td<?php echo $detailjurnal_preview->id_jurnal->cellAttributes() ?>>
<span<?php echo $detailjurnal_preview->id_jurnal->viewAttributes() ?>><?php echo $detailjurnal_preview->id_jurnal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailjurnal_preview->id_akun->Visible) { // id_akun ?>
		<!-- id_akun -->
		<td<?php echo $detailjurnal_preview->id_akun->cellAttributes() ?>>
<span<?php echo $detailjurnal_preview->id_akun->viewAttributes() ?>><?php echo $detailjurnal_preview->id_akun->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailjurnal_preview->debet->Visible) { // debet ?>
		<!-- debet -->
		<td<?php echo $detailjurnal_preview->debet->cellAttributes() ?>>
<span<?php echo $detailjurnal_preview->debet->viewAttributes() ?>><?php echo $detailjurnal_preview->debet->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailjurnal_preview->kredit->Visible) { // kredit ?>
		<!-- kredit -->
		<td<?php echo $detailjurnal_preview->kredit->cellAttributes() ?>>
<span<?php echo $detailjurnal_preview->kredit->viewAttributes() ?>><?php echo $detailjurnal_preview->kredit->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailjurnal_preview->ListOptions->render("body", "right", $detailjurnal_preview->RowCount);
?>
	</tr>
<?php
	$detailjurnal_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailjurnal_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailjurnal_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailjurnal_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailjurnal_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailjurnal_preview->Recordset)
	$detailjurnal_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailjurnal_preview->terminate();
?>