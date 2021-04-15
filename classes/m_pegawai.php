<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for m_pegawai
 */
class m_pegawai extends DbTable
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
	public $id_pegawai;
	public $nama_pegawai;
	public $nama_lengkap;
	public $jenis_pegawai;
	public $nik_pegawai;
	public $agama_pegawai;
	public $tgllahir_pegawai;
	public $alamat_pegawai;
	public $hp_pegawai;
	public $pendidikan_pegawai;
	public $jurusan_pegawai;
	public $spesialis_pegawai;
	public $jabatan_pegawai;
	public $status_pegawai;
	public $tarif_pegawai;
	public $id_klinik;
	public $target;
	public $nilai_komisi;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'm_pegawai';
		$this->TableName = 'm_pegawai';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`m_pegawai`";
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

		// id_pegawai
		$this->id_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_id_pegawai', 'id_pegawai', '`id_pegawai`', '`id_pegawai`', 3, 11, -1, FALSE, '`id_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id_pegawai->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id_pegawai->IsPrimaryKey = TRUE; // Primary key field
		$this->id_pegawai->Sortable = TRUE; // Allow sort
		$this->id_pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pegawai'] = &$this->id_pegawai;

		// nama_pegawai
		$this->nama_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_nama_pegawai', 'nama_pegawai', '`nama_pegawai`', '`nama_pegawai`', 200, 255, -1, FALSE, '`nama_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['nama_pegawai'] = &$this->nama_pegawai;

		// nama_lengkap
		$this->nama_lengkap = new DbField('m_pegawai', 'm_pegawai', 'x_nama_lengkap', 'nama_lengkap', '`nama_lengkap`', '`nama_lengkap`', 200, 255, -1, FALSE, '`nama_lengkap`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama_lengkap->Sortable = TRUE; // Allow sort
		$this->fields['nama_lengkap'] = &$this->nama_lengkap;

		// jenis_pegawai
		$this->jenis_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_jenis_pegawai', 'jenis_pegawai', '`jenis_pegawai`', '`jenis_pegawai`', 202, 9, -1, FALSE, '`jenis_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->jenis_pegawai->Sortable = TRUE; // Allow sort
		$this->jenis_pegawai->Lookup = new Lookup('jenis_pegawai', 'm_pegawai', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->jenis_pegawai->OptionCount = 2;
		$this->fields['jenis_pegawai'] = &$this->jenis_pegawai;

		// nik_pegawai
		$this->nik_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_nik_pegawai', 'nik_pegawai', '`nik_pegawai`', '`nik_pegawai`', 200, 50, -1, FALSE, '`nik_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nik_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['nik_pegawai'] = &$this->nik_pegawai;

		// agama_pegawai
		$this->agama_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_agama_pegawai', 'agama_pegawai', '`agama_pegawai`', '`agama_pegawai`', 19, 11, -1, FALSE, '`agama_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->agama_pegawai->Sortable = TRUE; // Allow sort
		$this->agama_pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->agama_pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->agama_pegawai->Lookup = new Lookup('agama_pegawai', 'm_agama', FALSE, 'id_agama', ["nama_agama","","",""], [], [], [], [], [], [], '', '');
		$this->agama_pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['agama_pegawai'] = &$this->agama_pegawai;

		// tgllahir_pegawai
		$this->tgllahir_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_tgllahir_pegawai', 'tgllahir_pegawai', '`tgllahir_pegawai`', CastDateFieldForLike("`tgllahir_pegawai`", 0, "DB"), 133, 10, 0, FALSE, '`tgllahir_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgllahir_pegawai->Sortable = TRUE; // Allow sort
		$this->tgllahir_pegawai->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgllahir_pegawai'] = &$this->tgllahir_pegawai;

		// alamat_pegawai
		$this->alamat_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_alamat_pegawai', 'alamat_pegawai', '`alamat_pegawai`', '`alamat_pegawai`', 200, 255, -1, FALSE, '`alamat_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['alamat_pegawai'] = &$this->alamat_pegawai;

		// hp_pegawai
		$this->hp_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_hp_pegawai', 'hp_pegawai', '`hp_pegawai`', '`hp_pegawai`', 200, 20, -1, FALSE, '`hp_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['hp_pegawai'] = &$this->hp_pegawai;

		// pendidikan_pegawai
		$this->pendidikan_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_pendidikan_pegawai', 'pendidikan_pegawai', '`pendidikan_pegawai`', '`pendidikan_pegawai`', 200, 255, -1, FALSE, '`pendidikan_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pendidikan_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['pendidikan_pegawai'] = &$this->pendidikan_pegawai;

		// jurusan_pegawai
		$this->jurusan_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_jurusan_pegawai', 'jurusan_pegawai', '`jurusan_pegawai`', '`jurusan_pegawai`', 200, 255, -1, FALSE, '`jurusan_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jurusan_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['jurusan_pegawai'] = &$this->jurusan_pegawai;

		// spesialis_pegawai
		$this->spesialis_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_spesialis_pegawai', 'spesialis_pegawai', '`spesialis_pegawai`', '`spesialis_pegawai`', 200, 255, -1, FALSE, '`spesialis_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->spesialis_pegawai->Sortable = TRUE; // Allow sort
		$this->fields['spesialis_pegawai'] = &$this->spesialis_pegawai;

		// jabatan_pegawai
		$this->jabatan_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_jabatan_pegawai', 'jabatan_pegawai', '`jabatan_pegawai`', '`jabatan_pegawai`', 19, 11, -1, FALSE, '`jabatan_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jabatan_pegawai->Sortable = TRUE; // Allow sort
		$this->jabatan_pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jabatan_pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jabatan_pegawai->Lookup = new Lookup('jabatan_pegawai', 'm_jabatan', FALSE, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->jabatan_pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jabatan_pegawai'] = &$this->jabatan_pegawai;

		// status_pegawai
		$this->status_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_status_pegawai', 'status_pegawai', '`status_pegawai`', '`status_pegawai`', 202, 9, -1, FALSE, '`status_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status_pegawai->Sortable = TRUE; // Allow sort
		$this->status_pegawai->Lookup = new Lookup('status_pegawai', 'm_pegawai', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status_pegawai->OptionCount = 2;
		$this->fields['status_pegawai'] = &$this->status_pegawai;

		// tarif_pegawai
		$this->tarif_pegawai = new DbField('m_pegawai', 'm_pegawai', 'x_tarif_pegawai', 'tarif_pegawai', '`tarif_pegawai`', '`tarif_pegawai`', 3, 11, -1, FALSE, '`tarif_pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tarif_pegawai->Sortable = TRUE; // Allow sort
		$this->tarif_pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tarif_pegawai'] = &$this->tarif_pegawai;

		// id_klinik
		$this->id_klinik = new DbField('m_pegawai', 'm_pegawai', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], [], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// target
		$this->target = new DbField('m_pegawai', 'm_pegawai', 'x_target', 'target', '`target`', '`target`', 3, 11, -1, FALSE, '`target`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->target->Sortable = TRUE; // Allow sort
		$this->target->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['target'] = &$this->target;

		// nilai_komisi
		$this->nilai_komisi = new DbField('m_pegawai', 'm_pegawai', 'x_nilai_komisi', 'nilai_komisi', '`nilai_komisi`', '`nilai_komisi`', 3, 11, -1, FALSE, '`nilai_komisi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nilai_komisi->Sortable = TRUE; // Allow sort
		$this->nilai_komisi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nilai_komisi'] = &$this->nilai_komisi;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`m_pegawai`";
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
			$this->id_pegawai->setDbValue($conn->insert_ID());
			$rs['id_pegawai'] = $this->id_pegawai->DbValue;
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
			if (array_key_exists('id_pegawai', $rs))
				AddFilter($where, QuotedName('id_pegawai', $this->Dbid) . '=' . QuotedValue($rs['id_pegawai'], $this->id_pegawai->DataType, $this->Dbid));
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
		$this->id_pegawai->DbValue = $row['id_pegawai'];
		$this->nama_pegawai->DbValue = $row['nama_pegawai'];
		$this->nama_lengkap->DbValue = $row['nama_lengkap'];
		$this->jenis_pegawai->DbValue = $row['jenis_pegawai'];
		$this->nik_pegawai->DbValue = $row['nik_pegawai'];
		$this->agama_pegawai->DbValue = $row['agama_pegawai'];
		$this->tgllahir_pegawai->DbValue = $row['tgllahir_pegawai'];
		$this->alamat_pegawai->DbValue = $row['alamat_pegawai'];
		$this->hp_pegawai->DbValue = $row['hp_pegawai'];
		$this->pendidikan_pegawai->DbValue = $row['pendidikan_pegawai'];
		$this->jurusan_pegawai->DbValue = $row['jurusan_pegawai'];
		$this->spesialis_pegawai->DbValue = $row['spesialis_pegawai'];
		$this->jabatan_pegawai->DbValue = $row['jabatan_pegawai'];
		$this->status_pegawai->DbValue = $row['status_pegawai'];
		$this->tarif_pegawai->DbValue = $row['tarif_pegawai'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->target->DbValue = $row['target'];
		$this->nilai_komisi->DbValue = $row['nilai_komisi'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id_pegawai` = @id_pegawai@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id_pegawai', $row) ? $row['id_pegawai'] : NULL;
		else
			$val = $this->id_pegawai->OldValue !== NULL ? $this->id_pegawai->OldValue : $this->id_pegawai->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id_pegawai@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "m_pegawailist.php";
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
		if ($pageName == "m_pegawaiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "m_pegawaiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "m_pegawaiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "m_pegawailist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("m_pegawaiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("m_pegawaiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "m_pegawaiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "m_pegawaiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("m_pegawaiedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("m_pegawaiadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("m_pegawaidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id_pegawai:" . JsonEncode($this->id_pegawai->CurrentValue, "number");
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
		if ($this->id_pegawai->CurrentValue != NULL) {
			$url .= "id_pegawai=" . urlencode($this->id_pegawai->CurrentValue);
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
			if (Param("id_pegawai") !== NULL)
				$arKeys[] = Param("id_pegawai");
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
				$this->id_pegawai->CurrentValue = $key;
			else
				$this->id_pegawai->OldValue = $key;
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
		$this->id_pegawai->setDbValue($rs->fields('id_pegawai'));
		$this->nama_pegawai->setDbValue($rs->fields('nama_pegawai'));
		$this->nama_lengkap->setDbValue($rs->fields('nama_lengkap'));
		$this->jenis_pegawai->setDbValue($rs->fields('jenis_pegawai'));
		$this->nik_pegawai->setDbValue($rs->fields('nik_pegawai'));
		$this->agama_pegawai->setDbValue($rs->fields('agama_pegawai'));
		$this->tgllahir_pegawai->setDbValue($rs->fields('tgllahir_pegawai'));
		$this->alamat_pegawai->setDbValue($rs->fields('alamat_pegawai'));
		$this->hp_pegawai->setDbValue($rs->fields('hp_pegawai'));
		$this->pendidikan_pegawai->setDbValue($rs->fields('pendidikan_pegawai'));
		$this->jurusan_pegawai->setDbValue($rs->fields('jurusan_pegawai'));
		$this->spesialis_pegawai->setDbValue($rs->fields('spesialis_pegawai'));
		$this->jabatan_pegawai->setDbValue($rs->fields('jabatan_pegawai'));
		$this->status_pegawai->setDbValue($rs->fields('status_pegawai'));
		$this->tarif_pegawai->setDbValue($rs->fields('tarif_pegawai'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->target->setDbValue($rs->fields('target'));
		$this->nilai_komisi->setDbValue($rs->fields('nilai_komisi'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id_pegawai
		// nama_pegawai
		// nama_lengkap
		// jenis_pegawai
		// nik_pegawai
		// agama_pegawai
		// tgllahir_pegawai
		// alamat_pegawai
		// hp_pegawai
		// pendidikan_pegawai
		// jurusan_pegawai
		// spesialis_pegawai
		// jabatan_pegawai
		// status_pegawai
		// tarif_pegawai
		// id_klinik
		// target
		// nilai_komisi
		// id_pegawai

		$this->id_pegawai->ViewValue = $this->id_pegawai->CurrentValue;
		$this->id_pegawai->ViewCustomAttributes = "";

		// nama_pegawai
		$this->nama_pegawai->ViewValue = $this->nama_pegawai->CurrentValue;
		$this->nama_pegawai->ViewCustomAttributes = "";

		// nama_lengkap
		$this->nama_lengkap->ViewValue = $this->nama_lengkap->CurrentValue;
		$this->nama_lengkap->ViewCustomAttributes = "";

		// jenis_pegawai
		if (strval($this->jenis_pegawai->CurrentValue) != "") {
			$this->jenis_pegawai->ViewValue = $this->jenis_pegawai->optionCaption($this->jenis_pegawai->CurrentValue);
		} else {
			$this->jenis_pegawai->ViewValue = NULL;
		}
		$this->jenis_pegawai->ViewCustomAttributes = "";

		// nik_pegawai
		$this->nik_pegawai->ViewValue = $this->nik_pegawai->CurrentValue;
		$this->nik_pegawai->ViewCustomAttributes = "";

		// agama_pegawai
		$curVal = strval($this->agama_pegawai->CurrentValue);
		if ($curVal != "") {
			$this->agama_pegawai->ViewValue = $this->agama_pegawai->lookupCacheOption($curVal);
			if ($this->agama_pegawai->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_agama`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->agama_pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->agama_pegawai->ViewValue = $this->agama_pegawai->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->agama_pegawai->ViewValue = $this->agama_pegawai->CurrentValue;
				}
			}
		} else {
			$this->agama_pegawai->ViewValue = NULL;
		}
		$this->agama_pegawai->ViewCustomAttributes = "";

		// tgllahir_pegawai
		$this->tgllahir_pegawai->ViewValue = $this->tgllahir_pegawai->CurrentValue;
		$this->tgllahir_pegawai->ViewValue = FormatDateTime($this->tgllahir_pegawai->ViewValue, 0);
		$this->tgllahir_pegawai->ViewCustomAttributes = "";

		// alamat_pegawai
		$this->alamat_pegawai->ViewValue = $this->alamat_pegawai->CurrentValue;
		$this->alamat_pegawai->ViewCustomAttributes = "";

		// hp_pegawai
		$this->hp_pegawai->ViewValue = $this->hp_pegawai->CurrentValue;
		$this->hp_pegawai->ViewCustomAttributes = "";

		// pendidikan_pegawai
		$this->pendidikan_pegawai->ViewValue = $this->pendidikan_pegawai->CurrentValue;
		$this->pendidikan_pegawai->ViewCustomAttributes = "";

		// jurusan_pegawai
		$this->jurusan_pegawai->ViewValue = $this->jurusan_pegawai->CurrentValue;
		$this->jurusan_pegawai->ViewCustomAttributes = "";

		// spesialis_pegawai
		$this->spesialis_pegawai->ViewValue = $this->spesialis_pegawai->CurrentValue;
		$this->spesialis_pegawai->ViewCustomAttributes = "";

		// jabatan_pegawai
		$curVal = strval($this->jabatan_pegawai->CurrentValue);
		if ($curVal != "") {
			$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->lookupCacheOption($curVal);
			if ($this->jabatan_pegawai->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jabatan_pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jabatan_pegawai->ViewValue = $this->jabatan_pegawai->CurrentValue;
				}
			}
		} else {
			$this->jabatan_pegawai->ViewValue = NULL;
		}
		$this->jabatan_pegawai->ViewCustomAttributes = "";

		// status_pegawai
		if (strval($this->status_pegawai->CurrentValue) != "") {
			$this->status_pegawai->ViewValue = $this->status_pegawai->optionCaption($this->status_pegawai->CurrentValue);
		} else {
			$this->status_pegawai->ViewValue = NULL;
		}
		$this->status_pegawai->ViewCustomAttributes = "";

		// tarif_pegawai
		$this->tarif_pegawai->ViewValue = $this->tarif_pegawai->CurrentValue;
		$this->tarif_pegawai->ViewValue = FormatNumber($this->tarif_pegawai->ViewValue, 0, -2, -2, -2);
		$this->tarif_pegawai->ViewCustomAttributes = "";

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

		// target
		$this->target->ViewValue = $this->target->CurrentValue;
		$this->target->ViewValue = FormatNumber($this->target->ViewValue, 0, -2, -2, -2);
		$this->target->ViewCustomAttributes = "";

		// nilai_komisi
		$this->nilai_komisi->ViewValue = $this->nilai_komisi->CurrentValue;
		$this->nilai_komisi->ViewValue = FormatNumber($this->nilai_komisi->ViewValue, 0, -2, -2, -2);
		$this->nilai_komisi->ViewCustomAttributes = "";

		// id_pegawai
		$this->id_pegawai->LinkCustomAttributes = "";
		$this->id_pegawai->HrefValue = "";
		$this->id_pegawai->TooltipValue = "";

		// nama_pegawai
		$this->nama_pegawai->LinkCustomAttributes = "";
		$this->nama_pegawai->HrefValue = "";
		$this->nama_pegawai->TooltipValue = "";

		// nama_lengkap
		$this->nama_lengkap->LinkCustomAttributes = "";
		$this->nama_lengkap->HrefValue = "";
		$this->nama_lengkap->TooltipValue = "";

		// jenis_pegawai
		$this->jenis_pegawai->LinkCustomAttributes = "";
		$this->jenis_pegawai->HrefValue = "";
		$this->jenis_pegawai->TooltipValue = "";

		// nik_pegawai
		$this->nik_pegawai->LinkCustomAttributes = "";
		$this->nik_pegawai->HrefValue = "";
		$this->nik_pegawai->TooltipValue = "";

		// agama_pegawai
		$this->agama_pegawai->LinkCustomAttributes = "";
		$this->agama_pegawai->HrefValue = "";
		$this->agama_pegawai->TooltipValue = "";

		// tgllahir_pegawai
		$this->tgllahir_pegawai->LinkCustomAttributes = "";
		$this->tgllahir_pegawai->HrefValue = "";
		$this->tgllahir_pegawai->TooltipValue = "";

		// alamat_pegawai
		$this->alamat_pegawai->LinkCustomAttributes = "";
		$this->alamat_pegawai->HrefValue = "";
		$this->alamat_pegawai->TooltipValue = "";

		// hp_pegawai
		$this->hp_pegawai->LinkCustomAttributes = "";
		$this->hp_pegawai->HrefValue = "";
		$this->hp_pegawai->TooltipValue = "";

		// pendidikan_pegawai
		$this->pendidikan_pegawai->LinkCustomAttributes = "";
		$this->pendidikan_pegawai->HrefValue = "";
		$this->pendidikan_pegawai->TooltipValue = "";

		// jurusan_pegawai
		$this->jurusan_pegawai->LinkCustomAttributes = "";
		$this->jurusan_pegawai->HrefValue = "";
		$this->jurusan_pegawai->TooltipValue = "";

		// spesialis_pegawai
		$this->spesialis_pegawai->LinkCustomAttributes = "";
		$this->spesialis_pegawai->HrefValue = "";
		$this->spesialis_pegawai->TooltipValue = "";

		// jabatan_pegawai
		$this->jabatan_pegawai->LinkCustomAttributes = "";
		$this->jabatan_pegawai->HrefValue = "";
		$this->jabatan_pegawai->TooltipValue = "";

		// status_pegawai
		$this->status_pegawai->LinkCustomAttributes = "";
		$this->status_pegawai->HrefValue = "";
		$this->status_pegawai->TooltipValue = "";

		// tarif_pegawai
		$this->tarif_pegawai->LinkCustomAttributes = "";
		$this->tarif_pegawai->HrefValue = "";
		$this->tarif_pegawai->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// target
		$this->target->LinkCustomAttributes = "";
		$this->target->HrefValue = "";
		$this->target->TooltipValue = "";

		// nilai_komisi
		$this->nilai_komisi->LinkCustomAttributes = "";
		$this->nilai_komisi->HrefValue = "";
		$this->nilai_komisi->TooltipValue = "";

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

		// id_pegawai
		$this->id_pegawai->EditAttrs["class"] = "form-control";
		$this->id_pegawai->EditCustomAttributes = "";
		$this->id_pegawai->EditValue = $this->id_pegawai->CurrentValue;
		$this->id_pegawai->ViewCustomAttributes = "";

		// nama_pegawai
		$this->nama_pegawai->EditAttrs["class"] = "form-control";
		$this->nama_pegawai->EditCustomAttributes = "";
		if (!$this->nama_pegawai->Raw)
			$this->nama_pegawai->CurrentValue = HtmlDecode($this->nama_pegawai->CurrentValue);
		$this->nama_pegawai->EditValue = $this->nama_pegawai->CurrentValue;
		$this->nama_pegawai->PlaceHolder = RemoveHtml($this->nama_pegawai->caption());

		// nama_lengkap
		$this->nama_lengkap->EditAttrs["class"] = "form-control";
		$this->nama_lengkap->EditCustomAttributes = "";
		if (!$this->nama_lengkap->Raw)
			$this->nama_lengkap->CurrentValue = HtmlDecode($this->nama_lengkap->CurrentValue);
		$this->nama_lengkap->EditValue = $this->nama_lengkap->CurrentValue;
		$this->nama_lengkap->PlaceHolder = RemoveHtml($this->nama_lengkap->caption());

		// jenis_pegawai
		$this->jenis_pegawai->EditCustomAttributes = "";
		$this->jenis_pegawai->EditValue = $this->jenis_pegawai->options(FALSE);

		// nik_pegawai
		$this->nik_pegawai->EditAttrs["class"] = "form-control";
		$this->nik_pegawai->EditCustomAttributes = "";
		if (!$this->nik_pegawai->Raw)
			$this->nik_pegawai->CurrentValue = HtmlDecode($this->nik_pegawai->CurrentValue);
		$this->nik_pegawai->EditValue = $this->nik_pegawai->CurrentValue;
		$this->nik_pegawai->PlaceHolder = RemoveHtml($this->nik_pegawai->caption());

		// agama_pegawai
		$this->agama_pegawai->EditAttrs["class"] = "form-control";
		$this->agama_pegawai->EditCustomAttributes = "";

		// tgllahir_pegawai
		$this->tgllahir_pegawai->EditAttrs["class"] = "form-control";
		$this->tgllahir_pegawai->EditCustomAttributes = "";
		$this->tgllahir_pegawai->EditValue = FormatDateTime($this->tgllahir_pegawai->CurrentValue, 8);
		$this->tgllahir_pegawai->PlaceHolder = RemoveHtml($this->tgllahir_pegawai->caption());

		// alamat_pegawai
		$this->alamat_pegawai->EditAttrs["class"] = "form-control";
		$this->alamat_pegawai->EditCustomAttributes = "";
		if (!$this->alamat_pegawai->Raw)
			$this->alamat_pegawai->CurrentValue = HtmlDecode($this->alamat_pegawai->CurrentValue);
		$this->alamat_pegawai->EditValue = $this->alamat_pegawai->CurrentValue;
		$this->alamat_pegawai->PlaceHolder = RemoveHtml($this->alamat_pegawai->caption());

		// hp_pegawai
		$this->hp_pegawai->EditAttrs["class"] = "form-control";
		$this->hp_pegawai->EditCustomAttributes = "";
		if (!$this->hp_pegawai->Raw)
			$this->hp_pegawai->CurrentValue = HtmlDecode($this->hp_pegawai->CurrentValue);
		$this->hp_pegawai->EditValue = $this->hp_pegawai->CurrentValue;
		$this->hp_pegawai->PlaceHolder = RemoveHtml($this->hp_pegawai->caption());

		// pendidikan_pegawai
		$this->pendidikan_pegawai->EditAttrs["class"] = "form-control";
		$this->pendidikan_pegawai->EditCustomAttributes = "";
		if (!$this->pendidikan_pegawai->Raw)
			$this->pendidikan_pegawai->CurrentValue = HtmlDecode($this->pendidikan_pegawai->CurrentValue);
		$this->pendidikan_pegawai->EditValue = $this->pendidikan_pegawai->CurrentValue;
		$this->pendidikan_pegawai->PlaceHolder = RemoveHtml($this->pendidikan_pegawai->caption());

		// jurusan_pegawai
		$this->jurusan_pegawai->EditAttrs["class"] = "form-control";
		$this->jurusan_pegawai->EditCustomAttributes = "";
		if (!$this->jurusan_pegawai->Raw)
			$this->jurusan_pegawai->CurrentValue = HtmlDecode($this->jurusan_pegawai->CurrentValue);
		$this->jurusan_pegawai->EditValue = $this->jurusan_pegawai->CurrentValue;
		$this->jurusan_pegawai->PlaceHolder = RemoveHtml($this->jurusan_pegawai->caption());

		// spesialis_pegawai
		$this->spesialis_pegawai->EditAttrs["class"] = "form-control";
		$this->spesialis_pegawai->EditCustomAttributes = "";
		if (!$this->spesialis_pegawai->Raw)
			$this->spesialis_pegawai->CurrentValue = HtmlDecode($this->spesialis_pegawai->CurrentValue);
		$this->spesialis_pegawai->EditValue = $this->spesialis_pegawai->CurrentValue;
		$this->spesialis_pegawai->PlaceHolder = RemoveHtml($this->spesialis_pegawai->caption());

		// jabatan_pegawai
		$this->jabatan_pegawai->EditAttrs["class"] = "form-control";
		$this->jabatan_pegawai->EditCustomAttributes = "";

		// status_pegawai
		$this->status_pegawai->EditCustomAttributes = "";
		$this->status_pegawai->EditValue = $this->status_pegawai->options(FALSE);

		// tarif_pegawai
		$this->tarif_pegawai->EditAttrs["class"] = "form-control";
		$this->tarif_pegawai->EditCustomAttributes = "";
		$this->tarif_pegawai->EditValue = $this->tarif_pegawai->CurrentValue;
		$this->tarif_pegawai->PlaceHolder = RemoveHtml($this->tarif_pegawai->caption());

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";

		// target
		$this->target->EditAttrs["class"] = "form-control";
		$this->target->EditCustomAttributes = "";
		$this->target->EditValue = $this->target->CurrentValue;
		$this->target->PlaceHolder = RemoveHtml($this->target->caption());

		// nilai_komisi
		$this->nilai_komisi->EditAttrs["class"] = "form-control";
		$this->nilai_komisi->EditCustomAttributes = "";
		$this->nilai_komisi->EditValue = $this->nilai_komisi->CurrentValue;
		$this->nilai_komisi->PlaceHolder = RemoveHtml($this->nilai_komisi->caption());

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
					$doc->exportCaption($this->nama_pegawai);
					$doc->exportCaption($this->nama_lengkap);
					$doc->exportCaption($this->jenis_pegawai);
					$doc->exportCaption($this->nik_pegawai);
					$doc->exportCaption($this->agama_pegawai);
					$doc->exportCaption($this->tgllahir_pegawai);
					$doc->exportCaption($this->alamat_pegawai);
					$doc->exportCaption($this->hp_pegawai);
					$doc->exportCaption($this->pendidikan_pegawai);
					$doc->exportCaption($this->jurusan_pegawai);
					$doc->exportCaption($this->spesialis_pegawai);
					$doc->exportCaption($this->jabatan_pegawai);
					$doc->exportCaption($this->status_pegawai);
					$doc->exportCaption($this->tarif_pegawai);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->nilai_komisi);
				} else {
					$doc->exportCaption($this->id_pegawai);
					$doc->exportCaption($this->nama_pegawai);
					$doc->exportCaption($this->nama_lengkap);
					$doc->exportCaption($this->jenis_pegawai);
					$doc->exportCaption($this->nik_pegawai);
					$doc->exportCaption($this->agama_pegawai);
					$doc->exportCaption($this->tgllahir_pegawai);
					$doc->exportCaption($this->alamat_pegawai);
					$doc->exportCaption($this->hp_pegawai);
					$doc->exportCaption($this->pendidikan_pegawai);
					$doc->exportCaption($this->jurusan_pegawai);
					$doc->exportCaption($this->spesialis_pegawai);
					$doc->exportCaption($this->jabatan_pegawai);
					$doc->exportCaption($this->status_pegawai);
					$doc->exportCaption($this->tarif_pegawai);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->target);
					$doc->exportCaption($this->nilai_komisi);
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
						$doc->exportField($this->nama_pegawai);
						$doc->exportField($this->nama_lengkap);
						$doc->exportField($this->jenis_pegawai);
						$doc->exportField($this->nik_pegawai);
						$doc->exportField($this->agama_pegawai);
						$doc->exportField($this->tgllahir_pegawai);
						$doc->exportField($this->alamat_pegawai);
						$doc->exportField($this->hp_pegawai);
						$doc->exportField($this->pendidikan_pegawai);
						$doc->exportField($this->jurusan_pegawai);
						$doc->exportField($this->spesialis_pegawai);
						$doc->exportField($this->jabatan_pegawai);
						$doc->exportField($this->status_pegawai);
						$doc->exportField($this->tarif_pegawai);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->nilai_komisi);
					} else {
						$doc->exportField($this->id_pegawai);
						$doc->exportField($this->nama_pegawai);
						$doc->exportField($this->nama_lengkap);
						$doc->exportField($this->jenis_pegawai);
						$doc->exportField($this->nik_pegawai);
						$doc->exportField($this->agama_pegawai);
						$doc->exportField($this->tgllahir_pegawai);
						$doc->exportField($this->alamat_pegawai);
						$doc->exportField($this->hp_pegawai);
						$doc->exportField($this->pendidikan_pegawai);
						$doc->exportField($this->jurusan_pegawai);
						$doc->exportField($this->spesialis_pegawai);
						$doc->exportField($this->jabatan_pegawai);
						$doc->exportField($this->status_pegawai);
						$doc->exportField($this->tarif_pegawai);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->target);
						$doc->exportField($this->nilai_komisi);
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