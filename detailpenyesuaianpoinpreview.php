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
$detailpenyesuaianpoin_preview = new detailpenyesuaianpoin_preview();

// Run the page
$detailpenyesuaianpoin_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpenyesuaianpoin_preview->Page_Render();
?>
<?php $detailpenyesuaianpoin_preview->showPageHeader(); ?>
<?php if ($detailpenyesuaianpoin_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailpenyesuaianpoin"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailpenyesuaianpoin_preview->renderListOptions();

// Render list options (header, left)
$detailpenyesuaianpoin_preview->ListOptions->render("header", "left");
?>
<?php if ($detailpenyesuaianpoin_preview->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->pid_penyesuaianpoin) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->pid_penyesuaianpoin->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->id_member->Visible) { // id_member ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->id_member) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->id_member->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->id_member->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->id_member->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->id_member->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->id_member->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->id_member->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->id_member->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->poin_database->Visible) { // poin_database ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->poin_database) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->poin_database->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->poin_database->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->poin_database->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->poin_database->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->poin_database->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->poin_database->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->poin_database->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->poin_lapangan->Visible) { // poin_lapangan ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->poin_lapangan) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->poin_lapangan->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->poin_lapangan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->poin_lapangan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->poin_lapangan->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->poin_lapangan->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->poin_lapangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->poin_lapangan->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->selisih->Visible) { // selisih ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->selisih) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->selisih->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->selisih->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->selisih->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->selisih->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->selisih->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->selisih->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->selisih->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->tipe->Visible) { // tipe ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->tipe) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->tipe->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->tipe->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->tipe->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->tipe->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->tipe->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->tipe->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->keterangan->Visible) { // keterangan ?>
	<?php if ($detailpenyesuaianpoin->SortUrl($detailpenyesuaianpoin_preview->keterangan) == "") { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->keterangan->headerCellClass() ?>"><?php echo $detailpenyesuaianpoin_preview->keterangan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpenyesuaianpoin_preview->keterangan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpenyesuaianpoin_preview->keterangan->Name) ?>" data-sort-order="<?php echo $detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->keterangan->Name && $detailpenyesuaianpoin_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpenyesuaianpoin_preview->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpenyesuaianpoin_preview->SortField == $detailpenyesuaianpoin_preview->keterangan->Name) { ?><?php if ($detailpenyesuaianpoin_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpenyesuaianpoin_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpenyesuaianpoin_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailpenyesuaianpoin_preview->RecCount = 0;
$detailpenyesuaianpoin_preview->RowCount = 0;
while ($detailpenyesuaianpoin_preview->Recordset && !$detailpenyesuaianpoin_preview->Recordset->EOF) {

	// Init row class and style
	$detailpenyesuaianpoin_preview->RecCount++;
	$detailpenyesuaianpoin_preview->RowCount++;
	$detailpenyesuaianpoin_preview->CssStyle = "";
	$detailpenyesuaianpoin_preview->loadListRowValues($detailpenyesuaianpoin_preview->Recordset);

	// Render row
	$detailpenyesuaianpoin->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailpenyesuaianpoin_preview->resetAttributes();
	$detailpenyesuaianpoin_preview->renderListRow();

	// Render list options
	$detailpenyesuaianpoin_preview->renderListOptions();
?>
	<tr <?php echo $detailpenyesuaianpoin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpenyesuaianpoin_preview->ListOptions->render("body", "left", $detailpenyesuaianpoin_preview->RowCount);
?>
<?php if ($detailpenyesuaianpoin_preview->pid_penyesuaianpoin->Visible) { // pid_penyesuaianpoin ?>
		<!-- pid_penyesuaianpoin -->
		<td<?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->pid_penyesuaianpoin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->id_member->Visible) { // id_member ?>
		<!-- id_member -->
		<td<?php echo $detailpenyesuaianpoin_preview->id_member->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->id_member->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->id_member->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->poin_database->Visible) { // poin_database ?>
		<!-- poin_database -->
		<td<?php echo $detailpenyesuaianpoin_preview->poin_database->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->poin_database->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->poin_database->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->poin_lapangan->Visible) { // poin_lapangan ?>
		<!-- poin_lapangan -->
		<td<?php echo $detailpenyesuaianpoin_preview->poin_lapangan->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->poin_lapangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->poin_lapangan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->selisih->Visible) { // selisih ?>
		<!-- selisih -->
		<td<?php echo $detailpenyesuaianpoin_preview->selisih->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->selisih->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->selisih->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->tipe->Visible) { // tipe ?>
		<!-- tipe -->
		<td<?php echo $detailpenyesuaianpoin_preview->tipe->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->tipe->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->tipe->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpenyesuaianpoin_preview->keterangan->Visible) { // keterangan ?>
		<!-- keterangan -->
		<td<?php echo $detailpenyesuaianpoin_preview->keterangan->cellAttributes() ?>>
<span<?php echo $detailpenyesuaianpoin_preview->keterangan->viewAttributes() ?>><?php echo $detailpenyesuaianpoin_preview->keterangan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailpenyesuaianpoin_preview->ListOptions->render("body", "right", $detailpenyesuaianpoin_preview->RowCount);
?>
	</tr>
<?php
	$detailpenyesuaianpoin_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailpenyesuaianpoin_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailpenyesuaianpoin_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailpenyesuaianpoin_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailpenyesuaianpoin_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailpenyesuaianpoin_preview->Recordset)
	$detailpenyesuaianpoin_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailpenyesuaianpoin_preview->terminate();
?>