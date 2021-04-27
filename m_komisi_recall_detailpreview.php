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
$m_komisi_recall_detail_preview = new m_komisi_recall_detail_preview();

// Run the page
$m_komisi_recall_detail_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_komisi_recall_detail_preview->Page_Render();
?>
<?php $m_komisi_recall_detail_preview->showPageHeader(); ?>
<?php if ($m_komisi_recall_detail_preview->TotalRecords > 0) { ?>
<div class="card ew-grid m_komisi_recall_detail"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$m_komisi_recall_detail_preview->renderListOptions();

// Render list options (header, left)
$m_komisi_recall_detail_preview->ListOptions->render("header", "left");
?>
<?php if ($m_komisi_recall_detail_preview->id->Visible) { // id ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->id) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->id->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->id->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->id->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->id->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->id_barang) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->id_barang->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->id_barang->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->id_barang->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->id_barang->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_default_persen->Visible) { // recall_default_persen ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->recall_default_persen) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_default_persen->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->recall_default_persen->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_default_persen->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->recall_default_persen->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_default_persen->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->recall_default_persen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_default_persen->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_default_rupiah->Visible) { // recall_default_rupiah ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->recall_default_rupiah) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->recall_default_rupiah->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_default_rupiah->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_default_rupiah->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_target_persen->Visible) { // recall_target_persen ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->recall_target_persen) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_target_persen->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->recall_target_persen->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_target_persen->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->recall_target_persen->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_target_persen->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->recall_target_persen->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_target_persen->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_target_rupiah->Visible) { // recall_target_rupiah ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->recall_target_rupiah) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->recall_target_rupiah->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_target_rupiah->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->recall_target_rupiah->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->tgl_mulai->Visible) { // tgl_mulai ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->tgl_mulai) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->tgl_mulai->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->tgl_mulai->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->tgl_mulai->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->tgl_mulai->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->tgl_mulai->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->tgl_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->tgl_mulai->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->tgl_akhir) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->tgl_akhir->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->tgl_akhir->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->tgl_akhir->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->tgl_akhir->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->tgl_akhir->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->target->Visible) { // target ?>
	<?php if ($m_komisi_recall_detail->SortUrl($m_komisi_recall_detail_preview->target) == "") { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->target->headerCellClass() ?>"><?php echo $m_komisi_recall_detail_preview->target->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $m_komisi_recall_detail_preview->target->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($m_komisi_recall_detail_preview->target->Name) ?>" data-sort-order="<?php echo $m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->target->Name && $m_komisi_recall_detail_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_komisi_recall_detail_preview->target->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_komisi_recall_detail_preview->SortField == $m_komisi_recall_detail_preview->target->Name) { ?><?php if ($m_komisi_recall_detail_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_komisi_recall_detail_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_komisi_recall_detail_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$m_komisi_recall_detail_preview->RecCount = 0;
$m_komisi_recall_detail_preview->RowCount = 0;
while ($m_komisi_recall_detail_preview->Recordset && !$m_komisi_recall_detail_preview->Recordset->EOF) {

	// Init row class and style
	$m_komisi_recall_detail_preview->RecCount++;
	$m_komisi_recall_detail_preview->RowCount++;
	$m_komisi_recall_detail_preview->CssStyle = "";
	$m_komisi_recall_detail_preview->loadListRowValues($m_komisi_recall_detail_preview->Recordset);

	// Render row
	$m_komisi_recall_detail->RowType = ROWTYPE_PREVIEW; // Preview record
	$m_komisi_recall_detail_preview->resetAttributes();
	$m_komisi_recall_detail_preview->renderListRow();

	// Render list options
	$m_komisi_recall_detail_preview->renderListOptions();
?>
	<tr <?php echo $m_komisi_recall_detail->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_komisi_recall_detail_preview->ListOptions->render("body", "left", $m_komisi_recall_detail_preview->RowCount);
?>
<?php if ($m_komisi_recall_detail_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $m_komisi_recall_detail_preview->id->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->id->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $m_komisi_recall_detail_preview->id_barang->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->id_barang->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_default_persen->Visible) { // recall_default_persen ?>
		<!-- recall_default_persen -->
		<td<?php echo $m_komisi_recall_detail_preview->recall_default_persen->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->recall_default_persen->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->recall_default_persen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_default_rupiah->Visible) { // recall_default_rupiah ?>
		<!-- recall_default_rupiah -->
		<td<?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->recall_default_rupiah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_target_persen->Visible) { // recall_target_persen ?>
		<!-- recall_target_persen -->
		<td<?php echo $m_komisi_recall_detail_preview->recall_target_persen->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->recall_target_persen->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->recall_target_persen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->recall_target_rupiah->Visible) { // recall_target_rupiah ?>
		<!-- recall_target_rupiah -->
		<td<?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->recall_target_rupiah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->tgl_mulai->Visible) { // tgl_mulai ?>
		<!-- tgl_mulai -->
		<td<?php echo $m_komisi_recall_detail_preview->tgl_mulai->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->tgl_mulai->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->tgl_mulai->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->tgl_akhir->Visible) { // tgl_akhir ?>
		<!-- tgl_akhir -->
		<td<?php echo $m_komisi_recall_detail_preview->tgl_akhir->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->tgl_akhir->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->tgl_akhir->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($m_komisi_recall_detail_preview->target->Visible) { // target ?>
		<!-- target -->
		<td<?php echo $m_komisi_recall_detail_preview->target->cellAttributes() ?>>
<span<?php echo $m_komisi_recall_detail_preview->target->viewAttributes() ?>><?php echo $m_komisi_recall_detail_preview->target->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$m_komisi_recall_detail_preview->ListOptions->render("body", "right", $m_komisi_recall_detail_preview->RowCount);
?>
	</tr>
<?php
	$m_komisi_recall_detail_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $m_komisi_recall_detail_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($m_komisi_recall_detail_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($m_komisi_recall_detail_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$m_komisi_recall_detail_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($m_komisi_recall_detail_preview->Recordset)
	$m_komisi_recall_detail_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$m_komisi_recall_detail_preview->terminate();
?>