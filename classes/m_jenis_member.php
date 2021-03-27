<?php namespace PHPMaker2020\klinik_latest_26_03_21; ?>
<?php

/**
 * Table class for m_jenis_member
 */
class m_jenis_member extends DbTable
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
	public $id_jenis_member;
	public $nama_member;
	public $member_selanjutnya;
	public $nominal_bawah;
	public $nominal_atas;
	public $qty_bawah;
	public $qty_atas;
	public $disc_prosen;
	public $disc_nominal;
	public $jangka_waktu;
	public $min_kedatangan;
	public $poin_member;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_jenis_member';
		$this->TableName = 'm_jenis_member';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_jenis_member`";
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

		// id_jenis_member
		$this->id_jenis_member = new DbField('m_jenis_member', 'm_jenis_member', 'x_id_jenis_member', 'id_jenis_member', '`id_jenis_member`', '`id_jenis_member`', 3, 11, -1, FALSE, '`id_jenis_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_jenis_member->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_jenis_member->IsPrimaryKey = TRUE; // Primary key field
		$this->id_jenis_member->Sortable = TRUE; // Allow sort
		$this->id_jenis_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_jenis_member'] = &$this->id_jenis_member;

		// nama_member
		$this->nama_member = new DbField('m_jenis_member', 'm_jenis_member', 'x_nama_member', 'nama_member', '`nama_member`', '`nama_member`', 200, 255, -1, FALSE, '`nama_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_member->Sortable = TRUE; // Allow sort
		$this->fields['nama_member'] = &$this->nama_member;

		// member_selanjutnya
		$this->member_selanjutnya = new DbField('m_jenis_member', 'm_jenis_member', 'x_member_selanjutnya', 'member_selanjutnya', '`member_selanjutnya`', '`member_selanjutnya`', 3, 11, -1, FALSE, '`member_selanjutnya`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->member_selanjutnya->Sortable = TRUE; // Allow sort
		$this->member_selanjutnya->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->member_selanjutnya->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->member_selanjutnya->Lookup = new Lookup('member_selanjutnya', 'm_jenis_member', FALSE, 'id_jenis_member', ["nama_member","","",""], [], [], [], [], [], [], '', '');
		$this->member_selanjutnya->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['member_selanjutnya'] = &$this->member_selanjutnya;

		// nominal_bawah
		$this->nominal_bawah = new DbField('m_jenis_member', 'm_jenis_member', 'x_nominal_bawah', 'nominal_bawah', '`nominal_bawah`', '`nominal_bawah`', 3, 11, -1, FALSE, '`nominal_bawah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nominal_bawah->Sortable = TRUE; // Allow sort
		$this->nominal_bawah->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nominal_bawah'] = &$this->nominal_bawah;

		// nominal_atas
		$this->nominal_atas = new DbField('m_jenis_member', 'm_jenis_member', 'x_nominal_atas', 'nominal_atas', '`nominal_atas`', '`nominal_atas`', 3, 11, -1, FALSE, '`nominal_atas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nominal_atas->Sortable = TRUE; // Allow sort
		$this->nominal_atas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nominal_atas'] = &$this->nominal_atas;

		// qty_bawah
		$this->qty_bawah = new DbField('m_jenis_member', 'm_jenis_member', 'x_qty_bawah', 'qty_bawah', '`qty_bawah`', '`qty_bawah`', 3, 11, -1, FALSE, '`qty_bawah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty_bawah->Sortable = TRUE; // Allow sort
		$this->qty_bawah->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['qty_bawah'] = &$this->qty_bawah;

		// qty_atas
		$this->qty_atas = new DbField('m_jenis_member', 'm_jenis_member', 'x_qty_atas', 'qty_atas', '`qty_atas`', '`qty_atas`', 3, 11, -1, FALSE, '`qty_atas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty_atas->Sortable = TRUE; // Allow sort
		$this->qty_atas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['qty_atas'] = &$this->qty_atas;

		// disc_prosen
		$this->disc_prosen = new DbField('m_jenis_member', 'm_jenis_member', 'x_disc_prosen', 'disc_prosen', '`disc_prosen`', '`disc_prosen`', 5, 22, -1, FALSE, '`disc_prosen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_prosen->Sortable = TRUE; // Allow sort
		$this->disc_prosen->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_prosen'] = &$this->disc_prosen;

		// disc_nominal
		$this->disc_nominal = new DbField('m_jenis_member', 'm_jenis_member', 'x_disc_nominal', 'disc_nominal', '`disc_nominal`', '`disc_nominal`', 3, 11, -1, FALSE, '`disc_nominal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_nominal->Sortable = TRUE; // Allow sort
		$this->disc_nominal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['disc_nominal'] = &$this->disc_nominal;

		// jangka_waktu
		$this->jangka_waktu = new DbField('m_jenis_member', 'm_jenis_member', 'x_jangka_waktu', 'jangka_waktu', '`jangka_waktu`', '`jangka_waktu`', 3, 11, -1, FALSE, '`jangka_waktu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jangka_waktu->Sortable = TRUE; // Allow sort
		$this->jangka_waktu->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jangka_waktu'] = &$this->jangka_waktu;

		// min_kedatangan
		$this->min_kedatangan = new DbField('m_jenis_member', 'm_jenis_member', 'x_min_kedatangan', 'min_kedatangan', '`min_kedatangan`', '`min_kedatangan`', 3, 11, -1, FALSE, '`min_kedatangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->min_kedatangan->Sortable = TRUE; // Allow sort
		$this->min_kedatangan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['min_kedatangan'] = &$this->min_kedatangan;

		// poin_member
		$this->poin_member = new DbField('m_jenis_member', 'm_jenis_member', 'x_poin_member', 'poin_member', '`poin_member`', '`poin_member`', 3, 11, -1, FALSE, '`poin_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->poin_member->Sortable = TRUE; // Allow sort
		$this->poin_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['poin_member'] = &$this->poin_member;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_jenis_member`";
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
			$this->id_jenis_member->setDbValue($conn->insert_ID());
			$rs['id_jenis_member'] = $this->id_jenis_member->DbValue;
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
			if (array_key_exists('id_jenis_member', $rs))
				AddFilter($where, QuotedName('id_jenis_member', $this->Dbid) . '=' . QuotedValue($rs['id_jenis_member'], $this->id_jenis_member->DataType, $this->Dbid));
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
		$this->id_jenis_member->DbValue = $row['id_jenis_member'];
		$this->nama_member->DbValue = $row['nama_member'];
		$this->member_selanjutnya->DbValue = $row['member_selanjutnya'];
		$this->nominal_bawah->DbValue = $row['nominal_bawah'];
		$this->nominal_atas->DbValue = $row['nominal_atas'];
		$this->qty_bawah->DbValue = $row['qty_bawah'];
		$this->qty_atas->DbValue = $row['qty_atas'];
		$this->disc_prosen->DbValue = $row['disc_prosen'];
		$this->disc_nominal->DbValue = $row['disc_nominal'];
		$this->jangka_waktu->DbValue = $row['jangka_waktu'];
		$this->min_kedatangan->DbValue = $row['min_kedatangan'];
		$this->poin_member->DbValue = $row['poin_member'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_jenis_member` = @id_jenis_member@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_jenis_member', $row) ? $row['id_jenis_member'] : NULL;
		else
			$val = $this->id_jenis_member->OldValue !== NULL ? $this->id_jenis_member->OldValue : $this->id_jenis_member->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_jenis_member@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "m_jenis_memberlist.php";
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
		if ($pageName == "m_jenis_memberview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_jenis_memberedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_jenis_memberadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_jenis_memberlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_jenis_memberview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_jenis_memberview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_jenis_memberadd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_jenis_memberadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_jenis_memberedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_jenis_memberadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_jenis_memberdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_jenis_member:" . JsonEncode($this->id_jenis_member->CurrentValue, "number");
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
		if ($this->id_jenis_member->CurrentValue != NULL) {
			$url .= "id_jenis_member=" . urlencode($this->id_jenis_member->CurrentValue);
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
			if (Param("id_jenis_member") !== NULL)
				$arKeys[] = Param("id_jenis_member");
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
				$this->id_jenis_member->CurrentValue = $key;
			else
				$this->id_jenis_member->OldValue = $key;
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
		$this->id_jenis_member->setDbValue($rs->fields('id_jenis_member'));
		$this->nama_member->setDbValue($rs->fields('nama_member'));
		$this->member_selanjutnya->setDbValue($rs->fields('member_selanjutnya'));
		$this->nominal_bawah->setDbValue($rs->fields('nominal_bawah'));
		$this->nominal_atas->setDbValue($rs->fields('nominal_atas'));
		$this->qty_bawah->setDbValue($rs->fields('qty_bawah'));
		$this->qty_atas->setDbValue($rs->fields('qty_atas'));
		$this->disc_prosen->setDbValue($rs->fields('disc_prosen'));
		$this->disc_nominal->setDbValue($rs->fields('disc_nominal'));
		$this->jangka_waktu->setDbValue($rs->fields('jangka_waktu'));
		$this->min_kedatangan->setDbValue($rs->fields('min_kedatangan'));
		$this->poin_member->setDbValue($rs->fields('poin_member'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_jenis_member
		// nama_member
		// member_selanjutnya
		// nominal_bawah
		// nominal_atas
		// qty_bawah
		// qty_atas
		// disc_prosen
		// disc_nominal
		// jangka_waktu
		// min_kedatangan
		// poin_member
		// id_jenis_member

		$this->id_jenis_member->ViewValue = $this->id_jenis_member->CurrentValue;
		$this->id_jenis_member->ViewValue = FormatNumber($this->id_jenis_member->ViewValue, 0, -2, -2, -2);
		$this->id_jenis_member->ViewCustomAttributes = "";

		// nama_member
		$this->nama_member->ViewValue = $this->nama_member->CurrentValue;
		$this->nama_member->ViewCustomAttributes = "";

		// member_selanjutnya
		$curVal = strval($this->member_selanjutnya->CurrentValue);
		if ($curVal != "") {
			$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->lookupCacheOption($curVal);
			if ($this->member_selanjutnya->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_jenis_member`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->member_selanjutnya->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->CurrentValue;
				}
			}
		} else {
			$this->member_selanjutnya->ViewValue = NULL;
		}
		$this->member_selanjutnya->ViewCustomAttributes = "";

		// nominal_bawah
		$this->nominal_bawah->ViewValue = $this->nominal_bawah->CurrentValue;
		$this->nominal_bawah->ViewValue = FormatNumber($this->nominal_bawah->ViewValue, 0, -2, -2, -2);
		$this->nominal_bawah->ViewCustomAttributes = "";

		// nominal_atas
		$this->nominal_atas->ViewValue = $this->nominal_atas->CurrentValue;
		$this->nominal_atas->ViewValue = FormatNumber($this->nominal_atas->ViewValue, 0, -2, -2, -2);
		$this->nominal_atas->ViewCustomAttributes = "";

		// qty_bawah
		$this->qty_bawah->ViewValue = $this->qty_bawah->CurrentValue;
		$this->qty_bawah->ViewValue = FormatNumber($this->qty_bawah->ViewValue, 0, -2, -2, -2);
		$this->qty_bawah->ViewCustomAttributes = "";

		// qty_atas
		$this->qty_atas->ViewValue = $this->qty_atas->CurrentValue;
		$this->qty_atas->ViewValue = FormatNumber($this->qty_atas->ViewValue, 0, -2, -2, -2);
		$this->qty_atas->ViewCustomAttributes = "";

		// disc_prosen
		$this->disc_prosen->ViewValue = $this->disc_prosen->CurrentValue;
		$this->disc_prosen->ViewValue = FormatNumber($this->disc_prosen->ViewValue, 2, -2, -2, -2);
		$this->disc_prosen->ViewCustomAttributes = "";

		// disc_nominal
		$this->disc_nominal->ViewValue = $this->disc_nominal->CurrentValue;
		$this->disc_nominal->ViewValue = FormatNumber($this->disc_nominal->ViewValue, 0, -2, -2, -2);
		$this->disc_nominal->ViewCustomAttributes = "";

		// jangka_waktu
		$this->jangka_waktu->ViewValue = $this->jangka_waktu->CurrentValue;
		$this->jangka_waktu->ViewValue = FormatNumber($this->jangka_waktu->ViewValue, 0, -2, -2, -2);
		$this->jangka_waktu->ViewCustomAttributes = "";

		// min_kedatangan
		$this->min_kedatangan->ViewValue = $this->min_kedatangan->CurrentValue;
		$this->min_kedatangan->ViewValue = FormatNumber($this->min_kedatangan->ViewValue, 0, -2, -2, -2);
		$this->min_kedatangan->ViewCustomAttributes = "";

		// poin_member
		$this->poin_member->ViewValue = $this->poin_member->CurrentValue;
		$this->poin_member->ViewValue = FormatNumber($this->poin_member->ViewValue, 0, -2, -2, -2);
		$this->poin_member->ViewCustomAttributes = "";

		// id_jenis_member
		$this->id_jenis_member->LinkCustomAttributes = "";
		$this->id_jenis_member->HrefValue = "";
		$this->id_jenis_member->TooltipValue = "";

		// nama_member
		$this->nama_member->LinkCustomAttributes = "";
		$this->nama_member->HrefValue = "";
		$this->nama_member->TooltipValue = "";

		// member_selanjutnya
		$this->member_selanjutnya->LinkCustomAttributes = "";
		$this->member_selanjutnya->HrefValue = "";
		$this->member_selanjutnya->TooltipValue = "";

		// nominal_bawah
		$this->nominal_bawah->LinkCustomAttributes = "";
		$this->nominal_bawah->HrefValue = "";
		$this->nominal_bawah->TooltipValue = "";

		// nominal_atas
		$this->nominal_atas->LinkCustomAttributes = "";
		$this->nominal_atas->HrefValue = "";
		$this->nominal_atas->TooltipValue = "";

		// qty_bawah
		$this->qty_bawah->LinkCustomAttributes = "";
		$this->qty_bawah->HrefValue = "";
		$this->qty_bawah->TooltipValue = "";

		// qty_atas
		$this->qty_atas->LinkCustomAttributes = "";
		$this->qty_atas->HrefValue = "";
		$this->qty_atas->TooltipValue = "";

		// disc_prosen
		$this->disc_prosen->LinkCustomAttributes = "";
		$this->disc_prosen->HrefValue = "";
		$this->disc_prosen->TooltipValue = "";

		// disc_nominal
		$this->disc_nominal->LinkCustomAttributes = "";
		$this->disc_nominal->HrefValue = "";
		$this->disc_nominal->TooltipValue = "";

		// jangka_waktu
		$this->jangka_waktu->LinkCustomAttributes = "";
		$this->jangka_waktu->HrefValue = "";
		$this->jangka_waktu->TooltipValue = "";

		// min_kedatangan
		$this->min_kedatangan->LinkCustomAttributes = "";
		$this->min_kedatangan->HrefValue = "";
		$this->min_kedatangan->TooltipValue = "";

		// poin_member
		$this->poin_member->LinkCustomAttributes = "";
		$this->poin_member->HrefValue = "";
		$this->poin_member->TooltipValue = "";

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

		// id_jenis_member
		$this->id_jenis_member->EditAttrs["class"] = "form-control";
		$this->id_jenis_member->EditCustomAttributes = "";
		$this->id_jenis_member->EditValue = $this->id_jenis_member->CurrentValue;
		$this->id_jenis_member->EditValue = FormatNumber($this->id_jenis_member->EditValue, 0, -2, -2, -2);
		$this->id_jenis_member->ViewCustomAttributes = "";

		// nama_member
		$this->nama_member->EditAttrs["class"] = "form-control";
		$this->nama_member->EditCustomAttributes = "";
		if (!$this->nama_member->Raw)
			$this->nama_member->CurrentValue = HtmlDecode($this->nama_member->CurrentValue);
		$this->nama_member->EditValue = $this->nama_member->CurrentValue;
		$this->nama_member->PlaceHolder = RemoveHtml($this->nama_member->caption());

		// member_selanjutnya
		$this->member_selanjutnya->EditAttrs["class"] = "form-control";
		$this->member_selanjutnya->EditCustomAttributes = "";

		// nominal_bawah
		$this->nominal_bawah->EditAttrs["class"] = "form-control";
		$this->nominal_bawah->EditCustomAttributes = "";
		$this->nominal_bawah->EditValue = $this->nominal_bawah->CurrentValue;
		$this->nominal_bawah->PlaceHolder = RemoveHtml($this->nominal_bawah->caption());

		// nominal_atas
		$this->nominal_atas->EditAttrs["class"] = "form-control";
		$this->nominal_atas->EditCustomAttributes = "";
		$this->nominal_atas->EditValue = $this->nominal_atas->CurrentValue;
		$this->nominal_atas->PlaceHolder = RemoveHtml($this->nominal_atas->caption());

		// qty_bawah
		$this->qty_bawah->EditAttrs["class"] = "form-control";
		$this->qty_bawah->EditCustomAttributes = "";
		$this->qty_bawah->EditValue = $this->qty_bawah->CurrentValue;
		$this->qty_bawah->PlaceHolder = RemoveHtml($this->qty_bawah->caption());

		// qty_atas
		$this->qty_atas->EditAttrs["class"] = "form-control";
		$this->qty_atas->EditCustomAttributes = "";
		$this->qty_atas->EditValue = $this->qty_atas->CurrentValue;
		$this->qty_atas->PlaceHolder = RemoveHtml($this->qty_atas->caption());

		// disc_prosen
		$this->disc_prosen->EditAttrs["class"] = "form-control";
		$this->disc_prosen->EditCustomAttributes = "";
		$this->disc_prosen->EditValue = $this->disc_prosen->CurrentValue;
		$this->disc_prosen->PlaceHolder = RemoveHtml($this->disc_prosen->caption());
		if (strval($this->disc_prosen->EditValue) != "" && is_numeric($this->disc_prosen->EditValue))
			$this->disc_prosen->EditValue = FormatNumber($this->disc_prosen->EditValue, -2, -2, -2, -2);
		

		// disc_nominal
		$this->disc_nominal->EditAttrs["class"] = "form-control";
		$this->disc_nominal->EditCustomAttributes = "";
		$this->disc_nominal->EditValue = $this->disc_nominal->CurrentValue;
		$this->disc_nominal->PlaceHolder = RemoveHtml($this->disc_nominal->caption());

		// jangka_waktu
		$this->jangka_waktu->EditAttrs["class"] = "form-control";
		$this->jangka_waktu->EditCustomAttributes = "";
		$this->jangka_waktu->EditValue = $this->jangka_waktu->CurrentValue;
		$this->jangka_waktu->PlaceHolder = RemoveHtml($this->jangka_waktu->caption());

		// min_kedatangan
		$this->min_kedatangan->EditAttrs["class"] = "form-control";
		$this->min_kedatangan->EditCustomAttributes = "";
		$this->min_kedatangan->EditValue = $this->min_kedatangan->CurrentValue;
		$this->min_kedatangan->PlaceHolder = RemoveHtml($this->min_kedatangan->caption());

		// poin_member
		$this->poin_member->EditAttrs["class"] = "form-control";
		$this->poin_member->EditCustomAttributes = "";
		$this->poin_member->EditValue = $this->poin_member->CurrentValue;
		$this->poin_member->PlaceHolder = RemoveHtml($this->poin_member->caption());

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
					$doc->exportCaption($this->nama_member);
					$doc->exportCaption($this->member_selanjutnya);
					$doc->exportCaption($this->nominal_bawah);
					$doc->exportCaption($this->nominal_atas);
					$doc->exportCaption($this->qty_bawah);
					$doc->exportCaption($this->qty_atas);
					$doc->exportCaption($this->disc_prosen);
					$doc->exportCaption($this->disc_nominal);
					$doc->exportCaption($this->jangka_waktu);
					$doc->exportCaption($this->min_kedatangan);
					$doc->exportCaption($this->poin_member);
				} else {
					$doc->exportCaption($this->id_jenis_member);
					$doc->exportCaption($this->nama_member);
					$doc->exportCaption($this->member_selanjutnya);
					$doc->exportCaption($this->nominal_bawah);
					$doc->exportCaption($this->nominal_atas);
					$doc->exportCaption($this->qty_bawah);
					$doc->exportCaption($this->qty_atas);
					$doc->exportCaption($this->disc_prosen);
					$doc->exportCaption($this->disc_nominal);
					$doc->exportCaption($this->jangka_waktu);
					$doc->exportCaption($this->min_kedatangan);
					$doc->exportCaption($this->poin_member);
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
						$doc->exportField($this->nama_member);
						$doc->exportField($this->member_selanjutnya);
						$doc->exportField($this->nominal_bawah);
						$doc->exportField($this->nominal_atas);
						$doc->exportField($this->qty_bawah);
						$doc->exportField($this->qty_atas);
						$doc->exportField($this->disc_prosen);
						$doc->exportField($this->disc_nominal);
						$doc->exportField($this->jangka_waktu);
						$doc->exportField($this->min_kedatangan);
						$doc->exportField($this->poin_member);
					} else {
						$doc->exportField($this->id_jenis_member);
						$doc->exportField($this->nama_member);
						$doc->exportField($this->member_selanjutnya);
						$doc->exportField($this->nominal_bawah);
						$doc->exportField($this->nominal_atas);
						$doc->exportField($this->qty_bawah);
						$doc->exportField($this->qty_atas);
						$doc->exportField($this->disc_prosen);
						$doc->exportField($this->disc_nominal);
						$doc->exportField($this->jangka_waktu);
						$doc->exportField($this->min_kedatangan);
						$doc->exportField($this->poin_member);
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