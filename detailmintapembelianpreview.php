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
$detailmintapembelian_preview = new detailmintapembelian_preview();

// Run the page
$detailmintapembelian_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmintapembelian_preview->Page_Render();
?>
<?php $detailmintapembelian_preview->showPageHeader(); ?>
<?php if ($detailmintapembelian_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailmintapembelian"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailmintapembelian_preview->renderListOptions();

// Render list options (header, left)
$detailmintapembelian_preview->ListOptions->render("header", "left");
?>
<?php if ($detailmintapembelian_preview->id_detailpp->Visible) { // id_detailpp ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->id_detailpp) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->id_detailpp->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->id_detailpp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->id_detailpp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->id_detailpp->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->id_detailpp->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->id_detailpp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->id_detailpp->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->pid_pp->Visible) { // pid_pp ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->pid_pp) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->pid_pp->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->pid_pp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->pid_pp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->pid_pp->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->pid_pp->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->pid_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->pid_pp->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->idbarang->Visible) { // idbarang ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->idbarang) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->idbarang->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->idbarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->idbarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->idbarang->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->idbarang->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->idbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->idbarang->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->part->Visible) { // part ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->part) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->part->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->part->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->part->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->part->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->part->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->part->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->part->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->lot->Visible) { // lot ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->lot) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->lot->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->lot->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->lot->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->lot->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->lot->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->lot->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->lot->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->qty_pp->Visible) { // qty_pp ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->qty_pp) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->qty_pp->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->qty_pp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->qty_pp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->qty_pp->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->qty_pp->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->qty_pp->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->qty_pp->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->qty_acc->Visible) { // qty_acc ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->qty_acc) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->qty_acc->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->qty_acc->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->qty_acc->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->qty_acc->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->qty_acc->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->qty_acc->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->qty_acc->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->id_satuan->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->id_satuan->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->id_satuan->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->harga->Visible) { // harga ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->harga) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->harga->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->harga->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->harga->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->harga->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->harga->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->harga->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->harga->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmintapembelian_preview->total->Visible) { // total ?>
	<?php if ($detailmintapembelian->SortUrl($detailmintapembelian_preview->total) == "") { ?>
		<th class="<?php echo $detailmintapembelian_preview->total->headerCellClass() ?>"><?php echo $detailmintapembelian_preview->total->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmintapembelian_preview->total->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmintapembelian_preview->total->Name) ?>" data-sort-order="<?php echo $detailmintapembelian_preview->SortField == $detailmintapembelian_preview->total->Name && $detailmintapembelian_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmintapembelian_preview->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmintapembelian_preview->SortField == $detailmintapembelian_preview->total->Name) { ?><?php if ($detailmintapembelian_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmintapembelian_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailmintapembelian_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailmintapembelian_preview->RecCount = 0;
$detailmintapembelian_preview->RowCount = 0;
while ($detailmintapembelian_preview->Recordset && !$detailmintapembelian_preview->Recordset->EOF) {

	// Init row class and style
	$detailmintapembelian_preview->RecCount++;
	$detailmintapembelian_preview->RowCount++;
	$detailmintapembelian_preview->CssStyle = "";
	$detailmintapembelian_preview->loadListRowValues($detailmintapembelian_preview->Recordset);

	// Render row
	$detailmintapembelian->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailmintapembelian_preview->resetAttributes();
	$detailmintapembelian_preview->renderListRow();

	// Render list options
	$detailmintapembelian_preview->renderListOptions();
?>
	<tr <?php echo $detailmintapembelian->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmintapembelian_preview->ListOptions->render("body", "left", $detailmintapembelian_preview->RowCount);
?>
<?php if ($detailmintapembelian_preview->id_detailpp->Visible) { // id_detailpp ?>
		<!-- id_detailpp -->
		<td<?php echo $detailmintapembelian_preview->id_detailpp->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->id_detailpp->viewAttributes() ?>><?php echo $detailmintapembelian_preview->id_detailpp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->pid_pp->Visible) { // pid_pp ?>
		<!-- pid_pp -->
		<td<?php echo $detailmintapembelian_preview->pid_pp->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->pid_pp->viewAttributes() ?>><?php echo $detailmintapembelian_preview->pid_pp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->idbarang->Visible) { // idbarang ?>
		<!-- idbarang -->
		<td<?php echo $detailmintapembelian_preview->idbarang->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->idbarang->viewAttributes() ?>><?php echo $detailmintapembelian_preview->idbarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->part->Visible) { // part ?>
		<!-- part -->
		<td<?php echo $detailmintapembelian_preview->part->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->part->viewAttributes() ?>><?php echo $detailmintapembelian_preview->part->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->lot->Visible) { // lot ?>
		<!-- lot -->
		<td<?php echo $detailmintapembelian_preview->lot->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->lot->viewAttributes() ?>><?php echo $detailmintapembelian_preview->lot->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->qty_pp->Visible) { // qty_pp ?>
		<!-- qty_pp -->
		<td<?php echo $detailmintapembelian_preview->qty_pp->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->qty_pp->viewAttributes() ?>><?php echo $detailmintapembelian_preview->qty_pp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->qty_acc->Visible) { // qty_acc ?>
		<!-- qty_acc -->
		<td<?php echo $detailmintapembelian_preview->qty_acc->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->qty_acc->viewAttributes() ?>><?php echo $detailmintapembelian_preview->qty_acc->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailmintapembelian_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->id_satuan->viewAttributes() ?>><?php echo $detailmintapembelian_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->harga->Visible) { // harga ?>
		<!-- harga -->
		<td<?php echo $detailmintapembelian_preview->harga->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->harga->viewAttributes() ?>><?php echo $detailmintapembelian_preview->harga->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmintapembelian_preview->total->Visible) { // total ?>
		<!-- total -->
		<td<?php echo $detailmintapembelian_preview->total->cellAttributes() ?>>
<span<?php echo $detailmintapembelian_preview->total->viewAttributes() ?>><?php echo $detailmintapembelian_preview->total->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailmintapembelian_preview->ListOptions->render("body", "right", $detailmintapembelian_preview->RowCount);
?>
	</tr>
<?php
	$detailmintapembelian_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailmintapembelian_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailmintapembelian_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailmintapembelian_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailmintapembelian_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailmintapembelian_preview->Recordset)
	$detailmintapembelian_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailmintapembelian_preview->terminate();
?>