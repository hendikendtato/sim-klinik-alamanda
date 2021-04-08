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
$kartustok_preview = new kartustok_preview();

// Run the page
$kartustok_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartustok_preview->Page_Render();
?>
<?php $kartustok_preview->showPageHeader(); ?>
<?php if ($kartustok_preview->TotalRecords > 0) { ?>
<div class="card ew-grid kartustok"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$kartustok_preview->renderListOptions();

// Render list options (header, left)
$kartustok_preview->ListOptions->render("header", "left");
?>
<?php if ($kartustok_preview->id_barang->Visible) { // id_barang ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_barang) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_barang->headerCellClass() ?>"><?php echo $kartustok_preview->id_barang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_barang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_barang->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_barang->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_barang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_barang->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_klinik->Visible) { // id_klinik ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_klinik) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_klinik->headerCellClass() ?>"><?php echo $kartustok_preview->id_klinik->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_klinik->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_klinik->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_klinik->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_klinik->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_klinik->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->tanggal->Visible) { // tanggal ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->tanggal) == "") { ?>
		<th class="<?php echo $kartustok_preview->tanggal->headerCellClass() ?>"><?php echo $kartustok_preview->tanggal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->tanggal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->tanggal->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->tanggal->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->tanggal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->tanggal->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_terimabarang->Visible) { // id_terimabarang ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_terimabarang) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_terimabarang->headerCellClass() ?>"><?php echo $kartustok_preview->id_terimabarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_terimabarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_terimabarang->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_terimabarang->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_terimabarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_terimabarang->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_terimagudang->Visible) { // id_terimagudang ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_terimagudang) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_terimagudang->headerCellClass() ?>"><?php echo $kartustok_preview->id_terimagudang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_terimagudang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_terimagudang->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_terimagudang->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_terimagudang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_terimagudang->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_penjualan->Visible) { // id_penjualan ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_penjualan) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_penjualan->headerCellClass() ?>"><?php echo $kartustok_preview->id_penjualan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_penjualan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_penjualan->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_penjualan->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_penjualan->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_penjualan->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_kirimbarang->Visible) { // id_kirimbarang ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_kirimbarang) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_kirimbarang->headerCellClass() ?>"><?php echo $kartustok_preview->id_kirimbarang->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_kirimbarang->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_kirimbarang->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_kirimbarang->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_kirimbarang->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_kirimbarang->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_retur->Visible) { // id_retur ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_retur) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_retur->headerCellClass() ?>"><?php echo $kartustok_preview->id_retur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_retur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_retur->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_retur->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_retur->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->id_penyesuaian->Visible) { // id_penyesuaian ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->id_penyesuaian) == "") { ?>
		<th class="<?php echo $kartustok_preview->id_penyesuaian->headerCellClass() ?>"><?php echo $kartustok_preview->id_penyesuaian->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->id_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->id_penyesuaian->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->id_penyesuaian->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->id_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->id_penyesuaian->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->stok_awal->Visible) { // stok_awal ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->stok_awal) == "") { ?>
		<th class="<?php echo $kartustok_preview->stok_awal->headerCellClass() ?>"><?php echo $kartustok_preview->stok_awal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->stok_awal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->stok_awal->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->stok_awal->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->stok_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->stok_awal->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->masuk->Visible) { // masuk ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->masuk) == "") { ?>
		<th class="<?php echo $kartustok_preview->masuk->headerCellClass() ?>"><?php echo $kartustok_preview->masuk->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->masuk->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->masuk->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->masuk->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->masuk->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->masuk->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->masuk_penyesuaian) == "") { ?>
		<th class="<?php echo $kartustok_preview->masuk_penyesuaian->headerCellClass() ?>"><?php echo $kartustok_preview->masuk_penyesuaian->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->masuk_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->masuk_penyesuaian->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->masuk_penyesuaian->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->masuk_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->masuk_penyesuaian->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->keluar->Visible) { // keluar ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->keluar) == "") { ?>
		<th class="<?php echo $kartustok_preview->keluar->headerCellClass() ?>"><?php echo $kartustok_preview->keluar->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->keluar->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->keluar->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->keluar->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->keluar->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->keluar->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->keluar_nonjual->Visible) { // keluar_nonjual ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->keluar_nonjual) == "") { ?>
		<th class="<?php echo $kartustok_preview->keluar_nonjual->headerCellClass() ?>"><?php echo $kartustok_preview->keluar_nonjual->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->keluar_nonjual->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->keluar_nonjual->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->keluar_nonjual->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->keluar_nonjual->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->keluar_nonjual->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->keluar_penyesuaian) == "") { ?>
		<th class="<?php echo $kartustok_preview->keluar_penyesuaian->headerCellClass() ?>"><?php echo $kartustok_preview->keluar_penyesuaian->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->keluar_penyesuaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->keluar_penyesuaian->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->keluar_penyesuaian->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->keluar_penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->keluar_penyesuaian->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->keluar_kirim->Visible) { // keluar_kirim ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->keluar_kirim) == "") { ?>
		<th class="<?php echo $kartustok_preview->keluar_kirim->headerCellClass() ?>"><?php echo $kartustok_preview->keluar_kirim->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->keluar_kirim->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->keluar_kirim->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->keluar_kirim->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->keluar_kirim->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->keluar_kirim->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->retur->Visible) { // retur ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->retur) == "") { ?>
		<th class="<?php echo $kartustok_preview->retur->headerCellClass() ?>"><?php echo $kartustok_preview->retur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->retur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->retur->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->retur->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->retur->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->retur->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($kartustok_preview->stok_akhir->Visible) { // stok_akhir ?>
	<?php if ($kartustok->SortUrl($kartustok_preview->stok_akhir) == "") { ?>
		<th class="<?php echo $kartustok_preview->stok_akhir->headerCellClass() ?>"><?php echo $kartustok_preview->stok_akhir->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $kartustok_preview->stok_akhir->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($kartustok_preview->stok_akhir->Name) ?>" data-sort-order="<?php echo $kartustok_preview->SortField == $kartustok_preview->stok_akhir->Name && $kartustok_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $kartustok_preview->stok_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($kartustok_preview->SortField == $kartustok_preview->stok_akhir->Name) { ?><?php if ($kartustok_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($kartustok_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$kartustok_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$kartustok_preview->RecCount = 0;
$kartustok_preview->RowCount = 0;
while ($kartustok_preview->Recordset && !$kartustok_preview->Recordset->EOF) {

	// Init row class and style
	$kartustok_preview->RecCount++;
	$kartustok_preview->RowCount++;
	$kartustok_preview->CssStyle = "";
	$kartustok_preview->loadListRowValues($kartustok_preview->Recordset);

	// Render row
	$kartustok->RowType = ROWTYPE_PREVIEW; // Preview record
	$kartustok_preview->resetAttributes();
	$kartustok_preview->renderListRow();

	// Render list options
	$kartustok_preview->renderListOptions();
?>
	<tr <?php echo $kartustok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$kartustok_preview->ListOptions->render("body", "left", $kartustok_preview->RowCount);
?>
<?php if ($kartustok_preview->id_barang->Visible) { // id_barang ?>
		<!-- id_barang -->
		<td<?php echo $kartustok_preview->id_barang->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_barang->viewAttributes() ?>><?php echo $kartustok_preview->id_barang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_klinik->Visible) { // id_klinik ?>
		<!-- id_klinik -->
		<td<?php echo $kartustok_preview->id_klinik->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_klinik->viewAttributes() ?>><?php echo $kartustok_preview->id_klinik->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->tanggal->Visible) { // tanggal ?>
		<!-- tanggal -->
		<td<?php echo $kartustok_preview->tanggal->cellAttributes() ?>>
<span<?php echo $kartustok_preview->tanggal->viewAttributes() ?>><?php echo $kartustok_preview->tanggal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_terimabarang->Visible) { // id_terimabarang ?>
		<!-- id_terimabarang -->
		<td<?php echo $kartustok_preview->id_terimabarang->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_terimabarang->viewAttributes() ?>><?php echo $kartustok_preview->id_terimabarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_terimagudang->Visible) { // id_terimagudang ?>
		<!-- id_terimagudang -->
		<td<?php echo $kartustok_preview->id_terimagudang->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_terimagudang->viewAttributes() ?>><?php echo $kartustok_preview->id_terimagudang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_penjualan->Visible) { // id_penjualan ?>
		<!-- id_penjualan -->
		<td<?php echo $kartustok_preview->id_penjualan->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_penjualan->viewAttributes() ?>><?php echo $kartustok_preview->id_penjualan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_kirimbarang->Visible) { // id_kirimbarang ?>
		<!-- id_kirimbarang -->
		<td<?php echo $kartustok_preview->id_kirimbarang->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_kirimbarang->viewAttributes() ?>><?php echo $kartustok_preview->id_kirimbarang->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_retur->Visible) { // id_retur ?>
		<!-- id_retur -->
		<td<?php echo $kartustok_preview->id_retur->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_retur->viewAttributes() ?>><?php echo $kartustok_preview->id_retur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->id_penyesuaian->Visible) { // id_penyesuaian ?>
		<!-- id_penyesuaian -->
		<td<?php echo $kartustok_preview->id_penyesuaian->cellAttributes() ?>>
<span<?php echo $kartustok_preview->id_penyesuaian->viewAttributes() ?>><?php echo $kartustok_preview->id_penyesuaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->stok_awal->Visible) { // stok_awal ?>
		<!-- stok_awal -->
		<td<?php echo $kartustok_preview->stok_awal->cellAttributes() ?>>
<span<?php echo $kartustok_preview->stok_awal->viewAttributes() ?>><?php echo $kartustok_preview->stok_awal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->masuk->Visible) { // masuk ?>
		<!-- masuk -->
		<td<?php echo $kartustok_preview->masuk->cellAttributes() ?>>
<span<?php echo $kartustok_preview->masuk->viewAttributes() ?>><?php echo $kartustok_preview->masuk->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->masuk_penyesuaian->Visible) { // masuk_penyesuaian ?>
		<!-- masuk_penyesuaian -->
		<td<?php echo $kartustok_preview->masuk_penyesuaian->cellAttributes() ?>>
<span<?php echo $kartustok_preview->masuk_penyesuaian->viewAttributes() ?>><?php echo $kartustok_preview->masuk_penyesuaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->keluar->Visible) { // keluar ?>
		<!-- keluar -->
		<td<?php echo $kartustok_preview->keluar->cellAttributes() ?>>
<span<?php echo $kartustok_preview->keluar->viewAttributes() ?>><?php echo $kartustok_preview->keluar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->keluar_nonjual->Visible) { // keluar_nonjual ?>
		<!-- keluar_nonjual -->
		<td<?php echo $kartustok_preview->keluar_nonjual->cellAttributes() ?>>
<span<?php echo $kartustok_preview->keluar_nonjual->viewAttributes() ?>><?php echo $kartustok_preview->keluar_nonjual->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->keluar_penyesuaian->Visible) { // keluar_penyesuaian ?>
		<!-- keluar_penyesuaian -->
		<td<?php echo $kartustok_preview->keluar_penyesuaian->cellAttributes() ?>>
<span<?php echo $kartustok_preview->keluar_penyesuaian->viewAttributes() ?>><?php echo $kartustok_preview->keluar_penyesuaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->keluar_kirim->Visible) { // keluar_kirim ?>
		<!-- keluar_kirim -->
		<td<?php echo $kartustok_preview->keluar_kirim->cellAttributes() ?>>
<span<?php echo $kartustok_preview->keluar_kirim->viewAttributes() ?>><?php echo $kartustok_preview->keluar_kirim->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->retur->Visible) { // retur ?>
		<!-- retur -->
		<td<?php echo $kartustok_preview->retur->cellAttributes() ?>>
<span<?php echo $kartustok_preview->retur->viewAttributes() ?>><?php echo $kartustok_preview->retur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($kartustok_preview->stok_akhir->Visible) { // stok_akhir ?>
		<!-- stok_akhir -->
		<td<?php echo $kartustok_preview->stok_akhir->cellAttributes() ?>>
<span<?php echo $kartustok_preview->stok_akhir->viewAttributes() ?>><?php echo $kartustok_preview->stok_akhir->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$kartustok_preview->ListOptions->render("body", "right", $kartustok_preview->RowCount);
?>
	</tr>
<?php
	$kartustok_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $kartustok_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($kartustok_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($kartustok_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$kartustok_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($kartustok_preview->Recordset)
	$kartustok_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$kartustok_preview->terminate();
?>