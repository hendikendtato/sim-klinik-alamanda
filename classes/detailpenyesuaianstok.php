<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for detailpenyesuaianstok
 */
class detailpenyesuaianstok extends DbTable
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
	public $pid;
	public $kode_barang;
	public $id_barang;
	public $stokdatabase;
	public $jumlah;
	public $selisih;
	public $tipe;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailpenyesuaianstok';
		$this->TableName = 'detailpenyesuaianstok';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailpenyesuaianstok`";
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
		$this->id = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pid
		$this->pid = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_pid', 'pid', '`pid`', '`pid`', 3, 11, -1, FALSE, '`pid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid->IsForeignKey = TRUE; // Foreign key field
		$this->pid->Nullable = FALSE; // NOT NULL field
		$this->pid->Sortable = TRUE; // Allow sort
		$this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid'] = &$this->pid;

		// kode_barang
		$this->kode_barang = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_kode_barang', 'kode_barang', '`kode_barang`', '`kode_barang`', 3, 11, -1, FALSE, '`kode_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_barang->Sortable = TRUE; // Allow sort
		$this->kode_barang->Lookup = new Lookup('kode_barang', 'view_hargajual', FALSE, 'id', ["kode_barang","","",""], ["penyesuaianstok x_id_klinik"], [], ["id_klinik"], ["x_id_klinik"], ["id_barang","stok"], ["x_id_barang","x_stokdatabase"], '', '');
		$this->kode_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kode_barang'] = &$this->kode_barang;

		// id_barang
		$this->id_barang = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 255, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->Lookup = new Lookup('id_barang', 'view_hargajual', FALSE, 'id_barang', ["nama_barang","","",""], ["penyesuaianstok x_id_klinik"], [], ["id_klinik"], ["x_id_klinik"], ["stok"], ["x_stokdatabase"], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// stokdatabase
		$this->stokdatabase = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_stokdatabase', 'stokdatabase', '`stokdatabase`', '`stokdatabase`', 4, 12, -1, FALSE, '`stokdatabase`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stokdatabase->Sortable = TRUE; // Allow sort
		$this->stokdatabase->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['stokdatabase'] = &$this->stokdatabase;

		// jumlah
		$this->jumlah = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 4, 12, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['jumlah'] = &$this->jumlah;

		// selisih
		$this->selisih = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_selisih', 'selisih', '`selisih`', '`selisih`', 4, 12, -1, FALSE, '`selisih`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->selisih->Sortable = TRUE; // Allow sort
		$this->selisih->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['selisih'] = &$this->selisih;

		// tipe
		$this->tipe = new DbField('detailpenyesuaianstok', 'detailpenyesuaianstok', 'x_tipe', 'tipe', '`tipe`', '`tipe`', 200, 50, -1, FALSE, '`tipe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipe->Sortable = TRUE; // Allow sort
		$this->fields['tipe'] = &$this->tipe;
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
		if ($this->getCurrentMasterTable() == "penyesuaianstok") {
			if ($this->pid->getSessionValue() != "")
				$masterFilter .= "`id_penyesuaianstok`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "penyesuaianstok") {
			if ($this->pid->getSessionValue() != "")
				$detailFilter .= "`pid`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_penyesuaianstok()
	{
		return "`id_penyesuaianstok`=@id_penyesuaianstok@";
	}

	// Detail filter
	public function sqlDetailFilter_penyesuaianstok()
	{
		return "`pid`=@pid@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailpenyesuaianstok`";
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
		$this->pid->DbValue = $row['pid'];
		$this->kode_barang->DbValue = $row['kode_barang'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->stokdatabase->DbValue = $row['stokdatabase'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->selisih->DbValue = $row['selisih'];
		$this->tipe->DbValue = $row['tipe'];
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
			return "detailpenyesuaianstoklist.php";
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
		if ($pageName == "detailpenyesuaianstokview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailpenyesuaianstokedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailpenyesuaianstokadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailpenyesuaianstoklist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailpenyesuaianstokview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailpenyesuaianstokview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailpenyesuaianstokadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailpenyesuaianstokadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("detailpenyesuaianstokedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("detailpenyesuaianstokadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("detailpenyesuaianstokdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "penyesuaianstok" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id_penyesuaianstok=" . urlencode($this->pid->CurrentValue);
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
		$this->pid->setDbValue($rs->fields('pid'));
		$this->kode_barang->setDbValue($rs->fields('kode_barang'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->stokdatabase->setDbValue($rs->fields('stokdatabase'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
		$this->selisih->setDbValue($rs->fields('selisih'));
		$this->tipe->setDbValue($rs->fields('tipe'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// pid
		// kode_barang
		// id_barang
		// stokdatabase
		// jumlah
		// selisih
		// tipe
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pid
		$this->pid->ViewValue = $this->pid->CurrentValue;
		$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
		$this->pid->ViewCustomAttributes = "";

		// kode_barang
		$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
		$curVal = strval($this->kode_barang->CurrentValue);
		if ($curVal != "") {
			$this->kode_barang->ViewValue = $this->kode_barang->lookupCacheOption($curVal);
			if ($this->kode_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`komposisi` <> 'Yes'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->kode_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kode_barang->ViewValue = $this->kode_barang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
				}
			}
		} else {
			$this->kode_barang->ViewValue = NULL;
		}
		$this->kode_barang->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$curVal = strval($this->id_barang->CurrentValue);
		if ($curVal != "") {
			$this->id_barang->ViewValue = $this->id_barang->lookupCacheOption($curVal);
			if ($this->id_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_barang`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`komposisi` <> 'Yes'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
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

		// stokdatabase
		$this->stokdatabase->ViewValue = $this->stokdatabase->CurrentValue;
		$this->stokdatabase->ViewValue = FormatNumber($this->stokdatabase->ViewValue, 2, -2, -2, -2);
		$this->stokdatabase->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 2, -2, -2, -2);
		$this->jumlah->ViewCustomAttributes = "";

		// selisih
		$this->selisih->ViewValue = $this->selisih->CurrentValue;
		$this->selisih->ViewValue = FormatNumber($this->selisih->ViewValue, 2, -2, -2, -2);
		$this->selisih->ViewCustomAttributes = "";

		// tipe
		$this->tipe->ViewValue = $this->tipe->CurrentValue;
		$this->tipe->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pid
		$this->pid->LinkCustomAttributes = "";
		$this->pid->HrefValue = "";
		$this->pid->TooltipValue = "";

		// kode_barang
		$this->kode_barang->LinkCustomAttributes = "";
		$this->kode_barang->HrefValue = "";
		$this->kode_barang->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// stokdatabase
		$this->stokdatabase->LinkCustomAttributes = "";
		$this->stokdatabase->HrefValue = "";
		$this->stokdatabase->TooltipValue = "";

		// jumlah
		$this->jumlah->LinkCustomAttributes = "";
		$this->jumlah->HrefValue = "";
		$this->jumlah->TooltipValue = "";

		// selisih
		$this->selisih->LinkCustomAttributes = "";
		$this->selisih->HrefValue = "";
		$this->selisih->TooltipValue = "";

		// tipe
		$this->tipe->LinkCustomAttributes = "";
		$this->tipe->HrefValue = "";
		$this->tipe->TooltipValue = "";

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

		// pid
		$this->pid->EditAttrs["class"] = "form-control";
		$this->pid->EditCustomAttributes = "";
		if ($this->pid->getSessionValue() != "") {
			$this->pid->CurrentValue = $this->pid->getSessionValue();
			$this->pid->ViewValue = $this->pid->CurrentValue;
			$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
			$this->pid->ViewCustomAttributes = "";
		} else {
			$this->pid->EditValue = $this->pid->CurrentValue;
			$this->pid->PlaceHolder = RemoveHtml($this->pid->caption());
		}

		// kode_barang
		$this->kode_barang->EditAttrs["class"] = "form-control";
		$this->kode_barang->EditCustomAttributes = "";
		$this->kode_barang->EditValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->PlaceHolder = RemoveHtml($this->kode_barang->caption());

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// stokdatabase
		$this->stokdatabase->EditAttrs["class"] = "form-control";
		$this->stokdatabase->EditCustomAttributes = "readonly";
		$this->stokdatabase->EditValue = $this->stokdatabase->CurrentValue;
		$this->stokdatabase->PlaceHolder = RemoveHtml($this->stokdatabase->caption());
		if (strval($this->stokdatabase->EditValue) != "" && is_numeric($this->stokdatabase->EditValue))
			$this->stokdatabase->EditValue = FormatNumber($this->stokdatabase->EditValue, -2, -2, -2, -2);
		

		// jumlah
		$this->jumlah->EditAttrs["class"] = "form-control";
		$this->jumlah->EditCustomAttributes = "";
		$this->jumlah->EditValue = $this->jumlah->CurrentValue;
		$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());
		if (strval($this->jumlah->EditValue) != "" && is_numeric($this->jumlah->EditValue))
			$this->jumlah->EditValue = FormatNumber($this->jumlah->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->pid);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->stokdatabase);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->selisih);
					$doc->exportCaption($this->tipe);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pid);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->stokdatabase);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->selisih);
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
						$doc->exportField($this->id);
						$doc->exportField($this->pid);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->stokdatabase);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->selisih);
						$doc->exportField($this->tipe);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pid);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->stokdatabase);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->selisih);
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
		$id_barang = $rsnew["id_barang"];
		$stok_lama = $rsnew["stokdatabase"];
		$tipe = $rsnew["tipe"];
		$jumlah = $rsnew["jumlah"];
		$selisih = $rsnew["selisih"];
		$id_penyesuaianstok = $rsnew["pid"];
		$id_klinik = ExecuteScalar("SELECT id_klinik FROM penyesuaianstok WHERE id_penyesuaianstok = '$id_penyesuaianstok'");
		$tanggal = ExecuteScalar("SELECT tanggal FROM penyesuaianstok WHERE id_penyesuaianstok = '$id_penyesuaianstok'");
		$tanggal_sekarang = date("Y-m-d");
		print_r($tanggal);
		print_r($tanggal_sekarang);
		if($tanggal < $tanggal_sekarang){
			$get_id_kartustok = ExecuteScalar("SELECT id_kartustok FROM kartustok WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang' AND tanggal >= '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC LIMIT 1");
			if($get_id_kartustok != null OR $get_id_kartustok != false) {
				$get_data_kartustok = ExecuteRows("SELECT id_kartustok FROM kartustok WHERE id_kartustok >= '$get_id_kartustok' ORDER BY id_kartustok DESC");
				foreach($get_data_kartustok AS $data_id){
					$id = $data_id['id_kartustok'];
					$id_update = $id + 1;
					Execute("UPDATE kartustok SET id_kartustok = '$id_update' WHERE id_kartustok = '$id'");
				}
				if($tipe == 'Masuk') {
					$data_barang_kartustok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_klinik ='$id_klinik' AND id_barang='$id_barang' AND id_kartustok >= '$get_id_kartustok' ORDER BY tanggal ASC, id_kartustok ASC");
					foreach($data_barang_kartustok AS $data_barang) {
						$id = $data_barang['id_kartustok'];
						$stok_awal_update = $data_barang['stok_awal'] + $selisih;
						$stok_akhir_update = $data_barang['stok_akhir'] + $selisih;
						Execute("UPDATE kartustok SET stok_awal = '$stok_awal_update', stok_akhir = '$stok_akhir_update' WHERE id_kartustok = '$id'");
					}
				} else {
					$data_barang_kartustok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_klinik ='$id_klinik' AND id_barang='$id_barang' AND id_kartustok >= '$get_id_kartustok' ORDER BY tanggal ASC, id_kartustok ASC");
					foreach($data_barang_kartustok AS $data_barang) {
						$id = $data_barang['id_kartustok'];
						$stok_awal_update = $data_barang['stok_awal'] - $selisih;
						$stok_akhir_update = $data_barang['stok_akhir'] - $selisih;
						Execute("UPDATE kartustok SET stok_awal = '$stok_awal_update', stok_akhir = '$stok_akhir_update' WHERE id_kartustok = '$id'");
					}
				}

				//Insert data
				Execute("INSERT INTO kartustok (id_kartustok, id_barang, id_klinik, tanggal, stok_awal, id_penyesuaian, masuk_penyesuaian, stok_akhir)
						VALUES ('$get_id_kartustok', '$id_barang', '$id_klinik', '$tanggal', '$stok_lama', '$id_penyesuaianstok', '$selisih', '$jumlah')");

				//update master
				$stok_akhir_update = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang='$id_barang' AND id_klinik='$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
				Execute("UPDATE m_hargajual SET stok='$stok_akhir_update' WHERE id_barang='$id_barang' AND id_klinik='$id_klinik'");								
			} else {

				//Insert data
				Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penyesuaian, masuk_penyesuaian, stok_akhir)
				VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_lama', '$id_penyesuaianstok', '$selisih', '$jumlah')");
				$stok_akhir_update = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang='$id_barang' AND id_klinik='$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
				Execute("UPDATE m_hargajual SET stok='$stok_akhir_update' WHERE id_barang='$id_barang' AND id_klinik='$id_klinik'");					
			}

			/*$id_kartustok_awal = ExecuteScalar("SELECT id_kartustok FROM kartustok WHERE id_klinik='$id_klinik' AND id_barang='$id_barang' AND tanggal >= '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC LIMIT 1");		
			var_dump($id_kartustok_awal);
			// Jika id_kartustok di (tanggal >=) tidak null
			if($id_kartustok_awal != NULL OR $id_kartustok_awal != FALSE) {
				$stok_awal_penyesuaian = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_klinik='$id_klinik' AND id_barang='$id_barang' AND tanggal >= '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC LIMIT 1");		
				if($tipe == 'Masuk') {
					$stok_baru = $stok_awal_penyesuaian + $selisih;
					// insert into kartu stok
					$kartu_stok = ExecuteScalar("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penyesuaian, masuk_penyesuaian, stok_akhir)
								VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_awal_penyesuaian', '$id_penyesuaianstok', '$selisih', '$stok_baru')");
					print_r($kartu_stok); 
					$id_kartustok_setelahnya = ExecuteRows("SELECT id_kartustok FROM kartustok WHERE id_kartustok >= '$id_kartustok_awal' ORDER BY id_kartustok DESC");
					print_r($id_kartustok_setelahnya);
					var_dump($id_kartustok_setelahnya);
					foreach($id_kartustok_setelahnya AS $idks){
						$id = $idks['id_kartustok'];
						$update_id = $idks['id_kartustok'] + 1;
						$update = Execute("UPDATE kartustok SET id_kartustok='$update_id' WHERE id_kartustok='$id'");
						print_r($update);
					}
					$id_terakhir = ExecuteScalar("SELECT id_kartustok FROM kartustok ORDER BY id_kartustok DESC LIMIT 1");
					$update2 = Execute("UPDATE kartustok SET id_kartustok='$id_kartustok_awal', stok_awal = '$stok_lama', stok_akhir = '$jumlah' WHERE id_kartustok='$id_terakhir'");
					var_dump($id_terakhir);
					//$selisih_penyesuaian = $stok_baru - $stok_awal_penyesuaian;
					$datakartustok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_klinik ='$id_klinik' AND id_barang='$id_barang' AND tanggal >= '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
					var_dump($datakartustok);
					foreach($datakartustok AS $dk){
						$id_kartustok = $dk['id_kartustok'];
						$stok_awal = $dk['stok_awal'] + $selisih;
						$stok_akhir = $dk['stok_akhir'] + $selisih;
						$update_kartu = Execute("UPDATE kartustok SET stok_awal='$stok_awal', stok_akhir='$stok_akhir' WHERE id_klinik ='$id_klinik' AND id_barang='$id_barang' AND id_kartustok = '$id_kartustok'");
					}
					$stok_akhir_update = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang='$id_barang' AND id_klinik='$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
					Execute("UPDATE m_hargajual SET stok='$stok_akhir_update' WHERE id_barang='$id_barang' AND id_klinik='$id_klinik'");
					var_dump($stok_akhir_update);
				} else if($tipe == 'Keluar'){
					$stok_baru = $stok_awal_penyesuaian - $selisih;
					// insert into kartu stok
					$kartu_stok = ExecuteScalar("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penyesuaian, keluar_penyesuaian, stok_akhir)
									   VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_awal_penyesuaian', '$id_penyesuaianstok', '$selisih', '$stok_baru')");
					print_r($kartu_stok);
					$id_kartustok_setelahnya = ExecuteRows("SELECT id_kartustok FROM kartustok WHERE id_kartustok >= '$id_kartustok_awal' ORDER BY id_kartustok DESC");
					var_dump($id_kartustok_setelahnya);
					foreach($id_kartustok_setelahnya AS $idks){
						$id = $idks['id_kartustok'];
						$update_id = $idks['id_kartustok'] + 1;
						$update = Execute("UPDATE kartustok SET id_kartustok='$update_id' WHERE id_kartustok='$id'");
						print_r($update);
					}
					$id_terakhir = ExecuteScalar("SELECT id_kartustok FROM kartustok ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
					$update2 = Execute("UPDATE kartustok SET id_kartustok='$id_kartustok_awal', stok_awal = '$stok_lama', stok_akhir = '$jumlah' WHERE id_kartustok='$id_terakhir'");
					var_dump($id_terakhir);
					//$selisih_penyesuaian = $stok_baru - $stok_awal_penyesuaian;
					$datakartustok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_klinik ='$id_klinik' AND id_barang='$id_barang' AND tanggal >= '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
					var_dump($datakartustok);
					if($datakartustok != NULL OR $datakartustok != FALSE) {
						foreach($datakartustok AS $dk){
							$id_kartustok = $dk['id_kartustok'];
							$stok_awal = $dk['stok_awal'] + $selisih;
							$stok_akhir = $dk['stok_akhir'] + $selisih;
						$update_kartu = Execute("UPDATE kartustok SET stok_awal='$stok_awal', stok_akhir='$stok_akhir' WHERE id_klinik ='$id_klinik' AND id_barang='$id_barang' AND id_kartustok = '$id_kartustok'");
							print_r($stok_awal);
							print_r($stok_akhir);
						}
					}
					$stok_akhir_update = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang='$id_barang' AND id_klinik='$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
					Execute("UPDATE m_hargajual SET stok='$stok_akhir_update' WHERE id_barang='$id_barang' AND id_klinik='$id_klinik'");		
					var_dump($stok_akhir_update);
				}		
			} else { //id kartustok == null or false
				$id_kartustok_awal_sebelumnya = ExecuteScalar("SELECT id_kartustok FROM kartustok WHERE id_klinik='$id_klinik' AND id_barang='$id_barang' AND tanggal <= '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");		
				$stok_awal_penyesuaian_sebelumnya = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_klinik='$id_klinik' AND id_barang='$id_barang' AND tanggal <= '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");		
				if($tipe == 'Masuk') {
					$stok_baru = $stok_awal_penyesuaian_sebelumnya + $selisih;
					// insert into kartu stok
					$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penyesuaian, masuk_penyesuaian, stok_akhir)
									   VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_awal_penyesuaian_sebelumnya', '$id_penyesuaianstok', '$selisih', '$stok_baru')");
					print_r($kartu_stok);
					$stok_akhir_update = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang='$id_barang' AND id_klinik='$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
					Execute("UPDATE m_hargajual SET stok='$stok_akhir_update' WHERE id_barang='$id_barang' AND id_klinik='$id_klinik'");
				} else if($tipe == 'Keluar'){
					$stok_baru = $stok_awal_penyesuaian_sebelumnya - $selisih;
					// insert into kartu stok
					$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penyesuaian, keluar_penyesuaian, stok_akhir)
									   VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_awal_penyesuaian_sebelumnya', '$id_penyesuaianstok', '$selisih', '$stok_baru')");
					print_r($kartu_stok);
					$stok_akhir_update = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang='$id_barang' AND id_klinik='$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
					Execute("UPDATE m_hargajual SET stok='$stok_akhir_update' WHERE id_barang='$id_barang' AND id_klinik='$id_klinik'");		
				}			
			}*/
		} else {
			if($tipe == 'Masuk') {
				$stok_baru = $stok_lama + $selisih;
				// update stok
				$update_stok = Execute("UPDATE m_hargajual SET stok='$stok_baru' WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
				// insert into kartu stok
				$kartu_stok = Execute("INSERT INTO kartustok (
			        					id_barang,
			        					id_klinik,
			        					tanggal,
			        					stok_awal,
			        					id_penyesuaian,
			        					masuk_penyesuaian,
			        					stok_akhir)
			        			   VALUES (
			        			   		'$id_barang',
			        			   		'$id_klinik',
			        			   		'$tanggal',
			        			   		'$stok_lama',
			        			   		'$id_penyesuaianstok',
			        			   		'$selisih',
			        			   		'$jumlah')");
			} else if($tipe == 'Keluar'){
				$stok_baru = $stok_lama - $selisih;
				if($stok_baru < 0) { $stok_baru = 0; }
				// update stok
				$update_stok = Execute("UPDATE m_hargajual SET stok='$stok_baru' WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
				// insert into kartu stok
				$kartu_stok = Execute("INSERT INTO kartustok (
										id_barang,
										id_klinik,
										tanggal,
										stok_awal,
										id_penyesuaian,
										keluar_penyesuaian,
										stok_akhir)
									VALUES (
										'$id_barang',
										'$id_klinik',
										'$tanggal',
										'$stok_lama',
										'$id_penyesuaianstok',
										'$selisih',
										'$jumlah')");
			}
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