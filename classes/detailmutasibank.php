<?php namespace PHPMaker2020\klinik_latest_08_04_21; ?>
<?php

/**
 * Table class for detailmutasibank
 */
class detailmutasibank extends DbTable
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
	public $akun_id;
	public $nama_akun;
	public $jumlah;
	public $keterangan;
	public $tipe_mutasi;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailmutasibank';
		$this->TableName = 'detailmutasibank';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailmutasibank`";
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
		$this->id = new DbField('detailmutasibank', 'detailmutasibank', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = FALSE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pid
		$this->pid = new DbField('detailmutasibank', 'detailmutasibank', 'x_pid', 'pid', '`pid`', '`pid`', 3, 11, -1, FALSE, '`pid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid->IsForeignKey = TRUE; // Foreign key field
		$this->pid->Sortable = FALSE; // Allow sort
		$this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid'] = &$this->pid;

		// akun_id
		$this->akun_id = new DbField('detailmutasibank', 'detailmutasibank', 'x_akun_id', 'akun_id', '`akun_id`', '`akun_id`', 3, 11, -1, FALSE, '`akun_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->akun_id->Sortable = TRUE; // Allow sort
		$this->akun_id->Lookup = new Lookup('akun_id', 'm_akun', FALSE, 'id_akun', ["kode_akun","","",""], ["mutasi_kas x_id_klinik"], [], ["id_klinik"], ["x_id_klinik"], ["nama_akun"], ["x_nama_akun"], '', '');
		$this->akun_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['akun_id'] = &$this->akun_id;

		// nama_akun
		$this->nama_akun = new DbField('detailmutasibank', 'detailmutasibank', 'x_nama_akun', 'nama_akun', '`nama_akun`', '`nama_akun`', 200, 50, -1, FALSE, '`nama_akun`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_akun->Sortable = TRUE; // Allow sort
		$this->nama_akun->Lookup = new Lookup('nama_akun', 'm_akun', FALSE, 'nama_akun', ["nama_akun","","",""], ["mutasi_kas x_id_klinik"], [], ["id_klinik"], ["x_id_klinik"], [], [], '', '');
		$this->fields['nama_akun'] = &$this->nama_akun;

		// jumlah
		$this->jumlah = new DbField('detailmutasibank', 'detailmutasibank', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 5, 22, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['jumlah'] = &$this->jumlah;

		// keterangan
		$this->keterangan = new DbField('detailmutasibank', 'detailmutasibank', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// tipe_mutasi
		$this->tipe_mutasi = new DbField('detailmutasibank', 'detailmutasibank', 'x_tipe_mutasi', 'tipe_mutasi', '`tipe_mutasi`', '`tipe_mutasi`', 200, 50, -1, FALSE, '`tipe_mutasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipe_mutasi->Sortable = FALSE; // Allow sort
		$this->fields['tipe_mutasi'] = &$this->tipe_mutasi;
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
		if ($this->getCurrentMasterTable() == "mutasi_kas") {
			if ($this->pid->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "mutasi_kas") {
			if ($this->pid->getSessionValue() != "")
				$detailFilter .= "`pid`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_mutasi_kas()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_mutasi_kas()
	{
		return "`pid`=@pid@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailmutasibank`";
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
		$this->akun_id->DbValue = $row['akun_id'];
		$this->nama_akun->DbValue = $row['nama_akun'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->tipe_mutasi->DbValue = $row['tipe_mutasi'];
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
			return "detailmutasibanklist.php";
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
		if ($pageName == "detailmutasibankview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailmutasibankedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailmutasibankadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailmutasibanklist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailmutasibankview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailmutasibankview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailmutasibankadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailmutasibankadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("detailmutasibankedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("detailmutasibankadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("detailmutasibankdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "mutasi_kas" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->pid->CurrentValue);
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
		$this->akun_id->setDbValue($rs->fields('akun_id'));
		$this->nama_akun->setDbValue($rs->fields('nama_akun'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->tipe_mutasi->setDbValue($rs->fields('tipe_mutasi'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// pid
		$this->pid->CellCssStyle = "white-space: nowrap;";

		// akun_id
		// nama_akun
		// jumlah
		// keterangan
		// tipe_mutasi
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pid
		$this->pid->ViewValue = $this->pid->CurrentValue;
		$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
		$this->pid->ViewCustomAttributes = "";

		// akun_id
		$this->akun_id->ViewValue = $this->akun_id->CurrentValue;
		$curVal = strval($this->akun_id->CurrentValue);
		if ($curVal != "") {
			$this->akun_id->ViewValue = $this->akun_id->lookupCacheOption($curVal);
			if ($this->akun_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_akun`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->akun_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->akun_id->ViewValue = $this->akun_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->akun_id->ViewValue = $this->akun_id->CurrentValue;
				}
			}
		} else {
			$this->akun_id->ViewValue = NULL;
		}
		$this->akun_id->ViewCustomAttributes = "";

		// nama_akun
		$this->nama_akun->ViewValue = $this->nama_akun->CurrentValue;
		$curVal = strval($this->nama_akun->CurrentValue);
		if ($curVal != "") {
			$this->nama_akun->ViewValue = $this->nama_akun->lookupCacheOption($curVal);
			if ($this->nama_akun->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nama_akun`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->nama_akun->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->nama_akun->ViewValue = $this->nama_akun->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nama_akun->ViewValue = $this->nama_akun->CurrentValue;
				}
			}
		} else {
			$this->nama_akun->ViewValue = NULL;
		}
		$this->nama_akun->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 2, -2, -2, -2);
		$this->jumlah->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// tipe_mutasi
		$this->tipe_mutasi->ViewValue = $this->tipe_mutasi->CurrentValue;
		$this->tipe_mutasi->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pid
		$this->pid->LinkCustomAttributes = "";
		$this->pid->HrefValue = "";
		$this->pid->TooltipValue = "";

		// akun_id
		$this->akun_id->LinkCustomAttributes = "";
		$this->akun_id->HrefValue = "";
		$this->akun_id->TooltipValue = "";

		// nama_akun
		$this->nama_akun->LinkCustomAttributes = "";
		$this->nama_akun->HrefValue = "";
		$this->nama_akun->TooltipValue = "";

		// jumlah
		$this->jumlah->LinkCustomAttributes = "";
		$this->jumlah->HrefValue = "";
		$this->jumlah->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

		// tipe_mutasi
		$this->tipe_mutasi->LinkCustomAttributes = "";
		$this->tipe_mutasi->HrefValue = "";
		$this->tipe_mutasi->TooltipValue = "";

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

		// akun_id
		$this->akun_id->EditAttrs["class"] = "form-control";
		$this->akun_id->EditCustomAttributes = "";
		$this->akun_id->EditValue = $this->akun_id->CurrentValue;
		$this->akun_id->PlaceHolder = RemoveHtml($this->akun_id->caption());

		// nama_akun
		$this->nama_akun->EditAttrs["class"] = "form-control";
		$this->nama_akun->EditCustomAttributes = "";
		if (!$this->nama_akun->Raw)
			$this->nama_akun->CurrentValue = HtmlDecode($this->nama_akun->CurrentValue);
		$this->nama_akun->EditValue = $this->nama_akun->CurrentValue;
		$this->nama_akun->PlaceHolder = RemoveHtml($this->nama_akun->caption());

		// jumlah
		$this->jumlah->EditAttrs["class"] = "form-control";
		$this->jumlah->EditCustomAttributes = "";
		$this->jumlah->EditValue = $this->jumlah->CurrentValue;
		$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());
		if (strval($this->jumlah->EditValue) != "" && is_numeric($this->jumlah->EditValue))
			$this->jumlah->EditValue = FormatNumber($this->jumlah->EditValue, -2, -2, -2, -2);
		

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		if (!$this->keterangan->Raw)
			$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// tipe_mutasi
		$this->tipe_mutasi->EditAttrs["class"] = "form-control";
		$this->tipe_mutasi->EditCustomAttributes = "";
		if (!$this->tipe_mutasi->Raw)
			$this->tipe_mutasi->CurrentValue = HtmlDecode($this->tipe_mutasi->CurrentValue);
		$this->tipe_mutasi->EditValue = $this->tipe_mutasi->CurrentValue;
		$this->tipe_mutasi->PlaceHolder = RemoveHtml($this->tipe_mutasi->caption());

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
					$doc->exportCaption($this->akun_id);
					$doc->exportCaption($this->nama_akun);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->keterangan);
				} else {
					$doc->exportCaption($this->akun_id);
					$doc->exportCaption($this->nama_akun);
					$doc->exportCaption($this->jumlah);
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
						$doc->exportField($this->akun_id);
						$doc->exportField($this->nama_akun);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->keterangan);
					} else {
						$doc->exportField($this->akun_id);
						$doc->exportField($this->nama_akun);
						$doc->exportField($this->jumlah);
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

		$id_mutasi = $rsnew['pid'];
		$id_akun = $rsnew['akun_id'];
		$nama_akun = ExecuteScalar("SELECT nama_akun FROM m_akun WHERE id_akun = $id_akun");
		if($nama_akun == 'Setor Tunai'){
			if(date("l") == "Friday" || date("l" == "Saturday" || date('l') == "Sunday")){				

				// $detailmutasibank = ExecuteScalar("SELECT * FROM detailmutasibank WHERE pid = $id_mutasi");
				// if(empty($detailmutasibank)){
				// 	Execute("DELETE FROM mutasi_kas WHERE id = $id_mutasi");
				// }

				echo "<script>alert('Mohon Maaf Transaksi Setor Tunai Tidak Bisa Dilakukan, Tolong Lakukan Transaksi Setor Tunai Di Hari Senin - Kamis')</script>";
				return FALSE;
			}
		}
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		$id_mutasi = $rsnew['pid'];
		$jumlah = $rsnew['jumlah'];
		$id_kas = ExecuteScalar("SELECT id_kas FROM mutasi_kas WHERE id = $id_mutasi");
		$id_klinik = ExecuteScalar("SELECT id_klinik FROM mutasi_kas WHERE id = $id_mutasi");
		$tgl = ExecuteScalar("SELECT tgl FROM mutasi_kas WHERE id = $id_mutasi");
		$saldo_kas_lama = ExecuteScalar("SELECT saldo FROM m_kas WHERE id = $id_kas AND id_klinik = $id_klinik");
		$saldo_akun_lama = ExecuteScalar("SELECT saldo FROM m_akun WHERE nama_akun LIKE '%setor%tunai%' AND id_klinik = $id_klinik");
		$tipe_mutasi = ExecuteScalar("SELECT tipe FROM mutasi_kas WHERE id = $id_mutasi");
		if($tipe_mutasi == 'Mutasi Kas Masuk'){
			$saldo_kas_baru = $saldo_kas_lama + $jumlah;
			Execute("UPDATE m_kas SET saldo=$saldo_kas_baru WHERE id = $id_kas AND id_klinik = $id_klinik");
			Execute("INSERT INTO laporan_kas (id_klinik, id_kas, id_mutasi_kas, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES('$id_klinik', '$id_kas', '$id_mutasi', '$saldo_kas_lama', '$jumlah', '$saldo_kas_baru', DATE(NOW()))");
		} else {
			$saldo_kas_baru = $saldo_kas_lama - $jumlah;
			if($saldo_kas_baru <= 0){
				Execute("UPDATE m_kas SET saldo='0' WHERE id = $id_kas AND id_klinik = $id_klinik");			
				Execute("INSERT INTO laporan_kas (id_klinik, id_kas, id_mutasi_kas, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES('$id_klinik', '$id_kas', '$id_mutasi', '$saldo_kas_lama', '$jumlah', '0', DATE(NOW()))");		
			} else {
				Execute("UPDATE m_kas SET saldo=$saldo_kas_baru WHERE id = $id_kas AND id_klinik = $id_klinik");
				Execute("INSERT INTO laporan_kas (id_klinik, id_kas, id_mutasi_kas, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES('$id_klinik', '$id_kas', '$id_mutasi', '$saldo_kas_lama', '$jumlah', '$saldo_kas_baru', DATE(NOW()))");		
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
		$id_mutasi = $rsold['pid'];
		$jumlah_lama = $rsold['jumlah'];
		$jumlah = $rsnew['jumlah'];
		$id_kas = ExecuteScalar("SELECT id_kas FROM mutasi_kas WHERE id = $id_mutasi");
		$id_klinik = ExecuteScalar("SELECT id_klinik FROM mutasi_kas WHERE id = $id_mutasi");
		$tgl = ExecuteScalar("SELECT tgl FROM mutasi_kas WHERE id = $id_mutasi");
		$saldo_kas_lama = ExecuteScalar("SELECT saldo FROM m_kas WHERE id = $id_kas AND id_klinik = $id_klinik");
		$tipe_mutasi_lama = $rsold["tipe_mutasi"];
		$tipe_mutasi = $rsnew["tipe_mutasi"];
		if($tipe_mutasi_lama != $tipe_mutasi){
			if($tipe_mutasi == 'Mutasi Kas Masuk'){
				$saldo_kas = $saldo_kas_lama + $jumlah_lama;
				$saldo_kas_terbaru = $saldo_kas + $jumlah;			
				Execute("UPDATE m_kas SET saldo = '$saldo_kas_terbaru' WHERE id = '$id_kas' AND id_klinik = '$id_klinik'");
				$id_laporan_kas = ExecuteScalar("SELECT id FROM laporan_kas WHERE id_mutasi_kas = '$id_mutasi' AND id_kas = '$id_kas' AND id_klinik = '$id_klinik'");
				$saldo_awal = ExecuteScalar("SELECT saldo_awal FROM laporan_kas WHERE id = $id_laporan_kas");			
				$sisa_saldo = ExecuteScalar("SELECT sisa_saldo FROM laporan_kas WHERE id = $id_laporan_kas");
				$sisa_saldo_update = $saldo_awal + $jumlah;
				Execute("UPDATE laporan_kas SET sisa_saldo = '$sisa_saldo_update', jumlah = '$jumlah' WHERE id = $id_laporan_kas");
				$data_laporan_kas = ExecuteRows("SELECT id, saldo_awal, sisa_saldo, jumlah FROM laporan_kas WHERE id_kas = '$id_kas' AND id_klinik = '$id_klinik' AND id > $id_laporan_kas");
				$saldo_awal_setelahnya = ExecuteScalar("SELECT saldo_awal FROM laporan_kas WHERE id_kas = '$id_kas' AND id_klinik = '$id_klinik' AND id > $id_laporan_kas LIMIT 1");
				$selisih_saldo = $sisa_saldo_update - $saldo_awal_setelahnya;
				foreach($data_laporan_kas AS $row){
					$id = $row['id'];
					$saldo_update = $row['saldo_awal'] + $selisih_saldo;
					$sisa_update = $row['sisa_saldo'] + $selisih_saldo;
					Execute("UPDATE laporan_kas SET saldo_awal = '$saldo_update', sisa_saldo = '$sisa_update' WHERE id = $id");
				}
			} else if($tipe_mutasi == 'Mutasi Kas Keluar'){
				$saldo_kas = $saldo_kas_lama - $jumlah_lama;
				$saldo_kas_terbaru = $saldo_kas - $jumlah;			
				Execute("UPDATE m_kas SET saldo = '$saldo_kas_terbaru' WHERE id = '$id_kas' AND id_klinik = '$id_klinik'");
				$id_laporan_kas = ExecuteScalar("SELECT id FROM laporan_kas WHERE id_mutasi_kas = '$id_mutasi' AND id_kas = '$id_kas' AND id_klinik = '$id_klinik'");
				$saldo_awal = ExecuteScalar("SELECT saldo_awal FROM laporan_kas WHERE id = $id_laporan_kas");			
				$sisa_saldo = ExecuteScalar("SELECT sisa_saldo FROM laporan_kas WHERE id = $id_laporan_kas");
				$sisa_saldo_update = $saldo_awal - $jumlah;
				Execute("UPDATE laporan_kas SET sisa_saldo = '$sisa_saldo_update', jumlah = '$jumlah' WHERE id = $id_laporan_kas");
				$data_laporan_kas = ExecuteRows("SELECT id, saldo_awal, sisa_saldo FROM laporan_kas WHERE id_kas = '$id_kas' AND id_klinik = '$id_klinik' AND id > $id_laporan_kas");
				$saldo_awal_setelahnya = ExecuteScalar("SELECT saldo_awal FROM laporan_kas WHERE id_kas = '$id_kas' AND id_klinik = '$id_klinik' AND id > $id_laporan_kas LIMIT 1");
				$selisih_saldo = $saldo_awal_setelahnya - $sisa_saldo_update;
				foreach($data_laporan_kas AS $row){
					$id = $row['id'];
					$saldo_update = $row['saldo_awal'] - $selisih_saldo;
					$sisa_update = $row['sisa_saldo'] - $selisih_saldo;
					Execute("UPDATE laporan_kas SET saldo_awal = '$saldo_update', sisa_saldo = '$sisa_update' WHERE id = $id");
				}
			}
		} else {
			if($tipe_mutasi == 'Mutasi Kas Masuk'){
				$saldo_kas_update = $saldo_kas_lama - $jumlah_lama;
				$saldo_kas_baru = $saldo_kas_update + $jumlah;
				Execute("UPDATE m_kas SET saldo=$saldo_kas_baru WHERE id = $id_kas AND id_klinik = $id_klinik");
				$id_laporan_kas = ExecuteScalar("SELECT id FROM laporan_kas WHERE id_mutasi_kas = '$id_mutasi' AND id_kas = '$id_kas' AND id_klinik = '$id_klinik'");
				$saldo_awal = ExecuteScalar("SELECT saldo_awal FROM laporan_kas WHERE id = $id_laporan_kas");			
				$sisa_saldo = ExecuteScalar("SELECT sisa_saldo FROM laporan_kas WHERE id = $id_laporan_kas");
				$sisa_saldo_update = $sisa_saldo - $saldo_awal;
				Execute("UPDATE laporan_kas SET jumlah='$jumlah', sisa_saldo = '$sisa_saldo_update' WHERE id = $id_laporan_kas");			
				$data_laporan_kas = ExecuteRows("SELECT id, saldo_awal, sisa_saldo FROM laporan_kas WHERE id_kas = '$id_kas' AND id_klinik = '$id_klinik' AND id > $id_laporan_kas");
				foreach($data_laporan_kas AS $row){
					$id = $row['id'];
					$saldo_update = $row['saldo_awal'] + $jumlah;
					$sisa_update = $row['sisa_saldo'] + $jumlah;
					Execute("UPDATE laporan_kas SET saldo_awal='$saldo_update' WHERE id = $id");
				}
			} else {
				$saldo_kas_update = $saldo_kas_lama + $jumlah_lama;
				Execute("UPDATE m_kas SET saldo=$saldo_kas_update WHERE id = $id_kas AND id_klinik = $id_klinik");		

				//print_r($update_data); exit();
				$saldo_kas_baru = $saldo_kas_lama - $jumlah;
				if($saldo_kas_baru <= 0){
					Execute("UPDATE m_kas SET saldo='0' WHERE id = $id_kas AND id_klinik = $id_klinik");			
				} else {
					Execute("UPDATE m_kas SET saldo=$saldo_kas_baru WHERE id = $id_kas AND id_klinik = $id_klinik");
				}
				Execute("UPDATE laporan_kas SET jumlah='$jumlah WHERE id_kas = $id_kas AND id_klinik = $id_klinik AND id_mutasi_kas = $id_mutasi");
			}
		}
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