<?php namespace PHPMaker2020\klinik_latest_26_03_21; ?>
<?php

/**
 * Table class for detailpenyesuaianpoin
 */
class detailpenyesuaianpoin extends DbTable
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
	public $id_detailpenyesuaianpoin;
	public $pid_penyesuaianpoin;
	public $id_member;
	public $poin_database;
	public $poin_lapangan;
	public $selisih;
	public $tipe;
	public $keterangan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailpenyesuaianpoin';
		$this->TableName = 'detailpenyesuaianpoin';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailpenyesuaianpoin`";
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

		// id_detailpenyesuaianpoin
		$this->id_detailpenyesuaianpoin = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_id_detailpenyesuaianpoin', 'id_detailpenyesuaianpoin', '`id_detailpenyesuaianpoin`', '`id_detailpenyesuaianpoin`', 3, 11, -1, FALSE, '`id_detailpenyesuaianpoin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_detailpenyesuaianpoin->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_detailpenyesuaianpoin->IsPrimaryKey = TRUE; // Primary key field
		$this->id_detailpenyesuaianpoin->Sortable = TRUE; // Allow sort
		$this->id_detailpenyesuaianpoin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_detailpenyesuaianpoin'] = &$this->id_detailpenyesuaianpoin;

		// pid_penyesuaianpoin
		$this->pid_penyesuaianpoin = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_pid_penyesuaianpoin', 'pid_penyesuaianpoin', '`pid_penyesuaianpoin`', '`pid_penyesuaianpoin`', 3, 11, -1, FALSE, '`pid_penyesuaianpoin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid_penyesuaianpoin->IsForeignKey = TRUE; // Foreign key field
		$this->pid_penyesuaianpoin->Sortable = TRUE; // Allow sort
		$this->pid_penyesuaianpoin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid_penyesuaianpoin'] = &$this->pid_penyesuaianpoin;

		// id_member
		$this->id_member = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_id_member', 'id_member', '`id_member`', '`id_member`', 3, 11, -1, FALSE, '`id_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_member->Sortable = TRUE; // Allow sort
		$this->id_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_member'] = &$this->id_member;

		// poin_database
		$this->poin_database = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_poin_database', 'poin_database', '`poin_database`', '`poin_database`', 5, 22, -1, FALSE, '`poin_database`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->poin_database->Sortable = TRUE; // Allow sort
		$this->poin_database->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['poin_database'] = &$this->poin_database;

		// poin_lapangan
		$this->poin_lapangan = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_poin_lapangan', 'poin_lapangan', '`poin_lapangan`', '`poin_lapangan`', 5, 22, -1, FALSE, '`poin_lapangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->poin_lapangan->Sortable = TRUE; // Allow sort
		$this->poin_lapangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['poin_lapangan'] = &$this->poin_lapangan;

		// selisih
		$this->selisih = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_selisih', 'selisih', '`selisih`', '`selisih`', 5, 22, -1, FALSE, '`selisih`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->selisih->Sortable = TRUE; // Allow sort
		$this->selisih->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['selisih'] = &$this->selisih;

		// tipe
		$this->tipe = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_tipe', 'tipe', '`tipe`', '`tipe`', 202, 6, -1, FALSE, '`tipe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipe->Sortable = TRUE; // Allow sort
		$this->fields['tipe'] = &$this->tipe;

		// keterangan
		$this->keterangan = new DbField('detailpenyesuaianpoin', 'detailpenyesuaianpoin', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 5, 22, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->keterangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keterangan'] = &$this->keterangan;
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
		if ($this->getCurrentMasterTable() == "penyesuaian_poin") {
			if ($this->pid_penyesuaianpoin->getSessionValue() != "")
				$masterFilter .= "`id_penyesuaian_poin`=" . QuotedValue($this->pid_penyesuaianpoin->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "penyesuaian_poin") {
			if ($this->pid_penyesuaianpoin->getSessionValue() != "")
				$detailFilter .= "`pid_penyesuaianpoin`=" . QuotedValue($this->pid_penyesuaianpoin->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_penyesuaian_poin()
	{
		return "`id_penyesuaian_poin`=@id_penyesuaian_poin@";
	}

	// Detail filter
	public function sqlDetailFilter_penyesuaian_poin()
	{
		return "`pid_penyesuaianpoin`=@pid_penyesuaianpoin@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailpenyesuaianpoin`";
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
			$this->id_detailpenyesuaianpoin->setDbValue($conn->insert_ID());
			$rs['id_detailpenyesuaianpoin'] = $this->id_detailpenyesuaianpoin->DbValue;
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
			if (array_key_exists('id_detailpenyesuaianpoin', $rs))
				AddFilter($where, QuotedName('id_detailpenyesuaianpoin', $this->Dbid) . '=' . QuotedValue($rs['id_detailpenyesuaianpoin'], $this->id_detailpenyesuaianpoin->DataType, $this->Dbid));
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
		$this->id_detailpenyesuaianpoin->DbValue = $row['id_detailpenyesuaianpoin'];
		$this->pid_penyesuaianpoin->DbValue = $row['pid_penyesuaianpoin'];
		$this->id_member->DbValue = $row['id_member'];
		$this->poin_database->DbValue = $row['poin_database'];
		$this->poin_lapangan->DbValue = $row['poin_lapangan'];
		$this->selisih->DbValue = $row['selisih'];
		$this->tipe->DbValue = $row['tipe'];
		$this->keterangan->DbValue = $row['keterangan'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_detailpenyesuaianpoin` = @id_detailpenyesuaianpoin@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_detailpenyesuaianpoin', $row) ? $row['id_detailpenyesuaianpoin'] : NULL;
		else
			$val = $this->id_detailpenyesuaianpoin->OldValue !== NULL ? $this->id_detailpenyesuaianpoin->OldValue : $this->id_detailpenyesuaianpoin->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_detailpenyesuaianpoin@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "detailpenyesuaianpoinlist.php";
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
		if ($pageName == "detailpenyesuaianpoinview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailpenyesuaianpoinedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailpenyesuaianpoinadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailpenyesuaianpoinlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailpenyesuaianpoinview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailpenyesuaianpoinview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailpenyesuaianpoinadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailpenyesuaianpoinadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("detailpenyesuaianpoinedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("detailpenyesuaianpoinadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("detailpenyesuaianpoindelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "penyesuaian_poin" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id_penyesuaian_poin=" . urlencode($this->pid_penyesuaianpoin->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_detailpenyesuaianpoin:" . JsonEncode($this->id_detailpenyesuaianpoin->CurrentValue, "number");
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
		if ($this->id_detailpenyesuaianpoin->CurrentValue != NULL) {
			$url .= "id_detailpenyesuaianpoin=" . urlencode($this->id_detailpenyesuaianpoin->CurrentValue);
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
			if (Param("id_detailpenyesuaianpoin") !== NULL)
				$arKeys[] = Param("id_detailpenyesuaianpoin");
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
				$this->id_detailpenyesuaianpoin->CurrentValue = $key;
			else
				$this->id_detailpenyesuaianpoin->OldValue = $key;
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
		$this->id_detailpenyesuaianpoin->setDbValue($rs->fields('id_detailpenyesuaianpoin'));
		$this->pid_penyesuaianpoin->setDbValue($rs->fields('pid_penyesuaianpoin'));
		$this->id_member->setDbValue($rs->fields('id_member'));
		$this->poin_database->setDbValue($rs->fields('poin_database'));
		$this->poin_lapangan->setDbValue($rs->fields('poin_lapangan'));
		$this->selisih->setDbValue($rs->fields('selisih'));
		$this->tipe->setDbValue($rs->fields('tipe'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_detailpenyesuaianpoin
		// pid_penyesuaianpoin
		// id_member
		// poin_database
		// poin_lapangan
		// selisih
		// tipe
		// keterangan
		// id_detailpenyesuaianpoin

		$this->id_detailpenyesuaianpoin->ViewValue = $this->id_detailpenyesuaianpoin->CurrentValue;
		$this->id_detailpenyesuaianpoin->ViewCustomAttributes = "";

		// pid_penyesuaianpoin
		$this->pid_penyesuaianpoin->ViewValue = $this->pid_penyesuaianpoin->CurrentValue;
		$this->pid_penyesuaianpoin->ViewValue = FormatNumber($this->pid_penyesuaianpoin->ViewValue, 0, -2, -2, -2);
		$this->pid_penyesuaianpoin->ViewCustomAttributes = "";

		// id_member
		$this->id_member->ViewValue = $this->id_member->CurrentValue;
		$this->id_member->ViewValue = FormatNumber($this->id_member->ViewValue, 0, -2, -2, -2);
		$this->id_member->ViewCustomAttributes = "";

		// poin_database
		$this->poin_database->ViewValue = $this->poin_database->CurrentValue;
		$this->poin_database->ViewValue = FormatNumber($this->poin_database->ViewValue, 2, -2, -2, -2);
		$this->poin_database->ViewCustomAttributes = "";

		// poin_lapangan
		$this->poin_lapangan->ViewValue = $this->poin_lapangan->CurrentValue;
		$this->poin_lapangan->ViewValue = FormatNumber($this->poin_lapangan->ViewValue, 2, -2, -2, -2);
		$this->poin_lapangan->ViewCustomAttributes = "";

		// selisih
		$this->selisih->ViewValue = $this->selisih->CurrentValue;
		$this->selisih->ViewValue = FormatNumber($this->selisih->ViewValue, 2, -2, -2, -2);
		$this->selisih->ViewCustomAttributes = "";

		// tipe
		$this->tipe->ViewValue = $this->tipe->CurrentValue;
		$this->tipe->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewValue = FormatNumber($this->keterangan->ViewValue, 2, -2, -2, -2);
		$this->keterangan->ViewCustomAttributes = "";

		// id_detailpenyesuaianpoin
		$this->id_detailpenyesuaianpoin->LinkCustomAttributes = "";
		$this->id_detailpenyesuaianpoin->HrefValue = "";
		$this->id_detailpenyesuaianpoin->TooltipValue = "";

		// pid_penyesuaianpoin
		$this->pid_penyesuaianpoin->LinkCustomAttributes = "";
		$this->pid_penyesuaianpoin->HrefValue = "";
		$this->pid_penyesuaianpoin->TooltipValue = "";

		// id_member
		$this->id_member->LinkCustomAttributes = "";
		$this->id_member->HrefValue = "";
		$this->id_member->TooltipValue = "";

		// poin_database
		$this->poin_database->LinkCustomAttributes = "";
		$this->poin_database->HrefValue = "";
		$this->poin_database->TooltipValue = "";

		// poin_lapangan
		$this->poin_lapangan->LinkCustomAttributes = "";
		$this->poin_lapangan->HrefValue = "";
		$this->poin_lapangan->TooltipValue = "";

		// selisih
		$this->selisih->LinkCustomAttributes = "";
		$this->selisih->HrefValue = "";
		$this->selisih->TooltipValue = "";

		// tipe
		$this->tipe->LinkCustomAttributes = "";
		$this->tipe->HrefValue = "";
		$this->tipe->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

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

		// id_detailpenyesuaianpoin
		$this->id_detailpenyesuaianpoin->EditAttrs["class"] = "form-control";
		$this->id_detailpenyesuaianpoin->EditCustomAttributes = "";
		$this->id_detailpenyesuaianpoin->EditValue = $this->id_detailpenyesuaianpoin->CurrentValue;
		$this->id_detailpenyesuaianpoin->ViewCustomAttributes = "";

		// pid_penyesuaianpoin
		$this->pid_penyesuaianpoin->EditAttrs["class"] = "form-control";
		$this->pid_penyesuaianpoin->EditCustomAttributes = "";
		if ($this->pid_penyesuaianpoin->getSessionValue() != "") {
			$this->pid_penyesuaianpoin->CurrentValue = $this->pid_penyesuaianpoin->getSessionValue();
			$this->pid_penyesuaianpoin->ViewValue = $this->pid_penyesuaianpoin->CurrentValue;
			$this->pid_penyesuaianpoin->ViewValue = FormatNumber($this->pid_penyesuaianpoin->ViewValue, 0, -2, -2, -2);
			$this->pid_penyesuaianpoin->ViewCustomAttributes = "";
		} else {
			$this->pid_penyesuaianpoin->EditValue = $this->pid_penyesuaianpoin->CurrentValue;
			$this->pid_penyesuaianpoin->PlaceHolder = RemoveHtml($this->pid_penyesuaianpoin->caption());
		}

		// id_member
		$this->id_member->EditAttrs["class"] = "form-control";
		$this->id_member->EditCustomAttributes = "";
		$this->id_member->EditValue = $this->id_member->CurrentValue;
		$this->id_member->PlaceHolder = RemoveHtml($this->id_member->caption());

		// poin_database
		$this->poin_database->EditAttrs["class"] = "form-control";
		$this->poin_database->EditCustomAttributes = "Readonly";
		$this->poin_database->EditValue = $this->poin_database->CurrentValue;
		$this->poin_database->PlaceHolder = RemoveHtml($this->poin_database->caption());
		if (strval($this->poin_database->EditValue) != "" && is_numeric($this->poin_database->EditValue))
			$this->poin_database->EditValue = FormatNumber($this->poin_database->EditValue, -2, -2, -2, -2);
		

		// poin_lapangan
		$this->poin_lapangan->EditAttrs["class"] = "form-control";
		$this->poin_lapangan->EditCustomAttributes = "";
		$this->poin_lapangan->EditValue = $this->poin_lapangan->CurrentValue;
		$this->poin_lapangan->PlaceHolder = RemoveHtml($this->poin_lapangan->caption());
		if (strval($this->poin_lapangan->EditValue) != "" && is_numeric($this->poin_lapangan->EditValue))
			$this->poin_lapangan->EditValue = FormatNumber($this->poin_lapangan->EditValue, -2, -2, -2, -2);
		

		// selisih
		$this->selisih->EditAttrs["class"] = "form-control";
		$this->selisih->EditCustomAttributes = "";
		$this->selisih->EditValue = $this->selisih->CurrentValue;
		$this->selisih->PlaceHolder = RemoveHtml($this->selisih->caption());
		if (strval($this->selisih->EditValue) != "" && is_numeric($this->selisih->EditValue))
			$this->selisih->EditValue = FormatNumber($this->selisih->EditValue, -2, -2, -2, -2);
		

		// tipe
		$this->tipe->EditAttrs["class"] = "form-control";
		$this->tipe->EditCustomAttributes = "";
		if (!$this->tipe->Raw)
			$this->tipe->CurrentValue = HtmlDecode($this->tipe->CurrentValue);
		$this->tipe->EditValue = $this->tipe->CurrentValue;
		$this->tipe->PlaceHolder = RemoveHtml($this->tipe->caption());

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());
		if (strval($this->keterangan->EditValue) != "" && is_numeric($this->keterangan->EditValue))
			$this->keterangan->EditValue = FormatNumber($this->keterangan->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->pid_penyesuaianpoin);
					$doc->exportCaption($this->id_member);
					$doc->exportCaption($this->poin_database);
					$doc->exportCaption($this->poin_lapangan);
					$doc->exportCaption($this->selisih);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->keterangan);
				} else {
					$doc->exportCaption($this->id_detailpenyesuaianpoin);
					$doc->exportCaption($this->pid_penyesuaianpoin);
					$doc->exportCaption($this->id_member);
					$doc->exportCaption($this->poin_database);
					$doc->exportCaption($this->poin_lapangan);
					$doc->exportCaption($this->selisih);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->keterangan);
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
						$doc->exportField($this->pid_penyesuaianpoin);
						$doc->exportField($this->id_member);
						$doc->exportField($this->poin_database);
						$doc->exportField($this->poin_lapangan);
						$doc->exportField($this->selisih);
						$doc->exportField($this->tipe);
						$doc->exportField($this->keterangan);
					} else {
						$doc->exportField($this->id_detailpenyesuaianpoin);
						$doc->exportField($this->pid_penyesuaianpoin);
						$doc->exportField($this->id_member);
						$doc->exportField($this->poin_database);
						$doc->exportField($this->poin_lapangan);
						$doc->exportField($this->selisih);
						$doc->exportField($this->tipe);
						$doc->exportField($this->keterangan);
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
		$id_member = $rsnew["id_member"];
		$poin_lama = $rsnew["poin_database"];
		$tipe = $rsnew["tipe"];
		$poin_baru = $rsnew["poin_lapangan"];
		$selisih = $rsnew["selisih"];
		$id_penyesuaianpoin = $rsnew["pid_penyesuaianpoin"];
		$id_klinik = ExecuteScalar("SELECT id_klinik FROM penyesuaian_poin WHERE id_penyesuaian_poin = $id_penyesuaianpoin");
		$tanggal = ExecuteScalar("SELECT tgl FROM penyesuaian_poin WHERE id_penyesuaian_poin = $id_penyesuaianpoin");
		$tanggal_sekarang = date("Y-m-d");
		print_r($tanggal);
		print_r($tanggal_sekarang);
		$id_pelanggan = ExecuteScalar("SELECT id_pelanggan FROM m_member WHERE id = $id_member");
			if($tipe == 'Masuk') {
				$poin_baru = $poin_lama + $selisih;

				// update poin member
				$update_poin = Execute("UPDATE m_member SET poin_member=$poin_baru WHERE id = '$id_member' AND id_klinik = '$id_klinik'");

				// insert into kartupoin
				$kartupoin = Execute("INSERT INTO kartupoin (
			        					id_pelanggan,
			        					id_klinik,
			        					tgl,
			        					id_penyesuaian_poin,
			        					masuk_penyesuaian,
			        					saldo_poin)
			        			   VALUES (
			        			   		'$id_pelanggan',
			        			   		'$id_klinik',
			        			   		'$tgl',
			        			   		'$id_penyesuaianpoin',
			        			   		'$selisih',
			        			   		'$poin_baru')");
			} else if($tipe == 'Keluar'){
				$poin_baru = $poin_lama - $selisih;
				if($poin_baru < 0) { $poin_baru = 0; }

				// update poin member
				$update_poin = Execute("UPDATE m_member SET poin_member=$poin_baru WHERE id = '$id_member' AND id_klinik = '$id_klinik'");

				// insert into kartupoin
				$kartupoin = Execute("INSERT INTO kartupoin (
			        					id_pelanggan,
			        					id_klinik,
			        					tgl,
			        					id_penyesuaian_poin,
			        					keluar_penyesuaian,
			        					saldo_poin)
			        			   VALUES (
			        			   		'$id_pelanggan',
			        			   		'$id_klinik',
			        			   		'$tgl',
			        			   		'$id_penyesuaianpoin',
			        			   		'$selisih',
			        			   		'$poin_baru')");
			}	
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