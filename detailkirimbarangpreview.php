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
$detailkirimbarang_preview = new detailkirimbarang_preview();

// Run the page
$detailkirimbarang_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkirimbarang_preview->Page_Render();
?>
<?php $detailkirimbarang_preview->showPageHeader(); ?>
<?php if ($detailkirimbarang_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailkirimbarang"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailkirimbarang_preview->renderListOptions();

// Render list options (header, left)
$detailkirimbarang_preview->ListOptions->render("header", "left");
?>
<?php if ($detailkirimbarang_preview->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($detailkirimbarang->SortUrl($detailkirimbarang_preview->id_kirimbarang) == "") { ?>
		<th class="<?php echo $detailkirimbarang_preview->id_kirimbarang->headerCellClass() ?>"><?php echo $detailkirimbarang_preview->id_kirimbarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkirimbarang_preview->id_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkirimbarang_preview->id_kirimbarang->Name) ?>" data-sort-order="<?php echo $detailkirimbarang_preview->SortField == $detailkirimbarang_preview->id_kirimbarang->Name && $detailkirimbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_preview->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_preview->SortField == $detailkirimbarang_preview->id_kirimbarang->Name) { ?><?php if ($detailkirimbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailkirimbarang->SortUrl($detailkirimbarang_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailkirimbarang_preview->id_barang->headerCellClass() ?>"><?php echo $detailkirimbarang_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkirimbarang_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkirimbarang_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailkirimbarang_preview->SortField == $detailkirimbarang_preview->id_barang->Name && $detailkirimbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_preview->SortField == $detailkirimbarang_preview->id_barang->Name) { ?><?php if ($detailkirimbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailkirimbarang->SortUrl($detailkirimbarang_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailkirimbarang_preview->id_satuan->headerCellClass() ?>"><?php echo $detailkirimbarang_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkirimbarang_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkirimbarang_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailkirimbarang_preview->SortField == $detailkirimbarang_preview->id_satuan->Name && $detailkirimbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_preview->SortField == $detailkirimbarang_preview->id_satuan->Name) { ?><?php if ($detailkirimbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkirimbarang_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailkirimbarang->SortUrl($detailkirimbarang_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailkirimbarang_preview->jumlah->headerCellClass() ?>"><?php echo $detailkirimbarang_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkirimbarang_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkirimbarang_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailkirimbarang_preview->SortField == $detailkirimbarang_preview->jumlah->Name && $detailkirimbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkirimbarang_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkirimbarang_preview->SortField == $detailkirimbarang_preview->jumlah->Name) { ?><?php if ($detailkirimbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkirimbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailkirimbarang_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailkirimbarang_preview->RecCount = 0;
$detailkirimbarang_preview->RowCount = 0;
while ($detailkirimbarang_preview->Recordset && !$detailkirimbarang_preview->Recordset->EOF) {

	// Init row class and style
	$detailkirimbarang_preview->RecCount++;
	$detailkirimbarang_preview->RowCount++;
	$detailkirimbarang_preview->CssStyle = "";
	$detailkirimbarang_preview->loadListRowValues($detailkirimbarang_preview->Recordset);

	// Render row
	$detailkirimbarang->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailkirimbarang_preview->resetAttributes();
	$detailkirimbarang_preview->renderListRow();

	// Render list options
	$detailkirimbarang_preview->renderListOptions();
?>
	<tr <?php echo $detailkirimbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkirimbarang_preview->ListOptions->render("body", "left", $detailkirimbarang_preview->RowCount);
?>
<?php if ($detailkirimbarang_preview->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<!-- id_kirimbarang -->
		<td<?php echo $detailkirimbarang_preview->id_kirimbarang->cellAttributes() ?>>
<span<?php echo $detailkirimbarang_preview->id_kirimbarang->viewAttributes() ?>><?php echo $detailkirimbarang_preview->id_kirimbarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailkirimbarang_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailkirimbarang_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailkirimbarang_preview->id_barang->viewAttributes() ?>><?php echo $detailkirimbarang_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailkirimbarang_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailkirimbarang_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailkirimbarang_preview->id_satuan->viewAttributes() ?>><?php echo $detailkirimbarang_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailkirimbarang_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailkirimbarang_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailkirimbarang_preview->jumlah->viewAttributes() ?>><?php echo $detailkirimbarang_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailkirimbarang_preview->ListOptions->render("body", "right", $detailkirimbarang_preview->RowCount);
?>
	</tr>
<?php
	$detailkirimbarang_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailkirimbarang_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailkirimbarang_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailkirimbarang_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailkirimbarang_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailkirimbarang_preview->Recordset)
	$detailkirimbarang_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailkirimbarang_preview->terminate();
?>