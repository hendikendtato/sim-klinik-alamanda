<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class m_target_omset_cabang_add extends m_target_omset_cabang
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'm_target_omset_cabang';

	// Page object name
	public $PageObjName = "m_target_omset_cabang_add";

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

		// Table object (m_target_omset_cabang)
		if (!isset($GLOBALS["m_target_omset_cabang"]) || get_class($GLOBALS["m_target_omset_cabang"]) == PROJECT_NAMESPACE . "m_target_omset_cabang") {
			$GLOBALS["m_target_omset_cabang"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_target_omset_cabang"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_target_omset_cabang');

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
		global $m_target_omset_cabang;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_target_omset_cabang);
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
					if ($pageName == "m_target_omset_cabangview.php")
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
			$key .= @$ar['id_target_omset_cabang'];
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
			$this->id_target_omset_cabang->Visible = FALSE;
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
					$this->terminate(GetUrl("m_target_omset_cabanglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_target_omset_cabang->Visible = FALSE;
		$this->id_cabang->setVisibility();
		$this->tgl_awal->setVisibility();
		$this->tgl_akhir->setVisibility();
		$this->target->setVisibility();
		$this->baseline->setVisibility();
		$this->aset->setVisibility();
		$this->created->Visible = FALSE;
		$this->updated->Visible = FALSE;
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
		$this->setupLookupOptions($this->id_cabang);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("m_target_omset_cabanglist.php");
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
			if (Get("id_target_omset_cabang") !== NULL) {
				$this->id_target_omset_cabang->setQueryStringValue(Get("id_target_omset_cabang"));
				$this->setKey("id_target_omset_cabang", $this->id_target_omset_cabang->CurrentValue); // Set up key
			} else {
				$this->setKey("id_target_omset_cabang", ""); // Clear key
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
					$this->terminate("m_target_omset_cabanglist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "m_target_omset_cabanglist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "m_target_omset_cabangview.php")
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
		$this->id_target_omset_cabang->CurrentValue = NULL;
		$this->id_target_omset_cabang->OldValue = $this->id_target_omset_cabang->CurrentValue;
		$this->id_cabang->CurrentValue = NULL;
		$this->id_cabang->OldValue = $this->id_cabang->CurrentValue;
		$this->tgl_awal->CurrentValue = NULL;
		$this->tgl_awal->OldValue = $this->tgl_awal->CurrentValue;
		$this->tgl_akhir->CurrentValue = NULL;
		$this->tgl_akhir->OldValue = $this->tgl_akhir->CurrentValue;
		$this->target->CurrentValue = NULL;
		$this->target->OldValue = $this->target->CurrentValue;
		$this->baseline->CurrentValue = NULL;
		$this->baseline->OldValue = $this->baseline->CurrentValue;
		$this->aset->CurrentValue = NULL;
		$this->aset->OldValue = $this->aset->CurrentValue;
		$this->created->CurrentValue = NULL;
		$this->created->OldValue = $this->created->CurrentValue;
		$this->updated->CurrentValue = NULL;
		$this->updated->OldValue = $this->updated->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_cabang' first before field var 'x_id_cabang'
		$val = $CurrentForm->hasValue("id_cabang") ? $CurrentForm->getValue("id_cabang") : $CurrentForm->getValue("x_id_cabang");
		if (!$this->id_cabang->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->id_cabang->Visible = FALSE; // Disable update for API request
			else
				$this->id_cabang->setFormValue($val);
		}

		// Check field name 'tgl_awal' first before field var 'x_tgl_awal'
		$val = $CurrentForm->hasValue("tgl_awal") ? $CurrentForm->getValue("tgl_awal") : $CurrentForm->getValue("x_tgl_awal");
		if (!$this->tgl_awal->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_awal->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_awal->setFormValue($val);
			$this->tgl_awal->CurrentValue = UnFormatDateTime($this->tgl_awal->CurrentValue, 0);
		}

		// Check field name 'tgl_akhir' first before field var 'x_tgl_akhir'
		$val = $CurrentForm->hasValue("tgl_akhir") ? $CurrentForm->getValue("tgl_akhir") : $CurrentForm->getValue("x_tgl_akhir");
		if (!$this->tgl_akhir->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_akhir->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_akhir->setFormValue($val);
			$this->tgl_akhir->CurrentValue = UnFormatDateTime($this->tgl_akhir->CurrentValue, 0);
		}

		// Check field name 'target' first before field var 'x_target'
		$val = $CurrentForm->hasValue("target") ? $CurrentForm->getValue("target") : $CurrentForm->getValue("x_target");
		if (!$this->target->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->target->Visible = FALSE; // Disable update for API request
			else
				$this->target->setFormValue($val);
		}

		// Check field name 'baseline' first before field var 'x_baseline'
		$val = $CurrentForm->hasValue("baseline") ? $CurrentForm->getValue("baseline") : $CurrentForm->getValue("x_baseline");
		if (!$this->baseline->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->baseline->Visible = FALSE; // Disable update for API request
			else
				$this->baseline->setFormValue($val);
		}

		// Check field name 'aset' first before field var 'x_aset'
		$val = $CurrentForm->hasValue("aset") ? $CurrentForm->getValue("aset") : $CurrentForm->getValue("x_aset");
		if (!$this->aset->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->aset->Visible = FALSE; // Disable update for API request
			else
				$this->aset->setFormValue($val);
		}

		// Check field name 'id_target_omset_cabang' first before field var 'x_id_target_omset_cabang'
		$val = $CurrentForm->hasValue("id_target_omset_cabang") ? $CurrentForm->getValue("id_target_omset_cabang") : $CurrentForm->getValue("x_id_target_omset_cabang");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_cabang->CurrentValue = $this->id_cabang->FormValue;
		$this->tgl_awal->CurrentValue = $this->tgl_awal->FormValue;
		$this->tgl_awal->CurrentValue = UnFormatDateTime($this->tgl_awal->CurrentValue, 0);
		$this->tgl_akhir->CurrentValue = $this->tgl_akhir->FormValue;
		$this->tgl_akhir->CurrentValue = UnFormatDateTime($this->tgl_akhir->CurrentValue, 0);
		$this->target->CurrentValue = $this->target->FormValue;
		$this->baseline->CurrentValue = $this->baseline->FormValue;
		$this->aset->CurrentValue = $this->aset->FormValue;
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
		$this->id_target_omset_cabang->setDbValue($row['id_target_omset_cabang']);
		$this->id_cabang->setDbValue($row['id_cabang']);
		$this->tgl_awal->setDbValue($row['tgl_awal']);
		$this->tgl_akhir->setDbValue($row['tgl_akhir']);
		$this->target->setDbValue($row['target']);
		$this->baseline->setDbValue($row['baseline']);
		$this->aset->setDbValue($row['aset']);
		$this->created->setDbValue($row['created']);
		$this->updated->setDbValue($row['updated']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_target_omset_cabang'] = $this->id_target_omset_cabang->CurrentValue;
		$row['id_cabang'] = $this->id_cabang->CurrentValue;
		$row['tgl_awal'] = $this->tgl_awal->CurrentValue;
		$row['tgl_akhir'] = $this->tgl_akhir->CurrentValue;
		$row['target'] = $this->target->CurrentValue;
		$row['baseline'] = $this->baseline->CurrentValue;
		$row['aset'] = $this->aset->CurrentValue;
		$row['created'] = $this->created->CurrentValue;
		$row['updated'] = $this->updated->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_target_omset_cabang")) != "")
			$this->id_target_omset_cabang->OldValue = $this->getKey("id_target_omset_cabang"); // id_target_omset_cabang
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

		if ($this->target->FormValue == $this->target->CurrentValue && is_numeric(ConvertToFloatString($this->target->CurrentValue)))
			$this->target->CurrentValue = ConvertToFloatString($this->target->CurrentValue);

		// Convert decimal values if posted back
		if ($this->baseline->FormValue == $this->baseline->CurrentValue && is_numeric(ConvertToFloatString($this->baseline->CurrentValue)))
			$this->baseline->CurrentValue = ConvertToFloatString($this->baseline->CurrentValue);

		// Convert decimal values if posted back
		if ($this->aset->FormValue == $this->aset->CurrentValue && is_numeric(ConvertToFloatString($this->aset->CurrentValue)))
			$this->aset->CurrentValue = ConvertToFloatString($this->aset->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_target_omset_cabang
		// id_cabang
		// tgl_awal
		// tgl_akhir
		// target
		// baseline
		// aset
		// created
		// updated

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_target_omset_cabang
			$this->id_target_omset_cabang->ViewValue = $this->id_target_omset_cabang->CurrentValue;
			$this->id_target_omset_cabang->ViewCustomAttributes = "";

			// id_cabang
			$curVal = strval($this->id_cabang->CurrentValue);
			if ($curVal != "") {
				$this->id_cabang->ViewValue = $this->id_cabang->lookupCacheOption($curVal);
				if ($this->id_cabang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_cabang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_cabang->ViewValue = $this->id_cabang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_cabang->ViewValue = $this->id_cabang->CurrentValue;
					}
				}
			} else {
				$this->id_cabang->ViewValue = NULL;
			}
			$this->id_cabang->ViewCustomAttributes = "";

			// tgl_awal
			$this->tgl_awal->ViewValue = $this->tgl_awal->CurrentValue;
			$this->tgl_awal->ViewValue = FormatDateTime($this->tgl_awal->ViewValue, 0);
			$this->tgl_awal->ViewCustomAttributes = "";

			// tgl_akhir
			$this->tgl_akhir->ViewValue = $this->tgl_akhir->CurrentValue;
			$this->tgl_akhir->ViewValue = FormatDateTime($this->tgl_akhir->ViewValue, 0);
			$this->tgl_akhir->ViewCustomAttributes = "";

			// target
			$this->target->ViewValue = $this->target->CurrentValue;
			$this->target->ViewValue = FormatNumber($this->target->ViewValue, 2, -2, -2, -2);
			$this->target->ViewCustomAttributes = "";

			// baseline
			$this->baseline->ViewValue = $this->baseline->CurrentValue;
			$this->baseline->ViewValue = FormatNumber($this->baseline->ViewValue, 2, -2, -2, -2);
			$this->baseline->ViewCustomAttributes = "";

			// aset
			$this->aset->ViewValue = $this->aset->CurrentValue;
			$this->aset->ViewValue = FormatNumber($this->aset->ViewValue, 2, -2, -2, -2);
			$this->aset->ViewCustomAttributes = "";

			// created
			$this->created->ViewValue = $this->created->CurrentValue;
			$this->created->ViewCustomAttributes = "";

			// updated
			$this->updated->ViewValue = $this->updated->CurrentValue;
			$this->updated->ViewCustomAttributes = "";

			// id_cabang
			$this->id_cabang->LinkCustomAttributes = "";
			$this->id_cabang->HrefValue = "";
			$this->id_cabang->TooltipValue = "";

			// tgl_awal
			$this->tgl_awal->LinkCustomAttributes = "";
			$this->tgl_awal->HrefValue = "";
			$this->tgl_awal->TooltipValue = "";

			// tgl_akhir
			$this->tgl_akhir->LinkCustomAttributes = "";
			$this->tgl_akhir->HrefValue = "";
			$this->tgl_akhir->TooltipValue = "";

			// target
			$this->target->LinkCustomAttributes = "";
			$this->target->HrefValue = "";
			$this->target->TooltipValue = "";

			// baseline
			$this->baseline->LinkCustomAttributes = "";
			$this->baseline->HrefValue = "";
			$this->baseline->TooltipValue = "";

			// aset
			$this->aset->LinkCustomAttributes = "";
			$this->aset->HrefValue = "";
			$this->aset->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_cabang
			$this->id_cabang->EditAttrs["class"] = "form-control";
			$this->id_cabang->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_cabang->CurrentValue));
			if ($curVal != "")
				$this->id_cabang->ViewValue = $this->id_cabang->lookupCacheOption($curVal);
			else
				$this->id_cabang->ViewValue = $this->id_cabang->Lookup !== NULL && is_array($this->id_cabang->Lookup->Options) ? $curVal : NULL;
			if ($this->id_cabang->ViewValue !== NULL) { // Load from cache
				$this->id_cabang->EditValue = array_values($this->id_cabang->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->id_cabang->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_cabang->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_cabang->EditValue = $arwrk;
			}

			// tgl_awal
			$this->tgl_awal->EditAttrs["class"] = "form-control";
			$this->tgl_awal->EditCustomAttributes = "";
			$this->tgl_awal->EditValue = HtmlEncode(FormatDateTime($this->tgl_awal->CurrentValue, 8));
			$this->tgl_awal->PlaceHolder = RemoveHtml($this->tgl_awal->caption());

			// tgl_akhir
			$this->tgl_akhir->EditAttrs["class"] = "form-control";
			$this->tgl_akhir->EditCustomAttributes = "";
			$this->tgl_akhir->EditValue = HtmlEncode(FormatDateTime($this->tgl_akhir->CurrentValue, 8));
			$this->tgl_akhir->PlaceHolder = RemoveHtml($this->tgl_akhir->caption());

			// target
			$this->target->EditAttrs["class"] = "form-control";
			$this->target->EditCustomAttributes = "";
			$this->target->EditValue = HtmlEncode($this->target->CurrentValue);
			$this->target->PlaceHolder = RemoveHtml($this->target->caption());
			if (strval($this->target->EditValue) != "" && is_numeric($this->target->EditValue))
				$this->target->EditValue = FormatNumber($this->target->EditValue, -2, -2, -2, -2);
			

			// baseline
			$this->baseline->EditAttrs["class"] = "form-control";
			$this->baseline->EditCustomAttributes = "";
			$this->baseline->EditValue = HtmlEncode($this->baseline->CurrentValue);
			$this->baseline->PlaceHolder = RemoveHtml($this->baseline->caption());
			if (strval($this->baseline->EditValue) != "" && is_numeric($this->baseline->EditValue))
				$this->baseline->EditValue = FormatNumber($this->baseline->EditValue, -2, -2, -2, -2);
			

			// aset
			$this->aset->EditAttrs["class"] = "form-control";
			$this->aset->EditCustomAttributes = "";
			$this->aset->EditValue = HtmlEncode($this->aset->CurrentValue);
			$this->aset->PlaceHolder = RemoveHtml($this->aset->caption());
			if (strval($this->aset->EditValue) != "" && is_numeric($this->aset->EditValue))
				$this->aset->EditValue = FormatNumber($this->aset->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// id_cabang

			$this->id_cabang->LinkCustomAttributes = "";
			$this->id_cabang->HrefValue = "";

			// tgl_awal
			$this->tgl_awal->LinkCustomAttributes = "";
			$this->tgl_awal->HrefValue = "";

			// tgl_akhir
			$this->tgl_akhir->LinkCustomAttributes = "";
			$this->tgl_akhir->HrefValue = "";

			// target
			$this->target->LinkCustomAttributes = "";
			$this->target->HrefValue = "";

			// baseline
			$this->baseline->LinkCustomAttributes = "";
			$this->baseline->HrefValue = "";

			// aset
			$this->aset->LinkCustomAttributes = "";
			$this->aset->HrefValue = "";
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
		if ($this->id_cabang->Required) {
			if (!$this->id_cabang->IsDetailKey && $this->id_cabang->FormValue != NULL && $this->id_cabang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_cabang->caption(), $this->id_cabang->RequiredErrorMessage));
			}
		}
		if ($this->tgl_awal->Required) {
			if (!$this->tgl_awal->IsDetailKey && $this->tgl_awal->FormValue != NULL && $this->tgl_awal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_awal->caption(), $this->tgl_awal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_awal->FormValue)) {
			AddMessage($FormError, $this->tgl_awal->errorMessage());
		}
		if ($this->tgl_akhir->Required) {
			if (!$this->tgl_akhir->IsDetailKey && $this->tgl_akhir->FormValue != NULL && $this->tgl_akhir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_akhir->caption(), $this->tgl_akhir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_akhir->FormValue)) {
			AddMessage($FormError, $this->tgl_akhir->errorMessage());
		}
		if ($this->target->Required) {
			if (!$this->target->IsDetailKey && $this->target->FormValue != NULL && $this->target->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->target->caption(), $this->target->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->target->FormValue)) {
			AddMessage($FormError, $this->target->errorMessage());
		}
		if ($this->baseline->Required) {
			if (!$this->baseline->IsDetailKey && $this->baseline->FormValue != NULL && $this->baseline->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->baseline->caption(), $this->baseline->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->baseline->FormValue)) {
			AddMessage($FormError, $this->baseline->errorMessage());
		}
		if ($this->aset->Required) {
			if (!$this->aset->IsDetailKey && $this->aset->FormValue != NULL && $this->aset->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->aset->caption(), $this->aset->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->aset->FormValue)) {
			AddMessage($FormError, $this->aset->errorMessage());
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

		// id_cabang
		$this->id_cabang->setDbValueDef($rsnew, $this->id_cabang->CurrentValue, NULL, FALSE);

		// tgl_awal
		$this->tgl_awal->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_awal->CurrentValue, 0), NULL, FALSE);

		// tgl_akhir
		$this->tgl_akhir->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_akhir->CurrentValue, 0), NULL, FALSE);

		// target
		$this->target->setDbValueDef($rsnew, $this->target->CurrentValue, NULL, FALSE);

		// baseline
		$this->baseline->setDbValueDef($rsnew, $this->baseline->CurrentValue, NULL, FALSE);

		// aset
		$this->aset->setDbValueDef($rsnew, $this->aset->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_target_omset_cabanglist.php"), "", $this->TableVar, TRUE);
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
				case "x_id_cabang":
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
						case "x_id_cabang":
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