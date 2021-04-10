<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

/**
 * Page class
 */
class detailpenjualan_add extends detailpenjualan
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{8C91985A-7590-4658-895B-4BCC6B46002F}";

	// Table name
	public $TableName = 'detailpenjualan';

	// Page object name
	public $PageObjName = "detailpenjualan_add";

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

		// Table object (detailpenjualan)
		if (!isset($GLOBALS["detailpenjualan"]) || get_class($GLOBALS["detailpenjualan"]) == PROJECT_NAMESPACE . "detailpenjualan") {
			$GLOBALS["detailpenjualan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["detailpenjualan"];
		}

		// Table object (penjualan)
		if (!isset($GLOBALS['penjualan']))
			$GLOBALS['penjualan'] = new penjualan();

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'detailpenjualan');

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
		global $detailpenjualan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($detailpenjualan);
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
					if ($pageName == "detailpenjualanview.php")
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
					$this->terminate(GetUrl("detailpenjualanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->id_penjualan->setVisibility();
		$this->id_barang->setVisibility();
		$this->kode_barang->setVisibility();
		$this->nama_barang->setVisibility();
		$this->id_kemasan->Visible = FALSE;
		$this->harga_jual->setVisibility();
		$this->stok->setVisibility();
		$this->expired->Visible = FALSE;
		$this->qty->setVisibility();
		$this->disc_pr->setVisibility();
		$this->disc_rp->setVisibility();
		$this->komisi_recall->setVisibility();
		$this->subtotal->setVisibility();
		$this->hna->Visible = FALSE;
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
		$this->setupLookupOptions($this->id_penjualan);
		$this->setupLookupOptions($this->id_barang);
		$this->setupLookupOptions($this->kode_barang);
		$this->setupLookupOptions($this->nama_barang);
		$this->setupLookupOptions($this->komisi_recall);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("detailpenjualanlist.php");
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

		// Set up master/detail parameters
		// NOTE: must be after loadOldRecord to prevent master key values overwritten

		$this->setupMasterParms();

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
					$this->terminate("detailpenjualanlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "detailpenjualanlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "detailpenjualanview.php")
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
		$this->id_penjualan->CurrentValue = NULL;
		$this->id_penjualan->OldValue = $this->id_penjualan->CurrentValue;
		$this->id_barang->CurrentValue = NULL;
		$this->id_barang->OldValue = $this->id_barang->CurrentValue;
		$this->kode_barang->CurrentValue = NULL;
		$this->kode_barang->OldValue = $this->kode_barang->CurrentValue;
		$this->nama_barang->CurrentValue = NULL;
		$this->nama_barang->OldValue = $this->nama_barang->CurrentValue;
		$this->id_kemasan->CurrentValue = NULL;
		$this->id_kemasan->OldValue = $this->id_kemasan->CurrentValue;
		$this->harga_jual->CurrentValue = NULL;
		$this->harga_jual->OldValue = $this->harga_jual->CurrentValue;
		$this->stok->CurrentValue = NULL;
		$this->stok->OldValue = $this->stok->CurrentValue;
		$this->expired->CurrentValue = NULL;
		$this->expired->OldValue = $this->expired->CurrentValue;
		$this->qty->CurrentValue = NULL;
		$this->qty->OldValue = $this->qty->CurrentValue;
		$this->disc_pr->CurrentValue = NULL;
		$this->disc_pr->OldValue = $this->disc_pr->CurrentValue;
		$this->disc_rp->CurrentValue = NULL;
		$this->disc_rp->OldValue = $this->disc_rp->CurrentValue;
		$this->komisi_recall->CurrentValue = NULL;
		$this->komisi_recall->OldValue = $this->komisi_recall->CurrentValue;
		$this->subtotal->CurrentValue = NULL;
		$this->subtotal->OldValue = $this->subtotal->CurrentValue;
		$this->hna->CurrentValue = NULL;
		$this->hna->OldValue = $this->hna->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_penjualan' first before field var 'x_id_penjualan'
		$val = $CurrentForm->hasValue("id_penjualan") ? $CurrentForm->getValue("id_penjualan") : $CurrentForm->getValue("x_id_penjualan");
		if (!$this->id_penjualan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_penjualan->Visible = FALSE; // Disable update for API request
			else
				$this->id_penjualan->setFormValue($val);
		}

		// Check field name 'id_barang' first before field var 'x_id_barang'
		$val = $CurrentForm->hasValue("id_barang") ? $CurrentForm->getValue("id_barang") : $CurrentForm->getValue("x_id_barang");
		if (!$this->id_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_barang->Visible = FALSE; // Disable update for API request
			else
				$this->id_barang->setFormValue($val);
		}

		// Check field name 'kode_barang' first before field var 'x_kode_barang'
		$val = $CurrentForm->hasValue("kode_barang") ? $CurrentForm->getValue("kode_barang") : $CurrentForm->getValue("x_kode_barang");
		if (!$this->kode_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kode_barang->Visible = FALSE; // Disable update for API request
			else
				$this->kode_barang->setFormValue($val);
		}

		// Check field name 'nama_barang' first before field var 'x_nama_barang'
		$val = $CurrentForm->hasValue("nama_barang") ? $CurrentForm->getValue("nama_barang") : $CurrentForm->getValue("x_nama_barang");
		if (!$this->nama_barang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_barang->Visible = FALSE; // Disable update for API request
			else
				$this->nama_barang->setFormValue($val);
		}

		// Check field name 'harga_jual' first before field var 'x_harga_jual'
		$val = $CurrentForm->hasValue("harga_jual") ? $CurrentForm->getValue("harga_jual") : $CurrentForm->getValue("x_harga_jual");
		if (!$this->harga_jual->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->harga_jual->Visible = FALSE; // Disable update for API request
			else
				$this->harga_jual->setFormValue($val);
		}

		// Check field name 'stok' first before field var 'x_stok'
		$val = $CurrentForm->hasValue("stok") ? $CurrentForm->getValue("stok") : $CurrentForm->getValue("x_stok");
		if (!$this->stok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->stok->Visible = FALSE; // Disable update for API request
			else
				$this->stok->setFormValue($val);
		}

		// Check field name 'qty' first before field var 'x_qty'
		$val = $CurrentForm->hasValue("qty") ? $CurrentForm->getValue("qty") : $CurrentForm->getValue("x_qty");
		if (!$this->qty->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->qty->Visible = FALSE; // Disable update for API request
			else
				$this->qty->setFormValue($val);
		}

		// Check field name 'disc_pr' first before field var 'x_disc_pr'
		$val = $CurrentForm->hasValue("disc_pr") ? $CurrentForm->getValue("disc_pr") : $CurrentForm->getValue("x_disc_pr");
		if (!$this->disc_pr->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disc_pr->Visible = FALSE; // Disable update for API request
			else
				$this->disc_pr->setFormValue($val);
		}

		// Check field name 'disc_rp' first before field var 'x_disc_rp'
		$val = $CurrentForm->hasValue("disc_rp") ? $CurrentForm->getValue("disc_rp") : $CurrentForm->getValue("x_disc_rp");
		if (!$this->disc_rp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disc_rp->Visible = FALSE; // Disable update for API request
			else
				$this->disc_rp->setFormValue($val);
		}

		// Check field name 'komisi_recall' first before field var 'x_komisi_recall'
		$val = $CurrentForm->hasValue("komisi_recall") ? $CurrentForm->getValue("komisi_recall") : $CurrentForm->getValue("x_komisi_recall");
		if (!$this->komisi_recall->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->komisi_recall->Visible = FALSE; // Disable update for API request
			else
				$this->komisi_recall->setFormValue($val);
		}

		// Check field name 'subtotal' first before field var 'x_subtotal'
		$val = $CurrentForm->hasValue("subtotal") ? $CurrentForm->getValue("subtotal") : $CurrentForm->getValue("x_subtotal");
		if (!$this->subtotal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->subtotal->Visible = FALSE; // Disable update for API request
			else
				$this->subtotal->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_penjualan->CurrentValue = $this->id_penjualan->FormValue;
		$this->id_barang->CurrentValue = $this->id_barang->FormValue;
		$this->kode_barang->CurrentValue = $this->kode_barang->FormValue;
		$this->nama_barang->CurrentValue = $this->nama_barang->FormValue;
		$this->harga_jual->CurrentValue = $this->harga_jual->FormValue;
		$this->stok->CurrentValue = $this->stok->FormValue;
		$this->qty->CurrentValue = $this->qty->FormValue;
		$this->disc_pr->CurrentValue = $this->disc_pr->FormValue;
		$this->disc_rp->CurrentValue = $this->disc_rp->FormValue;
		$this->komisi_recall->CurrentValue = $this->komisi_recall->FormValue;
		$this->subtotal->CurrentValue = $this->subtotal->FormValue;
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
		$this->id_penjualan->setDbValue($row['id_penjualan']);
		$this->id_barang->setDbValue($row['id_barang']);
		$this->kode_barang->setDbValue($row['kode_barang']);
		$this->nama_barang->setDbValue($row['nama_barang']);
		$this->id_kemasan->setDbValue($row['id_kemasan']);
		$this->harga_jual->setDbValue($row['harga_jual']);
		$this->stok->setDbValue($row['stok']);
		$this->expired->setDbValue($row['expired']);
		$this->qty->setDbValue($row['qty']);
		$this->disc_pr->setDbValue($row['disc_pr']);
		$this->disc_rp->setDbValue($row['disc_rp']);
		$this->komisi_recall->setDbValue($row['komisi_recall']);
		$this->subtotal->setDbValue($row['subtotal']);
		$this->hna->setDbValue($row['hna']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['id_penjualan'] = $this->id_penjualan->CurrentValue;
		$row['id_barang'] = $this->id_barang->CurrentValue;
		$row['kode_barang'] = $this->kode_barang->CurrentValue;
		$row['nama_barang'] = $this->nama_barang->CurrentValue;
		$row['id_kemasan'] = $this->id_kemasan->CurrentValue;
		$row['harga_jual'] = $this->harga_jual->CurrentValue;
		$row['stok'] = $this->stok->CurrentValue;
		$row['expired'] = $this->expired->CurrentValue;
		$row['qty'] = $this->qty->CurrentValue;
		$row['disc_pr'] = $this->disc_pr->CurrentValue;
		$row['disc_rp'] = $this->disc_rp->CurrentValue;
		$row['komisi_recall'] = $this->komisi_recall->CurrentValue;
		$row['subtotal'] = $this->subtotal->CurrentValue;
		$row['hna'] = $this->hna->CurrentValue;
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

		if ($this->harga_jual->FormValue == $this->harga_jual->CurrentValue && is_numeric(ConvertToFloatString($this->harga_jual->CurrentValue)))
			$this->harga_jual->CurrentValue = ConvertToFloatString($this->harga_jual->CurrentValue);

		// Convert decimal values if posted back
		if ($this->stok->FormValue == $this->stok->CurrentValue && is_numeric(ConvertToFloatString($this->stok->CurrentValue)))
			$this->stok->CurrentValue = ConvertToFloatString($this->stok->CurrentValue);

		// Convert decimal values if posted back
		if ($this->qty->FormValue == $this->qty->CurrentValue && is_numeric(ConvertToFloatString($this->qty->CurrentValue)))
			$this->qty->CurrentValue = ConvertToFloatString($this->qty->CurrentValue);

		// Convert decimal values if posted back
		if ($this->disc_pr->FormValue == $this->disc_pr->CurrentValue && is_numeric(ConvertToFloatString($this->disc_pr->CurrentValue)))
			$this->disc_pr->CurrentValue = ConvertToFloatString($this->disc_pr->CurrentValue);

		// Convert decimal values if posted back
		if ($this->disc_rp->FormValue == $this->disc_rp->CurrentValue && is_numeric(ConvertToFloatString($this->disc_rp->CurrentValue)))
			$this->disc_rp->CurrentValue = ConvertToFloatString($this->disc_rp->CurrentValue);

		// Convert decimal values if posted back
		if ($this->subtotal->FormValue == $this->subtotal->CurrentValue && is_numeric(ConvertToFloatString($this->subtotal->CurrentValue)))
			$this->subtotal->CurrentValue = ConvertToFloatString($this->subtotal->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// id_penjualan
		// id_barang
		// kode_barang
		// nama_barang
		// id_kemasan
		// harga_jual
		// stok
		// expired
		// qty
		// disc_pr
		// disc_rp
		// komisi_recall
		// subtotal
		// hna

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// id_penjualan
			$curVal = strval($this->id_penjualan->CurrentValue);
			if ($curVal != "") {
				$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
				if ($this->id_penjualan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->id_penjualan->ViewValue = $this->id_penjualan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
					}
				}
			} else {
				$this->id_penjualan->ViewValue = NULL;
			}
			$this->id_penjualan->ViewCustomAttributes = "";

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

			// kode_barang
			$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
			$curVal = strval($this->kode_barang->CurrentValue);
			if ($curVal != "") {
				$this->kode_barang->ViewValue = $this->kode_barang->lookupCacheOption($curVal);
				if ($this->kode_barang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`discontinue` <> 'Yes'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->kode_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kode_barang->ViewValue = $this->kode_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kode_barang->ViewValue = $this->kode_barang->CurrentValue;
					}
				}
			} else {
				$this->kode_barang->ViewValue = NULL;
			}
			$this->kode_barang->ViewCustomAttributes = "";

			// nama_barang
			$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
			$curVal = strval($this->nama_barang->CurrentValue);
			if ($curVal != "") {
				$this->nama_barang->ViewValue = $this->nama_barang->lookupCacheOption($curVal);
				if ($this->nama_barang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`discontinue` <> 'Yes'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->nama_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->nama_barang->ViewValue = $this->nama_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nama_barang->ViewValue = $this->nama_barang->CurrentValue;
					}
				}
			} else {
				$this->nama_barang->ViewValue = NULL;
			}
			$this->nama_barang->ViewCustomAttributes = "";

			// id_kemasan
			$this->id_kemasan->ViewValue = FormatNumber($this->id_kemasan->ViewValue, 0, -2, -2, -2);
			$this->id_kemasan->ViewCustomAttributes = "";

			// harga_jual
			$this->harga_jual->ViewValue = $this->harga_jual->CurrentValue;
			$this->harga_jual->ViewValue = FormatNumber($this->harga_jual->ViewValue, 0, -2, -2, -2);
			$this->harga_jual->ViewCustomAttributes = "";

			// stok
			$this->stok->ViewValue = $this->stok->CurrentValue;
			$this->stok->ViewValue = FormatNumber($this->stok->ViewValue, 2, -2, -2, -2);
			$this->stok->ViewCustomAttributes = "";

			// expired
			$this->expired->ViewValue = $this->expired->CurrentValue;
			$this->expired->ViewValue = FormatDateTime($this->expired->ViewValue, 0);
			$this->expired->ViewCustomAttributes = "";

			// qty
			$this->qty->ViewValue = $this->qty->CurrentValue;
			$this->qty->ViewValue = FormatNumber($this->qty->ViewValue, 2, -2, -2, -2);
			$this->qty->ViewCustomAttributes = "";

			// disc_pr
			$this->disc_pr->ViewValue = $this->disc_pr->CurrentValue;
			$this->disc_pr->ViewValue = FormatNumber($this->disc_pr->ViewValue, 2, -2, -2, -2);
			$this->disc_pr->ViewCustomAttributes = "";

			// disc_rp
			$this->disc_rp->ViewValue = $this->disc_rp->CurrentValue;
			$this->disc_rp->ViewValue = FormatNumber($this->disc_rp->ViewValue, 2, -2, -2, -2);
			$this->disc_rp->ViewCustomAttributes = "";

			// komisi_recall
			$curVal = strval($this->komisi_recall->CurrentValue);
			if ($curVal != "") {
				$this->komisi_recall->ViewValue = $this->komisi_recall->lookupCacheOption($curVal);
				if ($this->komisi_recall->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_pegawai`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->komisi_recall->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->komisi_recall->ViewValue = $this->komisi_recall->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->komisi_recall->ViewValue = $this->komisi_recall->CurrentValue;
					}
				}
			} else {
				$this->komisi_recall->ViewValue = NULL;
			}
			$this->komisi_recall->ViewCustomAttributes = "";

			// subtotal
			$this->subtotal->ViewValue = $this->subtotal->CurrentValue;
			$this->subtotal->ViewValue = FormatNumber($this->subtotal->ViewValue, 0, -2, -2, -2);
			$this->subtotal->ViewCustomAttributes = "";

			// hna
			$this->hna->ViewValue = $this->hna->CurrentValue;
			$this->hna->ViewValue = FormatNumber($this->hna->ViewValue, 0, -2, -2, -2);
			$this->hna->ViewCustomAttributes = "";

			// id_penjualan
			$this->id_penjualan->LinkCustomAttributes = "";
			$this->id_penjualan->HrefValue = "";
			$this->id_penjualan->TooltipValue = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";
			$this->id_barang->TooltipValue = "";

			// kode_barang
			$this->kode_barang->LinkCustomAttributes = "";
			$this->kode_barang->HrefValue = "";
			$this->kode_barang->TooltipValue = "";

			// nama_barang
			$this->nama_barang->LinkCustomAttributes = "";
			$this->nama_barang->HrefValue = "";
			$this->nama_barang->TooltipValue = "";

			// harga_jual
			$this->harga_jual->LinkCustomAttributes = "";
			$this->harga_jual->HrefValue = "";
			$this->harga_jual->TooltipValue = "";

			// stok
			$this->stok->LinkCustomAttributes = "";
			$this->stok->HrefValue = "";
			$this->stok->TooltipValue = "";

			// qty
			$this->qty->LinkCustomAttributes = "";
			$this->qty->HrefValue = "";
			$this->qty->TooltipValue = "";

			// disc_pr
			$this->disc_pr->LinkCustomAttributes = "";
			$this->disc_pr->HrefValue = "";
			$this->disc_pr->TooltipValue = "";

			// disc_rp
			$this->disc_rp->LinkCustomAttributes = "";
			$this->disc_rp->HrefValue = "";
			$this->disc_rp->TooltipValue = "";

			// komisi_recall
			$this->komisi_recall->LinkCustomAttributes = "";
			$this->komisi_recall->HrefValue = "";
			$this->komisi_recall->TooltipValue = "";

			// subtotal
			$this->subtotal->LinkCustomAttributes = "";
			$this->subtotal->HrefValue = "";
			$this->subtotal->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_penjualan
			$this->id_penjualan->EditAttrs["class"] = "form-control";
			$this->id_penjualan->EditCustomAttributes = "";
			if ($this->id_penjualan->getSessionValue() != "") {
				$this->id_penjualan->CurrentValue = $this->id_penjualan->getSessionValue();
				$curVal = strval($this->id_penjualan->CurrentValue);
				if ($curVal != "") {
					$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
					if ($this->id_penjualan->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->id_penjualan->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->id_penjualan->ViewValue = $this->id_penjualan->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->id_penjualan->ViewValue = $this->id_penjualan->CurrentValue;
						}
					}
				} else {
					$this->id_penjualan->ViewValue = NULL;
				}
				$this->id_penjualan->ViewCustomAttributes = "";
			} else {
				$curVal = trim(strval($this->id_penjualan->CurrentValue));
				if ($curVal != "")
					$this->id_penjualan->ViewValue = $this->id_penjualan->lookupCacheOption($curVal);
				else
					$this->id_penjualan->ViewValue = $this->id_penjualan->Lookup !== NULL && is_array($this->id_penjualan->Lookup->Options) ? $curVal : NULL;
				if ($this->id_penjualan->ViewValue !== NULL) { // Load from cache
					$this->id_penjualan->EditValue = array_values($this->id_penjualan->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`id`" . SearchString("=", $this->id_penjualan->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->id_penjualan->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->id_penjualan->EditValue = $arwrk;
				}
			}

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

			// kode_barang
			$this->kode_barang->EditAttrs["class"] = "form-control";
			$this->kode_barang->EditCustomAttributes = "";
			$this->kode_barang->EditValue = HtmlEncode($this->kode_barang->CurrentValue);
			$curVal = strval($this->kode_barang->CurrentValue);
			if ($curVal != "") {
				$this->kode_barang->EditValue = $this->kode_barang->lookupCacheOption($curVal);
				if ($this->kode_barang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`discontinue` <> 'Yes'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->kode_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->kode_barang->EditValue = $this->kode_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kode_barang->EditValue = HtmlEncode($this->kode_barang->CurrentValue);
					}
				}
			} else {
				$this->kode_barang->EditValue = NULL;
			}
			$this->kode_barang->PlaceHolder = RemoveHtml($this->kode_barang->caption());

			// nama_barang
			$this->nama_barang->EditAttrs["class"] = "form-control";
			$this->nama_barang->EditCustomAttributes = "";
			$this->nama_barang->EditValue = HtmlEncode($this->nama_barang->CurrentValue);
			$curVal = strval($this->nama_barang->CurrentValue);
			if ($curVal != "") {
				$this->nama_barang->EditValue = $this->nama_barang->lookupCacheOption($curVal);
				if ($this->nama_barang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$lookupFilter = function() {
						return "`discontinue` <> 'Yes'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->nama_barang->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->nama_barang->EditValue = $this->nama_barang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nama_barang->EditValue = HtmlEncode($this->nama_barang->CurrentValue);
					}
				}
			} else {
				$this->nama_barang->EditValue = NULL;
			}
			$this->nama_barang->PlaceHolder = RemoveHtml($this->nama_barang->caption());

			// harga_jual
			$this->harga_jual->EditAttrs["class"] = "form-control";
			$this->harga_jual->EditCustomAttributes = "readonly";
			$this->harga_jual->EditValue = HtmlEncode($this->harga_jual->CurrentValue);
			$this->harga_jual->PlaceHolder = RemoveHtml($this->harga_jual->caption());
			if (strval($this->harga_jual->EditValue) != "" && is_numeric($this->harga_jual->EditValue))
				$this->harga_jual->EditValue = FormatNumber($this->harga_jual->EditValue, -2, -2, -2, -2);
			

			// stok
			$this->stok->EditAttrs["class"] = "form-control";
			$this->stok->EditCustomAttributes = "readonly";
			$this->stok->EditValue = HtmlEncode($this->stok->CurrentValue);
			$this->stok->PlaceHolder = RemoveHtml($this->stok->caption());
			if (strval($this->stok->EditValue) != "" && is_numeric($this->stok->EditValue))
				$this->stok->EditValue = FormatNumber($this->stok->EditValue, -2, -2, -2, -2);
			

			// qty
			$this->qty->EditAttrs["class"] = "form-control";
			$this->qty->EditCustomAttributes = "";
			$this->qty->EditValue = HtmlEncode($this->qty->CurrentValue);
			$this->qty->PlaceHolder = RemoveHtml($this->qty->caption());
			if (strval($this->qty->EditValue) != "" && is_numeric($this->qty->EditValue))
				$this->qty->EditValue = FormatNumber($this->qty->EditValue, -2, -2, -2, -2);
			

			// disc_pr
			$this->disc_pr->EditAttrs["class"] = "form-control";
			$this->disc_pr->EditCustomAttributes = "";
			$this->disc_pr->EditValue = HtmlEncode($this->disc_pr->CurrentValue);
			$this->disc_pr->PlaceHolder = RemoveHtml($this->disc_pr->caption());
			if (strval($this->disc_pr->EditValue) != "" && is_numeric($this->disc_pr->EditValue))
				$this->disc_pr->EditValue = FormatNumber($this->disc_pr->EditValue, -2, -2, -2, -2);
			

			// disc_rp
			$this->disc_rp->EditAttrs["class"] = "form-control";
			$this->disc_rp->EditCustomAttributes = "";
			$this->disc_rp->EditValue = HtmlEncode($this->disc_rp->CurrentValue);
			$this->disc_rp->PlaceHolder = RemoveHtml($this->disc_rp->caption());
			if (strval($this->disc_rp->EditValue) != "" && is_numeric($this->disc_rp->EditValue))
				$this->disc_rp->EditValue = FormatNumber($this->disc_rp->EditValue, -2, -2, -2, -2);
			

			// komisi_recall
			$this->komisi_recall->EditAttrs["class"] = "form-control";
			$this->komisi_recall->EditCustomAttributes = "";
			$curVal = trim(strval($this->komisi_recall->CurrentValue));
			if ($curVal != "")
				$this->komisi_recall->ViewValue = $this->komisi_recall->lookupCacheOption($curVal);
			else
				$this->komisi_recall->ViewValue = $this->komisi_recall->Lookup !== NULL && is_array($this->komisi_recall->Lookup->Options) ? $curVal : NULL;
			if ($this->komisi_recall->ViewValue !== NULL) { // Load from cache
				$this->komisi_recall->EditValue = array_values($this->komisi_recall->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_pegawai`" . SearchString("=", $this->komisi_recall->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->komisi_recall->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->komisi_recall->EditValue = $arwrk;
			}

			// subtotal
			$this->subtotal->EditAttrs["class"] = "form-control";
			$this->subtotal->EditCustomAttributes = "Readonly";
			$this->subtotal->EditValue = HtmlEncode($this->subtotal->CurrentValue);
			$this->subtotal->PlaceHolder = RemoveHtml($this->subtotal->caption());
			if (strval($this->subtotal->EditValue) != "" && is_numeric($this->subtotal->EditValue))
				$this->subtotal->EditValue = FormatNumber($this->subtotal->EditValue, -2, -2, -2, -2);
			

			// Add refer script
			// id_penjualan

			$this->id_penjualan->LinkCustomAttributes = "";
			$this->id_penjualan->HrefValue = "";

			// id_barang
			$this->id_barang->LinkCustomAttributes = "";
			$this->id_barang->HrefValue = "";

			// kode_barang
			$this->kode_barang->LinkCustomAttributes = "";
			$this->kode_barang->HrefValue = "";

			// nama_barang
			$this->nama_barang->LinkCustomAttributes = "";
			$this->nama_barang->HrefValue = "";

			// harga_jual
			$this->harga_jual->LinkCustomAttributes = "";
			$this->harga_jual->HrefValue = "";

			// stok
			$this->stok->LinkCustomAttributes = "";
			$this->stok->HrefValue = "";

			// qty
			$this->qty->LinkCustomAttributes = "";
			$this->qty->HrefValue = "";

			// disc_pr
			$this->disc_pr->LinkCustomAttributes = "";
			$this->disc_pr->HrefValue = "";

			// disc_rp
			$this->disc_rp->LinkCustomAttributes = "";
			$this->disc_rp->HrefValue = "";

			// komisi_recall
			$this->komisi_recall->LinkCustomAttributes = "";
			$this->komisi_recall->HrefValue = "";

			// subtotal
			$this->subtotal->LinkCustomAttributes = "";
			$this->subtotal->HrefValue = "";
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
		if ($this->id_penjualan->Required) {
			if (!$this->id_penjualan->IsDetailKey && $this->id_penjualan->FormValue != NULL && $this->id_penjualan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_penjualan->caption(), $this->id_penjualan->RequiredErrorMessage));
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
		if ($this->kode_barang->Required) {
			if (!$this->kode_barang->IsDetailKey && $this->kode_barang->FormValue != NULL && $this->kode_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kode_barang->caption(), $this->kode_barang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kode_barang->FormValue)) {
			AddMessage($FormError, $this->kode_barang->errorMessage());
		}
		if ($this->nama_barang->Required) {
			if (!$this->nama_barang->IsDetailKey && $this->nama_barang->FormValue != NULL && $this->nama_barang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_barang->caption(), $this->nama_barang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->nama_barang->FormValue)) {
			AddMessage($FormError, $this->nama_barang->errorMessage());
		}
		if ($this->harga_jual->Required) {
			if (!$this->harga_jual->IsDetailKey && $this->harga_jual->FormValue != NULL && $this->harga_jual->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->harga_jual->caption(), $this->harga_jual->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->harga_jual->FormValue)) {
			AddMessage($FormError, $this->harga_jual->errorMessage());
		}
		if ($this->stok->Required) {
			if (!$this->stok->IsDetailKey && $this->stok->FormValue != NULL && $this->stok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->stok->caption(), $this->stok->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->stok->FormValue)) {
			AddMessage($FormError, $this->stok->errorMessage());
		}
		if ($this->qty->Required) {
			if (!$this->qty->IsDetailKey && $this->qty->FormValue != NULL && $this->qty->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->qty->caption(), $this->qty->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->qty->FormValue)) {
			AddMessage($FormError, $this->qty->errorMessage());
		}
		if ($this->disc_pr->Required) {
			if (!$this->disc_pr->IsDetailKey && $this->disc_pr->FormValue != NULL && $this->disc_pr->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disc_pr->caption(), $this->disc_pr->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->disc_pr->FormValue)) {
			AddMessage($FormError, $this->disc_pr->errorMessage());
		}
		if ($this->disc_rp->Required) {
			if (!$this->disc_rp->IsDetailKey && $this->disc_rp->FormValue != NULL && $this->disc_rp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disc_rp->caption(), $this->disc_rp->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->disc_rp->FormValue)) {
			AddMessage($FormError, $this->disc_rp->errorMessage());
		}
		if ($this->komisi_recall->Required) {
			if (!$this->komisi_recall->IsDetailKey && $this->komisi_recall->FormValue != NULL && $this->komisi_recall->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->komisi_recall->caption(), $this->komisi_recall->RequiredErrorMessage));
			}
		}
		if ($this->subtotal->Required) {
			if (!$this->subtotal->IsDetailKey && $this->subtotal->FormValue != NULL && $this->subtotal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->subtotal->caption(), $this->subtotal->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->subtotal->FormValue)) {
			AddMessage($FormError, $this->subtotal->errorMessage());
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

		// id_penjualan
		$this->id_penjualan->setDbValueDef($rsnew, $this->id_penjualan->CurrentValue, 0, FALSE);

		// id_barang
		$this->id_barang->setDbValueDef($rsnew, $this->id_barang->CurrentValue, NULL, FALSE);

		// kode_barang
		$this->kode_barang->setDbValueDef($rsnew, $this->kode_barang->CurrentValue, NULL, FALSE);

		// nama_barang
		$this->nama_barang->setDbValueDef($rsnew, $this->nama_barang->CurrentValue, NULL, FALSE);

		// harga_jual
		$this->harga_jual->setDbValueDef($rsnew, $this->harga_jual->CurrentValue, 0, FALSE);

		// stok
		$this->stok->setDbValueDef($rsnew, $this->stok->CurrentValue, NULL, FALSE);

		// qty
		$this->qty->setDbValueDef($rsnew, $this->qty->CurrentValue, 0, strval($this->qty->CurrentValue) == "");

		// disc_pr
		$this->disc_pr->setDbValueDef($rsnew, $this->disc_pr->CurrentValue, NULL, FALSE);

		// disc_rp
		$this->disc_rp->setDbValueDef($rsnew, $this->disc_rp->CurrentValue, NULL, FALSE);

		// komisi_recall
		$this->komisi_recall->setDbValueDef($rsnew, $this->komisi_recall->CurrentValue, NULL, FALSE);

		// subtotal
		$this->subtotal->setDbValueDef($rsnew, $this->subtotal->CurrentValue, NULL, FALSE);

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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "penjualan") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("id_penjualan"))) !== NULL) {
					$GLOBALS["penjualan"]->id->setQueryStringValue($parm);
					$this->id_penjualan->setQueryStringValue($GLOBALS["penjualan"]->id->QueryStringValue);
					$this->id_penjualan->setSessionValue($this->id_penjualan->QueryStringValue);
					if (!is_numeric($GLOBALS["penjualan"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "penjualan") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("id_penjualan"))) !== NULL) {
					$GLOBALS["penjualan"]->id->setFormValue($parm);
					$this->id_penjualan->setFormValue($GLOBALS["penjualan"]->id->FormValue);
					$this->id_penjualan->setSessionValue($this->id_penjualan->FormValue);
					if (!is_numeric($GLOBALS["penjualan"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "penjualan") {
				if ($this->id_penjualan->CurrentValue == "")
					$this->id_penjualan->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("detailpenjualanlist.php"), "", $this->TableVar, TRUE);
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
				case "x_id_penjualan":
					break;
				case "x_id_barang":
					break;
				case "x_kode_barang":
					$lookupFilter = function() {
						return "`discontinue` <> 'Yes'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_nama_barang":
					$lookupFilter = function() {
						return "`discontinue` <> 'Yes'";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_komisi_recall":
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
						case "x_id_penjualan":
							break;
						case "x_id_barang":
							break;
						case "x_kode_barang":
							break;
						case "x_nama_barang":
							break;
						case "x_komisi_recall":
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