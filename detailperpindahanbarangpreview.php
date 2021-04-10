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
$detailperpindahanbarang_preview = new detailperpindahanbarang_preview();

// Run the page
$detailperpindahanbarang_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailperpindahanbarang_preview->Page_Render();
?>
<?php $detailperpindahanbarang_preview->showPageHeader(); ?>
<?php if ($detailperpindahanbarang_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailperpindahanbarang"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailperpindahanbarang_preview->renderListOptions();

// Render list options (header, left)
$detailperpindahanbarang_preview->ListOptions->render("header", "left");
?>
<?php if ($detailperpindahanbarang_preview->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
	<?php if ($detailperpindahanbarang->SortUrl($detailperpindahanbarang_preview->id_detailperpindahanbarang) == "") { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->headerCellClass() ?>"><?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailperpindahanbarang_preview->id_detailperpindahanbarang->Name) ?>" data-sort-order="<?php echo $detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_detailperpindahanbarang->Name && $detailperpindahanbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_detailperpindahanbarang->Name) { ?><?php if ($detailperpindahanbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
	<?php if ($detailperpindahanbarang->SortUrl($detailperpindahanbarang_preview->id_perpindahanbarang) == "") { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->headerCellClass() ?>"><?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailperpindahanbarang_preview->id_perpindahanbarang->Name) ?>" data-sort-order="<?php echo $detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_perpindahanbarang->Name && $detailperpindahanbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_perpindahanbarang->Name) { ?><?php if ($detailperpindahanbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailperpindahanbarang->SortUrl($detailperpindahanbarang_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_barang->headerCellClass() ?>"><?php echo $detailperpindahanbarang_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailperpindahanbarang_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_barang->Name && $detailperpindahanbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_barang->Name) { ?><?php if ($detailperpindahanbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailperpindahanbarang->SortUrl($detailperpindahanbarang_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->jumlah->headerCellClass() ?>"><?php echo $detailperpindahanbarang_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailperpindahanbarang_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->jumlah->Name && $detailperpindahanbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->jumlah->Name) { ?><?php if ($detailperpindahanbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailperpindahanbarang->SortUrl($detailperpindahanbarang_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_satuan->headerCellClass() ?>"><?php echo $detailperpindahanbarang_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailperpindahanbarang_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailperpindahanbarang_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_satuan->Name && $detailperpindahanbarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailperpindahanbarang_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailperpindahanbarang_preview->SortField == $detailperpindahanbarang_preview->id_satuan->Name) { ?><?php if ($detailperpindahanbarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailperpindahanbarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailperpindahanbarang_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailperpindahanbarang_preview->RecCount = 0;
$detailperpindahanbarang_preview->RowCount = 0;
while ($detailperpindahanbarang_preview->Recordset && !$detailperpindahanbarang_preview->Recordset->EOF) {

	// Init row class and style
	$detailperpindahanbarang_preview->RecCount++;
	$detailperpindahanbarang_preview->RowCount++;
	$detailperpindahanbarang_preview->CssStyle = "";
	$detailperpindahanbarang_preview->loadListRowValues($detailperpindahanbarang_preview->Recordset);

	// Render row
	$detailperpindahanbarang->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailperpindahanbarang_preview->resetAttributes();
	$detailperpindahanbarang_preview->renderListRow();

	// Render list options
	$detailperpindahanbarang_preview->renderListOptions();
?>
	<tr <?php echo $detailperpindahanbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailperpindahanbarang_preview->ListOptions->render("body", "left", $detailperpindahanbarang_preview->RowCount);
?>
<?php if ($detailperpindahanbarang_preview->id_detailperpindahanbarang->Visible) { // id_detailperpindahanbarang ?>
		<!-- id_detailperpindahanbarang -->
		<td<?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->cellAttributes() ?>>
<span<?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_preview->id_detailperpindahanbarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->id_perpindahanbarang->Visible) { // id_perpindahanbarang ?>
		<!-- id_perpindahanbarang -->
		<td<?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->cellAttributes() ?>>
<span<?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->viewAttributes() ?>><?php echo $detailperpindahanbarang_preview->id_perpindahanbarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailperpindahanbarang_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailperpindahanbarang_preview->id_barang->viewAttributes() ?>><?php echo $detailperpindahanbarang_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailperpindahanbarang_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailperpindahanbarang_preview->jumlah->viewAttributes() ?>><?php echo $detailperpindahanbarang_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailperpindahanbarang_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailperpindahanbarang_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailperpindahanbarang_preview->id_satuan->viewAttributes() ?>><?php echo $detailperpindahanbarang_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailperpindahanbarang_preview->ListOptions->render("body", "right", $detailperpindahanbarang_preview->RowCount);
?>
	</tr>
<?php
	$detailperpindahanbarang_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailperpindahanbarang_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailperpindahanbarang_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailperpindahanbarang_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailperpindahanbarang_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailperpindahanbarang_preview->Recordset)
	$detailperpindahanbarang_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailperpindahanbarang_preview->terminate();
?>