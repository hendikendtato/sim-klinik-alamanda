<?php
namespace PHPMaker2020\sim_klinik_alamanda;

/**
 * Page class
 */
class m_supplier_add extends m_supplier
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{8546B030-7993-4749-BFDB-17AFAAF4065D}";

	// Table name
	public $TableName = 'm_supplier';

	// Page object name
	public $PageObjName = "m_supplier_add";

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

		// Table object (m_supplier)
		if (!isset($GLOBALS["m_supplier"]) || get_class($GLOBALS["m_supplier"]) == PROJECT_NAMESPACE . "m_supplier") {
			$GLOBALS["m_supplier"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_supplier"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_supplier');

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
		global $m_supplier;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_supplier);
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
					if ($pageName == "m_supplierview.php")
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
			$key .= @$ar['id_supplier'];
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
			$this->id_supplier->Visible = FALSE;
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
					$this->terminate(GetUrl("m_supplierlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_supplier->Visible = FALSE;
		$this->kode_supplier->setVisibility();
		$this->nama_supplier->setVisibility();
		$this->pic_supplier->setVisibility();
		$this->alamat_supplier->setVisibility();
		$this->kelurahan_supplier->setVisibility();
		$this->kecamatan_supplier->setVisibility();
		$this->kota_supplier->setVisibility();
		$this->kodepos_supplier->setVisibility();
		$this->telpon_supplier->setVisibility();
		$this->hp_supplier->setVisibility();
		$this->email_supplier->setVisibility();
		$this->kategori_supplier->setVisibility();
		$this->npwp_supplier->setVisibility();
		$this->rekening_supplier->setVisibility();
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
			$this->terminate("m_supplierlist.php");
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
			if (Get("id_supplier") !== NULL) {
				$this->id_supplier->setQueryStringValue(Get("id_supplier"));
				$this->setKey("id_supplier", $this->id_supplier->CurrentValue); // Set up key
			} else {
				$this->setKey("id_supplier", ""); // Clear key
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
					$this->terminate("m_supplierlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "m_supplierlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "m_supplierview.php")
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
		$this->id_supplier->CurrentValue = NULL;
		$this->id_supplier->OldValue = $this->id_supplier->CurrentValue;
		$this->kode_supplier->CurrentValue = NULL;
		$this->kode_supplier->OldValue = $this->kode_supplier->CurrentValue;
		$this->nama_supplier->CurrentValue = NULL;
		$this->nama_supplier->OldValue = $this->nama_supplier->CurrentValue;
		$this->pic_supplier->CurrentValue = NULL;
		$this->pic_supplier->OldValue = $this->pic_supplier->CurrentValue;
		$this->alamat_supplier->CurrentValue = NULL;
		$this->alamat_supplier->OldValue = $this->alamat_supplier->CurrentValue;
		$this->kelurahan_supplier->CurrentValue = NULL;
		$this->kelurahan_supplier->OldValue = $this->kelurahan_supplier->CurrentValue;
		$this->kecamatan_supplier->CurrentValue = NULL;
		$this->kecamatan_supplier->OldValue = $this->kecamatan_supplier->CurrentValue;
		$this->kota_supplier->CurrentValue = NULL;
		$this->kota_supplier->OldValue = $this->kota_supplier->CurrentValue;
		$this->kodepos_supplier->CurrentValue = NULL;
		$this->kodepos_supplier->OldValue = $this->kodepos_supplier->CurrentValue;
		$this->telpon_supplier->CurrentValue = NULL;
		$this->telpon_supplier->OldValue = $this->telpon_supplier->CurrentValue;
		$this->hp_supplier->CurrentValue = NULL;
		$this->hp_supplier->OldValue = $this->hp_supplier->CurrentValue;
		$this->email_supplier->CurrentValue = NULL;
		$this->email_supplier->OldValue = $this->email_supplier->CurrentValue;
		$this->kategori_supplier->CurrentValue = "eksternal";
		$this->npwp_supplier->CurrentValue = NULL;
		$this->npwp_supplier->OldValue = $this->npwp_supplier->CurrentValue;
		$this->rekening_supplier->CurrentValue = NULL;
		$this->rekening_supplier->OldValue = $this->rekening_supplier->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'kode_supplier' first before field var 'x_kode_supplier'
		$val = $CurrentForm->hasValue("kode_supplier") ? $CurrentForm->getValue("kode_supplier") : $CurrentForm->getValue("x_kode_supplier");
		if (!$this->kode_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kode_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->kode_supplier->setFormValue($val);
		}

		// Check field name 'nama_supplier' first before field var 'x_nama_supplier'
		$val = $CurrentForm->hasValue("nama_supplier") ? $CurrentForm->getValue("nama_supplier") : $CurrentForm->getValue("x_nama_supplier");
		if (!$this->nama_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->nama_supplier->setFormValue($val);
		}

		// Check field name 'pic_supplier' first before field var 'x_pic_supplier'
		$val = $CurrentForm->hasValue("pic_supplier") ? $CurrentForm->getValue("pic_supplier") : $CurrentForm->getValue("x_pic_supplier");
		if (!$this->pic_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pic_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->pic_supplier->setFormValue($val);
		}

		// Check field name 'alamat_supplier' first before field var 'x_alamat_supplier'
		$val = $CurrentForm->hasValue("alamat_supplier") ? $CurrentForm->getValue("alamat_supplier") : $CurrentForm->getValue("x_alamat_supplier");
		if (!$this->alamat_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_supplier->setFormValue($val);
		}

		// Check field name 'kelurahan_supplier' first before field var 'x_kelurahan_supplier'
		$val = $CurrentForm->hasValue("kelurahan_supplier") ? $CurrentForm->getValue("kelurahan_supplier") : $CurrentForm->getValue("x_kelurahan_supplier");
		if (!$this->kelurahan_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kelurahan_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->kelurahan_supplier->setFormValue($val);
		}

		// Check field name 'kecamatan_supplier' first before field var 'x_kecamatan_supplier'
		$val = $CurrentForm->hasValue("kecamatan_supplier") ? $CurrentForm->getValue("kecamatan_supplier") : $CurrentForm->getValue("x_kecamatan_supplier");
		if (!$this->kecamatan_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kecamatan_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->kecamatan_supplier->setFormValue($val);
		}

		// Check field name 'kota_supplier' first before field var 'x_kota_supplier'
		$val = $CurrentForm->hasValue("kota_supplier") ? $CurrentForm->getValue("kota_supplier") : $CurrentForm->getValue("x_kota_supplier");
		if (!$this->kota_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kota_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->kota_supplier->setFormValue($val);
		}

		// Check field name 'kodepos_supplier' first before field var 'x_kodepos_supplier'
		$val = $CurrentForm->hasValue("kodepos_supplier") ? $CurrentForm->getValue("kodepos_supplier") : $CurrentForm->getValue("x_kodepos_supplier");
		if (!$this->kodepos_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kodepos_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->kodepos_supplier->setFormValue($val);
		}

		// Check field name 'telpon_supplier' first before field var 'x_telpon_supplier'
		$val = $CurrentForm->hasValue("telpon_supplier") ? $CurrentForm->getValue("telpon_supplier") : $CurrentForm->getValue("x_telpon_supplier");
		if (!$this->telpon_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telpon_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->telpon_supplier->setFormValue($val);
		}

		// Check field name 'hp_supplier' first before field var 'x_hp_supplier'
		$val = $CurrentForm->hasValue("hp_supplier") ? $CurrentForm->getValue("hp_supplier") : $CurrentForm->getValue("x_hp_supplier");
		if (!$this->hp_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hp_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->hp_supplier->setFormValue($val);
		}

		// Check field name 'email_supplier' first before field var 'x_email_supplier'
		$val = $CurrentForm->hasValue("email_supplier") ? $CurrentForm->getValue("email_supplier") : $CurrentForm->getValue("x_email_supplier");
		if (!$this->email_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->email_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->email_supplier->setFormValue($val);
		}

		// Check field name 'kategori_supplier' first before field var 'x_kategori_supplier'
		$val = $CurrentForm->hasValue("kategori_supplier") ? $CurrentForm->getValue("kategori_supplier") : $CurrentForm->getValue("x_kategori_supplier");
		if (!$this->kategori_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kategori_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->kategori_supplier->setFormValue($val);
		}

		// Check field name 'npwp_supplier' first before field var 'x_npwp_supplier'
		$val = $CurrentForm->hasValue("npwp_supplier") ? $CurrentForm->getValue("npwp_supplier") : $CurrentForm->getValue("x_npwp_supplier");
		if (!$this->npwp_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->npwp_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->npwp_supplier->setFormValue($val);
		}

		// Check field name 'rekening_supplier' first before field var 'x_rekening_supplier'
		$val = $CurrentForm->hasValue("rekening_supplier") ? $CurrentForm->getValue("rekening_supplier") : $CurrentForm->getValue("x_rekening_supplier");
		if (!$this->rekening_supplier->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->rekening_supplier->Visible = FALSE; // Disable update for API request
			else
				$this->rekening_supplier->setFormValue($val);
		}

		// Check field name 'id_supplier' first before field var 'x_id_supplier'
		$val = $CurrentForm->hasValue("id_supplier") ? $CurrentForm->getValue("id_supplier") : $CurrentForm->getValue("x_id_supplier");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->kode_supplier->CurrentValue = $this->kode_supplier->FormValue;
		$this->nama_supplier->CurrentValue = $this->nama_supplier->FormValue;
		$this->pic_supplier->CurrentValue = $this->pic_supplier->FormValue;
		$this->alamat_supplier->CurrentValue = $this->alamat_supplier->FormValue;
		$this->kelurahan_supplier->CurrentValue = $this->kelurahan_supplier->FormValue;
		$this->kecamatan_supplier->CurrentValue = $this->kecamatan_supplier->FormValue;
		$this->kota_supplier->CurrentValue = $this->kota_supplier->FormValue;
		$this->kodepos_supplier->CurrentValue = $this->kodepos_supplier->FormValue;
		$this->telpon_supplier->CurrentValue = $this->telpon_supplier->FormValue;
		$this->hp_supplier->CurrentValue = $this->hp_supplier->FormValue;
		$this->email_supplier->CurrentValue = $this->email_supplier->FormValue;
		$this->kategori_supplier->CurrentValue = $this->kategori_supplier->FormValue;
		$this->npwp_supplier->CurrentValue = $this->npwp_supplier->FormValue;
		$this->rekening_supplier->CurrentValue = $this->rekening_supplier->FormValue;
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
		$this->id_supplier->setDbValue($row['id_supplier']);
		$this->kode_supplier->setDbValue($row['kode_supplier']);
		$this->nama_supplier->setDbValue($row['nama_supplier']);
		$this->pic_supplier->setDbValue($row['pic_supplier']);
		$this->alamat_supplier->setDbValue($row['alamat_supplier']);
		$this->kelurahan_supplier->setDbValue($row['kelurahan_supplier']);
		$this->kecamatan_supplier->setDbValue($row['kecamatan_supplier']);
		$this->kota_supplier->setDbValue($row['kota_supplier']);
		$this->kodepos_supplier->setDbValue($row['kodepos_supplier']);
		$this->telpon_supplier->setDbValue($row['telpon_supplier']);
		$this->hp_supplier->setDbValue($row['hp_supplier']);
		$this->email_supplier->setDbValue($row['email_supplier']);
		$this->kategori_supplier->setDbValue($row['kategori_supplier']);
		$this->npwp_supplier->setDbValue($row['npwp_supplier']);
		$this->rekening_supplier->setDbValue($row['rekening_supplier']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_supplier'] = $this->id_supplier->CurrentValue;
		$row['kode_supplier'] = $this->kode_supplier->CurrentValue;
		$row['nama_supplier'] = $this->nama_supplier->CurrentValue;
		$row['pic_supplier'] = $this->pic_supplier->CurrentValue;
		$row['alamat_supplier'] = $this->alamat_supplier->CurrentValue;
		$row['kelurahan_supplier'] = $this->kelurahan_supplier->CurrentValue;
		$row['kecamatan_supplier'] = $this->kecamatan_supplier->CurrentValue;
		$row['kota_supplier'] = $this->kota_supplier->CurrentValue;
		$row['kodepos_supplier'] = $this->kodepos_supplier->CurrentValue;
		$row['telpon_supplier'] = $this->telpon_supplier->CurrentValue;
		$row['hp_supplier'] = $this->hp_supplier->CurrentValue;
		$row['email_supplier'] = $this->email_supplier->CurrentValue;
		$row['kategori_supplier'] = $this->kategori_supplier->CurrentValue;
		$row['npwp_supplier'] = $this->npwp_supplier->CurrentValue;
		$row['rekening_supplier'] = $this->rekening_supplier->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_supplier")) != "")
			$this->id_supplier->OldValue = $this->getKey("id_supplier"); // id_supplier
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
		// id_supplier
		// kode_supplier
		// nama_supplier
		// pic_supplier
		// alamat_supplier
		// kelurahan_supplier
		// kecamatan_supplier
		// kota_supplier
		// kodepos_supplier
		// telpon_supplier
		// hp_supplier
		// email_supplier
		// kategori_supplier
		// npwp_supplier
		// rekening_supplier

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_supplier
			$this->id_supplier->ViewValue = $this->id_supplier->CurrentValue;
			$this->id_supplier->ViewCustomAttributes = "";

			// kode_supplier
			$this->kode_supplier->ViewValue = $this->kode_supplier->CurrentValue;
			$this->kode_supplier->ViewCustomAttributes = "";

			// nama_supplier
			$this->nama_supplier->ViewValue = $this->nama_supplier->CurrentValue;
			$this->nama_supplier->ViewCustomAttributes = "";

			// pic_supplier
			$this->pic_supplier->ViewValue = $this->pic_supplier->CurrentValue;
			$this->pic_supplier->ViewCustomAttributes = "";

			// alamat_supplier
			$this->alamat_supplier->ViewValue = $this->alamat_supplier->CurrentValue;
			$this->alamat_supplier->ViewCustomAttributes = "";

			// kelurahan_supplier
			$this->kelurahan_supplier->ViewValue = $this->kelurahan_supplier->CurrentValue;
			$this->kelurahan_supplier->ViewCustomAttributes = "";

			// kecamatan_supplier
			$this->kecamatan_supplier->ViewValue = $this->kecamatan_supplier->CurrentValue;
			$this->kecamatan_supplier->ViewCustomAttributes = "";

			// kota_supplier
			$this->kota_supplier->ViewValue = $this->kota_supplier->CurrentValue;
			$this->kota_supplier->ViewCustomAttributes = "";

			// kodepos_supplier
			$this->kodepos_supplier->ViewValue = $this->kodepos_supplier->CurrentValue;
			$this->kodepos_supplier->ViewCustomAttributes = "";

			// telpon_supplier
			$this->telpon_supplier->ViewValue = $this->telpon_supplier->CurrentValue;
			$this->telpon_supplier->ViewCustomAttributes = "";

			// hp_supplier
			$this->hp_supplier->ViewValue = $this->hp_supplier->CurrentValue;
			$this->hp_supplier->ViewCustomAttributes = "";

			// email_supplier
			$this->email_supplier->ViewValue = $this->email_supplier->CurrentValue;
			$this->email_supplier->ViewCustomAttributes = "";

			// kategori_supplier
			if (strval($this->kategori_supplier->CurrentValue) != "") {
				$this->kategori_supplier->ViewValue = $this->kategori_supplier->optionCaption($this->kategori_supplier->CurrentValue);
			} else {
				$this->kategori_supplier->ViewValue = NULL;
			}
			$this->kategori_supplier->ViewCustomAttributes = "";

			// npwp_supplier
			$this->npwp_supplier->ViewValue = $this->npwp_supplier->CurrentValue;
			$this->npwp_supplier->ViewCustomAttributes = "";

			// rekening_supplier
			$this->rekening_supplier->ViewValue = $this->rekening_supplier->CurrentValue;
			$this->rekening_supplier->ViewCustomAttributes = "";

			// kode_supplier
			$this->kode_supplier->LinkCustomAttributes = "";
			$this->kode_supplier->HrefValue = "";
			$this->kode_supplier->TooltipValue = "";

			// nama_supplier
			$this->nama_supplier->LinkCustomAttributes = "";
			$this->nama_supplier->HrefValue = "";
			$this->nama_supplier->TooltipValue = "";

			// pic_supplier
			$this->pic_supplier->LinkCustomAttributes = "";
			$this->pic_supplier->HrefValue = "";
			$this->pic_supplier->TooltipValue = "";

			// alamat_supplier
			$this->alamat_supplier->LinkCustomAttributes = "";
			$this->alamat_supplier->HrefValue = "";
			$this->alamat_supplier->TooltipValue = "";

			// kelurahan_supplier
			$this->kelurahan_supplier->LinkCustomAttributes = "";
			$this->kelurahan_supplier->HrefValue = "";
			$this->kelurahan_supplier->TooltipValue = "";

			// kecamatan_supplier
			$this->kecamatan_supplier->LinkCustomAttributes = "";
			$this->kecamatan_supplier->HrefValue = "";
			$this->kecamatan_supplier->TooltipValue = "";

			// kota_supplier
			$this->kota_supplier->LinkCustomAttributes = "";
			$this->kota_supplier->HrefValue = "";
			$this->kota_supplier->TooltipValue = "";

			// kodepos_supplier
			$this->kodepos_supplier->LinkCustomAttributes = "";
			$this->kodepos_supplier->HrefValue = "";
			$this->kodepos_supplier->TooltipValue = "";

			// telpon_supplier
			$this->telpon_supplier->LinkCustomAttributes = "";
			$this->telpon_supplier->HrefValue = "";
			$this->telpon_supplier->TooltipValue = "";

			// hp_supplier
			$this->hp_supplier->LinkCustomAttributes = "";
			$this->hp_supplier->HrefValue = "";
			$this->hp_supplier->TooltipValue = "";

			// email_supplier
			$this->email_supplier->LinkCustomAttributes = "";
			$this->email_supplier->HrefValue = "";
			$this->email_supplier->TooltipValue = "";

			// kategori_supplier
			$this->kategori_supplier->LinkCustomAttributes = "";
			$this->kategori_supplier->HrefValue = "";
			$this->kategori_supplier->TooltipValue = "";

			// npwp_supplier
			$this->npwp_supplier->LinkCustomAttributes = "";
			$this->npwp_supplier->HrefValue = "";
			$this->npwp_supplier->TooltipValue = "";

			// rekening_supplier
			$this->rekening_supplier->LinkCustomAttributes = "";
			$this->rekening_supplier->HrefValue = "";
			$this->rekening_supplier->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// kode_supplier
			$this->kode_supplier->EditAttrs["class"] = "form-control";
			$this->kode_supplier->EditCustomAttributes = "";
			if (!$this->kode_supplier->Raw)
				$this->kode_supplier->CurrentValue = HtmlDecode($this->kode_supplier->CurrentValue);
			$this->kode_supplier->EditValue = HtmlEncode($this->kode_supplier->CurrentValue);
			$this->kode_supplier->PlaceHolder = RemoveHtml($this->kode_supplier->caption());

			// nama_supplier
			$this->nama_supplier->EditAttrs["class"] = "form-control";
			$this->nama_supplier->EditCustomAttributes = "";
			if (!$this->nama_supplier->Raw)
				$this->nama_supplier->CurrentValue = HtmlDecode($this->nama_supplier->CurrentValue);
			$this->nama_supplier->EditValue = HtmlEncode($this->nama_supplier->CurrentValue);
			$this->nama_supplier->PlaceHolder = RemoveHtml($this->nama_supplier->caption());

			// pic_supplier
			$this->pic_supplier->EditAttrs["class"] = "form-control";
			$this->pic_supplier->EditCustomAttributes = "";
			if (!$this->pic_supplier->Raw)
				$this->pic_supplier->CurrentValue = HtmlDecode($this->pic_supplier->CurrentValue);
			$this->pic_supplier->EditValue = HtmlEncode($this->pic_supplier->CurrentValue);
			$this->pic_supplier->PlaceHolder = RemoveHtml($this->pic_supplier->caption());

			// alamat_supplier
			$this->alamat_supplier->EditAttrs["class"] = "form-control";
			$this->alamat_supplier->EditCustomAttributes = "";
			if (!$this->alamat_supplier->Raw)
				$this->alamat_supplier->CurrentValue = HtmlDecode($this->alamat_supplier->CurrentValue);
			$this->alamat_supplier->EditValue = HtmlEncode($this->alamat_supplier->CurrentValue);
			$this->alamat_supplier->PlaceHolder = RemoveHtml($this->alamat_supplier->caption());

			// kelurahan_supplier
			$this->kelurahan_supplier->EditAttrs["class"] = "form-control";
			$this->kelurahan_supplier->EditCustomAttributes = "";
			if (!$this->kelurahan_supplier->Raw)
				$this->kelurahan_supplier->CurrentValue = HtmlDecode($this->kelurahan_supplier->CurrentValue);
			$this->kelurahan_supplier->EditValue = HtmlEncode($this->kelurahan_supplier->CurrentValue);
			$this->kelurahan_supplier->PlaceHolder = RemoveHtml($this->kelurahan_supplier->caption());

			// kecamatan_supplier
			$this->kecamatan_supplier->EditAttrs["class"] = "form-control";
			$this->kecamatan_supplier->EditCustomAttributes = "";
			if (!$this->kecamatan_supplier->Raw)
				$this->kecamatan_supplier->CurrentValue = HtmlDecode($this->kecamatan_supplier->CurrentValue);
			$this->kecamatan_supplier->EditValue = HtmlEncode($this->kecamatan_supplier->CurrentValue);
			$this->kecamatan_supplier->PlaceHolder = RemoveHtml($this->kecamatan_supplier->caption());

			// kota_supplier
			$this->kota_supplier->EditAttrs["class"] = "form-control";
			$this->kota_supplier->EditCustomAttributes = "";
			if (!$this->kota_supplier->Raw)
				$this->kota_supplier->CurrentValue = HtmlDecode($this->kota_supplier->CurrentValue);
			$this->kota_supplier->EditValue = HtmlEncode($this->kota_supplier->CurrentValue);
			$this->kota_supplier->PlaceHolder = RemoveHtml($this->kota_supplier->caption());

			// kodepos_supplier
			$this->kodepos_supplier->EditAttrs["class"] = "form-control";
			$this->kodepos_supplier->EditCustomAttributes = "";
			if (!$this->kodepos_supplier->Raw)
				$this->kodepos_supplier->CurrentValue = HtmlDecode($this->kodepos_supplier->CurrentValue);
			$this->kodepos_supplier->EditValue = HtmlEncode($this->kodepos_supplier->CurrentValue);
			$this->kodepos_supplier->PlaceHolder = RemoveHtml($this->kodepos_supplier->caption());

			// telpon_supplier
			$this->telpon_supplier->EditAttrs["class"] = "form-control";
			$this->telpon_supplier->EditCustomAttributes = "";
			if (!$this->telpon_supplier->Raw)
				$this->telpon_supplier->CurrentValue = HtmlDecode($this->telpon_supplier->CurrentValue);
			$this->telpon_supplier->EditValue = HtmlEncode($this->telpon_supplier->CurrentValue);
			$this->telpon_supplier->PlaceHolder = RemoveHtml($this->telpon_supplier->caption());

			// hp_supplier
			$this->hp_supplier->EditAttrs["class"] = "form-control";
			$this->hp_supplier->EditCustomAttributes = "";
			if (!$this->hp_supplier->Raw)
				$this->hp_supplier->CurrentValue = HtmlDecode($this->hp_supplier->CurrentValue);
			$this->hp_supplier->EditValue = HtmlEncode($this->hp_supplier->CurrentValue);
			$this->hp_supplier->PlaceHolder = RemoveHtml($this->hp_supplier->caption());

			// email_supplier
			$this->email_supplier->EditAttrs["class"] = "form-control";
			$this->email_supplier->EditCustomAttributes = "";
			if (!$this->email_supplier->Raw)
				$this->email_supplier->CurrentValue = HtmlDecode($this->email_supplier->CurrentValue);
			$this->email_supplier->EditValue = HtmlEncode($this->email_supplier->CurrentValue);
			$this->email_supplier->PlaceHolder = RemoveHtml($this->email_supplier->caption());

			// kategori_supplier
			$this->kategori_supplier->EditCustomAttributes = "";
			$this->kategori_supplier->EditValue = $this->kategori_supplier->options(FALSE);

			// npwp_supplier
			$this->npwp_supplier->EditAttrs["class"] = "form-control";
			$this->npwp_supplier->EditCustomAttributes = "";
			if (!$this->npwp_supplier->Raw)
				$this->npwp_supplier->CurrentValue = HtmlDecode($this->npwp_supplier->CurrentValue);
			$this->npwp_supplier->EditValue = HtmlEncode($this->npwp_supplier->CurrentValue);
			$this->npwp_supplier->PlaceHolder = RemoveHtml($this->npwp_supplier->caption());

			// rekening_supplier
			$this->rekening_supplier->EditAttrs["class"] = "form-control";
			$this->rekening_supplier->EditCustomAttributes = "";
			if (!$this->rekening_supplier->Raw)
				$this->rekening_supplier->CurrentValue = HtmlDecode($this->rekening_supplier->CurrentValue);
			$this->rekening_supplier->EditValue = HtmlEncode($this->rekening_supplier->CurrentValue);
			$this->rekening_supplier->PlaceHolder = RemoveHtml($this->rekening_supplier->caption());

			// Add refer script
			// kode_supplier

			$this->kode_supplier->LinkCustomAttributes = "";
			$this->kode_supplier->HrefValue = "";

			// nama_supplier
			$this->nama_supplier->LinkCustomAttributes = "";
			$this->nama_supplier->HrefValue = "";

			// pic_supplier
			$this->pic_supplier->LinkCustomAttributes = "";
			$this->pic_supplier->HrefValue = "";

			// alamat_supplier
			$this->alamat_supplier->LinkCustomAttributes = "";
			$this->alamat_supplier->HrefValue = "";

			// kelurahan_supplier
			$this->kelurahan_supplier->LinkCustomAttributes = "";
			$this->kelurahan_supplier->HrefValue = "";

			// kecamatan_supplier
			$this->kecamatan_supplier->LinkCustomAttributes = "";
			$this->kecamatan_supplier->HrefValue = "";

			// kota_supplier
			$this->kota_supplier->LinkCustomAttributes = "";
			$this->kota_supplier->HrefValue = "";

			// kodepos_supplier
			$this->kodepos_supplier->LinkCustomAttributes = "";
			$this->kodepos_supplier->HrefValue = "";

			// telpon_supplier
			$this->telpon_supplier->LinkCustomAttributes = "";
			$this->telpon_supplier->HrefValue = "";

			// hp_supplier
			$this->hp_supplier->LinkCustomAttributes = "";
			$this->hp_supplier->HrefValue = "";

			// email_supplier
			$this->email_supplier->LinkCustomAttributes = "";
			$this->email_supplier->HrefValue = "";

			// kategori_supplier
			$this->kategori_supplier->LinkCustomAttributes = "";
			$this->kategori_supplier->HrefValue = "";

			// npwp_supplier
			$this->npwp_supplier->LinkCustomAttributes = "";
			$this->npwp_supplier->HrefValue = "";

			// rekening_supplier
			$this->rekening_supplier->LinkCustomAttributes = "";
			$this->rekening_supplier->HrefValue = "";
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
		if ($this->kode_supplier->Required) {
			if (!$this->kode_supplier->IsDetailKey && $this->kode_supplier->FormValue != NULL && $this->kode_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kode_supplier->caption(), $this->kode_supplier->RequiredErrorMessage));
			}
		}
		if ($this->nama_supplier->Required) {
			if (!$this->nama_supplier->IsDetailKey && $this->nama_supplier->FormValue != NULL && $this->nama_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_supplier->caption(), $this->nama_supplier->RequiredErrorMessage));
			}
		}
		if ($this->pic_supplier->Required) {
			if (!$this->pic_supplier->IsDetailKey && $this->pic_supplier->FormValue != NULL && $this->pic_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pic_supplier->caption(), $this->pic_supplier->RequiredErrorMessage));
			}
		}
		if ($this->alamat_supplier->Required) {
			if (!$this->alamat_supplier->IsDetailKey && $this->alamat_supplier->FormValue != NULL && $this->alamat_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_supplier->caption(), $this->alamat_supplier->RequiredErrorMessage));
			}
		}
		if ($this->kelurahan_supplier->Required) {
			if (!$this->kelurahan_supplier->IsDetailKey && $this->kelurahan_supplier->FormValue != NULL && $this->kelurahan_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kelurahan_supplier->caption(), $this->kelurahan_supplier->RequiredErrorMessage));
			}
		}
		if ($this->kecamatan_supplier->Required) {
			if (!$this->kecamatan_supplier->IsDetailKey && $this->kecamatan_supplier->FormValue != NULL && $this->kecamatan_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kecamatan_supplier->caption(), $this->kecamatan_supplier->RequiredErrorMessage));
			}
		}
		if ($this->kota_supplier->Required) {
			if (!$this->kota_supplier->IsDetailKey && $this->kota_supplier->FormValue != NULL && $this->kota_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kota_supplier->caption(), $this->kota_supplier->RequiredErrorMessage));
			}
		}
		if ($this->kodepos_supplier->Required) {
			if (!$this->kodepos_supplier->IsDetailKey && $this->kodepos_supplier->FormValue != NULL && $this->kodepos_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kodepos_supplier->caption(), $this->kodepos_supplier->RequiredErrorMessage));
			}
		}
		if ($this->telpon_supplier->Required) {
			if (!$this->telpon_supplier->IsDetailKey && $this->telpon_supplier->FormValue != NULL && $this->telpon_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telpon_supplier->caption(), $this->telpon_supplier->RequiredErrorMessage));
			}
		}
		if ($this->hp_supplier->Required) {
			if (!$this->hp_supplier->IsDetailKey && $this->hp_supplier->FormValue != NULL && $this->hp_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp_supplier->caption(), $this->hp_supplier->RequiredErrorMessage));
			}
		}
		if ($this->email_supplier->Required) {
			if (!$this->email_supplier->IsDetailKey && $this->email_supplier->FormValue != NULL && $this->email_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->email_supplier->caption(), $this->email_supplier->RequiredErrorMessage));
			}
		}
		if ($this->kategori_supplier->Required) {
			if ($this->kategori_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori_supplier->caption(), $this->kategori_supplier->RequiredErrorMessage));
			}
		}
		if ($this->npwp_supplier->Required) {
			if (!$this->npwp_supplier->IsDetailKey && $this->npwp_supplier->FormValue != NULL && $this->npwp_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->npwp_supplier->caption(), $this->npwp_supplier->RequiredErrorMessage));
			}
		}
		if ($this->rekening_supplier->Required) {
			if (!$this->rekening_supplier->IsDetailKey && $this->rekening_supplier->FormValue != NULL && $this->rekening_supplier->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rekening_supplier->caption(), $this->rekening_supplier->RequiredErrorMessage));
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

		// kode_supplier
		$this->kode_supplier->setDbValueDef($rsnew, $this->kode_supplier->CurrentValue, NULL, FALSE);

		// nama_supplier
		$this->nama_supplier->setDbValueDef($rsnew, $this->nama_supplier->CurrentValue, NULL, FALSE);

		// pic_supplier
		$this->pic_supplier->setDbValueDef($rsnew, $this->pic_supplier->CurrentValue, NULL, FALSE);

		// alamat_supplier
		$this->alamat_supplier->setDbValueDef($rsnew, $this->alamat_supplier->CurrentValue, NULL, FALSE);

		// kelurahan_supplier
		$this->kelurahan_supplier->setDbValueDef($rsnew, $this->kelurahan_supplier->CurrentValue, NULL, FALSE);

		// kecamatan_supplier
		$this->kecamatan_supplier->setDbValueDef($rsnew, $this->kecamatan_supplier->CurrentValue, NULL, FALSE);

		// kota_supplier
		$this->kota_supplier->setDbValueDef($rsnew, $this->kota_supplier->CurrentValue, NULL, FALSE);

		// kodepos_supplier
		$this->kodepos_supplier->setDbValueDef($rsnew, $this->kodepos_supplier->CurrentValue, NULL, FALSE);

		// telpon_supplier
		$this->telpon_supplier->setDbValueDef($rsnew, $this->telpon_supplier->CurrentValue, NULL, FALSE);

		// hp_supplier
		$this->hp_supplier->setDbValueDef($rsnew, $this->hp_supplier->CurrentValue, NULL, FALSE);

		// email_supplier
		$this->email_supplier->setDbValueDef($rsnew, $this->email_supplier->CurrentValue, NULL, FALSE);

		// kategori_supplier
		$this->kategori_supplier->setDbValueDef($rsnew, $this->kategori_supplier->CurrentValue, NULL, strval($this->kategori_supplier->CurrentValue) == "");

		// npwp_supplier
		$this->npwp_supplier->setDbValueDef($rsnew, $this->npwp_supplier->CurrentValue, NULL, FALSE);

		// rekening_supplier
		$this->rekening_supplier->setDbValueDef($rsnew, $this->rekening_supplier->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_supplierlist.php"), "", $this->TableVar, TRUE);
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
				case "x_kategori_supplier":
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