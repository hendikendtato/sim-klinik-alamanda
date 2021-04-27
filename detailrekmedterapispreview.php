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
WriteHeader(FALSE, "utf-8");

// Create page object
$detailrekmedterapis_preview = new detailrekmedterapis_preview();

// Run the page
$detailrekmedterapis_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmedterapis_preview->Page_Render();
?>
<?php $detailrekmedterapis_preview->showPageHeader(); ?>
<?php if ($detailrekmedterapis_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailrekmedterapis"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailrekmedterapis_preview->renderListOptions();

// Render list options (header, left)
$detailrekmedterapis_preview->ListOptions->render("header", "left");
?>
<?php if ($detailrekmedterapis_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmedterapis->SortUrl($detailrekmedterapis_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailrekmedterapis_preview->id_barang->headerCellClass() ?>"><?php echo $detailrekmedterapis_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmedterapis_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmedterapis_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailrekmedterapis_preview->SortField == $detailrekmedterapis_preview->id_barang->Name && $detailrekmedterapis_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_preview->SortField == $detailrekmedterapis_preview->id_barang->Name) { ?><?php if ($detailrekmedterapis_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedterapis_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmedterapis->SortUrl($detailrekmedterapis_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailrekmedterapis_preview->jumlah->headerCellClass() ?>"><?php echo $detailrekmedterapis_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmedterapis_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmedterapis_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailrekmedterapis_preview->SortField == $detailrekmedterapis_preview->jumlah->Name && $detailrekmedterapis_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_preview->SortField == $detailrekmedterapis_preview->jumlah->Name) { ?><?php if ($detailrekmedterapis_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmedterapis_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailrekmedterapis->SortUrl($detailrekmedterapis_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailrekmedterapis_preview->id_satuan->headerCellClass() ?>"><?php echo $detailrekmedterapis_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmedterapis_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmedterapis_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailrekmedterapis_preview->SortField == $detailrekmedterapis_preview->id_satuan->Name && $detailrekmedterapis_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmedterapis_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmedterapis_preview->SortField == $detailrekmedterapis_preview->id_satuan->Name) { ?><?php if ($detailrekmedterapis_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmedterapis_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmedterapis_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailrekmedterapis_preview->RecCount = 0;
$detailrekmedterapis_preview->RowCount = 0;
while ($detailrekmedterapis_preview->Recordset && !$detailrekmedterapis_preview->Recordset->EOF) {

	// Init row class and style
	$detailrekmedterapis_preview->RecCount++;
	$detailrekmedterapis_preview->RowCount++;
	$detailrekmedterapis_preview->CssStyle = "";
	$detailrekmedterapis_preview->loadListRowValues($detailrekmedterapis_preview->Recordset);

	// Render row
	$detailrekmedterapis->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailrekmedterapis_preview->resetAttributes();
	$detailrekmedterapis_preview->renderListRow();

	// Render list options
	$detailrekmedterapis_preview->renderListOptions();
?>
	<tr <?php echo $detailrekmedterapis->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmedterapis_preview->ListOptions->render("body", "left", $detailrekmedterapis_preview->RowCount);
?>
<?php if ($detailrekmedterapis_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailrekmedterapis_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailrekmedterapis_preview->id_barang->viewAttributes() ?>><?php echo $detailrekmedterapis_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailrekmedterapis_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailrekmedterapis_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailrekmedterapis_preview->jumlah->viewAttributes() ?>><?php echo $detailrekmedterapis_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailrekmedterapis_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailrekmedterapis_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailrekmedterapis_preview->id_satuan->viewAttributes() ?>><?php echo $detailrekmedterapis_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailrekmedterapis_preview->ListOptions->render("body", "right", $detailrekmedterapis_preview->RowCount);
?>
	</tr>
<?php
	$detailrekmedterapis_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailrekmedterapis_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailrekmedterapis_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailrekmedterapis_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailrekmedterapis_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailrekmedterapis_preview->Recordset)
	$detailrekmedterapis_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailrekmedterapis_preview->terminate();
?>