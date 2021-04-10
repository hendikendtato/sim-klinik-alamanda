<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

/**
 * Page class
 */
class m_pelanggan_search extends m_pelanggan
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{8C91985A-7590-4658-895B-4BCC6B46002F}";

	// Table name
	public $TableName = 'm_pelanggan';

	// Page object name
	public $PageObjName = "m_pelanggan_search";

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

		// Table object (m_pelanggan)
		if (!isset($GLOBALS["m_pelanggan"]) || get_class($GLOBALS["m_pelanggan"]) == PROJECT_NAMESPACE . "m_pelanggan") {
			$GLOBALS["m_pelanggan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_pelanggan"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_pelanggan');

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
		global $m_pelanggan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_pelanggan);
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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "m_pelangganview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
			$key .= @$ar['id_pelanggan'];
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
			$this->id_pelanggan->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
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
	public $FormClassName = "ew-horizontal ew-form ew-search-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SearchError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canSearch()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("m_pelangganlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_pelanggan->setVisibility();
		$this->kode_pelanggan->setVisibility();
		$this->noktp_pelanggan->setVisibility();
		$this->nama_pelanggan->setVisibility();
		$this->jenis_pelanggan->setVisibility();
		$this->tgllahir_pelanggan->setVisibility();
		$this->pekerjaan_pelanggan->setVisibility();
		$this->kota_pelanggan->setVisibility();
		$this->alamat_pelanggan->setVisibility();
		$this->telpon_pelanggan->setVisibility();
		$this->hp_pelanggan->setVisibility();
		$this->id_klinik->setVisibility();
		$this->tgl_daftar->setVisibility();
		$this->kategori->setVisibility();
		$this->tipe->setVisibility();
		$this->tgl_terakhir_transaksi->Visible = FALSE;
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
		$this->setupLookupOptions($this->pekerjaan_pelanggan);
		$this->setupLookupOptions($this->kota_pelanggan);
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->kategori);
		$this->setupLookupOptions($this->tipe);

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		if ($this->isPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = Post("action");
			if ($this->isSearch()) {

				// Build search string for advanced search, remove blank field
				$this->loadSearchValues(); // Get search values
				if ($this->validateSearch()) {
					$srchStr = $this->buildAdvancedSearch();
				} else {
					$srchStr = "";
					$this->setFailureMessage($SearchError);
				}
				if ($srchStr != "") {
					$srchStr = $this->getUrlParm($srchStr);
					$srchStr = "m_pelangganlist.php" . "?" . $srchStr;
					$this->terminate($srchStr); // Go to list page
				}
			}
		}

		// Restore search settings from Session
		if ($SearchError == "")
			$this->loadAdvancedSearch();

		// Render row for search
		$this->RowType = ROWTYPE_SEARCH;
		$this->resetAttributes();
		$this->renderRow();
	}

	// Build advanced search
	protected function buildAdvancedSearch()
	{
		$srchUrl = "";
		$this->buildSearchUrl($srchUrl, $this->id_pelanggan); // id_pelanggan
		$this->buildSearchUrl($srchUrl, $this->kode_pelanggan); // kode_pelanggan
		$this->buildSearchUrl($srchUrl, $this->noktp_pelanggan); // noktp_pelanggan
		$this->buildSearchUrl($srchUrl, $this->nama_pelanggan); // nama_pelanggan
		$this->buildSearchUrl($srchUrl, $this->jenis_pelanggan); // jenis_pelanggan
		$this->buildSearchUrl($srchUrl, $this->tgllahir_pelanggan); // tgllahir_pelanggan
		$this->buildSearchUrl($srchUrl, $this->pekerjaan_pelanggan); // pekerjaan_pelanggan
		$this->buildSearchUrl($srchUrl, $this->kota_pelanggan); // kota_pelanggan
		$this->buildSearchUrl($srchUrl, $this->alamat_pelanggan); // alamat_pelanggan
		$this->buildSearchUrl($srchUrl, $this->telpon_pelanggan); // telpon_pelanggan
		$this->buildSearchUrl($srchUrl, $this->hp_pelanggan); // hp_pelanggan
		$this->buildSearchUrl($srchUrl, $this->id_klinik); // id_klinik
		$this->buildSearchUrl($srchUrl, $this->tgl_daftar); // tgl_daftar
		$this->buildSearchUrl($srchUrl, $this->kategori); // kategori
		$this->buildSearchUrl($srchUrl, $this->tipe); // tipe
		if ($srchUrl != "")
			$srchUrl .= "&";
		$srchUrl .= "cmd=search";
		return $srchUrl;
	}

	// Build search URL
	protected function buildSearchUrl(&$url, &$fld, $oprOnly = FALSE)
	{
		global $CurrentForm;
		$wrk = "";
		$fldParm = $fld->Param;
		$fldVal = $CurrentForm->getValue("x_$fldParm");
		$fldOpr = $CurrentForm->getValue("z_$fldParm");
		$fldCond = $CurrentForm->getValue("v_$fldParm");
		$fldVal2 = $CurrentForm->getValue("y_$fldParm");
		$fldOpr2 = $CurrentForm->getValue("w_$fldParm");
		if (is_array($fldVal))
			$fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
		if (is_array($fldVal2))
			$fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
		$fldOpr = strtoupper(trim($fldOpr));
		$fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
		if ($fldOpr == "BETWEEN") {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			}
		} else {
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
			if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
				$wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
					"&z_" . $fldParm . "=" . urlencode($fldOpr);
			} elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
				$wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
			}
			$isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
				($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
			if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
					"&w_" . $fldParm . "=" . urlencode($fldOpr2);
			} elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
				if ($wrk != "")
					$wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
				$wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
			}
		}
		if ($wrk != "") {
			if ($url != "")
				$url .= "&";
			$url .= $wrk;
		}
	}
	protected function searchValueIsNumeric($fld, $value)
	{
		if (IsFloatFormat($fld->Type))
			$value = ConvertToFloatString($value);
		return is_numeric($value);
	}

	// Load search values for validation
	protected function loadSearchValues()
	{

		// Load search values
		$got = FALSE;
		if ($this->id_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kode_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->noktp_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->nama_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jenis_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tgllahir_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pekerjaan_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kota_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->alamat_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->telpon_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->hp_pelanggan->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_klinik->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tgl_daftar->AdvancedSearch->post())
			$got = TRUE;
		if ($this->kategori->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tipe->AdvancedSearch->post())
			$got = TRUE;
		return $got;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id_pelanggan
		// kode_pelanggan
		// noktp_pelanggan
		// nama_pelanggan
		// jenis_pelanggan
		// tgllahir_pelanggan
		// pekerjaan_pelanggan
		// kota_pelanggan
		// alamat_pelanggan
		// telpon_pelanggan
		// hp_pelanggan
		// id_klinik
		// tgl_daftar
		// kategori
		// tipe
		// tgl_terakhir_transaksi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_pelanggan
			$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
			$this->id_pelanggan->ViewCustomAttributes = "";

			// kode_pelanggan
			$this->kode_pelanggan->ViewValue = $this->kode_pelanggan->CurrentValue;
			$this->kode_pelanggan->ViewCustomAttributes = "";

			// noktp_pelanggan
			$this->noktp_pelanggan->ViewValue = $this->noktp_pelanggan->CurrentValue;
			$this->noktp_pelanggan->ViewCustomAttributes = "";

			// nama_pelanggan
			$this->nama_pelanggan->ViewValue = $this->nama_pelanggan->CurrentValue;
			$this->nama_pelanggan->ViewCustomAttributes = "";

			// jenis_pelanggan
			if (strval($this->jenis_pelanggan->CurrentValue) != "") {
				$this->jenis_pelanggan->ViewValue = $this->jenis_pelanggan->optionCaption($this->jenis_pelanggan->CurrentValue);
			} else {
				$this->jenis_pelanggan->ViewValue = NULL;
			}
			$this->jenis_pelanggan->ViewCustomAttributes = "";

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->ViewValue = $this->tgllahir_pelanggan->CurrentValue;
			$this->tgllahir_pelanggan->ViewValue = FormatDateTime($this->tgllahir_pelanggan->ViewValue, 0);
			$this->tgllahir_pelanggan->ViewCustomAttributes = "";

			// pekerjaan_pelanggan
			$curVal = strval($this->pekerjaan_pelanggan->CurrentValue);
			if ($curVal != "") {
				$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->lookupCacheOption($curVal);
				if ($this->pekerjaan_pelanggan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pekerjaan_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->CurrentValue;
					}
				}
			} else {
				$this->pekerjaan_pelanggan->ViewValue = NULL;
			}
			$this->pekerjaan_pelanggan->ViewCustomAttributes = "";

			// kota_pelanggan
			$curVal = strval($this->kota_pelanggan->CurrentValue);
			if ($curVal != "") {
				$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->lookupCacheOption($curVal);
				if ($this->kota_pelanggan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kota_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->CurrentValue;
					}
				}
			} else {
				$this->kota_pelanggan->ViewValue = NULL;
			}
			$this->kota_pelanggan->ViewCustomAttributes = "";

			// alamat_pelanggan
			$this->alamat_pelanggan->ViewValue = $this->alamat_pelanggan->CurrentValue;
			$this->alamat_pelanggan->ViewCustomAttributes = "";

			// telpon_pelanggan
			$this->telpon_pelanggan->ViewValue = $this->telpon_pelanggan->CurrentValue;
			$this->telpon_pelanggan->ViewCustomAttributes = "";

			// hp_pelanggan
			$this->hp_pelanggan->ViewValue = $this->hp_pelanggan->CurrentValue;
			$this->hp_pelanggan->ViewCustomAttributes = "";

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

			// tgl_daftar
			$this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
			$this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 7);
			$this->tgl_daftar->ViewCustomAttributes = "";

			// kategori
			$curVal = strval($this->kategori->CurrentValue);
			if ($curVal != "") {
				$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
				if ($this->kategori->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_kategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

			// tipe
			$curVal = strval($this->tipe->CurrentValue);
			if ($curVal != "") {
				$this->tipe->ViewValue = $this->tipe->lookupCacheOption($curVal);
				if ($this->tipe->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_tipe`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->tipe->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tipe->ViewValue = $this->tipe->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tipe->ViewValue = $this->tipe->CurrentValue;
					}
				}
			} else {
				$this->tipe->ViewValue = NULL;
			}
			$this->tipe->ViewCustomAttributes = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";
			$this->id_pelanggan->TooltipValue = "";

			// kode_pelanggan
			$this->kode_pelanggan->LinkCustomAttributes = "";
			$this->kode_pelanggan->HrefValue = "";
			$this->kode_pelanggan->TooltipValue = "";

			// noktp_pelanggan
			$this->noktp_pelanggan->LinkCustomAttributes = "";
			$this->noktp_pelanggan->HrefValue = "";
			$this->noktp_pelanggan->TooltipValue = "";

			// nama_pelanggan
			$this->nama_pelanggan->LinkCustomAttributes = "";
			$this->nama_pelanggan->HrefValue = "";
			$this->nama_pelanggan->TooltipValue = "";

			// jenis_pelanggan
			$this->jenis_pelanggan->LinkCustomAttributes = "";
			$this->jenis_pelanggan->HrefValue = "";
			$this->jenis_pelanggan->TooltipValue = "";

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->LinkCustomAttributes = "";
			$this->tgllahir_pelanggan->HrefValue = "";
			$this->tgllahir_pelanggan->TooltipValue = "";

			// pekerjaan_pelanggan
			$this->pekerjaan_pelanggan->LinkCustomAttributes = "";
			$this->pekerjaan_pelanggan->HrefValue = "";
			$this->pekerjaan_pelanggan->TooltipValue = "";

			// kota_pelanggan
			$this->kota_pelanggan->LinkCustomAttributes = "";
			$this->kota_pelanggan->HrefValue = "";
			$this->kota_pelanggan->TooltipValue = "";

			// alamat_pelanggan
			$this->alamat_pelanggan->LinkCustomAttributes = "";
			$this->alamat_pelanggan->HrefValue = "";
			$this->alamat_pelanggan->TooltipValue = "";

			// telpon_pelanggan
			$this->telpon_pelanggan->LinkCustomAttributes = "";
			$this->telpon_pelanggan->HrefValue = "";
			$this->telpon_pelanggan->TooltipValue = "";

			// hp_pelanggan
			$this->hp_pelanggan->LinkCustomAttributes = "";
			$this->hp_pelanggan->HrefValue = "";
			$this->hp_pelanggan->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";
			$this->tgl_daftar->TooltipValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";
			$this->kategori->TooltipValue = "";

			// tipe
			$this->tipe->LinkCustomAttributes = "";
			$this->tipe->HrefValue = "";
			$this->tipe->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// id_pelanggan
			$this->id_pelanggan->EditAttrs["class"] = "form-control";
			$this->id_pelanggan->EditCustomAttributes = "";
			$this->id_pelanggan->EditValue = HtmlEncode($this->id_pelanggan->AdvancedSearch->SearchValue);
			$this->id_pelanggan->PlaceHolder = RemoveHtml($this->id_pelanggan->caption());

			// kode_pelanggan
			$this->kode_pelanggan->EditAttrs["class"] = "form-control";
			$this->kode_pelanggan->EditCustomAttributes = "";
			if (!$this->kode_pelanggan->Raw)
				$this->kode_pelanggan->AdvancedSearch->SearchValue = HtmlDecode($this->kode_pelanggan->AdvancedSearch->SearchValue);
			$this->kode_pelanggan->EditValue = HtmlEncode($this->kode_pelanggan->AdvancedSearch->SearchValue);
			$this->kode_pelanggan->PlaceHolder = RemoveHtml($this->kode_pelanggan->caption());

			// noktp_pelanggan
			$this->noktp_pelanggan->EditAttrs["class"] = "form-control";
			$this->noktp_pelanggan->EditCustomAttributes = "";
			if (!$this->noktp_pelanggan->Raw)
				$this->noktp_pelanggan->AdvancedSearch->SearchValue = HtmlDecode($this->noktp_pelanggan->AdvancedSearch->SearchValue);
			$this->noktp_pelanggan->EditValue = HtmlEncode($this->noktp_pelanggan->AdvancedSearch->SearchValue);
			$this->noktp_pelanggan->PlaceHolder = RemoveHtml($this->noktp_pelanggan->caption());

			// nama_pelanggan
			$this->nama_pelanggan->EditAttrs["class"] = "form-control";
			$this->nama_pelanggan->EditCustomAttributes = "";
			if (!$this->nama_pelanggan->Raw)
				$this->nama_pelanggan->AdvancedSearch->SearchValue = HtmlDecode($this->nama_pelanggan->AdvancedSearch->SearchValue);
			$this->nama_pelanggan->EditValue = HtmlEncode($this->nama_pelanggan->AdvancedSearch->SearchValue);
			$this->nama_pelanggan->PlaceHolder = RemoveHtml($this->nama_pelanggan->caption());

			// jenis_pelanggan
			$this->jenis_pelanggan->EditCustomAttributes = "";
			$this->jenis_pelanggan->EditValue = $this->jenis_pelanggan->options(FALSE);

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->EditAttrs["class"] = "form-control";
			$this->tgllahir_pelanggan->EditCustomAttributes = "";
			$this->tgllahir_pelanggan->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgllahir_pelanggan->AdvancedSearch->SearchValue, 0), 8));
			$this->tgllahir_pelanggan->PlaceHolder = RemoveHtml($this->tgllahir_pelanggan->caption());

			// pekerjaan_pelanggan
			$this->pekerjaan_pelanggan->EditAttrs["class"] = "form-control";
			$this->pekerjaan_pelanggan->EditCustomAttributes = "";
			$curVal = trim(strval($this->pekerjaan_pelanggan->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->pekerjaan_pelanggan->AdvancedSearch->ViewValue = $this->pekerjaan_pelanggan->lookupCacheOption($curVal);
			else
				$this->pekerjaan_pelanggan->AdvancedSearch->ViewValue = $this->pekerjaan_pelanggan->Lookup !== NULL && is_array($this->pekerjaan_pelanggan->Lookup->Options) ? $curVal : NULL;
			if ($this->pekerjaan_pelanggan->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->pekerjaan_pelanggan->EditValue = array_values($this->pekerjaan_pelanggan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->pekerjaan_pelanggan->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pekerjaan_pelanggan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pekerjaan_pelanggan->EditValue = $arwrk;
			}

			// kota_pelanggan
			$this->kota_pelanggan->EditAttrs["class"] = "form-control";
			$this->kota_pelanggan->EditCustomAttributes = "";
			$curVal = trim(strval($this->kota_pelanggan->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kota_pelanggan->AdvancedSearch->ViewValue = $this->kota_pelanggan->lookupCacheOption($curVal);
			else
				$this->kota_pelanggan->AdvancedSearch->ViewValue = $this->kota_pelanggan->Lookup !== NULL && is_array($this->kota_pelanggan->Lookup->Options) ? $curVal : NULL;
			if ($this->kota_pelanggan->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kota_pelanggan->EditValue = array_values($this->kota_pelanggan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->kota_pelanggan->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kota_pelanggan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kota_pelanggan->EditValue = $arwrk;
			}

			// alamat_pelanggan
			$this->alamat_pelanggan->EditAttrs["class"] = "form-control";
			$this->alamat_pelanggan->EditCustomAttributes = "";
			if (!$this->alamat_pelanggan->Raw)
				$this->alamat_pelanggan->AdvancedSearch->SearchValue = HtmlDecode($this->alamat_pelanggan->AdvancedSearch->SearchValue);
			$this->alamat_pelanggan->EditValue = HtmlEncode($this->alamat_pelanggan->AdvancedSearch->SearchValue);
			$this->alamat_pelanggan->PlaceHolder = RemoveHtml($this->alamat_pelanggan->caption());

			// telpon_pelanggan
			$this->telpon_pelanggan->EditAttrs["class"] = "form-control";
			$this->telpon_pelanggan->EditCustomAttributes = "";
			if (!$this->telpon_pelanggan->Raw)
				$this->telpon_pelanggan->AdvancedSearch->SearchValue = HtmlDecode($this->telpon_pelanggan->AdvancedSearch->SearchValue);
			$this->telpon_pelanggan->EditValue = HtmlEncode($this->telpon_pelanggan->AdvancedSearch->SearchValue);
			$this->telpon_pelanggan->PlaceHolder = RemoveHtml($this->telpon_pelanggan->caption());

			// hp_pelanggan
			$this->hp_pelanggan->EditAttrs["class"] = "form-control";
			$this->hp_pelanggan->EditCustomAttributes = "";
			if (!$this->hp_pelanggan->Raw)
				$this->hp_pelanggan->AdvancedSearch->SearchValue = HtmlDecode($this->hp_pelanggan->AdvancedSearch->SearchValue);
			$this->hp_pelanggan->EditValue = HtmlEncode($this->hp_pelanggan->AdvancedSearch->SearchValue);
			$this->hp_pelanggan->PlaceHolder = RemoveHtml($this->hp_pelanggan->caption());

			// id_klinik
			$this->id_klinik->EditAttrs["class"] = "form-control";
			$this->id_klinik->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_klinik->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->id_klinik->AdvancedSearch->ViewValue = $this->id_klinik->lookupCacheOption($curVal);
			else
				$this->id_klinik->AdvancedSearch->ViewValue = $this->id_klinik->Lookup !== NULL && is_array($this->id_klinik->Lookup->Options) ? $curVal : NULL;
			if ($this->id_klinik->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->id_klinik->EditValue = array_values($this->id_klinik->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->id_klinik->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_klinik->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_klinik->EditValue = $arwrk;
			}

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgl_daftar->AdvancedSearch->SearchValue, 7), 7));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// kategori
			$this->kategori->EditAttrs["class"] = "form-control";
			$this->kategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->kategori->AdvancedSearch->ViewValue = $this->kategori->lookupCacheOption($curVal);
			else
				$this->kategori->AdvancedSearch->ViewValue = $this->kategori->Lookup !== NULL && is_array($this->kategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->kategori->EditValue = array_values($this->kategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kategori`" . SearchString("=", $this->kategori->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori->EditValue = $arwrk;
			}

			// tipe
			$this->tipe->EditAttrs["class"] = "form-control";
			$this->tipe->EditCustomAttributes = "";
			$curVal = trim(strval($this->tipe->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->tipe->AdvancedSearch->ViewValue = $this->tipe->lookupCacheOption($curVal);
			else
				$this->tipe->AdvancedSearch->ViewValue = $this->tipe->Lookup !== NULL && is_array($this->tipe->Lookup->Options) ? $curVal : NULL;
			if ($this->tipe->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->tipe->EditValue = array_values($this->tipe->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_tipe`" . SearchString("=", $this->tipe->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->tipe->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->tipe->EditValue = $arwrk;
			}
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	protected function validateSearch()
	{
		global $SearchError;

		// Initialize
		$SearchError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return TRUE;
		if (!CheckInteger($this->id_pelanggan->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->id_pelanggan->errorMessage());
		}
		if (!CheckDate($this->tgllahir_pelanggan->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tgllahir_pelanggan->errorMessage());
		}
		if (!CheckEuroDate($this->tgl_daftar->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tgl_daftar->errorMessage());
		}

		// Return validate result
		$validateSearch = ($SearchError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateSearch = $validateSearch && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($SearchError, $formCustomError);
		}
		return $validateSearch;
	}

	// Load advanced search
	public function loadAdvancedSearch()
	{
		$this->id_pelanggan->AdvancedSearch->load();
		$this->kode_pelanggan->AdvancedSearch->load();
		$this->noktp_pelanggan->AdvancedSearch->load();
		$this->nama_pelanggan->AdvancedSearch->load();
		$this->jenis_pelanggan->AdvancedSearch->load();
		$this->tgllahir_pelanggan->AdvancedSearch->load();
		$this->pekerjaan_pelanggan->AdvancedSearch->load();
		$this->kota_pelanggan->AdvancedSearch->load();
		$this->alamat_pelanggan->AdvancedSearch->load();
		$this->telpon_pelanggan->AdvancedSearch->load();
		$this->hp_pelanggan->AdvancedSearch->load();
		$this->id_klinik->AdvancedSearch->load();
		$this->tgl_daftar->AdvancedSearch->load();
		$this->kategori->AdvancedSearch->load();
		$this->tipe->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_pelangganlist.php"), "", $this->TableVar, TRUE);
		$pageId = "search";
		$Breadcrumb->add("search", $pageId, $url);
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
				case "x_jenis_pelanggan":
					break;
				case "x_pekerjaan_pelanggan":
					break;
				case "x_kota_pelanggan":
					break;
				case "x_id_klinik":
					break;
				case "x_kategori":
					break;
				case "x_tipe":
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
						case "x_pekerjaan_pelanggan":
							break;
						case "x_kota_pelanggan":
							break;
						case "x_id_klinik":
							break;
						case "x_kategori":
							break;
						case "x_tipe":
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

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>