<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

/**
 * Page class
 */
class laporan_kas_add extends laporan_kas
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{4E2A1FD4-0074-4494-903F-430527A228F4}";

	// Table name
	public $TableName = 'laporan_kas';

	// Page object name
	public $PageObjName = "laporan_kas_add";

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

		// Table object (laporan_kas)
		if (!isset($GLOBALS["laporan_kas"]) || get_class($GLOBALS["laporan_kas"]) == PROJECT_NAMESPACE . "laporan_kas") {
			$GLOBALS["laporan_kas"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["laporan_kas"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'laporan_kas');

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
		global $laporan_kas;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($laporan_kas);
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
					if ($pageName == "laporan_kasview.php")
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
					$this->terminate(GetUrl("laporan_kaslist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->id_klinik->setVisibility();
		$this->id_kas->setVisibility();
		$this->jumlah->setVisibility();
		$this->tanggal->setVisibility();
		$this->kode_penjualan->setVisibility();
		$this->id_mutasi_kas->setVisibility();
		$this->saldo_awal->setVisibility();
		$this->sisa_saldo->setVisibility();
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
		// Check permission

		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("laporan_kaslist.php");
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
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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
					$this->terminate("laporan_kaslist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "laporan_kaslist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "laporan_kasview.php")
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
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->id_klinik->CurrentValue = NULL;
		$this->id_klinik->OldValue = $this->id_klinik->CurrentValue;
		$this->id_kas->CurrentValue = NULL;
		$this->id_kas->OldValue = $this->id_kas->CurrentValue;
		$this->jumlah->CurrentValue = NULL;
		$this->jumlah->OldValue = $this->jumlah->CurrentValue;
		$this->tanggal->CurrentValue = NULL;
		$this->tanggal->OldValue = $this->tanggal->CurrentValue;
		$this->kode_penjualan->CurrentValue = NULL;
		$this->kode_penjualan->OldValue = $this->kode_penjualan->CurrentValue;
		$this->id_mutasi_kas->CurrentValue = NULL;
		$this->id_mutasi_kas->OldValue = $this->id_mutasi_kas->CurrentValue;
		$this->saldo_awal->CurrentValue = NULL;
		$this->saldo_awal->OldValue = $this->saldo_awal->CurrentValue;
		$this->sisa_saldo->CurrentValue = NULL;
		$this->sisa_saldo->OldValue = $this->sisa_saldo->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}

		// Check field name 'id_kas' first before field var 'x_id_kas'
		$val = $CurrentForm->hasValue("id_kas") ? $CurrentForm->getValue("id_kas") : $CurrentForm->getValue("x_id_kas");
		if (!$this->id_kas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_kas->Visible = FALSE; // Disable update for API request
			else
				$this->id_kas->setFormValue($val);
		}

		// Check field name 'jumlah' first before field var 'x_jumlah'
		$val = $CurrentForm->hasValue("jumlah") ? $CurrentForm->getValue("jumlah") : $CurrentForm->getValue("x_jumlah");
		if (!$this->jumlah->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlah->Visible = FALSE; // Disable update for API request
			else
				$this->jumlah->setFormValue($val);
		}

		// Check field name 'tanggal' first before field var 'x_tanggal'
		$val = $CurrentForm->hasValue("tanggal") ? $CurrentForm->getValue("tanggal") : $CurrentForm->getValue("x_tanggal");
		if (!$this->tanggal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tanggal->Visible = FALSE; // Disable update for API request
			else
				$this->tanggal->setFormValue($val);
			$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		}

		// Check field name 'kode_penjualan' first before field var 'x_kode_penjualan'
		$val = $CurrentForm->hasValue("kode_penjualan") ? $CurrentForm->getValue("kode_penjualan") : $CurrentForm->getValue("x_kode_penjualan");
		if (!$this->kode_penjualan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kode_penjualan->Visible = FALSE; // Disable update for API request
			else
				$this->kode_penjualan->setFormValue($val);
		}

		// Check field name 'id_mutasi_kas' first before field var 'x_id_mutasi_kas'
		$val = $CurrentForm->hasValue("id_mutasi_kas") ? $CurrentForm->getValue("id_mutasi_kas") : $CurrentForm->getValue("x_id_mutasi_kas");
		if (!$this->id_mutasi_kas->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_mutasi_kas->Visible = FALSE; // Disable update for API request
			else
				$this->id_mutasi_kas->setFormValue($val);
		}

		// Check field name 'saldo_awal' first before field var 'x_saldo_awal'
		$val = $CurrentForm->hasValue("saldo_awal") ? $CurrentForm->getValue("saldo_awal") : $CurrentForm->getValue("x_saldo_awal");
		if (!$this->saldo_awal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->saldo_awal->Visible = FALSE; // Disable update for API request
			else
				$this->saldo_awal->setFormValue($val);
		}

		// Check field name 'sisa_saldo' first before field var 'x_sisa_saldo'
		$val = $CurrentForm->hasValue("sisa_saldo") ? $CurrentForm->getValue("sisa_saldo") : $CurrentForm->getValue("x_sisa_saldo");
		if (!$this->sisa_saldo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sisa_saldo->Visible = FALSE; // Disable update for API request
			else
				$this->sisa_saldo->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
		$this->id_kas->CurrentValue = $this->id_kas->FormValue;
		$this->jumlah->CurrentValue = $this->jumlah->FormValue;
		$this->tanggal->CurrentValue = $this->tanggal->FormValue;
		$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		$this->kode_penjualan->CurrentValue = $this->kode_penjualan->FormValue;
		$this->id_mutasi_kas->CurrentValue = $this->id_mutasi_kas->FormValue;
		$this->saldo_awal->CurrentValue = $this->saldo_awal->FormValue;
		$this->sisa_saldo->CurrentValue = $this->sisa_saldo->FormValue;
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
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->id_kas->setDbValue($row['id_kas']);
		$this->jumlah->setDbValue($row['jumlah']);
		$this->tanggal->setDbValue($row['tanggal']);
		$this->kode_penjualan->setDbValue($row['kode_penjualan']);
		$this->id_mutasi_kas->setDbValue($row['id_mutasi_kas']);
		$this->saldo_awal->setDbValue($row['saldo_awal']);
		$this->sisa_saldo->setDbValue($row['sisa_saldo']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['id_klinik'] = $this->id_klinik->CurrentValue;
		$row['id_kas'] = $this->id_kas->CurrentValue;
		$row['jumlah'] = $this->jumlah->CurrentValue;
		$row['tanggal'] = $this->tanggal->CurrentValue;
		$row['kode_penjualan'] = $this->kode_penjualan->CurrentValue;
		$row['id_mutasi_kas'] = $this->id_mutasi_kas->CurrentValue;
		$row['saldo_awal'] = $this->saldo_awal->CurrentValue;
		$row['sisa_saldo'] = $this->sisa_saldo->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
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

		if ($this->jumlah->FormValue == $this->jumlah->CurrentValue && is_numeric(ConvertToFloatString($this->jumlah->CurrentValue)))
			$this->jumlah->CurrentValue = ConvertToFloatString($this->jumlah->CurrentValue);

		// Convert decimal values if posted back
		if ($this->saldo_awal->FormValue == $this->saldo_awal->CurrentValue && is_numeric(ConvertToFloatString($this->saldo_awal->CurrentValue)))
			$this->saldo_awal->CurrentValue = ConvertToFloatString($this->saldo_awal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->sisa_saldo->FormValue == $this->sisa_saldo->CurrentValue && is_numeric(ConvertToFloatString($this->sisa_saldo->CurrentValue)))
			$this->sisa_saldo->CurrentValue = ConvertToFloatString($this->sisa_saldo->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// id_klinik
		// id_kas
		// jumlah
		// tanggal
		// kode_penjualan
		// id_mutasi_kas
		// saldo_awal
		// sisa_saldo

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// id_klinik
			$this->id_klinik->ViewValue = $this->id_klinik->CurrentValue;
			$this->id_klinik->ViewValue = FormatNumber($this->id_klinik->ViewValue, 0, -2, -2, -2);
			$this->id_klinik->ViewCustomAttributes = "";

			// id_kas
			$this->id_kas->ViewValue = $this->id_kas->CurrentValue;
			$this->id_kas->ViewValue = FormatNumber($this->id_kas->ViewValue, 0, -2, -2, -2);
			$this->id_kas->ViewCustomAttributes = "";

			// jumlah
			$this->jumlah->ViewValue = $this->jumlah->CurrentValue;
			$this->jumlah->ViewValue = FormatNumber($this->jumlah->ViewValue, 2, -2, -2, -2);
			$this->jumlah->ViewCustomAttributes = "";

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->ViewCustomAttributes = "";

			// kode_penjualan
			$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
			$this->kode_penjualan->ViewCustomAttributes = "";

			// id_mutasi_kas
			$this->id_mutasi_kas->ViewValue = $this->id_mutasi_kas->CurrentValue;
			$this->id_mutasi_kas->ViewValue = FormatNumber($this->id_mutasi_kas->ViewValue, 0, -2, -2, -2);
			$this->id_mutasi_kas->ViewCustomAttributes = "";

			// saldo_awal
			$this->saldo_awal->ViewValue = $this->saldo_awal->CurrentValue;
			$this->saldo_awal->ViewValue = FormatNumber($this->saldo_awal->ViewValue, 2, -2, -2, -2);
			$this->saldo_awal->ViewCustomAttributes = "";

			// sisa_saldo
			$this->sisa_saldo->ViewValue = $this->sisa_saldo->CurrentValue;
			$this->sisa_saldo->ViewValue = FormatNumber($this->sisa_saldo->ViewValue, 2, -2, -2, -2);
			$this->sisa_saldo->ViewCustomAttributes = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// id_kas
			$this->id_kas->LinkCustomAttributes = "";
			$this->id_kas->HrefValue = "";
			$this->id_kas->TooltipValue = "";

			// jumlah
			$this->jumlah->LinkCustomAttributes = "";
			$this->jumlah->HrefValue = "";
			$this->jumlah->TooltipValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";
			$this->tanggal->TooltipValue = "";

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";
			$this->kode_penjualan->TooltipValue = "";

			// id_mutasi_kas
			$this->id_mutasi_kas->LinkCustomAttributes = "";
			$this->id_mutasi_kas->HrefValue = "";
			$this->id_mutasi_kas->TooltipValue = "";

			// saldo_awal
			$this->saldo_awal->LinkCustomAttributes = "";
			$this->saldo_awal->HrefValue = "";
			$this->saldo_awal->TooltipValue = "";

			// sisa_saldo
			$this->sisa_saldo->LinkCustomAttributes = "";
			$this->sisa_saldo->HrefValue = "";
			$this->sisa_saldo->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_klinik
			$this->id_klinik->EditAttrs["class"] = "form-control";
			$this->id_klinik->EditCustomAttributes = "";
			$this->id_klinik->EditValue = HtmlEncode($this->id_klinik->CurrentValue);
			$this->id_klinik->PlaceHolder = RemoveHtml($this->id_klinik->caption());

			// id_kas
			$this->id_kas->EditAttrs["class"] = "form-control";
			$this->id_kas->EditCustomAttributes = "";
			$this->id_kas->EditValue = HtmlEncode($this->id_kas->CurrentValue);
			$this->id_kas->PlaceHolder = RemoveHtml($this->id_kas->caption());

			// jumlah
			$this->jumlah->EditAttrs["class"] = "form-control";
			$this->jumlah->EditCustomAttributes = "";
			$this->jumlah->EditValue = HtmlEncode($this->jumlah->CurrentValue);
			$this->jumlah->PlaceHolder = RemoveHtml($this->jumlah->caption());
			if (strval($this->jumlah->EditValue) != "" && is_numeric($this->jumlah->EditValue))
				$this->jumlah->EditValue = FormatNumber($this->jumlah->EditValue, -2, -2, -2, -2);
			

			// tanggal
			$this->tanggal->EditAttrs["class"] = "form-control";
			$this->tanggal->EditCustomAttributes = "";
			$this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
			$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

			// kode_penjualan
			$this->kode_penjualan->EditAttrs["class"] = "form-control";
			$this->kode_penjualan->EditCustomAttributes = "";
			$this->kode_penjualan->EditValue = HtmlEncode($this->kode_penjualan->CurrentValue);
			$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

			// id_mutasi_kas
			$this->id_mutasi_kas->EditAttrs["class"] = "form-control";
			$this->id_mutasi_kas->EditCustomAttributes = "";
			$this->id_mutasi_kas->EditValue = HtmlEncode($this->id_mutasi_kas->CurrentValue);
			$this->id_mutasi_kas->PlaceHolder = RemoveHtml($this->id_mutasi_kas->caption());

			// saldo_awal
			$this->saldo_awal->EditAttrs["class"] = "form-control";
			$this->saldo_awal->EditCustomAttributes = "";
			$this->saldo_awal->EditValue = HtmlEncode($this->saldo_awal->CurrentValue);
			$this->saldo_awal->PlaceHolder = RemoveHtml($this->saldo_awal->caption());
			if (strval($this->saldo_awal->EditValue) != "" && is_numeric($this->saldo_awal->EditValue))
				$this->saldo_awal->EditValue = FormatNumber($this->saldo_awal->EditValue, -2, -2, -2, -2);
			

			// sisa_saldo
			$this->sisa_saldo->EditAttrs["class"] = "form-control";
			$this->sisa_saldo->EditCustomAttributes = "";
			$this->sisa_saldo->EditValue = HtmlEncode($this->sisa_saldo->CurrentValue);
			$this->sisa_saldo->PlaceHolder = RemoveHtml($this->sisa_saldo->caption());
			if (strval($this->sisa_saldo->EditValue) != "" && is_numeric($this->sisa_saldo->EditValue))
				$this->sisa_saldo->EditValue = FormatNumber($this->sisa_saldo->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// id_klinik

			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// id_kas
			$this->id_kas->LinkCustomAttributes = "";
			$this->id_kas->HrefValue = "";

			// jumlah
			$this->jumlah->LinkCustomAttributes = "";
			$this->jumlah->HrefValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";

			// id_mutasi_kas
			$this->id_mutasi_kas->LinkCustomAttributes = "";
			$this->id_mutasi_kas->HrefValue = "";

			// saldo_awal
			$this->saldo_awal->LinkCustomAttributes = "";
			$this->saldo_awal->HrefValue = "";

			// sisa_saldo
			$this->sisa_saldo->LinkCustomAttributes = "";
			$this->sisa_saldo->HrefValue = "";
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
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_klinik->FormValue)) {
			AddMessage($FormError, $this->id_klinik->errorMessage());
		}
		if ($this->id_kas->Required) {
			if (!$this->id_kas->IsDetailKey && $this->id_kas->FormValue != NULL && $this->id_kas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_kas->caption(), $this->id_kas->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_kas->FormValue)) {
			AddMessage($FormError, $this->id_kas->errorMessage());
		}
		if ($this->jumlah->Required) {
			if (!$this->jumlah->IsDetailKey && $this->jumlah->FormValue != NULL && $this->jumlah->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumlah->caption(), $this->jumlah->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->jumlah->FormValue)) {
			AddMessage($FormError, $this->jumlah->errorMessage());
		}
		if ($this->tanggal->Required) {
			if (!$this->tanggal->IsDetailKey && $this->tanggal->FormValue != NULL && $this->tanggal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tanggal->caption(), $this->tanggal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tanggal->FormValue)) {
			AddMessage($FormError, $this->tanggal->errorMessage());
		}
		if ($this->kode_penjualan->Required) {
			if (!$this->kode_penjualan->IsDetailKey && $this->kode_penjualan->FormValue != NULL && $this->kode_penjualan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kode_penjualan->caption(), $this->kode_penjualan->RequiredErrorMessage));
			}
		}
		if ($this->id_mutasi_kas->Required) {
			if (!$this->id_mutasi_kas->IsDetailKey && $this->id_mutasi_kas->FormValue != NULL && $this->id_mutasi_kas->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_mutasi_kas->caption(), $this->id_mutasi_kas->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_mutasi_kas->FormValue)) {
			AddMessage($FormError, $this->id_mutasi_kas->errorMessage());
		}
		if ($this->saldo_awal->Required) {
			if (!$this->saldo_awal->IsDetailKey && $this->saldo_awal->FormValue != NULL && $this->saldo_awal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->saldo_awal->caption(), $this->saldo_awal->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->saldo_awal->FormValue)) {
			AddMessage($FormError, $this->saldo_awal->errorMessage());
		}
		if ($this->sisa_saldo->Required) {
			if (!$this->sisa_saldo->IsDetailKey && $this->sisa_saldo->FormValue != NULL && $this->sisa_saldo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sisa_saldo->caption(), $this->sisa_saldo->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->sisa_saldo->FormValue)) {
			AddMessage($FormError, $this->sisa_saldo->errorMessage());
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

		// id_klinik
		$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, 0, FALSE);

		// id_kas
		$this->id_kas->setDbValueDef($rsnew, $this->id_kas->CurrentValue, 0, FALSE);

		// jumlah
		$this->jumlah->setDbValueDef($rsnew, $this->jumlah->CurrentValue, NULL, FALSE);

		// tanggal
		$this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), NULL, FALSE);

		// kode_penjualan
		$this->kode_penjualan->setDbValueDef($rsnew, $this->kode_penjualan->CurrentValue, NULL, FALSE);

		// id_mutasi_kas
		$this->id_mutasi_kas->setDbValueDef($rsnew, $this->id_mutasi_kas->CurrentValue, NULL, FALSE);

		// saldo_awal
		$this->saldo_awal->setDbValueDef($rsnew, $this->saldo_awal->CurrentValue, NULL, FALSE);

		// sisa_saldo
		$this->sisa_saldo->setDbValueDef($rsnew, $this->sisa_saldo->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("laporan_kaslist.php"), "", $this->TableVar, TRUE);
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