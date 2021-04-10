<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for m_komisi_kinerja_detail
 */
class m_komisi_kinerja_detail extends DbTable
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
	public $id_komisi;
	public $id_barang;
	public $kinerja_default_persen;
	public $kinerja_default_rupiah;
	public $kinerja_target_persen;
	public $kinerja_target_rupiah;
	public $tgl_mulai;
	public $tgl_akhir;
	public $target;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_komisi_kinerja_detail';
		$this->TableName = 'm_komisi_kinerja_detail';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_komisi_kinerja_detail`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// id_komisi
		$this->id_komisi = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_id_komisi', 'id_komisi', '`id_komisi`', '`id_komisi`', 3, 11, -1, FALSE, '`id_komisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_komisi->IsForeignKey = TRUE; // Foreign key field
		$this->id_komisi->Sortable = TRUE; // Allow sort
		$this->id_komisi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_komisi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_komisi->Lookup = new Lookup('id_komisi', 'm_komisi', FALSE, 'id_komisi', ["id_komisi","","",""], [], [], [], [], [], [], '', '');
		$this->id_komisi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_komisi'] = &$this->id_komisi;

		// id_barang
		$this->id_barang = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->Lookup = new Lookup('id_barang', 'm_barang', FALSE, 'id', ["kode_barang","nama_barang","",""], [], [], [], [], [], [], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// kinerja_default_persen
		$this->kinerja_default_persen = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_kinerja_default_persen', 'kinerja_default_persen', '`kinerja_default_persen`', '`kinerja_default_persen`', 5, 22, -1, FALSE, '`kinerja_default_persen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kinerja_default_persen->Sortable = TRUE; // Allow sort
		$this->kinerja_default_persen->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['kinerja_default_persen'] = &$this->kinerja_default_persen;

		// kinerja_default_rupiah
		$this->kinerja_default_rupiah = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_kinerja_default_rupiah', 'kinerja_default_rupiah', '`kinerja_default_rupiah`', '`kinerja_default_rupiah`', 5, 22, -1, FALSE, '`kinerja_default_rupiah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kinerja_default_rupiah->Sortable = TRUE; // Allow sort
		$this->kinerja_default_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['kinerja_default_rupiah'] = &$this->kinerja_default_rupiah;

		// kinerja_target_persen
		$this->kinerja_target_persen = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_kinerja_target_persen', 'kinerja_target_persen', '`kinerja_target_persen`', '`kinerja_target_persen`', 5, 22, -1, FALSE, '`kinerja_target_persen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kinerja_target_persen->Sortable = TRUE; // Allow sort
		$this->kinerja_target_persen->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['kinerja_target_persen'] = &$this->kinerja_target_persen;

		// kinerja_target_rupiah
		$this->kinerja_target_rupiah = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_kinerja_target_rupiah', 'kinerja_target_rupiah', '`kinerja_target_rupiah`', '`kinerja_target_rupiah`', 5, 22, -1, FALSE, '`kinerja_target_rupiah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kinerja_target_rupiah->Sortable = TRUE; // Allow sort
		$this->kinerja_target_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['kinerja_target_rupiah'] = &$this->kinerja_target_rupiah;

		// tgl_mulai
		$this->tgl_mulai = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_tgl_mulai', 'tgl_mulai', '`tgl_mulai`', CastDateFieldForLike("`tgl_mulai`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_mulai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_mulai->Sortable = TRUE; // Allow sort
		$this->tgl_mulai->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_mulai'] = &$this->tgl_mulai;

		// tgl_akhir
		$this->tgl_akhir = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_tgl_akhir', 'tgl_akhir', '`tgl_akhir`', CastDateFieldForLike("`tgl_akhir`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_akhir->Sortable = TRUE; // Allow sort
		$this->tgl_akhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_akhir'] = &$this->tgl_akhir;

		// target
		$this->target = new DbField('m_komisi_kinerja_detail', 'm_komisi_kinerja_detail', 'x_target', 'target', '`target`', '`target`', 3, 11, -1, FALSE, '`target`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->target->Sortable = TRUE; // Allow sort
		$this->target->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['target'] = &$this->target;
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
		if ($this->getCurrentMasterTable() == "m_komisi") {
			if ($this->id_komisi->getSessionValue() != "")
				$masterFilter .= "`id_komisi`=" . QuotedValue($this->id_komisi->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "m_komisi") {
			if ($this->id_komisi->getSessionValue() != "")
				$detailFilter .= "`id_komisi`=" . QuotedValue($this->id_komisi->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_m_komisi()
	{
		return "`id_komisi`=@id_komisi@";
	}

	// Detail filter
	public function sqlDetailFilter_m_komisi()
	{
		return "`id_komisi`=@id_komisi@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_komisi_kinerja_detail`";
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
		$this->id_komisi->DbValue = $row['id_komisi'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->kinerja_default_persen->DbValue = $row['kinerja_default_persen'];
		$this->kinerja_default_rupiah->DbValue = $row['kinerja_default_rupiah'];
		$this->kinerja_target_persen->DbValue = $row['kinerja_target_persen'];
		$this->kinerja_target_rupiah->DbValue = $row['kinerja_target_rupiah'];
		$this->tgl_mulai->DbValue = $row['tgl_mulai'];
		$this->tgl_akhir->DbValue = $row['tgl_akhir'];
		$this->target->DbValue = $row['target'];
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
			return "m_komisi_kinerja_detaillist.php";
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
		if ($pageName == "m_komisi_kinerja_detailview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_komisi_kinerja_detailedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_komisi_kinerja_detailadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_komisi_kinerja_detaillist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_komisi_kinerja_detailview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_komisi_kinerja_detailview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_komisi_kinerja_detailadd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_komisi_kinerja_detailadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_komisi_kinerja_detailedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_komisi_kinerja_detailadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_komisi_kinerja_detaildelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "m_komisi" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id_komisi=" . urlencode($this->id_komisi->CurrentValue);
		}
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
		$this->id_komisi->setDbValue($rs->fields('id_komisi'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->kinerja_default_persen->setDbValue($rs->fields('kinerja_default_persen'));
		$this->kinerja_default_rupiah->setDbValue($rs->fields('kinerja_default_rupiah'));
		$this->kinerja_target_persen->setDbValue($rs->fields('kinerja_target_persen'));
		$this->kinerja_target_rupiah->setDbValue($rs->fields('kinerja_target_rupiah'));
		$this->tgl_mulai->setDbValue($rs->fields('tgl_mulai'));
		$this->tgl_akhir->setDbValue($rs->fields('tgl_akhir'));
		$this->target->setDbValue($rs->fields('target'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// id_komisi
		// id_barang
		// kinerja_default_persen
		// kinerja_default_rupiah
		// kinerja_target_persen
		// kinerja_target_rupiah
		// tgl_mulai
		// tgl_akhir
		// target
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewValue = FormatNumber($this->id->ViewValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// id_komisi
		$curVal = strval($this->id_komisi->CurrentValue);
		if ($curVal != "") {
			$this->id_komisi->ViewValue = $this->id_komisi->lookupCacheOption($curVal);
			if ($this->id_komisi->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_komisi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_komisi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$this->id_komisi->ViewValue = $this->id_komisi->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_komisi->ViewValue = $this->id_komisi->CurrentValue;
				}
			}
		} else {
			$this->id_komisi->ViewValue = NULL;
		}
		$this->id_komisi->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$curVal = strval($this->id_barang->CurrentValue);
		if ($curVal != "") {
			$this->id_barang->ViewValue = $this->id_barang->lookupCacheOption($curVal);
			if ($this->id_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`tipe` <> 'Bahan'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
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

		// kinerja_default_persen
		$this->kinerja_default_persen->ViewValue = $this->kinerja_default_persen->CurrentValue;
		$this->kinerja_default_persen->ViewValue = FormatNumber($this->kinerja_default_persen->ViewValue, 2, -2, -2, -2);
		$this->kinerja_default_persen->ViewCustomAttributes = "";

		// kinerja_default_rupiah
		$this->kinerja_default_rupiah->ViewValue = $this->kinerja_default_rupiah->CurrentValue;
		$this->kinerja_default_rupiah->ViewValue = FormatNumber($this->kinerja_default_rupiah->ViewValue, 2, -2, -2, -2);
		$this->kinerja_default_rupiah->ViewCustomAttributes = "";

		// kinerja_target_persen
		$this->kinerja_target_persen->ViewValue = $this->kinerja_target_persen->CurrentValue;
		$this->kinerja_target_persen->ViewValue = FormatNumber($this->kinerja_target_persen->ViewValue, 2, -2, -2, -2);
		$this->kinerja_target_persen->ViewCustomAttributes = "";

		// kinerja_target_rupiah
		$this->kinerja_target_rupiah->ViewValue = $this->kinerja_target_rupiah->CurrentValue;
		$this->kinerja_target_rupiah->ViewValue = FormatNumber($this->kinerja_target_rupiah->ViewValue, 2, -2, -2, -2);
		$this->kinerja_target_rupiah->ViewCustomAttributes = "";

		// tgl_mulai
		$this->tgl_mulai->ViewValue = $this->tgl_mulai->CurrentValue;
		$this->tgl_mulai->ViewValue = FormatDateTime($this->tgl_mulai->ViewValue, 0);
		$this->tgl_mulai->ViewCustomAttributes = "";

		// tgl_akhir
		$this->tgl_akhir->ViewValue = $this->tgl_akhir->CurrentValue;
		$this->tgl_akhir->ViewValue = FormatDateTime($this->tgl_akhir->ViewValue, 0);
		$this->tgl_akhir->ViewCustomAttributes = "";

		// target
		$this->target->ViewValue = $this->target->CurrentValue;
		$this->target->ViewValue = FormatNumber($this->target->ViewValue, 0, -2, -2, -2);
		$this->target->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// id_komisi
		$this->id_komisi->LinkCustomAttributes = "";
		$this->id_komisi->HrefValue = "";
		$this->id_komisi->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// kinerja_default_persen
		$this->kinerja_default_persen->LinkCustomAttributes = "";
		$this->kinerja_default_persen->HrefValue = "";
		$this->kinerja_default_persen->TooltipValue = "";

		// kinerja_default_rupiah
		$this->kinerja_default_rupiah->LinkCustomAttributes = "";
		$this->kinerja_default_rupiah->HrefValue = "";
		$this->kinerja_default_rupiah->TooltipValue = "";

		// kinerja_target_persen
		$this->kinerja_target_persen->LinkCustomAttributes = "";
		$this->kinerja_target_persen->HrefValue = "";
		$this->kinerja_target_persen->TooltipValue = "";

		// kinerja_target_rupiah
		$this->kinerja_target_rupiah->LinkCustomAttributes = "";
		$this->kinerja_target_rupiah->HrefValue = "";
		$this->kinerja_target_rupiah->TooltipValue = "";

		// tgl_mulai
		$this->tgl_mulai->LinkCustomAttributes = "";
		$this->tgl_mulai->HrefValue = "";
		$this->tgl_mulai->TooltipValue = "";

		// tgl_akhir
		$this->tgl_akhir->LinkCustomAttributes = "";
		$this->tgl_akhir->HrefValue = "";
		$this->tgl_akhir->TooltipValue = "";

		// target
		$this->target->LinkCustomAttributes = "";
		$this->target->HrefValue = "";
		$this->target->TooltipValue = "";

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
		$this->id->EditValue = FormatNumber($this->id->EditValue, 0, -2, -2, -2);
		$this->id->ViewCustomAttributes = "";

		// id_komisi
		$this->id_komisi->EditAttrs["class"] = "form-control";
		$this->id_komisi->EditCustomAttributes = "";
		if ($this->id_komisi->getSessionValue() != "") {
			$this->id_komisi->CurrentValue = $this->id_komisi->getSessionValue();
			$curVal = strval($this->id_komisi->CurrentValue);
			if ($curVal != "") {
				$this->id_komisi->ViewValue = $this->id_komisi->lookupCacheOption($curVal);
				if ($this->id_komisi->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_komisi`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_komisi->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
						$this->id_komisi->ViewValue = $this->id_komisi->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_komisi->ViewValue = $this->id_komisi->CurrentValue;
					}
				}
			} else {
				$this->id_komisi->ViewValue = NULL;
			}
			$this->id_komisi->ViewCustomAttributes = "";
		} else {
		}

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// kinerja_default_persen
		$this->kinerja_default_persen->EditAttrs["class"] = "form-control";
		$this->kinerja_default_persen->EditCustomAttributes = "";
		$this->kinerja_default_persen->EditValue = $this->kinerja_default_persen->CurrentValue;
		$this->kinerja_default_persen->PlaceHolder = RemoveHtml($this->kinerja_default_persen->caption());
		if (strval($this->kinerja_default_persen->EditValue) != "" && is_numeric($this->kinerja_default_persen->EditValue))
			$this->kinerja_default_persen->EditValue = FormatNumber($this->kinerja_default_persen->EditValue, -2, -2, -2, -2);
		

		// kinerja_default_rupiah
		$this->kinerja_default_rupiah->EditAttrs["class"] = "form-control";
		$this->kinerja_default_rupiah->EditCustomAttributes = "";
		$this->kinerja_default_rupiah->EditValue = $this->kinerja_default_rupiah->CurrentValue;
		$this->kinerja_default_rupiah->PlaceHolder = RemoveHtml($this->kinerja_default_rupiah->caption());
		if (strval($this->kinerja_default_rupiah->EditValue) != "" && is_numeric($this->kinerja_default_rupiah->EditValue))
			$this->kinerja_default_rupiah->EditValue = FormatNumber($this->kinerja_default_rupiah->EditValue, -2, -2, -2, -2);
		

		// kinerja_target_persen
		$this->kinerja_target_persen->EditAttrs["class"] = "form-control";
		$this->kinerja_target_persen->EditCustomAttributes = "";
		$this->kinerja_target_persen->EditValue = $this->kinerja_target_persen->CurrentValue;
		$this->kinerja_target_persen->PlaceHolder = RemoveHtml($this->kinerja_target_persen->caption());
		if (strval($this->kinerja_target_persen->EditValue) != "" && is_numeric($this->kinerja_target_persen->EditValue))
			$this->kinerja_target_persen->EditValue = FormatNumber($this->kinerja_target_persen->EditValue, -2, -2, -2, -2);
		

		// kinerja_target_rupiah
		$this->kinerja_target_rupiah->EditAttrs["class"] = "form-control";
		$this->kinerja_target_rupiah->EditCustomAttributes = "";
		$this->kinerja_target_rupiah->EditValue = $this->kinerja_target_rupiah->CurrentValue;
		$this->kinerja_target_rupiah->PlaceHolder = RemoveHtml($this->kinerja_target_rupiah->caption());
		if (strval($this->kinerja_target_rupiah->EditValue) != "" && is_numeric($this->kinerja_target_rupiah->EditValue))
			$this->kinerja_target_rupiah->EditValue = FormatNumber($this->kinerja_target_rupiah->EditValue, -2, -2, -2, -2);
		

		// tgl_mulai
		$this->tgl_mulai->EditAttrs["class"] = "form-control";
		$this->tgl_mulai->EditCustomAttributes = "";
		$this->tgl_mulai->EditValue = FormatDateTime($this->tgl_mulai->CurrentValue, 8);
		$this->tgl_mulai->PlaceHolder = RemoveHtml($this->tgl_mulai->caption());

		// tgl_akhir
		$this->tgl_akhir->EditAttrs["class"] = "form-control";
		$this->tgl_akhir->EditCustomAttributes = "";
		$this->tgl_akhir->EditValue = FormatDateTime($this->tgl_akhir->CurrentValue, 8);
		$this->tgl_akhir->PlaceHolder = RemoveHtml($this->tgl_akhir->caption());

		// target
		$this->target->EditAttrs["class"] = "form-control";
		$this->target->EditCustomAttributes = "";
		$this->target->EditValue = $this->target->CurrentValue;
		$this->target->PlaceHolder = RemoveHtml($this->target->caption());

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
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->kinerja_default_persen);
					$doc->exportCaption($this->kinerja_default_rupiah);
					$doc->exportCaption($this->kinerja_target_persen);
					$doc->exportCaption($this->kinerja_target_rupiah);
					$doc->exportCaption($this->tgl_mulai);
					$doc->exportCaption($this->tgl_akhir);
					$doc->exportCaption($this->target);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->id_komisi);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->kinerja_default_persen);
					$doc->exportCaption($this->kinerja_default_rupiah);
					$doc->exportCaption($this->kinerja_target_persen);
					$doc->exportCaption($this->kinerja_target_rupiah);
					$doc->exportCaption($this->tgl_mulai);
					$doc->exportCaption($this->tgl_akhir);
					$doc->exportCaption($this->target);
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
						$doc->exportField($this->id_barang);
						$doc->exportField($this->kinerja_default_persen);
						$doc->exportField($this->kinerja_default_rupiah);
						$doc->exportField($this->kinerja_target_persen);
						$doc->exportField($this->kinerja_target_rupiah);
						$doc->exportField($this->tgl_mulai);
						$doc->exportField($this->tgl_akhir);
						$doc->exportField($this->target);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->id_komisi);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->kinerja_default_persen);
						$doc->exportField($this->kinerja_default_rupiah);
						$doc->exportField($this->kinerja_target_persen);
						$doc->exportField($this->kinerja_target_rupiah);
						$doc->exportField($this->tgl_mulai);
						$doc->exportField($this->tgl_akhir);
						$doc->exportField($this->target);
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