<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class m_jadwalpegawai_add extends m_jadwalpegawai
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'm_jadwalpegawai';

	// Page object name
	public $PageObjName = "m_jadwalpegawai_add";

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

		// Table object (m_jadwalpegawai)
		if (!isset($GLOBALS["m_jadwalpegawai"]) || get_class($GLOBALS["m_jadwalpegawai"]) == PROJECT_NAMESPACE . "m_jadwalpegawai") {
			$GLOBALS["m_jadwalpegawai"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_jadwalpegawai"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_jadwalpegawai');

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
		global $m_jadwalpegawai;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_jadwalpegawai);
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
					if ($pageName == "m_jadwalpegawaiview.php")
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
			$key .= @$ar['id_jadwalpeg'];
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
			$this->id_jadwalpeg->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("m_jadwalpegawailist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_jadwalpeg->Visible = FALSE;
		$this->tindakan_jadwalpeg->setVisibility();
		$this->idpeg->setVisibility();
		$this->tanggal_jadwalpeg->setVisibility();
		$this->jam_jadwalpeg->setVisibility();
		$this->keterangan_peg->setVisibility();
		$this->status_jadwalpeg->setVisibility();
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
		$this->setupLookupOptions($this->idpeg);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("m_jadwalpegawailist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id_jadwalpeg") !== NULL) {
				$this->id_jadwalpeg->setQueryStringValue(Get("id_jadwalpeg"));
				$this->setKey("id_jadwalpeg", $this->id_jadwalpeg->CurrentValue); // Set up key
			} else {
				$this->setKey("id_jadwalpeg", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("m_jadwalpegawailist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "m_jadwalpegawailist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "m_jadwalpegawaiview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_jadwalpeg->CurrentValue = NULL;
		$this->id_jadwalpeg->OldValue = $this->id_jadwalpeg->CurrentValue;
		$this->tindakan_jadwalpeg->CurrentValue = NULL;
		$this->tindakan_jadwalpeg->OldValue = $this->tindakan_jadwalpeg->CurrentValue;
		$this->idpeg->CurrentValue = NULL;
		$this->idpeg->OldValue = $this->idpeg->CurrentValue;
		$this->tanggal_jadwalpeg->CurrentValue = NULL;
		$this->tanggal_jadwalpeg->OldValue = $this->tanggal_jadwalpeg->CurrentValue;
		$this->jam_jadwalpeg->CurrentValue = NULL;
		$this->jam_jadwalpeg->OldValue = $this->jam_jadwalpeg->CurrentValue;
		$this->keterangan_peg->CurrentValue = NULL;
		$this->keterangan_peg->OldValue = $this->keterangan_peg->CurrentValue;
		$this->status_jadwalpeg->CurrentValue = NULL;
		$this->status_jadwalpeg->OldValue = $this->status_jadwalpeg->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'tindakan_jadwalpeg' first before field var 'x_tindakan_jadwalpeg'
		$val = $CurrentForm->hasValue("tindakan_jadwalpeg") ? $CurrentForm->getValue("tindakan_jadwalpeg") : $CurrentForm->getValue("x_tindakan_jadwalpeg");
		if (!$this->tindakan_jadwalpeg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tindakan_jadwalpeg->Visible = FALSE; // Disable update for API request
			else
				$this->tindakan_jadwalpeg->setFormValue($val);
		}

		// Check field name 'idpeg' first before field var 'x_idpeg'
		$val = $CurrentForm->hasValue("idpeg") ? $CurrentForm->getValue("idpeg") : $CurrentForm->getValue("x_idpeg");
		if (!$this->idpeg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idpeg->Visible = FALSE; // Disable update for API request
			else
				$this->idpeg->setFormValue($val);
		}

		// Check field name 'tanggal_jadwalpeg' first before field var 'x_tanggal_jadwalpeg'
		$val = $CurrentForm->hasValue("tanggal_jadwalpeg") ? $CurrentForm->getValue("tanggal_jadwalpeg") : $CurrentForm->getValue("x_tanggal_jadwalpeg");
		if (!$this->tanggal_jadwalpeg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tanggal_jadwalpeg->Visible = FALSE; // Disable update for API request
			else
				$this->tanggal_jadwalpeg->setFormValue($val);
			$this->tanggal_jadwalpeg->CurrentValue = UnFormatDateTime($this->tanggal_jadwalpeg->CurrentValue, 0);
		}

		// Check field name 'jam_jadwalpeg' first before field var 'x_jam_jadwalpeg'
		$val = $CurrentForm->hasValue("jam_jadwalpeg") ? $CurrentForm->getValue("jam_jadwalpeg") : $CurrentForm->getValue("x_jam_jadwalpeg");
		if (!$this->jam_jadwalpeg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->jam_jadwalpeg->Visible = FALSE; // Disable update for API request
			else
				$this->jam_jadwalpeg->setFormValue($val);
			$this->jam_jadwalpeg->CurrentValue = UnFormatDateTime($this->jam_jadwalpeg->CurrentValue, 4);
		}

		// Check field name 'keterangan_peg' first before field var 'x_keterangan_peg'
		$val = $CurrentForm->hasValue("keterangan_peg") ? $CurrentForm->getValue("keterangan_peg") : $CurrentForm->getValue("x_keterangan_peg");
		if (!$this->keterangan_peg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->keterangan_peg->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan_peg->setFormValue($val);
		}

		// Check field name 'status_jadwalpeg' first before field var 'x_status_jadwalpeg'
		$val = $CurrentForm->hasValue("status_jadwalpeg") ? $CurrentForm->getValue("status_jadwalpeg") : $CurrentForm->getValue("x_status_jadwalpeg");
		if (!$this->status_jadwalpeg->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status_jadwalpeg->Visible = FALSE; // Disable update for API request
			else
				$this->status_jadwalpeg->setFormValue($val);
		}

		// Check field name 'id_jadwalpeg' first before field var 'x_id_jadwalpeg'
		$val = $CurrentForm->hasValue("id_jadwalpeg") ? $CurrentForm->getValue("id_jadwalpeg") : $CurrentForm->getValue("x_id_jadwalpeg");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->tindakan_jadwalpeg->CurrentValue = $this->tindakan_jadwalpeg->FormValue;
		$this->idpeg->CurrentValue = $this->idpeg->FormValue;
		$this->tanggal_jadwalpeg->CurrentValue = $this->tanggal_jadwalpeg->FormValue;
		$this->tanggal_jadwalpeg->CurrentValue = UnFormatDateTime($this->tanggal_jadwalpeg->CurrentValue, 0);
		$this->jam_jadwalpeg->CurrentValue = $this->jam_jadwalpeg->FormValue;
		$this->jam_jadwalpeg->CurrentValue = UnFormatDateTime($this->jam_jadwalpeg->CurrentValue, 4);
		$this->keterangan_peg->CurrentValue = $this->keterangan_peg->FormValue;
		$this->status_jadwalpeg->CurrentValue = $this->status_jadwalpeg->FormValue;
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
		$this->id_jadwalpeg->setDbValue($row['id_jadwalpeg']);
		$this->tindakan_jadwalpeg->setDbValue($row['tindakan_jadwalpeg']);
		$this->idpeg->setDbValue($row['idpeg']);
		$this->tanggal_jadwalpeg->setDbValue($row['tanggal_jadwalpeg']);
		$this->jam_jadwalpeg->setDbValue($row['jam_jadwalpeg']);
		$this->keterangan_peg->setDbValue($row['keterangan_peg']);
		$this->status_jadwalpeg->setDbValue($row['status_jadwalpeg']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_jadwalpeg'] = $this->id_jadwalpeg->CurrentValue;
		$row['tindakan_jadwalpeg'] = $this->tindakan_jadwalpeg->CurrentValue;
		$row['idpeg'] = $this->idpeg->CurrentValue;
		$row['tanggal_jadwalpeg'] = $this->tanggal_jadwalpeg->CurrentValue;
		$row['jam_jadwalpeg'] = $this->jam_jadwalpeg->CurrentValue;
		$row['keterangan_peg'] = $this->keterangan_peg->CurrentValue;
		$row['status_jadwalpeg'] = $this->status_jadwalpeg->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_jadwalpeg")) != "")
			$this->id_jadwalpeg->OldValue = $this->getKey("id_jadwalpeg"); // id_jadwalpeg
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id_jadwalpeg
		// tindakan_jadwalpeg
		// idpeg
		// tanggal_jadwalpeg
		// jam_jadwalpeg
		// keterangan_peg
		// status_jadwalpeg

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_jadwalpeg
			$this->id_jadwalpeg->ViewValue = $this->id_jadwalpeg->CurrentValue;
			$this->id_jadwalpeg->ViewCustomAttributes = "";

			// tindakan_jadwalpeg
			$this->tindakan_jadwalpeg->ViewValue = $this->tindakan_jadwalpeg->CurrentValue;
			$this->tindakan_jadwalpeg->ViewValue = FormatNumber($this->tindakan_jadwalpeg->ViewValue, 0, -2, -2, -2);
			$this->tindakan_jadwalpeg->ViewCustomAttributes = "";

			// idpeg
			$curVal = strval($this->idpeg->CurrentValue);
			if ($curVal != "") {
				$this->idpeg->ViewValue = $this->idpeg->lookupCacheOption($curVal);
				if ($this->idpeg->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idpeg->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idpeg->ViewValue = $this->idpeg->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idpeg->ViewValue = $this->idpeg->CurrentValue;
					}
				}
			} else {
				$this->idpeg->ViewValue = NULL;
			}
			$this->idpeg->ViewCustomAttributes = "";

			// tanggal_jadwalpeg
			$this->tanggal_jadwalpeg->ViewValue = $this->tanggal_jadwalpeg->CurrentValue;
			$this->tanggal_jadwalpeg->ViewValue = FormatDateTime($this->tanggal_jadwalpeg->ViewValue, 0);
			$this->tanggal_jadwalpeg->ViewCustomAttributes = "";

			// jam_jadwalpeg
			$this->jam_jadwalpeg->ViewValue = $this->jam_jadwalpeg->CurrentValue;
			$this->jam_jadwalpeg->ViewValue = FormatDateTime($this->jam_jadwalpeg->ViewValue, 4);
			$this->jam_jadwalpeg->ViewCustomAttributes = "";

			// keterangan_peg
			$this->keterangan_peg->ViewValue = $this->keterangan_peg->CurrentValue;
			$this->keterangan_peg->ViewCustomAttributes = "";

			// status_jadwalpeg
			if (strval($this->status_jadwalpeg->CurrentValue) != "") {
				$this->status_jadwalpeg->ViewValue = $this->status_jadwalpeg->optionCaption($this->status_jadwalpeg->CurrentValue);
			} else {
				$this->status_jadwalpeg->ViewValue = NULL;
			}
			$this->status_jadwalpeg->ViewCustomAttributes = "";

			// tindakan_jadwalpeg
			$this->tindakan_jadwalpeg->LinkCustomAttributes = "";
			$this->tindakan_jadwalpeg->HrefValue = "";
			$this->tindakan_jadwalpeg->TooltipValue = "";

			// idpeg
			$this->idpeg->LinkCustomAttributes = "";
			$this->idpeg->HrefValue = "";
			$this->idpeg->TooltipValue = "";

			// tanggal_jadwalpeg
			$this->tanggal_jadwalpeg->LinkCustomAttributes = "";
			$this->tanggal_jadwalpeg->HrefValue = "";
			$this->tanggal_jadwalpeg->TooltipValue = "";

			// jam_jadwalpeg
			$this->jam_jadwalpeg->LinkCustomAttributes = "";
			$this->jam_jadwalpeg->HrefValue = "";
			$this->jam_jadwalpeg->TooltipValue = "";

			// keterangan_peg
			$this->keterangan_peg->LinkCustomAttributes = "";
			$this->keterangan_peg->HrefValue = "";
			$this->keterangan_peg->TooltipValue = "";

			// status_jadwalpeg
			$this->status_jadwalpeg->LinkCustomAttributes = "";
			$this->status_jadwalpeg->HrefValue = "";
			$this->status_jadwalpeg->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// tindakan_jadwalpeg
			$this->tindakan_jadwalpeg->EditAttrs["class"] = "form-control";
			$this->tindakan_jadwalpeg->EditCustomAttributes = "";
			$this->tindakan_jadwalpeg->EditValue = HtmlEncode($this->tindakan_jadwalpeg->CurrentValue);
			$this->tindakan_jadwalpeg->PlaceHolder = RemoveHtml($this->tindakan_jadwalpeg->caption());

			// idpeg
			$this->idpeg->EditAttrs["class"] = "form-control";
			$this->idpeg->EditCustomAttributes = "";
			$curVal = trim(strval($this->idpeg->CurrentValue));
			if ($curVal != "")
				$this->idpeg->ViewValue = $this->idpeg->lookupCacheOption($curVal);
			else
				$this->idpeg->ViewValue = $this->idpeg->Lookup !== NULL && is_array($this->idpeg->Lookup->Options) ? $curVal : NULL;
			if ($this->idpeg->ViewValue !== NULL) { // Load from cache
				$this->idpeg->EditValue = array_values($this->idpeg->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->idpeg->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->idpeg->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->idpeg->EditValue = $arwrk;
			}

			// tanggal_jadwalpeg
			$this->tanggal_jadwalpeg->EditAttrs["class"] = "form-control";
			$this->tanggal_jadwalpeg->EditCustomAttributes = "";
			$this->tanggal_jadwalpeg->EditValue = HtmlEncode(FormatDateTime($this->tanggal_jadwalpeg->CurrentValue, 8));
			$this->tanggal_jadwalpeg->PlaceHolder = RemoveHtml($this->tanggal_jadwalpeg->caption());

			// jam_jadwalpeg
			$this->jam_jadwalpeg->EditAttrs["class"] = "form-control";
			$this->jam_jadwalpeg->EditCustomAttributes = "";
			$this->jam_jadwalpeg->EditValue = HtmlEncode($this->jam_jadwalpeg->CurrentValue);
			$this->jam_jadwalpeg->PlaceHolder = RemoveHtml($this->jam_jadwalpeg->caption());

			// keterangan_peg
			$this->keterangan_peg->EditAttrs["class"] = "form-control";
			$this->keterangan_peg->EditCustomAttributes = "";
			$this->keterangan_peg->EditValue = HtmlEncode($this->keterangan_peg->CurrentValue);
			$this->keterangan_peg->PlaceHolder = RemoveHtml($this->keterangan_peg->caption());

			// status_jadwalpeg
			$this->status_jadwalpeg->EditCustomAttributes = "";
			$this->status_jadwalpeg->EditValue = $this->status_jadwalpeg->options(FALSE);

			// Add refer script
			// tindakan_jadwalpeg

			$this->tindakan_jadwalpeg->LinkCustomAttributes = "";
			$this->tindakan_jadwalpeg->HrefValue = "";

			// idpeg
			$this->idpeg->LinkCustomAttributes = "";
			$this->idpeg->HrefValue = "";

			// tanggal_jadwalpeg
			$this->tanggal_jadwalpeg->LinkCustomAttributes = "";
			$this->tanggal_jadwalpeg->HrefValue = "";

			// jam_jadwalpeg
			$this->jam_jadwalpeg->LinkCustomAttributes = "";
			$this->jam_jadwalpeg->HrefValue = "";

			// keterangan_peg
			$this->keterangan_peg->LinkCustomAttributes = "";
			$this->keterangan_peg->HrefValue = "";

			// status_jadwalpeg
			$this->status_jadwalpeg->LinkCustomAttributes = "";
			$this->status_jadwalpeg->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->tindakan_jadwalpeg->Required) {
			if (!$this->tindakan_jadwalpeg->IsDetailKey && $this->tindakan_jadwalpeg->FormValue != NULL && $this->tindakan_jadwalpeg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tindakan_jadwalpeg->caption(), $this->tindakan_jadwalpeg->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tindakan_jadwalpeg->FormValue)) {
			AddMessage($FormError, $this->tindakan_jadwalpeg->errorMessage());
		}
		if ($this->idpeg->Required) {
			if (!$this->idpeg->IsDetailKey && $this->idpeg->FormValue != NULL && $this->idpeg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idpeg->caption(), $this->idpeg->RequiredErrorMessage));
			}
		}
		if ($this->tanggal_jadwalpeg->Required) {
			if (!$this->tanggal_jadwalpeg->IsDetailKey && $this->tanggal_jadwalpeg->FormValue != NULL && $this->tanggal_jadwalpeg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tanggal_jadwalpeg->caption(), $this->tanggal_jadwalpeg->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tanggal_jadwalpeg->FormValue)) {
			AddMessage($FormError, $this->tanggal_jadwalpeg->errorMessage());
		}
		if ($this->jam_jadwalpeg->Required) {
			if (!$this->jam_jadwalpeg->IsDetailKey && $this->jam_jadwalpeg->FormValue != NULL && $this->jam_jadwalpeg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jam_jadwalpeg->caption(), $this->jam_jadwalpeg->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->jam_jadwalpeg->FormValue)) {
			AddMessage($FormError, $this->jam_jadwalpeg->errorMessage());
		}
		if ($this->keterangan_peg->Required) {
			if (!$this->keterangan_peg->IsDetailKey && $this->keterangan_peg->FormValue != NULL && $this->keterangan_peg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan_peg->caption(), $this->keterangan_peg->RequiredErrorMessage));
			}
		}
		if ($this->status_jadwalpeg->Required) {
			if ($this->status_jadwalpeg->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_jadwalpeg->caption(), $this->status_jadwalpeg->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// tindakan_jadwalpeg
		$this->tindakan_jadwalpeg->setDbValueDef($rsnew, $this->tindakan_jadwalpeg->CurrentValue, NULL, FALSE);

		// idpeg
		$this->idpeg->setDbValueDef($rsnew, $this->idpeg->CurrentValue, NULL, FALSE);

		// tanggal_jadwalpeg
		$this->tanggal_jadwalpeg->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal_jadwalpeg->CurrentValue, 0), NULL, FALSE);

		// jam_jadwalpeg
		$this->jam_jadwalpeg->setDbValueDef($rsnew, $this->jam_jadwalpeg->CurrentValue, NULL, FALSE);

		// keterangan_peg
		$this->keterangan_peg->setDbValueDef($rsnew, $this->keterangan_peg->CurrentValue, NULL, FALSE);

		// status_jadwalpeg
		$this->status_jadwalpeg->setDbValueDef($rsnew, $this->status_jadwalpeg->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_jadwalpegawailist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_idpeg":
					break;
				case "x_status_jadwalpeg":
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
						case "x_idpeg":
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