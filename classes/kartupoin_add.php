<?php
namespace PHPMaker2020\klinik_latest_26_03_21;

/**
 * Page class
 */
class kartupoin_add extends kartupoin
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{7561FF98-88C2-4B76-B5C9-C5F11860BCF7}";

	// Table name
	public $TableName = 'kartupoin';

	// Page object name
	public $PageObjName = "kartupoin_add";

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

		// Table object (kartupoin)
		if (!isset($GLOBALS["kartupoin"]) || get_class($GLOBALS["kartupoin"]) == PROJECT_NAMESPACE . "kartupoin") {
			$GLOBALS["kartupoin"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["kartupoin"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'kartupoin');

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
		global $kartupoin;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($kartupoin);
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
					if ($pageName == "kartupoinview.php")
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
			$key .= @$ar['id_kartupoin'];
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
			$this->id_kartupoin->Visible = FALSE;
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
					$this->terminate(GetUrl("kartupoinlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_kartupoin->Visible = FALSE;
		$this->id_pelanggan->setVisibility();
		$this->id_klinik->setVisibility();
		$this->kode_penjualan->setVisibility();
		$this->id_penyesuaian_poin->setVisibility();
		$this->tgl->setVisibility();
		$this->masuk->setVisibility();
		$this->masuk_penyesuaian->setVisibility();
		$this->keluar->setVisibility();
		$this->keluar_penyesuaian->setVisibility();
		$this->saldo_poin->setVisibility();
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
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->id_penyesuaian_poin);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("kartupoinlist.php");
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
			if (Get("id_kartupoin") !== NULL) {
				$this->id_kartupoin->setQueryStringValue(Get("id_kartupoin"));
				$this->setKey("id_kartupoin", $this->id_kartupoin->CurrentValue); // Set up key
			} else {
				$this->setKey("id_kartupoin", ""); // Clear key
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
					$this->terminate("kartupoinlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "kartupoinlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "kartupoinview.php")
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
		$this->id_kartupoin->CurrentValue = NULL;
		$this->id_kartupoin->OldValue = $this->id_kartupoin->CurrentValue;
		$this->id_pelanggan->CurrentValue = NULL;
		$this->id_pelanggan->OldValue = $this->id_pelanggan->CurrentValue;
		$this->id_klinik->CurrentValue = NULL;
		$this->id_klinik->OldValue = $this->id_klinik->CurrentValue;
		$this->kode_penjualan->CurrentValue = NULL;
		$this->kode_penjualan->OldValue = $this->kode_penjualan->CurrentValue;
		$this->id_penyesuaian_poin->CurrentValue = NULL;
		$this->id_penyesuaian_poin->OldValue = $this->id_penyesuaian_poin->CurrentValue;
		$this->tgl->CurrentValue = NULL;
		$this->tgl->OldValue = $this->tgl->CurrentValue;
		$this->masuk->CurrentValue = NULL;
		$this->masuk->OldValue = $this->masuk->CurrentValue;
		$this->masuk_penyesuaian->CurrentValue = NULL;
		$this->masuk_penyesuaian->OldValue = $this->masuk_penyesuaian->CurrentValue;
		$this->keluar->CurrentValue = NULL;
		$this->keluar->OldValue = $this->keluar->CurrentValue;
		$this->keluar_penyesuaian->CurrentValue = NULL;
		$this->keluar_penyesuaian->OldValue = $this->keluar_penyesuaian->CurrentValue;
		$this->saldo_poin->CurrentValue = NULL;
		$this->saldo_poin->OldValue = $this->saldo_poin->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_pelanggan' first before field var 'x_id_pelanggan'
		$val = $CurrentForm->hasValue("id_pelanggan") ? $CurrentForm->getValue("id_pelanggan") : $CurrentForm->getValue("x_id_pelanggan");
		if (!$this->id_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->id_pelanggan->setFormValue($val);
		}

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}

		// Check field name 'kode_penjualan' first before field var 'x_kode_penjualan'
		$val = $CurrentForm->hasValue("kode_penjualan") ? $CurrentForm->getValue("kode_penjualan") : $CurrentForm->getValue("x_kode_penjualan");
		if (!$this->kode_penjualan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kode_penjualan->Visible = FALSE; // Disable update for API request
			else
				$this->kode_penjualan->setFormValue($val);
		}

		// Check field name 'id_penyesuaian_poin' first before field var 'x_id_penyesuaian_poin'
		$val = $CurrentForm->hasValue("id_penyesuaian_poin") ? $CurrentForm->getValue("id_penyesuaian_poin") : $CurrentForm->getValue("x_id_penyesuaian_poin");
		if (!$this->id_penyesuaian_poin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_penyesuaian_poin->Visible = FALSE; // Disable update for API request
			else
				$this->id_penyesuaian_poin->setFormValue($val);
		}

		// Check field name 'tgl' first before field var 'x_tgl'
		$val = $CurrentForm->hasValue("tgl") ? $CurrentForm->getValue("tgl") : $CurrentForm->getValue("x_tgl");
		if (!$this->tgl->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl->Visible = FALSE; // Disable update for API request
			else
				$this->tgl->setFormValue($val);
			$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		}

		// Check field name 'masuk' first before field var 'x_masuk'
		$val = $CurrentForm->hasValue("masuk") ? $CurrentForm->getValue("masuk") : $CurrentForm->getValue("x_masuk");
		if (!$this->masuk->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk->Visible = FALSE; // Disable update for API request
			else
				$this->masuk->setFormValue($val);
		}

		// Check field name 'masuk_penyesuaian' first before field var 'x_masuk_penyesuaian'
		$val = $CurrentForm->hasValue("masuk_penyesuaian") ? $CurrentForm->getValue("masuk_penyesuaian") : $CurrentForm->getValue("x_masuk_penyesuaian");
		if (!$this->masuk_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->masuk_penyesuaian->setFormValue($val);
		}

		// Check field name 'keluar' first before field var 'x_keluar'
		$val = $CurrentForm->hasValue("keluar") ? $CurrentForm->getValue("keluar") : $CurrentForm->getValue("x_keluar");
		if (!$this->keluar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar->Visible = FALSE; // Disable update for API request
			else
				$this->keluar->setFormValue($val);
		}

		// Check field name 'keluar_penyesuaian' first before field var 'x_keluar_penyesuaian'
		$val = $CurrentForm->hasValue("keluar_penyesuaian") ? $CurrentForm->getValue("keluar_penyesuaian") : $CurrentForm->getValue("x_keluar_penyesuaian");
		if (!$this->keluar_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_penyesuaian->setFormValue($val);
		}

		// Check field name 'saldo_poin' first before field var 'x_saldo_poin'
		$val = $CurrentForm->hasValue("saldo_poin") ? $CurrentForm->getValue("saldo_poin") : $CurrentForm->getValue("x_saldo_poin");
		if (!$this->saldo_poin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->saldo_poin->Visible = FALSE; // Disable update for API request
			else
				$this->saldo_poin->setFormValue($val);
		}

		// Check field name 'id_kartupoin' first before field var 'x_id_kartupoin'
		$val = $CurrentForm->hasValue("id_kartupoin") ? $CurrentForm->getValue("id_kartupoin") : $CurrentForm->getValue("x_id_kartupoin");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_pelanggan->CurrentValue = $this->id_pelanggan->FormValue;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
		$this->kode_penjualan->CurrentValue = $this->kode_penjualan->FormValue;
		$this->id_penyesuaian_poin->CurrentValue = $this->id_penyesuaian_poin->FormValue;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		$this->masuk->CurrentValue = $this->masuk->FormValue;
		$this->masuk_penyesuaian->CurrentValue = $this->masuk_penyesuaian->FormValue;
		$this->keluar->CurrentValue = $this->keluar->FormValue;
		$this->keluar_penyesuaian->CurrentValue = $this->keluar_penyesuaian->FormValue;
		$this->saldo_poin->CurrentValue = $this->saldo_poin->FormValue;
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
		$this->id_kartupoin->setDbValue($row['id_kartupoin']);
		$this->id_pelanggan->setDbValue($row['id_pelanggan']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->kode_penjualan->setDbValue($row['kode_penjualan']);
		$this->id_penyesuaian_poin->setDbValue($row['id_penyesuaian_poin']);
		$this->tgl->setDbValue($row['tgl']);
		$this->masuk->setDbValue($row['masuk']);
		$this->masuk_penyesuaian->setDbValue($row['masuk_penyesuaian']);
		$this->keluar->setDbValue($row['keluar']);
		$this->keluar_penyesuaian->setDbValue($row['keluar_penyesuaian']);
		$this->saldo_poin->setDbValue($row['saldo_poin']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_kartupoin'] = $this->id_kartupoin->CurrentValue;
		$row['id_pelanggan'] = $this->id_pelanggan->CurrentValue;
		$row['id_klinik'] = $this->id_klinik->CurrentValue;
		$row['kode_penjualan'] = $this->kode_penjualan->CurrentValue;
		$row['id_penyesuaian_poin'] = $this->id_penyesuaian_poin->CurrentValue;
		$row['tgl'] = $this->tgl->CurrentValue;
		$row['masuk'] = $this->masuk->CurrentValue;
		$row['masuk_penyesuaian'] = $this->masuk_penyesuaian->CurrentValue;
		$row['keluar'] = $this->keluar->CurrentValue;
		$row['keluar_penyesuaian'] = $this->keluar_penyesuaian->CurrentValue;
		$row['saldo_poin'] = $this->saldo_poin->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_kartupoin")) != "")
			$this->id_kartupoin->OldValue = $this->getKey("id_kartupoin"); // id_kartupoin
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

		if ($this->masuk->FormValue == $this->masuk->CurrentValue && is_numeric(ConvertToFloatString($this->masuk->CurrentValue)))
			$this->masuk->CurrentValue = ConvertToFloatString($this->masuk->CurrentValue);

		// Convert decimal values if posted back
		if ($this->masuk_penyesuaian->FormValue == $this->masuk_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->masuk_penyesuaian->CurrentValue)))
			$this->masuk_penyesuaian->CurrentValue = ConvertToFloatString($this->masuk_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar->FormValue == $this->keluar->CurrentValue && is_numeric(ConvertToFloatString($this->keluar->CurrentValue)))
			$this->keluar->CurrentValue = ConvertToFloatString($this->keluar->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_penyesuaian->FormValue == $this->keluar_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_penyesuaian->CurrentValue)))
			$this->keluar_penyesuaian->CurrentValue = ConvertToFloatString($this->keluar_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->saldo_poin->FormValue == $this->saldo_poin->CurrentValue && is_numeric(ConvertToFloatString($this->saldo_poin->CurrentValue)))
			$this->saldo_poin->CurrentValue = ConvertToFloatString($this->saldo_poin->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_kartupoin
		// id_pelanggan
		// id_klinik
		// kode_penjualan
		// id_penyesuaian_poin
		// tgl
		// masuk
		// masuk_penyesuaian
		// keluar
		// keluar_penyesuaian
		// saldo_poin

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_kartupoin
			$this->id_kartupoin->ViewValue = $this->id_kartupoin->CurrentValue;
			$this->id_kartupoin->ViewCustomAttributes = "";

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

			// kode_penjualan
			$this->kode_penjualan->ViewValue = $this->kode_penjualan->CurrentValue;
			$this->kode_penjualan->ViewCustomAttributes = "";

			// id_penyesuaian_poin
			$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->CurrentValue;
			$curVal = strval($this->id_penyesuaian_poin->CurrentValue);
			if ($curVal != "") {
				$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->lookupCacheOption($curVal);
				if ($this->id_penyesuaian_poin->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_penyesuaian_poin`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penyesuaian_poin->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penyesuaian_poin->ViewValue = $this->id_penyesuaian_poin->CurrentValue;
					}
				}
			} else {
				$this->id_penyesuaian_poin->ViewValue = NULL;
			}
			$this->id_penyesuaian_poin->ViewCustomAttributes = "";

			// tgl
			$this->tgl->ViewValue = $this->tgl->CurrentValue;
			$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
			$this->tgl->ViewCustomAttributes = "";

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

			// keluar_penyesuaian
			$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
			$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->keluar_penyesuaian->ViewCustomAttributes = "";

			// saldo_poin
			$this->saldo_poin->ViewValue = $this->saldo_poin->CurrentValue;
			$this->saldo_poin->ViewValue = FormatNumber($this->saldo_poin->ViewValue, 2, -2, -2, -2);
			$this->saldo_poin->ViewCustomAttributes = "";

			// id_pelanggan
			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";
			$this->id_pelanggan->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";
			$this->kode_penjualan->TooltipValue = "";

			// id_penyesuaian_poin
			$this->id_penyesuaian_poin->LinkCustomAttributes = "";
			$this->id_penyesuaian_poin->HrefValue = "";
			$this->id_penyesuaian_poin->TooltipValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";
			$this->tgl->TooltipValue = "";

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

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";
			$this->keluar_penyesuaian->TooltipValue = "";

			// saldo_poin
			$this->saldo_poin->LinkCustomAttributes = "";
			$this->saldo_poin->HrefValue = "";
			$this->saldo_poin->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_pelanggan
			$this->id_pelanggan->EditAttrs["class"] = "form-control";
			$this->id_pelanggan->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_pelanggan->CurrentValue));
			if ($curVal != "")
				$this->id_pelanggan->ViewValue = $this->id_pelanggan->lookupCacheOption($curVal);
			else
				$this->id_pelanggan->ViewValue = $this->id_pelanggan->Lookup !== NULL && is_array($this->id_pelanggan->Lookup->Options) ? $curVal : NULL;
			if ($this->id_pelanggan->ViewValue !== NULL) { // Load from cache
				$this->id_pelanggan->EditValue = array_values($this->id_pelanggan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pelanggan`" . SearchString("=", $this->id_pelanggan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_pelanggan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_pelanggan->EditValue = $arwrk;
			}

			// id_klinik
			$this->id_klinik->EditAttrs["class"] = "form-control";
			$this->id_klinik->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_klinik->CurrentValue));
			if ($curVal != "")
				$this->id_klinik->ViewValue = $this->id_klinik->lookupCacheOption($curVal);
			else
				$this->id_klinik->ViewValue = $this->id_klinik->Lookup !== NULL && is_array($this->id_klinik->Lookup->Options) ? $curVal : NULL;
			if ($this->id_klinik->ViewValue !== NULL) { // Load from cache
				$this->id_klinik->EditValue = array_values($this->id_klinik->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->id_klinik->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_klinik->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_klinik->EditValue = $arwrk;
			}

			// kode_penjualan
			$this->kode_penjualan->EditAttrs["class"] = "form-control";
			$this->kode_penjualan->EditCustomAttributes = "";
			if (!$this->kode_penjualan->Raw)
				$this->kode_penjualan->CurrentValue = HtmlDecode($this->kode_penjualan->CurrentValue);
			$this->kode_penjualan->EditValue = HtmlEncode($this->kode_penjualan->CurrentValue);
			$this->kode_penjualan->PlaceHolder = RemoveHtml($this->kode_penjualan->caption());

			// id_penyesuaian_poin
			$this->id_penyesuaian_poin->EditAttrs["class"] = "form-control";
			$this->id_penyesuaian_poin->EditCustomAttributes = "";
			$this->id_penyesuaian_poin->EditValue = HtmlEncode($this->id_penyesuaian_poin->CurrentValue);
			$curVal = strval($this->id_penyesuaian_poin->CurrentValue);
			if ($curVal != "") {
				$this->id_penyesuaian_poin->EditValue = $this->id_penyesuaian_poin->lookupCacheOption($curVal);
				if ($this->id_penyesuaian_poin->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id_penyesuaian_poin`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penyesuaian_poin->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->id_penyesuaian_poin->EditValue = $this->id_penyesuaian_poin->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penyesuaian_poin->EditValue = HtmlEncode($this->id_penyesuaian_poin->CurrentValue);
					}
				}
			} else {
				$this->id_penyesuaian_poin->EditValue = NULL;
			}
			$this->id_penyesuaian_poin->PlaceHolder = RemoveHtml($this->id_penyesuaian_poin->caption());

			// tgl
			$this->tgl->EditAttrs["class"] = "form-control";
			$this->tgl->EditCustomAttributes = "";
			$this->tgl->EditValue = HtmlEncode(FormatDateTime($this->tgl->CurrentValue, 8));
			$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

			// masuk
			$this->masuk->EditAttrs["class"] = "form-control";
			$this->masuk->EditCustomAttributes = "";
			$this->masuk->EditValue = HtmlEncode($this->masuk->CurrentValue);
			$this->masuk->PlaceHolder = RemoveHtml($this->masuk->caption());
			if (strval($this->masuk->EditValue) != "" && is_numeric($this->masuk->EditValue))
				$this->masuk->EditValue = FormatNumber($this->masuk->EditValue, -2, -2, -2, -2);
			

			// masuk_penyesuaian
			$this->masuk_penyesuaian->EditAttrs["class"] = "form-control";
			$this->masuk_penyesuaian->EditCustomAttributes = "";
			$this->masuk_penyesuaian->EditValue = HtmlEncode($this->masuk_penyesuaian->CurrentValue);
			$this->masuk_penyesuaian->PlaceHolder = RemoveHtml($this->masuk_penyesuaian->caption());
			if (strval($this->masuk_penyesuaian->EditValue) != "" && is_numeric($this->masuk_penyesuaian->EditValue))
				$this->masuk_penyesuaian->EditValue = FormatNumber($this->masuk_penyesuaian->EditValue, -2, -2, -2, -2);
			

			// keluar
			$this->keluar->EditAttrs["class"] = "form-control";
			$this->keluar->EditCustomAttributes = "";
			$this->keluar->EditValue = HtmlEncode($this->keluar->CurrentValue);
			$this->keluar->PlaceHolder = RemoveHtml($this->keluar->caption());
			if (strval($this->keluar->EditValue) != "" && is_numeric($this->keluar->EditValue))
				$this->keluar->EditValue = FormatNumber($this->keluar->EditValue, -2, -2, -2, -2);
			

			// keluar_penyesuaian
			$this->keluar_penyesuaian->EditAttrs["class"] = "form-control";
			$this->keluar_penyesuaian->EditCustomAttributes = "";
			$this->keluar_penyesuaian->EditValue = HtmlEncode($this->keluar_penyesuaian->CurrentValue);
			$this->keluar_penyesuaian->PlaceHolder = RemoveHtml($this->keluar_penyesuaian->caption());
			if (strval($this->keluar_penyesuaian->EditValue) != "" && is_numeric($this->keluar_penyesuaian->EditValue))
				$this->keluar_penyesuaian->EditValue = FormatNumber($this->keluar_penyesuaian->EditValue, -2, -2, -2, -2);
			

			// saldo_poin
			$this->saldo_poin->EditAttrs["class"] = "form-control";
			$this->saldo_poin->EditCustomAttributes = "";
			$this->saldo_poin->EditValue = HtmlEncode($this->saldo_poin->CurrentValue);
			$this->saldo_poin->PlaceHolder = RemoveHtml($this->saldo_poin->caption());
			if (strval($this->saldo_poin->EditValue) != "" && is_numeric($this->saldo_poin->EditValue))
				$this->saldo_poin->EditValue = FormatNumber($this->saldo_poin->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// id_pelanggan

			$this->id_pelanggan->LinkCustomAttributes = "";
			$this->id_pelanggan->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// kode_penjualan
			$this->kode_penjualan->LinkCustomAttributes = "";
			$this->kode_penjualan->HrefValue = "";

			// id_penyesuaian_poin
			$this->id_penyesuaian_poin->LinkCustomAttributes = "";
			$this->id_penyesuaian_poin->HrefValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";

			// masuk
			$this->masuk->LinkCustomAttributes = "";
			$this->masuk->HrefValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";

			// keluar
			$this->keluar->LinkCustomAttributes = "";
			$this->keluar->HrefValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";

			// saldo_poin
			$this->saldo_poin->LinkCustomAttributes = "";
			$this->saldo_poin->HrefValue = "";
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
		if ($this->id_pelanggan->Required) {
			if (!$this->id_pelanggan->IsDetailKey && $this->id_pelanggan->FormValue != NULL && $this->id_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_pelanggan->caption(), $this->id_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
			}
		}
		if ($this->kode_penjualan->Required) {
			if (!$this->kode_penjualan->IsDetailKey && $this->kode_penjualan->FormValue != NULL && $this->kode_penjualan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kode_penjualan->caption(), $this->kode_penjualan->RequiredErrorMessage));
			}
		}
		if ($this->id_penyesuaian_poin->Required) {
			if (!$this->id_penyesuaian_poin->IsDetailKey && $this->id_penyesuaian_poin->FormValue != NULL && $this->id_penyesuaian_poin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_penyesuaian_poin->caption(), $this->id_penyesuaian_poin->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_penyesuaian_poin->FormValue)) {
			AddMessage($FormError, $this->id_penyesuaian_poin->errorMessage());
		}
		if ($this->tgl->Required) {
			if (!$this->tgl->IsDetailKey && $this->tgl->FormValue != NULL && $this->tgl->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl->FormValue)) {
			AddMessage($FormError, $this->tgl->errorMessage());
		}
		if ($this->masuk->Required) {
			if (!$this->masuk->IsDetailKey && $this->masuk->FormValue != NULL && $this->masuk->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->masuk->caption(), $this->masuk->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->masuk->FormValue)) {
			AddMessage($FormError, $this->masuk->errorMessage());
		}
		if ($this->masuk_penyesuaian->Required) {
			if (!$this->masuk_penyesuaian->IsDetailKey && $this->masuk_penyesuaian->FormValue != NULL && $this->masuk_penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->masuk_penyesuaian->caption(), $this->masuk_penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->masuk_penyesuaian->FormValue)) {
			AddMessage($FormError, $this->masuk_penyesuaian->errorMessage());
		}
		if ($this->keluar->Required) {
			if (!$this->keluar->IsDetailKey && $this->keluar->FormValue != NULL && $this->keluar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar->caption(), $this->keluar->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar->FormValue)) {
			AddMessage($FormError, $this->keluar->errorMessage());
		}
		if ($this->keluar_penyesuaian->Required) {
			if (!$this->keluar_penyesuaian->IsDetailKey && $this->keluar_penyesuaian->FormValue != NULL && $this->keluar_penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_penyesuaian->caption(), $this->keluar_penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_penyesuaian->FormValue)) {
			AddMessage($FormError, $this->keluar_penyesuaian->errorMessage());
		}
		if ($this->saldo_poin->Required) {
			if (!$this->saldo_poin->IsDetailKey && $this->saldo_poin->FormValue != NULL && $this->saldo_poin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->saldo_poin->caption(), $this->saldo_poin->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->saldo_poin->FormValue)) {
			AddMessage($FormError, $this->saldo_poin->errorMessage());
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

		// id_pelanggan
		$this->id_pelanggan->setDbValueDef($rsnew, $this->id_pelanggan->CurrentValue, NULL, FALSE);

		// id_klinik
		$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, NULL, FALSE);

		// kode_penjualan
		$this->kode_penjualan->setDbValueDef($rsnew, $this->kode_penjualan->CurrentValue, NULL, FALSE);

		// id_penyesuaian_poin
		$this->id_penyesuaian_poin->setDbValueDef($rsnew, $this->id_penyesuaian_poin->CurrentValue, NULL, FALSE);

		// tgl
		$this->tgl->setDbValueDef($rsnew, UnFormatDateTime($this->tgl->CurrentValue, 0), NULL, FALSE);

		// masuk
		$this->masuk->setDbValueDef($rsnew, $this->masuk->CurrentValue, NULL, FALSE);

		// masuk_penyesuaian
		$this->masuk_penyesuaian->setDbValueDef($rsnew, $this->masuk_penyesuaian->CurrentValue, NULL, FALSE);

		// keluar
		$this->keluar->setDbValueDef($rsnew, $this->keluar->CurrentValue, NULL, FALSE);

		// keluar_penyesuaian
		$this->keluar_penyesuaian->setDbValueDef($rsnew, $this->keluar_penyesuaian->CurrentValue, NULL, FALSE);

		// saldo_poin
		$this->saldo_poin->setDbValueDef($rsnew, $this->saldo_poin->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("kartupoinlist.php"), "", $this->TableVar, TRUE);
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
				case "x_id_pelanggan":
					break;
				case "x_id_klinik":
					break;
				case "x_id_penyesuaian_poin":
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
						case "x_id_klinik":
							break;
						case "x_id_penyesuaian_poin":
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