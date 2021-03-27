<?php namespace PHPMaker2020\klinik_latest_26_03_21; ?>
<?php

/**
 * Table class for purchaseorder
 */
class purchaseorder extends DbTable
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
	public $id_po;
	public $no_po;
	public $tgl_po;
	public $idstaff_po;
	public $idklinik;
	public $id_supplier;
	public $status_po;
	public $keterangan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'purchaseorder';
		$this->TableName = 'purchaseorder';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`purchaseorder`";
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

		// id_po
		$this->id_po = new DbField('purchaseorder', 'purchaseorder', 'x_id_po', 'id_po', '`id_po`', '`id_po`', 19, 10, -1, FALSE, '`id_po`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_po->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_po->IsPrimaryKey = TRUE; // Primary key field
		$this->id_po->IsForeignKey = TRUE; // Foreign key field
		$this->id_po->Sortable = TRUE; // Allow sort
		$this->id_po->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_po'] = &$this->id_po;

		// no_po
		$this->no_po = new DbField('purchaseorder', 'purchaseorder', 'x_no_po', 'no_po', '`no_po`', '`no_po`', 200, 50, -1, FALSE, '`no_po`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->no_po->Sortable = TRUE; // Allow sort
		$this->fields['no_po'] = &$this->no_po;

		// tgl_po
		$this->tgl_po = new DbField('purchaseorder', 'purchaseorder', 'x_tgl_po', 'tgl_po', '`tgl_po`', CastDateFieldForLike("`tgl_po`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_po`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_po->Sortable = TRUE; // Allow sort
		$this->tgl_po->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_po'] = &$this->tgl_po;

		// idstaff_po
		$this->idstaff_po = new DbField('purchaseorder', 'purchaseorder', 'x_idstaff_po', 'idstaff_po', '`idstaff_po`', '`idstaff_po`', 19, 11, -1, FALSE, '`idstaff_po`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->idstaff_po->Sortable = TRUE; // Allow sort
		$this->idstaff_po->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->idstaff_po->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->idstaff_po->Lookup = new Lookup('idstaff_po', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","","",""], [], [], [], [], [], [], '', '');
		$this->idstaff_po->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idstaff_po'] = &$this->idstaff_po;

		// idklinik
		$this->idklinik = new DbField('purchaseorder', 'purchaseorder', 'x_idklinik', 'idklinik', '`idklinik`', '`idklinik`', 3, 11, -1, FALSE, '`idklinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->idklinik->Sortable = TRUE; // Allow sort
		$this->idklinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->idklinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->idklinik->Lookup = new Lookup('idklinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->idklinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idklinik'] = &$this->idklinik;

		// id_supplier
		$this->id_supplier = new DbField('purchaseorder', 'purchaseorder', 'x_id_supplier', 'id_supplier', '`id_supplier`', '`id_supplier`', 3, 11, -1, FALSE, '`id_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_supplier->Sortable = TRUE; // Allow sort
		$this->id_supplier->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_supplier->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_supplier->Lookup = new Lookup('id_supplier', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_supplier->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_supplier'] = &$this->id_supplier;

		// status_po
		$this->status_po = new DbField('purchaseorder', 'purchaseorder', 'x_status_po', 'status_po', '`status_po`', '`status_po`', 202, 5, -1, FALSE, '`status_po`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status_po->Sortable = TRUE; // Allow sort
		$this->status_po->Lookup = new Lookup('status_po', 'purchaseorder', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status_po->OptionCount = 3;
		$this->fields['status_po'] = &$this->status_po;

		// keterangan
		$this->keterangan = new DbField('purchaseorder', 'purchaseorder', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
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

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
	}
	public function setCurrentDetailTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
	}

	// Get detail url
	public function getDetailUrl()
	{

		// Detail url
		$detailUrl = "";
		if ($this->getCurrentDetailTable() == "detailpo") {
			$detailUrl = $GLOBALS["detailpo"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id_po=" . urlencode($this->id_po->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "purchaseorderlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`purchaseorder`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`id_po` DESC";
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
			$this->id_po->setDbValue($conn->insert_ID());
			$rs['id_po'] = $this->id_po->DbValue;
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
			if (array_key_exists('id_po', $rs))
				AddFilter($where, QuotedName('id_po', $this->Dbid) . '=' . QuotedValue($rs['id_po'], $this->id_po->DataType, $this->Dbid));
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
		$this->id_po->DbValue = $row['id_po'];
		$this->no_po->DbValue = $row['no_po'];
		$this->tgl_po->DbValue = $row['tgl_po'];
		$this->idstaff_po->DbValue = $row['idstaff_po'];
		$this->idklinik->DbValue = $row['idklinik'];
		$this->id_supplier->DbValue = $row['id_supplier'];
		$this->status_po->DbValue = $row['status_po'];
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
		return "`id_po` = @id_po@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_po', $row) ? $row['id_po'] : NULL;
		else
			$val = $this->id_po->OldValue !== NULL ? $this->id_po->OldValue : $this->id_po->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_po@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "purchaseorderlist.php";
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
		if ($pageName == "purchaseorderview.php")
			return $Language->phrase("View");
		elseif ($pageName == "purchaseorderedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "purchaseorderadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "purchaseorderlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("purchaseorderview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("purchaseorderview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "purchaseorderadd.php?" . $this->getUrlParm($parm);
		else
			$url = "purchaseorderadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("purchaseorderedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("purchaseorderedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("purchaseorderadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("purchaseorderadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("purchaseorderdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_po:" . JsonEncode($this->id_po->CurrentValue, "number");
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
		if ($this->id_po->CurrentValue != NULL) {
			$url .= "id_po=" . urlencode($this->id_po->CurrentValue);
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
			if (Param("id_po") !== NULL)
				$arKeys[] = Param("id_po");
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
				$this->id_po->CurrentValue = $key;
			else
				$this->id_po->OldValue = $key;
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
		$this->id_po->setDbValue($rs->fields('id_po'));
		$this->no_po->setDbValue($rs->fields('no_po'));
		$this->tgl_po->setDbValue($rs->fields('tgl_po'));
		$this->idstaff_po->setDbValue($rs->fields('idstaff_po'));
		$this->idklinik->setDbValue($rs->fields('idklinik'));
		$this->id_supplier->setDbValue($rs->fields('id_supplier'));
		$this->status_po->setDbValue($rs->fields('status_po'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_po
		// no_po
		// tgl_po
		// idstaff_po
		// idklinik
		// id_supplier
		// status_po
		// keterangan
		// id_po

		$this->id_po->ViewValue = $this->id_po->CurrentValue;
		$this->id_po->ViewCustomAttributes = "";

		// no_po
		$this->no_po->ViewValue = $this->no_po->CurrentValue;
		$this->no_po->ViewCustomAttributes = "";

		// tgl_po
		$this->tgl_po->ViewValue = $this->tgl_po->CurrentValue;
		$this->tgl_po->ViewValue = FormatDateTime($this->tgl_po->ViewValue, 0);
		$this->tgl_po->ViewCustomAttributes = "";

		// idstaff_po
		$curVal = strval($this->idstaff_po->CurrentValue);
		if ($curVal != "") {
			$this->idstaff_po->ViewValue = $this->idstaff_po->lookupCacheOption($curVal);
			if ($this->idstaff_po->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idstaff_po->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->idstaff_po->ViewValue = $this->idstaff_po->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idstaff_po->ViewValue = $this->idstaff_po->CurrentValue;
				}
			}
		} else {
			$this->idstaff_po->ViewValue = NULL;
		}
		$this->idstaff_po->ViewCustomAttributes = "";

		// idklinik
		$curVal = strval($this->idklinik->CurrentValue);
		if ($curVal != "") {
			$this->idklinik->ViewValue = $this->idklinik->lookupCacheOption($curVal);
			if ($this->idklinik->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idklinik->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->idklinik->ViewValue = $this->idklinik->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idklinik->ViewValue = $this->idklinik->CurrentValue;
				}
			}
		} else {
			$this->idklinik->ViewValue = NULL;
		}
		$this->idklinik->ViewCustomAttributes = "";

		// id_supplier
		$curVal = strval($this->id_supplier->CurrentValue);
		if ($curVal != "") {
			$this->id_supplier->ViewValue = $this->id_supplier->lookupCacheOption($curVal);
			if ($this->id_supplier->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_supplier->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_supplier->ViewValue = $this->id_supplier->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_supplier->ViewValue = $this->id_supplier->CurrentValue;
				}
			}
		} else {
			$this->id_supplier->ViewValue = NULL;
		}
		$this->id_supplier->ViewCustomAttributes = "";

		// status_po
		if (strval($this->status_po->CurrentValue) != "") {
			$this->status_po->ViewValue = $this->status_po->optionCaption($this->status_po->CurrentValue);
		} else {
			$this->status_po->ViewValue = NULL;
		}
		$this->status_po->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// id_po
		$this->id_po->LinkCustomAttributes = "";
		$this->id_po->HrefValue = "";
		$this->id_po->TooltipValue = "";

		// no_po
		$this->no_po->LinkCustomAttributes = "";
		$this->no_po->HrefValue = "";
		$this->no_po->TooltipValue = "";

		// tgl_po
		$this->tgl_po->LinkCustomAttributes = "";
		$this->tgl_po->HrefValue = "";
		$this->tgl_po->TooltipValue = "";

		// idstaff_po
		$this->idstaff_po->LinkCustomAttributes = "";
		$this->idstaff_po->HrefValue = "";
		$this->idstaff_po->TooltipValue = "";

		// idklinik
		$this->idklinik->LinkCustomAttributes = "";
		$this->idklinik->HrefValue = "";
		$this->idklinik->TooltipValue = "";

		// id_supplier
		$this->id_supplier->LinkCustomAttributes = "";
		$this->id_supplier->HrefValue = "";
		$this->id_supplier->TooltipValue = "";

		// status_po
		$this->status_po->LinkCustomAttributes = "";
		$this->status_po->HrefValue = "";
		$this->status_po->TooltipValue = "";

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

		// id_po
		$this->id_po->EditAttrs["class"] = "form-control";
		$this->id_po->EditCustomAttributes = "";
		$this->id_po->EditValue = $this->id_po->CurrentValue;
		$this->id_po->ViewCustomAttributes = "";

		// no_po
		$this->no_po->EditAttrs["class"] = "form-control";
		$this->no_po->EditCustomAttributes = "";
		if (!$this->no_po->Raw)
			$this->no_po->CurrentValue = HtmlDecode($this->no_po->CurrentValue);
		$this->no_po->EditValue = $this->no_po->CurrentValue;
		$this->no_po->PlaceHolder = RemoveHtml($this->no_po->caption());

		// tgl_po
		$this->tgl_po->EditAttrs["class"] = "form-control";
		$this->tgl_po->EditCustomAttributes = "";
		$this->tgl_po->EditValue = FormatDateTime($this->tgl_po->CurrentValue, 8);
		$this->tgl_po->PlaceHolder = RemoveHtml($this->tgl_po->caption());

		// idstaff_po
		$this->idstaff_po->EditAttrs["class"] = "form-control";
		$this->idstaff_po->EditCustomAttributes = "";

		// idklinik
		$this->idklinik->EditAttrs["class"] = "form-control";
		$this->idklinik->EditCustomAttributes = "";

		// id_supplier
		$this->id_supplier->EditAttrs["class"] = "form-control";
		$this->id_supplier->EditCustomAttributes = "";

		// status_po
		$this->status_po->EditCustomAttributes = "";
		$this->status_po->EditValue = $this->status_po->options(FALSE);

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

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
					$doc->exportCaption($this->no_po);
					$doc->exportCaption($this->tgl_po);
					$doc->exportCaption($this->idstaff_po);
					$doc->exportCaption($this->idklinik);
					$doc->exportCaption($this->id_supplier);
					$doc->exportCaption($this->status_po);
					$doc->exportCaption($this->keterangan);
				} else {
					$doc->exportCaption($this->id_po);
					$doc->exportCaption($this->no_po);
					$doc->exportCaption($this->tgl_po);
					$doc->exportCaption($this->idstaff_po);
					$doc->exportCaption($this->idklinik);
					$doc->exportCaption($this->id_supplier);
					$doc->exportCaption($this->status_po);
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
						$doc->exportField($this->no_po);
						$doc->exportField($this->tgl_po);
						$doc->exportField($this->idstaff_po);
						$doc->exportField($this->idklinik);
						$doc->exportField($this->id_supplier);
						$doc->exportField($this->status_po);
						$doc->exportField($this->keterangan);
					} else {
						$doc->exportField($this->id_po);
						$doc->exportField($this->no_po);
						$doc->exportField($this->tgl_po);
						$doc->exportField($this->idstaff_po);
						$doc->exportField($this->idklinik);
						$doc->exportField($this->id_supplier);
						$doc->exportField($this->status_po);
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
		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE) {
			AddFilter($filter, "idklinik = '".$id_klinik."'");
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

		$idklinik = $rsnew['idklinik'];

		// Mendapatkan kode PO terakhir pada klinik $id_klinik, untuk diambil nomor urutnya
		$kode_po_sebelumnya = ExecuteScalar("SELECT no_po FROM purchaseorder WHERE idklinik=$idklinik ORDER BY id_po DESC");
		$kode = explode('-', $kode_po_sebelumnya);
		$nomor_urut_terakhir = $kode[2];
		$bulan_sebelumnya = substr($kode[1], -2);
		$nomor_urut = '0000';
		if ($bulan_sebelumnya == date('m')) {
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
		$rsnew['no_po'] = 'PO' . $idklinik . '-' . date('ym') . '-' . $nomor_urut;

		// add default status value
		$rsnew['status_po'] = 'open';
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

		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE){
			$this->idklinik->CurrentValue = $id_klinik ;
			$this->idklinik->ReadOnly = TRUE; 
		}
		$id_pegawai = CurrentUserInfo("id_pegawai");
		if($id_pegawai != '' OR $id_pegawai != FALSE){
			$this->idstaff_po->CurrentValue = $id_pegawai ;
			$this->idstaff_po->ReadOnly = TRUE; 
		}
		$default_support = ExecuteScalar("SELECT id_klinik FROM m_klinik WHERE nama_klinik LIKE '%Support%'");
		$this->id_supplier->CurrentValue = $default_support;
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>