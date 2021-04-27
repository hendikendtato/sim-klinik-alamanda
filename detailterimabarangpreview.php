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
$detailterimabarang_preview = new detailterimabarang_preview();

// Run the page
$detailterimabarang_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimabarang_preview->Page_Render();
?>
<?php $detailterimabarang_preview->showPageHeader(); ?>
<?php if ($detailterimabarang_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailterimabarang"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailterimabarang_preview->renderListOptions();

// Render list options (header, left)
$detailterimabarang_preview->ListOptions->render("header", "left");
?>
<?php if ($detailterimabarang_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailterimabarang->SortUrl($detailterimabarang_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailterimabarang_preview->id_barang->headerCellClass() ?>"><?php echo $detailterimabarang_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailterimabarang_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailterimabarang_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailterimabarang_preview->SortField == $detailterimabarang_preview->id_barang->Name && $detailterimabarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_preview->SortField == $detailterimabarang_preview->id_barang->Name) { ?><?php if ($detailterimabarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimabarang_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailterimabarang->SortUrl($detailterimabarang_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailterimabarang_preview->jumlah->headerCellClass() ?>"><?php echo $detailterimabarang_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailterimabarang_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailterimabarang_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailterimabarang_preview->SortField == $detailterimabarang_preview->jumlah->Name && $detailterimabarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_preview->SortField == $detailterimabarang_preview->jumlah->Name) { ?><?php if ($detailterimabarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimabarang_preview->satuan->Visible) { // satuan ?>
	<?php if ($detailterimabarang->SortUrl($detailterimabarang_preview->satuan) == "") { ?>
		<th class="<?php echo $detailterimabarang_preview->satuan->headerCellClass() ?>"><?php echo $detailterimabarang_preview->satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailterimabarang_preview->satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailterimabarang_preview->satuan->Name) ?>" data-sort-order="<?php echo $detailterimabarang_preview->SortField == $detailterimabarang_preview->satuan->Name && $detailterimabarang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimabarang_preview->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimabarang_preview->SortField == $detailterimabarang_preview->satuan->Name) { ?><?php if ($detailterimabarang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimabarang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailterimabarang_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailterimabarang_preview->RecCount = 0;
$detailterimabarang_preview->RowCount = 0;
while ($detailterimabarang_preview->Recordset && !$detailterimabarang_preview->Recordset->EOF) {

	// Init row class and style
	$detailterimabarang_preview->RecCount++;
	$detailterimabarang_preview->RowCount++;
	$detailterimabarang_preview->CssStyle = "";
	$detailterimabarang_preview->loadListRowValues($detailterimabarang_preview->Recordset);

	// Render row
	$detailterimabarang->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailterimabarang_preview->resetAttributes();
	$detailterimabarang_preview->renderListRow();

	// Render list options
	$detailterimabarang_preview->renderListOptions();
?>
	<tr <?php echo $detailterimabarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimabarang_preview->ListOptions->render("body", "left", $detailterimabarang_preview->RowCount);
?>
<?php if ($detailterimabarang_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailterimabarang_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailterimabarang_preview->id_barang->viewAttributes() ?>><?php echo $detailterimabarang_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailterimabarang_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailterimabarang_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailterimabarang_preview->jumlah->viewAttributes() ?>><?php echo $detailterimabarang_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailterimabarang_preview->satuan->Visible) { // satuan ?>
		<!-- satuan -->
		<td<?php echo $detailterimabarang_preview->satuan->cellAttributes() ?>>
<span<?php echo $detailterimabarang_preview->satuan->viewAttributes() ?>><?php echo $detailterimabarang_preview->satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailterimabarang_preview->ListOptions->render("body", "right", $detailterimabarang_preview->RowCount);
?>
	</tr>
<?php
	$detailterimabarang_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailterimabarang_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailterimabarang_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailterimabarang_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailterimabarang_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailterimabarang_preview->Recordset)
	$detailterimabarang_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailterimabarang_preview->terminate();
?>