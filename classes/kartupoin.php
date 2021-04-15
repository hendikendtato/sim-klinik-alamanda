<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for kartupoin
 */
class kartupoin extends DbTable
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
	public $id_kartupoin;
	public $id_pelanggan;
	public $id_klinik;
	public $kode_penjualan;
	public $id_penyesuaian_poin;
	public $tgl;
	public $masuk;
	public $masuk_penyesuaian;
	public $keluar;
	public $keluar_penyesuaian;
	public $saldo_poin;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'kartupoin';
		$this->TableName = 'kartupoin';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`kartupoin`";
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

		// id_kartupoin
		$this->id_kartupoin = new DbField('kartupoin', 'kartupoin', 'x_id_kartupoin', 'id_kartupoin', '`id_kartupoin`', '`id_kartupoin`', 3, 11, -1, FALSE, '`id_kartupoin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_kartupoin->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_kartupoin->IsPrimaryKey = TRUE; // Primary key field
		$this->id_kartupoin->Sortable = TRUE; // Allow sort
		$this->id_kartupoin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartupoin'] = &$this->id_kartupoin;

		// id_pelanggan
		$this->id_pelanggan = new DbField('kartupoin', 'kartupoin', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 11, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_pelanggan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_pelanggan->Lookup = new Lookup('id_pelanggan', 'm_pelanggan', FALSE, 'id_pelanggan', ["nama_pelanggan","","",""], [], [], [], [], [], [], '', '');
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// id_klinik
		$this->id_klinik = new DbField('kartupoin', 'kartupoin', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// kode_penjualan
		$this->kode_penjualan = new DbField('kartupoin', 'kartupoin', 'x_kode_penjualan', 'kode_penjualan', '`kode_penjualan`', '`kode_penjualan`', 200, 50, -1, FALSE, '`kode_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_penjualan->Sortable = TRUE; // Allow sort
		$this->fields['kode_penjualan'] = &$this->kode_penjualan;

		// id_penyesuaian_poin
		$this->id_penyesuaian_poin = new DbField('kartupoin', 'kartupoin', 'x_id_penyesuaian_poin', 'id_penyesuaian_poin', '`id_penyesuaian_poin`', '`id_penyesuaian_poin`', 3, 11, -1, FALSE, '`id_penyesuaian_poin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_penyesuaian_poin->Sortable = TRUE; // Allow sort
		$this->id_penyesuaian_poin->Lookup = new Lookup('id_penyesuaian_poin', 'penyesuaian_poin', FALSE, 'id_penyesuaian_poin', ["kode_penyesuaianpoin","","",""], [], [], [], [], [], [], '', '');
		$this->id_penyesuaian_poin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_penyesuaian_poin'] = &$this->id_penyesuaian_poin;

		// tgl
		$this->tgl = new DbField('kartupoin', 'kartupoin', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 135, 19, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// masuk
		$this->masuk = new DbField('kartupoin', 'kartupoin', 'x_masuk', 'masuk', '`masuk`', '`masuk`', 5, 22, -1, FALSE, '`masuk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masuk->Sortable = TRUE; // Allow sort
		$this->masuk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['masuk'] = &$this->masuk;

		// masuk_penyesuaian
		$this->masuk_penyesuaian = new DbField('kartupoin', 'kartupoin', 'x_masuk_penyesuaian', 'masuk_penyesuaian', '`masuk_penyesuaian`', '`masuk_penyesuaian`', 5, 22, -1, FALSE, '`masuk_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masuk_penyesuaian->Sortable = TRUE; // Allow sort
		$this->masuk_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['masuk_penyesuaian'] = &$this->masuk_penyesuaian;

		// keluar
		$this->keluar = new DbField('kartupoin', 'kartupoin', 'x_keluar', 'keluar', '`keluar`', '`keluar`', 5, 22, -1, FALSE, '`keluar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar->Sortable = TRUE; // Allow sort
		$this->keluar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keluar'] = &$this->keluar;

		// keluar_penyesuaian
		$this->keluar_penyesuaian = new DbField('kartupoin', 'kartupoin', 'x_keluar_penyesuaian', 'keluar_penyesuaian', '`keluar_penyesuaian`', '`keluar_penyesuaian`', 5, 22, -1, FALSE, '`keluar_penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keluar_penyesuaian->Sortable = TRUE; // Allow sort
		$this->keluar_penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['keluar_penyesuaian'] = &$this->keluar_penyesuaian;

		// saldo_poin
		$this->saldo_poin = new DbField('kartupoin', 'kartupoin', 'x_saldo_poin', 'saldo_poin', '`saldo_poin`', '`saldo_poin`', 5, 22, -1, FALSE, '`saldo_poin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->saldo_poin->Sortable = TRUE; // Allow sort
		$this->saldo_poin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['saldo_poin'] = &$this->saldo_poin;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`kartupoin`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`id_kartupoin` DESC";
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
			$this->id_kartupoin->setDbValue($conn->insert_ID());
			$rs['id_kartupoin'] = $this->id_kartupoin->DbValue;
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
			if (array_key_exists('id_kartupoin', $rs))
				AddFilter($where, QuotedName('id_kartupoin', $this->Dbid) . '=' . QuotedValue($rs['id_kartupoin'], $this->id_kartupoin->DataType, $this->Dbid));
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
		$this->id_kartupoin->DbValue = $row['id_kartupoin'];
		$this->id_pelanggan->DbValue = $row['id_pelanggan'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->kode_penjualan->DbValue = $row['kode_penjualan'];
		$this->id_penyesuaian_poin->DbValue = $row['id_penyesuaian_poin'];
		$this->tgl->DbValue = $row['tgl'];
		$this->masuk->DbValue = $row['masuk'];
		$this->masuk_penyesuaian->DbValue = $row['masuk_penyesuaian'];
		$this->keluar->DbValue = $row['keluar'];
		$this->keluar_penyesuaian->DbValue = $row['keluar_penyesuaian'];
		$this->saldo_poin->DbValue = $row['saldo_poin'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_kartupoin` = @id_kartupoin@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_kartupoin', $row) ? $row['id_kartupoin'] : NULL;
		else
			$val = $this->id_kartupoin->OldValue !== NULL ? $this->id_kartupoin->OldValue : $this->id_kartupoin->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_kartupoin@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "kartupoinlist.php";
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
		if ($pageName == "kartupoinview.php")
			return $Language->phrase("View");
		elseif ($pageName == "kartupoinedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "kartupoinadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "kartupoinlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("kartupoinview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("kartupoinview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "kartupoinadd.php?" . $this->getUrlParm($parm);
		else
			$url = "kartupoinadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("kartupoinedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("kartupoinadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("kartupoindelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_kartupoin:" . JsonEncode($this->id_kartupoin->CurrentValue, "number");
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
		if ($this->id_kartupoin->CurrentValue != NULL) {
			$url .= "id_kartupoin=" . urlencode($this->id_kartupoin->CurrentValue);
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
			if (Param("id_kartupoin") !== NULL)
				$arKeys[] = Param("id_kartupoin");
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
				$this->id_kartupoin->CurrentValue = $key;
			else
				$this->id_kartupoin->OldValue = $key;
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
		$this->id_kartupoin->setDbValue($rs->fields('id_kartupoin'));
		$this->id_pelanggan->setDbValue($rs->fields('id_pelanggan'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->kode_penjualan->setDbValue($rs->fields('kode_penjualan'));
		$this->id_penyesuaian_poin->setDbValue($rs->fields('id_penyesuaian_poin'));
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->masuk->setDbValue($rs->fields('masuk'));
		$this->masuk_penyesuaian->setDbValue($rs->fields('masuk_penyesuaian'));
		$this->keluar->setDbValue($rs->fields('keluar'));
		$this->keluar_penyesuaian->setDbValue($rs->fields('keluar_penyesuaian'));
		$this->saldo_poin->setDbValue($rs->fields('saldo_poin'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_kartupoin
		// id_pelanggan
		// id_klinik
		// kode_penjualan
		// id_penyesuaian_poin
		// tgl
		// masuk
		// masuk_penyesuaian
		// keluar
		// keluar_penyesuaian
		// saldo_poin
		// id_kartupoin

		$this->id_kartupoin->ViewValue = $this->id_kartupoin->CurrentValue;
		$this->id_kartupoin->ViewCustomAttributes = "";

		// id_pelanggan
		$curVal = strval($this->id_pelanggan->CurrentValue);
		if ($curVal != "") {
			$this->id_pelanggan->ViewValue = $this->id_pelanggan->lookupCacheOption($curVal);
			if ($this->id_pelanggan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pelanggan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_pelanggan->ViewValue = $this->id_pelanggan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
				}
			}
		} else {
			$this->id_pelanggan->ViewValue = NULL;
		}
		$this->id_pelanggan->ViewCustomAttributes = "";

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

		// kode_penjualan
		$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->ViewCustomAttributes = "";

		// id_penyesuaian_poin
		$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->CurrentValue;
		$curVal = strval($this->id_penyesuaian_poin->CurrentValue);
		if ($curVal != "") {
			$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->lookupCacheOption($curVal);
			if ($this->id_penyesuaian_poin->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_penyesuaian_poin`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_penyesuaian_poin->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->CurrentValue;
				}
			}
		} else {
			$this->id_penyesuaian_poin->ViewValue = NULL;
		}
		$this->id_penyesuaian_poin->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// masuk
		$this->masuk->ViewValue = $this->masuk->CurrentValue;
		$this->masuk->ViewValue = FormatNumber($this->masuk->ViewValue, 2, -2, -2, -2);
		$this->masuk->ViewCustomAttributes = "";

		// masuk_penyesuaian
		$this->masuk_penyesuaian->ViewValue = $this->masuk_penyesuaian->CurrentValue;
		$this->masuk_penyesuaian->ViewValue = FormatNumber($this->masuk_penyesuaian->ViewValue, 2, -2, -2, -2);
		$this->masuk_penyesuaian->ViewCustomAttributes = "";

		// keluar
		$this->keluar->ViewValue = $this->keluar->CurrentValue;
		$this->keluar->ViewValue = FormatNumber($this->keluar->ViewValue, 2, -2, -2, -2);
		$this->keluar->ViewCustomAttributes = "";

		// keluar_penyesuaian
		$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
		$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
		$this->keluar_penyesuaian->ViewCustomAttributes = "";

		// saldo_poin
		$this->saldo_poin->ViewValue = $this->saldo_poin->CurrentValue;
		$this->saldo_poin->ViewValue = FormatNumber($this->saldo_poin->ViewValue, 2, -2, -2, -2);
		$this->saldo_poin->ViewCustomAttributes = "";

		// id_kartupoin
		$this->id_kartupoin->LinkCustomAttributes = "";
		$this->id_kartupoin->HrefValue = "";
		$this->id_kartupoin->TooltipValue = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// kode_penjualan
		$this->kode_penjualan->LinkCustomAttributes = "";
		$this->kode_penjualan->HrefValue = "";
		$this->kode_penjualan->TooltipValue = "";

		// id_penyesuaian_poin
		$this->id_penyesuaian_poin->LinkCustomAttributes = "";
		$this->id_penyesuaian_poin->HrefValue = "";
		$this->id_penyesuaian_poin->TooltipValue = "";

		// tgl
		$this->tgl->LinkCustomAttributes = "";
		$this->tgl->HrefValue = "";
		$this->tgl->TooltipValue = "";

		// masuk
		$this->masuk->LinkCustomAttributes = "";
		$this->masuk->HrefValue = "";
		$this->masuk->TooltipValue = "";

		// masuk_penyesuaian
		$this->masuk_penyesuaian->LinkCustomAttributes = "";
		$this->masuk_penyesuaian->HrefValue = "";
		$this->masuk_penyesuaian->TooltipValue = "";

		// keluar
		$this->keluar->LinkCustomAttributes = "";
		$this->keluar->HrefValue = "";
		$this->keluar->TooltipValue = "";

		// keluar_penyesuaian
		$this->keluar_penyesuaian->LinkCustomAttributes = "";
		$this->keluar_penyesuaian->HrefValue = "";
		$this->keluar_penyesuaian->TooltipValue = "";

		// saldo_poin
		$this->saldo_poin->LinkCustomAttributes = "";
		$this->saldo_poin->HrefValue = "";
		$this->saldo_poin->TooltipValue = "";

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

		// id_kartupoin
		$this->id_kartupoin->EditAttrs["class"] = "form-control";
		$this->id_kartupoin->EditCustomAttributes = "";
		$this->id_kartupoin->EditValue = $this->id_kartupoin->CurrentValue;
		$this->id_kartupoin->ViewCustomAttributes = "";

		// id_pelanggan
		$this->id_pelanggan->EditAttrs["class"] = "form-control";
		$this->id_pelanggan->EditCustomAttributes = "";

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->EditAttrs["class"] = "form-control";
		$this->kode_penjualan->EditCustomAttributes = "";
		if (!$this->kode_penjualan->Raw)
			$this->kode_penjualan->CurrentValue = HtmlDecode($this->kode_penjualan->CurrentValue);
		$this->kode_penjualan->EditValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

		// id_penyesuaian_poin
		$this->id_penyesuaian_poin->EditAttrs["class"] = "form-control";
		$this->id_penyesuaian_poin->EditCustomAttributes = "";
		$this->id_penyesuaian_poin->EditValue = $this->id_penyesuaian_poin->CurrentValue;
		$this->id_penyesuaian_poin->PlaceHolder = RemoveHtml($this->id_penyesuaian_poin->caption());

		// tgl
		$this->tgl->EditAttrs["class"] = "form-control";
		$this->tgl->EditCustomAttributes = "";
		$this->tgl->EditValue = FormatDateTime($this->tgl->CurrentValue, 8);
		$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

		// masuk
		$this->masuk->EditAttrs["class"] = "form-control";
		$this->masuk->EditCustomAttributes = "";
		$this->masuk->EditValue = $this->masuk->CurrentValue;
		$this->masuk->PlaceHolder = RemoveHtml($this->masuk->caption());
		if (strval($this->masuk->EditValue) != "" && is_numeric($this->masuk->EditValue))
			$this->masuk->EditValue = FormatNumber($this->masuk->EditValue, -2, -2, -2, -2);
		

		// masuk_penyesuaian
		$this->masuk_penyesuaian->EditAttrs["class"] = "form-control";
		$this->masuk_penyesuaian->EditCustomAttributes = "";
		$this->masuk_penyesuaian->EditValue = $this->masuk_penyesuaian->CurrentValue;
		$this->masuk_penyesuaian->PlaceHolder = RemoveHtml($this->masuk_penyesuaian->caption());
		if (strval($this->masuk_penyesuaian->EditValue) != "" && is_numeric($this->masuk_penyesuaian->EditValue))
			$this->masuk_penyesuaian->EditValue = FormatNumber($this->masuk_penyesuaian->EditValue, -2, -2, -2, -2);
		

		// keluar
		$this->keluar->EditAttrs["class"] = "form-control";
		$this->keluar->EditCustomAttributes = "";
		$this->keluar->EditValue = $this->keluar->CurrentValue;
		$this->keluar->PlaceHolder = RemoveHtml($this->keluar->caption());
		if (strval($this->keluar->EditValue) != "" && is_numeric($this->keluar->EditValue))
			$this->keluar->EditValue = FormatNumber($this->keluar->EditValue, -2, -2, -2, -2);
		

		// keluar_penyesuaian
		$this->keluar_penyesuaian->EditAttrs["class"] = "form-control";
		$this->keluar_penyesuaian->EditCustomAttributes = "";
		$this->keluar_penyesuaian->EditValue = $this->keluar_penyesuaian->CurrentValue;
		$this->keluar_penyesuaian->PlaceHolder = RemoveHtml($this->keluar_penyesuaian->caption());
		if (strval($this->keluar_penyesuaian->EditValue) != "" && is_numeric($this->keluar_penyesuaian->EditValue))
			$this->keluar_penyesuaian->EditValue = FormatNumber($this->keluar_penyesuaian->EditValue, -2, -2, -2, -2);
		

		// saldo_poin
		$this->saldo_poin->EditAttrs["class"] = "form-control";
		$this->saldo_poin->EditCustomAttributes = "";
		$this->saldo_poin->EditValue = $this->saldo_poin->CurrentValue;
		$this->saldo_poin->PlaceHolder = RemoveHtml($this->saldo_poin->caption());
		if (strval($this->saldo_poin->EditValue) != "" && is_numeric($this->saldo_poin->EditValue))
			$this->saldo_poin->EditValue = FormatNumber($this->saldo_poin->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->id_penyesuaian_poin);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->masuk);
					$doc->exportCaption($this->masuk_penyesuaian);
					$doc->exportCaption($this->keluar);
					$doc->exportCaption($this->keluar_penyesuaian);
					$doc->exportCaption($this->saldo_poin);
				} else {
					$doc->exportCaption($this->id_kartupoin);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->id_penyesuaian_poin);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->masuk);
					$doc->exportCaption($this->masuk_penyesuaian);
					$doc->exportCaption($this->keluar);
					$doc->exportCaption($this->keluar_penyesuaian);
					$doc->exportCaption($this->saldo_poin);
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
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->id_penyesuaian_poin);
						$doc->exportField($this->tgl);
						$doc->exportField($this->masuk);
						$doc->exportField($this->masuk_penyesuaian);
						$doc->exportField($this->keluar);
						$doc->exportField($this->keluar_penyesuaian);
						$doc->exportField($this->saldo_poin);
					} else {
						$doc->exportField($this->id_kartupoin);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->id_penyesuaian_poin);
						$doc->exportField($this->tgl);
						$doc->exportField($this->masuk);
						$doc->exportField($this->masuk_penyesuaian);
						$doc->exportField($this->keluar);
						$doc->exportField($this->keluar_penyesuaian);
						$doc->exportField($this->saldo_poin);
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