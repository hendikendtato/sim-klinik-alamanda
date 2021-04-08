<?php namespace PHPMaker2020\klinik_latest_08_04_21; ?>
<?php

/**
 * Table class for antrian
 */
class antrian extends DbTable
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
	public $tanggal;
	public $nomor_antrian;
	public $keperluan;
	public $nama_klinik;
	public $selesai;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'antrian';
		$this->TableName = 'antrian';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`antrian`";
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
		$this->id = new DbField('antrian', 'antrian', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// tanggal
		$this->tanggal = new DbField('antrian', 'antrian', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 133, 10, 0, FALSE, '`tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal->Sortable = TRUE; // Allow sort
		$this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tanggal'] = &$this->tanggal;

		// nomor_antrian
		$this->nomor_antrian = new DbField('antrian', 'antrian', 'x_nomor_antrian', 'nomor_antrian', '`nomor_antrian`', '`nomor_antrian`', 200, 100, -1, FALSE, '`nomor_antrian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomor_antrian->Sortable = TRUE; // Allow sort
		$this->fields['nomor_antrian'] = &$this->nomor_antrian;

		// keperluan
		$this->keperluan = new DbField('antrian', 'antrian', 'x_keperluan', 'keperluan', '`keperluan`', '`keperluan`', 200, 50, -1, FALSE, '`keperluan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keperluan->Sortable = TRUE; // Allow sort
		$this->fields['keperluan'] = &$this->keperluan;

		// nama_klinik
		$this->nama_klinik = new DbField('antrian', 'antrian', 'x_nama_klinik', 'nama_klinik', '`nama_klinik`', '`nama_klinik`', 200, 255, -1, FALSE, '`nama_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->nama_klinik->Nullable = FALSE; // NOT NULL field
		$this->nama_klinik->Required = TRUE; // Required field
		$this->nama_klinik->Sortable = TRUE; // Allow sort
		$this->nama_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->nama_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->nama_klinik->Lookup = new Lookup('nama_klinik', 'm_klinik', FALSE, 'nama_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->fields['nama_klinik'] = &$this->nama_klinik;

		// selesai
		$this->selesai = new DbField('antrian', 'antrian', 'x_selesai', 'selesai', '`selesai`', '`selesai`', 202, 5, -1, FALSE, '`selesai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->selesai->Sortable = TRUE; // Allow sort
		$this->selesai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->selesai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->selesai->Lookup = new Lookup('selesai', 'antrian', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->selesai->OptionCount = 2;
		$this->fields['selesai'] = &$this->selesai;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`antrian`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`id` DESC";
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
		$this->tanggal->DbValue = $row['tanggal'];
		$this->nomor_antrian->DbValue = $row['nomor_antrian'];
		$this->keperluan->DbValue = $row['keperluan'];
		$this->nama_klinik->DbValue = $row['nama_klinik'];
		$this->selesai->DbValue = $row['selesai'];
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
			return "antrianlist.php";
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
		if ($pageName == "antrianview.php")
			return $Language->phrase("View");
		elseif ($pageName == "antrianedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "antrianadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "antrianlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("antrianview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("antrianview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "antrianadd.php?" . $this->getUrlParm($parm);
		else
			$url = "antrianadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("antrianedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("antrianadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("antriandelete.php", $this->getUrlParm());
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
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->nomor_antrian->setDbValue($rs->fields('nomor_antrian'));
		$this->keperluan->setDbValue($rs->fields('keperluan'));
		$this->nama_klinik->setDbValue($rs->fields('nama_klinik'));
		$this->selesai->setDbValue($rs->fields('selesai'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// tanggal
		// nomor_antrian
		// keperluan
		// nama_klinik
		// selesai
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
		$this->tanggal->ViewCustomAttributes = "";

		// nomor_antrian
		$this->nomor_antrian->ViewValue = $this->nomor_antrian->CurrentValue;
		$this->nomor_antrian->ViewCustomAttributes = "";

		// keperluan
		$this->keperluan->ViewValue = $this->keperluan->CurrentValue;
		$this->keperluan->ViewCustomAttributes = "";

		// nama_klinik
		$curVal = strval($this->nama_klinik->CurrentValue);
		if ($curVal != "") {
			$this->nama_klinik->ViewValue = $this->nama_klinik->lookupCacheOption($curVal);
			if ($this->nama_klinik->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nama_klinik`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->nama_klinik->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->nama_klinik->ViewValue = $this->nama_klinik->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nama_klinik->ViewValue = $this->nama_klinik->CurrentValue;
				}
			}
		} else {
			$this->nama_klinik->ViewValue = NULL;
		}
		$this->nama_klinik->ViewCustomAttributes = "";

		// selesai
		if (strval($this->selesai->CurrentValue) != "") {
			$this->selesai->ViewValue = $this->selesai->optionCaption($this->selesai->CurrentValue);
		} else {
			$this->selesai->ViewValue = NULL;
		}
		$this->selesai->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// tanggal
		$this->tanggal->LinkCustomAttributes = "";
		$this->tanggal->HrefValue = "";
		$this->tanggal->TooltipValue = "";

		// nomor_antrian
		$this->nomor_antrian->LinkCustomAttributes = "";
		$this->nomor_antrian->HrefValue = "";
		$this->nomor_antrian->TooltipValue = "";

		// keperluan
		$this->keperluan->LinkCustomAttributes = "";
		$this->keperluan->HrefValue = "";
		$this->keperluan->TooltipValue = "";

		// nama_klinik
		$this->nama_klinik->LinkCustomAttributes = "";
		$this->nama_klinik->HrefValue = "";
		$this->nama_klinik->TooltipValue = "";

		// selesai
		$this->selesai->LinkCustomAttributes = "";
		$this->selesai->HrefValue = "";
		$this->selesai->TooltipValue = "";

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

		// tanggal
		$this->tanggal->EditAttrs["class"] = "form-control";
		$this->tanggal->EditCustomAttributes = "";
		$this->tanggal->EditValue = FormatDateTime($this->tanggal->CurrentValue, 8);
		$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

		// nomor_antrian
		$this->nomor_antrian->EditAttrs["class"] = "form-control";
		$this->nomor_antrian->EditCustomAttributes = "";
		if (!$this->nomor_antrian->Raw)
			$this->nomor_antrian->CurrentValue = HtmlDecode($this->nomor_antrian->CurrentValue);
		$this->nomor_antrian->EditValue = $this->nomor_antrian->CurrentValue;
		$this->nomor_antrian->PlaceHolder = RemoveHtml($this->nomor_antrian->caption());

		// keperluan
		$this->keperluan->EditAttrs["class"] = "form-control";
		$this->keperluan->EditCustomAttributes = "";
		if (!$this->keperluan->Raw)
			$this->keperluan->CurrentValue = HtmlDecode($this->keperluan->CurrentValue);
		$this->keperluan->EditValue = $this->keperluan->CurrentValue;
		$this->keperluan->PlaceHolder = RemoveHtml($this->keperluan->caption());

		// nama_klinik
		$this->nama_klinik->EditAttrs["class"] = "form-control";
		$this->nama_klinik->EditCustomAttributes = "";

		// selesai
		$this->selesai->EditAttrs["class"] = "form-control";
		$this->selesai->EditCustomAttributes = "";
		$this->selesai->EditValue = $this->selesai->options(TRUE);

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
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->nomor_antrian);
					$doc->exportCaption($this->keperluan);
					$doc->exportCaption($this->nama_klinik);
					$doc->exportCaption($this->selesai);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->nomor_antrian);
					$doc->exportCaption($this->keperluan);
					$doc->exportCaption($this->nama_klinik);
					$doc->exportCaption($this->selesai);
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
						$doc->exportField($this->tanggal);
						$doc->exportField($this->nomor_antrian);
						$doc->exportField($this->keperluan);
						$doc->exportField($this->nama_klinik);
						$doc->exportField($this->selesai);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->tanggal);
						$doc->exportField($this->nomor_antrian);
						$doc->exportField($this->keperluan);
						$doc->exportField($this->nama_klinik);
						$doc->exportField($this->selesai);
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
			$id_klinik = CurrentUserInfo("id_klinik");
			if($id_klinik != '' OR $id_klinik != FALSE) {
				$nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = $id_klinik");
				if($nama_klinik != 'Pusat') {
					AddFilter($filter, "nama_klinik = '".$nama_klinik."'");
				}
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

		$keperluan = $rsnew['keperluan'];
		$klinik = $rsnew['nama_klinik'];

		// Mendapatkan kode antrian terakhir pada antrian $keperluan, untuk diambil nomor urutnya
		$kode_antrian_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='$keperluan' AND nama_klinik='$klinik' ORDER BY id DESC");
		$kode = explode('-', $kode_antrian_sebelumnya);
		$nomor_urut_terakhir = substr($kode[2], -4);
		$hari_sebelumnya = $kode[1];
		$nomor_urut = '0000';
		if ($hari_sebelumnya == date('d')) {
			$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
		} else {
			$nomor_urut = sprintf('%04d', 1);
		}

		/* kode penjualan dengan format Jxx-yymm-0000
		 * J = jual
		 *	xx = kode cabang
		 *	yy = tahun
		 *	mm = bulan
		 *	0000 = nmr urut
		*/
		$rsnew['tanggal'] = date('Y-m-d');
		if($keperluan == "Beli Produk") {
			$rsnew['nomor_antrian'] = 'B' . '-' . date('d') . '-' . $nomor_urut;
		} elseif($keperluan == "Perawatan") {
			$rsnew['nomor_antrian'] = 'P' . '-' . date('d') . '-' . $nomor_urut;
		}else {
			$rsnew['nomor_antrian'] = 'K' . '-' . date('d') . '-' . $nomor_urut;
		}
		$rsnew['selesai'] = 'belum';
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		$keperluan = $rsnew['keperluan'];
		$klinik = $rsnew['nama_klinik'];

		// Mendapatkan kode antrian terakhir pada antrian $keperluan, untuk diambil nomor urutnya
		$kode_antrian_sebelumnya = ExecuteScalar("SELECT nomor_antrian FROM antrian WHERE keperluan='$keperluan' AND nama_klinik='$klinik' ORDER BY id DESC");
		$kode = explode('-', $kode_antrian_sebelumnya);
		$nomor_urut_terakhir = substr($kode[2], -4);
		$hari_sebelumnya = $kode[1];
		$nomor_urut = '0000';
		if ($hari_sebelumnya == date('d')) {
			$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
		} else {
			$nomor_urut = sprintf('%04d', 1);
		}

		/* kode penjualan dengan format Jxx-yymm-0000
		 * J = jual
		 *	xx = kode cabang
		 *	yy = tahun
		 *	mm = bulan
		 *	0000 = nmr urut
		*/
		$rsnew['tanggal'] = date('Y-m-d');
		if($keperluan == "Beli Produk") {
			$rsnew['nomor_antrian'] = 'B' . '-' . date('d') . '-' . $nomor_urut;
		} elseif($keperluan == "Perawatan") {
			$rsnew['nomor_antrian'] = 'P' . '-' . date('d') . '-' . $nomor_urut;
		}else {
			$rsnew['nomor_antrian'] = 'K' . '-' . date('d') . '-' . $nomor_urut;
		}
		$rsnew['selesai'] = 'belum';
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
		// Kondisi saat form Tambah sedang terbuka (tidak dalam mode konfirmasi)
		//if (CurrentPageID() == "add" && $this->CurrentAction != "F") {
			//$this->nomor_antrian->EditValue =  GetNomorAntrian();// tampilkan
			//$this->nomor_antrian->ReadOnly = TRUE; // supaya tidak bisa diubah
		//}
		// Kondisi saat form Tambah sedang dalam mode konfirmasi
		//if ($this->CurrentAction == "add" && $this->CurrentAction=="F") {
			//$this->nomor_antrian->ViewValue = $this->nomor_antrian->CurrentValue; // ambil dari mode sebelumnya
		//}

		if ($this->selesai->ViewValue == "Sudah") {
			 $this->selesai->ViewAttrs["class"] = "badge badge-success";
		} elseif($this->selesai->ViewValue == "Belum"){
			$this->selesai->ViewAttrs["class"] = "badge badge-danger";
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>