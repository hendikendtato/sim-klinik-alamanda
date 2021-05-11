<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for terimabarang
 */
class terimabarang extends DbTable
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
	public $no_terima;
	public $id_kirimbarang;
	public $id_po;
	public $id_supplier;
	public $id_klinik;
	public $id_pegawai;
	public $tanggal_terima;
	public $keterangan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'terimabarang';
		$this->TableName = 'terimabarang';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`terimabarang`";
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
		$this->id = new DbField('terimabarang', 'terimabarang', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// no_terima
		$this->no_terima = new DbField('terimabarang', 'terimabarang', 'x_no_terima', 'no_terima', '`no_terima`', '`no_terima`', 200, 50, -1, FALSE, '`no_terima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->no_terima->Sortable = TRUE; // Allow sort
		$this->fields['no_terima'] = &$this->no_terima;

		// id_kirimbarang
		$this->id_kirimbarang = new DbField('terimabarang', 'terimabarang', 'x_id_kirimbarang', 'id_kirimbarang', '`id_kirimbarang`', '`id_kirimbarang`', 3, 11, -1, FALSE, '`id_kirimbarang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kirimbarang->Sortable = TRUE; // Allow sort
		$this->id_kirimbarang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kirimbarang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kirimbarang->Lookup = new Lookup('id_kirimbarang', 'kirimbarang', FALSE, 'id', ["no_kirimbarang","","",""], [], [], [], [], ["id_po","id_supplier","id_klinik"], ["x_id_po","x_id_supplier","x_id_klinik"], '', '');
		$this->id_kirimbarang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kirimbarang'] = &$this->id_kirimbarang;

		// id_po
		$this->id_po = new DbField('terimabarang', 'terimabarang', 'x_id_po', 'id_po', '`id_po`', '`id_po`', 3, 11, -1, FALSE, '`id_po`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_po->Nullable = FALSE; // NOT NULL field
		$this->id_po->Required = TRUE; // Required field
		$this->id_po->Sortable = TRUE; // Allow sort
		$this->id_po->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_po->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_po->Lookup = new Lookup('id_po', 'purchaseorder', FALSE, 'id_po', ["no_po","","",""], [], [], [], [], [], [], '', '');
		$this->id_po->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_po'] = &$this->id_po;

		// id_supplier
		$this->id_supplier = new DbField('terimabarang', 'terimabarang', 'x_id_supplier', 'id_supplier', '`id_supplier`', '`id_supplier`', 3, 11, -1, FALSE, '`id_supplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_supplier->Sortable = TRUE; // Allow sort
		$this->id_supplier->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_supplier->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_supplier->Lookup = new Lookup('id_supplier', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_supplier->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_supplier'] = &$this->id_supplier;

		// id_klinik
		$this->id_klinik = new DbField('terimabarang', 'terimabarang', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// id_pegawai
		$this->id_pegawai = new DbField('terimabarang', 'terimabarang', 'x_id_pegawai', 'id_pegawai', '`id_pegawai`', '`id_pegawai`', 3, 11, -1, FALSE, '`id_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_pegawai->Sortable = TRUE; // Allow sort
		$this->id_pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_pegawai->Lookup = new Lookup('id_pegawai', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","","",""], [], [], [], [], [], [], '', '');
		$this->id_pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pegawai'] = &$this->id_pegawai;

		// tanggal_terima
		$this->tanggal_terima = new DbField('terimabarang', 'terimabarang', 'x_tanggal_terima', 'tanggal_terima', '`tanggal_terima`', CastDateFieldForLike("`tanggal_terima`", 0, "DB"), 133, 10, 0, FALSE, '`tanggal_terima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tanggal_terima->Nullable = FALSE; // NOT NULL field
		$this->tanggal_terima->Required = TRUE; // Required field
		$this->tanggal_terima->Sortable = TRUE; // Allow sort
		$this->tanggal_terima->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tanggal_terima'] = &$this->tanggal_terima;

		// keterangan
		$this->keterangan = new DbField('terimabarang', 'terimabarang', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;
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
		if ($this->getCurrentDetailTable() == "detailterimabarang") {
			$detailUrl = $GLOBALS["detailterimabarang"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "terimabaranglist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`terimabarang`";
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

		// Cascade Update detail table 'detailterimabarang'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'id_terimabarang'
			$cascadeUpdate = TRUE;
			$rscascade['id_terimabarang'] = $rs['id'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["detailterimabarang"]))
				$GLOBALS["detailterimabarang"] = new detailterimabarang();
			$rswrk = $GLOBALS["detailterimabarang"]->loadRs("`id_terimabarang` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["detailterimabarang"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["detailterimabarang"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["detailterimabarang"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
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

		// Cascade delete detail table 'detailterimabarang'
		if (!isset($GLOBALS["detailterimabarang"]))
			$GLOBALS["detailterimabarang"] = new detailterimabarang();
		$rscascade = $GLOBALS["detailterimabarang"]->loadRs("`id_terimabarang` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["detailterimabarang"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["detailterimabarang"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["detailterimabarang"]->Row_Deleted($dtlrow);
		}
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
		$this->no_terima->DbValue = $row['no_terima'];
		$this->id_kirimbarang->DbValue = $row['id_kirimbarang'];
		$this->id_po->DbValue = $row['id_po'];
		$this->id_supplier->DbValue = $row['id_supplier'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->id_pegawai->DbValue = $row['id_pegawai'];
		$this->tanggal_terima->DbValue = $row['tanggal_terima'];
		$this->keterangan->DbValue = $row['keterangan'];
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
			return "terimabaranglist.php";
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
		if ($pageName == "terimabarangview.php")
			return $Language->phrase("View");
		elseif ($pageName == "terimabarangedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "terimabarangadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "terimabaranglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("terimabarangview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("terimabarangview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "terimabarangadd.php?" . $this->getUrlParm($parm);
		else
			$url = "terimabarangadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("terimabarangedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("terimabarangedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("terimabarangadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("terimabarangadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("terimabarangdelete.php", $this->getUrlParm());
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
		$this->no_terima->setDbValue($rs->fields('no_terima'));
		$this->id_kirimbarang->setDbValue($rs->fields('id_kirimbarang'));
		$this->id_po->setDbValue($rs->fields('id_po'));
		$this->id_supplier->setDbValue($rs->fields('id_supplier'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->id_pegawai->setDbValue($rs->fields('id_pegawai'));
		$this->tanggal_terima->setDbValue($rs->fields('tanggal_terima'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// no_terima
		// id_kirimbarang
		// id_po
		// id_supplier
		// id_klinik
		// id_pegawai
		// tanggal_terima
		// keterangan
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// no_terima
		$this->no_terima->ViewValue = $this->no_terima->CurrentValue;
		$this->no_terima->ViewCustomAttributes = "";

		// id_kirimbarang
		$curVal = strval($this->id_kirimbarang->CurrentValue);
		if ($curVal != "") {
			$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->lookupCacheOption($curVal);
			if ($this->id_kirimbarang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_kirimbarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->CurrentValue;
				}
			}
		} else {
			$this->id_kirimbarang->ViewValue = NULL;
		}
		$this->id_kirimbarang->ViewCustomAttributes = "";

		// id_po
		$curVal = strval($this->id_po->CurrentValue);
		if ($curVal != "") {
			$this->id_po->ViewValue = $this->id_po->lookupCacheOption($curVal);
			if ($this->id_po->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_po`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_po->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_po->ViewValue = $this->id_po->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_po->ViewValue = $this->id_po->CurrentValue;
				}
			}
		} else {
			$this->id_po->ViewValue = NULL;
		}
		$this->id_po->ViewCustomAttributes = "";

		// id_supplier
		$curVal = strval($this->id_supplier->CurrentValue);
		if ($curVal != "") {
			$this->id_supplier->ViewValue = $this->id_supplier->lookupCacheOption($curVal);
			if ($this->id_supplier->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_supplier->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_supplier->ViewValue = $this->id_supplier->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_supplier->ViewValue = $this->id_supplier->CurrentValue;
				}
			}
		} else {
			$this->id_supplier->ViewValue = NULL;
		}
		$this->id_supplier->ViewCustomAttributes = "";

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

		// id_pegawai
		$curVal = strval($this->id_pegawai->CurrentValue);
		if ($curVal != "") {
			$this->id_pegawai->ViewValue = $this->id_pegawai->lookupCacheOption($curVal);
			if ($this->id_pegawai->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_pegawai->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
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

		// tanggal_terima
		$this->tanggal_terima->ViewValue = $this->tanggal_terima->CurrentValue;
		$this->tanggal_terima->ViewValue = FormatDateTime($this->tanggal_terima->ViewValue, 0);
		$this->tanggal_terima->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// no_terima
		$this->no_terima->LinkCustomAttributes = "";
		$this->no_terima->HrefValue = "";
		$this->no_terima->TooltipValue = "";

		// id_kirimbarang
		$this->id_kirimbarang->LinkCustomAttributes = "";
		$this->id_kirimbarang->HrefValue = "";
		$this->id_kirimbarang->TooltipValue = "";

		// id_po
		$this->id_po->LinkCustomAttributes = "";
		$this->id_po->HrefValue = "";
		$this->id_po->TooltipValue = "";

		// id_supplier
		$this->id_supplier->LinkCustomAttributes = "";
		$this->id_supplier->HrefValue = "";
		$this->id_supplier->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// id_pegawai
		$this->id_pegawai->LinkCustomAttributes = "";
		$this->id_pegawai->HrefValue = "";
		$this->id_pegawai->TooltipValue = "";

		// tanggal_terima
		$this->tanggal_terima->LinkCustomAttributes = "";
		$this->tanggal_terima->HrefValue = "";
		$this->tanggal_terima->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

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

		// no_terima
		$this->no_terima->EditAttrs["class"] = "form-control";
		$this->no_terima->EditCustomAttributes = "";
		if (!$this->no_terima->Raw)
			$this->no_terima->CurrentValue = HtmlDecode($this->no_terima->CurrentValue);
		$this->no_terima->EditValue = $this->no_terima->CurrentValue;
		$this->no_terima->PlaceHolder = RemoveHtml($this->no_terima->caption());

		// id_kirimbarang
		$this->id_kirimbarang->EditAttrs["class"] = "form-control";
		$this->id_kirimbarang->EditCustomAttributes = "";

		// id_po
		$this->id_po->EditAttrs["class"] = "form-control";
		$this->id_po->EditCustomAttributes = "";

		// id_supplier
		$this->id_supplier->EditAttrs["class"] = "form-control";
		$this->id_supplier->EditCustomAttributes = "";

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// id_pegawai
		$this->id_pegawai->EditAttrs["class"] = "form-control";
		$this->id_pegawai->EditCustomAttributes = "";

		// tanggal_terima
		$this->tanggal_terima->EditAttrs["class"] = "form-control";
		$this->tanggal_terima->EditCustomAttributes = "";
		$this->tanggal_terima->EditValue = FormatDateTime($this->tanggal_terima->CurrentValue, 8);
		$this->tanggal_terima->PlaceHolder = RemoveHtml($this->tanggal_terima->caption());

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

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
					$doc->exportCaption($this->no_terima);
					$doc->exportCaption($this->id_kirimbarang);
					$doc->exportCaption($this->id_po);
					$doc->exportCaption($this->id_supplier);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_pegawai);
					$doc->exportCaption($this->tanggal_terima);
					$doc->exportCaption($this->keterangan);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->no_terima);
					$doc->exportCaption($this->id_kirimbarang);
					$doc->exportCaption($this->id_po);
					$doc->exportCaption($this->id_supplier);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_pegawai);
					$doc->exportCaption($this->tanggal_terima);
					$doc->exportCaption($this->keterangan);
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
						$doc->exportField($this->no_terima);
						$doc->exportField($this->id_kirimbarang);
						$doc->exportField($this->id_po);
						$doc->exportField($this->id_supplier);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_pegawai);
						$doc->exportField($this->tanggal_terima);
						$doc->exportField($this->keterangan);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->no_terima);
						$doc->exportField($this->id_kirimbarang);
						$doc->exportField($this->id_po);
						$doc->exportField($this->id_supplier);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_pegawai);
						$doc->exportField($this->tanggal_terima);
						$doc->exportField($this->keterangan);
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

		$id_klinik = $rsnew['id_klinik'];

		// Mendapatkan kode penjualan terakhir pada klinik $id_klinik, untuk diambil nomor urutnya
		$kode_terima_sebelumnya = ExecuteScalar("SELECT no_terima FROM terimabarang WHERE id_klinik=$id_klinik ORDER BY id DESC");
		$kode = explode('-', $kode_terima_sebelumnya);
		$nomor_urut_terakhir = $kode[2];
		$bulan_sebelumnya = substr($kode[1], -2);
		$nomor_urut = '0000';
		if ($bulan_sebelumnya == date('m')) {
			$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
		} else {
			$nomor_urut = sprintf('%04d', 1);
		}

		/* kode penjualan dengan format Jxx-yymm-0000
		 * J = jual
		 *	xx = kode cabang
		 *	yy = tahun
		 *	mm = bulan
		 *	0000 = nmr urut
		*/
		$rsnew['no_terima'] = 'TB' . $id_klinik . '-' . date('ym') . '-' . $nomor_urut;
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		//ubah status_po menjadi 'close'

		$id_po = $rsnew["id_po"];
		Execute("UPDATE purchaseorder SET status_po = 'close' WHERE id_po = '$id_po'");
		$id_klinik = $rsnew["id_klinik"];

		//select barang view
		$items = ExecuteRows("SELECT * FROM detailpo WHERE pid_detailpo = '$id_po'");

		//flow potong stok barang di m_hargajual
		foreach($items as $item) {
			$qty = $item['qty'];
			$id_barang = $item['idbarang'];
			$stok_lama = ExecuteScalar("SELECT stok FROM m_hargajual WHERE id_barang = '$id_barang' AND id_klinik = '$id_klinik'");
			$stok_baru = $stok_lama + $qty;

			//$update_stok = Execute("UPDATE m_hargajual SET stok=$stok_baru WHERE id_barang = $id_barang AND id_klinik = $id_klinik");
		}
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

		if ($this->PageID == "list") {
			$id_po = $this->id_po->CurrentValue;
			$no_po = ExecuteScalar("SELECT no_po FROM purchaseorder WHERE id_po = $id_po");
			$this->id_po->ViewValue = $no_po;
			$id_supplier = $this->id_supplier->CurrentValue;
			$nama_supplier = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = $id_supplier");
			$this->id_supplier->ViewValue = $nama_supplier;
			$id_klinik = $this->id_klinik->CurrentValue;
			$nama_klinik = ExecuteScalar("SELECT nama_klinik FROM m_klinik WHERE id_klinik = $id_klinik");
			$this->id_klinik->ViewValue = $nama_klinik;
			$id_pegawai = $this->id_pegawai->CurrentValue;
			$nama_pegawai = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai = $id_pegawai");
			$this->id_pegawai->ViewValue = $nama_pegawai;
		}

		//$id_klinik = CurrentUserInfo("id_klinik");
		//if($id_klinik != '' OR $id_klinik != FALSE){
		//	$this->id_klinik->CurrentValue = $id_klinik ;
		//	$this->id_klinik->ReadOnly = TRUE; 
		//}

		$id_pegawai = CurrentUserInfo("id_pegawai");
		if($id_pegawai != '' OR $id_pegawai != FALSE){
			$this->id_pegawai->CurrentValue = $id_pegawai ;
			$this->id_pegawai->ReadOnly = TRUE; 
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>