<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for permintaanpembelian
 */
class permintaanpembelian extends DbTable
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
	public $id_pp;
	public $no_pp;
	public $namapaket_pp;
	public $tgl_pp;
	public $tgl_kebutuhan;
	public $tgl_persetujuan;
	public $staf_pengajuan;
	public $staf_validasi;
	public $id_suplier;
	public $idklinik;
	public $validasi;
	public $status;
	public $email_pusat;
	public $email_cabang;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'permintaanpembelian';
		$this->TableName = 'permintaanpembelian';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`permintaanpembelian`";
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

		// id_pp
		$this->id_pp = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_id_pp', 'id_pp', '`id_pp`', '`id_pp`', 3, 11, -1, FALSE, '`id_pp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_pp->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_pp->IsPrimaryKey = TRUE; // Primary key field
		$this->id_pp->IsForeignKey = TRUE; // Foreign key field
		$this->id_pp->Sortable = TRUE; // Allow sort
		$this->id_pp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pp'] = &$this->id_pp;

		// no_pp
		$this->no_pp = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_no_pp', 'no_pp', '`no_pp`', '`no_pp`', 200, 255, -1, FALSE, '`no_pp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->no_pp->Sortable = TRUE; // Allow sort
		$this->fields['no_pp'] = &$this->no_pp;

		// namapaket_pp
		$this->namapaket_pp = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_namapaket_pp', 'namapaket_pp', '`namapaket_pp`', '`namapaket_pp`', 200, 50, -1, FALSE, '`namapaket_pp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->namapaket_pp->Sortable = TRUE; // Allow sort
		$this->fields['namapaket_pp'] = &$this->namapaket_pp;

		// tgl_pp
		$this->tgl_pp = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_tgl_pp', 'tgl_pp', '`tgl_pp`', CastDateFieldForLike("`tgl_pp`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_pp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_pp->Sortable = TRUE; // Allow sort
		$this->tgl_pp->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_pp'] = &$this->tgl_pp;

		// tgl_kebutuhan
		$this->tgl_kebutuhan = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_tgl_kebutuhan', 'tgl_kebutuhan', '`tgl_kebutuhan`', CastDateFieldForLike("`tgl_kebutuhan`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_kebutuhan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_kebutuhan->Sortable = TRUE; // Allow sort
		$this->tgl_kebutuhan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_kebutuhan'] = &$this->tgl_kebutuhan;

		// tgl_persetujuan
		$this->tgl_persetujuan = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_tgl_persetujuan', 'tgl_persetujuan', '`tgl_persetujuan`', CastDateFieldForLike("`tgl_persetujuan`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_persetujuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_persetujuan->Sortable = TRUE; // Allow sort
		$this->tgl_persetujuan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_persetujuan'] = &$this->tgl_persetujuan;

		// staf_pengajuan
		$this->staf_pengajuan = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_staf_pengajuan', 'staf_pengajuan', '`staf_pengajuan`', '`staf_pengajuan`', 3, 11, -1, FALSE, '`staf_pengajuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->staf_pengajuan->Sortable = TRUE; // Allow sort
		$this->staf_pengajuan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->staf_pengajuan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->staf_pengajuan->Lookup = new Lookup('staf_pengajuan', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","","",""], [], [], [], [], [], [], '', '');
		$this->staf_pengajuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['staf_pengajuan'] = &$this->staf_pengajuan;

		// staf_validasi
		$this->staf_validasi = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_staf_validasi', 'staf_validasi', '`staf_validasi`', '`staf_validasi`', 3, 11, -1, FALSE, '`staf_validasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->staf_validasi->Sortable = TRUE; // Allow sort
		$this->staf_validasi->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->staf_validasi->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->staf_validasi->Lookup = new Lookup('staf_validasi', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","","",""], [], [], [], [], [], [], '', '');
		$this->staf_validasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['staf_validasi'] = &$this->staf_validasi;

		// id_suplier
		$this->id_suplier = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_id_suplier', 'id_suplier', '`id_suplier`', '`id_suplier`', 3, 11, -1, FALSE, '`id_suplier`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_suplier->Sortable = TRUE; // Allow sort
		$this->id_suplier->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_suplier->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_suplier->Lookup = new Lookup('id_suplier', 'm_supplier', FALSE, 'id_supplier', ["nama_supplier","","",""], [], [], [], [], [], [], '', '');
		$this->id_suplier->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_suplier'] = &$this->id_suplier;

		// idklinik
		$this->idklinik = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_idklinik', 'idklinik', '`idklinik`', '`idklinik`', 3, 11, -1, FALSE, '`idklinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->idklinik->Sortable = TRUE; // Allow sort
		$this->idklinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->idklinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->idklinik->Lookup = new Lookup('idklinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->idklinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idklinik'] = &$this->idklinik;

		// validasi
		$this->validasi = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_validasi', 'validasi', '`validasi`', '`validasi`', 16, 6, -1, FALSE, '`validasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->validasi->Sortable = TRUE; // Allow sort
		$this->validasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['validasi'] = &$this->validasi;

		// status
		$this->status = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_status', 'status', '`status`', '`status`', 202, 5, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->Lookup = new Lookup('status', 'permintaanpembelian', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status->OptionCount = 2;
		$this->fields['status'] = &$this->status;

		// email_pusat
		$this->email_pusat = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_email_pusat', 'email_pusat', '`email_pusat`', '`email_pusat`', 200, 255, -1, FALSE, '`email_pusat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->email_pusat->Sortable = TRUE; // Allow sort
		$this->fields['email_pusat'] = &$this->email_pusat;

		// email_cabang
		$this->email_cabang = new DbField('permintaanpembelian', 'permintaanpembelian', 'x_email_cabang', 'email_cabang', '`email_cabang`', '`email_cabang`', 200, 255, -1, FALSE, '`email_cabang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->email_cabang->Sortable = TRUE; // Allow sort
		$this->fields['email_cabang'] = &$this->email_cabang;
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
		if ($this->getCurrentDetailTable() == "detailmintapembelian") {
			$detailUrl = $GLOBALS["detailmintapembelian"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id_pp=" . urlencode($this->id_pp->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "permintaanpembelianlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`permintaanpembelian`";
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
			$this->id_pp->setDbValue($conn->insert_ID());
			$rs['id_pp'] = $this->id_pp->DbValue;
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

		// Cascade Update detail table 'detailmintapembelian'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['id_pp']) && $rsold['id_pp'] != $rs['id_pp'])) { // Update detail field 'pid_pp'
			$cascadeUpdate = TRUE;
			$rscascade['pid_pp'] = $rs['id_pp'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["detailmintapembelian"]))
				$GLOBALS["detailmintapembelian"] = new detailmintapembelian();
			$rswrk = $GLOBALS["detailmintapembelian"]->loadRs("`pid_pp` = " . QuotedValue($rsold['id_pp'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'id_detailpp';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["detailmintapembelian"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["detailmintapembelian"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["detailmintapembelian"]->Row_Updated($rsdtlold, $rsdtlnew);
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
			if (array_key_exists('id_pp', $rs))
				AddFilter($where, QuotedName('id_pp', $this->Dbid) . '=' . QuotedValue($rs['id_pp'], $this->id_pp->DataType, $this->Dbid));
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

		// Cascade delete detail table 'detailmintapembelian'
		if (!isset($GLOBALS["detailmintapembelian"]))
			$GLOBALS["detailmintapembelian"] = new detailmintapembelian();
		$rscascade = $GLOBALS["detailmintapembelian"]->loadRs("`pid_pp` = " . QuotedValue($rs['id_pp'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["detailmintapembelian"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["detailmintapembelian"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["detailmintapembelian"]->Row_Deleted($dtlrow);
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
		$this->id_pp->DbValue = $row['id_pp'];
		$this->no_pp->DbValue = $row['no_pp'];
		$this->namapaket_pp->DbValue = $row['namapaket_pp'];
		$this->tgl_pp->DbValue = $row['tgl_pp'];
		$this->tgl_kebutuhan->DbValue = $row['tgl_kebutuhan'];
		$this->tgl_persetujuan->DbValue = $row['tgl_persetujuan'];
		$this->staf_pengajuan->DbValue = $row['staf_pengajuan'];
		$this->staf_validasi->DbValue = $row['staf_validasi'];
		$this->id_suplier->DbValue = $row['id_suplier'];
		$this->idklinik->DbValue = $row['idklinik'];
		$this->validasi->DbValue = $row['validasi'];
		$this->status->DbValue = $row['status'];
		$this->email_pusat->DbValue = $row['email_pusat'];
		$this->email_cabang->DbValue = $row['email_cabang'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_pp` = @id_pp@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_pp', $row) ? $row['id_pp'] : NULL;
		else
			$val = $this->id_pp->OldValue !== NULL ? $this->id_pp->OldValue : $this->id_pp->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_pp@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "permintaanpembelianlist.php";
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
		if ($pageName == "permintaanpembelianview.php")
			return $Language->phrase("View");
		elseif ($pageName == "permintaanpembelianedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "permintaanpembelianadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "permintaanpembelianlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("permintaanpembelianview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("permintaanpembelianview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "permintaanpembelianadd.php?" . $this->getUrlParm($parm);
		else
			$url = "permintaanpembelianadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("permintaanpembelianedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("permintaanpembelianedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("permintaanpembelianadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("permintaanpembelianadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("permintaanpembeliandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_pp:" . JsonEncode($this->id_pp->CurrentValue, "number");
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
		if ($this->id_pp->CurrentValue != NULL) {
			$url .= "id_pp=" . urlencode($this->id_pp->CurrentValue);
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
			if (Param("id_pp") !== NULL)
				$arKeys[] = Param("id_pp");
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
				$this->id_pp->CurrentValue = $key;
			else
				$this->id_pp->OldValue = $key;
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
		$this->id_pp->setDbValue($rs->fields('id_pp'));
		$this->no_pp->setDbValue($rs->fields('no_pp'));
		$this->namapaket_pp->setDbValue($rs->fields('namapaket_pp'));
		$this->tgl_pp->setDbValue($rs->fields('tgl_pp'));
		$this->tgl_kebutuhan->setDbValue($rs->fields('tgl_kebutuhan'));
		$this->tgl_persetujuan->setDbValue($rs->fields('tgl_persetujuan'));
		$this->staf_pengajuan->setDbValue($rs->fields('staf_pengajuan'));
		$this->staf_validasi->setDbValue($rs->fields('staf_validasi'));
		$this->id_suplier->setDbValue($rs->fields('id_suplier'));
		$this->idklinik->setDbValue($rs->fields('idklinik'));
		$this->validasi->setDbValue($rs->fields('validasi'));
		$this->status->setDbValue($rs->fields('status'));
		$this->email_pusat->setDbValue($rs->fields('email_pusat'));
		$this->email_cabang->setDbValue($rs->fields('email_cabang'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_pp
		// no_pp
		// namapaket_pp
		// tgl_pp
		// tgl_kebutuhan
		// tgl_persetujuan
		// staf_pengajuan
		// staf_validasi
		// id_suplier
		// idklinik
		// validasi
		// status
		// email_pusat
		// email_cabang
		// id_pp

		$this->id_pp->ViewValue = $this->id_pp->CurrentValue;
		$this->id_pp->ViewCustomAttributes = "";

		// no_pp
		$this->no_pp->ViewValue = $this->no_pp->CurrentValue;
		$this->no_pp->ViewCustomAttributes = "";

		// namapaket_pp
		$this->namapaket_pp->ViewValue = $this->namapaket_pp->CurrentValue;
		$this->namapaket_pp->ViewCustomAttributes = "";

		// tgl_pp
		$this->tgl_pp->ViewValue = $this->tgl_pp->CurrentValue;
		$this->tgl_pp->ViewValue = FormatDateTime($this->tgl_pp->ViewValue, 0);
		$this->tgl_pp->ViewCustomAttributes = "";

		// tgl_kebutuhan
		$this->tgl_kebutuhan->ViewValue = $this->tgl_kebutuhan->CurrentValue;
		$this->tgl_kebutuhan->ViewValue = FormatDateTime($this->tgl_kebutuhan->ViewValue, 0);
		$this->tgl_kebutuhan->ViewCustomAttributes = "";

		// tgl_persetujuan
		$this->tgl_persetujuan->ViewValue = $this->tgl_persetujuan->CurrentValue;
		$this->tgl_persetujuan->ViewValue = FormatDateTime($this->tgl_persetujuan->ViewValue, 0);
		$this->tgl_persetujuan->ViewCustomAttributes = "";

		// staf_pengajuan
		$curVal = strval($this->staf_pengajuan->CurrentValue);
		if ($curVal != "") {
			$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->lookupCacheOption($curVal);
			if ($this->staf_pengajuan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->staf_pengajuan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->staf_pengajuan->ViewValue = $this->staf_pengajuan->CurrentValue;
				}
			}
		} else {
			$this->staf_pengajuan->ViewValue = NULL;
		}
		$this->staf_pengajuan->ViewCustomAttributes = "";

		// staf_validasi
		$curVal = strval($this->staf_validasi->CurrentValue);
		if ($curVal != "") {
			$this->staf_validasi->ViewValue = $this->staf_validasi->lookupCacheOption($curVal);
			if ($this->staf_validasi->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->staf_validasi->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->staf_validasi->ViewValue = $this->staf_validasi->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->staf_validasi->ViewValue = $this->staf_validasi->CurrentValue;
				}
			}
		} else {
			$this->staf_validasi->ViewValue = NULL;
		}
		$this->staf_validasi->ViewCustomAttributes = "";

		// id_suplier
		$curVal = strval($this->id_suplier->CurrentValue);
		if ($curVal != "") {
			$this->id_suplier->ViewValue = $this->id_suplier->lookupCacheOption($curVal);
			if ($this->id_suplier->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_supplier`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_suplier->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_suplier->ViewValue = $this->id_suplier->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_suplier->ViewValue = $this->id_suplier->CurrentValue;
				}
			}
		} else {
			$this->id_suplier->ViewValue = NULL;
		}
		$this->id_suplier->ViewCustomAttributes = "";

		// idklinik
		$curVal = strval($this->idklinik->CurrentValue);
		if ($curVal != "") {
			$this->idklinik->ViewValue = $this->idklinik->lookupCacheOption($curVal);
			if ($this->idklinik->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->idklinik->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->idklinik->ViewValue = $this->idklinik->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->idklinik->ViewValue = $this->idklinik->CurrentValue;
				}
			}
		} else {
			$this->idklinik->ViewValue = NULL;
		}
		$this->idklinik->ViewCustomAttributes = "";

		// validasi
		$this->validasi->ViewValue = $this->validasi->CurrentValue;
		$this->validasi->ViewValue = FormatNumber($this->validasi->ViewValue, 0, -2, -2, -2);
		$this->validasi->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) != "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// email_pusat
		$this->email_pusat->ViewValue = $this->email_pusat->CurrentValue;
		$this->email_pusat->ViewCustomAttributes = "";

		// email_cabang
		$this->email_cabang->ViewValue = $this->email_cabang->CurrentValue;
		$this->email_cabang->ViewCustomAttributes = "";

		// id_pp
		$this->id_pp->LinkCustomAttributes = "";
		$this->id_pp->HrefValue = "";
		$this->id_pp->TooltipValue = "";

		// no_pp
		$this->no_pp->LinkCustomAttributes = "";
		$this->no_pp->HrefValue = "";
		$this->no_pp->TooltipValue = "";

		// namapaket_pp
		$this->namapaket_pp->LinkCustomAttributes = "";
		$this->namapaket_pp->HrefValue = "";
		$this->namapaket_pp->TooltipValue = "";

		// tgl_pp
		$this->tgl_pp->LinkCustomAttributes = "";
		$this->tgl_pp->HrefValue = "";
		$this->tgl_pp->TooltipValue = "";

		// tgl_kebutuhan
		$this->tgl_kebutuhan->LinkCustomAttributes = "";
		$this->tgl_kebutuhan->HrefValue = "";
		$this->tgl_kebutuhan->TooltipValue = "";

		// tgl_persetujuan
		$this->tgl_persetujuan->LinkCustomAttributes = "";
		$this->tgl_persetujuan->HrefValue = "";
		$this->tgl_persetujuan->TooltipValue = "";

		// staf_pengajuan
		$this->staf_pengajuan->LinkCustomAttributes = "";
		$this->staf_pengajuan->HrefValue = "";
		$this->staf_pengajuan->TooltipValue = "";

		// staf_validasi
		$this->staf_validasi->LinkCustomAttributes = "";
		$this->staf_validasi->HrefValue = "";
		$this->staf_validasi->TooltipValue = "";

		// id_suplier
		$this->id_suplier->LinkCustomAttributes = "";
		$this->id_suplier->HrefValue = "";
		$this->id_suplier->TooltipValue = "";

		// idklinik
		$this->idklinik->LinkCustomAttributes = "";
		$this->idklinik->HrefValue = "";
		$this->idklinik->TooltipValue = "";

		// validasi
		$this->validasi->LinkCustomAttributes = "";
		$this->validasi->HrefValue = "";
		$this->validasi->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// email_pusat
		$this->email_pusat->LinkCustomAttributes = "";
		$this->email_pusat->HrefValue = "";
		$this->email_pusat->TooltipValue = "";

		// email_cabang
		$this->email_cabang->LinkCustomAttributes = "";
		$this->email_cabang->HrefValue = "";
		$this->email_cabang->TooltipValue = "";

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

		// id_pp
		$this->id_pp->EditAttrs["class"] = "form-control";
		$this->id_pp->EditCustomAttributes = "";
		$this->id_pp->EditValue = $this->id_pp->CurrentValue;
		$this->id_pp->ViewCustomAttributes = "";

		// no_pp
		$this->no_pp->EditAttrs["class"] = "form-control";
		$this->no_pp->EditCustomAttributes = "";
		if (!$this->no_pp->Raw)
			$this->no_pp->CurrentValue = HtmlDecode($this->no_pp->CurrentValue);
		$this->no_pp->EditValue = $this->no_pp->CurrentValue;
		$this->no_pp->PlaceHolder = RemoveHtml($this->no_pp->caption());

		// namapaket_pp
		$this->namapaket_pp->EditAttrs["class"] = "form-control";
		$this->namapaket_pp->EditCustomAttributes = "";
		if (!$this->namapaket_pp->Raw)
			$this->namapaket_pp->CurrentValue = HtmlDecode($this->namapaket_pp->CurrentValue);
		$this->namapaket_pp->EditValue = $this->namapaket_pp->CurrentValue;
		$this->namapaket_pp->PlaceHolder = RemoveHtml($this->namapaket_pp->caption());

		// tgl_pp
		$this->tgl_pp->EditAttrs["class"] = "form-control";
		$this->tgl_pp->EditCustomAttributes = "";
		$this->tgl_pp->EditValue = FormatDateTime($this->tgl_pp->CurrentValue, 8);
		$this->tgl_pp->PlaceHolder = RemoveHtml($this->tgl_pp->caption());

		// tgl_kebutuhan
		$this->tgl_kebutuhan->EditAttrs["class"] = "form-control";
		$this->tgl_kebutuhan->EditCustomAttributes = "";
		$this->tgl_kebutuhan->EditValue = FormatDateTime($this->tgl_kebutuhan->CurrentValue, 8);
		$this->tgl_kebutuhan->PlaceHolder = RemoveHtml($this->tgl_kebutuhan->caption());

		// tgl_persetujuan
		$this->tgl_persetujuan->EditAttrs["class"] = "form-control";
		$this->tgl_persetujuan->EditCustomAttributes = "";
		$this->tgl_persetujuan->EditValue = FormatDateTime($this->tgl_persetujuan->CurrentValue, 8);
		$this->tgl_persetujuan->PlaceHolder = RemoveHtml($this->tgl_persetujuan->caption());

		// staf_pengajuan
		$this->staf_pengajuan->EditAttrs["class"] = "form-control";
		$this->staf_pengajuan->EditCustomAttributes = "";

		// staf_validasi
		$this->staf_validasi->EditAttrs["class"] = "form-control";
		$this->staf_validasi->EditCustomAttributes = "";

		// id_suplier
		$this->id_suplier->EditAttrs["class"] = "form-control";
		$this->id_suplier->EditCustomAttributes = "";

		// idklinik
		$this->idklinik->EditAttrs["class"] = "form-control";
		$this->idklinik->EditCustomAttributes = "";

		// validasi
		$this->validasi->EditAttrs["class"] = "form-control";
		$this->validasi->EditCustomAttributes = "";
		$this->validasi->EditValue = $this->validasi->CurrentValue;
		$this->validasi->PlaceHolder = RemoveHtml($this->validasi->caption());

		// status
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(FALSE);

		// email_pusat
		$this->email_pusat->EditAttrs["class"] = "form-control";
		$this->email_pusat->EditCustomAttributes = "";
		if (!$this->email_pusat->Raw)
			$this->email_pusat->CurrentValue = HtmlDecode($this->email_pusat->CurrentValue);
		$this->email_pusat->EditValue = $this->email_pusat->CurrentValue;
		$this->email_pusat->PlaceHolder = RemoveHtml($this->email_pusat->caption());

		// email_cabang
		$this->email_cabang->EditAttrs["class"] = "form-control";
		$this->email_cabang->EditCustomAttributes = "";
		if (!$this->email_cabang->Raw)
			$this->email_cabang->CurrentValue = HtmlDecode($this->email_cabang->CurrentValue);
		$this->email_cabang->EditValue = $this->email_cabang->CurrentValue;
		$this->email_cabang->PlaceHolder = RemoveHtml($this->email_cabang->caption());

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
					$doc->exportCaption($this->id_pp);
					$doc->exportCaption($this->no_pp);
					$doc->exportCaption($this->namapaket_pp);
					$doc->exportCaption($this->tgl_pp);
					$doc->exportCaption($this->tgl_kebutuhan);
					$doc->exportCaption($this->tgl_persetujuan);
					$doc->exportCaption($this->staf_pengajuan);
					$doc->exportCaption($this->staf_validasi);
					$doc->exportCaption($this->id_suplier);
					$doc->exportCaption($this->idklinik);
					$doc->exportCaption($this->validasi);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->email_pusat);
					$doc->exportCaption($this->email_cabang);
				} else {
					$doc->exportCaption($this->id_pp);
					$doc->exportCaption($this->no_pp);
					$doc->exportCaption($this->namapaket_pp);
					$doc->exportCaption($this->tgl_pp);
					$doc->exportCaption($this->tgl_kebutuhan);
					$doc->exportCaption($this->tgl_persetujuan);
					$doc->exportCaption($this->staf_pengajuan);
					$doc->exportCaption($this->staf_validasi);
					$doc->exportCaption($this->id_suplier);
					$doc->exportCaption($this->idklinik);
					$doc->exportCaption($this->validasi);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->email_pusat);
					$doc->exportCaption($this->email_cabang);
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
						$doc->exportField($this->id_pp);
						$doc->exportField($this->no_pp);
						$doc->exportField($this->namapaket_pp);
						$doc->exportField($this->tgl_pp);
						$doc->exportField($this->tgl_kebutuhan);
						$doc->exportField($this->tgl_persetujuan);
						$doc->exportField($this->staf_pengajuan);
						$doc->exportField($this->staf_validasi);
						$doc->exportField($this->id_suplier);
						$doc->exportField($this->idklinik);
						$doc->exportField($this->validasi);
						$doc->exportField($this->status);
						$doc->exportField($this->email_pusat);
						$doc->exportField($this->email_cabang);
					} else {
						$doc->exportField($this->id_pp);
						$doc->exportField($this->no_pp);
						$doc->exportField($this->namapaket_pp);
						$doc->exportField($this->tgl_pp);
						$doc->exportField($this->tgl_kebutuhan);
						$doc->exportField($this->tgl_persetujuan);
						$doc->exportField($this->staf_pengajuan);
						$doc->exportField($this->staf_validasi);
						$doc->exportField($this->id_suplier);
						$doc->exportField($this->idklinik);
						$doc->exportField($this->validasi);
						$doc->exportField($this->status);
						$doc->exportField($this->email_pusat);
						$doc->exportField($this->email_cabang);
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
			$filter = "idklinik = '".$id_klinik."'";
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
		$id_po=$rsnew['id_pp'];
		$no_pr=$rsnew['no_pp'];
		$no_po='PO-'.strval($no_pr);
		$tgl_po=$rsnew['tgl_pp'];
		$sql="insert into purchaseorder(id_po,no_pr,no_po,tgl_po) values($id_po,'$no_pr','$no_po','$tgl_po') ";
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

		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE){
			$this->idklinik->CurrentValue = $id_klinik ;
			$this->idklinik->ReadOnly = TRUE; 
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>