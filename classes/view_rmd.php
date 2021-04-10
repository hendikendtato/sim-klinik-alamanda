<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for view_rmd
 */
class view_rmd extends DbTable
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
	public $id_rekmeddok;
	public $kode_rekmeddok;
	public $tanggal;
	public $id_pelanggan;
	public $id_dokter;
	public $id_be;
	public $keluhan;
	public $gejala_klinis;
	public $terapi;
	public $tindakan;
	public $id_pemobat;
	public $id_barang;
	public $jumlah;
	public $satuan;
	public $kode_barang;
	public $nama_barang;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'view_rmd';
		$this->TableName = 'view_rmd';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`view_rmd`";
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

		// id_rekmeddok
		$this->id_rekmeddok = new DbField('view_rmd', 'view_rmd', 'x_id_rekmeddok', 'id_rekmeddok', '`id_rekmeddok`', '`id_rekmeddok`', 3, 11, -1, FALSE, '`id_rekmeddok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_rekmeddok->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_rekmeddok->IsPrimaryKey = TRUE; // Primary key field
		$this->id_rekmeddok->Sortable = TRUE; // Allow sort
		$this->id_rekmeddok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_rekmeddok'] = &$this->id_rekmeddok;

		// kode_rekmeddok
		$this->kode_rekmeddok = new DbField('view_rmd', 'view_rmd', 'x_kode_rekmeddok', 'kode_rekmeddok', '`kode_rekmeddok`', '`kode_rekmeddok`', 200, 50, -1, FALSE, '`kode_rekmeddok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_rekmeddok->Sortable = TRUE; // Allow sort
		$this->fields['kode_rekmeddok'] = &$this->kode_rekmeddok;

		// tanggal
		$this->tanggal = new DbField('view_rmd', 'view_rmd', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 135, 19, 0, FALSE, '`tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal->Sortable = TRUE; // Allow sort
		$this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tanggal'] = &$this->tanggal;

		// id_pelanggan
		$this->id_pelanggan = new DbField('view_rmd', 'view_rmd', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 255, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// id_dokter
		$this->id_dokter = new DbField('view_rmd', 'view_rmd', 'x_id_dokter', 'id_dokter', '`id_dokter`', '`id_dokter`', 3, 11, -1, FALSE, '`id_dokter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_dokter->Sortable = TRUE; // Allow sort
		$this->id_dokter->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_dokter'] = &$this->id_dokter;

		// id_be
		$this->id_be = new DbField('view_rmd', 'view_rmd', 'x_id_be', 'id_be', '`id_be`', '`id_be`', 3, 11, -1, FALSE, '`id_be`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_be->Sortable = TRUE; // Allow sort
		$this->id_be->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_be'] = &$this->id_be;

		// keluhan
		$this->keluhan = new DbField('view_rmd', 'view_rmd', 'x_keluhan', 'keluhan', '`keluhan`', '`keluhan`', 201, 65535, -1, FALSE, '`keluhan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keluhan->Sortable = TRUE; // Allow sort
		$this->fields['keluhan'] = &$this->keluhan;

		// gejala_klinis
		$this->gejala_klinis = new DbField('view_rmd', 'view_rmd', 'x_gejala_klinis', 'gejala_klinis', '`gejala_klinis`', '`gejala_klinis`', 201, 65535, -1, FALSE, '`gejala_klinis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->gejala_klinis->Sortable = TRUE; // Allow sort
		$this->fields['gejala_klinis'] = &$this->gejala_klinis;

		// terapi
		$this->terapi = new DbField('view_rmd', 'view_rmd', 'x_terapi', 'terapi', '`terapi`', '`terapi`', 201, 65535, -1, FALSE, '`terapi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->terapi->Sortable = TRUE; // Allow sort
		$this->fields['terapi'] = &$this->terapi;

		// tindakan
		$this->tindakan = new DbField('view_rmd', 'view_rmd', 'x_tindakan', 'tindakan', '`tindakan`', '`tindakan`', 201, 65535, -1, FALSE, '`tindakan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->tindakan->Sortable = TRUE; // Allow sort
		$this->fields['tindakan'] = &$this->tindakan;

		// id_pemobat
		$this->id_pemobat = new DbField('view_rmd', 'view_rmd', 'x_id_pemobat', 'id_pemobat', '`id_pemobat`', '`id_pemobat`', 3, 11, -1, FALSE, '`id_pemobat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_pemobat->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_pemobat->IsPrimaryKey = TRUE; // Primary key field
		$this->id_pemobat->Sortable = TRUE; // Allow sort
		$this->id_pemobat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pemobat'] = &$this->id_pemobat;

		// id_barang
		$this->id_barang = new DbField('view_rmd', 'view_rmd', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// jumlah
		$this->jumlah = new DbField('view_rmd', 'view_rmd', 'x_jumlah', 'jumlah', '`jumlah`', '`jumlah`', 5, 22, -1, FALSE, '`jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah->Sortable = TRUE; // Allow sort
		$this->jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['jumlah'] = &$this->jumlah;

		// satuan
		$this->satuan = new DbField('view_rmd', 'view_rmd', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 3, 11, -1, FALSE, '`satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->satuan->Sortable = TRUE; // Allow sort
		$this->satuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['satuan'] = &$this->satuan;

		// kode_barang
		$this->kode_barang = new DbField('view_rmd', 'view_rmd', 'x_kode_barang', 'kode_barang', '`kode_barang`', '`kode_barang`', 200, 255, -1, FALSE, '`kode_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_barang->Sortable = TRUE; // Allow sort
		$this->fields['kode_barang'] = &$this->kode_barang;

		// nama_barang
		$this->nama_barang = new DbField('view_rmd', 'view_rmd', 'x_nama_barang', 'nama_barang', '`nama_barang`', '`nama_barang`', 200, 255, -1, FALSE, '`nama_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_barang->Sortable = TRUE; // Allow sort
		$this->fields['nama_barang'] = &$this->nama_barang;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`view_rmd`";
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
			$this->id_rekmeddok->setDbValue($conn->insert_ID());
			$rs['id_rekmeddok'] = $this->id_rekmeddok->DbValue;

			// Get insert id if necessary
			$this->id_pemobat->setDbValue($conn->insert_ID());
			$rs['id_pemobat'] = $this->id_pemobat->DbValue;
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
			if (array_key_exists('id_rekmeddok', $rs))
				AddFilter($where, QuotedName('id_rekmeddok', $this->Dbid) . '=' . QuotedValue($rs['id_rekmeddok'], $this->id_rekmeddok->DataType, $this->Dbid));
			if (array_key_exists('id_pemobat', $rs))
				AddFilter($where, QuotedName('id_pemobat', $this->Dbid) . '=' . QuotedValue($rs['id_pemobat'], $this->id_pemobat->DataType, $this->Dbid));
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
		$this->id_rekmeddok->DbValue = $row['id_rekmeddok'];
		$this->kode_rekmeddok->DbValue = $row['kode_rekmeddok'];
		$this->tanggal->DbValue = $row['tanggal'];
		$this->id_pelanggan->DbValue = $row['id_pelanggan'];
		$this->id_dokter->DbValue = $row['id_dokter'];
		$this->id_be->DbValue = $row['id_be'];
		$this->keluhan->DbValue = $row['keluhan'];
		$this->gejala_klinis->DbValue = $row['gejala_klinis'];
		$this->terapi->DbValue = $row['terapi'];
		$this->tindakan->DbValue = $row['tindakan'];
		$this->id_pemobat->DbValue = $row['id_pemobat'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->jumlah->DbValue = $row['jumlah'];
		$this->satuan->DbValue = $row['satuan'];
		$this->kode_barang->DbValue = $row['kode_barang'];
		$this->nama_barang->DbValue = $row['nama_barang'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_rekmeddok` = @id_rekmeddok@ AND `id_pemobat` = @id_pemobat@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_rekmeddok', $row) ? $row['id_rekmeddok'] : NULL;
		else
			$val = $this->id_rekmeddok->OldValue !== NULL ? $this->id_rekmeddok->OldValue : $this->id_rekmeddok->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_rekmeddok@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		if (is_array($row))
			$val = array_key_exists('id_pemobat', $row) ? $row['id_pemobat'] : NULL;
		else
			$val = $this->id_pemobat->OldValue !== NULL ? $this->id_pemobat->OldValue : $this->id_pemobat->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_pemobat@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "view_rmdlist.php";
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
		if ($pageName == "view_rmdview.php")
			return $Language->phrase("View");
		elseif ($pageName == "view_rmdedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "view_rmdadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "view_rmdlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("view_rmdview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("view_rmdview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "view_rmdadd.php?" . $this->getUrlParm($parm);
		else
			$url = "view_rmdadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("view_rmdedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("view_rmdadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("view_rmddelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_rekmeddok:" . JsonEncode($this->id_rekmeddok->CurrentValue, "number");
		$json .= ",id_pemobat:" . JsonEncode($this->id_pemobat->CurrentValue, "number");
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
		if ($this->id_rekmeddok->CurrentValue != NULL) {
			$url .= "id_rekmeddok=" . urlencode($this->id_rekmeddok->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		if ($this->id_pemobat->CurrentValue != NULL) {
			$url .= "&id_pemobat=" . urlencode($this->id_pemobat->CurrentValue);
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
			if (Param("id_rekmeddok") !== NULL)
				$arKey[] = Param("id_rekmeddok");
			elseif (IsApi() && Key(0) !== NULL)
				$arKey[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKey[] = Route(2);
			else
				$arKeys = NULL; // Do not setup
			if (Param("id_pemobat") !== NULL)
				$arKey[] = Param("id_pemobat");
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
				if (!is_numeric($key[0])) // id_rekmeddok
					continue;
				if (!is_numeric($key[1])) // id_pemobat
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
				$this->id_rekmeddok->CurrentValue = $key[0];
			else
				$this->id_rekmeddok->OldValue = $key[0];
			if ($setCurrent)
				$this->id_pemobat->CurrentValue = $key[1];
			else
				$this->id_pemobat->OldValue = $key[1];
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
		$this->id_rekmeddok->setDbValue($rs->fields('id_rekmeddok'));
		$this->kode_rekmeddok->setDbValue($rs->fields('kode_rekmeddok'));
		$this->tanggal->setDbValue($rs->fields('tanggal'));
		$this->id_pelanggan->setDbValue($rs->fields('id_pelanggan'));
		$this->id_dokter->setDbValue($rs->fields('id_dokter'));
		$this->id_be->setDbValue($rs->fields('id_be'));
		$this->keluhan->setDbValue($rs->fields('keluhan'));
		$this->gejala_klinis->setDbValue($rs->fields('gejala_klinis'));
		$this->terapi->setDbValue($rs->fields('terapi'));
		$this->tindakan->setDbValue($rs->fields('tindakan'));
		$this->id_pemobat->setDbValue($rs->fields('id_pemobat'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->jumlah->setDbValue($rs->fields('jumlah'));
		$this->satuan->setDbValue($rs->fields('satuan'));
		$this->kode_barang->setDbValue($rs->fields('kode_barang'));
		$this->nama_barang->setDbValue($rs->fields('nama_barang'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_rekmeddok
		// kode_rekmeddok
		// tanggal
		// id_pelanggan
		// id_dokter
		// id_be
		// keluhan
		// gejala_klinis
		// terapi
		// tindakan
		// id_pemobat
		// id_barang
		// jumlah
		// satuan
		// kode_barang
		// nama_barang
		// id_rekmeddok

		$this->id_rekmeddok->ViewValue = $this->id_rekmeddok->CurrentValue;
		$this->id_rekmeddok->ViewCustomAttributes = "";

		// kode_rekmeddok
		$this->kode_rekmeddok->ViewValue = $this->kode_rekmeddok->CurrentValue;
		$this->kode_rekmeddok->ViewCustomAttributes = "";

		// tanggal
		$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
		$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
		$this->tanggal->ViewCustomAttributes = "";

		// id_pelanggan
		$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewValue = FormatNumber($this->id_pelanggan->ViewValue, 0, -2, -2, -2);
		$this->id_pelanggan->ViewCustomAttributes = "";

		// id_dokter
		$this->id_dokter->ViewValue = $this->id_dokter->CurrentValue;
		$this->id_dokter->ViewValue = FormatNumber($this->id_dokter->ViewValue, 0, -2, -2, -2);
		$this->id_dokter->ViewCustomAttributes = "";

		// id_be
		$this->id_be->ViewValue = $this->id_be->CurrentValue;
		$this->id_be->ViewValue = FormatNumber($this->id_be->ViewValue, 0, -2, -2, -2);
		$this->id_be->ViewCustomAttributes = "";

		// keluhan
		$this->keluhan->ViewValue = $this->keluhan->CurrentValue;
		$this->keluhan->ViewCustomAttributes = "";

		// gejala_klinis
		$this->gejala_klinis->ViewValue = $this->gejala_klinis->CurrentValue;
		$this->gejala_klinis->ViewCustomAttributes = "";

		// terapi
		$this->terapi->ViewValue = $this->terapi->CurrentValue;
		$this->terapi->ViewCustomAttributes = "";

		// tindakan
		$this->tindakan->ViewValue = $this->tindakan->CurrentValue;
		$this->tindakan->ViewCustomAttributes = "";

		// id_pemobat
		$this->id_pemobat->ViewValue = $this->id_pemobat->CurrentValue;
		$this->id_pemobat->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
		$this->id_barang->ViewValue = FormatNumber($this->id_barang->ViewValue, 0, -2, -2, -2);
		$this->id_barang->ViewCustomAttributes = "";

		// jumlah
		$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
		$this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 2, -2, -2, -2);
		$this->jumlah->ViewCustomAttributes = "";

		// satuan
		$this->satuan->ViewValue = $this->satuan->CurrentValue;
		$this->satuan->ViewValue = FormatNumber($this->satuan->ViewValue, 0, -2, -2, -2);
		$this->satuan->ViewCustomAttributes = "";

		// kode_barang
		$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
		$this->kode_barang->ViewCustomAttributes = "";

		// nama_barang
		$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
		$this->nama_barang->ViewCustomAttributes = "";

		// id_rekmeddok
		$this->id_rekmeddok->LinkCustomAttributes = "";
		$this->id_rekmeddok->HrefValue = "";
		$this->id_rekmeddok->TooltipValue = "";

		// kode_rekmeddok
		$this->kode_rekmeddok->LinkCustomAttributes = "";
		$this->kode_rekmeddok->HrefValue = "";
		$this->kode_rekmeddok->TooltipValue = "";

		// tanggal
		$this->tanggal->LinkCustomAttributes = "";
		$this->tanggal->HrefValue = "";
		$this->tanggal->TooltipValue = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// id_dokter
		$this->id_dokter->LinkCustomAttributes = "";
		$this->id_dokter->HrefValue = "";
		$this->id_dokter->TooltipValue = "";

		// id_be
		$this->id_be->LinkCustomAttributes = "";
		$this->id_be->HrefValue = "";
		$this->id_be->TooltipValue = "";

		// keluhan
		$this->keluhan->LinkCustomAttributes = "";
		$this->keluhan->HrefValue = "";
		$this->keluhan->TooltipValue = "";

		// gejala_klinis
		$this->gejala_klinis->LinkCustomAttributes = "";
		$this->gejala_klinis->HrefValue = "";
		$this->gejala_klinis->TooltipValue = "";

		// terapi
		$this->terapi->LinkCustomAttributes = "";
		$this->terapi->HrefValue = "";
		$this->terapi->TooltipValue = "";

		// tindakan
		$this->tindakan->LinkCustomAttributes = "";
		$this->tindakan->HrefValue = "";
		$this->tindakan->TooltipValue = "";

		// id_pemobat
		$this->id_pemobat->LinkCustomAttributes = "";
		$this->id_pemobat->HrefValue = "";
		$this->id_pemobat->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// jumlah
		$this->jumlah->LinkCustomAttributes = "";
		$this->jumlah->HrefValue = "";
		$this->jumlah->TooltipValue = "";

		// satuan
		$this->satuan->LinkCustomAttributes = "";
		$this->satuan->HrefValue = "";
		$this->satuan->TooltipValue = "";

		// kode_barang
		$this->kode_barang->LinkCustomAttributes = "";
		$this->kode_barang->HrefValue = "";
		$this->kode_barang->TooltipValue = "";

		// nama_barang
		$this->nama_barang->LinkCustomAttributes = "";
		$this->nama_barang->HrefValue = "";
		$this->nama_barang->TooltipValue = "";

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

		// id_rekmeddok
		$this->id_rekmeddok->EditAttrs["class"] = "form-control";
		$this->id_rekmeddok->EditCustomAttributes = "";
		$this->id_rekmeddok->EditValue = $this->id_rekmeddok->CurrentValue;
		$this->id_rekmeddok->ViewCustomAttributes = "";

		// kode_rekmeddok
		$this->kode_rekmeddok->EditAttrs["class"] = "form-control";
		$this->kode_rekmeddok->EditCustomAttributes = "";
		if (!$this->kode_rekmeddok->Raw)
			$this->kode_rekmeddok->CurrentValue = HtmlDecode($this->kode_rekmeddok->CurrentValue);
		$this->kode_rekmeddok->EditValue = $this->kode_rekmeddok->CurrentValue;
		$this->kode_rekmeddok->PlaceHolder = RemoveHtml($this->kode_rekmeddok->caption());

		// tanggal
		$this->tanggal->EditAttrs["class"] = "form-control";
		$this->tanggal->EditCustomAttributes = "";
		$this->tanggal->EditValue = FormatDateTime($this->tanggal->CurrentValue, 8);
		$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

		// id_pelanggan
		$this->id_pelanggan->EditAttrs["class"] = "form-control";
		$this->id_pelanggan->EditCustomAttributes = "";
		$this->id_pelanggan->EditValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->PlaceHolder = RemoveHtml($this->id_pelanggan->caption());

		// id_dokter
		$this->id_dokter->EditAttrs["class"] = "form-control";
		$this->id_dokter->EditCustomAttributes = "";
		$this->id_dokter->EditValue = $this->id_dokter->CurrentValue;
		$this->id_dokter->PlaceHolder = RemoveHtml($this->id_dokter->caption());

		// id_be
		$this->id_be->EditAttrs["class"] = "form-control";
		$this->id_be->EditCustomAttributes = "";
		$this->id_be->EditValue = $this->id_be->CurrentValue;
		$this->id_be->PlaceHolder = RemoveHtml($this->id_be->caption());

		// keluhan
		$this->keluhan->EditAttrs["class"] = "form-control";
		$this->keluhan->EditCustomAttributes = "";
		$this->keluhan->EditValue = $this->keluhan->CurrentValue;
		$this->keluhan->PlaceHolder = RemoveHtml($this->keluhan->caption());

		// gejala_klinis
		$this->gejala_klinis->EditAttrs["class"] = "form-control";
		$this->gejala_klinis->EditCustomAttributes = "";
		$this->gejala_klinis->EditValue = $this->gejala_klinis->CurrentValue;
		$this->gejala_klinis->PlaceHolder = RemoveHtml($this->gejala_klinis->caption());

		// terapi
		$this->terapi->EditAttrs["class"] = "form-control";
		$this->terapi->EditCustomAttributes = "";
		$this->terapi->EditValue = $this->terapi->CurrentValue;
		$this->terapi->PlaceHolder = RemoveHtml($this->terapi->caption());

		// tindakan
		$this->tindakan->EditAttrs["class"] = "form-control";
		$this->tindakan->EditCustomAttributes = "";
		$this->tindakan->EditValue = $this->tindakan->CurrentValue;
		$this->tindakan->PlaceHolder = RemoveHtml($this->tindakan->caption());

		// id_pemobat
		$this->id_pemobat->EditAttrs["class"] = "form-control";
		$this->id_pemobat->EditCustomAttributes = "";
		$this->id_pemobat->EditValue = $this->id_pemobat->CurrentValue;
		$this->id_pemobat->ViewCustomAttributes = "";

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
		

		// satuan
		$this->satuan->EditAttrs["class"] = "form-control";
		$this->satuan->EditCustomAttributes = "";
		$this->satuan->EditValue = $this->satuan->CurrentValue;
		$this->satuan->PlaceHolder = RemoveHtml($this->satuan->caption());

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
					$doc->exportCaption($this->id_rekmeddok);
					$doc->exportCaption($this->kode_rekmeddok);
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_dokter);
					$doc->exportCaption($this->id_be);
					$doc->exportCaption($this->keluhan);
					$doc->exportCaption($this->gejala_klinis);
					$doc->exportCaption($this->terapi);
					$doc->exportCaption($this->tindakan);
					$doc->exportCaption($this->id_pemobat);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
				} else {
					$doc->exportCaption($this->id_rekmeddok);
					$doc->exportCaption($this->kode_rekmeddok);
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_dokter);
					$doc->exportCaption($this->id_be);
					$doc->exportCaption($this->id_pemobat);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->jumlah);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->kode_barang);
					$doc->exportCaption($this->nama_barang);
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
						$doc->exportField($this->id_rekmeddok);
						$doc->exportField($this->kode_rekmeddok);
						$doc->exportField($this->tanggal);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_dokter);
						$doc->exportField($this->id_be);
						$doc->exportField($this->keluhan);
						$doc->exportField($this->gejala_klinis);
						$doc->exportField($this->terapi);
						$doc->exportField($this->tindakan);
						$doc->exportField($this->id_pemobat);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->satuan);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
					} else {
						$doc->exportField($this->id_rekmeddok);
						$doc->exportField($this->kode_rekmeddok);
						$doc->exportField($this->tanggal);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_dokter);
						$doc->exportField($this->id_be);
						$doc->exportField($this->id_pemobat);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->jumlah);
						$doc->exportField($this->satuan);
						$doc->exportField($this->kode_barang);
						$doc->exportField($this->nama_barang);
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