<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class m_pegawai_search extends m_pegawai
{

	// Page ID
	public $PageID = "search";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'm_pegawai';

	// Page object name
	public $PageObjName = "m_pegawai_search";

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

		// Table object (m_pegawai)
		if (!isset($GLOBALS["m_pegawai"]) || get_class($GLOBALS["m_pegawai"]) == PROJECT_NAMESPACE . "m_pegawai") {
			$GLOBALS["m_pegawai"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_pegawai"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'search');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_pegawai');

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
		global $m_pegawai;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_pegawai);
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
					if ($pageName == "m_pegawaiview.php")
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
			$key .= @$ar['id_pegawai'];
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
			$this->id_pegawai->Visible = FALSE;
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
					$this->terminate(GetUrl("m_pegawailist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_pegawai->Visible = FALSE;
		$this->nama_pegawai->setVisibility();
		$this->nama_lengkap->setVisibility();
		$this->jenis_pegawai->setVisibility();
		$this->nik_pegawai->setVisibility();
		$this->agama_pegawai->setVisibility();
		$this->tgllahir_pegawai->setVisibility();
		$this->alamat_pegawai->setVisibility();
		$this->hp_pegawai->setVisibility();
		$this->pendidikan_pegawai->setVisibility();
		$this->jurusan_pegawai->setVisibility();
		$this->spesialis_pegawai->setVisibility();
		$this->jabatan_pegawai->setVisibility();
		$this->status_pegawai->setVisibility();
		$this->tarif_pegawai->setVisibility();
		$this->id_klinik->setVisibility();
		$this->status->setVisibility();
		$this->target->Visible = FALSE;
		$this->nilai_komisi->Visible = FALSE;
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
		$this->setupLookupOptions($this->agama_pegawai);
		$this->setupLookupOptions($this->jabatan_pegawai);
		$this->setupLookupOptions($this->id_klinik);

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
					$srchStr = "m_pegawailist.php" . "?" . $srchStr;
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
		$this->buildSearchUrl($srchUrl, $this->nama_pegawai); // nama_pegawai
		$this->buildSearchUrl($srchUrl, $this->nama_lengkap); // nama_lengkap
		$this->buildSearchUrl($srchUrl, $this->jenis_pegawai); // jenis_pegawai
		$this->buildSearchUrl($srchUrl, $this->nik_pegawai); // nik_pegawai
		$this->buildSearchUrl($srchUrl, $this->agama_pegawai); // agama_pegawai
		$this->buildSearchUrl($srchUrl, $this->tgllahir_pegawai); // tgllahir_pegawai
		$this->buildSearchUrl($srchUrl, $this->alamat_pegawai); // alamat_pegawai
		$this->buildSearchUrl($srchUrl, $this->hp_pegawai); // hp_pegawai
		$this->buildSearchUrl($srchUrl, $this->pendidikan_pegawai); // pendidikan_pegawai
		$this->buildSearchUrl($srchUrl, $this->jurusan_pegawai); // jurusan_pegawai
		$this->buildSearchUrl($srchUrl, $this->spesialis_pegawai); // spesialis_pegawai
		$this->buildSearchUrl($srchUrl, $this->jabatan_pegawai); // jabatan_pegawai
		$this->buildSearchUrl($srchUrl, $this->status_pegawai); // status_pegawai
		$this->buildSearchUrl($srchUrl, $this->tarif_pegawai); // tarif_pegawai
		$this->buildSearchUrl($srchUrl, $this->id_klinik); // id_klinik
		$this->buildSearchUrl($srchUrl, $this->status); // status
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
		if ($this->nama_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->nama_lengkap->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jenis_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->nik_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->agama_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tgllahir_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->alamat_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->hp_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->pendidikan_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jurusan_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->spesialis_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->jabatan_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->status_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->tarif_pegawai->AdvancedSearch->post())
			$got = TRUE;
		if ($this->id_klinik->AdvancedSearch->post())
			$got = TRUE;
		if ($this->status->AdvancedSearch->post())
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
		// status
		// target
		// nilai_komisi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// status
			if (strval($this->status->CurrentValue) != "") {
				$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
			} else {
				$this->status->ViewValue = NULL;
			}
			$this->status->ViewCustomAttributes = "";

			// target
			$this->target->ViewValue = $this->target->CurrentValue;
			$this->target->ViewValue = FormatNumber($this->target->ViewValue, 0, -2, -2, -2);
			$this->target->ViewCustomAttributes = "";

			// nilai_komisi
			$this->nilai_komisi->ViewValue = $this->nilai_komisi->CurrentValue;
			$this->nilai_komisi->ViewValue = FormatNumber($this->nilai_komisi->ViewValue, 0, -2, -2, -2);
			$this->nilai_komisi->ViewCustomAttributes = "";

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_SEARCH) { // Search row

			// nama_pegawai
			$this->nama_pegawai->EditAttrs["class"] = "form-control";
			$this->nama_pegawai->EditCustomAttributes = "";
			if (!$this->nama_pegawai->Raw)
				$this->nama_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->nama_pegawai->AdvancedSearch->SearchValue);
			$this->nama_pegawai->EditValue = HtmlEncode($this->nama_pegawai->AdvancedSearch->SearchValue);
			$this->nama_pegawai->PlaceHolder = RemoveHtml($this->nama_pegawai->caption());

			// nama_lengkap
			$this->nama_lengkap->EditAttrs["class"] = "form-control";
			$this->nama_lengkap->EditCustomAttributes = "";
			if (!$this->nama_lengkap->Raw)
				$this->nama_lengkap->AdvancedSearch->SearchValue = HtmlDecode($this->nama_lengkap->AdvancedSearch->SearchValue);
			$this->nama_lengkap->EditValue = HtmlEncode($this->nama_lengkap->AdvancedSearch->SearchValue);
			$this->nama_lengkap->PlaceHolder = RemoveHtml($this->nama_lengkap->caption());

			// jenis_pegawai
			$this->jenis_pegawai->EditCustomAttributes = "";
			$this->jenis_pegawai->EditValue = $this->jenis_pegawai->options(FALSE);

			// nik_pegawai
			$this->nik_pegawai->EditAttrs["class"] = "form-control";
			$this->nik_pegawai->EditCustomAttributes = "";
			if (!$this->nik_pegawai->Raw)
				$this->nik_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->nik_pegawai->AdvancedSearch->SearchValue);
			$this->nik_pegawai->EditValue = HtmlEncode($this->nik_pegawai->AdvancedSearch->SearchValue);
			$this->nik_pegawai->PlaceHolder = RemoveHtml($this->nik_pegawai->caption());

			// agama_pegawai
			$this->agama_pegawai->EditAttrs["class"] = "form-control";
			$this->agama_pegawai->EditCustomAttributes = "";
			$curVal = trim(strval($this->agama_pegawai->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->agama_pegawai->AdvancedSearch->ViewValue = $this->agama_pegawai->lookupCacheOption($curVal);
			else
				$this->agama_pegawai->AdvancedSearch->ViewValue = $this->agama_pegawai->Lookup !== NULL && is_array($this->agama_pegawai->Lookup->Options) ? $curVal : NULL;
			if ($this->agama_pegawai->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->agama_pegawai->EditValue = array_values($this->agama_pegawai->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_agama`" . SearchString("=", $this->agama_pegawai->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->agama_pegawai->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->agama_pegawai->EditValue = $arwrk;
			}

			// tgllahir_pegawai
			$this->tgllahir_pegawai->EditAttrs["class"] = "form-control";
			$this->tgllahir_pegawai->EditCustomAttributes = "";
			$this->tgllahir_pegawai->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tgllahir_pegawai->AdvancedSearch->SearchValue, 0), 8));
			$this->tgllahir_pegawai->PlaceHolder = RemoveHtml($this->tgllahir_pegawai->caption());

			// alamat_pegawai
			$this->alamat_pegawai->EditAttrs["class"] = "form-control";
			$this->alamat_pegawai->EditCustomAttributes = "";
			if (!$this->alamat_pegawai->Raw)
				$this->alamat_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->alamat_pegawai->AdvancedSearch->SearchValue);
			$this->alamat_pegawai->EditValue = HtmlEncode($this->alamat_pegawai->AdvancedSearch->SearchValue);
			$this->alamat_pegawai->PlaceHolder = RemoveHtml($this->alamat_pegawai->caption());

			// hp_pegawai
			$this->hp_pegawai->EditAttrs["class"] = "form-control";
			$this->hp_pegawai->EditCustomAttributes = "";
			if (!$this->hp_pegawai->Raw)
				$this->hp_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->hp_pegawai->AdvancedSearch->SearchValue);
			$this->hp_pegawai->EditValue = HtmlEncode($this->hp_pegawai->AdvancedSearch->SearchValue);
			$this->hp_pegawai->PlaceHolder = RemoveHtml($this->hp_pegawai->caption());

			// pendidikan_pegawai
			$this->pendidikan_pegawai->EditAttrs["class"] = "form-control";
			$this->pendidikan_pegawai->EditCustomAttributes = "";
			if (!$this->pendidikan_pegawai->Raw)
				$this->pendidikan_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->pendidikan_pegawai->AdvancedSearch->SearchValue);
			$this->pendidikan_pegawai->EditValue = HtmlEncode($this->pendidikan_pegawai->AdvancedSearch->SearchValue);
			$this->pendidikan_pegawai->PlaceHolder = RemoveHtml($this->pendidikan_pegawai->caption());

			// jurusan_pegawai
			$this->jurusan_pegawai->EditAttrs["class"] = "form-control";
			$this->jurusan_pegawai->EditCustomAttributes = "";
			if (!$this->jurusan_pegawai->Raw)
				$this->jurusan_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->jurusan_pegawai->AdvancedSearch->SearchValue);
			$this->jurusan_pegawai->EditValue = HtmlEncode($this->jurusan_pegawai->AdvancedSearch->SearchValue);
			$this->jurusan_pegawai->PlaceHolder = RemoveHtml($this->jurusan_pegawai->caption());

			// spesialis_pegawai
			$this->spesialis_pegawai->EditAttrs["class"] = "form-control";
			$this->spesialis_pegawai->EditCustomAttributes = "";
			if (!$this->spesialis_pegawai->Raw)
				$this->spesialis_pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->spesialis_pegawai->AdvancedSearch->SearchValue);
			$this->spesialis_pegawai->EditValue = HtmlEncode($this->spesialis_pegawai->AdvancedSearch->SearchValue);
			$this->spesialis_pegawai->PlaceHolder = RemoveHtml($this->spesialis_pegawai->caption());

			// jabatan_pegawai
			$this->jabatan_pegawai->EditAttrs["class"] = "form-control";
			$this->jabatan_pegawai->EditCustomAttributes = "";
			$curVal = trim(strval($this->jabatan_pegawai->AdvancedSearch->SearchValue));
			if ($curVal != "")
				$this->jabatan_pegawai->AdvancedSearch->ViewValue = $this->jabatan_pegawai->lookupCacheOption($curVal);
			else
				$this->jabatan_pegawai->AdvancedSearch->ViewValue = $this->jabatan_pegawai->Lookup !== NULL && is_array($this->jabatan_pegawai->Lookup->Options) ? $curVal : NULL;
			if ($this->jabatan_pegawai->AdvancedSearch->ViewValue !== NULL) { // Load from cache
				$this->jabatan_pegawai->EditValue = array_values($this->jabatan_pegawai->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jabatan_pegawai->AdvancedSearch->SearchValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jabatan_pegawai->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jabatan_pegawai->EditValue = $arwrk;
			}

			// status_pegawai
			$this->status_pegawai->EditCustomAttributes = "";
			$this->status_pegawai->EditValue = $this->status_pegawai->options(FALSE);

			// tarif_pegawai
			$this->tarif_pegawai->EditAttrs["class"] = "form-control";
			$this->tarif_pegawai->EditCustomAttributes = "";
			$this->tarif_pegawai->EditValue = HtmlEncode($this->tarif_pegawai->AdvancedSearch->SearchValue);
			$this->tarif_pegawai->PlaceHolder = RemoveHtml($this->tarif_pegawai->caption());

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

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->options(FALSE);
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
		if (!CheckDate($this->tgllahir_pegawai->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tgllahir_pegawai->errorMessage());
		}
		if (!CheckInteger($this->tarif_pegawai->AdvancedSearch->SearchValue)) {
			AddMessage($SearchError, $this->tarif_pegawai->errorMessage());
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
		$this->nama_pegawai->AdvancedSearch->load();
		$this->nama_lengkap->AdvancedSearch->load();
		$this->jenis_pegawai->AdvancedSearch->load();
		$this->nik_pegawai->AdvancedSearch->load();
		$this->agama_pegawai->AdvancedSearch->load();
		$this->tgllahir_pegawai->AdvancedSearch->load();
		$this->alamat_pegawai->AdvancedSearch->load();
		$this->hp_pegawai->AdvancedSearch->load();
		$this->pendidikan_pegawai->AdvancedSearch->load();
		$this->jurusan_pegawai->AdvancedSearch->load();
		$this->spesialis_pegawai->AdvancedSearch->load();
		$this->jabatan_pegawai->AdvancedSearch->load();
		$this->status_pegawai->AdvancedSearch->load();
		$this->tarif_pegawai->AdvancedSearch->load();
		$this->id_klinik->AdvancedSearch->load();
		$this->status->AdvancedSearch->load();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_pegawailist.php"), "", $this->TableVar, TRUE);
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
				case "x_jenis_pegawai":
					break;
				case "x_agama_pegawai":
					break;
				case "x_jabatan_pegawai":
					break;
				case "x_status_pegawai":
					break;
				case "x_id_klinik":
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
						case "x_agama_pegawai":
							break;
						case "x_jabatan_pegawai":
							break;
						case "x_id_klinik":
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