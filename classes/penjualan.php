<?php namespace PHPMaker2020\sim_klinik_alamanda; ?>
<?php

/**
 * Table class for penjualan
 */
class penjualan extends DbTable
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
	public $kode_penjualan;
	public $id_pelanggan;
	public $id_member;
	public $waktu;
	public $diskon_persen;
	public $diskon_rupiah;
	public $ppn;
	public $total;
	public $bayar;
	public $bayar_non_tunai;
	public $total_non_tunai_charge;
	public $keterangan;
	public $id_klinik;
	public $id_rmd;
	public $metode_pembayaran;
	public $id_bank;
	public $id_kartu;
	public $sales;
	public $dok_be_wajah;
	public $be_body;
	public $medis;
	public $dokter;
	public $id_kartubank;
	public $id_kas;
	public $charge;
	public $klaim_poin;
	public $total_penukaran_poin;
	public $ongkir;
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
		$this->TableVar = 'penjualan';
		$this->TableName = 'penjualan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`penjualan`";
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
		$this->id = new DbField('penjualan', 'penjualan', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// kode_penjualan
		$this->kode_penjualan = new DbField('penjualan', 'penjualan', 'x_kode_penjualan', 'kode_penjualan', '`kode_penjualan`', '`kode_penjualan`', 200, 100, -1, FALSE, '`kode_penjualan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kode_penjualan->Nullable = FALSE; // NOT NULL field
		$this->kode_penjualan->Required = TRUE; // Required field
		$this->kode_penjualan->Sortable = TRUE; // Allow sort
		$this->fields['kode_penjualan'] = &$this->kode_penjualan;

		// id_pelanggan
		$this->id_pelanggan = new DbField('penjualan', 'penjualan', 'x_id_pelanggan', 'id_pelanggan', '`id_pelanggan`', '`id_pelanggan`', 3, 11, -1, FALSE, '`EV__id_pelanggan`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->id_pelanggan->Nullable = FALSE; // NOT NULL field
		$this->id_pelanggan->Required = TRUE; // Required field
		$this->id_pelanggan->Sortable = TRUE; // Allow sort
		$this->id_pelanggan->Lookup = new Lookup('id_pelanggan', 'm_pelanggan', FALSE, 'id_pelanggan', ["nama_pelanggan","kode_pelanggan","",""], [], ["x_id_rmd"], [], [], [], [], '', '');
		$this->id_pelanggan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_pelanggan'] = &$this->id_pelanggan;

		// id_member
		$this->id_member = new DbField('penjualan', 'penjualan', 'x_id_member', 'id_member', '`id_member`', '`id_member`', 3, 11, -1, FALSE, '`id_member`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_member->Sortable = TRUE; // Allow sort
		$this->id_member->Lookup = new Lookup('id_member', 'm_jenis_member', FALSE, 'id_jenis_member', ["nama_member","","",""], [], [], [], [], [], [], '', '');
		$this->id_member->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_member'] = &$this->id_member;

		// waktu
		$this->waktu = new DbField('penjualan', 'penjualan', 'x_waktu', 'waktu', '`waktu`', CastDateFieldForLike("`waktu`", 7, "DB"), 133, 10, 7, FALSE, '`waktu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->waktu->Nullable = FALSE; // NOT NULL field
		$this->waktu->Required = TRUE; // Required field
		$this->waktu->Sortable = TRUE; // Allow sort
		$this->waktu->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['waktu'] = &$this->waktu;

		// diskon_persen
		$this->diskon_persen = new DbField('penjualan', 'penjualan', 'x_diskon_persen', 'diskon_persen', '`diskon_persen`', '`diskon_persen`', 200, 50, -1, FALSE, '`diskon_persen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->diskon_persen->Nullable = FALSE; // NOT NULL field
		$this->diskon_persen->Required = TRUE; // Required field
		$this->diskon_persen->Sortable = TRUE; // Allow sort
		$this->fields['diskon_persen'] = &$this->diskon_persen;

		// diskon_rupiah
		$this->diskon_rupiah = new DbField('penjualan', 'penjualan', 'x_diskon_rupiah', 'diskon_rupiah', '`diskon_rupiah`', '`diskon_rupiah`', 5, 22, -1, FALSE, '`diskon_rupiah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->diskon_rupiah->Nullable = FALSE; // NOT NULL field
		$this->diskon_rupiah->Required = TRUE; // Required field
		$this->diskon_rupiah->Sortable = TRUE; // Allow sort
		$this->diskon_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['diskon_rupiah'] = &$this->diskon_rupiah;

		// ppn
		$this->ppn = new DbField('penjualan', 'penjualan', 'x_ppn', 'ppn', '`ppn`', '`ppn`', 5, 22, -1, FALSE, '`ppn`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ppn->Nullable = FALSE; // NOT NULL field
		$this->ppn->Required = TRUE; // Required field
		$this->ppn->Sortable = TRUE; // Allow sort
		$this->ppn->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ppn'] = &$this->ppn;

		// total
		$this->total = new DbField('penjualan', 'penjualan', 'x_total', 'total', '`total`', '`total`', 5, 22, -1, FALSE, '`total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total->Nullable = FALSE; // NOT NULL field
		$this->total->Required = TRUE; // Required field
		$this->total->Sortable = TRUE; // Allow sort
		$this->total->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total'] = &$this->total;

		// bayar
		$this->bayar = new DbField('penjualan', 'penjualan', 'x_bayar', 'bayar', '`bayar`', '`bayar`', 5, 22, -1, FALSE, '`bayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bayar->Nullable = FALSE; // NOT NULL field
		$this->bayar->Required = TRUE; // Required field
		$this->bayar->Sortable = TRUE; // Allow sort
		$this->bayar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['bayar'] = &$this->bayar;

		// bayar_non_tunai
		$this->bayar_non_tunai = new DbField('penjualan', 'penjualan', 'x_bayar_non_tunai', 'bayar_non_tunai', '`bayar_non_tunai`', '`bayar_non_tunai`', 5, 22, -1, FALSE, '`bayar_non_tunai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bayar_non_tunai->Nullable = FALSE; // NOT NULL field
		$this->bayar_non_tunai->Required = TRUE; // Required field
		$this->bayar_non_tunai->Sortable = TRUE; // Allow sort
		$this->bayar_non_tunai->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['bayar_non_tunai'] = &$this->bayar_non_tunai;

		// total_non_tunai_charge
		$this->total_non_tunai_charge = new DbField('penjualan', 'penjualan', 'x_total_non_tunai_charge', 'total_non_tunai_charge', '`total_non_tunai_charge`', '`total_non_tunai_charge`', 5, 22, -1, FALSE, '`total_non_tunai_charge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_non_tunai_charge->Nullable = FALSE; // NOT NULL field
		$this->total_non_tunai_charge->Required = TRUE; // Required field
		$this->total_non_tunai_charge->Sortable = TRUE; // Allow sort
		$this->total_non_tunai_charge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_non_tunai_charge'] = &$this->total_non_tunai_charge;

		// keterangan
		$this->keterangan = new DbField('penjualan', 'penjualan', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// id_klinik
		$this->id_klinik = new DbField('penjualan', 'penjualan', 'x_id_klinik', 'id_klinik', '`id_klinik`', '`id_klinik`', 3, 11, -1, FALSE, '`id_klinik`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_klinik->Required = TRUE; // Required field
		$this->id_klinik->Sortable = TRUE; // Allow sort
		$this->id_klinik->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_klinik->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_klinik->Lookup = new Lookup('id_klinik', 'm_klinik', FALSE, 'id_klinik', ["nama_klinik","","",""], [], ["detailpenjualan x_id_barang","detailpenjualan x_kode_barang","detailpenjualan x_nama_barang","x_id_bank","x_id_kas","view_rm_pasien x_id_barang"], [], [], [], [], '', '');
		$this->id_klinik->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_klinik'] = &$this->id_klinik;

		// id_rmd
		$this->id_rmd = new DbField('penjualan', 'penjualan', 'x_id_rmd', 'id_rmd', '`id_rmd`', '`id_rmd`', 3, 11, -1, FALSE, '`id_rmd`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_rmd->Sortable = TRUE; // Allow sort
		$this->id_rmd->Lookup = new Lookup('id_rmd', 'rekmeddokter', FALSE, 'id_rekmeddok', ["kode_rekmeddok","","",""], ["x_id_pelanggan"], [], ["id_pelanggan"], ["x_id_pelanggan"], [], [], '', '');
		$this->id_rmd->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_rmd'] = &$this->id_rmd;

		// metode_pembayaran
		$this->metode_pembayaran = new DbField('penjualan', 'penjualan', 'x_metode_pembayaran', 'metode_pembayaran', '`metode_pembayaran`', '`metode_pembayaran`', 200, 50, -1, FALSE, '`metode_pembayaran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->metode_pembayaran->Nullable = FALSE; // NOT NULL field
		$this->metode_pembayaran->Required = TRUE; // Required field
		$this->metode_pembayaran->Sortable = TRUE; // Allow sort
		$this->metode_pembayaran->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->metode_pembayaran->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->metode_pembayaran->Lookup = new Lookup('metode_pembayaran', 'penjualan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->metode_pembayaran->OptionCount = 6;
		$this->fields['metode_pembayaran'] = &$this->metode_pembayaran;

		// id_bank
		$this->id_bank = new DbField('penjualan', 'penjualan', 'x_id_bank', 'id_bank', '`id_bank`', '`id_bank`', 3, 11, -1, FALSE, '`id_bank`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_bank->Nullable = FALSE; // NOT NULL field
		$this->id_bank->Required = TRUE; // Required field
		$this->id_bank->Sortable = TRUE; // Allow sort
		$this->id_bank->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_bank->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_bank->Lookup = new Lookup('id_bank', 'm_rekening', FALSE, 'id_rekening', ["id_bank","nama_rekening","",""], ["x_id_klinik"], [], ["id_klinik"], ["x_id_klinik"], [], [], '', '');
		$this->id_bank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_bank'] = &$this->id_bank;

		// id_kartu
		$this->id_kartu = new DbField('penjualan', 'penjualan', 'x_id_kartu', 'id_kartu', '`id_kartu`', '`id_kartu`', 3, 11, -1, FALSE, '`id_kartu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kartu->Sortable = TRUE; // Allow sort
		$this->id_kartu->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kartu->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kartu->Lookup = new Lookup('id_kartu', 'm_kartu', FALSE, 'id_kartu', ["nama_kartu","","",""], [], [], [], [], [], [], '', '');
		$this->id_kartu->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartu'] = &$this->id_kartu;

		// sales
		$this->sales = new DbField('penjualan', 'penjualan', 'x_sales', 'sales', '`sales`', '`sales`', 3, 11, -1, FALSE, '`sales`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sales->Sortable = TRUE; // Allow sort
		$this->sales->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sales->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->sales->Lookup = new Lookup('sales', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","id_klinik","",""], [], [], [], [], [], [], '', '');
		$this->sales->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sales'] = &$this->sales;

		// dok_be_wajah
		$this->dok_be_wajah = new DbField('penjualan', 'penjualan', 'x_dok_be_wajah', 'dok_be_wajah', '`dok_be_wajah`', '`dok_be_wajah`', 3, 11, -1, FALSE, '`dok_be_wajah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->dok_be_wajah->Sortable = TRUE; // Allow sort
		$this->dok_be_wajah->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->dok_be_wajah->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->dok_be_wajah->Lookup = new Lookup('dok_be_wajah', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","id_klinik","",""], [], [], [], [], [], [], '', '');
		$this->dok_be_wajah->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['dok_be_wajah'] = &$this->dok_be_wajah;

		// be_body
		$this->be_body = new DbField('penjualan', 'penjualan', 'x_be_body', 'be_body', '`be_body`', '`be_body`', 3, 11, -1, FALSE, '`be_body`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->be_body->Sortable = TRUE; // Allow sort
		$this->be_body->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->be_body->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->be_body->Lookup = new Lookup('be_body', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","id_klinik","",""], [], [], [], [], [], [], '', '');
		$this->be_body->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['be_body'] = &$this->be_body;

		// medis
		$this->medis = new DbField('penjualan', 'penjualan', 'x_medis', 'medis', '`medis`', '`medis`', 3, 11, -1, FALSE, '`medis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->medis->Sortable = TRUE; // Allow sort
		$this->medis->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->medis->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->medis->Lookup = new Lookup('medis', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","id_klinik","",""], [], [], [], [], [], [], '', '');
		$this->medis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['medis'] = &$this->medis;

		// dokter
		$this->dokter = new DbField('penjualan', 'penjualan', 'x_dokter', 'dokter', '`dokter`', '`dokter`', 3, 11, -1, FALSE, '`dokter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->dokter->Sortable = TRUE; // Allow sort
		$this->dokter->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->dokter->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->dokter->Lookup = new Lookup('dokter', 'm_pegawai', FALSE, 'id_pegawai', ["nama_pegawai","id_klinik","",""], [], [], [], [], [], [], '', '');
		$this->dokter->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['dokter'] = &$this->dokter;

		// id_kartubank
		$this->id_kartubank = new DbField('penjualan', 'penjualan', 'x_id_kartubank', 'id_kartubank', '`id_kartubank`', '`id_kartubank`', 3, 11, -1, FALSE, '`id_kartubank`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kartubank->Nullable = FALSE; // NOT NULL field
		$this->id_kartubank->Required = TRUE; // Required field
		$this->id_kartubank->Sortable = TRUE; // Allow sort
		$this->id_kartubank->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kartubank->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kartubank->Lookup = new Lookup('id_kartubank', 'm_kartu', FALSE, 'id_kartu', ["nama_kartu","","",""], [], [], [], [], [], [], '', '');
		$this->id_kartubank->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kartubank'] = &$this->id_kartubank;

		// id_kas
		$this->id_kas = new DbField('penjualan', 'penjualan', 'x_id_kas', 'id_kas', '`id_kas`', '`id_kas`', 3, 11, -1, FALSE, '`id_kas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_kas->Nullable = FALSE; // NOT NULL field
		$this->id_kas->Required = TRUE; // Required field
		$this->id_kas->Sortable = TRUE; // Allow sort
		$this->id_kas->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_kas->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->id_kas->Lookup = new Lookup('id_kas', 'm_kas', FALSE, 'id', ["nama","","",""], ["x_id_klinik"], [], ["id_klinik"], ["x_id_klinik"], [], [], '', '');
		$this->id_kas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id_kas'] = &$this->id_kas;

		// charge
		$this->charge = new DbField('penjualan', 'penjualan', 'x_charge', 'charge', '`charge`', '`charge`', 5, 22, -1, FALSE, '`charge`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->charge->Sortable = TRUE; // Allow sort
		$this->charge->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['charge'] = &$this->charge;

		// klaim_poin
		$this->klaim_poin = new DbField('penjualan', 'penjualan', 'x_klaim_poin', 'klaim_poin', '`klaim_poin`', '`klaim_poin`', 5, 22, -1, FALSE, '`klaim_poin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->klaim_poin->Sortable = TRUE; // Allow sort
		$this->klaim_poin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['klaim_poin'] = &$this->klaim_poin;

		// total_penukaran_poin
		$this->total_penukaran_poin = new DbField('penjualan', 'penjualan', 'x_total_penukaran_poin', 'total_penukaran_poin', '`total_penukaran_poin`', '`total_penukaran_poin`', 5, 22, -1, FALSE, '`total_penukaran_poin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_penukaran_poin->Sortable = TRUE; // Allow sort
		$this->total_penukaran_poin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['total_penukaran_poin'] = &$this->total_penukaran_poin;

		// ongkir
		$this->ongkir = new DbField('penjualan', 'penjualan', 'x_ongkir', 'ongkir', '`ongkir`', '`ongkir`', 5, 22, -1, FALSE, '`ongkir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ongkir->Sortable = TRUE; // Allow sort
		$this->ongkir->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
		$this->fields['ongkir'] = &$this->ongkir;

		// action
		$this->_action = new DbField('penjualan', 'penjualan', 'x__action', 'action', '`action`', '`action`', 200, 255, -1, FALSE, '`action`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_action->Sortable = TRUE; // Allow sort
		$this->fields['action'] = &$this->_action;

		// status
		$this->status = new DbField('penjualan', 'penjualan', 'x_status', 'status', '`status`', '`status`', 202, 7, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->Lookup = new Lookup('status', 'penjualan', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->status->OptionCount = 2;
		$this->fields['status'] = &$this->status;

		// status_void
		$this->status_void = new DbField('penjualan', 'penjualan', 'x_status_void', 'status_void', '`status_void`', '`status_void`', 200, 50, -1, FALSE, '`status_void`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
			$sortFieldList = ($fld->VirtualExpression != "") ? $fld->VirtualExpression : $sortField;
			$this->setSessionOrderByList($sortFieldList . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Session ORDER BY for List page
	public function getSessionOrderByList()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")];
	}
	public function setSessionOrderByList($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_ORDER_BY_LIST")] = $v;
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
		if ($this->getCurrentDetailTable() == "detailpenjualan") {
			$detailUrl = $GLOBALS["detailpenjualan"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "penjualanlist.php";
		return $detailUrl;
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`penjualan`";
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
	public function getSqlSelectList() // Select for List page
	{
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT CONCAT(COALESCE(`nama_pelanggan`, ''),'" . ValueSeparator(1, $this->id_pelanggan) . "',COALESCE(`kode_pelanggan`,'')) FROM `m_pelanggan` `TMP_LOOKUPTABLE` WHERE `TMP_LOOKUPTABLE`.`id_pelanggan` = `penjualan`.`id_pelanggan` LIMIT 1) AS `EV__id_pelanggan` FROM `penjualan`" .
			") `TMP_TABLE`";
		return ($this->SqlSelectList != "") ? $this->SqlSelectList : $select;
	}
	public function sqlSelectList() // For backward compatibility
	{
		return $this->getSqlSelectList();
	}
	public function setSqlSelectList($v)
	{
		$this->SqlSelectList = $v;
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
		if ($this->useVirtualFields()) {
			$select = $this->getSqlSelectList();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		} else {
			$select = $this->getSqlSelect();
			$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		}
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = ($this->useVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Check if virtual fields is used in SQL
	protected function useVirtualFields()
	{
		$where = $this->UseSessionForListSql ? $this->getSessionWhere() : $this->CurrentFilter;
		$orderBy = $this->UseSessionForListSql ? $this->getSessionOrderByList() : "";
		if ($where != "")
			$where = " " . str_replace(["(", ")"], ["", ""], $where) . " ";
		if ($orderBy != "")
			$orderBy = " " . str_replace(["(", ")"], ["", ""], $orderBy) . " ";
		if ($this->BasicSearch->getKeyword() != "")
			return TRUE;
		if ($this->id_pelanggan->AdvancedSearch->SearchValue != "" ||
			$this->id_pelanggan->AdvancedSearch->SearchValue2 != "" ||
			ContainsString($where, " " . $this->id_pelanggan->VirtualExpression . " "))
			return TRUE;
		if (ContainsString($orderBy, " " . $this->id_pelanggan->VirtualExpression . " "))
			return TRUE;
		return FALSE;
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
		if ($this->useVirtualFields())
			$sql = BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
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

		// Cascade delete detail table 'detailpenjualan'
		if (!isset($GLOBALS["detailpenjualan"]))
			$GLOBALS["detailpenjualan"] = new detailpenjualan();
		$rscascade = $GLOBALS["detailpenjualan"]->loadRs("`id_penjualan` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["detailpenjualan"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["detailpenjualan"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["detailpenjualan"]->Row_Deleted($dtlrow);
		}
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
		$this->kode_penjualan->DbValue = $row['kode_penjualan'];
		$this->id_pelanggan->DbValue = $row['id_pelanggan'];
		$this->id_member->DbValue = $row['id_member'];
		$this->waktu->DbValue = $row['waktu'];
		$this->diskon_persen->DbValue = $row['diskon_persen'];
		$this->diskon_rupiah->DbValue = $row['diskon_rupiah'];
		$this->ppn->DbValue = $row['ppn'];
		$this->total->DbValue = $row['total'];
		$this->bayar->DbValue = $row['bayar'];
		$this->bayar_non_tunai->DbValue = $row['bayar_non_tunai'];
		$this->total_non_tunai_charge->DbValue = $row['total_non_tunai_charge'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->id_klinik->DbValue = $row['id_klinik'];
		$this->id_rmd->DbValue = $row['id_rmd'];
		$this->metode_pembayaran->DbValue = $row['metode_pembayaran'];
		$this->id_bank->DbValue = $row['id_bank'];
		$this->id_kartu->DbValue = $row['id_kartu'];
		$this->sales->DbValue = $row['sales'];
		$this->dok_be_wajah->DbValue = $row['dok_be_wajah'];
		$this->be_body->DbValue = $row['be_body'];
		$this->medis->DbValue = $row['medis'];
		$this->dokter->DbValue = $row['dokter'];
		$this->id_kartubank->DbValue = $row['id_kartubank'];
		$this->id_kas->DbValue = $row['id_kas'];
		$this->charge->DbValue = $row['charge'];
		$this->klaim_poin->DbValue = $row['klaim_poin'];
		$this->total_penukaran_poin->DbValue = $row['total_penukaran_poin'];
		$this->ongkir->DbValue = $row['ongkir'];
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
			return "penjualanlist.php";
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
		if ($pageName == "penjualanview.php")
			return $Language->phrase("View");
		elseif ($pageName == "penjualanedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "penjualanadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "penjualanlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("penjualanview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("penjualanview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "penjualanadd.php?" . $this->getUrlParm($parm);
		else
			$url = "penjualanadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("penjualanedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("penjualanedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
			$url = $this->keyUrl("penjualanadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("penjualanadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("penjualandelete.php", $this->getUrlParm());
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
		$this->kode_penjualan->setDbValue($rs->fields('kode_penjualan'));
		$this->id_pelanggan->setDbValue($rs->fields('id_pelanggan'));
		$this->id_member->setDbValue($rs->fields('id_member'));
		$this->waktu->setDbValue($rs->fields('waktu'));
		$this->diskon_persen->setDbValue($rs->fields('diskon_persen'));
		$this->diskon_rupiah->setDbValue($rs->fields('diskon_rupiah'));
		$this->ppn->setDbValue($rs->fields('ppn'));
		$this->total->setDbValue($rs->fields('total'));
		$this->bayar->setDbValue($rs->fields('bayar'));
		$this->bayar_non_tunai->setDbValue($rs->fields('bayar_non_tunai'));
		$this->total_non_tunai_charge->setDbValue($rs->fields('total_non_tunai_charge'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->id_klinik->setDbValue($rs->fields('id_klinik'));
		$this->id_rmd->setDbValue($rs->fields('id_rmd'));
		$this->metode_pembayaran->setDbValue($rs->fields('metode_pembayaran'));
		$this->id_bank->setDbValue($rs->fields('id_bank'));
		$this->id_kartu->setDbValue($rs->fields('id_kartu'));
		$this->sales->setDbValue($rs->fields('sales'));
		$this->dok_be_wajah->setDbValue($rs->fields('dok_be_wajah'));
		$this->be_body->setDbValue($rs->fields('be_body'));
		$this->medis->setDbValue($rs->fields('medis'));
		$this->dokter->setDbValue($rs->fields('dokter'));
		$this->id_kartubank->setDbValue($rs->fields('id_kartubank'));
		$this->id_kas->setDbValue($rs->fields('id_kas'));
		$this->charge->setDbValue($rs->fields('charge'));
		$this->klaim_poin->setDbValue($rs->fields('klaim_poin'));
		$this->total_penukaran_poin->setDbValue($rs->fields('total_penukaran_poin'));
		$this->ongkir->setDbValue($rs->fields('ongkir'));
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
		// kode_penjualan
		// id_pelanggan
		// id_member
		// waktu
		// diskon_persen
		// diskon_rupiah
		// ppn
		// total
		// bayar
		// bayar_non_tunai
		// total_non_tunai_charge
		// keterangan
		// id_klinik
		// id_rmd
		// metode_pembayaran
		// id_bank
		// id_kartu
		// sales

		$this->sales->CellCssStyle = "white-space: nowrap;";

		// dok_be_wajah
		// be_body
		// medis
		// dokter
		// id_kartubank
		// id_kas
		// charge
		// klaim_poin
		// total_penukaran_poin
		// ongkir
		// action
		// status
		// status_void
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// kode_penjualan
		$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->ViewCustomAttributes = "";

		// id_pelanggan
		if ($this->id_pelanggan->VirtualValue != "") {
			$this->id_pelanggan->ViewValue = $this->id_pelanggan->VirtualValue;
		} else {
			$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
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
		}
		$this->id_pelanggan->ViewCustomAttributes = "";

		// id_member
		$this->id_member->ViewValue = $this->id_member->CurrentValue;
		$curVal = strval($this->id_member->CurrentValue);
		if ($curVal != "") {
			$this->id_member->ViewValue = $this->id_member->lookupCacheOption($curVal);
			if ($this->id_member->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_jenis_member`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_member->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_member->ViewValue = $this->id_member->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_member->ViewValue = $this->id_member->CurrentValue;
				}
			}
		} else {
			$this->id_member->ViewValue = NULL;
		}
		$this->id_member->ViewCustomAttributes = "";

		// waktu
		$this->waktu->ViewValue = $this->waktu->CurrentValue;
		$this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 7);
		$this->waktu->ViewCustomAttributes = "";

		// diskon_persen
		$this->diskon_persen->ViewValue = $this->diskon_persen->CurrentValue;
		$this->diskon_persen->ViewCustomAttributes = "";

		// diskon_rupiah
		$this->diskon_rupiah->ViewValue = $this->diskon_rupiah->CurrentValue;
		$this->diskon_rupiah->ViewValue = FormatCurrency($this->diskon_rupiah->ViewValue, 0, -2, -2, -2);
		$this->diskon_rupiah->ViewCustomAttributes = "";

		// ppn
		$this->ppn->ViewValue = $this->ppn->CurrentValue;
		$this->ppn->ViewValue = FormatNumber($this->ppn->ViewValue, 2, -2, -2, -2);
		$this->ppn->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewValue = FormatCurrency($this->total->ViewValue, 0, -2, -2, -2);
		$this->total->CssClass = "font-weight-bold";
		$this->total->ViewCustomAttributes = "";

		// bayar
		$this->bayar->ViewValue = $this->bayar->CurrentValue;
		$this->bayar->ViewValue = FormatCurrency($this->bayar->ViewValue, 0, -2, -2, -2);
		$this->bayar->ViewCustomAttributes = "";

		// bayar_non_tunai
		$this->bayar_non_tunai->ViewValue = $this->bayar_non_tunai->CurrentValue;
		$this->bayar_non_tunai->ViewValue = FormatNumber($this->bayar_non_tunai->ViewValue, 2, -2, -2, -2);
		$this->bayar_non_tunai->ViewCustomAttributes = "";

		// total_non_tunai_charge
		$this->total_non_tunai_charge->ViewValue = $this->total_non_tunai_charge->CurrentValue;
		$this->total_non_tunai_charge->ViewValue = FormatNumber($this->total_non_tunai_charge->ViewValue, 2, -2, -2, -2);
		$this->total_non_tunai_charge->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

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

		// id_rmd
		$this->id_rmd->ViewValue = $this->id_rmd->CurrentValue;
		$curVal = strval($this->id_rmd->CurrentValue);
		if ($curVal != "") {
			$this->id_rmd->ViewValue = $this->id_rmd->lookupCacheOption($curVal);
			if ($this->id_rmd->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_rekmeddok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_rmd->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_rmd->ViewValue = $this->id_rmd->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_rmd->ViewValue = $this->id_rmd->CurrentValue;
				}
			}
		} else {
			$this->id_rmd->ViewValue = NULL;
		}
		$this->id_rmd->ViewCustomAttributes = "";

		// metode_pembayaran
		if (strval($this->metode_pembayaran->CurrentValue) != "") {
			$this->metode_pembayaran->ViewValue = $this->metode_pembayaran->optionCaption($this->metode_pembayaran->CurrentValue);
		} else {
			$this->metode_pembayaran->ViewValue = NULL;
		}
		$this->metode_pembayaran->ViewCustomAttributes = "";

		// id_bank
		$curVal = strval($this->id_bank->CurrentValue);
		if ($curVal != "") {
			$this->id_bank->ViewValue = $this->id_bank->lookupCacheOption($curVal);
			if ($this->id_bank->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_rekening`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_bank->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = FormatNumber($rswrk->fields('df'), 0, -2, -2, -2);
					$arwrk[2] = $rswrk->fields('df2');
					$this->id_bank->ViewValue = $this->id_bank->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_bank->ViewValue = $this->id_bank->CurrentValue;
				}
			}
		} else {
			$this->id_bank->ViewValue = NULL;
		}
		$this->id_bank->ViewCustomAttributes = "";

		// id_kartu
		$curVal = strval($this->id_kartu->CurrentValue);
		if ($curVal != "") {
			$this->id_kartu->ViewValue = $this->id_kartu->lookupCacheOption($curVal);
			if ($this->id_kartu->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_kartu`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`jenis` = 'Voucher'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_kartu->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_kartu->ViewValue = $this->id_kartu->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_kartu->ViewValue = $this->id_kartu->CurrentValue;
				}
			}
		} else {
			$this->id_kartu->ViewValue = NULL;
		}
		$this->id_kartu->ViewCustomAttributes = "";

		// sales
		$curVal = strval($this->sales->CurrentValue);
		if ($curVal != "") {
			$this->sales->ViewValue = $this->sales->lookupCacheOption($curVal);
			if ($this->sales->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->sales->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
					$this->sales->ViewValue = $this->sales->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->sales->ViewValue = $this->sales->CurrentValue;
				}
			}
		} else {
			$this->sales->ViewValue = NULL;
		}
		$this->sales->ViewCustomAttributes = "";

		// dok_be_wajah
		$curVal = strval($this->dok_be_wajah->CurrentValue);
		if ($curVal != "") {
			$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->lookupCacheOption($curVal);
			if ($this->dok_be_wajah->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 2";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->dok_be_wajah->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
					$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->dok_be_wajah->ViewValue = $this->dok_be_wajah->CurrentValue;
				}
			}
		} else {
			$this->dok_be_wajah->ViewValue = NULL;
		}
		$this->dok_be_wajah->ViewCustomAttributes = "";

		// be_body
		$curVal = strval($this->be_body->CurrentValue);
		if ($curVal != "") {
			$this->be_body->ViewValue = $this->be_body->lookupCacheOption($curVal);
			if ($this->be_body->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 3";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->be_body->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
					$this->be_body->ViewValue = $this->be_body->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->be_body->ViewValue = $this->be_body->CurrentValue;
				}
			}
		} else {
			$this->be_body->ViewValue = NULL;
		}
		$this->be_body->ViewCustomAttributes = "";

		// medis
		$curVal = strval($this->medis->CurrentValue);
		if ($curVal != "") {
			$this->medis->ViewValue = $this->medis->lookupCacheOption($curVal);
			if ($this->medis->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 4";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->medis->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
					$this->medis->ViewValue = $this->medis->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->medis->ViewValue = $this->medis->CurrentValue;
				}
			}
		} else {
			$this->medis->ViewValue = NULL;
		}
		$this->medis->ViewCustomAttributes = "";

		// dokter
		$curVal = strval($this->dokter->CurrentValue);
		if ($curVal != "") {
			$this->dokter->ViewValue = $this->dokter->lookupCacheOption($curVal);
			if ($this->dokter->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`jabatan_pegawai` = 1";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->dokter->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$arwrk[2] = FormatNumber($rswrk->fields('df2'), 0, -2, -2, -2);
					$this->dokter->ViewValue = $this->dokter->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->dokter->ViewValue = $this->dokter->CurrentValue;
				}
			}
		} else {
			$this->dokter->ViewValue = NULL;
		}
		$this->dokter->ViewCustomAttributes = "";

		// id_kartubank
		$curVal = strval($this->id_kartubank->CurrentValue);
		if ($curVal != "") {
			$this->id_kartubank->ViewValue = $this->id_kartubank->lookupCacheOption($curVal);
			if ($this->id_kartubank->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id_kartu`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$lookupFilter = function() {
					return "`jenis` <> 'Voucher'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->id_kartubank->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_kartubank->ViewValue = $this->id_kartubank->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_kartubank->ViewValue = $this->id_kartubank->CurrentValue;
				}
			}
		} else {
			$this->id_kartubank->ViewValue = NULL;
		}
		$this->id_kartubank->ViewCustomAttributes = "";

		// id_kas
		$curVal = strval($this->id_kas->CurrentValue);
		if ($curVal != "") {
			$this->id_kas->ViewValue = $this->id_kas->lookupCacheOption($curVal);
			if ($this->id_kas->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->id_kas->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->id_kas->ViewValue = $this->id_kas->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_kas->ViewValue = $this->id_kas->CurrentValue;
				}
			}
		} else {
			$this->id_kas->ViewValue = NULL;
		}
		$this->id_kas->ViewCustomAttributes = "";

		// charge
		$this->charge->ViewValue = $this->charge->CurrentValue;
		$this->charge->ViewValue = FormatNumber($this->charge->ViewValue, 2, -2, -2, -2);
		$this->charge->ViewCustomAttributes = "";

		// klaim_poin
		$this->klaim_poin->ViewValue = $this->klaim_poin->CurrentValue;
		$this->klaim_poin->ViewValue = FormatNumber($this->klaim_poin->ViewValue, 2, -2, -2, -2);
		$this->klaim_poin->ViewCustomAttributes = "";

		// total_penukaran_poin
		$this->total_penukaran_poin->ViewValue = $this->total_penukaran_poin->CurrentValue;
		$this->total_penukaran_poin->ViewValue = FormatNumber($this->total_penukaran_poin->ViewValue, 2, -2, -2, -2);
		$this->total_penukaran_poin->ViewCustomAttributes = "";

		// ongkir
		$this->ongkir->ViewValue = $this->ongkir->CurrentValue;
		$this->ongkir->ViewValue = FormatNumber($this->ongkir->ViewValue, 2, -2, -2, -2);
		$this->ongkir->ViewCustomAttributes = "";

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

		// kode_penjualan
		$this->kode_penjualan->LinkCustomAttributes = "";
		$this->kode_penjualan->HrefValue = "";
		$this->kode_penjualan->TooltipValue = "";

		// id_pelanggan
		$this->id_pelanggan->LinkCustomAttributes = "";
		$this->id_pelanggan->HrefValue = "";
		$this->id_pelanggan->TooltipValue = "";

		// id_member
		$this->id_member->LinkCustomAttributes = "";
		$this->id_member->HrefValue = "";
		$this->id_member->TooltipValue = "";

		// waktu
		$this->waktu->LinkCustomAttributes = "";
		$this->waktu->HrefValue = "";
		$this->waktu->TooltipValue = "";

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

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

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

		// dokter
		$this->dokter->LinkCustomAttributes = "";
		$this->dokter->HrefValue = "";
		$this->dokter->TooltipValue = "";

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

		// klaim_poin
		$this->klaim_poin->LinkCustomAttributes = "";
		$this->klaim_poin->HrefValue = "";
		$this->klaim_poin->TooltipValue = "";

		// total_penukaran_poin
		$this->total_penukaran_poin->LinkCustomAttributes = "";
		$this->total_penukaran_poin->HrefValue = "";
		$this->total_penukaran_poin->TooltipValue = "";

		// ongkir
		$this->ongkir->LinkCustomAttributes = "";
		$this->ongkir->HrefValue = "";
		$this->ongkir->TooltipValue = "";

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

		// kode_penjualan
		$this->kode_penjualan->EditAttrs["class"] = "form-control";
		$this->kode_penjualan->EditCustomAttributes = "";
		if (!$this->kode_penjualan->Raw)
			$this->kode_penjualan->CurrentValue = HtmlDecode($this->kode_penjualan->CurrentValue);
		$this->kode_penjualan->EditValue = $this->kode_penjualan->CurrentValue;
		$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

		// id_pelanggan
		$this->id_pelanggan->EditAttrs["class"] = "form-control";
		$this->id_pelanggan->EditCustomAttributes = "";
		$this->id_pelanggan->EditValue = $this->id_pelanggan->CurrentValue;
		$this->id_pelanggan->PlaceHolder = RemoveHtml($this->id_pelanggan->caption());

		// id_member
		$this->id_member->EditAttrs["class"] = "form-control";
		$this->id_member->EditCustomAttributes = "Readonly";
		$this->id_member->EditValue = $this->id_member->CurrentValue;
		$this->id_member->PlaceHolder = RemoveHtml($this->id_member->caption());

		// waktu
		$this->waktu->EditAttrs["class"] = "form-control";
		$this->waktu->EditCustomAttributes = "";
		$this->waktu->EditValue = FormatDateTime($this->waktu->CurrentValue, 7);
		$this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

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
		$this->total->EditCustomAttributes = "style='border:none; height:2em; font-size: 3em; background-color: white;' Readonly";
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
		$this->total_non_tunai_charge->EditCustomAttributes = 'Readonly';
		$this->total_non_tunai_charge->EditValue = $this->total_non_tunai_charge->CurrentValue;
		$this->total_non_tunai_charge->PlaceHolder = RemoveHtml($this->total_non_tunai_charge->caption());
		if (strval($this->total_non_tunai_charge->EditValue) != "" && is_numeric($this->total_non_tunai_charge->EditValue))
			$this->total_non_tunai_charge->EditValue = FormatNumber($this->total_non_tunai_charge->EditValue, -2, -2, -2, -2);
		

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// id_klinik
		$this->id_klinik->EditCustomAttributes = "";

		// id_rmd
		$this->id_rmd->EditAttrs["class"] = "form-control";
		$this->id_rmd->EditCustomAttributes = "";
		$this->id_rmd->EditValue = $this->id_rmd->CurrentValue;
		$this->id_rmd->PlaceHolder = RemoveHtml($this->id_rmd->caption());

		// metode_pembayaran
		$this->metode_pembayaran->EditAttrs["class"] = "form-control";
		$this->metode_pembayaran->EditCustomAttributes = "";
		$this->metode_pembayaran->EditValue = $this->metode_pembayaran->options(TRUE);

		// id_bank
		$this->id_bank->EditAttrs["class"] = "form-control";
		$this->id_bank->EditCustomAttributes = "";

		// id_kartu
		$this->id_kartu->EditAttrs["class"] = "form-control";
		$this->id_kartu->EditCustomAttributes = "";

		// sales
		$this->sales->EditAttrs["class"] = "form-control";
		$this->sales->EditCustomAttributes = "";

		// dok_be_wajah
		$this->dok_be_wajah->EditAttrs["class"] = "form-control";
		$this->dok_be_wajah->EditCustomAttributes = "";

		// be_body
		$this->be_body->EditAttrs["class"] = "form-control";
		$this->be_body->EditCustomAttributes = "";

		// medis
		$this->medis->EditAttrs["class"] = "form-control";
		$this->medis->EditCustomAttributes = "";

		// dokter
		$this->dokter->EditAttrs["class"] = "form-control";
		$this->dokter->EditCustomAttributes = "";

		// id_kartubank
		$this->id_kartubank->EditAttrs["class"] = "form-control";
		$this->id_kartubank->EditCustomAttributes = "";

		// id_kas
		$this->id_kas->EditAttrs["class"] = "form-control";
		$this->id_kas->EditCustomAttributes = "";

		// charge
		$this->charge->EditAttrs["class"] = "form-control";
		$this->charge->EditCustomAttributes = 'Readonly';
		$this->charge->EditValue = $this->charge->CurrentValue;
		$this->charge->PlaceHolder = RemoveHtml($this->charge->caption());
		if (strval($this->charge->EditValue) != "" && is_numeric($this->charge->EditValue))
			$this->charge->EditValue = FormatNumber($this->charge->EditValue, -2, -2, -2, -2);
		

		// klaim_poin
		$this->klaim_poin->EditAttrs["class"] = "form-control";
		$this->klaim_poin->EditCustomAttributes = "";
		$this->klaim_poin->EditValue = $this->klaim_poin->CurrentValue;
		$this->klaim_poin->PlaceHolder = RemoveHtml($this->klaim_poin->caption());
		if (strval($this->klaim_poin->EditValue) != "" && is_numeric($this->klaim_poin->EditValue))
			$this->klaim_poin->EditValue = FormatNumber($this->klaim_poin->EditValue, -2, -2, -2, -2);
		

		// total_penukaran_poin
		$this->total_penukaran_poin->EditAttrs["class"] = "form-control";
		$this->total_penukaran_poin->EditCustomAttributes = "Readonly";
		$this->total_penukaran_poin->EditValue = $this->total_penukaran_poin->CurrentValue;
		$this->total_penukaran_poin->PlaceHolder = RemoveHtml($this->total_penukaran_poin->caption());
		if (strval($this->total_penukaran_poin->EditValue) != "" && is_numeric($this->total_penukaran_poin->EditValue))
			$this->total_penukaran_poin->EditValue = FormatNumber($this->total_penukaran_poin->EditValue, -2, -2, -2, -2);
		

		// ongkir
		$this->ongkir->EditAttrs["class"] = "form-control";
		$this->ongkir->EditCustomAttributes = "";
		$this->ongkir->EditValue = $this->ongkir->CurrentValue;
		$this->ongkir->PlaceHolder = RemoveHtml($this->ongkir->caption());
		if (strval($this->ongkir->EditValue) != "" && is_numeric($this->ongkir->EditValue))
			$this->ongkir->EditValue = FormatNumber($this->ongkir->EditValue, -2, -2, -2, -2);
		

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
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_member);
					$doc->exportCaption($this->waktu);
					$doc->exportCaption($this->diskon_persen);
					$doc->exportCaption($this->diskon_rupiah);
					$doc->exportCaption($this->ppn);
					$doc->exportCaption($this->total);
					$doc->exportCaption($this->bayar);
					$doc->exportCaption($this->bayar_non_tunai);
					$doc->exportCaption($this->total_non_tunai_charge);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_rmd);
					$doc->exportCaption($this->metode_pembayaran);
					$doc->exportCaption($this->id_bank);
					$doc->exportCaption($this->id_kartu);
					$doc->exportCaption($this->sales);
					$doc->exportCaption($this->dok_be_wajah);
					$doc->exportCaption($this->be_body);
					$doc->exportCaption($this->medis);
					$doc->exportCaption($this->dokter);
					$doc->exportCaption($this->id_kartubank);
					$doc->exportCaption($this->id_kas);
					$doc->exportCaption($this->charge);
					$doc->exportCaption($this->klaim_poin);
					$doc->exportCaption($this->total_penukaran_poin);
					$doc->exportCaption($this->ongkir);
					$doc->exportCaption($this->_action);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->status_void);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->kode_penjualan);
					$doc->exportCaption($this->id_pelanggan);
					$doc->exportCaption($this->id_member);
					$doc->exportCaption($this->waktu);
					$doc->exportCaption($this->diskon_persen);
					$doc->exportCaption($this->diskon_rupiah);
					$doc->exportCaption($this->ppn);
					$doc->exportCaption($this->total);
					$doc->exportCaption($this->bayar);
					$doc->exportCaption($this->bayar_non_tunai);
					$doc->exportCaption($this->total_non_tunai_charge);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->id_klinik);
					$doc->exportCaption($this->id_rmd);
					$doc->exportCaption($this->metode_pembayaran);
					$doc->exportCaption($this->id_bank);
					$doc->exportCaption($this->id_kartu);
					$doc->exportCaption($this->sales);
					$doc->exportCaption($this->dok_be_wajah);
					$doc->exportCaption($this->be_body);
					$doc->exportCaption($this->medis);
					$doc->exportCaption($this->dokter);
					$doc->exportCaption($this->id_kartubank);
					$doc->exportCaption($this->id_kas);
					$doc->exportCaption($this->charge);
					$doc->exportCaption($this->klaim_poin);
					$doc->exportCaption($this->total_penukaran_poin);
					$doc->exportCaption($this->ongkir);
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
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_member);
						$doc->exportField($this->waktu);
						$doc->exportField($this->diskon_persen);
						$doc->exportField($this->diskon_rupiah);
						$doc->exportField($this->ppn);
						$doc->exportField($this->total);
						$doc->exportField($this->bayar);
						$doc->exportField($this->bayar_non_tunai);
						$doc->exportField($this->total_non_tunai_charge);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_rmd);
						$doc->exportField($this->metode_pembayaran);
						$doc->exportField($this->id_bank);
						$doc->exportField($this->id_kartu);
						$doc->exportField($this->sales);
						$doc->exportField($this->dok_be_wajah);
						$doc->exportField($this->be_body);
						$doc->exportField($this->medis);
						$doc->exportField($this->dokter);
						$doc->exportField($this->id_kartubank);
						$doc->exportField($this->id_kas);
						$doc->exportField($this->charge);
						$doc->exportField($this->klaim_poin);
						$doc->exportField($this->total_penukaran_poin);
						$doc->exportField($this->ongkir);
						$doc->exportField($this->_action);
						$doc->exportField($this->status);
						$doc->exportField($this->status_void);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->kode_penjualan);
						$doc->exportField($this->id_pelanggan);
						$doc->exportField($this->id_member);
						$doc->exportField($this->waktu);
						$doc->exportField($this->diskon_persen);
						$doc->exportField($this->diskon_rupiah);
						$doc->exportField($this->ppn);
						$doc->exportField($this->total);
						$doc->exportField($this->bayar);
						$doc->exportField($this->bayar_non_tunai);
						$doc->exportField($this->total_non_tunai_charge);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->id_klinik);
						$doc->exportField($this->id_rmd);
						$doc->exportField($this->metode_pembayaran);
						$doc->exportField($this->id_bank);
						$doc->exportField($this->id_kartu);
						$doc->exportField($this->sales);
						$doc->exportField($this->dok_be_wajah);
						$doc->exportField($this->be_body);
						$doc->exportField($this->medis);
						$doc->exportField($this->dokter);
						$doc->exportField($this->id_kartubank);
						$doc->exportField($this->id_kas);
						$doc->exportField($this->charge);
						$doc->exportField($this->klaim_poin);
						$doc->exportField($this->total_penukaran_poin);
						$doc->exportField($this->ongkir);
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

	// Write Audit Trail start/end for grid update
	public function writeAuditTrailDummy($typ)
	{
		$table = 'penjualan';
		$usr = CurrentUserName();
		WriteAuditTrail("log", DbCurrentDateTime(), ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	public function writeAuditTrailOnAdd(&$rs)
	{
		global $Language;
		if (!$this->AuditTrailOnAdd)
			return;
		$table = 'penjualan';

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
		$table = 'penjualan';

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
		$table = 'penjualan';

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
		$kode_penjualan_sebelumnya = ExecuteScalar("SELECT kode_penjualan FROM penjualan WHERE id_klinik=$id_klinik ORDER BY id DESC");
		$kode = explode('-', $kode_penjualan_sebelumnya);
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
		//$kode_penjualan = 

		$rsnew['kode_penjualan'] = 'J' . $id_klinik . '-' . date('ym') . '-' . $nomor_urut;

		// Action
		$action_date = date("d M Y");
		date_default_timezone_set("America/New_York");
		$user = CurrentUserInfo("id_pegawai");
		$pegawai = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai='$user'");
		$status = $rsnew["status"];
		if($status == "Draft") {
			$rsnew["action"] = "Drafted by " .$pegawai. " at " .$action_date. " [". date("h:i"). "]";
		} else {
			$rsnew["action"] = "Created by " .$pegawai. " at " .$action_date. " [". date("h:i"). "]";
		}
		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted";
		$id_pelanggan = $rsnew['id_pelanggan'];
		$id_klinik = $rsnew['id_klinik'];
		$ongkir = $rsnew['ongkir'];
		$total = $rsnew['total'];

		//Cek lagi kode penjualan
		$kode_penjualan_sebelumnya = ExecuteScalar("SELECT kode_penjualan FROM penjualan WHERE id_klinik='$id_klinik' ORDER BY id DESC LIMIT 1, 1");
		$kode_penjualan_sekarang = $rsnew['kode_penjualan'];

		// Jika kodenya sekarang sama dengan kode sebelumnya
		if($kode_penjualan_sekarang == $kode_penjualan_sebelumnya) {
			$kode = explode('-', $kode_penjualan_sekarang);
			$nomor_urut_terakhir = $kode[2];
			$bulan_sebelumnya = substr($kode[1], -2);
			$nomor_urut = '0000';
			$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
			$rsnew['kode_penjualan'] = 'J' . $id_klinik . '-' . date('ym') . '-' . $nomor_urut;		
		}

		// Mendapatkan kode mutasi terakhir pada klinik $id_klinik, untuk diambil nomor urutnya
		$kode_mutasi_sebelumnya = ExecuteScalar("SELECT no_bukti FROM mutasi_kas WHERE id_klinik='$id_klinik' AND no_bukti LIKE '%KBM%' ORDER BY id DESC LIMIT 1");
		$kode = explode('-', $kode_mutasi_sebelumnya);
		$nomor_urut_terakhir = $kode[2];
		$bulan_sebelumnya = substr($kode[1], -2);
		$nomor_urut = '0000';
		if ($bulan_sebelumnya == date('m')) {
			$nomor_urut = sprintf('%04d', (int)$nomor_urut_terakhir + 1);
		} else {
			$nomor_urut = sprintf('%04d', 1);
		}
		$metode_pembayaran = $rsnew['metode_pembayaran'];
		$kartu = $rsnew['id_kartu'];
		$id_bankrekening = $rsnew['id_bank'];
		$id_kartubank = $rsnew['id_kartubank'];
		$id_kas = $rsnew['id_kas'];
		$charge = $rsnew['charge'];
		$nilai_charge = str_replace('.',',',$charge);
		$id_klinik = $rsnew['id_klinik'];
		$kode_penjualan = $rsnew['kode_penjualan'];
		$tanggal = $rsnew['waktu'];
		$jumlah = $rsnew['bayar'];
		$jumlah_non_tunai = $rsnew['bayar_non_tunai'];
		$total_non_tunai = $rsnew['total_non_tunai_charge'];
		$klaim_poin = $rsnew['klaim_poin'];
		$status = $rsnew['status'];
		$id_sebelumnya = ExecuteScalar("SELECT id FROM penggunaan_kartu ORDER BY id DESC LIMIT 1");
		$id_sekarang = $id_sebelumnya+1;
		$id_setelahnya = $id_sekarang+1;
		if($status == 'Printed') { //begin of if(status == printed)

			//INSERTING KAS / REKENING
			if($metode_pembayaran == 'Debit' OR $metode_pembayaran == 'Kredit'){
				$jenis_kartu = ExecuteScalar("SELECT jenis FROM m_kartu WHERE id_kartu = '$id_kartubank'");
				$saldo_lama_bank = ExecuteScalar("SELECT saldo FROM m_rekening WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
				$saldo_baru_bank = $saldo_lama_bank + $total_non_tunai;
				Execute("INSERT INTO penggunaan_kartu (id_kartu, jenis_kartu, id_klinik, kode_penjualan, tgl, total, charge, total_charge) VALUES ('".$id_kartubank."', '".$jenis_kartu."', '".$id_klinik."', '".$kode_penjualan."', '".$tanggal."', '".$jumlah_non_tunai."', '".$nilai_charge."', '".$total_non_tunai."')");
				Execute("INSERT INTO laporan_rekening (id_rekening, id_klinik, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_bankrekening."', '".$id_klinik."', '".$kode_penjualan."', '".$saldo_lama_bank."','".$total_non_tunai."', '".$saldo_baru_bank."', '".$tanggal."')");
				Execute("UPDATE m_rekening SET saldo='$saldo_baru_bank' WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
			} else if($metode_pembayaran == 'Transfer'){
				$saldo_lama_bank = ExecuteScalar("SELECT saldo FROM m_rekening WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
				$saldo_baru_bank = $saldo_lama_bank + $total_non_tunai;
				Execute("INSERT INTO laporan_rekening (id_rekening, id_klinik, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_bankrekening."', '".$id_klinik."', '".$kode_penjualan."', '".$saldo_lama_bank."', '".$total_non_tunai."', '".$saldo_baru_bank."', '".$tanggal."')");
				Execute("UPDATE m_rekening SET saldo='$saldo_baru_bank' WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");		
			} else if($metode_pembayaran == 'Tunai-Debit' OR $metode_pembayaran == 'Tunai-Kredit'){
				$jenis_kartu = ExecuteScalar("SELECT jenis FROM m_kartu WHERE id_kartu = '$id_kartubank'");
				$saldo_lama_bank = ExecuteScalar("SELECT saldo FROM m_rekening WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
				$saldo_baru_bank = $saldo_lama_bank + $total_non_tunai;
				Execute("INSERT INTO penggunaan_kartu (id_kartu, jenis_kartu, id_klinik, kode_penjualan, tgl, total, charge, total_charge) VALUES ('".$id_kartubank."', '".$jenis_kartu."', '".$id_klinik."', '".$kode_penjualan."', '".$tanggal."', '".$jumlah_non_tunai."', '".$nilai_charge."', '".$total_non_tunai."')");
				Execute("INSERT INTO laporan_rekening (id_rekening, id_klinik, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_bankrekening."', '".$id_klinik."', '".$kode_penjualan."', '".$saldo_lama_bank."', '".$total_non_tunai."', '".$saldo_baru_bank."', '".$tanggal."')");
				Execute("UPDATE m_rekening SET saldo='$saldo_baru_bank' WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");		            
				$saldo_lama_kas = ExecuteScalar("SELECT saldo FROM m_kas WHERE id = '$id_kas' AND id_klinik='$id_klinik'");
				$saldo_baru_kas = $saldo_lama_kas + ($total - $total_non_tunai);
				$jumlah_tunai = $total - $total_non_tunai;
				Execute("INSERT INTO laporan_kas (id_klinik, id_kas, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_klinik."', '".$id_kas."', '".$kode_penjualan."', '".$saldo_lama_kas."', '".$jumlah_tunai."', '".$saldo_baru_kas."', '".$tanggal."')");
				Execute("UPDATE m_kas SET saldo='$saldo_baru_kas' WHERE id = '$id_kas' AND id_klinik='$id_klinik'");		
			} else if($metode_pembayaran == 'Tunai'){
				$saldo_lama_kas = ExecuteScalar("SELECT saldo FROM m_kas WHERE id = '$id_kas' AND id_klinik='$id_klinik'");
				$saldo_baru_kas = $saldo_lama_kas + $total;
				Execute("INSERT INTO laporan_kas (id_klinik, id_kas, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_klinik."', '".$id_kas."', '".$kode_penjualan."', '".$saldo_lama_kas."', '".$total."', '".$saldo_baru_kas."', '".$tanggal."')");
				Execute("UPDATE m_kas SET saldo='$saldo_baru_kas' WHERE id = '$id_kas' AND id_klinik='$id_klinik'");		
			}

			//INSERTING VOUCHER INTO PENGGUNAAN KARTU
			if($kartu != '' OR $kartu != NULL){
				$jenis_kartu_voucher = ExecuteScalar("SELECT jenis FROM m_kartu WHERE id_kartu = '$kartu'");
				$charge_price_voucher = ExecuteScalar("SELECT charge_price FROM m_kartu WHERE id_kartu = '$kartu'");
				Execute("INSERT INTO penggunaan_kartu (id_kartu, jenis_kartu, id_klinik, kode_penjualan, tgl, charge, total_charge) VALUES ('".$kartu."', '".$jenis_kartu_voucher."', '".$id_klinik."', '".$kode_penjualan."', '".$tanggal."', '".$charge_price_voucher."', '".$total."')");
			}

			//ADDING POIN MEMBER
			$idpelanggan = ExecuteScalar("SELECT id_pelanggan FROM m_pelanggan WHERE id_pelanggan IN (SELECT id_pelanggan FROM m_member WHERE id_pelanggan='$id_pelanggan')");
			$jenismember = ExecuteScalar("SELECT jenis_member FROM m_member WHERE id_pelanggan = '$idpelanggan'");
			$kelipatan = ExecuteScalar("SELECT curs_poin FROM m_poin WHERE id_jenis_member = '$jenismember'");
			$perhitungan = ($total - $ongkir) / $kelipatan;
			$poinsebelumnya = ExecuteScalar("SELECT poin_member FROM m_member WHERE id_pelanggan = '$idpelanggan'");
			$min_transaksi = ExecuteScalar("SELECT min_transaksi FROM m_poin WHERE id_jenis_member = '$jenismember'");
			if($total >= $min_transaksi) {
				if($idpelanggan == FALSE){

					// Execute("INSERT INTO m_member (kode_member, idpelanggan, jenis_member, tgl_mulai, tgl_akhir, poin_member) VALUES ('', '".$id_pelanggan."', '1', '".date("Y-m-d h:i:s")."', '', '".floor($perhitungan)."')");
				} else {
					if($klaim_poin != NULL OR $klaim_poin != '') {
						$saldo_poin_klaim = $poinsebelumnya - $klaim_poin;
						Execute("INSERT INTO kartupoin (id_pelanggan, kode_penjualan, tgl, masuk, keluar, saldo_poin, id_klinik) VALUES ('".$idpelanggan."', '".$kode_penjualan."', '".$tanggal."', '0', '".$klaim_poin."','".$saldo_poin_klaim."', '".$id_klinik."')");
						Execute("UPDATE m_member SET poin_member=$saldo_poin_klaim WHERE id_pelanggan='$idpelanggan'");
						$poin_saat_ini = $saldo_poin_klaim + floor($perhitungan);
						Execute("INSERT INTO kartupoin (id_pelanggan, kode_penjualan, tgl, masuk, keluar, saldo_poin, id_klinik) VALUES ('".$idpelanggan."', '".$kode_penjualan."', '".$tanggal."', '".floor($perhitungan)."', '0','".$poin_saat_ini."', '".$id_klinik."')");
						Execute("UPDATE m_member SET poin_member=$poin_saat_ini WHERE id_pelanggan='$idpelanggan'");
					} else {
						$poin_saat_ini = $poinsebelumnya + floor($perhitungan);
						Execute("INSERT INTO kartupoin (id_pelanggan, kode_penjualan, tgl, masuk, keluar, saldo_poin, id_klinik) VALUES ('".$idpelanggan."', '".$kode_penjualan."', '".$tanggal."', '".floor($perhitungan)."', '0','".$poin_saat_ini."', '".$id_klinik."')");
						Execute("UPDATE m_member SET poin_member=$poin_saat_ini WHERE id_pelanggan='$idpelanggan'");
					}
				}
			}

			// KOMISI PEGAWAI KINERJA
			$sales = $rsnew['sales'];
			$dok_be_wajah = $rsnew['dok_be_wajah'];
			$be_body = $rsnew['be_body'];
			$medis = $rsnew['medis'];
			$dokter = $rsnew['dokter'];
			$idpenjualan = $rsnew['id'];
			$waktu = $rsnew['waktu'];
			$kode_penjualan = $rsnew['kode_penjualan'];
			$date = date("Y-m-d");
			$qty = ExecuteScalar("SELECT SUM(qty) AS qty FROM detailpenjualan WHERE id_penjualan='$idpenjualan'");

			//KOMISI KINERJA SALES
			if($sales != "") {
				$JabatanSales = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai='$sales'");					
				$sql_sales = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
					if($sql_sales -> RecordCount() > 0){
						$sql_sales->MoveFirst();
						while(!$sql_sales->EOF) {
							$id_barang_penjualan = $sql_sales->fields['id_barang'];
							$subtotal_penjualan = $sql_sales->fields['subtotal'];

							//$harga_jual = $sql_sales->fields['harga_jual'];
							$qty_penjualan = $sql_sales->fields['qty'];
							$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

							//$KomisiPegawaiSales = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$sales'");
							$BarangKomisiSales = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
							$qtyBarangKomisiSales = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiSales' AND id_penjualan = '$idpenjualan'");
							if($BarangKomisiSales != ""){
								$TargetBarangSales = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$TglAwalSales = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$TglAkhirSales = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

								//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
								$JmlPenjualanSales = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.sales = '$sales' AND (penjualan.waktu BETWEEN '$TglAwalSales' AND '$TglAkhirSales')");
								if($JmlPenjualanSales >= $TargetBarangSales){
									$KomisiTargetRpSales = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									$KomisiTargetPrSales = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpSales != "" && $KomisiTargetRpSales != "0"){
											$JmlKomisiTargetRpSales = $KomisiTargetRpSales * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpSales', '$JmlKomisiTargetRpSales')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$sales'");
										}
										if($KomisiTargetPrSales != "" && $KomisiTargetPrSales != "0"){
											$JmlKomisiTargetPrSales = (($KomisiTargetPrSales / 100) * $subtotal_satuan);
											$total_komisi_target_sales = $JmlKomisiTargetPrSales * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrSales', '$total_komisi_target_sales')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrSales WHERE id_pegawai='$sales'");
										}						

									// Get Transaksi Komisi Sales
									$sql_transaksi_komisi_sales = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiSales' AND id_pegawai = '$sales' AND id_jabatan = '$JabatanSales' AND (tgl BETWEEN '$TglAwalSales' AND '$TglAkhirSales') AND jenis_komisi='Kinerja'");

										// If Transaksi Komisi Sales != NULL
										if($sql_transaksi_komisi_sales != NULL OR $sql_transaksi_komisi_sales != FALSE){
											if($sql_transaksi_komisi_sales -> RecordCount() > 0){
												$sql_transaksi_komisi_sales->MoveFirst();
												while(!$sql_transaksi_komisi_sales->EOF) {
													$id_transaksi = $sql_transaksi_komisi_sales->fields['id'];
													$id_pegawai_transaksi = $sql_transaksi_komisi_sales->fields['id_pegawai'];
													$id_jabatan_transaksi = $sql_transaksi_komisi_sales->fields['id_jabatan'];
													$kode_penjualan = $sql_transaksi_komisi_sales->fields['kode_penjualan'];
													$id_barang_transaksi = $sql_transaksi_komisi_sales->fields['id_barang'];
													$subtotal_transaksi = $sql_transaksi_komisi_sales->fields['subtotal'];
													$qty_transaksi = $sql_transaksi_komisi_sales->fields['qty'];
													$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
													var_dump($harga_jual_transaksi);

														// If Komisi Target Rupiah != 0
														if($KomisiTargetRpSales != "" && $KomisiTargetRpSales != "0"){

															// Insert into transaksi komisi
															//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpSales', '$KomisiTargetRpSales')");

															$JmlKomisiTargetRpSales = $KomisiTargetRpSales * $qty_transaksi;

															// Update data sebelumnya
															Execute("UPDATE transaksi_komisi SET komisi='$KomisiTargetRpSales', total_komisi='$JmlKomisiTargetRpSales' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$sales'");
														}

														// If Komisi Target Persen != 0
														if($KomisiTargetPrSales != "" && $KomisiTargetPrSales != "0"){
															$JmlKomisiTargetPrSales = (($KomisiTargetPrSales / 100) * $harga_jual_transaksi);
															$total_komisi_target_sales = $JmlKomisiTargetPrSales * $qty_transaksi;
															Execute("UPDATE transaksi_komisi SET komisi='$JmlKomisiTargetPrSales', total_komisi='$total_komisi_target_sales' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrSales WHERE id_pegawai='$sales'");
														}
												$sql_transaksi_komisi_sales->MoveNext();
												}
											$sql_transaksi_komisi_sales->Close();	
											}
										} else {
											$KomisiTargetRpSales = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											$KomisiTargetPrSales = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											if($KomisiTargetRpSales != "" && $KomisiTargetRpSales != "0"){
												$JmlKomisiTargetRpSales =  $KomisiTargetRpSales * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpSales', '$JmlKomisiTargetRpSales')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$sales'");
											}
											if($KomisiTargetPrSales != "" && $KomisiTargetPrSales != "0"){
												$JmlKomisiTargetPrSales = (($KomisiTargetPrSales / 100) * $subtotal_satuan);
												$total_komisi_target_sales = $JmlKomisiTargetPrSales * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrSales', '$total_komisi_target_sales')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrSales WHERE id_pegawai='$sales'");
											}
										}
								} else {
									$KomisiDefaultRpSales = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									$KomisiDefaultPrSales = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiDefaultRpSales != "" && $KomisiDefaultRpSales != "0"){
										$JmlKomisiDefaultRpSales = $KomisiDefaultRpSales * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpSales', '$JmlKomisiDefaultRpSales')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpSales WHERE id_pegawai='$sales'");	
									}
									if($KomisiDefaultPrSales != "" && $KomisiDefaultPrSales != "0"){
										$JmlKomisiDefaultPrSales = (($KomisiDefaultPrSales / 100) * $subtotal_satuan);
										$total_komisi_default_sales = $JmlKomisiDefaultPrSales * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrSales', '$total_komisi_default_sales')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrSales WHERE id_pegawai='$sales'");
									}
								}
							}
						$sql_sales->MoveNext();	
						}
					$sql_sales->Close();
					}
			}

			//KOMISI KINERJA BE WAJAH
			if($dok_be_wajah != "") {
			$JabatanDokBeWajah = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai='$dok_be_wajah'");
			$sql_dok_be_wajah = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_dok_be_wajah -> RecordCount() > 0){
					$sql_dok_be_wajah->MoveFirst();
					while(!$sql_dok_be_wajah->EOF) {
						$id_barang_penjualan = $sql_dok_be_wajah->fields['id_barang'];
						$subtotal_penjualan = $sql_dok_be_wajah->fields['subtotal'];

						//$harga_jual = $sql_dok_be_wajah->fields['harga_jual'];
						$qty_penjualan = $sql_sales->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiDokBeWajah = ExecuteScalar("SELECT nilai_komisi FROM m_pegawai WHERE id_pegawai='$dok_be_wajah'");
						$BarangKomisiDokBeWajah = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiDokBeWajah = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiDokBeWajah' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiDokBeWajah != ""){
							$TargetBarangDokBeWajah = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalDokBeWajah = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirDokBeWajah = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanDokBeWajah = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.dok_be_wajah = '$dok_be_wajah' AND (penjualan.waktu BETWEEN '$TglAwalDokBeWajah' AND '$TglAkhirDokBeWajah')");                    
							if($JmlPenjualanDokBeWajah >= $TargetBarangDokBeWajah){
								$KomisiTargetRpDokBeWajah = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrDokBeWajah = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiTargetRpDokBeWajah != "" && $KomisiTargetRpDokBeWajah != "0"){
									$JmlKomisiTargetRpDokBeWajah = $KomisiTargetRpDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokBeWajah', '$JmlKomisiTargetRpDokBeWajah')");
								}
								if($KomisiTargetPrDokBeWajah != "" && $KomisiTargetPrDokBeWajah != "0"){
									$JmlKomisiTargetPrDokBeWajah = (($KomisiTargetPrDokBeWajah / 100) * $subtotal_satuan);
									$total_komisi_target_dok_be_wajah = $JmlKomisiTargetPrDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokBeWajah', '$total_komisi_target_dok_be_wajah')");
								}
								$sql_transaksi_komisi_dok_be_wajah = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiDokBeWajah' AND id_pegawai = '$dok_be_wajah' AND id_jabatan = '$JabatanDokBeWajah' AND (tgl BETWEEN '$TglAwalDokBeWajah' AND '$TglAkhirDokBeWajah') AND jenis_komisi='Kinerja'");

										// If Transaksi Komisi dok_be_wajah != NULL
										if($sql_transaksi_komisi_dok_be_wajah != NULL OR $sql_transaksi_komisi_dok_be_wajah != FALSE){
											if($sql_transaksi_komisi_dok_be_wajah -> RecordCount() > 0){
												$sql_transaksi_komisi_dok_be_wajah->MoveFirst();
												while(!$sql_transaksi_komisi_dok_be_wajah->EOF) {
													$id_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id'];
													$id_pegawai_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id_pegawai'];
													$id_jabatan_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id_jabatan'];
													$kode_penjualan = $sql_transaksi_komisi_dok_be_wajah->fields['kode_penjualan'];
													$id_barang_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id_barang'];
													$subtotal_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['subtotal'];
													$qty_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['qty'];
													$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
													var_dump($harga_jual_transaksi);

														// If Komisi Target Rupiah != 0
														if($KomisiTargetRpDokBeWajah != "" && $KomisiTargetRpDokBeWajah != "0"){

															// Insert into transaksi komisi
															//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$Jabatandok_be_wajah', '$BarangKomisidok_be_wajah', '$qtyBarangKomisidok_be_wajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokBeWajah', '$KomisiTargetRpDokBeWajah')");

															$JmlKomisiTargetRpDokBeWajah = $KomisiTargetRpDokBeWajah * $qty_transaksi;

															// Update data sebelumnya
															Execute("UPDATE transaksi_komisi SET komisi='$KomisiTargetRpDokBeWajah', total_komisi='$JmlKomisiTargetRpDokBeWajah' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
														}

														// If Komisi Target Persen != 0
														if($KomisiTargetPrDokBeWajah != "" && $KomisiTargetPrDokBeWajah != "0"){
															$JmlKomisiTargetPrDokBeWajah = (($KomisiTargetPrDokBeWajah / 100) * $harga_jual_transaksi);
															$total_komisi_target_dok_be_wajah = $JmlKomisiTargetPrDokBeWajah * $qty_transaksi;
															Execute("UPDATE transaksi_komisi SET komisi='$JmlKomisiTargetPrDokBeWajah', total_komisi='$total_komisi_target_dok_be_wajah' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
														}
												$sql_transaksi_komisi_dok_be_wajah->MoveNext();
												}
											$sql_transaksi_komisi_dok_be_wajah->Close();	
											}
										} else {
											$KomisiTargetRpDokBeWajah = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$Jabatandok_be_wajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											$KomisiTargetPrDokBeWajah = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$Jabatandok_be_wajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											if($KomisiTargetRpDokBeWajah != "" && $KomisiTargetRpDokBeWajah != "0"){
												$JmlKomisiTargetRpDokBeWajah =  $KomisiTargetRpDokBeWajah * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$Jabatandok_be_wajah', '$BarangKomisidok_be_wajah', '$qtyBarangKomisidok_be_wajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokBeWajah', '$JmlKomisiTargetRpDokBeWajah')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
											}
											if($KomisiTargetPrDokBeWajah != "" && $KomisiTargetPrDokBeWajah != "0"){
												$JmlKomisiTargetPrDokBeWajah = (($KomisiTargetPrDokBeWajah / 100) * $subtotal_satuan);
												$total_komisi_target_dok_be_wajah = $JmlKomisiTargetPrDokBeWajah * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$Jabatandok_be_wajah', '$BarangKomisidok_be_wajah', '$qtyBarangKomisidok_be_wajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokBeWajah', '$total_komisi_target_dok_be_wajah')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
											}
										}
							} else {
								$KomisiDefaultRpDokBeWajah = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrDokBeWajah = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpDokBeWajah != "" && $KomisiDefaultRpDokBeWajah != "0"){
									$JmlKomisiDefaultRpDokBeWajah =  $KomisiDefaultRpDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpDokBeWajah', '$JmlKomisiDefaultRpDokBeWajah')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpDokBeWajah WHERE id_pegawai='$dok_be_wajah'");	
								}
								if($KomisiDefaultPrDokBeWajah != "" && $KomisiDefaultPrDokBeWajah != "0"){
									$JmlKomisiDefaultPrDokBeWajah = (($KomisiDefaultPrDokBeWajah / 100) * $subtotal_satuan);
									$total_komisi_default_dok_be_wajah = $JmlKomisiDefaultPrDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrDokBeWajah', '$total_komisi_default_dok_be_wajah')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
								}
							}
						}
					$sql_dok_be_wajah->MoveNext();	
					}
				$sql_dok_be_wajah->Close();
				}
			}

			// KOMISI KINERJA BE BODY	
			if($be_body != "") {
			$JabatanBeBody = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai='$be_body'");
			$sql_be_body = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_be_body -> RecordCount() > 0){
					$sql_be_body->MoveFirst();
					while(!$sql_be_body->EOF) {
						$id_barang_penjualan = $sql_be_body->fields['id_barang'];
						$subtotal_penjualan = $sql_be_body->fields['subtotal'];

						//$harga_jual = $sql_be_body->fields['harga_jual'];
						$qty_penjualan = $sql_be_body->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiBe Body = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$be_body'");
						$BarangKomisiBeBody = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiBeBody = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiBeBody' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiBeBody != ""){
							$TargetBarangBeBody = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalBeBody = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirBeBody = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanBeBody = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.be_body = '$be_body' AND (penjualan.waktu BETWEEN '$TglAwalBeBody' AND '$TglAkhirBeBody')");
							if($JmlPenjualanBeBody >= $TargetBarangBeBody){
								$KomisiTargetRpBeBody = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrBeBody = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiTargetRpBeBody != "" && $KomisiTargetRpBeBody != "0"){
										$JmlKomisiTargetRpBeBody = $KomisiTargetRpBeBody * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpBeBody', '$JmlKomisiTargetRpBeBody')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$be_body'");
									}
									if($KomisiTargetPrBeBody != "" && $KomisiTargetPrBeBody != "0"){
										$JmlKomisiTargetPrBeBody = (($KomisiTargetPrBeBody / 100) * $subtotal_satuan);
										$total_komisi_target_be_body = $JmlKomisiTargetPrBeBody * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrBeBody', '$total_komisi_target_be_body')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrBeBody WHERE id_pegawai='$be_body'");
									}						

								// Get Transaksi Komisi Be Body
								$sql_transaksi_komisi_be_body = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiBeBody' AND id_pegawai = '$be_body' AND id_jabatan = '$JabatanBeBody' AND (tgl BETWEEN '$TglAwalBeBody' AND '$TglAkhirBeBody') AND jenis_komisi='Kinerja'");

									// If Transaksi Komisi Be Body != NULL
									if($sql_transaksi_komisi_be_body != NULL OR $sql_transaksi_komisi_be_body != FALSE){
										if($sql_transaksi_komisi_be_body -> RecordCount() > 0){
											$sql_transaksi_komisi_be_body->MoveFirst();
											while(!$sql_transaksi_komisi_be_body->EOF) {
												$id_transaksi = $sql_transaksi_komisi_be_body->fields['id'];
												$id_pegawai_transaksi = $sql_transaksi_komisi_be_body->fields['id_pegawai'];
												$id_jabatan_transaksi = $sql_transaksi_komisi_be_body->fields['id_jabatan'];
												$kode_penjualan = $sql_transaksi_komisi_be_body->fields['kode_penjualan'];
												$id_barang_transaksi = $sql_transaksi_komisi_be_body->fields['id_barang'];
												$subtotal_transaksi = $sql_transaksi_komisi_be_body->fields['subtotal'];
												$qty_transaksi = $sql_transaksi_komisi_be_body->fields['qty'];
												$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
												var_dump($harga_jual_transaksi);

													// If Komisi Target Rupiah != 0
													if($KomisiTargetRpBeBody != "" && $KomisiTargetRpBeBody != "0"){

														// Insert into transaksi komisi
														//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpBeBody', '$KomisiTargetRpBeBody')");

														$JmlKomisiTargetRpBeBody = $KomisiTargetRpBeBody * $qty_transaksi;

														// Update data sebelumnya
														Execute("UPDATE transaksi_komisi SET komisi='$KomisiTargetRpBeBody', total_komisi='$JmlKomisiTargetRpBeBody' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$be_body'");
													}

													// If Komisi Target Persen != 0
													if($KomisiTargetPrBeBody != "" && $KomisiTargetPrBeBody != "0"){
														$JmlKomisiTargetPrBeBody = (($KomisiTargetPrBeBody / 100) * $harga_jual_transaksi);
														$total_komisi_target_be_body = $JmlKomisiTargetPrBeBody * $qty_transaksi;
														Execute("UPDATE transaksi_komisi SET komisi='$JmlKomisiTargetPrBeBody', total_komisi='$total_komisi_target_be_body' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrBeBody WHERE id_pegawai='$be_body'");
													}
											$sql_transaksi_komisi_be_body->MoveNext();
											}
										$sql_transaksi_komisi_be_body->Close();	
										}
									} else {
										$KomisiTargetRpBeBody = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										$KomisiTargetPrBeBody = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpBeBody != "" && $KomisiTargetRpBeBody != "0"){
											$JmlKomisiTargetRpBeBody =  $KomisiTargetRpBeBody * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpBeBody', '$JmlKomisiTargetRpBeBody')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$be_body'");
										}
										if($KomisiTargetPrBeBody != "" && $KomisiTargetPrBeBody != "0"){
											$JmlKomisiTargetPrBeBody = (($KomisiTargetPrBeBody / 100) * $subtotal_satuan);
											$total_komisi_target_be_body = $JmlKomisiTargetPrBeBody * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrBeBody', '$total_komisi_target_be_body')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrBeBody WHERE id_pegawai='$be_body'");
										}
									}
							} else {
								$KomisiDefaultRpBeBody = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrBeBody = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpBeBody != "" && $KomisiDefaultRpBeBody != "0"){
									$JmlKomisiDefaultRpBeBody = $KomisiDefaultRpBeBody * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpBeBody', '$JmlKomisiDefaultRpBeBody')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpBeBody WHERE id_pegawai='$be_body'");	
								}
								if($KomisiDefaultPrBeBody != "" && $KomisiDefaultPrBeBody != "0"){
									$JmlKomisiDefaultPrBeBody = (($KomisiDefaultPrBeBody / 100) * $subtotal_satuan);
									$total_komisi_default_be_body = $JmlKomisiDefaultPrBeBody * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrBeBody', '$total_komisi_default_be_body')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrBeBody WHERE id_pegawai='$be_body'");
								}
							}
						}
					$sql_be_body->MoveNext();	
					}
				$sql_be_body->Close();
				}
			}

			//KOMISI KINERJA MEDIS
			if($medis != "") {
			$JabatanMedis = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai='$medis'");
			$sql_medis = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_medis -> RecordCount() > 0){
					$sql_medis->MoveFirst();
					while(!$sql_medis->EOF) {
						$id_barang_penjualan = $sql_medis->fields['id_barang'];
						$subtotal_penjualan = $sql_medis->fields['subtotal'];

						//$harga_jual = $sql_medis->fields['harga_jual'];
						$qty_penjualan = $sql_medis->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiBe Body = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$medis'");
						$BarangKomisiMedis = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiMedis = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiMedis' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiMedis != ""){ 
							$TargetBarangMedis = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalMedis = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirMedis = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanMedis = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.medis = '$medis' AND (penjualan.waktu BETWEEN '$TglAwalMedis' AND '$TglAkhirMedis')");
							if($JmlPenjualanMedis >= $TargetBarangMedis){
								$KomisiTargetRpMedis = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrMedis = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiTargetRpMedis != "" && $KomisiTargetRpMedis != "0"){
										$JmlKomisiTargetRpMedis = $KomisiTargetRpMedis * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpMedis', '$JmlKomisiTargetRpMedis')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$medis'");
									}
									if($KomisiTargetPrMedis != "" && $KomisiTargetPrMedis != "0"){
										$JmlKomisiTargetPrMedis = (($KomisiTargetPrMedis / 100) * $subtotal_satuan);
										$total_komisi_target_medis = $JmlKomisiTargetPrMedis * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrMedis', '$total_komisi_target_medis')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrMedis WHERE id_pegawai='$medis'");
									}						

								// Get Transaksi Komisi Be Body
								$sql_transaksi_komisi_medis = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiMedis' AND id_pegawai = '$medis' AND id_jabatan = '$JabatanMedis' AND (tgl BETWEEN '$TglAwalMedis' AND '$TglAkhirMedis') AND jenis_komisi='Kinerja'");

									// If Transaksi Komisi Be Body != NULL
									if($sql_transaksi_komisi_medis != NULL OR $sql_transaksi_komisi_medis != FALSE){
										if($sql_transaksi_komisi_medis -> RecordCount() > 0){
											$sql_transaksi_komisi_medis->MoveFirst();
											while(!$sql_transaksi_komisi_medis->EOF) {
												$id_transaksi = $sql_transaksi_komisi_medis->fields['id'];
												$id_pegawai_transaksi = $sql_transaksi_komisi_medis->fields['id_pegawai'];
												$id_jabatan_transaksi = $sql_transaksi_komisi_medis->fields['id_jabatan'];
												$kode_penjualan = $sql_transaksi_komisi_medis->fields['kode_penjualan'];
												$id_barang_transaksi = $sql_transaksi_komisi_medis->fields['id_barang'];
												$subtotal_transaksi = $sql_transaksi_komisi_medis->fields['subtotal'];
												$qty_transaksi = $sql_transaksi_komisi_medis->fields['qty'];
												$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
												var_dump($harga_jual_transaksi);

													// If Komisi Target Rupiah != 0
													if($KomisiTargetRpMedis != "" && $KomisiTargetRpMedis != "0"){

														// Insert into transaksi komisi
														//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpMedis', '$KomisiTargetRpMedis')");

														$JmlKomisiTargetRpMedis = $KomisiTargetRpMedis * $qty_transaksi;

														// Update data sebelumnya
														Execute("UPDATE transaksi_komisi SET komisi='$KomisiTargetRpMedis', total_komisi='$JmlKomisiTargetRpMedis' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$medis'");
													}

													// If Komisi Target Persen != 0
													if($KomisiTargetPrMedis != "" && $KomisiTargetPrMedis != "0"){
														$JmlKomisiTargetPrMedis = (($KomisiTargetPrMedis / 100) * $harga_jual_transaksi);
														$total_komisi_target_medis = $JmlKomisiTargetPrMedis * $qty_transaksi;
														Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrMedis, total_komisi=$total_komisi_target_medis WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrMedis WHERE id_pegawai='$medis'");
													}
											$sql_transaksi_komisi_medis->MoveNext();
											}
										$sql_transaksi_komisi_medis->Close();	
										}
									} else {
										$KomisiTargetRpMedis = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										$KomisiTargetPrMedis = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpMedis != "" && $KomisiTargetRpMedis != "0"){
											$JmlKomisiTargetRpMedis =  $KomisiTargetRpMedis * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpMedis', '$JmlKomisiTargetRpMedis')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$medis'");
										}
										if($KomisiTargetPrMedis != "" && $KomisiTargetPrMedis != "0"){
											$JmlKomisiTargetPrMedis = (($KomisiTargetPrMedis / 100) * $subtotal_satuan);
											$total_komisi_target_medis = $JmlKomisiTargetPrMedis * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrMedis', '$total_komisi_target_medis')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrMedis WHERE id_pegawai='$medis'");
										}
									}
							} else {
								$KomisiDefaultRpMedis = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrMedis = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpMedis != "" && $KomisiDefaultRpMedis != "0"){
									$JmlKomisiDefaultRpMedis = $KomisiDefaultRpMedis * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpMedis', '$JmlKomisiDefaultRpMedis')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpMedis WHERE id_pegawai='$medis'");	
								}
								if($KomisiDefaultPrMedis != "" && $KomisiDefaultPrMedis != "0"){
									$JmlKomisiDefaultPrMedis = (($KomisiDefaultPrMedis / 100) * $subtotal_satuan);
									$total_komisi_default_medis = $JmlKomisiDefaultPrMedis * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrMedis', '$total_komisi_default_medis')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrMedis WHERE id_pegawai='$medis'");
								}
							}
						}
					$sql_medis->MoveNext();	
					}
				$sql_medis->Close();
				}
			}

			//KOMISI KINERJA DOKTER
			if($dokter != "") {
			$JabatanDokter = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai='$dokter'");
			$sql_dokter = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_dokter -> RecordCount() > 0){
					$sql_dokter->MoveFirst();
					while(!$sql_dokter->EOF) {
						$id_barang_penjualan = $sql_dokter->fields['id_barang'];
						$subtotal_penjualan = $sql_dokter->fields['subtotal'];

						//$harga_jual = $sql_dokter->fields['harga_jual'];
						$qty_penjualan = $sql_dokter->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiBe Body = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$dokter'");
						$BarangKomisiDokter = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiDokter = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiDokter' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiDokter != ""){  
							$TargetBarangDokter = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalDokter = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirDokter = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanDokter = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.dokter = '$dokter' AND (penjualan.waktu BETWEEN '$TglAwalDokter' AND '$TglAkhirDokter')");
							if($JmlPenjualanDokter >= $TargetBarangDokter){
								$KomisiTargetRpDokter = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrDokter = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiTargetRpDokter != "" && $KomisiTargetRpDokter != "0"){
										$JmlKomisiTargetRpDokter = $KomisiTargetRpDokter * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokter', '$JmlKomisiTargetRpDokter')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
									}
									if($KomisiTargetPrDokter != "" && $KomisiTargetPrDokter != "0"){
										$JmlKomisiTargetPrDokter = (($KomisiTargetPrDokter / 100) * $subtotal_satuan);
										$total_komisi_target_dokter = $JmlKomisiTargetPrDokter * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokter', '$total_komisi_target_dokter')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
									}						

								// Get Transaksi Komisi Be Body
								$sql_transaksi_komisi_dokter = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiDokter' AND id_pegawai = '$dokter' AND id_jabatan = '$JabatanDokter' AND (tgl BETWEEN '$TglAwalDokter' AND '$TglAkhirDokter') AND jenis_komisi='Kinerja'");

									// If Transaksi Komisi Be Body != NULL
									if($sql_transaksi_komisi_dokter != NULL OR $sql_transaksi_komisi_dokter != FALSE){
										if($sql_transaksi_komisi_dokter -> RecordCount() > 0){
											$sql_transaksi_komisi_dokter->MoveFirst();
											while(!$sql_transaksi_komisi_dokter->EOF) {
												$id_transaksi = $sql_transaksi_komisi_dokter->fields['id'];
												$id_pegawai_transaksi = $sql_transaksi_komisi_dokter->fields['id_pegawai'];
												$id_jabatan_transaksi = $sql_transaksi_komisi_dokter->fields['id_jabatan'];
												$kode_penjualan = $sql_transaksi_komisi_dokter->fields['kode_penjualan'];
												$id_barang_transaksi = $sql_transaksi_komisi_dokter->fields['id_barang'];
												$subtotal_transaksi = $sql_transaksi_komisi_dokter->fields['subtotal'];
												$qty_transaksi = $sql_transaksi_komisi_dokter->fields['qty'];
												$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
												var_dump($harga_jual_transaksi);

													// If Komisi Target Rupiah != 0
													if($KomisiTargetRpDokter != "" && $KomisiTargetRpDokter != "0"){

														// Insert into transaksi komisi
														//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokter', '$KomisiTargetRpDokter')");

														$JmlKomisiTargetRpDokter = $KomisiTargetRpDokter * $qty_transaksi;

														// Update data sebelumnya
														Execute("UPDATE transaksi_komisi SET komisi='$KomisiTargetRpDokter', total_komisi='$JmlKomisiTargetRpDokter' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
													}

													// If Komisi Target Persen != 0
													if($KomisiTargetPrDokter != "" && $KomisiTargetPrDokter != "0"){
														$JmlKomisiTargetPrDokter = (($KomisiTargetPrDokter / 100) * $harga_jual_transaksi);
														$total_komisi_target_dokter = $JmlKomisiTargetPrDokter * $qty_transaksi;
														Execute("UPDATE transaksi_komisi SET komisi='$JmlKomisiTargetPrDokter', total_komisi='$total_komisi_target_dokter' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
													}
											$sql_transaksi_komisi_dokter->MoveNext();
											}
										$sql_transaksi_komisi_dokter->Close();	
										}
									} else {
										$KomisiTargetRpDokter = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										$KomisiTargetPrDokter = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpDokter != "" && $KomisiTargetRpDokter != "0"){
											$JmlKomisiTargetRpDokter =  $KomisiTargetRpDokter * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokter', '$JmlKomisiTargetRpDokter')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
										}
										if($KomisiTargetPrDokter != "" && $KomisiTargetPrDokter != "0"){
											$JmlKomisiTargetPrDokter = (($KomisiTargetPrDokter / 100) * $subtotal_satuan);
											$total_komisi_target_dokter = $JmlKomisiTargetPrDokter * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokter', '$total_komisi_target_dokter')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
										}
									}
							} else {
								$KomisiDefaultRpDokter = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrDokter = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpDokter != "" && $KomisiDefaultRpDokter != "0"){
									$JmlKomisiDefaultRpDokter = $KomisiDefaultRpDokter * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpDokter', '$JmlKomisiDefaultRpDokter')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpDokter WHERE id_pegawai='$dokter'");	
								}
								if($KomisiDefaultPrDokter != "" && $KomisiDefaultPrDokter != "0"){
									$JmlKomisiDefaultPrDokter = (($KomisiDefaultPrDokter / 100) * $subtotal_satuan);
									$total_komisi_default_dokter = $JmlKomisiDefaultPrDokter * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrDokter', '$total_komisi_default_dokter')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrDokter WHERE id_pegawai='$dokter'");
								}
							}
						}
					$sql_dokter->MoveNext();	
					}
				$sql_dokter->Close();
				}
			}

			// KOMISI PEGAWAI RECALL
			$sql_komisi_recall = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
					if($sql_komisi_recall -> RecordCount() > 0){
						$sql_komisi_recall->MoveFirst();
						while(!$sql_komisi_recall->EOF) {
							$id_barang_penjualan = $sql_komisi_recall->fields['id_barang'];
							$id_pegawai_recall = $sql_komisi_recall->fields['komisi_recall'];
							$qty_penjualan = $sql_komisi_recall->fields['qty'];
							$subtotal_penjualan = $sql_komisi_recall->fields['subtotal'];
							$harga_jual = $sql_komisi_recall->fields['harga_jual'];
							if($id_pegawai_recall != ''){
								$JabatanPegawai = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai='$id_pegawai_recall'");
								$BarangKomisiRecall = ExecuteScalar("SELECT id_barang FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi_recall_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
								$TglAwalRecall = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$TglAkhirRecall = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($BarangKomisiRecall != '') {
									$TargetBarangRecall = ExecuteScalar("SELECT target FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
									$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
									$JmlPenjualan = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND detailpenjualan.komisi_recall = '$id_pegawai_recall' AND (penjualan.waktu BETWEEN '$Periode' AND '$date')");
										if($JmlPenjualan >= $TargetBarangRecall) {
											$KomisiTargetRpRecall = ExecuteScalar("SELECT recall_target_rupiah FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
											$KomisiTargetPrRecall = ExecuteScalar("SELECT recall_target_persen FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");									
												if($KomisiTargetRpRecall != "" && $KomisiTargetRpRecall != "0"){
													$total_komisi_target_rp = $KomisiTargetRpRecall * $qty_penjualan;
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$KomisiTargetRpRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_rp')");								

													//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
												}
												if($KomisiTargetPrRecall != "" && $KomisiTargetPrRecall != "0"){
													$JmlKomisiTargetPrRecall = (($KomisiTargetPrRecall / 100) * $harga_jual);
													$total_komisi_target_pr = (($KomisiTargetPrRecall / 100) * $subtotal_penjualan);
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_pr')");								

													//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
												}

												// Get Transaksi Komisi Recall
												$sql_transaksi_komisi_recall = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiRecall' AND id_pegawai = '$id_pegawai_recall' AND id_jabatan = '$JabatanPegawai' AND (tgl BETWEEN '$TglAwalRecall' AND '$TglAkhirRecall') AND jenis_komisi='Recall'");

													// If Transaksi Komisi Be Body != NULL
													if($sql_transaksi_komisi_recall != NULL OR $sql_transaksi_komisi_recall != FALSE) {
														if($sql_transaksi_komisi_recall -> RecordCount() > 0){
															$sql_transaksi_komisi_recall->MoveFirst();
															while(!$sql_transaksi_komisi_recall->EOF) {
																$id_transaksi = $sql_transaksi_komisi_recall->fields['id'];
																$id_pegawai_transaksi = $sql_transaksi_komisi_recall->fields['id_pegawai'];
																$id_jabatan_transaksi = $sql_transaksi_komisi_recall->fields['id_jabatan'];
																$kode_penjualan = $sql_transaksi_komisi_recall->fields['kode_penjualan'];
																$id_barang_transaksi = $sql_transaksi_komisi_recall->fields['id_barang'];
																$subtotal_transaksi = $sql_transaksi_komisi_recall->fields['subtotal'];
																$qty_transaksi = $sql_transaksi_komisi_recall->fields['qty'];
																$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
																var_dump($harga_jual_transaksi);

																	// If Komisi Target Rupiah != 0
																	if($KomisiTargetRpRecall != "" && $KomisiTargetRpRecall != "0"){
																		$JmlKomisiTargetRpRecall = $KomisiTargetRpRecall * $qty_transaksi;

																		// Update data sebelumnya
																		Execute("UPDATE transaksi_komisi SET komisi='$KomisiTargetRpRecall', total_komisi='$JmlKomisiTargetRpRecall' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													
																	}

																	// If Komisi Target Persen != 0
																	if($KomisiTargetPrRecall != "" && $KomisiTargetPrRecall != "0"){
																		$JmlKomisiTargetPrRecall = (($KomisiTargetPrRecall / 100) * $harga_jual_transaksi);
																		$total_komisi_target_recall = $JmlKomisiTargetPrRecall * $qty_transaksi;
																		Execute("UPDATE transaksi_komisi SET komisi='$JmlKomisiTargetPrRecall', total_komisi='$total_komisi_target_recall' WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													
																	}
															$sql_transaksi_komisi_recall->MoveNext();
															}
														$sql_transaksi_komisi_recall->Close();	
														}
													} else {
															$KomisiTargetRpRecall = ExecuteScalar("SELECT recall_target_rupiah FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
															$KomisiTargetPrRecall = ExecuteScalar("SELECT recall_target_persen FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");									
																if($KomisiTargetRpRecall != "" && $KomisiTargetRpRecall != "0"){
																	$total_komisi_target_rp = $KomisiTargetRpRecall * $qty_penjualan;
																	Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$KomisiTargetRpRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_rp')");								
																}
																if($KomisiTargetPrRecall != "" && $KomisiTargetPrRecall != "0"){
																	$JmlKomisiTargetPrRecall = (($KomisiTargetPrRecall / 100) * $harga_jual);
																	$total_komisi_target_pr = (($KomisiTargetPrRecall / 100) * $subtotal_penjualan);
																	Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_pr')");								
																}
													}
										} else {
											$KomisiDefaultRpRecall = ExecuteScalar("SELECT recall_default_rupiah FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
											$KomisiDefaultPrRecall = ExecuteScalar("SELECT recall_default_persen FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
												if($KomisiDefaultRpRecall != "" && $KomisiDefaultRpRecall != "0"){
													$total_komisi_default_rp = $KomisiDefaultRpRecall * $qty_penjualan;
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$KomisiDefaultRpRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_default_rp')");								
												}
												if($KomisiDefaultPrRecall != "" && $KomisiDefaultPrRecall != "0"){
													$JmlKomisiDefaultPrRecall = (($KomisiDefaultPrRecall / 100) * $harga_jual);
													$total_komisi_default_pr = (($KomisiDefaultPrRecall / 100) * $subtotal_penjualan);
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_default_pr')");								                                
												}
										}
								}
							}
						$sql_komisi_recall->MoveNext();	
						}
					$sql_komisi_recall->Close();
					}
			if($idpelanggan != FALSE) {

				//INSERT TGL AWAL TRANSAKSI && JML AKUMULASI
				$total_akumulasi = ExecuteScalar("SELECT total_akumulasi FROM m_member WHERE id_pelanggan='$idpelanggan'");
				$tglmulai = ExecuteScalar("SELECT tgl_mulai FROM m_member WHERE id_pelanggan='$idpelanggan'");
				if($total_akumulasi == '' OR $total_akumulasi == '0' OR $total_akumulasi == NULL){
					$tglawaltransaksi = ExecuteScalar("SELECT tgl_awal_transaksi FROM m_member WHERE id_pelanggan='$idpelanggan'");
						if($tglawaltransaksi == '') {
							$date = date("Y-m-d");
							date_default_timezone_set("Indonesia/Jakarta");
							$tgltransaksiawal = ExecuteScalar("SELECT waktu FROM penjualan WHERE waktu >= '$tglmulai' ORDER BY waktu ASC LIMIT 1");
							$jmlakumulasi = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_pelanggan='$idpelanggan' AND (waktu BETWEEN '$tgltransaksiawal' AND '$date')");
							Execute("UPDATE m_member SET tgl_awal_transaksi='$tgltransaksiawal', total_akumulasi='$jmlakumulasi' WHERE id_pelanggan='$idpelanggan'");
						}
				} else {
					$date = date("Y-m-d");
					$tgltransaksiawal = ExecuteScalar("SELECT waktu FROM penjualan WHERE waktu >= '$tglmulai' ORDER BY waktu ASC LIMIT 1");
					$jmlakumulasi = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_pelanggan='$idpelanggan' AND (waktu BETWEEN '$tgltransaksiawal' AND '$date')");
					Execute("UPDATE m_member SET total_akumulasi='$jmlakumulasi' WHERE id_pelanggan='$idpelanggan'");
				}

				//UPGRADE MEMBER
				$firstdate = date("Y-n-j", strtotime("first day of this month"));
				$lastdate = date("Y-n-j", strtotime("last day of this month"));
				$KedatanganBlnIni = ExecuteScalar("SELECT COUNT(id) FROM penjualan WHERE id_pelanggan = '$idpelanggan' AND (waktu BETWEEN '$firstdate' AND '$lastdate')");
				if($KedatanganBlnIni > '1') {
				} else {
					$firstdateprevmonth = date("Y-n-j", strtotime("first day of previous month"));
					$lastdateprevmonth = date("Y-n-j", strtotime("last day of previous month"));
					$KedatanganBlnLalu = ExecuteScalar("SELECT COUNT(id) FROM penjualan WHERE id_pelanggan = '$idpelanggan' AND (waktu BETWEEN '$firstdateprevmonth' AND '$lastdateprevmonth')");
					$min_kedatangan = ExecuteSCalar("SELECT min_kedatangan FROM m_jenis_member WHERE id_jenis_member='$jenismember'");
					if($KedatanganBlnLalu >= $min_kedatangan){
						$TglAwal = ExecuteScalar("SELECT tgl_awal_transaksi FROM m_member WHERE id_pelanggan='$idpelanggan'");
						$CountDay = ExecuteScalar("SELECT DATEDIFF('$date', '$TglAwal')");
						$JangkaWaktu = ExecuteScalar("SELECT jangka_waktu FROM m_jenis_member WHERE id_jenis_member='$jenismember'");
							if($CountDay >= $JangkaWaktu){
								$nominalbwh_reguler = ExecuteScalar("SELECT nominal_bawah FROM m_jenis_member WHERE nama_member='Reguler'");
								$nominalats_reguler = ExecuteScalar("SELECT nominal_atas FROM m_jenis_member WHERE nama_member='Reguler'");
								$nominalbwh_vip = ExecuteScalar("SELECT nominal_bawah FROM m_jenis_member WHERE nama_member='VIP'");
								$level_selanjutnya = ExecuteScalar("SELECT member_selanjutnya FROM m_jenis_member WHERE id_jenis_member='$jenismember'");
								$id_vvip = ExecuteScalar("SELECT id FROM m_jenis_member WHERE nama_member='VVIP'");
									if($total_akumulasi >= $nominalbwh_reguler || $total_akumulasi <= $nominalats_reguler) {
										Execute("UPDATE m_member SET jenis_member='$level_selanjutnya' WHERE id_pelanggan='$idpelanggan'");
									}
									if($total_akumulasi >= $nominalbwh_vip){
										Execute("UPDATE m_member SET jenis_member='$id_vvip' WHERE id_pelanggan='$idpelanggan'");
									}
							}
					}
				}
			}
			$tgl_terakhir_transaksi = date("Y-m-d H:i:s");
			Execute("UPDATE m_pelanggan SET tgl_terakhir_transaksi = '".$tgl_terakhir_transaksi."' WHERE id_pelanggan='".$id_pelanggan."'");
		} //End of if(status == printed)
		return TRUE;
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE
		// Action

		$action_date = date("d M Y");
		date_default_timezone_set("America/New_York");
		$user = CurrentUserInfo("id_pegawai");
		$pegawai = ExecuteScalar("SELECT nama_pegawai FROM m_pegawai WHERE id_pegawai='$user'");
		$status = $rsnew["status"];
		if($status == "Draft") {
			$rsnew["action"] = "Drafted by " .$pegawai. " at " .$action_date. " [". date("h:i"). "]";
		} else {
			$rsnew["action"] = "Created by " .$pegawai. " at " .$action_date. " [". date("h:i"). "]";
		}
		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
		$id_pelanggan = $rsnew['id_pelanggan'];
		$id_klinik = $rsnew['id_klinik'];
		$total = $rsnew['total'];
		$_SESSION["id_penjualan"] = $rsnew["id"];
		$id_penjualan = $rsold['id'];
		$kode_penjualan = $rsold['kode_penjualan'];

		//Update Kode Penjualan
		Execute("UPDATE penjualan SET kode_penjualan='$kode_penjualan' WHERE id = '$id_penjualan'");	
		$metode_pembayaran = $rsnew['metode_pembayaran'];
		$kartu = $rsnew['id_kartu'];
		$id_bankrekening = $rsnew['id_bank'];
		$id_kartubank = $rsnew['id_kartubank'];
		$id_kas = $rsnew['id_kas'];
		$charge = $rsnew['charge'];
		$nilai_charge = str_replace('.',',',$charge);
		$klinik = $rsnew['id_klinik'];
		$tanggal = $rsnew['waktu'];
		$jumlah = $rsnew['bayar'];
		$jumlah_non_tunai = $rsnew['bayar_non_tunai'];
		$total_non_tunai = $rsnew['total_non_tunai_charge'];
		$klaim_poin = $rsnew['klaim_poin'];
		$status = $rsnew['status'];
		$id_sebelumnya = ExecuteScalar("SELECT id FROM penggunaan_kartu ORDER BY id DESC LIMIT 1");
		$id_sekarang = $id_sebelumnya+1;
		$id_setelahnya = $id_sekarang+1;

		//var_dump($kode_penjualan); exit();
		if($status == 'Printed') { //begin of if(status == printed)

			//INSERTING KAS / REKENING
			if($metode_pembayaran == 'Debit' OR $metode_pembayaran == 'Kredit'){
				$jenis_kartu = ExecuteScalar("SELECT jenis FROM m_kartu WHERE id_kartu = '$id_kartubank'");
				$saldo_lama_bank = ExecuteScalar("SELECT saldo FROM m_rekening WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
				$saldo_baru_bank = $saldo_lama_bank + $total_non_tunai;
				Execute("INSERT INTO penggunaan_kartu (id_kartu, jenis_kartu, id_klinik, kode_penjualan, tgl, total, charge, total_charge) VALUES ('".$id_kartubank."', '".$jenis_kartu."', '".$id_klinik."', '".$kode_penjualan."', '".$tanggal."', '".$jumlah_non_tunai."', '".$nilai_charge."', '".$total_non_tunai."')");
				Execute("INSERT INTO laporan_rekening (id_rekening, id_klinik, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_bankrekening."', '".$id_klinik."', '".$kode_penjualan."', '".$saldo_lama_bank."','".$total_non_tunai."', '".$saldo_baru_bank."', '".$tanggal."')");
				Execute("UPDATE m_rekening SET saldo='$saldo_baru_bank' WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
			} else if($metode_pembayaran == 'Transfer'){
				$saldo_lama_bank = ExecuteScalar("SELECT saldo FROM m_rekening WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
				$saldo_baru_bank = $saldo_lama_bank + $total_non_tunai;
				Execute("INSERT INTO laporan_rekening (id_rekening, id_klinik, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_bankrekening."', '".$id_klinik."', '".$kode_penjualan."', '".$saldo_lama_bank."', '".$total_non_tunai."', '".$saldo_baru_bank."', '".$tanggal."')");
				Execute("UPDATE m_rekening SET saldo='$saldo_baru_bank' WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");		
			} else if($metode_pembayaran == 'Tunai-Debit' OR $metode_pembayaran == 'Tunai-Kredit'){
				$jenis_kartu = ExecuteScalar("SELECT jenis FROM m_kartu WHERE id_kartu = '$id_kartubank'");
				$saldo_lama_bank = ExecuteScalar("SELECT saldo FROM m_rekening WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");
				$saldo_baru_bank = $saldo_lama_bank + $total_non_tunai;
				Execute("INSERT INTO penggunaan_kartu (id_kartu, jenis_kartu, id_klinik, kode_penjualan, tgl, total, charge, total_charge) VALUES ('".$id_kartubank."', '".$jenis_kartu."', '".$id_klinik."', '".$kode_penjualan."', '".$tanggal."', '".$jumlah_non_tunai."', '".$nilai_charge."', '".$total_non_tunai."')");
				Execute("INSERT INTO laporan_rekening (id_rekening, id_klinik, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_bankrekening."', '".$id_klinik."', '".$kode_penjualan."', '".$saldo_lama_bank."', '".$total_non_tunai."', '".$saldo_baru_bank."', '".$tanggal."')");
				Execute("UPDATE m_rekening SET saldo='$saldo_baru_bank' WHERE id_rekening = '$id_bankrekening' AND id_klinik='$id_klinik'");		            
				$saldo_lama_kas = ExecuteScalar("SELECT saldo FROM m_kas WHERE id = '$id_kas' AND id_klinik='$id_klinik'");
				$saldo_baru_kas = $saldo_lama_kas + ($total - $total_non_tunai);
				$jumlah_tunai = $total - $total_non_tunai;
				Execute("INSERT INTO laporan_kas (id_klinik, id_kas, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_klinik."', '".$id_kas."', '".$kode_penjualan."', '".$saldo_lama_kas."', '".$jumlah_tunai."', '".$saldo_baru_kas."', '".$tanggal."')");
				Execute("UPDATE m_kas SET saldo='$saldo_baru_kas' WHERE id = '$id_kas' AND id_klinik='$id_klinik'");		
			} else if($metode_pembayaran == 'Tunai'){
				$saldo_lama_kas = ExecuteScalar("SELECT saldo FROM m_kas WHERE id = '$id_kas' AND id_klinik='$id_klinik'");
				$saldo_baru_kas = $saldo_lama_kas + $total;
				Execute("INSERT INTO laporan_kas (id_klinik, id_kas, kode_penjualan, saldo_awal, jumlah, sisa_saldo, tanggal) VALUES ('".$id_klinik."', '".$id_kas."', '".$kode_penjualan."', '".$saldo_lama_kas."', '".$total."', '".$saldo_baru_kas."', '".$tanggal."')");
				Execute("UPDATE m_kas SET saldo='$saldo_baru_kas' WHERE id = '$id_kas' AND id_klinik='$id_klinik'");		
			}

			//INSERTING VOUCHER INTO PENGGUNAAN KARTU
			if($kartu != '' OR $kartu != NULL){
				$jenis_kartu_voucher = ExecuteScalar("SELECT jenis FROM m_kartu WHERE id_kartu = '$kartu'");
				$charge_price_voucher = ExecuteScalar("SELECT charge_price FROM m_kartu WHERE id_kartu = '$kartu'");	
				Execute("INSERT INTO penggunaan_kartu (id_kartu, jenis_kartu, id_klinik, kode_penjualan, tgl, charge, total_charge) VALUES ('".$kartu."', '".$jenis_kartu_voucher."', '".$id_klinik."', '".$kode_penjualan."', '".$tanggal."', '".$charge_price_voucher."', '".$total."')");
			}

			//ADDING POIN MEMBER
			$idpelanggan = ExecuteScalar("SELECT id_pelanggan FROM m_pelanggan WHERE id_pelanggan IN (SELECT id_pelanggan FROM m_member WHERE id_pelanggan='$id_pelanggan')");
			$jenismember = ExecuteScalar("SELECT jenis_member FROM m_member WHERE id_pelanggan = $idpelanggan");
			$kelipatan = ExecuteScalar("SELECT curs_poin FROM m_poin WHERE id_jenis_member = $jenismember");
			$perhitungan = ($total - $ongkir) / $kelipatan;
			$poinsebelumnya = ExecuteScalar("SELECT poin_member FROM m_member WHERE id_pelanggan = $idpelanggan");
			$min_transaksi = ExecuteScalar("SELECT min_transaksi FROM m_poin WHERE id_jenis_member = $jenismember");
			if($total >= $min_transaksi) {
				if($idpelanggan == FALSE){

					// Execute("INSERT INTO m_member (kode_member, idpelanggan, jenis_member, tgl_mulai, tgl_akhir, poin_member) VALUES ('', '".$id_pelanggan."', '1', '".date("Y-m-d h:i:s")."', '', '".floor($perhitungan)."')");
				} else {
					if($klaim_poin != NULL OR $klaim_poin != '') {
						$saldo_poin_klaim = $poinsebelumnya - $klaim_poin;
						Execute("INSERT INTO kartupoin (id_pelanggan, kode_penjualan, tgl, masuk, keluar, saldo_poin, id_klinik) VALUES ('".$idpelanggan."', '".$kode_penjualan."', '".$tanggal."', '0', '".$klaim_poin."','".$saldo_poin_klaim."', '".$id_klinik."')");
						Execute("UPDATE m_member SET poin_member=$saldo_poin_klaim WHERE id_pelanggan=$idpelanggan");
						$poin_saat_ini = $saldo_poin_klaim + floor($perhitungan);
						Execute("INSERT INTO kartupoin (id_pelanggan, kode_penjualan, tgl, masuk, keluar, saldo_poin, id_klinik) VALUES ('".$idpelanggan."', '".$kode_penjualan."', '".$tanggal."', '".floor($perhitungan)."', '0','".$poin_saat_ini."', '".$id_klinik."')");
						Execute("UPDATE m_member SET poin_member=$poin_saat_ini WHERE id_pelanggan=$idpelanggan");
					} else {
						$poin_saat_ini = $poinsebelumnya + floor($perhitungan);
						Execute("INSERT INTO kartupoin (id_pelanggan, kode_penjualan, tgl, masuk, keluar, saldo_poin, id_klinik) VALUES ('".$idpelanggan."', '".$kode_penjualan."', '".$tanggal."', '".floor($perhitungan)."', '0','".$poin_saat_ini."', '".$id_klinik."')");
						Execute("UPDATE m_member SET poin_member=$poin_saat_ini WHERE id_pelanggan=$idpelanggan");
					}
				}
			}

			// KOMISI PEGAWAI KINERJA
			$sales = $rsnew['sales'];
			$dok_be_wajah = $rsnew['dok_be_wajah'];
			$be_body = $rsnew['be_body'];
			$medis = $rsnew['medis'];
			$dokter = $rsnew['dokter'];
			$idpenjualan = $rsnew['id'];
			$waktu = $rsnew['waktu'];
			$kode_penjualan = $rsnew['kode_penjualan'];
			$date = date("Y-m-d");
			$qty = ExecuteScalar("SELECT SUM(qty) AS qty FROM detailpenjualan WHERE id_penjualan=$idpenjualan");

			//KOMISI KINERJA SALES
			if($sales != "") {
				$JabatanSales = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai=$sales");					
				$sql_sales = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
					if($sql_sales -> RecordCount() > 0){
						$sql_sales->MoveFirst();
						while(!$sql_sales->EOF) {
							$id_barang_penjualan = $sql_sales->fields['id_barang'];
							$subtotal_penjualan = $sql_sales->fields['subtotal'];

							//$harga_jual = $sql_sales->fields['harga_jual'];
							$qty_penjualan = $sql_sales->fields['qty'];
							$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

							//$KomisiPegawaiSales = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$sales'");
							$BarangKomisiSales = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
							$qtyBarangKomisiSales = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiSales' AND id_penjualan = '$idpenjualan'");
							if($BarangKomisiSales != ""){
								$TargetBarangSales = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$TglAwalSales = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$TglAkhirSales = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

								//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
								$JmlPenjualanSales = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.sales = '$sales' AND (penjualan.waktu BETWEEN '$TglAwalSales' AND '$TglAkhirSales')");
								if($JmlPenjualanSales >= $TargetBarangSales){
									$KomisiTargetRpSales = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									$KomisiTargetPrSales = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpSales != "" && $KomisiTargetRpSales != "0"){
											$JmlKomisiTargetRpSales = $KomisiTargetRpSales * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpSales', '$JmlKomisiTargetRpSales')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$sales'");
										}
										if($KomisiTargetPrSales != "" && $KomisiTargetPrSales != "0"){
											$JmlKomisiTargetPrSales = (($KomisiTargetPrSales / 100) * $subtotal_satuan);
											$total_komisi_target_sales = $JmlKomisiTargetPrSales * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrSales', '$total_komisi_target_sales')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrSales WHERE id_pegawai='$sales'");
										}						

									// Get Transaksi Komisi Sales
									$sql_transaksi_komisi_sales = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiSales' AND id_pegawai = '$sales' AND id_jabatan = '$JabatanSales' AND (tgl BETWEEN '$TglAwalSales' AND '$TglAkhirSales') AND jenis_komisi='Kinerja'");

										// If Transaksi Komisi Sales != NULL
										if($sql_transaksi_komisi_sales != NULL OR $sql_transaksi_komisi_sales != FALSE){
											if($sql_transaksi_komisi_sales -> RecordCount() > 0){
												$sql_transaksi_komisi_sales->MoveFirst();
												while(!$sql_transaksi_komisi_sales->EOF) {
													$id_transaksi = $sql_transaksi_komisi_sales->fields['id'];
													$id_pegawai_transaksi = $sql_transaksi_komisi_sales->fields['id_pegawai'];
													$id_jabatan_transaksi = $sql_transaksi_komisi_sales->fields['id_jabatan'];
													$kode_penjualan = $sql_transaksi_komisi_sales->fields['kode_penjualan'];
													$id_barang_transaksi = $sql_transaksi_komisi_sales->fields['id_barang'];
													$subtotal_transaksi = $sql_transaksi_komisi_sales->fields['subtotal'];
													$qty_transaksi = $sql_transaksi_komisi_sales->fields['qty'];
													$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
													var_dump($harga_jual_transaksi);

														// If Komisi Target Rupiah != 0
														if($KomisiTargetRpSales != "" && $KomisiTargetRpSales != "0"){

															// Insert into transaksi komisi
															//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpSales', '$KomisiTargetRpSales')");

															$JmlKomisiTargetRpSales = $KomisiTargetRpSales * $qty_transaksi;

															// Update data sebelumnya
															Execute("UPDATE transaksi_komisi SET komisi=$KomisiTargetRpSales, total_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$sales'");
														}

														// If Komisi Target Persen != 0
														if($KomisiTargetPrSales != "" && $KomisiTargetPrSales != "0"){
															$JmlKomisiTargetPrSales = (($KomisiTargetPrSales / 100) * $harga_jual_transaksi);
															$total_komisi_target_sales = $JmlKomisiTargetPrSales * $qty_transaksi;
															Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrSales, total_komisi=$total_komisi_target_sales WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrSales WHERE id_pegawai='$sales'");
														}
												$sql_transaksi_komisi_sales->MoveNext();
												}
											$sql_transaksi_komisi_sales->Close();	
											}
										} else {
											$KomisiTargetRpSales = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											$KomisiTargetPrSales = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											if($KomisiTargetRpSales != "" && $KomisiTargetRpSales != "0"){
												$JmlKomisiTargetRpSales =  $KomisiTargetRpSales * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpSales', '$JmlKomisiTargetRpSales')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpSales WHERE id_pegawai='$sales'");
											}
											if($KomisiTargetPrSales != "" && $KomisiTargetPrSales != "0"){
												$JmlKomisiTargetPrSales = (($KomisiTargetPrSales / 100) * $subtotal_satuan);
												$total_komisi_target_sales = $JmlKomisiTargetPrSales * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrSales', '$total_komisi_target_sales')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrSales WHERE id_pegawai='$sales'");
											}
										}
								} else {
									$KomisiDefaultRpSales = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									$KomisiDefaultPrSales = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanSales' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiDefaultRpSales != "" && $KomisiDefaultRpSales != "0"){
										$JmlKomisiDefaultRpSales = $KomisiDefaultRpSales * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpSales', '$JmlKomisiDefaultRpSales')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpSales WHERE id_pegawai='$sales'");	
									}
									if($KomisiDefaultPrSales != "" && $KomisiDefaultPrSales != "0"){
										$JmlKomisiDefaultPrSales = (($KomisiDefaultPrSales / 100) * $subtotal_satuan);
										$total_komisi_default_sales = $JmlKomisiDefaultPrSales * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$sales', '$JabatanSales', '$BarangKomisiSales', '$qtyBarangKomisiSales', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrSales', '$total_komisi_default_sales')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrSales WHERE id_pegawai='$sales'");
									}
								}
							}
						$sql_sales->MoveNext();	
						}
					$sql_sales->Close();
					}
			}

			//KOMISI KINERJA BE WAJAH
			if($dok_be_wajah != "") {
			$JabatanDokBeWajah = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai=$dok_be_wajah");
			$sql_dok_be_wajah = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_dok_be_wajah -> RecordCount() > 0){
					$sql_dok_be_wajah->MoveFirst();
					while(!$sql_dok_be_wajah->EOF) {
						$id_barang_penjualan = $sql_dok_be_wajah->fields['id_barang'];
						$subtotal_penjualan = $sql_dok_be_wajah->fields['subtotal'];

						//$harga_jual = $sql_dok_be_wajah->fields['harga_jual'];
						$qty_penjualan = $sql_sales->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiDokBeWajah = ExecuteScalar("SELECT nilai_komisi FROM m_pegawai WHERE id_pegawai='$dok_be_wajah'");
						$BarangKomisiDokBeWajah = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiDokBeWajah = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiDokBeWajah' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiDokBeWajah != ""){
							$TargetBarangDokBeWajah = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalDokBeWajah = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirDokBeWajah = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanDokBeWajah = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.dok_be_wajah = '$dok_be_wajah' AND (penjualan.waktu BETWEEN '$TglAwalDokBeWajah' AND '$TglAkhirDokBeWajah')");                    
							if($JmlPenjualanDokBeWajah >= $TargetBarangDokBeWajah){
								$KomisiTargetRpDokBeWajah = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrDokBeWajah = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiTargetRpDokBeWajah != "" && $KomisiTargetRpDokBeWajah != "0"){
									$JmlKomisiTargetRpDokBeWajah = $KomisiTargetRpDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokBeWajah', '$JmlKomisiTargetRpDokBeWajah')");
								}
								if($KomisiTargetPrDokBeWajah != "" && $KomisiTargetPrDokBeWajah != "0"){
									$JmlKomisiTargetPrDokBeWajah = (($KomisiTargetPrDokBeWajah / 100) * $subtotal_satuan);
									$total_komisi_target_dok_be_wajah = $JmlKomisiTargetPrDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokBeWajah', '$total_komisi_target_dok_be_wajah')");
								}
								$sql_transaksi_komisi_dok_be_wajah = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiDokBeWajah' AND id_pegawai = '$dok_be_wajah' AND id_jabatan = '$JabatanDokBeWajah' AND (tgl BETWEEN '$TglAwalDokBeWajah' AND '$TglAkhirDokBeWajah') AND jenis_komisi='Kinerja'");

										// If Transaksi Komisi dok_be_wajah != NULL
										if($sql_transaksi_komisi_dok_be_wajah != NULL OR $sql_transaksi_komisi_dok_be_wajah != FALSE){
											if($sql_transaksi_komisi_dok_be_wajah -> RecordCount() > 0){
												$sql_transaksi_komisi_dok_be_wajah->MoveFirst();
												while(!$sql_transaksi_komisi_dok_be_wajah->EOF) {
													$id_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id'];
													$id_pegawai_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id_pegawai'];
													$id_jabatan_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id_jabatan'];
													$kode_penjualan = $sql_transaksi_komisi_dok_be_wajah->fields['kode_penjualan'];
													$id_barang_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['id_barang'];
													$subtotal_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['subtotal'];
													$qty_transaksi = $sql_transaksi_komisi_dok_be_wajah->fields['qty'];
													$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
													var_dump($harga_jual_transaksi);

														// If Komisi Target Rupiah != 0
														if($KomisiTargetRpDokBeWajah != "" && $KomisiTargetRpDokBeWajah != "0"){

															// Insert into transaksi komisi
															//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$Jabatandok_be_wajah', '$BarangKomisidok_be_wajah', '$qtyBarangKomisidok_be_wajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokBeWajah', '$KomisiTargetRpDokBeWajah')");

															$JmlKomisiTargetRpDokBeWajah = $KomisiTargetRpDokBeWajah * $qty_transaksi;

															// Update data sebelumnya
															Execute("UPDATE transaksi_komisi SET komisi=$KomisiTargetRpDokBeWajah, total_komisi=$JmlKomisiTargetRpDokBeWajah WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
														}

														// If Komisi Target Persen != 0
														if($KomisiTargetPrDokBeWajah != "" && $KomisiTargetPrDokBeWajah != "0"){
															$JmlKomisiTargetPrDokBeWajah = (($KomisiTargetPrDokBeWajah / 100) * $harga_jual_transaksi);
															$total_komisi_target_dok_be_wajah = $JmlKomisiTargetPrDokBeWajah * $qty_transaksi;
															Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrDokBeWajah, total_komisi=$total_komisi_target_dok_be_wajah WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

															//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
														}
												$sql_transaksi_komisi_dok_be_wajah->MoveNext();
												}
											$sql_transaksi_komisi_dok_be_wajah->Close();	
											}
										} else {
											$KomisiTargetRpDokBeWajah = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$Jabatandok_be_wajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											$KomisiTargetPrDokBeWajah = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$Jabatandok_be_wajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
											if($KomisiTargetRpDokBeWajah != "" && $KomisiTargetRpDokBeWajah != "0"){
												$JmlKomisiTargetRpDokBeWajah =  $KomisiTargetRpDokBeWajah * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$Jabatandok_be_wajah', '$BarangKomisidok_be_wajah', '$qtyBarangKomisidok_be_wajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokBeWajah', '$JmlKomisiTargetRpDokBeWajah')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
											}
											if($KomisiTargetPrDokBeWajah != "" && $KomisiTargetPrDokBeWajah != "0"){
												$JmlKomisiTargetPrDokBeWajah = (($KomisiTargetPrDokBeWajah / 100) * $subtotal_satuan);
												$total_komisi_target_dok_be_wajah = $JmlKomisiTargetPrDokBeWajah * $qty_penjualan;
												Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$Jabatandok_be_wajah', '$BarangKomisidok_be_wajah', '$qtyBarangKomisidok_be_wajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokBeWajah', '$total_komisi_target_dok_be_wajah')");

												//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
											}
										}
							} else {
								$KomisiDefaultRpDokBeWajah = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrDokBeWajah = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokBeWajah' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpDokBeWajah != "" && $KomisiDefaultRpDokBeWajah != "0"){
									$JmlKomisiDefaultRpDokBeWajah =  $KomisiDefaultRpDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpDokBeWajah', '$JmlKomisiDefaultRpDokBeWajah')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpDokBeWajah WHERE id_pegawai='$dok_be_wajah'");	
								}
								if($KomisiDefaultPrDokBeWajah != "" && $KomisiDefaultPrDokBeWajah != "0"){
									$JmlKomisiDefaultPrDokBeWajah = (($KomisiDefaultPrDokBeWajah / 100) * $subtotal_satuan);
									$total_komisi_default_dok_be_wajah = $JmlKomisiDefaultPrDokBeWajah * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dok_be_wajah', '$JabatanDokBeWajah', '$BarangKomisiDokBeWajah', '$qtyBarangKomisiDokBeWajah', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrDokBeWajah', '$total_komisi_default_dok_be_wajah')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrDokBeWajah WHERE id_pegawai='$dok_be_wajah'");
								}
							}
						}
					$sql_dok_be_wajah->MoveNext();	
					}
				$sql_dok_be_wajah->Close();
				}
			}

			// KOMISI KINERJA BE BODY	
			if($be_body != "") {
			$JabatanBeBody = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai=$be_body");
			$sql_be_body = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_be_body -> RecordCount() > 0){
					$sql_be_body->MoveFirst();
					while(!$sql_be_body->EOF) {
						$id_barang_penjualan = $sql_be_body->fields['id_barang'];
						$subtotal_penjualan = $sql_be_body->fields['subtotal'];

						//$harga_jual = $sql_be_body->fields['harga_jual'];
						$qty_penjualan = $sql_be_body->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiBe Body = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$be_body'");
						$BarangKomisiBeBody = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiBeBody = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiBeBody' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiBeBody != ""){
							$TargetBarangBeBody = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalBeBody = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirBeBody = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanBeBody = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.be_body = '$be_body' AND (penjualan.waktu BETWEEN '$TglAwalBeBody' AND '$TglAkhirBeBody')");
							if($JmlPenjualanBeBody >= $TargetBarangBeBody){
								$KomisiTargetRpBeBody = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrBeBody = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiTargetRpBeBody != "" && $KomisiTargetRpBeBody != "0"){
										$JmlKomisiTargetRpBeBody = $KomisiTargetRpBeBody * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpBeBody', '$JmlKomisiTargetRpBeBody')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$be_body'");
									}
									if($KomisiTargetPrBeBody != "" && $KomisiTargetPrBeBody != "0"){
										$JmlKomisiTargetPrBeBody = (($KomisiTargetPrBeBody / 100) * $subtotal_satuan);
										$total_komisi_target_be_body = $JmlKomisiTargetPrBeBody * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrBeBody', '$total_komisi_target_be_body')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrBeBody WHERE id_pegawai='$be_body'");
									}						

								// Get Transaksi Komisi Be Body
								$sql_transaksi_komisi_be_body = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiBeBody' AND id_pegawai = '$be_body' AND id_jabatan = '$JabatanBeBody' AND (tgl BETWEEN '$TglAwalBeBody' AND '$TglAkhirBeBody') AND jenis_komisi='Kinerja'");

									// If Transaksi Komisi Be Body != NULL
									if($sql_transaksi_komisi_be_body != NULL OR $sql_transaksi_komisi_be_body != FALSE){
										if($sql_transaksi_komisi_be_body -> RecordCount() > 0){
											$sql_transaksi_komisi_be_body->MoveFirst();
											while(!$sql_transaksi_komisi_be_body->EOF) {
												$id_transaksi = $sql_transaksi_komisi_be_body->fields['id'];
												$id_pegawai_transaksi = $sql_transaksi_komisi_be_body->fields['id_pegawai'];
												$id_jabatan_transaksi = $sql_transaksi_komisi_be_body->fields['id_jabatan'];
												$kode_penjualan = $sql_transaksi_komisi_be_body->fields['kode_penjualan'];
												$id_barang_transaksi = $sql_transaksi_komisi_be_body->fields['id_barang'];
												$subtotal_transaksi = $sql_transaksi_komisi_be_body->fields['subtotal'];
												$qty_transaksi = $sql_transaksi_komisi_be_body->fields['qty'];
												$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
												var_dump($harga_jual_transaksi);

													// If Komisi Target Rupiah != 0
													if($KomisiTargetRpBeBody != "" && $KomisiTargetRpBeBody != "0"){

														// Insert into transaksi komisi
														//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpBeBody', '$KomisiTargetRpBeBody')");

														$JmlKomisiTargetRpBeBody = $KomisiTargetRpBeBody * $qty_transaksi;

														// Update data sebelumnya
														Execute("UPDATE transaksi_komisi SET komisi=$KomisiTargetRpBeBody, total_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$be_body'");
													}

													// If Komisi Target Persen != 0
													if($KomisiTargetPrBeBody != "" && $KomisiTargetPrBeBody != "0"){
														$JmlKomisiTargetPrBeBody = (($KomisiTargetPrBeBody / 100) * $harga_jual_transaksi);
														$total_komisi_target_be_body = $JmlKomisiTargetPrBeBody * $qty_transaksi;
														Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrBeBody, total_komisi=$total_komisi_target_be_body WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrBeBody WHERE id_pegawai='$be_body'");
													}
											$sql_transaksi_komisi_be_body->MoveNext();
											}
										$sql_transaksi_komisi_be_body->Close();	
										}
									} else {
										$KomisiTargetRpBeBody = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										$KomisiTargetPrBeBody = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpBeBody != "" && $KomisiTargetRpBeBody != "0"){
											$JmlKomisiTargetRpBeBody =  $KomisiTargetRpBeBody * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpBeBody', '$JmlKomisiTargetRpBeBody')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpBeBody WHERE id_pegawai='$be_body'");
										}
										if($KomisiTargetPrBeBody != "" && $KomisiTargetPrBeBody != "0"){
											$JmlKomisiTargetPrBeBody = (($KomisiTargetPrBeBody / 100) * $subtotal_satuan);
											$total_komisi_target_be_body = $JmlKomisiTargetPrBeBody * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrBeBody', '$total_komisi_target_be_body')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrBeBody WHERE id_pegawai='$be_body'");
										}
									}
							} else {
								$KomisiDefaultRpBeBody = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrBeBody = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanBeBody' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpBeBody != "" && $KomisiDefaultRpBeBody != "0"){
									$JmlKomisiDefaultRpBeBody = $KomisiDefaultRpBeBody * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpBeBody', '$JmlKomisiDefaultRpBeBody')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpBeBody WHERE id_pegawai='$be_body'");	
								}
								if($KomisiDefaultPrBeBody != "" && $KomisiDefaultPrBeBody != "0"){
									$JmlKomisiDefaultPrBeBody = (($KomisiDefaultPrBeBody / 100) * $subtotal_satuan);
									$total_komisi_default_be_body = $JmlKomisiDefaultPrBeBody * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$be_body', '$JabatanBeBody', '$BarangKomisiBeBody', '$qtyBarangKomisiBeBody', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrBeBody', '$total_komisi_default_be_body')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrBeBody WHERE id_pegawai='$be_body'");
								}
							}
						}
					$sql_be_body->MoveNext();	
					}
				$sql_be_body->Close();
				}
			}

			//KOMISI KINERJA MEDIS
			if($medis != "") {
			$JabatanMedis = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai=$medis");
			$sql_medis = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_medis -> RecordCount() > 0){
					$sql_medis->MoveFirst();
					while(!$sql_medis->EOF) {
						$id_barang_penjualan = $sql_medis->fields['id_barang'];
						$subtotal_penjualan = $sql_medis->fields['subtotal'];

						//$harga_jual = $sql_medis->fields['harga_jual'];
						$qty_penjualan = $sql_medis->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiBe Body = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$medis'");
						$BarangKomisiMedis = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiMedis = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiMedis' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiMedis != ""){ 
							$TargetBarangMedis = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalMedis = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirMedis = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanMedis = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.medis = '$medis' AND (penjualan.waktu BETWEEN '$TglAwalMedis' AND '$TglAkhirMedis')");
							if($JmlPenjualanMedis >= $TargetBarangMedis){
								$KomisiTargetRpMedis = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrMedis = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiTargetRpMedis != "" && $KomisiTargetRpMedis != "0"){
										$JmlKomisiTargetRpMedis = $KomisiTargetRpMedis * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpMedis', '$JmlKomisiTargetRpMedis')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$medis'");
									}
									if($KomisiTargetPrMedis != "" && $KomisiTargetPrMedis != "0"){
										$JmlKomisiTargetPrMedis = (($KomisiTargetPrMedis / 100) * $subtotal_satuan);
										$total_komisi_target_medis = $JmlKomisiTargetPrMedis * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrMedis', '$total_komisi_target_medis')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrMedis WHERE id_pegawai='$medis'");
									}						

								// Get Transaksi Komisi Be Body
								$sql_transaksi_komisi_medis = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiMedis' AND id_pegawai = '$medis' AND id_jabatan = '$JabatanMedis' AND (tgl BETWEEN '$TglAwalMedis' AND '$TglAkhirMedis') AND jenis_komisi='Kinerja'");

									// If Transaksi Komisi Be Body != NULL
									if($sql_transaksi_komisi_medis != NULL OR $sql_transaksi_komisi_medis != FALSE){
										if($sql_transaksi_komisi_medis -> RecordCount() > 0){
											$sql_transaksi_komisi_medis->MoveFirst();
											while(!$sql_transaksi_komisi_medis->EOF) {
												$id_transaksi = $sql_transaksi_komisi_medis->fields['id'];
												$id_pegawai_transaksi = $sql_transaksi_komisi_medis->fields['id_pegawai'];
												$id_jabatan_transaksi = $sql_transaksi_komisi_medis->fields['id_jabatan'];
												$kode_penjualan = $sql_transaksi_komisi_medis->fields['kode_penjualan'];
												$id_barang_transaksi = $sql_transaksi_komisi_medis->fields['id_barang'];
												$subtotal_transaksi = $sql_transaksi_komisi_medis->fields['subtotal'];
												$qty_transaksi = $sql_transaksi_komisi_medis->fields['qty'];
												$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
												var_dump($harga_jual_transaksi);

													// If Komisi Target Rupiah != 0
													if($KomisiTargetRpMedis != "" && $KomisiTargetRpMedis != "0"){

														// Insert into transaksi komisi
														//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpMedis', '$KomisiTargetRpMedis')");

														$JmlKomisiTargetRpMedis = $KomisiTargetRpMedis * $qty_transaksi;

														// Update data sebelumnya
														Execute("UPDATE transaksi_komisi SET komisi=$KomisiTargetRpMedis, total_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$medis'");
													}

													// If Komisi Target Persen != 0
													if($KomisiTargetPrMedis != "" && $KomisiTargetPrMedis != "0"){
														$JmlKomisiTargetPrMedis = (($KomisiTargetPrMedis / 100) * $harga_jual_transaksi);
														$total_komisi_target_medis = $JmlKomisiTargetPrMedis * $qty_transaksi;
														Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrMedis, total_komisi=$total_komisi_target_medis WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrMedis WHERE id_pegawai='$medis'");
													}
											$sql_transaksi_komisi_medis->MoveNext();
											}
										$sql_transaksi_komisi_medis->Close();	
										}
									} else {
										$KomisiTargetRpMedis = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										$KomisiTargetPrMedis = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpMedis != "" && $KomisiTargetRpMedis != "0"){
											$JmlKomisiTargetRpMedis =  $KomisiTargetRpMedis * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpMedis', '$JmlKomisiTargetRpMedis')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpMedis WHERE id_pegawai='$medis'");
										}
										if($KomisiTargetPrMedis != "" && $KomisiTargetPrMedis != "0"){
											$JmlKomisiTargetPrMedis = (($KomisiTargetPrMedis / 100) * $subtotal_satuan);
											$total_komisi_target_medis = $JmlKomisiTargetPrMedis * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrMedis', '$total_komisi_target_medis')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrMedis WHERE id_pegawai='$medis'");
										}
									}
							} else {
								$KomisiDefaultRpMedis = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrMedis = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanMedis' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpMedis != "" && $KomisiDefaultRpMedis != "0"){
									$JmlKomisiDefaultRpMedis = $KomisiDefaultRpMedis * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpMedis', '$JmlKomisiDefaultRpMedis')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpMedis WHERE id_pegawai='$medis'");	
								}
								if($KomisiDefaultPrMedis != "" && $KomisiDefaultPrMedis != "0"){
									$JmlKomisiDefaultPrMedis = (($KomisiDefaultPrMedis / 100) * $subtotal_satuan);
									$total_komisi_default_medis = $JmlKomisiDefaultPrMedis * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$medis', '$JabatanMedis', '$BarangKomisiMedis', '$qtyBarangKomisiMedis', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrMedis', '$total_komisi_default_medis')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrMedis WHERE id_pegawai='$medis'");
								}
							}
						}
					$sql_medis->MoveNext();	
					}
				$sql_medis->Close();
				}
			}

			//KOMISI KINERJA DOKTER
			if($dokter != "") {
			$JabatanDokter = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai=$dokter");
			$sql_dokter = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
				if($sql_dokter -> RecordCount() > 0){
					$sql_dokter->MoveFirst();
					while(!$sql_dokter->EOF) {
						$id_barang_penjualan = $sql_dokter->fields['id_barang'];
						$subtotal_penjualan = $sql_dokter->fields['subtotal'];

						//$harga_jual = $sql_dokter->fields['harga_jual'];
						$qty_penjualan = $sql_dokter->fields['qty'];
						$subtotal_satuan = $subtotal_penjualan / $qty_penjualan;

						//$KomisiPegawaiBe Body = ExecuteScalar("SELECT nilai_komisi FROM transaksi_komisi WHERE id_pegawai='$dokter'");
						$BarangKomisiDokter = ExecuteScalar("SELECT id_barang FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi_kinerja_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");					
						$qtyBarangKomisiDokter = ExecuteScalar("SELECT qty FROM detailpenjualan WHERE id_barang = '$BarangKomisiDokter' AND id_penjualan = '$idpenjualan'");
						if($BarangKomisiDokter != ""){  
							$TargetBarangDokter = ExecuteScalar("SELECT target FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAwalDokter = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
							$TglAkhirDokter = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");

							//$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
							$JmlPenjualanDokter = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND penjualan.dokter = '$dokter' AND (penjualan.waktu BETWEEN '$TglAwalDokter' AND '$TglAkhirDokter')");
							if($JmlPenjualanDokter >= $TargetBarangDokter){
								$KomisiTargetRpDokter = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiTargetPrDokter = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
									if($KomisiTargetRpDokter != "" && $KomisiTargetRpDokter != "0"){
										$JmlKomisiTargetRpDokter = $KomisiTargetRpDokter * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokter', '$JmlKomisiTargetRpDokter')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
									}
									if($KomisiTargetPrDokter != "" && $KomisiTargetPrDokter != "0"){
										$JmlKomisiTargetPrDokter = (($KomisiTargetPrDokter / 100) * $subtotal_satuan);
										$total_komisi_target_dokter = $JmlKomisiTargetPrDokter * $qty_penjualan;
										Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokter', '$total_komisi_target_dokter')");

										//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
									}						

								// Get Transaksi Komisi Be Body
								$sql_transaksi_komisi_dokter = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiDokter' AND id_pegawai = '$dokter' AND id_jabatan = '$JabatanDokter' AND (tgl BETWEEN '$TglAwalDokter' AND '$TglAkhirDokter') AND jenis_komisi='Kinerja'");

									// If Transaksi Komisi Be Body != NULL
									if($sql_transaksi_komisi_dokter != NULL OR $sql_transaksi_komisi_dokter != FALSE){
										if($sql_transaksi_komisi_dokter -> RecordCount() > 0){
											$sql_transaksi_komisi_dokter->MoveFirst();
											while(!$sql_transaksi_komisi_dokter->EOF) {
												$id_transaksi = $sql_transaksi_komisi_dokter->fields['id'];
												$id_pegawai_transaksi = $sql_transaksi_komisi_dokter->fields['id_pegawai'];
												$id_jabatan_transaksi = $sql_transaksi_komisi_dokter->fields['id_jabatan'];
												$kode_penjualan = $sql_transaksi_komisi_dokter->fields['kode_penjualan'];
												$id_barang_transaksi = $sql_transaksi_komisi_dokter->fields['id_barang'];
												$subtotal_transaksi = $sql_transaksi_komisi_dokter->fields['subtotal'];
												$qty_transaksi = $sql_transaksi_komisi_dokter->fields['qty'];
												$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
												var_dump($harga_jual_transaksi);

													// If Komisi Target Rupiah != 0
													if($KomisiTargetRpDokter != "" && $KomisiTargetRpDokter != "0"){

														// Insert into transaksi komisi
														//Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokter', '$KomisiTargetRpDokter')");

														$JmlKomisiTargetRpDokter = $KomisiTargetRpDokter * $qty_transaksi;

														// Update data sebelumnya
														Execute("UPDATE transaksi_komisi SET komisi=$KomisiTargetRpDokter, total_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
													}

													// If Komisi Target Persen != 0
													if($KomisiTargetPrDokter != "" && $KomisiTargetPrDokter != "0"){
														$JmlKomisiTargetPrDokter = (($KomisiTargetPrDokter / 100) * $harga_jual_transaksi);
														$total_komisi_target_dokter = $JmlKomisiTargetPrDokter * $qty_transaksi;
														Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrDokter, total_komisi=$total_komisi_target_dokter WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													

														//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
													}
											$sql_transaksi_komisi_dokter->MoveNext();
											}
										$sql_transaksi_komisi_dokter->Close();	
										}
									} else {
										$KomisiTargetRpDokter = ExecuteScalar("SELECT kinerja_target_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										$KomisiTargetPrDokter = ExecuteScalar("SELECT kinerja_target_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
										if($KomisiTargetRpDokter != "" && $KomisiTargetRpDokter != "0"){
											$JmlKomisiTargetRpDokter =  $KomisiTargetRpDokter * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan, tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiTargetRpDokter', '$JmlKomisiTargetRpDokter')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
										}
										if($KomisiTargetPrDokter != "" && $KomisiTargetPrDokter != "0"){
											$JmlKomisiTargetPrDokter = (($KomisiTargetPrDokter / 100) * $subtotal_satuan);
											$total_komisi_target_dokter = $JmlKomisiTargetPrDokter * $qty_penjualan;
											Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrDokter', '$total_komisi_target_dokter')");

											//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
										}
									}
							} else {
								$KomisiDefaultRpDokter = ExecuteScalar("SELECT kinerja_default_rupiah FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$KomisiDefaultPrDokter = ExecuteScalar("SELECT kinerja_default_persen FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanDokter' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($KomisiDefaultRpDokter != "" && $KomisiDefaultRpDokter != "0"){
									$JmlKomisiDefaultRpDokter = $KomisiDefaultRpDokter * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$KomisiDefaultRpDokter', '$JmlKomisiDefaultRpDokter')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultRpDokter WHERE id_pegawai='$dokter'");	
								}
								if($KomisiDefaultPrDokter != "" && $KomisiDefaultPrDokter != "0"){
									$JmlKomisiDefaultPrDokter = (($KomisiDefaultPrDokter / 100) * $subtotal_satuan);
									$total_komisi_default_dokter = $JmlKomisiDefaultPrDokter * $qty_penjualan;
									Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, id_barang, qty, subtotal, jenis_komisi, kode_penjualan,tgl, komisi, total_komisi) VALUES ('$dokter', '$JabatanDokter', '$BarangKomisiDokter', '$qtyBarangKomisiDokter', '$subtotal_penjualan', 'Kinerja', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrDokter', '$total_komisi_default_dokter')");

									//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiDefaultPrDokter WHERE id_pegawai='$dokter'");
								}
							}
						}
					$sql_dokter->MoveNext();	
					}
				$sql_dokter->Close();
				}
			}

			// KOMISI PEGAWAI RECALL
			$sql_komisi_recall = Execute("SELECT * FROM detailpenjualan WHERE id_penjualan = '$idpenjualan'");
					if($sql_komisi_recall -> RecordCount() > 0){
						$sql_komisi_recall->MoveFirst();
						while(!$sql_komisi_recall->EOF) {
							$id_barang_penjualan = $sql_komisi_recall->fields['id_barang'];
							$id_pegawai_recall = $sql_komisi_recall->fields['komisi_recall'];
							$qty_penjualan = $sql_komisi_recall->fields['qty'];
							$subtotal_penjualan = $sql_komisi_recall->fields['subtotal'];
							$harga_jual = $sql_komisi_recall->fields['harga_jual'];
							if($id_pegawai_recall != ''){
								$JabatanPegawai = ExecuteScalar("SELECT jabatan_pegawai FROM m_pegawai WHERE id_pegawai=$id_pegawai_recall");
								$BarangKomisiRecall = ExecuteScalar("SELECT id_barang FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi_recall_detail.id_komisi = m_komisi.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
								$TglAwalRecall = ExecuteScalar("SELECT tgl_mulai FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								$TglAkhirRecall = ExecuteScalar("SELECT tgl_akhir FROM m_komisi_kinerja_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_kinerja_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_kinerja_detail.id_barang = '$id_barang_penjualan'");
								if($BarangKomisiRecall != '') {
									$TargetBarangRecall = ExecuteScalar("SELECT target FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan = '$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
									$Periode = ExecuteScalar("SELECT '$date' - INTERVAL '1' MONTH");
									$JmlPenjualan = ExecuteScalar("SELECT SUM(qty) FROM detailpenjualan JOIN penjualan ON penjualan.id = detailpenjualan.id_penjualan WHERE detailpenjualan.id_barang = '$id_barang_penjualan' AND detailpenjualan.komisi_recall = '$id_pegawai_recall' AND (penjualan.waktu BETWEEN '$Periode' AND '$date')");
										if($JmlPenjualan >= $TargetBarangRecall) {
											$KomisiTargetRpRecall = ExecuteScalar("SELECT recall_target_rupiah FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
											$KomisiTargetPrRecall = ExecuteScalar("SELECT recall_target_persen FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");									
												if($KomisiTargetRpRecall != "" && $KomisiTargetRpRecall != "0"){
													$total_komisi_target_rp = $KomisiTargetRpRecall * $qty_penjualan;
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$KomisiTargetRpRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_rp')");								

													//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetRpDokter WHERE id_pegawai='$dokter'");
												}
												if($KomisiTargetPrRecall != "" && $KomisiTargetPrRecall != "0"){
													$JmlKomisiTargetPrRecall = (($KomisiTargetPrRecall / 100) * $harga_jual);
													$total_komisi_target_pr = (($KomisiTargetPrRecall / 100) * $subtotal_penjualan);
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_pr')");								

													//Execute("UPDATE m_pegawai SET nilai_komisi=$JmlKomisiTargetPrDokter WHERE id_pegawai='$dokter'");
												}

												// Get Transaksi Komisi Recall
												$sql_transaksi_komisi_recall = Execute("SELECT * FROM transaksi_komisi WHERE id_barang = '$BarangKomisiRecall' AND id_pegawai = '$id_pegawai_recall' AND id_jabatan = '$JabatanPegawai' AND (tgl BETWEEN '$TglAwalRecall' AND '$TglAkhirRecall') AND jenis_komisi='Recall'");

													// If Transaksi Komisi Be Body != NULL
													if($sql_transaksi_komisi_recall != NULL OR $sql_transaksi_komisi_recall != FALSE) {
														if($sql_transaksi_komisi_recall -> RecordCount() > 0){
															$sql_transaksi_komisi_recall->MoveFirst();
															while(!$sql_transaksi_komisi_recall->EOF) {
																$id_transaksi = $sql_transaksi_komisi_recall->fields['id'];
																$id_pegawai_transaksi = $sql_transaksi_komisi_recall->fields['id_pegawai'];
																$id_jabatan_transaksi = $sql_transaksi_komisi_recall->fields['id_jabatan'];
																$kode_penjualan = $sql_transaksi_komisi_recall->fields['kode_penjualan'];
																$id_barang_transaksi = $sql_transaksi_komisi_recall->fields['id_barang'];
																$subtotal_transaksi = $sql_transaksi_komisi_recall->fields['subtotal'];
																$qty_transaksi = $sql_transaksi_komisi_recall->fields['qty'];
																$harga_jual_transaksi = $subtotal_transaksi / $qty_transaksi;
																var_dump($harga_jual_transaksi);

																	// If Komisi Target Rupiah != 0
																	if($KomisiTargetRpRecall != "" && $KomisiTargetRpRecall != "0"){
																		$JmlKomisiTargetRpRecall = $KomisiTargetRpRecall * $qty_transaksi;

																		// Update data sebelumnya
																		Execute("UPDATE transaksi_komisi SET komisi=$KomisiTargetRpRecall, total_komisi=$JmlKomisiTargetRpRecall WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													
																	}

																	// If Komisi Target Persen != 0
																	if($KomisiTargetPrRecall != "" && $KomisiTargetPrRecall != "0"){
																		$JmlKomisiTargetPrRecall = (($KomisiTargetPrRecall / 100) * $harga_jual_transaksi);
																		$total_komisi_target_recall = $JmlKomisiTargetPrRecall * $qty_transaksi;
																		Execute("UPDATE transaksi_komisi SET komisi=$JmlKomisiTargetPrRecall, total_komisi=$total_komisi_target_recall WHERE id_pegawai='$id_pegawai_transaksi' AND id_jabatan = '$id_jabatan_transaksi' AND id = '$id_transaksi'");													
																	}
															$sql_transaksi_komisi_recall->MoveNext();
															}
														$sql_transaksi_komisi_recall->Close();	
														}
													} else {
															$KomisiTargetRpRecall = ExecuteScalar("SELECT recall_target_rupiah FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
															$KomisiTargetPrRecall = ExecuteScalar("SELECT recall_target_persen FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");									
																if($KomisiTargetRpRecall != "" && $KomisiTargetRpRecall != "0"){
																	$total_komisi_target_rp = $KomisiTargetRpRecall * $qty_penjualan;
																	Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$KomisiTargetRpRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_rp')");								
																}
																if($KomisiTargetPrRecall != "" && $KomisiTargetPrRecall != "0"){
																	$JmlKomisiTargetPrRecall = (($KomisiTargetPrRecall / 100) * $harga_jual);
																	$total_komisi_target_pr = (($KomisiTargetPrRecall / 100) * $subtotal_penjualan);
																	Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$JmlKomisiTargetPrRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_target_pr')");								
																}
													}
										} else {
											$KomisiDefaultRpRecall = ExecuteScalar("SELECT recall_default_rupiah FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
											$KomisiDefaultPrRecall = ExecuteScalar("SELECT recall_default_persen FROM m_komisi_recall_detail JOIN m_komisi ON m_komisi.id_komisi = m_komisi_recall_detail.id_komisi WHERE m_komisi.id_jabatan ='$JabatanPegawai' AND m_komisi_recall_detail.id_barang = '$id_barang_penjualan'");
												if($KomisiDefaultRpRecall != "" && $KomisiDefaultRpRecall != "0"){
													$total_komisi_default_rp = $KomisiDefaultRpRecall * $qty_penjualan;
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$KomisiDefaultRpRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_default_rp')");								
												}
												if($KomisiDefaultPrRecall != "" && $KomisiDefaultPrRecall != "0"){
													$JmlKomisiDefaultPrRecall = (($KomisiDefaultPrRecall / 100) * $harga_jual);
													$total_komisi_default_pr = (($KomisiDefaultPrRecall / 100) * $subtotal_penjualan);
													Execute("INSERT INTO transaksi_komisi (id_pegawai, id_jabatan, jenis_komisi, kode_penjualan,tgl, komisi, id_barang, qty, subtotal, total_komisi) VALUES ('$id_pegawai_recall', '$JabatanPegawai', 'Recall', '$kode_penjualan', '$waktu', '$JmlKomisiDefaultPrRecall', '$id_barang_penjualan', '$qty_penjualan', '$subtotal_penjualan', '$total_komisi_default_pr')");								                                
												}
										}
								}
							}
						$sql_komisi_recall->MoveNext();	
						}
					$sql_komisi_recall->Close();
					}
			if($idpelanggan != FALSE) {

				//INSERT TGL AWAL TRANSAKSI && JML AKUMULASI
				$total_akumulasi = ExecuteScalar("SELECT total_akumulasi FROM m_member WHERE id_pelanggan=$idpelanggan");
				$tglmulai = ExecuteScalar("SELECT tgl_mulai FROM m_member WHERE id_pelanggan=$idpelanggan");
				if($total_akumulasi == '' OR $total_akumulasi == '0' OR $total_akumulasi == NULL){
					$tglawaltransaksi = ExecuteScalar("SELECT tgl_awal_transaksi FROM m_member WHERE id_pelanggan=$idpelanggan");
						if($tglawaltransaksi == '') {
							$date = date("Y-m-d");
							date_default_timezone_set("Indonesia/Jakarta");
							$tgltransaksiawal = ExecuteScalar("SELECT waktu FROM penjualan WHERE waktu >= '$tglmulai' ORDER BY waktu ASC LIMIT 1");
							$jmlakumulasi = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_pelanggan=$idpelanggan AND (waktu BETWEEN '$tgltransaksiawal' AND '$date')");
							Execute("UPDATE m_member SET tgl_awal_transaksi='$tgltransaksiawal', total_akumulasi=$jmlakumulasi WHERE id_pelanggan=$idpelanggan");
						}
				} else {
					$date = date("Y-m-d");
					$tgltransaksiawal = ExecuteScalar("SELECT waktu FROM penjualan WHERE waktu >= '$tglmulai' ORDER BY waktu ASC LIMIT 1");
					$jmlakumulasi = ExecuteScalar("SELECT SUM(total) FROM penjualan WHERE id_pelanggan=$idpelanggan AND (waktu BETWEEN '$tgltransaksiawal' AND '$date')");
					Execute("UPDATE m_member SET total_akumulasi=$jmlakumulasi WHERE id_pelanggan=$idpelanggan");
				}

				//UPGRADE MEMBER
				$firstdate = date("Y-n-j", strtotime("first day of this month"));
				$lastdate = date("Y-n-j", strtotime("last day of this month"));
				$KedatanganBlnIni = ExecuteScalar("SELECT COUNT(id) FROM penjualan WHERE id_pelanggan = $idpelanggan AND (waktu BETWEEN '$firstdate' AND '$lastdate')");
				if($KedatanganBlnIni > '1') {
				} else {
					$firstdateprevmonth = date("Y-n-j", strtotime("first day of previous month"));
					$lastdateprevmonth = date("Y-n-j", strtotime("last day of previous month"));
					$KedatanganBlnLalu = ExecuteScalar("SELECT COUNT(id) FROM penjualan WHERE id_pelanggan = $idpelanggan AND (waktu BETWEEN '$firstdateprevmonth' AND '$lastdateprevmonth')");
					$min_kedatangan = ExecuteSCalar("SELECT min_kedatangan FROM m_jenis_member WHERE id_jenis_member=$jenismember");
					if($KedatanganBlnLalu >= $min_kedatangan){
						$TglAwal = ExecuteScalar("SELECT tgl_awal_transaksi FROM m_member WHERE id_pelanggan=$idpelanggan");
						$CountDay = ExecuteScalar("SELECT DATEDIFF('$date', '$TglAwal')");
						$JangkaWaktu = ExecuteScalar("SELECT jangka_waktu FROM m_jenis_member WHERE id_jenis_member='$jenismember'");
							if($CountDay >= $JangkaWaktu){
								$nominalbwh_reguler = ExecuteScalar("SELECT nominal_bawah FROM m_jenis_member WHERE nama_member='Reguler'");
								$nominalats_reguler = ExecuteScalar("SELECT nominal_atas FROM m_jenis_member WHERE nama_member='Reguler'");
								$nominalbwh_vip = ExecuteScalar("SELECT nominal_bawah FROM m_jenis_member WHERE nama_member='VIP'");
								$level_selanjutnya = ExecuteScalar("SELECT member_selanjutnya FROM m_jenis_member WHERE id_jenis_member=$jenismember");
								$id_vvip = ExecuteScalar("SELECT id FROM m_jenis_member WHERE nama_member='VVIP'");
									if($total_akumulasi >= $nominalbwh_reguler || $total_akumulasi <= $nominalats_reguler) {
										Execute("UPDATE m_member SET jenis_member=$level_selanjutnya WHERE id_pelanggan=$idpelanggan");
									}
									if($total_akumulasi >= $nominalbwh_vip){
										Execute("UPDATE m_member SET jenis_member=$id_vvip WHERE id_pelanggan=$idpelanggan");
									}
							}
					}
				}
			}
			$tgl_terakhir_transaksi = date("Y-m-d H:i:s");
			Execute("UPDATE m_pelanggan SET tgl_terakhir_transaksi = '".$tgl_terakhir_transaksi."' WHERE id_pelanggan='".$id_pelanggan."'");
		} //End of if(status == printed)
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

		if(is_null($this->id_rmd->CurrentValue)) {
			$this->id_rmd->ViewValue  = '-:-' ;
		}
		$id_klinik = CurrentUserInfo("id_klinik");
		if($id_klinik != '' OR $id_klinik != FALSE){
			$this->id_klinik->CurrentValue = $id_klinik;
			$this->id_klinik->ReadOnly = TRUE; 
		}
	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>