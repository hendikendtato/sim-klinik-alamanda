<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

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
$detailpenjualan_preview = new detailpenjualan_preview();

// Run the page
$detailpenjualan_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenjualan_preview->Page_Render();
?>
<?php $detailpenjualan_preview->showPageHeader(); ?>
<?php if ($detailpenjualan_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailpenjualan"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailpenjualan_preview->renderListOptions();

// Render list options (header, left)
$detailpenjualan_preview->ListOptions->render("header", "left");
?>
<?php if ($detailpenjualan_preview->id_penjualan->Visible) { // id_penjualan ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->id_penjualan) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->id_penjualan->headerCellClass() ?>"><?php echo $detailpenjualan_preview->id_penjualan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->id_penjualan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->id_penjualan->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->id_penjualan->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->id_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->id_penjualan->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->id_barang->headerCellClass() ?>"><?php echo $detailpenjualan_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->id_barang->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->id_barang->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->kode_barang->Visible) { // kode_barang ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->kode_barang) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->kode_barang->headerCellClass() ?>"><?php echo $detailpenjualan_preview->kode_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->kode_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->kode_barang->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->kode_barang->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->kode_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->kode_barang->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->nama_barang->Visible) { // nama_barang ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->nama_barang) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->nama_barang->headerCellClass() ?>"><?php echo $detailpenjualan_preview->nama_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->nama_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->nama_barang->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->nama_barang->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->nama_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->nama_barang->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->harga_jual->Visible) { // harga_jual ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->harga_jual) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->harga_jual->headerCellClass() ?>"><?php echo $detailpenjualan_preview->harga_jual->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->harga_jual->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->harga_jual->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->harga_jual->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->harga_jual->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->harga_jual->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->stok->Visible) { // stok ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->stok) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->stok->headerCellClass() ?>"><?php echo $detailpenjualan_preview->stok->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->stok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->stok->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->stok->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->stok->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->qty->Visible) { // qty ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->qty) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->qty->headerCellClass() ?>"><?php echo $detailpenjualan_preview->qty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->qty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->qty->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->qty->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->qty->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->disc_pr->Visible) { // disc_pr ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->disc_pr) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->disc_pr->headerCellClass() ?>"><?php echo $detailpenjualan_preview->disc_pr->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->disc_pr->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->disc_pr->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->disc_pr->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->disc_pr->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->disc_pr->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->disc_rp->Visible) { // disc_rp ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->disc_rp) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->disc_rp->headerCellClass() ?>"><?php echo $detailpenjualan_preview->disc_rp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->disc_rp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->disc_rp->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->disc_rp->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->disc_rp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->disc_rp->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->komisi_recall->Visible) { // komisi_recall ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->komisi_recall) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->komisi_recall->headerCellClass() ?>"><?php echo $detailpenjualan_preview->komisi_recall->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->komisi_recall->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->komisi_recall->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->komisi_recall->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->komisi_recall->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->komisi_recall->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenjualan_preview->subtotal->Visible) { // subtotal ?>
	<?php if ($detailpenjualan->SortUrl($detailpenjualan_preview->subtotal) == "") { ?>
		<th class="<?php echo $detailpenjualan_preview->subtotal->headerCellClass() ?>"><?php echo $detailpenjualan_preview->subtotal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenjualan_preview->subtotal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenjualan_preview->subtotal->Name) ?>" data-sort-order="<?php echo $detailpenjualan_preview->SortField == $detailpenjualan_preview->subtotal->Name && $detailpenjualan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenjualan_preview->subtotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenjualan_preview->SortField == $detailpenjualan_preview->subtotal->Name) { ?><?php if ($detailpenjualan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenjualan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenjualan_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailpenjualan_preview->RecCount = 0;
$detailpenjualan_preview->RowCount = 0;
while ($detailpenjualan_preview->Recordset && !$detailpenjualan_preview->Recordset->EOF) {

	// Init row class and style
	$detailpenjualan_preview->RecCount++;
	$detailpenjualan_preview->RowCount++;
	$detailpenjualan_preview->CssStyle = "";
	$detailpenjualan_preview->loadListRowValues($detailpenjualan_preview->Recordset);

	// Render row
	$detailpenjualan->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailpenjualan_preview->resetAttributes();
	$detailpenjualan_preview->renderListRow();

	// Render list options
	$detailpenjualan_preview->renderListOptions();
?>
	<tr <?php echo $detailpenjualan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenjualan_preview->ListOptions->render("body", "left", $detailpenjualan_preview->RowCount);
?>
<?php if ($detailpenjualan_preview->id_penjualan->Visible) { // id_penjualan ?>
		<!-- id_penjualan -->
		<td<?php echo $detailpenjualan_preview->id_penjualan->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->id_penjualan->viewAttributes() ?>><?php echo $detailpenjualan_preview->id_penjualan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailpenjualan_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->id_barang->viewAttributes() ?>><?php echo $detailpenjualan_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->kode_barang->Visible) { // kode_barang ?>
		<!-- kode_barang -->
		<td<?php echo $detailpenjualan_preview->kode_barang->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->kode_barang->viewAttributes() ?>><?php echo $detailpenjualan_preview->kode_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->nama_barang->Visible) { // nama_barang ?>
		<!-- nama_barang -->
		<td<?php echo $detailpenjualan_preview->nama_barang->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->nama_barang->viewAttributes() ?>><?php echo $detailpenjualan_preview->nama_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->harga_jual->Visible) { // harga_jual ?>
		<!-- harga_jual -->
		<td<?php echo $detailpenjualan_preview->harga_jual->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->harga_jual->viewAttributes() ?>><?php echo $detailpenjualan_preview->harga_jual->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->stok->Visible) { // stok ?>
		<!-- stok -->
		<td<?php echo $detailpenjualan_preview->stok->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->stok->viewAttributes() ?>><?php echo $detailpenjualan_preview->stok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->qty->Visible) { // qty ?>
		<!-- qty -->
		<td<?php echo $detailpenjualan_preview->qty->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->qty->viewAttributes() ?>><?php echo $detailpenjualan_preview->qty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->disc_pr->Visible) { // disc_pr ?>
		<!-- disc_pr -->
		<td<?php echo $detailpenjualan_preview->disc_pr->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->disc_pr->viewAttributes() ?>><?php echo $detailpenjualan_preview->disc_pr->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->disc_rp->Visible) { // disc_rp ?>
		<!-- disc_rp -->
		<td<?php echo $detailpenjualan_preview->disc_rp->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->disc_rp->viewAttributes() ?>><?php echo $detailpenjualan_preview->disc_rp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->komisi_recall->Visible) { // komisi_recall ?>
		<!-- komisi_recall -->
		<td<?php echo $detailpenjualan_preview->komisi_recall->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->komisi_recall->viewAttributes() ?>><?php echo $detailpenjualan_preview->komisi_recall->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenjualan_preview->subtotal->Visible) { // subtotal ?>
		<!-- subtotal -->
		<td<?php echo $detailpenjualan_preview->subtotal->cellAttributes() ?>>
<span<?php echo $detailpenjualan_preview->subtotal->viewAttributes() ?>><?php echo $detailpenjualan_preview->subtotal->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailpenjualan_preview->ListOptions->render("body", "right", $detailpenjualan_preview->RowCount);
?>
	</tr>
<?php
	$detailpenjualan_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailpenjualan_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailpenjualan_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailpenjualan_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailpenjualan_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailpenjualan_preview->Recordset)
	$detailpenjualan_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailpenjualan_preview->terminate();
?>