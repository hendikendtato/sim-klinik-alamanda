<?php
namespace PHPMaker2020\klinik_latest_08_04_21;

/**
 * Page class
 */
class rekapstok_edit extends rekapstok
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{4E2A1FD4-0074-4494-903F-430527A228F4}";

	// Table name
	public $TableName = 'rekapstok';

	// Page object name
	public $PageObjName = "rekapstok_edit";

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

		// Table object (rekapstok)
		if (!isset($GLOBALS["rekapstok"]) || get_class($GLOBALS["rekapstok"]) == PROJECT_NAMESPACE . "rekapstok") {
			$GLOBALS["rekapstok"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rekapstok"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'rekapstok');

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
		global $rekapstok;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($rekapstok);
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
					if ($pageName == "rekapstokview.php")
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
			$key .= @$ar['id_rekapstok'];
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
			$this->id_rekapstok->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("rekapstoklist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_rekapstok->setVisibility();
		$this->id_barang->setVisibility();
		$this->tanggal->setVisibility();
		$this->masuk_saldoawal->setVisibility();
		$this->masuk_beli->setVisibility();
		$this->masuk_penyesuaian->setVisibility();
		$this->keluar_jual->setVisibility();
		$this->keluar_perpindahan->setVisibility();
		$this->keluar_penyesuaian->setVisibility();
		$this->keluar_pengembalian->setVisibility();
		$this->stok->setVisibility();
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

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("rekapstoklist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id_rekapstok") !== NULL) {
				$this->id_rekapstok->setQueryStringValue(Get("id_rekapstok"));
				$this->id_rekapstok->setOldValue($this->id_rekapstok->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id_rekapstok->setQueryStringValue(Key(0));
				$this->id_rekapstok->setOldValue($this->id_rekapstok->QueryStringValue);
			} elseif (Post("id_rekapstok") !== NULL) {
				$this->id_rekapstok->setFormValue(Post("id_rekapstok"));
				$this->id_rekapstok->setOldValue($this->id_rekapstok->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id_rekapstok->setQueryStringValue(Route(2));
				$this->id_rekapstok->setOldValue($this->id_rekapstok->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id_rekapstok")) {
					$this->id_rekapstok->setFormValue($CurrentForm->getValue("x_id_rekapstok"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id_rekapstok") !== NULL) {
					$this->id_rekapstok->setQueryStringValue(Get("id_rekapstok"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id_rekapstok->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id_rekapstok->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("rekapstoklist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "rekapstoklist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_rekapstok' first before field var 'x_id_rekapstok'
		$val = $CurrentForm->hasValue("id_rekapstok") ? $CurrentForm->getValue("id_rekapstok") : $CurrentForm->getValue("x_id_rekapstok");
		if (!$this->id_rekapstok->IsDetailKey)
			$this->id_rekapstok->setFormValue($val);

		// Check field name 'id_barang' first before field var 'x_id_barang'
		$val = $CurrentForm->hasValue("id_barang") ? $CurrentForm->getValue("id_barang") : $CurrentForm->getValue("x_id_barang");
		if (!$this->id_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_barang->Visible = FALSE; // Disable update for API request
			else
				$this->id_barang->setFormValue($val);
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

		// Check field name 'masuk_saldoawal' first before field var 'x_masuk_saldoawal'
		$val = $CurrentForm->hasValue("masuk_saldoawal") ? $CurrentForm->getValue("masuk_saldoawal") : $CurrentForm->getValue("x_masuk_saldoawal");
		if (!$this->masuk_saldoawal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk_saldoawal->Visible = FALSE; // Disable update for API request
			else
				$this->masuk_saldoawal->setFormValue($val);
		}

		// Check field name 'masuk_beli' first before field var 'x_masuk_beli'
		$val = $CurrentForm->hasValue("masuk_beli") ? $CurrentForm->getValue("masuk_beli") : $CurrentForm->getValue("x_masuk_beli");
		if (!$this->masuk_beli->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk_beli->Visible = FALSE; // Disable update for API request
			else
				$this->masuk_beli->setFormValue($val);
		}

		// Check field name 'masuk_penyesuaian' first before field var 'x_masuk_penyesuaian'
		$val = $CurrentForm->hasValue("masuk_penyesuaian") ? $CurrentForm->getValue("masuk_penyesuaian") : $CurrentForm->getValue("x_masuk_penyesuaian");
		if (!$this->masuk_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masuk_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->masuk_penyesuaian->setFormValue($val);
		}

		// Check field name 'keluar_jual' first before field var 'x_keluar_jual'
		$val = $CurrentForm->hasValue("keluar_jual") ? $CurrentForm->getValue("keluar_jual") : $CurrentForm->getValue("x_keluar_jual");
		if (!$this->keluar_jual->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_jual->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_jual->setFormValue($val);
		}

		// Check field name 'keluar_perpindahan' first before field var 'x_keluar_perpindahan'
		$val = $CurrentForm->hasValue("keluar_perpindahan") ? $CurrentForm->getValue("keluar_perpindahan") : $CurrentForm->getValue("x_keluar_perpindahan");
		if (!$this->keluar_perpindahan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_perpindahan->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_perpindahan->setFormValue($val);
		}

		// Check field name 'keluar_penyesuaian' first before field var 'x_keluar_penyesuaian'
		$val = $CurrentForm->hasValue("keluar_penyesuaian") ? $CurrentForm->getValue("keluar_penyesuaian") : $CurrentForm->getValue("x_keluar_penyesuaian");
		if (!$this->keluar_penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_penyesuaian->setFormValue($val);
		}

		// Check field name 'keluar_pengembalian' first before field var 'x_keluar_pengembalian'
		$val = $CurrentForm->hasValue("keluar_pengembalian") ? $CurrentForm->getValue("keluar_pengembalian") : $CurrentForm->getValue("x_keluar_pengembalian");
		if (!$this->keluar_pengembalian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keluar_pengembalian->Visible = FALSE; // Disable update for API request
			else
				$this->keluar_pengembalian->setFormValue($val);
		}

		// Check field name 'stok' first before field var 'x_stok'
		$val = $CurrentForm->hasValue("stok") ? $CurrentForm->getValue("stok") : $CurrentForm->getValue("x_stok");
		if (!$this->stok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok->Visible = FALSE; // Disable update for API request
			else
				$this->stok->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_rekapstok->CurrentValue = $this->id_rekapstok->FormValue;
		$this->id_barang->CurrentValue = $this->id_barang->FormValue;
		$this->tanggal->CurrentValue = $this->tanggal->FormValue;
		$this->tanggal->CurrentValue = UnFormatDateTime($this->tanggal->CurrentValue, 0);
		$this->masuk_saldoawal->CurrentValue = $this->masuk_saldoawal->FormValue;
		$this->masuk_beli->CurrentValue = $this->masuk_beli->FormValue;
		$this->masuk_penyesuaian->CurrentValue = $this->masuk_penyesuaian->FormValue;
		$this->keluar_jual->CurrentValue = $this->keluar_jual->FormValue;
		$this->keluar_perpindahan->CurrentValue = $this->keluar_perpindahan->FormValue;
		$this->keluar_penyesuaian->CurrentValue = $this->keluar_penyesuaian->FormValue;
		$this->keluar_pengembalian->CurrentValue = $this->keluar_pengembalian->FormValue;
		$this->stok->CurrentValue = $this->stok->FormValue;
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
		$this->id_rekapstok->setDbValue($row['id_rekapstok']);
		$this->id_barang->setDbValue($row['id_barang']);
		$this->tanggal->setDbValue($row['tanggal']);
		$this->masuk_saldoawal->setDbValue($row['masuk_saldoawal']);
		$this->masuk_beli->setDbValue($row['masuk_beli']);
		$this->masuk_penyesuaian->setDbValue($row['masuk_penyesuaian']);
		$this->keluar_jual->setDbValue($row['keluar_jual']);
		$this->keluar_perpindahan->setDbValue($row['keluar_perpindahan']);
		$this->keluar_penyesuaian->setDbValue($row['keluar_penyesuaian']);
		$this->keluar_pengembalian->setDbValue($row['keluar_pengembalian']);
		$this->stok->setDbValue($row['stok']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_rekapstok'] = NULL;
		$row['id_barang'] = NULL;
		$row['tanggal'] = NULL;
		$row['masuk_saldoawal'] = NULL;
		$row['masuk_beli'] = NULL;
		$row['masuk_penyesuaian'] = NULL;
		$row['keluar_jual'] = NULL;
		$row['keluar_perpindahan'] = NULL;
		$row['keluar_penyesuaian'] = NULL;
		$row['keluar_pengembalian'] = NULL;
		$row['stok'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_rekapstok")) != "")
			$this->id_rekapstok->OldValue = $this->getKey("id_rekapstok"); // id_rekapstok
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

		if ($this->masuk_saldoawal->FormValue == $this->masuk_saldoawal->CurrentValue && is_numeric(ConvertToFloatString($this->masuk_saldoawal->CurrentValue)))
			$this->masuk_saldoawal->CurrentValue = ConvertToFloatString($this->masuk_saldoawal->CurrentValue);

		// Convert decimal values if posted back
		if ($this->masuk_beli->FormValue == $this->masuk_beli->CurrentValue && is_numeric(ConvertToFloatString($this->masuk_beli->CurrentValue)))
			$this->masuk_beli->CurrentValue = ConvertToFloatString($this->masuk_beli->CurrentValue);

		// Convert decimal values if posted back
		if ($this->masuk_penyesuaian->FormValue == $this->masuk_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->masuk_penyesuaian->CurrentValue)))
			$this->masuk_penyesuaian->CurrentValue = ConvertToFloatString($this->masuk_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_jual->FormValue == $this->keluar_jual->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_jual->CurrentValue)))
			$this->keluar_jual->CurrentValue = ConvertToFloatString($this->keluar_jual->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_perpindahan->FormValue == $this->keluar_perpindahan->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_perpindahan->CurrentValue)))
			$this->keluar_perpindahan->CurrentValue = ConvertToFloatString($this->keluar_perpindahan->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_penyesuaian->FormValue == $this->keluar_penyesuaian->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_penyesuaian->CurrentValue)))
			$this->keluar_penyesuaian->CurrentValue = ConvertToFloatString($this->keluar_penyesuaian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->keluar_pengembalian->FormValue == $this->keluar_pengembalian->CurrentValue && is_numeric(ConvertToFloatString($this->keluar_pengembalian->CurrentValue)))
			$this->keluar_pengembalian->CurrentValue = ConvertToFloatString($this->keluar_pengembalian->CurrentValue);

		// Convert decimal values if posted back
		if ($this->stok->FormValue == $this->stok->CurrentValue && is_numeric(ConvertToFloatString($this->stok->CurrentValue)))
			$this->stok->CurrentValue = ConvertToFloatString($this->stok->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_rekapstok
		// id_barang
		// tanggal
		// masuk_saldoawal
		// masuk_beli
		// masuk_penyesuaian
		// keluar_jual
		// keluar_perpindahan
		// keluar_penyesuaian
		// keluar_pengembalian
		// stok

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_rekapstok
			$this->id_rekapstok->ViewValue = $this->id_rekapstok->CurrentValue;
			$this->id_rekapstok->ViewCustomAttributes = "";

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
						$arwrk[2] = $rswrk->fields('df2');
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

			// tanggal
			$this->tanggal->ViewValue = $this->tanggal->CurrentValue;
			$this->tanggal->ViewValue = FormatDateTime($this->tanggal->ViewValue, 0);
			$this->tanggal->ViewCustomAttributes = "";

			// masuk_saldoawal
			$this->masuk_saldoawal->ViewValue = $this->masuk_saldoawal->CurrentValue;
			$this->masuk_saldoawal->ViewValue = FormatNumber($this->masuk_saldoawal->ViewValue, 2, -2, -2, -2);
			$this->masuk_saldoawal->ViewCustomAttributes = "";

			// masuk_beli
			$this->masuk_beli->ViewValue = $this->masuk_beli->CurrentValue;
			$this->masuk_beli->ViewValue = FormatNumber($this->masuk_beli->ViewValue, 2, -2, -2, -2);
			$this->masuk_beli->ViewCustomAttributes = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->ViewValue = $this->masuk_penyesuaian->CurrentValue;
			$this->masuk_penyesuaian->ViewValue = FormatNumber($this->masuk_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->masuk_penyesuaian->ViewCustomAttributes = "";

			// keluar_jual
			$this->keluar_jual->ViewValue = $this->keluar_jual->CurrentValue;
			$this->keluar_jual->ViewValue = FormatNumber($this->keluar_jual->ViewValue, 2, -2, -2, -2);
			$this->keluar_jual->ViewCustomAttributes = "";

			// keluar_perpindahan
			$this->keluar_perpindahan->ViewValue = $this->keluar_perpindahan->CurrentValue;
			$this->keluar_perpindahan->ViewValue = FormatNumber($this->keluar_perpindahan->ViewValue, 2, -2, -2, -2);
			$this->keluar_perpindahan->ViewCustomAttributes = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->ViewValue = $this->keluar_penyesuaian->CurrentValue;
			$this->keluar_penyesuaian->ViewValue = FormatNumber($this->keluar_penyesuaian->ViewValue, 2, -2, -2, -2);
			$this->keluar_penyesuaian->ViewCustomAttributes = "";

			// keluar_pengembalian
			$this->keluar_pengembalian->ViewValue = $this->keluar_pengembalian->CurrentValue;
			$this->keluar_pengembalian->ViewValue = FormatNumber($this->keluar_pengembalian->ViewValue, 2, -2, -2, -2);
			$this->keluar_pengembalian->ViewCustomAttributes = "";

			// stok
			$this->stok->ViewValue = $this->stok->CurrentValue;
			$this->stok->ViewValue = FormatNumber($this->stok->ViewValue, 2, -2, -2, -2);
			$this->stok->ViewCustomAttributes = "";

			// id_rekapstok
			$this->id_rekapstok->LinkCustomAttributes = "";
			$this->id_rekapstok->HrefValue = "";
			$this->id_rekapstok->TooltipValue = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";
			$this->id_barang->TooltipValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";
			$this->tanggal->TooltipValue = "";

			// masuk_saldoawal
			$this->masuk_saldoawal->LinkCustomAttributes = "";
			$this->masuk_saldoawal->HrefValue = "";
			$this->masuk_saldoawal->TooltipValue = "";

			// masuk_beli
			$this->masuk_beli->LinkCustomAttributes = "";
			$this->masuk_beli->HrefValue = "";
			$this->masuk_beli->TooltipValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";
			$this->masuk_penyesuaian->TooltipValue = "";

			// keluar_jual
			$this->keluar_jual->LinkCustomAttributes = "";
			$this->keluar_jual->HrefValue = "";
			$this->keluar_jual->TooltipValue = "";

			// keluar_perpindahan
			$this->keluar_perpindahan->LinkCustomAttributes = "";
			$this->keluar_perpindahan->HrefValue = "";
			$this->keluar_perpindahan->TooltipValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";
			$this->keluar_penyesuaian->TooltipValue = "";

			// keluar_pengembalian
			$this->keluar_pengembalian->LinkCustomAttributes = "";
			$this->keluar_pengembalian->HrefValue = "";
			$this->keluar_pengembalian->TooltipValue = "";

			// stok
			$this->stok->LinkCustomAttributes = "";
			$this->stok->HrefValue = "";
			$this->stok->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_rekapstok
			$this->id_rekapstok->EditAttrs["class"] = "form-control";
			$this->id_rekapstok->EditCustomAttributes = "";
			$this->id_rekapstok->EditValue = $this->id_rekapstok->CurrentValue;
			$this->id_rekapstok->ViewCustomAttributes = "";

			// id_barang
			$this->id_barang->EditAttrs["class"] = "form-control";
			$this->id_barang->EditCustomAttributes = "";
			$this->id_barang->EditValue = HtmlEncode($this->id_barang->CurrentValue);
			$curVal = strval($this->id_barang->CurrentValue);
			if ($curVal != "") {
				$this->id_barang->EditValue = $this->id_barang->lookupCacheOption($curVal);
				if ($this->id_barang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_barang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$arwrk[2] = HtmlEncode($rswrk->fields('df2'));
						$this->id_barang->EditValue = $this->id_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_barang->EditValue = HtmlEncode($this->id_barang->CurrentValue);
					}
				}
			} else {
				$this->id_barang->EditValue = NULL;
			}
			$this->id_barang->PlaceHolder = RemoveHtml($this->id_barang->caption());

			// tanggal
			$this->tanggal->EditAttrs["class"] = "form-control";
			$this->tanggal->EditCustomAttributes = "";
			$this->tanggal->EditValue = HtmlEncode(FormatDateTime($this->tanggal->CurrentValue, 8));
			$this->tanggal->PlaceHolder = RemoveHtml($this->tanggal->caption());

			// masuk_saldoawal
			$this->masuk_saldoawal->EditAttrs["class"] = "form-control";
			$this->masuk_saldoawal->EditCustomAttributes = "";
			$this->masuk_saldoawal->EditValue = HtmlEncode($this->masuk_saldoawal->CurrentValue);
			$this->masuk_saldoawal->PlaceHolder = RemoveHtml($this->masuk_saldoawal->caption());
			if (strval($this->masuk_saldoawal->EditValue) != "" && is_numeric($this->masuk_saldoawal->EditValue))
				$this->masuk_saldoawal->EditValue = FormatNumber($this->masuk_saldoawal->EditValue, -2, -2, -2, -2);
			

			// masuk_beli
			$this->masuk_beli->EditAttrs["class"] = "form-control";
			$this->masuk_beli->EditCustomAttributes = "";
			$this->masuk_beli->EditValue = HtmlEncode($this->masuk_beli->CurrentValue);
			$this->masuk_beli->PlaceHolder = RemoveHtml($this->masuk_beli->caption());
			if (strval($this->masuk_beli->EditValue) != "" && is_numeric($this->masuk_beli->EditValue))
				$this->masuk_beli->EditValue = FormatNumber($this->masuk_beli->EditValue, -2, -2, -2, -2);
			

			// masuk_penyesuaian
			$this->masuk_penyesuaian->EditAttrs["class"] = "form-control";
			$this->masuk_penyesuaian->EditCustomAttributes = "";
			$this->masuk_penyesuaian->EditValue = HtmlEncode($this->masuk_penyesuaian->CurrentValue);
			$this->masuk_penyesuaian->PlaceHolder = RemoveHtml($this->masuk_penyesuaian->caption());
			if (strval($this->masuk_penyesuaian->EditValue) != "" && is_numeric($this->masuk_penyesuaian->EditValue))
				$this->masuk_penyesuaian->EditValue = FormatNumber($this->masuk_penyesuaian->EditValue, -2, -2, -2, -2);
			

			// keluar_jual
			$this->keluar_jual->EditAttrs["class"] = "form-control";
			$this->keluar_jual->EditCustomAttributes = "";
			$this->keluar_jual->EditValue = HtmlEncode($this->keluar_jual->CurrentValue);
			$this->keluar_jual->PlaceHolder = RemoveHtml($this->keluar_jual->caption());
			if (strval($this->keluar_jual->EditValue) != "" && is_numeric($this->keluar_jual->EditValue))
				$this->keluar_jual->EditValue = FormatNumber($this->keluar_jual->EditValue, -2, -2, -2, -2);
			

			// keluar_perpindahan
			$this->keluar_perpindahan->EditAttrs["class"] = "form-control";
			$this->keluar_perpindahan->EditCustomAttributes = "";
			$this->keluar_perpindahan->EditValue = HtmlEncode($this->keluar_perpindahan->CurrentValue);
			$this->keluar_perpindahan->PlaceHolder = RemoveHtml($this->keluar_perpindahan->caption());
			if (strval($this->keluar_perpindahan->EditValue) != "" && is_numeric($this->keluar_perpindahan->EditValue))
				$this->keluar_perpindahan->EditValue = FormatNumber($this->keluar_perpindahan->EditValue, -2, -2, -2, -2);
			

			// keluar_penyesuaian
			$this->keluar_penyesuaian->EditAttrs["class"] = "form-control";
			$this->keluar_penyesuaian->EditCustomAttributes = "";
			$this->keluar_penyesuaian->EditValue = HtmlEncode($this->keluar_penyesuaian->CurrentValue);
			$this->keluar_penyesuaian->PlaceHolder = RemoveHtml($this->keluar_penyesuaian->caption());
			if (strval($this->keluar_penyesuaian->EditValue) != "" && is_numeric($this->keluar_penyesuaian->EditValue))
				$this->keluar_penyesuaian->EditValue = FormatNumber($this->keluar_penyesuaian->EditValue, -2, -2, -2, -2);
			

			// keluar_pengembalian
			$this->keluar_pengembalian->EditAttrs["class"] = "form-control";
			$this->keluar_pengembalian->EditCustomAttributes = "";
			$this->keluar_pengembalian->EditValue = HtmlEncode($this->keluar_pengembalian->CurrentValue);
			$this->keluar_pengembalian->PlaceHolder = RemoveHtml($this->keluar_pengembalian->caption());
			if (strval($this->keluar_pengembalian->EditValue) != "" && is_numeric($this->keluar_pengembalian->EditValue))
				$this->keluar_pengembalian->EditValue = FormatNumber($this->keluar_pengembalian->EditValue, -2, -2, -2, -2);
			

			// stok
			$this->stok->EditAttrs["class"] = "form-control";
			$this->stok->EditCustomAttributes = "";
			$this->stok->EditValue = HtmlEncode($this->stok->CurrentValue);
			$this->stok->PlaceHolder = RemoveHtml($this->stok->caption());
			if (strval($this->stok->EditValue) != "" && is_numeric($this->stok->EditValue))
				$this->stok->EditValue = FormatNumber($this->stok->EditValue, -2, -2, -2, -2);
			

			// Edit refer script
			// id_rekapstok

			$this->id_rekapstok->LinkCustomAttributes = "";
			$this->id_rekapstok->HrefValue = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";

			// tanggal
			$this->tanggal->LinkCustomAttributes = "";
			$this->tanggal->HrefValue = "";

			// masuk_saldoawal
			$this->masuk_saldoawal->LinkCustomAttributes = "";
			$this->masuk_saldoawal->HrefValue = "";

			// masuk_beli
			$this->masuk_beli->LinkCustomAttributes = "";
			$this->masuk_beli->HrefValue = "";

			// masuk_penyesuaian
			$this->masuk_penyesuaian->LinkCustomAttributes = "";
			$this->masuk_penyesuaian->HrefValue = "";

			// keluar_jual
			$this->keluar_jual->LinkCustomAttributes = "";
			$this->keluar_jual->HrefValue = "";

			// keluar_perpindahan
			$this->keluar_perpindahan->LinkCustomAttributes = "";
			$this->keluar_perpindahan->HrefValue = "";

			// keluar_penyesuaian
			$this->keluar_penyesuaian->LinkCustomAttributes = "";
			$this->keluar_penyesuaian->HrefValue = "";

			// keluar_pengembalian
			$this->keluar_pengembalian->LinkCustomAttributes = "";
			$this->keluar_pengembalian->HrefValue = "";

			// stok
			$this->stok->LinkCustomAttributes = "";
			$this->stok->HrefValue = "";
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
		if ($this->id_rekapstok->Required) {
			if (!$this->id_rekapstok->IsDetailKey && $this->id_rekapstok->FormValue != NULL && $this->id_rekapstok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_rekapstok->caption(), $this->id_rekapstok->RequiredErrorMessage));
			}
		}
		if ($this->id_barang->Required) {
			if (!$this->id_barang->IsDetailKey && $this->id_barang->FormValue != NULL && $this->id_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_barang->caption(), $this->id_barang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->id_barang->FormValue)) {
			AddMessage($FormError, $this->id_barang->errorMessage());
		}
		if ($this->tanggal->Required) {
			if (!$this->tanggal->IsDetailKey && $this->tanggal->FormValue != NULL && $this->tanggal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tanggal->caption(), $this->tanggal->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tanggal->FormValue)) {
			AddMessage($FormError, $this->tanggal->errorMessage());
		}
		if ($this->masuk_saldoawal->Required) {
			if (!$this->masuk_saldoawal->IsDetailKey && $this->masuk_saldoawal->FormValue != NULL && $this->masuk_saldoawal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->masuk_saldoawal->caption(), $this->masuk_saldoawal->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->masuk_saldoawal->FormValue)) {
			AddMessage($FormError, $this->masuk_saldoawal->errorMessage());
		}
		if ($this->masuk_beli->Required) {
			if (!$this->masuk_beli->IsDetailKey && $this->masuk_beli->FormValue != NULL && $this->masuk_beli->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->masuk_beli->caption(), $this->masuk_beli->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->masuk_beli->FormValue)) {
			AddMessage($FormError, $this->masuk_beli->errorMessage());
		}
		if ($this->masuk_penyesuaian->Required) {
			if (!$this->masuk_penyesuaian->IsDetailKey && $this->masuk_penyesuaian->FormValue != NULL && $this->masuk_penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->masuk_penyesuaian->caption(), $this->masuk_penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->masuk_penyesuaian->FormValue)) {
			AddMessage($FormError, $this->masuk_penyesuaian->errorMessage());
		}
		if ($this->keluar_jual->Required) {
			if (!$this->keluar_jual->IsDetailKey && $this->keluar_jual->FormValue != NULL && $this->keluar_jual->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_jual->caption(), $this->keluar_jual->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_jual->FormValue)) {
			AddMessage($FormError, $this->keluar_jual->errorMessage());
		}
		if ($this->keluar_perpindahan->Required) {
			if (!$this->keluar_perpindahan->IsDetailKey && $this->keluar_perpindahan->FormValue != NULL && $this->keluar_perpindahan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_perpindahan->caption(), $this->keluar_perpindahan->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_perpindahan->FormValue)) {
			AddMessage($FormError, $this->keluar_perpindahan->errorMessage());
		}
		if ($this->keluar_penyesuaian->Required) {
			if (!$this->keluar_penyesuaian->IsDetailKey && $this->keluar_penyesuaian->FormValue != NULL && $this->keluar_penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_penyesuaian->caption(), $this->keluar_penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_penyesuaian->FormValue)) {
			AddMessage($FormError, $this->keluar_penyesuaian->errorMessage());
		}
		if ($this->keluar_pengembalian->Required) {
			if (!$this->keluar_pengembalian->IsDetailKey && $this->keluar_pengembalian->FormValue != NULL && $this->keluar_pengembalian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keluar_pengembalian->caption(), $this->keluar_pengembalian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->keluar_pengembalian->FormValue)) {
			AddMessage($FormError, $this->keluar_pengembalian->errorMessage());
		}
		if ($this->stok->Required) {
			if (!$this->stok->IsDetailKey && $this->stok->FormValue != NULL && $this->stok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok->caption(), $this->stok->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->stok->FormValue)) {
			AddMessage($FormError, $this->stok->errorMessage());
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// id_barang
			$this->id_barang->setDbValueDef($rsnew, $this->id_barang->CurrentValue, NULL, $this->id_barang->ReadOnly);

			// tanggal
			$this->tanggal->setDbValueDef($rsnew, UnFormatDateTime($this->tanggal->CurrentValue, 0), NULL, $this->tanggal->ReadOnly);

			// masuk_saldoawal
			$this->masuk_saldoawal->setDbValueDef($rsnew, $this->masuk_saldoawal->CurrentValue, NULL, $this->masuk_saldoawal->ReadOnly);

			// masuk_beli
			$this->masuk_beli->setDbValueDef($rsnew, $this->masuk_beli->CurrentValue, NULL, $this->masuk_beli->ReadOnly);

			// masuk_penyesuaian
			$this->masuk_penyesuaian->setDbValueDef($rsnew, $this->masuk_penyesuaian->CurrentValue, NULL, $this->masuk_penyesuaian->ReadOnly);

			// keluar_jual
			$this->keluar_jual->setDbValueDef($rsnew, $this->keluar_jual->CurrentValue, NULL, $this->keluar_jual->ReadOnly);

			// keluar_perpindahan
			$this->keluar_perpindahan->setDbValueDef($rsnew, $this->keluar_perpindahan->CurrentValue, NULL, $this->keluar_perpindahan->ReadOnly);

			// keluar_penyesuaian
			$this->keluar_penyesuaian->setDbValueDef($rsnew, $this->keluar_penyesuaian->CurrentValue, NULL, $this->keluar_penyesuaian->ReadOnly);

			// keluar_pengembalian
			$this->keluar_pengembalian->setDbValueDef($rsnew, $this->keluar_pengembalian->CurrentValue, NULL, $this->keluar_pengembalian->ReadOnly);

			// stok
			$this->stok->setDbValueDef($rsnew, $this->stok->CurrentValue, NULL, $this->stok->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("rekapstoklist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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