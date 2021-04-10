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
WriteHeader(FALSE);

// Create page object
$report_rekap_summary = new report_rekap_summary();

// Run the page
$report_rekap_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$report_rekap_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$report_rekap_summary->isExport() && !$report_rekap_summary->DrillDown && !$DashboardReport) { ?>
<script>
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$report_rekap_summary->DrillDownInPanel) {
	$report_rekap_summary->ExportOptions->render("body");
	$report_rekap_summary->SearchOptions->render("body");
	$report_rekap_summary->FilterOptions->render("body");
}
?>
</div>
<?php $report_rekap_summary->showPageHeader(); ?>
<?php
$report_rekap_summary->showMessage();
?>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Left Container -->
<div id="ew-left" class="<?php echo $report_rekap_summary->LeftContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($report_rekap_summary->isExport("print") || $report_rekap_summary->isExport("pdf") || $report_rekap_summary->isExport("email") || $report_rekap_summary->isExport("excel") && Config("USE_PHPEXCEL") || $report_rekap_summary->isExport("word") && Config("USE_PHPWORD")) && $report_rekap_summary->ExportChartPageBreak) {

		// Page_Breaking server event
		$report_rekap_summary->Page_Breaking($report_rekap_summary->ExportChartPageBreak, $report_rekap_summary->PageBreakContent);
		$report_rekap->Chart_Tes->PageBreakType = "after"; // Page break type
		$report_rekap->Chart_Tes->PageBreak = $report_rekap_summary->ExportChartPageBreak;
		$report_rekap->Chart_Tes->PageBreakContent = $report_rekap_summary->PageBreakContent;
	}

	// Set up chart drilldown
	$report_rekap->Chart_Tes->DrillDownInPanel = $report_rekap_summary->DrillDownInPanel;
	$report_rekap->Chart_Tes->render("ew-chart-top");
}
?>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-left -->
<?php } ?>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $report_rekap_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$report_rekap_summary->isExport() && !$report_rekap_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($report_rekap_summary->GroupCount <= count($report_rekap_summary->GroupRecords) && $report_rekap_summary->GroupCount <= $report_rekap_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($report_rekap_summary->ShowHeader) {
?>
<?php if ($report_rekap_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($report_rekap_summary->TotalGroups > 0) { ?>
<?php if (!$report_rekap_summary->isExport() && !($report_rekap_summary->DrillDown && $report_rekap_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $report_rekap_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $report_rekap_summary->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$report_rekap_summary->isExport("word") && !$report_rekap_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $report_rekap_summary->ReportTableStyle ?>>
<?php if (!$report_rekap_summary->isExport() && !($report_rekap_summary->DrillDown && $report_rekap_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $report_rekap_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_report_rekap" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $report_rekap_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($report_rekap_summary->id_barang->Visible) { ?>
	<?php if ($report_rekap_summary->id_barang->ShowGroupHeaderAsRow) { ?>
	<th data-name="id_barang">&nbsp;</th>
	<?php } else { ?>
		<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_barang) == "") { ?>
	<th data-name="id_barang" class="<?php echo $report_rekap_summary->id_barang->headerCellClass() ?>"><div class="report_rekap_id_barang"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->id_barang->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="id_barang" class="<?php echo $report_rekap_summary->id_barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_barang) ?>', 1);"><div class="report_rekap_id_barang">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_klinik) == "") { ?>
	<th data-name="id_klinik" class="<?php echo $report_rekap_summary->id_klinik->headerCellClass() ?>"><div class="report_rekap_id_klinik"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->id_klinik->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id_klinik" class="<?php echo $report_rekap_summary->id_klinik->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_klinik) ?>', 1);"><div class="report_rekap_id_klinik">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_klinik->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_klinik->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->tanggal) == "") { ?>
	<th data-name="tanggal" class="<?php echo $report_rekap_summary->tanggal->headerCellClass() ?>"><div class="report_rekap_tanggal"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->tanggal->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="tanggal" class="<?php echo $report_rekap_summary->tanggal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->tanggal) ?>', 1);"><div class="report_rekap_tanggal">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->tanggal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->tanggal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->stok_awal) == "") { ?>
	<th data-name="stok_awal" class="<?php echo $report_rekap_summary->stok_awal->headerCellClass() ?>"><div class="report_rekap_stok_awal"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->stok_awal->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="stok_awal" class="<?php echo $report_rekap_summary->stok_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->stok_awal) ?>', 1);"><div class="report_rekap_stok_awal">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->stok_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->stok_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->stok_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->masuk) == "") { ?>
	<th data-name="masuk" class="<?php echo $report_rekap_summary->masuk->headerCellClass() ?>"><div class="report_rekap_masuk"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->masuk->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="masuk" class="<?php echo $report_rekap_summary->masuk->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->masuk) ?>', 1);"><div class="report_rekap_masuk">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->masuk->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->masuk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->masuk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->keluar) == "") { ?>
	<th data-name="keluar" class="<?php echo $report_rekap_summary->keluar->headerCellClass() ?>"><div class="report_rekap_keluar"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="keluar" class="<?php echo $report_rekap_summary->keluar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->keluar) ?>', 1);"><div class="report_rekap_keluar">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->keluar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->keluar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->retur) == "") { ?>
	<th data-name="retur" class="<?php echo $report_rekap_summary->retur->headerCellClass() ?>"><div class="report_rekap_retur"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->retur->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="retur" class="<?php echo $report_rekap_summary->retur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->retur) ?>', 1);"><div class="report_rekap_retur">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->retur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->retur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->stok_akhir) == "") { ?>
	<th data-name="stok_akhir" class="<?php echo $report_rekap_summary->stok_akhir->headerCellClass() ?>"><div class="report_rekap_stok_akhir"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->stok_akhir->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="stok_akhir" class="<?php echo $report_rekap_summary->stok_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->stok_akhir) ?>', 1);"><div class="report_rekap_stok_akhir">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->stok_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->stok_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->stok_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_penyesuaian) == "") { ?>
	<th data-name="id_penyesuaian" class="<?php echo $report_rekap_summary->id_penyesuaian->headerCellClass() ?>"><div class="report_rekap_id_penyesuaian"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->id_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id_penyesuaian" class="<?php echo $report_rekap_summary->id_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_penyesuaian) ?>', 1);"><div class="report_rekap_id_penyesuaian">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_nonjual) == "") { ?>
	<th data-name="id_nonjual" class="<?php echo $report_rekap_summary->id_nonjual->headerCellClass() ?>"><div class="report_rekap_id_nonjual"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->id_nonjual->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id_nonjual" class="<?php echo $report_rekap_summary->id_nonjual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_nonjual) ?>', 1);"><div class="report_rekap_id_nonjual">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_nonjual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_nonjual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->keluar_nonjual) == "") { ?>
	<th data-name="keluar_nonjual" class="<?php echo $report_rekap_summary->keluar_nonjual->headerCellClass() ?>"><div class="report_rekap_keluar_nonjual"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar_nonjual->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="keluar_nonjual" class="<?php echo $report_rekap_summary->keluar_nonjual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->keluar_nonjual) ?>', 1);"><div class="report_rekap_keluar_nonjual">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->keluar_nonjual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->keluar_nonjual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->masuk_penyesuaian) == "") { ?>
	<th data-name="masuk_penyesuaian" class="<?php echo $report_rekap_summary->masuk_penyesuaian->headerCellClass() ?>"><div class="report_rekap_masuk_penyesuaian"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->masuk_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="masuk_penyesuaian" class="<?php echo $report_rekap_summary->masuk_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->masuk_penyesuaian) ?>', 1);"><div class="report_rekap_masuk_penyesuaian">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->masuk_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->masuk_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->masuk_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->keluar_penyesuaian) == "") { ?>
	<th data-name="keluar_penyesuaian" class="<?php echo $report_rekap_summary->keluar_penyesuaian->headerCellClass() ?>"><div class="report_rekap_keluar_penyesuaian"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar_penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="keluar_penyesuaian" class="<?php echo $report_rekap_summary->keluar_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->keluar_penyesuaian) ?>', 1);"><div class="report_rekap_keluar_penyesuaian">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->keluar_penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->keluar_penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_kirimbarang) == "") { ?>
	<th data-name="id_kirimbarang" class="<?php echo $report_rekap_summary->id_kirimbarang->headerCellClass() ?>"><div class="report_rekap_id_kirimbarang"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->id_kirimbarang->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id_kirimbarang" class="<?php echo $report_rekap_summary->id_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_kirimbarang) ?>', 1);"><div class="report_rekap_id_kirimbarang">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_kirimbarang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_kirimbarang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->keluar_kirim) == "") { ?>
	<th data-name="keluar_kirim" class="<?php echo $report_rekap_summary->keluar_kirim->headerCellClass() ?>"><div class="report_rekap_keluar_kirim"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar_kirim->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="keluar_kirim" class="<?php echo $report_rekap_summary->keluar_kirim->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->keluar_kirim) ?>', 1);"><div class="report_rekap_keluar_kirim">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->keluar_kirim->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->keluar_kirim->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->keluar_kirim->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
	<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_terimagudang) == "") { ?>
	<th data-name="id_terimagudang" class="<?php echo $report_rekap_summary->id_terimagudang->headerCellClass() ?>"><div class="report_rekap_id_terimagudang"><div class="ew-table-header-caption"><?php echo $report_rekap_summary->id_terimagudang->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id_terimagudang" class="<?php echo $report_rekap_summary->id_terimagudang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_terimagudang) ?>', 1);"><div class="report_rekap_id_terimagudang">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_terimagudang->caption() ?></span><span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_terimagudang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_terimagudang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($report_rekap_summary->TotalGroups == 0)
			break; // Show header only
		$report_rekap_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($report_rekap_summary->id_barang, $report_rekap_summary->getSqlFirstGroupField(), $report_rekap_summary->id_barang->groupValue(), $report_rekap_summary->Dbid);
	if ($report_rekap_summary->PageFirstGroupFilter != "") $report_rekap_summary->PageFirstGroupFilter .= " OR ";
	$report_rekap_summary->PageFirstGroupFilter .= $where;
	if ($report_rekap_summary->Filter != "")
		$where = "($report_rekap_summary->Filter) AND ($where)";
	$sql = BuildReportSql($report_rekap_summary->getSqlSelect(), $report_rekap_summary->getSqlWhere(), $report_rekap_summary->getSqlGroupBy(), $report_rekap_summary->getSqlHaving(), $report_rekap_summary->getSqlOrderBy(), $where, $report_rekap_summary->Sort);
	$rs = $report_rekap_summary->getRecordset($sql);
	$report_rekap_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$report_rekap_summary->DetailRecordCount = count($report_rekap_summary->DetailRecords);
	$report_rekap_summary->setGroupCount($report_rekap_summary->DetailRecordCount, $report_rekap_summary->GroupCount);

	// Load detail records
	$report_rekap_summary->id_barang->Records = &$report_rekap_summary->DetailRecords;
	$report_rekap_summary->id_barang->LevelBreak = TRUE; // Set field level break
		$report_rekap_summary->GroupCounter[1] = $report_rekap_summary->GroupCount;
		$report_rekap_summary->id_barang->getCnt($report_rekap_summary->id_barang->Records); // Get record count
		$report_rekap_summary->setGroupCount($report_rekap_summary->id_barang->Count, $report_rekap_summary->GroupCounter[1]);
?>
<?php if ($report_rekap_summary->id_barang->Visible && $report_rekap_summary->id_barang->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$report_rekap_summary->resetAttributes();
		$report_rekap_summary->RowType = ROWTYPE_TOTAL;
		$report_rekap_summary->RowTotalType = ROWTOTAL_GROUP;
		$report_rekap_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$report_rekap_summary->RowGroupLevel = 1;
		$report_rekap_summary->renderRow();
?>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>>
<?php if ($report_rekap_summary->id_barang->Visible) { ?>
		<td data-field="id_barang"<?php echo $report_rekap_summary->id_barang->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="id_barang" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>
<?php if ($report_rekap_summary->sortUrl($report_rekap_summary->id_barang) == "") { ?>
		<span class="ew-summary-caption report_rekap_id_barang"><span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_barang->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption report_rekap_id_barang" onclick="ew.sort(event, '<?php echo $report_rekap_summary->sortUrl($report_rekap_summary->id_barang) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $report_rekap_summary->id_barang->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($report_rekap_summary->id_barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($report_rekap_summary->id_barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $report_rekap_summary->id_barang->viewAttributes() ?>><?php echo $report_rekap_summary->id_barang->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($report_rekap_summary->id_barang->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$report_rekap_summary->RecordCount = 0; // Reset record count
	foreach ($report_rekap_summary->id_barang->Records as $record) {
		$report_rekap_summary->RecordCount++;
		$report_rekap_summary->RecordIndex++;
		$report_rekap_summary->loadRowValues($record);
?>
<?php
	}
?>
<?php if ($report_rekap_summary->TotalGroups > 0) { ?>
<?php
	$report_rekap_summary->stok_awal->getSum($report_rekap_summary->id_barang->Records); // Get Sum
	$report_rekap_summary->masuk->getSum($report_rekap_summary->id_barang->Records); // Get Sum
	$report_rekap_summary->keluar->getSum($report_rekap_summary->id_barang->Records); // Get Sum
	$report_rekap_summary->retur->getSum($report_rekap_summary->id_barang->Records); // Get Sum
	$report_rekap_summary->stok_akhir->getSum($report_rekap_summary->id_barang->Records); // Get Sum
	$report_rekap_summary->resetAttributes();
	$report_rekap_summary->RowType = ROWTYPE_TOTAL;
	$report_rekap_summary->RowTotalType = ROWTOTAL_GROUP;
	$report_rekap_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$report_rekap_summary->RowGroupLevel = 1;
	$report_rekap_summary->renderRow();
?>
<?php if ($report_rekap_summary->id_barang->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>>
<?php if ($report_rekap_summary->id_barang->Visible) { ?>
		<td data-field="id_barang"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>
	<?php if ($report_rekap_summary->id_barang->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($report_rekap_summary->RowGroupLevel != 1) { ?>
		<span<?php echo $report_rekap_summary->id_barang->viewAttributes() ?>><?php echo $report_rekap_summary->id_barang->GroupViewValue ?></span>
	<?php } else { ?>
		<span class="ew-summary-count"><span<?php echo $report_rekap_summary->id_barang->viewAttributes() ?>><?php echo $report_rekap_summary->id_barang->GroupViewValue ?></span>&nbsp;(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($report_rekap_summary->id_barang->Count, 0); ?></span>)</span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
		<td data-field="id_klinik"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
		<td data-field="stok_awal"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->stok_awal->viewAttributes() ?>><?php echo $report_rekap_summary->stok_awal->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
		<td data-field="masuk"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->masuk->viewAttributes() ?>><?php echo $report_rekap_summary->masuk->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
		<td data-field="keluar"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->keluar->viewAttributes() ?>><?php echo $report_rekap_summary->keluar->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
		<td data-field="retur"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->retur->viewAttributes() ?>><?php echo $report_rekap_summary->retur->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
		<td data-field="stok_akhir"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->stok_akhir->viewAttributes() ?>><?php echo $report_rekap_summary->stok_akhir->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
		<td data-field="id_penyesuaian"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
		<td data-field="id_nonjual"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
		<td data-field="keluar_nonjual"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
		<td data-field="masuk_penyesuaian"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
		<td data-field="keluar_penyesuaian"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
		<td data-field="id_kirimbarang"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
		<td data-field="keluar_kirim"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
		<td data-field="id_terimagudang"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>>
<?php if ($report_rekap_summary->GroupColumnCount + $report_rekap_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($report_rekap_summary->GroupColumnCount + $report_rekap_summary->DetailColumnCount) ?>"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$report_rekap_summary->id_barang->GroupViewValue, $report_rekap_summary->id_barang->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($report_rekap_summary->id_barang->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>>
<?php if ($report_rekap_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($report_rekap_summary->GroupColumnCount - 0) ?>"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
		<td data-field="id_klinik"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
		<td data-field="stok_awal"<?php echo $report_rekap_summary->stok_awal->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->stok_awal->viewAttributes() ?>><?php echo $report_rekap_summary->stok_awal->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
		<td data-field="masuk"<?php echo $report_rekap_summary->masuk->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->masuk->viewAttributes() ?>><?php echo $report_rekap_summary->masuk->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
		<td data-field="keluar"<?php echo $report_rekap_summary->keluar->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->keluar->viewAttributes() ?>><?php echo $report_rekap_summary->keluar->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
		<td data-field="retur"<?php echo $report_rekap_summary->retur->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->retur->viewAttributes() ?>><?php echo $report_rekap_summary->retur->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
		<td data-field="stok_akhir"<?php echo $report_rekap_summary->stok_akhir->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->stok_akhir->viewAttributes() ?>><?php echo $report_rekap_summary->stok_akhir->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
		<td data-field="id_penyesuaian"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
		<td data-field="id_nonjual"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
		<td data-field="keluar_nonjual"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
		<td data-field="masuk_penyesuaian"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
		<td data-field="keluar_penyesuaian"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
		<td data-field="id_kirimbarang"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
		<td data-field="keluar_kirim"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
		<td data-field="id_terimagudang"<?php echo $report_rekap_summary->id_barang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$report_rekap_summary->loadGroupRowValues();

	// Show header if page break
	if ($report_rekap_summary->isExport())
		$report_rekap_summary->ShowHeader = ($report_rekap_summary->ExportPageBreakCount == 0) ? FALSE : ($report_rekap_summary->GroupCount % $report_rekap_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($report_rekap_summary->ShowHeader)
		$report_rekap_summary->Page_Breaking($report_rekap_summary->ShowHeader, $report_rekap_summary->PageBreakContent);
	$report_rekap_summary->GroupCount++;
} // End while
?>
<?php if ($report_rekap_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($report_rekap_summary->StopGroup - $report_rekap_summary->StartGroup + 1) != $report_rekap_summary->TotalGroups) { ?>
<?php
	$report_rekap_summary->resetAttributes();
	$report_rekap_summary->RowType = ROWTYPE_TOTAL;
	$report_rekap_summary->RowTotalType = ROWTOTAL_PAGE;
	$report_rekap_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$report_rekap_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$report_rekap_summary->renderRow();
?>
<?php if ($report_rekap_summary->id_barang->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>><td colspan="<?php echo ($report_rekap_summary->GroupColumnCount + $report_rekap_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($report_rekap_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>>
<?php if ($report_rekap_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $report_rekap_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
		<td data-field="id_klinik"<?php echo $report_rekap_summary->id_klinik->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $report_rekap_summary->tanggal->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
		<td data-field="stok_awal"<?php echo $report_rekap_summary->stok_awal->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->stok_awal->viewAttributes() ?>><?php echo $report_rekap_summary->stok_awal->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
		<td data-field="masuk"<?php echo $report_rekap_summary->masuk->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->masuk->viewAttributes() ?>><?php echo $report_rekap_summary->masuk->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
		<td data-field="keluar"<?php echo $report_rekap_summary->keluar->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->keluar->viewAttributes() ?>><?php echo $report_rekap_summary->keluar->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
		<td data-field="retur"<?php echo $report_rekap_summary->retur->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->retur->viewAttributes() ?>><?php echo $report_rekap_summary->retur->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
		<td data-field="stok_akhir"<?php echo $report_rekap_summary->stok_akhir->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->stok_akhir->viewAttributes() ?>><?php echo $report_rekap_summary->stok_akhir->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
		<td data-field="id_penyesuaian"<?php echo $report_rekap_summary->id_penyesuaian->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
		<td data-field="id_nonjual"<?php echo $report_rekap_summary->id_nonjual->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
		<td data-field="keluar_nonjual"<?php echo $report_rekap_summary->keluar_nonjual->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
		<td data-field="masuk_penyesuaian"<?php echo $report_rekap_summary->masuk_penyesuaian->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
		<td data-field="keluar_penyesuaian"<?php echo $report_rekap_summary->keluar_penyesuaian->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
		<td data-field="id_kirimbarang"<?php echo $report_rekap_summary->id_kirimbarang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
		<td data-field="keluar_kirim"<?php echo $report_rekap_summary->keluar_kirim->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
		<td data-field="id_terimagudang"<?php echo $report_rekap_summary->id_terimagudang->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>><td colspan="<?php echo ($report_rekap_summary->GroupColumnCount + $report_rekap_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($report_rekap_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $report_rekap_summary->rowAttributes(); ?>>
<?php if ($report_rekap_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $report_rekap_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
		<td data-field="id_klinik"<?php echo $report_rekap_summary->id_klinik->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $report_rekap_summary->tanggal->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
		<td data-field="stok_awal"<?php echo $report_rekap_summary->stok_awal->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->stok_awal->viewAttributes() ?>><?php echo $report_rekap_summary->stok_awal->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
		<td data-field="masuk"<?php echo $report_rekap_summary->masuk->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->masuk->viewAttributes() ?>><?php echo $report_rekap_summary->masuk->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
		<td data-field="keluar"<?php echo $report_rekap_summary->keluar->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->keluar->viewAttributes() ?>><?php echo $report_rekap_summary->keluar->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
		<td data-field="retur"<?php echo $report_rekap_summary->retur->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->retur->viewAttributes() ?>><?php echo $report_rekap_summary->retur->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
		<td data-field="stok_akhir"<?php echo $report_rekap_summary->stok_akhir->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->stok_akhir->viewAttributes() ?>><?php echo $report_rekap_summary->stok_akhir->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
		<td data-field="id_penyesuaian"<?php echo $report_rekap_summary->id_penyesuaian->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
		<td data-field="id_nonjual"<?php echo $report_rekap_summary->id_nonjual->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
		<td data-field="keluar_nonjual"<?php echo $report_rekap_summary->keluar_nonjual->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
		<td data-field="masuk_penyesuaian"<?php echo $report_rekap_summary->masuk_penyesuaian->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
		<td data-field="keluar_penyesuaian"<?php echo $report_rekap_summary->keluar_penyesuaian->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
		<td data-field="id_kirimbarang"<?php echo $report_rekap_summary->id_kirimbarang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
		<td data-field="keluar_kirim"<?php echo $report_rekap_summary->keluar_kirim->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
		<td data-field="id_terimagudang"<?php echo $report_rekap_summary->id_terimagudang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	$report_rekap_summary->resetAttributes();
	$report_rekap_summary->RowType = ROWTYPE_TOTAL;
	$report_rekap_summary->RowTotalType = ROWTOTAL_GRAND;
	$report_rekap_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$report_rekap_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$report_rekap_summary->renderRow();
?>
<?php if ($report_rekap_summary->id_barang->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $report_rekap_summary->rowAttributes() ?>><td colspan="<?php echo ($report_rekap_summary->GroupColumnCount + $report_rekap_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($report_rekap_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $report_rekap_summary->rowAttributes() ?>>
<?php if ($report_rekap_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $report_rekap_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
		<td data-field="id_klinik"<?php echo $report_rekap_summary->id_klinik->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $report_rekap_summary->tanggal->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
		<td data-field="stok_awal"<?php echo $report_rekap_summary->stok_awal->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->stok_awal->viewAttributes() ?>><?php echo $report_rekap_summary->stok_awal->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
		<td data-field="masuk"<?php echo $report_rekap_summary->masuk->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->masuk->viewAttributes() ?>><?php echo $report_rekap_summary->masuk->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
		<td data-field="keluar"<?php echo $report_rekap_summary->keluar->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->keluar->viewAttributes() ?>><?php echo $report_rekap_summary->keluar->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
		<td data-field="retur"<?php echo $report_rekap_summary->retur->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->retur->viewAttributes() ?>><?php echo $report_rekap_summary->retur->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
		<td data-field="stok_akhir"<?php echo $report_rekap_summary->stok_akhir->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $report_rekap_summary->stok_akhir->viewAttributes() ?>><?php echo $report_rekap_summary->stok_akhir->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
		<td data-field="id_penyesuaian"<?php echo $report_rekap_summary->id_penyesuaian->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
		<td data-field="id_nonjual"<?php echo $report_rekap_summary->id_nonjual->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
		<td data-field="keluar_nonjual"<?php echo $report_rekap_summary->keluar_nonjual->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
		<td data-field="masuk_penyesuaian"<?php echo $report_rekap_summary->masuk_penyesuaian->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
		<td data-field="keluar_penyesuaian"<?php echo $report_rekap_summary->keluar_penyesuaian->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
		<td data-field="id_kirimbarang"<?php echo $report_rekap_summary->id_kirimbarang->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
		<td data-field="keluar_kirim"<?php echo $report_rekap_summary->keluar_kirim->cellAttributes() ?>></td>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
		<td data-field="id_terimagudang"<?php echo $report_rekap_summary->id_terimagudang->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $report_rekap_summary->rowAttributes() ?>><td colspan="<?php echo ($report_rekap_summary->GroupColumnCount + $report_rekap_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($report_rekap_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $report_rekap_summary->rowAttributes() ?>>
<?php if ($report_rekap_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $report_rekap_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($report_rekap_summary->id_klinik->Visible) { ?>
		<td data-field="id_klinik"<?php echo $report_rekap_summary->id_klinik->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->tanggal->Visible) { ?>
		<td data-field="tanggal"<?php echo $report_rekap_summary->tanggal->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->stok_awal->Visible) { ?>
		<td data-field="stok_awal"<?php echo $report_rekap_summary->stok_awal->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->stok_awal->viewAttributes() ?>><?php echo $report_rekap_summary->stok_awal->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->masuk->Visible) { ?>
		<td data-field="masuk"<?php echo $report_rekap_summary->masuk->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->masuk->viewAttributes() ?>><?php echo $report_rekap_summary->masuk->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar->Visible) { ?>
		<td data-field="keluar"<?php echo $report_rekap_summary->keluar->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->keluar->viewAttributes() ?>><?php echo $report_rekap_summary->keluar->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->retur->Visible) { ?>
		<td data-field="retur"<?php echo $report_rekap_summary->retur->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->retur->viewAttributes() ?>><?php echo $report_rekap_summary->retur->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->stok_akhir->Visible) { ?>
		<td data-field="stok_akhir"<?php echo $report_rekap_summary->stok_akhir->cellAttributes() ?>>
<span<?php echo $report_rekap_summary->stok_akhir->viewAttributes() ?>><?php echo $report_rekap_summary->stok_akhir->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($report_rekap_summary->id_penyesuaian->Visible) { ?>
		<td data-field="id_penyesuaian"<?php echo $report_rekap_summary->id_penyesuaian->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_nonjual->Visible) { ?>
		<td data-field="id_nonjual"<?php echo $report_rekap_summary->id_nonjual->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_nonjual->Visible) { ?>
		<td data-field="keluar_nonjual"<?php echo $report_rekap_summary->keluar_nonjual->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->masuk_penyesuaian->Visible) { ?>
		<td data-field="masuk_penyesuaian"<?php echo $report_rekap_summary->masuk_penyesuaian->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_penyesuaian->Visible) { ?>
		<td data-field="keluar_penyesuaian"<?php echo $report_rekap_summary->keluar_penyesuaian->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_kirimbarang->Visible) { ?>
		<td data-field="id_kirimbarang"<?php echo $report_rekap_summary->id_kirimbarang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->keluar_kirim->Visible) { ?>
		<td data-field="keluar_kirim"<?php echo $report_rekap_summary->keluar_kirim->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($report_rekap_summary->id_terimagudang->Visible) { ?>
		<td data-field="id_terimagudang"<?php echo $report_rekap_summary->id_terimagudang->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($report_rekap_summary->TotalGroups > 0) { ?>
<?php if (!$report_rekap_summary->isExport() && !($report_rekap_summary->DrillDown && $report_rekap_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $report_rekap_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$report_rekap_summary->isExport() || $report_rekap_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$report_rekap_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$report_rekap_summary->isExport() && !$report_rekap_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$report_rekap_summary->terminate();
?>