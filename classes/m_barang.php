<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for m_barang
 */
class m_barang extends DbTable
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
	public $komposisi;
	public $tipe;
	public $status;
	public $shortname_barang;
	public $id_tag;
	public $discontinue;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_barang';
		$this->TableName = 'm_barang';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_barang`";
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
		$this->id = new DbField('m_barang', 'm_barang', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// kode_barang
		$this->kode_barang = new DbField('m_barang', 'm_barang', 'x_kode_barang', 'kode_barang', '`kode_barang`', '`kode_barang`', 200, 255, -1, FALSE, '`kode_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_barang->Sortable = TRUE; // Allow sort
		$this->fields['kode_barang'] = &$this->kode_barang;

		// nama_barang
		$this->nama_barang = new DbField('m_barang', 'm_barang', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 255, -1, FALSE, '`nama_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_barang->Sortable = TRUE; // Allow sort
		$this->fields['nama_barang'] = &$this->nama_barang;

		// satuan
		$this->satuan = new DbField('m_barang', 'm_barang', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 3, 11, -1, FALSE, '`satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->satuan->Sortable = TRUE; // Allow sort
		$this->satuan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->satuan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->satuan->Lookup = new Lookup('satuan', 'm_satuan_barang', FALSE, 'id_satuan', ["nama_satuan","","",""], [], [], [], [], [], [], '', '');
		$this->satuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['satuan'] = &$this->satuan;

		// jenis
		$this->jenis = new DbField('m_barang', 'm_barang', 'x_jenis', 'jenis', '`jenis`', '`jenis`', 3, 11, -1, FALSE, '`jenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenis->Sortable = TRUE; // Allow sort
		$this->jenis->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenis->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenis->Lookup = new Lookup('jenis', 'jenisbarang', FALSE, 'id', ["jenis","","",""], [], [], [], [], [], [], '', '');
		$this->jenis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenis'] = &$this->jenis;

		// kategori
		$this->kategori = new DbField('m_barang', 'm_barang', 'x_kategori', 'kategori', '`kategori`', '`kategori`', 3, 11, -1, FALSE, '`kategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kategori->Sortable = TRUE; // Allow sort
		$this->kategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kategori->Lookup = new Lookup('kategori', 'kategoribarang', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->kategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kategori'] = &$this->kategori;

		// subkategori
		$this->subkategori = new DbField('m_barang', 'm_barang', 'x_subkategori', 'subkategori', '`subkategori`', '`subkategori`', 3, 11, -1, FALSE, '`subkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->subkategori->Sortable = TRUE; // Allow sort
		$this->subkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->subkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->subkategori->Lookup = new Lookup('subkategori', 'subkategoribarang', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->subkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['subkategori'] = &$this->subkategori;

		// komposisi
		$this->komposisi = new DbField('m_barang', 'm_barang', 'x_komposisi', 'komposisi', '`komposisi`', '`komposisi`', 202, 3, -1, FALSE, '`komposisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->komposisi->Sortable = TRUE; // Allow sort
		$this->komposisi->Lookup = new Lookup('komposisi', 'm_barang', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->komposisi->OptionCount = 2;
		$this->fields['komposisi'] = &$this->komposisi;

		// tipe
		$this->tipe = new DbField('m_barang', 'm_barang', 'x_tipe', 'tipe', '`tipe`', '`tipe`', 202, 9, -1, FALSE, '`tipe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->tipe->Sortable = TRUE; // Allow sort
		$this->tipe->Lookup = new Lookup('tipe', 'm_barang', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->tipe->OptionCount = 4;
		$this->fields['tipe'] = &$this->tipe;

		// status
		$this->status = new DbField('m_barang', 'm_barang', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->status->Lookup = new Lookup('status', 'm_status_barang', FALSE, 'id_status', ["status_barang","","",""], [], [], [], [], [], [], '', '');
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// shortname_barang
		$this->shortname_barang = new DbField('m_barang', 'm_barang', 'x_shortname_barang', 'shortname_barang', '`shortname_barang`', '`shortname_barang`', 200, 100, -1, FALSE, '`shortname_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->shortname_barang->Sortable = TRUE; // Allow sort
		$this->fields['shortname_barang'] = &$this->shortname_barang;

		// id_tag
		$this->id_tag = new DbField('m_barang', 'm_barang', 'x_id_tag', 'id_tag', '`id_tag`', '`id_tag`', 3, 11, -1, FALSE, '`id_tag`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_tag->Sortable = TRUE; // Allow sort
		$this->id_tag->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_tag->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_tag->Lookup = new Lookup('id_tag', 'm_tags', FALSE, 'id', ["nama_tag","","",""], [], [], [], [], [], [], '', '');
		$this->id_tag->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_tag'] = &$this->id_tag;

		// discontinue
		$this->discontinue = new DbField('m_barang', 'm_barang', 'x_discontinue', 'discontinue', '`discontinue`', '`discontinue`', 202, 3, -1, FALSE, '`discontinue`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->discontinue->Sortable = TRUE; // Allow sort
		$this->discontinue->Lookup = new Lookup('discontinue', 'm_barang', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_barang`";
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
		$this->komposisi->DbValue = $row['komposisi'];
		$this->tipe->DbValue = $row['tipe'];
		$this->status->DbValue = $row['status'];
		$this->shortname_barang->DbValue = $row['shortname_barang'];
		$this->id_tag->DbValue = $row['id_tag'];
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
			return "m_baranglist.php";
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
		if ($pageName == "m_barangview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_barangedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_barangadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_baranglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_barangview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_barangview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_barangadd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_barangadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_barangedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_barangadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_barangdelete.php", $this->getUrlParm());
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
		$this->komposisi->setDbValue($rs->fields('komposisi'));
		$this->tipe->setDbValue($rs->fields('tipe'));
		$this->status->setDbValue($rs->fields('status'));
		$this->shortname_barang->setDbValue($rs->fields('shortname_barang'));
		$this->id_tag->setDbValue($rs->fields('id_tag'));
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
		// komposisi
		// tipe
		// status
		// shortname_barang
		// id_tag
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
		$curVal = strval($this->satuan->CurrentValue);
		if ($curVal != "") {
			$this->satuan->ViewValue = $this->satuan->lookupCacheOption($curVal);
			if ($this->satuan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_satuan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->satuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->satuan->ViewValue = $this->satuan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->satuan->ViewValue = $this->satuan->CurrentValue;
				}
			}
		} else {
			$this->satuan->ViewValue = NULL;
		}
		$this->satuan->ViewCustomAttributes = "";

		// jenis
		$curVal = strval($this->jenis->CurrentValue);
		if ($curVal != "") {
			$this->jenis->ViewValue = $this->jenis->lookupCacheOption($curVal);
			if ($this->jenis->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jenis->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jenis->ViewValue = $this->jenis->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jenis->ViewValue = $this->jenis->CurrentValue;
				}
			}
		} else {
			$this->jenis->ViewValue = NULL;
		}
		$this->jenis->ViewCustomAttributes = "";

		// kategori
		$curVal = strval($this->kategori->CurrentValue);
		if ($curVal != "") {
			$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
			if ($this->kategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

		// subkategori
		$curVal = strval($this->subkategori->CurrentValue);
		if ($curVal != "") {
			$this->subkategori->ViewValue = $this->subkategori->lookupCacheOption($curVal);
			if ($this->subkategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->subkategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->subkategori->ViewValue = $this->subkategori->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->subkategori->ViewValue = $this->subkategori->CurrentValue;
				}
			}
		} else {
			$this->subkategori->ViewValue = NULL;
		}
		$this->subkategori->ViewCustomAttributes = "";

		// komposisi
		if (strval($this->komposisi->CurrentValue) != "") {
			$this->komposisi->ViewValue = $this->komposisi->optionCaption($this->komposisi->CurrentValue);
		} else {
			$this->komposisi->ViewValue = NULL;
		}
		$this->komposisi->ViewCustomAttributes = "";

		// tipe
		if (strval($this->tipe->CurrentValue) != "") {
			$this->tipe->ViewValue = $this->tipe->optionCaption($this->tipe->CurrentValue);
		} else {
			$this->tipe->ViewValue = NULL;
		}
		$this->tipe->ViewCustomAttributes = "";

		// status
		$curVal = strval($this->status->CurrentValue);
		if ($curVal != "") {
			$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
			if ($this->status->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_status`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->status->ViewValue = $this->status->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status->ViewValue = $this->status->CurrentValue;
				}
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// shortname_barang
		$this->shortname_barang->ViewValue = $this->shortname_barang->CurrentValue;
		$this->shortname_barang->ViewCustomAttributes = "";

		// id_tag
		$curVal = strval($this->id_tag->CurrentValue);
		if ($curVal != "") {
			$this->id_tag->ViewValue = $this->id_tag->lookupCacheOption($curVal);
			if ($this->id_tag->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_tag->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_tag->ViewValue = $this->id_tag->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_tag->ViewValue = $this->id_tag->CurrentValue;
				}
			}
		} else {
			$this->id_tag->ViewValue = NULL;
		}
		$this->id_tag->ViewCustomAttributes = "";

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

		// komposisi
		$this->komposisi->LinkCustomAttributes = "";
		$this->komposisi->HrefValue = "";
		$this->komposisi->TooltipValue = "";

		// tipe
		$this->tipe->LinkCustomAttributes = "";
		$this->tipe->HrefValue = "";
		$this->tipe->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// shortname_barang
		$this->shortname_barang->LinkCustomAttributes = "";
		$this->shortname_barang->HrefValue = "";
		$this->shortname_barang->TooltipValue = "";

		// id_tag
		$this->id_tag->LinkCustomAttributes = "";
		$this->id_tag->HrefValue = "";
		$this->id_tag->TooltipValue = "";

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

		// jenis
		$this->jenis->EditAttrs["class"] = "form-control";
		$this->jenis->EditCustomAttributes = "";

		// kategori
		$this->kategori->EditAttrs["class"] = "form-control";
		$this->kategori->EditCustomAttributes = "";

		// subkategori
		$this->subkategori->EditAttrs["class"] = "form-control";
		$this->subkategori->EditCustomAttributes = "";

		// komposisi
		$this->komposisi->EditCustomAttributes = "";
		$this->komposisi->EditValue = $this->komposisi->options(FALSE);

		// tipe
		$this->tipe->EditCustomAttributes = "";
		$this->tipe->EditValue = $this->tipe->options(FALSE);

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";

		// shortname_barang
		$this->shortname_barang->EditAttrs["class"] = "form-control";
		$this->shortname_barang->EditCustomAttributes = "";
		if (!$this->shortname_barang->Raw)
			$this->shortname_barang->CurrentValue = HtmlDecode($this->shortname_barang->CurrentValue);
		$this->shortname_barang->EditValue = $this->shortname_barang->CurrentValue;
		$this->shortname_barang->PlaceHolder = RemoveHtml($this->shortname_barang->caption());

		// id_tag
		$this->id_tag->EditAttrs["class"] = "form-control";
		$this->id_tag->EditCustomAttributes = "";

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
					$doc->exportCaption($this->komposisi);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->shortname_barang);
					$doc->exportCaption($this->id_tag);
					$doc->exportCaption($this->discontinue);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->subkategori);
					$doc->exportCaption($this->komposisi);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->shortname_barang);
					$doc->exportCaption($this->id_tag);
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
						$doc->exportField($this->komposisi);
						$doc->exportField($this->tipe);
						$doc->exportField($this->status);
						$doc->exportField($this->shortname_barang);
						$doc->exportField($this->id_tag);
						$doc->exportField($this->discontinue);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->satuan);
						$doc->exportField($this->jenis);
						$doc->exportField($this->kategori);
						$doc->exportField($this->subkategori);
						$doc->exportField($this->komposisi);
						$doc->exportField($this->tipe);
						$doc->exportField($this->status);
						$doc->exportField($this->shortname_barang);
						$doc->exportField($this->id_tag);
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