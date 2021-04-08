<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

/**
 * Page class
 */
class m_jenis_member_add extends m_jenis_member
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{4E2A1FD4-0074-4494-903F-430527A228F4}";

	// Table name
	public $TableName = 'm_jenis_member';

	// Page object name
	public $PageObjName = "m_jenis_member_add";

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

		// Table object (m_jenis_member)
		if (!isset($GLOBALS["m_jenis_member"]) || get_class($GLOBALS["m_jenis_member"]) == PROJECT_NAMESPACE . "m_jenis_member") {
			$GLOBALS["m_jenis_member"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_jenis_member"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_jenis_member');

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
		global $m_jenis_member;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_jenis_member);
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
					if ($pageName == "m_jenis_memberview.php")
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
			$key .= @$ar['id_jenis_member'];
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
			$this->id_jenis_member->Visible = FALSE;
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
					$this->terminate(GetUrl("m_jenis_memberlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_jenis_member->Visible = FALSE;
		$this->nama_member->setVisibility();
		$this->member_selanjutnya->setVisibility();
		$this->nominal_bawah->setVisibility();
		$this->nominal_atas->setVisibility();
		$this->qty_bawah->setVisibility();
		$this->qty_atas->setVisibility();
		$this->disc_prosen->setVisibility();
		$this->disc_nominal->setVisibility();
		$this->jangka_waktu->setVisibility();
		$this->min_kedatangan->setVisibility();
		$this->poin_member->setVisibility();
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
		$this->setupLookupOptions($this->member_selanjutnya);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("m_jenis_memberlist.php");
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
			if (Get("id_jenis_member") !== NULL) {
				$this->id_jenis_member->setQueryStringValue(Get("id_jenis_member"));
				$this->setKey("id_jenis_member", $this->id_jenis_member->CurrentValue); // Set up key
			} else {
				$this->setKey("id_jenis_member", ""); // Clear key
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
					$this->terminate("m_jenis_memberlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "m_jenis_memberlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "m_jenis_memberview.php")
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
		$this->id_jenis_member->CurrentValue = NULL;
		$this->id_jenis_member->OldValue = $this->id_jenis_member->CurrentValue;
		$this->nama_member->CurrentValue = NULL;
		$this->nama_member->OldValue = $this->nama_member->CurrentValue;
		$this->member_selanjutnya->CurrentValue = NULL;
		$this->member_selanjutnya->OldValue = $this->member_selanjutnya->CurrentValue;
		$this->nominal_bawah->CurrentValue = NULL;
		$this->nominal_bawah->OldValue = $this->nominal_bawah->CurrentValue;
		$this->nominal_atas->CurrentValue = NULL;
		$this->nominal_atas->OldValue = $this->nominal_atas->CurrentValue;
		$this->qty_bawah->CurrentValue = NULL;
		$this->qty_bawah->OldValue = $this->qty_bawah->CurrentValue;
		$this->qty_atas->CurrentValue = NULL;
		$this->qty_atas->OldValue = $this->qty_atas->CurrentValue;
		$this->disc_prosen->CurrentValue = NULL;
		$this->disc_prosen->OldValue = $this->disc_prosen->CurrentValue;
		$this->disc_nominal->CurrentValue = NULL;
		$this->disc_nominal->OldValue = $this->disc_nominal->CurrentValue;
		$this->jangka_waktu->CurrentValue = NULL;
		$this->jangka_waktu->OldValue = $this->jangka_waktu->CurrentValue;
		$this->min_kedatangan->CurrentValue = NULL;
		$this->min_kedatangan->OldValue = $this->min_kedatangan->CurrentValue;
		$this->poin_member->CurrentValue = NULL;
		$this->poin_member->OldValue = $this->poin_member->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nama_member' first before field var 'x_nama_member'
		$val = $CurrentForm->hasValue("nama_member") ? $CurrentForm->getValue("nama_member") : $CurrentForm->getValue("x_nama_member");
		if (!$this->nama_member->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_member->Visible = FALSE; // Disable update for API request
			else
				$this->nama_member->setFormValue($val);
		}

		// Check field name 'member_selanjutnya' first before field var 'x_member_selanjutnya'
		$val = $CurrentForm->hasValue("member_selanjutnya") ? $CurrentForm->getValue("member_selanjutnya") : $CurrentForm->getValue("x_member_selanjutnya");
		if (!$this->member_selanjutnya->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->member_selanjutnya->Visible = FALSE; // Disable update for API request
			else
				$this->member_selanjutnya->setFormValue($val);
		}

		// Check field name 'nominal_bawah' first before field var 'x_nominal_bawah'
		$val = $CurrentForm->hasValue("nominal_bawah") ? $CurrentForm->getValue("nominal_bawah") : $CurrentForm->getValue("x_nominal_bawah");
		if (!$this->nominal_bawah->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nominal_bawah->Visible = FALSE; // Disable update for API request
			else
				$this->nominal_bawah->setFormValue($val);
		}

		// Check field name 'nominal_atas' first before field var 'x_nominal_atas'
		$val = $CurrentForm->hasValue("nominal_atas") ? $CurrentForm->getValue("nominal_atas") : $CurrentForm->getValue("x_nominal_atas");
		if (!$this->nominal_atas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nominal_atas->Visible = FALSE; // Disable update for API request
			else
				$this->nominal_atas->setFormValue($val);
		}

		// Check field name 'qty_bawah' first before field var 'x_qty_bawah'
		$val = $CurrentForm->hasValue("qty_bawah") ? $CurrentForm->getValue("qty_bawah") : $CurrentForm->getValue("x_qty_bawah");
		if (!$this->qty_bawah->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->qty_bawah->Visible = FALSE; // Disable update for API request
			else
				$this->qty_bawah->setFormValue($val);
		}

		// Check field name 'qty_atas' first before field var 'x_qty_atas'
		$val = $CurrentForm->hasValue("qty_atas") ? $CurrentForm->getValue("qty_atas") : $CurrentForm->getValue("x_qty_atas");
		if (!$this->qty_atas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->qty_atas->Visible = FALSE; // Disable update for API request
			else
				$this->qty_atas->setFormValue($val);
		}

		// Check field name 'disc_prosen' first before field var 'x_disc_prosen'
		$val = $CurrentForm->hasValue("disc_prosen") ? $CurrentForm->getValue("disc_prosen") : $CurrentForm->getValue("x_disc_prosen");
		if (!$this->disc_prosen->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disc_prosen->Visible = FALSE; // Disable update for API request
			else
				$this->disc_prosen->setFormValue($val);
		}

		// Check field name 'disc_nominal' first before field var 'x_disc_nominal'
		$val = $CurrentForm->hasValue("disc_nominal") ? $CurrentForm->getValue("disc_nominal") : $CurrentForm->getValue("x_disc_nominal");
		if (!$this->disc_nominal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disc_nominal->Visible = FALSE; // Disable update for API request
			else
				$this->disc_nominal->setFormValue($val);
		}

		// Check field name 'jangka_waktu' first before field var 'x_jangka_waktu'
		$val = $CurrentForm->hasValue("jangka_waktu") ? $CurrentForm->getValue("jangka_waktu") : $CurrentForm->getValue("x_jangka_waktu");
		if (!$this->jangka_waktu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jangka_waktu->Visible = FALSE; // Disable update for API request
			else
				$this->jangka_waktu->setFormValue($val);
		}

		// Check field name 'min_kedatangan' first before field var 'x_min_kedatangan'
		$val = $CurrentForm->hasValue("min_kedatangan") ? $CurrentForm->getValue("min_kedatangan") : $CurrentForm->getValue("x_min_kedatangan");
		if (!$this->min_kedatangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->min_kedatangan->Visible = FALSE; // Disable update for API request
			else
				$this->min_kedatangan->setFormValue($val);
		}

		// Check field name 'poin_member' first before field var 'x_poin_member'
		$val = $CurrentForm->hasValue("poin_member") ? $CurrentForm->getValue("poin_member") : $CurrentForm->getValue("x_poin_member");
		if (!$this->poin_member->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->poin_member->Visible = FALSE; // Disable update for API request
			else
				$this->poin_member->setFormValue($val);
		}

		// Check field name 'id_jenis_member' first before field var 'x_id_jenis_member'
		$val = $CurrentForm->hasValue("id_jenis_member") ? $CurrentForm->getValue("id_jenis_member") : $CurrentForm->getValue("x_id_jenis_member");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nama_member->CurrentValue = $this->nama_member->FormValue;
		$this->member_selanjutnya->CurrentValue = $this->member_selanjutnya->FormValue;
		$this->nominal_bawah->CurrentValue = $this->nominal_bawah->FormValue;
		$this->nominal_atas->CurrentValue = $this->nominal_atas->FormValue;
		$this->qty_bawah->CurrentValue = $this->qty_bawah->FormValue;
		$this->qty_atas->CurrentValue = $this->qty_atas->FormValue;
		$this->disc_prosen->CurrentValue = $this->disc_prosen->FormValue;
		$this->disc_nominal->CurrentValue = $this->disc_nominal->FormValue;
		$this->jangka_waktu->CurrentValue = $this->jangka_waktu->FormValue;
		$this->min_kedatangan->CurrentValue = $this->min_kedatangan->FormValue;
		$this->poin_member->CurrentValue = $this->poin_member->FormValue;
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
		$this->id_jenis_member->setDbValue($row['id_jenis_member']);
		$this->nama_member->setDbValue($row['nama_member']);
		$this->member_selanjutnya->setDbValue($row['member_selanjutnya']);
		$this->nominal_bawah->setDbValue($row['nominal_bawah']);
		$this->nominal_atas->setDbValue($row['nominal_atas']);
		$this->qty_bawah->setDbValue($row['qty_bawah']);
		$this->qty_atas->setDbValue($row['qty_atas']);
		$this->disc_prosen->setDbValue($row['disc_prosen']);
		$this->disc_nominal->setDbValue($row['disc_nominal']);
		$this->jangka_waktu->setDbValue($row['jangka_waktu']);
		$this->min_kedatangan->setDbValue($row['min_kedatangan']);
		$this->poin_member->setDbValue($row['poin_member']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_jenis_member'] = $this->id_jenis_member->CurrentValue;
		$row['nama_member'] = $this->nama_member->CurrentValue;
		$row['member_selanjutnya'] = $this->member_selanjutnya->CurrentValue;
		$row['nominal_bawah'] = $this->nominal_bawah->CurrentValue;
		$row['nominal_atas'] = $this->nominal_atas->CurrentValue;
		$row['qty_bawah'] = $this->qty_bawah->CurrentValue;
		$row['qty_atas'] = $this->qty_atas->CurrentValue;
		$row['disc_prosen'] = $this->disc_prosen->CurrentValue;
		$row['disc_nominal'] = $this->disc_nominal->CurrentValue;
		$row['jangka_waktu'] = $this->jangka_waktu->CurrentValue;
		$row['min_kedatangan'] = $this->min_kedatangan->CurrentValue;
		$row['poin_member'] = $this->poin_member->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_jenis_member")) != "")
			$this->id_jenis_member->OldValue = $this->getKey("id_jenis_member"); // id_jenis_member
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
		// Convert decimal values if posted back

		if ($this->disc_prosen->FormValue == $this->disc_prosen->CurrentValue && is_numeric(ConvertToFloatString($this->disc_prosen->CurrentValue)))
			$this->disc_prosen->CurrentValue = ConvertToFloatString($this->disc_prosen->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_jenis_member
		// nama_member
		// member_selanjutnya
		// nominal_bawah
		// nominal_atas
		// qty_bawah
		// qty_atas
		// disc_prosen
		// disc_nominal
		// jangka_waktu
		// min_kedatangan
		// poin_member

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_jenis_member
			$this->id_jenis_member->ViewValue = $this->id_jenis_member->CurrentValue;
			$this->id_jenis_member->ViewValue = FormatNumber($this->id_jenis_member->ViewValue, 0, -2, -2, -2);
			$this->id_jenis_member->ViewCustomAttributes = "";

			// nama_member
			$this->nama_member->ViewValue = $this->nama_member->CurrentValue;
			$this->nama_member->ViewCustomAttributes = "";

			// member_selanjutnya
			$curVal = strval($this->member_selanjutnya->CurrentValue);
			if ($curVal != "") {
				$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->lookupCacheOption($curVal);
				if ($this->member_selanjutnya->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_jenis_member`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->member_selanjutnya->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->CurrentValue;
					}
				}
			} else {
				$this->member_selanjutnya->ViewValue = NULL;
			}
			$this->member_selanjutnya->ViewCustomAttributes = "";

			// nominal_bawah
			$this->nominal_bawah->ViewValue = $this->nominal_bawah->CurrentValue;
			$this->nominal_bawah->ViewValue = FormatNumber($this->nominal_bawah->ViewValue, 0, -2, -2, -2);
			$this->nominal_bawah->ViewCustomAttributes = "";

			// nominal_atas
			$this->nominal_atas->ViewValue = $this->nominal_atas->CurrentValue;
			$this->nominal_atas->ViewValue = FormatNumber($this->nominal_atas->ViewValue, 0, -2, -2, -2);
			$this->nominal_atas->ViewCustomAttributes = "";

			// qty_bawah
			$this->qty_bawah->ViewValue = $this->qty_bawah->CurrentValue;
			$this->qty_bawah->ViewValue = FormatNumber($this->qty_bawah->ViewValue, 0, -2, -2, -2);
			$this->qty_bawah->ViewCustomAttributes = "";

			// qty_atas
			$this->qty_atas->ViewValue = $this->qty_atas->CurrentValue;
			$this->qty_atas->ViewValue = FormatNumber($this->qty_atas->ViewValue, 0, -2, -2, -2);
			$this->qty_atas->ViewCustomAttributes = "";

			// disc_prosen
			$this->disc_prosen->ViewValue = $this->disc_prosen->CurrentValue;
			$this->disc_prosen->ViewValue = FormatNumber($this->disc_prosen->ViewValue, 2, -2, -2, -2);
			$this->disc_prosen->ViewCustomAttributes = "";

			// disc_nominal
			$this->disc_nominal->ViewValue = $this->disc_nominal->CurrentValue;
			$this->disc_nominal->ViewValue = FormatNumber($this->disc_nominal->ViewValue, 0, -2, -2, -2);
			$this->disc_nominal->ViewCustomAttributes = "";

			// jangka_waktu
			$this->jangka_waktu->ViewValue = $this->jangka_waktu->CurrentValue;
			$this->jangka_waktu->ViewValue = FormatNumber($this->jangka_waktu->ViewValue, 0, -2, -2, -2);
			$this->jangka_waktu->ViewCustomAttributes = "";

			// min_kedatangan
			$this->min_kedatangan->ViewValue = $this->min_kedatangan->CurrentValue;
			$this->min_kedatangan->ViewValue = FormatNumber($this->min_kedatangan->ViewValue, 0, -2, -2, -2);
			$this->min_kedatangan->ViewCustomAttributes = "";

			// poin_member
			$this->poin_member->ViewValue = $this->poin_member->CurrentValue;
			$this->poin_member->ViewValue = FormatNumber($this->poin_member->ViewValue, 0, -2, -2, -2);
			$this->poin_member->ViewCustomAttributes = "";

			// nama_member
			$this->nama_member->LinkCustomAttributes = "";
			$this->nama_member->HrefValue = "";
			$this->nama_member->TooltipValue = "";

			// member_selanjutnya
			$this->member_selanjutnya->LinkCustomAttributes = "";
			$this->member_selanjutnya->HrefValue = "";
			$this->member_selanjutnya->TooltipValue = "";

			// nominal_bawah
			$this->nominal_bawah->LinkCustomAttributes = "";
			$this->nominal_bawah->HrefValue = "";
			$this->nominal_bawah->TooltipValue = "";

			// nominal_atas
			$this->nominal_atas->LinkCustomAttributes = "";
			$this->nominal_atas->HrefValue = "";
			$this->nominal_atas->TooltipValue = "";

			// qty_bawah
			$this->qty_bawah->LinkCustomAttributes = "";
			$this->qty_bawah->HrefValue = "";
			$this->qty_bawah->TooltipValue = "";

			// qty_atas
			$this->qty_atas->LinkCustomAttributes = "";
			$this->qty_atas->HrefValue = "";
			$this->qty_atas->TooltipValue = "";

			// disc_prosen
			$this->disc_prosen->LinkCustomAttributes = "";
			$this->disc_prosen->HrefValue = "";
			$this->disc_prosen->TooltipValue = "";

			// disc_nominal
			$this->disc_nominal->LinkCustomAttributes = "";
			$this->disc_nominal->HrefValue = "";
			$this->disc_nominal->TooltipValue = "";

			// jangka_waktu
			$this->jangka_waktu->LinkCustomAttributes = "";
			$this->jangka_waktu->HrefValue = "";
			$this->jangka_waktu->TooltipValue = "";

			// min_kedatangan
			$this->min_kedatangan->LinkCustomAttributes = "";
			$this->min_kedatangan->HrefValue = "";
			$this->min_kedatangan->TooltipValue = "";

			// poin_member
			$this->poin_member->LinkCustomAttributes = "";
			$this->poin_member->HrefValue = "";
			$this->poin_member->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nama_member
			$this->nama_member->EditAttrs["class"] = "form-control";
			$this->nama_member->EditCustomAttributes = "";
			if (!$this->nama_member->Raw)
				$this->nama_member->CurrentValue = HtmlDecode($this->nama_member->CurrentValue);
			$this->nama_member->EditValue = HtmlEncode($this->nama_member->CurrentValue);
			$this->nama_member->PlaceHolder = RemoveHtml($this->nama_member->caption());

			// member_selanjutnya
			$this->member_selanjutnya->EditAttrs["class"] = "form-control";
			$this->member_selanjutnya->EditCustomAttributes = "";
			$curVal = trim(strval($this->member_selanjutnya->CurrentValue));
			if ($curVal != "")
				$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->lookupCacheOption($curVal);
			else
				$this->member_selanjutnya->ViewValue = $this->member_selanjutnya->Lookup !== NULL && is_array($this->member_selanjutnya->Lookup->Options) ? $curVal : NULL;
			if ($this->member_selanjutnya->ViewValue !== NULL) { // Load from cache
				$this->member_selanjutnya->EditValue = array_values($this->member_selanjutnya->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_jenis_member`" . SearchString("=", $this->member_selanjutnya->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->member_selanjutnya->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->member_selanjutnya->EditValue = $arwrk;
			}

			// nominal_bawah
			$this->nominal_bawah->EditAttrs["class"] = "form-control";
			$this->nominal_bawah->EditCustomAttributes = "";
			$this->nominal_bawah->EditValue = HtmlEncode($this->nominal_bawah->CurrentValue);
			$this->nominal_bawah->PlaceHolder = RemoveHtml($this->nominal_bawah->caption());

			// nominal_atas
			$this->nominal_atas->EditAttrs["class"] = "form-control";
			$this->nominal_atas->EditCustomAttributes = "";
			$this->nominal_atas->EditValue = HtmlEncode($this->nominal_atas->CurrentValue);
			$this->nominal_atas->PlaceHolder = RemoveHtml($this->nominal_atas->caption());

			// qty_bawah
			$this->qty_bawah->EditAttrs["class"] = "form-control";
			$this->qty_bawah->EditCustomAttributes = "";
			$this->qty_bawah->EditValue = HtmlEncode($this->qty_bawah->CurrentValue);
			$this->qty_bawah->PlaceHolder = RemoveHtml($this->qty_bawah->caption());

			// qty_atas
			$this->qty_atas->EditAttrs["class"] = "form-control";
			$this->qty_atas->EditCustomAttributes = "";
			$this->qty_atas->EditValue = HtmlEncode($this->qty_atas->CurrentValue);
			$this->qty_atas->PlaceHolder = RemoveHtml($this->qty_atas->caption());

			// disc_prosen
			$this->disc_prosen->EditAttrs["class"] = "form-control";
			$this->disc_prosen->EditCustomAttributes = "";
			$this->disc_prosen->EditValue = HtmlEncode($this->disc_prosen->CurrentValue);
			$this->disc_prosen->PlaceHolder = RemoveHtml($this->disc_prosen->caption());
			if (strval($this->disc_prosen->EditValue) != "" && is_numeric($this->disc_prosen->EditValue))
				$this->disc_prosen->EditValue = FormatNumber($this->disc_prosen->EditValue, -2, -2, -2, -2);
			

			// disc_nominal
			$this->disc_nominal->EditAttrs["class"] = "form-control";
			$this->disc_nominal->EditCustomAttributes = "";
			$this->disc_nominal->EditValue = HtmlEncode($this->disc_nominal->CurrentValue);
			$this->disc_nominal->PlaceHolder = RemoveHtml($this->disc_nominal->caption());

			// jangka_waktu
			$this->jangka_waktu->EditAttrs["class"] = "form-control";
			$this->jangka_waktu->EditCustomAttributes = "";
			$this->jangka_waktu->EditValue = HtmlEncode($this->jangka_waktu->CurrentValue);
			$this->jangka_waktu->PlaceHolder = RemoveHtml($this->jangka_waktu->caption());

			// min_kedatangan
			$this->min_kedatangan->EditAttrs["class"] = "form-control";
			$this->min_kedatangan->EditCustomAttributes = "";
			$this->min_kedatangan->EditValue = HtmlEncode($this->min_kedatangan->CurrentValue);
			$this->min_kedatangan->PlaceHolder = RemoveHtml($this->min_kedatangan->caption());

			// poin_member
			$this->poin_member->EditAttrs["class"] = "form-control";
			$this->poin_member->EditCustomAttributes = "";
			$this->poin_member->EditValue = HtmlEncode($this->poin_member->CurrentValue);
			$this->poin_member->PlaceHolder = RemoveHtml($this->poin_member->caption());

			// Add refer script
			// nama_member

			$this->nama_member->LinkCustomAttributes = "";
			$this->nama_member->HrefValue = "";

			// member_selanjutnya
			$this->member_selanjutnya->LinkCustomAttributes = "";
			$this->member_selanjutnya->HrefValue = "";

			// nominal_bawah
			$this->nominal_bawah->LinkCustomAttributes = "";
			$this->nominal_bawah->HrefValue = "";

			// nominal_atas
			$this->nominal_atas->LinkCustomAttributes = "";
			$this->nominal_atas->HrefValue = "";

			// qty_bawah
			$this->qty_bawah->LinkCustomAttributes = "";
			$this->qty_bawah->HrefValue = "";

			// qty_atas
			$this->qty_atas->LinkCustomAttributes = "";
			$this->qty_atas->HrefValue = "";

			// disc_prosen
			$this->disc_prosen->LinkCustomAttributes = "";
			$this->disc_prosen->HrefValue = "";

			// disc_nominal
			$this->disc_nominal->LinkCustomAttributes = "";
			$this->disc_nominal->HrefValue = "";

			// jangka_waktu
			$this->jangka_waktu->LinkCustomAttributes = "";
			$this->jangka_waktu->HrefValue = "";

			// min_kedatangan
			$this->min_kedatangan->LinkCustomAttributes = "";
			$this->min_kedatangan->HrefValue = "";

			// poin_member
			$this->poin_member->LinkCustomAttributes = "";
			$this->poin_member->HrefValue = "";
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
		if ($this->nama_member->Required) {
			if (!$this->nama_member->IsDetailKey && $this->nama_member->FormValue != NULL && $this->nama_member->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_member->caption(), $this->nama_member->RequiredErrorMessage));
			}
		}
		if ($this->member_selanjutnya->Required) {
			if (!$this->member_selanjutnya->IsDetailKey && $this->member_selanjutnya->FormValue != NULL && $this->member_selanjutnya->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->member_selanjutnya->caption(), $this->member_selanjutnya->RequiredErrorMessage));
			}
		}
		if ($this->nominal_bawah->Required) {
			if (!$this->nominal_bawah->IsDetailKey && $this->nominal_bawah->FormValue != NULL && $this->nominal_bawah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nominal_bawah->caption(), $this->nominal_bawah->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->nominal_bawah->FormValue)) {
			AddMessage($FormError, $this->nominal_bawah->errorMessage());
		}
		if ($this->nominal_atas->Required) {
			if (!$this->nominal_atas->IsDetailKey && $this->nominal_atas->FormValue != NULL && $this->nominal_atas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nominal_atas->caption(), $this->nominal_atas->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->nominal_atas->FormValue)) {
			AddMessage($FormError, $this->nominal_atas->errorMessage());
		}
		if ($this->qty_bawah->Required) {
			if (!$this->qty_bawah->IsDetailKey && $this->qty_bawah->FormValue != NULL && $this->qty_bawah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->qty_bawah->caption(), $this->qty_bawah->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->qty_bawah->FormValue)) {
			AddMessage($FormError, $this->qty_bawah->errorMessage());
		}
		if ($this->qty_atas->Required) {
			if (!$this->qty_atas->IsDetailKey && $this->qty_atas->FormValue != NULL && $this->qty_atas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->qty_atas->caption(), $this->qty_atas->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->qty_atas->FormValue)) {
			AddMessage($FormError, $this->qty_atas->errorMessage());
		}
		if ($this->disc_prosen->Required) {
			if (!$this->disc_prosen->IsDetailKey && $this->disc_prosen->FormValue != NULL && $this->disc_prosen->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disc_prosen->caption(), $this->disc_prosen->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->disc_prosen->FormValue)) {
			AddMessage($FormError, $this->disc_prosen->errorMessage());
		}
		if ($this->disc_nominal->Required) {
			if (!$this->disc_nominal->IsDetailKey && $this->disc_nominal->FormValue != NULL && $this->disc_nominal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disc_nominal->caption(), $this->disc_nominal->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->disc_nominal->FormValue)) {
			AddMessage($FormError, $this->disc_nominal->errorMessage());
		}
		if ($this->jangka_waktu->Required) {
			if (!$this->jangka_waktu->IsDetailKey && $this->jangka_waktu->FormValue != NULL && $this->jangka_waktu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jangka_waktu->caption(), $this->jangka_waktu->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jangka_waktu->FormValue)) {
			AddMessage($FormError, $this->jangka_waktu->errorMessage());
		}
		if ($this->min_kedatangan->Required) {
			if (!$this->min_kedatangan->IsDetailKey && $this->min_kedatangan->FormValue != NULL && $this->min_kedatangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->min_kedatangan->caption(), $this->min_kedatangan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->min_kedatangan->FormValue)) {
			AddMessage($FormError, $this->min_kedatangan->errorMessage());
		}
		if ($this->poin_member->Required) {
			if (!$this->poin_member->IsDetailKey && $this->poin_member->FormValue != NULL && $this->poin_member->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->poin_member->caption(), $this->poin_member->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->poin_member->FormValue)) {
			AddMessage($FormError, $this->poin_member->errorMessage());
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

		// nama_member
		$this->nama_member->setDbValueDef($rsnew, $this->nama_member->CurrentValue, NULL, FALSE);

		// member_selanjutnya
		$this->member_selanjutnya->setDbValueDef($rsnew, $this->member_selanjutnya->CurrentValue, NULL, FALSE);

		// nominal_bawah
		$this->nominal_bawah->setDbValueDef($rsnew, $this->nominal_bawah->CurrentValue, NULL, FALSE);

		// nominal_atas
		$this->nominal_atas->setDbValueDef($rsnew, $this->nominal_atas->CurrentValue, NULL, FALSE);

		// qty_bawah
		$this->qty_bawah->setDbValueDef($rsnew, $this->qty_bawah->CurrentValue, NULL, FALSE);

		// qty_atas
		$this->qty_atas->setDbValueDef($rsnew, $this->qty_atas->CurrentValue, NULL, FALSE);

		// disc_prosen
		$this->disc_prosen->setDbValueDef($rsnew, $this->disc_prosen->CurrentValue, NULL, FALSE);

		// disc_nominal
		$this->disc_nominal->setDbValueDef($rsnew, $this->disc_nominal->CurrentValue, NULL, FALSE);

		// jangka_waktu
		$this->jangka_waktu->setDbValueDef($rsnew, $this->jangka_waktu->CurrentValue, NULL, FALSE);

		// min_kedatangan
		$this->min_kedatangan->setDbValueDef($rsnew, $this->min_kedatangan->CurrentValue, NULL, FALSE);

		// poin_member
		$this->poin_member->setDbValueDef($rsnew, $this->poin_member->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_jenis_memberlist.php"), "", $this->TableVar, TRUE);
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
				case "x_member_selanjutnya":
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
						case "x_member_selanjutnya":
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