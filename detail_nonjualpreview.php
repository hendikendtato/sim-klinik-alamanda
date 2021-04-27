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
$detail_nonjual_preview = new detail_nonjual_preview();

// Run the page
$detail_nonjual_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detail_nonjual_preview->Page_Render();
?>
<?php $detail_nonjual_preview->showPageHeader(); ?>
<?php if ($detail_nonjual_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detail_nonjual"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detail_nonjual_preview->renderListOptions();

// Render list options (header, left)
$detail_nonjual_preview->ListOptions->render("header", "left");
?>
<?php if ($detail_nonjual_preview->id_nonjual->Visible) { // id_nonjual ?>
	<?php if ($detail_nonjual->SortUrl($detail_nonjual_preview->id_nonjual) == "") { ?>
		<th class="<?php echo $detail_nonjual_preview->id_nonjual->headerCellClass() ?>"><?php echo $detail_nonjual_preview->id_nonjual->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detail_nonjual_preview->id_nonjual->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detail_nonjual_preview->id_nonjual->Name) ?>" data-sort-order="<?php echo $detail_nonjual_preview->SortField == $detail_nonjual_preview->id_nonjual->Name && $detail_nonjual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_preview->id_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_preview->SortField == $detail_nonjual_preview->id_nonjual->Name) { ?><?php if ($detail_nonjual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detail_nonjual->SortUrl($detail_nonjual_preview->id_barang) == "") { ?>
		<th class="<?php echo $detail_nonjual_preview->id_barang->headerCellClass() ?>"><?php echo $detail_nonjual_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detail_nonjual_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detail_nonjual_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detail_nonjual_preview->SortField == $detail_nonjual_preview->id_barang->Name && $detail_nonjual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_preview->SortField == $detail_nonjual_preview->id_barang->Name) { ?><?php if ($detail_nonjual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_preview->stok->Visible) { // stok ?>
	<?php if ($detail_nonjual->SortUrl($detail_nonjual_preview->stok) == "") { ?>
		<th class="<?php echo $detail_nonjual_preview->stok->headerCellClass() ?>"><?php echo $detail_nonjual_preview->stok->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detail_nonjual_preview->stok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detail_nonjual_preview->stok->Name) ?>" data-sort-order="<?php echo $detail_nonjual_preview->SortField == $detail_nonjual_preview->stok->Name && $detail_nonjual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_preview->stok->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_preview->SortField == $detail_nonjual_preview->stok->Name) { ?><?php if ($detail_nonjual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detail_nonjual_preview->qty->Visible) { // qty ?>
	<?php if ($detail_nonjual->SortUrl($detail_nonjual_preview->qty) == "") { ?>
		<th class="<?php echo $detail_nonjual_preview->qty->headerCellClass() ?>"><?php echo $detail_nonjual_preview->qty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detail_nonjual_preview->qty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detail_nonjual_preview->qty->Name) ?>" data-sort-order="<?php echo $detail_nonjual_preview->SortField == $detail_nonjual_preview->qty->Name && $detail_nonjual_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detail_nonjual_preview->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detail_nonjual_preview->SortField == $detail_nonjual_preview->qty->Name) { ?><?php if ($detail_nonjual_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detail_nonjual_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detail_nonjual_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detail_nonjual_preview->RecCount = 0;
$detail_nonjual_preview->RowCount = 0;
while ($detail_nonjual_preview->Recordset && !$detail_nonjual_preview->Recordset->EOF) {

	// Init row class and style
	$detail_nonjual_preview->RecCount++;
	$detail_nonjual_preview->RowCount++;
	$detail_nonjual_preview->CssStyle = "";
	$detail_nonjual_preview->loadListRowValues($detail_nonjual_preview->Recordset);

	// Render row
	$detail_nonjual->RowType = ROWTYPE_PREVIEW; // Preview record
	$detail_nonjual_preview->resetAttributes();
	$detail_nonjual_preview->renderListRow();

	// Render list options
	$detail_nonjual_preview->renderListOptions();
?>
	<tr <?php echo $detail_nonjual->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detail_nonjual_preview->ListOptions->render("body", "left", $detail_nonjual_preview->RowCount);
?>
<?php if ($detail_nonjual_preview->id_nonjual->Visible) { // id_nonjual ?>
		<!-- id_nonjual -->
		<td<?php echo $detail_nonjual_preview->id_nonjual->cellAttributes() ?>>
<span<?php echo $detail_nonjual_preview->id_nonjual->viewAttributes() ?>><?php echo $detail_nonjual_preview->id_nonjual->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detail_nonjual_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detail_nonjual_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detail_nonjual_preview->id_barang->viewAttributes() ?>><?php echo $detail_nonjual_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detail_nonjual_preview->stok->Visible) { // stok ?>
		<!-- stok -->
		<td<?php echo $detail_nonjual_preview->stok->cellAttributes() ?>>
<span<?php echo $detail_nonjual_preview->stok->viewAttributes() ?>><?php echo $detail_nonjual_preview->stok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detail_nonjual_preview->qty->Visible) { // qty ?>
		<!-- qty -->
		<td<?php echo $detail_nonjual_preview->qty->cellAttributes() ?>>
<span<?php echo $detail_nonjual_preview->qty->viewAttributes() ?>><?php echo $detail_nonjual_preview->qty->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detail_nonjual_preview->ListOptions->render("body", "right", $detail_nonjual_preview->RowCount);
?>
	</tr>
<?php
	$detail_nonjual_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detail_nonjual_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detail_nonjual_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detail_nonjual_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detail_nonjual_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detail_nonjual_preview->Recordset)
	$detail_nonjual_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detail_nonjual_preview->terminate();
?>