<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for m_hargajual
 */
class m_hargajual extends DbTable
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
	public $id_hargajual;
	public $id_barang;
	public $totalhargajual;
	public $disc_pr;
	public $disc_rp;
	public $id_klinik;
	public $stok;
	public $satuan;
	public $minimum_stok;
	public $tgl_masuk;
	public $tgl_exp;
	public $kategori;
	public $subkategori;
	public $tipe;
	public $status;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_hargajual';
		$this->TableName = 'm_hargajual';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_hargajual`";
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

		// id_hargajual
		$this->id_hargajual = new DbField('m_hargajual', 'm_hargajual', 'x_id_hargajual', 'id_hargajual', '`id_hargajual`', '`id_hargajual`', 3, 11, -1, FALSE, '`id_hargajual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_hargajual->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_hargajual->IsPrimaryKey = TRUE; // Primary key field
		$this->id_hargajual->Sortable = TRUE; // Allow sort
		$this->id_hargajual->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_hargajual'] = &$this->id_hargajual;

		// id_barang
		$this->id_barang = new DbField('m_hargajual', 'm_hargajual', 'x_id_barang', 'id_barang', '`id_barang`', '`id_barang`', 3, 11, -1, FALSE, '`id_barang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_barang->Sortable = TRUE; // Allow sort
		$this->id_barang->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_barang->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_barang->Lookup = new Lookup('id_barang', 'm_barang', FALSE, 'id', ["nama_barang","","",""], [], [], [], [], ["kategori","subkategori","tipe"], ["x_kategori","x_subkategori","x_tipe[]"], '', '');
		$this->id_barang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_barang'] = &$this->id_barang;

		// totalhargajual
		$this->totalhargajual = new DbField('m_hargajual', 'm_hargajual', 'x_totalhargajual', 'totalhargajual', '`totalhargajual`', '`totalhargajual`', 5, 22, -1, FALSE, '`totalhargajual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->totalhargajual->Sortable = TRUE; // Allow sort
		$this->totalhargajual->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['totalhargajual'] = &$this->totalhargajual;

		// disc_pr
		$this->disc_pr = new DbField('m_hargajual', 'm_hargajual', 'x_disc_pr', 'disc_pr', '`disc_pr`', '`disc_pr`', 5, 22, -1, FALSE, '`disc_pr`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_pr->Sortable = TRUE; // Allow sort
		$this->disc_pr->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_pr'] = &$this->disc_pr;

		// disc_rp
		$this->disc_rp = new DbField('m_hargajual', 'm_hargajual', 'x_disc_rp', 'disc_rp', '`disc_rp`', '`disc_rp`', 5, 22, -1, FALSE, '`disc_rp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->disc_rp->Sortable = TRUE; // Allow sort
		$this->disc_rp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['disc_rp'] = &$this->disc_rp;

		// id_klinik
		$this->id_klinik = new DbField('m_hargajual', 'm_hargajual', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// stok
		$this->stok = new DbField('m_hargajual', 'm_hargajual', 'x_stok', 'stok', '`stok`', '`stok`', 4, 12, -1, FALSE, '`stok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->stok->Sortable = TRUE; // Allow sort
		$this->stok->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['stok'] = &$this->stok;

		// satuan
		$this->satuan = new DbField('m_hargajual', 'm_hargajual', 'x_satuan', 'satuan', '`satuan`', '`satuan`', 3, 11, -1, FALSE, '`satuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->satuan->Sortable = TRUE; // Allow sort
		$this->satuan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->satuan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->satuan->Lookup = new Lookup('satuan', 'm_satuan_barang', FALSE, 'id_satuan', ["nama_satuan","","",""], [], [], [], [], [], [], '', '');
		$this->satuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['satuan'] = &$this->satuan;

		// minimum_stok
		$this->minimum_stok = new DbField('m_hargajual', 'm_hargajual', 'x_minimum_stok', 'minimum_stok', '`minimum_stok`', '`minimum_stok`', 3, 11, -1, FALSE, '`minimum_stok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->minimum_stok->Sortable = TRUE; // Allow sort
		$this->minimum_stok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['minimum_stok'] = &$this->minimum_stok;

		// tgl_masuk
		$this->tgl_masuk = new DbField('m_hargajual', 'm_hargajual', 'x_tgl_masuk', 'tgl_masuk', '`tgl_masuk`', CastDateFieldForLike("`tgl_masuk`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_masuk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_masuk->Sortable = TRUE; // Allow sort
		$this->tgl_masuk->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_masuk'] = &$this->tgl_masuk;

		// tgl_exp
		$this->tgl_exp = new DbField('m_hargajual', 'm_hargajual', 'x_tgl_exp', 'tgl_exp', '`tgl_exp`', CastDateFieldForLike("`tgl_exp`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_exp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_exp->Sortable = TRUE; // Allow sort
		$this->tgl_exp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_exp'] = &$this->tgl_exp;

		// kategori
		$this->kategori = new DbField('m_hargajual', 'm_hargajual', 'x_kategori', 'kategori', '`kategori`', '`kategori`', 3, 11, -1, FALSE, '`kategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->kategori->Sortable = TRUE; // Allow sort
		$this->kategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->kategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->kategori->Lookup = new Lookup('kategori', 'kategoribarang', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->kategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kategori'] = &$this->kategori;

		// subkategori
		$this->subkategori = new DbField('m_hargajual', 'm_hargajual', 'x_subkategori', 'subkategori', '`subkategori`', '`subkategori`', 3, 11, -1, FALSE, '`subkategori`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->subkategori->Sortable = TRUE; // Allow sort
		$this->subkategori->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->subkategori->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->subkategori->Lookup = new Lookup('subkategori', 'subkategoribarang', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->subkategori->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['subkategori'] = &$this->subkategori;

		// tipe
		$this->tipe = new DbField('m_hargajual', 'm_hargajual', 'x_tipe', 'tipe', '`tipe`', '`tipe`', 202, 9, -1, FALSE, '`tipe`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'CHECKBOX');
		$this->tipe->Sortable = TRUE; // Allow sort
		$this->tipe->Lookup = new Lookup('tipe', 'm_hargajual', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->tipe->OptionCount = 4;
		$this->fields['tipe'] = &$this->tipe;

		// status
		$this->status = new DbField('m_hargajual', 'm_hargajual', 'x_status', 'status', '`status`', '`status`', 3, 11, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->status->Lookup = new Lookup('status', 'm_status_barang', FALSE, 'id_status', ["status_barang","","",""], [], [], [], [], [], [], '', '');
		$this->status->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_hargajual`";
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
			$this->id_hargajual->setDbValue($conn->insert_ID());
			$rs['id_hargajual'] = $this->id_hargajual->DbValue;
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
			if (array_key_exists('id_hargajual', $rs))
				AddFilter($where, QuotedName('id_hargajual', $this->Dbid) . '=' . QuotedValue($rs['id_hargajual'], $this->id_hargajual->DataType, $this->Dbid));
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
		$this->id_hargajual->DbValue = $row['id_hargajual'];
		$this->id_barang->DbValue = $row['id_barang'];
		$this->totalhargajual->DbValue = $row['totalhargajual'];
		$this->disc_pr->DbValue = $row['disc_pr'];
		$this->disc_rp->DbValue = $row['disc_rp'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->stok->DbValue = $row['stok'];
		$this->satuan->DbValue = $row['satuan'];
		$this->minimum_stok->DbValue = $row['minimum_stok'];
		$this->tgl_masuk->DbValue = $row['tgl_masuk'];
		$this->tgl_exp->DbValue = $row['tgl_exp'];
		$this->kategori->DbValue = $row['kategori'];
		$this->subkategori->DbValue = $row['subkategori'];
		$this->tipe->DbValue = $row['tipe'];
		$this->status->DbValue = $row['status'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_hargajual` = @id_hargajual@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_hargajual', $row) ? $row['id_hargajual'] : NULL;
		else
			$val = $this->id_hargajual->OldValue !== NULL ? $this->id_hargajual->OldValue : $this->id_hargajual->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_hargajual@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "m_hargajuallist.php";
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
		if ($pageName == "m_hargajualview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_hargajualedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_hargajualadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_hargajuallist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_hargajualview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_hargajualview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_hargajualadd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_hargajualadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_hargajualedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_hargajualadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_hargajualdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_hargajual:" . JsonEncode($this->id_hargajual->CurrentValue, "number");
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
		if ($this->id_hargajual->CurrentValue != NULL) {
			$url .= "id_hargajual=" . urlencode($this->id_hargajual->CurrentValue);
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
			if (Param("id_hargajual") !== NULL)
				$arKeys[] = Param("id_hargajual");
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
				$this->id_hargajual->CurrentValue = $key;
			else
				$this->id_hargajual->OldValue = $key;
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
		$this->id_hargajual->setDbValue($rs->fields('id_hargajual'));
		$this->id_barang->setDbValue($rs->fields('id_barang'));
		$this->totalhargajual->setDbValue($rs->fields('totalhargajual'));
		$this->disc_pr->setDbValue($rs->fields('disc_pr'));
		$this->disc_rp->setDbValue($rs->fields('disc_rp'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->stok->setDbValue($rs->fields('stok'));
		$this->satuan->setDbValue($rs->fields('satuan'));
		$this->minimum_stok->setDbValue($rs->fields('minimum_stok'));
		$this->tgl_masuk->setDbValue($rs->fields('tgl_masuk'));
		$this->tgl_exp->setDbValue($rs->fields('tgl_exp'));
		$this->kategori->setDbValue($rs->fields('kategori'));
		$this->subkategori->setDbValue($rs->fields('subkategori'));
		$this->tipe->setDbValue($rs->fields('tipe'));
		$this->status->setDbValue($rs->fields('status'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_hargajual
		// id_barang
		// totalhargajual
		// disc_pr
		// disc_rp
		// id_klinik
		// stok
		// satuan
		// minimum_stok
		// tgl_masuk
		// tgl_exp
		// kategori
		// subkategori
		// tipe
		// status
		// id_hargajual

		$this->id_hargajual->ViewValue = $this->id_hargajual->CurrentValue;
		$this->id_hargajual->ViewCustomAttributes = "";

		// id_barang
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

		// totalhargajual
		$this->totalhargajual->ViewValue = $this->totalhargajual->CurrentValue;
		$this->totalhargajual->ViewValue = FormatNumber($this->totalhargajual->ViewValue, 0, -2, -2, -2);
		$this->totalhargajual->ViewCustomAttributes = "";

		// disc_pr
		$this->disc_pr->ViewValue = $this->disc_pr->CurrentValue;
		$this->disc_pr->ViewValue = FormatNumber($this->disc_pr->ViewValue, 2, -2, -2, -2);
		$this->disc_pr->ViewCustomAttributes = "";

		// disc_rp
		$this->disc_rp->ViewValue = $this->disc_rp->CurrentValue;
		$this->disc_rp->ViewValue = FormatNumber($this->disc_rp->ViewValue, 2, -2, -2, -2);
		$this->disc_rp->ViewCustomAttributes = "";

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

		// stok
		$this->stok->ViewValue = $this->stok->CurrentValue;
		$this->stok->ViewValue = FormatNumber($this->stok->ViewValue, 2, -2, -2, -2);
		$this->stok->ViewCustomAttributes = "";

		// satuan
		$curVal = strval($this->satuan->CurrentValue);
		if ($curVal != "") {
			$this->satuan->ViewValue = $this->satuan->lookupCacheOption($curVal);
			if ($this->satuan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_satuan`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->satuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->satuan->ViewValue = $this->satuan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->satuan->ViewValue = $this->satuan->CurrentValue;
				}
			}
		} else {
			$this->satuan->ViewValue = NULL;
		}
		$this->satuan->ViewCustomAttributes = "";

		// minimum_stok
		$this->minimum_stok->ViewValue = $this->minimum_stok->CurrentValue;
		$this->minimum_stok->ViewValue = FormatNumber($this->minimum_stok->ViewValue, 0, -2, -2, -2);
		$this->minimum_stok->ViewCustomAttributes = "";

		// tgl_masuk
		$this->tgl_masuk->ViewValue = $this->tgl_masuk->CurrentValue;
		$this->tgl_masuk->ViewValue = FormatDateTime($this->tgl_masuk->ViewValue, 0);
		$this->tgl_masuk->ViewCustomAttributes = "";

		// tgl_exp
		$this->tgl_exp->ViewValue = $this->tgl_exp->CurrentValue;
		$this->tgl_exp->ViewValue = FormatDateTime($this->tgl_exp->ViewValue, 0);
		$this->tgl_exp->ViewCustomAttributes = "";

		// kategori
		$curVal = strval($this->kategori->CurrentValue);
		if ($curVal != "") {
			$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
			if ($this->kategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->kategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->kategori->ViewValue = $this->kategori->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->kategori->ViewValue = $this->kategori->CurrentValue;
				}
			}
		} else {
			$this->kategori->ViewValue = NULL;
		}
		$this->kategori->ViewCustomAttributes = "";

		// subkategori
		$curVal = strval($this->subkategori->CurrentValue);
		if ($curVal != "") {
			$this->subkategori->ViewValue = $this->subkategori->lookupCacheOption($curVal);
			if ($this->subkategori->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->subkategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->subkategori->ViewValue = $this->subkategori->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->subkategori->ViewValue = $this->subkategori->CurrentValue;
				}
			}
		} else {
			$this->subkategori->ViewValue = NULL;
		}
		$this->subkategori->ViewCustomAttributes = "";

		// tipe
		if (strval($this->tipe->CurrentValue) != "") {
			$this->tipe->ViewValue = new OptionValues();
			$arwrk = explode(",", strval($this->tipe->CurrentValue));
			$cnt = count($arwrk);
			for ($ari = 0; $ari < $cnt; $ari++)
				$this->tipe->ViewValue->add($this->tipe->optionCaption(trim($arwrk[$ari])));
		} else {
			$this->tipe->ViewValue = NULL;
		}
		$this->tipe->ViewCustomAttributes = "";

		// status
		$curVal = strval($this->status->CurrentValue);
		if ($curVal != "") {
			$this->status->ViewValue = $this->status->lookupCacheOption($curVal);
			if ($this->status->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_status`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->status->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->status->ViewValue = $this->status->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->status->ViewValue = $this->status->CurrentValue;
				}
			}
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// id_hargajual
		$this->id_hargajual->LinkCustomAttributes = "";
		$this->id_hargajual->HrefValue = "";
		$this->id_hargajual->TooltipValue = "";

		// id_barang
		$this->id_barang->LinkCustomAttributes = "";
		$this->id_barang->HrefValue = "";
		$this->id_barang->TooltipValue = "";

		// totalhargajual
		$this->totalhargajual->LinkCustomAttributes = "";
		$this->totalhargajual->HrefValue = "";
		$this->totalhargajual->TooltipValue = "";

		// disc_pr
		$this->disc_pr->LinkCustomAttributes = "";
		$this->disc_pr->HrefValue = "";
		$this->disc_pr->TooltipValue = "";

		// disc_rp
		$this->disc_rp->LinkCustomAttributes = "";
		$this->disc_rp->HrefValue = "";
		$this->disc_rp->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// stok
		$this->stok->LinkCustomAttributes = "";
		$this->stok->HrefValue = "";
		$this->stok->TooltipValue = "";

		// satuan
		$this->satuan->LinkCustomAttributes = "";
		$this->satuan->HrefValue = "";
		$this->satuan->TooltipValue = "";

		// minimum_stok
		$this->minimum_stok->LinkCustomAttributes = "";
		$this->minimum_stok->HrefValue = "";
		$this->minimum_stok->TooltipValue = "";

		// tgl_masuk
		$this->tgl_masuk->LinkCustomAttributes = "";
		$this->tgl_masuk->HrefValue = "";
		$this->tgl_masuk->TooltipValue = "";

		// tgl_exp
		$this->tgl_exp->LinkCustomAttributes = "";
		$this->tgl_exp->HrefValue = "";
		$this->tgl_exp->TooltipValue = "";

		// kategori
		$this->kategori->LinkCustomAttributes = "";
		$this->kategori->HrefValue = "";
		$this->kategori->TooltipValue = "";

		// subkategori
		$this->subkategori->LinkCustomAttributes = "";
		$this->subkategori->HrefValue = "";
		$this->subkategori->TooltipValue = "";

		// tipe
		$this->tipe->LinkCustomAttributes = "";
		$this->tipe->HrefValue = "";
		$this->tipe->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

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

		// id_hargajual
		$this->id_hargajual->EditAttrs["class"] = "form-control";
		$this->id_hargajual->EditCustomAttributes = "";
		$this->id_hargajual->EditValue = $this->id_hargajual->CurrentValue;
		$this->id_hargajual->ViewCustomAttributes = "";

		// id_barang
		$this->id_barang->EditAttrs["class"] = "form-control";
		$this->id_barang->EditCustomAttributes = "";

		// totalhargajual
		$this->totalhargajual->EditAttrs["class"] = "form-control";
		$this->totalhargajual->EditCustomAttributes = "";
		$this->totalhargajual->EditValue = $this->totalhargajual->CurrentValue;
		$this->totalhargajual->PlaceHolder = RemoveHtml($this->totalhargajual->caption());
		if (strval($this->totalhargajual->EditValue) != "" && is_numeric($this->totalhargajual->EditValue))
			$this->totalhargajual->EditValue = FormatNumber($this->totalhargajual->EditValue, -2, -2, -2, -2);
		

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
		

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// stok
		$this->stok->EditAttrs["class"] = "form-control";
		$this->stok->EditCustomAttributes = "Readonly";
		$this->stok->EditValue = $this->stok->CurrentValue;
		$this->stok->PlaceHolder = RemoveHtml($this->stok->caption());
		if (strval($this->stok->EditValue) != "" && is_numeric($this->stok->EditValue))
			$this->stok->EditValue = FormatNumber($this->stok->EditValue, -2, -2, -2, -2);
		

		// satuan
		$this->satuan->EditAttrs["class"] = "form-control";
		$this->satuan->EditCustomAttributes = "";

		// minimum_stok
		$this->minimum_stok->EditAttrs["class"] = "form-control";
		$this->minimum_stok->EditCustomAttributes = "";
		$this->minimum_stok->EditValue = $this->minimum_stok->CurrentValue;
		$this->minimum_stok->PlaceHolder = RemoveHtml($this->minimum_stok->caption());

		// tgl_masuk
		$this->tgl_masuk->EditAttrs["class"] = "form-control";
		$this->tgl_masuk->EditCustomAttributes = "";
		$this->tgl_masuk->EditValue = FormatDateTime($this->tgl_masuk->CurrentValue, 8);
		$this->tgl_masuk->PlaceHolder = RemoveHtml($this->tgl_masuk->caption());

		// tgl_exp
		$this->tgl_exp->EditAttrs["class"] = "form-control";
		$this->tgl_exp->EditCustomAttributes = "";
		$this->tgl_exp->EditValue = FormatDateTime($this->tgl_exp->CurrentValue, 8);
		$this->tgl_exp->PlaceHolder = RemoveHtml($this->tgl_exp->caption());

		// kategori
		$this->kategori->EditAttrs["class"] = "form-control";
		$this->kategori->EditCustomAttributes = "";

		// subkategori
		$this->subkategori->EditAttrs["class"] = "form-control";
		$this->subkategori->EditCustomAttributes = "";

		// tipe
		$this->tipe->EditCustomAttributes = "";
		$this->tipe->EditValue = $this->tipe->options(FALSE);

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";

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
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->totalhargajual);
					$doc->exportCaption($this->disc_pr);
					$doc->exportCaption($this->disc_rp);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->stok);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->minimum_stok);
					$doc->exportCaption($this->tgl_masuk);
					$doc->exportCaption($this->tgl_exp);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->subkategori);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->status);
				} else {
					$doc->exportCaption($this->id_hargajual);
					$doc->exportCaption($this->id_barang);
					$doc->exportCaption($this->totalhargajual);
					$doc->exportCaption($this->disc_pr);
					$doc->exportCaption($this->disc_rp);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->stok);
					$doc->exportCaption($this->satuan);
					$doc->exportCaption($this->minimum_stok);
					$doc->exportCaption($this->tgl_masuk);
					$doc->exportCaption($this->tgl_exp);
					$doc->exportCaption($this->kategori);
					$doc->exportCaption($this->subkategori);
					$doc->exportCaption($this->tipe);
					$doc->exportCaption($this->status);
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
						$doc->exportField($this->id_barang);
						$doc->exportField($this->totalhargajual);
						$doc->exportField($this->disc_pr);
						$doc->exportField($this->disc_rp);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->stok);
						$doc->exportField($this->satuan);
						$doc->exportField($this->minimum_stok);
						$doc->exportField($this->tgl_masuk);
						$doc->exportField($this->tgl_exp);
						$doc->exportField($this->kategori);
						$doc->exportField($this->subkategori);
						$doc->exportField($this->tipe);
						$doc->exportField($this->status);
					} else {
						$doc->exportField($this->id_hargajual);
						$doc->exportField($this->id_barang);
						$doc->exportField($this->totalhargajual);
						$doc->exportField($this->disc_pr);
						$doc->exportField($this->disc_rp);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->stok);
						$doc->exportField($this->satuan);
						$doc->exportField($this->minimum_stok);
						$doc->exportField($this->tgl_masuk);
						$doc->exportField($this->tgl_exp);
						$doc->exportField($this->kategori);
						$doc->exportField($this->subkategori);
						$doc->exportField($this->tipe);
						$doc->exportField($this->status);
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

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		//API DATA CABANG

		$url = "http://172.16.0.2:8069/web/customer";
		$data_sql = ExecuteRow("SELECT m_hargajual.*, m_barang.*, m_klinik.*, m_satuan_barang.*, kategoribarang.id AS id_kategori, kategoribarang.nama AS nama_kategori, subkategoribarang.id AS id_subkategori, subkategoribarang.nama AS nama_subkategori, m_status_barang.* FROM m_hargajual 
								JOIN m_barang ON m_hargajual.id_barang = m_barang.id
								JOIN m_klinik ON m_hargajual.id_klinik = m_klinik.id_klinik
								LEFT JOIN m_satuan_barang ON m_hargajual.satuan = m_satuan_barang.id_satuan
								LEFT JOIN kategoribarang ON m_hargajual.kategori = kategoribarang.id
								LEFT JOIN subkategoribarang ON m_hargajual.subkategori = subkategoribarang.id
								LEFT JOIN m_status_barang ON m_hargajual.status = m_status_barang.id_status WHERE m_hargajual.id_hargajual = '".$rsnew['id_hargajual']."'");
		$data_array = ['params' => [
			'id_hargajual' => $data_sql['id_hargajual'],
			'id_barang' => [
				'id_barang' => $data_sql['id_barang'],
				'kode_barang' => $data_sql['kode_barang'],
				'nama_barang' => $data_sql['nama_barang']
			],
			'tgl_masuk' => $data_sql['tgl_masuk'],
			'tgl_exp' => $data_sql['tgl_exp'],
			'hargajual' => $data_sql['totalhargajual'],
			'id_klinik' => [
				'id_klinik' => $data_sql['id_klinik'],
				'nama_klinik' => $data_sql['nama_klinik']
			],		
			'stok' => $data_sql['stok'],
			'minimum_stok' => $data_sql['minimum_stok'],
			'satuan' => [
				'id_satuan' => $data_sql['id_satuan'],
				'kode_satuan' => $data_sql['kode_satuan'],
				'nama_satuan' => $data_sql['nama_satuan']
			],
			'disc_pr' => $data_sql['disc_pr'],
		    'disc_rp' => $data_sql['disc_rp'],
			'kategori' => [
				'id_kategori' => $data_sql['id_kategori'],
				'nama_kategori' => $data_sql['nama_kategori']
			],
			'subkategori' => [
				'id_subkategori' => $data_sql['id_subkategori'],
				'nama_subkategori' => $data_sql['nama_subkategori']
			],
			'status' => [
				'id_status' => $data_sql['id_status'],
				'status_barang' => $data_sql['status_barang']
			],
		    'tipe' => $data_sql['tipe']		
		]];

		//$data = http_build_query($data_array);
		$postdata = json_encode($data_array);
		print_r($postdata);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		$resp = curl_exec($curl);
		if($e = curl_error($curl)){
			echo $e;
		} else {

			// $decoded = json_decode($resp);
			echo "Berhasil";
		}
		curl_close($curl);

		//die();
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

		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE){
			$this->id_klinik->CurrentValue = $id_klinik ;
			$this->id_klinik->ReadOnly = TRUE; 
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>