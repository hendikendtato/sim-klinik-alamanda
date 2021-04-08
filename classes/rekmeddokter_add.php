<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

/**
 * Page class
 */
class rekmeddokter_add extends rekmeddokter
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{4E2A1FD4-0074-4494-903F-430527A228F4}";

	// Table name
	public $TableName = 'rekmeddokter';

	// Page object name
	public $PageObjName = "rekmeddokter_add";

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

		// Table object (rekmeddokter)
		if (!isset($GLOBALS["rekmeddokter"]) || get_class($GLOBALS["rekmeddokter"]) == PROJECT_NAMESPACE . "rekmeddokter") {
			$GLOBALS["rekmeddokter"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rekmeddokter"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'rekmeddokter');

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
		global $rekmeddokter;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($rekmeddokter);
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
					if ($pageName == "rekmeddokterview.php")
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
			$key .= @$ar['id_rekmeddok'];
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
			$this->id_rekmeddok->Visible = FALSE;
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
	public $DetailPages; // Detail pages object

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
					$this->terminate(GetUrl("rekmeddokterlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_rekmeddok->Visible = FALSE;
		$this->kode_rekmeddok->Visible = FALSE;
		$this->tanggal->setVisibility();
		$this->id_pelanggan->setVisibility();
		$this->id_dokter->setVisibility();
		$this->id_be->setVisibility();
		$this->keluhan->setVisibility();
		$this->gejala_klinis->setVisibility();
		$this->terapi->setVisibility();
		$this->tindakan->setVisibility();
		$this->foto_perawatan->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Set up detail page object
		$this->setupDetailPages();

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
		$this->setupLookupOptions($this->id_dokter);
		$this->setupLookupOptions($this->id_be);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("rekmeddokterlist.php");
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
			if (Get("id_rekmeddok") !== NULL) {
				$this->id_rekmeddok->setQueryStringValue(Get("id_rekmeddok"));
				$this->setKey("id_rekmeddok", $this->id_rekmeddok->CurrentValue); // Set up key
			} else {
				$this->setKey("id_rekmeddok", ""); // Clear key
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

		// Set up detail parameters
		$this->setupDetailParms();

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
					$this->terminate("rekmeddokterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "rekmeddokterlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "rekmeddokterview.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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
		$this->foto_perawatan->Upload->Index = $CurrentForm->Index;
		$this->foto_perawatan->Upload->uploadFile();
		$this->foto_perawatan->CurrentValue = $this->foto_perawatan->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_rekmeddok->CurrentValue = NULL;
		$this->id_rekmeddok->OldValue = $this->id_rekmeddok->CurrentValue;
		$this->kode_rekmeddok->CurrentValue = NULL;
		$this->kode_rekmeddok->OldValue = $this->kode_rekmeddok->CurrentValue;
		$this->tanggal->CurrentValue = NULL;
		$this->tanggal->OldValue = $this->tanggal->CurrentValue;
		$this->id_pelanggan->CurrentValue = NULL;
		$this->id_pelanggan->OldValue = $this->id_pelanggan->CurrentValue;
		$this->id_dokter->CurrentValue = NULL;
		$this->id_dokter->OldValue = $this->id_dokter->CurrentValue;
		$this->id_be->CurrentValue = NULL;
		$this->id_be->OldValue = $this->id_be->CurrentValue;
		$this->keluhan->CurrentValue = NULL;
		$this->keluhan->OldValue = $this->keluhan->CurrentValue;
		$this->gejala_klinis->CurrentValue = NULL;
		$this->gejala_klinis->OldValue = $this->gejala_klinis->CurrentValue;
		$this->terapi->CurrentValue = NULL;
		$this->terapi->OldValue = $this->terapi->CurrentValue;
		$this->tindakan->CurrentValue = NULL;
		$this->tindakan->OldValue = $this->tindakan->CurrentValue;
		$this->foto_perawatan->Upload->DbValue = NULL;
		$this->foto_perawatan->OldValue = $this->foto_perawatan->Upload->DbValue;
		$this->foto_perawatan->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'tanggal' first before field var 'x_tanggal'
		$val = $CurrentForm->hasValue("tanggal") ? $CurrentForm->getValue("tanggal") : $CurrentForm->getValue("x_tanggal");
		if (!$this->tanggal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tanggal->Visible = FALSE; // Disable update for API request
			else
				$this->tanggal->setFormValue($val);
			$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		}

		// Check field name 'id_pelanggan' first before field var 'x_id_pelanggan'
		$val = $CurrentForm->hasValue("id_pelanggan") ? $CurrentForm->getValue("id_pelanggan") : $CurrentForm->getValue("x_id_pelanggan");
		if (!$this->id_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->id_pelanggan->setFormValue($val);
		}

		// Check field name 'id_dokter' first before field var 'x_id_dokter'
		$val = $CurrentForm->hasValue("id_dokter") ? $CurrentForm->getValue("id_dokter") : $CurrentForm->getValue("x_id_dokter");
		if (!$this->id_dokter->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_dokter->Visible = FALSE; // Disable update for API request
			else
				$this->id_dokter->setFormValue($val);
		}

		// Check field name 'id_be' first before field var 'x_id_be'
		$val = $CurrentForm->hasValue("id_be") ? $CurrentForm->getValue("id_be") : $CurrentForm->getValue("x_id_be");
		if (!$this->id_be->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_be->Visible = FALSE; // Disable update for API request
			else
				$this->id_be->setFormValue($val);
		}

		// Check field name 'keluhan' first before field var 'x_keluhan'
		$val = $CurrentForm->hasValue("keluhan") ? $CurrentForm->getValue("keluhan") : $CurrentForm->getValue("x_keluhan");
		if (!$this->keluhan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluhan->Visible = FALSE; // Disable update for API request
			else
				$this->keluhan->setFormValue($val);
		}

		// Check field name 'gejala_klinis' first before field var 'x_gejala_klinis'
		$val = $CurrentForm->hasValue("gejala_klinis") ? $CurrentForm->getValue("gejala_klinis") : $CurrentForm->getValue("x_gejala_klinis");
		if (!$this->gejala_klinis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->gejala_klinis->Visible = FALSE; // Disable update for API request
			else
				$this->gejala_klinis->setFormValue($val);
		}

		// Check field name 'terapi' first before field var 'x_terapi'
		$val = $CurrentForm->hasValue("terapi") ? $CurrentForm->getValue("terapi") : $CurrentForm->getValue("x_terapi");
		if (!$this->terapi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->terapi->Visible = FALSE; // Disable update for API request
			else
				$this->terapi->setFormValue($val);
		}

		// Check field name 'tindakan' first before field var 'x_tindakan'
		$val = $CurrentForm->hasValue("tindakan") ? $CurrentForm->getValue("tindakan") : $CurrentForm->getValue("x_tindakan");
		if (!$this->tindakan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tindakan->Visible = FALSE; // Disable update for API request
			else
				$this->tindakan->setFormValue($val);
		}

		// Check field name 'id_rekmeddok' first before field var 'x_id_rekmeddok'
		$val = $CurrentForm->hasValue("id_rekmeddok") ? $CurrentForm->getValue("id_rekmeddok") : $CurrentForm->getValue("x_id_rekmeddok");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->tanggal->CurrentValue = $this->tanggal->FormValue;
		$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		$this->id_pelanggan->CurrentValue = $this->id_pelanggan->FormValue;
		$this->id_dokter->CurrentValue = $this->id_dokter->FormValue;
		$this->id_be->CurrentValue = $this->id_be->FormValue;
		$this->keluhan->CurrentValue = $this->keluhan->FormValue;
		$this->gejala_klinis->CurrentValue = $this->gejala_klinis->FormValue;
		$this->terapi->CurrentValue = $this->terapi->FormValue;
		$this->tindakan->CurrentValue = $this->tindakan->FormValue;
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
		$this->id_rekmeddok->setDbValue($row['id_rekmeddok']);
		$this->kode_rekmeddok->setDbValue($row['kode_rekmeddok']);
		$this->tanggal->setDbValue($row['tanggal']);
		$this->id_pelanggan->setDbValue($row['id_pelanggan']);
		$this->id_dokter->setDbValue($row['id_dokter']);
		$this->id_be->setDbValue($row['id_be']);
		$this->keluhan->setDbValue($row['keluhan']);
		$this->gejala_klinis->setDbValue($row['gejala_klinis']);
		$this->terapi->setDbValue($row['terapi']);
		$this->tindakan->setDbValue($row['tindakan']);
		$this->foto_perawatan->Upload->DbValue = $row['foto_perawatan'];
		$this->foto_perawatan->setDbValue($this->foto_perawatan->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_rekmeddok'] = $this->id_rekmeddok->CurrentValue;
		$row['kode_rekmeddok'] = $this->kode_rekmeddok->CurrentValue;
		$row['tanggal'] = $this->tanggal->CurrentValue;
		$row['id_pelanggan'] = $this->id_pelanggan->CurrentValue;
		$row['id_dokter'] = $this->id_dokter->CurrentValue;
		$row['id_be'] = $this->id_be->CurrentValue;
		$row['keluhan'] = $this->keluhan->CurrentValue;
		$row['gejala_klinis'] = $this->gejala_klinis->CurrentValue;
		$row['terapi'] = $this->terapi->CurrentValue;
		$row['tindakan'] = $this->tindakan->CurrentValue;
		$row['foto_perawatan'] = $this->foto_perawatan->Upload->DbValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_rekmeddok")) != "")
			$this->id_rekmeddok->OldValue = $this->getKey("id_rekmeddok"); // id_rekmeddok
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
		// id_rekmeddok
		// kode_rekmeddok
		// tanggal
		// id_pelanggan
		// id_dokter
		// id_be
		// keluhan
		// gejala_klinis
		// terapi
		// tindakan
		// foto_perawatan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// kode_rekmeddok
			$this->kode_rekmeddok->ViewValue = $this->kode_rekmeddok->CurrentValue;
			$this->kode_rekmeddok->ViewCustomAttributes = "";

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->ViewCustomAttributes = "";

			// id_pelanggan
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
			$this->id_pelanggan->ViewCustomAttributes = "";

			// id_dokter
			$curVal = strval($this->id_dokter->CurrentValue);
			if ($curVal != "") {
				$this->id_dokter->ViewValue = $this->id_dokter->lookupCacheOption($curVal);
				if ($this->id_dokter->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_dokter->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$arwrk[2] = $rswrk->fields('df2');
						$this->id_dokter->ViewValue = $this->id_dokter->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_dokter->ViewValue = $this->id_dokter->CurrentValue;
					}
				}
			} else {
				$this->id_dokter->ViewValue = NULL;
			}
			$this->id_dokter->ViewCustomAttributes = "";

			// id_be
			$curVal = strval($this->id_be->CurrentValue);
			if ($curVal != "") {
				$this->id_be->ViewValue = $this->id_be->lookupCacheOption($curVal);
				if ($this->id_be->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_be->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_be->ViewValue = $this->id_be->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_be->ViewValue = $this->id_be->CurrentValue;
					}
				}
			} else {
				$this->id_be->ViewValue = NULL;
			}
			$this->id_be->ViewCustomAttributes = "";

			// keluhan
			$this->keluhan->ViewValue = $this->keluhan->CurrentValue;
			$this->keluhan->ViewCustomAttributes = "";

			// gejala_klinis
			$this->gejala_klinis->ViewValue = $this->gejala_klinis->CurrentValue;
			$this->gejala_klinis->ViewCustomAttributes = "";

			// terapi
			$this->terapi->ViewValue = $this->terapi->CurrentValue;
			$this->terapi->ViewCustomAttributes = "";

			// tindakan
			$this->tindakan->ViewValue = $this->tindakan->CurrentValue;
			$this->tindakan->ViewCustomAttributes = "";

			// foto_perawatan
			$this->foto_perawatan->UploadPath = "foto_perawatan/";
			if (!EmptyValue($this->foto_perawatan->Upload->DbValue)) {
				$this->foto_perawatan->ViewValue = $this->foto_perawatan->Upload->DbValue;
			} else {
				$this->foto_perawatan->ViewValue = "";
			}
			$this->foto_perawatan->ViewCustomAttributes = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";
			$this->tanggal->TooltipValue = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";
			$this->id_pelanggan->TooltipValue = "";

			// id_dokter
			$this->id_dokter->LinkCustomAttributes = "";
			$this->id_dokter->HrefValue = "";
			$this->id_dokter->TooltipValue = "";

			// id_be
			$this->id_be->LinkCustomAttributes = "";
			$this->id_be->HrefValue = "";
			$this->id_be->TooltipValue = "";

			// keluhan
			$this->keluhan->LinkCustomAttributes = "";
			$this->keluhan->HrefValue = "";
			$this->keluhan->TooltipValue = "";

			// gejala_klinis
			$this->gejala_klinis->LinkCustomAttributes = "";
			$this->gejala_klinis->HrefValue = "";
			$this->gejala_klinis->TooltipValue = "";

			// terapi
			$this->terapi->LinkCustomAttributes = "";
			$this->terapi->HrefValue = "";
			$this->terapi->TooltipValue = "";

			// tindakan
			$this->tindakan->LinkCustomAttributes = "";
			$this->tindakan->HrefValue = "";
			$this->tindakan->TooltipValue = "";

			// foto_perawatan
			$this->foto_perawatan->LinkCustomAttributes = "";
			$this->foto_perawatan->HrefValue = "";
			$this->foto_perawatan->ExportHrefValue = $this->foto_perawatan->UploadPath . $this->foto_perawatan->Upload->DbValue;
			$this->foto_perawatan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// tanggal
			$this->tanggal->EditAttrs["class"] = "form-control";
			$this->tanggal->EditCustomAttributes = "";
			$this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
			$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

			// id_pelanggan
			$this->id_pelanggan->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_pelanggan->CurrentValue));
			if ($curVal != "")
				$this->id_pelanggan->ViewValue = $this->id_pelanggan->lookupCacheOption($curVal);
			else
				$this->id_pelanggan->ViewValue = $this->id_pelanggan->Lookup !== NULL && is_array($this->id_pelanggan->Lookup->Options) ? $curVal : NULL;
			if ($this->id_pelanggan->ViewValue !== NULL) { // Load from cache
				$this->id_pelanggan->EditValue = array_values($this->id_pelanggan->Lookup->Options);
				if ($this->id_pelanggan->ViewValue == "")
					$this->id_pelanggan->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pelanggan`" . SearchString("=", $this->id_pelanggan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_pelanggan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->id_pelanggan->ViewValue = $this->id_pelanggan->displayValue($arwrk);
				} else {
					$this->id_pelanggan->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_pelanggan->EditValue = $arwrk;
			}

			// id_dokter
			$this->id_dokter->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_dokter->CurrentValue));
			if ($curVal != "")
				$this->id_dokter->ViewValue = $this->id_dokter->lookupCacheOption($curVal);
			else
				$this->id_dokter->ViewValue = $this->id_dokter->Lookup !== NULL && is_array($this->id_dokter->Lookup->Options) ? $curVal : NULL;
			if ($this->id_dokter->ViewValue !== NULL) { // Load from cache
				$this->id_dokter->EditValue = array_values($this->id_dokter->Lookup->Options);
				if ($this->id_dokter->ViewValue == "")
					$this->id_dokter->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->id_dokter->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_dokter->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
					$this->id_dokter->ViewValue = $this->id_dokter->displayValue($arwrk);
				} else {
					$this->id_dokter->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_dokter->EditValue = $arwrk;
			}

			// id_be
			$this->id_be->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_be->CurrentValue));
			if ($curVal != "")
				$this->id_be->ViewValue = $this->id_be->lookupCacheOption($curVal);
			else
				$this->id_be->ViewValue = $this->id_be->Lookup !== NULL && is_array($this->id_be->Lookup->Options) ? $curVal : NULL;
			if ($this->id_be->ViewValue !== NULL) { // Load from cache
				$this->id_be->EditValue = array_values($this->id_be->Lookup->Options);
				if ($this->id_be->ViewValue == "")
					$this->id_be->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->id_be->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_be->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->id_be->ViewValue = $this->id_be->displayValue($arwrk);
				} else {
					$this->id_be->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_be->EditValue = $arwrk;
			}

			// keluhan
			$this->keluhan->EditAttrs["class"] = "form-control";
			$this->keluhan->EditCustomAttributes = "";
			$this->keluhan->EditValue = HtmlEncode($this->keluhan->CurrentValue);
			$this->keluhan->PlaceHolder = RemoveHtml($this->keluhan->caption());

			// gejala_klinis
			$this->gejala_klinis->EditAttrs["class"] = "form-control";
			$this->gejala_klinis->EditCustomAttributes = "";
			$this->gejala_klinis->EditValue = HtmlEncode($this->gejala_klinis->CurrentValue);
			$this->gejala_klinis->PlaceHolder = RemoveHtml($this->gejala_klinis->caption());

			// terapi
			$this->terapi->EditAttrs["class"] = "form-control";
			$this->terapi->EditCustomAttributes = "";
			$this->terapi->EditValue = HtmlEncode($this->terapi->CurrentValue);
			$this->terapi->PlaceHolder = RemoveHtml($this->terapi->caption());

			// tindakan
			$this->tindakan->EditAttrs["class"] = "form-control";
			$this->tindakan->EditCustomAttributes = "";
			$this->tindakan->EditValue = HtmlEncode($this->tindakan->CurrentValue);
			$this->tindakan->PlaceHolder = RemoveHtml($this->tindakan->caption());

			// foto_perawatan
			$this->foto_perawatan->EditAttrs["class"] = "form-control";
			$this->foto_perawatan->EditCustomAttributes = "";
			$this->foto_perawatan->UploadPath = "foto_perawatan/";
			if (!EmptyValue($this->foto_perawatan->Upload->DbValue)) {
				$this->foto_perawatan->EditValue = $this->foto_perawatan->Upload->DbValue;
			} else {
				$this->foto_perawatan->EditValue = "";
			}
			if (!EmptyValue($this->foto_perawatan->CurrentValue))
					$this->foto_perawatan->Upload->FileName = $this->foto_perawatan->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->foto_perawatan);

			// Add refer script
			// tanggal

			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";

			// id_dokter
			$this->id_dokter->LinkCustomAttributes = "";
			$this->id_dokter->HrefValue = "";

			// id_be
			$this->id_be->LinkCustomAttributes = "";
			$this->id_be->HrefValue = "";

			// keluhan
			$this->keluhan->LinkCustomAttributes = "";
			$this->keluhan->HrefValue = "";

			// gejala_klinis
			$this->gejala_klinis->LinkCustomAttributes = "";
			$this->gejala_klinis->HrefValue = "";

			// terapi
			$this->terapi->LinkCustomAttributes = "";
			$this->terapi->HrefValue = "";

			// tindakan
			$this->tindakan->LinkCustomAttributes = "";
			$this->tindakan->HrefValue = "";

			// foto_perawatan
			$this->foto_perawatan->LinkCustomAttributes = "";
			$this->foto_perawatan->HrefValue = "";
			$this->foto_perawatan->ExportHrefValue = $this->foto_perawatan->UploadPath . $this->foto_perawatan->Upload->DbValue;
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
		if ($this->tanggal->Required) {
			if (!$this->tanggal->IsDetailKey && $this->tanggal->FormValue != NULL && $this->tanggal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tanggal->caption(), $this->tanggal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tanggal->FormValue)) {
			AddMessage($FormError, $this->tanggal->errorMessage());
		}
		if ($this->id_pelanggan->Required) {
			if (!$this->id_pelanggan->IsDetailKey && $this->id_pelanggan->FormValue != NULL && $this->id_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_pelanggan->caption(), $this->id_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->id_dokter->Required) {
			if (!$this->id_dokter->IsDetailKey && $this->id_dokter->FormValue != NULL && $this->id_dokter->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_dokter->caption(), $this->id_dokter->RequiredErrorMessage));
			}
		}
		if ($this->id_be->Required) {
			if (!$this->id_be->IsDetailKey && $this->id_be->FormValue != NULL && $this->id_be->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_be->caption(), $this->id_be->RequiredErrorMessage));
			}
		}
		if ($this->keluhan->Required) {
			if (!$this->keluhan->IsDetailKey && $this->keluhan->FormValue != NULL && $this->keluhan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluhan->caption(), $this->keluhan->RequiredErrorMessage));
			}
		}
		if ($this->gejala_klinis->Required) {
			if (!$this->gejala_klinis->IsDetailKey && $this->gejala_klinis->FormValue != NULL && $this->gejala_klinis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->gejala_klinis->caption(), $this->gejala_klinis->RequiredErrorMessage));
			}
		}
		if ($this->terapi->Required) {
			if (!$this->terapi->IsDetailKey && $this->terapi->FormValue != NULL && $this->terapi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->terapi->caption(), $this->terapi->RequiredErrorMessage));
			}
		}
		if ($this->tindakan->Required) {
			if (!$this->tindakan->IsDetailKey && $this->tindakan->FormValue != NULL && $this->tindakan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tindakan->caption(), $this->tindakan->RequiredErrorMessage));
			}
		}
		if ($this->foto_perawatan->Required) {
			if ($this->foto_perawatan->Upload->FileName == "" && !$this->foto_perawatan->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->foto_perawatan->caption(), $this->foto_perawatan->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("detailrekmeddok", $detailTblVar) && $GLOBALS["detailrekmeddok"]->DetailAdd) {
			if (!isset($GLOBALS["detailrekmeddok_grid"]))
				$GLOBALS["detailrekmeddok_grid"] = new detailrekmeddok_grid(); // Get detail page object
			$GLOBALS["detailrekmeddok_grid"]->validateGridForm();
		}
		if (in_array("detailrekmedterapis", $detailTblVar) && $GLOBALS["detailrekmedterapis"]->DetailAdd) {
			if (!isset($GLOBALS["detailrekmedterapis_grid"]))
				$GLOBALS["detailrekmedterapis_grid"] = new detailrekmedterapis_grid(); // Get detail page object
			$GLOBALS["detailrekmedterapis_grid"]->validateGridForm();
		}
		if (in_array("detailrekmedpenjualan", $detailTblVar) && $GLOBALS["detailrekmedpenjualan"]->DetailAdd) {
			if (!isset($GLOBALS["detailrekmedpenjualan_grid"]))
				$GLOBALS["detailrekmedpenjualan_grid"] = new detailrekmedpenjualan_grid(); // Get detail page object
			$GLOBALS["detailrekmedpenjualan_grid"]->validateGridForm();
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

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
			$this->foto_perawatan->OldUploadPath = "foto_perawatan/";
			$this->foto_perawatan->UploadPath = $this->foto_perawatan->OldUploadPath;
		}
		$rsnew = [];

		// tanggal
		$this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), NULL, FALSE);

		// id_pelanggan
		$this->id_pelanggan->setDbValueDef($rsnew, $this->id_pelanggan->CurrentValue, NULL, FALSE);

		// id_dokter
		$this->id_dokter->setDbValueDef($rsnew, $this->id_dokter->CurrentValue, NULL, FALSE);

		// id_be
		$this->id_be->setDbValueDef($rsnew, $this->id_be->CurrentValue, NULL, FALSE);

		// keluhan
		$this->keluhan->setDbValueDef($rsnew, $this->keluhan->CurrentValue, NULL, FALSE);

		// gejala_klinis
		$this->gejala_klinis->setDbValueDef($rsnew, $this->gejala_klinis->CurrentValue, NULL, FALSE);

		// terapi
		$this->terapi->setDbValueDef($rsnew, $this->terapi->CurrentValue, NULL, FALSE);

		// tindakan
		$this->tindakan->setDbValueDef($rsnew, $this->tindakan->CurrentValue, NULL, FALSE);

		// foto_perawatan
		if ($this->foto_perawatan->Visible && !$this->foto_perawatan->Upload->KeepFile) {
			$this->foto_perawatan->Upload->DbValue = ""; // No need to delete old file
			if ($this->foto_perawatan->Upload->FileName == "") {
				$rsnew['foto_perawatan'] = NULL;
			} else {
				$rsnew['foto_perawatan'] = $this->foto_perawatan->Upload->FileName;
			}
		}
		if ($this->foto_perawatan->Visible && !$this->foto_perawatan->Upload->KeepFile) {
			$this->foto_perawatan->UploadPath = "foto_perawatan/";
			$oldFiles = EmptyValue($this->foto_perawatan->Upload->DbValue) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->foto_perawatan->htmlDecode(strval($this->foto_perawatan->Upload->DbValue)));
			if (!EmptyValue($this->foto_perawatan->Upload->FileName)) {
				$newFiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), strval($this->foto_perawatan->Upload->FileName));
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->foto_perawatan, $this->foto_perawatan->Upload->Index);
						if (file_exists($tempPath . $file)) {
							if (Config("DELETE_UPLOADED_FILES")) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										array_splice($oldFiles, $j, 1);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->foto_perawatan->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->foto_perawatan->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->foto_perawatan->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->foto_perawatan->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->foto_perawatan->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->foto_perawatan->setDbValueDef($rsnew, $this->foto_perawatan->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
				if ($this->foto_perawatan->Visible && !$this->foto_perawatan->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->foto_perawatan->Upload->DbValue) ? [] : explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->foto_perawatan->htmlDecode(strval($this->foto_perawatan->Upload->DbValue)));
					if (!EmptyValue($this->foto_perawatan->Upload->FileName)) {
						$newFiles = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->foto_perawatan->Upload->FileName);
						$newFiles2 = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $this->foto_perawatan->htmlDecode($rsnew['foto_perawatan']));
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->foto_perawatan, $this->foto_perawatan->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->foto_perawatan->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = [];
					}
					if (Config("DELETE_UPLOADED_FILES")) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile != "" && !in_array($oldFile, $newFiles))
								@unlink($this->foto_perawatan->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("detailrekmeddok", $detailTblVar) && $GLOBALS["detailrekmeddok"]->DetailAdd) {
				$GLOBALS["detailrekmeddok"]->id_rekmeddok->setSessionValue($this->id_rekmeddok->CurrentValue); // Set master key
				if (!isset($GLOBALS["detailrekmeddok_grid"]))
					$GLOBALS["detailrekmeddok_grid"] = new detailrekmeddok_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "detailrekmeddok"); // Load user level of detail table
				$addRow = $GLOBALS["detailrekmeddok_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["detailrekmeddok"]->id_rekmeddok->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("detailrekmedterapis", $detailTblVar) && $GLOBALS["detailrekmedterapis"]->DetailAdd) {
				$GLOBALS["detailrekmedterapis"]->id_rekmeddok->setSessionValue($this->id_rekmeddok->CurrentValue); // Set master key
				if (!isset($GLOBALS["detailrekmedterapis_grid"]))
					$GLOBALS["detailrekmedterapis_grid"] = new detailrekmedterapis_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "detailrekmedterapis"); // Load user level of detail table
				$addRow = $GLOBALS["detailrekmedterapis_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["detailrekmedterapis"]->id_rekmeddok->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("detailrekmedpenjualan", $detailTblVar) && $GLOBALS["detailrekmedpenjualan"]->DetailAdd) {
				$GLOBALS["detailrekmedpenjualan"]->id_rekmeddok->setSessionValue($this->id_rekmeddok->CurrentValue); // Set master key
				if (!isset($GLOBALS["detailrekmedpenjualan_grid"]))
					$GLOBALS["detailrekmedpenjualan_grid"] = new detailrekmedpenjualan_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "detailrekmedpenjualan"); // Load user level of detail table
				$addRow = $GLOBALS["detailrekmedpenjualan_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["detailrekmedpenjualan"]->id_rekmeddok->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {

			// foto_perawatan
			CleanUploadTempPath($this->foto_perawatan, $this->foto_perawatan->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("detailrekmeddok", $detailTblVar)) {
				if (!isset($GLOBALS["detailrekmeddok_grid"]))
					$GLOBALS["detailrekmeddok_grid"] = new detailrekmeddok_grid();
				if ($GLOBALS["detailrekmeddok_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["detailrekmeddok_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["detailrekmeddok_grid"]->CurrentMode = "add";
					$GLOBALS["detailrekmeddok_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["detailrekmeddok_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailrekmeddok_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailrekmeddok_grid"]->id_rekmeddok->IsDetailKey = TRUE;
					$GLOBALS["detailrekmeddok_grid"]->id_rekmeddok->CurrentValue = $this->id_rekmeddok->CurrentValue;
					$GLOBALS["detailrekmeddok_grid"]->id_rekmeddok->setSessionValue($GLOBALS["detailrekmeddok_grid"]->id_rekmeddok->CurrentValue);
				}
			}
			if (in_array("detailrekmedterapis", $detailTblVar)) {
				if (!isset($GLOBALS["detailrekmedterapis_grid"]))
					$GLOBALS["detailrekmedterapis_grid"] = new detailrekmedterapis_grid();
				if ($GLOBALS["detailrekmedterapis_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["detailrekmedterapis_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["detailrekmedterapis_grid"]->CurrentMode = "add";
					$GLOBALS["detailrekmedterapis_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["detailrekmedterapis_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailrekmedterapis_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailrekmedterapis_grid"]->id_rekmeddok->IsDetailKey = TRUE;
					$GLOBALS["detailrekmedterapis_grid"]->id_rekmeddok->CurrentValue = $this->id_rekmeddok->CurrentValue;
					$GLOBALS["detailrekmedterapis_grid"]->id_rekmeddok->setSessionValue($GLOBALS["detailrekmedterapis_grid"]->id_rekmeddok->CurrentValue);
				}
			}
			if (in_array("detailrekmedpenjualan", $detailTblVar)) {
				if (!isset($GLOBALS["detailrekmedpenjualan_grid"]))
					$GLOBALS["detailrekmedpenjualan_grid"] = new detailrekmedpenjualan_grid();
				if ($GLOBALS["detailrekmedpenjualan_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["detailrekmedpenjualan_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["detailrekmedpenjualan_grid"]->CurrentMode = "add";
					$GLOBALS["detailrekmedpenjualan_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["detailrekmedpenjualan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailrekmedpenjualan_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailrekmedpenjualan_grid"]->id_rekmeddok->IsDetailKey = TRUE;
					$GLOBALS["detailrekmedpenjualan_grid"]->id_rekmeddok->CurrentValue = $this->id_rekmeddok->CurrentValue;
					$GLOBALS["detailrekmedpenjualan_grid"]->id_rekmeddok->setSessionValue($GLOBALS["detailrekmedpenjualan_grid"]->id_rekmeddok->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("rekmeddokterlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Set up detail pages
	protected function setupDetailPages()
	{
		$pages = new SubPages();
		$pages->Style = "tabs";
		$pages->add('detailrekmeddok');
		$pages->add('detailrekmedterapis');
		$pages->add('detailrekmedpenjualan');
		$this->DetailPages = $pages;
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
				case "x_id_dokter":
					break;
				case "x_id_be":
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
						case "x_id_dokter":
							break;
						case "x_id_be":
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