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
$detailkomposisi_preview = new detailkomposisi_preview();

// Run the page
$detailkomposisi_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailkomposisi_preview->Page_Render();
?>
<?php $detailkomposisi_preview->showPageHeader(); ?>
<?php if ($detailkomposisi_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailkomposisi"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailkomposisi_preview->renderListOptions();

// Render list options (header, left)
$detailkomposisi_preview->ListOptions->render("header", "left");
?>
<?php if ($detailkomposisi_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailkomposisi->SortUrl($detailkomposisi_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailkomposisi_preview->id_barang->headerCellClass() ?>"><?php echo $detailkomposisi_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkomposisi_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkomposisi_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailkomposisi_preview->SortField == $detailkomposisi_preview->id_barang->Name && $detailkomposisi_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_preview->SortField == $detailkomposisi_preview->id_barang->Name) { ?><?php if ($detailkomposisi_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkomposisi_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailkomposisi->SortUrl($detailkomposisi_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailkomposisi_preview->jumlah->headerCellClass() ?>"><?php echo $detailkomposisi_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkomposisi_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkomposisi_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailkomposisi_preview->SortField == $detailkomposisi_preview->jumlah->Name && $detailkomposisi_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_preview->SortField == $detailkomposisi_preview->jumlah->Name) { ?><?php if ($detailkomposisi_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailkomposisi_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailkomposisi->SortUrl($detailkomposisi_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailkomposisi_preview->id_satuan->headerCellClass() ?>"><?php echo $detailkomposisi_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailkomposisi_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailkomposisi_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailkomposisi_preview->SortField == $detailkomposisi_preview->id_satuan->Name && $detailkomposisi_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailkomposisi_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailkomposisi_preview->SortField == $detailkomposisi_preview->id_satuan->Name) { ?><?php if ($detailkomposisi_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailkomposisi_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailkomposisi_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailkomposisi_preview->RecCount = 0;
$detailkomposisi_preview->RowCount = 0;
while ($detailkomposisi_preview->Recordset && !$detailkomposisi_preview->Recordset->EOF) {

	// Init row class and style
	$detailkomposisi_preview->RecCount++;
	$detailkomposisi_preview->RowCount++;
	$detailkomposisi_preview->CssStyle = "";
	$detailkomposisi_preview->loadListRowValues($detailkomposisi_preview->Recordset);

	// Render row
	$detailkomposisi->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailkomposisi_preview->resetAttributes();
	$detailkomposisi_preview->renderListRow();

	// Render list options
	$detailkomposisi_preview->renderListOptions();
?>
	<tr <?php echo $detailkomposisi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailkomposisi_preview->ListOptions->render("body", "left", $detailkomposisi_preview->RowCount);
?>
<?php if ($detailkomposisi_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailkomposisi_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailkomposisi_preview->id_barang->viewAttributes() ?>><?php echo $detailkomposisi_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailkomposisi_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailkomposisi_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailkomposisi_preview->jumlah->viewAttributes() ?>><?php echo $detailkomposisi_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailkomposisi_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailkomposisi_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailkomposisi_preview->id_satuan->viewAttributes() ?>><?php echo $detailkomposisi_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailkomposisi_preview->ListOptions->render("body", "right", $detailkomposisi_preview->RowCount);
?>
	</tr>
<?php
	$detailkomposisi_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailkomposisi_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailkomposisi_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailkomposisi_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailkomposisi_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailkomposisi_preview->Recordset)
	$detailkomposisi_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailkomposisi_preview->terminate();
?>