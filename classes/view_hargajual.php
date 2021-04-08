<?php namespace PHPMaker2020\klinik_latest_08_04_21; ?>
<?php

/**
 * Table class for view_hargajual
 */
class view_hargajual extends DbTable
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
	public $id;
	public $kode_barang;
	public $nama_barang;
	public $satuan;
	public $jenis;
	public $kategori;
	public $subkategori;
	public $totalhargajual;
	public $id_hargajual;
	public $id_barang;
	public $id_klinik;
	public $nama_klinik;
	public $telpon_klinik;
	public $alamat_klinik;
	public $foto_klinik;
	public $stok;
	public $komposisi;
	public $status;
	public $tipe;
	public $tgl_exp;
	public $disc_rp;
	public $disc_pr;
	public $discontinue;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'view_hargajual';
		$this->TableName = 'view_hargajual';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`view_hargajual`";
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

		// id
		$this->id = new DbField('view_hargajual', 'view_hargajual', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// kode_barang
		$this->kode_barang = new DbField('view_hargajual', 'view_hargajual', 'x_kode_barang', 'kode_barang', '`kode_barang`', '`kode_barang`', 200, 255, -1, FALSE, '`kode_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_barang->Sortable = TRUE; // Allow sort
		$this->fields['kode_barang'] = &$this->kode_barang;

		// nama_barang
		$this->nama_barang = new DbField('view_hargajual', 'view_hargajual', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 255, -1, FALSE, '`nama_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_barang->Sortable = TRUE; // Allow sort
		$this->fields['nama_barang'] = &$this->nama_barang;

		// satuan
		$this->satuan = new DbField('view_hargajual', 'view_hargajual', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 3, 11, -1, FALSE, '`satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->satuan->Sortable = TRUE; // Allow sort
		$this->satuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['satuan'] = &$this->satuan;

		// jenis
		$this->jenis = new DbField('view_hargajual', 'view_hargajual', 'x_jenis', 'jenis', '`jenis`', '`jenis`', 3, 11, -1, FALSE, '`jenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis->Sortable = TRUE; // Allow sort
		$this->jenis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenis'] = &$this->jenis;

		// kategori
		$this->kategori = new DbField('view_hargajual', 'view_hargajual', 'x_kategori', 'kategori', '`kategori`', '`kategori`', 3, 11, -1, FALSE, '`kategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kategori->Sortable = TRUE; // Allow sort
		$this->kategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kategori'] = &$this->kategori;

		// subkategori
		$this->subkategori = new DbField('view_hargajual', 'view_hargajual', 'x_subkategori', 'subkategori', '`subkategori`', '`subkategori`', 3, 11, -1, FALSE, '`subkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subkategori->Sortable = TRUE; // Allow sort
		$this->subkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['subkategori'] = &$this->subkategori;

		// totalhargajual
		$this->totalhargajual = new DbField('view_hargajual', 'view_hargajual', 'x_totalhargajual', 'totalhargajual', '`totalhargajual`', '`totalhargajual`', 5, 22, -1, FALSE, '`totalhargajual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->totalhargajual->Sortable = TRUE; // Allow sort
		$this->totalhargajual->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['totalhargajual'] = &$this->totalhargajual;

		// id_hargajual
		$this->id_hargajual = new DbField('view_hargajual', 'view_hargajual', 'x_id_hargajual', 'id_hargajual', '`id_hargajual`', '`id_hargajual`', 3, 11, -1, FALSE, '`id_hargajual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_hargajual->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_hargajual->Sortable = TRUE; // Allow sort
		$this->id_hargajual->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_hargajual'] = &$this->id_hargajual;

		// id_barang
		$this->id_barang = new DbField('view_hargajual', 'view_hargajual', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// id_klinik
		$this->id_klinik = new DbField('view_hargajual', 'view_hargajual', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 19, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_klinik->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// nama_klinik
		$this->nama_klinik = new DbField('view_hargajual', 'view_hargajual', 'x_nama_klinik', 'nama_klinik', '`nama_klinik`', '`nama_klinik`', 200, 255, -1, FALSE, '`nama_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_klinik->Sortable = TRUE; // Allow sort
		$this->fields['nama_klinik'] = &$this->nama_klinik;

		// telpon_klinik
		$this->telpon_klinik = new DbField('view_hargajual', 'view_hargajual', 'x_telpon_klinik', 'telpon_klinik', '`telpon_klinik`', '`telpon_klinik`', 201, 65535, -1, FALSE, '`telpon_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->telpon_klinik->Sortable = TRUE; // Allow sort
		$this->fields['telpon_klinik'] = &$this->telpon_klinik;

		// alamat_klinik
		$this->alamat_klinik = new DbField('view_hargajual', 'view_hargajual', 'x_alamat_klinik', 'alamat_klinik', '`alamat_klinik`', '`alamat_klinik`', 201, 65535, -1, FALSE, '`alamat_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->alamat_klinik->Sortable = TRUE; // Allow sort
		$this->fields['alamat_klinik'] = &$this->alamat_klinik;

		// foto_klinik
		$this->foto_klinik = new DbField('view_hargajual', 'view_hargajual', 'x_foto_klinik', 'foto_klinik', '`foto_klinik`', '`foto_klinik`', 200, 255, -1, FALSE, '`foto_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->foto_klinik->Sortable = TRUE; // Allow sort
		$this->fields['foto_klinik'] = &$this->foto_klinik;

		// stok
		$this->stok = new DbField('view_hargajual', 'view_hargajual', 'x_stok', 'stok', '`stok`', '`stok`', 4, 12, -1, FALSE, '`stok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok->Sortable = TRUE; // Allow sort
		$this->stok->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['stok'] = &$this->stok;

		// komposisi
		$this->komposisi = new DbField('view_hargajual', 'view_hargajual', 'x_komposisi', 'komposisi', '`komposisi`', '`komposisi`', 202, 3, -1, FALSE, '`komposisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->komposisi->Sortable = TRUE; // Allow sort
		$this->komposisi->Lookup = new Lookup('komposisi', 'view_hargajual', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->komposisi->OptionCount = 2;
		$this->fields['komposisi'] = &$this->komposisi;

		// status
		$this->status = new DbField('view_hargajual', 'view_hargajual', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// tipe
		$this->tipe = new DbField('view_hargajual', 'view_hargajual', 'x_tipe', 'tipe', '`tipe`', '`tipe`', 202, 9, -1, FALSE, '`tipe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->tipe->Sortable = TRUE; // Allow sort
		$this->tipe->Lookup = new Lookup('tipe', 'view_hargajual', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->tipe->OptionCount = 4;
		$this->fields['tipe'] = &$this->tipe;

		// tgl_exp
		$this->tgl_exp = new DbField('view_hargajual', 'view_hargajual', 'x_tgl_exp', 'tgl_exp', '`tgl_exp`', CastDateFieldForLike("`tgl_exp`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_exp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_exp->Sortable = TRUE; // Allow sort
		$this->tgl_exp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_exp'] = &$this->tgl_exp;

		// disc_rp
		$this->disc_rp = new DbField('view_hargajual', 'view_hargajual', 'x_disc_rp', 'disc_rp', '`disc_rp`', '`disc_rp`', 5, 22, -1, FALSE, '`disc_rp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_rp->Sortable = TRUE; // Allow sort
		$this->disc_rp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_rp'] = &$this->disc_rp;

		// disc_pr
		$this->disc_pr = new DbField('view_hargajual', 'view_hargajual', 'x_disc_pr', 'disc_pr', '`disc_pr`', '`disc_pr`', 5, 22, -1, FALSE, '`disc_pr`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_pr->Sortable = TRUE; // Allow sort
		$this->disc_pr->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_pr'] = &$this->disc_pr;

		// discontinue
		$this->discontinue = new DbField('view_hargajual', 'view_hargajual', 'x_discontinue', 'discontinue', '`discontinue`', '`discontinue`', 202, 3, -1, FALSE, '`discontinue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->discontinue->Sortable = TRUE; // Allow sort
		$this->discontinue->Lookup = new Lookup('discontinue', 'view_hargajual', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->discontinue->OptionCount = 2;
		$this->fields['discontinue'] = &$this->discontinue;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`view_hargajual`";
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
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;

			// Get insert id if necessary
			$this->id_hargajual->setDbValue($conn->insert_ID());
			$rs['id_hargajual'] = $this->id_hargajual->DbValue;

			// Get insert id if necessary
			$this->id_klinik->setDbValue($conn->insert_ID());
			$rs['id_klinik'] = $this->id_klinik->DbValue;
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
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
		$this->id->DbValue = $row['id'];
		$this->kode_barang->DbValue = $row['kode_barang'];
		$this->nama_barang->DbValue = $row['nama_barang'];
		$this->satuan->DbValue = $row['satuan'];
		$this->jenis->DbValue = $row['jenis'];
		$this->kategori->DbValue = $row['kategori'];
		$this->subkategori->DbValue = $row['subkategori'];
		$this->totalhargajual->DbValue = $row['totalhargajual'];
		$this->id_hargajual->DbValue = $row['id_hargajual'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->nama_klinik->DbValue = $row['nama_klinik'];
		$this->telpon_klinik->DbValue = $row['telpon_klinik'];
		$this->alamat_klinik->DbValue = $row['alamat_klinik'];
		$this->foto_klinik->DbValue = $row['foto_klinik'];
		$this->stok->DbValue = $row['stok'];
		$this->komposisi->DbValue = $row['komposisi'];
		$this->status->DbValue = $row['status'];
		$this->tipe->DbValue = $row['tipe'];
		$this->tgl_exp->DbValue = $row['tgl_exp'];
		$this->disc_rp->DbValue = $row['disc_rp'];
		$this->disc_pr->DbValue = $row['disc_pr'];
		$this->discontinue->DbValue = $row['discontinue'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "view_hargajuallist.php";
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
		if ($pageName == "view_hargajualview.php")
			return $Language->phrase("View");
		elseif ($pageName == "view_hargajualedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "view_hargajualadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "view_hargajuallist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("view_hargajualview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("view_hargajualview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "view_hargajualadd.php?" . $this->getUrlParm($parm);
		else
			$url = "view_hargajualadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("view_hargajualedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("view_hargajualadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("view_hargajualdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
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
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
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
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
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
		$this->id->setDbValue($rs->fields('id'));
		$this->kode_barang->setDbValue($rs->fields('kode_barang'));
		$this->nama_barang->setDbValue($rs->fields('nama_barang'));
		$this->satuan->setDbValue($rs->fields('satuan'));
		$this->jenis->setDbValue($rs->fields('jenis'));
		$this->kategori->setDbValue($rs->fields('kategori'));
		$this->subkategori->setDbValue($rs->fields('subkategori'));
		$this->totalhargajual->setDbValue($rs->fields('totalhargajual'));
		$this->id_hargajual->setDbValue($rs->fields('id_hargajual'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->nama_klinik->setDbValue($rs->fields('nama_klinik'));
		$this->telpon_klinik->setDbValue($rs->fields('telpon_klinik'));
		$this->alamat_klinik->setDbValue($rs->fields('alamat_klinik'));
		$this->foto_klinik->setDbValue($rs->fields('foto_klinik'));
		$this->stok->setDbValue($rs->fields('stok'));
		$this->komposisi->setDbValue($rs->fields('komposisi'));
		$this->status->setDbValue($rs->fields('status'));
		$this->tipe->setDbValue($rs->fields('tipe'));
		$this->tgl_exp->setDbValue($rs->fields('tgl_exp'));
		$this->disc_rp->setDbValue($rs->fields('disc_rp'));
		$this->disc_pr->setDbValue($rs->fields('disc_pr'));
		$this->discontinue->setDbValue($rs->fields('discontinue'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// kode_barang
		// nama_barang
		// satuan
		// jenis
		// kategori
		// subkategori
		// totalhargajual
		// id_hargajual
		// id_barang
		// id_klinik
		// nama_klinik
		// telpon_klinik
		// alamat_klinik
		// foto_klinik
		// stok
		// komposisi
		// status
		// tipe
		// tgl_exp
		// disc_rp
		// disc_pr
		// discontinue
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kode_barang
		$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->ViewCustomAttributes = "";

		// nama_barang
		$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
		$this->nama_barang->ViewCustomAttributes = "";

		// satuan
		$this->satuan->ViewValue = $this->satuan->CurrentValue;
		$this->satuan->ViewValue = FormatNumber($this->satuan->ViewValue, 0, -2, -2, -2);
		$this->satuan->ViewCustomAttributes = "";

		// jenis
		$this->jenis->ViewValue = $this->jenis->CurrentValue;
		$this->jenis->ViewValue = FormatNumber($this->jenis->ViewValue, 0, -2, -2, -2);
		$this->jenis->ViewCustomAttributes = "";

		// kategori
		$this->kategori->ViewValue = $this->kategori->CurrentValue;
		$this->kategori->ViewValue = FormatNumber($this->kategori->ViewValue, 0, -2, -2, -2);
		$this->kategori->ViewCustomAttributes = "";

		// subkategori
		$this->subkategori->ViewValue = $this->subkategori->CurrentValue;
		$this->subkategori->ViewValue = FormatNumber($this->subkategori->ViewValue, 0, -2, -2, -2);
		$this->subkategori->ViewCustomAttributes = "";

		// totalhargajual
		$this->totalhargajual->ViewValue = $this->totalhargajual->CurrentValue;
		$this->totalhargajual->ViewValue = FormatNumber($this->totalhargajual->ViewValue, 0, -2, -2, -2);
		$this->totalhargajual->ViewCustomAttributes = "";

		// id_hargajual
		$this->id_hargajual->ViewValue = $this->id_hargajual->CurrentValue;
		$this->id_hargajual->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$this->id_barang->ViewValue = FormatNumber($this->id_barang->ViewValue, 0, -2, -2, -2);
		$this->id_barang->ViewCustomAttributes = "";

		// id_klinik
		$this->id_klinik->ViewValue = $this->id_klinik->CurrentValue;
		$this->id_klinik->ViewValue = FormatNumber($this->id_klinik->ViewValue, 0, -2, -2, -2);
		$this->id_klinik->ViewCustomAttributes = "";

		// nama_klinik
		$this->nama_klinik->ViewValue = $this->nama_klinik->CurrentValue;
		$this->nama_klinik->ViewCustomAttributes = "";

		// telpon_klinik
		$this->telpon_klinik->ViewValue = $this->telpon_klinik->CurrentValue;
		$this->telpon_klinik->ViewCustomAttributes = "";

		// alamat_klinik
		$this->alamat_klinik->ViewValue = $this->alamat_klinik->CurrentValue;
		$this->alamat_klinik->ViewCustomAttributes = "";

		// foto_klinik
		$this->foto_klinik->ViewValue = $this->foto_klinik->CurrentValue;
		$this->foto_klinik->ViewCustomAttributes = "";

		// stok
		$this->stok->ViewValue = $this->stok->CurrentValue;
		$this->stok->ViewValue = FormatNumber($this->stok->ViewValue, 2, -2, -2, -2);
		$this->stok->ViewCustomAttributes = "";

		// komposisi
		if (strval($this->komposisi->CurrentValue) != "") {
			$this->komposisi->ViewValue = $this->komposisi->optionCaption($this->komposisi->CurrentValue);
		} else {
			$this->komposisi->ViewValue = NULL;
		}
		$this->komposisi->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewValue = FormatNumber($this->status->ViewValue, 0, -2, -2, -2);
		$this->status->ViewCustomAttributes = "";

		// tipe
		if (strval($this->tipe->CurrentValue) != "") {
			$this->tipe->ViewValue = $this->tipe->optionCaption($this->tipe->CurrentValue);
		} else {
			$this->tipe->ViewValue = NULL;
		}
		$this->tipe->ViewCustomAttributes = "";

		// tgl_exp
		$this->tgl_exp->ViewValue = $this->tgl_exp->CurrentValue;
		$this->tgl_exp->ViewValue = FormatDateTime($this->tgl_exp->ViewValue, 0);
		$this->tgl_exp->ViewCustomAttributes = "";

		// disc_rp
		$this->disc_rp->ViewValue = $this->disc_rp->CurrentValue;
		$this->disc_rp->ViewValue = FormatNumber($this->disc_rp->ViewValue, 2, -2, -2, -2);
		$this->disc_rp->ViewCustomAttributes = "";

		// disc_pr
		$this->disc_pr->ViewValue = $this->disc_pr->CurrentValue;
		$this->disc_pr->ViewValue = FormatNumber($this->disc_pr->ViewValue, 2, -2, -2, -2);
		$this->disc_pr->ViewCustomAttributes = "";

		// discontinue
		if (strval($this->discontinue->CurrentValue) != "") {
			$this->discontinue->ViewValue = $this->discontinue->optionCaption($this->discontinue->CurrentValue);
		} else {
			$this->discontinue->ViewValue = NULL;
		}
		$this->discontinue->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// kode_barang
		$this->kode_barang->LinkCustomAttributes = "";
		$this->kode_barang->HrefValue = "";
		$this->kode_barang->TooltipValue = "";

		// nama_barang
		$this->nama_barang->LinkCustomAttributes = "";
		$this->nama_barang->HrefValue = "";
		$this->nama_barang->TooltipValue = "";

		// satuan
		$this->satuan->LinkCustomAttributes = "";
		$this->satuan->HrefValue = "";
		$this->satuan->TooltipValue = "";

		// jenis
		$this->jenis->LinkCustomAttributes = "";
		$this->jenis->HrefValue = "";
		$this->jenis->TooltipValue = "";

		// kategori
		$this->kategori->LinkCustomAttributes = "";
		$this->kategori->HrefValue = "";
		$this->kategori->TooltipValue = "";

		// subkategori
		$this->subkategori->LinkCustomAttributes = "";
		$this->subkategori->HrefValue = "";
		$this->subkategori->TooltipValue = "";

		// totalhargajual
		$this->totalhargajual->LinkCustomAttributes = "";
		$this->totalhargajual->HrefValue = "";
		$this->totalhargajual->TooltipValue = "";

		// id_hargajual
		$this->id_hargajual->LinkCustomAttributes = "";
		$this->id_hargajual->HrefValue = "";
		$this->id_hargajual->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// nama_klinik
		$this->nama_klinik->LinkCustomAttributes = "";
		$this->nama_klinik->HrefValue = "";
		$this->nama_klinik->TooltipValue = "";

		// telpon_klinik
		$this->telpon_klinik->LinkCustomAttributes = "";
		$this->telpon_klinik->HrefValue = "";
		$this->telpon_klinik->TooltipValue = "";

		// alamat_klinik
		$this->alamat_klinik->LinkCustomAttributes = "";
		$this->alamat_klinik->HrefValue = "";
		$this->alamat_klinik->TooltipValue = "";

		// foto_klinik
		$this->foto_klinik->LinkCustomAttributes = "";
		$this->foto_klinik->HrefValue = "";
		$this->foto_klinik->TooltipValue = "";

		// stok
		$this->stok->LinkCustomAttributes = "";
		$this->stok->HrefValue = "";
		$this->stok->TooltipValue = "";

		// komposisi
		$this->komposisi->LinkCustomAttributes = "";
		$this->komposisi->HrefValue = "";
		$this->komposisi->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// tipe
		$this->tipe->LinkCustomAttributes = "";
		$this->tipe->HrefValue = "";
		$this->tipe->TooltipValue = "";

		// tgl_exp
		$this->tgl_exp->LinkCustomAttributes = "";
		$this->tgl_exp->HrefValue = "";
		$this->tgl_exp->TooltipValue = "";

		// disc_rp
		$this->disc_rp->LinkCustomAttributes = "";
		$this->disc_rp->HrefValue = "";
		$this->disc_rp->TooltipValue = "";

		// disc_pr
		$this->disc_pr->LinkCustomAttributes = "";
		$this->disc_pr->HrefValue = "";
		$this->disc_pr->TooltipValue = "";

		// discontinue
		$this->discontinue->LinkCustomAttributes = "";
		$this->discontinue->HrefValue = "";
		$this->discontinue->TooltipValue = "";

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

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kode_barang
		$this->kode_barang->EditAttrs["class"] = "form-control";
		$this->kode_barang->EditCustomAttributes = "";
		if (!$this->kode_barang->Raw)
			$this->kode_barang->CurrentValue = HtmlDecode($this->kode_barang->CurrentValue);
		$this->kode_barang->EditValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->PlaceHolder = RemoveHtml($this->kode_barang->caption());

		// nama_barang
		$this->nama_barang->EditAttrs["class"] = "form-control";
		$this->nama_barang->EditCustomAttributes = "";
		if (!$this->nama_barang->Raw)
			$this->nama_barang->CurrentValue = HtmlDecode($this->nama_barang->CurrentValue);
		$this->nama_barang->EditValue = $this->nama_barang->CurrentValue;
		$this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

		// satuan
		$this->satuan->EditAttrs["class"] = "form-control";
		$this->satuan->EditCustomAttributes = "";
		$this->satuan->EditValue = $this->satuan->CurrentValue;
		$this->satuan->PlaceHolder = RemoveHtml($this->satuan->caption());

		// jenis
		$this->jenis->EditAttrs["class"] = "form-control";
		$this->jenis->EditCustomAttributes = "";
		$this->jenis->EditValue = $this->jenis->CurrentValue;
		$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

		// kategori
		$this->kategori->EditAttrs["class"] = "form-control";
		$this->kategori->EditCustomAttributes = "";
		$this->kategori->EditValue = $this->kategori->CurrentValue;
		$this->kategori->PlaceHolder = RemoveHtml($this->kategori->caption());

		// subkategori
		$this->subkategori->EditAttrs["class"] = "form-control";
		$this->subkategori->EditCustomAttributes = "";
		$this->subkategori->EditValue = $this->subkategori->CurrentValue;
		$this->subkategori->PlaceHolder = RemoveHtml($this->subkategori->caption());

		// totalhargajual
		$this->totalhargajual->EditAttrs["class"] = "form-control";
		$this->totalhargajual->EditCustomAttributes = "";
		$this->totalhargajual->EditValue = $this->totalhargajual->CurrentValue;
		$this->totalhargajual->PlaceHolder = RemoveHtml($this->totalhargajual->caption());
		if (strval($this->totalhargajual->EditValue) != "" && is_numeric($this->totalhargajual->EditValue))
			$this->totalhargajual->EditValue = FormatNumber($this->totalhargajual->EditValue, -2, -2, -2, -2);
		

		// id_hargajual
		$this->id_hargajual->EditAttrs["class"] = "form-control";
		$this->id_hargajual->EditCustomAttributes = "";
		$this->id_hargajual->EditValue = $this->id_hargajual->CurrentValue;
		$this->id_hargajual->PlaceHolder = RemoveHtml($this->id_hargajual->caption());

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";
		$this->id_klinik->EditValue = $this->id_klinik->CurrentValue;
		$this->id_klinik->PlaceHolder = RemoveHtml($this->id_klinik->caption());

		// nama_klinik
		$this->nama_klinik->EditAttrs["class"] = "form-control";
		$this->nama_klinik->EditCustomAttributes = "";
		if (!$this->nama_klinik->Raw)
			$this->nama_klinik->CurrentValue = HtmlDecode($this->nama_klinik->CurrentValue);
		$this->nama_klinik->EditValue = $this->nama_klinik->CurrentValue;
		$this->nama_klinik->PlaceHolder = RemoveHtml($this->nama_klinik->caption());

		// telpon_klinik
		$this->telpon_klinik->EditAttrs["class"] = "form-control";
		$this->telpon_klinik->EditCustomAttributes = "";
		$this->telpon_klinik->EditValue = $this->telpon_klinik->CurrentValue;
		$this->telpon_klinik->PlaceHolder = RemoveHtml($this->telpon_klinik->caption());

		// alamat_klinik
		$this->alamat_klinik->EditAttrs["class"] = "form-control";
		$this->alamat_klinik->EditCustomAttributes = "";
		$this->alamat_klinik->EditValue = $this->alamat_klinik->CurrentValue;
		$this->alamat_klinik->PlaceHolder = RemoveHtml($this->alamat_klinik->caption());

		// foto_klinik
		$this->foto_klinik->EditAttrs["class"] = "form-control";
		$this->foto_klinik->EditCustomAttributes = "";
		if (!$this->foto_klinik->Raw)
			$this->foto_klinik->CurrentValue = HtmlDecode($this->foto_klinik->CurrentValue);
		$this->foto_klinik->EditValue = $this->foto_klinik->CurrentValue;
		$this->foto_klinik->PlaceHolder = RemoveHtml($this->foto_klinik->caption());

		// stok
		$this->stok->EditAttrs["class"] = "form-control";
		$this->stok->EditCustomAttributes = "";
		$this->stok->EditValue = $this->stok->CurrentValue;
		$this->stok->PlaceHolder = RemoveHtml($this->stok->caption());
		if (strval($this->stok->EditValue) != "" && is_numeric($this->stok->EditValue))
			$this->stok->EditValue = FormatNumber($this->stok->EditValue, -2, -2, -2, -2);
		

		// komposisi
		$this->komposisi->EditCustomAttributes = "";
		$this->komposisi->EditValue = $this->komposisi->options(FALSE);

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

		// tipe
		$this->tipe->EditCustomAttributes = "";
		$this->tipe->EditValue = $this->tipe->options(FALSE);

		// tgl_exp
		$this->tgl_exp->EditAttrs["class"] = "form-control";
		$this->tgl_exp->EditCustomAttributes = "";
		$this->tgl_exp->EditValue = FormatDateTime($this->tgl_exp->CurrentValue, 8);
		$this->tgl_exp->PlaceHolder = RemoveHtml($this->tgl_exp->caption());

		// disc_rp
		$this->disc_rp->EditAttrs["class"] = "form-control";
		$this->disc_rp->EditCustomAttributes = "";
		$this->disc_rp->EditValue = $this->disc_rp->CurrentValue;
		$this->disc_rp->PlaceHolder = RemoveHtml($this->disc_rp->caption());
		if (strval($this->disc_rp->EditValue) != "" && is_numeric($this->disc_rp->EditValue))
			$this->disc_rp->EditValue = FormatNumber($this->disc_rp->EditValue, -2, -2, -2, -2);
		

		// disc_pr
		$this->disc_pr->EditAttrs["class"] = "form-control";
		$this->disc_pr->EditCustomAttributes = "";
		$this->disc_pr->EditValue = $this->disc_pr->CurrentValue;
		$this->disc_pr->PlaceHolder = RemoveHtml($this->disc_pr->caption());
		if (strval($this->disc_pr->EditValue) != "" && is_numeric($this->disc_pr->EditValue))
			$this->disc_pr->EditValue = FormatNumber($this->disc_pr->EditValue, -2, -2, -2, -2);
		

		// discontinue
		$this->discontinue->EditCustomAttributes = "";
		$this->discontinue->EditValue = $this->discontinue->options(FALSE);

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
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->subkategori);
					$doc->exportCaption($this->totalhargajual);
					$doc->exportCaption($this->id_hargajual);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->nama_klinik);
					$doc->exportCaption($this->telpon_klinik);
					$doc->exportCaption($this->alamat_klinik);
					$doc->exportCaption($this->foto_klinik);
					$doc->exportCaption($this->stok);
					$doc->exportCaption($this->komposisi);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->tgl_exp);
					$doc->exportCaption($this->disc_rp);
					$doc->exportCaption($this->disc_pr);
					$doc->exportCaption($this->discontinue);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->subkategori);
					$doc->exportCaption($this->totalhargajual);
					$doc->exportCaption($this->id_hargajual);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->nama_klinik);
					$doc->exportCaption($this->foto_klinik);
					$doc->exportCaption($this->stok);
					$doc->exportCaption($this->komposisi);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->tgl_exp);
					$doc->exportCaption($this->disc_rp);
					$doc->exportCaption($this->disc_pr);
					$doc->exportCaption($this->discontinue);
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
						$doc->exportField($this->id);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->satuan);
						$doc->exportField($this->jenis);
						$doc->exportField($this->kategori);
						$doc->exportField($this->subkategori);
						$doc->exportField($this->totalhargajual);
						$doc->exportField($this->id_hargajual);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->nama_klinik);
						$doc->exportField($this->telpon_klinik);
						$doc->exportField($this->alamat_klinik);
						$doc->exportField($this->foto_klinik);
						$doc->exportField($this->stok);
						$doc->exportField($this->komposisi);
						$doc->exportField($this->status);
						$doc->exportField($this->tipe);
						$doc->exportField($this->tgl_exp);
						$doc->exportField($this->disc_rp);
						$doc->exportField($this->disc_pr);
						$doc->exportField($this->discontinue);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->satuan);
						$doc->exportField($this->jenis);
						$doc->exportField($this->kategori);
						$doc->exportField($this->subkategori);
						$doc->exportField($this->totalhargajual);
						$doc->exportField($this->id_hargajual);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->nama_klinik);
						$doc->exportField($this->foto_klinik);
						$doc->exportField($this->stok);
						$doc->exportField($this->komposisi);
						$doc->exportField($this->status);
						$doc->exportField($this->tipe);
						$doc->exportField($this->tgl_exp);
						$doc->exportField($this->disc_rp);
						$doc->exportField($this->disc_pr);
						$doc->exportField($this->discontinue);
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

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>