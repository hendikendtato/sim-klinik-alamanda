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
$detailpromo_preview = new detailpromo_preview();

// Run the page
$detailpromo_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpromo_preview->Page_Render();
?>
<?php $detailpromo_preview->showPageHeader(); ?>
<?php if ($detailpromo_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailpromo"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailpromo_preview->renderListOptions();

// Render list options (header, left)
$detailpromo_preview->ListOptions->render("header", "left");
?>
<?php if ($detailpromo_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpromo->SortUrl($detailpromo_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailpromo_preview->id_barang->headerCellClass() ?>"><?php echo $detailpromo_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpromo_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpromo_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailpromo_preview->SortField == $detailpromo_preview->id_barang->Name && $detailpromo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_preview->SortField == $detailpromo_preview->id_barang->Name) { ?><?php if ($detailpromo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpromo_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailpromo->SortUrl($detailpromo_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailpromo_preview->jumlah->headerCellClass() ?>"><?php echo $detailpromo_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpromo_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpromo_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailpromo_preview->SortField == $detailpromo_preview->jumlah->Name && $detailpromo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_preview->SortField == $detailpromo_preview->jumlah->Name) { ?><?php if ($detailpromo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpromo_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailpromo->SortUrl($detailpromo_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailpromo_preview->id_satuan->headerCellClass() ?>"><?php echo $detailpromo_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpromo_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpromo_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailpromo_preview->SortField == $detailpromo_preview->id_satuan->Name && $detailpromo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpromo_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpromo_preview->SortField == $detailpromo_preview->id_satuan->Name) { ?><?php if ($detailpromo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpromo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpromo_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailpromo_preview->RecCount = 0;
$detailpromo_preview->RowCount = 0;
while ($detailpromo_preview->Recordset && !$detailpromo_preview->Recordset->EOF) {

	// Init row class and style
	$detailpromo_preview->RecCount++;
	$detailpromo_preview->RowCount++;
	$detailpromo_preview->CssStyle = "";
	$detailpromo_preview->loadListRowValues($detailpromo_preview->Recordset);

	// Render row
	$detailpromo->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailpromo_preview->resetAttributes();
	$detailpromo_preview->renderListRow();

	// Render list options
	$detailpromo_preview->renderListOptions();
?>
	<tr <?php echo $detailpromo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpromo_preview->ListOptions->render("body", "left", $detailpromo_preview->RowCount);
?>
<?php if ($detailpromo_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailpromo_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailpromo_preview->id_barang->viewAttributes() ?>><?php echo $detailpromo_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpromo_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailpromo_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailpromo_preview->jumlah->viewAttributes() ?>><?php echo $detailpromo_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpromo_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailpromo_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailpromo_preview->id_satuan->viewAttributes() ?>><?php echo $detailpromo_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailpromo_preview->ListOptions->render("body", "right", $detailpromo_preview->RowCount);
?>
	</tr>
<?php
	$detailpromo_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailpromo_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailpromo_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailpromo_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailpromo_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailpromo_preview->Recordset)
	$detailpromo_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailpromo_preview->terminate();
?>