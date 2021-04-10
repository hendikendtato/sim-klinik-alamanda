<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for report_rekap
 */
class report_rekap extends ReportTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";
	public $ShowGroupHeaderAsRow = FALSE;
	public $ShowCompactSummaryFooter = TRUE;

	// Export
	public $ExportDoc;
	public $Chart_Tes;

	// Fields
	public $id_kartustok;
	public $id_barang;
	public $id_klinik;
	public $tanggal;
	public $id_terimabarang;
	public $id_penjualan;
	public $id_retur;
	public $stok_awal;
	public $masuk;
	public $keluar;
	public $retur;
	public $stok_akhir;
	public $id_penyesuaian;
	public $id_nonjual;
	public $keluar_nonjual;
	public $masuk_penyesuaian;
	public $keluar_penyesuaian;
	public $id_kirimbarang;
	public $keluar_kirim;
	public $id_terimagudang;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'report_rekap';
		$this->TableName = 'report_rekap';
		$this->TableType = 'REPORT';

		// Update Table
		$this->UpdateTable = "`kartustok`";
		$this->ReportSourceTable = 'kartustok'; // Report source table
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (report only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions

		// id_kartustok
		$this->id_kartustok = new ReportField('report_rekap', 'report_rekap', 'x_id_kartustok', 'id_kartustok', '`id_kartustok`', '`id_kartustok`', 3, 11, -1, FALSE, '`id_kartustok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_kartustok->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_kartustok->IsPrimaryKey = TRUE; // Primary key field
		$this->id_kartustok->Sortable = FALSE; // Allow sort
		$this->id_kartustok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_kartustok->SourceTableVar = 'kartustok';
		$this->fields['id_kartustok'] = &$this->id_kartustok;

		// id_barang
		$this->id_barang = new ReportField('report_rekap', 'report_rekap', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_barang->GroupingFieldId = 1;
		$this->id_barang->ShowGroupHeaderAsRow = $this->ShowGroupHeaderAsRow;
		$this->id_barang->ShowCompactSummaryFooter = $this->ShowCompactSummaryFooter;
		$this->id_barang->GroupByType = "";
		$this->id_barang->GroupInterval = "0";
		$this->id_barang->GroupSql = "";
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_barang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_barang->Lookup = new Lookup('id_barang', 'm_barang', FALSE, 'id', ["nama_barang","","",""], [], [], [], [], [], [], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_barang->SourceTableVar = 'kartustok';
		$this->fields['id_barang'] = &$this->id_barang;

		// id_klinik
		$this->id_klinik = new ReportField('report_rekap', 'report_rekap', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_klinik->SourceTableVar = 'kartustok';
		$this->fields['id_klinik'] = &$this->id_klinik;

		// tanggal
		$this->tanggal = new ReportField('report_rekap', 'report_rekap', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 133, 10, 0, FALSE, '`tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal->Sortable = TRUE; // Allow sort
		$this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->tanggal->SourceTableVar = 'kartustok';
		$this->fields['tanggal'] = &$this->tanggal;

		// id_terimabarang
		$this->id_terimabarang = new ReportField('report_rekap', 'report_rekap', 'x_id_terimabarang', 'id_terimabarang', '`id_terimabarang`', '`id_terimabarang`', 3, 11, -1, FALSE, '`id_terimabarang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_terimabarang->Sortable = FALSE; // Allow sort
		$this->id_terimabarang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_terimabarang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_terimabarang->Lookup = new Lookup('id_terimabarang', 'terimabarang', FALSE, 'id', ["no_terima","","",""], [], [], [], [], [], [], '', '');
		$this->id_terimabarang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_terimabarang->SourceTableVar = 'kartustok';
		$this->fields['id_terimabarang'] = &$this->id_terimabarang;

		// id_penjualan
		$this->id_penjualan = new ReportField('report_rekap', 'report_rekap', 'x_id_penjualan', 'id_penjualan', '`id_penjualan`', '`id_penjualan`', 3, 11, -1, FALSE, '`id_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_penjualan->Sortable = FALSE; // Allow sort
		$this->id_penjualan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_penjualan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_penjualan->Lookup = new Lookup('id_penjualan', 'penjualan', FALSE, 'id', ["kode_penjualan","","",""], [], [], [], [], [], [], '', '');
		$this->id_penjualan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_penjualan->SourceTableVar = 'kartustok';
		$this->fields['id_penjualan'] = &$this->id_penjualan;

		// id_retur
		$this->id_retur = new ReportField('report_rekap', 'report_rekap', 'x_id_retur', 'id_retur', '`id_retur`', '`id_retur`', 3, 11, -1, FALSE, '`id_retur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_retur->Sortable = FALSE; // Allow sort
		$this->id_retur->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_retur->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_retur->Lookup = new Lookup('id_retur', 'returbarang', FALSE, 'id_retur', ["kode","","",""], [], [], [], [], [], [], '', '');
		$this->id_retur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_retur->SourceTableVar = 'kartustok';
		$this->fields['id_retur'] = &$this->id_retur;

		// stok_awal
		$this->stok_awal = new ReportField('report_rekap', 'report_rekap', 'x_stok_awal', 'stok_awal', '`stok_awal`', '`stok_awal`', 4, 12, -1, FALSE, '`stok_awal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok_awal->Sortable = TRUE; // Allow sort
		$this->stok_awal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->stok_awal->SourceTableVar = 'kartustok';
		$this->fields['stok_awal'] = &$this->stok_awal;

		// masuk
		$this->masuk = new ReportField('report_rekap', 'report_rekap', 'x_masuk', 'masuk', '`masuk`', '`masuk`', 5, 22, -1, FALSE, '`masuk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masuk->Sortable = TRUE; // Allow sort
		$this->masuk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->masuk->SourceTableVar = 'kartustok';
		$this->fields['masuk'] = &$this->masuk;

		// keluar
		$this->keluar = new ReportField('report_rekap', 'report_rekap', 'x_keluar', 'keluar', '`keluar`', '`keluar`', 5, 22, -1, FALSE, '`keluar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar->Sortable = TRUE; // Allow sort
		$this->keluar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->keluar->SourceTableVar = 'kartustok';
		$this->fields['keluar'] = &$this->keluar;

		// retur
		$this->retur = new ReportField('report_rekap', 'report_rekap', 'x_retur', 'retur', '`retur`', '`retur`', 5, 22, -1, FALSE, '`retur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retur->Sortable = TRUE; // Allow sort
		$this->retur->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->retur->SourceTableVar = 'kartustok';
		$this->fields['retur'] = &$this->retur;

		// stok_akhir
		$this->stok_akhir = new ReportField('report_rekap', 'report_rekap', 'x_stok_akhir', 'stok_akhir', '`stok_akhir`', '`stok_akhir`', 4, 12, -1, FALSE, '`stok_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok_akhir->Sortable = TRUE; // Allow sort
		$this->stok_akhir->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->stok_akhir->SourceTableVar = 'kartustok';
		$this->fields['stok_akhir'] = &$this->stok_akhir;

		// id_penyesuaian
		$this->id_penyesuaian = new ReportField('report_rekap', 'report_rekap', 'x_id_penyesuaian', 'id_penyesuaian', '`id_penyesuaian`', '`id_penyesuaian`', 3, 11, -1, FALSE, '`id_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_penyesuaian->Sortable = TRUE; // Allow sort
		$this->id_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_penyesuaian->SourceTableVar = 'kartustok';
		$this->fields['id_penyesuaian'] = &$this->id_penyesuaian;

		// id_nonjual
		$this->id_nonjual = new ReportField('report_rekap', 'report_rekap', 'x_id_nonjual', 'id_nonjual', '`id_nonjual`', '`id_nonjual`', 3, 11, -1, FALSE, '`id_nonjual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_nonjual->Sortable = TRUE; // Allow sort
		$this->id_nonjual->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_nonjual->SourceTableVar = 'kartustok';
		$this->fields['id_nonjual'] = &$this->id_nonjual;

		// keluar_nonjual
		$this->keluar_nonjual = new ReportField('report_rekap', 'report_rekap', 'x_keluar_nonjual', 'keluar_nonjual', '`keluar_nonjual`', '`keluar_nonjual`', 5, 22, -1, FALSE, '`keluar_nonjual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_nonjual->Sortable = TRUE; // Allow sort
		$this->keluar_nonjual->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->keluar_nonjual->SourceTableVar = 'kartustok';
		$this->fields['keluar_nonjual'] = &$this->keluar_nonjual;

		// masuk_penyesuaian
		$this->masuk_penyesuaian = new ReportField('report_rekap', 'report_rekap', 'x_masuk_penyesuaian', 'masuk_penyesuaian', '`masuk_penyesuaian`', '`masuk_penyesuaian`', 4, 12, -1, FALSE, '`masuk_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masuk_penyesuaian->Sortable = TRUE; // Allow sort
		$this->masuk_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->masuk_penyesuaian->SourceTableVar = 'kartustok';
		$this->fields['masuk_penyesuaian'] = &$this->masuk_penyesuaian;

		// keluar_penyesuaian
		$this->keluar_penyesuaian = new ReportField('report_rekap', 'report_rekap', 'x_keluar_penyesuaian', 'keluar_penyesuaian', '`keluar_penyesuaian`', '`keluar_penyesuaian`', 4, 12, -1, FALSE, '`keluar_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_penyesuaian->Sortable = TRUE; // Allow sort
		$this->keluar_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->keluar_penyesuaian->SourceTableVar = 'kartustok';
		$this->fields['keluar_penyesuaian'] = &$this->keluar_penyesuaian;

		// id_kirimbarang
		$this->id_kirimbarang = new ReportField('report_rekap', 'report_rekap', 'x_id_kirimbarang', 'id_kirimbarang', '`id_kirimbarang`', '`id_kirimbarang`', 3, 11, -1, FALSE, '`id_kirimbarang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_kirimbarang->Sortable = TRUE; // Allow sort
		$this->id_kirimbarang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_kirimbarang->SourceTableVar = 'kartustok';
		$this->fields['id_kirimbarang'] = &$this->id_kirimbarang;

		// keluar_kirim
		$this->keluar_kirim = new ReportField('report_rekap', 'report_rekap', 'x_keluar_kirim', 'keluar_kirim', '`keluar_kirim`', '`keluar_kirim`', 5, 22, -1, FALSE, '`keluar_kirim`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_kirim->Sortable = TRUE; // Allow sort
		$this->keluar_kirim->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->keluar_kirim->SourceTableVar = 'kartustok';
		$this->fields['keluar_kirim'] = &$this->keluar_kirim;

		// id_terimagudang
		$this->id_terimagudang = new ReportField('report_rekap', 'report_rekap', 'x_id_terimagudang', 'id_terimagudang', '`id_terimagudang`', '`id_terimagudang`', 3, 11, -1, FALSE, '`id_terimagudang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_terimagudang->Sortable = TRUE; // Allow sort
		$this->id_terimagudang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->id_terimagudang->SourceTableVar = 'kartustok';
		$this->fields['id_terimagudang'] = &$this->id_terimagudang;

		// Chart Tes
		$this->Chart_Tes = new DbChart($this, 'Chart_Tes', 'Chart Tes', 'id_barang', 'keluar', 1002, '', 0, 'SUM', 600, 500);
		$this->Chart_Tes->SortType = 1;
		$this->Chart_Tes->SortSequence = "";
		$this->Chart_Tes->SqlSelect = "SELECT `id_barang`, '', SUM(`keluar`) FROM ";
		$this->Chart_Tes->SqlGroupBy = "`id_barang`";
		$this->Chart_Tes->SqlOrderBy = "`id_barang` ASC";
		$this->Chart_Tes->SeriesDateType = "";
		$this->Chart_Tes->ID = "report_rekap_Chart_Tes"; // Chart ID
		$this->Chart_Tes->setParameters([
			["type", "1002"],
			["seriestype", "0"]
		]); // Chart type / Chart series type
		$this->Chart_Tes->setParameters([
			["caption", $this->Chart_Tes->caption()],
			["xaxisname", $this->Chart_Tes->xAxisName()]
		]); // Chart caption / X axis name
		$this->Chart_Tes->setParameter("yaxisname", $this->Chart_Tes->yAxisName()); // Y axis name
		$this->Chart_Tes->setParameters([
			["shownames", "1"],
			["showvalues", "1"],
			["showhovercap", "1"]
		]); // Show names / Show values / Show hover
		$this->Chart_Tes->setParameter("alpha", "50"); // Chart alpha
		$this->Chart_Tes->setParameter("colorpalette", "#5899DA,#E8743B,#19A979,#ED4A7B,#945ECF,#13A4B4,#525DF4,#BF399E,#6C8893,#EE6868,#2F6497"); // Chart color palette
		$this->Chart_Tes->setParameters([["options.legend.display",false],["options.legend.fullWidth",false],["options.legend.reverse",false],["options.legend.labels.usePointStyle",false],["options.title.display",false],["options.tooltips.enabled",false],["options.tooltips.intersect",false],["options.tooltips.displayColors",false],["options.plugins.filler.propagate",false],["options.animation.animateRotate",false],["options.animation.animateScale",false],["dataset.showLine",false],["dataset.spanGaps",false],["dataset.steppedLine",false],["scale.gridLines.offsetGridLines",false]]);
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Single column sort
	protected function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			if ($fld->GroupingFieldId == 0)
				$this->setDetailOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			if ($fld->GroupingFieldId == 0) $fld->setSort("");
		}
	}

	// Get Sort SQL
	protected function sortSql()
	{
		$dtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = [];
		foreach ($this->fields as $fld) {
			if ($fld->getSort() != "") {
				$fldsql = $fld->Expression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->GroupSql != "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->GroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sortSql = "";
		foreach ($argrps as $grp) {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $grp;
		}
		if ($dtlSortSql != "") {
			if ($sortSql != "") $sortSql .= ", ";
			$sortSql .= $dtlSortSql;
		}
		return $sortSql;
	}

	// Table Level Group SQL
	private $_sqlFirstGroupField = "";
	private $_sqlSelectGroup = "";
	private $_sqlOrderByGroup = "";

	// First Group Field
	public function getSqlFirstGroupField($alias = FALSE)
	{
		if ($this->_sqlFirstGroupField != "")
			return $this->_sqlFirstGroupField;
		$firstGroupField = &$this->id_barang;
		$expr = $firstGroupField->Expression;
		if ($firstGroupField->GroupSql != "") {
			$expr = str_replace("%s", $firstGroupField->Expression, $firstGroupField->GroupSql);
			if ($alias)
				$expr .= " AS " . QuotedName($firstGroupField->getGroupName(), $this->Dbid);
		}
		return $expr;
	}
	public function setSqlFirstGroupField($v)
	{
		$this->_sqlFirstGroupField = $v;
	}

	// Select Group
	public function getSqlSelectGroup()
	{
		return ($this->_sqlSelectGroup != "") ? $this->_sqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField(TRUE) . " FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectGroup($v)
	{
		$this->_sqlSelectGroup = $v;
	}

	// Order By Group
	public function getSqlOrderByGroup()
	{
		if ($this->_sqlOrderByGroup != "")
			return $this->_sqlOrderByGroup;
		return $this->getSqlFirstGroupField() . " ASC";
	}
	public function setSqlOrderByGroup($v)
	{
		$this->_sqlOrderByGroup = $v;
	}

	// Summary properties
	private $_sqlSelectAggregate = "";
	private $_sqlAggregatePrefix = "";
	private $_sqlAggregateSuffix = "";
	private $_sqlSelectCount = "";

	// Select Aggregate
	public function getSqlSelectAggregate()
	{
		return ($this->_sqlSelectAggregate != "") ? $this->_sqlSelectAggregate : "SELECT SUM(`stok_awal`) AS `sum_stok_awal`, SUM(`masuk`) AS `sum_masuk`, SUM(`keluar`) AS `sum_keluar`, SUM(`retur`) AS `sum_retur`, SUM(`stok_akhir`) AS `sum_stok_akhir` FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectAggregate($v)
	{
		$this->_sqlSelectAggregate = $v;
	}

	// Aggregate Prefix
	public function getSqlAggregatePrefix()
	{
		return ($this->_sqlAggregatePrefix != "") ? $this->_sqlAggregatePrefix : "";
	}
	public function setSqlAggregatePrefix($v)
	{
		$this->_sqlAggregatePrefix = $v;
	}

	// Aggregate Suffix
	public function getSqlAggregateSuffix()
	{
		return ($this->_sqlAggregateSuffix != "") ? $this->_sqlAggregateSuffix : "";
	}
	public function setSqlAggregateSuffix($v)
	{
		$this->_sqlAggregateSuffix = $v;
	}

	// Select Count
	public function getSqlSelectCount()
	{
		return ($this->_sqlSelectCount != "") ? $this->_sqlSelectCount : "SELECT COUNT(*) FROM " . $this->getSqlFrom();
	}
	public function setSqlSelectCount($v)
	{
		$this->_sqlSelectCount = $v;
	}

	// Render for lookup
	public function renderLookup()
	{
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`kartustok`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		if ($this->SqlSelect != "")
			return $this->SqlSelect;
		$select = "*";
		$groupField = &$this->id_barang;
		if ($groupField->GroupSql != "") {
			$expr = str_replace("%s", $groupField->Expression, $groupField->GroupSql) . " AS " . QuotedName($groupField->getGroupName(), $this->Dbid);
			$select .= ", " . $expr;
		}
		return "SELECT " . $select . " FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_kartustok` = @id_kartustok@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_kartustok', $row) ? $row['id_kartustok'] : NULL;
		else
			$val = $this->id_kartustok->OldValue !== NULL ? $this->id_kartustok->OldValue : $this->id_kartustok->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_kartustok@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "")
			return $Language->phrase("View");
		elseif ($pageName == "")
			return $Language->phrase("Edit");
		elseif ($pageName == "")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "?" . $this->getUrlParm($parm);
		else
			$url = "";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_kartustok:" . JsonEncode($this->id_kartustok->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id_kartustok->CurrentValue != NULL) {
			$url .= "id_kartustok=" . urlencode($this->id_kartustok->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		global $DashboardReport;
		if ($this->CurrentAction || $this->isExport() ||
			$this->DrillDown || $DashboardReport ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id_kartustok") !== NULL)
				$arKeys[] = Param("id_kartustok");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id_kartustok->CurrentValue = $key;
			else
				$this->id_kartustok->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>