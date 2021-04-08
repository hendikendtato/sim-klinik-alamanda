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
$detailterimagudang_preview = new detailterimagudang_preview();

// Run the page
$detailterimagudang_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailterimagudang_preview->Page_Render();
?>
<?php $detailterimagudang_preview->showPageHeader(); ?>
<?php if ($detailterimagudang_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailterimagudang"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailterimagudang_preview->renderListOptions();

// Render list options (header, left)
$detailterimagudang_preview->ListOptions->render("header", "left");
?>
<?php if ($detailterimagudang_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($detailterimagudang->SortUrl($detailterimagudang_preview->id_barang) == "") { ?>
		<th class="<?php echo $detailterimagudang_preview->id_barang->headerCellClass() ?>"><?php echo $detailterimagudang_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailterimagudang_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailterimagudang_preview->id_barang->Name) ?>" data-sort-order="<?php echo $detailterimagudang_preview->SortField == $detailterimagudang_preview->id_barang->Name && $detailterimagudang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_preview->SortField == $detailterimagudang_preview->id_barang->Name) { ?><?php if ($detailterimagudang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimagudang_preview->qty->Visible) { // qty ?>
	<?php if ($detailterimagudang->SortUrl($detailterimagudang_preview->qty) == "") { ?>
		<th class="<?php echo $detailterimagudang_preview->qty->headerCellClass() ?>"><?php echo $detailterimagudang_preview->qty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailterimagudang_preview->qty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailterimagudang_preview->qty->Name) ?>" data-sort-order="<?php echo $detailterimagudang_preview->SortField == $detailterimagudang_preview->qty->Name && $detailterimagudang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_preview->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_preview->SortField == $detailterimagudang_preview->qty->Name) { ?><?php if ($detailterimagudang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailterimagudang_preview->id_satuan->Visible) { // id_satuan ?>
	<?php if ($detailterimagudang->SortUrl($detailterimagudang_preview->id_satuan) == "") { ?>
		<th class="<?php echo $detailterimagudang_preview->id_satuan->headerCellClass() ?>"><?php echo $detailterimagudang_preview->id_satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailterimagudang_preview->id_satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailterimagudang_preview->id_satuan->Name) ?>" data-sort-order="<?php echo $detailterimagudang_preview->SortField == $detailterimagudang_preview->id_satuan->Name && $detailterimagudang_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailterimagudang_preview->id_satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailterimagudang_preview->SortField == $detailterimagudang_preview->id_satuan->Name) { ?><?php if ($detailterimagudang_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailterimagudang_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailterimagudang_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailterimagudang_preview->RecCount = 0;
$detailterimagudang_preview->RowCount = 0;
while ($detailterimagudang_preview->Recordset && !$detailterimagudang_preview->Recordset->EOF) {

	// Init row class and style
	$detailterimagudang_preview->RecCount++;
	$detailterimagudang_preview->RowCount++;
	$detailterimagudang_preview->CssStyle = "";
	$detailterimagudang_preview->loadListRowValues($detailterimagudang_preview->Recordset);

	// Render row
	$detailterimagudang->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailterimagudang_preview->resetAttributes();
	$detailterimagudang_preview->renderListRow();

	// Render list options
	$detailterimagudang_preview->renderListOptions();
?>
	<tr <?php echo $detailterimagudang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailterimagudang_preview->ListOptions->render("body", "left", $detailterimagudang_preview->RowCount);
?>
<?php if ($detailterimagudang_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $detailterimagudang_preview->id_barang->cellAttributes() ?>>
<span<?php echo $detailterimagudang_preview->id_barang->viewAttributes() ?>><?php echo $detailterimagudang_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailterimagudang_preview->qty->Visible) { // qty ?>
		<!-- qty -->
		<td<?php echo $detailterimagudang_preview->qty->cellAttributes() ?>>
<span<?php echo $detailterimagudang_preview->qty->viewAttributes() ?>><?php echo $detailterimagudang_preview->qty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailterimagudang_preview->id_satuan->Visible) { // id_satuan ?>
		<!-- id_satuan -->
		<td<?php echo $detailterimagudang_preview->id_satuan->cellAttributes() ?>>
<span<?php echo $detailterimagudang_preview->id_satuan->viewAttributes() ?>><?php echo $detailterimagudang_preview->id_satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailterimagudang_preview->ListOptions->render("body", "right", $detailterimagudang_preview->RowCount);
?>
	</tr>
<?php
	$detailterimagudang_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailterimagudang_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailterimagudang_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailterimagudang_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailterimagudang_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailterimagudang_preview->Recordset)
	$detailterimagudang_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailterimagudang_preview->terminate();
?>