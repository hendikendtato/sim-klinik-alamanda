<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

/**
 * Page class
 */
class penjualan_delete extends penjualan
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{8C91985A-7590-4658-895B-4BCC6B46002F}";

	// Table name
	public $TableName = 'penjualan';

	// Page object name
	public $PageObjName = "penjualan_delete";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

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

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (penjualan)
		if (!isset($GLOBALS["penjualan"]) || get_class($GLOBALS["penjualan"]) == PROJECT_NAMESPACE . "penjualan") {
			$GLOBALS["penjualan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["penjualan"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'penjualan');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (users)
		$UserTable = $UserTable ?: new users();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $penjualan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($penjualan);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $TotalRecords = 0;
	public $RecordCount;
	public $RecKeys = [];
	public $StartRowCount = 1;
	public $RowCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canDelete()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canDelete()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("penjualanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->kode_penjualan->setVisibility();
		$this->id_pelanggan->setVisibility();
		$this->id_member->Visible = FALSE;
		$this->waktu->setVisibility();
		$this->diskon_persen->Visible = FALSE;
		$this->diskon_rupiah->Visible = FALSE;
		$this->ppn->Visible = FALSE;
		$this->total->setVisibility();
		$this->bayar->setVisibility();
		$this->bayar_non_tunai->Visible = FALSE;
		$this->total_non_tunai_charge->setVisibility();
		$this->keterangan->Visible = FALSE;
		$this->id_klinik->Visible = FALSE;
		$this->id_rmd->Visible = FALSE;
		$this->metode_pembayaran->setVisibility();
		$this->id_bank->Visible = FALSE;
		$this->id_kartu->Visible = FALSE;
		$this->sales->Visible = FALSE;
		$this->dok_be_wajah->Visible = FALSE;
		$this->be_body->Visible = FALSE;
		$this->medis->Visible = FALSE;
		$this->dokter->Visible = FALSE;
		$this->id_kartubank->setVisibility();
		$this->id_kas->setVisibility();
		$this->charge->setVisibility();
		$this->klaim_poin->setVisibility();
		$this->total_penukaran_poin->setVisibility();
		$this->ongkir->Visible = FALSE;
		$this->_action->Visible = FALSE;
		$this->status->setVisibility();
		$this->status_void->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->id_pelanggan);
		$this->setupLookupOptions($this->id_member);
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->id_rmd);
		$this->setupLookupOptions($this->id_bank);
		$this->setupLookupOptions($this->id_kartu);
		$this->setupLookupOptions($this->sales);
		$this->setupLookupOptions($this->dok_be_wajah);
		$this->setupLookupOptions($this->be_body);
		$this->setupLookupOptions($this->medis);
		$this->setupLookupOptions($this->dokter);
		$this->setupLookupOptions($this->id_kartubank);
		$this->setupLookupOptions($this->id_kas);

		// Check permission
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("penjualanlist.php");
			return;
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("penjualanlist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("penjualanlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->kode_penjualan->setDbValue($row['kode_penjualan']);
		$this->id_pelanggan->setDbValue($row['id_pelanggan']);
		if (array_key_exists('EV__id_pelanggan', $rs->fields)) {
			$this->id_pelanggan->VirtualValue = $rs->fields('EV__id_pelanggan'); // Set up virtual field value
		} else {
			$this->id_pelanggan->VirtualValue = ""; // Clear value
		}
		$this->id_member->setDbValue($row['id_member']);
		$this->waktu->setDbValue($row['waktu']);
		$this->diskon_persen->setDbValue($row['diskon_persen']);
		$this->diskon_rupiah->setDbValue($row['diskon_rupiah']);
		$this->ppn->setDbValue($row['ppn']);
		$this->total->setDbValue($row['total']);
		$this->bayar->setDbValue($row['bayar']);
		$this->bayar_non_tunai->setDbValue($row['bayar_non_tunai']);
		$this->total_non_tunai_charge->setDbValue($row['total_non_tunai_charge']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->id_rmd->setDbValue($row['id_rmd']);
		$this->metode_pembayaran->setDbValue($row['metode_pembayaran']);
		$this->id_bank->setDbValue($row['id_bank']);
		$this->id_kartu->setDbValue($row['id_kartu']);
		$this->sales->setDbValue($row['sales']);
		$this->dok_be_wajah->setDbValue($row['dok_be_wajah']);
		$this->be_body->setDbValue($row['be_body']);
		$this->medis->setDbValue($row['medis']);
		$this->dokter->setDbValue($row['dokter']);
		$this->id_kartubank->setDbValue($row['id_kartubank']);
		$this->id_kas->setDbValue($row['id_kas']);
		$this->charge->setDbValue($row['charge']);
		$this->klaim_poin->setDbValue($row['klaim_poin']);
		$this->total_penukaran_poin->setDbValue($row['total_penukaran_poin']);
		$this->ongkir->setDbValue($row['ongkir']);
		$this->_action->setDbValue($row['action']);
		$this->status->setDbValue($row['status']);
		$this->status_void->setDbValue($row['status_void']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['kode_penjualan'] = NULL;
		$row['id_pelanggan'] = NULL;
		$row['id_member'] = NULL;
		$row['waktu'] = NULL;
		$row['diskon_persen'] = NULL;
		$row['diskon_rupiah'] = NULL;
		$row['ppn'] = NULL;
		$row['total'] = NULL;
		$row['bayar'] = NULL;
		$row['bayar_non_tunai'] = NULL;
		$row['total_non_tunai_charge'] = NULL;
		$row['keterangan'] = NULL;
		$row['id_klinik'] = NULL;
		$row['id_rmd'] = NULL;
		$row['metode_pembayaran'] = NULL;
		$row['id_bank'] = NULL;
		$row['id_kartu'] = NULL;
		$row['sales'] = NULL;
		$row['dok_be_wajah'] = NULL;
		$row['be_body'] = NULL;
		$row['medis'] = NULL;
		$row['dokter'] = NULL;
		$row['id_kartubank'] = NULL;
		$row['id_kas'] = NULL;
		$row['charge'] = NULL;
		$row['klaim_poin'] = NULL;
		$row['total_penukaran_poin'] = NULL;
		$row['ongkir'] = NULL;
		$row['action'] = NULL;
		$row['status'] = NULL;
		$row['status_void'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->total->FormValue == $this->total->CurrentValue && is_numeric(ConvertToFloatString($this->total->CurrentValue)))
			$this->total->CurrentValue = ConvertToFloatString($this->total->CurrentValue);

		// Convert decimal values if posted back
		if ($this->bayar->FormValue == $this->bayar->CurrentValue && is_numeric(ConvertToFloatString($this->bayar->CurrentValue)))
			$this->bayar->CurrentValue = ConvertToFloatString($this->bayar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->total_non_tunai_charge->FormValue == $this->total_non_tunai_charge->CurrentValue && is_numeric(ConvertToFloatString($this->total_non_tunai_charge->CurrentValue)))
			$this->total_non_tunai_charge->CurrentValue = ConvertToFloatString($this->total_non_tunai_charge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->charge->FormValue == $this->charge->CurrentValue && is_numeric(ConvertToFloatString($this->charge->CurrentValue)))
			$this->charge->CurrentValue = ConvertToFloatString($this->charge->CurrentValue);

		// Convert decimal values if posted back
		if ($this->klaim_poin->FormValue == $this->klaim_poin->CurrentValue && is_numeric(ConvertToFloatString($this->klaim_poin->CurrentValue)))
			$this->klaim_poin->CurrentValue = ConvertToFloatString($this->klaim_poin->CurrentValue);

		// Convert decimal values if posted back
		if ($this->total_penukaran_poin->FormValue == $this->total_penukaran_poin->CurrentValue && is_numeric(ConvertToFloatString($this->total_penukaran_poin->CurrentValue)))
			$this->total_penukaran_poin->CurrentValue = ConvertToFloatString($this->total_penukaran_poin->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";
			$this->kode_penjualan->TooltipValue = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";
			$this->id_pelanggan->TooltipValue = "";

			// waktu
			$this->waktu->LinkCustomAttributes = "";
			$this->waktu->HrefValue = "";
			$this->waktu->TooltipValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
			$this->total->TooltipValue = "";

			// bayar
			$this->bayar->LinkCustomAttributes = "";
			$this->bayar->HrefValue = "";
			$this->bayar->TooltipValue = "";

			// total_non_tunai_charge
			$this->total_non_tunai_charge->LinkCustomAttributes = "";
			$this->total_non_tunai_charge->HrefValue = "";
			$this->total_non_tunai_charge->TooltipValue = "";

			// metode_pembayaran
			$this->metode_pembayaran->LinkCustomAttributes = "";
			$this->metode_pembayaran->HrefValue = "";
			$this->metode_pembayaran->TooltipValue = "";

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		$conn->beginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
		} else {
			$conn->rollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("penjualanlist.php"), "", $this->TableVar, TRUE);
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_id_pelanggan":
					break;
				case "x_id_member":
					break;
				case "x_id_klinik":
					break;
				case "x_id_rmd":
					break;
				case "x_metode_pembayaran":
					break;
				case "x_id_bank":
					break;
				case "x_id_kartu":
					$lookupFilter = function() {
						return "`jenis` = 'Voucher'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_sales":
					break;
				case "x_dok_be_wajah":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 2";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_be_body":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 3";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_medis":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 4";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_dokter":
					$lookupFilter = function() {
						return "`jabatan_pegawai` = 1";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_id_kartubank":
					$lookupFilter = function() {
						return "`jenis` <> 'Voucher'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_id_kas":
					break;
				case "x_status":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_id_pelanggan":
							break;
						case "x_id_member":
							break;
						case "x_id_klinik":
							break;
						case "x_id_rmd":
							break;
						case "x_id_bank":
							$row[1] = FormatNumber($row[1], 0, -2, -2, -2);
							$row['df'] = $row[1];
							break;
						case "x_id_kartu":
							break;
						case "x_sales":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_dok_be_wajah":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_be_body":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_medis":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_dokter":
							$row[2] = FormatNumber($row[2], 0, -2, -2, -2);
							$row['df2'] = $row[2];
							break;
						case "x_id_kartubank":
							break;
						case "x_id_kas":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
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
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
} // End class
?>