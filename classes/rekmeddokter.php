<?php namespace PHPMaker2020\klinik_latest_09_04_21; ?>
<?php

/**
 * Table class for rekmeddokter
 */
class rekmeddokter extends DbTable
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
	public $foto_perawatan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'rekmeddokter';
		$this->TableName = 'rekmeddokter';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rekmeddokter`";
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
		$this->ShowMultipleDetails = TRUE; // Show multiple details
		$this->GridAddRowCount = 1;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id_rekmeddok
		$this->id_rekmeddok = new DbField('rekmeddokter', 'rekmeddokter', 'x_id_rekmeddok', 'id_rekmeddok', '`id_rekmeddok`', '`id_rekmeddok`', 3, 11, -1, FALSE, '`id_rekmeddok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_rekmeddok->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_rekmeddok->IsPrimaryKey = TRUE; // Primary key field
		$this->id_rekmeddok->IsForeignKey = TRUE; // Foreign key field
		$this->id_rekmeddok->Sortable = FALSE; // Allow sort
		$this->id_rekmeddok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_rekmeddok'] = &$this->id_rekmeddok;

		// kode_rekmeddok
		$this->kode_rekmeddok = new DbField('rekmeddokter', 'rekmeddokter', 'x_kode_rekmeddok', 'kode_rekmeddok', '`kode_rekmeddok`', '`kode_rekmeddok`', 200, 50, -1, FALSE, '`kode_rekmeddok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_rekmeddok->Sortable = TRUE; // Allow sort
		$this->fields['kode_rekmeddok'] = &$this->kode_rekmeddok;

		// tanggal
		$this->tanggal = new DbField('rekmeddokter', 'rekmeddokter', 'x_tanggal', 'tanggal', '`tanggal`', CastDateFieldForLike("`tanggal`", 0, "DB"), 135, 19, 0, FALSE, '`tanggal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal->Sortable = TRUE; // Allow sort
		$this->tanggal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tanggal'] = &$this->tanggal;

		// id_pelanggan
		$this->id_pelanggan = new DbField('rekmeddokter', 'rekmeddokter', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 255, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_pelanggan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_pelanggan->Lookup = new Lookup('id_pelanggan', 'm_pelanggan', FALSE, 'id_pelanggan', ["kode_pelanggan","nama_pelanggan","",""], [], [], [], [], [], [], '', '');
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// id_dokter
		$this->id_dokter = new DbField('rekmeddokter', 'rekmeddokter', 'x_id_dokter', 'id_dokter', '`id_dokter`', '`id_dokter`', 3, 11, -1, FALSE, '`id_dokter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_dokter->Sortable = TRUE; // Allow sort
		$this->id_dokter->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_dokter->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_dokter->Lookup = new Lookup('id_dokter', 'm_pegawai', FALSE, 'id_pegawai', ["nik_pegawai","nama_pegawai","",""], [], [], [], [], [], [], '', '');
		$this->id_dokter->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_dokter'] = &$this->id_dokter;

		// id_be
		$this->id_be = new DbField('rekmeddokter', 'rekmeddokter', 'x_id_be', 'id_be', '`id_be`', '`id_be`', 3, 11, -1, FALSE, '`id_be`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_be->Sortable = TRUE; // Allow sort
		$this->id_be->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_be->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_be->Lookup = new Lookup('id_be', 'wp_terapis', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->id_be->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_be'] = &$this->id_be;

		// keluhan
		$this->keluhan = new DbField('rekmeddokter', 'rekmeddokter', 'x_keluhan', 'keluhan', '`keluhan`', '`keluhan`', 201, 65535, -1, FALSE, '`keluhan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keluhan->Sortable = TRUE; // Allow sort
		$this->fields['keluhan'] = &$this->keluhan;

		// gejala_klinis
		$this->gejala_klinis = new DbField('rekmeddokter', 'rekmeddokter', 'x_gejala_klinis', 'gejala_klinis', '`gejala_klinis`', '`gejala_klinis`', 201, 65535, -1, FALSE, '`gejala_klinis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->gejala_klinis->Sortable = TRUE; // Allow sort
		$this->fields['gejala_klinis'] = &$this->gejala_klinis;

		// terapi
		$this->terapi = new DbField('rekmeddokter', 'rekmeddokter', 'x_terapi', 'terapi', '`terapi`', '`terapi`', 201, 65535, -1, FALSE, '`terapi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->terapi->Sortable = TRUE; // Allow sort
		$this->fields['terapi'] = &$this->terapi;

		// tindakan
		$this->tindakan = new DbField('rekmeddokter', 'rekmeddokter', 'x_tindakan', 'tindakan', '`tindakan`', '`tindakan`', 201, 65535, -1, FALSE, '`tindakan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->tindakan->Sortable = TRUE; // Allow sort
		$this->fields['tindakan'] = &$this->tindakan;

		// foto_perawatan
		$this->foto_perawatan = new DbField('rekmeddokter', 'rekmeddokter', 'x_foto_perawatan', 'foto_perawatan', '`foto_perawatan`', '`foto_perawatan`', 201, 16777215, -1, TRUE, '`foto_perawatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->foto_perawatan->Sortable = TRUE; // Allow sort
		$this->foto_perawatan->UploadMultiple = TRUE;
		$this->foto_perawatan->Upload->UploadMultiple = TRUE;
		$this->foto_perawatan->UploadMaxFileCount = 0;
		$this->fields['foto_perawatan'] = &$this->foto_perawatan;
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
		if ($this->getCurrentDetailTable() == "detailrekmeddok") {
			$detailUrl = $GLOBALS["detailrekmeddok"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id_rekmeddok=" . urlencode($this->id_rekmeddok->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "detailrekmedterapis") {
			$detailUrl = $GLOBALS["detailrekmedterapis"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id_rekmeddok=" . urlencode($this->id_rekmeddok->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "detailrekmedpenjualan") {
			$detailUrl = $GLOBALS["detailrekmedpenjualan"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id_rekmeddok=" . urlencode($this->id_rekmeddok->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "rekmeddokterlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`rekmeddokter`";
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
		$this->foto_perawatan->Upload->DbValue = $row['foto_perawatan'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$this->foto_perawatan->OldUploadPath = "foto_perawatan/";
		$oldFiles = EmptyValue($row['foto_perawatan']) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $row['foto_perawatan']);
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->foto_perawatan->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->foto_perawatan->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_rekmeddok` = @id_rekmeddok@";
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
			return "rekmeddokterlist.php";
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
		if ($pageName == "rekmeddokterview.php")
			return $Language->phrase("View");
		elseif ($pageName == "rekmeddokteredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "rekmeddokteradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "rekmeddokterlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("rekmeddokterview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("rekmeddokterview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "rekmeddokteradd.php?" . $this->getUrlParm($parm);
		else
			$url = "rekmeddokteradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("rekmeddokteredit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("rekmeddokteredit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("rekmeddokteradd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("rekmeddokteradd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("rekmeddokterdelete.php", $this->getUrlParm());
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
			if (Param("id_rekmeddok") !== NULL)
				$arKeys[] = Param("id_rekmeddok");
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
				$this->id_rekmeddok->CurrentValue = $key;
			else
				$this->id_rekmeddok->OldValue = $key;
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
		$this->foto_perawatan->Upload->DbValue = $rs->fields('foto_perawatan');
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
		// foto_perawatan
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
					$arwrk[2] = $rswrk->fields('df2');
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

		// id_dokter
		$curVal = strval($this->id_dokter->CurrentValue);
		if ($curVal != "") {
			$this->id_dokter->ViewValue = $this->id_dokter->lookupCacheOption($curVal);
			if ($this->id_dokter->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_dokter->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = $rswrk->fields('df2');
					$this->id_dokter->ViewValue = $this->id_dokter->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_dokter->ViewValue = $this->id_dokter->CurrentValue;
				}
			}
		} else {
			$this->id_dokter->ViewValue = NULL;
		}
		$this->id_dokter->ViewCustomAttributes = "";

		// id_be
		$curVal = strval($this->id_be->CurrentValue);
		if ($curVal != "") {
			$this->id_be->ViewValue = $this->id_be->lookupCacheOption($curVal);
			if ($this->id_be->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_be->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_be->ViewValue = $this->id_be->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_be->ViewValue = $this->id_be->CurrentValue;
				}
			}
		} else {
			$this->id_be->ViewValue = NULL;
		}
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

		// foto_perawatan
		$this->foto_perawatan->UploadPath = "foto_perawatan/";
		if (!EmptyValue($this->foto_perawatan->Upload->DbValue)) {
			$this->foto_perawatan->ViewValue = $this->foto_perawatan->Upload->DbValue;
		} else {
			$this->foto_perawatan->ViewValue = "";
		}
		$this->foto_perawatan->ViewCustomAttributes = "";

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

		// foto_perawatan
		$this->foto_perawatan->LinkCustomAttributes = "";
		$this->foto_perawatan->HrefValue = "";
		$this->foto_perawatan->ExportHrefValue = $this->foto_perawatan->UploadPath . $this->foto_perawatan->Upload->DbValue;
		$this->foto_perawatan->TooltipValue = "";

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

		// id_dokter
		$this->id_dokter->EditAttrs["class"] = "form-control";
		$this->id_dokter->EditCustomAttributes = "";

		// id_be
		$this->id_be->EditAttrs["class"] = "form-control";
		$this->id_be->EditCustomAttributes = "";

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

		// foto_perawatan
		$this->foto_perawatan->EditAttrs["class"] = "form-control";
		$this->foto_perawatan->EditCustomAttributes = "";
		$this->foto_perawatan->UploadPath = "foto_perawatan/";
		if (!EmptyValue($this->foto_perawatan->Upload->DbValue)) {
			$this->foto_perawatan->EditValue = $this->foto_perawatan->Upload->DbValue;
		} else {
			$this->foto_perawatan->EditValue = "";
		}
		if (!EmptyValue($this->foto_perawatan->CurrentValue))
				$this->foto_perawatan->Upload->FileName = $this->foto_perawatan->CurrentValue;

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
					$doc->exportCaption($this->foto_perawatan);
				} else {
					$doc->exportCaption($this->kode_rekmeddok);
					$doc->exportCaption($this->tanggal);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_dokter);
					$doc->exportCaption($this->id_be);
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
						$doc->exportField($this->foto_perawatan);
					} else {
						$doc->exportField($this->kode_rekmeddok);
						$doc->exportField($this->tanggal);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_dokter);
						$doc->exportField($this->id_be);
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
		$width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
		$height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

		// Set up field name / file name field / file type field
		$fldName = "";
		$fileNameFld = "";
		$fileTypeFld = "";
		if ($fldparm == 'foto_perawatan') {
			$fldName = "foto_perawatan";
			$fileNameFld = "foto_perawatan";
		} else {
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->id_rekmeddok->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
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
		//$id = $rsnew['id_rekmeddok'];
		// Mendapatkan kode penjualan terakhir pada klinik $id_klinik, untuk diambil nomor urutnya

		$kode_kirim_sebelumnya = ExecuteScalar("SELECT kode_rekmeddok FROM rekmeddokter ORDER BY id_rekmeddok DESC ");
		$kode = explode('-', $kode_kirim_sebelumnya);
		$nomor_urut_terakhir = $kode[2];
		$bulan_sebelumnya = substr($kode[1], -2);
		$nomor_urut = '0000';
		if ($bulan_sebelumnya == date('m')) {
			$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
		} else {
			$nomor_urut = sprintf('%04d', 1);
		}
		$rsnew['kode_rekmeddok'] = 'RMD' . '-' . date('ym') . '-' . $nomor_urut;
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