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
$detailmutasibank_preview = new detailmutasibank_preview();

// Run the page
$detailmutasibank_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailmutasibank_preview->Page_Render();
?>
<?php $detailmutasibank_preview->showPageHeader(); ?>
<?php if ($detailmutasibank_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailmutasibank"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailmutasibank_preview->renderListOptions();

// Render list options (header, left)
$detailmutasibank_preview->ListOptions->render("header", "left");
?>
<?php if ($detailmutasibank_preview->akun_id->Visible) { // akun_id ?>
	<?php if ($detailmutasibank->SortUrl($detailmutasibank_preview->akun_id) == "") { ?>
		<th class="<?php echo $detailmutasibank_preview->akun_id->headerCellClass() ?>"><?php echo $detailmutasibank_preview->akun_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmutasibank_preview->akun_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmutasibank_preview->akun_id->Name) ?>" data-sort-order="<?php echo $detailmutasibank_preview->SortField == $detailmutasibank_preview->akun_id->Name && $detailmutasibank_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_preview->akun_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_preview->SortField == $detailmutasibank_preview->akun_id->Name) { ?><?php if ($detailmutasibank_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_preview->nama_akun->Visible) { // nama_akun ?>
	<?php if ($detailmutasibank->SortUrl($detailmutasibank_preview->nama_akun) == "") { ?>
		<th class="<?php echo $detailmutasibank_preview->nama_akun->headerCellClass() ?>"><?php echo $detailmutasibank_preview->nama_akun->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmutasibank_preview->nama_akun->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmutasibank_preview->nama_akun->Name) ?>" data-sort-order="<?php echo $detailmutasibank_preview->SortField == $detailmutasibank_preview->nama_akun->Name && $detailmutasibank_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_preview->nama_akun->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_preview->SortField == $detailmutasibank_preview->nama_akun->Name) { ?><?php if ($detailmutasibank_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_preview->jumlah->Visible) { // jumlah ?>
	<?php if ($detailmutasibank->SortUrl($detailmutasibank_preview->jumlah) == "") { ?>
		<th class="<?php echo $detailmutasibank_preview->jumlah->headerCellClass() ?>"><?php echo $detailmutasibank_preview->jumlah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmutasibank_preview->jumlah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmutasibank_preview->jumlah->Name) ?>" data-sort-order="<?php echo $detailmutasibank_preview->SortField == $detailmutasibank_preview->jumlah->Name && $detailmutasibank_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_preview->jumlah->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_preview->SortField == $detailmutasibank_preview->jumlah->Name) { ?><?php if ($detailmutasibank_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_preview->keterangan->Visible) { // keterangan ?>
	<?php if ($detailmutasibank->SortUrl($detailmutasibank_preview->keterangan) == "") { ?>
		<th class="<?php echo $detailmutasibank_preview->keterangan->headerCellClass() ?>"><?php echo $detailmutasibank_preview->keterangan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmutasibank_preview->keterangan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmutasibank_preview->keterangan->Name) ?>" data-sort-order="<?php echo $detailmutasibank_preview->SortField == $detailmutasibank_preview->keterangan->Name && $detailmutasibank_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_preview->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_preview->SortField == $detailmutasibank_preview->keterangan->Name) { ?><?php if ($detailmutasibank_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailmutasibank_preview->tipe_mutasi->Visible) { // tipe_mutasi ?>
	<?php if ($detailmutasibank->SortUrl($detailmutasibank_preview->tipe_mutasi) == "") { ?>
		<th class="<?php echo $detailmutasibank_preview->tipe_mutasi->headerCellClass() ?>"><?php echo $detailmutasibank_preview->tipe_mutasi->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailmutasibank_preview->tipe_mutasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailmutasibank_preview->tipe_mutasi->Name) ?>" data-sort-order="<?php echo $detailmutasibank_preview->SortField == $detailmutasibank_preview->tipe_mutasi->Name && $detailmutasibank_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailmutasibank_preview->tipe_mutasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailmutasibank_preview->SortField == $detailmutasibank_preview->tipe_mutasi->Name) { ?><?php if ($detailmutasibank_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailmutasibank_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailmutasibank_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailmutasibank_preview->RecCount = 0;
$detailmutasibank_preview->RowCount = 0;
while ($detailmutasibank_preview->Recordset && !$detailmutasibank_preview->Recordset->EOF) {

	// Init row class and style
	$detailmutasibank_preview->RecCount++;
	$detailmutasibank_preview->RowCount++;
	$detailmutasibank_preview->CssStyle = "";
	$detailmutasibank_preview->loadListRowValues($detailmutasibank_preview->Recordset);

	// Render row
	$detailmutasibank->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailmutasibank_preview->resetAttributes();
	$detailmutasibank_preview->renderListRow();

	// Render list options
	$detailmutasibank_preview->renderListOptions();
?>
	<tr <?php echo $detailmutasibank->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailmutasibank_preview->ListOptions->render("body", "left", $detailmutasibank_preview->RowCount);
?>
<?php if ($detailmutasibank_preview->akun_id->Visible) { // akun_id ?>
		<!-- akun_id -->
		<td<?php echo $detailmutasibank_preview->akun_id->cellAttributes() ?>>
<span<?php echo $detailmutasibank_preview->akun_id->viewAttributes() ?>><?php echo $detailmutasibank_preview->akun_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmutasibank_preview->nama_akun->Visible) { // nama_akun ?>
		<!-- nama_akun -->
		<td<?php echo $detailmutasibank_preview->nama_akun->cellAttributes() ?>>
<span<?php echo $detailmutasibank_preview->nama_akun->viewAttributes() ?>><?php echo $detailmutasibank_preview->nama_akun->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmutasibank_preview->jumlah->Visible) { // jumlah ?>
		<!-- jumlah -->
		<td<?php echo $detailmutasibank_preview->jumlah->cellAttributes() ?>>
<span<?php echo $detailmutasibank_preview->jumlah->viewAttributes() ?>><?php echo $detailmutasibank_preview->jumlah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmutasibank_preview->keterangan->Visible) { // keterangan ?>
		<!-- keterangan -->
		<td<?php echo $detailmutasibank_preview->keterangan->cellAttributes() ?>>
<span<?php echo $detailmutasibank_preview->keterangan->viewAttributes() ?>><?php echo $detailmutasibank_preview->keterangan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailmutasibank_preview->tipe_mutasi->Visible) { // tipe_mutasi ?>
		<!-- tipe_mutasi -->
		<td<?php echo $detailmutasibank_preview->tipe_mutasi->cellAttributes() ?>>
<span<?php echo $detailmutasibank_preview->tipe_mutasi->viewAttributes() ?>><?php echo $detailmutasibank_preview->tipe_mutasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailmutasibank_preview->ListOptions->render("body", "right", $detailmutasibank_preview->RowCount);
?>
	</tr>
<?php
	$detailmutasibank_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailmutasibank_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailmutasibank_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailmutasibank_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailmutasibank_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailmutasibank_preview->Recordset)
	$detailmutasibank_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailmutasibank_preview->terminate();
?>