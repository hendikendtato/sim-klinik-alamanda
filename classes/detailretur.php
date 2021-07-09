<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for detailretur
 */
class detailretur extends DbTable
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
	public $id_detailretur;
	public $id_retur;
	public $id_barang;
	public $jumlah;
	public $id_satuan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailretur';
		$this->TableName = 'detailretur';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailretur`";
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

		// id_detailretur
		$this->id_detailretur = new DbField('detailretur', 'detailretur', 'x_id_detailretur', 'id_detailretur', '`id_detailretur`', '`id_detailretur`', 3, 11, -1, FALSE, '`id_detailretur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_detailretur->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_detailretur->IsPrimaryKey = TRUE; // Primary key field
		$this->id_detailretur->Sortable = TRUE; // Allow sort
		$this->id_detailretur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_detailretur'] = &$this->id_detailretur;

		// id_retur
		$this->id_retur = new DbField('detailretur', 'detailretur', 'x_id_retur', 'id_retur', '`id_retur`', '`id_retur`', 19, 11, -1, FALSE, '`id_retur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_retur->IsForeignKey = TRUE; // Foreign key field
		$this->id_retur->Sortable = TRUE; // Allow sort
		$this->id_retur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_retur'] = &$this->id_retur;

		// id_barang
		$this->id_barang = new DbField('detailretur', 'detailretur', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// jumlah
		$this->jumlah = new DbField('detailretur', 'detailretur', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 5, 11, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['jumlah'] = &$this->jumlah;

		// id_satuan
		$this->id_satuan = new DbField('detailretur', 'detailretur', 'x_id_satuan', 'id_satuan', '`id_satuan`', '`id_satuan`', 3, 11, -1, FALSE, '`id_satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_satuan->Sortable = TRUE; // Allow sort
		$this->id_satuan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_satuan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_satuan->Lookup = new Lookup('id_satuan', 'm_satuan_barang', FALSE, 'id_satuan', ["nama_satuan","","",""], [], [], [], [], [], [], '', '');
		$this->id_satuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_satuan'] = &$this->id_satuan;
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
		if ($this->getCurrentMasterTable() == "returbarang") {
			if ($this->id_retur->getSessionValue() != "")
				$masterFilter .= "`id_retur`=" . QuotedValue($this->id_retur->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "returbarang") {
			if ($this->id_retur->getSessionValue() != "")
				$detailFilter .= "`id_retur`=" . QuotedValue($this->id_retur->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_returbarang()
	{
		return "`id_retur`=@id_retur@";
	}

	// Detail filter
	public function sqlDetailFilter_returbarang()
	{
		return "`id_retur`=@id_retur@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailretur`";
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
			$this->id_detailretur->setDbValue($conn->insert_ID());
			$rs['id_detailretur'] = $this->id_detailretur->DbValue;
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
			if (array_key_exists('id_detailretur', $rs))
				AddFilter($where, QuotedName('id_detailretur', $this->Dbid) . '=' . QuotedValue($rs['id_detailretur'], $this->id_detailretur->DataType, $this->Dbid));
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
		$this->id_detailretur->DbValue = $row['id_detailretur'];
		$this->id_retur->DbValue = $row['id_retur'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->id_satuan->DbValue = $row['id_satuan'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_detailretur` = @id_detailretur@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_detailretur', $row) ? $row['id_detailretur'] : NULL;
		else
			$val = $this->id_detailretur->OldValue !== NULL ? $this->id_detailretur->OldValue : $this->id_detailretur->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_detailretur@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "detailreturlist.php";
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
		if ($pageName == "detailreturview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailreturedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailreturadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailreturlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailreturview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailreturview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailreturadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailreturadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("detailreturedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("detailreturadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("detailreturdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "returbarang" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id_retur=" . urlencode($this->id_retur->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_detailretur:" . JsonEncode($this->id_detailretur->CurrentValue, "number");
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
		if ($this->id_detailretur->CurrentValue != NULL) {
			$url .= "id_detailretur=" . urlencode($this->id_detailretur->CurrentValue);
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
			if (Param("id_detailretur") !== NULL)
				$arKeys[] = Param("id_detailretur");
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
				$this->id_detailretur->CurrentValue = $key;
			else
				$this->id_detailretur->OldValue = $key;
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
		$this->id_detailretur->setDbValue($rs->fields('id_detailretur'));
		$this->id_retur->setDbValue($rs->fields('id_retur'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
		$this->id_satuan->setDbValue($rs->fields('id_satuan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_detailretur
		// id_retur
		// id_barang
		// jumlah
		// id_satuan
		// id_detailretur

		$this->id_detailretur->ViewValue = $this->id_detailretur->CurrentValue;
		$this->id_detailretur->ViewCustomAttributes = "";

		// id_retur
		$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
		$this->id_retur->ViewValue = FormatNumber($this->id_retur->ViewValue, 0, -2, -2, -2);
		$this->id_retur->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$this->id_barang->ViewValue = FormatNumber($this->id_barang->ViewValue, 0, -2, -2, -2);
		$this->id_barang->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 2, -2, -2, -2);
		$this->jumlah->ViewCustomAttributes = "";

		// id_satuan
		$curVal = strval($this->id_satuan->CurrentValue);
		if ($curVal != "") {
			$this->id_satuan->ViewValue = $this->id_satuan->lookupCacheOption($curVal);
			if ($this->id_satuan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_satuan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_satuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_satuan->ViewValue = $this->id_satuan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_satuan->ViewValue = $this->id_satuan->CurrentValue;
				}
			}
		} else {
			$this->id_satuan->ViewValue = NULL;
		}
		$this->id_satuan->ViewCustomAttributes = "";

		// id_detailretur
		$this->id_detailretur->LinkCustomAttributes = "";
		$this->id_detailretur->HrefValue = "";
		$this->id_detailretur->TooltipValue = "";

		// id_retur
		$this->id_retur->LinkCustomAttributes = "";
		$this->id_retur->HrefValue = "";
		$this->id_retur->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// jumlah
		$this->jumlah->LinkCustomAttributes = "";
		$this->jumlah->HrefValue = "";
		$this->jumlah->TooltipValue = "";

		// id_satuan
		$this->id_satuan->LinkCustomAttributes = "";
		$this->id_satuan->HrefValue = "";
		$this->id_satuan->TooltipValue = "";

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

		// id_detailretur
		$this->id_detailretur->EditAttrs["class"] = "form-control";
		$this->id_detailretur->EditCustomAttributes = "";
		$this->id_detailretur->EditValue = $this->id_detailretur->CurrentValue;
		$this->id_detailretur->ViewCustomAttributes = "";

		// id_retur
		$this->id_retur->EditAttrs["class"] = "form-control";
		$this->id_retur->EditCustomAttributes = "";
		if ($this->id_retur->getSessionValue() != "") {
			$this->id_retur->CurrentValue = $this->id_retur->getSessionValue();
			$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
			$this->id_retur->ViewValue = FormatNumber($this->id_retur->ViewValue, 0, -2, -2, -2);
			$this->id_retur->ViewCustomAttributes = "";
		} else {
			$this->id_retur->EditValue = $this->id_retur->CurrentValue;
			$this->id_retur->PlaceHolder = RemoveHtml($this->id_retur->caption());
		}

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// jumlah
		$this->jumlah->EditAttrs["class"] = "form-control";
		$this->jumlah->EditCustomAttributes = "";
		$this->jumlah->EditValue = $this->jumlah->CurrentValue;
		$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());
		if (strval($this->jumlah->EditValue) != "" && is_numeric($this->jumlah->EditValue))
			$this->jumlah->EditValue = FormatNumber($this->jumlah->EditValue, -2, -2, -2, -2);
		

		// id_satuan
		$this->id_satuan->EditAttrs["class"] = "form-control";
		$this->id_satuan->EditCustomAttributes = "";

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
					$doc->exportCaption($this->id_detailretur);
					$doc->exportCaption($this->id_retur);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->id_satuan);
				} else {
					$doc->exportCaption($this->id_detailretur);
					$doc->exportCaption($this->id_retur);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->id_satuan);
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
						$doc->exportField($this->id_detailretur);
						$doc->exportField($this->id_retur);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->id_satuan);
					} else {
						$doc->exportField($this->id_detailretur);
						$doc->exportField($this->id_retur);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->id_satuan);
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

		/*
		// update stok
		$pid_retur = $rsnew['id_retur'];
		$qty = $rsnew['jumlah'];
		$id_barang = $rsnew['id_barang'];
		$tanggal = date("Y-m-d H:i:s");
		$id_klinik = ExecuteScalar("SELECT id_klinik FROM returbarang WHERE id_retur=$pid_retur");
		//$komposisi = ExecuteScalar("SELECT komposisi FROM m_barang WHERE id=$id_barang");
		//$id_komposisi = ExecuteScalar("SELECT id_komposisi FROM komposisi WHERE id_barang=$id_barang");
		//$detail_komposisi = ExecuteScalar("SELECT id_barang FROM detailkomposisi WHERE id_komposisi = $id_komposisi");
		$stok = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_klinik=$id_klinik AND id_barang=$id_barang");
		$stok_terbaru = $stok - $qty;
		//var_dump($stok_terbaru);
		//exit();
			$sql = Execute("SELECT * FROM detailretur WHERE id_retur = $pid_retur"); //query
			if ($stok_terbaru <= 0) {
				if($sql->RecordCount() > 0) {
					$sql->MoveFirst();
					while(!$sql->EOF) {
						//logic
						$id_barang_komposisi = $sql->fields['id_barang'];
						$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = $id_barang_komposisi AND id_klinik = $id_klinik");
						$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_retur, retur, stok_akhir) VALUES ($id_barang, $id_klinik, DATE(NOW()), $stok, $pid_retur, $qty, 0)");
						$sql->MoveNext();
					}
					$sql->Close();
				}
			} else {
				if($sql->RecordCount() > 0) {
					$sql->MoveFirst();
					while(!$sql->EOF) {
						//logic
						$id_barang_komposisi = $sql->fields['id_barang'];
						$update_stok = Execute("UPDATE m_hargajual SET stok=$stok_terbaru WHERE id_barang = $id_barang_komposisi AND id_klinik = $id_klinik");
						$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_retur, retur, stok_akhir) VALUES ($id_barang, $id_klinik, DATE(NOW()), $stok, $pid_retur, $qty, $stok_terbaru)");
						$sql->MoveNext();
					}
					$sql->Close();
				}
			}
			*/
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