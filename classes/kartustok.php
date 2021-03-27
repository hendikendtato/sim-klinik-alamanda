<?php namespace PHPMaker2020\klinik_latest_26_03_21; ?>
<?php

/**
 * Table class for kartustok
 */
class kartustok extends DbTable
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

	// Export
	public $ExportDoc;

	// Fields
	public $id_kartustok;
	public $id_barang;
	public $id_klinik;
	public $tanggal;
	public $id_terimabarang;
	public $id_penjualan;
	public $id_kirimbarang;
	public $id_nonjual;
	public $id_retur;
	public $id_penyesuaian;
	public $stok_awal;
	public $masuk;
	public $masuk_penyesuaian;
	public $keluar;
	public $keluar_nonjual;
	public $keluar_penyesuaian;
	public $keluar_kirim;
	public $retur;
	public $stok_akhir;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'kartustok';
		$this->TableName = 'kartustok';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`kartustok`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id_kartustok
		$this->id_kartustok = new DbField('kartustok', 'kartustok', 'x_id_kartustok', 'id_kartustok', '`id_kartustok`', '`id_kartustok`', 3, 11, -1, FALSE, '`id_kartustok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_kartustok->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_kartustok->IsPrimaryKey = TRUE; // Primary key field
		$this->id_kartustok->Sortable = TRUE; // Allow sort
		$this->id_kartustok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartustok'] = &$this->id_kartustok;

		// id_barang
		$this->id_barang = new DbField('kartustok', 'kartustok', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->IsForeignKey = TRUE; // Foreign key field
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->Lookup = new Lookup('id_barang', 'm_barang', FALSE, 'id', ["nama_barang","","",""], [], [], [], [], [], [], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// id_klinik
		$this->id_klinik = new DbField('kartustok', 'kartustok', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// tanggal
		$this->tanggal = new DbField('kartustok', 'kartustok', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 133, 10, 0, FALSE, '`tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal->Sortable = TRUE; // Allow sort
		$this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tanggal'] = &$this->tanggal;

		// id_terimabarang
		$this->id_terimabarang = new DbField('kartustok', 'kartustok', 'x_id_terimabarang', 'id_terimabarang', '`id_terimabarang`', '`id_terimabarang`', 3, 11, -1, FALSE, '`id_terimabarang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_terimabarang->Sortable = TRUE; // Allow sort
		$this->id_terimabarang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_terimabarang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_terimabarang->Lookup = new Lookup('id_terimabarang', 'terimabarang', FALSE, 'id', ["no_terima","","",""], [], [], [], [], [], [], '', '');
		$this->id_terimabarang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_terimabarang'] = &$this->id_terimabarang;

		// id_penjualan
		$this->id_penjualan = new DbField('kartustok', 'kartustok', 'x_id_penjualan', 'id_penjualan', '`id_penjualan`', '`id_penjualan`', 3, 11, -1, FALSE, '`id_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_penjualan->Sortable = TRUE; // Allow sort
		$this->id_penjualan->Lookup = new Lookup('id_penjualan', 'penjualan', FALSE, 'id', ["kode_penjualan","","",""], [], [], [], [], [], [], '', '');
		$this->id_penjualan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_penjualan'] = &$this->id_penjualan;

		// id_kirimbarang
		$this->id_kirimbarang = new DbField('kartustok', 'kartustok', 'x_id_kirimbarang', 'id_kirimbarang', '`id_kirimbarang`', '`id_kirimbarang`', 3, 11, -1, FALSE, '`id_kirimbarang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kirimbarang->Sortable = TRUE; // Allow sort
		$this->id_kirimbarang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kirimbarang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kirimbarang->Lookup = new Lookup('id_kirimbarang', 'kirimbarang', FALSE, 'id', ["no_kirimbarang","","",""], [], [], [], [], [], [], '', '');
		$this->id_kirimbarang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kirimbarang'] = &$this->id_kirimbarang;

		// id_nonjual
		$this->id_nonjual = new DbField('kartustok', 'kartustok', 'x_id_nonjual', 'id_nonjual', '`id_nonjual`', '`id_nonjual`', 3, 11, -1, FALSE, '`id_nonjual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_nonjual->Sortable = TRUE; // Allow sort
		$this->id_nonjual->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_nonjual'] = &$this->id_nonjual;

		// id_retur
		$this->id_retur = new DbField('kartustok', 'kartustok', 'x_id_retur', 'id_retur', '`id_retur`', '`id_retur`', 3, 11, -1, FALSE, '`id_retur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_retur->Sortable = TRUE; // Allow sort
		$this->id_retur->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_retur->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_retur->Lookup = new Lookup('id_retur', 'returbarang', FALSE, 'id_retur', ["kode","","",""], [], [], [], [], [], [], '', '');
		$this->id_retur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_retur'] = &$this->id_retur;

		// id_penyesuaian
		$this->id_penyesuaian = new DbField('kartustok', 'kartustok', 'x_id_penyesuaian', 'id_penyesuaian', '`id_penyesuaian`', '`id_penyesuaian`', 3, 11, -1, FALSE, '`id_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_penyesuaian->Sortable = TRUE; // Allow sort
		$this->id_penyesuaian->Lookup = new Lookup('id_penyesuaian', 'penyesuaianstok', FALSE, 'id_penyesuaianstok', ["kode_penyesuaian","","",""], [], [], [], [], [], [], '', '');
		$this->id_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_penyesuaian'] = &$this->id_penyesuaian;

		// stok_awal
		$this->stok_awal = new DbField('kartustok', 'kartustok', 'x_stok_awal', 'stok_awal', '`stok_awal`', '`stok_awal`', 4, 12, -1, FALSE, '`stok_awal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok_awal->Sortable = TRUE; // Allow sort
		$this->stok_awal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['stok_awal'] = &$this->stok_awal;

		// masuk
		$this->masuk = new DbField('kartustok', 'kartustok', 'x_masuk', 'masuk', '`masuk`', '`masuk`', 5, 22, -1, FALSE, '`masuk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masuk->Sortable = TRUE; // Allow sort
		$this->masuk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['masuk'] = &$this->masuk;

		// masuk_penyesuaian
		$this->masuk_penyesuaian = new DbField('kartustok', 'kartustok', 'x_masuk_penyesuaian', 'masuk_penyesuaian', '`masuk_penyesuaian`', '`masuk_penyesuaian`', 4, 12, -1, FALSE, '`masuk_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masuk_penyesuaian->Sortable = TRUE; // Allow sort
		$this->masuk_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['masuk_penyesuaian'] = &$this->masuk_penyesuaian;

		// keluar
		$this->keluar = new DbField('kartustok', 'kartustok', 'x_keluar', 'keluar', '`keluar`', '`keluar`', 5, 22, -1, FALSE, '`keluar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar->Sortable = TRUE; // Allow sort
		$this->keluar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keluar'] = &$this->keluar;

		// keluar_nonjual
		$this->keluar_nonjual = new DbField('kartustok', 'kartustok', 'x_keluar_nonjual', 'keluar_nonjual', '`keluar_nonjual`', '`keluar_nonjual`', 5, 22, -1, FALSE, '`keluar_nonjual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_nonjual->Sortable = TRUE; // Allow sort
		$this->keluar_nonjual->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keluar_nonjual'] = &$this->keluar_nonjual;

		// keluar_penyesuaian
		$this->keluar_penyesuaian = new DbField('kartustok', 'kartustok', 'x_keluar_penyesuaian', 'keluar_penyesuaian', '`keluar_penyesuaian`', '`keluar_penyesuaian`', 4, 12, -1, FALSE, '`keluar_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_penyesuaian->Sortable = TRUE; // Allow sort
		$this->keluar_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keluar_penyesuaian'] = &$this->keluar_penyesuaian;

		// keluar_kirim
		$this->keluar_kirim = new DbField('kartustok', 'kartustok', 'x_keluar_kirim', 'keluar_kirim', '`keluar_kirim`', '`keluar_kirim`', 5, 22, -1, FALSE, '`keluar_kirim`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_kirim->Sortable = TRUE; // Allow sort
		$this->keluar_kirim->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keluar_kirim'] = &$this->keluar_kirim;

		// retur
		$this->retur = new DbField('kartustok', 'kartustok', 'x_retur', 'retur', '`retur`', '`retur`', 5, 22, -1, FALSE, '`retur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->retur->Sortable = TRUE; // Allow sort
		$this->retur->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['retur'] = &$this->retur;

		// stok_akhir
		$this->stok_akhir = new DbField('kartustok', 'kartustok', 'x_stok_akhir', 'stok_akhir', '`stok_akhir`', '`stok_akhir`', 4, 12, -1, FALSE, '`stok_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok_akhir->Sortable = TRUE; // Allow sort
		$this->stok_akhir->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['stok_akhir'] = &$this->stok_akhir;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
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
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "V_kartustok") {
			if ($this->id_barang->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->id_barang->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "V_kartustok") {
			if ($this->id_barang->getSessionValue() != "")
				$detailFilter .= "`id_barang`=" . QuotedValue($this->id_barang->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_V_kartustok()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_V_kartustok()
	{
		return "`id_barang`=@id_barang@";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`id_kartustok` DESC";
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

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id_kartustok->setDbValue($conn->insert_ID());
			$rs['id_kartustok'] = $this->id_kartustok->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id_kartustok', $rs))
				AddFilter($where, QuotedName('id_kartustok', $this->Dbid) . '=' . QuotedValue($rs['id_kartustok'], $this->id_kartustok->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id_kartustok->DbValue = $row['id_kartustok'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->tanggal->DbValue = $row['tanggal'];
		$this->id_terimabarang->DbValue = $row['id_terimabarang'];
		$this->id_penjualan->DbValue = $row['id_penjualan'];
		$this->id_kirimbarang->DbValue = $row['id_kirimbarang'];
		$this->id_nonjual->DbValue = $row['id_nonjual'];
		$this->id_retur->DbValue = $row['id_retur'];
		$this->id_penyesuaian->DbValue = $row['id_penyesuaian'];
		$this->stok_awal->DbValue = $row['stok_awal'];
		$this->masuk->DbValue = $row['masuk'];
		$this->masuk_penyesuaian->DbValue = $row['masuk_penyesuaian'];
		$this->keluar->DbValue = $row['keluar'];
		$this->keluar_nonjual->DbValue = $row['keluar_nonjual'];
		$this->keluar_penyesuaian->DbValue = $row['keluar_penyesuaian'];
		$this->keluar_kirim->DbValue = $row['keluar_kirim'];
		$this->retur->DbValue = $row['retur'];
		$this->stok_akhir->DbValue = $row['stok_akhir'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
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
			return "kartustoklist.php";
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
		if ($pageName == "kartustokview.php")
			return $Language->phrase("View");
		elseif ($pageName == "kartustokedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "kartustokadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "kartustoklist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("kartustokview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("kartustokview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "kartustokadd.php?" . $this->getUrlParm($parm);
		else
			$url = "kartustokadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("kartustokedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("kartustokadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("kartustokdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "V_kartustok" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->id_barang->CurrentValue);
		}
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
		if ($this->CurrentAction || $this->isExport() ||
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

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id_kartustok->setDbValue($rs->fields('id_kartustok'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->id_terimabarang->setDbValue($rs->fields('id_terimabarang'));
		$this->id_penjualan->setDbValue($rs->fields('id_penjualan'));
		$this->id_kirimbarang->setDbValue($rs->fields('id_kirimbarang'));
		$this->id_nonjual->setDbValue($rs->fields('id_nonjual'));
		$this->id_retur->setDbValue($rs->fields('id_retur'));
		$this->id_penyesuaian->setDbValue($rs->fields('id_penyesuaian'));
		$this->stok_awal->setDbValue($rs->fields('stok_awal'));
		$this->masuk->setDbValue($rs->fields('masuk'));
		$this->masuk_penyesuaian->setDbValue($rs->fields('masuk_penyesuaian'));
		$this->keluar->setDbValue($rs->fields('keluar'));
		$this->keluar_nonjual->setDbValue($rs->fields('keluar_nonjual'));
		$this->keluar_penyesuaian->setDbValue($rs->fields('keluar_penyesuaian'));
		$this->keluar_kirim->setDbValue($rs->fields('keluar_kirim'));
		$this->retur->setDbValue($rs->fields('retur'));
		$this->stok_akhir->setDbValue($rs->fields('stok_akhir'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_kartustok
		// id_barang
		// id_klinik
		// tanggal
		// id_terimabarang
		// id_penjualan
		// id_kirimbarang
		// id_nonjual
		// id_retur
		// id_penyesuaian
		// stok_awal
		// masuk
		// masuk_penyesuaian
		// keluar
		// keluar_nonjual
		// keluar_penyesuaian
		// keluar_kirim
		// retur
		// stok_akhir
		// id_kartustok

		$this->id_kartustok->ViewValue = $this->id_kartustok->CurrentValue;
		$this->id_kartustok->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$curVal = strval($this->id_barang->CurrentValue);
		if ($curVal != "") {
			$this->id_barang->ViewValue = $this->id_barang->lookupCacheOption($curVal);
			if ($this->id_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_barang->ViewValue = $this->id_barang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
				}
			}
		} else {
			$this->id_barang->ViewValue = NULL;
		}
		$this->id_barang->ViewCustomAttributes = "";

		// id_klinik
		$curVal = strval($this->id_klinik->CurrentValue);
		if ($curVal != "") {
			$this->id_klinik->ViewValue = $this->id_klinik->lookupCacheOption($curVal);
			if ($this->id_klinik->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_klinik->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_klinik->ViewValue = $this->id_klinik->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_klinik->ViewValue = $this->id_klinik->CurrentValue;
				}
			}
		} else {
			$this->id_klinik->ViewValue = NULL;
		}
		$this->id_klinik->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
		$this->tanggal->ViewCustomAttributes = "";

		// id_terimabarang
		$curVal = strval($this->id_terimabarang->CurrentValue);
		if ($curVal != "") {
			$this->id_terimabarang->ViewValue = $this->id_terimabarang->lookupCacheOption($curVal);
			if ($this->id_terimabarang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_terimabarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_terimabarang->ViewValue = $this->id_terimabarang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_terimabarang->ViewValue = $this->id_terimabarang->CurrentValue;
				}
			}
		} else {
			$this->id_terimabarang->ViewValue = NULL;
		}
		$this->id_terimabarang->ViewCustomAttributes = "";

		// id_penjualan
		$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
		$curVal = strval($this->id_penjualan->CurrentValue);
		if ($curVal != "") {
			$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
			if ($this->id_penjualan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_penjualan->ViewValue = $this->id_penjualan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
				}
			}
		} else {
			$this->id_penjualan->ViewValue = NULL;
		}
		$this->id_penjualan->ViewCustomAttributes = "";

		// id_kirimbarang
		$curVal = strval($this->id_kirimbarang->CurrentValue);
		if ($curVal != "") {
			$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->lookupCacheOption($curVal);
			if ($this->id_kirimbarang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_kirimbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->CurrentValue;
				}
			}
		} else {
			$this->id_kirimbarang->ViewValue = NULL;
		}
		$this->id_kirimbarang->ViewCustomAttributes = "";

		// id_nonjual
		$this->id_nonjual->ViewValue = $this->id_nonjual->CurrentValue;
		$this->id_nonjual->ViewValue = FormatNumber($this->id_nonjual->ViewValue, 0, -2, -2, -2);
		$this->id_nonjual->ViewCustomAttributes = "";

		// id_retur
		$curVal = strval($this->id_retur->CurrentValue);
		if ($curVal != "") {
			$this->id_retur->ViewValue = $this->id_retur->lookupCacheOption($curVal);
			if ($this->id_retur->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_retur`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_retur->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_retur->ViewValue = $this->id_retur->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
				}
			}
		} else {
			$this->id_retur->ViewValue = NULL;
		}
		$this->id_retur->ViewCustomAttributes = "";

		// id_penyesuaian
		$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
		$curVal = strval($this->id_penyesuaian->CurrentValue);
		if ($curVal != "") {
			$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->lookupCacheOption($curVal);
			if ($this->id_penyesuaian->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_penyesuaianstok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_penyesuaian->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
				}
			}
		} else {
			$this->id_penyesuaian->ViewValue = NULL;
		}
		$this->id_penyesuaian->ViewCustomAttributes = "";

		// stok_awal
		$this->stok_awal->ViewValue = $this->stok_awal->CurrentValue;
		$this->stok_awal->ViewValue = FormatNumber($this->stok_awal->ViewValue, 2, -2, -2, -2);
		$this->stok_awal->ViewCustomAttributes = "";

		// masuk
		$this->masuk->ViewValue = $this->masuk->CurrentValue;
		$this->masuk->ViewValue = FormatNumber($this->masuk->ViewValue, 2, -2, -2, -2);
		$this->masuk->ViewCustomAttributes = "";

		// masuk_penyesuaian
		$this->masuk_penyesuaian->ViewValue = $this->masuk_penyesuaian->CurrentValue;
		$this->masuk_penyesuaian->ViewValue = FormatNumber($this->masuk_penyesuaian->ViewValue, 2, -2, -2, -2);
		$this->masuk_penyesuaian->ViewCustomAttributes = "";

		// keluar
		$this->keluar->ViewValue = $this->keluar->CurrentValue;
		$this->keluar->ViewValue = FormatNumber($this->keluar->ViewValue, 2, -2, -2, -2);
		$this->keluar->ViewCustomAttributes = "";

		// keluar_nonjual
		$this->keluar_nonjual->ViewValue = $this->keluar_nonjual->CurrentValue;
		$this->keluar_nonjual->ViewValue = FormatNumber($this->keluar_nonjual->ViewValue, 2, -2, -2, -2);
		$this->keluar_nonjual->ViewCustomAttributes = "";

		// keluar_penyesuaian
		$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
		$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
		$this->keluar_penyesuaian->ViewCustomAttributes = "";

		// keluar_kirim
		$this->keluar_kirim->ViewValue = $this->keluar_kirim->CurrentValue;
		$this->keluar_kirim->ViewValue = FormatNumber($this->keluar_kirim->ViewValue, 2, -2, -2, -2);
		$this->keluar_kirim->ViewCustomAttributes = "";

		// retur
		$this->retur->ViewValue = $this->retur->CurrentValue;
		$this->retur->ViewValue = FormatNumber($this->retur->ViewValue, 2, -2, -2, -2);
		$this->retur->ViewCustomAttributes = "";

		// stok_akhir
		$this->stok_akhir->ViewValue = $this->stok_akhir->CurrentValue;
		$this->stok_akhir->ViewValue = FormatNumber($this->stok_akhir->ViewValue, 2, -2, -2, -2);
		$this->stok_akhir->ViewCustomAttributes = "";

		// id_kartustok
		$this->id_kartustok->LinkCustomAttributes = "";
		$this->id_kartustok->HrefValue = "";
		$this->id_kartustok->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// tanggal
		$this->tanggal->LinkCustomAttributes = "";
		$this->tanggal->HrefValue = "";
		$this->tanggal->TooltipValue = "";

		// id_terimabarang
		$this->id_terimabarang->LinkCustomAttributes = "";
		$this->id_terimabarang->HrefValue = "";
		$this->id_terimabarang->TooltipValue = "";

		// id_penjualan
		$this->id_penjualan->LinkCustomAttributes = "";
		$this->id_penjualan->HrefValue = "";
		$this->id_penjualan->TooltipValue = "";

		// id_kirimbarang
		$this->id_kirimbarang->LinkCustomAttributes = "";
		$this->id_kirimbarang->HrefValue = "";
		$this->id_kirimbarang->TooltipValue = "";

		// id_nonjual
		$this->id_nonjual->LinkCustomAttributes = "";
		$this->id_nonjual->HrefValue = "";
		$this->id_nonjual->TooltipValue = "";

		// id_retur
		$this->id_retur->LinkCustomAttributes = "";
		$this->id_retur->HrefValue = "";
		$this->id_retur->TooltipValue = "";

		// id_penyesuaian
		$this->id_penyesuaian->LinkCustomAttributes = "";
		$this->id_penyesuaian->HrefValue = "";
		$this->id_penyesuaian->TooltipValue = "";

		// stok_awal
		$this->stok_awal->LinkCustomAttributes = "";
		$this->stok_awal->HrefValue = "";
		$this->stok_awal->TooltipValue = "";

		// masuk
		$this->masuk->LinkCustomAttributes = "";
		$this->masuk->HrefValue = "";
		$this->masuk->TooltipValue = "";

		// masuk_penyesuaian
		$this->masuk_penyesuaian->LinkCustomAttributes = "";
		$this->masuk_penyesuaian->HrefValue = "";
		$this->masuk_penyesuaian->TooltipValue = "";

		// keluar
		$this->keluar->LinkCustomAttributes = "";
		$this->keluar->HrefValue = "";
		$this->keluar->TooltipValue = "";

		// keluar_nonjual
		$this->keluar_nonjual->LinkCustomAttributes = "";
		$this->keluar_nonjual->HrefValue = "";
		$this->keluar_nonjual->TooltipValue = "";

		// keluar_penyesuaian
		$this->keluar_penyesuaian->LinkCustomAttributes = "";
		$this->keluar_penyesuaian->HrefValue = "";
		$this->keluar_penyesuaian->TooltipValue = "";

		// keluar_kirim
		$this->keluar_kirim->LinkCustomAttributes = "";
		$this->keluar_kirim->HrefValue = "";
		$this->keluar_kirim->TooltipValue = "";

		// retur
		$this->retur->LinkCustomAttributes = "";
		$this->retur->HrefValue = "";
		$this->retur->TooltipValue = "";

		// stok_akhir
		$this->stok_akhir->LinkCustomAttributes = "";
		$this->stok_akhir->HrefValue = "";
		$this->stok_akhir->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id_kartustok
		$this->id_kartustok->EditAttrs["class"] = "form-control";
		$this->id_kartustok->EditCustomAttributes = "";
		$this->id_kartustok->EditValue = $this->id_kartustok->CurrentValue;
		$this->id_kartustok->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		if ($this->id_barang->getSessionValue() != "") {
			$this->id_barang->CurrentValue = $this->id_barang->getSessionValue();
			$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
			$curVal = strval($this->id_barang->CurrentValue);
			if ($curVal != "") {
				$this->id_barang->ViewValue = $this->id_barang->lookupCacheOption($curVal);
				if ($this->id_barang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_barang->ViewValue = $this->id_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
					}
				}
			} else {
				$this->id_barang->ViewValue = NULL;
			}
			$this->id_barang->ViewCustomAttributes = "";
		} else {
			$this->id_barang->EditValue = $this->id_barang->CurrentValue;
			$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());
		}

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// tanggal
		$this->tanggal->EditAttrs["class"] = "form-control";
		$this->tanggal->EditCustomAttributes = "";
		$this->tanggal->EditValue = FormatDateTime($this->tanggal->CurrentValue, 8);
		$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

		// id_terimabarang
		$this->id_terimabarang->EditAttrs["class"] = "form-control";
		$this->id_terimabarang->EditCustomAttributes = "";

		// id_penjualan
		$this->id_penjualan->EditAttrs["class"] = "form-control";
		$this->id_penjualan->EditCustomAttributes = "";
		$this->id_penjualan->EditValue = $this->id_penjualan->CurrentValue;
		$this->id_penjualan->PlaceHolder = RemoveHtml($this->id_penjualan->caption());

		// id_kirimbarang
		$this->id_kirimbarang->EditAttrs["class"] = "form-control";
		$this->id_kirimbarang->EditCustomAttributes = "";

		// id_nonjual
		$this->id_nonjual->EditAttrs["class"] = "form-control";
		$this->id_nonjual->EditCustomAttributes = "";
		$this->id_nonjual->EditValue = $this->id_nonjual->CurrentValue;
		$this->id_nonjual->PlaceHolder = RemoveHtml($this->id_nonjual->caption());

		// id_retur
		$this->id_retur->EditAttrs["class"] = "form-control";
		$this->id_retur->EditCustomAttributes = "";

		// id_penyesuaian
		$this->id_penyesuaian->EditAttrs["class"] = "form-control";
		$this->id_penyesuaian->EditCustomAttributes = "";
		$this->id_penyesuaian->EditValue = $this->id_penyesuaian->CurrentValue;
		$this->id_penyesuaian->PlaceHolder = RemoveHtml($this->id_penyesuaian->caption());

		// stok_awal
		$this->stok_awal->EditAttrs["class"] = "form-control";
		$this->stok_awal->EditCustomAttributes = "";
		$this->stok_awal->EditValue = $this->stok_awal->CurrentValue;
		$this->stok_awal->PlaceHolder = RemoveHtml($this->stok_awal->caption());
		if (strval($this->stok_awal->EditValue) != "" && is_numeric($this->stok_awal->EditValue))
			$this->stok_awal->EditValue = FormatNumber($this->stok_awal->EditValue, -2, -2, -2, -2);
		

		// masuk
		$this->masuk->EditAttrs["class"] = "form-control";
		$this->masuk->EditCustomAttributes = "";
		$this->masuk->EditValue = $this->masuk->CurrentValue;
		$this->masuk->PlaceHolder = RemoveHtml($this->masuk->caption());
		if (strval($this->masuk->EditValue) != "" && is_numeric($this->masuk->EditValue))
			$this->masuk->EditValue = FormatNumber($this->masuk->EditValue, -2, -2, -2, -2);
		

		// masuk_penyesuaian
		$this->masuk_penyesuaian->EditAttrs["class"] = "form-control";
		$this->masuk_penyesuaian->EditCustomAttributes = "";
		$this->masuk_penyesuaian->EditValue = $this->masuk_penyesuaian->CurrentValue;
		$this->masuk_penyesuaian->PlaceHolder = RemoveHtml($this->masuk_penyesuaian->caption());
		if (strval($this->masuk_penyesuaian->EditValue) != "" && is_numeric($this->masuk_penyesuaian->EditValue))
			$this->masuk_penyesuaian->EditValue = FormatNumber($this->masuk_penyesuaian->EditValue, -2, -2, -2, -2);
		

		// keluar
		$this->keluar->EditAttrs["class"] = "form-control";
		$this->keluar->EditCustomAttributes = "";
		$this->keluar->EditValue = $this->keluar->CurrentValue;
		$this->keluar->PlaceHolder = RemoveHtml($this->keluar->caption());
		if (strval($this->keluar->EditValue) != "" && is_numeric($this->keluar->EditValue))
			$this->keluar->EditValue = FormatNumber($this->keluar->EditValue, -2, -2, -2, -2);
		

		// keluar_nonjual
		$this->keluar_nonjual->EditAttrs["class"] = "form-control";
		$this->keluar_nonjual->EditCustomAttributes = "";
		$this->keluar_nonjual->EditValue = $this->keluar_nonjual->CurrentValue;
		$this->keluar_nonjual->PlaceHolder = RemoveHtml($this->keluar_nonjual->caption());
		if (strval($this->keluar_nonjual->EditValue) != "" && is_numeric($this->keluar_nonjual->EditValue))
			$this->keluar_nonjual->EditValue = FormatNumber($this->keluar_nonjual->EditValue, -2, -2, -2, -2);
		

		// keluar_penyesuaian
		$this->keluar_penyesuaian->EditAttrs["class"] = "form-control";
		$this->keluar_penyesuaian->EditCustomAttributes = "";
		$this->keluar_penyesuaian->EditValue = $this->keluar_penyesuaian->CurrentValue;
		$this->keluar_penyesuaian->PlaceHolder = RemoveHtml($this->keluar_penyesuaian->caption());
		if (strval($this->keluar_penyesuaian->EditValue) != "" && is_numeric($this->keluar_penyesuaian->EditValue))
			$this->keluar_penyesuaian->EditValue = FormatNumber($this->keluar_penyesuaian->EditValue, -2, -2, -2, -2);
		

		// keluar_kirim
		$this->keluar_kirim->EditAttrs["class"] = "form-control";
		$this->keluar_kirim->EditCustomAttributes = "";
		$this->keluar_kirim->EditValue = $this->keluar_kirim->CurrentValue;
		$this->keluar_kirim->PlaceHolder = RemoveHtml($this->keluar_kirim->caption());
		if (strval($this->keluar_kirim->EditValue) != "" && is_numeric($this->keluar_kirim->EditValue))
			$this->keluar_kirim->EditValue = FormatNumber($this->keluar_kirim->EditValue, -2, -2, -2, -2);
		

		// retur
		$this->retur->EditAttrs["class"] = "form-control";
		$this->retur->EditCustomAttributes = "";
		$this->retur->EditValue = $this->retur->CurrentValue;
		$this->retur->PlaceHolder = RemoveHtml($this->retur->caption());
		if (strval($this->retur->EditValue) != "" && is_numeric($this->retur->EditValue))
			$this->retur->EditValue = FormatNumber($this->retur->EditValue, -2, -2, -2, -2);
		

		// stok_akhir
		$this->stok_akhir->EditAttrs["class"] = "form-control";
		$this->stok_akhir->EditCustomAttributes = "";
		$this->stok_akhir->EditValue = $this->stok_akhir->CurrentValue;
		$this->stok_akhir->PlaceHolder = RemoveHtml($this->stok_akhir->caption());
		if (strval($this->stok_akhir->EditValue) != "" && is_numeric($this->stok_akhir->EditValue))
			$this->stok_akhir->EditValue = FormatNumber($this->stok_akhir->EditValue, -2, -2, -2, -2);
		

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->id_terimabarang);
					$doc->exportCaption($this->id_penjualan);
					$doc->exportCaption($this->id_kirimbarang);
					$doc->exportCaption($this->id_retur);
					$doc->exportCaption($this->id_penyesuaian);
					$doc->exportCaption($this->stok_awal);
					$doc->exportCaption($this->masuk);
					$doc->exportCaption($this->masuk_penyesuaian);
					$doc->exportCaption($this->keluar);
					$doc->exportCaption($this->keluar_nonjual);
					$doc->exportCaption($this->keluar_penyesuaian);
					$doc->exportCaption($this->keluar_kirim);
					$doc->exportCaption($this->retur);
					$doc->exportCaption($this->stok_akhir);
				} else {
					$doc->exportCaption($this->id_kartustok);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->id_terimabarang);
					$doc->exportCaption($this->id_penjualan);
					$doc->exportCaption($this->id_kirimbarang);
					$doc->exportCaption($this->id_nonjual);
					$doc->exportCaption($this->id_retur);
					$doc->exportCaption($this->id_penyesuaian);
					$doc->exportCaption($this->stok_awal);
					$doc->exportCaption($this->masuk);
					$doc->exportCaption($this->masuk_penyesuaian);
					$doc->exportCaption($this->keluar);
					$doc->exportCaption($this->keluar_nonjual);
					$doc->exportCaption($this->keluar_penyesuaian);
					$doc->exportCaption($this->keluar_kirim);
					$doc->exportCaption($this->retur);
					$doc->exportCaption($this->stok_akhir);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->tanggal);
						$doc->exportField($this->id_terimabarang);
						$doc->exportField($this->id_penjualan);
						$doc->exportField($this->id_kirimbarang);
						$doc->exportField($this->id_retur);
						$doc->exportField($this->id_penyesuaian);
						$doc->exportField($this->stok_awal);
						$doc->exportField($this->masuk);
						$doc->exportField($this->masuk_penyesuaian);
						$doc->exportField($this->keluar);
						$doc->exportField($this->keluar_nonjual);
						$doc->exportField($this->keluar_penyesuaian);
						$doc->exportField($this->keluar_kirim);
						$doc->exportField($this->retur);
						$doc->exportField($this->stok_akhir);
					} else {
						$doc->exportField($this->id_kartustok);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->tanggal);
						$doc->exportField($this->id_terimabarang);
						$doc->exportField($this->id_penjualan);
						$doc->exportField($this->id_kirimbarang);
						$doc->exportField($this->id_nonjual);
						$doc->exportField($this->id_retur);
						$doc->exportField($this->id_penyesuaian);
						$doc->exportField($this->stok_awal);
						$doc->exportField($this->masuk);
						$doc->exportField($this->masuk_penyesuaian);
						$doc->exportField($this->keluar);
						$doc->exportField($this->keluar_nonjual);
						$doc->exportField($this->keluar_penyesuaian);
						$doc->exportField($this->keluar_kirim);
						$doc->exportField($this->retur);
						$doc->exportField($this->stok_akhir);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here

		/*
		if ($filter == "") {
			$filter = "0=101";
			$this->SearchWhere = $filter;
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		*/
		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE) {
			$filter = "id_klinik = '".$id_klinik."'";
		}
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
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

			if(is_null($this->id_terimabarang->CurrentValue)) {
				$this->id_terimabarang->ViewValue  = '-----:-----' ;
			}
			if(is_null($this->id_penjualan->CurrentValue)) {
				$this->id_penjualan->ViewValue  = '-----:-----' ;
			}
			if(is_null($this->id_retur->CurrentValue)) {
				$this->id_retur->ViewValue  = '-----:-----' ;
			}
			if(is_null($this->id_penyesuaian->CurrentValue)) {
				$this->id_penyesuaian->ViewValue  = '-----:-----' ;
			}
			if(is_null($this->id_kirimbarang->CurrentValue)) {
				$this->id_kirimbarang->ViewValue  = '-----:-----' ;
			}
		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE){
			$this->id_klinik->CurrentValue = $id_klinik ;
			$this->id_klinik->ReadOnly = TRUE; 
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>