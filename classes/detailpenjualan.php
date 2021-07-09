<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for detailpenjualan
 */
class detailpenjualan extends DbTable
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

	// Audit trail
	public $AuditTrailOnAdd = TRUE;
	public $AuditTrailOnEdit = TRUE;
	public $AuditTrailOnDelete = TRUE;
	public $AuditTrailOnView = FALSE;
	public $AuditTrailOnViewData = FALSE;
	public $AuditTrailOnSearch = FALSE;

	// Export
	public $ExportDoc;

	// Fields
	public $id;
	public $id_penjualan;
	public $id_barang;
	public $kode_barang;
	public $nama_barang;
	public $id_kemasan;
	public $harga_jual;
	public $stok;
	public $expired;
	public $qty;
	public $disc_pr;
	public $disc_rp;
	public $voucher_barang;
	public $komisi_recall;
	public $subtotal;
	public $hna;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'detailpenjualan';
		$this->TableName = 'detailpenjualan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`detailpenjualan`";
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
		$this->id = new DbField('detailpenjualan', 'detailpenjualan', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// id_penjualan
		$this->id_penjualan = new DbField('detailpenjualan', 'detailpenjualan', 'x_id_penjualan', 'id_penjualan', '`id_penjualan`', '`id_penjualan`', 3, 11, -1, FALSE, '`id_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_penjualan->IsForeignKey = TRUE; // Foreign key field
		$this->id_penjualan->Nullable = FALSE; // NOT NULL field
		$this->id_penjualan->Required = TRUE; // Required field
		$this->id_penjualan->Sortable = TRUE; // Allow sort
		$this->id_penjualan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_penjualan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_penjualan->Lookup = new Lookup('id_penjualan', 'penjualan', FALSE, 'id', ["kode_penjualan","","",""], [], [], [], [], [], [], '', '');
		$this->id_penjualan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_penjualan'] = &$this->id_penjualan;

		// id_barang
		$this->id_barang = new DbField('detailpenjualan', 'detailpenjualan', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->Lookup = new Lookup('id_barang', 'view_hargajual', FALSE, 'id', ["id","","",""], [], [], [], [], ["totalhargajual","stok","disc_pr","disc_rp"], ["x_harga_jual","x_stok","x_disc_pr","x_disc_rp"], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// kode_barang
		$this->kode_barang = new DbField('detailpenjualan', 'detailpenjualan', 'x_kode_barang', 'kode_barang', '`kode_barang`', '`kode_barang`', 3, 11, -1, FALSE, '`kode_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_barang->Sortable = TRUE; // Allow sort
		$this->kode_barang->Lookup = new Lookup('kode_barang', 'view_hargajual', FALSE, 'id', ["kode_barang","","",""], [], [], [], [], ["id","id_barang"], ["x_id_barang","x_nama_barang"], '', '');
		$this->kode_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kode_barang'] = &$this->kode_barang;

		// nama_barang
		$this->nama_barang = new DbField('detailpenjualan', 'detailpenjualan', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 3, 255, -1, FALSE, '`nama_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_barang->Sortable = TRUE; // Allow sort
		$this->nama_barang->Lookup = new Lookup('nama_barang', 'view_hargajual', FALSE, 'id', ["nama_barang","","",""], [], [], [], [], ["id"], ["x_id_barang"], '', '');
		$this->nama_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nama_barang'] = &$this->nama_barang;

		// id_kemasan
		$this->id_kemasan = new DbField('detailpenjualan', 'detailpenjualan', 'x_id_kemasan', 'id_kemasan', '`id_kemasan`', '`id_kemasan`', 3, 11, -1, FALSE, '`id_kemasan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kemasan->Nullable = FALSE; // NOT NULL field
		$this->id_kemasan->Required = TRUE; // Required field
		$this->id_kemasan->Sortable = TRUE; // Allow sort
		$this->id_kemasan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kemasan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kemasan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kemasan'] = &$this->id_kemasan;

		// harga_jual
		$this->harga_jual = new DbField('detailpenjualan', 'detailpenjualan', 'x_harga_jual', 'harga_jual', '`harga_jual`', '`harga_jual`', 5, 22, -1, FALSE, '`harga_jual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->harga_jual->Nullable = FALSE; // NOT NULL field
		$this->harga_jual->Required = TRUE; // Required field
		$this->harga_jual->Sortable = TRUE; // Allow sort
		$this->harga_jual->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['harga_jual'] = &$this->harga_jual;

		// stok
		$this->stok = new DbField('detailpenjualan', 'detailpenjualan', 'x_stok', 'stok', '`stok`', '`stok`', 4, 12, -1, FALSE, '`stok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok->Sortable = FALSE; // Allow sort
		$this->stok->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['stok'] = &$this->stok;

		// expired
		$this->expired = new DbField('detailpenjualan', 'detailpenjualan', 'x_expired', 'expired', '`expired`', CastDateFieldForLike("`expired`", 0, "DB"), 133, 10, 0, FALSE, '`expired`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->expired->Sortable = TRUE; // Allow sort
		$this->expired->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['expired'] = &$this->expired;

		// qty
		$this->qty = new DbField('detailpenjualan', 'detailpenjualan', 'x_qty', 'qty', '`qty`', '`qty`', 5, 22, -1, FALSE, '`qty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty->Nullable = FALSE; // NOT NULL field
		$this->qty->Sortable = TRUE; // Allow sort
		$this->qty->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['qty'] = &$this->qty;

		// disc_pr
		$this->disc_pr = new DbField('detailpenjualan', 'detailpenjualan', 'x_disc_pr', 'disc_pr', '`disc_pr`', '`disc_pr`', 5, 22, -1, FALSE, '`disc_pr`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_pr->Sortable = TRUE; // Allow sort
		$this->disc_pr->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_pr'] = &$this->disc_pr;

		// disc_rp
		$this->disc_rp = new DbField('detailpenjualan', 'detailpenjualan', 'x_disc_rp', 'disc_rp', '`disc_rp`', '`disc_rp`', 5, 22, -1, FALSE, '`disc_rp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_rp->Sortable = TRUE; // Allow sort
		$this->disc_rp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_rp'] = &$this->disc_rp;

		// voucher_barang
		$this->voucher_barang = new DbField('detailpenjualan', 'detailpenjualan', 'x_voucher_barang', 'voucher_barang', '`voucher_barang`', '`voucher_barang`', 5, 22, -1, FALSE, '`voucher_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->voucher_barang->Sortable = TRUE; // Allow sort
		$this->voucher_barang->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['voucher_barang'] = &$this->voucher_barang;

		// komisi_recall
		$this->komisi_recall = new DbField('detailpenjualan', 'detailpenjualan', 'x_komisi_recall', 'komisi_recall', '`komisi_recall`', '`komisi_recall`', 3, 11, -1, FALSE, '`komisi_recall`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->komisi_recall->Sortable = TRUE; // Allow sort
		$this->komisi_recall->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->komisi_recall->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->komisi_recall->Lookup = new Lookup('komisi_recall', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","","",""], [], [], [], [], [], [], '', '');
		$this->komisi_recall->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['komisi_recall'] = &$this->komisi_recall;

		// subtotal
		$this->subtotal = new DbField('detailpenjualan', 'detailpenjualan', 'x_subtotal', 'subtotal', '`subtotal`', '`subtotal`', 5, 22, -1, FALSE, '`subtotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subtotal->Sortable = TRUE; // Allow sort
		$this->subtotal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['subtotal'] = &$this->subtotal;

		// hna
		$this->hna = new DbField('detailpenjualan', 'detailpenjualan', 'x_hna', 'hna', '`hna`', '`hna`', 3, 11, -1, FALSE, '`hna`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hna->Nullable = FALSE; // NOT NULL field
		$this->hna->Required = TRUE; // Required field
		$this->hna->Sortable = TRUE; // Allow sort
		$this->hna->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['hna'] = &$this->hna;
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
		if ($this->getCurrentMasterTable() == "penjualan") {
			if ($this->id_penjualan->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->id_penjualan->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "penjualan") {
			if ($this->id_penjualan->getSessionValue() != "")
				$detailFilter .= "`id_penjualan`=" . QuotedValue($this->id_penjualan->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_penjualan()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_penjualan()
	{
		return "`id_penjualan`=@id_penjualan@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`detailpenjualan`";
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
			if ($this->AuditTrailOnAdd)
				$this->writeAuditTrailOnAdd($rs);
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
		if ($success && $this->AuditTrailOnEdit && $rsold) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit))
				$rsaudit[$fldname] = $rsold[$fldname];
			$this->writeAuditTrailOnEdit($rsold, $rsaudit);
		}
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
		if ($success && $this->AuditTrailOnDelete)
			$this->writeAuditTrailOnDelete($rs);
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->id_penjualan->DbValue = $row['id_penjualan'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->kode_barang->DbValue = $row['kode_barang'];
		$this->nama_barang->DbValue = $row['nama_barang'];
		$this->id_kemasan->DbValue = $row['id_kemasan'];
		$this->harga_jual->DbValue = $row['harga_jual'];
		$this->stok->DbValue = $row['stok'];
		$this->expired->DbValue = $row['expired'];
		$this->qty->DbValue = $row['qty'];
		$this->disc_pr->DbValue = $row['disc_pr'];
		$this->disc_rp->DbValue = $row['disc_rp'];
		$this->voucher_barang->DbValue = $row['voucher_barang'];
		$this->komisi_recall->DbValue = $row['komisi_recall'];
		$this->subtotal->DbValue = $row['subtotal'];
		$this->hna->DbValue = $row['hna'];
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
			return "detailpenjualanlist.php";
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
		if ($pageName == "detailpenjualanview.php")
			return $Language->phrase("View");
		elseif ($pageName == "detailpenjualanedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "detailpenjualanadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "detailpenjualanlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("detailpenjualanview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("detailpenjualanview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "detailpenjualanadd.php?" . $this->getUrlParm($parm);
		else
			$url = "detailpenjualanadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("detailpenjualanedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("detailpenjualanadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("detailpenjualandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "penjualan" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->id_penjualan->CurrentValue);
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
		$this->id_penjualan->setDbValue($rs->fields('id_penjualan'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->kode_barang->setDbValue($rs->fields('kode_barang'));
		$this->nama_barang->setDbValue($rs->fields('nama_barang'));
		$this->id_kemasan->setDbValue($rs->fields('id_kemasan'));
		$this->harga_jual->setDbValue($rs->fields('harga_jual'));
		$this->stok->setDbValue($rs->fields('stok'));
		$this->expired->setDbValue($rs->fields('expired'));
		$this->qty->setDbValue($rs->fields('qty'));
		$this->disc_pr->setDbValue($rs->fields('disc_pr'));
		$this->disc_rp->setDbValue($rs->fields('disc_rp'));
		$this->voucher_barang->setDbValue($rs->fields('voucher_barang'));
		$this->komisi_recall->setDbValue($rs->fields('komisi_recall'));
		$this->subtotal->setDbValue($rs->fields('subtotal'));
		$this->hna->setDbValue($rs->fields('hna'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// id_penjualan
		// id_barang
		// kode_barang
		// nama_barang
		// id_kemasan
		// harga_jual
		// stok
		// expired
		// qty
		// disc_pr
		// disc_rp
		// voucher_barang
		// komisi_recall
		// subtotal
		// hna
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// id_penjualan
		$curVal = strval($this->id_penjualan->CurrentValue);
		if ($curVal != "") {
			$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
			if ($this->id_penjualan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_penjualan->ViewValue = $this->id_penjualan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
				}
			}
		} else {
			$this->id_penjualan->ViewValue = NULL;
		}
		$this->id_penjualan->ViewCustomAttributes = "";

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

		// kode_barang
		$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
		$curVal = strval($this->kode_barang->CurrentValue);
		if ($curVal != "") {
			$this->kode_barang->ViewValue = $this->kode_barang->lookupCacheOption($curVal);
			if ($this->kode_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`discontinue` <> 'Yes'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->kode_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kode_barang->ViewValue = $this->kode_barang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
				}
			}
		} else {
			$this->kode_barang->ViewValue = NULL;
		}
		$this->kode_barang->ViewCustomAttributes = "";

		// nama_barang
		$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
		$curVal = strval($this->nama_barang->CurrentValue);
		if ($curVal != "") {
			$this->nama_barang->ViewValue = $this->nama_barang->lookupCacheOption($curVal);
			if ($this->nama_barang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`discontinue` <> 'Yes'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->nama_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->nama_barang->ViewValue = $this->nama_barang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
				}
			}
		} else {
			$this->nama_barang->ViewValue = NULL;
		}
		$this->nama_barang->ViewCustomAttributes = "";

		// id_kemasan
		$this->id_kemasan->ViewValue = FormatNumber($this->id_kemasan->ViewValue, 0, -2, -2, -2);
		$this->id_kemasan->ViewCustomAttributes = "";

		// harga_jual
		$this->harga_jual->ViewValue = $this->harga_jual->CurrentValue;
		$this->harga_jual->ViewValue = FormatNumber($this->harga_jual->ViewValue, 0, -2, -2, -2);
		$this->harga_jual->ViewCustomAttributes = "";

		// stok
		$this->stok->ViewValue = $this->stok->CurrentValue;
		$this->stok->ViewValue = FormatNumber($this->stok->ViewValue, 2, -2, -2, -2);
		$this->stok->ViewCustomAttributes = "";

		// expired
		$this->expired->ViewValue = $this->expired->CurrentValue;
		$this->expired->ViewValue = FormatDateTime($this->expired->ViewValue, 0);
		$this->expired->ViewCustomAttributes = "";

		// qty
		$this->qty->ViewValue = $this->qty->CurrentValue;
		$this->qty->ViewValue = FormatNumber($this->qty->ViewValue, 2, -2, -2, -2);
		$this->qty->ViewCustomAttributes = "";

		// disc_pr
		$this->disc_pr->ViewValue = $this->disc_pr->CurrentValue;
		$this->disc_pr->ViewValue = FormatNumber($this->disc_pr->ViewValue, 2, -2, -2, -2);
		$this->disc_pr->ViewCustomAttributes = "";

		// disc_rp
		$this->disc_rp->ViewValue = $this->disc_rp->CurrentValue;
		$this->disc_rp->ViewValue = FormatNumber($this->disc_rp->ViewValue, 2, -2, -2, -2);
		$this->disc_rp->ViewCustomAttributes = "";

		// voucher_barang
		$this->voucher_barang->ViewValue = $this->voucher_barang->CurrentValue;
		$this->voucher_barang->ViewValue = FormatNumber($this->voucher_barang->ViewValue, 2, -2, -2, -2);
		$this->voucher_barang->ViewCustomAttributes = "";

		// komisi_recall
		$curVal = strval($this->komisi_recall->CurrentValue);
		if ($curVal != "") {
			$this->komisi_recall->ViewValue = $this->komisi_recall->lookupCacheOption($curVal);
			if ($this->komisi_recall->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->komisi_recall->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->komisi_recall->ViewValue = $this->komisi_recall->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->komisi_recall->ViewValue = $this->komisi_recall->CurrentValue;
				}
			}
		} else {
			$this->komisi_recall->ViewValue = NULL;
		}
		$this->komisi_recall->ViewCustomAttributes = "";

		// subtotal
		$this->subtotal->ViewValue = $this->subtotal->CurrentValue;
		$this->subtotal->ViewValue = FormatNumber($this->subtotal->ViewValue, 0, -2, -2, -2);
		$this->subtotal->ViewCustomAttributes = "";

		// hna
		$this->hna->ViewValue = $this->hna->CurrentValue;
		$this->hna->ViewValue = FormatNumber($this->hna->ViewValue, 0, -2, -2, -2);
		$this->hna->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// id_penjualan
		$this->id_penjualan->LinkCustomAttributes = "";
		$this->id_penjualan->HrefValue = "";
		$this->id_penjualan->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// kode_barang
		$this->kode_barang->LinkCustomAttributes = "";
		$this->kode_barang->HrefValue = "";
		$this->kode_barang->TooltipValue = "";

		// nama_barang
		$this->nama_barang->LinkCustomAttributes = "";
		$this->nama_barang->HrefValue = "";
		$this->nama_barang->TooltipValue = "";

		// id_kemasan
		$this->id_kemasan->LinkCustomAttributes = "";
		$this->id_kemasan->HrefValue = "";
		$this->id_kemasan->TooltipValue = "";

		// harga_jual
		$this->harga_jual->LinkCustomAttributes = "";
		$this->harga_jual->HrefValue = "";
		$this->harga_jual->TooltipValue = "";

		// stok
		$this->stok->LinkCustomAttributes = "";
		$this->stok->HrefValue = "";
		$this->stok->TooltipValue = "";

		// expired
		$this->expired->LinkCustomAttributes = "";
		$this->expired->HrefValue = "";
		$this->expired->TooltipValue = "";

		// qty
		$this->qty->LinkCustomAttributes = "";
		$this->qty->HrefValue = "";
		$this->qty->TooltipValue = "";

		// disc_pr
		$this->disc_pr->LinkCustomAttributes = "";
		$this->disc_pr->HrefValue = "";
		$this->disc_pr->TooltipValue = "";

		// disc_rp
		$this->disc_rp->LinkCustomAttributes = "";
		$this->disc_rp->HrefValue = "";
		$this->disc_rp->TooltipValue = "";

		// voucher_barang
		$this->voucher_barang->LinkCustomAttributes = "";
		$this->voucher_barang->HrefValue = "";
		$this->voucher_barang->TooltipValue = "";

		// komisi_recall
		$this->komisi_recall->LinkCustomAttributes = "";
		$this->komisi_recall->HrefValue = "";
		$this->komisi_recall->TooltipValue = "";

		// subtotal
		$this->subtotal->LinkCustomAttributes = "";
		$this->subtotal->HrefValue = "";
		$this->subtotal->TooltipValue = "";

		// hna
		$this->hna->LinkCustomAttributes = "";
		$this->hna->HrefValue = "";
		$this->hna->TooltipValue = "";

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

		// id_penjualan
		$this->id_penjualan->EditAttrs["class"] = "form-control";
		$this->id_penjualan->EditCustomAttributes = "";
		if ($this->id_penjualan->getSessionValue() != "") {
			$this->id_penjualan->CurrentValue = $this->id_penjualan->getSessionValue();
			$curVal = strval($this->id_penjualan->CurrentValue);
			if ($curVal != "") {
				$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
				if ($this->id_penjualan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_penjualan->ViewValue = $this->id_penjualan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
					}
				}
			} else {
				$this->id_penjualan->ViewValue = NULL;
			}
			$this->id_penjualan->ViewCustomAttributes = "";
		} else {
		}

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// kode_barang
		$this->kode_barang->EditAttrs["class"] = "form-control";
		$this->kode_barang->EditCustomAttributes = "";
		$this->kode_barang->EditValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->PlaceHolder = RemoveHtml($this->kode_barang->caption());

		// nama_barang
		$this->nama_barang->EditAttrs["class"] = "form-control";
		$this->nama_barang->EditCustomAttributes = "";
		$this->nama_barang->EditValue = $this->nama_barang->CurrentValue;
		$this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

		// id_kemasan
		$this->id_kemasan->EditAttrs["class"] = "form-control";
		$this->id_kemasan->EditCustomAttributes = "";

		// harga_jual
		$this->harga_jual->EditAttrs["class"] = "form-control";
		$this->harga_jual->EditCustomAttributes = "readonly";
		$this->harga_jual->EditValue = $this->harga_jual->CurrentValue;
		$this->harga_jual->PlaceHolder = RemoveHtml($this->harga_jual->caption());
		if (strval($this->harga_jual->EditValue) != "" && is_numeric($this->harga_jual->EditValue))
			$this->harga_jual->EditValue = FormatNumber($this->harga_jual->EditValue, -2, -2, -2, -2);
		

		// stok
		$this->stok->EditAttrs["class"] = "form-control";
		$this->stok->EditCustomAttributes = "readonly";
		$this->stok->EditValue = $this->stok->CurrentValue;
		$this->stok->EditValue = FormatNumber($this->stok->EditValue, 2, -2, -2, -2);
		$this->stok->ViewCustomAttributes = "";

		// expired
		$this->expired->EditAttrs["class"] = "form-control";
		$this->expired->EditCustomAttributes = "";
		$this->expired->EditValue = FormatDateTime($this->expired->CurrentValue, 8);
		$this->expired->PlaceHolder = RemoveHtml($this->expired->caption());

		// qty
		$this->qty->EditAttrs["class"] = "form-control";
		$this->qty->EditCustomAttributes = "";
		$this->qty->EditValue = $this->qty->CurrentValue;
		$this->qty->PlaceHolder = RemoveHtml($this->qty->caption());
		if (strval($this->qty->EditValue) != "" && is_numeric($this->qty->EditValue))
			$this->qty->EditValue = FormatNumber($this->qty->EditValue, -2, -2, -2, -2);
		

		// disc_pr
		$this->disc_pr->EditAttrs["class"] = "form-control";
		$this->disc_pr->EditCustomAttributes = "";
		$this->disc_pr->EditValue = $this->disc_pr->CurrentValue;
		$this->disc_pr->PlaceHolder = RemoveHtml($this->disc_pr->caption());
		if (strval($this->disc_pr->EditValue) != "" && is_numeric($this->disc_pr->EditValue))
			$this->disc_pr->EditValue = FormatNumber($this->disc_pr->EditValue, -2, -2, -2, -2);
		

		// disc_rp
		$this->disc_rp->EditAttrs["class"] = "form-control";
		$this->disc_rp->EditCustomAttributes = "";
		$this->disc_rp->EditValue = $this->disc_rp->CurrentValue;
		$this->disc_rp->PlaceHolder = RemoveHtml($this->disc_rp->caption());
		if (strval($this->disc_rp->EditValue) != "" && is_numeric($this->disc_rp->EditValue))
			$this->disc_rp->EditValue = FormatNumber($this->disc_rp->EditValue, -2, -2, -2, -2);
		

		// voucher_barang
		$this->voucher_barang->EditAttrs["class"] = "form-control";
		$this->voucher_barang->EditCustomAttributes = "";
		$this->voucher_barang->EditValue = $this->voucher_barang->CurrentValue;
		$this->voucher_barang->PlaceHolder = RemoveHtml($this->voucher_barang->caption());
		if (strval($this->voucher_barang->EditValue) != "" && is_numeric($this->voucher_barang->EditValue))
			$this->voucher_barang->EditValue = FormatNumber($this->voucher_barang->EditValue, -2, -2, -2, -2);
		

		// komisi_recall
		$this->komisi_recall->EditAttrs["class"] = "form-control";
		$this->komisi_recall->EditCustomAttributes = "";

		// subtotal
		$this->subtotal->EditAttrs["class"] = "form-control";
		$this->subtotal->EditCustomAttributes = "Readonly";
		$this->subtotal->EditValue = $this->subtotal->CurrentValue;
		$this->subtotal->PlaceHolder = RemoveHtml($this->subtotal->caption());
		if (strval($this->subtotal->EditValue) != "" && is_numeric($this->subtotal->EditValue))
			$this->subtotal->EditValue = FormatNumber($this->subtotal->EditValue, -2, -2, -2, -2);
		

		// hna
		$this->hna->EditAttrs["class"] = "form-control";
		$this->hna->EditCustomAttributes = "";
		$this->hna->EditValue = $this->hna->CurrentValue;
		$this->hna->PlaceHolder = RemoveHtml($this->hna->caption());

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
					$doc->exportCaption($this->id_penjualan);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->harga_jual);
					$doc->exportCaption($this->stok);
					$doc->exportCaption($this->qty);
					$doc->exportCaption($this->disc_pr);
					$doc->exportCaption($this->disc_rp);
					$doc->exportCaption($this->voucher_barang);
					$doc->exportCaption($this->komisi_recall);
					$doc->exportCaption($this->subtotal);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->id_penjualan);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->id_kemasan);
					$doc->exportCaption($this->harga_jual);
					$doc->exportCaption($this->expired);
					$doc->exportCaption($this->qty);
					$doc->exportCaption($this->disc_pr);
					$doc->exportCaption($this->disc_rp);
					$doc->exportCaption($this->voucher_barang);
					$doc->exportCaption($this->komisi_recall);
					$doc->exportCaption($this->subtotal);
					$doc->exportCaption($this->hna);
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
						$doc->exportField($this->id_penjualan);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->harga_jual);
						$doc->exportField($this->stok);
						$doc->exportField($this->qty);
						$doc->exportField($this->disc_pr);
						$doc->exportField($this->disc_rp);
						$doc->exportField($this->voucher_barang);
						$doc->exportField($this->komisi_recall);
						$doc->exportField($this->subtotal);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->id_penjualan);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->id_kemasan);
						$doc->exportField($this->harga_jual);
						$doc->exportField($this->expired);
						$doc->exportField($this->qty);
						$doc->exportField($this->disc_pr);
						$doc->exportField($this->disc_rp);
						$doc->exportField($this->voucher_barang);
						$doc->exportField($this->komisi_recall);
						$doc->exportField($this->subtotal);
						$doc->exportField($this->hna);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'detailpenjualan';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'detailpenjualan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$newvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
	{
		global $Language;
		if (!$this->AuditTrailOnEdit)
			return;
		$table = 'detailpenjualan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$usr = CurrentUserName();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
					$modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->phrase("PasswordMask");
						$newvalue = $Language->phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
						if (Config("AUDIT_TRAIL_TO_DATABASE")) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	public function writeAuditTrailOnDelete(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnDelete)
			return;
		$table = 'detailpenjualan';

		// Get key value
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = DbCurrentDateTime();
		$id = ScriptName();
		$curUser = CurrentUserName();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->HtmlTag == "PASSWORD") {
					$oldvalue = $Language->phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_MEMO) {
					if (Config("AUDIT_TRAIL_TO_DATABASE"))
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->DataType == DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
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

	function Row_Inserted($rsold, &$rsnew) {
					$pid_penjualan = $rsnew['id_penjualan'];
					$qty = $rsnew['qty'];
					$id_barang = $rsnew['id_barang'];
					$tanggal = ExecuteScalar("SELECT waktu FROM penjualan WHERE id= '$pid_penjualan'");
					$id_klinik = ExecuteScalar("SELECT id_klinik FROM penjualan WHERE id= '$pid_penjualan'");
					$komposisi = ExecuteScalar("SELECT komposisi FROM m_barang WHERE id='$id_barang'");
					$status_barang = ExecuteScalar("SELECT status_barang FROM m_status_barang WHERE id_status = (SELECT status FROM m_barang WHERE id='$id_barang')");
					$id_rmd = ExecuteScalar("SELECT id_rmd FROM penjualan WHERE id='$pid_penjualan'");
					$sekarang = date('Y-m-d');
					$status =	 ExecuteScalar("SELECT status FROM penjualan WHERE id='$pid_penjualan'");
						if($status == 'Printed' && $status != 'Draft') { //SAVE IF PRINTED

							// if tanggal input < tanggal sekarang

							/* if($tanggal < $sekarang){
								//Barang Komposisi
								if($komposisi == "Yes") {
									$id_komposisi = ExecuteScalar("SELECT id_komposisi FROM komposisi WHERE id_barang = '$id_barang'");
									$sql = Execute("SELECT * FROM detailkomposisi WHERE id_komposisi = '$id_komposisi'"); //query
									if($sql->RecordCount() > 0) {
										$sql->MoveFirst();
										while(!$sql->EOF) {
											//logic
											$id_barang_komposisi = $sql->fields['id_barang'];
											$jumlah = $sql->fields['jumlah'];
											$jumlah_barang_komposisi = $jumlah * $qty;
											//Get stok tanggal = $tanggal 
											$stok_lama_barang_komposisi = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal = '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
											//jika stok tanggal = $tanggal itu tidak ada
											if($stok_lama_barang_komposisi == NULL OR $stok_lama_barang_komposisi == FALSE){
												//get data tanggal sebelumnya
												$stok_sebelumnya_barang_komposisi = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												//jika stok tanggal sebelumnya tidak ada
												if($stok_sebelumnya_barang_komposisi == NULL OR $stok_sebelumnya_barang_komposisi == FALSE){
													//get stok data transaksi stok
													$stok_data = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal ASC LIMIT 1");
													//jika stok data di kartustok tidak ada sama sekali
													if($stok_data == NULL OR $stok_data == FALSE){
														$data_stok_hargajual = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
														$stok_baru_komposisi = $data_stok_hargajual - $jumlah_barang_komposisi;
														// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
														if($stok_baru_komposisi <= 0) {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$data_stok_hargajual', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
														} else {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$data_stok_hargajual', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
														}
														$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
														foreach($data_stok AS $ds){
															$id = $ds['id_kartustok'];
															$stok_awal = 0;
															$stok = $ds['stok_awal'];
															if($stok == NULL OR $stok == FALSE){
																$stok_awal = $stok_baru_komposisi;											
															} else {
																$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
															}
															$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
															Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = $id ");
														}
														$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
														Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");		
													} else {
														$stok_baru_komposisi = $stok_data - $jumlah_barang_komposisi;
														// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
														if($stok_baru_komposisi <= 0) {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
														} else {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
														}
														$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
														foreach($data_stok AS $ds){
															$id = $ds['id_kartustok'];
															$stok_awal = 0;
															$stok = $ds['stok_awal'];											
															if($stok == NULL OR $stok == FALSE){
																$stok_awal = $stok_baru_komposisi;											
															} else {
																$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
															}
															$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
															Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
														}
														$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
														Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");		
													}
												} else {
													$stok_baru_komposisi = $stok_sebelumnya_barang_komposisi - $jumlah_barang_komposisi;
													// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
													if($stok_baru_komposisi <= 0) {
														//insert into kartustok
														$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_sebelumnya_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
													} else {
														//insert into kartustok
														$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_sebelumnya_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
													}
													$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
													foreach($data_stok AS $ds){
														$id = $ds['id_kartustok'];
														$stok_awal = 0;
														$stok = $ds['stok_awal'];											
														if($stok == NULL OR $stok == FALSE){
															$stok_awal = $stok_baru_komposisi;											
														} else {
															$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
														}										
														$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
														Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
													}
													$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
													Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");	
												}
											} else {
												$stok_baru_komposisi = $stok_lama_barang_komposisi - $jumlah_barang_komposisi;
												// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
												if($stok_baru_komposisi <= 0) {
													//insert data ke kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");																	
												} else {
													//insert data ke kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = 0;
													$stok = $ds['stok_awal'];											
													if($stok == NULL OR $stok == FALSE){
														$stok_awal = $stok_baru_komposisi;											
													} else {
														$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
													}
													$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
												}
												$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
											}
											$sql->MoveNext();
										}
										$sql->Close();
									}
								//Barang Promo	
								} else if($status_barang == "Promo") {
									$id_promo = ExecuteScalar("SELECT id_promo FROM promo WHERE id_barang = '$id_barang'");
									$sql = Execute("SELECT * FROM detailpromo WHERE id_promo = '$id_promo'"); //query
									if($sql->RecordCount() > 0) {
										$sql->MoveFirst();
										while(!$sql->EOF) {
											$id_barang_promo = $sql->fields['id_barang'];
											$jumlah = $sql->fields['jumlah'];
											$jumlah_barang_promo = $jumlah * $qty;
											//get data stok where tanggal = $tanggal
											$stok_lama_barang_promo = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal = '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
											//if data stok tanggal = $tanggal NULL
											if($stok_lama_barang_promo == NULL OR $stok_lama_barang_promo == FALSE) {
												//get data stok tanggal sebelumnya
												$stok_lama_barang_promo = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												//if data stok tanggal sebelumnya = NULL
												if($stok_lama_barang_promo == NULL OR $stok_lama_barang_promo == FALSE){
													//get data stok dari kartustok
													$data_stok_awal = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal ASC LIMIT 1");
													//if tidak ada data stok di kartustok
													if($data_stok_awal == NULL OR $data_stok_awal == FALSE){
														$get_stok = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
														$stok_barang_promo = $get_stok - $jumlah_barang_promo;
														if($stok_barang_promo <= 0) {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$get_stok', '$pid_penjualan', '$jumlah_barang_promo', 0)");
														} else {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$get_stok', '$pid_penjualan', '$jumlah_barang_promo', '$stok_barang_promo')");
														}
														$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = $id_barang_promo AND id_klinik = $id_klinik AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
														foreach($data_stok AS $ds){
															$id = $ds['id_kartustok'];
															$stok_awal = 0;
															$stok = $ds['stok_awal'];											
															if($stok == NULL OR $stok == FALSE){
																$stok_awal = $stok_barang_promo;											
															} else {
																$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
															}
															$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
															Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
														}
														$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
														Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
													} else {
														$stok_baru_barang_promo = $data_stok_awal - $jumlah_barang_promo;
														if($stok_baru_barang_promo <= 0) {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$data_stok_awal', '$pid_penjualan', '$jumlah_barang_promo', 0)");
														} else {
															//insert into kartustok
															$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$data_stok_awal', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
														}
														$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
														foreach($data_stok AS $ds){
															$id = $ds['id_kartustok'];
															$stok_awal = 0;
															$stok = $ds['stok_awal'];											
															if($stok == NULL OR $stok == FALSE){
																$stok_awal = $stok_baru_barang_promo;											
															} else {
																$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
															}
															$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
															Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
														}
														$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
														Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
													}
												} else {
													$stok_baru_barang_promo = $stok_lama_barang_promo - $jumlah_barang_promo;
													if($stok_baru_barang_promo <= 0) {
														//insert into kartustok
														$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', 0)");
													} else {
														//insert into kartustok
														$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
													}
													$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY id_kartustok ASC");
													foreach($data_stok AS $ds){
														$id = $ds['id_kartustok'];
														$stok_awal = 0;
														$stok = $ds['stok_awal'];											
														if($stok == NULL OR $stok == FALSE){
															$stok_awal = $stok_baru_barang_promo;											
														} else {
															$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
														}
														$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
														Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
													}
													$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
													Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
												}
											} else {
												$stok_barang = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												$stok_barang_update = $stok_barang - $jumlah_barang_promo;
												$stok_baru_barang_promo = $stok_lama_barang_promo - $jumlah_barang_promo;
												if($stok_baru_barang_promo <= 0) {
													$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', 0)");
												} else {
													$update_stok = Execute("UPDATE m_hargajual SET stok='$stok_barang_update' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = 0;
													$stok = $ds['stok_awal'];											
													if($stok == NULL OR $stok == FALSE){
														$stok_awal = $stok_baru_barang_promo;											
													} else {
														$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
													}									
													$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
													$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
												}
												$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
											}
											$sql->MoveNext();
										}
										$sql->Close();
									}
								//Barang Jual	
								} else {
									//Get stok tanggal = $tanggal
									$stok_tanggal = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal = '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
									//jika tidak ada transaksi stok di tanggal itu
									if($stok_tanggal == NULL OR $stok_tanggal == FALSE) {
										$stok_saldo = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
										$stok_update = $stok_saldo - $qty;
										//get stok tanggal < $tanggal
										$stok_tgl_sebelumnya = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
										//jika tidak ada transaksi stok di tanggal < $tanggal
										if($stok_tgl_sebelumnya == NULL OR $stok_tgl_sebelumnya == FALSE){
											//get stok data transaksi stok
											$stok_data = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' ORDER BY tanggal ASC LIMIT 1");
											//jika tidak ada transaksi stok sama sekali
											if($stok_data == NULL OR $stok_data == FALSE){
												//get data from hargajual
												$stok_hargajual = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
												$stok_terbaru = $stok_hargajual - $qty;
												if ($stok_update <= 0) {
													$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
													// menyimpan transaksi ke kartu stok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal','$stok_hargajual', '$pid_penjualan', '$qty', '0')");
													//print_r($kartu_stok);
												} else {
													$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_terbaru' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
													// menyimpan transaksi ke kartu stok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_hargajual', '$pid_penjualan', '$qty', '$stok_terbaru')");
													//print_r($kartu_stok);
												}
											} else {
												$stok_terbaru = $stok_data - $qty;
												if ($stok_update <= 0) {
													$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
													// menyimpan transaksi ke kartu stok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$qty', '0')");
													//print_r($kartu_stok);
												} else {
													$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_update' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
													// menyimpan transaksi ke kartu stok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$qty', '$stok_terbaru')");
													//print_r($kartu_stok);
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = 0;
													$stok = $ds['stok_awal'];											
													if($stok == NULL OR $stok == FALSE){
														$stok_awal = $stok_terbaru;											
													} else {
														$stok_awal = $ds['stok_awal'] - $qty;
													}
													$stok_akhir = $ds['stok_akhir'] - $qty;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = $id ");
												}
											}
										} else {
											$stok_terbaru = $stok_tgl_sebelumnya - $qty;
											if ($stok_update <= 0) {
												$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
												// menyimpan transaksi ke kartu stok
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tgl_sebelumnya', '$pid_penjualan', '$qty', '0')");
												//print_r($kartu_stok);
											} else {
												$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_update' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
												// menyimpan transaksi ke kartu stok
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tgl_sebelumnya', '$pid_penjualan', '$qty', '$stok_terbaru')");
												//print_r($kartu_stok);
											}
											$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
											foreach($data_stok AS $ds){
												$id = $ds['id_kartustok'];
												$stok_awal = 0;
												$stok = $ds['stok_awal'];											
												if($stok == NULL OR $stok == FALSE){
													$stok_awal = $stok_terbaru;											
												} else {
													$stok_awal = $ds['stok_awal'] - $qty;
												}								
												$stok_akhir = $ds['stok_akhir'] - $qty;
												Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = $id ");
											}
										}
									} else {
										$stok_saldo = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
										$stok_update = $stok_saldo - $qty;
										$stok_terbaru = $stok_tanggal - $qty;
										if ($stok_update <= 0) {
											$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
											// menyimpan transaksi ke kartu stok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tanggal', '$pid_penjualan', '$qty', '0')");
											//print_r($kartu_stok);
										} else {
											$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_update' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
											// menyimpan transaksi ke kartu stok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tanggal', '$pid_penjualan', '$qty', '$stok_terbaru')");
											//print_r($kartu_stok);
										}
										$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
										foreach($data_stok AS $ds){
											$id = $ds['id_kartustok'];
											$stok_awal = 0;
											$stok = $ds['stok_awal'];											
											if($stok == NULL OR $stok == FALSE){
												$stok_awal = $stok_update;											
											} else {
												$stok_awal = $ds['stok_awal'] - $qty;
											}
											$stok_akhir = $ds['stok_akhir'] - $qty;
											Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
										}
									}
								}
							} else { */
								if($komposisi == "Yes") {
									$id_komposisi = ExecuteScalar("SELECT id_komposisi FROM komposisi WHERE id_barang = '$id_barang'");
									$sql = Execute("SELECT * FROM detailkomposisi WHERE id_komposisi = '$id_komposisi'"); //query
									if($sql->RecordCount() > 0) {
										$sql->MoveFirst();
										while(!$sql->EOF) {
											//logic
											$id_barang_komposisi = $sql->fields['id_barang'];
											$jumlah = $sql->fields['jumlah'];
											$jumlah_barang_komposisi = $jumlah * $qty;
											$stok_lama_barang_komposisi = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
											$stok_baru_komposisi = $stok_lama_barang_komposisi - $jumlah_barang_komposisi;
											// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
											if($stok_baru_komposisi <= 0) {
												$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
											} else {
												$update_stok = Execute("UPDATE m_hargajual SET stok = '$stok_baru_komposisi' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
											}
											$sql->MoveNext();
										}
										$sql->Close();
									}
								} else if($status_barang == "Promo") {
									$id_promo = ExecuteScalar("SELECT id_promo FROM promo WHERE id_barang = '$id_barang'");
									$sql = Execute("SELECT * FROM detailpromo WHERE id_promo = '$id_promo'"); //query
									if($sql->RecordCount() > 0) {
										$sql->MoveFirst();
										while(!$sql->EOF) {
											$id_barang_promo = $sql->fields['id_barang'];
											$jumlah = $sql->fields['jumlah'];
											$jumlah_barang_promo = $jumlah * $qty;
											$stok_lama_barang_promo = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
											$stok_baru_barang_promo = $stok_lama_barang_promo - $jumlah_barang_promo;
											if($stok_baru_barang_promo <= 0) {
												$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '0')");
											} else {
												$update_stok = Execute("UPDATE m_hargajual SET stok = '$stok_baru_barang_promo' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
											}
											$sql->MoveNext();
										}
										$sql->Close();
									}
								} else {
									$stok = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
									$stok_terbaru = $stok - $qty;
									if ($stok_terbaru <= 0) {
										$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
										// menyimpan transaksi ke kartu stok
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok', '$pid_penjualan', '$qty', '0')");
										//print_r($kartu_stok);
									} else {
										$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_terbaru' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
										// menyimpan transaksi ke kartu stok
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok', '$pid_penjualan', '$qty', '$stok_terbaru')");
										//print_r($kartu_stok);
									}
								}
							//}
							// menyimpan transaksi ke rekam medis penjualan berdasarkan id rekam medis dokter
							if(!is_null($id_rmd)){
								// if yes, insert to detailrekmedpenjualan
								$insert_barang = Execute("INSERT INTO detailrekmedpenjualan (id_rekmeddok, id_barang, jumlah) VALUES ('$id_rmd', '$id_barang', '$qty')");
							}	
						} //END IF PRINTED
	}
	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {
		// Enter your code here
		// To cancel, set return value to FALSE
		return TRUE;
	}
	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {
			$pid_penjualan = $rsnew['id_penjualan'];
			$qty = $rsnew['qty'];
			$id_barang = $rsnew['id_barang'];
			$tanggal = ExecuteScalar("SELECT waktu FROM penjualan WHERE id='$pid_penjualan'");
			$id_klinik = ExecuteScalar("SELECT id_klinik FROM penjualan WHERE id='$pid_penjualan'");
			$komposisi = ExecuteScalar("SELECT komposisi FROM m_barang WHERE id='$id_barang'");
			$status_barang = ExecuteScalar("SELECT status_barang FROM m_status_barang WHERE id_status = (SELECT status FROM m_barang WHERE id='$id_barang')");
			$id_rmd = ExecuteScalar("SELECT id_rmd FROM penjualan WHERE id='$pid_penjualan'");
			$status = ExecuteScalar("SELECT status FROM penjualan WHERE id='$pid_penjualan'");
				if($status == 'Printed') { //SAVE IF PRINTED
					// if tanggal input < tanggal sekarang

					/*if($tanggal < $sekarang){
						//Barang Komposisi
						if($komposisi == "Yes") {
							$id_komposisi = ExecuteScalar("SELECT id_komposisi FROM komposisi WHERE id_barang = '$id_barang'");
							$sql = Execute("SELECT * FROM detailkomposisi WHERE id_komposisi = '$id_komposisi'"); //query
							if($sql->RecordCount() > 0) {
								$sql->MoveFirst();
								while(!$sql->EOF) {
									//logic
									$id_barang_komposisi = $sql->fields['id_barang'];
									$jumlah = $sql->fields['jumlah'];
									$jumlah_barang_komposisi = $jumlah * $qty;
									//Get stok tanggal = $tanggal 
									$stok_lama_barang_komposisi = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal = '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
									//jika stok tanggal = $tanggal itu tidak ada
									if($stok_lama_barang_komposisi == NULL OR $stok_lama_barang_komposisi == FALSE){
										//get data tanggal sebelumnya
										$stok_sebelumnya_barang_komposisi = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
										//jika stok tanggal sebelumnya tidak ada
										if($stok_sebelumnya_barang_komposisi == NULL OR $stok_sebelumnya_barang_komposisi == FALSE){
											//get stok data transaksi stok
											$stok_data = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal ASC LIMIT 1");
											//jika stok data di kartustok tidak ada sama sekali
											if($stok_data == NULL OR $stok_data == FALSE){
												$data_stok_hargajual = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
												$stok_baru_komposisi = $data_stok_hargajual - $jumlah_barang_komposisi;
												// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
												if($stok_baru_komposisi <= 0) {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$data_stok_hargajual', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
												} else {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$data_stok_hargajual', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
													$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = $id ");
												}
												$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");		
											} else {
												$stok_baru_komposisi = $stok_data - $jumlah_barang_komposisi;
												// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
												if($stok_baru_komposisi <= 0) {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
												} else {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
													$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
												}
												$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");		
											}
										} else {
											$stok_baru_komposisi = $stok_sebelumnya_barang_komposisi - $jumlah_barang_komposisi;
											// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
											if($stok_baru_komposisi <= 0) {
												//insert into kartustok
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_sebelumnya_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
											} else {
												//insert into kartustok
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_sebelumnya_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
											}
											$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
											foreach($data_stok AS $ds){
												$id = $ds['id_kartustok'];
												$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
												$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
												Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
											}
											$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
											Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");	
										}
									} else {
										$stok_baru_komposisi = $stok_lama_barang_komposisi - $jumlah_barang_komposisi;
										// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
										if($stok_baru_komposisi <= 0) {
											//insert data ke kartustok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");																	
										} else {
											//insert data ke kartustok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
										}
										$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
										foreach($data_stok AS $ds){
											$id = $ds['id_kartustok'];
											$stok_awal = $ds['stok_awal'] - $jumlah_barang_komposisi;
											$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_komposisi;
											Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
										}
										$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
										Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
									}
									$sql->MoveNext();
								}
								$sql->Close();
							}
						//Barang Promo	
						} else if($status_barang == "Promo") {
							$id_promo = ExecuteScalar("SELECT id_promo FROM promo WHERE id_barang = '$id_barang'");
							$sql = Execute("SELECT * FROM detailpromo WHERE id_promo = '$id_promo'"); //query
							if($sql->RecordCount() > 0) {
								$sql->MoveFirst();
								while(!$sql->EOF) {
									$id_barang_promo = $sql->fields['id_barang'];
									$jumlah = $sql->fields['jumlah'];
									$jumlah_barang_promo = $jumlah * $qty;
									//get data stok where tanggal = $tanggal
									$stok_lama_barang_promo = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal = '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
									//if data stok tanggal = $tanggal NULL
									if($stok_lama_barang_promo == NULL OR $stok_lama_barang_promo == FALSE) {
										//get data stok tanggal sebelumnya
										$stok_lama_barang_promo = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
										//if data stok tanggal sebelumnya = NULL
										if($stok_lama_barang_promo == NULL OR $stok_lama_barang_promo == FALSE){
											//get data stok dari kartustok
											$data_stok_awal = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal ASC LIMIT 1");
											//if tidak ada data stok di kartustok
											if($data_stok_awal == NULL OR $data_stok_awal == FALSE){
												$get_stok = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
												$stok_barang_promo = $get_stok - $jumlah_barang_promo;
												if($stok_barang_promo <= 0) {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$get_stok', '$pid_penjualan', '$jumlah_barang_promo', 0)");
												} else {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$get_stok', '$pid_penjualan', '$jumlah_barang_promo', '$stok_barang_promo')");
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = $id_barang_promo AND id_klinik = $id_klinik AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
													$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
												}
												$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
											} else {
												$stok_baru_barang_promo = $data_stok_awal - $jumlah_barang_promo;
												if($stok_baru_barang_promo <= 0) {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$data_stok_awal', '$pid_penjualan', '$jumlah_barang_promo', 0)");
												} else {
													//insert into kartustok
													$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$data_stok_awal', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
												}
												$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
												foreach($data_stok AS $ds){
													$id = $ds['id_kartustok'];
													$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
													$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
													Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
												}
												$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
												Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
											}
										} else {
											$stok_baru_barang_promo = $stok_lama_barang_promo - $jumlah_barang_promo;
											if($stok_baru_barang_promo <= 0) {
												//insert into kartustok
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', 0)");
											} else {
												//insert into kartustok
												$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
											}
											$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
											foreach($data_stok AS $ds){
												$id = $ds['id_kartustok'];
												$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
												$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
												Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
											}
											$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
											Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
										}
									} else {
										$stok_barang = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
										$stok_barang_update = $stok_barang - $jumlah_barang_promo;
										$stok_baru_barang_promo = $stok_lama_barang_promo - $jumlah_barang_promo;
										if($stok_baru_barang_promo <= 0) {
											$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', 0)");
										} else {
											$update_stok = Execute("UPDATE m_hargajual SET stok='$stok_barang_update' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
										}
										$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
										foreach($data_stok AS $ds){
											$id = $ds['id_kartustok'];
											$stok_awal = $ds['stok_awal'] - $jumlah_barang_promo;
											$stok_akhir = $ds['stok_akhir'] - $jumlah_barang_promo;
											Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
										}
										$stok_akhir_kartustok = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
										Execute("UPDATE m_hargajual SET stok='$stok_akhir_kartustok' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");						
									}
									$sql->MoveNext();
								}
								$sql->Close();
							}
						//Barang Jual	
						} else {
							//Get stok tanggal = $tanggal
							$stok_tanggal = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal = '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
							//jika tidak ada transaksi stok di tanggal itu
							if($stok_tanggal == NULL OR $stok_tanggal == FALSE) {
								$stok_saldo = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
								$stok_update = $stok_saldo - $qty;
								//get stok tanggal < $tanggal
								$stok_tgl_sebelumnya = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal < '$tanggal' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
								//jika tidak ada transaksi stok di tanggal < $tanggal
								if($stok_tgl_sebelumnya == NULL OR $stok_tgl_sebelumnya == FALSE){
									//get stok data transaksi stok
									$stok_data = ExecuteScalar("SELECT stok_awal FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' ORDER BY tanggal ASC LIMIT 1");
									//jika tidak ada transaksi stok sama sekali
									if($stok_data == NULL OR $stok_data == FALSE){
										//get data from hargajual
										$stok_hargajual = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
										$stok_terbaru = $stok_hargajual - $qty;
										if ($stok_update <= 0) {
											$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
											// menyimpan transaksi ke kartu stok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal','$stok_hargajual', '$pid_penjualan', '$qty', '0')");
											//print_r($kartu_stok);
										} else {
											$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_terbaru' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
											// menyimpan transaksi ke kartu stok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_hargajual', '$pid_penjualan', '$qty', '$stok_terbaru')");
											//print_r($kartu_stok);
										}
									} else {
										$stok_terbaru = $stok_data - $qty;
										if ($stok_update <= 0) {
											$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
											// menyimpan transaksi ke kartu stok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$qty', '0')");
											//print_r($kartu_stok);
										} else {
											$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_update' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
											// menyimpan transaksi ke kartu stok
											$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_data', '$pid_penjualan', '$qty', '$stok_terbaru')");
											//print_r($kartu_stok);
										}
										$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
										foreach($data_stok AS $ds){
											$id = $ds['id_kartustok'];
											$stok_awal = $ds['stok_awal'] - $qty;
											$stok_akhir = $ds['stok_akhir'] - $qty;
											Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = $id ");
										}
									}
								} else {
									$stok_terbaru = $stok_tgl_sebelumnya - $qty;
									if ($stok_update <= 0) {
										$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
										// menyimpan transaksi ke kartu stok
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tgl_sebelumnya', '$pid_penjualan', '$qty', '0')");
										//print_r($kartu_stok);
									} else {
										$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_update' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
										// menyimpan transaksi ke kartu stok
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tgl_sebelumnya', '$pid_penjualan', '$qty', '$stok_terbaru')");
										//print_r($kartu_stok);
									}
									$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggel ASC, id_kartustok ASC");
									foreach($data_stok AS $ds){
										$id = $ds['id_kartustok'];
										$stok_awal = $ds['stok_awal'] - $qty;
										$stok_akhir = $ds['stok_akhir'] - $qty;
										Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = $id ");
									}
								}
							} else {
								$stok_saldo = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
								$stok_update = $stok_saldo - $qty;
								$stok_terbaru = $stok_tanggal - $qty;
								if ($stok_update <= 0) {
									$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
									// menyimpan transaksi ke kartu stok
									$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tanggal', '$pid_penjualan', '$qty', '0')");
									//print_r($kartu_stok);
								} else {
									$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_update' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
									// menyimpan transaksi ke kartu stok
									$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok_tanggal', '$pid_penjualan', '$qty', '$stok_terbaru')");
									//print_r($kartu_stok);
								}
								$data_stok = ExecuteRows("SELECT id_kartustok, stok_awal, stok_akhir FROM kartustok WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik' AND tanggal > '$tanggal' ORDER BY tanggal ASC, id_kartustok ASC");
								foreach($data_stok AS $ds){
									$id = $ds['id_kartustok'];
									$stok_awal = $ds['stok_awal'] - $qty;
									$stok_akhir = $ds['stok_akhir'] - $qty;
									Execute("UPDATE kartustok SET stok_awal = '$stok_awal', stok_akhir = '$stok_akhir' WHERE id_kartustok = '$id' ");
								}
							}
						}
					} else {*/
						if($komposisi == "Yes") {
							$id_komposisi = ExecuteScalar("SELECT id_komposisi FROM komposisi WHERE id_barang = '$id_barang'");
							$sql = Execute("SELECT * FROM detailkomposisi WHERE id_komposisi = '$id_komposisi'"); //query
							if($sql->RecordCount() > 0) {
								$sql->MoveFirst();
								while(!$sql->EOF) {
									//logic
									$id_barang_komposisi = $sql->fields['id_barang'];
									$jumlah = $sql->fields['jumlah'];
									$jumlah_barang_komposisi = $jumlah * $qty;
									$stok_lama_barang_komposisi = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
									$stok_baru_komposisi = $stok_lama_barang_komposisi - $jumlah_barang_komposisi;
									// if stok_lama_barang_komposisi - jumlah_barang_komposisi < 0, stok skrng = 0
									if($stok_baru_komposisi <= 0) {
										$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '0')");
									} else {
										$update_stok = Execute("UPDATE m_hargajual SET stok = '$stok_baru_komposisi' WHERE id_barang = '$id_barang_komposisi' AND id_klinik = '$id_klinik'");
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_komposisi', '$id_klinik', '$tanggal', '$stok_lama_barang_komposisi', '$pid_penjualan', '$jumlah_barang_komposisi', '$stok_baru_komposisi')");
									}
									$sql->MoveNext();
								}
								$sql->Close();
							}
						} else if($status_barang == "Promo") {
							$id_promo = ExecuteScalar("SELECT id_promo FROM promo WHERE id_barang = '$id_barang'");
							$sql = Execute("SELECT * FROM detailpromo WHERE id_promo = '$id_promo'"); //query
							if($sql->RecordCount() > 0) {
								$sql->MoveFirst();
								while(!$sql->EOF) {
									$id_barang_promo = $sql->fields['id_barang'];
									$jumlah = $sql->fields['jumlah'];
									$jumlah_barang_promo = $jumlah * $qty;
									$stok_lama_barang_promo = ExecuteScalar("SELECT stok_akhir FROM kartustok WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik' ORDER BY tanggal DESC, id_kartustok DESC LIMIT 1");
									$stok_baru_barang_promo = $stok_lama_barang_promo - $jumlah_barang_promo;
									if($stok_baru_barang_promo <= 0) {
										$update_stok = Execute("UPDATE m_hargajual SET stok=0 WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '0')");
									} else {
										$update_stok = Execute("UPDATE m_hargajual SET stok = '$stok_baru_barang_promo' WHERE id_barang = '$id_barang_promo' AND id_klinik = '$id_klinik'");
										$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang_promo', '$id_klinik', '$tanggal', '$stok_lama_barang_promo', '$pid_penjualan', '$jumlah_barang_promo', '$stok_baru_barang_promo')");
									}
									$sql->MoveNext();
								}
								$sql->Close();
							}
						} else {
							$stok = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
							$stok_terbaru = $stok - $qty;
							if ($stok_terbaru <= 0) {
								$update_saldo = Execute("UPDATE m_hargajual SET stok='0' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
								// menyimpan transaksi ke kartu stok
								$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok', '$pid_penjualan', '$qty', '0')");
								//print_r($kartu_stok);
							} else {
								$update_saldo = Execute("UPDATE m_hargajual SET stok = '$stok_terbaru' WHERE id_klinik = '$id_klinik' AND id_barang = '$id_barang'");
								// menyimpan transaksi ke kartu stok
								$kartu_stok = Execute("INSERT INTO kartustok (id_barang, id_klinik, tanggal, stok_awal, id_penjualan, keluar, stok_akhir) VALUES ('$id_barang', '$id_klinik', '$tanggal', '$stok', '$pid_penjualan', '$qty', '$stok_terbaru')");
								//print_r($kartu_stok);
							}
						}
					//}
					// menyimpan transaksi ke rekam medis penjualan berdasarkan id rekam medis dokter
					if(!is_null($id_rmd)){
						// if yes, insert to detailrekmedpenjualan
						$insert_barang = Execute("INSERT INTO detailrekmedpenjualan (id_rekmeddok, id_barang, jumlah) VALUES ('$id_rmd', '$id_barang', '$qty')");
					}	
				} //END IF PRINTED
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
		$rsnew = $this->GetGridFormValues(); // Get the form values of the new records as an array of array
		//var_dump($rsnew); exit();
		if(empty($rsnew)){
			$this->setFailureMessage("Data barang belum masuk!");
			return FALSE;
		} else {
			// check apabila promo masih berlaku apa tidak
			foreach($rsnew as $row) {
				$id_barang = $row["id_barang"];
				$tgl_hari_ini = CurrentDate();
				$status_barang = ExecuteScalar("SELECT status_barang FROM m_status_barang WHERE id_status = (SELECT status FROM m_barang WHERE id=$id_barang)");
				if ($status_barang == 'Promo') {
					$nama = ExecuteScalar("SELECT nama FROM promo WHERE id_barang=$id_barang");
					$tgl_mulai_promo = ExecuteScalar("SELECT tanggal_mulai FROM promo WHERE id_barang=$id_barang");
					$tgl_berakhir_promo = ExecuteScalar("SELECT tanggal_berakhir FROM promo WHERE id_barang=$id_barang");
					if($tgl_hari_ini < $tgl_mulai_promo || $tgl_hari_ini > $tgl_berakhir_promo) {
						$this->setFailureMessage("'" . $nama . "' sudah tidak berlaku."); 	// Return error 
						return FALSE;
					}
				}
			}
		}
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
		$rsnew = $this->GetGridFormValues(); // Get the form values of the new records as an array of array
		//var_dump($rsnew); exit();
		if(empty($rsnew)){
			$this->setFailureMessage("Data barang belum masuk!");
			return FALSE;
		}
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
		//$this->id_barang->Visible = FALSE;
		//$this->id_barang->Header = FALSE;
		$valuesubtotal = $this->subtotal->CurrentValue;
		$valuesubtotal1 = str_replace(".", "", $valuesubtotal);
		$this->subtotal->EditValue = $valuesubtotal1;
	}
	// User ID Filtering event
	function UserID_Filtering(&$filter) {
		// Enter your code here
	}
}
?>