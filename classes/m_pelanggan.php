<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for m_pelanggan
 */
class m_pelanggan extends DbTable
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
	public $id_pelanggan;
	public $kode_pelanggan;
	public $noktp_pelanggan;
	public $nama_pelanggan;
	public $jenis_pelanggan;
	public $tgllahir_pelanggan;
	public $pekerjaan_pelanggan;
	public $kota_pelanggan;
	public $alamat_pelanggan;
	public $telpon_pelanggan;
	public $hp_pelanggan;
	public $id_klinik;
	public $tgl_daftar;
	public $kategori;
	public $tipe;
	public $tgl_terakhir_transaksi;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_pelanggan';
		$this->TableName = 'm_pelanggan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_pelanggan`";
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

		// id_pelanggan
		$this->id_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 11, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_pelanggan->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_pelanggan->IsPrimaryKey = TRUE; // Primary key field
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// kode_pelanggan
		$this->kode_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_kode_pelanggan', 'kode_pelanggan', '`kode_pelanggan`', '`kode_pelanggan`', 200, 255, -1, FALSE, '`kode_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->kode_pelanggan->Required = TRUE; // Required field
		$this->kode_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['kode_pelanggan'] = &$this->kode_pelanggan;

		// noktp_pelanggan
		$this->noktp_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_noktp_pelanggan', 'noktp_pelanggan', '`noktp_pelanggan`', '`noktp_pelanggan`', 200, 255, -1, FALSE, '`noktp_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noktp_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->noktp_pelanggan->Required = TRUE; // Required field
		$this->noktp_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['noktp_pelanggan'] = &$this->noktp_pelanggan;

		// nama_pelanggan
		$this->nama_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_nama_pelanggan', 'nama_pelanggan', '`nama_pelanggan`', '`nama_pelanggan`', 200, 255, -1, FALSE, '`nama_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->nama_pelanggan->Required = TRUE; // Required field
		$this->nama_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['nama_pelanggan'] = &$this->nama_pelanggan;

		// jenis_pelanggan
		$this->jenis_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_jenis_pelanggan', 'jenis_pelanggan', '`jenis_pelanggan`', '`jenis_pelanggan`', 202, 9, -1, FALSE, '`jenis_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->jenis_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->jenis_pelanggan->Required = TRUE; // Required field
		$this->jenis_pelanggan->Sortable = TRUE; // Allow sort
		$this->jenis_pelanggan->Lookup = new Lookup('jenis_pelanggan', 'm_pelanggan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenis_pelanggan->OptionCount = 2;
		$this->fields['jenis_pelanggan'] = &$this->jenis_pelanggan;

		// tgllahir_pelanggan
		$this->tgllahir_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_tgllahir_pelanggan', 'tgllahir_pelanggan', '`tgllahir_pelanggan`', CastDateFieldForLike("`tgllahir_pelanggan`", 0, "DB"), 133, 10, 0, FALSE, '`tgllahir_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgllahir_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->tgllahir_pelanggan->Required = TRUE; // Required field
		$this->tgllahir_pelanggan->Sortable = TRUE; // Allow sort
		$this->tgllahir_pelanggan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgllahir_pelanggan'] = &$this->tgllahir_pelanggan;

		// pekerjaan_pelanggan
		$this->pekerjaan_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_pekerjaan_pelanggan', 'pekerjaan_pelanggan', '`pekerjaan_pelanggan`', '`pekerjaan_pelanggan`', 200, 255, -1, FALSE, '`pekerjaan_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pekerjaan_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->pekerjaan_pelanggan->Required = TRUE; // Required field
		$this->pekerjaan_pelanggan->Sortable = TRUE; // Allow sort
		$this->pekerjaan_pelanggan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pekerjaan_pelanggan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->pekerjaan_pelanggan->Lookup = new Lookup('pekerjaan_pelanggan', 'pekerjaan', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->fields['pekerjaan_pelanggan'] = &$this->pekerjaan_pelanggan;

		// kota_pelanggan
		$this->kota_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_kota_pelanggan', 'kota_pelanggan', '`kota_pelanggan`', '`kota_pelanggan`', 19, 11, -1, FALSE, '`kota_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kota_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->kota_pelanggan->Required = TRUE; // Required field
		$this->kota_pelanggan->Sortable = TRUE; // Allow sort
		$this->kota_pelanggan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kota_pelanggan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kota_pelanggan->Lookup = new Lookup('kota_pelanggan', 'kota', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->kota_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kota_pelanggan'] = &$this->kota_pelanggan;

		// alamat_pelanggan
		$this->alamat_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_alamat_pelanggan', 'alamat_pelanggan', '`alamat_pelanggan`', '`alamat_pelanggan`', 200, 255, -1, FALSE, '`alamat_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->alamat_pelanggan->Required = TRUE; // Required field
		$this->alamat_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['alamat_pelanggan'] = &$this->alamat_pelanggan;

		// telpon_pelanggan
		$this->telpon_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_telpon_pelanggan', 'telpon_pelanggan', '`telpon_pelanggan`', '`telpon_pelanggan`', 200, 255, -1, FALSE, '`telpon_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telpon_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->telpon_pelanggan->Required = TRUE; // Required field
		$this->telpon_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['telpon_pelanggan'] = &$this->telpon_pelanggan;

		// hp_pelanggan
		$this->hp_pelanggan = new DbField('m_pelanggan', 'm_pelanggan', 'x_hp_pelanggan', 'hp_pelanggan', '`hp_pelanggan`', '`hp_pelanggan`', 200, 255, -1, FALSE, '`hp_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->hp_pelanggan->Required = TRUE; // Required field
		$this->hp_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['hp_pelanggan'] = &$this->hp_pelanggan;

		// id_klinik
		$this->id_klinik = new DbField('m_pelanggan', 'm_pelanggan', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Nullable = FALSE; // NOT NULL field
		$this->id_klinik->Required = TRUE; // Required field
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// tgl_daftar
		$this->tgl_daftar = new DbField('m_pelanggan', 'm_pelanggan', 'x_tgl_daftar', 'tgl_daftar', '`tgl_daftar`', CastDateFieldForLike("`tgl_daftar`", 7, "DB"), 135, 19, 7, FALSE, '`tgl_daftar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_daftar->Nullable = FALSE; // NOT NULL field
		$this->tgl_daftar->Required = TRUE; // Required field
		$this->tgl_daftar->Sortable = TRUE; // Allow sort
		$this->tgl_daftar->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['tgl_daftar'] = &$this->tgl_daftar;

		// kategori
		$this->kategori = new DbField('m_pelanggan', 'm_pelanggan', 'x_kategori', 'kategori', '`kategori`', '`kategori`', 3, 11, -1, FALSE, '`kategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kategori->Nullable = FALSE; // NOT NULL field
		$this->kategori->Required = TRUE; // Required field
		$this->kategori->Sortable = TRUE; // Allow sort
		$this->kategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kategori->Lookup = new Lookup('kategori', 'm_kategoripelanggan', FALSE, 'id_kategori', ["nama_kategori","","",""], [], [], [], [], [], [], '', '');
		$this->kategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kategori'] = &$this->kategori;

		// tipe
		$this->tipe = new DbField('m_pelanggan', 'm_pelanggan', 'x_tipe', 'tipe', '`tipe`', '`tipe`', 3, 11, -1, FALSE, '`tipe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipe->Nullable = FALSE; // NOT NULL field
		$this->tipe->Required = TRUE; // Required field
		$this->tipe->Sortable = TRUE; // Allow sort
		$this->tipe->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tipe->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->tipe->Lookup = new Lookup('tipe', 'm_tipepelanggan', FALSE, 'id_tipe', ["nama_tipe","","",""], [], [], [], [], [], [], '', '');
		$this->tipe->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tipe'] = &$this->tipe;

		// tgl_terakhir_transaksi
		$this->tgl_terakhir_transaksi = new DbField('m_pelanggan', 'm_pelanggan', 'x_tgl_terakhir_transaksi', 'tgl_terakhir_transaksi', '`tgl_terakhir_transaksi`', CastDateFieldForLike("`tgl_terakhir_transaksi`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_terakhir_transaksi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_terakhir_transaksi->Nullable = FALSE; // NOT NULL field
		$this->tgl_terakhir_transaksi->Required = TRUE; // Required field
		$this->tgl_terakhir_transaksi->Sortable = FALSE; // Allow sort
		$this->tgl_terakhir_transaksi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_terakhir_transaksi'] = &$this->tgl_terakhir_transaksi;
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

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_pelanggan`";
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
			$this->id_pelanggan->setDbValue($conn->insert_ID());
			$rs['id_pelanggan'] = $this->id_pelanggan->DbValue;
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
			if (array_key_exists('id_pelanggan', $rs))
				AddFilter($where, QuotedName('id_pelanggan', $this->Dbid) . '=' . QuotedValue($rs['id_pelanggan'], $this->id_pelanggan->DataType, $this->Dbid));
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
		$this->id_pelanggan->DbValue = $row['id_pelanggan'];
		$this->kode_pelanggan->DbValue = $row['kode_pelanggan'];
		$this->noktp_pelanggan->DbValue = $row['noktp_pelanggan'];
		$this->nama_pelanggan->DbValue = $row['nama_pelanggan'];
		$this->jenis_pelanggan->DbValue = $row['jenis_pelanggan'];
		$this->tgllahir_pelanggan->DbValue = $row['tgllahir_pelanggan'];
		$this->pekerjaan_pelanggan->DbValue = $row['pekerjaan_pelanggan'];
		$this->kota_pelanggan->DbValue = $row['kota_pelanggan'];
		$this->alamat_pelanggan->DbValue = $row['alamat_pelanggan'];
		$this->telpon_pelanggan->DbValue = $row['telpon_pelanggan'];
		$this->hp_pelanggan->DbValue = $row['hp_pelanggan'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->tgl_daftar->DbValue = $row['tgl_daftar'];
		$this->kategori->DbValue = $row['kategori'];
		$this->tipe->DbValue = $row['tipe'];
		$this->tgl_terakhir_transaksi->DbValue = $row['tgl_terakhir_transaksi'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_pelanggan` = @id_pelanggan@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_pelanggan', $row) ? $row['id_pelanggan'] : NULL;
		else
			$val = $this->id_pelanggan->OldValue !== NULL ? $this->id_pelanggan->OldValue : $this->id_pelanggan->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_pelanggan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "m_pelangganlist.php";
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
		if ($pageName == "m_pelangganview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_pelangganedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_pelangganadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_pelangganlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_pelangganview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_pelangganview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_pelangganadd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_pelangganadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_pelangganedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_pelangganadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_pelanggandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_pelanggan:" . JsonEncode($this->id_pelanggan->CurrentValue, "number");
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
		if ($this->id_pelanggan->CurrentValue != NULL) {
			$url .= "id_pelanggan=" . urlencode($this->id_pelanggan->CurrentValue);
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
			if (Param("id_pelanggan") !== NULL)
				$arKeys[] = Param("id_pelanggan");
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
				$this->id_pelanggan->CurrentValue = $key;
			else
				$this->id_pelanggan->OldValue = $key;
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
		$this->id_pelanggan->setDbValue($rs->fields('id_pelanggan'));
		$this->kode_pelanggan->setDbValue($rs->fields('kode_pelanggan'));
		$this->noktp_pelanggan->setDbValue($rs->fields('noktp_pelanggan'));
		$this->nama_pelanggan->setDbValue($rs->fields('nama_pelanggan'));
		$this->jenis_pelanggan->setDbValue($rs->fields('jenis_pelanggan'));
		$this->tgllahir_pelanggan->setDbValue($rs->fields('tgllahir_pelanggan'));
		$this->pekerjaan_pelanggan->setDbValue($rs->fields('pekerjaan_pelanggan'));
		$this->kota_pelanggan->setDbValue($rs->fields('kota_pelanggan'));
		$this->alamat_pelanggan->setDbValue($rs->fields('alamat_pelanggan'));
		$this->telpon_pelanggan->setDbValue($rs->fields('telpon_pelanggan'));
		$this->hp_pelanggan->setDbValue($rs->fields('hp_pelanggan'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->tgl_daftar->setDbValue($rs->fields('tgl_daftar'));
		$this->kategori->setDbValue($rs->fields('kategori'));
		$this->tipe->setDbValue($rs->fields('tipe'));
		$this->tgl_terakhir_transaksi->setDbValue($rs->fields('tgl_terakhir_transaksi'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_pelanggan
		// kode_pelanggan
		// noktp_pelanggan
		// nama_pelanggan
		// jenis_pelanggan
		// tgllahir_pelanggan
		// pekerjaan_pelanggan
		// kota_pelanggan
		// alamat_pelanggan
		// telpon_pelanggan
		// hp_pelanggan
		// id_klinik
		// tgl_daftar
		// kategori
		// tipe
		// tgl_terakhir_transaksi

		$this->tgl_terakhir_transaksi->CellCssStyle = "white-space: nowrap;";

		// id_pelanggan
		$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewCustomAttributes = "";

		// kode_pelanggan
		$this->kode_pelanggan->ViewValue = $this->kode_pelanggan->CurrentValue;
		$this->kode_pelanggan->ViewCustomAttributes = "";

		// noktp_pelanggan
		$this->noktp_pelanggan->ViewValue = $this->noktp_pelanggan->CurrentValue;
		$this->noktp_pelanggan->ViewCustomAttributes = "";

		// nama_pelanggan
		$this->nama_pelanggan->ViewValue = $this->nama_pelanggan->CurrentValue;
		$this->nama_pelanggan->ViewCustomAttributes = "";

		// jenis_pelanggan
		if (strval($this->jenis_pelanggan->CurrentValue) != "") {
			$this->jenis_pelanggan->ViewValue = $this->jenis_pelanggan->optionCaption($this->jenis_pelanggan->CurrentValue);
		} else {
			$this->jenis_pelanggan->ViewValue = NULL;
		}
		$this->jenis_pelanggan->ViewCustomAttributes = "";

		// tgllahir_pelanggan
		$this->tgllahir_pelanggan->ViewValue = $this->tgllahir_pelanggan->CurrentValue;
		$this->tgllahir_pelanggan->ViewValue = FormatDateTime($this->tgllahir_pelanggan->ViewValue, 0);
		$this->tgllahir_pelanggan->ViewCustomAttributes = "";

		// pekerjaan_pelanggan
		$curVal = strval($this->pekerjaan_pelanggan->CurrentValue);
		if ($curVal != "") {
			$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->lookupCacheOption($curVal);
			if ($this->pekerjaan_pelanggan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pekerjaan_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->CurrentValue;
				}
			}
		} else {
			$this->pekerjaan_pelanggan->ViewValue = NULL;
		}
		$this->pekerjaan_pelanggan->ViewCustomAttributes = "";

		// kota_pelanggan
		$curVal = strval($this->kota_pelanggan->CurrentValue);
		if ($curVal != "") {
			$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->lookupCacheOption($curVal);
			if ($this->kota_pelanggan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kota_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->CurrentValue;
				}
			}
		} else {
			$this->kota_pelanggan->ViewValue = NULL;
		}
		$this->kota_pelanggan->ViewCustomAttributes = "";

		// alamat_pelanggan
		$this->alamat_pelanggan->ViewValue = $this->alamat_pelanggan->CurrentValue;
		$this->alamat_pelanggan->ViewCustomAttributes = "";

		// telpon_pelanggan
		$this->telpon_pelanggan->ViewValue = $this->telpon_pelanggan->CurrentValue;
		$this->telpon_pelanggan->ViewCustomAttributes = "";

		// hp_pelanggan
		$this->hp_pelanggan->ViewValue = $this->hp_pelanggan->CurrentValue;
		$this->hp_pelanggan->ViewCustomAttributes = "";

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

		// tgl_daftar
		$this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
		$this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 7);
		$this->tgl_daftar->ViewCustomAttributes = "";

		// kategori
		$curVal = strval($this->kategori->CurrentValue);
		if ($curVal != "") {
			$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
			if ($this->kategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_kategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kategori->ViewValue = $this->kategori->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kategori->ViewValue = $this->kategori->CurrentValue;
				}
			}
		} else {
			$this->kategori->ViewValue = NULL;
		}
		$this->kategori->ViewCustomAttributes = "";

		// tipe
		$curVal = strval($this->tipe->CurrentValue);
		if ($curVal != "") {
			$this->tipe->ViewValue = $this->tipe->lookupCacheOption($curVal);
			if ($this->tipe->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_tipe`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->tipe->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->tipe->ViewValue = $this->tipe->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tipe->ViewValue = $this->tipe->CurrentValue;
				}
			}
		} else {
			$this->tipe->ViewValue = NULL;
		}
		$this->tipe->ViewCustomAttributes = "";

		// tgl_terakhir_transaksi
		$this->tgl_terakhir_transaksi->ViewValue = $this->tgl_terakhir_transaksi->CurrentValue;
		$this->tgl_terakhir_transaksi->ViewValue = FormatDateTime($this->tgl_terakhir_transaksi->ViewValue, 0);
		$this->tgl_terakhir_transaksi->ViewCustomAttributes = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// kode_pelanggan
		$this->kode_pelanggan->LinkCustomAttributes = "";
		$this->kode_pelanggan->HrefValue = "";
		$this->kode_pelanggan->TooltipValue = "";

		// noktp_pelanggan
		$this->noktp_pelanggan->LinkCustomAttributes = "";
		$this->noktp_pelanggan->HrefValue = "";
		$this->noktp_pelanggan->TooltipValue = "";

		// nama_pelanggan
		$this->nama_pelanggan->LinkCustomAttributes = "";
		$this->nama_pelanggan->HrefValue = "";
		$this->nama_pelanggan->TooltipValue = "";

		// jenis_pelanggan
		$this->jenis_pelanggan->LinkCustomAttributes = "";
		$this->jenis_pelanggan->HrefValue = "";
		$this->jenis_pelanggan->TooltipValue = "";

		// tgllahir_pelanggan
		$this->tgllahir_pelanggan->LinkCustomAttributes = "";
		$this->tgllahir_pelanggan->HrefValue = "";
		$this->tgllahir_pelanggan->TooltipValue = "";

		// pekerjaan_pelanggan
		$this->pekerjaan_pelanggan->LinkCustomAttributes = "";
		$this->pekerjaan_pelanggan->HrefValue = "";
		$this->pekerjaan_pelanggan->TooltipValue = "";

		// kota_pelanggan
		$this->kota_pelanggan->LinkCustomAttributes = "";
		$this->kota_pelanggan->HrefValue = "";
		$this->kota_pelanggan->TooltipValue = "";

		// alamat_pelanggan
		$this->alamat_pelanggan->LinkCustomAttributes = "";
		$this->alamat_pelanggan->HrefValue = "";
		$this->alamat_pelanggan->TooltipValue = "";

		// telpon_pelanggan
		$this->telpon_pelanggan->LinkCustomAttributes = "";
		$this->telpon_pelanggan->HrefValue = "";
		$this->telpon_pelanggan->TooltipValue = "";

		// hp_pelanggan
		$this->hp_pelanggan->LinkCustomAttributes = "";
		$this->hp_pelanggan->HrefValue = "";
		$this->hp_pelanggan->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// tgl_daftar
		$this->tgl_daftar->LinkCustomAttributes = "";
		$this->tgl_daftar->HrefValue = "";
		$this->tgl_daftar->TooltipValue = "";

		// kategori
		$this->kategori->LinkCustomAttributes = "";
		$this->kategori->HrefValue = "";
		$this->kategori->TooltipValue = "";

		// tipe
		$this->tipe->LinkCustomAttributes = "";
		$this->tipe->HrefValue = "";
		$this->tipe->TooltipValue = "";

		// tgl_terakhir_transaksi
		$this->tgl_terakhir_transaksi->LinkCustomAttributes = "";
		$this->tgl_terakhir_transaksi->HrefValue = "";
		$this->tgl_terakhir_transaksi->TooltipValue = "";

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

		// id_pelanggan
		$this->id_pelanggan->EditAttrs["class"] = "form-control";
		$this->id_pelanggan->EditCustomAttributes = "";
		$this->id_pelanggan->EditValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewCustomAttributes = "";

		// kode_pelanggan
		$this->kode_pelanggan->EditAttrs["class"] = "form-control";
		$this->kode_pelanggan->EditCustomAttributes = "";
		if (!$this->kode_pelanggan->Raw)
			$this->kode_pelanggan->CurrentValue = HtmlDecode($this->kode_pelanggan->CurrentValue);
		$this->kode_pelanggan->EditValue = $this->kode_pelanggan->CurrentValue;
		$this->kode_pelanggan->PlaceHolder = RemoveHtml($this->kode_pelanggan->caption());

		// noktp_pelanggan
		$this->noktp_pelanggan->EditAttrs["class"] = "form-control";
		$this->noktp_pelanggan->EditCustomAttributes = "";
		if (!$this->noktp_pelanggan->Raw)
			$this->noktp_pelanggan->CurrentValue = HtmlDecode($this->noktp_pelanggan->CurrentValue);
		$this->noktp_pelanggan->EditValue = $this->noktp_pelanggan->CurrentValue;
		$this->noktp_pelanggan->PlaceHolder = RemoveHtml($this->noktp_pelanggan->caption());

		// nama_pelanggan
		$this->nama_pelanggan->EditAttrs["class"] = "form-control";
		$this->nama_pelanggan->EditCustomAttributes = "";
		if (!$this->nama_pelanggan->Raw)
			$this->nama_pelanggan->CurrentValue = HtmlDecode($this->nama_pelanggan->CurrentValue);
		$this->nama_pelanggan->EditValue = $this->nama_pelanggan->CurrentValue;
		$this->nama_pelanggan->PlaceHolder = RemoveHtml($this->nama_pelanggan->caption());

		// jenis_pelanggan
		$this->jenis_pelanggan->EditCustomAttributes = "";
		$this->jenis_pelanggan->EditValue = $this->jenis_pelanggan->options(FALSE);

		// tgllahir_pelanggan
		$this->tgllahir_pelanggan->EditAttrs["class"] = "form-control";
		$this->tgllahir_pelanggan->EditCustomAttributes = "";
		$this->tgllahir_pelanggan->EditValue = FormatDateTime($this->tgllahir_pelanggan->CurrentValue, 8);
		$this->tgllahir_pelanggan->PlaceHolder = RemoveHtml($this->tgllahir_pelanggan->caption());

		// pekerjaan_pelanggan
		$this->pekerjaan_pelanggan->EditAttrs["class"] = "form-control";
		$this->pekerjaan_pelanggan->EditCustomAttributes = "";

		// kota_pelanggan
		$this->kota_pelanggan->EditAttrs["class"] = "form-control";
		$this->kota_pelanggan->EditCustomAttributes = "";

		// alamat_pelanggan
		$this->alamat_pelanggan->EditAttrs["class"] = "form-control";
		$this->alamat_pelanggan->EditCustomAttributes = "";
		if (!$this->alamat_pelanggan->Raw)
			$this->alamat_pelanggan->CurrentValue = HtmlDecode($this->alamat_pelanggan->CurrentValue);
		$this->alamat_pelanggan->EditValue = $this->alamat_pelanggan->CurrentValue;
		$this->alamat_pelanggan->PlaceHolder = RemoveHtml($this->alamat_pelanggan->caption());

		// telpon_pelanggan
		$this->telpon_pelanggan->EditAttrs["class"] = "form-control";
		$this->telpon_pelanggan->EditCustomAttributes = "";
		if (!$this->telpon_pelanggan->Raw)
			$this->telpon_pelanggan->CurrentValue = HtmlDecode($this->telpon_pelanggan->CurrentValue);
		$this->telpon_pelanggan->EditValue = $this->telpon_pelanggan->CurrentValue;
		$this->telpon_pelanggan->PlaceHolder = RemoveHtml($this->telpon_pelanggan->caption());

		// hp_pelanggan
		$this->hp_pelanggan->EditAttrs["class"] = "form-control";
		$this->hp_pelanggan->EditCustomAttributes = "";
		if (!$this->hp_pelanggan->Raw)
			$this->hp_pelanggan->CurrentValue = HtmlDecode($this->hp_pelanggan->CurrentValue);
		$this->hp_pelanggan->EditValue = $this->hp_pelanggan->CurrentValue;
		$this->hp_pelanggan->PlaceHolder = RemoveHtml($this->hp_pelanggan->caption());

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// tgl_daftar
		$this->tgl_daftar->EditAttrs["class"] = "form-control";
		$this->tgl_daftar->EditCustomAttributes = "";
		$this->tgl_daftar->EditValue = FormatDateTime($this->tgl_daftar->CurrentValue, 7);
		$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

		// kategori
		$this->kategori->EditAttrs["class"] = "form-control";
		$this->kategori->EditCustomAttributes = "";

		// tipe
		$this->tipe->EditAttrs["class"] = "form-control";
		$this->tipe->EditCustomAttributes = "";

		// tgl_terakhir_transaksi
		$this->tgl_terakhir_transaksi->EditAttrs["class"] = "form-control";
		$this->tgl_terakhir_transaksi->EditCustomAttributes = "";
		$this->tgl_terakhir_transaksi->EditValue = FormatDateTime($this->tgl_terakhir_transaksi->CurrentValue, 8);
		$this->tgl_terakhir_transaksi->PlaceHolder = RemoveHtml($this->tgl_terakhir_transaksi->caption());

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
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->kode_pelanggan);
					$doc->exportCaption($this->noktp_pelanggan);
					$doc->exportCaption($this->nama_pelanggan);
					$doc->exportCaption($this->jenis_pelanggan);
					$doc->exportCaption($this->tgllahir_pelanggan);
					$doc->exportCaption($this->pekerjaan_pelanggan);
					$doc->exportCaption($this->kota_pelanggan);
					$doc->exportCaption($this->alamat_pelanggan);
					$doc->exportCaption($this->telpon_pelanggan);
					$doc->exportCaption($this->hp_pelanggan);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->tgl_daftar);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->tipe);
				} else {
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->kode_pelanggan);
					$doc->exportCaption($this->noktp_pelanggan);
					$doc->exportCaption($this->nama_pelanggan);
					$doc->exportCaption($this->jenis_pelanggan);
					$doc->exportCaption($this->tgllahir_pelanggan);
					$doc->exportCaption($this->pekerjaan_pelanggan);
					$doc->exportCaption($this->kota_pelanggan);
					$doc->exportCaption($this->alamat_pelanggan);
					$doc->exportCaption($this->telpon_pelanggan);
					$doc->exportCaption($this->hp_pelanggan);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->tgl_daftar);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->tipe);
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
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->kode_pelanggan);
						$doc->exportField($this->noktp_pelanggan);
						$doc->exportField($this->nama_pelanggan);
						$doc->exportField($this->jenis_pelanggan);
						$doc->exportField($this->tgllahir_pelanggan);
						$doc->exportField($this->pekerjaan_pelanggan);
						$doc->exportField($this->kota_pelanggan);
						$doc->exportField($this->alamat_pelanggan);
						$doc->exportField($this->telpon_pelanggan);
						$doc->exportField($this->hp_pelanggan);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->tgl_daftar);
						$doc->exportField($this->kategori);
						$doc->exportField($this->tipe);
					} else {
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->kode_pelanggan);
						$doc->exportField($this->noktp_pelanggan);
						$doc->exportField($this->nama_pelanggan);
						$doc->exportField($this->jenis_pelanggan);
						$doc->exportField($this->tgllahir_pelanggan);
						$doc->exportField($this->pekerjaan_pelanggan);
						$doc->exportField($this->kota_pelanggan);
						$doc->exportField($this->alamat_pelanggan);
						$doc->exportField($this->telpon_pelanggan);
						$doc->exportField($this->hp_pelanggan);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->tgl_daftar);
						$doc->exportField($this->kategori);
						$doc->exportField($this->tipe);
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
		if($this->tgllahir_pelanggan->AdvancedSearch->SearchValue != NULL OR $this->tgllahir_pelanggan->AdvancedSearch->SearchValue != ''){
		$tgl_lahir = $this->tgllahir_pelanggan->AdvancedSearch->SearchValue;
		$explode = explode("/",$tgl_lahir);
		$tgl = $explode[0];
		$bln = $explode[1];
		$search = $bln."-".$tgl;

		//var_dump($search);
			$filter = "tgllahir_pelanggan LIKE '%".$search."%'";

			//AddFilter();
		}
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

		$id_klinik = $rsnew['id_klinik'];

		// Mendapatkan kode pelanggan terakhir pada klinik $id_klinik, untuk diambil nomor urutnya
		$kode_pelanggan_sebelumnya = ExecuteScalar("SELECT kode_pelanggan FROM m_pelanggan ORDER BY id_pelanggan DESC");
		$kode = explode('-', $kode_pelanggan_sebelumnya);
		$nomor_urut_terakhir = $kode[1];
		$nomor_urut = '0000000';
		if ($kode_pelanggan_sebelumnya != '') {
			$nomor_urut = sprintf('%07d', (int)$nomor_urut_terakhir + 1);
		} else {
			$nomor_urut = sprintf('%07d', 1);
		}

		/* kode pelanggan dengan format ALD-0000000 */
		$rsnew['kode_pelanggan'] = 'ALD-' . $nomor_urut;	
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
		$default_tipe = ExecuteScalar("SELECT id_tipe FROM m_tipepelanggan WHERE nama_tipe LIKE '%Aktif%'");
		$this->tipe->CurrentValue = $default_tipe;
		$default_kategori = ExecuteScalar("SELECT id_kategori FROM m_kategoripelanggan WHERE nama_kategori LIKE '%Umum%'");
		$this->kategori->CurrentValue = $default_kategori;
	}
	// User ID Filtering event
	function UserID_Filtering(&$filter) {
		// Enter your code here
	}
}
?>