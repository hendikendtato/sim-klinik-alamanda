<?php namespace PHPMaker2020\klinik_latest_08_04_21; ?>
<?php

/**
 * Table class for view_member
 */
class view_member extends DbTable
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
	public $id_pelanggan;
	public $nama_pelanggan;
	public $kode_member;
	public $id_klinik;
	public $jenis_member;
	public $tgl_mulai;
	public $tgl_akhir;
	public $disc_prosen;
	public $disc_nominal;
	public $poin_member;
	public $tgl_awal_transaksi;
	public $total_akumulasi;
	public $id;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'view_member';
		$this->TableName = 'view_member';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`view_member`";
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

		// id_pelanggan
		$this->id_pelanggan = new DbField('view_member', 'view_member', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 11, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_pelanggan->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_pelanggan->IsPrimaryKey = TRUE; // Primary key field
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// nama_pelanggan
		$this->nama_pelanggan = new DbField('view_member', 'view_member', 'x_nama_pelanggan', 'nama_pelanggan', '`nama_pelanggan`', '`nama_pelanggan`', 200, 255, -1, FALSE, '`nama_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->nama_pelanggan->Required = TRUE; // Required field
		$this->nama_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['nama_pelanggan'] = &$this->nama_pelanggan;

		// kode_member
		$this->kode_member = new DbField('view_member', 'view_member', 'x_kode_member', 'kode_member', '`kode_member`', '`kode_member`', 200, 255, -1, FALSE, '`kode_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_member->Sortable = TRUE; // Allow sort
		$this->fields['kode_member'] = &$this->kode_member;

		// id_klinik
		$this->id_klinik = new DbField('view_member', 'view_member', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_klinik->Nullable = FALSE; // NOT NULL field
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// jenis_member
		$this->jenis_member = new DbField('view_member', 'view_member', 'x_jenis_member', 'jenis_member', '`jenis_member`', '`jenis_member`', 3, 11, -1, FALSE, '`jenis_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis_member->Sortable = TRUE; // Allow sort
		$this->jenis_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenis_member'] = &$this->jenis_member;

		// tgl_mulai
		$this->tgl_mulai = new DbField('view_member', 'view_member', 'x_tgl_mulai', 'tgl_mulai', '`tgl_mulai`', CastDateFieldForLike("`tgl_mulai`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_mulai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_mulai->Sortable = TRUE; // Allow sort
		$this->tgl_mulai->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_mulai'] = &$this->tgl_mulai;

		// tgl_akhir
		$this->tgl_akhir = new DbField('view_member', 'view_member', 'x_tgl_akhir', 'tgl_akhir', '`tgl_akhir`', CastDateFieldForLike("`tgl_akhir`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_akhir->Sortable = TRUE; // Allow sort
		$this->tgl_akhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_akhir'] = &$this->tgl_akhir;

		// disc_prosen
		$this->disc_prosen = new DbField('view_member', 'view_member', 'x_disc_prosen', 'disc_prosen', '`disc_prosen`', '`disc_prosen`', 5, 22, -1, FALSE, '`disc_prosen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_prosen->Sortable = TRUE; // Allow sort
		$this->disc_prosen->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_prosen'] = &$this->disc_prosen;

		// disc_nominal
		$this->disc_nominal = new DbField('view_member', 'view_member', 'x_disc_nominal', 'disc_nominal', '`disc_nominal`', '`disc_nominal`', 5, 22, -1, FALSE, '`disc_nominal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_nominal->Sortable = TRUE; // Allow sort
		$this->disc_nominal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_nominal'] = &$this->disc_nominal;

		// poin_member
		$this->poin_member = new DbField('view_member', 'view_member', 'x_poin_member', 'poin_member', '`poin_member`', '`poin_member`', 20, 20, -1, FALSE, '`poin_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->poin_member->Sortable = TRUE; // Allow sort
		$this->poin_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['poin_member'] = &$this->poin_member;

		// tgl_awal_transaksi
		$this->tgl_awal_transaksi = new DbField('view_member', 'view_member', 'x_tgl_awal_transaksi', 'tgl_awal_transaksi', '`tgl_awal_transaksi`', CastDateFieldForLike("`tgl_awal_transaksi`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_awal_transaksi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_awal_transaksi->Sortable = TRUE; // Allow sort
		$this->tgl_awal_transaksi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_awal_transaksi'] = &$this->tgl_awal_transaksi;

		// total_akumulasi
		$this->total_akumulasi = new DbField('view_member', 'view_member', 'x_total_akumulasi', 'total_akumulasi', '`total_akumulasi`', '`total_akumulasi`', 3, 11, -1, FALSE, '`total_akumulasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_akumulasi->Sortable = TRUE; // Allow sort
		$this->total_akumulasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['total_akumulasi'] = &$this->total_akumulasi;

		// id
		$this->id = new DbField('view_member', 'view_member', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`view_member`";
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
			$this->id_pelanggan->setDbValue($conn->insert_ID());
			$rs['id_pelanggan'] = $this->id_pelanggan->DbValue;

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
			if (array_key_exists('id_pelanggan', $rs))
				AddFilter($where, QuotedName('id_pelanggan', $this->Dbid) . '=' . QuotedValue($rs['id_pelanggan'], $this->id_pelanggan->DataType, $this->Dbid));
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
		$this->id_pelanggan->DbValue = $row['id_pelanggan'];
		$this->nama_pelanggan->DbValue = $row['nama_pelanggan'];
		$this->kode_member->DbValue = $row['kode_member'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->jenis_member->DbValue = $row['jenis_member'];
		$this->tgl_mulai->DbValue = $row['tgl_mulai'];
		$this->tgl_akhir->DbValue = $row['tgl_akhir'];
		$this->disc_prosen->DbValue = $row['disc_prosen'];
		$this->disc_nominal->DbValue = $row['disc_nominal'];
		$this->poin_member->DbValue = $row['poin_member'];
		$this->tgl_awal_transaksi->DbValue = $row['tgl_awal_transaksi'];
		$this->total_akumulasi->DbValue = $row['total_akumulasi'];
		$this->id->DbValue = $row['id'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_pelanggan` = @id_pelanggan@ AND `id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_pelanggan', $row) ? $row['id_pelanggan'] : NULL;
		else
			$val = $this->id_pelanggan->OldValue !== NULL ? $this->id_pelanggan->OldValue : $this->id_pelanggan->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_pelanggan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "view_memberlist.php";
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
		if ($pageName == "view_memberview.php")
			return $Language->phrase("View");
		elseif ($pageName == "view_memberedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "view_memberadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "view_memberlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("view_memberview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("view_memberview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "view_memberadd.php?" . $this->getUrlParm($parm);
		else
			$url = "view_memberadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("view_memberedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("view_memberadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("view_memberdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_pelanggan:" . JsonEncode($this->id_pelanggan->CurrentValue, "number");
		$json .= ",id:" . JsonEncode($this->id->CurrentValue, "number");
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
		if ($this->id_pelanggan->CurrentValue != NULL) {
			$url .= "id_pelanggan=" . urlencode($this->id_pelanggan->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->id->CurrentValue != NULL) {
			$url .= "&id=" . urlencode($this->id->CurrentValue);
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
			for ($i = 0; $i < $cnt; $i++)
				$arKeys[$i] = explode(Config("COMPOSITE_KEY_SEPARATOR"), $arKeys[$i]);
		} else {
			if (Param("id_pelanggan") !== NULL)
				$arKey[] = Param("id_pelanggan");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("id") !== NULL)
				$arKey[] = Param("id");
			elseif (IsApi() && Key(1) !== NULL)
				$arKey[] = Key(1);
			elseif (IsApi() && Route(3) !== NULL)
				$arKey[] = Route(3);
			else
				$arKeys = NULL; // Do not setup
			if (is_array($arKeys)) $arKeys[] = $arKey;

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_array($key) || count($key) != 2)
					continue; // Just skip so other keys will still work
				if (!is_numeric($key[0])) // id_pelanggan
					continue;
				if (!is_numeric($key[1])) // id
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
				$this->id_pelanggan->CurrentValue = $key[0];
			else
				$this->id_pelanggan->OldValue = $key[0];
			if ($setCurrent)
				$this->id->CurrentValue = $key[1];
			else
				$this->id->OldValue = $key[1];
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
		$this->id_pelanggan->setDbValue($rs->fields('id_pelanggan'));
		$this->nama_pelanggan->setDbValue($rs->fields('nama_pelanggan'));
		$this->kode_member->setDbValue($rs->fields('kode_member'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->jenis_member->setDbValue($rs->fields('jenis_member'));
		$this->tgl_mulai->setDbValue($rs->fields('tgl_mulai'));
		$this->tgl_akhir->setDbValue($rs->fields('tgl_akhir'));
		$this->disc_prosen->setDbValue($rs->fields('disc_prosen'));
		$this->disc_nominal->setDbValue($rs->fields('disc_nominal'));
		$this->poin_member->setDbValue($rs->fields('poin_member'));
		$this->tgl_awal_transaksi->setDbValue($rs->fields('tgl_awal_transaksi'));
		$this->total_akumulasi->setDbValue($rs->fields('total_akumulasi'));
		$this->id->setDbValue($rs->fields('id'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_pelanggan
		// nama_pelanggan
		// kode_member
		// id_klinik
		// jenis_member
		// tgl_mulai
		// tgl_akhir
		// disc_prosen
		// disc_nominal
		// poin_member
		// tgl_awal_transaksi
		// total_akumulasi
		// id
		// id_pelanggan

		$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewCustomAttributes = "";

		// nama_pelanggan
		$this->nama_pelanggan->ViewValue = $this->nama_pelanggan->CurrentValue;
		$this->nama_pelanggan->ViewCustomAttributes = "";

		// kode_member
		$this->kode_member->ViewValue = $this->kode_member->CurrentValue;
		$this->kode_member->ViewCustomAttributes = "";

		// id_klinik
		$this->id_klinik->ViewValue = $this->id_klinik->CurrentValue;
		$this->id_klinik->ViewValue = FormatNumber($this->id_klinik->ViewValue, 0, -2, -2, -2);
		$this->id_klinik->ViewCustomAttributes = "";

		// jenis_member
		$this->jenis_member->ViewValue = $this->jenis_member->CurrentValue;
		$this->jenis_member->ViewValue = FormatNumber($this->jenis_member->ViewValue, 0, -2, -2, -2);
		$this->jenis_member->ViewCustomAttributes = "";

		// tgl_mulai
		$this->tgl_mulai->ViewValue = $this->tgl_mulai->CurrentValue;
		$this->tgl_mulai->ViewValue = FormatDateTime($this->tgl_mulai->ViewValue, 0);
		$this->tgl_mulai->ViewCustomAttributes = "";

		// tgl_akhir
		$this->tgl_akhir->ViewValue = $this->tgl_akhir->CurrentValue;
		$this->tgl_akhir->ViewValue = FormatDateTime($this->tgl_akhir->ViewValue, 0);
		$this->tgl_akhir->ViewCustomAttributes = "";

		// disc_prosen
		$this->disc_prosen->ViewValue = $this->disc_prosen->CurrentValue;
		$this->disc_prosen->ViewValue = FormatNumber($this->disc_prosen->ViewValue, 2, -2, -2, -2);
		$this->disc_prosen->ViewCustomAttributes = "";

		// disc_nominal
		$this->disc_nominal->ViewValue = $this->disc_nominal->CurrentValue;
		$this->disc_nominal->ViewValue = FormatNumber($this->disc_nominal->ViewValue, 2, -2, -2, -2);
		$this->disc_nominal->ViewCustomAttributes = "";

		// poin_member
		$this->poin_member->ViewValue = $this->poin_member->CurrentValue;
		$this->poin_member->ViewValue = FormatNumber($this->poin_member->ViewValue, 0, -2, -2, -2);
		$this->poin_member->ViewCustomAttributes = "";

		// tgl_awal_transaksi
		$this->tgl_awal_transaksi->ViewValue = $this->tgl_awal_transaksi->CurrentValue;
		$this->tgl_awal_transaksi->ViewValue = FormatDateTime($this->tgl_awal_transaksi->ViewValue, 0);
		$this->tgl_awal_transaksi->ViewCustomAttributes = "";

		// total_akumulasi
		$this->total_akumulasi->ViewValue = $this->total_akumulasi->CurrentValue;
		$this->total_akumulasi->ViewValue = FormatNumber($this->total_akumulasi->ViewValue, 0, -2, -2, -2);
		$this->total_akumulasi->ViewCustomAttributes = "";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// nama_pelanggan
		$this->nama_pelanggan->LinkCustomAttributes = "";
		$this->nama_pelanggan->HrefValue = "";
		$this->nama_pelanggan->TooltipValue = "";

		// kode_member
		$this->kode_member->LinkCustomAttributes = "";
		$this->kode_member->HrefValue = "";
		$this->kode_member->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// jenis_member
		$this->jenis_member->LinkCustomAttributes = "";
		$this->jenis_member->HrefValue = "";
		$this->jenis_member->TooltipValue = "";

		// tgl_mulai
		$this->tgl_mulai->LinkCustomAttributes = "";
		$this->tgl_mulai->HrefValue = "";
		$this->tgl_mulai->TooltipValue = "";

		// tgl_akhir
		$this->tgl_akhir->LinkCustomAttributes = "";
		$this->tgl_akhir->HrefValue = "";
		$this->tgl_akhir->TooltipValue = "";

		// disc_prosen
		$this->disc_prosen->LinkCustomAttributes = "";
		$this->disc_prosen->HrefValue = "";
		$this->disc_prosen->TooltipValue = "";

		// disc_nominal
		$this->disc_nominal->LinkCustomAttributes = "";
		$this->disc_nominal->HrefValue = "";
		$this->disc_nominal->TooltipValue = "";

		// poin_member
		$this->poin_member->LinkCustomAttributes = "";
		$this->poin_member->HrefValue = "";
		$this->poin_member->TooltipValue = "";

		// tgl_awal_transaksi
		$this->tgl_awal_transaksi->LinkCustomAttributes = "";
		$this->tgl_awal_transaksi->HrefValue = "";
		$this->tgl_awal_transaksi->TooltipValue = "";

		// total_akumulasi
		$this->total_akumulasi->LinkCustomAttributes = "";
		$this->total_akumulasi->HrefValue = "";
		$this->total_akumulasi->TooltipValue = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

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

		// id_pelanggan
		$this->id_pelanggan->EditAttrs["class"] = "form-control";
		$this->id_pelanggan->EditCustomAttributes = "";
		$this->id_pelanggan->EditValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewCustomAttributes = "";

		// nama_pelanggan
		$this->nama_pelanggan->EditAttrs["class"] = "form-control";
		$this->nama_pelanggan->EditCustomAttributes = "";
		if (!$this->nama_pelanggan->Raw)
			$this->nama_pelanggan->CurrentValue = HtmlDecode($this->nama_pelanggan->CurrentValue);
		$this->nama_pelanggan->EditValue = $this->nama_pelanggan->CurrentValue;
		$this->nama_pelanggan->PlaceHolder = RemoveHtml($this->nama_pelanggan->caption());

		// kode_member
		$this->kode_member->EditAttrs["class"] = "form-control";
		$this->kode_member->EditCustomAttributes = "";
		if (!$this->kode_member->Raw)
			$this->kode_member->CurrentValue = HtmlDecode($this->kode_member->CurrentValue);
		$this->kode_member->EditValue = $this->kode_member->CurrentValue;
		$this->kode_member->PlaceHolder = RemoveHtml($this->kode_member->caption());

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";
		$this->id_klinik->EditValue = $this->id_klinik->CurrentValue;
		$this->id_klinik->PlaceHolder = RemoveHtml($this->id_klinik->caption());

		// jenis_member
		$this->jenis_member->EditAttrs["class"] = "form-control";
		$this->jenis_member->EditCustomAttributes = "";
		$this->jenis_member->EditValue = $this->jenis_member->CurrentValue;
		$this->jenis_member->PlaceHolder = RemoveHtml($this->jenis_member->caption());

		// tgl_mulai
		$this->tgl_mulai->EditAttrs["class"] = "form-control";
		$this->tgl_mulai->EditCustomAttributes = "";
		$this->tgl_mulai->EditValue = FormatDateTime($this->tgl_mulai->CurrentValue, 8);
		$this->tgl_mulai->PlaceHolder = RemoveHtml($this->tgl_mulai->caption());

		// tgl_akhir
		$this->tgl_akhir->EditAttrs["class"] = "form-control";
		$this->tgl_akhir->EditCustomAttributes = "";
		$this->tgl_akhir->EditValue = FormatDateTime($this->tgl_akhir->CurrentValue, 8);
		$this->tgl_akhir->PlaceHolder = RemoveHtml($this->tgl_akhir->caption());

		// disc_prosen
		$this->disc_prosen->EditAttrs["class"] = "form-control";
		$this->disc_prosen->EditCustomAttributes = "";
		$this->disc_prosen->EditValue = $this->disc_prosen->CurrentValue;
		$this->disc_prosen->PlaceHolder = RemoveHtml($this->disc_prosen->caption());
		if (strval($this->disc_prosen->EditValue) != "" && is_numeric($this->disc_prosen->EditValue))
			$this->disc_prosen->EditValue = FormatNumber($this->disc_prosen->EditValue, -2, -2, -2, -2);
		

		// disc_nominal
		$this->disc_nominal->EditAttrs["class"] = "form-control";
		$this->disc_nominal->EditCustomAttributes = "";
		$this->disc_nominal->EditValue = $this->disc_nominal->CurrentValue;
		$this->disc_nominal->PlaceHolder = RemoveHtml($this->disc_nominal->caption());
		if (strval($this->disc_nominal->EditValue) != "" && is_numeric($this->disc_nominal->EditValue))
			$this->disc_nominal->EditValue = FormatNumber($this->disc_nominal->EditValue, -2, -2, -2, -2);
		

		// poin_member
		$this->poin_member->EditAttrs["class"] = "form-control";
		$this->poin_member->EditCustomAttributes = "";
		$this->poin_member->EditValue = $this->poin_member->CurrentValue;
		$this->poin_member->PlaceHolder = RemoveHtml($this->poin_member->caption());

		// tgl_awal_transaksi
		$this->tgl_awal_transaksi->EditAttrs["class"] = "form-control";
		$this->tgl_awal_transaksi->EditCustomAttributes = "";
		$this->tgl_awal_transaksi->EditValue = FormatDateTime($this->tgl_awal_transaksi->CurrentValue, 8);
		$this->tgl_awal_transaksi->PlaceHolder = RemoveHtml($this->tgl_awal_transaksi->caption());

		// total_akumulasi
		$this->total_akumulasi->EditAttrs["class"] = "form-control";
		$this->total_akumulasi->EditCustomAttributes = "";
		$this->total_akumulasi->EditValue = $this->total_akumulasi->CurrentValue;
		$this->total_akumulasi->PlaceHolder = RemoveHtml($this->total_akumulasi->caption());

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

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
					$doc->exportCaption($this->nama_pelanggan);
					$doc->exportCaption($this->kode_member);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->jenis_member);
					$doc->exportCaption($this->tgl_mulai);
					$doc->exportCaption($this->tgl_akhir);
					$doc->exportCaption($this->disc_prosen);
					$doc->exportCaption($this->disc_nominal);
					$doc->exportCaption($this->poin_member);
					$doc->exportCaption($this->tgl_awal_transaksi);
					$doc->exportCaption($this->total_akumulasi);
					$doc->exportCaption($this->id);
				} else {
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->nama_pelanggan);
					$doc->exportCaption($this->kode_member);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->jenis_member);
					$doc->exportCaption($this->tgl_mulai);
					$doc->exportCaption($this->tgl_akhir);
					$doc->exportCaption($this->disc_prosen);
					$doc->exportCaption($this->disc_nominal);
					$doc->exportCaption($this->poin_member);
					$doc->exportCaption($this->tgl_awal_transaksi);
					$doc->exportCaption($this->total_akumulasi);
					$doc->exportCaption($this->id);
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
						$doc->exportField($this->nama_pelanggan);
						$doc->exportField($this->kode_member);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->jenis_member);
						$doc->exportField($this->tgl_mulai);
						$doc->exportField($this->tgl_akhir);
						$doc->exportField($this->disc_prosen);
						$doc->exportField($this->disc_nominal);
						$doc->exportField($this->poin_member);
						$doc->exportField($this->tgl_awal_transaksi);
						$doc->exportField($this->total_akumulasi);
						$doc->exportField($this->id);
					} else {
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->nama_pelanggan);
						$doc->exportField($this->kode_member);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->jenis_member);
						$doc->exportField($this->tgl_mulai);
						$doc->exportField($this->tgl_akhir);
						$doc->exportField($this->disc_prosen);
						$doc->exportField($this->disc_nominal);
						$doc->exportField($this->poin_member);
						$doc->exportField($this->tgl_awal_transaksi);
						$doc->exportField($this->total_akumulasi);
						$doc->exportField($this->id);
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