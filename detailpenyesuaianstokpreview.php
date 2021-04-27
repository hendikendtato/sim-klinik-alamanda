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
$detailpenyesuaianstok_preview = new detailpenyesuaianstok_preview();

// Run the page
$detailpenyesuaianstok_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianstok_preview->Page_Render();
?>
<?php $detailpenyesuaianstok_preview->showPageHeader(); ?>
<?php if ($detailpenyesuaianstok_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailpenyesuaianstok"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailpenyesuaianstok_preview->renderListOptions();

// Render list options (header, left)
$detailpenyesuaianstok_preview->ListOptions->render("header", "left");
?>
<?php if ($detailpenyesuaianstok_preview->kode_barang->Visible) { // kode_barang ?>
	<?php if ($detailpenyesuaianstok->SortUrl($detailpenyesuaianstok_preview->kode_barang) == "") { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->kode_barang->headerCellClass() ?>"><?php echo $detailpenyesuaianstok_preview->kode_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->kode_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianstok_preview->kode_barang->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->kode_barang->Name && $detailpenyesuaianstok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_preview->kode_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->kode_barang->Name) { ?><?php if ($detailpenyesuaianstok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpenyesuaianstok->SortUrl($detailpenyesuaianstok_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->id_barang->headerCellClass() ?>"><?php echo $detailpenyesuaianstok_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianstok_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->id_barang->Name && $detailpenyesuaianstok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->id_barang->Name) { ?><?php if ($detailpenyesuaianstok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->stokdatabase->Visible) { // stokdatabase ?>
	<?php if ($detailpenyesuaianstok->SortUrl($detailpenyesuaianstok_preview->stokdatabase) == "") { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->stokdatabase->headerCellClass() ?>"><?php echo $detailpenyesuaianstok_preview->stokdatabase->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->stokdatabase->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianstok_preview->stokdatabase->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->stokdatabase->Name && $detailpenyesuaianstok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_preview->stokdatabase->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->stokdatabase->Name) { ?><?php if ($detailpenyesuaianstok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailpenyesuaianstok->SortUrl($detailpenyesuaianstok_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->jumlah->headerCellClass() ?>"><?php echo $detailpenyesuaianstok_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianstok_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->jumlah->Name && $detailpenyesuaianstok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->jumlah->Name) { ?><?php if ($detailpenyesuaianstok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->selisih->Visible) { // selisih ?>
	<?php if ($detailpenyesuaianstok->SortUrl($detailpenyesuaianstok_preview->selisih) == "") { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->selisih->headerCellClass() ?>"><?php echo $detailpenyesuaianstok_preview->selisih->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->selisih->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianstok_preview->selisih->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->selisih->Name && $detailpenyesuaianstok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_preview->selisih->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->selisih->Name) { ?><?php if ($detailpenyesuaianstok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->tipe->Visible) { // tipe ?>
	<?php if ($detailpenyesuaianstok->SortUrl($detailpenyesuaianstok_preview->tipe) == "") { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->tipe->headerCellClass() ?>"><?php echo $detailpenyesuaianstok_preview->tipe->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianstok_preview->tipe->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianstok_preview->tipe->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->tipe->Name && $detailpenyesuaianstok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianstok_preview->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianstok_preview->SortField == $detailpenyesuaianstok_preview->tipe->Name) { ?><?php if ($detailpenyesuaianstok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianstok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenyesuaianstok_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailpenyesuaianstok_preview->RecCount = 0;
$detailpenyesuaianstok_preview->RowCount = 0;
while ($detailpenyesuaianstok_preview->Recordset && !$detailpenyesuaianstok_preview->Recordset->EOF) {

	// Init row class and style
	$detailpenyesuaianstok_preview->RecCount++;
	$detailpenyesuaianstok_preview->RowCount++;
	$detailpenyesuaianstok_preview->CssStyle = "";
	$detailpenyesuaianstok_preview->loadListRowValues($detailpenyesuaianstok_preview->Recordset);

	// Render row
	$detailpenyesuaianstok->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailpenyesuaianstok_preview->resetAttributes();
	$detailpenyesuaianstok_preview->renderListRow();

	// Render list options
	$detailpenyesuaianstok_preview->renderListOptions();
?>
	<tr <?php echo $detailpenyesuaianstok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianstok_preview->ListOptions->render("body", "left", $detailpenyesuaianstok_preview->RowCount);
?>
<?php if ($detailpenyesuaianstok_preview->kode_barang->Visible) { // kode_barang ?>
		<!-- kode_barang -->
		<td<?php echo $detailpenyesuaianstok_preview->kode_barang->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianstok_preview->kode_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_preview->kode_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailpenyesuaianstok_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianstok_preview->id_barang->viewAttributes() ?>><?php echo $detailpenyesuaianstok_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->stokdatabase->Visible) { // stokdatabase ?>
		<!-- stokdatabase -->
		<td<?php echo $detailpenyesuaianstok_preview->stokdatabase->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianstok_preview->stokdatabase->viewAttributes() ?>><?php echo $detailpenyesuaianstok_preview->stokdatabase->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailpenyesuaianstok_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianstok_preview->jumlah->viewAttributes() ?>><?php echo $detailpenyesuaianstok_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->selisih->Visible) { // selisih ?>
		<!-- selisih -->
		<td<?php echo $detailpenyesuaianstok_preview->selisih->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianstok_preview->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianstok_preview->selisih->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianstok_preview->tipe->Visible) { // tipe ?>
		<!-- tipe -->
		<td<?php echo $detailpenyesuaianstok_preview->tipe->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianstok_preview->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianstok_preview->tipe->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianstok_preview->ListOptions->render("body", "right", $detailpenyesuaianstok_preview->RowCount);
?>
	</tr>
<?php
	$detailpenyesuaianstok_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailpenyesuaianstok_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailpenyesuaianstok_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailpenyesuaianstok_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailpenyesuaianstok_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailpenyesuaianstok_preview->Recordset)
	$detailpenyesuaianstok_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailpenyesuaianstok_preview->terminate();
?>