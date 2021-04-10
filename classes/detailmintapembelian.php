<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for detailmintapembelian
 */
class detailmintapembelian extends DbTable
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
	public $id_detailpp;
	public $pid_pp;
	public $idbarang;
	public $part;
	public $lot;
	public $qty_pp;
	public $qty_acc;
	public $id_satuan;
	public $harga;
	public $total;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailmintapembelian';
		$this->TableName = 'detailmintapembelian';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailmintapembelian`";
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

		// id_detailpp
		$this->id_detailpp = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_id_detailpp', 'id_detailpp', '`id_detailpp`', '`id_detailpp`', 3, 11, -1, FALSE, '`id_detailpp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_detailpp->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_detailpp->IsPrimaryKey = TRUE; // Primary key field
		$this->id_detailpp->Sortable = TRUE; // Allow sort
		$this->id_detailpp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_detailpp'] = &$this->id_detailpp;

		// pid_pp
		$this->pid_pp = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_pid_pp', 'pid_pp', '`pid_pp`', '`pid_pp`', 3, 11, -1, FALSE, '`pid_pp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid_pp->IsForeignKey = TRUE; // Foreign key field
		$this->pid_pp->Sortable = TRUE; // Allow sort
		$this->pid_pp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid_pp'] = &$this->pid_pp;

		// idbarang
		$this->idbarang = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_idbarang', 'idbarang', '`idbarang`', '`idbarang`', 3, 11, -1, FALSE, '`idbarang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->idbarang->Sortable = TRUE; // Allow sort
		$this->idbarang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->idbarang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->idbarang->Lookup = new Lookup('idbarang', 'm_barang', FALSE, 'id', ["nama_barang","","",""], [], [], [], [], ["satuan"], ["x_id_satuan"], '', '');
		$this->idbarang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idbarang'] = &$this->idbarang;

		// part
		$this->part = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_part', 'part', '`part`', '`part`', 200, 100, -1, FALSE, '`part`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->part->Sortable = TRUE; // Allow sort
		$this->fields['part'] = &$this->part;

		// lot
		$this->lot = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_lot', 'lot', '`lot`', '`lot`', 200, 100, -1, FALSE, '`lot`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lot->Sortable = TRUE; // Allow sort
		$this->fields['lot'] = &$this->lot;

		// qty_pp
		$this->qty_pp = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_qty_pp', 'qty_pp', '`qty_pp`', '`qty_pp`', 3, 11, -1, FALSE, '`qty_pp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty_pp->Sortable = TRUE; // Allow sort
		$this->qty_pp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['qty_pp'] = &$this->qty_pp;

		// qty_acc
		$this->qty_acc = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_qty_acc', 'qty_acc', '`qty_acc`', '`qty_acc`', 3, 11, -1, FALSE, '`qty_acc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty_acc->Sortable = TRUE; // Allow sort
		$this->qty_acc->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['qty_acc'] = &$this->qty_acc;

		// id_satuan
		$this->id_satuan = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_id_satuan', 'id_satuan', '`id_satuan`', '`id_satuan`', 3, 11, -1, FALSE, '`id_satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_satuan->Sortable = TRUE; // Allow sort
		$this->id_satuan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_satuan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_satuan->Lookup = new Lookup('id_satuan', 'm_satuan_barang', FALSE, 'id_satuan', ["nama_satuan","","",""], [], [], [], [], [], [], '', '');
		$this->id_satuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_satuan'] = &$this->id_satuan;

		// harga
		$this->harga = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_harga', 'harga', '`harga`', '`harga`', 5, 22, -1, FALSE, '`harga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->harga->Sortable = TRUE; // Allow sort
		$this->harga->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['harga'] = &$this->harga;

		// total
		$this->total = new DbField('detailmintapembelian', 'detailmintapembelian', 'x_total', 'total', '`total`', '`total`', 5, 22, -1, FALSE, '`total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total->Sortable = TRUE; // Allow sort
		$this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total'] = &$this->total;
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
		if ($this->getCurrentMasterTable() == "permintaanpembelian") {
			if ($this->pid_pp->getSessionValue() != "")
				$masterFilter .= "`id_pp`=" . QuotedValue($this->pid_pp->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "permintaanpembelian") {
			if ($this->pid_pp->getSessionValue() != "")
				$detailFilter .= "`pid_pp`=" . QuotedValue($this->pid_pp->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_permintaanpembelian()
	{
		return "`id_pp`=@id_pp@";
	}

	// Detail filter
	public function sqlDetailFilter_permintaanpembelian()
	{
		return "`pid_pp`=@pid_pp@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailmintapembelian`";
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
			$this->id_detailpp->setDbValue($conn->insert_ID());
			$rs['id_detailpp'] = $this->id_detailpp->DbValue;
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
			if (array_key_exists('id_detailpp', $rs))
				AddFilter($where, QuotedName('id_detailpp', $this->Dbid) . '=' . QuotedValue($rs['id_detailpp'], $this->id_detailpp->DataType, $this->Dbid));
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
		$this->id_detailpp->DbValue = $row['id_detailpp'];
		$this->pid_pp->DbValue = $row['pid_pp'];
		$this->idbarang->DbValue = $row['idbarang'];
		$this->part->DbValue = $row['part'];
		$this->lot->DbValue = $row['lot'];
		$this->qty_pp->DbValue = $row['qty_pp'];
		$this->qty_acc->DbValue = $row['qty_acc'];
		$this->id_satuan->DbValue = $row['id_satuan'];
		$this->harga->DbValue = $row['harga'];
		$this->total->DbValue = $row['total'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_detailpp` = @id_detailpp@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_detailpp', $row) ? $row['id_detailpp'] : NULL;
		else
			$val = $this->id_detailpp->OldValue !== NULL ? $this->id_detailpp->OldValue : $this->id_detailpp->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_detailpp@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "detailmintapembelianlist.php";
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
		if ($pageName == "detailmintapembelianview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailmintapembelianedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailmintapembelianadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailmintapembelianlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailmintapembelianview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailmintapembelianview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailmintapembelianadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailmintapembelianadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("detailmintapembelianedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("detailmintapembelianadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("detailmintapembeliandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "permintaanpembelian" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id_pp=" . urlencode($this->pid_pp->CurrentValue);
		}
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_detailpp:" . JsonEncode($this->id_detailpp->CurrentValue, "number");
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
		if ($this->id_detailpp->CurrentValue != NULL) {
			$url .= "id_detailpp=" . urlencode($this->id_detailpp->CurrentValue);
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
			if (Param("id_detailpp") !== NULL)
				$arKeys[] = Param("id_detailpp");
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
				$this->id_detailpp->CurrentValue = $key;
			else
				$this->id_detailpp->OldValue = $key;
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
		$this->id_detailpp->setDbValue($rs->fields('id_detailpp'));
		$this->pid_pp->setDbValue($rs->fields('pid_pp'));
		$this->idbarang->setDbValue($rs->fields('idbarang'));
		$this->part->setDbValue($rs->fields('part'));
		$this->lot->setDbValue($rs->fields('lot'));
		$this->qty_pp->setDbValue($rs->fields('qty_pp'));
		$this->qty_acc->setDbValue($rs->fields('qty_acc'));
		$this->id_satuan->setDbValue($rs->fields('id_satuan'));
		$this->harga->setDbValue($rs->fields('harga'));
		$this->total->setDbValue($rs->fields('total'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_detailpp
		// pid_pp
		// idbarang
		// part
		// lot
		// qty_pp
		// qty_acc
		// id_satuan
		// harga
		// total
		// id_detailpp

		$this->id_detailpp->ViewValue = $this->id_detailpp->CurrentValue;
		$this->id_detailpp->ViewCustomAttributes = "";

		// pid_pp
		$this->pid_pp->ViewValue = $this->pid_pp->CurrentValue;
		$this->pid_pp->ViewValue = FormatNumber($this->pid_pp->ViewValue, 0, -2, -2, -2);
		$this->pid_pp->ViewCustomAttributes = "";

		// idbarang
		$curVal = strval($this->idbarang->CurrentValue);
		if ($curVal != "") {
			$this->idbarang->ViewValue = $this->idbarang->lookupCacheOption($curVal);
			if ($this->idbarang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->idbarang->ViewValue = $this->idbarang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idbarang->ViewValue = $this->idbarang->CurrentValue;
				}
			}
		} else {
			$this->idbarang->ViewValue = NULL;
		}
		$this->idbarang->ViewCustomAttributes = "";

		// part
		$this->part->ViewValue = $this->part->CurrentValue;
		$this->part->ViewCustomAttributes = "";

		// lot
		$this->lot->ViewValue = $this->lot->CurrentValue;
		$this->lot->ViewCustomAttributes = "";

		// qty_pp
		$this->qty_pp->ViewValue = $this->qty_pp->CurrentValue;
		$this->qty_pp->ViewValue = FormatNumber($this->qty_pp->ViewValue, 0, -2, -2, -2);
		$this->qty_pp->ViewCustomAttributes = "";

		// qty_acc
		$this->qty_acc->ViewValue = $this->qty_acc->CurrentValue;
		$this->qty_acc->ViewValue = FormatNumber($this->qty_acc->ViewValue, 0, -2, -2, -2);
		$this->qty_acc->ViewCustomAttributes = "";

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

		// harga
		$this->harga->ViewValue = $this->harga->CurrentValue;
		$this->harga->ViewValue = FormatNumber($this->harga->ViewValue, 2, -2, -2, -2);
		$this->harga->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewValue = FormatNumber($this->total->ViewValue, 2, -2, -2, -2);
		$this->total->ViewCustomAttributes = "";

		// id_detailpp
		$this->id_detailpp->LinkCustomAttributes = "";
		$this->id_detailpp->HrefValue = "";
		$this->id_detailpp->TooltipValue = "";

		// pid_pp
		$this->pid_pp->LinkCustomAttributes = "";
		$this->pid_pp->HrefValue = "";
		$this->pid_pp->TooltipValue = "";

		// idbarang
		$this->idbarang->LinkCustomAttributes = "";
		$this->idbarang->HrefValue = "";
		$this->idbarang->TooltipValue = "";

		// part
		$this->part->LinkCustomAttributes = "";
		$this->part->HrefValue = "";
		$this->part->TooltipValue = "";

		// lot
		$this->lot->LinkCustomAttributes = "";
		$this->lot->HrefValue = "";
		$this->lot->TooltipValue = "";

		// qty_pp
		$this->qty_pp->LinkCustomAttributes = "";
		$this->qty_pp->HrefValue = "";
		$this->qty_pp->TooltipValue = "";

		// qty_acc
		$this->qty_acc->LinkCustomAttributes = "";
		$this->qty_acc->HrefValue = "";
		$this->qty_acc->TooltipValue = "";

		// id_satuan
		$this->id_satuan->LinkCustomAttributes = "";
		$this->id_satuan->HrefValue = "";
		$this->id_satuan->TooltipValue = "";

		// harga
		$this->harga->LinkCustomAttributes = "";
		$this->harga->HrefValue = "";
		$this->harga->TooltipValue = "";

		// total
		$this->total->LinkCustomAttributes = "";
		$this->total->HrefValue = "";
		$this->total->TooltipValue = "";

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

		// id_detailpp
		$this->id_detailpp->EditAttrs["class"] = "form-control";
		$this->id_detailpp->EditCustomAttributes = "";
		$this->id_detailpp->EditValue = $this->id_detailpp->CurrentValue;
		$this->id_detailpp->ViewCustomAttributes = "";

		// pid_pp
		$this->pid_pp->EditAttrs["class"] = "form-control";
		$this->pid_pp->EditCustomAttributes = "";
		if ($this->pid_pp->getSessionValue() != "") {
			$this->pid_pp->CurrentValue = $this->pid_pp->getSessionValue();
			$this->pid_pp->ViewValue = $this->pid_pp->CurrentValue;
			$this->pid_pp->ViewValue = FormatNumber($this->pid_pp->ViewValue, 0, -2, -2, -2);
			$this->pid_pp->ViewCustomAttributes = "";
		} else {
			$this->pid_pp->EditValue = $this->pid_pp->CurrentValue;
			$this->pid_pp->PlaceHolder = RemoveHtml($this->pid_pp->caption());
		}

		// idbarang
		$this->idbarang->EditAttrs["class"] = "form-control";
		$this->idbarang->EditCustomAttributes = "";

		// part
		$this->part->EditAttrs["class"] = "form-control";
		$this->part->EditCustomAttributes = "";
		if (!$this->part->Raw)
			$this->part->CurrentValue = HtmlDecode($this->part->CurrentValue);
		$this->part->EditValue = $this->part->CurrentValue;
		$this->part->PlaceHolder = RemoveHtml($this->part->caption());

		// lot
		$this->lot->EditAttrs["class"] = "form-control";
		$this->lot->EditCustomAttributes = "";
		if (!$this->lot->Raw)
			$this->lot->CurrentValue = HtmlDecode($this->lot->CurrentValue);
		$this->lot->EditValue = $this->lot->CurrentValue;
		$this->lot->PlaceHolder = RemoveHtml($this->lot->caption());

		// qty_pp
		$this->qty_pp->EditAttrs["class"] = "form-control";
		$this->qty_pp->EditCustomAttributes = "";
		$this->qty_pp->EditValue = $this->qty_pp->CurrentValue;
		$this->qty_pp->PlaceHolder = RemoveHtml($this->qty_pp->caption());

		// qty_acc
		$this->qty_acc->EditAttrs["class"] = "form-control";
		$this->qty_acc->EditCustomAttributes = "";
		$this->qty_acc->EditValue = $this->qty_acc->CurrentValue;
		$this->qty_acc->PlaceHolder = RemoveHtml($this->qty_acc->caption());

		// id_satuan
		$this->id_satuan->EditAttrs["class"] = "form-control";
		$this->id_satuan->EditCustomAttributes = "";

		// harga
		$this->harga->EditAttrs["class"] = "form-control";
		$this->harga->EditCustomAttributes = "";
		$this->harga->EditValue = $this->harga->CurrentValue;
		$this->harga->PlaceHolder = RemoveHtml($this->harga->caption());
		if (strval($this->harga->EditValue) != "" && is_numeric($this->harga->EditValue))
			$this->harga->EditValue = FormatNumber($this->harga->EditValue, -2, -2, -2, -2);
		

		// total
		$this->total->EditAttrs["class"] = "form-control";
		$this->total->EditCustomAttributes = "";
		$this->total->EditValue = $this->total->CurrentValue;
		$this->total->PlaceHolder = RemoveHtml($this->total->caption());
		if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue))
			$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->id_detailpp);
					$doc->exportCaption($this->pid_pp);
					$doc->exportCaption($this->idbarang);
					$doc->exportCaption($this->part);
					$doc->exportCaption($this->lot);
					$doc->exportCaption($this->qty_pp);
					$doc->exportCaption($this->qty_acc);
					$doc->exportCaption($this->id_satuan);
					$doc->exportCaption($this->harga);
					$doc->exportCaption($this->total);
				} else {
					$doc->exportCaption($this->id_detailpp);
					$doc->exportCaption($this->pid_pp);
					$doc->exportCaption($this->idbarang);
					$doc->exportCaption($this->part);
					$doc->exportCaption($this->lot);
					$doc->exportCaption($this->qty_pp);
					$doc->exportCaption($this->qty_acc);
					$doc->exportCaption($this->id_satuan);
					$doc->exportCaption($this->harga);
					$doc->exportCaption($this->total);
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
						$doc->exportField($this->id_detailpp);
						$doc->exportField($this->pid_pp);
						$doc->exportField($this->idbarang);
						$doc->exportField($this->part);
						$doc->exportField($this->lot);
						$doc->exportField($this->qty_pp);
						$doc->exportField($this->qty_acc);
						$doc->exportField($this->id_satuan);
						$doc->exportField($this->harga);
						$doc->exportField($this->total);
					} else {
						$doc->exportField($this->id_detailpp);
						$doc->exportField($this->pid_pp);
						$doc->exportField($this->idbarang);
						$doc->exportField($this->part);
						$doc->exportField($this->lot);
						$doc->exportField($this->qty_pp);
						$doc->exportField($this->qty_acc);
						$doc->exportField($this->id_satuan);
						$doc->exportField($this->harga);
						$doc->exportField($this->total);
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
		$pid_detailpo=$rsnew['pid_pp'];
		$idbarang=$rsnew['idbarang'];
		$part=$rsnew['part'];
		$lot=$rsnew['lot'];
		$qty=$rsnew['qty_acc'];
		$harga=$rsnew['harga'];
		$satuan=$rsnew['id_satuan'];
		$total=$rsnew['total'];
		$sql="insert into detailpo(pid_detailpo,idbarang,part,lot,qty,harga,satuan,total) ";
		$sql=$sql."values($pid_detailpo,$idbarang,'$part','$lot',$qty,$harga,$satuan,$total)";
		Execute($sql);
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