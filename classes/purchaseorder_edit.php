<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class purchaseorder_edit extends purchaseorder
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'purchaseorder';

	// Page object name
	public $PageObjName = "purchaseorder_edit";

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

		// Table object (purchaseorder)
		if (!isset($GLOBALS["purchaseorder"]) || get_class($GLOBALS["purchaseorder"]) == PROJECT_NAMESPACE . "purchaseorder") {
			$GLOBALS["purchaseorder"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["purchaseorder"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'purchaseorder');

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
		global $purchaseorder;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($purchaseorder);
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
					if ($pageName == "purchaseorderview.php")
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
			$key .= @$ar['id_po'];
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
			$this->id_po->Visible = FALSE;
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
					$this->terminate(GetUrl("purchaseorderlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_po->Visible = FALSE;
		$this->no_po->setVisibility();
		$this->tgl_po->setVisibility();
		$this->idstaff_po->setVisibility();
		$this->idklinik->setVisibility();
		$this->id_supplier->setVisibility();
		$this->status_po->setVisibility();
		$this->keterangan->setVisibility();
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
		$this->setupLookupOptions($this->idstaff_po);
		$this->setupLookupOptions($this->idklinik);
		$this->setupLookupOptions($this->id_supplier);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("purchaseorderlist.php");
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
			if (Get("id_po") !== NULL) {
				$this->id_po->setQueryStringValue(Get("id_po"));
				$this->id_po->setOldValue($this->id_po->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id_po->setQueryStringValue(Key(0));
				$this->id_po->setOldValue($this->id_po->QueryStringValue);
			} elseif (Post("id_po") !== NULL) {
				$this->id_po->setFormValue(Post("id_po"));
				$this->id_po->setOldValue($this->id_po->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id_po->setQueryStringValue(Route(2));
				$this->id_po->setOldValue($this->id_po->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_id_po")) {
					$this->id_po->setFormValue($CurrentForm->getValue("x_id_po"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id_po") !== NULL) {
					$this->id_po->setQueryStringValue(Get("id_po"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id_po->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id_po->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values

			// Set up detail parameters
			$this->setupDetailParms();
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
					$this->terminate("purchaseorderlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				if ($this->getCurrentDetailTable() != "") // Master/detail edit
					$returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "purchaseorderlist.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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

		// Check field name 'no_po' first before field var 'x_no_po'
		$val = $CurrentForm->hasValue("no_po") ? $CurrentForm->getValue("no_po") : $CurrentForm->getValue("x_no_po");
		if (!$this->no_po->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->no_po->Visible = FALSE; // Disable update for API request
			else
				$this->no_po->setFormValue($val);
		}

		// Check field name 'tgl_po' first before field var 'x_tgl_po'
		$val = $CurrentForm->hasValue("tgl_po") ? $CurrentForm->getValue("tgl_po") : $CurrentForm->getValue("x_tgl_po");
		if (!$this->tgl_po->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->tgl_po->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_po->setFormValue($val);
			$this->tgl_po->CurrentValue = UnFormatDateTime($this->tgl_po->CurrentValue, 0);
		}

		// Check field name 'idstaff_po' first before field var 'x_idstaff_po'
		$val = $CurrentForm->hasValue("idstaff_po") ? $CurrentForm->getValue("idstaff_po") : $CurrentForm->getValue("x_idstaff_po");
		if (!$this->idstaff_po->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idstaff_po->Visible = FALSE; // Disable update for API request
			else
				$this->idstaff_po->setFormValue($val);
		}

		// Check field name 'idklinik' first before field var 'x_idklinik'
		$val = $CurrentForm->hasValue("idklinik") ? $CurrentForm->getValue("idklinik") : $CurrentForm->getValue("x_idklinik");
		if (!$this->idklinik->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->idklinik->Visible = FALSE; // Disable update for API request
			else
				$this->idklinik->setFormValue($val);
		}

		// Check field name 'id_supplier' first before field var 'x_id_supplier'
		$val = $CurrentForm->hasValue("id_supplier") ? $CurrentForm->getValue("id_supplier") : $CurrentForm->getValue("x_id_supplier");
		if (!$this->id_supplier->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->id_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->id_supplier->setFormValue($val);
		}

		// Check field name 'status_po' first before field var 'x_status_po'
		$val = $CurrentForm->hasValue("status_po") ? $CurrentForm->getValue("status_po") : $CurrentForm->getValue("x_status_po");
		if (!$this->status_po->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->status_po->Visible = FALSE; // Disable update for API request
			else
				$this->status_po->setFormValue($val);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}

		// Check field name 'id_po' first before field var 'x_id_po'
		$val = $CurrentForm->hasValue("id_po") ? $CurrentForm->getValue("id_po") : $CurrentForm->getValue("x_id_po");
		if (!$this->id_po->IsDetailKey)
			$this->id_po->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_po->CurrentValue = $this->id_po->FormValue;
		$this->no_po->CurrentValue = $this->no_po->FormValue;
		$this->tgl_po->CurrentValue = $this->tgl_po->FormValue;
		$this->tgl_po->CurrentValue = UnFormatDateTime($this->tgl_po->CurrentValue, 0);
		$this->idstaff_po->CurrentValue = $this->idstaff_po->FormValue;
		$this->idklinik->CurrentValue = $this->idklinik->FormValue;
		$this->id_supplier->CurrentValue = $this->id_supplier->FormValue;
		$this->status_po->CurrentValue = $this->status_po->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
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
		$this->id_po->setDbValue($row['id_po']);
		$this->no_po->setDbValue($row['no_po']);
		$this->tgl_po->setDbValue($row['tgl_po']);
		$this->idstaff_po->setDbValue($row['idstaff_po']);
		$this->idklinik->setDbValue($row['idklinik']);
		$this->id_supplier->setDbValue($row['id_supplier']);
		$this->status_po->setDbValue($row['status_po']);
		$this->keterangan->setDbValue($row['keterangan']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_po'] = NULL;
		$row['no_po'] = NULL;
		$row['tgl_po'] = NULL;
		$row['idstaff_po'] = NULL;
		$row['idklinik'] = NULL;
		$row['id_supplier'] = NULL;
		$row['status_po'] = NULL;
		$row['keterangan'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_po")) != "")
			$this->id_po->OldValue = $this->getKey("id_po"); // id_po
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
		// id_po
		// no_po
		// tgl_po
		// idstaff_po
		// idklinik
		// id_supplier
		// status_po
		// keterangan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_po
			$this->id_po->ViewValue = $this->id_po->CurrentValue;
			$this->id_po->ViewCustomAttributes = "";

			// no_po
			$this->no_po->ViewValue = $this->no_po->CurrentValue;
			$this->no_po->ViewCustomAttributes = "";

			// tgl_po
			$this->tgl_po->ViewValue = $this->tgl_po->CurrentValue;
			$this->tgl_po->ViewValue = FormatDateTime($this->tgl_po->ViewValue, 0);
			$this->tgl_po->ViewCustomAttributes = "";

			// idstaff_po
			$curVal = strval($this->idstaff_po->CurrentValue);
			if ($curVal != "") {
				$this->idstaff_po->ViewValue = $this->idstaff_po->lookupCacheOption($curVal);
				if ($this->idstaff_po->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->idstaff_po->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idstaff_po->ViewValue = $this->idstaff_po->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idstaff_po->ViewValue = $this->idstaff_po->CurrentValue;
					}
				}
			} else {
				$this->idstaff_po->ViewValue = NULL;
			}
			$this->idstaff_po->ViewCustomAttributes = "";

			// idklinik
			$curVal = strval($this->idklinik->CurrentValue);
			if ($curVal != "") {
				$this->idklinik->ViewValue = $this->idklinik->lookupCacheOption($curVal);
				if ($this->idklinik->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->idklinik->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->idklinik->ViewValue = $this->idklinik->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->idklinik->ViewValue = $this->idklinik->CurrentValue;
					}
				}
			} else {
				$this->idklinik->ViewValue = NULL;
			}
			$this->idklinik->ViewCustomAttributes = "";

			// id_supplier
			$curVal = strval($this->id_supplier->CurrentValue);
			if ($curVal != "") {
				$this->id_supplier->ViewValue = $this->id_supplier->lookupCacheOption($curVal);
				if ($this->id_supplier->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_klinik`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_supplier->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_supplier->ViewValue = $this->id_supplier->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_supplier->ViewValue = $this->id_supplier->CurrentValue;
					}
				}
			} else {
				$this->id_supplier->ViewValue = NULL;
			}
			$this->id_supplier->ViewCustomAttributes = "";

			// status_po
			if (strval($this->status_po->CurrentValue) != "") {
				$this->status_po->ViewValue = $this->status_po->optionCaption($this->status_po->CurrentValue);
			} else {
				$this->status_po->ViewValue = NULL;
			}
			$this->status_po->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

			// no_po
			$this->no_po->LinkCustomAttributes = "";
			$this->no_po->HrefValue = "";
			$this->no_po->TooltipValue = "";

			// tgl_po
			$this->tgl_po->LinkCustomAttributes = "";
			$this->tgl_po->HrefValue = "";
			$this->tgl_po->TooltipValue = "";

			// idstaff_po
			$this->idstaff_po->LinkCustomAttributes = "";
			$this->idstaff_po->HrefValue = "";
			$this->idstaff_po->TooltipValue = "";

			// idklinik
			$this->idklinik->LinkCustomAttributes = "";
			$this->idklinik->HrefValue = "";
			$this->idklinik->TooltipValue = "";

			// id_supplier
			$this->id_supplier->LinkCustomAttributes = "";
			$this->id_supplier->HrefValue = "";
			$this->id_supplier->TooltipValue = "";

			// status_po
			$this->status_po->LinkCustomAttributes = "";
			$this->status_po->HrefValue = "";
			$this->status_po->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// no_po
			$this->no_po->EditAttrs["class"] = "form-control";
			$this->no_po->EditCustomAttributes = "";
			if (!$this->no_po->Raw)
				$this->no_po->CurrentValue = HtmlDecode($this->no_po->CurrentValue);
			$this->no_po->EditValue = HtmlEncode($this->no_po->CurrentValue);
			$this->no_po->PlaceHolder = RemoveHtml($this->no_po->caption());

			// tgl_po
			$this->tgl_po->EditAttrs["class"] = "form-control";
			$this->tgl_po->EditCustomAttributes = "";
			$this->tgl_po->EditValue = HtmlEncode(FormatDateTime($this->tgl_po->CurrentValue, 8));
			$this->tgl_po->PlaceHolder = RemoveHtml($this->tgl_po->caption());

			// idstaff_po
			$this->idstaff_po->EditAttrs["class"] = "form-control";
			$this->idstaff_po->EditCustomAttributes = "";
			$curVal = trim(strval($this->idstaff_po->CurrentValue));
			if ($curVal != "")
				$this->idstaff_po->ViewValue = $this->idstaff_po->lookupCacheOption($curVal);
			else
				$this->idstaff_po->ViewValue = $this->idstaff_po->Lookup !== NULL && is_array($this->idstaff_po->Lookup->Options) ? $curVal : NULL;
			if ($this->idstaff_po->ViewValue !== NULL) { // Load from cache
				$this->idstaff_po->EditValue = array_values($this->idstaff_po->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->idstaff_po->CurrentValue, DATATYPE_NUMBER, "");
				}
				$lookupFilter = function() {
					return "`status` <> 'Non Aktif'";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->idstaff_po->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->idstaff_po->EditValue = $arwrk;
			}

			// idklinik
			$this->idklinik->EditAttrs["class"] = "form-control";
			$this->idklinik->EditCustomAttributes = "";
			$curVal = trim(strval($this->idklinik->CurrentValue));
			if ($curVal != "")
				$this->idklinik->ViewValue = $this->idklinik->lookupCacheOption($curVal);
			else
				$this->idklinik->ViewValue = $this->idklinik->Lookup !== NULL && is_array($this->idklinik->Lookup->Options) ? $curVal : NULL;
			if ($this->idklinik->ViewValue !== NULL) { // Load from cache
				$this->idklinik->EditValue = array_values($this->idklinik->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->idklinik->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->idklinik->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->idklinik->EditValue = $arwrk;
			}

			// id_supplier
			$this->id_supplier->EditAttrs["class"] = "form-control";
			$this->id_supplier->EditCustomAttributes = "";
			$curVal = trim(strval($this->id_supplier->CurrentValue));
			if ($curVal != "")
				$this->id_supplier->ViewValue = $this->id_supplier->lookupCacheOption($curVal);
			else
				$this->id_supplier->ViewValue = $this->id_supplier->Lookup !== NULL && is_array($this->id_supplier->Lookup->Options) ? $curVal : NULL;
			if ($this->id_supplier->ViewValue !== NULL) { // Load from cache
				$this->id_supplier->EditValue = array_values($this->id_supplier->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_klinik`" . SearchString("=", $this->id_supplier->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->id_supplier->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->id_supplier->EditValue = $arwrk;
			}

			// status_po
			$this->status_po->EditCustomAttributes = "";
			$this->status_po->EditValue = $this->status_po->options(FALSE);

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// Edit refer script
			// no_po

			$this->no_po->LinkCustomAttributes = "";
			$this->no_po->HrefValue = "";

			// tgl_po
			$this->tgl_po->LinkCustomAttributes = "";
			$this->tgl_po->HrefValue = "";

			// idstaff_po
			$this->idstaff_po->LinkCustomAttributes = "";
			$this->idstaff_po->HrefValue = "";

			// idklinik
			$this->idklinik->LinkCustomAttributes = "";
			$this->idklinik->HrefValue = "";

			// id_supplier
			$this->id_supplier->LinkCustomAttributes = "";
			$this->id_supplier->HrefValue = "";

			// status_po
			$this->status_po->LinkCustomAttributes = "";
			$this->status_po->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
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
		if ($this->no_po->Required) {
			if (!$this->no_po->IsDetailKey && $this->no_po->FormValue != NULL && $this->no_po->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->no_po->caption(), $this->no_po->RequiredErrorMessage));
			}
		}
		if ($this->tgl_po->Required) {
			if (!$this->tgl_po->IsDetailKey && $this->tgl_po->FormValue != NULL && $this->tgl_po->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_po->caption(), $this->tgl_po->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_po->FormValue)) {
			AddMessage($FormError, $this->tgl_po->errorMessage());
		}
		if ($this->idstaff_po->Required) {
			if (!$this->idstaff_po->IsDetailKey && $this->idstaff_po->FormValue != NULL && $this->idstaff_po->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idstaff_po->caption(), $this->idstaff_po->RequiredErrorMessage));
			}
		}
		if ($this->idklinik->Required) {
			if (!$this->idklinik->IsDetailKey && $this->idklinik->FormValue != NULL && $this->idklinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idklinik->caption(), $this->idklinik->RequiredErrorMessage));
			}
		}
		if ($this->id_supplier->Required) {
			if (!$this->id_supplier->IsDetailKey && $this->id_supplier->FormValue != NULL && $this->id_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_supplier->caption(), $this->id_supplier->RequiredErrorMessage));
			}
		}
		if ($this->status_po->Required) {
			if ($this->status_po->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status_po->caption(), $this->status_po->RequiredErrorMessage));
			}
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
			}
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("detailpo", $detailTblVar) && $GLOBALS["detailpo"]->DetailEdit) {
			if (!isset($GLOBALS["detailpo_grid"]))
				$GLOBALS["detailpo_grid"] = new detailpo_grid(); // Get detail page object
			$GLOBALS["detailpo_grid"]->validateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// no_po
			$this->no_po->setDbValueDef($rsnew, $this->no_po->CurrentValue, NULL, $this->no_po->ReadOnly);

			// tgl_po
			$this->tgl_po->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_po->CurrentValue, 0), CurrentDate(), $this->tgl_po->ReadOnly);

			// idstaff_po
			$this->idstaff_po->setDbValueDef($rsnew, $this->idstaff_po->CurrentValue, NULL, $this->idstaff_po->ReadOnly);

			// idklinik
			$this->idklinik->setDbValueDef($rsnew, $this->idklinik->CurrentValue, NULL, $this->idklinik->ReadOnly);

			// id_supplier
			$this->id_supplier->setDbValueDef($rsnew, $this->id_supplier->CurrentValue, NULL, $this->id_supplier->ReadOnly);

			// status_po
			$this->status_po->setDbValueDef($rsnew, $this->status_po->CurrentValue, NULL, $this->status_po->ReadOnly);

			// keterangan
			$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, $this->keterangan->ReadOnly);

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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("detailpo", $detailTblVar) && $GLOBALS["detailpo"]->DetailEdit) {
						if (!isset($GLOBALS["detailpo_grid"]))
							$GLOBALS["detailpo_grid"] = new detailpo_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "detailpo"); // Load user level of detail table
						$editRow = $GLOBALS["detailpo_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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
			if (in_array("detailpo", $detailTblVar)) {
				if (!isset($GLOBALS["detailpo_grid"]))
					$GLOBALS["detailpo_grid"] = new detailpo_grid();
				if ($GLOBALS["detailpo_grid"]->DetailEdit) {
					$GLOBALS["detailpo_grid"]->CurrentMode = "edit";
					$GLOBALS["detailpo_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["detailpo_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["detailpo_grid"]->setStartRecordNumber(1);
					$GLOBALS["detailpo_grid"]->pid_detailpo->IsDetailKey = TRUE;
					$GLOBALS["detailpo_grid"]->pid_detailpo->CurrentValue = $this->id_po->CurrentValue;
					$GLOBALS["detailpo_grid"]->pid_detailpo->setSessionValue($GLOBALS["detailpo_grid"]->pid_detailpo->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("purchaseorderlist.php"), "", $this->TableVar, TRUE);
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
				case "x_idstaff_po":
					$lookupFilter = function() {
						return "`status` <> 'Non Aktif'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_idklinik":
					break;
				case "x_id_supplier":
					break;
				case "x_status_po":
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
						case "x_idstaff_po":
							break;
						case "x_idklinik":
							break;
						case "x_id_supplier":
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