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
WriteHeader(FALSE);

// Create page object
$m_pelanggan_list = new m_pelanggan_list();

// Run the page
$m_pelanggan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pelanggan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_pelanggan_list->isExport()) { ?>
<script>
var fm_pelangganlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_pelangganlist = currentForm = new ew.Form("fm_pelangganlist", "list");
	fm_pelangganlist.formKeyCountName = '<?php echo $m_pelanggan_list->FormKeyCountName ?>';
	loadjs.done("fm_pelangganlist");
});
var fm_pelangganlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_pelangganlistsrch = currentSearchForm = new ew.Form("fm_pelangganlistsrch");

	// Dynamic selection lists
	// Filters

	fm_pelangganlistsrch.filterList = <?php echo $m_pelanggan_list->getFilterList() ?>;
	loadjs.done("fm_pelangganlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "right" : "left";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	$("#checkStatusPelanggan").click(function(){Swal.fire({title:"Apakah Anda yakin!",html:"Untuk Pengecekan Status Pelanggan Akan Memakan Waktu yang lama! <br> Perkiraan waktu Pengecekan kurang lebih 1 Jam",icon:"warning",showCancelButton:!0,confirmButtonText:"Check",showLoaderOnConfirm:!0,allowOutsideClick:!1,preConfirm:a=>{Swal.fire({title:"Mohon Tunggu !",html:"Sedang Mengecek Data Pelanggan <br> Mohon jangan melakukan aktivitas lain!",allowOutsideClick:!1,showCancelButton:!1,showConfirmButton:!1,onBeforeOpen:()=>{Swal.showLoading(),$.get(base_url+"api?action=checkBulanan",function(a){a.isChecked?Swal.fire("Berhasil!",a.message+" <br> Pada Waktu : "+a.data.tglwaktu_update,"success"):$.get(base_url+"api?action=checkPelangganStatus",function(a){a.success?(Swal.fire("Berhasil!",a.message,"success"),location.reload()):Swal.fire("Perhatian!",a.message,"warning")})})}})}})});
});
</script>
<?php } ?>
<?php if (!$m_pelanggan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_pelanggan_list->TotalRecords > 0 && $m_pelanggan_list->ExportOptions->visible()) { ?>
<?php $m_pelanggan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_pelanggan_list->ImportOptions->visible()) { ?>
<?php $m_pelanggan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_pelanggan_list->SearchOptions->visible()) { ?>
<?php $m_pelanggan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_pelanggan_list->FilterOptions->visible()) { ?>
<?php $m_pelanggan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_pelanggan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_pelanggan_list->isExport() && !$m_pelanggan->CurrentAction) { ?>
<form name="fm_pelangganlistsrch" id="fm_pelangganlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_pelangganlistsrch-search-panel" class="<?php echo $m_pelanggan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_pelanggan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $m_pelanggan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($m_pelanggan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($m_pelanggan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $m_pelanggan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($m_pelanggan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($m_pelanggan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($m_pelanggan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($m_pelanggan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_pelanggan_list->showPageHeader(); ?>
<?php
$m_pelanggan_list->showMessage();
?>
<?php if ($m_pelanggan_list->TotalRecords > 0 || $m_pelanggan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_pelanggan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_pelanggan">
<?php if (!$m_pelanggan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_pelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_pelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_pelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_pelangganlist" id="fm_pelangganlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pelanggan">
<div id="gmp_m_pelanggan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_pelanggan_list->TotalRecords > 0 || $m_pelanggan_list->isGridEdit()) { ?>
<table id="tbl_m_pelangganlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_pelanggan->RowType = ROWTYPE_HEADER;

// Render list options
$m_pelanggan_list->renderListOptions();

// Render list options (header, left)
$m_pelanggan_list->ListOptions->render("header", "left");
?>
<?php if ($m_pelanggan_list->id_pelanggan->Visible) { // id_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->id_pelanggan) == "") { ?>
		<th data-name="id_pelanggan" class="<?php echo $m_pelanggan_list->id_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_id_pelanggan" class="m_pelanggan_id_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->id_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pelanggan" class="<?php echo $m_pelanggan_list->id_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->id_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_id_pelanggan" class="m_pelanggan_id_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->id_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->id_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->id_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->kode_pelanggan->Visible) { // kode_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->kode_pelanggan) == "") { ?>
		<th data-name="kode_pelanggan" class="<?php echo $m_pelanggan_list->kode_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_kode_pelanggan" class="m_pelanggan_kode_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->kode_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kode_pelanggan" class="<?php echo $m_pelanggan_list->kode_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->kode_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_kode_pelanggan" class="m_pelanggan_kode_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->kode_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->kode_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->kode_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->noktp_pelanggan) == "") { ?>
		<th data-name="noktp_pelanggan" class="<?php echo $m_pelanggan_list->noktp_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_noktp_pelanggan" class="m_pelanggan_noktp_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->noktp_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noktp_pelanggan" class="<?php echo $m_pelanggan_list->noktp_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->noktp_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_noktp_pelanggan" class="m_pelanggan_noktp_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->noktp_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->noktp_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->noktp_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->nama_pelanggan->Visible) { // nama_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->nama_pelanggan) == "") { ?>
		<th data-name="nama_pelanggan" class="<?php echo $m_pelanggan_list->nama_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_nama_pelanggan" class="m_pelanggan_nama_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->nama_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_pelanggan" class="<?php echo $m_pelanggan_list->nama_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->nama_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_nama_pelanggan" class="m_pelanggan_nama_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->nama_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->nama_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->nama_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->jenis_pelanggan) == "") { ?>
		<th data-name="jenis_pelanggan" class="<?php echo $m_pelanggan_list->jenis_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_jenis_pelanggan" class="m_pelanggan_jenis_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->jenis_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_pelanggan" class="<?php echo $m_pelanggan_list->jenis_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->jenis_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_jenis_pelanggan" class="m_pelanggan_jenis_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->jenis_pelanggan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->jenis_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->jenis_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->alamat_pelanggan) == "") { ?>
		<th data-name="alamat_pelanggan" class="<?php echo $m_pelanggan_list->alamat_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_alamat_pelanggan" class="m_pelanggan_alamat_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->alamat_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat_pelanggan" class="<?php echo $m_pelanggan_list->alamat_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->alamat_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_alamat_pelanggan" class="m_pelanggan_alamat_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->alamat_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->alamat_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->alamat_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->telpon_pelanggan) == "") { ?>
		<th data-name="telpon_pelanggan" class="<?php echo $m_pelanggan_list->telpon_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_telpon_pelanggan" class="m_pelanggan_telpon_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->telpon_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telpon_pelanggan" class="<?php echo $m_pelanggan_list->telpon_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->telpon_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_telpon_pelanggan" class="m_pelanggan_telpon_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->telpon_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->telpon_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->telpon_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->hp_pelanggan->Visible) { // hp_pelanggan ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->hp_pelanggan) == "") { ?>
		<th data-name="hp_pelanggan" class="<?php echo $m_pelanggan_list->hp_pelanggan->headerCellClass() ?>"><div id="elh_m_pelanggan_hp_pelanggan" class="m_pelanggan_hp_pelanggan"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->hp_pelanggan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp_pelanggan" class="<?php echo $m_pelanggan_list->hp_pelanggan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->hp_pelanggan) ?>', 1);"><div id="elh_m_pelanggan_hp_pelanggan" class="m_pelanggan_hp_pelanggan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->hp_pelanggan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->hp_pelanggan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->hp_pelanggan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->tgl_daftar->Visible) { // tgl_daftar ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->tgl_daftar) == "") { ?>
		<th data-name="tgl_daftar" class="<?php echo $m_pelanggan_list->tgl_daftar->headerCellClass() ?>"><div id="elh_m_pelanggan_tgl_daftar" class="m_pelanggan_tgl_daftar"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->tgl_daftar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_daftar" class="<?php echo $m_pelanggan_list->tgl_daftar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->tgl_daftar) ?>', 1);"><div id="elh_m_pelanggan_tgl_daftar" class="m_pelanggan_tgl_daftar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->tgl_daftar->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->tgl_daftar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->tgl_daftar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->kategori->Visible) { // kategori ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->kategori) == "") { ?>
		<th data-name="kategori" class="<?php echo $m_pelanggan_list->kategori->headerCellClass() ?>"><div id="elh_m_pelanggan_kategori" class="m_pelanggan_kategori"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->kategori->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kategori" class="<?php echo $m_pelanggan_list->kategori->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->kategori) ?>', 1);"><div id="elh_m_pelanggan_kategori" class="m_pelanggan_kategori">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->kategori->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->kategori->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->kategori->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pelanggan_list->tipe->Visible) { // tipe ?>
	<?php if ($m_pelanggan_list->SortUrl($m_pelanggan_list->tipe) == "") { ?>
		<th data-name="tipe" class="<?php echo $m_pelanggan_list->tipe->headerCellClass() ?>"><div id="elh_m_pelanggan_tipe" class="m_pelanggan_tipe"><div class="ew-table-header-caption"><?php echo $m_pelanggan_list->tipe->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipe" class="<?php echo $m_pelanggan_list->tipe->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pelanggan_list->SortUrl($m_pelanggan_list->tipe) ?>', 1);"><div id="elh_m_pelanggan_tipe" class="m_pelanggan_tipe">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pelanggan_list->tipe->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pelanggan_list->tipe->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pelanggan_list->tipe->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_pelanggan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_pelanggan_list->ExportAll && $m_pelanggan_list->isExport()) {
	$m_pelanggan_list->StopRecord = $m_pelanggan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_pelanggan_list->TotalRecords > $m_pelanggan_list->StartRecord + $m_pelanggan_list->DisplayRecords - 1)
		$m_pelanggan_list->StopRecord = $m_pelanggan_list->StartRecord + $m_pelanggan_list->DisplayRecords - 1;
	else
		$m_pelanggan_list->StopRecord = $m_pelanggan_list->TotalRecords;
}
$m_pelanggan_list->RecordCount = $m_pelanggan_list->StartRecord - 1;
if ($m_pelanggan_list->Recordset && !$m_pelanggan_list->Recordset->EOF) {
	$m_pelanggan_list->Recordset->moveFirst();
	$selectLimit = $m_pelanggan_list->UseSelectLimit;
	if (!$selectLimit && $m_pelanggan_list->StartRecord > 1)
		$m_pelanggan_list->Recordset->move($m_pelanggan_list->StartRecord - 1);
} elseif (!$m_pelanggan->AllowAddDeleteRow && $m_pelanggan_list->StopRecord == 0) {
	$m_pelanggan_list->StopRecord = $m_pelanggan->GridAddRowCount;
}

// Initialize aggregate
$m_pelanggan->RowType = ROWTYPE_AGGREGATEINIT;
$m_pelanggan->resetAttributes();
$m_pelanggan_list->renderRow();
while ($m_pelanggan_list->RecordCount < $m_pelanggan_list->StopRecord) {
	$m_pelanggan_list->RecordCount++;
	if ($m_pelanggan_list->RecordCount >= $m_pelanggan_list->StartRecord) {
		$m_pelanggan_list->RowCount++;

		// Set up key count
		$m_pelanggan_list->KeyCount = $m_pelanggan_list->RowIndex;

		// Init row class and style
		$m_pelanggan->resetAttributes();
		$m_pelanggan->CssClass = "";
		if ($m_pelanggan_list->isGridAdd()) {
		} else {
			$m_pelanggan_list->loadRowValues($m_pelanggan_list->Recordset); // Load row values
		}
		$m_pelanggan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_pelanggan->RowAttrs->merge(["data-rowindex" => $m_pelanggan_list->RowCount, "id" => "r" . $m_pelanggan_list->RowCount . "_m_pelanggan", "data-rowtype" => $m_pelanggan->RowType]);

		// Render row
		$m_pelanggan_list->renderRow();

		// Render list options
		$m_pelanggan_list->renderListOptions();
?>
	<tr <?php echo $m_pelanggan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_pelanggan_list->ListOptions->render("body", "left", $m_pelanggan_list->RowCount);
?>
	<?php if ($m_pelanggan_list->id_pelanggan->Visible) { // id_pelanggan ?>
		<td data-name="id_pelanggan" <?php echo $m_pelanggan_list->id_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_id_pelanggan">
<span<?php echo $m_pelanggan_list->id_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->id_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->kode_pelanggan->Visible) { // kode_pelanggan ?>
		<td data-name="kode_pelanggan" <?php echo $m_pelanggan_list->kode_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_kode_pelanggan">
<span<?php echo $m_pelanggan_list->kode_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->kode_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->noktp_pelanggan->Visible) { // noktp_pelanggan ?>
		<td data-name="noktp_pelanggan" <?php echo $m_pelanggan_list->noktp_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_noktp_pelanggan">
<span<?php echo $m_pelanggan_list->noktp_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->noktp_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->nama_pelanggan->Visible) { // nama_pelanggan ?>
		<td data-name="nama_pelanggan" <?php echo $m_pelanggan_list->nama_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_nama_pelanggan">
<span<?php echo $m_pelanggan_list->nama_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->nama_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->jenis_pelanggan->Visible) { // jenis_pelanggan ?>
		<td data-name="jenis_pelanggan" <?php echo $m_pelanggan_list->jenis_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_jenis_pelanggan">
<span<?php echo $m_pelanggan_list->jenis_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->jenis_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->alamat_pelanggan->Visible) { // alamat_pelanggan ?>
		<td data-name="alamat_pelanggan" <?php echo $m_pelanggan_list->alamat_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_alamat_pelanggan">
<span<?php echo $m_pelanggan_list->alamat_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->alamat_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->telpon_pelanggan->Visible) { // telpon_pelanggan ?>
		<td data-name="telpon_pelanggan" <?php echo $m_pelanggan_list->telpon_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_telpon_pelanggan">
<span<?php echo $m_pelanggan_list->telpon_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->telpon_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->hp_pelanggan->Visible) { // hp_pelanggan ?>
		<td data-name="hp_pelanggan" <?php echo $m_pelanggan_list->hp_pelanggan->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_hp_pelanggan">
<span<?php echo $m_pelanggan_list->hp_pelanggan->viewAttributes() ?>><?php echo $m_pelanggan_list->hp_pelanggan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->tgl_daftar->Visible) { // tgl_daftar ?>
		<td data-name="tgl_daftar" <?php echo $m_pelanggan_list->tgl_daftar->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_tgl_daftar">
<span<?php echo $m_pelanggan_list->tgl_daftar->viewAttributes() ?>><?php echo $m_pelanggan_list->tgl_daftar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->kategori->Visible) { // kategori ?>
		<td data-name="kategori" <?php echo $m_pelanggan_list->kategori->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_kategori">
<span<?php echo $m_pelanggan_list->kategori->viewAttributes() ?>><?php echo $m_pelanggan_list->kategori->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pelanggan_list->tipe->Visible) { // tipe ?>
		<td data-name="tipe" <?php echo $m_pelanggan_list->tipe->cellAttributes() ?>>
<span id="el<?php echo $m_pelanggan_list->RowCount ?>_m_pelanggan_tipe">
<span<?php echo $m_pelanggan_list->tipe->viewAttributes() ?>><?php echo $m_pelanggan_list->tipe->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_pelanggan_list->ListOptions->render("body", "right", $m_pelanggan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_pelanggan_list->isGridAdd())
		$m_pelanggan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_pelanggan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_pelanggan_list->Recordset)
	$m_pelanggan_list->Recordset->Close();
?>
<?php if (!$m_pelanggan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_pelanggan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_pelanggan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_pelanggan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_pelanggan_list->TotalRecords == 0 && !$m_pelanggan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_pelanggan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_pelanggan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_pelanggan_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$m_pelanggan_list->terminate();
?>