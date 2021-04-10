<?php
namespace PHPMaker2020\klinik_latest_09_04_21;

/**
 * Page class
 */
class m_pelanggan_add extends m_pelanggan
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{8C91985A-7590-4658-895B-4BCC6B46002F}";

	// Table name
	public $TableName = 'm_pelanggan';

	// Page object name
	public $PageObjName = "m_pelanggan_add";

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

		// Table object (m_pelanggan)
		if (!isset($GLOBALS["m_pelanggan"]) || get_class($GLOBALS["m_pelanggan"]) == PROJECT_NAMESPACE . "m_pelanggan") {
			$GLOBALS["m_pelanggan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["m_pelanggan"];
		}

		// Table object (users)
		if (!isset($GLOBALS['users']))
			$GLOBALS['users'] = new users();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'm_pelanggan');

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
		global $m_pelanggan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($m_pelanggan);
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
					if ($pageName == "m_pelangganview.php")
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
			$key .= @$ar['id_pelanggan'];
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
			$this->id_pelanggan->Visible = FALSE;
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
					$this->terminate(GetUrl("m_pelangganlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_pelanggan->Visible = FALSE;
		$this->kode_pelanggan->Visible = FALSE;
		$this->noktp_pelanggan->setVisibility();
		$this->nama_pelanggan->setVisibility();
		$this->jenis_pelanggan->setVisibility();
		$this->tgllahir_pelanggan->setVisibility();
		$this->pekerjaan_pelanggan->setVisibility();
		$this->kota_pelanggan->setVisibility();
		$this->alamat_pelanggan->setVisibility();
		$this->telpon_pelanggan->setVisibility();
		$this->hp_pelanggan->setVisibility();
		$this->id_klinik->setVisibility();
		$this->tgl_daftar->setVisibility();
		$this->kategori->setVisibility();
		$this->tipe->setVisibility();
		$this->tgl_terakhir_transaksi->Visible = FALSE;
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
		$this->setupLookupOptions($this->pekerjaan_pelanggan);
		$this->setupLookupOptions($this->kota_pelanggan);
		$this->setupLookupOptions($this->id_klinik);
		$this->setupLookupOptions($this->kategori);
		$this->setupLookupOptions($this->tipe);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("m_pelangganlist.php");
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
			if (Get("id_pelanggan") !== NULL) {
				$this->id_pelanggan->setQueryStringValue(Get("id_pelanggan"));
				$this->setKey("id_pelanggan", $this->id_pelanggan->CurrentValue); // Set up key
			} else {
				$this->setKey("id_pelanggan", ""); // Clear key
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
					$this->terminate("m_pelangganlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "m_pelangganlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "m_pelangganview.php")
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
		$this->id_pelanggan->CurrentValue = NULL;
		$this->id_pelanggan->OldValue = $this->id_pelanggan->CurrentValue;
		$this->kode_pelanggan->CurrentValue = NULL;
		$this->kode_pelanggan->OldValue = $this->kode_pelanggan->CurrentValue;
		$this->noktp_pelanggan->CurrentValue = NULL;
		$this->noktp_pelanggan->OldValue = $this->noktp_pelanggan->CurrentValue;
		$this->nama_pelanggan->CurrentValue = NULL;
		$this->nama_pelanggan->OldValue = $this->nama_pelanggan->CurrentValue;
		$this->jenis_pelanggan->CurrentValue = NULL;
		$this->jenis_pelanggan->OldValue = $this->jenis_pelanggan->CurrentValue;
		$this->tgllahir_pelanggan->CurrentValue = NULL;
		$this->tgllahir_pelanggan->OldValue = $this->tgllahir_pelanggan->CurrentValue;
		$this->pekerjaan_pelanggan->CurrentValue = NULL;
		$this->pekerjaan_pelanggan->OldValue = $this->pekerjaan_pelanggan->CurrentValue;
		$this->kota_pelanggan->CurrentValue = NULL;
		$this->kota_pelanggan->OldValue = $this->kota_pelanggan->CurrentValue;
		$this->alamat_pelanggan->CurrentValue = NULL;
		$this->alamat_pelanggan->OldValue = $this->alamat_pelanggan->CurrentValue;
		$this->telpon_pelanggan->CurrentValue = NULL;
		$this->telpon_pelanggan->OldValue = $this->telpon_pelanggan->CurrentValue;
		$this->hp_pelanggan->CurrentValue = NULL;
		$this->hp_pelanggan->OldValue = $this->hp_pelanggan->CurrentValue;
		$this->id_klinik->CurrentValue = NULL;
		$this->id_klinik->OldValue = $this->id_klinik->CurrentValue;
		$this->tgl_daftar->CurrentValue = NULL;
		$this->tgl_daftar->OldValue = $this->tgl_daftar->CurrentValue;
		$this->kategori->CurrentValue = NULL;
		$this->kategori->OldValue = $this->kategori->CurrentValue;
		$this->tipe->CurrentValue = NULL;
		$this->tipe->OldValue = $this->tipe->CurrentValue;
		$this->tgl_terakhir_transaksi->CurrentValue = NULL;
		$this->tgl_terakhir_transaksi->OldValue = $this->tgl_terakhir_transaksi->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'noktp_pelanggan' first before field var 'x_noktp_pelanggan'
		$val = $CurrentForm->hasValue("noktp_pelanggan") ? $CurrentForm->getValue("noktp_pelanggan") : $CurrentForm->getValue("x_noktp_pelanggan");
		if (!$this->noktp_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->noktp_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->noktp_pelanggan->setFormValue($val);
		}

		// Check field name 'nama_pelanggan' first before field var 'x_nama_pelanggan'
		$val = $CurrentForm->hasValue("nama_pelanggan") ? $CurrentForm->getValue("nama_pelanggan") : $CurrentForm->getValue("x_nama_pelanggan");
		if (!$this->nama_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->nama_pelanggan->setFormValue($val);
		}

		// Check field name 'jenis_pelanggan' first before field var 'x_jenis_pelanggan'
		$val = $CurrentForm->hasValue("jenis_pelanggan") ? $CurrentForm->getValue("jenis_pelanggan") : $CurrentForm->getValue("x_jenis_pelanggan");
		if (!$this->jenis_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_pelanggan->setFormValue($val);
		}

		// Check field name 'tgllahir_pelanggan' first before field var 'x_tgllahir_pelanggan'
		$val = $CurrentForm->hasValue("tgllahir_pelanggan") ? $CurrentForm->getValue("tgllahir_pelanggan") : $CurrentForm->getValue("x_tgllahir_pelanggan");
		if (!$this->tgllahir_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgllahir_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->tgllahir_pelanggan->setFormValue($val);
			$this->tgllahir_pelanggan->CurrentValue = UnFormatDateTime($this->tgllahir_pelanggan->CurrentValue, 0);
		}

		// Check field name 'pekerjaan_pelanggan' first before field var 'x_pekerjaan_pelanggan'
		$val = $CurrentForm->hasValue("pekerjaan_pelanggan") ? $CurrentForm->getValue("pekerjaan_pelanggan") : $CurrentForm->getValue("x_pekerjaan_pelanggan");
		if (!$this->pekerjaan_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pekerjaan_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->pekerjaan_pelanggan->setFormValue($val);
		}

		// Check field name 'kota_pelanggan' first before field var 'x_kota_pelanggan'
		$val = $CurrentForm->hasValue("kota_pelanggan") ? $CurrentForm->getValue("kota_pelanggan") : $CurrentForm->getValue("x_kota_pelanggan");
		if (!$this->kota_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kota_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->kota_pelanggan->setFormValue($val);
		}

		// Check field name 'alamat_pelanggan' first before field var 'x_alamat_pelanggan'
		$val = $CurrentForm->hasValue("alamat_pelanggan") ? $CurrentForm->getValue("alamat_pelanggan") : $CurrentForm->getValue("x_alamat_pelanggan");
		if (!$this->alamat_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->alamat_pelanggan->setFormValue($val);
		}

		// Check field name 'telpon_pelanggan' first before field var 'x_telpon_pelanggan'
		$val = $CurrentForm->hasValue("telpon_pelanggan") ? $CurrentForm->getValue("telpon_pelanggan") : $CurrentForm->getValue("x_telpon_pelanggan");
		if (!$this->telpon_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telpon_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->telpon_pelanggan->setFormValue($val);
		}

		// Check field name 'hp_pelanggan' first before field var 'x_hp_pelanggan'
		$val = $CurrentForm->hasValue("hp_pelanggan") ? $CurrentForm->getValue("hp_pelanggan") : $CurrentForm->getValue("x_hp_pelanggan");
		if (!$this->hp_pelanggan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hp_pelanggan->Visible = FALSE; // Disable update for API request
			else
				$this->hp_pelanggan->setFormValue($val);
		}

		// Check field name 'id_klinik' first before field var 'x_id_klinik'
		$val = $CurrentForm->hasValue("id_klinik") ? $CurrentForm->getValue("id_klinik") : $CurrentForm->getValue("x_id_klinik");
		if (!$this->id_klinik->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_klinik->Visible = FALSE; // Disable update for API request
			else
				$this->id_klinik->setFormValue($val);
		}

		// Check field name 'tgl_daftar' first before field var 'x_tgl_daftar'
		$val = $CurrentForm->hasValue("tgl_daftar") ? $CurrentForm->getValue("tgl_daftar") : $CurrentForm->getValue("x_tgl_daftar");
		if (!$this->tgl_daftar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_daftar->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_daftar->setFormValue($val);
			$this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 7);
		}

		// Check field name 'kategori' first before field var 'x_kategori'
		$val = $CurrentForm->hasValue("kategori") ? $CurrentForm->getValue("kategori") : $CurrentForm->getValue("x_kategori");
		if (!$this->kategori->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kategori->Visible = FALSE; // Disable update for API request
			else
				$this->kategori->setFormValue($val);
		}

		// Check field name 'tipe' first before field var 'x_tipe'
		$val = $CurrentForm->hasValue("tipe") ? $CurrentForm->getValue("tipe") : $CurrentForm->getValue("x_tipe");
		if (!$this->tipe->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tipe->Visible = FALSE; // Disable update for API request
			else
				$this->tipe->setFormValue($val);
		}

		// Check field name 'id_pelanggan' first before field var 'x_id_pelanggan'
		$val = $CurrentForm->hasValue("id_pelanggan") ? $CurrentForm->getValue("id_pelanggan") : $CurrentForm->getValue("x_id_pelanggan");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->noktp_pelanggan->CurrentValue = $this->noktp_pelanggan->FormValue;
		$this->nama_pelanggan->CurrentValue = $this->nama_pelanggan->FormValue;
		$this->jenis_pelanggan->CurrentValue = $this->jenis_pelanggan->FormValue;
		$this->tgllahir_pelanggan->CurrentValue = $this->tgllahir_pelanggan->FormValue;
		$this->tgllahir_pelanggan->CurrentValue = UnFormatDateTime($this->tgllahir_pelanggan->CurrentValue, 0);
		$this->pekerjaan_pelanggan->CurrentValue = $this->pekerjaan_pelanggan->FormValue;
		$this->kota_pelanggan->CurrentValue = $this->kota_pelanggan->FormValue;
		$this->alamat_pelanggan->CurrentValue = $this->alamat_pelanggan->FormValue;
		$this->telpon_pelanggan->CurrentValue = $this->telpon_pelanggan->FormValue;
		$this->hp_pelanggan->CurrentValue = $this->hp_pelanggan->FormValue;
		$this->id_klinik->CurrentValue = $this->id_klinik->FormValue;
		$this->tgl_daftar->CurrentValue = $this->tgl_daftar->FormValue;
		$this->tgl_daftar->CurrentValue = UnFormatDateTime($this->tgl_daftar->CurrentValue, 7);
		$this->kategori->CurrentValue = $this->kategori->FormValue;
		$this->tipe->CurrentValue = $this->tipe->FormValue;
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
		$this->id_pelanggan->setDbValue($row['id_pelanggan']);
		$this->kode_pelanggan->setDbValue($row['kode_pelanggan']);
		$this->noktp_pelanggan->setDbValue($row['noktp_pelanggan']);
		$this->nama_pelanggan->setDbValue($row['nama_pelanggan']);
		$this->jenis_pelanggan->setDbValue($row['jenis_pelanggan']);
		$this->tgllahir_pelanggan->setDbValue($row['tgllahir_pelanggan']);
		$this->pekerjaan_pelanggan->setDbValue($row['pekerjaan_pelanggan']);
		$this->kota_pelanggan->setDbValue($row['kota_pelanggan']);
		$this->alamat_pelanggan->setDbValue($row['alamat_pelanggan']);
		$this->telpon_pelanggan->setDbValue($row['telpon_pelanggan']);
		$this->hp_pelanggan->setDbValue($row['hp_pelanggan']);
		$this->id_klinik->setDbValue($row['id_klinik']);
		$this->tgl_daftar->setDbValue($row['tgl_daftar']);
		$this->kategori->setDbValue($row['kategori']);
		$this->tipe->setDbValue($row['tipe']);
		$this->tgl_terakhir_transaksi->setDbValue($row['tgl_terakhir_transaksi']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_pelanggan'] = $this->id_pelanggan->CurrentValue;
		$row['kode_pelanggan'] = $this->kode_pelanggan->CurrentValue;
		$row['noktp_pelanggan'] = $this->noktp_pelanggan->CurrentValue;
		$row['nama_pelanggan'] = $this->nama_pelanggan->CurrentValue;
		$row['jenis_pelanggan'] = $this->jenis_pelanggan->CurrentValue;
		$row['tgllahir_pelanggan'] = $this->tgllahir_pelanggan->CurrentValue;
		$row['pekerjaan_pelanggan'] = $this->pekerjaan_pelanggan->CurrentValue;
		$row['kota_pelanggan'] = $this->kota_pelanggan->CurrentValue;
		$row['alamat_pelanggan'] = $this->alamat_pelanggan->CurrentValue;
		$row['telpon_pelanggan'] = $this->telpon_pelanggan->CurrentValue;
		$row['hp_pelanggan'] = $this->hp_pelanggan->CurrentValue;
		$row['id_klinik'] = $this->id_klinik->CurrentValue;
		$row['tgl_daftar'] = $this->tgl_daftar->CurrentValue;
		$row['kategori'] = $this->kategori->CurrentValue;
		$row['tipe'] = $this->tipe->CurrentValue;
		$row['tgl_terakhir_transaksi'] = $this->tgl_terakhir_transaksi->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_pelanggan")) != "")
			$this->id_pelanggan->OldValue = $this->getKey("id_pelanggan"); // id_pelanggan
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
		// id_pelanggan
		// kode_pelanggan
		// noktp_pelanggan
		// nama_pelanggan
		// jenis_pelanggan
		// tgllahir_pelanggan
		// pekerjaan_pelanggan
		// kota_pelanggan
		// alamat_pelanggan
		// telpon_pelanggan
		// hp_pelanggan
		// id_klinik
		// tgl_daftar
		// kategori
		// tipe
		// tgl_terakhir_transaksi

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_pelanggan
			$this->id_pelanggan->ViewValue = $this->id_pelanggan->CurrentValue;
			$this->id_pelanggan->ViewCustomAttributes = "";

			// kode_pelanggan
			$this->kode_pelanggan->ViewValue = $this->kode_pelanggan->CurrentValue;
			$this->kode_pelanggan->ViewCustomAttributes = "";

			// noktp_pelanggan
			$this->noktp_pelanggan->ViewValue = $this->noktp_pelanggan->CurrentValue;
			$this->noktp_pelanggan->ViewCustomAttributes = "";

			// nama_pelanggan
			$this->nama_pelanggan->ViewValue = $this->nama_pelanggan->CurrentValue;
			$this->nama_pelanggan->ViewCustomAttributes = "";

			// jenis_pelanggan
			if (strval($this->jenis_pelanggan->CurrentValue) != "") {
				$this->jenis_pelanggan->ViewValue = $this->jenis_pelanggan->optionCaption($this->jenis_pelanggan->CurrentValue);
			} else {
				$this->jenis_pelanggan->ViewValue = NULL;
			}
			$this->jenis_pelanggan->ViewCustomAttributes = "";

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->ViewValue = $this->tgllahir_pelanggan->CurrentValue;
			$this->tgllahir_pelanggan->ViewValue = FormatDateTime($this->tgllahir_pelanggan->ViewValue, 0);
			$this->tgllahir_pelanggan->ViewCustomAttributes = "";

			// pekerjaan_pelanggan
			$curVal = strval($this->pekerjaan_pelanggan->CurrentValue);
			if ($curVal != "") {
				$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->lookupCacheOption($curVal);
				if ($this->pekerjaan_pelanggan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pekerjaan_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->CurrentValue;
					}
				}
			} else {
				$this->pekerjaan_pelanggan->ViewValue = NULL;
			}
			$this->pekerjaan_pelanggan->ViewCustomAttributes = "";

			// kota_pelanggan
			$curVal = strval($this->kota_pelanggan->CurrentValue);
			if ($curVal != "") {
				$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->lookupCacheOption($curVal);
				if ($this->kota_pelanggan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kota_pelanggan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->CurrentValue;
					}
				}
			} else {
				$this->kota_pelanggan->ViewValue = NULL;
			}
			$this->kota_pelanggan->ViewCustomAttributes = "";

			// alamat_pelanggan
			$this->alamat_pelanggan->ViewValue = $this->alamat_pelanggan->CurrentValue;
			$this->alamat_pelanggan->ViewCustomAttributes = "";

			// telpon_pelanggan
			$this->telpon_pelanggan->ViewValue = $this->telpon_pelanggan->CurrentValue;
			$this->telpon_pelanggan->ViewCustomAttributes = "";

			// hp_pelanggan
			$this->hp_pelanggan->ViewValue = $this->hp_pelanggan->CurrentValue;
			$this->hp_pelanggan->ViewCustomAttributes = "";

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

			// tgl_daftar
			$this->tgl_daftar->ViewValue = $this->tgl_daftar->CurrentValue;
			$this->tgl_daftar->ViewValue = FormatDateTime($this->tgl_daftar->ViewValue, 7);
			$this->tgl_daftar->ViewCustomAttributes = "";

			// kategori
			$curVal = strval($this->kategori->CurrentValue);
			if ($curVal != "") {
				$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
				if ($this->kategori->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_kategori`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->kategori->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->kategori->ViewValue = $this->kategori->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->kategori->ViewValue = $this->kategori->CurrentValue;
					}
				}
			} else {
				$this->kategori->ViewValue = NULL;
			}
			$this->kategori->ViewCustomAttributes = "";

			// tipe
			$curVal = strval($this->tipe->CurrentValue);
			if ($curVal != "") {
				$this->tipe->ViewValue = $this->tipe->lookupCacheOption($curVal);
				if ($this->tipe->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id_tipe`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->tipe->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tipe->ViewValue = $this->tipe->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tipe->ViewValue = $this->tipe->CurrentValue;
					}
				}
			} else {
				$this->tipe->ViewValue = NULL;
			}
			$this->tipe->ViewCustomAttributes = "";

			// noktp_pelanggan
			$this->noktp_pelanggan->LinkCustomAttributes = "";
			$this->noktp_pelanggan->HrefValue = "";
			$this->noktp_pelanggan->TooltipValue = "";

			// nama_pelanggan
			$this->nama_pelanggan->LinkCustomAttributes = "";
			$this->nama_pelanggan->HrefValue = "";
			$this->nama_pelanggan->TooltipValue = "";

			// jenis_pelanggan
			$this->jenis_pelanggan->LinkCustomAttributes = "";
			$this->jenis_pelanggan->HrefValue = "";
			$this->jenis_pelanggan->TooltipValue = "";

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->LinkCustomAttributes = "";
			$this->tgllahir_pelanggan->HrefValue = "";
			$this->tgllahir_pelanggan->TooltipValue = "";

			// pekerjaan_pelanggan
			$this->pekerjaan_pelanggan->LinkCustomAttributes = "";
			$this->pekerjaan_pelanggan->HrefValue = "";
			$this->pekerjaan_pelanggan->TooltipValue = "";

			// kota_pelanggan
			$this->kota_pelanggan->LinkCustomAttributes = "";
			$this->kota_pelanggan->HrefValue = "";
			$this->kota_pelanggan->TooltipValue = "";

			// alamat_pelanggan
			$this->alamat_pelanggan->LinkCustomAttributes = "";
			$this->alamat_pelanggan->HrefValue = "";
			$this->alamat_pelanggan->TooltipValue = "";

			// telpon_pelanggan
			$this->telpon_pelanggan->LinkCustomAttributes = "";
			$this->telpon_pelanggan->HrefValue = "";
			$this->telpon_pelanggan->TooltipValue = "";

			// hp_pelanggan
			$this->hp_pelanggan->LinkCustomAttributes = "";
			$this->hp_pelanggan->HrefValue = "";
			$this->hp_pelanggan->TooltipValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";
			$this->id_klinik->TooltipValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";
			$this->tgl_daftar->TooltipValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";
			$this->kategori->TooltipValue = "";

			// tipe
			$this->tipe->LinkCustomAttributes = "";
			$this->tipe->HrefValue = "";
			$this->tipe->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// noktp_pelanggan
			$this->noktp_pelanggan->EditAttrs["class"] = "form-control";
			$this->noktp_pelanggan->EditCustomAttributes = "";
			if (!$this->noktp_pelanggan->Raw)
				$this->noktp_pelanggan->CurrentValue = HtmlDecode($this->noktp_pelanggan->CurrentValue);
			$this->noktp_pelanggan->EditValue = HtmlEncode($this->noktp_pelanggan->CurrentValue);
			$this->noktp_pelanggan->PlaceHolder = RemoveHtml($this->noktp_pelanggan->caption());

			// nama_pelanggan
			$this->nama_pelanggan->EditAttrs["class"] = "form-control";
			$this->nama_pelanggan->EditCustomAttributes = "";
			if (!$this->nama_pelanggan->Raw)
				$this->nama_pelanggan->CurrentValue = HtmlDecode($this->nama_pelanggan->CurrentValue);
			$this->nama_pelanggan->EditValue = HtmlEncode($this->nama_pelanggan->CurrentValue);
			$this->nama_pelanggan->PlaceHolder = RemoveHtml($this->nama_pelanggan->caption());

			// jenis_pelanggan
			$this->jenis_pelanggan->EditCustomAttributes = "";
			$this->jenis_pelanggan->EditValue = $this->jenis_pelanggan->options(FALSE);

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->EditAttrs["class"] = "form-control";
			$this->tgllahir_pelanggan->EditCustomAttributes = "";
			$this->tgllahir_pelanggan->EditValue = HtmlEncode(FormatDateTime($this->tgllahir_pelanggan->CurrentValue, 8));
			$this->tgllahir_pelanggan->PlaceHolder = RemoveHtml($this->tgllahir_pelanggan->caption());

			// pekerjaan_pelanggan
			$this->pekerjaan_pelanggan->EditAttrs["class"] = "form-control";
			$this->pekerjaan_pelanggan->EditCustomAttributes = "";
			$curVal = trim(strval($this->pekerjaan_pelanggan->CurrentValue));
			if ($curVal != "")
				$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->lookupCacheOption($curVal);
			else
				$this->pekerjaan_pelanggan->ViewValue = $this->pekerjaan_pelanggan->Lookup !== NULL && is_array($this->pekerjaan_pelanggan->Lookup->Options) ? $curVal : NULL;
			if ($this->pekerjaan_pelanggan->ViewValue !== NULL) { // Load from cache
				$this->pekerjaan_pelanggan->EditValue = array_values($this->pekerjaan_pelanggan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->pekerjaan_pelanggan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pekerjaan_pelanggan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pekerjaan_pelanggan->EditValue = $arwrk;
			}

			// kota_pelanggan
			$this->kota_pelanggan->EditAttrs["class"] = "form-control";
			$this->kota_pelanggan->EditCustomAttributes = "";
			$curVal = trim(strval($this->kota_pelanggan->CurrentValue));
			if ($curVal != "")
				$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->lookupCacheOption($curVal);
			else
				$this->kota_pelanggan->ViewValue = $this->kota_pelanggan->Lookup !== NULL && is_array($this->kota_pelanggan->Lookup->Options) ? $curVal : NULL;
			if ($this->kota_pelanggan->ViewValue !== NULL) { // Load from cache
				$this->kota_pelanggan->EditValue = array_values($this->kota_pelanggan->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->kota_pelanggan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kota_pelanggan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kota_pelanggan->EditValue = $arwrk;
			}

			// alamat_pelanggan
			$this->alamat_pelanggan->EditAttrs["class"] = "form-control";
			$this->alamat_pelanggan->EditCustomAttributes = "";
			if (!$this->alamat_pelanggan->Raw)
				$this->alamat_pelanggan->CurrentValue = HtmlDecode($this->alamat_pelanggan->CurrentValue);
			$this->alamat_pelanggan->EditValue = HtmlEncode($this->alamat_pelanggan->CurrentValue);
			$this->alamat_pelanggan->PlaceHolder = RemoveHtml($this->alamat_pelanggan->caption());

			// telpon_pelanggan
			$this->telpon_pelanggan->EditAttrs["class"] = "form-control";
			$this->telpon_pelanggan->EditCustomAttributes = "";
			if (!$this->telpon_pelanggan->Raw)
				$this->telpon_pelanggan->CurrentValue = HtmlDecode($this->telpon_pelanggan->CurrentValue);
			$this->telpon_pelanggan->EditValue = HtmlEncode($this->telpon_pelanggan->CurrentValue);
			$this->telpon_pelanggan->PlaceHolder = RemoveHtml($this->telpon_pelanggan->caption());

			// hp_pelanggan
			$this->hp_pelanggan->EditAttrs["class"] = "form-control";
			$this->hp_pelanggan->EditCustomAttributes = "";
			if (!$this->hp_pelanggan->Raw)
				$this->hp_pelanggan->CurrentValue = HtmlDecode($this->hp_pelanggan->CurrentValue);
			$this->hp_pelanggan->EditValue = HtmlEncode($this->hp_pelanggan->CurrentValue);
			$this->hp_pelanggan->PlaceHolder = RemoveHtml($this->hp_pelanggan->caption());

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

			// tgl_daftar
			$this->tgl_daftar->EditAttrs["class"] = "form-control";
			$this->tgl_daftar->EditCustomAttributes = "";
			$this->tgl_daftar->EditValue = HtmlEncode(FormatDateTime($this->tgl_daftar->CurrentValue, 7));
			$this->tgl_daftar->PlaceHolder = RemoveHtml($this->tgl_daftar->caption());

			// kategori
			$this->kategori->EditAttrs["class"] = "form-control";
			$this->kategori->EditCustomAttributes = "";
			$curVal = trim(strval($this->kategori->CurrentValue));
			if ($curVal != "")
				$this->kategori->ViewValue = $this->kategori->lookupCacheOption($curVal);
			else
				$this->kategori->ViewValue = $this->kategori->Lookup !== NULL && is_array($this->kategori->Lookup->Options) ? $curVal : NULL;
			if ($this->kategori->ViewValue !== NULL) { // Load from cache
				$this->kategori->EditValue = array_values($this->kategori->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_kategori`" . SearchString("=", $this->kategori->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->kategori->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->kategori->EditValue = $arwrk;
			}

			// tipe
			$this->tipe->EditAttrs["class"] = "form-control";
			$this->tipe->EditCustomAttributes = "";
			$curVal = trim(strval($this->tipe->CurrentValue));
			if ($curVal != "")
				$this->tipe->ViewValue = $this->tipe->lookupCacheOption($curVal);
			else
				$this->tipe->ViewValue = $this->tipe->Lookup !== NULL && is_array($this->tipe->Lookup->Options) ? $curVal : NULL;
			if ($this->tipe->ViewValue !== NULL) { // Load from cache
				$this->tipe->EditValue = array_values($this->tipe->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id_tipe`" . SearchString("=", $this->tipe->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->tipe->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->tipe->EditValue = $arwrk;
			}

			// Add refer script
			// noktp_pelanggan

			$this->noktp_pelanggan->LinkCustomAttributes = "";
			$this->noktp_pelanggan->HrefValue = "";

			// nama_pelanggan
			$this->nama_pelanggan->LinkCustomAttributes = "";
			$this->nama_pelanggan->HrefValue = "";

			// jenis_pelanggan
			$this->jenis_pelanggan->LinkCustomAttributes = "";
			$this->jenis_pelanggan->HrefValue = "";

			// tgllahir_pelanggan
			$this->tgllahir_pelanggan->LinkCustomAttributes = "";
			$this->tgllahir_pelanggan->HrefValue = "";

			// pekerjaan_pelanggan
			$this->pekerjaan_pelanggan->LinkCustomAttributes = "";
			$this->pekerjaan_pelanggan->HrefValue = "";

			// kota_pelanggan
			$this->kota_pelanggan->LinkCustomAttributes = "";
			$this->kota_pelanggan->HrefValue = "";

			// alamat_pelanggan
			$this->alamat_pelanggan->LinkCustomAttributes = "";
			$this->alamat_pelanggan->HrefValue = "";

			// telpon_pelanggan
			$this->telpon_pelanggan->LinkCustomAttributes = "";
			$this->telpon_pelanggan->HrefValue = "";

			// hp_pelanggan
			$this->hp_pelanggan->LinkCustomAttributes = "";
			$this->hp_pelanggan->HrefValue = "";

			// id_klinik
			$this->id_klinik->LinkCustomAttributes = "";
			$this->id_klinik->HrefValue = "";

			// tgl_daftar
			$this->tgl_daftar->LinkCustomAttributes = "";
			$this->tgl_daftar->HrefValue = "";

			// kategori
			$this->kategori->LinkCustomAttributes = "";
			$this->kategori->HrefValue = "";

			// tipe
			$this->tipe->LinkCustomAttributes = "";
			$this->tipe->HrefValue = "";
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
		if ($this->noktp_pelanggan->Required) {
			if (!$this->noktp_pelanggan->IsDetailKey && $this->noktp_pelanggan->FormValue != NULL && $this->noktp_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->noktp_pelanggan->caption(), $this->noktp_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->nama_pelanggan->Required) {
			if (!$this->nama_pelanggan->IsDetailKey && $this->nama_pelanggan->FormValue != NULL && $this->nama_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_pelanggan->caption(), $this->nama_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->jenis_pelanggan->Required) {
			if ($this->jenis_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_pelanggan->caption(), $this->jenis_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->tgllahir_pelanggan->Required) {
			if (!$this->tgllahir_pelanggan->IsDetailKey && $this->tgllahir_pelanggan->FormValue != NULL && $this->tgllahir_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgllahir_pelanggan->caption(), $this->tgllahir_pelanggan->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgllahir_pelanggan->FormValue)) {
			AddMessage($FormError, $this->tgllahir_pelanggan->errorMessage());
		}
		if ($this->pekerjaan_pelanggan->Required) {
			if (!$this->pekerjaan_pelanggan->IsDetailKey && $this->pekerjaan_pelanggan->FormValue != NULL && $this->pekerjaan_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pekerjaan_pelanggan->caption(), $this->pekerjaan_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->kota_pelanggan->Required) {
			if (!$this->kota_pelanggan->IsDetailKey && $this->kota_pelanggan->FormValue != NULL && $this->kota_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kota_pelanggan->caption(), $this->kota_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->alamat_pelanggan->Required) {
			if (!$this->alamat_pelanggan->IsDetailKey && $this->alamat_pelanggan->FormValue != NULL && $this->alamat_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat_pelanggan->caption(), $this->alamat_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->telpon_pelanggan->Required) {
			if (!$this->telpon_pelanggan->IsDetailKey && $this->telpon_pelanggan->FormValue != NULL && $this->telpon_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telpon_pelanggan->caption(), $this->telpon_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->hp_pelanggan->Required) {
			if (!$this->hp_pelanggan->IsDetailKey && $this->hp_pelanggan->FormValue != NULL && $this->hp_pelanggan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp_pelanggan->caption(), $this->hp_pelanggan->RequiredErrorMessage));
			}
		}
		if ($this->id_klinik->Required) {
			if (!$this->id_klinik->IsDetailKey && $this->id_klinik->FormValue != NULL && $this->id_klinik->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_klinik->caption(), $this->id_klinik->RequiredErrorMessage));
			}
		}
		if ($this->tgl_daftar->Required) {
			if (!$this->tgl_daftar->IsDetailKey && $this->tgl_daftar->FormValue != NULL && $this->tgl_daftar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_daftar->caption(), $this->tgl_daftar->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->tgl_daftar->FormValue)) {
			AddMessage($FormError, $this->tgl_daftar->errorMessage());
		}
		if ($this->kategori->Required) {
			if (!$this->kategori->IsDetailKey && $this->kategori->FormValue != NULL && $this->kategori->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kategori->caption(), $this->kategori->RequiredErrorMessage));
			}
		}
		if ($this->tipe->Required) {
			if (!$this->tipe->IsDetailKey && $this->tipe->FormValue != NULL && $this->tipe->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tipe->caption(), $this->tipe->RequiredErrorMessage));
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
		if ($this->noktp_pelanggan->CurrentValue != "") { // Check field with unique index
			$filter = "(`noktp_pelanggan` = '" . AdjustSql($this->noktp_pelanggan->CurrentValue, $this->Dbid) . "')";
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$idxErrMsg = str_replace("%f", $this->noktp_pelanggan->caption(), $Language->phrase("DupIndex"));
				$idxErrMsg = str_replace("%v", $this->noktp_pelanggan->CurrentValue, $idxErrMsg);
				$this->setFailureMessage($idxErrMsg);
				$rsChk->close();
				return FALSE;
			}
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// noktp_pelanggan
		$this->noktp_pelanggan->setDbValueDef($rsnew, $this->noktp_pelanggan->CurrentValue, "", FALSE);

		// nama_pelanggan
		$this->nama_pelanggan->setDbValueDef($rsnew, $this->nama_pelanggan->CurrentValue, "", FALSE);

		// jenis_pelanggan
		$this->jenis_pelanggan->setDbValueDef($rsnew, $this->jenis_pelanggan->CurrentValue, "", FALSE);

		// tgllahir_pelanggan
		$this->tgllahir_pelanggan->setDbValueDef($rsnew, UnFormatDateTime($this->tgllahir_pelanggan->CurrentValue, 0), CurrentDate(), FALSE);

		// pekerjaan_pelanggan
		$this->pekerjaan_pelanggan->setDbValueDef($rsnew, $this->pekerjaan_pelanggan->CurrentValue, "", FALSE);

		// kota_pelanggan
		$this->kota_pelanggan->setDbValueDef($rsnew, $this->kota_pelanggan->CurrentValue, 0, FALSE);

		// alamat_pelanggan
		$this->alamat_pelanggan->setDbValueDef($rsnew, $this->alamat_pelanggan->CurrentValue, "", FALSE);

		// telpon_pelanggan
		$this->telpon_pelanggan->setDbValueDef($rsnew, $this->telpon_pelanggan->CurrentValue, "", FALSE);

		// hp_pelanggan
		$this->hp_pelanggan->setDbValueDef($rsnew, $this->hp_pelanggan->CurrentValue, "", FALSE);

		// id_klinik
		$this->id_klinik->setDbValueDef($rsnew, $this->id_klinik->CurrentValue, 0, FALSE);

		// tgl_daftar
		$this->tgl_daftar->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_daftar->CurrentValue, 7), CurrentDate(), FALSE);

		// kategori
		$this->kategori->setDbValueDef($rsnew, $this->kategori->CurrentValue, 0, FALSE);

		// tipe
		$this->tipe->setDbValueDef($rsnew, $this->tipe->CurrentValue, 0, FALSE);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("m_pelangganlist.php"), "", $this->TableVar, TRUE);
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
				case "x_jenis_pelanggan":
					break;
				case "x_pekerjaan_pelanggan":
					break;
				case "x_kota_pelanggan":
					break;
				case "x_id_klinik":
					break;
				case "x_kategori":
					break;
				case "x_tipe":
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
						case "x_pekerjaan_pelanggan":
							break;
						case "x_kota_pelanggan":
							break;
						case "x_id_klinik":
							break;
						case "x_kategori":
							break;
						case "x_tipe":
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