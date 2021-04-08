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
WriteHeader(FALSE, "utf-8");

// Create page object
$detailretur_preview = new detailretur_preview();

// Run the page
$detailretur_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailretur_preview->Page_Render();
?>
<?php $detailretur_preview->showPageHeader(); ?>
<?php if ($detailretur_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailretur"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailretur_preview->renderListOptions();

// Render list options (header, left)
$detailretur_preview->ListOptions->render("header", "left");
?>
<?php if ($detailretur_preview->id_detailretur->Visible) { // id_detailretur ?>
	<?php if ($detailretur->SortUrl($detailretur_preview->id_detailretur) == "") { ?>
		<th class="<?php echo $detailretur_preview->id_detailretur->headerCellClass() ?>"><?php echo $detailretur_preview->id_detailretur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailretur_preview->id_detailretur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailretur_preview->id_detailretur->Name) ?>" data-sort-order="<?php echo $detailretur_preview->SortField == $detailretur_preview->id_detailretur->Name && $detailretur_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_preview->id_detailretur->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_preview->SortField == $detailretur_preview->id_detailretur->Name) { ?><?php if ($detailretur_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_preview->id_retur->Visible) { // id_retur ?>
	<?php if ($detailretur->SortUrl($detailretur_preview->id_retur) == "") { ?>
		<th class="<?php echo $detailretur_preview->id_retur->headerCellClass() ?>"><?php echo $detailretur_preview->id_retur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailretur_preview->id_retur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailretur_preview->id_retur->Name) ?>" data-sort-order="<?php echo $detailretur_preview->SortField == $detailretur_preview->id_retur->Name && $detailretur_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_preview->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_preview->SortField == $detailretur_preview->id_retur->Name) { ?><?php if ($detailretur_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailretur->SortUrl($detailretur_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailretur_preview->id_barang->headerCellClass() ?>"><?php echo $detailretur_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailretur_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailretur_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailretur_preview->SortField == $detailretur_preview->id_barang->Name && $detailretur_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_preview->SortField == $detailretur_preview->id_barang->Name) { ?><?php if ($detailretur_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailretur->SortUrl($detailretur_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailretur_preview->jumlah->headerCellClass() ?>"><?php echo $detailretur_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailretur_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailretur_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailretur_preview->SortField == $detailretur_preview->jumlah->Name && $detailretur_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_preview->SortField == $detailretur_preview->jumlah->Name) { ?><?php if ($detailretur_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailretur_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailretur->SortUrl($detailretur_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailretur_preview->id_satuan->headerCellClass() ?>"><?php echo $detailretur_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailretur_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailretur_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailretur_preview->SortField == $detailretur_preview->id_satuan->Name && $detailretur_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailretur_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailretur_preview->SortField == $detailretur_preview->id_satuan->Name) { ?><?php if ($detailretur_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailretur_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailretur_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailretur_preview->RecCount = 0;
$detailretur_preview->RowCount = 0;
while ($detailretur_preview->Recordset && !$detailretur_preview->Recordset->EOF) {

	// Init row class and style
	$detailretur_preview->RecCount++;
	$detailretur_preview->RowCount++;
	$detailretur_preview->CssStyle = "";
	$detailretur_preview->loadListRowValues($detailretur_preview->Recordset);

	// Render row
	$detailretur->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailretur_preview->resetAttributes();
	$detailretur_preview->renderListRow();

	// Render list options
	$detailretur_preview->renderListOptions();
?>
	<tr <?php echo $detailretur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailretur_preview->ListOptions->render("body", "left", $detailretur_preview->RowCount);
?>
<?php if ($detailretur_preview->id_detailretur->Visible) { // id_detailretur ?>
		<!-- id_detailretur -->
		<td<?php echo $detailretur_preview->id_detailretur->cellAttributes() ?>>
<span<?php echo $detailretur_preview->id_detailretur->viewAttributes() ?>><?php echo $detailretur_preview->id_detailretur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailretur_preview->id_retur->Visible) { // id_retur ?>
		<!-- id_retur -->
		<td<?php echo $detailretur_preview->id_retur->cellAttributes() ?>>
<span<?php echo $detailretur_preview->id_retur->viewAttributes() ?>><?php echo $detailretur_preview->id_retur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailretur_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailretur_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailretur_preview->id_barang->viewAttributes() ?>><?php echo $detailretur_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailretur_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailretur_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailretur_preview->jumlah->viewAttributes() ?>><?php echo $detailretur_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailretur_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailretur_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailretur_preview->id_satuan->viewAttributes() ?>><?php echo $detailretur_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailretur_preview->ListOptions->render("body", "right", $detailretur_preview->RowCount);
?>
	</tr>
<?php
	$detailretur_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailretur_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailretur_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailretur_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailretur_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailretur_preview->Recordset)
	$detailretur_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailretur_preview->terminate();
?>