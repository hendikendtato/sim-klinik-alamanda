<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for view_rm_pasien
 */
class view_rm_pasien extends DbTable
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
	public $noktp_pelanggan;
	public $id_penjualan;
	public $kode_penjualan;
	public $waktu;
	public $id_klinik;
	public $id_barang;
	public $kode_barang;
	public $nama_barang;
	public $harga_jual;
	public $qty;
	public $subtotal;
	public $nama_klinik;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'view_rm_pasien';
		$this->TableName = 'view_rm_pasien';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`view_rm_pasien`";
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
		$this->id_pelanggan = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 11, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_pelanggan->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_pelanggan->IsPrimaryKey = TRUE; // Primary key field
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// nama_pelanggan
		$this->nama_pelanggan = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_nama_pelanggan', 'nama_pelanggan', '`nama_pelanggan`', '`nama_pelanggan`', 200, 255, -1, FALSE, '`nama_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->nama_pelanggan->Required = TRUE; // Required field
		$this->nama_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['nama_pelanggan'] = &$this->nama_pelanggan;

		// noktp_pelanggan
		$this->noktp_pelanggan = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_noktp_pelanggan', 'noktp_pelanggan', '`noktp_pelanggan`', '`noktp_pelanggan`', 200, 255, -1, FALSE, '`noktp_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->noktp_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->noktp_pelanggan->Required = TRUE; // Required field
		$this->noktp_pelanggan->Sortable = TRUE; // Allow sort
		$this->fields['noktp_pelanggan'] = &$this->noktp_pelanggan;

		// id_penjualan
		$this->id_penjualan = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_id_penjualan', 'id_penjualan', '`id_penjualan`', '`id_penjualan`', 3, 11, -1, FALSE, '`id_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_penjualan->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_penjualan->IsPrimaryKey = TRUE; // Primary key field
		$this->id_penjualan->Sortable = TRUE; // Allow sort
		$this->id_penjualan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_penjualan'] = &$this->id_penjualan;

		// kode_penjualan
		$this->kode_penjualan = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_kode_penjualan', 'kode_penjualan', '`kode_penjualan`', '`kode_penjualan`', 200, 100, -1, FALSE, '`kode_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_penjualan->Nullable = FALSE; // NOT NULL field
		$this->kode_penjualan->Required = TRUE; // Required field
		$this->kode_penjualan->Sortable = TRUE; // Allow sort
		$this->fields['kode_penjualan'] = &$this->kode_penjualan;

		// waktu
		$this->waktu = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_waktu', 'waktu', '`waktu`', CastDateFieldForLike("`waktu`", 0, "DB"), 133, 10, 0, FALSE, '`waktu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->waktu->Nullable = FALSE; // NOT NULL field
		$this->waktu->Required = TRUE; // Required field
		$this->waktu->Sortable = TRUE; // Allow sort
		$this->waktu->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['waktu'] = &$this->waktu;

		// id_klinik
		$this->id_klinik = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Required = TRUE; // Required field
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// id_barang
		$this->id_barang = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// kode_barang
		$this->kode_barang = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_kode_barang', 'kode_barang', '`kode_barang`', '`kode_barang`', 200, 255, -1, FALSE, '`kode_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_barang->Sortable = TRUE; // Allow sort
		$this->fields['kode_barang'] = &$this->kode_barang;

		// nama_barang
		$this->nama_barang = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 255, -1, FALSE, '`nama_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_barang->Sortable = TRUE; // Allow sort
		$this->fields['nama_barang'] = &$this->nama_barang;

		// harga_jual
		$this->harga_jual = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_harga_jual', 'harga_jual', '`harga_jual`', '`harga_jual`', 5, 22, -1, FALSE, '`harga_jual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->harga_jual->Nullable = FALSE; // NOT NULL field
		$this->harga_jual->Required = TRUE; // Required field
		$this->harga_jual->Sortable = TRUE; // Allow sort
		$this->harga_jual->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['harga_jual'] = &$this->harga_jual;

		// qty
		$this->qty = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_qty', 'qty', '`qty`', '`qty`', 5, 22, -1, FALSE, '`qty`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->qty->Nullable = FALSE; // NOT NULL field
		$this->qty->Sortable = TRUE; // Allow sort
		$this->qty->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['qty'] = &$this->qty;

		// subtotal
		$this->subtotal = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_subtotal', 'subtotal', '`subtotal`', '`subtotal`', 5, 22, -1, FALSE, '`subtotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->subtotal->Sortable = TRUE; // Allow sort
		$this->subtotal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['subtotal'] = &$this->subtotal;

		// nama_klinik
		$this->nama_klinik = new DbField('view_rm_pasien', 'view_rm_pasien', 'x_nama_klinik', 'nama_klinik', '`nama_klinik`', '`nama_klinik`', 200, 255, -1, FALSE, '`nama_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_klinik->Sortable = TRUE; // Allow sort
		$this->fields['nama_klinik'] = &$this->nama_klinik;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`view_rm_pasien`";
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
			$this->id_penjualan->setDbValue($conn->insert_ID());
			$rs['id_penjualan'] = $this->id_penjualan->DbValue;
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
			if (array_key_exists('id_penjualan', $rs))
				AddFilter($where, QuotedName('id_penjualan', $this->Dbid) . '=' . QuotedValue($rs['id_penjualan'], $this->id_penjualan->DataType, $this->Dbid));
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
		$this->noktp_pelanggan->DbValue = $row['noktp_pelanggan'];
		$this->id_penjualan->DbValue = $row['id_penjualan'];
		$this->kode_penjualan->DbValue = $row['kode_penjualan'];
		$this->waktu->DbValue = $row['waktu'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->kode_barang->DbValue = $row['kode_barang'];
		$this->nama_barang->DbValue = $row['nama_barang'];
		$this->harga_jual->DbValue = $row['harga_jual'];
		$this->qty->DbValue = $row['qty'];
		$this->subtotal->DbValue = $row['subtotal'];
		$this->nama_klinik->DbValue = $row['nama_klinik'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_pelanggan` = @id_pelanggan@ AND `id_penjualan` = @id_penjualan@";
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
			$val = array_key_exists('id_penjualan', $row) ? $row['id_penjualan'] : NULL;
		else
			$val = $this->id_penjualan->OldValue !== NULL ? $this->id_penjualan->OldValue : $this->id_penjualan->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_penjualan@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "view_rm_pasienlist.php";
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
		if ($pageName == "view_rm_pasienview.php")
			return $Language->phrase("View");
		elseif ($pageName == "view_rm_pasienedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "view_rm_pasienadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "view_rm_pasienlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("view_rm_pasienview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("view_rm_pasienview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "view_rm_pasienadd.php?" . $this->getUrlParm($parm);
		else
			$url = "view_rm_pasienadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("view_rm_pasienedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("view_rm_pasienadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("view_rm_pasiendelete.php", $this->getUrlParm());
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
		$json .= ",id_penjualan:" . JsonEncode($this->id_penjualan->CurrentValue, "number");
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
		if ($this->id_penjualan->CurrentValue != NULL) {
			$url .= "&id_penjualan=" . urlencode($this->id_penjualan->CurrentValue);
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
			if (Param("id_penjualan") !== NULL)
				$arKey[] = Param("id_penjualan");
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
				if (!is_numeric($key[1])) // id_penjualan
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
				$this->id_penjualan->CurrentValue = $key[1];
			else
				$this->id_penjualan->OldValue = $key[1];
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
		$this->noktp_pelanggan->setDbValue($rs->fields('noktp_pelanggan'));
		$this->id_penjualan->setDbValue($rs->fields('id_penjualan'));
		$this->kode_penjualan->setDbValue($rs->fields('kode_penjualan'));
		$this->waktu->setDbValue($rs->fields('waktu'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->kode_barang->setDbValue($rs->fields('kode_barang'));
		$this->nama_barang->setDbValue($rs->fields('nama_barang'));
		$this->harga_jual->setDbValue($rs->fields('harga_jual'));
		$this->qty->setDbValue($rs->fields('qty'));
		$this->subtotal->setDbValue($rs->fields('subtotal'));
		$this->nama_klinik->setDbValue($rs->fields('nama_klinik'));
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
		// noktp_pelanggan
		// id_penjualan
		// kode_penjualan
		// waktu
		// id_klinik
		// id_barang
		// kode_barang
		// nama_barang
		// harga_jual
		// qty
		// subtotal
		// nama_klinik
		// id_pelanggan

		$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewCustomAttributes = "";

		// nama_pelanggan
		$this->nama_pelanggan->ViewValue = $this->nama_pelanggan->CurrentValue;
		$this->nama_pelanggan->ViewCustomAttributes = "";

		// noktp_pelanggan
		$this->noktp_pelanggan->ViewValue = $this->noktp_pelanggan->CurrentValue;
		$this->noktp_pelanggan->ViewCustomAttributes = "";

		// id_penjualan
		$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
		$this->id_penjualan->ViewCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->ViewCustomAttributes = "";

		// waktu
		$this->waktu->ViewValue = $this->waktu->CurrentValue;
		$this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 0);
		$this->waktu->ViewCustomAttributes = "";

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

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$this->id_barang->ViewValue = FormatNumber($this->id_barang->ViewValue, 0, -2, -2, -2);
		$this->id_barang->ViewCustomAttributes = "";

		// kode_barang
		$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->ViewCustomAttributes = "";

		// nama_barang
		$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
		$this->nama_barang->ViewCustomAttributes = "";

		// harga_jual
		$this->harga_jual->ViewValue = $this->harga_jual->CurrentValue;
		$this->harga_jual->ViewValue = FormatNumber($this->harga_jual->ViewValue, 0, -2, -2, -2);
		$this->harga_jual->ViewCustomAttributes = "";

		// qty
		$this->qty->ViewValue = $this->qty->CurrentValue;
		$this->qty->ViewValue = FormatNumber($this->qty->ViewValue, 2, -2, -2, -2);
		$this->qty->ViewCustomAttributes = "";

		// subtotal
		$this->subtotal->ViewValue = $this->subtotal->CurrentValue;
		$this->subtotal->ViewValue = FormatNumber($this->subtotal->ViewValue, 0, -2, -2, -2);
		$this->subtotal->ViewCustomAttributes = "";

		// nama_klinik
		$this->nama_klinik->ViewValue = $this->nama_klinik->CurrentValue;
		$this->nama_klinik->ViewCustomAttributes = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// nama_pelanggan
		$this->nama_pelanggan->LinkCustomAttributes = "";
		$this->nama_pelanggan->HrefValue = "";
		$this->nama_pelanggan->TooltipValue = "";

		// noktp_pelanggan
		$this->noktp_pelanggan->LinkCustomAttributes = "";
		$this->noktp_pelanggan->HrefValue = "";
		$this->noktp_pelanggan->TooltipValue = "";

		// id_penjualan
		$this->id_penjualan->LinkCustomAttributes = "";
		$this->id_penjualan->HrefValue = "";
		$this->id_penjualan->TooltipValue = "";

		// kode_penjualan
		$this->kode_penjualan->LinkCustomAttributes = "";
		$this->kode_penjualan->HrefValue = "";
		$this->kode_penjualan->TooltipValue = "";

		// waktu
		$this->waktu->LinkCustomAttributes = "";
		$this->waktu->HrefValue = "";
		$this->waktu->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

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

		// harga_jual
		$this->harga_jual->LinkCustomAttributes = "";
		$this->harga_jual->HrefValue = "";
		$this->harga_jual->TooltipValue = "";

		// qty
		$this->qty->LinkCustomAttributes = "";
		$this->qty->HrefValue = "";
		$this->qty->TooltipValue = "";

		// subtotal
		$this->subtotal->LinkCustomAttributes = "";
		$this->subtotal->HrefValue = "";
		$this->subtotal->TooltipValue = "";

		// nama_klinik
		$this->nama_klinik->LinkCustomAttributes = "";
		$this->nama_klinik->HrefValue = "";
		$this->nama_klinik->TooltipValue = "";

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

		// noktp_pelanggan
		$this->noktp_pelanggan->EditAttrs["class"] = "form-control";
		$this->noktp_pelanggan->EditCustomAttributes = "";
		if (!$this->noktp_pelanggan->Raw)
			$this->noktp_pelanggan->CurrentValue = HtmlDecode($this->noktp_pelanggan->CurrentValue);
		$this->noktp_pelanggan->EditValue = $this->noktp_pelanggan->CurrentValue;
		$this->noktp_pelanggan->PlaceHolder = RemoveHtml($this->noktp_pelanggan->caption());

		// id_penjualan
		$this->id_penjualan->EditAttrs["class"] = "form-control";
		$this->id_penjualan->EditCustomAttributes = "";
		$this->id_penjualan->EditValue = $this->id_penjualan->CurrentValue;
		$this->id_penjualan->ViewCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->EditAttrs["class"] = "form-control";
		$this->kode_penjualan->EditCustomAttributes = "";
		if (!$this->kode_penjualan->Raw)
			$this->kode_penjualan->CurrentValue = HtmlDecode($this->kode_penjualan->CurrentValue);
		$this->kode_penjualan->EditValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

		// waktu
		$this->waktu->EditAttrs["class"] = "form-control";
		$this->waktu->EditCustomAttributes = "";
		$this->waktu->EditValue = FormatDateTime($this->waktu->CurrentValue, 8);
		$this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

		// id_klinik
		$this->id_klinik->EditCustomAttributes = "";

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";
		$this->id_barang->EditValue = $this->id_barang->CurrentValue;
		$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

		// kode_barang
		$this->kode_barang->EditAttrs["class"] = "form-control";
		$this->kode_barang->EditCustomAttributes = "";
		if (!$this->kode_barang->Raw)
			$this->kode_barang->CurrentValue = HtmlDecode($this->kode_barang->CurrentValue);
		$this->kode_barang->EditValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->PlaceHolder = RemoveHtml($this->kode_barang->caption());

		// nama_barang
		$this->nama_barang->EditAttrs["class"] = "form-control";
		$this->nama_barang->EditCustomAttributes = "";
		if (!$this->nama_barang->Raw)
			$this->nama_barang->CurrentValue = HtmlDecode($this->nama_barang->CurrentValue);
		$this->nama_barang->EditValue = $this->nama_barang->CurrentValue;
		$this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

		// harga_jual
		$this->harga_jual->EditAttrs["class"] = "form-control";
		$this->harga_jual->EditCustomAttributes = "";
		$this->harga_jual->EditValue = $this->harga_jual->CurrentValue;
		$this->harga_jual->PlaceHolder = RemoveHtml($this->harga_jual->caption());
		if (strval($this->harga_jual->EditValue) != "" && is_numeric($this->harga_jual->EditValue))
			$this->harga_jual->EditValue = FormatNumber($this->harga_jual->EditValue, -2, -2, -2, -2);
		

		// qty
		$this->qty->EditAttrs["class"] = "form-control";
		$this->qty->EditCustomAttributes = "";
		$this->qty->EditValue = $this->qty->CurrentValue;
		$this->qty->PlaceHolder = RemoveHtml($this->qty->caption());
		if (strval($this->qty->EditValue) != "" && is_numeric($this->qty->EditValue))
			$this->qty->EditValue = FormatNumber($this->qty->EditValue, -2, -2, -2, -2);
		

		// subtotal
		$this->subtotal->EditAttrs["class"] = "form-control";
		$this->subtotal->EditCustomAttributes = "";
		$this->subtotal->EditValue = $this->subtotal->CurrentValue;
		$this->subtotal->PlaceHolder = RemoveHtml($this->subtotal->caption());
		if (strval($this->subtotal->EditValue) != "" && is_numeric($this->subtotal->EditValue))
			$this->subtotal->EditValue = FormatNumber($this->subtotal->EditValue, -2, -2, -2, -2);
		

		// nama_klinik
		$this->nama_klinik->EditAttrs["class"] = "form-control";
		$this->nama_klinik->EditCustomAttributes = "";
		if (!$this->nama_klinik->Raw)
			$this->nama_klinik->CurrentValue = HtmlDecode($this->nama_klinik->CurrentValue);
		$this->nama_klinik->EditValue = $this->nama_klinik->CurrentValue;
		$this->nama_klinik->PlaceHolder = RemoveHtml($this->nama_klinik->caption());

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
					$doc->exportCaption($this->noktp_pelanggan);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->waktu);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->harga_jual);
					$doc->exportCaption($this->qty);
					$doc->exportCaption($this->subtotal);
					$doc->exportCaption($this->nama_klinik);
				} else {
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->nama_pelanggan);
					$doc->exportCaption($this->noktp_pelanggan);
					$doc->exportCaption($this->id_penjualan);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->waktu);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
					$doc->exportCaption($this->harga_jual);
					$doc->exportCaption($this->qty);
					$doc->exportCaption($this->subtotal);
					$doc->exportCaption($this->nama_klinik);
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
						$doc->exportField($this->noktp_pelanggan);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->waktu);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->harga_jual);
						$doc->exportField($this->qty);
						$doc->exportField($this->subtotal);
						$doc->exportField($this->nama_klinik);
					} else {
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->nama_pelanggan);
						$doc->exportField($this->noktp_pelanggan);
						$doc->exportField($this->id_penjualan);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->waktu);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
						$doc->exportField($this->harga_jual);
						$doc->exportField($this->qty);
						$doc->exportField($this->subtotal);
						$doc->exportField($this->nama_klinik);
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