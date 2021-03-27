<?php namespace PHPMaker2020\klinik_latest_26_03_21; ?>
<?php

/**
 * Table class for transaksi_komisi
 */
class transaksi_komisi extends DbTable
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
	public $id_pegawai;
	public $id_jabatan;
	public $kode_penjualan;
	public $tgl;
	public $id_barang;
	public $qty;
	public $subtotal;
	public $jenis_komisi;
	public $komisi;
	public $total_komisi;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'transaksi_komisi';
		$this->TableName = 'transaksi_komisi';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`transaksi_komisi`";
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
		$this->id = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// id_pegawai
		$this->id_pegawai = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_id_pegawai', 'id_pegawai', '`id_pegawai`', '`id_pegawai`', 3, 11, -1, FALSE, '`id_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_pegawai->Sortable = TRUE; // Allow sort
		$this->id_pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_pegawai->Lookup = new Lookup('id_pegawai', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","","",""], [], [], [], [], [], [], '', '');
		$this->id_pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pegawai'] = &$this->id_pegawai;

		// id_jabatan
		$this->id_jabatan = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_id_jabatan', 'id_jabatan', '`id_jabatan`', '`id_jabatan`', 3, 11, -1, FALSE, '`id_jabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_jabatan->Sortable = TRUE; // Allow sort
		$this->id_jabatan->Lookup = new Lookup('id_jabatan', 'm_jabatan', FALSE, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->id_jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_jabatan'] = &$this->id_jabatan;

		// kode_penjualan
		$this->kode_penjualan = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_kode_penjualan', 'kode_penjualan', '`kode_penjualan`', '`kode_penjualan`', 200, 255, -1, FALSE, '`kode_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_penjualan->Sortable = TRUE; // Allow sort
		$this->fields['kode_penjualan'] = &$this->kode_penjualan;

		// tgl
		$this->tgl = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 133, 10, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// id_barang
		$this->id_barang = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->Lookup = new Lookup('id_barang', 'm_barang', FALSE, 'id', ["nama_barang","","",""], [], [], [], [], [], [], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// qty
		$this->qty = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_qty', 'qty', '`qty`', '`qty`', 3, 11, -1, FALSE, '`qty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty->Sortable = TRUE; // Allow sort
		$this->qty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['qty'] = &$this->qty;

		// subtotal
		$this->subtotal = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_subtotal', 'subtotal', '`subtotal`', '`subtotal`', 5, 22, -1, FALSE, '`subtotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subtotal->Sortable = TRUE; // Allow sort
		$this->subtotal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['subtotal'] = &$this->subtotal;

		// jenis_komisi
		$this->jenis_komisi = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_jenis_komisi', 'jenis_komisi', '`jenis_komisi`', '`jenis_komisi`', 200, 50, -1, FALSE, '`jenis_komisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis_komisi->Sortable = TRUE; // Allow sort
		$this->fields['jenis_komisi'] = &$this->jenis_komisi;

		// komisi
		$this->komisi = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_komisi', 'komisi', '`komisi`', '`komisi`', 131, 20, -1, FALSE, '`komisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->komisi->Sortable = TRUE; // Allow sort
		$this->komisi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['komisi'] = &$this->komisi;

		// total_komisi
		$this->total_komisi = new DbField('transaksi_komisi', 'transaksi_komisi', 'x_total_komisi', 'total_komisi', '`total_komisi`', '`total_komisi`', 5, 22, -1, FALSE, '`total_komisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_komisi->Sortable = TRUE; // Allow sort
		$this->total_komisi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_komisi'] = &$this->total_komisi;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`transaksi_komisi`";
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
		$this->id_pegawai->DbValue = $row['id_pegawai'];
		$this->id_jabatan->DbValue = $row['id_jabatan'];
		$this->kode_penjualan->DbValue = $row['kode_penjualan'];
		$this->tgl->DbValue = $row['tgl'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->qty->DbValue = $row['qty'];
		$this->subtotal->DbValue = $row['subtotal'];
		$this->jenis_komisi->DbValue = $row['jenis_komisi'];
		$this->komisi->DbValue = $row['komisi'];
		$this->total_komisi->DbValue = $row['total_komisi'];
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
			return "transaksi_komisilist.php";
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
		if ($pageName == "transaksi_komisiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "transaksi_komisiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "transaksi_komisiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "transaksi_komisilist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("transaksi_komisiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("transaksi_komisiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "transaksi_komisiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "transaksi_komisiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("transaksi_komisiedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("transaksi_komisiadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("transaksi_komisidelete.php", $this->getUrlParm());
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
		$this->id_pegawai->setDbValue($rs->fields('id_pegawai'));
		$this->id_jabatan->setDbValue($rs->fields('id_jabatan'));
		$this->kode_penjualan->setDbValue($rs->fields('kode_penjualan'));
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->qty->setDbValue($rs->fields('qty'));
		$this->subtotal->setDbValue($rs->fields('subtotal'));
		$this->jenis_komisi->setDbValue($rs->fields('jenis_komisi'));
		$this->komisi->setDbValue($rs->fields('komisi'));
		$this->total_komisi->setDbValue($rs->fields('total_komisi'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// id_pegawai
		// id_jabatan
		// kode_penjualan
		// tgl
		// id_barang
		// qty
		// subtotal
		// jenis_komisi
		// komisi
		// total_komisi
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// id_pegawai
		$curVal = strval($this->id_pegawai->CurrentValue);
		if ($curVal != "") {
			$this->id_pegawai->ViewValue = $this->id_pegawai->lookupCacheOption($curVal);
			if ($this->id_pegawai->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_pegawai->ViewValue = $this->id_pegawai->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_pegawai->ViewValue = $this->id_pegawai->CurrentValue;
				}
			}
		} else {
			$this->id_pegawai->ViewValue = NULL;
		}
		$this->id_pegawai->ViewCustomAttributes = "";

		// id_jabatan
		$this->id_jabatan->ViewValue = $this->id_jabatan->CurrentValue;
		$curVal = strval($this->id_jabatan->CurrentValue);
		if ($curVal != "") {
			$this->id_jabatan->ViewValue = $this->id_jabatan->lookupCacheOption($curVal);
			if ($this->id_jabatan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_jabatan->ViewValue = $this->id_jabatan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_jabatan->ViewValue = $this->id_jabatan->CurrentValue;
				}
			}
		} else {
			$this->id_jabatan->ViewValue = NULL;
		}
		$this->id_jabatan->ViewCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$curVal = strval($this->id_barang->CurrentValue);
		if ($curVal != "") {
			$this->id_barang->ViewValue = $this->id_barang->lookupCacheOption($curVal);
			if ($this->id_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, '', $this);
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

		// qty
		$this->qty->ViewValue = $this->qty->CurrentValue;
		$this->qty->ViewValue = FormatNumber($this->qty->ViewValue, 0, -2, -2, -2);
		$this->qty->ViewCustomAttributes = "";

		// subtotal
		$this->subtotal->ViewValue = $this->subtotal->CurrentValue;
		$this->subtotal->ViewValue = FormatNumber($this->subtotal->ViewValue, 2, -2, -2, -2);
		$this->subtotal->ViewCustomAttributes = "";

		// jenis_komisi
		$this->jenis_komisi->ViewValue = $this->jenis_komisi->CurrentValue;
		$this->jenis_komisi->ViewCustomAttributes = "";

		// komisi
		$this->komisi->ViewValue = $this->komisi->CurrentValue;
		$this->komisi->ViewValue = FormatNumber($this->komisi->ViewValue, 2, -2, -2, -2);
		$this->komisi->ViewCustomAttributes = "";

		// total_komisi
		$this->total_komisi->ViewValue = $this->total_komisi->CurrentValue;
		$this->total_komisi->ViewValue = FormatNumber($this->total_komisi->ViewValue, 2, -2, -2, -2);
		$this->total_komisi->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// id_pegawai
		$this->id_pegawai->LinkCustomAttributes = "";
		$this->id_pegawai->HrefValue = "";
		$this->id_pegawai->TooltipValue = "";

		// id_jabatan
		$this->id_jabatan->LinkCustomAttributes = "";
		$this->id_jabatan->HrefValue = "";
		$this->id_jabatan->TooltipValue = "";

		// kode_penjualan
		$this->kode_penjualan->LinkCustomAttributes = "";
		$this->kode_penjualan->HrefValue = "";
		$this->kode_penjualan->TooltipValue = "";

		// tgl
		$this->tgl->LinkCustomAttributes = "";
		$this->tgl->HrefValue = "";
		$this->tgl->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// qty
		$this->qty->LinkCustomAttributes = "";
		$this->qty->HrefValue = "";
		$this->qty->TooltipValue = "";

		// subtotal
		$this->subtotal->LinkCustomAttributes = "";
		$this->subtotal->HrefValue = "";
		$this->subtotal->TooltipValue = "";

		// jenis_komisi
		$this->jenis_komisi->LinkCustomAttributes = "";
		$this->jenis_komisi->HrefValue = "";
		$this->jenis_komisi->TooltipValue = "";

		// komisi
		$this->komisi->LinkCustomAttributes = "";
		$this->komisi->HrefValue = "";
		$this->komisi->TooltipValue = "";

		// total_komisi
		$this->total_komisi->LinkCustomAttributes = "";
		$this->total_komisi->HrefValue = "";
		$this->total_komisi->TooltipValue = "";

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

		// id_pegawai
		$this->id_pegawai->EditAttrs["class"] = "form-control";
		$this->id_pegawai->EditCustomAttributes = "";

		// id_jabatan
		$this->id_jabatan->EditAttrs["class"] = "form-control";
		$this->id_jabatan->EditCustomAttributes = "";
		$this->id_jabatan->EditValue = $this->id_jabatan->CurrentValue;
		$this->id_jabatan->PlaceHolder = RemoveHtml($this->id_jabatan->caption());

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

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// qty
		$this->qty->EditAttrs["class"] = "form-control";
		$this->qty->EditCustomAttributes = "";
		$this->qty->EditValue = $this->qty->CurrentValue;
		$this->qty->PlaceHolder = RemoveHtml($this->qty->caption());

		// subtotal
		$this->subtotal->EditAttrs["class"] = "form-control";
		$this->subtotal->EditCustomAttributes = "";
		$this->subtotal->EditValue = $this->subtotal->CurrentValue;
		$this->subtotal->PlaceHolder = RemoveHtml($this->subtotal->caption());
		if (strval($this->subtotal->EditValue) != "" && is_numeric($this->subtotal->EditValue))
			$this->subtotal->EditValue = FormatNumber($this->subtotal->EditValue, -2, -2, -2, -2);
		

		// jenis_komisi
		$this->jenis_komisi->EditAttrs["class"] = "form-control";
		$this->jenis_komisi->EditCustomAttributes = "";
		if (!$this->jenis_komisi->Raw)
			$this->jenis_komisi->CurrentValue = HtmlDecode($this->jenis_komisi->CurrentValue);
		$this->jenis_komisi->EditValue = $this->jenis_komisi->CurrentValue;
		$this->jenis_komisi->PlaceHolder = RemoveHtml($this->jenis_komisi->caption());

		// komisi
		$this->komisi->EditAttrs["class"] = "form-control";
		$this->komisi->EditCustomAttributes = "";
		$this->komisi->EditValue = $this->komisi->CurrentValue;
		$this->komisi->PlaceHolder = RemoveHtml($this->komisi->caption());
		if (strval($this->komisi->EditValue) != "" && is_numeric($this->komisi->EditValue))
			$this->komisi->EditValue = FormatNumber($this->komisi->EditValue, -2, -2, -2, -2);
		

		// total_komisi
		$this->total_komisi->EditAttrs["class"] = "form-control";
		$this->total_komisi->EditCustomAttributes = "";
		$this->total_komisi->EditValue = $this->total_komisi->CurrentValue;
		$this->total_komisi->PlaceHolder = RemoveHtml($this->total_komisi->caption());
		if (strval($this->total_komisi->EditValue) != "" && is_numeric($this->total_komisi->EditValue))
			$this->total_komisi->EditValue = FormatNumber($this->total_komisi->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->id_pegawai);
					$doc->exportCaption($this->id_jabatan);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->qty);
					$doc->exportCaption($this->subtotal);
					$doc->exportCaption($this->jenis_komisi);
					$doc->exportCaption($this->komisi);
					$doc->exportCaption($this->total_komisi);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->id_pegawai);
					$doc->exportCaption($this->id_jabatan);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->qty);
					$doc->exportCaption($this->subtotal);
					$doc->exportCaption($this->jenis_komisi);
					$doc->exportCaption($this->komisi);
					$doc->exportCaption($this->total_komisi);
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
						$doc->exportField($this->id_pegawai);
						$doc->exportField($this->id_jabatan);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->tgl);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->qty);
						$doc->exportField($this->subtotal);
						$doc->exportField($this->jenis_komisi);
						$doc->exportField($this->komisi);
						$doc->exportField($this->total_komisi);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->id_pegawai);
						$doc->exportField($this->id_jabatan);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->tgl);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->qty);
						$doc->exportField($this->subtotal);
						$doc->exportField($this->jenis_komisi);
						$doc->exportField($this->komisi);
						$doc->exportField($this->total_komisi);
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