<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Class for index
 */
class index
{

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Constructor
	public function __construct() {
		$this->CheckToken = Config("CHECK_TOKEN");
	}

	// Terminate page
	public function terminate($url = "")
	{

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Page Redirecting event
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url != "") {
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $Language, $UserProfile, $Security, $Breadcrumb;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// User profile
		$UserProfile = new UserProfile();

		// Security object
		$Security = new AdvancedSecurity();
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Breadcrumb
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level
		if ($Security->allowList(CurrentProjectID() . 'penjualan'))
			$this->terminate("penjualanlist.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 'antrian'))
			$this->terminate("antrianlist.php");
		if ($Security->allowList(CurrentProjectID() . 'antrian.php'))
			$this->terminate("antrian.php");
		if ($Security->allowList(CurrentProjectID() . 'antrian_baru.php'))
			$this->terminate("antrian baru/antrian_baru.php");
		if ($Security->allowList(CurrentProjectID() . 'detailjurnal'))
			$this->terminate("detailjurnallist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailkirimbarang'))
			$this->terminate("detailkirimbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailkomposisi'))
			$this->terminate("detailkomposisilist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailmintapembelian'))
			$this->terminate("detailmintapembelianlist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailmutasibank'))
			$this->terminate("detailmutasibanklist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailpenjualan'))
			$this->terminate("detailpenjualanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailpenyesuaianstok'))
			$this->terminate("detailpenyesuaianstoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailperpindahanbarang'))
			$this->terminate("detailperpindahanbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailpo'))
			$this->terminate("detailpolist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailpromo'))
			$this->terminate("detailpromolist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailrekmeddok'))
			$this->terminate("detailrekmeddoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailrekmedpenjualan'))
			$this->terminate("detailrekmedpenjualanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailrekmedterapis'))
			$this->terminate("detailrekmedterapislist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailretur'))
			$this->terminate("detailreturlist.php");
		if ($Security->allowList(CurrentProjectID() . 'detailterimabarang'))
			$this->terminate("detailterimabaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenisbarang'))
			$this->terminate("jenisbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'jurnal'))
			$this->terminate("jurnallist.php");
		if ($Security->allowList(CurrentProjectID() . 'kartu.php'))
			$this->terminate("kartu.php");
		if ($Security->allowList(CurrentProjectID() . 'kartustok'))
			$this->terminate("kartustoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'kasir.php'))
			$this->terminate("kasir.php");
		if ($Security->allowList(CurrentProjectID() . 'kategoribarang'))
			$this->terminate("kategoribaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'kirimbarang'))
			$this->terminate("kirimbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'komposisi'))
			$this->terminate("komposisilist.php");
		if ($Security->allowList(CurrentProjectID() . 'kota'))
			$this->terminate("kotalist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_penggunaan_kartu.php'))
			$this->terminate("laporan_penggunaan_kartu.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_penjualan_harian.php'))
			$this->terminate("laporan_penjualan_harian.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_rm_pasien.php'))
			$this->terminate("laporan_rm_pasien.php");
		if ($Security->allowList(CurrentProjectID() . 'm_agama'))
			$this->terminate("m_agamalist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_akun'))
			$this->terminate("m_akunlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_bank'))
			$this->terminate("m_banklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_barang'))
			$this->terminate("m_baranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_fee'))
			$this->terminate("m_feelist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_gudang'))
			$this->terminate("m_gudanglist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_hargajual'))
			$this->terminate("m_hargajuallist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_hargajual_detail'))
			$this->terminate("m_hargajual_detaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_jabatan'))
			$this->terminate("m_jabatanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_jadwalpegawai'))
			$this->terminate("m_jadwalpegawailist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_kartu'))
			$this->terminate("m_kartulist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_kas'))
			$this->terminate("m_kaslist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_kategoripelanggan'))
			$this->terminate("m_kategoripelangganlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_klinik'))
			$this->terminate("m_kliniklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_member'))
			$this->terminate("m_memberlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_pegawai'))
			$this->terminate("m_pegawailist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_pelanggan'))
			$this->terminate("m_pelangganlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_penyimpanan'))
			$this->terminate("m_penyimpananlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_satuan_barang'))
			$this->terminate("m_satuan_baranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_supplier'))
			$this->terminate("m_supplierlist.php");
		if ($Security->allowList(CurrentProjectID() . 'mutasi_kas'))
			$this->terminate("mutasi_kaslist.php");
		if ($Security->allowList(CurrentProjectID() . 'pekerjaan'))
			$this->terminate("pekerjaanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'penggunaan_kartu'))
			$this->terminate("penggunaan_kartulist.php");
		if ($Security->allowList(CurrentProjectID() . 'penyesuaianstok'))
			$this->terminate("penyesuaianstoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'permintaanpembelian'))
			$this->terminate("permintaanpembelianlist.php");
		if ($Security->allowList(CurrentProjectID() . 'perpindahanbarang'))
			$this->terminate("perpindahanbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'pos_antrian'))
			$this->terminate("pos_antrianlist.php");
		if ($Security->allowList(CurrentProjectID() . 'promo'))
			$this->terminate("promolist.php");
		if ($Security->allowList(CurrentProjectID() . 'purchaseorder'))
			$this->terminate("purchaseorderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'rekap.php'))
			$this->terminate("rekap.php");
		if ($Security->allowList(CurrentProjectID() . 'rekapstok'))
			$this->terminate("rekapstoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'rekmeddokter'))
			$this->terminate("rekmeddokterlist.php");
		if ($Security->allowList(CurrentProjectID() . 'report_rekap'))
			$this->terminate("report_rekapsmry.php");
		if ($Security->allowList(CurrentProjectID() . 'returbarang'))
			$this->terminate("returbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'stok'))
			$this->terminate("stoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'struk_antrian.php'))
			$this->terminate("struk_antrian.php");
		if ($Security->allowList(CurrentProjectID() . 'struk_belanja.php'))
			$this->terminate("struk_belanja.php");
		if ($Security->allowList(CurrentProjectID() . 'subkategoribarang'))
			$this->terminate("subkategoribaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'terimabarang'))
			$this->terminate("terimabaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'tombol_antrian.php'))
			$this->terminate("tombol_antrian.php");
		if ($Security->allowList(CurrentProjectID() . 'tombol_antrian_baru.php'))
			$this->terminate("tombol antrian baru/tombol_antrian_baru.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevelpermissions'))
			$this->terminate("userlevelpermissionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevels'))
			$this->terminate("userlevelslist.php");
		if ($Security->allowList(CurrentProjectID() . 'users'))
			$this->terminate("userslist.php");
		if ($Security->allowList(CurrentProjectID() . 'V_kartustok'))
			$this->terminate("V_kartustoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_stokbarang'))
			$this->terminate("v_stokbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'view_hargajual'))
			$this->terminate("view_hargajuallist.php");
		if ($Security->allowList(CurrentProjectID() . 'view_rm_pasien'))
			$this->terminate("view_rm_pasienlist.php");
		if ($Security->allowList(CurrentProjectID() . 'wp_reservasi'))
			$this->terminate("wp_reservasilist.php");
		if ($Security->allowList(CurrentProjectID() . 'wp_terapis'))
			$this->terminate("wp_terapislist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_penjualan_produk.php'))
			$this->terminate("laporan_penjualan_produk.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_penjualan_perawatan.php'))
			$this->terminate("laporan_penjualan_perawatan.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_penjualan_best.php'))
			$this->terminate("laporan_penjualan_best.php");
		if ($Security->allowList(CurrentProjectID() . 'm_jenis_member'))
			$this->terminate("m_jenis_memberlist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_member_baru.php'))
			$this->terminate("laporan_member_baru.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_kedatangan_harian.php'))
			$this->terminate("laporan_kedatangan_harian.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_transaksi_member.php'))
			$this->terminate("laporan_transaksi_member.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_omset.php'))
			$this->terminate("laporan_omset.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_minimum_stok.php'))
			$this->terminate("laporan_minimum_stok.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_analisa_pengadaan.php'))
			$this->terminate("laporan_analisa_pengadaan.php");
		if ($Security->allowList(CurrentProjectID() . 'm_poin'))
			$this->terminate("m_poinlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_komisi'))
			$this->terminate("m_komisilist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_komisi_kinerja_detail'))
			$this->terminate("m_komisi_kinerja_detaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_komisi_recall_detail'))
			$this->terminate("m_komisi_recall_detaillist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_penggunaan_voucher.php'))
			$this->terminate("laporan_penggunaan_voucher.php");
		if ($Security->allowList(CurrentProjectID() . 'nonjual'))
			$this->terminate("nonjuallist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_diskon_harian.php'))
			$this->terminate("laporan_diskon_harian.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tags'))
			$this->terminate("m_tagslist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_status_barang'))
			$this->terminate("m_status_baranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'detail_nonjual'))
			$this->terminate("detail_nonjuallist.php");
		if ($Security->allowList(CurrentProjectID() . 'view_rmd'))
			$this->terminate("view_rmdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_mutasi_bank.php'))
			$this->terminate("laporan_mutasi_bank.php");
		if ($Security->allowList(CurrentProjectID() . 'transaksi_komisi'))
			$this->terminate("transaksi_komisilist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_perhitungan_komisi_pegawai.php'))
			$this->terminate("laporan_perhitungan_komisi_pegawai.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_customer.php'))
			$this->terminate("laporan_customer.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_perhitungan_komisi_detail.php'))
			$this->terminate("laporan_perhitungan_komisi_detail.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_diskon_harian_global.php'))
			$this->terminate("laporan_diskon_harian_global.php");
		if ($Security->allowList(CurrentProjectID() . 'm_rekening'))
			$this->terminate("m_rekeninglist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tipepelanggan'))
			$this->terminate("m_tipepelangganlist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_kas'))
			$this->terminate("laporan_kaslist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_rekening'))
			$this->terminate("laporan_rekeninglist.php");
		if ($Security->allowList(CurrentProjectID() . 'kartupoin'))
			$this->terminate("kartupoinlist.php");
		if ($Security->allowList(CurrentProjectID() . 'log_checkpelanggan'))
			$this->terminate("log_checkpelangganlist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_saldo_kas.php'))
			$this->terminate("laporan_saldo_kas.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_saldo_rekening.php'))
			$this->terminate("laporan_saldo_rekening.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_analisa_po_mingguan.php'))
			$this->terminate("laporan_analisa_po_mingguan.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_kartupoin.php'))
			$this->terminate("laporan_kartupoin.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_posisi_poin.php'))
			$this->terminate("laporan_posisi_poin.php");
		if ($Security->allowList(CurrentProjectID() . 'audittrail'))
			$this->terminate("audittraillist.php");
		if ($Security->allowList(CurrentProjectID() . 'komposisi.php'))
			$this->terminate("komposisi.php");
		if ($Security->allowList(CurrentProjectID() . 'detailpenyesuaianpoin'))
			$this->terminate("detailpenyesuaianpoinlist.php");
		if ($Security->allowList(CurrentProjectID() . 'penyesuaian_poin'))
			$this->terminate("penyesuaian_poinlist.php");
		if ($Security->allowList(CurrentProjectID() . 'view_member'))
			$this->terminate("view_memberlist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_stokhargajual.php'))
			$this->terminate("laporan_stokhargajual.php");
		if ($Security->allowList(CurrentProjectID() . 'Dasbor.php'))
			$this->terminate("Dasbor.php");
		if ($Security->allowList(CurrentProjectID() . 'detailterimagudang'))
			$this->terminate("detailterimagudanglist.php");
		if ($Security->allowList(CurrentProjectID() . 'terimagudang'))
			$this->terminate("terimagudanglist.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_akumulasi_produk_klinik.php'))
			$this->terminate("laporan_akumulasi_produk_klinik.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_best_seller_klinik.php'))
			$this->terminate("laporan_best_seller_klinik.php");
		if ($Security->allowList(CurrentProjectID() . 'laporan_summary_penjualan.php'))
			$this->terminate("laporan_summary_penjualan.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>