<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for penjualan_copy
 */
class penjualan_copy extends DbTable
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
	public $waktu;
	public $id_pelanggan;
	public $id_member;
	public $diskon_persen;
	public $diskon_rupiah;
	public $ppn;
	public $total;
	public $bayar;
	public $bayar_non_tunai;
	public $total_non_tunai_charge;
	public $kode_penjualan;
	public $keterangan;
	public $dokter;
	public $sales;
	public $dok_be_wajah;
	public $be_body;
	public $medis;
	public $id_klinik;
	public $id_rmd;
	public $metode_pembayaran;
	public $id_bank;
	public $id_kartu;
	public $jumlah_voucher;
	public $id_kartubank;
	public $id_kas;
	public $charge;
	public $ongkir;
	public $klaim_poin;
	public $total_penukaran_poin;
	public $_action;
	public $status;
	public $status_void;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'penjualan_copy';
		$this->TableName = 'penjualan_copy';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`penjualan_copy`";
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
		$this->id = new DbField('penjualan_copy', 'penjualan_copy', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// waktu
		$this->waktu = new DbField('penjualan_copy', 'penjualan_copy', 'x_waktu', 'waktu', '`waktu`', CastDateFieldForLike("`waktu`", 0, "DB"), 133, 10, 0, FALSE, '`waktu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->waktu->Nullable = FALSE; // NOT NULL field
		$this->waktu->Required = TRUE; // Required field
		$this->waktu->Sortable = TRUE; // Allow sort
		$this->waktu->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['waktu'] = &$this->waktu;

		// id_pelanggan
		$this->id_pelanggan = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 11, -1, FALSE, '`id_pelanggan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->id_pelanggan->Required = TRUE; // Required field
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// id_member
		$this->id_member = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_member', 'id_member', '`id_member`', '`id_member`', 3, 11, -1, FALSE, '`id_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_member->Sortable = TRUE; // Allow sort
		$this->id_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_member'] = &$this->id_member;

		// diskon_persen
		$this->diskon_persen = new DbField('penjualan_copy', 'penjualan_copy', 'x_diskon_persen', 'diskon_persen', '`diskon_persen`', '`diskon_persen`', 200, 50, -1, FALSE, '`diskon_persen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->diskon_persen->Nullable = FALSE; // NOT NULL field
		$this->diskon_persen->Required = TRUE; // Required field
		$this->diskon_persen->Sortable = TRUE; // Allow sort
		$this->fields['diskon_persen'] = &$this->diskon_persen;

		// diskon_rupiah
		$this->diskon_rupiah = new DbField('penjualan_copy', 'penjualan_copy', 'x_diskon_rupiah', 'diskon_rupiah', '`diskon_rupiah`', '`diskon_rupiah`', 5, 22, -1, FALSE, '`diskon_rupiah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->diskon_rupiah->Nullable = FALSE; // NOT NULL field
		$this->diskon_rupiah->Required = TRUE; // Required field
		$this->diskon_rupiah->Sortable = TRUE; // Allow sort
		$this->diskon_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['diskon_rupiah'] = &$this->diskon_rupiah;

		// ppn
		$this->ppn = new DbField('penjualan_copy', 'penjualan_copy', 'x_ppn', 'ppn', '`ppn`', '`ppn`', 5, 22, -1, FALSE, '`ppn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ppn->Nullable = FALSE; // NOT NULL field
		$this->ppn->Required = TRUE; // Required field
		$this->ppn->Sortable = TRUE; // Allow sort
		$this->ppn->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ppn'] = &$this->ppn;

		// total
		$this->total = new DbField('penjualan_copy', 'penjualan_copy', 'x_total', 'total', '`total`', '`total`', 5, 22, -1, FALSE, '`total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total->Nullable = FALSE; // NOT NULL field
		$this->total->Required = TRUE; // Required field
		$this->total->Sortable = TRUE; // Allow sort
		$this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total'] = &$this->total;

		// bayar
		$this->bayar = new DbField('penjualan_copy', 'penjualan_copy', 'x_bayar', 'bayar', '`bayar`', '`bayar`', 5, 22, -1, FALSE, '`bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bayar->Nullable = FALSE; // NOT NULL field
		$this->bayar->Required = TRUE; // Required field
		$this->bayar->Sortable = TRUE; // Allow sort
		$this->bayar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['bayar'] = &$this->bayar;

		// bayar_non_tunai
		$this->bayar_non_tunai = new DbField('penjualan_copy', 'penjualan_copy', 'x_bayar_non_tunai', 'bayar_non_tunai', '`bayar_non_tunai`', '`bayar_non_tunai`', 5, 22, -1, FALSE, '`bayar_non_tunai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bayar_non_tunai->Nullable = FALSE; // NOT NULL field
		$this->bayar_non_tunai->Required = TRUE; // Required field
		$this->bayar_non_tunai->Sortable = TRUE; // Allow sort
		$this->bayar_non_tunai->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['bayar_non_tunai'] = &$this->bayar_non_tunai;

		// total_non_tunai_charge
		$this->total_non_tunai_charge = new DbField('penjualan_copy', 'penjualan_copy', 'x_total_non_tunai_charge', 'total_non_tunai_charge', '`total_non_tunai_charge`', '`total_non_tunai_charge`', 5, 22, -1, FALSE, '`total_non_tunai_charge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_non_tunai_charge->Nullable = FALSE; // NOT NULL field
		$this->total_non_tunai_charge->Required = TRUE; // Required field
		$this->total_non_tunai_charge->Sortable = TRUE; // Allow sort
		$this->total_non_tunai_charge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_non_tunai_charge'] = &$this->total_non_tunai_charge;

		// kode_penjualan
		$this->kode_penjualan = new DbField('penjualan_copy', 'penjualan_copy', 'x_kode_penjualan', 'kode_penjualan', '`kode_penjualan`', '`kode_penjualan`', 200, 100, -1, FALSE, '`kode_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_penjualan->Nullable = FALSE; // NOT NULL field
		$this->kode_penjualan->Required = TRUE; // Required field
		$this->kode_penjualan->Sortable = TRUE; // Allow sort
		$this->fields['kode_penjualan'] = &$this->kode_penjualan;

		// keterangan
		$this->keterangan = new DbField('penjualan_copy', 'penjualan_copy', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// dokter
		$this->dokter = new DbField('penjualan_copy', 'penjualan_copy', 'x_dokter', 'dokter', '`dokter`', '`dokter`', 3, 11, -1, FALSE, '`dokter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dokter->Sortable = TRUE; // Allow sort
		$this->dokter->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['dokter'] = &$this->dokter;

		// sales
		$this->sales = new DbField('penjualan_copy', 'penjualan_copy', 'x_sales', 'sales', '`sales`', '`sales`', 3, 11, -1, FALSE, '`sales`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sales->Sortable = TRUE; // Allow sort
		$this->sales->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sales'] = &$this->sales;

		// dok_be_wajah
		$this->dok_be_wajah = new DbField('penjualan_copy', 'penjualan_copy', 'x_dok_be_wajah', 'dok_be_wajah', '`dok_be_wajah`', '`dok_be_wajah`', 3, 11, -1, FALSE, '`dok_be_wajah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dok_be_wajah->Sortable = TRUE; // Allow sort
		$this->dok_be_wajah->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['dok_be_wajah'] = &$this->dok_be_wajah;

		// be_body
		$this->be_body = new DbField('penjualan_copy', 'penjualan_copy', 'x_be_body', 'be_body', '`be_body`', '`be_body`', 3, 11, -1, FALSE, '`be_body`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->be_body->Sortable = TRUE; // Allow sort
		$this->be_body->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['be_body'] = &$this->be_body;

		// medis
		$this->medis = new DbField('penjualan_copy', 'penjualan_copy', 'x_medis', 'medis', '`medis`', '`medis`', 3, 11, -1, FALSE, '`medis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->medis->Sortable = TRUE; // Allow sort
		$this->medis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['medis'] = &$this->medis;

		// id_klinik
		$this->id_klinik = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// id_rmd
		$this->id_rmd = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_rmd', 'id_rmd', '`id_rmd`', '`id_rmd`', 3, 11, -1, FALSE, '`id_rmd`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_rmd->Sortable = TRUE; // Allow sort
		$this->id_rmd->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_rmd'] = &$this->id_rmd;

		// metode_pembayaran
		$this->metode_pembayaran = new DbField('penjualan_copy', 'penjualan_copy', 'x_metode_pembayaran', 'metode_pembayaran', '`metode_pembayaran`', '`metode_pembayaran`', 200, 50, -1, FALSE, '`metode_pembayaran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->metode_pembayaran->Nullable = FALSE; // NOT NULL field
		$this->metode_pembayaran->Required = TRUE; // Required field
		$this->metode_pembayaran->Sortable = TRUE; // Allow sort
		$this->fields['metode_pembayaran'] = &$this->metode_pembayaran;

		// id_bank
		$this->id_bank = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_bank', 'id_bank', '`id_bank`', '`id_bank`', 3, 11, -1, FALSE, '`id_bank`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_bank->Nullable = FALSE; // NOT NULL field
		$this->id_bank->Required = TRUE; // Required field
		$this->id_bank->Sortable = TRUE; // Allow sort
		$this->id_bank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_bank'] = &$this->id_bank;

		// id_kartu
		$this->id_kartu = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_kartu', 'id_kartu', '`id_kartu`', '`id_kartu`', 3, 11, -1, FALSE, '`id_kartu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_kartu->Sortable = TRUE; // Allow sort
		$this->id_kartu->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartu'] = &$this->id_kartu;

		// jumlah_voucher
		$this->jumlah_voucher = new DbField('penjualan_copy', 'penjualan_copy', 'x_jumlah_voucher', 'jumlah_voucher', '`jumlah_voucher`', '`jumlah_voucher`', 3, 11, -1, FALSE, '`jumlah_voucher`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah_voucher->Sortable = TRUE; // Allow sort
		$this->jumlah_voucher->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumlah_voucher'] = &$this->jumlah_voucher;

		// id_kartubank
		$this->id_kartubank = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_kartubank', 'id_kartubank', '`id_kartubank`', '`id_kartubank`', 3, 11, -1, FALSE, '`id_kartubank`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_kartubank->Nullable = FALSE; // NOT NULL field
		$this->id_kartubank->Required = TRUE; // Required field
		$this->id_kartubank->Sortable = TRUE; // Allow sort
		$this->id_kartubank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartubank'] = &$this->id_kartubank;

		// id_kas
		$this->id_kas = new DbField('penjualan_copy', 'penjualan_copy', 'x_id_kas', 'id_kas', '`id_kas`', '`id_kas`', 3, 11, -1, FALSE, '`id_kas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_kas->Nullable = FALSE; // NOT NULL field
		$this->id_kas->Required = TRUE; // Required field
		$this->id_kas->Sortable = TRUE; // Allow sort
		$this->id_kas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kas'] = &$this->id_kas;

		// charge
		$this->charge = new DbField('penjualan_copy', 'penjualan_copy', 'x_charge', 'charge', '`charge`', '`charge`', 5, 22, -1, FALSE, '`charge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->charge->Sortable = TRUE; // Allow sort
		$this->charge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['charge'] = &$this->charge;

		// ongkir
		$this->ongkir = new DbField('penjualan_copy', 'penjualan_copy', 'x_ongkir', 'ongkir', '`ongkir`', '`ongkir`', 5, 22, -1, FALSE, '`ongkir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ongkir->Sortable = TRUE; // Allow sort
		$this->ongkir->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ongkir'] = &$this->ongkir;

		// klaim_poin
		$this->klaim_poin = new DbField('penjualan_copy', 'penjualan_copy', 'x_klaim_poin', 'klaim_poin', '`klaim_poin`', '`klaim_poin`', 5, 22, -1, FALSE, '`klaim_poin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->klaim_poin->Sortable = TRUE; // Allow sort
		$this->klaim_poin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['klaim_poin'] = &$this->klaim_poin;

		// total_penukaran_poin
		$this->total_penukaran_poin = new DbField('penjualan_copy', 'penjualan_copy', 'x_total_penukaran_poin', 'total_penukaran_poin', '`total_penukaran_poin`', '`total_penukaran_poin`', 5, 22, -1, FALSE, '`total_penukaran_poin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_penukaran_poin->Sortable = TRUE; // Allow sort
		$this->total_penukaran_poin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_penukaran_poin'] = &$this->total_penukaran_poin;

		// action
		$this->_action = new DbField('penjualan_copy', 'penjualan_copy', 'x__action', 'action', '`action`', '`action`', 200, 255, -1, FALSE, '`action`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_action->Sortable = TRUE; // Allow sort
		$this->fields['action'] = &$this->_action;

		// status
		$this->status = new DbField('penjualan_copy', 'penjualan_copy', 'x_status', 'status', '`status`', '`status`', 202, 7, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->Lookup = new Lookup('status', 'penjualan_copy', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status->OptionCount = 2;
		$this->fields['status'] = &$this->status;

		// status_void
		$this->status_void = new DbField('penjualan_copy', 'penjualan_copy', 'x_status_void', 'status_void', '`status_void`', '`status_void`', 200, 50, -1, FALSE, '`status_void`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status_void->Sortable = TRUE; // Allow sort
		$this->fields['status_void'] = &$this->status_void;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`penjualan_copy`";
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
		$this->waktu->DbValue = $row['waktu'];
		$this->id_pelanggan->DbValue = $row['id_pelanggan'];
		$this->id_member->DbValue = $row['id_member'];
		$this->diskon_persen->DbValue = $row['diskon_persen'];
		$this->diskon_rupiah->DbValue = $row['diskon_rupiah'];
		$this->ppn->DbValue = $row['ppn'];
		$this->total->DbValue = $row['total'];
		$this->bayar->DbValue = $row['bayar'];
		$this->bayar_non_tunai->DbValue = $row['bayar_non_tunai'];
		$this->total_non_tunai_charge->DbValue = $row['total_non_tunai_charge'];
		$this->kode_penjualan->DbValue = $row['kode_penjualan'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->dokter->DbValue = $row['dokter'];
		$this->sales->DbValue = $row['sales'];
		$this->dok_be_wajah->DbValue = $row['dok_be_wajah'];
		$this->be_body->DbValue = $row['be_body'];
		$this->medis->DbValue = $row['medis'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->id_rmd->DbValue = $row['id_rmd'];
		$this->metode_pembayaran->DbValue = $row['metode_pembayaran'];
		$this->id_bank->DbValue = $row['id_bank'];
		$this->id_kartu->DbValue = $row['id_kartu'];
		$this->jumlah_voucher->DbValue = $row['jumlah_voucher'];
		$this->id_kartubank->DbValue = $row['id_kartubank'];
		$this->id_kas->DbValue = $row['id_kas'];
		$this->charge->DbValue = $row['charge'];
		$this->ongkir->DbValue = $row['ongkir'];
		$this->klaim_poin->DbValue = $row['klaim_poin'];
		$this->total_penukaran_poin->DbValue = $row['total_penukaran_poin'];
		$this->_action->DbValue = $row['action'];
		$this->status->DbValue = $row['status'];
		$this->status_void->DbValue = $row['status_void'];
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
			return "penjualan_copylist.php";
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
		if ($pageName == "penjualan_copyview.php")
			return $Language->phrase("View");
		elseif ($pageName == "penjualan_copyedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "penjualan_copyadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "penjualan_copylist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("penjualan_copyview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("penjualan_copyview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "penjualan_copyadd.php?" . $this->getUrlParm($parm);
		else
			$url = "penjualan_copyadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("penjualan_copyedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("penjualan_copyadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("penjualan_copydelete.php", $this->getUrlParm());
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
		$this->waktu->setDbValue($rs->fields('waktu'));
		$this->id_pelanggan->setDbValue($rs->fields('id_pelanggan'));
		$this->id_member->setDbValue($rs->fields('id_member'));
		$this->diskon_persen->setDbValue($rs->fields('diskon_persen'));
		$this->diskon_rupiah->setDbValue($rs->fields('diskon_rupiah'));
		$this->ppn->setDbValue($rs->fields('ppn'));
		$this->total->setDbValue($rs->fields('total'));
		$this->bayar->setDbValue($rs->fields('bayar'));
		$this->bayar_non_tunai->setDbValue($rs->fields('bayar_non_tunai'));
		$this->total_non_tunai_charge->setDbValue($rs->fields('total_non_tunai_charge'));
		$this->kode_penjualan->setDbValue($rs->fields('kode_penjualan'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->dokter->setDbValue($rs->fields('dokter'));
		$this->sales->setDbValue($rs->fields('sales'));
		$this->dok_be_wajah->setDbValue($rs->fields('dok_be_wajah'));
		$this->be_body->setDbValue($rs->fields('be_body'));
		$this->medis->setDbValue($rs->fields('medis'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->id_rmd->setDbValue($rs->fields('id_rmd'));
		$this->metode_pembayaran->setDbValue($rs->fields('metode_pembayaran'));
		$this->id_bank->setDbValue($rs->fields('id_bank'));
		$this->id_kartu->setDbValue($rs->fields('id_kartu'));
		$this->jumlah_voucher->setDbValue($rs->fields('jumlah_voucher'));
		$this->id_kartubank->setDbValue($rs->fields('id_kartubank'));
		$this->id_kas->setDbValue($rs->fields('id_kas'));
		$this->charge->setDbValue($rs->fields('charge'));
		$this->ongkir->setDbValue($rs->fields('ongkir'));
		$this->klaim_poin->setDbValue($rs->fields('klaim_poin'));
		$this->total_penukaran_poin->setDbValue($rs->fields('total_penukaran_poin'));
		$this->_action->setDbValue($rs->fields('action'));
		$this->status->setDbValue($rs->fields('status'));
		$this->status_void->setDbValue($rs->fields('status_void'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// waktu
		// id_pelanggan
		// id_member
		// diskon_persen
		// diskon_rupiah
		// ppn
		// total
		// bayar
		// bayar_non_tunai
		// total_non_tunai_charge
		// kode_penjualan
		// keterangan
		// dokter
		// sales
		// dok_be_wajah
		// be_body
		// medis
		// id_klinik
		// id_rmd
		// metode_pembayaran
		// id_bank
		// id_kartu
		// jumlah_voucher
		// id_kartubank
		// id_kas
		// charge
		// ongkir
		// klaim_poin
		// total_penukaran_poin
		// action
		// status
		// status_void
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// waktu
		$this->waktu->ViewValue = $this->waktu->CurrentValue;
		$this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 0);
		$this->waktu->ViewCustomAttributes = "";

		// id_pelanggan
		$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->ViewValue = FormatNumber($this->id_pelanggan->ViewValue, 0, -2, -2, -2);
		$this->id_pelanggan->ViewCustomAttributes = "";

		// id_member
		$this->id_member->ViewValue = $this->id_member->CurrentValue;
		$this->id_member->ViewValue = FormatNumber($this->id_member->ViewValue, 0, -2, -2, -2);
		$this->id_member->ViewCustomAttributes = "";

		// diskon_persen
		$this->diskon_persen->ViewValue = $this->diskon_persen->CurrentValue;
		$this->diskon_persen->ViewCustomAttributes = "";

		// diskon_rupiah
		$this->diskon_rupiah->ViewValue = $this->diskon_rupiah->CurrentValue;
		$this->diskon_rupiah->ViewValue = FormatNumber($this->diskon_rupiah->ViewValue, 2, -2, -2, -2);
		$this->diskon_rupiah->ViewCustomAttributes = "";

		// ppn
		$this->ppn->ViewValue = $this->ppn->CurrentValue;
		$this->ppn->ViewValue = FormatNumber($this->ppn->ViewValue, 2, -2, -2, -2);
		$this->ppn->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewValue = FormatNumber($this->total->ViewValue, 2, -2, -2, -2);
		$this->total->ViewCustomAttributes = "";

		// bayar
		$this->bayar->ViewValue = $this->bayar->CurrentValue;
		$this->bayar->ViewValue = FormatNumber($this->bayar->ViewValue, 2, -2, -2, -2);
		$this->bayar->ViewCustomAttributes = "";

		// bayar_non_tunai
		$this->bayar_non_tunai->ViewValue = $this->bayar_non_tunai->CurrentValue;
		$this->bayar_non_tunai->ViewValue = FormatNumber($this->bayar_non_tunai->ViewValue, 2, -2, -2, -2);
		$this->bayar_non_tunai->ViewCustomAttributes = "";

		// total_non_tunai_charge
		$this->total_non_tunai_charge->ViewValue = $this->total_non_tunai_charge->CurrentValue;
		$this->total_non_tunai_charge->ViewValue = FormatNumber($this->total_non_tunai_charge->ViewValue, 2, -2, -2, -2);
		$this->total_non_tunai_charge->ViewCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// dokter
		$this->dokter->ViewValue = $this->dokter->CurrentValue;
		$this->dokter->ViewValue = FormatNumber($this->dokter->ViewValue, 0, -2, -2, -2);
		$this->dokter->ViewCustomAttributes = "";

		// sales
		$this->sales->ViewValue = $this->sales->CurrentValue;
		$this->sales->ViewValue = FormatNumber($this->sales->ViewValue, 0, -2, -2, -2);
		$this->sales->ViewCustomAttributes = "";

		// dok_be_wajah
		$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->CurrentValue;
		$this->dok_be_wajah->ViewValue = FormatNumber($this->dok_be_wajah->ViewValue, 0, -2, -2, -2);
		$this->dok_be_wajah->ViewCustomAttributes = "";

		// be_body
		$this->be_body->ViewValue = $this->be_body->CurrentValue;
		$this->be_body->ViewValue = FormatNumber($this->be_body->ViewValue, 0, -2, -2, -2);
		$this->be_body->ViewCustomAttributes = "";

		// medis
		$this->medis->ViewValue = $this->medis->CurrentValue;
		$this->medis->ViewValue = FormatNumber($this->medis->ViewValue, 0, -2, -2, -2);
		$this->medis->ViewCustomAttributes = "";

		// id_klinik
		$this->id_klinik->ViewValue = $this->id_klinik->CurrentValue;
		$this->id_klinik->ViewValue = FormatNumber($this->id_klinik->ViewValue, 0, -2, -2, -2);
		$this->id_klinik->ViewCustomAttributes = "";

		// id_rmd
		$this->id_rmd->ViewValue = $this->id_rmd->CurrentValue;
		$this->id_rmd->ViewValue = FormatNumber($this->id_rmd->ViewValue, 0, -2, -2, -2);
		$this->id_rmd->ViewCustomAttributes = "";

		// metode_pembayaran
		$this->metode_pembayaran->ViewValue = $this->metode_pembayaran->CurrentValue;
		$this->metode_pembayaran->ViewCustomAttributes = "";

		// id_bank
		$this->id_bank->ViewValue = $this->id_bank->CurrentValue;
		$this->id_bank->ViewValue = FormatNumber($this->id_bank->ViewValue, 0, -2, -2, -2);
		$this->id_bank->ViewCustomAttributes = "";

		// id_kartu
		$this->id_kartu->ViewValue = $this->id_kartu->CurrentValue;
		$this->id_kartu->ViewValue = FormatNumber($this->id_kartu->ViewValue, 0, -2, -2, -2);
		$this->id_kartu->ViewCustomAttributes = "";

		// jumlah_voucher
		$this->jumlah_voucher->ViewValue = $this->jumlah_voucher->CurrentValue;
		$this->jumlah_voucher->ViewValue = FormatNumber($this->jumlah_voucher->ViewValue, 0, -2, -2, -2);
		$this->jumlah_voucher->ViewCustomAttributes = "";

		// id_kartubank
		$this->id_kartubank->ViewValue = $this->id_kartubank->CurrentValue;
		$this->id_kartubank->ViewValue = FormatNumber($this->id_kartubank->ViewValue, 0, -2, -2, -2);
		$this->id_kartubank->ViewCustomAttributes = "";

		// id_kas
		$this->id_kas->ViewValue = $this->id_kas->CurrentValue;
		$this->id_kas->ViewValue = FormatNumber($this->id_kas->ViewValue, 0, -2, -2, -2);
		$this->id_kas->ViewCustomAttributes = "";

		// charge
		$this->charge->ViewValue = $this->charge->CurrentValue;
		$this->charge->ViewValue = FormatNumber($this->charge->ViewValue, 2, -2, -2, -2);
		$this->charge->ViewCustomAttributes = "";

		// ongkir
		$this->ongkir->ViewValue = $this->ongkir->CurrentValue;
		$this->ongkir->ViewValue = FormatNumber($this->ongkir->ViewValue, 2, -2, -2, -2);
		$this->ongkir->ViewCustomAttributes = "";

		// klaim_poin
		$this->klaim_poin->ViewValue = $this->klaim_poin->CurrentValue;
		$this->klaim_poin->ViewValue = FormatNumber($this->klaim_poin->ViewValue, 2, -2, -2, -2);
		$this->klaim_poin->ViewCustomAttributes = "";

		// total_penukaran_poin
		$this->total_penukaran_poin->ViewValue = $this->total_penukaran_poin->CurrentValue;
		$this->total_penukaran_poin->ViewValue = FormatNumber($this->total_penukaran_poin->ViewValue, 2, -2, -2, -2);
		$this->total_penukaran_poin->ViewCustomAttributes = "";

		// action
		$this->_action->ViewValue = $this->_action->CurrentValue;
		$this->_action->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) != "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// status_void
		$this->status_void->ViewValue = $this->status_void->CurrentValue;
		$this->status_void->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// waktu
		$this->waktu->LinkCustomAttributes = "";
		$this->waktu->HrefValue = "";
		$this->waktu->TooltipValue = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// id_member
		$this->id_member->LinkCustomAttributes = "";
		$this->id_member->HrefValue = "";
		$this->id_member->TooltipValue = "";

		// diskon_persen
		$this->diskon_persen->LinkCustomAttributes = "";
		$this->diskon_persen->HrefValue = "";
		$this->diskon_persen->TooltipValue = "";

		// diskon_rupiah
		$this->diskon_rupiah->LinkCustomAttributes = "";
		$this->diskon_rupiah->HrefValue = "";
		$this->diskon_rupiah->TooltipValue = "";

		// ppn
		$this->ppn->LinkCustomAttributes = "";
		$this->ppn->HrefValue = "";
		$this->ppn->TooltipValue = "";

		// total
		$this->total->LinkCustomAttributes = "";
		$this->total->HrefValue = "";
		$this->total->TooltipValue = "";

		// bayar
		$this->bayar->LinkCustomAttributes = "";
		$this->bayar->HrefValue = "";
		$this->bayar->TooltipValue = "";

		// bayar_non_tunai
		$this->bayar_non_tunai->LinkCustomAttributes = "";
		$this->bayar_non_tunai->HrefValue = "";
		$this->bayar_non_tunai->TooltipValue = "";

		// total_non_tunai_charge
		$this->total_non_tunai_charge->LinkCustomAttributes = "";
		$this->total_non_tunai_charge->HrefValue = "";
		$this->total_non_tunai_charge->TooltipValue = "";

		// kode_penjualan
		$this->kode_penjualan->LinkCustomAttributes = "";
		$this->kode_penjualan->HrefValue = "";
		$this->kode_penjualan->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

		// dokter
		$this->dokter->LinkCustomAttributes = "";
		$this->dokter->HrefValue = "";
		$this->dokter->TooltipValue = "";

		// sales
		$this->sales->LinkCustomAttributes = "";
		$this->sales->HrefValue = "";
		$this->sales->TooltipValue = "";

		// dok_be_wajah
		$this->dok_be_wajah->LinkCustomAttributes = "";
		$this->dok_be_wajah->HrefValue = "";
		$this->dok_be_wajah->TooltipValue = "";

		// be_body
		$this->be_body->LinkCustomAttributes = "";
		$this->be_body->HrefValue = "";
		$this->be_body->TooltipValue = "";

		// medis
		$this->medis->LinkCustomAttributes = "";
		$this->medis->HrefValue = "";
		$this->medis->TooltipValue = "";

		// id_klinik
		$this->id_klinik->LinkCustomAttributes = "";
		$this->id_klinik->HrefValue = "";
		$this->id_klinik->TooltipValue = "";

		// id_rmd
		$this->id_rmd->LinkCustomAttributes = "";
		$this->id_rmd->HrefValue = "";
		$this->id_rmd->TooltipValue = "";

		// metode_pembayaran
		$this->metode_pembayaran->LinkCustomAttributes = "";
		$this->metode_pembayaran->HrefValue = "";
		$this->metode_pembayaran->TooltipValue = "";

		// id_bank
		$this->id_bank->LinkCustomAttributes = "";
		$this->id_bank->HrefValue = "";
		$this->id_bank->TooltipValue = "";

		// id_kartu
		$this->id_kartu->LinkCustomAttributes = "";
		$this->id_kartu->HrefValue = "";
		$this->id_kartu->TooltipValue = "";

		// jumlah_voucher
		$this->jumlah_voucher->LinkCustomAttributes = "";
		$this->jumlah_voucher->HrefValue = "";
		$this->jumlah_voucher->TooltipValue = "";

		// id_kartubank
		$this->id_kartubank->LinkCustomAttributes = "";
		$this->id_kartubank->HrefValue = "";
		$this->id_kartubank->TooltipValue = "";

		// id_kas
		$this->id_kas->LinkCustomAttributes = "";
		$this->id_kas->HrefValue = "";
		$this->id_kas->TooltipValue = "";

		// charge
		$this->charge->LinkCustomAttributes = "";
		$this->charge->HrefValue = "";
		$this->charge->TooltipValue = "";

		// ongkir
		$this->ongkir->LinkCustomAttributes = "";
		$this->ongkir->HrefValue = "";
		$this->ongkir->TooltipValue = "";

		// klaim_poin
		$this->klaim_poin->LinkCustomAttributes = "";
		$this->klaim_poin->HrefValue = "";
		$this->klaim_poin->TooltipValue = "";

		// total_penukaran_poin
		$this->total_penukaran_poin->LinkCustomAttributes = "";
		$this->total_penukaran_poin->HrefValue = "";
		$this->total_penukaran_poin->TooltipValue = "";

		// action
		$this->_action->LinkCustomAttributes = "";
		$this->_action->HrefValue = "";
		$this->_action->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// status_void
		$this->status_void->LinkCustomAttributes = "";
		$this->status_void->HrefValue = "";
		$this->status_void->TooltipValue = "";

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

		// waktu
		$this->waktu->EditAttrs["class"] = "form-control";
		$this->waktu->EditCustomAttributes = "";
		$this->waktu->EditValue = FormatDateTime($this->waktu->CurrentValue, 8);
		$this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

		// id_pelanggan
		$this->id_pelanggan->EditAttrs["class"] = "form-control";
		$this->id_pelanggan->EditCustomAttributes = "";
		$this->id_pelanggan->EditValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->PlaceHolder = RemoveHtml($this->id_pelanggan->caption());

		// id_member
		$this->id_member->EditAttrs["class"] = "form-control";
		$this->id_member->EditCustomAttributes = "";
		$this->id_member->EditValue = $this->id_member->CurrentValue;
		$this->id_member->PlaceHolder = RemoveHtml($this->id_member->caption());

		// diskon_persen
		$this->diskon_persen->EditAttrs["class"] = "form-control";
		$this->diskon_persen->EditCustomAttributes = "";
		if (!$this->diskon_persen->Raw)
			$this->diskon_persen->CurrentValue = HtmlDecode($this->diskon_persen->CurrentValue);
		$this->diskon_persen->EditValue = $this->diskon_persen->CurrentValue;
		$this->diskon_persen->PlaceHolder = RemoveHtml($this->diskon_persen->caption());

		// diskon_rupiah
		$this->diskon_rupiah->EditAttrs["class"] = "form-control";
		$this->diskon_rupiah->EditCustomAttributes = "";
		$this->diskon_rupiah->EditValue = $this->diskon_rupiah->CurrentValue;
		$this->diskon_rupiah->PlaceHolder = RemoveHtml($this->diskon_rupiah->caption());
		if (strval($this->diskon_rupiah->EditValue) != "" && is_numeric($this->diskon_rupiah->EditValue))
			$this->diskon_rupiah->EditValue = FormatNumber($this->diskon_rupiah->EditValue, -2, -2, -2, -2);
		

		// ppn
		$this->ppn->EditAttrs["class"] = "form-control";
		$this->ppn->EditCustomAttributes = "";
		$this->ppn->EditValue = $this->ppn->CurrentValue;
		$this->ppn->PlaceHolder = RemoveHtml($this->ppn->caption());
		if (strval($this->ppn->EditValue) != "" && is_numeric($this->ppn->EditValue))
			$this->ppn->EditValue = FormatNumber($this->ppn->EditValue, -2, -2, -2, -2);
		

		// total
		$this->total->EditAttrs["class"] = "form-control";
		$this->total->EditCustomAttributes = "";
		$this->total->EditValue = $this->total->CurrentValue;
		$this->total->PlaceHolder = RemoveHtml($this->total->caption());
		if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue))
			$this->total->EditValue = FormatNumber($this->total->EditValue, -2, -2, -2, -2);
		

		// bayar
		$this->bayar->EditAttrs["class"] = "form-control";
		$this->bayar->EditCustomAttributes = "";
		$this->bayar->EditValue = $this->bayar->CurrentValue;
		$this->bayar->PlaceHolder = RemoveHtml($this->bayar->caption());
		if (strval($this->bayar->EditValue) != "" && is_numeric($this->bayar->EditValue))
			$this->bayar->EditValue = FormatNumber($this->bayar->EditValue, -2, -2, -2, -2);
		

		// bayar_non_tunai
		$this->bayar_non_tunai->EditAttrs["class"] = "form-control";
		$this->bayar_non_tunai->EditCustomAttributes = "";
		$this->bayar_non_tunai->EditValue = $this->bayar_non_tunai->CurrentValue;
		$this->bayar_non_tunai->PlaceHolder = RemoveHtml($this->bayar_non_tunai->caption());
		if (strval($this->bayar_non_tunai->EditValue) != "" && is_numeric($this->bayar_non_tunai->EditValue))
			$this->bayar_non_tunai->EditValue = FormatNumber($this->bayar_non_tunai->EditValue, -2, -2, -2, -2);
		

		// total_non_tunai_charge
		$this->total_non_tunai_charge->EditAttrs["class"] = "form-control";
		$this->total_non_tunai_charge->EditCustomAttributes = "";
		$this->total_non_tunai_charge->EditValue = $this->total_non_tunai_charge->CurrentValue;
		$this->total_non_tunai_charge->PlaceHolder = RemoveHtml($this->total_non_tunai_charge->caption());
		if (strval($this->total_non_tunai_charge->EditValue) != "" && is_numeric($this->total_non_tunai_charge->EditValue))
			$this->total_non_tunai_charge->EditValue = FormatNumber($this->total_non_tunai_charge->EditValue, -2, -2, -2, -2);
		

		// kode_penjualan
		$this->kode_penjualan->EditAttrs["class"] = "form-control";
		$this->kode_penjualan->EditCustomAttributes = "";
		if (!$this->kode_penjualan->Raw)
			$this->kode_penjualan->CurrentValue = HtmlDecode($this->kode_penjualan->CurrentValue);
		$this->kode_penjualan->EditValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		if (!$this->keterangan->Raw)
			$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// dokter
		$this->dokter->EditAttrs["class"] = "form-control";
		$this->dokter->EditCustomAttributes = "";
		$this->dokter->EditValue = $this->dokter->CurrentValue;
		$this->dokter->PlaceHolder = RemoveHtml($this->dokter->caption());

		// sales
		$this->sales->EditAttrs["class"] = "form-control";
		$this->sales->EditCustomAttributes = "";
		$this->sales->EditValue = $this->sales->CurrentValue;
		$this->sales->PlaceHolder = RemoveHtml($this->sales->caption());

		// dok_be_wajah
		$this->dok_be_wajah->EditAttrs["class"] = "form-control";
		$this->dok_be_wajah->EditCustomAttributes = "";
		$this->dok_be_wajah->EditValue = $this->dok_be_wajah->CurrentValue;
		$this->dok_be_wajah->PlaceHolder = RemoveHtml($this->dok_be_wajah->caption());

		// be_body
		$this->be_body->EditAttrs["class"] = "form-control";
		$this->be_body->EditCustomAttributes = "";
		$this->be_body->EditValue = $this->be_body->CurrentValue;
		$this->be_body->PlaceHolder = RemoveHtml($this->be_body->caption());

		// medis
		$this->medis->EditAttrs["class"] = "form-control";
		$this->medis->EditCustomAttributes = "";
		$this->medis->EditValue = $this->medis->CurrentValue;
		$this->medis->PlaceHolder = RemoveHtml($this->medis->caption());

		// id_klinik
		$this->id_klinik->EditAttrs["class"] = "form-control";
		$this->id_klinik->EditCustomAttributes = "";
		$this->id_klinik->EditValue = $this->id_klinik->CurrentValue;
		$this->id_klinik->PlaceHolder = RemoveHtml($this->id_klinik->caption());

		// id_rmd
		$this->id_rmd->EditAttrs["class"] = "form-control";
		$this->id_rmd->EditCustomAttributes = "";
		$this->id_rmd->EditValue = $this->id_rmd->CurrentValue;
		$this->id_rmd->PlaceHolder = RemoveHtml($this->id_rmd->caption());

		// metode_pembayaran
		$this->metode_pembayaran->EditAttrs["class"] = "form-control";
		$this->metode_pembayaran->EditCustomAttributes = "";
		if (!$this->metode_pembayaran->Raw)
			$this->metode_pembayaran->CurrentValue = HtmlDecode($this->metode_pembayaran->CurrentValue);
		$this->metode_pembayaran->EditValue = $this->metode_pembayaran->CurrentValue;
		$this->metode_pembayaran->PlaceHolder = RemoveHtml($this->metode_pembayaran->caption());

		// id_bank
		$this->id_bank->EditAttrs["class"] = "form-control";
		$this->id_bank->EditCustomAttributes = "";
		$this->id_bank->EditValue = $this->id_bank->CurrentValue;
		$this->id_bank->PlaceHolder = RemoveHtml($this->id_bank->caption());

		// id_kartu
		$this->id_kartu->EditAttrs["class"] = "form-control";
		$this->id_kartu->EditCustomAttributes = "";
		$this->id_kartu->EditValue = $this->id_kartu->CurrentValue;
		$this->id_kartu->PlaceHolder = RemoveHtml($this->id_kartu->caption());

		// jumlah_voucher
		$this->jumlah_voucher->EditAttrs["class"] = "form-control";
		$this->jumlah_voucher->EditCustomAttributes = "";
		$this->jumlah_voucher->EditValue = $this->jumlah_voucher->CurrentValue;
		$this->jumlah_voucher->PlaceHolder = RemoveHtml($this->jumlah_voucher->caption());

		// id_kartubank
		$this->id_kartubank->EditAttrs["class"] = "form-control";
		$this->id_kartubank->EditCustomAttributes = "";
		$this->id_kartubank->EditValue = $this->id_kartubank->CurrentValue;
		$this->id_kartubank->PlaceHolder = RemoveHtml($this->id_kartubank->caption());

		// id_kas
		$this->id_kas->EditAttrs["class"] = "form-control";
		$this->id_kas->EditCustomAttributes = "";
		$this->id_kas->EditValue = $this->id_kas->CurrentValue;
		$this->id_kas->PlaceHolder = RemoveHtml($this->id_kas->caption());

		// charge
		$this->charge->EditAttrs["class"] = "form-control";
		$this->charge->EditCustomAttributes = "";
		$this->charge->EditValue = $this->charge->CurrentValue;
		$this->charge->PlaceHolder = RemoveHtml($this->charge->caption());
		if (strval($this->charge->EditValue) != "" && is_numeric($this->charge->EditValue))
			$this->charge->EditValue = FormatNumber($this->charge->EditValue, -2, -2, -2, -2);
		

		// ongkir
		$this->ongkir->EditAttrs["class"] = "form-control";
		$this->ongkir->EditCustomAttributes = "";
		$this->ongkir->EditValue = $this->ongkir->CurrentValue;
		$this->ongkir->PlaceHolder = RemoveHtml($this->ongkir->caption());
		if (strval($this->ongkir->EditValue) != "" && is_numeric($this->ongkir->EditValue))
			$this->ongkir->EditValue = FormatNumber($this->ongkir->EditValue, -2, -2, -2, -2);
		

		// klaim_poin
		$this->klaim_poin->EditAttrs["class"] = "form-control";
		$this->klaim_poin->EditCustomAttributes = "";
		$this->klaim_poin->EditValue = $this->klaim_poin->CurrentValue;
		$this->klaim_poin->PlaceHolder = RemoveHtml($this->klaim_poin->caption());
		if (strval($this->klaim_poin->EditValue) != "" && is_numeric($this->klaim_poin->EditValue))
			$this->klaim_poin->EditValue = FormatNumber($this->klaim_poin->EditValue, -2, -2, -2, -2);
		

		// total_penukaran_poin
		$this->total_penukaran_poin->EditAttrs["class"] = "form-control";
		$this->total_penukaran_poin->EditCustomAttributes = "";
		$this->total_penukaran_poin->EditValue = $this->total_penukaran_poin->CurrentValue;
		$this->total_penukaran_poin->PlaceHolder = RemoveHtml($this->total_penukaran_poin->caption());
		if (strval($this->total_penukaran_poin->EditValue) != "" && is_numeric($this->total_penukaran_poin->EditValue))
			$this->total_penukaran_poin->EditValue = FormatNumber($this->total_penukaran_poin->EditValue, -2, -2, -2, -2);
		

		// action
		$this->_action->EditAttrs["class"] = "form-control";
		$this->_action->EditCustomAttributes = "";
		if (!$this->_action->Raw)
			$this->_action->CurrentValue = HtmlDecode($this->_action->CurrentValue);
		$this->_action->EditValue = $this->_action->CurrentValue;
		$this->_action->PlaceHolder = RemoveHtml($this->_action->caption());

		// status
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(FALSE);

		// status_void
		$this->status_void->EditAttrs["class"] = "form-control";
		$this->status_void->EditCustomAttributes = "";
		if (!$this->status_void->Raw)
			$this->status_void->CurrentValue = HtmlDecode($this->status_void->CurrentValue);
		$this->status_void->EditValue = $this->status_void->CurrentValue;
		$this->status_void->PlaceHolder = RemoveHtml($this->status_void->caption());

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
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->waktu);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_member);
					$doc->exportCaption($this->diskon_persen);
					$doc->exportCaption($this->diskon_rupiah);
					$doc->exportCaption($this->ppn);
					$doc->exportCaption($this->total);
					$doc->exportCaption($this->bayar);
					$doc->exportCaption($this->bayar_non_tunai);
					$doc->exportCaption($this->total_non_tunai_charge);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->dokter);
					$doc->exportCaption($this->sales);
					$doc->exportCaption($this->dok_be_wajah);
					$doc->exportCaption($this->be_body);
					$doc->exportCaption($this->medis);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_rmd);
					$doc->exportCaption($this->metode_pembayaran);
					$doc->exportCaption($this->id_bank);
					$doc->exportCaption($this->id_kartu);
					$doc->exportCaption($this->jumlah_voucher);
					$doc->exportCaption($this->id_kartubank);
					$doc->exportCaption($this->id_kas);
					$doc->exportCaption($this->charge);
					$doc->exportCaption($this->ongkir);
					$doc->exportCaption($this->klaim_poin);
					$doc->exportCaption($this->total_penukaran_poin);
					$doc->exportCaption($this->_action);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->status_void);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->waktu);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_member);
					$doc->exportCaption($this->diskon_persen);
					$doc->exportCaption($this->diskon_rupiah);
					$doc->exportCaption($this->ppn);
					$doc->exportCaption($this->total);
					$doc->exportCaption($this->bayar);
					$doc->exportCaption($this->bayar_non_tunai);
					$doc->exportCaption($this->total_non_tunai_charge);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->dokter);
					$doc->exportCaption($this->sales);
					$doc->exportCaption($this->dok_be_wajah);
					$doc->exportCaption($this->be_body);
					$doc->exportCaption($this->medis);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_rmd);
					$doc->exportCaption($this->metode_pembayaran);
					$doc->exportCaption($this->id_bank);
					$doc->exportCaption($this->id_kartu);
					$doc->exportCaption($this->jumlah_voucher);
					$doc->exportCaption($this->id_kartubank);
					$doc->exportCaption($this->id_kas);
					$doc->exportCaption($this->charge);
					$doc->exportCaption($this->ongkir);
					$doc->exportCaption($this->klaim_poin);
					$doc->exportCaption($this->total_penukaran_poin);
					$doc->exportCaption($this->_action);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->status_void);
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
						$doc->exportField($this->id);
						$doc->exportField($this->waktu);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_member);
						$doc->exportField($this->diskon_persen);
						$doc->exportField($this->diskon_rupiah);
						$doc->exportField($this->ppn);
						$doc->exportField($this->total);
						$doc->exportField($this->bayar);
						$doc->exportField($this->bayar_non_tunai);
						$doc->exportField($this->total_non_tunai_charge);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->dokter);
						$doc->exportField($this->sales);
						$doc->exportField($this->dok_be_wajah);
						$doc->exportField($this->be_body);
						$doc->exportField($this->medis);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_rmd);
						$doc->exportField($this->metode_pembayaran);
						$doc->exportField($this->id_bank);
						$doc->exportField($this->id_kartu);
						$doc->exportField($this->jumlah_voucher);
						$doc->exportField($this->id_kartubank);
						$doc->exportField($this->id_kas);
						$doc->exportField($this->charge);
						$doc->exportField($this->ongkir);
						$doc->exportField($this->klaim_poin);
						$doc->exportField($this->total_penukaran_poin);
						$doc->exportField($this->_action);
						$doc->exportField($this->status);
						$doc->exportField($this->status_void);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->waktu);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_member);
						$doc->exportField($this->diskon_persen);
						$doc->exportField($this->diskon_rupiah);
						$doc->exportField($this->ppn);
						$doc->exportField($this->total);
						$doc->exportField($this->bayar);
						$doc->exportField($this->bayar_non_tunai);
						$doc->exportField($this->total_non_tunai_charge);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->dokter);
						$doc->exportField($this->sales);
						$doc->exportField($this->dok_be_wajah);
						$doc->exportField($this->be_body);
						$doc->exportField($this->medis);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_rmd);
						$doc->exportField($this->metode_pembayaran);
						$doc->exportField($this->id_bank);
						$doc->exportField($this->id_kartu);
						$doc->exportField($this->jumlah_voucher);
						$doc->exportField($this->id_kartubank);
						$doc->exportField($this->id_kas);
						$doc->exportField($this->charge);
						$doc->exportField($this->ongkir);
						$doc->exportField($this->klaim_poin);
						$doc->exportField($this->total_penukaran_poin);
						$doc->exportField($this->_action);
						$doc->exportField($this->status);
						$doc->exportField($this->status_void);
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