<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for penggunaan_kartu
 */
class penggunaan_kartu extends DbTable
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
	public $kode_kartu;
	public $kode_penjualan;
	public $tgl;
	public $id_kartu;
	public $jenis_kartu;
	public $id_klinik;
	public $total;
	public $charge;
	public $total_charge;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'penggunaan_kartu';
		$this->TableName = 'penggunaan_kartu';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`penggunaan_kartu`";
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
		$this->id = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = FALSE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// kode_kartu
		$this->kode_kartu = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_kode_kartu', 'kode_kartu', '`kode_kartu`', '`kode_kartu`', 200, 50, -1, FALSE, '`kode_kartu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_kartu->Sortable = FALSE; // Allow sort
		$this->fields['kode_kartu'] = &$this->kode_kartu;

		// kode_penjualan
		$this->kode_penjualan = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_kode_penjualan', 'kode_penjualan', '`kode_penjualan`', '`kode_penjualan`', 200, 100, -1, FALSE, '`kode_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_penjualan->Sortable = TRUE; // Allow sort
		$this->kode_penjualan->Lookup = new Lookup('kode_penjualan', 'penjualan', FALSE, 'kode_penjualan', ["kode_penjualan","","",""], [], [], [], [], [], [], '', '');
		$this->fields['kode_penjualan'] = &$this->kode_penjualan;

		// tgl
		$this->tgl = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 135, 19, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// id_kartu
		$this->id_kartu = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_id_kartu', 'id_kartu', '`id_kartu`', '`id_kartu`', 3, 11, -1, FALSE, '`id_kartu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kartu->Sortable = TRUE; // Allow sort
		$this->id_kartu->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kartu->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kartu->Lookup = new Lookup('id_kartu', 'm_kartu', FALSE, 'id_kartu', ["nama_kartu","","",""], [], [], [], [], [], [], '', '');
		$this->id_kartu->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartu'] = &$this->id_kartu;

		// jenis_kartu
		$this->jenis_kartu = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_jenis_kartu', 'jenis_kartu', '`jenis_kartu`', '`jenis_kartu`', 200, 50, -1, FALSE, '`jenis_kartu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis_kartu->Sortable = FALSE; // Allow sort
		$this->fields['jenis_kartu'] = &$this->jenis_kartu;

		// id_klinik
		$this->id_klinik = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// total
		$this->total = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_total', 'total', '`total`', '`total`', 5, 22, -1, FALSE, '`total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total->Sortable = TRUE; // Allow sort
		$this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total'] = &$this->total;

		// charge
		$this->charge = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_charge', 'charge', '`charge`', '`charge`', 200, 50, -1, FALSE, '`charge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->charge->Sortable = TRUE; // Allow sort
		$this->fields['charge'] = &$this->charge;

		// total_charge
		$this->total_charge = new DbField('penggunaan_kartu', 'penggunaan_kartu', 'x_total_charge', 'total_charge', '`total_charge`', '`total_charge`', 5, 22, -1, FALSE, '`total_charge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_charge->Sortable = TRUE; // Allow sort
		$this->total_charge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_charge'] = &$this->total_charge;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`penggunaan_kartu`";
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
		$this->kode_kartu->DbValue = $row['kode_kartu'];
		$this->kode_penjualan->DbValue = $row['kode_penjualan'];
		$this->tgl->DbValue = $row['tgl'];
		$this->id_kartu->DbValue = $row['id_kartu'];
		$this->jenis_kartu->DbValue = $row['jenis_kartu'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->total->DbValue = $row['total'];
		$this->charge->DbValue = $row['charge'];
		$this->total_charge->DbValue = $row['total_charge'];
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
			return "penggunaan_kartulist.php";
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
		if ($pageName == "penggunaan_kartuview.php")
			return $Language->phrase("View");
		elseif ($pageName == "penggunaan_kartuedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "penggunaan_kartuadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "penggunaan_kartulist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("penggunaan_kartuview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("penggunaan_kartuview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "penggunaan_kartuadd.php?" . $this->getUrlParm($parm);
		else
			$url = "penggunaan_kartuadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("penggunaan_kartuedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("penggunaan_kartuadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("penggunaan_kartudelete.php", $this->getUrlParm());
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
		$this->kode_kartu->setDbValue($rs->fields('kode_kartu'));
		$this->kode_penjualan->setDbValue($rs->fields('kode_penjualan'));
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->id_kartu->setDbValue($rs->fields('id_kartu'));
		$this->jenis_kartu->setDbValue($rs->fields('jenis_kartu'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->total->setDbValue($rs->fields('total'));
		$this->charge->setDbValue($rs->fields('charge'));
		$this->total_charge->setDbValue($rs->fields('total_charge'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// kode_kartu

		$this->kode_kartu->CellCssStyle = "white-space: nowrap;";

		// kode_penjualan
		// tgl
		// id_kartu
		// jenis_kartu
		// id_klinik
		// total
		// charge
		// total_charge
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kode_kartu
		$this->kode_kartu->ViewValue = $this->kode_kartu->CurrentValue;
		$this->kode_kartu->ViewCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
		$curVal = strval($this->kode_penjualan->CurrentValue);
		if ($curVal != "") {
			$this->kode_penjualan->ViewValue = $this->kode_penjualan->lookupCacheOption($curVal);
			if ($this->kode_penjualan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`kode_penjualan`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->kode_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kode_penjualan->ViewValue = $this->kode_penjualan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
				}
			}
		} else {
			$this->kode_penjualan->ViewValue = NULL;
		}
		$this->kode_penjualan->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// id_kartu
		$curVal = strval($this->id_kartu->CurrentValue);
		if ($curVal != "") {
			$this->id_kartu->ViewValue = $this->id_kartu->lookupCacheOption($curVal);
			if ($this->id_kartu->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_kartu`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_kartu->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_kartu->ViewValue = $this->id_kartu->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_kartu->ViewValue = $this->id_kartu->CurrentValue;
				}
			}
		} else {
			$this->id_kartu->ViewValue = NULL;
		}
		$this->id_kartu->ViewCustomAttributes = "";

		// jenis_kartu
		$this->jenis_kartu->ViewValue = $this->jenis_kartu->CurrentValue;
		$this->jenis_kartu->ViewCustomAttributes = "";

		// id_klinik
		$curVal = strval($this->id_klinik->CurrentValue);
		if ($curVal != "") {
			$this->id_klinik->ViewValue = $this->id_klinik->lookupCacheOption($curVal);
			if ($this->id_klinik->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_klinik->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_klinik->ViewValue = $this->id_klinik->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_klinik->ViewValue = $this->id_klinik->CurrentValue;
				}
			}
		} else {
			$this->id_klinik->ViewValue = NULL;
		}
		$this->id_klinik->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewValue = FormatNumber($this->total->ViewValue, 2, -2, -2, -2);
		$this->total->ViewCustomAttributes = "";

		// charge
		$this->charge->ViewValue = $this->charge->CurrentValue;
		$this->charge->ViewCustomAttributes = "";

		// total_charge
		$this->total_charge->ViewValue = $this->total_charge->CurrentValue;
		$this->total_charge->ViewValue = FormatNumber($this->total_charge->ViewValue, 2, -2, -2, -2);
		$this->total_charge->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// kode_kartu
		$this->kode_kartu->LinkCustomAttributes = "";
		$this->kode_kartu->HrefValue = "";
		$this->kode_kartu->TooltipValue = "";

		// kode_penjualan
		$this->kode_penjualan->LinkCustomAttributes = "";
		$this->kode_penjualan->HrefValue = "";
		$this->kode_penjualan->TooltipValue = "";

		// tgl
		$this->tgl->LinkCustomAttributes = "";
		$this->tgl->HrefValue = "";
		$this->tgl->TooltipValue = "";

		// id_kartu
		$this->id_kartu->LinkCustomAttributes = "";
		$this->id_kartu->HrefValue = "";
		$this->id_kartu->TooltipValue = "";

		// jenis_kartu
		$this->jenis_kartu->LinkCustomAttributes = "";
		$this->jenis_kartu->HrefValue = "";
		$this->jenis_kartu->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// total
		$this->total->LinkCustomAttributes = "";
		$this->total->HrefValue = "";
		$this->total->TooltipValue = "";

		// charge
		$this->charge->LinkCustomAttributes = "";
		$this->charge->HrefValue = "";
		$this->charge->TooltipValue = "";

		// total_charge
		$this->total_charge->LinkCustomAttributes = "";
		$this->total_charge->HrefValue = "";
		$this->total_charge->TooltipValue = "";

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

		// kode_kartu
		$this->kode_kartu->EditAttrs["class"] = "form-control";
		$this->kode_kartu->EditCustomAttributes = "";
		if (!$this->kode_kartu->Raw)
			$this->kode_kartu->CurrentValue = HtmlDecode($this->kode_kartu->CurrentValue);
		$this->kode_kartu->EditValue = $this->kode_kartu->CurrentValue;
		$this->kode_kartu->PlaceHolder = RemoveHtml($this->kode_kartu->caption());

		// kode_penjualan
		$this->kode_penjualan->EditAttrs["class"] = "form-control";
		$this->kode_penjualan->EditCustomAttributes = "";
		if (!$this->kode_penjualan->Raw)
			$this->kode_penjualan->CurrentValue = HtmlDecode($this->kode_penjualan->CurrentValue);
		$this->kode_penjualan->EditValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

		// tgl
		$this->tgl->EditAttrs["class"] = "form-control";
		$this->tgl->EditCustomAttributes = "";
		$this->tgl->EditValue = FormatDateTime($this->tgl->CurrentValue, 8);
		$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

		// id_kartu
		$this->id_kartu->EditAttrs["class"] = "form-control";
		$this->id_kartu->EditCustomAttributes = "";

		// jenis_kartu
		$this->jenis_kartu->EditAttrs["class"] = "form-control";
		$this->jenis_kartu->EditCustomAttributes = "";
		if (!$this->jenis_kartu->Raw)
			$this->jenis_kartu->CurrentValue = HtmlDecode($this->jenis_kartu->CurrentValue);
		$this->jenis_kartu->EditValue = $this->jenis_kartu->CurrentValue;
		$this->jenis_kartu->PlaceHolder = RemoveHtml($this->jenis_kartu->caption());

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// total
		$this->total->EditAttrs["class"] = "form-control";
		$this->total->EditCustomAttributes = "";
		$this->total->EditValue = $this->total->CurrentValue;
		$this->total->PlaceHolder = RemoveHtml($this->total->caption());
		if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue))
			$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
		

		// charge
		$this->charge->EditAttrs["class"] = "form-control";
		$this->charge->EditCustomAttributes = "";
		if (!$this->charge->Raw)
			$this->charge->CurrentValue = HtmlDecode($this->charge->CurrentValue);
		$this->charge->EditValue = $this->charge->CurrentValue;
		$this->charge->PlaceHolder = RemoveHtml($this->charge->caption());

		// total_charge
		$this->total_charge->EditAttrs["class"] = "form-control";
		$this->total_charge->EditCustomAttributes = "";
		$this->total_charge->EditValue = $this->total_charge->CurrentValue;
		$this->total_charge->PlaceHolder = RemoveHtml($this->total_charge->caption());
		if (strval($this->total_charge->EditValue) != "" && is_numeric($this->total_charge->EditValue))
			$this->total_charge->EditValue = FormatNumber($this->total_charge->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->id_kartu);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->total);
					$doc->exportCaption($this->charge);
					$doc->exportCaption($this->total_charge);
				} else {
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->id_kartu);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->total);
					$doc->exportCaption($this->charge);
					$doc->exportCaption($this->total_charge);
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
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->tgl);
						$doc->exportField($this->id_kartu);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->total);
						$doc->exportField($this->charge);
						$doc->exportField($this->total_charge);
					} else {
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->tgl);
						$doc->exportField($this->id_kartu);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->total);
						$doc->exportField($this->charge);
						$doc->exportField($this->total_charge);
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
		AddFilter($filter, "jenis_kartu != 'Voucher'");
		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE) {
			AddFilter($filter, "id_klinik = '".$id_klinik."'");
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
			$this->id_klinik->CurrentValue = $id_klinik ;
			$this->id_klinik->ReadOnly = TRUE; 
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>