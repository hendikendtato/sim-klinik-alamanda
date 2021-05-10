<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class kartustok_delete extends kartustok
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'kartustok';

	// Page object name
	public $PageObjName = "kartustok_delete";

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

		// Table object (kartustok)
		if (!isset($GLOBALS["kartustok"]) || get_class($GLOBALS["kartustok"]) == PROJECT_NAMESPACE . "kartustok") {
			$GLOBALS["kartustok"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["kartustok"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Table object (V_kartustok)
		if (!isset($GLOBALS['V_kartustok']))
			$GLOBALS['V_kartustok'] = new V_kartustok();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'kartustok');

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
		global $kartustok;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($kartustok);
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
			$key .= @$ar['id_kartustok'];
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
			$this->id_kartustok->Visible = FALSE;
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
					$this->terminate(GetUrl("kartustoklist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_kartustok->Visible = FALSE;
		$this->id_barang->setVisibility();
		$this->id_klinik->setVisibility();
		$this->tanggal->setVisibility();
		$this->id_terimabarang->setVisibility();
		$this->id_terimagudang->setVisibility();
		$this->id_penjualan->setVisibility();
		$this->id_kirimbarang->setVisibility();
		$this->id_nonjual->Visible = FALSE;
		$this->id_retur->setVisibility();
		$this->id_penyesuaian->setVisibility();
		$this->stok_awal->setVisibility();
		$this->masuk->setVisibility();
		$this->masuk_penyesuaian->setVisibility();
		$this->keluar->setVisibility();
		$this->keluar_nonjual->setVisibility();
		$this->keluar_penyesuaian->setVisibility();
		$this->keluar_kirim->setVisibility();
		$this->retur->setVisibility();
		$this->stok_akhir->setVisibility();
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
		$this->setupLookupOptions($this->id_barang);
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->id_terimabarang);
		$this->setupLookupOptions($this->id_terimagudang);
		$this->setupLookupOptions($this->id_penjualan);
		$this->setupLookupOptions($this->id_kirimbarang);
		$this->setupLookupOptions($this->id_nonjual);
		$this->setupLookupOptions($this->id_retur);
		$this->setupLookupOptions($this->id_penyesuaian);

		// Check permission
		if (!$Security->canDelete()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("kartustoklist.php");
			return;
		}

		// Set up master/detail parameters
		$this->setupMasterParms();

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("kartustoklist.php"); // Prevent SQL injection, return to list
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
			$this->CurrentAction = "delete"; // Delete record directly
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
				$this->terminate($this->getReturnUrl()); // Return to caller
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("kartustoklist.php"); // Return to list
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
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
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
		$this->id_kartustok->setDbValue($row['id_kartustok']);
		$this->id_barang->setDbValue($row['id_barang']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->tanggal->setDbValue($row['tanggal']);
		$this->id_terimabarang->setDbValue($row['id_terimabarang']);
		$this->id_terimagudang->setDbValue($row['id_terimagudang']);
		$this->id_penjualan->setDbValue($row['id_penjualan']);
		$this->id_kirimbarang->setDbValue($row['id_kirimbarang']);
		$this->id_nonjual->setDbValue($row['id_nonjual']);
		$this->id_retur->setDbValue($row['id_retur']);
		$this->id_penyesuaian->setDbValue($row['id_penyesuaian']);
		$this->stok_awal->setDbValue($row['stok_awal']);
		$this->masuk->setDbValue($row['masuk']);
		$this->masuk_penyesuaian->setDbValue($row['masuk_penyesuaian']);
		$this->keluar->setDbValue($row['keluar']);
		$this->keluar_nonjual->setDbValue($row['keluar_nonjual']);
		$this->keluar_penyesuaian->setDbValue($row['keluar_penyesuaian']);
		$this->keluar_kirim->setDbValue($row['keluar_kirim']);
		$this->retur->setDbValue($row['retur']);
		$this->stok_akhir->setDbValue($row['stok_akhir']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_kartustok'] = NULL;
		$row['id_barang'] = NULL;
		$row['id_klinik'] = NULL;
		$row['tanggal'] = NULL;
		$row['id_terimabarang'] = NULL;
		$row['id_terimagudang'] = NULL;
		$row['id_penjualan'] = NULL;
		$row['id_kirimbarang'] = NULL;
		$row['id_nonjual'] = NULL;
		$row['id_retur'] = NULL;
		$row['id_penyesuaian'] = NULL;
		$row['stok_awal'] = NULL;
		$row['masuk'] = NULL;
		$row['masuk_penyesuaian'] = NULL;
		$row['keluar'] = NULL;
		$row['keluar_nonjual'] = NULL;
		$row['keluar_penyesuaian'] = NULL;
		$row['keluar_kirim'] = NULL;
		$row['retur'] = NULL;
		$row['stok_akhir'] = NULL;
		return $row;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->stok_awal->FormValue == $this->stok_awal->CurrentValue && is_numeric(ConvertToFloatString($this->stok_awal->CurrentValue)))
			$this->stok_awal->CurrentValue = ConvertToFloatString($this->stok_awal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->masuk->FormValue == $this->masuk->CurrentValue && is_numeric(ConvertToFloatString($this->masuk->CurrentValue)))
			$this->masuk->CurrentValue = ConvertToFloatString($this->masuk->CurrentValue);

		// Convert decimal values if posted back
		if ($this->masuk_penyesuaian->FormValue == $this->masuk_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->masuk_penyesuaian->CurrentValue)))
			$this->masuk_penyesuaian->CurrentValue = ConvertToFloatString($this->masuk_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar->FormValue == $this->keluar->CurrentValue && is_numeric(ConvertToFloatString($this->keluar->CurrentValue)))
			$this->keluar->CurrentValue = ConvertToFloatString($this->keluar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_nonjual->FormValue == $this->keluar_nonjual->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_nonjual->CurrentValue)))
			$this->keluar_nonjual->CurrentValue = ConvertToFloatString($this->keluar_nonjual->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_penyesuaian->FormValue == $this->keluar_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_penyesuaian->CurrentValue)))
			$this->keluar_penyesuaian->CurrentValue = ConvertToFloatString($this->keluar_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_kirim->FormValue == $this->keluar_kirim->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_kirim->CurrentValue)))
			$this->keluar_kirim->CurrentValue = ConvertToFloatString($this->keluar_kirim->CurrentValue);

		// Convert decimal values if posted back
		if ($this->retur->FormValue == $this->retur->CurrentValue && is_numeric(ConvertToFloatString($this->retur->CurrentValue)))
			$this->retur->CurrentValue = ConvertToFloatString($this->retur->CurrentValue);

		// Convert decimal values if posted back
		if ($this->stok_akhir->FormValue == $this->stok_akhir->CurrentValue && is_numeric(ConvertToFloatString($this->stok_akhir->CurrentValue)))
			$this->stok_akhir->CurrentValue = ConvertToFloatString($this->stok_akhir->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_kartustok
		// id_barang
		// id_klinik
		// tanggal
		// id_terimabarang
		// id_terimagudang
		// id_penjualan
		// id_kirimbarang
		// id_nonjual
		// id_retur
		// id_penyesuaian
		// stok_awal
		// masuk
		// masuk_penyesuaian
		// keluar
		// keluar_nonjual
		// keluar_penyesuaian
		// keluar_kirim
		// retur
		// stok_akhir

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_kartustok
			$this->id_kartustok->ViewValue = $this->id_kartustok->CurrentValue;
			$this->id_kartustok->ViewCustomAttributes = "";

			// id_barang
			$this->id_barang->ViewValue = $this->id_barang->CurrentValue;
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

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->ViewCustomAttributes = "";

			// id_terimabarang
			$this->id_terimabarang->ViewValue = $this->id_terimabarang->CurrentValue;
			$curVal = strval($this->id_terimabarang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimabarang->ViewValue = $this->id_terimabarang->lookupCacheOption($curVal);
				if ($this->id_terimabarang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimabarang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_terimabarang->ViewValue = $this->id_terimabarang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimabarang->ViewValue = $this->id_terimabarang->CurrentValue;
					}
				}
			} else {
				$this->id_terimabarang->ViewValue = NULL;
			}
			$this->id_terimabarang->ViewCustomAttributes = "";

			// id_terimagudang
			$this->id_terimagudang->ViewValue = $this->id_terimagudang->CurrentValue;
			$curVal = strval($this->id_terimagudang->CurrentValue);
			if ($curVal != "") {
				$this->id_terimagudang->ViewValue = $this->id_terimagudang->lookupCacheOption($curVal);
				if ($this->id_terimagudang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_terimagudang`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_terimagudang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_terimagudang->ViewValue = $this->id_terimagudang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_terimagudang->ViewValue = $this->id_terimagudang->CurrentValue;
					}
				}
			} else {
				$this->id_terimagudang->ViewValue = NULL;
			}
			$this->id_terimagudang->ViewCustomAttributes = "";

			// id_penjualan
			$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
			$curVal = strval($this->id_penjualan->CurrentValue);
			if ($curVal != "") {
				$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
				if ($this->id_penjualan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_penjualan->ViewValue = $this->id_penjualan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
					}
				}
			} else {
				$this->id_penjualan->ViewValue = NULL;
			}
			$this->id_penjualan->ViewCustomAttributes = "";

			// id_kirimbarang
			$this->id_kirimbarang->ViewValue = $this->id_kirimbarang->CurrentValue;
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

			// id_nonjual
			$this->id_nonjual->ViewValue = $this->id_nonjual->CurrentValue;
			$curVal = strval($this->id_nonjual->CurrentValue);
			if ($curVal != "") {
				$this->id_nonjual->ViewValue = $this->id_nonjual->lookupCacheOption($curVal);
				if ($this->id_nonjual->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_nonjual`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_nonjual->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_nonjual->ViewValue = $this->id_nonjual->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_nonjual->ViewValue = $this->id_nonjual->CurrentValue;
					}
				}
			} else {
				$this->id_nonjual->ViewValue = NULL;
			}
			$this->id_nonjual->ViewCustomAttributes = "";

			// id_retur
			$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
			$curVal = strval($this->id_retur->CurrentValue);
			if ($curVal != "") {
				$this->id_retur->ViewValue = $this->id_retur->lookupCacheOption($curVal);
				if ($this->id_retur->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_retur`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_retur->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_retur->ViewValue = $this->id_retur->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_retur->ViewValue = $this->id_retur->CurrentValue;
					}
				}
			} else {
				$this->id_retur->ViewValue = NULL;
			}
			$this->id_retur->ViewCustomAttributes = "";

			// id_penyesuaian
			$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
			$curVal = strval($this->id_penyesuaian->CurrentValue);
			if ($curVal != "") {
				$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->lookupCacheOption($curVal);
				if ($this->id_penyesuaian->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_penyesuaianstok`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penyesuaian->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penyesuaian->ViewValue = $this->id_penyesuaian->CurrentValue;
					}
				}
			} else {
				$this->id_penyesuaian->ViewValue = NULL;
			}
			$this->id_penyesuaian->ViewCustomAttributes = "";

			// stok_awal
			$this->stok_awal->ViewValue = $this->stok_awal->CurrentValue;
			$this->stok_awal->ViewValue = FormatNumber($this->stok_awal->ViewValue, 2, -2, -2, -2);
			$this->stok_awal->ViewCustomAttributes = "";

			// masuk
			$this->masuk->ViewValue = $this->masuk->CurrentValue;
			$this->masuk->ViewValue = FormatNumber($this->masuk->ViewValue, 2, -2, -2, -2);
			$this->masuk->ViewCustomAttributes = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->ViewValue = $this->masuk_penyesuaian->CurrentValue;
			$this->masuk_penyesuaian->ViewValue = FormatNumber($this->masuk_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->masuk_penyesuaian->ViewCustomAttributes = "";

			// keluar
			$this->keluar->ViewValue = $this->keluar->CurrentValue;
			$this->keluar->ViewValue = FormatNumber($this->keluar->ViewValue, 2, -2, -2, -2);
			$this->keluar->ViewCustomAttributes = "";

			// keluar_nonjual
			$this->keluar_nonjual->ViewValue = $this->keluar_nonjual->CurrentValue;
			$this->keluar_nonjual->ViewValue = FormatNumber($this->keluar_nonjual->ViewValue, 2, -2, -2, -2);
			$this->keluar_nonjual->ViewCustomAttributes = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
			$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->keluar_penyesuaian->ViewCustomAttributes = "";

			// keluar_kirim
			$this->keluar_kirim->ViewValue = $this->keluar_kirim->CurrentValue;
			$this->keluar_kirim->ViewValue = FormatNumber($this->keluar_kirim->ViewValue, 2, -2, -2, -2);
			$this->keluar_kirim->ViewCustomAttributes = "";

			// retur
			$this->retur->ViewValue = $this->retur->CurrentValue;
			$this->retur->ViewValue = FormatNumber($this->retur->ViewValue, 2, -2, -2, -2);
			$this->retur->ViewCustomAttributes = "";

			// stok_akhir
			$this->stok_akhir->ViewValue = $this->stok_akhir->CurrentValue;
			$this->stok_akhir->ViewValue = FormatNumber($this->stok_akhir->ViewValue, 2, -2, -2, -2);
			$this->stok_akhir->ViewCustomAttributes = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";
			$this->id_barang->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";
			$this->tanggal->TooltipValue = "";

			// id_terimabarang
			$this->id_terimabarang->LinkCustomAttributes = "";
			$this->id_terimabarang->HrefValue = "";
			$this->id_terimabarang->TooltipValue = "";

			// id_terimagudang
			$this->id_terimagudang->LinkCustomAttributes = "";
			$this->id_terimagudang->HrefValue = "";
			$this->id_terimagudang->TooltipValue = "";

			// id_penjualan
			$this->id_penjualan->LinkCustomAttributes = "";
			$this->id_penjualan->HrefValue = "";
			$this->id_penjualan->TooltipValue = "";

			// id_kirimbarang
			$this->id_kirimbarang->LinkCustomAttributes = "";
			$this->id_kirimbarang->HrefValue = "";
			$this->id_kirimbarang->TooltipValue = "";

			// id_retur
			$this->id_retur->LinkCustomAttributes = "";
			$this->id_retur->HrefValue = "";
			$this->id_retur->TooltipValue = "";

			// id_penyesuaian
			$this->id_penyesuaian->LinkCustomAttributes = "";
			$this->id_penyesuaian->HrefValue = "";
			$this->id_penyesuaian->TooltipValue = "";

			// stok_awal
			$this->stok_awal->LinkCustomAttributes = "";
			$this->stok_awal->HrefValue = "";
			$this->stok_awal->TooltipValue = "";

			// masuk
			$this->masuk->LinkCustomAttributes = "";
			$this->masuk->HrefValue = "";
			$this->masuk->TooltipValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";
			$this->masuk_penyesuaian->TooltipValue = "";

			// keluar
			$this->keluar->LinkCustomAttributes = "";
			$this->keluar->HrefValue = "";
			$this->keluar->TooltipValue = "";

			// keluar_nonjual
			$this->keluar_nonjual->LinkCustomAttributes = "";
			$this->keluar_nonjual->HrefValue = "";
			$this->keluar_nonjual->TooltipValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";
			$this->keluar_penyesuaian->TooltipValue = "";

			// keluar_kirim
			$this->keluar_kirim->LinkCustomAttributes = "";
			$this->keluar_kirim->HrefValue = "";
			$this->keluar_kirim->TooltipValue = "";

			// retur
			$this->retur->LinkCustomAttributes = "";
			$this->retur->HrefValue = "";
			$this->retur->TooltipValue = "";

			// stok_akhir
			$this->stok_akhir->LinkCustomAttributes = "";
			$this->stok_akhir->HrefValue = "";
			$this->stok_akhir->TooltipValue = "";
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
				$thisKey .= $row['id_kartustok'];
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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "V_kartustok") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("id_barang"))) !== NULL) {
					$GLOBALS["V_kartustok"]->id->setQueryStringValue($parm);
					$this->id_barang->setQueryStringValue($GLOBALS["V_kartustok"]->id->QueryStringValue);
					$this->id_barang->setSessionValue($this->id_barang->QueryStringValue);
					if (!is_numeric($GLOBALS["V_kartustok"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "V_kartustok") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("id_barang"))) !== NULL) {
					$GLOBALS["V_kartustok"]->id->setFormValue($parm);
					$this->id_barang->setFormValue($GLOBALS["V_kartustok"]->id->FormValue);
					$this->id_barang->setSessionValue($this->id_barang->FormValue);
					if (!is_numeric($GLOBALS["V_kartustok"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "V_kartustok") {
				if ($this->id_barang->CurrentValue == "")
					$this->id_barang->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("kartustoklist.php"), "", $this->TableVar, TRUE);
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
				case "x_id_barang":
					break;
				case "x_id_klinik":
					break;
				case "x_id_terimabarang":
					break;
				case "x_id_terimagudang":
					break;
				case "x_id_penjualan":
					break;
				case "x_id_kirimbarang":
					break;
				case "x_id_nonjual":
					break;
				case "x_id_retur":
					break;
				case "x_id_penyesuaian":
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
						case "x_id_barang":
							break;
						case "x_id_klinik":
							break;
						case "x_id_terimabarang":
							break;
						case "x_id_terimagudang":
							break;
						case "x_id_penjualan":
							break;
						case "x_id_kirimbarang":
							break;
						case "x_id_nonjual":
							break;
						case "x_id_retur":
							break;
						case "x_id_penyesuaian":
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