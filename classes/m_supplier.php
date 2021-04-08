<?php namespace PHPMaker2020\klinik_latest_08_04_21; ?>
<?php

/**
 * Table class for m_supplier
 */
class m_supplier extends DbTable
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
	public $id_supplier;
	public $kode_supplier;
	public $nama_supplier;
	public $pic_supplier;
	public $alamat_supplier;
	public $kelurahan_supplier;
	public $kecamatan_supplier;
	public $kota_supplier;
	public $kodepos_supplier;
	public $telpon_supplier;
	public $hp_supplier;
	public $email_supplier;
	public $kategori_supplier;
	public $npwp_supplier;
	public $rekening_supplier;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_supplier';
		$this->TableName = 'm_supplier';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_supplier`";
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

		// id_supplier
		$this->id_supplier = new DbField('m_supplier', 'm_supplier', 'x_id_supplier', 'id_supplier', '`id_supplier`', '`id_supplier`', 3, 11, -1, FALSE, '`id_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_supplier->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_supplier->IsPrimaryKey = TRUE; // Primary key field
		$this->id_supplier->Sortable = TRUE; // Allow sort
		$this->id_supplier->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_supplier'] = &$this->id_supplier;

		// kode_supplier
		$this->kode_supplier = new DbField('m_supplier', 'm_supplier', 'x_kode_supplier', 'kode_supplier', '`kode_supplier`', '`kode_supplier`', 200, 20, -1, FALSE, '`kode_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_supplier->Sortable = TRUE; // Allow sort
		$this->fields['kode_supplier'] = &$this->kode_supplier;

		// nama_supplier
		$this->nama_supplier = new DbField('m_supplier', 'm_supplier', 'x_nama_supplier', 'nama_supplier', '`nama_supplier`', '`nama_supplier`', 200, 255, -1, FALSE, '`nama_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_supplier->Sortable = TRUE; // Allow sort
		$this->fields['nama_supplier'] = &$this->nama_supplier;

		// pic_supplier
		$this->pic_supplier = new DbField('m_supplier', 'm_supplier', 'x_pic_supplier', 'pic_supplier', '`pic_supplier`', '`pic_supplier`', 200, 255, -1, FALSE, '`pic_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pic_supplier->Sortable = TRUE; // Allow sort
		$this->fields['pic_supplier'] = &$this->pic_supplier;

		// alamat_supplier
		$this->alamat_supplier = new DbField('m_supplier', 'm_supplier', 'x_alamat_supplier', 'alamat_supplier', '`alamat_supplier`', '`alamat_supplier`', 200, 255, -1, FALSE, '`alamat_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat_supplier->Sortable = TRUE; // Allow sort
		$this->fields['alamat_supplier'] = &$this->alamat_supplier;

		// kelurahan_supplier
		$this->kelurahan_supplier = new DbField('m_supplier', 'm_supplier', 'x_kelurahan_supplier', 'kelurahan_supplier', '`kelurahan_supplier`', '`kelurahan_supplier`', 200, 50, -1, FALSE, '`kelurahan_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kelurahan_supplier->Sortable = TRUE; // Allow sort
		$this->fields['kelurahan_supplier'] = &$this->kelurahan_supplier;

		// kecamatan_supplier
		$this->kecamatan_supplier = new DbField('m_supplier', 'm_supplier', 'x_kecamatan_supplier', 'kecamatan_supplier', '`kecamatan_supplier`', '`kecamatan_supplier`', 200, 50, -1, FALSE, '`kecamatan_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kecamatan_supplier->Sortable = TRUE; // Allow sort
		$this->fields['kecamatan_supplier'] = &$this->kecamatan_supplier;

		// kota_supplier
		$this->kota_supplier = new DbField('m_supplier', 'm_supplier', 'x_kota_supplier', 'kota_supplier', '`kota_supplier`', '`kota_supplier`', 200, 50, -1, FALSE, '`kota_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kota_supplier->Sortable = TRUE; // Allow sort
		$this->fields['kota_supplier'] = &$this->kota_supplier;

		// kodepos_supplier
		$this->kodepos_supplier = new DbField('m_supplier', 'm_supplier', 'x_kodepos_supplier', 'kodepos_supplier', '`kodepos_supplier`', '`kodepos_supplier`', 200, 255, -1, FALSE, '`kodepos_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kodepos_supplier->Sortable = TRUE; // Allow sort
		$this->fields['kodepos_supplier'] = &$this->kodepos_supplier;

		// telpon_supplier
		$this->telpon_supplier = new DbField('m_supplier', 'm_supplier', 'x_telpon_supplier', 'telpon_supplier', '`telpon_supplier`', '`telpon_supplier`', 200, 255, -1, FALSE, '`telpon_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telpon_supplier->Sortable = TRUE; // Allow sort
		$this->fields['telpon_supplier'] = &$this->telpon_supplier;

		// hp_supplier
		$this->hp_supplier = new DbField('m_supplier', 'm_supplier', 'x_hp_supplier', 'hp_supplier', '`hp_supplier`', '`hp_supplier`', 200, 255, -1, FALSE, '`hp_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp_supplier->Sortable = TRUE; // Allow sort
		$this->fields['hp_supplier'] = &$this->hp_supplier;

		// email_supplier
		$this->email_supplier = new DbField('m_supplier', 'm_supplier', 'x_email_supplier', 'email_supplier', '`email_supplier`', '`email_supplier`', 200, 255, -1, FALSE, '`email_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->email_supplier->Sortable = TRUE; // Allow sort
		$this->fields['email_supplier'] = &$this->email_supplier;

		// kategori_supplier
		$this->kategori_supplier = new DbField('m_supplier', 'm_supplier', 'x_kategori_supplier', 'kategori_supplier', '`kategori_supplier`', '`kategori_supplier`', 202, 9, -1, FALSE, '`kategori_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->kategori_supplier->Sortable = TRUE; // Allow sort
		$this->kategori_supplier->Lookup = new Lookup('kategori_supplier', 'm_supplier', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->kategori_supplier->OptionCount = 2;
		$this->fields['kategori_supplier'] = &$this->kategori_supplier;

		// npwp_supplier
		$this->npwp_supplier = new DbField('m_supplier', 'm_supplier', 'x_npwp_supplier', 'npwp_supplier', '`npwp_supplier`', '`npwp_supplier`', 200, 255, -1, FALSE, '`npwp_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->npwp_supplier->Sortable = TRUE; // Allow sort
		$this->fields['npwp_supplier'] = &$this->npwp_supplier;

		// rekening_supplier
		$this->rekening_supplier = new DbField('m_supplier', 'm_supplier', 'x_rekening_supplier', 'rekening_supplier', '`rekening_supplier`', '`rekening_supplier`', 200, 255, -1, FALSE, '`rekening_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rekening_supplier->Sortable = TRUE; // Allow sort
		$this->fields['rekening_supplier'] = &$this->rekening_supplier;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_supplier`";
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
			$this->id_supplier->setDbValue($conn->insert_ID());
			$rs['id_supplier'] = $this->id_supplier->DbValue;
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
			if (array_key_exists('id_supplier', $rs))
				AddFilter($where, QuotedName('id_supplier', $this->Dbid) . '=' . QuotedValue($rs['id_supplier'], $this->id_supplier->DataType, $this->Dbid));
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
		$this->id_supplier->DbValue = $row['id_supplier'];
		$this->kode_supplier->DbValue = $row['kode_supplier'];
		$this->nama_supplier->DbValue = $row['nama_supplier'];
		$this->pic_supplier->DbValue = $row['pic_supplier'];
		$this->alamat_supplier->DbValue = $row['alamat_supplier'];
		$this->kelurahan_supplier->DbValue = $row['kelurahan_supplier'];
		$this->kecamatan_supplier->DbValue = $row['kecamatan_supplier'];
		$this->kota_supplier->DbValue = $row['kota_supplier'];
		$this->kodepos_supplier->DbValue = $row['kodepos_supplier'];
		$this->telpon_supplier->DbValue = $row['telpon_supplier'];
		$this->hp_supplier->DbValue = $row['hp_supplier'];
		$this->email_supplier->DbValue = $row['email_supplier'];
		$this->kategori_supplier->DbValue = $row['kategori_supplier'];
		$this->npwp_supplier->DbValue = $row['npwp_supplier'];
		$this->rekening_supplier->DbValue = $row['rekening_supplier'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_supplier` = @id_supplier@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_supplier', $row) ? $row['id_supplier'] : NULL;
		else
			$val = $this->id_supplier->OldValue !== NULL ? $this->id_supplier->OldValue : $this->id_supplier->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_supplier@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "m_supplierlist.php";
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
		if ($pageName == "m_supplierview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_supplieredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_supplieradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_supplierlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_supplierview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_supplierview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_supplieradd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_supplieradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_supplieredit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_supplieradd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_supplierdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_supplier:" . JsonEncode($this->id_supplier->CurrentValue, "number");
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
		if ($this->id_supplier->CurrentValue != NULL) {
			$url .= "id_supplier=" . urlencode($this->id_supplier->CurrentValue);
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
			if (Param("id_supplier") !== NULL)
				$arKeys[] = Param("id_supplier");
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
				$this->id_supplier->CurrentValue = $key;
			else
				$this->id_supplier->OldValue = $key;
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
		$this->id_supplier->setDbValue($rs->fields('id_supplier'));
		$this->kode_supplier->setDbValue($rs->fields('kode_supplier'));
		$this->nama_supplier->setDbValue($rs->fields('nama_supplier'));
		$this->pic_supplier->setDbValue($rs->fields('pic_supplier'));
		$this->alamat_supplier->setDbValue($rs->fields('alamat_supplier'));
		$this->kelurahan_supplier->setDbValue($rs->fields('kelurahan_supplier'));
		$this->kecamatan_supplier->setDbValue($rs->fields('kecamatan_supplier'));
		$this->kota_supplier->setDbValue($rs->fields('kota_supplier'));
		$this->kodepos_supplier->setDbValue($rs->fields('kodepos_supplier'));
		$this->telpon_supplier->setDbValue($rs->fields('telpon_supplier'));
		$this->hp_supplier->setDbValue($rs->fields('hp_supplier'));
		$this->email_supplier->setDbValue($rs->fields('email_supplier'));
		$this->kategori_supplier->setDbValue($rs->fields('kategori_supplier'));
		$this->npwp_supplier->setDbValue($rs->fields('npwp_supplier'));
		$this->rekening_supplier->setDbValue($rs->fields('rekening_supplier'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_supplier
		// kode_supplier
		// nama_supplier
		// pic_supplier
		// alamat_supplier
		// kelurahan_supplier
		// kecamatan_supplier
		// kota_supplier
		// kodepos_supplier
		// telpon_supplier
		// hp_supplier
		// email_supplier
		// kategori_supplier
		// npwp_supplier
		// rekening_supplier
		// id_supplier

		$this->id_supplier->ViewValue = $this->id_supplier->CurrentValue;
		$this->id_supplier->ViewCustomAttributes = "";

		// kode_supplier
		$this->kode_supplier->ViewValue = $this->kode_supplier->CurrentValue;
		$this->kode_supplier->ViewCustomAttributes = "";

		// nama_supplier
		$this->nama_supplier->ViewValue = $this->nama_supplier->CurrentValue;
		$this->nama_supplier->ViewCustomAttributes = "";

		// pic_supplier
		$this->pic_supplier->ViewValue = $this->pic_supplier->CurrentValue;
		$this->pic_supplier->ViewCustomAttributes = "";

		// alamat_supplier
		$this->alamat_supplier->ViewValue = $this->alamat_supplier->CurrentValue;
		$this->alamat_supplier->ViewCustomAttributes = "";

		// kelurahan_supplier
		$this->kelurahan_supplier->ViewValue = $this->kelurahan_supplier->CurrentValue;
		$this->kelurahan_supplier->ViewCustomAttributes = "";

		// kecamatan_supplier
		$this->kecamatan_supplier->ViewValue = $this->kecamatan_supplier->CurrentValue;
		$this->kecamatan_supplier->ViewCustomAttributes = "";

		// kota_supplier
		$this->kota_supplier->ViewValue = $this->kota_supplier->CurrentValue;
		$this->kota_supplier->ViewCustomAttributes = "";

		// kodepos_supplier
		$this->kodepos_supplier->ViewValue = $this->kodepos_supplier->CurrentValue;
		$this->kodepos_supplier->ViewCustomAttributes = "";

		// telpon_supplier
		$this->telpon_supplier->ViewValue = $this->telpon_supplier->CurrentValue;
		$this->telpon_supplier->ViewCustomAttributes = "";

		// hp_supplier
		$this->hp_supplier->ViewValue = $this->hp_supplier->CurrentValue;
		$this->hp_supplier->ViewCustomAttributes = "";

		// email_supplier
		$this->email_supplier->ViewValue = $this->email_supplier->CurrentValue;
		$this->email_supplier->ViewCustomAttributes = "";

		// kategori_supplier
		if (strval($this->kategori_supplier->CurrentValue) != "") {
			$this->kategori_supplier->ViewValue = $this->kategori_supplier->optionCaption($this->kategori_supplier->CurrentValue);
		} else {
			$this->kategori_supplier->ViewValue = NULL;
		}
		$this->kategori_supplier->ViewCustomAttributes = "";

		// npwp_supplier
		$this->npwp_supplier->ViewValue = $this->npwp_supplier->CurrentValue;
		$this->npwp_supplier->ViewCustomAttributes = "";

		// rekening_supplier
		$this->rekening_supplier->ViewValue = $this->rekening_supplier->CurrentValue;
		$this->rekening_supplier->ViewCustomAttributes = "";

		// id_supplier
		$this->id_supplier->LinkCustomAttributes = "";
		$this->id_supplier->HrefValue = "";
		$this->id_supplier->TooltipValue = "";

		// kode_supplier
		$this->kode_supplier->LinkCustomAttributes = "";
		$this->kode_supplier->HrefValue = "";
		$this->kode_supplier->TooltipValue = "";

		// nama_supplier
		$this->nama_supplier->LinkCustomAttributes = "";
		$this->nama_supplier->HrefValue = "";
		$this->nama_supplier->TooltipValue = "";

		// pic_supplier
		$this->pic_supplier->LinkCustomAttributes = "";
		$this->pic_supplier->HrefValue = "";
		$this->pic_supplier->TooltipValue = "";

		// alamat_supplier
		$this->alamat_supplier->LinkCustomAttributes = "";
		$this->alamat_supplier->HrefValue = "";
		$this->alamat_supplier->TooltipValue = "";

		// kelurahan_supplier
		$this->kelurahan_supplier->LinkCustomAttributes = "";
		$this->kelurahan_supplier->HrefValue = "";
		$this->kelurahan_supplier->TooltipValue = "";

		// kecamatan_supplier
		$this->kecamatan_supplier->LinkCustomAttributes = "";
		$this->kecamatan_supplier->HrefValue = "";
		$this->kecamatan_supplier->TooltipValue = "";

		// kota_supplier
		$this->kota_supplier->LinkCustomAttributes = "";
		$this->kota_supplier->HrefValue = "";
		$this->kota_supplier->TooltipValue = "";

		// kodepos_supplier
		$this->kodepos_supplier->LinkCustomAttributes = "";
		$this->kodepos_supplier->HrefValue = "";
		$this->kodepos_supplier->TooltipValue = "";

		// telpon_supplier
		$this->telpon_supplier->LinkCustomAttributes = "";
		$this->telpon_supplier->HrefValue = "";
		$this->telpon_supplier->TooltipValue = "";

		// hp_supplier
		$this->hp_supplier->LinkCustomAttributes = "";
		$this->hp_supplier->HrefValue = "";
		$this->hp_supplier->TooltipValue = "";

		// email_supplier
		$this->email_supplier->LinkCustomAttributes = "";
		$this->email_supplier->HrefValue = "";
		$this->email_supplier->TooltipValue = "";

		// kategori_supplier
		$this->kategori_supplier->LinkCustomAttributes = "";
		$this->kategori_supplier->HrefValue = "";
		$this->kategori_supplier->TooltipValue = "";

		// npwp_supplier
		$this->npwp_supplier->LinkCustomAttributes = "";
		$this->npwp_supplier->HrefValue = "";
		$this->npwp_supplier->TooltipValue = "";

		// rekening_supplier
		$this->rekening_supplier->LinkCustomAttributes = "";
		$this->rekening_supplier->HrefValue = "";
		$this->rekening_supplier->TooltipValue = "";

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

		// id_supplier
		$this->id_supplier->EditAttrs["class"] = "form-control";
		$this->id_supplier->EditCustomAttributes = "";
		$this->id_supplier->EditValue = $this->id_supplier->CurrentValue;
		$this->id_supplier->ViewCustomAttributes = "";

		// kode_supplier
		$this->kode_supplier->EditAttrs["class"] = "form-control";
		$this->kode_supplier->EditCustomAttributes = "";
		if (!$this->kode_supplier->Raw)
			$this->kode_supplier->CurrentValue = HtmlDecode($this->kode_supplier->CurrentValue);
		$this->kode_supplier->EditValue = $this->kode_supplier->CurrentValue;
		$this->kode_supplier->PlaceHolder = RemoveHtml($this->kode_supplier->caption());

		// nama_supplier
		$this->nama_supplier->EditAttrs["class"] = "form-control";
		$this->nama_supplier->EditCustomAttributes = "";
		if (!$this->nama_supplier->Raw)
			$this->nama_supplier->CurrentValue = HtmlDecode($this->nama_supplier->CurrentValue);
		$this->nama_supplier->EditValue = $this->nama_supplier->CurrentValue;
		$this->nama_supplier->PlaceHolder = RemoveHtml($this->nama_supplier->caption());

		// pic_supplier
		$this->pic_supplier->EditAttrs["class"] = "form-control";
		$this->pic_supplier->EditCustomAttributes = "";
		if (!$this->pic_supplier->Raw)
			$this->pic_supplier->CurrentValue = HtmlDecode($this->pic_supplier->CurrentValue);
		$this->pic_supplier->EditValue = $this->pic_supplier->CurrentValue;
		$this->pic_supplier->PlaceHolder = RemoveHtml($this->pic_supplier->caption());

		// alamat_supplier
		$this->alamat_supplier->EditAttrs["class"] = "form-control";
		$this->alamat_supplier->EditCustomAttributes = "";
		if (!$this->alamat_supplier->Raw)
			$this->alamat_supplier->CurrentValue = HtmlDecode($this->alamat_supplier->CurrentValue);
		$this->alamat_supplier->EditValue = $this->alamat_supplier->CurrentValue;
		$this->alamat_supplier->PlaceHolder = RemoveHtml($this->alamat_supplier->caption());

		// kelurahan_supplier
		$this->kelurahan_supplier->EditAttrs["class"] = "form-control";
		$this->kelurahan_supplier->EditCustomAttributes = "";
		if (!$this->kelurahan_supplier->Raw)
			$this->kelurahan_supplier->CurrentValue = HtmlDecode($this->kelurahan_supplier->CurrentValue);
		$this->kelurahan_supplier->EditValue = $this->kelurahan_supplier->CurrentValue;
		$this->kelurahan_supplier->PlaceHolder = RemoveHtml($this->kelurahan_supplier->caption());

		// kecamatan_supplier
		$this->kecamatan_supplier->EditAttrs["class"] = "form-control";
		$this->kecamatan_supplier->EditCustomAttributes = "";
		if (!$this->kecamatan_supplier->Raw)
			$this->kecamatan_supplier->CurrentValue = HtmlDecode($this->kecamatan_supplier->CurrentValue);
		$this->kecamatan_supplier->EditValue = $this->kecamatan_supplier->CurrentValue;
		$this->kecamatan_supplier->PlaceHolder = RemoveHtml($this->kecamatan_supplier->caption());

		// kota_supplier
		$this->kota_supplier->EditAttrs["class"] = "form-control";
		$this->kota_supplier->EditCustomAttributes = "";
		if (!$this->kota_supplier->Raw)
			$this->kota_supplier->CurrentValue = HtmlDecode($this->kota_supplier->CurrentValue);
		$this->kota_supplier->EditValue = $this->kota_supplier->CurrentValue;
		$this->kota_supplier->PlaceHolder = RemoveHtml($this->kota_supplier->caption());

		// kodepos_supplier
		$this->kodepos_supplier->EditAttrs["class"] = "form-control";
		$this->kodepos_supplier->EditCustomAttributes = "";
		if (!$this->kodepos_supplier->Raw)
			$this->kodepos_supplier->CurrentValue = HtmlDecode($this->kodepos_supplier->CurrentValue);
		$this->kodepos_supplier->EditValue = $this->kodepos_supplier->CurrentValue;
		$this->kodepos_supplier->PlaceHolder = RemoveHtml($this->kodepos_supplier->caption());

		// telpon_supplier
		$this->telpon_supplier->EditAttrs["class"] = "form-control";
		$this->telpon_supplier->EditCustomAttributes = "";
		if (!$this->telpon_supplier->Raw)
			$this->telpon_supplier->CurrentValue = HtmlDecode($this->telpon_supplier->CurrentValue);
		$this->telpon_supplier->EditValue = $this->telpon_supplier->CurrentValue;
		$this->telpon_supplier->PlaceHolder = RemoveHtml($this->telpon_supplier->caption());

		// hp_supplier
		$this->hp_supplier->EditAttrs["class"] = "form-control";
		$this->hp_supplier->EditCustomAttributes = "";
		if (!$this->hp_supplier->Raw)
			$this->hp_supplier->CurrentValue = HtmlDecode($this->hp_supplier->CurrentValue);
		$this->hp_supplier->EditValue = $this->hp_supplier->CurrentValue;
		$this->hp_supplier->PlaceHolder = RemoveHtml($this->hp_supplier->caption());

		// email_supplier
		$this->email_supplier->EditAttrs["class"] = "form-control";
		$this->email_supplier->EditCustomAttributes = "";
		if (!$this->email_supplier->Raw)
			$this->email_supplier->CurrentValue = HtmlDecode($this->email_supplier->CurrentValue);
		$this->email_supplier->EditValue = $this->email_supplier->CurrentValue;
		$this->email_supplier->PlaceHolder = RemoveHtml($this->email_supplier->caption());

		// kategori_supplier
		$this->kategori_supplier->EditCustomAttributes = "";
		$this->kategori_supplier->EditValue = $this->kategori_supplier->options(FALSE);

		// npwp_supplier
		$this->npwp_supplier->EditAttrs["class"] = "form-control";
		$this->npwp_supplier->EditCustomAttributes = "";
		if (!$this->npwp_supplier->Raw)
			$this->npwp_supplier->CurrentValue = HtmlDecode($this->npwp_supplier->CurrentValue);
		$this->npwp_supplier->EditValue = $this->npwp_supplier->CurrentValue;
		$this->npwp_supplier->PlaceHolder = RemoveHtml($this->npwp_supplier->caption());

		// rekening_supplier
		$this->rekening_supplier->EditAttrs["class"] = "form-control";
		$this->rekening_supplier->EditCustomAttributes = "";
		if (!$this->rekening_supplier->Raw)
			$this->rekening_supplier->CurrentValue = HtmlDecode($this->rekening_supplier->CurrentValue);
		$this->rekening_supplier->EditValue = $this->rekening_supplier->CurrentValue;
		$this->rekening_supplier->PlaceHolder = RemoveHtml($this->rekening_supplier->caption());

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
					$doc->exportCaption($this->id_supplier);
					$doc->exportCaption($this->kode_supplier);
					$doc->exportCaption($this->nama_supplier);
					$doc->exportCaption($this->pic_supplier);
					$doc->exportCaption($this->alamat_supplier);
					$doc->exportCaption($this->kelurahan_supplier);
					$doc->exportCaption($this->kecamatan_supplier);
					$doc->exportCaption($this->kota_supplier);
					$doc->exportCaption($this->kodepos_supplier);
					$doc->exportCaption($this->telpon_supplier);
					$doc->exportCaption($this->hp_supplier);
					$doc->exportCaption($this->email_supplier);
					$doc->exportCaption($this->kategori_supplier);
					$doc->exportCaption($this->npwp_supplier);
					$doc->exportCaption($this->rekening_supplier);
				} else {
					$doc->exportCaption($this->id_supplier);
					$doc->exportCaption($this->kode_supplier);
					$doc->exportCaption($this->nama_supplier);
					$doc->exportCaption($this->pic_supplier);
					$doc->exportCaption($this->alamat_supplier);
					$doc->exportCaption($this->kelurahan_supplier);
					$doc->exportCaption($this->kecamatan_supplier);
					$doc->exportCaption($this->kota_supplier);
					$doc->exportCaption($this->kodepos_supplier);
					$doc->exportCaption($this->telpon_supplier);
					$doc->exportCaption($this->hp_supplier);
					$doc->exportCaption($this->email_supplier);
					$doc->exportCaption($this->kategori_supplier);
					$doc->exportCaption($this->npwp_supplier);
					$doc->exportCaption($this->rekening_supplier);
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
						$doc->exportField($this->id_supplier);
						$doc->exportField($this->kode_supplier);
						$doc->exportField($this->nama_supplier);
						$doc->exportField($this->pic_supplier);
						$doc->exportField($this->alamat_supplier);
						$doc->exportField($this->kelurahan_supplier);
						$doc->exportField($this->kecamatan_supplier);
						$doc->exportField($this->kota_supplier);
						$doc->exportField($this->kodepos_supplier);
						$doc->exportField($this->telpon_supplier);
						$doc->exportField($this->hp_supplier);
						$doc->exportField($this->email_supplier);
						$doc->exportField($this->kategori_supplier);
						$doc->exportField($this->npwp_supplier);
						$doc->exportField($this->rekening_supplier);
					} else {
						$doc->exportField($this->id_supplier);
						$doc->exportField($this->kode_supplier);
						$doc->exportField($this->nama_supplier);
						$doc->exportField($this->pic_supplier);
						$doc->exportField($this->alamat_supplier);
						$doc->exportField($this->kelurahan_supplier);
						$doc->exportField($this->kecamatan_supplier);
						$doc->exportField($this->kota_supplier);
						$doc->exportField($this->kodepos_supplier);
						$doc->exportField($this->telpon_supplier);
						$doc->exportField($this->hp_supplier);
						$doc->exportField($this->email_supplier);
						$doc->exportField($this->kategori_supplier);
						$doc->exportField($this->npwp_supplier);
						$doc->exportField($this->rekening_supplier);
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