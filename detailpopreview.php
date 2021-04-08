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
$detailpo_preview = new detailpo_preview();

// Run the page
$detailpo_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$detailpo_preview->Page_Render();
?>
<?php $detailpo_preview->showPageHeader(); ?>
<?php if ($detailpo_preview->TotalRecords > 0) { ?>
<div class="card ew-grid detailpo"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$detailpo_preview->renderListOptions();

// Render list options (header, left)
$detailpo_preview->ListOptions->render("header", "left");
?>
<?php if ($detailpo_preview->pid_detailpo->Visible) { // pid_detailpo ?>
	<?php if ($detailpo->SortUrl($detailpo_preview->pid_detailpo) == "") { ?>
		<th class="<?php echo $detailpo_preview->pid_detailpo->headerCellClass() ?>"><?php echo $detailpo_preview->pid_detailpo->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpo_preview->pid_detailpo->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpo_preview->pid_detailpo->Name) ?>" data-sort-order="<?php echo $detailpo_preview->SortField == $detailpo_preview->pid_detailpo->Name && $detailpo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_preview->pid_detailpo->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_preview->SortField == $detailpo_preview->pid_detailpo->Name) { ?><?php if ($detailpo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_preview->idbarang->Visible) { // idbarang ?>
	<?php if ($detailpo->SortUrl($detailpo_preview->idbarang) == "") { ?>
		<th class="<?php echo $detailpo_preview->idbarang->headerCellClass() ?>"><?php echo $detailpo_preview->idbarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpo_preview->idbarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpo_preview->idbarang->Name) ?>" data-sort-order="<?php echo $detailpo_preview->SortField == $detailpo_preview->idbarang->Name && $detailpo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_preview->idbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_preview->SortField == $detailpo_preview->idbarang->Name) { ?><?php if ($detailpo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_preview->qty->Visible) { // qty ?>
	<?php if ($detailpo->SortUrl($detailpo_preview->qty) == "") { ?>
		<th class="<?php echo $detailpo_preview->qty->headerCellClass() ?>"><?php echo $detailpo_preview->qty->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpo_preview->qty->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpo_preview->qty->Name) ?>" data-sort-order="<?php echo $detailpo_preview->SortField == $detailpo_preview->qty->Name && $detailpo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_preview->qty->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_preview->SortField == $detailpo_preview->qty->Name) { ?><?php if ($detailpo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($detailpo_preview->satuan->Visible) { // satuan ?>
	<?php if ($detailpo->SortUrl($detailpo_preview->satuan) == "") { ?>
		<th class="<?php echo $detailpo_preview->satuan->headerCellClass() ?>"><?php echo $detailpo_preview->satuan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $detailpo_preview->satuan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($detailpo_preview->satuan->Name) ?>" data-sort-order="<?php echo $detailpo_preview->SortField == $detailpo_preview->satuan->Name && $detailpo_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $detailpo_preview->satuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($detailpo_preview->SortField == $detailpo_preview->satuan->Name) { ?><?php if ($detailpo_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($detailpo_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$detailpo_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$detailpo_preview->RecCount = 0;
$detailpo_preview->RowCount = 0;
while ($detailpo_preview->Recordset && !$detailpo_preview->Recordset->EOF) {

	// Init row class and style
	$detailpo_preview->RecCount++;
	$detailpo_preview->RowCount++;
	$detailpo_preview->CssStyle = "";
	$detailpo_preview->loadListRowValues($detailpo_preview->Recordset);

	// Render row
	$detailpo->RowType = ROWTYPE_PREVIEW; // Preview record
	$detailpo_preview->resetAttributes();
	$detailpo_preview->renderListRow();

	// Render list options
	$detailpo_preview->renderListOptions();
?>
	<tr <?php echo $detailpo->rowAttributes() ?>>
<?php

// Render list options (body, left)
$detailpo_preview->ListOptions->render("body", "left", $detailpo_preview->RowCount);
?>
<?php if ($detailpo_preview->pid_detailpo->Visible) { // pid_detailpo ?>
		<!-- pid_detailpo -->
		<td<?php echo $detailpo_preview->pid_detailpo->cellAttributes() ?>>
<span<?php echo $detailpo_preview->pid_detailpo->viewAttributes() ?>><?php echo $detailpo_preview->pid_detailpo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpo_preview->idbarang->Visible) { // idbarang ?>
		<!-- idbarang -->
		<td<?php echo $detailpo_preview->idbarang->cellAttributes() ?>>
<span<?php echo $detailpo_preview->idbarang->viewAttributes() ?>><?php echo $detailpo_preview->idbarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpo_preview->qty->Visible) { // qty ?>
		<!-- qty -->
		<td<?php echo $detailpo_preview->qty->cellAttributes() ?>>
<span<?php echo $detailpo_preview->qty->viewAttributes() ?>><?php echo $detailpo_preview->qty->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($detailpo_preview->satuan->Visible) { // satuan ?>
		<!-- satuan -->
		<td<?php echo $detailpo_preview->satuan->cellAttributes() ?>>
<span<?php echo $detailpo_preview->satuan->viewAttributes() ?>><?php echo $detailpo_preview->satuan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$detailpo_preview->ListOptions->render("body", "right", $detailpo_preview->RowCount);
?>
	</tr>
<?php
	$detailpo_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $detailpo_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($detailpo_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($detailpo_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$detailpo_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($detailpo_preview->Recordset)
	$detailpo_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$detailpo_preview->terminate();
?>