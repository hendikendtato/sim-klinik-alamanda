<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

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
$detailrekmeddok_preview = new detailrekmeddok_preview();

// Run the page
$detailrekmeddok_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailrekmeddok_preview->Page_Render();
?>
<?php $detailrekmeddok_preview->showPageHeader(); ?>
<?php if ($detailrekmeddok_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailrekmeddok"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailrekmeddok_preview->renderListOptions();

// Render list options (header, left)
$detailrekmeddok_preview->ListOptions->render("header", "left");
?>
<?php if ($detailrekmeddok_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailrekmeddok->SortUrl($detailrekmeddok_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailrekmeddok_preview->id_barang->headerCellClass() ?>"><?php echo $detailrekmeddok_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmeddok_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmeddok_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailrekmeddok_preview->SortField == $detailrekmeddok_preview->id_barang->Name && $detailrekmeddok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_preview->SortField == $detailrekmeddok_preview->id_barang->Name) { ?><?php if ($detailrekmeddok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmeddok_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailrekmeddok->SortUrl($detailrekmeddok_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailrekmeddok_preview->jumlah->headerCellClass() ?>"><?php echo $detailrekmeddok_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmeddok_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmeddok_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailrekmeddok_preview->SortField == $detailrekmeddok_preview->jumlah->Name && $detailrekmeddok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_preview->SortField == $detailrekmeddok_preview->jumlah->Name) { ?><?php if ($detailrekmeddok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailrekmeddok_preview->satuan->Visible) { // satuan ?>
	<?php if ($detailrekmeddok->SortUrl($detailrekmeddok_preview->satuan) == "") { ?>
		<th class="<?php echo $detailrekmeddok_preview->satuan->headerCellClass() ?>"><?php echo $detailrekmeddok_preview->satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailrekmeddok_preview->satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailrekmeddok_preview->satuan->Name) ?>" data-sort-order="<?php echo $detailrekmeddok_preview->SortField == $detailrekmeddok_preview->satuan->Name && $detailrekmeddok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailrekmeddok_preview->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailrekmeddok_preview->SortField == $detailrekmeddok_preview->satuan->Name) { ?><?php if ($detailrekmeddok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailrekmeddok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailrekmeddok_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailrekmeddok_preview->RecCount = 0;
$detailrekmeddok_preview->RowCount = 0;
while ($detailrekmeddok_preview->Recordset && !$detailrekmeddok_preview->Recordset->EOF) {

	// Init row class and style
	$detailrekmeddok_preview->RecCount++;
	$detailrekmeddok_preview->RowCount++;
	$detailrekmeddok_preview->CssStyle = "";
	$detailrekmeddok_preview->loadListRowValues($detailrekmeddok_preview->Recordset);

	// Render row
	$detailrekmeddok->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailrekmeddok_preview->resetAttributes();
	$detailrekmeddok_preview->renderListRow();

	// Render list options
	$detailrekmeddok_preview->renderListOptions();
?>
	<tr <?php echo $detailrekmeddok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailrekmeddok_preview->ListOptions->render("body", "left", $detailrekmeddok_preview->RowCount);
?>
<?php if ($detailrekmeddok_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailrekmeddok_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailrekmeddok_preview->id_barang->viewAttributes() ?>><?php echo $detailrekmeddok_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailrekmeddok_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailrekmeddok_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailrekmeddok_preview->jumlah->viewAttributes() ?>><?php echo $detailrekmeddok_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailrekmeddok_preview->satuan->Visible) { // satuan ?>
		<!-- satuan -->
		<td<?php echo $detailrekmeddok_preview->satuan->cellAttributes() ?>>
<span<?php echo $detailrekmeddok_preview->satuan->viewAttributes() ?>><?php echo $detailrekmeddok_preview->satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailrekmeddok_preview->ListOptions->render("body", "right", $detailrekmeddok_preview->RowCount);
?>
	</tr>
<?php
	$detailrekmeddok_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailrekmeddok_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailrekmeddok_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailrekmeddok_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailrekmeddok_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailrekmeddok_preview->Recordset)
	$detailrekmeddok_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailrekmeddok_preview->terminate();
?>