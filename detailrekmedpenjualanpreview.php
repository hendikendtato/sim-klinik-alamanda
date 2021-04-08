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
$detailrekmedpenjualan_preview = new detailrekmedpenjualan_preview();

// Run the page
$detailrekmedpenjualan_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedpenjualan_preview->Page_Render();
?>
<?php $detailrekmedpenjualan_preview->showPageHeader(); ?>
<?php if ($detailrekmedpenjualan_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailrekmedpenjualan"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailrekmedpenjualan_preview->renderListOptions();

// Render list options (header, left)
$detailrekmedpenjualan_preview->ListOptions->render("header", "left");
?>
<?php if ($detailrekmedpenjualan_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmedpenjualan->SortUrl($detailrekmedpenjualan_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailrekmedpenjualan_preview->id_barang->headerCellClass() ?>"><?php echo $detailrekmedpenjualan_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmedpenjualan_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmedpenjualan_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailrekmedpenjualan_preview->SortField == $detailrekmedpenjualan_preview->id_barang->Name && $detailrekmedpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_preview->SortField == $detailrekmedpenjualan_preview->id_barang->Name) { ?><?php if ($detailrekmedpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmedpenjualan->SortUrl($detailrekmedpenjualan_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailrekmedpenjualan_preview->jumlah->headerCellClass() ?>"><?php echo $detailrekmedpenjualan_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmedpenjualan_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmedpenjualan_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailrekmedpenjualan_preview->SortField == $detailrekmedpenjualan_preview->jumlah->Name && $detailrekmedpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_preview->SortField == $detailrekmedpenjualan_preview->jumlah->Name) { ?><?php if ($detailrekmedpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedpenjualan_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailrekmedpenjualan->SortUrl($detailrekmedpenjualan_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailrekmedpenjualan_preview->id_satuan->headerCellClass() ?>"><?php echo $detailrekmedpenjualan_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmedpenjualan_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmedpenjualan_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailrekmedpenjualan_preview->SortField == $detailrekmedpenjualan_preview->id_satuan->Name && $detailrekmedpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedpenjualan_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedpenjualan_preview->SortField == $detailrekmedpenjualan_preview->id_satuan->Name) { ?><?php if ($detailrekmedpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmedpenjualan_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailrekmedpenjualan_preview->RecCount = 0;
$detailrekmedpenjualan_preview->RowCount = 0;
while ($detailrekmedpenjualan_preview->Recordset && !$detailrekmedpenjualan_preview->Recordset->EOF) {

	// Init row class and style
	$detailrekmedpenjualan_preview->RecCount++;
	$detailrekmedpenjualan_preview->RowCount++;
	$detailrekmedpenjualan_preview->CssStyle = "";
	$detailrekmedpenjualan_preview->loadListRowValues($detailrekmedpenjualan_preview->Recordset);

	// Render row
	$detailrekmedpenjualan->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailrekmedpenjualan_preview->resetAttributes();
	$detailrekmedpenjualan_preview->renderListRow();

	// Render list options
	$detailrekmedpenjualan_preview->renderListOptions();
?>
	<tr <?php echo $detailrekmedpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedpenjualan_preview->ListOptions->render("body", "left", $detailrekmedpenjualan_preview->RowCount);
?>
<?php if ($detailrekmedpenjualan_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailrekmedpenjualan_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailrekmedpenjualan_preview->id_barang->viewAttributes() ?>><?php echo $detailrekmedpenjualan_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailrekmedpenjualan_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailrekmedpenjualan_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailrekmedpenjualan_preview->jumlah->viewAttributes() ?>><?php echo $detailrekmedpenjualan_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailrekmedpenjualan_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailrekmedpenjualan_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailrekmedpenjualan_preview->id_satuan->viewAttributes() ?>><?php echo $detailrekmedpenjualan_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedpenjualan_preview->ListOptions->render("body", "right", $detailrekmedpenjualan_preview->RowCount);
?>
	</tr>
<?php
	$detailrekmedpenjualan_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailrekmedpenjualan_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailrekmedpenjualan_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailrekmedpenjualan_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailrekmedpenjualan_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailrekmedpenjualan_preview->Recordset)
	$detailrekmedpenjualan_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailrekmedpenjualan_preview->terminate();
?>